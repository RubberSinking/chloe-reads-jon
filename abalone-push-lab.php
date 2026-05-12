<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abalone Push Lab</title>
    <style>
        :root {
            --bg: #09111f;
            --panel: rgba(11, 20, 36, 0.84);
            --panel-strong: rgba(8, 16, 28, 0.96);
            --line: rgba(174, 197, 255, 0.18);
            --text: #f7f5ef;
            --muted: #b9c4dd;
            --gold: #f4c66a;
            --gold-deep: #b97920;
            --ink: #0d1727;
            --teal: #88ece3;
            --rose: #ff9cb5;
            --shadow: 0 28px 60px rgba(0, 0, 0, 0.42);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--text);
            background:
                radial-gradient(circle at top, rgba(87, 129, 255, 0.20), transparent 28%),
                radial-gradient(circle at bottom left, rgba(255, 156, 181, 0.14), transparent 25%),
                linear-gradient(180deg, #101c31 0%, #08111d 44%, #050a12 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.22;
            background-image:
                linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 24px 24px;
            mask-image: radial-gradient(circle at center, black 35%, transparent 85%);
        }

        .shell {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 40px;
        }

        .hero {
            position: relative;
            padding: 28px;
            border: 1px solid var(--line);
            border-radius: 28px;
            background: linear-gradient(160deg, rgba(19, 32, 53, 0.88), rgba(7, 12, 23, 0.92));
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 12px;
            border: 1px solid rgba(244, 198, 106, 0.14);
            border-radius: 22px;
            pointer-events: none;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: start;
            flex-wrap: wrap;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            color: #142132;
            background: linear-gradient(135deg, #ffe4a8, #e9b25b);
            font-size: 0.78rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: 700;
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2.5rem, 7vw, 4.9rem);
            line-height: 0.92;
            letter-spacing: -0.04em;
            max-width: 8ch;
        }

        .subtitle {
            max-width: 60ch;
            margin: 0;
            color: var(--muted);
            font-size: 1.06rem;
            line-height: 1.7;
        }

        .hero-note {
            max-width: 320px;
            padding: 18px;
            border-radius: 22px;
            background: rgba(244, 198, 106, 0.10);
            border: 1px solid rgba(244, 198, 106, 0.18);
        }

        .hero-note strong {
            display: block;
            margin-bottom: 8px;
            color: var(--gold);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
        }

        .hero-note p {
            margin: 0;
            color: #f9eed1;
            line-height: 1.6;
            font-size: 0.98rem;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-top: 24px;
        }

        .stat {
            padding: 16px 18px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.09);
        }

        .stat-label {
            display: block;
            color: var(--muted);
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: clamp(1.15rem, 2vw, 1.5rem);
            font-weight: 700;
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
            gap: 22px;
            margin-top: 22px;
        }

        .panel {
            border-radius: 28px;
            border: 1px solid var(--line);
            background: var(--panel);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-inner { padding: 22px; }

        .board-wrap {
            position: relative;
            padding: 26px;
            min-height: 680px;
            background:
                radial-gradient(circle at 50% 0%, rgba(136, 236, 227, 0.18), transparent 32%),
                linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
        }

        .board-frame {
            position: relative;
            width: min(100%, 700px);
            aspect-ratio: 1 / 1.03;
            margin: 0 auto;
            border-radius: 34px;
            padding: 26px;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.04), rgba(255,255,255,0.01)),
                linear-gradient(145deg, #4d371a, #8d6530 48%, #513618);
            box-shadow:
                inset 0 2px 0 rgba(255,255,255,0.16),
                inset 0 -18px 38px rgba(0,0,0,0.28),
                0 20px 50px rgba(0,0,0,0.4);
        }

        .board {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 26px;
            background:
                radial-gradient(circle at 50% 30%, rgba(255, 232, 197, 0.18), transparent 38%),
                linear-gradient(145deg, #d9b47e, #b07f4a 58%, #8f6032 100%);
            box-shadow: inset 0 0 0 2px rgba(64, 33, 9, 0.3), inset 0 30px 60px rgba(255,255,255,0.08);
            overflow: hidden;
        }

        .board::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(80, 41, 14, 0.12) 0.8px, transparent 0.8px);
            background-size: 12px 12px;
            opacity: 0.32;
        }

        .hex-cell {
            position: absolute;
            width: 13%;
            aspect-ratio: 1 / 1;
            transform: translate(-50%, -50%);
            border: 2px solid rgba(55, 28, 11, 0.22);
            border-radius: 30%;
            background: rgba(255, 245, 220, 0.16);
            clip-path: polygon(25% 6%, 75% 6%, 98% 50%, 75% 94%, 25% 94%, 2% 50%);
            box-shadow: inset 0 3px 10px rgba(255,255,255,0.1);
        }

        .hex-cell.selected {
            border-color: rgba(244, 198, 106, 0.95);
            background: rgba(244, 198, 106, 0.22);
            box-shadow: 0 0 0 4px rgba(244, 198, 106, 0.16), inset 0 3px 10px rgba(255,255,255,0.12);
        }

        .hex-cell.targeted {
            border-color: rgba(136, 236, 227, 0.9);
            background: rgba(136, 236, 227, 0.18);
        }

        .marble {
            position: absolute;
            width: 68%;
            height: 68%;
            top: 16%;
            left: 16%;
            border-radius: 50%;
            box-shadow: inset 0 10px 16px rgba(255,255,255,0.22), inset 0 -14px 20px rgba(0,0,0,0.35), 0 8px 18px rgba(0,0,0,0.28);
        }

        .marble.black {
            background: radial-gradient(circle at 30% 24%, #5d6b85 0%, #1c2434 38%, #0b101a 78%, #04070b 100%);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .marble.white {
            background: radial-gradient(circle at 30% 24%, #fffef7 0%, #f7e8c1 40%, #d7b57f 78%, #9d754a 100%);
            border: 1px solid rgba(255,255,255,0.28);
        }

        .side-panel {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .card {
            border-radius: 24px;
            background: var(--panel-strong);
            border: 1px solid rgba(255,255,255,0.08);
            padding: 20px;
        }

        .card h2, .card h3 {
            margin: 0 0 12px;
            font-size: 1.15rem;
            letter-spacing: -0.02em;
        }

        .card p, .card li {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.98rem;
        }

        .objective {
            display: flex;
            gap: 12px;
            align-items: start;
            padding: 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .objective-badge {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(136,236,227,0.3), rgba(136,236,227,0.08));
            color: var(--teal);
            font-size: 1.3rem;
        }

        .puzzle-list {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
            margin-top: 16px;
        }

        .puzzle-chip {
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.03);
            color: var(--text);
            border-radius: 16px;
            padding: 12px 8px;
            font: inherit;
            cursor: pointer;
            transition: transform 160ms ease, border-color 160ms ease, background 160ms ease;
        }

        .puzzle-chip.active,
        .puzzle-chip:hover {
            transform: translateY(-2px);
            border-color: rgba(244, 198, 106, 0.5);
            background: rgba(244, 198, 106, 0.1);
        }

        .puzzle-chip.done {
            box-shadow: inset 0 0 0 1px rgba(136,236,227,0.45);
        }

        .controls {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 16px;
        }

        .move-btn, .secondary-btn {
            appearance: none;
            border: none;
            cursor: pointer;
            color: var(--text);
            font: inherit;
            transition: transform 160ms ease, filter 160ms ease, opacity 160ms ease;
        }

        .move-btn {
            min-height: 66px;
            border-radius: 18px;
            background: linear-gradient(160deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-direction: column;
        }

        .move-btn strong {
            font-size: 1.3rem;
            line-height: 1;
        }

        .move-btn span {
            color: var(--muted);
            font-size: 0.78rem;
        }

        .move-btn:hover, .secondary-btn:hover { transform: translateY(-2px); filter: brightness(1.05); }
        .move-btn:disabled { opacity: 0.38; cursor: not-allowed; transform: none; }

        .secondary-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
        }

        .secondary-btn {
            padding: 12px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .secondary-btn.primary {
            background: linear-gradient(135deg, #f4c66a, #d38d2c);
            color: #1b1206;
            font-weight: 700;
        }

        .log {
            margin-top: 14px;
            min-height: 66px;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(136, 236, 227, 0.08);
            border: 1px solid rgba(136, 236, 227, 0.14);
            color: #d9fff9;
        }

        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .legend-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.2);
        }

        .legend-dot.black { background: linear-gradient(135deg, #5d6b85, #0b101a); }
        .legend-dot.white { background: linear-gradient(135deg, #fffef7, #c89b6a); }
        .legend-dot.teal { background: linear-gradient(135deg, #cafffa, #2ec8bd); }

        ol.tips {
            padding-left: 18px;
            display: grid;
            gap: 10px;
            margin: 0;
        }

        .victory {
            position: absolute;
            inset: 0;
            display: none;
            place-items: center;
            background: rgba(4, 8, 15, 0.62);
            backdrop-filter: blur(6px);
        }

        .victory.show { display: grid; }

        .victory-card {
            width: min(92%, 420px);
            padding: 26px;
            border-radius: 28px;
            border: 1px solid rgba(244,198,106,0.3);
            background: linear-gradient(160deg, rgba(18, 29, 48, 0.96), rgba(9, 15, 25, 0.96));
            box-shadow: 0 26px 60px rgba(0,0,0,0.45);
            text-align: center;
        }

        .victory-card h3 {
            margin: 12px 0 10px;
            font-size: 1.7rem;
        }

        .victory-card p {
            color: var(--muted);
            margin: 0 0 16px;
            line-height: 1.6;
        }

        .spark {
            font-size: 2.1rem;
        }

        .footer-note {
            margin-top: 24px;
            color: rgba(255,255,255,0.55);
            font-size: 0.9rem;
            text-align: center;
        }

        @media (max-width: 980px) {
            .stats, .layout { grid-template-columns: 1fr; }
            .board-wrap { min-height: 560px; }
            .hero-note { max-width: none; }
        }

        @media (max-width: 640px) {
            .shell { width: min(100% - 18px, 1180px); padding-top: 16px; }
            .hero, .panel-inner, .card, .board-wrap { padding: 18px; }
            .board-frame { padding: 16px; border-radius: 24px; }
            .puzzle-list { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .controls { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            h1 { max-width: none; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="hero-top">
                <div>
                    <div class="eyebrow">Board-game daydream • sumito puzzles</div>
                    <h1>Abalone Push Lab</h1>
                    <p class="subtitle">Jon once wrote, with charming understatement, that he heard Abalone was an excellent game. Quite right. This is a jewel-box training board for the best bit of Abalone: lining up a beautiful shove and nudging your rival right off the edge.</p>
                </div>
                <aside class="hero-note">
                    <strong>How to play</strong>
                    <p>Tap one to three dark marbles that touch in a line. Then use a direction button to slide or push. If your line is longer than the enemy line in front of it, the shove goes through. Elegant. Slightly smug.</p>
                </aside>
            </div>
            <div class="stats">
                <div class="stat">
                    <span class="stat-label">Current puzzle</span>
                    <span class="stat-value" id="stat-puzzle">1 / 5</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Goal</span>
                    <span class="stat-value" id="stat-goal">Push 1 off</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Your moves</span>
                    <span class="stat-value" id="stat-moves">0</span>
                </div>
                <div class="stat">
                    <span class="stat-label">Ivory marbles ejected</span>
                    <span class="stat-value" id="stat-off">0</span>
                </div>
            </div>
        </section>

        <section class="layout">
            <div class="panel board-wrap">
                <div class="board-frame">
                    <div class="board" id="board"></div>
                </div>
                <div class="victory" id="victory">
                    <div class="victory-card">
                        <div class="spark">✨</div>
                        <h3 id="victory-title">Puzzle solved</h3>
                        <p id="victory-copy">That was a lovely little sumito. Onward.</p>
                        <div class="secondary-row" style="justify-content:center; margin-top:0;">
                            <button class="secondary-btn primary" id="next-puzzle-btn">Next puzzle</button>
                            <button class="secondary-btn" id="close-victory-btn">Stay here</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="side-panel">
                <div class="card">
                    <h2 id="puzzle-title">Puzzle 1 · Gentle Introduction</h2>
                    <div class="objective">
                        <div class="objective-badge">➜</div>
                        <div>
                            <p id="puzzle-description">Use a line of three to push a single ivory marble off the right edge.</p>
                        </div>
                    </div>

                    <div class="puzzle-list" id="puzzle-list"></div>

                    <div class="controls" id="controls"></div>
                    <div class="secondary-row">
                        <button class="secondary-btn" id="reset-btn">Reset puzzle</button>
                        <button class="secondary-btn" id="clear-btn">Clear selection</button>
                        <button class="secondary-btn primary" id="hint-btn">Hint</button>
                    </div>
                    <div class="log" id="log">Select a dark marble to begin. You can choose up to three in a straight line.</div>

                    <div class="legend">
                        <div class="legend-item"><span class="legend-dot black"></span> Your marbles</div>
                        <div class="legend-item"><span class="legend-dot white"></span> Rival marbles</div>
                        <div class="legend-item"><span class="legend-dot teal"></span> Selected lane</div>
                    </div>
                </div>

                <div class="card">
                    <h3>Why this page exists</h3>
                    <p>It is part tiny tactics trainer, part midnight board-game shrine. The look leans velvet-and-walnut on purpose: something that feels like a classic game box rediscovered in a lamp-lit study.</p>
                </div>

                <div class="card">
                    <h3>Three sly tactics</h3>
                    <ol class="tips">
                        <li>Inline attacks only work if your selected line is longer than the enemy line directly ahead.</li>
                        <li>Broadside moves are glorious for repositioning, but they do not push. Side-step first, then ram.</li>
                        <li>Edges are your friends. If a white marble has nowhere to go because the next cell is off-board, congratulations, it is gone.</li>
                    </ol>
                </div>
            </div>
        </section>

        <p class="footer-note">Inspired by Jon Aquino's post “Tom, let's have a game of Abalone sometime...” from 2004. Built as a self-contained little tactics toy for the web lab.</p>
    </div>

    <script>
        const directions = [
            { key: 'E',  label: 'East',      vector: [1, 0],  arrow: '→' },
            { key: 'NE', label: 'North-east',vector: [1, -1], arrow: '↗' },
            { key: 'NW', label: 'North-west',vector: [0, -1], arrow: '↖' },
            { key: 'W',  label: 'West',      vector: [-1, 0], arrow: '←' },
            { key: 'SW', label: 'South-west',vector: [-1, 1], arrow: '↙' },
            { key: 'SE', label: 'South-east',vector: [0, 1],  arrow: '↘' }
        ];

        const puzzles = [
            {
                title: 'Puzzle 1 · Gentle Introduction',
                description: 'Use a line of three to push a single ivory marble off the right edge.',
                goalOff: 1,
                hint: 'Select the three marbles already facing east, then shove east once.',
                marbles: {
                    '-3,0': 'black', '-2,0': 'black', '-1,0': 'black', '0,0': 'white'
                }
            },
            {
                title: 'Puzzle 2 · Clear the Shoulder',
                description: 'A side-step first, then a push. Knock one ivory marble off the upper-right lip.',
                goalOff: 1,
                hint: 'Your three-marble column can slide north-east as a broadside move before making the final shove.',
                marbles: {
                    '-2,1': 'black', '-1,1': 'black', '0,1': 'black',
                    '1,0': 'white', '2,-1': 'white',
                    '-3,2': 'black'
                }
            },
            {
                title: 'Puzzle 3 · Double Pressure',
                description: 'Only a three-marble line can move two rivals. Drive both ivory marbles off the east edge in one glorious sumito.',
                goalOff: 2,
                hint: 'You need the full line of three. Two marbles are not enough to push two.',
                marbles: {
                    '-2,0': 'black', '-1,0': 'black', '0,0': 'black', '1,0': 'white', '2,0': 'white',
                    '-1,-1': 'black'
                }
            },
            {
                title: 'Puzzle 4 · Walnut Switchback',
                description: 'Untangle the lane and eject one marble off the lower-right side.',
                goalOff: 1,
                hint: 'A south-east step with the diagonal pair opens the final lane.',
                marbles: {
                    '-1,-1': 'black', '0,-1': 'black', '1,-1': 'black',
                    '0,0': 'black',
                    '2,-1': 'white', '2,0': 'white', '1,1': 'white'
                }
            },
            {
                title: 'Puzzle 5 · Study Champion',
                description: 'A proper little finale. Reposition, then deliver two clean ejections to finish the set.',
                goalOff: 2,
                hint: 'Think in phases: first line up the centre trio, then keep the pressure on the same lane.',
                marbles: {
                    '-2,1': 'black', '-1,1': 'black', '0,1': 'black',
                    '-1,0': 'black', '0,0': 'black',
                    '1,0': 'white', '2,-1': 'white', '1,1': 'white',
                    '2,0': 'white'
                }
            }
        ];

        const board = document.getElementById('board');
        const puzzleList = document.getElementById('puzzle-list');
        const logEl = document.getElementById('log');
        const controlsEl = document.getElementById('controls');
        const victoryEl = document.getElementById('victory');
        const victoryTitleEl = document.getElementById('victory-title');
        const victoryCopyEl = document.getElementById('victory-copy');

        const state = {
            currentPuzzle: 0,
            selection: [],
            marbles: {},
            moves: 0,
            offCount: 0,
            solved: new Set()
        };

        function coordKey(q, r) {
            return `${q},${r}`;
        }

        function parseKey(key) {
            return key.split(',').map(Number);
        }

        function isOnBoard(q, r) {
            const s = -q - r;
            return Math.max(Math.abs(q), Math.abs(r), Math.abs(s)) <= 4;
        }

        function neighbor([q, r], [dq, dr]) {
            return [q + dq, r + dr];
        }

        function cellCenter(q, r) {
            const x = q + r / 2;
            const y = r * Math.sqrt(3) / 2;
            const minX = -4 - 2;
            const maxX = 4 + 2;
            const minY = -4 * Math.sqrt(3) / 2;
            const maxY = 4 * Math.sqrt(3) / 2;
            const xPct = ((x - minX) / (maxX - minX)) * 100;
            const yPct = ((y - minY) / (maxY - minY)) * 100;
            return { x: xPct, y: yPct };
        }

        function cloneMarbles(marbles) {
            return Object.fromEntries(Object.entries(marbles));
        }

        function loadPuzzle(index) {
            const puzzle = puzzles[index];
            state.currentPuzzle = index;
            state.selection = [];
            state.marbles = cloneMarbles(puzzle.marbles);
            state.moves = 0;
            state.offCount = 0;
            victoryEl.classList.remove('show');
            updateMeta();
            renderPuzzleChips();
            renderBoard();
            setLog('Select a dark marble to begin. You can choose up to three in a straight line.');
        }

        function updateMeta() {
            const puzzle = puzzles[state.currentPuzzle];
            document.getElementById('puzzle-title').textContent = puzzle.title;
            document.getElementById('puzzle-description').textContent = puzzle.description;
            document.getElementById('stat-puzzle').textContent = `${state.currentPuzzle + 1} / ${puzzles.length}`;
            document.getElementById('stat-goal').textContent = `Push ${puzzle.goalOff} off`;
            document.getElementById('stat-moves').textContent = state.moves;
            document.getElementById('stat-off').textContent = state.offCount;
        }

        function renderPuzzleChips() {
            puzzleList.innerHTML = '';
            puzzles.forEach((puzzle, index) => {
                const btn = document.createElement('button');
                btn.className = 'puzzle-chip';
                if (index === state.currentPuzzle) btn.classList.add('active');
                if (state.solved.has(index)) btn.classList.add('done');
                btn.textContent = index + 1;
                btn.addEventListener('click', () => loadPuzzle(index));
                puzzleList.appendChild(btn);
            });
        }

        function renderBoard() {
            board.innerHTML = '';
            for (let r = -4; r <= 4; r++) {
                for (let q = -4; q <= 4; q++) {
                    if (!isOnBoard(q, r)) continue;
                    const key = coordKey(q, r);
                    const cell = document.createElement('button');
                    cell.type = 'button';
                    cell.className = 'hex-cell';
                    if (state.selection.includes(key)) cell.classList.add('selected');
                    const { x, y } = cellCenter(q, r);
                    cell.style.left = `${x}%`;
                    cell.style.top = `${y}%`;
                    cell.addEventListener('click', () => onCellClick(key));

                    const marbleColor = state.marbles[key];
                    if (marbleColor) {
                        const marble = document.createElement('div');
                        marble.className = `marble ${marbleColor}`;
                        cell.appendChild(marble);
                    }
                    board.appendChild(cell);
                }
            }
            renderControls();
        }

        function renderControls() {
            controlsEl.innerHTML = '';
            directions.forEach((dir) => {
                const btn = document.createElement('button');
                btn.className = 'move-btn';
                btn.disabled = state.selection.length === 0;
                btn.innerHTML = `<strong>${dir.arrow}</strong><span>${dir.label}</span>`;
                btn.addEventListener('click', () => performMove(dir.vector, dir.label));
                controlsEl.appendChild(btn);
            });
        }

        function onCellClick(key) {
            if (state.marbles[key] !== 'black') {
                if (state.selection.includes(key)) {
                    state.selection = state.selection.filter((item) => item !== key);
                    renderBoard();
                }
                return;
            }

            if (state.selection.includes(key)) {
                state.selection = state.selection.filter((item) => item !== key);
                renderBoard();
                setLog('Selection updated.');
                return;
            }

            if (state.selection.length >= 3) {
                setLog('Three marbles is the maximum. Abalone is strict that way.');
                return;
            }

            const candidate = [...state.selection, key];
            if (!isValidSelection(candidate)) {
                setLog('Those marbles must touch and form a straight line.');
                return;
            }

            state.selection = candidate;
            renderBoard();
            setLog(selectionMessage());
        }

        function selectionMessage() {
            if (state.selection.length === 0) return 'Selection cleared.';
            if (state.selection.length === 1) return 'One marble selected. Add neighbours in a straight line or move it now.';
            return `${state.selection.length} marbles selected. Choose a direction.`;
        }

        function isValidSelection(selection) {
            if (selection.length <= 1) return true;
            const coords = selection.map(parseKey);
            for (let i = 1; i < coords.length; i++) {
                if (!areAdjacent(coords[i - 1], coords[i], coords)) {
                    // adjacency tested later after line sort
                }
            }
            if (selection.length === 2) {
                return areNeighbors(coords[0], coords[1]);
            }
            const lineDir = getLineDirection(coords);
            if (!lineDir) return false;
            const sorted = sortLine(coords, lineDir);
            for (let i = 1; i < sorted.length; i++) {
                const prev = sorted[i - 1];
                const current = sorted[i];
                if (current[0] !== prev[0] + lineDir[0] || current[1] !== prev[1] + lineDir[1]) return false;
            }
            return true;
        }

        function areNeighbors(a, b) {
            return directions.some(({ vector }) => a[0] + vector[0] === b[0] && a[1] + vector[1] === b[1]);
        }

        function areAdjacent(a, b) {
            return areNeighbors(a, b);
        }

        function getLineDirection(coords) {
            const possible = directions.map((d) => d.vector);
            for (const dir of possible) {
                const sorted = sortLine(coords, dir);
                let ok = true;
                for (let i = 1; i < sorted.length; i++) {
                    const prev = sorted[i - 1];
                    const current = sorted[i];
                    if (current[0] !== prev[0] + dir[0] || current[1] !== prev[1] + dir[1]) {
                        ok = false;
                        break;
                    }
                }
                if (ok) return dir;
            }
            return null;
        }

        function sortLine(coords, dir) {
            const score = ([q, r]) => q * dir[0] + r * dir[1];
            return [...coords].sort((a, b) => score(a) - score(b));
        }

        function performMove(vector, label) {
            if (state.selection.length === 0) {
                setLog('Select something first. The marbles will not read your mind.');
                return;
            }
            const coords = state.selection.map(parseKey);
            const lineDir = state.selection.length > 1 ? getLineDirection(coords) : null;
            const inline = lineDir && (sameVector(lineDir, vector) || sameVector(negate(lineDir), vector));
            const result = inline ? attemptInlineMove(coords, vector) : attemptBroadsideMove(coords, vector);
            if (!result.ok) {
                setLog(result.message);
                return;
            }
            state.marbles = result.marbles;
            state.selection = result.selection;
            state.moves += 1;
            state.offCount += result.off || 0;
            updateMeta();
            renderBoard();
            setLog(result.message || `Moved ${label}.`);
            checkVictory();
        }

        function attemptBroadsideMove(coords, vector) {
            const nextCoords = coords.map((coord) => neighbor(coord, vector));
            for (const [q, r] of nextCoords) {
                if (!isOnBoard(q, r)) return { ok: false, message: 'Broadside moves must stay on the board.' };
                const occupant = state.marbles[coordKey(q, r)];
                if (occupant) return { ok: false, message: 'That side-step lane is blocked.' };
            }
            const marbles = cloneMarbles(state.marbles);
            coords.forEach(([q, r]) => delete marbles[coordKey(q, r)]);
            nextCoords.forEach(([q, r]) => { marbles[coordKey(q, r)] = 'black'; });
            return {
                ok: true,
                marbles,
                selection: nextCoords.map(([q, r]) => coordKey(q, r)),
                off: 0,
                message: 'Clean side-step. Sometimes elegance comes before violence.'
            };
        }

        function attemptInlineMove(coords, vector) {
            const dir = vector;
            const sorted = sortLine(coords, dir);
            const front = sorted[sorted.length - 1];
            const behind = sorted[0];
            const marbles = cloneMarbles(state.marbles);
            const enemyChain = [];

            let cursor = neighbor(front, dir);
            while (isOnBoard(cursor[0], cursor[1]) && marbles[coordKey(cursor[0], cursor[1])] === 'white') {
                enemyChain.push([...cursor]);
                cursor = neighbor(cursor, dir);
            }

            const nextKey = isOnBoard(cursor[0], cursor[1]) ? coordKey(cursor[0], cursor[1]) : null;
            const nextOccupant = nextKey ? marbles[nextKey] : null;

            if (enemyChain.length === 0) {
                const target = neighbor(front, dir);
                if (!isOnBoard(target[0], target[1])) return { ok: false, message: 'You cannot glide off the board yourself. Very dramatic, but illegal.' };
                if (marbles[coordKey(target[0], target[1])]) return { ok: false, message: 'That lane is blocked.' };
                coords.forEach(([q, r]) => delete marbles[coordKey(q, r)]);
                sorted.forEach(([q, r]) => {
                    const moved = neighbor([q, r], dir);
                    marbles[coordKey(moved[0], moved[1])] = 'black';
                });
                return {
                    ok: true,
                    marbles,
                    selection: sorted.map((coord) => neighbor(coord, dir)).map(([q, r]) => coordKey(q, r)),
                    off: 0,
                    message: 'The line advances.'
                };
            }

            if (enemyChain.length >= sorted.length) {
                return { ok: false, message: 'You need a longer line than the one you are pushing.' };
            }

            if (nextOccupant === 'black') {
                return { ok: false, message: 'Your own marble is bracing the enemy. No push there.' };
            }

            let off = 0;
            coords.forEach(([q, r]) => delete marbles[coordKey(q, r)]);
            enemyChain.slice().reverse().forEach(([q, r]) => delete marbles[coordKey(q, r)]);

            const enemyTargets = enemyChain.map((coord) => neighbor(coord, dir));
            enemyTargets.forEach(([q, r]) => {
                if (isOnBoard(q, r)) {
                    marbles[coordKey(q, r)] = 'white';
                } else {
                    off += 1;
                }
            });

            sorted.forEach(([q, r]) => {
                const moved = neighbor([q, r], dir);
                marbles[coordKey(moved[0], moved[1])] = 'black';
            });

            return {
                ok: true,
                marbles,
                selection: sorted.map((coord) => neighbor(coord, dir)).map(([q, r]) => coordKey(q, r)),
                off,
                message: off > 0 ? `Sumito! You shoved ${off} ivory marble${off > 1 ? 's' : ''} off the board.` : 'The enemy line gives ground.'
            };
        }

        function sameVector(a, b) {
            return a[0] === b[0] && a[1] === b[1];
        }

        function negate([q, r]) {
            return [-q, -r];
        }

        function checkVictory() {
            const puzzle = puzzles[state.currentPuzzle];
            if (state.offCount >= puzzle.goalOff) {
                state.solved.add(state.currentPuzzle);
                renderPuzzleChips();
                victoryTitleEl.textContent = state.currentPuzzle === puzzles.length - 1 ? 'Set complete' : 'Puzzle solved';
                victoryCopyEl.textContent = state.currentPuzzle === puzzles.length - 1
                    ? `You cleared the whole study set in ${state.moves} move${state.moves === 1 ? '' : 's'} on this final board. Honestly, rather elegant.`
                    : `You solved ${puzzle.title} in ${state.moves} move${state.moves === 1 ? '' : 's'}. Ready for the next little duel?`;
                victoryEl.classList.add('show');
            }
        }

        function setLog(message) {
            logEl.textContent = message;
        }

        document.getElementById('reset-btn').addEventListener('click', () => loadPuzzle(state.currentPuzzle));
        document.getElementById('clear-btn').addEventListener('click', () => {
            state.selection = [];
            renderBoard();
            setLog('Selection cleared.');
        });
        document.getElementById('hint-btn').addEventListener('click', () => {
            setLog(`Hint: ${puzzles[state.currentPuzzle].hint}`);
        });
        document.getElementById('next-puzzle-btn').addEventListener('click', () => {
            victoryEl.classList.remove('show');
            const next = (state.currentPuzzle + 1) % puzzles.length;
            loadPuzzle(next);
        });
        document.getElementById('close-victory-btn').addEventListener('click', () => {
            victoryEl.classList.remove('show');
        });

        loadPuzzle(0);
    </script>
</body>
</html>
