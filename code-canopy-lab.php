<?php
$sourceTitle = 'Language Independent Visualizer (LIVER)';
$sourceUrl = 'https://jona.ca/2007/07/language-independent-visualizer-liver.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Canopy Lab</title>
    <style>
        :root {
            --bg: #09110b;
            --bg-2: #132117;
            --panel: rgba(11, 24, 15, 0.82);
            --panel-strong: rgba(17, 36, 22, 0.92);
            --line: rgba(176, 232, 177, 0.16);
            --text: #eef8df;
            --muted: #b5c9b1;
            --gold: #ffd971;
            --moss: #8ecf8e;
            --fern: #65b584;
            --rose: #ff9f8a;
            --sky: #8dc7ff;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.4);
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--text);
            background:
                radial-gradient(circle at top, rgba(164, 221, 123, 0.12), transparent 28%),
                radial-gradient(circle at 20% 20%, rgba(255, 217, 113, 0.12), transparent 20%),
                linear-gradient(180deg, #112217 0%, #0a130d 38%, #071008 100%);
            font-family: "Avenir Next", "Gill Sans", "Trebuchet MS", sans-serif;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                linear-gradient(transparent 0 96%, rgba(255,255,255,0.03) 96% 100%),
                radial-gradient(circle at center, rgba(255,255,255,0.03) 0 1px, transparent 1px 100%);
            background-size: 100% 22px, 20px 20px;
            opacity: 0.25;
            pointer-events: none;
            mix-blend-mode: soft-light;
        }

        a {
            color: var(--gold);
            text-decoration-thickness: 1.5px;
            text-underline-offset: 0.16em;
        }

        .shell {
            width: min(1220px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 42px;
            position: relative;
            z-index: 1;
        }

        .hero {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.09);
            border-radius: 32px;
            background:
                linear-gradient(140deg, rgba(23, 49, 30, 0.96), rgba(9, 17, 11, 0.92)),
                radial-gradient(circle at right top, rgba(141, 199, 255, 0.14), transparent 28%);
            box-shadow: var(--shadow);
            padding: clamp(24px, 5vw, 52px);
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -12% -38% 45%;
            height: 240px;
            background: radial-gradient(circle, rgba(255, 217, 113, 0.24), transparent 60%);
            filter: blur(18px);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.07);
            color: var(--muted);
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        h1, h2, h3 {
            font-family: "Baskerville", "Palatino Linotype", "Book Antiqua", serif;
            letter-spacing: 0.02em;
            margin: 0;
        }

        h1 {
            font-size: clamp(2.8rem, 7vw, 5.6rem);
            line-height: 0.92;
            margin-top: 18px;
            max-width: 8ch;
        }

        .hero-copy {
            max-width: 64ch;
            font-size: clamp(1rem, 1.6vw, 1.14rem);
            line-height: 1.7;
            color: var(--muted);
            margin: 20px 0 28px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.35fr 0.9fr;
            gap: 24px;
            align-items: end;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .stat-card {
            padding: 16px 16px 18px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(10px);
        }

        .stat-label {
            color: var(--muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: clamp(1.5rem, 3vw, 2.4rem);
            color: var(--gold);
            font-weight: 700;
            line-height: 1;
        }

        .meta-note {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.7;
            padding: 18px 20px;
            border-radius: 24px;
            background: rgba(9, 18, 11, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        .workspace {
            display: grid;
            grid-template-columns: 390px minmax(0, 1fr);
            gap: 22px;
            margin-top: 24px;
        }

        .panel {
            border-radius: 28px;
            padding: 22px;
            background: var(--panel);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
        }

        .controls {
            display: grid;
            gap: 18px;
            align-content: start;
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }

        .panel-title {
            font-size: 1.35rem;
        }

        .panel-kicker {
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.55;
        }

        .sample-buttons,
        .segmented,
        .trail-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button,
        .pill {
            appearance: none;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
            font: inherit;
        }

        button:hover,
        .pill:hover {
            transform: translateY(-1px);
        }

        .pill,
        .sample-buttons button,
        .trail-buttons button {
            background: rgba(255,255,255,0.06);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 11px 15px;
        }

        .sample-buttons button.active,
        .trail-buttons button.active {
            background: rgba(255, 217, 113, 0.18);
            border-color: rgba(255, 217, 113, 0.32);
            color: #fff9dc;
            box-shadow: 0 10px 22px rgba(255, 217, 113, 0.14);
        }

        .segmented {
            background: rgba(255,255,255,0.04);
            padding: 6px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.07);
        }

        .segmented button {
            flex: 1 1 130px;
            padding: 12px 14px;
            background: transparent;
            color: var(--muted);
        }

        .segmented button.active {
            background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.06));
            color: var(--text);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);
        }

        label {
            display: block;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }

        textarea {
            width: 100%;
            min-height: 340px;
            resize: vertical;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.09);
            padding: 18px;
            background: rgba(4, 10, 6, 0.84);
            color: #e5f3d9;
            font: 0.96rem/1.55 "Courier New", "SFMono-Regular", monospace;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.03);
        }

        textarea:focus-visible,
        button:focus-visible,
        input:focus-visible {
            outline: 2px solid var(--gold);
            outline-offset: 2px;
        }

        .range-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 14px;
            align-items: center;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .glow-readout {
            font-size: 0.95rem;
            color: var(--gold);
            min-width: 74px;
            text-align: right;
        }

        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .action-row button {
            padding: 14px 18px;
            font-weight: 700;
        }

        .primary {
            background: linear-gradient(135deg, #ffd971, #ffae67);
            color: #17220d;
            box-shadow: 0 18px 30px rgba(255, 174, 103, 0.28);
        }

        .secondary {
            background: rgba(255,255,255,0.06);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .visual-panel {
            display: grid;
            gap: 16px;
        }

        .stats-strip {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .mini {
            border-radius: 22px;
            padding: 14px 14px 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .mini .stat-value {
            font-size: 1.45rem;
        }

        .canopy-stage {
            position: relative;
            overflow: hidden;
            min-height: 520px;
            border-radius: 28px;
            background:
                radial-gradient(circle at top, rgba(141, 199, 255, 0.12), transparent 26%),
                linear-gradient(180deg, rgba(20, 43, 27, 0.95), rgba(5, 11, 7, 0.98));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .canopy-stage::before,
        .canopy-stage::after {
            content: "";
            position: absolute;
            inset: auto auto 0 0;
            width: 100%;
            height: 42%;
            pointer-events: none;
            opacity: 0.72;
        }

        .canopy-stage::before {
            background:
                radial-gradient(circle at 10% 100%, rgba(72, 120, 73, 0.7), transparent 26%),
                radial-gradient(circle at 38% 100%, rgba(92, 142, 92, 0.48), transparent 20%),
                radial-gradient(circle at 80% 100%, rgba(56, 96, 58, 0.75), transparent 24%);
        }

        .canopy-stage::after {
            background:
                linear-gradient(180deg, transparent, rgba(2, 5, 2, 0.82)),
                radial-gradient(circle at 50% 0, rgba(255, 217, 113, 0.08), transparent 24%);
        }

        #canopySvg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
        }

        .legend-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--muted);
            font-size: 0.86rem;
        }

        .dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            box-shadow: 0 0 18px currentColor;
        }

        .inspector {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 240px;
            gap: 14px;
        }

        .inspector-card,
        .prompt-card {
            min-height: 100%;
            border-radius: 24px;
            background: var(--panel-strong);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 18px;
        }

        .inspector-name {
            font-size: 1.65rem;
            margin-bottom: 6px;
        }

        .inspector-meta,
        .inspector-copy,
        .trail-note {
            color: var(--muted);
            line-height: 1.65;
        }

        .tiny-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .tiny-block {
            border-radius: 18px;
            padding: 12px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
        }

        .tiny-title {
            font-size: 0.82rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        .tiny-list {
            font-family: "Courier New", "SFMono-Regular", monospace;
            font-size: 0.9rem;
            line-height: 1.6;
            word-break: break-word;
            white-space: pre-line;
        }

        .footer-note {
            margin-top: 20px;
            color: var(--muted);
            text-align: center;
            line-height: 1.7;
            font-size: 0.94rem;
        }

        .footer-note strong {
            color: var(--text);
        }

        @media (max-width: 1040px) {
            .workspace,
            .hero-grid,
            .inspector {
                grid-template-columns: 1fr;
            }

            .stats-strip {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 720px) {
            .shell {
                width: min(100% - 18px, 1220px);
                padding-top: 12px;
            }

            .hero,
            .panel {
                border-radius: 24px;
                padding: 18px;
            }

            .hero-stats,
            .stats-strip,
            .tiny-grid {
                grid-template-columns: 1fr;
            }

            .canopy-stage {
                min-height: 440px;
            }

            textarea {
                min-height: 280px;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <span class="eyebrow">Forest edition · parse the vines</span>
            <div class="hero-grid">
                <div>
                    <h1>Code Canopy Lab</h1>
                    <p class="hero-copy">
                        Jon once built a tiny source-tree visualizer because walking into an unfamiliar codebase can feel like being dropped into the woods at night. This page turns that idea into a lantern-lit playground: paste a miniature project, switch between files and functions, and watch relationships bloom into a canopy you can actually read.
                    </p>
                </div>
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-label">Mood</div>
                        <div class="stat-value">Lush</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Best For</div>
                        <div class="stat-value">Tiny repos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Lens</div>
                        <div class="stat-value">Calls</div>
                    </div>
                </div>
            </div>
            <p class="meta-note">
                Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>"><?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>. The original post described a small “language independent” visualizer for making code structure legible. This version leans playful instead of academic, because diagrams are allowed to be useful and a tiny bit enchanting at the same time.
            </p>
        </section>

        <section class="workspace">
            <div class="panel controls">
                <div>
                    <div class="panel-head">
                        <h2 class="panel-title">Plant a sample</h2>
                    </div>
                    <p class="panel-kicker">Start with a toy project, or paste your own little pile of code. Separate files using lines like <code>// File: rover.js</code> or <code># File: parser.rb</code>.</p>
                </div>

                <div class="sample-buttons" id="sampleButtons">
                    <button type="button" data-sample="quest" class="active">Knight Quest</button>
                    <button type="button" data-sample="rover">Rover Radio</button>
                    <button type="button" data-sample="family">Family Arcade</button>
                </div>

                <div>
                    <label for="codeInput">Project clippings</label>
                    <textarea id="codeInput" spellcheck="false"></textarea>
                </div>

                <div>
                    <label>View mode</label>
                    <div class="segmented" id="modeToggle">
                        <button type="button" data-mode="function" class="active">Function canopy</button>
                        <button type="button" data-mode="file">File trunks</button>
                    </div>
                </div>

                <div>
                    <label for="glowRange">Lantern glow</label>
                    <div class="range-row">
                        <input type="range" id="glowRange" min="25" max="100" value="68">
                        <div class="glow-readout" id="glowReadout">68%</div>
                    </div>
                </div>

                <div class="action-row">
                    <button type="button" class="primary" id="growButton">Grow the canopy</button>
                    <button type="button" class="secondary" id="shuffleButton">Shuffle layout</button>
                </div>

                <div>
                    <div class="panel-head">
                        <h3 class="panel-title">Trail cards</h3>
                    </div>
                    <div class="trail-buttons" id="trailButtons">
                        <button type="button" data-trail="entry" class="active">Find the entry path</button>
                        <button type="button" data-trail="busy">Spot the busiest node</button>
                        <button type="button" data-trail="loner">Reveal the loner</button>
                    </div>
                    <p class="trail-note" id="trailNote">The current trail highlights the likeliest entry point and its first downstream calls, handy when you are wondering where to even start reading.</p>
                </div>
            </div>

            <div class="panel visual-panel">
                <div class="stats-strip">
                    <div class="mini">
                        <div class="stat-label">Nodes</div>
                        <div class="stat-value" id="nodeCount">0</div>
                    </div>
                    <div class="mini">
                        <div class="stat-label">Vines</div>
                        <div class="stat-value" id="edgeCount">0</div>
                    </div>
                    <div class="mini">
                        <div class="stat-label">Files</div>
                        <div class="stat-value" id="fileCount">0</div>
                    </div>
                    <div class="mini">
                        <div class="stat-label">Hotspot</div>
                        <div class="stat-value" id="hotspotName">-</div>
                    </div>
                </div>

                <div class="canopy-stage">
                    <svg id="canopySvg" viewBox="0 0 960 620" preserveAspectRatio="xMidYMid meet" aria-label="Code canopy visualization"></svg>
                </div>

                <div class="legend" id="legend"></div>

                <div class="inspector">
                    <div class="inspector-card">
                        <h3 class="inspector-name" id="inspectorName">Tap a lantern</h3>
                        <div class="inspector-meta" id="inspectorMeta">Your selected node will introduce itself here.</div>
                        <p class="inspector-copy" id="inspectorCopy">
                            This is not a full static analyzer, just a charming field guide. It uses name matching inspired by Jon's original post, which makes it surprisingly helpful for little projects and fast mental orientation.
                        </p>
                        <div class="tiny-grid">
                            <div class="tiny-block">
                                <div class="tiny-title">Calls out to</div>
                                <div class="tiny-list" id="outboundList">-</div>
                            </div>
                            <div class="tiny-block">
                                <div class="tiny-title">Called by</div>
                                <div class="tiny-list" id="inboundList">-</div>
                            </div>
                        </div>
                    </div>
                    <div class="prompt-card">
                        <div class="tiny-title">Expedition tips</div>
                        <p class="trail-note">
                            Entry nodes often look like <code>main</code>, <code>init</code>, or <code>start</code>.
                        </p>
                        <p class="trail-note">
                            Isolated lanterns can mean dead code, helper functions not yet used, or a parser limitation. The jungle keeps its little mysteries.
                        </p>
                        <p class="trail-note">
                            File view is perfect when you only want the “which chunk talks to which chunk?” version.
                        </p>
                    </div>
                </div>

                <p class="footer-note">
                    Built as a one-file web-lab toy from Jon's old LIVER post. Tiny enough to fiddle with on a phone, nerdy enough to make a code archaeologist smile.
                </p>
            </div>
        </section>
    </div>

    <script>
        const samples = {
            quest: `// File: boot.js
function main() {
    loadMap();
    summonKnight();
    beginQuest();
}

function loadMap() {
    readSave();
    buildPath();
}

function beginQuest() {
    openGate();
    spawnEnemy();
    showBanner();
}

// File: party.js
function summonKnight() {
    chooseCompanion();
    polishShield();
}

function chooseCompanion() {
    scanRoster();
}

function spawnEnemy() {
    roar();
    buildPath();
}

// File: support.js
function readSave() {}
function buildPath() {}
function openGate() {}
function showBanner() {}
function polishShield() {}
function scanRoster() {}
function roar() {}`,
            rover: `// File: radio.js
function bootRadio() {
    handshake();
    pingSatellite();
    startLoop();
}

function startLoop() {
    readSignal();
    decodeSignal();
    renderScope();
}

function readSignal() {
    sampleNoise();
}

// File: nav.js
function pingSatellite() {
    fetchPosition();
    decodeSignal();
}

function fetchPosition() {
    sampleNoise();
}

// File: decode.js
function handshake() {}
function decodeSignal() {
    smoothWave();
    renderScope();
}
function smoothWave() {}
function renderScope() {}
function sampleNoise() {}`,
            family: `// File: arcade.php
function launchArcade() {
    loadPlayers();
    startRound();
}

function startRound() {
    pickGame();
    tallyScore();
    celebrateWinner();
}

function tallyScore() {
    readTokens();
}

// File: games.php
function pickGame() {
    spinWheel();
    loadPlayers();
}

function celebrateWinner() {
    dropConfetti();
    queueSong();
}

// File: helpers.php
function loadPlayers() {}
function spinWheel() {}
function readTokens() {}
function dropConfetti() {}
function queueSong() {}`
        };

        const palette = ["#ffd971", "#8dc7ff", "#8ecf8e", "#ff9f8a", "#cfb0ff", "#7ee3d2", "#ffcb89"];
        const trailNotes = {
            entry: "The current trail highlights the likeliest entry point and its first downstream calls, handy when you are wondering where to even start reading.",
            busy: "This trail spotlights the node with the most total traffic: part crossroads, part probable headache, often the first thing worth simplifying.",
            loner: "This trail reveals the loneliest node in the grove. Sometimes it is dead code. Sometimes it is a helper nobody has invited to the party yet."
        };

        const codeInput = document.getElementById("codeInput");
        const sampleButtons = document.getElementById("sampleButtons");
        const modeToggle = document.getElementById("modeToggle");
        const growButton = document.getElementById("growButton");
        const shuffleButton = document.getElementById("shuffleButton");
        const trailButtons = document.getElementById("trailButtons");
        const trailNote = document.getElementById("trailNote");
        const glowRange = document.getElementById("glowRange");
        const glowReadout = document.getElementById("glowReadout");
        const canopySvg = document.getElementById("canopySvg");
        const legend = document.getElementById("legend");
        const nodeCount = document.getElementById("nodeCount");
        const edgeCount = document.getElementById("edgeCount");
        const fileCount = document.getElementById("fileCount");
        const hotspotName = document.getElementById("hotspotName");

        const inspectorName = document.getElementById("inspectorName");
        const inspectorMeta = document.getElementById("inspectorMeta");
        const inspectorCopy = document.getElementById("inspectorCopy");
        const outboundList = document.getElementById("outboundList");
        const inboundList = document.getElementById("inboundList");

        const state = {
            sample: "quest",
            mode: "function",
            trail: "entry",
            glow: Number(glowRange.value),
            seed: 0,
            graph: null,
            selectedId: null
        };

        function setSample(sampleKey) {
            state.sample = sampleKey;
            codeInput.value = samples[sampleKey];
            [...sampleButtons.querySelectorAll("button")].forEach((button) => {
                button.classList.toggle("active", button.dataset.sample === sampleKey);
            });
            grow();
        }

        function parseProject(source) {
            const chunks = source.split(/\n(?=(?:\/\/|#)\s*File:)/g).filter(Boolean);
            const files = [];

            for (const chunk of chunks) {
                const lines = chunk.trim().split("\n");
                const match = lines[0].match(/(?:\/\/|#)\s*File:\s*(.+)$/i);
                const fileName = match ? match[1].trim() : `snippet-${files.length + 1}.txt`;
                const content = match ? lines.slice(1).join("\n") : chunk;
                files.push({ name: fileName, content });
            }

            if (files.length === 0) {
                files.push({ name: "snippet-1.txt", content: source });
            }

            const functions = [];
            const functionByName = new Map();
            const mentionsByFile = new Map();

            files.forEach((file, fileIndex) => {
                const lines = file.content.split("\n");
                const foundNames = [];
                lines.forEach((line, lineIndex) => {
                    const patterns = [
                        /(?:public|private|protected)?\s*function\s+([A-Za-z_][A-Za-z0-9_]*)/i,
                        /function\s+([A-Za-z_][A-Za-z0-9_]*)/i,
                        /def\s+([A-Za-z_][A-Za-z0-9_]*)/i,
                        /([A-Za-z_][A-Za-z0-9_]*)\s*:\s*function/i,
                        /([A-Za-z_][A-Za-z0-9_]*)\s*=\s*function/i
                    ];
                    let name = null;
                    for (const pattern of patterns) {
                        const hit = line.match(pattern);
                        if (hit) {
                            name = hit[1];
                            break;
                        }
                    }
                    if (name) {
                        const id = `${file.name}::${name}`;
                        const node = { id, name, file: file.name, fileIndex, line: lineIndex + 1 };
                        functions.push(node);
                        foundNames.push(node);
                        if (!functionByName.has(name)) {
                            functionByName.set(name, []);
                        }
                        functionByName.get(name).push(node);
                    }
                });
                mentionsByFile.set(file.name, lines.join("\n"));
            });

            const functionEdges = [];
            functions.forEach((node) => {
                const fileContent = mentionsByFile.get(node.file);
                const blockMatch = extractFunctionBody(fileContent, node.name);
                const tokens = new Set((blockMatch.match(/[A-Za-z_][A-Za-z0-9_]*/g) || []));
                tokens.forEach((token) => {
                    const matches = functionByName.get(token) || [];
                    if (matches.length === 1 && matches[0].id !== node.id) {
                        functionEdges.push({ source: node.id, target: matches[0].id });
                    }
                });
            });

            const uniqueFunctionEdges = dedupeEdges(functionEdges);

            const fileNodes = files.map((file, index) => ({
                id: file.name,
                name: file.name,
                file: file.name,
                fileIndex: index,
                line: 1
            }));

            const fileEdges = [];
            files.forEach((file) => {
                const content = mentionsByFile.get(file.name);
                files.forEach((other) => {
                    if (file.name === other.name) {
                        return;
                    }
                    const directMention = new RegExp(`\\b${escapeRegex(stripExtension(other.name))}\\b`).test(content);
                    const functionMention = functions.some((fn) => fn.file === other.name && new RegExp(`\\b${escapeRegex(fn.name)}\\b`).test(content));
                    if (directMention || functionMention) {
                        fileEdges.push({ source: file.name, target: other.name });
                    }
                });
            });

            return {
                files,
                functions,
                views: {
                    function: {
                        nodes: functions,
                        edges: uniqueFunctionEdges
                    },
                    file: {
                        nodes: fileNodes,
                        edges: dedupeEdges(fileEdges)
                    }
                }
            };
        }

        function extractFunctionBody(fileContent, functionName) {
            const escaped = escapeRegex(functionName);
            const patterns = [
                new RegExp(`function\\s+${escaped}\\s*\\([^)]*\\)\\s*\\{([\\s\\S]*?)\\n\\}`, "i"),
                new RegExp(`${escaped}\\s*:\\s*function\\s*\\([^)]*\\)\\s*\\{([\\s\\S]*?)\\n\\}`, "i"),
                new RegExp(`${escaped}\\s*=\\s*function\\s*\\([^)]*\\)\\s*\\{([\\s\\S]*?)\\n\\}`, "i"),
                new RegExp(`def\\s+${escaped}[\\s\\S]*?\\n([\\s\\S]*?)(?:\\nend|$)`, "i")
            ];

            for (const pattern of patterns) {
                const match = fileContent.match(pattern);
                if (match) {
                    return match[1];
                }
            }

            return fileContent;
        }

        function dedupeEdges(edges) {
            const seen = new Set();
            return edges.filter((edge) => {
                const key = `${edge.source}->${edge.target}`;
                if (seen.has(key)) {
                    return false;
                }
                seen.add(key);
                return true;
            });
        }

        function stripExtension(fileName) {
            return fileName.replace(/\.[^.]+$/, "");
        }

        function escapeRegex(value) {
            return value.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        }

        function buildLayout(graph) {
            const { nodes, edges } = graph;
            const nodeMap = new Map(nodes.map((node) => [node.id, { ...node, inbound: [], outbound: [] }]));
            edges.forEach((edge) => {
                const source = nodeMap.get(edge.source);
                const target = nodeMap.get(edge.target);
                if (source && target) {
                    source.outbound.push(target.id);
                    target.inbound.push(source.id);
                }
            });

            const orderedNodes = [...nodeMap.values()];
            const preferredNames = ["main", "boot", "bootstrap", "launchArcade", "bootRadio", "start", "init"];
            let root = orderedNodes.find((node) => preferredNames.includes(node.name));
            if (!root) {
                root = orderedNodes.slice().sort((a, b) => (b.outbound.length - b.inbound.length) - (a.outbound.length - a.inbound.length))[0] || orderedNodes[0];
            }

            const levels = new Map();
            if (root) {
                const queue = [root.id];
                levels.set(root.id, 0);
                while (queue.length) {
                    const current = queue.shift();
                    const currentNode = nodeMap.get(current);
                    currentNode.outbound.forEach((targetId) => {
                        if (!levels.has(targetId)) {
                            levels.set(targetId, levels.get(current) + 1);
                            queue.push(targetId);
                        }
                    });
                }
            }

            orderedNodes.forEach((node) => {
                if (!levels.has(node.id)) {
                    levels.set(node.id, Math.max(1, ...levels.values(), 0));
                }
            });

            const maxLevel = Math.max(...levels.values(), 0);
            const columns = Array.from({ length: maxLevel + 1 }, () => []);
            orderedNodes.forEach((node) => columns[levels.get(node.id)].push(node));
            columns.forEach((column) => column.sort((a, b) => a.fileIndex - b.fileIndex || a.name.localeCompare(b.name)));

            const width = 960;
            const height = 620;
            const marginX = 110;
            const topY = 105;
            const bottomY = height - 150;
            const wobble = (state.seed % 7) * 7;

            columns.forEach((column, level) => {
                const x = columns.length === 1
                    ? width / 2
                    : marginX + (level * (width - marginX * 2)) / Math.max(columns.length - 1, 1);
                const spacing = column.length === 1 ? 0 : (bottomY - topY) / Math.max(column.length - 1, 1);
                column.forEach((node, index) => {
                    const wave = Math.sin((index + 1 + wobble) * 0.9 + level) * 28;
                    node.x = x + wave;
                    node.y = column.length === 1 ? (topY + bottomY) / 2 : topY + index * spacing;
                    node.level = level;
                });
            });

            return {
                nodes: orderedNodes,
                edges,
                nodeMap,
                rootId: root ? root.id : null
            };
        }

        function render() {
            const parsed = parseProject(codeInput.value.trim());
            const active = parsed.views[state.mode];
            const layout = buildLayout(active);
            state.graph = { ...layout, files: parsed.files, allFunctions: parsed.functions };
            if (!state.selectedId || !layout.nodeMap.has(state.selectedId)) {
                state.selectedId = layout.rootId || (layout.nodes[0] && layout.nodes[0].id) || null;
            }

            nodeCount.textContent = layout.nodes.length;
            edgeCount.textContent = layout.edges.length;
            fileCount.textContent = parsed.files.length;

            const hotspot = layout.nodes.slice().sort((a, b) => ((b.inbound.length + b.outbound.length) - (a.inbound.length + a.outbound.length)))[0];
            hotspotName.textContent = hotspot ? truncate(hotspot.name, 12) : "-";

            renderLegend(parsed.files);
            renderSvg(layout);
            updateInspector();
        }

        function renderLegend(files) {
            legend.innerHTML = "";
            files.forEach((file, index) => {
                const item = document.createElement("div");
                item.className = "legend-item";
                const dot = document.createElement("span");
                dot.className = "dot";
                dot.style.color = palette[index % palette.length];
                dot.style.background = palette[index % palette.length];
                const label = document.createElement("span");
                label.textContent = file.name;
                item.append(dot, label);
                legend.appendChild(item);
            });
        }

        function renderSvg(layout) {
            const glow = state.glow / 100;
            const nodeColorByFile = new Map();
            layout.nodes.forEach((node) => {
                if (!nodeColorByFile.has(node.file)) {
                    const fileIndex = [...nodeColorByFile.keys(), node.file].indexOf(node.file);
                    nodeColorByFile.set(node.file, palette[fileIndex % palette.length]);
                }
            });

            const highlight = resolveTrail(layout);
            const edgeHtml = layout.edges.map((edge, index) => {
                const source = layout.nodeMap.get(edge.source);
                const target = layout.nodeMap.get(edge.target);
                if (!source || !target) {
                    return "";
                }
                const curve = (target.x - source.x) * 0.32;
                const path = `M ${source.x} ${source.y} C ${source.x + curve} ${source.y}, ${target.x - curve} ${target.y}, ${target.x} ${target.y}`;
                const active = highlight.edges.has(`${edge.source}->${edge.target}`);
                return `<path d="${path}" fill="none" stroke="${active ? "#ffd971" : "rgba(176,232,177,0.18)"}" stroke-width="${active ? 4.2 : 2.1}" stroke-linecap="round" stroke-opacity="${active ? 0.9 : 0.7}" />`;
            }).join("");

            const nodeHtml = layout.nodes.map((node) => {
                const selected = state.selectedId === node.id;
                const active = highlight.nodes.has(node.id);
                const color = nodeColorByFile.get(node.file);
                const radius = selected ? 24 : active ? 19 : 15;
                const haloRadius = radius * (1.8 + glow * 0.55);
                const labelY = node.y - radius - 16;
                return `
                    <g class="node" data-node-id="${escapeHtml(node.id)}" style="cursor:pointer">
                        <circle cx="${node.x}" cy="${node.y}" r="${haloRadius}" fill="${color}" opacity="${selected ? 0.24 : active ? 0.18 : 0.11}" />
                        <circle cx="${node.x}" cy="${node.y}" r="${radius}" fill="${color}" stroke="${selected ? "#fff7d0" : "rgba(255,255,255,0.48)"}" stroke-width="${selected ? 3.2 : 1.4}" />
                        <circle cx="${node.x - radius * 0.25}" cy="${node.y - radius * 0.22}" r="${Math.max(3, radius * 0.28)}" fill="rgba(255,255,255,0.45)" />
                        <text x="${node.x}" y="${labelY}" text-anchor="middle" fill="${selected ? "#fff8dd" : "#dbe9d1"}" font-size="${selected ? 15 : 13}" font-family="Baskerville, Palatino Linotype, serif">${escapeHtml(node.name)}</text>
                    </g>
                `;
            }).join("");

            canopySvg.innerHTML = `
                <defs>
                    <filter id="softGlow">
                        <feGaussianBlur stdDeviation="8" result="glow"></feGaussianBlur>
                        <feMerge>
                            <feMergeNode in="glow"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <g filter="url(#softGlow)">
                    ${edgeHtml}
                    ${nodeHtml}
                </g>
            `;

            canopySvg.querySelectorAll("[data-node-id]").forEach((nodeEl) => {
                nodeEl.addEventListener("click", () => {
                    state.selectedId = nodeEl.getAttribute("data-node-id");
                    renderSvg(layout);
                    updateInspector();
                });
            });
        }

        function resolveTrail(layout) {
            const result = { nodes: new Set(), edges: new Set() };
            if (!layout.nodes.length) {
                return result;
            }

            const scoreNode = (node) => node.inbound.length + node.outbound.length;
            let focus = null;

            if (state.trail === "entry") {
                focus = layout.rootId ? layout.nodeMap.get(layout.rootId) : layout.nodes[0];
                if (focus) {
                    result.nodes.add(focus.id);
                    focus.outbound.slice(0, 3).forEach((targetId) => {
                        result.nodes.add(targetId);
                        result.edges.add(`${focus.id}->${targetId}`);
                    });
                }
            } else if (state.trail === "busy") {
                focus = layout.nodes.slice().sort((a, b) => scoreNode(b) - scoreNode(a))[0];
                if (focus) {
                    result.nodes.add(focus.id);
                    focus.inbound.forEach((sourceId) => {
                        result.nodes.add(sourceId);
                        result.edges.add(`${sourceId}->${focus.id}`);
                    });
                    focus.outbound.forEach((targetId) => {
                        result.nodes.add(targetId);
                        result.edges.add(`${focus.id}->${targetId}`);
                    });
                }
            } else if (state.trail === "loner") {
                focus = layout.nodes.slice().sort((a, b) => scoreNode(a) - scoreNode(b))[0];
                if (focus) {
                    result.nodes.add(focus.id);
                }
            }

            if (!result.nodes.size && layout.nodes[0]) {
                result.nodes.add(layout.nodes[0].id);
            }

            return result;
        }

        function updateInspector() {
            const node = state.graph && state.graph.nodeMap.get(state.selectedId);
            if (!node) {
                inspectorName.textContent = "Tap a lantern";
                inspectorMeta.textContent = "Your selected node will introduce itself here.";
                inspectorCopy.textContent = "No node is selected yet.";
                outboundList.textContent = "-";
                inboundList.textContent = "-";
                return;
            }

            inspectorName.textContent = node.name;
            const traffic = node.inbound.length + node.outbound.length;
            inspectorMeta.textContent = `${node.file} · ${state.mode === "function" ? `line ${node.line}` : "file overview"} · ${traffic} total connections`;
            inspectorCopy.textContent = state.mode === "function"
                ? `${node.name} lives in ${node.file}. In this simplified call graph, it sends ${node.outbound.length} vine${node.outbound.length === 1 ? "" : "s"} outward and receives ${node.inbound.length} ${node.inbound.length === 1 ? "call" : "calls"} from elsewhere.`
                : `${node.name} is acting as a whole-file trunk right now, which is nice when you want structure without reading every function leaf.`;
            outboundList.textContent = node.outbound.length ? node.outbound.map((id) => shortNodeName(id)).join("\n") : "No outward calls";
            inboundList.textContent = node.inbound.length ? node.inbound.map((id) => shortNodeName(id)).join("\n") : "Nobody calls this yet";
        }

        function shortNodeName(id) {
            const node = state.graph.nodeMap.get(id);
            return node ? node.name : id;
        }

        function truncate(text, max) {
            return text.length > max ? `${text.slice(0, max - 1)}…` : text;
        }

        function escapeHtml(value) {
            return value
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;");
        }

        sampleButtons.addEventListener("click", (event) => {
            const button = event.target.closest("button[data-sample]");
            if (!button) {
                return;
            }
            setSample(button.dataset.sample);
        });

        modeToggle.addEventListener("click", (event) => {
            const button = event.target.closest("button[data-mode]");
            if (!button) {
                return;
            }
            state.mode = button.dataset.mode;
            [...modeToggle.querySelectorAll("button")].forEach((item) => {
                item.classList.toggle("active", item === button);
            });
            grow();
        });

        trailButtons.addEventListener("click", (event) => {
            const button = event.target.closest("button[data-trail]");
            if (!button) {
                return;
            }
            state.trail = button.dataset.trail;
            [...trailButtons.querySelectorAll("button")].forEach((item) => {
                item.classList.toggle("active", item === button);
            });
            trailNote.textContent = trailNotes[state.trail];
            if (state.graph) {
                renderSvg(state.graph);
            }
        });

        growButton.addEventListener("click", grow);
        shuffleButton.addEventListener("click", () => {
            state.seed += 1;
            grow();
        });

        glowRange.addEventListener("input", () => {
            state.glow = Number(glowRange.value);
            glowReadout.textContent = `${state.glow}%`;
            if (state.graph) {
                renderSvg(state.graph);
            }
        });

        function grow() {
            render();
        }

        setSample("quest");
    </script>
</body>
</html>
