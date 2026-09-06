<?php
declare(strict_types=1);
$sourceUrl = 'https://jona.ca/2014/12/fr-larrys-homily.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101b27">
    <title>Hearthkeeper — A Family Rhythm Game</title>
    <style>
        :root {
            --night: #101b27;
            --night-2: #182938;
            --paper: #f1e2c5;
            --ink: #2c211b;
            --ember: #ef6c38;
            --gold: #f4bc58;
            --teal: #4e938c;
            --rose: #bb5d57;
            --shadow: rgba(6, 12, 18, .42);
        }
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--paper);
            font-family: "Avenir Next", Avenir, "Trebuchet MS", sans-serif;
            background:
                radial-gradient(circle at 75% 0%, rgba(62, 111, 122, .24), transparent 35rem),
                linear-gradient(145deg, var(--night), #0b131d 70%);
            overflow-x: hidden;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .28;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.95' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.12'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            z-index: 20;
        }
        a { color: inherit; }
        button { font: inherit; }
        .shell { width: min(1120px, calc(100% - 28px)); margin: 0 auto; padding: 22px 0 54px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; }
        .back, .sound {
            border: 1px solid rgba(241, 226, 197, .23);
            border-radius: 999px;
            background: rgba(8, 16, 24, .35);
            color: #e9d8b9;
            padding: 9px 14px;
            text-decoration: none;
            letter-spacing: .03em;
            cursor: pointer;
        }
        .back:hover, .sound:hover { border-color: var(--gold); }
        .masthead { text-align: center; max-width: 790px; margin: 12px auto 30px; }
        .eyebrow { color: var(--gold); font-size: .73rem; font-weight: 800; letter-spacing: .2em; text-transform: uppercase; }
        h1, h2, .scenario-title, .virtue-name {
            font-family: "Iowan Old Style", "Palatino Linotype", "Book Antiqua", Palatino, serif;
        }
        h1 { margin: 8px 0 6px; font-size: clamp(2.8rem, 8vw, 6.5rem); font-weight: 500; line-height: .88; letter-spacing: -.055em; }
        .subtitle { margin: 18px auto 0; max-width: 620px; color: #c7bda9; line-height: 1.7; }
        .theatre {
            position: relative;
            isolation: isolate;
            margin: 0 auto;
            border: 10px solid #35251d;
            border-radius: 38% 38% 18px 18px / 8% 8% 18px 18px;
            box-shadow: 0 34px 80px #05090e, inset 0 0 0 2px #825334;
            overflow: hidden;
            background: #09121e;
            aspect-ratio: 3 / 2;
        }
        .theatre img { display: block; width: 100%; height: 100%; object-fit: cover; filter: saturate(.58) brightness(.7); transition: filter 1s ease; }
        .theatre::after {
            content: ""; position: absolute; inset: 0; pointer-events: none;
            background: radial-gradient(circle at 51% 68%, rgba(255, 119, 42, var(--fire, .08)), transparent 27%);
            mix-blend-mode: screen; transition: 1s ease;
        }
        .theatre.awake img { filter: saturate(calc(.58 + var(--life, 0) * .007)) brightness(calc(.7 + var(--life, 0) * .004)); }
        .window-glow { position: absolute; border-radius: 50%; opacity: 0; filter: blur(18px); mix-blend-mode: screen; transition: opacity .8s ease; pointer-events: none; }
        .g-love { width: 29%; height: 27%; left: 18%; top: 24%; background: #ffb33d; }
        .g-prayer { width: 27%; height: 28%; right: 15%; top: 22%; background: #ffd987; }
        .g-sacrifice { width: 28%; height: 25%; left: 17%; bottom: 13%; background: #ed7340; }
        .g-forgiveness { width: 27%; height: 25%; right: 14%; bottom: 13%; background: #ef8f72; }
        .chapter-tab {
            position: absolute; top: 18px; left: 18px; z-index: 3;
            background: #e6d4b2; color: #31251e; padding: 8px 13px 7px;
            box-shadow: 4px 5px 0 rgba(38, 23, 17, .42); transform: rotate(-1.5deg);
            font-size: .72rem; text-transform: uppercase; letter-spacing: .13em; font-weight: 800;
        }
        .game-grid { display: grid; grid-template-columns: minmax(0, 1.05fr) minmax(340px, .95fr); gap: 26px; align-items: start; margin-top: 28px; }
        .ledger, .scene-card {
            background: var(--paper); color: var(--ink); border-radius: 7px 18px 9px 16px;
            box-shadow: 10px 16px 0 rgba(3, 9, 14, .22); position: relative;
        }
        .ledger { padding: 24px; transform: rotate(-.25deg); }
        .ledger::before, .scene-card::before { content: ""; position: absolute; inset: 6px; border: 1px solid rgba(77, 53, 35, .22); pointer-events: none; }
        .ledger-head { display: flex; align-items: end; justify-content: space-between; gap: 18px; margin-bottom: 18px; }
        .ledger h2 { margin: 0; font-size: 1.65rem; font-weight: 600; }
        .round { font-size: .75rem; letter-spacing: .11em; text-transform: uppercase; color: #7d6552; }
        .meters { display: grid; gap: 12px; }
        .meter { display: grid; grid-template-columns: 34px 90px 1fr 26px; gap: 9px; align-items: center; }
        .seal { width: 32px; aspect-ratio: 1; display: grid; place-items: center; border-radius: 50%; color: #fff8df; box-shadow: inset 0 0 0 2px rgba(255,255,255,.2); }
        .meter:nth-child(1) .seal, .meter:nth-child(1) .fill { background: #b85246; }
        .meter:nth-child(2) .seal, .meter:nth-child(2) .fill { background: #4b777c; }
        .meter:nth-child(3) .seal, .meter:nth-child(3) .fill { background: #a56b35; }
        .meter:nth-child(4) .seal, .meter:nth-child(4) .fill { background: #987044; }
        .meter label { font-family: "Iowan Old Style", Palatino, serif; font-size: 1rem; }
        .track { height: 9px; background: #d7c3a4; border-radius: 3px; overflow: hidden; box-shadow: inset 0 1px 2px rgba(50,30,20,.2); }
        .fill { width: 0%; height: 100%; transition: width .55s cubic-bezier(.2,.8,.2,1); }
        .count { font-variant-numeric: tabular-nums; color: #7c6653; font-size: .82rem; }
        .hint { margin: 18px 0 0; padding-top: 15px; border-top: 1px dashed #bda789; color: #685342; font-size: .88rem; line-height: 1.5; }
        .scene-card { padding: 30px 30px 26px; min-height: 360px; overflow: hidden; }
        .scene-card::after { content: attr(data-number); position: absolute; right: -7px; bottom: -32px; font: 8rem/1 "Iowan Old Style", serif; color: rgba(117,85,52,.08); }
        .scene-kicker { color: #9b4e3e; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; font-size: .7rem; }
        .scenario-title { font-size: clamp(1.9rem, 4vw, 2.65rem); margin: 8px 0 12px; line-height: 1; }
        .scenario-copy { color: #5d493c; line-height: 1.62; margin: 0 0 20px; max-width: 57ch; }
        .prompt { font-weight: 800; font-size: .77rem; text-transform: uppercase; letter-spacing: .1em; margin-bottom: 10px; }
        .choices { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .choice {
            position: relative; z-index: 2; min-height: 78px; text-align: left; border: 1px solid #bca384;
            padding: 12px 13px; background: rgba(255,255,255,.24); color: var(--ink); cursor: pointer;
            transition: transform .17s ease, background .17s ease, box-shadow .17s ease;
        }
        .choice:hover, .choice:focus-visible { transform: translateY(-3px) rotate(-.4deg); background: #fff7e5; box-shadow: 4px 5px 0 #c8aa7d; outline: none; }
        .choice strong { display: block; font-family: "Iowan Old Style", Palatino, serif; font-size: 1.13rem; }
        .choice span { display: block; margin-top: 3px; color: #725b49; font-size: .75rem; line-height: 1.3; }
        .reveal { display: none; position: relative; z-index: 3; }
        .reveal.show { display: block; animation: lift .45s ease both; }
        .verdict { display: inline-block; background: #283c39; color: #fff0d4; padding: 5px 9px; font-size: .69rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }
        .reveal h3 { font: 2rem/1 "Iowan Old Style", serif; margin: 14px 0 9px; }
        .reveal p { color: #5d493c; line-height: 1.6; }
        .next, .restart {
            position: relative; z-index: 3; border: 0; background: var(--ember); color: white; padding: 12px 18px;
            box-shadow: 4px 5px 0 #78351f; cursor: pointer; font-weight: 800; letter-spacing: .04em;
        }
        .next:hover, .restart:hover { transform: translate(1px, 1px); box-shadow: 3px 4px 0 #78351f; }
        .final { display: none; text-align: center; position: relative; z-index: 3; }
        .final.show { display: block; animation: lift .55s ease both; }
        .final-mark { font-size: 3.5rem; filter: drop-shadow(0 5px 0 #c2a981); }
        .final h2 { font-size: 2.4rem; margin: 6px 0 10px; }
        .final p { line-height: 1.6; color: #5c493d; }
        .rule { margin: 42px auto 0; max-width: 720px; text-align: center; color: #b8ac98; line-height: 1.7; }
        .rule strong { color: var(--gold); }
        .source { display: inline-block; margin-top: 12px; color: #ead7b4; text-underline-offset: 4px; }
        .sparks { position: fixed; inset: 0; pointer-events: none; z-index: 30; }
        .spark { position: absolute; width: 7px; height: 7px; background: var(--gold); border-radius: 50% 50% 50% 0; animation: spark 1.1s ease-out forwards; }
        @keyframes spark { to { transform: translate(var(--dx), -100px) rotate(260deg); opacity: 0; } }
        @keyframes lift { from { opacity: 0; transform: translateY(10px) rotate(.3deg); } }
        @media (max-width: 790px) {
            .shell { width: min(100% - 18px, 620px); padding-top: 12px; }
            .game-grid { grid-template-columns: 1fr; }
            .theatre { border-width: 6px; border-radius: 26% 26% 12px 12px / 7% 7% 12px 12px; }
            .ledger { order: 2; }
            .scene-card { order: 1; min-height: 410px; }
        }
        @media (max-width: 470px) {
            .topbar { font-size: .78rem; }
            h1 { font-size: 3.35rem; }
            .subtitle { font-size: .92rem; }
            .choices { grid-template-columns: 1fr 1fr; }
            .choice { min-height: 90px; padding: 10px; }
            .choice span { font-size: .7rem; }
            .scene-card { padding: 25px 20px 22px; }
            .ledger { padding: 21px 16px; }
            .meter { grid-template-columns: 30px 77px 1fr 20px; gap: 6px; }
            .seal { width: 28px; }
            .chapter-tab { top: 9px; left: 9px; padding: 6px 9px; font-size: .58rem; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; } }
    </style>
</head>
<body>
<div class="sparks" id="sparks" aria-hidden="true"></div>
<main class="shell">
    <nav class="topbar" aria-label="Page controls">
        <a class="back" href="./">← Chloe Reads Jon</a>
        <button class="sound" id="sound" type="button" aria-pressed="false">Sound: off</button>
    </nav>

    <header class="masthead">
        <div class="eyebrow">A six-scene family rhythm</div>
        <h1>Hearthkeeper</h1>
        <p class="subtitle">A house stays warm through more than affection. Tend love, prayer, sacrifice, and forgiveness through one ordinary, slightly unruly evening.</p>
    </header>

    <section class="theatre" id="theatre" aria-label="A cut-paper family house that brightens as the game progresses">
        <img src="assets/hearthkeeper-house.webp" alt="A hand-cut paper house at blue hour, with a kitchen, prayer corner, workshop, front hall, and glowing central hearth">
        <span class="window-glow g-love" id="glow-love"></span>
        <span class="window-glow g-prayer" id="glow-prayer"></span>
        <span class="window-glow g-sacrifice" id="glow-sacrifice"></span>
        <span class="window-glow g-forgiveness" id="glow-forgiveness"></span>
        <span class="chapter-tab">The house remembers every choice</span>
    </section>

    <section class="game-grid" aria-live="polite">
        <aside class="ledger">
            <div class="ledger-head">
                <h2>The four coals</h2>
                <span class="round" id="round">Scene 1 of 6</span>
            </div>
            <div class="meters">
                <div class="meter"><span class="seal">♥</span><label>Love</label><span class="track"><span class="fill" id="bar-love"></span></span><span class="count" id="count-love">0</span></div>
                <div class="meter"><span class="seal">✦</span><label>Prayer</label><span class="track"><span class="fill" id="bar-prayer"></span></span><span class="count" id="count-prayer">0</span></div>
                <div class="meter"><span class="seal">◆</span><label>Sacrifice</label><span class="track"><span class="fill" id="bar-sacrifice"></span></span><span class="count" id="count-sacrifice">0</span></div>
                <div class="meter"><span class="seal">↻</span><label>Forgiveness</label><span class="track"><span class="fill" id="bar-forgiveness"></span></span><span class="count" id="count-forgiveness">0</span></div>
            </div>
            <p class="hint" id="hint">There are no villain buttons here. Choose the <em>first movement</em> the moment needs most; a strong hearth eventually needs all four.</p>
        </aside>

        <article class="scene-card" id="card" data-number="1">
            <div id="question">
                <div class="scene-kicker" id="kicker"></div>
                <h2 class="scenario-title" id="scene-title"></h2>
                <p class="scenario-copy" id="scene-copy"></p>
                <div class="prompt">Which coal do you tend first?</div>
                <div class="choices" id="choices"></div>
            </div>
            <div class="reveal" id="reveal">
                <span class="verdict" id="verdict"></span>
                <h3 id="reveal-title"></h3>
                <p id="reveal-copy"></p>
                <button class="next" id="next" type="button">Next room →</button>
            </div>
            <div class="final" id="final">
                <div class="final-mark">⌂</div>
                <h2 id="final-title">The windows are warm.</h2>
                <p id="final-copy"></p>
                <button class="restart" id="restart" type="button">Walk the evening again</button>
            </div>
        </article>
    </section>

    <footer class="rule">
        <p><strong>The hearthkeeper’s rule:</strong> love gives itself; prayer returns to the Source; sacrifice joins the two; forgiveness opens the door again.</p>
        <a class="source" href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>">Inspired by Jon’s “Fr. Larry’s homily”</a>
    </footer>
</main>

<script>
(() => {
    const virtues = {
        love: { name: 'Love', icon: '♥', action: 'Offer presence', tone: 261.63 },
        prayer: { name: 'Prayer', icon: '✦', action: 'Return to the Source', tone: 329.63 },
        sacrifice: { name: 'Sacrifice', icon: '◆', action: 'Give up the easier thing', tone: 392.00 },
        forgiveness: { name: 'Forgiveness', icon: '↻', action: 'Open the way back', tone: 523.25 }
    };
    const scenes = [
        {
            kicker: '5:17 PM · The front hall', title: 'The answer that was mostly a grunt',
            copy: 'Someone comes home carrying a day that did not go well. You ask a question; the answer has one syllable and several thorns.', ideal: 'love',
            responses: {
                love: 'Stay nearby without demanding the story. Make tea, leave room, and let your presence say, “You do not have to be pleasant to be loved.”',
                prayer: 'A silent prayer steadies you, but this moment also needs love to become visible and take a chair beside them.',
                sacrifice: 'You can surrender the tidy evening you expected. Let that sacrifice turn into patient, undramatic company.',
                forgiveness: 'Do not keep a ledger of the grunt. Forgiveness is already propping the door open for the conversation that may come later.'
            }
        },
        {
            kicker: '5:46 PM · The kitchen', title: 'Dinner has become a weather system',
            copy: 'The pan is smoking, homework is missing, and a glass has achieved the sort of spill that reaches three postal codes.', ideal: 'prayer',
            responses: {
                love: 'Love reaches for the towel, not the lecture. Good instinct. A breath toward the Source can keep the towel from becoming a flag of surrender.',
                prayer: 'Pause for one honest breath: “God, give me the love I do not currently possess.” Then meet the spill, not the catastrophe in your head.',
                sacrifice: 'The fantasy of a graceful supper can go into the bin beside the burnt bits. There is freedom in serving the evening you actually have.',
                forgiveness: 'Release the blame before it finds a target. The glass did not conspire against the family, despite persuasive evidence.'
            }
        },
        {
            kicker: '6:32 PM · The workshop', title: 'The project with one chair',
            copy: 'There is a half-built model on the table and only one good seat beside it. Your own list is long. The invitation is not spoken, but it is unmistakable.', ideal: 'sacrifice',
            responses: {
                love: 'Love notices the unspoken invitation. To answer it fully, it may need to spend the scarce currency of your planned hour.',
                prayer: 'Ask for eyes to see what matters now. The answer may look suspiciously like sitting in the less comfortable chair.',
                sacrifice: 'Put the list face-down. Take the awkward chair. Give twenty wholehearted minutes rather than an hour of divided attention.',
                forgiveness: 'If earlier friction is keeping you away, forgiveness can clear the path. Then the gift is to sit down and build.'
            }
        },
        {
            kicker: '7:08 PM · The stairs', title: 'The sentence you wish you could catch',
            copy: 'You hear your own sharp words land. The room goes quiet in that very particular way that means everyone heard them.', ideal: 'forgiveness',
            responses: {
                love: 'Love refuses to protect your pride at someone else’s expense. Its next honest form is a clean apology.',
                prayer: 'A quick “help me tell the truth” can get you unstuck. Do not let the prayer become a pious waiting room.',
                sacrifice: 'Give up being technically right. It is a remarkably expensive little possession, and the house is warmer without it.',
                forgiveness: 'Turn back promptly: “That was sharp and unfair. I’m sorry. You didn’t deserve it.” No defence brief stapled to the apology.'
            }
        },
        {
            kicker: '8:14 PM · The quiet corner', title: 'Everyone is running on fumes',
            copy: 'Nothing is dramatically wrong. That may be why the emptiness is easy to miss. Patience is thin; the family battery shows one red pixel.', ideal: 'prayer',
            responses: {
                love: 'Gather everyone gently, without making tired people perform enthusiasm. Love can carry them to the well.',
                prayer: 'Use the smallest faithful form: one candle, one thank-you, one petition, one minute of quiet. Refill before asking the family to pour more out.',
                sacrifice: 'Sacrifice the impressive routine. Tonight, brevity is not laziness; it is mercy with excellent timing.',
                forgiveness: 'Let the day’s small offences expire. Not every irritation deserves an archaeological expedition.'
            }
        },
        {
            kicker: '9:03 PM · The last lamp', title: 'The house is imperfect and still yours',
            copy: 'The sink is not empty. The problem is not solved. Someone is still a little hurt. You have enough energy for one final movement.', ideal: 'love',
            responses: {
                love: 'Choose one small, legible act: a glass of water, a blanket, a kind sentence, a hand on a shoulder. End with love made concrete.',
                prayer: 'Place the unfinished house in God’s hands. Tomorrow does not require you to pretend that you are Providence tonight.',
                sacrifice: 'Do one quiet task that makes morning gentler, then stop. Martyrdom by dishwasher is not on the programme.',
                forgiveness: 'Say, “We can begin again tomorrow.” Forgiveness is not denial; it is refusing to lock the night from the inside.'
            }
        }
    ];

    let index = 0;
    let scores = { love: 0, prayer: 0, sacrifice: 0, forgiveness: 0 };
    let matched = 0;
    let soundOn = false;
    let audio;
    const $ = id => document.getElementById(id);
    const choices = $('choices');

    function render() {
        const scene = scenes[index];
        $('card').dataset.number = String(index + 1);
        $('round').textContent = `Scene ${index + 1} of ${scenes.length}`;
        $('kicker').textContent = scene.kicker;
        $('scene-title').textContent = scene.title;
        $('scene-copy').textContent = scene.copy;
        $('question').hidden = false;
        $('reveal').classList.remove('show');
        $('final').classList.remove('show');
        choices.innerHTML = '';
        Object.entries(virtues).forEach(([key, virtue]) => {
            const button = document.createElement('button');
            button.className = 'choice';
            button.type = 'button';
            button.innerHTML = `<strong>${virtue.icon} ${virtue.name}</strong><span>${virtue.action}</span>`;
            button.addEventListener('click', event => choose(key, event));
            choices.appendChild(button);
        });
    }

    function choose(key, event) {
        const scene = scenes[index];
        scores[key]++;
        const isMatch = key === scene.ideal;
        if (isMatch) matched++;
        $('question').hidden = true;
        $('verdict').textContent = isMatch ? 'The needed first movement' : 'A true coal, used at an angle';
        $('reveal-title').textContent = `${virtues[key].name} enters the room`;
        $('reveal-copy').textContent = scene.responses[key];
        $('next').textContent = index === scenes.length - 1 ? 'See the house at rest →' : 'Next room →';
        $('reveal').classList.add('show');
        updateHouse();
        sparks(event.clientX || innerWidth / 2, event.clientY || innerHeight / 2, isMatch ? 14 : 7);
        playTone(virtues[key].tone, isMatch);
    }

    function updateHouse() {
        const total = Object.values(scores).reduce((a, b) => a + b, 0);
        $('theatre').classList.add('awake');
        $('theatre').style.setProperty('--life', Math.min(total * 13, 48));
        $('theatre').style.setProperty('--fire', Math.min(.1 + total * .045, .42));
        Object.keys(scores).forEach(key => {
            $(`bar-${key}`).style.width = `${Math.min(scores[key] * 34, 100)}%`;
            $(`count-${key}`).textContent = scores[key];
            $(`glow-${key}`).style.opacity = Math.min(scores[key] * .24, .58);
        });
    }

    function finish() {
        $('reveal').classList.remove('show');
        $('round').textContent = 'House at rest';
        const used = Object.values(scores).filter(Boolean).length;
        const balance = used === 4 ? 'You called on all four coals' : used === 3 ? 'Three coals carried this evening' : 'You found a strong favourite coal';
        $('final-title').textContent = matched >= 5 ? 'You read the rooms beautifully.' : matched >= 3 ? 'The windows are warm.' : 'The door stayed open.';
        $('final-copy').innerHTML = `${balance}, and found the clearest first movement in <strong>${matched} of ${scenes.length}</strong> rooms. A family does not need a perfect evening. It needs ways to return: to one another, to the Source, to generous action, and through the open door of forgiveness.`;
        $('final').classList.add('show');
        $('theatre').style.setProperty('--life', 55);
        $('theatre').style.setProperty('--fire', .5);
        playChord();
    }

    $('next').addEventListener('click', () => {
        if (index === scenes.length - 1) finish();
        else { index++; render(); }
    });
    $('restart').addEventListener('click', () => {
        index = 0; matched = 0; scores = { love: 0, prayer: 0, sacrifice: 0, forgiveness: 0 };
        $('theatre').style.setProperty('--life', 0); $('theatre').style.setProperty('--fire', .08);
        Object.keys(scores).forEach(key => { $(`bar-${key}`).style.width = '0%'; $(`count-${key}`).textContent = '0'; $(`glow-${key}`).style.opacity = 0; });
        render(); window.scrollTo({ top: $('theatre').offsetTop - 12, behavior: 'smooth' });
    });
    $('sound').addEventListener('click', () => {
        soundOn = !soundOn;
        $('sound').textContent = `Sound: ${soundOn ? 'on' : 'off'}`;
        $('sound').setAttribute('aria-pressed', String(soundOn));
        if (soundOn) playTone(392, true);
    });

    function playTone(frequency, warm) {
        if (!soundOn) return;
        audio ||= new (window.AudioContext || window.webkitAudioContext)();
        const osc = audio.createOscillator(), gain = audio.createGain();
        osc.type = warm ? 'sine' : 'triangle'; osc.frequency.value = frequency;
        gain.gain.setValueAtTime(.0001, audio.currentTime);
        gain.gain.exponentialRampToValueAtTime(.12, audio.currentTime + .025);
        gain.gain.exponentialRampToValueAtTime(.0001, audio.currentTime + .65);
        osc.connect(gain).connect(audio.destination); osc.start(); osc.stop(audio.currentTime + .7);
    }
    function playChord() { [261.63, 329.63, 392, 523.25].forEach((tone, i) => setTimeout(() => playTone(tone, true), i * 140)); }
    function sparks(x, y, amount) {
        for (let i = 0; i < amount; i++) {
            const s = document.createElement('i'); s.className = 'spark';
            s.style.left = `${x}px`; s.style.top = `${y}px`; s.style.setProperty('--dx', `${(Math.random() - .5) * 110}px`);
            $('sparks').appendChild(s); setTimeout(() => s.remove(), 1200);
        }
    }
    render();
})();
</script>
</body>
</html>
