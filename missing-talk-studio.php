<?php
// A self-contained rehearsal tool inspired by a slide deck that needed its speaker.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#182a33">
    <title>The Missing Talk Studio</title>
    <style>
        :root {
            --ink: #182a33;
            --paper: #f3ebd6;
            --mustard: #e7a92f;
            --tomato: #db6048;
            --mint: #9ac6a8;
            --blue: #4c8993;
            --shadow: #0d1b22;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 12% 8%, rgba(231,169,47,.16), transparent 25rem),
                linear-gradient(rgba(24,42,51,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(24,42,51,.035) 1px, transparent 1px),
                var(--paper);
            background-size: auto, 24px 24px, 24px 24px, auto;
            font-family: "Courier New", Courier, monospace;
            min-height: 100vh;
        }
        button, input, textarea, select { font: inherit; }
        button { color: inherit; }
        .topbar {
            min-height: 58px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px clamp(16px, 4vw, 54px);
            border-bottom: 2px solid var(--ink);
            background: rgba(243,235,214,.88);
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .brand { font-weight: 500; letter-spacing: -.04em; }
        .lamp {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .12em;
        }
        .lamp::before {
            content: "";
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: var(--tomato);
            box-shadow: 0 0 0 3px rgba(219,96,72,.2);
            animation: breathe 2.4s ease-in-out infinite;
        }
        @keyframes breathe { 50% { box-shadow: 0 0 0 8px rgba(219,96,72,0); } }
        main { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(260px, .75fr);
            gap: clamp(28px, 7vw, 96px);
            align-items: end;
            min-height: 530px;
            padding: 74px 0 56px;
        }
        .kicker {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            text-transform: uppercase;
            letter-spacing: .16em;
            font-size: .7rem;
            border-bottom: 2px solid var(--tomato);
            padding-bottom: 5px;
        }
        h1, h2, h3 { font-family: "Bookman Old Style", "Iowan Old Style", Georgia, serif; }
        h1 {
            margin: 20px 0 20px;
            max-width: 760px;
            font-size: clamp(3.3rem, 9vw, 7.8rem);
            line-height: .82;
            letter-spacing: -.075em;
        }
        h1 em { color: var(--tomato); font-style: italic; font-weight: 600; }
        .lede {
            font-size: clamp(.95rem, 1.6vw, 1.14rem);
            line-height: 1.75;
            max-width: 650px;
        }
        .projector {
            aspect-ratio: 1 / 1.08;
            background: var(--ink);
            color: var(--paper);
            padding: 34px;
            position: relative;
            box-shadow: 13px 13px 0 var(--mustard);
            transform: rotate(1.5deg);
            overflow: hidden;
        }
        .projector::after {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(0deg, transparent 0 5px, rgba(255,255,255,.025) 6px);
            pointer-events: none;
        }
        .slide-no { color: var(--mustard); font-size: .72rem; letter-spacing: .15em; }
        .projector blockquote {
            font-family: "Bookman Old Style", Georgia, serif;
            font-size: clamp(1.45rem, 3vw, 2.4rem);
            line-height: 1.05;
            margin: 20% 0 0;
        }
        .projector small { display: block; margin-top: 20px; opacity: .62; line-height: 1.5; }
        .workbench {
            border-top: 2px solid var(--ink);
            border-bottom: 2px solid var(--ink);
            display: grid;
            grid-template-columns: 340px 1fr;
            min-height: 620px;
        }
        .controls {
            padding: 38px 32px 38px 0;
            border-right: 2px solid var(--ink);
        }
        h2 { font-size: clamp(2rem, 4vw, 3.4rem); letter-spacing: -.045em; margin: 0 0 10px; }
        .hint { font-size: .75rem; line-height: 1.55; opacity: .68; margin: 0 0 28px; }
        label {
            display: block;
            text-transform: uppercase;
            letter-spacing: .1em;
            font-size: .67rem;
            margin: 18px 0 7px;
        }
        input, textarea, select {
            width: 100%;
            border: 1.5px solid var(--ink);
            border-radius: 0;
            background: rgba(255,255,255,.35);
            color: var(--ink);
            padding: 12px;
            outline: none;
        }
        textarea { resize: vertical; min-height: 78px; }
        input:focus, textarea:focus, select:focus { box-shadow: 4px 4px 0 var(--mint); }
        .duration-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .primary, .ghost, .tiny {
            border: 1.5px solid var(--ink);
            cursor: pointer;
            transition: transform .14s ease, box-shadow .14s ease, background .14s ease;
        }
        .primary {
            width: 100%;
            background: var(--mustard);
            font-weight: 500;
            padding: 14px 18px;
            margin-top: 22px;
            box-shadow: 5px 5px 0 var(--ink);
        }
        .primary:hover, .primary:focus-visible { transform: translate(-2px,-2px); box-shadow: 7px 7px 0 var(--ink); }
        .primary:active { transform: translate(3px,3px); box-shadow: 2px 2px 0 var(--ink); }
        .deck-area { padding: 38px 0 48px 38px; min-width: 0; }
        .deck-header { display: flex; justify-content: space-between; gap: 18px; align-items: end; margin-bottom: 26px; }
        .deck-header p { margin: 0; font-size: .7rem; opacity: .65; text-align: right; }
        .cards { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
        .cue {
            position: relative;
            min-height: 230px;
            background: #fffaf0;
            border: 1.5px solid var(--ink);
            padding: 24px 22px 20px;
            box-shadow: 5px 5px 0 rgba(24,42,51,.18);
            opacity: 0;
            transform: translateY(12px);
            animation: cardIn .42s forwards;
        }
        @keyframes cardIn { to { opacity: 1; transform: none; } }
        .cue:nth-child(2n) { background: #e9f1e7; }
        .cue:nth-child(3n) { background: #f7dfd5; }
        .cue-top { display: flex; justify-content: space-between; align-items: center; font-size: .68rem; text-transform: uppercase; letter-spacing: .1em; }
        .cue h3 { font-size: 1.75rem; margin: 20px 0 8px; line-height: 1; }
        .cue .prompt { font-size: .76rem; line-height: 1.5; opacity: .76; min-height: 48px; }
        .cue textarea { min-height: 66px; border-width: 0 0 1.5px; padding: 9px 2px; background: transparent; font-size: .78rem; }
        .stage-launch { display: flex; justify-content: flex-end; margin-top: 24px; }
        .ghost { background: var(--ink); color: var(--paper); padding: 13px 22px; }
        .ghost:hover { background: var(--tomato); }
        .stage {
            position: fixed;
            inset: 0;
            background: var(--ink);
            color: var(--paper);
            z-index: 100;
            display: none;
            grid-template-rows: auto 1fr auto;
            padding: clamp(18px, 4vw, 50px);
        }
        .stage.open { display: grid; animation: curtain .35s ease-out; }
        @keyframes curtain { from { opacity: 0; transform: scale(.985); } }
        .stage-top, .stage-bottom { display: flex; justify-content: space-between; align-items: center; gap: 16px; }
        .tiny { padding: 9px 13px; background: transparent; color: var(--paper); border-color: rgba(243,235,214,.45); }
        .tiny:hover { border-color: var(--mustard); color: var(--mustard); }
        .clock {
            font-family: "Bookman Old Style", Georgia, serif;
            font-size: clamp(2rem, 5vw, 4rem);
            color: var(--mustard);
            font-variant-numeric: tabular-nums;
        }
        .stage-card {
            align-self: center;
            width: min(820px, 100%);
            margin: 0 auto;
        }
        .stage-card .stage-label { color: var(--mint); text-transform: uppercase; letter-spacing: .16em; font-size: .74rem; }
        .stage-card h2 { font-size: clamp(3.5rem, 10vw, 8.5rem); line-height: .88; margin: 18px 0 28px; color: var(--paper); }
        .stage-prompt { font-size: clamp(.95rem, 2vw, 1.3rem); max-width: 720px; line-height: 1.65; color: #c9d2ce; }
        .stage-note {
            margin-top: 24px;
            border-left: 4px solid var(--tomato);
            padding: 5px 0 5px 18px;
            font-family: "Bookman Old Style", Georgia, serif;
            font-size: clamp(1.1rem, 2.5vw, 1.65rem);
            line-height: 1.35;
        }
        .progress { height: 5px; background: rgba(255,255,255,.15); flex: 1; max-width: 420px; }
        .progress i { display: block; height: 100%; background: var(--mustard); transition: width .3s ease; }
        .source {
            padding: 58px 0 70px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
            font-size: .76rem;
            line-height: 1.7;
        }
        .source a { color: var(--ink); text-decoration-thickness: 2px; text-underline-offset: 4px; }
        .source .mark { font-family: "Bookman Old Style", Georgia, serif; font-size: 3rem; color: var(--tomato); line-height: 1; }
        @media (max-width: 800px) {
            .hero { grid-template-columns: 1fr; min-height: auto; padding-top: 50px; }
            .projector { width: min(430px, calc(100% - 12px)); justify-self: center; }
            .workbench { grid-template-columns: 1fr; }
            .controls { border-right: 0; border-bottom: 2px solid var(--ink); padding-right: 0; }
            .deck-area { padding-left: 0; }
        }
        @media (max-width: 560px) {
            main { width: min(100% - 24px, 1180px); }
            .topbar { padding-inline: 12px; }
            .lamp span { display: none; }
            .hero { padding-top: 38px; }
            .projector { padding: 26px; }
            .cards { grid-template-columns: 1fr; }
            .deck-header { align-items: start; }
            .deck-header p { display: none; }
            .source { flex-direction: column-reverse; }
            .stage-bottom { font-size: .68rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">MISSING TALK / STUDIO 17</div>
        <div class="lamp"><span>rehearsal light</span></div>
    </header>

    <main>
        <section class="hero">
            <div>
                <span class="kicker">A pocket stage manager</span>
                <h1>Make the slides <em>speak.</em></h1>
                <p class="lede">A deck is scenery. You are the talk. Turn one idea into six timed cues, add the details only you know, then rehearse without hiding behind bullet points.</p>
            </div>
            <aside class="projector" aria-label="A sample enigmatic presentation slide">
                <span class="slide-no">SLIDE 12 / 12</span>
                <blockquote>“The slides won’t make sense without the accompanying talk.”</blockquote>
                <small>Good. That means the human still matters.</small>
            </aside>
        </section>

        <section class="workbench" id="workbench">
            <form class="controls" id="talkForm">
                <h2>Build the spine.</h2>
                <p class="hint">Give the studio one honest sentence. It will make a route, not write the talk for you.</p>

                <label for="topic">Talk title or topic</label>
                <input id="topic" maxlength="90" value="Prayer and Scripture" autocomplete="off">

                <label for="audience">Who is in the room?</label>
                <input id="audience" maxlength="90" value="Couples who have had a long week" autocomplete="off">

                <label for="idea">One thing they should carry home</label>
                <textarea id="idea" maxlength="220">Scripture can become a conversation, not merely a reading.</textarea>

                <div class="duration-row">
                    <div>
                        <label for="minutes">Minutes</label>
                        <select id="minutes">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30" selected>30</option>
                            <option value="45">45</option>
                            <option value="60">60</option>
                        </select>
                    </div>
                    <div>
                        <label for="energy">Room energy</label>
                        <select id="energy">
                            <option value="quiet">Quiet</option>
                            <option value="curious" selected>Curious</option>
                            <option value="lively">Lively</option>
                            <option value="skeptical">Skeptical</option>
                        </select>
                    </div>
                </div>
                <button class="primary" type="submit">Cut six cue cards →</button>
            </form>

            <div class="deck-area">
                <div class="deck-header">
                    <div>
                        <span class="kicker">Your run of show</span>
                        <h2 id="deckTitle">Prayer and Scripture</h2>
                    </div>
                    <p>Notes stay in this browser.<br>⌘/Ctrl + Enter to rehearse.</p>
                </div>
                <div class="cards" id="cards"></div>
                <div class="stage-launch">
                    <button class="ghost" id="rehearse" type="button">Dim the lights &amp; rehearse</button>
                </div>
            </div>
        </section>

        <footer class="source">
            <p>Born from the charming fact that slides are sometimes deliberately incomplete.<br>
                Inspired by Jon’s <a href="https://jona.ca/2017/03/slides-from-prayer-and-scripture-talk.html" target="_blank" rel="noopener">“Slides from ‘Prayer and Scripture’ talk”</a>.
            </p>
            <div class="mark" aria-hidden="true">¶</div>
        </footer>
    </main>

    <section class="stage" id="stage" aria-hidden="true">
        <div class="stage-top">
            <button class="tiny" id="closeStage" type="button">× leave stage</button>
            <div class="clock" id="clock">00:00</div>
            <button class="tiny" id="clockToggle" type="button">pause</button>
        </div>
        <div class="stage-card">
            <div class="stage-label" id="stageLabel"></div>
            <h2 id="stageTitle"></h2>
            <p class="stage-prompt" id="stagePrompt"></p>
            <div class="stage-note" id="stageNote"></div>
        </div>
        <div class="stage-bottom">
            <span>← previous · space pause · next →</span>
            <div class="progress"><i id="progressBar"></i></div>
            <span id="stageCount">1 / 6</span>
        </div>
    </section>

    <script>
        (() => {
            const form = document.getElementById('talkForm');
            const cardsEl = document.getElementById('cards');
            const stage = document.getElementById('stage');
            const storeKey = 'missing-talk-studio-v1';
            let cues = [];
            let current = 0;
            let remaining = 0;
            let timer = null;
            let running = false;

            const shapes = [
                { title: 'Open the door', share: .10, prompt: (d) => `Name the room as it really is: ${d.audience}. Ask one vivid question or show one object. Earn their attention before explaining anything.` },
                { title: 'Tell one scene', share: .18, prompt: (d) => `Give them a moment, not a résumé. What happened that made “${d.topic}” matter to you? Include a place, a choice, and one tiny detail.` },
                { title: 'Place the anchor', share: .19, prompt: (d) => `${d.energy === 'skeptical' ? 'Offer evidence they can inspect.' : 'Read or show the one line everything hangs from.'} Then be silent for three beats. Let it arrive before you interpret it.` },
                { title: 'Turn the prism', share: .25, prompt: (d) => `Unpack the central idea: “${d.idea}” Show it from two angles: why it is difficult, and why it is worth doing anyway.` },
                { title: 'Try it together', share: .18, prompt: (d) => `${d.energy === 'lively' ? 'Make the room do something with a partner.' : 'Offer a small, low-pressure experiment.'} It should be possible before tomorrow and explainable in one sentence.` },
                { title: 'Leave a handle', share: .10, prompt: (d) => `Return to your opening image. Give ${d.audience.toLowerCase()} one phrase they can remember in the car, then stop before you dilute it.` }
            ];

            function readForm() {
                return {
                    topic: document.getElementById('topic').value.trim() || 'The untitled talk',
                    audience: document.getElementById('audience').value.trim() || 'People in the room',
                    idea: document.getElementById('idea').value.trim() || 'This matters in ordinary life.',
                    minutes: Number(document.getElementById('minutes').value),
                    energy: document.getElementById('energy').value
                };
            }

            function distribute(total, shares) {
                let seconds = total * 60;
                const result = shares.map(s => Math.max(30, Math.round(seconds * s / 15) * 15));
                const diff = seconds - result.reduce((a,b) => a + b, 0);
                result[3] += diff;
                return result;
            }

            function formatTime(seconds) {
                const m = Math.max(0, Math.floor(seconds / 60)).toString().padStart(2,'0');
                const s = Math.max(0, seconds % 60).toString().padStart(2,'0');
                return `${m}:${s}`;
            }

            function build(save = true) {
                const data = readForm();
                const times = distribute(data.minutes, shapes.map(x => x.share));
                const oldNotes = cues.map(c => c.note);
                cues = shapes.map((shape, i) => ({
                    ...shape,
                    seconds: times[i],
                    promptText: shape.prompt(data),
                    note: oldNotes[i] || ''
                }));
                document.getElementById('deckTitle').textContent = data.topic;
                cardsEl.innerHTML = cues.map((cue, i) => `
                    <article class="cue" style="animation-delay:${i * 55}ms">
                        <div class="cue-top"><span>cue ${String(i+1).padStart(2,'0')}</span><span>${formatTime(cue.seconds)}</span></div>
                        <h3>${escapeHtml(cue.title)}</h3>
                        <p class="prompt">${escapeHtml(cue.promptText)}</p>
                        <textarea data-note="${i}" aria-label="Private note for ${escapeHtml(cue.title)}" placeholder="Your detail, story, line…">${escapeHtml(cue.note)}</textarea>
                    </article>`).join('');
                cardsEl.querySelectorAll('textarea').forEach(el => el.addEventListener('input', e => {
                    cues[Number(e.target.dataset.note)].note = e.target.value;
                    persist();
                }));
                if (save) persist();
            }

            function escapeHtml(text) {
                return String(text).replace(/[&<>"']/g, ch => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[ch]));
            }

            function persist() {
                const data = readForm();
                data.notes = cues.map(c => c.note);
                localStorage.setItem(storeKey, JSON.stringify(data));
            }

            function restore() {
                try {
                    const data = JSON.parse(localStorage.getItem(storeKey));
                    if (!data) return build(false);
                    ['topic','audience','idea','minutes','energy'].forEach(id => {
                        if (data[id] !== undefined) document.getElementById(id).value = data[id];
                    });
                    build(false);
                    (data.notes || []).forEach((note, i) => { if (cues[i]) cues[i].note = note; });
                    build(false);
                } catch (_) { build(false); }
            }

            function showCue(index) {
                current = Math.max(0, Math.min(cues.length - 1, index));
                const cue = cues[current];
                document.getElementById('stageLabel').textContent = `Cue ${current + 1} · ${formatTime(cue.seconds)}`;
                document.getElementById('stageTitle').textContent = cue.title;
                document.getElementById('stagePrompt').textContent = cue.promptText;
                const note = document.getElementById('stageNote');
                note.textContent = cue.note || 'No private note. Speak from the room in front of you.';
                note.style.opacity = cue.note ? '1' : '.45';
                document.getElementById('stageCount').textContent = `${current + 1} / ${cues.length}`;
                document.getElementById('progressBar').style.width = `${((current + 1) / cues.length) * 100}%`;
                remaining = cue.seconds;
                updateClock();
            }

            function updateClock() {
                const clock = document.getElementById('clock');
                clock.textContent = formatTime(remaining);
                clock.style.color = remaining <= 15 ? 'var(--tomato)' : 'var(--mustard)';
            }

            function setRunning(next) {
                running = next;
                document.getElementById('clockToggle').textContent = running ? 'pause' : 'resume';
                clearInterval(timer);
                if (running) timer = setInterval(() => {
                    if (remaining > 0) {
                        remaining--;
                        updateClock();
                    } else if (current < cues.length - 1) {
                        showCue(current + 1);
                    } else {
                        setRunning(false);
                        document.getElementById('clockToggle').textContent = 'finished';
                    }
                }, 1000);
            }

            function openStage() {
                if (!cues.length) build();
                showCue(0);
                stage.classList.add('open');
                stage.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                setRunning(true);
            }

            function closeStage() {
                setRunning(false);
                stage.classList.remove('open');
                stage.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            form.addEventListener('submit', e => {
                e.preventDefault();
                build();
                document.querySelector('.deck-area').scrollIntoView({behavior:'smooth', block:'start'});
            });
            document.getElementById('rehearse').addEventListener('click', openStage);
            document.getElementById('closeStage').addEventListener('click', closeStage);
            document.getElementById('clockToggle').addEventListener('click', () => setRunning(!running));
            document.addEventListener('keydown', e => {
                if ((e.ctrlKey || e.metaKey) && e.key === 'Enter' && !stage.classList.contains('open')) openStage();
                if (!stage.classList.contains('open')) return;
                if (e.key === 'Escape') closeStage();
                if (e.key === 'ArrowRight') showCue(current + 1);
                if (e.key === 'ArrowLeft') showCue(current - 1);
                if (e.code === 'Space') { e.preventDefault(); setRunning(!running); }
            });
            restore();
        })();
    </script>
</body>
</html>
