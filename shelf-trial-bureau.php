<?php
$sourceUrl = 'https://jona.ca/2004/09/games-im-considering-buying.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#172d2c">
    <title>The Shelf Trial Bureau</title>
    <style>
        :root {
            --ink: #172d2c;
            --paper: #efe2be;
            --paper-light: #fff7df;
            --mustard: #d3a52d;
            --red: #b94328;
            --teal: #1b6665;
            --wood: #5a321d;
            --shadow: rgba(24, 16, 9, .32);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 14% 10%, rgba(211,165,45,.16), transparent 24rem),
                repeating-linear-gradient(87deg, rgba(72,42,24,.06) 0 1px, transparent 1px 7px),
                #203c38;
            font-family: Georgia, 'Times New Roman', serif;
            min-height: 100vh;
        }
        button, input { font: inherit; }
        button { color: inherit; }
        .topbar {
            width: min(1180px, calc(100% - 28px));
            margin: 16px auto 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #f7edcf;
            font-family: 'Courier New', monospace;
            font-size: .72rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .topbar a { color: inherit; text-decoration-thickness: 1px; text-underline-offset: 4px; }
        .lamp { width: 9px; height: 9px; border-radius: 50%; background: #f7ce54; box-shadow: 0 0 14px #f7ce54; display: inline-block; margin-right: 8px; }
        .hero {
            width: min(1180px, calc(100% - 28px));
            margin: 15px auto 28px;
            min-height: 510px;
            position: relative;
            border: 10px solid #8b5a30;
            outline: 2px solid #d3a85a;
            overflow: hidden;
            box-shadow: 0 24px 55px rgba(4,17,16,.48);
            background: #2b1b12;
            isolation: isolate;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('shelf-trial-bureau.webp') center / cover;
            filter: saturate(.88) contrast(1.06);
            z-index: -2;
            transform: scale(1.015);
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(18,27,24,.96) 0, rgba(18,31,28,.86) 37%, rgba(18,31,28,.1) 73%), linear-gradient(0deg, rgba(10,16,14,.5), transparent 55%);
            z-index: -1;
        }
        .hero-copy { width: min(590px, 59%); padding: clamp(34px, 6vw, 78px); color: #fff6db; }
        .kicker { font: 700 .74rem/1.2 'Courier New', monospace; text-transform: uppercase; letter-spacing: .23em; color: #f2c84d; }
        h1 {
            font-family: Rockwell, 'Roboto Slab', Georgia, serif;
            font-size: clamp(3.1rem, 8vw, 6.9rem);
            line-height: .78;
            letter-spacing: -.065em;
            margin: 22px 0 28px;
            max-width: 8ch;
            text-shadow: 0 5px 0 rgba(0,0,0,.18);
        }
        h1 em { color: #eabf43; font-style: normal; }
        .hero p { font-size: clamp(1rem, 1.7vw, 1.25rem); line-height: 1.58; max-width: 31rem; margin: 0 0 28px; }
        .start-button, .action-button {
            border: 0;
            border-bottom: 5px solid #792716;
            background: var(--red);
            color: white;
            text-transform: uppercase;
            letter-spacing: .13em;
            font: 700 .78rem/1 'Courier New', monospace;
            padding: 17px 22px 14px;
            cursor: pointer;
            box-shadow: 0 7px 18px rgba(0,0,0,.24);
            transition: transform .16s, filter .16s;
        }
        .start-button:hover, .action-button:hover { transform: translateY(-2px); filter: brightness(1.08); }
        .start-button:active, .action-button:active { transform: translateY(2px); border-bottom-width: 2px; }
        .caption { position: absolute; right: 15px; bottom: 14px; color: #fff5d9; font: .62rem/1.4 'Courier New', monospace; letter-spacing: .08em; background: rgba(19,31,28,.84); padding: 7px 9px; }

        main { width: min(1120px, calc(100% - 28px)); margin: 0 auto; }
        .bureau {
            background:
                linear-gradient(rgba(255,255,255,.2), rgba(255,255,255,0)),
                repeating-linear-gradient(0deg, transparent 0 28px, rgba(44,67,62,.07) 28px 29px),
                var(--paper);
            box-shadow: 0 25px 60px rgba(5,17,16,.45);
            border: 1px solid #cfb777;
            margin-bottom: 30px;
        }
        .bureau-head { padding: clamp(25px, 5vw, 52px); border-bottom: 2px solid rgba(25,57,54,.26); display: grid; grid-template-columns: 1.4fr 1fr; gap: 40px; align-items: end; }
        h2 { font: 800 clamp(2rem, 4vw, 3.5rem)/.95 Rockwell, Georgia, serif; letter-spacing: -.045em; margin: 0 0 14px; }
        .bureau-head p { line-height: 1.55; margin: 0; font-size: 1.03rem; }
        .seal { justify-self: end; transform: rotate(2deg); border: 4px double var(--red); color: var(--red); padding: 13px 18px; text-align: center; text-transform: uppercase; letter-spacing: .16em; font: 700 .68rem/1.6 'Courier New', monospace; max-width: 220px; }
        .section { padding: clamp(24px, 4.5vw, 48px); border-bottom: 1px solid rgba(25,57,54,.22); }
        .section-title { display: flex; align-items: baseline; gap: 13px; margin-bottom: 24px; }
        .section-number { font: 700 .75rem/1 'Courier New', monospace; color: var(--red); letter-spacing: .13em; }
        h3 { margin: 0; font: 800 clamp(1.55rem, 3vw, 2.35rem)/1 Rockwell, Georgia, serif; letter-spacing: -.035em; }
        .weights { display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; }
        .weight {
            text-align: center;
            background: rgba(255,248,224,.58);
            border: 1px solid rgba(29,74,70,.22);
            padding: 18px 12px 14px;
            position: relative;
        }
        .weight label { font: 700 .68rem/1.3 'Courier New', monospace; letter-spacing: .09em; text-transform: uppercase; display: block; min-height: 36px; }
        .dial { width: 82px; height: 82px; margin: 8px auto 7px; border: 7px solid #d0b777; border-radius: 50%; background: radial-gradient(circle, #fff6d8 0 32%, #193e3a 34% 37%, #be4b31 39% 43%, #f0db9f 45%); display: grid; place-items: center; box-shadow: inset 0 0 0 3px #78623b, 0 5px 7px rgba(51,37,18,.22); }
        .dial output { display: grid; place-items: center; background: var(--ink); color: #fff1c8; width: 41px; height: 41px; border-radius: 50%; font: 700 1rem 'Courier New', monospace; }
        input[type=range] { accent-color: var(--red); width: 100%; cursor: ew-resize; }
        .hint { font-size: .74rem; opacity: .7; line-height: 1.35; }
        .candidate-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
        .candidate {
            background: #fff6db;
            border: 1px solid #a88d52;
            box-shadow: 5px 7px 0 rgba(66,49,23,.12);
            padding: 18px;
            position: relative;
            transition: transform .18s, box-shadow .18s;
        }
        .candidate:hover { transform: translateY(-3px) rotate(-.2deg); box-shadow: 7px 11px 0 rgba(66,49,23,.12); }
        .candidate::before { content: ''; width: 43px; height: 12px; position: absolute; left: calc(50% - 22px); top: -7px; background: rgba(211,165,45,.6); transform: rotate(-2deg); }
        .candidate-name { width: calc(100% - 28px); border: 0; border-bottom: 2px solid var(--ink); background: transparent; font: 800 1.28rem Rockwell, Georgia, serif; padding: 5px 2px; color: var(--ink); }
        .remove { position: absolute; right: 11px; top: 16px; border: 0; background: transparent; font: 1.1rem/1 'Courier New', monospace; cursor: pointer; opacity: .45; }
        .remove:hover { opacity: 1; color: var(--red); }
        .fields { display: grid; grid-template-columns: 1fr 1fr; gap: 13px 12px; margin-top: 19px; }
        .field label { display: block; font: 700 .61rem/1.25 'Courier New', monospace; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 5px; }
        .field input { width: 100%; border: 1px solid #b49e69; background: #f7eac5; padding: 9px; color: var(--ink); font-family: 'Courier New', monospace; font-weight: 700; border-radius: 0; }
        .field small { display: block; font-size: .66rem; opacity: .65; margin-top: 3px; }
        .card-score { margin-top: 15px; border-top: 1px dashed #927c4f; padding-top: 12px; display: flex; justify-content: space-between; align-items: center; font: 700 .67rem 'Courier New', monospace; text-transform: uppercase; letter-spacing: .08em; }
        .card-score strong { font-size: 1.25rem; color: var(--red); }
        .add-button { min-height: 160px; border: 2px dashed rgba(25,57,54,.48); background: transparent; cursor: pointer; font: 700 .76rem/1.5 'Courier New', monospace; text-transform: uppercase; letter-spacing: .12em; color: var(--ink); }
        .add-button:hover { background: rgba(255,255,255,.25); border-color: var(--red); color: var(--red); }
        .controls { display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; margin-top: 30px; }
        .secondary { background: transparent; border: 2px solid var(--ink); color: var(--ink); box-shadow: none; padding-top: 14px; border-bottom-width: 5px; }
        .results { display: none; background: #172f2d; color: #fff4d5; padding: clamp(27px, 5vw, 52px); }
        .results.visible { display: block; animation: reveal .65s both; }
        @keyframes reveal { from { opacity: 0; transform: translateY(20px) rotateX(-5deg); } }
        .result-lead { display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; align-items: center; }
        .verdict-stamp { border: 6px double #e6b93a; color: #e6b93a; padding: 22px 14px; text-align: center; transform: rotate(-2deg); }
        .verdict-stamp span { display: block; font: 700 .7rem 'Courier New', monospace; letter-spacing: .18em; text-transform: uppercase; }
        .verdict-stamp strong { display: block; font: 800 clamp(2.4rem, 6vw, 5rem)/.92 Rockwell, Georgia, serif; margin: 8px 0; }
        .verdict-stamp em { font: 700 1.4rem 'Courier New', monospace; font-style: normal; }
        .result-copy h3 { color: #f2c84d; }
        .result-copy p { line-height: 1.55; }
        .ranking { margin: 34px 0 0; padding: 0; list-style: none; }
        .ranking li { display: grid; grid-template-columns: 42px 1fr auto; gap: 15px; align-items: center; padding: 14px 0; border-top: 1px solid rgba(255,255,255,.17); }
        .rank { font: 800 1.8rem Rockwell, Georgia, serif; color: #e9b83a; }
        .rank-info strong { display: block; font-size: 1.08rem; }
        .rank-info small { opacity: .7; line-height: 1.4; }
        .scorebar { width: min(220px, 25vw); height: 10px; background: rgba(255,255,255,.12); position: relative; }
        .scorebar i { display: block; height: 100%; width: var(--score); background: #e6b93a; }
        .scorebar b { position: absolute; right: 0; top: -20px; font: 700 .67rem 'Courier New', monospace; }
        .showdown { margin-top: 38px; border: 1px solid rgba(230,185,58,.48); padding: 22px; text-align: center; }
        .showdown[hidden] { display: none; }
        .showdown .scenario { color: #e9bf51; font: 700 .7rem 'Courier New', monospace; letter-spacing: .13em; text-transform: uppercase; }
        .showdown p { font-size: 1.25rem; }
        .showdown-buttons { display: flex; gap: 12px; justify-content: center; }
        .showdown button { border: 1px solid #e4c66e; background: transparent; color: #fff4d5; padding: 12px 18px; cursor: pointer; }
        .showdown button:hover { background: #e4c66e; color: #172f2d; }
        .footer { width: min(1120px, calc(100% - 28px)); margin: 0 auto 45px; color: #e8dfc1; display: flex; gap: 30px; justify-content: space-between; align-items: start; font-size: .88rem; line-height: 1.55; }
        .footer a { color: #f1c84f; text-underline-offset: 4px; }
        .method { max-width: 620px; }
        .desk-note { font-family: 'Courier New', monospace; font-size: .68rem; text-transform: uppercase; letter-spacing: .08em; opacity: .8; }
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
        :focus-visible { outline: 3px solid #f2c84d; outline-offset: 3px; }

        @media (max-width: 820px) {
            .hero { min-height: 600px; }
            .hero::after { background: linear-gradient(0deg, rgba(16,28,25,.96) 0, rgba(16,28,25,.78) 65%, rgba(16,28,25,.15)); }
            .hero-copy { width: 100%; padding: 38px 25px 125px; position: absolute; bottom: 0; }
            h1 { font-size: clamp(3.5rem, 17vw, 6rem); }
            .bureau-head, .result-lead { grid-template-columns: 1fr; }
            .seal { justify-self: start; }
            .weights { grid-template-columns: repeat(2, 1fr); }
            .weight:last-child { grid-column: 1 / -1; max-width: calc(50% - 8px); justify-self: center; width: 100%; }
            .candidate-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 560px) {
            .topbar { font-size: .58rem; }
            .hero { border-width: 6px; min-height: 620px; }
            .hero-copy { padding: 30px 21px 76px; }
            .hero p { font-size: .98rem; }
            .caption { display: none; }
            .weights, .candidate-grid { grid-template-columns: 1fr; }
            .weight:last-child { grid-column: auto; max-width: none; }
            .field input { font-size: 16px; }
            .result-lead { gap: 25px; }
            .ranking li { grid-template-columns: 32px 1fr; }
            .scorebar { grid-column: 2; width: 100%; margin-top: 7px; }
            .showdown-buttons, .footer { flex-direction: column; }
            .showdown button { width: 100%; }
        }
        @media print {
            body { background: white; }
            .topbar, .hero, .bureau-head, .section, .showdown, .footer, .controls { display: none !important; }
            main, .bureau { width: 100%; margin: 0; box-shadow: none; border: 0; }
            .results { display: block !important; color: black; background: white; }
            .verdict-stamp { color: black; border-color: black; }
            .result-copy h3, .rank { color: black; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation: none !important; transition: none !important; scroll-behavior: auto !important; } }
    </style>
</head>
<body>
    <nav class="topbar" aria-label="Page navigation">
        <a href="./">← Chloe Reads Jon</a>
        <span><i class="lamp"></i>Bureau lamp on · File 09/07/04</span>
    </nav>

    <header class="hero">
        <div class="hero-copy">
            <div class="kicker">Consumer Leisure Division</div>
            <h1>The Shelf <em>Trial</em> Bureau</h1>
            <p>A board game should not merely be bought. It should survive questioning. Put your candidates under the lamp and find the one most likely to become a family regular.</p>
            <button class="start-button" type="button" onclick="document.querySelector('#bureau').scrollIntoView()">Open a case file</button>
        </div>
        <div class="caption">Original bureau artwork · generated for this case file</div>
    </header>

    <main>
        <article class="bureau" id="bureau">
            <header class="bureau-head">
                <div>
                    <h2>Board Game Acquisition Docket</h2>
                    <p>Estimate honestly, then let the bureau balance longevity against price and friction. These are not ratings of “best game.” They are predictions of which box will actually make it off your shelf.</p>
                </div>
                <div class="seal">Case principle<br><strong>Plays beat promises</strong><br>Est. 2004</div>
            </header>

            <section class="section" aria-labelledby="weights-title">
                <div class="section-title"><span class="section-number">01 / PRIORITIES</span><h3 id="weights-title">Set the brass dials</h3></div>
                <div class="weights" id="weights"></div>
            </section>

            <section class="section" aria-labelledby="candidates-title">
                <div class="section-title"><span class="section-number">02 / EVIDENCE</span><h3 id="candidates-title">Enter the suspects</h3></div>
                <div class="candidate-grid" id="candidateGrid"></div>
                <div class="controls">
                    <button type="button" class="action-button" id="calculate">Issue the verdict</button>
                    <button type="button" class="action-button secondary" id="reset">Restore Jon’s 2004 docket</button>
                </div>
            </section>

            <section class="results" id="results" aria-live="polite">
                <div class="result-lead">
                    <div class="verdict-stamp"><span id="verdictLabel">Recommended action</span><strong id="winnerName">Tikal</strong><em id="winnerScore">84 / 100</em></div>
                    <div class="result-copy">
                        <div class="section-number">03 / FINDINGS</div>
                        <h3 id="headline">This box has earned a trial.</h3>
                        <p id="explanation"></p>
                    </div>
                </div>
                <ol class="ranking" id="ranking"></ol>
                <div class="showdown" id="showdown">
                    <div class="scenario" id="scenarioLabel">Gut-check 1 of 3</div>
                    <p id="scenarioText"></p>
                    <div class="showdown-buttons"><button type="button" id="choiceA"></button><button type="button" id="choiceB"></button></div>
                </div>
                <div class="controls">
                    <button type="button" class="action-button" onclick="window.print()">Print the shortlist</button>
                    <button type="button" class="action-button secondary" id="copyResult">Copy verdict</button>
                </div>
            </section>
        </article>
    </main>

    <footer class="footer">
        <div class="method">Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>">“Games I’m considering buying”</a>, where replayability, two-player strength, and the dreaded “good for a dozen plays” were already doing serious shelf-audit work.</div>
        <div class="desk-note">Private calculations stay in this browser.<br>No account. No catalogue. No shame cupboard.</div>
    </footer>

    <template id="candidateTemplate">
        <div class="candidate">
            <label class="sr-only">Game name</label>
            <input class="candidate-name" maxlength="34" aria-label="Game name">
            <button class="remove" type="button" aria-label="Remove candidate">×</button>
            <div class="fields"></div>
            <div class="card-score"><span>Current file score</span><strong>—</strong></div>
        </div>
    </template>

    <script>
    (() => {
        const defaultGames = [
            {name:'Tikal', price:55, plays:24, duo:4, spark:4, setup:18},
            {name:'San Juan', price:38, plays:14, duo:5, spark:3, setup:6},
            {name:'Torres', price:62, plays:30, duo:4, spark:3, setup:12},
            {name:'Wallenstein', price:80, plays:12, duo:3, spark:5, setup:28},
            {name:'Royal Turf', price:42, plays:22, duo:3, spark:5, setup:7},
            {name:'St. Petersburg', price:50, plays:13, duo:4, spark:3, setup:9}
        ];
        const weightDefs = [
            {key:'replay', label:'Replayability', hint:'Will it still surprise you?', value:5},
            {key:'duo', label:'Two-player strength', hint:'Works when the group is tiny', value:4},
            {key:'spark', label:'Family spark', hint:'Someone actually asks to play', value:5},
            {key:'friction', label:'Low friction', hint:'Setup does not eat the evening', value:3},
            {key:'value', label:'Value per play', hint:'Happy evenings per dollar', value:4}
        ];
        const fieldDefs = [
            {key:'price', label:'Price', suffix:'CAD', min:0, max:500},
            {key:'plays', label:'Expected plays', suffix:'total', min:1, max:999},
            {key:'duo', label:'Two-player', suffix:'1–5', min:1, max:5},
            {key:'spark', label:'Family spark', suffix:'1–5', min:1, max:5},
            {key:'setup', label:'Setup time', suffix:'minutes', min:0, max:180}
        ];
        const scenarios = [
            'It is a rainy Saturday and everyone is available. Which box gets named first?',
            'It is 8:15 p.m. and energy is fading. Which one still makes it to the table?',
            'Imagine both boxes after thirty plays. Which one are you happier to see?'
        ];
        const grid = document.querySelector('#candidateGrid');
        const weightsEl = document.querySelector('#weights');
        const resultsEl = document.querySelector('#results');
        let games = loadState()?.games || structuredClone(defaultGames);
        let weights = loadState()?.weights || Object.fromEntries(weightDefs.map(w => [w.key, w.value]));
        let lastRanking = [];
        let showdownIndex = 0;
        let gutVotes = [0,0];

        function clamp(n, min, max) { return Math.max(min, Math.min(max, Number(n) || 0)); }
        function loadState() { try { return JSON.parse(localStorage.getItem('shelfTrialBureau')); } catch { return null; } }
        function saveState() { localStorage.setItem('shelfTrialBureau', JSON.stringify({games, weights})); }

        function renderWeights() {
            weightsEl.innerHTML = '';
            weightDefs.forEach(def => {
                const div = document.createElement('div');
                div.className = 'weight';
                div.innerHTML = `<label for="weight-${def.key}">${def.label}</label><div class="dial"><output>${weights[def.key]}</output></div><input id="weight-${def.key}" type="range" min="0" max="5" step="1" value="${weights[def.key]}" aria-describedby="hint-${def.key}"><div class="hint" id="hint-${def.key}">${def.hint}</div>`;
                const input = div.querySelector('input');
                input.addEventListener('input', () => { weights[def.key] = Number(input.value); div.querySelector('output').value = input.value; updateScores(); saveState(); });
                weightsEl.append(div);
            });
        }

        function renderCandidates() {
            grid.innerHTML = '';
            games.forEach((game, index) => {
                const card = document.querySelector('#candidateTemplate').content.firstElementChild.cloneNode(true);
                const name = card.querySelector('.candidate-name');
                name.value = game.name;
                name.addEventListener('input', () => { games[index].name = name.value || `Candidate ${index + 1}`; saveState(); });
                const fields = card.querySelector('.fields');
                fieldDefs.forEach(def => {
                    const wrap = document.createElement('div');
                    wrap.className = 'field';
                    const id = `game-${index}-${def.key}`;
                    wrap.innerHTML = `<label for="${id}">${def.label}</label><input id="${id}" type="number" inputmode="decimal" min="${def.min}" max="${def.max}" value="${game[def.key]}"><small>${def.suffix}</small>`;
                    wrap.querySelector('input').addEventListener('input', e => { games[index][def.key] = clamp(e.target.value, def.min, def.max); updateScores(); saveState(); });
                    fields.append(wrap);
                });
                card.querySelector('.remove').addEventListener('click', () => { if (games.length <= 2) return alert('The bureau requires at least two suspects.'); games.splice(index, 1); renderCandidates(); saveState(); });
                grid.append(card);
            });
            if (games.length < 8) {
                const add = document.createElement('button');
                add.type = 'button'; add.className = 'add-button'; add.innerHTML = '+ Add a candidate<br><small>Maximum eight files</small>';
                add.addEventListener('click', () => { games.push({name:'New candidate', price:50, plays:15, duo:3, spark:3, setup:10}); renderCandidates(); saveState(); });
                grid.append(add);
            }
            updateScores();
        }

        function score(game) {
            const parts = {
                replay: clamp(Math.sqrt(game.plays / 30) * 100, 0, 100),
                duo: clamp((game.duo - 1) * 25, 0, 100),
                spark: clamp((game.spark - 1) * 25, 0, 100),
                friction: clamp(100 - (game.setup * 2.35), 0, 100),
                value: clamp((game.plays / Math.max(game.price, 5)) * 190, 0, 100)
            };
            const totalWeight = Object.values(weights).reduce((a,b) => a + b, 0) || 1;
            return Math.round(Object.keys(parts).reduce((sum, key) => sum + parts[key] * weights[key], 0) / totalWeight);
        }

        function updateScores() {
            [...grid.querySelectorAll('.candidate')].forEach((card, index) => { card.querySelector('.card-score strong').textContent = score(games[index]); });
        }

        function getReason(game) {
            const notes = [];
            if (game.plays >= 25) notes.push('long legs');
            if (game.duo >= 4) notes.push('strong at two');
            if (game.spark >= 4) notes.push('family pull');
            if (game.setup <= 10) notes.push('quick setup');
            if (game.price / Math.max(game.plays,1) <= 3) notes.push('good value');
            return notes.length ? notes.slice(0,3).join(' · ') : 'worth borrowing before buying';
        }

        function issueVerdict() {
            lastRanking = games.map((game, index) => ({...game, index, score: score(game)})).sort((a,b) => b.score - a.score);
            const winner = lastRanking[0];
            const action = winner.score >= 75 ? 'Buy candidate' : winner.score >= 56 ? 'Borrow first' : 'Keep the shelf clear';
            document.querySelector('#verdictLabel').textContent = action;
            document.querySelector('#winnerName').textContent = winner.name;
            document.querySelector('#winnerScore').textContent = `${winner.score} / 100`;
            document.querySelector('#headline').textContent = winner.score >= 75 ? 'This box has earned a trial.' : winner.score >= 56 ? 'Promising, but let a borrowed copy testify.' : 'No box has made the case yet.';
            const perPlay = winner.price / Math.max(1, winner.plays);
            document.querySelector('#explanation').textContent = `${winner.name} leads on your priorities, with ${getReason(winner)}. At about $${perPlay.toFixed(2)} per expected play, the prediction is useful, not sacred: the real test is whether somebody says “again.”`;
            document.querySelector('#ranking').innerHTML = lastRanking.map((g,i) => `<li><span class="rank">${i+1}</span><span class="rank-info"><strong>${escapeHtml(g.name)}</strong><small>${getReason(g)} · $${(g.price/Math.max(g.plays,1)).toFixed(2)} per predicted play</small></span><span class="scorebar" style="--score:${g.score}%"><i></i><b>${g.score}</b></span></li>`).join('');
            resultsEl.classList.add('visible');
            document.querySelector('#showdown').innerHTML = '<div class="scenario" id="scenarioLabel"></div><p id="scenarioText"></p><div class="showdown-buttons"><button type="button" id="choiceA"></button><button type="button" id="choiceB"></button></div>';
            document.querySelector('#choiceA').addEventListener('click', () => vote(0));
            document.querySelector('#choiceB').addEventListener('click', () => vote(1));
            showdownIndex = 0; gutVotes = [0,0]; setupShowdown();
            resultsEl.scrollIntoView({behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth', block:'start'});
        }

        function escapeHtml(value) { const d = document.createElement('div'); d.textContent = value; return d.innerHTML; }
        function setupShowdown() {
            const box = document.querySelector('#showdown');
            if (showdownIndex >= scenarios.length) {
                const gut = gutVotes[0] === gutVotes[1] ? 'Your instinct called it a draw.' : `Your instinct favours ${lastRanking[gutVotes[0] > gutVotes[1] ? 0 : 1].name}.`;
                box.innerHTML = `<div class="scenario">Gut-check complete</div><p>${gut} Numbers make a shortlist; desire decides what will reach the table.</p>`;
                return;
            }
            box.hidden = false;
            document.querySelector('#scenarioLabel').textContent = `Gut-check ${showdownIndex + 1} of ${scenarios.length}`;
            document.querySelector('#scenarioText').textContent = scenarios[showdownIndex];
            document.querySelector('#choiceA').textContent = lastRanking[0].name;
            document.querySelector('#choiceB').textContent = lastRanking[1].name;
        }
        function vote(choice) { gutVotes[choice]++; showdownIndex++; setupShowdown(); }

        document.querySelector('#calculate').addEventListener('click', issueVerdict);
        document.querySelector('#reset').addEventListener('click', () => {
            games = structuredClone(defaultGames); weights = Object.fromEntries(weightDefs.map(w => [w.key, w.value]));
            localStorage.removeItem('shelfTrialBureau'); resultsEl.classList.remove('visible'); renderWeights(); renderCandidates();
        });
        document.querySelector('#copyResult').addEventListener('click', async e => {
            if (!lastRanking.length) return;
            const text = `Shelf Trial Bureau verdict: ${lastRanking[0].name} leads with ${lastRanking[0].score}/100. Shortlist: ${lastRanking.slice(0,3).map(g => `${g.name} (${g.score})`).join(', ')}.`;
            try { await navigator.clipboard.writeText(text); e.target.textContent = 'Verdict copied'; setTimeout(() => e.target.textContent = 'Copy verdict', 1600); }
            catch { prompt('Copy your verdict:', text); }
        });

        renderWeights(); renderCandidates();
    })();
    </script>
</body>
</html>
