<?php
$scenarios = [
    [
        'name' => 'Quiet Recharge',
        'emoji' => 'Lamp',
        'description' => 'Long week. You want a booth that feels like an exhale, warm service, and enough pie to repair the human spirit.',
        'weights' => ['comfort' => 1.3, 'service' => 1.15, 'pie' => 1.1, 'jukebox' => 0.45, 'fries' => 0.75, 'kid' => 0.35],
    ],
    [
        'name' => 'Nathan Mode',
        'emoji' => 'Arcade',
        'description' => 'The small gentleman demands excitement, great fries, a little spectacle, and absolutely no boring adult solemnity.',
        'weights' => ['comfort' => 0.6, 'service' => 0.8, 'pie' => 0.9, 'jukebox' => 1.1, 'fries' => 1.35, 'kid' => 1.35],
    ],
    [
        'name' => 'Late Night Debrief',
        'emoji' => 'Moon',
        'description' => 'You need a place to unwind after a full day, talk properly, and leave steadier than you arrived.',
        'weights' => ['comfort' => 1.2, 'service' => 1.15, 'pie' => 1.0, 'jukebox' => 0.6, 'fries' => 0.95, 'kid' => 0.25],
    ],
    [
        'name' => 'Family Legend',
        'emoji' => 'Spark',
        'description' => 'The goal is not merely dinner. The goal is a place people will keep mentioning twenty years later.',
        'weights' => ['comfort' => 1.05, 'service' => 1.2, 'pie' => 1.05, 'jukebox' => 0.95, 'fries' => 1.0, 'kid' => 1.15],
    ],
    [
        'name' => 'Date Night, Softly',
        'emoji' => 'Heart',
        'description' => 'Not fussy, not loud, just charming enough to make conversation feel bright and easy.',
        'weights' => ['comfort' => 1.15, 'service' => 1.15, 'pie' => 1.0, 'jukebox' => 0.55, 'fries' => 0.65, 'kid' => 0.2],
    ],
];

$badges = [
    ['threshold' => 94, 'title' => 'Legendary Regular', 'line' => 'They know your booth, your order, and possibly your life story.'],
    ['threshold' => 84, 'title' => 'Golden Booth', 'line' => 'This place has proper favourite-restaurant energy.'],
    ['threshold' => 72, 'title' => 'Solid Repeat Visit', 'line' => 'Very respectable. Needs one more ridiculous strength.'],
    ['threshold' => 58, 'title' => 'Promising, But Needs Work', 'line' => 'The bones are good. The fries are possibly not.'],
    ['threshold' => 0, 'title' => 'Emergency Toast Stop', 'line' => 'A place of refuge, yes. A favourite, not yet.'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raymond's Regulars Club</title>
    <style>
        :root {
            --paper: #f3e7cf;
            --ink: #2f2016;
            --cherry: #bf2f44;
            --cream: #fff8ee;
            --teal: #2e7474;
            --mint: #96d8cb;
            --syrup: #6f3f23;
            --chrome: #d8d9d5;
            --night: #13222d;
            --gold: #efbf5a;
            --shadow: rgba(26, 14, 7, 0.18);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top, rgba(255, 228, 183, 0.85), transparent 30%),
                linear-gradient(180deg, #9dd4d3 0%, #6ca7a7 16%, #1e4755 42%, #122833 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.16;
            background-image:
                linear-gradient(rgba(255,255,255,0.55) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
            background-size: 18px 18px;
            mix-blend-mode: soft-light;
        }

        a { color: inherit; }

        .shell {
            width: min(1200px, calc(100% - 28px));
            margin: 22px auto 36px;
        }

        .marquee {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            padding: 28px;
            background:
                linear-gradient(145deg, rgba(250, 244, 229, 0.93), rgba(236, 220, 190, 0.95)),
                repeating-linear-gradient(135deg, rgba(191, 47, 68, 0.08) 0 18px, rgba(255,255,255,0.08) 18px 36px);
            box-shadow:
                0 28px 70px rgba(8, 18, 23, 0.36),
                inset 0 2px 0 rgba(255,255,255,0.65);
            border: 1px solid rgba(255,255,255,0.35);
        }

        .marquee::after {
            content: "";
            position: absolute;
            inset: 12px;
            border-radius: 24px;
            border: 2px dashed rgba(111, 63, 35, 0.18);
            pointer-events: none;
        }

        .topline {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-start;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }

        .kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255, 248, 238, 0.78);
            font-size: 0.86rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--syrup);
            border: 1px solid rgba(111, 63, 35, 0.12);
        }

        h1 {
            margin: 14px 0 8px;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: clamp(2.6rem, 6vw, 5.3rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            color: #9d2036;
            text-shadow: 0 2px 0 rgba(255,255,255,0.45);
        }

        .lede {
            max-width: 63ch;
            margin: 0;
            font-size: 1.08rem;
            line-height: 1.6;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 24px;
            align-items: stretch;
            position: relative;
            z-index: 1;
        }

        .sign-wrap {
            display: grid;
            gap: 20px;
        }

        .neon-sign {
            position: relative;
            border-radius: 30px;
            padding: 26px;
            min-height: 284px;
            background:
                radial-gradient(circle at top, rgba(255,255,255,0.2), transparent 32%),
                linear-gradient(180deg, #1c3942 0%, #152a31 100%);
            box-shadow: inset 0 0 0 2px rgba(255,255,255,0.08);
            overflow: hidden;
        }

        .neon-sign::before,
        .neon-sign::after {
            content: "";
            position: absolute;
            inset: 18px;
            border-radius: 22px;
            pointer-events: none;
        }

        .neon-sign::before {
            border: 3px solid rgba(239,191,90,0.82);
            box-shadow: 0 0 18px rgba(239,191,90,0.55), inset 0 0 12px rgba(239,191,90,0.25);
        }

        .neon-sign::after {
            inset: 32px 32px auto;
            height: 1px;
            background: rgba(255,255,255,0.16);
        }

        .neon-copy {
            position: relative;
            display: grid;
            gap: 10px;
            place-items: center;
            text-align: center;
            height: 100%;
        }

        .neon-copy .eyebrow {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.32em;
            color: rgba(255,250,238,0.75);
        }

        .neon-copy .main {
            font-family: "Brush Script MT", "Segoe Script", cursive;
            font-size: clamp(3.3rem, 9vw, 5.9rem);
            color: #ffeeb6;
            text-shadow:
                0 0 7px rgba(255, 215, 132, 0.9),
                0 0 18px rgba(255, 113, 78, 0.75),
                0 0 38px rgba(255, 113, 78, 0.5);
            transform: rotate(-5deg);
        }

        .neon-copy .sub {
            font-size: 1rem;
            max-width: 26ch;
            line-height: 1.45;
            color: rgba(255,248,238,0.85);
        }

        .scene {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 16px;
        }

        .booth,
        .ticket {
            border-radius: 26px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 16px 34px var(--shadow);
        }

        .booth {
            min-height: 240px;
            background:
                linear-gradient(180deg, rgba(255,248,238,0.45), transparent 18%),
                linear-gradient(180deg, #c84f5f 0 43%, #8f2234 43% 100%);
        }

        .booth::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(90deg, rgba(255,255,255,0.08) 0 12%, transparent 12% 24%, rgba(255,255,255,0.08) 24% 36%, transparent 36% 48%, rgba(255,255,255,0.08) 48% 60%, transparent 60% 72%, rgba(255,255,255,0.08) 72% 84%, transparent 84% 100%);
            opacity: 0.6;
        }

        .booth .table {
            position: absolute;
            left: 50%;
            bottom: 28px;
            width: min(78%, 320px);
            height: 30px;
            border-radius: 999px;
            transform: translateX(-50%);
            background: linear-gradient(180deg, #fce2bf 0%, #e0b97e 100%);
            box-shadow: 0 10px 16px rgba(55, 22, 11, 0.28);
        }

        .booth .table::before,
        .booth .table::after {
            content: "";
            position: absolute;
            top: -10px;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(255, 247, 231, 0.88);
            border: 4px solid rgba(111, 63, 35, 0.14);
            box-shadow: 0 3px 0 rgba(255,255,255,0.55) inset;
        }

        .booth .table::before { left: 22px; }
        .booth .table::after { right: 22px; }

        .booth .jukebox {
            position: absolute;
            right: 16px;
            bottom: 26px;
            width: 82px;
            height: 128px;
            border-radius: 44px 44px 18px 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.52), transparent 18%),
                linear-gradient(180deg, #8ae3df, #267082);
            border: 5px solid rgba(255,248,238,0.72);
            box-shadow: 0 0 0 4px rgba(22, 64, 73, 0.36), 0 10px 20px rgba(22, 64, 73, 0.38);
        }

        .booth .jukebox::before {
            content: "";
            position: absolute;
            inset: 18px 16px 22px;
            border-radius: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.62), transparent 25%),
                linear-gradient(180deg, #f4a2aa 0%, #712134 100%);
            box-shadow: inset 0 0 12px rgba(255,255,255,0.28);
        }

        .booth .pie {
            position: absolute;
            left: 20px;
            bottom: 38px;
            width: 78px;
            height: 38px;
            border-radius: 50% 50% 42% 42%;
            background: linear-gradient(180deg, #f4d49d 0%, #dc9e52 100%);
            box-shadow: 0 10px 14px rgba(55, 22, 11, 0.22);
        }

        .booth .pie::before {
            content: "";
            position: absolute;
            inset: -14px 10px 14px;
            border-radius: 50%;
            background: linear-gradient(180deg, #dd4b58 0%, #7d1831 100%);
        }

        .booth .label {
            position: absolute;
            left: 20px;
            top: 18px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,248,238,0.88);
            font-size: 0.84rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #7b3240;
        }

        .ticket {
            padding: 20px 18px 22px;
            background:
                radial-gradient(circle at top, rgba(255,255,255,0.78), transparent 18%),
                linear-gradient(180deg, #fff6e8 0%, #efd8b2 100%);
            display: grid;
            gap: 16px;
        }

        .ticket::before,
        .ticket::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            height: 10px;
            background:
                radial-gradient(circle at 10px 10px, transparent 9px, #efd8b2 10px) repeat-x;
            background-size: 20px 20px;
        }

        .ticket::before { top: -10px; }
        .ticket::after { bottom: -10px; transform: rotate(180deg); }

        .ticket h2,
        .panel h3,
        .scenario h3,
        .guide h3 {
            margin: 0;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: 1.2rem;
            letter-spacing: 0.02em;
        }

        .score-line {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 10px;
        }

        .score-value {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 800;
            color: #9c2237;
        }

        .badge {
            padding: 10px 12px;
            border-radius: 18px;
            background: rgba(191, 47, 68, 0.08);
            border: 1px solid rgba(191, 47, 68, 0.12);
        }

        .badge strong {
            display: block;
            font-size: 1rem;
            margin-bottom: 3px;
        }

        .meters {
            display: grid;
            gap: 10px;
        }

        .meter {
            display: grid;
            grid-template-columns: 84px 1fr 46px;
            gap: 10px;
            align-items: center;
            font-size: 0.95rem;
        }

        .meter-track {
            height: 10px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(46, 116, 116, 0.14);
        }

        .meter-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #2e7474, #efbf5a);
            width: 40%;
            transition: width 220ms ease;
        }

        .controls-grid {
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 24px;
            margin-top: 24px;
        }

        .panel,
        .scenario,
        .guide {
            padding: 22px;
            border-radius: 26px;
            background: rgba(255, 248, 238, 0.92);
            box-shadow: 0 18px 34px rgba(10, 25, 30, 0.18);
            border: 1px solid rgba(255,255,255,0.45);
        }

        .sliders {
            display: grid;
            gap: 16px;
            margin-top: 18px;
        }

        .slider-row {
            display: grid;
            gap: 8px;
        }

        .slider-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.96rem;
        }

        .slider-top span:last-child {
            color: #87542f;
            font-weight: 700;
        }

        input[type="range"] {
            width: 100%;
            appearance: none;
            height: 13px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(46,116,116,0.22), rgba(191,47,68,0.26));
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 3px solid rgba(255,248,238,0.96);
            background: linear-gradient(180deg, #d34f63, #862338);
            box-shadow: 0 4px 12px rgba(134, 35, 56, 0.35);
            cursor: pointer;
        }

        input[type="range"]::-moz-range-thumb {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 3px solid rgba(255,248,238,0.96);
            background: linear-gradient(180deg, #d34f63, #862338);
            box-shadow: 0 4px 12px rgba(134, 35, 56, 0.35);
            cursor: pointer;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .chip,
        button {
            border: 0;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        .chip {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(46, 116, 116, 0.12);
            color: #225c5c;
            font-weight: 700;
        }

        .chip:hover,
        button:hover { transform: translateY(-1px); }

        .scenario {
            display: grid;
            gap: 16px;
        }

        .scenario-card {
            border-radius: 22px;
            padding: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.68), transparent 45%),
                linear-gradient(135deg, rgba(150,216,203,0.25), rgba(239,191,90,0.22));
            border: 1px solid rgba(46,116,116,0.15);
        }

        .scenario-name {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: baseline;
            margin-bottom: 8px;
        }

        .scenario-name strong {
            font-size: 1.15rem;
        }

        .scenario-result {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(19, 34, 45, 0.92);
            color: #f7ebd4;
        }

        .scenario-result strong {
            color: #ffd470;
        }

        button {
            padding: 12px 18px;
            border-radius: 16px;
            font-weight: 800;
            font-family: inherit;
        }

        .primary {
            background: linear-gradient(180deg, #c94057, #8a2338);
            color: #fff7ec;
            box-shadow: 0 10px 20px rgba(138, 35, 56, 0.28);
        }

        .secondary {
            background: rgba(46, 116, 116, 0.12);
            color: #204f4f;
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .guide {
            margin-top: 24px;
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 18px;
        }

        .placemat {
            border-radius: 22px;
            padding: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.75), transparent 30%),
                linear-gradient(135deg, #ffe7b9, #f4cab4 55%, #cfdfe2);
            min-height: 100%;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.38);
        }

        .placemat h4 {
            margin: 0 0 10px;
            font-size: 0.92rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #7f4c2a;
        }

        .slogan {
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: clamp(1.6rem, 4vw, 2.3rem);
            line-height: 1.05;
            margin-bottom: 10px;
            color: #8a2338;
        }

        .mini-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .mini-card {
            border-radius: 18px;
            padding: 14px;
            background: rgba(255, 248, 238, 0.78);
            min-height: 110px;
        }

        .mini-card strong {
            display: block;
            margin-bottom: 7px;
        }

        .footer-links {
            margin-top: 26px;
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
            font-size: 0.95rem;
        }

        .footer-links a {
            text-decoration: none;
            border-bottom: 1px solid currentColor;
        }

        .small {
            color: rgba(47, 32, 22, 0.74);
            font-size: 0.92rem;
            line-height: 1.55;
        }

        @media (max-width: 980px) {
            .hero-grid,
            .controls-grid,
            .guide {
                grid-template-columns: 1fr;
            }

            .scene {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .shell { width: min(100% - 16px, 1000px); }
            .marquee { padding: 18px; border-radius: 24px; }
            .topline { flex-direction: column; }
            .meter { grid-template-columns: 72px 1fr 40px; font-size: 0.88rem; }
            .button-row, .chips, .footer-links { gap: 10px; }
            .panel, .scenario, .guide { padding: 18px; border-radius: 22px; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="marquee">
            <div class="topline">
                <div>
                    <div class="kicker">Chrome booths, proper pie, and favourite-place nonsense</div>
                    <h1>Raymond's Regulars Club</h1>
                    <p class="lede">Jon once wrote a tiny post saying Raymond's was one of his favourite restaurants. That felt like enough of a spark for a whole diner mythology machine, because some places are not just where you eat. They become part of your emotional architecture.</p>
                </div>
                <div class="kicker">Build the booth. Earn regular status.</div>
            </div>

            <div class="hero-grid">
                <div class="sign-wrap">
                    <div class="neon-sign">
                        <div class="neon-copy">
                            <div class="eyebrow">Tonight's Favourite</div>
                            <div class="main" id="signName">Raymond's</div>
                            <div class="sub" id="signSub">Warm lights, crisp fries, heroic pie, and the sort of booth that might cure a week.</div>
                        </div>
                    </div>

                    <div class="scene">
                        <div class="booth" id="boothScene">
                            <div class="label" id="boothLabel">Quiet comfort, suspiciously good fries</div>
                            <div class="pie" id="pieProp"></div>
                            <div class="jukebox" id="jukeboxProp"></div>
                            <div class="table"></div>
                        </div>

                        <aside class="ticket">
                            <h2>Regular Receipt</h2>
                            <div class="score-line">
                                <span>Overall favourite score</span>
                                <span class="score-value" id="totalScore">82</span>
                            </div>
                            <div class="badge">
                                <strong id="badgeTitle">Golden Booth</strong>
                                <span id="badgeLine">This place has proper favourite-restaurant energy.</span>
                            </div>
                            <div class="meters">
                                <div class="meter"><span>Comfort</span><div class="meter-track"><div class="meter-fill" id="meterComfort"></div></div><span id="outComfort">8</span></div>
                                <div class="meter"><span>Fries</span><div class="meter-track"><div class="meter-fill" id="meterFries"></div></div><span id="outFries">8</span></div>
                                <div class="meter"><span>Service</span><div class="meter-track"><div class="meter-fill" id="meterService"></div></div><span id="outService">7</span></div>
                                <div class="meter"><span>Jukebox</span><div class="meter-track"><div class="meter-fill" id="meterJukebox"></div></div><span id="outJukebox">6</span></div>
                                <div class="meter"><span>Pie</span><div class="meter-track"><div class="meter-fill" id="meterPie"></div></div><span id="outPie">9</span></div>
                                <div class="meter"><span>Kid Wow</span><div class="meter-track"><div class="meter-fill" id="meterKid"></div></div><span id="outKid">7</span></div>
                            </div>
                        </aside>
                    </div>
                </div>

                <section class="panel">
                    <h3>Tune the Place</h3>
                    <p class="small">Slide the ingredients around until your imagined favourite restaurant feels right. Not Michelin-star right. Favourite-place right. There is a difference, and it matters.</p>

                    <label class="slider-row">
                        <div class="slider-top"><span>Booth comfort</span><span id="labelComfort">Cloud-soft</span></div>
                        <input id="comfort" type="range" min="0" max="10" value="8">
                    </label>
                    <label class="slider-row">
                        <div class="slider-top"><span>Fries crispness</span><span id="labelFries">Dangerously competent</span></div>
                        <input id="fries" type="range" min="0" max="10" value="8">
                    </label>
                    <label class="slider-row">
                        <div class="slider-top"><span>Service warmth</span><span id="labelService">Knows your order</span></div>
                        <input id="service" type="range" min="0" max="10" value="7">
                    </label>
                    <label class="slider-row">
                        <div class="slider-top"><span>Jukebox charm</span><span id="labelJukebox">Just enough swagger</span></div>
                        <input id="jukebox" type="range" min="0" max="10" value="6">
                    </label>
                    <label class="slider-row">
                        <div class="slider-top"><span>Pie recklessness</span><span id="labelPie">Heroic slice</span></div>
                        <input id="pie" type="range" min="0" max="10" value="9">
                    </label>
                    <label class="slider-row">
                        <div class="slider-top"><span>Nathan wow factor</span><span id="labelKid">Booth-approved</span></div>
                        <input id="kid" type="range" min="0" max="10" value="7">
                    </label>

                    <div class="chips">
                        <button class="chip" data-preset="cozy">Cozy classic</button>
                        <button class="chip" data-preset="family">Family legend</button>
                        <button class="chip" data-preset="night">Late-night debrief</button>
                        <button class="chip" data-preset="chaos">Chaotic pie palace</button>
                    </div>
                </section>
            </div>

            <div class="controls-grid">
                <section class="scenario">
                    <h3>Deal a Table</h3>
                    <p class="small">Favourite restaurants are judged by the moods they can survive. Tap through a few situations and see whether your place still holds up when real life shows up wearing boots.</p>
                    <div class="scenario-card">
                        <div class="scenario-name">
                            <strong id="scenarioName">Quiet Recharge</strong>
                            <span id="scenarioEmoji">Lamp</span>
                        </div>
                        <p class="small" id="scenarioDescription">Long week. You want a booth that feels like an exhale, warm service, and enough pie to repair the human spirit.</p>
                    </div>
                    <div class="scenario-result">
                        <strong id="scenarioScore">89/100</strong>
                        <span id="scenarioVerdict">Your place absolutely understands the ministry of a quiet booth.</span>
                    </div>
                    <div class="button-row">
                        <button class="primary" id="nextScenario">Deal another mood</button>
                        <button class="secondary" id="randomize">Random diner</button>
                    </div>
                </section>

                <section class="panel">
                    <h3>What Makes a Favourite?</h3>
                    <p class="small">This is the deeply rigorous science portion, by which I mean vibes with sliders. Some places win because they are technically impressive. Favourite places win because they get folded into family memory.</p>
                    <div class="mini-grid">
                        <div class="mini-card">
                            <strong>Comfort memory</strong>
                            <span id="comfortNarrative">You could stay for one more conversation without anyone rushing you out.</span>
                        </div>
                        <div class="mini-card">
                            <strong>Signature brag</strong>
                            <span id="friesNarrative">The fries are good enough to become part of the pitch.</span>
                        </div>
                        <div class="mini-card">
                            <strong>Return magnet</strong>
                            <span id="serviceNarrative">Warm service quietly turns a restaurant into a ritual.</span>
                        </div>
                        <div class="mini-card">
                            <strong>Family tale</strong>
                            <span id="kidNarrative">A kid can point at three things and be delighted before the water arrives.</span>
                        </div>
                    </div>
                </section>
            </div>

            <section class="guide">
                <div class="placemat">
                    <h4>Placemat slogan</h4>
                    <div class="slogan" id="slogan">Where good booths become family folklore.</div>
                    <p class="small" id="placematCopy">Your current diner feels like the sort of place where a simple meal turns into a proper checkpoint in the week.</p>
                    <div class="footer-links">
                        <a href="index.php">Back to Chloe Reads Jon</a>
                        <a href="https://jona.ca/2004/10/raymonds-is-one-of-my-favourite.html">Inspired by Jon's post about Raymond's being one of his favourite restaurants</a>
                    </div>
                </div>

                <div>
                    <h3>House Notes</h3>
                    <p class="small">Nothing here is pretending to be objective. It is a love letter to the weird little truth that restaurants can become emotional landmarks. If you have ever said “that place feels like us,” this page is on your side.</p>
                    <div class="mini-grid">
                        <div class="mini-card">
                            <strong>Name your place</strong>
                            <span class="small">Tap the sign title to rename it. Your local browser will remember the last version.</span>
                        </div>
                        <div class="mini-card">
                            <strong>Try the scenarios</strong>
                            <span class="small">A diner that only works in one mood is a fragile little diva. Favourite places have range.</span>
                        </div>
                        <div class="mini-card">
                            <strong>Use Nathan mode</strong>
                            <span class="small">If the wow factor is low, expect stern tiny-customer review energy.</span>
                        </div>
                        <div class="mini-card">
                            <strong>Permit sentimentality</strong>
                            <span class="small">A favourite restaurant is allowed to be a memory machine with side dishes.</span>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <script>
        const scenarios = <?php echo json_encode($scenarios, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
        const badges = <?php echo json_encode($badges, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;

        const state = {
            sliders: {
                comfort: document.getElementById('comfort'),
                fries: document.getElementById('fries'),
                service: document.getElementById('service'),
                jukebox: document.getElementById('jukebox'),
                pie: document.getElementById('pie'),
                kid: document.getElementById('kid')
            },
            scenarioIndex: 0
        };

        const labels = {
            comfort: ['bleak', 'rigid', 'acceptable', 'serviceable', 'decent', 'pretty nice', 'stay a while', 'soft landing', 'cloud-soft', 'booth sanctuary', 'practically pastoral'],
            fries: ['limp tragedy', 'underpowered', 'barely crisp', 'fine', 'solid', 'respectable', 'quite good', 'dangerously competent', 'excellent', 'heroic', 'my compliments to the fryer'],
            service: ['icy', 'hurried', 'distant', 'okay', 'pleasant', 'attentive', 'warm', 'knows your order', 'genuinely lovely', 'regular-status warmth', 'adopted by the staff'],
            jukebox: ['silent', 'sleepy', 'murmuring', 'fine', 'decent', 'lively', 'just enough swagger', 'strong mood work', 'jukebox charmer', 'tiny time machine', 'full chrome sorcery'],
            pie: ['none whatsoever', 'why bother', 'faint hope', 'decent', 'pleasant', 'good idea', 'proper slice', 'excellent slice', 'heroic slice', 'recklessly persuasive', 'holy cow, pie'],
            kid: ['restless', 'thin grin', 'mildly amused', 'okay', 'decent', 'promising', 'booth-approved', 'kid magnet', 'full sparkle', 'legendary wow', 'he will absolutely tell people']
        };

        const narratives = {
            comfort: [
                'You finish quickly and leave. No one writes poetry about this booth.',
                'The room is survivable, which is not quite the same as comforting.',
                'There is some softness here, though the soul remains cautious.',
                'You could stay a bit longer and no one would mutiny.',
                'This booth understands the ministry of easing a day back into shape.'
            ],
            fries: [
                'No one is bringing these up later.',
                'They do the job, but only just.',
                'These are respectable and possibly strategic.',
                'These fries absolutely become part of the recommendation speech.',
                'People speak of these fries with suspicious reverence.'
            ],
            service: [
                'This place functions, but it does not gather anyone into belonging.',
                'You are served efficiently. The heart remains unruffled.',
                'A little warmth begins to turn the meal into ritual.',
                'The staff has the rare skill of making people unclench.',
                'This level of welcome is how favourite places happen.'
            ],
            kid: [
                'A child would request escape.',
                'The charm exists but is not yet gripping.',
                'A youngster could have a decent time here.',
                'There is enough delight to secure a repeat visit.',
                'This place has story-retelling energy for years.'
            ]
        };

        const presets = {
            cozy: { comfort: 9, fries: 7, service: 8, jukebox: 4, pie: 9, kid: 5 },
            family: { comfort: 8, fries: 9, service: 8, jukebox: 7, pie: 8, kid: 9 },
            night: { comfort: 9, fries: 8, service: 9, jukebox: 5, pie: 7, kid: 3 },
            chaos: { comfort: 5, fries: 10, service: 7, jukebox: 10, pie: 10, kid: 10 }
        };

        const outputs = {
            totalScore: document.getElementById('totalScore'),
            badgeTitle: document.getElementById('badgeTitle'),
            badgeLine: document.getElementById('badgeLine'),
            signName: document.getElementById('signName'),
            signSub: document.getElementById('signSub'),
            boothLabel: document.getElementById('boothLabel'),
            slogan: document.getElementById('slogan'),
            placematCopy: document.getElementById('placematCopy'),
            scenarioName: document.getElementById('scenarioName'),
            scenarioEmoji: document.getElementById('scenarioEmoji'),
            scenarioDescription: document.getElementById('scenarioDescription'),
            scenarioScore: document.getElementById('scenarioScore'),
            scenarioVerdict: document.getElementById('scenarioVerdict'),
            comfortNarrative: document.getElementById('comfortNarrative'),
            friesNarrative: document.getElementById('friesNarrative'),
            serviceNarrative: document.getElementById('serviceNarrative'),
            kidNarrative: document.getElementById('kidNarrative'),
            labelComfort: document.getElementById('labelComfort'),
            labelFries: document.getElementById('labelFries'),
            labelService: document.getElementById('labelService'),
            labelJukebox: document.getElementById('labelJukebox'),
            labelPie: document.getElementById('labelPie'),
            labelKid: document.getElementById('labelKid')
        };

        const meterMap = {
            comfort: document.getElementById('meterComfort'),
            fries: document.getElementById('meterFries'),
            service: document.getElementById('meterService'),
            jukebox: document.getElementById('meterJukebox'),
            pie: document.getElementById('meterPie'),
            kid: document.getElementById('meterKid')
        };

        const outMap = {
            comfort: document.getElementById('outComfort'),
            fries: document.getElementById('outFries'),
            service: document.getElementById('outService'),
            jukebox: document.getElementById('outJukebox'),
            pie: document.getElementById('outPie'),
            kid: document.getElementById('outKid')
        };

        const signName = outputs.signName;
        signName.contentEditable = 'true';
        signName.spellcheck = false;

        function getValues() {
            return Object.fromEntries(Object.entries(state.sliders).map(([key, input]) => [key, Number(input.value)]));
        }

        function labelFor(key, value) {
            return labels[key][value];
        }

        function getBadge(score) {
            return badges.find((badge) => score >= badge.threshold) || badges[badges.length - 1];
        }

        function narrativeBand(value) {
            if (value <= 2) return 0;
            if (value <= 4) return 1;
            if (value <= 6) return 2;
            if (value <= 8) return 3;
            return 4;
        }

        function totalScore(values) {
            return Math.round(
                values.comfort * 11 +
                values.fries * 9 +
                values.service * 10 +
                values.jukebox * 6 +
                values.pie * 8 +
                values.kid * 7
            ) / 5;
        }

        function lineForScore(score) {
            if (score >= 95) return 'This place is dangerously close to family lore.';
            if (score >= 85) return 'A favourite is beginning to strut around in public.';
            if (score >= 72) return 'The foundations of loyalty are definitely here.';
            if (score >= 58) return 'There is charm, but the legend remains under construction.';
            return 'Right now this feels more like a stop than a destination.';
        }

        function placemat(values, score) {
            const moods = [];
            if (values.comfort >= 8) moods.push('booths worth lingering in');
            if (values.fries >= 8) moods.push('fries with actual convictions');
            if (values.service >= 8) moods.push('staff who know how to put people at ease');
            if (values.pie >= 8) moods.push('pie bold enough to cause repeat offences');
            if (values.kid >= 8) moods.push('kid-approved spectacle');
            if (moods.length === 0) moods.push('untapped potential and a brave face');

            const slogans = [
                'Where good booths become family folklore.',
                'The sort of place you mention by name, years later.',
                'Comfort food, but with memory attached.',
                'A regular spot with main-character pie energy.',
                'The booth that quietly wins the week.'
            ];

            outputs.slogan.textContent = slogans[Math.min(4, Math.max(0, Math.floor(score / 20)))];
            outputs.placematCopy.textContent = `Your current diner leans into ${moods.slice(0, 2).join(' and ')}. ${lineForScore(score)}`;
        }

        function scenarioResult(values) {
            const scenario = scenarios[state.scenarioIndex];
            const weighted =
                values.comfort * scenario.weights.comfort +
                values.service * scenario.weights.service +
                values.pie * scenario.weights.pie +
                values.jukebox * scenario.weights.jukebox +
                values.fries * scenario.weights.fries +
                values.kid * scenario.weights.kid;
            const score = Math.max(0, Math.min(100, Math.round(weighted * 9 / 6)));
            let verdict = 'A respectable showing, but not yet “cancel other plans and go there” energy.';

            if (score >= 92) verdict = 'Your place absolutely understands the assignment and then brings extra pie.';
            else if (score >= 82) verdict = 'This mood is safely handled. People leave steadier than they arrived.';
            else if (score >= 68) verdict = 'It works, though one or two ingredients are still muttering in the corner.';
            else if (score >= 54) verdict = 'A brave effort. Someone will say “maybe another place next time.”';
            else verdict = 'This scenario exposes serious structural booth issues.';

            outputs.scenarioName.textContent = scenario.name;
            outputs.scenarioEmoji.textContent = scenario.emoji;
            outputs.scenarioDescription.textContent = scenario.description;
            outputs.scenarioScore.textContent = `${score}/100`;
            outputs.scenarioVerdict.textContent = verdict;
        }

        function paintScene(values) {
            const booth = document.getElementById('boothScene');
            const jukebox = document.getElementById('jukeboxProp');
            const pie = document.getElementById('pieProp');

            booth.style.filter = `saturate(${0.9 + values.kid * 0.04}) brightness(${0.92 + values.comfort * 0.018})`;
            booth.style.boxShadow = `0 16px 34px rgba(26,14,7,${0.14 + values.comfort * 0.015})`;
            jukebox.style.transform = `scale(${0.85 + values.jukebox * 0.03})`;
            jukebox.style.boxShadow = `0 0 ${8 + values.jukebox * 3}px rgba(138, 230, 225, 0.48), 0 10px 20px rgba(22, 64, 73, 0.38)`;
            pie.style.transform = `scale(${0.82 + values.pie * 0.035})`;
            pie.style.filter = `saturate(${1 + values.pie * 0.05})`;
            outputs.boothLabel.textContent = `${labelFor('comfort', values.comfort)}, ${labelFor('fries', values.fries)}`;
            outputs.signSub.textContent = `Service is ${labelFor('service', values.service)}, the jukebox is ${labelFor('jukebox', values.jukebox)}, and the pie situation is ${labelFor('pie', values.pie)}.`;
        }

        function update() {
            const values = getValues();
            const score = Math.max(0, Math.min(100, Math.round(totalScore(values))));
            const badge = getBadge(score);

            Object.entries(values).forEach(([key, value]) => {
                meterMap[key].style.width = `${value * 10}%`;
                outMap[key].textContent = value;
                const labelId = `label${key.charAt(0).toUpperCase()}${key.slice(1)}`;
                outputs[labelId].textContent = labelFor(key, value);
            });

            outputs.totalScore.textContent = score;
            outputs.badgeTitle.textContent = badge.title;
            outputs.badgeLine.textContent = badge.line;
            outputs.comfortNarrative.textContent = narratives.comfort[narrativeBand(values.comfort)];
            outputs.friesNarrative.textContent = narratives.fries[narrativeBand(values.fries)];
            outputs.serviceNarrative.textContent = narratives.service[narrativeBand(values.service)];
            outputs.kidNarrative.textContent = narratives.kid[narrativeBand(values.kid)];

            paintScene(values);
            placemat(values, score);
            scenarioResult(values);
            persist();
        }

        function persist() {
            const payload = {
                name: signName.textContent.trim() || "Raymond's",
                values: getValues(),
                scenarioIndex: state.scenarioIndex
            };
            localStorage.setItem('raymonds-regulars-club', JSON.stringify(payload));
        }

        function loadSaved() {
            const raw = localStorage.getItem('raymonds-regulars-club');
            if (!raw) return;
            try {
                const saved = JSON.parse(raw);
                if (saved.name) signName.textContent = saved.name;
                if (saved.values) {
                    Object.entries(saved.values).forEach(([key, value]) => {
                        if (state.sliders[key]) state.sliders[key].value = value;
                    });
                }
                if (Number.isInteger(saved.scenarioIndex) && saved.scenarioIndex >= 0 && saved.scenarioIndex < scenarios.length) {
                    state.scenarioIndex = saved.scenarioIndex;
                }
            } catch (error) {
                localStorage.removeItem('raymonds-regulars-club');
            }
        }

        Object.values(state.sliders).forEach((input) => input.addEventListener('input', update));

        document.querySelectorAll('[data-preset]').forEach((button) => {
            button.addEventListener('click', () => {
                const preset = presets[button.dataset.preset];
                Object.entries(preset).forEach(([key, value]) => {
                    state.sliders[key].value = value;
                });
                update();
            });
        });

        document.getElementById('nextScenario').addEventListener('click', () => {
            state.scenarioIndex = (state.scenarioIndex + 1) % scenarios.length;
            update();
        });

        document.getElementById('randomize').addEventListener('click', () => {
            Object.values(state.sliders).forEach((input) => {
                input.value = Math.floor(Math.random() * 11);
            });
            state.scenarioIndex = Math.floor(Math.random() * scenarios.length);
            update();
        });

        signName.addEventListener('input', () => {
            if (!signName.textContent.trim()) signName.textContent = "Raymond's";
            persist();
        });

        signName.addEventListener('blur', () => {
            signName.textContent = signName.textContent.trim() || "Raymond's";
            persist();
        });

        loadSaved();
        update();
    </script>
</body>
</html>
