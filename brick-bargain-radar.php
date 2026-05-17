<?php
$sets = [
    ['name' => 'Turbo Tow Truck', 'pieces' => 148, 'price' => 24.99, 'theme' => 'rescue', 'fun' => 7, 'vehicle' => true],
    ['name' => 'Harbour Fire Boat', 'pieces' => 301, 'price' => 39.99, 'theme' => 'rescue', 'fun' => 8, 'vehicle' => true],
    ['name' => 'Downtown Pizza Van', 'pieces' => 249, 'price' => 29.99, 'theme' => 'city', 'fun' => 8, 'vehicle' => true],
    ['name' => 'Stunt Ramp Transporter', 'pieces' => 212, 'price' => 34.99, 'theme' => 'stunt', 'fun' => 9, 'vehicle' => true],
    ['name' => 'Arctic Explorer Snowcat', 'pieces' => 389, 'price' => 54.99, 'theme' => 'expedition', 'fun' => 9, 'vehicle' => true],
    ['name' => 'Farm Tractor & Orchard', 'pieces' => 275, 'price' => 44.99, 'theme' => 'farm', 'fun' => 7, 'vehicle' => true],
    ['name' => 'Police Command Hauler', 'pieces' => 612, 'price' => 79.99, 'theme' => 'police', 'fun' => 9, 'vehicle' => true],
    ['name' => 'Ocean Research Base', 'pieces' => 742, 'price' => 89.99, 'theme' => 'science', 'fun' => 8, 'vehicle' => false],
    ['name' => 'Metro Passenger Train', 'pieces' => 764, 'price' => 129.99, 'theme' => 'transit', 'fun' => 10, 'vehicle' => true],
    ['name' => 'Space Rover Convoy', 'pieces' => 918, 'price' => 119.99, 'theme' => 'space', 'fun' => 10, 'vehicle' => true],
    ['name' => 'Grand Prix Garage', 'pieces' => 456, 'price' => 59.99, 'theme' => 'racing', 'fun' => 9, 'vehicle' => true],
    ['name' => 'Mountain Rescue Airlift', 'pieces' => 538, 'price' => 69.99, 'theme' => 'rescue', 'fun' => 8, 'vehicle' => true],
];
foreach ($sets as &$set) {
    $set['value'] = round($set['pieces'] / $set['price'], 2);
    $set['bang'] = round(($set['pieces'] * 0.7 + $set['fun'] * 18 + ($set['vehicle'] ? 24 : 0)) / $set['price'], 2);
}
unset($set);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brick Bargain Radar</title>
    <style>
        :root {
            --bg: #fbf4d7;
            --paper: rgba(255, 250, 232, 0.82);
            --ink: #1b2240;
            --muted: #5f6686;
            --red: #dc2f3c;
            --blue: #2546c9;
            --sky: #8ed6ff;
            --yellow: #ffd84d;
            --green: #27b47e;
            --shadow: 0 22px 60px rgba(27, 34, 64, 0.18);
            --radius: 26px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Avenir Next", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 20%, rgba(255, 216, 77, 0.55), transparent 20%),
                radial-gradient(circle at 86% 14%, rgba(142, 214, 255, 0.45), transparent 24%),
                linear-gradient(180deg, #fff7da 0%, #ffe8ba 35%, #f7d88f 100%);
            position: relative;
            overflow-x: hidden;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(37, 70, 201, 0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(37, 70, 201, 0.045) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.75;
        }
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle, rgba(27, 34, 64, 0.06) 1px, transparent 1px);
            background-size: 10px 10px;
            mix-blend-mode: multiply;
            opacity: 0.18;
        }
        .wrap {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 24px 0 48px;
            position: relative;
            z-index: 1;
        }
        .hero {
            background: linear-gradient(145deg, rgba(255,255,255,0.85), rgba(255,247,220,0.86));
            border: 3px solid rgba(27, 34, 64, 0.12);
            box-shadow: var(--shadow);
            border-radius: 34px;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }
        .hero::before, .hero::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            opacity: 0.9;
        }
        .hero::before {
            width: 180px; height: 180px;
            background: rgba(220, 47, 60, 0.12);
            top: -54px; right: -48px;
        }
        .hero::after {
            width: 140px; height: 140px;
            background: rgba(39, 180, 126, 0.13);
            left: -36px; bottom: -42px;
        }
        .badge-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }
        .badge {
            background: var(--yellow);
            color: #503f00;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border-radius: 999px;
            padding: 8px 12px;
            border: 2px solid rgba(80, 63, 0, 0.12);
            box-shadow: 0 6px 18px rgba(80, 63, 0, 0.14);
        }
        h1 {
            font-family: Georgia, "Palatino Linotype", serif;
            font-size: clamp(2.4rem, 6vw, 4.8rem);
            line-height: 0.92;
            margin: 0;
            letter-spacing: -0.04em;
            max-width: 10ch;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.9fr;
            gap: 22px;
            align-items: end;
        }
        .dek {
            font-size: 1.05rem;
            line-height: 1.65;
            color: var(--muted);
            max-width: 58ch;
            margin: 16px 0 0;
        }
        .hero-note {
            background: linear-gradient(180deg, rgba(37,70,201,0.92), rgba(22,42,123,0.98));
            color: white;
            padding: 18px;
            border-radius: 24px;
            box-shadow: 0 18px 30px rgba(37, 70, 201, 0.28);
            transform: rotate(-2deg);
        }
        .hero-note strong {
            display: block;
            font-size: 0.86rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .hero-note p {
            margin: 0;
            line-height: 1.55;
            font-size: 0.98rem;
        }
        .dashboard {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 18px;
            margin-top: 20px;
        }
        .panel {
            background: var(--paper);
            backdrop-filter: blur(8px);
            border-radius: var(--radius);
            border: 2px solid rgba(27, 34, 64, 0.08);
            box-shadow: var(--shadow);
            padding: 18px;
        }
        .panel h2, .panel h3 {
            margin: 0 0 8px;
            font-family: Georgia, "Palatino Linotype", serif;
            letter-spacing: -0.03em;
        }
        .subtle {
            color: var(--muted);
            line-height: 1.55;
            margin: 0 0 14px;
        }
        .control-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        .control {
            background: rgba(255,255,255,0.65);
            border-radius: 18px;
            padding: 14px;
            border: 1px solid rgba(27, 34, 64, 0.08);
        }
        label {
            display: block;
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
        }
        input[type="range"], select {
            width: 100%;
        }
        input[type="range"] {
            accent-color: var(--red);
        }
        select {
            appearance: none;
            border: 1px solid rgba(27, 34, 64, 0.12);
            border-radius: 12px;
            padding: 10px 12px;
            background: white;
            color: var(--ink);
            font: inherit;
        }
        .money {
            font-size: 2rem;
            font-weight: 900;
            color: var(--red);
            margin-top: 6px;
        }
        .switch {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .toggle {
            position: relative;
            width: 60px;
            height: 34px;
        }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute;
            inset: 0;
            background: #c9d0ef;
            border-radius: 999px;
            transition: 0.25s ease;
            cursor: pointer;
        }
        .slider::before {
            content: "";
            position: absolute;
            width: 26px;
            height: 26px;
            left: 4px;
            top: 4px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 5px 14px rgba(0,0,0,0.18);
            transition: 0.25s ease;
        }
        .toggle input:checked + .slider {
            background: var(--green);
        }
        .toggle input:checked + .slider::before {
            transform: translateX(26px);
        }
        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 14px;
        }
        .stat {
            background: rgba(255,255,255,0.72);
            border-radius: 18px;
            padding: 14px;
            border: 1px solid rgba(27, 34, 64, 0.08);
        }
        .stat span {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 800;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .stat strong {
            font-size: 1.5rem;
        }
        .chart-box {
            background: linear-gradient(180deg, rgba(37, 70, 201, 0.05), rgba(255,255,255,0.55));
            border-radius: 22px;
            padding: 12px;
            border: 1px solid rgba(37, 70, 201, 0.1);
        }
        canvas {
            width: 100%;
            height: 340px;
            display: block;
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(255,255,255,0.88), rgba(239,244,255,0.94));
        }
        .legend {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 10px;
            color: var(--muted);
            font-size: 0.82rem;
        }
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }
        .cards {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 16px;
        }
        .set-card {
            background: rgba(255,255,255,0.84);
            border-radius: 20px;
            padding: 16px;
            border: 2px solid rgba(27, 34, 64, 0.08);
            position: relative;
            overflow: hidden;
            transform: translateY(0);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }
        .set-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 28px rgba(27,34,64,0.12);
        }
        .set-card::after {
            content: attr(data-theme);
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(27,34,64,0.45);
            font-weight: 800;
        }
        .set-card h3 {
            margin: 0 0 10px;
            font-size: 1.12rem;
        }
        .meter {
            height: 12px;
            background: rgba(37, 70, 201, 0.1);
            border-radius: 999px;
            overflow: hidden;
            margin: 10px 0 12px;
        }
        .meter-fill {
            height: 100%;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--yellow), var(--red));
        }
        .mini-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            font-size: 0.82rem;
            color: var(--muted);
        }
        .mini-grid strong {
            display: block;
            color: var(--ink);
            font-size: 1rem;
            margin-top: 2px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 800;
            background: rgba(39, 180, 126, 0.12);
            color: #0f6b48;
            margin-top: 12px;
        }
        .challenge-options {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 14px;
        }
        .challenge-btn, .cta {
            border: none;
            border-radius: 18px;
            padding: 14px;
            cursor: pointer;
            font: inherit;
            font-weight: 800;
            transition: transform 0.16s ease, box-shadow 0.16s ease, background 0.16s ease;
        }
        .challenge-btn {
            background: white;
            color: var(--ink);
            border: 2px solid rgba(27, 34, 64, 0.08);
            text-align: left;
        }
        .challenge-btn:hover, .cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 18px rgba(27,34,64,0.12);
        }
        .challenge-btn.correct { background: rgba(39,180,126,0.16); border-color: rgba(39,180,126,0.45); }
        .challenge-btn.wrong { background: rgba(220,47,60,0.12); border-color: rgba(220,47,60,0.35); }
        .cta {
            background: linear-gradient(135deg, var(--red), #ff6a54);
            color: white;
            margin-top: 16px;
        }
        .result-note {
            margin-top: 12px;
            min-height: 46px;
            color: var(--muted);
            line-height: 1.55;
        }
        .footer-note {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .hero-grid, .dashboard { grid-template-columns: 1fr; }
        }
        @media (max-width: 720px) {
            .wrap { width: min(100% - 18px, 1120px); }
            .hero { padding: 18px; border-radius: 28px; }
            .panel { padding: 16px; }
            .control-grid, .summary, .cards, .challenge-options { grid-template-columns: 1fr; }
            canvas { height: 280px; }
            h1 { max-width: none; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="badge-row">
                <div class="badge">Toy-box economics</div>
                <div class="badge">Nathan-friendly mode</div>
                <div class="badge">Price vs. piece count</div>
            </div>
            <div class="hero-grid">
                <div>
                    <h1>Brick Bargain Radar</h1>
                    <p class="dek">Jon noticed that plotting piece count against price makes the good-value sets float upward like little plastic stars. So I made a cheerful bargain lab where you can hunt for the smartest brick buy, filter for vehicle-heavy fun, and settle family debates with suspiciously smug data.</p>
                </div>
                <aside class="hero-note">
                    <strong>Field note from the deal desk</strong>
                    <p>Higher on the chart usually means better value. But piece count is only half the story, so Nathan Mode sneaks in extra points for vehicles, stunts, and sets that look fun enough to trigger immediate living-room sprawl.</p>
                </aside>
            </div>
        </section>

        <section class="dashboard">
            <div class="panel">
                <h2>Build your radar sweep</h2>
                <p class="subtle">Slide the budget, pick a sorting style, and decide whether the page should think like a spreadsheet goblin or a nine-year-old with excellent taste in vehicles.</p>
                <div class="control-grid">
                    <div class="control">
                        <label for="budget">Budget cap</label>
                        <input id="budget" type="range" min="20" max="140" step="5" value="70">
                        <div class="money" id="budgetLabel">$70</div>
                    </div>
                    <div class="control">
                        <label for="sortMode">Sort sets by</label>
                        <select id="sortMode">
                            <option value="value">Pieces per dollar</option>
                            <option value="bang">Nathan Mode delight score</option>
                            <option value="pieces">Most pieces</option>
                            <option value="price">Lowest price</option>
                        </select>
                    </div>
                    <div class="control switch">
                        <div>
                            <label for="vehicleOnly">Vehicle focus</label>
                            <div class="subtle" style="margin:0">Hide non-vehicle builds.</div>
                        </div>
                        <label class="toggle">
                            <input id="vehicleOnly" type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="control switch">
                        <div>
                            <label for="nathanMode">Nathan Mode</label>
                            <div class="subtle" style="margin:0">Give extra weight to fun.</div>
                        </div>
                        <label class="toggle">
                            <input id="nathanMode" type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="summary">
                    <div class="stat"><span>Best pick</span><strong id="bestPick">-</strong></div>
                    <div class="stat"><span>Average value</span><strong id="avgValue">-</strong></div>
                    <div class="stat"><span>Sets in range</span><strong id="inRange">-</strong></div>
                </div>
                <div class="chart-box" style="margin-top:16px;">
                    <canvas id="chart" width="720" height="340"></canvas>
                    <div class="legend">
                        <div><span class="dot" style="background:#2546c9"></span>Classic value</div>
                        <div><span class="dot" style="background:#dc2f3c"></span>Current best pick</div>
                        <div><span class="dot" style="background:#27b47e"></span>Nathan Mode boost</div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <h2>Three-round bargain duel</h2>
                <p class="subtle">You get three candidate sets. Pick the one with the best value for money. Nathan Mode judges with a slightly more chaotic heart.</p>
                <div class="stat" style="background:linear-gradient(180deg, rgba(255,255,255,0.86), rgba(255,248,219,0.92));">
                    <span>Score</span>
                    <strong id="score">0 / 0</strong>
                </div>
                <div class="result-note" id="challengePrompt">Tap “Deal me a round” to start.</div>
                <div class="challenge-options" id="challengeOptions"></div>
                <button class="cta" id="newRound">Deal me a round</button>
                <div class="footer-note">The house rule is simple: no whining if the spreadsheet beats your instincts. Brief sulking is permitted.</div>
            </div>
        </section>

        <section class="panel" style="margin-top:18px;">
            <h2>Shortlist</h2>
            <p class="subtle">These cards update live. Think of them as the toy-store aisle, but with fewer impulse ambushes and more graphs.</p>
            <div class="cards" id="cards"></div>
        </section>
    </div>

    <script>
        const sets = <?php echo json_encode($sets, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
        const budgetInput = document.getElementById('budget');
        const budgetLabel = document.getElementById('budgetLabel');
        const sortMode = document.getElementById('sortMode');
        const vehicleOnly = document.getElementById('vehicleOnly');
        const nathanMode = document.getElementById('nathanMode');
        const cards = document.getElementById('cards');
        const bestPick = document.getElementById('bestPick');
        const avgValue = document.getElementById('avgValue');
        const inRange = document.getElementById('inRange');
        const canvas = document.getElementById('chart');
        const ctx = canvas.getContext('2d');
        const challengeOptions = document.getElementById('challengeOptions');
        const prompt = document.getElementById('challengePrompt');
        const score = document.getElementById('score');
        const newRound = document.getElementById('newRound');

        let rounds = 0;
        let wins = 0;
        let activeRound = null;

        function getVisibleSets() {
            return sets.filter(set => set.price <= Number(budgetInput.value) && (!vehicleOnly.checked || set.vehicle));
        }

        function getMetric(set) {
            if (sortMode.value === 'pieces') return set.pieces;
            if (sortMode.value === 'price') return -set.price;
            if (sortMode.value === 'bang') return set.bang;
            return nathanMode.checked ? set.bang : set.value;
        }

        function render() {
            budgetLabel.textContent = `$${budgetInput.value}`;
            const visible = getVisibleSets().sort((a, b) => getMetric(b) - getMetric(a));
            const best = visible[0];
            bestPick.textContent = best ? best.name : 'Nothing yet';
            avgValue.textContent = visible.length ? `${(visible.reduce((sum, set) => sum + set.value, 0) / visible.length).toFixed(2)}x` : '-';
            inRange.textContent = String(visible.length);

            cards.innerHTML = visible.length ? visible.map((set, index) => {
                const scorePct = Math.min(100, ((nathanMode.checked ? set.bang : set.value) / 10) * 100);
                return `
                    <article class="set-card" data-theme="${set.theme}">
                        <h3>${index === 0 ? '⭐ ' : ''}${set.name}</h3>
                        <div class="mini-grid">
                            <div>Price<strong>$${set.price.toFixed(2)}</strong></div>
                            <div>Pieces<strong>${set.pieces}</strong></div>
                            <div>Fun<strong>${set.fun}/10</strong></div>
                        </div>
                        <div class="meter"><div class="meter-fill" style="width:${scorePct}%"></div></div>
                        <div class="mini-grid">
                            <div>Value<strong>${set.value}x</strong></div>
                            <div>Radar<strong>${set.bang}</strong></div>
                            <div>Type<strong>${set.vehicle ? 'Vehicle' : 'Build'}</strong></div>
                        </div>
                        <div class="pill">${index === 0 ? 'Current best pick' : 'Still extremely tempting'}</div>
                    </article>
                `;
            }).join('') : '<p class="subtle">No sets fit that filter. Your budget has become a stern little gremlin.</p>';

            drawChart(visible, best);
        }

        function drawChart(visible, best) {
            const dpr = window.devicePixelRatio || 1;
            const rect = canvas.getBoundingClientRect();
            canvas.width = rect.width * dpr;
            canvas.height = rect.height * dpr;
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            const width = rect.width;
            const height = rect.height;
            ctx.clearRect(0, 0, width, height);

            const pad = { top: 20, right: 18, bottom: 34, left: 46 };
            const maxPrice = 140;
            const maxPieces = 1000;

            ctx.strokeStyle = 'rgba(37, 70, 201, 0.12)';
            ctx.lineWidth = 1;
            for (let i = 0; i <= 5; i++) {
                const y = pad.top + ((height - pad.top - pad.bottom) / 5) * i;
                ctx.beginPath();
                ctx.moveTo(pad.left, y);
                ctx.lineTo(width - pad.right, y);
                ctx.stroke();
            }
            for (let i = 0; i <= 6; i++) {
                const x = pad.left + ((width - pad.left - pad.right) / 6) * i;
                ctx.beginPath();
                ctx.moveTo(x, pad.top);
                ctx.lineTo(x, height - pad.bottom);
                ctx.stroke();
            }

            ctx.fillStyle = 'rgba(27, 34, 64, 0.72)';
            ctx.font = '12px Trebuchet MS';
            ctx.fillText('price →', width - 56, height - 10);
            ctx.save();
            ctx.translate(14, 66);
            ctx.rotate(-Math.PI / 2);
            ctx.fillText('pieces →', 0, 0);
            ctx.restore();

            visible.forEach(set => {
                const x = pad.left + (set.price / maxPrice) * (width - pad.left - pad.right);
                const y = height - pad.bottom - (set.pieces / maxPieces) * (height - pad.top - pad.bottom);
                const color = best && best.name === set.name ? '#dc2f3c' : (nathanMode.checked ? '#27b47e' : '#2546c9');
                ctx.beginPath();
                ctx.fillStyle = color;
                ctx.arc(x, y, best && best.name === set.name ? 8 : 6, 0, Math.PI * 2);
                ctx.fill();
                ctx.fillStyle = 'rgba(27,34,64,0.78)';
                ctx.font = '11px Trebuchet MS';
                ctx.fillText(set.name, x + 10, y - 8);
            });
        }

        function pickRoundSets() {
            const pool = sets.slice().sort(() => Math.random() - 0.5).slice(0, 3);
            const judgeBy = nathanMode.checked ? 'bang' : 'value';
            const best = pool.reduce((winner, set) => set[judgeBy] > winner[judgeBy] ? set : winner, pool[0]);
            activeRound = { pool, best, judgeBy, answered: false };
            prompt.textContent = nathanMode.checked
                ? 'Nathan Mode is active, so vehicles and fun can steal the crown. Choose wisely.'
                : 'Classic mode: pick the set with the strongest pieces-per-dollar value.';
            challengeOptions.innerHTML = pool.map((set, idx) => `
                <button class="challenge-btn" data-idx="${idx}">
                    <strong>${set.name}</strong><br>
                    $${set.price.toFixed(2)} · ${set.pieces} pieces · fun ${set.fun}/10
                </button>
            `).join('');
        }

        challengeOptions.addEventListener('click', (event) => {
            const btn = event.target.closest('.challenge-btn');
            if (!btn || !activeRound || activeRound.answered) return;
            activeRound.answered = true;
            rounds += 1;
            const chosen = activeRound.pool[Number(btn.dataset.idx)];
            const buttons = [...challengeOptions.querySelectorAll('.challenge-btn')];
            buttons.forEach((button, idx) => {
                const set = activeRound.pool[idx];
                if (set.name === activeRound.best.name) button.classList.add('correct');
                if (idx === Number(btn.dataset.idx) && set.name !== activeRound.best.name) button.classList.add('wrong');
            });
            if (chosen.name === activeRound.best.name) {
                wins += 1;
                prompt.textContent = `Nice. ${chosen.name} wins this round with a ${chosen[activeRound.judgeBy]} ${activeRound.judgeBy === 'value' ? 'pieces-per-dollar score' : 'Nathan delight score'}.`;
            } else {
                prompt.textContent = `Close, but the sneaky winner was ${activeRound.best.name}. It edges ahead with a ${activeRound.judgeBy === 'value' ? 'better value ratio' : 'more joy per dollar'}.`;
            }
            score.textContent = `${wins} / ${rounds}`;
        });

        newRound.addEventListener('click', pickRoundSets);
        [budgetInput, sortMode, vehicleOnly, nathanMode].forEach(el => el.addEventListener('input', () => {
            render();
            if (activeRound && !activeRound.answered) pickRoundSets();
        }));
        window.addEventListener('resize', render);

        render();
    </script>
</body>
</html>
