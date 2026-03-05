<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Moon Patrol — Chloe Reads Jon</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html, body {
    background: #000;
    color: #33ff33;
    font-family: 'Courier New', Courier, monospace;
    height: 100%;
    overflow: hidden;
    user-select: none;
    -webkit-user-select: none;
  }
  #wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    height: 100vh;
    padding: 8px 8px 0;
  }
  #hud {
    width: 100%;
    max-width: 700px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: clamp(11px, 2.5vw, 15px);
    letter-spacing: 1px;
    padding: 4px 2px;
    text-transform: uppercase;
    color: #33ff33;
    text-shadow: 0 0 6px #33ff33;
    height: 28px;
    flex-shrink: 0;
  }
  #hud span { min-width: 80px; }
  #hud .center { text-align: center; flex: 1; }
  #hud .right { text-align: right; }
  #canvas-container {
    position: relative;
    width: 100%;
    max-width: 700px;
    flex: 1;
    min-height: 0;
  }
  canvas {
    display: block;
    width: 100%;
    height: 100%;
    image-rendering: pixelated;
    image-rendering: crisp-edges;
  }
  /* CRT overlay */
  #canvas-container::after {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
      to bottom,
      transparent 0px,
      transparent 3px,
      rgba(0,0,0,0.08) 3px,
      rgba(0,0,0,0.08) 4px
    );
    pointer-events: none;
    mix-blend-mode: multiply;
  }
  #touch-controls {
    width: 100%;
    max-width: 700px;
    display: flex;
    justify-content: space-between;
    padding: 6px 2px;
    gap: 8px;
    flex-shrink: 0;
    height: 70px;
  }
  .touch-btn {
    flex: 1;
    background: rgba(51,255,51,0.08);
    border: 1px solid rgba(51,255,51,0.35);
    border-radius: 8px;
    color: #33ff33;
    font-family: 'Courier New', monospace;
    font-size: 13px;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-shadow: 0 0 6px #33ff33;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1.3;
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
    transition: background 0.1s;
  }
  .touch-btn:active, .touch-btn.pressed {
    background: rgba(51,255,51,0.22);
  }
  .touch-btn small { font-size: 10px; opacity: 0.6; }
  #source-note {
    width: 100%;
    max-width: 700px;
    font-size: 10px;
    color: #1a8a1a;
    text-align: center;
    padding: 3px 0 4px;
    flex-shrink: 0;
  }
  #source-note a { color: #1a8a1a; text-decoration: underline; }
</style>
</head>
<body>
<div id="wrapper">
  <div id="hud">
    <span id="hud-lives">♥♥♥</span>
    <span class="center" id="hud-score">SCORE 0</span>
    <span class="right" id="hud-hi">HI 0</span>
  </div>
  <div id="canvas-container">
    <canvas id="gc"></canvas>
  </div>
  <div id="touch-controls">
    <button class="touch-btn" id="btn-jump" ontouchstart="touchStart('jump')" ontouchend="touchEnd('jump')">
      ▲<br><small>JUMP [SPACE]</small>
    </button>
    <button class="touch-btn" id="btn-shoot-fwd" ontouchstart="touchStart('fwd')" ontouchend="touchEnd('fwd')">
      ▶▶<br><small>FIRE FWD [Z]</small>
    </button>
    <button class="touch-btn" id="btn-shoot-up" ontouchstart="touchStart('up')" ontouchend="touchEnd('up')">
      ▲▲<br><small>FIRE UP [X]</small>
    </button>
  </div>
  <div id="source-note">
    Inspired by Jon's <a href="https://jonaquino.blogspot.com/2009/05/woz-on-apple-iic.html" target="_blank">
    2009 post</a> about the Apple IIc and Moon Patrol — "Man, I miss those days."
  </div>
</div>

<script>
// ─── Canvas setup ────────────────────────────────────────────────────────────
const canvas = document.getElementById('gc');
const ctx = canvas.getContext('2d');
const container = document.getElementById('canvas-container');

const W = 700, H = 320; // logical resolution
canvas.width = W;
canvas.height = H;

// ─── Palette ─────────────────────────────────────────────────────────────────
const C = {
  bg:       '#000811',
  star:     '#1a4a1a',
  ground:   '#22aa22',
  groundDk: '#0d550d',
  car:      '#33ff33',
  carDim:   '#1a8a1a',
  bullet:   '#ffff44',
  ufo:      '#ff4444',
  ufoBullet:'#ff8800',
  rock:     '#22aa22',
  text:     '#33ff33',
  textDim:  '#1a6a1a',
  crater:   '#000811',
  mountain: '#0d4a0d',
};

// ─── Game constants ───────────────────────────────────────────────────────────
const GROUND_Y   = H - 60;    // top of ground strip
const CAR_X      = 100;
const CAR_W      = 48;
const CAR_H      = 22;
const GRAVITY    = 0.55;
const JUMP_VY    = -10.5;
const WHEEL_R    = 8;
const GROUND_SPD_BASE = 2.2;

// ─── State ────────────────────────────────────────────────────────────────────
let state = 'title'; // 'title' | 'playing' | 'dead' | 'gameover'
let score = 0, hiScore = parseInt(localStorage.getItem('moonpatrol_hi') || '0');
let lives = 3;
let frame = 0;
let speed = GROUND_SPD_BASE;
let groundOffset = 0;
let carY = GROUND_Y - CAR_H - WHEEL_R;
let carVY = 0;
let onGround = true;
let invincible = 0;
let deadTimer = 0;
let startTimer = 0;

// obstacle arrays
let rocks    = [];
let craters  = [];
let ufos     = [];
let bullets  = []; // {x,y,vx,vy,type:'car'|'ufo'}
let particles= [];
let stars    = [];

// input state
const keys = { jump:false, fwd:false, up:false };
let prevKeys = { jump:false, fwd:false, up:false };
let shootFwdCooldown = 0;
let shootUpCooldown  = 0;

// ─── Stars ────────────────────────────────────────────────────────────────────
function initStars() {
  stars = [];
  for (let i = 0; i < 60; i++) {
    stars.push({
      x: Math.random() * W,
      y: Math.random() * (GROUND_Y - 30),
      r: Math.random() < 0.2 ? 1.5 : 1,
      spd: 0.2 + Math.random() * 0.3,
    });
  }
}

// ─── Spawn helpers ────────────────────────────────────────────────────────────
function spawnRock() {
  const h = 10 + Math.floor(Math.random() * 14);
  rocks.push({ x: W + 20, y: GROUND_Y - h, w: 10 + Math.floor(Math.random()*8), h });
}
function spawnCrater() {
  craters.push({ x: W + 20, w: 28 + Math.floor(Math.random()*20) });
}
function spawnUfo() {
  const y = 30 + Math.random() * 80;
  ufos.push({ x: W + 40, y, w: 30, h: 14, vx: -(speed + 1), vy: 0, shootTimer: 60 + Math.floor(Math.random()*60), hp: 2 });
}

// ─── Explosion particles ──────────────────────────────────────────────────────
function explode(x, y, color, n) {
  for (let i = 0; i < n; i++) {
    const angle = Math.random() * Math.PI * 2;
    const spd   = 1 + Math.random() * 3;
    particles.push({ x, y,
      vx: Math.cos(angle) * spd, vy: Math.sin(angle) * spd,
      life: 20 + Math.random() * 20, color });
  }
}

// ─── Reset game ───────────────────────────────────────────────────────────────
function resetGame() {
  score = 0; lives = 3; frame = 0; speed = GROUND_SPD_BASE;
  groundOffset = 0;
  carY = GROUND_Y - CAR_H - WHEEL_R;
  carVY = 0; onGround = true; invincible = 0;
  rocks = []; craters = []; ufos = []; bullets = []; particles = [];
  shootFwdCooldown = 0; shootUpCooldown = 0;
  initStars();
  state = 'playing';
  updateHUD();
}

function killCar() {
  if (invincible > 0) return;
  explode(CAR_X + CAR_W/2, carY + CAR_H/2, C.car, 18);
  lives--;
  updateHUD();
  if (lives <= 0) {
    state = 'gameover';
    if (score > hiScore) { hiScore = score; localStorage.setItem('moonpatrol_hi', hiScore); }
    updateHUD();
  } else {
    state = 'dead';
    deadTimer = 90;
    carY = GROUND_Y - CAR_H - WHEEL_R;
    carVY = 0; onGround = true;
  }
}

function revive() {
  invincible = 120;
  state = 'playing';
  rocks = rocks.filter(r => r.x > CAR_X + CAR_W + 60);
  craters = craters.filter(c => c.x > CAR_X + CAR_W + 60);
  ufos = []; bullets = [];
}

// ─── Draw helpers ─────────────────────────────────────────────────────────────
function drawCar(flash) {
  if (flash) return;
  const x = CAR_X, y = carY;
  ctx.fillStyle = C.carDim;

  // body
  ctx.fillStyle = C.car;
  // main hull
  ctx.fillRect(x + 4, y + 4, CAR_W - 8, CAR_H - 8);
  // cab
  ctx.fillRect(x + 12, y, CAR_W - 24, 10);
  // window
  ctx.fillStyle = C.bg;
  ctx.fillRect(x + 15, y + 2, 10, 6);

  // antenna (shoots up)
  ctx.fillStyle = C.carDim;
  ctx.fillRect(x + CAR_W - 10, y - 8, 2, 8);
  // gun barrel (shoots forward)
  ctx.fillStyle = C.car;
  ctx.fillRect(x + CAR_W - 4, y + 8, 12, 3);

  // wheels
  ctx.fillStyle = C.carDim;
  drawWheel(x + 12, y + CAR_H + WHEEL_R - 2);
  drawWheel(x + CAR_W - 12, y + CAR_H + WHEEL_R - 2);
}

function drawWheel(cx, cy) {
  ctx.beginPath();
  ctx.arc(cx, cy, WHEEL_R, 0, Math.PI*2);
  ctx.fill();
  ctx.fillStyle = C.bg;
  ctx.beginPath();
  ctx.arc(cx, cy, WHEEL_R - 3, 0, Math.PI*2);
  ctx.fill();
  ctx.fillStyle = C.carDim;
}

function drawRock(r) {
  ctx.fillStyle = C.rock;
  ctx.beginPath();
  ctx.moveTo(r.x + r.w/2, r.y);
  ctx.lineTo(r.x + r.w, r.y + r.h);
  ctx.lineTo(r.x, r.y + r.h);
  ctx.closePath();
  ctx.fill();
  ctx.fillStyle = '#44ff44';
  ctx.fillRect(r.x + 2, r.y + 2, r.w - 4, 3);
}

function drawUfo(u) {
  ctx.fillStyle = C.ufo;
  // saucer body
  ctx.beginPath();
  ctx.ellipse(u.x + u.w/2, u.y + u.h*0.6, u.w/2, u.h*0.4, 0, 0, Math.PI*2);
  ctx.fill();
  // dome
  ctx.fillStyle = '#ff8888';
  ctx.beginPath();
  ctx.ellipse(u.x + u.w/2, u.y + u.h*0.35, u.w*0.28, u.h*0.35, 0, 0, Math.PI*2);
  ctx.fill();
  // lights
  ctx.fillStyle = '#ffff00';
  for (let i = 0; i < 3; i++) {
    ctx.beginPath();
    ctx.arc(u.x + 8 + i*7, u.y + u.h*0.65, 1.5, 0, Math.PI*2);
    ctx.fill();
  }
}

function drawGround() {
  // main surface
  ctx.fillStyle = C.groundDk;
  ctx.fillRect(0, GROUND_Y, W, H - GROUND_Y);

  // rolling ground line with craters
  ctx.fillStyle = C.ground;
  let px = 0;
  while (px < W) {
    // find nearest crater at this x
    let inCrater = false;
    for (const c of craters) {
      if (px >= c.x && px <= c.x + c.w) { inCrater = true; break; }
    }
    if (!inCrater) {
      ctx.fillRect(px, GROUND_Y, 1, 4);
    }
    px++;
  }

  // crater darkness
  for (const c of craters) {
    const cx = c.x, cw = c.w;
    if (cx > W || cx + cw < 0) continue;
    ctx.fillStyle = C.crater;
    ctx.fillRect(cx, GROUND_Y, cw, H - GROUND_Y);
    // crater rim
    ctx.fillStyle = C.groundDk;
    ctx.fillRect(cx - 2, GROUND_Y, 4, 6);
    ctx.fillRect(cx + cw - 2, GROUND_Y, 4, 6);
  }

  // ground detail lines
  ctx.fillStyle = '#165516';
  for (let i = 0; i < 3; i++) {
    const lineX = ((groundOffset * 0.5 + i * 80) % W + W) % W;
    ctx.fillRect(lineX, GROUND_Y + 8, 60, 1);
  }
}

function drawMountains() {
  ctx.fillStyle = C.mountain;
  const peaks = [
    {x:100, h:55}, {x:220, h:40}, {x:350, h:70}, {x:470, h:45}, {x:580, h:60}, {x:680, h:38}
  ];
  for (const p of peaks) {
    const ox = ((p.x - groundOffset * 0.15) % (W + 100) + W + 100) % (W + 100) - 50;
    ctx.beginPath();
    ctx.moveTo(ox, GROUND_Y);
    ctx.lineTo(ox + 60, GROUND_Y - p.h);
    ctx.lineTo(ox + 120, GROUND_Y);
    ctx.closePath();
    ctx.fill();
  }
}

function drawStars() {
  for (const s of stars) {
    const brightness = 0.4 + 0.6 * Math.abs(Math.sin(frame * 0.02 + s.x));
    ctx.globalAlpha = brightness;
    ctx.fillStyle = C.star;
    ctx.fillRect(s.x, s.y, s.r, s.r);
  }
  ctx.globalAlpha = 1;
}

function drawBullets() {
  for (const b of bullets) {
    if (b.type === 'car') {
      ctx.fillStyle = C.bullet;
      ctx.fillRect(b.x - 3, b.y - 1, 8, 3);
    } else {
      ctx.fillStyle = C.ufoBullet;
      ctx.beginPath();
      ctx.arc(b.x, b.y, 3, 0, Math.PI*2);
      ctx.fill();
    }
  }
}

function drawParticles() {
  for (const p of particles) {
    ctx.globalAlpha = p.life / 40;
    ctx.fillStyle = p.color;
    ctx.fillRect(p.x - 1, p.y - 1, 3, 3);
  }
  ctx.globalAlpha = 1;
}

function drawHUD() {
  // planet & moon in sky
  ctx.fillStyle = '#0a2a0a';
  ctx.beginPath();
  ctx.arc(W - 60, 45, 30, 0, Math.PI*2);
  ctx.fill();
  ctx.fillStyle = '#0d3a0d';
  ctx.beginPath();
  ctx.arc(W - 60, 45, 30, 0, Math.PI*2);
  ctx.fill();
  ctx.fillStyle = '#000811';
  ctx.beginPath();
  ctx.arc(W - 50, 38, 22, 0, Math.PI*2);
  ctx.fill();
}

// ─── Text screens ─────────────────────────────────────────────────────────────
function drawTitle() {
  ctx.fillStyle = C.bg;
  ctx.fillRect(0, 0, W, H);
  drawStars();
  drawMountains();
  // ground
  ctx.fillStyle = C.groundDk;
  ctx.fillRect(0, GROUND_Y, W, H - GROUND_Y);
  ctx.fillStyle = C.ground;
  ctx.fillRect(0, GROUND_Y, W, 4);

  // Draw static car
  drawCar(false);

  ctx.fillStyle = C.text;
  ctx.font = 'bold 36px "Courier New", monospace';
  ctx.textAlign = 'center';
  ctx.shadowColor = C.text;
  ctx.shadowBlur = 12;
  ctx.fillText('MOON PATROL', W/2, H/2 - 50);
  ctx.shadowBlur = 0;

  ctx.font = '13px "Courier New", monospace';
  ctx.fillStyle = C.textDim;
  ctx.fillText('CONTROLS:  SPACE=JUMP   Z=FIRE FWD   X=FIRE UP', W/2, H/2 - 14);

  ctx.fillStyle = C.text;
  ctx.font = 'bold 14px "Courier New", monospace';
  ctx.fillText(frame % 60 < 30 ? 'PRESS SPACE TO START' : '', W/2, H/2 + 20);

  ctx.font = '11px "Courier New", monospace';
  ctx.fillStyle = C.textDim;
  ctx.fillText(`HI-SCORE  ${String(hiScore).padStart(6,'0')}`, W/2, H/2 + 46);

  ctx.textAlign = 'left';
}

function drawGameOver() {
  ctx.fillStyle = 'rgba(0,0,0,0.6)';
  ctx.fillRect(0, 0, W, H);
  ctx.fillStyle = C.text;
  ctx.textAlign = 'center';
  ctx.shadowColor = C.text;
  ctx.shadowBlur = 16;
  ctx.font = 'bold 32px "Courier New", monospace';
  ctx.fillText('GAME OVER', W/2, H/2 - 30);
  ctx.shadowBlur = 0;
  ctx.font = '14px "Courier New", monospace';
  ctx.fillStyle = C.textDim;
  ctx.fillText(`SCORE  ${String(score).padStart(6,'0')}`, W/2, H/2 + 6);
  ctx.fillText(`HI     ${String(hiScore).padStart(6,'0')}`, W/2, H/2 + 26);
  ctx.fillStyle = C.text;
  ctx.fillText(frame % 60 < 30 ? 'PRESS SPACE TO RESTART' : '', W/2, H/2 + 56);
  ctx.textAlign = 'left';
}

// ─── Update HUD div ───────────────────────────────────────────────────────────
function updateHUD() {
  const heartsEl = document.getElementById('hud-lives');
  heartsEl.textContent = '♥'.repeat(Math.max(0,lives)) + '♡'.repeat(Math.max(0,3-lives));
  document.getElementById('hud-score').textContent = 'SCORE ' + String(score).padStart(6,'0');
  document.getElementById('hud-hi').textContent = 'HI ' + String(hiScore).padStart(6,'0');
}

// ─── Main loop ────────────────────────────────────────────────────────────────
let spawnRockTimer  = 80;
let spawnCraterTimer= 140;
let spawnUfoTimer   = 200;

function update() {
  frame++;

  if (state === 'title') {
    // animate stars
    for (const s of stars) {
      s.x -= s.spd;
      if (s.x < 0) s.x = W;
    }
    return;
  }

  if (state === 'dead') {
    deadTimer--;
    // particles drift
    for (const p of particles) { p.x += p.vx; p.y += p.vy; p.life--; }
    particles = particles.filter(p => p.life > 0);
    if (deadTimer <= 0) revive();
    return;
  }

  if (state === 'gameover') return;

  // ── speed ramp
  speed = GROUND_SPD_BASE + score / 3000;
  groundOffset += speed;

  // ── stars
  for (const s of stars) {
    s.x -= s.spd * (speed / GROUND_SPD_BASE);
    if (s.x < 0) s.x = W;
  }

  // ── score
  score++;
  if (score > hiScore) { hiScore = score; localStorage.setItem('moonpatrol_hi', hiScore); }
  if (frame % 4 === 0) updateHUD();

  // ── invincibility
  if (invincible > 0) invincible--;

  // ── jump
  if (!prevKeys.jump && keys.jump && onGround) {
    carVY = JUMP_VY;
    onGround = false;
  }

  // ── gravity
  if (!onGround) {
    carVY += GRAVITY;
    carY += carVY;
  }

  // ground landing
  const groundTop = GROUND_Y - CAR_H - WHEEL_R;
  if (carY >= groundTop) {
    carY = groundTop;
    carVY = 0;
    onGround = true;
  }

  // ── shoot forward
  if (keys.fwd && shootFwdCooldown <= 0) {
    bullets.push({ x: CAR_X + CAR_W + 10, y: carY + 9, vx: 9, vy: 0, type: 'car' });
    shootFwdCooldown = 18;
  }
  if (shootFwdCooldown > 0) shootFwdCooldown--;

  // ── shoot up
  if (keys.up && shootUpCooldown <= 0) {
    bullets.push({ x: CAR_X + CAR_W - 8, y: carY - 8, vx: 0, vy: -9, type: 'car' });
    shootUpCooldown = 18;
  }
  if (shootUpCooldown > 0) shootUpCooldown--;

  prevKeys = { ...keys };

  // ── spawn obstacles
  spawnRockTimer--;
  if (spawnRockTimer <= 0) {
    spawnRock();
    spawnRockTimer = 80 + Math.floor(Math.random() * 60) - Math.min(30, score/400);
  }
  spawnCraterTimer--;
  if (spawnCraterTimer <= 0 && score > 200) {
    spawnCrater();
    spawnCraterTimer = 160 + Math.floor(Math.random() * 80) - Math.min(60, score/300);
  }
  spawnUfoTimer--;
  if (spawnUfoTimer <= 0 && score > 400) {
    spawnUfo();
    spawnUfoTimer = 200 + Math.floor(Math.random() * 120) - Math.min(80, score/300);
  }

  // ── move rocks
  for (const r of rocks) r.x -= speed;
  rocks = rocks.filter(r => r.x > -50);

  // ── move craters
  for (const c of craters) c.x -= speed;
  craters = craters.filter(c => c.x > -80);

  // ── move UFOs
  for (const u of ufos) {
    u.x += u.vx;
    u.y += Math.sin(frame * 0.04) * 0.5;
    u.shootTimer--;
    if (u.shootTimer <= 0) {
      bullets.push({ x: u.x + u.w/2, y: u.y + u.h, vx: 0, vy: 4, type: 'ufo' });
      u.shootTimer = 50 + Math.floor(Math.random() * 50);
    }
  }
  ufos = ufos.filter(u => u.x > -80);

  // ── move bullets
  for (const b of bullets) { b.x += b.vx; b.y += b.vy; }
  bullets = bullets.filter(b => b.x > -10 && b.x < W + 10 && b.y > -10 && b.y < H + 10);

  // ── bullet vs UFO
  bullets = bullets.filter(b => {
    if (b.type !== 'car' || b.vy >= 0) return true;
    let hit = false;
    for (let i = ufos.length - 1; i >= 0; i--) {
      const u = ufos[i];
      if (b.x >= u.x && b.x <= u.x + u.w && b.y >= u.y && b.y <= u.y + u.h) {
        u.hp--;
        explode(u.x + u.w/2, u.y + u.h/2, C.ufo, 6);
        if (u.hp <= 0) {
          explode(u.x + u.w/2, u.y + u.h/2, C.ufo, 14);
          score += 100;
          ufos.splice(i, 1);
        }
        hit = true;
        break;
      }
    }
    return !hit;
  });

  // ── bullet vs rock
  bullets = bullets.filter(b => {
    if (b.type !== 'car' || b.vy !== 0) return true;
    let hit = false;
    for (let i = rocks.length - 1; i >= 0; i--) {
      const r = rocks[i];
      if (b.x >= r.x && b.x <= r.x + r.w && b.y >= r.y && b.y <= r.y + r.h) {
        explode(r.x + r.w/2, r.y + r.h/2, C.rock, 8);
        score += 50;
        rocks.splice(i, 1);
        hit = true;
        break;
      }
    }
    return !hit;
  });

  // ── car collision with rocks
  if (invincible <= 0) {
    const carLeft = CAR_X + 4, carRight = CAR_X + CAR_W - 4;
    const carTop  = carY,     carBot   = carY + CAR_H + WHEEL_R*2;
    for (const r of rocks) {
      if (carRight > r.x + 2 && carLeft < r.x + r.w - 2 &&
          carBot   > r.y && carTop < r.y + r.h) {
        killCar(); return;
      }
    }

    // car in crater
    const carCX = CAR_X + CAR_W/2;
    for (const c of craters) {
      if (carCX + 10 > c.x && carCX - 10 < c.x + c.w && onGround) {
        killCar(); return;
      }
    }

    // enemy bullet hits car
    for (let i = bullets.length - 1; i >= 0; i--) {
      const b = bullets[i];
      if (b.type !== 'ufo') continue;
      if (b.x >= CAR_X && b.x <= CAR_X + CAR_W && b.y >= carY && b.y <= carBot) {
        bullets.splice(i, 1);
        killCar(); return;
      }
    }
  }

  // ── particles
  for (const p of particles) { p.x += p.vx; p.y += p.vy; p.vy += 0.1; p.life--; }
  particles = particles.filter(p => p.life > 0);
}

function draw() {
  ctx.fillStyle = C.bg;
  ctx.fillRect(0, 0, W, H);

  if (state === 'title') { drawTitle(); return; }

  drawStars();
  drawHUD();
  drawMountains();
  drawGround();

  // rocks
  for (const r of rocks) drawRock(r);

  // UFOs
  for (const u of ufos) drawUfo(u);

  // bullets
  drawBullets();

  // car (flash when invincible)
  const flash = invincible > 0 && Math.floor(invincible / 6) % 2 === 0;
  drawCar(flash);

  // particles
  drawParticles();

  if (state === 'gameover') drawGameOver();

  // score popup
  if (state === 'playing' && score < 50) {
    ctx.fillStyle = C.textDim;
    ctx.font = '11px "Courier New", monospace';
    ctx.textAlign = 'center';
    ctx.fillText('Z = FIRE FWD   X = FIRE UP   SPACE = JUMP', W/2, 18);
    ctx.textAlign = 'left';
  }
}

function loop() {
  update();
  draw();
  requestAnimationFrame(loop);
}

// ─── Input ────────────────────────────────────────────────────────────────────
document.addEventListener('keydown', e => {
  if (e.code === 'Space' || e.key === ' ') { e.preventDefault(); keys.jump = true; }
  if (e.key === 'z' || e.key === 'Z')      { keys.fwd = true; }
  if (e.key === 'x' || e.key === 'X')      { keys.up = true; }

  if (state === 'title') { resetGame(); }
  else if (state === 'gameover' && (e.code === 'Space' || e.key === ' ')) { state = 'title'; initStars(); }
});
document.addEventListener('keyup', e => {
  if (e.code === 'Space' || e.key === ' ') { keys.jump = false; }
  if (e.key === 'z' || e.key === 'Z')      { keys.fwd = false; }
  if (e.key === 'x' || e.key === 'X')      { keys.up = false; }
});

function touchStart(btn) {
  if (btn === 'jump') { keys.jump = true; document.getElementById('btn-jump').classList.add('pressed'); }
  if (btn === 'fwd')  { keys.fwd  = true; document.getElementById('btn-shoot-fwd').classList.add('pressed'); }
  if (btn === 'up')   { keys.up   = true; document.getElementById('btn-shoot-up').classList.add('pressed'); }
  if (state === 'title') resetGame();
  else if (state === 'gameover') { state = 'title'; initStars(); }
}
function touchEnd(btn) {
  if (btn === 'jump') { keys.jump = false; document.getElementById('btn-jump').classList.remove('pressed'); }
  if (btn === 'fwd')  { keys.fwd  = false; document.getElementById('btn-shoot-fwd').classList.remove('pressed'); }
  if (btn === 'up')   { keys.up   = false; document.getElementById('btn-shoot-up').classList.remove('pressed'); }
}

// prevent mobile scroll on canvas
container.addEventListener('touchmove', e => e.preventDefault(), { passive: false });

// ─── Start ────────────────────────────────────────────────────────────────────
initStars();
loop();
</script>
</body>
</html>
