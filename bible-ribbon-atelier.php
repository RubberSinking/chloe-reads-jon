<?php
// A self-contained craft planner inspired by Jon's 2010 placeholder-ribbon post.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#3f1f1d">
    <title>The Bible Ribbon Atelier</title>
    <style>
        :root {
            --ink: #281b17;
            --wine: #6f1d2c;
            --gold: #c79a3b;
            --paper: #f2e4c5;
            --paper-deep: #dcc697;
            --wood: #351b17;
            --cream: #fff9e9;
            --shadow: rgba(28, 10, 8, .35);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--cream);
            font-family: "Palatino Linotype", Palatino, "Book Antiqua", serif;
            background:
                radial-gradient(circle at 50% -15%, rgba(242, 191, 96, .24), transparent 36rem),
                repeating-linear-gradient(93deg, transparent 0 34px, rgba(255,255,255,.012) 35px 36px),
                linear-gradient(145deg, #24120f, var(--wood) 52%, #1a0d0b);
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .18;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.22'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            z-index: 20;
        }
        button, input, select { font: inherit; }
        a { color: inherit; }
        .shell { width: min(1180px, 100%); margin: auto; padding: 22px clamp(16px, 4vw, 48px) 64px; }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: clamp(28px, 6vw, 66px);
            font-size: .78rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .back {
            text-decoration: none;
            opacity: .76;
            border-bottom: 1px solid rgba(255,255,255,.28);
            padding-bottom: 3px;
        }
        .edition { color: #e6c780; }
        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.04fr) minmax(320px, .96fr);
            gap: clamp(34px, 7vw, 92px);
            align-items: center;
            min-height: 510px;
        }
        .eyebrow {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 0 0 13px;
            color: #e5bd65;
            text-transform: uppercase;
            letter-spacing: .24em;
            font-size: .72rem;
        }
        .eyebrow::before { content: "✦"; font-size: .92rem; }
        h1 {
            margin: 0;
            max-width: 680px;
            font-size: clamp(3.7rem, 8vw, 7.6rem);
            font-weight: 400;
            letter-spacing: -.065em;
            line-height: .76;
        }
        h1 em {
            display: block;
            margin-left: clamp(20px, 8vw, 94px);
            color: #e4b950;
            font-weight: 400;
        }
        .intro {
            max-width: 560px;
            margin: 32px 0 0;
            font-size: clamp(1rem, 2vw, 1.22rem);
            line-height: 1.65;
            color: #e8d9c3;
        }
        .scroll-cue {
            display: inline-flex;
            margin-top: 25px;
            padding: 11px 16px;
            border: 1px solid rgba(230,199,128,.45);
            color: #f0d58d;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: .14em;
            font-size: .7rem;
        }
        .book-stage {
            position: relative;
            display: grid;
            place-items: center;
            min-height: 460px;
            perspective: 1000px;
        }
        .halo {
            position: absolute;
            width: 90%;
            aspect-ratio: 1;
            border: 1px solid rgba(214,168,71,.22);
            border-radius: 50%;
        }
        .halo::before, .halo::after {
            content: "";
            position: absolute;
            inset: 9%;
            border: 1px dashed rgba(214,168,71,.18);
            border-radius: 50%;
        }
        .halo::after { inset: 21%; border-style: solid; }
        .book-wrap {
            position: relative;
            width: min(410px, 88vw);
            filter: drop-shadow(0 28px 24px rgba(0,0,0,.44));
            transform: rotate(2deg);
            transition: transform .8s cubic-bezier(.2,.8,.2,1);
            z-index: 2;
        }
        .book-wrap.testing { animation: book-test 1.4s ease both; }
        @keyframes book-test {
            0%,100% { transform: rotate(2deg) rotateY(0); }
            45% { transform: rotate(0) rotateY(-48deg) scale(.94); }
            70% { transform: rotate(1deg) rotateY(5deg); }
        }
        .book {
            position: relative;
            height: 292px;
            border-radius: 8px 17px 17px 8px;
            background:
                linear-gradient(90deg, transparent 0 8%, rgba(255,255,255,.05) 8.6%, transparent 10%),
                radial-gradient(circle at 72% 24%, rgba(255,255,255,.08), transparent 35%),
                #591c25;
            border: 3px solid #a76e2a;
            box-shadow: inset 0 0 0 8px #47131d, inset 0 0 0 10px #b6883a;
            overflow: visible;
        }
        .book::before {
            content: "";
            position: absolute;
            inset: 25px 31px;
            border: 1px solid #d1a84f;
            border-radius: 50% / 12%;
            opacity: .65;
        }
        .cross {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            color: #d9b65a;
            font-size: 6.2rem;
            text-shadow: 0 1px #f7dfa0, 0 -2px #291014;
        }
        .book-title {
            position: absolute;
            left: 0; right: 0; bottom: 35px;
            text-align: center;
            color: #dfbf72;
            letter-spacing: .27em;
            font-size: .65rem;
        }
        .pages {
            position: absolute;
            z-index: -1;
            top: 12px; right: -10px; bottom: 11px;
            width: 30px;
            border-radius: 0 13px 13px 0;
            background: repeating-linear-gradient(0deg, #e8d4a9 0 2px, #c9ad73 3px 4px);
        }
        #ribbonPreview { position: absolute; inset: 0; pointer-events: none; }
        .preview-ribbon {
            position: absolute;
            top: -19px;
            left: var(--left);
            width: clamp(17px, 5vw, 26px);
            height: var(--length);
            background: linear-gradient(90deg, rgba(0,0,0,.22), transparent 28%, rgba(255,255,255,.2) 52%, transparent 74%, rgba(0,0,0,.18)), var(--color);
            border-radius: 2px 2px 0 0;
            transform: rotate(var(--tilt));
            transform-origin: top;
            box-shadow: 2px 4px 6px rgba(0,0,0,.28);
            transition: height .4s, background .4s;
        }
        .preview-ribbon::after {
            content: "";
            position: absolute;
            left: 0; right: 0; bottom: -11px;
            height: 14px;
            background: inherit;
            clip-path: polygon(0 0, 100% 0, 50% 100%);
        }
        .preview-ribbon span {
            position: absolute;
            top: calc(100% + 15px);
            left: 50%;
            transform: translateX(-50%) rotate(calc(-1 * var(--tilt)));
            padding: 4px 7px;
            color: #f7ead2;
            background: #1c0e0c;
            font-size: .58rem;
            letter-spacing: .05em;
            white-space: nowrap;
            opacity: 0;
            transition: opacity .2s;
        }
        .preview-ribbon.active span { opacity: 1; }
        .workspace {
            margin-top: clamp(66px, 10vw, 120px);
            display: grid;
            grid-template-columns: minmax(0, 1.18fr) minmax(300px, .82fr);
            gap: 25px;
            align-items: start;
        }
        .panel {
            position: relative;
            background:
                linear-gradient(135deg, rgba(255,255,255,.46), transparent 35%),
                var(--paper);
            color: var(--ink);
            border: 1px solid #bc9759;
            box-shadow: 0 19px 45px var(--shadow), inset 0 0 44px rgba(117,71,24,.09);
        }
        .panel::after {
            content: "";
            position: absolute;
            inset: 8px;
            border: 1px solid rgba(104,56,27,.16);
            pointer-events: none;
        }
        .design-panel { padding: clamp(25px, 5vw, 50px); transform: rotate(-.35deg); }
        .plan-panel { padding: 30px; transform: rotate(.45deg); }
        .kicker {
            margin: 0 0 7px;
            color: var(--wine);
            font-size: .68rem;
            font-weight: bold;
            letter-spacing: .19em;
            text-transform: uppercase;
        }
        h2 {
            margin: 0 0 25px;
            font-size: clamp(2rem, 4vw, 3.5rem);
            line-height: 1;
            font-weight: 400;
            letter-spacing: -.035em;
        }
        .field-label {
            display: block;
            margin-bottom: 9px;
            font-size: .68rem;
            font-weight: bold;
            letter-spacing: .13em;
            text-transform: uppercase;
        }
        .segmented {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            margin-bottom: 27px;
        }
        .segmented button, .palette-button {
            border: 1px solid #9a7540;
            padding: 9px 13px;
            background: transparent;
            color: var(--ink);
            cursor: pointer;
            transition: .2s ease;
        }
        .segmented button:hover, .segmented button.active {
            background: var(--wine);
            color: #fff5df;
            border-color: var(--wine);
            transform: translateY(-2px);
        }
        .palette-row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 28px; }
        .palette-button {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .palette-button.active { outline: 2px solid var(--wine); outline-offset: 2px; }
        .swatches { display: flex; }
        .swatches i { width: 12px; height: 12px; border-radius: 50%; margin-left: -2px; border: 1px solid rgba(0,0,0,.18); }
        .ribbon-list {
            display: grid;
            gap: 9px;
            margin-bottom: 24px;
        }
        .ribbon-row {
            display: grid;
            grid-template-columns: 35px minmax(0, 1fr) 90px;
            gap: 10px;
            align-items: center;
            padding: 8px;
            border: 1px solid rgba(84,45,21,.19);
            background: rgba(255,255,255,.32);
            transition: .2s;
        }
        .ribbon-row.active { border-color: var(--wine); box-shadow: 3px 3px 0 rgba(111,29,44,.13); }
        .color-well {
            width: 29px;
            height: 36px;
            border: 0;
            padding: 0;
            background: transparent;
            cursor: pointer;
        }
        .ribbon-row input[type="text"] {
            width: 100%;
            min-width: 0;
            border: 0;
            border-bottom: 1px solid #9f7d4d;
            padding: 7px 4px;
            background: transparent;
            color: var(--ink);
        }
        .ribbon-row input:focus, select:focus { outline: 2px solid rgba(111,29,44,.3); outline-offset: 2px; }
        .ribbon-row select {
            width: 100%;
            border: 0;
            padding: 7px 4px;
            background: #e5d2aa;
            color: var(--ink);
        }
        .measure {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            align-items: end;
            margin: 24px 0;
        }
        input[type="range"] { width: 100%; accent-color: var(--wine); }
        .measure-output {
            min-width: 65px;
            padding: 8px;
            text-align: center;
            color: #fff8e8;
            background: var(--wine);
        }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .primary, .secondary {
            border: 0;
            padding: 13px 17px;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: .11em;
            font-size: .67rem;
            font-weight: bold;
        }
        .primary { background: var(--wine); color: white; box-shadow: 4px 4px 0 #bc9145; }
        .secondary { color: var(--ink); background: transparent; border: 1px solid #8e6939; }
        button:active { transform: translate(1px, 1px); }
        .seal {
            width: 72px; height: 72px;
            display: grid; place-items: center;
            margin: -57px 0 6px auto;
            border-radius: 50%;
            color: #e3bb65;
            background: #781e2d;
            border: 4px double #d5a84b;
            transform: rotate(9deg);
            box-shadow: 3px 5px 8px rgba(46,20,12,.25);
            font-size: 1.4rem;
        }
        .plan-intro { color: #5e493b; line-height: 1.5; }
        .cut-list { margin: 24px 0; padding: 0; list-style: none; }
        .cut-list li {
            display: grid;
            grid-template-columns: 15px 1fr auto;
            gap: 10px;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dotted #967b58;
        }
        .cut-dot { width: 11px; height: 11px; border-radius: 50%; }
        .cut-list small { color: #786250; }
        .recipe {
            margin: 23px 0 0;
            padding: 19px 19px 19px 40px;
            background: rgba(255,255,255,.28);
            border-left: 4px solid var(--gold);
            line-height: 1.5;
        }
        .recipe li { margin: 0 0 9px; padding-left: 5px; }
        .note {
            margin: 18px 0 0;
            color: #6f5744;
            font-size: .8rem;
            line-height: 1.45;
        }
        .source {
            margin: clamp(60px, 9vw, 110px) auto 0;
            max-width: 720px;
            text-align: center;
        }
        .source-mark { color: #e5bd65; font-size: 1.4rem; }
        .source p { color: #d9c7ae; line-height: 1.7; }
        .source a { color: #f1d279; text-underline-offset: 4px; }
        .saved-toast {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 30;
            padding: 12px 16px;
            color: #2d1c16;
            background: #f3dfaf;
            border: 1px solid #bc8b39;
            box-shadow: 0 8px 25px rgba(0,0,0,.3);
            transform: translateY(90px);
            opacity: 0;
            transition: .35s;
        }
        .saved-toast.show { transform: translateY(0); opacity: 1; }
        @media (max-width: 820px) {
            .hero { grid-template-columns: 1fr; }
            .hero-copy { padding-top: 15px; }
            .book-stage { min-height: 400px; }
            .workspace { grid-template-columns: 1fr; }
            .design-panel, .plan-panel { transform: none; }
        }
        @media (max-width: 480px) {
            .shell { padding-inline: 14px; }
            .topbar { align-items: flex-start; }
            h1 { font-size: 4rem; }
            .book { height: 245px; }
            .book-wrap { width: 330px; max-width: 88vw; }
            .book-stage { min-height: 355px; }
            .ribbon-row { grid-template-columns: 31px minmax(0,1fr); }
            .ribbon-row select { grid-column: 2; }
            .design-panel, .plan-panel { padding: 28px 22px; }
        }
        @media print {
            body { background: white; color: black; }
            body::before, .topbar, .hero, .design-panel, .source, .actions, .saved-toast { display: none !important; }
            .shell, .workspace { display: block; width: 100%; margin: 0; padding: 0; }
            .plan-panel { box-shadow: none; border: 2px solid #333; transform: none; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <nav class="topbar">
            <a class="back" href="index.php">← Chloe Reads Jon</a>
            <span class="edition">No. 26 · A tiny bookbinder’s bench</span>
        </nav>

        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow">A practical bit of bookish beauty</p>
                <h1>The Bible <em>Ribbon Atelier</em></h1>
                <p class="intro">Give every place you return to a ribbon of its own. Design a colour set, name each marker, and leave with a cut list for your real Bible.</p>
                <a class="scroll-cue" href="#bench">Open the workbench ↓</a>
            </div>
            <div class="book-stage" aria-label="Preview of a burgundy Bible with coloured ribbon bookmarks">
                <div class="halo"></div>
                <div class="book-wrap" id="bookWrap">
                    <div class="book">
                        <div class="cross">✝</div>
                        <div class="book-title">HOLY BIBLE</div>
                        <div class="pages"></div>
                    </div>
                    <div id="ribbonPreview"></div>
                </div>
            </div>
        </section>

        <section class="workspace" id="bench">
            <div class="panel design-panel">
                <p class="kicker">I. Choose the furniture</p>
                <h2>Dress your book</h2>

                <span class="field-label">How many places do you keep?</span>
                <div class="segmented" id="countButtons" aria-label="Number of ribbons">
                    <button type="button" data-count="2">2</button>
                    <button type="button" data-count="3">3</button>
                    <button type="button" data-count="4" class="active">4</button>
                    <button type="button" data-count="5">5</button>
                    <button type="button" data-count="6">6</button>
                </div>

                <span class="field-label">Start with a colour story</span>
                <div class="palette-row" id="palettes">
                    <button class="palette-button active" type="button" data-palette="liturgical">
                        <span class="swatches"><i style="background:#6f1d2c"></i><i style="background:#d5aa3c"></i><i style="background:#305f3a"></i></span>
                        Liturgical
                    </button>
                    <button class="palette-button" type="button" data-palette="jewel">
                        <span class="swatches"><i style="background:#1f4f78"></i><i style="background:#7c2747"></i><i style="background:#b67c24"></i></span>
                        Jewel box
                    </button>
                    <button class="palette-button" type="button" data-palette="quiet">
                        <span class="swatches"><i style="background:#66705c"></i><i style="background:#a26448"></i><i style="background:#8b7968"></i></span>
                        Monastery
                    </button>
                </div>

                <span class="field-label">Name the places</span>
                <div class="ribbon-list" id="ribbonList"></div>

                <div class="measure">
                    <div>
                        <label class="field-label" for="height">Bible height</label>
                        <input id="height" type="range" min="15" max="32" value="23" step=".5">
                    </div>
                    <output class="measure-output" id="heightOutput">23 cm</output>
                </div>

                <div class="actions">
                    <button class="primary" id="testButton" type="button">Test the lay</button>
                    <button class="secondary" id="saveButton" type="button">Save this set</button>
                </div>
            </div>

            <aside class="panel plan-panel">
                <div class="seal" aria-hidden="true">R</div>
                <p class="kicker">II. Take this to the craft table</p>
                <h2>Your ribbon order</h2>
                <p class="plan-intro" id="planIntro">Four markers, each cut with enough room to fall gracefully below the page.</p>
                <ul class="cut-list" id="cutList"></ul>
                <ol class="recipe">
                    <li>Cut each ribbon to the listed length. Seal synthetic ends very carefully, or use fray-stop.</li>
                    <li>Align the ribbons, staggered slightly, and secure their top ends to a slim card tab.</li>
                    <li>Slip the tab into the gap between the spine and the bound pages. Never glue the pages themselves.</li>
                    <li>Close the book gently, then fan the tails so each marker is easy to find.</li>
                </ol>
                <p class="note">Craft note: use narrow, colourfast ribbon. If the binding is tight or valuable, ask a bookbinder before inserting anything.</p>
                <div class="actions" style="margin-top:22px">
                    <button class="secondary" type="button" onclick="window.print()">Print craft card</button>
                </div>
            </aside>
        </section>

        <footer class="source">
            <div class="source-mark">❧</div>
            <p>Inspired by Jon’s delightfully practical post, <a href="https://cooltoolsforcatholics.blogspot.com/2010/01/add-placeholder-ribbons-to-your-bible.html" target="_blank" rel="noopener">“Add placeholder ribbons to your Bible”</a>. A tiny upgrade, yes, but one that makes returning to the Word feel wonderfully deliberate.</p>
        </footer>
    </main>
    <div class="saved-toast" id="toast" role="status">Ribbon set tucked safely away.</div>

    <script>
    (() => {
        const palettes = {
            liturgical: ['#6f1d2c', '#d2a62f', '#315f3b', '#efe1ba', '#71327b', '#b63c32'],
            jewel: ['#1f4f78', '#7c2747', '#b67c24', '#1f6b62', '#6c438b', '#a6372d'],
            quiet: ['#66705c', '#a26448', '#8b7968', '#4c6570', '#a68b55', '#766278']
        };
        const defaultNames = ['Today', 'Psalms', 'Gospel', 'Letters', 'Wisdom', 'Catechism'];
        const defaultPlaces = ['Daily reading', 'Prayer', 'Mass', 'Study', 'Notes', 'Reference'];
        let state = {
            count: 4,
            palette: 'liturgical',
            height: 23,
            ribbons: defaultNames.map((name, i) => ({
                name,
                place: defaultPlaces[i],
                color: palettes.liturgical[i]
            }))
        };

        const preview = document.getElementById('ribbonPreview');
        const list = document.getElementById('ribbonList');
        const cutList = document.getElementById('cutList');
        const intro = document.getElementById('planIntro');
        const height = document.getElementById('height');
        const heightOutput = document.getElementById('heightOutput');
        const bookWrap = document.getElementById('bookWrap');
        const toast = document.getElementById('toast');

        function escapeHtml(value) {
            return String(value).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
        }

        function render() {
            state.ribbons = Array.from({length: state.count}, (_, i) => state.ribbons[i] || {
                name: defaultNames[i],
                place: defaultPlaces[i],
                color: palettes[state.palette][i]
            });

            list.innerHTML = state.ribbons.map((r, i) => `
                <div class="ribbon-row ${i === 0 ? 'active' : ''}" data-index="${i}">
                    <input class="color-well" type="color" value="${r.color}" aria-label="Colour for ribbon ${i + 1}">
                    <input type="text" value="${escapeHtml(r.name)}" maxlength="18" aria-label="Name for ribbon ${i + 1}">
                    <select aria-label="Purpose for ribbon ${i + 1}">
                        ${defaultPlaces.map(p => `<option ${p === r.place ? 'selected' : ''}>${p}</option>`).join('')}
                    </select>
                </div>`).join('');

            const visualLength = 322 + (state.height - 15) * 3;
            preview.innerHTML = state.ribbons.map((r, i) => {
                const spread = state.count === 1 ? 50 : 18 + (i * 64 / (state.count - 1));
                const tilt = (i - (state.count - 1) / 2) * 1.6;
                return `<div class="preview-ribbon ${i === 0 ? 'active' : ''}" style="--left:${spread}%;--length:${visualLength + i * 7}px;--color:${r.color};--tilt:${tilt}deg"><span>${escapeHtml(r.name || 'Ribbon ' + (i+1))}</span></div>`;
            }).join('');

            const cutLength = Math.ceil((state.height + 8) * 2) / 2;
            cutList.innerHTML = state.ribbons.map((r, i) => `
                <li><i class="cut-dot" style="background:${r.color}"></i><span><strong>${escapeHtml(r.name || 'Ribbon ' + (i+1))}</strong><br><small>${escapeHtml(r.place)}</small></span><b>${cutLength + i * .5} cm</b></li>
            `).join('');
            intro.textContent = `${numberWord(state.count)} markers, cut with enough room to fall gracefully below your ${state.height} cm Bible.`;
            heightOutput.textContent = `${state.height} cm`;

            list.querySelectorAll('.ribbon-row').forEach(row => {
                const i = Number(row.dataset.index);
                const [colorInput, nameInput, placeSelect] = row.children;
                const activate = () => {
                    document.querySelectorAll('.ribbon-row, .preview-ribbon').forEach(el => el.classList.remove('active'));
                    row.classList.add('active');
                    preview.children[i]?.classList.add('active');
                };
                row.addEventListener('click', activate);
                colorInput.addEventListener('input', e => { state.ribbons[i].color = e.target.value; renderPreviewAndPlan(); });
                nameInput.addEventListener('input', e => { state.ribbons[i].name = e.target.value; renderPreviewAndPlan(); });
                placeSelect.addEventListener('change', e => { state.ribbons[i].place = e.target.value; renderPreviewAndPlan(); });
            });
        }

        function renderPreviewAndPlan() {
            const values = [...list.querySelectorAll('.ribbon-row')].map((row, i) => ({
                color: row.children[0].value,
                name: row.children[1].value,
                place: row.children[2].value
            }));
            state.ribbons = values;
            const cutLength = Math.ceil((state.height + 8) * 2) / 2;
            [...preview.children].forEach((ribbon, i) => {
                ribbon.style.setProperty('--color', values[i].color);
                ribbon.querySelector('span').textContent = values[i].name || `Ribbon ${i+1}`;
            });
            cutList.innerHTML = values.map((r, i) => `
                <li><i class="cut-dot" style="background:${r.color}"></i><span><strong>${escapeHtml(r.name || 'Ribbon ' + (i+1))}</strong><br><small>${escapeHtml(r.place)}</small></span><b>${cutLength + i * .5} cm</b></li>
            `).join('');
        }

        function numberWord(n) {
            return ['Zero','One','Two','Three','Four','Five','Six'][n] || n;
        }

        document.getElementById('countButtons').addEventListener('click', e => {
            if (!e.target.dataset.count) return;
            state.count = Number(e.target.dataset.count);
            document.querySelectorAll('#countButtons button').forEach(b => b.classList.toggle('active', b === e.target));
            render();
        });

        document.getElementById('palettes').addEventListener('click', e => {
            const button = e.target.closest('[data-palette]');
            if (!button) return;
            state.palette = button.dataset.palette;
            state.ribbons.forEach((r, i) => r.color = palettes[state.palette][i]);
            document.querySelectorAll('.palette-button').forEach(b => b.classList.toggle('active', b === button));
            render();
        });

        height.addEventListener('input', e => {
            state.height = Number(e.target.value);
            renderPreviewAndPlan();
            heightOutput.textContent = `${state.height} cm`;
            intro.textContent = `${numberWord(state.count)} markers, cut with enough room to fall gracefully below your ${state.height} cm Bible.`;
            [...preview.children].forEach((ribbon, i) => {
                ribbon.style.setProperty('--length', `${322 + (state.height - 15) * 3 + i * 7}px`);
            });
        });

        document.getElementById('testButton').addEventListener('click', () => {
            bookWrap.classList.remove('testing');
            void bookWrap.offsetWidth;
            bookWrap.classList.add('testing');
        });

        document.getElementById('saveButton').addEventListener('click', () => {
            renderPreviewAndPlan();
            localStorage.setItem('bibleRibbonAtelier', JSON.stringify(state));
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2200);
        });

        try {
            const saved = JSON.parse(localStorage.getItem('bibleRibbonAtelier'));
            if (saved && saved.ribbons && saved.count) {
                state = saved;
                height.value = state.height;
                document.querySelectorAll('#countButtons button').forEach(b => b.classList.toggle('active', Number(b.dataset.count) === state.count));
                document.querySelectorAll('.palette-button').forEach(b => b.classList.toggle('active', b.dataset.palette === state.palette));
            }
        } catch (_) {}
        render();
    })();
    </script>
</body>
</html>
