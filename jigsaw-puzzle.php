<?php
// Jigsaw Puzzle — Chloe Reads Jon
// Inspired by Jon's mention of jigsaw puzzles in his blog
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Willowmere Jigsaw Puzzle</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    background: #1a2433;
    color: #e8dcc8;
    font-family: Georgia, serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px;
  }
  h1 { font-size: 1.4rem; color: #f0c060; margin: 12px 0 4px; text-align: center; }
  .subtitle { font-size: 0.8rem; color: #a89878; margin-bottom: 12px; text-align: center; }
  #controls {
    display: flex; gap: 10px; margin-bottom: 12px; flex-wrap: wrap; justify-content: center;
  }
  button {
    background: #3a5a40; color: #e8dcc8; border: 1px solid #6a9a50;
    padding: 7px 16px; border-radius: 6px; cursor: pointer; font-family: Georgia, serif;
    font-size: 0.85rem;
  }
  button:hover { background: #4a7a50; }
  select {
    background: #2a3a4a; color: #e8dcc8; border: 1px solid #5a7a9a;
    padding: 7px 12px; border-radius: 6px; font-family: Georgia, serif; font-size: 0.85rem;
  }
  #status {
    font-size: 0.85rem; color: #c8b888; margin-bottom: 8px; min-height: 1.2em; text-align: center;
  }
  #game-area {
    position: relative;
    width: 100%;
    max-width: 600px;
  }
  #board-container {
    position: relative;
    border: 2px solid #5a7a9a;
    border-radius: 8px;
    overflow: hidden;
    background: #0e1a26;
    width: 100%;
    aspect-ratio: 4/3;
  }
  #board-canvas { display: block; width: 100%; height: 100%; }
  #piece-area {
    margin-top: 12px;
    background: #242c3a;
    border: 1px solid #3a4a5a;
    border-radius: 8px;
    padding: 10px;
    position: relative;
    min-height: 120px;
  }
  #scatter-canvas { display: block; width: 100%; }
  #win-overlay {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.75);
    z-index: 100;
    align-items: center; justify-content: center;
    flex-direction: column;
    text-align: center;
  }
  #win-overlay.show { display: flex; }
  #win-box {
    background: #1e3028; border: 2px solid #6a9a50;
    border-radius: 16px; padding: 32px 40px;
  }
  #win-box h2 { font-size: 2rem; color: #f0c060; margin-bottom: 8px; }
  #win-box p { color: #c8d8b8; margin-bottom: 20px; }
  .hint-img {
    width: 90px; height: 68px; border: 1px solid #3a5a40;
    border-radius: 4px; margin-top: 6px;
  }
</style>
</head>
<body>
<h1>Willowmere Jigsaw Puzzle</h1>
<p class="subtitle">A peaceful village in the trees</p>

<div id="controls">
  <select id="grid-select">
    <option value="3">3×3 (Easy)</option>
    <option value="4" selected>4×4 (Medium)</option>
    <option value="5">5×5 (Hard)</option>
  </select>
  <button onclick="startGame()">New Puzzle</button>
  <button onclick="toggleHint()">Hint</button>
</div>

<div id="status">Click a piece below, then click where it goes on the board.</div>

<div id="game-area">
  <div id="board-container">
    <canvas id="board-canvas"></canvas>
  </div>
  <canvas id="hint-canvas" class="hint-img" style="display:none;margin-left:8px"></canvas>
  <div id="piece-area">
    <canvas id="scatter-canvas"></canvas>
  </div>
</div>

<div id="win-overlay">
  <div id="win-box">
    <h2>Puzzle Complete!</h2>
    <p id="win-msg">You assembled Willowmere!</p>
    <button onclick="document.getElementById('win-overlay').classList.remove('show'); startGame()">Play Again</button>
  </div>
</div>

<script>
const boardCanvas = document.getElementById('board-canvas');
const boardCtx = boardCanvas.getContext('2d');
const scatterCanvas = document.getElementById('scatter-canvas');
const scatterCtx = scatterCanvas.getContext('2d');
const hintCanvas = document.getElementById('hint-canvas');
const hintCtx = hintCanvas.getContext('2d');

let COLS = 4, ROWS = 4;
let pieces = [];
let selected = null;
let solved = 0;
let startTime;
let hintVisible = false;

// Draw the source image onto an offscreen canvas
function drawScene(ctx, w, h) {
  const sky = ctx.createLinearGradient(0, 0, 0, h * 0.55);
  sky.addColorStop(0, '#1a2a50');
  sky.addColorStop(0.5, '#2a4a7a');
  sky.addColorStop(1, '#4a7a9a');
  ctx.fillStyle = sky;
  ctx.fillRect(0, 0, w, h);

  // Stars
  ctx.fillStyle = 'rgba(255,255,220,0.9)';
  const stars = [[0.05,0.06],[0.12,0.03],[0.22,0.08],[0.31,0.02],[0.45,0.07],[0.55,0.04],
    [0.67,0.09],[0.75,0.03],[0.85,0.06],[0.92,0.10],[0.18,0.14],[0.60,0.13],[0.38,0.16]];
  stars.forEach(([sx,sy]) => {
    ctx.beginPath(); ctx.arc(sx*w, sy*h, 1.2, 0, Math.PI*2); ctx.fill();
  });

  // Moon
  ctx.fillStyle = '#f8e8a0';
  ctx.beginPath(); ctx.arc(w*0.82, h*0.12, w*0.045, 0, Math.PI*2); ctx.fill();
  ctx.fillStyle = '#2a4a7a';
  ctx.beginPath(); ctx.arc(w*0.845, h*0.105, w*0.038, 0, Math.PI*2); ctx.fill();

  // Ground
  const ground = ctx.createLinearGradient(0, h*0.55, 0, h);
  ground.addColorStop(0, '#1a3020');
  ground.addColorStop(1, '#0e1e14');
  ctx.fillStyle = ground;
  ctx.fillRect(0, h*0.55, w, h*0.45);

  // Path
  ctx.fillStyle = '#3a4830';
  ctx.beginPath();
  ctx.moveTo(w*0.42, h); ctx.lineTo(w*0.58, h);
  ctx.lineTo(w*0.52, h*0.6); ctx.lineTo(w*0.48, h*0.6); ctx.closePath();
  ctx.fill();

  // Village buildings
  function drawBuilding(bx, by, bw, bh, roofH, col, roofCol, win) {
    ctx.fillStyle = col;
    ctx.fillRect(bx, by, bw, bh);
    ctx.fillStyle = roofCol;
    ctx.beginPath();
    ctx.moveTo(bx - 4, by);
    ctx.lineTo(bx + bw/2, by - roofH);
    ctx.lineTo(bx + bw + 4, by);
    ctx.closePath(); ctx.fill();
    if (win) {
      ctx.fillStyle = 'rgba(255,220,100,0.7)';
      ctx.fillRect(bx + bw*0.2, by + bh*0.25, bw*0.25, bh*0.25);
      ctx.fillRect(bx + bw*0.55, by + bh*0.25, bw*0.25, bh*0.25);
    }
  }
  drawBuilding(w*0.12, h*0.42, w*0.14, h*0.18, h*0.09, '#3a3028', '#5a3820', true);
  drawBuilding(w*0.29, h*0.38, w*0.12, h*0.22, h*0.10, '#2a3830', '#3a4828', true);
  drawBuilding(w*0.58, h*0.40, w*0.16, h*0.20, h*0.11, '#3a2820', '#5a4030', true);
  drawBuilding(w*0.76, h*0.44, w*0.10, h*0.16, h*0.08, '#2a2830', '#4a3a50', false);

  // Church spire (center)
  ctx.fillStyle = '#4a4838';
  ctx.fillRect(w*0.44, h*0.28, w*0.12, h*0.32);
  ctx.fillStyle = '#5a5040';
  ctx.beginPath();
  ctx.moveTo(w*0.40, h*0.28); ctx.lineTo(w*0.50, h*0.10); ctx.lineTo(w*0.60, h*0.28);
  ctx.closePath(); ctx.fill();
  // Cross
  ctx.strokeStyle = '#c8b880'; ctx.lineWidth = 2;
  ctx.beginPath(); ctx.moveTo(w*0.50, h*0.12); ctx.lineTo(w*0.50, h*0.22); ctx.stroke();
  ctx.beginPath(); ctx.moveTo(w*0.46, h*0.16); ctx.lineTo(w*0.54, h*0.16); ctx.stroke();
  // Church window
  ctx.fillStyle = 'rgba(255,200,80,0.6)';
  ctx.beginPath(); ctx.arc(w*0.50, h*0.33, w*0.025, 0, Math.PI, true); ctx.fill();
  ctx.fillRect(w*0.475, h*0.33, w*0.05, h*0.05);

  // Trees
  function drawTree(tx, ty, th, col) {
    ctx.fillStyle = '#1a2818';
    ctx.fillRect(tx - 3, ty, 6, th * 0.35);
    ctx.fillStyle = col || '#2a4828';
    ctx.beginPath();
    ctx.moveTo(tx, ty - th*0.6); ctx.lineTo(tx - th*0.28, ty + th*0.1);
    ctx.lineTo(tx + th*0.28, ty + th*0.1); ctx.closePath(); ctx.fill();
    ctx.beginPath();
    ctx.moveTo(tx, ty - th*0.85); ctx.lineTo(tx - th*0.2, ty - th*0.45);
    ctx.lineTo(tx + th*0.2, ty - th*0.45); ctx.closePath(); ctx.fill();
  }
  drawTree(w*0.06, h*0.58, h*0.22, '#1e3c1e');
  drawTree(w*0.20, h*0.60, h*0.18, '#253a25');
  drawTree(w*0.70, h*0.58, h*0.20, '#1e3c1e');
  drawTree(w*0.88, h*0.56, h*0.25, '#253a25');
  drawTree(w*0.93, h*0.62, h*0.18, '#1a341a');

  // Reflection in path
  ctx.fillStyle = 'rgba(255,220,80,0.12)';
  ctx.fillRect(w*0.43, h*0.62, w*0.14, h*0.04);

  // Subtle fireflies
  ctx.fillStyle = 'rgba(220,255,100,0.7)';
  [[0.15,0.65],[0.35,0.68],[0.63,0.63],[0.80,0.70]].forEach(([fx,fy]) => {
    ctx.beginPath(); ctx.arc(fx*w, fy*h, 1.5, 0, Math.PI*2); ctx.fill();
  });

  // Title text
  ctx.fillStyle = 'rgba(240,200,100,0.85)';
  ctx.font = `bold ${w*0.055}px Georgia, serif`;
  ctx.textAlign = 'center';
  ctx.fillText('Willowmere', w*0.5, h*0.95);
}

// --- Puzzle logic ---
let offscreen, PW, PH, BW, BH, pieceW, pieceH;
let placedGrid; // 2D array of piece indices

function initSizes() {
  const container = document.getElementById('board-container');
  BW = container.clientWidth;
  BH = Math.round(BW * 3 / 4);
  boardCanvas.width = BW; boardCanvas.height = BH;
  container.style.height = BH + 'px';

  pieceW = Math.floor(BW / COLS);
  pieceH = Math.floor(BH / ROWS);

  // Scatter area
  const sRows = Math.ceil((COLS * ROWS) / COLS);
  PW = BW;
  PH = sRows * (pieceH + 6) + 10;
  scatterCanvas.width = PW; scatterCanvas.height = PH;

  // Offscreen for source image
  offscreen = document.createElement('canvas');
  offscreen.width = BW; offscreen.height = BH;
  const oc = offscreen.getContext('2d');
  drawScene(oc, BW, BH);

  // Hint
  hintCanvas.width = BW; hintCanvas.height = BH;
  hintCtx.drawImage(offscreen, 0, 0);
}

function startGame() {
  COLS = parseInt(document.getElementById('grid-select').value);
  ROWS = COLS;
  selected = null; solved = 0; hintVisible = false;
  document.getElementById('hint-canvas').style.display = 'none';
  document.getElementById('win-overlay').classList.remove('show');
  initSizes();
  placedGrid = Array.from({length: ROWS}, () => Array(COLS).fill(null));

  // Create pieces
  const indices = Array.from({length: ROWS * COLS}, (_, i) => i);
  shuffle(indices);
  pieces = indices.map((idx, pos) => ({
    idx,
    row: Math.floor(idx / COLS),
    col: idx % COLS,
    placed: false,
    scatterPos: pos
  }));

  drawBoard();
  drawScatter();
  setStatus('Click a piece below, then click where it goes on the board.');
  startTime = Date.now();
}

function shuffle(arr) {
  for (let i = arr.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [arr[i], arr[j]] = [arr[j], arr[i]];
  }
}

function drawBoard() {
  boardCtx.clearRect(0, 0, BW, BH);
  // Grid ghost
  boardCtx.strokeStyle = 'rgba(100,140,180,0.3)';
  boardCtx.lineWidth = 1;
  for (let r = 0; r < ROWS; r++) {
    for (let c = 0; c < COLS; c++) {
      const x = c * pieceW, y = r * pieceH;
      boardCtx.strokeRect(x + 0.5, y + 0.5, pieceW - 1, pieceH - 1);
      const pidx = placedGrid[r][c];
      if (pidx !== null) {
        const p = pieces.find(p => p.idx === pidx);
        if (p) drawPieceOnCtx(boardCtx, p, x, y, true);
      }
    }
  }
  // Highlight selected target
  if (selected !== null) {
    boardCtx.strokeStyle = '#f0c060';
    boardCtx.lineWidth = 2;
    boardCtx.strokeRect(0.5, 0.5, BW - 1, BH - 1);
  }
}

function drawScatter() {
  scatterCtx.clearRect(0, 0, PW, PH);
  const perRow = COLS;
  pieces.forEach((p, i) => {
    if (p.placed) return;
    const sx = (i % perRow) * (pieceW + 4) + 2;
    const sy = Math.floor(i / perRow) * (pieceH + 6) + 4;
    drawPieceOnCtx(scatterCtx, p, sx, sy, false);
    if (selected === p) {
      scatterCtx.strokeStyle = '#f0c060';
      scatterCtx.lineWidth = 3;
      scatterCtx.strokeRect(sx - 1, sy - 1, pieceW + 2, pieceH + 2);
    }
  });
  // Adjust height
  const maxRow = Math.ceil(pieces.filter(p => !p.placed).length / COLS);
  scatterCanvas.height = Math.max(pieceH + 10, maxRow * (pieceH + 6) + 10);
}

function drawPieceOnCtx(ctx, p, x, y, onBoard) {
  ctx.save();
  ctx.beginPath();
  ctx.rect(x, y, pieceW, pieceH);
  ctx.clip();
  const sx = p.col * pieceW, sy = p.row * pieceH;
  ctx.drawImage(offscreen, sx, sy, pieceW, pieceH, x, y, pieceW, pieceH);
  if (!onBoard) {
    ctx.strokeStyle = 'rgba(200,200,255,0.5)'; ctx.lineWidth = 1;
    ctx.strokeRect(x, y, pieceW, pieceH);
  }
  ctx.restore();
}

function setStatus(msg) {
  document.getElementById('status').textContent = msg;
}

// Scatter click
scatterCanvas.addEventListener('click', e => {
  const rect = scatterCanvas.getBoundingClientRect();
  const scale = PW / rect.width;
  const mx = (e.clientX - rect.left) * scale;
  const my = (e.clientY - rect.top) * scale;
  const perRow = COLS;
  for (let i = 0; i < pieces.length; i++) {
    const p = pieces[i];
    if (p.placed) continue;
    const sx = (i % perRow) * (pieceW + 4) + 2;
    const sy = Math.floor(i / perRow) * (pieceH + 6) + 4;
    if (mx >= sx && mx <= sx + pieceW && my >= sy && my <= sy + pieceH) {
      selected = (selected === p) ? null : p;
      setStatus(selected ? 'Now click the correct spot on the board!' : 'Click a piece to select it.');
      drawBoard(); drawScatter(); return;
    }
  }
});

// Board click
boardCanvas.addEventListener('click', e => {
  if (!selected) { setStatus('Select a piece from below first.'); return; }
  const rect = boardCanvas.getBoundingClientRect();
  const scale = BW / rect.width;
  const mx = (e.clientX - rect.left) * scale;
  const my = (e.clientY - rect.top) * scale;
  const c = Math.floor(mx / pieceW);
  const r = Math.floor(my / pieceH);
  if (r < 0 || r >= ROWS || c < 0 || c >= COLS) return;

  if (placedGrid[r][c] !== null) {
    setStatus('That spot is taken! Try another.');
    return;
  }

  if (selected.row === r && selected.col === c) {
    placedGrid[r][c] = selected.idx;
    selected.placed = true;
    solved++;
    selected = null;
    const total = ROWS * COLS;
    setStatus(solved < total ? `${solved}/${total} placed — keep going!` : '');
    drawBoard(); drawScatter();
    if (solved === total) celebrate();
  } else {
    setStatus('Not quite right for that piece — try another spot!');
    selected = null;
    drawBoard(); drawScatter();
  }
});

function celebrate() {
  const elapsed = Math.round((Date.now() - startTime) / 1000);
  const mins = Math.floor(elapsed / 60), secs = elapsed % 60;
  const timeStr = mins > 0 ? `${mins}m ${secs}s` : `${secs}s`;
  document.getElementById('win-msg').textContent = `Completed in ${timeStr}! Willowmere at night.`;
  document.getElementById('win-overlay').classList.add('show');
}

function toggleHint() {
  hintVisible = !hintVisible;
  const hc = document.getElementById('hint-canvas');
  hc.style.display = hintVisible ? 'block' : 'none';
  hc.style.cssText = hintVisible
    ? 'display:block;width:90px;height:68px;border:1px solid #3a5a40;border-radius:4px;margin:6px auto;'
    : 'display:none';
}

window.addEventListener('resize', () => { if (pieces.length) startGame(); });
startGame();
</script>
</body>
</html>
