<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#142b31">
    <title>The Three Lamps · Faith, Hope &amp; Love</title>
    <style>
        :root {
            --ink: #183139;
            --deep: #0f262d;
            --paper: #f5ead1;
            --paper-light: #fff9e9;
            --mustard: #e1ad48;
            --coral: #d96d52;
            --teal: #287d79;
            --blue: #1f4d62;
            --muted: #6b7068;
            --shadow: 0 24px 60px rgba(9, 30, 35, .2);
            --faith: #f5d57c;
            --hope: #78d5c8;
            --love: #ee8265;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 8% 10%, rgba(225, 173, 72, .2), transparent 27rem),
                linear-gradient(120deg, #f8edd6, #e8d8ba 55%, #dfc8a6);
            font-family: "Avenir Next", Avenir, "Trebuchet MS", sans-serif;
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .28;
            z-index: 50;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
        }
        button, a { -webkit-tap-highlight-color: transparent; }
        button { font: inherit; }
        button:focus-visible, a:focus-visible { outline: 3px solid var(--teal); outline-offset: 4px; }

        .shell { width: min(1160px, calc(100% - 32px)); margin: 0 auto; padding: 28px 0 56px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .back {
            color: var(--ink);
            text-decoration: none;
            font-size: .82rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .back::before { content: "←"; margin-right: .5rem; }
        .edition { font-family: Georgia, serif; font-style: italic; color: #6c675d; font-size: .84rem; }

        .hero {
            display: grid;
            grid-template-columns: minmax(280px, .77fr) minmax(430px, 1.23fr);
            min-height: 620px;
            overflow: hidden;
            background: var(--deep);
            border: 1px solid rgba(24, 49, 57, .35);
            border-radius: 5px 38px 5px 5px;
            box-shadow: var(--shadow), 9px 9px 0 rgba(23, 58, 65, .16);
            position: relative;
        }
        .hero::after {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(245, 234, 209, .28);
            pointer-events: none;
            border-radius: 2px 29px 2px 2px;
        }
        .hero-copy {
            padding: clamp(34px, 6vw, 78px);
            padding-right: clamp(28px, 4vw, 56px);
            align-self: center;
            color: var(--paper);
            position: relative;
            z-index: 2;
        }
        .kicker { margin: 0 0 24px; color: var(--mustard); font-size: .75rem; font-weight: 900; letter-spacing: .2em; text-transform: uppercase; }
        h1 {
            margin: 0;
            font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: clamp(3.7rem, 8vw, 7.7rem);
            font-weight: 500;
            line-height: .76;
            letter-spacing: -.065em;
        }
        h1 span { display: block; margin-left: .72em; color: var(--mustard); font-style: italic; }
        .dek { margin: 35px 0 30px; max-width: 32rem; line-height: 1.72; font-family: Georgia, serif; font-size: 1.06rem; color: #e7dcc6; }
        .start-btn, .next-btn, .again-btn {
            border: 0;
            cursor: pointer;
            color: #102a30;
            background: var(--mustard);
            padding: 14px 20px;
            box-shadow: 5px 5px 0 var(--coral);
            border-radius: 2px;
            font-weight: 900;
            letter-spacing: .03em;
            transition: transform .18s ease, box-shadow .18s ease;
        }
        .start-btn:hover, .next-btn:hover, .again-btn:hover { transform: translate(2px, 2px); box-shadow: 3px 3px 0 var(--coral); }
        .hero-art { position: relative; min-height: 620px; overflow: hidden; }
        .hero-art img { width: 100%; height: 100%; object-fit: cover; display: block; filter: saturate(.88) contrast(1.02); }
        .hero-art::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1;
            background: linear-gradient(90deg, var(--deep), transparent 24%), linear-gradient(0deg, rgba(15,38,45,.32), transparent 36%);
            pointer-events: none;
        }
        .art-caption {
            position: absolute;
            right: 28px;
            bottom: 25px;
            z-index: 2;
            color: var(--paper-light);
            background: rgba(15, 38, 45, .74);
            padding: 8px 11px;
            font: italic .78rem/1.4 Georgia, serif;
        }

        .game { display: none; margin-top: 28px; animation: rise .65s ease both; }
        .game.active { display: block; }
        @keyframes rise { from { opacity: 0; transform: translateY(22px); } to { opacity: 1; transform: none; } }
        .dashboard {
            display: grid;
            grid-template-columns: 1fr 1.35fr;
            gap: 22px;
            margin-bottom: 22px;
        }
        .lamps-panel, .day-panel, .story-card, .result-card {
            background: rgba(255, 249, 233, .88);
            border: 1px solid rgba(24,49,57,.22);
            box-shadow: 6px 7px 0 rgba(24,49,57,.11);
        }
        .lamps-panel { padding: 20px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .lamp { text-align: center; }
        .lamp-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 8px;
            position: relative;
            border: 3px solid var(--ink);
            border-radius: 50% 50% 45% 45%;
            background: #cabf9e;
            transition: all .45s cubic-bezier(.2,.9,.2,1.3);
        }
        .lamp-icon::before { content: ""; position: absolute; left: 13px; right: 13px; bottom: -12px; height: 12px; background: var(--ink); clip-path: polygon(16% 0,84% 0,100% 100%,0 100%); }
        .lamp-icon::after { content: ""; position: absolute; left: 8px; right: 8px; bottom: -17px; height: 5px; background: var(--ink); border-radius: 2px; }
        .lamp[data-kind="faith"] .lamp-icon.lit { background: var(--faith); box-shadow: 0 0 30px var(--faith), inset 0 0 10px white; }
        .lamp[data-kind="hope"] .lamp-icon.lit { background: var(--hope); box-shadow: 0 0 30px var(--hope), inset 0 0 10px white; }
        .lamp[data-kind="love"] .lamp-icon.lit { background: var(--love); box-shadow: 0 0 30px var(--love), inset 0 0 10px white; }
        .lamp-icon.pulse { animation: lamp-pop .6s ease; }
        @keyframes lamp-pop { 50% { transform: scale(1.18) rotate(3deg); } }
        .lamp-name { font-family: Georgia, serif; font-weight: bold; font-size: .95rem; }
        .lamp-dots { display: flex; justify-content: center; gap: 4px; margin-top: 5px; }
        .lamp-dots i { display: block; width: 7px; height: 7px; border: 1px solid currentColor; border-radius: 50%; opacity: .35; }
        .lamp-dots i.on { background: currentColor; opacity: 1; }
        .day-panel { padding: 23px 26px; position: relative; overflow: hidden; }
        .day-row { display: flex; justify-content: space-between; font-size: .72rem; font-weight: 900; text-transform: uppercase; letter-spacing: .11em; }
        .day-track { height: 13px; background: #c8bfa9; margin-top: 15px; position: relative; overflow: hidden; border: 2px solid var(--ink); }
        .day-fill { height: 100%; width: 0%; background: linear-gradient(90deg, #ed9c6c, #edcd77, #3a8f91, #173d57); transition: width .6s ease; }
        .day-note { margin: 16px 0 0; font: italic .92rem/1.45 Georgia, serif; color: #68675f; }

        .story-card { display: grid; grid-template-columns: 130px 1fr; min-height: 470px; overflow: hidden; }
        .number-rail { background: var(--ink); color: var(--paper); padding: 26px 18px; display: flex; flex-direction: column; justify-content: space-between; }
        .round-no { font: 4rem/.85 Georgia, serif; color: var(--mustard); }
        .time-label { writing-mode: vertical-rl; transform: rotate(180deg); text-transform: uppercase; letter-spacing: .2em; font-size: .66rem; font-weight: 900; }
        .story-body { padding: clamp(28px, 5vw, 54px); position: relative; }
        .scene { margin: 0 0 12px; color: var(--teal); font-size: .73rem; font-weight: 900; letter-spacing: .16em; text-transform: uppercase; }
        .story-body h2 { margin: 0 0 30px; max-width: 770px; font: 500 clamp(1.75rem,4vw,3rem)/1.14 "Iowan Old Style", Georgia, serif; letter-spacing: -.025em; }
        .choices { display: grid; gap: 11px; }
        .choice {
            width: 100%;
            text-align: left;
            border: 1px solid rgba(24,49,57,.33);
            background: #fbf4e2;
            color: var(--ink);
            padding: 15px 17px;
            border-radius: 2px;
            cursor: pointer;
            line-height: 1.45;
            transition: .18s ease;
            position: relative;
        }
        .choice:hover:not(:disabled) { transform: translateX(5px); border-color: var(--teal); background: white; }
        .choice:disabled { cursor: default; }
        .choice.correct { border-color: var(--teal); background: #dff1e9; padding-right: 54px; }
        .choice.correct::after { content: "✓"; position: absolute; right: 18px; top: 50%; transform: translateY(-50%); font-weight: 900; font-size: 1.4rem; }
        .choice.wrong { opacity: .52; }
        .feedback { display: none; margin-top: 22px; border-top: 2px solid var(--ink); padding-top: 17px; }
        .feedback.show { display: grid; grid-template-columns: 1fr auto; gap: 20px; align-items: center; animation: rise .35s ease both; }
        .feedback strong { font-family: Georgia, serif; color: var(--coral); }
        .feedback p { margin: 4px 0 0; line-height: 1.55; font-size: .91rem; }
        .next-btn { padding: 11px 16px; }

        .result { display: none; margin-top: 22px; }
        .result.show { display: block; animation: rise .6s ease both; }
        .result-card { padding: clamp(30px, 6vw, 70px); position: relative; overflow: hidden; }
        .result-card::before { content: "✦"; position: absolute; right: -25px; top: -55px; font: 13rem Georgia, serif; color: rgba(225,173,72,.18); }
        .result-card h2 { margin: 0; font: 500 clamp(2.6rem,7vw,5.8rem)/.96 "Iowan Old Style", Georgia, serif; letter-spacing: -.05em; max-width: 700px; }
        .scoreline { display: flex; gap: 18px; flex-wrap: wrap; margin: 28px 0; }
        .score-pill { padding: 9px 13px; border: 1px solid var(--ink); background: var(--paper); font-weight: 900; font-size: .84rem; }
        .pocket-card { max-width: 700px; padding: 24px; background: var(--ink); color: var(--paper); transform: rotate(-1deg); box-shadow: 8px 9px 0 var(--mustard); }
        .pocket-card small { color: var(--mustard); text-transform: uppercase; letter-spacing: .15em; font-weight: 900; }
        .pocket-card p { font: 1.25rem/1.55 Georgia, serif; margin: 12px 0 0; }
        .result-actions { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; margin-top: 34px; }

        .reference { margin: 35px auto 0; width: min(870px, 100%); }
        .reference details { border-top: 1px solid rgba(24,49,57,.3); border-bottom: 1px solid rgba(24,49,57,.3); padding: 18px 0; }
        .reference summary { cursor: pointer; font-family: Georgia, serif; font-size: 1.1rem; font-weight: bold; }
        .acts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 20px; }
        .act { padding: 17px; background: rgba(255,249,233,.7); border-left: 5px solid var(--mustard); }
        .act:nth-child(2) { border-color: var(--teal); }
        .act:nth-child(3) { border-color: var(--coral); }
        .act h3 { margin: 0 0 9px; font: 1.2rem Georgia, serif; }
        .act p { margin: 0; font: .84rem/1.56 Georgia, serif; }

        footer { text-align: center; margin-top: 40px; color: #5e625c; font: italic .9rem/1.55 Georgia, serif; }
        footer a { color: var(--blue); font-weight: bold; text-underline-offset: 3px; }

        @media (max-width: 790px) {
            .shell { width: min(100% - 20px, 680px); padding-top: 15px; }
            .hero { grid-template-columns: 1fr; border-radius: 4px 28px 4px 4px; min-height: 0; }
            .hero-copy { padding: 42px 30px 36px; }
            h1 { font-size: clamp(4rem, 20vw, 6.4rem); }
            .hero-art { min-height: 390px; }
            .hero-art::before { background: linear-gradient(0deg, var(--deep), transparent 26%); }
            .dashboard { grid-template-columns: 1fr; }
            .story-card { grid-template-columns: 1fr; }
            .number-rail { min-height: 80px; flex-direction: row; align-items: center; padding: 16px 20px; }
            .round-no { font-size: 2.8rem; }
            .time-label { writing-mode: initial; transform: none; }
            .feedback.show { grid-template-columns: 1fr; }
            .next-btn { width: 100%; }
            .acts { grid-template-columns: 1fr; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
    <main class="shell">
        <nav class="topbar" aria-label="Page navigation">
            <a class="back" href="./">Chloe Reads Jon</a>
            <span class="edition">A small field guide to ordinary holiness</span>
        </nav>

        <section class="hero" id="intro">
            <div class="hero-copy">
                <p class="kicker">A six-scene discernment game</p>
                <h1>Three <span>Lamps</span></h1>
                <p class="dek">Faith sees by God’s light. Hope keeps walking toward him. Love turns toward the person beside you. Can you tell which lamp an ordinary moment needs?</p>
                <button class="start-btn" id="startBtn">Begin at dawn&nbsp; →</button>
            </div>
            <figure class="hero-art">
                <img src="assets/three-lamps-house.webp" alt="A handcrafted house diorama passing from dawn through rain into a starlit evening, illuminated by three lamps" width="1536" height="1024">
                <figcaption class="art-caption">Three lights, one day.</figcaption>
            </figure>
        </section>

        <section class="game" id="game" aria-live="polite">
            <div class="dashboard">
                <div class="lamps-panel" aria-label="Virtue lamps">
                    <div class="lamp" data-kind="faith"><div class="lamp-icon"></div><div class="lamp-name">Faith</div><div class="lamp-dots"><i></i><i></i></div></div>
                    <div class="lamp" data-kind="hope"><div class="lamp-icon"></div><div class="lamp-name">Hope</div><div class="lamp-dots"><i></i><i></i></div></div>
                    <div class="lamp" data-kind="love"><div class="lamp-icon"></div><div class="lamp-name">Love</div><div class="lamp-dots"><i></i><i></i></div></div>
                </div>
                <div class="day-panel">
                    <div class="day-row"><span>Dawn</span><span id="progressText">Scene 1 of 6</span><span>Night</span></div>
                    <div class="day-track"><div class="day-fill" id="dayFill"></div></div>
                    <p class="day-note" id="dayNote">The first light is coming through the curtains.</p>
                </div>
            </div>

            <article class="story-card" id="storyCard">
                <div class="number-rail"><div class="round-no" id="roundNo">01</div><div class="time-label" id="timeLabel">7:10 AM · Kitchen</div></div>
                <div class="story-body">
                    <p class="scene" id="sceneLabel">The uncertain morning</p>
                    <h2 id="scenario"></h2>
                    <div class="choices" id="choices"></div>
                    <div class="feedback" id="feedback">
                        <div><strong id="feedbackTitle"></strong><p id="feedbackText"></p></div>
                        <button class="next-btn" id="nextBtn">Next scene →</button>
                    </div>
                </div>
            </article>
        </section>

        <section class="result" id="result" aria-live="polite">
            <div class="result-card">
                <p class="kicker">Night prayer · lamps checked</p>
                <h2>The house is bright.</h2>
                <div class="scoreline" id="scoreline"></div>
                <div class="pocket-card"><small>Your note for tomorrow</small><p id="pocketText"></p></div>
                <div class="result-actions"><button class="again-btn" id="againBtn">Walk the day again</button><span id="finalScore"></span></div>
            </div>
        </section>

        <aside class="reference">
            <details>
                <summary>The three lamps, in the Baltimore Catechism’s own words</summary>
                <div class="acts">
                    <section class="act"><h3>Faith</h3><p>“I firmly believe that Thou art one God in three Divine Persons… I believe these and all the truths which the Holy Catholic Church teaches, because Thou hast revealed them.”</p></section>
                    <section class="act"><h3>Hope</h3><p>“Relying on Thy infinite goodness and promises, I hope to obtain pardon of my sins, the help of Thy grace, and life everlasting.”</p></section>
                    <section class="act"><h3>Love</h3><p>“I love Thee above all things… I love my neighbor as myself for the love of Thee.”</p></section>
                </div>
            </details>
        </aside>

        <footer>Inspired by Jon’s <a href="https://cooltoolsforcatholics.blogspot.com/2012/05/routine-for-morning-and-evening-prayers.html">Routine for Morning and Evening Prayers from the Baltimore Catechism</a>.</footer>
    </main>

    <script>
        const scenes = [
            {
                time: "7:10 AM · Kitchen",
                label: "The uncertain morning",
                note: "The first light is coming through the curtains.",
                text: "Today’s problem is larger than your current plan. You cannot yet see how it ends. Which response most clearly lights the lamp of hope?",
                answer: "hope",
                choices: [
                    ["faith", "God is truthful, so I will hold fast to what he has revealed."],
                    ["hope", "God’s grace will meet me in this. I’ll take the next faithful step."],
                    ["love", "I’ll notice who else is carrying this and make their burden lighter."]
                ],
                why: "Hope is confident reliance on God’s help and promises. It does not require seeing the whole road, only trusting the Guide enough to take the next step."
            },
            {
                time: "9:35 AM · Work desk",
                label: "The difficult claim",
                note: "Morning has sharpened the edges of everything.",
                text: "A teaching of the Church is difficult to understand. Which response most clearly exercises faith?",
                answer: "faith",
                choices: [
                    ["love", "I’ll be patient with the person who explained it badly."],
                    ["hope", "Understanding can grow; this confusion is not the end of the road."],
                    ["faith", "God cannot deceive. I’ll keep studying without treating confusion as refutation."]
                ],
                why: "Faith trusts the God who reveals. Questions and study belong inside faith; difficulty is not the same thing as disbelief."
            },
            {
                time: "12:20 PM · Hallway",
                label: "The interruption",
                note: "Noon arrives, entirely unconcerned with your inbox.",
                text: "Someone you love interrupts just as you have finally found your concentration. Which response most clearly lights love?",
                answer: "love",
                choices: [
                    ["hope", "This project can survive a pause; time is not my master."],
                    ["love", "I’ll turn fully toward them for a moment, not merely swivel my eyes."],
                    ["faith", "This person bears God’s image whether or not the timing is convenient."]
                ],
                why: "Love is willing the good of the other, concretely. The other answers are true, but charity is the actual turn toward the person in front of you."
            },
            {
                time: "3:45 PM · Rainy road",
                label: "The failed plan",
                note: "Clouds gather. The little path is still there.",
                text: "The outing is cancelled, the backup plan fails, and disappointment begins writing a speech. Which answer is hope at work?",
                answer: "hope",
                choices: [
                    ["love", "I’ll make room for everyone else’s disappointment before solving it."],
                    ["faith", "God remains good even when the afternoon is objectively a bit rubbish."],
                    ["hope", "A good day is still possible. Let’s choose one small thing and begin again."]
                ],
                why: "Hope refuses to treat a closed door as the final word. It expects grace to remain available in the smaller, stranger day that is actually here."
            },
            {
                time: "6:15 PM · Dinner table",
                label: "The unkind shortcut",
                note: "The rain has stopped. Lamps appear in the windows.",
                text: "A juicy story makes an absent person look foolish. Everyone is listening. Which response most clearly belongs to love?",
                answer: "love",
                choices: [
                    ["faith", "Truth matters, including truths about people who are not in the room."],
                    ["love", "I’ll protect their dignity and gently steer the story somewhere kinder."],
                    ["hope", "No one at this table is trapped forever in their worst habit."]
                ],
                why: "Love guards a neighbour’s good name. It does not need an audience, a reward, or a particularly majestic soundtrack."
            },
            {
                time: "9:05 PM · Quiet room",
                label: "The last word",
                note: "Night settles over the house. One light remains.",
                text: "The day ends with more questions than answers. Which response most clearly lights faith before sleep?",
                answer: "faith",
                choices: [
                    ["hope", "Tomorrow can hold grace that today could not yet carry."],
                    ["love", "I’ll ask pardon where I caused hurt and forgive where I was hurt."],
                    ["faith", "I place this unfinished story in the hands of the God who is real and faithful."]
                ],
                why: "Faith rests in God himself, not in a feeling of certainty. The story may be unfinished to us without being abandoned by him."
            }
        ];

        const state = { index: 0, score: 0, lit: { faith: 0, hope: 0, love: 0 }, answered: false };
        const game = document.getElementById('game');
        const result = document.getElementById('result');
        const scenario = document.getElementById('scenario');
        const choices = document.getElementById('choices');
        const feedback = document.getElementById('feedback');

        function chime(kind) {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                const ctx = new AudioContext();
                const notes = kind === 'correct' ? [523.25, 659.25, 783.99] : [311.13, 293.66];
                notes.forEach((freq, i) => {
                    const osc = ctx.createOscillator();
                    const gain = ctx.createGain();
                    osc.type = 'sine'; osc.frequency.value = freq;
                    gain.gain.setValueAtTime(.0001, ctx.currentTime + i * .09);
                    gain.gain.exponentialRampToValueAtTime(.13, ctx.currentTime + i * .09 + .015);
                    gain.gain.exponentialRampToValueAtTime(.0001, ctx.currentTime + i * .09 + .35);
                    osc.connect(gain).connect(ctx.destination);
                    osc.start(ctx.currentTime + i * .09); osc.stop(ctx.currentTime + i * .09 + .37);
                });
            } catch (_) {}
        }

        function render() {
            const item = scenes[state.index];
            state.answered = false;
            document.getElementById('roundNo').textContent = String(state.index + 1).padStart(2, '0');
            document.getElementById('timeLabel').textContent = item.time;
            document.getElementById('sceneLabel').textContent = item.label;
            document.getElementById('dayNote').textContent = item.note;
            document.getElementById('progressText').textContent = `Scene ${state.index + 1} of ${scenes.length}`;
            document.getElementById('dayFill').style.width = `${(state.index / scenes.length) * 100}%`;
            scenario.textContent = item.text;
            choices.innerHTML = '';
            feedback.classList.remove('show');
            item.choices.forEach(([kind, text]) => {
                const button = document.createElement('button');
                button.className = 'choice';
                button.innerHTML = `<strong>${kind[0].toUpperCase() + kind.slice(1)}</strong> · ${text}`;
                button.addEventListener('click', () => answer(button, kind));
                choices.appendChild(button);
            });
            document.getElementById('storyCard').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function answer(button, kind) {
            if (state.answered) return;
            state.answered = true;
            const item = scenes[state.index];
            const correct = kind === item.answer;
            if (correct) state.score++;
            state.lit[item.answer]++;
            [...choices.children].forEach((choice, i) => {
                choice.disabled = true;
                const choiceKind = item.choices[i][0];
                if (choiceKind === item.answer) choice.classList.add('correct');
                else if (choice === button) choice.classList.add('wrong');
            });
            const lamp = document.querySelector(`.lamp[data-kind="${item.answer}"]`);
            const icon = lamp.querySelector('.lamp-icon');
            icon.classList.add('lit', 'pulse');
            setTimeout(() => icon.classList.remove('pulse'), 650);
            lamp.querySelectorAll('i')[state.lit[item.answer] - 1].classList.add('on');
            document.getElementById('feedbackTitle').textContent = correct ? `Yes — ${item.answer}.` : `This scene calls most clearly for ${item.answer}.`;
            document.getElementById('feedbackText').textContent = item.why;
            document.getElementById('nextBtn').textContent = state.index === scenes.length - 1 ? 'Light the evening lamps →' : 'Next scene →';
            feedback.classList.add('show');
            chime(correct ? 'correct' : 'wrong');
        }

        function finish() {
            game.classList.remove('active');
            result.classList.add('show');
            document.getElementById('dayFill').style.width = '100%';
            document.getElementById('scoreline').innerHTML = Object.entries(state.lit).map(([name, count]) => `<span class="score-pill">${name[0].toUpperCase() + name.slice(1)} · ${count}/2 lit</span>`).join('');
            const messages = [
                "Pause once tomorrow and ask: what is true, what may I trust, and who can I love? The right lamp usually becomes clearer.",
                "You do not have to manufacture all the light yourself. Receive what is true, trust the next grace, and turn toward the person nearby.",
                "Ordinary holiness is mostly small lights switched on at the right moment. Tomorrow brings six hundred more chances."
            ];
            document.getElementById('pocketText').textContent = messages[state.score % messages.length];
            document.getElementById('finalScore').textContent = `${state.score} of ${scenes.length} lamps named on the first try`;
            result.scrollIntoView({ behavior: 'smooth', block: 'start' });
            chime('correct');
        }

        document.getElementById('startBtn').addEventListener('click', () => {
            game.classList.add('active');
            render();
        });
        document.getElementById('nextBtn').addEventListener('click', () => {
            if (state.index < scenes.length - 1) { state.index++; render(); } else { finish(); }
        });
        document.getElementById('againBtn').addEventListener('click', () => {
            state.index = 0; state.score = 0; state.lit = { faith: 0, hope: 0, love: 0 };
            document.querySelectorAll('.lamp-icon').forEach(el => el.classList.remove('lit'));
            document.querySelectorAll('.lamp-dots i').forEach(el => el.classList.remove('on'));
            result.classList.remove('show'); game.classList.add('active'); render();
        });
    </script>
</body>
</html>
