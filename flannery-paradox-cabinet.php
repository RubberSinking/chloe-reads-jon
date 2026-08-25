<?php
declare(strict_types=1);
$sourceUrl = 'https://cooltoolsforcatholics.blogspot.com/2010/08/flannery-oconnor-quotes.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101a20">
    <title>Flannery's Paradox Cabinet</title>
    <style>
        :root {
            --night: #101a20;
            --night-soft: #17262c;
            --paper: #e9dec4;
            --paper-bright: #f5ecd9;
            --ink: #221d17;
            --rust: #9c432d;
            --brass: #c69a4b;
            --teal: #367f7a;
            --line: rgba(233, 222, 196, .22);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-width: 320px;
            color: var(--paper);
            background:
                radial-gradient(circle at 12% 22%, rgba(54,127,122,.16), transparent 28rem),
                repeating-linear-gradient(93deg, rgba(255,255,255,.012) 0 1px, transparent 1px 4px),
                var(--night);
            font-family: "Iowan Old Style", Baskerville, "Times New Roman", serif;
            font-size: 18px;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .17;
            z-index: 20;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.26'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
        }

        a { color: inherit; }
        button, input { font: inherit; }
        button { touch-action: manipulation; }
        .mono { font-family: "Courier New", monospace; text-transform: uppercase; letter-spacing: .11em; }

        .hero {
            min-height: 92svh;
            display: grid;
            align-items: end;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid var(--line);
            isolation: isolate;
        }

        .hero-art {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: -2;
            filter: saturate(.82) contrast(1.06);
            animation: settle 1.8s cubic-bezier(.2,.8,.2,1) both;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background: linear-gradient(90deg, rgba(9,15,18,.92) 0%, rgba(9,15,18,.76) 38%, rgba(9,15,18,.1) 72%),
                        linear-gradient(0deg, rgba(9,15,18,.88), transparent 48%);
        }

        .hero-inner {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
            padding: 120px 0 70px;
        }

        .eyebrow { color: #d8b66e; font-size: .66rem; margin: 0 0 18px; }
        h1 {
            margin: 0;
            max-width: 700px;
            font-family: Baskerville, "Iowan Old Style", Georgia, serif;
            font-size: clamp(4rem, 10vw, 8.7rem);
            font-weight: 400;
            line-height: .78;
            letter-spacing: -.055em;
            text-wrap: balance;
        }
        h1 em { display: block; color: #d5a54d; font-weight: 400; }
        .lede {
            max-width: 520px;
            margin: 36px 0 0;
            font-size: clamp(1.08rem, 2vw, 1.4rem);
            line-height: 1.45;
            color: #e4d9c2;
        }
        .start {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-top: 30px;
            padding: 12px 0;
            text-decoration: none;
            color: #f0c66e;
            font: 500 .72rem "Courier New", monospace;
            letter-spacing: .09em;
            text-transform: uppercase;
            border-bottom: 1px solid currentColor;
        }
        .start span { transition: transform .2s ease; }
        .start:hover span { transform: translateY(3px); }

        main { overflow: hidden; }
        .intro {
            width: min(840px, calc(100% - 40px));
            margin: 0 auto;
            padding: 100px 0 76px;
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 32px;
        }
        .folio { color: var(--brass); font-size: .65rem; padding-top: 8px; }
        .intro h2 {
            margin: 0 0 18px;
            color: var(--paper-bright);
            font: 400 clamp(2rem, 5vw, 3.6rem)/1 Baskerville, "Iowan Old Style", serif;
        }
        .intro p { margin: 0; max-width: 660px; line-height: 1.65; color: #c9bea9; }

        .cases {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            display: grid;
            gap: 38px;
        }

        .case {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, .82fr) minmax(300px, 1.18fr);
            min-height: 460px;
            border: 1px solid rgba(198,154,75,.35);
            border-radius: 3px;
            background: linear-gradient(135deg, rgba(255,255,255,.035), transparent 55%), #142229;
            box-shadow: 0 30px 80px rgba(0,0,0,.25);
            overflow: hidden;
        }
        .case:nth-child(even) { grid-template-columns: minmax(300px, 1.18fr) minmax(0, .82fr); }
        .case:nth-child(even) .case-copy { order: 2; }
        .case::before {
            content: attr(data-number);
            position: absolute;
            top: -28px;
            right: 18px;
            color: rgba(233,222,196,.05);
            font: 400 13rem/1 Baskerville, "Iowan Old Style", serif;
            pointer-events: none;
        }
        .case-copy { padding: clamp(32px, 6vw, 70px); align-self: center; position: relative; }
        .case-kicker { margin: 0 0 20px; color: var(--brass); font-size: .64rem; }
        .case h3 { margin: 0; color: var(--paper-bright); font: 400 clamp(2.5rem, 5vw, 4.5rem)/.95 Baskerville, "Iowan Old Style", serif; }
        .case-prompt { margin: 24px 0 0; color: #bcb19d; line-height: 1.55; }

        .instrument {
            min-height: 100%;
            padding: clamp(34px, 6vw, 76px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: var(--ink);
            background:
                linear-gradient(rgba(68,50,27,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(68,50,27,.04) 1px, transparent 1px),
                var(--paper);
            background-size: 26px 26px;
            position: relative;
        }
        .instrument::after {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(57,42,25,.18);
            pointer-events: none;
        }
        .scale-labels { display: flex; justify-content: space-between; gap: 20px; font: 500 .62rem "Courier New", monospace; letter-spacing: .06em; text-transform: uppercase; }
        .scale-labels span:last-child { text-align: right; }
        .dial-wrap { position: relative; margin: 36px 0 30px; padding: 22px 0; }
        .sweet-spot {
            position: absolute;
            top: 19px;
            bottom: 19px;
            left: 42%;
            width: 16%;
            border: 1px dashed rgba(156,67,45,.48);
            background: rgba(156,67,45,.08);
            border-radius: 30px;
            pointer-events: none;
        }
        input[type="range"] {
            appearance: none;
            width: 100%;
            height: 4px;
            position: relative;
            z-index: 2;
            background: #76674f;
            border-radius: 0;
            outline: none;
        }
        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 8px double #412f1e;
            background: radial-gradient(circle at 35% 30%, #e5c780, #9b6d2f 62%, #5f3e1d);
            box-shadow: 0 3px 10px rgba(0,0,0,.28);
            cursor: grab;
        }
        input[type="range"]::-moz-range-thumb {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            border: 8px double #412f1e;
            background: #c29445;
            cursor: grab;
        }
        .meter { height: 38px; display: flex; align-items: center; gap: 11px; font: 400 .65rem "Courier New", monospace; letter-spacing: .06em; text-transform: uppercase; color: #6b5c47; }
        .needle { display: inline-block; width: 9px; height: 9px; border-radius: 50%; background: var(--rust); box-shadow: 0 0 0 5px rgba(156,67,45,.12); }
        .unlock {
            align-self: flex-start;
            border: 1px solid #413522;
            color: var(--paper-bright);
            background: var(--ink);
            padding: 13px 18px 11px;
            font: 500 .68rem "Courier New", monospace;
            letter-spacing: .08em;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform .2s, background .2s;
        }
        .unlock:not(:disabled):hover { transform: translateY(-2px); background: var(--rust); }
        .unlock:disabled { opacity: .35; cursor: not-allowed; }
        .quote {
            display: grid;
            grid-template-rows: 0fr;
            opacity: 0;
            transition: grid-template-rows .55s ease, opacity .55s ease, margin .55s ease;
            margin-top: 0;
        }
        .quote > div { overflow: hidden; }
        .quote blockquote { margin: 0; padding: 22px 0 0; border-top: 1px solid rgba(57,42,25,.28); font-size: 1.16rem; line-height: 1.38; font-style: italic; }
        .case.open .quote { grid-template-rows: 1fr; opacity: 1; margin-top: 28px; }
        .case.open .instrument { animation: paperFlash .7s ease; }
        .case.open .unlock { background: var(--teal); }

        .dispatch {
            width: min(900px, calc(100% - 32px));
            margin: 110px auto;
            padding: clamp(38px, 7vw, 84px);
            border-top: 1px solid var(--brass);
            border-bottom: 1px solid var(--brass);
            text-align: center;
            position: relative;
        }
        .dispatch .stamp { color: var(--brass); font-size: .64rem; }
        .dispatch h2 { margin: 18px 0 12px; font: 400 clamp(2.5rem, 6vw, 5rem)/.95 Baskerville, "Iowan Old Style", serif; color: var(--paper-bright); }
        .dispatch > p { max-width: 580px; margin: 0 auto 34px; color: #bfb39f; line-height: 1.55; }
        .note {
            display: none;
            margin: 36px auto 0;
            max-width: 670px;
            padding: 36px clamp(24px, 5vw, 48px);
            color: var(--ink);
            background: var(--paper-bright);
            text-align: left;
            transform: rotate(-.5deg);
            box-shadow: 0 22px 60px rgba(0,0,0,.3);
        }
        .note.show { display: block; animation: noteIn .7s cubic-bezier(.2,.8,.2,1) both; }
        .note .to { font: 500 .62rem "Courier New", monospace; letter-spacing: .1em; text-transform: uppercase; color: #785d38; }
        .note p { font-size: clamp(1.2rem, 3vw, 1.55rem); line-height: 1.45; margin: 18px 0 0; }
        .note strong { color: var(--rust); font-weight: 500; }
        .dispatch button { border: 1px solid var(--brass); padding: 15px 22px 13px; background: transparent; color: var(--paper); cursor: pointer; font: 500 .67rem "Courier New", monospace; letter-spacing: .08em; text-transform: uppercase; }
        .dispatch button:not(:disabled):hover { background: var(--brass); color: var(--night); }
        .dispatch button:disabled { opacity: .35; cursor: not-allowed; }

        footer {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
            padding: 0 0 50px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            color: #8d887c;
            font-size: .8rem;
        }
        footer a { text-underline-offset: 4px; }

        @keyframes settle { from { opacity: 0; transform: scale(1.05); } to { opacity: 1; transform: scale(1); } }
        @keyframes paperFlash { 50% { background-color: #fff7e5; } }
        @keyframes noteIn { from { opacity: 0; transform: translateY(30px) rotate(-2deg); } to { opacity: 1; transform: translateY(0) rotate(-.5deg); } }

        @media (max-width: 760px) {
            .hero { min-height: 86svh; }
            .hero-art { object-position: 63% center; }
            .hero::after { background: linear-gradient(0deg, rgba(9,15,18,.97) 0%, rgba(9,15,18,.66) 70%, rgba(9,15,18,.15)); }
            .hero-inner { padding-bottom: 42px; }
            h1 { font-size: clamp(3.7rem, 18vw, 6rem); }
            .lede { font-size: 1.05rem; max-width: 92%; }
            .intro { grid-template-columns: 1fr; gap: 12px; padding: 72px 0 54px; }
            .case, .case:nth-child(even) { grid-template-columns: 1fr; }
            .case:nth-child(even) .case-copy { order: initial; }
            .case-copy { min-height: 300px; }
            .instrument { min-height: 430px; }
            footer { flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <header class="hero">
        <img class="hero-art" src="flannery-paradox-cabinet-hero.webp" alt="An old typewriter and three blank pages beneath a brass lamp, with a country church beyond an open window">
        <div class="hero-inner">
            <p class="eyebrow mono">Three difficult letters · one honest machine</p>
            <h1>Flannery’s <em>Paradox Cabinet</em></h1>
            <p class="lede">Easy answers jam the lock. Hold two uncomfortable truths together, and the correspondence drawer opens.</p>
            <a class="start" href="#cabinet">Approach the cabinet <span aria-hidden="true">↓</span></a>
        </div>
    </header>

    <main id="cabinet">
        <section class="intro" aria-labelledby="instructions">
            <div class="folio mono">Filed<br>1955–64</div>
            <div>
                <h2 id="instructions">The trick is not choosing a side.</h2>
                <p>Each drawer presents a tempting pair of opposites. Move its brass dial into the narrow region where both truths remain alive. When the mechanism hums, open the drawer and receive the line hiding inside.</p>
            </div>
        </section>

        <div class="cases">
            <article class="case" data-number="1" data-left="Leave the flawed Church" data-right="Pretend the flaws do not hurt" data-key="Stay, suffer, and help">
                <div class="case-copy">
                    <p class="case-kicker mono">Drawer I · The institution</p>
                    <h3>Love without illusion</h3>
                    <p class="case-prompt">What do you do when something sacred is painfully ineffective?</p>
                </div>
                <div class="instrument">
                    <div class="scale-labels"><span>Walk away</span><span>Look away</span></div>
                    <div class="dial-wrap"><div class="sweet-spot"></div><input aria-label="Balance walking away and looking away" type="range" min="0" max="100" value="15"></div>
                    <div class="meter" aria-live="polite"><span class="needle"></span><span class="reading">An easy exit. Keep turning.</span></div>
                    <button class="unlock" type="button" disabled>Drawer locked</button>
                    <div class="quote"><div><blockquote>“Your pain at its lack of effectiveness is a sign of your nearness to God. We help overcome this lack of effectiveness simply by suffering on account of it.”</blockquote></div></div>
                </div>
            </article>

            <article class="case" data-number="2" data-left="Only study" data-right="Only feeling" data-key="Study, then pray it alive">
                <div class="case-copy">
                    <p class="case-kicker mono">Drawer II · The intellect</p>
                    <h3>Clarity with mystery</h3>
                    <p class="case-prompt">Can a formidable mind admit that understanding is not mastery?</p>
                </div>
                <div class="instrument">
                    <div class="scale-labels"><span>Diagram it all</span><span>Study nothing</span></div>
                    <div class="dial-wrap"><div class="sweet-spot"></div><input aria-label="Balance study and prayer" type="range" min="0" max="100" value="84"></div>
                    <div class="meter" aria-live="polite"><span class="needle"></span><span class="reading">Mystery without discipline. Turn back.</span></div>
                    <button class="unlock" type="button" disabled>Drawer locked</button>
                    <div class="quote"><div><blockquote>“Don’t read [St. Thomas] with the notion that he is going to clear anything up for you. That is done by study but more by prayer.”</blockquote></div></div>
                </div>
            </article>

            <article class="case" data-number="3" data-left="Demand a hero" data-right="Excuse every failure" data-key="Honour the gift in weakness">
                <div class="case-copy">
                    <p class="case-kicker mono">Drawer III · The priest</p>
                    <h3>Vocation in clay</h3>
                    <p class="case-prompt">How do you revere the offering without inventing a flawless offerer?</p>
                </div>
                <div class="instrument">
                    <div class="scale-labels"><span>Perfect hero</span><span>Nothing matters</span></div>
                    <div class="dial-wrap"><div class="sweet-spot"></div><input aria-label="Balance idealism and cynicism" type="range" min="0" max="100" value="27"></div>
                    <div class="meter" aria-live="polite"><span class="needle"></span><span class="reading">The pedestal is too high. Keep turning.</span></div>
                    <button class="unlock" type="button" disabled>Drawer locked</button>
                    <div class="quote"><div><blockquote>“A man, in spite of his intellectual limitations, his neuroticism, his own lack of strength, [can] give up his life to the service of God’s people…”</blockquote></div></div>
                </div>
            </article>
        </div>

        <section class="dispatch" aria-labelledby="dispatch-title">
            <div class="stamp mono">Final correspondence</div>
            <h2 id="dispatch-title">Type your field note</h2>
            <p>Open all three drawers and the cabinet will distil your route through them into one small rule for the next difficult thing.</p>
            <button id="compose" type="button" disabled>Open 3 drawers first</button>
            <div class="note" id="note" aria-live="polite">
                <span class="to">A note for the next hard morning</span>
                <p id="noteText"></p>
            </div>
        </section>
    </main>

    <footer>
        <a href="./">← Back to Chloe Reads Jon</a>
        <span>Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES, 'UTF-8') ?>">Flannery O’Connor quotes</a>.</span>
    </footer>

    <script>
        const cases = [...document.querySelectorAll('.case')];
        const compose = document.querySelector('#compose');
        const note = document.querySelector('#note');
        const noteText = document.querySelector('#noteText');
        const phrases = [];

        function tinyClack(pitch = 160) {
            try {
                const Ctx = window.AudioContext || window.webkitAudioContext;
                const ctx = new Ctx();
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(pitch, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(65, ctx.currentTime + .09);
                gain.gain.setValueAtTime(.045, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(.001, ctx.currentTime + .1);
                osc.connect(gain).connect(ctx.destination);
                osc.start(); osc.stop(ctx.currentTime + .11);
            } catch (_) {}
        }

        cases.forEach((card, index) => {
            const dial = card.querySelector('input');
            const reading = card.querySelector('.reading');
            const button = card.querySelector('.unlock');

            const update = () => {
                const value = Number(dial.value);
                const ready = value >= 42 && value <= 58;
                button.disabled = !ready || card.classList.contains('open');
                button.textContent = ready ? 'The mechanism hums · open' : 'Drawer locked';
                if (ready) reading.textContent = 'Both truths are still alive.';
                else if (value < 42) reading.textContent = value < 22 ? card.dataset.left : 'Closer, but one truth is fading.';
                else reading.textContent = value > 78 ? card.dataset.right : 'Closer, but one truth is fading.';
            };

            dial.addEventListener('input', update);
            button.addEventListener('click', () => {
                card.classList.add('open');
                dial.disabled = true;
                button.disabled = true;
                button.textContent = 'Correspondence received ✓';
                phrases[index] = card.dataset.key;
                tinyClack(210 + index * 45);
                const opened = cases.filter(item => item.classList.contains('open')).length;
                compose.textContent = opened === 3 ? 'Type the field note' : `Open ${3 - opened} more drawer${opened === 2 ? '' : 's'}`;
                compose.disabled = opened !== 3;
            });
            update();
        });

        compose.addEventListener('click', () => {
            noteText.innerHTML = `<strong>${phrases[0]}.</strong> ${phrases[1]}. And when the vessel looks terribly ordinary, ${phrases[2].toLowerCase()}. The faithful answer may be neither escape nor denial, but attention.`;
            note.classList.add('show');
            compose.textContent = 'Field note typed ✓';
            tinyClack(320);
            note.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    </script>
</body>
</html>
