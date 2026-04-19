<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Map Explorer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --parchment: #f4efe4;
            --parchment-dark: #e8dfc8;
            --ink: #2c1810;
            --ink-light: #5a3d2e;
            --red: #8b2500;
            --gold: #c8922a;
            --gold-light: #e8b84a;
            --blue: #1a4a6b;
            --green: #2d5a27;
            --shadow: rgba(44, 24, 16, 0.18);
        }

        body {
            font-family: 'Space Mono', monospace;
            background: var(--parchment);
            background-image:
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='400' height='400' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            color: var(--ink);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== HEADER ===== */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--parchment);
            border-bottom: 2px solid var(--ink);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            box-shadow: 0 4px 16px var(--shadow);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .compass-icon {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
        }

        h1 {
            font-family: 'Caveat', cursive;
            font-size: 1.9em;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--ink);
            line-height: 1;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            font-family: 'Space Mono', monospace;
            font-size: 0.75em;
            padding: 8px 14px;
            border: 1.5px solid var(--ink);
            background: var(--parchment);
            color: var(--ink);
            cursor: pointer;
            border-radius: 3px;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .btn:hover {
            background: var(--ink);
            color: var(--parchment);
        }

        .btn-primary {
            background: var(--red);
            color: var(--parchment);
            border-color: var(--red);
        }

        .btn-primary:hover {
            background: #a63000;
            border-color: #a63000;
            color: var(--parchment);
        }

        /* ===== MAP CONTAINER ===== */
        .map-container {
            position: relative;
            width: 100%;
            height: calc(100vh - 80px);
            overflow: hidden;
        }

        .map-svg {
            position: absolute;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            cursor: grab;
        }

        .map-svg:active { cursor: grabbing; }

        .map-svg .land {
            fill: #d4c9a8;
            stroke: #a89060;
            stroke-width: 0.5;
            transition: fill 0.2s;
        }

        .map-svg .land:hover { fill: #c8bb9a; }

        .map-svg .ocean {
            fill: #c8dce8;
        }

        .map-svg .ocean-deep {
            fill: #b0cfe0;
        }

        .map-svg .border {
            fill: none;
            stroke: #b0a070;
            stroke-width: 0.4;
        }

        /* ===== PINS ===== */
        .pin {
            position: absolute;
            width: 32px;
            height: 40px;
            transform: translate(-50%, -100%);
            cursor: pointer;
            z-index: 10;
            filter: drop-shadow(0 3px 6px rgba(0,0,0,0.25));
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .pin:hover { transform: translate(-50%, -100%) scale(1.18) rotate(-5deg); }
        .pin.selected { transform: translate(-50%, -100%) scale(1.25); z-index: 20; }

        .pin-label {
            position: absolute;
            top: 42px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--ink);
            color: var(--parchment);
            font-size: 0.6em;
            padding: 2px 6px;
            border-radius: 2px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pin:hover .pin-label,
        .pin.selected .pin-label { opacity: 1; }

        /* ===== FLOATING ADD FORM ===== */
        .add-form {
            position: absolute;
            bottom: 24px;
            right: 24px;
            width: 300px;
            background: var(--parchment);
            border: 2px solid var(--ink);
            border-radius: 6px;
            padding: 18px;
            box-shadow: 6px 6px 0 var(--shadow);
            z-index: 50;
            display: none;
        }

        .add-form.open { display: block; }

        .add-form h3 {
            font-family: 'Caveat', cursive;
            font-size: 1.3em;
            margin-bottom: 12px;
            color: var(--ink);
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-size: 0.65em;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
            color: var(--ink-light);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 7px 10px;
            border: 1.5px solid #b0a070;
            background: #fdf9f0;
            font-family: 'Space Mono', monospace;
            font-size: 0.8em;
            color: var(--ink);
            border-radius: 3px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--gold);
        }

        .form-group textarea { resize: vertical; min-height: 60px; }

        .form-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .form-actions .btn { flex: 1; text-align: center; }

        .click-hint {
            position: absolute;
            bottom: 24px;
            left: 24px;
            background: var(--ink);
            color: var(--parchment);
            font-size: 0.7em;
            padding: 8px 14px;
            border-radius: 4px;
            opacity: 0.9;
            pointer-events: none;
            z-index: 5;
        }

        .click-hint.hidden { display: none; }

        /* ===== SIDEBAR / DETAIL PANEL ===== */
        .detail-panel {
            position: absolute;
            top: 0;
            right: 0;
            width: 320px;
            height: 100%;
            background: var(--parchment);
            border-left: 2px solid var(--ink);
            z-index: 40;
            overflow-y: auto;
            transform: translateX(100%);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .detail-panel.open { transform: translateX(0); }

        .detail-header {
            padding: 16px;
            border-bottom: 1px solid var(--parchment-dark);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .detail-header h2 {
            font-family: 'Caveat', cursive;
            font-size: 1.5em;
            line-height: 1.2;
            color: var(--ink);
            flex: 1;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
            color: var(--ink-light);
            padding: 4px 8px;
            flex-shrink: 0;
        }

        .close-btn:hover { color: var(--ink); }

        .detail-body { padding: 16px; flex: 1; }

        .detail-date {
            font-size: 0.7em;
            color: var(--gold);
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .detail-note {
            font-size: 0.82em;
            line-height: 1.65;
            color: var(--ink-light);
            margin-bottom: 16px;
        }

        .detail-actions {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 16px;
            border-top: 1px solid var(--parchment-dark);
            margin-top: auto;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            pointer-events: none;
            opacity: 0.5;
        }

        .empty-state h2 {
            font-family: 'Caveat', cursive;
            font-size: 2em;
            color: var(--ink-light);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 0.8em;
            color: var(--ink-light);
            line-height: 1.6;
            max-width: 260px;
        }

        /* ===== PIN COLOURS ===== */
        .pin-red { --pin-color: #8b2500; }
        .pin-gold { --pin-color: #c8922a; }
        .pin-blue { --pin-color: #1a4a6b; }
        .pin-green { --pin-color: #2d5a27; }
        .pin-purple { --pin-color: #5a2d6b; }

        /* ===== STATS BAR ===== */
        .stats-bar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--parchment-dark);
            z-index: 30;
        }

        .stats-fill {
            height: 100%;
            background: var(--gold);
            transition: width 0.5s ease;
        }

        .stats-count {
            position: absolute;
            top: 8px;
            left: 12px;
            font-size: 0.6em;
            font-weight: 700;
            color: var(--ink-light);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            opacity: 0.7;
            z-index: 30;
            pointer-events: none;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 600px) {
            h1 { font-size: 1.4em; }
            .add-form {
                width: calc(100% - 32px);
                left: 16px;
                right: 16px;
                bottom: 16px;
            }
            .detail-panel { width: 100%; border-left: none; border-top: 2px solid var(--ink); height: 60%; top: auto; bottom: 0; transform: translateY(100%); }
            .detail-panel.open { transform: translateY(0); }
        }
    </style>
</head>
<body>

<header>
    <div class="header-left">
        <svg class="compass-icon" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="18" cy="18" r="16" stroke="#2c1810" stroke-width="2" fill="#f4efe4"/>
            <circle cx="18" cy="18" r="12" stroke="#c8922a" stroke-width="1" fill="none"/>
            <polygon points="18,4 20,18 18,22 16,18" fill="#8b2500"/>
            <polygon points="18,32 20,18 18,14 16,18" fill="#2c1810"/>
            <polygon points="4,18 18,16 22,18 18,20" fill="#2c1810"/>
            <polygon points="32,18 18,16 14,18 18,20" fill="#2c1810"/>
            <circle cx="18" cy="18" r="2" fill="#c8922a"/>
        </svg>
        <h1>Life Map</h1>
    </div>
    <div class="header-right">
        <button class="btn" id="clearBtn">Clear All</button>
        <button class="btn btn-primary" id="addBtn">+ Add Pin</button>
    </div>
</header>

<div class="stats-bar">
    <div class="stats-fill" id="statsFill" style="width: 0%"></div>
</div>
<span class="stats-count" id="statsCount">0 places marked</span>

<div class="map-container" id="mapContainer">
    <!-- SVG World Map -->
    <svg class="map-svg" id="mapSvg" viewBox="0 0 1000 500" preserveAspectRatio="xMidYMid slice">
        <defs>
            <filter id="grain">
                <feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch" result="noise"/>
                <feColorMatrix type="saturate" values="0" in="noise" result="grayNoise"/>
                <feBlend in="SourceGraphic" in2="grayNoise" mode="multiply" result="blend"/>
                <feComposite in="blend" in2="SourceGraphic" operator="in"/>
            </filter>
        </defs>

        <!-- Ocean -->
        <rect class="ocean" width="1000" height="500" fill="#c8dce8"/>

        <!-- Simplified world land masses -->
        <!-- North America -->
        <path class="land" d="M 70,60 L 180,55 L 220,70 L 250,85 L 280,80 L 290,110 L 270,130 L 250,145 L 230,160 L 200,170 L 170,175 L 140,185 L 120,195 L 100,190 L 85,175 L 70,160 L 60,140 L 55,120 L 60,90 Z"/>

        <!-- Central America / Caribbean -->
        <path class="land" d="M 190,195 L 220,200 L 235,215 L 230,230 L 215,240 L 200,235 L 190,220 L 185,205 Z"/>

        <!-- South America -->
        <path class="land" d="M 200,250 L 240,245 L 265,260 L 280,290 L 285,320 L 275,360 L 260,390 L 240,410 L 215,420 L 195,410 L 180,380 L 170,340 L 165,300 L 170,270 L 180,255 Z"/>

        <!-- Greenland -->
        <path class="land" d="M 280,20 L 340,15 L 370,30 L 365,55 L 340,65 L 310,60 L 290,45 Z"/>

        <!-- Europe -->
        <path class="land" d="M 440,65 L 480,60 L 510,68 L 530,80 L 540,95 L 535,115 L 520,130 L 500,138 L 478,135 L 458,128 L 445,115 L 440,95 L 438,75 Z"/>

        <!-- Scandinavia -->
        <path class="land" d="M 478,40 L 500,35 L 515,45 L 512,65 L 498,70 L 482,68 L 475,55 Z"/>

        <!-- UK / Ireland -->
        <path class="land" d="M 438,80 L 450,78 L 455,90 L 450,105 L 440,108 L 435,98 Z"/>
        <path class="land" d="M 425,88 L 433,85 L 436,95 L 430,102 L 423,100 Z"/>

        <!-- Africa -->
        <path class="land" d="M 450,155 L 510,150 L 545,160 L 565,185 L 575,220 L 570,260 L 560,300 L 540,340 L 515,365 L 490,375 L 465,368 L 445,345 L 430,310 L 425,270 L 430,225 L 435,185 L 438,165 Z"/>

        <!-- Madagascar -->
        <path class="land" d="M 590,295 L 598,290 L 605,300 L 603,315 L 596,320 L 590,315 Z"/>

        <!-- Middle East / Arabian Peninsula -->
        <path class="land" d="M 540,120 L 580,115 L 610,120 L 625,135 L 620,155 L 605,165 L 585,170 L 565,165 L 550,150 L 542,135 Z"/>

        <!-- Asia (main) -->
        <path class="land" d="M 550,50 L 620,45 L 680,50 L 740,55 L 800,65 L 840,80 L 870,100 L 880,125 L 870,145 L 850,155 L 820,158 L 785,152 L 750,145 L 715,140 L 680,145 L 645,148 L 615,142 L 590,130 L 572,115 L 558,95 Z"/>

        <!-- Indian Subcontinent -->
        <path class="land" d="M 650,140 L 690,138 L 715,150 L 720,175 L 710,200 L 695,210 L 678,208 L 665,195 L 655,170 L 650,150 Z"/>

        <!-- Southeast Asia -->
        <path class="land" d="M 745,155 L 780,150 L 810,158 L 820,180 L 810,200 L 790,205 L 770,200 L 755,185 L 748,168 Z"/>

        <!-- East Asia (China/Korea/Japan) -->
        <path class="land" d="M 790,80 L 840,75 L 875,85 L 890,105 L 888,130 L 870,145 L 845,148 L 815,142 L 790,130 L 778,110 L 780,90 Z"/>

        <!-- Japan (simplified) -->
        <path class="land" d="M 888,95 L 900,90 L 908,100 L 905,115 L 895,120 L 888,115 L 885,105 Z"/>

        <!-- Australia -->
        <path class="land" d="M 790,300 L 860,295 L 910,305 L 930,325 L 935,355 L 920,380 L 895,395 L 860,398 L 830,390 L 805,370 L 790,345 L 785,320 Z"/>

        <!-- New Zealand -->
        <path class="land" d="M 940,380 L 950,375 L 958,385 L 955,398 L 945,402 L 938,395 Z"/>
        <path class="land" d="M 935,358 L 948,355 L 955,365 L 950,375 L 938,375 Z"/>

        <!-- Russia (top) -->
        <path class="land" d="M 490,15 L 620,10 L 750,12 L 880,18 L 920,25 L 900,40 L 840,38 L 780,35 L 720,38 L 660,42 L 600,40 L 550,35 L 510,30 L 490,22 Z"/>

        <!-- Iceland -->
        <path class="land" d="M 395,45 L 415,42 L 425,50 L 418,58 L 405,58 Z"/>

        <!-- Cuba / Caribbean islands (simplified) -->
        <path class="land" d="M 225,205 L 240,203 L 248,210 L 245,218 L 235,220 L 225,215 Z"/>

        <!-- Philippines / Indonesia (simplified) -->
        <path class="land" d="M 835,190 L 850,188 L 858,198 L 852,208 L 840,205 L 833,198 Z"/>
        <path class="land" d="M 815,205 L 828,202 L 835,212 L 830,222 L 818,220 L 812,214 Z"/>

        <!-- Sri Lanka -->
        <path class="land" d="M 695,215 L 702,212 L 706,220 L 703,228 L 697,228 Z"/>

        <!-- Saudi Arabia / Red Sea -->
        <path class="land" d="M 530,135 L 555,132 L 568,140 L 565,155 L 550,158 L 535,150 L 528,142 Z"/>

        <!-- Spain / Portugal -->
        <path class="land" d="M 430,108 L 448,105 L 455,115 L 448,128 L 435,130 L 428,122 Z"/>

        <!-- Italy -->
        <path class="land" d="M 478,115 L 490,112 L 496,120 L 493,132 L 485,138 L 478,132 L 476,122 Z"/>
        <path class="land" d="M 480,140 L 486,138 L 490,145 L 487,152 L 481,150 Z"/>

        <!-- Greece -->
        <path class="land" d="M 500,125 L 512,122 L 518,130 L 514,140 L 505,140 L 500,133 Z"/>

        <!-- Turkey -->
        <path class="land" d="M 510,105 L 545,100 L 558,108 L 555,118 L 538,120 L 518,118 L 508,112 Z"/>

        <!-- Alaska -->
        <path class="land" d="M 30,45 L 80,35 L 110,40 L 105,55 L 80,60 L 45,58 L 28,52 Z"/>

        <!-- Canada (Arctic) -->
        <path class="land" d="M 80,20 L 200,15 L 320,18 L 400,20 L 440,25 L 420,35 L 340,32 L 240,30 L 140,28 L 80,25 Z"/>

        <!-- Northern Russia -->
        <path class="land" d="M 450,5 L 550,3 L 650,5 L 750,4 L 850,6 L 920,10 L 900,18 L 820,16 L 740,14 L 660,12 L 580,10 L 500,8 L 450,10 Z"/>

        <!-- Polar regions (subtle) -->
        <path class="land" style="fill:#dce8f0;opacity:0.6" d="M 0,480 L 1000,480 L 1000,500 L 0,500 Z"/>
        <path class="land" style="fill:#dce8f0;opacity:0.6" d="M 0,0 L 1000,0 L 1000,20 L 0,20 Z"/>
    </svg>

    <!-- Pins rendered here by JS -->
    <div id="pinsLayer"></div>

    <!-- Empty State -->
    <div class="empty-state" id="emptyState">
        <h2>Chart your journey</h2>
        <p>Click "Add Pin" then click anywhere on the map to mark a meaningful place in your life.</p>
    </div>

    <!-- Click hint -->
    <div class="click-hint hidden" id="clickHint">Click anywhere on the map to place your pin</div>

    <!-- Add Pin Form -->
    <div class="add-form" id="addForm">
        <h3>Mark a Place</h3>
        <div class="form-group">
            <label>Location Name</label>
            <input type="text" id="pinName" placeholder="e.g. Paris, Notre-Dame, Grandma's house">
        </div>
        <div class="form-group">
            <label>Date</label>
            <input type="date" id="pinDate">
        </div>
        <div class="form-group">
            <label>Note</label>
            <textarea id="pinNote" placeholder="What happened here? What did it mean to you?"></textarea>
        </div>
        <div class="form-group">
            <label>Colour</label>
            <div style="display:flex;gap:6px;margin-top:4px;">
                <button class="color-btn selected" data-color="red" style="width:24px;height:24px;border-radius:50%;border:2px solid #8b2500;background:#8b2500;"></button>
                <button class="color-btn" data-color="gold" style="width:24px;height:24px;border-radius:50%;border:2px solid #c8922a;background:#c8922a;"></button>
                <button class="color-btn" data-color="blue" style="width:24px;height:24px;border-radius:50%;border:2px solid #1a4a6b;background:#1a4a6b;"></button>
                <button class="color-btn" data-color="green" style="width:24px;height:24px;border-radius:50%;border:2px solid #2d5a27;background:#2d5a27;"></button>
                <button class="color-btn" data-color="purple" style="width:24px;height:24px;border-radius:50%;border:2px solid #5a2d6b;background:#5a2d6b;"></button>
            </div>
        </div>
        <div class="form-actions">
            <button class="btn" id="cancelAdd">Cancel</button>
            <button class="btn btn-primary" id="savePin">Save Pin</button>
        </div>
    </div>

    <!-- Detail Panel -->
    <div class="detail-panel" id="detailPanel">
        <div class="detail-header">
            <h2 id="detailTitle">Place Name</h2>
            <button class="close-btn" id="closeDetail">&times;</button>
        </div>
        <div class="detail-body">
            <div class="detail-date" id="detailDate">2024</div>
            <p class="detail-note" id="detailNote">Notes about this place...</p>
        </div>
        <div class="detail-actions">
            <button class="btn" id="deletePin">Delete This Pin</button>
        </div>
    </div>
</div>

<script>
(function() {
    const STORAGE_KEY = 'lifeMapPins';
    const MAX_PINS = 50;

    const svgNS = 'http://www.w3.org/2000/svg';
    const mapSvg = document.getElementById('mapSvg');
    const pinsLayer = document.getElementById('pinsLayer');
    const addForm = document.getElementById('addForm');
    const addBtn = document.getElementById('addBtn');
    const cancelBtn = document.getElementById('cancelAdd');
    const saveBtn = document.getElementById('savePin');
    const clearBtn = document.getElementById('clearBtn');
    const detailPanel = document.getElementById('detailPanel');
    const closeDetailBtn = document.getElementById('closeDetail');
    const clickHint = document.getElementById('clickHint');
    const emptyState = document.getElementById('emptyState');
    const statsFill = document.getElementById('statsFill');
    const statsCount = document.getElementById('statsCount');
    const colorBtns = document.querySelectorAll('.color-btn');

    let state = {
        mode: 'view', // 'view' | 'placing'
        placingX: 0,
        placingY: 0,
        selectedId: null,
        selectedColor: 'red'
    };

    let pins = [];

    // ===== PERSISTENCE =====
    function loadPins() {
        try { pins = JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
        catch { pins = []; }
    }

    function savePins() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(pins));
    }

    // ===== RENDERING =====
    const COLOR_MAP = {
        red: '#8b2500',
        gold: '#c8922a',
        blue: '#1a4a6b',
        green: '#2d5a27',
        purple: '#5a2d6b'
    };

    function createPinSVG(color) {
        const c = COLOR_MAP[color] || COLOR_MAP.red;
        return `
        <svg viewBox="0 0 32 44" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:32px;height:44px;">
            <path d="M16 0C7.163 0 0 7.163 0 16c0 8.837 16 28 16 28s16-19.163 16-28C32 7.163 24.837 0 16 0z" fill="${c}"/>
            <circle cx="16" cy="16" r="8" fill="white" opacity="0.25"/>
            <circle cx="16" cy="16" r="4" fill="white" opacity="0.5"/>
        </svg>`;
    }

    function renderPins() {
        pinsLayer.innerHTML = '';
        pins.forEach(pin => {
            const el = document.createElement('div');
            el.className = 'pin' + (pin.id === state.selectedId ? ' selected' : '');
            el.id = 'pin-' + pin.id;
            el.style.left = pin.x + '%';
            el.style.top = pin.y + '%';
            el.innerHTML = createPinSVG(pin.color) + `<div class="pin-label">${escapeHtml(pin.name)}</div>`;
            el.addEventListener('click', (e) => {
                e.stopPropagation();
                showDetail(pin.id);
            });
            pinsLayer.appendChild(el);
        });

        // Update empty state
        emptyState.style.display = pins.length === 0 ? 'block' : 'none';
        clickHint.classList.toggle('hidden', pins.length > 0 || state.mode !== 'view');

        // Update stats
        const pct = Math.min(100, (pins.length / MAX_PINS) * 100);
        statsFill.style.width = pct + '%';
        statsCount.textContent = pins.length + ' place' + (pins.length !== 1 ? 's' : '') + ' marked';
    }

    function showDetail(id) {
        const pin = pins.find(p => p.id === id);
        if (!pin) return;
        state.selectedId = id;
        document.getElementById('detailTitle').textContent = pin.name;
        document.getElementById('detailDate').textContent = pin.date || 'No date';
        document.getElementById('detailNote').textContent = pin.note || 'No notes yet.';
        detailPanel.classList.add('open');
        renderPins();
    }

    function hideDetail() {
        state.selectedId = null;
        detailPanel.classList.remove('open');
        renderPins();
    }

    // ===== MAP COORDINATE CONVERSION =====
    function getMapCoords(clientX, clientY) {
        const rect = mapSvg.getBoundingClientRect();
        const viewBox = mapSvg.viewBox.baseVal;
        const svgX = ((clientX - rect.left) / rect.width) * viewBox.width;
        const svgY = ((clientY - rect.top) / rect.height) * viewBox.height;
        const pctX = (svgX / viewBox.width) * 100;
        const pctY = (svgY / viewBox.height) * 100;
        return { x: pctX, y: pctY };
    }

    // ===== ADD MODE =====
    function enterPlacingMode() {
        state.mode = 'placing';
        addForm.classList.add('open');
        clickHint.classList.remove('hidden');
        hideDetail();
        document.getElementById('pinName').focus();
    }

    function exitPlacingMode() {
        state.mode = 'view';
        addForm.classList.remove('open');
        clickHint.classList.add('hidden');
    }

    // ===== EVENT HANDLERS =====
    addBtn.addEventListener('click', enterPlacingMode);
    cancelBtn.addEventListener('click', exitPlacingMode);
    closeDetailBtn.addEventListener('click', hideDetail);
    clearBtn.addEventListener('click', () => {
        if (confirm('Clear all pins? This cannot be undone.')) {
            pins = [];
            savePins();
            renderPins();
            hideDetail();
        }
    });

    document.getElementById('deletePin').addEventListener('click', () => {
        if (!state.selectedId) return;
        if (confirm('Delete this pin?')) {
            pins = pins.filter(p => p.id !== state.selectedId);
            savePins();
            renderPins();
            hideDetail();
        }
    });

    // Color buttons
    colorBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            colorBtns.forEach(b => b.style.outline = 'none');
            btn.style.outline = '3px solid #c8922a';
            state.selectedColor = btn.dataset.color;
        });
    });
    colorBtns[0].style.outline = '3px solid #c8922a';

    // Map click → place pin
    mapSvg.addEventListener('click', (e) => {
        if (state.mode !== 'placing') return;
        e.stopPropagation();
        const coords = getMapCoords(e.clientX, e.clientY);
        state.placingX = coords.x;
        state.placingY = coords.y;
        document.getElementById('pinName').value = '';
        document.getElementById('pinDate').value = '';
        document.getElementById('pinNote').value = '';
        exitPlacingMode();
        // Open form pre-positioned
        addForm.classList.add('open');
        document.getElementById('pinName').focus();
        state.placingX = coords.x;
        state.placingY = coords.y;
    });

    // Stop map click from closing form
    addForm.addEventListener('click', (e) => e.stopPropagation());

    // Save pin
    saveBtn.addEventListener('click', () => {
        const name = document.getElementById('pinName').value.trim();
        if (!name) {
            document.getElementById('pinName').focus();
            return;
        }
        const date = document.getElementById('pinDate').value;
        const note = document.getElementById('pinNote').value.trim();
        const pin = {
            id: Date.now().toString(),
            name,
            date,
            note,
            color: state.selectedColor,
            x: state.placingX,
            y: state.placingY
        };
        if (pins.length >= MAX_PINS) {
            alert('Maximum ' + MAX_PINS + ' pins reached. Delete some to add more.');
            return;
        }
        pins.push(pin);
        savePins();
        renderPins();
        exitPlacingMode();
        showDetail(pin.id);
    });

    // Escape / Enter on form
    document.getElementById('pinName').addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { exitPlacingMode(); return; }
        if (e.key === 'Enter') { saveBtn.click(); }
    });

    // Click outside to close detail
    document.getElementById('mapContainer').addEventListener('click', (e) => {
        if (e.target === mapSvg || e.target === pinsLayer || e.target.closest('.empty-state') || e.target === document.getElementById('mapContainer')) {
            if (state.mode === 'view') hideDetail();
        }
    });

    // ===== DRAG TO PAN =====
    let isPanning = false;
    let panStart = { x: 0, y: 0 };
    let scrollStart = { x: 0, y: 0 };

    mapSvg.addEventListener('mousedown', (e) => {
        if (e.target !== mapSvg && !e.target.classList.contains('ocean')) return;
        isPanning = true;
        panStart = { x: e.clientX, y: e.clientY };
        scrollStart = { x: mapSvg.parentElement.scrollLeft, y: mapSvg.parentElement.scrollTop };
        mapSvg.style.cursor = 'grabbing';
    });

    document.addEventListener('mousemove', (e) => {
        if (!isPanning) return;
        const dx = e.clientX - panStart.x;
        const dy = e.clientY - panStart.y;
        mapSvg.parentElement.scrollLeft = scrollStart.x - dx;
        mapSvg.parentElement.scrollTop = scrollStart.y - dy;
    });

    document.addEventListener('mouseup', () => {
        isPanning = false;
        mapSvg.style.cursor = 'grab';
    });

    // ===== INIT =====
    loadPins();
    renderPins();

    // Pre-load with a few demo pins if empty (first visit)
    if (pins.length === 0) {
        const demo = [
            { id: 'demo1', name: 'Victoria, BC', date: '1987', note: 'Where I grew up — the city of my childhood, the ocean at my doorstep.', color: 'blue', x: 14.5, y: 27 },
            { id: 'demo2', name: 'Rome', date: '2010', note: 'Pilgrimage with my dad. Standing in St Peter\'s Square at dawn.', color: 'gold', x: 49.8, y: 25.5 },
            { id: 'demo3', name: 'Vancouver', date: '2012', note: 'Where I met Mila.', color: 'red', x: 13.8, y: 29.5 },
        ];
        pins = demo;
        savePins();
        renderPins();
    }
})();
</script>
</body>
</html>
