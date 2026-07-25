<?php
declare(strict_types=1);
$buildDate = '2026-07-25';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#d8e0d8">
    <title>Fridge Door Food Guide</title>
    <style>
        :root {
            --fridge: #dbe2dc;
            --fridge-dark: #b7c2b9;
            --ink: #20302c;
            --paper: #fffaf0;
            --red: #e64a38;
            --red-dark: #9f2f25;
            --green: #188f66;
            --green-dark: #0b6446;
            --blue: #2e70b6;
            --blue-dark: #1e4d80;
            --gold: #e6aa25;
            --gold-dark: #9a6c0a;
            --shadow: 0 12px 30px rgba(31, 53, 45, .18);
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 20%, rgba(255,255,255,.8) 0 2px, transparent 3px),
                linear-gradient(105deg, transparent 0 49%, rgba(67,90,81,.05) 50%, transparent 51%),
                var(--fridge);
            background-size: 43px 47px, 170px 170px, auto;
            font-family: "Avenir Next Rounded", "Trebuchet MS", sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .18;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.82' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.18'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
            z-index: 20;
        }

        button, a { -webkit-tap-highlight-color: transparent; }
        button { font: inherit; }

        .door {
            width: min(1180px, calc(100% - 28px));
            margin: 14px auto 50px;
            border: 1px solid rgba(55,74,65,.25);
            border-radius: 34px;
            background:
                linear-gradient(90deg, rgba(255,255,255,.54), transparent 12%, transparent 88%, rgba(52,67,60,.08)),
                linear-gradient(180deg, #eaf0eb, #d2dbd4);
            box-shadow:
                0 30px 80px rgba(25,42,36,.25),
                inset 0 1px 0 white,
                inset 0 -8px 20px rgba(47,66,57,.08);
            min-height: calc(100vh - 64px);
            position: relative;
            padding: clamp(18px, 4vw, 54px);
        }

        .handle {
            position: absolute;
            top: 92px;
            right: -9px;
            width: 23px;
            height: 300px;
            border-radius: 14px;
            background: linear-gradient(90deg, #78857c, #e9eee9 42%, #8d9a91);
            box-shadow: 5px 7px 13px rgba(21,31,27,.28);
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 28px;
            position: relative;
            z-index: 1;
        }

        .brand {
            position: relative;
            max-width: 700px;
        }

        .eyebrow {
            display: inline-block;
            transform: rotate(-1.5deg);
            background: var(--red);
            color: white;
            padding: 7px 11px 5px;
            letter-spacing: .12em;
            text-transform: uppercase;
            font-weight: 900;
            font-size: .72rem;
            box-shadow: 3px 4px 0 var(--red-dark);
        }

        h1 {
            margin: 15px 0 7px;
            font-family: "Cooper Black", "Bookman Old Style", Georgia, serif;
            font-size: clamp(2.6rem, 7vw, 6.2rem);
            line-height: .82;
            letter-spacing: -.065em;
            color: #173d32;
            text-shadow: 0 2px 0 #fff;
            max-width: 780px;
        }

        .subtitle {
            max-width: 630px;
            margin: 18px 0 0;
            font-family: Georgia, serif;
            font-size: clamp(1.02rem, 2vw, 1.3rem);
            line-height: 1.48;
        }

        .year-magnet {
            min-width: 132px;
            aspect-ratio: 1;
            border: 8px solid #fffdf5;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: var(--shadow), inset 0 0 0 3px rgba(32,48,44,.15);
            transform: rotate(5deg);
            display: grid;
            place-content: center;
            text-align: center;
            font-weight: 900;
            line-height: 1;
        }

        .year-magnet strong {
            font-family: "Cooper Black", Georgia, serif;
            font-size: 2rem;
        }

        .year-magnet small {
            margin-top: 4px;
            font-size: .69rem;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .intro-strip {
            margin: 32px 0 26px;
            display: grid;
            grid-template-columns: 1.3fr .7fr;
            gap: 18px;
            align-items: stretch;
        }

        .note {
            background:
                repeating-linear-gradient(0deg, transparent 0 27px, rgba(40,103,173,.13) 28px 29px),
                var(--paper);
            box-shadow: var(--shadow);
            padding: 24px 28px;
            position: relative;
            transform: rotate(-.4deg);
            border: 1px solid rgba(89,68,32,.18);
        }

        .note::before, .note::after {
            content: "";
            position: absolute;
            top: -9px;
            width: 54px;
            height: 24px;
            background: rgba(243,225,165,.72);
            box-shadow: 0 1px 1px rgba(40,30,10,.12);
        }

        .note::before { left: 14%; transform: rotate(-5deg); }
        .note::after { right: 12%; transform: rotate(4deg); }

        .note p {
            margin: 0;
            font-family: "Segoe Print", "Bradley Hand", cursive;
            line-height: 1.65;
            font-size: 1rem;
        }

        .note strong { color: var(--red-dark); }

        .mission {
            background: #20483d;
            color: #f8f1da;
            padding: 22px 24px;
            box-shadow: 6px 7px 0 #132f28;
            transform: rotate(.7deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .mission span {
            text-transform: uppercase;
            letter-spacing: .14em;
            font-size: .7rem;
            opacity: .74;
            font-weight: 900;
        }

        .mission strong {
            display: block;
            margin-top: 8px;
            font-family: Georgia, serif;
            font-size: 1.2rem;
            line-height: 1.4;
        }

        .workspace {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(310px, .9fr);
            gap: clamp(20px, 3vw, 38px);
            align-items: start;
        }

        .panel-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin: 0 0 13px;
        }

        .panel-title h2 {
            font-family: "Cooper Black", "Bookman Old Style", Georgia, serif;
            letter-spacing: -.025em;
            font-size: clamp(1.5rem, 3vw, 2rem);
            margin: 0;
        }

        .panel-title small {
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #5d6c66;
        }

        .pantry {
            background: rgba(252,254,250,.38);
            border: 2px dashed rgba(35,62,52,.24);
            border-radius: 22px;
            padding: 18px;
        }

        .filter-row {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 17px;
        }

        .filter {
            border: 0;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(255,255,255,.75);
            color: var(--ink);
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 2px 0 rgba(27,47,39,.15);
            transition: transform .15s, background .15s;
        }

        .filter:hover, .filter:focus-visible { transform: translateY(-2px); }
        .filter.active { background: var(--ink); color: white; }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(90px, 1fr));
            gap: 13px;
        }

        .food {
            min-height: 112px;
            border: 0;
            border-radius: 17px;
            padding: 13px 8px 11px;
            color: #17342d;
            cursor: pointer;
            position: relative;
            box-shadow:
                0 5px 0 rgba(28,50,42,.23),
                0 9px 15px rgba(38,59,51,.1);
            transition: transform .16s ease, box-shadow .16s ease;
            animation: settle .45s both;
        }

        .food:nth-child(3n+1) { transform: rotate(-1.2deg); }
        .food:nth-child(3n+2) { transform: rotate(.8deg); }
        .food:nth-child(3n) { transform: rotate(-.4deg); }
        .food:hover, .food:focus-visible {
            transform: translateY(-5px) rotate(0);
            box-shadow: 0 8px 0 rgba(28,50,42,.23), 0 14px 20px rgba(38,59,51,.15);
            outline: 3px solid white;
        }

        .food.pop { animation: pop .35s ease; }
        .food[data-group="veg"] { background: #f1a497; }
        .food[data-group="grain"] { background: #f4d376; }
        .food[data-group="milk"] { background: #9ac7ed; }
        .food[data-group="protein"] { background: #8dd0b7; }

        .food .emoji {
            display: block;
            font-size: 2.25rem;
            line-height: 1;
            filter: drop-shadow(0 2px 0 rgba(255,255,255,.7));
        }

        .food .name {
            display: block;
            margin-top: 8px;
            font-size: .78rem;
            font-weight: 900;
            line-height: 1.05;
        }

        .food .plus {
            position: absolute;
            right: 7px;
            top: 7px;
            display: grid;
            place-items: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(255,255,255,.8);
            font-size: .9rem;
            font-weight: 900;
        }

        .board {
            background: var(--paper);
            box-shadow: var(--shadow);
            border-radius: 3px;
            padding: clamp(19px, 3vw, 30px);
            position: sticky;
            top: 18px;
            transform: rotate(.25deg);
            border: 1px solid rgba(82,64,35,.17);
        }

        .board::before {
            content: "";
            position: absolute;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: radial-gradient(circle at 36% 30%, #ff7967, var(--red) 48%, var(--red-dark) 100%);
            box-shadow: 1px 3px 4px rgba(40,30,20,.28);
            top: 11px;
            left: 50%;
        }

        .board h2 {
            margin: 5px 0 4px;
            text-align: center;
            font-family: "Cooper Black", "Bookman Old Style", Georgia, serif;
            font-size: 1.9rem;
        }

        .board-sub {
            margin: 0 auto 20px;
            text-align: center;
            color: #69736e;
            font-family: Georgia, serif;
            font-style: italic;
        }

        .trackers { display: grid; gap: 13px; }

        .tracker {
            display: grid;
            grid-template-columns: 122px 1fr 48px;
            gap: 10px;
            align-items: center;
        }

        .tracker-name {
            font-weight: 900;
            font-size: .78rem;
            line-height: 1.1;
        }

        .track {
            height: 20px;
            background: #e1e2d9;
            border: 2px solid rgba(29,45,39,.16);
            overflow: hidden;
            position: relative;
        }

        .fill {
            width: 0;
            height: 100%;
            transition: width .45s cubic-bezier(.2,.8,.2,1), background .2s;
            background: var(--red);
        }

        .tracker[data-group="grain"] .fill { background: var(--gold); }
        .tracker[data-group="milk"] .fill { background: var(--blue); }
        .tracker[data-group="protein"] .fill { background: var(--green); }
        .tracker.complete .track { outline: 3px solid rgba(32,48,44,.13); }

        .count {
            font-family: "Courier New", monospace;
            font-weight: 900;
            font-size: .9rem;
            text-align: right;
        }

        .day-tray {
            min-height: 108px;
            margin: 24px 0 17px;
            padding: 13px;
            border: 2px dashed #b1aa96;
            background:
                linear-gradient(rgba(255,255,255,.42), rgba(255,255,255,.42)),
                repeating-linear-gradient(-45deg, #eee9dc 0 8px, #e8e1d1 8px 16px);
            display: flex;
            flex-wrap: wrap;
            align-content: flex-start;
            gap: 7px;
        }

        .empty-message {
            margin: auto;
            color: #898477;
            font-family: Georgia, serif;
            font-style: italic;
            text-align: center;
        }

        .tray-item {
            border: 0;
            background: white;
            border-radius: 999px;
            padding: 7px 10px;
            cursor: pointer;
            box-shadow: 0 2px 0 #c6c0b2;
            animation: plop .25s both;
            font-size: .82rem;
            font-weight: 800;
        }

        .tray-item:hover { background: #ffe4de; }

        .verdict {
            min-height: 86px;
            display: grid;
            grid-template-columns: 68px 1fr;
            align-items: center;
            gap: 14px;
            background: #eef0e7;
            border-left: 7px solid #8f998f;
            padding: 12px 14px;
        }

        .verdict-face {
            font-size: 2.6rem;
            text-align: center;
        }

        .verdict strong {
            display: block;
            font-family: Georgia, serif;
            font-size: 1.05rem;
            margin-bottom: 3px;
        }

        .verdict p {
            margin: 0;
            font-size: .82rem;
            line-height: 1.4;
            color: #54615c;
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 17px;
        }

        .action {
            border: 0;
            padding: 12px;
            font-weight: 900;
            cursor: pointer;
            transition: transform .14s;
        }

        .action:hover, .action:focus-visible { transform: translateY(-2px); }
        .action.primary { color: white; background: var(--green-dark); box-shadow: 0 4px 0 #063f2d; }
        .action.secondary { background: #ebe6d8; color: #52605b; box-shadow: 0 4px 0 #c4bcaa; }

        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 16px;
            margin-top: 16px;
            color: #68736e;
            font-size: .72rem;
            font-weight: 800;
        }

        .legend span::before {
            content: "";
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--dot);
            margin-right: 5px;
        }

        .source {
            margin: 42px 0 0;
            padding: 19px 22px;
            border: 2px solid rgba(34,62,52,.2);
            background: rgba(255,255,255,.42);
            text-align: center;
            font-family: Georgia, serif;
            line-height: 1.55;
        }

        .source a {
            color: var(--red-dark);
            font-weight: bold;
            text-underline-offset: 3px;
        }

        .source small {
            display: block;
            margin-top: 5px;
            color: #66726d;
            font-family: "Avenir Next Rounded", "Trebuchet MS", sans-serif;
        }

        .toast {
            position: fixed;
            left: 50%;
            bottom: 28px;
            transform: translate(-50%, 120px);
            z-index: 30;
            background: #183b32;
            color: white;
            padding: 12px 18px;
            border-radius: 999px;
            box-shadow: 0 10px 30px rgba(0,0,0,.25);
            font-weight: 900;
            transition: transform .3s ease;
        }

        .toast.show { transform: translate(-50%, 0); }

        .confetti {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 25;
        }

        .confetti i {
            position: absolute;
            top: -20px;
            width: 12px;
            height: 18px;
            background: var(--c);
            animation: fall 1.8s ease-in forwards;
        }

        @keyframes settle {
            from { opacity: 0; translate: 0 8px; }
            to { opacity: 1; translate: 0 0; }
        }

        @keyframes pop {
            0%, 100% { scale: 1; }
            50% { scale: .9; }
        }

        @keyframes plop {
            from { opacity: 0; transform: scale(.5) rotate(-8deg); }
            to { opacity: 1; transform: scale(1) rotate(0); }
        }

        @keyframes fall {
            to { transform: translate(var(--drift), 110vh) rotate(720deg); }
        }

        @media (max-width: 850px) {
            .handle { display: none; }
            .workspace { grid-template-columns: 1fr; }
            .board { position: relative; top: auto; order: -1; }
            .food-grid { grid-template-columns: repeat(4, 1fr); }
            .intro-strip { grid-template-columns: 1fr; }
        }

        @media (max-width: 560px) {
            .door {
                width: 100%;
                margin: 0;
                border-radius: 0;
                padding: 20px 15px 38px;
            }
            .topbar { gap: 10px; }
            .year-magnet { min-width: 84px; border-width: 5px; }
            .year-magnet strong { font-size: 1.35rem; }
            .year-magnet small { font-size: .52rem; }
            h1 { font-size: clamp(2.75rem, 15vw, 4.4rem); }
            .intro-strip { margin-top: 25px; }
            .note { padding: 20px; }
            .food-grid { grid-template-columns: repeat(3, 1fr); gap: 9px; }
            .food { min-height: 104px; }
            .tracker { grid-template-columns: 100px 1fr 42px; gap: 7px; }
            .tracker-name { font-size: .68rem; }
            .board { padding: 23px 16px 19px; }
            .actions { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <main class="door">
        <div class="handle" aria-hidden="true"></div>

        <header class="topbar">
            <div class="brand">
                <span class="eyebrow">A fridge-magnet experiment</span>
                <h1>Food Guide<br>Rescue</h1>
                <p class="subtitle">Can a bachelor’s day of Mr. Noodles, eggs, and cereal become a rather decent spread? Add one ordinary food at a time and watch the old guide fill up.</p>
            </div>
            <div class="year-magnet" aria-label="2012 edition">
                <strong>2012</strong>
                <small>fridge-door<br>edition</small>
            </div>
        </header>

        <section class="intro-strip" aria-label="How to play">
            <div class="note">
                <p><strong>Start where Jon started:</strong> instant noodles, two eggs, and cereal with milk. Tap food magnets to round out the day. Tap anything in your tray to take it back out. No kale halo required.</p>
            </div>
            <div class="mission">
                <span>Today’s mission</span>
                <strong>Fill all four bands without using more than 18 total magnets.</strong>
            </div>
        </section>

        <div class="workspace">
            <section aria-labelledby="pantry-title">
                <div class="panel-title">
                    <h2 id="pantry-title">The fridge &amp; pantry</h2>
                    <small>tap to add</small>
                </div>
                <div class="pantry">
                    <div class="filter-row" role="group" aria-label="Filter foods">
                        <button class="filter active" data-filter="all">Everything</button>
                        <button class="filter" data-filter="veg">Fruit + veg</button>
                        <button class="filter" data-filter="grain">Grains</button>
                        <button class="filter" data-filter="milk">Milk + alt.</button>
                        <button class="filter" data-filter="protein">Protein</button>
                    </div>
                    <div class="food-grid" id="food-grid"></div>
                </div>
            </section>

            <aside class="board" aria-labelledby="board-title">
                <h2 id="board-title">Jon’s day tray</h2>
                <p class="board-sub">Old-school targets from the post</p>

                <div class="trackers">
                    <div class="tracker" data-group="veg">
                        <span class="tracker-name">VEGETABLES<br>+ FRUIT</span>
                        <div class="track"><div class="fill"></div></div>
                        <span class="count">0 / 9</span>
                    </div>
                    <div class="tracker" data-group="grain">
                        <span class="tracker-name">GRAIN<br>PRODUCTS</span>
                        <div class="track"><div class="fill"></div></div>
                        <span class="count">0 / 8</span>
                    </div>
                    <div class="tracker" data-group="milk">
                        <span class="tracker-name">MILK +<br>ALTERNATIVES</span>
                        <div class="track"><div class="fill"></div></div>
                        <span class="count">0 / 2</span>
                    </div>
                    <div class="tracker" data-group="protein">
                        <span class="tracker-name">MEAT +<br>ALTERNATIVES</span>
                        <div class="track"><div class="fill"></div></div>
                        <span class="count">0 / 3</span>
                    </div>
                </div>

                <div class="day-tray" id="day-tray" aria-live="polite"></div>

                <div class="verdict" id="verdict" aria-live="polite">
                    <div class="verdict-face">🍜</div>
                    <div>
                        <strong>The bachelor baseline</strong>
                        <p>Competent at keeping a human technically upright. There is room on the fridge door for ambition.</p>
                    </div>
                </div>

                <div class="actions">
                    <button class="action primary" id="surprise">Make one smart addition</button>
                    <button class="action secondary" id="reset">Reset to Mr. Noodles</button>
                </div>

                <div class="legend" aria-label="Colour key">
                    <span style="--dot:var(--red)">fruit + veg</span>
                    <span style="--dot:var(--gold)">grains</span>
                    <span style="--dot:var(--blue)">milk + alt.</span>
                    <span style="--dot:var(--green)">protein</span>
                </div>
            </aside>
        </div>

        <footer class="source">
            Inspired by Jon’s <a href="https://jona.ca/2012/04/canada-food-guide.html" target="_blank" rel="noopener">“Canada Food Guide”</a>, in which the old daily serving chart casts a rather stern eye over Mr. Noodles, eggs, and cereal.
            <small>This is a playful historical tracker based on the numbers in Jon’s 2012 post, not current nutrition advice.</small>
        </footer>
    </main>

    <div class="toast" id="toast" role="status"></div>
    <div class="confetti" id="confetti" aria-hidden="true"></div>

    <script>
        const targets = { veg: 9, grain: 8, milk: 2, protein: 3 };

        const foods = [
            { id: "apple", name: "Apple", emoji: "🍎", group: "veg", servings: 1 },
            { id: "berries", name: "Bowl of berries", emoji: "🫐", group: "veg", servings: 1 },
            { id: "carrots", name: "Carrot sticks", emoji: "🥕", group: "veg", servings: 1 },
            { id: "broccoli", name: "Broccoli", emoji: "🥦", group: "veg", servings: 1 },
            { id: "salad", name: "Big green salad", emoji: "🥗", group: "veg", servings: 2 },
            { id: "soup", name: "Vegetable soup", emoji: "🍲", group: "veg", servings: 2 },
            { id: "banana", name: "Banana", emoji: "🍌", group: "veg", servings: 1 },
            { id: "pepper", name: "Bell pepper", emoji: "🫑", group: "veg", servings: 1 },
            { id: "toast", name: "Whole-grain toast", emoji: "🍞", group: "grain", servings: 2 },
            { id: "rice", name: "Brown rice", emoji: "🍚", group: "grain", servings: 2 },
            { id: "oats", name: "Oatmeal", emoji: "🥣", group: "grain", servings: 2 },
            { id: "pasta", name: "Whole-wheat pasta", emoji: "🍝", group: "grain", servings: 2 },
            { id: "yogurt", name: "Yogurt", emoji: "🥛", group: "milk", servings: 1 },
            { id: "cheese", name: "Cheese", emoji: "🧀", group: "milk", servings: 1 },
            { id: "soy", name: "Fortified soy drink", emoji: "🧃", group: "milk", servings: 1 },
            { id: "beans", name: "Beans", emoji: "🫘", group: "protein", servings: 1 },
            { id: "salmon", name: "Salmon", emoji: "🐟", group: "protein", servings: 1 },
            { id: "chicken", name: "Chicken", emoji: "🍗", group: "protein", servings: 1 },
            { id: "tofu", name: "Tofu", emoji: "◻️", group: "protein", servings: 1 },
            { id: "nuts", name: "Handful of nuts", emoji: "🥜", group: "protein", servings: 1 }
        ];

        const baseline = [
            { id: "noodles", name: "Mr. Noodles", emoji: "🍜", group: "grain", servings: 2, locked: true },
            { id: "eggs", name: "Two eggs", emoji: "🍳", group: "protein", servings: 1, locked: true },
            { id: "cereal", name: "Cereal", emoji: "🥣", group: "grain", servings: 2, locked: true },
            { id: "milk-base", name: "Milk", emoji: "🥛", group: "milk", servings: 1, locked: true }
        ];

        let tray = [...baseline];
        let celebrated = false;
        const grid = document.getElementById("food-grid");
        const trayEl = document.getElementById("day-tray");
        const verdict = document.getElementById("verdict");
        const toast = document.getElementById("toast");

        function renderFoods(filter = "all") {
            grid.innerHTML = "";
            foods.filter(food => filter === "all" || food.group === filter).forEach((food, index) => {
                const button = document.createElement("button");
                button.className = "food";
                button.dataset.group = food.group;
                button.style.animationDelay = `${index * 25}ms`;
                button.innerHTML = `
                    <span class="plus" aria-hidden="true">+</span>
                    <span class="emoji" aria-hidden="true">${food.emoji}</span>
                    <span class="name">${food.name}<br>+${food.servings}</span>
                `;
                button.setAttribute("aria-label", `Add ${food.name}, ${food.servings} serving${food.servings > 1 ? "s" : ""}`);
                button.addEventListener("click", () => {
                    if (tray.length >= 18) {
                        showToast("The fridge magnet union says 18 is plenty.");
                        return;
                    }
                    tray.push({ ...food, instance: crypto.randomUUID ? crypto.randomUUID() : Date.now() + Math.random() });
                    button.classList.remove("pop");
                    void button.offsetWidth;
                    button.classList.add("pop");
                    update();
                });
                grid.appendChild(button);
            });
        }

        function totals() {
            return tray.reduce((sum, item) => {
                sum[item.group] += item.servings;
                return sum;
            }, { veg: 0, grain: 0, milk: 0, protein: 0 });
        }

        function update() {
            const sum = totals();

            document.querySelectorAll(".tracker").forEach(row => {
                const group = row.dataset.group;
                const value = sum[group];
                row.querySelector(".fill").style.width = `${Math.min(100, value / targets[group] * 100)}%`;
                row.querySelector(".count").textContent = `${value} / ${targets[group]}`;
                row.classList.toggle("complete", value >= targets[group]);
            });

            trayEl.innerHTML = "";
            tray.forEach((item, index) => {
                const chip = document.createElement("button");
                chip.className = "tray-item";
                chip.textContent = `${item.emoji} ${item.name}`;
                if (item.locked) {
                    chip.title = "Part of Jon's bachelor baseline";
                    chip.setAttribute("aria-label", `${item.name}, part of the fixed baseline`);
                } else {
                    chip.title = "Tap to remove";
                    chip.setAttribute("aria-label", `Remove ${item.name}`);
                    chip.addEventListener("click", () => {
                        tray.splice(index, 1);
                        celebrated = false;
                        update();
                    });
                }
                trayEl.appendChild(chip);
            });

            const completed = Object.keys(targets).filter(group => sum[group] >= targets[group]).length;
            const vegVariety = new Set(tray.filter(item => item.group === "veg").map(item => item.id)).size;
            let face = "🍜";
            let title = "The bachelor baseline";
            let copy = "Competent at keeping a human technically upright. There is room on the fridge door for ambition.";
            let border = "#8f998f";

            if (completed === 1) {
                face = "🥄";
                title = "The rescue has begun";
                copy = "One band is full. A respectable first sortie from the instant-noodle district.";
                border = "#d79e20";
            } else if (completed === 2) {
                face = "🧑‍🍳";
                title = "This is becoming a day";
                copy = "Two bands are home. Keep an eye on the shortest bar rather than piling onto the easy one.";
                border = "#2e70b6";
            } else if (completed === 3) {
                face = "🍽️";
                title = "So close the fridge can taste it";
                copy = "Three bands complete. One thoughtful addition may rescue the whole operation.";
                border = "#188f66";
            } else if (completed === 4) {
                face = vegVariety >= 5 ? "🏆" : "🎉";
                title = vegVariety >= 5 ? "A magnificently colourful rescue" : "The old guide is satisfied";
                copy = tray.length <= 18
                    ? "All four bands, within the 18-magnet mission. Mr. Noodles has acquired an excellent supporting cast."
                    : "All four bands are full. The fridge door is busy, but the day is balanced.";
                border = "#0b6446";
                if (!celebrated) {
                    celebrated = true;
                    celebrate();
                }
            } else if (sum.veg > 0) {
                face = "🍎";
                title = "Colour has entered the chat";
                copy = "The baseline is already less beige. Keep filling the shortest band.";
                border = "#e64a38";
            }

            verdict.style.borderColor = border;
            verdict.innerHTML = `<div class="verdict-face">${face}</div><div><strong>${title}</strong><p>${copy}</p></div>`;
        }

        function showToast(message) {
            toast.textContent = message;
            toast.classList.add("show");
            clearTimeout(showToast.timer);
            showToast.timer = setTimeout(() => toast.classList.remove("show"), 2300);
        }

        function celebrate() {
            const layer = document.getElementById("confetti");
            layer.innerHTML = "";
            const colours = ["#e64a38", "#e6aa25", "#2e70b6", "#188f66", "#fffaf0"];
            for (let i = 0; i < 55; i++) {
                const piece = document.createElement("i");
                piece.style.left = `${Math.random() * 100}%`;
                piece.style.setProperty("--c", colours[i % colours.length]);
                piece.style.setProperty("--drift", `${Math.random() * 180 - 90}px`);
                piece.style.animationDelay = `${Math.random() * .45}s`;
                piece.style.transform = `rotate(${Math.random() * 180}deg)`;
                layer.appendChild(piece);
            }
            setTimeout(() => layer.innerHTML = "", 2500);
        }

        document.querySelectorAll(".filter").forEach(button => {
            button.addEventListener("click", () => {
                document.querySelectorAll(".filter").forEach(item => item.classList.remove("active"));
                button.classList.add("active");
                renderFoods(button.dataset.filter);
            });
        });

        document.getElementById("reset").addEventListener("click", () => {
            tray = [...baseline];
            celebrated = false;
            update();
            showToast("Back to the bachelor baseline.");
        });

        document.getElementById("surprise").addEventListener("click", () => {
            if (tray.length >= 18) {
                showToast("You’ve reached the 18-magnet mission limit.");
                return;
            }
            const sum = totals();
            const needs = Object.keys(targets)
                .map(group => ({ group, gap: Math.max(0, targets[group] - sum[group]) }))
                .filter(item => item.gap > 0)
                .sort((a, b) => (b.gap / targets[b.group]) - (a.gap / targets[a.group]));
            if (!needs.length) {
                showToast("Nothing needs rescuing. The old guide is beaming.");
                return;
            }
            const weakest = needs[0].group;
            const choices = foods.filter(food => food.group === weakest);
            const chosen = choices[Math.floor(Math.random() * choices.length)];
            tray.push({ ...chosen, instance: Date.now() + Math.random() });
            update();
            showToast(`${chosen.emoji} ${chosen.name} joined the rescue.`);
        });

        renderFoods();
        update();
    </script>
</body>
</html>
