<?php
// Random Melody Composer — inspired by Jon's 2015 post about stochastic melody generators
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Melody Composer</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #0f0e17;
            color: #fffffe;
            min-height: 100vh;
            padding: 20px 16px 48px;
            margin: 0;
        }
        h1 {
            text-align: center;
            font-size: 1.7em;
            margin: 0 0 4px;
            background: linear-gradient(135deg, #ff6b6b, #ffd93d, #6bcb77, #4d96ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .subtitle {
            text-align: center;
            color: #888;
            font-size: 0.85em;
            margin: 0 0 24px;
        }
        .controls {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            max-width: 560px;
            margin: 0 auto 20px;
        }
        @media (min-width: 480px) {
            .controls { grid-template-columns: repeat(4, 1fr); }
        }
        .control-group {
            background: #1a1a2e;
            border-radius: 10px;
            padding: 10px;
        }
        .control-group label {
            display: block;
            font-size: 0.65em;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 6px;
        }
        .control-group select {
            width: 100%;
            background: #16213e;
            color: #fffffe;
            border: 1px solid #333;
            border-radius: 6px;
            padding: 7px 6px;
            font-size: 0.9em;
            cursor: pointer;
            outline: none;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            max-width: 560px;
            margin: 0 auto 20px;
            flex-wrap: wrap;
        }
        button {
            padding: 12px 22px;
            border: none;
            border-radius: 8px;
            font-size: 0.95em;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.1s, box-shadow 0.1s, opacity 0.2s;
            letter-spacing: 0.5px;
        }
        button:active { transform: scale(0.96); }
        button:disabled { opacity: 0.35; cursor: default; transform: none; }
        #generateBtn {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            box-shadow: 0 4px 16px rgba(255,107,107,0.4);
        }
        #playBtn {
            background: linear-gradient(135deg, #6bcb77, #218838);
            color: white;
            box-shadow: 0 4px 16px rgba(107,203,119,0.4);
        }
        #stopBtn {
            background: #333;
            color: #ccc;
        }
        #loopBtn {
            background: #1a1a2e;
            color: #4d96ff;
            border: 2px solid #4d96ff;
        }
        #loopBtn.active {
            background: #4d96ff;
            color: white;
        }

        /* NOTE DISPLAY */
        .note-display {
            max-width: 560px;
            margin: 0 auto 20px;
            background: #1a1a2e;
            border-radius: 16px;
            padding: 16px;
            min-height: 90px;
        }
        .note-bubbles {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
            align-items: center;
            min-height: 60px;
        }
        .note-bubble {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72em;
            font-weight: 800;
            color: white;
            position: relative;
            transition: transform 0.12s;
            flex-shrink: 0;
        }
        .note-bubble.active {
            transform: scale(1.35);
            z-index: 10;
            box-shadow: 0 0 18px 4px currentColor;
        }
        .note-bubble .duration-dot {
            position: absolute;
            bottom: 1px;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.6);
        }
        .empty-state {
            text-align: center;
            color: #555;
            font-size: 0.9em;
            padding: 10px 0;
            width: 100%;
        }

        /* PIANO */
        .piano-wrapper {
            max-width: 560px;
            margin: 0 auto 20px;
            background: #1a1a2e;
            border-radius: 16px;
            padding: 16px;
            overflow: hidden;
        }
        .piano-label {
            font-size: 0.65em;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 10px;
        }
        .piano-scroll {
            overflow-x: auto;
            padding-bottom: 4px;
        }
        .piano {
            position: relative;
            height: 90px;
            display: inline-flex;
            user-select: none;
        }
        .wk {
            width: 32px;
            height: 90px;
            background: #f8f4e8;
            border: 1px solid #bbb;
            border-radius: 0 0 5px 5px;
            position: relative;
            flex-shrink: 0;
            transition: background 0.07s;
        }
        .wk.scale-note { background: #c8f7d4; }
        .wk.active { background: #ffd93d !important; box-shadow: 0 0 12px #ffd93d; }
        .wk span {
            position: absolute;
            bottom: 5px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.52em;
            color: #888;
            font-weight: 600;
        }
        .bk {
            width: 22px;
            height: 55px;
            background: #1a1a1a;
            border-radius: 0 0 4px 4px;
            position: absolute;
            top: 0;
            z-index: 2;
            transition: background 0.07s;
        }
        .bk.scale-note { background: #2d7a3a; }
        .bk.active { background: #ffd93d !important; box-shadow: 0 0 12px #ffd93d; }

        /* CURRENT NOTE DISPLAY */
        .current-note {
            text-align: center;
            font-size: 2em;
            font-weight: 900;
            min-height: 1.2em;
            letter-spacing: 2px;
            margin: 8px 0 0;
        }

        /* WAVE VISUALIZER */
        .wave-viz {
            max-width: 560px;
            margin: 0 auto 20px;
            background: #1a1a2e;
            border-radius: 16px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .wave-bars {
            display: flex;
            gap: 3px;
            align-items: flex-end;
            height: 36px;
            flex: 1;
        }
        .wave-bar {
            flex: 1;
            border-radius: 3px 3px 0 0;
            transition: height 0.1s;
            background: #333;
        }
        .wave-bar.active { background: linear-gradient(to top, #ff6b6b, #ffd93d); }
        .bpm-display {
            font-size: 1.4em;
            font-weight: 900;
            color: #4d96ff;
            min-width: 60px;
            text-align: right;
        }
        .bpm-label {
            font-size: 0.6em;
            color: #888;
            letter-spacing: 1px;
        }

        /* FOOTER */
        .info {
            max-width: 560px;
            margin: 0 auto;
            color: #555;
            font-size: 0.78em;
            text-align: center;
            line-height: 1.6;
        }
        .info a { color: #4d96ff; text-decoration: none; }
        .info a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h1>🎵 Random Melody Composer</h1>
<p class="subtitle">Generate & play melodies in any key or scale — powered by your browser</p>

<div class="controls">
    <div class="control-group">
        <label>Key</label>
        <select id="keySelect">
            <option value="60">C</option>
            <option value="62">D</option>
            <option value="64">E</option>
            <option value="65">F</option>
            <option value="67">G</option>
            <option value="69" selected>A</option>
            <option value="71">B</option>
        </select>
    </div>
    <div class="control-group">
        <label>Scale</label>
        <select id="scaleSelect">
            <option value="major">Major</option>
            <option value="minor" selected>Minor</option>
            <option value="pentatonicMaj">Pentatonic Maj</option>
            <option value="pentatonicMin">Pentatonic Min</option>
            <option value="blues">Blues</option>
            <option value="wholeTone">Whole Tone</option>
            <option value="dorian">Dorian</option>
            <option value="mixolydian">Mixolydian</option>
        </select>
    </div>
    <div class="control-group">
        <label>Tempo</label>
        <select id="tempoSelect">
            <option value="60">Slow (60 BPM)</option>
            <option value="90" selected>Medium (90 BPM)</option>
            <option value="120">Upbeat (120 BPM)</option>
            <option value="150">Fast (150 BPM)</option>
            <option value="180">Very Fast (180)</option>
        </select>
    </div>
    <div class="control-group">
        <label>Length</label>
        <select id="lengthSelect">
            <option value="8">8 notes</option>
            <option value="12" selected>12 notes</option>
            <option value="16">16 notes</option>
            <option value="24">24 notes</option>
        </select>
    </div>
</div>

<div class="btn-group">
    <button id="generateBtn">🎲 Generate</button>
    <button id="playBtn" disabled>▶ Play</button>
    <button id="stopBtn" disabled>■ Stop</button>
    <button id="loopBtn" disabled>↺ Loop</button>
</div>

<div class="wave-viz">
    <div class="wave-bars" id="waveBars"></div>
    <div>
        <div class="bpm-display" id="bpmDisplay">—</div>
        <div class="bpm-label">BPM</div>
    </div>
</div>

<div class="note-display">
    <div class="note-bubbles" id="noteBubbles">
        <div class="empty-state">Hit 🎲 Generate to compose a melody!</div>
    </div>
</div>

<div class="piano-wrapper">
    <div class="piano-label">Piano Preview</div>
    <div class="piano-scroll">
        <div class="piano" id="piano"></div>
    </div>
    <div class="current-note" id="currentNote"></div>
</div>

<div class="info">
    Inspired by Jon's <a href="https://jon-aquino-mental-garden.blogspot.com/2015/06/random-melody-generator.html" target="_blank">Random Melody Generator post</a> — Jon plays violin and was looking for a stochastic melody generator to inspire violin parts for Couples For Christ music.
    <br>Uses the Web Audio API — no plugins needed.
</div>

<script>
// ─── SCALES (semitone offsets from root) ───
const SCALES = {
    major:        [0,2,4,5,7,9,11],
    minor:        [0,2,3,5,7,8,10],
    pentatonicMaj:[0,2,4,7,9],
    pentatonicMin:[0,3,5,7,10],
    blues:        [0,3,5,6,7,10],
    wholeTone:    [0,2,4,6,8,10],
    dorian:       [0,2,3,5,7,9,10],
    mixolydian:   [0,2,4,5,7,9,10],
};

// ─── NOTE NAME HELPERS ───
const NOTE_NAMES = ['C','C#','D','D#','E','F','F#','G','G#','A','A#','B'];
function midiToName(midi) {
    const oct = Math.floor(midi / 12) - 1;
    return NOTE_NAMES[midi % 12] + oct;
}
function midiToFreq(midi) {
    return 440 * Math.pow(2, (midi - 69) / 12);
}

// ─── COLOURS for note bubbles ───
const BUBBLE_COLORS = [
    '#ff6b6b','#ff8e53','#ffd93d','#6bcb77',
    '#4d96ff','#b084cc','#ff6bce','#40c9ff',
    '#ff9f43','#48dbfb','#ff6b81','#a29bfe',
    '#55efc4','#fdcb6e','#e17055','#74b9ff',
    '#81ecec','#fab1a0','#fd79a8','#636e72',
    '#00cec9','#6c5ce7','#d63031','#0984e3',
];

// ─── STATE ───
let melody = [];       // array of { midi, name, color, duration }
let audioCtx = null;
let isPlaying = false;
let loopActive = false;
let playTimeouts = [];
let currentNoteIdx = -1;

// ─── AUDIO SETUP ───
function getAudioCtx() {
    if (!audioCtx) {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }
    if (audioCtx.state === 'suspended') audioCtx.resume();
    return audioCtx;
}

function playNote(freq, duration, time) {
    const ctx = getAudioCtx();
    const osc = ctx.createOscillator();
    const gain = ctx.createGain();
    osc.connect(gain);
    gain.connect(ctx.destination);

    // Warm, slightly bell-like tone
    osc.type = 'triangle';
    osc.frequency.setValueAtTime(freq, time);

    // Add slight vibrato
    const lfo = ctx.createOscillator();
    const lfoGain = ctx.createGain();
    lfo.frequency.value = 5.5;
    lfoGain.gain.value = 2.5;
    lfo.connect(lfoGain);
    lfoGain.connect(osc.frequency);
    lfo.start(time);
    lfo.stop(time + duration);

    // Envelope: quick attack, nice decay
    gain.gain.setValueAtTime(0, time);
    gain.gain.linearRampToValueAtTime(0.35, time + 0.015);
    gain.gain.exponentialRampToValueAtTime(0.18, time + duration * 0.6);
    gain.gain.linearRampToValueAtTime(0.001, time + duration * 0.98);

    osc.start(time);
    osc.stop(time + duration);
}

// ─── MELODY GENERATION ───
function generateMelody() {
    stopPlayback();
    const rootMidi = parseInt(document.getElementById('keySelect').value);
    const scaleKey = document.getElementById('scaleSelect').value;
    const length = parseInt(document.getElementById('lengthSelect').value);
    const scaleDef = SCALES[scaleKey];

    // Build available MIDI notes: 2 octaves from root
    const available = [];
    for (let oct = 0; oct <= 1; oct++) {
        for (const s of scaleDef) {
            const midi = rootMidi + oct * 12 + s;
            if (midi >= 48 && midi <= 84) available.push(midi);
        }
    }

    // Contour generation: random walk with tendency to stay nearby
    melody = [];
    let prev = available[Math.floor(available.length / 2)];
    const durations = [0.5, 0.5, 0.5, 1.0, 1.0, 1.5]; // variety of durations
    for (let i = 0; i < length; i++) {
        // Weighted toward nearby notes (prefer ±2 semitones in scale)
        let candidates;
        if (Math.random() < 0.7) {
            const prevIdx = available.indexOf(prev);
            const lo = Math.max(0, prevIdx - 3);
            const hi = Math.min(available.length - 1, prevIdx + 3);
            candidates = available.slice(lo, hi + 1);
        } else {
            candidates = available;
        }
        const midi = candidates[Math.floor(Math.random() * candidates.length)];
        const dur = durations[Math.floor(Math.random() * durations.length)];
        const colorIdx = (midi - rootMidi + 48) % BUBBLE_COLORS.length;
        melody.push({
            midi,
            name: midiToName(midi),
            color: BUBBLE_COLORS[colorIdx],
            duration: dur,
        });
        prev = midi;
    }

    renderBubbles();
    updatePianoScale();
    document.getElementById('playBtn').disabled = false;
    document.getElementById('loopBtn').disabled = false;
    document.getElementById('bpmDisplay').textContent = document.getElementById('tempoSelect').value;
}

// ─── RENDER BUBBLES ───
function renderBubbles() {
    const container = document.getElementById('noteBubbles');
    container.innerHTML = '';
    melody.forEach((note, i) => {
        const div = document.createElement('div');
        div.className = 'note-bubble';
        div.id = `bubble-${i}`;
        div.style.background = note.color;
        div.style.color = 'white';
        div.style.textShadow = '0 1px 3px rgba(0,0,0,0.5)';
        div.textContent = note.name.replace(/\d/, '');  // just letter name

        // Duration indicator
        if (note.duration >= 1.0) {
            const dot = document.createElement('div');
            dot.className = 'duration-dot';
            div.appendChild(dot);
        }
        container.appendChild(div);
    });
}

// ─── PLAYBACK ───
function startPlayback() {
    if (isPlaying) return;
    if (melody.length === 0) return;
    isPlaying = true;
    document.getElementById('playBtn').disabled = true;
    document.getElementById('stopBtn').disabled = false;

    playMelody();
}

function playMelody() {
    const bpm = parseInt(document.getElementById('tempoSelect').value);
    const beatDuration = 60 / bpm; // one beat in seconds
    const ctx = getAudioCtx();
    let t = ctx.currentTime + 0.05;
    let wallDelay = 50; // ms offset for UI sync

    playTimeouts = [];
    melody.forEach((note, i) => {
        const noteDur = note.duration * beatDuration;
        playNote(midiToFreq(note.midi), noteDur * 0.92, t);

        // Schedule UI highlight
        const delay = wallDelay + Math.round((t - ctx.currentTime) * 1000);
        const to1 = setTimeout(() => {
            highlightNote(i);
        }, delay);
        const to2 = setTimeout(() => {
            unhighlightNote(i);
        }, delay + Math.round(noteDur * 920));
        playTimeouts.push(to1, to2);

        t += noteDur;
    });

    // Total duration
    let totalMs = wallDelay;
    melody.forEach(n => { totalMs += Math.round(n.duration * beatDuration * 1000); });

    const endTo = setTimeout(() => {
        if (loopActive && isPlaying) {
            playMelody();
        } else {
            stopPlayback();
        }
    }, totalMs);
    playTimeouts.push(endTo);
}

function stopPlayback() {
    isPlaying = false;
    playTimeouts.forEach(t => clearTimeout(t));
    playTimeouts = [];
    // Clear all highlights
    melody.forEach((_, i) => unhighlightNote(i));
    document.getElementById('currentNote').textContent = '';
    document.getElementById('playBtn').disabled = melody.length === 0;
    document.getElementById('stopBtn').disabled = true;
    resetWaveBars();
}

function highlightNote(i) {
    const bub = document.getElementById(`bubble-${i}`);
    if (bub) bub.classList.add('active');

    const note = melody[i];
    document.getElementById('currentNote').textContent = note.name;
    document.getElementById('currentNote').style.color = note.color;

    highlightPianoKey(note.midi);
    animateWaveBars(note.color);
}

function unhighlightNote(i) {
    const bub = document.getElementById(`bubble-${i}`);
    if (bub) bub.classList.remove('active');
    unhighlightPianoKey();
}

// ─── PIANO ───
// MIDI range: C4 (60) to B5 (83) = 2 octaves
// White keys in that range: 14
// Build piano programmatically

const PIANO_START = 60; // C4
const PIANO_END = 83;   // B5

// Which MIDI notes are white keys
function isWhiteKey(midi) {
    const n = midi % 12;
    return [0,2,4,5,7,9,11].includes(n);
}

function buildPiano() {
    const piano = document.getElementById('piano');
    piano.innerHTML = '';

    const WK_WIDTH = 32;
    const BK_WIDTH = 22;

    // First, position all white keys
    let whitePos = 0;
    const keyEls = {}; // midi -> element

    for (let midi = PIANO_START; midi <= PIANO_END; midi++) {
        if (isWhiteKey(midi)) {
            const key = document.createElement('div');
            key.className = 'wk';
            key.id = `pk-${midi}`;
            // label only for C notes
            if (midi % 12 === 0) {
                const lbl = document.createElement('span');
                lbl.textContent = midiToName(midi);
                key.appendChild(lbl);
            }
            piano.appendChild(key);
            keyEls[midi] = { el: key, left: whitePos * WK_WIDTH };
            whitePos++;
        }
    }

    // Piano total width based on white key count
    piano.style.width = (whitePos * WK_WIDTH) + 'px';

    // Now add black keys (positioned absolutely)
    // For each octave, black key relative positions (in white-key units from start of octave):
    // C#=0.75, D#=1.75, F#=3.75, G#=4.75, A#=5.75
    const blackOffsets = { 1: 0.75, 3: 1.75, 6: 3.75, 8: 4.75, 10: 5.75 };

    let octStartWhite = 0;
    for (let octave = 4; octave <= 5; octave++) {
        const cMidi = 12 * (octave + 1); // C in this octave
        for (const [semitone, offset] of Object.entries(blackOffsets)) {
            const midi = cMidi + parseInt(semitone);
            if (midi < PIANO_START || midi > PIANO_END) continue;
            const key = document.createElement('div');
            key.className = 'bk';
            key.id = `pk-${midi}`;
            const leftPx = octStartWhite * WK_WIDTH + offset * WK_WIDTH - BK_WIDTH / 2;
            key.style.left = leftPx + 'px';
            piano.appendChild(key);
            keyEls[midi] = { el: key, left: leftPx };
        }
        // Count white keys in this octave
        let wc = 0;
        for (let m = cMidi; m < cMidi + 12; m++) {
            if (m < PIANO_START) continue;
            if (isWhiteKey(m)) wc++;
        }
        octStartWhite += wc;
    }
}

function updatePianoScale() {
    // Clear scale highlights
    document.querySelectorAll('.wk, .bk').forEach(el => {
        el.classList.remove('scale-note');
    });
    if (melody.length === 0) return;
    // Highlight all notes in melody
    const midiSet = new Set(melody.map(n => n.midi));
    midiSet.forEach(midi => {
        const el = document.getElementById(`pk-${midi}`);
        if (el) el.classList.add('scale-note');
    });
}

function highlightPianoKey(midi) {
    document.querySelectorAll('.wk.active, .bk.active').forEach(el => el.classList.remove('active'));
    const el = document.getElementById(`pk-${midi}`);
    if (el) {
        el.classList.add('active');
        // Scroll into view
        const pianoScroll = document.querySelector('.piano-scroll');
        if (pianoScroll && el) {
            const rect = el.getBoundingClientRect();
            const scrollRect = pianoScroll.getBoundingClientRect();
            if (rect.left < scrollRect.left || rect.right > scrollRect.right) {
                pianoScroll.scrollLeft += (rect.left - scrollRect.left) - pianoScroll.clientWidth / 3;
            }
        }
    }
}

function unhighlightPianoKey() {
    document.querySelectorAll('.wk.active, .bk.active').forEach(el => el.classList.remove('active'));
}

// ─── WAVE VISUALIZER ───
function buildWaveBars() {
    const container = document.getElementById('waveBars');
    container.innerHTML = '';
    for (let i = 0; i < 18; i++) {
        const bar = document.createElement('div');
        bar.className = 'wave-bar';
        bar.style.height = '4px';
        container.appendChild(bar);
    }
}

function animateWaveBars(color) {
    const bars = document.querySelectorAll('.wave-bar');
    bars.forEach(bar => {
        bar.style.background = color;
        bar.classList.add('active');
        const h = 6 + Math.random() * 28;
        bar.style.height = h + 'px';
        bar.style.background = `linear-gradient(to top, ${color}, #ffd93d)`;
    });
}

function resetWaveBars() {
    document.querySelectorAll('.wave-bar').forEach(bar => {
        bar.classList.remove('active');
        bar.style.height = '4px';
        bar.style.background = '#333';
    });
}

// ─── EVENT LISTENERS ───
document.getElementById('generateBtn').addEventListener('click', () => {
    generateMelody();
});

document.getElementById('playBtn').addEventListener('click', () => {
    getAudioCtx(); // Unlock audio on user gesture
    startPlayback();
});

document.getElementById('stopBtn').addEventListener('click', stopPlayback);

document.getElementById('loopBtn').addEventListener('click', () => {
    loopActive = !loopActive;
    document.getElementById('loopBtn').classList.toggle('active', loopActive);
});

// ─── INIT ───
buildPiano();
buildWaveBars();
</script>
</body>
</html>
