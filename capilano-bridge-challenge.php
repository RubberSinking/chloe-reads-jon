<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capilano Bridge Challenge 🌉</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #0e1f08;
            color: #e8eedf;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 16px 48px;
        }

        .page-title {
            font-size: 1.6em;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
            text-align: center;
        }

        .page-subtitle {
            font-size: 0.9em;
            color: #8fa87a;
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .game-card {
            width: 100%;
            max-width: 600px;
            background: #182c10;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #2d4e1e;
        }

        /* ── BRIDGE VIEWPORT ── */
        .bridge-viewport {
            position: relative;
            width: 100%;
            height: 340px;
            overflow: hidden;
            cursor: pointer;
            user-select: none;
        }

        #bridgeCanvas {
            display: block;
            width: 100%;
            height: 100%;
        }

        /* Blinder panels */
        .blinder {
            position: absolute;
            top: 0;
            bottom: 0;
            background: #0a0a0a;
            transition: width 0.2s ease;
            pointer-events: none;
        }
        .blinder-left  { left: 0; }
        .blinder-right { right: 0; }

        /* Fear red overlay */
        #fearOverlay {
            position: absolute;
            inset: 0;
            background: rgba(200, 30, 20, 0);
            pointer-events: none;
            transition: background 0.4s;
        }

        /* Shake class */
        @keyframes shake {
            0%   { transform: translate(0,0); }
            20%  { transform: translate(-5px, 3px); }
            40%  { transform: translate(5px,-3px); }
            60%  { transform: translate(-4px, 4px); }
            80%  { transform: translate(4px,-2px); }
            100% { transform: translate(0,0); }
        }
        .shaking { animation: shake 0.4s ease; }

        /* Status message over canvas */
        #statusMsg {
            position: absolute;
            bottom: 14px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.72);
            color: #fff;
            font-size: 0.88em;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
        }
        #statusMsg.visible { opacity: 1; }

        /* Win / Lose overlay */
        #endOverlay {
            position: absolute;
            inset: 0;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.78);
            text-align: center;
            padding: 24px;
        }
        #endOverlay.show { display: flex; }
        #endOverlay .end-emoji { font-size: 3em; margin-bottom: 8px; }
        #endOverlay .end-title { font-size: 1.5em; font-weight: 800; color: #fff; margin-bottom: 8px; }
        #endOverlay .end-msg   { font-size: 0.9em; color: #ccc; line-height: 1.5; margin-bottom: 16px; }
        #endOverlay .restart-btn {
            background: #4a7c3b;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
        }

        /* ── CONTROLS PANEL ── */
        .controls-panel {
            padding: 18px 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        /* Progress bar */
        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 6px;
            font-size: 0.8em;
            color: #8fa87a;
        }

        .bar-track {
            height: 10px;
            background: #0e1f08;
            border-radius: 6px;
            overflow: hidden;
        }
        .bar-fill {
            height: 100%;
            border-radius: 6px;
            transition: width 0.3s ease;
        }
        #progressFill { background: #4a7c3b; }
        #fearFill {
            background: linear-gradient(to right, #f6c300, #e53935);
        }

        /* Blinder slider section */
        .slider-section label {
            display: block;
            font-size: 0.82em;
            color: #8fa87a;
            margin-bottom: 8px;
        }
        .slider-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .slider-row input[type=range] {
            flex: 1;
            accent-color: #4a7c3b;
            height: 6px;
            cursor: pointer;
        }
        .slider-value {
            font-size: 0.85em;
            font-weight: 700;
            min-width: 36px;
            text-align: right;
            color: #c8e0b0;
        }

        /* Buttons row */
        .btn-row {
            display: flex;
            gap: 10px;
        }
        .btn {
            flex: 1;
            padding: 12px 8px;
            border: none;
            border-radius: 8px;
            font-size: 0.95em;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.1s, opacity 0.1s;
        }
        .btn:active { transform: scale(0.97); }
        .btn:disabled { opacity: 0.45; cursor: default; }
        .btn-walk { background: #4a7c3b; color: #fff; }
        .btn-breathe { background: #2c5d8f; color: #cfe8ff; }
        .btn-reset  { background: #3a3a3a; color: #ccc; flex: 0.5; }

        /* Tips box */
        .tip-box {
            background: #0e1f08;
            border: 1px solid #2d4e1e;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 0.82em;
            color: #8fa87a;
            line-height: 1.6;
        }
        .tip-box strong { color: #c8e0b0; }

        .attribution {
            margin-top: 20px;
            font-size: 0.78em;
            color: #4a6035;
            text-align: center;
        }
        .attribution a { color: #5c7a43; }
    </style>
</head>
<body>

<h1 class="page-title">🌉 Capilano Bridge Challenge</h1>
<p class="page-subtitle">
    Can you cross the 450-foot suspension bridge 230 feet above the gorge?<br>
    Use Jon's famous DIY blinders to keep your fear in check.
</p>

<div class="game-card">

    <!-- BRIDGE VIEW -->
    <div class="bridge-viewport" id="viewport">
        <canvas id="bridgeCanvas"></canvas>
        <div class="blinder blinder-left"  id="blinderLeft"></div>
        <div class="blinder blinder-right" id="blinderRight"></div>
        <div id="fearOverlay"></div>
        <div id="statusMsg"></div>
        <div id="endOverlay">
            <div class="end-emoji" id="endEmoji">😨</div>
            <div class="end-title" id="endTitle">You Panicked!</div>
            <div class="end-msg"   id="endMsg">Your fear got the better of you. Next time, use the blinders!</div>
            <button class="restart-btn" onclick="resetGame()">Try Again</button>
        </div>
    </div>

    <!-- CONTROLS -->
    <div class="controls-panel">

        <!-- Progress -->
        <div>
            <div class="label-row">
                <span>Progress across bridge</span>
                <span id="stepLabel">0 / 30 steps</span>
            </div>
            <div class="bar-track">
                <div class="bar-fill" id="progressFill" style="width:0%"></div>
            </div>
        </div>

        <!-- Fear meter -->
        <div>
            <div class="label-row">
                <span>😰 Fear level</span>
                <span id="fearLabel">0%</span>
            </div>
            <div class="bar-track">
                <div class="bar-fill" id="fearFill" style="width:0%"></div>
            </div>
        </div>

        <!-- Blinder slider -->
        <div class="slider-section">
            <label>🐴 Blinder width — Jon's cardboard contraption <strong>(wider = safer but slower)</strong></label>
            <div class="slider-row">
                <span>👁️ Open</span>
                <input type="range" id="blinderSlider" min="0" max="100" value="0" oninput="updateBlinders()">
                <span>🙈 Max</span>
                <span class="slider-value" id="blinderLabel">0%</span>
            </div>
        </div>

        <!-- Buttons -->
        <div class="btn-row">
            <button class="btn btn-walk" id="walkBtn" onclick="walk()">👣 Walk</button>
            <button class="btn btn-breathe" id="breatheBtn" onclick="breathe()">🌬️ Breathe</button>
            <button class="btn btn-reset"  onclick="resetGame()">↺</button>
        </div>

        <!-- Tips -->
        <div class="tip-box" id="tipBox">
            <strong>How to cross:</strong> Click <em>Walk</em> to take a step.
            Slide the blinders wider to keep fear down — but too wide and you slow to a crawl.
            Hit <em>Breathe</em> if your heart's pounding. Reach <strong>step 30</strong> to cross!
        </div>
    </div>
</div>

<p class="attribution">
    Inspired by Jon's
    <a href="https://jon-aquino-mental-garden.blogspot.com/2025/01/if-youre-like-me-and-scared-of-heights.html" target="_blank">Capilano bridge blinders post</a>
    · back to <a href="index.php">Chloe Reads Jon</a>
</p>

<script>
/* ─────────────────────────────────────────────
   GAME STATE
───────────────────────────────────────────── */
let step     = 0;
let fear     = 0;       // 0–100
let blinder  = 0;       // 0–100 (slider value)
let gameOver = false;
let gameWon  = false;
let plankOff = 0;       // offset for scrolling planks
let swayT    = 0;       // time for sway animation
let animFrame = null;
const TOTAL  = 30;

const canvas     = document.getElementById('bridgeCanvas');
const ctx        = canvas.getContext('2d');
const viewport   = document.getElementById('viewport');

function resize() {
    canvas.width  = viewport.clientWidth;
    canvas.height = viewport.clientHeight;
    drawBridge();
}
window.addEventListener('resize', resize);
resize();

/* ─────────────────────────────────────────────
   DRAWING
───────────────────────────────────────────── */
function drawBridge() {
    const W = canvas.width;
    const H = canvas.height;
    ctx.clearRect(0, 0, W, H);

    // Sway
    const sway = Math.sin(swayT) * (fear / 12 + 2);

    ctx.save();
    ctx.translate(sway, 0);

    const vx = W / 2;
    const vy = H * 0.38;   // vanishing point y

    // ── SKY ──────────────────────────────────
    const skyGrad = ctx.createLinearGradient(0, 0, 0, vy + 30);
    skyGrad.addColorStop(0,   '#2e6ea6');
    skyGrad.addColorStop(0.6, '#79bfe0');
    skyGrad.addColorStop(1,   '#a8d5ea');
    ctx.fillStyle = skyGrad;
    ctx.fillRect(-20, 0, W + 40, vy + 30);

    // ── DISTANT FOREST ───────────────────────
    ctx.fillStyle = '#1a4010';
    ctx.beginPath();
    // Irregular tree-line silhouette
    const treeSegs = 20;
    ctx.moveTo(-20, vy + 20);
    for (let i = 0; i <= treeSegs; i++) {
        const tx = -20 + (W + 40) * (i / treeSegs);
        const ty = vy - 8 + Math.sin(i * 1.7) * 12 + Math.sin(i * 3.1) * 6;
        ctx.lineTo(tx, ty);
    }
    ctx.lineTo(W + 20, vy + 20);
    ctx.closePath();
    ctx.fill();

    // ── GORGE (left & right dark sides) ──────
    const deckW_bottom = W;          // deck full width at bottom
    const deckW_top    = 70;         // deck width at vanishing pt
    const deckL_top  = vx - deckW_top / 2;
    const deckR_top  = vx + deckW_top / 2;
    const deckL_bot  = 0;
    const deckR_bot  = W;

    // Function: deck edge x at y
    function edgeX(side, y) {
        const t = (y - vy) / (H - vy);
        if (side === 'left')  return deckL_top + (deckL_bot - deckL_top) * t;
        else                  return deckR_top + (deckR_bot - deckR_top) * t;
    }

    // Gorge fill (deep green gradient)
    const gorgeGrad = ctx.createLinearGradient(0, vy, 0, H);
    gorgeGrad.addColorStop(0,   '#163b0a');
    gorgeGrad.addColorStop(0.5, '#0c2406');
    gorgeGrad.addColorStop(1,   '#060f03');
    ctx.fillStyle = gorgeGrad;

    // Left gorge
    ctx.beginPath();
    ctx.moveTo(-20, vy + 20);
    ctx.lineTo(-20, H + 10);
    ctx.lineTo(edgeX('left', H), H + 10);
    for (let y = H; y >= vy + 20; y -= 5) ctx.lineTo(edgeX('left', y), y);
    ctx.closePath();
    ctx.fill();

    // Right gorge
    ctx.beginPath();
    ctx.moveTo(W + 20, vy + 20);
    ctx.lineTo(W + 20, H + 10);
    ctx.lineTo(edgeX('right', H), H + 10);
    for (let y = H; y >= vy + 20; y -= 5) ctx.lineTo(edgeX('right', y), y);
    ctx.closePath();
    ctx.fill();

    // ── GORGE MIST (bottom) ───────────────────
    const mistGrad = ctx.createLinearGradient(0, H - 60, 0, H);
    mistGrad.addColorStop(0, 'rgba(100,160,120,0)');
    mistGrad.addColorStop(1, 'rgba(100,160,120,0.18)');
    ctx.fillStyle = mistGrad;
    ctx.fillRect(-20, H - 60, W + 40, 70);

    // ── BRIDGE DECK (planks) ──────────────────
    // Perspective planks: 20 plank positions, scroll with plankOff
    const numPlanks = 22;

    // Draw deck background first
    ctx.beginPath();
    ctx.moveTo(deckL_top, vy);
    ctx.lineTo(deckR_top, vy);
    ctx.lineTo(deckR_bot, H);
    ctx.lineTo(deckL_bot, H);
    ctx.closePath();
    const deckGrad = ctx.createLinearGradient(0, vy, 0, H);
    deckGrad.addColorStop(0, '#5a3e1b');
    deckGrad.addColorStop(1, '#7a5428');
    ctx.fillStyle = deckGrad;
    ctx.fill();

    // Plank lines (horizontal, perspective-spaced)
    ctx.strokeStyle = '#3d2a0f';
    ctx.lineWidth = 1.5;
    for (let i = 0; i < numPlanks; i++) {
        // t goes 0→1 from VP to bottom, with perspective foreshortening
        const raw = ((i + plankOff % 1) / (numPlanks - 1));
        const t   = raw * raw;   // squared = perspective compression near VP
        const y   = vy + (H - vy) * t;
        if (y < vy) continue;
        const lx = edgeX('left', y);
        const rx = edgeX('right', y);
        ctx.beginPath();
        ctx.moveTo(lx, y);
        ctx.lineTo(rx, y);
        ctx.stroke();
    }

    // Deck edge rails
    ctx.strokeStyle = '#c8a060';
    ctx.lineWidth = 3;
    ctx.beginPath();
    ctx.moveTo(deckL_top, vy);
    ctx.lineTo(deckL_bot, H);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(deckR_top, vy);
    ctx.lineTo(deckR_bot, H);
    ctx.stroke();

    // ── MAIN CABLES ──────────────────────────
    // Two main cables arc from corners (high) through VP then down sides
    ctx.strokeStyle = '#8a7a60';
    ctx.lineWidth = 2.5;

    // Left cable: from (-W*0.2, 0) curve through (vx, vy-40) to (deckL_top, vy)
    ctx.beginPath();
    ctx.moveTo(-W * 0.05, 0);
    ctx.quadraticCurveTo(vx * 0.3, vy * 0.3, vx, vy - 35);
    ctx.stroke();
    // Continue left cable to deck
    ctx.beginPath();
    ctx.moveTo(vx, vy - 35);
    ctx.lineTo(deckL_bot + 10, H * 0.9);
    ctx.stroke();

    // Right cable
    ctx.beginPath();
    ctx.moveTo(W * 1.05, 0);
    ctx.quadraticCurveTo(W - vx * 0.3, vy * 0.3, vx, vy - 35);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(vx, vy - 35);
    ctx.lineTo(deckR_bot - 10, H * 0.9);
    ctx.stroke();

    // ── HANGER CABLES ────────────────────────
    // Vertical cables from main cables down to rail
    ctx.strokeStyle = 'rgba(120,110,80,0.7)';
    ctx.lineWidth = 1;
    for (let i = 0; i < 8; i++) {
        const t = (i + 1) / 9;
        const hx = vx + (deckL_bot - vx) * t;   // left side hangers
        const hy = vy + (H - vy) * t * t;
        // left side hanger
        const lCableY = vy - 35 + t * (H * 0.9 - (vy - 35));
        const lCableX = vx + (deckL_bot - vx) * t;
        ctx.beginPath();
        ctx.moveTo(lCableX, lCableY);
        ctx.lineTo(edgeX('left', hy) + 4, hy);
        ctx.stroke();
        // right side hanger
        const rCableX = vx + (deckR_bot - vx) * t;
        ctx.beginPath();
        ctx.moveTo(rCableX, lCableY);
        ctx.lineTo(edgeX('right', hy) - 4, hy);
        ctx.stroke();
    }

    // ── PROGRESS TINT (encourage or warn) ────
    const prog = step / TOTAL;
    if (prog > 0) {
        // Slight green tint at far end as you approach
        ctx.fillStyle = `rgba(80,180,60,${prog * 0.04})`;
        ctx.fillRect(deckL_top - 5, vy, deckW_top + 10, 30);
    }

    ctx.restore();
}

/* ─────────────────────────────────────────────
   ANIMATION LOOP
───────────────────────────────────────────── */
function tick() {
    swayT += 0.018;
    // Drift plank offset slightly for living bridge feel
    plankOff += 0.004;
    drawBridge();
    animFrame = requestAnimationFrame(tick);
}
tick();

/* ─────────────────────────────────────────────
   UI UPDATES
───────────────────────────────────────────── */
function updateBlinders() {
    blinder = parseInt(document.getElementById('blinderSlider').value);
    document.getElementById('blinderLabel').textContent = blinder + '%';
    applyBlinders();
}

function applyBlinders() {
    // Max blinder = cover 38% each side (leaving 24% visible)
    const frac = blinder / 100;
    const pct  = frac * 38;
    document.getElementById('blinderLeft').style.width  = pct + '%';
    document.getElementById('blinderRight').style.width = pct + '%';
}

function updateBars() {
    const prog = (step / TOTAL) * 100;
    document.getElementById('progressFill').style.width = prog + '%';
    document.getElementById('fearFill').style.width     = Math.min(100, fear) + '%';
    document.getElementById('stepLabel').textContent    = step + ' / ' + TOTAL + ' steps';
    document.getElementById('fearLabel').textContent    = Math.round(fear) + '%';

    // Fear colour overlay
    const alpha = Math.max(0, (fear - 40) / 100) * 0.45;
    document.getElementById('fearOverlay').style.background = `rgba(200,20,10,${alpha})`;

    // Shake when very scared
    if (fear > 75 && !gameOver) {
        viewport.classList.add('shaking');
        setTimeout(() => viewport.classList.remove('shaking'), 400);
    }
}

function showStatus(msg, duration = 2200) {
    const el = document.getElementById('statusMsg');
    el.textContent = msg;
    el.classList.add('visible');
    setTimeout(() => el.classList.remove('visible'), duration);
}

function updateTip() {
    const el = document.getElementById('tipBox');
    if (fear < 30) {
        el.innerHTML = '<strong>Looking good!</strong> Keep walking. You can handle this.';
    } else if (fear < 60) {
        el.innerHTML = '<strong>Getting nervous…</strong> Try sliding the blinders up a bit. Or hit Breathe.';
    } else if (fear < 80) {
        el.innerHTML = '<strong>Heart pounding!</strong> Slide those blinders to 60–80%. Think of Jon\'s cardboard hat. 🎩';
    } else {
        el.innerHTML = '<strong>⚠️ Nearly panicking!</strong> Max those blinders NOW and hit Breathe before you walk!';
    }
}

/* ─────────────────────────────────────────────
   GAME ACTIONS
───────────────────────────────────────────── */
function walk() {
    if (gameOver || gameWon) return;

    step++;
    plankOff += 0.6 + (1 - blinder / 100) * 0.8;  // fast scroll = more plank movement

    // Fear increases inversely to blinder level
    const exposure = 1 - blinder / 100;  // 1 = fully open, 0 = max blinders
    const fearInc  = exposure * 7 + 1;   // 1 (max blinders) to 8 (no blinders)
    fear = Math.min(100, fear + fearInc);

    updateBars();
    updateTip();

    if (fear >= 100) {
        triggerPanic();
        return;
    }

    if (step >= TOTAL) {
        triggerWin();
        return;
    }

    // Status messages
    const msgs = [
        'One step at a time…',
        'The bridge sways slightly.',
        'Don\'t look down.',
        'You\'re doing it!',
        'Focus straight ahead.',
        'Almost halfway!',
        'The gorge roars below.',
        'Jon would be proud.',
        'Keep going!',
        'The planks creak softly.',
    ];
    if (step % 3 === 0) {
        showStatus(msgs[Math.floor(Math.random() * msgs.length)]);
    }
}

function breathe() {
    if (gameOver || gameWon) return;
    const reduction = 12 + (blinder / 100) * 8;  // blinders help you calm faster
    fear = Math.max(0, fear - reduction);
    updateBars();
    showStatus('🌬️ Deep breath… ' + Math.round(reduction) + '% fear reduced.', 2000);
    updateTip();
}

function triggerPanic() {
    gameOver = true;
    document.getElementById('endEmoji').textContent = '😱';
    document.getElementById('endTitle').textContent = 'You Panicked!';
    document.getElementById('endMsg').textContent =
        'Fear hit 100%! You froze halfway across the bridge. ' +
        'Next time try Jon\'s blinder technique — slide them up to 70%+ before each step.';
    document.getElementById('endOverlay').classList.add('show');
    // Extra red flash
    document.getElementById('fearOverlay').style.background = 'rgba(200,20,10,0.6)';
    disableButtons();
}

function triggerWin() {
    gameWon = true;
    const bPct = Math.round(blinder);
    const emoji = blinder >= 60 ? '🎉' : '🏆';
    document.getElementById('endEmoji').textContent = emoji;
    document.getElementById('endTitle').textContent = 'You Made It!';
    const winMsg = blinder >= 60
        ? `You crossed using ${bPct}% blinders — just like Jon! His cardboard Swiffer-box hat really works. 🐴🎩`
        : `You crossed with only ${bPct}% blinders. Brave! Jon himself needed 70%+ to handle the 230-foot drop.`;
    document.getElementById('endMsg').textContent = winMsg;
    document.getElementById('endOverlay').classList.add('show');
    disableButtons();
}

function disableButtons() {
    document.getElementById('walkBtn').disabled    = true;
    document.getElementById('breatheBtn').disabled = true;
}

function resetGame() {
    step    = 0;
    fear    = 0;
    gameOver = false;
    gameWon  = false;
    plankOff = 0;
    document.getElementById('blinderSlider').value = 0;
    blinder = 0;
    applyBlinders();
    document.getElementById('blinderLabel').textContent = '0%';
    updateBars();
    document.getElementById('fearOverlay').style.background = 'rgba(200,20,10,0)';
    document.getElementById('endOverlay').classList.remove('show');
    document.getElementById('walkBtn').disabled    = false;
    document.getElementById('breatheBtn').disabled = false;
    document.getElementById('tipBox').innerHTML =
        '<strong>How to cross:</strong> Click <em>Walk</em> to take a step. ' +
        'Slide the blinders wider to keep fear down — but too wide and you slow to a crawl. ' +
        'Hit <em>Breathe</em> if your heart\'s pounding. Reach <strong>step 30</strong> to cross!';
}

// Init
applyBlinders();
updateBars();
</script>

</body>
</html>
