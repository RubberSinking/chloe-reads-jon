<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#081827">
    <title>The Domestic Regret Portal</title>
    <style>
        :root {
            --ink: #081827;
            --paper: #f5e8cb;
            --paper-bright: #fff7e7;
            --cyan: #41d5db;
            --yellow: #f4c146;
            --red: #e44d2e;
            --green: #2d806b;
            --muted: #746c5f;
            --line: rgba(8, 24, 39, .2);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background: #d9c9a8;
            font-family: Georgia, "Times New Roman", serif;
            overflow-x: hidden;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 20;
            pointer-events: none;
            opacity: .16;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='180' height='180'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.75' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.42'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
        }
        button, input { font: inherit; }
        button { touch-action: manipulation; }
        a { color: inherit; }

        .hero {
            position: relative;
            min-height: min(760px, 94svh);
            display: flex;
            align-items: flex-end;
            background: var(--ink) url("domestic-regret-portal.webp") center / cover no-repeat;
            color: var(--paper-bright);
            isolation: isolate;
        }
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background: linear-gradient(90deg, rgba(4,14,26,.94) 0%, rgba(4,14,26,.66) 35%, transparent 68%), linear-gradient(0deg, rgba(4,14,26,.88), transparent 50%);
        }
        .hero-copy {
            width: min(1200px, 100%);
            margin: 0 auto;
            padding: 28px clamp(20px, 6vw, 80px) clamp(48px, 9vh, 92px);
        }
        .kicker {
            display: inline-block;
            padding: 7px 10px 5px;
            background: var(--yellow);
            color: var(--ink);
            font: 800 .72rem/1.1 "Trebuchet MS", sans-serif;
            letter-spacing: .16em;
            text-transform: uppercase;
            transform: rotate(-1.5deg);
        }
        h1 {
            max-width: 680px;
            margin: 18px 0 12px;
            font-family: Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
            font-size: clamp(3.6rem, 10vw, 8rem);
            font-weight: 400;
            line-height: .81;
            letter-spacing: -.025em;
            text-transform: uppercase;
            text-wrap: balance;
        }
        .intro {
            max-width: 570px;
            margin: 0 0 26px;
            color: #f4e7cb;
            font-size: clamp(1rem, 2vw, 1.22rem);
            line-height: 1.55;
        }
        .start {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            border: 0;
            padding: 15px 20px;
            background: var(--red);
            color: white;
            box-shadow: 6px 6px 0 var(--yellow);
            font: 800 .9rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: .08em;
            text-decoration: none;
            text-transform: uppercase;
            transition: transform .18s, box-shadow .18s;
        }
        .start:hover { transform: translate(3px, 3px); box-shadow: 3px 3px 0 var(--yellow); }

        main {
            width: min(1120px, calc(100% - 24px));
            margin: -18px auto 0;
            position: relative;
            z-index: 2;
        }
        .game {
            background: var(--paper);
            border: 2px solid var(--ink);
            box-shadow: 10px 12px 0 var(--ink);
        }
        .game-head {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 18px;
            padding: 18px 22px;
            border-bottom: 2px solid var(--ink);
            background: var(--yellow);
            font-family: "Trebuchet MS", sans-serif;
        }
        .game-head strong { text-transform: uppercase; letter-spacing: .08em; }
        .scoreboard { display: flex; gap: 18px; font-size: .8rem; font-weight: 800; }
        .scoreboard span span { font-size: 1.2rem; }
        .progress { height: 7px; background: rgba(8,24,39,.16); grid-column: 1 / -1; }
        .progress-fill { height: 100%; width: 0; background: var(--red); transition: width .4s cubic-bezier(.2,.8,.2,1); }

        .round {
            min-height: 480px;
            display: grid;
            grid-template-columns: minmax(0, .9fr) minmax(300px, 1.1fr);
        }
        .item-stage {
            position: relative;
            display: grid;
            place-items: center;
            min-height: 420px;
            overflow: hidden;
            background: var(--ink);
            color: var(--paper-bright);
        }
        .item-stage::before {
            content: "";
            width: min(310px, 78%);
            aspect-ratio: 1;
            position: absolute;
            border-radius: 50%;
            border: 18px solid var(--yellow);
            outline: 8px solid var(--paper);
            background: repeating-radial-gradient(circle, rgba(65,213,219,.65) 0 4px, transparent 5px 17px);
            animation: portal 20s linear infinite;
        }
        @keyframes portal { to { transform: rotate(360deg); } }
        .item {
            position: relative;
            z-index: 1;
            display: grid;
            justify-items: center;
            text-align: center;
            filter: drop-shadow(0 10px 10px rgba(0,0,0,.4));
        }
        .item-icon { font-size: clamp(5rem, 13vw, 9rem); transition: transform .4s, opacity .4s; }
        .item-name {
            margin-top: 10px;
            padding: 6px 10px;
            background: var(--paper-bright);
            color: var(--ink);
            font: 800 1rem/1 "Trebuchet MS", sans-serif;
            text-transform: uppercase;
            transform: rotate(-2deg);
        }
        .item-stage.correct .item-icon { animation: sucked .7s ease-in forwards; }
        .item-stage.wrong .item-icon { animation: wobble .45s ease-in-out; }
        @keyframes sucked { 60% { transform: scale(1.15) rotate(14deg); } 100% { transform: scale(0) rotate(450deg); opacity: 0; } }
        @keyframes wobble { 20%,60% { transform: translateX(-13px) rotate(-6deg); } 40%,80% { transform: translateX(13px) rotate(6deg); } }

        .decision {
            padding: clamp(28px, 6vw, 64px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .round-label {
            color: var(--red);
            font: 800 .7rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: .17em;
            text-transform: uppercase;
        }
        h2 { margin: 10px 0 12px; font-size: clamp(2rem, 5vw, 3.6rem); line-height: .98; letter-spacing: -.035em; }
        .question { color: #494339; font-size: 1.05rem; line-height: 1.55; }
        .choices { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-top: 26px; }
        .choice {
            border: 2px solid var(--ink);
            min-height: 92px;
            padding: 15px;
            cursor: pointer;
            background: var(--paper-bright);
            color: var(--ink);
            font: 800 .82rem/1.25 "Trebuchet MS", sans-serif;
            letter-spacing: .035em;
            text-transform: uppercase;
            transition: transform .16s, background .16s, color .16s;
        }
        .choice:hover:not(:disabled) { transform: translateY(-4px) rotate(-1deg); }
        .choice.portal-choice { background: var(--cyan); }
        .choice:disabled { cursor: default; opacity: .55; }
        .choice.was-correct { background: var(--green); color: white; opacity: 1; }
        .choice.was-wrong { background: var(--red); color: white; opacity: 1; }
        .feedback {
            display: none;
            margin-top: 22px;
            padding: 14px 0 0;
            border-top: 1px solid var(--line);
            line-height: 1.45;
        }
        .feedback.show { display: block; animation: rise .35s ease both; }
        @keyframes rise { from { opacity: 0; transform: translateY(8px); } }
        .feedback strong { display: block; margin-bottom: 4px; font: 800 .78rem "Trebuchet MS", sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        .next {
            margin-top: 14px;
            border: 0;
            padding: 11px 16px;
            background: var(--ink);
            color: white;
            cursor: pointer;
            font: 800 .75rem "Trebuchet MS", sans-serif;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .result { display: none; padding: clamp(34px, 7vw, 76px); text-align: center; }
        .result.show { display: block; }
        .result-stamp {
            width: 148px;
            height: 148px;
            margin: 0 auto 25px;
            display: grid;
            place-items: center;
            border: 8px double var(--red);
            border-radius: 50%;
            color: var(--red);
            font: 900 2.8rem/1 "Trebuchet MS", sans-serif;
            transform: rotate(-8deg);
        }
        .result h2 { max-width: 650px; margin-inline: auto; }
        .result p { max-width: 590px; margin: 12px auto 25px; color: #494339; line-height: 1.6; }
        .restart { border: 2px solid var(--ink); padding: 13px 18px; background: var(--yellow); cursor: pointer; font: 800 .8rem "Trebuchet MS", sans-serif; text-transform: uppercase; }

        .field-note {
            display: grid;
            grid-template-columns: .75fr 1.25fr;
            gap: clamp(25px, 6vw, 70px);
            padding: 90px clamp(10px, 4vw, 40px);
        }
        .field-note h2 { margin-top: 0; }
        .field-note p, .field-note li { line-height: 1.65; }
        .note-card {
            align-self: start;
            padding: 24px;
            border: 1px solid var(--line);
            background: #fff3d9;
            box-shadow: 5px 6px 0 rgba(8,24,39,.14);
            transform: rotate(1deg);
        }
        .note-card strong { font-family: "Trebuchet MS", sans-serif; text-transform: uppercase; letter-spacing: .08em; }
        .note-card ul { padding-left: 20px; }
        .source-link { color: #9e321e; font-weight: bold; text-underline-offset: 3px; }
        footer { padding: 28px 18px 42px; text-align: center; color: #585044; font-size: .83rem; }

        @media (max-width: 760px) {
            .hero { min-height: 690px; background-position: 58% center; }
            .hero::after { background: linear-gradient(0deg, rgba(4,14,26,.96), rgba(4,14,26,.12) 76%); }
            .hero-copy { padding-top: 260px; }
            .round { grid-template-columns: 1fr; }
            .item-stage { min-height: 315px; }
            .decision { padding: 30px 22px 38px; }
            .choices { grid-template-columns: 1fr; }
            .field-note { grid-template-columns: 1fr; padding-top: 70px; }
            .scoreboard { gap: 10px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
    <header class="hero">
        <div class="hero-copy">
            <span class="kicker">A household time machine</span>
            <h1>The Domestic Regret Portal</h1>
            <p class="intro">It is 30 seconds before you buy a perfectly ordinary saucepan for a faintly ridiculous price. Can Future You send the right household goods back through the portal?</p>
            <a class="start" href="#game">Enter the price-time continuum <span aria-hidden="true">↘</span></a>
        </div>
    </header>

    <main>
        <section class="game" id="game" aria-labelledby="game-title">
            <div class="game-head">
                <strong id="game-title">Future You’s intervention desk</strong>
                <div class="scoreboard"><span>Saved <span id="score">0</span></span><span>Streak <span id="streak">0</span></span></div>
                <div class="progress" aria-hidden="true"><div class="progress-fill" id="progress"></div></div>
            </div>

            <div class="round" id="round">
                <div class="item-stage" id="stage">
                    <div class="item"><div class="item-icon" id="itemIcon" aria-hidden="true">🍳</div><div class="item-name" id="itemName">Saucepan</div></div>
                </div>
                <div class="decision">
                    <span class="round-label" id="roundLabel">Incoming purchase 01 / 10</span>
                    <h2>Send a warning through time?</h2>
                    <p class="question">Was this one of Jon’s “I wish I knew the big Scandinavian catalogue sold it cheaper” discoveries?</p>
                    <div class="choices">
                        <button class="choice portal-choice" id="portalBtn" type="button">Yes. Check the giant catalogue first.</button>
                        <button class="choice" id="normalBtn" type="button">No. Let Past Jon proceed.</button>
                    </div>
                    <div class="feedback" id="feedback" aria-live="polite">
                        <strong id="feedbackTitle"></strong>
                        <span id="feedbackText"></span><br>
                        <button class="next" id="nextBtn" type="button">Next object →</button>
                    </div>
                </div>
            </div>

            <div class="result" id="result">
                <div class="result-stamp" id="finalScore">0/10</div>
                <h2 id="resultTitle">The timeline is mostly repaired.</h2>
                <p id="resultText"></p>
                <button class="restart" id="restartBtn" type="button">Reopen the portal</button>
            </div>
        </section>

        <section class="field-note">
            <div>
                <span class="round-label">The useful bit</span>
                <h2>Make one strange list before the next ordinary purchase.</h2>
                <p>Jon’s post is less about one store than one excellent shopping habit: before buying an unglamorous household object, check the broad, boring categories sold by stores you already visit. The savings hide in the things nobody daydreams about buying.</p>
                <p><a class="source-link" href="https://jona.ca/2024/10/things-i-bought-that-i-wish-i-knew-i.html" target="_blank" rel="noopener">Inspired by Jon’s “Things I bought that I wish I knew I could have gotten at Ikea for cheaper”</a>.</p>
            </div>
            <aside class="note-card">
                <strong>Future-Jon preflight</strong>
                <ul>
                    <li>Keep a “check here first” list by category, not product.</li>
                    <li>Compare the entire cost: price, trip, delivery, and expected life.</li>
                    <li>For mundane purchases, delay by one search. Regret hates a short pause.</li>
                </ul>
            </aside>
        </section>
    </main>

    <footer><a href="index.php">← Back to Chloe Reads Jon</a></footer>

    <script>
        const catalogue = [
            {name:'Doormat', icon:'🚪', yes:true, note:'A doormat was on Jon’s hindsight list. Tiny rug, surprisingly fertile soil for buyer’s remorse.'},
            {name:'Saucepan', icon:'🍳', yes:true, note:'Yes, the saucepan belongs in the portal. Future Jon rattles the lid urgently.'},
            {name:'Boot tray', icon:'🥾', yes:true, note:'Correct. A boot tray is exactly the sort of invisible household category worth checking first.'},
            {name:'Cleaning gloves', icon:'🧤', yes:true, note:'Into the portal. Glamorous? No. A useful catalogue ambush? Absolutely.'},
            {name:'Soap dispenser', icon:'🧴', yes:true, note:'Yes. Jon specifically wished he had checked there for soap dispensers.'},
            {name:'Flat bedsheet', icon:'🛏️', yes:true, note:'Portal-worthy. Flat bedsheets made the original list.'},
            {name:'Food container', icon:'🥡', yes:true, note:'Correct. Food containers are among the ordinary objects that prompted the post.'},
            {name:'Tape measure', icon:'📏', yes:true, note:'Yes. Even a tape measure was hiding in the catalogue’s broad domestic orbit.'},
            {name:'Can opener', icon:'🥫', yes:true, note:'Send the warning. Can openers made Jon’s list.'},
            {name:'Measuring cup', icon:'🥛', yes:true, note:'Correct. The measuring cup crosses the time portal with millilitres to spare.'},
            {name:'Guitar strings', icon:'🎸', yes:false, note:'Good restraint. Guitar strings were not one of Jon’s household-catalogue discoveries.'},
            {name:'Car battery', icon:'🔋', yes:false, note:'No portal required. The flat-pack battery-powered estate car remains, mercifully, fictional.'},
            {name:'Prescription glasses', icon:'👓', yes:false, note:'Correct. Past Jon should probably keep the optician appointment.'},
            {name:'Printer ink', icon:'🖨️', yes:false, note:'Not on the list. Even the portal refuses to enter the printer-ink economy.'},
            {name:'Salt & pepper shakers', icon:'🧂', yes:true, note:'Yes. The seasoning department belongs squarely in the repaired timeline.'},
            {name:'Microfibre cloths', icon:'🧽', yes:true, note:'Correct. Microfibre cloths were one of the cheaper-category revelations.'}
        ];

        const $ = id => document.getElementById(id);
        const els = {
            round: $('round'), stage: $('stage'), itemIcon: $('itemIcon'), itemName: $('itemName'), roundLabel: $('roundLabel'),
            score: $('score'), streak: $('streak'), progress: $('progress'), feedback: $('feedback'), feedbackTitle: $('feedbackTitle'),
            feedbackText: $('feedbackText'), next: $('nextBtn'), portal: $('portalBtn'), normal: $('normalBtn'), result: $('result'),
            finalScore: $('finalScore'), resultTitle: $('resultTitle'), resultText: $('resultText')
        };
        let deck = [], turn = 0, score = 0, streak = 0, answered = false;

        function shuffle(items) {
            const copy = [...items];
            for (let i = copy.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [copy[i], copy[j]] = [copy[j], copy[i]];
            }
            return copy;
        }

        function begin() {
            const yesItems = shuffle(catalogue.filter(x => x.yes)).slice(0, 6);
            const noItems = shuffle(catalogue.filter(x => !x.yes)).slice(0, 4);
            deck = shuffle([...yesItems, ...noItems]);
            turn = score = streak = 0;
            els.score.textContent = '0'; els.streak.textContent = '0';
            els.result.classList.remove('show'); els.round.style.display = 'grid';
            showRound();
        }

        function showRound() {
            answered = false;
            const item = deck[turn];
            els.stage.className = 'item-stage';
            els.itemIcon.textContent = item.icon;
            els.itemName.textContent = item.name;
            els.roundLabel.textContent = `Incoming purchase ${String(turn + 1).padStart(2,'0')} / 10`;
            els.progress.style.width = `${turn * 10}%`;
            els.feedback.classList.remove('show');
            [els.portal, els.normal].forEach(b => { b.disabled = false; b.classList.remove('was-correct','was-wrong'); });
        }

        function answer(guess, button) {
            if (answered) return;
            answered = true;
            const item = deck[turn];
            const right = guess === item.yes;
            if (right) { score++; streak++; els.stage.classList.add('correct'); }
            else { streak = 0; els.stage.classList.add('wrong'); }
            els.score.textContent = score; els.streak.textContent = streak;
            [els.portal, els.normal].forEach(b => b.disabled = true);
            button.classList.add(right ? 'was-correct' : 'was-wrong');
            els.feedbackTitle.textContent = right ? (streak > 2 ? `${streak} in a row. Timeline wizardry.` : 'Timeline repaired.') : 'A small tear in the receipt continuum.';
            els.feedbackText.textContent = item.note;
            els.feedback.classList.add('show');
            els.next.textContent = turn === 9 ? 'Inspect repaired timeline →' : 'Next object →';
        }

        function advance() {
            turn++;
            if (turn < deck.length) showRound(); else finish();
        }

        function finish() {
            els.progress.style.width = '100%';
            els.round.style.display = 'none';
            els.result.classList.add('show');
            els.finalScore.textContent = `${score}/10`;
            const outcomes = score >= 9
                ? ['You are the Catalogue Oracle.','Past Jon receives a crisp warning moments before every questionable saucepan. The household budget hums with relief.']
                : score >= 7
                ? ['The timeline is mostly repaired.','Only a few receipts remain mysteriously expensive. Future You has earned a sensible cup of tea and one more category search.']
                : score >= 4
                ? ['The portal needs recalibrating.','You saved several mundane purchases, but the boot trays are still multiplying in the expensive branch of history.']
                : ['Past Jon has questions.','The portal emitted a can opener, three guitar strings, and smoke. Fortunately, time travel is repeatable.'];
            els.resultTitle.textContent = outcomes[0]; els.resultText.textContent = outcomes[1];
        }

        els.portal.addEventListener('click', () => answer(true, els.portal));
        els.normal.addEventListener('click', () => answer(false, els.normal));
        els.next.addEventListener('click', advance);
        $('restartBtn').addEventListener('click', begin);
        begin();
    </script>
</body>
</html>
