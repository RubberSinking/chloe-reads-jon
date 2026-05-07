<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess Brilliancy Theater</title>
    <style>
        :root {
            --bg: #120d12;
            --bg-2: #1d1420;
            --panel: rgba(24, 16, 30, 0.82);
            --panel-strong: rgba(35, 23, 43, 0.94);
            --gold: #efc56b;
            --gold-soft: #c99839;
            --cream: #f7eedb;
            --ink: #2d2017;
            --muted: #c9b79c;
            --rose: #ff8db4;
            --teal: #8ad8d0;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
            --board-light: #ead7b3;
            --board-dark: #8d5e3c;
            --highlight: rgba(255, 214, 102, 0.38);
            --danger: rgba(255, 102, 140, 0.28);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--cream);
            font-family: "Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            background:
                radial-gradient(circle at top, rgba(107, 37, 73, 0.33), transparent 34%),
                radial-gradient(circle at 80% 18%, rgba(53, 98, 121, 0.24), transparent 25%),
                linear-gradient(180deg, #22121f 0%, #130d14 44%, #0e0b0f 100%);
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -1;
        }

        body::before {
            background:
                linear-gradient(90deg, rgba(0,0,0,0.28) 0 10%, transparent 10% 90%, rgba(0,0,0,0.28) 90% 100%),
                repeating-linear-gradient(90deg, rgba(255,255,255,0.02) 0 2px, transparent 2px 6px);
            opacity: 0.55;
        }

        body::after {
            background-image: radial-gradient(rgba(255,255,255,0.08) 0.7px, transparent 0.7px);
            background-size: 11px 11px;
            opacity: 0.08;
            mix-blend-mode: screen;
        }

        .page {
            width: min(1180px, calc(100% - 24px));
            margin: 0 auto;
            padding: 22px 0 48px;
        }

        .marquee {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(239, 197, 107, 0.28);
            border-radius: 999px;
            padding: 8px 14px;
            color: var(--gold);
            background: rgba(22, 15, 28, 0.66);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.03) inset;
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .hero {
            position: relative;
            padding: 28px 18px 18px;
            border-radius: 28px;
            background:
                linear-gradient(145deg, rgba(45, 28, 56, 0.9), rgba(15, 11, 18, 0.94)),
                linear-gradient(180deg, rgba(255,255,255,0.04), transparent);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            top: 0;
            bottom: 0;
            width: 18%;
            background:
                repeating-linear-gradient(90deg, rgba(88, 16, 40, 0.95) 0 16px, rgba(111, 24, 53, 0.95) 16px 32px);
            filter: drop-shadow(0 0 25px rgba(0,0,0,0.55));
            opacity: 0.9;
        }

        .hero::before { left: 0; border-radius: 0 28px 28px 0; transform: skewY(3deg) translateX(-28%); }
        .hero::after { right: 0; border-radius: 28px 0 0 28px; transform: skewY(-3deg) translateX(28%); }

        .hero-content {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 24px;
            grid-template-columns: 1.2fr 0.8fr;
            align-items: center;
        }

        h1, h2, .section-kicker {
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
        }

        h1 {
            margin: 14px 0 12px;
            font-size: clamp(2.5rem, 6vw, 5rem);
            line-height: 0.95;
            letter-spacing: -0.04em;
        }

        .hero p {
            margin: 0;
            max-width: 36rem;
            font-size: 1.05rem;
            line-height: 1.7;
            color: var(--muted);
        }

        .hero-copy {
            padding: 14px 18px 18px;
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .stat {
            background: rgba(247, 238, 219, 0.06);
            border: 1px solid rgba(247, 238, 219, 0.08);
            border-radius: 18px;
            padding: 14px;
            backdrop-filter: blur(10px);
        }

        .stat strong {
            display: block;
            color: var(--gold);
            font-size: 1.4rem;
        }

        .stat span {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 0.86rem;
            line-height: 1.45;
        }

        .quote-card {
            position: relative;
            padding: 18px;
            background: linear-gradient(180deg, rgba(249,240,221,0.97), rgba(231,211,177,0.9));
            color: var(--ink);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.38);
            transform: rotate(-2.4deg);
        }

        .quote-card::before {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(87, 61, 30, 0.18);
            border-radius: 16px;
        }

        .quote-card .pin {
            position: absolute;
            top: -12px;
            right: 18px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: radial-gradient(circle at 35% 35%, #fff6d8, #c99839 72%, #6e4b18 100%);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .quote-card small {
            display: block;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: #7d5d33;
            margin-bottom: 10px;
        }

        .quote-card blockquote {
            margin: 0;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: 1.15rem;
            line-height: 1.6;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(300px, 0.9fr);
            gap: 22px;
            margin-top: 24px;
        }

        .panel {
            position: relative;
            border-radius: 28px;
            background: var(--panel);
            border: 1px solid rgba(255,255,255,0.06);
            box-shadow: var(--shadow);
            padding: 20px;
            overflow: hidden;
        }

        .panel::after {
            content: "";
            position: absolute;
            inset: auto 18px 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(239, 197, 107, 0.3), transparent);
        }

        .section-kicker {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }

        .board-shell {
            display: grid;
            gap: 16px;
        }

        .topline {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: start;
        }

        .scene-title {
            margin: 0;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            font-size: clamp(1.7rem, 3vw, 2.4rem);
        }

        .scene-note {
            margin: 8px 0 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .meter {
            min-width: 160px;
            display: grid;
            gap: 6px;
        }

        .meter-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .meter-track {
            height: 12px;
            border-radius: 999px;
            background: rgba(247, 238, 219, 0.08);
            overflow: hidden;
            border: 1px solid rgba(247, 238, 219, 0.08);
        }

        .meter-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--rose), var(--gold));
            width: 50%;
            transition: width 320ms ease;
        }

        .board-and-side {
            display: grid;
            gap: 16px;
            grid-template-columns: minmax(0, 1fr) 220px;
            align-items: start;
        }

        .board-wrap {
            background: linear-gradient(145deg, rgba(243, 221, 173, 0.14), rgba(88, 54, 26, 0.28));
            border-radius: 26px;
            padding: 14px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.08), 0 20px 40px rgba(0,0,0,0.28);
        }

        .board {
            position: relative;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            border-radius: 18px;
            overflow: hidden;
            aspect-ratio: 1;
            border: 1px solid rgba(65, 34, 13, 0.8);
            box-shadow: 0 12px 30px rgba(0,0,0,0.24);
        }

        .square {
            position: relative;
            display: grid;
            place-items: center;
            font-size: clamp(1.7rem, 5vw, 3rem);
            user-select: none;
            transition: transform 180ms ease, background 180ms ease;
        }

        .square.light { background: var(--board-light); }
        .square.dark { background: var(--board-dark); }

        .square.highlight::after,
        .square.capture::after {
            content: "";
            position: absolute;
            inset: 0;
        }

        .square.highlight::after { background: var(--highlight); }
        .square.capture::after { background: var(--danger); }

        .square .piece {
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 0 rgba(255,255,255,0.15), 0 8px 10px rgba(0,0,0,0.3);
        }

        .square.dark .piece.white,
        .square.light .piece.white { color: #fff8f0; }
        .square.dark .piece.black,
        .square.light .piece.black { color: #1c1715; }

        .coord {
            position: absolute;
            font-size: 0.66rem;
            color: rgba(58, 31, 16, 0.78);
            font-weight: 700;
            z-index: 2;
        }

        .coord.file { bottom: 5px; right: 6px; }
        .coord.rank { top: 5px; left: 6px; }

        .side-stack {
            display: grid;
            gap: 14px;
        }

        .mini-card {
            padding: 14px;
            border-radius: 20px;
            background: rgba(250, 242, 227, 0.06);
            border: 1px solid rgba(250, 242, 227, 0.08);
        }

        .mini-card h3 {
            margin: 0 0 8px;
            font-size: 0.95rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--gold);
        }

        .mini-card p,
        .mini-card li {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.94rem;
        }

        .mini-card ul {
            margin: 0;
            padding-left: 18px;
        }

        .piece-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }

        .pill {
            border-radius: 999px;
            padding: 7px 11px;
            background: rgba(255,255,255,0.06);
            font-size: 0.82rem;
            color: var(--cream);
        }

        .controls,
        .timeline {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        button {
            border: 0;
            border-radius: 999px;
            padding: 11px 16px;
            font: inherit;
            cursor: pointer;
            transition: transform 180ms ease, background 180ms ease, opacity 180ms ease;
        }

        button:hover { transform: translateY(-1px); }
        button:active { transform: translateY(1px); }

        .control-btn {
            color: var(--ink);
            background: linear-gradient(180deg, #f7ebca, #ddbb69);
            box-shadow: 0 8px 18px rgba(0,0,0,0.24);
        }

        .ghost-btn {
            color: var(--cream);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .timeline-btn {
            min-width: 132px;
            text-align: left;
            background: rgba(255,255,255,0.05);
            color: var(--cream);
            border: 1px solid transparent;
        }

        .timeline-btn strong {
            display: block;
            font-size: 0.92rem;
            margin-bottom: 3px;
        }

        .timeline-btn span {
            display: block;
            font-size: 0.78rem;
            color: var(--muted);
        }

        .timeline-btn.active {
            background: linear-gradient(180deg, rgba(239,197,107,0.2), rgba(239,197,107,0.08));
            border-color: rgba(239,197,107,0.42);
        }

        .script-panel {
            background: var(--panel-strong);
        }

        .script-panel h2,
        .quiz-panel h2,
        .hero h2 {
            margin: 0;
            font-size: 1.7rem;
        }

        .script-list {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        .script-card {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .script-card strong {
            display: block;
            font-size: 0.95rem;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .script-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .quiz-options {
            display: grid;
            gap: 10px;
            margin-top: 16px;
        }

        .quiz-option {
            text-align: left;
            border-radius: 18px;
            padding: 14px 16px;
            background: rgba(255,255,255,0.05);
            color: var(--cream);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .quiz-option.correct {
            background: rgba(94, 196, 136, 0.18);
            border-color: rgba(94, 196, 136, 0.48);
        }

        .quiz-option.wrong {
            background: rgba(227, 93, 115, 0.18);
            border-color: rgba(227, 93, 115, 0.42);
        }

        .quiz-feedback {
            margin-top: 14px;
            min-height: 3.4em;
            color: var(--muted);
            line-height: 1.6;
        }

        .footer-note {
            margin-top: 24px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .footer-note a,
        .hero a {
            color: var(--gold);
        }

        @media (max-width: 980px) {
            .hero-content,
            .layout,
            .board-and-side {
                grid-template-columns: 1fr;
            }

            .quote-card {
                transform: none;
                margin: 0 8px;
            }
        }

        @media (max-width: 640px) {
            .page { width: min(100% - 12px, 1180px); padding-top: 12px; }
            .hero,
            .panel { border-radius: 24px; }
            .hero::before,
            .hero::after { width: 12%; }
            .hero-copy { padding: 8px 10px 16px; }
            .hero-stats { grid-template-columns: 1fr; }
            .topline { flex-direction: column; }
            .meter { width: 100%; }
            .timeline-btn { min-width: calc(50% - 6px); }
            .controls button,
            .timeline-btn,
            .quiz-option { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="hero-content">
                <div class="hero-copy">
                    <div class="marquee">♞ Midnight replay room • Fischer vs Byrne • 1956</div>
                    <h1>Chess Brilliancy Theater</h1>
                    <p>
                        Jon once wandered into a little chess-reading spell and landed on Deep Blue, Bobby Fischer, and the legendary Game of the Century. So here is a velvet-curtain replay room where you can step through the attack, feel the pressure build, and test whether you would have spotted the deliciously rude queen sacrifice.
                    </p>
                    <div class="hero-stats">
                        <div class="stat">
                            <strong>13</strong>
                            <span>Fischer's age when he played this absurdly grown-up masterpiece.</span>
                        </div>
                        <div class="stat">
                            <strong>17...Be6!!</strong>
                            <span>The move that says, with indecent calm, "yes, take my queen if you must."</span>
                        </div>
                        <div class="stat">
                            <strong>41...Rc2#</strong>
                            <span>The final clean mate, with Black's pieces working like a pocket watch.</span>
                        </div>
                    </div>
                </div>
                <aside class="quote-card" aria-label="Pinned note about Jon's post">
                    <div class="pin" aria-hidden="true"></div>
                    <small>Inspired by Jon's post</small>
                    <blockquote>
                        “For some reason, I felt like reading some articles about chess today.”<br><br>
                        A very Jon sentence, honestly. One click later and suddenly we're in Bobby Fischer country.
                    </blockquote>
                </aside>
            </div>
        </section>

        <section class="layout">
            <div class="panel board-shell">
                <div class="topline">
                    <div>
                        <div class="section-kicker">Replay stage</div>
                        <h2 class="scene-title" id="scene-title">Opening tension</h2>
                        <p class="scene-note" id="scene-note">The Grünfeld begins politely enough. Byrne owns space. Fischer is already laying traps.</p>
                    </div>
                    <div class="meter">
                        <div class="meter-label"><span>Drama level</span><span id="meter-text">40%</span></div>
                        <div class="meter-track"><div class="meter-fill" id="meter-fill"></div></div>
                    </div>
                </div>

                <div class="board-and-side">
                    <div>
                        <div class="board-wrap">
                            <div class="board" id="board" aria-label="Interactive chessboard"></div>
                        </div>
                        <div class="controls" style="margin-top: 16px;">
                            <button class="control-btn" id="prev-btn" type="button">◀ Previous scene</button>
                            <button class="control-btn" id="next-btn" type="button">Next scene ▶</button>
                            <button class="ghost-btn" id="autoplay-btn" type="button">Auto-play the drama</button>
                        </div>
                        <div class="timeline" id="timeline" style="margin-top: 16px;"></div>
                    </div>
                    <div class="side-stack">
                        <div class="mini-card">
                            <h3>Current move</h3>
                            <p id="scene-move">After 10...Bg4</p>
                        </div>
                        <div class="mini-card">
                            <h3>On stage</h3>
                            <div class="piece-pills" id="piece-pills"></div>
                        </div>
                        <div class="mini-card">
                            <h3>Why it matters</h3>
                            <p id="scene-why">Black is behind in space, ahead in menace. Byrne's queen is starting to feel less like a queen and more like an exposed celebrity.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel script-panel">
                <div class="section-kicker">Playbill</div>
                <h2>The combination in five acts</h2>
                <div class="script-list">
                    <div class="script-card">
                        <strong>Act I: Bait the queen</strong>
                        <p>Fischer invites Byrne's queen forward, then keeps nudging it toward awkward squares until it becomes a tactical liability.</p>
                    </div>
                    <div class="script-card">
                        <strong>Act II: 11...Na4!!</strong>
                        <p>The first thunderclap. A knight lurches to the rim and somehow everything gets sharper instead of sillier.</p>
                    </div>
                    <div class="script-card">
                        <strong>Act III: Open the king</strong>
                        <p>Material is treated like kindling. Fischer throws pawns and pieces into the fire to pry open lines against the uncastled king.</p>
                    </div>
                    <div class="script-card">
                        <strong>Act IV: Queen offered with a straight face</strong>
                        <p>17...Be6!! is the kind of move that makes bystanders walk over to the board. It looks illegal to common sense and perfectly legal to genius.</p>
                    </div>
                    <div class="script-card">
                        <strong>Act V: Geometry wins</strong>
                        <p>After the queen comes off, Black's rooks, bishops, and knight form a machinery of checks so coordinated that White's queen becomes an expensive bystander.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="layout" style="margin-top: 22px;">
            <div class="panel quiz-panel">
                <div class="section-kicker">Audience participation</div>
                <h2>Would you spot the brilliancy?</h2>
                <p class="scene-note">You're at move 17. White has just played <strong>Kf1</strong> and is threatening Black's queen. Choose the move that turned this game immortal.</p>
                <div class="quiz-options">
                    <button class="quiz-option" type="button" data-choice="A"><strong>A.</strong> 17...Qb5</button>
                    <button class="quiz-option" type="button" data-choice="B"><strong>B.</strong> 17...Be6!!</button>
                    <button class="quiz-option" type="button" data-choice="C"><strong>C.</strong> 17...Nb5</button>
                    <button class="quiz-option" type="button" data-choice="D"><strong>D.</strong> 17...Rad8</button>
                </div>
                <div class="quiz-feedback" id="quiz-feedback">A quiet warning: the best move is not the sensible move. This is Bobby Fischer, not an accountant.</div>
            </div>

            <div class="panel">
                <div class="section-kicker">Little extras</div>
                <div class="mini-card" style="background: rgba(255,255,255,0.04);">
                    <h3>What to notice</h3>
                    <ul>
                        <li>White's king never gets comfortable. Every concession becomes a future lever.</li>
                        <li>Black's queen sacrifice is not a stunt. It's a bookkeeping exercise with much better taste.</li>
                        <li>The final mate is a nice reminder that coordinated pieces beat isolated glamour.</li>
                    </ul>
                </div>
                <div class="mini-card" style="margin-top: 14px; background: rgba(255,255,255,0.04);">
                    <h3>If Nathan wanders over</h3>
                    <p>Tell him this is a boss battle where the villain throws away his fanciest weapon because the rest of the team is already in perfect position.</p>
                </div>
                <div class="footer-note">
                    <span>Inspired by Jon's 2011 post <em>On Chess</em>.</span>
                    <a href="index.php">Back to Chloe Reads Jon</a>
                </div>
            </div>
        </section>
    </div>

    <script>
        const files = ['a','b','c','d','e','f','g','h'];
        const pieceMap = {
            p: ['♟', 'black'], r: ['♜', 'black'], n: ['♞', 'black'], b: ['♝', 'black'], q: ['♛', 'black'], k: ['♚', 'black'],
            P: ['♙', 'white'], R: ['♖', 'white'], N: ['♘', 'white'], B: ['♗', 'white'], Q: ['♕', 'white'], K: ['♔', 'white']
        };

        const scenes = [
            {
                title: 'Opening tension',
                move: 'After 10...Bg4',
                note: 'The Grünfeld begins politely enough. Byrne owns space. Fischer is already laying traps.',
                why: 'Black is behind in space, ahead in menace. Byrne\'s queen is starting to feel less like a queen and more like an exposed celebrity.',
                fen: 'r2q1rk1/pp2ppbp/1np2np1/2Q5/3PPBb1/2N2N2/PP3PPP/3RKB1R w K - 5 11',
                highlight: ['g4','c5'],
                capture: [],
                drama: 40,
                pills: ['White queen advanced', 'Black fully castled', 'Development edge: Black']
            },
            {
                title: 'The knight bolt',
                move: 'After 11...Na4!!',
                note: 'This is where onlookers allegedly drifted toward the board. A knight on the rim, and yet somehow the attack gets louder.',
                why: 'Na4 hits the queen and reveals how awkward White\'s setup has become. The c3 knight is overloaded, and the center is about to crack.',
                fen: 'r2q1rk1/pp2ppbp/2p2np1/2Q3B1/n2PP1b1/2N2N2/PP3PPP/3RKB1R w K - 7 12',
                highlight: ['a4','c5'],
                capture: [],
                drama: 58,
                pills: ['Knight on a4', 'Queen under pressure', 'Tactical imbalance rising']
            },
            {
                title: 'The queen is ignored',
                move: 'After 17...Be6!!',
                note: 'White threatens the black queen. Fischer responds by offering it. Very rude. Very memorable.',
                why: 'Be6 develops with tempo, blocks lines, and says the attack matters more than the queen. It is the move everyone remembers.',
                fen: 'r3r1k1/pp3pbp/1qp1b1p1/2B5/2BP4/Q1n2N2/P4PPP/3R1K1R w - - 4 18',
                highlight: ['e6','b6'],
                capture: ['b6'],
                drama: 92,
                pills: ['Queen en prise', 'Development over material', 'Brilliancy point reached']
            },
            {
                title: 'And White takes it',
                move: 'After 18.Bxb6',
                note: 'Byrne accepts the queen. Perfectly understandable. Also exactly what Fischer was counting on.',
                why: 'The material count briefly looks absurd, but Black\'s pieces are about to begin a discovered-check carousel.',
                fen: 'r3r1k1/pp3pbp/1Bp1b1p1/8/2BP4/Q1n2N2/P4PPP/3R1K1R b - - 0 18',
                highlight: ['b6'],
                capture: ['b6'],
                drama: 95,
                pills: ['White queen won a queen', 'Black attack accelerating', 'King still exposed']
            },
            {
                title: 'The windmill begins',
                move: 'After 23...axb6',
                note: 'Checks, checks, more checks, and now Black calmly recaptures while uncovering yet another attack on White\'s queen.',
                why: 'Black has transformed the sacrifice into an organized army. White\'s queen is rich, lonely, and far from useful.',
                fen: 'r3r1k1/1p3pbp/1pp3p1/8/2b5/Q1n2N2/P4PPP/3R2KR w - - 0 24',
                highlight: ['a7','b6'],
                capture: ['b6'],
                drama: 84,
                pills: ['Black bishops active', 'Queen sidelined', 'Initiative fully Black']
            },
            {
                title: 'Material reckoning',
                move: 'After 25...Nxd1',
                note: 'Now the smoke clears a bit. Black has a rook, two bishops, and a pawn for the queen. More importantly, Black has the board.',
                why: 'Every black unit coordinates. White\'s rook is trapped, the king is airy, and the queen still cannot save the day alone.',
                fen: '4r1k1/1p3pbp/1Qp3p1/8/r1b5/5N2/P4PPP/3n2KR w - - 0 26',
                highlight: ['d1','b6','a4'],
                capture: ['d1'],
                drama: 73,
                pills: ['Queen vs orchestra', 'White rook gone', 'Black pieces harmonized']
            },
            {
                title: 'Pure mate',
                move: 'After 41...Rc2#',
                note: 'The curtains close with a clean, elegant mate. No chaos now. Just geometry.',
                why: 'Black\'s pieces cover every route. White\'s queen watches from the other wing, dressed magnificently and helping nobody.',
                fen: '1Q6/5pk1/2p3p1/1p2N2p/1b5P/1bn5/2r3P1/2K5 w - - 16 42',
                highlight: ['c2','b4','c3'],
                capture: ['c2'],
                drama: 100,
                pills: ['Checkmate', 'Queen stranded', 'Masterpiece complete']
            }
        ];

        const boardEl = document.getElementById('board');
        const titleEl = document.getElementById('scene-title');
        const noteEl = document.getElementById('scene-note');
        const whyEl = document.getElementById('scene-why');
        const moveEl = document.getElementById('scene-move');
        const pillsEl = document.getElementById('piece-pills');
        const meterFillEl = document.getElementById('meter-fill');
        const meterTextEl = document.getElementById('meter-text');
        const timelineEl = document.getElementById('timeline');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const autoplayBtn = document.getElementById('autoplay-btn');
        const quizFeedbackEl = document.getElementById('quiz-feedback');
        const quizOptions = Array.from(document.querySelectorAll('.quiz-option'));

        let currentScene = 0;
        let autoplay = null;

        function parseFenBoard(fen) {
            const ranks = fen.split(' ')[0].split('/');
            return ranks.map(rank => {
                const cells = [];
                for (const char of rank) {
                    if (/\d/.test(char)) {
                        for (let i = 0; i < Number(char); i += 1) cells.push('');
                    } else {
                        cells.push(char);
                    }
                }
                return cells;
            });
        }

        function squareName(row, col) {
            return `${files[col]}${8 - row}`;
        }

        function renderBoard(scene) {
            const board = parseFenBoard(scene.fen);
            boardEl.innerHTML = '';

            board.forEach((rank, row) => {
                rank.forEach((piece, col) => {
                    const square = document.createElement('div');
                    const light = (row + col) % 2 === 0;
                    const squareId = squareName(row, col);
                    square.className = `square ${light ? 'light' : 'dark'}`;
                    if (scene.highlight.includes(squareId)) square.classList.add('highlight');
                    if (scene.capture.includes(squareId)) square.classList.add('capture');

                    if (col === 0) {
                        const rankCoord = document.createElement('span');
                        rankCoord.className = 'coord rank';
                        rankCoord.textContent = 8 - row;
                        square.appendChild(rankCoord);
                    }
                    if (row === 7) {
                        const fileCoord = document.createElement('span');
                        fileCoord.className = 'coord file';
                        fileCoord.textContent = files[col];
                        square.appendChild(fileCoord);
                    }

                    if (piece) {
                        const pieceEl = document.createElement('span');
                        const [glyph, color] = pieceMap[piece];
                        pieceEl.className = `piece ${color}`;
                        pieceEl.textContent = glyph;
                        square.appendChild(pieceEl);
                    }

                    boardEl.appendChild(square);
                });
            });
        }

        function renderPills(scene) {
            pillsEl.innerHTML = '';
            scene.pills.forEach(text => {
                const pill = document.createElement('span');
                pill.className = 'pill';
                pill.textContent = text;
                pillsEl.appendChild(pill);
            });
        }

        function renderTimeline() {
            timelineEl.innerHTML = '';
            scenes.forEach((scene, index) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `timeline-btn ${index === currentScene ? 'active' : ''}`;
                btn.innerHTML = `<strong>${scene.title}</strong><span>${scene.move}</span>`;
                btn.addEventListener('click', () => {
                    stopAutoplay();
                    currentScene = index;
                    renderScene();
                });
                timelineEl.appendChild(btn);
            });
        }

        function renderScene() {
            const scene = scenes[currentScene];
            titleEl.textContent = scene.title;
            noteEl.textContent = scene.note;
            whyEl.textContent = scene.why;
            moveEl.textContent = scene.move;
            meterFillEl.style.width = `${scene.drama}%`;
            meterTextEl.textContent = `${scene.drama}%`;
            renderBoard(scene);
            renderPills(scene);
            renderTimeline();
            prevBtn.disabled = currentScene === 0;
            nextBtn.disabled = currentScene === scenes.length - 1;
        }

        function stopAutoplay() {
            if (autoplay) {
                clearInterval(autoplay);
                autoplay = null;
                autoplayBtn.textContent = 'Auto-play the drama';
            }
        }

        prevBtn.addEventListener('click', () => {
            stopAutoplay();
            currentScene = Math.max(0, currentScene - 1);
            renderScene();
        });

        nextBtn.addEventListener('click', () => {
            stopAutoplay();
            currentScene = Math.min(scenes.length - 1, currentScene + 1);
            renderScene();
        });

        autoplayBtn.addEventListener('click', () => {
            if (autoplay) {
                stopAutoplay();
                return;
            }
            autoplayBtn.textContent = 'Pause';
            autoplay = setInterval(() => {
                if (currentScene >= scenes.length - 1) {
                    stopAutoplay();
                    return;
                }
                currentScene += 1;
                renderScene();
            }, 2200);
        });

        quizOptions.forEach(button => {
            button.addEventListener('click', () => {
                quizOptions.forEach(option => option.classList.remove('correct', 'wrong'));
                const choice = button.dataset.choice;
                if (choice === 'B') {
                    button.classList.add('correct');
                    quizFeedbackEl.innerHTML = '<strong style="color: var(--gold);">Yes.</strong> <strong>17...Be6!!</strong> is the immortal move. Fischer ignores the attack on his queen because his pieces are about to produce a rolling series of checks and pickups. Basically: material is temporary, coordination is delicious.';
                    currentScene = 2;
                    renderScene();
                } else {
                    button.classList.add('wrong');
                    const correctBtn = quizOptions.find(option => option.dataset.choice === 'B');
                    correctBtn.classList.add('correct');
                    quizFeedbackEl.innerHTML = '<strong style="color: #ffb4c7;">Close, but no cigar.</strong> The famous move is <strong>17...Be6!!</strong>, the queen-sacrifice invitation. Sensible moves exist, but immortality is rarely sensible.';
                }
            });
        });

        renderScene();
    </script>
</body>
</html>
