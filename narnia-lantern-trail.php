<?php
$sourceTitle = 'Movie: The Chronicles of Narnia';
$sourceUrl = 'https://cooltoolsforcatholics.blogspot.com/2006/01/movie-chronicles-of-narnia.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narnia Lantern Trail</title>
    <style>
        :root {
            --night: #07111f;
            --night-2: #0d1c32;
            --ice: #dff5ff;
            --ice-2: #a8d8ef;
            --gold: #ffd37a;
            --gold-deep: #d08d30;
            --ember: #ff9d54;
            --berry: #8e426e;
            --pine: #17392d;
            --ink: #f7f3e9;
            --panel: rgba(10, 20, 35, 0.7);
            --panel-edge: rgba(255, 255, 255, 0.18);
            --shadow: 0 24px 90px rgba(0, 0, 0, 0.45);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            background:
                radial-gradient(circle at 20% 20%, rgba(95, 186, 214, 0.25), transparent 26%),
                radial-gradient(circle at 80% 8%, rgba(255, 195, 118, 0.16), transparent 22%),
                radial-gradient(circle at 50% 100%, rgba(53, 94, 132, 0.4), transparent 40%),
                linear-gradient(160deg, #08111b 0%, #10243f 50%, #08111b 100%);
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
                linear-gradient(120deg, transparent 0 32%, rgba(146, 240, 225, 0.16) 42%, transparent 50%),
                linear-gradient(210deg, transparent 0 40%, rgba(255, 210, 138, 0.12) 48%, transparent 60%);
            mix-blend-mode: screen;
            opacity: 0.85;
            animation: aurora 18s ease-in-out infinite alternate;
        }

        body::after {
            opacity: 0.15;
            background-image:
                radial-gradient(rgba(255, 255, 255, 0.9) 0.7px, transparent 0.8px),
                radial-gradient(rgba(255, 255, 255, 0.8) 0.7px, transparent 0.8px);
            background-size: 22px 22px, 34px 34px;
            background-position: 0 0, 11px 14px;
        }

        @keyframes aurora {
            0% { transform: translate3d(-2%, -1%, 0) scale(1); }
            100% { transform: translate3d(2%, 2%, 0) scale(1.08); }
        }

        .shell {
            width: min(1160px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 72px;
            position: relative;
            z-index: 1;
        }

        .hero {
            position: relative;
            padding: 32px 24px 22px;
            border: 1px solid var(--panel-edge);
            border-radius: 30px;
            background:
                linear-gradient(145deg, rgba(18, 31, 54, 0.9), rgba(5, 12, 24, 0.82)),
                radial-gradient(circle at top right, rgba(255, 212, 132, 0.15), transparent 30%);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto -20% -35% 40%;
            height: 320px;
            background: radial-gradient(circle, rgba(255, 201, 113, 0.28), transparent 65%);
            filter: blur(8px);
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.06);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .eyebrow span:last-child {
            color: var(--gold);
        }

        h1 {
            margin: 18px 0 12px;
            max-width: 10ch;
            font-family: "Baskerville", "Times New Roman", serif;
            font-size: clamp(3rem, 9vw, 6rem);
            line-height: 0.92;
            letter-spacing: -0.05em;
            text-wrap: balance;
        }

        .lede {
            max-width: 64ch;
            font-size: 1.06rem;
            line-height: 1.7;
            color: rgba(247, 243, 233, 0.86);
            margin: 0 0 22px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .button {
            appearance: none;
            border: none;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
            border-radius: 999px;
            padding: 14px 20px;
            transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .button:hover,
        .button:focus-visible {
            transform: translateY(-2px);
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.25);
            outline: none;
        }

        .button-primary {
            color: #261705;
            background: linear-gradient(135deg, #ffe0a2, #f6b65c);
        }

        .button-secondary {
            color: var(--ink);
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .hero-grid {
            margin-top: 28px;
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(300px, 0.8fr);
            gap: 18px;
        }

        .map-card,
        .status-card,
        .journey-card,
        .ending-card,
        .mini-card {
            position: relative;
            border-radius: 26px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.09), rgba(255, 255, 255, 0.04));
            backdrop-filter: blur(12px);
            box-shadow: 0 10px 34px rgba(0, 0, 0, 0.15);
        }

        .map-card {
            min-height: 340px;
            padding: 18px;
            overflow: hidden;
        }

        .map-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .map-label h2,
        .status-card h2,
        .journey-card h2,
        .ending-card h2,
        .mini-card h2 {
            margin: 0;
            font-size: 1.1rem;
            font-family: "Baskerville", "Times New Roman", serif;
            letter-spacing: 0.02em;
        }

        .map-subtitle,
        .status-card p,
        .mini-card p,
        .ending-card p {
            margin: 0;
            color: rgba(247, 243, 233, 0.74);
            line-height: 1.55;
        }

        .map-wrap {
            position: relative;
            margin-top: 12px;
            height: 260px;
            border-radius: 22px;
            overflow: hidden;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.2), transparent 20%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(0, 0, 0, 0.1)),
                linear-gradient(120deg, rgba(21, 50, 42, 0.92), rgba(9, 21, 39, 0.92));
        }

        .snow {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 10% 25%, rgba(255,255,255,0.7) 0 2px, transparent 2.4px),
                radial-gradient(circle at 70% 12%, rgba(255,255,255,0.8) 0 1.6px, transparent 2px),
                radial-gradient(circle at 85% 48%, rgba(255,255,255,0.75) 0 1.8px, transparent 2.1px),
                radial-gradient(circle at 32% 80%, rgba(255,255,255,0.8) 0 1.7px, transparent 2px),
                linear-gradient(180deg, transparent 0%, rgba(224, 240, 255, 0.07) 100%);
            opacity: 0.9;
        }

        .map-svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
        }

        .node {
            position: absolute;
            width: 120px;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .node-badge {
            width: 22px;
            height: 22px;
            margin: 0 auto 8px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.85);
            background: rgba(16, 39, 57, 0.95);
            box-shadow: 0 0 0 8px rgba(255, 255, 255, 0.04);
            transition: transform 0.28s ease, background 0.28s ease, box-shadow 0.28s ease;
        }

        .node strong {
            display: block;
            font-size: 0.85rem;
        }

        .node span {
            display: block;
            margin-top: 4px;
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: rgba(247, 243, 233, 0.66);
        }

        .node.active .node-badge {
            background: radial-gradient(circle, #ffe7b0, #f6af54 70%);
            box-shadow: 0 0 0 10px rgba(255, 207, 114, 0.12), 0 0 26px rgba(255, 184, 73, 0.6);
            transform: scale(1.14);
        }

        .node.complete .node-badge {
            background: radial-gradient(circle, #fff5d9, #ffcc6d 65%);
        }

        .node-wardrobe { top: 78%; left: 15%; }
        .node-lamp { top: 56%; left: 33%; }
        .node-beavers { top: 62%; left: 53%; }
        .node-table { top: 34%; left: 70%; }
        .node-cair { top: 18%; left: 84%; }

        .status-card {
            padding: 20px;
        }

        .meter-stack {
            display: grid;
            gap: 14px;
            margin-top: 18px;
        }

        .meter-label {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 6px;
            font-size: 0.93rem;
        }

        .meter {
            height: 11px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.08);
        }

        .meter-fill {
            height: 100%;
            width: 25%;
            border-radius: inherit;
            transition: width 0.35s ease;
        }

        .meter-courage { background: linear-gradient(90deg, #f8af71, #e25b4b); }
        .meter-truth { background: linear-gradient(90deg, #90e2ff, #58b7d9); }
        .meter-mercy { background: linear-gradient(90deg, #d5c6ff, #926ae8); }
        .meter-wonder { background: linear-gradient(90deg, #c9f09a, #77c172); }

        .status-kicker {
            margin-top: 18px;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 209, 124, 0.08);
            border: 1px solid rgba(255, 209, 124, 0.16);
            line-height: 1.55;
            color: rgba(255, 244, 219, 0.92);
        }

        .lower-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(280px, 0.95fr);
            gap: 18px;
            margin-top: 18px;
        }

        .journey-card {
            padding: 24px;
            overflow: hidden;
        }

        .journey-meta {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            color: rgba(247, 243, 233, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.72rem;
        }

        .journey-location {
            margin: 12px 0 10px;
            font-family: "Baskerville", "Times New Roman", serif;
            font-size: clamp(1.7rem, 5vw, 2.8rem);
            line-height: 0.98;
        }

        .journey-prompt {
            margin: 0 0 20px;
            line-height: 1.7;
            color: rgba(247, 243, 233, 0.86);
            font-size: 1rem;
        }

        .choices {
            display: grid;
            gap: 12px;
        }

        .choice {
            width: 100%;
            padding: 16px 18px;
            text-align: left;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            color: var(--ink);
        }

        .choice strong {
            display: block;
            margin-bottom: 6px;
            font-size: 1rem;
        }

        .choice span {
            display: block;
            color: rgba(247, 243, 233, 0.7);
            line-height: 1.5;
            font-size: 0.92rem;
        }

        .choice:hover,
        .choice:focus-visible {
            background: rgba(255, 211, 122, 0.14);
            border-color: rgba(255, 224, 172, 0.3);
        }

        .mini-column {
            display: grid;
            gap: 18px;
        }

        .mini-card {
            padding: 20px;
        }

        .travel-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .travel-tags span {
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            font-size: 0.82rem;
        }

        .progress-track {
            height: 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            overflow: hidden;
            margin-top: 14px;
        }

        .progress-fill {
            width: 0%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #ffe09a, #f1a24a, #87d5ef);
            transition: width 0.35s ease;
        }

        .ending-card {
            margin-top: 18px;
            padding: 24px;
            display: none;
        }

        .ending-card.visible {
            display: block;
        }

        .ending-grid {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) minmax(240px, 1.1fr);
            gap: 18px;
            align-items: stretch;
        }

        .passport {
            position: relative;
            overflow: hidden;
            min-height: 240px;
            padding: 20px;
            border-radius: 24px;
            background:
                linear-gradient(160deg, rgba(253, 244, 220, 0.95), rgba(248, 223, 176, 0.92)),
                radial-gradient(circle at top right, rgba(255,255,255,0.7), transparent 40%);
            color: #2d1b0c;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.22);
        }

        .passport::after {
            content: "";
            position: absolute;
            inset: 12px;
            border: 1px dashed rgba(110, 69, 24, 0.36);
            border-radius: 18px;
            pointer-events: none;
        }

        .passport small {
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .passport h3 {
            margin: 8px 0 14px;
            font-family: "Bookman Old Style", "Baskerville", serif;
            font-size: clamp(1.7rem, 5vw, 2.4rem);
            line-height: 1;
        }

        .passport p {
            color: rgba(45, 27, 12, 0.8);
            line-height: 1.6;
        }

        .passport-stamp {
            margin-top: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 92px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 2px solid rgba(103, 55, 9, 0.45);
            transform: rotate(-12deg);
            font-size: 0.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .ending-copy {
            padding: 8px 4px;
        }

        .ending-copy h3 {
            margin: 0 0 12px;
            font-family: "Baskerville", "Times New Roman", serif;
            font-size: clamp(1.7rem, 4vw, 2.4rem);
        }

        .ending-list {
            display: grid;
            gap: 10px;
            margin-top: 18px;
        }

        .ending-item {
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .source-note {
            margin-top: 18px;
            font-size: 0.95rem;
            color: rgba(247, 243, 233, 0.82);
        }

        .source-note a {
            color: #ffe2a4;
        }

        .footer-row {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            color: rgba(247, 243, 233, 0.62);
            font-size: 0.92rem;
        }

        .footer-row a {
            color: var(--ice);
        }

        .hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        @media (max-width: 920px) {
            .hero-grid,
            .lower-grid,
            .ending-grid {
                grid-template-columns: 1fr;
            }

            .map-card {
                min-height: 320px;
            }
        }

        @media (max-width: 640px) {
            .shell {
                width: min(100% - 18px, 1160px);
                padding-top: 14px;
            }

            .hero,
            .journey-card,
            .status-card,
            .mini-card,
            .ending-card {
                border-radius: 22px;
            }

            .hero {
                padding: 22px 16px 18px;
            }

            .map-card {
                padding: 14px;
            }

            .map-wrap {
                height: 240px;
            }

            .node {
                width: 90px;
            }

            .node strong {
                font-size: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="hero">
            <div class="hero-top">
                <div>
                    <div class="eyebrow">
                        <span>Lion-hearted winter arcade</span>
                        <span>4 stops</span>
                    </div>
                    <h1>Narnia Lantern Trail</h1>
                    <p class="lede">Walk from the wardrobe to Cair Paravel and decide what sort of traveller you become along the way. Each choice brightens a different virtue, and by the end you get a little Narnian travel card worthy of a proper snowy adventure.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#journey">Enter the wardrobe</a>
                        <button class="button button-secondary" id="restart-top" type="button">Shuffle a new trail</button>
                    </div>
                </div>
                <div class="mini-card" style="max-width: 290px;">
                    <h2>Good Fight Meter</h2>
                    <p>This is less about trivia and more about the sort of Christian-charged courage Jon described after watching Narnia: remorse, pride, resolve, and a bit of glorious snow.</p>
                    <div class="travel-tags">
                        <span>Courage</span>
                        <span>Truth</span>
                        <span>Mercy</span>
                        <span>Wonder</span>
                    </div>
                </div>
            </div>

            <div class="hero-grid">
                <section class="map-card" aria-labelledby="map-heading">
                    <div class="map-label">
                        <div>
                            <h2 id="map-heading">Route Across Narnia</h2>
                            <p class="map-subtitle">Your lantern path lights up one stop at a time.</p>
                        </div>
                        <span aria-live="polite" id="map-status">At the wardrobe</span>
                    </div>
                    <div class="map-wrap" aria-hidden="true">
                        <div class="snow"></div>
                        <svg class="map-svg" viewBox="0 0 1000 600" preserveAspectRatio="none">
                            <path d="M126 470C204 380 258 338 320 320C412 292 425 412 530 386C625 361 625 199 718 160C792 129 847 126 905 90" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="6" stroke-linecap="round"/>
                            <path id="trail-path" d="M126 470C204 380 258 338 320 320C412 292 425 412 530 386C625 361 625 199 718 160C792 129 847 126 905 90" fill="none" stroke="url(#trailGradient)" stroke-width="10" stroke-linecap="round" stroke-dasharray="1400" stroke-dashoffset="1400"/>
                            <defs>
                                <linearGradient id="trailGradient" x1="0%" x2="100%">
                                    <stop offset="0%" stop-color="#ffd784"/>
                                    <stop offset="45%" stop-color="#ffd784"/>
                                    <stop offset="100%" stop-color="#9be8ff"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <div class="node node-wardrobe active" data-node="0">
                            <div class="node-badge"></div>
                            <strong>Wardrobe</strong>
                            <span>Start</span>
                        </div>
                        <div class="node node-lamp" data-node="1">
                            <div class="node-badge"></div>
                            <strong>Lamp-Post Wood</strong>
                            <span>Choice I</span>
                        </div>
                        <div class="node node-beavers" data-node="2">
                            <div class="node-badge"></div>
                            <strong>Beavers' Dam</strong>
                            <span>Choice II</span>
                        </div>
                        <div class="node node-table" data-node="3">
                            <div class="node-badge"></div>
                            <strong>Stone Table</strong>
                            <span>Choice III</span>
                        </div>
                        <div class="node node-cair" data-node="4">
                            <div class="node-badge"></div>
                            <strong>Cair Paravel</strong>
                            <span>Arrival</span>
                        </div>
                    </div>
                </section>

                <aside class="status-card" aria-labelledby="status-heading">
                    <h2 id="status-heading">Trail Virtues</h2>
                    <p>Every decision nudges your journey style. You are not min-maxing. You are being splendidly, suspiciously Narnian.</p>
                    <div class="meter-stack">
                        <div>
                            <div class="meter-label"><span>Courage</span><strong id="courage-value">1</strong></div>
                            <div class="meter"><div class="meter-fill meter-courage" id="courage-meter"></div></div>
                        </div>
                        <div>
                            <div class="meter-label"><span>Truth</span><strong id="truth-value">1</strong></div>
                            <div class="meter"><div class="meter-fill meter-truth" id="truth-meter"></div></div>
                        </div>
                        <div>
                            <div class="meter-label"><span>Mercy</span><strong id="mercy-value">1</strong></div>
                            <div class="meter"><div class="meter-fill meter-mercy" id="mercy-meter"></div></div>
                        </div>
                        <div>
                            <div class="meter-label"><span>Wonder</span><strong id="wonder-value">1</strong></div>
                            <div class="meter"><div class="meter-fill meter-wonder" id="wonder-meter"></div></div>
                        </div>
                    </div>
                    <div class="status-kicker" id="status-kicker">
                        Lantern steady. Snow crisp. You are the sort of traveller who still believes a coat rack might lead somewhere marvellous.
                    </div>
                </aside>
            </div>
        </section>

        <section class="lower-grid" id="journey" style="margin-top: 18px;">
            <section class="journey-card" aria-labelledby="journey-heading">
                <div class="journey-meta">
                    <span id="step-counter">Stop 1 of 4</span>
                    <span id="step-theme">Into the snow</span>
                </div>
                <h2 class="hidden" id="journey-heading">Journey choices</h2>
                <div class="journey-location" id="journey-location">Lamp-Post Wood</div>
                <p class="journey-prompt" id="journey-prompt"></p>
                <div class="choices" id="choices"></div>
            </section>

            <aside class="mini-column">
                <section class="mini-card">
                    <h2>Trail Progress</h2>
                    <p>Finish each stop to fill the ribbon and reveal your Narnian travel card.</p>
                    <div class="progress-track" aria-hidden="true">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <div class="travel-tags" id="progress-tags">
                        <span>Lantern packed</span>
                        <span>Tea pending</span>
                        <span>Wolf rumours</span>
                    </div>
                </section>
                <section class="mini-card">
                    <h2>How This Works</h2>
                    <p>Pick one response at each stop. The ending is based on your strongest virtue, plus a small blend-note for the runner-up. Replay as often as you like and see whether you become more Lucy, Peter, Susan, or Edmund-on-a-better-day.</p>
                </section>
                <section class="mini-card">
                    <h2>Source Spark</h2>
                    <p>This little snowbound toy grew out of Jon writing that the Narnia film made him feel proud to be a Christian, remorseful about his failings, and ready to fight the good fight. Reasonable reaction, frankly.</p>
                </section>
            </aside>
        </section>

        <section class="ending-card" id="ending-card" aria-live="polite">
            <div class="ending-grid">
                <div class="passport">
                    <small>Narnian travel card</small>
                    <h3 id="ending-title">The Lantern-Bearer</h3>
                    <p id="ending-summary">You kept moving toward the light and invited others along instead of hoarding the warmth.</p>
                    <div class="passport-stamp" id="ending-stamp">Issued</div>
                </div>
                <div class="ending-copy">
                    <h3 id="ending-heading">A trail worthy of a song</h3>
                    <p id="ending-body">You finished with a mix of courage and mercy, which means you are capable of charging a castle gate and apologizing properly afterward. Rare combination. Keep it.</p>
                    <div class="ending-list" id="ending-list"></div>
                    <div class="hero-actions" style="margin-top: 18px;">
                        <button class="button button-primary" id="restart-bottom" type="button">Walk the trail again</button>
                        <a class="button button-secondary" href="#journey">Review your choices</a>
                    </div>
                </div>
            </div>
            <p class="source-note">Inspired by Jon's <a href="<?php echo htmlspecialchars($sourceUrl, ENT_QUOTES); ?>"><?php echo htmlspecialchars($sourceTitle, ENT_QUOTES); ?></a>.</p>
        </section>

        <div class="footer-row">
            <span>A tiny snowy moral arcade for Jon and Nathan.</span>
            <a href="index.php">Back to Chloe Reads Jon</a>
        </div>
    </main>

    <script>
        const steps = [
            {
                location: "Lamp-Post Wood",
                theme: "Into the snow",
                prompt: "The woods are cold, beautiful, and just a bit suspicious. Mr. Tumnus seems kind, but your stomach says this whole place deserves both wonder and caution. What do you do first?",
                tags: ["Lantern lit", "Snow squeaks", "Faun nearby"],
                choices: [
                    {
                        title: "Follow the music, but keep asking honest questions",
                        text: "Curiosity without gullibility. A very respectable combination.",
                        effect: { truth: 2, wonder: 1 },
                        note: "Your lantern glows brighter when awe and clarity travel together."
                    },
                    {
                        title: "Mark your path in the snow before you wander farther",
                        text: "Preparedness is not cowardice. It is merely future-you saying thanks.",
                        effect: { courage: 2, truth: 1 },
                        note: "You choose brave caution instead of dramatic confusion."
                    },
                    {
                        title: "Offer warmth and trust first, even in a strange place",
                        text: "You lead with gentleness and invite the world to answer kindly.",
                        effect: { mercy: 2, wonder: 1 },
                        note: "Mercy opens the first gate more quietly than force ever could."
                    }
                ]
            },
            {
                location: "Beavers' Dam",
                theme: "Tea and rumours",
                prompt: "Over tea, you hear troubling news about the Witch, the Deep Magic, and a lion nobody mentions casually. The room feels safe enough to stay, but the road ahead clearly will not be.",
                tags: ["Marmalade rolls", "Coat drying", "Map unfolding"],
                choices: [
                    {
                        title: "Ask for the hard truth, even if it ruins your comfort",
                        text: "If there is danger, you would rather know it before dessert.",
                        effect: { truth: 2, courage: 1 },
                        note: "Truth sometimes arrives wearing wet boots and no apologies."
                    },
                    {
                        title: "Help everyone prepare supplies before talking strategy",
                        text: "A packed satchel and a fed companion can be surprisingly holy.",
                        effect: { mercy: 2, courage: 1 },
                        note: "Care becomes a form of battle-readiness."
                    },
                    {
                        title: "Lean into the impossible hope that Aslan changes everything",
                        text: "It is not naive if hope actually does have claws.",
                        effect: { wonder: 2, mercy: 1 },
                        note: "You make room for grandeur instead of shrinking the story."
                    }
                ]
            },
            {
                location: "Stone Table",
                theme: "Before dawn",
                prompt: "Night hangs heavy. Something costly is happening, and no quick fix will spare everyone the grief. You cannot solve the whole mystery, but you can decide how you stand near sorrow.",
                tags: ["Silent vigil", "Frozen grass", "Breath like smoke"],
                choices: [
                    {
                        title: "Stay present even when you cannot fix the pain",
                        text: "Faithfulness often looks less flashy than heroics, but it endures longer.",
                        effect: { mercy: 2, truth: 1 },
                        note: "You choose the courage of remaining instead of fleeing discomfort."
                    },
                    {
                        title: "Name what is unjust and refuse to pretend it is fine",
                        text: "You are allergic to cheerful lies, which honestly seems healthy.",
                        effect: { truth: 2, courage: 1 },
                        note: "Truth keeps vigil with you in the dark."
                    },
                    {
                        title: "Watch for the deeper magic you cannot yet see",
                        text: "You trust that sacrifice is not the end of the story.",
                        effect: { wonder: 2, courage: 1 },
                        note: "Wonder becomes a disciplined refusal to despair."
                    }
                ]
            },
            {
                location: "Cair Paravel",
                theme: "Thaw and trumpet",
                prompt: "Morning breaks. The ice is gone, banners are up, and now the question is not whether good will win, but what kind of ruler, sibling, and friend you become after victory.",
                tags: ["Sea breeze", "Banner snapping", "Coronation shoes"],
                choices: [
                    {
                        title: "Use strength to protect the vulnerable first",
                        text: "A crown is only interesting if it bends toward service.",
                        effect: { courage: 2, mercy: 1 },
                        note: "Victory becomes guardianship instead of swagger."
                    },
                    {
                        title: "Tell the story truly so nobody forgets what it cost",
                        text: "Memory with honesty keeps a kingdom from getting silly.",
                        effect: { truth: 2, wonder: 1 },
                        note: "You carry the tale carefully enough for future winters."
                    },
                    {
                        title: "Keep feast days, songs, and astonishment alive",
                        text: "Because a joyless kingdom is just a spreadsheet with banners.",
                        effect: { wonder: 2, mercy: 1 },
                        note: "You make celebration part of moral architecture."
                    }
                ]
            }
        ];

        const endings = {
            courage: {
                title: "The Wolf-Warder",
                heading: "You fight the good fight without becoming grim about it",
                summary: "You move toward danger when somebody smaller needs backing, and you do it with your lantern held high instead of your ego.",
                body: "Your trail leaned hard into brave action. You would probably be the one volunteering for the risky part, then pretending it was nothing. The noble version of that is steadfast service. The silly version is charging ahead without listening. Try to keep the first one.",
                stamp: "Courage"
            },
            truth: {
                title: "The Clear-Eyed Chronicler",
                heading: "You keep the story honest, even when honesty is chilly",
                summary: "You prefer the difficult truth to the cozy illusion, which makes you excellent company in a crisis and mildly inconvenient in group denial.",
                body: "You kept choosing clarity, named the real stakes, and refused to sand off the uncomfortable bits. That makes you the sort of traveller who remembers what happened and why it mattered. Narnia needs that. So does every family, team, and parish, frankly.",
                stamp: "Truth"
            },
            mercy: {
                title: "The Hearth-Keeper",
                heading: "You protect others by making room for warmth",
                summary: "Your instinct is to shelter, feed, forgive, and keep the frightened from feeling alone while the snow is still coming sideways.",
                body: "You consistently moved toward care. That does not make you soft. It makes you the person who notices who is cold, ashamed, or left out while everybody else is talking battle plans. Mercy like that changes outcomes more than the loud people ever admit.",
                stamp: "Mercy"
            },
            wonder: {
                title: "The Lantern-Bearer",
                heading: "You carry awe like a practical survival tool",
                summary: "You keep choosing hope, song, and impossible largeness, which turns out to be far more strategic than cynics expect.",
                body: "You let wonder lead without letting it become fluff. That means you are unusually hard to flatten. You remember that joy, symbolism, feast, beauty, and holy surprise are not decorative extras. They are part of how winter breaks.",
                stamp: "Wonder"
            }
        };

        const stats = ["courage", "truth", "mercy", "wonder"];
        const labels = {
            courage: "Courage",
            truth: "Truth",
            mercy: "Mercy",
            wonder: "Wonder"
        };

        let currentStep = 0;
        let tallies = {};
        let choiceNotes = [];

        const choiceContainer = document.getElementById("choices");
        const journeyLocation = document.getElementById("journey-location");
        const journeyPrompt = document.getElementById("journey-prompt");
        const stepCounter = document.getElementById("step-counter");
        const stepTheme = document.getElementById("step-theme");
        const progressFill = document.getElementById("progress-fill");
        const progressTags = document.getElementById("progress-tags");
        const trailPath = document.getElementById("trail-path");
        const mapStatus = document.getElementById("map-status");
        const endingCard = document.getElementById("ending-card");
        const statusKicker = document.getElementById("status-kicker");

        function freshSteps() {
            return steps.map((step) => ({
                ...step,
                choices: step.choices.slice().sort(() => Math.random() - 0.5)
            }));
        }

        let activeSteps = freshSteps();

        function resetTallies() {
            tallies = { courage: 1, truth: 1, mercy: 1, wonder: 1 };
            choiceNotes = [];
            currentStep = 0;
        }

        function updateMeters() {
            const total = Object.values(tallies).reduce((sum, value) => sum + value, 0);
            stats.forEach((stat) => {
                const value = tallies[stat];
                document.getElementById(stat + "-value").textContent = value;
                document.getElementById(stat + "-meter").style.width = `${(value / total) * 100}%`;
            });

            const dominant = stats.slice().sort((a, b) => tallies[b] - tallies[a])[0];
            const copy = {
                courage: "You are travelling like someone who would absolutely pick the dangerous door if it helped a friend.",
                truth: "You keep brushing frost off the facts instead of pretending the fog is enough.",
                mercy: "You are becoming the warm room in the middle of the blizzard.",
                wonder: "You keep noticing the magic without drifting into nonsense. Nicely done."
            };
            statusKicker.textContent = copy[dominant];
        }

        function updateMap() {
            const ratio = currentStep / activeSteps.length;
            trailPath.style.strokeDashoffset = `${1400 - (1400 * ratio)}`;
            document.querySelectorAll(".node").forEach((node) => {
                const nodeIndex = Number(node.dataset.node);
                node.classList.toggle("active", nodeIndex === currentStep);
                node.classList.toggle("complete", nodeIndex < currentStep);
            });

            const mapLabels = ["Wardrobe", "Lamp-Post Wood", "Beavers' Dam", "Stone Table", "Cair Paravel"];
            mapStatus.textContent = currentStep >= activeSteps.length ? "At Cair Paravel" : `At ${mapLabels[currentStep]}`;
        }

        function renderProgressTags(tags) {
            progressTags.innerHTML = "";
            tags.forEach((tag) => {
                const pill = document.createElement("span");
                pill.textContent = tag;
                progressTags.appendChild(pill);
            });
        }

        function renderStep() {
            if (currentStep >= activeSteps.length) {
                renderEnding();
                return;
            }

            const step = activeSteps[currentStep];
            stepCounter.textContent = `Stop ${currentStep + 1} of ${activeSteps.length}`;
            stepTheme.textContent = step.theme;
            journeyLocation.textContent = step.location;
            journeyPrompt.textContent = step.prompt;
            progressFill.style.width = `${(currentStep / activeSteps.length) * 100}%`;
            renderProgressTags(step.tags);

            choiceContainer.innerHTML = "";
            step.choices.forEach((choice) => {
                const button = document.createElement("button");
                button.type = "button";
                button.className = "button choice";
                button.innerHTML = `<strong>${choice.title}</strong><span>${choice.text}</span>`;
                button.addEventListener("click", () => selectChoice(choice));
                choiceContainer.appendChild(button);
            });

            updateMap();
            updateMeters();
            endingCard.classList.remove("visible");
        }

        function selectChoice(choice) {
            stats.forEach((stat) => {
                tallies[stat] += choice.effect[stat] || 0;
            });
            choiceNotes.push(choice.note);
            currentStep += 1;
            renderStep();
        }

        function renderEnding() {
            progressFill.style.width = "100%";
            renderProgressTags(["Lantern blazing", "Snow defeated", "Feast approved"]);
            updateMap();
            updateMeters();

            const ordered = stats.slice().sort((a, b) => tallies[b] - tallies[a]);
            const lead = ordered[0];
            const runnerUp = ordered[1];
            const ending = endings[lead];

            document.getElementById("ending-title").textContent = ending.title;
            document.getElementById("ending-heading").textContent = ending.heading;
            document.getElementById("ending-summary").textContent = ending.summary;
            document.getElementById("ending-body").textContent =
                `${ending.body} Your runner-up trait was ${labels[runnerUp].toLowerCase()}, so the whole vibe is ${labels[lead].toLowerCase()} with a useful streak of ${labels[runnerUp].toLowerCase()}.`;
            document.getElementById("ending-stamp").textContent = ending.stamp;

            const endingList = document.getElementById("ending-list");
            endingList.innerHTML = "";

            const items = [
                `Dominant virtue: ${labels[lead]} (${tallies[lead]})`,
                `Runner-up virtue: ${labels[runnerUp]} (${tallies[runnerUp]})`,
                choiceNotes[Math.max(0, choiceNotes.length - 1)]
            ];

            items.forEach((item) => {
                const block = document.createElement("div");
                block.className = "ending-item";
                block.textContent = item;
                endingList.appendChild(block);
            });

            endingCard.classList.add("visible");
            endingCard.scrollIntoView({ behavior: "smooth", block: "start" });
        }

        function restartJourney() {
            activeSteps = freshSteps();
            resetTallies();
            renderStep();
        }

        document.getElementById("restart-top").addEventListener("click", restartJourney);
        document.getElementById("restart-bottom").addEventListener("click", restartJourney);

        resetTallies();
        renderStep();
    </script>
</body>
</html>
