<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#07162b">
    <title>The Golden Thread Cabinet</title>
    <style>
        :root {
            --night: #07162b;
            --night-soft: #0d2340;
            --ink: #14213a;
            --gold: #d7aa50;
            --bright-gold: #f2d88c;
            --parchment: #efe1bd;
            --cream: #fff7df;
            --oxblood: #722a2b;
            --emerald: #1f6252;
            --reveal: .2;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            color: var(--cream);
            background:
                radial-gradient(circle at 50% 12%, rgba(33, 74, 113, .55), transparent 34rem),
                repeating-linear-gradient(90deg, rgba(255,255,255,.012) 0 1px, transparent 1px 5px),
                var(--night);
            font-family: Baskerville, "Palatino Linotype", Palatino, serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .11;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.45'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            z-index: 20;
        }

        a { color: var(--bright-gold); }

        .masthead {
            text-align: center;
            padding: clamp(2.5rem, 8vw, 5.8rem) 1.25rem 2.2rem;
            position: relative;
        }

        .masthead::after {
            content: "✦  ✦  ✦";
            display: block;
            color: var(--gold);
            letter-spacing: .65rem;
            margin-top: 1.4rem;
            font-size: .75rem;
        }

        .kicker {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: .28em;
            font-size: .72rem;
            margin: 0 0 .8rem;
        }

        h1, h2, h3 { font-family: Garamond, Baskerville, "Palatino Linotype", serif; }

        h1 {
            margin: 0;
            font-size: clamp(3.2rem, 10vw, 7.4rem);
            line-height: .82;
            font-weight: 500;
            letter-spacing: -.045em;
            text-wrap: balance;
        }

        h1 span {
            display: block;
            font-style: italic;
            color: var(--bright-gold);
            font-size: .65em;
            letter-spacing: -.02em;
        }

        .lede {
            max-width: 42rem;
            margin: 1.6rem auto 0;
            color: #d9d5c7;
            font-size: clamp(1.05rem, 2.4vw, 1.3rem);
            line-height: 1.55;
        }

        main { width: min(1180px, calc(100% - 1.5rem)); margin: 0 auto; }

        .cabinet {
            border: 1px solid rgba(215, 170, 80, .45);
            background: linear-gradient(145deg, rgba(12, 36, 65, .94), rgba(5, 18, 35, .97));
            box-shadow: 0 30px 80px rgba(0,0,0,.5), inset 0 0 0 5px rgba(215,170,80,.04);
            border-radius: 1.6rem .25rem 1.6rem .25rem;
            overflow: hidden;
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(18rem, .65fr);
            min-height: 650px;
        }

        .illumination {
            position: relative;
            min-height: 650px;
            overflow: hidden;
            background: #061226;
            isolation: isolate;
        }

        .illumination img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(calc(.35 + var(--reveal) * .75)) brightness(calc(.35 + var(--reveal) * .65));
            transform: scale(1.025);
            transition: filter 900ms ease, transform 1200ms ease;
            z-index: -2;
        }

        .illumination::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 52%, transparent 10%, rgba(2, 11, 26, calc(.82 - var(--reveal) * .65)) 78%);
            z-index: -1;
            transition: background 800ms ease;
            pointer-events: none;
        }

        .node {
            position: absolute;
            width: clamp(5.2rem, 11vw, 7rem);
            aspect-ratio: 1;
            border-radius: 50%;
            border: 1px solid rgba(242, 216, 140, .75);
            background: radial-gradient(circle at 35% 30%, #f1d991, #8c5b1d 58%, #3e280e 60%);
            color: #211406;
            box-shadow: 0 7px 28px rgba(0,0,0,.55), inset 0 0 0 4px rgba(255,239,179,.18);
            cursor: pointer;
            font: 600 clamp(.72rem, 1.4vw, .94rem)/1.05 Garamond, Baskerville, serif;
            letter-spacing: .02em;
            transition: transform .25s ease, box-shadow .25s ease, opacity .25s ease;
            display: grid;
            place-items: center;
            text-align: center;
            padding: .45rem;
            z-index: 3;
        }

        .node .sigil { display: block; font-size: 1.8em; line-height: .9; margin-bottom: .18rem; }
        .node:hover, .node:focus-visible { transform: scale(1.07) rotate(-2deg); outline: 3px solid var(--cream); outline-offset: 4px; }
        .node.selected { box-shadow: 0 0 0 4px var(--cream), 0 0 34px 10px rgba(242,216,140,.7); transform: scale(1.08); }
        .node.muted { opacity: .58; }
        .node[data-symbol="feast"] { left: 4%; top: 8%; }
        .node[data-symbol="cross"] { right: 5%; top: 8%; }
        .node[data-symbol="sacrifice"] { left: 5%; bottom: 8%; }
        .node[data-symbol="eucharist"] { right: 5%; bottom: 8%; }
        .node[data-symbol="marriage"] { left: 50%; bottom: 5%; transform: translateX(-50%); }
        .node[data-symbol="marriage"]:hover, .node[data-symbol="marriage"]:focus-visible { transform: translateX(-50%) scale(1.07) rotate(-2deg); }
        .node[data-symbol="marriage"].selected { transform: translateX(-50%) scale(1.08); }

        .thread-layer { position: absolute; inset: 0; width: 100%; height: 100%; pointer-events: none; z-index: 2; }
        .thread-layer line { stroke: #ffe59a; stroke-width: 2; stroke-dasharray: 8 7; filter: drop-shadow(0 0 7px #ffc94e); opacity: 0; }
        .thread-layer line.live { opacity: 1; animation: drawThread 1.1s ease both, pulseThread 2.4s 1.1s ease-in-out infinite; }

        .instruction-plaque {
            position: absolute;
            left: 50%; top: 50%;
            width: min(68%, 25rem);
            transform: translate(-50%, -48%);
            text-align: center;
            background: rgba(3, 15, 30, .82);
            border: 1px solid rgba(242,216,140,.65);
            backdrop-filter: blur(7px);
            padding: 1rem 1.25rem;
            box-shadow: 0 12px 40px rgba(0,0,0,.42);
            z-index: 4;
        }

        .instruction-plaque strong { color: var(--bright-gold); font-weight: normal; font-size: 1.15rem; }
        .instruction-plaque p { margin: .25rem 0 0; color: #ddd8c6; font-size: .9rem; }

        .drawer {
            padding: clamp(1.5rem, 4vw, 2.6rem);
            display: flex;
            flex-direction: column;
            background:
                linear-gradient(rgba(255,255,255,.018) 1px, transparent 1px) 0 0 / 100% 2.35rem,
                #091b31;
            border-left: 1px solid rgba(215,170,80,.32);
        }

        .drawer-label { color: var(--gold); text-transform: uppercase; letter-spacing: .23em; font-size: .69rem; margin: 0; }
        .drawer h2 { font-size: clamp(2rem, 4vw, 3rem); line-height: .95; font-weight: 500; margin: .55rem 0 1.2rem; }

        .reading {
            min-height: 14.5rem;
            border-top: 1px solid rgba(215,170,80,.35);
            border-bottom: 1px solid rgba(215,170,80,.35);
            padding: 1.25rem 0;
        }

        .reading h3 { color: var(--bright-gold); font-size: 1.55rem; margin: 0 0 .55rem; font-weight: 500; }
        .reading p { color: #d7d4c8; font-size: 1rem; line-height: 1.55; margin: 0; }
        .reading .prompt { font-style: italic; color: #fff0bf; margin-top: .9rem; }

        .actions { display: grid; grid-template-columns: 1fr 1fr; gap: .7rem; margin-top: 1.2rem; }
        .actions button {
            border: 1px solid rgba(215,170,80,.55);
            color: var(--cream);
            background: transparent;
            font: inherit;
            padding: .72rem .8rem;
            cursor: pointer;
            transition: background .2s, color .2s;
        }
        .actions button:hover, .actions button:focus-visible { background: var(--gold); color: #1d1406; outline: 2px solid var(--cream); outline-offset: 2px; }

        .progress-wrap { margin-top: auto; padding-top: 2rem; }
        .progress-head { display: flex; justify-content: space-between; color: #c9c4b4; font-size: .8rem; }
        .beads { display: grid; grid-template-columns: repeat(5, 1fr); gap: .42rem; margin-top: .55rem; }
        .bead { height: .52rem; border: 1px solid #8e6c36; border-radius: 50%; background: #142640; transition: background .5s, box-shadow .5s; }
        .bead.lit { background: var(--bright-gold); box-shadow: 0 0 10px rgba(242,216,140,.75); }

        .afterword {
            max-width: 760px;
            margin: clamp(3rem, 8vw, 6rem) auto;
            text-align: center;
            font-size: 1.1rem;
            line-height: 1.65;
            color: #d3d1c7;
        }
        .afterword::before { content: "❦"; display: block; color: var(--gold); font-size: 2.4rem; margin-bottom: .5rem; }
        .afterword a { text-underline-offset: .25em; }

        @keyframes drawThread { from { stroke-dashoffset: 120; } to { stroke-dashoffset: 0; } }
        @keyframes pulseThread { 50% { opacity: .45; } }

        @media (max-width: 780px) {
            .cabinet { grid-template-columns: 1fr; }
            .illumination { min-height: 570px; }
            .drawer { border-left: 0; border-top: 1px solid rgba(215,170,80,.32); }
            .reading { min-height: 12rem; }
            .node { width: 5.2rem; }
            .node[data-symbol="feast"] { left: 3%; top: 5%; }
            .node[data-symbol="cross"] { right: 3%; top: 5%; }
            .node[data-symbol="sacrifice"] { left: 3%; bottom: 8%; }
            .node[data-symbol="eucharist"] { right: 3%; bottom: 8%; }
            .instruction-plaque { top: 46%; width: 72%; }
        }

        @media (max-width: 440px) {
            main { width: calc(100% - .8rem); }
            .illumination { min-height: 520px; }
            .node { width: 4.75rem; font-size: .69rem; }
            .instruction-plaque { width: 67%; padding: .75rem; }
            .instruction-plaque p { display: none; }
            .drawer { padding: 1.35rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
    <header class="masthead">
        <p class="kicker">A cabinet of sacred correspondences</p>
        <h1>The Golden Thread <span>Cabinet</span></h1>
        <p class="lede">Five images, one mystery. Choose any two engraved seals and draw out the thread that passes between them.</p>
    </header>

    <main>
        <section class="cabinet" aria-label="Interactive correspondence cabinet">
            <div class="illumination" id="illumination">
                <img src="golden-thread-illumination.webp" alt="Illuminated sacred scene with a banquet table, altar, chalice, bread, cross, and wedding rings">
                <svg class="thread-layer" id="threadLayer" aria-hidden="true"><line id="thread" x1="0" y1="0" x2="0" y2="0"/></svg>

                <button class="node" data-symbol="feast" aria-pressed="false"><span><span class="sigil">♨</span>Wedding feast</span></button>
                <button class="node" data-symbol="cross" aria-pressed="false"><span><span class="sigil">✝</span>The Cross</span></button>
                <button class="node" data-symbol="sacrifice" aria-pressed="false"><span><span class="sigil">♢</span>Sacrifice</span></button>
                <button class="node" data-symbol="eucharist" aria-pressed="false"><span><span class="sigil">◉</span>Eucharist</span></button>
                <button class="node" data-symbol="marriage" aria-pressed="false"><span><span class="sigil">∞</span>Marriage</span></button>

                <div class="instruction-plaque" id="plaque">
                    <strong>Select the first seal</strong>
                    <p>Then choose a second. There are ten threads hidden in the cabinet.</p>
                </div>
            </div>

            <aside class="drawer" aria-live="polite">
                <p class="drawer-label">The keeper’s folio</p>
                <h2 id="folioTitle">A pattern waits</h2>
                <div class="reading">
                    <h3 id="pairTitle">Begin with two images</h3>
                    <p id="pairText">The point is not a trivia answer. It is to notice how Christianity lets one reality illuminate another: table, altar, covenant, gift, and self-offering.</p>
                    <p class="prompt" id="pairPrompt">What might each image teach you about the other?</p>
                </div>
                <div class="actions">
                    <button type="button" id="surprise">Draw a thread</button>
                    <button type="button" id="reset">Close the folio</button>
                </div>
                <div class="progress-wrap">
                    <div class="progress-head"><span>Illumination restored</span><span id="count">0 / 5</span></div>
                    <div class="beads" aria-hidden="true"><i class="bead"></i><i class="bead"></i><i class="bead"></i><i class="bead"></i><i class="bead"></i></div>
                </div>
            </aside>
        </section>

        <footer class="afterword">
            This little instrument was <a href="https://jona.ca/2013/12/beautiful-correspondences-in-christian.html">inspired by Jon’s post “Beautiful correspondences in the Christian religion”</a>, and by his observation that their relationships are beautiful enough to make a person pause. These are invitations to contemplation, not an attempt to exhaust the theology.
        </footer>
    </main>

    <script>
        const correspondences = {
            'cross|feast': {
                title: 'Sorrow opens into supper',
                text: 'The Cross appears to be an ending, while the wedding feast is an image of arrival and joy. Christian hope holds them together: self-giving love passes through suffering toward communion.',
                prompt: 'Where have sacrifice and celebration touched the same story in your life?'
            },
            'feast|sacrifice': {
                title: 'A table receives a gift',
                text: 'A feast depends upon gifts prepared and shared; sacrifice names a gift truly offered. The banquet table can therefore be read not as mere abundance, but as generosity made visible.',
                prompt: 'What must be given so that others may be welcomed?'
            },
            'eucharist|feast': {
                title: 'The foretaste of a banquet',
                text: 'The Eucharist is both the simplest food and the Church’s great feast. A small host points beyond itself toward communion, thanksgiving, and the promised heavenly banquet.',
                prompt: 'How can something outwardly small carry an immense promise?'
            },
            'feast|marriage': {
                title: 'Covenant becomes celebration',
                text: 'A wedding feast makes a private promise public and communal. Marriage supplies the covenant; the table gathers witnesses and turns fidelity into shared joy.',
                prompt: 'Which promises in your life deserve to be celebrated together?'
            },
            'cross|sacrifice': {
                title: 'The altar is carried uphill',
                text: 'At the Cross, offering is no longer an abstract ritual but a person’s complete self-gift. The instrument of death is transformed into an emblem of love that withholds nothing.',
                prompt: 'What changes when sacrifice is understood as self-gift rather than mere loss?'
            },
            'cross|eucharist': {
                title: 'One gift, given sacramentally',
                text: 'The Eucharist does not repeat Calvary as another event. In Catholic understanding, it makes the one sacrifice present sacramentally beneath the signs of bread and wine.',
                prompt: 'Why might remembrance require more than recalling an idea?'
            },
            'cross|marriage': {
                title: 'Love takes the shape of a vow',
                text: 'Marriage vows promise fidelity beyond convenience; the Cross shows love remaining faithful at the highest cost. Each can become a lens for reading the other’s self-gift.',
                prompt: 'What does faithful love do when feeling alone cannot carry it?'
            },
            'eucharist|sacrifice': {
                title: 'Thanksgiving upon the altar',
                text: 'The altar of sacrifice and the table of Eucharist occupy the same place. Gift, thanksgiving, remembrance, and communion gather around one sacred meal.',
                prompt: 'How can gratitude itself become an offering?'
            },
            'marriage|sacrifice': {
                title: 'A daily liturgy of giving',
                text: 'Marriage is lived through ordinary acts of self-surrender: listening, patience, fidelity, and care. Sacrifice here need not mean grand drama; it is love made durable in time.',
                prompt: 'Which quiet act of love is easy to overlook precisely because it is repeated?'
            },
            'eucharist|marriage': {
                title: 'Communion and covenant',
                text: 'Both marriage and Eucharist speak a language of covenantal union and embodied gift. One helps us glimpse why communion is personal; the other, why love seeks to give itself.',
                prompt: 'What is the difference between being near someone and truly being in communion?'
            }
        };

        const nodes = [...document.querySelectorAll('.node')];
        const thread = document.getElementById('thread');
        const illumination = document.getElementById('illumination');
        const plaque = document.getElementById('plaque');
        const folioTitle = document.getElementById('folioTitle');
        const pairTitle = document.getElementById('pairTitle');
        const pairText = document.getElementById('pairText');
        const pairPrompt = document.getElementById('pairPrompt');
        const count = document.getElementById('count');
        const beads = [...document.querySelectorAll('.bead')];
        let selected = [];
        const discovered = new Set(JSON.parse(localStorage.getItem('goldenThreadDiscoveries') || '[]'));

        function keyFor(a, b) { return [a, b].sort().join('|'); }

        function centerOf(node) {
            const box = node.getBoundingClientRect();
            const host = illumination.getBoundingClientRect();
            return { x: box.left - host.left + box.width / 2, y: box.top - host.top + box.height / 2 };
        }

        function drawLine(a, b) {
            const p1 = centerOf(a), p2 = centerOf(b);
            thread.setAttribute('x1', p1.x); thread.setAttribute('y1', p1.y);
            thread.setAttribute('x2', p2.x); thread.setAttribute('y2', p2.y);
            thread.classList.remove('live');
            requestAnimationFrame(() => thread.classList.add('live'));
        }

        function updateProgress() {
            const lit = Math.min(5, discovered.size);
            beads.forEach((bead, i) => bead.classList.toggle('lit', i < lit));
            count.textContent = `${lit} / 5`;
            document.documentElement.style.setProperty('--reveal', String(.2 + lit * .16));
            if (lit === 5) folioTitle.textContent = 'The illumination is whole';
        }

        function clearSelection(keepLine = false) {
            selected = [];
            nodes.forEach(node => { node.classList.remove('selected', 'muted'); node.setAttribute('aria-pressed', 'false'); });
            if (!keepLine) thread.classList.remove('live');
            plaque.innerHTML = '<strong>Select the first seal</strong><p>Then choose a second. There are ten threads hidden in the cabinet.</p>';
        }

        function revealPair(first, second) {
            const key = keyFor(first.dataset.symbol, second.dataset.symbol);
            const item = correspondences[key];
            drawLine(first, second);
            discovered.add(key);
            localStorage.setItem('goldenThreadDiscoveries', JSON.stringify([...discovered]));
            folioTitle.textContent = `${discovered.size} thread${discovered.size === 1 ? '' : 's'} discovered`;
            pairTitle.textContent = item.title;
            pairText.textContent = item.text;
            pairPrompt.textContent = item.prompt;
            plaque.innerHTML = '<strong>A golden thread appears</strong><p>Choose either seal to begin another pairing.</p>';
            updateProgress();
        }

        function selectNode(node) {
            if (selected.length === 2) clearSelection(true);
            if (selected.includes(node)) { clearSelection(); return; }
            selected.push(node);
            node.classList.add('selected');
            node.setAttribute('aria-pressed', 'true');
            if (selected.length === 1) {
                nodes.filter(n => n !== node).forEach(n => n.classList.add('muted'));
                plaque.innerHTML = '<strong>Now choose its companion</strong><p>Every pairing opens a different window.</p>';
            } else {
                nodes.forEach(n => n.classList.remove('muted'));
                revealPair(selected[0], selected[1]);
            }
        }

        nodes.forEach(node => node.addEventListener('click', () => selectNode(node)));

        document.getElementById('surprise').addEventListener('click', () => {
            clearSelection();
            const keys = Object.keys(correspondences);
            const untried = keys.filter(key => !discovered.has(key));
            const pool = untried.length ? untried : keys;
            const [a, b] = pool[Math.floor(Math.random() * pool.length)].split('|');
            const first = nodes.find(n => n.dataset.symbol === a);
            const second = nodes.find(n => n.dataset.symbol === b);
            selected = [first, second];
            selected.forEach(n => { n.classList.add('selected'); n.setAttribute('aria-pressed', 'true'); });
            revealPair(first, second);
        });

        document.getElementById('reset').addEventListener('click', () => {
            clearSelection();
            folioTitle.textContent = 'A pattern waits';
            pairTitle.textContent = 'Begin with two images';
            pairText.textContent = 'The point is not a trivia answer. It is to notice how Christianity lets one reality illuminate another: table, altar, covenant, gift, and self-offering.';
            pairPrompt.textContent = 'What might each image teach you about the other?';
        });

        window.addEventListener('resize', () => { if (selected.length === 2) drawLine(selected[0], selected[1]); });
        updateProgress();
    </script>
</body>
</html>
