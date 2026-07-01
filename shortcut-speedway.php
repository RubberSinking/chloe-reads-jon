<?php
$sourceTitle = 'OS X Keyboard shortcuts';
$sourceUrl = 'https://jona.ca/2004/07/os-x-keyboard-shortcuts.html';

$challenges = [
    [
        'zone' => 'Finder',
        'prompt' => 'Hide the current app so the desktop can breathe again.',
        'combo' => ['Command', 'H'],
        'tip' => 'A tidy little vanish trick when one window is hogging the stage.',
    ],
    [
        'zone' => 'Finder',
        'prompt' => 'Open a fresh Finder window for the next mission.',
        'combo' => ['Command', 'N'],
        'tip' => 'Classic new-window magic. No rummaging through menus like a Victorian.',
    ],
    [
        'zone' => 'Editing',
        'prompt' => 'Select everything in the current document in one sweep.',
        'combo' => ['Command', 'A'],
        'tip' => 'The universal “yes, all of it” move.',
    ],
    [
        'zone' => 'Editing',
        'prompt' => 'Undo the regrettable thing you just did.',
        'combo' => ['Command', 'Z'],
        'tip' => 'Software absolution, one keystroke at a time.',
    ],
    [
        'zone' => 'Screenshots',
        'prompt' => 'Snap the whole screen as a screenshot trophy.',
        'combo' => ['Command', 'Shift', '3'],
        'tip' => 'The full-canvas capture. Very useful when chaos deserves documentation.',
    ],
    [
        'zone' => 'Screenshots',
        'prompt' => 'Capture just a chosen slice of the screen.',
        'combo' => ['Command', 'Shift', '4'],
        'tip' => 'For precise little rectangles of drama.',
    ],
    [
        'zone' => 'Browsing',
        'prompt' => 'Open a new browser tab before curiosity escapes.',
        'combo' => ['Command', 'T'],
        'tip' => 'The internet’s equivalent of pulling a fresh notebook from the stack.',
    ],
    [
        'zone' => 'Browsing',
        'prompt' => 'Close the tab that has finished being interesting.',
        'combo' => ['Command', 'W'],
        'tip' => 'Mercy for your tab bar.',
    ],
    [
        'zone' => 'System',
        'prompt' => 'Switch to the next app without touching the trackpad.',
        'combo' => ['Command', 'Tab'],
        'tip' => 'Desktop lane changing at civilized speed.',
    ],
    [
        'zone' => 'Writing',
        'prompt' => 'Save your current work before fate gets ideas.',
        'combo' => ['Command', 'S'],
        'tip' => 'An underrated spiritual discipline.',
    ],
    [
        'zone' => 'Editing',
        'prompt' => 'Paste whatever is currently waiting on the clipboard.',
        'combo' => ['Command', 'V'],
        'tip' => 'The royal road from elsewhere to here.',
    ],
    [
        'zone' => 'System',
        'prompt' => 'Quit the current app with firm but polite finality.',
        'combo' => ['Command', 'Q'],
        'tip' => 'A cleaner exit than letting windows pile up like laundry.',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shortcut Speedway</title>
    <style>
        :root {
            --bg: #06131a;
            --bg-deep: #031017;
            --panel: rgba(7, 21, 29, 0.78);
            --panel-strong: rgba(10, 27, 36, 0.94);
            --line: rgba(164, 224, 217, 0.22);
            --line-strong: rgba(245, 191, 110, 0.45);
            --teal: #9ff3df;
            --cyan: #63d7de;
            --gold: #f5bf6e;
            --coral: #ff8d6f;
            --cream: #fff7e6;
            --ink: #dceef1;
            --muted: #91abb1;
            --shadow: 0 28px 80px rgba(0, 0, 0, 0.42);
            --radius: 28px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Avenir Next Condensed", "Trebuchet MS", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(99, 215, 222, 0.18), transparent 28%),
                radial-gradient(circle at 80% 8%, rgba(245, 191, 110, 0.15), transparent 24%),
                linear-gradient(180deg, #0a212b 0%, #06131a 54%, #031017 100%);
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
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px) 0 0 / 56px 56px,
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px) 0 0 / 56px 56px;
            mask-image: linear-gradient(180deg, transparent, rgba(0,0,0,0.85) 12%, rgba(0,0,0,0.85) 88%, transparent);
            opacity: 0.33;
        }

        body::after {
            background:
                radial-gradient(circle at 25% 16%, rgba(255,255,255,0.16) 0 1px, transparent 2px),
                radial-gradient(circle at 74% 14%, rgba(255,255,255,0.12) 0 1px, transparent 2px),
                radial-gradient(circle at 62% 36%, rgba(255,255,255,0.10) 0 1px, transparent 2px),
                radial-gradient(circle at 14% 48%, rgba(255,255,255,0.08) 0 1px, transparent 2px);
            background-size: 320px 220px;
            opacity: 0.65;
            animation: twinkle 16s linear infinite;
        }

        @keyframes twinkle {
            from { transform: translateY(0); }
            to { transform: translateY(20px); }
        }

        .wrap {
            width: min(1180px, calc(100% - 28px));
            margin: 20px auto 44px;
            display: grid;
            gap: 18px;
        }

        .hero,
        .panel,
        .footer-card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 28px;
        }

        .hero::before {
            content: "";
            position: absolute;
            right: -8%;
            top: -22%;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 191, 110, 0.22), transparent 64%);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--gold);
            font-size: 0.8rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        h1 {
            margin: 18px 0 0;
            font-family: "Baskerville", "Palatino Linotype", serif;
            font-size: clamp(3rem, 8vw, 5.8rem);
            line-height: 0.9;
            color: var(--cream);
            max-width: 8ch;
            text-wrap: balance;
        }

        .hero-copy {
            margin-top: 16px;
            max-width: 62ch;
            color: #d9edf0;
            font-size: 1.04rem;
            line-height: 1.65;
        }

        .hero-grid {
            margin-top: 22px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .hero-card {
            position: relative;
            padding: 16px 18px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255,255,255,0.09), rgba(255,255,255,0.035));
            border: 1px solid rgba(255,255,255,0.1);
            overflow: hidden;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            inset: auto -20% -50% auto;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(99, 215, 222, 0.22), transparent 68%);
        }

        .hero-card strong {
            display: block;
            font-size: 1.4rem;
            color: var(--teal);
        }

        .hero-card span {
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
        }

        .layout {
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 18px;
        }

        .panel {
            padding: 22px;
        }

        .mission-board {
            display: grid;
            gap: 16px;
        }

        .section-label {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 0.78rem;
        }

        .mission-plate {
            padding: 22px;
            border-radius: 24px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03)),
                linear-gradient(135deg, rgba(99, 215, 222, 0.08), transparent 52%);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .zone-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(245, 191, 110, 0.12);
            color: var(--gold);
            font-size: 0.82rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .mission-plate h2 {
            margin: 14px 0 10px;
            font-family: "Baskerville", "Palatino Linotype", serif;
            font-size: clamp(1.7rem, 4vw, 2.5rem);
            line-height: 1.06;
            color: var(--cream);
        }

        .mission-plate p {
            margin: 0;
            color: #d2e7ea;
            line-height: 1.65;
            font-size: 1rem;
        }

        .meter-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .meter {
            padding: 16px;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.18);
            border: 1px solid rgba(255,255,255,0.06);
        }

        .meter .label {
            color: var(--muted);
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .meter .value {
            display: block;
            margin-top: 8px;
            font-size: 1.8rem;
            color: var(--teal);
        }

        .track {
            position: relative;
            min-height: 146px;
            border-radius: 24px;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.06), transparent),
                linear-gradient(135deg, #0e2933 0%, #08171d 100%);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .track::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(90deg, rgba(255,255,255,0.04), rgba(255,255,255,0.04) 8px, transparent 8px, transparent 72px),
                linear-gradient(90deg, rgba(255,255,255,0.14) 0 8%, transparent 8% 92%, rgba(255,255,255,0.14) 92% 100%);
            opacity: 0.24;
        }

        .lane {
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            height: 4px;
            background: repeating-linear-gradient(90deg, transparent, transparent 24px, rgba(245, 191, 110, 0.5) 24px, rgba(245, 191, 110, 0.5) 44px);
            transform: translateY(-50%);
        }

        .car {
            position: absolute;
            top: 50%;
            left: 22px;
            transform: translateY(-50%);
            width: 122px;
            height: 56px;
            border-radius: 22px 18px 18px 16px;
            background:
                linear-gradient(180deg, #fff7d6 0%, #f4bf59 18%, #d4733e 80%, #6a2719 100%);
            box-shadow:
                0 0 28px rgba(245, 191, 110, 0.2),
                inset 0 1px 0 rgba(255,255,255,0.55);
            transition: left 450ms cubic-bezier(.22,.8,.18,1);
        }

        .car::before {
            content: "";
            position: absolute;
            inset: 8px 20px 20px 20px;
            border-radius: 14px 16px 10px 10px;
            background: linear-gradient(180deg, rgba(217, 245, 255, 0.95), rgba(112, 198, 214, 0.42));
        }

        .car::after {
            content: "";
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: -10px;
            height: 14px;
            background:
                radial-gradient(circle at 10px 7px, #172228 0 7px, transparent 8px),
                radial-gradient(circle at calc(100% - 10px) 7px, #172228 0 7px, transparent 8px);
        }

        .combo-preview {
            padding: 16px 18px;
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(0, 0, 0, 0.2);
        }

        .preview-label {
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 0.72rem;
        }

        .preview-keys {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            min-height: 54px;
        }

        .ghost {
            color: rgba(255,255,255,0.4);
            font-style: italic;
            align-self: center;
        }

        .mini-key,
        .key {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 52px;
            padding: 11px 14px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.15);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.22), rgba(255,255,255,0.04)),
                linear-gradient(180deg, rgba(6, 20, 26, 0.92), rgba(5, 14, 18, 0.98));
            box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.25),
                0 10px 18px rgba(0, 0, 0, 0.22);
            color: var(--cream);
            font-family: "SFMono-Regular", "Menlo", "Consolas", monospace;
            font-size: 0.94rem;
            letter-spacing: 0.03em;
        }

        .keybank {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .key {
            min-height: 70px;
            cursor: pointer;
            transition: transform 150ms ease, border-color 150ms ease, box-shadow 150ms ease, background 150ms ease;
            user-select: none;
        }

        .key:hover,
        .key:focus-visible {
            transform: translateY(-2px);
            border-color: rgba(159, 243, 223, 0.45);
            box-shadow:
                inset 0 1px 0 rgba(255,255,255,0.25),
                0 12px 22px rgba(0, 0, 0, 0.32),
                0 0 0 1px rgba(159, 243, 223, 0.18);
            outline: none;
        }

        .key.active {
            background:
                linear-gradient(180deg, rgba(245, 191, 110, 0.34), rgba(245, 191, 110, 0.06)),
                linear-gradient(180deg, rgba(20, 33, 38, 0.96), rgba(7, 16, 21, 0.98));
            border-color: rgba(245, 191, 110, 0.55);
            transform: translateY(2px);
        }

        .controls {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        button {
            border: none;
            cursor: pointer;
            border-radius: 18px;
            padding: 15px 18px;
            font: inherit;
            transition: transform 150ms ease, opacity 150ms ease, background 150ms ease;
        }

        button:hover,
        button:focus-visible {
            transform: translateY(-2px);
            outline: none;
        }

        .primary {
            background: linear-gradient(180deg, #ffdb93 0%, #f6b958 55%, #d97746 100%);
            color: #2b0f05;
            font-weight: 700;
        }

        .secondary {
            background: rgba(255,255,255,0.08);
            color: var(--ink);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .quiet {
            background: rgba(99, 215, 222, 0.12);
            color: var(--teal);
            border: 1px solid rgba(99, 215, 222, 0.16);
        }

        .message {
            padding: 16px 18px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            min-height: 76px;
        }

        .message strong {
            display: block;
            margin-bottom: 6px;
            color: var(--cream);
        }

        .badge-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .badge {
            padding: 16px;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.18);
            border: 1px solid rgba(255,255,255,0.07);
            transition: border-color 150ms ease, transform 150ms ease;
        }

        .badge.unlocked {
            border-color: rgba(159, 243, 223, 0.42);
            transform: translateY(-2px);
            background: linear-gradient(180deg, rgba(159, 243, 223, 0.16), rgba(255,255,255,0.03));
        }

        .badge .badge-title {
            color: var(--cream);
            font-size: 1rem;
        }

        .badge p {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.5;
            font-size: 0.92rem;
        }

        .footer-card {
            padding: 18px 22px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
        }

        a {
            color: var(--teal);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer-note {
            color: var(--muted);
            line-height: 1.6;
            max-width: 62ch;
        }

        @media (max-width: 900px) {
            .layout,
            .hero-grid,
            .meter-row {
                grid-template-columns: 1fr;
            }

            .keybank {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .wrap {
                width: min(100%, calc(100% - 18px));
                margin-top: 10px;
            }

            .hero,
            .panel,
            .footer-card {
                border-radius: 24px;
            }

            .hero,
            .panel {
                padding: 18px;
            }

            .keybank {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .controls,
            .badge-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: clamp(2.5rem, 14vw, 4.1rem);
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="eyebrow">Command-Key Grand Prix</div>
            <h1>Shortcut Speedway</h1>
            <p class="hero-copy">A glossy little driving school for Jon’s old keyboard-shortcut obsession. Build the right combo, launch the mission, and watch your tiny desktop racer surge down the lane while your fingers become less decorative and more useful.</p>
            <div class="hero-grid">
                <div class="hero-card">
                    <strong>12</strong>
                    <span>Shortcut Missions</span>
                </div>
                <div class="hero-card">
                    <strong>4</strong>
                    <span>Arcade Badges</span>
                </div>
                <div class="hero-card">
                    <strong>0 Trackpad Tears</strong>
                    <span>Ideal Outcome</span>
                </div>
            </div>
        </section>

        <div class="layout">
            <section class="panel mission-board">
                <div class="section-label">Current Mission</div>
                <div class="mission-plate">
                    <div class="zone-pill" id="zonePill">Finder Lane</div>
                    <h2 id="missionPrompt">Loading mission…</h2>
                    <p id="missionTip">Shortcut lore incoming.</p>
                </div>

                <div class="meter-row">
                    <div class="meter">
                        <div class="label">Score</div>
                        <span class="value" id="scoreValue">0</span>
                    </div>
                    <div class="meter">
                        <div class="label">Streak</div>
                        <span class="value" id="streakValue">0</span>
                    </div>
                    <div class="meter">
                        <div class="label">Finish</div>
                        <span class="value" id="progressValue">1 / 12</span>
                    </div>
                </div>

                <div class="track">
                    <div class="lane"></div>
                    <div class="car" id="car"></div>
                </div>

                <div class="combo-preview">
                    <div class="preview-label">Your Combo</div>
                    <div class="preview-keys" id="previewKeys">
                        <div class="ghost">Tap keys below to build the shortcut.</div>
                    </div>
                </div>

                <div class="keybank" id="keybank"></div>

                <div class="controls">
                    <button class="primary" id="launchButton">Launch Combo</button>
                    <button class="secondary" id="clearButton">Clear Keys</button>
                    <button class="quiet" id="skipButton">Skip Mission</button>
                </div>

                <div class="message" id="messageBox">
                    <strong>Welcome to the lane.</strong>
                    Build the right shortcut and hit launch. You are allowed to look extremely pleased with yourself when it works.
                </div>
            </section>

            <section class="panel mission-board">
                <div class="section-label">Garage Badges</div>
                <div class="badge-grid" id="badgeGrid">
                    <div class="badge" data-badge="firstWin">
                        <div class="badge-title">First Clean Launch</div>
                        <p>Stick the landing once. Civilization begins here.</p>
                    </div>
                    <div class="badge" data-badge="streak3">
                        <div class="badge-title">Three in a Row</div>
                        <p>Build a proper rhythm instead of improvising with panic.</p>
                    </div>
                    <div class="badge" data-badge="screensMaster">
                        <div class="badge-title">Screen Sniper</div>
                        <p>Clear both screenshot missions and earn bragging rights.</p>
                    </div>
                    <div class="badge" data-badge="perfectRun">
                        <div class="badge-title">Pit Crew Saint</div>
                        <p>Finish the whole runway with at least 10 correct launches.</p>
                    </div>
                </div>

                <div class="section-label">How It Works</div>
                <div class="mission-plate">
                    <p>Every mission shows a desktop action. Tap the glossy keys you think make it happen. The game compares your combo in tidy Mac order, so <span class="mini-key">Command</span> plus <span class="mini-key">Shift</span> plus <span class="mini-key">4</span> still counts even if your fingers arrived with a bit of theatrical flourish.</p>
                </div>

                <div class="section-label">Shortcut Lore</div>
                <div class="mission-plate">
                    <p>Keyboard shortcuts are one of those tiny quality-of-life upgrades that make a computer feel less like a menu forest and more like an instrument. Also they are delightfully smug once they become muscle memory, which feels on brand.</p>
                </div>
            </section>
        </div>

        <footer class="footer-card">
            <div class="footer-note">Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>"><?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>. This page turns a simple old link post into a tiny shortcut racetrack because sometimes the web should be useful and a little ridiculous at the same time.</div>
            <a href="index.php">Back to Chloe Reads Jon</a>
        </footer>
    </div>

    <script>
        const challenges = <?= json_encode($challenges, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const keyOrder = ['Command', 'Shift', 'Option', 'Control', 'Tab', 'Space', 'A', 'H', 'N', 'Q', 'S', 'T', 'V', 'W', 'Z', '3', '4'];
        const poolByZone = {
            'Finder': ['Command', 'Shift', 'Option', 'H', 'N', 'W', 'Q', 'Tab'],
            'Editing': ['Command', 'Shift', 'A', 'Z', 'V', 'S', 'H', 'Tab'],
            'Screenshots': ['Command', 'Shift', 'Option', '3', '4', 'S', 'T', 'H'],
            'Browsing': ['Command', 'Shift', 'T', 'W', 'N', 'Tab', 'Option', 'Q'],
            'System': ['Command', 'Shift', 'Tab', 'Q', 'H', 'Space', 'Option', 'Control'],
            'Writing': ['Command', 'Shift', 'S', 'A', 'V', 'Z', 'Tab', 'Option']
        };

        const state = {
            index: 0,
            score: 0,
            streak: 0,
            bestStreak: 0,
            chosen: [],
            badges: {
                firstWin: false,
                streak3: false,
                screensMaster: false,
                perfectRun: false
            },
            screensCleared: 0
        };

        const zonePill = document.getElementById('zonePill');
        const missionPrompt = document.getElementById('missionPrompt');
        const missionTip = document.getElementById('missionTip');
        const scoreValue = document.getElementById('scoreValue');
        const streakValue = document.getElementById('streakValue');
        const progressValue = document.getElementById('progressValue');
        const previewKeys = document.getElementById('previewKeys');
        const keybank = document.getElementById('keybank');
        const messageBox = document.getElementById('messageBox');
        const car = document.getElementById('car');

        function formatCombo(keys) {
            return [...keys]
                .sort((a, b) => keyOrder.indexOf(a) - keyOrder.indexOf(b))
                .join('+');
        }

        function setMessage(title, body) {
            messageBox.innerHTML = `<strong>${title}</strong>${body}`;
        }

        function renderPreview() {
            previewKeys.innerHTML = '';
            if (!state.chosen.length) {
                const ghost = document.createElement('div');
                ghost.className = 'ghost';
                ghost.textContent = 'Tap keys below to build the shortcut.';
                previewKeys.appendChild(ghost);
                return;
            }

            [...state.chosen]
                .sort((a, b) => keyOrder.indexOf(a) - keyOrder.indexOf(b))
                .forEach((key) => {
                    const node = document.createElement('div');
                    node.className = 'mini-key';
                    node.textContent = key;
                    previewKeys.appendChild(node);
                });
        }

        function updateMeters() {
            scoreValue.textContent = state.score;
            streakValue.textContent = state.streak;
            progressValue.textContent = `${Math.min(state.index + 1, challenges.length)} / ${challenges.length}`;
            const percent = challenges.length > 1 ? (state.index / (challenges.length - 1)) * 100 : 100;
            car.style.left = `clamp(22px, calc(${percent}% - 24px), calc(100% - 144px))`;
        }

        function renderBadges() {
            document.querySelectorAll('.badge').forEach((badge) => {
                const key = badge.dataset.badge;
                badge.classList.toggle('unlocked', Boolean(state.badges[key]));
            });
        }

        function renderKeybank() {
            keybank.innerHTML = '';
            const challenge = challenges[state.index];
            const pool = poolByZone[challenge.zone] || [];
            const unique = Array.from(new Set([...challenge.combo, ...pool]));
            unique.sort((a, b) => keyOrder.indexOf(a) - keyOrder.indexOf(b));

            unique.forEach((key) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'key';
                button.textContent = key;
                button.classList.toggle('active', state.chosen.includes(key));
                button.addEventListener('click', () => toggleKey(key));
                keybank.appendChild(button);
            });
        }

        function renderMission() {
            const challenge = challenges[state.index];
            zonePill.textContent = `${challenge.zone} Lane`;
            missionPrompt.textContent = challenge.prompt;
            missionTip.textContent = challenge.tip;
            state.chosen = [];
            renderPreview();
            renderKeybank();
            updateMeters();
        }

        function toggleKey(key) {
            if (state.chosen.includes(key)) {
                state.chosen = state.chosen.filter((item) => item !== key);
            } else {
                state.chosen = [...state.chosen, key];
            }
            renderPreview();
            renderKeybank();
        }

        function unlockBadge(name) {
            if (!state.badges[name]) {
                state.badges[name] = true;
                renderBadges();
            }
        }

        function finishIfNeeded() {
            if (state.index < challenges.length) {
                return false;
            }

            if (state.score >= 10) {
                unlockBadge('perfectRun');
            }

            missionPrompt.textContent = 'Finish line crossed.';
            missionTip.textContent = state.score >= 10
                ? 'That was proper keyboard wizardry. The pit crew is weeping with pride.'
                : 'Respectable work. A rematch would almost certainly make you more dangerous.';
            zonePill.textContent = 'Arcade Complete';
            keybank.innerHTML = '';
            previewKeys.innerHTML = `<div class="ghost">Final score: ${state.score} correct launches.</div>`;
            progressValue.textContent = `${challenges.length} / ${challenges.length}`;
            car.style.left = 'calc(100% - 144px)';
            setMessage(
                'Run complete.',
                state.score >= 10
                    ? 'You finished with a gleaming pit-crew reputation. Screenshot buttons everywhere are trembling.'
                    : 'You made it to the end, learned a few combos, and did not once need a dramatic keyboard flip.'
            );
            return true;
        }

        function advanceMission() {
            state.index += 1;
            if (!finishIfNeeded()) {
                renderMission();
            }
        }

        function launchCombo() {
            const challenge = challenges[state.index];
            const chosen = formatCombo(state.chosen);
            const correct = formatCombo(challenge.combo);

            if (!state.chosen.length) {
                setMessage('Empty cockpit.', 'No keys selected yet. Even the fanciest race car still needs a driver.');
                return;
            }

            if (chosen === correct) {
                state.score += 1;
                state.streak += 1;
                state.bestStreak = Math.max(state.bestStreak, state.streak);

                unlockBadge('firstWin');
                if (state.streak >= 3) {
                    unlockBadge('streak3');
                }
                if (challenge.zone === 'Screenshots') {
                    state.screensCleared += 1;
                    if (state.screensCleared >= 2) {
                        unlockBadge('screensMaster');
                    }
                }

                setMessage(
                    'Clean launch.',
                    `You nailed <span class="mini-key">${correct.replaceAll('+', '</span> <span class="mini-key">')}</span>. ${challenge.tip}`
                );
                advanceMission();
                return;
            }

            state.streak = 0;
            setMessage(
                'Bumped the guardrail.',
                `You tried <span class="mini-key">${chosen.replaceAll('+', '</span> <span class="mini-key">')}</span>, but this mission wanted <span class="mini-key">${correct.replaceAll('+', '</span> <span class="mini-key">')}</span>.`
            );
            renderMission();
        }

        document.getElementById('launchButton').addEventListener('click', launchCombo);
        document.getElementById('clearButton').addEventListener('click', () => {
            state.chosen = [];
            renderPreview();
            renderKeybank();
            setMessage('Keys cleared.', 'Fresh hands, fresh attempt, slightly less melodrama.');
        });
        document.getElementById('skipButton').addEventListener('click', () => {
            const challenge = challenges[state.index];
            setMessage(
                'Mission skipped.',
                `The answer was <span class="mini-key">${formatCombo(challenge.combo).replaceAll('+', '</span> <span class="mini-key">')}</span>. Even race legends occasionally wave the car into the pit lane.`
            );
            state.streak = 0;
            advanceMission();
        });

        renderBadges();
        renderMission();
    </script>
</body>
</html>
