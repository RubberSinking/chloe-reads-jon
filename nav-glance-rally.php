<?php
$scenarios = [
    [
        'district' => 'Moonlit Marina',
        'instruction' => 'Turn right',
        'distance' => '120 m',
        'road' => 'Harbor Lantern Way',
        'cue' => 'After the blue boathouse',
        'hazard' => 'Low seawall on the left',
    ],
    [
        'district' => 'Neon Heights',
        'instruction' => 'Keep left',
        'distance' => '350 m',
        'road' => 'Comet Ramp',
        'cue' => 'Follow the glowing overpass',
        'hazard' => 'Fast merge from the right',
    ],
    [
        'district' => 'Cathedral Square',
        'instruction' => 'Go straight',
        'distance' => '500 m',
        'road' => 'St. Raphael Avenue',
        'cue' => 'Pass the rose-window lights',
        'hazard' => 'Pedestrian crossing ahead',
    ],
    [
        'district' => 'Pixel Pines',
        'instruction' => 'Turn left',
        'distance' => '200 m',
        'road' => '8-Bit Forest Road',
        'cue' => 'At the blinking arcade sign',
        'hazard' => 'Sharp bend after turn',
    ],
    [
        'district' => 'Turbo Causeway',
        'instruction' => 'Exit right',
        'distance' => '800 m',
        'road' => 'Sunset Velocity Exit',
        'cue' => 'Second striped gantry',
        'hazard' => 'Crosswind on the bridge',
    ],
    [
        'district' => 'Library Quarter',
        'instruction' => 'Roundabout, second exit',
        'distance' => '150 m',
        'road' => 'Dewey Circle',
        'cue' => 'Bronze owl fountain',
        'hazard' => 'Cyclists near the median',
    ],
    [
        'district' => 'Retro Ridge',
        'instruction' => 'Turn left',
        'distance' => '90 m',
        'road' => 'Cassette Canyon Drive',
        'cue' => 'Beside the cassette mural',
        'hazard' => 'Narrow lane after turn',
    ],
    [
        'district' => 'Starlight Commons',
        'instruction' => 'Keep right',
        'distance' => '420 m',
        'road' => 'North Aurora Spur',
        'cue' => 'Stay with the silver arrows',
        'hazard' => 'Service truck lane split',
    ],
    [
        'district' => 'Knight Market',
        'instruction' => 'Go straight',
        'distance' => '260 m',
        'road' => 'Paladin Market Street',
        'cue' => 'Through the gold arch',
        'hazard' => 'Busy crosswalk at the plaza',
    ],
    [
        'district' => 'Violet Switchbacks',
        'instruction' => 'Hairpin right',
        'distance' => '70 m',
        'road' => 'Meteor Crest Pass',
        'cue' => 'At the lookout marker',
        'hazard' => 'Steep drop beyond rail',
    ],
    [
        'district' => 'Harp Bridge',
        'instruction' => 'Exit left',
        'distance' => '600 m',
        'road' => 'Choir Loft Link',
        'cue' => 'After the illuminated cables',
        'hazard' => 'Lane narrows after exit',
    ],
    [
        'district' => 'Beacon Borough',
        'instruction' => 'Turn right',
        'distance' => '240 m',
        'road' => 'Signalkeeper Street',
        'cue' => 'At the red lighthouse clock',
        'hazard' => 'Tight curb at the corner',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav Glance Rally</title>
    <style>
        :root {
            --bg: #07111f;
            --bg-2: #10233f;
            --panel: rgba(6, 16, 30, 0.72);
            --panel-strong: rgba(4, 12, 23, 0.9);
            --line: rgba(158, 222, 255, 0.24);
            --cyan: #9ff4ff;
            --aqua: #57d6ff;
            --amber: #ffd36a;
            --rose: #ff7a8e;
            --mint: #7bffc5;
            --text: #edf8ff;
            --muted: #8ea6bf;
            --shadow: 0 18px 70px rgba(0, 0, 0, 0.45);
            --radius: 28px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top, rgba(72, 137, 255, 0.18), transparent 32%),
                radial-gradient(circle at 20% 20%, rgba(255, 211, 106, 0.1), transparent 16%),
                linear-gradient(180deg, #09111d 0%, #060c15 42%, #07111f 100%);
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
                radial-gradient(circle at 15% 10%, rgba(255,255,255,0.18) 0 1px, transparent 2px),
                radial-gradient(circle at 80% 18%, rgba(255,255,255,0.12) 0 1px, transparent 2px),
                radial-gradient(circle at 60% 8%, rgba(255,255,255,0.14) 0 1px, transparent 2px),
                radial-gradient(circle at 90% 30%, rgba(255,255,255,0.1) 0 1px, transparent 2px),
                radial-gradient(circle at 30% 28%, rgba(255,255,255,0.1) 0 1px, transparent 2px);
            background-size: 380px 240px;
            opacity: 0.8;
            animation: drift 18s linear infinite;
        }

        body::after {
            background:
                linear-gradient(rgba(255,255,255,0.025), rgba(255,255,255,0.025)) 0 0 / 100% 3px,
                linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.005));
            mix-blend-mode: screen;
            opacity: 0.2;
        }

        @keyframes drift {
            from { transform: translateY(0); }
            to { transform: translateY(24px); }
        }

        .shell {
            width: min(1180px, calc(100% - 28px));
            margin: 20px auto 40px;
            display: grid;
            gap: 18px;
        }

        .hero,
        .panel,
        .dashboard,
        .track-panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .hero {
            padding: 26px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto -10% -30% auto;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(87, 214, 255, 0.22), transparent 64%);
        }

        .eyebrow {
            font-size: 0.76rem;
            letter-spacing: 0.26em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 12px;
        }

        h1 {
            margin: 0;
            font-family: "Arial Black", "Impact", sans-serif;
            font-size: clamp(2.4rem, 6vw, 4.8rem);
            line-height: 0.95;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            max-width: 9ch;
            text-wrap: balance;
        }

        .hero p {
            max-width: 58ch;
            color: #d8ebff;
            font-size: 1.03rem;
            line-height: 1.6;
            margin: 16px 0 0;
        }

        .hero-grid {
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .stat-chip {
            padding: 14px 16px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.045);
        }

        .stat-chip strong {
            display: block;
            font-size: 1.2rem;
            color: var(--mint);
        }

        .stat-chip span {
            display: block;
            margin-top: 6px;
            font-size: 0.82rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 1.18fr 0.82fr;
            gap: 18px;
        }

        .dashboard {
            padding: 18px;
            display: grid;
            gap: 18px;
        }

        .windscreen {
            min-height: 220px;
            border-radius: 24px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(145, 219, 255, 0.14), rgba(18, 42, 79, 0.1) 34%, rgba(7, 17, 31, 0.92)),
                linear-gradient(120deg, rgba(87, 214, 255, 0.08), transparent 42%);
            border: 1px solid rgba(159, 244, 255, 0.22);
        }

        .skyline {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 78px;
            height: 88px;
            opacity: 0.5;
            background:
                linear-gradient(90deg, transparent 0 4%, rgba(255, 211, 106, 0.9) 4.2% 4.5%, transparent 4.6% 9%, rgba(255,255,255,0.8) 9.1% 9.4%, transparent 9.5% 16%, rgba(255, 122, 142, 0.8) 16.2% 16.6%, transparent 16.7% 24%, rgba(255, 211, 106, 0.9) 24.2% 24.4%, transparent 24.5% 34%, rgba(159, 244, 255, 0.8) 34.4% 34.7%, transparent 34.8% 41%, rgba(255,255,255,0.7) 41.1% 41.35%, transparent 41.5% 49%, rgba(255, 211, 106, 0.85) 49.2% 49.5%, transparent 49.6% 59%, rgba(87, 214, 255, 0.75) 59.2% 59.45%, transparent 59.5% 70%, rgba(255, 122, 142, 0.75) 70.2% 70.55%, transparent 70.7% 100%);
        }

        .road {
            position: absolute;
            left: 50%;
            bottom: -30px;
            width: 160%;
            height: 200px;
            transform: translateX(-50%);
            background: linear-gradient(180deg, rgba(3, 9, 18, 0), rgba(2, 6, 12, 0.5) 25%, rgba(1, 4, 9, 1) 60%);
            clip-path: polygon(42% 0, 58% 0, 100% 100%, 0 100%);
        }

        .road::before {
            content: "";
            position: absolute;
            inset: 18px 49.4% 24px;
            background:
                repeating-linear-gradient(180deg, rgba(255, 211, 106, 0.9) 0 14px, transparent 14px 32px);
            filter: drop-shadow(0 0 10px rgba(255, 211, 106, 0.3));
        }

        .district-pill {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(7, 17, 31, 0.55);
            border: 1px solid rgba(159, 244, 255, 0.18);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.82rem;
            color: var(--cyan);
        }

        .district-pill::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--mint);
            box-shadow: 0 0 12px var(--mint);
        }

        .gps-card {
            position: relative;
            z-index: 1;
            margin-top: 22px;
            padding: 18px;
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(247, 252, 255, 0.95);
            color: #081420;
            overflow: hidden;
            transition: transform 240ms ease, opacity 240ms ease, filter 240ms ease;
        }

        .gps-card.clutter {
            background:
                linear-gradient(180deg, rgba(255,255,255,0.93), rgba(240,246,252,0.93)),
                repeating-linear-gradient(90deg, rgba(0,0,0,0.035) 0 2px, transparent 2px 11px);
            filter: saturate(0.82) contrast(0.92);
        }

        .gps-card.hidden-card {
            opacity: 0.08;
            transform: scale(0.985);
            filter: blur(7px);
        }

        .gps-top {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 16px;
            align-items: center;
        }

        .turn-icon {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            display: grid;
            place-items: center;
            background: linear-gradient(180deg, #102640, #09121e);
            color: white;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }

        .turn-icon svg {
            width: 46px;
            height: 46px;
            stroke: currentColor;
            fill: none;
            stroke-width: 7;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .distance {
            font-family: "Courier New", monospace;
            font-size: clamp(2rem, 5vw, 3.35rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: 0.02em;
        }

        .label {
            font-size: 0.72rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: #527188;
        }

        .instruction {
            margin-top: 4px;
            font-size: 1.45rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .road-name {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 2px solid rgba(6, 20, 32, 0.08);
            display: flex;
            flex-wrap: wrap;
            gap: 10px 18px;
            align-items: center;
            justify-content: space-between;
        }

        .road-name strong {
            font-size: 1.18rem;
        }

        .subcue {
            color: #4d6476;
            font-size: 0.94rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .meter {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .meter .name {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.74rem;
        }

        .meter strong {
            display: block;
            margin-top: 10px;
            font-family: "Courier New", monospace;
            font-size: 2rem;
        }

        .track-panel {
            padding: 20px;
            display: grid;
            gap: 16px;
        }

        .stack-title {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 12px;
        }

        .stack-title h2,
        .stack-title h3 {
            margin: 0;
            font-family: "Arial Black", "Impact", sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .stack-title p {
            margin: 0;
            color: var(--muted);
        }

        .mode-row,
        .answer-grid,
        .legend {
            display: grid;
            gap: 10px;
        }

        .mode-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        button,
        .toggle {
            appearance: none;
            border: none;
            cursor: pointer;
            font: inherit;
        }

        .mode,
        .answer,
        .launch {
            border-radius: 20px;
            padding: 14px 16px;
            background: rgba(255,255,255,0.05);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.08);
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
            text-align: left;
        }

        .mode:hover,
        .answer:hover,
        .launch:hover,
        .toggle:hover {
            transform: translateY(-1px);
            border-color: rgba(159, 244, 255, 0.4);
        }

        .mode.active,
        .answer.active {
            background: rgba(87, 214, 255, 0.14);
            border-color: rgba(87, 214, 255, 0.45);
        }

        .mode strong,
        .answer strong {
            display: block;
        }

        .mode span,
        .answer span,
        .tiny-copy {
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.45;
        }

        .launch {
            background: linear-gradient(180deg, rgba(255, 211, 106, 0.17), rgba(255, 211, 106, 0.08));
            border-color: rgba(255, 211, 106, 0.38);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-weight: 700;
        }

        .answer-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 14px;
            border-radius: 18px;
            color: var(--text);
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .toggle-badge {
            min-width: 76px;
            text-align: center;
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            color: var(--amber);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.72rem;
        }

        .result-card,
        .route-notes {
            padding: 18px;
            border-radius: 22px;
            background: var(--panel-strong);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .result-copy {
            margin: 0;
            line-height: 1.6;
            color: #dceeff;
        }

        .progress-bar {
            height: 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--amber), var(--aqua), var(--mint));
            transition: width 220ms ease;
        }

        .legend {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .legend div {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
        }

        .legend strong {
            display: block;
            color: var(--cyan);
        }

        .legend span {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            line-height: 1.45;
        }

        .route-notes ul {
            margin: 12px 0 0;
            padding-left: 18px;
            color: #d7e9fb;
            line-height: 1.6;
        }

        .result-good { color: var(--mint); }
        .result-bad { color: var(--rose); }

        @media (max-width: 980px) {
            .main-grid {
                grid-template-columns: 1fr;
            }

            .hero-grid,
            .dashboard-grid,
            .legend {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .shell {
                width: min(100% - 16px, 100%);
                margin-top: 10px;
            }

            .hero,
            .dashboard,
            .track-panel {
                padding: 16px;
                border-radius: 22px;
            }

            .mode-row,
            .answer-grid {
                grid-template-columns: 1fr;
            }

            .gps-top {
                grid-template-columns: 1fr;
            }

            .turn-icon {
                width: 62px;
                height: 62px;
            }

            .road-name {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="hero">
            <div class="eyebrow">Readable, fast, and a little dramatic</div>
            <h1>Nav Glance Rally</h1>
            <p>
                A night-drive dashboard game about what Jon noticed in that Apple Maps post: the best GPS is the one you can understand in one quick glance without doing interpretive dance at the steering wheel.
            </p>
            <div class="hero-grid">
                <div class="stat-chip">
                    <strong>8 rounds</strong>
                    <span>Per rally session</span>
                </div>
                <div class="stat-chip">
                    <strong>2 display modes</strong>
                    <span>Crystal vs cluttered</span>
                </div>
                <div class="stat-chip">
                    <strong>1 sleepy co-pilot</strong>
                    <span>You. Probably.</span>
                </div>
            </div>
        </section>

        <section class="main-grid">
            <section class="dashboard">
                <div class="windscreen">
                    <div class="skyline"></div>
                    <div class="road"></div>
                    <div class="district-pill" id="districtPill">Idle Garage</div>
                    <div class="gps-card" id="gpsCard">
                        <div class="gps-top">
                            <div class="turn-icon" id="turnIcon" aria-hidden="true"></div>
                            <div>
                                <div class="label">Next Move</div>
                                <div class="distance" id="distanceText">---</div>
                                <div class="instruction" id="instructionText">Start the rally</div>
                            </div>
                            <div>
                                <div class="label">Readability</div>
                                <div class="distance" id="clarityText" style="font-size: 1.4rem;">CRYSTAL</div>
                            </div>
                        </div>
                        <div class="road-name">
                            <div>
                                <div class="label">Road</div>
                                <strong id="roadText">North Star Test Track</strong>
                            </div>
                            <div class="subcue" id="cueText">Cue: Big arrow. Big numbers. No nonsense.</div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid">
                    <div class="meter">
                        <div class="name">Round</div>
                        <strong id="roundValue">0 / 8</strong>
                    </div>
                    <div class="meter">
                        <div class="name">Score</div>
                        <strong id="scoreValue">0</strong>
                    </div>
                    <div class="meter">
                        <div class="name">Streak</div>
                        <strong id="streakValue">0</strong>
                    </div>
                </div>

                <div class="route-notes">
                    <div class="stack-title">
                        <h3>Why This Works</h3>
                    </div>
                    <ul>
                        <li>Huge distance text keeps your eyes off the screen for less time.</li>
                        <li>High contrast and chunky arrows spare you the tiny-font nonsense.</li>
                        <li>Tilted-road theatrics make the next move feel like an actual route, not a beige spreadsheet.</li>
                    </ul>
                </div>
            </section>

            <aside class="track-panel">
                <div class="stack-title">
                    <h2>Rally Control</h2>
                    <p>Train your one-glance instincts.</p>
                </div>

                <div class="mode-row" id="modeRow">
                    <button class="mode active" data-mode="crystal">
                        <strong>Crystal Mode</strong>
                        <span>Longer glance window and a cleaner card.</span>
                    </button>
                    <button class="mode" data-mode="clutter">
                        <strong>Clutter Mode</strong>
                        <span>Shorter view, more noise, more muttering.</span>
                    </button>
                </div>

                <button class="toggle" id="nathanToggle" type="button">
                    <span>
                        <strong>Nathan Mode</strong><br>
                        <span class="tiny-copy">Adds turbo-flavored commentary and extra streak drama.</span>
                    </span>
                    <span class="toggle-badge" id="nathanBadge">Off</span>
                </button>

                <button class="launch" id="startButton" type="button">Start New Rally</button>

                <div class="progress-bar" aria-hidden="true">
                    <div class="progress-fill" id="progressFill"></div>
                </div>

                <div class="result-card">
                    <p class="result-copy" id="resultCopy">
                        Press start, watch the route card flash on screen, then tap the instruction you saw. The rally is about readable design, not clairvoyance.
                    </p>
                </div>

                <div class="answer-grid" id="answerGrid">
                    <button class="answer" data-answer="Turn left">
                        <strong>Turn left</strong>
                        <span>Bold move. Literally.</span>
                    </button>
                    <button class="answer" data-answer="Turn right">
                        <strong>Turn right</strong>
                        <span>Confidently towards snacks.</span>
                    </button>
                    <button class="answer" data-answer="Go straight">
                        <strong>Go straight</strong>
                        <span>Steady hands, no fuss.</span>
                    </button>
                    <button class="answer" data-answer="Keep left">
                        <strong>Keep left</strong>
                        <span>Not a turn, but close enough to ruin you.</span>
                    </button>
                    <button class="answer" data-answer="Keep right">
                        <strong>Keep right</strong>
                        <span>Exit-lane diplomacy.</span>
                    </button>
                    <button class="answer" data-answer="Exit left">
                        <strong>Exit left</strong>
                        <span>Ambitious, slightly chaotic.</span>
                    </button>
                    <button class="answer" data-answer="Exit right">
                        <strong>Exit right</strong>
                        <span>Classic rally behavior.</span>
                    </button>
                    <button class="answer" data-answer="Roundabout, second exit">
                        <strong>Second exit</strong>
                        <span>Spin politely, then escape.</span>
                    </button>
                    <button class="answer" data-answer="Hairpin right">
                        <strong>Hairpin right</strong>
                        <span>For the dramatic among us.</span>
                    </button>
                </div>

                <div class="legend">
                    <div>
                        <strong>Crystal</strong>
                        <span>1.8-second glance window. Clean card. Better odds of staying smug.</span>
                    </div>
                    <div>
                        <strong>Clutter</strong>
                        <span>1.05-second window. Reduced contrast. The design equivalent of static in your socks.</span>
                    </div>
                </div>
            </aside>
        </section>
    </main>

    <script>
        const scenarios = <?php echo json_encode($scenarios, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

        const iconMap = {
            "Turn left": "M42 10v18H24m0 0 12-12m-12 12 12 12M24 28h18c8 0 14 6 14 14v0",
            "Turn right": "M10 10v18h18m0 0-12-12m12 12-12 12M28 28h-4c-8 0-14 6-14 14v0",
            "Go straight": "M28 52V12m0 0-9 9m9-9 9 9",
            "Keep left": "M44 14H28v30m0 0-10-10m10 10 10 10",
            "Keep right": "M12 14h16v30m0 0 10-10m-10 10-10 10",
            "Exit left": "M44 10H26v16m0 0-10-10m10 10 10 10M26 26v26",
            "Exit right": "M12 10h18v16m0 0 10-10m-10 10-10 10M30 26v26",
            "Roundabout, second exit": "M28 13a15 15 0 1 0 15 15M43 28l-9-1 4-8M38 37h11v11",
            "Hairpin right": "M16 16h18c8 0 14 6 14 14s-6 14-14 14H20m0 0 10-10m-10 10 10 10"
        };

        const state = {
            mode: "crystal",
            nathanMode: false,
            deck: [],
            round: 0,
            score: 0,
            streak: 0,
            current: null,
            acceptingAnswers: false,
            timer: null
        };

        const districtPill = document.getElementById("districtPill");
        const gpsCard = document.getElementById("gpsCard");
        const turnIcon = document.getElementById("turnIcon");
        const distanceText = document.getElementById("distanceText");
        const instructionText = document.getElementById("instructionText");
        const roadText = document.getElementById("roadText");
        const cueText = document.getElementById("cueText");
        const clarityText = document.getElementById("clarityText");
        const roundValue = document.getElementById("roundValue");
        const scoreValue = document.getElementById("scoreValue");
        const streakValue = document.getElementById("streakValue");
        const resultCopy = document.getElementById("resultCopy");
        const progressFill = document.getElementById("progressFill");
        const modeButtons = Array.from(document.querySelectorAll(".mode"));
        const answerButtons = Array.from(document.querySelectorAll(".answer"));
        const startButton = document.getElementById("startButton");
        const nathanToggle = document.getElementById("nathanToggle");
        const nathanBadge = document.getElementById("nathanBadge");

        function shuffle(list) {
            const copy = [...list];
            for (let i = copy.length - 1; i > 0; i -= 1) {
                const j = Math.floor(Math.random() * (i + 1));
                [copy[i], copy[j]] = [copy[j], copy[i]];
            }
            return copy;
        }

        function renderCard(scenario) {
            districtPill.textContent = scenario.district;
            distanceText.textContent = scenario.distance;
            instructionText.textContent = scenario.instruction;
            roadText.textContent = scenario.road;
            cueText.textContent = `Cue: ${scenario.cue}. Hazard: ${scenario.hazard}.`;
            clarityText.textContent = state.mode === "crystal" ? "CRYSTAL" : "CLUTTER";
            gpsCard.classList.toggle("clutter", state.mode === "clutter");
            turnIcon.innerHTML = `<svg viewBox="0 0 56 56" aria-hidden="true"><path d="${iconMap[scenario.instruction] || iconMap["Go straight"]}"></path></svg>`;
        }

        function setResult(message, tone = "") {
            resultCopy.className = `result-copy ${tone}`.trim();
            resultCopy.textContent = message;
        }

        function updateMeters() {
            roundValue.textContent = `${Math.min(state.round, 8)} / 8`;
            scoreValue.textContent = String(state.score);
            streakValue.textContent = String(state.streak);
            progressFill.style.width = `${(Math.min(state.round, 8) / 8) * 100}%`;
        }

        function setMode(mode) {
            state.mode = mode;
            modeButtons.forEach((button) => {
                button.classList.toggle("active", button.dataset.mode === mode);
            });
            clarityText.textContent = mode === "crystal" ? "CRYSTAL" : "CLUTTER";
            gpsCard.classList.toggle("clutter", mode === "clutter");
            if (!state.acceptingAnswers && !state.current) {
                setResult(mode === "crystal"
                    ? "Crystal mode is polite: big type, cleaner contrast, more mercy."
                    : "Clutter mode is here to prove Jon's point the stressful way.");
            }
        }

        function toggleNathanMode() {
            state.nathanMode = !state.nathanMode;
            nathanBadge.textContent = state.nathanMode ? "On" : "Off";
            setResult(state.nathanMode
                ? "Nathan mode armed. Mildly more turbo. Wildly more dramatic."
                : "Nathan mode off. We return to our dignified dashboard era.");
        }

        function lockAnswers(disabled) {
            answerButtons.forEach((button) => {
                button.disabled = disabled;
                button.classList.remove("active");
            });
        }

        function nextRound() {
            clearTimeout(state.timer);
            if (state.round >= 8) {
                finishRally();
                return;
            }

            state.current = state.deck[state.round];
            renderCard(state.current);
            state.round += 1;
            state.acceptingAnswers = false;
            gpsCard.classList.remove("hidden-card");
            lockAnswers(true);
            updateMeters();

            const glanceMs = state.mode === "crystal" ? 1800 : 1050;
            setResult(state.nathanMode
                ? `Round ${state.round}: eyes up, turbo child. Memorize the move before the dashboard ghosts you.`
                : `Round ${state.round}: take one fast glance, then trust your brain like a decent co-pilot.`);

            state.timer = setTimeout(() => {
                gpsCard.classList.add("hidden-card");
                state.acceptingAnswers = true;
                lockAnswers(false);
                setResult(state.nathanMode
                    ? "Card hidden. Choose fast before the imaginary synth soundtrack judges you."
                    : "Card hidden. Tap the instruction you saw.");
            }, glanceMs);
        }

        function finishRally() {
            state.current = null;
            state.acceptingAnswers = false;
            gpsCard.classList.remove("hidden-card");
            districtPill.textContent = "Finish Line";
            distanceText.textContent = `${state.score}`;
            instructionText.textContent = state.mode === "crystal" ? "Rally complete" : "Clutter survived";
            roadText.textContent = state.score >= 60 ? "Readable design wins" : "Needs bigger type, frankly";
            cueText.textContent = state.mode === "crystal"
                ? "Cue: Your brain appreciates legible interfaces."
                : "Cue: Tiny, muddy UI remains a menace to civilization.";
            clarityText.textContent = state.score >= 60 ? "SHARP" : "WOBBLY";
            turnIcon.innerHTML = `<svg viewBox="0 0 56 56" aria-hidden="true"><path d="M12 30h32M34 18l10 12-10 12M12 18l10 12-10 12"></path></svg>`;
            updateMeters();

            const summary = state.score >= 70
                ? "Glorious. You read the route like a rally legend with excellent taste in interface design."
                : state.score >= 45
                    ? "Solid run. Clear cards treated you kindly; clutter mode was, as expected, annoying."
                    : "You survived. Which is also Jon's argument: make the UI do more of the work.";

            setResult(summary + (state.nathanMode ? " Nathan mode verdict: still cooler than homework." : ""));
            lockAnswers(true);
        }

        function handleAnswer(button) {
            if (!state.acceptingAnswers || !state.current) {
                return;
            }

            const chosen = button.dataset.answer;
            const correct = state.current.instruction;
            state.acceptingAnswers = false;
            lockAnswers(true);
            button.classList.add("active");
            gpsCard.classList.remove("hidden-card");

            if (chosen === correct) {
                state.streak += 1;
                const base = state.mode === "crystal" ? 10 : 14;
                const bonus = Math.min(state.streak, 5) * 2;
                state.score += base + bonus;
                setResult(
                    (state.nathanMode
                        ? `Correct. Tiny dashboard champion. ${correct} was the move.`
                        : `Correct. ${correct} was the move.`) + ` +${base + bonus} points.`,
                    "result-good"
                );
            } else {
                state.streak = 0;
                setResult(
                    (state.nathanMode
                        ? `Nope. You chose "${chosen}", but the route wanted "${correct}". The road is being theatrical.`
                        : `Not quite. You chose "${chosen}", but the card showed "${correct}".`) ,
                    "result-bad"
                );
            }

            updateMeters();
            state.timer = setTimeout(nextRound, 1350);
        }

        function startRally() {
            clearTimeout(state.timer);
            state.deck = shuffle(scenarios).slice(0, 8);
            state.round = 0;
            state.score = 0;
            state.streak = 0;
            state.current = null;
            updateMeters();
            nextRound();
        }

        modeButtons.forEach((button) => {
            button.addEventListener("click", () => setMode(button.dataset.mode));
        });

        answerButtons.forEach((button) => {
            button.addEventListener("click", () => handleAnswer(button));
        });

        startButton.addEventListener("click", startRally);
        nathanToggle.addEventListener("click", toggleNathanMode);

        setMode("crystal");
        updateMeters();
        renderCard({
            district: "Idle Garage",
            instruction: "Go straight",
            distance: "---",
            road: "North Star Test Track",
            cue: "Big arrow. Big numbers. No nonsense",
            hazard: "Only your own overconfidence"
        });
    </script>
</body>
</html>
