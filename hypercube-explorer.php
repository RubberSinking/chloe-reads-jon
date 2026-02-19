<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>4D Hypercube Explorer</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
  background: #0a0a1a;
  color: #e0e0e0;
  font-family: 'Segoe UI', system-ui, sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  overflow-x: hidden;
}
h1 {
  margin: 20px 0 5px;
  font-size: 1.6em;
  background: linear-gradient(135deg, #6ef, #c8f);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.subtitle {
  font-size: 0.85em;
  color: #888;
  margin-bottom: 10px;
}
canvas {
  display: block;
  touch-action: none;
  cursor: grab;
  border-radius: 12px;
  background: radial-gradient(ellipse at center, #111133 0%, #0a0a1a 70%);
}
canvas:active { cursor: grabbing; }
.controls {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
  padding: 15px;
  max-width: 600px;
}
.control-group {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
}
.control-group label {
  font-size: 0.75em;
  color: #aaa;
  text-transform: uppercase;
  letter-spacing: 1px;
}
input[type=range] {
  width: 120px;
  accent-color: #6ef;
}
button {
  background: linear-gradient(135deg, #335, #224);
  color: #6ef;
  border: 1px solid #6ef44;
  border-radius: 8px;
  padding: 8px 16px;
  cursor: pointer;
  font-size: 0.85em;
  transition: all 0.2s;
}
button:hover { background: #446; }
button.active { background: #264; border-color: #6f8; color: #6f8; }
.info {
  max-width: 560px;
  padding: 15px 20px;
  font-size: 0.82em;
  color: #999;
  line-height: 1.6;
  text-align: center;
}
.stats {
  font-family: monospace;
  font-size: 0.75em;
  color: #666;
  margin-top: 5px;
}
</style>
</head>
<body>

<h1>✦ 4D Hypercube Explorer</h1>
<p class="subtitle">Drag to rotate in 3D · Pinch/scroll to zoom · Use sliders for 4D rotation</p>

<canvas id="c"></canvas>

<div class="controls">
  <div class="control-group">
    <label>4D Rotation XW</label>
    <input type="range" id="rXW" min="0" max="6.283" step="0.01" value="0">
  </div>
  <div class="control-group">
    <label>4D Rotation YW</label>
    <input type="range" id="rYW" min="0" max="6.283" step="0.01" value="0">
  </div>
  <div class="control-group">
    <label>4D Rotation ZW</label>
    <input type="range" id="rZW" min="0" max="6.283" step="0.01" value="0">
  </div>
  <div class="control-group">
    <label>Projection</label>
    <input type="range" id="projDist" min="1.5" max="6" step="0.1" value="2.5">
  </div>
  <button id="autoBtn" class="active" onclick="toggleAuto()">Auto-Rotate</button>
  <button onclick="toggleShape()">Next Shape</button>
</div>

<p class="stats" id="stats"></p>

<div class="info">
  Inspired by Jon Aquino's fascination with the <em>Dimensions</em> video series —
  visualizing objects that live in 4-dimensional space by stereographically projecting
  them down to 3D, then onto your 2D screen. A hypercube (tesseract) has
  <strong>16 vertices</strong> and <strong>32 edges</strong>. What you see is its "shadow"
  in our world.
</div>

<script>
const canvas = document.getElementById('c');
const ctx = canvas.getContext('2d');

function resize() {
  const s = Math.min(window.innerWidth - 20, 560);
  canvas.width = s; canvas.height = s;
}
resize();
window.addEventListener('resize', resize);

// Shapes: hypercube, 16-cell, 24-cell
const shapes = [];
const shapeNames = ['Tesseract (8-cell)', '16-cell', '24-cell'];
let shapeIdx = 0;

// Tesseract: 16 vertices
(function() {
  const v = [];
  for (let i = 0; i < 16; i++) {
    v.push([(i&1)?1:-1, (i&2)?1:-1, (i&4)?1:-1, (i&8)?1:-1]);
  }
  const e = [];
  for (let i = 0; i < 16; i++)
    for (let j = i+1; j < 16; j++) {
      let diff = 0;
      for (let k = 0; k < 4; k++) if (v[i][k] !== v[j][k]) diff++;
      if (diff === 1) e.push([i, j]);
    }
  shapes.push({v, e});
})();

// 16-cell: 8 vertices (±1 on each axis)
(function() {
  const v = [];
  for (let d = 0; d < 4; d++) {
    for (let s of [-1, 1]) {
      const p = [0,0,0,0]; p[d] = s; v.push(p);
    }
  }
  const e = [];
  for (let i = 0; i < 8; i++)
    for (let j = i+1; j < 8; j++) {
      let dot = 0;
      for (let k = 0; k < 4; k++) dot += v[i][k]*v[j][k];
      if (dot === 0) e.push([i, j]);
    }
  shapes.push({v, e});
})();

// 24-cell: 24 vertices
(function() {
  const v = [];
  for (let i = 0; i < 4; i++)
    for (let j = i+1; j < 4; j++)
      for (let si of [-1,1])
        for (let sj of [-1,1]) {
          const p = [0,0,0,0]; p[i]=si; p[j]=sj; v.push(p);
        }
  const e = [];
  for (let i = 0; i < v.length; i++)
    for (let j = i+1; j < v.length; j++) {
      let d2 = 0;
      for (let k = 0; k < 4; k++) d2 += (v[i][k]-v[j][k])**2;
      if (Math.abs(d2 - 2) < 0.01) e.push([i, j]);
    }
  shapes.push({v, e});
})();

let autoRotate = true;
let rotX = 0.3, rotY = 0.5;
let dragging = false, lastX, lastY;
let zoom = 1;

function toggleAuto() {
  autoRotate = !autoRotate;
  document.getElementById('autoBtn').className = autoRotate ? 'active' : '';
}
function toggleShape() {
  shapeIdx = (shapeIdx + 1) % shapes.length;
}

// Pointer events for 3D rotation
canvas.addEventListener('pointerdown', e => { dragging = true; lastX = e.clientX; lastY = e.clientY; canvas.setPointerCapture(e.pointerId); });
canvas.addEventListener('pointermove', e => { if (!dragging) return; rotY += (e.clientX - lastX) * 0.01; rotX += (e.clientY - lastY) * 0.01; lastX = e.clientX; lastY = e.clientY; });
canvas.addEventListener('pointerup', () => dragging = false);
canvas.addEventListener('wheel', e => { e.preventDefault(); zoom *= e.deltaY > 0 ? 0.95 : 1.05; zoom = Math.max(0.3, Math.min(3, zoom)); }, {passive: false});

function rotate4(p, axw, ayw, azw) {
  let [x,y,z,w] = p;
  // XW
  let c = Math.cos(axw), s = Math.sin(axw);
  [x,w] = [x*c - w*s, x*s + w*c];
  // YW
  c = Math.cos(ayw); s = Math.sin(ayw);
  [y,w] = [y*c - w*s, y*s + w*c];
  // ZW
  c = Math.cos(azw); s = Math.sin(azw);
  [z,w] = [z*c - w*s, z*s + w*c];
  return [x,y,z,w];
}

function project4to3(p, d) {
  const scale = d / (d - p[3]);
  return [p[0]*scale, p[1]*scale, p[2]*scale, scale];
}

function rotate3(p, rx, ry) {
  let [x,y,z] = p;
  let c = Math.cos(rx), s = Math.sin(rx);
  [y,z] = [y*c - z*s, y*s + z*c];
  c = Math.cos(ry); s = Math.sin(ry);
  [x,z] = [x*c - z*s, x*s + z*c];
  return [x,y,z];
}

let t = 0;
function draw() {
  requestAnimationFrame(draw);
  const W = canvas.width, H = canvas.height;
  ctx.clearRect(0, 0, W, H);

  t += 0.005;
  const rXW = autoRotate ? parseFloat(document.getElementById('rXW').value) + t*0.7 : parseFloat(document.getElementById('rXW').value);
  const rYW = autoRotate ? parseFloat(document.getElementById('rYW').value) + t*0.5 : parseFloat(document.getElementById('rYW').value);
  const rZW = autoRotate ? parseFloat(document.getElementById('rZW').value) + t*0.3 : parseFloat(document.getElementById('rZW').value);
  const projDist = parseFloat(document.getElementById('projDist').value);

  const shape = shapes[shapeIdx];
  const projected = shape.v.map(v => {
    const r4 = rotate4(v, rXW, rYW, rZW);
    const [x, y, z, scale] = project4to3(r4, projDist);
    const r3 = rotate3([x, y, z], rotX, rotY);
    const fov = 4;
    const s2d = fov / (fov + r3[2]);
    return {
      x: W/2 + r3[0] * s2d * W * 0.18 * zoom,
      y: H/2 + r3[1] * s2d * W * 0.18 * zoom,
      depth: r3[2],
      scale: scale,
      s2d
    };
  });

  // Draw edges sorted by average depth (back to front)
  const edgesWithDepth = shape.e.map(([i,j]) => ({
    i, j, depth: (projected[i].depth + projected[j].depth) / 2
  }));
  edgesWithDepth.sort((a, b) => b.depth - a.depth);

  for (const {i, j, depth} of edgesWithDepth) {
    const a = projected[i], b = projected[j];
    const avgScale = (a.scale + b.scale) / 2;
    const hue = (avgScale * 120 + 180) % 360;
    const alpha = 0.3 + 0.5 * Math.min(1, avgScale / 2);
    const lw = Math.max(0.5, avgScale * 1.8);
    ctx.beginPath();
    ctx.moveTo(a.x, a.y);
    ctx.lineTo(b.x, b.y);
    ctx.strokeStyle = `hsla(${hue}, 80%, 65%, ${alpha})`;
    ctx.lineWidth = lw;
    ctx.stroke();
  }

  // Draw vertices
  for (const p of projected) {
    const r = Math.max(1.5, p.scale * 3);
    const hue = (p.scale * 120 + 180) % 360;
    ctx.beginPath();
    ctx.arc(p.x, p.y, r, 0, Math.PI * 2);
    ctx.fillStyle = `hsla(${hue}, 90%, 75%, 0.9)`;
    ctx.fill();
  }

  document.getElementById('stats').textContent =
    `${shapeNames[shapeIdx]} · ${shape.v.length} vertices · ${shape.e.length} edges`;
}
draw();
</script>

</body>
</html>
