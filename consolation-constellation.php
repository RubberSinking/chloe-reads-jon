<?php
$sourceTitle = 'Two life-changing questions to ask yourself each day';
$sourceUrl = 'https://jona.ca/2012/10/two-life-changing-questions-to-ask.html';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolation Constellation</title>
    <style>
        :root {
            --night-0: #07111f;
            --night-1: #0d1f31;
            --night-2: #102b40;
            --panel: rgba(7, 16, 29, 0.84);
            --panel-soft: rgba(13, 27, 43, 0.68);
            --line: rgba(166, 201, 255, 0.16);
            --text: #eef4ff;
            --muted: #9db2d4;
            --warm: #ffd47a;
            --warm-2: #ffefb9;
            --cool: #7dd3c7;
            --cool-2: #93a7ff;
            --drain: #ff8c6b;
            --drain-2: #cf5f5f;
            --success: #b9ffdd;
            --shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
            --radius: 24px;
            --font-body: "Palatino Linotype", "Book Antiqua", Palatino, Georgia, serif;
            --font-display: "Trebuchet MS", "Gill Sans", "Segoe UI", sans-serif;
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: var(--font-body);
            background:
                radial-gradient(circle at 20% 20%, rgba(147, 167, 255, 0.22), transparent 32%),
                radial-gradient(circle at 82% 18%, rgba(255, 212, 122, 0.18), transparent 28%),
                radial-gradient(circle at 50% 80%, rgba(125, 211, 199, 0.12), transparent 24%),
                linear-gradient(180deg, #06101d 0%, #0a1628 34%, #0a1320 100%);
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        body::before {
            background-image:
                radial-gradient(circle at 12% 32%, rgba(255,255,255,0.85) 0 1px, transparent 1.2px),
                radial-gradient(circle at 80% 16%, rgba(255,255,255,0.75) 0 1.2px, transparent 1.4px),
                radial-gradient(circle at 72% 66%, rgba(255,255,255,0.68) 0 1px, transparent 1.2px),
                radial-gradient(circle at 30% 74%, rgba(255,255,255,0.62) 0 1px, transparent 1.2px),
                radial-gradient(circle at 50% 50%, rgba(255,255,255,0.4) 0 1px, transparent 1.2px);
            background-size: 320px 320px, 440px 440px, 380px 380px, 460px 460px, 500px 500px;
            opacity: 0.6;
        }

        body::after {
            background:
                repeating-linear-gradient(90deg, rgba(255,255,255,0.015) 0, rgba(255,255,255,0.015) 1px, transparent 1px, transparent 90px),
                repeating-linear-gradient(180deg, rgba(255,255,255,0.012) 0, rgba(255,255,255,0.012) 1px, transparent 1px, transparent 90px);
            mask-image: linear-gradient(180deg, rgba(0,0,0,0.12), rgba(0,0,0,0.8), rgba(0,0,0,0.12));
            opacity: 0.45;
        }

        a {
            color: var(--warm-2);
        }

        .shell {
            position: relative;
            z-index: 1;
            width: min(1180px, calc(100vw - 28px));
            margin: 0 auto;
            padding: 28px 0 64px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 34px;
            padding: 28px;
            background:
                linear-gradient(135deg, rgba(7,17,31,0.94), rgba(17,39,59,0.84)),
                linear-gradient(135deg, rgba(255,212,122,0.08), transparent 40%);
            box-shadow: var(--shadow);
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto -8% -28% 34%;
            height: 320px;
            background: radial-gradient(circle, rgba(255,212,122,0.22), transparent 58%);
            filter: blur(8px);
        }

        .hero-top {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            font-family: var(--font-display);
            font-size: 0.76rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--warm-2);
        }

        .hero h1 {
            margin: 16px 0 14px;
            max-width: 11ch;
            font-family: var(--font-display);
            font-size: clamp(3rem, 7vw, 5.8rem);
            line-height: 0.9;
            letter-spacing: -0.06em;
            text-transform: uppercase;
        }

        .hero p {
            max-width: 40rem;
            margin: 0;
            color: var(--muted);
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .hero-links a,
        .hero-links button {
            appearance: none;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: var(--text);
            text-decoration: none;
            border-radius: 999px;
            padding: 12px 18px;
            font-family: var(--font-display);
            font-size: 0.95rem;
            cursor: pointer;
            transition: transform 180ms ease, background 180ms ease, border-color 180ms ease;
        }

        .hero-links a:hover,
        .hero-links button:hover {
            transform: translateY(-2px);
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.2);
        }

        .hero-statwell {
            display: grid;
            grid-template-columns: repeat(3, minmax(120px, 1fr));
            gap: 12px;
            width: min(100%, 430px);
        }

        .stat-card {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(8px);
        }

        .stat-card .label {
            display: block;
            color: var(--muted);
            font-size: 0.82rem;
            margin-bottom: 8px;
        }

        .stat-card strong {
            font-family: var(--font-display);
            font-size: 1.8rem;
            letter-spacing: -0.05em;
        }

        .layout {
            display: grid;
            grid-template-columns: 380px minmax(0, 1fr);
            gap: 20px;
            margin-top: 22px;
        }

        .panel {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius);
            background: linear-gradient(180deg, var(--panel), rgba(5, 13, 24, 0.92));
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: var(--shadow);
        }

        .panel::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), transparent 22%);
            pointer-events: none;
        }

        .panel-inner {
            position: relative;
            z-index: 1;
            padding: 22px;
        }

        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            color: var(--cool);
            font-family: var(--font-display);
            font-size: 0.76rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .panel h2,
        .panel h3 {
            margin: 0;
            font-family: var(--font-display);
            letter-spacing: -0.04em;
        }

        .panel p {
            color: var(--muted);
            line-height: 1.65;
        }

        .entry-form {
            display: grid;
            gap: 14px;
        }

        .mode-toggle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .mode-btn {
            padding: 14px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            color: var(--text);
            cursor: pointer;
            text-align: left;
            transition: transform 160ms ease, border-color 160ms ease, background 160ms ease;
        }

        .mode-btn strong {
            display: block;
            font-family: var(--font-display);
            font-size: 1rem;
        }

        .mode-btn span {
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 0.88rem;
            line-height: 1.45;
        }

        .mode-btn.active[data-mode="bright"] {
            border-color: rgba(255,212,122,0.45);
            background: rgba(255,212,122,0.1);
            transform: translateY(-1px);
        }

        .mode-btn.active[data-mode="heavy"] {
            border-color: rgba(255,140,107,0.45);
            background: rgba(255,140,107,0.1);
            transform: translateY(-1px);
        }

        .fields {
            display: grid;
            gap: 12px;
        }

        label {
            display: block;
            font-size: 0.95rem;
            color: var(--warm-2);
            margin-bottom: 6px;
        }

        input,
        select,
        textarea {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.04);
            color: var(--text);
            border-radius: 16px;
            padding: 14px 15px;
            font: inherit;
            transition: border-color 160ms ease, background 160ms ease, transform 160ms ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: rgba(255,212,122,0.45);
            background: rgba(255,255,255,0.08);
        }

        textarea {
            min-height: 92px;
            resize: vertical;
        }

        .range-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
            align-items: center;
        }

        input[type="range"] {
            padding: 0;
            background: transparent;
            border: none;
        }

        .range-chip {
            min-width: 78px;
            text-align: center;
            border-radius: 999px;
            padding: 10px 12px;
            background: rgba(255,255,255,0.06);
            color: var(--warm-2);
            font-family: var(--font-display);
            font-size: 0.9rem;
        }

        .field-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .primary,
        .secondary {
            appearance: none;
            border: none;
            border-radius: 999px;
            cursor: pointer;
            font-family: var(--font-display);
            font-size: 0.95rem;
            padding: 14px 18px;
            transition: transform 180ms ease, filter 180ms ease;
        }

        .primary {
            background: linear-gradient(135deg, var(--warm), #ffb94f);
            color: #23170c;
            box-shadow: 0 14px 30px rgba(255, 185, 79, 0.25);
        }

        .secondary {
            background: rgba(255,255,255,0.06);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .primary:hover,
        .secondary:hover {
            transform: translateY(-2px);
            filter: brightness(1.03);
        }

        .sky-wrap {
            display: grid;
            gap: 18px;
        }

        .sky-header {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }

        .day-strip {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 8px;
        }

        .day-btn {
            padding: 12px 8px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            color: var(--text);
            cursor: pointer;
            text-align: center;
            transition: transform 180ms ease, background 180ms ease, border-color 180ms ease;
        }

        .day-btn strong {
            display: block;
            font-family: var(--font-display);
            font-size: 0.9rem;
        }

        .day-btn span {
            display: block;
            color: var(--muted);
            font-size: 0.72rem;
            margin-top: 4px;
        }

        .day-btn.active {
            background: rgba(255,212,122,0.1);
            border-color: rgba(255,212,122,0.35);
            transform: translateY(-1px);
        }

        .sky-stage {
            position: relative;
            min-height: 520px;
            border-radius: 28px;
            overflow: hidden;
            background:
                radial-gradient(circle at 50% 52%, rgba(255,255,255,0.06), transparent 26%),
                radial-gradient(circle at 50% 100%, rgba(255,212,122,0.12), transparent 30%),
                linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0));
            border: 1px solid rgba(255,255,255,0.08);
        }

        .sky-stage svg {
            display: block;
            width: 100%;
            height: 520px;
        }

        .hud {
            position: absolute;
            inset: 18px auto auto 18px;
            display: grid;
            gap: 10px;
            max-width: 260px;
        }

        .hud-card,
        .insight-card,
        .legend-card,
        .ritual-card,
        .entry-card {
            border-radius: 20px;
            background: rgba(6, 16, 30, 0.72);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(10px);
        }

        .hud-card {
            padding: 14px 16px;
        }

        .hud-card strong {
            display: block;
            font-family: var(--font-display);
            margin-bottom: 5px;
        }

        .legend-card,
        .insight-card,
        .ritual-card,
        .entry-card {
            padding: 18px;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .mini-stat {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .mini-stat strong {
            display: block;
            font-family: var(--font-display);
            font-size: 1.3rem;
            margin-top: 6px;
        }

        .insight-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 18px;
        }

        .insight-list,
        .entry-list {
            display: grid;
            gap: 12px;
        }

        .insight-pill {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .insight-pill strong {
            font-family: var(--font-display);
            color: var(--warm-2);
        }

        .legend-rows {
            display: grid;
            gap: 10px;
        }

        .legend-row {
            display: flex;
            gap: 10px;
            align-items: center;
            color: var(--muted);
            line-height: 1.45;
        }

        .legend-dot {
            width: 16px;
            height: 16px;
            flex: 0 0 auto;
            border-radius: 999px;
        }

        .legend-dot.bright {
            background: radial-gradient(circle at 30% 30%, #fff7df, var(--warm) 55%, rgba(255,212,122,0.05) 70%);
            box-shadow: 0 0 18px rgba(255,212,122,0.45);
        }

        .legend-dot.heavy {
            background: radial-gradient(circle at 36% 34%, #ffd7ca, var(--drain) 48%, rgba(255,140,107,0.08) 72%);
            box-shadow: 0 0 18px rgba(255,140,107,0.32);
        }

        .legend-dot.arc {
            background: linear-gradient(135deg, var(--cool), var(--cool-2));
            border-radius: 4px;
            height: 4px;
        }

        .entry-card header,
        .ritual-card header,
        .insight-card header,
        .legend-card header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 14px;
        }

        .entry-card header span,
        .ritual-card header span,
        .insight-card header span,
        .legend-card header span {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .entry-item {
            display: grid;
            gap: 8px;
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .entry-topline {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
            justify-content: space-between;
        }

        .entry-topline strong {
            font-family: var(--font-display);
            font-size: 1rem;
        }

        .tagline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            color: var(--muted);
            font-size: 0.78rem;
        }

        .entry-item p {
            margin: 0;
        }

        .entry-foot {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
        }

        .chip-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .chip {
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            color: var(--muted);
            font-size: 0.78rem;
        }

        .mini-btn {
            appearance: none;
            border: none;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(255,255,255,0.08);
            color: var(--text);
            cursor: pointer;
            font-family: var(--font-display);
        }

        .empty-state {
            padding: 20px;
            border-radius: 18px;
            border: 1px dashed rgba(255,255,255,0.18);
            color: var(--muted);
            text-align: center;
        }

        .footer-note {
            margin-top: 22px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .toast {
            position: fixed;
            right: 18px;
            bottom: 18px;
            z-index: 10;
            padding: 14px 18px;
            border-radius: 18px;
            background: rgba(8, 22, 35, 0.92);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: var(--shadow);
            opacity: 0;
            transform: translateY(12px);
            transition: opacity 180ms ease, transform 180ms ease;
            pointer-events: none;
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .sr-only {
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

        @media (max-width: 960px) {
            .layout,
            .insight-grid {
                grid-template-columns: 1fr;
            }

            .hero-statwell,
            .meta-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                width: 100%;
            }
        }

        @media (max-width: 720px) {
            .shell {
                width: min(100vw - 18px, 100%);
                padding-top: 10px;
            }

            .hero,
            .panel-inner {
                padding: 18px;
            }

            .hero h1 {
                max-width: none;
                font-size: clamp(2.7rem, 12vw, 4rem);
            }

            .hero-statwell,
            .field-grid,
            .meta-grid,
            .day-strip {
                grid-template-columns: 1fr 1fr;
            }

            .hud {
                position: static;
                max-width: none;
                margin: 12px;
            }

            .sky-stage {
                min-height: 600px;
            }

            .sky-stage svg {
                height: 420px;
            }
        }

        @media (max-width: 520px) {
            .hero-statwell,
            .field-grid,
            .meta-grid,
            .day-strip,
            .mode-toggle {
                grid-template-columns: 1fr;
            }

            .sky-stage {
                min-height: 640px;
            }

            .actions,
            .hero-links {
                flex-direction: column;
            }

            .hero-links a,
            .hero-links button,
            .primary,
            .secondary {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="hero-top">
                <div>
                    <div class="eyebrow">Nightly pattern observatory</div>
                    <h1>Consolation Constellation</h1>
                    <p>A midnight sky for Jon's two daily questions: what gave you life, and what drained it? Add moments, watch them become stars and gravity wells, then let the observatory tease out patterns worth following tomorrow.</p>
                    <div class="hero-links">
                        <a href="#entry-panel">Chart tonight's sky</a>
                        <button id="loadDemoBtn" type="button">Load a sample week</button>
                        <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>">Inspired by Jon's <?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>
                    </div>
                </div>
                <div class="hero-statwell" aria-label="Current constellation summary">
                    <div class="stat-card">
                        <span class="label">Bright stars</span>
                        <strong id="heroBrightCount">0</strong>
                    </div>
                    <div class="stat-card">
                        <span class="label">Gravity wells</span>
                        <strong id="heroHeavyCount">0</strong>
                    </div>
                    <div class="stat-card">
                        <span class="label">Net glow</span>
                        <strong id="heroBalance">0</strong>
                    </div>
                </div>
            </div>
        </section>

        <section class="layout">
            <aside class="panel" id="entry-panel">
                <div class="panel-inner">
                    <div class="section-kicker">Field notes</div>
                    <h2>Chart a moment</h2>
                    <p>Turn a single piece of the day into a sky object. Bright things become stars. Heavy things become gravity wells. The more impact and repeat they carry, the more they distort the heavens.</p>

                    <form class="entry-form" id="entryForm">
                        <div class="mode-toggle" role="tablist" aria-label="Choose moment type">
                            <button class="mode-btn active" type="button" data-mode="bright" aria-pressed="true">
                                <strong>Bright star</strong>
                                <span>Gratitude, consolation, energy, delight.</span>
                            </button>
                            <button class="mode-btn" type="button" data-mode="heavy" aria-pressed="false">
                                <strong>Gravity well</strong>
                                <span>Drain, desolation, friction, quiet dread.</span>
                            </button>
                        </div>

                        <div class="fields">
                            <div>
                                <label for="entryTitle">What happened?</label>
                                <input id="entryTitle" name="title" maxlength="60" placeholder="Tea with Nathan, focused coding sprint, doomscroll swamp..." required>
                            </div>
                            <div>
                                <label for="entryNote">Short note</label>
                                <textarea id="entryNote" name="note" maxlength="220" placeholder="What made this feel alive or heavy?"></textarea>
                            </div>
                            <div class="field-grid">
                                <div>
                                    <label for="entryCategory">Category</label>
                                    <select id="entryCategory" name="category">
                                        <option value="People">People</option>
                                        <option value="Prayer">Prayer</option>
                                        <option value="Work">Work</option>
                                        <option value="Play">Play</option>
                                        <option value="Rest">Rest</option>
                                        <option value="Body">Body</option>
                                        <option value="Learning">Learning</option>
                                        <option value="Household">Household</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="entryDay">Night slot</label>
                                    <select id="entryDay" name="day"></select>
                                </div>
                            </div>
                            <div>
                                <label for="entryImpact">Impact</label>
                                <div class="range-row">
                                    <input id="entryImpact" type="range" min="1" max="5" value="3">
                                    <div class="range-chip" id="impactChip">steady</div>
                                </div>
                            </div>
                            <div>
                                <label for="entryRepeat">How repeatable was it?</label>
                                <div class="range-row">
                                    <input id="entryRepeat" type="range" min="1" max="5" value="2">
                                    <div class="range-chip" id="repeatChip">occasional</div>
                                </div>
                            </div>
                        </div>

                        <div class="actions">
                            <button class="primary" type="submit">Add to the sky</button>
                            <button class="secondary" type="button" id="randomPromptBtn">Need a prompt?</button>
                            <button class="secondary" type="button" id="clearDayBtn">Clear this night</button>
                        </div>
                    </form>

                    <p class="footer-note">The point is not perfect accounting. It is noticing. Even a tiny star counts.</p>
                </div>
            </aside>

            <section class="sky-wrap">
                <div class="panel">
                    <div class="panel-inner">
                        <div class="sky-header">
                            <div>
                                <div class="section-kicker">Seven-night sweep</div>
                                <h2 id="selectedDayHeading">Tonight's sky</h2>
                            </div>
                            <p id="selectedDaySubhead">A week of patterns usually tells the truth better than a single mood.</p>
                        </div>
                        <div class="day-strip" id="dayStrip" aria-label="Select a day"></div>
                        <div class="sky-stage">
                            <div class="hud">
                                <div class="hud-card">
                                    <strong id="hudTitle">No patterns yet</strong>
                                    <span id="hudText">Add a bright star or gravity well to begin charting the week.</span>
                                </div>
                                <div class="hud-card">
                                    <strong>Observatory hint</strong>
                                    <span>Stars cluster by category. Repeated bright categories arc together. Repeated heavy ones leave warm pressure rings.</span>
                                </div>
                            </div>
                            <svg id="skySvg" viewBox="0 0 900 520" role="img" aria-labelledby="skyTitle skyDesc">
                                <title id="skyTitle">Interactive constellation map</title>
                                <desc id="skyDesc">A sky map showing bright life-giving moments and heavy draining moments for the selected day.</desc>
                                <defs>
                                    <radialGradient id="starGlow" cx="50%" cy="50%" r="50%">
                                        <stop offset="0%" stop-color="#fff9ea"></stop>
                                        <stop offset="45%" stop-color="#ffd47a"></stop>
                                        <stop offset="100%" stop-color="rgba(255,212,122,0)"></stop>
                                    </radialGradient>
                                    <radialGradient id="heavyGlow" cx="50%" cy="50%" r="50%">
                                        <stop offset="0%" stop-color="#ffe4d9"></stop>
                                        <stop offset="42%" stop-color="#ff8c6b"></stop>
                                        <stop offset="100%" stop-color="rgba(255,140,107,0)"></stop>
                                    </radialGradient>
                                    <linearGradient id="arcGlow" x1="0%" x2="100%">
                                        <stop offset="0%" stop-color="#7dd3c7" stop-opacity="0.1"></stop>
                                        <stop offset="50%" stop-color="#a4dfff" stop-opacity="0.75"></stop>
                                        <stop offset="100%" stop-color="#7dd3c7" stop-opacity="0.1"></stop>
                                    </linearGradient>
                                    <filter id="softBlur">
                                        <feGaussianBlur stdDeviation="12"></feGaussianBlur>
                                    </filter>
                                </defs>
                                <g id="skyGrid"></g>
                                <g id="skyArcs"></g>
                                <g id="skyBodies"></g>
                                <g id="skyLabels"></g>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="insight-grid">
                    <section class="panel insight-card">
                        <header>
                            <h3>Pattern briefing</h3>
                            <span id="patternTimestamp">Freshly awake</span>
                        </header>
                        <div class="meta-grid">
                            <div class="mini-stat">
                                <span>Most bright</span>
                                <strong id="topBrightCategory">None</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Most heavy</span>
                                <strong id="topHeavyCategory">None</strong>
                            </div>
                            <div class="mini-stat">
                                <span>Best experiment</span>
                                <strong id="patternExperiment">Look up</strong>
                            </div>
                        </div>
                        <div class="insight-list" id="insightList"></div>
                    </section>

                    <section class="panel legend-card">
                        <header>
                            <h3>How to read the sky</h3>
                            <span>No astrology nonsense, just humane pattern-spotting.</span>
                        </header>
                        <div class="legend-rows">
                            <div class="legend-row"><span class="legend-dot bright"></span><span>Bright stars mark moments that felt nourishing, grateful, peaceful, playful, or alive.</span></div>
                            <div class="legend-row"><span class="legend-dot heavy"></span><span>Gravity wells mark what pulled energy downward: friction, doomscrolling, hurry, clutter, dread.</span></div>
                            <div class="legend-row"><span class="legend-dot arc"></span><span>Cold arcs connect repeated bright categories across the week, which usually means a repeatable source of life.</span></div>
                        </div>
                    </section>
                </div>

                <div class="insight-grid">
                    <section class="panel entry-card">
                        <header>
                            <h3>Night log</h3>
                            <span id="entryCountLabel">0 entries tonight</span>
                        </header>
                        <div class="entry-list" id="entryList"></div>
                    </section>

                    <section class="panel ritual-card">
                        <header>
                            <h3>Two gentle questions</h3>
                            <span>Borrowed from the source post, with a little observatory drama.</span>
                        </header>
                        <div class="insight-list">
                            <div class="insight-pill"><strong>What was I most grateful for today?</strong><br>Try to be concrete enough that you could recreate it on purpose.</div>
                            <div class="insight-pill"><strong>What was I least grateful for today?</strong><br>Name the drag without building a shrine to it. A pattern is enough.</div>
                            <div class="insight-pill"><strong>What tiny experiment would tilt tomorrow brighter?</strong><br>One repeatable act beats a grand vow wearing a cape.</div>
                        </div>
                    </section>
                </div>
            </section>
        </section>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        (() => {
            const storageKey = 'consolation-constellation-v1';
            const labelsImpact = ['faint', 'gentle', 'steady', 'strong', 'blazing'];
            const labelsRepeat = ['rare', 'occasional', 'repeatable', 'habit-forming', 'anchoring'];
            const prompts = [
                { mode: 'bright', title: 'What made you exhale a little?', note: 'A small easing moment often matters more than the dramatic ones.', category: 'Rest' },
                { mode: 'bright', title: 'Where did you feel delight instead of duty?', note: 'Play is allowed to count, imagine that.', category: 'Play' },
                { mode: 'heavy', title: 'What made your shoulders creep upward?', note: 'Often the body tattles before the mind does.', category: 'Body' },
                { mode: 'heavy', title: 'What looked small but somehow gnawed at you?', note: 'Tiny drains with teeth are still drains.', category: 'Household' },
                { mode: 'bright', title: 'Who gave you a little more heart than you had before?', note: 'People can be architecture for courage.', category: 'People' },
                { mode: 'heavy', title: 'Which task turned into molasses?', note: 'That usually means friction, fog, or missing support.', category: 'Work' }
            ];

            const demoWeek = [
                {
                    id: 'day-0',
                    label: 'Mon',
                    dateLabel: 'Tonight',
                    entries: [
                        { id: 'a1', type: 'bright', title: 'Tea and chat with Nathan', note: 'The whole house felt less hurried after ten silly minutes talking about cars.', category: 'People', impact: 4, repeat: 4 },
                        { id: 'a2', type: 'heavy', title: 'Inbox drift', note: 'Kept peeking instead of finishing the one thing that mattered.', category: 'Work', impact: 3, repeat: 4 },
                        { id: 'a3', type: 'bright', title: 'Evening prayer', note: 'Settled the weather in my head a little.', category: 'Prayer', impact: 3, repeat: 5 }
                    ]
                },
                {
                    id: 'day-1',
                    label: 'Tue',
                    dateLabel: 'Last night',
                    entries: [
                        { id: 'b1', type: 'bright', title: 'Focused code sprint', note: 'A clean little pocket of competence. Lovely.', category: 'Work', impact: 5, repeat: 3 },
                        { id: 'b2', type: 'heavy', title: 'Kitchen clutter ambush', note: 'Not tragic. Just enough visual static to sandpaper the mood.', category: 'Household', impact: 2, repeat: 4 },
                        { id: 'b3', type: 'bright', title: 'Walk outside', note: 'Body and brain both stopped acting like union reps on strike.', category: 'Body', impact: 4, repeat: 4 }
                    ]
                },
                {
                    id: 'day-2',
                    label: 'Wed',
                    dateLabel: '2 nights ago',
                    entries: [
                        { id: 'c1', type: 'heavy', title: 'Late-night scrolling', note: 'Borrowed stimulation, paid back with static.', category: 'Rest', impact: 4, repeat: 5 },
                        { id: 'c2', type: 'bright', title: 'Read something wise', note: 'Felt mentally fed instead of merely filled.', category: 'Learning', impact: 3, repeat: 4 }
                    ]
                },
                { id: 'day-3', label: 'Thu', dateLabel: '3 nights ago', entries: [] },
                { id: 'day-4', label: 'Fri', dateLabel: '4 nights ago', entries: [] },
                { id: 'day-5', label: 'Sat', dateLabel: '5 nights ago', entries: [] },
                { id: 'day-6', label: 'Sun', dateLabel: '6 nights ago', entries: [] }
            ];

            const state = loadState();
            let selectedDay = 0;
            let selectedMode = 'bright';

            const entryForm = document.getElementById('entryForm');
            const entryTitle = document.getElementById('entryTitle');
            const entryNote = document.getElementById('entryNote');
            const entryCategory = document.getElementById('entryCategory');
            const entryDay = document.getElementById('entryDay');
            const entryImpact = document.getElementById('entryImpact');
            const entryRepeat = document.getElementById('entryRepeat');
            const impactChip = document.getElementById('impactChip');
            const repeatChip = document.getElementById('repeatChip');
            const dayStrip = document.getElementById('dayStrip');
            const selectedDayHeading = document.getElementById('selectedDayHeading');
            const selectedDaySubhead = document.getElementById('selectedDaySubhead');
            const heroBrightCount = document.getElementById('heroBrightCount');
            const heroHeavyCount = document.getElementById('heroHeavyCount');
            const heroBalance = document.getElementById('heroBalance');
            const topBrightCategory = document.getElementById('topBrightCategory');
            const topHeavyCategory = document.getElementById('topHeavyCategory');
            const patternExperiment = document.getElementById('patternExperiment');
            const insightList = document.getElementById('insightList');
            const entryList = document.getElementById('entryList');
            const entryCountLabel = document.getElementById('entryCountLabel');
            const hudTitle = document.getElementById('hudTitle');
            const hudText = document.getElementById('hudText');
            const patternTimestamp = document.getElementById('patternTimestamp');
            const skyGrid = document.getElementById('skyGrid');
            const skyArcs = document.getElementById('skyArcs');
            const skyBodies = document.getElementById('skyBodies');
            const skyLabels = document.getElementById('skyLabels');
            const toast = document.getElementById('toast');

            document.querySelectorAll('.mode-btn').forEach((button) => {
                button.addEventListener('click', () => {
                    selectedMode = button.dataset.mode;
                    document.querySelectorAll('.mode-btn').forEach((candidate) => {
                        const active = candidate === button;
                        candidate.classList.toggle('active', active);
                        candidate.setAttribute('aria-pressed', active ? 'true' : 'false');
                    });
                });
            });

            entryImpact.addEventListener('input', () => {
                impactChip.textContent = labelsImpact[Number(entryImpact.value) - 1];
            });
            entryRepeat.addEventListener('input', () => {
                repeatChip.textContent = labelsRepeat[Number(entryRepeat.value) - 1];
            });
            impactChip.textContent = labelsImpact[Number(entryImpact.value) - 1];
            repeatChip.textContent = labelsRepeat[Number(entryRepeat.value) - 1];

            document.getElementById('loadDemoBtn').addEventListener('click', () => {
                state.days = JSON.parse(JSON.stringify(demoWeek));
                selectedDay = 0;
                saveState();
                render();
                showToast('Loaded a sample week into the observatory.');
            });

            document.getElementById('randomPromptBtn').addEventListener('click', () => {
                const matches = prompts.filter((prompt) => prompt.mode === selectedMode);
                const prompt = matches[Math.floor(Math.random() * matches.length)];
                entryTitle.value = prompt.title;
                entryNote.value = prompt.note;
                entryCategory.value = prompt.category;
                entryTitle.focus();
                showToast('Prompt loaded. The stars are doing their best.');
            });

            document.getElementById('clearDayBtn').addEventListener('click', () => {
                const day = state.days[selectedDay];
                if (!day.entries.length) {
                    showToast('Nothing to clear for this night.');
                    return;
                }
                const confirmClear = window.confirm(`Clear every entry from ${day.label}?`);
                if (!confirmClear) return;
                day.entries = [];
                saveState();
                render();
                showToast(`${day.label} has been cleared.`);
            });

            entryForm.addEventListener('submit', (event) => {
                event.preventDefault();
                const dayIndex = Number(entryDay.value);
                const entry = {
                    id: `entry-${Date.now()}-${Math.random().toString(16).slice(2)}`,
                    type: selectedMode,
                    title: entryTitle.value.trim(),
                    note: entryNote.value.trim(),
                    category: entryCategory.value,
                    impact: Number(entryImpact.value),
                    repeat: Number(entryRepeat.value)
                };

                if (!entry.title) {
                    entryTitle.focus();
                    return;
                }

                state.days[dayIndex].entries.unshift(entry);
                selectedDay = dayIndex;
                saveState();
                entryForm.reset();
                entryImpact.value = 3;
                entryRepeat.value = 2;
                impactChip.textContent = labelsImpact[2];
                repeatChip.textContent = labelsRepeat[1];
                selectedMode = 'bright';
                document.querySelectorAll('.mode-btn').forEach((button) => {
                    const active = button.dataset.mode === 'bright';
                    button.classList.toggle('active', active);
                    button.setAttribute('aria-pressed', active ? 'true' : 'false');
                });
                render();
                showToast('A new sky object has been charted.');
            });

            function loadState() {
                try {
                    const raw = localStorage.getItem(storageKey);
                    if (!raw) return { days: buildEmptyWeek() };
                    const parsed = JSON.parse(raw);
                    if (!parsed || !Array.isArray(parsed.days) || parsed.days.length !== 7) {
                        return { days: buildEmptyWeek() };
                    }
                    return parsed;
                } catch (error) {
                    return { days: buildEmptyWeek() };
                }
            }

            function buildEmptyWeek() {
                const base = new Date();
                const formatterDay = new Intl.DateTimeFormat(undefined, { weekday: 'short' });
                const formatterDate = new Intl.DateTimeFormat(undefined, { month: 'short', day: 'numeric' });
                return Array.from({ length: 7 }, (_, index) => {
                    const date = new Date(base);
                    date.setDate(base.getDate() - index);
                    return {
                        id: `day-${index}`,
                        label: formatterDay.format(date),
                        dateLabel: index === 0 ? 'Tonight' : formatterDate.format(date),
                        entries: []
                    };
                });
            }

            function saveState() {
                localStorage.setItem(storageKey, JSON.stringify(state));
            }

            function render() {
                renderDayControls();
                renderHeaderStats();
                renderPatternBriefing();
                renderEntries();
                renderSky();
                populateDaySelect();
            }

            function renderDayControls() {
                dayStrip.innerHTML = '';
                state.days.forEach((day, index) => {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'day-btn' + (index === selectedDay ? ' active' : '');
                    button.innerHTML = `<strong>${day.label}</strong><span>${day.dateLabel}</span>`;
                    button.addEventListener('click', () => {
                        selectedDay = index;
                        render();
                    });
                    dayStrip.appendChild(button);
                });
                const activeDay = state.days[selectedDay];
                selectedDayHeading.textContent = `${activeDay.label} constellation`;
                selectedDaySubhead.textContent = `${activeDay.entries.length} entries charted for ${activeDay.dateLabel.toLowerCase()}.`;
            }

            function populateDaySelect() {
                entryDay.innerHTML = state.days.map((day, index) => {
                    const selected = index === selectedDay ? ' selected' : '';
                    return `<option value="${index}"${selected}>${day.label} · ${day.dateLabel}</option>`;
                }).join('');
            }

            function renderHeaderStats() {
                const allEntries = state.days.flatMap((day) => day.entries);
                const brightCount = allEntries.filter((entry) => entry.type === 'bright').length;
                const heavyCount = allEntries.filter((entry) => entry.type === 'heavy').length;
                const balance = allEntries.reduce((sum, entry) => sum + (entry.type === 'bright' ? entry.impact : -entry.impact), 0);
                heroBrightCount.textContent = brightCount;
                heroHeavyCount.textContent = heavyCount;
                heroBalance.textContent = balance > 0 ? `+${balance}` : String(balance);
            }

            function tallyCategories(entries, type) {
                const counts = {};
                entries.filter((entry) => entry.type === type).forEach((entry) => {
                    counts[entry.category] = (counts[entry.category] || 0) + entry.impact + entry.repeat;
                });
                return counts;
            }

            function topCategory(counts) {
                const sorted = Object.entries(counts).sort((a, b) => b[1] - a[1]);
                return sorted[0]?.[0] || 'None';
            }

            function renderPatternBriefing() {
                const allEntries = state.days.flatMap((day) => day.entries);
                const brightCounts = tallyCategories(allEntries, 'bright');
                const heavyCounts = tallyCategories(allEntries, 'heavy');
                const bestBright = topCategory(brightCounts);
                const worstHeavy = topCategory(heavyCounts);
                topBrightCategory.textContent = bestBright;
                topHeavyCategory.textContent = worstHeavy;
                patternExperiment.textContent = bestBright !== 'None' ? `More ${bestBright}` : 'Name one star';
                patternTimestamp.textContent = new Intl.DateTimeFormat(undefined, { hour: 'numeric', minute: '2-digit' }).format(new Date());

                const insights = buildInsights(allEntries, brightCounts, heavyCounts);
                insightList.innerHTML = insights.map((insight) => `<div class="insight-pill"><strong>${insight.title}</strong><br>${insight.text}</div>`).join('');
                const firstInsight = insights[0];
                hudTitle.textContent = firstInsight.title;
                hudText.textContent = firstInsight.text;
            }

            function buildInsights(allEntries, brightCounts, heavyCounts) {
                if (!allEntries.length) {
                    return [
                        {
                            title: 'Begin with one honest object',
                            text: 'Add one bright star or gravity well. The observatory only needs a tiny signal to start noticing your patterns.'
                        },
                        {
                            title: 'Aim for concrete moments',
                            text: '“Tea with Nathan” or “doomscrolling before bed” tells the truth faster than vague moods do.'
                        },
                        {
                            title: 'A week beats a vibe',
                            text: 'Single nights can lie. Repeated categories usually cannot.'
                        }
                    ];
                }

                const insights = [];
                const brightest = topCategory(brightCounts);
                const heaviest = topCategory(heavyCounts);
                const repeatBright = allEntries.filter((entry) => entry.type === 'bright' && entry.repeat >= 4);
                const repeatHeavy = allEntries.filter((entry) => entry.type === 'heavy' && entry.repeat >= 4);
                const net = allEntries.reduce((sum, entry) => sum + (entry.type === 'bright' ? entry.impact : -entry.impact), 0);

                if (brightest !== 'None') {
                    insights.push({
                        title: `Your brightest lane is ${brightest}`,
                        text: `This category is producing the strongest warm signal. If tomorrow goes sideways, stealing even ten minutes back for ${brightest.toLowerCase()} is probably wise.`
                    });
                }
                if (heaviest !== 'None') {
                    insights.push({
                        title: `${heaviest} is where the drag collects`,
                        text: `The repeated heaviness is not random weather. It may be time for a gentler boundary, a smaller task shape, or a better handoff in ${heaviest.toLowerCase()}.`
                    });
                }
                if (repeatBright.length) {
                    insights.push({
                        title: 'You already know one thing that works',
                        text: `Something repeatable is shining: ${repeatBright[0].title.toLowerCase()}. That means tomorrow's “good day” need not be invented from scratch.`
                    });
                }
                if (repeatHeavy.length) {
                    insights.push({
                        title: 'One recurring drain is asking for mischief',
                        text: `${repeatHeavy[0].title} keeps coming back. Tiny sabotage beats heroic self-improvement here: shorten it, move it, or make it uglier to ignore.`
                    });
                }
                insights.push({
                    title: net >= 0 ? 'The week currently tilts bright' : 'The week is carrying some weather',
                    text: net >= 0
                        ? 'Not because everything was easy, but because the nourishing moments still outweigh the pressure. Guard them.'
                        : 'That does not mean failure. It means the sky is giving you useful information instead of polite lies.'
                });

                return insights.slice(0, 4);
            }

            function renderEntries() {
                const day = state.days[selectedDay];
                entryCountLabel.textContent = `${day.entries.length} entr${day.entries.length === 1 ? 'y' : 'ies'} charted`;
                if (!day.entries.length) {
                    entryList.innerHTML = `<div class="empty-state">This night is still blank. Add the smallest real star or drain you can name.</div>`;
                    return;
                }

                entryList.innerHTML = day.entries.map((entry) => {
                    const typeLabel = entry.type === 'bright' ? 'Bright star' : 'Gravity well';
                    return `
                        <article class="entry-item">
                            <div class="entry-topline">
                                <strong>${escapeHtml(entry.title)}</strong>
                                <span class="tagline">${typeLabel}</span>
                            </div>
                            <p>${escapeHtml(entry.note || 'No extra note. Sometimes the title says enough.')}</p>
                            <div class="entry-foot">
                                <div class="chip-row">
                                    <span class="chip">${escapeHtml(entry.category)}</span>
                                    <span class="chip">impact ${entry.impact}</span>
                                    <span class="chip">repeat ${entry.repeat}</span>
                                </div>
                                <button class="mini-btn" type="button" data-delete-id="${entry.id}">Remove</button>
                            </div>
                        </article>
                    `;
                }).join('');

                entryList.querySelectorAll('[data-delete-id]').forEach((button) => {
                    button.addEventListener('click', () => {
                        const dayEntries = state.days[selectedDay].entries;
                        state.days[selectedDay].entries = dayEntries.filter((entry) => entry.id !== button.dataset.deleteId);
                        saveState();
                        render();
                        showToast('Sky object removed.');
                    });
                });
            }

            function renderSky() {
                skyGrid.innerHTML = '';
                skyArcs.innerHTML = '';
                skyBodies.innerHTML = '';
                skyLabels.innerHTML = '';

                for (let x = 70; x <= 830; x += 95) {
                    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.setAttribute('x1', x);
                    line.setAttribute('y1', 60);
                    line.setAttribute('x2', x);
                    line.setAttribute('y2', 470);
                    line.setAttribute('stroke', 'rgba(255,255,255,0.06)');
                    line.setAttribute('stroke-width', '1');
                    skyGrid.appendChild(line);
                }
                for (let y = 80; y <= 440; y += 72) {
                    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.setAttribute('x1', 50);
                    line.setAttribute('y1', y);
                    line.setAttribute('x2', 850);
                    line.setAttribute('y2', y);
                    line.setAttribute('stroke', 'rgba(255,255,255,0.05)');
                    line.setAttribute('stroke-width', '1');
                    skyGrid.appendChild(line);
                }

                const entries = state.days[selectedDay].entries;
                if (!entries.length) {
                    const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                    text.setAttribute('x', '450');
                    text.setAttribute('y', '260');
                    text.setAttribute('text-anchor', 'middle');
                    text.setAttribute('fill', 'rgba(238,244,255,0.78)');
                    text.setAttribute('font-size', '26');
                    text.setAttribute('font-family', 'Trebuchet MS, sans-serif');
                    text.textContent = 'No stars charted for this night yet';
                    skyBodies.appendChild(text);
                    return;
                }

                const bright = entries.filter((entry) => entry.type === 'bright');
                const heavy = entries.filter((entry) => entry.type === 'heavy');
                const brightCountsAcrossWeek = tallyCategories(state.days.flatMap((day) => day.entries), 'bright');
                const repeatedBrightCategories = Object.keys(brightCountsAcrossWeek).filter((category) => brightCountsAcrossWeek[category] >= 10);

                const positions = new Map();
                const categories = [...new Set(entries.map((entry) => entry.category))];
                const categoryAnchors = new Map();
                categories.forEach((category, index) => {
                    const angle = (Math.PI * 2 * index) / Math.max(categories.length, 1) - Math.PI / 2;
                    categoryAnchors.set(category, {
                        x: 450 + Math.cos(angle) * 180,
                        y: 260 + Math.sin(angle) * 120
                    });
                });

                entries.forEach((entry, index) => {
                    const anchor = categoryAnchors.get(entry.category) || { x: 450, y: 260 };
                    const orbit = 34 + entry.repeat * 18;
                    const angle = ((index + 1) * 0.95) + (entry.type === 'heavy' ? 0.5 : -0.3);
                    const variance = entry.type === 'bright' ? 1 : -1;
                    const x = anchor.x + Math.cos(angle) * orbit * variance + ((index % 2 === 0) ? 20 : -18);
                    const y = anchor.y + Math.sin(angle) * orbit + (entry.type === 'heavy' ? 12 : -8);
                    positions.set(entry.id, { x, y });
                });

                repeatedBrightCategories.forEach((category) => {
                    const matches = entries.filter((entry) => entry.category === category && entry.type === 'bright');
                    if (matches.length < 2) return;
                    const points = matches.map((entry) => positions.get(entry.id));
                    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                    const d = points.map((point, index) => `${index === 0 ? 'M' : 'L'} ${point.x} ${point.y}`).join(' ');
                    path.setAttribute('d', d);
                    path.setAttribute('stroke', 'url(#arcGlow)');
                    path.setAttribute('stroke-width', '3');
                    path.setAttribute('fill', 'none');
                    path.setAttribute('stroke-linecap', 'round');
                    skyArcs.appendChild(path);
                });

                entries.forEach((entry) => {
                    const { x, y } = positions.get(entry.id);
                    const glow = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    glow.setAttribute('cx', x);
                    glow.setAttribute('cy', y);
                    glow.setAttribute('r', entry.type === 'bright' ? 18 + entry.impact * 4 : 22 + entry.impact * 4);
                    glow.setAttribute('fill', entry.type === 'bright' ? 'url(#starGlow)' : 'url(#heavyGlow)');
                    glow.setAttribute('opacity', entry.type === 'bright' ? '0.82' : '0.68');
                    glow.setAttribute('filter', 'url(#softBlur)');
                    skyBodies.appendChild(glow);

                    const core = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                    core.setAttribute('cx', x);
                    core.setAttribute('cy', y);
                    core.setAttribute('r', entry.type === 'bright' ? 4 + entry.impact * 1.4 : 6 + entry.impact * 1.5);
                    core.setAttribute('fill', entry.type === 'bright' ? '#fff3cf' : '#ffd9d2');
                    core.setAttribute('stroke', entry.type === 'bright' ? '#ffd47a' : '#ff8c6b');
                    core.setAttribute('stroke-width', '2');
                    skyBodies.appendChild(core);

                    if (entry.type === 'heavy') {
                        const ring = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                        ring.setAttribute('cx', x);
                        ring.setAttribute('cy', y);
                        ring.setAttribute('r', 12 + entry.repeat * 3.4);
                        ring.setAttribute('fill', 'none');
                        ring.setAttribute('stroke', 'rgba(255,140,107,0.26)');
                        ring.setAttribute('stroke-width', '1.5');
                        ring.setAttribute('stroke-dasharray', '5 6');
                        skyBodies.appendChild(ring);
                    }

                    const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                    label.setAttribute('x', x + 10);
                    label.setAttribute('y', y - 12);
                    label.setAttribute('fill', 'rgba(238,244,255,0.92)');
                    label.setAttribute('font-size', '14');
                    label.setAttribute('font-family', 'Trebuchet MS, sans-serif');
                    label.textContent = entry.title;
                    skyLabels.appendChild(label);
                });
            }

            function escapeHtml(value) {
                return value
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            let toastTimer = null;
            function showToast(message) {
                toast.textContent = message;
                toast.classList.add('show');
                clearTimeout(toastTimer);
                toastTimer = window.setTimeout(() => {
                    toast.classList.remove('show');
                }, 2400);
            }

            render();
        })();
    </script>
</body>
</html>
