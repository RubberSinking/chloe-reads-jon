<?php
$inspiration = [
    'title' => 'Current Ergonomic Setup',
    'date' => '2007-12-24',
];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ergonomic Cockpit</title>
    <style>
        :root {
            --bg: #0b1016;
            --panel: rgba(9, 18, 28, 0.74);
            --panel-strong: rgba(10, 20, 31, 0.92);
            --line: rgba(145, 196, 255, 0.32);
            --line-strong: rgba(145, 196, 255, 0.75);
            --text: #e7f1ff;
            --muted: #9ab0ca;
            --gold: #f2c572;
            --coral: #ff8f7f;
            --mint: #79f2c4;
            --danger: #ff6b6b;
            --shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
            --radius: 24px;
        }

        * { box-sizing: border-box; }

        html, body { margin: 0; min-height: 100%; }

        body {
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            color: var(--text);
            background:
                radial-gradient(circle at 20% 20%, rgba(78, 145, 255, 0.18), transparent 24%),
                radial-gradient(circle at 80% 10%, rgba(242, 197, 114, 0.10), transparent 22%),
                linear-gradient(180deg, #071018 0%, #0c1520 52%, #0b1016 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px),
                radial-gradient(circle at center, transparent 0 60%, rgba(0,0,0,0.35) 100%);
            background-size: 28px 28px, 28px 28px, cover;
            opacity: 0.55;
        }

        .shell {
            width: min(1180px, calc(100vw - 28px));
            margin: 0 auto;
            padding: 24px 0 56px;
            position: relative;
            z-index: 1;
        }

        .hero {
            position: relative;
            padding: 30px;
            border: 1px solid var(--line);
            border-radius: 30px;
            background: linear-gradient(180deg, rgba(15, 31, 46, 0.82), rgba(8, 17, 27, 0.92));
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "ERGONOMIC COCKPIT";
            position: absolute;
            right: 18px;
            top: 14px;
            font: 700 0.78rem/1 "Courier New", monospace;
            letter-spacing: 0.28em;
            color: rgba(154, 176, 202, 0.28);
        }

        .hero-grid {
            display: grid;
            gap: 24px;
            grid-template-columns: 1.15fr 0.85fr;
            align-items: start;
        }

        .eyebrow, .mini-label, .dial-label, .score-label, .snapshot-metric, .legend {
            font-family: "Courier New", monospace;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 0.82rem;
            margin-bottom: 12px;
        }

        h1 {
            margin: 0;
            font-size: clamp(2.7rem, 5vw, 5rem);
            line-height: 0.92;
            letter-spacing: -0.05em;
            max-width: 10ch;
            text-wrap: balance;
        }

        .lede {
            max-width: 55ch;
            color: var(--muted);
            font-size: 1.06rem;
            line-height: 1.7;
            margin: 16px 0 22px;
        }

        .hero-notes {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pill {
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid rgba(242, 197, 114, 0.25);
            background: rgba(242, 197, 114, 0.09);
            color: #ffe7bd;
            font-size: 0.9rem;
        }

        .stats {
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            margin-top: 26px;
        }

        .stat-card {
            padding: 16px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.035);
            min-height: 108px;
        }

        .stat-card .value {
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1;
            margin: 6px 0 8px;
            color: var(--mint);
        }

        .stat-card strong {
            display: block;
            font-size: 0.82rem;
            color: var(--muted);
            font-weight: 400;
            line-height: 1.5;
        }

        .blueprint-wrap {
            border-radius: 28px;
            border: 1px solid var(--line);
            padding: 20px;
            background:
                linear-gradient(180deg, rgba(4, 12, 20, 0.92), rgba(5, 13, 21, 0.68)),
                radial-gradient(circle at top, rgba(121, 242, 196, 0.08), transparent 35%);
            position: relative;
        }

        .blueprint-wrap::before {
            content: "LIVE FIT MAP";
            position: absolute;
            top: 12px;
            left: 16px;
            font: 700 0.78rem/1 "Courier New", monospace;
            color: rgba(154, 176, 202, 0.56);
            letter-spacing: 0.18em;
        }

        .blueprint {
            width: 100%;
            aspect-ratio: 1 / 1.08;
            display: block;
            margin-top: 20px;
        }

        .panel-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 20px;
            margin-top: 22px;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 24px;
            background: var(--panel);
            backdrop-filter: blur(14px);
            box-shadow: var(--shadow);
        }

        .panel h2, .panel h3 {
            margin: 0 0 8px;
            font-size: 1.45rem;
            letter-spacing: -0.03em;
        }

        .panel p {
            margin: 0 0 18px;
            color: var(--muted);
            line-height: 1.6;
        }

        .control-stack {
            display: grid;
            gap: 16px;
        }

        .control {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(145, 196, 255, 0.18);
        }

        .control-top, .snapshot-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 10px;
        }

        .control strong {
            font-size: 1.03rem;
            font-weight: 600;
        }

        .mini-label {
            color: var(--muted);
            font-size: 0.74rem;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .range-meta {
            display: flex;
            justify-content: space-between;
            color: var(--muted);
            font-size: 0.86rem;
            margin-top: 6px;
        }

        .chip-row, .preset-row, .toggle-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button, .choice-pill {
            appearance: none;
            border: 1px solid rgba(145, 196, 255, 0.24);
            background: rgba(255,255,255,0.04);
            color: var(--text);
            border-radius: 999px;
            padding: 10px 14px;
            font: 600 0.92rem/1.1 "Palatino Linotype", "Book Antiqua", Palatino, serif;
            cursor: pointer;
            transition: transform 160ms ease, border-color 160ms ease, background 160ms ease, box-shadow 160ms ease;
        }

        button:hover, .choice-pill:hover { transform: translateY(-1px); border-color: var(--line-strong); }

        button.active, .choice-pill.active {
            background: linear-gradient(180deg, rgba(242, 197, 114, 0.22), rgba(242, 197, 114, 0.09));
            border-color: rgba(242, 197, 114, 0.5);
            color: #fff2d7;
            box-shadow: 0 0 0 1px rgba(242, 197, 114, 0.2) inset;
        }

        .toggle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid rgba(145, 196, 255, 0.18);
            background: rgba(255,255,255,0.03);
        }

        .toggle button {
            min-width: 96px;
            padding-inline: 0;
        }

        .scoreboard {
            display: grid;
            gap: 12px;
            margin-bottom: 22px;
        }

        .score-card {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(145, 196, 255, 0.18);
        }

        .score-top {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 8px;
        }

        .score-value {
            font-size: 1.6rem;
            color: var(--mint);
        }

        .track {
            height: 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            overflow: hidden;
        }

        .fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--coral), var(--gold), var(--mint));
            width: 50%;
            transition: width 220ms ease;
        }

        .coach {
            border-radius: 20px;
            padding: 18px;
            background: linear-gradient(180deg, rgba(242, 197, 114, 0.14), rgba(242, 197, 114, 0.05));
            border: 1px solid rgba(242, 197, 114, 0.25);
        }

        .coach strong {
            display: block;
            font-size: 1.08rem;
            margin-bottom: 6px;
            color: #ffe8bb;
        }

        .coach p { margin: 0; color: #f9ebcc; }

        .snapshot-list {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        .snapshot {
            padding: 16px;
            border-radius: 18px;
            border: 1px solid rgba(145, 196, 255, 0.18);
            background: rgba(255,255,255,0.03);
        }

        .snapshot h4 {
            margin: 0;
            font-size: 1rem;
        }

        .snapshot-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 12px;
            margin-top: 10px;
            color: var(--muted);
            font-size: 0.87rem;
        }

        .snapshot-actions {
            display: flex;
            gap: 8px;
            margin-top: 14px;
        }

        .legend {
            font-size: 0.72rem;
            color: var(--muted);
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
            vertical-align: middle;
        }

        .footer-note {
            text-align: center;
            color: rgba(154, 176, 202, 0.8);
            margin-top: 22px;
            font-size: 0.95rem;
        }

        @media (max-width: 980px) {
            .hero-grid, .panel-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .shell { width: min(100vw - 18px, 100%); padding-top: 10px; }
            .hero, .panel { padding: 18px; border-radius: 24px; }
            h1 { font-size: 2.5rem; }
            .stats { grid-template-columns: 1fr; }
            .toggle { align-items: flex-start; flex-direction: column; }
            .control-top, .snapshot-top, .score-top { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Inspired by Jon's desk-geek era, in the best way</div>
                    <h1>Build your ideal ergonomic cockpit.</h1>
                    <p class="lede">Jon once wrote up the exact arrangement that kept his wrists, elbows, and palms from staging a tiny workplace rebellion. So I turned that post into a live desk-fitting lab: nudge the geometry, swap hardware, compare presets, and see how your setup changes the comfort score in real time.</p>
                    <div class="hero-notes">
                        <div class="pill">Thumb-friendly keyboard layouts matter</div>
                        <div class="pill">Trackballs can be weirdly miraculous</div>
                        <div class="pill">A rolled towel still counts as engineering</div>
                    </div>
                    <div class="stats">
                        <div class="stat-card">
                            <div class="mini-label">Overall fit</div>
                            <div class="value" id="overallStat">88</div>
                            <strong>Blends arm angles, wrist support, reach, and posture into one gloriously judgmental number.</strong>
                        </div>
                        <div class="stat-card">
                            <div class="mini-label">Live posture note</div>
                            <div class="value" id="statusStat">Aligned</div>
                            <strong id="statusDetail">Your elbows are near 90°, which is delightfully textbook.</strong>
                        </div>
                        <div class="stat-card">
                            <div class="mini-label">Inspired by</div>
                            <div class="value" style="font-size:1.5rem;"><?php echo htmlspecialchars($inspiration['date']); ?></div>
                            <strong style="color: #ffe8bb;"><?php echo htmlspecialchars($inspiration['title']); ?></strong>
                        </div>
                    </div>
                </div>
                <div class="blueprint-wrap">
                    <svg class="blueprint" viewBox="0 0 520 560" role="img" aria-label="Blueprint view of an ergonomic desk setup">
                        <defs>
                            <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
                                <feGaussianBlur stdDeviation="6" result="blur"></feGaussianBlur>
                                <feMerge><feMergeNode in="blur"></feMergeNode><feMergeNode in="SourceGraphic"></feMergeNode></feMerge>
                            </filter>
                        </defs>
                        <rect x="24" y="24" width="472" height="512" rx="22" fill="rgba(6,15,24,0.68)" stroke="rgba(145,196,255,0.28)"></rect>
                        <g opacity="0.18" stroke="rgba(145,196,255,0.55)">
                            <line x1="60" y1="70" x2="460" y2="70"></line>
                            <line x1="60" y1="150" x2="460" y2="150"></line>
                            <line x1="60" y1="230" x2="460" y2="230"></line>
                            <line x1="60" y1="310" x2="460" y2="310"></line>
                            <line x1="60" y1="390" x2="460" y2="390"></line>
                            <line x1="60" y1="470" x2="460" y2="470"></line>
                            <line x1="100" y1="50" x2="100" y2="510"></line>
                            <line x1="180" y1="50" x2="180" y2="510"></line>
                            <line x1="260" y1="50" x2="260" y2="510"></line>
                            <line x1="340" y1="50" x2="340" y2="510"></line>
                            <line x1="420" y1="50" x2="420" y2="510"></line>
                        </g>
                        <line id="deskLine" x1="70" y1="330" x2="450" y2="330" stroke="rgba(242,197,114,0.9)" stroke-width="6" stroke-linecap="round" filter="url(#glow)"></line>
                        <rect id="monitor" x="316" y="132" width="104" height="72" rx="10" fill="rgba(10,22,34,0.96)" stroke="rgba(121,242,196,0.88)" stroke-width="3"></rect>
                        <line id="monitorStem" x1="368" y1="204" x2="368" y2="308" stroke="rgba(121,242,196,0.65)" stroke-width="4"></line>
                        <rect id="keyboardRect" x="222" y="292" width="98" height="32" rx="11" fill="rgba(145,196,255,0.15)" stroke="rgba(145,196,255,0.9)" stroke-width="3"></rect>
                        <circle id="pointerCircle" cx="350" cy="308" r="16" fill="rgba(255,143,127,0.15)" stroke="rgba(255,143,127,0.9)" stroke-width="3"></circle>
                        <rect id="supportPad" x="188" y="326" width="132" height="18" rx="9" fill="rgba(121,242,196,0.2)" stroke="rgba(121,242,196,0.75)" stroke-dasharray="6 5"></rect>
                        <rect id="seatRect" x="146" y="378" width="120" height="18" rx="8" fill="rgba(242,197,114,0.2)" stroke="rgba(242,197,114,0.75)"></rect>
                        <line id="seatStem" x1="206" y1="396" x2="206" y2="450" stroke="rgba(242,197,114,0.6)" stroke-width="4"></line>
                        <circle cx="206" cy="462" r="16" fill="none" stroke="rgba(242,197,114,0.45)" stroke-width="3"></circle>
                        <g id="person" stroke-linecap="round" stroke-linejoin="round" fill="none">
                            <circle id="head" cx="198" cy="244" r="24" stroke="rgba(231,241,255,0.9)" stroke-width="4"></circle>
                            <path id="spine" d="M198 270 L198 360" stroke="rgba(231,241,255,0.9)" stroke-width="6"></path>
                            <path id="torso" d="M166 308 Q198 286 230 308" stroke="rgba(231,241,255,0.6)" stroke-width="5"></path>
                            <path id="upperArm" d="M225 306 L<?php echo 262; ?> 306" stroke="rgba(121,242,196,0.95)" stroke-width="6"></path>
                            <path id="forearm" d="M262 306 L306 306" stroke="rgba(121,242,196,0.95)" stroke-width="6"></path>
                            <path id="thigh" d="M198 360 L248 384" stroke="rgba(145,196,255,0.85)" stroke-width="6"></path>
                            <path id="shin" d="M248 384 L244 446" stroke="rgba(145,196,255,0.85)" stroke-width="6"></path>
                            <path id="foot" d="M244 446 L286 446" stroke="rgba(145,196,255,0.85)" stroke-width="6"></path>
                            <path id="neckGuide" d="M208 226 L282 205" stroke="rgba(255,143,127,0.9)" stroke-width="4" stroke-dasharray="6 8"></path>
                            <rect id="smartGloveMark" x="299" y="298" width="20" height="12" rx="4" fill="rgba(242,197,114,0.75)" stroke="none"></rect>
                        </g>
                        <text x="68" y="525" fill="rgba(154,176,202,0.75)" font-family="Courier New, monospace" font-size="14">shoulder</text>
                        <text x="220" y="525" fill="rgba(154,176,202,0.75)" font-family="Courier New, monospace" font-size="14">wrist</text>
                        <text x="376" y="525" fill="rgba(154,176,202,0.75)" font-family="Courier New, monospace" font-size="14">monitor</text>
                    </svg>
                    <div class="legend">
                        <span><span class="dot" style="background: var(--mint);"></span>arm comfort</span>
                        <span><span class="dot" style="background: var(--coral);"></span>neck strain</span>
                        <span><span class="dot" style="background: var(--gold);"></span>desk geometry</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel-grid">
            <section class="panel">
                <h2>Tune the geometry</h2>
                <p>Start with Jon's 2007 rig, then push things around until the score either improves or quietly begs for mercy.</p>
                <div class="preset-row" id="presetRow"></div>
                <div class="control-stack" style="margin-top: 18px;">
                    <div class="control">
                        <div class="control-top"><strong>Desk height</strong><span class="mini-label" id="deskValue">26.0 in</span></div>
                        <input id="deskHeight" type="range" min="22" max="32" step="0.5" value="26">
                        <div class="range-meta"><span>Lower shoulders</span><span>More reach</span></div>
                    </div>
                    <div class="control">
                        <div class="control-top"><strong>Chair height</strong><span class="mini-label" id="chairValue">17.5 in</span></div>
                        <input id="chairHeight" type="range" min="15" max="24" step="0.5" value="17.5">
                        <div class="range-meta"><span>Knees relaxed</span><span>Perch mode</span></div>
                    </div>
                    <div class="control">
                        <div class="control-top"><strong>Monitor center</strong><span class="mini-label" id="monitorValue">6.0 in above desk</span></div>
                        <input id="monitorHeight" type="range" min="1" max="14" step="0.5" value="6">
                        <div class="range-meta"><span>Neck neutral</span><span>Upward gaze</span></div>
                    </div>
                    <div class="control">
                        <div class="control-top"><strong>Monitor distance</strong><span class="mini-label" id="distanceValue">24.0 in</span></div>
                        <input id="monitorDistance" type="range" min="16" max="36" step="1" value="24">
                        <div class="range-meta"><span>Close focus</span><span>Deep desk</span></div>
                    </div>
                    <div class="control">
                        <div class="control-top"><strong>Keyboard angle</strong><span class="mini-label" id="keyboardAngleValue">2° tilt</span></div>
                        <input id="keyboardTilt" type="range" min="-6" max="12" step="1" value="2">
                        <div class="range-meta"><span>Negative tilt</span><span>Pop-up feet chaos</span></div>
                    </div>
                </div>

                <div class="control" style="margin-top: 16px;">
                    <div class="control-top"><strong>Keyboard</strong><span class="mini-label">thumbs and wrists have opinions</span></div>
                    <div class="chip-row" id="keyboardChoices"></div>
                </div>

                <div class="control" style="margin-top: 16px;">
                    <div class="control-top"><strong>Pointer</strong><span class="mini-label">choose your hand's drama level</span></div>
                    <div class="chip-row" id="pointerChoices"></div>
                </div>

                <div class="toggle-row" style="margin-top: 16px; display:grid; gap: 12px;">
                    <div class="toggle">
                        <div>
                            <strong>Forearm support</strong>
                            <div class="mini-label">rolled towel supremacy, surprisingly</div>
                        </div>
                        <button data-toggle="forearmSupport" class="toggle-button">Enabled</button>
                    </div>
                    <div class="toggle">
                        <div>
                            <strong>SmartGloves style wrist support</strong>
                            <div class="mini-label">keeps wrists from bending backwards</div>
                        </div>
                        <button data-toggle="smartGloves" class="toggle-button">Enabled</button>
                    </div>
                    <div class="toggle">
                        <div>
                            <strong>Back support</strong>
                            <div class="mini-label">the chair doing its share of the work</div>
                        </div>
                        <button data-toggle="backSupport" class="toggle-button">Enabled</button>
                    </div>
                </div>
            </section>

            <aside class="panel">
                <h3>Comfort telemetry</h3>
                <p>Not medical advice, obviously. More like an enthusiastic geometry goblin doing its best.</p>
                <div class="scoreboard" id="scoreboard"></div>
                <div class="coach">
                    <strong id="coachTitle">Looking good.</strong>
                    <p id="coachCopy">This setup is close to Jon's original sweet spot: elbows near right angles, keyboard within easy reach, and not much upward crane.</p>
                </div>

                <div style="margin-top: 22px; display:flex; gap: 10px; flex-wrap: wrap;">
                    <button id="saveSnapshot">Save snapshot</button>
                    <button id="resetSetup">Reset to Jon's setup</button>
                    <button id="mutinyButton">Make it terrible</button>
                </div>

                <div class="snapshot-list" id="snapshotList"></div>
                <div class="footer-note">A good setup should feel boring in the nicest possible way.</div>
            </aside>
        </section>
    </main>

    <script>
        const presets = {
            jon2007: {
                name: "Jon's 2007 setup",
                deskHeight: 26,
                chairHeight: 17.5,
                monitorHeight: 6,
                monitorDistance: 24,
                keyboardTilt: 2,
                keyboard: "kinesis",
                pointer: "trackball",
                forearmSupport: true,
                smartGloves: true,
                backSupport: true,
            },
            laptopSlump: {
                name: "Laptop goblin mode",
                deskHeight: 29,
                chairHeight: 16,
                monitorHeight: 1,
                monitorDistance: 18,
                keyboardTilt: 10,
                keyboard: "laptop",
                pointer: "mouse",
                forearmSupport: false,
                smartGloves: false,
                backSupport: false,
            },
            readingNook: {
                name: "Calm reading station",
                deskHeight: 25,
                chairHeight: 18,
                monitorHeight: 8,
                monitorDistance: 27,
                keyboardTilt: 0,
                keyboard: "natural",
                pointer: "vertical",
                forearmSupport: true,
                smartGloves: false,
                backSupport: true,
            },
            standingish: {
                name: "Standing-ish experiment",
                deskHeight: 31,
                chairHeight: 22,
                monitorHeight: 9,
                monitorDistance: 25,
                keyboardTilt: -2,
                keyboard: "split",
                pointer: "trackball",
                forearmSupport: true,
                smartGloves: false,
                backSupport: false,
            }
        };

        const keyboardOptions = {
            kinesis: { label: "Kinesis Advantage", wrist: 11, shoulder: 4, flair: "thumb keys" },
            natural: { label: "Microsoft Natural 4000", wrist: 7, shoulder: 2, flair: "gentler split" },
            split: { label: "Compact split", wrist: 8, shoulder: 5, flair: "custom spacing" },
            laptop: { label: "Laptop keyboard", wrist: -6, shoulder: -4, flair: "travel mode" }
        };

        const pointerOptions = {
            trackball: { label: "Kensington trackball", wrist: 9, shoulder: 6, flair: "minimal arm travel" },
            mouse: { label: "Standard mouse", wrist: -4, shoulder: -3, flair: "the usual suspect" },
            vertical: { label: "Vertical mouse", wrist: 4, shoulder: 1, flair: "less pronation" }
        };

        const state = structuredClone(presets.jon2007);
        const scores = [
            { key: "wrist", label: "Wrist comfort" },
            { key: "neck", label: "Neck angle" },
            { key: "shoulder", label: "Shoulder ease" },
            { key: "focus", label: "Focus endurance" }
        ];

        const elements = {
            deskHeight: document.getElementById('deskHeight'),
            chairHeight: document.getElementById('chairHeight'),
            monitorHeight: document.getElementById('monitorHeight'),
            monitorDistance: document.getElementById('monitorDistance'),
            keyboardTilt: document.getElementById('keyboardTilt'),
            deskValue: document.getElementById('deskValue'),
            chairValue: document.getElementById('chairValue'),
            monitorValue: document.getElementById('monitorValue'),
            distanceValue: document.getElementById('distanceValue'),
            keyboardAngleValue: document.getElementById('keyboardAngleValue'),
            presetRow: document.getElementById('presetRow'),
            keyboardChoices: document.getElementById('keyboardChoices'),
            pointerChoices: document.getElementById('pointerChoices'),
            scoreboard: document.getElementById('scoreboard'),
            overallStat: document.getElementById('overallStat'),
            statusStat: document.getElementById('statusStat'),
            statusDetail: document.getElementById('statusDetail'),
            coachTitle: document.getElementById('coachTitle'),
            coachCopy: document.getElementById('coachCopy'),
            snapshotList: document.getElementById('snapshotList'),
            saveSnapshot: document.getElementById('saveSnapshot'),
            resetSetup: document.getElementById('resetSetup'),
            mutinyButton: document.getElementById('mutinyButton'),
            deskLine: document.getElementById('deskLine'),
            monitor: document.getElementById('monitor'),
            monitorStem: document.getElementById('monitorStem'),
            keyboardRect: document.getElementById('keyboardRect'),
            pointerCircle: document.getElementById('pointerCircle'),
            supportPad: document.getElementById('supportPad'),
            seatRect: document.getElementById('seatRect'),
            seatStem: document.getElementById('seatStem'),
            upperArm: document.getElementById('upperArm'),
            forearm: document.getElementById('forearm'),
            neckGuide: document.getElementById('neckGuide'),
            smartGloveMark: document.getElementById('smartGloveMark')
        };

        function clamp(value, min, max) {
            return Math.min(max, Math.max(min, value));
        }

        function setupButtons() {
            Object.entries(presets).forEach(([key, preset]) => {
                const button = document.createElement('button');
                button.textContent = preset.name;
                button.addEventListener('click', () => {
                    Object.assign(state, structuredClone(preset));
                    syncInputs();
                    render();
                });
                button.dataset.preset = key;
                elements.presetRow.appendChild(button);
            });

            Object.entries(keyboardOptions).forEach(([key, option]) => {
                const button = document.createElement('button');
                button.className = 'choice-pill';
                button.innerHTML = `${option.label}<br><span class="mini-label">${option.flair}</span>`;
                button.addEventListener('click', () => {
                    state.keyboard = key;
                    render();
                });
                button.dataset.keyboard = key;
                elements.keyboardChoices.appendChild(button);
            });

            Object.entries(pointerOptions).forEach(([key, option]) => {
                const button = document.createElement('button');
                button.className = 'choice-pill';
                button.innerHTML = `${option.label}<br><span class="mini-label">${option.flair}</span>`;
                button.addEventListener('click', () => {
                    state.pointer = key;
                    render();
                });
                button.dataset.pointer = key;
                elements.pointerChoices.appendChild(button);
            });

            document.querySelectorAll('.toggle-button').forEach(button => {
                button.addEventListener('click', () => {
                    const key = button.dataset.toggle;
                    state[key] = !state[key];
                    render();
                });
            });
        }

        function syncInputs() {
            ['deskHeight', 'chairHeight', 'monitorHeight', 'monitorDistance', 'keyboardTilt'].forEach(key => {
                elements[key].value = state[key];
            });
        }

        function attachInputs() {
            ['deskHeight', 'chairHeight', 'monitorHeight', 'monitorDistance', 'keyboardTilt'].forEach(key => {
                elements[key].addEventListener('input', e => {
                    state[key] = Number(e.target.value);
                    render();
                });
            });
        }

        function computeScores() {
            const elbowAngle = 90 + ((state.chairHeight + 8) - state.deskHeight) * 6;
            const elbowPenalty = Math.abs(elbowAngle - 90) * 1.35;
            const neckAngle = (state.monitorHeight - 6) * 3.4 - (state.monitorDistance - 24) * 0.35;
            const wristAngle = state.keyboardTilt * 4 + (state.smartGloves ? -8 : 4);
            const shoulderReach = Math.abs(state.monitorDistance - 24) * 0.9 + (state.pointer === 'mouse' ? 8 : state.pointer === 'vertical' ? 3 : 0);

            const keyboardBonus = keyboardOptions[state.keyboard];
            const pointerBonus = pointerOptions[state.pointer];
            const supportBonus = state.forearmSupport ? 10 : -8;
            const backBonus = state.backSupport ? 8 : -6;

            const wrist = clamp(88 - Math.abs(wristAngle) - elbowPenalty * 0.45 + keyboardBonus.wrist + pointerBonus.wrist + supportBonus, 14, 100);
            const neck = clamp(90 - Math.abs(neckAngle) * 2.3 + (state.monitorDistance >= 20 && state.monitorDistance <= 28 ? 4 : -4), 10, 100);
            const shoulder = clamp(89 - shoulderReach - elbowPenalty * 0.35 + keyboardBonus.shoulder + pointerBonus.shoulder + (state.forearmSupport ? 4 : -5), 12, 100);
            const focus = clamp((wrist + neck + shoulder) / 3 + backBonus + (state.pointer === 'trackball' ? 3 : 0), 10, 100);
            const overall = Math.round((wrist + neck + shoulder + focus) / 4);

            return {
                wrist: Math.round(wrist),
                neck: Math.round(neck),
                shoulder: Math.round(shoulder),
                focus: Math.round(focus),
                overall,
                elbowAngle,
                neckAngle,
                wristAngle
            };
        }

        function getStatus(scoreSet) {
            if (scoreSet.overall >= 86) {
                return {
                    stat: 'Aligned',
                    detail: 'Your elbows are near 90°, which is delightfully textbook.',
                    title: 'Looking good.',
                    copy: 'This setup is close to Jon\'s original sweet spot: elbows near right angles, keyboard within easy reach, and not much upward crane.'
                };
            }
            if (scoreSet.overall >= 72) {
                return {
                    stat: 'Tweakable',
                    detail: 'Pretty solid, but one or two angles are getting cheeky.',
                    title: 'Almost there.',
                    copy: 'You\'re in the decent zone. Try lowering the desk a little, easing the keyboard tilt, or bringing the monitor back to neutral territory.'
                };
            }
            if (scoreSet.overall >= 55) {
                return {
                    stat: 'Fussy',
                    detail: 'The geometry is starting to mutter under its breath.',
                    title: 'Your wrists are sending notes.',
                    copy: 'This isn\'t a disaster, but it does have a strong “I will complain by 3 PM” aura. The usual rescue moves are more support, less reach, and less aggressive tilt.'
                };
            }
            return {
                stat: 'Mutiny',
                detail: 'This setup belongs in a cautionary training slideshow.',
                title: 'Desk goblin detected.',
                copy: 'You have built a noble monument to shoulder shrugging. Lower something, support something, and maybe apologise to your tendons.'
            };
        }

        function renderScoreboard(scoreSet) {
            elements.scoreboard.innerHTML = '';
            scores.forEach(item => {
                const card = document.createElement('div');
                card.className = 'score-card';
                card.innerHTML = `
                    <div class="score-top">
                        <span class="score-label">${item.label}</span>
                        <span class="score-value">${scoreSet[item.key]}</span>
                    </div>
                    <div class="track"><div class="fill" style="width:${scoreSet[item.key]}%"></div></div>
                `;
                elements.scoreboard.appendChild(card);
            });
        }

        function renderBlueprint(scoreSet) {
            const deskY = 330 - (state.deskHeight - 26) * 10;
            const seatY = 378 - (state.chairHeight - 17.5) * 12;
            const monitorY = deskY - 132 - (state.monitorHeight - 6) * 10;
            const monitorX = 316 + (state.monitorDistance - 24) * 3;
            const keyboardX = 222 + (state.monitorDistance - 24) * 0.8;
            const keyboardRotation = state.keyboardTilt * 1.3;
            const elbowX = 262 + (state.deskHeight - state.chairHeight - 8.5) * 2.8;
            const wristX = elbowX + 44 + (state.keyboardTilt * 1.2);
            const wristY = deskY - 24 + state.keyboardTilt * 0.4;
            const neckEndX = 282 + (state.monitorDistance - 24) * 1.5;
            const neckEndY = 205 - (state.monitorHeight - 6) * 4;

            elements.deskLine.setAttribute('y1', deskY);
            elements.deskLine.setAttribute('y2', deskY);
            elements.monitor.setAttribute('x', monitorX);
            elements.monitor.setAttribute('y', monitorY);
            elements.monitorStem.setAttribute('x1', monitorX + 52);
            elements.monitorStem.setAttribute('x2', monitorX + 52);
            elements.monitorStem.setAttribute('y1', monitorY + 72);
            elements.monitorStem.setAttribute('y2', deskY - 22);
            elements.keyboardRect.setAttribute('x', keyboardX);
            elements.keyboardRect.setAttribute('y', deskY - 38);
            elements.keyboardRect.setAttribute('transform', `rotate(${keyboardRotation} ${keyboardX + 49} ${deskY - 22})`);
            elements.pointerCircle.setAttribute('cx', keyboardX + 128);
            elements.pointerCircle.setAttribute('cy', deskY - 16);
            elements.pointerCircle.setAttribute('r', state.pointer === 'trackball' ? 18 : state.pointer === 'vertical' ? 13 : 15);
            elements.supportPad.style.opacity = state.forearmSupport ? '1' : '0.1';
            elements.supportPad.setAttribute('y', deskY - 4);
            elements.seatRect.setAttribute('y', seatY);
            elements.seatStem.setAttribute('y1', seatY + 18);
            elements.seatStem.setAttribute('y2', seatY + 72);
            elements.upperArm.setAttribute('d', `M225 306 L${elbowX} ${306 + (seatY - 378) * 0.3}`);
            elements.forearm.setAttribute('d', `M${elbowX} ${306 + (seatY - 378) * 0.3} L${wristX} ${wristY}`);
            elements.neckGuide.setAttribute('d', `M208 226 L${neckEndX} ${neckEndY}`);
            elements.smartGloveMark.style.opacity = state.smartGloves ? '1' : '0.14';
            elements.smartGloveMark.setAttribute('x', wristX - 7);
            elements.smartGloveMark.setAttribute('y', wristY - 8);

            const armColor = scoreSet.wrist >= 80 ? 'rgba(121,242,196,0.95)' : scoreSet.wrist >= 60 ? 'rgba(242,197,114,0.95)' : 'rgba(255,107,107,0.95)';
            const neckColor = scoreSet.neck >= 80 ? 'rgba(121,242,196,0.9)' : scoreSet.neck >= 60 ? 'rgba(242,197,114,0.9)' : 'rgba(255,107,107,0.95)';
            elements.upperArm.setAttribute('stroke', armColor);
            elements.forearm.setAttribute('stroke', armColor);
            elements.neckGuide.setAttribute('stroke', neckColor);
        }

        function renderButtons() {
            document.querySelectorAll('[data-preset]').forEach(button => {
                const key = button.dataset.preset;
                const active = JSON.stringify(state) === JSON.stringify(presets[key]);
                button.classList.toggle('active', active);
            });
            document.querySelectorAll('[data-keyboard]').forEach(button => {
                button.classList.toggle('active', button.dataset.keyboard === state.keyboard);
            });
            document.querySelectorAll('[data-pointer]').forEach(button => {
                button.classList.toggle('active', button.dataset.pointer === state.pointer);
            });
            document.querySelectorAll('.toggle-button').forEach(button => {
                const key = button.dataset.toggle;
                button.classList.toggle('active', state[key]);
                button.textContent = state[key] ? 'Enabled' : 'Disabled';
            });
        }

        function renderReadouts(scoreSet, status) {
            elements.deskValue.textContent = `${state.deskHeight.toFixed(1)} in`;
            elements.chairValue.textContent = `${state.chairHeight.toFixed(1)} in`;
            elements.monitorValue.textContent = `${state.monitorHeight.toFixed(1)} in above desk`;
            elements.distanceValue.textContent = `${state.monitorDistance.toFixed(1)} in`;
            elements.keyboardAngleValue.textContent = `${state.keyboardTilt}° tilt`;
            elements.overallStat.textContent = scoreSet.overall;
            elements.statusStat.textContent = status.stat;
            elements.statusDetail.textContent = status.detail;
            elements.coachTitle.textContent = status.title;
            elements.coachCopy.textContent = status.copy;
        }

        function loadSnapshots() {
            try {
                return JSON.parse(localStorage.getItem('ergonomic-cockpit-snapshots') || '[]');
            } catch {
                return [];
            }
        }

        function saveSnapshots(items) {
            localStorage.setItem('ergonomic-cockpit-snapshots', JSON.stringify(items.slice(0, 3)));
        }

        function renderSnapshots() {
            const snapshots = loadSnapshots();
            elements.snapshotList.innerHTML = snapshots.length ? '<h3 style="margin:10px 0 4px;">Saved rigs</h3>' : '';
            snapshots.forEach((snap, index) => {
                const item = document.createElement('div');
                item.className = 'snapshot';
                item.innerHTML = `
                    <div class="snapshot-top">
                        <h4>${snap.name}</h4>
                        <span class="snapshot-metric">score ${snap.overall}</span>
                    </div>
                    <div class="snapshot-meta">
                        <span>${snap.keyboardLabel}</span>
                        <span>${snap.pointerLabel}</span>
                        <span>desk ${snap.deskHeight.toFixed(1)} in</span>
                        <span>chair ${snap.chairHeight.toFixed(1)} in</span>
                    </div>
                    <div class="snapshot-actions">
                        <button data-load-snapshot="${index}">Load</button>
                        <button data-delete-snapshot="${index}">Delete</button>
                    </div>
                `;
                elements.snapshotList.appendChild(item);
            });

            elements.snapshotList.querySelectorAll('[data-load-snapshot]').forEach(button => {
                button.addEventListener('click', () => {
                    const snap = loadSnapshots()[Number(button.dataset.loadSnapshot)];
                    if (!snap) return;
                    Object.assign(state, snap.state);
                    syncInputs();
                    render();
                });
            });

            elements.snapshotList.querySelectorAll('[data-delete-snapshot]').forEach(button => {
                button.addEventListener('click', () => {
                    const items = loadSnapshots();
                    items.splice(Number(button.dataset.deleteSnapshot), 1);
                    saveSnapshots(items);
                    renderSnapshots();
                });
            });
        }

        function saveCurrentSnapshot() {
            const scoreSet = computeScores();
            const labelBase = scoreSet.overall >= 86 ? 'Comfy' : scoreSet.overall >= 70 ? 'Nearly there' : scoreSet.overall >= 55 ? 'Fussy' : 'Desk goblin';
            const snapshots = loadSnapshots();
            snapshots.unshift({
                name: `${labelBase} rig ${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`,
                overall: scoreSet.overall,
                deskHeight: state.deskHeight,
                chairHeight: state.chairHeight,
                keyboardLabel: keyboardOptions[state.keyboard].label,
                pointerLabel: pointerOptions[state.pointer].label,
                state: structuredClone(state)
            });
            saveSnapshots(snapshots);
            renderSnapshots();
        }

        function render() {
            const scoreSet = computeScores();
            const status = getStatus(scoreSet);
            renderReadouts(scoreSet, status);
            renderScoreboard(scoreSet);
            renderBlueprint(scoreSet);
            renderButtons();
            renderSnapshots();
        }

        setupButtons();
        attachInputs();
        syncInputs();
        render();

        elements.saveSnapshot.addEventListener('click', saveCurrentSnapshot);
        elements.resetSetup.addEventListener('click', () => {
            Object.assign(state, structuredClone(presets.jon2007));
            syncInputs();
            render();
        });
        elements.mutinyButton.addEventListener('click', () => {
            Object.assign(state, structuredClone(presets.laptopSlump));
            state.monitorDistance = 17;
            state.keyboardTilt = 12;
            syncInputs();
            render();
        });
    </script>
</body>
</html>
