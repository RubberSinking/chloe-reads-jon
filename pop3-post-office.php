<?php
$mail = [
    ['from' => 'Nathan', 'subject' => 'Important KITT dashboard finding', 'stamp' => 'priority', 'body' => 'The red scanner should absolutely make the whoosh sound. This concludes the research.'],
    ['from' => 'Parish bulletin', 'subject' => 'Sunday: coffee after Mass', 'stamp' => 'local', 'body' => 'Coffee, cookies, and several conversations that begin beside the coat rack.'],
    ['from' => 'Past Jon', 'subject' => 'A small idea worth keeping', 'stamp' => 'archive', 'body' => 'Technology is at its best when usefulness arrives with a little delight.'],
    ['from' => 'Definitely Legitimate Prince', 'subject' => 'URGENT: eleven million dollars', 'stamp' => 'suspect', 'body' => 'Kindly send three passwords and one ceremonial fax at your earliest convenience.'],
    ['from' => 'Mysterious librarian', 'subject' => 'Your reserved book has arrived', 'stamp' => 'quiet', 'body' => 'It is waiting under the green lamp. Please bring curiosity and your library card.'],
    ['from' => 'Robot parts depot', 'subject' => 'Your parcel is doing its best', 'stamp' => 'parcel', 'body' => 'It has crossed Richmond and now appears to be contemplating Surrey.'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#173c35">
<title>The POP3 Post Office</title>
<style>
    :root {
        --ink: #173c35;
        --ink-soft: #315950;
        --paper: #f4e8c9;
        --paper-light: #fff8e7;
        --red: #c63f35;
        --yellow: #e7b94b;
        --blue: #579ba1;
        --counter: #7b4b31;
        --shadow: #102d28;
    }
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
        margin: 0;
        min-height: 100vh;
        color: var(--ink);
        font-family: Georgia, 'Times New Roman', serif;
        background:
            radial-gradient(circle at 18% 12%, rgba(255,255,255,.08) 0 1px, transparent 2px),
            linear-gradient(135deg, rgba(255,255,255,.025) 25%, transparent 25%) 0 0 / 18px 18px,
            #173c35;
    }
    button, input { font: inherit; }
    button { touch-action: manipulation; }
    .skip {
        position: absolute; left: -9999px; top: 8px; z-index: 10;
        padding: 8px 12px; background: white; color: var(--ink);
    }
    .skip:focus { left: 8px; }
    .page {
        width: min(1180px, calc(100% - 28px));
        margin: 0 auto;
        padding: 24px 0 58px;
    }
    .masthead {
        position: relative;
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: end;
        gap: 24px;
        padding: 26px 30px 24px;
        overflow: hidden;
        color: var(--paper-light);
        border: 1px solid rgba(255,255,255,.22);
        border-bottom: 5px solid var(--yellow);
        background: rgba(11, 48, 41, .82);
        box-shadow: 0 18px 40px rgba(0,0,0,.24);
    }
    .masthead::after {
        content: 'AIR MAIL  /  AIR MAIL  /  AIR MAIL  /  AIR MAIL';
        position: absolute; right: -55px; top: 18px;
        width: 310px; transform: rotate(34deg);
        color: rgba(255,255,255,.18); font: 700 10px/1 'Courier New', monospace;
        letter-spacing: 3px;
    }
    .eyebrow {
        margin: 0 0 8px;
        color: #f2cf72;
        font: 700 11px/1.2 'Courier New', monospace;
        letter-spacing: .24em;
        text-transform: uppercase;
    }
    h1 {
        margin: 0;
        max-width: 780px;
        font-family: Rockwell, 'Roboto Slab', Georgia, serif;
        font-size: clamp(2.25rem, 7vw, 5.8rem);
        line-height: .86;
        letter-spacing: -.065em;
        text-wrap: balance;
    }
    .masthead-copy { max-width: 650px; margin: 18px 0 0; color: #cddfd8; line-height: 1.55; }
    .postmark {
        position: relative;
        display: grid; place-items: center;
        width: 145px; aspect-ratio: 1;
        border: 3px double #e6c66f;
        border-radius: 50%;
        color: #e6c66f;
        font: 700 12px/1.35 'Courier New', monospace;
        text-align: center;
        transform: rotate(-8deg);
    }
    .postmark::before, .postmark::after {
        content: ''; position: absolute; width: 174px; height: 2px;
        background: #e6c66f; opacity: .7; right: 75%;
    }
    .postmark::before { top: 50px; }
    .postmark::after { top: 74px; }
    .counter {
        position: relative;
        margin: 24px 0 0;
        padding: 22px;
        background:
            linear-gradient(90deg, rgba(255,255,255,.06), transparent 12%, rgba(0,0,0,.05) 45%, transparent 70%),
            var(--counter);
        border-radius: 4px;
        box-shadow: 0 28px 55px rgba(0,0,0,.3), inset 0 1px rgba(255,255,255,.17);
    }
    .counter::before {
        content: ''; position: absolute; inset: 9px;
        border: 1px solid rgba(255,255,255,.16); pointer-events: none;
    }
    .machine {
        position: relative;
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(285px, .75fr);
        min-height: 580px;
        border: 2px solid #a99a75;
        border-radius: 16px 16px 5px 5px;
        overflow: hidden;
        background: var(--paper);
        box-shadow: inset 0 0 0 6px #d3c6a5, inset 0 0 50px rgba(74,55,31,.14);
    }
    .terminal-side { padding: clamp(20px, 4vw, 44px); border-right: 1px dashed #a99871; }
    .machine-label {
        display: flex; justify-content: space-between; gap: 18px; align-items: center;
        margin-bottom: 24px;
    }
    .machine-label h2 { margin: 0; font: 700 clamp(1.35rem, 3vw, 2rem)/1 Rockwell, Georgia, serif; }
    .model { font: 700 10px/1.3 'Courier New', monospace; letter-spacing: .13em; text-align: right; }
    .screen-shell {
        padding: 13px;
        border: 3px solid #443c30;
        border-radius: 21px 21px 12px 12px;
        background: #5e5547;
        box-shadow: 0 9px 0 #3d362c, 0 15px 22px rgba(0,0,0,.2);
    }
    .screen {
        position: relative;
        min-height: 300px;
        padding: 22px;
        overflow: hidden;
        border: 2px solid #182a22;
        border-radius: 38px / 22px;
        color: #bde995;
        background: #12271f;
        box-shadow: inset 0 0 36px #020a07;
        font: 14px/1.6 'Courier New', monospace;
        text-shadow: 0 0 7px rgba(184,244,146,.55);
    }
    .screen::after {
        content: ''; position: absolute; inset: 0; pointer-events: none;
        background: repeating-linear-gradient(0deg, transparent 0 3px, rgba(0,0,0,.19) 4px);
        mix-blend-mode: multiply;
    }
    #transcript { position: relative; z-index: 1; white-space: pre-wrap; }
    .cursor { display: inline-block; width: 8px; height: 15px; vertical-align: -2px; background: #bde995; animation: blink .85s steps(1) infinite; }
    @keyframes blink { 50% { opacity: 0; } }
    .controls {
        display: grid; grid-template-columns: minmax(0, 1fr) auto;
        gap: 12px; align-items: end; margin-top: 26px;
    }
    label { display: block; margin-bottom: 7px; font: 700 10px/1 'Courier New', monospace; letter-spacing: .12em; text-transform: uppercase; }
    input {
        width: 100%; min-height: 48px;
        padding: 10px 13px;
        border: 2px solid var(--ink);
        border-radius: 2px;
        color: var(--ink); background: #fffaf0;
        outline: none;
    }
    input:focus { box-shadow: 0 0 0 4px rgba(87,155,161,.3); }
    .crank {
        min-width: 176px; min-height: 50px;
        border: 0; border-bottom: 5px solid #77251e;
        border-radius: 4px;
        color: white; background: var(--red);
        font: 700 12px/1 'Courier New', monospace;
        letter-spacing: .09em; text-transform: uppercase;
        cursor: pointer;
        transition: transform .12s, border-width .12s;
    }
    .crank:hover { background: #d54b40; }
    .crank:active { transform: translateY(3px); border-bottom-width: 2px; }
    .crank:disabled { background: #867b69; border-color: #554e43; cursor: wait; }
    .steps { padding: clamp(20px, 4vw, 38px); background: rgba(255,248,231,.62); }
    .steps h3 { margin: 0 0 5px; font: 700 1.05rem/1.2 Rockwell, Georgia, serif; }
    .steps-intro { margin: 0 0 25px; color: #6c624d; font-size: .92rem; }
    .route { list-style: none; margin: 0; padding: 0; counter-reset: route; }
    .route li {
        position: relative; min-height: 67px;
        padding: 4px 0 20px 55px;
        color: #776b52;
        transition: color .35s, transform .35s;
    }
    .route li::before {
        counter-increment: route; content: counter(route);
        position: absolute; left: 0; top: 0;
        display: grid; place-items: center;
        width: 37px; aspect-ratio: 1;
        border: 2px solid #a99a75; border-radius: 50%;
        font: 700 13px/1 'Courier New', monospace;
        background: var(--paper-light);
    }
    .route li:not(:last-child)::after {
        content: ''; position: absolute; left: 18px; top: 39px; bottom: 2px;
        border-left: 2px dotted #b4a784;
    }
    .route li.active { color: var(--ink); transform: translateX(3px); }
    .route li.active::before { color: white; border-color: var(--red); background: var(--red); box-shadow: 0 0 0 4px rgba(198,63,53,.13); }
    .route strong { display: block; margin-bottom: 3px; font-family: 'Courier New', monospace; font-size: .9rem; }
    .route span { font-size: .82rem; line-height: 1.35; }
    .lesson {
        margin-top: 18px; padding: 15px;
        border: 1px solid #bdad87; background: rgba(255,255,255,.42);
        font-size: .82rem; line-height: 1.5;
    }
    .sort-floor {
        margin-top: 28px;
        padding: clamp(24px, 5vw, 54px);
        color: var(--ink);
        background: var(--paper-light);
        border: 2px solid #b9a67e;
        box-shadow: 0 18px 50px rgba(0,0,0,.25);
    }
    .sort-header { display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: end; }
    .sort-header h2 { margin: 0; font: 700 clamp(2rem, 6vw, 4.7rem)/.92 Rockwell, Georgia, serif; letter-spacing: -.055em; }
    .sort-header p { max-width: 580px; margin: 13px 0 0; line-height: 1.55; color: var(--ink-soft); }
    .scoreboard {
        min-width: 210px; padding: 13px 16px;
        border: 2px solid var(--ink); background: var(--yellow);
        font: 700 13px/1.5 'Courier New', monospace;
        transform: rotate(1deg);
    }
    .belt {
        position: relative;
        display: grid; place-items: center;
        min-height: 360px;
        margin-top: 32px;
        overflow: hidden;
        border-top: 12px solid #4e4b43;
        border-bottom: 12px solid #4e4b43;
        background:
            repeating-linear-gradient(90deg, #77756b 0 8px, #525149 8px 16px) 0 0 / 32px 100%;
    }
    .belt::before, .belt::after {
        content: ''; position: absolute; width: 82px; aspect-ratio: 1; border: 10px solid #393832; border-radius: 50%; background: #89867b;
    }
    .belt::before { left: -38px; } .belt::after { right: -38px; }
    .envelope {
        position: relative; z-index: 2;
        width: min(500px, calc(100% - 38px)); min-height: 235px;
        padding: 27px 30px 62px;
        border: 1px solid #baaa83;
        color: #29271f;
        background:
            linear-gradient(30deg, transparent 49.5%, #d8c99f 50%, transparent 50.5%) 0 100% / 50% 62% no-repeat,
            linear-gradient(-30deg, transparent 49.5%, #d8c99f 50%, transparent 50.5%) 100% 100% / 50% 62% no-repeat,
            #f8edcf;
        box-shadow: 0 16px 20px rgba(0,0,0,.28);
        transform: rotate(-1deg);
        transition: transform .35s, opacity .35s;
    }
    .envelope.arrive { animation: arrive .55s cubic-bezier(.22,.8,.25,1.25); }
    .envelope.exit-left { transform: translateX(-130%) rotate(-12deg); opacity: 0; }
    .envelope.exit-down { transform: translateY(130%) rotate(7deg); opacity: 0; }
    .envelope.exit-right { transform: translateX(130%) rotate(12deg); opacity: 0; }
    @keyframes arrive { from { transform: translateX(-120%) rotate(-8deg); } }
    .stamp {
        position: absolute; right: 22px; top: 18px;
        padding: 10px 8px; border: 3px dotted var(--red);
        color: var(--red); font: 700 9px/1 'Courier New', monospace;
        letter-spacing: .1em; text-transform: uppercase;
    }
    .from { margin-bottom: 26px; color: #695f4b; font: 700 11px/1 'Courier New', monospace; text-transform: uppercase; letter-spacing: .1em; }
    .subject { max-width: 76%; margin: 0 0 12px; font: 700 clamp(1.25rem, 4vw, 2rem)/1.05 Rockwell, Georgia, serif; }
    .body-copy { max-width: 80%; margin: 0; line-height: 1.48; }
    .sort-buttons { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-top: 18px; }
    .sort-button {
        min-height: 62px; padding: 10px;
        border: 2px solid var(--ink); color: var(--ink); background: transparent;
        font: 700 12px/1.25 'Courier New', monospace;
        text-transform: uppercase; letter-spacing: .08em; cursor: pointer;
        transition: transform .15s, box-shadow .15s, background .15s;
    }
    .sort-button:hover, .sort-button:focus-visible { transform: translateY(-3px); box-shadow: 0 5px 0 var(--ink); outline: none; }
    .sort-button[data-action="keep"] { background: #a8cdb6; }
    .sort-button[data-action="later"] { background: #efd27e; }
    .sort-button[data-action="junk"] { background: #e89989; }
    .receipt {
        display: none; max-width: 620px; margin: 28px auto 0; padding: 28px;
        border: 1px dashed #80755e; background: #f7f1df;
        font: 14px/1.7 'Courier New', monospace; text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,.08);
    }
    .receipt.show { display: block; animation: receipt .55s ease-out; }
    @keyframes receipt { from { opacity: 0; transform: translateY(-20px); } }
    .receipt strong { display: block; font-size: 1.35rem; }
    .replay { border: 0; border-bottom: 1px solid; color: var(--ink); background: none; cursor: pointer; font-weight: bold; }
    footer {
        display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center;
        padding: 34px 4px 0; color: #c9dbd3; line-height: 1.55;
    }
    footer a { color: #f2cf72; text-underline-offset: 4px; }
    .back { font: 700 11px/1 'Courier New', monospace; letter-spacing: .08em; text-transform: uppercase; }
    @media (max-width: 780px) {
        .masthead { grid-template-columns: 1fr; }
        .postmark { display: none; }
        .machine { grid-template-columns: 1fr; }
        .terminal-side { border-right: 0; border-bottom: 1px dashed #a99871; }
        .controls { grid-template-columns: 1fr; }
        .crank { width: 100%; }
        .sort-header { grid-template-columns: 1fr; }
        .scoreboard { width: 100%; }
        footer { grid-template-columns: 1fr; }
    }
    @media (max-width: 520px) {
        .page { width: min(100% - 16px, 1180px); padding-top: 8px; }
        .masthead { padding: 22px 18px; }
        .counter { padding: 9px; }
        .machine { border-radius: 10px 10px 3px 3px; }
        .terminal-side, .steps { padding: 20px 15px 28px; }
        .screen { min-height: 340px; padding: 17px 14px; font-size: 12px; }
        .sort-floor { padding: 26px 14px; }
        .belt { min-height: 350px; }
        .envelope { min-height: 250px; padding: 25px 20px 65px; }
        .subject, .body-copy { max-width: 100%; }
        .subject { padding-right: 58px; }
        .sort-buttons { gap: 6px; }
        .sort-button { min-height: 68px; padding: 7px 3px; font-size: 10px; }
    }
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; scroll-behavior: auto !important; transition-duration: .01ms !important; }
    }
</style>
</head>
<body>
<a class="skip" href="#machine">Skip to the machine</a>
<main class="page">
    <header class="masthead">
        <div>
            <p class="eyebrow">Department of Cheerful Protocols · Est. 1988</p>
            <h1>The POP3<br>Post Office</h1>
            <p class="masthead-copy">Turn the crank and watch an old-fashioned mail client fetch its letters, one plain-English command at a time. Then take the sorting desk before the belt gets ideas.</p>
        </div>
        <div class="postmark" aria-hidden="true">LOCAL MAIL<br>2004<br>11 NOV<br>DELIGHT<br>GUARANTEED</div>
    </header>

    <section class="counter" id="machine" aria-labelledby="machine-title">
        <div class="machine">
            <div class="terminal-side">
                <div class="machine-label">
                    <h2 id="machine-title">Mail Retrieval Engine</h2>
                    <div class="model">MODEL POP/3<br>SERIAL 1104-JA</div>
                </div>
                <div class="screen-shell">
                    <div class="screen" role="log" aria-live="polite">
                        <div id="transcript">POST OFFICE PROTOCOL TERMINAL
--------------------------------
Ready. Enter a mailbox name and turn the crank.

No cloud. No magic. Just a courteous conversation.
<span class="cursor"></span></div>
                    </div>
                </div>
                <div class="controls">
                    <div>
                        <label for="mailbox">Mailbox name</label>
                        <input id="mailbox" value="jon" maxlength="18" autocomplete="off" spellcheck="false">
                    </div>
                    <button class="crank" id="crank">Turn the crank</button>
                </div>
            </div>
            <aside class="steps">
                <h3>What the machine is doing</h3>
                <p class="steps-intro">POP3 is less like telepathy and more like a very tidy visit to a post-office counter.</p>
                <ol class="route" id="route">
                    <li><strong>CONNECT</strong><span>The client opens a secure line to the mail server.</span></li>
                    <li><strong>IDENTIFY</strong><span>It says which mailbox it has come to collect.</span></li>
                    <li><strong>COUNT</strong><span>The server reports how many letters are waiting.</span></li>
                    <li><strong>RETRIEVE</strong><span>Each complete message is copied down to the device.</span></li>
                    <li><strong>SIGN OFF</strong><span>The session closes. The mail can now be read offline.</span></li>
                </ol>
                <div class="lesson"><strong>Why 2004 cared:</strong> free POP access meant Gmail could deliver messages into a favourite desktop app, where they remained useful even after the internet connection had gone for tea.</div>
            </aside>
        </div>
    </section>

    <section class="sort-floor" id="sorting" aria-labelledby="sort-title">
        <div class="sort-header">
            <div>
                <h2 id="sort-title">The Sorting Floor</h2>
                <p>The mail has made it safely to your computer. Give each letter a home. There are no wrong answers, but the postmaster has been known to form opinions.</p>
            </div>
            <div class="scoreboard" aria-live="polite"><span id="count">LETTER 1 / <?= count($mail) ?></span><br><span id="totals">KEEP 0 · LATER 0 · JUNK 0</span></div>
        </div>
        <div class="belt">
            <article class="envelope" id="envelope">
                <span class="stamp" id="stamp"></span>
                <div class="from" id="from"></div>
                <h3 class="subject" id="subject"></h3>
                <p class="body-copy" id="bodyCopy"></p>
            </article>
        </div>
        <div class="sort-buttons" id="sortButtons">
            <button class="sort-button" data-action="keep">← Keep close</button>
            <button class="sort-button" data-action="later">↓ Read later</button>
            <button class="sort-button" data-action="junk">Junk it →</button>
        </div>
        <div class="receipt" id="receipt" aria-live="polite"></div>
    </section>

    <footer>
        <div>Inspired by Jon's <a href="https://jona.ca/2004/11/gmail-offers-free-pops-cnet-newscom.html" target="_blank" rel="noopener">“Gmail offers free POPs”</a>, a five-word review of technology that simply delighted people.</div>
        <a class="back" href="index.php">← Chloe Reads Jon</a>
    </footer>
</main>
<script>
const letters = <?= json_encode($mail, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
const transcript = document.getElementById('transcript');
const crank = document.getElementById('crank');
const mailbox = document.getElementById('mailbox');
const routeSteps = [...document.querySelectorAll('#route li')];
let running = false;

const wait = ms => new Promise(resolve => setTimeout(resolve, ms));
const safeName = () => (mailbox.value.trim() || 'jon').replace(/[^a-z0-9_.-]/gi, '').slice(0, 18) || 'jon';

async function fetchMail() {
    if (running) return;
    running = true;
    crank.disabled = true;
    crank.textContent = 'Cranking…';
    routeSteps.forEach(step => step.classList.remove('active'));
    const name = safeName();
    transcript.textContent = 'POST OFFICE PROTOCOL TERMINAL\n--------------------------------\n';
    const lines = [
        ['C: CONNECT mailroom:995 (secure)', 'S: +OK Post Office ready', 0],
        [`C: USER ${name}`, `S: +OK Hello, ${name}. Mind the parcels.`, 1],
        ['C: PASS ••••••••••••', 'S: +OK Brass key accepted', 1],
        [`C: STAT`, `S: +OK ${letters.length} messages, 4.2 delightful kilobytes`, 2],
        ['C: RETR 1…6', 'S: +OK Copying complete messages to this machine', 3],
        ['C: QUIT', 'S: +OK Mind how you go', 4],
        ['', `${letters.length} LETTERS DELIVERED TO THE SORTING FLOOR.`, 4]
    ];
    for (const [client, server, step] of lines) {
        routeSteps.forEach((item, index) => item.classList.toggle('active', index === step));
        transcript.textContent += `\n${client}\n`;
        await wait(320);
        transcript.textContent += `${server}\n`;
        await wait(430);
    }
    transcript.innerHTML += '\n<span class="cursor"></span>';
    running = false;
    crank.disabled = false;
    crank.textContent = 'Fetch them again';
    document.getElementById('sorting').scrollIntoView({behavior: 'smooth', block: 'start'});
}
crank.addEventListener('click', fetchMail);
mailbox.addEventListener('keydown', event => { if (event.key === 'Enter') fetchMail(); });

let current = 0;
let score = {keep: 0, later: 0, junk: 0};
const envelope = document.getElementById('envelope');
const sortButtons = document.getElementById('sortButtons');
const receipt = document.getElementById('receipt');

function renderLetter() {
    const letter = letters[current];
    document.getElementById('stamp').textContent = letter.stamp;
    document.getElementById('from').textContent = `From: ${letter.from}`;
    document.getElementById('subject').textContent = letter.subject;
    document.getElementById('bodyCopy').textContent = letter.body;
    document.getElementById('count').textContent = `LETTER ${current + 1} / ${letters.length}`;
    document.getElementById('totals').textContent = `KEEP ${score.keep} · LATER ${score.later} · JUNK ${score.junk}`;
    envelope.className = 'envelope arrive';
}

function finishSorting() {
    const personality = score.keep >= 4
        ? 'You are a sentimental archivist. The filing cabinets fear you, but the letters feel very safe.'
        : score.junk >= 3
            ? 'Your spam instincts are magnificent. Nothing wearing a fake moustache gets past this desk.'
            : 'A balanced sorting hand: decisive, humane, and only mildly suspicious of parcels.';
    envelope.style.display = 'none';
    sortButtons.style.display = 'none';
    document.getElementById('count').textContent = 'SORT COMPLETE';
    receipt.innerHTML = `<strong>POSTMASTER'S RECEIPT</strong><br>${score.keep} kept close · ${score.later} for later · ${score.junk} sent packing<br><br>${personality}<br><br><button class="replay" type="button">Run another shift</button>`;
    receipt.classList.add('show');
    receipt.querySelector('button').addEventListener('click', resetSorting);
}

function sortLetter(action) {
    if (current >= letters.length) return;
    score[action]++;
    const exit = action === 'keep' ? 'exit-left' : action === 'later' ? 'exit-down' : 'exit-right';
    envelope.className = `envelope ${exit}`;
    current++;
    document.getElementById('totals').textContent = `KEEP ${score.keep} · LATER ${score.later} · JUNK ${score.junk}`;
    setTimeout(() => current < letters.length ? renderLetter() : finishSorting(), 370);
}

function resetSorting() {
    current = 0;
    score = {keep: 0, later: 0, junk: 0};
    envelope.style.display = '';
    sortButtons.style.display = 'grid';
    receipt.classList.remove('show');
    renderLetter();
}

sortButtons.addEventListener('click', event => {
    const button = event.target.closest('[data-action]');
    if (button) sortLetter(button.dataset.action);
});
document.addEventListener('keydown', event => {
    if (event.key === 'ArrowLeft') sortLetter('keep');
    if (event.key === 'ArrowDown') sortLetter('later');
    if (event.key === 'ArrowRight') sortLetter('junk');
});
renderLetter();
</script>
</body>
</html>
