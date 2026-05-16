<?php
$title = 'Address Bar Cinema';
$date = '2026-05-16';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        :root {
            --bg: #130f1d;
            --bg-2: #211735;
            --panel: rgba(18, 15, 32, 0.72);
            --panel-strong: rgba(15, 13, 28, 0.9);
            --line: rgba(255, 255, 255, 0.14);
            --text: #f5f1e8;
            --muted: #cdbfdc;
            --gold: #f4c86c;
            --peach: #f0937d;
            --mint: #85e0c0;
            --lavender: #d2b7ff;
            --shadow: 0 22px 60px rgba(0, 0, 0, 0.34);
            --radius: 26px;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background:
                radial-gradient(circle at 15% 20%, rgba(244, 200, 108, 0.16), transparent 22%),
                radial-gradient(circle at 85% 12%, rgba(240, 147, 125, 0.18), transparent 22%),
                radial-gradient(circle at 50% 110%, rgba(133, 224, 192, 0.14), transparent 35%),
                linear-gradient(145deg, #120d1c 0%, #1e1630 46%, #0d0d16 100%);
            color: var(--text);
            font-family: Georgia, "Iowan Old Style", "Palatino Linotype", "Book Antiqua", serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.12;
            background-image:
                linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 26px 26px;
            mask-image: radial-gradient(circle at center, black 30%, transparent 92%);
        }

        .shell {
            width: min(1220px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 40px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border-radius: calc(var(--radius) + 6px);
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
            box-shadow: var(--shadow);
            backdrop-filter: blur(16px);
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -5% -38% auto;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(244, 200, 108, 0.24), transparent 68%);
            filter: blur(8px);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--gold);
            font: 700 0.74rem/1.1 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2.6rem, 5vw, 5rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            max-width: 10ch;
        }

        .hero p {
            max-width: 62ch;
            margin: 0;
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 22px;
            align-items: end;
        }

        .hero-card {
            margin-top: 22px;
            padding: 18px;
            border-radius: 22px;
            background: rgba(10, 10, 18, 0.36);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .hero-card strong {
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: var(--text);
        }

        .hero-card span {
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(300px, 420px) minmax(0, 1fr);
            gap: 22px;
            margin-top: 22px;
        }

        .panel {
            position: relative;
            border-radius: var(--radius);
            background: var(--panel);
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
        }

        .controls {
            padding: 22px;
        }

        .controls h2,
        .stage-head h2,
        .strip-head h2 {
            margin: 0;
            font-size: 1.3rem;
            letter-spacing: -0.03em;
        }

        .subtle {
            margin-top: 8px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .section {
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text);
            font: 700 0.8rem/1.2 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        textarea, input, select {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 18px;
            background: rgba(255,255,255,0.05);
            color: var(--text);
            padding: 14px 15px;
            font: 500 0.98rem/1.5 Georgia, serif;
            outline: none;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.04);
        }

        textarea {
            min-height: 148px;
            resize: vertical;
        }

        input[type="range"] {
            padding: 0;
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .row,
        .grid-2,
        .theme-grid,
        .stat-grid,
        .button-row,
        .thumbnails {
            display: grid;
            gap: 12px;
        }

        .grid-2,
        .theme-grid,
        .stat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .button-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 16px;
        }

        button {
            appearance: none;
            border: none;
            border-radius: 18px;
            padding: 14px 16px;
            cursor: pointer;
            color: #16111f;
            background: linear-gradient(135deg, var(--gold), #ffdca1);
            font: 700 0.92rem/1.2 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.04em;
            box-shadow: 0 12px 24px rgba(244, 200, 108, 0.22);
            transition: transform 180ms ease, box-shadow 180ms ease, opacity 180ms ease;
        }

        button.secondary {
            color: var(--text);
            background: rgba(255,255,255,0.08);
            box-shadow: none;
            border: 1px solid rgba(255,255,255,0.1);
        }

        button:hover,
        button:focus-visible {
            transform: translateY(-1px);
        }

        .tiny {
            margin-top: 10px;
            font-size: 0.86rem;
            color: var(--muted);
            line-height: 1.5;
        }

        .theme-card,
        .stat,
        .tip {
            padding: 14px;
            border-radius: 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .theme-card strong,
        .stat strong,
        .tip strong {
            display: block;
            margin-bottom: 6px;
            font-size: 0.94rem;
        }

        .theme-card span,
        .stat span,
        .tip span {
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .stage-wrap {
            padding: 18px;
        }

        .stage-head,
        .strip-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 16px;
            margin-bottom: 14px;
        }

        .stage-note {
            color: var(--muted);
            font-size: 0.9rem;
            text-align: right;
        }

        .cinema {
            position: relative;
            aspect-ratio: 16 / 10;
            border-radius: 26px;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.07), 0 24px 50px rgba(0,0,0,0.32);
            background: radial-gradient(circle at top, #2b1d3e, #110d18 60%);
        }

        .cinema::before,
        .cinema::after {
            content: "";
            position: absolute;
            pointer-events: none;
        }

        .cinema::before {
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.08), transparent 20%, transparent 80%, rgba(0,0,0,0.2));
        }

        .cinema::after {
            inset: 0;
            opacity: 0.18;
            background-image: radial-gradient(circle at center, rgba(255,255,255,0.35) 0.8px, transparent 0.8px);
            background-size: 9px 9px;
            mix-blend-mode: soft-light;
        }

        .slide {
            position: absolute;
            inset: 0;
            padding: clamp(18px, 4vw, 42px);
            display: grid;
            align-content: space-between;
            gap: 18px;
            transition: opacity 280ms ease, transform 280ms ease;
            opacity: 0;
            transform: scale(0.985);
        }

        .slide.active {
            opacity: 1;
            transform: scale(1);
        }

        .slide-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.12);
            color: rgba(255,255,255,0.8);
            font: 700 0.72rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .slide-main {
            display: grid;
            gap: 14px;
            align-content: center;
            justify-items: start;
            min-height: 0;
        }

        .slide.center .slide-main,
        .slide.title-only .slide-main {
            justify-items: center;
            text-align: center;
        }

        .slide.split .slide-main {
            grid-template-columns: 1.3fr 0.7fr;
            align-items: center;
            gap: 24px;
            width: 100%;
        }

        .split-copy,
        .split-side {
            min-width: 0;
        }

        .split-side {
            padding: 18px;
            border-radius: 22px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.06);
        }

        .split-side strong {
            display: block;
            margin-bottom: 10px;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.72);
            font-family: "Trebuchet MS", sans-serif;
        }

        .split-side ul {
            margin: 0;
            padding-left: 18px;
            color: rgba(255,255,255,0.86);
            line-height: 1.65;
        }

        .slide-kicker {
            color: rgba(255,255,255,0.82);
            font: 700 0.8rem/1.1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .slide h3 {
            margin: 0;
            max-width: 12ch;
            font-size: clamp(2rem, 4.9vw, 4.75rem);
            line-height: 0.96;
            letter-spacing: -0.05em;
            text-wrap: balance;
        }

        .slide p {
            margin: 0;
            max-width: 50ch;
            color: rgba(255,255,255,0.84);
            font-size: clamp(1rem, 1.6vw, 1.25rem);
            line-height: 1.58;
            text-wrap: pretty;
        }

        .slide-title-only h3 {
            max-width: 14ch;
        }

        .slide-footer {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: end;
            color: rgba(255,255,255,0.74);
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .accent-bar {
            width: min(180px, 34vw);
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(90deg, currentColor, rgba(255,255,255,0.08));
            color: var(--accent, var(--gold));
            box-shadow: 0 0 24px color-mix(in srgb, var(--accent, var(--gold)) 55%, transparent);
        }

        .slide[data-theme="velvet"] {
            background: radial-gradient(circle at 20% 10%, rgba(244, 200, 108, 0.22), transparent 26%), linear-gradient(140deg, #321431, #140e23 58%, #0d0916);
            --accent: #f4c86c;
        }

        .slide[data-theme="mint"] {
            background: radial-gradient(circle at 80% 18%, rgba(133, 224, 192, 0.18), transparent 22%), linear-gradient(145deg, #0f2c31, #13212e 58%, #0d111d);
            --accent: #85e0c0;
        }

        .slide[data-theme="sunset"] {
            background: radial-gradient(circle at 18% 16%, rgba(255, 182, 120, 0.18), transparent 24%), linear-gradient(145deg, #482233, #261739 50%, #100d18);
            --accent: #ffb678;
        }

        .slide[data-theme="ink"] {
            background: radial-gradient(circle at 82% 20%, rgba(210, 183, 255, 0.16), transparent 24%), linear-gradient(145deg, #141929, #0d1020 56%, #080a12);
            --accent: #d2b7ff;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 14px;
        }

        .nav-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav button {
            min-width: 124px;
        }

        .counter {
            color: var(--muted);
            font-size: 0.92rem;
        }

        .filmstrip {
            margin-top: 22px;
            padding: 18px;
        }

        .thumbnails {
            grid-template-columns: repeat(auto-fit, minmax(158px, 1fr));
        }

        .thumb {
            position: relative;
            min-height: 118px;
            padding: 16px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
            overflow: hidden;
        }

        .thumb:hover,
        .thumb.active {
            transform: translateY(-2px);
            border-color: rgba(255,255,255,0.22);
            background: rgba(255,255,255,0.07);
        }

        .thumb::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.06), transparent 55%);
            pointer-events: none;
        }

        .thumb .tiny-label {
            position: relative;
            font: 700 0.68rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.64);
        }

        .thumb strong {
            position: relative;
            display: block;
            margin-top: 14px;
            font-size: 1.08rem;
            line-height: 1.1;
        }

        .thumb span {
            position: relative;
            display: block;
            margin-top: 8px;
            color: rgba(255,255,255,0.72);
            font-size: 0.86rem;
            line-height: 1.45;
        }

        .command {
            margin-top: 22px;
            padding: 18px;
            border-radius: 22px;
            background: rgba(7, 8, 15, 0.54);
            border: 1px dashed rgba(255,255,255,0.14);
        }

        .command code {
            display: block;
            margin-top: 10px;
            padding: 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.04);
            color: var(--mint);
            font: 600 0.95rem/1.6 "Courier New", monospace;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .tips {
            margin-top: 22px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        @media (max-width: 980px) {
            .hero-grid,
            .layout,
            .tips {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .shell { width: min(100% - 18px, 100%); padding-top: 16px; }
            .hero, .controls, .stage-wrap, .filmstrip { padding: 18px; }
            .grid-2, .theme-grid, .stat-grid, .button-row { grid-template-columns: 1fr; }
            .slide.split .slide-main { grid-template-columns: 1fr; }
            .stage-head, .nav { flex-direction: column; align-items: stretch; }
            .stage-note { text-align: left; }
            h1 { max-width: none; }
            .slide h3 { max-width: none; }
            .slide-footer { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">QuickSlide Reverie</div>
                    <h1><?= htmlspecialchars($title) ?></h1>
                    <p>A velvet-screen slide workshop inspired by Jon's delightfully simple QuickSlide idea: type a title, a subtitle, and a few scene beats, then watch them bloom into a tiny keynote with cinematic mood, cue cards, and keyboard controls.</p>
                    <div class="hero-card">
                        <strong>Memorable gimmick</strong>
                        <span>It even writes a cheeky shareable pseudo-address-bar command for your current deck, because of course Jon would appreciate a tiny elegant shortcut instead of a bloated wizard.</span>
                    </div>
                </div>
                <div class="hero-card">
                    <strong>How it works</strong>
                    <span>Write one slide per line using <em>Title | Subtitle</em>. Choose a visual mood, pace, and layout. Then step through the deck, use the filmstrip, or let autoplay do the dramatic unveiling for you.</span>
                </div>
            </div>
        </section>

        <div class="layout">
            <section class="panel controls">
                <h2>Compose your deck</h2>
                <p class="subtle">Three or four punchy slides work best. Keep them bold. This thing prefers conviction over committee prose.</p>

                <div class="section">
                    <label for="deckInput">Slides</label>
                    <textarea id="deckInput">Why small tools matter | Delight beats bloat when the idea is clear.
Build for one human first | Precision starts with knowing exactly who you're serving.
Make the interface sing | Good taste is a feature, not decorative garnish.
Ship the tiny miracle | Then let tomorrow's version get fancier.</textarea>
                    <div class="tiny">Format: <strong>Title | Subtitle</strong>. One slide per line. If you omit the bar, it becomes a title-only slide.</div>
                </div>

                <div class="section grid-2">
                    <div>
                        <label for="kickerInput">Opening kicker</label>
                        <input id="kickerInput" type="text" value="Address Bar Presentation">
                    </div>
                    <div>
                        <label for="footerInput">Footer note</label>
                        <input id="footerInput" type="text" value="Made in one self-contained page">
                    </div>
                </div>

                <div class="section theme-grid">
                    <div>
                        <label for="themeSelect">Mood</label>
                        <select id="themeSelect">
                            <option value="velvet">Velvet Gold</option>
                            <option value="mint">Midnight Mint</option>
                            <option value="sunset">Sunset Lecture</option>
                            <option value="ink">Ink and Lavender</option>
                        </select>
                    </div>
                    <div>
                        <label for="layoutSelect">Layout</label>
                        <select id="layoutSelect">
                            <option value="center">Centered speech</option>
                            <option value="split">Split cue card</option>
                            <option value="title-only">Title card emphasis</option>
                        </select>
                    </div>
                </div>

                <div class="section">
                    <label for="paceInput">Autoplay pace: <span id="paceLabel">5s</span></label>
                    <input id="paceInput" type="range" min="3" max="12" step="1" value="5">
                </div>

                <div class="section stat-grid">
                    <div class="stat"><strong id="slideCount">4 slides</strong><span>Compact decks land better. The point is punch, not paperwork.</span></div>
                    <div class="stat"><strong id="toneStat">Velvet Gold</strong><span>The current visual mood for your miniature keynote spectacle.</span></div>
                    <div class="stat"><strong id="lengthStat">25 words</strong><span>A quick sanity check so the copy doesn't turn into wallpaper.</span></div>
                    <div class="stat"><strong id="commandStat">qsl-ready</strong><span>Your deck can be summarized into a tiny command string below.</span></div>
                </div>

                <div class="button-row">
                    <button id="renderBtn" type="button">Render deck</button>
                    <button id="shuffleBtn" class="secondary" type="button">Surprise me</button>
                    <button id="playBtn" type="button">Autoplay</button>
                    <button id="copyBtn" class="secondary" type="button">Copy command</button>
                </div>

                <div class="command">
                    <strong>Shareable pseudo-command</strong>
                    <code id="commandPreview">qsl?deck=Why%20small%20tools%20matter~Delight%20beats%20bloat</code>
                </div>
            </section>

            <div>
                <section class="panel stage-wrap">
                    <div class="stage-head">
                        <div>
                            <h2>Preview stage</h2>
                            <p class="subtle">Use the buttons, tap a thumbnail, or press the arrow keys.</p>
                        </div>
                        <div class="stage-note" id="stageNote">Slide 1 of 4</div>
                    </div>

                    <div class="cinema" id="cinema"></div>

                    <div class="nav">
                        <div class="nav-group">
                            <button id="prevBtn" class="secondary" type="button">Previous</button>
                            <button id="nextBtn" class="secondary" type="button">Next</button>
                        </div>
                        <div class="counter" id="counter">1 / 4</div>
                    </div>
                </section>

                <section class="panel filmstrip">
                    <div class="strip-head">
                        <div>
                            <h2>Filmstrip</h2>
                            <p class="subtle">A little gallery of your talking points. Dramatic? Mildly. Effective? Yes.</p>
                        </div>
                    </div>
                    <div class="thumbnails" id="thumbnails"></div>
                </section>
            </div>
        </div>

        <section class="tips">
            <div class="tip"><strong>Fast pattern</strong><span>Open with a tension, follow with the insight, close with a rallying line. Tiny decks love a clear three-act structure.</span></div>
            <div class="tip"><strong>For Jon</strong><span>This feels especially at home for quick demos, family jokes, reading notes, and wonderfully overdesigned one-off explainers.</span></div>
            <div class="tip"><strong>For Nathan</strong><span>Try a four-slide mission briefing about Knight Rider, Zelda, model kits, or the wildest snack plan of the afternoon.</span></div>
        </section>
    </div>

    <script>
        const deckInput = document.getElementById('deckInput');
        const kickerInput = document.getElementById('kickerInput');
        const footerInput = document.getElementById('footerInput');
        const themeSelect = document.getElementById('themeSelect');
        const layoutSelect = document.getElementById('layoutSelect');
        const paceInput = document.getElementById('paceInput');
        const paceLabel = document.getElementById('paceLabel');
        const cinema = document.getElementById('cinema');
        const thumbnails = document.getElementById('thumbnails');
        const counter = document.getElementById('counter');
        const stageNote = document.getElementById('stageNote');
        const slideCount = document.getElementById('slideCount');
        const toneStat = document.getElementById('toneStat');
        const lengthStat = document.getElementById('lengthStat');
        const commandStat = document.getElementById('commandStat');
        const commandPreview = document.getElementById('commandPreview');
        const renderBtn = document.getElementById('renderBtn');
        const shuffleBtn = document.getElementById('shuffleBtn');
        const playBtn = document.getElementById('playBtn');
        const copyBtn = document.getElementById('copyBtn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        const surpriseDecks = [
            {
                kicker: 'Knight Industries',
                footer: 'Turbo boost politely requested',
                theme: 'sunset',
                layout: 'split',
                slides: [
                    ['Mission briefing', 'Drive into the canyon before sundown.'],
                    ['KITT status', 'Scanner online, charm levels excessive.'],
                    ['Obstacle', 'Bridge out. Confidence somehow still high.'],
                    ['Victory lap', 'Return home with snacks and glory.']
                ]
            },
            {
                kicker: 'Lost Woods memo',
                footer: 'Listen for the right melody',
                theme: 'mint',
                layout: 'center',
                slides: [
                    ['Forest rule', 'If the music changes, you are probably doing fine.'],
                    ['Pack lightly', 'Bring courage, soup, and one excellent map.'],
                    ['The trick', 'Notice the details other people wander past.'],
                    ['Treasure', 'Sometimes the prize is a shortcut home.']
                ]
            },
            {
                kicker: 'Tiny tools manifesto',
                footer: 'Small pages, large delight',
                theme: 'velvet',
                layout: 'title-only',
                slides: [
                    ['Start with one itch'],
                    ['Use taste as a force multiplier'],
                    ['Keep the magic near the surface'],
                    ['Ship before the spell cools']
                ]
            }
        ];

        let slides = [];
        let currentIndex = 0;
        let autoplayTimer = null;

        function parseSlides() {
            const lines = deckInput.value
                .split(/\n+/)
                .map(line => line.trim())
                .filter(Boolean)
                .slice(0, 8);

            return lines.map((line, index) => {
                const bits = line.split('|');
                const title = (bits[0] || `Slide ${index + 1}`).trim();
                const subtitle = bits.slice(1).join('|').trim();
                return { title, subtitle };
            });
        }

        function escapeHtml(text) {
            return text
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function formatMiniBullets(subtitle) {
            const parts = subtitle
                .split(/[.;]\s+|,\s+/)
                .map(part => part.trim())
                .filter(Boolean)
                .slice(0, 3);
            if (!parts.length) {
                return '<ul><li>Add a subtitle to generate cue points.</li></ul>';
            }
            return `<ul>${parts.map(item => `<li>${escapeHtml(item)}</li>`).join('')}</ul>`;
        }

        function buildCommandString(deck) {
            const compressed = deck
                .map(slide => slide.subtitle ? `${slide.title}~${slide.subtitle}` : slide.title)
                .join(' / ')
                .slice(0, 180);
            return `qsl?deck=${encodeURIComponent(compressed)}&theme=${encodeURIComponent(themeSelect.value)}&layout=${encodeURIComponent(layoutSelect.value)}`;
        }

        function renderSlides() {
            slides = parseSlides();
            if (!slides.length) {
                slides = [{ title: 'Nothing here yet', subtitle: 'Write a title and subtitle to begin.' }];
            }

            const theme = themeSelect.value;
            const layout = layoutSelect.value;
            const kicker = kickerInput.value.trim() || 'Mini presentation';
            const footer = footerInput.value.trim() || 'Self-contained and shamelessly pretty';

            cinema.innerHTML = slides.map((slide, index) => {
                const titleOnly = !slide.subtitle || layout === 'title-only';
                const layoutClass = titleOnly ? 'title-only' : layout;
                const mainContent = layout === 'split' && slide.subtitle
                    ? `<div class="split-copy"><div class="slide-kicker">${escapeHtml(kicker)}</div><h3>${escapeHtml(slide.title)}</h3><p>${escapeHtml(slide.subtitle)}</p></div><div class="split-side"><strong>Cue card</strong>${formatMiniBullets(slide.subtitle)}</div>`
                    : `<div class="slide-kicker">${escapeHtml(kicker)}</div><div class="slide-title-only"><h3>${escapeHtml(slide.title)}</h3></div>${slide.subtitle && layout !== 'title-only' ? `<p>${escapeHtml(slide.subtitle)}</p>` : ''}`;

                return `
                    <article class="slide ${layoutClass} ${index === currentIndex ? 'active' : ''}" data-theme="${escapeHtml(theme)}" data-index="${index}">
                        <div class="slide-badge">Scene ${index + 1}</div>
                        <div class="slide-main">${mainContent}</div>
                        <div class="slide-footer">
                            <div class="accent-bar"></div>
                            <div>${escapeHtml(footer)}</div>
                        </div>
                    </article>
                `;
            }).join('');

            thumbnails.innerHTML = slides.map((slide, index) => `
                <button class="thumb ${index === currentIndex ? 'active' : ''}" type="button" data-index="${index}">
                    <div class="tiny-label">${index + 1}</div>
                    <strong>${escapeHtml(slide.title)}</strong>
                    <span>${escapeHtml(slide.subtitle || 'Title card')}</span>
                </button>
            `).join('');

            const wordCount = slides.reduce((sum, slide) => sum + `${slide.title} ${slide.subtitle || ''}`.trim().split(/\s+/).filter(Boolean).length, 0);
            slideCount.textContent = `${slides.length} slide${slides.length === 1 ? '' : 's'}`;
            toneStat.textContent = themeSelect.options[themeSelect.selectedIndex].text;
            lengthStat.textContent = `${wordCount} words`;
            commandStat.textContent = slides.length <= 4 ? 'qsl-ready' : 'longer cut';
            commandPreview.textContent = buildCommandString(slides);

            bindThumbs();
            updateStage();
        }

        function updateStage() {
            const slideEls = [...cinema.querySelectorAll('.slide')];
            const thumbEls = [...thumbnails.querySelectorAll('.thumb')];
            slideEls.forEach((slide, index) => slide.classList.toggle('active', index === currentIndex));
            thumbEls.forEach((thumb, index) => thumb.classList.toggle('active', index === currentIndex));
            counter.textContent = `${currentIndex + 1} / ${slides.length}`;
            stageNote.textContent = `Slide ${currentIndex + 1} of ${slides.length}`;
        }

        function bindThumbs() {
            thumbnails.querySelectorAll('.thumb').forEach(button => {
                button.addEventListener('click', () => {
                    currentIndex = Number(button.dataset.index || 0);
                    updateStage();
                });
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateStage();
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            updateStage();
        }

        function toggleAutoplay() {
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = null;
                playBtn.textContent = 'Autoplay';
                return;
            }
            autoplayTimer = setInterval(nextSlide, Number(paceInput.value) * 1000);
            playBtn.textContent = 'Pause autoplay';
        }

        function updatePaceLabel() {
            paceLabel.textContent = `${paceInput.value}s`;
            if (autoplayTimer) {
                clearInterval(autoplayTimer);
                autoplayTimer = setInterval(nextSlide, Number(paceInput.value) * 1000);
            }
        }

        function loadSurpriseDeck() {
            const pick = surpriseDecks[Math.floor(Math.random() * surpriseDecks.length)];
            deckInput.value = pick.slides.map(slide => slide.join(' | ')).join('\n');
            kickerInput.value = pick.kicker;
            footerInput.value = pick.footer;
            themeSelect.value = pick.theme;
            layoutSelect.value = pick.layout;
            currentIndex = 0;
            renderSlides();
        }

        renderBtn.addEventListener('click', () => {
            currentIndex = 0;
            renderSlides();
        });
        shuffleBtn.addEventListener('click', loadSurpriseDeck);
        playBtn.addEventListener('click', toggleAutoplay);
        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);
        paceInput.addEventListener('input', updatePaceLabel);
        themeSelect.addEventListener('change', renderSlides);
        layoutSelect.addEventListener('change', renderSlides);
        copyBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(commandPreview.textContent);
                copyBtn.textContent = 'Copied';
                setTimeout(() => { copyBtn.textContent = 'Copy command'; }, 1200);
            } catch (error) {
                copyBtn.textContent = 'Press and copy';
                setTimeout(() => { copyBtn.textContent = 'Copy command'; }, 1400);
            }
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'ArrowRight') nextSlide();
            if (event.key === 'ArrowLeft') prevSlide();
            if (event.key === ' ') {
                event.preventDefault();
                toggleAutoplay();
            }
        });

        updatePaceLabel();
        renderSlides();
    </script>
</body>
</html>
