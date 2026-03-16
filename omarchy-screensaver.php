<?php date_default_timezone_set('America/Vancouver'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASCII Terminal Lab | Chloe Reads Jon</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0a0a0e;
            --panel: #0f1117;
            --border: #1e2433;
            --ink: #00ff7f;
            --ink-dim: #005a2b;
            --ink-bright: #80ffb0;
            --cursor-color: #00ff7f;
            --glow: 0 0 8px rgba(0,255,127,0.5);
            --glow-strong: 0 0 18px rgba(0,255,127,0.7);
        }

        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'Courier New', Courier, monospace;
            min-height: 100vh;
            padding: 24px 16px 48px;
        }

        /* Scanline overlay */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,0,0,0.04) 2px,
                rgba(0,0,0,0.04) 4px
            );
            pointer-events: none;
            z-index: 9999;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Header */
        header {
            border-bottom: 1px solid var(--border);
            padding-bottom: 20px;
            margin-bottom: 28px;
        }

        .prompt-line {
            font-size: 0.75em;
            color: var(--ink-dim);
            margin-bottom: 6px;
            letter-spacing: 0.08em;
        }

        h1 {
            font-size: 1.5em;
            font-weight: bold;
            text-shadow: var(--glow);
            letter-spacing: 0.05em;
        }

        h1 .cursor {
            display: inline-block;
            width: 0.6em;
            height: 1em;
            background: var(--cursor-color);
            vertical-align: text-bottom;
            animation: blink 1.1s steps(1) infinite;
            margin-left: 2px;
        }

        @keyframes blink { 0%,49% { opacity: 1; } 50%,100% { opacity: 0; } }

        .tagline {
            font-size: 0.8em;
            color: var(--ink-dim);
            margin-top: 6px;
        }

        /* Control panel */
        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .panel-label {
            font-size: 0.65em;
            letter-spacing: 0.15em;
            color: var(--ink-dim);
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .input-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        input[type="text"] {
            flex: 1;
            min-width: 0;
            background: #000;
            border: 1px solid var(--ink-dim);
            color: var(--ink);
            font-family: 'Courier New', Courier, monospace;
            font-size: 1em;
            padding: 8px 12px;
            border-radius: 3px;
            outline: none;
            caret-color: var(--cursor-color);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus {
            border-color: var(--ink);
            box-shadow: var(--glow);
        }

        input[type="text"]::placeholder { color: var(--ink-dim); }

        .btn {
            background: transparent;
            border: 1px solid var(--ink);
            color: var(--ink);
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.85em;
            padding: 8px 16px;
            border-radius: 3px;
            cursor: pointer;
            letter-spacing: 0.05em;
            transition: background 0.15s, box-shadow 0.15s, color 0.15s;
            white-space: nowrap;
        }

        .btn:hover {
            background: var(--ink);
            color: #000;
            box-shadow: var(--glow);
        }

        .btn.secondary {
            border-color: var(--ink-dim);
            color: var(--ink-dim);
        }

        .btn.secondary:hover {
            border-color: var(--ink);
            background: transparent;
            color: var(--ink);
            box-shadow: none;
        }

        .btn.danger {
            border-color: #ff4444;
            color: #ff4444;
        }
        .btn.danger:hover {
            background: #ff4444;
            color: #000;
            box-shadow: 0 0 12px rgba(255,68,68,0.5);
        }

        /* Options row */
        .options-row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .option-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .option-group label {
            font-size: 0.65em;
            letter-spacing: 0.12em;
            color: var(--ink-dim);
            text-transform: uppercase;
        }

        select {
            background: #000;
            border: 1px solid var(--ink-dim);
            color: var(--ink);
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.85em;
            padding: 5px 8px;
            border-radius: 3px;
            outline: none;
            cursor: pointer;
        }

        select:focus { border-color: var(--ink); }

        /* Output area */
        .output-panel {
            background: #000;
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 16px;
            min-height: 120px;
            overflow-x: auto;
            position: relative;
        }

        .output-panel .empty-state {
            color: var(--ink-dim);
            font-size: 0.8em;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
            letter-spacing: 0.08em;
        }

        #ascii-output {
            font-size: 0.7em;
            line-height: 1.15;
            white-space: pre;
            color: var(--ink);
            text-shadow: var(--glow);
            display: none;
            letter-spacing: 0.03em;
        }

        /* Action row */
        .action-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        /* Copy flash */
        #copy-btn.copied {
            border-color: #80ffb0;
            color: #80ffb0;
        }

        /* About panel */
        .about-panel {
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 14px 16px;
            font-size: 0.75em;
            color: var(--ink-dim);
            line-height: 1.7;
        }

        .about-panel a {
            color: var(--ink);
            text-decoration: none;
        }

        .about-panel a:hover {
            text-decoration: underline;
            text-shadow: var(--glow);
        }

        /* ========== SCREENSAVER OVERLAY ========== */
        #screensaver {
            display: none;
            position: fixed;
            inset: 0;
            background: #000;
            z-index: 10000;
            cursor: none;
            overflow: hidden;
        }

        #screensaver.active { display: block; }

        #ss-text {
            position: absolute;
            font-size: 0.6em;
            line-height: 1.15;
            white-space: pre;
            letter-spacing: 0.03em;
            user-select: none;
            will-change: transform;
        }

        #ss-exit-hint {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.7em;
            color: rgba(255,255,255,0.2);
            letter-spacing: 0.1em;
            z-index: 10001;
            pointer-events: none;
            animation: fadeInHint 3s ease forwards;
        }

        @keyframes fadeInHint {
            0% { opacity: 0; }
            20% { opacity: 1; }
            70% { opacity: 1; }
            100% { opacity: 0; }
        }

        /* Matrix rain canvas */
        #matrix-canvas {
            position: absolute;
            inset: 0;
            opacity: 0.15;
        }

        /* Color themes */
        .theme-green  { --ink: #00ff7f; --ink-dim: #005a2b; --glow: 0 0 8px rgba(0,255,127,0.5); }
        .theme-cyan   { --ink: #00e5ff; --ink-dim: #00526b; --glow: 0 0 8px rgba(0,229,255,0.5); }
        .theme-amber  { --ink: #ffb700; --ink-dim: #664a00; --glow: 0 0 8px rgba(255,183,0,0.5); }
        .theme-white  { --ink: #e8e8e8; --ink-dim: #555; --glow: 0 0 6px rgba(232,232,232,0.3); }
        .theme-purple { --ink: #bf7fff; --ink-dim: #4a2b73; --glow: 0 0 8px rgba(191,127,255,0.5); }
    </style>
</head>
<body class="theme-green">

<!-- SCREENSAVER OVERLAY -->
<div id="screensaver">
    <canvas id="matrix-canvas"></canvas>
    <div id="ss-text"></div>
    <div id="ss-exit-hint">PRESS ANY KEY OR CLICK TO EXIT</div>
</div>

<div class="container">

    <header>
        <div class="prompt-line">jon@omarchy ~ $</div>
        <h1>ASCII TERMINAL LAB<span class="cursor"></span></h1>
        <div class="tagline">Type text &rarr; get ASCII art for your terminal screensaver.</div>
    </header>

    <!-- Input panel -->
    <div class="panel">
        <div class="panel-label">&#9655; Input</div>
        <div class="input-row">
            <input type="text" id="text-input" placeholder="Type something…" maxlength="30" autocomplete="off" autocorrect="off" spellcheck="false">
            <button class="btn" onclick="renderAscii()">GENERATE</button>
        </div>

        <div class="options-row">
            <div class="option-group">
                <label>Font Style</label>
                <select id="font-select" onchange="renderAscii()">
                    <option value="classic">Classic (#)</option>
                    <option value="block">Block (█)</option>
                    <option value="dots">Dots (·)</option>
                    <option value="slim">Slim (/|)</option>
                </select>
            </div>
            <div class="option-group">
                <label>Color Theme</label>
                <select id="theme-select" onchange="applyTheme()">
                    <option value="green">Green (Default)</option>
                    <option value="cyan">Cyan Matrix</option>
                    <option value="amber">Amber Retro</option>
                    <option value="purple">Purple Haze</option>
                    <option value="white">White Classic</option>
                </select>
            </div>
            <div class="option-group">
                <label>Size</label>
                <select id="size-select" onchange="renderAscii()">
                    <option value="0.7em">Normal</option>
                    <option value="0.55em">Small</option>
                    <option value="0.9em">Large</option>
                    <option value="1.1em">XLarge</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Output panel -->
    <div class="output-panel" id="output-panel">
        <div class="empty-state" id="empty-state">[ Enter text above and press GENERATE ]</div>
        <div id="ascii-output"></div>
    </div>

    <!-- Actions -->
    <div class="action-row">
        <button class="btn" id="copy-btn" onclick="copyOutput()">&#9112; COPY TO CLIPBOARD</button>
        <button class="btn secondary" onclick="clearOutput()">&#10005; CLEAR</button>
        <button class="btn" id="ss-btn" onclick="startScreensaver()">&#9654; SCREENSAVER MODE</button>
    </div>

    <!-- About -->
    <div class="about-panel">
        <strong>About this tool:</strong> Inspired by Jon's
        <a href="https://jon-aquino-mental-garden.blogspot.com/2025/12/customizing-omarchy-screensaver.html" target="_blank">post about customizing the Omarchy screensaver</a>
        — he loves how you can tweak it just by editing a text file, and referenced
        <a href="https://patorjk.com/software/taag/" target="_blank">patorjk.com/software/taag</a>
        for generating ASCII fonts.
        Use the output here to drop cool ASCII art into your own screensaver or terminal welcome message.
    </div>

</div><!-- /container -->

<script>
// ============================================================
//  ASCII FONT ENGINE
// ============================================================

// Each char is 5 rows of 5 columns (can vary width via padding)
const CLASSIC = {
  ' ':['     ','     ','     ','     ','     '],
  'A':['  #  ',' # # ','#####','#   #','#   #'],
  'B':['#### ','#   #','#### ','#   #','#### '],
  'C':[' ####','#    ','#    ','#    ',' ####'],
  'D':['#### ','#   #','#   #','#   #','#### '],
  'E':['#####','#    ','#### ','#    ','#####'],
  'F':['#####','#    ','#### ','#    ','#    '],
  'G':[' ####','#    ','# ###','#   #',' ####'],
  'H':['#   #','#   #','#####','#   #','#   #'],
  'I':['#####','  #  ','  #  ','  #  ','#####'],
  'J':['#####','   # ','   # ','#  # ',' ##  '],
  'K':['#   #','#  # ','###  ','#  # ','#   #'],
  'L':['#    ','#    ','#    ','#    ','#####'],
  'M':['#   #','## ##','# # #','#   #','#   #'],
  'N':['#   #','##  #','# # #','#  ##','#   #'],
  'O':[' ### ','#   #','#   #','#   #',' ### '],
  'P':['#### ','#   #','#### ','#    ','#    '],
  'Q':[' ### ','#   #','# # #','#  ##',' ## #'],
  'R':['#### ','#   #','#### ','#  # ','#   #'],
  'S':[' ####','#    ',' ### ','    #','#### '],
  'T':['#####','  #  ','  #  ','  #  ','  #  '],
  'U':['#   #','#   #','#   #','#   #',' ### '],
  'V':['#   #','#   #','#   #',' # # ','  #  '],
  'W':['#   #','#   #','# # #','## ##','#   #'],
  'X':['#   #',' # # ','  #  ',' # # ','#   #'],
  'Y':['#   #',' # # ','  #  ','  #  ','  #  '],
  'Z':['#####','   # ','  #  ',' #   ','#####'],
  '0':[' ### ','#  ##','# # #','##  #',' ### '],
  '1':['  #  ',' ##  ','  #  ','  #  ','#####'],
  '2':[' ### ','#   #','  ## ',' #   ','#####'],
  '3':['#### ','    #',' ### ','    #','#### '],
  '4':['   # ','  ## ',' # # ','#####','   # '],
  '5':['#####','#    ','#### ','    #','#### '],
  '6':[' ### ','#    ','#### ','#   #',' ### '],
  '7':['#####','   # ','  #  ',' #   ',' #   '],
  '8':[' ### ','#   #',' ### ','#   #',' ### '],
  '9':[' ### ','#   #',' ####','    #',' ### '],
  '!':['  #  ','  #  ','  #  ','     ','  #  '],
  '?':[' ### ','#   #','  ## ','     ','  #  '],
  '.':['     ','     ','     ','     ','  #  '],
  ',':['     ','     ','     ','  #  ',' #   '],
  ':':['     ','  #  ','     ','  #  ','     '],
  '-':['     ','     ','#####','     ','     '],
  '+':['     ','  #  ','#####','  #  ','     '],
  '(':['  ## ',' #   ',' #   ',' #   ','  ## '],
  ')':['  ## ','   # ','   # ','   # ','  ## '],
  '/':['    #','   # ','  #  ',' #   ','#    '],
  '\\':['#    ',' #   ','  #  ','   # ','    #'],
  '*':['     ','# # #','#####','# # #','     '],
  '#':['     ','## ##','#####','## ##','     '],
  '@':[' ####','#  ##','# # #','#    ',' ####'],
  '&':['  ## ',' #  #','  ## ',' #  #','  ###'],
  '%':['## # ','   # ','  #  ',' #   ',' #  ##'],
  '=':['     ','#####','     ','#####','     '],
  '_':['     ','     ','     ','     ','#####'],
  '\'':['  ## ','  ## ','  #  ','     ','     '],
  '"':['## ##','## ##','     ','     ','     '],
};

// Block font: replace # with █, space with ·(invisible)
function makeBlock(font) {
  const out = {};
  for (const ch in font) {
    out[ch] = font[ch].map(row => row.replace(/#/g,'█').replace(/ /g,' '));
  }
  return out;
}

// Dots font: replace # with ●, space with ·
function makeDots(font) {
  const out = {};
  for (const ch in font) {
    out[ch] = font[ch].map(row => row.replace(/#/g,'●').replace(/ /g,'·'));
  }
  return out;
}

// Slim font: replace # with /, \, | artistically
function makeSlim(font) {
  const out = {};
  for (const ch in font) {
    out[ch] = font[ch].map((row, i) => {
      // Top & bottom rows use /\, middle rows use |
      if (i === 0 || i === 4) return row.replace(/#/g,'/');
      if (i === 2) return row.replace(/#/g,'|');
      return row.replace(/#/g, i===1 ? '/' : '\\');
    });
  }
  return out;
}

const FONTS = {
  classic: CLASSIC,
  block: makeBlock(CLASSIC),
  dots: makeDots(CLASSIC),
  slim: makeSlim(CLASSIC),
};

function renderText(text, fontKey) {
  const font = FONTS[fontKey] || FONTS.classic;
  const chars = text.toUpperCase().split('');
  const rows = 5;
  const lines = Array.from({length: rows}, () => '');

  chars.forEach((ch, i) => {
    const glyph = font[ch] || font[' '];
    for (let r = 0; r < rows; r++) {
      lines[r] += glyph[r];
    }
    // Inter-char space (except last)
    if (i < chars.length - 1) {
      for (let r = 0; r < rows; r++) lines[r] += ' ';
    }
  });

  return lines.join('\n');
}

// ============================================================
//  UI Logic
// ============================================================

function renderAscii() {
  const text = document.getElementById('text-input').value.trim();
  const font = document.getElementById('font-select').value;
  const size = document.getElementById('size-select').value;
  const outputEl = document.getElementById('ascii-output');
  const emptyEl = document.getElementById('empty-state');

  if (!text) { clearOutput(); return; }

  const art = renderText(text, font);
  outputEl.textContent = art;
  outputEl.style.fontSize = size;
  outputEl.style.display = 'block';
  emptyEl.style.display = 'none';
}

function clearOutput() {
  document.getElementById('ascii-output').style.display = 'none';
  document.getElementById('ascii-output').textContent = '';
  document.getElementById('empty-state').style.display = 'block';
  document.getElementById('text-input').value = '';
}

function copyOutput() {
  const text = document.getElementById('ascii-output').textContent;
  if (!text) return;
  navigator.clipboard.writeText(text).then(() => {
    const btn = document.getElementById('copy-btn');
    const orig = btn.textContent;
    btn.textContent = '✓ COPIED!';
    btn.classList.add('copied');
    setTimeout(() => { btn.textContent = orig; btn.classList.remove('copied'); }, 2000);
  }).catch(() => {
    // Fallback
    const ta = document.createElement('textarea');
    ta.value = text; ta.style.position = 'fixed'; ta.style.opacity = '0';
    document.body.appendChild(ta); ta.select(); document.execCommand('copy');
    document.body.removeChild(ta);
  });
}

function applyTheme() {
  const theme = document.getElementById('theme-select').value;
  document.body.className = 'theme-' + theme;
  // Sync screensaver color too
  if (ssRunning) updateSsColor();
}

// ============================================================
//  SCREENSAVER
// ============================================================

let ssRunning = false;
let ssAnimId = null;
let matAnimId = null;

const THEMES_CSS = {
  green:  '#00ff7f',
  cyan:   '#00e5ff',
  amber:  '#ffb700',
  purple: '#bf7fff',
  white:  '#e8e8e8',
};

let ssX = 100, ssY = 100, ssDx = 0.8, ssDy = 0.5;
let ssColorIndex = 0;
const COLOR_CYCLE = ['#00ff7f','#00e5ff','#ffb700','#bf7fff','#ff69b4','#aaff00'];

function updateSsColor() {
  const theme = document.getElementById('theme-select').value;
  document.getElementById('ss-text').style.color = THEMES_CSS[theme] || '#00ff7f';
}

function startScreensaver() {
  const text = document.getElementById('ascii-output').textContent;
  const inputVal = document.getElementById('text-input').value.trim();
  const font = document.getElementById('font-select').value;

  let art;
  if (text) {
    art = text;
  } else if (inputVal) {
    art = renderText(inputVal, font);
  } else {
    art = renderText('CHLOE', font);
  }

  const ss = document.getElementById('screensaver');
  const ssEl = document.getElementById('ss-text');
  ssEl.textContent = art;
  updateSsColor();

  // Init position
  ssX = 80; ssY = 80;
  ssDx = 0.6 + Math.random() * 0.5;
  ssDy = 0.4 + Math.random() * 0.4;

  ss.classList.add('active');
  ssRunning = true;

  // Show hint, then hide
  const hint = document.getElementById('ss-exit-hint');
  hint.style.animation = 'none';
  hint.offsetHeight; // reflow
  hint.style.animation = 'fadeInHint 4s ease forwards';

  startMatrix();
  animateSs();

  // Exit on any interaction
  ss.addEventListener('click', stopScreensaver, {once:true});
  document.addEventListener('keydown', stopScreensaver, {once:true});
}

function animateSs() {
  if (!ssRunning) return;
  const ss = document.getElementById('screensaver');
  const ssEl = document.getElementById('ss-text');

  const W = ss.clientWidth;
  const H = ss.clientHeight;
  const elW = ssEl.offsetWidth;
  const elH = ssEl.offsetHeight;

  ssX += ssDx;
  ssY += ssDy;

  let bounced = false;
  if (ssX <= 0) { ssX = 0; ssDx = Math.abs(ssDx); bounced = true; }
  if (ssX + elW >= W) { ssX = W - elW; ssDx = -Math.abs(ssDx); bounced = true; }
  if (ssY <= 0) { ssY = 0; ssDy = Math.abs(ssDy); bounced = true; }
  if (ssY + elH >= H) { ssY = H - elH; ssDy = -Math.abs(ssDy); bounced = true; }

  if (bounced) {
    // Cycle color on bounce
    ssColorIndex = (ssColorIndex + 1) % COLOR_CYCLE.length;
    ssEl.style.color = COLOR_CYCLE[ssColorIndex];
    ssEl.style.textShadow = '0 0 15px ' + COLOR_CYCLE[ssColorIndex] + ', 0 0 30px ' + COLOR_CYCLE[ssColorIndex] + '55';
  }

  ssEl.style.left = ssX + 'px';
  ssEl.style.top  = ssY + 'px';

  ssAnimId = requestAnimationFrame(animateSs);
}

function stopScreensaver() {
  ssRunning = false;
  if (ssAnimId) { cancelAnimationFrame(ssAnimId); ssAnimId = null; }
  stopMatrix();
  document.getElementById('screensaver').classList.remove('active');
  document.removeEventListener('keydown', stopScreensaver);
}

// ---- Matrix Rain ----
let matrixCtx = null;
let matrixDrops = [];
let matrixCols = 0;

function startMatrix() {
  const canvas = document.getElementById('matrix-canvas');
  const ss = document.getElementById('screensaver');
  canvas.width = ss.clientWidth;
  canvas.height = ss.clientHeight;
  matrixCtx = canvas.getContext('2d');
  matrixCols = Math.floor(canvas.width / 16);
  matrixDrops = Array(matrixCols).fill(1);
  drawMatrix();
}

function stopMatrix() {
  if (matAnimId) { cancelAnimationFrame(matAnimId); matAnimId = null; }
  const canvas = document.getElementById('matrix-canvas');
  const ctx = canvas.getContext('2d');
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function drawMatrix() {
  if (!ssRunning) return;
  const canvas = document.getElementById('matrix-canvas');
  const ctx = matrixCtx;
  const theme = document.getElementById('theme-select').value;
  const color = THEMES_CSS[theme] || '#00ff7f';

  ctx.fillStyle = 'rgba(0,0,0,0.05)';
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  ctx.fillStyle = color;
  ctx.font = '14px Courier New';

  const katakana = 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
  const charset = (katakana + '0123456789ABCDEF#*&%').split('');

  for (let i = 0; i < matrixDrops.length; i++) {
    const ch = charset[Math.floor(Math.random() * charset.length)];
    ctx.fillText(ch, i * 16, matrixDrops[i] * 16);
    if (matrixDrops[i] * 16 > canvas.height && Math.random() > 0.975) matrixDrops[i] = 0;
    matrixDrops[i]++;
  }

  matAnimId = requestAnimationFrame(drawMatrix);
}

// ============================================================
//  Enter key support
// ============================================================
document.getElementById('text-input').addEventListener('keydown', e => {
  if (e.key === 'Enter') renderAscii();
});

// ============================================================
//  Init: show a demo
// ============================================================
window.addEventListener('load', () => {
  document.getElementById('text-input').value = 'OMARCHY';
  renderAscii();
});
</script>
</body>
</html>
