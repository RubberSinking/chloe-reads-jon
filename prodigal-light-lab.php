<?php
$roles = [
    [
        'id' => 'father',
        'name' => 'The Father',
        'tag' => 'Mercy',
        'prompt' => 'Hands first. He is not interrogating. He is receiving.',
        'detail' => 'The father is the calm center of the whole scene. His stance is stable, his face is quiet, and his hands do the talking: one broad and protective, one tender and searching.',
        'color' => '#f3c987',
        'x' => 56,
        'y' => 49,
        'w' => 21,
        'h' => 38,
    ],
    [
        'id' => 'son',
        'name' => 'The Prodigal Son',
        'tag' => 'Return',
        'prompt' => 'Look for collapse rather than performance. He arrives with nothing left to stage.',
        'detail' => 'The son is almost all surrender: shaved head, worn clothes, bent posture, no heroic angle. He is not posing as sorry. He is simply home and spent.',
        'color' => '#c85f50',
        'x' => 45,
        'y' => 61,
        'w' => 18,
        'h' => 23,
    ],
    [
        'id' => 'elder',
        'name' => 'The Elder Brother',
        'tag' => 'Distance',
        'prompt' => 'Jon noticed him peeking around the column. Once you spot him, the whole painting gets more complicated.',
        'detail' => 'The elder brother is not in the embrace. He watches from the edge, vertical and reserved, close enough to witness grace and still emotionally far from it.',
        'color' => '#9ec5d6',
        'x' => 68,
        'y' => 20,
        'w' => 12,
        'h' => 29,
    ],
    [
        'id' => 'witnesses',
        'name' => 'The Witnesses',
        'tag' => 'Silence',
        'prompt' => 'Notice how many people are present and how little noise the scene makes.',
        'detail' => 'The background figures keep the moment from feeling private or sentimental. Mercy here is social, visible, and somehow still intimate.',
        'color' => '#8cbf8b',
        'x' => 21,
        'y' => 27,
        'w' => 21,
        'h' => 33,
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodigal Light Lab</title>
    <style>
        :root {
            --ink: #1a130e;
            --paper: #eadac1;
            --paper-deep: #d9bf96;
            --wine: #6e2c27;
            --wine-bright: #a44639;
            --gold: #f1c883;
            --gold-strong: #ffdd9c;
            --sage: #86997f;
            --slate: #8eb3c0;
            --shadow: rgba(5, 3, 2, 0.75);
            --panel: rgba(29, 20, 14, 0.76);
            --panel-soft: rgba(58, 40, 30, 0.56);
            --line: rgba(255, 231, 191, 0.16);
            --active: #f1c883;
            --focusX: 56%;
            --focusY: 56%;
            --focusColor: rgba(241, 200, 131, 0.22);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Palatino Linotype", "Book Antiqua", Baskerville, serif;
            color: var(--paper);
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 220, 161, 0.08), transparent 28%),
                radial-gradient(circle at 82% 18%, rgba(168, 72, 57, 0.14), transparent 25%),
                linear-gradient(180deg, #2b1610 0%, #140d09 38%, #090705 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                repeating-linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.018) 0 1px,
                    transparent 1px 3px
                ),
                repeating-linear-gradient(
                    0deg,
                    rgba(255, 255, 255, 0.016) 0 1px,
                    transparent 1px 4px
                );
            mix-blend-mode: soft-light;
            opacity: 0.35;
            pointer-events: none;
        }

        a {
            color: var(--gold);
            text-decoration-thickness: 1px;
            text-underline-offset: 0.2em;
        }

        .page {
            width: min(1160px, calc(100% - 28px));
            margin: 0 auto;
            padding: 24px 0 48px;
        }

        .masthead {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(300px, 0.85fr);
            gap: 24px;
            align-items: end;
            padding: 18px 8px 22px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border: 1px solid var(--line);
            border-radius: 999px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-size: 0.68rem;
            background: rgba(255, 242, 219, 0.05);
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2.9rem, 7vw, 5.9rem);
            line-height: 0.9;
            letter-spacing: -0.05em;
            font-weight: 700;
            color: #f8e7c4;
            text-wrap: balance;
        }

        .dek {
            max-width: 34rem;
            font-size: 1.06rem;
            line-height: 1.7;
            color: rgba(243, 225, 194, 0.9);
            margin: 0;
        }

        .masthead-card {
            position: relative;
            padding: 22px;
            background: linear-gradient(180deg, rgba(255, 241, 214, 0.08), rgba(255, 241, 214, 0.02));
            border: 1px solid var(--line);
            border-radius: 28px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.28);
        }

        .masthead-card::after {
            content: "";
            position: absolute;
            inset: 12px;
            border: 1px solid rgba(255, 229, 181, 0.12);
            border-radius: 20px;
            pointer-events: none;
        }

        .mini-label {
            font-size: 0.72rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(255, 226, 182, 0.76);
        }

        .quote {
            margin: 14px 0 12px;
            font-size: 1.18rem;
            line-height: 1.5;
            color: #fde8bc;
        }

        .quote-credit {
            margin: 0;
            color: rgba(238, 214, 173, 0.72);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .frame {
            position: relative;
            margin-top: 18px;
            padding: 18px;
            border-radius: 34px;
            background:
                linear-gradient(145deg, rgba(235, 196, 120, 0.11), rgba(118, 56, 29, 0.18)),
                rgba(17, 11, 8, 0.88);
            box-shadow:
                inset 0 0 0 1px rgba(255, 226, 176, 0.12),
                0 26px 70px rgba(0, 0, 0, 0.38);
        }

        .frame::before {
            content: "";
            position: absolute;
            inset: 10px;
            border-radius: 24px;
            border: 1px solid rgba(255, 226, 176, 0.12);
            pointer-events: none;
        }

        .gallery {
            display: grid;
            grid-template-columns: minmax(0, 1.3fr) minmax(300px, 0.7fr);
            gap: 24px;
            align-items: start;
        }

        .painting {
            position: relative;
            aspect-ratio: 16 / 11;
            border-radius: 22px;
            overflow: hidden;
            background:
                radial-gradient(circle at var(--focusX) var(--focusY), var(--focusColor) 0, transparent 21%),
                radial-gradient(circle at 57% 55%, rgba(255, 225, 150, 0.26), transparent 22%),
                radial-gradient(circle at 26% 38%, rgba(92, 45, 28, 0.56), transparent 21%),
                linear-gradient(180deg, #5b3422 0%, #2c180f 42%, #16100c 100%);
            box-shadow: inset 0 -40px 120px rgba(0, 0, 0, 0.55);
        }

        .painting::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 53% 52%, rgba(255, 233, 163, 0.24), transparent 20%),
                linear-gradient(90deg, transparent 0 12%, rgba(14, 9, 7, 0.5) 12% 20%, transparent 20% 100%);
            pointer-events: none;
        }

        .painting::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.05), transparent 22%),
                radial-gradient(circle at 50% 50%, transparent 50%, rgba(0,0,0,0.45) 100%);
            pointer-events: none;
        }

        .column {
            position: absolute;
            right: 18%;
            top: 8%;
            width: 8%;
            height: 66%;
            border-radius: 12px;
            background: linear-gradient(180deg, rgba(72, 38, 24, 0.84), rgba(20, 11, 8, 0.96));
            box-shadow: inset 1px 0 0 rgba(255, 228, 183, 0.08);
        }

        .halo {
            position: absolute;
            left: 48%;
            top: 38%;
            width: 27%;
            height: 41%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 225, 161, 0.18), transparent 68%);
            filter: blur(6px);
            pointer-events: none;
        }

        .figure {
            position: absolute;
            border-radius: 999px 999px 24px 24px;
            background: linear-gradient(180deg, rgba(38, 19, 14, 0.8), rgba(11, 7, 5, 0.96));
            opacity: 0.78;
            transform-origin: bottom center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .figure.father {
            left: 53%;
            top: 34%;
            width: 12%;
            height: 42%;
            transform: translateX(-50%);
        }

        .figure.son {
            left: 46%;
            top: 54%;
            width: 13%;
            height: 24%;
            transform: rotate(18deg);
            border-radius: 55% 60% 32px 32px;
        }

        .figure.elder {
            left: 70%;
            top: 18%;
            width: 8%;
            height: 34%;
            opacity: 0.62;
        }

        .figure.witness-a {
            left: 23%;
            top: 25%;
            width: 11%;
            height: 29%;
            opacity: 0.5;
        }

        .figure.witness-b {
            left: 33%;
            top: 36%;
            width: 9%;
            height: 22%;
            opacity: 0.44;
        }

        .zone {
            position: absolute;
            border: 1px solid transparent;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255, 241, 214, 0.04), rgba(255, 241, 214, 0));
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .zone:hover,
        .zone:focus-visible {
            border-color: rgba(255, 220, 161, 0.62);
            background: linear-gradient(180deg, rgba(255, 241, 214, 0.12), rgba(255, 241, 214, 0.02));
            box-shadow: inset 0 0 0 1px rgba(255, 238, 206, 0.12), 0 0 0 1px rgba(255, 214, 138, 0.12);
            transform: scale(1.02);
            outline: none;
        }

        .zone.active {
            border-color: rgba(255, 214, 138, 0.9);
            box-shadow: inset 0 0 0 1px rgba(255, 240, 214, 0.16), 0 0 40px rgba(255, 209, 122, 0.12);
        }

        .zone-label {
            position: absolute;
            left: 12px;
            bottom: 10px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #ffe9be;
            background: rgba(20, 12, 8, 0.66);
            border: 1px solid rgba(255, 218, 154, 0.18);
        }

        .side-panel {
            display: grid;
            gap: 18px;
        }

        .panel {
            padding: 18px;
            border-radius: 22px;
            background: var(--panel);
            border: 1px solid var(--line);
            box-shadow: 0 18px 48px rgba(0, 0, 0, 0.22);
        }

        .panel h2,
        .panel h3 {
            margin: 0 0 10px;
            font-size: 1.12rem;
            color: #fbe7bc;
        }

        .panel p {
            margin: 0;
            color: rgba(239, 222, 191, 0.88);
            line-height: 1.6;
            font-size: 0.98rem;
        }

        .role-tag {
            display: inline-flex;
            margin-bottom: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(255, 226, 176, 0.16);
            background: rgba(255, 241, 214, 0.05);
            color: #ffe2ab;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.72rem;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .role-chip {
            position: relative;
            text-align: left;
            padding: 14px 14px 16px;
            border-radius: 18px;
            border: 1px solid rgba(255, 227, 186, 0.12);
            color: var(--paper);
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.01));
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        .role-chip:hover,
        .role-chip:focus-visible {
            transform: translateY(-2px);
            border-color: rgba(255, 220, 161, 0.42);
            outline: none;
        }

        .role-chip.active {
            background: linear-gradient(180deg, rgba(255, 233, 196, 0.11), rgba(255, 233, 196, 0.03));
            border-color: rgba(255, 218, 154, 0.66);
        }

        .role-chip strong {
            display: block;
            margin-bottom: 4px;
            font-size: 1rem;
            color: #fff3d0;
        }

        .role-chip span {
            display: block;
            font-size: 0.84rem;
            line-height: 1.45;
            color: rgba(238, 219, 189, 0.78);
        }

        .studio {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 24px;
            margin-top: 24px;
        }

        .slider-wrap + .slider-wrap {
            margin-top: 18px;
        }

        .slider-label {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 12px;
            margin-bottom: 8px;
            font-size: 0.92rem;
            color: #f5dfb2;
        }

        input[type="range"] {
            width: 100%;
            appearance: none;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(255, 226, 176, 0.18), rgba(164, 70, 57, 0.36));
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ffe5b6;
            border: 2px solid #6e2c27;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
        }

        input[type="range"]::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #ffe5b6;
            border: 2px solid #6e2c27;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
        }

        .insight-card {
            min-height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
            padding: 22px;
            border-radius: 24px;
            background:
                linear-gradient(160deg, rgba(255, 229, 181, 0.12), rgba(130, 59, 40, 0.14) 40%, rgba(26, 17, 12, 0.72)),
                rgba(26, 17, 12, 0.86);
            border: 1px solid rgba(255, 223, 176, 0.18);
        }

        .insight-card .big-line {
            font-size: clamp(1.45rem, 3vw, 2.2rem);
            line-height: 1.15;
            color: #fff0cc;
            margin: 0;
        }

        .insight-card .sub-line {
            margin: 0;
            color: rgba(245, 226, 194, 0.78);
            line-height: 1.65;
        }

        .score-band {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .score-box {
            padding: 14px 12px;
            border-radius: 18px;
            background: rgba(255, 241, 214, 0.05);
            border: 1px solid rgba(255, 226, 176, 0.12);
        }

        .score-box .number {
            display: block;
            margin-bottom: 4px;
            font-size: 1.5rem;
            color: #ffe3ad;
        }

        .score-box .label {
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(236, 216, 186, 0.72);
        }

        .detective {
            margin-top: 24px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            align-items: center;
            padding: 18px 20px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(9, 7, 5, 0.9), rgba(33, 21, 15, 0.92));
            border: 1px solid rgba(255, 225, 173, 0.12);
        }

        .detective p {
            margin: 0;
            color: rgba(240, 221, 191, 0.9);
            line-height: 1.6;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .action-button {
            appearance: none;
            border: 0;
            border-radius: 999px;
            padding: 12px 16px;
            font: inherit;
            color: #1a130e;
            background: linear-gradient(180deg, #ffe2aa, #e9be79);
            cursor: pointer;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.22);
            transition: transform 180ms ease, filter 180ms ease;
        }

        .action-button:hover,
        .action-button:focus-visible {
            transform: translateY(-1px);
            filter: brightness(1.04);
            outline: none;
        }

        .button-ghost {
            background: transparent;
            color: #f3dfba;
            border: 1px solid rgba(255, 225, 173, 0.18);
            box-shadow: none;
        }

        .status {
            margin-top: 12px;
            min-height: 1.5em;
            color: #f7deb0;
            font-size: 0.96rem;
        }

        .footnote {
            margin-top: 24px;
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            padding: 0 8px;
            color: rgba(235, 218, 189, 0.72);
            font-size: 0.92rem;
        }

        .footnote p {
            margin: 0;
            line-height: 1.6;
        }

        @media (max-width: 980px) {
            .masthead,
            .gallery,
            .studio {
                grid-template-columns: 1fr;
            }

            .masthead-card {
                order: -1;
            }
        }

        @media (max-width: 640px) {
            .page {
                width: min(100% - 18px, 100%);
                padding-top: 14px;
            }

            h1 {
                font-size: clamp(2.6rem, 15vw, 4rem);
            }

            .frame {
                padding: 12px;
                border-radius: 24px;
            }

            .role-grid,
            .score-band {
                grid-template-columns: 1fr;
            }

            .detective {
                grid-template-columns: 1fr;
            }

            .zone-label {
                font-size: 0.64rem;
                padding: 5px 8px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="masthead">
            <div>
                <div class="eyebrow">Gallery Exercise <span>Light, Mercy, Distance</span></div>
                <h1>Prodigal Light Lab</h1>
                <p class="dek">A candlelit little museum for studying how Rembrandt turns a parable into a room full of psychology. Tap around the painting, adjust the mood, and try Nathan Mode to catch the elder brother lurking by the column.</p>
            </div>
            <aside class="masthead-card">
                <div class="mini-label">Jon Noticed</div>
                <p class="quote">“That’s the elder brother peeking around the column in the background.”</p>
                <p class="quote-credit">That tiny observation is the whole hinge of this page. Once you see him, the story stops being a soft reunion and starts becoming a drama about who can stand near mercy without stepping into it.</p>
            </aside>
        </section>

        <section class="frame">
            <div class="gallery">
                <div class="painting" id="painting" aria-label="Stylized composition inspired by the return of the prodigal son">
                    <div class="column" aria-hidden="true"></div>
                    <div class="halo" aria-hidden="true"></div>
                    <div class="figure father" aria-hidden="true"></div>
                    <div class="figure son" aria-hidden="true"></div>
                    <div class="figure elder" aria-hidden="true"></div>
                    <div class="figure witness-a" aria-hidden="true"></div>
                    <div class="figure witness-b" aria-hidden="true"></div>
                    <?php foreach ($roles as $role): ?>
                        <button
                            class="zone<?= $role['id'] === 'elder' ? ' detective-target' : '' ?>"
                            data-role="<?= htmlspecialchars($role['id']) ?>"
                            style="left: <?= $role['x'] ?>%; top: <?= $role['y'] ?>%; width: <?= $role['w'] ?>%; height: <?= $role['h'] ?>%;"
                            aria-label="Focus on <?= htmlspecialchars($role['name']) ?>"
                        >
                            <span class="zone-label"><?= htmlspecialchars($role['name']) ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="side-panel">
                    <section class="panel" id="focus-panel">
                        <div class="role-tag" id="role-tag">Mercy</div>
                        <h2 id="role-name">The Father</h2>
                        <p id="role-prompt">Hands first. He is not interrogating. He is receiving.</p>
                        <p style="margin-top: 12px;" id="role-detail">The father is the calm center of the whole scene. His stance is stable, his face is quiet, and his hands do the talking: one broad and protective, one tender and searching.</p>
                    </section>

                    <section class="panel">
                        <h3>Choose a Lens</h3>
                        <div class="role-grid" id="role-grid">
                            <?php foreach ($roles as $role): ?>
                                <button class="role-chip<?= $role['id'] === 'father' ? ' active' : '' ?>" data-role-chip="<?= htmlspecialchars($role['id']) ?>">
                                    <strong><?= htmlspecialchars($role['name']) ?></strong>
                                    <span><?= htmlspecialchars($role['prompt']) ?></span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </section>
                </div>
            </div>

            <section class="studio">
                <section class="panel">
                    <h3>Mood Mixer</h3>
                    <div class="slider-wrap">
                        <div class="slider-label"><span>Mercy light</span><span id="glow-value">74%</span></div>
                        <input id="glow" type="range" min="20" max="100" value="74">
                    </div>
                    <div class="slider-wrap">
                        <div class="slider-label"><span>Drama shadow</span><span id="shadow-value">61%</span></div>
                        <input id="shadow" type="range" min="20" max="100" value="61">
                    </div>
                    <div class="slider-wrap">
                        <div class="slider-label"><span>Elder-brother suspicion</span><span id="distance-value">48%</span></div>
                        <input id="distance" type="range" min="0" max="100" value="48">
                    </div>
                </section>

                <section class="insight-card">
                    <div>
                        <p class="mini-label">Current Read</p>
                        <p class="big-line" id="insight-title">Mercy is brightest when someone nearby still refuses it.</p>
                        <p class="sub-line" id="insight-text">This scene lands so hard because it is not a private hug. It includes witnesses, awkwardness, and someone in the background who might be morally correct in all the most spiritually unhelpful ways.</p>
                    </div>
                    <div class="score-band">
                        <div class="score-box">
                            <span class="number" id="score-mercy">82</span>
                            <span class="label">Warmth</span>
                        </div>
                        <div class="score-box">
                            <span class="number" id="score-tension">56</span>
                            <span class="label">Tension</span>
                        </div>
                        <div class="score-box">
                            <span class="number" id="score-clarity">73</span>
                            <span class="label">Clarity</span>
                        </div>
                    </div>
                </section>
            </section>

            <section class="detective">
                <div>
                    <h3 style="margin: 0 0 8px; color: #fbe7bc;">Nathan Mode: Elder Brother Detective</h3>
                    <p>Press start, then try to spot the elder brother before the countdown runs out. One sneaky theologian behind a column. Family fun is extremely serious business.</p>
                    <div class="status" id="status">Ready when you are.</div>
                </div>
                <div class="button-row">
                    <button class="action-button" id="start-game">Start 12s Round</button>
                    <button class="action-button button-ghost" id="reset-scene">Reset Scene</button>
                </div>
            </section>
        </section>

        <div class="footnote">
            <p>Inspired by Jon’s 2012 post about Rembrandt’s <em>Return of the Prodigal Son</em>, especially his lovely catch that the elder brother is peeking from the background.</p>
            <p><a href="index.php">Back to Chloe Reads Jon</a></p>
        </div>
    </main>

    <script>
        const roles = {
            father: {
                tag: "Mercy",
                name: "The Father",
                prompt: "Hands first. He is not interrogating. He is receiving.",
                detail: "The father is the calm center of the whole scene. His stance is stable, his face is quiet, and his hands do the talking: one broad and protective, one tender and searching.",
                x: "58%",
                y: "56%",
                color: "rgba(241, 200, 131, 0.24)"
            },
            son: {
                tag: "Return",
                name: "The Prodigal Son",
                prompt: "Look for collapse rather than performance. He arrives with nothing left to stage.",
                detail: "The son is almost all surrender: shaved head, worn clothes, bent posture, no heroic angle. He is not posing as sorry. He is simply home and spent.",
                x: "49%",
                y: "71%",
                color: "rgba(200, 95, 80, 0.24)"
            },
            elder: {
                tag: "Distance",
                name: "The Elder Brother",
                prompt: "Jon noticed him peeking around the column. Once you spot him, the whole painting gets more complicated.",
                detail: "The elder brother is not in the embrace. He watches from the edge, vertical and reserved, close enough to witness grace and still emotionally far from it.",
                x: "73%",
                y: "31%",
                color: "rgba(142, 179, 192, 0.24)"
            },
            witnesses: {
                tag: "Silence",
                name: "The Witnesses",
                prompt: "Notice how many people are present and how little noise the scene makes.",
                detail: "The background figures keep the moment from feeling private or sentimental. Mercy here is social, visible, and somehow still intimate.",
                x: "30%",
                y: "43%",
                color: "rgba(140, 191, 139, 0.22)"
            }
        };

        const insights = {
            father: {
                title: "Mercy is not vague here. It has weight, posture, and hands.",
                text: "Rembrandt makes welcome feel embodied. The father does not merely approve of return in principle. He leans toward an actual ruined person."
            },
            son: {
                title: "The scene works because the son looks emptied out, not theatrically guilty.",
                text: "Everything about him says the performance budget is gone. That makes the embrace feel like rescue instead of negotiation."
            },
            elder: {
                title: "The elder brother is the plot twist standing in the shadows.",
                text: "He keeps the painting from becoming sentimental. Grace is happening, yes, but not everybody in the room is ready to rejoice about it."
            },
            witnesses: {
                title: "Mercy becomes more mysterious when other people are quietly watching.",
                text: "The extra figures widen the scene into a social drama. This is not only about one son and one father, but about how communities look at return."
            }
        };

        const painting = document.getElementById("painting");
        const zones = [...document.querySelectorAll(".zone")];
        const chips = [...document.querySelectorAll("[data-role-chip]")];
        const roleTag = document.getElementById("role-tag");
        const roleName = document.getElementById("role-name");
        const rolePrompt = document.getElementById("role-prompt");
        const roleDetail = document.getElementById("role-detail");
        const insightTitle = document.getElementById("insight-title");
        const insightText = document.getElementById("insight-text");

        const glow = document.getElementById("glow");
        const shadow = document.getElementById("shadow");
        const distance = document.getElementById("distance");
        const glowValue = document.getElementById("glow-value");
        const shadowValue = document.getElementById("shadow-value");
        const distanceValue = document.getElementById("distance-value");
        const scoreMercy = document.getElementById("score-mercy");
        const scoreTension = document.getElementById("score-tension");
        const scoreClarity = document.getElementById("score-clarity");
        const status = document.getElementById("status");
        const startGame = document.getElementById("start-game");
        const resetScene = document.getElementById("reset-scene");

        let activeRole = "father";
        let timerId = null;
        let timeLeft = 0;
        let hunting = false;

        function setActiveRole(roleId) {
            activeRole = roleId;
            const role = roles[roleId];
            const insight = insights[roleId];
            roleTag.textContent = role.tag;
            roleName.textContent = role.name;
            rolePrompt.textContent = role.prompt;
            roleDetail.textContent = role.detail;
            insightTitle.textContent = insight.title;
            insightText.textContent = insight.text;
            painting.style.setProperty("--focusX", role.x);
            painting.style.setProperty("--focusY", role.y);
            painting.style.setProperty("--focusColor", role.color);

            zones.forEach((zone) => zone.classList.toggle("active", zone.dataset.role === roleId));
            chips.forEach((chip) => chip.classList.toggle("active", chip.dataset.roleChip === roleId));
            updateScores();
        }

        function updateScores() {
            const mercy = Number(glow.value);
            const tension = Math.round((Number(shadow.value) * 0.65) + (Number(distance.value) * 0.45));
            const clarityBase = 100 - Math.abs(Number(glow.value) - 72) - Math.abs(Number(shadow.value) - 58) / 2;
            const roleBonus = activeRole === "father" ? 4 : activeRole === "elder" ? -3 : 1;
            const clarity = Math.max(28, Math.min(98, Math.round(clarityBase + roleBonus)));

            glowValue.textContent = `${glow.value}%`;
            shadowValue.textContent = `${shadow.value}%`;
            distanceValue.textContent = `${distance.value}%`;
            scoreMercy.textContent = mercy;
            scoreTension.textContent = Math.max(22, Math.min(99, tension));
            scoreClarity.textContent = clarity;

            painting.style.filter = `brightness(${0.78 + mercy / 180}) contrast(${0.95 + Number(shadow.value) / 220}) saturate(${0.88 + Number(distance.value) / 500})`;
            painting.style.boxShadow = `inset 0 -40px ${90 + Number(shadow.value)}px rgba(0, 0, 0, ${0.36 + Number(shadow.value) / 300})`;
        }

        function stopGame(message) {
            hunting = false;
            clearInterval(timerId);
            timerId = null;
            status.textContent = message;
        }

        function startRound() {
            clearInterval(timerId);
            hunting = true;
            timeLeft = 12;
            status.textContent = `Find the elder brother. ${timeLeft}s left.`;
            timerId = setInterval(() => {
                timeLeft -= 1;
                if (timeLeft <= 0) {
                    stopGame("Time! He was that solemn fellow peeking near the column. Dramatic, frankly.");
                    setActiveRole("elder");
                    return;
                }
                status.textContent = `Find the elder brother. ${timeLeft}s left.`;
            }, 1000);
        }

        zones.forEach((zone) => {
            zone.addEventListener("click", () => {
                const roleId = zone.dataset.role;
                setActiveRole(roleId);
                if (hunting && roleId === "elder") {
                    stopGame(`Caught him with ${timeLeft}s left. Suspicion, theology, and excellent eyesight.`);
                } else if (hunting) {
                    status.textContent = `That was ${roles[roleId].name}. Keep looking. ${timeLeft}s left.`;
                }
            });
        });

        chips.forEach((chip) => {
            chip.addEventListener("click", () => setActiveRole(chip.dataset.roleChip));
        });

        [glow, shadow, distance].forEach((slider) => slider.addEventListener("input", updateScores));
        startGame.addEventListener("click", startRound);
        resetScene.addEventListener("click", () => {
            clearInterval(timerId);
            hunting = false;
            status.textContent = "Ready when you are.";
            glow.value = 74;
            shadow.value = 61;
            distance.value = 48;
            setActiveRole("father");
            updateScores();
        });

        setActiveRole("father");
        updateScores();
    </script>
</body>
</html>
