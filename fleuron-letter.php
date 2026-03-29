<?php
$today = date('F j, Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleuron Letter Studio ❧</title>
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English:ital@0;1&family=Caveat:wght@400;600;700&family=IM+Fell+English+SC&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --parchment: #f5edd8;
            --parchment-dark: #dfc99a;
            --parchment-mid: #ead9b2;
            --ink: #2c1e0f;
            --ink-faint: #7a5c38;
            --rust: #8b2500;
            --gold: #b8860b;
            --gold-bright: #d4a017;
        }

        body {
            background: var(--parchment);
            color: var(--ink);
            font-family: 'IM Fell English', Georgia, serif;
            min-height: 100vh;
        }

        /* ─── HERO ─── */
        .hero {
            text-align: center;
            padding: 52px 24px 36px;
            background: var(--ink);
            color: var(--parchment);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 120%, rgba(180,120,40,0.18) 0%, transparent 70%);
        }
        .hero-ornament {
            font-size: 2.2em;
            letter-spacing: 0.6em;
            color: var(--gold-bright);
            margin-bottom: 18px;
            animation: fadeUp 0.8s ease both;
        }
        .hero h1 {
            font-family: 'IM Fell English SC', serif;
            font-size: clamp(1.8em, 5vw, 2.8em);
            letter-spacing: 2px;
            margin-bottom: 14px;
            animation: fadeUp 0.8s 0.1s ease both;
            position: relative;
        }
        .hero p {
            font-style: italic;
            color: #c8b99a;
            font-size: 1em;
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.65;
            animation: fadeUp 0.8s 0.2s ease both;
            position: relative;
        }

        /* ─── QUOTE BAND ─── */
        .quote-band {
            background: var(--rust);
            color: var(--parchment);
            text-align: center;
            padding: 20px 32px;
            font-style: italic;
            font-size: 0.95em;
            line-height: 1.7;
        }
        .quote-band .attr {
            display: block;
            margin-top: 6px;
            font-style: normal;
            font-size: 0.82em;
            color: rgba(245,237,216,0.7);
        }

        /* ─── SECTION ─── */
        .section {
            max-width: 820px;
            margin: 0 auto;
            padding: 44px 20px;
        }
        .section + .section { padding-top: 0; }

        .section-head {
            text-align: center;
            margin-bottom: 32px;
        }
        .section-title {
            font-family: 'IM Fell English SC', serif;
            font-size: 1.65em;
            color: var(--rust);
            margin-bottom: 4px;
        }
        .section-ornament {
            font-size: 1.5em;
            color: var(--gold);
            letter-spacing: 0.5em;
            display: block;
            margin: 6px 0;
        }
        .section-sub {
            font-style: italic;
            color: var(--ink-faint);
            font-size: 0.93em;
        }

        /* ─── STROKE GUIDE ─── */
        .strokes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stroke-card {
            background: #fff;
            border: 1px solid var(--parchment-dark);
            border-radius: 6px;
            padding: 20px 16px 16px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(44,30,15,0.08);
        }
        .stroke-card h3 {
            font-family: 'IM Fell English SC', serif;
            color: var(--rust);
            margin-bottom: 10px;
            font-size: 1.05em;
        }
        .stroke-svg {
            width: 90px;
            height: 130px;
            margin: 0 auto 12px;
            display: block;
        }
        .stroke-card p {
            font-style: italic;
            color: var(--ink-faint);
            font-size: 0.88em;
            line-height: 1.5;
        }

        /* SVG path animation */
        .sp { fill: none; stroke-linecap: round; stroke-linejoin: round; }
        .sp-ghost { stroke: rgba(44,30,15,0.12); stroke-width: 2.5; }
        .sp-live  { stroke: var(--ink); stroke-width: 3; }
        .sp-live.anim {
            stroke-dasharray: 400;
            stroke-dashoffset: 400;
            animation: drawPath 1.6s cubic-bezier(.4,0,.2,1) forwards;
        }

        #card1 .sp-live.anim { animation-delay: 0.3s; }
        #card2 .sp-live.anim { animation-delay: 0.4s; }
        #card3 .sp-live.anim { animation-delay: 0.4s; }

        @keyframes drawPath { to { stroke-dashoffset: 0; } }

        .replay-row {
            text-align: center;
            margin-bottom: 40px;
        }
        .btn-ink {
            background: var(--ink);
            color: var(--parchment);
            border: none;
            padding: 9px 28px;
            font-family: 'IM Fell English', serif;
            font-size: 1em;
            cursor: pointer;
            border-radius: 3px;
            transition: background 0.2s;
        }
        .btn-ink:hover { background: var(--rust); }
        .btn-ink.secondary {
            background: transparent;
            color: var(--ink);
            border: 1.5px solid var(--ink);
        }
        .btn-ink.secondary:hover { background: var(--ink); color: var(--parchment); }

        /* ─── CANVAS ─── */
        .canvas-wrap {
            background: #fff;
            border: 1px solid var(--parchment-dark);
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(44,30,15,0.08);
            margin-bottom: 32px;
        }
        .nib-row {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-bottom: 14px;
            flex-wrap: wrap;
        }
        .nib-label { font-style: italic; color: var(--ink-faint); font-size: 0.88em; }
        .nib-btn {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: 2px solid var(--ink);
            background: transparent;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1em;
            color: var(--ink);
            transition: all 0.15s;
        }
        .nib-btn.active { background: var(--ink); color: var(--parchment); }

        #practiceCanvas {
            border: 2px dashed var(--parchment-dark);
            border-radius: 4px;
            touch-action: none;
            cursor: crosshair;
            width: 100%;
            max-width: 720px;
            display: block;
            margin: 0 auto 16px;
            background: var(--parchment);
        }
        .canvas-btns {
            display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;
        }

        /* ─── LETTER STUDIO ─── */
        .letter-studio {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }
        @media (max-width: 620px) {
            .letter-studio { grid-template-columns: 1fr; }
        }

        .form-card {
            background: #fff;
            border: 1px solid var(--parchment-dark);
            border-radius: 6px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(44,30,15,0.08);
        }
        .form-card label {
            display: block;
            font-family: 'IM Fell English SC', serif;
            font-size: 0.82em;
            color: var(--rust);
            margin-bottom: 4px;
            margin-top: 16px;
        }
        .form-card label:first-child { margin-top: 0; }
        .form-card input,
        .form-card textarea,
        .form-card select {
            width: 100%;
            border: 1px solid var(--parchment-dark);
            border-radius: 3px;
            padding: 7px 11px;
            font-family: 'Caveat', cursive;
            font-size: 1.12em;
            color: var(--ink);
            background: var(--parchment);
        }
        .form-card textarea { min-height: 190px; resize: vertical; }

        .ornament-row {
            display: flex; gap: 8px; flex-wrap: wrap; margin-top: 10px; align-items: center;
        }
        .ornament-label { font-style: italic; color: var(--ink-faint); font-size: 0.85em; }
        .orn-btn {
            background: var(--parchment-mid);
            color: var(--ink);
            border: 1px solid var(--parchment-dark);
            padding: 4px 13px;
            font-size: 1.25em;
            cursor: pointer;
            border-radius: 3px;
            font-family: Georgia, serif;
            transition: background 0.15s;
        }
        .orn-btn:hover { background: var(--gold-bright); color: #fff; }

        /* ─── PARCHMENT PREVIEW ─── */
        .parchment {
            background: var(--parchment);
            border: 1px solid #c4a05a;
            border-radius: 6px;
            padding: 32px 28px;
            box-shadow: inset 0 0 50px rgba(164,120,40,0.12), 0 2px 12px rgba(44,30,15,0.12);
            font-family: 'Caveat', cursive;
            font-size: 1.15em;
            color: var(--ink);
            line-height: 1.85;
            min-height: 380px;
            position: relative;
        }
        .parchment::before {
            content: '';
            position: absolute;
            inset: 9px;
            border: 1px solid rgba(164,120,40,0.25);
            pointer-events: none;
            border-radius: 2px;
        }
        #pDate  { text-align: right; margin-bottom: 24px; color: var(--ink-faint); font-size: 0.93em; }
        #pDear  { margin-bottom: 12px; }
        #pBody  { white-space: pre-wrap; min-height: 80px; }
        #pClose { margin-top: 28px; }
        #pName  { margin-top: 6px; font-size: 1.25em; font-weight: 700; }
        .fleuron-span { color: var(--rust); }

        .copy-btn {
            margin-top: 14px;
            width: 100%;
            background: var(--ink);
            color: var(--parchment);
            border: none;
            padding: 9px;
            font-family: 'IM Fell English', serif;
            font-size: 1em;
            cursor: pointer;
            border-radius: 3px;
            transition: background 0.2s;
        }
        .copy-btn:hover { background: var(--rust); }

        /* ─── FOOTER BAND ─── */
        .footer-band {
            background: var(--ink);
            color: var(--parchment);
            text-align: center;
            padding: 32px 24px;
            margin-top: 8px;
        }
        .footer-band .big-fleuron {
            font-size: 3em;
            color: var(--gold-bright);
            letter-spacing: 0.5em;
            display: block;
            margin-bottom: 12px;
        }
        .footer-band p {
            font-style: italic;
            color: #c0a87a;
            font-size: 0.9em;
            line-height: 1.6;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- ══════════ HERO ══════════ -->
<div class="hero">
    <div class="hero-ornament">❧ ❧ ❧</div>
    <h1>Fleuron Letter Studio</h1>
    <p>The fleuron (or leaf) — three strokes, centuries of tradition. Learn to draw it, practice on a canvas, and compose a letter worthy of its beauty.</p>
</div>

<div class="quote-band">
    "It consists of three strokes: an S, a C, and an S. Expect them to look a bit pear-shaped the first few times; sufficiently practiced, it will be a useful and beautiful addition to your personal script."
    <span class="attr">— Jon Aquino, 2007</span>
</div>

<!-- ══════════ STROKE GUIDE ══════════ -->
<div class="section">
    <div class="section-head">
        <div class="section-title">The Three Strokes</div>
        <span class="section-ornament">❧</span>
        <div class="section-sub">Build a fleuron from three simple strokes. Watch each one appear.</div>
    </div>

    <div class="strokes-grid">

        <!-- Card 1: Stroke S -->
        <div class="stroke-card" id="card1">
            <h3>Stroke 1 — The S</h3>
            <svg class="stroke-svg" viewBox="0 0 70 120">
                <path class="sp sp-live anim"
                    d="M 50 16 C 46 7, 18 6, 16 26 C 14 44, 52 47, 48 68 C 42 91, 14 89, 14 78"/>
            </svg>
            <p>A tall <em>S</em>, slightly top-heavy, leaning a little to the left.</p>
        </div>

        <!-- Card 2: S + C -->
        <div class="stroke-card" id="card2">
            <h3>Stroke 2 — The C</h3>
            <svg class="stroke-svg" viewBox="0 0 70 120">
                <path class="sp sp-ghost"
                    d="M 50 16 C 46 7, 18 6, 16 26 C 14 44, 52 47, 48 68 C 42 91, 14 89, 14 78"/>
                <path class="sp sp-live anim"
                    d="M 16 22 C 4 34, 2 58, 6 82 C 9 98, 18 108, 24 112"/>
            </svg>
            <p>A tall <em>C</em>, leaning left. Think of it as the left side of the leaf.</p>
        </div>

        <!-- Card 3: S + C + S -->
        <div class="stroke-card" id="card3">
            <h3>Stroke 3 — The S</h3>
            <svg class="stroke-svg" viewBox="0 0 70 120">
                <path class="sp sp-ghost"
                    d="M 50 16 C 46 7, 18 6, 16 26 C 14 44, 52 47, 48 68 C 42 91, 14 89, 14 78"/>
                <path class="sp sp-ghost"
                    d="M 16 22 C 4 34, 2 58, 6 82 C 9 98, 18 108, 24 112"/>
                <path class="sp sp-live anim"
                    d="M 24 112 C 42 118, 62 104, 60 86 C 57 68, 30 65, 36 46 C 42 28, 56 20, 50 16"/>
            </svg>
            <p>The final <em>S</em> — lush and bouncy, forming the right side of the leaf.</p>
        </div>

        <!-- Card 4: Complete -->
        <div class="stroke-card" id="card4">
            <h3>Complete ❧</h3>
            <svg class="stroke-svg" viewBox="0 0 70 120">
                <text x="35" y="72" text-anchor="middle" dominant-baseline="middle"
                    font-size="82" font-family="Georgia, serif" fill="var(--ink)">❧</text>
            </svg>
            <p>The finished fleuron. In threes it marks a pause; alone, a paragraph's beginning.</p>
        </div>

    </div>

    <div class="replay-row">
        <button class="btn-ink" onclick="replayStrokes()">↺ Replay Animation</button>
    </div>

    <!-- ── Practice Canvas ── -->
    <div class="section-head" style="margin-bottom:20px;">
        <div class="section-title">Practice Drawing</div>
        <span class="section-ornament">❧</span>
        <div class="section-sub">Draw with your finger or mouse. Ghost fleurons guide your hand.</div>
    </div>

    <div class="canvas-wrap">
        <div class="nib-row">
            <span class="nib-label">Nib size:</span>
            <button class="nib-btn active" onclick="setNib(2,this)" title="Fine">·</button>
            <button class="nib-btn" onclick="setNib(4,this)" title="Medium">•</button>
            <button class="nib-btn" onclick="setNib(7,this)" title="Bold">●</button>
        </div>
        <canvas id="practiceCanvas" width="720" height="280"></canvas>
        <div class="canvas-btns">
            <button class="btn-ink" onclick="clearCanvas()">✦ Clear</button>
            <button class="btn-ink secondary" onclick="toggleGuide()">Toggle Guide</button>
        </div>
    </div>
</div>

<!-- ══════════ LETTER STUDIO ══════════ -->
<div class="section" style="padding-top:4px;">
    <div class="section-head">
        <div class="section-title">Letter Studio</div>
        <span class="section-ornament">❧</span>
        <div class="section-sub">Compose a letter. Insert fleurons between your thoughts. See it rendered on parchment.</div>
    </div>

    <div class="letter-studio">

        <!-- Form -->
        <div class="form-card">
            <label>Date</label>
            <input type="text" id="lDate" value="<?= htmlspecialchars($today) ?>">

            <label>To</label>
            <input type="text" id="lTo" placeholder="Dear Nathan,">

            <label>Body</label>
            <textarea id="lBody" placeholder="Write your letter here…&#10;&#10;Use the ornaments below to add a fleuron between paragraphs."></textarea>

            <div class="ornament-row">
                <span class="ornament-label">Insert:</span>
                <button class="orn-btn" title="Single fleuron" onclick="ins('❧')">❧</button>
                <button class="orn-btn" title="Three fleurons" onclick="ins('\n❧ ❧ ❧\n')">❧❧❧</button>
                <button class="orn-btn" title="Asterism" onclick="ins('⁂')">⁂</button>
                <button class="orn-btn" title="Star" onclick="ins('✦')">✦</button>
                <button class="orn-btn" title="Section mark" onclick="ins('§')">§</button>
            </div>

            <label>Closing</label>
            <select id="lClose">
                <option>With love,</option>
                <option>Yours sincerely,</option>
                <option>Affectionately,</option>
                <option>Ever yours,</option>
                <option>In Christ,</option>
                <option>Your faithful friend,</option>
                <option>Warmly,</option>
                <option>Pax et bonum,</option>
            </select>

            <label>Name</label>
            <input type="text" id="lName" placeholder="Jon">
        </div>

        <!-- Preview -->
        <div>
            <div class="parchment">
                <div id="pDate"><?= htmlspecialchars($today) ?></div>
                <div id="pDear"><em style="color:var(--ink-faint)">Dear ___,</em></div>
                <div id="pBody" style="color:var(--ink-faint);font-style:italic">Your letter will appear here as you write…</div>
                <div id="pClose">With love,</div>
                <div id="pName"></div>
            </div>
            <button class="copy-btn" onclick="copyLetter()">✦ Copy Letter Text</button>
        </div>

    </div>
</div>

<!-- ══════════ FOOTER ══════════ -->
<div class="footer-band">
    <span class="big-fleuron">❧ ❧ ❧</span>
    <p>The fleuron has graced manuscripts, broadsheets, and handwritten letters for over five centuries.<br>
    Jon Aquino rediscovered it in 2007 and taught himself the three strokes.</p>
</div>

<script>
/* ─── Stroke Animation Replay ─── */
function replayStrokes() {
    document.querySelectorAll('.sp-live.anim').forEach(el => {
        el.style.animation = 'none';
        void el.offsetWidth; // reflow
        el.style.animation = '';
    });
}

/* ─── Practice Canvas ─── */
const canvas = document.getElementById('practiceCanvas');
const ctx    = canvas.getContext('2d');
let drawing  = false;
let nibSize  = 2;
let showGuide = true;
let lx = 0, ly = 0;

function canvasPos(e) {
    const r  = canvas.getBoundingClientRect();
    const sx = canvas.width  / r.width;
    const sy = canvas.height / r.height;
    const cx = e.touches ? e.touches[0].clientX : e.clientX;
    const cy = e.touches ? e.touches[0].clientY : e.clientY;
    return { x: (cx - r.left) * sx, y: (cy - r.top) * sy };
}

function drawGuide() {
    ctx.save();
    ctx.font      = '200px Georgia, serif';
    ctx.fillStyle = 'rgba(180,130,40,0.10)';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    [130, 360, 590].forEach(x => ctx.fillText('❧', x, 140));
    ctx.restore();
}

function initCanvas() {
    ctx.fillStyle = '#f5edd8';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    if (showGuide) drawGuide();
}
initCanvas();

function startDraw(e) {
    drawing = true;
    const p = canvasPos(e); lx = p.x; ly = p.y;
    ctx.beginPath(); ctx.moveTo(lx, ly);
}
function doDraw(e) {
    if (!drawing) return;
    const p = canvasPos(e);
    ctx.beginPath();
    ctx.moveTo(lx, ly); ctx.lineTo(p.x, p.y);
    ctx.strokeStyle = '#2c1e0f';
    ctx.lineWidth   = nibSize;
    ctx.lineCap = ctx.lineJoin = 'round';
    ctx.stroke();
    lx = p.x; ly = p.y;
}
function endDraw() { drawing = false; }

canvas.addEventListener('mousedown',  startDraw);
canvas.addEventListener('mousemove',  doDraw);
canvas.addEventListener('mouseup',    endDraw);
canvas.addEventListener('mouseleave', endDraw);
canvas.addEventListener('touchstart', e => { e.preventDefault(); startDraw(e); }, { passive: false });
canvas.addEventListener('touchmove',  e => { e.preventDefault(); doDraw(e); },  { passive: false });
canvas.addEventListener('touchend',   endDraw);

function clearCanvas()  { initCanvas(); }
function toggleGuide()  { showGuide = !showGuide; initCanvas(); }
function setNib(sz, btn) {
    nibSize = sz;
    document.querySelectorAll('.nib-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

/* ─── Letter Studio ─── */
['lDate','lTo','lBody','lName'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('input', updatePreview);
});
document.getElementById('lClose').addEventListener('change', updatePreview);

function esc(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
            .replace(/\n/g,'<br>');
}
function decorateOrn(s) {
    return s.replace(/[❧⁂✦§]/g, m => `<span class="fleuron-span">${m}</span>`);
}

function updatePreview() {
    const date  = document.getElementById('lDate').value;
    const to    = document.getElementById('lTo').value;
    const body  = document.getElementById('lBody').value;
    const close = document.getElementById('lClose').value;
    const name  = document.getElementById('lName').value;

    document.getElementById('pDate').textContent  = date;
    document.getElementById('pDear').innerHTML    = to
        ? decorateOrn(esc(to))
        : '<em style="color:var(--ink-faint)">Dear ___,</em>';

    if (body) {
        document.getElementById('pBody').innerHTML   = decorateOrn(esc(body));
        document.getElementById('pBody').style.color = '';
        document.getElementById('pBody').style.fontStyle = '';
    } else {
        document.getElementById('pBody').textContent = 'Your letter will appear here as you write…';
        document.getElementById('pBody').style.color = 'var(--ink-faint)';
        document.getElementById('pBody').style.fontStyle = 'italic';
    }
    document.getElementById('pClose').textContent = close;
    document.getElementById('pName').textContent  = name;
}

function ins(text) {
    const ta = document.getElementById('lBody');
    const s  = ta.selectionStart, e = ta.selectionEnd;
    ta.value = ta.value.slice(0, s) + text + ta.value.slice(e);
    ta.selectionStart = ta.selectionEnd = s + text.length;
    ta.focus();
    updatePreview();
}

function copyLetter() {
    const parts = [
        document.getElementById('lDate').value,
        '',
        document.getElementById('lTo').value,
        '',
        document.getElementById('lBody').value,
        '',
        document.getElementById('lClose').value,
        document.getElementById('lName').value,
    ];
    navigator.clipboard.writeText(parts.join('\n')).then(() => {
        const btn = document.querySelector('.copy-btn');
        const orig = btn.textContent;
        btn.textContent = '✓ Copied to clipboard';
        btn.style.background = '#4a7c59';
        setTimeout(() => { btn.textContent = orig; btn.style.background = ''; }, 2200);
    }).catch(() => alert('Copy failed — select the preview text manually.'));
}
</script>
</body>
</html>
