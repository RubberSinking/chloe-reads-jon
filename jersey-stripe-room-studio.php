<?php
$sourceTitle = 'Lifehack: Sports Jersey Stripes as Paint Design for Room';
$sourceUrl = 'https://jona.ca/2005/11/lifehack-sports-jersey-stripes-as.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jersey Stripe Room Studio</title>
    <style>
        :root {
            --ink: #1d2331;
            --paper: #f5efe2;
            --paper-2: #eadfc9;
            --panel: rgba(253, 249, 241, 0.84);
            --shadow: rgba(36, 29, 16, 0.18);
            --line: rgba(59, 43, 16, 0.16);
            --accent: #c34f30;
            --accent-deep: #8e3219;
            --gold: #c59b3e;
            --wall-base: #f6f0e2;
            --stripe-a: #1b4f72;
            --stripe-b: #f4b942;
            --stripe-c: #a1262d;
            --trim: #fff6df;
            --floor: #6b472d;
            --poster: #20314d;
            --poster-ink: #f7e0aa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Trebuchet MS", "Gill Sans", Verdana, sans-serif;
            background:
                radial-gradient(circle at top, rgba(255, 247, 230, 0.62), transparent 28%),
                linear-gradient(135deg, #3a2216 0%, #7a4e2c 38%, #d6b47b 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.01)),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140' viewBox='0 0 140 140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='1.1' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='140' height='140' filter='url(%23n)' opacity='.06'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            opacity: 0.8;
        }

        .page {
            width: min(1220px, calc(100vw - 28px));
            margin: 20px auto;
            padding: 20px;
            border-radius: 34px;
            background:
                linear-gradient(180deg, rgba(255, 250, 242, 0.94), rgba(244, 234, 213, 0.96));
            box-shadow:
                0 32px 90px rgba(25, 13, 6, 0.24),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            position: relative;
        }

        .page::after {
            content: "";
            position: absolute;
            inset: 14px;
            border: 1px solid rgba(91, 56, 18, 0.12);
            border-radius: 26px;
            pointer-events: none;
        }

        .masthead {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
            gap: 22px;
            align-items: stretch;
        }

        .hero,
        .controls,
        .notes,
        .recipe {
            position: relative;
            border: 1px solid var(--line);
            border-radius: 28px;
            background: var(--panel);
            backdrop-filter: blur(12px);
            box-shadow: 0 18px 40px var(--shadow);
        }

        .hero {
            padding: 34px;
            overflow: hidden;
            background:
                linear-gradient(135deg, rgba(255, 251, 243, 0.92), rgba(243, 225, 189, 0.84)),
                radial-gradient(circle at top right, rgba(195, 79, 48, 0.16), transparent 38%);
        }

        .kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 0.79rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            background: rgba(32, 49, 77, 0.08);
            color: #61452a;
        }

        .kicker::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: linear-gradient(180deg, #ffcb63, #bc5d24);
            box-shadow: 0 0 0 5px rgba(255, 203, 99, 0.18);
        }

        h1 {
            margin: 18px 0 12px;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: clamp(2.4rem, 5vw, 4.8rem);
            line-height: 0.96;
            letter-spacing: -0.05em;
            color: #201816;
            max-width: 10ch;
        }

        .lede {
            max-width: 60ch;
            font-size: 1.04rem;
            line-height: 1.7;
            margin: 0 0 24px;
            color: #483522;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .hero-links a,
        .hero-links button,
        .recipe button {
            appearance: none;
            border: none;
            cursor: pointer;
            font: inherit;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .cta {
            padding: 13px 18px;
            border-radius: 15px;
            background: linear-gradient(180deg, #243754, #16253f);
            color: #fff2cf;
            box-shadow: 0 16px 28px rgba(19, 25, 43, 0.24);
        }

        .cta:hover,
        .cta:focus-visible {
            transform: translateY(-2px);
            box-shadow: 0 22px 34px rgba(19, 25, 43, 0.28);
        }

        .ghost {
            padding: 13px 18px;
            border-radius: 15px;
            background: rgba(255, 247, 230, 0.88);
            color: #704626;
            box-shadow: inset 0 0 0 1px rgba(112, 70, 38, 0.12);
        }

        .hero-badges {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 26px;
        }

        .badge {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.48);
            border: 1px solid rgba(80, 55, 27, 0.12);
        }

        .badge strong {
            display: block;
            font-size: 1.35rem;
            font-family: "Palatino Linotype", Georgia, serif;
            margin-bottom: 4px;
        }

        .badge span {
            font-size: 0.88rem;
            color: #6f553a;
        }

        .preview-shell {
            position: relative;
            min-height: 520px;
            padding: 18px;
            overflow: hidden;
            background:
                linear-gradient(180deg, rgba(244, 236, 217, 0.92), rgba(239, 224, 198, 0.88));
        }

        .preview-shell::before,
        .preview-shell::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            filter: blur(10px);
            opacity: 0.24;
        }

        .preview-shell::before {
            right: -40px;
            top: -50px;
            background: radial-gradient(circle, rgba(195, 79, 48, 0.9), transparent 65%);
        }

        .preview-shell::after {
            left: -60px;
            bottom: -70px;
            background: radial-gradient(circle, rgba(33, 71, 128, 0.9), transparent 68%);
        }

        .room-frame {
            position: relative;
            height: 100%;
            min-height: 484px;
            border-radius: 24px;
            border: 1px solid rgba(95, 70, 35, 0.18);
            padding: 18px;
            background: rgba(255, 251, 243, 0.62);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.7);
        }

        .room-label {
            position: absolute;
            top: 22px;
            left: 22px;
            z-index: 2;
            padding: 10px 14px;
            border-radius: 14px;
            background: rgba(255, 249, 236, 0.88);
            border: 1px solid rgba(88, 54, 22, 0.14);
            box-shadow: 0 8px 24px rgba(50, 33, 12, 0.12);
        }

        .room-label small {
            display: block;
            font-size: 0.74rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #8a694c;
        }

        .room-label strong {
            font-family: "Palatino Linotype", Georgia, serif;
            font-size: 1.28rem;
            color: #2a2018;
        }

        .room {
            position: absolute;
            inset: 74px 18px 18px;
            border-radius: 20px;
            overflow: hidden;
            background:
                linear-gradient(to right,
                    var(--wall-base) 0%,
                    var(--wall-base) 22%,
                    var(--stripe-a) 22%,
                    var(--stripe-a) 34%,
                    var(--trim) 34%,
                    var(--trim) 37%,
                    var(--stripe-b) 37%,
                    var(--stripe-b) 62%,
                    var(--trim) 62%,
                    var(--trim) 65%,
                    var(--stripe-c) 65%,
                    var(--stripe-c) 78%,
                    var(--wall-base) 78%,
                    var(--wall-base) 100%);
            box-shadow:
                inset 0 1px 0 rgba(255, 255, 255, 0.5),
                inset 0 -20px 28px rgba(0, 0, 0, 0.08);
        }

        .ceiling-beam {
            position: absolute;
            inset: 0 0 auto;
            height: 16px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.68), rgba(204, 175, 125, 0.25));
            border-bottom: 1px solid rgba(86, 57, 20, 0.12);
        }

        .poster {
            position: absolute;
            border-radius: 18px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0)),
                var(--poster);
            color: var(--poster-ink);
            padding: 18px 16px;
            border: 1px solid rgba(255, 240, 214, 0.16);
            box-shadow: 0 18px 26px rgba(18, 22, 38, 0.22);
        }

        .poster h3,
        .poster p {
            margin: 0;
        }

        .poster h3 {
            font-size: 0.9rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .poster p {
            font-family: "Palatino Linotype", Georgia, serif;
            font-size: 1.24rem;
            line-height: 1.1;
        }

        .poster-left {
            top: 58px;
            left: 34px;
            width: 132px;
            transform: rotate(-5deg);
        }

        .poster-right {
            top: 78px;
            right: 36px;
            width: 140px;
            transform: rotate(4deg);
        }

        .bed {
            position: absolute;
            right: 32px;
            bottom: 70px;
            width: min(38%, 230px);
            aspect-ratio: 1.3;
            border-radius: 24px 24px 18px 18px;
            background: linear-gradient(180deg, #986746, #70482e);
            box-shadow: 0 24px 30px rgba(47, 23, 9, 0.28);
        }

        .bed::before {
            content: "";
            position: absolute;
            inset: 18px 16px 28px;
            border-radius: 20px;
            background:
                linear-gradient(135deg, rgba(255,255,255,0.28), transparent 45%),
                linear-gradient(90deg, var(--stripe-a) 0 33%, var(--trim) 33% 39%, var(--stripe-b) 39% 68%, var(--trim) 68% 74%, var(--stripe-c) 74% 100%);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.52);
        }

        .rug {
            position: absolute;
            left: 50%;
            bottom: 24px;
            transform: translateX(-50%) perspective(540px) rotateX(66deg);
            width: min(60%, 320px);
            height: 96px;
            border-radius: 18px;
            background:
                repeating-linear-gradient(90deg,
                    rgba(255,255,255,0.28) 0 8px,
                    rgba(255,255,255,0.04) 8px 16px),
                linear-gradient(90deg, var(--stripe-c), var(--trim), var(--stripe-b), var(--trim), var(--stripe-a));
            box-shadow: 0 16px 28px rgba(50, 34, 13, 0.16);
        }

        .desk {
            position: absolute;
            left: 42px;
            bottom: 82px;
            width: min(34%, 190px);
            height: 84px;
        }

        .desk-top {
            position: absolute;
            inset: 0 0 auto;
            height: 16px;
            border-radius: 10px;
            background: linear-gradient(180deg, #825235, #5f3920);
            box-shadow: 0 8px 14px rgba(40, 20, 8, 0.2);
        }

        .desk-leg {
            position: absolute;
            top: 14px;
            width: 10px;
            height: 70px;
            border-radius: 5px;
            background: #56321c;
        }

        .desk-leg.left { left: 12px; }
        .desk-leg.right { right: 12px; }

        .lamp {
            position: absolute;
            left: 24px;
            top: -26px;
            width: 50px;
            height: 50px;
            border-radius: 0 0 50% 50%;
            background: linear-gradient(180deg, #f8ca6c, #bd712c);
            box-shadow: 0 12px 20px rgba(216, 170, 74, 0.32);
        }

        .lamp::before {
            content: "";
            position: absolute;
            left: 22px;
            top: 48px;
            width: 5px;
            height: 30px;
            border-radius: 3px;
            background: #6f4622;
        }

        .shelf {
            position: absolute;
            left: 50%;
            top: 142px;
            transform: translateX(-50%);
            width: min(34%, 200px);
            height: 18px;
            border-radius: 10px;
            background: linear-gradient(180deg, #825235, #5f3920);
            box-shadow: 0 12px 18px rgba(44, 20, 7, 0.18);
        }

        .book,
        .book::after {
            position: absolute;
            bottom: 18px;
            border-radius: 5px 5px 0 0;
        }

        .book {
            width: 20px;
            background: var(--accent);
        }

        .book::after {
            content: "";
            left: 3px;
            right: 3px;
            top: 5px;
            height: 3px;
            background: rgba(255,255,255,0.35);
        }

        .book.one { left: 22px; height: 56px; background: #20314d; }
        .book.two { left: 48px; height: 68px; background: #b64334; }
        .book.three { left: 74px; height: 62px; background: #e8b33f; }
        .book.four { left: 102px; height: 54px; background: #4c7a49; }
        .book.five { left: 130px; height: 76px; background: #7e4f9f; }

        .window {
            position: absolute;
            left: 32px;
            top: 88px;
            width: min(28%, 166px);
            aspect-ratio: 0.88;
            border-radius: 20px;
            overflow: hidden;
            background: linear-gradient(180deg, #cae8ff, #89bde6 58%, #4e7b9f);
            border: 10px solid rgba(255, 247, 230, 0.92);
            box-shadow: 0 20px 28px rgba(28, 42, 55, 0.16);
        }

        .window::before,
        .window::after {
            content: "";
            position: absolute;
            background: rgba(255,255,255,0.72);
        }

        .window::before {
            inset: 0;
            clip-path: polygon(0 65%, 35% 54%, 55% 62%, 80% 46%, 100% 57%, 100% 100%, 0 100%);
            background: linear-gradient(180deg, #9bcc8b, #4d8458);
            top: auto;
            height: 48%;
        }

        .window::after {
            left: calc(50% - 2px);
            top: 0;
            width: 4px;
            height: 100%;
            box-shadow: -68px 0 0 rgba(255,255,255,0.72), 68px 0 0 rgba(255,255,255,0.72);
        }

        .floor {
            position: absolute;
            inset: auto 0 0;
            height: 22%;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.08), transparent 18%),
                repeating-linear-gradient(90deg,
                    rgba(255,255,255,0.06) 0 18px,
                    rgba(0,0,0,0.06) 18px 20px,
                    transparent 20px 74px),
                linear-gradient(180deg, color-mix(in srgb, var(--floor) 84%, #000 16%), var(--floor));
            border-top: 1px solid rgba(40, 23, 8, 0.16);
        }

        .controls {
            padding: 22px;
        }

        .controls h2,
        .notes h2,
        .recipe h2 {
            margin: 0 0 8px;
            font-family: "Palatino Linotype", Georgia, serif;
            font-size: 1.75rem;
            color: #251c18;
        }

        .section-copy {
            margin: 0 0 18px;
            line-height: 1.65;
            color: #5d442e;
        }

        .preset-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }

        .preset-card {
            padding: 14px;
            border-radius: 18px;
            border: 1px solid rgba(88, 54, 22, 0.12);
            background: rgba(255,255,255,0.56);
            text-align: left;
            color: #38281d;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
        }

        .preset-card:hover,
        .preset-card:focus-visible,
        .preset-card.is-active {
            transform: translateY(-2px);
            background: rgba(255, 249, 236, 0.96);
            box-shadow:
                0 14px 22px rgba(50, 30, 10, 0.14),
                inset 0 1px 0 rgba(255,255,255,0.88);
        }

        .swatches {
            display: flex;
            gap: 6px;
            margin-bottom: 10px;
        }

        .swatch {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            border: 2px solid rgba(255,255,255,0.85);
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        }

        .preset-card strong {
            display: block;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .preset-card span {
            font-size: 0.88rem;
            color: #73563b;
            line-height: 1.45;
        }

        .sliders {
            display: grid;
            gap: 14px;
        }

        .field {
            display: grid;
            grid-template-columns: 110px minmax(0, 1fr) 58px;
            gap: 12px;
            align-items: center;
        }

        .field label {
            font-size: 0.92rem;
            color: #533c2a;
        }

        .field output {
            justify-self: end;
            font-size: 0.84rem;
            color: #7b5b41;
        }

        input[type="range"] {
            width: 100%;
            appearance: none;
            height: 10px;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(32, 49, 77, 0.2), rgba(195, 79, 48, 0.34));
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: linear-gradient(180deg, #fff5da, #cf8b33);
            border: 2px solid #7d5321;
            box-shadow: 0 6px 12px rgba(50, 28, 9, 0.2);
        }

        input[type="color"] {
            width: 100%;
            height: 44px;
            padding: 0;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .palette {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .color-field {
            padding: 12px;
            border-radius: 18px;
            background: rgba(255,255,255,0.48);
            border: 1px solid rgba(88, 54, 22, 0.1);
        }

        .color-field span {
            display: block;
            font-size: 0.84rem;
            margin-bottom: 8px;
            color: #6c4d34;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(320px, 0.92fr);
            gap: 22px;
            margin-top: 22px;
        }

        .notes {
            padding: 28px;
        }

        .legend {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        .legend-item {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 12px;
            align-items: start;
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.42);
        }

        .legend-chip {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            margin-top: 3px;
            box-shadow: 0 0 0 4px rgba(255,255,255,0.42);
        }

        .legend-item strong {
            display: block;
            margin-bottom: 3px;
            color: #37271a;
        }

        .legend-item span {
            color: #6b533d;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .recipe {
            padding: 28px;
            background:
                linear-gradient(180deg, rgba(35, 47, 76, 0.95), rgba(23, 34, 57, 0.96));
            color: #f4e8c6;
        }

        .recipe h2,
        .recipe p {
            color: inherit;
        }

        .formula {
            margin-top: 16px;
            padding: 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            font-family: "Courier New", monospace;
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .recipe-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }

        .recipe button {
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(255,255,255,0.08);
            color: #fff0c0;
            border: 1px solid rgba(255,255,255,0.12);
        }

        .recipe button:hover,
        .recipe button:focus-visible {
            transform: translateY(-2px);
            background: rgba(255,255,255,0.14);
        }

        .inspired {
            margin-top: 18px;
            color: #6a4b2f;
            font-size: 0.95rem;
        }

        .inspired a,
        .footer-link {
            color: #9a3f24;
        }

        .footer {
            margin-top: 22px;
            display: flex;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            font-size: 0.88rem;
            color: #735940;
        }

        .footer-link {
            text-decoration: none;
            font-weight: 600;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 980px) {
            .masthead,
            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .preview-shell {
                min-height: 460px;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100vw - 16px, 100%);
                padding: 10px;
                border-radius: 26px;
                margin: 8px auto;
            }

            .hero,
            .controls,
            .notes,
            .recipe {
                border-radius: 22px;
            }

            .hero {
                padding: 24px 20px;
            }

            .hero-badges,
            .preset-grid,
            .palette {
                grid-template-columns: 1fr;
            }

            .field {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .field output {
                justify-self: start;
            }

            .preview-shell {
                min-height: 420px;
                padding: 12px;
            }

            .room {
                inset: 74px 12px 12px;
            }

            .room-label {
                left: 14px;
                right: 14px;
                top: 14px;
            }

            .poster-left,
            .poster-right {
                width: 108px;
                padding: 14px 12px;
            }

            .poster-left { left: 14px; }
            .poster-right { right: 14px; top: 88px; }

            .window {
                left: 14px;
                top: 128px;
                width: 104px;
            }

            .shelf {
                top: 112px;
                width: 150px;
            }

            .desk {
                left: 14px;
                bottom: 84px;
                width: 120px;
            }

            .bed {
                right: 14px;
                width: 148px;
                bottom: 82px;
            }

            .rug {
                width: 210px;
                height: 84px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="masthead">
            <article class="hero">
                <div class="kicker">Wall color mischief with surprisingly decent taste</div>
                <h1>Jersey Stripe Room Studio</h1>
                <p class="lede">Turn a beloved color scheme into a bedroom that feels like a team poster, a retro game hideout, or a suspiciously stylish little shrine to one very specific obsession. Slide the stripe widths, recolor the room, and see whether your brilliant idea is bold or merely loud.</p>
                <div class="hero-links">
                    <button class="cta" id="surpriseButton" type="button">Surprise me</button>
                    <button class="ghost" id="nathanModeButton" type="button">Nathan mode</button>
                </div>
                <div class="hero-badges">
                    <div class="badge">
                        <strong>5</strong>
                        <span>ready-made stripe moods to riff on</span>
                    </div>
                    <div class="badge">
                        <strong>Live</strong>
                        <span>room preview with posters, bedspread, and rug</span>
                    </div>
                    <div class="badge">
                        <strong>1 click</strong>
                        <span>copyable paint-plan summary for the sensible future self</span>
                    </div>
                </div>
                <p class="inspired">Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>"><?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>.</p>
            </article>

            <section class="preview-shell" aria-label="Interactive room preview">
                <div class="room-frame">
                    <div class="room-label">
                        <small>Current concept</small>
                        <strong id="roomName">Canucks Stripe Den</strong>
                    </div>
                    <div class="room" id="room">
                        <div class="ceiling-beam"></div>
                        <div class="poster poster-left">
                            <h3 id="posterOneLabel">Mood</h3>
                            <p id="posterOneText">Game<br>Night</p>
                        </div>
                        <div class="poster poster-right">
                            <h3 id="posterTwoLabel">Vibe</h3>
                            <p id="posterTwoText">Bold<br>but tidy</p>
                        </div>
                        <div class="window"></div>
                        <div class="shelf">
                            <div class="book one"></div>
                            <div class="book two"></div>
                            <div class="book three"></div>
                            <div class="book four"></div>
                            <div class="book five"></div>
                        </div>
                        <div class="desk">
                            <div class="desk-top"></div>
                            <div class="desk-leg left"></div>
                            <div class="desk-leg right"></div>
                            <div class="lamp"></div>
                        </div>
                        <div class="bed"></div>
                        <div class="rug"></div>
                        <div class="floor"></div>
                    </div>
                </div>
            </section>
        </section>

        <section class="bottom-grid">
            <section class="controls">
                <h2>Pick a stripe story</h2>
                <p class="section-copy">Start with a preset, then nudge the widths until the room feels intentional instead of accidentally patriotic. The slider math updates the wall, bedspread, and rug together so the whole thing feels like a coherent little kingdom.</p>

                <div class="preset-grid" id="presetGrid"></div>

                <div class="sliders">
                    <div class="field">
                        <label for="stripeAWidth">Stripe A width</label>
                        <input id="stripeAWidth" type="range" min="10" max="28" value="12">
                        <output for="stripeAWidth" id="stripeAWidthValue">12%</output>
                    </div>
                    <div class="field">
                        <label for="stripeBWidth">Stripe B width</label>
                        <input id="stripeBWidth" type="range" min="10" max="32" value="25">
                        <output for="stripeBWidth" id="stripeBWidthValue">25%</output>
                    </div>
                    <div class="field">
                        <label for="stripeCWidth">Stripe C width</label>
                        <input id="stripeCWidth" type="range" min="8" max="24" value="13">
                        <output for="stripeCWidth" id="stripeCWidthValue">13%</output>
                    </div>
                    <div class="field">
                        <label for="trimWidth">Trim line</label>
                        <input id="trimWidth" type="range" min="2" max="8" value="3">
                        <output for="trimWidth" id="trimWidthValue">3%</output>
                    </div>
                </div>

                <div class="palette">
                    <label class="color-field">
                        <span>Wall base</span>
                        <input id="wallBase" type="color" value="#f6f0e2">
                    </label>
                    <label class="color-field">
                        <span>Stripe A</span>
                        <input id="stripeA" type="color" value="#1b4f72">
                    </label>
                    <label class="color-field">
                        <span>Stripe B</span>
                        <input id="stripeB" type="color" value="#f4b942">
                    </label>
                    <label class="color-field">
                        <span>Stripe C</span>
                        <input id="stripeC" type="color" value="#a1262d">
                    </label>
                    <label class="color-field">
                        <span>Trim</span>
                        <input id="trim" type="color" value="#fff6df">
                    </label>
                    <label class="color-field">
                        <span>Floor wood</span>
                        <input id="floor" type="color" value="#6b472d">
                    </label>
                </div>
            </section>

            <section class="notes">
                <h2>How to make it work</h2>
                <p class="section-copy">The room usually behaves best when one stripe is the hero, one stripe is support, and the trim does the civilizing. Otherwise your eyes begin doing burpees.</p>
                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-chip" style="background:#20314d"></div>
                        <div><strong>Anchor stripe</strong><span>Use the darkest color as the quiet stabilizer. It keeps the room from feeling like a candy wrapper on the loose.</span></div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-chip" style="background:#c59b3e"></div>
                        <div><strong>Shiny stripe</strong><span>Warm golds and creams help the room feel cheerful instead of militant. Very useful when the main palette is intense.</span></div>
                    </div>
                    <div class="legend-item">
                        <div class="legend-chip" style="background:#c34f30"></div>
                        <div><strong>Accent stripe</strong><span>Keep the punchy accent narrower if you want the room to feel clever, or wider if you want it to shout “Nathan definitely picked this.”</span></div>
                    </div>
                </div>
                <div class="footer">
                    <span>Built as a single little sandbox for Jon’s web lab.</span>
                    <a class="footer-link" href="index.php">Back to Chloe Reads Jon</a>
                </div>
            </section>

            <section class="recipe">
                <h2>Paint-plan readout</h2>
                <p class="section-copy">A tidy summary for when Future Jon wants to remember which version looked delightfully eccentric and which one looked like a hockey penalty box.</p>
                <div class="formula" id="formulaBox">Loading stripe wisdom...</div>
                <div class="recipe-actions">
                    <button type="button" id="copyPlanButton">Copy plan</button>
                    <button type="button" id="calmifyButton">Calm it down</button>
                </div>
            </section>
        </section>
    </main>

    <script>
        const presets = [
            {
                name: 'Canucks Stripe Den',
                tagline: 'Classic rink energy with warm gold trim and very Canadian self-control.',
                palette: { wallBase: '#f6f0e2', stripeA: '#173a63', stripeB: '#d4a338', stripeC: '#a52b39', trim: '#fff2d2', floor: '#6b472d' },
                widths: { stripeAWidth: 12, stripeBWidth: 25, stripeCWidth: 13, trimWidth: 3 },
                poster: ['Mood', 'Game\\nNight', 'Vibe', 'Bold\\nbut tidy']
            },
            {
                name: 'Knight Rider Garage',
                tagline: 'Blacktop, red pulse, and enough chrome bravado to make KITT mildly smug.',
                palette: { wallBase: '#ddd7d0', stripeA: '#171717', stripeB: '#ca1f27', stripeC: '#767676', trim: '#f7f0e9', floor: '#4d372c' },
                widths: { stripeAWidth: 20, stripeBWidth: 12, stripeCWidth: 16, trimWidth: 4 },
                poster: ['Mode', 'Turbo\\nBoost', 'Status', 'Pursuit\\nready']
            },
            {
                name: 'Hyrule Lantern Loft',
                tagline: 'Forest green and treasure-map gold with a small chance of finding a hidden chest under the bed.',
                palette: { wallBase: '#f2e8cf', stripeA: '#2d6147', stripeB: '#d8b24c', stripeC: '#7f5f1f', trim: '#fff7df', floor: '#67462d' },
                widths: { stripeAWidth: 16, stripeBWidth: 18, stripeCWidth: 10, trimWidth: 4 },
                poster: ['Quest', 'Map\\nRoom', 'Loot', 'One more\\nheart']
            },
            {
                name: 'Mushroom Cup Corner',
                tagline: 'Playful Mario-circuit colors for a room that looks like it eats banana peels for breakfast.',
                palette: { wallBase: '#f8f0e4', stripeA: '#d93f2c', stripeB: '#3d77d9', stripeC: '#ffd046', trim: '#fff8ef', floor: '#855c3b' },
                widths: { stripeAWidth: 14, stripeBWidth: 17, stripeCWidth: 19, trimWidth: 3 },
                poster: ['Speed', 'Lap\\nThree', 'Hazard', 'Banana\\nzone']
            },
            {
                name: 'Catholic Study Nook',
                tagline: 'Burgundy, parchment, and candlelight for the child who somehow wants both reverence and panache.',
                palette: { wallBase: '#f3ebdd', stripeA: '#5f1f2e', stripeB: '#ccab63', stripeC: '#213249', trim: '#fff6df', floor: '#715035' },
                widths: { stripeAWidth: 11, stripeBWidth: 20, stripeCWidth: 15, trimWidth: 3 },
                poster: ['Reading', 'Quiet\\nHour', 'Aim', 'Hope\\nand grit']
            }
        ];

        const root = document.documentElement;
        const inputs = {
            stripeAWidth: document.getElementById('stripeAWidth'),
            stripeBWidth: document.getElementById('stripeBWidth'),
            stripeCWidth: document.getElementById('stripeCWidth'),
            trimWidth: document.getElementById('trimWidth'),
            wallBase: document.getElementById('wallBase'),
            stripeA: document.getElementById('stripeA'),
            stripeB: document.getElementById('stripeB'),
            stripeC: document.getElementById('stripeC'),
            trim: document.getElementById('trim'),
            floor: document.getElementById('floor')
        };
        const outputs = {
            stripeAWidth: document.getElementById('stripeAWidthValue'),
            stripeBWidth: document.getElementById('stripeBWidthValue'),
            stripeCWidth: document.getElementById('stripeCWidthValue'),
            trimWidth: document.getElementById('trimWidthValue')
        };
        const formulaBox = document.getElementById('formulaBox');
        const roomName = document.getElementById('roomName');
        const posterOneLabel = document.getElementById('posterOneLabel');
        const posterOneText = document.getElementById('posterOneText');
        const posterTwoLabel = document.getElementById('posterTwoLabel');
        const posterTwoText = document.getElementById('posterTwoText');
        const presetGrid = document.getElementById('presetGrid');

        let activePresetIndex = 0;

        function renderPresetButtons() {
            presetGrid.innerHTML = '';
            presets.forEach((preset, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'preset-card' + (index === activePresetIndex ? ' is-active' : '');
                button.dataset.index = index;
                button.innerHTML = `
                    <div class="swatches">
                        <span class="swatch" style="background:${preset.palette.stripeA}"></span>
                        <span class="swatch" style="background:${preset.palette.stripeB}"></span>
                        <span class="swatch" style="background:${preset.palette.stripeC}"></span>
                    </div>
                    <strong>${preset.name}</strong>
                    <span>${preset.tagline}</span>
                `;
                button.addEventListener('click', () => applyPreset(index));
                presetGrid.appendChild(button);
            });
        }

        function applyPreset(index) {
            activePresetIndex = index;
            const preset = presets[index];
            Object.entries(preset.palette).forEach(([key, value]) => {
                inputs[key].value = value;
            });
            Object.entries(preset.widths).forEach(([key, value]) => {
                inputs[key].value = value;
            });
            posterOneLabel.textContent = preset.poster[0];
            posterOneText.innerHTML = preset.poster[1].replaceAll('\\n', '<br>');
            posterTwoLabel.textContent = preset.poster[2];
            posterTwoText.innerHTML = preset.poster[3].replaceAll('\\n', '<br>');
            roomName.textContent = preset.name;
            renderPresetButtons();
            updateRoom();
        }

        function clampWidths() {
            const a = Number(inputs.stripeAWidth.value);
            const b = Number(inputs.stripeBWidth.value);
            const c = Number(inputs.stripeCWidth.value);
            const trim = Number(inputs.trimWidth.value);
            const totalReserved = a + b + c + trim * 2;
            const availableBase = Math.max(18, 100 - totalReserved);
            return { a, b, c, trim, base: availableBase };
        }

        function updateRoom() {
            const widths = clampWidths();
            outputs.stripeAWidth.textContent = widths.a + '%';
            outputs.stripeBWidth.textContent = widths.b + '%';
            outputs.stripeCWidth.textContent = widths.c + '%';
            outputs.trimWidth.textContent = widths.trim + '%';

            root.style.setProperty('--wall-base', inputs.wallBase.value);
            root.style.setProperty('--stripe-a', inputs.stripeA.value);
            root.style.setProperty('--stripe-b', inputs.stripeB.value);
            root.style.setProperty('--stripe-c', inputs.stripeC.value);
            root.style.setProperty('--trim', inputs.trim.value);
            root.style.setProperty('--floor', inputs.floor.value);

            const wallEdge = Math.floor(widths.base / 2);
            const firstStripeStart = wallEdge;
            const firstStripeEnd = firstStripeStart + widths.a;
            const firstTrimEnd = firstStripeEnd + widths.trim;
            const secondStripeEnd = firstTrimEnd + widths.b;
            const secondTrimEnd = secondStripeEnd + widths.trim;
            const thirdStripeEnd = secondTrimEnd + widths.c;

            const wallGradient = `linear-gradient(to right,
                ${inputs.wallBase.value} 0%,
                ${inputs.wallBase.value} ${firstStripeStart}%,
                ${inputs.stripeA.value} ${firstStripeStart}%,
                ${inputs.stripeA.value} ${firstStripeEnd}%,
                ${inputs.trim.value} ${firstStripeEnd}%,
                ${inputs.trim.value} ${firstTrimEnd}%,
                ${inputs.stripeB.value} ${firstTrimEnd}%,
                ${inputs.stripeB.value} ${secondStripeEnd}%,
                ${inputs.trim.value} ${secondStripeEnd}%,
                ${inputs.trim.value} ${secondTrimEnd}%,
                ${inputs.stripeC.value} ${secondTrimEnd}%,
                ${inputs.stripeC.value} ${thirdStripeEnd}%,
                ${inputs.wallBase.value} ${thirdStripeEnd}%,
                ${inputs.wallBase.value} 100%)`;

            document.getElementById('room').style.background = wallGradient;
            updateFormula(widths);
        }

        function updateFormula(widths) {
            const quietScore = Math.max(0, 100 - Math.abs(widths.b - widths.a) * 2 - widths.c + widths.trim * 4);
            const punchScore = Math.min(100, widths.c * 4 + widths.b * 2 + (inputs.stripeC.value === '#ca1f27' ? 8 : 0));
            const playScore = Math.min(100, widths.b * 3 + widths.trim * 7);
            const summary = quietScore > 70
                ? 'surprisingly composed'
                : quietScore > 52
                    ? 'spirited but sensible'
                    : 'magnificently rowdy';

            formulaBox.textContent =
`ROOM: ${roomName.textContent}
WALL BASE: ${inputs.wallBase.value.toUpperCase()}
STRIPES: A ${inputs.stripeA.value.toUpperCase()} at ${widths.a}% | B ${inputs.stripeB.value.toUpperCase()} at ${widths.b}% | C ${inputs.stripeC.value.toUpperCase()} at ${widths.c}%
TRIM: ${inputs.trim.value.toUpperCase()} at ${widths.trim}% separators
FLOOR: ${inputs.floor.value.toUpperCase()}
READ: ${summary}
SCORES: calm ${quietScore}/100 | punch ${punchScore}/100 | play ${playScore}/100
TIP: ${generateTip(widths, quietScore, punchScore, playScore)}`;
        }

        function generateTip(widths, quietScore, punchScore, playScore) {
            if (quietScore < 48) {
                return 'Widen the wall base or shrink Stripe C if you want fewer visual elbows being thrown.';
            }
            if (punchScore < 40) {
                return 'A little more Stripe C or a darker Stripe A would make the room feel less shy.';
            }
            if (playScore > 78) {
                return 'This one is gloriously toy-chest coded. Perfect for Nathan mode, slightly bolder than adult diplomacy usually permits.';
            }
            if (widths.trim <= 2) {
                return 'A slightly thicker trim can rescue the palette from turning into one long color argument.';
            }
            return 'This balance is doing the nice thing where it feels themed without looking trapped inside a merchandise catalog.';
        }

        function surpriseMe() {
            const presetIndex = Math.floor(Math.random() * presets.length);
            applyPreset(presetIndex);
            ['stripeAWidth', 'stripeBWidth', 'stripeCWidth', 'trimWidth'].forEach((key) => {
                const input = inputs[key];
                const min = Number(input.min);
                const max = Number(input.max);
                input.value = String(Math.floor(Math.random() * (max - min + 1)) + min);
            });
            updateRoom();
        }

        function calmify() {
            inputs.stripeAWidth.value = Math.max(12, Number(inputs.stripeAWidth.value) - 2);
            inputs.stripeBWidth.value = Math.max(14, Number(inputs.stripeBWidth.value) - 3);
            inputs.stripeCWidth.value = Math.max(8, Number(inputs.stripeCWidth.value) - 2);
            inputs.trimWidth.value = Math.min(6, Number(inputs.trimWidth.value) + 1);
            updateRoom();
        }

        function nathanMode() {
            applyPreset(3);
            roomName.textContent = 'Nathan Turbo Bedroom';
            posterOneLabel.textContent = 'Mission';
            posterOneText.innerHTML = 'Treasure<br>run';
            posterTwoLabel.textContent = 'Rule';
            posterTwoText.innerHTML = 'No boring<br>corners';
            updateRoom();
        }

        async function copyPlan() {
            try {
                await navigator.clipboard.writeText(formulaBox.textContent);
                document.getElementById('copyPlanButton').textContent = 'Copied';
                window.setTimeout(() => {
                    document.getElementById('copyPlanButton').textContent = 'Copy plan';
                }, 1400);
            } catch (error) {
                document.getElementById('copyPlanButton').textContent = 'Clipboard said no';
                window.setTimeout(() => {
                    document.getElementById('copyPlanButton').textContent = 'Copy plan';
                }, 1600);
            }
        }

        Object.values(inputs).forEach((input) => {
            input.addEventListener('input', updateRoom);
        });

        document.getElementById('surpriseButton').addEventListener('click', surpriseMe);
        document.getElementById('calmifyButton').addEventListener('click', calmify);
        document.getElementById('copyPlanButton').addEventListener('click', copyPlan);
        document.getElementById('nathanModeButton').addEventListener('click', nathanMode);

        renderPresetButtons();
        applyPreset(0);
    </script>
</body>
</html>
