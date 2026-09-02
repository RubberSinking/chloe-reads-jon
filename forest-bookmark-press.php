<?php
$sourceUrl = 'https://jona.ca/2008/03/nice-bookmarks-you-can-print-out.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#162b24">
    <title>Cedar &amp; Quill Bookmark Press</title>
    <style>
        :root {
            --ink: #243026;
            --paper: #f5edda;
            --paper-deep: #e2d3b1;
            --moss: #183a2e;
            --fern: #76916c;
            --amber: #d8953b;
            --rust: #9f4932;
            --night: #102d34;
            --shadow: rgba(10, 27, 22, .28);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            color: var(--ink);
            font-family: "Palatino Linotype", Palatino, "Book Antiqua", serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at 12% 8%, rgba(216,149,59,.22), transparent 28rem),
                radial-gradient(circle at 92% 28%, rgba(118,145,108,.18), transparent 25rem),
                linear-gradient(135deg, #102a25, #0b1f1d 55%, #173730);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .2;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.25'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
        }

        button, input, select { font: inherit; }

        .shell {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 30px 0 54px;
        }

        .topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 28px;
            color: #efe4c9;
        }

        .back, .source-link {
            color: inherit;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.35);
        }

        .back:hover, .source-link:hover { border-color: var(--amber); }

        .press-mark {
            font-size: .72rem;
            text-transform: uppercase;
            letter-spacing: .22em;
            opacity: .68;
        }

        header {
            color: #fff9e9;
            max-width: 820px;
            margin: 0 0 30px;
        }

        .kicker {
            color: #e7b66f;
            text-transform: uppercase;
            letter-spacing: .19em;
            font-size: .74rem;
            font-weight: 700;
            margin: 0 0 10px;
        }

        h1 {
            font-size: clamp(2.7rem, 7vw, 6.2rem);
            line-height: .86;
            letter-spacing: -.055em;
            font-weight: 500;
            margin: 0;
            text-wrap: balance;
        }

        h1 i { color: #e4ad60; font-weight: 400; }

        .lede {
            max-width: 640px;
            font-size: clamp(1rem, 2vw, 1.2rem);
            line-height: 1.65;
            color: #d6ddce;
            margin: 20px 0 0;
        }

        .workbench {
            display: grid;
            grid-template-columns: minmax(300px, 1fr) minmax(420px, 1.45fr);
            background: var(--paper);
            border: 1px solid rgba(255,255,255,.18);
            box-shadow: 0 28px 80px rgba(0,0,0,.38);
            min-height: 690px;
            position: relative;
            overflow: hidden;
        }

        .workbench::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            box-shadow: inset 0 0 70px rgba(102,67,33,.1);
        }

        .controls {
            padding: clamp(24px, 4vw, 48px);
            border-right: 1px solid #c9b994;
            background:
                linear-gradient(rgba(245,237,218,.92), rgba(245,237,218,.92)),
                repeating-linear-gradient(0deg, transparent 0 27px, rgba(91,102,78,.11) 28px);
            z-index: 1;
        }

        .step-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 18px;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .16em;
            color: #596557;
        }

        .step-label::before, .step-label::after {
            content: "";
            height: 1px;
            background: #b9aa88;
            flex: 1;
        }

        fieldset {
            border: 0;
            margin: 0 0 28px;
            padding: 0;
        }

        legend {
            font-size: 1.06rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .choice-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .choice {
            position: relative;
        }

        .choice input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .choice span {
            display: grid;
            place-items: center;
            min-height: 72px;
            padding: 10px 6px;
            text-align: center;
            font-size: .82rem;
            line-height: 1.2;
            cursor: pointer;
            border: 1px solid #c9b994;
            background: rgba(255,255,255,.35);
            transition: transform .2s, color .2s, background .2s, box-shadow .2s;
        }

        .choice span b {
            display: block;
            font-size: 1.3rem;
            margin-bottom: 4px;
            font-weight: 400;
        }

        .choice input:checked + span {
            background: var(--moss);
            color: #fff8e8;
            border-color: var(--moss);
            box-shadow: 4px 4px 0 var(--amber);
            transform: translate(-2px,-2px);
        }

        .text-field { margin-bottom: 15px; }

        .text-field label {
            display: block;
            font-size: .73rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            margin-bottom: 6px;
            color: #596557;
        }

        .text-field input, .text-field select {
            width: 100%;
            min-height: 45px;
            border: 0;
            border-bottom: 1px solid #8c8066;
            border-radius: 0;
            background: rgba(255,255,255,.28);
            padding: 7px 10px;
            color: var(--ink);
            outline: none;
        }

        .text-field input:focus, .text-field select:focus {
            box-shadow: inset 4px 0 0 var(--amber);
            background: rgba(255,255,255,.62);
        }

        .shape-row { display: flex; gap: 8px; }

        .shape-button {
            flex: 1;
            border: 1px solid #aa9b7a;
            background: transparent;
            color: var(--ink);
            padding: 10px 6px;
            cursor: pointer;
        }

        .shape-button[aria-pressed="true"] {
            background: #dcc79d;
            border-color: var(--rust);
            box-shadow: inset 0 -3px var(--rust);
        }

        .action-row {
            display: flex;
            gap: 10px;
            margin-top: 28px;
        }

        .action {
            border: 0;
            padding: 13px 18px;
            cursor: pointer;
            font-weight: 700;
            transition: transform .2s, box-shadow .2s;
        }

        .action:hover { transform: translateY(-2px); }
        .action.primary { background: var(--rust); color: white; box-shadow: 4px 4px 0 #543025; }
        .action.secondary { background: transparent; border: 1px solid #9f9276; color: var(--ink); }

        .studio {
            position: relative;
            display: grid;
            place-items: center;
            padding: 70px 30px 52px;
            overflow: hidden;
            background:
                radial-gradient(circle at center, rgba(243,224,179,.9), rgba(208,186,140,.18) 45%, transparent 46%),
                linear-gradient(115deg, #d9c8a1, #b8aa8f);
            z-index: 1;
        }

        .studio::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: .25;
            background-image:
                linear-gradient(30deg, #85785f 1px, transparent 1px),
                linear-gradient(150deg, #85785f 1px, transparent 1px);
            background-size: 34px 59px;
        }

        .measurement {
            position: absolute;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
            color: #6a604d;
            font-size: .67rem;
            letter-spacing: .15em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .measurement::before, .measurement::after { content: " — "; }

        .bookmark-wrap {
            position: relative;
            filter: drop-shadow(18px 24px 13px rgba(41,33,22,.32));
            animation: arrive .9s cubic-bezier(.2,.8,.2,1) both;
            z-index: 2;
        }

        @keyframes arrive {
            from { opacity: 0; transform: translateY(28px) rotate(3deg); }
            to { opacity: 1; transform: translateY(0) rotate(-1.2deg); }
        }

        .tassel {
            position: absolute;
            width: 8px;
            height: 77px;
            background: var(--tassel, #ba7939);
            left: 50%;
            top: -67px;
            transform: translateX(-50%);
            z-index: -1;
            border-radius: 6px;
            box-shadow: 5px 0 rgba(67,43,21,.17);
        }

        .tassel::before {
            content: "";
            position: absolute;
            width: 23px;
            height: 23px;
            border: 7px double var(--tassel, #ba7939);
            background: transparent;
            border-radius: 50%;
            left: 50%;
            top: -6px;
            transform: translateX(-50%);
        }

        .tassel::after {
            content: "";
            position: absolute;
            width: 34px;
            height: 42px;
            left: 50%;
            bottom: -23px;
            transform: translateX(-50%);
            background: repeating-linear-gradient(90deg, var(--tassel, #ba7939) 0 3px, transparent 3px 5px);
            clip-path: polygon(15% 0,85% 0,100% 100%,0 100%);
        }

        .bookmark {
            width: 230px;
            aspect-ratio: 1 / 3.45;
            position: relative;
            overflow: hidden;
            background: #17362c;
            border: 9px solid #f3e2b8;
            outline: 1px solid rgba(68,47,28,.65);
            transition: clip-path .35s ease, border-radius .35s ease, filter .35s;
        }

        .bookmark.arch { border-radius: 115px 115px 8px 8px; }
        .bookmark.notch { clip-path: polygon(0 0,100% 0,100% 94%,50% 100%,0 94%); }
        .bookmark.ticket { clip-path: polygon(0 0,100% 0,100% 8%,95% 9%,100% 10%,100% 90%,95% 91%,100% 92%,100% 100%,0 100%,0 92%,5% 91%,0 90%,0 10%,5% 9%,0 8%); }

        .art {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 50% 50%;
            transform: scale(1.01);
            transition: object-position .7s ease, filter .5s ease;
        }

        .bookmark[data-guide="librarian"] .art { object-position: 50% 43%; }
        .bookmark[data-guide="courier"] .art { object-position: 52% 72%; }
        .bookmark[data-guide="firefly"] .art { object-position: 48% 14%; }

        .bookmark[data-palette="moon"] .art { filter: saturate(.72) hue-rotate(19deg) brightness(.78) contrast(1.12); }
        .bookmark[data-palette="ember"] .art { filter: saturate(1.2) sepia(.12) contrast(1.05); }
        .bookmark[data-palette="fern"] .art { filter: saturate(.86) hue-rotate(-10deg) brightness(.96); }

        .veil {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(5,24,20,.05) 35%, rgba(5,18,14,.18) 55%, rgba(4,16,13,.93) 100%);
        }

        .bookmark-copy {
            position: absolute;
            inset: auto 17px 23px;
            color: #fff9e7;
            text-align: center;
            text-shadow: 0 2px 5px rgba(0,0,0,.85);
        }

        .sigil { font-size: 1.45rem; line-height: 1; color: #eab35e; }

        .reader-name {
            margin: 8px 0 4px;
            font-size: 1.35rem;
            line-height: 1;
            font-style: italic;
            overflow-wrap: anywhere;
        }

        .motto {
            margin: 0;
            font-size: .66rem;
            line-height: 1.45;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .edition {
            position: absolute;
            top: 14px;
            left: 14px;
            right: 14px;
            text-align: center;
            color: #fff6dc;
            text-transform: uppercase;
            font-size: .52rem;
            letter-spacing: .22em;
            text-shadow: 0 1px 4px #000;
        }

        .hint {
            position: absolute;
            right: 20px;
            bottom: 18px;
            width: 150px;
            font-size: .72rem;
            line-height: 1.35;
            color: #5e5545;
            transform: rotate(-3deg);
        }

        .hint::before { content: "↖ "; color: var(--rust); font-size: 1.2rem; }

        .footer-note {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            color: #d1dacf;
            font-size: .85rem;
            line-height: 1.5;
            margin-top: 22px;
        }

        .footer-note p { margin: 0; }

        .toast {
            position: fixed;
            left: 50%;
            bottom: 22px;
            transform: translate(-50%, 30px);
            opacity: 0;
            background: #fff3d6;
            color: #23352b;
            border: 1px solid #d5b675;
            box-shadow: 0 10px 30px rgba(0,0,0,.3);
            padding: 12px 18px;
            z-index: 10;
            transition: .3s;
            pointer-events: none;
        }

        .toast.show { opacity: 1; transform: translate(-50%, 0); }

        @media (max-width: 850px) {
            .workbench { grid-template-columns: 1fr; }
            .controls { border-right: 0; border-bottom: 1px solid #c9b994; }
            .studio { min-height: 680px; }
            .topline { align-items: flex-start; }
        }

        @media (max-width: 520px) {
            .shell { width: min(100% - 18px, 1180px); padding-top: 18px; }
            .press-mark { display: none; }
            .controls { padding: 24px 18px 30px; }
            .studio { padding-inline: 14px; min-height: 660px; }
            .bookmark { width: 205px; }
            .hint { width: 104px; right: 8px; font-size: .65rem; }
            .action-row { flex-direction: column; }
            .footer-note { flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }

        @page { size: letter portrait; margin: .45in; }

        @media print {
            body { background: white; }
            body::before, .topline, header, .controls, .measurement, .hint, .footer-note, .toast { display: none !important; }
            .shell, .workbench, .studio { width: auto; margin: 0; padding: 0; background: white; box-shadow: none; border: 0; min-height: 0; overflow: visible; display: block; }
            .bookmark-wrap { filter: none; transform: none !important; margin: .25in auto; }
            .bookmark { width: 2.15in; height: 7.42in; print-color-adjust: exact; -webkit-print-color-adjust: exact; }
            .tassel { display: none; }
            .bookmark-wrap::after {
                content: "Cut around the outer edge • punch a hole at the top if adding a ribbon";
                display: block;
                width: 4in;
                margin: 18px -1in 0;
                text-align: center;
                color: #555;
                font: 9pt Georgia, serif;
            }
        }
    </style>
</head>
<body>
<main class="shell">
    <nav class="topline" aria-label="Page navigation">
        <a class="back" href="./">← Chloe Reads Jon</a>
        <span class="press-mark">Established beneath the old cedar</span>
    </nav>

    <header>
        <p class="kicker">A very small bindery for very long adventures</p>
        <h1>Cedar <i>&amp;</i> Quill<br>Bookmark Press</h1>
        <p class="lede">Choose a forest guide, set your inscription, and print a handsome companion for the book currently keeping you up too late.</p>
    </header>

    <section class="workbench" aria-label="Interactive bookmark workshop">
        <form class="controls" onsubmit="return false">
            <p class="step-label">Compose your edition</p>

            <fieldset>
                <legend>1. Choose a forest guide</legend>
                <div class="choice-grid">
                    <label class="choice">
                        <input type="radio" name="guide" value="librarian" checked>
                        <span><b>◉</b>Owl<br>Librarian</span>
                    </label>
                    <label class="choice">
                        <input type="radio" name="guide" value="courier">
                        <span><b>♠</b>Squirrel<br>Courier</span>
                    </label>
                    <label class="choice">
                        <input type="radio" name="guide" value="firefly">
                        <span><b>✦</b>Firefly<br>Scout</span>
                    </label>
                </div>
            </fieldset>

            <fieldset>
                <legend>2. Inscribe the lower field</legend>
                <div class="text-field">
                    <label for="reader">Reader’s name</label>
                    <input id="reader" type="text" maxlength="24" value="Jon’s next chapter" autocomplete="off">
                </div>
                <div class="text-field">
                    <label for="motto">Tiny reading motto</label>
                    <input id="motto" type="text" maxlength="46" value="One more page, then another" autocomplete="off">
                </div>
            </fieldset>

            <fieldset>
                <legend>3. Select the ink &amp; cut</legend>
                <div class="text-field">
                    <label for="palette">Lantern light</label>
                    <select id="palette">
                        <option value="ember">Ember &amp; russet</option>
                        <option value="fern">Old fern</option>
                        <option value="moon">Moonlit blue</option>
                    </select>
                </div>
                <div class="shape-row" aria-label="Bookmark cut shape">
                    <button class="shape-button" type="button" data-shape="arch" aria-pressed="true">Arched</button>
                    <button class="shape-button" type="button" data-shape="notch" aria-pressed="false">Notched</button>
                    <button class="shape-button" type="button" data-shape="ticket" aria-pressed="false">Ticket</button>
                </div>
            </fieldset>

            <div class="action-row">
                <button class="action primary" id="print" type="button">Print this bookmark</button>
                <button class="action secondary" id="surprise" type="button">Surprise me</button>
            </div>
        </form>

        <div class="studio">
            <span class="measurement">Finished size 2.15 × 7.42 in</span>
            <div class="bookmark-wrap" aria-live="polite">
                <div class="tassel" aria-hidden="true"></div>
                <article class="bookmark arch" id="bookmark" data-guide="librarian" data-palette="ember" aria-label="Your custom bookmark preview">
                    <img class="art" src="assets/forest-bookmark-library.webp" alt="A spectacled owl and book-carrying squirrel at a lantern-lit library inside a cedar tree">
                    <div class="veil"></div>
                    <div class="edition">Cedar &amp; Quill • No. <span id="number">184</span></div>
                    <div class="bookmark-copy">
                        <div class="sigil" id="sigil">◉</div>
                        <p class="reader-name" id="readerOutput">Jon’s next chapter</p>
                        <p class="motto" id="mottoOutput">One more page, then another</p>
                    </div>
                </article>
            </div>
            <p class="hint">Your guide changes where the illustration settles inside the cut.</p>
        </div>
    </section>

    <footer class="footer-note">
        <p>Original forest artwork created for this little press. Best printed on heavy matte paper at 100% scale.</p>
        <p>Inspired by Jon’s <a class="source-link" href="<?= htmlspecialchars($sourceUrl) ?>">Nice bookmarks you can print out</a>.</p>
    </footer>
</main>

<div class="toast" id="toast" role="status">A fresh edition has come off the press.</div>

<script>
(() => {
    const bookmark = document.querySelector('#bookmark');
    const reader = document.querySelector('#reader');
    const motto = document.querySelector('#motto');
    const readerOutput = document.querySelector('#readerOutput');
    const mottoOutput = document.querySelector('#mottoOutput');
    const palette = document.querySelector('#palette');
    const sigil = document.querySelector('#sigil');
    const number = document.querySelector('#number');
    const toast = document.querySelector('#toast');
    const guides = ['librarian', 'courier', 'firefly'];
    const palettes = ['ember', 'fern', 'moon'];
    const shapes = ['arch', 'notch', 'ticket'];
    const guideMarks = { librarian: '◉', courier: '♠', firefly: '✦' };
    const tassels = { ember: '#ba7939', fern: '#667a56', moon: '#466f78' };
    const names = ['Jon’s next chapter', 'Nathan’s wild quest', 'Keeper of the story', 'This path belongs to me'];
    const mottos = ['One more page, then another', 'Meet me beyond the margin', 'Stories leave the lantern on', 'Not lost, merely reading'];

    function update() {
        const guide = document.querySelector('input[name="guide"]:checked').value;
        bookmark.dataset.guide = guide;
        bookmark.dataset.palette = palette.value;
        bookmark.parentElement.style.setProperty('--tassel', tassels[palette.value]);
        readerOutput.textContent = reader.value.trim() || 'A patient reader';
        mottoOutput.textContent = motto.value.trim() || 'The trail continues';
        sigil.textContent = guideMarks[guide];
    }

    function setShape(shape) {
        shapes.forEach(name => bookmark.classList.toggle(name, name === shape));
        document.querySelectorAll('.shape-button').forEach(button => {
            button.setAttribute('aria-pressed', button.dataset.shape === shape ? 'true' : 'false');
        });
    }

    function showToast(message) {
        toast.textContent = message;
        toast.classList.add('show');
        clearTimeout(showToast.timer);
        showToast.timer = setTimeout(() => toast.classList.remove('show'), 2200);
    }

    document.querySelectorAll('input[name="guide"]').forEach(input => input.addEventListener('change', update));
    document.querySelectorAll('.shape-button').forEach(button => button.addEventListener('click', () => setShape(button.dataset.shape)));
    [reader, motto, palette].forEach(input => input.addEventListener('input', update));

    document.querySelector('#surprise').addEventListener('click', () => {
        const guide = guides[Math.floor(Math.random() * guides.length)];
        const chosenPalette = palettes[Math.floor(Math.random() * palettes.length)];
        const shape = shapes[Math.floor(Math.random() * shapes.length)];
        document.querySelector(`input[name="guide"][value="${guide}"]`).checked = true;
        palette.value = chosenPalette;
        reader.value = names[Math.floor(Math.random() * names.length)];
        motto.value = mottos[Math.floor(Math.random() * mottos.length)];
        number.textContent = String(Math.floor(Math.random() * 900) + 100);
        setShape(shape);
        update();
        bookmark.animate([
            { transform: 'rotate(-1.2deg) scale(.94)', opacity: .6 },
            { transform: 'rotate(1deg) scale(1.025)', opacity: 1, offset: .65 },
            { transform: 'rotate(-1.2deg) scale(1)', opacity: 1 }
        ], { duration: 560, easing: 'cubic-bezier(.2,.8,.2,1)' });
        showToast('A fresh edition has come off the press.');
    });

    document.querySelector('#print').addEventListener('click', () => {
        showToast('Opening the print room…');
        setTimeout(() => window.print(), 280);
    });

    update();
})();
</script>
</body>
</html>
