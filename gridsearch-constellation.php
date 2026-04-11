<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GridSearch Constellation</title>
    <style>
        :root {
            --bg: #07111f;
            --bg-deep: #030812;
            --panel: rgba(10, 20, 36, 0.78);
            --panel-strong: rgba(14, 28, 50, 0.92);
            --line: rgba(151, 191, 255, 0.22);
            --text: #eef4ff;
            --muted: #9db4d6;
            --gold: #ffd77b;
            --cyan: #7ed6ff;
            --mint: #8fffd8;
            --rose: #ff9fd5;
            --violet: #a7a0ff;
            --shadow: 0 30px 70px rgba(0, 0, 0, 0.45);
            --radius: 26px;
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 20% 20%, rgba(126, 214, 255, 0.18), transparent 34%),
                radial-gradient(circle at 82% 18%, rgba(167, 160, 255, 0.2), transparent 28%),
                radial-gradient(circle at 50% 72%, rgba(255, 159, 213, 0.12), transparent 24%),
                linear-gradient(180deg, #0b1628 0%, #07111f 45%, #030812 100%);
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        body::before {
            opacity: 0.7;
            background-image:
                radial-gradient(circle at 15% 22%, rgba(255,255,255,0.9) 0 1px, transparent 2px),
                radial-gradient(circle at 72% 18%, rgba(255,255,255,0.75) 0 1px, transparent 2px),
                radial-gradient(circle at 30% 80%, rgba(255,255,255,0.65) 0 1px, transparent 2px),
                radial-gradient(circle at 88% 70%, rgba(255,255,255,0.8) 0 1px, transparent 2px),
                radial-gradient(circle at 52% 42%, rgba(255,255,255,0.72) 0 1px, transparent 2px),
                radial-gradient(circle at 10% 68%, rgba(255,255,255,0.7) 0 1px, transparent 2px),
                radial-gradient(circle at 64% 88%, rgba(255,255,255,0.55) 0 1px, transparent 2px);
            background-size: 260px 260px, 320px 320px, 300px 300px, 360px 360px, 280px 280px, 340px 340px, 380px 380px;
            animation: drift 36s linear infinite;
        }

        body::after {
            background:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.8), rgba(0,0,0,0.15));
        }

        @keyframes drift {
            from { transform: translateY(0); }
            to { transform: translateY(30px); }
        }

        .shell {
            position: relative;
            z-index: 1;
            width: min(1180px, calc(100% - 24px));
            margin: 0 auto;
            padding: 22px 0 56px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 26px;
            border-radius: 34px;
            border: 1px solid rgba(255,255,255,0.1);
            background:
                linear-gradient(140deg, rgba(15, 28, 50, 0.92), rgba(7, 14, 27, 0.78)),
                rgba(10, 20, 36, 0.78);
            box-shadow: var(--shadow);
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto -10% -45% auto;
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(255, 215, 123, 0.24), transparent 68%);
            filter: blur(10px);
        }

        .eyebrow {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--gold);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
        }

        h1, h2, h3 {
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            margin: 0;
            letter-spacing: 0.01em;
        }

        h1 {
            font-size: clamp(2.5rem, 6vw, 5.3rem);
            line-height: 0.96;
            margin-top: 18px;
            max-width: 10ch;
            text-wrap: balance;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 24px;
            margin-top: 20px;
            align-items: end;
        }

        .lede {
            font-size: 1.08rem;
            line-height: 1.72;
            color: #d5e4ff;
            max-width: 62ch;
            margin: 18px 0 0;
        }

        .hero-card {
            padding: 18px;
            border-radius: 24px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
        }

        .hero-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .hero-card strong {
            color: var(--text);
            font-weight: 700;
        }

        .layout {
            display: grid;
            grid-template-columns: 390px minmax(0, 1fr);
            gap: 22px;
            margin-top: 22px;
        }

        .panel {
            position: relative;
            background: var(--panel);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
            overflow: hidden;
        }

        .panel::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(180deg, rgba(255,255,255,0.05), transparent 28%);
        }

        .panel-inner {
            position: relative;
            padding: 22px;
        }

        .section-label {
            margin-bottom: 12px;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.75rem;
        }

        .composer textarea {
            width: 100%;
            min-height: 112px;
            resize: vertical;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 16px 18px;
            color: var(--text);
            background: rgba(2, 8, 18, 0.6);
            font: inherit;
            line-height: 1.55;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.02);
        }

        .composer textarea:focus,
        .chips button:focus,
        .control select:focus,
        .button:focus,
        .combo-card button:focus {
            outline: 2px solid var(--cyan);
            outline-offset: 2px;
        }

        .helper {
            margin: 10px 0 0;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .chips button,
        .button,
        .combo-card button,
        .pill {
            border: 0;
            border-radius: 999px;
            padding: 11px 15px;
            font: inherit;
            cursor: pointer;
            transition: transform 160ms ease, background 160ms ease, box-shadow 160ms ease, border-color 160ms ease;
        }

        .chips button {
            background: rgba(255,255,255,0.07);
            color: #d9e8ff;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .chips button:hover,
        .button:hover,
        .combo-card button:hover {
            transform: translateY(-1px);
        }

        .controls {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 18px;
        }

        .control label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 0.86rem;
        }

        .control select {
            width: 100%;
            appearance: none;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            padding: 12px 14px;
            color: var(--text);
            font: inherit;
            background: rgba(2, 8, 18, 0.74);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }

        .button.primary {
            background: linear-gradient(135deg, var(--gold), #ffb85c);
            color: #1a1420;
            font-weight: 800;
            box-shadow: 0 18px 34px rgba(255, 186, 92, 0.22);
        }

        .button.secondary {
            color: var(--text);
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .button.ghost {
            color: var(--mint);
            background: rgba(143, 255, 216, 0.08);
            border: 1px solid rgba(143, 255, 216, 0.15);
        }

        .microcopy {
            margin-top: 16px;
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.55;
        }

        .dashboard {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(280px, 0.95fr);
            gap: 18px;
        }

        .sky {
            min-height: 390px;
            position: relative;
            overflow: hidden;
            border-radius: 26px;
            background:
                radial-gradient(circle at center, rgba(255,255,255,0.06) 0 1px, transparent 1px),
                radial-gradient(circle at 50% 42%, rgba(167, 160, 255, 0.14), transparent 40%),
                linear-gradient(180deg, rgba(8,16,29,0.96), rgba(5,10,20,0.98));
            border: 1px solid rgba(255,255,255,0.07);
        }

        .sky-grid {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 56px 56px;
            mask-image: radial-gradient(circle at center, rgba(0,0,0,0.95), rgba(0,0,0,0.28));
            opacity: 0.2;
        }

        .sky svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .sky-caption {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 16px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            color: var(--muted);
            font-size: 0.86rem;
        }

        .spotlight {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .insight-card {
            padding: 18px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.07), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.08);
            min-height: 124px;
        }

        .insight-card h3 {
            font-size: 1.45rem;
            margin-bottom: 10px;
        }

        .insight-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .metric-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .metric {
            padding: 15px 14px;
            border-radius: 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .metric .value {
            display: block;
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 4px;
        }

        .metric .label {
            color: var(--muted);
            font-size: 0.84rem;
            line-height: 1.4;
        }

        .combos-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-top: 24px;
            margin-bottom: 16px;
        }

        .combos-head p {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .combo-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .combo-card {
            padding: 18px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(13, 25, 45, 0.92), rgba(8, 15, 28, 0.94));
            border: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            gap: 14px;
            min-height: 210px;
        }

        .combo-card.active {
            border-color: rgba(255, 215, 123, 0.6);
            box-shadow: 0 0 0 1px rgba(255, 215, 123, 0.22), 0 18px 30px rgba(0,0,0,0.26);
        }

        .combo-labels {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.08);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.09);
            padding: 9px 12px;
        }

        .pill:nth-child(1) { box-shadow: inset 0 0 0 1px rgba(126,214,255,0.22); }
        .pill:nth-child(2) { box-shadow: inset 0 0 0 1px rgba(255,215,123,0.22); }
        .pill:nth-child(3) { box-shadow: inset 0 0 0 1px rgba(143,255,216,0.22); }
        .pill:nth-child(4) { box-shadow: inset 0 0 0 1px rgba(255,159,213,0.22); }

        .query-box {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px dashed rgba(255,255,255,0.12);
            color: #d8e7ff;
            line-height: 1.55;
            word-break: break-word;
            font-size: 0.96rem;
        }

        .combo-meta {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            color: var(--muted);
            font-size: 0.85rem;
        }

        .combo-card button {
            align-self: flex-start;
            background: rgba(126, 214, 255, 0.12);
            color: var(--cyan);
            border: 1px solid rgba(126,214,255,0.18);
            font-weight: 700;
        }

        .footer-note {
            margin-top: 16px;
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.6;
        }

        .toast {
            position: fixed;
            left: 50%;
            bottom: 18px;
            transform: translateX(-50%) translateY(120px);
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(6, 14, 25, 0.92);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: var(--shadow);
            z-index: 5;
            transition: transform 180ms ease;
            pointer-events: none;
        }

        .toast.show {
            transform: translateX(-50%) translateY(0);
        }

        @media (max-width: 980px) {
            .hero-grid,
            .layout,
            .dashboard,
            .combo-grid {
                grid-template-columns: 1fr;
            }

            .metric-strip {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .shell {
                width: min(100% - 14px, 1180px);
                padding-top: 12px;
            }

            .hero,
            .panel-inner {
                padding: 18px;
            }

            h1 {
                font-size: clamp(2.2rem, 12vw, 3.8rem);
            }

            .controls,
            .metric-strip {
                grid-template-columns: 1fr;
            }

            .sky {
                min-height: 320px;
            }

            .combo-card {
                min-height: auto;
            }

            .sky-caption,
            .combos-head {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="eyebrow">Inspired by Jon's 2008 GridSearch post</div>
            <div class="hero-grid">
                <div>
                    <h1>GridSearch Constellation</h1>
                    <p class="lede">Drop in a handful of interests, obsessions, or rabbit holes, and this little observatory will turn them into search-ready constellations. It is part combinatorics toy, part brainstorming engine, part elegant excuse to chase weirdly specific corners of the web.</p>
                </div>
                <div class="hero-card">
                    <p><strong>Design direction:</strong> midnight observatory. Instead of a plain utility, this page treats keyword combinations like stars, letting patterns emerge visually so the best trios feel discovered, not merely generated.</p>
                </div>
            </div>
        </section>

        <div class="layout">
            <section class="panel composer">
                <div class="panel-inner">
                    <div class="section-label">Compose your sky</div>
                    <h2>Interests in, combinations out</h2>
                    <p class="helper">Use one item per line, or separate with commas. Short punchy phrases work best: <em>retro computing</em>, <em>rosary art</em>, <em>beamng drive</em>, <em>fish shell</em>.</p>
                    <textarea id="interestInput">retro computing
Legend of Zelda
Catholic art
AI coding tools
jigsaw puzzles
Knight Rider</textarea>

                    <div class="chips" id="presetChips">
                        <button type="button" data-preset="jon">Jon mode</button>
                        <button type="button" data-preset="nathan">Nathan mode</button>
                        <button type="button" data-preset="catholic">Catholic mode</button>
                        <button type="button" data-preset="maker">Maker mode</button>
                    </div>

                    <div class="controls">
                        <div class="control">
                            <label for="sizeSelect">Keywords per constellation</label>
                            <select id="sizeSelect">
                                <option value="2">2</option>
                                <option value="3" selected>3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="control">
                            <label for="sortSelect">Sort by</label>
                            <select id="sortSelect">
                                <option value="spark">Spark score</option>
                                <option value="balanced">Balanced variety</option>
                                <option value="alpha">Alphabetical</option>
                                <option value="novelty">Novelty</option>
                            </select>
                        </div>
                    </div>

                    <div class="actions">
                        <button class="button primary" type="button" id="generateBtn">Generate constellation</button>
                        <button class="button secondary" type="button" id="surpriseBtn">Surprise me</button>
                        <button class="button ghost" type="button" id="copyBestBtn">Copy top query</button>
                    </div>

                    <p class="microcopy">The original blog post sent combinations straight into search engines. This version stays self-contained and gives you the tasty part: the combinations themselves, ranked and ready to copy. Sometimes the internet does not need more chrome. It needs better bait.</p>
                </div>
            </section>

            <section class="panel results-panel">
                <div class="panel-inner">
                    <div class="section-label">Observatory</div>
                    <div class="dashboard">
                        <div class="sky" id="skyPanel" aria-label="Constellation view">
                            <div class="sky-grid"></div>
                            <svg id="skySvg" viewBox="0 0 640 420" preserveAspectRatio="none" aria-hidden="true"></svg>
                            <div class="sky-caption">
                                <span id="skyCaptionLeft">Waiting for a fresh set of stars.</span>
                                <span id="skyCaptionRight">Tap a card to spotlight it.</span>
                            </div>
                        </div>
                        <div class="spotlight">
                            <div class="insight-card">
                                <div class="section-label">Spotlight</div>
                                <h3 id="spotlightTitle">No constellation selected yet</h3>
                                <p id="spotlightBody">Generate a set, then tap any combination card to see its shape, score, and why it might lead somewhere deliciously specific.</p>
                            </div>
                            <div class="metric-strip">
                                <div class="metric">
                                    <span class="value" id="comboCount">0</span>
                                    <span class="label">constellations generated</span>
                                </div>
                                <div class="metric">
                                    <span class="value" id="interestCount">0</span>
                                    <span class="label">interests in orbit</span>
                                </div>
                                <div class="metric">
                                    <span class="value" id="topScore">0</span>
                                    <span class="label">best spark score</span>
                                </div>
                            </div>
                            <div class="insight-card">
                                <div class="section-label">Best query</div>
                                <h3 id="bestQueryTitle">Nothing yet</h3>
                                <p id="bestQueryReason">We will crown a winner once you generate the field.</p>
                            </div>
                        </div>
                    </div>

                    <div class="combos-head">
                        <div>
                            <h2>Discovery deck</h2>
                            <p>These are your most promising combinations. The score is gloriously subjective, which is half the fun.</p>
                        </div>
                    </div>
                    <div class="combo-grid" id="comboGrid"></div>
                    <p class="footer-note">Tip: mix one broad thing, one niche thing, and one delightfully human thing. For example: <em>DBS adjustment</em> + <em>retro computing</em> + <em>attachment parenting</em>. The web gets wonderfully strange when you ask it very specific questions.</p>
                </div>
            </section>
        </div>
    </div>

    <div class="toast" id="toast">Copied</div>

    <script>
        const presets = {
            jon: ["OpenClaw", "retro computing", "Catholic art", "Fish shell", "AI coding tools", "jigsaw puzzles", "Hacker News"],
            nathan: ["Knight Rider", "Legend of Zelda", "BeamNG Drive", "Harry Potter", "vintage cars", "The Wild Robot", "Super Mario"],
            catholic: ["rosary art", "saints", "Gregorian chant", "Aquinas", "lectio divina", "cathedrals", "daily examen"],
            maker: ["3D printing", "tmux", "Yubnub", "browser tools", "window managers", "CLI automation", "PHP experiments"]
        };

        const surpriseSets = [
            ["Catholic art", "Legend of Zelda", "jigsaw puzzles", "AI coding tools", "Knight Rider", "retro computing"],
            ["Obsidian notes", "saints", "BeamNG Drive", "3D printing", "Hacker News", "family rituals"],
            ["Aquinas", "Ghostty terminal", "vintage cars", "fleurons", "Mario music", "Rosary"],
            ["browser extensions", "Our Lady", "Apple IIc", "attachment parenting", "puzzles", "railway maps"]
        ];

        const state = {
            combos: [],
            activeIndex: 0,
            interests: []
        };

        const input = document.getElementById('interestInput');
        const sizeSelect = document.getElementById('sizeSelect');
        const sortSelect = document.getElementById('sortSelect');
        const comboGrid = document.getElementById('comboGrid');
        const skySvg = document.getElementById('skySvg');
        const comboCount = document.getElementById('comboCount');
        const interestCount = document.getElementById('interestCount');
        const topScore = document.getElementById('topScore');
        const spotlightTitle = document.getElementById('spotlightTitle');
        const spotlightBody = document.getElementById('spotlightBody');
        const bestQueryTitle = document.getElementById('bestQueryTitle');
        const bestQueryReason = document.getElementById('bestQueryReason');
        const skyCaptionLeft = document.getElementById('skyCaptionLeft');
        const skyCaptionRight = document.getElementById('skyCaptionRight');
        const toast = document.getElementById('toast');

        function parseInterests(raw) {
            return [...new Set(
                raw
                    .split(/[\n,]+/)
                    .map(item => item.trim())
                    .filter(Boolean)
                    .map(item => item.replace(/\s+/g, ' '))
            )];
        }

        function buildCombinations(items, size, start = 0, prefix = [], acc = []) {
            if (prefix.length === size) {
                acc.push(prefix);
                return acc;
            }
            for (let i = start; i <= items.length - (size - prefix.length); i += 1) {
                buildCombinations(items, size, i + 1, [...prefix, items[i]], acc);
            }
            return acc;
        }

        function averageWordLength(combo) {
            const words = combo.join(' ').split(/\s+/).filter(Boolean);
            const total = words.reduce((sum, word) => sum + word.length, 0);
            return words.length ? total / words.length : 0;
        }

        function categoryVariety(combo) {
            const buckets = combo.map(item => {
                const lower = item.toLowerCase();
                if (/(saint|rosary|aquinas|catholic|lectio|our lady|chant|cathedral|examen)/.test(lower)) return 'spirit';
                if (/(zelda|mario|knight rider|beamng|harry potter|wild robot|car|cars|arcade)/.test(lower)) return 'play';
                if (/(ai|php|shell|terminal|tmux|yubnub|browser|coding|automation|obsidian|hacker news|ghostty)/.test(lower)) return 'tech';
                if (/(puzzle|family|parenting|ritual|art|music|books|poetry)/.test(lower)) return 'human';
                return 'wild';
            });
            return new Set(buckets).size;
        }

        function scoreCombo(combo) {
            const lengths = combo.map(item => item.length);
            const balance = 100 - Math.min(60, Math.max(...lengths) - Math.min(...lengths));
            const variety = categoryVariety(combo) * 12;
            const wordAvg = averageWordLength(combo);
            const novelty = combo.reduce((sum, item) => sum + new Set(item.toLowerCase().replace(/[^a-z0-9]/g, '')).size, 0);
            const spark = Math.round(balance * 0.35 + variety + wordAvg * 4 + novelty * 0.9);
            return {
                spark,
                balanced: Math.round(balance + variety * 1.5),
                novelty: Math.round(novelty + variety * 5),
                alpha: combo.join(' · ').toLowerCase()
            };
        }

        function reasonFor(combo, scores) {
            const variety = categoryVariety(combo);
            if (variety >= 3) {
                return 'Strong cross-pollination. These ideas come from different corners, which makes the resulting search feel less obvious and more fruitful.';
            }
            if (scores.novelty > 46) {
                return 'High novelty. There is enough texture in these terms that the combination should pull in quirky, specific pages instead of mush.';
            }
            if (combo.some(item => item.split(/\s+/).length > 2)) {
                return 'Nicely precise. One phrase here acts like a narrowing lens, which is very GridSearch of it.';
            }
            return 'Compact and practical. This is the sort of trio that can turn up tidy recommendation lists without too much noise.';
        }

        function sortCombos(combos, mode) {
            const sorted = [...combos];
            sorted.sort((a, b) => {
                if (mode === 'alpha') return a.scores.alpha.localeCompare(b.scores.alpha);
                return b.scores[mode] - a.scores[mode];
            });
            return sorted;
        }

        function renderSky(activeCombo) {
            skySvg.innerHTML = '';
            if (!activeCombo) return;

            const colors = ['#7ed6ff', '#ffd77b', '#8fffd8', '#ff9fd5'];
            const positions = activeCombo.combo.map((label, index) => {
                const angle = ((Math.PI * 2) / activeCombo.combo.length) * index - Math.PI / 2;
                const radius = 120 + (index % 2) * 24;
                const cx = 320 + Math.cos(angle) * radius;
                const cy = 200 + Math.sin(angle) * radius;
                return { label, cx, cy, color: colors[index % colors.length] };
            });

            const lineGroup = document.createElementNS('http://www.w3.org/2000/svg', 'g');
            positions.forEach((point, index) => {
                const next = positions[(index + 1) % positions.length];
                const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                line.setAttribute('x1', point.cx);
                line.setAttribute('y1', point.cy);
                line.setAttribute('x2', next.cx);
                line.setAttribute('y2', next.cy);
                line.setAttribute('stroke', 'rgba(255,255,255,0.25)');
                line.setAttribute('stroke-width', '2');
                line.setAttribute('stroke-dasharray', '6 10');
                lineGroup.appendChild(line);
            });
            skySvg.appendChild(lineGroup);

            positions.forEach((point, index) => {
                const glow = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                glow.setAttribute('cx', point.cx);
                glow.setAttribute('cy', point.cy);
                glow.setAttribute('r', '22');
                glow.setAttribute('fill', point.color + '24');
                skySvg.appendChild(glow);

                const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                circle.setAttribute('cx', point.cx);
                circle.setAttribute('cy', point.cy);
                circle.setAttribute('r', index === 0 ? '8' : '6');
                circle.setAttribute('fill', point.color);
                circle.setAttribute('stroke', 'rgba(255,255,255,0.8)');
                circle.setAttribute('stroke-width', '1');
                skySvg.appendChild(circle);

                const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                text.setAttribute('x', point.cx);
                text.setAttribute('y', point.cy + 34);
                text.setAttribute('fill', '#eef4ff');
                text.setAttribute('font-size', '15');
                text.setAttribute('font-family', 'Trebuchet MS, sans-serif');
                text.setAttribute('text-anchor', 'middle');
                text.textContent = point.label;
                skySvg.appendChild(text);
            });

            skyCaptionLeft.textContent = activeCombo.combo.join(' • ');
            skyCaptionRight.textContent = 'Spark score ' + activeCombo.scores.spark + ' • Tap Copy on any card to pocket it.';
        }

        function showToast(message) {
            toast.textContent = message;
            toast.classList.add('show');
            clearTimeout(showToast.timer);
            showToast.timer = setTimeout(() => toast.classList.remove('show'), 1600);
        }

        async function copyText(value, successMessage = 'Copied to clipboard') {
            try {
                await navigator.clipboard.writeText(value);
                showToast(successMessage);
            } catch (error) {
                showToast('Clipboard blocked, sorry');
            }
        }

        function renderCards() {
            comboGrid.innerHTML = '';
            state.combos.slice(0, 8).forEach((item, index) => {
                const card = document.createElement('article');
                card.className = 'combo-card' + (index === state.activeIndex ? ' active' : '');
                card.innerHTML = `
                    <div class="combo-labels">
                        ${item.combo.map(label => `<span class="pill">${label}</span>`).join('')}
                    </div>
                    <div class="query-box">${item.query}</div>
                    <div class="combo-meta">
                        <span>Spark ${item.scores.spark}</span>
                        <span>Variety ${categoryVariety(item.combo)}/4</span>
                    </div>
                    <p class="helper" style="margin:0;">${item.reason}</p>
                    <button type="button">Copy query</button>
                `;

                card.addEventListener('click', (event) => {
                    if (event.target.tagName.toLowerCase() !== 'button') {
                        state.activeIndex = index;
                        renderActive();
                    }
                });

                card.querySelector('button').addEventListener('click', (event) => {
                    event.stopPropagation();
                    copyText(item.query, 'Query copied');
                });

                comboGrid.appendChild(card);
            });
        }

        function renderActive() {
            const active = state.combos[state.activeIndex];
            renderCards();
            renderSky(active);
            if (!active) return;
            spotlightTitle.textContent = active.combo.join(' + ');
            spotlightBody.textContent = active.reason;
        }

        function generate() {
            const interests = parseInterests(input.value);
            state.interests = interests;
            const size = Number(sizeSelect.value);
            const mode = sortSelect.value;

            if (interests.length < size) {
                state.combos = [];
                state.activeIndex = 0;
                comboGrid.innerHTML = '<div class="insight-card"><h3>Need a few more stars</h3><p>Add at least ' + size + ' interests to generate combinations.</p></div>';
                comboCount.textContent = '0';
                interestCount.textContent = String(interests.length);
                topScore.textContent = '0';
                bestQueryTitle.textContent = 'Not enough interests yet';
                bestQueryReason.textContent = 'A constellation with one star is just optimism.';
                spotlightTitle.textContent = 'No constellation selected yet';
                spotlightBody.textContent = 'Add more ingredients and try again.';
                renderSky(null);
                return;
            }

            const rawCombos = buildCombinations(interests, size).map(combo => {
                const scores = scoreCombo(combo);
                return {
                    combo,
                    query: combo.join(' '),
                    scores,
                    reason: reasonFor(combo, scores)
                };
            });

            state.combos = sortCombos(rawCombos, mode);
            state.activeIndex = 0;

            comboCount.textContent = String(rawCombos.length);
            interestCount.textContent = String(interests.length);
            topScore.textContent = String(state.combos[0]?.scores.spark || 0);
            bestQueryTitle.textContent = state.combos[0]?.query || 'Nothing yet';
            bestQueryReason.textContent = state.combos[0]?.reason || 'No winner yet.';
            renderActive();
        }

        document.getElementById('generateBtn').addEventListener('click', generate);
        document.getElementById('copyBestBtn').addEventListener('click', () => {
            if (state.combos[0]) {
                copyText(state.combos[0].query, 'Top query copied');
            } else {
                showToast('Generate first');
            }
        });

        document.getElementById('surpriseBtn').addEventListener('click', () => {
            const picked = surpriseSets[Math.floor(Math.random() * surpriseSets.length)];
            input.value = picked.join('\n');
            generate();
            showToast('Fresh sky loaded');
        });

        document.getElementById('presetChips').addEventListener('click', (event) => {
            const button = event.target.closest('button[data-preset]');
            if (!button) return;
            input.value = presets[button.dataset.preset].join('\n');
            generate();
        });

        sortSelect.addEventListener('change', generate);
        sizeSelect.addEventListener('change', generate);

        generate();
    </script>
</body>
</html>
