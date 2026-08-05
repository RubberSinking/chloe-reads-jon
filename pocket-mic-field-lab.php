<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#e34b2f">
    <title>Pocket Mic Field Lab</title>
    <style>
        :root {
            --tomato: #e34b2f;
            --tomato-dark: #9e291c;
            --cream: #f4edda;
            --paper: #fffaf0;
            --ink: #171713;
            --green: #2d7b64;
            --mustard: #e7b544;
            --line: #b8ac92;
        }

        * { box-sizing: border-box; }
        html { background: #282722; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: "Avenir Next", "Gill Sans", "Trebuchet MS", sans-serif;
            background:
                repeating-linear-gradient(0deg, rgba(20, 18, 12, .035) 0 1px, transparent 1px 4px),
                var(--cream);
            min-height: 100vh;
        }

        button, input { font: inherit; }
        button { -webkit-tap-highlight-color: transparent; }

        .masthead {
            position: relative;
            overflow: hidden;
            padding: 18px max(18px, calc((100vw - 1060px) / 2)) 42px;
            background: var(--tomato);
            color: #fff8df;
            border-bottom: 8px solid var(--ink);
        }
        .masthead::after {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -160px;
            top: -260px;
            border: 54px solid rgba(255, 248, 223, .16);
            border-radius: 50%;
        }
        .topline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            font-size: .72rem;
            font-weight: 900;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        .back { color: inherit; text-decoration: none; border-bottom: 2px solid currentColor; }
        .issue { opacity: .8; }
        h1 {
            max-width: 850px;
            margin: 32px 0 10px;
            font-family: Rockwell, "Bookman Old Style", Georgia, serif;
            font-size: clamp(3.05rem, 10vw, 7.7rem);
            line-height: .78;
            letter-spacing: -.065em;
            text-transform: uppercase;
            text-wrap: balance;
        }
        .deck {
            max-width: 630px;
            margin: 22px 0 0;
            font-family: Georgia, serif;
            font-size: clamp(1rem, 2.5vw, 1.35rem);
            line-height: 1.45;
        }

        main { max-width: 1060px; margin: 0 auto; padding: 26px 18px 70px; }
        .tape {
            transform: rotate(-1deg);
            width: fit-content;
            max-width: 100%;
            margin: -45px 0 35px auto;
            padding: 11px 18px;
            background: var(--mustard);
            border: 2px solid var(--ink);
            box-shadow: 5px 5px 0 var(--ink);
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .05em;
            position: relative;
            z-index: 2;
        }

        .field-guide {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: 24px;
            align-items: center;
            margin-bottom: 28px;
        }
        .guide-copy h2, .section-label {
            margin: 0 0 8px;
            font-family: Rockwell, "Bookman Old Style", Georgia, serif;
            text-transform: uppercase;
            letter-spacing: -.02em;
        }
        .guide-copy p { margin: 0; line-height: 1.65; max-width: 58ch; }
        .cable-diagram {
            min-height: 150px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cable {
            width: 92%;
            height: 96px;
            border: 7px solid var(--ink);
            border-left-color: transparent;
            border-bottom-color: transparent;
            border-radius: 50%;
            transform: rotate(9deg);
        }
        .mic-capsule {
            position: absolute;
            left: 43%;
            top: 50%;
            width: 50px;
            height: 86px;
            border: 4px solid var(--ink);
            border-radius: 25px;
            background: var(--paper);
            box-shadow: 5px 5px 0 rgba(0,0,0,.18);
            transform: translate(-50%, -50%) rotate(-18deg);
        }
        .mic-capsule::after {
            content: "MIC";
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            font-size: .63rem;
            font-weight: 900;
            writing-mode: vertical-rl;
            letter-spacing: .12em;
        }
        .sound-rays { position: absolute; left: 26%; top: 15%; color: var(--tomato); font-size: 2.4rem; font-weight: 900; transform: rotate(20deg); }

        .recorder {
            background: var(--ink);
            color: var(--paper);
            border-radius: 3px;
            padding: clamp(16px, 3.5vw, 34px);
            box-shadow: 10px 10px 0 var(--tomato);
        }
        .recorder-head {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
        }
        .recorder h2 { color: var(--mustard); font-size: clamp(1.35rem, 4vw, 2.3rem); }
        .status { color: #d9d2c1; font-size: .86rem; text-align: right; }
        .scope-wrap {
            position: relative;
            border: 3px solid #4b493f;
            background: #080a08;
            min-height: 180px;
            overflow: hidden;
        }
        .scope-wrap::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(73, 174, 125, .14) 1px, transparent 1px),
                linear-gradient(90deg, rgba(73, 174, 125, .14) 1px, transparent 1px);
            background-size: 26px 26px;
            pointer-events: none;
        }
        canvas { width: 100%; height: 180px; display: block; position: relative; }
        .scope-badge {
            position: absolute;
            left: 12px;
            top: 10px;
            color: #6ddd9e;
            font: 700 .7rem "Courier New", monospace;
            letter-spacing: .12em;
        }
        .timer {
            position: absolute;
            right: 12px;
            top: 7px;
            color: var(--mustard);
            font: 700 1.35rem "Courier New", monospace;
        }
        .slots { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 18px; }
        .slot {
            padding: 16px;
            background: #292822;
            border: 2px solid #565348;
        }
        .slot.complete { border-color: var(--green); }
        .slot-title { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .letter {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border-radius: 50%;
            background: var(--mustard);
            color: var(--ink);
            font-family: Rockwell, Georgia, serif;
            font-size: 1.2rem;
            font-weight: 900;
        }
        .slot input {
            min-width: 0;
            width: 100%;
            color: var(--paper);
            background: transparent;
            border: 0;
            border-bottom: 2px solid #6d685b;
            padding: 7px 2px;
            font-weight: 800;
        }
        .slot input:focus { outline: 0; border-color: var(--mustard); }
        .record-btn {
            width: 100%;
            border: 0;
            padding: 13px;
            color: white;
            background: var(--tomato);
            box-shadow: 0 4px 0 var(--tomato-dark);
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .06em;
            cursor: pointer;
        }
        .record-btn:hover { background: #f05b3e; }
        .record-btn:active { transform: translateY(3px); box-shadow: 0 1px 0 var(--tomato-dark); }
        .record-btn:disabled { opacity: .5; cursor: wait; }
        audio { width: 100%; height: 34px; margin-top: 14px; display: none; }
        .metrics { display: none; grid-template-columns: repeat(3, 1fr); gap: 5px; margin-top: 13px; }
        .metric { background: #171713; padding: 8px 5px; text-align: center; }
        .metric strong { display: block; color: var(--mustard); font-family: "Courier New", monospace; font-size: 1rem; }
        .metric span { font-size: .62rem; color: #aaa595; text-transform: uppercase; letter-spacing: .08em; }

        .challenge {
            margin-top: 36px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border: 3px solid var(--ink);
            background: var(--paper);
        }
        .challenge-copy { padding: clamp(20px, 4vw, 38px); }
        .challenge-copy p { line-height: 1.55; }
        .mystery-panel {
            display: grid;
            place-items: center;
            align-content: center;
            gap: 14px;
            min-height: 245px;
            padding: 25px;
            background: var(--green);
            color: white;
            text-align: center;
        }
        .mystery-disc {
            width: 92px;
            aspect-ratio: 1;
            border: 7px solid var(--ink);
            border-radius: 50%;
            background: repeating-radial-gradient(circle, var(--mustard) 0 5px, #cf8e27 6px 9px);
            box-shadow: 6px 6px 0 rgba(0,0,0,.22);
        }
        .challenge button {
            border: 2px solid var(--ink);
            padding: 11px 16px;
            background: var(--mustard);
            color: var(--ink);
            font-weight: 900;
            cursor: pointer;
        }
        .guess-row { display: flex; gap: 8px; flex-wrap: wrap; justify-content: center; }
        .result { min-height: 1.4em; font-weight: 900; }

        .note {
            margin-top: 34px;
            padding-left: 18px;
            border-left: 7px solid var(--tomato);
            font-family: Georgia, serif;
            line-height: 1.6;
        }
        .note a { color: var(--tomato-dark); font-weight: bold; }
        .privacy { font-size: .78rem; color: #605b50; }

        @media (max-width: 700px) {
            .masthead { padding-bottom: 58px; }
            h1 { font-size: clamp(3.1rem, 17vw, 5.2rem); }
            .tape { margin-top: -50px; }
            .field-guide, .challenge { grid-template-columns: 1fr; }
            .field-guide { gap: 6px; }
            .cable-diagram { order: -1; }
            .recorder-head { align-items: start; flex-direction: column; }
            .status { text-align: left; }
            .slots { grid-template-columns: 1fr; }
        }
        @media (prefers-reduced-motion: no-preference) {
            .masthead h1 { animation: enter .65s cubic-bezier(.16, 1, .3, 1) both; }
            .tape { animation: tape .55s .18s cubic-bezier(.16, 1, .3, 1) both; }
            .recording .mic-capsule { animation: pulse .7s infinite alternate; }
            @keyframes enter { from { opacity: 0; transform: translateY(30px) rotate(-2deg); } }
            @keyframes tape { from { opacity: 0; transform: translateX(50px) rotate(4deg); } }
            @keyframes pulse { to { transform: translate(-50%, -50%) rotate(-18deg) scale(1.09); box-shadow: 0 0 0 12px rgba(227,75,47,.18); } }
        }
    </style>
</head>
<body>
<header class="masthead">
    <div class="topline">
        <a class="back" href="index.php">← Chloe Reads Jon</a>
        <span class="issue">Field note 2011 / 2026</span>
    </div>
    <h1>Pocket Mic<br>Field Lab</h1>
    <p class="deck">The tiny capsule hiding on an earbud cable can put a microphone near your voice and the phone safely in your pocket. But is it actually clearer? Your ears are the jury.</p>
</header>

<main>
    <div class="tape">Two takes · five seconds · one winner</div>

    <section class="field-guide">
        <div class="guide-copy">
            <h2>First, find the little spy</h2>
            <p>On wired earbuds, the microphone usually lives in the small control capsule below one earpiece. Let it hang about a fist from your mouth. Record the same sentence once with your ordinary setup and once with the inline mic. Keep the room and your speaking voice unchanged.</p>
        </div>
        <div class="cable-diagram" aria-hidden="true">
            <div class="sound-rays">)))</div>
            <div class="cable"></div>
            <div class="mic-capsule"></div>
        </div>
    </section>

    <section class="recorder" id="recorder">
        <div class="recorder-head">
            <h2 class="section-label">The signal bench</h2>
            <div class="status" id="status" role="status">Ready. Microphone access stays in this browser.</div>
        </div>
        <div class="scope-wrap">
            <canvas id="scope" width="900" height="180" aria-label="Live audio waveform"></canvas>
            <span class="scope-badge">LIVE WAVEFORM</span>
            <span class="timer" id="timer">00.0</span>
        </div>

        <div class="slots">
            <article class="slot" id="slotA">
                <div class="slot-title"><span class="letter">A</span><input id="nameA" value="Phone microphone" aria-label="Name for recording A"></div>
                <button class="record-btn" data-slot="A">● Record take A</button>
                <audio id="audioA" controls></audio>
                <div class="metrics" id="metricsA">
                    <div class="metric"><strong id="levelA">—</strong><span>level</span></div>
                    <div class="metric"><strong id="peakA">—</strong><span>peak</span></div>
                    <div class="metric"><strong id="scoreA">—</strong><span>signal</span></div>
                </div>
            </article>
            <article class="slot" id="slotB">
                <div class="slot-title"><span class="letter">B</span><input id="nameB" value="Earbud inline mic" aria-label="Name for recording B"></div>
                <button class="record-btn" data-slot="B">● Record take B</button>
                <audio id="audioB" controls></audio>
                <div class="metrics" id="metricsB">
                    <div class="metric"><strong id="levelB">—</strong><span>level</span></div>
                    <div class="metric"><strong id="peakB">—</strong><span>peak</span></div>
                    <div class="metric"><strong id="scoreB">—</strong><span>signal</span></div>
                </div>
            </article>
        </div>
    </section>

    <section class="challenge">
        <div class="challenge-copy">
            <h2 class="section-label">The blind listen</h2>
            <p>Once both takes are ready, shuffle them. If the difference is real, you should be able to identify the mystery recording without peeking at its letter.</p>
            <p class="privacy">The meter reports loudness, peak level, and a rough signal-strength score. It cannot judge warmth, clarity, or charm. That remains gloriously human work.</p>
        </div>
        <div class="mystery-panel">
            <div class="mystery-disc" aria-hidden="true"></div>
            <button id="playMystery">▶ Shuffle &amp; play mystery take</button>
            <div class="guess-row">
                <button id="guessA" disabled>It was A</button>
                <button id="guessB" disabled>It was B</button>
            </div>
            <div class="result" id="result" aria-live="polite">Record both takes to unlock.</div>
        </div>
    </section>

    <aside class="note">
        Inspired by Jon's delighted discovery in <a href="https://jona.ca/2011/10/iphone-earbuds-have-built-in-microphone.html">“iPhone earbuds have a built-in microphone”</a>. The original observation still makes a fine experiment: move the mic closer, move the phone away, and listen rather than trusting the packaging.
    </aside>
</main>

<script>
(() => {
    const canvas = document.getElementById('scope');
    const ctx = canvas.getContext('2d');
    const status = document.getElementById('status');
    const timer = document.getElementById('timer');
    const recorderPanel = document.getElementById('recorder');
    const buttons = [...document.querySelectorAll('.record-btn')];
    const recordings = { A: null, B: null };
    let activeStream = null;
    let animationId = null;
    let mystery = null;

    function drawIdle() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.strokeStyle = '#4ec482';
        ctx.lineWidth = 3;
        ctx.beginPath();
        for (let x = 0; x <= canvas.width; x += 4) {
            const y = canvas.height / 2 + Math.sin(x / 42) * 2;
            x === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
        }
        ctx.stroke();
    }

    function db(value) {
        return value > 0 ? 20 * Math.log10(value) : -60;
    }

    function labelDb(value) {
        return `${Math.max(-60, Math.round(db(value)))} dB`;
    }

    function scoreSignal(avg, peak, silentRatio) {
        const levelFit = Math.max(0, 1 - Math.abs(db(avg) + 21) / 34);
        const clipPenalty = peak > .96 ? .32 : 0;
        return Math.max(1, Math.min(99, Math.round(28 + levelFit * 67 - silentRatio * 18 - clipPenalty * 100)));
    }

    async function record(slot) {
        if (!navigator.mediaDevices?.getUserMedia || !window.MediaRecorder) {
            status.textContent = 'This browser does not support microphone recording.';
            return;
        }
        buttons.forEach(b => b.disabled = true);
        status.textContent = 'Requesting microphone access…';
        try {
            activeStream = await navigator.mediaDevices.getUserMedia({ audio: { echoCancellation: false, noiseSuppression: false, autoGainControl: false } });
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const source = audioContext.createMediaStreamSource(activeStream);
            const analyser = audioContext.createAnalyser();
            analyser.fftSize = 2048;
            source.connect(analyser);
            const data = new Uint8Array(analyser.fftSize);
            const chunks = [];
            const mime = MediaRecorder.isTypeSupported('audio/webm;codecs=opus') ? 'audio/webm;codecs=opus' : '';
            const mediaRecorder = new MediaRecorder(activeStream, mime ? { mimeType: mime } : undefined);
            const samples = [];
            let peak = 0;
            let silent = 0;
            let frames = 0;
            const began = performance.now();

            mediaRecorder.ondataavailable = e => { if (e.data.size) chunks.push(e.data); };
            mediaRecorder.start();
            recorderPanel.classList.add('recording');
            status.textContent = `Recording take ${slot}. Say the same sentence naturally.`;

            function paint() {
                analyser.getByteTimeDomainData(data);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.strokeStyle = '#6ddd9e';
                ctx.lineWidth = 4;
                ctx.beginPath();
                let sum = 0;
                let framePeak = 0;
                const step = canvas.width / data.length;
                for (let i = 0; i < data.length; i++) {
                    const normalized = (data[i] - 128) / 128;
                    sum += normalized * normalized;
                    framePeak = Math.max(framePeak, Math.abs(normalized));
                    const x = i * step;
                    const y = (data[i] / 255) * canvas.height;
                    i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);
                }
                ctx.stroke();
                const rms = Math.sqrt(sum / data.length);
                samples.push(rms);
                peak = Math.max(peak, framePeak);
                if (rms < .012) silent++;
                frames++;
                const elapsed = (performance.now() - began) / 1000;
                timer.textContent = elapsed.toFixed(1).padStart(4, '0');
                if (elapsed < 5) animationId = requestAnimationFrame(paint);
                else mediaRecorder.stop();
            }
            paint();

            mediaRecorder.onstop = async () => {
                cancelAnimationFrame(animationId);
                const blob = new Blob(chunks, { type: mediaRecorder.mimeType || 'audio/webm' });
                const url = URL.createObjectURL(blob);
                const avg = samples.reduce((a, b) => a + b, 0) / Math.max(1, samples.length);
                const signalScore = scoreSignal(avg, peak, silent / Math.max(1, frames));
                if (recordings[slot]?.url) URL.revokeObjectURL(recordings[slot].url);
                recordings[slot] = { blob, url, avg, peak, score: signalScore };
                const audio = document.getElementById(`audio${slot}`);
                audio.src = url;
                audio.style.display = 'block';
                document.getElementById(`level${slot}`).textContent = labelDb(avg);
                document.getElementById(`peak${slot}`).textContent = labelDb(peak);
                document.getElementById(`score${slot}`).textContent = `${signalScore}/99`;
                document.getElementById(`metrics${slot}`).style.display = 'grid';
                document.getElementById(`slot${slot}`).classList.add('complete');
                activeStream.getTracks().forEach(t => t.stop());
                await audioContext.close();
                recorderPanel.classList.remove('recording');
                timer.textContent = '05.0';
                buttons.forEach(b => b.disabled = false);
                status.textContent = recordings.A && recordings.B ? 'Both takes captured. Trust your ears below.' : `Take ${slot} captured. Now record the other setup.`;
                document.getElementById('result').textContent = recordings.A && recordings.B ? 'Both takes ready. Shuffle when you are.' : 'Record both takes to unlock.';
                drawIdle();
            };
        } catch (error) {
            buttons.forEach(b => b.disabled = false);
            recorderPanel.classList.remove('recording');
            status.textContent = error.name === 'NotAllowedError' ? 'Microphone permission was declined. Allow it to run the field test.' : 'The microphone could not be started. Try reloading the page.';
            if (activeStream) activeStream.getTracks().forEach(t => t.stop());
        }
    }

    function randomSlot() {
        const value = new Uint8Array(1);
        crypto.getRandomValues(value);
        return value[0] < 128 ? 'A' : 'B';
    }

    buttons.forEach(button => button.addEventListener('click', () => record(button.dataset.slot)));
    document.getElementById('playMystery').addEventListener('click', () => {
        if (!recordings.A || !recordings.B) {
            document.getElementById('result').textContent = 'The mystery needs two recordings first.';
            return;
        }
        document.querySelectorAll('audio').forEach(a => { a.pause(); a.currentTime = 0; });
        mystery = randomSlot();
        const mysteryAudio = document.getElementById(`audio${mystery}`);
        mysteryAudio.play();
        document.getElementById('guessA').disabled = false;
        document.getElementById('guessB').disabled = false;
        document.getElementById('result').textContent = 'Listen closely… which setup is speaking?';
    });

    function guess(slot) {
        if (!mystery) return;
        const correct = slot === mystery;
        const chosenName = document.getElementById(`name${mystery}`).value || `Take ${mystery}`;
        document.getElementById('result').textContent = correct ? `Correct. That was “${chosenName}.”` : `Not this time. That was “${chosenName}.” Try another shuffle.`;
        document.getElementById('guessA').disabled = true;
        document.getElementById('guessB').disabled = true;
        mystery = null;
    }
    document.getElementById('guessA').addEventListener('click', () => guess('A'));
    document.getElementById('guessB').addEventListener('click', () => guess('B'));
    drawIdle();
})();
</script>
</body>
</html>
