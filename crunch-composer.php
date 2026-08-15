<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#8c2f22">
    <title>The Crunch Composer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Nunito+Sans:wght@500;700;900&display=swap');

        :root {
            --cider: #9f3524;
            --cider-dark: #562018;
            --cream: #fff4d8;
            --paper: #f1dcae;
            --ink: #29271e;
            --green: #294f3a;
            --gold: #e2a42b;
            --teal: #2f7771;
        }

        * { box-sizing: border-box; }
        html { min-height: 100%; background: var(--cider-dark); }
        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ink);
            font-family: "Nunito Sans", sans-serif;
            background:
                radial-gradient(circle at 12% 12%, rgba(255,244,216,.2), transparent 22rem),
                repeating-linear-gradient(95deg, rgba(255,255,255,.025) 0 1px, transparent 1px 5px),
                var(--cider-dark);
        }

        button, a { -webkit-tap-highlight-color: transparent; }
        button { font: inherit; }

        .page {
            width: min(1180px, 100%);
            margin: 0 auto;
            padding: clamp(18px, 4vw, 52px);
            display: grid;
            grid-template-columns: minmax(0, 1.12fr) minmax(280px, .72fr);
            gap: clamp(24px, 5vw, 72px);
            align-items: center;
        }

        .masthead {
            grid-column: 1 / -1;
            color: var(--cream);
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 24px;
        }

        .eyebrow {
            margin: 0 0 8px;
            color: #f4bf4b;
            font-size: .72rem;
            font-weight: 900;
            letter-spacing: .2em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            max-width: 760px;
            font: 400 clamp(3rem, 8.7vw, 7.7rem)/.78 "DM Serif Display", serif;
            letter-spacing: -.045em;
            text-wrap: balance;
        }

        h1 em { color: #f3bd43; font-weight: 400; }

        .intro {
            width: min(340px, 100%);
            margin: 0 0 6px;
            color: #f7e8c6;
            font-size: clamp(.92rem, 1.7vw, 1.05rem);
            line-height: 1.55;
        }

        .stage {
            position: relative;
            aspect-ratio: 1;
            isolation: isolate;
            border-radius: 8% 11% 7% 12%;
            box-shadow: 0 35px 75px rgba(26, 7, 4, .48), 0 4px 0 rgba(255,255,255,.2) inset;
            transform: rotate(-1deg);
            overflow: hidden;
            background: #e9cda0;
        }

        .stage::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 5;
            pointer-events: none;
            opacity: .16;
            mix-blend-mode: multiply;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.75' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.35'/%3E%3C/svg%3E");
        }

        .plate-art { width: 100%; height: 100%; display: block; object-fit: cover; }
        #bites { position: absolute; inset: 19% 17% 19% 17%; z-index: 2; }

        .piece {
            position: absolute;
            left: var(--x);
            top: var(--y);
            transform: translate(-50%, -50%) rotate(var(--r));
            filter: drop-shadow(0 6px 4px rgba(73, 38, 19, .24));
            animation: tumble .58s cubic-bezier(.18,.86,.24,1.2) both;
        }

        .apple-slice {
            width: clamp(42px, 10vw, 96px);
            aspect-ratio: 1.55;
            border-radius: 50% 47% 49% 46%;
            background:
                radial-gradient(ellipse at 51% 54%, #a66a28 0 3%, transparent 3.8%),
                radial-gradient(ellipse at 38% 58%, #66351f 0 3%, transparent 3.8%),
                radial-gradient(ellipse at 63% 58%, #66351f 0 3%, transparent 3.8%),
                radial-gradient(ellipse at 50% 48%, #fff6ce 0 61%, transparent 63%),
                #b93b28;
            border: 3px solid #8c2f22;
            clip-path: polygon(2% 28%, 15% 7%, 50% 0, 86% 8%, 100% 30%, 92% 80%, 57% 100%, 43% 100%, 8% 80%);
        }

        .almond {
            width: clamp(20px, 4.4vw, 43px);
            aspect-ratio: .56;
            border: 2px solid #76401e;
            border-radius: 90% 15% 90% 15%;
            background: repeating-linear-gradient(104deg, #d49745 0 3px, #b8732e 3px 5px);
        }

        @keyframes tumble {
            from { opacity: 0; transform: translate(-50%, -180%) rotate(calc(var(--r) - 110deg)) scale(.4); }
            68% { opacity: 1; transform: translate(-50%, -44%) rotate(calc(var(--r) + 8deg)) scale(1.08); }
        }

        .roundel {
            position: absolute;
            top: 3%; left: 3%;
            z-index: 6;
            width: clamp(70px, 13vw, 122px);
            aspect-ratio: 1;
            display: grid;
            place-items: center;
            text-align: center;
            border-radius: 50%;
            background: var(--green);
            color: var(--cream);
            border: 3px double var(--paper);
            transform: rotate(-9deg);
            font: 400 clamp(.7rem, 1.6vw, 1rem)/1.05 "DM Serif Display", serif;
            box-shadow: 0 5px 12px rgba(0,0,0,.25);
        }

        .panel {
            position: relative;
            background: var(--cream);
            padding: clamp(20px, 4vw, 38px);
            border-radius: 4px 34px 4px 34px;
            box-shadow: 12px 14px 0 #32140f, 18px 20px 35px rgba(0,0,0,.22);
        }

        .panel::before {
            content: "SNACK LAB No. 1";
            position: absolute;
            top: 0; right: 26px;
            padding: 8px 12px;
            background: var(--green);
            color: var(--cream);
            font-size: .62rem;
            font-weight: 900;
            letter-spacing: .14em;
        }

        h2 { margin: 0 0 7px; font: 400 clamp(1.7rem, 4vw, 2.6rem)/1 "DM Serif Display", serif; }
        .prompt { margin: 0 0 22px; color: #665b48; line-height: 1.55; }

        .scoreboard {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: end;
            gap: 14px;
            margin-bottom: 10px;
        }

        .score-label { font-size: .68rem; font-weight: 900; letter-spacing: .12em; text-transform: uppercase; }
        #score { font: 400 2rem/1 "DM Serif Display", serif; color: var(--cider); }
        .groove { height: 13px; overflow: hidden; border: 2px solid var(--ink); border-radius: 999px; background: #dfd1ac; }
        #meter { width: 0%; height: 100%; background: repeating-linear-gradient(90deg, var(--teal) 0 13px, #4e988b 13px 17px); transition: width .45s ease; }

        .buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin: 23px 0 14px; }
        .ingredient {
            min-height: 78px;
            border: 0;
            border-radius: 50% 12% 50% 12%;
            color: white;
            cursor: pointer;
            box-shadow: 0 6px 0 var(--cider-dark);
            transition: transform .12s, box-shadow .12s;
            font-weight: 900;
            letter-spacing: .03em;
        }
        .ingredient.apple { background: var(--cider); }
        .ingredient.nut { background: var(--green); border-radius: 12% 50% 12% 50%; }
        .ingredient:hover { transform: translateY(-2px); box-shadow: 0 8px 0 var(--cider-dark); }
        .ingredient:active { transform: translateY(5px); box-shadow: 0 1px 0 var(--cider-dark); }
        .ingredient small { display: block; opacity: .74; font-size: .67rem; font-weight: 700; }

        .status {
            min-height: 48px;
            padding: 12px 14px;
            border-left: 5px solid var(--gold);
            background: #eadbb8;
            font-size: .85rem;
            line-height: 1.35;
        }

        .actions { display: flex; align-items: center; gap: 15px; margin-top: 16px; }
        .finish {
            border: 2px solid var(--ink);
            background: var(--gold);
            color: var(--ink);
            padding: 11px 16px;
            font-weight: 900;
            cursor: pointer;
        }
        .reset { border: 0; background: none; color: #76664f; text-decoration: underline; cursor: pointer; }

        .result { display: none; margin-top: 20px; border-top: 2px dashed #c7ae78; padding-top: 18px; }
        .result.show { display: block; animation: reveal .5s ease both; }
        .result h3 { margin: 0 0 5px; color: var(--cider); font: 400 1.55rem/1 "DM Serif Display", serif; }
        .result p { margin: 0; line-height: 1.48; }
        @keyframes reveal { from { opacity: 0; transform: translateY(12px) rotate(-1deg); } }

        footer {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding-top: 10px;
            color: #e9d9b8;
            font-size: .78rem;
        }
        footer a { color: #ffd166; text-underline-offset: 3px; }

        .confetti { position: fixed; pointer-events: none; z-index: 30; animation: fly 1.2s ease-out forwards; }
        @keyframes fly { to { transform: translate(var(--tx), var(--ty)) rotate(500deg); opacity: 0; } }

        @media (max-width: 800px) {
            .page { grid-template-columns: 1fr; }
            .masthead { display: block; }
            .intro { margin-top: 22px; }
            .stage { width: min(100%, 620px); justify-self: center; }
            footer { flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .001ms !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
<main class="page">
    <header class="masthead">
        <div>
            <p class="eyebrow">A tiny discovery, made playable</p>
            <h1>The Crunch <em>Composer</em></h1>
        </div>
        <p class="intro">Apple brings the bright snap. Almond brings the mellow crunch. Alternate them, syncopate them, or create delicious snack chaos.</p>
    </header>

    <section class="stage" aria-label="Your snack composition plate">
        <img class="plate-art" src="assets/crunch-composer-plate.webp" alt="A paper-collage apple and almonds surrounding a cream ceramic plate">
        <div id="bites" aria-live="polite"></div>
        <div class="roundel">tap out<br>your own<br>crunch</div>
    </section>

    <section class="panel">
        <h2>Make twelve tasty beats.</h2>
        <p class="prompt">The best grooves balance apple and almond, but a perfect alternation is not required. Ears on. Appetite ready.</p>

        <div class="scoreboard">
            <span class="score-label">Bites on the plate</span>
            <span id="score">0 / 12</span>
        </div>
        <div class="groove" aria-label="Composition progress"><div id="meter"></div></div>

        <div class="buttons">
            <button class="ingredient apple" id="addApple">APPLE SLICE <small>A key · bright snap</small></button>
            <button class="ingredient nut" id="addAlmond">ALMOND <small>M key · mellow crunch</small></button>
        </div>

        <div class="status" id="status">Your plate is listening. Begin anywhere.</div>
        <div class="actions">
            <button class="finish" id="taste">Taste the composition</button>
            <button class="reset" id="reset">clear plate</button>
        </div>

        <div class="result" id="result">
            <h3 id="resultTitle"></h3>
            <p id="resultText"></p>
        </div>
    </section>

    <footer>
        <span>Made from one excellent snack opinion.</span>
        <span>Inspired by Jon’s <a href="https://jona.ca/2009/10/almonds-apples-yum.html">“Almonds + Apples = Yum”</a> · <a href="index.php">Back to Chloe Reads Jon</a></span>
    </footer>
</main>

<script>
(() => {
    const limit = 12;
    const sequence = [];
    const bites = document.querySelector('#bites');
    const score = document.querySelector('#score');
    const meter = document.querySelector('#meter');
    const status = document.querySelector('#status');
    const result = document.querySelector('#result');
    let audio;

    const random = (min, max) => min + (crypto.getRandomValues(new Uint32Array(1))[0] / 4294967295) * (max - min);

    function sound(kind) {
        audio ||= new (window.AudioContext || window.webkitAudioContext)();
        const now = audio.currentTime;
        const length = kind === 'apple' ? .16 : .1;
        const buffer = audio.createBuffer(1, audio.sampleRate * length, audio.sampleRate);
        const data = buffer.getChannelData(0);
        for (let i = 0; i < data.length; i++) {
            const envelope = Math.pow(1 - i / data.length, kind === 'apple' ? 2.4 : 5);
            data[i] = (Math.random() * 2 - 1) * envelope;
        }
        const source = audio.createBufferSource();
        const filter = audio.createBiquadFilter();
        const gain = audio.createGain();
        source.buffer = buffer;
        filter.type = kind === 'apple' ? 'highpass' : 'bandpass';
        filter.frequency.value = kind === 'apple' ? 1050 : 520;
        filter.Q.value = kind === 'apple' ? .7 : 3.5;
        gain.gain.setValueAtTime(.22, now);
        gain.gain.exponentialRampToValueAtTime(.001, now + length);
        source.connect(filter).connect(gain).connect(audio.destination);
        source.start(now);
    }

    function add(kind) {
        if (sequence.length >= limit) {
            status.textContent = 'The plate is full. Time for the extremely scientific taste test.';
            return;
        }
        sequence.push(kind);
        const piece = document.createElement('span');
        piece.className = `piece ${kind === 'apple' ? 'apple-slice' : 'almond'}`;
        const angle = (sequence.length / limit) * Math.PI * 2 - Math.PI / 2 + random(-.18, .18);
        const radius = sequence.length % 3 === 0 ? 24 : 38;
        piece.style.setProperty('--x', `${50 + Math.cos(angle) * radius}%`);
        piece.style.setProperty('--y', `${50 + Math.sin(angle) * radius}%`);
        piece.style.setProperty('--r', `${random(-55, 55)}deg`);
        piece.setAttribute('aria-label', kind === 'apple' ? 'Apple slice' : 'Almond');
        bites.append(piece);
        sound(kind);
        update();
    }

    function update() {
        const count = sequence.length;
        score.textContent = `${count} / ${limit}`;
        meter.style.width = `${count / limit * 100}%`;
        result.classList.remove('show');
        if (count === limit) {
            status.textContent = 'A complete dozen! The plate has achieved peak crunch potential.';
        } else if (count > 1 && sequence[count - 1] !== sequence[count - 2]) {
            status.textContent = 'Lovely contrast. Bright, mellow, bright, mellow…';
        } else if (count > 2 && sequence.slice(-3).every(x => x === sequence[count - 1])) {
            status.textContent = sequence[count - 1] === 'apple' ? 'A tart little apple solo is developing.' : 'The almonds have seized the rhythm section.';
        } else {
            status.textContent = count ? `${limit - count} beats remain. Trust the crunch.` : 'Your plate is listening. Begin anywhere.';
        }
    }

    function taste() {
        if (sequence.length < 4) {
            status.textContent = 'Give the critic at least four bites to work with.';
            return;
        }
        const apples = sequence.filter(x => x === 'apple').length;
        const almonds = sequence.length - apples;
        let switches = 0;
        for (let i = 1; i < sequence.length; i++) if (sequence[i] !== sequence[i - 1]) switches++;
        const balance = 1 - Math.abs(apples - almonds) / sequence.length;
        const rhythm = switches / Math.max(1, sequence.length - 1);
        const total = Math.round((balance * .62 + rhythm * .38) * 100);
        let title, text;
        if (total >= 88) {
            title = 'The Orchard Two-Step';
            text = `A crisp, beautifully balanced composition: ${apples} bright snaps, ${almonds} mellow crunches, and just enough switching to keep the mouth interested. Jon’s equation holds up magnificently.`;
        } else if (apples > almonds + 2) {
            title = 'The Brazen Apple Solo';
            text = `Tart, juicy, and gloriously forward. The ${almonds} almonds function less as a duet partner and more as a tasteful percussion section.`;
        } else if (almonds > apples + 2) {
            title = 'Almonds After Dark';
            text = `A mellow, nutty groove with ${apples} flashes of orchard brightness. Serious snack-jazz energy.`;
        } else {
            title = 'The Happy Handful';
            text = `Not fussy, not symmetrical, simply good: ${apples} apple slices and ${almonds} almonds in a pleasingly human rhythm. This is snack music you can eat.`;
        }
        document.querySelector('#resultTitle').textContent = title;
        document.querySelector('#resultText').textContent = text;
        result.classList.add('show');
        status.textContent = `Crunch harmony: ${total}%. A completely legitimate measurement.`;
        celebrate();
    }

    function celebrate() {
        for (let i = 0; i < 20; i++) {
            const bit = document.createElement('i');
            bit.className = 'confetti';
            bit.textContent = i % 2 ? '◆' : '●';
            bit.style.color = i % 3 ? '#e2a42b' : '#4e988b';
            bit.style.left = `${random(25, 75)}vw`;
            bit.style.top = `${random(35, 70)}vh`;
            bit.style.setProperty('--tx', `${random(-230, 230)}px`);
            bit.style.setProperty('--ty', `${random(-250, 80)}px`);
            document.body.append(bit);
            setTimeout(() => bit.remove(), 1300);
        }
    }

    document.querySelector('#addApple').addEventListener('click', () => add('apple'));
    document.querySelector('#addAlmond').addEventListener('click', () => add('almond'));
    document.querySelector('#taste').addEventListener('click', taste);
    document.querySelector('#reset').addEventListener('click', () => {
        sequence.length = 0;
        bites.replaceChildren();
        result.classList.remove('show');
        update();
    });
    addEventListener('keydown', event => {
        if (event.repeat || /input|textarea|select/i.test(event.target.tagName)) return;
        if (event.key.toLowerCase() === 'a') add('apple');
        if (event.key.toLowerCase() === 'm') add('almond');
    });
})();
</script>
</body>
</html>
