<?php
$publishedDate = '2026-06-14';
$symbols = [
    [
        'id' => 'lamb',
        'name' => 'Lamb',
        'glyph' => '🐑',
        'meaning' => 'Christ\'s sacrificial innocence and victory',
        'detail' => 'Often shown with a banner or cross to signal the Lamb of God.',
        'hint' => 'Gentle, white, offered, triumphant.',
        'tags' => ['mercy', 'easter', 'gospel'],
        'palette' => ['#f2d7c1', '#fff5e9'],
    ],
    [
        'id' => 'anchor',
        'name' => 'Anchor',
        'glyph' => '⚓',
        'meaning' => 'Hope that holds fast in storms',
        'detail' => 'A favorite early Christian sign for steadfast trust.',
        'hint' => 'Harbor energy, but spiritual.',
        'tags' => ['hope', 'steadfastness', 'hebrews'],
        'palette' => ['#214a63', '#74b9d6'],
    ],
    [
        'id' => 'fish',
        'name' => 'Fish',
        'glyph' => '𓆟',
        'meaning' => 'Jesus and the hidden faith of early Christians',
        'detail' => 'The ichthys became a compact confession of who Christ is.',
        'hint' => 'Simple outline, ancient code.',
        'tags' => ['baptism', 'disciples', 'witness'],
        'palette' => ['#0e6d79', '#7ed5cf'],
    ],
    [
        'id' => 'pelican',
        'name' => 'Pelican',
        'glyph' => '🕊',
        'meaning' => 'Christ nourishing his people with self-giving love',
        'detail' => 'In medieval legend the pelican fed its young with its own blood.',
        'hint' => 'A bird, but Eucharistic and wildly dramatic.',
        'tags' => ['eucharist', 'charity', 'sacrifice'],
        'palette' => ['#8d2335', '#f2a65a'],
    ],
    [
        'id' => 'keys',
        'name' => 'Keys',
        'glyph' => '🗝',
        'meaning' => 'Peter\'s authority and the stewardship of the Church',
        'detail' => 'Two keys often point to the power to bind and loose.',
        'hint' => 'Metal, mission, Matthew 16.',
        'tags' => ['peter', 'church', 'authority'],
        'palette' => ['#d2a94e', '#f7e7a1'],
    ],
    [
        'id' => 'phoenix',
        'name' => 'Phoenix',
        'glyph' => '🔥',
        'meaning' => 'Resurrection and life rising from ashes',
        'detail' => 'A poetic image of renewal adopted into Christian art.',
        'hint' => 'Not literal birdwatching.',
        'tags' => ['resurrection', 'renewal', 'life'],
        'palette' => ['#ba3e2b', '#ffca6f'],
    ],
    [
        'id' => 'vine',
        'name' => 'Vine',
        'glyph' => '🍇',
        'meaning' => 'Union with Christ, the true vine',
        'detail' => 'Branches and fruit signal life that flows from remaining in him.',
        'hint' => 'Branches, fruit, abiding.',
        'tags' => ['communion', 'growth', 'john15'],
        'palette' => ['#4c2a73', '#aa8bdc'],
    ],
    [
        'id' => 'crown',
        'name' => 'Crown',
        'glyph' => '👑',
        'meaning' => 'Sainthood, perseverance, and heavenly reward',
        'detail' => 'Sometimes royal, sometimes martyr\'s triumph after endurance.',
        'hint' => 'A finish line with gold leaf.',
        'tags' => ['saints', 'martyrs', 'glory'],
        'palette' => ['#906212', '#f1d06f'],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stained Glass Symbol Hunt</title>
    <style>
        :root {
            --bg-ink: #120d15;
            --bg-plum: #261a34;
            --glass-navy: #17304f;
            --glass-ruby: #7a2332;
            --glass-gold: #d7a84b;
            --glass-cream: #f4ead9;
            --glass-mint: #6bb7a4;
            --line: rgba(255, 241, 210, 0.14);
            --line-strong: rgba(255, 241, 210, 0.26);
            --shadow: 0 24px 70px rgba(0, 0, 0, 0.42);
            --panel: rgba(20, 14, 27, 0.82);
            --panel-soft: rgba(31, 23, 39, 0.78);
            --text: #f7f2e8;
            --muted: #d4c7b8;
            --accent: #f5c96f;
            --success: #86d0a8;
            --danger: #f08c7c;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: "Avenir Next", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 20% 15%, rgba(244, 174, 74, 0.16), transparent 24%),
                radial-gradient(circle at 78% 12%, rgba(107, 183, 164, 0.14), transparent 28%),
                linear-gradient(180deg, #1d1427 0%, #100b14 100%);
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
                linear-gradient(125deg, rgba(255,255,255,0.04), transparent 26%),
                repeating-linear-gradient(90deg, rgba(255,255,255,0.018) 0 1px, transparent 1px 36px),
                repeating-linear-gradient(0deg, rgba(255,255,255,0.018) 0 1px, transparent 1px 36px);
            opacity: 0.4;
            mix-blend-mode: screen;
        }

        body::after {
            background: radial-gradient(circle at center, transparent 56%, rgba(0, 0, 0, 0.38) 100%);
        }

        a {
            color: inherit;
        }

        .page {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 24px 0 42px;
            position: relative;
            z-index: 1;
        }

        .hero,
        .panel {
            border: 1px solid var(--line);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .hero {
            border-radius: 32px;
            padding: 28px;
            background:
                radial-gradient(circle at 18% 20%, rgba(255,255,255,0.07), transparent 22%),
                linear-gradient(145deg, rgba(255,255,255,0.05), transparent 40%),
                linear-gradient(135deg, rgba(122, 35, 50, 0.86), rgba(23, 48, 79, 0.92) 56%, rgba(40, 78, 64, 0.92));
        }

        .hero::before,
        .panel::before {
            content: "";
            position: absolute;
            inset: 14px;
            border-radius: inherit;
            border: 1px solid rgba(255, 241, 210, 0.12);
            pointer-events: none;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 24px;
            align-items: center;
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.24em;
            font-size: 0.74rem;
            color: var(--muted);
        }

        h1, h2, h3 {
            font-family: "Baskerville", "Palatino Linotype", "Book Antiqua", serif;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        h1 {
            font-size: clamp(2.9rem, 8vw, 5.6rem);
            line-height: 0.92;
            margin-top: 12px;
            max-width: 9ch;
            text-shadow: 0 5px 18px rgba(0, 0, 0, 0.28);
        }

        .lede {
            max-width: 58ch;
            font-size: 1.03rem;
            line-height: 1.7;
            color: #f8f1e2;
            margin: 16px 0 22px;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pill {
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 241, 210, 0.18);
            background: rgba(19, 13, 21, 0.34);
            font-size: 0.92rem;
            color: var(--muted);
        }

        .hero-window {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            padding: 12px;
            border-radius: 26px;
            background: rgba(18, 13, 21, 0.32);
            border: 1px solid rgba(255, 241, 210, 0.12);
            backdrop-filter: blur(8px);
        }

        .glass-tile {
            min-height: 158px;
            border-radius: 24px;
            position: relative;
            padding: 18px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
            border: 2px solid rgba(16, 11, 16, 0.6);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.16);
        }

        .glass-tile::before,
        .glass-tile::after {
            content: "";
            position: absolute;
            inset: 0;
        }

        .glass-tile::before {
            background:
                linear-gradient(135deg, rgba(255,255,255,0.36), transparent 32%),
                repeating-linear-gradient(45deg, rgba(255,255,255,0.08) 0 2px, transparent 2px 20px);
            mix-blend-mode: screen;
        }

        .glass-tile::after {
            clip-path: polygon(0 58%, 46% 0, 100% 24%, 100% 100%, 0 100%);
            background: rgba(0, 0, 0, 0.14);
        }

        .glass-tile strong {
            position: relative;
            z-index: 1;
            font-size: 1rem;
            line-height: 1.35;
            max-width: 11ch;
        }

        .glass-glyph {
            position: absolute;
            top: 18px;
            right: 18px;
            font-size: 3rem;
            z-index: 1;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.24));
        }

        .tile-lamb { background: linear-gradient(135deg, #9a3b4a, #d07d62); }
        .tile-anchor { background: linear-gradient(135deg, #17415f, #4ca5c9); }
        .tile-fish { background: linear-gradient(135deg, #0b5565, #63c6bf); }
        .tile-crown { background: linear-gradient(135deg, #775214, #d6b86b); }

        .layout {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 20px;
            margin-top: 20px;
        }

        .panel {
            border-radius: 28px;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.04), transparent 42%),
                var(--panel);
            padding: 24px;
        }

        .panel h2 {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            margin-bottom: 10px;
        }

        .subtle {
            color: var(--muted);
            line-height: 1.6;
            margin: 0 0 20px;
        }

        .scorebar {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .score-card {
            border-radius: 18px;
            padding: 14px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255, 241, 210, 0.08);
        }

        .score-label {
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.66rem;
            color: var(--muted);
        }

        .score-value {
            margin-top: 6px;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .quiz-card {
            border-radius: 24px;
            padding: 22px;
            background:
                linear-gradient(165deg, rgba(255,255,255,0.04), transparent 40%),
                rgba(13, 10, 17, 0.72);
            border: 1px solid rgba(255, 241, 210, 0.1);
        }

        .quiz-top {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 18px;
        }

        .quiz-symbol {
            min-height: 210px;
            border-radius: 22px;
            display: grid;
            place-items: center;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 50% 30%, rgba(255,255,255,0.2), transparent 24%),
                linear-gradient(135deg, rgba(255,255,255,0.08), transparent 36%),
                var(--swatch, linear-gradient(135deg, #6b2434, #b88a51));
            border: 2px solid rgba(16, 11, 16, 0.64);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.16);
            margin-bottom: 18px;
        }

        .quiz-symbol::before {
            content: "";
            position: absolute;
            inset: 16px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.18);
        }

        .quiz-symbol::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(55deg, rgba(255,255,255,0.08) 0 2px, transparent 2px 30px),
                linear-gradient(180deg, transparent, rgba(0,0,0,0.16));
            mix-blend-mode: screen;
        }

        .quiz-glyph {
            position: relative;
            z-index: 1;
            font-size: clamp(4.5rem, 12vw, 7rem);
            filter: drop-shadow(0 8px 20px rgba(0,0,0,0.26));
        }

        .quiz-name {
            font-size: 1.3rem;
            margin-bottom: 8px;
        }

        .choices {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin: 18px 0 14px;
        }

        .choice {
            width: 100%;
            border: 1px solid rgba(255, 241, 210, 0.12);
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            color: var(--text);
            padding: 16px;
            text-align: left;
            line-height: 1.45;
        }

        .choice:hover,
        .choice:focus-visible {
            transform: translateY(-1px);
            border-color: rgba(245, 201, 111, 0.42);
            outline: none;
        }

        .choice.correct {
            background: rgba(134, 208, 168, 0.18);
            border-color: rgba(134, 208, 168, 0.6);
        }

        .choice.wrong {
            background: rgba(240, 140, 124, 0.16);
            border-color: rgba(240, 140, 124, 0.52);
        }

        .feedback {
            min-height: 80px;
            border-radius: 18px;
            padding: 14px 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255, 241, 210, 0.08);
            color: var(--muted);
        }

        .feedback strong {
            display: block;
            color: var(--text);
            margin-bottom: 6px;
        }

        .mini-controls,
        .builder-controls {
            display: grid;
            gap: 12px;
        }

        .action-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        button {
            border: none;
            border-radius: 999px;
            padding: 12px 18px;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            color: #1b1314;
            background: linear-gradient(180deg, #f3d384, #d1a247);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.22);
            transition: transform 140ms ease, filter 140ms ease;
        }

        button:hover {
            transform: translateY(-1px);
            filter: brightness(1.04);
        }

        button.secondary {
            color: var(--text);
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255, 241, 210, 0.12);
            box-shadow: none;
        }

        .insight-list {
            display: grid;
            gap: 12px;
        }

        .insight {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255, 241, 210, 0.08);
        }

        .insight strong {
            display: block;
            margin-bottom: 4px;
        }

        .builder-shell {
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 18px;
            margin-top: 20px;
        }

        .builder-preview {
            padding: 16px;
            border-radius: 24px;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.04), transparent 42%),
                rgba(14, 10, 18, 0.72);
            border: 1px solid rgba(255, 241, 210, 0.08);
        }

        .crest {
            aspect-ratio: 1 / 1.05;
            border-radius: 34px 34px 28px 28px;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(16, 11, 16, 0.68);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.18);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.14), transparent 26%),
                linear-gradient(135deg, var(--crest-a, #7a2332), var(--crest-b, #17304f));
        }

        .crest::before,
        .crest::after {
            content: "";
            position: absolute;
            background: rgba(12, 9, 14, 0.8);
        }

        .crest::before {
            inset: 0 47.5% 0 47.5%;
        }

        .crest::after {
            inset: 47.5% 0 47.5% 0;
        }

        .crest-cell {
            position: absolute;
            width: 50%;
            height: 50%;
            display: grid;
            place-items: center;
            font-size: clamp(2.6rem, 8vw, 4rem);
            text-shadow: 0 8px 14px rgba(0,0,0,0.26);
        }

        .crest-cell.top-left { left: 0; top: 0; }
        .crest-cell.top-right { right: 0; top: 0; }
        .crest-cell.bottom-left { left: 0; bottom: 0; }
        .crest-cell.bottom-right { right: 0; bottom: 0; }

        .builder-note {
            margin-top: 14px;
            line-height: 1.7;
            color: var(--muted);
        }

        .select-grid {
            display: grid;
            gap: 12px;
        }

        .select-grid label {
            display: grid;
            gap: 6px;
            font-size: 0.92rem;
            color: var(--muted);
        }

        select,
        input[type="text"] {
            width: 100%;
            border-radius: 14px;
            border: 1px solid rgba(255, 241, 210, 0.12);
            background: rgba(255,255,255,0.05);
            color: var(--text);
            padding: 12px 14px;
            font: inherit;
        }

        .gallery {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .gallery-card {
            position: relative;
            border-radius: 22px;
            min-height: 190px;
            padding: 18px;
            overflow: hidden;
            border: 2px solid rgba(16, 11, 16, 0.66);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.16);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .gallery-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(135deg, rgba(255,255,255,0.24), transparent 32%),
                repeating-linear-gradient(45deg, rgba(255,255,255,0.08) 0 2px, transparent 2px 24px);
            mix-blend-mode: screen;
        }

        .gallery-top,
        .gallery-bottom {
            position: relative;
            z-index: 1;
        }

        .gallery-glyph {
            font-size: 2.8rem;
            margin-bottom: 16px;
        }

        .gallery-card h3 {
            font-size: 1.25rem;
            margin-bottom: 6px;
        }

        .gallery-card p {
            margin: 0;
            color: #fff6e8;
            line-height: 1.45;
        }

        .footer {
            margin-top: 22px;
            text-align: center;
            color: rgba(244, 234, 217, 0.72);
            font-size: 0.92rem;
        }

        .footer a {
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 241, 210, 0.28);
        }

        @media (max-width: 980px) {
            .hero-grid,
            .layout,
            .builder-shell {
                grid-template-columns: 1fr;
            }

            .hero-window {
                order: -1;
            }

            .gallery {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .page {
                width: min(100%, calc(100% - 18px));
                padding-top: 10px;
            }

            .hero,
            .panel {
                border-radius: 24px;
                padding: 18px;
            }

            .hero::before,
            .panel::before {
                inset: 10px;
            }

            .glass-tile {
                min-height: 126px;
            }

            .scorebar,
            .choices,
            .gallery {
                grid-template-columns: 1fr;
            }

            .quiz-symbol {
                min-height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Chloe Reads Jon • <?= htmlspecialchars($publishedDate, ENT_QUOTES) ?></div>
                    <h1>Stained Glass Symbol Hunt</h1>
                    <p class="lede">A jewel-toned decoder ring for the secret shorthand of Christian art. Test your eye, learn what the symbols mean, and build a tiny stained-glass crest of your own while you’re at it.</p>
                    <div class="meta-row">
                        <div class="pill">8 classic symbols</div>
                        <div class="pill">quiz + crest builder</div>
                        <div class="pill">mobile-friendly little art book</div>
                    </div>
                </div>
                <div class="hero-window" aria-hidden="true">
                    <div class="glass-tile tile-lamb">
                        <span class="glass-glyph">🐑</span>
                        <strong>Mercy made visible</strong>
                    </div>
                    <div class="glass-tile tile-anchor">
                        <span class="glass-glyph">⚓</span>
                        <strong>Hope that does not let go</strong>
                    </div>
                    <div class="glass-tile tile-fish">
                        <span class="glass-glyph">𓆟</span>
                        <strong>Faith hidden in plain sight</strong>
                    </div>
                    <div class="glass-tile tile-crown">
                        <span class="glass-glyph">👑</span>
                        <strong>A finish line for saints</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="layout">
            <div class="panel">
                <h2>Decode The Window</h2>
                <p class="subtle">Each round shows a symbol from Christian art. Pick the best meaning, then get the short version of why painters and stained-glass artists kept reaching for it.</p>
                <div class="scorebar">
                    <div class="score-card">
                        <div class="score-label">Score</div>
                        <div class="score-value" id="scoreValue">0</div>
                    </div>
                    <div class="score-card">
                        <div class="score-label">Round</div>
                        <div class="score-value" id="roundValue">1 / 8</div>
                    </div>
                    <div class="score-card">
                        <div class="score-label">Vibe</div>
                        <div class="score-value" id="vibeValue">Curious</div>
                    </div>
                </div>

                <div class="quiz-card">
                    <div class="quiz-top">
                        <div>
                            <div class="eyebrow">Mystery Panel</div>
                            <div class="quiz-name" id="symbolName">Lamb</div>
                        </div>
                        <div class="pill" id="hintPill">Hint: Gentle, white, offered, triumphant.</div>
                    </div>

                    <div class="quiz-symbol" id="quizSymbol">
                        <div class="quiz-glyph" id="quizGlyph">🐑</div>
                    </div>

                    <div class="choices" id="choices"></div>

                    <div class="feedback" id="feedback">
                        <strong>Welcome to symbol sleuthing.</strong>
                        Choose an answer and the window will gossip a little.
                    </div>

                    <div class="action-row">
                        <button id="nextButton" class="secondary" disabled>Next symbol</button>
                        <button id="restartButton" class="secondary">Restart quiz</button>
                    </div>
                </div>
            </div>

            <aside class="panel">
                <h2>Quick Eye Guides</h2>
                <p class="subtle">Christian art loves compact meaning. Once you know the code, a quiet corner of a painting starts talking back.</p>
                <div class="insight-list">
                    <div class="insight">
                        <strong>Animals are rarely just animals.</strong>
                        A lamb, pelican, or fish usually points beyond biology toward Christ, sacrifice, or hidden witness.
                    </div>
                    <div class="insight">
                        <strong>Objects become theology props.</strong>
                        Keys, anchors, crowns, and vines compress whole doctrines into one quick visual cue.
                    </div>
                    <div class="insight">
                        <strong>Context still matters.</strong>
                        The same symbol can lean royal, Eucharistic, or martyr-ish depending on what it’s paired with.
                    </div>
                </div>
            </aside>
        </section>

        <section class="panel" style="margin-top: 20px;">
            <h2>Build A Tiny Window</h2>
            <p class="subtle">Pick three symbols and a mood color. The crest below combines them into a short motto-like reading. Slightly devotional, slightly heraldic, fully ridiculous in the best way.</p>
            <div class="builder-shell">
                <div class="builder-preview">
                    <div class="crest" id="crest">
                        <div class="crest-cell top-left" id="crestCell1">🐑</div>
                        <div class="crest-cell top-right" id="crestCell2">⚓</div>
                        <div class="crest-cell bottom-left" id="crestCell3">🍇</div>
                        <div class="crest-cell bottom-right" id="crestCell4">✦</div>
                    </div>
                    <div class="builder-note" id="builderNote">Mercy, hope, and communion: a small window for someone trying to stay gentle without floating off into nonsense.</div>
                </div>

                <div class="builder-controls">
                    <div class="select-grid">
                        <label>
                            First symbol
                            <select id="symbolSelect1"></select>
                        </label>
                        <label>
                            Second symbol
                            <select id="symbolSelect2"></select>
                        </label>
                        <label>
                            Third symbol
                            <select id="symbolSelect3"></select>
                        </label>
                        <label>
                            Window mood
                            <select id="colorSelect">
                                <option value="ruby-navy">Ruby + Navy</option>
                                <option value="forest-gold">Forest + Gold</option>
                                <option value="violet-dawn">Violet + Dawn</option>
                                <option value="sea-copper">Sea + Copper</option>
                            </select>
                        </label>
                    </div>

                    <div class="action-row">
                        <button id="randomizeCrest">Randomize crest</button>
                        <button id="copyLine" class="secondary">Refresh reading</button>
                    </div>
                </div>
            </div>

            <div class="gallery" id="gallery"></div>
        </section>

        <div class="footer">
            Built for Jon’s web lab, inspired by a post about Christian art symbols.
            <a href="index.php">Back to the gallery</a>
        </div>
    </div>

    <script>
        const symbols = <?= json_encode($symbols, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

        const paletteModes = {
            'ruby-navy': ['#7a2332', '#17304f'],
            'forest-gold': ['#285847', '#c39a46'],
            'violet-dawn': ['#5d3d83', '#d48978'],
            'sea-copper': ['#17606d', '#bc6c43']
        };

        const choicePool = symbols.map((item) => item.meaning);
        let quizOrder = [];
        let quizIndex = 0;
        let quizScore = 0;
        let answered = false;

        const scoreValue = document.getElementById('scoreValue');
        const roundValue = document.getElementById('roundValue');
        const vibeValue = document.getElementById('vibeValue');
        const symbolName = document.getElementById('symbolName');
        const hintPill = document.getElementById('hintPill');
        const quizGlyph = document.getElementById('quizGlyph');
        const quizSymbol = document.getElementById('quizSymbol');
        const choices = document.getElementById('choices');
        const feedback = document.getElementById('feedback');
        const nextButton = document.getElementById('nextButton');
        const restartButton = document.getElementById('restartButton');

        const symbolSelect1 = document.getElementById('symbolSelect1');
        const symbolSelect2 = document.getElementById('symbolSelect2');
        const symbolSelect3 = document.getElementById('symbolSelect3');
        const colorSelect = document.getElementById('colorSelect');
        const crest = document.getElementById('crest');
        const crestCell1 = document.getElementById('crestCell1');
        const crestCell2 = document.getElementById('crestCell2');
        const crestCell3 = document.getElementById('crestCell3');
        const builderNote = document.getElementById('builderNote');
        const gallery = document.getElementById('gallery');

        function shuffle(list) {
            const copy = [...list];
            for (let i = copy.length - 1; i > 0; i -= 1) {
                const j = Math.floor(Math.random() * (i + 1));
                [copy[i], copy[j]] = [copy[j], copy[i]];
            }
            return copy;
        }

        function currentSymbol() {
            return quizOrder[quizIndex];
        }

        function vibeForScore() {
            const ratio = quizIndex === 0 ? 0 : quizScore / quizIndex;
            if (ratio === 1 && quizIndex > 0) return 'Icon whisperer';
            if (ratio >= 0.7) return 'Sharp-eyed';
            if (ratio >= 0.4) return 'Learning fast';
            return 'Curious';
        }

        function buildChoices(answer) {
            const distractors = shuffle(choicePool.filter((item) => item !== answer.meaning)).slice(0, 3);
            return shuffle([answer.meaning, ...distractors]);
        }

        function renderQuestion() {
            const item = currentSymbol();
            answered = false;
            nextButton.disabled = true;
            symbolName.textContent = item.name;
            hintPill.textContent = `Hint: ${item.hint}`;
            quizGlyph.textContent = item.glyph;
            quizSymbol.style.setProperty('--swatch', `linear-gradient(135deg, ${item.palette[0]}, ${item.palette[1]})`);
            roundValue.textContent = `${quizIndex + 1} / ${quizOrder.length}`;
            vibeValue.textContent = vibeForScore();
            choices.innerHTML = '';
            feedback.innerHTML = '<strong>Study the sign.</strong>Pick the reading that best fits the symbol.';

            buildChoices(item).forEach((meaning) => {
                const button = document.createElement('button');
                button.className = 'choice';
                button.type = 'button';
                button.textContent = meaning;
                button.addEventListener('click', () => handleChoice(button, meaning));
                choices.appendChild(button);
            });
        }

        function handleChoice(button, meaning) {
            if (answered) return;
            answered = true;
            const item = currentSymbol();
            const correct = meaning === item.meaning;
            if (correct) {
                quizScore += 1;
                button.classList.add('correct');
                feedback.innerHTML = `<strong>Correct.</strong>${item.detail}`;
            } else {
                button.classList.add('wrong');
                [...choices.children].forEach((choice) => {
                    if (choice.textContent === item.meaning) {
                        choice.classList.add('correct');
                    }
                });
                feedback.innerHTML = `<strong>Not quite.</strong>${item.name}: ${item.meaning}. ${item.detail}`;
            }

            [...choices.children].forEach((choice) => {
                choice.disabled = true;
            });

            scoreValue.textContent = String(quizScore);
            vibeValue.textContent = vibeForScore();
            nextButton.disabled = false;
        }

        function renderSummary() {
            const total = quizOrder.length;
            const crown = quizScore === total ? 'Full stained-glass menace.' : quizScore >= 6 ? 'Quite respectable.' : quizScore >= 3 ? 'Nicely underway.' : 'A humble beginning.';
            symbolName.textContent = 'Final reading';
            hintPill.textContent = 'Quiz complete';
            quizGlyph.textContent = '✦';
            quizSymbol.style.setProperty('--swatch', 'linear-gradient(135deg, #5d3d83, #c39a46)');
            choices.innerHTML = '';
            feedback.innerHTML = `<strong>${quizScore} out of ${total}.</strong>${crown} Scroll down, build a crest, and pretend you always knew what the pelican was doing.`;
            roundValue.textContent = `${total} / ${total}`;
            vibeValue.textContent = quizScore === total ? 'Window oracle' : vibeForScore();
            nextButton.disabled = true;
        }

        function nextQuestion() {
            if (!answered) return;
            quizIndex += 1;
            if (quizIndex >= quizOrder.length) {
                renderSummary();
                return;
            }
            renderQuestion();
        }

        function restartQuiz() {
            quizOrder = shuffle(symbols);
            quizIndex = 0;
            quizScore = 0;
            scoreValue.textContent = '0';
            renderQuestion();
        }

        function populateSelect(select, defaultId) {
            select.innerHTML = '';
            symbols.forEach((item) => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = `${item.glyph} ${item.name}`;
                if (item.id === defaultId) {
                    option.selected = true;
                }
                select.appendChild(option);
            });
        }

        function symbolById(id) {
            return symbols.find((item) => item.id === id) || symbols[0];
        }

        function composeReading(parts) {
            const joinedNames = parts.map((item) => item.name.toLowerCase()).join(', ');
            const keyWords = parts.map((item) => item.tags[0]).join(', ');
            const opening = [
                'A compact little sermon in colored light:',
                'This window reads like a pocket-sized homily:',
                'Heraldic verdict:'
            ][Math.floor(Math.random() * 3)];
            return `${opening} ${parts[0].meaning}, ${parts[1].meaning.toLowerCase()}, and ${parts[2].meaning.toLowerCase()}. In other words: ${joinedNames}, all conspiring toward ${keyWords}.`;
        }

        function updateCrest() {
            const first = symbolById(symbolSelect1.value);
            const second = symbolById(symbolSelect2.value);
            const third = symbolById(symbolSelect3.value);
            const colors = paletteModes[colorSelect.value];

            crest.style.setProperty('--crest-a', colors[0]);
            crest.style.setProperty('--crest-b', colors[1]);
            crestCell1.textContent = first.glyph;
            crestCell2.textContent = second.glyph;
            crestCell3.textContent = third.glyph;
            builderNote.textContent = composeReading([first, second, third]);
        }

        function randomizeCrest() {
            const picks = shuffle(symbols).slice(0, 3);
            symbolSelect1.value = picks[0].id;
            symbolSelect2.value = picks[1].id;
            symbolSelect3.value = picks[2].id;
            const moods = Object.keys(paletteModes);
            colorSelect.value = moods[Math.floor(Math.random() * moods.length)];
            updateCrest();
        }

        function renderGallery() {
            gallery.innerHTML = '';
            symbols.forEach((item) => {
                const card = document.createElement('article');
                card.className = 'gallery-card';
                card.style.background = `linear-gradient(135deg, ${item.palette[0]}, ${item.palette[1]})`;
                card.innerHTML = `
                    <div class="gallery-top">
                        <div class="gallery-glyph">${item.glyph}</div>
                        <h3>${item.name}</h3>
                        <p>${item.meaning}</p>
                    </div>
                    <div class="gallery-bottom">
                        <p>${item.detail}</p>
                    </div>
                `;
                gallery.appendChild(card);
            });
        }

        nextButton.addEventListener('click', nextQuestion);
        restartButton.addEventListener('click', restartQuiz);
        document.getElementById('randomizeCrest').addEventListener('click', randomizeCrest);
        document.getElementById('copyLine').addEventListener('click', updateCrest);
        [symbolSelect1, symbolSelect2, symbolSelect3, colorSelect].forEach((element) => {
            element.addEventListener('change', updateCrest);
        });

        populateSelect(symbolSelect1, 'lamb');
        populateSelect(symbolSelect2, 'anchor');
        populateSelect(symbolSelect3, 'vine');
        renderGallery();
        updateCrest();
        restartQuiz();
    </script>
</body>
</html>
