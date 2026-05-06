<?php
$apps = [
    [
        'name' => 'Cursor',
        'category' => 'Code',
        'weight' => 'Heavy',
        'ram' => 3000,
        'speed' => 5,
        'focus' => 7,
        'delight' => 8,
        'battery' => 3,
        'color' => '#ff8e72',
        'emoji' => '🧠',
        'blurb' => 'AI-heavy editor with a lot going on under the hood.',
        'swap' => 'Try Zed when you want something lighter and faster.'
    ],
    [
        'name' => 'Zed',
        'category' => 'Code',
        'weight' => 'Light',
        'ram' => 900,
        'speed' => 9,
        'focus' => 8,
        'delight' => 7,
        'battery' => 8,
        'color' => '#7af0d2',
        'emoji' => '⚡',
        'blurb' => 'Fast, Rust-built editor with a clean feel.',
        'swap' => 'This is already the leaner pick.'
    ],
    [
        'name' => 'iTerm2',
        'category' => 'Terminal',
        'weight' => 'Heavy',
        'ram' => 1400,
        'speed' => 6,
        'focus' => 8,
        'delight' => 7,
        'battery' => 4,
        'color' => '#f5b14c',
        'emoji' => '💻',
        'blurb' => 'Feature-rich terminal with plenty of comfort features.',
        'swap' => 'Swap to Alacritty plus tmux for a leaner cockpit.'
    ],
    [
        'name' => 'Alacritty + tmux',
        'category' => 'Terminal',
        'weight' => 'Light',
        'ram' => 380,
        'speed' => 10,
        'focus' => 9,
        'delight' => 8,
        'battery' => 9,
        'color' => '#a4ff6b',
        'emoji' => '🟩',
        'blurb' => 'A speedy terminal cockpit with keyboard-first superpowers.',
        'swap' => 'Already running on distilled rocket fuel.'
    ],
    [
        'name' => 'Edge',
        'category' => 'Browser',
        'weight' => 'Heavy',
        'ram' => 2200,
        'speed' => 6,
        'focus' => 6,
        'delight' => 7,
        'battery' => 4,
        'color' => '#69b7ff',
        'emoji' => '🌐',
        'blurb' => 'Fast and feature-rich, but not exactly on a memory diet.',
        'swap' => 'Consider Orion if you want a lighter profile-driven browser.'
    ],
    [
        'name' => 'Arc',
        'category' => 'Browser',
        'weight' => 'Heavy',
        'ram' => 2600,
        'speed' => 5,
        'focus' => 7,
        'delight' => 9,
        'battery' => 3,
        'color' => '#d29cff',
        'emoji' => '🪐',
        'blurb' => 'Stylish and clever, though it likes snacking on RAM.',
        'swap' => 'Use Orion when you want the vibes without the bulk.'
    ],
    [
        'name' => 'Orion',
        'category' => 'Browser',
        'weight' => 'Light',
        'ram' => 850,
        'speed' => 8,
        'focus' => 8,
        'delight' => 9,
        'battery' => 8,
        'color' => '#9ac6ff',
        'emoji' => '🛰️',
        'blurb' => 'A lighter WebKit browser with profile charm and vertical tabs.',
        'swap' => 'Already a graceful cut from the browser buffet.'
    ],
    [
        'name' => 'Obsidian',
        'category' => 'Notes',
        'weight' => 'Medium',
        'ram' => 650,
        'speed' => 7,
        'focus' => 8,
        'delight' => 9,
        'battery' => 6,
        'color' => '#cdb2ff',
        'emoji' => '📚',
        'blurb' => 'A note graph that invites rabbit holes in the best way.',
        'swap' => 'Keep it if your brain likes backlinks more than austerity.'
    ],
    [
        'name' => 'Drafts',
        'category' => 'Notes',
        'weight' => 'Light',
        'ram' => 180,
        'speed' => 10,
        'focus' => 9,
        'delight' => 8,
        'battery' => 10,
        'color' => '#fff176',
        'emoji' => '✍️',
        'blurb' => 'Quick capture with no faffing about. Bless it.',
        'swap' => 'About as lean as an idea-catcher gets.'
    ],
    [
        'name' => 'Todoist',
        'category' => 'Planning',
        'weight' => 'Light',
        'ram' => 240,
        'speed' => 9,
        'focus' => 8,
        'delight' => 7,
        'battery' => 9,
        'color' => '#ff7b72',
        'emoji' => '✅',
        'blurb' => 'A tidy list-maker that does not insist on becoming your religion.',
        'swap' => 'Already a sensible choice.'
    ],
    [
        'name' => 'Raycast',
        'category' => 'Launcher',
        'weight' => 'Medium',
        'ram' => 500,
        'speed' => 9,
        'focus' => 8,
        'delight' => 9,
        'battery' => 7,
        'color' => '#ffcf70',
        'emoji' => '🚀',
        'blurb' => 'Launcher, snippets, scripts, and tiny spells in one bar.',
        'swap' => 'Worth the overhead if it saves a hundred tiny motions.'
    ],
    [
        'name' => 'SimpleLogin',
        'category' => 'Privacy',
        'weight' => 'Light',
        'ram' => 120,
        'speed' => 8,
        'focus' => 8,
        'delight' => 8,
        'battery' => 10,
        'color' => '#8cf0ff',
        'emoji' => '🛡️',
        'blurb' => 'Email aliasing for the privacy-minded and spam-weary.',
        'swap' => 'Keep. Tiny footprint, big peace of mind.'
    ],
    [
        'name' => 'ChatGPT',
        'category' => 'AI',
        'weight' => 'Medium',
        'ram' => 700,
        'speed' => 8,
        'focus' => 7,
        'delight' => 9,
        'battery' => 6,
        'color' => '#8ef2c5',
        'emoji' => '💬',
        'blurb' => 'A helpful co-pilot when you want ideas, code, or perspective.',
        'swap' => 'Keep for leverage, but maybe do not open nine AI tabs at once.'
    ],
    [
        'name' => 'Perplexity',
        'category' => 'Research',
        'weight' => 'Light',
        'ram' => 300,
        'speed' => 9,
        'focus' => 8,
        'delight' => 7,
        'battery' => 9,
        'color' => '#77f1ff',
        'emoji' => '🔎',
        'blurb' => 'Quick answer engine with a fondness for citations.',
        'swap' => 'Neat and efficient. Hard to scold.'
    ],
    [
        'name' => 'Amazon Q CLI',
        'category' => 'AI',
        'weight' => 'Medium',
        'ram' => 420,
        'speed' => 8,
        'focus' => 8,
        'delight' => 7,
        'battery' => 8,
        'color' => '#9ec5ff',
        'emoji' => '⌘',
        'blurb' => 'Command-line AI for PRs, tickets, and the occasional lawn-watering detective work.',
        'swap' => 'Low enough overhead to justify the wizardry.'
    ],
    [
        'name' => 'Stats',
        'category' => 'Monitoring',
        'weight' => 'Light',
        'ram' => 110,
        'speed' => 10,
        'focus' => 8,
        'delight' => 8,
        'battery' => 9,
        'color' => '#c7ff88',
        'emoji' => '📈',
        'blurb' => 'Live system metrics for the politely suspicious.',
        'swap' => 'A tiny hall monitor. Let it stay.'
    ],
    [
        'name' => 'LazyGit',
        'category' => 'Git',
        'weight' => 'Light',
        'ram' => 90,
        'speed' => 9,
        'focus' => 8,
        'delight' => 8,
        'battery' => 10,
        'color' => '#ffb86c',
        'emoji' => '🌿',
        'blurb' => 'Git made tactile and pleasantly less annoying.',
        'swap' => 'Minimal fuss, maximal usefulness.'
    ],
    [
        'name' => '1 Second Everyday',
        'category' => 'Memory',
        'weight' => 'Light',
        'ram' => 260,
        'speed' => 8,
        'focus' => 7,
        'delight' => 10,
        'battery' => 8,
        'color' => '#ffd98b',
        'emoji' => '🎞️',
        'blurb' => 'Daily moments stitched into a tiny time machine.',
        'swap' => 'It earns its place by making memory tangible.'
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Diet Studio</title>
    <style>
        :root {
            --bg: #0d1117;
            --panel: rgba(13, 18, 27, 0.76);
            --panel-strong: rgba(10, 13, 20, 0.92);
            --line: rgba(255, 255, 255, 0.1);
            --text: #f4f1ea;
            --muted: #aeb8c8;
            --gold: #f3c86a;
            --mint: #7af0d2;
            --danger: #ff8e72;
            --shadow: 0 24px 60px rgba(0, 0, 0, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Avenir Next", "Trebuchet MS", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(84, 130, 255, 0.28), transparent 34%),
                radial-gradient(circle at top right, rgba(255, 177, 76, 0.18), transparent 28%),
                radial-gradient(circle at bottom, rgba(122, 240, 210, 0.16), transparent 28%),
                linear-gradient(180deg, #131924 0%, #090c12 58%, #05070b 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(circle at center, black 45%, transparent 100%);
            opacity: 0.45;
        }

        .wrap {
            width: min(1200px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 40px;
        }

        .hero {
            position: relative;
            padding: 28px;
            border: 1px solid var(--line);
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(19, 25, 36, 0.92), rgba(8, 10, 16, 0.82));
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -10% -30% 40%;
            height: 340px;
            background: radial-gradient(circle, rgba(122,240,210,0.25), transparent 62%);
            filter: blur(16px);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.75rem;
            margin-bottom: 16px;
        }

        h1 {
            margin: 0;
            max-width: 10ch;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: clamp(2.8rem, 7vw, 5.8rem);
            line-height: 0.92;
            letter-spacing: -0.05em;
        }

        .subtitle {
            max-width: 58rem;
            margin: 18px 0 0;
            color: var(--muted);
            font-size: 1.08rem;
            line-height: 1.7;
        }

        .hero-grid {
            display: grid;
            gap: 22px;
            margin-top: 28px;
        }

        .hero-notes {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .note {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(14px);
        }

        .note strong {
            display: block;
            margin-bottom: 6px;
            color: var(--text);
            font-size: 0.95rem;
        }

        .note span {
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.92rem;
        }

        .workspace {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 22px;
            margin-top: 24px;
        }

        .panel {
            border: 1px solid var(--line);
            background: var(--panel);
            border-radius: 26px;
            padding: 22px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .panel h2, .panel h3 {
            margin: 0;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            letter-spacing: -0.02em;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 18px;
        }

        .panel-header p {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button {
            appearance: none;
            border: 0;
            cursor: pointer;
            border-radius: 999px;
            padding: 11px 16px;
            font: inherit;
            font-weight: 700;
            color: #081018;
            background: linear-gradient(135deg, #f3c86a, #ffd98b);
            box-shadow: 0 8px 24px rgba(243, 200, 106, 0.22);
            transition: transform 180ms ease, box-shadow 180ms ease, opacity 180ms ease;
        }

        button.secondary {
            color: var(--text);
            background: rgba(255,255,255,0.08);
            box-shadow: none;
            border: 1px solid rgba(255,255,255,0.08);
        }

        button:hover { transform: translateY(-2px); }
        button:active { transform: translateY(0); }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 14px;
        }

        .card {
            position: relative;
            overflow: hidden;
            padding: 16px;
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
        }

        .card:hover {
            transform: translateY(-4px);
            border-color: rgba(255,255,255,0.18);
            box-shadow: 0 20px 35px rgba(0,0,0,0.28);
        }

        .card.active {
            border-color: var(--card-color, rgba(255,255,255,0.4));
            box-shadow: 0 0 0 2px color-mix(in srgb, var(--card-color, #fff) 45%, transparent), 0 22px 40px rgba(0,0,0,0.34);
            transform: translateY(-4px);
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, color-mix(in srgb, var(--card-color, #fff) 28%, transparent), transparent 45%);
            pointer-events: none;
        }

        .tag-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .tag, .mini-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.07);
            color: var(--text);
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .mini-tag { font-size: 0.7rem; color: var(--muted); }

        .card h3 {
            font-size: 1.28rem;
            margin-bottom: 8px;
        }

        .card p {
            margin: 0 0 16px;
            color: var(--muted);
            font-size: 0.94rem;
            line-height: 1.55;
        }

        .statline {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            font-size: 0.84rem;
            color: var(--muted);
        }

        .stack-shell {
            position: sticky;
            top: 18px;
        }

        .stack-slots {
            display: grid;
            gap: 12px;
            margin-bottom: 18px;
        }

        .slot {
            min-height: 78px;
            padding: 14px;
            border-radius: 20px;
            border: 1px dashed rgba(255,255,255,0.14);
            background: rgba(255,255,255,0.03);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .slot.filled {
            border-style: solid;
            background: rgba(255,255,255,0.06);
        }

        .slot-emoji {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 1.35rem;
            background: rgba(255,255,255,0.08);
            flex: 0 0 auto;
        }

        .slot-title {
            font-weight: 700;
            margin-bottom: 4px;
        }

        .slot-sub {
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.45;
        }

        .slot button {
            margin-left: auto;
            padding: 8px 10px;
            font-size: 0.8rem;
        }

        .meters {
            display: grid;
            gap: 12px;
            margin-bottom: 18px;
        }

        .meter {
            display: grid;
            gap: 6px;
        }

        .meter header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.86rem;
            color: var(--muted);
        }

        .bar {
            height: 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            overflow: hidden;
        }

        .bar span {
            display: block;
            height: 100%;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, #7af0d2, #f3c86a, #ff8e72);
            transition: width 260ms ease;
        }

        .summary {
            padding: 18px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .summary p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .summary strong { color: var(--text); }

        .scenario-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .scenario {
            padding: 16px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
        }

        .scenario.active {
            border-color: rgba(243, 200, 106, 0.5);
            background: rgba(243, 200, 106, 0.08);
        }

        .scenario h4 {
            margin: 0 0 8px;
            font-size: 1rem;
        }

        .scenario p {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.9rem;
        }

        .profile-strip {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .profile-pill {
            padding: 10px 12px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.05);
            min-width: 130px;
        }

        .profile-pill strong {
            display: block;
            margin-bottom: 4px;
        }

        .profile-pill span {
            color: var(--muted);
            font-size: 0.86rem;
        }

        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
        }

        .legend .mini-tag { background: rgba(255,255,255,0.05); }

        a {
            color: #a8d4ff;
        }

        .footer-note {
            margin-top: 22px;
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .hero-notes, .workspace { grid-template-columns: 1fr; }
            .stack-shell { position: static; }
            h1 { max-width: 100%; }
        }

        @media (max-width: 640px) {
            .wrap { width: min(100% - 18px, 1200px); padding-top: 18px; }
            .hero, .panel { padding: 18px; border-radius: 22px; }
            .cards { grid-template-columns: 1fr; }
            .panel-header { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="eyebrow">Memory Diet Studio • interactive desk tuner</div>
            <h1>Build the leanest joyful setup.</h1>
            <p class="subtitle">Jon wrote about switching from heavier apps to lighter ones like Zed, Alacritty + tmux, and Orion. So I made a neon-glass little laboratory where you can assemble a dream desk, watch the memory footprint rise and fall, and see whether your stack is a featherweight monk or a glorious RAM goblin.</p>
            <div class="hero-grid">
                <div class="hero-notes">
                    <div class="note">
                        <strong>Pick five tools</strong>
                        <span>Tap cards to add them to your desk. Balance performance, focus, delight, and battery without turning your workflow into boiled cabbage.</span>
                    </div>
                    <div class="note">
                        <strong>Try scenarios</strong>
                        <span>Travel light, writing retreat, on-call cockpit, or cozy weekend tinkering. Each mode nudges the ideal mix in a different direction.</span>
                    </div>
                    <div class="note">
                        <strong>Profile fantasy</strong>
                        <span>The browser strip tips its hat to Orion's profile charm and vertical-tab energy, because of course it does.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="workspace">
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <h2>App pantry</h2>
                        <p>Each card carries a memory cost and a vibe. Some are lightweight saints. Some are beautiful little hooligans.</p>
                    </div>
                    <div class="button-row">
                        <button type="button" id="randomize">Surprise me</button>
                        <button type="button" class="secondary" id="lighten">Put it on a diet</button>
                        <button type="button" class="secondary" id="reset">Clear desk</button>
                    </div>
                </div>
                <div class="cards" id="cardGrid"></div>
            </div>

            <aside class="panel stack-shell">
                <div class="panel-header">
                    <div>
                        <h2>Current desk</h2>
                        <p>Five slots. No mercy. Choose what truly earns a place.</p>
                    </div>
                </div>

                <div class="stack-slots" id="slots"></div>

                <div class="meters">
                    <div class="meter">
                        <header><span>Memory footprint</span><strong id="ramLabel">0 MB</strong></header>
                        <div class="bar"><span id="ramBar"></span></div>
                    </div>
                    <div class="meter">
                        <header><span>Speed</span><strong id="speedLabel">0 / 10</strong></header>
                        <div class="bar"><span id="speedBar"></span></div>
                    </div>
                    <div class="meter">
                        <header><span>Focus</span><strong id="focusLabel">0 / 10</strong></header>
                        <div class="bar"><span id="focusBar"></span></div>
                    </div>
                    <div class="meter">
                        <header><span>Battery grace</span><strong id="batteryLabel">0 / 10</strong></header>
                        <div class="bar"><span id="batteryBar"></span></div>
                    </div>
                    <div class="meter">
                        <header><span>Joy per megabyte</span><strong id="joyLabel">0</strong></header>
                        <div class="bar"><span id="joyBar"></span></div>
                    </div>
                </div>

                <div class="summary">
                    <p id="summaryText"><strong>Awaiting desktop drama.</strong> Add a few tools and I'll judge the whole setup with the appropriate amount of affection.</p>
                </div>

                <div class="scenario-grid" id="scenarios"></div>

                <div class="profile-strip">
                    <div class="profile-pill">
                        <strong>Work profile</strong>
                        <span>PRs, tabs, and just enough suspicion.</span>
                    </div>
                    <div class="profile-pill">
                        <strong>Personal profile</strong>
                        <span>Notes, reading, and side quests.</span>
                    </div>
                    <div class="profile-pill">
                        <strong>Deep focus</strong>
                        <span>One window. No nonsense. Mildly monastic.</span>
                    </div>
                </div>

                <div class="legend">
                    <span class="mini-tag">Target: under 6000 MB for featherweight mode</span>
                    <span class="mini-tag">Tap a filled slot to remove it</span>
                    <span class="mini-tag">Best viewed with a cup of tea and opinions</span>
                </div>

                <p class="footer-note">Inspired by Jon's blog post about switching to lighter apps and enjoying the Orion browser.</p>
            </aside>
        </section>
    </div>

    <script>
        const apps = <?php echo json_encode($apps, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        const scenarios = [
            {
                id: 'travel',
                title: 'Travel light',
                description: 'Aim for under 4500 MB and keep battery grace high. Imagine airport lounge, one outlet, no patience.',
                hint: 'Lighter browser, lighter editor, tiny utilities.'
            },
            {
                id: 'writing',
                title: 'Writing retreat',
                description: 'Prioritize focus and delight. The machine should vanish and let words have the stage.',
                hint: 'Notes, calm browser, maybe one AI sidekick.'
            },
            {
                id: 'oncall',
                title: 'On-call cockpit',
                description: 'Speed matters more than purity. Build a setup that can investigate, search, compare, and recover fast.',
                hint: 'Terminal, research, monitoring, maybe AI help.'
            },
            {
                id: 'weekend',
                title: 'Weekend tinkering',
                description: 'A little whimsy is allowed. You still want responsiveness, but joy gets extra voting rights.',
                hint: 'Pick tools that make you want to poke around.'
            }
        ];

        const selection = [];
        let activeScenario = scenarios[0].id;

        const cardGrid = document.getElementById('cardGrid');
        const slotsEl = document.getElementById('slots');
        const summaryText = document.getElementById('summaryText');
        const scenariosEl = document.getElementById('scenarios');

        const meterEls = {
            ram: { bar: document.getElementById('ramBar'), label: document.getElementById('ramLabel') },
            speed: { bar: document.getElementById('speedBar'), label: document.getElementById('speedLabel') },
            focus: { bar: document.getElementById('focusBar'), label: document.getElementById('focusLabel') },
            battery: { bar: document.getElementById('batteryBar'), label: document.getElementById('batteryLabel') },
            joy: { bar: document.getElementById('joyBar'), label: document.getElementById('joyLabel') },
        };

        function appByName(name) {
            return apps.find(app => app.name === name);
        }

        function toggleApp(name) {
            const index = selection.indexOf(name);
            if (index >= 0) {
                selection.splice(index, 1);
            } else if (selection.length < 5) {
                selection.push(name);
            } else {
                const heaviestIndex = selection
                    .map((appName, i) => ({ app: appByName(appName), i }))
                    .sort((a, b) => b.app.ram - a.app.ram)[0].i;
                selection.splice(heaviestIndex, 1, name);
            }
            render();
        }

        function clearSelection() {
            selection.splice(0, selection.length);
            render();
        }

        function randomizeSelection() {
            const copy = [...apps].sort(() => Math.random() - 0.5);
            selection.splice(0, selection.length, ...copy.slice(0, 5).map(app => app.name));
            render();
        }

        function lightenSelection() {
            const current = selection.map(appByName);
            const nextNames = [];
            const categories = new Set();

            current.forEach(app => {
                if (!app) return;
                const candidates = apps.filter(candidate => candidate.category === app.category).sort((a, b) => a.ram - b.ram || b.speed - a.speed);
                nextNames.push(candidates[0].name);
                categories.add(app.category);
            });

            if (nextNames.length < 5) {
                const additions = apps
                    .filter(app => !categories.has(app.category))
                    .sort((a, b) => a.ram - b.ram || b.focus - a.focus);
                additions.forEach(app => {
                    if (nextNames.length < 5) {
                        nextNames.push(app.name);
                        categories.add(app.category);
                    }
                });
            }

            selection.splice(0, selection.length, ...Array.from(new Set(nextNames)).slice(0, 5));
            render();
        }

        function scenarioBias(summary) {
            if (activeScenario === 'travel') {
                return summary.ram < 4500 && summary.battery >= 8 ? 'Travel-approved. Slim, efficient, and not desperately hunting for a charger.' : 'A bit rich for travel. This bag is starting to clink like you packed anvils.';
            }
            if (activeScenario === 'writing') {
                return summary.focus >= 8 && summary.delight >= 8 ? 'Lovely writing setup. Quiet enough for thought, pleasant enough to linger.' : 'This could use fewer distractions and a touch more serenity.';
            }
            if (activeScenario === 'oncall') {
                return summary.speed >= 8 && summary.focus >= 7 ? 'Ready for incident duty. Fast hands, clear screen, fewer panicked clicks.' : 'Functional, but I would not call it battle-station sharp yet.';
            }
            return summary.delight >= 8 ? 'Weekend-ready. A stack that invites tinkering instead of chores.' : 'Serviceable, but the weekend deserves a bit more sparkle.';
        }

        function summarize() {
            const chosen = selection.map(appByName).filter(Boolean);
            const count = chosen.length || 1;
            const totalRam = chosen.reduce((sum, app) => sum + app.ram, 0);
            const speed = chosen.reduce((sum, app) => sum + app.speed, 0) / count;
            const focus = chosen.reduce((sum, app) => sum + app.focus, 0) / count;
            const delight = chosen.reduce((sum, app) => sum + app.delight, 0) / count;
            const battery = chosen.reduce((sum, app) => sum + app.battery, 0) / count;
            const joy = totalRam ? Math.round((delight * 1000) / totalRam * 10) / 10 : 0;
            return { count: chosen.length, ram: totalRam, speed, focus, delight, battery, joy, chosen };
        }

        function tone(summary) {
            if (summary.count === 0) {
                return '<strong>Awaiting desktop drama.</strong> Add a few tools and I\'ll judge the whole setup with the appropriate amount of affection.';
            }
            const weights = summary.chosen.reduce((map, app) => {
                map[app.weight] = (map[app.weight] || 0) + 1;
                return map;
            }, {});
            let mood = 'balanced creature';
            if ((weights.Light || 0) >= 4) mood = 'featherweight monk';
            else if ((weights.Heavy || 0) >= 3) mood = 'glorious RAM goblin';
            else if (summary.delight >= 8.5) mood = 'joy-maximalist craft desk';

            const biggest = [...summary.chosen].sort((a, b) => b.ram - a.ram)[0];
            const leanest = [...summary.chosen].sort((a, b) => a.ram - b.ram)[0];
            return `<strong>${mood.charAt(0).toUpperCase() + mood.slice(1)}.</strong> ${scenarioBias(summary)} Biggest footprint: <strong>${biggest.name}</strong>. Most nimble: <strong>${leanest.name}</strong>. Suggested nudge: ${biggest.swap}`;
        }

        function renderCards() {
            cardGrid.innerHTML = apps.map(app => {
                const active = selection.includes(app.name) ? 'active' : '';
                return `
                    <article class="card ${active}" data-name="${app.name}" style="--card-color:${app.color}">
                        <div class="tag-row">
                            <span class="tag">${app.emoji} ${app.category}</span>
                            <span class="mini-tag">${app.weight}</span>
                        </div>
                        <h3>${app.name}</h3>
                        <p>${app.blurb}</p>
                        <div class="statline">
                            <span>RAM: ${app.ram} MB</span>
                            <span>Speed: ${app.speed}/10</span>
                            <span>Focus: ${app.focus}/10</span>
                            <span>Battery: ${app.battery}/10</span>
                        </div>
                    </article>
                `;
            }).join('');

            cardGrid.querySelectorAll('.card').forEach(card => {
                card.addEventListener('click', () => toggleApp(card.dataset.name));
            });
        }

        function renderSlots(summary) {
            slotsEl.innerHTML = Array.from({ length: 5 }, (_, index) => {
                const app = summary.chosen[index];
                if (!app) {
                    return `
                        <div class="slot">
                            <div class="slot-emoji">＋</div>
                            <div>
                                <div class="slot-title">Empty slot</div>
                                <div class="slot-sub">Choose something worthy from the pantry.</div>
                            </div>
                        </div>
                    `;
                }
                return `
                    <div class="slot filled" style="border-color:${app.color}44">
                        <div class="slot-emoji" style="background:${app.color}22">${app.emoji}</div>
                        <div>
                            <div class="slot-title">${app.name}</div>
                            <div class="slot-sub">${app.category} • ${app.ram} MB • ${app.weight}</div>
                        </div>
                        <button type="button" class="secondary remove" data-name="${app.name}">Remove</button>
                    </div>
                `;
            }).join('');

            slotsEl.querySelectorAll('.remove').forEach(button => {
                button.addEventListener('click', event => {
                    event.stopPropagation();
                    toggleApp(button.dataset.name);
                });
            });
        }

        function renderMeters(summary) {
            meterEls.ram.label.textContent = `${summary.ram} MB`;
            meterEls.ram.bar.style.width = `${Math.min(summary.ram / 80, 100)}%`;

            meterEls.speed.label.textContent = `${summary.speed.toFixed(1)} / 10`;
            meterEls.speed.bar.style.width = `${summary.speed * 10}%`;

            meterEls.focus.label.textContent = `${summary.focus.toFixed(1)} / 10`;
            meterEls.focus.bar.style.width = `${summary.focus * 10}%`;

            meterEls.battery.label.textContent = `${summary.battery.toFixed(1)} / 10`;
            meterEls.battery.bar.style.width = `${summary.battery * 10}%`;

            meterEls.joy.label.textContent = summary.joy.toFixed(1);
            meterEls.joy.bar.style.width = `${Math.min(summary.joy * 10, 100)}%`;
        }

        function renderScenarios() {
            scenariosEl.innerHTML = scenarios.map(scenario => `
                <button type="button" class="scenario ${scenario.id === activeScenario ? 'active' : ''}" data-scenario="${scenario.id}">
                    <h4>${scenario.title}</h4>
                    <p>${scenario.description}</p>
                </button>
            `).join('');

            scenariosEl.querySelectorAll('.scenario').forEach(button => {
                button.addEventListener('click', () => {
                    activeScenario = button.dataset.scenario;
                    render();
                });
            });
        }

        function render() {
            const summary = summarize();
            renderCards();
            renderSlots(summary);
            renderMeters(summary);
            renderScenarios();
            summaryText.innerHTML = tone(summary);
        }

        document.getElementById('reset').addEventListener('click', clearSelection);
        document.getElementById('randomize').addEventListener('click', randomizeSelection);
        document.getElementById('lighten').addEventListener('click', lightenSelection);

        selection.push('Zed', 'Alacritty + tmux', 'Orion', 'Drafts', 'Raycast');
        render();
    </script>
</body>
</html>
