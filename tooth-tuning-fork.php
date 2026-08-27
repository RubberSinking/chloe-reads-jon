<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#173e3b">
    <title>The Tooth Tuning Fork</title>
    <style>
        :root {
            --ink: #163a38;
            --paper: #f4dfb3;
            --paper-light: #fff4d7;
            --red: #c54d2d;
            --yellow: #e3a52b;
            --teal: #1c6862;
            --muted: #725f43;
            --line: rgba(79, 52, 23, .25);
            --shadow: 0 20px 60px rgba(46, 29, 8, .22);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 5%, rgba(231, 169, 46, .18), transparent 28rem),
                repeating-linear-gradient(0deg, rgba(74, 47, 16, .025) 0 1px, transparent 1px 5px),
                #e8c983;
            font-family: Georgia, "Times New Roman", serif;
            min-height: 100vh;
        }

        button, input { font: inherit; }
        button { -webkit-tap-highlight-color: transparent; }

        .page {
            width: min(1120px, calc(100% - 24px));
            margin: 18px auto 48px;
            background: var(--paper-light);
            border: 1px solid rgba(67, 38, 12, .35);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .masthead {
            min-height: 610px;
            position: relative;
            display: grid;
            grid-template-columns: .86fr 1.14fr;
            border-bottom: 2px solid var(--ink);
            background: #ead094;
        }

        .intro {
            z-index: 2;
            padding: clamp(34px, 6vw, 76px) clamp(26px, 5vw, 68px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: .18em;
            font: 700 .7rem/1.2 ui-monospace, "Courier New", monospace;
            margin: 0 0 24px;
        }
        .eyebrow::before { content: ""; width: 38px; height: 4px; background: var(--red); }

        h1 {
            margin: 0;
            font-size: clamp(3.25rem, 8.2vw, 7.4rem);
            font-weight: 400;
            letter-spacing: -.07em;
            line-height: .78;
        }
        h1 span { display: block; color: var(--red); font-style: italic; margin-left: .42em; }
        .lede { max-width: 32rem; margin: 32px 0 26px; font-size: 1.08rem; line-height: 1.65; }
        .begin {
            align-self: flex-start;
            display: inline-flex;
            gap: 14px;
            align-items: center;
            padding: 13px 18px;
            border: 2px solid var(--ink);
            color: var(--paper-light);
            background: var(--ink);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: .11em;
            font: 700 .75rem/1 ui-monospace, "Courier New", monospace;
            transition: transform .2s, box-shadow .2s;
        }
        .begin:hover { transform: translate(-3px, -3px); box-shadow: 5px 5px 0 var(--red); }

        .plate {
            position: relative;
            min-height: 610px;
            overflow: hidden;
            border-left: 1px solid rgba(31, 58, 49, .25);
        }
        .plate img { width: 100%; height: 100%; object-fit: cover; object-position: 48% center; display: block; filter: saturate(.93) contrast(1.03); }
        .plate::after {
            content: "FIG. 01  /  BONE-CONDUCTED REFERENCE";
            position: absolute;
            right: 18px;
            bottom: 18px;
            padding: 8px 10px;
            color: var(--paper-light);
            background: var(--ink);
            font: 700 .62rem/1 ui-monospace, "Courier New", monospace;
            letter-spacing: .11em;
        }
        .pulse { position: absolute; left: 29%; top: 63%; width: 20px; height: 20px; border: 3px solid var(--red); border-radius: 50%; animation: radiate 2.2s ease-out infinite; pointer-events: none; }
        .pulse:nth-of-type(2) { animation-delay: .7s; }
        .pulse:nth-of-type(3) { animation-delay: 1.4s; }
        @keyframes radiate { from { transform: scale(.3); opacity: .9; } to { transform: scale(9); opacity: 0; } }

        main { padding: clamp(38px, 7vw, 78px); }
        .section-head { display: grid; grid-template-columns: 70px 1fr; gap: 18px; margin-bottom: 30px; align-items: start; }
        .step-no { font: 700 3.1rem/.85 ui-monospace, "Courier New", monospace; color: var(--red); letter-spacing: -.08em; }
        h2 { margin: 0 0 7px; font-size: clamp(1.8rem, 4vw, 3.2rem); line-height: 1; font-weight: 400; letter-spacing: -.045em; }
        .section-head p { margin: 0; color: var(--muted); line-height: 1.5; max-width: 650px; }

        .lab { border: 2px solid var(--ink); background: #f9eac7; margin-bottom: 64px; position: relative; }
        .lab-label { position: absolute; top: -12px; right: 18px; padding: 5px 9px; background: var(--yellow); border: 1px solid var(--ink); font: 700 .65rem/1 ui-monospace, monospace; letter-spacing: .12em; text-transform: uppercase; }
        .lab-grid { display: grid; grid-template-columns: 1.15fr .85fr; }
        .panel { padding: clamp(24px, 5vw, 46px); }
        .panel + .panel { border-left: 1px dashed var(--line); }

        .instructions { margin: 0 0 26px; padding-left: 1.2em; color: #443820; line-height: 1.65; }
        .instructions strong { color: var(--red); }
        .mic-button, .primary-button {
            width: 100%; min-height: 58px; border: 2px solid var(--ink); background: var(--red); color: white;
            cursor: pointer; font: 700 .82rem/1.1 ui-monospace, "Courier New", monospace; letter-spacing: .1em; text-transform: uppercase;
            box-shadow: 5px 5px 0 var(--ink); transition: transform .15s, box-shadow .15s, background .15s;
        }
        .mic-button:hover, .primary-button:hover { background: #a73f25; }
        .mic-button:active, .primary-button:active { transform: translate(4px, 4px); box-shadow: 1px 1px 0 var(--ink); }
        .mic-button.listening { background: var(--teal); animation: flash 1s steps(2) infinite; }
        @keyframes flash { 50% { background: var(--yellow); color: var(--ink); } }
        .privacy { font: .68rem/1.5 ui-monospace, monospace; margin: 16px 0 0; color: var(--muted); }

        .meter { display: grid; place-items: center; text-align: center; min-height: 235px; border: 1px solid var(--line); background: repeating-radial-gradient(circle, transparent 0 19px, rgba(28,104,98,.08) 20px 21px); }
        .note { font-size: clamp(4rem, 12vw, 7.2rem); line-height: .8; letter-spacing: -.09em; }
        .hz { font: 700 .72rem/1 ui-monospace, monospace; letter-spacing: .12em; margin-top: 14px; color: var(--muted); }
        .capture-dots { display: flex; gap: 8px; justify-content: center; margin-top: 18px; }
        .capture-dots i { width: 12px; height: 12px; border: 2px solid var(--ink); border-radius: 50%; }
        .capture-dots i.done { background: var(--yellow); }
        .verdict { min-height: 46px; margin: 18px 0 0; color: var(--teal); font-style: italic; line-height: 1.5; }

        .manual { border-top: 1px solid var(--line); padding: 22px clamp(24px, 5vw, 46px); display: grid; grid-template-columns: 1fr auto; align-items: center; gap: 20px; background: rgba(229,165,43,.12); }
        .manual label { font-size: .9rem; }
        .manual small { display: block; margin-top: 5px; color: var(--muted); }
        .tone-dial { display: flex; align-items: center; gap: 12px; }
        .tone-dial button { border: 2px solid var(--ink); width: 42px; height: 42px; background: var(--paper-light); cursor: pointer; font-size: 1.4rem; }
        #manualNote { min-width: 52px; text-align: center; font: 700 1.2rem/1 ui-monospace, monospace; }

        .route { padding: 38px clamp(20px, 4vw, 42px); }
        .route-status { display: flex; justify-content: space-between; font: 700 .68rem/1.2 ui-monospace, monospace; letter-spacing: .09em; text-transform: uppercase; margin-bottom: 22px; }
        .note-path { display: flex; justify-content: center; align-items: center; gap: clamp(7px, 2.3vw, 25px); min-height: 130px; overflow-x: auto; padding: 15px; }
        .path-note { flex: 0 0 auto; width: 66px; height: 90px; border: 2px solid var(--ink); background: var(--paper-light); display: grid; place-items: center; font-size: 2rem; position: relative; transform: rotate(-2deg); transition: .2s; cursor: pointer; }
        .path-note:nth-child(even) { transform: rotate(2deg) translateY(-9px); }
        .path-note::after { content: "PLAY"; position: absolute; bottom: 7px; font: 700 .49rem/1 ui-monospace, monospace; letter-spacing: .1em; }
        .path-note.active { color: white; background: var(--teal); transform: rotate(0) scale(1.13); box-shadow: 5px 5px 0 var(--yellow); }
        .path-note.home { border-color: var(--red); }
        .route-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 20px; }
        .secondary-button { min-height: 50px; border: 2px solid var(--ink); background: transparent; color: var(--ink); cursor: pointer; text-transform: uppercase; font: 700 .74rem/1 ui-monospace, monospace; letter-spacing: .1em; }

        .finale { display: none; text-align: center; padding: 46px 24px 52px; border-top: 2px solid var(--ink); background: var(--teal); color: var(--paper-light); }
        .finale.show { display: block; animation: reveal .6s both; }
        @keyframes reveal { from { opacity: 0; transform: translateY(15px); } }
        .finale .big-c { font-size: 7rem; line-height: .8; font-style: italic; color: var(--yellow); }
        .finale h3 { font-size: 2rem; margin: 20px 0 10px; font-weight: 400; }
        .finale p { max-width: 540px; margin: 0 auto; line-height: 1.6; }

        .field-note { margin: 20px 0 55px; border-left: 8px solid var(--yellow); padding: 10px 0 10px 20px; max-width: 760px; line-height: 1.65; color: #483d29; }
        .field-note strong { color: var(--ink); }
        footer { border-top: 1px solid var(--line); padding: 26px clamp(24px, 5vw, 68px); display: flex; justify-content: space-between; gap: 20px; align-items: center; font-size: .86rem; background: #efd9a7; }
        footer a { color: var(--ink); text-decoration-thickness: 2px; text-underline-offset: 3px; }
        .back { font: 700 .68rem/1 ui-monospace, monospace; letter-spacing: .1em; text-transform: uppercase; }

        @media (max-width: 760px) {
            .page { width: 100%; margin: 0; border: 0; }
            .masthead { grid-template-columns: 1fr; min-height: 0; }
            .intro { min-height: 480px; }
            .plate { border-left: 0; border-top: 2px solid var(--ink); min-height: 390px; }
            .lab-grid { grid-template-columns: 1fr; }
            .panel + .panel { border-left: 0; border-top: 1px dashed var(--line); }
            .manual { grid-template-columns: 1fr; }
            .tone-dial { justify-content: space-between; }
            .route-actions { grid-template-columns: 1fr; }
            footer { align-items: flex-start; flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; }
        }
    </style>
</head>
<body>
<div class="page">
    <header class="masthead">
        <div class="intro">
            <p class="eyebrow">Pocket Acoustics Laboratory No. 03</p>
            <h1>The Tooth <span>Tuning Fork</span></h1>
            <p class="lede">Could your own skull carry a reliable reference pitch? Conduct Jon’s delightfully low-tech experiment, test it twice, and turn one tiny <em>tck</em> into middle C.</p>
            <a class="begin" href="#experiment">Begin the experiment <span aria-hidden="true">↓</span></a>
        </div>
        <div class="plate" aria-label="A retro scientific illustration showing sound travelling from the teeth to the inner ear">
            <img src="assets/dental-pitch-resonance.webp" alt="Mid-century cutaway illustration of a head with resonance travelling from the teeth to the inner ear">
            <i class="pulse"></i><i class="pulse"></i><i class="pulse"></i>
        </div>
    </header>

    <main id="experiment">
        <div class="section-head">
            <div class="step-no">01</div>
            <div><h2>Find your hidden note</h2><p>Make two recordings. The lab listens only for the brightest little click in each sample and estimates its nearest musical pitch.</p></div>
        </div>

        <section class="lab">
            <span class="lab-label">Live experiment</span>
            <div class="lab-grid">
                <div class="panel">
                    <ol class="instructions">
                        <li>Move somewhere reasonably quiet.</li>
                        <li>Press record, then <strong>gently</strong> tap your front teeth together once. No heroic biting.</li>
                        <li>Repeat for a second reading.</li>
                    </ol>
                    <button class="mic-button" id="recordButton">Record tap no. 1</button>
                    <p class="privacy">Microphone audio is analysed in this browser and is never uploaded or saved.</p>
                </div>
                <div class="panel">
                    <div class="meter" aria-live="polite">
                        <div>
                            <div class="note" id="detectedNote">?</div>
                            <div class="hz" id="detectedHz">AWAITING RESONANCE</div>
                            <div class="capture-dots"><i id="dot1"></i><i id="dot2"></i></div>
                        </div>
                    </div>
                    <p class="verdict" id="verdict">Two close readings make a much more persuasive pocket tuning fork.</p>
                </div>
            </div>
            <div class="manual">
                <label><strong>Microphone being temperamental?</strong><small>Match these tones to the sound you hear in your head, as Jon originally did at a piano.</small></label>
                <div class="tone-dial">
                    <button id="toneDown" aria-label="Previous note">−</button>
                    <span id="manualNote">D♭</span>
                    <button id="playManual" aria-label="Play selected note">♪</button>
                    <button id="toneUp" aria-label="Next note">+</button>
                </div>
            </div>
        </section>

        <div class="section-head">
            <div class="step-no">02</div>
            <div><h2>Walk it home to C</h2><p>The clever bit is not perfect pitch. It is relative pitch: remember the short musical distance from your dental note to C.</p></div>
        </div>

        <section class="lab">
            <span class="lab-label">Pitch route</span>
            <div class="route">
                <div class="route-status"><span id="routeOrigin">Starting at D♭</span><span>Destination: C4</span></div>
                <div class="note-path" id="notePath" aria-label="A route of notes leading to C"></div>
                <div class="route-actions">
                    <button class="primary-button" id="guideButton">Guide me, note by note</button>
                    <button class="secondary-button" id="testButton">Hide route &amp; test me</button>
                </div>
            </div>
            <div class="finale" id="finale">
                <div class="big-c">C</div>
                <h3>You have arrived.</h3>
                <p>Hum this note while the tone fades. Tomorrow, try the journey with no screen at all: tap, remember the distance, find C.</p>
            </div>
        </section>

        <aside class="field-note"><strong>Laboratory caveat:</strong> tooth taps are noisy, short sounds with many frequencies, so the browser’s reading is playful rather than clinical. The repeatability that matters is the pitch <em>you perceive through bone conduction</em>. Your ears are the senior researchers here.</aside>
    </main>

    <footer>
        <span>Inspired by Jon’s <a href="https://jona.ca/2016/01/dental-pitch-way-to-obtain-perfect.html" target="_blank" rel="noopener">“Dental Pitch” experiment</a>.</span>
        <a class="back" href="./">← Chloe Reads Jon</a>
    </footer>
</div>

<script>
(() => {
    const names = ['C', 'D♭', 'D', 'E♭', 'E', 'F', 'G♭', 'G', 'A♭', 'A', 'B♭', 'B'];
    let manualMidi = 61;
    let chosenMidi = 61;
    let readings = [];
    let audioCtx;
    let guideTimer;

    const $ = id => document.getElementById(id);
    const noteName = midi => names[((midi % 12) + 12) % 12];
    const freqFor = midi => 440 * Math.pow(2, (midi - 69) / 12);
    const midiFor = hz => Math.round(69 + 12 * Math.log2(hz / 440));
    const nearestC = midi => Math.max(48, Math.min(72, Math.round(midi / 12) * 12));

    function context() {
        if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        if (audioCtx.state === 'suspended') audioCtx.resume();
        return audioCtx;
    }

    function play(midi, duration = .65, delay = 0) {
        const ctx = context();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.type = 'sine';
        osc.frequency.value = freqFor(midi);
        gain.gain.setValueAtTime(0.0001, ctx.currentTime + delay);
        gain.gain.exponentialRampToValueAtTime(.18, ctx.currentTime + delay + .035);
        gain.gain.exponentialRampToValueAtTime(.0001, ctx.currentTime + delay + duration);
        osc.connect(gain).connect(ctx.destination);
        osc.start(ctx.currentTime + delay);
        osc.stop(ctx.currentTime + delay + duration + .03);
    }

    function buildRoute() {
        clearTimeout(guideTimer);
        const end = nearestC(chosenMidi);
        const step = end >= chosenMidi ? 1 : -1;
        const route = [];
        for (let m = chosenMidi; step > 0 ? m <= end : m >= end; m += step) route.push(m);
        const path = $('notePath');
        path.innerHTML = '';
        route.forEach((m, i) => {
            const b = document.createElement('button');
            b.className = 'path-note' + (i === route.length - 1 ? ' home' : '');
            b.textContent = noteName(m);
            b.dataset.midi = m;
            b.addEventListener('click', () => { play(m); setActive(b); });
            path.appendChild(b);
        });
        $('routeOrigin').textContent = `Starting at ${noteName(chosenMidi)}`;
        $('finale').classList.remove('show');
    }

    function setActive(el) {
        document.querySelectorAll('.path-note').forEach(n => n.classList.remove('active'));
        if (el) el.classList.add('active');
    }

    function usePitch(midi) {
        chosenMidi = Math.max(48, Math.min(72, midi));
        buildRoute();
    }

    function updateManual() {
        $('manualNote').textContent = noteName(manualMidi);
        usePitch(manualMidi);
    }

    $('toneDown').addEventListener('click', () => { manualMidi--; updateManual(); play(manualMidi); });
    $('toneUp').addEventListener('click', () => { manualMidi++; updateManual(); play(manualMidi); });
    $('playManual').addEventListener('click', () => play(manualMidi));

    async function recordTap() {
        const btn = $('recordButton');
        if (!navigator.mediaDevices?.getUserMedia) {
            $('verdict').textContent = 'This browser cannot open a microphone. Use the manual piano dial below.';
            return;
        }
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: { echoCancellation: false, noiseSuppression: false, autoGainControl: false } });
            const ctx = context();
            const source = ctx.createMediaStreamSource(stream);
            const analyser = ctx.createAnalyser();
            analyser.fftSize = 8192;
            source.connect(analyser);
            const bins = new Uint8Array(analyser.frequencyBinCount);
            let peak = { amp: 0, hz: 0 };
            btn.classList.add('listening');
            btn.textContent = 'Listening… tap gently now';
            $('detectedHz').textContent = 'CAPTURING 1.8 SECONDS';
            const started = performance.now();

            await new Promise(resolve => {
                function scan(now) {
                    analyser.getByteFrequencyData(bins);
                    for (let i = Math.ceil(90 * analyser.fftSize / ctx.sampleRate); i < bins.length; i++) {
                        if (bins[i] > peak.amp) peak = { amp: bins[i], hz: i * ctx.sampleRate / analyser.fftSize };
                    }
                    if (now - started < 1800) requestAnimationFrame(scan); else resolve();
                }
                requestAnimationFrame(scan);
            });
            stream.getTracks().forEach(t => t.stop());
            btn.classList.remove('listening');

            if (peak.amp < 35 || !peak.hz) {
                btn.textContent = `Try tap no. ${readings.length + 1} again`;
                $('detectedHz').textContent = 'NO CLEAR CLICK FOUND';
                $('verdict').textContent = 'I heard mostly room tone. Bring the device a little closer and try once more.';
                return;
            }

            let midi = midiFor(peak.hz);
            while (midi > 72) midi -= 12;
            while (midi < 48) midi += 12;
            readings.push({ midi, hz: peak.hz });
            $('detectedNote').textContent = noteName(midi);
            $('detectedHz').textContent = `${Math.round(peak.hz)} HZ BRIGHTEST PARTIAL`;
            $(`dot${readings.length}`).classList.add('done');

            if (readings.length === 1) {
                btn.textContent = 'Record tap no. 2';
                $('verdict').textContent = `First reading suggests ${noteName(midi)}. One more tap for repeatability.`;
                usePitch(midi);
            } else {
                const distance = Math.abs(readings[0].midi - readings[1].midi);
                const averaged = Math.round((readings[0].midi + readings[1].midi) / 2);
                usePitch(averaged);
                btn.textContent = 'Reset both readings';
                btn.onclick = () => {
                    readings = [];
                    $('dot1').classList.remove('done'); $('dot2').classList.remove('done');
                    $('detectedNote').textContent = '?'; $('detectedHz').textContent = 'AWAITING RESONANCE';
                    $('verdict').textContent = 'Two close readings make a much more persuasive pocket tuning fork.';
                    btn.textContent = 'Record tap no. 1'; btn.onclick = recordTap;
                };
                $('verdict').textContent = distance <= 1
                    ? `Excellent: the readings landed ${distance ? 'one semitone apart' : 'on the same note'}. Your working reference is ${noteName(averaged)}.`
                    : `The readings differed by ${distance} semitones. No scandal: use ${noteName(averaged)} as a playful estimate, or try again somewhere quieter.`;
            }
        } catch (e) {
            btn.classList.remove('listening');
            btn.textContent = 'Microphone unavailable';
            $('verdict').textContent = 'Permission was unavailable. The manual piano dial below performs Jon’s original version beautifully.';
        }
    }

    $('recordButton').onclick = recordTap;

    $('guideButton').addEventListener('click', () => {
        const notes = [...document.querySelectorAll('.path-note')];
        clearTimeout(guideTimer);
        $('finale').classList.remove('show');
        let i = 0;
        function next() {
            if (i >= notes.length) {
                setActive(null);
                $('finale').classList.add('show');
                return;
            }
            setActive(notes[i]);
            play(Number(notes[i].dataset.midi), .72);
            i++;
            guideTimer = setTimeout(next, 900);
        }
        next();
    });

    $('testButton').addEventListener('click', e => {
        const path = $('notePath');
        const hidden = path.style.visibility === 'hidden';
        path.style.visibility = hidden ? 'visible' : 'hidden';
        e.currentTarget.textContent = hidden ? 'Hide route & test me' : 'Reveal the route';
        if (!hidden) {
            play(chosenMidi, .7);
            setTimeout(() => play(nearestC(chosenMidi), 1), 1050);
        }
    });

    buildRoute();
})();
</script>
</body>
</html>
