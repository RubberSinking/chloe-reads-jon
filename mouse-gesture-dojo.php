<?php
$title = 'Mouse Gesture Dojo';
$date = '2026-06-21';
$sourceTitle = 'Mouse Gestures Library for Java';
$sourceUrl = 'https://jona.ca/2004/11/mouse-gestures-library-for-java.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        :root {
            --bg: #090c14;
            --bg-deep: #05070d;
            --panel: rgba(11, 16, 30, 0.76);
            --panel-strong: rgba(8, 12, 22, 0.94);
            --line: rgba(132, 220, 255, 0.14);
            --text: #ecf7ff;
            --muted: #97abc2;
            --cyan: #8ce9ff;
            --teal: #36d4c4;
            --amber: #ffb44d;
            --rose: #ff7f97;
            --glow: 0 0 0 1px rgba(140, 233, 255, 0.05), 0 24px 80px rgba(0, 0, 0, 0.45);
            --radius: 28px;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background:
                radial-gradient(circle at 15% 18%, rgba(54, 212, 196, 0.16), transparent 24%),
                radial-gradient(circle at 85% 12%, rgba(255, 180, 77, 0.14), transparent 18%),
                radial-gradient(circle at 50% 120%, rgba(140, 233, 255, 0.16), transparent 32%),
                linear-gradient(160deg, #06101b 0%, #09101d 30%, #05070d 100%);
            color: var(--text);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, Georgia, serif;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        body::before {
            opacity: 0.18;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(circle at center, black 30%, transparent 88%);
        }

        body::after {
            opacity: 0.08;
            background:
                repeating-linear-gradient(180deg, rgba(255,255,255,0.18) 0 1px, transparent 1px 3px);
            mix-blend-mode: screen;
        }

        a { color: inherit; }

        .shell {
            width: min(1220px, calc(100% - 24px));
            margin: 0 auto;
            padding: 22px 0 42px;
        }

        .hero,
        .panel {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));
            box-shadow: var(--glow);
            backdrop-filter: blur(18px);
        }

        .hero {
            padding: 30px;
        }

        .hero::after,
        .panel::after {
            content: "";
            position: absolute;
            inset: auto -15% -45% auto;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(54, 212, 196, 0.18), transparent 70%);
            filter: blur(12px);
            pointer-events: none;
        }

        .eyebrow,
        .status-pill,
        .combo,
        .tiny-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 999px;
            font: 700 0.74rem/1 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .eyebrow {
            padding: 9px 14px;
            color: var(--cyan);
            background: rgba(140, 233, 255, 0.08);
            border: 1px solid rgba(140, 233, 255, 0.16);
        }

        h1 {
            margin: 18px 0 12px;
            font-size: clamp(3rem, 6vw, 5.8rem);
            line-height: 0.9;
            letter-spacing: -0.06em;
            max-width: 9ch;
        }

        .hero-copy {
            max-width: 66ch;
            color: var(--muted);
            font-size: 1.04rem;
            line-height: 1.72;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 22px;
            align-items: end;
        }

        .hero-cards {
            display: grid;
            gap: 14px;
            align-content: end;
        }

        .hero-card {
            padding: 18px;
            border-radius: 22px;
            background: rgba(5, 11, 22, 0.76);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .hero-card strong {
            display: block;
            margin-bottom: 6px;
            color: var(--text);
        }

        .hero-card span {
            color: var(--muted);
            font-size: 0.94rem;
            line-height: 1.6;
        }

        .hero-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .hero-links a,
        button {
            appearance: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        .button-primary,
        .button-secondary,
        .button-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 18px;
            border-radius: 16px;
            font: 700 0.92rem/1 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .button-primary {
            color: #051019;
            background: linear-gradient(135deg, var(--cyan), #c6fff7);
            box-shadow: 0 18px 28px rgba(28, 170, 204, 0.22);
        }

        .button-secondary {
            color: var(--text);
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .button-ghost {
            color: var(--amber);
            background: rgba(255, 180, 77, 0.08);
            border: 1px solid rgba(255, 180, 77, 0.14);
        }

        .button-primary:hover,
        .button-secondary:hover,
        .button-ghost:hover,
        .command-card:hover {
            transform: translateY(-2px);
        }

        .dashboard {
            display: grid;
            grid-template-columns: minmax(0, 1.06fr) minmax(310px, 0.94fr);
            gap: 22px;
            margin-top: 22px;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 12px;
            margin-bottom: 16px;
        }

        .panel h2,
        .panel h3 {
            margin: 0;
            letter-spacing: -0.04em;
        }

        .panel h2 { font-size: 1.4rem; }
        .panel h3 { font-size: 1rem; }

        .subtle {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .panel-pad {
            padding: 22px;
        }

        .status-pill {
            padding: 8px 12px;
            color: var(--amber);
            background: rgba(255, 180, 77, 0.08);
            border: 1px solid rgba(255, 180, 77, 0.16);
        }

        .canvas-wrap {
            position: relative;
            border-radius: 24px;
            padding: 14px;
            background:
                radial-gradient(circle at 50% 48%, rgba(140, 233, 255, 0.12), transparent 35%),
                linear-gradient(180deg, rgba(9, 15, 28, 0.96), rgba(4, 8, 16, 0.96));
            border: 1px solid rgba(140, 233, 255, 0.1);
        }

        canvas {
            display: block;
            width: 100%;
            height: 380px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            background:
                radial-gradient(circle at center, rgba(13, 34, 53, 0.8), rgba(2, 6, 14, 0.94)),
                linear-gradient(180deg, rgba(255,255,255,0.03), transparent);
            touch-action: none;
        }

        .hud-grid,
        .meter-grid,
        .library,
        .stat-grid,
        .note-grid,
        .tips {
            display: grid;
            gap: 14px;
        }

        .hud-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 14px;
        }

        .hud-card,
        .meter,
        .note,
        .tip {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .hud-card span,
        .meter-label,
        .note strong,
        .tip strong {
            display: block;
            font: 700 0.74rem/1.2 "Trebuchet MS", "Segoe UI", sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            color: var(--muted);
        }

        .hud-card strong,
        .meter-value {
            display: block;
            margin-top: 10px;
            font-size: 1.3rem;
            letter-spacing: -0.04em;
            color: var(--text);
        }

        .action-row,
        .tiny-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .action-row {
            margin-top: 18px;
        }

        .tiny-actions { margin-top: 12px; }

        .library {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 18px;
        }

        .command-card {
            position: relative;
            padding: 16px;
            border-radius: 20px;
            background: rgba(5, 10, 20, 0.82);
            border: 1px solid rgba(255,255,255,0.08);
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        .command-card.active {
            border-color: rgba(140, 233, 255, 0.42);
            background: rgba(11, 29, 42, 0.92);
            box-shadow: inset 0 0 0 1px rgba(140, 233, 255, 0.12);
        }

        .command-card .tiny-tag {
            padding: 7px 11px;
            color: var(--cyan);
            background: rgba(140, 233, 255, 0.08);
            border: 1px solid rgba(140, 233, 255, 0.12);
        }

        .command-card p {
            margin: 12px 0 0;
            color: var(--muted);
            font-size: 0.94rem;
            line-height: 1.55;
        }

        .path-strip {
            margin-top: 12px;
            font: 700 0.8rem/1 "Trebuchet MS", "Segoe UI", sans-serif;
            color: var(--amber);
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .meter-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 16px;
        }

        .meter-track {
            height: 10px;
            border-radius: 999px;
            margin-top: 10px;
            overflow: hidden;
            background: rgba(255,255,255,0.07);
        }

        .meter-fill {
            height: 100%;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--amber), var(--cyan));
            transition: width 240ms ease;
        }

        .mission {
            margin-top: 18px;
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(255, 127, 151, 0.12), rgba(54, 212, 196, 0.14));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .mission strong {
            display: block;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .mission p {
            margin: 0;
            color: var(--text);
            line-height: 1.6;
        }

        .combo {
            padding: 8px 12px;
            color: var(--rose);
            background: rgba(255, 127, 151, 0.08);
            border: 1px solid rgba(255, 127, 151, 0.14);
        }

        .stat-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 18px;
        }

        .stat {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .stat span {
            display: block;
            color: var(--muted);
            font: 700 0.72rem/1 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .stat strong {
            display: block;
            margin-top: 10px;
            font-size: 1.35rem;
            letter-spacing: -0.04em;
        }

        .note-grid,
        .tips {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 18px;
        }

        .note p,
        .tip p {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.94rem;
        }

        .footer-link {
            margin-top: 20px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .footer-link a {
            color: var(--cyan);
            text-decoration: none;
            border-bottom: 1px solid rgba(140, 233, 255, 0.25);
        }

        .footer-link a:hover {
            border-bottom-color: rgba(140, 233, 255, 0.75);
        }

        @media (max-width: 960px) {
            .hero-grid,
            .dashboard {
                grid-template-columns: 1fr;
            }

            .hero-cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 720px) {
            .shell {
                width: min(100%, calc(100% - 16px));
                padding-top: 12px;
            }

            .hero,
            .panel-pad {
                padding: 18px;
            }

            .hero-cards,
            .library,
            .hud-grid,
            .meter-grid,
            .stat-grid,
            .note-grid,
            .tips {
                grid-template-columns: 1fr;
            }

            canvas {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Command by flourish</div>
                    <h1><?= htmlspecialchars($title) ?></h1>
                    <p class="hero-copy">
                        A neon command bunker for learning the lost pleasure of browser mouse gestures. Draw with your finger or cursor,
                        watch the dojo decode your path, and chase smooth little combos until the interface starts feeling like a wand instead of a filing cabinet.
                    </p>
                    <div class="hero-links">
                        <a class="button-primary" href="#dojo">Enter the dojo</a>
                        <a class="button-secondary" href="index.php">Back to Chloe Reads Jon</a>
                        <a class="button-ghost" href="<?= htmlspecialchars($sourceUrl) ?>">Inspired by Jon's <?= htmlspecialchars($sourceTitle) ?></a>
                    </div>
                </div>
                <div class="hero-cards">
                    <div class="hero-card">
                        <strong>Design direction</strong>
                        <span>Radar room meets stained-glass terminal: cool cyan traces, warm amber alerts, and just enough theatrical glow to make practice feel ceremonial.</span>
                    </div>
                    <div class="hero-card">
                        <strong>What you do</strong>
                        <span>Draw gesture paths, match them to browser commands, and clear a rotating challenge board that rewards confidence, not pixel-perfect handwriting.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashboard" id="dojo">
            <div class="panel panel-pad">
                <div class="panel-header">
                    <div>
                        <h2>Trace Arena</h2>
                        <p class="subtle">Press, drag, release. The dojo compresses your route into a direction ribbon and compares it to the command library below.</p>
                    </div>
                    <div class="status-pill" id="statusPill">Ready</div>
                </div>

                <div class="canvas-wrap">
                    <canvas id="gestureCanvas" aria-label="Gesture drawing area"></canvas>
                </div>

                <div class="hud-grid">
                    <div class="hud-card">
                        <span>Gesture path</span>
                        <strong id="pathLabel">Waiting for your move</strong>
                    </div>
                    <div class="hud-card">
                        <span>Decoded command</span>
                        <strong id="commandLabel">None yet</strong>
                    </div>
                    <div class="hud-card">
                        <span>Flow score</span>
                        <strong id="flowLabel">0</strong>
                    </div>
                </div>

                <div class="action-row">
                    <button class="button-primary" id="clearButton" type="button">Clear canvas</button>
                    <button class="button-secondary" id="demoButton" type="button">Show demo trace</button>
                    <button class="button-ghost" id="shuffleButton" type="button">New challenge</button>
                </div>

                <div class="library" id="library"></div>
            </div>

            <div class="panel panel-pad">
                <div class="panel-header">
                    <div>
                        <h2>Challenge Console</h2>
                        <p class="subtle">Each round asks for a different command. Nail the matching gesture and the dojo will bump your streak and confidence meters.</p>
                    </div>
                    <div class="combo" id="comboPill">Streak 0</div>
                </div>

                <div class="mission">
                    <strong id="missionTitle">Mission: Back</strong>
                    <p id="missionCopy">Draw a clean right-to-left sweep, like flicking a tab back to where it came from.</p>
                </div>

                <div class="meter-grid">
                    <div class="meter">
                        <span class="meter-label">Accuracy</span>
                        <strong class="meter-value" id="accuracyValue">0%</strong>
                        <div class="meter-track"><div class="meter-fill" id="accuracyFill"></div></div>
                    </div>
                    <div class="meter">
                        <span class="meter-label">Confidence</span>
                        <strong class="meter-value" id="confidenceValue">0%</strong>
                        <div class="meter-track"><div class="meter-fill" id="confidenceFill"></div></div>
                    </div>
                </div>

                <div class="stat-grid">
                    <div class="stat">
                        <span>Hits</span>
                        <strong id="hitsStat">0</strong>
                    </div>
                    <div class="stat">
                        <span>Best streak</span>
                        <strong id="bestStat">0</strong>
                    </div>
                    <div class="stat">
                        <span>Shape length</span>
                        <strong id="lengthStat">0 pts</strong>
                    </div>
                </div>

                <div class="note-grid">
                    <div class="note">
                        <strong>Recognition rule</strong>
                        <p>Big changes in direction matter. Tiny wiggles get ignored, so you can draw with conviction instead of micro-managing every corner.</p>
                    </div>
                    <div class="note">
                        <strong>Nathan mode energy</strong>
                        <p>Try making the traces dramatic. The secret joy here is pretending you are teaching KITT to cast browser spells.</p>
                    </div>
                </div>

                <div class="tips">
                    <div class="tip">
                        <strong>Good move</strong>
                        <p id="tipText">The dojo likes gestures with 1 to 3 clear turns. Fast, smooth, and a little swagger goes a long way.</p>
                    </div>
                    <div class="tip">
                        <strong>Command effect</strong>
                        <p id="effectText">When you match a command, the card lights up and the challenge board rotates to a new browser trick.</p>
                    </div>
                </div>

                <p class="footer-link">
                    Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl) ?>"><?= htmlspecialchars($sourceTitle) ?></a>.
                    This page uses only local HTML, CSS, JS, and PHP, so the whole little command ritual stays self-contained.
                </p>
            </div>
        </section>
    </div>

    <script>
        const commands = [
            {
                id: 'back',
                title: 'Back',
                pattern: 'L',
                label: 'Single sweep left',
                prompt: 'Draw a clean right-to-left sweep, like flicking a tab back to where it came from.',
                flavor: 'A browser retreat with dignity.'
            },
            {
                id: 'forward',
                title: 'Forward',
                pattern: 'R',
                label: 'Single sweep right',
                prompt: 'Launch forward with one decisive left-to-right stroke.',
                flavor: 'For when regret has passed and adventure resumes.'
            },
            {
                id: 'refresh',
                title: 'Refresh',
                pattern: 'DU',
                label: 'Dip then rise',
                prompt: 'Draw down then up, like jolting a sleepy page back to life.',
                flavor: 'A little resurrection arc.'
            },
            {
                id: 'close-tab',
                title: 'Close Tab',
                pattern: 'DL',
                label: 'Drop and slash left',
                prompt: 'Slice down-left to dismiss the current tab with mild theatrical contempt.',
                flavor: 'The brisk guillotine.'
            },
            {
                id: 'new-tab',
                title: 'New Tab',
                pattern: 'UR',
                label: 'Lift and launch',
                prompt: 'Sweep up-right to crack open a fresh tab like a skylight.',
                flavor: 'New idea, new hatch.'
            },
            {
                id: 'inspect',
                title: 'Inspect',
                pattern: 'RDL',
                label: 'Hook right, down, left',
                prompt: 'Trace a tight hook to signal detective mode and inspect the machinery.',
                flavor: 'Tiny trench coat energy.'
            }
        ];

        const commandMap = new Map(commands.map((command) => [command.pattern, command]));
        const missionPool = [...commands];

        const canvas = document.getElementById('gestureCanvas');
        const ctx = canvas.getContext('2d');
        const library = document.getElementById('library');
        const pathLabel = document.getElementById('pathLabel');
        const commandLabel = document.getElementById('commandLabel');
        const flowLabel = document.getElementById('flowLabel');
        const statusPill = document.getElementById('statusPill');
        const comboPill = document.getElementById('comboPill');
        const missionTitle = document.getElementById('missionTitle');
        const missionCopy = document.getElementById('missionCopy');
        const accuracyValue = document.getElementById('accuracyValue');
        const confidenceValue = document.getElementById('confidenceValue');
        const accuracyFill = document.getElementById('accuracyFill');
        const confidenceFill = document.getElementById('confidenceFill');
        const hitsStat = document.getElementById('hitsStat');
        const bestStat = document.getElementById('bestStat');
        const lengthStat = document.getElementById('lengthStat');
        const tipText = document.getElementById('tipText');
        const effectText = document.getElementById('effectText');

        const state = {
            drawing: false,
            points: [],
            currentMission: commands[0],
            streak: 0,
            bestStreak: 0,
            hits: 0
        };

        function resizeCanvas() {
            const ratio = window.devicePixelRatio || 1;
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width * ratio;
            canvas.height = rect.height * ratio;
            ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
            drawGrid();
            if (state.points.length > 0) {
                drawTrace(state.points, true);
            }
        }

        function drawGrid() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const width = canvas.getBoundingClientRect().width;
            const height = canvas.getBoundingClientRect().height;

            ctx.save();
            ctx.strokeStyle = 'rgba(140, 233, 255, 0.08)';
            ctx.lineWidth = 1;
            for (let x = 24; x < width; x += 24) {
                ctx.beginPath();
                ctx.moveTo(x, 0);
                ctx.lineTo(x, height);
                ctx.stroke();
            }
            for (let y = 24; y < height; y += 24) {
                ctx.beginPath();
                ctx.moveTo(0, y);
                ctx.lineTo(width, y);
                ctx.stroke();
            }
            ctx.restore();
        }

        function drawTrace(points, finalPass = false) {
            drawGrid();
            if (points.length < 2) {
                if (points[0]) {
                    ctx.save();
                    ctx.fillStyle = 'rgba(255, 180, 77, 0.9)';
                    ctx.beginPath();
                    ctx.arc(points[0].x, points[0].y, 5, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }
                return;
            }

            ctx.save();
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.lineWidth = finalPass ? 6 : 5;
            ctx.strokeStyle = finalPass ? 'rgba(255, 180, 77, 0.98)' : 'rgba(140, 233, 255, 0.95)';
            ctx.shadowColor = finalPass ? 'rgba(255, 180, 77, 0.45)' : 'rgba(140, 233, 255, 0.28)';
            ctx.shadowBlur = 20;
            ctx.beginPath();
            ctx.moveTo(points[0].x, points[0].y);
            for (let i = 1; i < points.length; i += 1) {
                ctx.lineTo(points[i].x, points[i].y);
            }
            ctx.stroke();
            ctx.restore();

            const last = points[points.length - 1];
            ctx.save();
            ctx.fillStyle = 'rgba(255, 180, 77, 0.95)';
            ctx.beginPath();
            ctx.arc(last.x, last.y, 6, 0, Math.PI * 2);
            ctx.fill();
            ctx.restore();
        }

        function getPoint(event) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: event.clientX - rect.left,
                y: event.clientY - rect.top
            };
        }

        function beginDraw(event) {
            state.drawing = true;
            state.points = [getPoint(event)];
            drawTrace(state.points);
            statusPill.textContent = 'Tracing';
            pathLabel.textContent = '...';
            commandLabel.textContent = 'Listening';
            lengthStat.textContent = '1 pt';
            canvas.setPointerCapture(event.pointerId);
        }

        function moveDraw(event) {
            if (!state.drawing) {
                return;
            }
            const point = getPoint(event);
            const last = state.points[state.points.length - 1];
            const distance = Math.hypot(point.x - last.x, point.y - last.y);
            if (distance < 5) {
                return;
            }
            state.points.push(point);
            drawTrace(state.points);
            lengthStat.textContent = `${state.points.length} pts`;
        }

        function endDraw(event) {
            if (!state.drawing) {
                return;
            }
            state.drawing = false;
            canvas.releasePointerCapture(event.pointerId);
            drawTrace(state.points, true);
            analyzeGesture();
        }

        function simplifyDirections(points) {
            if (points.length < 2) {
                return '';
            }

            const dirs = [];
            for (let i = 1; i < points.length; i += 1) {
                const dx = points[i].x - points[i - 1].x;
                const dy = points[i].y - points[i - 1].y;
                const distance = Math.hypot(dx, dy);
                if (distance < 12) {
                    continue;
                }
                if (Math.abs(dx) > Math.abs(dy) * 1.35) {
                    dirs.push(dx > 0 ? 'R' : 'L');
                } else if (Math.abs(dy) > Math.abs(dx) * 1.35) {
                    dirs.push(dy > 0 ? 'D' : 'U');
                } else {
                    dirs.push(dx > 0 ? (dy > 0 ? 'DR' : 'UR') : (dy > 0 ? 'DL' : 'UL'));
                }
            }

            const collapsed = [];
            for (const dir of dirs) {
                if (collapsed[collapsed.length - 1] !== dir) {
                    collapsed.push(dir);
                }
            }

            return collapsed
                .map((dir) => {
                    if (dir === 'DR' || dir === 'UR') {
                        return 'R';
                    }
                    if (dir === 'DL' || dir === 'UL') {
                        return 'L';
                    }
                    return dir;
                })
                .filter((dir, index, arr) => dir !== arr[index - 1])
                .join('');
        }

        function scoreGesture(pattern, missionPattern) {
            if (!pattern) {
                return 0;
            }
            if (pattern === missionPattern) {
                return 100;
            }

            let matches = 0;
            const length = Math.max(pattern.length, missionPattern.length);
            for (let i = 0; i < Math.min(pattern.length, missionPattern.length); i += 1) {
                if (pattern[i] === missionPattern[i]) {
                    matches += 1;
                }
            }
            return Math.max(18, Math.round((matches / length) * 100) - Math.abs(pattern.length - missionPattern.length) * 18);
        }

        function setMeters(accuracy, confidence) {
            accuracyValue.textContent = `${accuracy}%`;
            confidenceValue.textContent = `${confidence}%`;
            accuracyFill.style.width = `${accuracy}%`;
            confidenceFill.style.width = `${confidence}%`;
        }

        function highlightCommand(commandId) {
            document.querySelectorAll('.command-card').forEach((card) => {
                card.classList.toggle('active', card.dataset.commandId === commandId);
            });
        }

        function nextMission() {
            const candidates = missionPool.filter((command) => command.id !== state.currentMission.id);
            state.currentMission = candidates[Math.floor(Math.random() * candidates.length)];
            missionTitle.textContent = `Mission: ${state.currentMission.title}`;
            missionCopy.textContent = state.currentMission.prompt;
        }

        function analyzeGesture() {
            const pattern = simplifyDirections(state.points);
            const match = commandMap.get(pattern);
            const accuracy = scoreGesture(pattern, state.currentMission.pattern);
            const confidence = Math.min(100, Math.max(16, Math.round((state.points.length / 18) * 100)));
            const flow = pattern ? Math.max(12, Math.round((accuracy * 0.55) + (confidence * 0.45))) : 0;

            pathLabel.textContent = pattern || 'Too tiny to decode';
            commandLabel.textContent = match ? `${match.title} (${match.label})` : 'Unknown flourish';
            flowLabel.textContent = String(flow);
            lengthStat.textContent = `${state.points.length} pts`;
            setMeters(accuracy, confidence);

            if (match) {
                highlightCommand(match.id);
                effectText.textContent = match.flavor;
            } else {
                highlightCommand('');
                effectText.textContent = 'No command matched, but the trace still looked stylish.';
            }

            if (match && match.id === state.currentMission.id) {
                state.streak += 1;
                state.hits += 1;
                state.bestStreak = Math.max(state.bestStreak, state.streak);
                statusPill.textContent = 'Mission cleared';
                tipText.textContent = 'That one landed cleanly. You looked annoyingly competent.';
                nextMission();
            } else if (match) {
                state.streak = 0;
                statusPill.textContent = 'Command found';
                tipText.textContent = `You unlocked ${match.title}, but the current mission still wants ${state.currentMission.title}.`;
            } else {
                state.streak = 0;
                statusPill.textContent = 'Try again';
                tipText.textContent = 'Use fewer direction changes. The dojo prefers bold strokes over decorative fidgeting.';
            }

            comboPill.textContent = `Streak ${state.streak}`;
            hitsStat.textContent = String(state.hits);
            bestStat.textContent = String(state.bestStreak);
        }

        function clearCanvas() {
            state.points = [];
            drawGrid();
            pathLabel.textContent = 'Waiting for your move';
            commandLabel.textContent = 'None yet';
            flowLabel.textContent = '0';
            lengthStat.textContent = '0 pts';
            statusPill.textContent = 'Ready';
            setMeters(0, 0);
            highlightCommand('');
            effectText.textContent = 'When you match a command, the card lights up and the challenge board rotates to a new browser trick.';
            tipText.textContent = 'The dojo likes gestures with 1 to 3 clear turns. Fast, smooth, and a little swagger goes a long way.';
        }

        function animateDemo() {
            const demo = [
                { x: 90, y: 240 },
                { x: 160, y: 210 },
                { x: 230, y: 175 },
                { x: 305, y: 138 }
            ];
            clearCanvas();
            let index = 0;
            state.points = [];
            statusPill.textContent = 'Demo trace';

            function step() {
                if (index >= demo.length) {
                    drawTrace(state.points, true);
                    analyzeGesture();
                    return;
                }
                state.points.push(demo[index]);
                drawTrace(state.points);
                index += 1;
                window.setTimeout(step, 110);
            }

            step();
        }

        function renderLibrary() {
            library.innerHTML = commands.map((command) => `
                <button class="command-card" type="button" data-command-id="${command.id}" data-pattern="${command.pattern}">
                    <span class="tiny-tag">${command.pattern}</span>
                    <h3>${command.title}</h3>
                    <p>${command.label}. ${command.flavor}</p>
                    <div class="path-strip">${command.prompt}</div>
                </button>
            `).join('');

            library.querySelectorAll('.command-card').forEach((card) => {
                card.addEventListener('click', () => {
                    const command = commands.find((entry) => entry.id === card.dataset.commandId);
                    if (!command) {
                        return;
                    }
                    state.currentMission = command;
                    missionTitle.textContent = `Mission: ${command.title}`;
                    missionCopy.textContent = command.prompt;
                    highlightCommand(command.id);
                    statusPill.textContent = 'Mission selected';
                    effectText.textContent = command.flavor;
                });
            });
        }

        canvas.addEventListener('pointerdown', beginDraw);
        canvas.addEventListener('pointermove', moveDraw);
        canvas.addEventListener('pointerup', endDraw);
        canvas.addEventListener('pointercancel', endDraw);

        document.getElementById('clearButton').addEventListener('click', clearCanvas);
        document.getElementById('demoButton').addEventListener('click', animateDemo);
        document.getElementById('shuffleButton').addEventListener('click', () => {
            nextMission();
            clearCanvas();
            statusPill.textContent = 'Fresh mission';
        });

        window.addEventListener('resize', resizeCanvas);

        renderLibrary();
        resizeCanvas();
        nextMission();
        clearCanvas();
    </script>
</body>
</html>
