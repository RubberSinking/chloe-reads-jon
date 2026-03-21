<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<title>Capilano Bridge Challenge</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
    background: linear-gradient(180deg, #87ceeb 0%, #b0e0a8 60%, #4a7c3f 100%);
    min-height: 100vh;
    font-family: Arial, sans-serif;
    overflow: hidden;
    user-select: none;
}
#game {
    position: relative;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}

/* Sky & trees */
.tree { position: absolute; bottom: 0; font-size: 80px; }

/* Canyon */
#canyon {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 260px;
    height: 45vh;
    background: linear-gradient(180deg, #2d5a1b 0%, #1a3a0f 100%);
    border-radius: 0 0 30px 30px;
}

/* Bridge posts */
.post {
    position: absolute;
    bottom: 45vh;
    width: 22px;
    background: #8B5E3C;
    border-radius: 4px 4px 0 0;
}
#post-left  { left: calc(50% - 130px - 11px); height: 90px; }
#post-right { left: calc(50% + 130px - 11px); height: 90px; }

/* Bridge plank (sways via JS) */
#bridge {
    position: absolute;
    bottom: calc(45vh + 14px);
    left: 50%;
    transform: translateX(-50%) rotate(0deg);
    width: 260px;
    height: 18px;
    background: repeating-linear-gradient(90deg, #8B5E3C 0, #8B5E3C 30px, #6b4423 30px, #6b4423 36px);
    border-radius: 3px;
    transform-origin: center center;
    transition: transform 0.12s ease;
}

/* Ropes */
.rope {
    position: absolute;
    width: 2px;
    background: #8B5E3C;
    transform-origin: top center;
}

/* Nathan */
#nathan {
    position: absolute;
    font-size: 52px;
    bottom: calc(45vh + 28px);
    left: 50%;
    transform: translateX(-60px);
    transition: bottom 0.12s ease;
    cursor: pointer;
    animation: idle 2s ease-in-out infinite;
    z-index: 10;
}
@keyframes idle { 0%,100%{transform: translateX(-60px) scaleY(1)} 50%{transform: translateX(-60px) scaleY(0.97)} }
#nathan.jumping {
    animation: none;
}

/* Dad */
#dad {
    position: absolute;
    font-size: 52px;
    bottom: calc(45vh + 28px);
    left: 50%;
    transform: translateX(10px);
    z-index: 10;
    transition: transform 0.1s;
}

/* Scream bubble */
#scream {
    position: absolute;
    bottom: calc(45vh + 90px);
    left: 50%;
    transform: translateX(30px);
    background: white;
    border: 3px solid #333;
    border-radius: 20px;
    padding: 8px 14px;
    font-size: 1.1em;
    font-weight: bold;
    white-space: nowrap;
    opacity: 0;
    transition: opacity 0.15s;
    z-index: 20;
}
#scream::after {
    content: '';
    position: absolute;
    bottom: -14px;
    left: 12px;
    border: 7px solid transparent;
    border-top-color: #333;
}
#scream::before {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 13px;
    border: 6px solid transparent;
    border-top-color: white;
    z-index: 1;
}
#scream.show { opacity: 1; }

/* Jump button */
#jump-btn {
    position: fixed;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    background: #e8a820;
    color: #1a1108;
    border: none;
    border-radius: 50px;
    padding: 18px 48px;
    font-size: 1.4em;
    font-weight: 900;
    cursor: pointer;
    box-shadow: 0 4px 18px rgba(0,0,0,0.3);
    z-index: 100;
    -webkit-tap-highlight-color: transparent;
    transition: transform 0.1s, background 0.1s;
}
#jump-btn:active { transform: translateX(-50%) scale(0.95); background: #d4941a; }

/* Score */
#score-box {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.5);
    color: white;
    padding: 10px 28px;
    border-radius: 30px;
    font-size: 1.2em;
    font-weight: bold;
    z-index: 100;
}

/* Water at bottom of canyon */
#water {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 240px;
    height: 60px;
    background: linear-gradient(180deg, #4fc3f7, #0288d1);
    border-radius: 8px;
    opacity: 0.8;
}

/* Stars for big scare */
.star {
    position: absolute;
    font-size: 24px;
    pointer-events: none;
    animation: fly 0.8s ease-out forwards;
    z-index: 30;
}
@keyframes fly {
    from { transform: scale(0) rotate(0deg); opacity: 1; }
    to   { transform: scale(1.5) rotate(360deg) translateY(-60px); opacity: 0; }
}
</style>
</head>
<body>
<div id="game">
    <!-- Trees -->
    <div class="tree" style="left:2%; font-size:100px">🌲</div>
    <div class="tree" style="left:8%">🌲</div>
    <div class="tree" style="left:14%; font-size:90px">🌲</div>
    <div class="tree" style="right:2%; font-size:100px">🌲</div>
    <div class="tree" style="right:8%">🌲</div>
    <div class="tree" style="right:14%; font-size:90px">🌲</div>

    <!-- Canyon -->
    <div id="canyon"><div id="water"></div></div>

    <!-- Posts -->
    <div class="post" id="post-left"></div>
    <div class="post" id="post-right"></div>

    <!-- Bridge -->
    <div id="bridge"></div>

    <!-- Characters -->
    <div id="dad">😊</div>
    <div id="nathan">🧒</div>

    <!-- Speech bubble -->
    <div id="scream">AAAHH! 😱</div>
</div>

<div id="score-box">Screams: <span id="score">0</span></div>
<button id="jump-btn">🦘 JUMP!</button>

<script>
const screams = [
    "AAAHH! 😱",
    "NOT AGAIN! 😰",
    "NAAATHAN!! 😤",
    "OH NO NO NO! 😨",
    "WHY?! 😖",
    "HOLD ON! 😬",
    "THE BRIDGE! 😩",
    "I'M GONNA FALL! 😫",
    "NOOOO! 🙈",
    "NATHANNN!! 🫨",
];

let score = 0;
let swagging = false;
let nathanJumping = false;
let screamTimeout = null;

const nathan = document.getElementById('nathan');
const dad = document.getElementById('dad');
const bridge = document.getElementById('bridge');
const screamEl = document.getElementById('scream');
const scoreEl = document.getElementById('score');
const jumpBtn = document.getElementById('jump-btn');

function jump() {
    if (nathanJumping) return;
    nathanJumping = true;

    // Nathan jumps
    nathan.classList.add('jumping');
    const baseBottom = parseFloat(getComputedStyle(nathan).bottom);
    nathan.style.bottom = (baseBottom + 60) + 'px';
    nathan.style.transition = 'bottom 0.22s cubic-bezier(.17,.67,.42,1.5)';

    setTimeout(() => {
        nathan.style.bottom = '';
        nathan.style.transition = 'bottom 0.18s ease-in';
        setTimeout(() => {
            nathan.style.transition = '';
            nathan.classList.remove('jumping');
            nathanJumping = false;
        }, 200);
    }, 280);

    // Bridge sways
    swayBridge();

    // Dad screams
    screamDad();
}

function swayBridge() {
    const angles = [3, -5, 4, -3, 2, -1, 0];
    let i = 0;
    const interval = setInterval(() => {
        if (i >= angles.length) { clearInterval(interval); bridge.style.transform = 'translateX(-50%) rotate(0deg)'; return; }
        bridge.style.transform = `translateX(-50%) rotate(${angles[i]}deg)`;
        i++;
    }, 120);
}

function screamDad() {
    score++;
    scoreEl.textContent = score;

    // Pick scream
    const msg = screams[Math.floor(Math.random() * screams.length)];
    screamEl.textContent = msg;
    screamEl.classList.add('show');
    dad.textContent = '😱';

    // Shake dad
    dad.style.transform = 'translateX(10px) rotate(-8deg)';
    setTimeout(() => { dad.style.transform = 'translateX(10px) rotate(6deg)'; }, 100);
    setTimeout(() => { dad.style.transform = 'translateX(10px) rotate(-4deg)'; }, 200);
    setTimeout(() => { dad.style.transform = 'translateX(10px) rotate(0)'; dad.textContent = '😅'; }, 350);
    setTimeout(() => { dad.textContent = '😊'; }, 1200);

    // Emit stars on milestone
    if (score % 5 === 0) emitStars();

    // Hide scream
    if (screamTimeout) clearTimeout(screamTimeout);
    screamTimeout = setTimeout(() => {
        screamEl.classList.remove('show');
    }, 1000);
}

function emitStars() {
    const emojis = ['⭐','💫','✨','🌟'];
    for (let i = 0; i < 5; i++) {
        setTimeout(() => {
            const star = document.createElement('div');
            star.className = 'star';
            star.textContent = emojis[Math.floor(Math.random() * emojis.length)];
            star.style.left = (40 + Math.random() * 25) + '%';
            star.style.bottom = (50 + Math.random() * 15) + 'vh';
            document.getElementById('game').appendChild(star);
            setTimeout(() => star.remove(), 900);
        }, i * 80);
    }
}

jumpBtn.addEventListener('click', jump);
document.addEventListener('keydown', e => { if (e.code === 'Space') { e.preventDefault(); jump(); } });
</script>
</body>
</html>
