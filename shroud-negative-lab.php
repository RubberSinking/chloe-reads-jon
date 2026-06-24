<?php
$pageTitle = 'Shroud Negative Lab';
$sourceTitle = 'Jesus had a beard';
$sourceUrl = 'https://jona.ca/2012/03/jesus-had-beard.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --bg: #0f0d0b;
            --panel: rgba(29, 21, 15, 0.78);
            --panel-strong: rgba(42, 31, 21, 0.92);
            --line: rgba(229, 188, 111, 0.24);
            --gold: #f0c77b;
            --gold-strong: #ffd48e;
            --bone: #f6ead4;
            --dust: #c8ae86;
            --ink: #20150d;
            --accent: #87c5ff;
            --warn: #ff9b76;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.48);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background:
                radial-gradient(circle at top, rgba(255, 209, 132, 0.08), transparent 30%),
                radial-gradient(circle at 80% 12%, rgba(164, 196, 255, 0.12), transparent 22%),
                linear-gradient(180deg, #17110d 0%, #0e0b09 50%, #090706 100%);
            color: var(--bone);
            font-family: "Avenir Next", "Gill Sans", "Trebuchet MS", sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255, 255, 255, 0.02), transparent 30%),
                repeating-linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.015) 0 1px,
                    transparent 1px 3px
                );
            mix-blend-mode: soft-light;
            opacity: 0.45;
        }

        a {
            color: var(--gold-strong);
            text-decoration-thickness: 1px;
            text-underline-offset: 0.18em;
        }

        main {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 64px;
        }

        .masthead {
            position: relative;
            padding: 28px;
            border: 1px solid var(--line);
            background:
                linear-gradient(135deg, rgba(60, 42, 24, 0.82), rgba(19, 15, 12, 0.94)),
                radial-gradient(circle at top left, rgba(255, 220, 152, 0.09), transparent 32%);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .masthead::after {
            content: "";
            position: absolute;
            inset: auto -10% -24px 35%;
            height: 120px;
            background: radial-gradient(circle, rgba(255, 213, 145, 0.26), transparent 68%);
            filter: blur(16px);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: var(--dust);
            margin-bottom: 14px;
        }

        .eyebrow::before,
        .eyebrow::after {
            content: "";
            width: 42px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(240, 199, 123, 0.8), transparent);
        }

        h1, h2, h3 {
            font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", serif;
            margin: 0;
            line-height: 0.94;
            font-weight: 700;
        }

        h1 {
            font-size: clamp(3rem, 8vw, 5.8rem);
            max-width: 9ch;
            letter-spacing: -0.05em;
            text-wrap: balance;
        }

        .deck {
            margin-top: 18px;
            max-width: 68ch;
            font-size: 1.08rem;
            line-height: 1.7;
            color: rgba(246, 234, 212, 0.86);
        }

        .masthead-meta {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 240, 216, 0.06);
            border: 1px solid rgba(255, 220, 150, 0.18);
            font-size: 0.88rem;
            color: var(--dust);
        }

        .pill strong {
            color: var(--bone);
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(280px, 0.85fr);
            gap: 22px;
            margin-top: 22px;
        }

        .panel {
            position: relative;
            border: 1px solid var(--line);
            background: var(--panel);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.045), transparent 24%),
                radial-gradient(circle at top right, rgba(255, 216, 154, 0.09), transparent 24%);
            pointer-events: none;
        }

        .viewer-shell {
            padding: 18px;
        }

        .viewer-topbar {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 16px;
        }

        .viewer-title {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .viewer-title span {
            color: var(--dust);
            font-size: 0.83rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .viewer-title h2 {
            font-size: clamp(1.7rem, 4vw, 2.5rem);
        }

        .status-chip {
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(135, 197, 255, 0.34);
            background: rgba(135, 197, 255, 0.08);
            color: #d6ecff;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .canvas-wrap {
            position: relative;
            border: 1px solid rgba(255, 224, 168, 0.18);
            background:
                radial-gradient(circle at center, rgba(255, 210, 140, 0.06), transparent 55%),
                linear-gradient(180deg, #251a11, #110d0a);
            padding: 16px;
            min-height: 420px;
        }

        canvas {
            display: block;
            width: 100%;
            aspect-ratio: 4 / 5;
            border: 1px solid rgba(255, 218, 153, 0.16);
            background: #20160f;
            cursor: crosshair;
            touch-action: none;
        }

        .inspector-grid {
            position: absolute;
            inset: 16px;
            pointer-events: none;
            border: 1px solid rgba(255, 214, 140, 0.08);
            background-image:
                linear-gradient(rgba(255, 221, 169, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 221, 169, 0.06) 1px, transparent 1px);
            background-size: 11% 11%;
            mix-blend-mode: soft-light;
        }

        .mode-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .mode-btn,
        .small-btn {
            appearance: none;
            border: 1px solid rgba(255, 214, 145, 0.18);
            background: rgba(255, 240, 216, 0.05);
            color: var(--bone);
            padding: 11px 14px;
            font: inherit;
            cursor: pointer;
            transition: transform 160ms ease, background 160ms ease, border-color 160ms ease;
        }

        .mode-btn:hover,
        .small-btn:hover,
        .mode-btn:focus-visible,
        .small-btn:focus-visible {
            transform: translateY(-1px);
            background: rgba(255, 214, 145, 0.12);
            border-color: rgba(255, 214, 145, 0.42);
            outline: none;
        }

        .mode-btn.active {
            background: linear-gradient(180deg, rgba(255, 212, 137, 0.26), rgba(255, 212, 137, 0.12));
            border-color: rgba(255, 214, 145, 0.5);
            color: #fff4de;
        }

        .control-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px 18px;
            margin-top: 18px;
        }

        label.control {
            display: grid;
            gap: 8px;
            color: var(--dust);
            font-size: 0.92rem;
        }

        label.control span {
            display: flex;
            justify-content: space-between;
            gap: 12px;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold-strong);
        }

        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .side-column {
            display: grid;
            gap: 22px;
        }

        .card {
            position: relative;
            padding: 18px;
        }

        .card h3 {
            font-size: 1.55rem;
            margin-bottom: 12px;
        }

        .card p,
        .card li {
            color: rgba(246, 234, 212, 0.82);
            line-height: 1.65;
        }

        .log {
            border: 1px solid rgba(255, 214, 145, 0.14);
            background: rgba(10, 8, 7, 0.34);
            padding: 14px;
            min-height: 160px;
        }

        .log strong {
            display: block;
            color: var(--gold-strong);
            margin-bottom: 8px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.74rem;
        }

        .stat-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 16px;
        }

        .stat {
            padding: 12px;
            border: 1px solid rgba(255, 214, 145, 0.12);
            background: rgba(255, 255, 255, 0.03);
        }

        .stat .label {
            font-size: 0.76rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--dust);
        }

        .stat .value {
            display: block;
            margin-top: 8px;
            font-size: 1.35rem;
            color: var(--bone);
        }

        .target-list {
            display: grid;
            gap: 10px;
            padding: 0;
            list-style: none;
            margin: 16px 0 0;
        }

        .target-item {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            padding: 11px 12px;
            border-left: 3px solid rgba(255, 214, 145, 0.25);
            background: rgba(255, 248, 237, 0.03);
        }

        .target-item.done {
            border-left-color: #a2e09f;
            background: rgba(162, 224, 159, 0.08);
        }

        .target-item small {
            color: var(--dust);
        }

        .challenge-banner {
            margin-top: 14px;
            padding: 12px 14px;
            border: 1px solid rgba(135, 197, 255, 0.2);
            background: rgba(135, 197, 255, 0.07);
            color: #dbeeff;
        }

        .legend {
            margin-top: 16px;
            display: grid;
            gap: 8px;
        }

        .legend-row {
            display: flex;
            gap: 10px;
            align-items: center;
            color: var(--dust);
            font-size: 0.92rem;
        }

        .legend-swatch {
            width: 18px;
            height: 18px;
            border: 1px solid rgba(255, 214, 145, 0.18);
            background: linear-gradient(135deg, rgba(255,255,255,0.4), rgba(255,255,255,0.05));
        }

        .note-box {
            padding: 16px;
            border: 1px solid rgba(255, 214, 145, 0.12);
            background: rgba(255, 244, 226, 0.04);
            margin-top: 16px;
        }

        .footer-link {
            margin-top: 26px;
            text-align: center;
            color: var(--dust);
            font-size: 0.95rem;
        }

        @media (max-width: 920px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .viewer-topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 640px) {
            main {
                width: min(100% - 20px, 1180px);
                padding-top: 16px;
            }

            .masthead,
            .viewer-shell,
            .card {
                padding: 16px;
            }

            h1 {
                font-size: clamp(2.8rem, 14vw, 4.1rem);
            }

            .deck {
                font-size: 1rem;
            }

            .control-grid,
            .stat-row {
                grid-template-columns: 1fr;
            }

            .canvas-wrap {
                min-height: 0;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<main>
    <section class="masthead">
        <div class="eyebrow">Darkroom Relic Study</div>
        <h1><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
        <p class="deck">
            Jon once pointed out the eerie thing about the Shroud image: the face becomes easier to recognize when you flip it into a photographic negative.
            So this page turns that observation into a little detective exhibit: inspect the linen, switch analysis modes, and see how quickly a face emerges from the noise.
        </p>
        <div class="masthead-meta">
            <div class="pill"><strong>Mode:</strong> relic-to-negative analyzer</div>
            <div class="pill"><strong>Best for:</strong> curious tinkerers, image nerds, and one observant kid with a flashlight</div>
        </div>
    </section>

    <section class="layout">
        <div class="panel viewer-shell">
            <div class="viewer-topbar">
                <div class="viewer-title">
                    <span>Specimen Viewer</span>
                    <h2>Read the face in the cloth</h2>
                </div>
                <div class="status-chip" id="statusChip">Relic mode engaged</div>
            </div>

            <div class="canvas-wrap">
                <canvas id="labCanvas" width="900" height="1125" aria-label="Interactive linen portrait analyzer"></canvas>
                <div class="inspector-grid"></div>
            </div>

            <div class="mode-row" id="modeRow">
                <button class="mode-btn active" data-mode="relic">Relic</button>
                <button class="mode-btn" data-mode="negative">Negative</button>
                <button class="mode-btn" data-mode="high">High Contrast</button>
                <button class="mode-btn" data-mode="edges">Edge Trace</button>
            </div>

            <div class="control-grid">
                <label class="control">
                    <span>Contrast <strong id="contrastValue">58</strong></span>
                    <input id="contrast" type="range" min="0" max="100" value="58">
                </label>
                <label class="control">
                    <span>Ghost Image <strong id="ghostValue">64</strong></span>
                    <input id="ghost" type="range" min="18" max="100" value="64">
                </label>
                <label class="control">
                    <span>Linen Warp <strong id="warpValue">36</strong></span>
                    <input id="warp" type="range" min="0" max="100" value="36">
                </label>
                <label class="control">
                    <span>Inspection Lamp <strong id="lampValue">74</strong></span>
                    <input id="lamp" type="range" min="0" max="100" value="74">
                </label>
            </div>

            <div class="quick-actions">
                <button class="small-btn" id="toggleSweep">Pause Sweep</button>
                <button class="small-btn" id="randomize">Shuffle Cloth</button>
                <button class="small-btn" id="resetLab">Reset Lab</button>
            </div>
        </div>

        <div class="side-column">
            <section class="panel card">
                <h3>Observation Log</h3>
                <div class="log" id="logBox">
                    <strong>Current Reading</strong>
                    The linen keeps its secrets at first, but the brow, nose bridge, and beard line grow easier to read as contrast rises.
                </div>
                <div class="stat-row">
                    <div class="stat">
                        <span class="label">Mode</span>
                        <span class="value" id="modeLabel">Relic</span>
                    </div>
                    <div class="stat">
                        <span class="label">Clarity</span>
                        <span class="value" id="clarityValue">61%</span>
                    </div>
                    <div class="stat">
                        <span class="label">Mood</span>
                        <span class="value" id="moodValue">Hushed</span>
                    </div>
                </div>
                <div class="legend">
                    <div class="legend-row"><span class="legend-swatch" style="background: linear-gradient(135deg, #d7c2a2, #66462c);"></span> Relic mode keeps the cloth warm and ambiguous.</div>
                    <div class="legend-row"><span class="legend-swatch" style="background: linear-gradient(135deg, #f7f7f3, #111114);"></span> Negative mode flips the tones and sharpens the face.</div>
                    <div class="legend-row"><span class="legend-swatch" style="background: linear-gradient(135deg, #9ed4ff, #1f3348);"></span> Edge Trace behaves like a moody little detective sketch.</div>
                </div>
            </section>

            <section class="panel card">
                <h3>Feature Hunt</h3>
                <p>Tap the canvas to locate the three key features in order. Negative mode helps most, which is rather the whole point.</p>
                <ul class="target-list" id="targetList">
                    <li class="target-item" data-target="brow"><span>Brow shadow</span><small>First clue</small></li>
                    <li class="target-item" data-target="nose"><span>Nose bridge</span><small>Second clue</small></li>
                    <li class="target-item" data-target="beard"><span>Beard line</span><small>Final clue</small></li>
                </ul>
                <div class="challenge-banner" id="challengeBanner">Start by finding the brow shadow near the upper middle of the cloth.</div>
                <div class="note-box">
                    <strong>Why this works</strong><br>
                    Negatives can make faint brightness patterns easier to interpret because the lightest regions become dark anchors and vice versa. Brains love edges, contrast, and suspiciously face-shaped arrangements.
                </div>
            </section>
        </div>
    </section>

    <p class="footer-link">Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($sourceTitle, ENT_QUOTES, 'UTF-8') ?></a>.</p>
</main>

<script>
(() => {
    const canvas = document.getElementById('labCanvas');
    const ctx = canvas.getContext('2d');
    const offscreen = document.createElement('canvas');
    const offCtx = offscreen.getContext('2d');
    offscreen.width = canvas.width;
    offscreen.height = canvas.height;

    const elements = {
        statusChip: document.getElementById('statusChip'),
        modeLabel: document.getElementById('modeLabel'),
        clarityValue: document.getElementById('clarityValue'),
        moodValue: document.getElementById('moodValue'),
        logBox: document.getElementById('logBox'),
        contrast: document.getElementById('contrast'),
        ghost: document.getElementById('ghost'),
        warp: document.getElementById('warp'),
        lamp: document.getElementById('lamp'),
        contrastValue: document.getElementById('contrastValue'),
        ghostValue: document.getElementById('ghostValue'),
        warpValue: document.getElementById('warpValue'),
        lampValue: document.getElementById('lampValue'),
        toggleSweep: document.getElementById('toggleSweep'),
        randomize: document.getElementById('randomize'),
        resetLab: document.getElementById('resetLab'),
        challengeBanner: document.getElementById('challengeBanner'),
        targetList: document.getElementById('targetList'),
        modeButtons: [...document.querySelectorAll('.mode-btn')]
    };

    const targets = [
        { key: 'brow', x: 450, y: 410, radius: 82, hint: 'The brow shadow hides just above the eyes. Try the upper middle.' },
        { key: 'nose', x: 455, y: 575, radius: 68, hint: 'The nose bridge is your cleanest vertical anchor.' },
        { key: 'beard', x: 450, y: 765, radius: 118, hint: 'The beard line spreads lower and wider than the nose.' }
    ];

    const state = {
        mode: 'relic',
        contrast: 58,
        ghost: 64,
        warp: 36,
        lamp: 74,
        seed: 1.618,
        sweepPhase: 0,
        sweepRunning: true,
        pointer: { active: false, x: canvas.width * 0.54, y: canvas.height * 0.4 },
        challengeIndex: 0,
        solved: new Set()
    };

    const moodCopy = {
        relic: ['Hushed', 'Warm linen glow keeps the portrait suggestive instead of obvious.'],
        negative: ['Revealed', 'The flipped tones suddenly lock the eyes, nose, and beard into place.'],
        high: ['Charged', 'Contrast pushes the cloth closer to poster territory. Subtle? No. Effective? Quite.'],
        edges: ['Forensic', 'Edges turn the portrait into a detective sketch with just enough ghost left behind.']
    };

    const challengeText = {
        brow: 'Start by finding the brow shadow near the upper middle of the cloth.',
        nose: 'Nice. Now locate the nose bridge, the most vertical feature in the portrait.',
        beard: 'Good eye. Finish the round by finding the beard line lower down.'
    };

    function randomNoise(x, y, seed) {
        const value = Math.sin((x * 12.9898) + (y * 78.233) + seed * 437.5453) * 43758.5453;
        return value - Math.floor(value);
    }

    function applyUI() {
        elements.contrastValue.textContent = state.contrast;
        elements.ghostValue.textContent = state.ghost;
        elements.warpValue.textContent = state.warp;
        elements.lampValue.textContent = state.lamp;
        elements.modeButtons.forEach((button) => {
            button.classList.toggle('active', button.dataset.mode === state.mode);
        });
        const clarity = Math.round((state.contrast * 0.42) + (state.ghost * 0.38) + (state.mode === 'negative' ? 18 : state.mode === 'high' ? 12 : state.mode === 'edges' ? 8 : 0));
        elements.modeLabel.textContent = labelForMode(state.mode);
        elements.clarityValue.textContent = `${Math.min(99, clarity)}%`;
        elements.moodValue.textContent = moodCopy[state.mode][0];
        elements.statusChip.textContent = `${labelForMode(state.mode)} mode engaged`;
        elements.logBox.innerHTML = `<strong>Current Reading</strong>${moodCopy[state.mode][1]} Contrast is ${state.contrast}, ghost image is ${state.ghost}, and the linen warp is ${state.warp}.`;
        updateTargetList();
    }

    function labelForMode(mode) {
        switch (mode) {
            case 'negative': return 'Negative';
            case 'high': return 'High Contrast';
            case 'edges': return 'Edge Trace';
            default: return 'Relic';
        }
    }

    function drawBasePortrait() {
        const { width, height } = offscreen;
        const img = offCtx.createImageData(width, height);
        const data = img.data;
        const contrastPower = 0.65 + (state.contrast / 100) * 0.95;
        const ghostAlpha = 0.2 + (state.ghost / 100) * 0.58;
        const warpFactor = state.warp / 100;

        for (let y = 0; y < height; y++) {
            for (let x = 0; x < width; x++) {
                const index = (y * width + x) * 4;
                const nx = (x / width) - 0.5;
                const ny = (y / height) - 0.5;
                const wave = Math.sin((x / 24) + state.seed * 3.1) * 0.012 * warpFactor + Math.cos((y / 29) + state.seed * 2.7) * 0.012 * warpFactor;
                const wx = nx + wave;
                const wy = ny + wave * 0.7;

                const clothGrain = 0.66 + (Math.sin(x / 6.4) * 0.015) + (Math.sin(y / 5.8) * 0.012);
                const speckle = (randomNoise(x * 0.8, y * 0.85, state.seed) - 0.5) * 0.12;
                const verticalFibers = Math.sin((x / 4.8) + (randomNoise(y, x, state.seed) * 0.4)) * 0.018;
                const horizontalFibers = Math.cos((y / 7.2) + (randomNoise(x, y, state.seed + 4) * 0.6)) * 0.012;

                let face = 0;
                face += gaussian(wx, wy, 0, -0.02, 0.16, 0.31, 0.38);
                face += gaussian(wx, wy, 0, 0.15, 0.18, 0.14, 0.15);
                face += gaussian(wx, wy, -0.09, -0.07, 0.048, 0.035, -0.19);
                face += gaussian(wx, wy, 0.09, -0.07, 0.048, 0.035, -0.19);
                face += gaussian(wx, wy, 0, 0.015, 0.03, 0.12, -0.22);
                face += gaussian(wx, wy, 0, 0.07, 0.04, 0.055, 0.10);
                face += gaussian(wx, wy, -0.06, 0.11, 0.06, 0.025, -0.08);
                face += gaussian(wx, wy, 0.06, 0.11, 0.06, 0.025, -0.08);
                face += gaussian(wx, wy, 0, 0.23, 0.19, 0.13, -0.26);
                face += gaussian(wx, wy, 0, 0.33, 0.11, 0.07, -0.17);
                face += gaussian(wx, wy, 0, -0.18, 0.18, 0.10, -0.08);
                face += gaussian(wx, wy, 0, -0.16, 0.05, 0.02, -0.11);

                let brightness = clothGrain + speckle + verticalFibers + horizontalFibers - (face * ghostAlpha * contrastPower);
                brightness = clamp(brightness, 0, 1);
                const tone = Math.round(brightness * 255);
                data[index] = tone;
                data[index + 1] = tone;
                data[index + 2] = tone;
                data[index + 3] = 255;
            }
        }
        return img;
    }

    function gaussian(x, y, cx, cy, sx, sy, strength) {
        const dx = (x - cx) / sx;
        const dy = (y - cy) / sy;
        return Math.exp(-0.5 * ((dx * dx) + (dy * dy))) * strength;
    }

    function render() {
        const raw = drawBasePortrait();
        const processed = applyMode(raw);
        ctx.putImageData(processed, 0, 0);
        drawLampOverlay();
    }

    function applyMode(raw) {
        const img = new ImageData(new Uint8ClampedArray(raw.data), raw.width, raw.height);
        const data = img.data;

        if (state.mode === 'edges') {
            const gray = new Uint8ClampedArray(raw.width * raw.height);
            for (let i = 0; i < gray.length; i++) {
                gray[i] = raw.data[i * 4];
            }
            for (let y = 1; y < raw.height - 1; y++) {
                for (let x = 1; x < raw.width - 1; x++) {
                    const idx = y * raw.width + x;
                    const gx =
                        -gray[idx - raw.width - 1] - 2 * gray[idx - 1] - gray[idx + raw.width - 1] +
                        gray[idx - raw.width + 1] + 2 * gray[idx + 1] + gray[idx + raw.width + 1];
                    const gy =
                        -gray[idx - raw.width - 1] - 2 * gray[idx - raw.width] - gray[idx - raw.width + 1] +
                        gray[idx + raw.width - 1] + 2 * gray[idx + raw.width] + gray[idx + raw.width + 1];
                    const mag = clamp(Math.sqrt((gx * gx) + (gy * gy)) * 0.58, 0, 255);
                    const out = idx * 4;
                    data[out] = 26 + mag * 0.7;
                    data[out + 1] = 42 + mag * 0.82;
                    data[out + 2] = 58 + mag;
                }
            }
            return img;
        }

        for (let i = 0; i < data.length; i += 4) {
            let value = data[i];
            const normalized = (value / 255) - 0.5;
            value = clamp((normalized * (1 + state.contrast / 52) + 0.5) * 255, 0, 255);

            if (state.mode === 'negative') {
                value = 255 - value;
            } else if (state.mode === 'high') {
                value = value > 132 ? 220 + (value - 132) * 0.35 : value * 0.58;
            }

            if (state.mode === 'relic' || state.mode === 'high') {
                data[i] = clamp(value * 1.05 + 14, 0, 255);
                data[i + 1] = clamp(value * 0.91 + 7, 0, 255);
                data[i + 2] = clamp(value * 0.71, 0, 255);
            } else if (state.mode === 'negative') {
                data[i] = clamp(value * 1.03, 0, 255);
                data[i + 1] = clamp(value * 1.03, 0, 255);
                data[i + 2] = clamp(value * 0.96 + 10, 0, 255);
            }
        }
        return img;
    }

    function drawLampOverlay() {
        const lampStrength = state.lamp / 100;
        ctx.save();

        if (lampStrength > 0) {
            const sweepX = (Math.sin(state.sweepPhase) * 0.34 + 0.5) * canvas.width;
            const sweepY = canvas.height * 0.52 + Math.cos(state.sweepPhase * 0.7) * 54;
            const lx = state.pointer.active ? state.pointer.x : sweepX;
            const ly = state.pointer.active ? state.pointer.y : sweepY;
            const radius = 120 + lampStrength * 190;
            const gradient = ctx.createRadialGradient(lx, ly, radius * 0.12, lx, ly, radius);
            gradient.addColorStop(0, `rgba(255, 246, 220, ${0.08 + lampStrength * 0.34})`);
            gradient.addColorStop(0.34, `rgba(255, 230, 186, ${0.10 + lampStrength * 0.2})`);
            gradient.addColorStop(1, 'rgba(5, 4, 4, 0.70)');
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        ctx.strokeStyle = 'rgba(255, 223, 165, 0.28)';
        ctx.lineWidth = 1.1;
        ctx.setLineDash([10, 14]);
        ctx.beginPath();
        ctx.moveTo(0, canvas.height * 0.47);
        ctx.lineTo(canvas.width, canvas.height * 0.47);
        ctx.stroke();

        ctx.restore();
    }

    function clamp(number, min, max) {
        return Math.max(min, Math.min(max, number));
    }

    function updateTargetList() {
        [...elements.targetList.children].forEach((item, index) => {
            const target = targets[index];
            item.classList.toggle('done', state.solved.has(target.key));
        });
    }

    function handleCanvasClick(event) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;
        const x = (event.clientX - rect.left) * scaleX;
        const y = (event.clientY - rect.top) * scaleY;

        state.pointer.active = true;
        state.pointer.x = x;
        state.pointer.y = y;

        const target = targets[state.challengeIndex];
        if (!target) {
            elements.challengeBanner.textContent = 'Round complete. Reset the lab or shuffle the cloth for another go.';
            return;
        }

        const dx = x - target.x;
        const dy = y - target.y;
        const hit = Math.sqrt((dx * dx) + (dy * dy)) <= target.radius;

        if (hit) {
            state.solved.add(target.key);
            state.challengeIndex += 1;
            if (state.challengeIndex >= targets.length) {
                elements.challengeBanner.textContent = 'You found all three features. The face has officially stopped pretending to be abstract laundry.';
            } else {
                const next = targets[state.challengeIndex];
                elements.challengeBanner.textContent = challengeText[next.key];
            }
            applyUI();
        } else {
            elements.challengeBanner.textContent = target.hint;
        }
        render();
    }

    function bindControls() {
        elements.modeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                state.mode = button.dataset.mode;
                applyUI();
                render();
            });
        });

        const bindings = [
            ['contrast', 'contrast'],
            ['ghost', 'ghost'],
            ['warp', 'warp'],
            ['lamp', 'lamp']
        ];

        bindings.forEach(([id, key]) => {
            elements[id].addEventListener('input', () => {
                state[key] = Number(elements[id].value);
                applyUI();
                render();
            });
        });

        elements.toggleSweep.addEventListener('click', () => {
            state.sweepRunning = !state.sweepRunning;
            elements.toggleSweep.textContent = state.sweepRunning ? 'Pause Sweep' : 'Resume Sweep';
        });

        elements.randomize.addEventListener('click', () => {
            state.seed = Number((Math.random() * 10).toFixed(4));
            render();
        });

        elements.resetLab.addEventListener('click', () => {
            state.mode = 'relic';
            state.contrast = 58;
            state.ghost = 64;
            state.warp = 36;
            state.lamp = 74;
            state.seed = 1.618;
            state.challengeIndex = 0;
            state.solved.clear();
            state.pointer.active = false;
            state.sweepRunning = true;
            elements.toggleSweep.textContent = 'Pause Sweep';
            elements.challengeBanner.textContent = challengeText.brow;
            elements.contrast.value = state.contrast;
            elements.ghost.value = state.ghost;
            elements.warp.value = state.warp;
            elements.lamp.value = state.lamp;
            applyUI();
            render();
        });

        canvas.addEventListener('pointermove', (event) => {
            const rect = canvas.getBoundingClientRect();
            state.pointer.active = true;
            state.pointer.x = (event.clientX - rect.left) * (canvas.width / rect.width);
            state.pointer.y = (event.clientY - rect.top) * (canvas.height / rect.height);
        });

        canvas.addEventListener('pointerleave', () => {
            state.pointer.active = false;
        });

        canvas.addEventListener('click', handleCanvasClick);
    }

    function animate() {
        if (state.sweepRunning && !state.pointer.active) {
            state.sweepPhase += 0.016 + (state.lamp / 1000);
            render();
        }
        requestAnimationFrame(animate);
    }

    bindControls();
    applyUI();
    render();
    animate();
})();
</script>
</body>
</html>
