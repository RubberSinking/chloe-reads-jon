<?php
$sourceUrl = 'https://jona.ca/2004/07/22-aint-bad-temperature.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f1e8d3">
    <title>The 22° Thermostat Treaty</title>
    <style>
        :root {
            --paper: #f1e8d3;
            --ink: #252b29;
            --red: #df4c35;
            --blue: #287e98;
            --mustard: #e7af38;
            --green: #3f765f;
            --line: rgba(37,43,41,.2);
            --shadow: 0 18px 45px rgba(52, 45, 33, .15);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 5%, rgba(255,255,255,.8), transparent 28rem),
                repeating-linear-gradient(90deg, transparent 0 39px, rgba(60,50,35,.025) 40px),
                var(--paper);
            font-family: "Courier New", Courier, monospace;
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .17;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.22'/%3E%3C/svg%3E");
            z-index: 10;
            mix-blend-mode: multiply;
        }
        a { color: inherit; }
        button, input { font: inherit; }
        .shell {
            width: min(1120px, calc(100% - 30px));
            margin: 0 auto;
            padding: 22px 0 60px;
        }
        .topline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--ink);
            padding: 0 0 10px;
            text-transform: uppercase;
            font-size: .67rem;
            letter-spacing: .12em;
        }
        .topline a { text-decoration: none; }
        .status-lamp {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 8px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 0 4px rgba(63,118,95,.13);
            animation: breathe 2.6s ease-in-out infinite;
        }
        @keyframes breathe { 50% { box-shadow: 0 0 0 8px rgba(63,118,95,0); } }
        .hero {
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            min-height: 560px;
            border-bottom: 2px solid var(--ink);
        }
        .hero-copy { padding: 68px 6vw 68px 0; position: relative; }
        .kicker {
            color: var(--red);
            text-transform: uppercase;
            letter-spacing: .16em;
            font-size: .72rem;
            font-weight: 500;
        }
        h1 {
            font-family: "Cooper Black", Georgia, serif;
            font-size: clamp(3.8rem, 9vw, 8.4rem);
            line-height: .75;
            letter-spacing: -.075em;
            margin: 28px 0 32px;
            max-width: 720px;
        }
        h1 span {
            color: var(--red);
            display: inline-block;
            transform: rotate(-5deg);
        }
        .lede {
            font-family: "Palatino Linotype", Palatino, Georgia, serif;
            font-size: clamp(1.2rem, 2vw, 1.55rem);
            line-height: 1.35;
            max-width: 590px;
            margin: 0;
        }
        .hero-note {
            display: inline-block;
            margin-top: 26px;
            padding-bottom: 4px;
            border-bottom: 1px solid;
            font-size: .73rem;
            text-decoration: none;
        }
        .dial-stage {
            min-height: 100%;
            display: grid;
            place-items: center;
            border-left: 2px solid var(--ink);
            background:
                linear-gradient(135deg, rgba(40,126,152,.16), transparent 60%),
                rgba(255,255,255,.2);
            overflow: hidden;
            position: relative;
        }
        .dial-stage::before {
            content: "DOMESTIC CLIMATE UNIT  •  MODEL XXII";
            position: absolute;
            bottom: 22px;
            font-size: .58rem;
            letter-spacing: .14em;
            opacity: .65;
        }
        .dial {
            width: min(350px, 78vw);
            aspect-ratio: 1;
            border-radius: 50%;
            border: 12px solid var(--ink);
            background:
                repeating-conic-gradient(from -135deg, var(--ink) 0 1deg, transparent 1deg 9deg),
                radial-gradient(circle at 40% 32%, #fffdf5 0, #ded3ba 62%, #a89c84 100%);
            box-shadow: inset 0 0 0 22px var(--paper), inset 0 0 0 24px var(--ink), var(--shadow);
            position: relative;
            display: grid;
            place-items: center;
            animation: arrive .9s cubic-bezier(.2,.8,.2,1) both;
        }
        @keyframes arrive { from { opacity: 0; transform: rotate(-18deg) scale(.78); } }
        .dial-core {
            width: 58%;
            aspect-ratio: 1;
            border-radius: 50%;
            color: var(--paper);
            background: var(--ink);
            display: grid;
            align-content: center;
            justify-items: center;
            box-shadow: inset 0 8px 20px rgba(0,0,0,.3);
            position: relative;
            z-index: 2;
        }
        .dial-number {
            font-family: "Cooper Black", Georgia, serif;
            font-size: clamp(4.8rem, 10vw, 7.4rem);
            font-weight: 900;
            line-height: .75;
            letter-spacing: -.08em;
        }
        .dial-unit { font-size: .65rem; letter-spacing: .16em; margin-top: 12px; }
        .needle {
            position: absolute;
            width: 5px;
            height: 44%;
            left: calc(50% - 2px);
            top: 6%;
            background: var(--red);
            transform-origin: 50% 100%;
            transform: rotate(0deg);
            transition: transform .35s cubic-bezier(.2,.8,.2,1);
            border-radius: 4px;
            z-index: 1;
        }
        .needle::after {
            content: "";
            position: absolute;
            width: 14px;
            height: 14px;
            background: var(--red);
            border-radius: 50%;
            left: -4.5px;
            top: -5px;
        }
        .workbench {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            border-bottom: 2px solid var(--ink);
        }
        .controls {
            padding: 54px 5vw 58px 0;
            border-right: 2px solid var(--ink);
        }
        h2 {
            font-family: "Cooper Black", Georgia, serif;
            font-size: clamp(2rem, 4vw, 3.4rem);
            letter-spacing: -.045em;
            line-height: 1;
            margin: 0 0 34px;
        }
        .control-row {
            display: grid;
            grid-template-columns: 132px 1fr 72px;
            align-items: center;
            gap: 18px;
            padding: 20px 0;
            border-top: 1px solid var(--line);
        }
        .control-row label {
            text-transform: uppercase;
            font-size: .68rem;
            letter-spacing: .1em;
        }
        .readout { text-align: right; font-weight: 500; color: var(--red); }
        input[type="range"] {
            appearance: none;
            width: 100%;
            height: 4px;
            background: var(--ink);
            border-radius: 0;
        }
        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 24px; height: 24px;
            border-radius: 50%;
            background: var(--mustard);
            border: 3px solid var(--ink);
            cursor: grab;
        }
        .choice-group { display: flex; gap: 7px; flex-wrap: wrap; }
        .choice {
            border: 1px solid var(--ink);
            background: transparent;
            padding: 9px 11px;
            cursor: pointer;
            font-size: .67rem;
            text-transform: uppercase;
            transition: .15s ease;
        }
        .choice:hover, .choice.active {
            background: var(--ink);
            color: var(--paper);
            transform: translateY(-2px);
        }
        .verdict {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 54px 0 58px 5vw;
            min-height: 500px;
        }
        .meter {
            height: 18px;
            display: grid;
            grid-template-columns: repeat(20, 1fr);
            gap: 4px;
            margin: 18px 0 38px;
        }
        .meter i { background: rgba(37,43,41,.12); transition: background .25s; }
        .meter i.on { background: var(--green); }
        .verdict-word {
            font-family: "Cooper Black", Georgia, serif;
            font-size: clamp(2.8rem, 5vw, 5rem);
            line-height: .85;
            color: var(--green);
            margin: 15px 0;
        }
        .explanation { line-height: 1.7; font-size: .78rem; max-width: 420px; }
        .stamp {
            width: fit-content;
            color: var(--red);
            border: 4px double var(--red);
            padding: 12px 16px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .1em;
            transform: rotate(-3deg);
        }
        .treaty {
            display: grid;
            grid-template-columns: .72fr 1.28fr;
            min-height: 540px;
            border-bottom: 2px solid var(--ink);
        }
        .votes {
            padding: 54px 4vw 58px 0;
            border-right: 2px solid var(--ink);
        }
        .vote-buttons { display: grid; gap: 10px; }
        .vote {
            display: flex;
            justify-content: space-between;
            padding: 16px;
            background: transparent;
            border: 1px solid var(--ink);
            cursor: pointer;
            text-align: left;
            transition: .2s;
        }
        .vote:hover, .vote.active { color: var(--paper); background: var(--blue); transform: translateX(6px); }
        .vote span:last-child { font-size: 1.2rem; }
        .vote-summary { font-size: .72rem; margin-top: 22px; line-height: 1.6; min-height: 44px; }
        .game {
            padding: 54px 0 58px 5vw;
            position: relative;
            overflow: hidden;
        }
        .game-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 20px;
        }
        .clock { color: var(--red); font-size: 1.3rem; font-weight: 500; }
        .room {
            height: 235px;
            border: 2px solid var(--ink);
            margin: 20px 0;
            position: relative;
            overflow: hidden;
            background: linear-gradient(180deg, #9dc4c5 0 65%, #c2794d 65%);
            transition: background .3s;
        }
        .window {
            position: absolute;
            width: 26%; height: 44%;
            left: 10%; top: 12%;
            border: 7px solid var(--paper);
            box-shadow: 0 0 0 2px var(--ink);
            background: linear-gradient(#73aabd 64%, #536b4e 65%);
        }
        .window::before, .window::after { content:""; position:absolute; background:var(--paper); }
        .window::before { width: 5px; height: 100%; left: calc(50% - 2px); }
        .window::after { height: 5px; width: 100%; top: calc(50% - 2px); }
        .sofa {
            position: absolute; right: 11%; bottom: 12%;
            width: 43%; height: 35%; border-radius: 18px 18px 4px 4px;
            background: var(--mustard); border: 3px solid var(--ink);
        }
        .sofa::before, .sofa::after {
            content:""; position:absolute; top:-28%; width:45%; height:55%;
            border:3px solid var(--ink); background:#eec45e; border-radius:16px 16px 4px 4px;
        }
        .sofa::before { left:2%; } .sofa::after { right:2%; }
        .room-temp {
            position: absolute; left: 7%; bottom: 7%;
            background: var(--paper); border: 2px solid var(--ink);
            padding: 8px 11px; font-weight: 500;
        }
        .weather {
            position: absolute; right: 4%; top: 7%;
            color: var(--paper); background: var(--ink);
            padding: 7px 9px; font-size: .64rem;
        }
        .game-actions { display: grid; grid-template-columns: 1fr 1fr 1.4fr; gap: 8px; }
        .game-actions button {
            border: 2px solid var(--ink);
            background: transparent;
            padding: 14px 8px;
            cursor: pointer;
            font-weight: 500;
        }
        .game-actions button:hover { background: var(--ink); color: var(--paper); }
        #startGame { background: var(--red); color: white; }
        .game-message { margin-top: 14px; min-height: 42px; font-size: .72rem; line-height: 1.5; }
        footer {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            padding-top: 30px;
            font-size: .65rem;
            line-height: 1.6;
        }
        .confetti {
            position: fixed; top: -15px; width: 9px; height: 16px;
            z-index: 20; animation: fall 1.7s linear forwards;
        }
        @keyframes fall { to { transform: translateY(105vh) rotate(720deg); } }
        @media (max-width: 780px) {
            .hero, .workbench, .treaty { grid-template-columns: 1fr; }
            .hero-copy { padding: 52px 0 40px; }
            h1 { font-size: clamp(4.2rem, 22vw, 7rem); }
            .dial-stage { border-left: 0; border-top: 2px solid var(--ink); min-height: 470px; }
            .controls, .votes { border-right: 0; border-bottom: 2px solid var(--ink); padding: 44px 0; }
            .verdict, .game { padding: 44px 0; }
            .control-row { grid-template-columns: 92px 1fr 56px; gap: 10px; }
            .choice-group { grid-column: 2 / 4; }
            .game-head { display: block; }
            .clock { margin-bottom: 10px; }
            footer { flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
<main class="shell">
    <nav class="topline">
        <a href="./">← Chloe Reads Jon</a>
        <span><i class="status-lamp"></i>Comfort bureau open</span>
    </nav>

    <section class="hero">
        <div class="hero-copy">
            <div class="kicker">Department of Domestic Diplomacy</div>
            <h1>The <span>22°</span><br>Treaty</h1>
            <p class="lede">A scientific-ish instrument for settling the oldest household dispute: “Is it warm in here, or is that just you?”</p>
            <a class="hero-note" href="<?= htmlspecialchars($sourceUrl) ?>">Inspired by Jon’s tiny 2004 dispatch, “22 ain’t a bad temperature” ↗</a>
        </div>
        <div class="dial-stage">
            <div class="dial" aria-label="Current thermostat temperature">
                <div class="needle" id="needle"></div>
                <div class="dial-core">
                    <div class="dial-number"><span id="heroTemp">22</span>°</div>
                    <div class="dial-unit">CELSIUS / SENSIBLE</div>
                </div>
            </div>
        </div>
    </section>

    <section class="workbench">
        <div class="controls">
            <div class="kicker">01 / Calibrate the room</div>
            <h2>Comfort has accomplices.</h2>
            <div class="control-row">
                <label for="temperature">Thermostat</label>
                <input id="temperature" type="range" min="16" max="28" step=".5" value="22">
                <span class="readout"><span id="tempOut">22</span>°</span>
            </div>
            <div class="control-row">
                <label for="humidity">Humidity</label>
                <input id="humidity" type="range" min="20" max="80" value="45">
                <span class="readout"><span id="humidityOut">45</span>%</span>
            </div>
            <div class="control-row">
                <label>Current rig</label>
                <div class="choice-group" id="clothing">
                    <button class="choice" data-value="-1">T-shirt</button>
                    <button class="choice active" data-value="0">Sweater</button>
                    <button class="choice" data-value="1.2">Blanket burrito</button>
                </div>
                <span></span>
            </div>
            <div class="control-row">
                <label>Activity</label>
                <div class="choice-group" id="activity">
                    <button class="choice" data-value="-.6">Sitting</button>
                    <button class="choice active" data-value="0">Puttering</button>
                    <button class="choice" data-value="1.3">Mario intensity</button>
                </div>
                <span></span>
            </div>
        </div>
        <aside class="verdict" aria-live="polite">
            <div>
                <div class="kicker">Bureau finding</div>
                <div class="meter" id="meter" aria-label="Comfort score"></div>
                <div class="verdict-word" id="verdict">Treaty zone.</div>
                <p class="explanation" id="explanation">At 22°, with ordinary humidity and a sweater, the room has achieved the rare state known as “nobody needs to mention the thermostat.”</p>
            </div>
            <div class="stamp" id="stamp">22 ain’t bad</div>
        </aside>
    </section>

    <section class="treaty">
        <div class="votes">
            <div class="kicker">02 / Family vote</div>
            <h2>Register a thermal grievance.</h2>
            <div class="vote-buttons">
                <button class="vote" data-vote="cold"><span>I have become an icicle</span><span>❄</span></button>
                <button class="vote" data-vote="good"><span>Leave it. Touch nothing.</span><span>◆</span></button>
                <button class="vote" data-vote="hot"><span>Why is this house a volcano?</span><span>☀</span></button>
            </div>
            <div class="vote-summary" id="voteSummary">No grievances filed. Domestic peace is holding suspiciously well.</div>
        </div>
        <div class="game">
            <div class="game-head">
                <div>
                    <div class="kicker">03 / Nathan mode</div>
                    <h2>Hold the house at 22°.</h2>
                </div>
                <div class="clock"><span id="clock">22</span>s</div>
            </div>
            <div class="room" id="room">
                <div class="window"></div>
                <div class="sofa"></div>
                <div class="weather" id="weather">WEATHER: CALM</div>
                <div class="room-temp"><span id="gameTemp">22.0</span>°</div>
            </div>
            <div class="game-actions">
                <button id="cool" aria-label="Cool room one degree">− COOL</button>
                <button id="heat" aria-label="Heat room one degree">+ HEAT</button>
                <button id="startGame">START 22-SECOND SHIFT</button>
            </div>
            <div class="game-message" id="gameMessage">Keep the needle near 22 while tiny domestic weather events conspire against you.</div>
        </div>
    </section>

    <footer>
        <span>THE BUREAU ACCEPTS NO LIABILITY FOR SOCK-BASED LOBBYING.</span>
        <span>22°C = 71.6°F · Treaty drafted with affection by Chloe.</span>
    </footer>
</main>

<script>
(() => {
    const $ = id => document.getElementById(id);
    const temp = $('temperature');
    const humidity = $('humidity');
    let clothing = 0, activity = 0;

    for (let i = 0; i < 20; i++) $('meter').appendChild(document.createElement('i'));

    function selected(group, setter) {
        $(group).addEventListener('click', e => {
            const button = e.target.closest('button');
            if (!button) return;
            $(group).querySelectorAll('button').forEach(b => b.classList.remove('active'));
            button.classList.add('active');
            setter(parseFloat(button.dataset.value));
            updateComfort();
        });
    }
    selected('clothing', value => clothing = value);
    selected('activity', value => activity = value);

    function updateComfort() {
        const t = parseFloat(temp.value);
        const h = parseInt(humidity.value);
        const felt = t + clothing + activity + (h - 45) * .025;
        const distance = Math.abs(felt - 22);
        const score = Math.max(1, Math.round(20 - distance * 4.1));
        $('tempOut').textContent = Number.isInteger(t) ? t : t.toFixed(1);
        $('heroTemp').textContent = Number.isInteger(t) ? t : t.toFixed(1);
        $('humidityOut').textContent = h;
        $('needle').style.transform = `rotate(${(t - 22) * 15}deg)`;
        [...$('meter').children].forEach((bar, i) => bar.classList.toggle('on', i < score));

        let word, copy, stamp, color;
        if (felt < 19) {
            word = 'Sock emergency.';
            copy = `It feels like ${felt.toFixed(1)}°. The room is making a strong case for tea, wool, and a very pointed glance at whoever pays the heating bill.`;
            stamp = 'Heat requested'; color = '#287e98';
        } else if (felt < 21) {
            word = 'Cardigan country.';
            copy = `It feels like ${felt.toFixed(1)}°. Entirely survivable, but bare forearms have begun filing paperwork.`;
            stamp = 'Proceed with socks'; color = '#287e98';
        } else if (felt <= 23) {
            word = 'Treaty zone.';
            copy = `It feels like ${felt.toFixed(1)}°. The rare domestic state in which nobody needs to mention the thermostat. Jon’s 2004 finding holds up.`;
            stamp = '22 ain’t bad'; color = '#3f765f';
        } else if (felt <= 25) {
            word = 'Window territory.';
            copy = `It feels like ${felt.toFixed(1)}°. Peace is possible, but someone is already considering a strategically opened window.`;
            stamp = 'Ventilation advised'; color = '#df4c35';
        } else {
            word = 'House volcano.';
            copy = `It feels like ${felt.toFixed(1)}°. The blanket has been exiled and all negotiations now involve a fan.`;
            stamp = 'Cool immediately'; color = '#df4c35';
        }
        $('verdict').textContent = word;
        $('verdict').style.color = color;
        $('explanation').textContent = copy;
        $('stamp').textContent = stamp;
        $('stamp').style.color = color;
        $('stamp').style.borderColor = color;
    }
    temp.addEventListener('input', updateComfort);
    humidity.addEventListener('input', updateComfort);
    updateComfort();

    const votes = {cold: 0, good: 0, hot: 0};
    document.querySelectorAll('.vote').forEach(button => {
        button.addEventListener('click', () => {
            votes[button.dataset.vote]++;
            button.classList.add('active');
            setTimeout(() => button.classList.remove('active'), 280);
            const total = votes.cold + votes.good + votes.hot;
            let finding = 'The room is split. Appoint a neutral party wearing an average number of layers.';
            if (votes.good > votes.cold && votes.good > votes.hot) finding = 'The “touch nothing” caucus leads. The thermostat is now a protected heritage object.';
            if (votes.cold > votes.good && votes.cold > votes.hot) finding = 'The icicle lobby leads. One degree of mercy has been formally requested.';
            if (votes.hot > votes.good && votes.hot > votes.cold) finding = 'The volcano delegation leads. Open a window before diplomacy melts.';
            $('voteSummary').textContent = `${total} vote${total === 1 ? '' : 's'} cast. ${finding}`;
        });
    });

    let gameTemp = 22, seconds = 22, score = 0, running = false, timer, weatherTimer;
    const events = [
        ['OVEN OPEN', 1.1], ['WINDOW GUST', -1.4], ['SUNBEAM', .8],
        ['DOOR LEFT OPEN', -1], ['BLANKET FORT', .7], ['WEATHER: CALM', 0]
    ];
    function renderRoom() {
        $('gameTemp').textContent = gameTemp.toFixed(1);
        const heat = Math.max(0, Math.min(1, (gameTemp - 18) / 8));
        const cool = `rgb(${Math.round(120 + heat*85)},${Math.round(177 - heat*65)},${Math.round(193 - heat*90)})`;
        $('room').style.background = `linear-gradient(180deg, ${cool} 0 65%, #c2794d 65%)`;
    }
    function nudge(amount) {
        if (!running) return;
        gameTemp = Math.max(16, Math.min(29, gameTemp + amount));
        renderRoom();
    }
    $('cool').addEventListener('click', () => nudge(-.7));
    $('heat').addEventListener('click', () => nudge(.7));
    function confetti() {
        const colors = ['#df4c35','#287e98','#e7af38','#3f765f'];
        for (let i = 0; i < 45; i++) {
            const bit = document.createElement('i');
            bit.className = 'confetti';
            bit.style.left = Math.random() * 100 + 'vw';
            bit.style.background = colors[i % colors.length];
            bit.style.animationDelay = Math.random() * .7 + 's';
            document.body.appendChild(bit);
            setTimeout(() => bit.remove(), 2500);
        }
    }
    function finish() {
        running = false;
        clearInterval(timer); clearInterval(weatherTimer);
        $('startGame').textContent = 'TRY ANOTHER SHIFT';
        const rating = score >= 18 ? 'THERMOSTAT DIPLOMAT' : score >= 12 ? 'COMFORT APPRENTICE' : 'CHAOTIC WEATHER INTERN';
        $('gameMessage').textContent = `${rating}: ${score}/22 calm seconds. ${score >= 18 ? 'The household awards you custody of the thermostat.' : 'The socks remain on standby.'}`;
        if (score >= 18) confetti();
    }
    $('startGame').addEventListener('click', () => {
        clearInterval(timer); clearInterval(weatherTimer);
        running = true; seconds = 22; score = 0; gameTemp = 22;
        $('clock').textContent = seconds;
        $('startGame').textContent = 'SHIFT IN PROGRESS…';
        $('gameMessage').textContent = 'Hold 21.3°–22.7°. Incoming domestic weather!';
        $('weather').textContent = 'WEATHER: CALM';
        renderRoom();
        timer = setInterval(() => {
            seconds--;
            if (Math.abs(gameTemp - 22) <= .7) score++;
            gameTemp += (Math.random() - .5) * .3;
            $('clock').textContent = seconds;
            renderRoom();
            if (seconds <= 0) finish();
        }, 1000);
        weatherTimer = setInterval(() => {
            const event = events[Math.floor(Math.random() * events.length)];
            $('weather').textContent = event[0];
            gameTemp += event[1];
            renderRoom();
        }, 2600);
    });
})();
</script>
</body>
</html>
