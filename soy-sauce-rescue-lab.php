<?php
$title = 'Soy Sauce Rescue Lab';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root {
            --bg: #120c0d;
            --bg-deep: #090506;
            --paper: #f6ead8;
            --paper-soft: rgba(246, 234, 216, 0.82);
            --ink: #251516;
            --soy: #4b2418;
            --soy-bright: #7b3d20;
            --vinegar: #d8b36a;
            --vinegar-bright: #f0d58d;
            --accent: #ff8c42;
            --jade: #78d6b0;
            --warning: #ffcd73;
            --shadow: 0 24px 70px rgba(0, 0, 0, 0.38);
            --radius: 28px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--paper);
            background:
                radial-gradient(circle at top left, rgba(255, 140, 66, 0.18), transparent 26%),
                radial-gradient(circle at 85% 16%, rgba(120, 214, 176, 0.14), transparent 22%),
                linear-gradient(145deg, #1c1113 0%, #100809 45%, #060304 100%);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.12;
            background-image:
                linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: radial-gradient(circle at center, black 45%, transparent 100%);
        }

        .page {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 64px;
            position: relative;
            z-index: 1;
        }

        .hero {
            position: relative;
            padding: 28px;
            border-radius: calc(var(--radius) + 10px);
            background:
                linear-gradient(160deg, rgba(247, 236, 215, 0.1), rgba(247, 236, 215, 0.04)),
                rgba(17, 10, 11, 0.85);
            border: 1px solid rgba(255,255,255,0.09);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 12px;
            border: 1px solid rgba(255, 220, 168, 0.12);
            border-radius: calc(var(--radius) + 2px);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255, 205, 115, 0.1);
            color: var(--warning);
            font-size: 0.82rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 28px;
            margin-top: 20px;
            align-items: center;
        }

        h1 {
            margin: 0 0 14px;
            font-size: clamp(2.7rem, 7vw, 5rem);
            line-height: 0.94;
            letter-spacing: -0.04em;
        }

        .hero p {
            margin: 0;
            color: rgba(246, 234, 216, 0.82);
            font-size: 1.04rem;
            line-height: 1.7;
            max-width: 62ch;
        }

        .hero-actions {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .button,
        button,
        select,
        input[type="range"] {
            font: inherit;
        }

        .button,
        button {
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        .button:hover,
        button:hover { transform: translateY(-1px); }

        .button.primary,
        button.primary {
            background: linear-gradient(135deg, var(--accent), #ffb45a);
            color: #28120d;
            box-shadow: 0 14px 34px rgba(255, 140, 66, 0.28);
            font-weight: 700;
            text-decoration: none;
        }

        .button.secondary,
        button.secondary {
            background: rgba(255,255,255,0.08);
            color: var(--paper);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .score-panel {
            display: grid;
            gap: 14px;
        }

        .badge-card,
        .panel,
        .mini-card {
            border-radius: var(--radius);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03)),
                rgba(20, 12, 13, 0.88);
            border: 1px solid rgba(255,255,255,0.09);
            box-shadow: var(--shadow);
        }

        .badge-card {
            padding: 20px 22px;
        }

        .badge-label {
            color: rgba(246, 234, 216, 0.64);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
        }

        .badge-value {
            margin-top: 8px;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .layout {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
            margin-top: 24px;
        }

        .panel {
            padding: 22px;
        }

        .panel h2,
        .panel h3 {
            margin: 0 0 8px;
            font-size: 1.35rem;
        }

        .panel-copy {
            margin: 0;
            color: rgba(246, 234, 216, 0.72);
            line-height: 1.6;
            font-size: 0.98rem;
        }

        .saucer-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-top: 22px;
        }

        .saucer-card {
            position: relative;
            overflow: hidden;
            padding: 18px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .saucer-label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .saucer-label {
            font-size: 1.05rem;
            font-weight: 700;
        }

        .ratio-chip {
            border-radius: 999px;
            padding: 7px 10px;
            font-size: 0.82rem;
            background: rgba(255,255,255,0.08);
            color: rgba(246, 234, 216, 0.88);
        }

        .dish {
            position: relative;
            height: 240px;
            border-radius: 30px 30px 34px 34px;
            background: radial-gradient(circle at 50% 20%, rgba(255,255,255,0.2), rgba(255,255,255,0.05) 30%, rgba(46,25,19,0.9) 74%);
            box-shadow: inset 0 10px 30px rgba(255,255,255,0.08), inset 0 -18px 28px rgba(0,0,0,0.35);
            border: 2px solid rgba(255,255,255,0.12);
            overflow: hidden;
        }

        .dish::before {
            content: "";
            position: absolute;
            inset: 10px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.08);
            pointer-events: none;
        }

        .liquid {
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 14px;
            border-radius: 0 0 24px 24px;
            overflow: hidden;
            box-shadow: inset 0 10px 18px rgba(255,255,255,0.08);
            transition: height 350ms ease;
        }

        .layer {
            width: 100%;
            transition: height 350ms ease;
        }

        .layer.vinegar {
            background: linear-gradient(180deg, var(--vinegar-bright), var(--vinegar));
        }

        .layer.soy {
            background: linear-gradient(180deg, var(--soy-bright), var(--soy));
        }

        .gloss {
            position: absolute;
            inset: 18px 38px auto 38px;
            height: 58px;
            border-radius: 999px;
            background: linear-gradient(180deg, rgba(255,255,255,0.25), rgba(255,255,255,0));
            filter: blur(3px);
            opacity: 0.75;
            pointer-events: none;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 14px;
        }

        .stat {
            padding: 12px;
            border-radius: 18px;
            background: rgba(255,255,255,0.05);
        }

        .stat-label {
            display: block;
            font-size: 0.76rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(246, 234, 216, 0.6);
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 1.06rem;
            font-weight: 700;
        }

        .controls {
            display: grid;
            gap: 16px;
            margin-top: 18px;
        }

        .control-card {
            padding: 16px;
            border-radius: 22px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .control-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .control-title strong {
            font-size: 1rem;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            font-size: 0.82rem;
            color: rgba(246, 234, 216, 0.76);
        }

        .row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .row > * { flex: 1 1 140px; }

        select,
        input[type="range"] {
            width: 100%;
        }

        select {
            appearance: none;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(9,5,6,0.65);
            color: var(--paper);
            border-radius: 16px;
            padding: 12px 14px;
        }

        input[type="range"] {
            accent-color: var(--accent);
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .quick-actions button {
            background: rgba(255,255,255,0.07);
            color: var(--paper);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 12px 14px;
            border-radius: 18px;
        }

        .status-panel {
            display: grid;
            gap: 14px;
        }

        .status-banner {
            padding: 16px 18px;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(120,214,176,0.18), rgba(255,140,66,0.12));
            border: 1px solid rgba(255,255,255,0.09);
        }

        .status-banner strong {
            display: block;
            font-size: 1.05rem;
            margin-bottom: 6px;
        }

        .status-banner p,
        .mini-card p {
            margin: 0;
            color: rgba(246, 234, 216, 0.76);
            line-height: 1.6;
        }

        .mini-card {
            padding: 18px;
        }

        .mini-card h3 {
            margin: 0 0 8px;
            font-size: 1.02rem;
        }

        .log {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 10px;
            max-height: 240px;
            overflow: auto;
        }

        .log li {
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.05);
            font-size: 0.92rem;
            line-height: 1.45;
        }

        .legend {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .legend-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(246, 234, 216, 0.72);
            font-size: 0.88rem;
        }

        .swatch {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.08);
        }

        .swatch.soy { background: var(--soy-bright); }
        .swatch.vinegar { background: var(--vinegar); }

        .footer-note {
            margin-top: 24px;
            color: rgba(246, 234, 216, 0.6);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .footer-note a {
            color: var(--warning);
        }

        .solved-glow {
            animation: solvedPulse 1.6s ease-in-out infinite;
        }

        @keyframes solvedPulse {
            0%, 100% { box-shadow: inset 0 10px 30px rgba(255,255,255,0.08), inset 0 -18px 28px rgba(0,0,0,0.35), 0 0 0 rgba(120,214,176,0); }
            50% { box-shadow: inset 0 10px 30px rgba(255,255,255,0.08), inset 0 -18px 28px rgba(0,0,0,0.35), 0 0 34px rgba(120,214,176,0.28); }
        }

        @media (max-width: 920px) {
            .hero-grid,
            .layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .page { width: min(100% - 18px, 1000px); padding-top: 18px; }
            .hero, .panel { padding: 18px; }
            .saucer-grid,
            .quick-actions,
            .stats {
                grid-template-columns: 1fr;
            }
            h1 { font-size: clamp(2.35rem, 14vw, 4rem); }
            .dish { height: 220px; }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="eyebrow">Kitchen puzzle • ratio rescue</div>
            <div class="hero-grid">
                <div>
                    <h1>Soy Sauce<br>Rescue Lab</h1>
                    <p>Jon once wrote about a tiny dinner-table puzzle: two saucers should each end up with equal parts soy sauce and vinegar, but one saucer got twice as much soy as it needed. This page turns that little domestic brainteaser into a polished lacquer-and-amber puzzle bench.</p>
                    <div class="hero-actions">
                        <button class="primary" id="autoplayBtn">Show Mila's 3-move fix</button>
                        <button class="secondary" id="restartBtnTop">Reset puzzle</button>
                        <a class="button secondary" href="index.php">Back to the gallery</a>
                    </div>
                </div>
                <div class="score-panel">
                    <div class="badge-card">
                        <div class="badge-label">Target state</div>
                        <div class="badge-value">2 perfect saucers</div>
                        <p class="panel-copy" style="margin-top:10px;">Each saucer should end with <strong>1 part soy</strong> and <strong>1 part vinegar</strong>. You can pour between saucers or top up from the bottles.</p>
                    </div>
                    <div class="badge-card">
                        <div class="badge-label">Elegant solution</div>
                        <div class="badge-value"><span id="moveCount">0</span> moves</div>
                        <p class="panel-copy" style="margin-top:10px;">Can you match Mila's almost-annoyingly-calm three-move solve?</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="layout">
            <div class="panel">
                <h2>The saucers</h2>
                <p class="panel-copy">The left saucer is the troublemaker. It has too much soy. The right saucer only has vinegar so far. Your job: make them equally full and perfectly balanced.</p>

                <div class="saucer-grid">
                    <article class="saucer-card">
                        <div class="saucer-label-row">
                            <div class="saucer-label">Saucer A</div>
                            <div class="ratio-chip" id="ratioA">2.00 : 1.00</div>
                        </div>
                        <div class="dish" id="dishA">
                            <div class="gloss"></div>
                            <div class="liquid" id="liquidA">
                                <div class="layer vinegar" id="vinegarA"></div>
                                <div class="layer soy" id="soyA"></div>
                            </div>
                        </div>
                        <div class="stats">
                            <div class="stat"><span class="stat-label">Soy</span><span class="stat-value" id="soyValueA">2.00</span></div>
                            <div class="stat"><span class="stat-label">Vinegar</span><span class="stat-value" id="vinegarValueA">1.00</span></div>
                            <div class="stat"><span class="stat-label">Total</span><span class="stat-value" id="totalValueA">3.00</span></div>
                        </div>
                    </article>

                    <article class="saucer-card">
                        <div class="saucer-label-row">
                            <div class="saucer-label">Saucer B</div>
                            <div class="ratio-chip" id="ratioB">0.00 : 1.00</div>
                        </div>
                        <div class="dish" id="dishB">
                            <div class="gloss"></div>
                            <div class="liquid" id="liquidB">
                                <div class="layer vinegar" id="vinegarB"></div>
                                <div class="layer soy" id="soyB"></div>
                            </div>
                        </div>
                        <div class="stats">
                            <div class="stat"><span class="stat-label">Soy</span><span class="stat-value" id="soyValueB">0.00</span></div>
                            <div class="stat"><span class="stat-label">Vinegar</span><span class="stat-value" id="vinegarValueB">1.00</span></div>
                            <div class="stat"><span class="stat-label">Total</span><span class="stat-value" id="totalValueB">1.00</span></div>
                        </div>
                    </article>
                </div>

                <div class="legend">
                    <div class="legend-item"><span class="swatch soy"></span> Soy sauce</div>
                    <div class="legend-item"><span class="swatch vinegar"></span> Vinegar</div>
                </div>
            </div>

            <aside class="status-panel">
                <div class="status-banner" id="statusBanner">
                    <strong>Kitchen status: a bit lopsided</strong>
                    <p id="statusText">Start experimenting. A lovely first instinct is to share some of Saucer A with Saucer B.</p>
                </div>
                <div class="mini-card">
                    <h3>Move log</h3>
                    <ul class="log" id="moveLog">
                        <li>The puzzle begins. Saucer A has 2 soy + 1 vinegar. Saucer B has 1 vinegar.</li>
                    </ul>
                </div>
            </aside>
        </section>

        <section class="layout" style="margin-top: 18px;">
            <div class="panel">
                <h2>Experiment bench</h2>
                <p class="panel-copy">Use the custom controls if you want to freestyle, or tap one of the quick moves if you already smell the solution.</p>
                <div class="controls">
                    <div class="control-card">
                        <div class="control-title">
                            <strong>Pour between saucers</strong>
                            <span class="pill">Keeps the same mixture ratio while pouring</span>
                        </div>
                        <div class="row">
                            <label>
                                <span class="pill" style="display:flex; justify-content:center; margin-bottom:8px;">From</span>
                                <select id="pourFrom">
                                    <option value="A">Saucer A</option>
                                    <option value="B">Saucer B</option>
                                </select>
                            </label>
                            <label>
                                <span class="pill" style="display:flex; justify-content:center; margin-bottom:8px;">To</span>
                                <select id="pourTo">
                                    <option value="B">Saucer B</option>
                                    <option value="A">Saucer A</option>
                                </select>
                            </label>
                        </div>
                        <label style="display:block; margin-top:14px;">
                            <span class="pill" style="display:flex; justify-content:space-between; margin-bottom:8px;">
                                <span>Amount</span>
                                <strong id="pourAmountLabel">1.00 part</strong>
                            </span>
                            <input type="range" id="pourAmount" min="0.25" max="3" step="0.25" value="1">
                        </label>
                        <div class="hero-actions" style="margin-top:16px;">
                            <button class="primary" id="pourBtn">Pour it</button>
                        </div>
                    </div>

                    <div class="control-card">
                        <div class="control-title">
                            <strong>Top up from the bottles</strong>
                            <span class="pill">Adds pure soy or pure vinegar</span>
                        </div>
                        <div class="quick-actions">
                            <button id="addSoyA">Add 0.25 soy to A</button>
                            <button id="addSoyB">Add 0.25 soy to B</button>
                            <button id="addVinegarA">Add 0.25 vinegar to A</button>
                            <button id="addVinegarB">Add 0.25 vinegar to B</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <h2>Quick moves</h2>
                <p class="panel-copy">For a satisfying shortcut, these buttons perform the exact fractions that matter.</p>
                <div class="controls">
                    <div class="control-card">
                        <div class="quick-actions">
                            <button id="shareHalf">Pour half of Saucer A into B</button>
                            <button id="topA">Top up A with 0.50 vinegar</button>
                            <button id="topB">Top up B with 0.50 soy</button>
                            <button id="hintBtn">Whisper a hint</button>
                        </div>
                    </div>
                    <div class="control-card">
                        <h3 style="margin:0 0 8px;">Why this works</h3>
                        <p class="panel-copy">When you pour <em>half</em> of Saucer A into Saucer B, you split its extra soy burden across both saucers. Then each saucer is missing only one pure ingredient: vinegar on the left, soy on the right. Neat little invariant, that.</p>
                    </div>
                </div>
                <p class="footer-note">Inspired by Jon's blog post <em>Soy Sauce Puzzle</em>.</p>
            </div>
        </section>
    </div>

    <script>
        const initialState = {
            A: { soy: 2, vinegar: 1 },
            B: { soy: 0, vinegar: 1 }
        };

        let state = JSON.parse(JSON.stringify(initialState));
        let moveCount = 0;
        let logEntries = ['The puzzle begins. Saucer A has 2 soy + 1 vinegar. Saucer B has 1 vinegar.'];
        let autoplayLock = false;

        const refs = {
            moveCount: document.getElementById('moveCount'),
            moveLog: document.getElementById('moveLog'),
            statusText: document.getElementById('statusText'),
            statusBanner: document.getElementById('statusBanner'),
            pourAmount: document.getElementById('pourAmount'),
            pourAmountLabel: document.getElementById('pourAmountLabel'),
            pourFrom: document.getElementById('pourFrom'),
            pourTo: document.getElementById('pourTo')
        };

        function totalOf(saucer) {
            return state[saucer].soy + state[saucer].vinegar;
        }

        function ratioText(saucer) {
            return `${state[saucer].soy.toFixed(2)} : ${state[saucer].vinegar.toFixed(2)}`;
        }

        function formatAmount(value) {
            return Number(value).toFixed(2).replace(/\.00$/, '.00');
        }

        function updateDish(saucer) {
            const total = totalOf(saucer);
            const soy = state[saucer].soy;
            const vinegar = state[saucer].vinegar;
            const liquid = document.getElementById(`liquid${saucer}`);
            const soyLayer = document.getElementById(`soy${saucer}`);
            const vinegarLayer = document.getElementById(`vinegar${saucer}`);
            const totalHeight = Math.max(18, (Math.min(total, 4) / 4) * 178);
            const soyHeight = total === 0 ? 0 : (soy / total) * totalHeight;
            const vinegarHeight = total === 0 ? 0 : (vinegar / total) * totalHeight;

            liquid.style.height = `${totalHeight}px`;
            vinegarLayer.style.height = `${vinegarHeight}px`;
            soyLayer.style.height = `${soyHeight}px`;

            document.getElementById(`ratio${saucer}`).textContent = ratioText(saucer);
            document.getElementById(`soyValue${saucer}`).textContent = soy.toFixed(2);
            document.getElementById(`vinegarValue${saucer}`).textContent = vinegar.toFixed(2);
            document.getElementById(`totalValue${saucer}`).textContent = total.toFixed(2);
        }

        function setStatus(message, headline = 'Kitchen status: still experimenting') {
            refs.statusText.textContent = message;
            refs.statusBanner.querySelector('strong').textContent = headline;
        }

        function pushLog(message) {
            logEntries.unshift(message);
            refs.moveLog.innerHTML = logEntries.slice(0, 8).map(entry => `<li>${entry}</li>`).join('');
        }

        function checkSolved() {
            const solved = ['A', 'B'].every(s => Math.abs(state[s].soy - 1) < 0.001 && Math.abs(state[s].vinegar - 1) < 0.001);
            document.getElementById('dishA').classList.toggle('solved-glow', solved);
            document.getElementById('dishB').classList.toggle('solved-glow', solved);
            if (solved) {
                setStatus('Perfect. Both saucers are now 1:1 and equally full. Very tidy work.', 'Kitchen status: rescued ✨');
            } else if (moveCount === 0) {
                setStatus('Start experimenting. A lovely first instinct is to share some of Saucer A with Saucer B.', 'Kitchen status: a bit lopsided');
            } else {
                const deltaA = Math.abs(state.A.soy - state.A.vinegar).toFixed(2);
                const deltaB = Math.abs(state.B.soy - state.B.vinegar).toFixed(2);
                setStatus(`Not there yet. Sauce imbalance: A is off by ${deltaA}, B is off by ${deltaB}.`, 'Kitchen status: close, maybe');
            }
        }

        function render() {
            updateDish('A');
            updateDish('B');
            refs.moveCount.textContent = moveCount;
            const maxPour = Math.max(0.25, totalOf(refs.pourFrom.value));
            refs.pourAmount.max = maxPour.toFixed(2);
            if (Number(refs.pourAmount.value) > maxPour) {
                refs.pourAmount.value = Math.floor(maxPour / 0.25) * 0.25;
            }
            refs.pourAmountLabel.textContent = `${Number(refs.pourAmount.value).toFixed(2)} part${Number(refs.pourAmount.value) === 1 ? '' : 's'}`;
            checkSolved();
        }

        function recordMove(message) {
            moveCount += 1;
            pushLog(message);
            render();
        }

        function addIngredient(saucer, ingredient, amount) {
            state[saucer][ingredient] += amount;
            recordMove(`Added ${amount.toFixed(2)} ${ingredient} to Saucer ${saucer}.`);
        }

        function pour(source, target, amount) {
            if (source === target) {
                setStatus('Charming idea, but pouring a saucer into itself is performance art, not chemistry.');
                return;
            }
            const total = totalOf(source);
            if (total <= 0) {
                setStatus(`Saucer ${source} is empty. Nothing to pour.`);
                return;
            }
            const actual = Math.min(amount, total);
            const soyShare = state[source].soy / total;
            const vinegarShare = state[source].vinegar / total;
            const soyMoved = actual * soyShare;
            const vinegarMoved = actual * vinegarShare;
            state[source].soy -= soyMoved;
            state[source].vinegar -= vinegarMoved;
            state[target].soy += soyMoved;
            state[target].vinegar += vinegarMoved;
            recordMove(`Poured ${actual.toFixed(2)} from Saucer ${source} into Saucer ${target} (${soyMoved.toFixed(2)} soy, ${vinegarMoved.toFixed(2)} vinegar).`);
        }

        function resetPuzzle(message = 'Back to the original spill. Ready for another go.') {
            state = JSON.parse(JSON.stringify(initialState));
            moveCount = 0;
            logEntries = ['The puzzle begins. Saucer A has 2 soy + 1 vinegar. Saucer B has 1 vinegar.'];
            refs.moveLog.innerHTML = '<li>' + logEntries[0] + '</li>';
            setStatus(message, 'Kitchen status: reset');
            render();
        }

        async function autoplaySolution() {
            if (autoplayLock) {
                return;
            }
            autoplayLock = true;
            resetPuzzle('Watch the elegant fix unfold.');
            const steps = [
                () => { pour('A', 'B', 1.5); setStatus('Step 1: split Saucer A in half so its extra soy gets shared.', 'Mila move 1 of 3'); },
                () => { addIngredient('A', 'vinegar', 0.5); setStatus('Step 2: Saucer A now just needs pure vinegar.', 'Mila move 2 of 3'); },
                () => { addIngredient('B', 'soy', 0.5); setStatus('Step 3: Saucer B now just needs pure soy. Done.', 'Mila move 3 of 3'); }
            ];
            for (const step of steps) {
                await new Promise(resolve => setTimeout(resolve, 650));
                step();
            }
            autoplayLock = false;
        }

        refs.pourAmount.addEventListener('input', () => {
            refs.pourAmountLabel.textContent = `${Number(refs.pourAmount.value).toFixed(2)} part${Number(refs.pourAmount.value) === 1 ? '' : 's'}`;
        });

        refs.pourFrom.addEventListener('change', () => {
            refs.pourTo.value = refs.pourFrom.value === 'A' ? 'B' : 'A';
            render();
        });

        refs.pourTo.addEventListener('change', () => {
            if (refs.pourTo.value === refs.pourFrom.value) {
                refs.pourTo.value = refs.pourFrom.value === 'A' ? 'B' : 'A';
            }
        });

        document.getElementById('pourBtn').addEventListener('click', () => {
            pour(refs.pourFrom.value, refs.pourTo.value, Number(refs.pourAmount.value));
        });

        document.getElementById('addSoyA').addEventListener('click', () => addIngredient('A', 'soy', 0.25));
        document.getElementById('addSoyB').addEventListener('click', () => addIngredient('B', 'soy', 0.25));
        document.getElementById('addVinegarA').addEventListener('click', () => addIngredient('A', 'vinegar', 0.25));
        document.getElementById('addVinegarB').addEventListener('click', () => addIngredient('B', 'vinegar', 0.25));
        document.getElementById('shareHalf').addEventListener('click', () => pour('A', 'B', 1.5));
        document.getElementById('topA').addEventListener('click', () => addIngredient('A', 'vinegar', 0.5));
        document.getElementById('topB').addEventListener('click', () => addIngredient('B', 'soy', 0.5));
        document.getElementById('hintBtn').addEventListener('click', () => setStatus('Try making the saucers equally full first. After that, each one is missing only one pure ingredient.', 'Hint'));        
        document.getElementById('restartBtnTop').addEventListener('click', () => resetPuzzle());
        document.getElementById('autoplayBtn').addEventListener('click', autoplaySolution);

        render();
    </script>
</body>
</html>
