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
.tree { position: absolute; bottom: 0; font-size: 80px; }

#canyon {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 260px;
    height: 45vh;
    background: linear-gradient(180deg, #2d5a1b 0%, #1a3a0f 100%);
    border-radius: 0 0 30px 30px;
    transition: width 1s ease;
}

.post {
    position: absolute;
    bottom: 45vh;
    width: 22px;
    background: #8B5E3C;
    border-radius: 4px 4px 0 0;
    transition: left 1s ease;
}
#post-left  { left: calc(50% - 130px - 11px); height: 90px; }
#post-right { left: calc(50% + 130px - 11px); height: 90px; }

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
    transition: width 1s ease, transform 0.12s ease;
}

#dad {
    position: absolute;
    font-size: 52px;
    bottom: calc(45vh + 28px);
    left: 50%;
    transform: translateX(10px);
    z-index: 10;
    transition: transform 0.1s;
}
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
@keyframes idle { 0%,100%{transform:translateX(-60px) scaleY(1)} 50%{transform:translateX(-60px) scaleY(0.97)} }
#nathan.jumping { animation: none; }

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
#scream::after { content:''; position:absolute; bottom:-14px; left:12px; border:7px solid transparent; border-top-color:#333; }
#scream::before { content:''; position:absolute; bottom:-10px; left:13px; border:6px solid transparent; border-top-color:white; z-index:1; }
#scream.show { opacity: 1; }

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

#score-box {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0,0,0,0.55);
    color: white;
    padding: 10px 28px;
    border-radius: 30px;
    font-size: 1.2em;
    font-weight: bold;
    z-index: 100;
    text-align: center;
}
#next-upgrade {
    font-size: 0.7em;
    color: #ffd700;
    margin-top: 2px;
}

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

.star {
    position: absolute;
    font-size: 24px;
    pointer-events: none;
    animation: fly 0.8s ease-out forwards;
    z-index: 30;
}
@keyframes fly { from{transform:scale(0) rotate(0deg);opacity:1} to{transform:scale(1.5) rotate(360deg) translateY(-60px);opacity:0} }

/* Upgrade popup */
#upgrade-popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    background: linear-gradient(135deg, #1a1108, #3d2a0a);
    border: 3px solid #e8a820;
    border-radius: 24px;
    padding: 32px 40px;
    text-align: center;
    color: white;
    z-index: 200;
    min-width: 300px;
    transition: transform 0.3s cubic-bezier(.17,.67,.42,1.5);
    box-shadow: 0 8px 40px rgba(0,0,0,0.6);
}
#upgrade-popup.show { transform: translate(-50%, -50%) scale(1); }
#upgrade-popup h2 { color: #e8a820; font-size: 1.6em; margin-bottom: 8px; }
#upgrade-popup .icon { font-size: 3em; margin-bottom: 12px; }
#upgrade-popup p { color: #f0e4cc; margin-bottom: 20px; font-size: 1.05em; }
#upgrade-popup button {
    background: #e8a820; color: #1a1108; border: none;
    border-radius: 30px; padding: 12px 36px; font-size: 1.1em;
    font-weight: 900; cursor: pointer;
}

/* Permanent scream mode */
body.chaos #dad { animation: dadshake 0.15s infinite; }
@keyframes dadshake { 0%{transform:translateX(10px) rotate(-5deg)} 50%{transform:translateX(10px) rotate(5deg)} 100%{transform:translateX(10px) rotate(-5deg)} }
body.chaos #bridge { animation: bridgeshake 0.2s infinite; }
@keyframes bridgeshake { 0%{transform:translateX(-50%) rotate(-4deg)} 50%{transform:translateX(-50%) rotate(4deg)} 100%{transform:translateX(-50%) rotate(-4deg)} }
body.chaos #scream { opacity: 1 !important; }
body.chaos { background: linear-gradient(180deg, #ff6b35 0%, #b0e0a8 60%, #4a7c3f 100%) !important; }
</style>
</head>
<body>
<div id="game">
    <div class="tree" style="left:2%;font-size:100px">🌲</div>
    <div class="tree" style="left:8%">🌲</div>
    <div class="tree" style="left:14%;font-size:90px">🌲</div>
    <div class="tree" style="right:2%;font-size:100px">🌲</div>
    <div class="tree" style="right:8%">🌲</div>
    <div class="tree" style="right:14%;font-size:90px">🌲</div>

    <div id="canyon"><div id="water"></div></div>
    <div class="post" id="post-left"></div>
    <div class="post" id="post-right"></div>
    <div id="bridge"></div>
    <div id="dad">😊</div>
    <div id="nathan">🧒</div>
    <div id="scream">AAAHH! 😱</div>
</div>

<div id="score-box">
    Screams: <span id="score">0</span>
    <div id="next-upgrade">Next upgrade at 100 🔒</div>
</div>
<button id="jump-btn">🦘 JUMP!</button>

<div id="upgrade-popup">
    <div class="icon" id="up-icon">⭐</div>
    <h2 id="up-title">UPGRADE!</h2>
    <p id="up-desc">Something got better!</p>
    <button onclick="closeUpgrade()">LET'S GO! 🔥</button>
</div>

<script>
// === SCREAMS ===
let screams = [
    "AAAHH! 😱","NOT AGAIN! 😰","OH NO NO NO! 😨",
    "WHY?! 😖","HOLD ON! 😬","THE BRIDGE! 😩",
    "I'M GONNA FALL! 😫","NATHANNN!! 🫨","HELP! 😵",
    "NOT THE BRIDGE! 😤",
];
const bonusScreams = [
    "SOMEBODY CALL 911! 🚨","I REGRET THIS VACATION! 😭",
    "CALL YOUR MOTHER! 📱","I'M TOO OLD FOR THIS! 👴",
    "THIS WAS NOT IN THE BROCHURE! 📄","MY KNEES!! 🦵",
    "NOOOO THE CAPILANO RIVER!! 💧","TELL CHLOE I SAID GOODBYE! 🤖",
    "NATHANNN YOU LITTLE!! 😤","I'M WRITING IN MY DIARY ABOUT THIS!! 📓",
];

// === STATE ===
let score = 0;
let nathanJumping = false;
let screamTimeout = null;
let upgradesPending = [];
let chaosMode = false;

// Upgrade flags
let screamDuration = 1000;   // ms
let shakeAngles = [3,-5,4,-3,2,-1,0];
let bridgeWidth = 260;        // px

const UPGRADES = [
    { at: 100, icon: '⏱️', title: 'LONGER SCREAMS!', desc: 'Dad screams last twice as long. He really needs a minute.' },
    { at: 200, icon: '🌉', title: 'MEGA SHAKE!', desc: 'The bridge now shakes like a washing machine. Dad is reconsidering his life choices.' },
    { at: 300, icon: '📏', title: 'BRIDGE EXTENSION!', desc: 'The bridge got longer! More room to bounce. Less room for Dad to feel safe.' },
    { at: 400, icon: '🗣️', title: 'NEW SCREAMS UNLOCKED!', desc: '10 new extra-dramatic screams added. Dad has never felt so understood.' },
    { at: 500, icon: '🔴', title: 'PERMANENT SCREAM MODE!!', desc: 'Dad will now scream forever. You have won. Nathan wins.' },
];

// === DOM ===
const nathan = document.getElementById('nathan');
const dad = document.getElementById('dad');
const bridge = document.getElementById('bridge');
const screamEl = document.getElementById('scream');
const scoreEl = document.getElementById('score');
const jumpBtn = document.getElementById('jump-btn');
const nextUpgradeEl = document.getElementById('next-upgrade');
const popup = document.getElementById('upgrade-popup');

// === JUMP ===
function jump() {
    if (nathanJumping || upgradesPending.length > 0) return;
    nathanJumping = true;
    nathan.classList.add('jumping');
    const base = parseFloat(getComputedStyle(nathan).bottom);
    nathan.style.bottom = (base + 60) + 'px';
    nathan.style.transition = 'bottom 0.22s cubic-bezier(.17,.67,.42,1.5)';
    setTimeout(() => {
        nathan.style.bottom = '';
        nathan.style.transition = 'bottom 0.18s ease-in';
        setTimeout(() => { nathan.style.transition=''; nathan.classList.remove('jumping'); nathanJumping=false; }, 200);
    }, 280);
    swayBridge();
    screamDad();
}

function swayBridge() {
    let angles = [...shakeAngles];
    let i = 0;
    const iv = setInterval(() => {
        if (i >= angles.length) { clearInterval(iv); bridge.style.transform=`translateX(-50%) rotate(0deg)`; return; }
        bridge.style.transform = `translateX(-50%) rotate(${angles[i]}deg)`;
        i++;
    }, 100);
}

function screamDad() {
    if (chaosMode) return;
    score++;
    scoreEl.textContent = score;

    const pool = score >= 400 ? [...screams, ...bonusScreams] : screams;
    const msg = pool[Math.floor(Math.random() * pool.length)];
    screamEl.textContent = msg;
    screamEl.classList.add('show');
    dad.textContent = '😱';

    dad.style.transform = 'translateX(10px) rotate(-8deg)';
    setTimeout(() => { dad.style.transform='translateX(10px) rotate(6deg)'; }, 100);
    setTimeout(() => { dad.style.transform='translateX(10px) rotate(-4deg)'; }, 200);
    setTimeout(() => { dad.style.transform='translateX(10px) rotate(0)'; dad.textContent='😅'; }, 350);
    setTimeout(() => { dad.textContent='😊'; }, 1200);

    if (score % 10 === 0) emitStars();

    if (screamTimeout) clearTimeout(screamTimeout);
    screamTimeout = setTimeout(() => screamEl.classList.remove('show'), screamDuration);

    // Check upgrades
    const up = UPGRADES.find(u => u.at === score);
    if (up) {
        upgradesPending.push(up);
        setTimeout(() => showUpgrade(up), 400);
    }

    updateNextUpgrade();
}

function updateNextUpgrade() {
    const next = UPGRADES.find(u => u.at > score);
    if (next) {
        nextUpgradeEl.textContent = `Next upgrade at ${next.at} 🔒`;
    } else {
        nextUpgradeEl.textContent = chaosMode ? '🔴 CHAOS MODE ACTIVE' : '🏆 ALL UPGRADES UNLOCKED!';
    }
}

function showUpgrade(up) {
    document.getElementById('up-icon').textContent = up.icon;
    document.getElementById('up-title').textContent = up.title;
    document.getElementById('up-desc').textContent = up.desc;
    popup.classList.add('show');
    emitStars(); emitStars();
}

function closeUpgrade() {
    popup.classList.remove('show');
    const up = upgradesPending.shift();
    if (!up) return;

    // Apply upgrade effect
    if (up.at === 100) screamDuration = 2200;
    if (up.at === 200) shakeAngles = [6,-10,8,-7,5,-4,3,-2,1,0];
    if (up.at === 300) {
        bridgeWidth = 400;
        bridge.style.width = bridgeWidth + 'px';
        document.getElementById('post-left').style.left = 'calc(50% - 200px - 11px)';
        document.getElementById('post-right').style.left = 'calc(50% + 200px - 11px)';
        document.getElementById('canyon').style.width = '390px';
    }
    if (up.at === 400) { /* bonus screams already in pool when score >= 400 */ }
    if (up.at === 500) activateChaosMode();
}

function activateChaosMode() {
    chaosMode = true;
    document.body.classList.add('chaos');
    screamEl.textContent = 'AAAHHHHHHHH!!!! 😱😱😱';
    screamEl.classList.add('show');
    dad.textContent = '😱';
    jumpBtn.textContent = '🔴 DAD IS BROKEN';
    nextUpgradeEl.textContent = '🔴 CHAOS MODE ACTIVE';
}

function emitStars() {
    const emojis=['⭐','💫','✨','🌟','🎉'];
    for(let i=0;i<6;i++) {
        setTimeout(()=>{
            const s=document.createElement('div');
            s.className='star';
            s.textContent=emojis[Math.floor(Math.random()*emojis.length)];
            s.style.left=(35+Math.random()*30)+'%';
            s.style.bottom=(45+Math.random()*20)+'vh';
            document.getElementById('game').appendChild(s);
            setTimeout(()=>s.remove(),900);
        }, i*70);
    }
}

jumpBtn.addEventListener('click', jump);
document.addEventListener('keydown', e => { if(e.code==='Space'){e.preventDefault();jump();} });

updateNextUpgrade();
</script>
</body>
</html>
