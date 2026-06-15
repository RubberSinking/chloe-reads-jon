<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickDraw Workshop</title>
    <style>
        :root {
            --paper: #f4f0e6;
            --paper-shadow: #dbd4c5;
            --ink: #171717;
            --soft-ink: #4d4d4d;
            --panel: rgba(255, 255, 255, 0.72);
            --line: rgba(23, 23, 23, 0.18);
            --accent: #d84f18;
            --accent-soft: rgba(216, 79, 24, 0.14);
            --glow: rgba(255, 255, 255, 0.75);
            --shadow: 0 28px 60px rgba(43, 32, 17, 0.16);
            --radius: 26px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Baskerville, "Palatino Linotype", "Book Antiqua", Palatino, serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top, rgba(255,255,255,0.9), transparent 28%),
                linear-gradient(180deg, #f9f7f1 0%, #efe9dd 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        body::before {
            opacity: 0.1;
            background-image:
                linear-gradient(rgba(0,0,0,0.3) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,0,0,0.16) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(circle at center, black 30%, transparent 88%);
        }

        body::after {
            opacity: 0.06;
            background-image: radial-gradient(circle, rgba(0,0,0,0.9) 0.7px, transparent 0.7px);
            background-size: 9px 9px;
            mix-blend-mode: multiply;
        }

        a {
            color: inherit;
        }

        .shell {
            width: min(1180px, calc(100% - 32px));
            margin: 20px auto 40px;
            padding: 20px;
            border-radius: 34px;
            background: linear-gradient(180deg, rgba(255,255,255,0.84), rgba(242,236,224,0.92));
            border: 1px solid rgba(28, 28, 28, 0.12);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .masthead {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 20px;
            align-items: stretch;
            margin-bottom: 20px;
        }

        .hero,
        .story-card,
        .studio,
        .tricks {
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background: var(--panel);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
        }

        .hero {
            padding: 26px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(135deg, rgba(0,0,0,0.03), transparent 45%),
                linear-gradient(180deg, rgba(255,255,255,0.92), rgba(240,233,220,0.86));
        }

        .hero::after {
            content: "";
            position: absolute;
            right: -80px;
            top: -50px;
            width: 240px;
            height: 240px;
            border-radius: 32px;
            background:
                repeating-linear-gradient(
                    135deg,
                    rgba(216, 79, 24, 0.14) 0 8px,
                    rgba(216, 79, 24, 0.05) 8px 16px
                );
            transform: rotate(12deg);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            font-size: 0.74rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-family: "Lucida Sans Typewriter", "Courier New", monospace;
            background: rgba(23, 23, 23, 0.05);
            border: 1px solid rgba(23, 23, 23, 0.08);
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2.4rem, 5vw, 4.7rem);
            line-height: 0.92;
            letter-spacing: -0.06em;
            max-width: 9ch;
        }

        .hero p {
            max-width: 54ch;
            margin: 0 0 18px;
            font-size: 1.05rem;
            line-height: 1.65;
            color: var(--soft-ink);
            position: relative;
            z-index: 1;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        button,
        .button-link,
        .tool-button,
        .pattern-button,
        .chip {
            font: inherit;
        }

        .button-link,
        .pill-button {
            text-decoration: none;
            border: 1px solid rgba(23, 23, 23, 0.12);
            border-radius: 999px;
            padding: 12px 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        .button-link:hover,
        .pill-button:hover,
        .tool-button:hover,
        .pattern-button:hover,
        .chip:hover {
            transform: translateY(-2px);
        }

        .button-link.primary,
        .pill-button.primary {
            background: var(--ink);
            color: #fffef9;
            box-shadow: 0 12px 24px rgba(23, 23, 23, 0.16);
        }

        .button-link.secondary,
        .pill-button.secondary {
            background: rgba(255,255,255,0.82);
            color: var(--ink);
        }

        .story-card {
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.94), rgba(246,240,229,0.88)),
                repeating-linear-gradient(180deg, rgba(0,0,0,0.04) 0 2px, transparent 2px 20px);
        }

        .story-card h2,
        .panel-title {
            margin: 0;
            font-size: 1.15rem;
            letter-spacing: -0.03em;
        }

        .quote {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--soft-ink);
        }

        .fact-stack {
            display: grid;
            gap: 12px;
        }

        .fact {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.78);
            border: 1px solid rgba(23,23,23,0.08);
        }

        .fact strong {
            display: block;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            margin-bottom: 6px;
            font-family: "Lucida Sans Typewriter", "Courier New", monospace;
        }

        .workspace {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(310px, 0.75fr);
            gap: 20px;
        }

        .studio {
            padding: 18px;
            background:
                linear-gradient(180deg, rgba(249,247,242,0.96), rgba(238,232,221,0.94));
        }

        .window-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 10px 14px;
            margin-bottom: 16px;
            border-radius: 18px;
            border: 1px solid rgba(23,23,23,0.08);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.88), rgba(227,221,210,0.92));
        }

        .window-dots {
            display: flex;
            gap: 8px;
        }

        .window-dots span {
            width: 13px;
            height: 13px;
            border-radius: 50%;
            border: 1px solid rgba(23,23,23,0.3);
            background: linear-gradient(180deg, #fefefe, #d8d3c8);
        }

        .window-title {
            font-family: "Lucida Sans Typewriter", "Courier New", monospace;
            font-size: 0.82rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .toolbelt {
            display: grid;
            gap: 14px;
            margin-bottom: 16px;
        }

        .tool-group {
            display: grid;
            gap: 10px;
        }

        .tool-grid,
        .pattern-grid,
        .chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tool-button,
        .pattern-button,
        .chip {
            border-radius: 18px;
            border: 1px solid rgba(23,23,23,0.12);
            background: rgba(255,255,255,0.88);
            padding: 11px 14px;
            cursor: pointer;
            transition: transform 160ms ease, background 160ms ease, border-color 160ms ease, box-shadow 160ms ease;
            color: var(--ink);
        }

        .tool-button.active,
        .pattern-button.active,
        .chip.active {
            background: var(--ink);
            color: #fffef8;
            border-color: var(--ink);
            box-shadow: 0 10px 20px rgba(23, 23, 23, 0.16);
        }

        .screen-wrap {
            position: relative;
            border-radius: 26px;
            padding: 18px;
            background:
                linear-gradient(180deg, #b8b0a3, #c8c2b5 24%, #e1dccf 24%, #d7d1c4 100%);
            border: 1px solid rgba(32, 24, 16, 0.16);
            box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.65),
                0 20px 34px rgba(52, 40, 22, 0.18);
        }

        .screen-wrap::after {
            content: "QuickDraw";
            position: absolute;
            right: 22px;
            bottom: 12px;
            font-size: 0.76rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: rgba(23,23,23,0.48);
            font-family: "Lucida Sans Typewriter", "Courier New", monospace;
        }

        .screen {
            position: relative;
            border-radius: 18px;
            border: 2px solid rgba(23,23,23,0.14);
            background: #fefefe;
            overflow: hidden;
            aspect-ratio: 512 / 342;
            box-shadow: inset 0 0 0 4px rgba(0,0,0,0.05);
        }

        canvas {
            display: block;
            width: 100%;
            height: 100%;
            image-rendering: pixelated;
            cursor: crosshair;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.9), rgba(245,245,245,0.92));
        }

        .screen-glass {
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(115deg, rgba(255,255,255,0.34), transparent 38%),
                repeating-linear-gradient(180deg, rgba(0,0,0,0.03) 0 2px, transparent 2px 4px);
            mix-blend-mode: multiply;
        }

        .status-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
            align-items: center;
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.78);
            border: 1px solid rgba(23,23,23,0.08);
            font-family: "Lucida Sans Typewriter", "Courier New", monospace;
            font-size: 0.84rem;
        }

        .status-bar strong {
            color: var(--accent);
        }

        .tricks {
            padding: 20px;
            display: grid;
            gap: 16px;
            align-content: start;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.96), rgba(243,237,226,0.9));
        }

        .caption {
            margin: 0;
            font-size: 0.9rem;
            line-height: 1.6;
            color: var(--soft-ink);
        }

        .trick-card {
            padding: 16px;
            border-radius: 20px;
            border: 1px solid rgba(23,23,23,0.08);
            background: rgba(255,255,255,0.78);
            display: grid;
            gap: 12px;
        }

        .trick-card h3 {
            margin: 0;
            font-size: 1rem;
        }

        .mini-meter {
            height: 10px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(23,23,23,0.08);
        }

        .mini-meter span {
            display: block;
            height: 100%;
            width: var(--fill, 50%);
            background: linear-gradient(90deg, var(--accent), #f1b63c);
        }

        .formula {
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(23,23,23,0.05);
            font-family: "Lucida Sans Typewriter", "Courier New", monospace;
            font-size: 0.82rem;
            overflow-x: auto;
        }

        .footer-note {
            margin-top: 20px;
            padding: 18px 20px;
            border-radius: 22px;
            background: rgba(255,255,255,0.75);
            border: 1px solid rgba(23,23,23,0.08);
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            justify-content: space-between;
            align-items: center;
        }

        .footer-note p {
            margin: 0;
            line-height: 1.6;
            color: var(--soft-ink);
        }

        @media (max-width: 980px) {
            .masthead,
            .workspace {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .shell {
                width: min(100% - 14px, 100%);
                margin: 8px auto 24px;
                padding: 12px;
                border-radius: 24px;
            }

            .hero,
            .story-card,
            .studio,
            .tricks {
                border-radius: 22px;
            }

            h1 {
                font-size: clamp(2.2rem, 13vw, 3.5rem);
            }

            .tool-button,
            .pattern-button,
            .chip,
            .button-link,
            .pill-button {
                width: 100%;
                justify-content: center;
            }

            .tool-grid,
            .pattern-grid,
            .chip-row,
            .hero-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .status-bar,
            .footer-note {
                display: grid;
            }
        }

        @media (prefers-reduced-motion: no-preference) {
            .hero,
            .story-card,
            .studio,
            .tricks {
                animation: rise-in 700ms ease backwards;
            }

            .story-card { animation-delay: 120ms; }
            .studio { animation-delay: 180ms; }
            .tricks { animation-delay: 260ms; }

            @keyframes rise-in {
                from {
                    opacity: 0;
                    transform: translateY(18px) scale(0.985);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="masthead">
            <article class="hero">
                <div class="eyebrow">1984 graphics sorcery</div>
                <h1>QuickDraw Workshop</h1>
                <p>
                    Jon noticed that Bill Atkinson's QuickDraw source is full of elegant graphics tricks, so this page turns that curiosity into a little black-and-white toy box. Draw, flood-fill, stamp dithers, and boot up a demo scene like you're squinting at a very smug beige Macintosh.
                </p>
                <div class="hero-actions">
                    <button class="pill-button primary" id="loadDemo">Load Demo Scene</button>
                    <button class="pill-button secondary" id="clearCanvas">Fresh Sheet</button>
                </div>
            </article>

            <aside class="story-card">
                <div>
                    <h2>Why this one?</h2>
                    <p class="quote">
                        “According to the interview with Donald Knuth in the book <em>Coders at Work</em>, Bill Atkinson's work is ‘well-documented code with lots of pioneering graphics algorithms in it.’”
                    </p>
                </div>
                <div class="fact-stack">
                    <div class="fact">
                        <strong>Try this</strong>
                        Tap <em>Fill</em>, choose a pattern, and seal a shape. If the paint leaks everywhere, congratulations, you have rediscovered why regions matter.
                    </div>
                    <div class="fact">
                        <strong>Little thrill</strong>
                        Your sketch saves to this browser automatically, because starting over from scratch every time is a cruel hobby.
                    </div>
                </div>
            </aside>
        </section>

        <section class="workspace">
            <section class="studio">
                <div class="window-bar">
                    <div class="window-dots" aria-hidden="true">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="window-title">Macintosh graphics desk</div>
                    <div class="eyebrow">512 x 342</div>
                </div>

                <div class="toolbelt">
                    <div class="tool-group">
                        <h2 class="panel-title">Tools</h2>
                        <div class="tool-grid" id="toolGrid">
                            <button class="tool-button active" data-tool="pencil">Pencil</button>
                            <button class="tool-button" data-tool="line">Line</button>
                            <button class="tool-button" data-tool="rect">Rect</button>
                            <button class="tool-button" data-tool="round">Round Rect</button>
                            <button class="tool-button" data-tool="oval">Oval</button>
                            <button class="tool-button" data-tool="eraser">Eraser</button>
                            <button class="tool-button" data-tool="fill">Fill</button>
                        </div>
                    </div>

                    <div class="tool-group">
                        <h2 class="panel-title">Patterns</h2>
                        <div class="pattern-grid" id="patternGrid">
                            <button class="pattern-button active" data-pattern="solid">Solid Ink</button>
                            <button class="pattern-button" data-pattern="white">Paper</button>
                            <button class="pattern-button" data-pattern="checker">Checker</button>
                            <button class="pattern-button" data-pattern="dots">Dots</button>
                            <button class="pattern-button" data-pattern="hatch">Hatch</button>
                        </div>
                    </div>

                    <div class="tool-group">
                        <h2 class="panel-title">Scene helpers</h2>
                        <div class="chip-row">
                            <button class="chip" id="drawWindow">Classic Window</button>
                            <button class="chip" id="drawBadge">Happy Mac Badge</button>
                            <button class="chip" id="invertCanvas">Invert Screen</button>
                            <button class="chip" id="undoAction">Undo</button>
                        </div>
                    </div>
                </div>

                <div class="screen-wrap">
                    <div class="screen">
                        <canvas id="canvas" width="512" height="342" aria-label="QuickDraw drawing canvas"></canvas>
                        <div class="screen-glass"></div>
                    </div>
                </div>

                <div class="status-bar">
                    <div><strong id="toolLabel">Pencil</strong> ready</div>
                    <div>Pattern: <span id="patternLabel">Solid Ink</span></div>
                    <div id="hintLabel">Tip: draw a loop, then try Fill.</div>
                </div>
            </section>

            <aside class="tricks">
                <div>
                    <h2 class="panel-title">Atkinson tricks</h2>
                    <p class="caption">
                        Three tiny explanations to make the playground feel like a cheerful museum exhibit instead of “a canvas with ambition.”
                    </p>
                </div>

                <article class="trick-card">
                    <h3>Regions tame the chaos</h3>
                    <p class="caption">QuickDraw got famous for making shapes, clipping, and fills feel magical on very limited hardware. Closed boundaries are your friends.</p>
                    <div class="mini-meter" aria-hidden="true"><span style="--fill: 84%"></span></div>
                    <div class="formula">Closed outline + fill seed -> controlled paint instead of glorious soup</div>
                </article>

                <article class="trick-card">
                    <h3>Rounded rectangles have charisma</h3>
                    <p class="caption">The original Mac look is half algorithm, half manners. Use the <em>Round Rect</em> tool and suddenly the whole page becomes more polite.</p>
                    <div class="mini-meter" aria-hidden="true"><span style="--fill: 67%"></span></div>
                    <button class="pill-button secondary" id="roundedScene">Sketch a polite desktop</button>
                </article>

                <article class="trick-card">
                    <h3>Dither is tiny drama</h3>
                    <p class="caption">Without color, patterns do the heavy lifting. Checker, dots, and hatch give you fake grayscale the same way old UIs did: with stubborn charm.</p>
                    <div class="mini-meter" aria-hidden="true"><span style="--fill: 73%"></span></div>
                    <button class="pill-button secondary" id="patternParade">Pattern parade</button>
                </article>

                <article class="trick-card">
                    <h3>Saved in this browser</h3>
                    <p class="caption">Your drawing autosaves locally, so if you accidentally build the world's grumpiest pixel cat, it can haunt this device indefinitely.</p>
                </article>
            </aside>
        </section>

        <section class="footer-note">
            <p>Inspired by Jon’s post about studying the QuickDraw source code and admiring pioneering graphics algorithms with real style.</p>
            <a class="button-link secondary" href="./">Back to Chloe Reads Jon</a>
        </section>
    </main>

    <script>
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d', { willReadFrequently: true });
        const toolButtons = [...document.querySelectorAll('.tool-button')];
        const patternButtons = [...document.querySelectorAll('.pattern-button')];
        const toolLabel = document.getElementById('toolLabel');
        const patternLabel = document.getElementById('patternLabel');
        const hintLabel = document.getElementById('hintLabel');
        const undoStack = [];
        const storageKey = 'quickdraw-workshop-save';

        const toolNames = {
            pencil: 'Pencil',
            line: 'Line',
            rect: 'Rect',
            round: 'Round Rect',
            oval: 'Oval',
            eraser: 'Eraser',
            fill: 'Fill'
        };

        const patternNames = {
            solid: 'Solid Ink',
            white: 'Paper',
            checker: 'Checker',
            dots: 'Dots',
            hatch: 'Hatch'
        };

        const hints = {
            pencil: 'Tip: sketch a little window frame, then flood-fill it.',
            line: 'Tip: line segments make reliable walls for Fill.',
            rect: 'Tip: rectangles plus checker fills feel very 1984.',
            round: 'Tip: rounded corners instantly improve everyone’s manners.',
            oval: 'Tip: ovals look surprisingly grand with hatch shading.',
            eraser: 'Tip: the eraser is just white ink wearing work boots.',
            fill: 'Tip: closed shapes are vital. Tiny gaps invite disaster.'
        };

        let currentTool = 'pencil';
        let currentPattern = 'solid';
        let drawing = false;
        let startPoint = null;
        let snapshot = null;

        function setTool(tool) {
            currentTool = tool;
            toolButtons.forEach((button) => button.classList.toggle('active', button.dataset.tool === tool));
            toolLabel.textContent = toolNames[tool];
            hintLabel.textContent = hints[tool];
        }

        function setPattern(pattern) {
            currentPattern = pattern;
            patternButtons.forEach((button) => button.classList.toggle('active', button.dataset.pattern === pattern));
            patternLabel.textContent = patternNames[pattern];
        }

        function patternCanvas(type) {
            const tile = document.createElement('canvas');
            tile.width = 8;
            tile.height = 8;
            const tctx = tile.getContext('2d');
            tctx.fillStyle = '#ffffff';
            tctx.fillRect(0, 0, 8, 8);
            tctx.fillStyle = '#111111';

            if (type === 'solid') {
                tctx.fillRect(0, 0, 8, 8);
            } else if (type === 'checker') {
                for (let y = 0; y < 8; y += 2) {
                    for (let x = (y / 2) % 2 === 0 ? 0 : 2; x < 8; x += 4) {
                        tctx.fillRect(x, y, 2, 2);
                    }
                }
            } else if (type === 'dots') {
                [1, 5].forEach((x) => [1, 5].forEach((y) => tctx.fillRect(x, y, 1, 1)));
                [3, 7].forEach((x) => [3, 7].forEach((y) => tctx.fillRect(x % 8, y % 8, 1, 1)));
            } else if (type === 'hatch') {
                for (let i = -8; i < 8; i += 2) {
                    tctx.beginPath();
                    tctx.moveTo(i, 8);
                    tctx.lineTo(i + 8, 0);
                    tctx.strokeStyle = '#111111';
                    tctx.lineWidth = 1;
                    tctx.stroke();
                }
            }

            return type === 'white' ? '#ffffff' : ctx.createPattern(tile, 'repeat');
        }

        function strokeColor() {
            return currentTool === 'eraser' || currentPattern === 'white' ? '#ffffff' : '#111111';
        }

        function fillStyleForPattern() {
            return patternCanvas(currentPattern);
        }

        function saveState() {
            undoStack.push(ctx.getImageData(0, 0, canvas.width, canvas.height));
            if (undoStack.length > 30) undoStack.shift();
        }

        function persist() {
            try {
                localStorage.setItem(storageKey, canvas.toDataURL('image/png'));
            } catch (error) {
                // Ignore quota failures. This is art, not nuclear launch control.
            }
        }

        function restoreSaved() {
            const saved = localStorage.getItem(storageKey);
            if (!saved) {
                resetCanvas();
                return;
            }

            const image = new Image();
            image.onload = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(image, 0, 0);
            };
            image.src = saved;
        }

        function resetCanvas() {
            ctx.fillStyle = '#fbfbfb';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.strokeStyle = '#111111';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            drawFrame();
            persist();
        }

        function drawFrame() {
            ctx.save();
            ctx.strokeStyle = '#d8d8d8';
            ctx.lineWidth = 4;
            ctx.strokeRect(8, 8, canvas.width - 16, canvas.height - 16);
            ctx.restore();
        }

        function canvasPoint(event) {
            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;
            return {
                x: (event.clientX - rect.left) * scaleX,
                y: (event.clientY - rect.top) * scaleY
            };
        }

        function beginDraw(event) {
            const point = canvasPoint(event);
            if (currentTool === 'fill') {
                saveState();
                floodFill(Math.floor(point.x), Math.floor(point.y));
                persist();
                return;
            }

            saveState();
            drawing = true;
            startPoint = point;
            snapshot = ctx.getImageData(0, 0, canvas.width, canvas.height);

            if (currentTool === 'pencil' || currentTool === 'eraser') {
                ctx.beginPath();
                ctx.strokeStyle = strokeColor();
                ctx.lineWidth = currentTool === 'eraser' ? 12 : 2;
                ctx.moveTo(point.x, point.y);
            }
        }

        function draw(event) {
            if (!drawing) return;
            const point = canvasPoint(event);

            if (currentTool === 'pencil' || currentTool === 'eraser') {
                ctx.lineTo(point.x, point.y);
                ctx.stroke();
                return;
            }

            ctx.putImageData(snapshot, 0, 0);
            ctx.strokeStyle = strokeColor();
            ctx.lineWidth = 2;
            ctx.fillStyle = fillStyleForPattern();

            const x = Math.min(startPoint.x, point.x);
            const y = Math.min(startPoint.y, point.y);
            const width = Math.abs(point.x - startPoint.x);
            const height = Math.abs(point.y - startPoint.y);

            if (currentTool === 'line') {
                ctx.beginPath();
                ctx.moveTo(startPoint.x, startPoint.y);
                ctx.lineTo(point.x, point.y);
                ctx.stroke();
            } else if (currentTool === 'rect') {
                ctx.strokeRect(x, y, width, height);
            } else if (currentTool === 'round') {
                roundedRectPath(ctx, x, y, width, height, Math.min(18, width / 4, height / 4));
                ctx.stroke();
            } else if (currentTool === 'oval') {
                ctx.beginPath();
                ctx.ellipse(x + width / 2, y + height / 2, width / 2, height / 2, 0, 0, Math.PI * 2);
                ctx.stroke();
            }
        }

        function endDraw(event) {
            if (!drawing) return;
            draw(event);
            drawing = false;
            startPoint = null;
            snapshot = null;
            persist();
        }

        function roundedRectPath(context, x, y, width, height, radius) {
            context.beginPath();
            context.moveTo(x + radius, y);
            context.lineTo(x + width - radius, y);
            context.quadraticCurveTo(x + width, y, x + width, y + radius);
            context.lineTo(x + width, y + height - radius);
            context.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
            context.lineTo(x + radius, y + height);
            context.quadraticCurveTo(x, y + height, x, y + height - radius);
            context.lineTo(x, y + radius);
            context.quadraticCurveTo(x, y, x + radius, y);
        }

        function colorsMatch(data, index, target) {
            return data[index] === target[0]
                && data[index + 1] === target[1]
                && data[index + 2] === target[2]
                && data[index + 3] === target[3];
        }

        function floodFill(x, y) {
            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;
            const startIndex = (y * canvas.width + x) * 4;
            const target = [data[startIndex], data[startIndex + 1], data[startIndex + 2], data[startIndex + 3]];

            const fillCanvas = document.createElement('canvas');
            fillCanvas.width = canvas.width;
            fillCanvas.height = canvas.height;
            const fctx = fillCanvas.getContext('2d');
            fctx.fillStyle = fillStyleForPattern();
            fctx.fillRect(0, 0, canvas.width, canvas.height);
            const fillData = fctx.getImageData(0, 0, canvas.width, canvas.height).data;

            const replacement = [
                fillData[startIndex],
                fillData[startIndex + 1],
                fillData[startIndex + 2],
                fillData[startIndex + 3]
            ];

            if (target.every((value, i) => value === replacement[i])) return;

            const stack = [[x, y]];
            while (stack.length) {
                const [cx, cy] = stack.pop();
                if (cx < 0 || cx >= canvas.width || cy < 0 || cy >= canvas.height) continue;

                const index = (cy * canvas.width + cx) * 4;
                if (!colorsMatch(data, index, target)) continue;

                data[index] = fillData[index];
                data[index + 1] = fillData[index + 1];
                data[index + 2] = fillData[index + 2];
                data[index + 3] = fillData[index + 3];

                stack.push([cx + 1, cy], [cx - 1, cy], [cx, cy + 1], [cx, cy - 1]);
            }

            ctx.putImageData(imageData, 0, 0);
        }

        function undo() {
            const previous = undoStack.pop();
            if (!previous) return;
            ctx.putImageData(previous, 0, 0);
            persist();
        }

        function invertCanvas() {
            saveState();
            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const data = imageData.data;
            for (let i = 0; i < data.length; i += 4) {
                data[i] = 255 - data[i];
                data[i + 1] = 255 - data[i + 1];
                data[i + 2] = 255 - data[i + 2];
            }
            ctx.putImageData(imageData, 0, 0);
            persist();
        }

        function drawClassicWindow() {
            saveState();
            ctx.strokeStyle = '#111111';
            ctx.fillStyle = '#ffffff';
            ctx.lineWidth = 2;
            roundedRectPath(ctx, 54, 46, 250, 170, 16);
            ctx.fill();
            ctx.stroke();
            ctx.fillRect(54, 68, 250, 22);
            ctx.strokeRect(54, 68, 250, 22);
            ctx.fillStyle = '#111111';
            ctx.fillRect(68, 54, 26, 8);
            ctx.fillRect(104, 54, 26, 8);
            ctx.fillRect(140, 54, 26, 8);
            ctx.fillText?.('Finder-ish', 178, 83);
            ctx.strokeRect(82, 116, 70, 54);
            ctx.strokeRect(174, 116, 92, 70);
            persist();
        }

        function drawHappyMacBadge() {
            saveState();
            ctx.strokeStyle = '#111111';
            ctx.fillStyle = '#ffffff';
            ctx.lineWidth = 2;
            roundedRectPath(ctx, 350, 54, 108, 124, 24);
            ctx.fill();
            ctx.stroke();
            ctx.fillRect(374, 82, 60, 40);
            ctx.clearRect(386, 94, 10, 10);
            ctx.clearRect(412, 94, 10, 10);
            ctx.beginPath();
            ctx.arc(404, 112, 18, 0.22 * Math.PI, 0.78 * Math.PI);
            ctx.stroke();
            ctx.strokeRect(382, 132, 52, 10);
            persist();
        }

        function drawPatternParade() {
            saveState();
            ctx.fillStyle = '#fbfbfb';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            drawFrame();
            const patterns = ['solid', 'checker', 'dots', 'hatch', 'white'];
            patterns.forEach((pattern, index) => {
                const x = 34 + index * 94;
                const y = 80;
                ctx.strokeStyle = '#111111';
                ctx.lineWidth = 2;
                ctx.fillStyle = patternCanvas(pattern === 'white' ? 'checker' : pattern);
                roundedRectPath(ctx, x, y, 70, 120, 16);
                if (pattern === 'white') {
                    ctx.fillStyle = '#ffffff';
                    ctx.fill();
                    ctx.stroke();
                    ctx.beginPath();
                    ctx.moveTo(x + 12, y + 12);
                    ctx.lineTo(x + 58, y + 108);
                    ctx.moveTo(x + 58, y + 12);
                    ctx.lineTo(x + 12, y + 108);
                    ctx.stroke();
                } else {
                    ctx.fill();
                    ctx.stroke();
                }
            });
            persist();
        }

        function drawDemoScene() {
            saveState();
            ctx.fillStyle = '#fbfbfb';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            drawFrame();

            ctx.strokeStyle = '#111111';
            ctx.lineWidth = 2;

            roundedRectPath(ctx, 36, 34, 286, 196, 18);
            ctx.fillStyle = '#ffffff';
            ctx.fill();
            ctx.stroke();

            ctx.fillStyle = '#111111';
            ctx.fillRect(36, 58, 286, 18);
            ctx.strokeRect(36, 58, 286, 18);

            ctx.fillStyle = patternCanvas('dots');
            roundedRectPath(ctx, 58, 104, 78, 68, 14);
            ctx.fill();
            ctx.stroke();

            ctx.fillStyle = patternCanvas('checker');
            ctx.beginPath();
            ctx.ellipse(204, 138, 46, 34, 0, 0, Math.PI * 2);
            ctx.fill();
            ctx.stroke();

            ctx.fillStyle = patternCanvas('hatch');
            roundedRectPath(ctx, 82, 184, 184, 24, 10);
            ctx.fill();
            ctx.stroke();

            drawHappyMacBadge();
            persist();
        }

        toolButtons.forEach((button) => button.addEventListener('click', () => setTool(button.dataset.tool)));
        patternButtons.forEach((button) => button.addEventListener('click', () => setPattern(button.dataset.pattern)));

        canvas.addEventListener('pointerdown', beginDraw);
        canvas.addEventListener('pointermove', draw);
        canvas.addEventListener('pointerup', endDraw);
        canvas.addEventListener('pointerleave', endDraw);

        document.getElementById('clearCanvas').addEventListener('click', () => {
            saveState();
            resetCanvas();
        });
        document.getElementById('loadDemo').addEventListener('click', drawDemoScene);
        document.getElementById('drawWindow').addEventListener('click', drawClassicWindow);
        document.getElementById('drawBadge').addEventListener('click', drawHappyMacBadge);
        document.getElementById('invertCanvas').addEventListener('click', invertCanvas);
        document.getElementById('undoAction').addEventListener('click', undo);
        document.getElementById('roundedScene').addEventListener('click', drawClassicWindow);
        document.getElementById('patternParade').addEventListener('click', drawPatternParade);

        restoreSaved();
        setTool('pencil');
        setPattern('solid');

        if (!localStorage.getItem(storageKey)) {
            drawDemoScene();
        }
    </script>
</body>
</html>
