<?php
$decks = [
    [
        'id' => 'nvc-needs',
        'label' => 'NVC Needs',
        'accent' => '#ff9f6b',
        'description' => 'Warm human needs, the kind Jon was studying when he found that old customizable word game.',
        'words' => [
            ['word' => 'RESPECT', 'clue' => 'Being treated with dignity, not brushed aside.'],
            ['word' => 'WARMTH', 'clue' => 'Emotional closeness that feels kind and welcoming.'],
            ['word' => 'PURPOSE', 'clue' => 'The sense that what you are doing matters.'],
            ['word' => 'BELONGING', 'clue' => 'Feeling included, wanted, and at home.'],
            ['word' => 'REST', 'clue' => 'Permission to stop pushing and actually recover.'],
            ['word' => 'PLAY', 'clue' => 'Lightness, delight, and room for goofing off.'],
            ['word' => 'SAFETY', 'clue' => 'The condition that lets your shoulders finally unclench.'],
            ['word' => 'TRUST', 'clue' => 'Confidence that someone will not casually let you down.']
        ]
    ],
    [
        'id' => 'retro-garage',
        'label' => 'Retro Garage',
        'accent' => '#79f2ff',
        'description' => 'A Nathan-friendly deck full of arcade and vintage-machine energy.',
        'words' => [
            ['word' => 'TURBO', 'clue' => 'The word every 1980s dashboard wanted to brag about.'],
            ['word' => 'TARGA', 'clue' => 'A car body style with a removable roof panel.'],
            ['word' => 'CRUISER', 'clue' => 'A laid-back ride built for comfort more than cornering.'],
            ['word' => 'PIXELS', 'clue' => 'The tiny squares that built old-school game worlds.'],
            ['word' => 'ARCADE', 'clue' => 'A glorious room full of blinking cabinets and bad financial decisions.'],
            ['word' => 'CARBURETOR', 'clue' => 'An old-school engine part, fiddly and very on-brand for vintage cars.'],
            ['word' => 'PHOSPHOR', 'clue' => 'That ghostly green CRT glow retro nerds get emotional about.'],
            ['word' => 'JOYRIDE', 'clue' => 'A drive taken mostly because the machine is fun to be inside.']
        ]
    ],
    [
        'id' => 'quest-locker',
        'label' => 'Quest Locker',
        'accent' => '#c4ff72',
        'description' => 'Adventure words with a little Zelda-ish sparkle and storybook momentum.',
        'words' => [
            ['word' => 'TRIFORCE', 'clue' => 'A famous golden symbol split into three virtues.'],
            ['word' => 'HOOKSHOT', 'clue' => 'The gadget that says, "What if grappling hooks solved everything?"'],
            ['word' => 'DUNGEON', 'clue' => 'Where puzzles, keys, and suspiciously dramatic bosses live.'],
            ['word' => 'BOOMERANG', 'clue' => 'A thrown weapon that politely comes back.'],
            ['word' => 'RUPEES', 'clue' => 'Sparkly green currency found in grass, pots, and apparently the laws of physics.'],
            ['word' => 'LANTERN', 'clue' => 'A portable little circle of bravery in the dark.'],
            ['word' => 'MAP', 'clue' => 'The item that stops wandering from being called exploration.'],
            ['word' => 'TEMPLE', 'clue' => 'A grand place of mystery, puzzles, and a probably cursed basement.']
        ]
    ],
    [
        'id' => 'catholic-shelf',
        'label' => 'Catholic Shelf',
        'accent' => '#ffd86b',
        'description' => 'Words from prayer, liturgy, and the old bright treasury Jon loves.',
        'words' => [
            ['word' => 'ROSARY', 'clue' => 'A prayer walked bead by bead.'],
            ['word' => 'PSALTER', 'clue' => 'The biblical book of psalms gathered into one treasury.'],
            ['word' => 'ICON', 'clue' => 'A sacred image meant for contemplation, not just decoration.'],
            ['word' => 'VIGIL', 'clue' => 'Prayerful watchfulness, often in the night before a feast.'],
            ['word' => 'INCENSE', 'clue' => 'Smoke that somehow smells like reverence.'],
            ['word' => 'CANDLES', 'clue' => 'Small flames that make a chapel feel immediately more serious and beautiful.'],
            ['word' => 'RELIQUARY', 'clue' => 'A vessel made to hold a relic with honor.'],
            ['word' => 'PILGRIM', 'clue' => 'Someone who travels with prayer as part of the journey.']
        ]
    ]
];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Vault Arcade</title>
    <style>
        :root {
            --bg: #0a0d17;
            --panel: rgba(15, 20, 35, 0.82);
            --panel-strong: rgba(10, 13, 23, 0.92);
            --line: rgba(255, 255, 255, 0.1);
            --text: #eef3ff;
            --muted: #9ba7c6;
            --gold: #ffd86b;
            --danger: #ff6b7d;
            --success: #91ffb4;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
            --radius: 28px;
            --accent: #ff9f6b;
            --accent-soft: rgba(255, 159, 107, 0.18);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            background:
                radial-gradient(circle at top left, rgba(121, 242, 255, 0.16), transparent 28%),
                radial-gradient(circle at top right, rgba(255, 216, 107, 0.14), transparent 30%),
                radial-gradient(circle at bottom center, rgba(196, 255, 114, 0.12), transparent 25%),
                linear-gradient(180deg, #11162a 0%, #090c14 58%, #05070d 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 34px 34px;
            mask-image: radial-gradient(circle at center, black 42%, transparent 90%);
            opacity: 0.5;
        }

        .page {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 24px 0 48px;
        }

        .marquee {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: #fff4d7;
            font: 700 0.8rem/1 "Trebuchet MS", "Segoe UI", sans-serif;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            box-shadow: inset 0 0 0 1px rgba(255,216,107,0.12);
        }

        .hero {
            position: relative;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: calc(var(--radius) + 8px);
            padding: 28px;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02)),
                rgba(9, 12, 20, 0.72);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -10% -45% 40%;
            height: 70%;
            background: radial-gradient(circle, var(--accent-soft), transparent 62%);
            filter: blur(30px);
            pointer-events: none;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 22px;
            position: relative;
            z-index: 1;
        }

        h1 {
            margin: 0;
            font-family: "Copperplate", "Papyrus", "Trebuchet MS", serif;
            font-size: clamp(2.4rem, 6vw, 5rem);
            line-height: 0.94;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            text-shadow: 0 0 28px rgba(255, 255, 255, 0.12);
        }

        .subtitle {
            max-width: 44rem;
            margin: 16px 0 0;
            color: #d7def3;
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .hero-notes {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .note {
            padding: 14px 14px 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .note strong {
            display: block;
            margin-bottom: 6px;
            font: 700 0.72rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #fff0c1;
        }

        .note span {
            display: block;
            color: var(--muted);
            line-height: 1.5;
            font-size: 0.95rem;
        }

        .cabinet {
            position: relative;
            min-height: 100%;
            padding: 20px;
            border-radius: 30px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.09), rgba(255,255,255,0.03)),
                linear-gradient(180deg, rgba(14,18,29,0.96), rgba(7,9,15,0.98));
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08), 0 25px 45px rgba(0,0,0,0.35);
        }

        .cabinet::before,
        .cabinet::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(1px);
        }

        .cabinet::before {
            top: 18px;
            right: 24px;
            width: 72px;
            height: 8px;
            background: linear-gradient(90deg, var(--accent), #fff, var(--accent));
            box-shadow: 0 0 18px var(--accent);
        }

        .cabinet::after {
            inset: auto 24px 20px auto;
            width: 46px;
            height: 46px;
            background: radial-gradient(circle, rgba(255,255,255,0.8), var(--accent) 45%, rgba(255,255,255,0.08) 75%);
            box-shadow: 0 0 24px var(--accent-soft);
        }

        .cabinet-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.09);
            font: 700 0.72rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #fff;
        }

        .cabinet-screen {
            margin-top: 16px;
            border-radius: 26px;
            padding: 18px;
            background: linear-gradient(180deg, rgba(8,11,20,0.96), rgba(13,20,36,0.94));
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: inset 0 0 0 1px rgba(121,242,255,0.08), inset 0 24px 48px rgba(121,242,255,0.06);
        }

        .cabinet-screen h2 {
            margin: 0 0 8px;
            font-family: "Trebuchet MS", sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.95rem;
            color: var(--accent);
        }

        .cabinet-screen p {
            margin: 0;
            color: #d5def5;
            line-height: 1.65;
        }

        .layout {
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            gap: 22px;
            margin-top: 22px;
        }

        .panel {
            border-radius: var(--radius);
            border: 1px solid rgba(255,255,255,0.08);
            background: var(--panel);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
        }

        .sidebar {
            padding: 18px;
            position: sticky;
            top: 18px;
            align-self: start;
        }

        .section-title {
            margin: 0 0 14px;
            font: 700 0.78rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #fff0c1;
        }

        .deck-list {
            display: grid;
            gap: 12px;
        }

        .deck-btn {
            width: 100%;
            text-align: left;
            border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.025));
            color: var(--text);
            border-radius: 20px;
            padding: 14px;
            cursor: pointer;
            transition: transform 140ms ease, border-color 140ms ease, background 140ms ease;
        }

        .deck-btn:hover,
        .deck-btn:focus-visible {
            transform: translateY(-2px);
            border-color: rgba(255,255,255,0.18);
            outline: none;
        }

        .deck-btn.active {
            background: linear-gradient(180deg, rgba(255,255,255,0.11), var(--accent-soft));
            box-shadow: 0 0 0 1px rgba(255,255,255,0.06), 0 12px 26px rgba(0,0,0,0.25);
        }

        .deck-btn strong {
            display: block;
            font: 700 1rem/1.1 "Trebuchet MS", sans-serif;
            margin-bottom: 6px;
            color: #fff;
        }

        .deck-btn span {
            display: block;
            color: var(--muted);
            line-height: 1.45;
            font-size: 0.92rem;
        }

        .sidebar-grid {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .mini-stat {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .mini-stat .label {
            font: 700 0.72rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .mini-stat .value {
            margin-top: 8px;
            font-size: 1.8rem;
            line-height: 1;
            color: #fff;
        }

        .game-panel {
            padding: 22px;
        }

        .hud {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .hud-card {
            padding: 14px 16px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
        }

        .hud-card .label {
            font: 700 0.72rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.17em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .hud-card .value {
            margin-top: 9px;
            font-family: "Trebuchet MS", sans-serif;
            font-size: clamp(1.1rem, 3.4vw, 1.9rem);
            color: #fff;
        }

        .stage {
            display: grid;
            gap: 18px;
            padding: 18px;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .status-line {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            color: #f5f7ff;
            font-family: "Trebuchet MS", sans-serif;
        }

        .word-display {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            padding: 12px 0 6px;
        }

        .letter-slot {
            width: min(58px, calc(14vw - 2px));
            min-width: 36px;
            aspect-ratio: 0.78;
            border-radius: 18px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
            box-shadow: inset 0 -10px 18px rgba(0,0,0,0.2);
            font: 700 clamp(1.05rem, 4vw, 2rem)/1 "Trebuchet MS", sans-serif;
            text-transform: uppercase;
        }

        .letter-slot.revealed {
            color: #fff;
            border-color: rgba(255,255,255,0.14);
            background: linear-gradient(180deg, color-mix(in srgb, var(--accent) 38%, white 6%), color-mix(in srgb, var(--accent) 18%, black 40%));
            text-shadow: 0 0 16px rgba(255,255,255,0.18);
            box-shadow: 0 10px 20px rgba(0,0,0,0.22), 0 0 0 1px rgba(255,255,255,0.08), 0 0 22px color-mix(in srgb, var(--accent) 35%, transparent);
        }

        .clue-card {
            padding: 18px;
            border-radius: 22px;
            background: rgba(5, 8, 15, 0.5);
            border: 1px solid rgba(255,255,255,0.08);
            line-height: 1.75;
        }

        .clue-card strong {
            display: block;
            margin-bottom: 8px;
            font: 700 0.75rem/1 "Trebuchet MS", sans-serif;
            letter-spacing: 0.17em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .alphabet {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 10px;
        }

        .key {
            min-height: 48px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            background: linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.025));
            color: #f5f7ff;
            font: 800 1rem/1 "Trebuchet MS", sans-serif;
            cursor: pointer;
            transition: transform 120ms ease, filter 120ms ease, opacity 120ms ease;
        }

        .key:hover,
        .key:focus-visible {
            transform: translateY(-1px);
            filter: brightness(1.08);
            outline: none;
        }

        .key.hit {
            background: linear-gradient(180deg, rgba(145,255,180,0.28), rgba(145,255,180,0.12));
            color: #effff3;
            border-color: rgba(145,255,180,0.34);
        }

        .key.miss {
            background: linear-gradient(180deg, rgba(255,107,125,0.24), rgba(255,107,125,0.1));
            color: #ffdbe0;
            border-color: rgba(255,107,125,0.26);
            opacity: 0.7;
        }

        .key:disabled { cursor: default; }

        .controls {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .action {
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 16px;
            padding: 12px 16px;
            background: rgba(255,255,255,0.05);
            color: #fff;
            font: 700 0.94rem/1 "Trebuchet MS", sans-serif;
            cursor: pointer;
        }

        .action.primary {
            background: linear-gradient(180deg, color-mix(in srgb, var(--accent) 70%, white 6%), color-mix(in srgb, var(--accent) 50%, black 28%));
            color: #091018;
            border-color: transparent;
        }

        .message {
            min-height: 52px;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: #e4ebff;
            line-height: 1.55;
        }

        .message strong {
            color: #fff4d7;
        }

        .sparkline {
            display: flex;
            align-items: end;
            gap: 6px;
            height: 42px;
            margin-top: 8px;
        }

        .sparkline span {
            flex: 1;
            border-radius: 999px 999px 3px 3px;
            background: linear-gradient(180deg, var(--accent), rgba(255,255,255,0.2));
            opacity: 0.88;
        }

        .footer-note {
            margin-top: 16px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.65;
        }

        @media (max-width: 980px) {
            .hero-grid,
            .layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100% - 18px, 1120px);
                padding-top: 12px;
            }

            .hero,
            .game-panel,
            .sidebar {
                padding: 18px;
            }

            .hero-notes,
            .hud {
                grid-template-columns: 1fr 1fr;
            }

            .alphabet {
                grid-template-columns: repeat(6, minmax(0, 1fr));
            }
        }

        @media (max-width: 520px) {
            .hero-notes,
            .hud {
                grid-template-columns: 1fr;
            }

            .alphabet {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .letter-slot {
                width: calc(17vw - 2px);
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero panel">
            <div class="marquee">Custom Word Decks • Arcade Mode • One More Round Energy</div>
            <div class="hero-grid">
                <div>
                    <h1>Word Vault Arcade</h1>
                    <p class="subtitle">A polished, deck-switching word game inspired by Jon's 2006 post about using a customizable vocabulary game to learn Nonviolent Communication needs. Same core idea, much better manners, and substantially less chance of a kangaroo insulting your intelligence.</p>
                    <div class="hero-notes">
                        <div class="note">
                            <strong>Choose a deck</strong>
                            <span>Swap between human needs, Catholic treasures, retro-machine words, and quest vocabulary.</span>
                        </div>
                        <div class="note">
                            <strong>Guess smart</strong>
                            <span>Every correct letter builds your score and streak. Misses cost sparks.</span>
                        </div>
                        <div class="note">
                            <strong>Keep it lively</strong>
                            <span>Use Hint, Reveal Vowel, or Skip Round when the brain gears start grinding.</span>
                        </div>
                    </div>
                </div>
                <aside class="cabinet">
                    <div class="cabinet-label">Inspired by 2006-10-29</div>
                    <div class="cabinet-screen">
                        <h2>Why this exists</h2>
                        <p>Jon wanted a fun way to absorb a domain-specific vocabulary list, which is exactly the kind of delightfully practical nerd move I respect. So this page turns that idea into a small browser arcade with multiple decks and a little dramatic glow.</p>
                    </div>
                </aside>
            </div>
        </section>

        <section class="layout">
            <aside class="sidebar panel">
                <h2 class="section-title">Vault decks</h2>
                <div class="deck-list" id="deckList"></div>
                <div class="sidebar-grid">
                    <div class="mini-stat">
                        <div class="label">Personal best</div>
                        <div class="value" id="bestScore">0</div>
                    </div>
                    <div class="mini-stat">
                        <div class="label">Rounds cleared</div>
                        <div class="value" id="roundsCleared">0</div>
                    </div>
                    <div class="mini-stat">
                        <div class="label">Current deck vibe</div>
                        <div class="value" id="deckVibe" style="font-size:1.1rem;line-height:1.35;">Warm and wordy</div>
                        <div class="sparkline" aria-hidden="true">
                            <span style="height: 35%"></span>
                            <span style="height: 58%"></span>
                            <span style="height: 82%"></span>
                            <span style="height: 64%"></span>
                            <span style="height: 92%"></span>
                            <span style="height: 48%"></span>
                        </div>
                    </div>
                </div>
                <p class="footer-note">Tip: this saves your best score and rounds locally, so the cabinet remembers you. A little clingy, but in a charming way.</p>
            </aside>

            <main class="game-panel panel">
                <div class="hud">
                    <div class="hud-card">
                        <div class="label">Deck</div>
                        <div class="value" id="deckName">NVC Needs</div>
                    </div>
                    <div class="hud-card">
                        <div class="label">Score</div>
                        <div class="value" id="score">0</div>
                    </div>
                    <div class="hud-card">
                        <div class="label">Streak</div>
                        <div class="value" id="streak">0</div>
                    </div>
                    <div class="hud-card">
                        <div class="label">Sparks left</div>
                        <div class="value" id="lives">7</div>
                    </div>
                </div>

                <section class="stage">
                    <div class="status-line">
                        <div class="pill" id="roundLabel">Round 1 of 8</div>
                        <div class="pill" id="usedLetters">Used letters: none yet</div>
                    </div>

                    <div class="word-display" id="wordDisplay" aria-live="polite"></div>

                    <div class="clue-card">
                        <strong>Clue</strong>
                        <div id="clueText">Being treated with dignity, not brushed aside.</div>
                    </div>

                    <div class="controls">
                        <button class="action primary" id="newGameBtn">New game</button>
                        <button class="action" id="hintBtn">Hint</button>
                        <button class="action" id="vowelBtn">Reveal vowel</button>
                        <button class="action" id="skipBtn">Skip round</button>
                    </div>

                    <div class="message" id="messageBox"><strong>Ready.</strong> Pick a letter and start cracking the vault.</div>

                    <div class="alphabet" id="alphabet"></div>
                </section>
            </main>
        </section>
    </div>

    <script>
        const decks = <?php echo json_encode($decks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
        const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('');
        const storageKey = 'word-vault-arcade-stats-v1';

        const state = {
            deckIndex: 0,
            score: 0,
            streak: 0,
            lives: 7,
            round: 0,
            roundOrder: [],
            currentWord: null,
            guessed: new Set(),
            used: [],
            roundsCleared: 0,
            bestScore: 0,
            gameOver: false,
        };

        const deckList = document.getElementById('deckList');
        const deckName = document.getElementById('deckName');
        const deckVibe = document.getElementById('deckVibe');
        const scoreEl = document.getElementById('score');
        const streakEl = document.getElementById('streak');
        const livesEl = document.getElementById('lives');
        const roundLabel = document.getElementById('roundLabel');
        const usedLetters = document.getElementById('usedLetters');
        const wordDisplay = document.getElementById('wordDisplay');
        const clueText = document.getElementById('clueText');
        const alphabet = document.getElementById('alphabet');
        const messageBox = document.getElementById('messageBox');
        const bestScoreEl = document.getElementById('bestScore');
        const roundsClearedEl = document.getElementById('roundsCleared');
        const hintBtn = document.getElementById('hintBtn');
        const vowelBtn = document.getElementById('vowelBtn');
        const skipBtn = document.getElementById('skipBtn');
        const newGameBtn = document.getElementById('newGameBtn');

        function shuffle(array) {
            const copy = array.slice();
            for (let i = copy.length - 1; i > 0; i -= 1) {
                const j = Math.floor(Math.random() * (i + 1));
                [copy[i], copy[j]] = [copy[j], copy[i]];
            }
            return copy;
        }

        function loadStats() {
            try {
                const saved = JSON.parse(localStorage.getItem(storageKey) || '{}');
                state.bestScore = saved.bestScore || 0;
                state.roundsCleared = saved.roundsCleared || 0;
            } catch (error) {
                state.bestScore = 0;
                state.roundsCleared = 0;
            }
        }

        function saveStats() {
            localStorage.setItem(storageKey, JSON.stringify({
                bestScore: state.bestScore,
                roundsCleared: state.roundsCleared,
            }));
        }

        function currentDeck() {
            return decks[state.deckIndex];
        }

        function describeDeck(deck) {
            const map = {
                'nvc-needs': 'Warm and wordy',
                'retro-garage': 'CRT glow and engine grease',
                'quest-locker': 'Heroic, puzzly, slightly suspicious torches',
                'catholic-shelf': 'Gold leaf, incense, and old wisdom'
            };
            return map[deck.id] || deck.description;
        }

        function setAccent(deck) {
            document.documentElement.style.setProperty('--accent', deck.accent);
            const soft = deck.accent + '33';
            document.documentElement.style.setProperty('--accent-soft', soft);
        }

        function renderDecks() {
            deckList.innerHTML = '';
            decks.forEach((deck, index) => {
                const button = document.createElement('button');
                button.className = 'deck-btn' + (index === state.deckIndex ? ' active' : '');
                button.type = 'button';
                button.innerHTML = `<strong>${deck.label}</strong><span>${deck.description}</span>`;
                button.addEventListener('click', () => {
                    state.deckIndex = index;
                    startGame(true);
                });
                deckList.appendChild(button);
            });
        }

        function updateHud() {
            const deck = currentDeck();
            deckName.textContent = deck.label;
            deckVibe.textContent = describeDeck(deck);
            scoreEl.textContent = state.score;
            streakEl.textContent = state.streak;
            livesEl.textContent = state.lives;
            roundLabel.textContent = `Round ${Math.min(state.round + 1, deck.words.length)} of ${deck.words.length}`;
            usedLetters.textContent = `Used letters: ${state.used.length ? state.used.join(', ') : 'none yet'}`;
            bestScoreEl.textContent = state.bestScore;
            roundsClearedEl.textContent = state.roundsCleared;
            setAccent(deck);
            renderDecks();
        }

        function renderWord() {
            wordDisplay.innerHTML = '';
            state.currentWord.word.split('').forEach((char) => {
                const slot = document.createElement('div');
                const revealed = state.guessed.has(char) || !/[A-Z]/.test(char);
                slot.className = 'letter-slot' + (revealed ? ' revealed' : '');
                slot.textContent = revealed ? char : '•';
                slot.setAttribute('aria-label', revealed ? char : 'hidden letter');
                wordDisplay.appendChild(slot);
            });
            clueText.textContent = state.currentWord.clue;
        }

        function setMessage(html) {
            messageBox.innerHTML = html;
        }

        function renderKeyboard() {
            alphabet.innerHTML = '';
            letters.forEach((letter) => {
                const button = document.createElement('button');
                button.className = 'key';
                button.type = 'button';
                button.textContent = letter;
                if (state.used.includes(letter)) {
                    button.disabled = true;
                    button.classList.add(state.currentWord.word.includes(letter) ? 'hit' : 'miss');
                }
                if (state.gameOver) {
                    button.disabled = true;
                }
                button.addEventListener('click', () => guess(letter));
                alphabet.appendChild(button);
            });
        }

        function pickWord() {
            const deck = currentDeck();
            const nextIndex = state.roundOrder[state.round];
            state.currentWord = deck.words[nextIndex];
            state.guessed = new Set();
            state.used = [];
        }

        function isSolved() {
            return state.currentWord.word.split('').every((char) => !/[A-Z]/.test(char) || state.guessed.has(char));
        }

        function finishRound() {
            state.score += 25 + (state.lives * 2) + (state.streak * 3);
            state.streak += 1;
            state.roundsCleared += 1;
            state.bestScore = Math.max(state.bestScore, state.score);
            saveStats();
            renderWord();
            renderKeyboard();
            updateHud();
            setMessage(`<strong>Vault opened.</strong> <em>${state.currentWord.word}</em> is yours. Nice. Next round in a blink.`);
            window.setTimeout(() => {
                state.round += 1;
                if (state.round >= currentDeck().words.length) {
                    state.gameOver = true;
                    renderKeyboard();
                    setMessage(`<strong>Deck cleared.</strong> Final score: ${state.score}. That was very solid work, frankly.`);
                    return;
                }
                pickWord();
                renderRound();
                setMessage('<strong>Next round.</strong> Fresh clue, fresh word, same beautifully unreasonable confidence.');
            }, 1100);
        }

        function failState() {
            state.gameOver = true;
            renderWord();
            renderKeyboard();
            state.bestScore = Math.max(state.bestScore, state.score);
            saveStats();
            updateHud();
            setMessage(`<strong>Cabinet dark.</strong> The word was <em>${state.currentWord.word}</em>. Hit New Game and go again.`);
        }

        function guess(letter) {
            if (state.gameOver || state.used.includes(letter)) return;
            state.used.push(letter);
            if (state.currentWord.word.includes(letter)) {
                state.guessed.add(letter);
                state.score += 8;
                state.bestScore = Math.max(state.bestScore, state.score);
                renderWord();
                renderKeyboard();
                updateHud();
                if (isSolved()) {
                    finishRound();
                } else {
                    setMessage(`<strong>Correct.</strong> ${letter} slots into place. The vault likes you today.`);
                }
                return;
            }

            state.lives -= 1;
            state.streak = 0;
            renderKeyboard();
            updateHud();
            if (state.lives <= 0) {
                failState();
            } else {
                setMessage(`<strong>Nope.</strong> ${letter} is not in this word. Sparks left: ${state.lives}.`);
            }
        }

        function revealRandomFrom(list) {
            const hidden = state.currentWord.word.split('').filter((char) => list.includes(char) && !state.guessed.has(char));
            if (!hidden.length) return false;
            const choice = hidden[Math.floor(Math.random() * hidden.length)];
            state.guessed.add(choice);
            if (!state.used.includes(choice)) state.used.push(choice);
            state.score = Math.max(0, state.score - 6);
            state.bestScore = Math.max(state.bestScore, state.score);
            renderWord();
            renderKeyboard();
            updateHud();
            if (isSolved()) {
                finishRound();
            }
            return choice;
        }

        function hint() {
            if (state.gameOver) return;
            const consonants = 'BCDFGHJKLMNPQRSTVWXYZ'.split('');
            const reveal = revealRandomFrom(consonants.concat('AEIOU'.split('')));
            if (!reveal) {
                setMessage('<strong>Already solved.</strong> You suspiciously do not need my help right now.');
                return;
            }
            setMessage(`<strong>Hint used.</strong> I revealed <em>${reveal}</em>. Tiny score tax, still worth it.`);
        }

        function revealVowel() {
            if (state.gameOver) return;
            const reveal = revealRandomFrom('AEIOU'.split(''));
            if (!reveal) {
                setMessage('<strong>No vowels left.</strong> This word is now a consonant negotiation.');
                return;
            }
            setMessage(`<strong>Vowel revealed.</strong> ${reveal} steps into the light.`);
        }

        function skipRound() {
            if (state.gameOver) return;
            state.score = Math.max(0, state.score - 10);
            state.streak = 0;
            state.round += 1;
            if (state.round >= currentDeck().words.length) {
                state.gameOver = true;
                renderKeyboard();
                updateHud();
                setMessage(`<strong>Deck finished.</strong> Final score: ${state.score}. A slightly chaotic route, but a route.`);
                return;
            }
            pickWord();
            renderRound();
            setMessage('<strong>Round skipped.</strong> Sometimes tactical retreat is just good taste.');
        }

        function renderRound() {
            renderWord();
            renderKeyboard();
            updateHud();
        }

        function startGame(deckChanged = false) {
            const deck = currentDeck();
            state.score = 0;
            state.streak = 0;
            state.lives = 7;
            state.round = 0;
            state.gameOver = false;
            state.roundOrder = shuffle(deck.words.map((_, index) => index));
            pickWord();
            renderRound();
            const intro = deckChanged
                ? `<strong>${deck.label} loaded.</strong> ${deck.description}`
                : '<strong>New game.</strong> Pick a letter and let the cabinet do its little dramatic glow.';
            setMessage(intro);
        }

        newGameBtn.addEventListener('click', () => startGame(false));
        hintBtn.addEventListener('click', hint);
        vowelBtn.addEventListener('click', revealVowel);
        skipBtn.addEventListener('click', skipRound);

        window.addEventListener('keydown', (event) => {
            if (/^[a-z]$/i.test(event.key)) {
                guess(event.key.toUpperCase());
            }
            if (event.key === 'Enter' && state.gameOver) {
                startGame(false);
            }
        });

        loadStats();
        startGame(false);
    </script>
</body>
</html>
