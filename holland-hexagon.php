<?php
// Holland Hexagon — interactive RIASEC career-interest explorer.
// Inspired by Jon's "My Holland Code" post, where he reveals he's CIA/CIR.
$prompts = [
  ['R', 'Spend a Saturday rebuilding a small engine.'],
  ['I', 'Read a long-form essay on prime number theory.'],
  ['A', 'Sketch a comic page from scratch in one sitting.'],
  ['S', 'Tutor a kid through a tough math unit.'],
  ['E', 'Pitch a new product idea to a room of skeptics.'],
  ['C', 'Reconcile a messy spreadsheet down to the cent.'],
  ['R', 'Re-tile a bathroom floor with your own two hands.'],
  ['I', 'Run a tiny experiment to test a hunch you have.'],
  ['A', 'Compose a melody on whatever instrument is nearby.'],
  ['S', 'Lead a small group through a difficult conversation.'],
  ['E', 'Negotiate a better price on a used car.'],
  ['C', 'Organize a closet by color, size, and season.'],
  ['R', 'Hike a backcountry trail with a paper map.'],
  ['I', 'Spend a rainy afternoon down a research rabbit hole.'],
  ['A', 'Photograph a city block at golden hour.'],
  ['S', 'Volunteer at a soup kitchen on a busy Friday night.'],
  ['E', 'Run for a local board, knock on doors, give the speech.'],
  ['C', 'Audit a year of receipts and file every one of them.'],
];
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>The Holland Hexagon — Six Sides of You</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght,SOFT,WONK@9..144,300..900,0..100,0..1&family=IBM+Plex+Mono:wght@400;500;700&family=Caveat:wght@500;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; }
  :root {
    --paper: #f1e7cf;
    --paper-2: #ebdfba;
    --ink: #1f1c17;
    --ink-soft: #4a4338;
    --rule: #2a2620;
    --R: #b54a30;   /* rust    - Realistic    */
    --I: #c8a02b;   /* mustard - Investigative*/
    --A: #d97259;   /* terra   - Artistic     */
    --S: #6e8a3a;   /* olive   - Social       */
    --E: #2c6e7f;   /* teal    - Enterprising */
    --C: #2a3855;   /* navy    - Conventional */
  }
  html, body { margin: 0; padding: 0; }
  body {
    font-family: 'Fraunces', Georgia, serif;
    background: var(--paper);
    color: var(--ink);
    min-height: 100vh;
    background-image:
      radial-gradient(1200px 600px at 90% -10%, rgba(181,74,48,0.10), transparent 60%),
      radial-gradient(900px 500px at -10% 110%, rgba(44,110,127,0.10), transparent 60%),
      url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='160' height='160'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 0.12 0 0 0 0 0.10 0 0 0 0 0.07 0 0 0 0.10 0'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
  }
  .wrap {
    max-width: 760px;
    margin: 0 auto;
    padding: 28px 22px 80px;
  }
  .crest {
    display: flex;
    align-items: center;
    gap: 12px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--ink-soft);
  }
  .crest::before, .crest::after {
    content: ""; flex: 1; height: 1px; background: var(--rule); opacity: 0.5;
  }
  h1 {
    font-family: 'Fraunces', serif;
    font-weight: 900;
    font-variation-settings: "SOFT" 30, "WONK" 1;
    font-size: clamp(44px, 10vw, 78px);
    line-height: 0.92;
    letter-spacing: -0.02em;
    margin: 14px 0 4px;
    text-align: center;
  }
  h1 em {
    font-style: italic;
    font-weight: 300;
    color: var(--R);
  }
  .sub {
    text-align: center;
    font-style: italic;
    font-size: clamp(15px, 3.4vw, 19px);
    color: var(--ink-soft);
    margin: 0 0 6px;
    font-weight: 400;
  }
  .byline {
    text-align: center;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 22px;
  }
  .panel {
    background: var(--paper-2);
    border: 1.5px solid var(--rule);
    border-radius: 6px;
    box-shadow:
      6px 6px 0 var(--rule),
      inset 0 0 0 4px var(--paper-2),
      inset 0 0 0 5px var(--rule);
    padding: 20px 18px;
    margin: 18px 0;
    position: relative;
  }
  .panel-label {
    position: absolute;
    top: -10px; left: 16px;
    background: var(--paper);
    padding: 0 8px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--ink);
  }

  /* Hexagon */
  .hex-stage {
    display: flex; flex-direction: column; align-items: center;
    gap: 10px;
  }
  svg.hex {
    width: 100%;
    max-width: 360px;
    height: auto;
    overflow: visible;
  }
  .grid-line { fill: none; stroke: var(--rule); stroke-width: 1; opacity: 0.25; }
  .axis-line { stroke: var(--rule); stroke-width: 1; opacity: 0.4; stroke-dasharray: 2 3; }
  .radar {
    fill: rgba(181,74,48,0.32);
    stroke: var(--R);
    stroke-width: 2;
    stroke-linejoin: round;
    transition: d 380ms cubic-bezier(.2,.9,.3,1.2);
    filter: drop-shadow(2px 2px 0 rgba(31,28,23,0.35));
  }
  .vertex { fill: var(--paper); stroke: var(--rule); stroke-width: 1.5; }
  .vertex.active { stroke-width: 2.5; }
  .v-label {
    font-family: 'Fraunces', serif;
    font-weight: 800;
    font-size: 18px;
    text-anchor: middle;
    dominant-baseline: middle;
  }
  .v-name {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 8px;
    letter-spacing: 0.18em;
    text-anchor: middle;
    fill: var(--ink-soft);
    text-transform: uppercase;
  }

  /* Quiz */
  .progress {
    display: flex; align-items: center; gap: 10px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--ink-soft);
    margin-bottom: 12px;
  }
  .bar {
    flex: 1; height: 4px; background: rgba(31,28,23,0.15); border-radius: 2px; overflow: hidden;
  }
  .bar > span { display:block; height: 100%; background: var(--ink); width: 0%; transition: width 280ms ease; }

  .card {
    background: var(--paper);
    border: 1.5px solid var(--rule);
    border-radius: 4px;
    padding: 26px 22px 22px;
    text-align: center;
    box-shadow: 4px 4px 0 var(--rule);
    min-height: 180px;
    display: flex; align-items: center; justify-content: center;
    position: relative;
  }
  .card .num {
    position: absolute;
    top: 8px; right: 12px;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.2em;
    color: var(--ink-soft);
  }
  .card .stamp {
    position: absolute; top: 10px; left: 12px;
    font-family: 'IBM Plex Mono', monospace; font-size: 9px; letter-spacing: 0.25em;
    color: var(--ink-soft); text-transform: uppercase;
  }
  .card .prompt-text {
    font-family: 'Fraunces', serif;
    font-style: italic;
    font-weight: 400;
    font-size: clamp(20px, 5vw, 26px);
    line-height: 1.25;
    max-width: 28ch;
  }

  .actions {
    display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
    margin-top: 14px;
  }
  .btn {
    appearance: none; -webkit-appearance: none;
    border: 1.5px solid var(--rule);
    background: var(--paper);
    color: var(--ink);
    font-family: 'IBM Plex Mono', monospace;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    padding: 16px 12px;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 3px 3px 0 var(--rule);
    transition: transform 80ms ease, box-shadow 80ms ease, background 200ms;
    touch-action: manipulation;
  }
  .btn:hover { background: #f6ecd4; }
  .btn:active { transform: translate(2px,2px); box-shadow: 1px 1px 0 var(--rule); }
  .btn.love { background: var(--R); color: var(--paper); border-color: var(--rule); }
  .btn.nope { background: var(--paper); color: var(--ink); }
  .btn .glyph { font-family: 'Caveat', cursive; font-weight: 700; font-size: 22px; margin-right: 6px; vertical-align: -3px; }

  .tally {
    display: grid; grid-template-columns: repeat(6, 1fr); gap: 6px;
    margin-top: 14px;
  }
  .tally .col {
    text-align: center;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px;
    letter-spacing: 0.12em;
    color: var(--ink-soft);
  }
  .tally .col .letter {
    display: block;
    font-family: 'Fraunces', serif;
    font-weight: 900;
    font-size: 20px;
    line-height: 1;
    margin-bottom: 4px;
    color: var(--ink);
  }
  .tally .col .meter {
    height: 4px; background: rgba(31,28,23,0.12); border-radius: 2px; margin-top: 4px; overflow: hidden;
  }
  .tally .col .meter > span { display:block; height:100%; width:0%; transition: width 320ms ease; }

  /* Result */
  #result { display: none; }
  .code-display {
    text-align: center;
    font-family: 'Fraunces', serif;
    font-weight: 900;
    font-size: clamp(72px, 18vw, 130px);
    letter-spacing: 0.04em;
    line-height: 0.9;
    margin: 8px 0 6px;
    font-variation-settings: "SOFT" 50, "WONK" 1;
  }
  .code-display .slot { display: inline-block; min-width: 1ch; }
  .code-display .slot:nth-child(1) { color: var(--c1, var(--ink)); transform: rotate(-2deg); display:inline-block; }
  .code-display .slot:nth-child(2) { color: var(--c2, var(--ink)); transform: rotate(1.5deg); display:inline-block; }
  .code-display .slot:nth-child(3) { color: var(--c3, var(--ink)); transform: rotate(-1deg); display:inline-block; }
  .code-caption { text-align: center; font-style: italic; color: var(--ink-soft); margin-top: -2px; }

  .types-list { display: flex; flex-direction: column; gap: 14px; }
  .type-row {
    display: grid;
    grid-template-columns: 56px 1fr;
    gap: 14px;
    align-items: start;
    padding: 12px;
    border: 1px dashed var(--rule);
    border-radius: 4px;
    background: rgba(255,255,255,0.25);
  }
  .type-badge {
    width: 56px; height: 56px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Fraunces', serif; font-weight: 900; font-size: 28px; color: #f4ead5;
    border: 2px solid var(--rule);
    box-shadow: 2px 2px 0 var(--rule);
  }
  .type-row h3 {
    margin: 2px 0 4px;
    font-family: 'Fraunces', serif;
    font-weight: 700;
    font-size: 18px;
  }
  .type-row .careers {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px;
    color: var(--ink-soft);
    margin-top: 6px;
    letter-spacing: 0.05em;
  }
  .type-row p { margin: 0; line-height: 1.45; font-size: 15px; }

  .restart {
    display: block;
    margin: 22px auto 0;
    background: var(--ink);
    color: var(--paper);
    padding: 14px 22px;
  }
  .restart:hover { background: var(--R); color: var(--paper); }

  .footer {
    margin-top: 38px;
    text-align: center;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--ink-soft);
  }
  .footer a { color: var(--ink); text-decoration: none; border-bottom: 1px solid var(--ink-soft); }
  .jon-note {
    margin-top: 16px;
    font-family: 'Caveat', cursive;
    font-size: 18px;
    text-align: center;
    color: var(--ink);
    transform: rotate(-1deg);
  }

  /* swipe animation */
  .card.swipe-yes { animation: swipeYes 360ms forwards; }
  .card.swipe-no  { animation: swipeNo  360ms forwards; }
  @keyframes swipeYes {
    to { transform: translate(60vw, -20px) rotate(8deg); opacity: 0; }
  }
  @keyframes swipeNo {
    to { transform: translate(-60vw, -20px) rotate(-8deg); opacity: 0; }
  }
  .card.enter { animation: enterCard 320ms ease-out; }
  @keyframes enterCard {
    from { transform: translateY(12px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
  }

  @media (max-width: 420px) {
    .panel { padding: 18px 14px; }
    .type-row { grid-template-columns: 44px 1fr; gap: 10px; }
    .type-badge { width: 44px; height: 44px; font-size: 22px; }
  }
</style>
</head>
<body>
<div class="wrap">
  <div class="crest">No. 47 · Chloe Reads Jon · Vol. ’26</div>
  <h1>The Holland <em>Hexagon</em></h1>
  <p class="sub">Six sides of you, in the time it takes to brew a cup of tea.</p>
  <div class="byline">A career-interest atlas · after John L. Holland, 1959</div>

  <!-- Hexagon panel -->
  <div class="panel">
    <span class="panel-label">Live Reading</span>
    <div class="hex-stage">
      <svg class="hex" viewBox="-150 -150 300 300" aria-hidden="true">
        <!-- Concentric guide hexagons -->
        <g id="grid"></g>
        <!-- Spokes -->
        <g id="spokes"></g>
        <!-- Filled radar polygon -->
        <polygon id="radar" class="radar" points=""></polygon>
        <!-- Vertex dots and labels -->
        <g id="vertices"></g>
      </svg>
      <div class="tally" id="tally"></div>
    </div>
  </div>

  <!-- Quiz -->
  <div class="panel" id="quiz">
    <span class="panel-label">Prompt</span>
    <div class="progress">
      <span id="progressText">01 / 18</span>
      <div class="bar"><span id="progressBar"></span></div>
    </div>
    <div class="card enter" id="card">
      <div class="stamp" id="cardStamp">— · —</div>
      <div class="num" id="cardNum">01</div>
      <div class="prompt-text" id="cardText">Loading…</div>
    </div>
    <div class="actions">
      <button class="btn nope" id="btnNo"><span class="glyph">✕</span>Not me</button>
      <button class="btn love" id="btnYes"><span class="glyph">♥</span>Love it</button>
    </div>
  </div>

  <!-- Result -->
  <div class="panel" id="result">
    <span class="panel-label">Your Code</span>
    <div class="code-display" id="codeDisplay"></div>
    <div class="code-caption" id="codeCaption"></div>
    <div class="types-list" id="typesList"></div>
    <div class="jon-note" id="jonNote"></div>
    <button class="btn restart" id="btnRestart">Run it again</button>
  </div>

  <p class="footer">
    <a href="./">Back to Chloe Reads Jon</a>
  </p>
</div>

<script>
const PROMPTS = <?php echo json_encode($prompts); ?>;
const TYPES = {
  R: { name: 'Realistic',     color: 'var(--R)', tag: 'The Doer',
       blurb: 'Hands-on, practical, at home with tools, machines, and the outdoors. Likes problems with bolts and grain on them.',
       careers: 'engineer · electrician · pilot · farmer · paramedic · woodworker' },
  I: { name: 'Investigative',  color: 'var(--I)', tag: 'The Thinker',
       blurb: 'Curious and analytical. Lives for puzzles, theories, and quiet hours of going down a rabbit hole until something clicks.',
       careers: 'researcher · software engineer · physicist · doctor · data scientist · librarian' },
  A: { name: 'Artistic',       color: 'var(--A)', tag: 'The Creator',
       blurb: 'Original, expressive, allergic to rigid systems. Wants to make something that did not exist before breakfast.',
       careers: 'writer · designer · musician · architect · photographer · animator' },
  S: { name: 'Social',         color: 'var(--S)', tag: 'The Helper',
       blurb: 'Drawn to people. Teaches, listens, mediates, and finds energy in helping someone else figure their thing out.',
       careers: 'teacher · counselor · nurse · pastor · social worker · coach' },
  E: { name: 'Enterprising',   color: 'var(--E)', tag: 'The Persuader',
       blurb: 'Leads, sells, ships, decides. Comfortable taking risks and rallying a room toward a goal nobody can see yet.',
       careers: 'entrepreneur · lawyer · sales lead · politician · producer · manager' },
  C: { name: 'Conventional',   color: 'var(--C)', tag: 'The Organizer',
       blurb: 'Detail-oriented and orderly. Finds genuine peace in a clean spreadsheet, a tidy ledger, and a system that just works.',
       careers: 'accountant · analyst · editor · operations · archivist · QA engineer' },
};
const ORDER = ['R','I','A','S','E','C']; // clockwise around the hexagon
const RADIUS = 110;

// Build hexagon vertices: R at top, then clockwise
const vertices = ORDER.map((k, i) => {
  const angle = -Math.PI/2 + i * (Math.PI/3); // start at top, step 60°
  return { key: k, x: Math.cos(angle)*RADIUS, y: Math.sin(angle)*RADIUS, angle };
});

// Render grid + spokes + vertices
(function renderHex(){
  const grid = document.getElementById('grid');
  const spokes = document.getElementById('spokes');
  const verts = document.getElementById('vertices');

  // 3 concentric hexagons
  for (let r = 1; r <= 3; r++) {
    const pts = vertices.map(v => `${(v.x*r/3).toFixed(1)},${(v.y*r/3).toFixed(1)}`).join(' ');
    const poly = document.createElementNS('http://www.w3.org/2000/svg','polygon');
    poly.setAttribute('class','grid-line');
    poly.setAttribute('points', pts);
    grid.appendChild(poly);
  }
  // Spokes
  vertices.forEach(v => {
    const ln = document.createElementNS('http://www.w3.org/2000/svg','line');
    ln.setAttribute('class','axis-line');
    ln.setAttribute('x1', 0); ln.setAttribute('y1', 0);
    ln.setAttribute('x2', v.x); ln.setAttribute('y2', v.y);
    spokes.appendChild(ln);
  });
  // Vertex dots and labels
  vertices.forEach(v => {
    const cx = v.x, cy = v.y;
    const c = document.createElementNS('http://www.w3.org/2000/svg','circle');
    c.setAttribute('class','vertex');
    c.setAttribute('id','vx-'+v.key);
    c.setAttribute('cx', cx); c.setAttribute('cy', cy); c.setAttribute('r', 16);
    c.setAttribute('fill', getComputedStyle(document.documentElement).getPropertyValue('--'+v.key));
    verts.appendChild(c);

    const t = document.createElementNS('http://www.w3.org/2000/svg','text');
    t.setAttribute('class','v-label');
    t.setAttribute('x', cx); t.setAttribute('y', cy);
    t.setAttribute('fill', '#f4ead5');
    t.textContent = v.key;
    verts.appendChild(t);

    // Outer name label
    const ox = cx * 1.32, oy = cy * 1.32 + (Math.abs(cy) < 1 ? 0 : 0);
    const nameLabel = document.createElementNS('http://www.w3.org/2000/svg','text');
    nameLabel.setAttribute('class','v-name');
    nameLabel.setAttribute('x', ox);
    nameLabel.setAttribute('y', oy + (cy < 0 ? -4 : 12));
    nameLabel.textContent = TYPES[v.key].name;
    verts.appendChild(nameLabel);
  });
})();

// Tally bars
(function renderTally(){
  const t = document.getElementById('tally');
  ORDER.forEach(k => {
    const col = document.createElement('div');
    col.className = 'col';
    col.innerHTML = `
      <span class="letter" style="color: var(--${k})">${k}</span>
      <span>${TYPES[k].name.slice(0,4).toUpperCase()}</span>
      <div class="meter"><span id="meter-${k}" style="background: var(--${k})"></span></div>
    `;
    t.appendChild(col);
  });
})();

// State
const counts = { R:0, I:0, A:0, S:0, E:0, C:0 };
const maxPerType = ORDER.reduce((acc,k)=>{
  acc[k] = PROMPTS.filter(p=>p[0]===k).length; return acc;
}, {});
let idx = 0;
let answering = false;

const card = document.getElementById('card');
const cardText = document.getElementById('cardText');
const cardNum = document.getElementById('cardNum');
const cardStamp = document.getElementById('cardStamp');
const progressText = document.getElementById('progressText');
const progressBar = document.getElementById('progressBar');
const radar = document.getElementById('radar');

function pad(n){ return n < 10 ? '0'+n : ''+n; }

function showPrompt() {
  if (idx >= PROMPTS.length) { return finish(); }
  const [type, text] = PROMPTS[idx];
  cardText.textContent = text;
  cardNum.textContent = pad(idx+1);
  cardStamp.textContent = '— Prompt ' + pad(idx+1) + ' —';
  progressText.textContent = pad(idx+1) + ' / ' + pad(PROMPTS.length);
  progressBar.style.width = ((idx) / PROMPTS.length * 100) + '%';
  card.classList.remove('swipe-yes','swipe-no','enter');
  // force reflow to restart animation
  void card.offsetWidth;
  card.classList.add('enter');
}

function updateRadar() {
  // Each axis value: counts[k] / maxPerType[k] (0..1) → mapped to RADIUS
  const pts = vertices.map(v => {
    const val = counts[v.key] / Math.max(1, maxPerType[v.key]);
    const r = val * RADIUS;
    return [(v.x/RADIUS)*r, (v.y/RADIUS)*r];
  });
  radar.setAttribute('points', pts.map(p => p[0].toFixed(1)+','+p[1].toFixed(1)).join(' '));
  ORDER.forEach(k => {
    const m = document.getElementById('meter-'+k);
    if (m) m.style.width = (counts[k] / maxPerType[k] * 100) + '%';
  });
}

function answer(yes) {
  if (answering || idx >= PROMPTS.length) return;
  answering = true;
  const [type] = PROMPTS[idx];
  if (yes) counts[type] += 1;
  updateRadar();
  card.classList.add(yes ? 'swipe-yes' : 'swipe-no');
  setTimeout(() => {
    idx += 1;
    answering = false;
    if (idx >= PROMPTS.length) {
      progressBar.style.width = '100%';
      finish();
    } else {
      showPrompt();
    }
  }, 320);
}

document.getElementById('btnYes').addEventListener('click', () => answer(true));
document.getElementById('btnNo').addEventListener('click', () => answer(false));

// Keyboard support
document.addEventListener('keydown', (e) => {
  if (document.getElementById('quiz').style.display === 'none') return;
  if (e.key === 'ArrowRight' || e.key.toLowerCase() === 'y') answer(true);
  else if (e.key === 'ArrowLeft' || e.key.toLowerCase() === 'n') answer(false);
});

// Touch swipe
let touchStartX = null;
card.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, {passive:true});
card.addEventListener('touchend', (e) => {
  if (touchStartX === null) return;
  const dx = e.changedTouches[0].clientX - touchStartX;
  if (Math.abs(dx) > 60) answer(dx > 0);
  touchStartX = null;
}, {passive:true});

function finish() {
  // Sort types by count desc, ties broken by Holland's hexagonal order
  const sorted = ORDER.slice().sort((a,b) => counts[b] - counts[a] || ORDER.indexOf(a) - ORDER.indexOf(b));
  const top3 = sorted.slice(0, 3);

  // Hide quiz, show result
  document.getElementById('quiz').style.display = 'none';
  const result = document.getElementById('result');
  result.style.display = 'block';

  // Code display with colors
  const codeEl = document.getElementById('codeDisplay');
  codeEl.innerHTML = top3.map(k => `<span class="slot" style="color: var(--${k})">${k}</span>`).join('');
  document.getElementById('codeCaption').textContent =
    `${TYPES[top3[0]].name} · ${TYPES[top3[1]].name} · ${TYPES[top3[2]].name}`;

  // Type list
  const list = document.getElementById('typesList');
  list.innerHTML = '';
  top3.forEach(k => {
    const row = document.createElement('div');
    row.className = 'type-row';
    row.innerHTML = `
      <div class="type-badge" style="background: var(--${k})">${k}</div>
      <div>
        <h3>${TYPES[k].name} <span style="font-weight:400; font-style:italic; color: var(--ink-soft); font-size:14px;">— ${TYPES[k].tag}</span></h3>
        <p>${TYPES[k].blurb}</p>
        <div class="careers">${TYPES[k].careers}</div>
      </div>
    `;
    list.appendChild(row);
  });

  // Jon note
  const code = top3.join('');
  const jonNote = document.getElementById('jonNote');
  if (code === 'CIA' || code === 'CIR') {
    jonNote.textContent = `✶ same code as Jon — ${code} ✶`;
  } else {
    jonNote.textContent = `(For reference: Jon's is CIA / CIR.)`;
  }

  // Pretty radar pulse
  radar.style.transition = 'd 600ms ease, fill 600ms ease, stroke 600ms ease';
  radar.style.fill = `color-mix(in srgb, var(--${top3[0]}) 38%, transparent)`;
  radar.style.stroke = `var(--${top3[0]})`;
}

document.getElementById('btnRestart').addEventListener('click', () => {
  ORDER.forEach(k => counts[k] = 0);
  idx = 0;
  updateRadar();
  document.getElementById('result').style.display = 'none';
  document.getElementById('quiz').style.display = 'block';
  radar.style.fill = ''; radar.style.stroke = '';
  showPrompt();
});

// Initial paint
updateRadar();
showPrompt();
</script>
</body>
</html>
