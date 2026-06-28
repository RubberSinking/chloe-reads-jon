<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep Orbit Arcade</title>
    <style>
        :root {
            --ink: #f8f4dc;
            --muted: #c9c0a2;
            --panel: rgba(9, 17, 40, 0.76);
            --panel-strong: rgba(7, 13, 31, 0.9);
            --line: rgba(237, 219, 167, 0.16);
            --glow: #f7d672;
            --teal: #89f3e8;
            --sky-top: #081226;
            --sky-mid: #10264d;
            --sky-bottom: #250f34;
            --rose: #ff9bb4;
            --good: #89f0b5;
            --warn: #ffd66d;
            --bad: #ff8a83;
            --shadow: 0 26px 60px rgba(1, 6, 18, 0.45);
        }

        * { box-sizing: border-box; }

        html {
            color-scheme: dark;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Avenir Next", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 20%, rgba(112, 175, 255, 0.2), transparent 28%),
                radial-gradient(circle at 80% 0%, rgba(255, 206, 114, 0.12), transparent 26%),
                radial-gradient(circle at 50% 120%, rgba(255, 123, 146, 0.18), transparent 34%),
                linear-gradient(180deg, var(--sky-top), var(--sky-mid) 48%, var(--sky-bottom));
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
            background-image:
                radial-gradient(circle at 12% 18%, rgba(255, 255, 255, 0.85) 0 1px, transparent 1.4px),
                radial-gradient(circle at 78% 12%, rgba(255, 234, 184, 0.9) 0 1.2px, transparent 1.6px),
                radial-gradient(circle at 62% 38%, rgba(255, 255, 255, 0.65) 0 1px, transparent 1.5px),
                radial-gradient(circle at 26% 56%, rgba(137, 243, 232, 0.8) 0 1px, transparent 1.5px),
                radial-gradient(circle at 90% 44%, rgba(255, 155, 180, 0.8) 0 1px, transparent 1.4px),
                radial-gradient(circle at 40% 78%, rgba(255, 255, 255, 0.6) 0 1px, transparent 1.6px);
            opacity: 0.75;
        }

        body::after {
            background:
                linear-gradient(rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.01)),
                repeating-linear-gradient(0deg, rgba(255, 255, 255, 0.012) 0 2px, transparent 2px 4px);
            mix-blend-mode: soft-light;
            opacity: 0.35;
        }

        a {
            color: var(--glow);
        }

        .wrap {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 44px;
        }

        .hero {
            position: relative;
            display: grid;
            gap: 28px;
            grid-template-columns: 1.15fr 0.85fr;
            padding: 30px;
            border: 1px solid var(--line);
            border-radius: 30px;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.01)),
                var(--panel);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto -12% -38% auto;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(247, 214, 114, 0.2), transparent 66%);
            filter: blur(8px);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255, 240, 192, 0.18);
            background: rgba(255, 255, 255, 0.04);
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 0.72rem;
        }

        .eyebrow::before {
            content: "";
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff3bf 0 35%, var(--glow) 36% 100%);
            box-shadow: 0 0 18px rgba(247, 214, 114, 0.8);
        }

        h1, h2, h3 {
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            margin: 0;
            letter-spacing: -0.02em;
        }

        h1 {
            margin-top: 18px;
            font-size: clamp(2.6rem, 7vw, 5.2rem);
            line-height: 0.95;
            max-width: 10ch;
        }

        .lede {
            max-width: 58ch;
            margin: 20px 0 24px;
            font-size: 1.04rem;
            line-height: 1.7;
            color: #e7dfc6;
        }

        .quote {
            padding: 18px 20px;
            border-left: 3px solid var(--glow);
            border-radius: 0 18px 18px 0;
            background: rgba(255, 255, 255, 0.04);
            color: #f4edd0;
            line-height: 1.7;
        }

        .quote strong {
            color: #fff6c5;
        }

        .hero-links {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .hero-links a,
        .ghost-button,
        button {
            appearance: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease, border-color 180ms ease;
        }

        .hero-links a,
        button {
            padding: 12px 18px;
            border-radius: 999px;
            color: #081226;
            background: linear-gradient(135deg, #ffe9a4, #f7d672);
            font-weight: 700;
            box-shadow: 0 14px 28px rgba(247, 214, 114, 0.22);
        }

        .hero-links a:hover,
        .ghost-button:hover,
        button:hover {
            transform: translateY(-1px);
        }

        .ghost-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            border-radius: 999px;
            color: var(--ink);
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.12);
            font-weight: 600;
        }

        .dial-shell {
            position: relative;
            display: grid;
            place-items: center;
            min-height: 100%;
            padding: 8px 0;
        }

        .dial {
            position: relative;
            width: min(100%, 380px);
            aspect-ratio: 1;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background:
                radial-gradient(circle at center, rgba(8, 18, 38, 0.98) 0 46%, transparent 46%),
                conic-gradient(from -90deg, rgba(255,255,255,0.08) 0deg, rgba(255,255,255,0.02) 360deg);
            box-shadow:
                inset 0 0 0 18px rgba(255, 255, 255, 0.025),
                inset 0 0 80px rgba(137, 243, 232, 0.06),
                0 40px 80px rgba(4, 8, 20, 0.48);
        }

        .dial::before {
            content: "";
            position: absolute;
            inset: 16px;
            border-radius: 50%;
            border: 1px dashed rgba(255, 255, 255, 0.12);
        }

        .dial::after {
            content: "";
            position: absolute;
            inset: 50%;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, #fff8d2 0 34%, var(--glow) 35% 100%);
            box-shadow: 0 0 24px rgba(247, 214, 114, 0.85);
        }

        .orbit {
            position: absolute;
            inset: 22px;
            border-radius: 50%;
            background: conic-gradient(from -90deg, rgba(255, 255, 255, 0.02) 0deg, rgba(255, 255, 255, 0.08) 360deg);
            mask: radial-gradient(circle, transparent 0 59%, #000 59% 72%, transparent 72%);
            -webkit-mask: radial-gradient(circle, transparent 0 59%, #000 59% 72%, transparent 72%);
        }

        .dial-labels {
            position: absolute;
            inset: 0;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(255, 247, 219, 0.6);
        }

        .dial-labels span {
            position: absolute;
            left: 50%;
            top: 50%;
            transform-origin: center;
            width: 0;
            height: 0;
        }

        .dial-labels b {
            display: inline-block;
            transform: translate(-50%, -168px);
            font-weight: 600;
        }

        .center-readout {
            position: absolute;
            inset: 50%;
            width: 58%;
            height: 58%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            display: grid;
            place-items: center;
            text-align: center;
            padding: 20px;
            background: radial-gradient(circle, rgba(16, 38, 77, 0.96), rgba(7, 13, 31, 0.98));
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .center-readout strong {
            display: block;
            font-size: clamp(2.1rem, 5vw, 3rem);
            color: #fff6cf;
        }

        .center-readout span {
            font-size: 0.82rem;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .center-readout small {
            display: block;
            margin-top: 8px;
            color: #d7f5f1;
            font-size: 0.92rem;
        }

        .satellite {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, #fff7c7 0 45%, var(--glow) 46% 100%);
            box-shadow: 0 0 22px rgba(247, 214, 114, 0.7);
        }

        .satellite::after {
            content: "";
            position: absolute;
            inset: -6px;
            border-radius: 50%;
            border: 1px solid rgba(247, 214, 114, 0.24);
        }

        .dial-legend {
            display: grid;
            gap: 10px;
            margin-top: 18px;
            font-size: 0.92rem;
            color: #d9d2bb;
        }

        .dial-legend span {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .swatch {
            width: 14px;
            height: 14px;
            border-radius: 999px;
        }

        .swatch.sleep { background: var(--teal); }
        .swatch.wind { background: var(--glow); }
        .swatch.drag { background: var(--rose); }

        .grid {
            display: grid;
            gap: 22px;
            margin-top: 24px;
            grid-template-columns: 1.05fr 0.95fr;
        }

        .panel {
            padding: 24px;
            border-radius: 26px;
            border: 1px solid var(--line);
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.035), rgba(255, 255, 255, 0.012)),
                var(--panel-strong);
            box-shadow: var(--shadow);
        }

        .panel h2 {
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .panel p {
            color: #d7cfb5;
            line-height: 1.65;
            margin: 0 0 18px;
        }

        .sliders {
            display: grid;
            gap: 18px;
        }

        .slider-card {
            padding: 16px 18px 18px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .slider-top {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: baseline;
            margin-bottom: 10px;
        }

        .slider-top strong {
            font-size: 1.02rem;
        }

        .slider-top span {
            color: var(--teal);
            font-weight: 700;
        }

        input[type="range"] {
            width: 100%;
            appearance: none;
            height: 10px;
            border-radius: 999px;
            outline: none;
            background: linear-gradient(90deg, rgba(255,255,255,0.14), rgba(255,255,255,0.04));
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff5bf 0 42%, var(--glow) 43% 100%);
            border: 2px solid #10264d;
            box-shadow: 0 0 0 4px rgba(247, 214, 114, 0.18);
        }

        input[type="range"]::-moz-range-thumb {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff5bf 0 42%, var(--glow) 43% 100%);
            border: 2px solid #10264d;
            box-shadow: 0 0 0 4px rgba(247, 214, 114, 0.18);
        }

        .preset-row,
        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preset-row button,
        .chips button {
            color: var(--ink);
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: none;
            padding: 10px 14px;
        }

        .preset-row button.active,
        .chips button.active {
            color: #081226;
            background: linear-gradient(135deg, #fff0b1, #f8d874);
            border-color: transparent;
        }

        .chips button {
            font-weight: 600;
        }

        .chips button span {
            opacity: 0.75;
            margin-left: 6px;
            font-size: 0.82rem;
        }

        .mini-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 16px;
        }

        .select-card {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        select {
            width: 100%;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 12px 14px;
            background: rgba(3, 9, 25, 0.88);
            color: var(--ink);
            font: inherit;
        }

        .score-band {
            display: grid;
            gap: 14px;
        }

        .score-total {
            display: grid;
            gap: 6px;
            padding: 18px 20px;
            border-radius: 22px;
            background:
                radial-gradient(circle at top right, rgba(137, 243, 232, 0.18), transparent 36%),
                rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .score-total small {
            text-transform: uppercase;
            letter-spacing: 0.16em;
            color: var(--muted);
        }

        .score-total strong {
            font-size: clamp(2.4rem, 6vw, 3.4rem);
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
        }

        .score-message {
            color: #ebf0cf;
            line-height: 1.6;
        }

        .meter {
            display: grid;
            gap: 8px;
            margin-top: 6px;
        }

        .meter-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.95rem;
        }

        .bar {
            height: 12px;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.08);
        }

        .bar > i {
            display: block;
            height: 100%;
            width: 0;
            border-radius: inherit;
            transition: width 240ms ease;
        }

        .bar.learn > i { background: linear-gradient(90deg, #84f7ee, #4ac4ff); }
        .bar.decide > i { background: linear-gradient(90deg, #fff2a7, #ffc664); }
        .bar.mood > i { background: linear-gradient(90deg, #ffa4b2, #ff7a89); }
        .bar.shield > i { background: linear-gradient(90deg, #bcf9a0, #57d98f); }

        .mission {
            display: grid;
            gap: 18px;
        }

        .mission-stage {
            position: relative;
            padding: 20px;
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, 0.09);
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.06), transparent 30%),
                rgba(255, 255, 255, 0.03);
            min-height: 320px;
            overflow: hidden;
        }

        .starscape {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .starscape i {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: rgba(255, 249, 214, 0.85);
            box-shadow: 0 0 10px rgba(255, 244, 176, 0.55);
        }

        .rocket {
            position: absolute;
            left: 16%;
            bottom: 18%;
            width: 88px;
            height: 88px;
            transition: transform 320ms ease, filter 320ms ease;
            filter: drop-shadow(0 16px 28px rgba(0, 0, 0, 0.35));
        }

        .rocket svg {
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        .rocket trail {
            opacity: 0;
        }

        .mission-copy {
            position: relative;
            z-index: 1;
            max-width: 34ch;
        }

        .mission-copy h3 {
            font-size: 1.55rem;
            margin-bottom: 10px;
        }

        .scenario-card {
            display: grid;
            gap: 12px;
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .scenario-badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            color: var(--muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .summary {
            display: grid;
            gap: 14px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .summary-card {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .summary-card span {
            display: block;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.72rem;
            margin-bottom: 10px;
        }

        .summary-card strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .morning-log {
            display: grid;
            gap: 12px;
        }

        .log-line {
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            line-height: 1.55;
        }

        .footer-note {
            margin-top: 22px;
            color: #d9d0b6;
            font-size: 0.94rem;
        }

        .footer-note a {
            color: #fff1a9;
        }

        @media (max-width: 900px) {
            .hero,
            .grid {
                grid-template-columns: 1fr;
            }

            .dial-shell {
                order: -1;
            }
        }

        @media (max-width: 640px) {
            .wrap {
                width: min(100% - 20px, 1120px);
                padding-top: 14px;
            }

            .hero,
            .panel {
                padding: 20px;
                border-radius: 22px;
            }

            h1 {
                max-width: 9ch;
                font-size: clamp(2.4rem, 12vw, 4rem);
            }

            .mini-grid,
            .summary {
                grid-template-columns: 1fr;
            }

            .center-readout {
                width: 64%;
                height: 64%;
            }

            .dial-labels b {
                transform: translate(-50%, -142px);
                font-size: 0.62rem;
            }

            .hero-links a,
            .ghost-button,
            button {
                width: 100%;
                justify-content: center;
            }

            .hero-links {
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div>
                <div class="eyebrow">Observatory for Sleep, Learning, and Good Decisions</div>
                <h1>Sleep Orbit Arcade</h1>
                <p class="lede">Jon once saved a line that says cutting sleep means <em>we learn less, make worse decisions, and undermine our true intellectual potential</em>. So here is the dramatic version: a little midnight flight school where your bedtime fuels tomorrow's memory, mood, and mistake shield.</p>
                <div class="quote">
                    <strong>Mission premise:</strong> a good night is not just rest. It is how tomorrow gets assembled.
                </div>
                <div class="hero-links">
                    <a href="#console">Plot tonight's orbit</a>
                    <button type="button" id="simulateButton">Run morning simulation</button>
                </div>
            </div>
            <div class="dial-shell">
                <div class="dial" id="dial">
                    <div class="orbit" id="orbit"></div>
                    <div class="dial-labels" id="dialLabels"></div>
                    <div class="satellite" id="bedMarker" aria-hidden="true"></div>
                    <div class="satellite" id="wakeMarker" aria-hidden="true"></div>
                    <div class="center-readout">
                        <div>
                            <span>Sleep Window</span>
                            <strong id="durationLabel">8h 30m</strong>
                            <small id="windowLabel">10:30 PM to 7:00 AM</small>
                        </div>
                    </div>
                </div>
                <div class="dial-legend">
                    <span><i class="swatch sleep"></i> Teal ring: time asleep</span>
                    <span><i class="swatch wind"></i> Gold ring: wind-down bonus</span>
                    <span><i class="swatch drag"></i> Rose haze: tomorrow's drag</span>
                </div>
            </div>
        </section>

        <section class="grid" id="console">
            <div class="panel">
                <h2>Night Console</h2>
                <p>Set a bedtime, wake time, and a few routine details. The observatory recalculates your learning orbit instantly.</p>

                <div class="preset-row" id="presetRow">
                    <button type="button" data-preset="school">School Night</button>
                    <button type="button" data-preset="steady">Steady Builder</button>
                    <button type="button" data-preset="reset">Deep Reset</button>
                    <button type="button" data-preset="chaos">Too Much Heroism</button>
                </div>

                <div class="sliders">
                    <div class="slider-card">
                        <div class="slider-top">
                            <strong>Bedtime</strong>
                            <span id="bedtimeLabel">10:30 PM</span>
                        </div>
                        <input id="bedtime" type="range" min="18" max="29" step="0.5" value="22.5">
                    </div>

                    <div class="slider-card">
                        <div class="slider-top">
                            <strong>Wake Time</strong>
                            <span id="wakeLabel">7:00 AM</span>
                        </div>
                        <input id="wakeTime" type="range" min="24" max="36" step="0.5" value="31">
                    </div>
                </div>

                <div class="mini-grid">
                    <div class="select-card">
                        <label for="dayLoad">Tomorrow's load</label>
                        <select id="dayLoad">
                            <option value="0">Gentle day</option>
                            <option value="8" selected>Ordinary demands</option>
                            <option value="16">School or work sprint</option>
                            <option value="24">High-stakes mission</option>
                        </select>
                    </div>
                    <div class="select-card">
                        <label for="caffeineCutoff">Last caffeine</label>
                        <select id="caffeineCutoff">
                            <option value="12">Before noon</option>
                            <option value="6" selected>Mid-afternoon</option>
                            <option value="0">Dinner-adjacent recklessness</option>
                        </select>
                    </div>
                </div>

                <div class="select-card" style="margin-top: 16px;">
                    <label>Wind-down boosters</label>
                    <div class="chips" id="habitChips">
                        <button type="button" data-points="10" class="active">Screens off <span>+10</span></button>
                        <button type="button" data-points="7" class="active">Quiet reading <span>+7</span></button>
                        <button type="button" data-points="6">Stretching <span>+6</span></button>
                        <button type="button" data-points="5">Prayer or examen <span>+5</span></button>
                        <button type="button" data-points="4">Cool room <span>+4</span></button>
                        <button type="button" data-points="-10">Doomscrolling <span>-10</span></button>
                    </div>
                </div>
            </div>

            <div class="panel">
                <h2>Flight Readout</h2>
                <div class="score-band">
                    <div class="score-total">
                        <small>Tonight's Sleep Orbit Score</small>
                        <strong id="scoreTotal">82</strong>
                        <div class="score-message" id="scoreMessage">Comfortably on course. Tomorrow gets a steady brain, fewer silly mistakes, and enough emotional margin to be decent before breakfast.</div>
                    </div>

                    <div class="meter">
                        <div class="meter-head"><span>Learning lock-in</span><b id="learnValue">84%</b></div>
                        <div class="bar learn"><i id="learnBar"></i></div>
                    </div>
                    <div class="meter">
                        <div class="meter-head"><span>Decision clarity</span><b id="decideValue">79%</b></div>
                        <div class="bar decide"><i id="decideBar"></i></div>
                    </div>
                    <div class="meter">
                        <div class="meter-head"><span>Mood reserve</span><b id="moodValue">76%</b></div>
                        <div class="bar mood"><i id="moodBar"></i></div>
                    </div>
                    <div class="meter">
                        <div class="meter-head"><span>Mistake shield</span><b id="shieldValue">81%</b></div>
                        <div class="bar shield"><i id="shieldBar"></i></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid" style="margin-top: 22px;">
            <div class="panel mission">
                <div class="mission-stage">
                    <div class="starscape" id="starscape"></div>
                    <div class="rocket" id="rocket" aria-hidden="true">
                        <svg viewBox="0 0 120 120" role="img">
                            <g transform="translate(60 60) rotate(-18) translate(-60 -60)">
                                <ellipse cx="34" cy="74" rx="16" ry="10" fill="rgba(255, 166, 117, 0.42)"/>
                                <ellipse cx="28" cy="76" rx="12" ry="7" fill="rgba(255, 221, 136, 0.4)"/>
                                <path d="M24 22c18 2 35 15 46 35 9 16 11 31 5 41-8 12-28 14-49 4-13-6-20-17-18-31 3-19 11-35 16-43z" fill="#f1e8c1"/>
                                <path d="M30 26c13 5 26 16 34 30 10 17 10 31 5 40-10 2-22 0-34-6-19-9-28-23-24-43 3-8 8-16 19-21z" fill="#5ac7ff"/>
                                <circle cx="64" cy="52" r="10" fill="#0f2248"/>
                                <circle cx="64" cy="52" r="5" fill="#9ce9ff"/>
                                <path d="M18 78l-16 14 22-4z" fill="#f7d672"/>
                                <path d="M45 94l-6 24 16-16z" fill="#ff9bb4"/>
                                <path d="M16 64C8 67 2 73 0 84c10-2 17-6 22-12z" fill="#89f3e8"/>
                            </g>
                        </svg>
                    </div>
                    <div class="mission-copy">
                        <h3 id="missionTitle">Memory cargo is stable.</h3>
                        <p id="missionCopy">Your orbit has enough fuel to lock in what you learned today instead of dropping it somewhere between bedtime and breakfast.</p>
                    </div>
                </div>

                <div class="summary">
                    <div class="summary-card">
                        <span>Bedtime gravity</span>
                        <strong id="bedSummary">Early enough</strong>
                        <div id="bedSummaryText">You are not trying to negotiate with midnight like it owes you money.</div>
                    </div>
                    <div class="summary-card">
                        <span>Wind-down ritual</span>
                        <strong id="habitSummary">Helpful</strong>
                        <div id="habitSummaryText">Your routine is giving tomorrow a running start.</div>
                    </div>
                    <div class="summary-card">
                        <span>Recovery margin</span>
                        <strong id="recoverySummary">Solid buffer</strong>
                        <div id="recoverySummaryText">There is enough slack for ordinary surprises.</div>
                    </div>
                </div>
            </div>

            <div class="panel">
                <h2>Morning Simulation</h2>
                <p>Press the button and the observatory predicts how tomorrow feels in practice, not just in percentages.</p>

                <div class="scenario-card">
                    <div class="scenario-badges" id="scenarioBadges"></div>
                    <div class="morning-log" id="morningLog"></div>
                    <button type="button" id="rerunButton">Spin a fresh morning</button>
                </div>

                <p class="footer-note">Inspired by Jon's <a href="https://jona.ca/2004/11/good-sleep-good-learning-good-life.html">Good sleep, good learning, good life</a>.</p>
            </div>
        </section>
    </div>

    <script>
        const bedtimeInput = document.getElementById("bedtime");
        const wakeInput = document.getElementById("wakeTime");
        const dayLoadSelect = document.getElementById("dayLoad");
        const caffeineSelect = document.getElementById("caffeineCutoff");
        const habitButtons = Array.from(document.querySelectorAll("#habitChips button"));
        const presetButtons = Array.from(document.querySelectorAll("#presetRow button"));
        const dialLabels = document.getElementById("dialLabels");
        const orbit = document.getElementById("orbit");
        const bedMarker = document.getElementById("bedMarker");
        const wakeMarker = document.getElementById("wakeMarker");
        const starscape = document.getElementById("starscape");
        const rocket = document.getElementById("rocket");

        const bedtimeLabel = document.getElementById("bedtimeLabel");
        const wakeLabel = document.getElementById("wakeLabel");
        const durationLabel = document.getElementById("durationLabel");
        const windowLabel = document.getElementById("windowLabel");
        const scoreTotal = document.getElementById("scoreTotal");
        const scoreMessage = document.getElementById("scoreMessage");
        const learnValue = document.getElementById("learnValue");
        const decideValue = document.getElementById("decideValue");
        const moodValue = document.getElementById("moodValue");
        const shieldValue = document.getElementById("shieldValue");
        const learnBar = document.getElementById("learnBar");
        const decideBar = document.getElementById("decideBar");
        const moodBar = document.getElementById("moodBar");
        const shieldBar = document.getElementById("shieldBar");
        const missionTitle = document.getElementById("missionTitle");
        const missionCopy = document.getElementById("missionCopy");
        const bedSummary = document.getElementById("bedSummary");
        const bedSummaryText = document.getElementById("bedSummaryText");
        const habitSummary = document.getElementById("habitSummary");
        const habitSummaryText = document.getElementById("habitSummaryText");
        const recoverySummary = document.getElementById("recoverySummary");
        const recoverySummaryText = document.getElementById("recoverySummaryText");
        const morningLog = document.getElementById("morningLog");
        const scenarioBadges = document.getElementById("scenarioBadges");
        const simulateButton = document.getElementById("simulateButton");
        const rerunButton = document.getElementById("rerunButton");

        const presets = {
            school: { bed: 21.5, wake: 30, load: "16", caffeine: "12", habits: [0, 1, 3, 4] },
            steady: { bed: 22.5, wake: 31, load: "8", caffeine: "6", habits: [0, 1] },
            reset: { bed: 21, wake: 31.5, load: "0", caffeine: "12", habits: [0, 1, 2, 3, 4] },
            chaos: { bed: 24.5, wake: 30.5, load: "24", caffeine: "0", habits: [5] }
        };

        const messageBands = [
            {
                min: 88,
                total: "Stellar and annoyingly virtuous.",
                missionTitle: "Memory cargo is gleaming.",
                missionCopy: "This is the kind of night that helps tomorrow feel almost unfair. Learning sticks. Patience survives. Even the small decisions stop ambushing you.",
                bed: ["Clockwork grace", "You are using the evening like a grown-up wizard, not a raccoon with Wi-Fi."],
                habits: ["Excellent ritual", "Your wind-down is doing real work instead of decorative work."],
                recovery: ["Deep reserve", "There is room for surprises, sibling negotiations, and one mildly absurd email."]
            },
            {
                min: 72,
                total: "Comfortably on course.",
                missionTitle: "Memory cargo is stable.",
                missionCopy: "Your orbit has enough fuel to lock in what you learned today instead of dropping it somewhere between bedtime and breakfast.",
                bed: ["Early enough", "You are not trying to negotiate with midnight like it owes you money."],
                habits: ["Helpful", "Your routine is giving tomorrow a running start."],
                recovery: ["Solid buffer", "There is enough slack for ordinary surprises."]
            },
            {
                min: 54,
                total: "Flyable, but with wobble.",
                missionTitle: "Some satellites may drift.",
                missionCopy: "Tomorrow is still workable, but the margin is thinner. Recall and mood may become a little dramatic by late afternoon.",
                bed: ["Cutting it close", "The clock is not furious, but it is definitely raising an eyebrow."],
                habits: ["Patchy", "A little more ritual would keep the whole ship from rattling."],
                recovery: ["Watch the edges", "Protect the afternoon if you can. That is when the gremlins file their paperwork."]
            },
            {
                min: 0,
                total: "Heroic nonsense detected.",
                missionTitle: "The launch was brave. The mission, questionable.",
                missionCopy: "Tomorrow can still happen, obviously, but the observatory recommends mercy, simpler tasks, and no pretending this is peak form.",
                bed: ["Midnight mutiny", "You have asked a sunrise body to run on moonbeam fumes."],
                habits: ["Needs rescue", "The routine has wandered off and taken your judgment with it."],
                recovery: ["Paper-thin buffer", "Tiny annoyances may feel like Shakespearean betrayals."]
            }
        ];

        function formatHour(value) {
            const normalized = ((value % 24) + 24) % 24;
            const hour = Math.floor(normalized);
            const minutes = Math.round((normalized - hour) * 60);
            const safeHour = hour % 12 || 12;
            const suffix = hour >= 12 ? "PM" : "AM";
            return `${safeHour}:${String(minutes).padStart(2, "0")} ${suffix}`;
        }

        function buildDialLabels() {
            const labels = [
                { text: "6 PM", hour: 18 },
                { text: "9 PM", hour: 21 },
                { text: "12 AM", hour: 24 },
                { text: "3 AM", hour: 27 },
                { text: "6 AM", hour: 30 },
                { text: "9 AM", hour: 33 }
            ];
            dialLabels.innerHTML = "";
            labels.forEach((label) => {
                const span = document.createElement("span");
                const angle = ((label.hour - 18) / 18) * 360;
                span.style.transform = `translate(-50%, -50%) rotate(${angle}deg)`;
                const inner = document.createElement("b");
                inner.textContent = label.text;
                inner.style.transform += ` rotate(${-angle}deg)`;
                span.appendChild(inner);
                dialLabels.appendChild(span);
            });
        }

        function createStars() {
            const stars = [];
            for (let i = 0; i < 22; i += 1) {
                const star = document.createElement("i");
                star.style.left = `${8 + Math.random() * 84}%`;
                star.style.top = `${6 + Math.random() * 72}%`;
                star.style.opacity = `${0.35 + Math.random() * 0.65}`;
                star.style.transform = `scale(${0.8 + Math.random() * 1.9})`;
                star.style.animation = `pulse ${3 + Math.random() * 4}s ease-in-out ${Math.random() * 3}s infinite`;
                starscape.appendChild(star);
                stars.push(star);
            }
            const style = document.createElement("style");
            style.textContent = "@keyframes pulse{0%,100%{opacity:.38}50%{opacity:1}}";
            document.head.appendChild(style);
            return stars;
        }

        function setMarker(marker, hour, radius) {
            const angle = ((hour - 18) / 18) * 360 - 90;
            const rad = angle * Math.PI / 180;
            const x = Math.cos(rad) * radius;
            const y = Math.sin(rad) * radius;
            marker.style.transform = `translate(calc(-50% + ${x}px), calc(-50% + ${y}px))`;
        }

        function activeHabitPoints() {
            return habitButtons.reduce((sum, button) => sum + (button.classList.contains("active") ? Number(button.dataset.points) : 0), 0);
        }

        function clampWake() {
            let bed = Number(bedtimeInput.value);
            let wake = Number(wakeInput.value);
            if (wake < bed + 4) {
                wake = bed + 4;
            }
            if (wake > 36) {
                wake = 36;
            }
            if (bed > wake - 4) {
                bed = Math.max(18, wake - 4);
            }
            bedtimeInput.value = bed;
            wakeInput.value = wake;
        }

        function computeStats() {
            clampWake();
            const bed = Number(bedtimeInput.value);
            const wake = Number(wakeInput.value);
            const duration = wake - bed;
            const habits = activeHabitPoints();
            const load = Number(dayLoadSelect.value);
            const caffeine = Number(caffeineSelect.value);

            const durationScore = Math.max(0, 100 - Math.abs(duration - 8.5) * 15);
            const bedtimePenalty = Math.max(0, (bed - 23) * 8);
            const shortPenalty = Math.max(0, (7 - duration) * 22);
            const oversleepPenalty = Math.max(0, (duration - 9.75) * 10);
            const total = Math.max(12, Math.min(99, Math.round(durationScore - bedtimePenalty - shortPenalty - oversleepPenalty - load + caffeine + habits)));

            const learn = Math.max(8, Math.min(99, Math.round(total + duration * 2 - 10)));
            const decide = Math.max(8, Math.min(99, Math.round(total - 2 + (habits * 0.4) - (load * 0.25))));
            const mood = Math.max(8, Math.min(99, Math.round(total - 6 + (duration - 7.5) * 7)));
            const shield = Math.max(8, Math.min(99, Math.round((learn + decide + mood) / 3 + 4)));

            return { bed, wake, duration, habits, load, caffeine, total, learn, decide, mood, shield };
        }

        function scenarioTags(stats) {
            const tags = [];
            tags.push(stats.duration >= 8 ? "Adequate sleep fuel" : "Short-sleep warning");
            tags.push(stats.habits > 8 ? "Ritual engaged" : "Ritual flimsy");
            tags.push(stats.load >= 16 ? "Heavy day ahead" : "Manageable day");
            if (stats.bed >= 24) {
                tags.push("Midnight diplomacy");
            } else if (stats.bed <= 22) {
                tags.push("Early launch");
            }
            return tags;
        }

        function scenarioLines(stats) {
            const sharp = stats.total >= 80;
            const okay = stats.total >= 58;
            const memory = sharp
                ? [
                    "You remember the thing you meant to remember before coffee, which is always a suspiciously luxurious feeling.",
                    "Yesterday's reading survives the night intact. A paragraph actually sticks around and introduces itself in the morning."
                ]
                : okay
                    ? [
                        "You can still recall what mattered, but the details have put on soft-focus lighting.",
                        "The main idea survives. The second supporting point wandered off to go live in the hedges."
                    ]
                    : [
                        "You stare at a familiar task and briefly wonder whether language has always looked this decorative.",
                        "The facts are in there somewhere, but they are hiding behind a velvet curtain and refusing interviews."
                    ];
            const mood = sharp
                ? [
                    "Minor inconveniences remain minor. A child asking a ninth question feels like life, not sabotage.",
                    "Your patience meter has enough charge that breakfast can include opinions."
                ]
                : okay
                    ? [
                        "You are decent, but lunch may require a little mercy and perhaps a strategic walk.",
                        "You are mostly kind unless the printer, browser, or cereal box attempts philosophy."
                    ]
                    : [
                        "Tiny setbacks arrive wearing opera costumes. Everything feels slightly louder than necessary.",
                        "The emotional suspension on today's vehicle is, let us say, vintage."
                    ];
            const mistakes = sharp
                ? [
                    "Fewer fumbles. The silly mistakes stay outside the gate, looking disappointed.",
                    "You catch the typo before it escapes into the wild and starts a family."
                ]
                : okay
                    ? [
                        "Competent enough, but double-check the small stuff. This is a classic off-by-one weather pattern.",
                        "The big decisions are fine. The small friction points may still try their little tricks."
                    ]
                    : [
                        "Today has strong 'walk into a room and forget why' energy.",
                        "This is not the day to brag about running on fumes. Fumes are not a personality."
                    ];

            const pick = (list, salt) => list[(Math.floor((stats.total + salt) % 10)) % list.length];
            return [pick(memory, 1), pick(mood, 3), pick(mistakes, 6)];
        }

        function updateScenario(stats) {
            scenarioBadges.innerHTML = "";
            scenarioTags(stats).forEach((tag) => {
                const badge = document.createElement("div");
                badge.className = "badge";
                badge.textContent = tag;
                scenarioBadges.appendChild(badge);
            });

            morningLog.innerHTML = "";
            scenarioLines(stats).forEach((line) => {
                const entry = document.createElement("div");
                entry.className = "log-line";
                entry.textContent = line;
                morningLog.appendChild(entry);
            });
        }

        function updateVisuals(stats) {
            bedtimeLabel.textContent = formatHour(stats.bed);
            wakeLabel.textContent = formatHour(stats.wake);
            durationLabel.textContent = `${Math.floor(stats.duration)}h ${Math.round((stats.duration % 1) * 60)}m`;
            windowLabel.textContent = `${formatHour(stats.bed)} to ${formatHour(stats.wake)}`;

            const activeBand = messageBands.find((band) => stats.total >= band.min);
            scoreTotal.textContent = stats.total;
            scoreMessage.textContent = activeBand.total;
            missionTitle.textContent = activeBand.missionTitle;
            missionCopy.textContent = activeBand.missionCopy;
            [bedSummary.textContent, bedSummaryText.textContent] = activeBand.bed;
            [habitSummary.textContent, habitSummaryText.textContent] = activeBand.habits;
            [recoverySummary.textContent, recoverySummaryText.textContent] = activeBand.recovery;

            learnValue.textContent = `${stats.learn}%`;
            decideValue.textContent = `${stats.decide}%`;
            moodValue.textContent = `${stats.mood}%`;
            shieldValue.textContent = `${stats.shield}%`;
            learnBar.style.width = `${stats.learn}%`;
            decideBar.style.width = `${stats.decide}%`;
            moodBar.style.width = `${stats.mood}%`;
            shieldBar.style.width = `${stats.shield}%`;

            const sleepStart = ((stats.bed - 18) / 18) * 360;
            const sleepEnd = ((stats.wake - 18) / 18) * 360;
            const windBonus = Math.min(28, Math.max(6, stats.habits));
            const drag = Math.max(16, 100 - stats.total);
            orbit.style.background = `conic-gradient(
                from -90deg,
                rgba(255,255,255,0.04) 0deg ${sleepStart}deg,
                rgba(137,243,232,0.95) ${sleepStart}deg ${sleepEnd}deg,
                rgba(255,255,255,0.04) ${sleepEnd}deg 360deg
            )`;
            orbit.style.boxShadow = `inset 0 0 40px rgba(137,243,232,0.12), 0 0 ${24 + windBonus}px rgba(137,243,232,0.05)`;

            const radius = window.innerWidth < 640 ? 142 : 168;
            setMarker(bedMarker, stats.bed, radius);
            setMarker(wakeMarker, stats.wake, radius);
            bedMarker.style.background = "radial-gradient(circle, #bafef0 0 45%, #4dcfcb 46% 100%)";
            bedMarker.style.boxShadow = "0 0 18px rgba(137, 243, 232, 0.7)";
            wakeMarker.style.background = "radial-gradient(circle, #fff5c6 0 45%, #f7d672 46% 100%)";
            wakeMarker.style.boxShadow = "0 0 18px rgba(247, 214, 114, 0.7)";

            const rocketX = Math.max(0, Math.min(56, stats.total - 28));
            const rocketY = Math.max(-18, Math.min(18, 84 - stats.total));
            rocket.style.transform = `translate(${rocketX}%, ${rocketY}%) rotate(${(stats.total - 70) / 7}deg)`;
            rocket.style.filter = stats.total >= 70 ? "drop-shadow(0 16px 28px rgba(0,0,0,0.35)) drop-shadow(0 0 22px rgba(137,243,232,0.18))" : "drop-shadow(0 16px 28px rgba(0,0,0,0.4))";

            starscape.style.opacity = `${0.55 + stats.total / 180}`;
            starscape.style.transform = `scale(${0.98 + stats.total / 600})`;

            document.documentElement.style.setProperty("--panel", `rgba(9, 17, 40, ${0.68 + stats.total / 500})`);
            document.documentElement.style.setProperty("--panel-strong", `rgba(7, 13, 31, ${0.85 + stats.total / 900})`);

            document.body.style.background = `
                radial-gradient(circle at 15% 20%, rgba(112, 175, 255, ${0.1 + stats.learn / 700}), transparent 28%),
                radial-gradient(circle at 80% 0%, rgba(255, 206, 114, ${0.08 + stats.shield / 1000}), transparent 26%),
                radial-gradient(circle at 50% 120%, rgba(255, 123, 146, ${0.1 + drag / 600}), transparent 34%),
                linear-gradient(180deg, var(--sky-top), var(--sky-mid) 48%, var(--sky-bottom))
            `;
        }

        function render() {
            const stats = computeStats();
            updateVisuals(stats);
            updateScenario(stats);
        }

        function toggleHabit(event) {
            event.currentTarget.classList.toggle("active");
            render();
        }

        function activatePreset(name) {
            const preset = presets[name];
            if (!preset) {
                return;
            }
            bedtimeInput.value = preset.bed;
            wakeInput.value = preset.wake;
            dayLoadSelect.value = preset.load;
            caffeineSelect.value = preset.caffeine;
            habitButtons.forEach((button, index) => {
                button.classList.toggle("active", preset.habits.includes(index));
            });
            presetButtons.forEach((button) => {
                button.classList.toggle("active", button.dataset.preset === name);
            });
            render();
        }

        function rerollMorning() {
            const stats = computeStats();
            const jitter = Math.round((Math.random() * 8) - 4);
            const remixed = {
                ...stats,
                total: Math.max(12, Math.min(99, stats.total + jitter))
            };
            updateScenario(remixed);
        }

        buildDialLabels();
        createStars();

        bedtimeInput.addEventListener("input", render);
        wakeInput.addEventListener("input", render);
        dayLoadSelect.addEventListener("change", render);
        caffeineSelect.addEventListener("change", render);
        habitButtons.forEach((button) => button.addEventListener("click", toggleHabit));
        presetButtons.forEach((button) => {
            button.addEventListener("click", () => activatePreset(button.dataset.preset));
        });
        simulateButton.addEventListener("click", rerollMorning);
        rerunButton.addEventListener("click", rerollMorning);
        window.addEventListener("resize", render);

        activatePreset("steady");
    </script>
</body>
</html>
