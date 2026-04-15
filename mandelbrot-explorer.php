<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandelbrot Explorer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Spectral:ital,wght@0,300;0,600;1,300&display=swap');

        :root {
            --bg: #030308;
            --panel: rgba(8,8,18,0.92);
            --border: rgba(120,100,255,0.25);
            --gold: #e8c97a;
            --gold-dim: rgba(232,201,122,0.4);
            --blue: #7a9eff;
            --dim: rgba(255,255,255,0.45);
            --text: #ddd8f0;
            --accent: #b89dff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Space Mono', monospace;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* Starfield */
        .stars {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        canvas#mandel {
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            cursor: crosshair;
            image-rendering: pixelated;
        }

        /* UI Overlay */
        .ui {
            position: fixed;
            inset: 0;
            z-index: 10;
            pointer-events: none;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .title-block h1 {
            font-family: 'Space Mono', monospace;
            font-size: clamp(14px, 2.5vw, 18px);
            font-weight: 700;
            color: var(--gold);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .title-block .subtitle {
            font-family: 'Spectral', serif;
            font-style: italic;
            font-size: 11px;
            color: var(--blue);
            opacity: 0.8;
        }

        .controls {
            pointer-events: all;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 16px 18px;
            width: clamp(220px, 28vw, 300px);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .controls h2 {
            font-size: 10px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }

        .control-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 11px;
        }

        .control-row label {
            color: var(--dim);
            font-size: 11px;
        }

        .control-row input[type="range"] {
            width: 110px;
            accent-color: var(--gold);
            cursor: pointer;
        }

        .control-row .val {
            color: var(--accent);
            min-width: 32px;
            text-align: right;
            font-size: 10px;
        }

        .btn-row {
            display: flex;
            gap: 8px;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
        }

        button {
            background: rgba(232,201,122,0.08);
            border: 1px solid var(--gold-dim);
            color: var(--gold);
            padding: 7px 12px;
            border-radius: 6px;
            font-family: 'Space Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.06em;
            cursor: pointer;
            transition: all 0.18s;
            pointer-events: all;
        }

        button:hover {
            background: rgba(232,201,122,0.18);
            border-color: var(--gold);
            transform: translateY(-1px);
        }

        button.primary {
            background: rgba(232,201,122,0.15);
            border-color: var(--gold);
        }

        .zoom-info {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid var(--border);
            font-size: 10px;
            color: var(--dim);
            line-height: 1.7;
        }

        .zoom-info span {
            color: var(--blue);
        }

        .hint {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Spectral', serif;
            font-style: italic;
            font-size: 12px;
            color: rgba(255,255,255,0.3);
            pointer-events: none;
            z-index: 10;
            text-align: center;
            transition: opacity 0.5s;
        }

        .hint.hidden { opacity: 0; }

        /* Coordinate display */
        .coord-display {
            position: fixed;
            bottom: 24px;
            right: 24px;
            font-size: 10px;
            color: rgba(180,160,255,0.4);
            font-family: 'Space Mono', monospace;
            z-index: 10;
            pointer-events: none;
            text-align: right;
            line-height: 1.8;
        }

        /* Color scheme selector */
        .scheme-row {
            margin-top: 10px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .scheme-btn {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.15s;
            padding: 0;
            flex-shrink: 0;
        }

        .scheme-btn.active {
            border-color: var(--gold);
            transform: scale(1.15);
        }

        /* Loading shimmer */
        @keyframes shimmer {
            0% { opacity: 0.3; }
            50% { opacity: 0.7; }
            100% { opacity: 0.3; }
        }

        .loading-msg {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Spectral', serif;
            font-style: italic;
            font-size: 16px;
            color: rgba(232,201,122,0.6);
            z-index: 20;
            pointer-events: none;
            animation: shimmer 1.4s infinite;
        }

        .loading-msg.hidden { display: none; }

        /* Quote block */
        .quote-block {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            pointer-events: none;
            text-align: center;
            max-width: 400px;
        }

        .quote-block p {
            font-family: 'Spectral', serif;
            font-style: italic;
            font-size: clamp(10px, 1.5vw, 13px);
            color: rgba(220,210,255,0.35);
            line-height: 1.6;
        }

        .quote-block cite {
            display: block;
            font-size: 10px;
            color: rgba(232,201,122,0.3);
            margin-top: 4px;
            font-style: normal;
            letter-spacing: 0.08em;
        }
    </style>
</head>
<body>

<div class="stars" id="stars"></div>
<canvas id="mandel"></canvas>

<div class="ui">
    <div class="header">
        <div class="title-block">
            <h1>Mandelbrot Explorer</h1>
            <div class="subtitle">Plato's divided line, rendered in complex numbers</div>
        </div>
    </div>

    <div style="display:flex; justify-content:flex-end; padding: 0 24px;">
        <div class="controls">
            <h2>Exploration Controls</h2>

            <div class="control-row">
                <label>Max Iterations</label>
                <input type="range" id="maxIter" min="50" max="2000" value="300">
                <span class="val" id="iterVal">300</span>
            </div>

            <div class="control-row">
                <label>Zoom Speed</label>
                <input type="range" id="zoomSpeed" min="1" max="10" value="4">
                <span class="val" id="zoomVal">4</span>
            </div>

            <div class="control-row">
                <label>Color Scheme</label>
            </div>
            <div class="scheme-row" id="schemes">
                <button class="scheme-btn active" style="background: linear-gradient(135deg,#000428,#ff6b35,#fff5cc)" data-s="fire" title="Fire"></button>
                <button class="scheme-btn" style="background: linear-gradient(135deg,#001022,#00e5ff,#ffffff)" data-s="ice" title="Ice"></button>
                <button class="scheme-btn" style="background: linear-gradient(135deg,#1a0026,#d400ff,#ffccff)" data-s="void" title="Void"></button>
                <button class="scheme-btn" style="background: linear-gradient(135deg,#001a00,#00ff88,#ccffee)" data-s="emerald" title="Emerald"></button>
                <button class="scheme-btn" style="background: linear-gradient(135deg,#0a0a14,#7a9eff,#ffffff)" data-s="stellar" title="Stellar"></button>
                <button class="scheme-btn" style="background: linear-gradient(135deg,#1a0a00,#ffaa00,#fff8e0)" data-s="gold" title="Gold"></button>
            </div>

            <div class="btn-row">
                <button class="primary" id="resetBtn">Reset View</button>
                <button id="juliaBtn">Show Julia Set</button>
                <button id="gridBtn">Toggle Grid</button>
            </div>

            <div class="zoom-info">
                Center Re: <span id="infoRe">-0.5</span><br>
                Center Im: <span id="infoIm">0.0</span><br>
                Zoom: <span id="infoZoom">1.0</span>x<br>
                Click to zoom in<br>
                Right-click to zoom out
            </div>
        </div>
    </div>
</div>

<div class="quote-block" id="quoteBlock">
    <p id="quoteText">"The programmer, like the poet, works only slightly removed from pure thought-stuff."</p>
    <cite id="quoteCite">Frederick P. Brooks, The Mythical Man-Month</cite>
</div>

<div class="hint" id="hint">Click anywhere to zoom in &mdash; right-click to zoom out</div>
<div class="loading-msg hidden" id="loadingMsg">Rendering fractal...</div>

<div class="coord-display" id="coordDisplay"></div>

<script>
(function() {
    const canvas = document.getElementById('mandel');
    const ctx = canvas.getContext('2d');

    const quotes = [
        { text: '"The programmer, like the poet, works only slightly removed from pure thought-stuff."', cite: 'Frederick P. Brooks, The Mythical Man-Month' },
        { text: '"Plato posited that mathematical reasoning has its own existence, outside of time and space and outside of the mind."', cite: 'Jon Aquino, on the Mandelbrot set' },
        { text: '"Why should the aged eagle stretch its wings?"', cite: 'T.S. Eliot, The Waste Land' },
        { text: '"Mathematicians have always been fascinated by the boundary between the finite and the infinite."', cite: '' },
        { text: '"Reality is merely a shadow of the world of Forms."', cite: 'Plato, Allegory of the Divided Line' },
    ];

    let qi = 0;
    function rotateQuote() {
        qi = (qi + 1) % quotes.length;
        const q = quotes[qi];
        document.getElementById('quoteText').textContent = q.text;
        document.getElementById('quoteCite').textContent = q.cite;
    }
    setInterval(rotateQuote, 8000);

    // Color schemes
    const schemes = {
        fire: (t, i, max) => {
            if (i === max) return [3, 3, 8];
            const s = i / max;
            const r = Math.min(255, Math.pow(s, 0.4) * 255);
            const g = Math.pow(s, 2.5) * 180;
            const b = Math.pow(s, 6) * 60;
            return [r, g + s * 40, b];
        },
        ice: (t, i, max) => {
            if (i === max) return [0, 5, 20];
            const s = i / max;
            const r = s * 0.2;
            const g = Math.pow(s, 0.6) * 0.9;
            const b = 0.5 + Math.pow(s, 0.3) * 0.5;
            return [r, g, b];
        },
        void: (t, i, max) => {
            if (i === max) return [10, 0, 18];
            const s = i / max;
            const phase = s * Math.PI * 2 + t * 0.0003;
            const r = Math.pow(s, 0.5) * (0.7 + 0.3 * Math.sin(phase)) * 0.85;
            const g = Math.pow(s, 1.5) * 0.1;
            const b = Math.pow(s, 0.3) * (0.8 + 0.2 * Math.sin(phase + 1));
            return [r, g, b];
        },
        emerald: (t, i, max) => {
            if (i === max) return [0, 10, 0];
            const s = i / max;
            const r = Math.pow(s, 3) * 0.1;
            const g = 0.3 + Math.pow(s, 0.5) * 0.6;
            const b = Math.pow(s, 4) * 0.5;
            return [r, g, b];
        },
        stellar: (t, i, max) => {
            if (i === max) return [0, 2, 12];
            const s = i / max;
            const r = Math.pow(s, 0.5) * 0.5;
            const g = 0.3 + Math.pow(s, 0.8) * 0.5;
            const b = 0.6 + Math.pow(s, 0.3) * 0.4;
            return [r, g, b];
        },
        gold: (t, i, max) => {
            if (i === max) return [15, 10, 0];
            const s = i / max;
            const r = 0.4 + Math.pow(s, 0.4) * 0.6;
            const g = 0.3 + Math.pow(s, 0.6) * 0.5;
            const b = Math.pow(s, 3) * 0.15;
            return [r, g, b];
        },
    };

    let currentScheme = 'fire';
    let maxIter = 300;
    let showJulia = false;
    let showGrid = false;
    let zoomSpeed = 4;
    let animFrame = 0;
    let rendering = false;
    let rendered = false;
    let pendingRender = false;

    // View state
    let view = {
        centerRe: -0.5,
        centerIm: 0.0,
        zoom: 1.0,
        range: 3.5, // total height in complex plane
    };

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        scheduleRender();
    }

    function scheduleRender() {
        if (rendering) { pendingRender = true; return; }
        renderFractal();
    }

    function mandelbrot(cr, ci, maxIter) {
        let zr = 0, zi = 0;
        let zr2 = 0, zi2 = 0;
        let i = 0;
        while (i < maxIter && zr2 + zi2 <= 4) {
            zi = 2 * zr * zi + ci;
            zr = zr2 - zi2 + cr;
            zr2 = zr * zr;
            zi2 = zi * zi;
            i++;
        }
        return i;
    }

    function julia(zr, zi, maxIter) {
        let cr = -0.7269, ci = 0.1889; // some interesting julia seed
        let zr2 = zr*zr, zi2 = zi*zi;
        let i = 0;
        while (i < maxIter && zr2 + zi2 <= 4) {
            zi = 2 * zr * zi + ci;
            zr = zr2 - zi2 + cr;
            zr2 = zr * zr;
            zi2 = zi * zi;
            i++;
        }
        return i;
    }

    function scheduleRender() { renderFractal(); }

    function renderFractal() {
        rendering = true;
        document.getElementById('loadingMsg').classList.remove('hidden');
        rendered = false;

        const width = canvas.width;
        const height = canvas.height;
        const colorFn = schemes[currentScheme];
        const maxI = maxIter;
        const range = view.range / view.zoom;
        const halfW = range * width / height / 2;
        const halfH = range / 2;
        const re0 = view.centerRe - halfW;
        const im0 = view.centerIm - halfH;

        const imageData = ctx.createImageData(width, height);
        const data = imageData.data;

        // Process in rows
        let y = 0;

        function processRow() {
            const endY = Math.min(y + 8, height);
            for (let py = y; py < endY; py++) {
                const ci = im0 + py * range / height;
                for (let px = 0; px < width; px++) {
                    const cr = re0 + px * range / height * (height / width);
                    const i = showJulia ? julia(cr, ci, maxI) : mandelbrot(cr, ci, maxI);
                    const idx = (py * width + px) * 4;
                    const t = animFrame;

                    if (i === maxI) {
                        data[idx] = 3;
                        data[idx+1] = 3;
                        data[idx+2] = 8;
                    } else {
                        const [r, g, b] = colorFn(t, i, maxI);
                        data[idx] = Math.min(255, Math.floor(r * 255));
                        data[idx+1] = Math.min(255, Math.floor(g * 255));
                        data[idx+2] = Math.min(255, Math.floor(b * 255));
                    }
                    data[idx+3] = 255;
                }
            }
            y = endY;
            if (y < height) {
                requestAnimationFrame(processRow);
            } else {
                ctx.putImageData(imageData, 0, 0);
                if (showGrid) drawGrid();
                rendering = false;
                rendered = true;
                document.getElementById('loadingMsg').classList.add('hidden');
                if (pendingRender) { pendingRender = false; scheduleRender(); }
            }
        }

        requestAnimationFrame(processRow);
    }

    function drawGrid() {
        const width = canvas.width;
        const height = canvas.height;
        const range = view.range / view.zoom;
        const halfW = range * width / height / 2;
        const halfH = range / 2;
        const re0 = view.centerRe - halfW;
        const im0 = view.centerIm - halfH;

        ctx.strokeStyle = 'rgba(120,100,255,0.12)';
        ctx.lineWidth = 0.5;

        const step = detectGridStep(range);

        // Vertical lines (constant real part)
        let re = Math.ceil(re0 / step) * step;
        while (re < re0 + 2 * halfW) {
            const px = ((re - re0) / (2 * halfW)) * width;
            ctx.beginPath();
            ctx.moveTo(px, 0);
            ctx.lineTo(px, height);
            ctx.stroke();
            re += step;
        }

        // Horizontal lines (constant imaginary part)
        let im = Math.ceil(im0 / step) * step;
        while (im < im0 + range) {
            const py = height - ((im - im0) / range) * height;
            ctx.beginPath();
            ctx.moveTo(0, py);
            ctx.lineTo(width, py);
            ctx.stroke();
            im += step;
        }

        // Axes
        ctx.strokeStyle = 'rgba(255,255,255,0.25)';
        ctx.lineWidth = 0.8;

        // Im axis (real = 0)
        const axisX = (-re0 / (2 * halfW)) * width;
        if (axisX >= 0 && axisX <= width) {
            ctx.beginPath();
            ctx.moveTo(axisX, 0);
            ctx.lineTo(axisX, height);
            ctx.stroke();
        }

        // Re axis (imaginary = 0)
        const axisY = height - ((-im0) / range) * height;
        if (axisY >= 0 && axisY <= height) {
            ctx.beginPath();
            ctx.moveTo(0, axisY);
            ctx.lineTo(width, axisY);
            ctx.stroke();
        }

        // Label some grid points
        ctx.fillStyle = 'rgba(180,160,255,0.5)';
        ctx.font = '9px Space Mono, monospace';
        ctx.textAlign = 'left';

        re = Math.ceil(re0 / step) * step;
        while (re < re0 + 2 * halfW) {
            const px = ((re - re0) / (2 * halfW)) * width;
            if (px > 20 && px < width - 30) {
                const label = re.toFixed(2);
                ctx.fillText(label, px + 3, Math.min(height - 4, axisY - 4));
            }
            re += step * 2;
        }

        im = Math.ceil(im0 / step) * step;
        while (im < im0 + range) {
            const py = height - ((im - im0) / range) * height;
            if (py > 12 && py < height - 12) {
                const label = im.toFixed(2);
                ctx.fillText(label, Math.min(width - 40, axisX + 4), py - 3);
            }
            im += step * 2;
        }
    }

    function detectGridStep(visibleRange) {
        const rawStep = visibleRange / 10;
        const magnitude = Math.pow(10, Math.floor(Math.log10(rawStep)));
        const normalized = rawStep / magnitude;
        let step = magnitude;
        if (normalized < 2) step *= 1;
        else if (normalized < 5) step *= 2;
        else step *= 5;
        return step;
    }

    // Mouse/pointer interaction
    let isDragging = false;
    let dragStart = null;

    canvas.addEventListener('click', (e) => {
        const rect = canvas.getBoundingClientRect();
        const px = e.clientX - rect.left;
        const py = e.clientY - rect.top;
        zoomAt(px, py, zoomSpeed);
    });

    canvas.addEventListener('contextmenu', (e) => {
        e.preventDefault();
        const rect = canvas.getBoundingClientRect();
        const px = e.clientX - rect.left;
        const py = e.clientY - rect.top;
        zoomAt(px, py, -2);
    });

    canvas.addEventListener('mousedown', (e) => {
        if (e.button === 1 || e.button === 2) return;
        isDragging = true;
        dragStart = { x: e.clientX, y: e.clientY, centerRe: view.centerRe, centerIm: view.centerIm };
    });

    canvas.addEventListener('mousemove', (e) => {
        const rect = canvas.getBoundingClientRect();
        const px = e.clientX - rect.left;
        const py = e.clientY - rect.top;

        // Update coordinate display
        const range = view.range / view.zoom;
        const halfW = range * canvas.width / canvas.height / 2;
        const halfH = range / 2;
        const re = view.centerRe - halfW + (px / canvas.width) * 2 * halfW;
        const im = view.centerIm - halfH + (1 - py / canvas.height) * range;
        document.getElementById('coordDisplay').innerHTML =
            `c = ${re.toFixed(8)} + ${im >= 0 ? '' : ''}${im.toFixed(8)}i`;

        if (!isDragging || !dragStart) return;
        const dx = (e.clientX - dragStart.x) / canvas.width;
        const dy = (e.clientY - dragStart.y) / canvas.height;
        const r = view.range / view.zoom;
        view.centerRe = dragStart.centerRe - dx * r * (canvas.height / canvas.width);
        view.centerIm = dragStart.centerIm + dy * r;
        updateInfo();
        scheduleRender();
    });

    canvas.addEventListener('mouseup', () => { isDragging = false; dragStart = null; });
    canvas.addEventListener('mouseleave', () => { isDragging = false; dragStart = null; });

    function zoomAt(px, py, factor) {
        const range = view.range / view.zoom;
        const halfW = range * canvas.width / canvas.height / 2;
        const halfH = range / 2;

        const targetRe = view.centerRe - halfW + (px / canvas.width) * 2 * halfW;
        const targetIm = view.centerIm - halfH + (1 - py / canvas.height) * range;

        const zoomFactor = factor > 0 ? 1 + factor * 0.5 : 1 / (1 - factor * 0.5);
        view.zoom *= zoomFactor;
        view.zoom = Math.max(0.5, Math.min(view.zoom, 1e15));

        const newRange = view.range / view.zoom;
        const newHalfW = newRange * canvas.width / canvas.height / 2;
        const newHalfH = newRange / 2;

        view.centerRe = targetRe - (px / canvas.width - 0.5) * 2 * newHalfW;
        view.centerIm = targetIm - (0.5 - py / canvas.height) * newRange;

        updateInfo();
        scheduleRender();
    }

    function updateInfo() {
        document.getElementById('infoRe').textContent = view.centerRe.toFixed(6);
        document.getElementById('infoIm').textContent = view.centerIm.toFixed(6);
        document.getElementById('infoZoom').textContent = view.zoom >= 1e6
            ? view.zoom.toExponential(2)
            : view.zoom.toFixed(1);
    }

    // Controls
    document.getElementById('maxIter').addEventListener('input', (e) => {
        maxIter = parseInt(e.target.value);
        document.getElementById('iterVal').textContent = maxIter;
        scheduleRender();
    });

    document.getElementById('zoomSpeed').addEventListener('input', (e) => {
        zoomSpeed = parseInt(e.target.value);
        document.getElementById('zoomVal').textContent = zoomSpeed;
    });

    document.getElementById('resetBtn').addEventListener('click', () => {
        view = { centerRe: -0.5, centerIm: 0.0, zoom: 1.0, range: 3.5 };
        showJulia = false;
        document.getElementById('juliaBtn').textContent = 'Show Julia Set';
        updateInfo();
        scheduleRender();
    });

    document.getElementById('juliaBtn').addEventListener('click', () => {
        showJulia = !showJulia;
        document.getElementById('juliaBtn').textContent = showJulia ? 'Show Mandelbrot' : 'Show Julia Set';
        document.getElementById('juliaBtn').classList.toggle('primary', showJulia);
        scheduleRender();
    });

    document.getElementById('gridBtn').addEventListener('click', () => {
        showGrid = !showGrid;
        document.getElementById('gridBtn').classList.toggle('primary', showGrid);
        if (rendered) { renderFractal(); }
    });

    // Scheme buttons
    document.querySelectorAll('.scheme-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.scheme-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentScheme = btn.dataset.s;
            scheduleRender();
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.key === 'r' || e.key === 'R') {
            document.getElementById('resetBtn').click();
        }
        if (e.key === 'j' || e.key === 'J') {
            document.getElementById('juliaBtn').click();
        }
        if (e.key === 'g' || e.key === 'G') {
            document.getElementById('gridBtn').click();
        }
        if (e.key === '+' || e.key === '=') {
            maxIter = Math.min(2000, maxIter + 100);
            document.getElementById('maxIter').value = maxIter;
            document.getElementById('iterVal').textContent = maxIter;
            scheduleRender();
        }
        if (e.key === '-') {
            maxIter = Math.max(50, maxIter - 100);
            document.getElementById('maxIter').value = maxIter;
            document.getElementById('iterVal').textContent = maxIter;
            scheduleRender();
        }
    });

    // Starfield background
    function createStars() {
        const container = document.getElementById('stars');
        for (let i = 0; i < 120; i++) {
            const star = document.createElement('div');
            const size = Math.random() * 1.5 + 0.3;
            star.style.cssText = `
                position: absolute;
                left: ${Math.random()*100}%;
                top: ${Math.random()*100}%;
                width: ${size}px;
                height: ${size}px;
                border-radius: 50%;
                background: rgba(255,255,255,${Math.random()*0.5+0.1});
                animation: twinkle ${2+Math.random()*4}s infinite alternate;
            `;
            container.appendChild(star);
        }
    }

    const style = document.createElement('style');
    style.textContent = `
        @keyframes twinkle {
            0% { opacity: ${0.2+Math.random()*0.3}; transform: scale(1); }
            100% { opacity: ${0.5+Math.random()*0.5}; transform: scale(1.2); }
        }
    `;
    document.head.appendChild(style);

    // Hide hint after first interaction
    let hintVisible = true;
    canvas.addEventListener('click', () => {
        if (hintVisible) {
            document.getElementById('hint').classList.add('hidden');
            hintVisible = false;
        }
    });

    // Animate color cycling
    function animate() {
        animFrame++;
        if (rendered && animFrame % 3 === 0) {
            ctx.putImageData(ctx.getImageData(0,0,canvas.width,canvas.height), 0, 0);
            if (showGrid) drawGrid();
        }
        requestAnimationFrame(animate);
    }

    // Touch support
    let lastTouchDist = null;
    canvas.addEventListener('touchstart', (e) => {
        if (e.touches.length === 2) {
            const dx = e.touches[0].clientX - e.touches[1].clientX;
            const dy = e.touches[0].clientY - e.touches[1].clientY;
            lastTouchDist = Math.sqrt(dx*dx + dy*dy);
        }
    });

    canvas.addEventListener('touchmove', (e) => {
        e.preventDefault();
        if (e.touches.length === 2 && lastTouchDist !== null) {
            const dx = e.touches[0].clientX - e.touches[1].clientX;
            const dy = e.touches[0].clientY - e.touches[1].clientY;
            const dist = Math.sqrt(dx*dx + dy*dy);
            const midX = (e.touches[0].clientX + e.touches[1].clientX) / 2;
            const midY = (e.touches[0].clientY + e.touches[1].clientY) / 2;
            if (dist > lastTouchDist + 2) { zoomAt(midX, midY, 2); lastTouchDist = dist; }
            else if (dist < lastTouchDist - 2) { zoomAt(midX, midY, -2); lastTouchDist = dist; }
        }
    }, { passive: false });

    canvas.addEventListener('touchend', () => { lastTouchDist = null; });

    // Init
    window.addEventListener('resize', resize);
    createStars();
    resize();
    animate();
    updateInfo();

    // Beautiful starting points
    const presets = [
        { re: -0.5, im: 0.0, zoom: 1, label: 'Full view' },
        { re: -0.745, im: 0.113, zoom: 200, label: ' Seahorse valley' },
        { re: -1.25066, im: 0.0201, zoom: 5000, label: 'Elephant valley' },
        { re: 0.3008, im: 0.0272, zoom: 8000, label: 'Spiral galaxy' },
        { re: -0.1011, im: 0.9563, zoom: 800, label: 'Crystal peak' },
    ];

    let presetIdx = 0;
    function nextPreset() {
        presetIdx = (presetIdx + 1) % presets.length;
        const p = presets[presetIdx];
        view.centerRe = p.re;
        view.centerIm = p.im;
        view.zoom = p.zoom;
        updateInfo();
        scheduleRender();
    }

    // Double-click to cycle presets
    canvas.addEventListener('dblclick', nextPreset);

})();
</script>
</body>
</html>
