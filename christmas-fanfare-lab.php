<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Fanfare Lab</title>
    <style>
        :root {
            --bg: #12090f;
            --panel: rgba(39, 16, 28, 0.8);
            --panel-strong: rgba(58, 22, 37, 0.94);
            --ink: #fff6ec;
            --muted: #e8d3be;
            --gold: #f6c562;
            --gold-soft: #ffdf9d;
            --ruby: #d65a66;
            --pine: #17372d;
            --pine-soft: #2f5f52;
            --line: rgba(255, 235, 200, 0.14);
            --shadow: 0 18px 60px rgba(0, 0, 0, 0.45);
        }

        * { box-sizing: border-box; }

        @font-face {
            font-family: "GeorgiaFallback";
            src: local("Georgia");
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top, rgba(255, 207, 112, 0.15), transparent 30%),
                radial-gradient(circle at 20% 20%, rgba(214, 90, 102, 0.18), transparent 22%),
                radial-gradient(circle at 80% 30%, rgba(53, 102, 85, 0.16), transparent 24%),
                linear-gradient(180deg, #1e0b17 0%, #12090f 50%, #0d0c15 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(115deg, transparent 0 47%, rgba(255,255,255,0.03) 47% 49%, transparent 49% 100%),
                linear-gradient(65deg, transparent 0 39%, rgba(255,215,160,0.04) 39% 41%, transparent 41% 100%);
            opacity: 0.9;
        }

        .shell {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 56px;
            position: relative;
        }

        .hero {
            position: relative;
            padding: 28px 24px 32px;
            background: linear-gradient(180deg, rgba(73, 26, 47, 0.82), rgba(26, 13, 23, 0.94));
            border: 1px solid var(--line);
            border-radius: 28px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .hero::before {
            background:
                radial-gradient(circle at 15% 0%, rgba(255, 228, 162, 0.26), transparent 30%),
                radial-gradient(circle at 88% 8%, rgba(238, 114, 128, 0.18), transparent 26%);
        }

        .hero::after {
            background-image:
                linear-gradient(90deg, transparent 0%, rgba(255, 244, 210, 0.08) 50%, transparent 100%),
                repeating-linear-gradient(90deg, rgba(255,255,255,0.03) 0 1px, transparent 1px 92px);
            mix-blend-mode: screen;
            opacity: 0.45;
        }

        .eyebrow {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 239, 205, 0.08);
            border: 1px solid rgba(255, 229, 171, 0.2);
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold-soft);
        }

        h1 {
            margin: 18px 0 12px;
            font-size: clamp(2.2rem, 7vw, 5rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            max-width: 8ch;
        }

        .lead {
            max-width: 61ch;
            font-size: 1.05rem;
            line-height: 1.7;
            color: var(--muted);
            margin: 0 0 22px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 18px;
            align-items: end;
        }

        .hero-card,
        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.05), var(--shadow);
            backdrop-filter: blur(16px);
        }

        .hero-card {
            padding: 18px;
        }

        .hero-card h2,
        .panel h2 {
            margin: 0 0 10px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gold-soft);
        }

        .hero-card p,
        .panel p,
        .caption {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .trumpet-wrap {
            position: relative;
            min-height: 180px;
        }

        .trumpet {
            position: absolute;
            right: -14px;
            bottom: -24px;
            width: min(360px, 92%);
            filter: drop-shadow(0 24px 40px rgba(0,0,0,0.45));
        }

        .trumpet svg { width: 100%; height: auto; display: block; }

        .stage {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 18px;
            margin-top: 18px;
        }

        .panel {
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .panel::after {
            content: "";
            position: absolute;
            inset: auto -10% -45% 40%;
            height: 220px;
            background: radial-gradient(circle, rgba(255, 220, 128, 0.12), transparent 70%);
            pointer-events: none;
        }

        .meta-row,
        .control-row,
        .valve-row,
        .score-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .meta-chip,
        .mode-chip {
            padding: 9px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255, 239, 203, 0.16);
            background: rgba(255,255,255,0.04);
            color: var(--muted);
            font-size: 0.9rem;
        }

        .mode-chip.active {
            background: rgba(246, 197, 98, 0.14);
            color: var(--gold-soft);
            border-color: rgba(246, 197, 98, 0.35);
        }

        button {
            font: inherit;
            color: inherit;
            border: 0;
            cursor: pointer;
            transition: transform 120ms ease, box-shadow 120ms ease, background 120ms ease;
        }

        button:hover { transform: translateY(-1px); }
        button:active { transform: translateY(1px) scale(0.99); }

        .cta,
        .ghost,
        .note-btn,
        .valve,
        .ghost-square {
            border-radius: 16px;
        }

        .cta,
        .ghost {
            padding: 12px 16px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.12);
        }

        .cta {
            background: linear-gradient(180deg, #f7c96f, #d99638);
            color: #2b1707;
            font-weight: 700;
        }

        .ghost {
            background: rgba(255,255,255,0.05);
            color: var(--ink);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .staff {
            margin: 20px 0 16px;
            padding: 24px 14px 18px;
            border-radius: 22px;
            background:
                linear-gradient(180deg, rgba(255, 250, 241, 0.95), rgba(255, 239, 220, 0.92));
            color: #3b2716;
            position: relative;
            overflow: hidden;
        }

        .staff::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(
                    to bottom,
                    transparent 0 18px,
                    rgba(73, 39, 13, 0.25) 18px 20px,
                    transparent 20px 36px,
                    rgba(73, 39, 13, 0.25) 36px 38px,
                    transparent 38px 54px,
                    rgba(73, 39, 13, 0.25) 54px 56px,
                    transparent 56px 72px,
                    rgba(73, 39, 13, 0.25) 72px 74px,
                    transparent 74px 90px,
                    rgba(73, 39, 13, 0.25) 90px 92px,
                    transparent 92px 100%
                );
            opacity: 0.85;
        }

        .staff-head {
            position: relative;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 16px;
            z-index: 1;
        }

        .staff-head strong {
            font-size: 1rem;
            letter-spacing: 0.02em;
        }

        .staff-head span {
            color: rgba(59,39,22,0.72);
            font-size: 0.92rem;
        }

        .note-track {
            position: relative;
            display: flex;
            gap: 8px;
            padding: 10px 2px 6px;
            overflow-x: auto;
            z-index: 1;
        }

        .note-pill {
            min-width: 58px;
            padding: 36px 8px 12px;
            border-radius: 16px;
            text-align: center;
            background: rgba(91, 48, 21, 0.1);
            position: relative;
            border: 1px solid rgba(91, 48, 21, 0.16);
        }

        .note-pill::before {
            content: "";
            position: absolute;
            left: 50%;
            top: 12px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #4e2f17;
            transform: translateX(-50%);
            box-shadow: 12px -16px 0 -8px transparent;
        }

        .note-pill.active {
            background: rgba(214, 90, 102, 0.12);
            border-color: rgba(214, 90, 102, 0.4);
        }

        .note-pill.hit {
            background: rgba(47, 95, 82, 0.18);
            border-color: rgba(47, 95, 82, 0.45);
        }

        .note-pill small {
            display: block;
            font-size: 0.72rem;
            color: rgba(59,39,22,0.7);
            margin-top: 4px;
        }

        .piano {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 10px;
            margin-top: 18px;
        }

        .note-btn {
            min-height: 84px;
            padding: 10px 8px 12px;
            background: linear-gradient(180deg, #fffaf0, #e9dac2);
            color: #36210f;
            border: 1px solid rgba(85, 53, 25, 0.2);
            box-shadow: 0 8px 18px rgba(12, 6, 1, 0.12);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .note-btn span { font-size: 1.2rem; font-weight: 700; }
        .note-btn small { font-size: 0.73rem; opacity: 0.72; }
        .note-btn.is-lit {
            background: linear-gradient(180deg, #ffe7a9, #f2be59);
        }

        .valve-row { margin-top: 18px; }

        .valve {
            width: 64px;
            aspect-ratio: 1;
            background: linear-gradient(180deg, #f8cf73, #c3842f);
            color: #2a1609;
            box-shadow: 0 10px 16px rgba(0,0,0,0.25);
            font-weight: 700;
        }

        .valve.down {
            transform: translateY(8px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
        }

        .scoreboard {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 18px;
        }

        .stat {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .stat strong {
            display: block;
            font-size: 1.45rem;
            color: var(--gold-soft);
            margin-bottom: 4px;
        }

        .caption { font-size: 0.92rem; }

        .challenge-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 18px;
        }

        .ghost-square {
            padding: 16px;
            min-height: 140px;
            text-align: left;
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .ghost-square strong {
            display: block;
            margin-bottom: 6px;
            color: var(--gold-soft);
        }

        .sequence {
            margin-top: 16px;
            padding: 14px;
            border-radius: 18px;
            background: rgba(23, 55, 45, 0.45);
            border: 1px solid rgba(150, 212, 179, 0.14);
        }

        .sequence-code {
            font-size: 1.03rem;
            letter-spacing: 0.06em;
            line-height: 1.9;
        }

        .foot {
            margin-top: 18px;
            color: rgba(255,246,236,0.72);
            font-size: 0.86rem;
        }

        .toast {
            position: fixed;
            left: 50%;
            bottom: 18px;
            transform: translateX(-50%) translateY(16px);
            background: rgba(16, 12, 19, 0.92);
            color: var(--ink);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 999px;
            padding: 12px 16px;
            box-shadow: var(--shadow);
            opacity: 0;
            pointer-events: none;
            transition: 180ms ease;
            z-index: 10;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        @media (max-width: 920px) {
            .hero-grid,
            .stage {
                grid-template-columns: 1fr;
            }
            .trumpet-wrap { min-height: 140px; }
            .trumpet { position: relative; right: auto; bottom: auto; margin-left: auto; }
        }

        @media (max-width: 640px) {
            .shell { width: min(100% - 18px, 1000px); padding-top: 10px; }
            .hero, .panel { border-radius: 22px; }
            .hero { padding: 22px 18px 24px; }
            h1 { font-size: 2.6rem; }
            .piano { grid-template-columns: repeat(4, 1fr); }
            .scoreboard, .challenge-grid { grid-template-columns: 1fr; }
            .note-pill { min-width: 52px; }
            .valve { width: 58px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="eyebrow">Brass loft • Christmas morning • Sacred Heart</div>
            <div class="hero-grid">
                <div>
                    <h1>Christmas Fanfare Lab</h1>
                    <p class="lead">A jewel-toned little trumpet playground inspired by Jon being asked to play <em>Joy to the World</em> at Christmas Mass. Tap notes, lift the melody an octave, switch between concert pitch and B♭ trumpet, and see if your fingers can survive a tiny festive pressure situation.</p>
                    <div class="meta-row">
                        <div class="meta-chip">Theme: stained-glass brass bench</div>
                        <div class="meta-chip">Mode: hear, practise, perform</div>
                        <div class="meta-chip">Best on mobile too, because pews are cramped</div>
                    </div>
                </div>
                <div class="hero-card trumpet-wrap">
                    <h2>Tonight's assignment</h2>
                    <p>Play the final hymn in C, maybe an octave higher, and sound calm about it. Classic church-musician energy.</p>
                    <div class="trumpet" aria-hidden="true">
                        <svg viewBox="0 0 520 220" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="brass" x1="0" x2="1">
                                    <stop offset="0%" stop-color="#FFD887"/>
                                    <stop offset="38%" stop-color="#C9872C"/>
                                    <stop offset="70%" stop-color="#F7D48A"/>
                                    <stop offset="100%" stop-color="#9B6021"/>
                                </linearGradient>
                            </defs>
                            <path d="M27 141C75 141 99 121 137 121H275C319 121 361 92 397 86L492 70L500 96L405 112C377 116 355 130 325 145H183C142 145 94 165 27 165V141Z" fill="url(#brass)"/>
                            <path d="M397 86C427 59 460 41 505 35L509 62C467 67 438 81 410 104L397 86Z" fill="url(#brass)"/>
                            <circle cx="506" cy="48" r="12" stroke="#FFE8B9" stroke-width="10"/>
                            <rect x="182" y="84" width="24" height="56" rx="10" fill="url(#brass)"/>
                            <rect x="227" y="84" width="24" height="56" rx="10" fill="url(#brass)"/>
                            <rect x="272" y="84" width="24" height="56" rx="10" fill="url(#brass)"/>
                            <rect x="186" y="54" width="16" height="36" rx="8" fill="#F8E0AA"/>
                            <rect x="231" y="54" width="16" height="36" rx="8" fill="#F8E0AA"/>
                            <rect x="276" y="54" width="16" height="36" rx="8" fill="#F8E0AA"/>
                            <path d="M87 124C97 103 115 95 132 95H150V113H137C126 113 116 118 109 131L87 124Z" fill="url(#brass)"/>
                            <circle cx="64" cy="132" r="26" fill="#E8C170" stroke="#9B6021" stroke-width="6"/>
                            <circle cx="64" cy="132" r="10" fill="#8C531C"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <section class="stage">
            <article class="panel">
                <h2>Play the line</h2>
                <p>Use the brass keys to rehearse the opening phrase of <em>Joy to the World</em>. The note ribbon highlights the target melody while your taps light up in real time.</p>

                <div class="control-row" style="margin-top:16px;">
                    <button class="cta" id="playDemo">Hear the phrase</button>
                    <button class="ghost" id="playChallenge">Challenge mode</button>
                    <button class="ghost" id="resetRun">Reset attempt</button>
                </div>

                <div class="control-row" style="margin-top:12px;">
                    <button class="mode-chip active" id="concertMode" type="button">Concert pitch</button>
                    <button class="mode-chip" id="trumpetMode" type="button">B♭ trumpet view</button>
                    <button class="mode-chip" id="octaveLift" type="button">Octave lift: off</button>
                </div>

                <div class="staff">
                    <div class="staff-head">
                        <strong id="staffTitle">Opening phrase in concert pitch</strong>
                        <span id="staffSubtitle">Tap the glowing targets or listen first.</span>
                    </div>
                    <div class="note-track" id="noteTrack"></div>
                </div>

                <div class="piano" id="noteButtons"></div>

                <div class="valve-row" id="valves" aria-label="Trumpet valves">
                    <button class="valve" type="button" data-valve="1">1</button>
                    <button class="valve" type="button" data-valve="2">2</button>
                    <button class="valve" type="button" data-valve="3">3</button>
                </div>

                <div class="scoreboard">
                    <div class="stat"><strong id="correctCount">0</strong><span class="caption">Correct notes in a row</span></div>
                    <div class="stat"><strong id="bestRun">0</strong><span class="caption">Best rehearsal streak</span></div>
                    <div class="stat"><strong id="currentHint">C</strong><span class="caption">Current target</span></div>
                </div>
            </article>

            <aside class="panel">
                <h2>Brass cheat sheet</h2>
                <p>Because every cheerful church request eventually becomes a practical question about transposition, range, and pretending you are absolutely not scrambling.</p>

                <div class="challenge-grid">
                    <div class="ghost-square">
                        <strong>Pitch switch</strong>
                        <p>Concert pitch shows the sounding notes. B♭ trumpet view moves everything up a whole step, which is what the player reads.</p>
                    </div>
                    <div class="ghost-square">
                        <strong>Octave lift</strong>
                        <p>Toggle the lift to imagine the melody kicked upward for extra sparkle. Same shape, shinier ceiling.</p>
                    </div>
                    <div class="ghost-square">
                        <strong>Valve memory</strong>
                        <p>C = open, D = 1+3, E = 1+2, F = 1, G = open, A = 1+2, B = 2. Your fingers get the gossip fast.</p>
                    </div>
                    <div class="ghost-square">
                        <strong>Little performance game</strong>
                        <p>Challenge mode asks you to play the phrase from memory. Nail all eight notes and the lab will behave as if the congregation noticed.</p>
                    </div>
                </div>

                <div class="sequence">
                    <h2 style="margin-bottom:8px;">Phrase map</h2>
                    <div class="sequence-code" id="sequenceCode">C • B • A • G • F • E • D • C</div>
                    <p class="foot">The opening drops step by step, which is why it feels so satisfyingly inevitable. It is basically a staircase wearing Christmas clothes.</p>
                </div>
            </aside>
        </section>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        const concertScale = [
            { note: 'C', trumpet: 'D', freq: 261.63, valves: [] },
            { note: 'D', trumpet: 'E', freq: 293.66, valves: [1,3] },
            { note: 'E', trumpet: 'F#', freq: 329.63, valves: [1,2] },
            { note: 'F', trumpet: 'G', freq: 349.23, valves: [1] },
            { note: 'G', trumpet: 'A', freq: 392.00, valves: [] },
            { note: 'A', trumpet: 'B', freq: 440.00, valves: [1,2] },
            { note: 'B', trumpet: 'C#', freq: 493.88, valves: [2] },
            { note: 'C2', trumpet: 'D2', freq: 523.25, valves: [] }
        ];

        const melody = ['C2', 'B', 'A', 'G', 'F', 'E', 'D', 'C'];
        const byNote = Object.fromEntries(concertScale.map(n => [n.note, n]));
        const visibleOrder = ['C', 'D', 'E', 'F', 'G', 'A', 'B', 'C2'];

        const noteTrack = document.getElementById('noteTrack');
        const noteButtons = document.getElementById('noteButtons');
        const sequenceCode = document.getElementById('sequenceCode');
        const correctCount = document.getElementById('correctCount');
        const bestRun = document.getElementById('bestRun');
        const currentHint = document.getElementById('currentHint');
        const staffTitle = document.getElementById('staffTitle');
        const staffSubtitle = document.getElementById('staffSubtitle');
        const toast = document.getElementById('toast');
        const valveButtons = [...document.querySelectorAll('.valve')];
        const concertMode = document.getElementById('concertMode');
        const trumpetMode = document.getElementById('trumpetMode');
        const octaveLift = document.getElementById('octaveLift');

        let useTrumpetView = false;
        let lifted = false;
        let streak = 0;
        let best = Number(localStorage.getItem('christmasFanfareBest') || 0);
        let challengeActive = false;
        let pointer = 0;
        let audioContext;
        let hideToastTimer;

        function labelFor(noteKey) {
            const item = byNote[noteKey];
            if (!item) return noteKey;
            return useTrumpetView ? item.trumpet : item.note.replace('2', '↑');
        }

        function getFrequency(noteKey) {
            const item = byNote[noteKey];
            if (!item) return 440;
            return lifted ? item.freq * 2 : item.freq;
        }

        function getMelodyLabelList() {
            return melody.map(labelFor).join(' • ');
        }

        function getCurrentTarget() {
            return melody[pointer] || melody[0];
        }

        function renderTrack() {
            noteTrack.innerHTML = '';
            melody.forEach((noteKey, index) => {
                const pill = document.createElement('div');
                pill.className = 'note-pill';
                if (index === pointer) pill.classList.add('active');
                if (index < pointer) pill.classList.add('hit');
                pill.innerHTML = `<div>${labelFor(noteKey)}</div><small>${index + 1}</small>`;
                noteTrack.appendChild(pill);
            });
            sequenceCode.textContent = getMelodyLabelList();
            currentHint.textContent = labelFor(getCurrentTarget());
            staffTitle.textContent = useTrumpetView ? 'Opening phrase in B♭ trumpet view' : 'Opening phrase in concert pitch';
            staffSubtitle.textContent = lifted ? 'Octave lift is on. Sparkly and slightly nerve-inducing.' : 'Tap the glowing targets or listen first.';
        }

        function renderButtons() {
            noteButtons.innerHTML = '';
            visibleOrder.forEach(noteKey => {
                const btn = document.createElement('button');
                btn.className = 'note-btn';
                btn.type = 'button';
                btn.dataset.note = noteKey;
                btn.innerHTML = `<span>${labelFor(noteKey)}</span><small>${byNote[noteKey].valves.length ? 'Valves ' + byNote[noteKey].valves.join('+') : 'Open'}</small>`;
                btn.addEventListener('click', () => handleNote(noteKey, btn));
                noteButtons.appendChild(btn);
            });
        }

        function ensureAudio() {
            if (!audioContext) {
                audioContext = new (window.AudioContext || window.webkitAudioContext)();
            }
        }

        function playTone(freq, duration = 0.42) {
            ensureAudio();
            const now = audioContext.currentTime;
            const osc = audioContext.createOscillator();
            const gain = audioContext.createGain();
            const filter = audioContext.createBiquadFilter();

            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(freq, now);
            filter.type = 'lowpass';
            filter.frequency.setValueAtTime(1400, now);
            gain.gain.setValueAtTime(0.001, now);
            gain.gain.exponentialRampToValueAtTime(0.12, now + 0.03);
            gain.gain.exponentialRampToValueAtTime(0.001, now + duration);

            osc.connect(filter);
            filter.connect(gain);
            gain.connect(audioContext.destination);
            osc.start(now);
            osc.stop(now + duration + 0.02);
        }

        function updateValves(noteKey) {
            const active = new Set(byNote[noteKey].valves);
            valveButtons.forEach(btn => {
                btn.classList.toggle('down', active.has(Number(btn.dataset.valve)));
            });
        }

        function pulseButton(button) {
            if (!button) return;
            button.classList.add('is-lit');
            setTimeout(() => button.classList.remove('is-lit'), 180);
        }

        function showToast(message) {
            toast.textContent = message;
            toast.classList.add('show');
            clearTimeout(hideToastTimer);
            hideToastTimer = setTimeout(() => toast.classList.remove('show'), 2200);
        }

        function storeBest() {
            localStorage.setItem('christmasFanfareBest', String(best));
        }

        function refreshStats() {
            correctCount.textContent = streak;
            bestRun.textContent = best;
            currentHint.textContent = labelFor(getCurrentTarget());
        }

        function resetAttempt(silent = false) {
            streak = 0;
            pointer = 0;
            challengeActive = false;
            renderTrack();
            refreshStats();
            updateValves('C');
            if (!silent) showToast('Attempt reset. Deep breath, maestro.');
        }

        function handleNote(noteKey, button) {
            pulseButton(button);
            updateValves(noteKey);
            playTone(getFrequency(noteKey));

            const target = getCurrentTarget();
            if (noteKey === target) {
                pointer += 1;
                streak += 1;
                if (streak > best) {
                    best = streak;
                    storeBest();
                }
                if (pointer >= melody.length) {
                    renderTrack();
                    refreshStats();
                    showToast(challengeActive ? 'Phrase complete. Very respectable brass behaviour.' : 'Full phrase clean. Christmas saved.');
                    challengeActive = false;
                    pointer = 0;
                    renderTrack();
                    refreshStats();
                    return;
                }
            } else if (challengeActive) {
                streak = 0;
                pointer = 0;
                showToast(`Oops. Wanted ${labelFor(target)}.`);
            }

            renderTrack();
            refreshStats();
        }

        async function playMelody() {
            for (const noteKey of melody) {
                updateValves(noteKey);
                playTone(getFrequency(noteKey), 0.36);
                await new Promise(resolve => setTimeout(resolve, 400));
            }
            updateValves('C');
        }

        concertMode.addEventListener('click', () => {
            useTrumpetView = false;
            concertMode.classList.add('active');
            trumpetMode.classList.remove('active');
            renderTrack();
            renderButtons();
            refreshStats();
        });

        trumpetMode.addEventListener('click', () => {
            useTrumpetView = true;
            trumpetMode.classList.add('active');
            concertMode.classList.remove('active');
            renderTrack();
            renderButtons();
            refreshStats();
        });

        octaveLift.addEventListener('click', () => {
            lifted = !lifted;
            octaveLift.classList.toggle('active', lifted);
            octaveLift.textContent = `Octave lift: ${lifted ? 'on' : 'off'}`;
            renderTrack();
        });

        document.getElementById('playDemo').addEventListener('click', async () => {
            showToast('Listening run...');
            await playMelody();
        });

        document.getElementById('playChallenge').addEventListener('click', () => {
            challengeActive = true;
            streak = 0;
            pointer = 0;
            renderTrack();
            refreshStats();
            showToast('Challenge mode on. Eight notes. No melodrama.');
        });

        document.getElementById('resetRun').addEventListener('click', () => resetAttempt());

        bestRun.textContent = best;
        renderTrack();
        renderButtons();
        refreshStats();
        updateValves('C');
    </script>
</body>
</html>
