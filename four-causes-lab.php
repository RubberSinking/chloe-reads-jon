<?php
$postTitle = 'Final causes';
$postUrl = 'https://jona.ca/2014/08/final-causes.html';
$scenarios = [
    [
        'title' => 'Knight Rider Console',
        'hook' => 'A dashboard gets rebuilt for a tiny vigilante car with dramatic tastes.',
        'clues' => [
            ['text' => 'A tinkerer wiring the switches and lights into place', 'answer' => 'efficient'],
            ['text' => 'Plastic housings, wires, LEDs, and a microphone board', 'answer' => 'material'],
            ['text' => 'The layout that makes the panel recognizably a voice-and-light dashboard', 'answer' => 'formal'],
            ['text' => 'Helping a kid feel like the car is alive and ready for adventure', 'answer' => 'final'],
        ],
        'impediment' => 'A loose wire leaves the scanner dark, so the dashboard still has its plan but fails to bring the drama.',
        'reflection' => 'The end is not just "stuff happens." The work is aimed at a recognizable result: a dashboard fit for heroic nonsense.',
    ],
    [
        'title' => 'Lego Delivery Van',
        'hook' => 'You and Nathan are building a van sturdy enough for one more snack run.',
        'clues' => [
            ['text' => 'Hands snapping the bricks together in sequence', 'answer' => 'efficient'],
            ['text' => 'Bricks, axles, tiny wheels, and an annoyingly easy-to-lose windshield', 'answer' => 'material'],
            ['text' => 'The van-shaped arrangement that makes the parts one vehicle instead of a colorful accident', 'answer' => 'formal'],
            ['text' => 'Rolling across the floor to deliver imaginary treasure and crackers', 'answer' => 'final'],
        ],
        'impediment' => 'If the axle sits crooked, the van still "wants" to roll as a van, but the wobble keeps that ordinary end from landing cleanly.',
        'reflection' => 'Final causality shows up here as directedness. A van is assembled toward rolling cargo-bearing van-ness, not toward random brick loafhood.',
    ],
    [
        'title' => 'Bird Nest',
        'hook' => 'A robin keeps fussing over twigs with more architectural confidence than some startups.',
        'clues' => [
            ['text' => 'The robin arranging and pressing the twigs', 'answer' => 'efficient'],
            ['text' => 'Twigs, grass, mud, and soft scraps', 'answer' => 'material'],
            ['text' => 'The bowl-shaped nest structure that holds together as a nest', 'answer' => 'formal'],
            ['text' => 'Sheltering eggs and chicks', 'answer' => 'final'],
        ],
        'impediment' => 'A hard wind knocks the nest loose. The bird was still aiming at shelter, but an outside force interrupted the normal result.',
        'reflection' => 'Aquinas would nod here: natural causes usually hit their mark unless something weakens them or gets in the way.',
    ],
    [
        'title' => 'Split Keyboard Prototype',
        'hook' => 'A homemade ergonomic keyboard is trying to save a pair of wrists from melodrama.',
        'clues' => [
            ['text' => 'The builder cutting, wiring, and testing the halves', 'answer' => 'efficient'],
            ['text' => 'Key switches, microcontroller, case pieces, and cables', 'answer' => 'material'],
            ['text' => 'The staggered split layout that makes it this kind of keyboard', 'answer' => 'formal'],
            ['text' => 'Comfortable typing with less strain and more peace', 'answer' => 'final'],
        ],
        'impediment' => 'If the thumb cluster lands too far out, the keyboard keeps its intended purpose, but the design misses its practical target.',
        'reflection' => 'The final cause is not an optional afterthought. It is the reason the geometry and parts are chosen in the first place.',
    ],
    [
        'title' => 'Stained Glass Panel',
        'hook' => 'A church window is being assembled to throw colored light like a small, obedient miracle.',
        'clues' => [
            ['text' => 'The artisan cutting glass and soldering the lead', 'answer' => 'efficient'],
            ['text' => 'Glass pieces, lead came, solder, and frame', 'answer' => 'material'],
            ['text' => 'The saintly image and pattern that unify the panel', 'answer' => 'formal'],
            ['text' => 'Teaching, beautifying, and bathing the room in meaningful light', 'answer' => 'final'],
        ],
        'impediment' => 'If one panel bows and cracks, the window can fail despite being ordered toward beauty and instruction.',
        'reflection' => 'The final cause is what makes the whole craft legible. This is not just fused matter. It is matter ordered toward revelation and delight.',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Four Causes Lab</title>
    <style>
        :root {
            --bg: #0c111d;
            --bg-soft: #141d2f;
            --card: rgba(16, 23, 39, 0.78);
            --card-strong: rgba(245, 232, 205, 0.12);
            --ink: #f5efdf;
            --muted: #b8b0a0;
            --gold: #d5a44d;
            --coral: #f07f62;
            --teal: #67c1b8;
            --sky: #9dc6ff;
            --line: rgba(245, 239, 223, 0.13);
            --shadow: 0 24px 70px rgba(0, 0, 0, 0.35);
            --radius-xl: 32px;
            --radius-lg: 22px;
            --radius-md: 16px;
        }

        * { box-sizing: border-box; }

        html {
            min-height: 100%;
            background:
                radial-gradient(circle at top, rgba(103, 193, 184, 0.16), transparent 30%),
                radial-gradient(circle at 85% 18%, rgba(240, 127, 98, 0.14), transparent 22%),
                linear-gradient(180deg, #121a2c 0%, #0c111d 60%, #090d17 100%);
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Avenir Next", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.06), transparent 35%),
                repeating-linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.025) 0,
                    rgba(255, 255, 255, 0.025) 1px,
                    transparent 1px,
                    transparent 70px
                );
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.16;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.9) 0 1px, transparent 1px),
                radial-gradient(circle at 70% 20%, rgba(255, 255, 255, 0.8) 0 1px, transparent 1px),
                radial-gradient(circle at 80% 60%, rgba(255, 255, 255, 0.7) 0 1px, transparent 1px),
                radial-gradient(circle at 30% 75%, rgba(255, 255, 255, 0.75) 0 1px, transparent 1px);
            background-size: 220px 220px, 290px 290px, 320px 320px, 260px 260px;
        }

        a {
            color: inherit;
        }

        .page {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 56px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .topbar a {
            text-decoration: none;
            border-bottom: 1px solid rgba(245, 239, 223, 0.3);
            padding-bottom: 2px;
        }

        .hero,
        .panel {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(19, 28, 45, 0.94), rgba(11, 16, 28, 0.94));
            box-shadow: var(--shadow);
            backdrop-filter: blur(16px);
        }

        .hero {
            border-radius: var(--radius-xl);
            padding: 32px;
            display: grid;
            gap: 26px;
            grid-template-columns: minmax(0, 1.2fr) minmax(300px, 0.8fr);
            margin-bottom: 24px;
        }

        .hero::after,
        .panel::after {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(213, 164, 77, 0.16);
            border-radius: inherit;
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 14px;
        }

        .eyebrow::before,
        .eyebrow::after {
            content: "";
            width: 28px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(213, 164, 77, 0.9), transparent);
        }

        h1, h2, h3 {
            margin: 0;
            font-family: "Baskerville", "Iowan Old Style", "Palatino Linotype", "Book Antiqua", serif;
            font-weight: 700;
            line-height: 0.96;
        }

        h1 {
            font-size: clamp(3.2rem, 8vw, 6.3rem);
            letter-spacing: -0.045em;
            max-width: 8ch;
        }

        .hero-copy p {
            max-width: 58ch;
            font-size: 1.08rem;
            line-height: 1.65;
            color: var(--muted);
            margin: 18px 0 0;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .hero-links a,
        button {
            appearance: none;
            border: 0;
            cursor: pointer;
            font: inherit;
        }

        .chip-link,
        .control-button,
        .scenario-button,
        .type-chip,
        .mini-button {
            border-radius: 999px;
            transition: transform 180ms ease, background 180ms ease, border-color 180ms ease, color 180ms ease;
        }

        .chip-link,
        .control-button,
        .mini-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            text-decoration: none;
            color: var(--ink);
            border: 1px solid rgba(245, 239, 223, 0.14);
            background: rgba(255, 255, 255, 0.04);
        }

        .chip-link:hover,
        .control-button:hover,
        .scenario-button:hover,
        .type-chip:hover,
        .mini-button:hover {
            transform: translateY(-2px);
        }

        .chip-link.primary,
        .control-button.primary {
            background: linear-gradient(135deg, rgba(213, 164, 77, 0.95), rgba(240, 127, 98, 0.95));
            color: #1d1103;
            font-weight: 700;
        }

        .hero-meter {
            border-radius: 28px;
            border: 1px solid rgba(245, 239, 223, 0.08);
            padding: 22px;
            background:
                radial-gradient(circle at 50% 24%, rgba(213, 164, 77, 0.12), transparent 34%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.035), rgba(255, 255, 255, 0.015));
        }

        .constellation {
            position: relative;
            height: 300px;
            border-radius: 24px;
            border: 1px solid rgba(245, 239, 223, 0.1);
            background:
                radial-gradient(circle at 50% 50%, rgba(103, 193, 184, 0.16), transparent 28%),
                radial-gradient(circle at 50% 50%, rgba(213, 164, 77, 0.12), transparent 42%),
                linear-gradient(180deg, rgba(10, 15, 26, 0.84), rgba(10, 16, 29, 0.44));
            overflow: hidden;
        }

        .ring,
        .ring::before,
        .ring::after {
            position: absolute;
            inset: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }

        .ring {
            width: 210px;
            height: 210px;
            border: 1px solid rgba(157, 198, 255, 0.18);
            animation: slow-spin 34s linear infinite;
        }

        .ring::before {
            content: "";
            width: 146px;
            height: 146px;
            border: 1px dashed rgba(245, 239, 223, 0.14);
        }

        .ring::after {
            content: "";
            width: 278px;
            height: 278px;
            border: 1px solid rgba(240, 127, 98, 0.14);
        }

        .core-label {
            position: absolute;
            inset: 50% auto auto 50%;
            transform: translate(-50%, -50%);
            width: min(78%, 230px);
            text-align: center;
            padding: 18px 20px;
            border-radius: 24px;
            background: rgba(11, 16, 28, 0.82);
            border: 1px solid rgba(245, 239, 223, 0.1);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.32);
        }

        .core-label .small {
            display: block;
            font-size: 0.74rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .core-label strong {
            display: block;
            font-family: "Baskerville", "Iowan Old Style", "Palatino Linotype", "Book Antiqua", serif;
            font-size: 1.45rem;
            line-height: 1.1;
        }

        .star {
            position: absolute;
            width: 84px;
            padding: 10px 12px;
            border-radius: 18px;
            text-align: center;
            font-size: 0.78rem;
            background: rgba(8, 13, 23, 0.76);
            border: 1px solid rgba(245, 239, 223, 0.09);
            color: var(--muted);
            transition: transform 180ms ease, border-color 180ms ease, color 180ms ease, background 180ms ease;
        }

        .star.active {
            transform: scale(1.07);
            color: var(--ink);
            border-color: rgba(213, 164, 77, 0.35);
            background: rgba(213, 164, 77, 0.16);
        }

        .star.efficient { top: 10%; left: 18%; }
        .star.material { top: 58%; left: 10%; }
        .star.formal { top: 14%; right: 12%; }
        .star.final { top: 62%; right: 8%; }

        .summary-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .summary-card {
            border-radius: 20px;
            padding: 16px;
            border: 1px solid rgba(245, 239, 223, 0.09);
            background: rgba(255, 255, 255, 0.035);
        }

        .summary-card .label {
            font-size: 0.76rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 7px;
        }

        .summary-card strong {
            font-size: 1.2rem;
        }

        .workspace {
            display: grid;
            gap: 24px;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
            align-items: start;
        }

        .panel {
            border-radius: var(--radius-lg);
            padding: 26px;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 22px;
        }

        .panel-header p,
        .scenario-meta,
        .status-line,
        .guide-text,
        .reflection,
        .impediment-copy {
            color: var(--muted);
        }

        .scenario-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 18px;
        }

        .scenario-button {
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(245, 239, 223, 0.08);
            color: var(--ink);
            text-align: left;
            min-width: 130px;
        }

        .scenario-button.active {
            background: linear-gradient(135deg, rgba(213, 164, 77, 0.28), rgba(240, 127, 98, 0.24));
            border-color: rgba(213, 164, 77, 0.44);
        }

        .scenario-card {
            border-radius: 24px;
            padding: 20px;
            border: 1px solid rgba(245, 239, 223, 0.09);
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.015)),
                radial-gradient(circle at top right, rgba(157, 198, 255, 0.11), transparent 30%);
            margin-bottom: 20px;
        }

        .scenario-meta {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-top: 10px;
        }

        .type-palette {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        .type-chip {
            min-width: 150px;
            padding: 14px 16px;
            border: 1px solid rgba(245, 239, 223, 0.09);
            background: rgba(255, 255, 255, 0.035);
            color: var(--ink);
            text-align: left;
        }

        .type-chip span {
            display: block;
        }

        .type-chip .type-name {
            font-family: "Baskerville", "Iowan Old Style", "Palatino Linotype", "Book Antiqua", serif;
            font-size: 1.15rem;
            margin-bottom: 5px;
        }

        .type-chip .type-desc {
            color: var(--muted);
            font-size: 0.86rem;
            line-height: 1.35;
        }

        .type-chip[data-type="efficient"] { box-shadow: inset 0 0 0 1px rgba(240, 127, 98, 0.25); }
        .type-chip[data-type="material"] { box-shadow: inset 0 0 0 1px rgba(103, 193, 184, 0.25); }
        .type-chip[data-type="formal"] { box-shadow: inset 0 0 0 1px rgba(157, 198, 255, 0.24); }
        .type-chip[data-type="final"] { box-shadow: inset 0 0 0 1px rgba(213, 164, 77, 0.28); }
        .type-chip.selected {
            transform: translateY(-2px) scale(1.01);
            border-color: rgba(245, 239, 223, 0.3);
            background: rgba(255, 255, 255, 0.08);
        }

        .guide-text {
            margin: 0 0 14px;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .clue-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .clue-card {
            position: relative;
            min-height: 170px;
            padding: 18px;
            border-radius: 22px;
            border: 1px solid rgba(245, 239, 223, 0.09);
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.015)),
                radial-gradient(circle at top left, rgba(213, 164, 77, 0.09), transparent 38%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        .clue-card:hover {
            transform: translateY(-3px);
            border-color: rgba(245, 239, 223, 0.18);
        }

        .clue-card.assigned {
            border-color: rgba(245, 239, 223, 0.24);
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.02)),
                radial-gradient(circle at top left, rgba(245, 239, 223, 0.11), transparent 44%);
        }

        .clue-card.correct {
            border-color: rgba(103, 193, 184, 0.46);
            box-shadow: inset 0 0 0 1px rgba(103, 193, 184, 0.2);
        }

        .clue-card.incorrect {
            border-color: rgba(240, 127, 98, 0.46);
            box-shadow: inset 0 0 0 1px rgba(240, 127, 98, 0.22);
        }

        .clue-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(245, 239, 223, 0.6);
        }

        .clue-eyebrow::before {
            content: "";
            width: 16px;
            height: 1px;
            background: rgba(245, 239, 223, 0.4);
        }

        .clue-text {
            margin: 14px 0 18px;
            font-size: 1.02rem;
            line-height: 1.55;
        }

        .assignment-pill {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 54px;
            padding: 11px 14px;
            border-radius: 16px;
            border: 1px dashed rgba(245, 239, 223, 0.2);
            background: rgba(7, 10, 18, 0.45);
            font-size: 0.92rem;
        }

        .assignment-pill.filled {
            border-style: solid;
        }

        .assignment-pill button {
            background: transparent;
            color: rgba(245, 239, 223, 0.65);
            padding: 0;
            font-size: 1rem;
        }

        .assignment-pill[data-type="efficient"] { border-color: rgba(240, 127, 98, 0.42); color: #ffd2c6; }
        .assignment-pill[data-type="material"] { border-color: rgba(103, 193, 184, 0.42); color: #caefe9; }
        .assignment-pill[data-type="formal"] { border-color: rgba(157, 198, 255, 0.42); color: #d9e8ff; }
        .assignment-pill[data-type="final"] { border-color: rgba(213, 164, 77, 0.42); color: #ffe1ac; }

        .controls {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }

        .status-line {
            margin-top: 14px;
            min-height: 24px;
            font-size: 0.95rem;
        }

        .status-line strong {
            color: var(--ink);
        }

        .insight-stack {
            display: grid;
            gap: 16px;
        }

        .insight-card {
            border-radius: 22px;
            padding: 20px;
            border: 1px solid rgba(245, 239, 223, 0.08);
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.018));
        }

        .insight-card h3 {
            font-size: 1.5rem;
            margin-bottom: 8px;
        }

        .reflection,
        .impediment-copy {
            margin: 0;
            line-height: 1.65;
        }

        .impediment-meter {
            margin-top: 16px;
            height: 16px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.07);
            position: relative;
        }

        .impediment-fill,
        .telos-fill {
            height: 100%;
            border-radius: inherit;
            transition: width 320ms ease;
        }

        .impediment-fill {
            background: linear-gradient(90deg, rgba(240, 127, 98, 0.9), rgba(213, 164, 77, 0.9));
            width: 0%;
        }

        .telos-fill {
            position: absolute;
            inset: 0 auto 0 0;
            background: linear-gradient(90deg, rgba(103, 193, 184, 0.8), rgba(157, 198, 255, 0.8));
            width: 100%;
            mix-blend-mode: screen;
        }

        .mini-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .mini-button.active {
            background: rgba(240, 127, 98, 0.14);
            border-color: rgba(240, 127, 98, 0.32);
        }

        .footer-note {
            margin-top: 24px;
            color: rgba(245, 239, 223, 0.72);
            font-size: 0.92rem;
            line-height: 1.55;
        }

        @keyframes slow-spin {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @media (max-width: 980px) {
            .hero,
            .workspace {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 26px;
            }

            .summary-strip {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100% - 20px, 100%);
                padding-top: 18px;
            }

            .hero,
            .panel {
                padding: 20px;
                border-radius: 24px;
            }

            h1 {
                font-size: clamp(2.7rem, 16vw, 4.2rem);
            }

            .clue-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-links,
            .controls,
            .type-palette,
            .scenario-row,
            .mini-row {
                gap: 10px;
            }

            .type-chip,
            .scenario-button,
            .control-button,
            .mini-button {
                width: 100%;
            }

            .constellation {
                height: 250px;
            }

            .star {
                width: 72px;
                font-size: 0.72rem;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="topbar">
            <a href="./">Back to Chloe Reads Jon</a>
            <span>Inspired by Jon's <a href="<?php echo htmlspecialchars($postUrl, ENT_QUOTES); ?>"><?php echo htmlspecialchars($postTitle, ENT_QUOTES); ?></a></span>
        </div>

        <section class="hero">
            <div class="hero-copy">
                <div class="eyebrow">Scholastic Observatory</div>
                <h1>Four Causes Lab</h1>
                <p>
                    Aristotle thought change becomes intelligible when you ask four different questions at once:
                    who did it, what it is made of, what pattern makes it this thing, and what end it is ordered toward.
                    This little workshop turns that idea into a tactile matching game with a dash of Aquinas-style "impediment" mischief.
                </p>
                <div class="hero-links">
                    <a class="chip-link primary" href="<?php echo htmlspecialchars($postUrl, ENT_QUOTES); ?>">Read Jon's source post</a>
                    <a class="chip-link" href="#lab">Jump into the lab</a>
                </div>
            </div>

            <div class="hero-meter">
                <div class="constellation" aria-hidden="true">
                    <div class="ring"></div>
                    <div class="star efficient" data-star="efficient">Efficient</div>
                    <div class="star material" data-star="material">Material</div>
                    <div class="star formal" data-star="formal">Formal</div>
                    <div class="star final" data-star="final">Final</div>
                    <div class="core-label">
                        <span class="small">Current end in view</span>
                        <strong id="constellation-goal">Pick a scenario to reveal its telos</strong>
                    </div>
                </div>

                <div class="summary-strip">
                    <div class="summary-card">
                        <div class="label">Scenarios solved</div>
                        <strong id="solved-count">0 / <?php echo count($scenarios); ?></strong>
                    </div>
                    <div class="summary-card">
                        <div class="label">Current streak</div>
                        <strong id="streak-count">0</strong>
                    </div>
                    <div class="summary-card">
                        <div class="label">Mode</div>
                        <strong id="mode-label">Directed to an end</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="workspace" id="lab">
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <div class="eyebrow">Match The Questions</div>
                        <h2>Sort the clues by cause</h2>
                    </div>
                    <p>Tap a cause chip, then tap the clue it best explains. Mobile-friendly philosophy, because apparently that is where we are now.</p>
                </div>

                <div class="scenario-row" id="scenario-row"></div>

                <article class="scenario-card">
                    <h3 id="scenario-title"></h3>
                    <p class="scenario-meta" id="scenario-hook"></p>
                </article>

                <div class="type-palette" id="type-palette"></div>
                <p class="guide-text" id="guide-text">Choose a cause type, then assign it to each clue.</p>

                <div class="clue-grid" id="clue-grid"></div>

                <div class="controls">
                    <button class="control-button primary" id="check-button">Check my causes</button>
                    <button class="control-button" id="reset-button">Clear assignments</button>
                    <button class="control-button" id="reveal-button">Reveal Aristotle's map</button>
                </div>

                <div class="status-line" id="status-line" aria-live="polite"></div>
            </div>

            <div class="insight-stack">
                <div class="panel insight-card">
                    <div class="eyebrow">Final Cause Spotlight</div>
                    <h3 id="final-title">Waiting for a telos</h3>
                    <p class="reflection" id="reflection-copy">Solve a scenario and the lab will tell you why its final cause makes the rest of the explanation hang together.</p>
                </div>

                <div class="panel insight-card">
                    <div class="eyebrow">Impediment Machine</div>
                    <h3>Why ordinary outcomes can still fail</h3>
                    <p class="impediment-copy" id="impediment-copy">Aquinas says natural causes usually produce their effect unless something gets in the way. Pick a scenario, then flip on an impediment to watch the directedness remain even when the result gets blocked.</p>
                    <div class="impediment-meter" aria-hidden="true">
                        <div class="telos-fill"></div>
                        <div class="impediment-fill" id="impediment-fill"></div>
                    </div>
                    <div class="mini-row">
                        <button class="mini-button" id="impediment-off">No impediment</button>
                        <button class="mini-button" id="impediment-on">Introduce impediment</button>
                    </div>
                </div>

                <div class="panel insight-card">
                    <div class="eyebrow">Why This Matters</div>
                    <h3>More than "stuff happens"</h3>
                    <p class="footer-note">
                        If every efficient cause is aimed at something, then explanation is not just about pushing bits of matter around.
                        It is also about how a thing is intelligibly ordered. Jon's post pokes right at that deeper question, which is much more fun than pretending the universe is a pile of accidents in a trench coat.
                    </p>
                </div>
            </div>
        </section>
    </div>

    <script>
        const scenarios = <?php echo json_encode($scenarios, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
        const causeTypes = [
            { key: 'efficient', name: 'Efficient', desc: 'The agent or doer that brings about the change.' },
            { key: 'material', name: 'Material', desc: 'What the thing is made out of.' },
            { key: 'formal', name: 'Formal', desc: 'The structure or pattern that makes it this kind of thing.' },
            { key: 'final', name: 'Final', desc: 'The end or ordinary result it is directed toward.' }
        ];

        let currentScenarioIndex = 0;
        let selectedType = null;
        let assignments = {};
        let solved = new Set();
        let streak = 0;
        let impedimentOn = false;

        const scenarioRow = document.getElementById('scenario-row');
        const scenarioTitle = document.getElementById('scenario-title');
        const scenarioHook = document.getElementById('scenario-hook');
        const typePalette = document.getElementById('type-palette');
        const clueGrid = document.getElementById('clue-grid');
        const guideText = document.getElementById('guide-text');
        const statusLine = document.getElementById('status-line');
        const solvedCount = document.getElementById('solved-count');
        const streakCount = document.getElementById('streak-count');
        const finalTitle = document.getElementById('final-title');
        const reflectionCopy = document.getElementById('reflection-copy');
        const constellationGoal = document.getElementById('constellation-goal');
        const modeLabel = document.getElementById('mode-label');
        const impedimentCopy = document.getElementById('impediment-copy');
        const impedimentFill = document.getElementById('impediment-fill');
        const starNodes = Array.from(document.querySelectorAll('.star'));

        function renderScenarioTabs() {
            scenarioRow.innerHTML = '';
            scenarios.forEach((scenario, index) => {
                const button = document.createElement('button');
                button.className = 'scenario-button' + (index === currentScenarioIndex ? ' active' : '');
                button.textContent = scenario.title;
                button.addEventListener('click', () => switchScenario(index));
                scenarioRow.appendChild(button);
            });
        }

        function renderTypePalette() {
            typePalette.innerHTML = '';
            causeTypes.forEach((type) => {
                const chip = document.createElement('button');
                chip.className = 'type-chip' + (selectedType === type.key ? ' selected' : '');
                chip.dataset.type = type.key;
                chip.innerHTML = `<span class="type-name">${type.name}</span><span class="type-desc">${type.desc}</span>`;
                chip.addEventListener('click', () => {
                    selectedType = selectedType === type.key ? null : type.key;
                    guideText.textContent = selectedType
                        ? `Selected ${type.name}. Now tap the clue it best explains.`
                        : 'Choose a cause type, then assign it to each clue.';
                    renderTypePalette();
                });
                typePalette.appendChild(chip);
            });
        }

        function renderClues() {
            clueGrid.innerHTML = '';
            const scenario = scenarios[currentScenarioIndex];

            scenario.clues.forEach((clue, index) => {
                const assigned = assignments[index] || '';
                const card = document.createElement('button');
                card.className = 'clue-card' + (assigned ? ' assigned' : '');
                card.type = 'button';
                card.addEventListener('click', () => assignToClue(index));

                const verdict = statusLine.dataset.checked === 'true'
                    ? (assigned === clue.answer ? ' correct' : ' incorrect')
                    : '';
                if (verdict) {
                    card.className += verdict;
                }

                const label = assigned
                    ? causeTypes.find((type) => type.key === assigned).name
                    : 'Tap to assign';

                card.innerHTML = `
                    <div>
                        <div class="clue-eyebrow">Clue ${index + 1}</div>
                        <p class="clue-text">${clue.text}</p>
                    </div>
                    <div class="assignment-pill ${assigned ? 'filled' : ''}" data-type="${assigned}">
                        <span>${label}</span>
                        ${assigned ? `<button type="button" aria-label="Clear assignment for clue ${index + 1}" data-clear="${index}">×</button>` : ''}
                    </div>
                `;

                clueGrid.appendChild(card);
            });

            clueGrid.querySelectorAll('[data-clear]').forEach((button) => {
                button.addEventListener('click', (event) => {
                    event.stopPropagation();
                    const index = Number(button.dataset.clear);
                    delete assignments[index];
                    statusLine.dataset.checked = 'false';
                    statusLine.textContent = '';
                    renderClues();
                    updateStars();
                });
            });
        }

        function assignToClue(index) {
            if (!selectedType) {
                guideText.textContent = 'Choose one of the four causes first, then tap a clue.';
                return;
            }

            assignments[index] = selectedType;
            statusLine.dataset.checked = 'false';
            statusLine.textContent = '';
            renderClues();
            updateStars();
        }

        function switchScenario(index) {
            currentScenarioIndex = index;
            assignments = {};
            selectedType = null;
            impedimentOn = false;
            statusLine.dataset.checked = 'false';
            statusLine.textContent = '';
            renderScenarioTabs();
            renderTypePalette();
            renderScenario();
        }

        function renderScenario() {
            const scenario = scenarios[currentScenarioIndex];
            scenarioTitle.textContent = scenario.title;
            scenarioHook.textContent = scenario.hook;
            constellationGoal.textContent = scenario.clues.find((clue) => clue.answer === 'final').text;
            finalTitle.textContent = 'Waiting for a solved reading';
            reflectionCopy.textContent = 'Solve a scenario and the lab will tell you why its final cause makes the rest of the explanation hang together.';
            impedimentCopy.textContent = 'Aquinas says natural causes usually produce their effect unless something gets in the way. Pick a scenario, then flip on an impediment to watch the directedness remain even when the result gets blocked.';
            guideText.textContent = 'Choose a cause type, then assign it to each clue.';
            renderClues();
            updateStars();
            setImpediment(false);
        }

        function checkAnswers() {
            const scenario = scenarios[currentScenarioIndex];
            const filledCount = Object.keys(assignments).length;

            if (filledCount !== scenario.clues.length) {
                statusLine.dataset.checked = 'false';
                statusLine.innerHTML = '<strong>Not quite yet.</strong> Every clue needs one cause before the lab can judge your metaphysics.';
                return;
            }

            const allCorrect = scenario.clues.every((clue, index) => assignments[index] === clue.answer);
            statusLine.dataset.checked = 'true';

            if (allCorrect) {
                solved.add(currentScenarioIndex);
                streak += 1;
                solvedCount.textContent = `${solved.size} / ${scenarios.length}`;
                streakCount.textContent = String(streak);
                finalTitle.textContent = scenario.clues.find((clue) => clue.answer === 'final').text;
                reflectionCopy.textContent = scenario.reflection;
                impedimentCopy.textContent = scenario.impediment;
                statusLine.innerHTML = '<strong>Correct.</strong> The four questions lock together nicely here. Now try the impediment toggle to see how directedness can remain even when the expected result is blocked.';
            } else {
                streak = 0;
                streakCount.textContent = '0';
                statusLine.innerHTML = '<strong>Close, but one or more clues are off.</strong> The red cards show where the explanation got tangled.';
            }

            renderClues();
            updateStars();
        }

        function revealAnswers() {
            const scenario = scenarios[currentScenarioIndex];
            scenario.clues.forEach((clue, index) => {
                assignments[index] = clue.answer;
            });
            statusLine.dataset.checked = 'true';
            statusLine.innerHTML = '<strong>Revealed.</strong> Aristotle is merciful today. Study the map, then try another scenario.';
            renderClues();
            updateStars();
        }

        function resetAssignments() {
            assignments = {};
            selectedType = null;
            statusLine.dataset.checked = 'false';
            statusLine.textContent = '';
            guideText.textContent = 'Choose a cause type, then assign it to each clue.';
            renderTypePalette();
            renderClues();
            updateStars();
        }

        function updateStars() {
            const activeTypes = new Set(Object.values(assignments));
            starNodes.forEach((node) => {
                node.classList.toggle('active', activeTypes.has(node.dataset.star));
            });
        }

        function setImpediment(value) {
            impedimentOn = value;
            impedimentFill.style.width = impedimentOn ? '68%' : '0%';
            modeLabel.textContent = impedimentOn ? 'Impeded, not aimless' : 'Directed to an end';
            document.getElementById('impediment-on').classList.toggle('active', impedimentOn);
            document.getElementById('impediment-off').classList.toggle('active', !impedimentOn);
        }

        document.getElementById('check-button').addEventListener('click', checkAnswers);
        document.getElementById('reveal-button').addEventListener('click', revealAnswers);
        document.getElementById('reset-button').addEventListener('click', resetAssignments);
        document.getElementById('impediment-on').addEventListener('click', () => setImpediment(true));
        document.getElementById('impediment-off').addEventListener('click', () => setImpediment(false));

        renderScenarioTabs();
        renderTypePalette();
        renderScenario();
        solvedCount.textContent = `0 / ${scenarios.length}`;
        streakCount.textContent = '0';
    </script>
</body>
</html>
