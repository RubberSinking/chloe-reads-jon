<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendly Rivalry Arcade</title>
    <style>
        :root {
            --bg: #090814;
            --bg-2: #17142c;
            --panel: rgba(17, 16, 31, 0.88);
            --line: rgba(255,255,255,0.1);
            --gold: #ffd36d;
            --mint: #79ffd5;
            --pink: #ff88d8;
            --blue: #8ab8ff;
            --lavender: #c1a4ff;
            --text: #f7f2ff;
            --muted: #b8b0d3;
            --danger: #ff7878;
            --shadow: 0 24px 80px rgba(0,0,0,0.45);
            --radius: 24px;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Gill Sans", "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 136, 216, 0.18), transparent 32%),
                radial-gradient(circle at top right, rgba(121, 255, 213, 0.16), transparent 28%),
                radial-gradient(circle at bottom center, rgba(138, 184, 255, 0.18), transparent 35%),
                linear-gradient(180deg, #100d23 0%, #090814 55%, #06050f 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 100% 32px, 32px 100%;
            mask-image: linear-gradient(180deg, rgba(255,255,255,0.45), transparent 90%);
        }

        .wrap {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 64px;
        }

        .hero {
            position: relative;
            padding: 28px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 32px;
            background: linear-gradient(145deg, rgba(31,25,53,0.94), rgba(13,12,24,0.92));
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -10% -26% auto;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,211,109,0.3), transparent 66%);
            filter: blur(8px);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            color: var(--gold);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.72rem;
            font-weight: 700;
        }

        h1 {
            margin: 18px 0 12px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(2.4rem, 7vw, 4.8rem);
            line-height: 0.96;
            letter-spacing: -0.04em;
            max-width: 10ch;
        }

        .hero p {
            max-width: 62ch;
            color: var(--muted);
            line-height: 1.6;
            font-size: 1.03rem;
            margin: 0;
        }

        .hero-grid, .dashboard, .bottom-grid {
            display: grid;
            gap: 18px;
        }

        .hero-grid { grid-template-columns: 1.2fr 0.8fr; margin-top: 22px; }
        .dashboard { grid-template-columns: 1.1fr 0.9fr; margin-top: 18px; }
        .bottom-grid { grid-template-columns: repeat(3, 1fr); margin-top: 18px; }

        .card {
            position: relative;
            border-radius: var(--radius);
            padding: 22px;
            background: var(--panel);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .card h2, .card h3 {
            margin: 0 0 12px;
            font-size: 1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .scoreboard {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            align-items: end;
        }

        .lane {
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(255,255,255,0.09), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .lane label, .field label {
            display: block;
            font-size: 0.78rem;
            color: var(--muted);
            margin-bottom: 8px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        input, button {
            font: inherit;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            background: rgba(7,7,17,0.55);
            color: var(--text);
            padding: 12px 14px;
            outline: none;
        }

        input[type="number"] { font-size: 1.6rem; font-weight: 800; text-align: center; }
        input:focus { border-color: var(--mint); box-shadow: 0 0 0 3px rgba(121,255,213,0.15); }

        .field-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 14px;
        }

        .actions, .pill-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            border: 0;
            border-radius: 999px;
            padding: 12px 16px;
            color: #130f22;
            background: linear-gradient(135deg, var(--gold), #ffefad);
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 12px 26px rgba(255,211,109,0.22);
            transition: transform 140ms ease, box-shadow 140ms ease, opacity 140ms ease;
        }

        button:hover { transform: translateY(-1px); box-shadow: 0 16px 30px rgba(255,211,109,0.3); }
        button.secondary {
            color: var(--text);
            background: rgba(255,255,255,0.07);
            box-shadow: none;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .metric {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .metric .label {
            display: block;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .metric .value {
            font-size: clamp(1.5rem, 5vw, 2.3rem);
            font-weight: 900;
            line-height: 1;
        }

        .metric .note { margin-top: 8px; color: var(--muted); font-size: 0.88rem; }
        .positive { color: var(--mint); }
        .warning { color: var(--gold); }
        .negative { color: var(--danger); }

        .chart-frame {
            margin-top: 14px;
            border-radius: 20px;
            padding: 14px;
            background: linear-gradient(180deg, rgba(12,12,24,0.96), rgba(19,16,38,0.92));
            border: 1px solid rgba(255,255,255,0.08);
        }

        svg { width: 100%; height: auto; display: block; }
        .chart-legend {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 12px;
            font-size: 0.86rem;
            color: var(--muted);
            flex-wrap: wrap;
        }

        .challenge {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
        }

        .challenge-banner {
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(255,136,216,0.18), rgba(138,184,255,0.15));
            border: 1px solid rgba(255,255,255,0.1);
        }

        .challenge-banner strong {
            display: block;
            font-size: 1.3rem;
            margin-bottom: 8px;
            font-family: Georgia, "Times New Roman", serif;
        }

        .sparkline {
            display: flex;
            align-items: end;
            gap: 8px;
            min-height: 100px;
            padding-top: 6px;
        }

        .sparkline span {
            flex: 1;
            border-radius: 999px 999px 8px 8px;
            background: linear-gradient(180deg, var(--mint), rgba(121,255,213,0.28));
            min-width: 18px;
            position: relative;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }

        .sparkline span.loss {
            background: linear-gradient(180deg, #ff9fb8, rgba(255,120,120,0.26));
        }

        .sparkline span::after {
            content: attr(data-label);
            position: absolute;
            left: 50%;
            bottom: -22px;
            transform: translateX(-50%);
            font-size: 0.72rem;
            color: var(--muted);
        }

        .match-list {
            display: grid;
            gap: 10px;
            max-height: 320px;
            overflow: auto;
            padding-right: 4px;
        }

        .match-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 14px;
            align-items: center;
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .match-badge {
            width: 40px;
            height: 40px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-weight: 900;
            background: rgba(255,255,255,0.08);
            color: var(--gold);
        }

        .tiny {
            color: var(--muted);
            font-size: 0.85rem;
            line-height: 1.45;
        }

        .quote {
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.2rem;
            line-height: 1.45;
            color: #fff5d8;
            margin: 0;
        }

        .footer-note {
            margin-top: 24px;
            text-align: center;
            color: var(--muted);
            font-size: 0.88rem;
        }

        @media (max-width: 900px) {
            .hero-grid, .dashboard, .bottom-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .wrap { width: min(100% - 18px, 1120px); padding-top: 16px; }
            .hero, .card { padding: 18px; border-radius: 24px; }
            .scoreboard, .field-row, .metric-grid { grid-template-columns: 1fr; }
            h1 { max-width: none; }
            .entry-title { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="eyebrow">Arcade of gracious competition</div>
            <h1>Friendly Rivalry Arcade</h1>
            <p>
                Winning is nice. Sulking is tiresome. This little neon scoreboard turns a head-to-head game into a gentler challenge: can you improve your score difference from last time? Track a rivalry, celebrate real progress, and let the scoreboard coach your sportsmanship for once.
            </p>
            <div class="hero-grid">
                <div class="card">
                    <h2>Log the next match</h2>
                    <div class="scoreboard">
                        <div class="lane">
                            <label for="playerAName">Player A</label>
                            <input id="playerAName" type="text" value="Jon">
                            <div class="field-row">
                                <div class="field">
                                    <label for="playerAScore">Score</label>
                                    <input id="playerAScore" type="number" value="11" min="0" max="999">
                                </div>
                            </div>
                        </div>
                        <div class="lane">
                            <label for="playerBName">Player B</label>
                            <input id="playerBName" type="text" value="Rival">
                            <div class="field-row">
                                <div class="field">
                                    <label for="playerBScore">Score</label>
                                    <input id="playerBScore" type="number" value="9" min="0" max="999">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="actions" style="margin-top: 16px;">
                        <button id="addMatch">Add Match</button>
                        <button id="loadDemo" class="secondary">Load Demo Rivalry</button>
                        <button id="clearAll" class="secondary">Clear Board</button>
                    </div>
                </div>
                <div class="card challenge">
                    <div>
                        <h2>Tonight's challenge</h2>
                        <div class="challenge-banner">
                            <strong id="challengeTitle">Beat your last margin by 1</strong>
                            <div class="tiny" id="challengeText">Start with one match, then the cabinet will set a kinder target than mere revenge.</div>
                        </div>
                    </div>
                    <div>
                        <h3>Sportsmanship meter</h3>
                        <p class="quote" id="coachQuote">"The real flex is leaving the table in a better mood than when you sat down."</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="dashboard">
            <div class="card">
                <h2>Progress constellation</h2>
                <div class="metric-grid">
                    <div class="metric">
                        <span class="label">Latest margin</span>
                        <div class="value" id="latestMargin">+2</div>
                        <div class="note" id="latestLabel">Jon by 2</div>
                    </div>
                    <div class="metric">
                        <span class="label">Improvement</span>
                        <div class="value" id="improvementValue">—</div>
                        <div class="note" id="improvementLabel">Waiting for match two</div>
                    </div>
                    <div class="metric">
                        <span class="label">Kind rivalry streak</span>
                        <div class="value" id="streakValue">1</div>
                        <div class="note" id="streakLabel">One logged match</div>
                    </div>
                </div>
                <div class="chart-frame">
                    <svg id="trendChart" viewBox="0 0 640 250" role="img" aria-label="Score difference trend chart"></svg>
                    <div class="chart-legend">
                        <span>Upward means Player A widened the gap.</span>
                        <span>Crossing the middle line means the lead changed hands.</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2>Momentum bars</h2>
                <div class="sparkline" id="sparkline"></div>
                <div class="tiny" style="margin-top: 32px;" id="summaryText">
                    Add a few matches and this cabinet will start noticing whether the rivalry is getting gentler, closer, or gloriously chaotic.
                </div>
            </div>
        </section>

        <section class="bottom-grid">
            <div class="card">
                <h2>Match history</h2>
                <div id="matchList" class="match-list"></div>
            </div>
            <div class="card">
                <h2>Reframe buttons</h2>
                <div class="pill-row">
                    <button class="secondary mantra" data-mantra="Nice. The scoreboard says progress, not ego.">Need perspective</button>
                    <button class="secondary mantra" data-mantra="You are not losing to a person. You are debugging your previous margin.">Feeling salty</button>
                    <button class="secondary mantra" data-mantra="If your friend had fun too, that counts as a hidden bonus round.">Remember the point</button>
                </div>
                <p class="quote" id="mantraText" style="margin-top: 18px;">"Compete hard. Carry the friendship harder."</p>
            </div>
            <div class="card">
                <h2>Cabinet notes</h2>
                <p class="tiny">
                    This arcade cabinet is inspired by a simple Jon idea from 2005: if winning and losing with friends gets emotionally silly, stop treating your friend as the enemy and start treating your previous score difference as the thing to beat.
                </p>
                <p class="tiny">
                    It is a beautifully nerdy lifehack. Also a bit rude to the concept of sore losers, which frankly they had coming.
                </p>
            </div>
        </section>

        <div class="footer-note">Self-contained, browser-only, and delightfully judgmental in a supportive way.</div>
    </div>

    <script>
        const storageKey = 'friendly-rivalry-arcade-v1';
        const defaultMatches = [
            { a: 11, b: 9 },
            { a: 8, b: 11 },
            { a: 10, b: 11 },
            { a: 12, b: 10 }
        ];

        const els = {
            playerAName: document.getElementById('playerAName'),
            playerBName: document.getElementById('playerBName'),
            playerAScore: document.getElementById('playerAScore'),
            playerBScore: document.getElementById('playerBScore'),
            addMatch: document.getElementById('addMatch'),
            loadDemo: document.getElementById('loadDemo'),
            clearAll: document.getElementById('clearAll'),
            latestMargin: document.getElementById('latestMargin'),
            latestLabel: document.getElementById('latestLabel'),
            improvementValue: document.getElementById('improvementValue'),
            improvementLabel: document.getElementById('improvementLabel'),
            streakValue: document.getElementById('streakValue'),
            streakLabel: document.getElementById('streakLabel'),
            trendChart: document.getElementById('trendChart'),
            sparkline: document.getElementById('sparkline'),
            matchList: document.getElementById('matchList'),
            summaryText: document.getElementById('summaryText'),
            challengeTitle: document.getElementById('challengeTitle'),
            challengeText: document.getElementById('challengeText'),
            coachQuote: document.getElementById('coachQuote'),
            mantraText: document.getElementById('mantraText')
        };

        const state = {
            playerA: 'Jon',
            playerB: 'Rival',
            matches: []
        };

        function loadState() {
            try {
                const saved = JSON.parse(localStorage.getItem(storageKey) || 'null');
                if (saved && Array.isArray(saved.matches)) {
                    state.playerA = saved.playerA || state.playerA;
                    state.playerB = saved.playerB || state.playerB;
                    state.matches = saved.matches.filter(m => Number.isFinite(m.a) && Number.isFinite(m.b));
                } else {
                    state.matches = defaultMatches.slice();
                }
            } catch (error) {
                state.matches = defaultMatches.slice();
            }

            els.playerAName.value = state.playerA;
            els.playerBName.value = state.playerB;
        }

        function saveState() {
            state.playerA = els.playerAName.value.trim() || 'Player A';
            state.playerB = els.playerBName.value.trim() || 'Player B';
            localStorage.setItem(storageKey, JSON.stringify(state));
        }

        function margin(match) {
            return match.a - match.b;
        }

        function formatMargin(value) {
            return `${value > 0 ? '+' : ''}${value}`;
        }

        function latestImprovement(matches) {
            if (matches.length < 2) return null;
            const previous = margin(matches[matches.length - 2]);
            const current = margin(matches[matches.length - 1]);
            return current - previous;
        }

        function kindStreak(matches) {
            if (!matches.length) return 0;
            let streak = 1;
            for (let i = matches.length - 1; i > 0; i--) {
                const diff = Math.abs(margin(matches[i]) - margin(matches[i - 1]));
                if (diff <= 3) streak++;
                else break;
            }
            return streak;
        }

        function renderMetrics() {
            const matches = state.matches;
            const aName = els.playerAName.value.trim() || 'Player A';
            const bName = els.playerBName.value.trim() || 'Player B';

            if (!matches.length) {
                els.latestMargin.textContent = '—';
                els.latestLabel.textContent = 'No matches yet';
                els.improvementValue.textContent = '—';
                els.improvementValue.className = 'value';
                els.improvementLabel.textContent = 'Add your first match';
                els.streakValue.textContent = '0';
                els.streakLabel.textContent = 'Cabinet asleep';
                return;
            }

            const current = margin(matches[matches.length - 1]);
            const leader = current === 0 ? 'Dead even' : `${current > 0 ? aName : bName} by ${Math.abs(current)}`;
            els.latestMargin.textContent = formatMargin(current);
            els.latestMargin.className = `value ${current >= 0 ? 'positive' : 'negative'}`;
            els.latestLabel.textContent = leader;

            const improvement = latestImprovement(matches);
            if (improvement === null) {
                els.improvementValue.textContent = '—';
                els.improvementValue.className = 'value';
                els.improvementLabel.textContent = 'Waiting for match two';
            } else {
                els.improvementValue.textContent = `${improvement > 0 ? '+' : ''}${improvement}`;
                els.improvementValue.className = `value ${improvement > 0 ? 'positive' : improvement < 0 ? 'negative' : 'warning'}`;
                els.improvementLabel.textContent = improvement > 0
                    ? `${aName} improved the margin`
                    : improvement < 0
                        ? `${bName} clawed some back`
                        : 'Exact same margin as last time';
            }

            const streak = kindStreak(matches);
            els.streakValue.textContent = String(streak);
            els.streakLabel.textContent = streak > 1 ? `${streak} calm-ish matches in a row` : 'One logged match';
        }

        function renderChart() {
            const matches = state.matches;
            const width = 640;
            const height = 250;
            if (!matches.length) {
                els.trendChart.innerHTML = '';
                return;
            }

            const margins = matches.map(margin);
            const maxAbs = Math.max(4, ...margins.map(v => Math.abs(v)));
            const pad = 28;
            const usableW = width - pad * 2;
            const usableH = height - pad * 2;
            const midY = pad + usableH / 2;
            const stepX = matches.length === 1 ? 0 : usableW / (matches.length - 1);

            const points = margins.map((m, i) => {
                const x = pad + stepX * i;
                const y = midY - (m / maxAbs) * (usableH / 2 - 10);
                return [x, y];
            });

            const polyline = points.map(([x, y]) => `${x},${y}`).join(' ');
            const circles = points.map(([x, y], i) => `
                <circle cx="${x}" cy="${y}" r="6" fill="${margins[i] >= 0 ? '#79ffd5' : '#ff88d8'}" stroke="#120f22" stroke-width="3"></circle>
                <text x="${x}" y="${height - 8}" text-anchor="middle" fill="#b8b0d3" font-size="11">M${i + 1}</text>
            `).join('');

            const grid = [-maxAbs, -Math.ceil(maxAbs/2), 0, Math.ceil(maxAbs/2), maxAbs].map(value => {
                const y = midY - (value / maxAbs) * (usableH / 2 - 10);
                return `<line x1="${pad}" y1="${y}" x2="${width-pad}" y2="${y}" stroke="${value===0 ? 'rgba(255,211,109,0.5)' : 'rgba(255,255,255,0.09)'}" stroke-width="1"></line>
                        <text x="10" y="${y+4}" fill="#b8b0d3" font-size="11">${value > 0 ? '+' : ''}${value}</text>`;
            }).join('');

            els.trendChart.innerHTML = `
                <defs>
                    <linearGradient id="lineGlow" x1="0" x2="1">
                        <stop offset="0%" stop-color="#ff88d8"></stop>
                        <stop offset="100%" stop-color="#79ffd5"></stop>
                    </linearGradient>
                </defs>
                ${grid}
                <polyline fill="none" stroke="url(#lineGlow)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" points="${polyline}"></polyline>
                ${circles}
            `;
        }

        function renderSparkline() {
            const matches = state.matches.slice(-8);
            if (!matches.length) {
                els.sparkline.innerHTML = '';
                return;
            }
            const maxAbs = Math.max(3, ...matches.map(m => Math.abs(margin(m))));
            els.sparkline.innerHTML = matches.map((match, index) => {
                const value = margin(match);
                const height = 24 + (Math.abs(value) / maxAbs) * 72;
                return `<span class="${value < 0 ? 'loss' : ''}" style="height:${height}px" data-label="${index + 1}"></span>`;
            }).join('');
        }

        function renderHistory() {
            const aName = els.playerAName.value.trim() || 'Player A';
            const bName = els.playerBName.value.trim() || 'Player B';
            if (!state.matches.length) {
                els.matchList.innerHTML = '<div class="tiny">No matches yet. Mercifully no grudges either.</div>';
                return;
            }

            els.matchList.innerHTML = state.matches.slice().reverse().map((match, reverseIndex) => {
                const index = state.matches.length - reverseIndex;
                const diff = margin(match);
                const line = diff === 0 ? 'Dead even' : `${diff > 0 ? aName : bName} +${Math.abs(diff)}`;
                return `
                    <div class="match-item">
                        <div class="match-badge">${index}</div>
                        <div>
                            <strong>${aName} ${match.a} - ${match.b} ${bName}</strong>
                            <div class="tiny">Margin story: ${line}</div>
                        </div>
                        <div class="tiny">${formatMargin(diff)}</div>
                    </div>
                `;
            }).join('');
        }

        function renderSummary() {
            const matches = state.matches;
            const aName = els.playerAName.value.trim() || 'Player A';
            const bName = els.playerBName.value.trim() || 'Player B';
            if (matches.length < 2) {
                els.summaryText.textContent = 'One result is a mood. Two results start becoming a story.';
                els.challengeTitle.textContent = 'Beat your last margin by 1';
                els.challengeText.textContent = 'The cabinet is waiting for enough history to set a proper personal challenge.';
                els.coachQuote.textContent = '"The real flex is leaving the table in a better mood than when you sat down."';
                return;
            }

            const margins = matches.map(margin);
            const current = margins[margins.length - 1];
            const prev = margins[margins.length - 2];
            const delta = current - prev;
            const avg = margins.reduce((sum, value) => sum + value, 0) / margins.length;
            const leader = avg >= 0 ? aName : bName;
            const nextTarget = current + (current >= 0 ? 1 : 1);

            if (delta > 0) {
                els.summaryText.textContent = `${aName} improved the margin by ${delta} this round. Tiny victory parade permitted.`;
                els.coachQuote.textContent = '"You did better than last time. Do not ruin that achievement by being obnoxious about it."';
            } else if (delta < 0) {
                els.summaryText.textContent = `${bName} recovered ${Math.abs(delta)} points. The rivalry just got more interesting.`;
                els.coachQuote.textContent = '"Progress is not linear. Annoying, yes. Still true."';
            } else {
                els.summaryText.textContent = 'Exact same margin as last time. Incredibly suspicious symmetry.';
                els.coachQuote.textContent = '"Consistency is a real skill, even when it looks like chaos with a spreadsheet."';
            }

            els.challengeTitle.textContent = current >= 0
                ? `Next target: ${aName} to +${Math.abs(nextTarget)}`
                : `Next target: ${aName} to ${current + 1 >= 0 ? 'even' : formatMargin(current + 1)}`;
            els.challengeText.textContent = `Average cabinet edge: ${leader} by ${Math.abs(avg).toFixed(1)}. The game now is whether ${aName} can improve the personal margin, not whether ${bName} deserves theatrical despair.`;
        }

        function rerender() {
            saveState();
            renderMetrics();
            renderChart();
            renderSparkline();
            renderHistory();
            renderSummary();
        }

        function addMatch() {
            const a = Number(els.playerAScore.value);
            const b = Number(els.playerBScore.value);
            if (!Number.isFinite(a) || !Number.isFinite(b) || a < 0 || b < 0) return;
            state.matches.push({ a, b });
            rerender();
        }

        els.addMatch.addEventListener('click', addMatch);
        els.loadDemo.addEventListener('click', () => {
            state.matches = defaultMatches.slice();
            rerender();
        });
        els.clearAll.addEventListener('click', () => {
            state.matches = [];
            rerender();
        });
        els.playerAName.addEventListener('input', rerender);
        els.playerBName.addEventListener('input', rerender);
        document.querySelectorAll('.mantra').forEach(button => {
            button.addEventListener('click', () => {
                els.mantraText.textContent = `"${button.dataset.mantra}"`;
            });
        });
        [els.playerAScore, els.playerBScore].forEach(input => {
            input.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') addMatch();
            });
        });

        loadState();
        rerender();
    </script>
</body>
</html>
