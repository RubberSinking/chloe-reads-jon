<?php
$inspiration = [
    'title' => "Poor Man's Kinesis Keyboard: The K'nexis Keyboard",
    'date' => '2005-05-30',
    'url' => 'https://jona.ca/2005/05/poor-mans-kinesis-keyboard-knexis.html',
];

$profiles = [
    [
        'id' => 'emacs',
        'name' => 'Emacs Pinky Rescue',
        'tagline' => 'Aggressive thumb reassignment for shortcut-heavy editing.',
        'description' => 'Built for people who have opinions about Ctrl, and sadly those opinions have consequences.',
        'uses' => ['ctrl' => 42, 'shift' => 25, 'alt' => 14, 'meta' => 9],
        'split' => 58,
        'stagger' => 16,
        'tent' => 24,
    ],
    [
        'id' => 'terminal',
        'name' => 'Terminal Cartographer',
        'tagline' => 'A balanced layout for shell hopping and pane wizardry.',
        'description' => 'Good for tmux acrobatics, tab switching, and looking suspiciously competent in a terminal.',
        'uses' => ['ctrl' => 28, 'shift' => 18, 'alt' => 24, 'meta' => 12],
        'split' => 46,
        'stagger' => 11,
        'tent' => 18,
    ],
    [
        'id' => 'dadmode',
        'name' => 'Dad Mode Arcade',
        'tagline' => 'Less pain, more fun, still enough weirdness to delight Nathan.',
        'description' => 'Great for casual browsing, game launchers, and narrating the brilliance of your improvised hardware.',
        'uses' => ['ctrl' => 18, 'shift' => 14, 'alt' => 16, 'meta' => 8],
        'split' => 62,
        'stagger' => 9,
        'tent' => 20,
    ],
];

$shortcuts = [
    ['label' => 'Copy', 'combo' => ['ctrl', 'C'], 'story' => 'Still the emperor of muscle memory.'],
    ['label' => 'Command Palette', 'combo' => ['ctrl', 'shift', 'P'], 'story' => 'A civilized shortcut for opening mysterious powers.'],
    ['label' => 'Switch App', 'combo' => ['alt', 'Tab'], 'story' => 'For when twelve windows seem emotionally necessary.'],
    ['label' => 'Comment Line', 'combo' => ['ctrl', '/'], 'story' => 'A tiny broom for code.'],
    ['label' => 'Close Pane', 'combo' => ['ctrl', 'W'], 'story' => 'Useful and a little dramatic.'],
    ['label' => 'Window Scout', 'combo' => ['meta', 'Arrow'], 'story' => 'For people who keep their windows marching in formation.'],
];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K'nexis Keyboard Lab</title>
    <style>
        :root {
            --paper: #f7f0de;
            --paper-2: #efe2c5;
            --ink: #1d2840;
            --muted: #5f6882;
            --red: #d84a36;
            --yellow: #f3c341;
            --blue: #2d78c9;
            --green: #2f9e72;
            --plum: #6f4ea6;
            --rod-shadow: rgba(35, 35, 45, 0.18);
            --panel: rgba(255, 251, 242, 0.82);
            --line: rgba(38, 54, 88, 0.12);
            --radius: 28px;
            --split: 58px;
            --stagger: 16px;
            --tent: 24deg;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(243, 195, 65, 0.32), transparent 24%),
                radial-gradient(circle at top right, rgba(45, 120, 201, 0.18), transparent 28%),
                linear-gradient(180deg, #f8f1df 0%, #f4e7ca 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(circle at 1px 1px, rgba(41, 58, 94, 0.09) 1px, transparent 0),
                linear-gradient(135deg, rgba(255,255,255,0.28), transparent 60%);
            background-size: 18px 18px, cover;
            opacity: 0.8;
        }

        .page {
            width: min(1200px, calc(100vw - 24px));
            margin: 0 auto;
            padding: 22px 0 44px;
            position: relative;
            z-index: 1;
        }

        .hero,
        .panel,
        .story-card {
            background: var(--panel);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 24px 60px rgba(124, 91, 35, 0.14);
            backdrop-filter: blur(10px);
        }

        .hero {
            border-radius: 34px;
            padding: 28px;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: "BUILD WITH TOY PARTS, SAVE THE PINKIES";
            position: absolute;
            right: 20px;
            top: 18px;
            font: 700 0.74rem/1.1 "Courier New", monospace;
            letter-spacing: 0.16em;
            color: rgba(29, 40, 64, 0.35);
            text-align: right;
            max-width: 22ch;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.12fr 0.88fr;
            gap: 24px;
            align-items: start;
        }

        .eyebrow,
        .metric-label,
        .section-tag,
        .shortcut-story,
        .mini {
            font-family: "Courier New", monospace;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(216, 74, 54, 0.1);
            color: var(--red);
            font-size: 0.8rem;
        }

        h1 {
            font-family: "Rockwell", "Georgia", serif;
            font-size: clamp(2.9rem, 6vw, 5.6rem);
            line-height: 0.92;
            letter-spacing: -0.05em;
            margin: 16px 0 14px;
            max-width: 10ch;
        }

        .lede {
            font-size: 1.08rem;
            line-height: 1.72;
            color: var(--muted);
            max-width: 58ch;
            margin: 0 0 18px;
        }

        .hero-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .hero-links a,
        .action,
        .chip,
        .profile-button {
            text-decoration: none;
            color: inherit;
        }

        .action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 999px;
            cursor: pointer;
            padding: 12px 18px;
            font: 700 0.95rem/1 "Trebuchet MS", "Gill Sans", sans-serif;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .action:hover,
        .profile-button:hover {
            transform: translateY(-2px);
        }

        .action-primary {
            background: linear-gradient(135deg, var(--red), #f06e42);
            color: #fff8ef;
            box-shadow: 0 16px 26px rgba(216, 74, 54, 0.28);
        }

        .action-secondary {
            background: rgba(45, 120, 201, 0.11);
            color: var(--blue);
            border: 1px solid rgba(45, 120, 201, 0.2);
        }

        .stat-rack {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 24px;
        }

        .stat {
            border-radius: 24px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.58);
            border: 1px solid rgba(255,255,255,0.75);
        }

        .stat strong {
            display: block;
            font-size: clamp(2rem, 4vw, 3rem);
            line-height: 1;
            margin: 8px 0 4px;
            font-family: "Rockwell", "Georgia", serif;
        }

        .stat p {
            margin: 0;
            line-height: 1.45;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .pegboard {
            border-radius: 30px;
            padding: 18px;
            background:
                radial-gradient(circle at center, rgba(29, 40, 64, 0.12) 1.4px, transparent 1.5px),
                linear-gradient(180deg, rgba(255,255,255,0.84), rgba(244, 236, 220, 0.86));
            background-size: 18px 18px, cover;
            border: 1px solid rgba(29, 40, 64, 0.1);
            position: relative;
            overflow: hidden;
        }

        .pegboard::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 14%, rgba(243, 195, 65, 0.18), transparent 20%),
                radial-gradient(circle at 80% 20%, rgba(45, 120, 201, 0.14), transparent 24%);
            pointer-events: none;
        }

        .bench-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .bench-head h2,
        .panel h2,
        .panel h3,
        .story-card h3 {
            margin: 0;
            font-family: "Rockwell", "Georgia", serif;
            letter-spacing: -0.03em;
        }

        .bench-head p,
        .panel p,
        .story-card p {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.58;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(255,255,255,0.72);
            font-size: 0.84rem;
            color: var(--ink);
            border: 1px solid rgba(29, 40, 64, 0.1);
        }

        .keyboard-scene {
            position: relative;
            min-height: 460px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 14px 18px;
        }

        .keyboard {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: var(--split);
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .side {
            display: grid;
            gap: 10px;
            width: min(100%, 370px);
        }

        .side.left {
            transform: perspective(860px) rotateY(calc(var(--tent) * -1)) translateY(8px);
            transform-origin: center right;
        }

        .side.right {
            transform: perspective(860px) rotateY(var(--tent)) translateY(8px);
            transform-origin: center left;
        }

        .columns {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
        }

        .column {
            display: grid;
            gap: 10px;
        }

        .column:nth-child(1) { margin-top: calc(var(--stagger) * 1.1); }
        .column:nth-child(2) { margin-top: calc(var(--stagger) * 0.55); }
        .column:nth-child(4) { margin-top: calc(var(--stagger) * 0.35); }
        .column:nth-child(5) { margin-top: calc(var(--stagger) * 0.9); }

        .key {
            position: relative;
            border-radius: 16px;
            padding: 12px 0;
            min-height: 52px;
            text-align: center;
            font: 700 0.95rem/1 "Trebuchet MS", "Gill Sans", sans-serif;
            color: #21304f;
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(238, 229, 211, 0.92));
            box-shadow:
                inset 0 -2px 0 rgba(77, 89, 112, 0.12),
                0 10px 18px rgba(97, 80, 42, 0.12);
            border: 1px solid rgba(73, 84, 108, 0.1);
        }

        .key.small { font-size: 0.84rem; }
        .key::after {
            content: "";
            position: absolute;
            inset: 6px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.7);
            pointer-events: none;
        }

        .thumb-cluster {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 8px;
        }

        .rod {
            position: relative;
            width: 82px;
            height: 28px;
            border-radius: 999px;
            box-shadow:
                inset 0 -3px 0 rgba(0,0,0,0.12),
                0 14px 18px var(--rod-shadow);
            border: 1px solid rgba(0,0,0,0.06);
            cursor: pointer;
            transition: transform 180ms ease, filter 180ms ease;
        }

        .rod:hover,
        .rod.active {
            transform: translateY(-3px) rotate(-1deg);
            filter: saturate(1.08);
        }

        .rod::before,
        .rod::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: rgba(255,255,255,0.55);
            transform: translateY(-50%);
            box-shadow: inset 0 -1px 0 rgba(0,0,0,0.1);
        }

        .rod::before { left: 8px; }
        .rod::after { right: 8px; }

        .rod[data-color="red"] { background: linear-gradient(180deg, #ed6b56, #cb402e); }
        .rod[data-color="yellow"] { background: linear-gradient(180deg, #ffd66d, #efbb2d); }
        .rod[data-color="blue"] { background: linear-gradient(180deg, #56a2f4, #2b72c1); }
        .rod[data-color="green"] { background: linear-gradient(180deg, #57c78f, #279260); }
        .rod[data-color="plum"] { background: linear-gradient(180deg, #9b7dd0, #684796); }
        .rod[data-color="ink"] { background: linear-gradient(180deg, #64718d, #36425f); }

        .rod-label {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 700 0.75rem/1 "Courier New", monospace;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.95);
            text-transform: uppercase;
            pointer-events: none;
        }

        .bench-score {
            position: absolute;
            right: 18px;
            bottom: 16px;
            display: grid;
            gap: 8px;
            z-index: 1;
        }

        .score-pill {
            padding: 10px 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.78);
            border: 1px solid rgba(29, 40, 64, 0.08);
            min-width: 170px;
        }

        .score-pill strong {
            font-size: 1.1rem;
            display: block;
            margin-top: 4px;
        }

        .workshop {
            display: grid;
            grid-template-columns: 0.98fr 1.02fr;
            gap: 20px;
            margin-top: 20px;
        }

        .panel {
            border-radius: 28px;
            padding: 22px;
        }

        .profile-list {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        .profile-button {
            width: 100%;
            text-align: left;
            border: 1px solid var(--line);
            background: rgba(255,255,255,0.6);
            border-radius: 20px;
            padding: 14px 16px;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .profile-button.active {
            border-color: rgba(216, 74, 54, 0.42);
            box-shadow: 0 12px 28px rgba(216, 74, 54, 0.12);
        }

        .profile-button strong {
            display: block;
            font-size: 1.02rem;
            margin-bottom: 4px;
            font-family: "Rockwell", "Georgia", serif;
        }

        .profile-button span {
            display: block;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.45;
        }

        .control-group {
            margin-top: 18px;
        }

        .control-group:first-of-type {
            margin-top: 0;
        }

        .control-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: baseline;
            margin-bottom: 8px;
        }

        .control-head label {
            font-family: "Rockwell", "Georgia", serif;
            font-size: 1rem;
        }

        .control-head span {
            color: var(--muted);
            font-size: 0.9rem;
        }

        input[type="range"] {
            width: 100%;
            appearance: none;
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(45,120,201,0.18), rgba(243,195,65,0.45), rgba(216,74,54,0.3));
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 3px solid #fff7ed;
            background: var(--red);
            box-shadow: 0 8px 18px rgba(216, 74, 54, 0.3);
        }

        input[type="range"]::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 3px solid #fff7ed;
            background: var(--red);
            box-shadow: 0 8px 18px rgba(216, 74, 54, 0.3);
        }

        .rod-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 14px;
        }

        .rod-card {
            border-radius: 20px;
            padding: 14px;
            background: rgba(255,255,255,0.6);
            border: 1px solid var(--line);
        }

        .rod-card strong {
            display: block;
            margin-bottom: 10px;
            font-family: "Rockwell", "Georgia", serif;
            font-size: 0.98rem;
        }

        .rod-card select {
            width: 100%;
            border: 1px solid rgba(29, 40, 64, 0.12);
            border-radius: 14px;
            padding: 11px 12px;
            font: 700 0.95rem/1 "Trebuchet MS", "Gill Sans", sans-serif;
            color: var(--ink);
            background: #fffaf0;
        }

        .analysis-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 18px;
        }

        .metric {
            border-radius: 22px;
            background: rgba(255,255,255,0.58);
            border: 1px solid rgba(29, 40, 64, 0.08);
            padding: 16px;
        }

        .metric strong {
            display: block;
            font-size: 2rem;
            margin: 6px 0 4px;
            font-family: "Rockwell", "Georgia", serif;
        }

        .metric p {
            margin: 0;
            font-size: 0.92rem;
        }

        .profile-note {
            margin-top: 16px;
            padding: 14px 16px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(243,195,65,0.18), rgba(255,255,255,0.52));
            border: 1px dashed rgba(29, 40, 64, 0.14);
        }

        .shortcut-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .shortcut {
            border: 1px solid var(--line);
            border-radius: 20px;
            padding: 14px;
            background: rgba(255,255,255,0.58);
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
        }

        .shortcut:hover,
        .shortcut.active {
            transform: translateY(-2px);
            border-color: rgba(45, 120, 201, 0.32);
            box-shadow: 0 16px 24px rgba(45, 120, 201, 0.1);
        }

        .combo {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .combo span {
            border-radius: 12px;
            padding: 8px 10px;
            background: #fffaf0;
            border: 1px solid rgba(29,40,64,0.09);
            font: 700 0.82rem/1 "Courier New", monospace;
            text-transform: uppercase;
        }

        .shortcut-story {
            color: var(--muted);
            font-size: 0.74rem;
            line-height: 1.5;
            margin-top: 10px;
        }

        .story-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 20px;
        }

        .story-card {
            border-radius: 24px;
            padding: 18px;
        }

        .story-card p {
            font-size: 0.95rem;
        }

        .footer-note {
            margin-top: 28px;
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .footer-note a {
            color: var(--blue);
        }

        @media (max-width: 960px) {
            .hero-grid,
            .workshop,
            .story-row,
            .shortcut-grid {
                grid-template-columns: 1fr;
            }

            .stat-rack,
            .analysis-grid,
            .rod-grid {
                grid-template-columns: 1fr 1fr;
            }

            .hero::after {
                position: static;
                display: block;
                margin-top: 10px;
                text-align: left;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100vw - 14px, 100%);
                padding-top: 8px;
            }

            .hero,
            .panel,
            .story-card,
            .pegboard {
                border-radius: 22px;
            }

            h1 {
                max-width: none;
                font-size: clamp(2.5rem, 12vw, 4rem);
            }

            .stat-rack,
            .analysis-grid,
            .rod-grid {
                grid-template-columns: 1fr;
            }

            .bench-head {
                flex-direction: column;
                align-items: flex-start;
            }

            .keyboard-scene {
                min-height: 380px;
                padding-left: 0;
                padding-right: 0;
            }

            .keyboard {
                gap: calc(var(--split) * 0.55);
            }

            .key {
                min-height: 44px;
                padding: 10px 0;
                font-size: 0.82rem;
            }

            .rod {
                width: 66px;
            }

            .bench-score {
                position: static;
                margin-top: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Workshop No. 06 • pinky relief prototype</div>
                    <h1>K'nexis Keyboard Lab</h1>
                    <p class="lede">A bright little split-keyboard workshop inspired by Jon's wonderfully homemade K'NEX thumb-cluster hack. Tune the geometry, reassign the thumb rods, and see how much modifier pain you can steal away from your poor overworked pinkies.</p>
                    <div class="hero-links">
                        <button class="action action-primary" id="shuffleBuild" type="button">Prototype Something Weird</button>
                        <a class="action action-secondary" href="<?= htmlspecialchars($inspiration['url'], ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer">Inspired by Jon's “<?= htmlspecialchars($inspiration['title'], ENT_QUOTES) ?>”</a>
                    </div>
                    <div class="stat-rack">
                        <div class="stat">
                            <div class="metric-label">Pinky burden</div>
                            <strong id="heroPinky">41%</strong>
                            <p>Estimated modifier strain left on the outer fingers.</p>
                        </div>
                        <div class="stat">
                            <div class="metric-label">Thumb swagger</div>
                            <strong id="heroThumb">68</strong>
                            <p>How boldly your thumbs are now running the kingdom.</p>
                        </div>
                        <div class="stat">
                            <div class="metric-label">Workshop charm</div>
                            <strong id="heroCharm">92</strong>
                            <p>Measured in toy-part audacity and programmer delight.</p>
                        </div>
                    </div>
                </div>
                <div class="pegboard">
                    <div class="bench-head">
                        <div>
                            <div class="section-tag">Live build bench</div>
                            <h2>Thumb Cluster Preview</h2>
                            <p>Those colorful rods are your modifier shortcuts. Tap a shortcut below later to see which thumb now gets the glory.</p>
                        </div>
                        <div class="chip" id="buildMood">Current mood: Emacs Pinky Rescue</div>
                    </div>
                    <div class="keyboard-scene">
                        <div class="keyboard" id="keyboardScene">
                            <div class="side left">
                                <div class="columns" id="leftColumns"></div>
                                <div class="thumb-cluster" id="leftCluster"></div>
                            </div>
                            <div class="side right">
                                <div class="columns" id="rightColumns"></div>
                                <div class="thumb-cluster" id="rightCluster"></div>
                            </div>
                        </div>
                        <div class="bench-score">
                            <div class="score-pill">
                                <div class="mini">Comfort score</div>
                                <strong id="comfortScore">84 / 100</strong>
                            </div>
                            <div class="score-pill">
                                <div class="mini">Best rod</div>
                                <strong id="bestRod">Left red rod: Ctrl</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="workshop">
            <div class="panel">
                <div class="section-tag">Build profiles</div>
                <h2>Start With a Personality</h2>
                <p>Jon's original post had the exact right spirit: "what if I solve this with household-level geekery?" These presets lean into that same energy, from proper pinky rescue to cheerful desk goblin nonsense.</p>
                <div class="profile-list" id="profileList"></div>
                <div class="profile-note" id="profileNote"></div>
            </div>

            <div class="panel">
                <div class="section-tag">Geometry + rods</div>
                <h2>Rebuild the Contraption</h2>
                <p>Adjust the split, stagger, and tenting, then decide which modifier lives on each toy rod. The lab recalculates your comfort, thumb takeover, and shortcut feel live.</p>

                <div class="control-group">
                    <div class="control-head">
                        <label for="splitRange">Split width</label>
                        <span id="splitValue">58 px</span>
                    </div>
                    <input id="splitRange" type="range" min="26" max="96" value="58">
                </div>

                <div class="control-group">
                    <div class="control-head">
                        <label for="staggerRange">Column stagger</label>
                        <span id="staggerValue">16 px</span>
                    </div>
                    <input id="staggerRange" type="range" min="0" max="28" value="16">
                </div>

                <div class="control-group">
                    <div class="control-head">
                        <label for="tentRange">Tenting angle</label>
                        <span id="tentValue">24°</span>
                    </div>
                    <input id="tentRange" type="range" min="0" max="34" value="24">
                </div>

                <div class="rod-grid" id="rodGrid"></div>
            </div>
        </section>

        <section class="panel">
            <div class="section-tag">Shortcut stress test</div>
            <h2>See Which Thumb Gets Dragged Into Service</h2>
            <p>Pick a common shortcut and the lab will highlight the rods involved, estimate how much pinky suffering you avoided, and provide a tiny bit of editor melodrama for free.</p>
            <div class="shortcut-grid" id="shortcutGrid"></div>
            <div class="analysis-grid">
                <div class="metric">
                    <div class="metric-label">Saved pinky presses</div>
                    <strong id="savedPresses">73%</strong>
                    <p>Based on your selected profile's modifier habits and the rods currently assigned.</p>
                </div>
                <div class="metric">
                    <div class="metric-label">Shortcut path</div>
                    <strong id="shortcutPath">Left thumb + right hand</strong>
                    <p id="shortcutPathNote">A comfortable split combo that keeps the drama off your weakest fingers.</p>
                </div>
                <div class="metric">
                    <div class="metric-label">Weirdness factor</div>
                    <strong id="weirdness">11 / 10</strong>
                    <p>Because double-sided tape plus building rods is not normal, and that is part of the magic.</p>
                </div>
                <div class="metric">
                    <div class="metric-label">Workshop verdict</div>
                    <strong id="verdict">Ship the prototype</strong>
                    <p id="verdictNote">Your layout is eccentric in a productive way. The best kind.</p>
                </div>
            </div>
        </section>

        <section class="story-row">
            <article class="story-card">
                <div class="section-tag">Why it works</div>
                <h3>Thumbs Are Built Like Tiny Forklifts</h3>
                <p>Jon's post spotted the key ergonomic joke: we ask the strongest digits on the hand to do almost nothing while the pinkies get sentenced to modifier duty. Rude, frankly.</p>
            </article>
            <article class="story-card">
                <div class="section-tag">Why it's fun</div>
                <h3>Improvised Hardware Has Character</h3>
                <p>A store-bought ergonomic keyboard is sensible. A keyboard improved with toy rods and tape is a story. Stories are stickier than products, and much more charming.</p>
            </article>
            <article class="story-card">
                <div class="section-tag">Why Nathan might grin</div>
                <h3>It Feels Like a Secret Gadget Build</h3>
                <p>Bright rods, live scores, and exaggerated shortcut names make the whole thing feel like you're modding a hero vehicle dashboard rather than optimizing office furniture.</p>
            </article>
        </section>

        <p class="footer-note">Inspired by Jon's <a href="<?= htmlspecialchars($inspiration['url'], ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($inspiration['title'], ENT_QUOTES) ?></a>, posted on <?= htmlspecialchars($inspiration['date'], ENT_QUOTES) ?>. Built as a single-file toy for the Chloe Reads Jon workshop.</p>
    </div>

    <script>
        const profiles = <?= json_encode($profiles, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const shortcuts = <?= json_encode($shortcuts, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;

        const state = {
            profileId: profiles[0].id,
            split: profiles[0].split,
            stagger: profiles[0].stagger,
            tent: profiles[0].tent,
            rods: [
                { id: 'l1', side: 'left', color: 'red', label: 'Left red rod', mod: 'ctrl' },
                { id: 'l2', side: 'left', color: 'yellow', label: 'Left yellow rod', mod: 'shift' },
                { id: 'l3', side: 'left', color: 'blue', label: 'Left blue rod', mod: 'alt' },
                { id: 'r1', side: 'right', color: 'green', label: 'Right green rod', mod: 'ctrl' },
                { id: 'r2', side: 'right', color: 'plum', label: 'Right plum rod', mod: 'shift' },
                { id: 'r3', side: 'right', color: 'ink', label: 'Right ink rod', mod: 'meta' }
            ],
            shortcutIndex: 0
        };

        const leftColumns = document.getElementById('leftColumns');
        const rightColumns = document.getElementById('rightColumns');
        const leftCluster = document.getElementById('leftCluster');
        const rightCluster = document.getElementById('rightCluster');
        const profileList = document.getElementById('profileList');
        const profileNote = document.getElementById('profileNote');
        const rodGrid = document.getElementById('rodGrid');
        const shortcutGrid = document.getElementById('shortcutGrid');

        const splitRange = document.getElementById('splitRange');
        const staggerRange = document.getElementById('staggerRange');
        const tentRange = document.getElementById('tentRange');

        const rootStyle = document.documentElement.style;

        const keyColumnsLeft = [
            ['Tab', 'Q', 'A', 'Z'],
            ['Esc', 'W', 'S', 'X'],
            ['1', 'E', 'D', 'C'],
            ['2', 'R', 'F', 'V'],
            ['3', 'T', 'G', 'B']
        ];

        const keyColumnsRight = [
            ['6', 'Y', 'H', 'N'],
            ['7', 'U', 'J', 'M'],
            ['8', 'I', 'K', ','],
            ['9', 'O', 'L', '.'],
            ['0', 'P', ';', '/']
        ];

        function titleCase(text) {
            return text.charAt(0).toUpperCase() + text.slice(1);
        }

        function getProfile() {
            return profiles.find((profile) => profile.id === state.profileId) || profiles[0];
        }

        function renderColumns(target, columns) {
            target.innerHTML = '';
            columns.forEach((labels) => {
                const column = document.createElement('div');
                column.className = 'column';
                labels.forEach((label) => {
                    const key = document.createElement('div');
                    key.className = 'key' + (label.length > 3 ? ' small' : '');
                    key.textContent = label;
                    column.appendChild(key);
                });
                target.appendChild(column);
            });
        }

        function makeRod(rod) {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'rod';
            button.dataset.color = rod.color;
            button.dataset.rodId = rod.id;
            button.innerHTML = '<span class="rod-label">' + titleCase(rod.mod) + '</span>';
            return button;
        }

        function renderClusters() {
            leftCluster.innerHTML = '';
            rightCluster.innerHTML = '';

            state.rods.forEach((rod) => {
                const button = makeRod(rod);
                if (rod.side === 'left') {
                    leftCluster.appendChild(button);
                } else {
                    rightCluster.appendChild(button);
                }
            });
        }

        function renderProfiles() {
            profileList.innerHTML = '';
            profiles.forEach((profile) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'profile-button' + (profile.id === state.profileId ? ' active' : '');
                button.innerHTML =
                    '<strong>' + profile.name + '</strong>' +
                    '<span>' + profile.tagline + '</span>';
                button.addEventListener('click', () => {
                    state.profileId = profile.id;
                    state.split = profile.split;
                    state.stagger = profile.stagger;
                    state.tent = profile.tent;
                    splitRange.value = profile.split;
                    staggerRange.value = profile.stagger;
                    tentRange.value = profile.tent;
                    syncRanges();
                    renderAll();
                });
                profileList.appendChild(button);
            });

            const profile = getProfile();
            profileNote.innerHTML = '<strong>' + profile.name + ':</strong> ' + profile.description;
        }

        function renderRodControls() {
            rodGrid.innerHTML = '';
            const modifiers = ['ctrl', 'shift', 'alt', 'meta'];

            state.rods.forEach((rod) => {
                const card = document.createElement('div');
                card.className = 'rod-card';
                const options = modifiers.map((mod) => {
                    const selected = mod === rod.mod ? ' selected' : '';
                    return '<option value="' + mod + '"' + selected + '>' + titleCase(mod) + '</option>';
                }).join('');

                card.innerHTML =
                    '<strong>' + rod.label + '</strong>' +
                    '<div class="rod" data-color="' + rod.color + '"><span class="rod-label">' + titleCase(rod.mod) + '</span></div>' +
                    '<div style="height:10px"></div>' +
                    '<select data-select-rod="' + rod.id + '">' + options + '</select>';

                const select = card.querySelector('select');
                select.addEventListener('change', (event) => {
                    rod.mod = event.target.value;
                    renderAll();
                });

                rodGrid.appendChild(card);
            });
        }

        function renderShortcuts() {
            shortcutGrid.innerHTML = '';
            shortcuts.forEach((shortcut, index) => {
                const card = document.createElement('button');
                card.type = 'button';
                card.className = 'shortcut' + (index === state.shortcutIndex ? ' active' : '');
                card.innerHTML =
                    '<strong>' + shortcut.label + '</strong>' +
                    '<div class="combo">' + shortcut.combo.map((part) => '<span>' + part + '</span>').join('') + '</div>' +
                    '<div class="shortcut-story">' + shortcut.story + '</div>';
                card.addEventListener('click', () => {
                    state.shortcutIndex = index;
                    renderAll();
                });
                shortcutGrid.appendChild(card);
            });
        }

        function profileUses() {
            return getProfile().uses;
        }

        function calculateStats() {
            const uses = profileUses();
            const coverage = {};
            state.rods.forEach((rod) => {
                coverage[rod.mod] = (coverage[rod.mod] || 0) + 1;
            });

            const totalModifierUse = Object.values(uses).reduce((sum, value) => sum + value, 0);
            let pinkyResidual = totalModifierUse;
            let thumbHelp = 0;

            Object.entries(uses).forEach(([mod, value]) => {
                const helperCount = coverage[mod] || 0;
                const rescue = helperCount === 0 ? 0 : helperCount === 1 ? 0.74 : 0.9;
                const rescued = value * rescue;
                pinkyResidual -= rescued;
                thumbHelp += rescued * (mod === 'ctrl' ? 1.2 : 1);
            });

            const pinkyBurden = Math.max(6, Math.min(96, Math.round((pinkyResidual / totalModifierUse) * 100)));
            const thumbSwagger = Math.max(18, Math.min(100, Math.round((thumbHelp / totalModifierUse) * 100)));
            const geometryPenalty = Math.abs(state.split - 56) * 0.34 + Math.abs(state.stagger - 13) * 0.95 + Math.abs(state.tent - 20) * 1.25;
            const comfort = Math.max(51, Math.min(99, Math.round(97 - geometryPenalty - pinkyBurden * 0.16)));
            const weirdness = Math.max(6, Math.min(14, Math.round(8 + state.stagger * 0.1 + state.tent * 0.06 + state.split * 0.03)));
            const charm = Math.max(68, Math.min(100, Math.round(86 + weirdness - pinkyBurden * 0.08)));

            return { pinkyBurden, thumbSwagger, comfort, weirdness, charm };
        }

        function analyzeShortcut() {
            const shortcut = shortcuts[state.shortcutIndex];
            const mods = shortcut.combo.filter((item) => ['ctrl', 'shift', 'alt', 'meta'].includes(item.toLowerCase())).map((item) => item.toLowerCase());
            const matchingRods = state.rods.filter((rod) => mods.includes(rod.mod));
            const handSummary = matchingRods.length
                ? matchingRods.map((rod) => rod.side === 'left' ? 'left thumb' : 'right thumb')
                : ['pinky sadness'];

            const uniqueHands = [...new Set(handSummary)];
            const path = uniqueHands.length > 1 ? uniqueHands.join(' + ') + ' + fingers' : uniqueHands[0] + ' + fingers';
            const saved = Math.min(92, 36 + matchingRods.length * 18 + (mods.includes('ctrl') ? 11 : 0) + (mods.length > 1 ? 8 : 0));

            return { shortcut, matchingRods, path, saved };
        }

        function verdictLine(stats) {
            if (stats.comfort > 90 && stats.pinkyBurden < 24) {
                return ['Ship the prototype', 'This is both silly and genuinely useful. Dangerous combination.'];
            }
            if (stats.weirdness > 12) {
                return ['Magnificent nonsense', 'A proper garage-lab invention. Somebody hand Jon more tape.'];
            }
            if (stats.pinkyBurden > 40) {
                return ['Needs more thumb crime', 'Your pinkies are still doing too much honest labor.'];
            }
            return ['Promising contraption', 'Odd enough to be memorable, disciplined enough to keep.'];
        }

        function syncRanges() {
            splitRange.value = state.split;
            staggerRange.value = state.stagger;
            tentRange.value = state.tent;
            document.getElementById('splitValue').textContent = state.split + ' px';
            document.getElementById('staggerValue').textContent = state.stagger + ' px';
            document.getElementById('tentValue').textContent = state.tent + '°';
            rootStyle.setProperty('--split', state.split + 'px');
            rootStyle.setProperty('--stagger', state.stagger + 'px');
            rootStyle.setProperty('--tent', state.tent + 'deg');
        }

        function updateOutputs() {
            const stats = calculateStats();
            const shortcutAnalysis = analyzeShortcut();
            const [verdict, verdictNote] = verdictLine(stats);

            document.getElementById('heroPinky').textContent = stats.pinkyBurden + '%';
            document.getElementById('heroThumb').textContent = stats.thumbSwagger;
            document.getElementById('heroCharm').textContent = stats.charm;
            document.getElementById('comfortScore').textContent = stats.comfort + ' / 100';
            document.getElementById('savedPresses').textContent = shortcutAnalysis.saved + '%';
            document.getElementById('shortcutPath').textContent = shortcutAnalysis.path.replace(/\b\w/g, (ch) => ch.toUpperCase());
            document.getElementById('shortcutPathNote').textContent = shortcutAnalysis.shortcut.story;
            document.getElementById('weirdness').textContent = stats.weirdness + ' / 10';
            document.getElementById('verdict').textContent = verdict;
            document.getElementById('verdictNote').textContent = verdictNote;
            document.getElementById('buildMood').textContent = 'Current mood: ' + getProfile().name;

            const bestRod = [...state.rods].sort((a, b) => {
                const score = (rod) => (profileUses()[rod.mod] || 0) + (rod.mod === 'ctrl' ? 8 : 0);
                return score(b) - score(a);
            })[0];
            document.getElementById('bestRod').textContent = bestRod.label + ': ' + titleCase(bestRod.mod);

            document.querySelectorAll('.rod').forEach((rodElement) => {
                const id = rodElement.dataset.rodId;
                if (!id) {
                    return;
                }
                const active = shortcutAnalysis.matchingRods.some((rod) => rod.id === id);
                rodElement.classList.toggle('active', active);
            });
        }

        function renderAll() {
            renderColumns(leftColumns, keyColumnsLeft);
            renderColumns(rightColumns, keyColumnsRight);
            renderClusters();
            renderProfiles();
            renderRodControls();
            renderShortcuts();
            syncRanges();
            updateOutputs();
        }

        splitRange.addEventListener('input', (event) => {
            state.split = Number(event.target.value);
            syncRanges();
            updateOutputs();
        });

        staggerRange.addEventListener('input', (event) => {
            state.stagger = Number(event.target.value);
            syncRanges();
            updateOutputs();
        });

        tentRange.addEventListener('input', (event) => {
            state.tent = Number(event.target.value);
            syncRanges();
            updateOutputs();
        });

        document.getElementById('shuffleBuild').addEventListener('click', () => {
            const shuffledProfile = profiles[Math.floor(Math.random() * profiles.length)];
            state.profileId = shuffledProfile.id;
            state.split = Math.floor(30 + Math.random() * 60);
            state.stagger = Math.floor(Math.random() * 29);
            state.tent = Math.floor(Math.random() * 35);
            const mods = ['ctrl', 'shift', 'alt', 'meta'];
            state.rods.forEach((rod) => {
                rod.mod = mods[Math.floor(Math.random() * mods.length)];
            });
            state.shortcutIndex = Math.floor(Math.random() * shortcuts.length);
            renderAll();
        });

        renderAll();
    </script>
</body>
</html>
