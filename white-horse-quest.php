<?php
$postTitle = "Audio for Chesterton's Ballad of the White Horse";
$postUrl = "https://cooltoolsforcatholics.blogspot.com/2009/07/audio-for-chestertons-ballad-of-white.html";
$cantos = [
    [
        'id' => 1,
        'title' => 'The Vision of the King',
        'minutes' => 15,
        'mood' => 'wonder',
        'energy' => 'low',
        'theme' => 'A dream-lit beginning with prophecy, stillness, and a king who must wake up to his task.',
        'badge' => 'Lantern',
    ],
    [
        'id' => 2,
        'title' => 'The Gathering of the Chiefs',
        'minutes' => 15,
        'mood' => 'strategy',
        'energy' => 'medium',
        'theme' => 'Voices assemble, loyalties get tested, and the map begins to matter.',
        'badge' => 'Council',
    ],
    [
        'id' => 3,
        'title' => 'Harold in Ireland',
        'minutes' => 15,
        'mood' => 'adventure',
        'energy' => 'high',
        'theme' => 'A sea-salted detour full of travel, resolve, and the stubborn weather of history.',
        'badge' => 'Sail',
    ],
    [
        'id' => 4,
        'title' => 'The Woman in the Forest',
        'minutes' => 15,
        'mood' => 'mystery',
        'energy' => 'low',
        'theme' => 'The wildness deepens and the tale pauses for one of its most haunting encounters.',
        'badge' => 'Forest',
    ],
    [
        'id' => 5,
        'title' => 'Ethandune: The First Shock',
        'minutes' => 15,
        'mood' => 'battle',
        'energy' => 'high',
        'theme' => 'Momentum turns sharp: banners lift, horses thunder, and the poem leans into impact.',
        'badge' => 'Drum',
    ],
    [
        'id' => 6,
        'title' => 'Ethandune: The Slaying',
        'minutes' => 15,
        'mood' => 'battle',
        'energy' => 'high',
        'theme' => 'The cost of courage lands hard. It is glorious and a little grave, as real battles tend to be.',
        'badge' => 'Blade',
    ],
    [
        'id' => 7,
        'title' => 'The Last Charge',
        'minutes' => 15,
        'mood' => 'courage',
        'energy' => 'high',
        'theme' => 'The story spends its final reserves and asks whether hope can still outrun fear.',
        'badge' => 'Charge',
    ],
    [
        'id' => 8,
        'title' => 'The Scouring of the Horse',
        'minutes' => 15,
        'mood' => 'renewal',
        'energy' => 'medium',
        'theme' => 'After noise and strain comes the work of cleaning, restoring, and keeping memory alive.',
        'badge' => 'White Horse',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>White Horse Quest</title>
    <style>
        :root {
            --ink: #201814;
            --ink-soft: #5c4638;
            --parchment: #efe1be;
            --parchment-deep: #dfc791;
            --gold: #d0a93e;
            --gold-pale: #f5dd88;
            --carmine: #972b2a;
            --night: #233449;
            --moss: #586744;
            --cream: #fbf3df;
            --shadow: rgba(32, 24, 20, 0.18);
            --selected: rgba(151, 43, 42, 0.12);
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
            font-family: "Trebuchet MS", "Gill Sans", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(245, 221, 136, 0.22), transparent 24rem),
                radial-gradient(circle at bottom right, rgba(151, 43, 42, 0.16), transparent 20rem),
                linear-gradient(180deg, #5d4738 0%, #32261f 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.15;
            background-image:
                linear-gradient(rgba(255,255,255,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.06) 1px, transparent 1px);
            background-size: 24px 24px;
            mix-blend-mode: soft-light;
        }

        a {
            color: inherit;
        }

        .page {
            width: min(1140px, calc(100% - 28px));
            margin: 22px auto;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0)),
                var(--cream);
            border: 2px solid rgba(72, 47, 25, 0.72);
            border-radius: 28px;
            box-shadow:
                0 24px 80px rgba(0, 0, 0, 0.32),
                inset 0 0 0 3px rgba(247, 231, 185, 0.6);
            overflow: hidden;
            position: relative;
        }

        .page::before,
        .page::after {
            content: "";
            position: absolute;
            inset: 14px;
            border: 1px solid rgba(151, 43, 42, 0.18);
            border-radius: 22px;
            pointer-events: none;
        }

        .page::after {
            inset: 28px;
            border-color: rgba(35, 52, 73, 0.12);
        }

        .hero {
            position: relative;
            padding: 56px 28px 34px;
            background:
                radial-gradient(circle at top center, rgba(255,255,255,0.55), transparent 18rem),
                linear-gradient(180deg, rgba(208, 169, 62, 0.24), rgba(208, 169, 62, 0) 28%),
                linear-gradient(135deg, rgba(35, 52, 73, 0.96), rgba(151, 43, 42, 0.92));
            color: var(--cream);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(245, 221, 136, 0.28), transparent 14rem),
                radial-gradient(circle at 80% 15%, rgba(255,255,255,0.12), transparent 16rem);
            pointer-events: none;
        }

        .hero-grid {
            position: relative;
            display: grid;
            grid-template-columns: 1.2fr 0.9fr;
            gap: 24px;
            align-items: center;
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 0.78rem;
            opacity: 0.8;
            margin-bottom: 14px;
        }

        h1,
        h2,
        h3 {
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            margin: 0;
            letter-spacing: 0.01em;
        }

        h1 {
            font-size: clamp(2.8rem, 7vw, 5rem);
            line-height: 0.92;
            text-wrap: balance;
            text-shadow: 0 2px 18px rgba(0, 0, 0, 0.25);
        }

        .hero p {
            max-width: 42rem;
            font-size: 1.05rem;
            line-height: 1.7;
            margin: 16px 0 0;
            color: rgba(251, 243, 223, 0.92);
        }

        .hero-links {
            margin-top: 22px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            background: rgba(251, 243, 223, 0.12);
            border: 1px solid rgba(251, 243, 223, 0.28);
            color: var(--cream);
            padding: 11px 14px;
            border-radius: 999px;
            backdrop-filter: blur(4px);
            transition: transform 180ms ease, background 180ms ease;
        }

        .hero-link:hover,
        .hero-link:focus-visible {
            transform: translateY(-2px);
            background: rgba(251, 243, 223, 0.2);
        }

        .horse-panel {
            justify-self: end;
            width: min(100%, 380px);
            padding: 18px;
            border-radius: 24px;
            background:
                linear-gradient(180deg, rgba(251,243,223,0.16), rgba(251,243,223,0.04)),
                rgba(11, 17, 25, 0.24);
            border: 1px solid rgba(251,243,223,0.28);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
        }

        .horse-panel svg {
            display: block;
            width: 100%;
            height: auto;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 14px;
        }

        .stat {
            border-radius: 16px;
            padding: 12px;
            background: rgba(251, 243, 223, 0.1);
            border: 1px solid rgba(251,243,223,0.18);
        }

        .stat-label {
            display: block;
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            opacity: 0.76;
        }

        .stat strong {
            display: block;
            margin-top: 5px;
            font-size: 1.05rem;
        }

        main {
            padding: 28px;
        }

        .intro-band {
            display: grid;
            grid-template-columns: 1fr 0.8fr;
            gap: 18px;
            margin-top: -16px;
        }

        .intro-card,
        .forge,
        .planner,
        .route,
        .summary {
            background: linear-gradient(180deg, rgba(255,255,255,0.52), rgba(255,255,255,0.2));
            border: 1px solid rgba(76, 51, 33, 0.18);
            border-radius: 24px;
            box-shadow: 0 18px 34px rgba(86, 67, 49, 0.08);
        }

        .intro-card {
            padding: 22px 22px 18px;
        }

        .intro-card p {
            margin: 12px 0 0;
            color: var(--ink-soft);
            line-height: 1.7;
        }

        .controls {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        label {
            display: flex;
            flex-direction: column;
            gap: 8px;
            font-size: 0.88rem;
            color: var(--ink-soft);
        }

        select,
        button {
            font: inherit;
        }

        select {
            appearance: none;
            border: 1px solid rgba(76, 51, 33, 0.22);
            border-radius: 14px;
            background: rgba(255,255,255,0.72);
            color: var(--ink);
            padding: 12px 14px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
        }

        .summary {
            padding: 22px;
        }

        .summary p {
            margin: 10px 0 0;
            color: var(--ink-soft);
            line-height: 1.65;
        }

        .route {
            margin-top: 22px;
            padding: 18px;
        }

        .route-header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 14px;
        }

        .route-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .canto {
            position: relative;
            border-radius: 22px;
            padding: 16px;
            min-height: 200px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.68), rgba(236, 223, 192, 0.84));
            border: 1px solid rgba(76, 51, 33, 0.18);
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .canto:hover,
        .canto:focus-visible {
            transform: translateY(-4px);
            box-shadow: 0 16px 26px rgba(50, 37, 28, 0.12);
        }

        .canto.selected {
            background:
                linear-gradient(180deg, rgba(255,248,229,0.94), rgba(246, 229, 183, 0.96));
            border-color: rgba(151, 43, 42, 0.42);
            box-shadow: 0 18px 34px rgba(151, 43, 42, 0.14);
        }

        .canto.recommended::after {
            content: "Route";
            position: absolute;
            top: 14px;
            right: 14px;
            background: var(--carmine);
            color: var(--cream);
            border-radius: 999px;
            padding: 4px 8px;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .canto-number {
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: 0.84rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--carmine);
        }

        .canto h3 {
            font-size: 1.36rem;
            margin-top: 8px;
        }

        .canto .meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(35, 52, 73, 0.08);
            font-size: 0.78rem;
            color: var(--ink-soft);
        }

        .canto p {
            margin: 12px 0 0;
            font-size: 0.93rem;
            line-height: 1.55;
            color: var(--ink-soft);
        }

        .lower-grid {
            display: grid;
            grid-template-columns: 1fr 0.95fr;
            gap: 18px;
            margin-top: 22px;
        }

        .forge,
        .planner {
            padding: 22px;
        }

        .forge-controls,
        .planner-controls {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 18px;
        }

        .banner-wrap {
            margin-top: 18px;
            border-radius: 24px;
            background: radial-gradient(circle at top, rgba(255,255,255,0.78), rgba(255,255,255,0.38));
            padding: 14px;
            border: 1px solid rgba(76, 51, 33, 0.18);
        }

        .banner-svg {
            width: 100%;
            height: auto;
            display: block;
        }

        .banner-words,
        .planner-output {
            margin-top: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(255,255,255,0.52);
            color: var(--ink-soft);
            line-height: 1.6;
        }

        .banner-words strong,
        .planner-output strong {
            color: var(--ink);
        }

        .drumline {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 18px;
        }

        .beat {
            border: 0;
            border-radius: 16px;
            padding: 14px 16px;
            min-width: 110px;
            color: var(--cream);
            background: linear-gradient(180deg, #2a425f, #1d2f45);
            box-shadow: 0 10px 18px rgba(29, 47, 69, 0.22);
            transition: transform 140ms ease, filter 140ms ease;
            cursor: pointer;
        }

        .beat:hover,
        .beat:focus-visible {
            transform: translateY(-2px) scale(1.02);
            filter: brightness(1.04);
        }

        .beat.active {
            background: linear-gradient(180deg, #b33b39, #7d2322);
        }

        .footer-note {
            margin: 26px 0 4px;
            padding: 16px 18px 0;
            color: var(--ink-soft);
            font-size: 0.92rem;
            line-height: 1.65;
        }

        .footer-note a {
            color: var(--carmine);
        }

        @media (max-width: 980px) {
            .hero-grid,
            .intro-band,
            .lower-grid {
                grid-template-columns: 1fr;
            }

            .horse-panel {
                justify-self: stretch;
                width: 100%;
            }

            .route-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100%, calc(100% - 16px));
                margin: 8px auto;
                border-radius: 18px;
            }

            .hero,
            main {
                padding-left: 18px;
                padding-right: 18px;
            }

            .controls,
            .forge-controls,
            .planner-controls {
                grid-template-columns: 1fr;
            }

            .route-grid {
                grid-template-columns: 1fr;
            }

            .hero-stats {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 2.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <header class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Chloe Reads Jon • Listening Quest</div>
                    <h1>White Horse Quest</h1>
                    <p>
                        A gleaming little listening war-room for Chesterton's <em>Ballad of the White Horse</em>:
                        choose your mood, assemble a route through the eight audio episodes, and forge a heraldic
                        banner for the courage you want to carry into the day.
                    </p>
                    <div class="hero-links">
                        <a class="hero-link" href="#route">Plot a route</a>
                        <a class="hero-link" href="#forge">Forge a banner</a>
                        <a class="hero-link" href="<?= htmlspecialchars($postUrl, ENT_QUOTES) ?>">Inspired by Jon's <?= htmlspecialchars($postTitle, ENT_QUOTES) ?></a>
                    </div>
                </div>
                <div class="horse-panel" aria-hidden="true">
                    <svg viewBox="0 0 360 310" role="img">
                        <defs>
                            <linearGradient id="horseSky" x1="0" x2="1">
                                <stop offset="0%" stop-color="#f6db88"/>
                                <stop offset="100%" stop-color="#d66d52"/>
                            </linearGradient>
                        </defs>
                        <rect x="0" y="0" width="360" height="310" rx="22" fill="rgba(245,243,223,0.08)"/>
                        <path d="M44 230 C 82 175, 126 153, 173 144 S 256 123, 303 82" fill="none" stroke="url(#horseSky)" stroke-width="18" stroke-linecap="round"/>
                        <path d="M47 231 C 87 208, 108 217, 131 238" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>
                        <path d="M136 237 C 165 210, 170 188, 166 165" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>
                        <path d="M165 165 C 184 154, 204 160, 213 176" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>
                        <path d="M213 176 C 228 159, 247 147, 275 132" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>
                        <circle cx="92" cy="96" r="54" fill="rgba(251,243,223,0.08)" stroke="rgba(251,243,223,0.25)"/>
                        <path d="M88 70 l12 19 21 4 -16 14 2 21 -19 -10 -19 10 4 -22 -17 -13 21 -3 z" fill="#f5dd88"/>
                        <path d="M243 47 l14 21 24 5 -18 15 4 24 -20 -11 -21 11 5 -24 -18 -15 24 -5 z" fill="#f5dd88" opacity="0.7"/>
                        <rect x="223" y="191" width="79" height="54" rx="12" fill="rgba(151,43,42,0.72)" stroke="#f5dd88"/>
                        <path d="M262 191 v54" stroke="#f5dd88" stroke-width="3"/>
                        <path d="M223 218 h79" stroke="#f5dd88" stroke-width="3"/>
                        <circle cx="242" cy="206" r="7" fill="#f7f0d9"/>
                        <path d="M274 202 l5 10 12 2 -9 7 2 11 -10 -6 -10 6 2 -11 -9 -7 12 -2 z" fill="#f7f0d9"/>
                    </svg>
                    <div class="hero-stats">
                        <div class="stat">
                            <span class="stat-label">Audio Path</span>
                            <strong>8 cantos</strong>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Quest Time</span>
                            <strong>15-120 min</strong>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Reward</span>
                            <strong>Banner + plan</strong>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="intro-band">
                <div class="intro-card">
                    <h2>Choose the sort of heroic nonsense you need today</h2>
                    <p>
                        Maybe you want mystery, maybe you want galloping drums, maybe you just want fifteen minutes of
                        old poetry to make your brain feel less like a spilled box of paperclips. Pick a mood, a time
                        budget, and a pace. The route picker will recommend a path, but you can override it like a proper
                        stubborn king.
                    </p>
                    <div class="controls">
                        <label>
                            Time available
                            <select id="timeBudget">
                                <option value="15">15 minutes</option>
                                <option value="30" selected>30 minutes</option>
                                <option value="45">45 minutes</option>
                                <option value="60">60 minutes</option>
                                <option value="120">All 120 minutes</option>
                            </select>
                        </label>
                        <label>
                            Desired mood
                            <select id="desiredMood">
                                <option value="wonder">Wonder</option>
                                <option value="battle">Battle heat</option>
                                <option value="renewal">Renewal</option>
                                <option value="mystery">Mystery</option>
                                <option value="adventure">Adventure</option>
                                <option value="strategy">Strategy</option>
                                <option value="courage">Courage</option>
                            </select>
                        </label>
                        <label>
                            Listening pace
                            <select id="paceMode">
                                <option value="balanced">Balanced arc</option>
                                <option value="frontloaded">Hook me fast</option>
                                <option value="gentle">Quiet first</option>
                            </select>
                        </label>
                    </div>
                </div>

                <aside class="summary">
                    <h2>Your route parchment</h2>
                    <div id="routeSummary">
                        <p><strong>Selected cantos:</strong> 2</p>
                        <p><strong>Travel plan:</strong> The route leans toward wonder and strategy, which is a lovely way to say “less shouting, more atmosphere.”</p>
                        <p><strong>Why this works:</strong> You get a clean introduction, a council scene, and enough narrative bite to decide whether you want the full campaign later.</p>
                    </div>
                </aside>
            </section>

            <section class="route" id="route">
                <div class="route-header">
                    <div>
                        <h2>The eight-canto campaign map</h2>
                        <p style="margin:8px 0 0;color:var(--ink-soft);line-height:1.6;">Tap cards to add or remove them from your route. Recommended cards glow a little because subtlety is apparently not our military doctrine.</p>
                    </div>
                </div>
                <div class="route-grid">
                    <?php foreach ($cantos as $canto): ?>
                        <article
                            class="canto"
                            tabindex="0"
                            data-id="<?= $canto['id'] ?>"
                            data-minutes="<?= $canto['minutes'] ?>"
                            data-mood="<?= htmlspecialchars($canto['mood'], ENT_QUOTES) ?>"
                            data-energy="<?= htmlspecialchars($canto['energy'], ENT_QUOTES) ?>"
                        >
                            <div class="canto-number">Canto <?= $canto['id'] ?></div>
                            <h3><?= htmlspecialchars($canto['title'], ENT_QUOTES) ?></h3>
                            <div class="meta">
                                <span class="pill"><?= htmlspecialchars($canto['badge'], ENT_QUOTES) ?></span>
                                <span class="pill"><?= $canto['minutes'] ?> min</span>
                                <span class="pill"><?= ucfirst($canto['mood']) ?></span>
                            </div>
                            <p><?= htmlspecialchars($canto['theme'], ENT_QUOTES) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

            <div class="lower-grid">
                <section class="forge" id="forge">
                    <h2>Heraldic Banner Forge</h2>
                    <p style="margin:10px 0 0;color:var(--ink-soft);line-height:1.65;">
                        Pick the sort of banner this listening session should earn you. The page will mint a motto,
                        shift the heraldic colors, and redraw the standard live.
                    </p>
                    <div class="forge-controls">
                        <label>
                            Virtue to carry
                            <select id="virtueSelect">
                                <option value="hope">Hope</option>
                                <option value="courage">Courage</option>
                                <option value="mercy">Mercy</option>
                                <option value="steadiness">Steadiness</option>
                            </select>
                        </label>
                        <label>
                            Companion mode
                            <select id="companionSelect">
                                <option value="solo">Solo watchman</option>
                                <option value="jon">Jon mode</option>
                                <option value="nathan">Nathan mode</option>
                                <option value="family">Family hearth</option>
                            </select>
                        </label>
                        <label>
                            Weather of the tale
                            <select id="weatherSelect">
                                <option value="dawn">Dawn gold</option>
                                <option value="storm">Storm blue</option>
                                <option value="ember">Ember red</option>
                                <option value="meadow">Meadow green</option>
                            </select>
                        </label>
                        <label>
                            Standard symbol
                            <select id="symbolSelect">
                                <option value="horse">White horse</option>
                                <option value="star">Star</option>
                                <option value="cross">Cross</option>
                                <option value="shield">Shield</option>
                            </select>
                        </label>
                    </div>
                    <div class="banner-wrap">
                        <svg class="banner-svg" id="bannerSvg" viewBox="0 0 560 320" aria-labelledby="bannerTitle bannerDesc" role="img">
                            <title id="bannerTitle">Custom heraldic banner</title>
                            <desc id="bannerDesc">A shield-shaped banner that changes based on the controls below.</desc>
                            <rect x="0" y="0" width="560" height="320" rx="26" fill="#e7d3a4"/>
                            <path d="M280 32 L412 72 L392 204 C388 249 346 284 280 298 C214 284 172 249 168 204 L148 72 Z" fill="#972b2a" stroke="#f5dd88" stroke-width="8"/>
                            <path id="bannerAccent" d="M280 32 L412 72 L280 152 L148 72 Z" fill="#233449" opacity="0.86"/>
                            <g id="bannerSymbol" fill="#f7f0d9">
                                <path d="M240 176 C255 153, 274 146, 296 142 C315 138, 328 125, 342 106" fill="none" stroke="#f7f0d9" stroke-width="14" stroke-linecap="round"/>
                                <path d="M242 177 C259 169, 271 173, 280 185" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>
                                <path d="M281 185 C292 172, 294 160, 292 149" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>
                            </g>
                            <text id="bannerMottoTop" x="280" y="240" text-anchor="middle" font-family="Palatino Linotype, Book Antiqua, Georgia, serif" font-size="26" fill="#f7f0d9">Hold the light</text>
                            <text id="bannerMottoBottom" x="280" y="270" text-anchor="middle" font-family="Trebuchet MS, sans-serif" font-size="16" fill="#f5dd88" letter-spacing="3">QUEST STANDARD</text>
                        </svg>
                    </div>
                    <div class="banner-words" id="bannerWords">
                        <strong>Motto:</strong> Hold the light.<br>
                        <strong>Banner reading:</strong> A calm standard for a thoughtful listening session: enough pageantry to feel alive, not so much that the household thinks you have founded a small kingdom.
                    </div>
                </section>

                <section class="planner">
                    <h2>War Drum Planner</h2>
                    <p style="margin:10px 0 0;color:var(--ink-soft);line-height:1.65;">
                        Stack the beats you want around the audio. The planner turns them into a little ritual:
                        before, during, after. Great for Jon. Also great for Nathan if you present it as a quest,
                        which to be fair is exactly what I am doing.
                    </p>
                    <div class="drumline" id="drumline">
                        <button class="beat active" type="button" data-beat="tea">Tea</button>
                        <button class="beat" type="button" data-beat="walk">Walk</button>
                        <button class="beat active" type="button" data-beat="notes">Notes</button>
                        <button class="beat" type="button" data-beat="drawing">Sketch</button>
                        <button class="beat" type="button" data-beat="prayer">Prayer</button>
                        <button class="beat" type="button" data-beat="retell">Retell</button>
                    </div>
                    <div class="planner-output" id="plannerOutput">
                        <strong>Suggested cadence:</strong> Brew something warm, listen to the chosen cantos, and jot one line that sounded older and wiser than your current anxiety. That is enough noble discipline for one afternoon.
                    </div>
                </section>
            </div>

            <p class="footer-note">
                Inspired by Jon's <a href="<?= htmlspecialchars($postUrl, ENT_QUOTES) ?>"><?= htmlspecialchars($postTitle, ENT_QUOTES) ?></a>,
                where he pointed to a clearly read eight-part audio version of Chesterton's poem. This page does not try
                to out-Chesterton Chesterton. It just gives the listening a bit of ceremony and play.
            </p>
        </main>
    </div>

    <script>
        const cantoData = <?= json_encode($cantos, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const cards = [...document.querySelectorAll('.canto')];
        const routeSummary = document.getElementById('routeSummary');
        const timeBudget = document.getElementById('timeBudget');
        const desiredMood = document.getElementById('desiredMood');
        const paceMode = document.getElementById('paceMode');
        const beatButtons = [...document.querySelectorAll('.beat')];
        const plannerOutput = document.getElementById('plannerOutput');

        const selected = new Set([1, 2]);

        function recommendRoute() {
            const budget = Number(timeBudget.value);
            const mood = desiredMood.value;
            const pace = paceMode.value;
            const sorted = [...cantoData].sort((a, b) => {
                let scoreA = (a.mood === mood ? 3 : 0);
                let scoreB = (b.mood === mood ? 3 : 0);

                if (pace === 'frontloaded') {
                    scoreA += Math.max(0, 9 - a.id) * 0.12;
                    scoreB += Math.max(0, 9 - b.id) * 0.12;
                } else if (pace === 'gentle') {
                    scoreA += (a.energy === 'low' ? 1.5 : a.energy === 'medium' ? 0.6 : 0);
                    scoreB += (b.energy === 'low' ? 1.5 : b.energy === 'medium' ? 0.6 : 0);
                } else {
                    scoreA += (a.id <= 4 ? 0.8 : 0.5);
                    scoreB += (b.id <= 4 ? 0.8 : 0.5);
                }

                if (scoreA !== scoreB) {
                    return scoreB - scoreA;
                }
                return a.id - b.id;
            });

            let total = 0;
            const picks = [];
            for (const canto of sorted) {
                if (total + canto.minutes <= budget) {
                    picks.push(canto.id);
                    total += canto.minutes;
                }
            }

            if (picks.length === 0) {
                picks.push(sorted[0].id);
            }

            selected.clear();
            picks.sort((a, b) => a - b).forEach((id) => selected.add(id));
            renderRoute(picks);
        }

        function renderRoute(recommended = [...selected]) {
            const sortedSelected = cantoData.filter((c) => selected.has(c.id));
            cards.forEach((card) => {
                const id = Number(card.dataset.id);
                card.classList.toggle('selected', selected.has(id));
                card.classList.toggle('recommended', recommended.includes(id));
                card.setAttribute('aria-pressed', selected.has(id) ? 'true' : 'false');
            });

            const totalMinutes = sortedSelected.reduce((sum, canto) => sum + canto.minutes, 0);
            const moods = [...new Set(sortedSelected.map((canto) => canto.mood))];
            const titles = sortedSelected.map((canto) => canto.title).join(', ');

            let travelPlan = 'A balanced route with enough pageantry to feel alive.';
            if (moods.includes('battle')) {
                travelPlan = 'This route leans toward impact and iron: excellent if you want drums, banners, and a bit of holy stubbornness.';
            } else if (moods.includes('mystery')) {
                travelPlan = 'This route keeps things hushed and uncanny, more moonlit forest than charging horse.';
            } else if (moods.includes('renewal')) {
                travelPlan = 'This route bends toward recovery, which is useful if your soul currently resembles a dropped filing cabinet.';
            }

            const whyWorks = sortedSelected.length >= 4
                ? 'You get a proper arc: setup, strain, and a satisfying finish instead of just nibbling one bright corner.'
                : 'You get a strong taste of the poem without demanding a full-scale campaign from your afternoon.';

            routeSummary.innerHTML = `
                <p><strong>Selected cantos:</strong> ${sortedSelected.length} (${totalMinutes} minutes)</p>
                <p><strong>Travel plan:</strong> ${travelPlan}</p>
                <p><strong>Path:</strong> ${titles || 'Choose at least one canto.'}</p>
                <p><strong>Why this works:</strong> ${whyWorks}</p>
            `;

            renderPlanner();
        }

        function toggleCard(id) {
            if (selected.has(id) && selected.size > 1) {
                selected.delete(id);
            } else {
                selected.add(id);
            }
            renderRoute([]);
        }

        cards.forEach((card) => {
            const id = Number(card.dataset.id);
            card.addEventListener('click', () => toggleCard(id));
            card.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    toggleCard(id);
                }
            });
        });

        [timeBudget, desiredMood, paceMode].forEach((input) => {
            input.addEventListener('change', recommendRoute);
        });

        const virtueSelect = document.getElementById('virtueSelect');
        const companionSelect = document.getElementById('companionSelect');
        const weatherSelect = document.getElementById('weatherSelect');
        const symbolSelect = document.getElementById('symbolSelect');
        const bannerAccent = document.getElementById('bannerAccent');
        const bannerSymbol = document.getElementById('bannerSymbol');
        const bannerMottoTop = document.getElementById('bannerMottoTop');
        const bannerMottoBottom = document.getElementById('bannerMottoBottom');
        const bannerWords = document.getElementById('bannerWords');

        const palettes = {
            dawn: { shield: '#972b2a', accent: '#233449', text: '#f7f0d9', sub: '#f5dd88' },
            storm: { shield: '#2f4668', accent: '#c9a54f', text: '#f7f0d9', sub: '#f5dd88' },
            ember: { shield: '#7d2322', accent: '#e0b65a', text: '#fff7e4', sub: '#f7d67b' },
            meadow: { shield: '#587045', accent: '#f2d376', text: '#fff7e4', sub: '#f0d889' },
        };

        const symbolPaths = {
            horse: '<path d="M240 176 C255 153, 274 146, 296 142 C315 138, 328 125, 342 106" fill="none" stroke="#f7f0d9" stroke-width="14" stroke-linecap="round"/><path d="M242 177 C259 169, 271 173, 280 185" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/><path d="M281 185 C292 172, 294 160, 292 149" fill="none" stroke="#f7f0d9" stroke-width="8" stroke-linecap="round"/>',
            star: '<path d="M280 120 l18 36 40 6 -29 28 7 40 -36 -19 -36 19 7 -40 -29 -28 40 -6 z" fill="#f7f0d9"/>',
            cross: '<path d="M264 106 h32 v52 h52 v32 h-52 v52 h-32 v-52 h-52 v-32 h52 z" fill="#f7f0d9"/>',
            shield: '<path d="M280 110 l56 18 -8 62 c-3 28 -20 45 -48 57 -28 -12 -45 -29 -48 -57 l-8 -62 z" fill="#f7f0d9"/>',
        };

        function renderBanner() {
            const virtue = virtueSelect.value;
            const companion = companionSelect.value;
            const weather = weatherSelect.value;
            const symbol = symbolSelect.value;
            const palette = palettes[weather];

            document.querySelector('#bannerSvg path:nth-of-type(1)').setAttribute('fill', palette.shield);
            bannerAccent.setAttribute('fill', palette.accent);
            bannerSymbol.innerHTML = symbolPaths[symbol];
            bannerSymbol.querySelectorAll('*').forEach((node) => {
                if (node.hasAttribute('stroke')) node.setAttribute('stroke', palette.text);
                if (node.hasAttribute('fill')) node.setAttribute('fill', palette.text);
            });
            bannerMottoTop.setAttribute('fill', palette.text);
            bannerMottoBottom.setAttribute('fill', palette.sub);

            const topMap = {
                hope: 'Keep the dawn',
                courage: 'Ride at need',
                mercy: 'Spare and stand',
                steadiness: 'Hold the line',
            };
            const bottomMap = {
                solo: 'SOLO WATCH',
                jon: 'JON MODE',
                nathan: 'NATHAN QUEST',
                family: 'HEARTH COMPANY',
            };
            const readingMap = {
                hope: 'You are building a bright, forward-facing standard.',
                courage: 'You are asking the story for backbone, not merely atmosphere.',
                mercy: 'This one makes the banner gentler without turning it into wallpaper.',
                steadiness: 'A good choice when the day needs ballast more than fireworks.',
            };

            bannerMottoTop.textContent = topMap[virtue];
            bannerMottoBottom.textContent = bottomMap[companion];
            bannerWords.innerHTML = `
                <strong>Motto:</strong> ${topMap[virtue]}.<br>
                <strong>Banner reading:</strong> ${readingMap[virtue]} ${companion === 'nathan' ? 'There is also a high probability this becomes a family reenactment, which frankly sounds fun.' : companion === 'family' ? 'It feels communal, sturdy, and pleasantly ceremonial.' : companion === 'jon' ? 'Quietly heroic, which feels on-brand.' : 'Solitary in the best way: reflective, not gloomy.'}
            `;
        }

        function renderPlanner() {
            const chosenBeats = beatButtons.filter((button) => button.classList.contains('active')).map((button) => button.dataset.beat);
            const totalMinutes = cantoData.filter((c) => selected.has(c.id)).reduce((sum, canto) => sum + canto.minutes, 0);
            const beatPhrases = {
                tea: 'brew something warm first',
                walk: 'take a short walk before pressing play',
                notes: 'keep one line of notes',
                drawing: 'sketch the banner or horse afterward',
                prayer: 'end with a short prayer',
                retell: 'retell the best part to whoever is nearby',
            };

            const steps = chosenBeats.map((beat) => beatPhrases[beat]);
            const sentence = steps.length
                ? steps.slice(0, -1).join(', ') + (steps.length > 1 ? ', and ' : '') + steps.slice(-1)
                : 'simply listen and let the poem do the heavy lifting';

            plannerOutput.innerHTML = `
                <strong>Suggested cadence:</strong> For this ${totalMinutes}-minute route, ${sentence}.<br>
                <strong>Why it helps:</strong> The poem stays ceremonial instead of becoming background mush, which is a tragic fate for anything involving kings, banners, and destiny.
            `;
        }

        beatButtons.forEach((button) => {
            button.addEventListener('click', () => {
                button.classList.toggle('active');
                renderPlanner();
            });
        });

        [virtueSelect, companionSelect, weatherSelect, symbolSelect].forEach((input) => {
            input.addEventListener('change', renderBanner);
        });

        recommendRoute();
        renderBanner();
    </script>
</body>
</html>
