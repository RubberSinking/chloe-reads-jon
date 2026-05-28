<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder Chime Lab</title>
    <style>
        :root {
            --paper: #f4efe2;
            --ink: #1f1a17;
            --brass: #c6872f;
            --teal: #1b6f6a;
            --berry: #9e4056;
            --cream: #fff9ee;
            --shadow: rgba(18, 14, 10, 0.16);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Avenir Next", "Gill Sans", "Trebuchet MS", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 10% 10%, #fff7dc 0%, transparent 40%),
                radial-gradient(circle at 88% 30%, #f9dfb4 0%, transparent 43%),
                radial-gradient(circle at 55% 85%, #f2d8c4 0%, transparent 44%),
                var(--paper);
            min-height: 100vh;
        }

        .wrap {
            max-width: 980px;
            margin: 0 auto;
            padding: 1.2rem 1rem 2.2rem;
        }

        .hero {
            background: linear-gradient(135deg, #f9f0de 0%, #fffaf0 55%, #fbe9d0 100%);
            border: 2px solid #e4d0ad;
            border-radius: 24px;
            padding: 1.2rem;
            box-shadow: 0 12px 28px var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .hero:before {
            content: "";
            position: absolute;
            inset: -50% auto auto -20%;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(198, 135, 47, 0.16), transparent 65%);
            transform: rotate(24deg);
            pointer-events: none;
        }

        h1 {
            margin: 0;
            font-family: "Didot", "Bodoni MT", "Times New Roman", serif;
            letter-spacing: 0.03em;
            font-size: clamp(1.8rem, 4.6vw, 3rem);
            line-height: 1.1;
        }

        .sub {
            margin: 0.55rem 0 0;
            max-width: 70ch;
            line-height: 1.45;
        }

        .lab {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.9rem;
        }

        .panel {
            background: var(--cream);
            border: 1.6px solid #e2ceb0;
            border-radius: 18px;
            padding: 0.95rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
        }

        .panel h2 {
            margin: 0 0 0.65rem;
            font-size: 1.1rem;
            font-family: "Didot", "Bodoni MT", serif;
            letter-spacing: 0.02em;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            align-items: center;
        }

        button {
            border: 0;
            border-radius: 999px;
            padding: 0.5rem 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.16s ease, filter 0.16s ease;
            color: #fff;
            background: var(--teal);
        }

        button:hover { filter: brightness(1.06); }
        button:active { transform: translateY(1px) scale(0.99); }

        .alt { background: var(--berry); }
        .warm { background: var(--brass); color: #2b2114; }

        label {
            display: block;
            font-size: 0.92rem;
            font-weight: 650;
            margin: 0.5rem 0 0.3rem;
        }

        input[type="range"], input[type="number"] {
            width: 100%;
        }

        .grid2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.7rem;
        }

        .pattern {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 0.42rem;
            margin-top: 0.6rem;
        }

        .step {
            aspect-ratio: 1;
            border-radius: 10px;
            border: 1px solid #ccb18a;
            background: #f8edd9;
            color: #6b5130;
            font-weight: 700;
            transition: all 0.16s ease;
        }

        .step.active {
            background: #ffcc73;
            color: #2a2116;
            border-color: #c6872f;
        }

        .step.playing {
            outline: 3px solid #3aa79f;
            transform: translateY(-2px);
        }

        .stats {
            margin-top: 0.6rem;
            font-size: 0.92rem;
            color: #4b3d2d;
        }

        .status {
            min-height: 1.2em;
            margin-top: 0.45rem;
            font-weight: 650;
            color: #21423d;
        }

        .footer-note {
            margin-top: 1rem;
            font-size: 0.9rem;
            line-height: 1.4;
            color: #4a3c2f;
        }

        @media (max-width: 700px) {
            .grid2 { grid-template-columns: 1fr; }
            .pattern { grid-template-columns: repeat(4, 1fr); }
            .hero { padding: 1rem; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <section class="hero">
        <h1>Reminder Chime Lab</h1>
        <p class="sub">Build a reminder tone that refuses to be ignored, without being obnoxious. Start from Jon's classic 5-beep inspiration, then tune pitch, spacing, and rhythm into your own polite little attention magnet.</p>
    </section>

    <section class="lab">
        <article class="panel">
            <h2>1) Pattern Builder</h2>
            <div class="row">
                <button id="presetFive" class="warm">Classic 5 Beeps</button>
                <button id="presetGentle">Gentle</button>
                <button id="presetUrgent" class="alt">Urgent</button>
                <button id="clearPattern">Clear</button>
            </div>
            <div id="pattern" class="pattern" aria-label="beep pattern steps"></div>
            <div class="stats" id="patternStats">0 beeps active</div>
        </article>

        <article class="panel">
            <h2>2) Tone Controls</h2>
            <div class="grid2">
                <div>
                    <label for="pitch">Pitch (Hz)</label>
                    <input id="pitch" type="range" min="300" max="1600" value="880">
                    <div class="stats"><span id="pitchValue">880</span> Hz</div>
                </div>
                <div>
                    <label for="beepMs">Beep Length (ms)</label>
                    <input id="beepMs" type="range" min="60" max="500" value="160">
                    <div class="stats"><span id="beepValue">160</span> ms</div>
                </div>
                <div>
                    <label for="gapMs">Gap Between Steps (ms)</label>
                    <input id="gapMs" type="range" min="80" max="600" value="140">
                    <div class="stats"><span id="gapValue">140</span> ms</div>
                </div>
                <div>
                    <label for="volume">Volume</label>
                    <input id="volume" type="range" min="0.05" max="1" value="0.35" step="0.05">
                    <div class="stats"><span id="volumeValue">0.35</span></div>
                </div>
            </div>
        </article>

        <article class="panel">
            <h2>3) Play and Export</h2>
            <div class="row">
                <button id="playNow">Play Pattern</button>
                <button id="loopTest" class="alt">Loop x3</button>
                <button id="downloadWav" class="warm">Download WAV</button>
            </div>
            <div class="status" id="status"></div>
        </article>
    </section>

    <p class="footer-note">
        Tip: for calendar reminders, short gaps plus 4-6 beeps are often easier to notice under heavy multitasking than one long tone.
    </p>
</div>

<script>
(() => {
    const steps = Array.from({ length: 16 }, (_, i) => ({ on: i < 5 }));
    const patternEl = document.getElementById('pattern');
    const statsEl = document.getElementById('patternStats');
    const statusEl = document.getElementById('status');

    const pitch = document.getElementById('pitch');
    const beepMs = document.getElementById('beepMs');
    const gapMs = document.getElementById('gapMs');
    const volume = document.getElementById('volume');

    const pitchValue = document.getElementById('pitchValue');
    const beepValue = document.getElementById('beepValue');
    const gapValue = document.getElementById('gapValue');
    const volumeValue = document.getElementById('volumeValue');

    const AudioCtx = window.AudioContext || window.webkitAudioContext;
    let audioCtx = null;

    function ensureAudio() {
        if (!audioCtx) audioCtx = new AudioCtx();
        if (audioCtx.state === 'suspended') return audioCtx.resume();
        return Promise.resolve();
    }

    function setStatus(msg) {
        statusEl.textContent = msg;
    }

    function renderPattern() {
        patternEl.innerHTML = '';
        steps.forEach((step, i) => {
            const b = document.createElement('button');
            b.className = 'step' + (step.on ? ' active' : '');
            b.textContent = String(i + 1);
            b.type = 'button';
            b.addEventListener('click', () => {
                step.on = !step.on;
                renderPattern();
            });
            patternEl.appendChild(b);
        });
        const count = steps.filter(s => s.on).length;
        statsEl.textContent = `${count} beep${count === 1 ? '' : 's'} active`;
    }

    function readConfig() {
        return {
            hz: Number(pitch.value),
            beep: Number(beepMs.value),
            gap: Number(gapMs.value),
            vol: Number(volume.value)
        };
    }

    function blinkStep(index) {
        const buttons = patternEl.querySelectorAll('.step');
        buttons.forEach(btn => btn.classList.remove('playing'));
        if (buttons[index]) buttons[index].classList.add('playing');
    }

    function beepAt(time, config) {
        const osc = audioCtx.createOscillator();
        const gain = audioCtx.createGain();
        osc.type = 'sine';
        osc.frequency.value = config.hz;
        gain.gain.setValueAtTime(0.0001, time);
        gain.gain.exponentialRampToValueAtTime(config.vol, time + 0.01);
        gain.gain.exponentialRampToValueAtTime(0.0001, time + config.beep / 1000);
        osc.connect(gain).connect(audioCtx.destination);
        osc.start(time);
        osc.stop(time + config.beep / 1000 + 0.02);
    }

    async function playPattern(loopCount = 1) {
        await ensureAudio();
        const config = readConfig();
        const active = steps.map(s => s.on);
        if (!active.some(Boolean)) {
            setStatus('Pattern is empty. Turn on at least one step.');
            return;
        }

        const startBase = audioCtx.currentTime + 0.04;
        const stepDur = (config.beep + config.gap) / 1000;

        for (let l = 0; l < loopCount; l++) {
            for (let i = 0; i < active.length; i++) {
                const at = startBase + (l * active.length + i) * stepDur;
                if (active[i]) beepAt(at, config);
                setTimeout(() => blinkStep(i), (at - audioCtx.currentTime) * 1000);
            }
        }

        setStatus(loopCount === 1 ? 'Playing pattern...' : `Looping ${loopCount}x...`);
        setTimeout(() => {
            patternEl.querySelectorAll('.step').forEach(btn => btn.classList.remove('playing'));
            setStatus('Done.');
        }, (active.length * loopCount * stepDur + 0.08) * 1000);
    }

    function buildPcm() {
        const cfg = readConfig();
        const sampleRate = 44100;
        const on = steps.map(s => s.on);
        const stepSamples = Math.floor((cfg.beep + cfg.gap) / 1000 * sampleRate);
        const beepSamples = Math.floor(cfg.beep / 1000 * sampleRate);
        const total = stepSamples * on.length;
        const data = new Float32Array(total);

        for (let i = 0; i < on.length; i++) {
            if (!on[i]) continue;
            const start = i * stepSamples;
            for (let n = 0; n < beepSamples; n++) {
                const t = n / sampleRate;
                const env = Math.min(1, n / (sampleRate * 0.01)) * Math.max(0, 1 - (n / beepSamples));
                data[start + n] = Math.sin(2 * Math.PI * cfg.hz * t) * cfg.vol * env;
            }
        }
        return { sampleRate, data };
    }

    function floatTo16BitPCM(view, offset, input) {
        for (let i = 0; i < input.length; i++, offset += 2) {
            const s = Math.max(-1, Math.min(1, input[i]));
            view.setInt16(offset, s < 0 ? s * 0x8000 : s * 0x7FFF, true);
        }
    }

    function writeString(view, offset, string) {
        for (let i = 0; i < string.length; i++) view.setUint8(offset + i, string.charCodeAt(i));
    }

    function encodeWav({ sampleRate, data }) {
        const bytesPerSample = 2;
        const blockAlign = bytesPerSample;
        const buffer = new ArrayBuffer(44 + data.length * bytesPerSample);
        const view = new DataView(buffer);

        writeString(view, 0, 'RIFF');
        view.setUint32(4, 36 + data.length * bytesPerSample, true);
        writeString(view, 8, 'WAVE');
        writeString(view, 12, 'fmt ');
        view.setUint32(16, 16, true);
        view.setUint16(20, 1, true);
        view.setUint16(22, 1, true);
        view.setUint32(24, sampleRate, true);
        view.setUint32(28, sampleRate * blockAlign, true);
        view.setUint16(32, blockAlign, true);
        view.setUint16(34, 16, true);
        writeString(view, 36, 'data');
        view.setUint32(40, data.length * bytesPerSample, true);
        floatTo16BitPCM(view, 44, data);
        return new Blob([view], { type: 'audio/wav' });
    }

    function setPreset(type) {
        steps.forEach(s => { s.on = false; });
        if (type === 'five') {
            [0, 1, 2, 3, 4].forEach(i => { steps[i].on = true; });
            pitch.value = 880; beepMs.value = 150; gapMs.value = 130; volume.value = 0.35;
        } else if (type === 'gentle') {
            [0, 3, 7, 11].forEach(i => { steps[i].on = true; });
            pitch.value = 640; beepMs.value = 200; gapMs.value = 200; volume.value = 0.25;
        } else if (type === 'urgent') {
            [0,1,2,3,5,6,7,8,10,11,12,13].forEach(i => { steps[i].on = true; });
            pitch.value = 1180; beepMs.value = 120; gapMs.value = 90; volume.value = 0.45;
        }
        syncDisplays();
        renderPattern();
        setStatus('Preset loaded.');
    }

    function syncDisplays() {
        pitchValue.textContent = pitch.value;
        beepValue.textContent = beepMs.value;
        gapValue.textContent = gapMs.value;
        volumeValue.textContent = Number(volume.value).toFixed(2);
    }

    document.getElementById('presetFive').addEventListener('click', () => setPreset('five'));
    document.getElementById('presetGentle').addEventListener('click', () => setPreset('gentle'));
    document.getElementById('presetUrgent').addEventListener('click', () => setPreset('urgent'));

    document.getElementById('clearPattern').addEventListener('click', () => {
        steps.forEach(s => { s.on = false; });
        renderPattern();
        setStatus('Pattern cleared.');
    });

    document.getElementById('playNow').addEventListener('click', () => playPattern(1));
    document.getElementById('loopTest').addEventListener('click', () => playPattern(3));

    document.getElementById('downloadWav').addEventListener('click', () => {
        const active = steps.some(s => s.on);
        if (!active) {
            setStatus('Pattern is empty. Nothing to export.');
            return;
        }
        const blob = encodeWav(buildPcm());
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'reminder-chime.wav';
        document.body.appendChild(a);
        a.click();
        a.remove();
        setTimeout(() => URL.revokeObjectURL(url), 2000);
        setStatus('WAV downloaded.');
    });

    [pitch, beepMs, gapMs, volume].forEach(el => el.addEventListener('input', syncDisplays));

    syncDisplays();
    renderPattern();
    setStatus('Tap Play to test your reminder tone.');
})();
</script>
</body>
</html>
