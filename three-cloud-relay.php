<?php
$sourceUrl = 'https://jona.ca/2025/05/how-to-edit-markdown-files-on-google.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#071b2f">
    <title>The Three-Cloud Relay</title>
    <style>
        :root {
            --night: #071b2f;
            --deep: #0b2940;
            --paper: #f6e8ca;
            --ink: #152a37;
            --orange: #ff8a4c;
            --mint: #8ce0c1;
            --blue: #81b8ff;
            --rose: #e77b9a;
            --gold: #ffd47a;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--paper);
            background:
                radial-gradient(circle at 20% 10%, rgba(60, 135, 160, .2), transparent 32rem),
                radial-gradient(circle at 90% 50%, rgba(170, 67, 108, .16), transparent 28rem),
                var(--night);
            font-family: Georgia, 'Times New Roman', serif;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .16;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.3'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            z-index: 20;
        }
        a { color: inherit; }
        button { font: inherit; }
        .shell { width: min(1180px, 100%); margin: 0 auto; padding: 22px clamp(16px, 3vw, 42px) 60px; }
        nav { display: flex; justify-content: space-between; align-items: center; gap: 16px; font: 700 12px/1.2 ui-monospace, monospace; letter-spacing: .12em; text-transform: uppercase; }
        nav a { text-decoration: none; opacity: .76; }
        nav a:hover { opacity: 1; }
        .signal { display: flex; gap: 5px; align-items: end; height: 18px; }
        .signal i { width: 4px; background: var(--mint); border-radius: 4px; animation: blink 1.8s ease-in-out infinite; }
        .signal i:nth-child(1) { height: 6px; }
        .signal i:nth-child(2) { height: 11px; animation-delay: .18s; }
        .signal i:nth-child(3) { height: 17px; animation-delay: .36s; }
        @keyframes blink { 50% { opacity: .35; } }
        header { display: grid; grid-template-columns: 1.1fr .9fr; align-items: end; gap: 40px; padding: clamp(52px, 8vw, 96px) 0 36px; }
        .eyebrow { margin: 0 0 15px; color: var(--mint); font: 700 12px/1.2 ui-monospace, monospace; letter-spacing: .18em; text-transform: uppercase; }
        h1 { margin: 0; max-width: 800px; font-size: clamp(54px, 9vw, 118px); line-height: .79; font-weight: 400; letter-spacing: -.065em; }
        h1 em { display: block; color: var(--orange); font-style: italic; transform: translateX(clamp(12px, 5vw, 64px)); }
        .intro { max-width: 420px; margin: 0 0 4px; font-size: clamp(17px, 2vw, 22px); line-height: 1.5; color: #c8d3cf; }
        .intro strong { color: var(--paper); font-weight: 400; border-bottom: 1px solid var(--orange); }
        .cabinet { position: relative; border: 1px solid rgba(246,232,202,.2); background: #061522; box-shadow: 0 34px 90px rgba(0,0,0,.42); overflow: hidden; }
        .cabinet::before { content: "RELAY BOARD / 05-24"; position: absolute; top: 12px; left: 16px; z-index: 3; color: white; font: 700 10px ui-monospace, monospace; letter-spacing: .14em; text-shadow: 0 1px 8px #000; }
        .map-wrap { position: relative; aspect-ratio: 3/2; overflow: hidden; }
        .map-wrap::after { content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,.08), transparent 58%, rgba(2,14,23,.52)); pointer-events: none; }
        .map { width: 100%; height: 100%; display: block; object-fit: cover; }
        .pulse { position: absolute; left: 50%; top: 50%; width: 12%; aspect-ratio: 1; transform: translate(-50%,-50%); border: 2px solid var(--gold); border-radius: 50%; opacity: 0; pointer-events: none; }
        .pulse.go { animation: pulse 1.2s ease-out; }
        @keyframes pulse { 0% { opacity: .9; scale: .4; } 100% { opacity: 0; scale: 4; } }
        .station {
            position: absolute;
            z-index: 4;
            display: grid;
            place-items: center;
            width: clamp(46px, 7vw, 86px);
            aspect-ratio: 1;
            border: 1px solid rgba(255,255,255,.65);
            border-radius: 50%;
            color: var(--paper);
            background: rgba(5,22,34,.84);
            box-shadow: 0 0 0 6px rgba(5,22,34,.32), 0 8px 28px rgba(0,0,0,.5);
            cursor: pointer;
            transition: transform .18s, background .18s, box-shadow .18s;
            -webkit-tap-highlight-color: transparent;
        }
        .station:hover, .station:focus-visible { transform: scale(1.09); background: #153c4e; outline: none; box-shadow: 0 0 0 6px rgba(140,224,193,.25), 0 8px 28px #000; }
        .station span { font: 800 clamp(9px, 1vw, 12px)/1 ui-monospace, monospace; text-transform: uppercase; }
        .station b { display: block; font-size: clamp(18px, 2.6vw, 30px); line-height: .8; }
        .station.selected { background: var(--orange); color: #1d1e22; border-color: var(--gold); }
        [data-station="phone"] { left: 20%; top: 36%; }
        [data-station="icloud"] { left: 65%; top: 19%; }
        [data-station="mac"] { left: 24%; top: 70%; }
        [data-station="drive"] { left: 77%; top: 62%; }
        .console { display: grid; grid-template-columns: .82fr 1.18fr; min-height: 330px; border-top: 1px solid rgba(246,232,202,.18); }
        .mission-side { padding: clamp(22px, 4vw, 42px); background: var(--paper); color: var(--ink); }
        .number { display: flex; justify-content: space-between; font: 700 11px ui-monospace, monospace; letter-spacing: .12em; text-transform: uppercase; color: #667478; }
        .mission-side h2 { margin: 38px 0 12px; font-size: clamp(31px, 4vw, 50px); line-height: .95; font-weight: 400; letter-spacing: -.04em; }
        #missionText { margin: 0; min-height: 92px; color: #4b5b5e; font-size: 17px; line-height: 1.5; }
        .work-side { padding: clamp(22px, 4vw, 42px); display: flex; flex-direction: column; justify-content: space-between; background: linear-gradient(135deg, rgba(16,56,72,.72), rgba(5,21,34,.92)); }
        .label { margin: 0 0 12px; color: var(--blue); font: 700 10px ui-monospace, monospace; letter-spacing: .16em; text-transform: uppercase; }
        .route { min-height: 64px; display: flex; flex-wrap: wrap; align-items: center; gap: 8px; }
        .route-empty { opacity: .48; font-style: italic; }
        .chip { display: inline-flex; align-items: center; gap: 8px; padding: 10px 13px; border: 1px solid rgba(246,232,202,.27); background: rgba(255,255,255,.07); font: 700 11px ui-monospace, monospace; text-transform: uppercase; letter-spacing: .08em; animation: pop .25s ease-out both; }
        .chip::after { content: "→"; color: var(--orange); margin-left: 5px; }
        .chip:last-child::after { display: none; }
        @keyframes pop { from { opacity: 0; transform: translateY(6px); } }
        .feedback { min-height: 48px; margin: 18px 0; color: #bfcfcc; font-size: 15px; line-height: 1.45; }
        .feedback.good { color: var(--mint); }
        .feedback.bad { color: #ffaf95; }
        .controls { display: flex; flex-wrap: wrap; gap: 10px; }
        .btn { border: 0; padding: 13px 18px; cursor: pointer; font: 800 11px ui-monospace, monospace; letter-spacing: .1em; text-transform: uppercase; transition: transform .15s, filter .15s; }
        .btn:hover { transform: translateY(-2px); filter: brightness(1.07); }
        .btn.primary { background: var(--orange); color: #182127; }
        .btn.ghost { color: var(--paper); background: transparent; border: 1px solid rgba(246,232,202,.34); }
        .progress { display: grid; grid-template-columns: repeat(5,1fr); gap: 6px; margin-top: 25px; }
        .progress i { height: 5px; background: rgba(246,232,202,.13); }
        .progress i.done { background: var(--mint); }
        .progress i.current { background: var(--orange); }
        .lesson { display: grid; grid-template-columns: .9fr 1.1fr; gap: clamp(28px, 8vw, 100px); align-items: start; padding: clamp(62px, 10vw, 120px) 0; }
        .lesson h2 { margin: 0; font-size: clamp(43px, 7vw, 82px); line-height: .9; font-weight: 400; letter-spacing: -.055em; }
        .lesson h2 span { color: var(--mint); font-style: italic; }
        .notes { border-top: 1px solid rgba(246,232,202,.25); }
        .note { display: grid; grid-template-columns: 42px 1fr; gap: 18px; padding: 22px 0; border-bottom: 1px solid rgba(246,232,202,.18); }
        .note b { display: grid; place-items: center; width: 34px; height: 34px; border: 1px solid var(--rose); border-radius: 50%; color: var(--rose); font: 800 12px ui-monospace, monospace; }
        .note h3 { margin: 0 0 6px; font-size: 18px; font-weight: 400; }
        .note p { margin: 0; color: #aebeba; line-height: 1.5; }
        footer { display: flex; justify-content: space-between; gap: 20px; padding-top: 30px; border-top: 1px solid rgba(246,232,202,.2); color: #9dafaa; font-size: 14px; line-height: 1.5; }
        footer a { color: var(--paper); text-underline-offset: 4px; }
        .stamp { flex: 0 0 auto; border: 1px solid var(--orange); padding: 9px 12px; color: var(--orange); font: 800 10px ui-monospace, monospace; letter-spacing: .12em; text-transform: uppercase; transform: rotate(-2deg); }
        .complete-card { display: none; position: absolute; inset: 0; z-index: 10; place-items: center; padding: 30px; background: rgba(5,19,30,.92); backdrop-filter: blur(10px); text-align: center; }
        .complete-card.show { display: grid; animation: fade .5s ease-out; }
        .complete-card h2 { margin: 0 0 10px; max-width: 650px; font-size: clamp(42px, 7vw, 78px); line-height: .9; font-weight: 400; }
        .complete-card p { max-width: 520px; margin: 0 auto 25px; color: #bcd0cb; line-height: 1.6; }
        @keyframes fade { from { opacity: 0; } }
        @media (max-width: 760px) {
            header, .console, .lesson { grid-template-columns: 1fr; }
            header { align-items: start; gap: 25px; }
            h1 { font-size: clamp(58px, 19vw, 94px); }
            .console { min-height: 0; }
            .mission-side h2 { margin-top: 26px; }
            #missionText { min-height: 0; }
            .lesson { gap: 38px; }
            footer { flex-direction: column; }
            .stamp { align-self: flex-start; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; } }
    </style>
</head>
<body>
<div class="shell">
    <nav>
        <a href="index.php">← Chloe Reads Jon</a>
        <span class="signal" aria-label="Relay signal online"><i></i><i></i><i></i></span>
    </nav>

    <header>
        <div>
            <p class="eyebrow">A needlessly ingenious sync puzzle</p>
            <h1>Three-Cloud <em>Relay</em></h1>
        </div>
        <p class="intro">Route one humble <strong>.md file</strong> through a pocket editor, two clouds, and a Mac. It sounds absurd. It also works.</p>
    </header>

    <main class="cabinet" id="game">
        <div class="map-wrap">
            <img class="map" src="three-cloud-relay-map.png" alt="Papercraft map of a phone, Mac, and two cloud archives connected by glowing document rails">
            <div class="pulse" id="pulse"></div>
            <button class="station" data-station="phone" aria-label="Add Pocket editor to route"><b>▣</b><span>Pocket</span></button>
            <button class="station" data-station="icloud" aria-label="Add iCloud to route"><b>☁</b><span>iCloud</span></button>
            <button class="station" data-station="mac" aria-label="Add Mac relay to route"><b>⌘</b><span>Mac</span></button>
            <button class="station" data-station="drive" aria-label="Add Google Drive to route"><b>◆</b><span>Drive</span></button>
            <section class="complete-card" id="complete">
                <div>
                    <p class="eyebrow">All packets accounted for</p>
                    <h2>Certified Cloud Cartographer</h2>
                    <p>You navigated a workaround that resembles a tiny postal system run by four overqualified computers. Your Markdown survived.</p>
                    <button class="btn primary" id="replay">Replay relay</button>
                </div>
            </section>
        </div>

        <section class="console">
            <div class="mission-side">
                <div class="number"><span id="missionNo">Dispatch 01 / 05</span><span id="score">0 clean</span></div>
                <h2 id="missionTitle">Pocket revision</h2>
                <p id="missionText">Jon edits a Markdown note on his iPhone. Route the fresh copy all the way to the archive Gemini can query.</p>
                <div class="progress" id="progress" aria-label="Mission progress"></div>
            </div>
            <div class="work-side">
                <div>
                    <p class="label">Tap the stations in travel order</p>
                    <div class="route" id="route"><span class="route-empty">No stations patched in yet.</span></div>
                    <p class="feedback" id="feedback" aria-live="polite">The relay lamps are warm. Build your route.</p>
                </div>
                <div class="controls">
                    <button class="btn primary" id="dispatch">Dispatch file</button>
                    <button class="btn ghost" id="undo">Undo last</button>
                    <button class="btn ghost" id="hint">Open hint</button>
                </div>
            </div>
        </section>
    </main>

    <section class="lesson">
        <h2>Why the <span>detour?</span></h2>
        <div class="notes">
            <article class="note"><b>01</b><div><h3>iOS editors reach iCloud cleanly</h3><p>The editable folder begins in iCloud Drive, where Runestone, Obsidian, and similar apps can save normally.</p></div></article>
            <article class="note"><b>02</b><div><h3>The Mac becomes a bridge</h3><p>The same local folder is also watched by Google Drive. One directory, two synchronizers, one mildly daring arrangement.</p></div></article>
            <article class="note"><b>03</b><div><h3>Google Drive gives AI access</h3><p>Once the Markdown arrives there, Gemini can query the notes. “Keep Downloaded” helps prevent the bridge from becoming imaginary.</p></div></article>
        </div>
    </section>

    <footer>
        <div>Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener">How to edit markdown files on Google Drive on iOS and Mac</a>.</div>
        <div class="stamp">Built around the long way</div>
    </footer>
</div>

<script>
(() => {
    const names = { phone: 'Pocket editor', icloud: 'iCloud', mac: 'Mac relay', drive: 'Google Drive' };
    const missions = [
        { title: 'Pocket revision', text: 'Jon edits a Markdown note on his iPhone. Route the fresh copy all the way to the archive Gemini can query.', answer: ['phone','icloud','mac','drive'], hint: 'Start where the note is edited. The Mac is the only bridge between the two clouds.' },
        { title: 'Desk-side thought', text: 'A new paragraph is written directly on the Mac. Send it to the pocket library so it is ready for the next walk.', answer: ['mac','icloud','phone'], hint: 'The phone’s editor sees the iCloud copy, not the Mac directly.' },
        { title: 'Ask the archive', text: 'The latest note already rests in iCloud. Route it to the cloud where Gemini can inspect the Markdown.', answer: ['icloud','mac','drive'], hint: 'The two clouds only shake hands through the locally downloaded folder.' },
        { title: 'Airplane edit', text: 'The phone was offline. Now the signal has returned. Carry its changed note to the Mac, stopping before the second cloud.', answer: ['phone','icloud','mac'], hint: 'The pocket editor saves into its native cloud first.' },
        { title: 'Keep it downloaded', text: 'The Mac has restored the bridge folder locally. Prove both editing ends can reach each other from Google Drive.', answer: ['drive','mac','icloud','phone'], hint: 'Reverse the whole relay: cloud archive, local bridge, native cloud, pocket editor.' }
    ];

    let index = 0;
    let route = [];
    let clean = 0;
    const $ = id => document.getElementById(id);
    const stationButtons = [...document.querySelectorAll('.station')];

    function draw() {
        const m = missions[index];
        $('missionNo').textContent = `Dispatch ${String(index + 1).padStart(2, '0')} / ${String(missions.length).padStart(2, '0')}`;
        $('score').textContent = `${clean} clean`;
        $('missionTitle').textContent = m.title;
        $('missionText').textContent = m.text;
        $('feedback').className = 'feedback';
        $('feedback').textContent = 'The relay lamps are warm. Build your route.';
        $('route').innerHTML = route.length ? route.map(x => `<span class="chip">${names[x]}</span>`).join('') : '<span class="route-empty">No stations patched in yet.</span>';
        stationButtons.forEach(b => b.classList.toggle('selected', route.includes(b.dataset.station)));
        $('progress').innerHTML = missions.map((_, i) => `<i class="${i < index ? 'done' : i === index ? 'current' : ''}"></i>`).join('');
    }

    function addStation(id) {
        if (route.includes(id)) {
            $('feedback').className = 'feedback bad';
            $('feedback').textContent = `${names[id]} is already patched in. No sync loops on my watch.`;
            return;
        }
        route.push(id);
        $('route').innerHTML = route.map(x => `<span class="chip">${names[x]}</span>`).join('');
        stationButtons.find(b => b.dataset.station === id).classList.add('selected');
        $('feedback').className = 'feedback';
        $('feedback').textContent = route.length === 1 ? 'Origin locked. Where does the file travel next?' : 'Cable seated. Keep routing.';
    }

    stationButtons.forEach(b => b.addEventListener('click', () => addStation(b.dataset.station)));
    $('undo').addEventListener('click', () => { route.pop(); draw(); });
    $('hint').addEventListener('click', () => {
        $('feedback').className = 'feedback';
        $('feedback').textContent = 'Hint: ' + missions[index].hint;
    });
    $('dispatch').addEventListener('click', () => {
        const answer = missions[index].answer;
        const correct = route.length === answer.length && route.every((x, i) => x === answer[i]);
        if (!correct) {
            $('feedback').className = 'feedback bad';
            const matched = route.filter((x, i) => answer[i] === x).length;
            $('feedback').textContent = matched ? `Packet stalled after ${matched} correct station${matched === 1 ? '' : 's'}. Undo and reroute.` : 'That origin cannot satisfy this dispatch. Trace where the edit actually begins.';
            return;
        }
        clean++;
        $('score').textContent = `${clean} clean`;
        $('feedback').className = 'feedback good';
        $('feedback').textContent = 'Clean arrival. No conflict copies, no stale ghosts.';
        $('pulse').classList.remove('go');
        void $('pulse').offsetWidth;
        $('pulse').classList.add('go');
        setTimeout(() => {
            index++;
            route = [];
            if (index >= missions.length) {
                localStorage.setItem('threeCloudRelayComplete', new Date().toISOString());
                $('complete').classList.add('show');
            } else draw();
        }, 950);
    });
    $('replay').addEventListener('click', () => { index = 0; route = []; clean = 0; $('complete').classList.remove('show'); draw(); });
    draw();
})();
</script>
</body>
</html>
