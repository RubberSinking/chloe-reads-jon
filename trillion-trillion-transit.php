<?php
$sourceUrl = 'https://jona.ca/2012/04/1024-trillion-trillion-number-of-stars.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#061521">
    <title>Trillion Trillion Transit</title>
    <style>
        :root {
            --night: #061521;
            --deep: #0a2330;
            --ink: #10242a;
            --cream: #f3ead4;
            --paper: #e4d7b7;
            --gold: #f0b84b;
            --cyan: #68c7c2;
            --rust: #b94f35;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            overflow-x: hidden;
            background: var(--night);
            color: var(--cream);
            font-family: "Avenir Next", "Century Gothic", Futura, sans-serif;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 20;
            opacity: .13;
            mix-blend-mode: screen;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.32'/%3E%3C/svg%3E");
        }
        a { color: inherit; }
        button, input { font: inherit; }
        .hero {
            position: relative;
            min-height: min(820px, 100svh);
            isolation: isolate;
            display: grid;
            align-items: end;
            overflow: hidden;
            background: #04111c url("trillion-transit.webp") 50% 50% / cover no-repeat;
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: -1;
            background: linear-gradient(180deg, rgba(2,12,20,.12) 0%, rgba(2,12,20,.08) 44%, rgba(2,12,20,.94) 100%);
        }
        .nav {
            position: absolute;
            top: 0;
            left: 50%;
            width: min(1200px, calc(100% - 32px));
            transform: translateX(-50%);
            display: flex;
            justify-content: space-between;
            padding: 24px 0;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
        }
        .nav a { text-decoration: none; border-bottom: 1px solid rgba(255,255,255,.46); padding-bottom: 4px; }
        .orbit { display: flex; align-items: center; gap: 9px; }
        .orbit::before { content: ""; width: 7px; height: 7px; border: 1px solid var(--gold); border-radius: 50%; box-shadow: 0 0 14px var(--gold); }
        .hero-copy {
            width: min(1200px, calc(100% - 32px));
            margin: 0 auto;
            padding: 80px 0 clamp(42px, 7vw, 76px);
        }
        .eyebrow { margin: 0 0 14px; color: var(--gold); font-size: .72rem; font-weight: 800; letter-spacing: .18em; text-transform: uppercase; }
        h1 {
            max-width: 970px;
            margin: 0;
            font-family: Didot, "Bodoni MT", "Iowan Old Style", Georgia, serif;
            font-size: clamp(3.5rem, 10.4vw, 9.7rem);
            font-weight: 700;
            letter-spacing: -.07em;
            line-height: .77;
            text-wrap: balance;
            text-shadow: 0 5px 30px rgba(0,0,0,.5);
        }
        h1 em { display: block; color: var(--gold); font-weight: 400; }
        .hero-bottom { display: flex; align-items: end; justify-content: space-between; gap: 30px; margin-top: 28px; }
        .hero-bottom p { max-width: 610px; margin: 0; font-family: Georgia, serif; font-size: clamp(1rem, 2vw, 1.25rem); line-height: 1.55; }
        .scroll-cue { white-space: nowrap; color: var(--cyan); font-size: .65rem; font-weight: 800; letter-spacing: .16em; text-transform: uppercase; }
        .scroll-cue::after { content: " ↓"; color: var(--gold); }

        .lab {
            position: relative;
            min-height: 100vh;
            padding: clamp(54px, 8vw, 110px) 16px;
            color: var(--ink);
            background:
                linear-gradient(90deg, transparent 49.8%, rgba(16,36,42,.08) 50%, transparent 50.2%),
                var(--cream);
        }
        .lab-wrap { width: min(1100px, 100%); margin: 0 auto; }
        .lab-head { display: grid; grid-template-columns: 1.1fr .9fr; align-items: end; gap: 42px; margin-bottom: 54px; }
        .section-no { color: var(--rust); font-size: .68rem; font-weight: 900; letter-spacing: .18em; text-transform: uppercase; }
        h2 { margin: 10px 0 0; font-family: Didot, "Bodoni MT", Georgia, serif; font-size: clamp(2.6rem, 6vw, 5.7rem); line-height: .88; letter-spacing: -.05em; }
        .lab-head p { margin: 0; font-family: Georgia, serif; font-size: 1.05rem; line-height: 1.65; }
        .machine {
            border: 1px solid rgba(16,36,42,.3);
            box-shadow: 12px 12px 0 var(--ink);
            background: var(--paper);
        }
        .machine-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 18px;
            color: var(--cream);
            background: var(--ink);
            font-size: .62rem;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }
        .display { padding: clamp(24px, 5vw, 54px); overflow: hidden; }
        .power-row { display: flex; align-items: baseline; gap: 14px; }
        .power { font-family: Didot, "Bodoni MT", Georgia, serif; font-size: clamp(5rem, 16vw, 13rem); line-height: .68; letter-spacing: -.08em; }
        .power sup { color: var(--rust); font-size: .34em; }
        .nickname { color: var(--rust); font-size: clamp(.75rem, 1.4vw, .95rem); font-weight: 900; letter-spacing: .13em; text-transform: uppercase; }
        .long-number {
            min-height: 3.2em;
            margin: 32px 0 19px;
            overflow-wrap: anywhere;
            color: var(--deep);
            font-family: "Courier New", monospace;
            font-size: clamp(1.25rem, 3.8vw, 2.75rem);
            font-weight: 700;
            letter-spacing: .045em;
            line-height: 1.15;
        }
        .long-number .new { color: var(--rust); animation: pop .22s ease-out; display: inline-block; }
        .analogy { min-height: 3em; max-width: 700px; margin: 0; font-family: Georgia, serif; font-size: clamp(1rem, 2.2vw, 1.35rem); line-height: 1.45; }
        .controls { padding: 22px clamp(24px, 5vw, 54px) 32px; border-top: 1px solid rgba(16,36,42,.25); }
        .range-labels { display: flex; justify-content: space-between; margin-bottom: 9px; color: rgba(16,36,42,.65); font-size: .59rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; }
        input[type="range"] { width: 100%; accent-color: var(--rust); cursor: ew-resize; }
        .quick-powers { display: flex; flex-wrap: wrap; gap: 9px; margin-top: 20px; }
        .quick-powers button {
            border: 1px solid var(--ink);
            padding: 8px 12px;
            color: var(--ink);
            background: transparent;
            cursor: pointer;
            font-size: .66rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            transition: .18s ease;
        }
        .quick-powers button:hover, .quick-powers button:focus-visible, .quick-powers button.active { color: var(--cream); background: var(--ink); outline: none; transform: translateY(-2px); }

        .duality { background: var(--deep); padding: clamp(64px, 9vw, 120px) 16px; }
        .duality-wrap { width: min(1100px, 100%); margin: 0 auto; }
        .duality-head { text-align: center; }
        .duality h2 { max-width: 850px; margin: 12px auto 22px; }
        .duality-head p { max-width: 650px; margin: 0 auto 48px; color: #afc8c7; font-family: Georgia, serif; line-height: 1.6; }
        .scales { display: grid; grid-template-columns: 1fr 90px 1fr; align-items: stretch; }
        .scale-card { position: relative; min-height: 400px; overflow: hidden; border: 1px solid rgba(255,255,255,.2); padding: clamp(28px, 4vw, 48px); background: rgba(3,14,22,.5); }
        .scale-card h3 { margin: 0; font-family: Didot, "Bodoni MT", Georgia, serif; font-size: clamp(2.4rem, 4vw, 4rem); line-height: .95; }
        .scale-card p { max-width: 390px; color: #b9cdcb; font-family: Georgia, serif; line-height: 1.6; }
        .cube-visual { position: absolute; right: 8%; bottom: 5%; width: 155px; aspect-ratio: 1; border: 2px solid var(--gold); transform: rotate(8deg); box-shadow: inset 0 0 50px rgba(240,184,75,.2), 0 0 30px rgba(240,184,75,.2); }
        .cube-visual::before, .cube-visual::after { content: ""; position: absolute; width: 4px; height: 4px; border-radius: 50%; background: var(--gold); box-shadow: 20px 11px var(--gold), 58px 29px var(--gold), 104px 16px var(--gold), 31px 82px var(--gold), 124px 101px var(--gold), 75px 124px var(--gold), 14px 135px var(--gold); }
        .cube-visual::after { left: 7px; top: 5px; transform: rotate(77deg); opacity: .65; }
        .galaxy-visual { position: absolute; right: 7%; bottom: 8%; width: 190px; height: 120px; border-radius: 50%; border: 2px solid var(--cyan); transform: rotate(-15deg); box-shadow: inset 0 0 45px var(--cyan), 0 0 40px rgba(104,199,194,.35); }
        .galaxy-visual::before { content: ""; position: absolute; inset: 37%; border-radius: 50%; background: var(--gold); box-shadow: 0 0 24px 7px var(--gold); }
        .equals { display: grid; place-items: center; color: var(--gold); font-family: Didot, Georgia, serif; font-size: 5rem; }
        .reveal { display: block; margin: 45px auto 0; border: 1px solid var(--gold); padding: 14px 20px; color: var(--gold); background: transparent; cursor: pointer; font-size: .7rem; font-weight: 900; letter-spacing: .14em; text-transform: uppercase; }
        .reveal:hover, .reveal:focus-visible { background: var(--gold); color: var(--night); outline: none; }
        .verdict { max-height: 0; overflow: hidden; max-width: 800px; margin: 0 auto; text-align: center; font-family: Georgia, serif; font-size: clamp(1.2rem, 2.5vw, 1.7rem); line-height: 1.55; opacity: 0; transition: .7s ease; }
        .verdict.open { max-height: 300px; margin-top: 35px; opacity: 1; }

        footer { padding: 42px 16px 56px; text-align: center; color: #8daaaa; background: #041018; font-size: .76rem; line-height: 1.7; }
        footer a { color: var(--gold); text-underline-offset: 3px; }
        @keyframes pop { from { transform: scale(1.8); opacity: .2; } }
        @media (max-width: 760px) {
            .hero { min-height: 760px; background-position: 45% center; }
            .nav .orbit { display: none; }
            .hero-bottom { display: block; }
            .scroll-cue { display: inline-block; margin-top: 20px; }
            .lab-head { grid-template-columns: 1fr; gap: 22px; }
            .scales { grid-template-columns: 1fr; }
            .equals { height: 80px; }
            .scale-card { min-height: 330px; }
            .machine { box-shadow: 7px 7px 0 var(--ink); }
        }
        @media (prefers-reduced-motion: reduce) { * { scroll-behavior: auto !important; animation: none !important; transition: none !important; } }
    </style>
</head>
<body>
    <header class="hero">
        <nav class="nav">
            <a href="./">← Chloe Reads Jon</a>
            <span class="orbit">Scale Observatory · Field Note 1024</span>
        </nav>
        <div class="hero-copy">
            <p class="eyebrow">A journey to the 24th zero</p>
            <h1>Trillion <em>Trillion Transit</em></h1>
            <div class="hero-bottom">
                <p>One impossible number hides in two places: the stars of the universe and the air beside your elbow. Take the long way to 10<sup>24</sup>.</p>
                <span class="scroll-cue">Enter the counter</span>
            </div>
        </div>
    </header>

    <main>
        <section class="lab" id="counter">
            <div class="lab-wrap">
                <div class="lab-head">
                    <div><span class="section-no">Experiment 01 / Count beyond instinct</span><h2>Ride the exponent.</h2></div>
                    <p>Each click to the right multiplies the number by ten. Your intuition will give up early. That is not a defect in your intuition. Twenty-four zeros are simply showing off.</p>
                </div>
                <div class="machine">
                    <div class="machine-top"><span>Magnitude engine</span><span id="readout">Exponent 0 of 24</span></div>
                    <div class="display" aria-live="polite">
                        <div class="power-row"><div class="power">10<sup id="exponent">0</sup></div><div class="nickname" id="nickname">One ordinary thing</div></div>
                        <div class="long-number" id="longNumber">1</div>
                        <p class="analogy" id="analogy">A single point. Intuition is still fully operational.</p>
                    </div>
                    <div class="controls">
                        <div class="range-labels"><span>Human-sized</span><span>Intuition ends somewhere here</span><span>Cosmic</span></div>
                        <input id="powerSlider" type="range" min="0" max="24" value="0" step="1" aria-label="Power of ten">
                        <div class="quick-powers">
                            <button data-power="3">Thousand</button><button data-power="6">Million</button><button data-power="9">Billion</button><button data-power="12">Trillion</button><button data-power="18">Quintillion</button><button data-power="24">Trillion trillion</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="duality">
            <div class="duality-wrap">
                <div class="duality-head">
                    <span class="section-no">Experiment 02 / The impossible coincidence</span>
                    <h2>Look outward. Breathe inward.</h2>
                    <p>These are rough, order-of-magnitude comparisons, the sort of estimate that gives an enormous number somewhere to live in your mind.</p>
                </div>
                <div class="scales">
                    <article class="scale-card"><span class="section-no">Within reach</span><h3>A cubic foot<br>of air</h3><p>About the volume of a small bedside cabinet, holding on the order of a trillion trillion molecules.</p><div class="cube-visual" aria-hidden="true"></div></article>
                    <div class="equals" aria-hidden="true">≈</div>
                    <article class="scale-card"><span class="section-no">Beyond reach</span><h3>All the stars<br>we estimate</h3><p>Roughly a trillion galaxies times roughly a trillion stars per galaxy: another route to 10<sup>24</sup>.</p><div class="galaxy-visual" aria-hidden="true"></div></article>
                </div>
                <button class="reveal" id="reveal" aria-expanded="false">Open the observation hatch</button>
                <p class="verdict" id="verdict">The point is not that air and stars are secretly the same. It is that the ordinary world is already carrying cosmic-sized crowds. Immensity is not only far away. You are breathing it.</p>
            </div>
        </section>
    </main>
    <footer>
        Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>">“10<sup>24</sup> (a trillion trillion)”</a>.<br>
        Estimates are intentionally approximate. Wonder survives the rounding.
    </footer>

    <script>
        const slider = document.getElementById('powerSlider');
        const exponent = document.getElementById('exponent');
        const longNumber = document.getElementById('longNumber');
        const nickname = document.getElementById('nickname');
        const analogy = document.getElementById('analogy');
        const readout = document.getElementById('readout');
        const buttons = [...document.querySelectorAll('[data-power]')];
        const names = {0:'One ordinary thing',3:'One thousand',6:'One million',9:'One billion',12:'One trillion',15:'One quadrillion',18:'One quintillion',21:'One sextillion',24:'One trillion trillion'};
        const notes = [
            [0,'A single point. Intuition is still fully operational.'],
            [3,'A thousand seconds is about seventeen minutes. Easy enough.'],
            [6,'A million seconds is nearly twelve days. The staircase is getting steep.'],
            [9,'A billion seconds is about thirty-two years. Same three extra zeros; very different wait.'],
            [12,'A trillion seconds is more than 31,000 years. Your mental picture has officially resigned.'],
            [18,'A quintillion grains would laugh at the largest sandbox you can imagine.'],
            [21,'At this scale, writing every zero begins to feel like an activity with poor management.'],
            [24,'Destination reached: roughly the stars in the universe, and roughly the molecules in a cubic foot of air.']
        ];
        function commaNumber(power) {
            const raw = '1' + '0'.repeat(power);
            return raw.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
        function update() {
            const p = Number(slider.value);
            exponent.textContent = p;
            readout.textContent = `Exponent ${p} of 24`;
            const formatted = commaNumber(p);
            const split = formatted.length - 1;
            longNumber.innerHTML = formatted.slice(0, split) + `<span class="new">${formatted.slice(split)}</span>`;
            nickname.textContent = names[p] || `${p} zeros and climbing`;
            analogy.textContent = [...notes].reverse().find(([at]) => p >= at)[1];
            buttons.forEach(b => b.classList.toggle('active', Number(b.dataset.power) === p));
            slider.style.background = `linear-gradient(90deg, var(--rust) ${p/24*100}%, rgba(16,36,42,.22) ${p/24*100}%)`;
        }
        slider.addEventListener('input', update);
        buttons.forEach(button => button.addEventListener('click', () => { slider.value = button.dataset.power; update(); }));
        const reveal = document.getElementById('reveal');
        const verdict = document.getElementById('verdict');
        reveal.addEventListener('click', () => {
            const open = verdict.classList.toggle('open');
            reveal.setAttribute('aria-expanded', String(open));
            reveal.textContent = open ? 'Close the observation hatch' : 'Open the observation hatch';
        });
        update();
    </script>
</body>
</html>
