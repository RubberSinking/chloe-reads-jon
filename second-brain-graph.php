<?php
// Second Brain Graph — Interactive knowledge graph builder
// Inspired by Jon's love of Obsidian as his personal knowledge base
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Second Brain Graph</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0f1117;
            --surface: #1a1d27;
            --surface2: #252836;
            --border: #2e3144;
            --text: #cdd6f4;
            --text-muted: #6c7086;
            --accent: #cba6f7;
            --accent2: #89dceb;
            --accent3: #a6e3a1;
            --accent4: #fab387;
            --accent5: #f38ba8;
            --accent6: #f9e2af;
            --link: #89b4fa;
        }

        html, body {
            width: 100%; height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: system-ui, -apple-system, sans-serif;
            overflow: hidden;
            touch-action: none;
        }

        #toolbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 56px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 12px;
            gap: 6px;
            z-index: 100;
            flex-wrap: wrap;
        }

        #toolbar h1 {
            font-size: 0.95em;
            font-weight: 700;
            color: var(--accent);
            margin-right: 8px;
            white-space: nowrap;
        }

        .sep {
            width: 1px;
            height: 28px;
            background: var(--border);
            margin: 0 4px;
        }

        .btn {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 6px;
            padding: 5px 11px;
            font-size: 0.8em;
            cursor: pointer;
            transition: all 0.15s;
            white-space: nowrap;
            user-select: none;
        }
        .btn:hover { background: var(--border); }
        .btn.active {
            background: var(--accent);
            color: var(--bg);
            border-color: var(--accent);
            font-weight: 600;
        }
        .btn.danger { color: var(--accent5); border-color: var(--accent5); }
        .btn.danger:hover { background: var(--accent5); color: var(--bg); }

        #canvas {
            position: fixed;
            top: 56px;
            left: 0;
            right: 0;
            bottom: 40px;
            cursor: default;
        }

        #statusbar {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            height: 40px;
            background: var(--surface);
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 16px;
            font-size: 0.75em;
            color: var(--text-muted);
            gap: 16px;
            z-index: 100;
        }
        #statusbar span { display: flex; align-items: center; gap: 5px; }
        #status-mode { color: var(--accent); font-weight: 600; }

        /* Input popup */
        #popup-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }
        #popup-overlay.show { display: flex; }
        #popup-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            width: min(90vw, 360px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }
        #popup-box h3 { margin-bottom: 12px; font-size: 0.95em; color: var(--accent); }
        #popup-input {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 12px;
            color: var(--text);
            font-size: 1em;
            outline: none;
            margin-bottom: 12px;
        }
        #popup-input:focus { border-color: var(--accent); }
        .popup-actions { display: flex; gap: 8px; justify-content: flex-end; }

        /* Help panel */
        #help-panel {
            display: none;
            position: fixed;
            top: 66px;
            right: 12px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 20px;
            font-size: 0.78em;
            line-height: 1.9;
            z-index: 150;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
            min-width: 200px;
        }
        #help-panel.show { display: block; }
        #help-panel h4 { color: var(--accent); margin-bottom: 8px; font-size: 0.9em; }
        #help-panel kbd {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 3px;
            padding: 1px 5px;
            font-size: 0.85em;
        }
        #help-panel .row { display: flex; gap: 8px; align-items: baseline; }
        #help-panel .key { color: var(--accent2); min-width: 70px; }

        .color-dot {
            display: inline-block;
            width: 10px; height: 10px;
            border-radius: 50%;
            margin-right: 3px;
        }
    </style>
</head>
<body>

<div id="toolbar">
    <h1>🧠 Second Brain</h1>
    <div class="sep"></div>
    <button class="btn active" id="btn-move" onclick="setMode('move')">✋ Move</button>
    <button class="btn" id="btn-add" onclick="setMode('add')">＋ Add Node</button>
    <button class="btn" id="btn-link" onclick="setMode('link')">🔗 Link</button>
    <button class="btn danger" id="btn-delete" onclick="setMode('delete')">✕ Delete</button>
    <div class="sep"></div>
    <button class="btn" onclick="saveGraph()">💾 Save</button>
    <button class="btn" onclick="clearGraph()">🗑 Clear</button>
    <button class="btn" onclick="loadDemo()">🌟 Demo</button>
    <div class="sep"></div>
    <button class="btn" id="btn-help" onclick="toggleHelp()">? Help</button>
</div>

<canvas id="canvas"></canvas>

<div id="statusbar">
    <span>Mode: <span id="status-mode">Move</span></span>
    <span id="status-nodes">0 nodes</span>
    <span id="status-edges">0 links</span>
    <span id="status-hint"></span>
</div>

<div id="popup-overlay">
    <div id="popup-box">
        <h3 id="popup-title">Add a Node</h3>
        <input id="popup-input" type="text" placeholder="Node label..." maxlength="40" autocomplete="off">
        <div class="popup-actions">
            <button class="btn" onclick="cancelPopup()">Cancel</button>
            <button class="btn active" onclick="confirmPopup()">Add</button>
        </div>
    </div>
</div>

<div id="help-panel">
    <h4>⌨️ How to use</h4>
    <div class="row"><span class="key">Move mode</span> Drag nodes around</div>
    <div class="row"><span class="key">Add mode</span> Click canvas → name node</div>
    <div class="row"><span class="key">Link mode</span> Click 2 nodes to connect</div>
    <div class="row"><span class="key">Delete mode</span> Click node/link to remove</div>
    <div class="row"><span class="key">Dbl-click</span> Rename a node</div>
    <div class="row"><span class="key">Scroll</span> Zoom in/out</div>
    <div class="row"><span class="key">Drag canvas</span> Pan view</div>
    <div class="row"><span class="key">A</span> Add mode</div>
    <div class="row"><span class="key">L</span> Link mode</div>
    <div class="row"><span class="key">M</span> Move mode</div>
    <div class="row"><span class="key">Del</span> Delete selected</div>
    <div class="row"><span class="key">Esc</span> Back to Move</div>
    <br>
    <div style="color:var(--text-muted)">Click node color dot<br>to cycle colors.<br>Auto-saves locally.</div>
</div>

<script>
const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

// ── State ──────────────────────────────────────────────
const COLORS = ['#cba6f7','#89dceb','#a6e3a1','#fab387','#f38ba8','#f9e2af','#89b4fa','#b4befe'];
let nodes = [];
let edges = [];
let nextId = 1;

// Viewport transform
let vx = 0, vy = 0, vscale = 1;

// Interaction
let mode = 'move';
let draggingNode = null, dragOffX = 0, dragOffY = 0;
let panningCanvas = false, panStartX = 0, panStartY = 0, panVX = 0, panVY = 0;
let linkSource = null;
let selectedNode = null;
let hoverNode = null;
let hoverEdge = null;
let lastClickTime = 0, lastClickNode = null;

// Physics
let animFrame;
const REPULSION = 3500;
const SPRING_K = 0.04;
const SPRING_LEN = 180;
const DAMPING = 0.88;
const GRAVITY = 0.015;
let physicsRunning = true;

// Popup state
let popupResolve = null;
let pendingX = 0, pendingY = 0;
let editingNode = null;

// ── Resize ────────────────────────────────────────────
function resizeCanvas() {
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
window.addEventListener('resize', () => { resizeCanvas(); });
resizeCanvas();

// ── Coordinate helpers ────────────────────────────────
function worldToScreen(wx, wy) {
    return { x: wx * vscale + vx, y: wy * vscale + vy };
}
function screenToWorld(sx, sy) {
    return { x: (sx - vx) / vscale, y: (sy - vy) / vscale };
}
function canvasPos(e) {
    const r = canvas.getBoundingClientRect();
    if (e.touches) {
        return { x: e.touches[0].clientX - r.left, y: e.touches[0].clientY - r.top };
    }
    return { x: e.clientX - r.left, y: e.clientY - r.top };
}

// ── Node helpers ──────────────────────────────────────
function nodeAt(sx, sy) {
    const w = screenToWorld(sx, sy);
    for (let i = nodes.length - 1; i >= 0; i--) {
        const n = nodes[i];
        const hw = nodeWidth(n) / 2, hh = 18;
        if (Math.abs(n.x - w.x) < hw && Math.abs(n.y - w.y) < hh) return n;
    }
    return null;
}

function nodeWidth(n) {
    ctx.font = `${Math.round(13 / Math.max(0.3, vscale))}px system-ui`;
    const w = ctx.measureText(n.label).width / vscale;
    return Math.max(80, w + 30);
}

function colorDotAt(sx, sy, node) {
    if (!node) return false;
    const s = worldToScreen(node.x, node.y);
    const nx = s.x, ny = s.y;
    const hw = nodeWidth(node) * vscale / 2;
    const dotX = nx - hw + 12;
    const dotY = ny - 14;
    const dx = sx - dotX, dy = sy - dotY;
    return Math.sqrt(dx*dx+dy*dy) < 8;
}

function edgeAt(sx, sy) {
    const w = screenToWorld(sx, sy);
    for (const e of edges) {
        const a = nodeById(e.source), b = nodeById(e.target);
        if (!a || !b) continue;
        // Check if point is near the line
        const dx = b.x - a.x, dy = b.y - a.y;
        const len = Math.sqrt(dx*dx+dy*dy);
        if (len < 1) continue;
        const t = Math.max(0, Math.min(1, ((w.x-a.x)*dx+(w.y-a.y)*dy)/(len*len)));
        const px = a.x+t*dx, py = a.y+t*dy;
        const d = Math.sqrt((w.x-px)**2+(w.y-py)**2);
        if (d < 12) return e;
    }
    return null;
}

function nodeById(id) { return nodes.find(n => n.id === id); }

function addNode(x, y, label, color) {
    const n = {
        id: nextId++,
        x, y,
        vx: 0, vy: 0,
        label: label || 'Node',
        color: color || COLORS[nodes.length % COLORS.length]
    };
    nodes.push(n);
    saveAuto();
    updateStatus();
    return n;
}

function removeNode(node) {
    nodes = nodes.filter(n => n.id !== node.id);
    edges = edges.filter(e => e.source !== node.id && e.target !== node.id);
    if (selectedNode === node) selectedNode = null;
    if (linkSource === node) linkSource = null;
    saveAuto();
    updateStatus();
}

function toggleEdge(aId, bId) {
    const idx = edges.findIndex(e =>
        (e.source===aId && e.target===bId) || (e.source===bId && e.target===aId));
    if (idx >= 0) {
        edges.splice(idx, 1);
    } else {
        edges.push({ source: aId, target: bId });
    }
    saveAuto();
    updateStatus();
}

function removeEdge(edge) {
    edges = edges.filter(e => e !== edge);
    saveAuto();
    updateStatus();
}

// ── Mode ──────────────────────────────────────────────
const modeLabels = { move:'Move', add:'Add Node', link:'Link', delete:'Delete' };
const modeHints = {
    move: 'Drag nodes • Scroll to zoom • Drag empty space to pan • Dbl-click to rename',
    add:  'Click anywhere on canvas to add a new node',
    link: 'Click a source node, then a target node to connect or disconnect',
    delete: 'Click a node or link to delete it'
};

function setMode(m) {
    mode = m;
    linkSource = null;
    selectedNode = null;
    ['move','add','link','delete'].forEach(id => {
        document.getElementById('btn-'+id).classList.toggle('active', id===m);
    });
    document.getElementById('status-mode').textContent = modeLabels[m];
    document.getElementById('status-hint').textContent = modeHints[m];
    canvas.style.cursor = m === 'add' ? 'crosshair' : m === 'delete' ? 'not-allowed' : 'default';
}

// ── Popup ─────────────────────────────────────────────
function showPopup(title, placeholder, defaultVal = '') {
    return new Promise(resolve => {
        popupResolve = resolve;
        document.getElementById('popup-title').textContent = title;
        const inp = document.getElementById('popup-input');
        inp.placeholder = placeholder;
        inp.value = defaultVal;
        document.getElementById('popup-overlay').classList.add('show');
        setTimeout(() => inp.focus(), 50);
    });
}
function confirmPopup() {
    const val = document.getElementById('popup-input').value.trim();
    document.getElementById('popup-overlay').classList.remove('show');
    if (popupResolve) { popupResolve(val); popupResolve = null; }
}
function cancelPopup() {
    document.getElementById('popup-overlay').classList.remove('show');
    if (popupResolve) { popupResolve(null); popupResolve = null; }
}
document.getElementById('popup-input').addEventListener('keydown', e => {
    if (e.key === 'Enter') confirmPopup();
    if (e.key === 'Escape') cancelPopup();
});

// ── Help ──────────────────────────────────────────────
function toggleHelp() {
    document.getElementById('help-panel').classList.toggle('show');
}

// ── Physics ───────────────────────────────────────────
function stepPhysics() {
    if (nodes.length < 2) return;
    const cx = canvas.width / 2, cy = canvas.height / 2;

    // Build adjacency for quick lookup
    const adj = {};
    for (const n of nodes) adj[n.id] = new Set();
    for (const e of edges) {
        adj[e.source].add(e.target);
        adj[e.target].add(e.source);
    }

    for (const n of nodes) {
        if (draggingNode === n) continue;

        let fx = 0, fy = 0;

        // Repulsion from other nodes
        for (const m of nodes) {
            if (m === n) continue;
            const dx = n.x - m.x, dy = n.y - m.y;
            const dist2 = dx*dx + dy*dy + 0.01;
            const dist = Math.sqrt(dist2);
            const force = REPULSION / dist2;
            fx += (dx / dist) * force;
            fy += (dy / dist) * force;
        }

        // Spring attraction along edges
        if (adj[n.id]) {
            for (const otherId of adj[n.id]) {
                const m = nodeById(otherId);
                if (!m) continue;
                const dx = m.x - n.x, dy = m.y - n.y;
                const dist = Math.sqrt(dx*dx+dy*dy) + 0.01;
                const stretch = dist - SPRING_LEN;
                fx += (dx/dist) * SPRING_K * stretch;
                fy += (dy/dist) * SPRING_K * stretch;
            }
        }

        // Gravity toward world center (0,0)
        fx -= n.x * GRAVITY;
        fy -= n.y * GRAVITY;

        // Keep in a large bounding box (world coords)
        const bound = 1400;
        if (Math.abs(n.x) > bound) fx -= (n.x - Math.sign(n.x)*bound) * 0.1;
        if (Math.abs(n.y) > bound) fy -= (n.y - Math.sign(n.y)*bound) * 0.1;

        n.vx = (n.vx + fx * 0.5) * DAMPING;
        n.vy = (n.vy + fy * 0.5) * DAMPING;
        n.x += n.vx;
        n.y += n.vy;
    }
}

// ── Rendering ─────────────────────────────────────────
function drawArrow(x1, y1, x2, y2, color) {
    const angle = Math.atan2(y2-y1, x2-x1);
    const len = Math.sqrt((x2-x1)**2+(y2-y1)**2);
    if (len < 2) return;
    // Shorten endpoints
    const pad = 22 * vscale;
    const sx = x1 + Math.cos(angle)*pad, sy = y1 + Math.sin(angle)*pad;
    const ex = x2 - Math.cos(angle)*pad, ey = y2 - Math.sin(angle)*pad;

    ctx.beginPath();
    ctx.moveTo(sx, sy);
    // Slight curve
    const mx = (sx+ex)/2 - Math.sin(angle)*20*vscale;
    const my = (sy+ey)/2 + Math.cos(angle)*20*vscale;
    ctx.quadraticCurveTo(mx, my, ex, ey);
    ctx.strokeStyle = color;
    ctx.lineWidth = 1.5 * vscale;
    ctx.stroke();

    // Arrowhead
    const aLen = 8 * vscale;
    ctx.beginPath();
    const aAngle = Math.atan2(ey - my, ex - mx);
    ctx.moveTo(ex, ey);
    ctx.lineTo(ex - aLen*Math.cos(aAngle-0.35), ey - aLen*Math.sin(aAngle-0.35));
    ctx.lineTo(ex - aLen*Math.cos(aAngle+0.35), ey - aLen*Math.sin(aAngle+0.35));
    ctx.closePath();
    ctx.fillStyle = color;
    ctx.fill();
}

function drawNode(n, isSelected, isHover, isLinkSrc) {
    const s = worldToScreen(n.x, n.y);
    const nx = s.x, ny = s.y;

    ctx.font = `${Math.max(10, Math.round(13 * vscale))}px system-ui`;
    const textW = ctx.measureText(n.label).width;
    const hw = Math.max(80 * vscale, textW / 2 + 18 * vscale);
    const hh = 18 * vscale;

    // Glow
    if (isSelected || isHover || isLinkSrc) {
        ctx.shadowColor = n.color;
        ctx.shadowBlur = isLinkSrc ? 20 : 12;
    }

    // Background
    ctx.beginPath();
    const r = 8 * vscale;
    ctx.roundRect(nx - hw, ny - hh, hw*2, hh*2, r);
    ctx.fillStyle = '#1e2030';
    ctx.fill();

    // Border
    ctx.strokeStyle = (isSelected || isLinkSrc) ? n.color : (isHover ? n.color + '99' : '#2e3144');
    ctx.lineWidth = (isSelected || isLinkSrc) ? 2.5 * vscale : 1.5 * vscale;
    ctx.stroke();

    ctx.shadowBlur = 0;
    ctx.shadowColor = 'transparent';

    // Color dot
    const dotX = nx - hw + 10 * vscale;
    const dotY = ny;
    const dotR = 4 * vscale;
    ctx.beginPath();
    ctx.arc(dotX, dotY, dotR, 0, Math.PI*2);
    ctx.fillStyle = n.color;
    ctx.fill();

    // Label
    ctx.fillStyle = isHover ? '#fff' : '#cdd6f4';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText(n.label, nx + 5 * vscale, ny);
}

function render() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw grid (subtle)
    const gsize = 50 * vscale;
    const ox = ((vx % gsize) + gsize) % gsize;
    const oy = ((vy % gsize) + gsize) % gsize;
    ctx.strokeStyle = '#1a1d27';
    ctx.lineWidth = 1;
    for (let x = ox; x < canvas.width; x += gsize) {
        ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, canvas.height); ctx.stroke();
    }
    for (let y = oy; y < canvas.height; y += gsize) {
        ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(canvas.width, y); ctx.stroke();
    }

    // Draw edges
    for (const e of edges) {
        const a = nodeById(e.source), b = nodeById(e.target);
        if (!a || !b) continue;
        const sa = worldToScreen(a.x, a.y), sb = worldToScreen(b.x, b.y);
        const isHover = e === hoverEdge;
        const color = isHover ? '#89b4fa' : '#3a3d52';
        drawArrow(sa.x, sa.y, sb.x, sb.y, color);
    }

    // Link mode: draw line from source to cursor
    if (mode === 'link' && linkSource && hoverNode && hoverNode !== linkSource) {
        const sa = worldToScreen(linkSource.x, linkSource.y);
        const sb = worldToScreen(hoverNode.x, hoverNode.y);
        ctx.setLineDash([5, 5]);
        drawArrow(sa.x, sa.y, sb.x, sb.y, '#cba6f7aa');
        ctx.setLineDash([]);
    }

    // Draw nodes
    for (const n of nodes) {
        drawNode(n, n === selectedNode, n === hoverNode, n === linkSource);
    }

    // Status count
    document.getElementById('status-nodes').textContent = `${nodes.length} node${nodes.length!==1?'s':''}`;
    document.getElementById('status-edges').textContent = `${edges.length} link${edges.length!==1?'s':''}`;
}

function tick() {
    stepPhysics();
    render();
    animFrame = requestAnimationFrame(tick);
}

// ── Mouse Events ──────────────────────────────────────
canvas.addEventListener('mousedown', onDown);
canvas.addEventListener('mousemove', onMove);
canvas.addEventListener('mouseup', onUp);
canvas.addEventListener('dblclick', onDblClick);
canvas.addEventListener('wheel', onWheel, { passive: false });
canvas.addEventListener('contextmenu', e => e.preventDefault());

function onDown(e) {
    if (e.button !== 0 && e.button !== 1) return;
    const pos = canvasPos(e);
    const node = nodeAt(pos.x, pos.y);

    if (mode === 'move') {
        if (node) {
            draggingNode = node;
            const w = screenToWorld(pos.x, pos.y);
            dragOffX = w.x - node.x;
            dragOffY = w.y - node.y;
            selectedNode = node;
        } else {
            panningCanvas = true;
            panStartX = pos.x; panStartY = pos.y;
            panVX = vx; panVY = vy;
            selectedNode = null;
        }
    } else if (mode === 'add') {
        if (!node) {
            const w = screenToWorld(pos.x, pos.y);
            pendingX = w.x; pendingY = w.y;
            showPopup('Add a Node', 'Type a label...').then(label => {
                if (label) addNode(pendingX, pendingY, label);
            });
        }
    } else if (mode === 'link') {
        if (node) {
            if (!linkSource) {
                linkSource = node;
            } else if (linkSource !== node) {
                toggleEdge(linkSource.id, node.id);
                linkSource = null;
            }
        } else {
            linkSource = null;
        }
    } else if (mode === 'delete') {
        if (node) {
            removeNode(node);
        } else {
            const edge = edgeAt(pos.x, pos.y);
            if (edge) removeEdge(edge);
        }
    }
}

function onMove(e) {
    const pos = canvasPos(e);
    if (draggingNode) {
        const w = screenToWorld(pos.x, pos.y);
        draggingNode.x = w.x - dragOffX;
        draggingNode.y = w.y - dragOffY;
        draggingNode.vx = 0; draggingNode.vy = 0;
    } else if (panningCanvas) {
        vx = panVX + (pos.x - panStartX);
        vy = panVY + (pos.y - panStartY);
    } else {
        const newHover = nodeAt(pos.x, pos.y);
        const newEdgeHover = (!newHover && mode !== 'add') ? edgeAt(pos.x, pos.y) : null;
        if (hoverNode !== newHover || hoverEdge !== newEdgeHover) {
            hoverNode = newHover;
            hoverEdge = newEdgeHover;
        }
        // Cursor
        if (newHover) {
            canvas.style.cursor = mode === 'move' ? 'grab' : mode === 'delete' ? 'not-allowed' : 'pointer';
        } else if (newEdgeHover && mode === 'delete') {
            canvas.style.cursor = 'not-allowed';
        } else {
            canvas.style.cursor = mode === 'add' ? 'crosshair' : mode === 'delete' ? 'default' : 'default';
        }
    }
}

function onUp(e) {
    if (draggingNode) { saveAuto(); }
    draggingNode = null;
    panningCanvas = false;
}

function onDblClick(e) {
    const pos = canvasPos(e);
    const node = nodeAt(pos.x, pos.y);
    if (node) {
        // Check if clicking color dot
        if (colorDotAt(pos.x, pos.y, node)) {
            const idx = COLORS.indexOf(node.color);
            node.color = COLORS[(idx + 1) % COLORS.length];
            saveAuto();
            return;
        }
        editingNode = node;
        showPopup('Rename Node', 'New label...', node.label).then(label => {
            if (label && editingNode) {
                editingNode.label = label;
                saveAuto();
            }
            editingNode = null;
        });
    }
}

function onWheel(e) {
    e.preventDefault();
    const pos = canvasPos(e);
    const delta = e.deltaY > 0 ? 0.85 : 1.18;
    const wx = (pos.x - vx) / vscale, wy = (pos.y - vy) / vscale;
    vscale = Math.max(0.2, Math.min(4, vscale * delta));
    vx = pos.x - wx * vscale;
    vy = pos.y - wy * vscale;
}

// ── Touch Events ──────────────────────────────────────
let lastTouchDist = null;
canvas.addEventListener('touchstart', e => {
    e.preventDefault();
    if (e.touches.length === 1) {
        onDown({ ...e, clientX: e.touches[0].clientX, clientY: e.touches[0].clientY, button: 0 });
    } else if (e.touches.length === 2) {
        draggingNode = null;
        panningCanvas = false;
        lastTouchDist = Math.hypot(
            e.touches[0].clientX - e.touches[1].clientX,
            e.touches[0].clientY - e.touches[1].clientY
        );
    }
}, { passive: false });

canvas.addEventListener('touchmove', e => {
    e.preventDefault();
    if (e.touches.length === 1) {
        onMove({ ...e, clientX: e.touches[0].clientX, clientY: e.touches[0].clientY });
    } else if (e.touches.length === 2 && lastTouchDist) {
        const d = Math.hypot(
            e.touches[0].clientX - e.touches[1].clientX,
            e.touches[0].clientY - e.touches[1].clientY
        );
        const ratio = d / lastTouchDist;
        const cx = (e.touches[0].clientX + e.touches[1].clientX) / 2;
        const cy = (e.touches[0].clientY + e.touches[1].clientY) / 2;
        const r = canvas.getBoundingClientRect();
        const sx = cx - r.left, sy = cy - r.top;
        const wx = (sx - vx) / vscale, wy = (sy - vy) / vscale;
        vscale = Math.max(0.2, Math.min(4, vscale * ratio));
        vx = sx - wx * vscale; vy = sy - wy * vscale;
        lastTouchDist = d;
    }
}, { passive: false });

canvas.addEventListener('touchend', e => {
    e.preventDefault();
    onUp({});
    if (e.touches.length < 2) lastTouchDist = null;
}, { passive: false });

// ── Keyboard ──────────────────────────────────────────
document.addEventListener('keydown', e => {
    if (document.getElementById('popup-overlay').classList.contains('show')) return;
    if (e.key === 'a' || e.key === 'A') setMode('add');
    else if (e.key === 'l' || e.key === 'L') setMode('link');
    else if (e.key === 'm' || e.key === 'M') setMode('move');
    else if (e.key === 'd' || e.key === 'D') setMode('delete');
    else if (e.key === 'Escape') { setMode('move'); linkSource = null; }
    else if ((e.key === 'Delete' || e.key === 'Backspace') && selectedNode) {
        if (e.key === 'Backspace') e.preventDefault();
        removeNode(selectedNode);
    }
    else if (e.key === 'h' || e.key === 'H' || e.key === '?') toggleHelp();
});

// ── Save/Load ─────────────────────────────────────────
function saveGraph() {
    const data = JSON.stringify({ nodes, edges, nextId, vx, vy, vscale });
    localStorage.setItem('second-brain-graph', data);
    // Brief visual flash
    const btn = document.querySelector('[onclick="saveGraph()"]');
    const orig = btn.textContent;
    btn.textContent = '✓ Saved!';
    setTimeout(() => btn.textContent = orig, 1200);
}

function saveAuto() {
    const data = JSON.stringify({ nodes, edges, nextId, vx, vy, vscale });
    localStorage.setItem('second-brain-graph', data);
}

function loadSaved() {
    try {
        const raw = localStorage.getItem('second-brain-graph');
        if (!raw) return false;
        const data = JSON.parse(raw);
        nodes = data.nodes || [];
        edges = data.edges || [];
        nextId = data.nextId || (nodes.length + 1);
        vx = data.vx || 0; vy = data.vy || 0; vscale = data.vscale || 1;
        return true;
    } catch { return false; }
}

function clearGraph() {
    if (nodes.length === 0 || confirm('Clear the entire graph?')) {
        nodes = []; edges = []; nextId = 1;
        saveAuto(); updateStatus();
    }
}

function updateStatus() {
    document.getElementById('status-nodes').textContent = `${nodes.length} node${nodes.length!==1?'s':''}`;
    document.getElementById('status-edges').textContent = `${edges.length} link${edges.length!==1?'s':''}`;
}

// ── Demo graph ────────────────────────────────────────
function loadDemo() {
    nodes = []; edges = []; nextId = 1;
    // Center view
    vx = canvas.width / 2; vy = canvas.height / 2; vscale = 1;

    function n(label, x, y, color) {
        return addNode(x, y, label, color);
    }

    const jon    = n("Jon",            0,    0,    '#cba6f7');
    const faith  = n("Faith",         -260, -160, '#f38ba8');
    const tech   = n("Technology",    250,  -160, '#89b4fa');
    const family = n("Family",         0,   220,  '#a6e3a1');
    const prod   = n("Productivity",  -260,  160, '#fab387');
    const coding = n("Coding",         260,  160, '#89dceb');

    const rosary  = n("Rosary",       -460, -240, '#f38ba8');
    const saints  = n("Saints",       -280, -300, '#f38ba8');
    const catechism = n("Catechism",  -480, -100, '#f38ba8');
    const lectio  = n("Lectio Divina",-200, -280, '#f38ba8');

    const claude  = n("Claude",        400, -260, '#89b4fa');
    const obsidian= n("Obsidian",      500,  -80, '#89b4fa');
    const omarchy = n("Omarchy",       260, -300, '#89b4fa');
    const yubnub  = n("YubNub",        440,  -80, '#89b4fa');

    const nathan  = n("Nathan",       -100,  360, '#a6e3a1');
    const zelda   = n("Legend of Zelda",-260, 340, '#a6e3a1');
    const mario   = n("Super Mario",   -400, 240, '#a6e3a1');
    const kr      = n("Knight Rider",   100, 400, '#a6e3a1');

    const todoist = n("Todoist",      -420,  80,  '#fab387');
    const autofocus = n("Autofocus",  -440, 220, '#fab387');
    const grit    = n("Grit",         -280, 240, '#fab387');

    const ccode   = n("Claude Code",   400,  260, '#89dceb');
    const lazygit = n("LazyGit",       480,  180, '#89dceb');
    const rust    = n("Fish Shell",    260,  280, '#89dceb');

    const link = (a, b) => edges.push({ source: a.id, target: b.id });

    link(jon, faith); link(jon, tech); link(jon, family);
    link(jon, prod); link(jon, coding);

    link(faith, rosary); link(faith, saints); link(faith, catechism); link(faith, lectio);
    link(tech, claude); link(tech, obsidian); link(tech, omarchy); link(tech, yubnub);
    link(family, nathan); link(nathan, zelda); link(nathan, mario); link(nathan, kr);
    link(prod, todoist); link(prod, autofocus); link(prod, grit);
    link(coding, ccode); link(coding, lazygit); link(coding, rust);

    link(claude, ccode);
    link(obsidian, prod);

    saveAuto(); updateStatus();
}

// ── Init ──────────────────────────────────────────────
if (!loadSaved()) {
    // First time: center the view and load demo
    vx = 0; vy = 0; vscale = 1;
    loadDemo();
}

// Center viewport on first load
if (nodes.length > 0) {
    let cx = 0, cy = 0;
    for (const n of nodes) { cx += n.x; cy += n.y; }
    cx /= nodes.length; cy /= nodes.length;
    vx = canvas.width / 2 - cx * vscale;
    vy = canvas.height / 2 - cy * vscale;
}

setMode('move');
tick();
</script>
</body>
</html>
