<?php
$title = 'Colloquy Chorus';
$blogTitle = 'Text-to-speech IRC client on Mac OS X';
$blogUrl = 'https://jona.ca/2010/05/text-to-speech-irc-client-on-mac-os-x.html';
$date = '2026-05-19';
$sampleTranscript = [
    'Jon: I wanted chat to read itself like a tiny radio play.',
    'Chloe: Naturally. The internet is improved by a narrator.',
    'Nathan: Can it say "Turbo boost" without sounding bored?',
    'Jon: If the browser cooperates, anything is possible.',
    'KITT: Alert. Mac switch detected. Scanner bar online.',
    'Chloe: This is either brilliant or a cry for help.',
];

function h($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($title); ?></title>
    <style>
        :root {
            --bg-a: #07131f;
            --bg-b: #0d2434;
            --bg-c: #183d50;
            --panel: rgba(17, 32, 45, 0.72);
            --panel-2: rgba(8, 17, 28, 0.66);
            --line: rgba(173, 226, 255, 0.18);
            --line-strong: rgba(173, 226, 255, 0.34);
            --text: #f3fbff;
            --muted: rgba(227, 243, 255, 0.74);
            --accent: #72e5ff;
            --accent-2: #8de0a2;
            --warn: #ffd36f;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.42);
            --radius-xl: 28px;
            --radius-lg: 22px;
            --radius-md: 16px;
            --radius-sm: 12px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html, body { min-height: 100%; }

        body {
            margin: 0;
            color: var(--text);
            background:
                radial-gradient(circle at 15% 15%, rgba(114, 229, 255, 0.18), transparent 28%),
                radial-gradient(circle at 85% 15%, rgba(141, 224, 162, 0.16), transparent 24%),
                radial-gradient(circle at 75% 82%, rgba(75, 162, 255, 0.12), transparent 28%),
                linear-gradient(145deg, var(--bg-a), var(--bg-b) 45%, var(--bg-c));
            font-family: "Avenir Next", "Avenir", "Helvetica Neue", "Gill Sans", sans-serif;
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        body::before {
            background:
                linear-gradient(rgba(255,255,255,0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 100% 38px, 38px 100%;
            opacity: 0.18;
            mask-image: radial-gradient(circle at 50% 15%, black 15%, transparent 82%);
        }

        body::after {
            background: radial-gradient(circle at center, transparent 0 72%, rgba(0,0,0,0.22) 100%);
        }

        .wrap {
            position: relative;
            width: min(1240px, calc(100vw - 28px));
            margin: 0 auto;
            padding: 28px 0 40px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 30px 30px 24px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: calc(var(--radius-xl) + 8px);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.13), rgba(255,255,255,0.03)),
                linear-gradient(180deg, rgba(13, 36, 52, 0.88), rgba(8, 18, 30, 0.82));
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 10% 0%, rgba(114,229,255,0.18), transparent 26%),
                radial-gradient(circle at 92% 10%, rgba(141,224,162,0.12), transparent 24%);
            pointer-events: none;
        }

        .eyebrow {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            color: rgba(233, 247, 255, 0.9);
            text-transform: uppercase;
            letter-spacing: 0.22em;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 16px rgba(114, 229, 255, 0.8);
        }

        h1 {
            position: relative;
            margin: 18px 0 12px;
            font-family: "Baskerville", "Iowan Old Style", "Palatino Linotype", serif;
            font-size: clamp(2.6rem, 5vw, 5.3rem);
            line-height: 0.95;
            letter-spacing: -0.06em;
            font-weight: 700;
            text-wrap: balance;
        }

        .lede {
            position: relative;
            max-width: 58rem;
            margin: 0;
            color: var(--muted);
            font-size: clamp(1rem, 2vw, 1.12rem);
            line-height: 1.7;
        }

        .lede strong {
            color: var(--text);
            font-weight: 700;
        }

        .meta-row {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            color: rgba(241, 249, 255, 0.92);
            font-size: 0.85rem;
            line-height: 1;
            white-space: nowrap;
        }

        .pill.accent {
            background: linear-gradient(180deg, rgba(114,229,255,0.18), rgba(114,229,255,0.06));
            border-color: rgba(114,229,255,0.34);
        }

        .pill.good {
            background: linear-gradient(180deg, rgba(141,224,162,0.18), rgba(141,224,162,0.06));
            border-color: rgba(141,224,162,0.34);
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(320px, 0.9fr);
            gap: 18px;
            margin-top: 18px;
            align-items: start;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: var(--radius-xl);
            background: linear-gradient(180deg, var(--panel), var(--panel-2));
            box-shadow: 0 16px 48px rgba(0,0,0,0.24);
            backdrop-filter: blur(16px);
            overflow: clip;
        }

        .panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .panel-head h2 {
            margin: 0;
            font-family: "Baskerville", "Iowan Old Style", serif;
            font-size: 1.55rem;
            letter-spacing: -0.03em;
        }

        .panel-head p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
        }

        button, select, textarea, input[type="range"] {
            font: inherit;
        }

        .btn {
            appearance: none;
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 14px;
            padding: 11px 14px;
            color: var(--text);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.16), rgba(255,255,255,0.06)),
                linear-gradient(180deg, rgba(49, 86, 108, 0.98), rgba(21, 44, 63, 0.98));
            box-shadow: 0 8px 18px rgba(0,0,0,0.22);
            cursor: pointer;
            transition: transform 150ms ease, border-color 150ms ease, box-shadow 150ms ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            border-color: rgba(114,229,255,0.34);
            box-shadow: 0 12px 20px rgba(0,0,0,0.26);
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn.primary {
            border-color: rgba(114,229,255,0.42);
            background:
                linear-gradient(180deg, rgba(114,229,255,0.24), rgba(114,229,255,0.1)),
                linear-gradient(180deg, rgba(29, 87, 111, 1), rgba(10, 48, 69, 1));
        }

        .btn.ghost {
            background:
                linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03)),
                rgba(8, 16, 26, 0.84);
        }

        .editor {
            padding: 18px 20px 20px;
        }

        textarea {
            width: 100%;
            min-height: 162px;
            resize: vertical;
            border: 1px solid rgba(255,255,255,0.13);
            border-radius: 18px;
            padding: 16px 16px 15px;
            color: var(--text);
            background:
                linear-gradient(180deg, rgba(0,0,0,0.12), rgba(255,255,255,0.03)),
                rgba(8, 18, 28, 0.9);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.06);
            line-height: 1.6;
            outline: none;
        }

        textarea:focus {
            border-color: rgba(114,229,255,0.44);
            box-shadow:
                0 0 0 3px rgba(114,229,255,0.08),
                inset 0 1px 0 rgba(255,255,255,0.06);
        }

        .hint {
            margin-top: 10px;
            color: rgba(227, 243, 255, 0.62);
            font-size: 0.84rem;
            line-height: 1.45;
        }

        .timeline {
            display: grid;
            gap: 10px;
            margin-top: 18px;
        }

        .line-card {
            display: grid;
            grid-template-columns: 30px minmax(0, 1fr) auto;
            gap: 12px;
            align-items: start;
            padding: 14px 14px 13px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 18px;
            background: rgba(7, 15, 23, 0.56);
            transition: transform 160ms ease, border-color 160ms ease, background 160ms ease, box-shadow 160ms ease;
        }

        .line-card:hover {
            border-color: rgba(114,229,255,0.24);
            background: rgba(11, 23, 34, 0.7);
        }

        .line-card.active {
            border-color: rgba(114,229,255,0.58);
            box-shadow: 0 0 0 1px rgba(114,229,255,0.18), 0 0 26px rgba(114,229,255,0.1);
            transform: translateY(-1px);
        }

        .speaker-dot {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            box-shadow:
                inset 0 1px 2px rgba(255,255,255,0.2),
                0 8px 20px rgba(0,0,0,0.22);
            border: 1px solid rgba(255,255,255,0.22);
        }

        .line-body {
            min-width: 0;
        }

        .line-top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .nick {
            font-weight: 700;
            letter-spacing: 0.01em;
        }

        .line-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 8px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.06);
            color: rgba(243, 251, 255, 0.82);
            font-size: 0.77rem;
        }

        .line-message {
            color: rgba(243, 251, 255, 0.92);
            line-height: 1.55;
            font-size: 0.98rem;
            word-break: break-word;
        }

        .line-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
        }

        .mini-btn {
            appearance: none;
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 12px;
            padding: 8px 10px;
            background: rgba(255,255,255,0.06);
            color: var(--text);
            cursor: pointer;
        }

        .mini-btn:hover { border-color: rgba(114,229,255,0.28); }

        .tiny {
            color: rgba(227,243,255,0.62);
            font-size: 0.76rem;
        }

        .cast {
            padding-bottom: 4px;
        }

        .speaker-list {
            display: grid;
            gap: 12px;
            padding: 18px 20px 20px;
        }

        .speaker-card {
            padding: 14px;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(0,0,0,0.12));
        }

        .speaker-card header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 12px;
        }

        .speaker-card h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            font-size: 1rem;
            letter-spacing: 0.01em;
        }

        .speaker-meta {
            color: rgba(227,243,255,0.65);
            font-size: 0.78rem;
        }

        .voice-row,
        .control-row {
            display: grid;
            gap: 8px;
            margin-top: 10px;
        }

        .voice-row label,
        .control-row label {
            display: grid;
            gap: 7px;
            color: rgba(243,251,255,0.78);
            font-size: 0.82rem;
        }

        .voice-row select,
        .voice-row input[type="text"] {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.13);
            border-radius: 12px;
            padding: 10px 12px;
            color: var(--text);
            background: rgba(6, 15, 24, 0.92);
        }

        .slider-row {
            display: grid;
            gap: 5px;
        }

        .slider-row .value {
            color: rgba(243,251,255,0.64);
            font-size: 0.75rem;
            text-align: right;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--accent);
        }

        .preview-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .status-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 14px;
            padding: 14px 16px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.11);
            background: rgba(8, 15, 25, 0.62);
        }

        .status-copy {
            display: grid;
            gap: 4px;
        }

        .status-copy strong {
            font-size: 0.96rem;
            letter-spacing: 0.01em;
        }

        .status-copy span {
            color: rgba(227,243,255,0.66);
            font-size: 0.82rem;
        }

        .equalizer {
            display: flex;
            align-items: end;
            gap: 5px;
            min-width: 96px;
            height: 34px;
        }

        .bar {
            width: 9px;
            height: 9px;
            border-radius: 999px;
            background: linear-gradient(180deg, rgba(114,229,255,0.95), rgba(141,224,162,0.72));
            box-shadow: 0 0 12px rgba(114,229,255,0.3);
            opacity: 0.42;
            transform-origin: bottom center;
        }

        .speaking .bar {
            animation: pulse 700ms ease-in-out infinite;
        }

        .speaking .bar:nth-child(2) { animation-delay: 90ms; }
        .speaking .bar:nth-child(3) { animation-delay: 140ms; }
        .speaking .bar:nth-child(4) { animation-delay: 40ms; }
        .speaking .bar:nth-child(5) { animation-delay: 170ms; }
        .speaking .bar:nth-child(6) { animation-delay: 70ms; }

        @keyframes pulse {
            0%, 100% { transform: scaleY(0.42); opacity: 0.45; }
            50% { transform: scaleY(1.65); opacity: 1; }
        }

        .footer-note {
            margin: 16px 4px 0;
            color: rgba(227,243,255,0.56);
            font-size: 0.8rem;
            line-height: 1.5;
        }

        .footer-note a {
            color: inherit;
        }

        .support-bad {
            border-color: rgba(255, 128, 128, 0.34) !important;
            color: #ffd9d9 !important;
        }

        @media (max-width: 980px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .wrap { width: min(100vw - 16px, 1240px); padding-top: 8px; }
            .hero {
                padding: 22px 16px 18px;
                border-radius: 24px;
            }
            .panel-head,
            .editor,
            .speaker-list {
                padding-left: 14px;
                padding-right: 14px;
            }
            .panel-head {
                flex-direction: column;
            }
            .actions {
                justify-content: flex-start;
            }
            .line-card {
                grid-template-columns: 30px minmax(0, 1fr);
            }
            .line-actions {
                grid-column: 2;
                flex-direction: row;
                align-items: center;
                justify-content: flex-start;
            }
            .status-bar {
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <span class="eyebrow">Mac OS X radio play lab</span>
            <h1><?php echo h($title); ?></h1>
            <p class="lede">
                Build an IRC room that talks back. Paste a transcript, assign voices to each speaker, tune rate and pitch, and
                press play to turn the room into a tiny performance. Inspired by Jon's
                <strong><?php echo h($blogTitle); ?></strong> post about getting text-to-speech working in an IRC client on Mac OS X.
            </p>
            <div class="meta-row">
                <span class="pill accent" id="support-pill">speechSynthesis loading...</span>
                <span class="pill" id="line-pill">0 lines</span>
                <span class="pill good" id="speaker-pill">0 speakers</span>
                <span class="pill">Sample date: <?php echo h($date); ?></span>
            </div>
        </section>

        <div class="grid">
            <section class="panel">
                <div class="panel-head">
                    <div>
                        <h2>Transcript</h2>
                        <p>Use the IRC-style format <strong>Nick: message</strong>. Every speaker gets a voice card below.</p>
                    </div>
                    <div class="actions">
                        <button class="btn ghost" id="loadSample" type="button">Load sample</button>
                        <button class="btn ghost" id="clearTranscript" type="button">Clear</button>
                        <button class="btn primary" id="playQueue" type="button">Speak queue</button>
                        <button class="btn" id="stopQueue" type="button">Stop</button>
                    </div>
                </div>
                <div class="editor">
                    <textarea id="transcript" spellcheck="false" aria-label="IRC transcript"></textarea>
                    <div class="hint">
                        Tip: each line becomes a spoken cue. Click any transcript row to preview just that line. When speech is active, the equalizer wakes up and the current line glows.
                    </div>

                    <div class="timeline" id="timeline"></div>
                </div>
            </section>

            <aside class="panel cast">
                <div class="panel-head">
                    <div>
                        <h2>Cast</h2>
                        <p>Assign browser voices, then shape the room's tone. A bit like directing a tiny newsroom with better hair.</p>
                    </div>
                    <div class="actions">
                        <button class="btn ghost" id="shuffleCast" type="button">Shuffle cast</button>
                    </div>
                </div>
                <div class="speaker-list" id="speakerList"></div>
                <div class="status-bar">
                    <div class="status-copy">
                        <strong id="playbackState">Idle</strong>
                        <span id="playbackDetail">Ready to read the room aloud.</span>
                    </div>
                    <div class="equalizer" id="equalizer" aria-hidden="true">
                        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                        <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                    </div>
                </div>
            </aside>
        </div>

        <p class="footer-note">
            This page stays self-contained and uses the browser's built-in speech engine. If your browser has no voices, it still works as a transcript and mixer.
        </p>
    </div>

    <script>
    (() => {
        const sampleTranscript = <?php echo json_encode($sampleTranscript, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
        const initialTranscript = sampleTranscript.join("\n");
        const storageKey = 'colloquy-chorus-state-v1';

        const transcriptEl = document.getElementById('transcript');
        const timelineEl = document.getElementById('timeline');
        const speakerListEl = document.getElementById('speakerList');
        const playbackStateEl = document.getElementById('playbackState');
        const playbackDetailEl = document.getElementById('playbackDetail');
        const supportPillEl = document.getElementById('support-pill');
        const linePillEl = document.getElementById('line-pill');
        const speakerPillEl = document.getElementById('speaker-pill');
        const equalizerEl = document.getElementById('equalizer');
        const loadSampleBtn = document.getElementById('loadSample');
        const clearTranscriptBtn = document.getElementById('clearTranscript');
        const playQueueBtn = document.getElementById('playQueue');
        const stopQueueBtn = document.getElementById('stopQueue');
        const shuffleCastBtn = document.getElementById('shuffleCast');

        const speechSupported = 'speechSynthesis' in window && 'SpeechSynthesisUtterance' in window;
        let voices = [];
        let profiles = {};
        let activeLineIndex = -1;
        let speaking = false;
        let currentCancelToken = 0;

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function hashString(input) {
            let hash = 0;
            for (let i = 0; i < input.length; i++) {
                hash = ((hash << 5) - hash) + input.charCodeAt(i);
                hash |= 0;
            }
            return Math.abs(hash);
        }

        function colorForName(name) {
            const hash = hashString(name);
            const hue = hash % 360;
            const sat = 64 + (hash % 12);
            const light = 54 + (hash % 8);
            return `hsl(${hue} ${sat}% ${light}%)`;
        }

        function defaultProfile(name, index) {
            const defaultVoice = voices.length
                ? voices[(index * 3 + name.length) % voices.length].name
                : '';

            return {
                name,
                voice: defaultVoice,
                rate: (0.92 + (index % 4) * 0.07).toFixed(2),
                pitch: (0.92 + (hashString(name) % 6) * 0.05).toFixed(2),
                volume: 1
            };
        }

        function loadState() {
            try {
                const raw = localStorage.getItem(storageKey);
                if (!raw) return;
                const parsed = JSON.parse(raw);
                if (parsed && typeof parsed === 'object') {
                    if (typeof parsed.transcript === 'string') {
                        transcriptEl.value = parsed.transcript;
                    }
                    if (parsed.profiles && typeof parsed.profiles === 'object') {
                        profiles = parsed.profiles;
                    }
                }
            } catch (error) {
                console.warn(error);
            }
        }

        function saveState() {
            try {
                localStorage.setItem(storageKey, JSON.stringify({
                    transcript: transcriptEl.value,
                    profiles
                }));
            } catch (error) {
                console.warn(error);
            }
        }

        function parseTranscript(text) {
            return text
                .split(/\r?\n/)
                .map(line => line.trim())
                .filter(Boolean)
                .map((line, index) => {
                    const match = line.match(/^([^:]{1,40}):\s*(.+)$/);
                    if (!match) {
                        return {
                            index,
                            raw: line,
                            speaker: 'Narrator',
                            message: line
                        };
                    }

                    return {
                        index,
                        raw: line,
                        speaker: match[1].trim(),
                        message: match[2].trim()
                    };
                });
        }

        function getUniqueSpeakers(lines) {
            const order = [];
            const seen = new Set();
            for (const line of lines) {
                if (!seen.has(line.speaker)) {
                    seen.add(line.speaker);
                    order.push(line.speaker);
                }
            }
            return order;
        }

        function ensureProfiles(speakers) {
            speakers.forEach((speaker, index) => {
                const existing = profiles[speaker] || {};
                const fallback = defaultProfile(speaker, index);
                profiles[speaker] = {
                    ...fallback,
                    ...existing,
                    name: speaker,
                    voice: existing.voice || fallback.voice
                };
            });
        }

        function updateSupportState() {
            if (speechSupported) {
                supportPillEl.textContent = 'speechSynthesis ready';
                supportPillEl.classList.remove('support-bad');
            } else {
                supportPillEl.textContent = 'speechSynthesis unavailable';
                supportPillEl.classList.add('support-bad');
            }
        }

        function populateVoiceSelect(select, currentVoice) {
            select.innerHTML = '';
            const blank = document.createElement('option');
            blank.value = '';
            blank.textContent = voices.length ? 'Choose a voice' : 'No voices found';
            select.appendChild(blank);

            const voiceGroups = [...voices].sort((a, b) => {
                const langDiff = a.lang.localeCompare(b.lang);
                return langDiff !== 0 ? langDiff : a.name.localeCompare(b.name);
            });

            for (const voice of voiceGroups) {
                const option = document.createElement('option');
                option.value = voice.name;
                option.textContent = `${voice.name} · ${voice.lang}${voice.default ? ' · default' : ''}`;
                if (voice.name === currentVoice) {
                    option.selected = true;
                }
                select.appendChild(option);
            }
        }

        function makeRangeRow(labelText, field, speaker, value, min, max, step, suffix) {
            const wrapper = document.createElement('div');
            wrapper.className = 'slider-row';

            const label = document.createElement('label');
            label.textContent = labelText;

            const valueEl = document.createElement('span');
            valueEl.className = 'value';
            valueEl.textContent = `${value}${suffix || ''}`;
            label.appendChild(valueEl);

            const range = document.createElement('input');
            range.type = 'range';
            range.min = min;
            range.max = max;
            range.step = step;
            range.value = value;
            range.addEventListener('input', () => {
                profiles[speaker][field] = range.value;
                valueEl.textContent = `${range.value}${suffix || ''}`;
                saveState();
            });

            wrapper.appendChild(label);
            wrapper.appendChild(range);
            return wrapper;
        }

        function buildSpeakerCard(speaker, index) {
            const profile = profiles[speaker] || defaultProfile(speaker, index);
            profiles[speaker] = profile;

            const card = document.createElement('article');
            card.className = 'speaker-card';

            const header = document.createElement('header');
            const title = document.createElement('h3');
            const dot = document.createElement('span');
            dot.className = 'speaker-dot';
            dot.style.background = colorForName(speaker);
            title.appendChild(dot);

            const nameText = document.createElement('span');
            nameText.textContent = speaker;
            title.appendChild(nameText);

            header.appendChild(title);

            const meta = document.createElement('span');
            meta.className = 'speaker-meta';
            meta.textContent = 'Speaker';
            header.appendChild(meta);
            card.appendChild(header);

            const voiceRow = document.createElement('div');
            voiceRow.className = 'voice-row';

            const voiceLabel = document.createElement('label');
            voiceLabel.textContent = 'Voice';
            const select = document.createElement('select');
            populateVoiceSelect(select, profile.voice);
            select.addEventListener('change', () => {
                profiles[speaker].voice = select.value;
                saveState();
            });
            voiceLabel.appendChild(select);
            voiceRow.appendChild(voiceLabel);
            card.appendChild(voiceRow);

            const controls = document.createElement('div');
            controls.className = 'control-row';
            controls.appendChild(makeRangeRow('Rate', 'rate', speaker, profile.rate ?? 1, 0.55, 1.5, 0.01, 'x'));
            controls.appendChild(makeRangeRow('Pitch', 'pitch', speaker, profile.pitch ?? 1, 0.5, 2, 0.01, 'x'));
            controls.appendChild(makeRangeRow('Volume', 'volume', speaker, profile.volume ?? 1, 0.2, 1, 0.01, ''));
            card.appendChild(controls);

            const previewRow = document.createElement('div');
            previewRow.className = 'preview-row';

            const previewBtn = document.createElement('button');
            previewBtn.type = 'button';
            previewBtn.className = 'mini-btn';
            previewBtn.textContent = 'Preview voice';
            previewBtn.addEventListener('click', () => {
                speakText(`${speaker} checking in. This room is now talking.`, speaker);
            });

            const resetBtn = document.createElement('button');
            resetBtn.type = 'button';
            resetBtn.className = 'mini-btn';
            resetBtn.textContent = 'Reset';
            resetBtn.addEventListener('click', () => {
                const fresh = defaultProfile(speaker, index);
                profiles[speaker] = fresh;
                saveState();
                renderAll();
            });

            previewRow.appendChild(previewBtn);
            previewRow.appendChild(resetBtn);
            card.appendChild(previewRow);

            return card;
        }

        function buildLineCard(line) {
            const speaker = line.speaker;
            const profile = profiles[speaker] || defaultProfile(speaker, 0);
            const card = document.createElement('article');
            card.className = 'line-card';
            card.dataset.index = String(line.index);

            if (line.index === activeLineIndex) {
                card.classList.add('active');
            }

            const dot = document.createElement('div');
            dot.className = 'speaker-dot';
            dot.style.background = colorForName(speaker);

            const body = document.createElement('div');
            body.className = 'line-body';

            const top = document.createElement('div');
            top.className = 'line-top';

            const nick = document.createElement('span');
            nick.className = 'nick';
            nick.textContent = speaker;
            top.appendChild(nick);

            const voiceChip = document.createElement('span');
            voiceChip.className = 'line-chip';
            voiceChip.textContent = profile.voice ? profile.voice : 'default voice';
            top.appendChild(voiceChip);

            body.appendChild(top);

            const message = document.createElement('div');
            message.className = 'line-message';
            message.textContent = line.message;
            body.appendChild(message);

            const actions = document.createElement('div');
            actions.className = 'line-actions';

            const playBtn = document.createElement('button');
            playBtn.type = 'button';
            playBtn.className = 'mini-btn';
            playBtn.textContent = 'Speak line';
            playBtn.addEventListener('click', () => speakLine(line));

            const detail = document.createElement('span');
            detail.className = 'tiny';
            detail.textContent = `Line ${line.index + 1}`;

            actions.appendChild(playBtn);
            actions.appendChild(detail);

            card.appendChild(dot);
            card.appendChild(body);
            card.appendChild(actions);

            return card;
        }

        function renderAll() {
            const lines = parseTranscript(transcriptEl.value);
            const speakers = getUniqueSpeakers(lines);
            ensureProfiles(speakers);
            linePillEl.textContent = `${lines.length} line${lines.length === 1 ? '' : 's'}`;
            speakerPillEl.textContent = `${speakers.length} speaker${speakers.length === 1 ? '' : 's'}`;

            speakerListEl.innerHTML = '';
            if (!speakers.length) {
                const empty = document.createElement('p');
                empty.className = 'tiny';
                empty.textContent = 'Add at least one line in the transcript to create a cast.';
                speakerListEl.appendChild(empty);
            } else {
                speakers.forEach((speaker, index) => {
                    speakerListEl.appendChild(buildSpeakerCard(speaker, index));
                });
            }

            timelineEl.innerHTML = '';
            if (!lines.length) {
                const empty = document.createElement('p');
                empty.className = 'tiny';
                empty.textContent = 'No transcript yet. Load the sample or type your own log.';
                timelineEl.appendChild(empty);
            } else {
                lines.forEach(line => timelineEl.appendChild(buildLineCard(line)));
            }

            saveState();
        }

        function setPlaybackState(title, detail) {
            playbackStateEl.textContent = title;
            playbackDetailEl.textContent = detail;
        }

        function setSpeaking(isSpeaking) {
            speaking = isSpeaking;
            equalizerEl.classList.toggle('speaking', isSpeaking);
            playQueueBtn.disabled = isSpeaking || !speechSupported;
            stopQueueBtn.disabled = !isSpeaking;
        }

        function refreshActiveLine(index) {
            activeLineIndex = index;
            document.querySelectorAll('.line-card').forEach(card => {
                card.classList.toggle('active', Number(card.dataset.index) === index);
            });
        }

        function getVoiceForSpeaker(speaker) {
            const profile = profiles[speaker] || {};
            if (profile.voice) {
                const voice = voices.find(item => item.name === profile.voice);
                if (voice) {
                    return voice;
                }
            }
            return voices[0] || null;
        }

        function speakText(text, speaker) {
            if (!speechSupported) {
                setPlaybackState('Speech unavailable', 'Your browser does not expose the speech synthesis engine.');
                return;
            }

            const utterance = new SpeechSynthesisUtterance(text);
            const voice = getVoiceForSpeaker(speaker);
            const profile = profiles[speaker] || defaultProfile(speaker, 0);

            if (voice) utterance.voice = voice;
            utterance.rate = Number(profile.rate || 1);
            utterance.pitch = Number(profile.pitch || 1);
            utterance.volume = Number(profile.volume || 1);

            speechSynthesis.cancel();
            speechSynthesis.speak(utterance);
            setPlaybackState('Previewing voice', speaker + ' is speaking a test line.');

            utterance.onstart = () => {
                setSpeaking(true);
            };
            utterance.onend = () => {
                setSpeaking(false);
                setPlaybackState('Idle', 'Voice preview finished.');
            };
            utterance.onerror = () => {
                setSpeaking(false);
                setPlaybackState('Idle', 'Voice preview hit a snag.');
            };
        }

        function speakLine(line) {
            if (!speechSupported) {
                setPlaybackState('Speech unavailable', 'Your browser does not expose the speech synthesis engine.');
                return Promise.resolve();
            }

            const profile = profiles[line.speaker] || defaultProfile(line.speaker, 0);
            const utterance = new SpeechSynthesisUtterance(line.message);
            const voice = getVoiceForSpeaker(line.speaker);
            if (voice) utterance.voice = voice;
            utterance.rate = Number(profile.rate || 1);
            utterance.pitch = Number(profile.pitch || 1);
            utterance.volume = Number(profile.volume || 1);

            return new Promise(resolve => {
                utterance.onstart = () => {
                    refreshActiveLine(line.index);
                    setSpeaking(true);
                    setPlaybackState('Speaking', `${line.speaker} is on the line.`);
                };
                utterance.onend = () => {
                    resolve();
                };
                utterance.onerror = () => {
                    resolve();
                };
                speechSynthesis.speak(utterance);
            });
        }

        async function playQueue() {
            if (!speechSupported) {
                setPlaybackState('Speech unavailable', 'This browser cannot speak lines aloud.');
                return;
            }

            const token = ++currentCancelToken;
            const lines = parseTranscript(transcriptEl.value);
            if (!lines.length) {
                setPlaybackState('No transcript', 'Load or type at least one line first.');
                return;
            }

            setSpeaking(true);
            setPlaybackState('Starting', 'Queueing lines in order.');

            for (const line of lines) {
                if (token !== currentCancelToken) break;
                await speakLine(line);
                if (token !== currentCancelToken) break;
            }

            setSpeaking(false);
            refreshActiveLine(-1);
            setPlaybackState('Idle', 'Queue finished.');
        }

        function stopQueue() {
            currentCancelToken++;
            refreshActiveLine(-1);
            if (speechSupported) {
                speechSynthesis.cancel();
            }
            setSpeaking(false);
            setPlaybackState('Stopped', 'Playback halted.');
        }

        function shuffleCast() {
            if (!voices.length) {
                setPlaybackState('No voices yet', 'Wait for browser voices to load.');
                return;
            }

            const speakers = getUniqueSpeakers(parseTranscript(transcriptEl.value));
            speakers.forEach((speaker, index) => {
                const selected = voices[(Math.floor(Math.random() * voices.length) + index) % voices.length];
                profiles[speaker] = {
                    ...profiles[speaker],
                    voice: selected.name,
                    rate: (0.82 + Math.random() * 0.45).toFixed(2),
                    pitch: (0.75 + Math.random() * 0.7).toFixed(2),
                    volume: 1,
                    name: speaker
                };
            });
            saveState();
            renderAll();
            setPlaybackState('Cast shuffled', 'Each speaker has a fresh voice and tempo.');
        }

        function updateVoices() {
            if (!speechSupported) {
                updateSupportState();
                renderAll();
                return;
            }

            voices = speechSynthesis.getVoices() || [];
            const parsed = parseTranscript(transcriptEl.value);
            ensureProfiles(getUniqueSpeakers(parsed));
            renderAll();
            updateSupportState();
        }

        transcriptEl.value = initialTranscript;
        loadState();
        updateSupportState();
        updateVoices();

        if (speechSupported) {
            speechSynthesis.onvoiceschanged = () => {
                updateVoices();
            };
        }

        transcriptEl.addEventListener('input', () => {
            renderAll();
        });

        loadSampleBtn.addEventListener('click', () => {
            transcriptEl.value = initialTranscript;
            refreshActiveLine(-1);
            renderAll();
            setPlaybackState('Sample loaded', 'Jon, Chloe, Nathan, and KITT are queued.');
        });

        clearTranscriptBtn.addEventListener('click', () => {
            transcriptEl.value = '';
            stopQueue();
            renderAll();
            setPlaybackState('Transcript cleared', 'The room is empty now.');
        });

        playQueueBtn.addEventListener('click', playQueue);
        stopQueueBtn.addEventListener('click', stopQueue);
        shuffleCastBtn.addEventListener('click', shuffleCast);

        setSpeaking(false);
        renderAll();
    })();
    </script>
</body>
</html>
