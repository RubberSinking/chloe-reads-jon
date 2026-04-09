<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge Conflict Dojo</title>
    <style>
        :root {
            --bg: #0e0c16;
            --panel: rgba(20, 18, 33, 0.88);
            --panel-strong: #171427;
            --ink: #f6f2ea;
            --muted: #b7adcb;
            --gold: #f5c86b;
            --rose: #ff8fab;
            --cyan: #89f0ff;
            --green: #9bffb0;
            --border: rgba(255,255,255,0.1);
            --shadow: 0 30px 80px rgba(0,0,0,0.45);
            --radius: 24px;
            --code: "Courier New", Courier, monospace;
            --display: "Palatino Linotype", "Book Antiqua", Palatino, Georgia, serif;
            --body: "Trebuchet MS", Verdana, sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--body);
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(137,240,255,0.12), transparent 30%),
                radial-gradient(circle at 85% 10%, rgba(245,200,107,0.14), transparent 24%),
                radial-gradient(circle at bottom right, rgba(255,143,171,0.12), transparent 30%),
                linear-gradient(180deg, #120f1e 0%, #0e0c16 45%, #090710 100%);
            overflow-x: hidden;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
            background-size: 100px 100px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.8), transparent 85%);
        }
        a { color: var(--cyan); }
        .shell {
            width: min(1200px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 56px;
            position: relative;
        }
        .hero {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: calc(var(--radius) + 8px);
            background: linear-gradient(140deg, rgba(27,24,43,0.95), rgba(15,13,24,0.92));
            box-shadow: var(--shadow);
        }
        .hero::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            top: -90px;
            right: -40px;
            background: radial-gradient(circle, rgba(245,200,107,0.24), transparent 68%);
            filter: blur(12px);
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border: 1px solid rgba(245,200,107,0.24);
            border-radius: 999px;
            color: var(--gold);
            background: rgba(245,200,107,0.08);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.74rem;
        }
        h1 {
            margin: 18px 0 14px;
            font-family: var(--display);
            font-size: clamp(2.5rem, 6vw, 5rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            max-width: 9ch;
        }
        .hero-copy {
            max-width: 64ch;
            color: var(--muted);
            font-size: 1.04rem;
            line-height: 1.7;
        }
        .hero-grid {
            margin-top: 26px;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 18px;
        }
        .stat-strip, .tip-card, .main-card, .lesson-card, .scenario-list, .composer-card, .judge-card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--panel);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }
        .stat-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            overflow: hidden;
            background: linear-gradient(90deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
        }
        .stat {
            padding: 18px;
            background: rgba(10,9,16,0.7);
        }
        .stat-label {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.72rem;
        }
        .stat-value {
            margin-top: 10px;
            font-size: 1.9rem;
            font-weight: 700;
        }
        .tip-card {
            padding: 20px;
        }
        .tip-card h2,
        .scenario-list h2,
        .lesson-card h2,
        .composer-card h2,
        .judge-card h2 {
            margin: 0 0 10px;
            font-size: 1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--gold);
        }
        .tip-card p,
        .lesson-card p,
        .judge-card p,
        .scenario-item p,
        .composer-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }
        .workspace {
            margin-top: 22px;
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }
        .scenario-list {
            padding: 18px;
            position: sticky;
            top: 18px;
        }
        .scenario-items {
            display: grid;
            gap: 12px;
            margin-top: 14px;
        }
        .scenario-item {
            width: 100%;
            text-align: left;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: rgba(255,255,255,0.03);
            padding: 14px 14px 15px;
            color: var(--ink);
            cursor: pointer;
            transition: transform 140ms ease, border-color 140ms ease, background 140ms ease;
        }
        .scenario-item:hover,
        .scenario-item:focus-visible {
            transform: translateY(-2px);
            border-color: rgba(137,240,255,0.4);
            outline: none;
        }
        .scenario-item.active {
            border-color: rgba(245,200,107,0.45);
            background: linear-gradient(180deg, rgba(245,200,107,0.12), rgba(255,255,255,0.04));
        }
        .scenario-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 6px;
        }
        .scenario-title { font-weight: 700; }
        .scenario-badge {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--cyan);
        }
        .scenario-item.completed .scenario-badge { color: var(--green); }
        .main-column {
            display: grid;
            gap: 18px;
        }
        .main-card { padding: 18px; }
        .card-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: start;
            margin-bottom: 16px;
        }
        .card-head h2 {
            margin: 0;
            font-family: var(--display);
            font-size: clamp(1.6rem, 3vw, 2.5rem);
        }
        .card-head p {
            margin: 8px 0 0;
            color: var(--muted);
            max-width: 64ch;
            line-height: 1.65;
        }
        .chip {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(137,240,255,0.08);
            border: 1px solid rgba(137,240,255,0.18);
            color: var(--cyan);
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .panes {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }
        .pane {
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            background: rgba(6, 7, 12, 0.84);
        }
        .pane-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 14px;
            background: rgba(255,255,255,0.04);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-size: 0.86rem;
        }
        .pane-head strong { font-weight: 700; }
        .pane-label { color: var(--muted); }
        .code {
            margin: 0;
            padding: 14px;
            min-height: 240px;
            white-space: pre-wrap;
            font-family: var(--code);
            font-size: 0.93rem;
            line-height: 1.6;
            color: #f9f5f0;
            overflow: auto;
        }
        .code .line { display: block; padding: 0 8px; border-radius: 8px; }
        .code .line.same { opacity: 0.7; }
        .code .line.changed { background: rgba(245,200,107,0.12); }
        .code .line.added { background: rgba(155,255,176,0.12); }
        .code .line.removed { background: rgba(255,143,171,0.12); }
        .lesson-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }
        .lesson-card, .composer-card, .judge-card { padding: 18px; }
        .options {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }
        .option {
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 14px;
            background: rgba(255,255,255,0.03);
        }
        .option-header {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }
        .option label {
            display: flex;
            gap: 10px;
            cursor: pointer;
            font-weight: 700;
        }
        .option input { margin-top: 2px; }
        .option pre, textarea {
            width: 100%;
            margin: 0;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(8,10,18,0.95);
            color: #fbf7ee;
            font-family: var(--code);
            font-size: 0.92rem;
            line-height: 1.55;
        }
        .option pre { padding: 12px; white-space: pre-wrap; }
        textarea {
            min-height: 220px;
            padding: 14px;
            resize: vertical;
        }
        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 14px;
        }
        button {
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            font: inherit;
            cursor: pointer;
            transition: transform 140ms ease, filter 140ms ease, background 140ms ease;
        }
        button:hover,
        button:focus-visible { transform: translateY(-1px); filter: brightness(1.05); outline: none; }
        .primary {
            background: linear-gradient(135deg, var(--gold), #ffe4a3);
            color: #231707;
            font-weight: 700;
        }
        .secondary {
            background: rgba(255,255,255,0.07);
            color: var(--ink);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .ghost {
            background: rgba(137,240,255,0.08);
            color: var(--cyan);
            border: 1px solid rgba(137,240,255,0.18);
        }
        .judge-card .result {
            margin-top: 14px;
            padding: 14px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.03);
            min-height: 78px;
            line-height: 1.65;
            color: var(--muted);
        }
        .result.good { border-color: rgba(155,255,176,0.25); color: #d7ffe0; background: rgba(155,255,176,0.08); }
        .result.bad { border-color: rgba(255,143,171,0.25); color: #ffd5de; background: rgba(255,143,171,0.08); }
        .result.mixed { border-color: rgba(245,200,107,0.25); color: #fff0cd; background: rgba(245,200,107,0.08); }
        .preview {
            margin-top: 14px;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(7,8,13,0.9);
        }
        .preview-head {
            padding: 10px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--muted);
        }
        .preview pre {
            margin: 0;
            padding: 14px;
            white-space: pre-wrap;
            font-family: var(--code);
            line-height: 1.55;
            color: #f9f5f0;
            min-height: 200px;
        }
        .footer-note {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 0.92rem;
        }
        @media (max-width: 980px) {
            .hero-grid,
            .workspace,
            .lesson-grid,
            .panes { grid-template-columns: 1fr; }
            .scenario-list { position: static; }
            .stat-strip { grid-template-columns: 1fr; }
        }
        @media (max-width: 680px) {
            .shell { width: min(100% - 18px, 1200px); padding-top: 18px; }
            .hero, .main-card, .scenario-list, .lesson-card, .composer-card, .judge-card { padding: 16px; border-radius: 20px; }
            .card-head { flex-direction: column; }
            .code { min-height: 180px; font-size: 0.84rem; }
            textarea { min-height: 180px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="eyebrow">Three panes, one clean merge</div>
            <h1>Merge Conflict Dojo</h1>
            <p class="hero-copy">Jon once pointed out the obvious thing people somehow still ignore: if you are resolving a merge conflict, you need the common ancestor. This little dojo turns that instinct into a hands-on game. Study what changed on both sides, compose the best merge, and let the judge tell you whether you actually merged the intent, not just the text.</p>
            <div class="hero-grid">
                <div class="stat-strip">
                    <div class="stat">
                        <div class="stat-label">Scenarios</div>
                        <div class="stat-value"><span id="doneCount">0</span>/4</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Current lesson</div>
                        <div class="stat-value" id="lessonName">See the base</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Merge style</div>
                        <div class="stat-value" id="styleName">Balanced</div>
                    </div>
                </div>
                <aside class="tip-card">
                    <h2>Why this matters</h2>
                    <p>If local and remote both differ from the same ancestor, you can tell whether they made the same change, competing changes, or changes that should be combined. Without the ancestor, you are basically doing surgery in a dimly lit hallway.</p>
                </aside>
            </div>
        </section>

        <section class="workspace">
            <aside class="scenario-list">
                <h2>Conflict ladder</h2>
                <p>Start anywhere, but the cases get trickier as you go.</p>
                <div class="scenario-items" id="scenarioItems"></div>
            </aside>

            <div class="main-column">
                <section class="main-card">
                    <div class="card-head">
                        <div>
                            <div class="chip" id="difficultyChip">Warm-up</div>
                            <h2 id="scenarioTitle">Loading...</h2>
                            <p id="scenarioDescription"></p>
                        </div>
                        <div class="chip" id="scenarioGoal">Goal</div>
                    </div>
                    <div class="panes">
                        <article class="pane">
                            <div class="pane-head"><strong>Remote</strong><span class="pane-label">teammate changes</span></div>
                            <pre class="code" id="remotePane"></pre>
                        </article>
                        <article class="pane">
                            <div class="pane-head"><strong>Ancestor</strong><span class="pane-label">common base</span></div>
                            <pre class="code" id="ancestorPane"></pre>
                        </article>
                        <article class="pane">
                            <div class="pane-head"><strong>Local</strong><span class="pane-label">your branch</span></div>
                            <pre class="code" id="localPane"></pre>
                        </article>
                    </div>
                </section>

                <section class="lesson-grid">
                    <article class="lesson-card">
                        <h2>Read the room</h2>
                        <p id="insightText"></p>
                    </article>
                    <article class="lesson-card">
                        <h2>When people go wrong</h2>
                        <p id="trapText"></p>
                    </article>
                </section>

                <section class="composer-card">
                    <h2>Compose the merged file</h2>
                    <p>Try the obvious shortcuts if you want, but the best answer is often a careful combination. The live preview below shows what your final file will look like.</p>
                    <div class="options">
                        <div class="option">
                            <div class="option-header">
                                <label><input type="radio" name="mergeMode" value="local"> Use local wholesale</label>
                                <span class="scenario-badge">fast but risky</span>
                            </div>
                            <pre id="localOption"></pre>
                        </div>
                        <div class="option">
                            <div class="option-header">
                                <label><input type="radio" name="mergeMode" value="remote"> Use remote wholesale</label>
                                <span class="scenario-badge">also risky</span>
                            </div>
                            <pre id="remoteOption"></pre>
                        </div>
                        <div class="option">
                            <div class="option-header">
                                <label><input type="radio" name="mergeMode" value="manual" checked> Manual merge</label>
                                <span class="scenario-badge">the grown-up answer</span>
                            </div>
                            <textarea id="manualMerge" spellcheck="false"></textarea>
                        </div>
                    </div>
                    <div class="preview">
                        <div class="preview-head">Live merged result</div>
                        <pre id="previewPane"></pre>
                    </div>
                    <div class="action-row">
                        <button class="primary" id="checkBtn">Judge my merge</button>
                        <button class="secondary" id="hintBtn">Reveal a hint</button>
                        <button class="ghost" id="resetBtn">Reset this scenario</button>
                    </div>
                </section>

                <section class="judge-card">
                    <h2>Judge</h2>
                    <p>The judge checks whether you preserved the intent from both branches.</p>
                    <div class="result" id="resultBox">Pick a scenario, examine the ancestor, then build your merge.</div>
                </section>
            </div>
        </section>

        <p class="footer-note">Inspired by Jon's 2016 post urging people to resolve conflicts with a proper three-way diff. Correctly merging code is less about heroics and more about actually seeing what changed.</p>
    </div>

    <script>
        const scenarios = [
            {
                title: 'Greeting helper',
                difficulty: 'Warm-up',
                description: 'One side makes the greeting friendlier, the other makes it more flexible by trimming input. The correct merge keeps both improvements.',
                goal: 'Keep the friendlier wording and the safer input handling.',
                insight: 'The ancestor shows that both branches changed different parts of the same function. That usually means you want a blend, not a winner.',
                trap: 'Picking remote loses the trimming. Picking local loses the nicer greeting. The merge tool is not asking you to choose a parent in a custody battle.',
                hint: 'Look for one wording improvement and one defensive-programming improvement.',
                ancestor: `function greet(name) {\n  return "Hello, " + name;\n}`,
                remote: `function greet(name) {\n  return "Hello there, " + name + "!";\n}`,
                local: `function greet(name) {\n  return "Hello, " + name.trim();\n}`,
                solution: `function greet(name) {\n  return "Hello there, " + name.trim() + "!";\n}`,
                explanation: 'Nice. You kept the friendlier copy from remote and the safer trim from local. That is exactly why the ancestor pane earns its keep.'
            },
            {
                title: 'Shipping label card',
                difficulty: 'Journeyman',
                description: 'The remote branch improves the visible label, while local fixes the address formatting and adds province spacing. Users deserve both.',
                goal: 'Preserve the clearer label and the fixed formatting.',
                insight: 'Ancestor first: remote changed the heading text, local changed string formatting. Once you see the split, the merge becomes almost boring.',
                trap: 'If you take local wholesale, you regress the UX copy. If you take remote wholesale, you keep the old formatting bug.',
                hint: 'The final output should still say Delivery address, but it should use a comma before the province.',
                ancestor: `function formatAddress(city, province) {\n  return city + " " + province;\n}\n\nconst label = "Ship to:";`,
                remote: `function formatAddress(city, province) {\n  return city + " " + province;\n}\n\nconst label = "Delivery address:";`,
                local: `function formatAddress(city, province) {\n  return city + ", " + province;\n}\n\nconst label = "Ship to:";`,
                solution: `function formatAddress(city, province) {\n  return city + ", " + province;\n}\n\nconst label = "Delivery address:";`,
                explanation: 'Exactly right. Remote improved the words humans see. Local improved the formatting humans need. Both matter.'
            },
            {
                title: 'SQL intent check',
                difficulty: 'Tricky',
                description: 'One branch narrows the query to active users only. The other makes sorting deterministic and a little easier to scan. Do not lose either reason.',
                goal: 'Keep the active-user filter and the alphabetical ordering.',
                insight: 'This is a classic intent merge. The ancestor makes it obvious that the branches touched different clauses of the same query.',
                trap: 'Developers often accept whichever side looks more complete. That is how regressions get shipped with impressive confidence.',
                hint: 'The final query needs both WHERE active = 1 and ORDER BY last_name.',
                ancestor: `SELECT id, first_name, last_name\nFROM users\nORDER BY id;`,
                remote: `SELECT id, first_name, last_name\nFROM users\nWHERE active = 1\nORDER BY id;`,
                local: `SELECT id, first_name, last_name\nFROM users\nORDER BY last_name;`,
                solution: `SELECT id, first_name, last_name\nFROM users\nWHERE active = 1\nORDER BY last_name;`,
                explanation: 'Yep. The filter and the sort are independent improvements, so the healthy merge is to keep both.'
            },
            {
                title: 'Kid-friendly game settings',
                difficulty: 'Boss fight',
                description: 'This one is small but realistic. Nathan would definitely notice if you dropped the easier difficulty, and Jon would notice if you dropped the new score bonus.',
                goal: 'Preserve the kid-friendly difficulty and the new combo bonus.',
                insight: 'Even tiny objects benefit from a three-way diff. The ancestor tells you which fields stayed stable and which ones changed for separate reasons.',
                trap: 'Whole-file choices throw away product decisions. That is the quiet cost of lazy conflict resolution.',
                hint: 'You want easy mode from local, 1500 bonus points from remote, and the shared rounds value from the ancestor.',
                ancestor: `const gameConfig = {\n  difficulty: "normal",\n  rounds: 3,\n  bonusPoints: 1000\n};`,
                remote: `const gameConfig = {\n  difficulty: "normal",\n  rounds: 3,\n  bonusPoints: 1500\n};`,
                local: `const gameConfig = {\n  difficulty: "easy",\n  rounds: 3,\n  bonusPoints: 1000\n};`,
                solution: `const gameConfig = {\n  difficulty: "easy",\n  rounds: 3,\n  bonusPoints: 1500\n};`,
                explanation: 'Perfect. You preserved the product decision for kids and the scoring tweak. Tiny merge, real-world consequences.'
            }
        ];

        const state = {
            index: 0,
            completed: new Set(),
            hintsUsed: 0
        };

        const els = {
            scenarioItems: document.getElementById('scenarioItems'),
            title: document.getElementById('scenarioTitle'),
            description: document.getElementById('scenarioDescription'),
            goal: document.getElementById('scenarioGoal'),
            difficulty: document.getElementById('difficultyChip'),
            lessonName: document.getElementById('lessonName'),
            styleName: document.getElementById('styleName'),
            remotePane: document.getElementById('remotePane'),
            ancestorPane: document.getElementById('ancestorPane'),
            localPane: document.getElementById('localPane'),
            remoteOption: document.getElementById('remoteOption'),
            localOption: document.getElementById('localOption'),
            insight: document.getElementById('insightText'),
            trap: document.getElementById('trapText'),
            manual: document.getElementById('manualMerge'),
            preview: document.getElementById('previewPane'),
            result: document.getElementById('resultBox'),
            doneCount: document.getElementById('doneCount'),
            checkBtn: document.getElementById('checkBtn'),
            hintBtn: document.getElementById('hintBtn'),
            resetBtn: document.getElementById('resetBtn')
        };

        function normalize(text) {
            return text.replace(/\r/g, '').trim();
        }

        function escapeHtml(text) {
            return text
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function renderDiff(target, text, ancestor) {
            const lines = text.split('\n');
            const baseLines = ancestor.split('\n');
            target.innerHTML = lines.map((line, i) => {
                const same = line === (baseLines[i] ?? '');
                let klass = same ? 'same' : 'changed';
                if ((baseLines[i] ?? '') === '' && line !== '') klass = 'added';
                return `<span class="line ${klass}">${escapeHtml(line || ' ')}</span>`;
            }).join('');
        }

        function currentScenario() {
            return scenarios[state.index];
        }

        function currentMode() {
            return document.querySelector('input[name="mergeMode"]:checked').value;
        }

        function updatePreview() {
            const scenario = currentScenario();
            let text = scenario.solution;
            const mode = currentMode();
            if (mode === 'local') text = scenario.local;
            if (mode === 'remote') text = scenario.remote;
            if (mode === 'manual') text = els.manual.value;
            els.preview.textContent = text;
            els.styleName.textContent = mode === 'manual' ? 'Balanced' : mode === 'local' ? 'Local-first' : 'Remote-first';
        }

        function renderScenarioList() {
            els.scenarioItems.innerHTML = scenarios.map((scenario, index) => {
                const active = index === state.index ? 'active' : '';
                const completed = state.completed.has(index) ? 'completed' : '';
                return `
                    <button class="scenario-item ${active} ${completed}" data-index="${index}">
                        <div class="scenario-top">
                            <span class="scenario-title">${scenario.title}</span>
                            <span class="scenario-badge">${state.completed.has(index) ? 'cleared' : scenario.difficulty}</span>
                        </div>
                        <p>${scenario.goal}</p>
                    </button>
                `;
            }).join('');
            [...els.scenarioItems.querySelectorAll('.scenario-item')].forEach(btn => {
                btn.addEventListener('click', () => {
                    state.index = Number(btn.dataset.index);
                    loadScenario();
                });
            });
        }

        function loadScenario() {
            const scenario = currentScenario();
            els.title.textContent = scenario.title;
            els.description.textContent = scenario.description;
            els.goal.textContent = scenario.goal;
            els.difficulty.textContent = scenario.difficulty;
            els.lessonName.textContent = scenario.difficulty === 'Warm-up' ? 'See the base' : scenario.difficulty === 'Journeyman' ? 'Blend intent' : scenario.difficulty === 'Tricky' ? 'Merge clauses' : 'Ship both wins';
            els.insight.textContent = scenario.insight;
            els.trap.textContent = scenario.trap;
            renderDiff(els.remotePane, scenario.remote, scenario.ancestor);
            renderDiff(els.ancestorPane, scenario.ancestor, scenario.ancestor);
            renderDiff(els.localPane, scenario.local, scenario.ancestor);
            els.remoteOption.textContent = scenario.remote;
            els.localOption.textContent = scenario.local;
            document.querySelector('input[value="manual"]').checked = true;
            els.manual.value = scenario.ancestor;
            els.result.className = 'result';
            els.result.textContent = 'Read the ancestor, decide what each branch improved, then check your merge.';
            renderScenarioList();
            updatePreview();
        }

        function judgeMerge() {
            const scenario = currentScenario();
            const answer = normalize(els.preview.textContent);
            const target = normalize(scenario.solution);
            const mode = currentMode();

            if (answer === target) {
                state.completed.add(state.index);
                els.result.className = 'result good';
                let msg = scenario.explanation;
                if (state.completed.size === scenarios.length) {
                    msg += ' Dojo cleared. Jon would be pleased, and future-you will ship fewer accidental regressions.';
                }
                els.result.textContent = msg;
            } else if (mode === 'local' || mode === 'remote') {
                els.result.className = 'result bad';
                els.result.textContent = 'Not quite. You picked one side wholesale, which threw away a valid change from the other branch. The ancestor pane is trying very hard to save you from this.';
            } else {
                els.result.className = 'result mixed';
                els.result.textContent = 'Close, but something is still missing. Compare your merge to the intent of each branch, not just the text. Ask: what did remote improve, what did local improve, and can both survive?';
            }
            els.doneCount.textContent = state.completed.size;
            renderScenarioList();
        }

        function revealHint() {
            const scenario = currentScenario();
            state.hintsUsed += 1;
            els.result.className = 'result mixed';
            els.result.textContent = `Hint ${state.hintsUsed}: ${scenario.hint}`;
        }

        function resetScenario() {
            const scenario = currentScenario();
            document.querySelector('input[value="manual"]').checked = true;
            els.manual.value = scenario.ancestor;
            updatePreview();
            els.result.className = 'result';
            els.result.textContent = 'Scenario reset. No shame in taking another swing.';
        }

        document.querySelectorAll('input[name="mergeMode"]').forEach(input => {
            input.addEventListener('change', updatePreview);
        });
        els.manual.addEventListener('input', updatePreview);
        els.checkBtn.addEventListener('click', judgeMerge);
        els.hintBtn.addEventListener('click', revealHint);
        els.resetBtn.addEventListener('click', resetScenario);

        loadScenario();
        els.doneCount.textContent = state.completed.size;
    </script>
</body>
</html>
