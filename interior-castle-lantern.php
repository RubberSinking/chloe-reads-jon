<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#09151e">
    <title>Interior Castle Lantern</title>
    <style>
        :root {
            --night: #07131c;
            --ink: #0d2029;
            --vellum: #f2e7cf;
            --vellum-deep: #d9c6a0;
            --gold: #d9ad58;
            --gold-bright: #ffe08c;
            --rose: #b86f68;
            --sage: #7d9b8b;
            --muted: #9bb0b0;
            --chamber: 1;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--vellum);
            background:
                radial-gradient(circle at 52% 14%, rgba(52, 88, 91, .24), transparent 31rem),
                radial-gradient(circle at 8% 86%, rgba(151, 83, 72, .13), transparent 27rem),
                var(--night);
            font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Palatino, serif;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .19;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 160 160' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.28'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            z-index: 20;
        }

        a { color: #f2c978; }
        button, input { font: inherit; }
        button { touch-action: manipulation; }

        .shell { width: min(1120px, 100%); margin: 0 auto; padding: 18px 18px 80px; }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 8px 0 18px;
            font-size: .78rem;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .topbar a { color: var(--muted); text-decoration: none; }
        .topbar a:hover { color: var(--vellum); }

        .progress-label { color: var(--gold); }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(280px, .85fr);
            min-height: 590px;
            border: 1px solid rgba(221, 183, 105, .36);
            border-radius: 6px 38px 6px 38px;
            overflow: hidden;
            background: rgba(8, 25, 33, .78);
            box-shadow: 0 35px 90px rgba(0, 0, 0, .38), inset 0 0 0 5px rgba(255,255,255,.018);
        }

        .map {
            position: relative;
            min-height: 530px;
            background-image:
                linear-gradient(90deg, transparent 68%, rgba(6,18,26,.54)),
                linear-gradient(0deg, rgba(6,18,26,.48), transparent 35%),
                url("interior-castle-map.webp");
            background-size: cover;
            background-position: 48% center;
            isolation: isolate;
        }

        .map::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: radial-gradient(circle at 50% 64%, rgba(255, 207, 105, calc(var(--chamber) * .025)), transparent calc(10% + var(--chamber) * 4%));
            transition: .8s ease;
        }

        .map-caption {
            position: absolute;
            left: 24px;
            bottom: 22px;
            max-width: 270px;
            margin: 0;
            color: #e8d9bd;
            font-size: .78rem;
            line-height: 1.45;
            text-shadow: 0 2px 8px #000;
            z-index: 3;
        }

        .doors { position: absolute; inset: 0; z-index: 4; }

        .door {
            position: absolute;
            left: 50%;
            width: 35px;
            height: 35px;
            transform: translate(-50%, -50%);
            border: 1px solid rgba(255, 225, 160, .76);
            border-radius: 50% 50% 44% 44%;
            color: #142026;
            background: #efd295;
            box-shadow: 0 0 0 5px rgba(5,17,23,.54), 0 0 22px rgba(255,206,105,.55);
            cursor: pointer;
            font-size: .72rem;
            font-weight: 700;
            transition: transform .2s, opacity .2s, box-shadow .2s;
        }

        .door:hover:not(:disabled), .door.active { transform: translate(-50%, -50%) scale(1.15); box-shadow: 0 0 0 5px rgba(5,17,23,.7), 0 0 32px #ffd983; }
        .door:disabled { filter: grayscale(1); opacity: .4; cursor: not-allowed; }
        .door.done::after { content: "✓"; position: absolute; right: -8px; top: -8px; width: 16px; height: 16px; border-radius: 50%; color: #07131c; background: #9dc5a6; font-size: 11px; line-height: 16px; }
        .door:nth-child(1) { top: 88%; }
        .door:nth-child(2) { top: 76%; left: 46%; }
        .door:nth-child(3) { top: 65%; left: 54%; }
        .door:nth-child(4) { top: 55%; left: 47%; }
        .door:nth-child(5) { top: 46%; left: 53%; }
        .door:nth-child(6) { top: 37%; left: 48%; }
        .door:nth-child(7) { top: 29%; }

        .intro {
            position: relative;
            z-index: 2;
            padding: clamp(34px, 6vw, 72px) clamp(28px, 5vw, 58px);
            align-self: center;
        }

        .eyebrow { margin: 0 0 18px; color: var(--gold); font-size: .72rem; letter-spacing: .25em; text-transform: uppercase; }

        h1 {
            margin: 0;
            color: #f8edd8;
            font-size: clamp(3.3rem, 7vw, 6.7rem);
            font-weight: 400;
            letter-spacing: -.06em;
            line-height: .78;
        }

        h1 span { display: block; margin-left: .55em; color: var(--gold); font-style: italic; }

        .lede { max-width: 34rem; margin: 30px 0 26px; color: #bac6c2; font-size: 1.02rem; line-height: 1.75; }

        .enter {
            border: 1px solid #d5ad61;
            border-radius: 100px;
            padding: 13px 21px;
            color: #101a1d;
            background: #e2bd73;
            box-shadow: 0 8px 26px rgba(218, 168, 73, .18);
            cursor: pointer;
            letter-spacing: .06em;
        }

        .enter:hover { background: #f0d492; transform: translateY(-1px); }

        .note { margin-top: 24px; color: #7f9696; font-size: .73rem; line-height: 1.5; }

        .journey { display: none; margin-top: 28px; }
        .journey.visible { display: block; animation: reveal .75s both; }

        .chamber {
            position: relative;
            display: grid;
            grid-template-columns: 130px minmax(0, 1fr);
            gap: clamp(26px, 6vw, 74px);
            min-height: 470px;
            padding: clamp(34px, 6vw, 76px);
            border: 1px solid rgba(216, 178, 104, .28);
            border-radius: 38px 6px 38px 6px;
            background: linear-gradient(135deg, rgba(23, 49, 55, .91), rgba(9, 25, 34, .96));
            box-shadow: 0 28px 70px rgba(0,0,0,.28);
            overflow: hidden;
        }

        .chamber::before {
            content: "";
            position: absolute;
            width: 460px;
            height: 460px;
            right: -210px;
            top: -250px;
            border: 1px solid rgba(230, 190, 111, .2);
            border-radius: 50%;
            box-shadow: 0 0 0 34px rgba(230,190,111,.025), 0 0 0 72px rgba(230,190,111,.018);
        }

        .numeral {
            color: transparent;
            -webkit-text-stroke: 1px rgba(229, 192, 118, .75);
            font-size: clamp(5rem, 12vw, 9rem);
            line-height: .85;
            text-align: center;
        }

        .seal { display: block; width: 26px; height: 26px; margin: 20px auto; border: 1px solid var(--gold); transform: rotate(45deg); box-shadow: inset 0 0 0 6px var(--night); background: var(--gold); }
        .room-tag { color: #87a4a0; font-size: .68rem; text-align: center; text-transform: uppercase; letter-spacing: .15em; }
        .content { position: relative; z-index: 1; }

        h2 { margin: 0 0 10px; color: #f3e7d0; font-size: clamp(2rem, 5vw, 4.4rem); font-weight: 400; letter-spacing: -.035em; line-height: .98; }
        .metaphor { margin: 0 0 28px; color: var(--gold); font-style: italic; }
        .description { max-width: 710px; color: #c2cec8; line-height: 1.75; font-size: 1rem; }
        .description strong { color: #f1dfbd; font-weight: 500; }

        .practice {
            max-width: 680px;
            margin-top: 30px;
            padding: 22px;
            border-left: 2px solid var(--gold);
            background: rgba(255,255,255,.035);
        }

        .practice-label { margin: 0 0 14px; color: #9cb0ab; font-size: .67rem; letter-spacing: .19em; text-transform: uppercase; }
        .prompt { margin: 0 0 16px; color: #f0e4cc; font-size: 1.08rem; }

        .chips { display: flex; flex-wrap: wrap; gap: 9px; }
        .chip, .choice, .next {
            border: 1px solid rgba(224, 188, 117, .4);
            border-radius: 100px;
            padding: 10px 15px;
            color: #decfae;
            background: transparent;
            cursor: pointer;
        }
        .chip:hover, .choice:hover { border-color: var(--gold); background: rgba(218,174,88,.08); }
        .chip.cleared { opacity: .28; text-decoration: line-through; transform: scale(.94); }
        .choice.selected { color: #101a1d; background: var(--gold); }

        .text-input {
            width: min(100%, 430px);
            border: 0;
            border-bottom: 1px solid #8d886e;
            border-radius: 0;
            padding: 10px 2px;
            color: #f3e9d4;
            outline: none;
            background: transparent;
        }
        .text-input:focus { border-color: var(--gold); }

        .hold {
            position: relative;
            width: min(100%, 330px);
            height: 52px;
            border: 1px solid var(--gold);
            border-radius: 100px;
            color: #f0dfbd;
            background: rgba(0,0,0,.15);
            overflow: hidden;
            cursor: pointer;
        }
        .hold-fill { position: absolute; inset: 0 100% 0 0; background: linear-gradient(90deg, #8a6635, #d2ad64); transition: right .1s linear; }
        .hold.holding .hold-fill { right: 0; transition-duration: 1.4s; }
        .hold span:last-child { position: relative; z-index: 1; }
        .hold.complete { color: #142024; background: #d9bd7b; }

        .water-picks { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; max-width: 540px; }
        .water { min-height: 94px; border: 1px solid rgba(145,183,179,.4); color: #cddbd5; background: rgba(100,151,151,.07); cursor: pointer; }
        .water b { display: block; color: #f0dfbd; font-weight: 500; font-size: 1.08rem; }
        .water.good { border-color: #9dcfc1; background: rgba(116,177,163,.18); }

        .breath-orb {
            width: 86px;
            height: 86px;
            border: 1px solid #bdc7b9;
            border-radius: 50%;
            color: #e5dac4;
            background: radial-gradient(circle, rgba(230,199,134,.26), rgba(64,104,107,.13));
            box-shadow: 0 0 35px rgba(165,191,173,.12);
            cursor: pointer;
        }
        .breath-orb.breathing { animation: breathe 6s ease-in-out both; }

        .feedback { min-height: 1.5em; margin: 14px 0 0; color: #a9c8b5; font-size: .87rem; }
        .next { display: none; margin-top: 24px; color: #112027; background: var(--gold); }
        .next.ready { display: inline-block; animation: reveal .45s both; }

        .final-card { display: none; margin-top: 25px; padding: 25px; border: 1px solid rgba(225,188,111,.52); background: #e9dcc0; color: #1e3235; box-shadow: 10px 10px 0 rgba(0,0,0,.14); }
        .final-card.visible { display: block; animation: reveal .65s both; }
        .final-card small { letter-spacing: .17em; text-transform: uppercase; }
        .final-card p { font-size: 1.22rem; line-height: 1.55; }

        .closing { margin: 40px auto 0; max-width: 740px; text-align: center; color: #93a8a4; line-height: 1.7; }
        .closing blockquote { margin: 0 0 16px; color: #e9d9b8; font-size: clamp(1.4rem, 4vw, 2.2rem); font-style: italic; }
        .source { margin-top: 30px; font-size: .85rem; }
        .reset { margin-top: 20px; border: 0; color: #788e8d; background: transparent; text-decoration: underline; cursor: pointer; }

        .mote { position: fixed; width: 4px; height: 4px; border-radius: 50%; background: #f4ce7f; pointer-events: none; z-index: 30; animation: mote 1.4s ease-out forwards; }

        @keyframes reveal { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }
        @keyframes breathe { 0%, 100% { transform: scale(1); box-shadow: 0 0 25px rgba(171,207,181,.15); } 45% { transform: scale(1.58); box-shadow: 0 0 70px rgba(218,183,110,.35); } }
        @keyframes mote { to { opacity: 0; transform: translate(var(--x), var(--y)) scale(.2); } }

        @media (max-width: 780px) {
            .hero { grid-template-columns: 1fr; }
            .map { min-height: 430px; order: 2; background-image: linear-gradient(0deg, rgba(6,18,26,.55), transparent 45%), url("interior-castle-map.webp"); }
            .intro { padding-bottom: 36px; }
            .journey { margin-top: 18px; }
            .chamber { grid-template-columns: 1fr; gap: 22px; padding: 34px 24px 42px; }
            .number-column { display: flex; align-items: center; gap: 18px; }
            .numeral { font-size: 4.6rem; }
            .seal { margin: 0; width: 19px; height: 19px; }
            .room-tag { text-align: left; }
        }

        @media (max-width: 480px) {
            .shell { padding-inline: 10px; }
            .topbar { padding-inline: 6px; }
            .hero { border-radius: 4px 25px 4px 25px; }
            .intro { padding: 34px 23px; }
            .map { min-height: 360px; }
            .map-caption { left: 16px; bottom: 14px; max-width: 230px; }
            .water-picks { grid-template-columns: 1fr; }
            .chamber { border-radius: 25px 4px 25px 4px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
<main class="shell">
    <nav class="topbar" aria-label="Page navigation">
        <a href="index.php">← Chloe Reads Jon</a>
        <span class="progress-label" id="progressLabel">The outer gate</span>
    </nav>

    <section class="hero" aria-labelledby="page-title">
        <div class="map" id="map" aria-label="Illustrated cutaway map of the seven mansions">
            <div class="doors" id="doors" aria-label="Castle chambers"></div>
            <p class="map-caption">Seven thresholds. Not seven ranks. Tap a lit door at any time to revisit it.</p>
        </div>
        <div class="intro">
            <p class="eyebrow">A small inward expedition</p>
            <h1 id="page-title">Interior <span>Castle</span></h1>
            <p class="lede">Carry one lantern through St. Teresa of Ávila’s seven mansions of prayer. At each threshold, meet a metaphor, try one quiet gesture, and move a little closer to the light at the centre.</p>
            <button class="enter" id="enterButton">Light the lantern</button>
            <p class="note">This is a contemplative map, not a test of spiritual advancement. It saves your place only on this device.</p>
        </div>
    </section>

    <section class="journey" id="journey" aria-live="polite">
        <article class="chamber">
            <aside class="number-column" aria-hidden="true">
                <div class="numeral" id="numeral">I</div>
                <span class="seal"></span>
                <div class="room-tag" id="roomTag">The threshold</div>
            </aside>
            <div class="content">
                <h2 id="roomTitle"></h2>
                <p class="metaphor" id="metaphor"></p>
                <div class="description" id="description"></div>
                <div class="practice" id="practice"></div>
                <button class="next" id="nextButton">Cross the next threshold →</button>
                <div class="final-card" id="finalCard"></div>
            </div>
        </article>
    </section>

    <footer class="closing">
        <blockquote>“Prayer is nothing else than being on terms of friendship with God.”</blockquote>
        <div>— St. Teresa of Ávila</div>
        <p class="source">Inspired by Jon’s <a href="https://cooltoolsforcatholics.blogspot.com/2011/11/summary-of-7-teresian-mansions-of.html" target="_blank" rel="noopener">Summary of the 7 Teresian Mansions of Prayer</a>.</p>
        <button class="reset" id="resetButton">Begin the walk again</button>
    </footer>
</main>

<script>
(() => {
    const rooms = [
        {
            numeral: 'I', tag: 'The threshold', title: 'Wake to the castle', metaphor: 'A bright place, entered through prayer.',
            description: 'Teresa begins with a startling claim: the soul is not a cramped cupboard but a castle of crystal, made to hold God’s light. The first mansions are close to the outer noise. <strong>The invitation is simply to enter</strong>—to begin praying, however distractedly.',
            kind: 'clear'
        },
        {
            numeral: 'II', tag: 'The listening rooms', title: 'Hear the distant call', metaphor: 'A bell heard through many open windows.',
            description: 'Here the call of God becomes easier to recognize—in Scripture, a homily, a friend, beauty, or a prick of conscience—while old habits still call loudly too. <strong>Perseverance matters more than a dramatic feeling.</strong>',
            kind: 'hold'
        },
        {
            numeral: 'III', tag: 'The ordered rooms', title: 'Loosen the measuring rod', metaphor: 'A well-kept house whose owner still checks every lock.',
            description: 'Prayer and virtue have become steadier. Yet a subtle danger remains: treating goodness as an achievement that should purchase safety. Teresa asks for humility, freedom, and trust when tidy plans are disturbed.',
            kind: 'input'
        },
        {
            numeral: 'IV', tag: 'The spring rooms', title: 'Receive the water', metaphor: 'Not a bucket pulled upward, but a spring rising from within.',
            description: 'Teresa marks a gentle change here. Alongside prayer that depends on our effort, there can be a quiet God gives rather than something we manufacture. <strong>The task is receptive attention, not spiritual strain.</strong>',
            kind: 'water'
        },
        {
            numeral: 'V', tag: 'The hidden rooms', title: 'Let the silkworm rest', metaphor: 'A cocoon goes still; a white butterfly emerges.',
            description: 'Teresa’s famous silkworm becomes an image of deeper union: the old self-enclosure gives way to a life newly centred on God. Its credibility appears less in extraordinary sensations than in love of neighbour.',
            kind: 'cocoon'
        },
        {
            numeral: 'VI', tag: 'The storm rooms', title: 'Stay through the weather', metaphor: 'Lightning around the castle; a lamp protected by two hands.',
            description: 'The sixth mansions hold both intimacy and ordeal: longing, misunderstanding, suffering, and powerful graces. Teresa is unsentimental about the weather. <strong>Discernment, courage, and faithful companionship</strong> keep the lantern from becoming the storm.',
            kind: 'breath'
        },
        {
            numeral: 'VII', tag: 'The centre', title: 'Bring the light outward', metaphor: 'The innermost room opens into a door of service.',
            description: 'At the centre, Teresa describes spiritual marriage: abiding communion with the Trinity. The surprise is practical. The journey inward does not end in private splendour; it returns as courage, peace, and concrete love.',
            kind: 'fruit'
        }
    ];

    const practices = {
        clear: `<p class="practice-label">Threshold gesture</p><p class="prompt">Clear four small distractions from the doorway.</p><div class="chips" id="chips"><button class="chip">the buzzing task</button><button class="chip">the old regret</button><button class="chip">the imagined argument</button><button class="chip">the need to do this perfectly</button></div><p class="feedback" id="feedback">You need not destroy them. Just set them outside for a moment.</p>`,
        hold: `<p class="practice-label">Threshold gesture</p><p class="prompt">Hold still long enough to hear the bell beneath the noise.</p><button class="hold" id="holdBell"><span class="hold-fill"></span><span>Press and hold to listen</span></button><p class="feedback" id="feedback">About one unhurried breath.</p>`,
        input: `<p class="practice-label">Threshold gesture</p><p class="prompt">Name one ordinary act of faithfulness you can offer without controlling its result.</p><input class="text-input" id="fidelityInput" maxlength="90" placeholder="Today I can…" autocomplete="off"><p class="feedback" id="feedback">Small and honest beats impressive.</p>`,
        water: `<p class="practice-label">Threshold gesture</p><p class="prompt">Which image belongs to Teresa’s fourth mansions?</p><div class="water-picks"><button class="water" data-water="bucket"><b>Pull the bucket harder</b>Earn every drop by effort.</button><button class="water" data-water="spring"><b>Open to the spring</b>Receive water already rising.</button></div><p class="feedback" id="feedback">Effort is good. Gift is still gift.</p>`,
        cocoon: `<p class="practice-label">Threshold gesture</p><p class="prompt">Do nothing to the cocoon. Hold it gently and let change arrive.</p><button class="hold" id="holdCocoon"><span class="hold-fill"></span><span>Hold the cocoon</span></button><p class="feedback" id="feedback">The silkworm cannot hurry its wings.</p>`,
        breath: `<p class="practice-label">Threshold gesture</p><p class="prompt">Let one slow breath pass through the storm.</p><button class="breath-orb" id="breathOrb">Begin</button><p class="feedback" id="feedback">Inhale as the light expands; exhale as it returns.</p>`,
        fruit: `<p class="practice-label">The centre opens outward</p><p class="prompt">Which fruit will you carry back through the gate?</p><div class="chips" id="fruitChoices"><button class="choice">patient attention</button><button class="choice">unadvertised service</button><button class="choice">courageous truth</button><button class="choice">gentle repair</button></div><p class="feedback" id="feedback">Choose one. The castle is proved outside its walls.</p>`
    };

    const state = {
        unlocked: Math.max(0, Math.min(6, Number(localStorage.getItem('castle-unlocked') || 0))),
        current: 0,
        notes: JSON.parse(localStorage.getItem('castle-notes') || '{}')
    };

    const $ = selector => document.querySelector(selector);
    const doors = $('#doors');
    const journey = $('#journey');
    const nextButton = $('#nextButton');
    const finalCard = $('#finalCard');

    rooms.forEach((room, i) => {
        const button = document.createElement('button');
        button.className = 'door';
        button.textContent = i + 1;
        button.setAttribute('aria-label', `Open mansion ${i + 1}: ${room.title}`);
        button.addEventListener('click', () => showRoom(i, true));
        doors.appendChild(button);
    });

    function updateDoors() {
        [...doors.children].forEach((door, i) => {
            door.disabled = i > state.unlocked;
            door.classList.toggle('active', i === state.current && journey.classList.contains('visible'));
            door.classList.toggle('done', i < state.unlocked || (i === 6 && !!state.notes.fruit));
        });
        $('#progressLabel').textContent = state.notes.fruit ? 'Light carried home' : `Mansion ${state.current + 1} of 7`;
        document.documentElement.style.setProperty('--chamber', state.current + 1);
    }

    function showRoom(index, scroll = false) {
        state.current = Math.min(index, state.unlocked);
        const room = rooms[state.current];
        $('#numeral').textContent = room.numeral;
        $('#roomTag').textContent = room.tag;
        $('#roomTitle').textContent = room.title;
        $('#metaphor').textContent = room.metaphor;
        $('#description').innerHTML = room.description;
        $('#practice').innerHTML = practices[room.kind];
        nextButton.classList.remove('ready');
        finalCard.classList.remove('visible');
        wirePractice(room.kind);
        journey.classList.add('visible');
        updateDoors();
        if (scroll) journey.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function complete(message) {
        $('#feedback').textContent = message;
        if (state.current < 6) nextButton.classList.add('ready');
        else renderFinal();
        if (state.current < 6 && state.unlocked < state.current + 1) {
            state.unlocked = state.current + 1;
            localStorage.setItem('castle-unlocked', String(state.unlocked));
        }
        updateDoors();
        scatterLight();
    }

    function holdToComplete(button, message, after, onComplete = () => {}) {
        let timer;
        const start = event => {
            event.preventDefault();
            button.classList.add('holding');
            timer = setTimeout(() => {
                button.classList.remove('holding');
                button.classList.add('complete');
                button.querySelector('span:last-child').textContent = after;
                onComplete();
                complete(message);
            }, 1400);
        };
        const cancel = () => { clearTimeout(timer); button.classList.remove('holding'); };
        button.addEventListener('pointerdown', start);
        button.addEventListener('pointerup', cancel);
        button.addEventListener('pointerleave', cancel);
        button.addEventListener('pointercancel', cancel);
    }

    function chime() {
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            const ctx = new AudioContext();
            [523.25, 659.25, 783.99].forEach((frequency, i) => {
                const oscillator = ctx.createOscillator();
                const gain = ctx.createGain();
                oscillator.type = 'sine';
                oscillator.frequency.value = frequency;
                gain.gain.setValueAtTime(0, ctx.currentTime + i * .12);
                gain.gain.linearRampToValueAtTime(.08, ctx.currentTime + i * .12 + .03);
                gain.gain.exponentialRampToValueAtTime(.001, ctx.currentTime + i * .12 + 1.4);
                oscillator.connect(gain).connect(ctx.destination);
                oscillator.start(ctx.currentTime + i * .12);
                oscillator.stop(ctx.currentTime + i * .12 + 1.5);
            });
        } catch (_) {}
    }

    function wirePractice(kind) {
        if (kind === 'clear') {
            const chips = [...document.querySelectorAll('.chip')];
            chips.forEach(chip => chip.addEventListener('click', () => {
                chip.classList.add('cleared'); chip.disabled = true;
                if (chips.every(item => item.classList.contains('cleared'))) complete('The doorway was here all along.');
            }));
        }
        if (kind === 'hold') {
            const button = $('#holdBell');
            holdToComplete(button, 'There it is—not loud, but persistent.', 'The bell is sounding', chime);
        }
        if (kind === 'input') {
            const input = $('#fidelityInput');
            input.value = state.notes.fidelity || '';
            const save = () => {
                if (input.value.trim().length >= 4) {
                    state.notes.fidelity = input.value.trim(); saveNotes();
                    complete('Offered, not controlled. That is enough for today.');
                }
            };
            input.addEventListener('change', save);
            input.addEventListener('keydown', event => { if (event.key === 'Enter') { event.preventDefault(); save(); } });
        }
        if (kind === 'water') {
            document.querySelectorAll('.water').forEach(button => button.addEventListener('click', () => {
                if (button.dataset.water === 'spring') {
                    button.classList.add('good'); complete('The spring is received, not hauled into existence.');
                } else {
                    $('#feedback').textContent = 'That is the earlier image: good effort, but not yet Teresa’s spring.';
                }
            }));
        }
        if (kind === 'cocoon') holdToComplete($('#holdCocoon'), 'The cocoon opens. Love now needs somewhere to fly.', 'A butterfly stirs');
        if (kind === 'breath') {
            const orb = $('#breathOrb');
            orb.addEventListener('click', () => {
                if (orb.classList.contains('breathing')) return;
                orb.classList.add('breathing'); orb.textContent = 'Breathe';
                setTimeout(() => { orb.textContent = 'Still here'; complete('The storm did not vanish. The lantern remained.'); }, 6000);
            });
        }
        if (kind === 'fruit') {
            document.querySelectorAll('#fruitChoices .choice').forEach(button => button.addEventListener('click', () => {
                document.querySelectorAll('#fruitChoices .choice').forEach(item => item.classList.remove('selected'));
                button.classList.add('selected');
                state.notes.fruit = button.textContent; saveNotes();
                complete(`Carry ${button.textContent} into the next ordinary thing.`);
            }));
            if (state.notes.fruit) {
                const old = [...document.querySelectorAll('#fruitChoices .choice')].find(button => button.textContent === state.notes.fruit);
                if (old) old.classList.add('selected');
                renderFinal();
            }
        }
    }

    function saveNotes() { localStorage.setItem('castle-notes', JSON.stringify(state.notes)); }

    function renderFinal() {
        const fidelity = state.notes.fidelity ? ` I will practise it by ${state.notes.fidelity.replace(/[<>]/g, '')}.` : '';
        finalCard.innerHTML = `<small>Field note from the centre</small><p>I will carry <strong>${state.notes.fruit}</strong> beyond the castle walls.${fidelity}</p><small>No trumpets required. Begin with the next person.</small>`;
        finalCard.classList.add('visible');
        updateDoors();
    }

    function scatterLight() {
        for (let i = 0; i < 18; i++) {
            const mote = document.createElement('i');
            mote.className = 'mote';
            mote.style.left = `${48 + Math.random() * 4}%`;
            mote.style.top = `${58 + Math.random() * 4}%`;
            mote.style.setProperty('--x', `${(Math.random() - .5) * 240}px`);
            mote.style.setProperty('--y', `${(Math.random() - .5) * 180}px`);
            document.body.appendChild(mote);
            setTimeout(() => mote.remove(), 1500);
        }
    }

    $('#enterButton').addEventListener('click', () => showRoom(state.unlocked, true));
    nextButton.addEventListener('click', () => showRoom(Math.min(6, state.current + 1), true));
    $('#resetButton').addEventListener('click', () => {
        localStorage.removeItem('castle-unlocked'); localStorage.removeItem('castle-notes');
        state.unlocked = 0; state.current = 0; state.notes = {};
        showRoom(0, true);
    });
    updateDoors();
})();
</script>
</body>
</html>
