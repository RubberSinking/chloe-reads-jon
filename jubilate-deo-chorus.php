<?php
declare(strict_types=1);

$sourceTitle = "Jubilate Deo: PDF of Minimum Repertoire of Gregorian Chant";
$sourceUrl = "https://cooltoolsforcatholics.blogspot.com/2010/10/jubilate-deo-pdf-of-minimum-repertoire.html";

$chantCards = [
    [
        "id" => "kyrie",
        "title" => "Kyrie",
        "latin" => "Kyrie eleison",
        "tag" => "Mercy spiral",
        "color" => "#8bd7ff",
        "glass" => "linear-gradient(180deg, rgba(139, 215, 255, 0.95), rgba(46, 101, 167, 0.95))",
        "blurb" => "Cool blue arcs, slow breath, and a plea that rises instead of panicking.",
        "pattern" => [0, 2, 4, 2, 5, 4, 2, 0],
        "steps" => ["breathe", "ask", "listen", "rest"],
    ],
    [
        "id" => "sanctus",
        "title" => "Sanctus",
        "latin" => "Sanctus, Sanctus, Sanctus",
        "tag" => "Gold ascent",
        "color" => "#ffd36a",
        "glass" => "linear-gradient(180deg, rgba(255, 211, 106, 0.96), rgba(179, 88, 28, 0.92))",
        "blurb" => "Three bright vaults of praise with enough brass in the light to feel ceremonial.",
        "pattern" => [1, 3, 5, 3, 6, 5, 3, 1],
        "steps" => ["lift", "shine", "echo", "bow"],
    ],
    [
        "id" => "agnus",
        "title" => "Agnus Dei",
        "latin" => "Agnus Dei",
        "tag" => "Rose gentleness",
        "color" => "#ff9fc1",
        "glass" => "linear-gradient(180deg, rgba(255, 159, 193, 0.96), rgba(146, 48, 96, 0.92))",
        "blurb" => "A softer lane for peace, with lamb-light and a little ache in the center.",
        "pattern" => [2, 4, 3, 1, 4, 3, 1, 0],
        "steps" => ["offer", "lean", "release", "peace"],
    ],
    [
        "id" => "salve",
        "title" => "Salve Regina",
        "latin" => "Salve Regina",
        "tag" => "Night procession",
        "color" => "#bfadff",
        "glass" => "linear-gradient(180deg, rgba(191, 173, 255, 0.96), rgba(74, 49, 154, 0.92))",
        "blurb" => "A lantern-lit evening route for tenderness, trust, and one last brave Alleluia-shaped look upward.",
        "pattern" => [0, 3, 2, 5, 4, 2, 3, 1],
        "steps" => ["gather", "glow", "carry", "home"],
    ],
];

$scenePrompts = [
    "Kitchen dawn before school",
    "Quiet walk after a hard day",
    "Tiny chapel with rainy windows",
    "Road trip sunset with Nathan asking questions",
    "A brave Monday that needs a little splendour",
];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jubilate Deo Chorus</title>
    <style>
        :root {
            --ink: #f7f2e6;
            --muted: #cfc5b0;
            --night: #120f19;
            --night-deep: #09070f;
            --panel: rgba(18, 15, 25, 0.82);
            --panel-strong: rgba(11, 10, 18, 0.9);
            --line: rgba(255, 240, 209, 0.16);
            --gold: #f2c76d;
            --gold-2: #e29e32;
            --blue: #8bd7ff;
            --rose: #ff9fc1;
            --lavender: #bfadff;
            --good: #9fe7b8;
            --shadow: 0 28px 70px rgba(0, 0, 0, 0.42);
        }

        * { box-sizing: border-box; }

        html { color-scheme: dark; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Avenir Next", "Trebuchet MS", sans-serif;
            background:
                radial-gradient(circle at 20% 18%, rgba(255, 211, 106, 0.12), transparent 24%),
                radial-gradient(circle at 82% 14%, rgba(139, 215, 255, 0.12), transparent 20%),
                radial-gradient(circle at 58% 84%, rgba(255, 159, 193, 0.1), transparent 28%),
                linear-gradient(180deg, #26192f 0%, #120f19 35%, #09070f 100%);
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
                linear-gradient(90deg, rgba(255,255,255,0.02) 0 1px, transparent 1px 100%),
                linear-gradient(180deg, rgba(255,255,255,0.018) 0 1px, transparent 1px 100%);
            background-size: 88px 88px;
            mask-image: radial-gradient(circle at center, black, transparent 88%);
            opacity: 0.28;
        }

        body::after {
            background:
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.55) 0 1px, transparent 1.3px),
                radial-gradient(circle at 72% 10%, rgba(255, 235, 177, 0.55) 0 1px, transparent 1.35px),
                radial-gradient(circle at 38% 75%, rgba(191, 173, 255, 0.45) 0 1px, transparent 1.4px),
                radial-gradient(circle at 85% 60%, rgba(139, 215, 255, 0.48) 0 1px, transparent 1.4px);
            opacity: 0.45;
        }

        a {
            color: #ffe9aa;
        }

        .page {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 26px 0 44px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            border: 1px solid var(--line);
            background:
                linear-gradient(145deg, rgba(255,255,255,0.06), rgba(255,255,255,0.015)),
                var(--panel);
            box-shadow: var(--shadow);
            padding: 30px;
            display: grid;
            grid-template-columns: minmax(0, 1.08fr) minmax(300px, 0.92fr);
            gap: 26px;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto auto -90px -90px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(255, 211, 106, 0.2), transparent 72%);
            filter: blur(10px);
        }

        .hero::after {
            content: "";
            position: absolute;
            top: -60px;
            right: -70px;
            width: 260px;
            height: 260px;
            background: radial-gradient(circle, rgba(139, 215, 255, 0.14), transparent 70%);
            filter: blur(10px);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 7px 13px;
            border-radius: 999px;
            border: 1px solid rgba(255, 233, 170, 0.18);
            background: rgba(255,255,255,0.04);
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 0.72rem;
        }

        .eyebrow::before {
            content: "";
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff6cf 0 32%, var(--gold) 33% 100%);
            box-shadow: 0 0 16px rgba(242, 199, 109, 0.8);
        }

        h1, h2, h3 {
            margin: 0;
            font-family: "Baskerville", "Palatino Linotype", "Book Antiqua", serif;
            letter-spacing: -0.03em;
        }

        h1 {
            margin-top: 18px;
            font-size: clamp(2.9rem, 7vw, 5.6rem);
            line-height: 0.92;
            max-width: 9ch;
        }

        .lede {
            max-width: 60ch;
            margin: 20px 0 26px;
            color: #f0e6d3;
            line-height: 1.72;
            font-size: 1.02rem;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-links a,
        button,
        .ghost {
            appearance: none;
            border: none;
            text-decoration: none;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        .hero-links a,
        button {
            border-radius: 999px;
            padding: 12px 18px;
            color: #1f1206;
            background: linear-gradient(135deg, #ffe8a1, #f2c76d);
            font-weight: 800;
            box-shadow: 0 12px 30px rgba(242, 199, 109, 0.2);
        }

        .ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.12);
            color: var(--ink);
            background: rgba(255,255,255,0.04);
            font-weight: 700;
        }

        .hero-links a:hover,
        button:hover,
        .ghost:hover {
            transform: translateY(-1px);
        }

        .cathedral {
            position: relative;
            min-height: 420px;
            display: grid;
            place-items: center;
            padding: 20px 4px 10px;
        }

        .window-frame {
            width: min(100%, 430px);
            aspect-ratio: 0.86;
            position: relative;
            filter: drop-shadow(0 24px 30px rgba(0, 0, 0, 0.3));
        }

        .window-shell {
            position: absolute;
            inset: 0;
            border-radius: 220px 220px 24px 24px / 300px 300px 24px 24px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.1), transparent 20%),
                linear-gradient(180deg, rgba(48, 30, 15, 0.85), rgba(18, 12, 6, 0.94));
            border: 8px solid rgba(43, 24, 10, 0.95);
            box-shadow:
                inset 0 0 0 2px rgba(255, 233, 170, 0.12),
                inset 0 -30px 80px rgba(0,0,0,0.35);
            overflow: hidden;
        }

        .tracery {
            position: absolute;
            inset: 8% 8% 12%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .glass {
            position: relative;
            border-radius: 999px 999px 18px 18px;
            background: var(--glass-fill, linear-gradient(180deg, rgba(255,255,255,0.7), rgba(255,255,255,0.2)));
            border: 3px solid rgba(53, 27, 10, 0.72);
            box-shadow:
                inset 0 0 28px rgba(255,255,255,0.22),
                inset 0 -18px 26px rgba(0,0,0,0.18);
            overflow: hidden;
        }

        .glass::before,
        .glass::after {
            content: "";
            position: absolute;
            inset: 0;
        }

        .glass::before {
            background:
                linear-gradient(135deg, rgba(255,255,255,0.35), transparent 28%),
                repeating-linear-gradient(45deg, rgba(255,255,255,0.08) 0 8px, transparent 8px 18px);
            mix-blend-mode: screen;
        }

        .glass::after {
            inset: auto 14% 12% 14%;
            height: 18%;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(255,255,255,0.55), transparent 72%);
        }

        .glass.center {
            transform: translateY(-10px) scale(1.04);
        }

        .hero-mini {
            position: absolute;
            inset: auto 26px 18px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 18px;
            border: 1px solid rgba(255, 240, 209, 0.14);
            background: rgba(12, 10, 16, 0.66);
            backdrop-filter: blur(8px);
        }

        .hero-mini strong {
            display: block;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .hero-mini span {
            font-size: 0.96rem;
        }

        .grid {
            display: grid;
            gap: 20px;
            margin-top: 22px;
            grid-template-columns: 1.15fr 0.85fr;
        }

        .stack {
            display: grid;
            gap: 20px;
        }

        .panel {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid var(--line);
            background:
                linear-gradient(145deg, rgba(255,255,255,0.05), rgba(255,255,255,0.015)),
                var(--panel);
            box-shadow: var(--shadow);
            padding: 24px;
        }

        .panel h2 {
            font-size: clamp(1.7rem, 3vw, 2.5rem);
            margin-bottom: 10px;
        }

        .sub {
            margin: 0 0 18px;
            color: var(--muted);
            line-height: 1.6;
        }

        .chant-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .chant-card {
            position: relative;
            border-radius: 22px;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, 0.09);
            background:
                linear-gradient(180deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02)),
                rgba(15, 12, 20, 0.74);
            min-height: 188px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease;
            cursor: pointer;
        }

        .chant-card:hover,
        .chant-card.active {
            transform: translateY(-2px);
            border-color: rgba(255, 233, 170, 0.28);
            box-shadow: 0 18px 28px rgba(0, 0, 0, 0.24);
        }

        .chant-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 14px;
            border-radius: 22px 0 0 22px;
            background: var(--accent, linear-gradient(180deg, #fff, #999));
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            align-self: flex-start;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            color: #f8edd3;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .latin {
            font-size: 1.05rem;
            color: #fff0c8;
            font-family: "Palatino Linotype", "Book Antiqua", serif;
        }

        .curve {
            display: flex;
            align-items: end;
            gap: 6px;
            min-height: 54px;
            margin-top: auto;
        }

        .curve span {
            flex: 1;
            border-radius: 12px 12px 4px 4px;
            background: linear-gradient(180deg, rgba(255,255,255,0.65), rgba(255,255,255,0.15));
            opacity: 0.8;
        }

        .mode-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: end;
            margin-bottom: 18px;
        }

        .score {
            display: grid;
            gap: 6px;
            justify-items: end;
            text-align: right;
        }

        .score strong {
            font-size: 0.75rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .score span {
            font-size: 1.15rem;
            font-weight: 800;
            color: #fff3cb;
        }

        .status {
            min-height: 54px;
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: #f2ead7;
            line-height: 1.5;
        }

        .timeline {
            display: flex;
            align-items: end;
            gap: 10px;
            min-height: 124px;
            padding: 20px 10px 12px;
            margin-top: 16px;
            border-radius: 24px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.02), rgba(0,0,0,0.18)),
                rgba(11, 10, 18, 0.8);
            border: 1px solid rgba(255,255,255,0.06);
        }

        .timeline .note {
            flex: 1;
            position: relative;
            border-radius: 18px 18px 6px 6px;
            background: linear-gradient(180deg, rgba(255, 233, 170, 0.88), rgba(226, 158, 50, 0.26));
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.18);
            transition: transform 160ms ease, opacity 160ms ease;
            opacity: 0.72;
        }

        .timeline .note.active {
            transform: translateY(-8px);
            opacity: 1;
            box-shadow:
                inset 0 0 0 1px rgba(255,255,255,0.22),
                0 0 24px rgba(255, 211, 106, 0.35);
        }

        .timeline .note::after {
            content: attr(data-step);
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -24px;
            color: var(--muted);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .keyboard {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 10px;
            margin-top: 30px;
        }

        .key {
            min-height: 116px;
            padding: 12px 8px 14px;
            border-radius: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.14), rgba(255,255,255,0.03)),
                rgba(17, 14, 23, 0.94);
            color: var(--ink);
            border: 1px solid rgba(255,255,255,0.08);
            display: grid;
            align-content: space-between;
            justify-items: center;
            font-weight: 800;
        }

        .key small {
            color: var(--muted);
            font-weight: 600;
            letter-spacing: 0.08em;
        }

        .key.playing,
        .key:active {
            background:
                linear-gradient(180deg, rgba(255, 233, 170, 0.28), rgba(226, 158, 50, 0.12)),
                rgba(17, 14, 23, 0.96);
            border-color: rgba(255, 233, 170, 0.24);
            transform: translateY(-2px);
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .button-row .ghost,
        .button-row button {
            min-width: 132px;
        }

        .studio {
            display: grid;
            gap: 16px;
        }

        .meter {
            padding: 16px;
            border-radius: 22px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.03);
        }

        .meter label {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.92rem;
            margin-bottom: 10px;
            color: #f1e5cf;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .scene-pill {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--ink);
            cursor: pointer;
        }

        .scene-pill.active {
            border-color: rgba(255, 233, 170, 0.24);
            background: rgba(255, 233, 170, 0.1);
        }

        .scripture-card {
            border-radius: 24px;
            padding: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.07), rgba(255,255,255,0.02)),
                rgba(9, 8, 14, 0.84);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .scripture-card h3 {
            font-size: 1.32rem;
            margin-bottom: 8px;
        }

        .lineup {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
        }

        .lineup span {
            padding: 8px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            color: #fff1c8;
            font-size: 0.84rem;
        }

        .footer-note {
            margin-top: 20px;
            color: var(--muted);
            line-height: 1.65;
            font-size: 0.94rem;
        }

        .footer-note a {
            color: #ffe5a0;
        }

        .tiny {
            margin-top: 18px;
            color: #b8ac94;
            font-size: 0.82rem;
            line-height: 1.6;
        }

        @media (max-width: 980px) {
            .hero,
            .grid {
                grid-template-columns: 1fr;
            }

            .cathedral {
                min-height: 360px;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100% - 18px, 100%);
                padding-top: 18px;
            }

            .hero,
            .panel {
                padding: 20px;
                border-radius: 24px;
            }

            .chant-grid {
                grid-template-columns: 1fr;
            }

            .keyboard {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .hero-mini {
                position: static;
                margin-top: 16px;
            }

            .timeline .note::after {
                font-size: 0.62rem;
                bottom: -22px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div>
                <div class="eyebrow">Minimum Repertoire, Maximum Glow</div>
                <h1>Jubilate Deo Chorus</h1>
                <p class="lede">
                    A stained-glass chant playground inspired by Jon's old discovery of <em>Jubilate Deo</em>. Pick a chant family, echo the melodic contour by ear, then spin up a tiny procession phrase for whatever kind of day you've landed in.
                </p>
                <div class="hero-links">
                    <a href="#echo-mode">Play Echo Mode</a>
                    <a class="ghost" href="#phrase-studio">Open Phrase Studio</a>
                    <a class="ghost" href="index.php">Back to Chloe Reads Jon</a>
                </div>
                <p class="footer-note">
                    Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>"><?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>.
                    This is a playful tribute, not a notation trainer, because even reverent things are allowed a little theatre.
                </p>
            </div>
            <div class="cathedral" aria-hidden="true">
                <div class="window-frame">
                    <div class="window-shell">
                        <div class="tracery" id="glassTracery"></div>
                    </div>
                </div>
                <div class="hero-mini">
                    <div>
                        <strong>Current chant</strong>
                        <span id="heroTitle">Kyrie</span>
                    </div>
                    <div>
                        <strong>Current mood</strong>
                        <span id="heroMood">Mercy spiral</span>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid">
            <div class="stack">
                <section class="panel">
                    <h2>Choose Your Window</h2>
                    <p class="sub">Each chant family shifts the color, the contour, and the little internal weather of the game. Pick the one that matches your spirit, or let Nathan pick the prettiest glass and call it theology by vibes.</p>
                    <div class="chant-grid" id="chantGrid">
                        <?php foreach ($chantCards as $index => $card): ?>
                            <article
                                class="chant-card<?= $index === 0 ? ' active' : '' ?>"
                                data-chant-id="<?= htmlspecialchars($card['id'], ENT_QUOTES) ?>"
                                data-pattern="<?= htmlspecialchars(json_encode($card['pattern'], JSON_THROW_ON_ERROR), ENT_QUOTES) ?>"
                                data-steps="<?= htmlspecialchars(json_encode($card['steps'], JSON_THROW_ON_ERROR), ENT_QUOTES) ?>"
                                data-title="<?= htmlspecialchars($card['title'], ENT_QUOTES) ?>"
                                data-latin="<?= htmlspecialchars($card['latin'], ENT_QUOTES) ?>"
                                data-tag="<?= htmlspecialchars($card['tag'], ENT_QUOTES) ?>"
                                data-color="<?= htmlspecialchars($card['color'], ENT_QUOTES) ?>"
                                data-glass="<?= htmlspecialchars($card['glass'], ENT_QUOTES) ?>"
                                style="--accent: <?= htmlspecialchars($card['glass'], ENT_QUOTES) ?>;"
                            >
                                <span class="tag"><?= htmlspecialchars($card['tag'], ENT_QUOTES) ?></span>
                                <h3><?= htmlspecialchars($card['title'], ENT_QUOTES) ?></h3>
                                <div class="latin"><?= htmlspecialchars($card['latin'], ENT_QUOTES) ?></div>
                                <p class="sub" style="margin: 0; color: #eaddc6;"><?= htmlspecialchars($card['blurb'], ENT_QUOTES) ?></p>
                                <div class="curve" aria-hidden="true">
                                    <?php foreach ($card['pattern'] as $step): ?>
                                        <span style="height: <?= 26 + ($step * 9) ?>px;"></span>
                                    <?php endforeach; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="panel" id="echo-mode">
                    <div class="mode-head">
                        <div>
                            <h2>Echo Mode</h2>
                            <p class="sub">Listen to the current contour, then answer it back on the little tone row. Your goal is not concert perfection. Your goal is to sound like a tiny choir of one who is trying, which is honestly most of life.</p>
                        </div>
                        <div class="score">
                            <strong>Streak</strong>
                            <span id="scoreValue">0</span>
                        </div>
                    </div>

                    <div class="status" id="statusBox">Tap <strong style="margin-left: 0.35em;">Play contour</strong> and echo what you hear.</div>

                    <div class="timeline" id="timeline" aria-hidden="true"></div>

                    <div class="button-row">
                        <button type="button" id="playPatternButton">Play contour</button>
                        <button type="button" id="checkButton">Check my echo</button>
                        <button type="button" class="ghost" id="clearButton">Clear notes</button>
                        <button type="button" class="ghost" id="newPatternButton">Shuffle contour</button>
                    </div>

                    <div class="keyboard" id="keyboard">
                        <?php foreach (["Do", "Re", "Mi", "Fa", "Sol", "La", "Ti"] as $keyIndex => $label): ?>
                            <button class="key" type="button" data-note="<?= $keyIndex ?>">
                                <span><?= htmlspecialchars($label, ENT_QUOTES) ?></span>
                                <small><?= $keyIndex + 1 ?></small>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>

            <div class="stack">
                <section class="panel" id="phrase-studio">
                    <h2>Phrase Studio</h2>
                    <p class="sub">Build a short chant-flavoured procession card for a real-life moment. It pairs a scene, an energy level, and the current chant family into a tiny line-up of verbs and a synthetic contour you can play back.</p>

                    <div class="studio">
                        <div class="meter">
                            <label for="liftRange"><span>Lift</span><strong id="liftValue">64%</strong></label>
                            <input id="liftRange" type="range" min="20" max="100" value="64">
                        </div>
                        <div class="meter">
                            <label for="calmRange"><span>Calm</span><strong id="calmValue">72%</strong></label>
                            <input id="calmRange" type="range" min="20" max="100" value="72">
                        </div>
                        <div class="meter">
                            <div style="margin-bottom: 10px; color: #f1e5cf;">Scene prompt</div>
                            <div class="pill-row" id="sceneRow">
                                <?php foreach ($scenePrompts as $index => $prompt): ?>
                                    <button type="button" class="scene-pill<?= $index === 0 ? ' active' : '' ?>" data-scene="<?= htmlspecialchars($prompt, ENT_QUOTES) ?>"><?= htmlspecialchars($prompt, ENT_QUOTES) ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="button-row">
                        <button type="button" id="generateBlessingButton">Generate procession card</button>
                        <button type="button" class="ghost" id="playBlessingButton">Play the card</button>
                    </div>

                    <div class="scripture-card" style="margin-top: 18px;">
                        <h3 id="blessingTitle">Kitchen dawn before school</h3>
                        <p class="sub" id="blessingText" style="margin-bottom: 0; color: #f4ebd8;">Start with a gentle rise, keep the line generous, and let the final cadence land like a hand on a shoulder rather than a trumpet at the gates.</p>
                        <div class="lineup" id="blessingLineup"></div>
                    </div>

                    <p class="tiny">
                        The generated card is intentionally poetic rather than technical. Gregorian chant already has enough people trying to over-explain it with diagrams and not enough people just enjoying the shimmer.
                    </p>
                </section>

                <section class="panel">
                    <h2>Why This Exists</h2>
                    <p class="sub">Jon’s post pointed to a “minimum repertoire” of chant worth knowing. So this page takes that idea and turns it into an approachable ritual toy: one part memory game, one part contemplative synthesizer, one part “what if liturgical form could be touched without becoming homework.”</p>
                    <div class="scripture-card">
                        <h3 id="detailTitle">Kyrie</h3>
                        <p class="sub" id="detailText" style="color: #eee0c7;">Cool blue arcs, slow breath, and a plea that rises instead of panicking.</p>
                        <div class="lineup" id="detailSteps"></div>
                    </div>
                    <p class="footer-note">
                        If you want the original pointer instead of my glowing nonsense, go read Jon’s
                        <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>"><?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>.
                    </p>
                </section>
            </div>
        </div>
    </div>

    <script>
        const chantCards = <?= json_encode($chantCards, JSON_THROW_ON_ERROR) ?>;
        const toneScale = [261.63, 293.66, 329.63, 349.23, 392.0, 440.0, 493.88];

        const chantGrid = document.getElementById('chantGrid');
        const heroTitle = document.getElementById('heroTitle');
        const heroMood = document.getElementById('heroMood');
        const detailTitle = document.getElementById('detailTitle');
        const detailText = document.getElementById('detailText');
        const detailSteps = document.getElementById('detailSteps');
        const glassTracery = document.getElementById('glassTracery');
        const timeline = document.getElementById('timeline');
        const statusBox = document.getElementById('statusBox');
        const keyboard = document.getElementById('keyboard');
        const scoreValue = document.getElementById('scoreValue');
        const playPatternButton = document.getElementById('playPatternButton');
        const newPatternButton = document.getElementById('newPatternButton');
        const clearButton = document.getElementById('clearButton');
        const checkButton = document.getElementById('checkButton');
        const liftRange = document.getElementById('liftRange');
        const calmRange = document.getElementById('calmRange');
        const liftValue = document.getElementById('liftValue');
        const calmValue = document.getElementById('calmValue');
        const sceneRow = document.getElementById('sceneRow');
        const blessingTitle = document.getElementById('blessingTitle');
        const blessingText = document.getElementById('blessingText');
        const blessingLineup = document.getElementById('blessingLineup');
        const generateBlessingButton = document.getElementById('generateBlessingButton');
        const playBlessingButton = document.getElementById('playBlessingButton');

        let currentChant = chantCards[0];
        let currentPattern = [...currentChant.pattern];
        let currentLabels = [...currentChant.steps];
        let playerPattern = [];
        let score = 0;
        let selectedScene = sceneRow.querySelector('.scene-pill').dataset.scene;
        let blessingPattern = [];
        let audioContext;

        function getAudioContext() {
            if (!audioContext) {
                audioContext = new (window.AudioContext || window.webkitAudioContext)();
            }
            return audioContext;
        }

        function playTone(noteIndex, duration = 0.28) {
            const ctx = getAudioContext();
            const now = ctx.currentTime;
            const oscillator = ctx.createOscillator();
            const gain = ctx.createGain();
            oscillator.type = 'triangle';
            oscillator.frequency.value = toneScale[noteIndex] || toneScale[0];
            gain.gain.setValueAtTime(0.0001, now);
            gain.gain.exponentialRampToValueAtTime(0.09, now + 0.03);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + duration);
            oscillator.connect(gain);
            gain.connect(ctx.destination);
            oscillator.start(now);
            oscillator.stop(now + duration + 0.02);
        }

        function flashKey(noteIndex) {
            const key = keyboard.querySelector(`[data-note="${noteIndex}"]`);
            if (!key) {
                return;
            }
            key.classList.add('playing');
            window.setTimeout(() => key.classList.remove('playing'), 220);
        }

        function setStatus(html) {
            statusBox.innerHTML = html;
        }

        function renderWindow(card) {
            glassTracery.innerHTML = '';
            const heights = [0.75, 1, 0.82, 0.92, 1.1, 0.95];
            heights.forEach((ratio, index) => {
                const pane = document.createElement('div');
                pane.className = 'glass' + (index === 1 || index === 4 ? ' center' : '');
                pane.style.setProperty('--glass-fill', card.glass);
                pane.style.transform = `${pane.className.includes('center') ? 'translateY(-10px) scale(1.04)' : ''} scaleY(${ratio})`;
                glassTracery.appendChild(pane);
            });
        }

        function renderDetail(card) {
            heroTitle.textContent = card.title;
            heroMood.textContent = card.tag;
            detailTitle.textContent = card.title + ' · ' + card.latin;
            detailText.textContent = card.blurb;
            detailSteps.innerHTML = card.steps.map(step => `<span>${escapeHtml(step)}</span>`).join('');
        }

        function renderTimeline(pattern, labels, activeIndex = -1) {
            timeline.innerHTML = pattern.map((note, index) => {
                const height = 34 + (note * 11);
                const active = index === activeIndex ? ' active' : '';
                const label = labels[index % labels.length] || 'echo';
                return `<div class="note${active}" style="height:${height}px" data-step="${escapeHtml(label)}"></div>`;
            }).join('');
        }

        function setActiveCard(cardId) {
            const card = chantCards.find(item => item.id === cardId) || chantCards[0];
            currentChant = card;
            currentPattern = [...card.pattern];
            currentLabels = [...card.steps];
            playerPattern = [];
            document.querySelectorAll('.chant-card').forEach(node => {
                node.classList.toggle('active', node.dataset.chantId === card.id);
            });
            renderWindow(card);
            renderDetail(card);
            renderTimeline(currentPattern, currentLabels);
            setStatus(`Loaded <strong style="margin:0 0.35em;">${escapeHtml(card.title)}</strong>. Tap play, then answer it back note by note.`);
            buildBlessing();
        }

        async function playPattern(pattern, labels) {
            renderTimeline(pattern, labels);
            for (let i = 0; i < pattern.length; i += 1) {
                renderTimeline(pattern, labels, i);
                flashKey(pattern[i]);
                playTone(pattern[i], 0.24);
                await delay(360);
            }
            renderTimeline(pattern, labels);
        }

        function delay(ms) {
            return new Promise(resolve => window.setTimeout(resolve, ms));
        }

        function shufflePattern() {
            const seed = [...currentChant.pattern];
            currentPattern = seed.map((note, index) => {
                const drift = (index % 2 === 0 ? 1 : -1) * Math.floor(Math.random() * 2);
                return clamp(note + drift, 0, toneScale.length - 1);
            });
            currentLabels = [...currentChant.steps, ...currentChant.steps].slice(0, currentPattern.length);
            playerPattern = [];
            renderTimeline(currentPattern, currentLabels);
            setStatus(`Fresh contour prepared for <strong style="margin:0 0.35em;">${escapeHtml(currentChant.title)}</strong>. Same window, new path.`);
        }

        function clamp(value, min, max) {
            return Math.max(min, Math.min(max, value));
        }

        function addPlayerNote(noteIndex) {
            if (playerPattern.length >= currentPattern.length) {
                playerPattern = [];
            }
            playerPattern.push(noteIndex);
            flashKey(noteIndex);
            playTone(noteIndex, 0.22);
            renderTimeline(playerPattern, currentLabels.concat(currentLabels).slice(0, playerPattern.length), playerPattern.length - 1);
            const remaining = currentPattern.length - playerPattern.length;
            setStatus(remaining > 0
                ? `Recorded <strong style="margin:0 0.35em;">${playerPattern.length}</strong> notes. ${remaining} to go.`
                : `Sequence full. Tap <strong style="margin:0 0.35em;">Check my echo</strong> and let the cathedral judges squint thoughtfully.`);
        }

        function comparePatterns() {
            if (playerPattern.length !== currentPattern.length) {
                setStatus(`You have <strong style="margin:0 0.35em;">${playerPattern.length}</strong> notes, but the contour needs <strong style="margin:0 0.35em;">${currentPattern.length}</strong>. Nearly there.`);
                return;
            }

            const matches = playerPattern.filter((note, index) => note === currentPattern[index]).length;
            const perfect = matches === currentPattern.length;

            if (perfect) {
                score += 1;
                scoreValue.textContent = String(score);
                setStatus(`Beautiful. You echoed <strong style="margin:0 0.35em;">${escapeHtml(currentChant.title)}</strong> perfectly. Quite annoyingly impressive, honestly.`);
                shufflePattern();
                return;
            }

            score = 0;
            scoreValue.textContent = '0';
            setStatus(`Close, but the line bent in <strong style="margin:0 0.35em;">${matches}</strong> of <strong style="margin:0 0.35em;">${currentPattern.length}</strong> places. Try again with more float and less panic.`);
            renderTimeline(currentPattern, currentLabels);
        }

        function updateMeters() {
            liftValue.textContent = `${liftRange.value}%`;
            calmValue.textContent = `${calmRange.value}%`;
        }

        function buildBlessing() {
            updateMeters();
            const lift = Number(liftRange.value);
            const calm = Number(calmRange.value);
            const base = [...currentChant.pattern];
            blessingPattern = base.map((note, index) => {
                const arch = index < 4 ? Math.round((lift - 50) / 22) : -Math.round((calm - 50) / 26);
                return clamp(note + arch + (index % 3 === 0 ? 1 : 0), 0, toneScale.length - 1);
            });

            const verbs = [
                currentChant.steps[0],
                lift > 70 ? 'lift' : 'steady',
                calm > 70 ? 'soothe' : 'carry',
                currentChant.steps[currentChant.steps.length - 1],
            ];

            blessingTitle.textContent = selectedScene;
            blessingText.textContent = `${currentChant.title} frames this moment with ${lift > calm ? 'a brighter upward sweep' : 'a softer closing descent'}. Let the line ${verbs[0]}, then ${verbs[1]}, then ${verbs[2]}, and finally ${verbs[3]}.`;
            blessingLineup.innerHTML = verbs.map(step => `<span>${escapeHtml(step)}</span>`).join('');
        }

        function escapeHtml(value) {
            return String(value)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#39;');
        }

        chantGrid.addEventListener('click', (event) => {
            const card = event.target.closest('.chant-card');
            if (!card) {
                return;
            }
            setActiveCard(card.dataset.chantId);
        });

        keyboard.addEventListener('click', (event) => {
            const key = event.target.closest('.key');
            if (!key) {
                return;
            }
            addPlayerNote(Number(key.dataset.note));
        });

        sceneRow.addEventListener('click', (event) => {
            const pill = event.target.closest('.scene-pill');
            if (!pill) {
                return;
            }
            selectedScene = pill.dataset.scene;
            sceneRow.querySelectorAll('.scene-pill').forEach(node => node.classList.toggle('active', node === pill));
            buildBlessing();
        });

        playPatternButton.addEventListener('click', () => playPattern(currentPattern, currentLabels));
        newPatternButton.addEventListener('click', shufflePattern);
        clearButton.addEventListener('click', () => {
            playerPattern = [];
            renderTimeline(currentPattern, currentLabels);
            setStatus('Player notes cleared. The choir forgives you and also expects better.');
        });
        checkButton.addEventListener('click', comparePatterns);
        liftRange.addEventListener('input', buildBlessing);
        calmRange.addEventListener('input', buildBlessing);
        generateBlessingButton.addEventListener('click', buildBlessing);
        playBlessingButton.addEventListener('click', () => playPattern(blessingPattern, ['rise', 'glow', 'carry', 'rest']));

        renderWindow(currentChant);
        renderDetail(currentChant);
        renderTimeline(currentPattern, currentLabels);
        buildBlessing();
    </script>
</body>
</html>
