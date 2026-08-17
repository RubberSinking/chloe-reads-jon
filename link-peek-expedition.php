<?php
// A self-contained interactive experiment inspired by Jon's Arc Browser post.
$sourceUrl = 'https://jona.ca/2024/09/arc-browser.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#08151d">
    <title>Link Peek Expedition</title>
    <style>
        :root {
            --ink: #102331;
            --night: #07131b;
            --paper: #f2e6c8;
            --paper-deep: #dac89e;
            --ember: #ed7b4a;
            --gold: #e7bd67;
            --moss: #486d58;
            --mist: #b8cad0;
            --shadow: 0 24px 70px rgba(0, 0, 0, .34);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 8%, rgba(51, 96, 105, .35), transparent 26rem),
                linear-gradient(140deg, #061219 0%, #0d252c 55%, #09151d 100%);
            font-family: "Courier Prime", "Nimbus Mono PS", "Courier New", monospace;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .12;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.55'/%3E%3C/svg%3E");
            z-index: 20;
            mix-blend-mode: soft-light;
        }

        button, a { font: inherit; }
        button { color: inherit; }

        .shell {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 56px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            color: var(--mist);
            font-size: .72rem;
            letter-spacing: .13em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .back {
            color: inherit;
            text-decoration: none;
            border-bottom: 1px solid rgba(184, 202, 208, .4);
            padding-bottom: 3px;
        }

        .signal { display: flex; align-items: center; gap: 8px; }
        .signal::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #83d19d;
            box-shadow: 0 0 0 5px rgba(131, 209, 157, .12), 0 0 16px #83d19d;
            animation: breathe 2.4s ease-in-out infinite;
        }

        .desk {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            min-height: 760px;
            background: var(--paper);
            border-radius: 3px 3px 16px 16px;
            box-shadow: var(--shadow), 0 0 0 1px rgba(255,255,255,.15);
            overflow: hidden;
        }

        .desk::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 9px;
            background: repeating-linear-gradient(90deg, transparent 0 23px, rgba(16,35,49,.15) 23px 24px);
            opacity: .55;
            pointer-events: none;
        }

        .article {
            position: relative;
            padding: clamp(30px, 6vw, 74px);
            min-width: 0;
            background:
                linear-gradient(rgba(242,230,200,.94), rgba(242,230,200,.94)),
                url("link-peek-panorama.webp") center/cover;
        }

        .kicker {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #9b4a32;
            font-size: .72rem;
            font-weight: 500;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        .kicker::before { content: ""; width: 42px; height: 2px; background: var(--ember); }

        h1 {
            max-width: 720px;
            margin: 20px 0 18px;
            font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif;
            font-size: clamp(3.5rem, 8vw, 7.3rem);
            font-weight: 900;
            line-height: .78;
            letter-spacing: -.065em;
        }

        h1 em { display: block; color: var(--moss); font-weight: 500; }

        .dek {
            max-width: 670px;
            margin: 24px 0 34px;
            font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif;
            font-size: clamp(1.05rem, 2vw, 1.34rem);
            line-height: 1.48;
        }

        .instruction {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 13px;
            margin-bottom: 28px;
            color: var(--paper);
            background: var(--ink);
            box-shadow: 5px 5px 0 var(--ember);
            font-size: .69rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            transform: rotate(-1deg);
        }
        kbd {
            padding: 3px 6px;
            color: var(--ink);
            background: var(--paper);
            border-radius: 2px;
            box-shadow: inset 0 -2px rgba(16,35,49,.2);
            font-weight: 500;
        }

        .dispatch {
            position: relative;
            padding: 24px 24px 20px;
            border: 1px solid rgba(16,35,49,.28);
            background: rgba(255,250,235,.48);
        }
        .dispatch::before {
            content: "FIELD NOTES / 05";
            position: absolute;
            top: -9px;
            left: 18px;
            padding: 1px 8px;
            color: #745b3f;
            background: var(--paper);
            font-size: .61rem;
            letter-spacing: .12em;
        }
        .dispatch p { margin: 0 0 14px; font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif; line-height: 1.65; }
        .dispatch p:last-child { margin-bottom: 0; }

        .peek-link {
            position: relative;
            display: inline-flex;
            align-items: baseline;
            gap: 5px;
            border: 0;
            padding: 0 2px;
            color: #8d3e2b;
            background: linear-gradient(transparent 64%, rgba(237,123,74,.25) 64%);
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            text-align: left;
            transition: color .18s, background .18s;
        }
        .peek-link::after { content: "↗"; font-family: "Courier Prime", "Nimbus Mono PS", monospace; font-size: .7em; }
        .peek-link:hover, .peek-link:focus-visible, .peek-link.primed {
            outline: none;
            color: #fff5db;
            background: var(--moss);
        }

        .rail {
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 35px 25px 26px;
            color: var(--paper);
            background:
                linear-gradient(rgba(7,19,27,.76), rgba(7,19,27,.93)),
                url("link-peek-panorama.webp") 86% center/auto 100%;
            border-left: 1px solid rgba(255,255,255,.12);
        }
        .rail h2 {
            margin: 0 0 7px;
            font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif;
            font-size: 1.55rem;
        }
        .rail-intro { color: var(--mist); font-size: .7rem; line-height: 1.55; margin: 0 0 25px; }

        .mission-dots { display: flex; gap: 7px; margin-bottom: 22px; }
        .mission-dots span {
            width: 32px; height: 5px; background: rgba(255,255,255,.17); transform: skewX(-20deg);
        }
        .mission-dots span.done { background: var(--gold); box-shadow: 0 0 10px rgba(231,189,103,.45); }

        .mission-card {
            border-top: 1px solid rgba(242,230,200,.3);
            border-bottom: 1px solid rgba(242,230,200,.3);
            padding: 21px 0;
        }
        .mission-no { color: var(--gold); font-size: .62rem; letter-spacing: .14em; text-transform: uppercase; }
        .mission-card h3 { margin: 9px 0; font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif; font-size: 1.32rem; line-height: 1.08; }
        .mission-card p { color: var(--mist); font-size: .69rem; line-height: 1.55; }

        .scoreline { display: flex; justify-content: space-between; margin-top: 18px; font-size: .63rem; letter-spacing: .09em; text-transform: uppercase; }
        .tabs-saved { color: var(--gold); font-size: 1.5rem; font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif; }

        .tip {
            margin-top: auto;
            padding-top: 25px;
            color: rgba(242,230,200,.58);
            font-size: .62rem;
            line-height: 1.55;
        }

        .source {
            margin: 30px 0 0;
            font-size: .66rem;
            line-height: 1.6;
            color: #6f654f;
        }
        .source a { color: #7e3a2a; text-underline-offset: 3px; }

        .portal {
            position: fixed;
            z-index: 10;
            width: min(460px, calc(100vw - 24px));
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(12px) scale(.96) rotate(-.8deg);
            transform-origin: 25% 100%;
            transition: opacity .2s, transform .26s cubic-bezier(.2,.8,.2,1), visibility .2s;
            filter: drop-shadow(0 22px 32px rgba(0,0,0,.5));
        }
        .portal.open { opacity: 1; visibility: visible; transform: translateY(0) scale(1) rotate(0); pointer-events: auto; }
        .portal-frame {
            position: relative;
            overflow: hidden;
            min-height: 275px;
            border: 7px solid var(--paper);
            background: var(--night);
            clip-path: polygon(0 3%, 3% 2%, 5% 0, 17% 1%, 29% 0, 39% 2%, 50% 0, 64% 1%, 77% 0, 88% 2%, 100% 0, 99% 19%, 100% 35%, 99% 51%, 100% 68%, 98% 82%, 100% 100%, 81% 99%, 63% 100%, 45% 98%, 30% 100%, 14% 99%, 0 100%, 1% 80%, 0 62%, 1% 44%, 0 25%);
        }
        .world {
            position: absolute;
            inset: 0;
            background-image: url("link-peek-panorama.webp");
            background-size: 500% 100%;
            background-position: var(--pos, 0%) center;
            transform: scale(1.02);
            transition: transform 4s ease-out;
        }
        .portal.open .world { transform: scale(1.1); }
        .world::after { content: ""; position: absolute; inset: 0; background: linear-gradient(transparent 38%, rgba(4,12,17,.94)); }
        .portal-copy { position: relative; z-index: 2; display: flex; flex-direction: column; justify-content: end; min-height: 275px; padding: 100px 24px 21px; color: #fff4d8; }
        .portal-label { color: var(--gold); font-size: .59rem; letter-spacing: .15em; text-transform: uppercase; }
        .portal-copy h3 { margin: 5px 0 6px; font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif; font-size: 2rem; line-height: 1; }
        .portal-copy p { margin: 0; max-width: 39ch; color: #d8e1db; font-size: .7rem; line-height: 1.45; }
        .portal-actions { display: flex; gap: 8px; margin-top: 15px; }
        .portal-actions button {
            border: 1px solid rgba(255,255,255,.34);
            padding: 8px 10px;
            color: #fff4d8;
            background: rgba(7,19,27,.6);
            cursor: pointer;
            font-size: .61rem;
            letter-spacing: .06em;
            text-transform: uppercase;
        }
        .portal-actions button:first-child { color: var(--night); background: var(--gold); border-color: var(--gold); }

        .toast {
            position: fixed;
            z-index: 30;
            left: 50%; bottom: 24px;
            max-width: calc(100% - 32px);
            padding: 12px 17px;
            color: var(--night);
            background: var(--gold);
            box-shadow: 5px 5px 0 var(--ember);
            font-size: .68rem;
            font-weight: 500;
            transform: translate(-50%, 30px);
            opacity: 0;
            pointer-events: none;
            transition: .25s;
        }
        .toast.show { opacity: 1; transform: translate(-50%, 0); }

        .complete {
            display: none;
            margin-top: 18px;
            padding: 18px;
            color: var(--night);
            background: var(--gold);
            transform: rotate(1deg);
        }
        .complete.show { display: block; animation: stamp .38s both; }
        .complete strong { display: block; font-family: "Iowan Old Style", "Palatino Linotype", "URW Palladio L", Georgia, serif; font-size: 1.35rem; }
        .complete span { font-size: .63rem; }

        @keyframes breathe { 50% { transform: scale(.72); opacity: .65; } }
        @keyframes stamp { from { opacity: 0; transform: scale(1.5) rotate(-8deg); } to { opacity: 1; transform: scale(1) rotate(1deg); } }

        @media (max-width: 820px) {
            .desk { grid-template-columns: 1fr; }
            .rail { min-height: 390px; border-left: 0; border-top: 1px solid rgba(255,255,255,.15); }
            .article { padding: 42px 24px 45px; }
            .tip { margin-top: 30px; }
            h1 { font-size: clamp(3.4rem, 17vw, 5.8rem); }
            .portal { left: 12px !important; right: 12px !important; top: auto !important; bottom: 12px !important; width: auto; }
            .portal-frame { min-height: 300px; }
            .portal-copy { min-height: 300px; }
        }

        @media (hover: none) {
            .instruction { transform: none; }
            .instruction .desktop-only { display: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
<main class="shell">
    <nav class="topbar" aria-label="Page navigation">
        <a class="back" href="./">← Chloe Reads Jon</a>
        <span class="signal">Preview engine awake</span>
    </nav>

    <section class="desk">
        <article class="article">
            <div class="kicker">An anti-tab expedition</div>
            <h1>Link <em>Peek</em></h1>
            <p class="dek">The web is full of little doors. Must we barge through every one? Learn to glance, gather, and keep your place.</p>
            <div class="instruction">
                <span class="desktop-only">Hold <kbd>Shift</kbd> + hover a marked link</span>
                <span>Tap a link to peek</span>
            </div>

            <div class="dispatch">
                <p>The Night Almanac records that the observatory's <button class="peek-link" data-world="observatory">August sky report</button> names the best hour to see Saturn. Its editor also recommends a <button class="peek-link" data-world="library">rainy-night reading list</button> for weather that refuses to behave.</p>
                <p>Farther afield, the <button class="peek-link" data-world="railway">Alpine sleeper timetable</button> reveals which platform serves the last red train. The botanists have meanwhile filed <button class="peek-link" data-world="greenhouse">notes from the glasshouse</button> about a plant that glows after dusk.</p>
                <p>One warning remains: the keeper's <button class="peek-link" data-world="lighthouse">storm-lantern bulletin</button> says when the sea path disappears beneath the tide. A competent explorer checks before packing sandwiches.</p>
            </div>

            <p class="source">This experiment was inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener">“Arc Browser” post</a>, especially the small pleasure of holding Shift over a link and seeing what lies beyond it.</p>
        </article>

        <aside class="rail" aria-live="polite">
            <h2>Field missions</h2>
            <p class="rail-intro">Answer from previews alone. Opening five tabs for this would be rather missing the point.</p>
            <div class="mission-dots" aria-label="Mission progress"><span></span><span></span><span></span></div>
            <div class="mission-card">
                <span class="mission-no">Mission 01 / 03</span>
                <h3 id="mission-title">When is Saturn highest?</h3>
                <p id="mission-hint">Peek behind the link most likely to contain a sky report, then collect the answer.</p>
            </div>
            <div class="scoreline"><span>Tabs not opened</span><strong class="tabs-saved">0</strong></div>
            <div class="complete" id="complete"><strong>Certified Link Naturalist</strong><span>Three facts gathered. Zero context abandoned.</span></div>
            <p class="tip">Mobile note: tapping a marked link opens its preview. Desktop note: Shift-hover is the authentic fancy-browser manoeuvre.</p>
        </aside>
    </section>
</main>

<div class="portal" id="portal" role="dialog" aria-modal="false" aria-labelledby="portal-title">
    <div class="portal-frame">
        <div class="world"></div>
        <div class="portal-copy">
            <span class="portal-label">Preview / no new tab</span>
            <h3 id="portal-title"></h3>
            <p id="portal-text"></p>
            <div class="portal-actions">
                <button id="collect" type="button">Collect fact</button>
                <button id="close" type="button">Keep reading</button>
            </div>
        </div>
    </div>
</div>
<div class="toast" id="toast"></div>

<script>
(() => {
    const worlds = {
        observatory: { title: 'August Sky Report', text: 'Saturn reaches its highest point at 1:14 a.m. Face southeast; the pale steady light is the planet, not an aircraft.', fact: '1:14 a.m.', pos: '0%' },
        library: { title: 'Rainy-Night Reading List', text: 'Tonight’s shelf: The Wind in the Willows, A Wrinkle in Time, and one detective novel chosen chiefly for its thunderstorm.', fact: 'A Wrinkle in Time', pos: '25%' },
        railway: { title: 'Alpine Sleeper Timetable', text: 'The last red train departs from Platform 4 at 22:40. Tea service begins immediately after the mountain tunnel.', fact: 'Platform 4', pos: '50%' },
        greenhouse: { title: 'Notes from the Glasshouse', text: 'The moonvine opens at dusk and gives off a soft blue-green glow. Do not confuse its seedpods with peas.', fact: 'moonvine', pos: '75%' },
        lighthouse: { title: 'Storm-Lantern Bulletin', text: 'The lower sea path floods at 6:20 p.m. Use the cliff stairs after that hour and keep both hands free.', fact: '6:20 p.m.', pos: '100%' }
    };

    const missions = [
        { world: 'observatory', title: 'When is Saturn highest?', hint: 'Peek behind the link most likely to contain a sky report, then collect the answer.' },
        { world: 'railway', title: 'Which platform serves the last red train?', hint: 'A timetable knows more than a reading list, however charming the reading list may be.' },
        { world: 'lighthouse', title: 'When does the lower sea path flood?', hint: 'The keeper has left a warning. Find it without wandering away from the dispatch.' }
    ];

    const portal = document.getElementById('portal');
    const worldEl = portal.querySelector('.world');
    const titleEl = document.getElementById('portal-title');
    const textEl = document.getElementById('portal-text');
    const collect = document.getElementById('collect');
    const close = document.getElementById('close');
    const toast = document.getElementById('toast');
    const missionTitle = document.getElementById('mission-title');
    const missionHint = document.getElementById('mission-hint');
    const dots = [...document.querySelectorAll('.mission-dots span')];
    const saved = document.querySelector('.tabs-saved');
    const complete = document.getElementById('complete');
    let active = null;
    let mission = 0;
    let timer;

    function placePortal(anchor) {
        if (matchMedia('(max-width: 820px)').matches) return;
        const r = anchor.getBoundingClientRect();
        const width = Math.min(460, innerWidth - 24);
        let left = Math.min(innerWidth - width - 12, Math.max(12, r.left - 30));
        let top = r.top - 300;
        if (top < 12) top = Math.min(innerHeight - 300, r.bottom + 14);
        portal.style.left = left + 'px';
        portal.style.top = top + 'px';
    }

    function show(name, anchor) {
        active = name;
        const data = worlds[name];
        document.querySelectorAll('.peek-link').forEach(x => x.classList.remove('primed'));
        anchor.classList.add('primed');
        worldEl.style.setProperty('--pos', data.pos);
        titleEl.textContent = data.title;
        textEl.textContent = data.text;
        collect.textContent = missions[mission]?.world === name ? 'Collect answer' : 'Collect fact';
        placePortal(anchor);
        portal.classList.add('open');
    }

    function hide() {
        portal.classList.remove('open');
        document.querySelectorAll('.peek-link').forEach(x => x.classList.remove('primed'));
    }

    function announce(message) {
        clearTimeout(timer);
        toast.textContent = message;
        toast.classList.add('show');
        timer = setTimeout(() => toast.classList.remove('show'), 2300);
    }

    document.querySelectorAll('.peek-link').forEach(link => {
        link.addEventListener('mouseenter', e => { if (e.shiftKey) show(link.dataset.world, link); });
        link.addEventListener('mousemove', e => { if (e.shiftKey && active !== link.dataset.world) show(link.dataset.world, link); });
        link.addEventListener('click', () => show(link.dataset.world, link));
        link.addEventListener('focus', e => { if (e.shiftKey) show(link.dataset.world, link); });
    });

    collect.addEventListener('click', () => {
        const current = missions[mission];
        if (!current) return;
        if (active !== current.world) {
            announce('Interesting, but not the answer to this mission.');
            return;
        }
        dots[mission].classList.add('done');
        saved.textContent = String(mission + 1);
        announce('Collected: ' + worlds[active].fact);
        mission++;
        hide();
        if (mission < missions.length) {
            document.querySelector('.mission-no').textContent = `Mission 0${mission + 1} / 03`;
            missionTitle.textContent = missions[mission].title;
            missionHint.textContent = missions[mission].hint;
        } else {
            document.querySelector('.mission-card').style.display = 'none';
            complete.classList.add('show');
        }
    });

    close.addEventListener('click', hide);
    document.addEventListener('keydown', e => { if (e.key === 'Escape') hide(); });
    document.addEventListener('click', e => {
        if (portal.classList.contains('open') && !portal.contains(e.target) && !e.target.closest('.peek-link')) hide();
    });
})();
</script>
</body>
</html>
