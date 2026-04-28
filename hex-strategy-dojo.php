<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Hex Strategy Dojo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=Source+Sans+3:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --wood-dark: #2a1f14;
            --wood-mid: #3d2b1f;
            --wood-light: #5c4033;
            --amber: #d4a03c;
            --amber-glow: #f0c050;
            --amber-dark: #a67c2e;
            --slate: #4a6fa5;
            --slate-glow: #6b9bd8;
            --slate-dark: #36547a;
            --cream: #f5f0e8;
            --cream-dark: #e8e0d4;
            --text: #1a1510;
            --text-muted: #6b5d4f;
            --accent: #c17f4e;
            --success: #5a8f5a;
            --danger: #a05050;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Source Sans 3', sans-serif;
            background: var(--wood-dark);
            color: var(--cream);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }

        .grain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            z-index: 1000;
        }

        header {
            text-align: center;
            padding: 1.5rem 1rem 0.5rem;
            position: relative;
            z-index: 10;
        }

        h1 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--amber);
            letter-spacing: 0.05em;
            text-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }

        .subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 0.3rem;
            font-weight: 300;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .game-meta {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 0.8rem 0;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .meta-item .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-amber { background: var(--amber); box-shadow: 0 0 6px var(--amber-glow); }
        .dot-slate { background: var(--slate); box-shadow: 0 0 6px var(--slate-glow); }

        .controls {
            display: flex;
            gap: 0.6rem;
            justify-content: center;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
            padding: 0 1rem;
        }

        .btn {
            font-family: 'Source Sans 3', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            background: var(--wood-light);
            color: var(--cream);
            border: 1px solid rgba(212, 160, 60, 0.2);
        }

        .btn:hover {
            background: var(--amber);
            color: var(--wood-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(212, 160, 60, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn.active {
            background: var(--amber);
            color: var(--wood-dark);
        }

        .turn-indicator {
            text-align: center;
            margin: 0.5rem 0;
            font-size: 1.1rem;
            font-weight: 600;
            min-height: 1.8rem;
            transition: all 0.3s ease;
        }

        .turn-amber { color: var(--amber-glow); text-shadow: 0 0 12px rgba(240, 192, 80, 0.4); }
        .turn-slate { color: var(--slate-glow); text-shadow: 0 0 12px rgba(107, 155, 216, 0.4); }
        .turn-win { color: var(--success); text-shadow: 0 0 16px rgba(90, 143, 90, 0.5); animation: winPulse 1.5s ease-in-out infinite; }

        @keyframes winPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.03); }
        }

        .board-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }

        #board {
            filter: drop-shadow(0 8px 24px rgba(0,0,0,0.6));
        }

        .hex {
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .hex-empty {
            fill: var(--wood-mid);
            stroke: var(--wood-light);
            stroke-width: 1.5;
        }

        .hex-empty:hover {
            fill: var(--wood-light);
            stroke: var(--amber);
            stroke-width: 2;
            filter: drop-shadow(0 0 4px rgba(212, 160, 60, 0.3));
        }

        .hex-amber {
            fill: var(--amber);
            stroke: var(--amber-dark);
            stroke-width: 1.5;
            animation: placeStone 0.3s ease-out;
        }

        .hex-slate {
            fill: var(--slate);
            stroke: var(--slate-dark);
            stroke-width: 1.5;
            animation: placeStone 0.3s ease-out;
        }

        .hex-amber.win-path {
            fill: var(--amber-glow);
            stroke: #fff;
            stroke-width: 2;
            filter: drop-shadow(0 0 8px var(--amber-glow));
        }

        .hex-slate.win-path {
            fill: var(--slate-glow);
            stroke: #fff;
            stroke-width: 2;
            filter: drop-shadow(0 0 8px var(--slate-glow));
        }

        @keyframes placeStone {
            0% { transform: scale(0); opacity: 0; }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); opacity: 1; }
        }

        .edge-label {
            font-family: 'Cormorant Garamond', serif;
            font-size: 12px;
            font-weight: 600;
            fill: var(--text-muted);
            opacity: 0.7;
            pointer-events: none;
        }

        .info-panel {
            background: rgba(42, 31, 20, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(212, 160, 60, 0.15);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin: 0 1rem 1rem;
            max-width: 500px;
            text-align: center;
        }

        .info-panel h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            color: var(--amber);
            margin-bottom: 0.4rem;
        }

        .info-panel p {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .swap-btn {
            background: rgba(212, 160, 60, 0.15);
            border: 1px dashed var(--amber);
            color: var(--amber);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
            transition: all 0.2s ease;
            display: none;
        }

        .swap-btn.visible {
            display: inline-block;
        }

        .swap-btn:hover {
            background: var(--amber);
            color: var(--wood-dark);
        }

        .ai-thinking {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(42, 31, 20, 0.95);
            border: 1px solid var(--amber);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
            color: var(--amber);
            z-index: 100;
            display: none;
            box-shadow: 0 8px 32px rgba(0,0,0,0.5);
        }

        .ai-thinking.active {
            display: block;
            animation: thinkingPulse 1s ease-in-out infinite;
        }

        @keyframes thinkingPulse {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }

        footer {
            text-align: center;
            padding: 1rem;
            font-size: 0.75rem;
            color: var(--text-muted);
            opacity: 0.6;
        }

        footer a {
            color: var(--amber);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 0.5rem 0;
            font-size: 0.85rem;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            display: block;
        }

        .stat-label {
            font-size: 0.7rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 200;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: var(--wood-mid);
            border: 1px solid var(--amber);
            border-radius: 16px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.6);
            animation: modalIn 0.3s ease-out;
        }

        @keyframes modalIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            color: var(--amber);
            margin-bottom: 0.5rem;
        }

        .modal p {
            color: var(--cream-dark);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .modal-buttons {
            display: flex;
            gap: 0.8rem;
            justify-content: center;
        }

        @media (max-width: 480px) {
            h1 { font-size: 1.6rem; }
            .game-meta { gap: 0.8rem; }
            .controls { gap: 0.4rem; }
            .btn { padding: 0.4rem 0.7rem; font-size: 0.7rem; }
        }
    </style>
</head>
<body>
    <div class="grain"></div>

    <header>
        <h1>Hex Strategy Dojo</h1>
        <div class="subtitle">The Abstract Connection Game</div>
        <div class="game-meta">
            <div class="meta-item">
                <span class="dot dot-amber"></span>
                <span>Amber connects Top to Bottom</span>
            </div>
            <div class="meta-item">
                <span class="dot dot-slate"></span>
                <span>Slate connects Left to Right</span>
            </div>
        </div>
    </header>

    <div class="controls">
        <button class="btn" id="btn-new">New Game</button>
        <button class="btn active" id="btn-pvp" onclick="setMode('pvp')">2 Player</button>
        <button class="btn" id="btn-ai" onclick="setMode('ai')">vs AI</button>
        <button class="btn" id="btn-size" onclick="cycleSize()">Board: 11</button>
        <button class="btn" id="btn-undo" onclick="undo()">Undo</button>
    </div>

    <div class="stats">
        <div class="stat">
            <span class="stat-value" id="stat-amber">0</span>
            <span class="stat-label">Amber Wins</span>
        </div>
        <div class="stat">
            <span class="stat-value" id="stat-slate">0</span>
            <span class="stat-label">Slate Wins</span>
        </div>
    </div>

    <div class="turn-indicator" id="turn-indicator">Amber's Turn</div>

    <div class="board-container">
        <div class="ai-thinking" id="ai-thinking">AI is contemplating...</div>
        <svg id="board"></svg>
    </div>

    <div class="info-panel">
        <h3>How to Play</h3>
        <p>Take turns placing a stone on any empty hex. Amber wins by connecting the top edge to the bottom edge. Slate wins by connecting the left edge to the right edge. The first player to create an unbroken chain across the board wins. Hex cannot end in a draw!</p>
        <button class="swap-btn" id="swap-btn" onclick="swapColors()">Swap Colors (Pie Rule)</button>
    </div>

    <div class="modal-overlay" id="win-modal">
        <div class="modal">
            <h2 id="win-title">Amber Wins!</h2>
            <p id="win-message">An unbroken chain spans the board.</p>
            <div class="modal-buttons">
                <button class="btn" onclick="newGame()">Play Again</button>
            </div>
        </div>
    </div>

    <footer>
        <p>Built for Jon. Inspired by his <a href="https://jona.ca/2004/09/abstract-board-game-hex.html">2004 post on Hex</a>.</p>
        <p>Part of <a href="index.php">Chloe Reads Jon</a></p>
    </footer>

    <script>
        // Game State
        const STATE = {
            board: [],
            size: 11,
            currentPlayer: 'amber',
            mode: 'pvp', // 'pvp' or 'ai'
            gameOver: false,
            moveHistory: [],
            swapAvailable: true,
            stats: { amber: 0, slate: 0 }
        };

        const HEX_SIZE = 26;
        const HEX_WIDTH = Math.sqrt(3) * HEX_SIZE;
        const HEX_HEIGHT = 2 * HEX_SIZE;
        const HEX_VERT = HEX_HEIGHT * 0.75;

        function initBoard() {
            STATE.board = [];
            for (let r = 0; r < STATE.size; r++) {
                STATE.board[r] = [];
                for (let c = 0; c < STATE.size; c++) {
                    STATE.board[r][c] = null;
                }
            }
            STATE.currentPlayer = 'amber';
            STATE.gameOver = false;
            STATE.moveHistory = [];
            STATE.swapAvailable = true;
            updateSwapButton();
            updateTurnIndicator();
            renderBoard();
        }

        function getHexCenter(r, c) {
            const x = c * HEX_WIDTH + (r % 2) * (HEX_WIDTH / 2) + HEX_WIDTH;
            const y = r * HEX_VERT + HEX_HEIGHT;
            return { x, y };
        }

        function getHexPoints(cx, cy, size) {
            const points = [];
            for (let i = 0; i < 6; i++) {
                const angle = (Math.PI / 3) * i - Math.PI / 6;
                points.push(`${cx + size * Math.cos(angle)},${cy + size * Math.sin(angle)}`);
            }
            return points.join(' ');
        }

        function renderBoard() {
            const svg = document.getElementById('board');
            svg.innerHTML = '';

            const boardWidth = STATE.size * HEX_WIDTH + HEX_WIDTH / 2 + HEX_WIDTH * 2;
            const boardHeight = STATE.size * HEX_VERT + HEX_HEIGHT + HEX_HEIGHT;
            svg.setAttribute('width', boardWidth);
            svg.setAttribute('height', boardHeight);
            svg.setAttribute('viewBox', `0 0 ${boardWidth} ${boardHeight}`);

            // Edge labels
            const labelStyle = `font-family:'Cormorant Garamond',serif;font-size:12px;font-weight:600;fill:#6b5d4f;opacity:0.6;`;

            // Top edge labels
            for (let c = 0; c < STATE.size; c++) {
                const { x, y } = getHexCenter(0, c);
                const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                label.setAttribute('x', x);
                label.setAttribute('y', y - HEX_SIZE - 4);
                label.setAttribute('text-anchor', 'middle');
                label.setAttribute('style', labelStyle);
                label.textContent = String.fromCharCode(65 + c);
                svg.appendChild(label);
            }

            // Bottom edge labels
            for (let c = 0; c < STATE.size; c++) {
                const { x, y } = getHexCenter(STATE.size - 1, c);
                const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                label.setAttribute('x', x);
                label.setAttribute('y', y + HEX_SIZE + 14);
                label.setAttribute('text-anchor', 'middle');
                label.setAttribute('style', labelStyle);
                label.textContent = String.fromCharCode(65 + c);
                svg.appendChild(label);
            }

            // Left edge labels
            for (let r = 0; r < STATE.size; r++) {
                const { x, y } = getHexCenter(r, 0);
                const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                label.setAttribute('x', x - HEX_WIDTH / 2 - 8);
                label.setAttribute('y', y + 4);
                label.setAttribute('text-anchor', 'end');
                label.setAttribute('style', labelStyle);
                label.textContent = r + 1;
                svg.appendChild(label);
            }

            // Right edge labels
            for (let r = 0; r < STATE.size; r++) {
                const { x, y } = getHexCenter(r, STATE.size - 1);
                const label = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                label.setAttribute('x', x + HEX_WIDTH / 2 + 8);
                label.setAttribute('y', y + 4);
                label.setAttribute('text-anchor', 'start');
                label.setAttribute('style', labelStyle);
                label.textContent = r + 1;
                svg.appendChild(label);
            }

            // Hexagons
            for (let r = 0; r < STATE.size; r++) {
                for (let c = 0; c < STATE.size; c++) {
                    const { x, y } = getHexCenter(r, c);
                    const hex = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                    hex.setAttribute('points', getHexPoints(x, y, HEX_SIZE - 1));

                    const value = STATE.board[r][c];
                    if (value === 'amber') {
                        hex.setAttribute('class', 'hex hex-amber');
                    } else if (value === 'slate') {
                        hex.setAttribute('class', 'hex hex-slate');
                    } else {
                        hex.setAttribute('class', 'hex hex-empty');
                        if (!STATE.gameOver) {
                            hex.addEventListener('click', () => handleHexClick(r, c));
                            hex.addEventListener('touchstart', (e) => {
                                e.preventDefault();
                                handleHexClick(r, c);
                            });
                        }
                    }

                    hex.dataset.r = r;
                    hex.dataset.c = c;
                    svg.appendChild(hex);
                }
            }

            // Edge markers for Amber (top/bottom)
            for (let c = 0; c < STATE.size; c++) {
                const top = getHexCenter(0, c);
                const bot = getHexCenter(STATE.size - 1, c);

                const markerTop = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                markerTop.setAttribute('points', getHexPoints(top.x, top.y - HEX_SIZE - 2, 5));
                markerTop.setAttribute('fill', 'var(--amber)');
                markerTop.setAttribute('opacity', '0.4');
                svg.appendChild(markerTop);

                const markerBot = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                markerBot.setAttribute('points', getHexPoints(bot.x, bot.y + HEX_SIZE + 2, 5));
                markerBot.setAttribute('fill', 'var(--amber)');
                markerBot.setAttribute('opacity', '0.4');
                svg.appendChild(markerBot);
            }

            // Edge markers for Slate (left/right)
            for (let r = 0; r < STATE.size; r++) {
                const left = getHexCenter(r, 0);
                const right = getHexCenter(r, STATE.size - 1);

                const markerLeft = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                markerLeft.setAttribute('points', getHexPoints(left.x - HEX_WIDTH / 2 - 2, left.y, 5));
                markerLeft.setAttribute('fill', 'var(--slate)');
                markerLeft.setAttribute('opacity', '0.4');
                svg.appendChild(markerLeft);

                const markerRight = document.createElementNS('http://www.w3.org/2000/svg', 'polygon');
                markerRight.setAttribute('points', getHexPoints(right.x + HEX_WIDTH / 2 + 2, right.y, 5));
                markerRight.setAttribute('fill', 'var(--slate)');
                markerRight.setAttribute('opacity', '0.4');
                svg.appendChild(markerRight);
            }
        }

        function getNeighbors(r, c) {
            const neighbors = [];
            const isEven = r % 2 === 0;
            const dirs = isEven
                ? [[-1, -1], [-1, 0], [0, -1], [0, 1], [1, -1], [1, 0]]
                : [[-1, 0], [-1, 1], [0, -1], [0, 1], [1, 0], [1, 1]];
            for (const [dr, dc] of dirs) {
                const nr = r + dr, nc = c + dc;
                if (nr >= 0 && nr < STATE.size && nc >= 0 && nc < STATE.size) {
                    neighbors.push([nr, nc]);
                }
            }
            return neighbors;
        }

        function checkWin(player) {
            // Amber: top (r=0) to bottom (r=size-1)
            // Slate: left (c=0) to right (c=size-1)

            const visited = new Set();
            const queue = [];
            const path = new Map();

            if (player === 'amber') {
                for (let c = 0; c < STATE.size; c++) {
                    if (STATE.board[0][c] === 'amber') {
                        queue.push([0, c]);
                        visited.add(`0,${c}`);
                        path.set(`0,${c}`, null);
                    }
                }

                while (queue.length > 0) {
                    const [r, c] = queue.shift();
                    if (r === STATE.size - 1) {
                        // Found a winning path - reconstruct it
                        const winPath = [];
                        let key = `${r},${c}`;
                        while (key !== null) {
                            const [pr, pc] = key.split(',').map(Number);
                            winPath.push([pr, pc]);
                            key = path.get(key);
                        }
                        return winPath;
                    }

                    for (const [nr, nc] of getNeighbors(r, c)) {
                        const nkey = `${nr},${nc}`;
                        if (!visited.has(nkey) && STATE.board[nr][nc] === 'amber') {
                            visited.add(nkey);
                            path.set(nkey, `${r},${c}`);
                            queue.push([nr, nc]);
                        }
                    }
                }
            } else {
                for (let r = 0; r < STATE.size; r++) {
                    if (STATE.board[r][0] === 'slate') {
                        queue.push([r, 0]);
                        visited.add(`${r},0`);
                        path.set(`${r},0`, null);
                    }
                }

                while (queue.length > 0) {
                    const [r, c] = queue.shift();
                    if (c === STATE.size - 1) {
                        const winPath = [];
                        let key = `${r},${c}`;
                        while (key !== null) {
                            const [pr, pc] = key.split(',').map(Number);
                            winPath.push([pr, pc]);
                            key = path.get(key);
                        }
                        return winPath;
                    }

                    for (const [nr, nc] of getNeighbors(r, c)) {
                        const nkey = `${nr},${nc}`;
                        if (!visited.has(nkey) && STATE.board[nr][nc] === 'slate') {
                            visited.add(nkey);
                            path.set(nkey, `${r},${c}`);
                            queue.push([nr, nc]);
                        }
                    }
                }
            }

            return null;
        }

        function highlightWinPath(path, player) {
            const svg = document.getElementById('board');
            const hexes = svg.querySelectorAll('.hex');
            const pathSet = new Set(path.map(([r, c]) => `${r},${c}`));

            hexes.forEach(hex => {
                const r = parseInt(hex.dataset.r);
                const c = parseInt(hex.dataset.c);
                if (pathSet.has(`${r},${c}`)) {
                    hex.classList.add('win-path');
                }
            });
        }

        function handleHexClick(r, c) {
            if (STATE.gameOver) return;
            if (STATE.board[r][c] !== null) return;

            STATE.board[r][c] = STATE.currentPlayer;
            STATE.moveHistory.push({ r, c, player: STATE.currentPlayer });
            STATE.swapAvailable = false;
            updateSwapButton();

            // Check win
            const winPath = checkWin(STATE.currentPlayer);
            if (winPath) {
                STATE.gameOver = true;
                STATE.stats[STATE.currentPlayer]++;
                updateStats();
                renderBoard();
                highlightWinPath(winPath, STATE.currentPlayer);
                showWin(STATE.currentPlayer);
                return;
            }

            // Switch player
            STATE.currentPlayer = STATE.currentPlayer === 'amber' ? 'slate' : 'amber';
            updateTurnIndicator();
            renderBoard();

            // AI turn
            if (STATE.mode === 'ai' && STATE.currentPlayer === 'slate' && !STATE.gameOver) {
                setTimeout(() => aiMove(), 400);
            }
        }

        function aiMove() {
            if (STATE.gameOver) return;

            document.getElementById('ai-thinking').classList.add('active');

            setTimeout(() => {
                const move = findBestMove();
                if (move) {
                    const { r, c } = move;
                    STATE.board[r][c] = 'slate';
                    STATE.moveHistory.push({ r, c, player: 'slate' });
                    STATE.swapAvailable = false;
                    updateSwapButton();

                    const winPath = checkWin('slate');
                    if (winPath) {
                        STATE.gameOver = true;
                        STATE.stats.slate++;
                        updateStats();
                        renderBoard();
                        highlightWinPath(winPath, 'slate');
                        showWin('slate');
                        document.getElementById('ai-thinking').classList.remove('active');
                        return;
                    }

                    STATE.currentPlayer = 'amber';
                    updateTurnIndicator();
                    renderBoard();
                }
                document.getElementById('ai-thinking').classList.remove('active');
            }, 600);
        }

        function findBestMove() {
            const emptyCells = [];
            for (let r = 0; r < STATE.size; r++) {
                for (let c = 0; c < STATE.size; c++) {
                    if (STATE.board[r][c] === null) {
                        emptyCells.push({ r, c });
                    }
                }
            }

            if (emptyCells.length === 0) return null;

            // First move: center-ish or corner strategy
            if (STATE.moveHistory.length === 1) {
                const center = Math.floor(STATE.size / 2);
                if (STATE.board[center][center] === null) {
                    return { r: center, c: center };
                }
            }

            let bestMove = null;
            let bestScore = -Infinity;

            for (const cell of emptyCells) {
                let score = 0;
                const { r, c } = cell;

                // Prefer cells closer to center
                const centerDist = Math.abs(r - STATE.size / 2) + Math.abs(c - STATE.size / 2);
                score -= centerDist * 2;

                // Count adjacent own stones (extending connections)
                for (const [nr, nc] of getNeighbors(r, c)) {
                    if (STATE.board[nr][nc] === 'slate') {
                        score += 15;
                    } else if (STATE.board[nr][nc] === 'amber') {
                        score += 3; // Also good to be near opponent (blocking potential)
                    }
                }

                // Check if this move would win
                STATE.board[r][c] = 'slate';
                if (checkWin('slate')) {
                    score += 10000;
                }
                STATE.board[r][c] = null;

                // Check if this blocks opponent's win
                STATE.board[r][c] = 'amber';
                if (checkWin('amber')) {
                    score += 5000; // Blocking is very important
                }
                STATE.board[r][c] = null;

                // Prefer cells on the shortest path between left and right edges
                const colProgress = c;
                score += colProgress * 1.5;

                // Favor bridge patterns (two adjacent empty cells between two own stones)
                for (const [nr, nc] of getNeighbors(r, c)) {
                    if (STATE.board[nr][nc] === 'slate') {
                        for (const [nnr, nnc] of getNeighbors(nr, nc)) {
                            if (nnr !== r || nnc !== c) {
                                if (STATE.board[nnr][nnc] === 'slate') {
                                    // Check if this cell completes a connection between two slate cells
                                    const dist = Math.abs(r - nnr) + Math.abs(c - nnc);
                                    if (dist <= 2) {
                                        score += 8;
                                    }
                                }
                            }
                        }
                    }
                }

                // Slight randomization to avoid predictable patterns
                score += Math.random() * 5;

                if (score > bestScore) {
                    bestScore = score;
                    bestMove = cell;
                }
            }

            return bestMove;
        }

        function swapColors() {
            if (!STATE.swapAvailable || STATE.moveHistory.length !== 1) return;
            if (STATE.mode === 'ai') return; // No swap in AI mode

            const firstMove = STATE.moveHistory[0];
            STATE.board[firstMove.r][firstMove.c] = 'slate';
            STATE.moveHistory[0].player = 'slate';
            STATE.currentPlayer = 'amber';
            STATE.swapAvailable = false;
            updateSwapButton();
            updateTurnIndicator();
            renderBoard();
        }

        function updateSwapButton() {
            const btn = document.getElementById('swap-btn');
            if (STATE.swapAvailable && STATE.moveHistory.length === 1 && STATE.mode === 'pvp') {
                btn.classList.add('visible');
            } else {
                btn.classList.remove('visible');
            }
        }

        function updateTurnIndicator() {
            const el = document.getElementById('turn-indicator');
            if (STATE.gameOver) {
                el.className = 'turn-indicator turn-win';
                el.textContent = 'Game Over!';
            } else {
                const name = STATE.currentPlayer === 'amber' ? 'Amber' : 'Slate';
                el.className = `turn-indicator turn-${STATE.currentPlayer}`;
                el.textContent = `${name}'s Turn`;
            }
        }

        function updateStats() {
            document.getElementById('stat-amber').textContent = STATE.stats.amber;
            document.getElementById('stat-slate').textContent = STATE.stats.slate;
        }

        function showWin(player) {
            const modal = document.getElementById('win-modal');
            const title = document.getElementById('win-title');
            const msg = document.getElementById('win-message');

            const name = player === 'amber' ? 'Amber' : 'Slate';
            title.textContent = `${name} Wins!`;
            title.style.color = player === 'amber' ? 'var(--amber)' : 'var(--slate-glow)';
            msg.textContent = `An unbroken chain of ${name.toLowerCase()} stones spans the board.`;
            modal.classList.add('active');
        }

        function newGame() {
            document.getElementById('win-modal').classList.remove('active');
            initBoard();
        }

        function setMode(mode) {
            STATE.mode = mode;
            document.getElementById('btn-pvp').classList.toggle('active', mode === 'pvp');
            document.getElementById('btn-ai').classList.toggle('active', mode === 'ai');
            newGame();
        }

        function cycleSize() {
            const sizes = [9, 11, 13];
            const idx = sizes.indexOf(STATE.size);
            STATE.size = sizes[(idx + 1) % sizes.length];
            document.getElementById('btn-size').textContent = `Board: ${STATE.size}`;
            newGame();
        }

        function undo() {
            if (STATE.moveHistory.length === 0 || STATE.gameOver) return;

            const lastMove = STATE.moveHistory.pop();
            STATE.board[lastMove.r][lastMove.c] = null;
            STATE.currentPlayer = lastMove.player;

            if (STATE.moveHistory.length === 0) {
                STATE.swapAvailable = true;
            }

            updateSwapButton();
            updateTurnIndicator();
            renderBoard();
        }

        document.getElementById('btn-new').addEventListener('click', newGame);

        // Close modal on overlay click
        document.getElementById('win-modal').addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                newGame();
            }
        });

        // Initialize
        initBoard();
    </script>
</body>
</html>
