<?php
$specimens = [
    ['one' => 'mouse',  'jon' => 'mice',  'proper' => 'mice',    'note' => 'The specimen that started the trouble.'],
    ['one' => 'house',  'jon' => 'hice',  'proper' => 'houses',  'note' => 'Architects have declined to comment.'],
    ['one' => 'louse',  'jon' => 'lice',  'proper' => 'lice',    'note' => 'Annoyingly, English agrees this time.'],
    ['one' => 'blouse', 'jon' => 'blice', 'proper' => 'blouses', 'note' => 'A fashionable grammatical incident.'],
    ['one' => 'nouse',  'jon' => 'nice',  'proper' => 'nouses',  'note' => 'An imaginary thing with a splendid plural.'],
    ['one' => 'rouse',  'jon' => 'rice',  'proper' => 'rouses',  'note' => 'Usually a verb. The Bureau is unconcerned.'],
    ['one' => 'twouse', 'jon' => 'twice', 'proper' => 'twouses', 'note' => 'Two of these is, naturally, twice.'],
    ['one' => 'ouse',   'jon' => 'ice',   'proper' => 'ouses',   'note' => 'Remove enough letters and winter arrives.'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#e9dfc6">
    <title>The Hice &amp; Blice Bureau</title>
    <style>
        :root {
            --ink: #1d2926;
            --paper: #e9dfc6;
            --paper-light: #f6efd9;
            --red: #bb352d;
            --teal: #176c68;
            --mustard: #d89a23;
            --shadow: #887c63;
        }
        * { box-sizing: border-box; }
        html { background: #282d2b; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: Georgia, 'Times New Roman', serif;
            background:
                repeating-linear-gradient(88deg, transparent 0 8px, rgba(42,35,19,.035) 9px 10px),
                radial-gradient(circle at 18% 7%, #fff9df 0 2%, transparent 23%),
                var(--paper);
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .32;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
        }
        button, input { font: inherit; }
        button { color: inherit; }
        a { color: inherit; }
        .masthead {
            border-bottom: 6px double var(--ink);
            padding: 18px clamp(18px, 5vw, 70px) 14px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: .12em;
            font: 700 11px/1.4 'Courier New', monospace;
        }
        .seal-mini { color: var(--red); white-space: nowrap; }
        main { width: min(1120px, calc(100% - 32px)); margin: 0 auto; }
        .hero {
            min-height: 520px;
            display: grid;
            grid-template-columns: minmax(0, 1.12fr) minmax(280px, .88fr);
            align-items: center;
            gap: clamp(30px, 7vw, 90px);
            padding: 70px 0 54px;
            border-bottom: 2px solid var(--ink);
        }
        .kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font: bold 12px/1 'Courier New', monospace;
            text-transform: uppercase;
            letter-spacing: .18em;
            color: var(--red);
        }
        .kicker::before { content: ""; width: 36px; border-top: 3px solid; }
        h1 {
            max-width: 680px;
            font-size: clamp(58px, 9vw, 116px);
            line-height: .76;
            letter-spacing: -.075em;
            margin: 24px 0 28px;
            font-weight: 900;
        }
        h1 em { color: var(--red); font-style: italic; }
        .deck {
            font-size: clamp(18px, 2vw, 24px);
            line-height: 1.48;
            max-width: 600px;
            margin: 0;
        }
        .machine {
            aspect-ratio: 1;
            max-width: 440px;
            width: 100%;
            justify-self: center;
            position: relative;
            display: grid;
            place-items: center;
        }
        .dial {
            width: 83%;
            aspect-ratio: 1;
            border: 14px solid var(--ink);
            outline: 5px solid var(--mustard);
            outline-offset: -25px;
            background:
                repeating-conic-gradient(from -4deg, var(--ink) 0 1deg, transparent 1deg 15deg),
                var(--paper-light);
            border-radius: 50%;
            box-shadow: 12px 16px 0 rgba(29,41,38,.16);
            position: relative;
            display: grid;
            place-items: center;
            animation: settle 1.2s cubic-bezier(.2,.8,.2,1) both;
        }
        .dial::after {
            content: "MOUSE → MICE";
            width: 57%;
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            text-align: center;
            border-radius: 50%;
            background: var(--teal);
            border: 7px solid var(--ink);
            color: var(--paper-light);
            font: 900 clamp(17px, 3vw, 28px)/1.1 'Courier New', monospace;
            transform: rotate(-5deg);
        }
        .pointer {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0; height: 0;
            border-left: 18px solid transparent;
            border-right: 18px solid transparent;
            border-top: 58px solid var(--red);
            filter: drop-shadow(2px 3px 0 var(--ink));
        }
        .mouse-mark { position: absolute; font-size: 47px; transform: rotate(12deg); right: 0; bottom: 2%; }
        @keyframes settle { from { transform: rotate(-180deg) scale(.7); opacity: 0; } to { transform: rotate(0) scale(1); opacity: 1; } }

        .section-head {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: end;
            gap: 30px;
            padding: 54px 0 24px;
        }
        .section-head h2 { font-size: clamp(33px, 5vw, 58px); letter-spacing: -.045em; margin: 0; line-height: .95; }
        .section-head p { margin: 0; font: 12px/1.5 'Courier New', monospace; text-transform: uppercase; max-width: 260px; }
        .game-shell {
            background: var(--ink);
            color: var(--paper-light);
            border: 3px solid var(--ink);
            box-shadow: 10px 10px 0 var(--mustard);
            display: grid;
            grid-template-columns: 170px 1fr;
            min-height: 410px;
        }
        .ledger {
            padding: 25px 20px;
            border-right: 1px dashed rgba(246,239,217,.4);
            font: 12px/1.55 'Courier New', monospace;
            text-transform: uppercase;
            color: #c9c2ad;
        }
        .ledger strong { display: block; color: var(--mustard); font-size: 32px; margin: 5px 0 22px; }
        .progress { display: flex; gap: 5px; flex-wrap: wrap; margin-top: 12px; }
        .pip { width: 11px; height: 11px; border: 1px solid #c9c2ad; border-radius: 50%; }
        .pip.done { background: var(--mustard); border-color: var(--mustard); }
        .test-card { padding: clamp(28px, 6vw, 65px); display: flex; flex-direction: column; justify-content: center; }
        .case-label { color: #9eaa9e; font: 11px/1.4 'Courier New', monospace; letter-spacing: .16em; text-transform: uppercase; }
        .prompt { font-size: clamp(42px, 8vw, 82px); line-height: 1; margin: 16px 0 31px; letter-spacing: -.05em; }
        .choices { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .choice {
            border: 2px solid var(--paper-light);
            background: transparent;
            color: var(--paper-light);
            min-height: 70px;
            cursor: pointer;
            font: 900 clamp(17px, 3vw, 26px)/1 'Courier New', monospace;
            transition: .18s ease;
        }
        .choice:hover, .choice:focus-visible { background: var(--paper-light); color: var(--ink); transform: translateY(-3px); }
        .feedback { min-height: 27px; margin: 22px 0 0; color: var(--mustard); font-style: italic; font-size: 17px; }
        .choice.correct { background: var(--teal); border-color: #62b9af; animation: stamp .3s ease; }
        .choice.wrong { background: var(--red); border-color: #eb756b; }
        @keyframes stamp { 50% { transform: scale(.95) rotate(-1deg); } }

        .factory {
            margin: 85px 0 0;
            border-top: 5px solid var(--ink);
            border-bottom: 5px solid var(--ink);
            padding: 18px 0 72px;
        }
        .factory-grid { display: grid; grid-template-columns: minmax(0, .8fr) minmax(300px, 1.2fr); gap: clamp(35px, 8vw, 100px); align-items: center; }
        .factory-copy h2 { font-size: clamp(40px, 6vw, 70px); line-height: .9; letter-spacing: -.05em; margin: 30px 0 20px; }
        .factory-copy p { font-size: 18px; line-height: 1.55; }
        .apparatus { background: var(--mustard); border: 4px solid var(--ink); padding: clamp(20px, 4vw, 40px); box-shadow: 12px 12px 0 var(--teal); position: relative; }
        .apparatus::before { content: "MODEL 2-ICE"; position: absolute; right: 14px; top: 10px; font: bold 10px/1 'Courier New', monospace; }
        label { display: block; font: bold 11px/1.4 'Courier New', monospace; text-transform: uppercase; letter-spacing: .13em; margin-bottom: 9px; }
        .input-row { display: grid; grid-template-columns: 1fr auto; }
        #wordInput {
            min-width: 0;
            border: 4px solid var(--ink);
            border-right: 0;
            background: var(--paper-light);
            padding: 15px 16px;
            font-size: 26px;
            font-weight: bold;
            outline: none;
        }
        #wordInput:focus { box-shadow: inset 0 0 0 3px var(--teal); }
        .lever {
            border: 4px solid var(--ink);
            background: var(--red);
            color: white;
            font: 900 13px/1 'Courier New', monospace;
            text-transform: uppercase;
            padding: 0 20px;
            cursor: pointer;
        }
        .lever:active { transform: translateY(3px); }
        .output-ticket {
            background: var(--paper-light);
            border: 2px dashed var(--ink);
            margin-top: 26px;
            padding: 24px;
            min-height: 150px;
            position: relative;
            overflow: hidden;
        }
        .output-ticket::after { content: "APPROVED?"; position: absolute; right: -10px; bottom: 8px; color: var(--red); border: 4px double; padding: 7px 11px; font: bold 12px/1 'Courier New', monospace; transform: rotate(-8deg); opacity: .75; }
        .transformation { font-size: clamp(28px, 5vw, 49px); line-height: 1; font-weight: bold; letter-spacing: -.04em; margin: 12px 0; }
        .ticket-note { font: 12px/1.5 'Courier New', monospace; max-width: 75%; }
        .shake { animation: shake .38s ease; }
        @keyframes shake { 20% { transform: translateX(-5px) rotate(-1deg); } 50% { transform: translateX(6px) rotate(1deg); } 80% { transform: translateX(-3px); } }

        .evidence { padding: 68px 0; }
        .evidence h2 { font-size: clamp(36px, 6vw, 64px); letter-spacing: -.05em; margin: 0 0 35px; }
        .specimens { display: grid; grid-template-columns: repeat(4, 1fr); border: 2px solid var(--ink); }
        .specimen { padding: 24px 18px; min-height: 190px; border-right: 1px solid var(--ink); border-bottom: 1px solid var(--ink); position: relative; }
        .specimen:nth-child(4n) { border-right: 0; }
        .specimen:nth-child(n+5) { border-bottom: 0; }
        .specimen small { font: 10px/1 'Courier New', monospace; text-transform: uppercase; color: var(--red); }
        .specimen b { display: block; font-size: 29px; margin: 19px 0 13px; }
        .specimen p { margin: 0; font-size: 13px; line-height: 1.45; }
        footer {
            background: var(--ink);
            color: var(--paper-light);
            padding: 40px max(18px, calc((100vw - 1120px)/2));
            display: flex;
            justify-content: space-between;
            gap: 30px;
            align-items: center;
            font-size: 14px;
            line-height: 1.5;
        }
        footer a { color: var(--mustard); text-decoration-thickness: 2px; text-underline-offset: 4px; }
        .back { font: bold 11px/1.4 'Courier New', monospace; text-transform: uppercase; letter-spacing: .12em; }
        @media (max-width: 760px) {
            .masthead span:first-child { max-width: 220px; }
            .hero { grid-template-columns: 1fr; padding-top: 50px; }
            .machine { width: min(340px, 90vw); }
            .section-head { grid-template-columns: 1fr; }
            .game-shell { grid-template-columns: 1fr; }
            .ledger { border-right: 0; border-bottom: 1px dashed rgba(246,239,217,.4); display: grid; grid-template-columns: 1fr 1fr; }
            .ledger strong { margin-bottom: 0; }
            .progress { grid-column: 1/-1; }
            .choices { grid-template-columns: 1fr; }
            .choice { min-height: 56px; }
            .factory-grid { grid-template-columns: 1fr; }
            .specimens { grid-template-columns: repeat(2, 1fr); }
            .specimen:nth-child(4n) { border-right: 1px solid var(--ink); }
            .specimen:nth-child(2n) { border-right: 0; }
            .specimen:nth-child(n+5) { border-bottom: 1px solid var(--ink); }
            .specimen:nth-child(n+7) { border-bottom: 0; }
            footer { align-items: flex-start; flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation: none !important; transition: none !important; } }
    </style>
</head>
<body>
    <header class="masthead">
        <span>Department of Dubious English · Surrey Branch</span>
        <span class="seal-mini">Est. Two Thice Ago</span>
    </header>

    <main>
        <section class="hero">
            <div>
                <span class="kicker">Public notice no. ouse–2</span>
                <h1>The Hice <em>&amp;</em><br>Blice Bureau</h1>
                <p class="deck">English made one mouse into two mice and then expected every other <em>–ouse</em> to behave itself. Jon declined. This bureau investigates the consequences.</p>
            </div>
            <div class="machine" aria-hidden="true">
                <div class="pointer"></div>
                <div class="dial"></div>
                <div class="mouse-mark">🐁</div>
            </div>
        </section>

        <section aria-labelledby="inspection-title">
            <div class="section-head">
                <h2 id="inspection-title">Plural inspection test</h2>
                <p>Choose the plural authorized by Jon’s entirely consistent and therefore suspicious system.</p>
            </div>
            <div class="game-shell">
                <aside class="ledger">
                    <div>Case <strong><span id="caseNo">1</span>/8</strong></div>
                    <div>Score <strong id="score">0</strong></div>
                    <div class="progress" id="progress" aria-label="Question progress"></div>
                </aside>
                <div class="test-card">
                    <span class="case-label">Complete the official record</span>
                    <div class="prompt">One <span id="singular">house</span>.<br>Two…?</div>
                    <div class="choices" id="choices"></div>
                    <p class="feedback" id="feedback" aria-live="polite">Select the least responsible answer.</p>
                </div>
            </div>
        </section>

        <section class="factory" aria-labelledby="factory-title">
            <div class="factory-grid">
                <div class="factory-copy">
                    <span class="kicker">Experimental division</span>
                    <h2 id="factory-title">Feed the pluralizer</h2>
                    <p>Enter any word. The Model 2-ICE applies the Bureau’s house rule, including to words that have absolutely no business being nouns.</p>
                </div>
                <div class="apparatus" id="apparatus">
                    <label for="wordInput">Singular specimen</label>
                    <div class="input-row">
                        <input id="wordInput" value="warehouse" maxlength="28" autocomplete="off" spellcheck="false">
                        <button class="lever" id="pluralize">Pull<br>lever</button>
                    </div>
                    <div class="output-ticket" id="ticket">
                        <small class="case-label">Bureau determination</small>
                        <div class="transformation" id="transformation">one warehouse → two warehice</div>
                        <div class="ticket-note" id="ticketNote">Grammatically indefensible. Mechanically impeccable.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="evidence" aria-labelledby="evidence-title">
            <h2 id="evidence-title">Evidence locker</h2>
            <div class="specimens">
                <?php foreach ($specimens as $i => $item): ?>
                    <article class="specimen">
                        <small>Exhibit <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></small>
                        <b><?= htmlspecialchars($item['one']) ?> → <?= htmlspecialchars($item['jon']) ?></b>
                        <p><?= htmlspecialchars($item['note']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <div>Inspired by Jon’s tiny, perfect linguistic derailment, <a href="https://jona.ca/2022/08/one-mouse.html">“One Mouse”</a>.</div>
        <a class="back" href="index.php">← Return to Chloe Reads Jon</a>
    </footer>

    <script>
        const specimens = <?= json_encode($specimens, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const notes = [
            'Grammatically indefensible. Mechanically impeccable.',
            'The Oxford English Dictionary has been notified. It has not replied.',
            'Please use your new plural irresponsibly.',
            'A clean conversion with only minor damage to the language.',
            'The machine accepts no liability for Scrabble disputes.'
        ];
        let order = specimens.map((_, i) => i).sort(() => Math.random() - .5);
        let round = 0, score = 0, locked = false;
        const singular = document.querySelector('#singular');
        const choices = document.querySelector('#choices');
        const feedback = document.querySelector('#feedback');
        const scoreEl = document.querySelector('#score');
        const caseNo = document.querySelector('#caseNo');
        const progress = document.querySelector('#progress');

        function pluralizeWord(raw) {
            const word = raw.trim().toLowerCase().replace(/[^a-z'-]/g, '');
            if (!word) return {word: 'nothing', plural: 'nothice'};
            if (word.endsWith('mouse')) return {word, plural: word.slice(0, -5) + 'mice'};
            if (word.endsWith('louse')) return {word, plural: word.slice(0, -5) + 'lice'};
            if (word.endsWith('ouse')) return {word, plural: word.slice(0, -4) + 'ice'};
            if (word.endsWith('us')) return {word, plural: word.slice(0, -2) + 'ice'};
            return {word, plural: word + (word.endsWith('s') ? 'es' : 'ice')};
        }
        function distractors(item) {
            const pool = [item.jon, item.proper, item.one + 's', item.one.replace(/ouse$/, 'oosen'), item.one.replace(/ouse$/, 'ice')];
            return [...new Set(pool)].sort(() => Math.random() - .5).slice(0, 3);
        }
        function renderPips() {
            progress.innerHTML = specimens.map((_, i) => `<span class="pip ${i < round ? 'done' : ''}"></span>`).join('');
        }
        function renderRound() {
            locked = false;
            if (round >= specimens.length) {
                document.querySelector('.test-card').innerHTML = `
                    <span class="case-label">Inspection complete</span>
                    <div class="prompt">${score}/8<br><em>${score > 6 ? 'Chief Pluralist' : score > 3 ? 'Licensed Nonsense' : 'English Loyalist'}</em></div>
                    <button class="choice" onclick="location.reload()">Reopen the case</button>`;
                return;
            }
            const item = specimens[order[round]];
            caseNo.textContent = round + 1;
            singular.textContent = item.one;
            feedback.textContent = 'Select the least responsible answer.';
            choices.innerHTML = '';
            distractors(item).forEach(answer => {
                const button = document.createElement('button');
                button.className = 'choice';
                button.textContent = answer;
                button.addEventListener('click', () => answerQuestion(button, answer, item));
                choices.appendChild(button);
            });
            renderPips();
        }
        function answerQuestion(button, answer, item) {
            if (locked) return;
            locked = true;
            const correct = answer === item.jon;
            if (correct) { score++; scoreEl.textContent = score; button.classList.add('correct'); feedback.textContent = item.note; }
            else { button.classList.add('wrong'); feedback.textContent = `Too sensible. Bureau answer: “${item.jon}.”`; [...choices.children].find(b => b.textContent === item.jon)?.classList.add('correct'); }
            round++;
            setTimeout(renderRound, 1500);
        }
        document.querySelector('#pluralize').addEventListener('click', runMachine);
        document.querySelector('#wordInput').addEventListener('keydown', e => { if (e.key === 'Enter') runMachine(); });
        function runMachine() {
            const result = pluralizeWord(document.querySelector('#wordInput').value);
            const apparatus = document.querySelector('#apparatus');
            apparatus.classList.remove('shake'); void apparatus.offsetWidth; apparatus.classList.add('shake');
            document.querySelector('#transformation').textContent = `one ${result.word} → two ${result.plural}`;
            document.querySelector('#ticketNote').textContent = notes[Math.floor(Math.random() * notes.length)];
        }
        renderRound();
    </script>
</body>
</html>
