<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#252f43">
    <title>Tomorrow's Bouquet</title>
    <style>
        @font-face { font-family: "Field Serif"; src: url('assets/tomorrows-bouquet-bookman.otf') format('opentype'); font-display: swap; }
        @font-face { font-family: "Field Sans"; src: url('assets/tomorrows-bouquet-lato.ttf') format('truetype'); font-display: swap; }

        :root {
            --ink: #27292b;
            --night: #252f43;
            --paper: #f4eddf;
            --paper-deep: #e8dcc8;
            --rose: #bd5a5f;
            --rose-dark: #853e45;
            --leaf: #4f6753;
            --gold: #d6a65d;
            --progress: 0%;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            background:
                radial-gradient(circle at 16% 8%, rgba(255,255,255,.7), transparent 28rem),
                repeating-linear-gradient(92deg, rgba(65,45,24,.022) 0 1px, transparent 1px 5px),
                var(--paper);
            font-family: "Field Sans", sans-serif;
        }

        button, textarea, input { font: inherit; }
        button { cursor: pointer; }
        a { color: inherit; }

        .hero {
            position: relative;
            min-height: min(78vh, 760px);
            display: grid;
            align-items: end;
            overflow: hidden;
            background: var(--night);
            isolation: isolate;
        }

        .hero-image, .hero-colour {
            position: absolute;
            inset: 0;
            background-image: url('assets/tomorrows-bouquet-hero.webp');
            background-size: cover;
            background-position: center 52%;
            z-index: -3;
        }

        .hero-image { filter: saturate(.25) sepia(.18) brightness(.72); }
        .hero-colour {
            z-index: -2;
            clip-path: inset(calc(100% - var(--progress)) 0 0 0);
            transition: clip-path 1.1s cubic-bezier(.2,.8,.2,1);
            filter: saturate(.9) brightness(.9);
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background: linear-gradient(90deg, rgba(21,26,36,.8) 0%, rgba(21,26,36,.38) 48%, rgba(21,26,36,.06) 72%),
                        linear-gradient(0deg, rgba(20,24,32,.86), transparent 58%);
        }

        .back {
            position: absolute;
            z-index: 2;
            top: 22px;
            left: clamp(20px, 5vw, 72px);
            color: #fff9ef;
            text-decoration: none;
            font-size: .76rem;
            letter-spacing: .13em;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(255,255,255,.45);
            padding-bottom: 4px;
        }

        .hero-copy {
            width: min(1180px, 100%);
            margin: 0 auto;
            padding: 120px clamp(22px, 6vw, 84px) clamp(50px, 8vw, 90px);
            color: #fff9ef;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 12px;
            color: #f0c98d;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
        }
        .eyebrow::before { content: ""; width: 34px; height: 1px; background: currentColor; }

        h1 {
            max-width: 680px;
            margin: 0;
            font: 600 clamp(4rem, 10vw, 8.6rem)/.75 "Field Serif", serif;
            letter-spacing: -.065em;
            text-wrap: balance;
            text-shadow: 0 3px 30px rgba(0,0,0,.28);
        }
        h1 em { color: #edb0aa; font-weight: 500; }

        .hero-note {
            max-width: 530px;
            margin: 30px 0 0;
            font: 500 clamp(1.12rem, 2vw, 1.45rem)/1.45 "Field Serif", serif;
            color: #f4eee3;
        }

        .intro {
            width: min(940px, calc(100% - 40px));
            margin: 0 auto;
            padding: 72px 0 42px;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: clamp(32px, 8vw, 100px);
            align-items: start;
        }
        .intro h2, .workbench h2 {
            margin: 0;
            font: 600 clamp(2.4rem, 6vw, 4.6rem)/.96 "Field Serif", serif;
            letter-spacing: -.04em;
        }
        .intro p { margin: 20px 0 0; line-height: 1.75; color: #51504b; }
        .margin-note {
            transform: rotate(1.5deg);
            border: 1px solid #ccb99e;
            padding: 22px 24px;
            background: rgba(255,255,255,.3);
            box-shadow: 5px 7px 0 rgba(105,77,49,.08);
            font: italic 500 1.25rem/1.45 "Field Serif", serif;
        }

        .workbench {
            width: min(1180px, calc(100% - 32px));
            margin: 18px auto 72px;
            border: 1px solid #cbbb9f;
            background: rgba(255,252,245,.66);
            box-shadow: 0 30px 80px rgba(75,54,33,.11);
            display: grid;
            grid-template-columns: minmax(0, 1.18fr) minmax(300px, .82fr);
            overflow: hidden;
        }

        .form-side { padding: clamp(28px, 5vw, 64px); }
        .step-rule { margin: 20px 0 38px; height: 4px; background: #dfd4c1; overflow: hidden; }
        .step-rule span { display: block; width: var(--progress); height: 100%; background: var(--rose); transition: width .55s ease; }

        .step { display: none; animation: arrive .5s ease both; }
        .step.active { display: block; }
        @keyframes arrive { from { opacity: 0; transform: translateY(12px); } }

        .step-no {
            display: inline-block;
            margin-bottom: 14px;
            color: var(--rose-dark);
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        .step h3, .result h3 { margin: 0 0 9px; font: 600 clamp(2rem, 5vw, 3.1rem)/1 "Field Serif", serif; }
        .prompt { max-width: 590px; margin: 0 0 24px; color: #68645d; line-height: 1.6; }

        label { display: block; margin: 18px 0 8px; font-size: .75rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; }
        textarea, input {
            width: 100%;
            border: 0;
            border-bottom: 1px solid #9d8c75;
            border-radius: 0;
            padding: 13px 4px;
            color: var(--ink);
            background: transparent;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        textarea { min-height: 104px; resize: vertical; line-height: 1.55; }
        textarea:focus, input:focus { border-color: var(--rose-dark); box-shadow: 0 2px 0 var(--rose-dark); }

        .examples { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 15px; }
        .example {
            border: 1px solid #c9b99f;
            border-radius: 999px;
            padding: 8px 12px;
            background: transparent;
            color: #675d50;
            font-size: .75rem;
        }
        .example:hover { background: #ece0cc; border-color: #a48a68; }

        .actions { display: flex; align-items: center; gap: 14px; margin-top: 30px; }
        .next, .copy {
            border: 0;
            padding: 13px 21px;
            background: var(--night);
            color: white;
            font-weight: 600;
            box-shadow: 4px 4px 0 var(--gold);
            transition: transform .18s, box-shadow .18s;
        }
        .next:hover, .copy:hover { transform: translate(-2px,-2px); box-shadow: 6px 6px 0 var(--gold); }
        .next:disabled { opacity: .4; cursor: not-allowed; transform: none; }
        .previous, .reset { border: 0; background: none; color: #686057; text-decoration: underline; padding: 10px 0; }
        .error { min-height: 1.2em; margin-top: 10px; color: var(--rose-dark); font-size: .78rem; }

        .garden-side {
            position: relative;
            min-height: 620px;
            overflow: hidden;
            background: var(--night);
            color: white;
            border-left: 1px solid #cbbb9f;
        }
        .garden-side::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: .12;
            background-image: radial-gradient(#fff 0.7px, transparent .8px);
            background-size: 7px 7px;
        }
        .garden-label { position: absolute; top: 28px; left: 30px; right: 30px; z-index: 2; }
        .garden-label span { font-size: .68rem; letter-spacing: .18em; text-transform: uppercase; color: #e3bc80; }
        .garden-label p { max-width: 310px; margin: 9px 0; font: italic 1.12rem/1.35 "Field Serif", serif; color: #eae2d7; }

        .bouquet { position: absolute; inset: 90px 0 0; }
        .stem {
            position: absolute;
            bottom: -15px;
            left: 50%;
            width: 5px;
            height: 380px;
            border-radius: 50%;
            background: linear-gradient(90deg,#283c2b,#769078,#344b38);
            transform-origin: bottom;
            transform: translateX(-50%) rotate(var(--angle)) scaleY(.08);
            transition: transform .85s cubic-bezier(.2,.9,.25,1);
        }
        .stem::after {
            content: "";
            position: absolute;
            top: 48%;
            left: -21px;
            width: 45px;
            height: 18px;
            border-radius: 100% 0 100% 0;
            background: #58705b;
            transform: rotate(-22deg);
        }
        .flower {
            position: absolute;
            top: -38px;
            left: 50%;
            width: 78px;
            height: 78px;
            transform: translateX(-50%) scale(0) rotate(-20deg);
            transition: transform .75s .45s cubic-bezier(.2,1.4,.45,1);
        }
        .petal, .flower::after {
            position: absolute;
            content: "";
            width: 43px;
            height: 53px;
            left: 18px;
            top: 12px;
            border-radius: 60% 45% 55% 45%;
            background: linear-gradient(140deg,#efb0a5,#a8414d);
            transform: rotate(calc(var(--i) * 72deg)) translateY(-13px);
            transform-origin: 50% 28px;
            box-shadow: inset 4px 3px 8px rgba(255,255,255,.22);
        }
        .flower::after { width: 27px; height: 27px; top: 26px; left: 26px; border-radius: 50%; transform: none; background: #d47772; }
        .stem.grown { transform: translateX(-50%) rotate(var(--angle)) scaleY(1); }
        .stem.grown .flower { transform: translateX(-50%) scale(1) rotate(0deg); }
        .stem:nth-child(1) { --angle: -16deg; height: 360px; }
        .stem:nth-child(2) { --angle: 1deg; height: 420px; }
        .stem:nth-child(3) { --angle: 18deg; height: 345px; }

        .ribbon {
            position: absolute;
            left: 50%;
            bottom: 58px;
            width: 130px;
            height: 43px;
            transform: translateX(-50%) rotate(-4deg);
            background: #b87763;
            clip-path: polygon(0 10%,100% 0,88% 50%,100% 100%,0 88%,11% 48%);
            opacity: 0;
            transition: opacity .5s .8s;
        }
        .ribbon.show { opacity: .9; }

        .result { display: none; }
        .result.active { display: block; animation: arrive .6s ease both; }
        .field-note { position: relative; margin: 24px 0; padding: 26px; background: #ece0cd; border: 1px solid #c8b79b; }
        .field-note::before { content: "FIELD NOTE  •  TOMORROW"; display: block; margin-bottom: 17px; color: var(--rose-dark); font-size: .65rem; font-weight: 600; letter-spacing: .15em; }
        .field-note p { margin: 0 0 13px; line-height: 1.55; }
        .field-note p:last-child { margin: 0; }
        .field-note strong { color: var(--rose-dark); }

        .source {
            width: min(940px, calc(100% - 40px));
            margin: 0 auto 70px;
            padding-top: 24px;
            border-top: 1px solid #cbbb9f;
            color: #70675b;
            font: italic 1.05rem/1.5 "Field Serif", serif;
        }
        .source a { color: var(--rose-dark); text-underline-offset: 3px; }

        .toast { position: fixed; left: 50%; bottom: 22px; z-index: 20; transform: translate(-50%, 80px); opacity: 0; padding: 11px 18px; color: white; background: var(--night); transition: .3s; }
        .toast.show { transform: translate(-50%,0); opacity: 1; }

        @media (max-width: 760px) {
            .hero { min-height: 650px; }
            .hero-image, .hero-colour { background-position: 59% center; }
            .hero::after { background: linear-gradient(0deg,rgba(20,24,32,.92) 0%,rgba(20,24,32,.16) 78%); }
            h1 { font-size: clamp(3.5rem, 15vw, 5.5rem); }
            .intro { grid-template-columns: 1fr; }
            .margin-note { margin-left: 8vw; }
            .workbench { grid-template-columns: 1fr; }
            .garden-side { min-height: 500px; border-left: 0; border-top: 1px solid #cbbb9f; }
            .bouquet { transform: scale(.82); transform-origin: center bottom; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <header class="hero" id="top">
        <div class="hero-image" aria-hidden="true"></div>
        <div class="hero-colour" aria-hidden="true"></div>
        <a class="back" href="./">← Chloe Reads Jon</a>
        <div class="hero-copy">
            <p class="eyebrow">A small practice for imperfect people</p>
            <h1>Tomorrow’s <em>Bouquet</em></h1>
            <p class="hero-note">The moment cannot be replayed. Love, inconveniently and wonderfully, still gets another move.</p>
        </div>
    </header>

    <main>
        <section class="intro">
            <div>
                <h2>Regret is not a time machine.</h2>
                <p>It can still be useful. Name what was yours without wriggling away from it. Release what is now beyond your reach. Then choose one small, specific good that can exist because you noticed the miss.</p>
            </div>
            <aside class="margin-note">“Yes, it was my fault. And good can still come of it.”</aside>
        </section>

        <section class="workbench" aria-labelledby="work-title">
            <div class="form-side">
                <h2 id="work-title">Grow a repair.</h2>
                <div class="step-rule" aria-hidden="true"><span></span></div>

                <div class="step active" data-step="0">
                    <span class="step-no">Stem one · honesty</span>
                    <h3>Name the miss.</h3>
                    <p class="prompt">One clean sentence. No prosecution, no defence brief.</p>
                    <label for="miss">What happened?</label>
                    <textarea id="miss" maxlength="240" placeholder="I said I would be there, and I lost track of the time."></textarea>
                    <div class="examples">
                        <button class="example" data-target="miss" data-text="I forgot something that mattered to someone I love.">I forgot</button>
                        <button class="example" data-target="miss" data-text="I spoke more sharply than the moment deserved.">Sharp words</button>
                        <button class="example" data-target="miss" data-text="I was present in the room, but my attention was elsewhere.">Distracted</button>
                    </div>
                    <p class="error" role="alert"></p>
                    <div class="actions"><button class="next">Plant the first stem</button></div>
                </div>

                <div class="step" data-step="1">
                    <span class="step-no">Stem two · surrender</span>
                    <h3>Close the impossible door.</h3>
                    <p class="prompt">What part can no longer be changed, however many times your mind circles it?</p>
                    <label for="past">I cannot now change…</label>
                    <textarea id="past" maxlength="240" placeholder="…that they waited, or make that particular moment go perfectly."></textarea>
                    <div class="examples">
                        <button class="example" data-target="past" data-text="the first disappointment, or make the moment unfold perfectly.">The first sting</button>
                        <button class="example" data-target="past" data-text="the words that were already heard.">The words heard</button>
                        <button class="example" data-target="past" data-text="the time that has already passed.">The lost time</button>
                    </div>
                    <p class="error" role="alert"></p>
                    <div class="actions"><button class="previous">Back</button><button class="next">Let it be past</button></div>
                </div>

                <div class="step" data-step="2">
                    <span class="step-no">Stem three · repair</span>
                    <h3>Choose tomorrow’s good.</h3>
                    <p class="prompt">Make it small enough to do, warm enough to matter, and concrete enough to know when it is done.</p>
                    <label for="good">I will…</label>
                    <textarea id="good" maxlength="240" placeholder="…apologize without an excuse, then bring the roses tomorrow."></textarea>
                    <label for="when">When?</label>
                    <input id="when" maxlength="80" placeholder="Tomorrow after breakfast">
                    <div class="examples">
                        <button class="example" data-target="good" data-text="apologize plainly, without tucking an excuse inside it.">A clean apology</button>
                        <button class="example" data-target="good" data-text="make a fresh invitation instead of mourning the missed one.">Invite again</button>
                        <button class="example" data-target="good" data-text="give ten undistracted minutes and let the other person choose how to use them.">Offer attention</button>
                    </div>
                    <p class="error" role="alert"></p>
                    <div class="actions"><button class="previous">Back</button><button class="next">Tie the bouquet</button></div>
                </div>

                <div class="result" aria-live="polite">
                    <span class="step-no">Three stems · one next move</span>
                    <h3>Your field note</h3>
                    <p class="prompt">Not proof that the miss did not matter. Proof that it need not have the last word.</p>
                    <div class="field-note" id="field-note"></div>
                    <div class="actions"><button class="copy">Copy my next move</button><button class="reset">Begin again</button></div>
                </div>
            </div>

            <aside class="garden-side" aria-label="A bouquet that blooms as you complete the reflection">
                <div class="garden-label"><span>The repair garden</span><p id="garden-caption">A bare stem is enough to begin.</p></div>
                <div class="bouquet" aria-hidden="true">
                    <div class="stem"><div class="flower"><i class="petal" style="--i:0"></i><i class="petal" style="--i:1"></i><i class="petal" style="--i:2"></i><i class="petal" style="--i:3"></i><i class="petal" style="--i:4"></i></div></div>
                    <div class="stem"><div class="flower"><i class="petal" style="--i:0"></i><i class="petal" style="--i:1"></i><i class="petal" style="--i:2"></i><i class="petal" style="--i:3"></i><i class="petal" style="--i:4"></i></div></div>
                    <div class="stem"><div class="flower"><i class="petal" style="--i:0"></i><i class="petal" style="--i:1"></i><i class="petal" style="--i:2"></i><i class="petal" style="--i:3"></i><i class="petal" style="--i:4"></i></div></div>
                    <div class="ribbon"></div>
                </div>
            </aside>
        </section>

        <p class="source">This little garden was inspired by Jon’s <a href="https://jona.ca/2012/01/on-forgetting-anniversary.html">“On forgetting an anniversary”</a>, a candid note about roses left in the car, guilt, and trusting that God can bring something good even from a failure that really was ours.</p>
    </main>
    <div class="toast" role="status">Copied. Tomorrow has a next move.</div>

    <script>
        const root = document.documentElement;
        const steps = [...document.querySelectorAll('.step')];
        const stems = [...document.querySelectorAll('.stem')];
        const result = document.querySelector('.result');
        const caption = document.querySelector('#garden-caption');
        const captions = ['A bare stem is enough to begin.', 'Honesty has put down a root.', 'The past has been given its boundary.', 'Good gets another move.'];
        const fields = ['miss', 'past', 'good'];
        let current = 0;

        function setProgress(n) {
            const percent = n === 3 ? 100 : n * 33;
            root.style.setProperty('--progress', percent + '%');
            stems.forEach((stem, i) => stem.classList.toggle('grown', i < n));
            document.querySelector('.ribbon').classList.toggle('show', n === 3);
            caption.textContent = captions[n];
        }

        function showStep(index) {
            current = index;
            steps.forEach((s, i) => s.classList.toggle('active', i === index));
            result.classList.remove('active');
            setProgress(index);
            steps[index].querySelector('textarea, input').focus({preventScroll: true});
        }

        document.querySelectorAll('.example').forEach(button => {
            button.addEventListener('click', () => {
                const field = document.getElementById(button.dataset.target);
                field.value = button.dataset.text;
                field.dispatchEvent(new Event('input'));
                field.focus();
            });
        });

        document.querySelectorAll('.next').forEach(button => {
            button.addEventListener('click', () => {
                const step = button.closest('.step');
                const mainField = document.getElementById(fields[current]);
                const error = step.querySelector('.error');
                if (!mainField.value.trim()) {
                    error.textContent = 'Give this stem a few honest words first.';
                    mainField.focus();
                    return;
                }
                error.textContent = '';
                if (current < 2) {
                    stems[current].classList.add('grown');
                    setTimeout(() => showStep(current + 1), 390);
                } else {
                    finish();
                }
            });
        });

        document.querySelectorAll('.previous').forEach(button => {
            button.addEventListener('click', () => showStep(Math.max(0, current - 1)));
        });

        function cleanSentence(value) {
            const trimmed = value.trim();
            return trimmed ? trimmed.charAt(0).toUpperCase() + trimmed.slice(1).replace(/[.!?]*$/, '') + '.' : '';
        }

        function finish() {
            steps.forEach(s => s.classList.remove('active'));
            setProgress(3);
            const miss = cleanSentence(document.getElementById('miss').value);
            const past = cleanSentence(document.getElementById('past').value);
            const good = cleanSentence(document.getElementById('good').value);
            const when = document.getElementById('when').value.trim() || 'At the next real opportunity';
            document.querySelector('#field-note').innerHTML = `
                <p><strong>I own:</strong> ${escapeHTML(miss)}</p>
                <p><strong>I release:</strong> ${escapeHTML(past)}</p>
                <p><strong>I will:</strong> ${escapeHTML(good)}</p>
                <p><strong>When:</strong> ${escapeHTML(when)}</p>`;
            result.classList.add('active');
            result.scrollIntoView({behavior: 'smooth', block: 'center'});
        }

        function escapeHTML(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        document.querySelector('.copy').addEventListener('click', async () => {
            const text = document.querySelector('#field-note').innerText;
            try { await navigator.clipboard.writeText(text); }
            catch { /* Clipboard may be unavailable in a non-secure preview. */ }
            const toast = document.querySelector('.toast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2200);
        });

        document.querySelector('.reset').addEventListener('click', () => {
            document.querySelectorAll('textarea, input').forEach(field => field.value = '');
            showStep(0);
            document.querySelector('.workbench').scrollIntoView({behavior:'smooth', block:'start'});
        });

        document.querySelectorAll('textarea').forEach(field => {
            field.addEventListener('input', () => field.closest('.step').querySelector('.error').textContent = '');
        });
        setProgress(0);
    </script>
</body>
</html>
