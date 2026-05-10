<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web App Blueprint Arcade</title>
    <style>
        :root {
            --bg: #08111f;
            --bg-2: #0e1a2f;
            --panel: rgba(12, 24, 44, 0.82);
            --panel-strong: rgba(10, 18, 34, 0.95);
            --line: rgba(122, 228, 255, 0.26);
            --cyan: #8ce8ff;
            --cyan-strong: #42d7ff;
            --amber: #ffc76b;
            --amber-strong: #ff9e57;
            --peach: #ffcfb9;
            --ink: #eaf4ff;
            --muted: #95aaca;
            --success: #8cffc5;
            --shadow: 0 28px 70px rgba(0, 0, 0, 0.45);
            --radius-xl: 30px;
            --radius-lg: 22px;
            --radius-md: 16px;
            --noise: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.07) 0 1px, transparent 1px 100%);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Gill Sans", "Avenir Next", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(66, 215, 255, 0.16), transparent 32%),
                radial-gradient(circle at 85% 12%, rgba(255, 199, 107, 0.18), transparent 24%),
                linear-gradient(180deg, #0a1425 0%, #07101d 42%, #040812 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(140, 232, 255, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(140, 232, 255, 0.06) 1px, transparent 1px),
                radial-gradient(circle at center, rgba(255,255,255,0.03), transparent 60%);
            background-size: 28px 28px, 28px 28px, 100% 100%;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.9), rgba(0,0,0,0.55));
            pointer-events: none;
        }

        .shell {
            width: min(1180px, calc(100% - 24px));
            margin: 0 auto;
            padding: 24px 0 48px;
            position: relative;
        }

        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(10, 20, 37, 0.92), rgba(13, 30, 50, 0.9));
            border: 1px solid rgba(140, 232, 255, 0.18);
            border-radius: 34px;
            box-shadow: var(--shadow);
            padding: 28px 22px 24px;
            margin-bottom: 18px;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 18%, rgba(255, 199, 107, 0.16), transparent 24%),
                radial-gradient(circle at 85% 25%, rgba(66, 215, 255, 0.14), transparent 30%);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--cyan);
            letter-spacing: 0.14em;
            text-transform: uppercase;
            font-size: 0.72rem;
            margin-bottom: 14px;
        }

        .hero h1 {
            margin: 0;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: clamp(2.4rem, 7vw, 4.8rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            max-width: 10ch;
            text-wrap: balance;
        }

        .hero p {
            max-width: 62ch;
            color: var(--peach);
            line-height: 1.65;
            font-size: 1rem;
            margin: 16px 0 0;
            position: relative;
            z-index: 1;
        }

        .hero-grid {
            display: grid;
            gap: 18px;
            align-items: end;
        }

        .lights {
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .light-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            padding: 14px;
            backdrop-filter: blur(8px);
        }

        .light-label {
            color: var(--muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 10px;
        }

        .light-value {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .board {
            display: grid;
            gap: 18px;
            grid-template-columns: 1.15fr 0.95fr;
        }

        .panel {
            background: var(--panel);
            border: 1px solid rgba(140, 232, 255, 0.16);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .controls {
            padding: 18px;
        }

        .section {
            padding: 16px;
            margin-bottom: 14px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.07);
            background: linear-gradient(180deg, rgba(255,255,255,0.035), rgba(255,255,255,0.015));
        }

        .section:last-child { margin-bottom: 0; }

        .section-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: start;
            margin-bottom: 12px;
        }

        .section h2 {
            margin: 0;
            font-size: 1.12rem;
        }

        .section p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .choice-grid,
        .feature-grid,
        .screens-grid {
            display: grid;
            gap: 10px;
        }

        .choice-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .feature-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .screens-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .card-button,
        .feature-chip,
        .action {
            appearance: none;
            border: 0;
            cursor: pointer;
            text-align: left;
            color: inherit;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .card-button {
            width: 100%;
            min-height: 112px;
            padding: 14px;
            border-radius: 20px;
            background: rgba(6, 12, 25, 0.62);
            border: 1px solid rgba(255,255,255,0.09);
            position: relative;
            overflow: hidden;
        }

        .card-button::after {
            content: "";
            position: absolute;
            inset: auto -18% -48% auto;
            width: 120px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,255,255,0.18), transparent 62%);
            opacity: 0;
            transition: opacity 180ms ease;
        }

        .card-button:hover,
        .feature-chip:hover,
        .action:hover {
            transform: translateY(-2px);
        }

        .card-button.selected,
        .feature-chip.selected {
            border-color: rgba(255, 199, 107, 0.65);
            box-shadow: 0 0 0 1px rgba(255, 199, 107, 0.32), inset 0 0 0 1px rgba(255,255,255,0.03);
            background: linear-gradient(180deg, rgba(255, 199, 107, 0.14), rgba(66, 215, 255, 0.08));
        }

        .card-button.selected::after { opacity: 1; }

        .button-kicker {
            display: inline-block;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            margin-bottom: 12px;
            background: rgba(255,255,255,0.07);
            color: var(--cyan);
        }

        .button-title {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .button-copy {
            display: block;
            color: var(--muted);
            line-height: 1.45;
            font-size: 0.9rem;
        }

        .feature-chip {
            min-height: 86px;
            padding: 12px;
            border-radius: 18px;
            background: rgba(6, 12, 25, 0.56);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .feature-chip strong {
            display: block;
            margin-bottom: 6px;
            font-size: 0.95rem;
        }

        .feature-chip span {
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.4;
        }

        .status-row {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 12px;
        }

        .meter {
            background: rgba(255,255,255,0.04);
            border-radius: 16px;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .meter-label {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.7rem;
            margin-bottom: 10px;
        }

        .meter-track {
            width: 100%;
            height: 9px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            overflow: hidden;
            margin-bottom: 10px;
        }

        .meter-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--cyan-strong), var(--amber));
            width: 50%;
            transition: width 220ms ease;
        }

        .meter-value {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .action {
            padding: 12px 16px;
            border-radius: 999px;
            font-weight: 700;
        }

        .action.primary {
            background: linear-gradient(135deg, var(--amber), var(--amber-strong));
            color: #2a1206;
        }

        .action.secondary {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--ink);
        }

        .output {
            padding: 18px;
            display: grid;
            gap: 14px;
        }

        .marquee {
            display: grid;
            gap: 14px;
            padding: 16px;
            border-radius: 26px;
            border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(160deg, rgba(4, 11, 23, 0.9), rgba(14, 23, 40, 0.75));
            position: relative;
            overflow: hidden;
        }

        .marquee::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 78% 20%, rgba(255, 199, 107, 0.15), transparent 22%);
            pointer-events: none;
        }

        .marquee-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
        }

        .signal {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--success);
        }

        .signal-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: currentColor;
            box-shadow: 0 0 16px currentColor;
            animation: pulse 1.7s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.4; transform: scale(0.9); }
            50% { opacity: 1; transform: scale(1.08); }
        }

        .app-name {
            margin: 0;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 0.96;
            letter-spacing: -0.04em;
            text-wrap: balance;
        }

        .tagline {
            color: var(--peach);
            font-size: 1rem;
            line-height: 1.5;
            margin: 0;
        }

        .pill-row,
        .wire-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pill {
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.09);
            color: var(--cyan);
            font-size: 0.82rem;
        }

        .blueprint {
            position: relative;
            min-height: 280px;
            padding: 18px;
            border-radius: 26px;
            background:
                linear-gradient(rgba(140, 232, 255, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(140, 232, 255, 0.08) 1px, transparent 1px),
                linear-gradient(180deg, rgba(7, 14, 24, 0.94), rgba(5, 10, 18, 0.98));
            background-size: 24px 24px, 24px 24px, 100% 100%;
            overflow: hidden;
        }

        .blueprint svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .node {
            position: absolute;
            width: 126px;
            min-height: 86px;
            padding: 12px;
            border-radius: 18px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.11);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.02), 0 14px 30px rgba(0,0,0,0.22);
        }

        .node strong {
            display: block;
            font-size: 0.94rem;
            margin-bottom: 6px;
        }

        .node span {
            color: var(--muted);
            font-size: 0.8rem;
            line-height: 1.35;
        }

        .node.core {
            background: linear-gradient(180deg, rgba(255, 199, 107, 0.18), rgba(255, 255, 255, 0.05));
            border-color: rgba(255, 199, 107, 0.45);
        }

        .summary-card,
        .screen-card,
        .prompt-card {
            padding: 16px;
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
        }

        .summary-card h3,
        .screen-card h3,
        .prompt-card h3 {
            margin: 0 0 10px;
            font-size: 1rem;
        }

        .summary-card p,
        .screen-card p,
        .prompt-card p,
        .prompt-card li {
            color: var(--peach);
            line-height: 1.55;
            font-size: 0.92rem;
            margin: 0;
        }

        .screen-card small {
            display: block;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 8px;
            font-size: 0.68rem;
        }

        .screen-card .badge {
            display: inline-flex;
            margin-top: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(140, 232, 255, 0.1);
            color: var(--cyan);
            font-size: 0.76rem;
        }

        .prompt-card ul {
            margin: 0;
            padding-left: 18px;
        }

        .footer-note {
            color: var(--muted);
            font-size: 0.84rem;
            text-align: center;
            margin-top: 16px;
        }

        @media (max-width: 980px) {
            .board { grid-template-columns: 1fr; }
        }

        @media (max-width: 720px) {
            .shell { width: min(100% - 14px, 100%); padding-top: 14px; }
            .hero { padding: 20px 16px 18px; border-radius: 28px; }
            .controls, .output { padding: 14px; }
            .section { padding: 14px; border-radius: 20px; }
            .choice-grid, .feature-grid, .screens-grid, .status-row, .lights { grid-template-columns: 1fr; }
            .marquee-top { align-items: start; flex-direction: column; }
            .node { width: 112px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Blueprint mode engaged</div>
                    <h1>Web App Blueprint Arcade</h1>
                    <p>A playful drafting table for the very old and very noble pastime of building web apps. Pick a user, choose a core loop, bolt on a few features, and watch a whole little product pitch materialize with suspicious confidence.</p>
                </div>
            </div>
            <div class="lights">
                <div class="light-card">
                    <div class="light-label">Inspired by</div>
                    <div class="light-value">Jon bookmarking “Building a Web Application” back in 2004</div>
                </div>
                <div class="light-card">
                    <div class="light-label">Aesthetic</div>
                    <div class="light-value">Midnight blueprint table with arcade glows and brass dials</div>
                </div>
                <div class="light-card">
                    <div class="light-label">Objective</div>
                    <div class="light-value">Find the sweet spot between useful, delightful, and not wildly overbuilt</div>
                </div>
            </div>
        </section>

        <main class="board">
            <section class="panel controls">
                <div class="section">
                    <div class="section-head">
                        <div>
                            <h2>1. Pick the people</h2>
                            <p>Who is this charming contraption actually for?</p>
                        </div>
                    </div>
                    <div class="choice-grid" id="audienceGrid"></div>
                </div>

                <div class="section">
                    <div class="section-head">
                        <div>
                            <h2>2. Choose the heart</h2>
                            <p>The one interaction that makes the app worth opening again.</p>
                        </div>
                    </div>
                    <div class="choice-grid" id="coreGrid"></div>
                </div>

                <div class="section">
                    <div class="section-head">
                        <div>
                            <h2>3. Bolt on three powers</h2>
                            <p>Just three. We are exercising restraint, a rare and beautiful virtue.</p>
                        </div>
                        <div class="button-kicker"><span id="featureCounter">0</span>/3 chosen</div>
                    </div>
                    <div class="feature-grid" id="featureGrid"></div>
                    <div class="status-row">
                        <div class="meter">
                            <div class="meter-label">Delight</div>
                            <div class="meter-track"><div class="meter-fill" id="delightFill"></div></div>
                            <div class="meter-value" id="delightValue">50</div>
                        </div>
                        <div class="meter">
                            <div class="meter-label">Complexity</div>
                            <div class="meter-track"><div class="meter-fill" id="complexityFill"></div></div>
                            <div class="meter-value" id="complexityValue">50</div>
                        </div>
                        <div class="meter">
                            <div class="meter-label">Coziness</div>
                            <div class="meter-track"><div class="meter-fill" id="cozinessFill"></div></div>
                            <div class="meter-value" id="cozinessValue">50</div>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="action primary" id="randomizeButton" type="button">Spin a weirdly plausible brief</button>
                        <button class="action secondary" id="resetButton" type="button">Start over</button>
                    </div>
                </div>
            </section>

            <section class="panel output">
                <div class="marquee">
                    <div class="marquee-top">
                        <div class="signal"><span class="signal-dot"></span>Scope engine nominal</div>
                        <div class="button-kicker" id="shipWindow">Saturday-sized build</div>
                    </div>
                    <h2 class="app-name" id="appName">Pocket Lantern Atlas</h2>
                    <p class="tagline" id="tagline">A small, bright app for people who want one lovely thing to do well without summoning a committee.</p>
                    <div class="pill-row" id="pillRow"></div>
                </div>

                <div class="blueprint" id="blueprint">
                    <svg viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                        <path id="wireA" d="M 18 30 C 30 28, 40 32, 50 40" stroke="rgba(140,232,255,0.65)" stroke-width="0.7" fill="none" stroke-dasharray="2 2"></path>
                        <path id="wireB" d="M 50 40 C 58 48, 66 52, 78 58" stroke="rgba(255,199,107,0.6)" stroke-width="0.7" fill="none" stroke-dasharray="2 2"></path>
                        <path id="wireC" d="M 50 40 C 54 28, 66 22, 80 22" stroke="rgba(140,232,255,0.55)" stroke-width="0.7" fill="none" stroke-dasharray="2 2"></path>
                        <path id="wireD" d="M 24 72 C 34 64, 42 54, 50 40" stroke="rgba(255,199,107,0.56)" stroke-width="0.7" fill="none" stroke-dasharray="2 2"></path>
                    </svg>
                    <div class="node" id="nodeAudience" style="left: 6%; top: 12%;">
                        <strong>Audience</strong>
                        <span>Curious people with exactly one noble little mission.</span>
                    </div>
                    <div class="node core" id="nodeCore" style="left: 34%; top: 34%;">
                        <strong>Core loop</strong>
                        <span>Tap, discover, grin, repeat.</span>
                    </div>
                    <div class="node" id="nodeFeatureA" style="right: 7%; top: 11%;">
                        <strong>Feature A</strong>
                        <span>A tiny spark of delight.</span>
                    </div>
                    <div class="node" id="nodeFeatureB" style="right: 10%; bottom: 13%;">
                        <strong>Feature B</strong>
                        <span>One practical power tool.</span>
                    </div>
                    <div class="node" id="nodeFeatureC" style="left: 10%; bottom: 12%;">
                        <strong>Feature C</strong>
                        <span>A warm finishing touch.</span>
                    </div>
                </div>

                <div class="summary-card">
                    <h3>Build recipe</h3>
                    <p id="summaryText">Choose an audience, a core loop, and three features to generate a build recipe with a voice, a value proposition, and a clean starting scope.</p>
                </div>

                <div class="screens-grid" id="screensGrid"></div>

                <div class="prompt-card">
                    <h3>First three implementation moves</h3>
                    <ul id="todoList"></ul>
                </div>
            </section>
        </main>

        <p class="footer-note">Single-file, self-contained, and a little bit smug about it.</p>
    </div>

    <script>
        const audiences = [
            {
                id: 'maker',
                kicker: 'Solo builder',
                title: 'A careful tinkerer',
                copy: 'Someone who loves tools that feel hand-made, focused, and just useful enough.',
                pill: 'maker-first',
                tone: 'quietly clever',
                appetite: 'a personal workshop',
                summary: 'Build for one thoughtful person at a time, with friction kept low and personality kept high.'
            },
            {
                id: 'family',
                kicker: 'Living room',
                title: 'A family table',
                copy: 'Parents and kids poking the same little app together, preferably without anyone needing a manual.',
                pill: 'family-friendly',
                tone: 'warm and playful',
                appetite: 'shared delight',
                summary: 'Make it readable, tap-friendly, and fun enough for a child to explore beside an adult.'
            },
            {
                id: 'parish',
                kicker: 'Small group',
                title: 'A parish crew',
                copy: 'People using the app together for reflection, learning, or low-drama logistics.',
                pill: 'community-minded',
                tone: 'clear and encouraging',
                appetite: 'gentle structure',
                summary: 'Keep the interface welcoming and the language calm, so it feels like hospitality rather than software.'
            },
            {
                id: 'curious',
                kicker: 'Rabbit hole',
                title: 'Curious explorers',
                copy: 'People who enjoy pressing shiny buttons just to see what happens. Respectfully, this includes engineers.',
                pill: 'curiosity engine',
                tone: 'bright and exploratory',
                appetite: 'surprising discovery',
                summary: 'Reward experimentation with reveals, little discoveries, and a sense that the system answers back.'
            }
        ];

        const cores = [
            {
                id: 'catalog',
                kicker: 'Collect',
                title: 'Build a tiny catalog',
                copy: 'Browse, save, sort, compare. A museum drawer with better manners.',
                pill: 'collection loop',
                delight: 15,
                complexity: 12,
                coziness: 12,
                noun: 'catalog',
                summary: 'Center the experience on browsing beautiful little units and making thoughtful comparisons.'
            },
            {
                id: 'quiz',
                kicker: 'Test',
                title: 'Run a sharp little quiz',
                copy: 'Ask a question, reveal a pattern, celebrate a streak. Human brains love this nonsense.',
                pill: 'quiz loop',
                delight: 20,
                complexity: 15,
                coziness: 8,
                noun: 'quiz',
                summary: 'Give each interaction a clear prompt and a satisfying reveal, with pace that keeps momentum up.'
            },
            {
                id: 'simulator',
                kicker: 'Play',
                title: 'Simulate a system',
                copy: 'Tweak dials, watch consequences, learn by making cheerful little messes.',
                pill: 'simulation loop',
                delight: 24,
                complexity: 24,
                coziness: 6,
                noun: 'simulator',
                summary: 'Turn cause and effect into the entertainment, with live feedback that makes the system feel tangible.'
            },
            {
                id: 'generator',
                kicker: 'Invent',
                title: 'Generate fresh ideas',
                copy: 'Push a button and get a plausible little gem, then refine it until it starts to feel inevitable.',
                pill: 'generator loop',
                delight: 18,
                complexity: 14,
                coziness: 10,
                noun: 'generator',
                summary: 'Keep the spark instant, then make refinement feel like craft rather than admin.'
            }
        ];

        const features = [
            {
                id: 'streaks',
                title: 'Streak sparks',
                copy: 'Tiny progress bursts and “come back tomorrow” energy.',
                pill: 'streaks',
                delight: 15,
                complexity: 10,
                coziness: 8,
                node: 'Progress glow',
                nodeCopy: 'Returns feel rewarding, not naggy.',
                screen: 'Momentum Panel',
                screenCopy: 'A calm dashboard showing streaks, best runs, and one inviting next step.',
                todo: 'Sketch a progress model that rewards return visits without becoming a guilt machine.'
            },
            {
                id: 'sound',
                title: 'Little sound cues',
                copy: 'A tasteful click, chime, or sweep when something delightful happens.',
                pill: 'sound cues',
                delight: 18,
                complexity: 8,
                coziness: 9,
                node: 'Audio charm',
                nodeCopy: 'Subtle feedback with arcade manners.',
                screen: 'Feedback Tuner',
                screenCopy: 'A settings corner where interactions get a bit of personality instead of dead silence.',
                todo: 'Add lightweight audio hooks or visual echoes so the app feels alive, not upholstered in beige.'
            },
            {
                id: 'journal',
                title: 'Reflection notes',
                copy: 'Save discoveries, favourites, or private thoughts as you go.',
                pill: 'notes',
                delight: 10,
                complexity: 14,
                coziness: 18,
                node: 'Notebook layer',
                nodeCopy: 'Users leave with something of their own.',
                screen: 'Notebook Drawer',
                screenCopy: 'A quiet place for saved highlights, personal notes, and little breadcrumbs back in.',
                todo: 'Design a pocket notebook view so the app can store personal meaning, not just transient clicks.'
            },
            {
                id: 'shuffle',
                title: 'Surprise button',
                copy: 'One tap for a fresh prompt, layout, question, or challenge.',
                pill: 'surprise mode',
                delight: 22,
                complexity: 10,
                coziness: 6,
                node: 'Chaos lever',
                nodeCopy: 'The fun comes back with one shameless button.',
                screen: 'Fresh Prompt Wheel',
                screenCopy: 'A bright restart moment that keeps the app from going stale after three visits.',
                todo: 'Create a randomization routine that generates novelty while keeping the results coherent.'
            },
            {
                id: 'compare',
                title: 'Compare mode',
                copy: 'Put two ideas side by side and let the contrasts do the teaching.',
                pill: 'comparison',
                delight: 12,
                complexity: 18,
                coziness: 8,
                node: 'Split view',
                nodeCopy: 'Clarity through contrast.',
                screen: 'A/B Bench',
                screenCopy: 'A side-by-side inspection screen with quick visual distinctions and a verdict nudge.',
                todo: 'Choose the two or three comparison dimensions that actually matter, then make them instantly legible.'
            },
            {
                id: 'story',
                title: 'Story framing',
                copy: 'Wrap the experience in a narrative voice or mini-world.',
                pill: 'narrative layer',
                delight: 16,
                complexity: 12,
                coziness: 20,
                node: 'Story shell',
                nodeCopy: 'The interface feels like a place, not a form.',
                screen: 'Scene Setter',
                screenCopy: 'An opening screen that gives the app mood, stakes, and just enough theatrical flourish.',
                todo: 'Write the framing copy first so the interface can borrow confidence from its own little universe.'
            },
            {
                id: 'badges',
                title: 'Collectible badges',
                copy: 'Small trophies for exploring corners or trying unusual combinations.',
                pill: 'badges',
                delight: 17,
                complexity: 11,
                coziness: 7,
                node: 'Badge cabinet',
                nodeCopy: 'Exploration gets a memento.',
                screen: 'Trophy Shelf',
                screenCopy: 'A bright display of what you discovered, completed, or stubbornly poked until it yielded.',
                todo: 'Invent a badge taxonomy that nudges exploration instead of turning into a second full-time job.'
            },
            {
                id: 'share',
                title: 'Shareable snapshot',
                copy: 'Turn the final state into a cute card someone might actually send.',
                pill: 'share card',
                delight: 14,
                complexity: 16,
                coziness: 10,
                node: 'Snapshot export',
                nodeCopy: 'Results become portable.',
                screen: 'Victory Card',
                screenCopy: 'A polished end-state card that looks delightful in a screenshot instead of vaguely apologetic.',
                todo: 'Design a final card worth sharing, with clear hierarchy and zero “generated by committee” energy.'
            }
        ];

        const prefixes = ['Pocket', 'Brass', 'Velvet', 'Midnight', 'Signal', 'Lantern', 'Nimbus', 'Quiet', 'Copper', 'Paper'];
        const middles = ['Atlas', 'Arcade', 'Workbench', 'Console', 'Compass', 'Cabinet', 'Studio', 'Signal', 'Workshop', 'Relay'];
        const suffixes = ['for Small Wonders', 'for Curious Evenings', 'for Tiny Projects', 'for Shared Adventures', 'for Gentle Obsessions', 'for Bright Experiments'];

        let selectedAudience = audiences[1].id;
        let selectedCore = cores[3].id;
        let selectedFeatures = ['story', 'shuffle', 'journal'];

        const audienceGrid = document.getElementById('audienceGrid');
        const coreGrid = document.getElementById('coreGrid');
        const featureGrid = document.getElementById('featureGrid');
        const screensGrid = document.getElementById('screensGrid');

        function renderChoices() {
            audienceGrid.innerHTML = audiences.map(item => `
                <button type="button" class="card-button ${item.id === selectedAudience ? 'selected' : ''}" data-type="audience" data-id="${item.id}">
                    <span class="button-kicker">${item.kicker}</span>
                    <span class="button-title">${item.title}</span>
                    <span class="button-copy">${item.copy}</span>
                </button>
            `).join('');

            coreGrid.innerHTML = cores.map(item => `
                <button type="button" class="card-button ${item.id === selectedCore ? 'selected' : ''}" data-type="core" data-id="${item.id}">
                    <span class="button-kicker">${item.kicker}</span>
                    <span class="button-title">${item.title}</span>
                    <span class="button-copy">${item.copy}</span>
                </button>
            `).join('');

            featureGrid.innerHTML = features.map(item => `
                <button type="button" class="feature-chip ${selectedFeatures.includes(item.id) ? 'selected' : ''}" data-type="feature" data-id="${item.id}">
                    <strong>${item.title}</strong>
                    <span>${item.copy}</span>
                </button>
            `).join('');
        }

        function sampleName(audience, core, featureSet) {
            const a = audience.title.split(' ')[0];
            const c = core.title.split(' ')[0];
            const f = featureSet[0]?.title.split(' ')[0] || 'Spark';
            const options = [
                `${prefixes[(a.length + c.length) % prefixes.length]} ${middles[(f.length + c.length) % middles.length]}`,
                `${prefixes[(f.length + audience.id.length) % prefixes.length]} ${a} ${middles[(core.id.length) % middles.length]}`,
                `${prefixes[(featureSet.length + c.length) % prefixes.length]} ${c} ${middles[(a.length + f.length) % middles.length]}`
            ];
            return options[(featureSet.length + audience.id.length + core.id.length) % options.length];
        }

        function clamp(n) {
            return Math.max(12, Math.min(96, Math.round(n)));
        }

        function updateOutput() {
            const audience = audiences.find(item => item.id === selectedAudience);
            const core = cores.find(item => item.id === selectedCore);
            const featureSet = features.filter(item => selectedFeatures.includes(item.id));

            const delight = clamp(32 + core.delight + featureSet.reduce((sum, item) => sum + item.delight, 0) / 2.5);
            const complexity = clamp(22 + core.complexity + featureSet.reduce((sum, item) => sum + item.complexity, 0) / 2.8);
            const coziness = clamp(26 + core.coziness + featureSet.reduce((sum, item) => sum + item.coziness, 0) / 2.7);

            const name = sampleName(audience, core, featureSet);
            const suffix = suffixes[(audience.id.length + core.id.length + featureSet.length) % suffixes.length];
            const featureTitles = featureSet.map(item => item.title.toLowerCase());
            const featurePhrase = featureTitles.length
                ? `${featureTitles.slice(0, -1).join(', ')}${featureTitles.length > 1 ? ', and ' : ''}${featureTitles.slice(-1)}`
                : 'one beautifully chosen mechanic';
            const tagline = `A ${audience.tone} ${core.noun} for ${audience.appetite}, powered by ${featurePhrase}.`;

            document.getElementById('appName').textContent = `${name} ${suffix}`;
            document.getElementById('tagline').textContent = tagline;
            document.getElementById('featureCounter').textContent = selectedFeatures.length;

            setMeter('delight', delight);
            setMeter('complexity', complexity);
            setMeter('coziness', coziness);

            document.getElementById('shipWindow').textContent = complexity > 72 ? 'Ambitious weekender' : complexity > 54 ? 'Saturday-sized build' : 'One crisp evening build';

            document.getElementById('pillRow').innerHTML = [audience.pill, core.pill, ...featureSet.map(item => item.pill)].map(label => `<span class="pill">${label}</span>`).join('');

            document.getElementById('summaryText').textContent = `${audience.summary} ${core.summary} Then add ${featureSet.length ? featureSet.map(item => item.title.toLowerCase()).join(', ') : 'a tiny polish pass'} so the final experience feels ${audience.tone} rather than merely functional.`;

            updateNode('nodeAudience', 'Audience', audience.title, audience.copy);
            updateNode('nodeCore', 'Core loop', core.title, core.copy);
            const fallbacks = [
                { node: 'Signal spark', nodeCopy: 'One delightful response loop.' },
                { node: 'Useful layer', nodeCopy: 'One practical reason to return.' },
                { node: 'Warm finish', nodeCopy: 'One human detail that lingers.' }
            ];
            ['nodeFeatureA', 'nodeFeatureB', 'nodeFeatureC'].forEach((id, index) => {
                const feature = featureSet[index];
                const fallback = fallbacks[index];
                updateNode(id, feature ? feature.node : fallback.node, feature ? feature.title : 'Open slot', feature ? feature.nodeCopy : fallback.nodeCopy);
            });

            screensGrid.innerHTML = buildScreens(audience, core, featureSet).map((screen, index) => `
                <article class="screen-card">
                    <small>Screen ${index + 1}</small>
                    <h3>${screen.title}</h3>
                    <p>${screen.copy}</p>
                    <span class="badge">${screen.badge}</span>
                </article>
            `).join('');

            document.getElementById('todoList').innerHTML = buildTodos(audience, core, featureSet).map(item => `<li>${item}</li>`).join('');
        }

        function updateNode(id, heading, title, copy) {
            const node = document.getElementById(id);
            node.innerHTML = `<strong>${heading}: ${title}</strong><span>${copy}</span>`;
        }

        function setMeter(name, value) {
            document.getElementById(`${name}Fill`).style.width = `${value}%`;
            document.getElementById(`${name}Value`).textContent = value;
        }

        function buildScreens(audience, core, featureSet) {
            const first = {
                title: `${audience.title} Welcome Deck`,
                copy: `Open with a screen that immediately tells ${audience.title.toLowerCase()} what this app helps them do and why it is a pleasant use of five minutes.`,
                badge: audience.pill
            };

            const second = {
                title: `${core.title}`,
                copy: `This is the main event: the ${core.noun} moment where the app earns its keep with clear actions, immediate feedback, and zero muddy indecision.`,
                badge: core.pill
            };

            const thirdFeature = featureSet[0] || features.find(item => item.id === 'story');
            const third = {
                title: thirdFeature.screen,
                copy: thirdFeature.screenCopy,
                badge: thirdFeature.pill
            };

            return [first, second, third];
        }

        function buildTodos(audience, core, featureSet) {
            const tasks = [
                `Lock in the tone as ${audience.tone}, then write the opening copy before touching layout.`,
                `Build the ${core.noun} loop first and make sure it feels satisfying with dummy content before adding ornament.`,
                ...(featureSet.map(item => item.todo))
            ];
            return tasks.slice(0, 3);
        }

        function randomizeBrief() {
            selectedAudience = audiences[Math.floor(Math.random() * audiences.length)].id;
            selectedCore = cores[Math.floor(Math.random() * cores.length)].id;
            const shuffled = [...features].sort(() => Math.random() - 0.5).slice(0, 3);
            selectedFeatures = shuffled.map(item => item.id);
            renderChoices();
            updateOutput();
        }

        document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-type]');
            if (!button) return;

            const { type, id } = button.dataset;
            if (type === 'audience') {
                selectedAudience = id;
            } else if (type === 'core') {
                selectedCore = id;
            } else if (type === 'feature') {
                if (selectedFeatures.includes(id)) {
                    selectedFeatures = selectedFeatures.filter(item => item !== id);
                } else if (selectedFeatures.length < 3) {
                    selectedFeatures = [...selectedFeatures, id];
                } else {
                    selectedFeatures = [...selectedFeatures.slice(1), id];
                }
            }

            renderChoices();
            updateOutput();
        });

        document.getElementById('randomizeButton').addEventListener('click', randomizeBrief);
        document.getElementById('resetButton').addEventListener('click', () => {
            selectedAudience = audiences[1].id;
            selectedCore = cores[3].id;
            selectedFeatures = ['story', 'shuffle', 'journal'];
            renderChoices();
            updateOutput();
        });

        renderChoices();
        updateOutput();
    </script>
</body>
</html>
