<?php
// retro-toy-archive.php — Aquino Toy Archives 1985
// Inspired by Jon's blog post: "some toys i really liked growing up"
// https://jona.ca/2004/05/some-toys-i-really-liked-growing-up.html

$toys = [
    [
        'name' => 'Transformers',
        'year' => '1984',
        'category' => 'Action Figures',
        'emoji' => '🤖',
        'rarity' => 'Ultra Rare',
        'color' => '#ff2a6d',
        'desc' => 'Robots in disguise. Optimus Prime and Megatron battled for the fate of Cybertron — and the living-room carpet.',
    ],
    [
        'name' => 'Turbo Hopper',
        'year' => '1986',
        'category' => 'RC Vehicles',
        'emoji' => '🏎️',
        'rarity' => 'Rare',
        'color' => '#05d9e8',
        'desc' => 'The RC car that could actually hop over curbs. A precursor to BeamNG-style vehicular chaos.',
    ],
    [
        'name' => 'G.I. Joe',
        'year' => '1982',
        'category' => 'Action Figures',
        'emoji' => '🪖',
        'rarity' => 'Common',
        'color' => '#4caf50',
        'desc' => 'A real American hero with kung-fu grip. Knowing was half the battle; the other half was not losing the tiny accessories.',
    ],
    [
        'name' => 'Space Lego',
        'year' => '1978',
        'category' => 'Building',
        'emoji' => '🚀',
        'rarity' => 'Classic',
        'color' => '#ffd700',
        'desc' => 'Blue and grey classic space sets. The imagination fuel that would later power a career in building software systems.',
    ],
    [
        'name' => 'He-Man',
        'year' => '1982',
        'category' => 'Action Figures',
        'emoji' => '⚔️',
        'rarity' => 'Rare',
        'color' => '#9c27b0',
        'desc' => 'By the power of Grayskull! Skeletor\'s nemesis and the most muscular action figure on the shelf.',
    ],
    [
        'name' => '100-in-1 Electronics Kit',
        'year' => '1985',
        'category' => 'STEM',
        'emoji' => '🔧',
        'rarity' => 'Ultra Rare',
        'color' => '#ff9800',
        'desc' => 'Springs, wires, and a breadboard. Build an AM radio, a light sensor, or just make the buzzer annoy your sister.',
    ],
    [
        'name' => 'Model Rocket',
        'year' => '1984',
        'category' => 'STEM',
        'emoji' => '🎆',
        'rarity' => 'Rare',
        'color' => '#e91e63',
        'desc' => 'Estes rockets launched in the schoolyard. Sometimes they came back down. Sometimes they became permanent tree ornaments.',
    ],
    [
        'name' => 'Pocket LCD Game',
        'year' => '1983',
        'category' => 'Video Games',
        'emoji' => '👾',
        'rarity' => 'Vintage',
        'color' => '#00bcd4',
        'desc' => 'Pre-Game Boy handhelds with ghostly LCD sprites. The original mobile gaming experience, one button at a time.',
    ],
    [
        'name' => 'Laser Tag',
        'year' => '1986',
        'category' => 'Outdoor',
        'emoji' => '🔫',
        'rarity' => 'Rare',
        'color' => '#76ff03',
        'desc' => 'Infrared blasters and chest sensors. The neighbourhood became a sci-fi battlefield at dusk.',
    ],
    [
        'name' => 'Mini Arcade',
        'year' => '1981',
        'category' => 'Video Games',
        'emoji' => '🕹️',
        'rarity' => 'Ultra Rare',
        'color' => '#ff5722',
        'desc' => 'Coleco tabletop arcades. Tiny Donkey Kong and Pac-Man cabinets that never ate a quarter but ate plenty of batteries.',
    ],
    [
        'name' => 'Robot Dust Vac',
        'year' => '1985',
        'category' => 'Gadgets',
        'emoji' => '🧹',
        'rarity' => 'Oddity',
        'color' => '#607d8b',
        'desc' => 'A toy robot that actually vacuumed. Early automation enthusiasm, decades before Roomba became a household name.',
    ],
    [
        'name' => 'Space Shuttle',
        'year' => '1981',
        'category' => 'STEM',
        'emoji' => '🛰️',
        'rarity' => 'Classic',
        'color' => '#2196f3',
        'desc' => 'With realistic launch sounds. A tribute to NASA\'s golden age and the wonder of space exploration.',
    ],
    [
        'name' => 'Yes \'n No Books',
        'year' => '1983',
        'category' => 'Books',
        'emoji' => '📚',
        'rarity' => 'Vintage',
        'color' => '#795548',
        'desc' => 'Choose-your-path detective stories. The original interactive fiction — a gateway to programming logic.',
    ],
    [
        'name' => 'Hardy Boys Handbook',
        'year' => '1980',
        'category' => 'Books',
        'emoji' => '🕵️',
        'rarity' => 'Classic',
        'color' => '#3f51b5',
        'desc' => 'Fingerprinting, code breaking, and surveillance techniques. The CIA had nothing on a 10-year-old with this manual.',
    ],
    [
        'name' => 'Cap Grenades',
        'year' => '1985',
        'category' => 'Outdoor',
        'emoji' => '💥',
        'rarity' => 'Common',
        'color' => '#f44336',
        'desc' => 'Plastic grenades that went BANG with a cap ring. The soundtrack of every backyard war movie re-enactment.',
    ],
    [
        'name' => 'Yellow Submersible',
        'year' => '1984',
        'category' => 'Vehicles',
        'emoji' => '🛥️',
        'rarity' => 'Rare',
        'color' => '#ffeb3b',
        'desc' => 'A claw-equipped underwater rover for the bathtub. Marine exploration technology, scaled for rubber ducks.',
    ],
];

// Shuffle the deck for a fresh pack each load
shuffle($toys);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aquino Toy Archives — 1985</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a0f;
            --bg-2: #12121a;
            --card-bg: #1a1a24;
            --text: #e8e8f0;
            --text-dim: #8888a0;
            --accent: #ff2a6d;
            --accent-2: #05d9e8;
            --border: #2a2a3a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Scanline overlay */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.12) 2px,
                rgba(0, 0, 0, 0.12) 4px
            );
            pointer-events: none;
            z-index: 999;
            opacity: 0.5;
        }

        /* Floating geometric background */
        .bg-shapes {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .bg-shapes::before,
        .bg-shapes::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            animation: float 20s ease-in-out infinite;
        }

        .bg-shapes::before {
            width: 600px;
            height: 600px;
            background: var(--accent);
            top: -200px;
            left: -100px;
        }

        .bg-shapes::after {
            width: 500px;
            height: 500px;
            background: var(--accent-2);
            bottom: -150px;
            right: -100px;
            animation-delay: -10s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(80px, -60px) scale(1.1); }
            66% { transform: translate(-40px, 40px) scale(0.9); }
        }

        /* Header */
        header {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 3rem 1.5rem 2rem;
            border-bottom: 3px solid var(--border);
            background: linear-gradient(180deg, rgba(255,42,109,0.08) 0%, transparent 100%);
        }

        .logo {
            font-family: 'Press Start 2P', monospace;
            font-size: clamp(1rem, 4vw, 1.6rem);
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.75rem;
            text-shadow: 3px 3px 0px rgba(5, 217, 232, 0.3),
                         0 0 40px rgba(255, 42, 109, 0.4);
            line-height: 1.6;
        }

        .subtitle {
            font-size: clamp(0.9rem, 2.5vw, 1.15rem);
            color: var(--text-dim);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.5;
        }

        .year-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            color: var(--bg);
            font-family: 'Press Start 2P', monospace;
            font-size: 0.6rem;
            padding: 0.4rem 0.8rem;
            margin-top: 1rem;
            border-radius: 4px;
            letter-spacing: 1px;
        }

        /* Stats bar */
        .stats-bar {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 1rem;
            background: var(--bg-2);
            border-bottom: 2px solid var(--border);
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-family: 'Press Start 2P', monospace;
            font-size: 1.2rem;
            color: var(--accent-2);
            display: block;
        }

        .stat-label {
            font-size: 0.7rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.25rem;
        }

        /* Controls */
        .controls {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            padding: 1.5rem 1rem;
            position: relative;
            z-index: 1;
            flex-wrap: wrap;
        }

        .btn {
            background: transparent;
            border: 2px solid var(--border);
            color: var(--text);
            padding: 0.6rem 1.2rem;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn:hover, .btn.active {
            border-color: var(--accent);
            color: var(--accent);
            box-shadow: 0 0 20px rgba(255, 42, 109, 0.2);
        }

        .btn.active {
            background: rgba(255, 42, 109, 0.1);
        }

        /* Grid */
        .shelf {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
            padding: 1rem 1.5rem 4rem;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Card */
        .toy-card {
            background: var(--card-bg);
            border: 2px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            animation: cardIn 0.6s ease forwards;
        }

        @keyframes cardIn {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .toy-card:hover {
            transform: translateY(-8px) scale(1.02);
            border-color: var(--card-color, var(--accent));
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4),
                        0 0 60px var(--card-glow, rgba(255, 42, 109, 0.15));
        }

        .toy-card.hidden {
            display: none;
        }

        .card-visual {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg,
                var(--card-bg) 0%,
                color-mix(in srgb, var(--card-color, var(--accent)) 15%, var(--card-bg)) 100%);
        }

        .card-visual::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 30%,
                color-mix(in srgb, var(--card-color, var(--accent)) 30%, transparent) 0%,
                transparent 60%);
            opacity: 0.6;
        }

        .card-visual::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,0.02) 10px,
                rgba(255,255,255,0.02) 20px
            );
            animation: shimmer 8s linear infinite;
        }

        @keyframes shimmer {
            to { transform: translate(20px, 20px); }
        }

        .card-emoji {
            font-size: 4.5rem;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.4));
            transition: transform 0.3s ease;
        }

        .toy-card:hover .card-emoji {
            transform: scale(1.15) rotate(-5deg);
        }

        .card-rarity {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.5rem;
            padding: 0.3rem 0.5rem;
            border-radius: 4px;
            background: var(--card-color, var(--accent));
            color: var(--bg);
            z-index: 2;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }

        .card-body {
            padding: 1.1rem 1.25rem 1.25rem;
        }

        .card-category {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--card-color, var(--accent));
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .card-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.75rem;
            line-height: 1.5;
            color: var(--text);
            margin-bottom: 0.6rem;
        }

        .card-year {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.75rem;
            color: var(--text-dim);
            background: rgba(255,255,255,0.05);
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            margin-bottom: 0.75rem;
        }

        .card-desc {
            font-size: 0.85rem;
            line-height: 1.55;
            color: var(--text-dim);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Expanded detail view */
        .detail-overlay {
            position: fixed;
            inset: 0;
            background: rgba(10, 10, 15, 0.92);
            backdrop-filter: blur(12px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .detail-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .detail-card {
            background: var(--card-bg);
            border: 3px solid var(--border);
            border-radius: 20px;
            max-width: 520px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            position: relative;
            transform: scale(0.85) translateY(40px);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .detail-overlay.open .detail-card {
            transform: scale(1) translateY(0);
        }

        .detail-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: rgba(255,255,255,0.05);
            color: var(--text);
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            transition: all 0.2s ease;
        }

        .detail-close:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: rotate(90deg);
        }

        .detail-visual {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border-radius: 17px 17px 0 0;
        }

        .detail-emoji {
            font-size: 7rem;
            position: relative;
            z-index: 1;
            filter: drop-shadow(0 6px 20px rgba(0,0,0,0.5));
        }

        .detail-body {
            padding: 1.5rem 1.75rem 2rem;
        }

        .detail-rarity {
            display: inline-block;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.55rem;
            padding: 0.4rem 0.7rem;
            border-radius: 4px;
            background: var(--detail-color, var(--accent));
            color: var(--bg);
            margin-bottom: 0.75rem;
            letter-spacing: 0.5px;
        }

        .detail-title {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0.5rem;
        }

        .detail-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .detail-meta span {
            font-size: 0.8rem;
            color: var(--text-dim);
            background: rgba(255,255,255,0.05);
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
        }

        .detail-desc {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-dim);
        }

        .detail-funfact {
            margin-top: 1.25rem;
            padding: 1rem;
            background: linear-gradient(135deg,
                color-mix(in srgb, var(--detail-color, var(--accent)) 10%, var(--bg-2)),
                var(--bg-2));
            border-left: 4px solid var(--detail-color, var(--accent));
            border-radius: 0 8px 8px 0;
            font-size: 0.85rem;
            line-height: 1.6;
            color: var(--text);
        }

        .detail-funfact strong {
            color: var(--detail-color, var(--accent));
            display: block;
            margin-bottom: 0.25rem;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem;
            border-top: 2px solid var(--border);
            color: var(--text-dim);
            font-size: 0.8rem;
            position: relative;
            z-index: 1;
        }

        footer a {
            color: var(--accent-2);
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .shelf {
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
                padding: 0.75rem;
            }

            .card-visual {
                height: 130px;
            }

            .card-emoji {
                font-size: 3rem;
            }

            .card-body {
                padding: 0.75rem;
            }

            .card-title {
                font-size: 0.6rem;
            }

            .detail-visual {
                height: 160px;
            }

            .detail-emoji {
                font-size: 4.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shapes"></div>

    <header>
        <div class="logo">★ Aquino Toy Archives ★</div>
        <p class="subtitle">A curated collection of the toys, gadgets, and treasures that shaped a childhood in the 1980s. Inspired by Jon's legendary toy shelf.</p>
        <div class="year-badge">Est. 1985</div>
    </header>

    <div class="stats-bar">
        <div class="stat">
            <span class="stat-number"><?= count($toys) ?></span>
            <div class="stat-label">Artifacts</div>
        </div>
        <div class="stat">
            <span class="stat-number">4</span>
            <div class="stat-label">Decades</div>
        </div>
        <div class="stat">
            <span class="stat-number">∞</span>
            <div class="stat-label">Memories</div>
        </div>
    </div>

    <div class="controls">
        <button class="btn active" data-filter="all">All Toys</button>
        <button class="btn" data-filter="Action Figures">Action Figures</button>
        <button class="btn" data-filter="STEM">STEM</button>
        <button class="btn" data-filter="Video Games">Video Games</button>
        <button class="btn" data-filter="Outdoor">Outdoor</button>
        <button class="btn" data-filter="Books">Books</button>
    </div>

    <div class="shelf" id="shelf">
        <?php foreach ($toys as $i => $toy): ?>
        <div class="toy-card" data-category="<?= htmlspecialchars($toy['category']) ?>" style="--card-color: <?= $toy['color'] ?>; --card-glow: <?= $toy['color'] ?>26; animation-delay: <?= $i * 0.05 ?>s;" onclick="openDetail(<?= $i ?>)">
            <div class="card-visual">
                <span class="card-rarity"><?= htmlspecialchars($toy['rarity']) ?></span>
                <span class="card-emoji"><?= $toy['emoji'] ?></span>
            </div>
            <div class="card-body">
                <div class="card-category"><?= htmlspecialchars($toy['category']) ?></div>
                <div class="card-title"><?= htmlspecialchars($toy['name']) ?></div>
                <div class="card-year">📅 <?= $toy['year'] ?></div>
                <div class="card-desc"><?= htmlspecialchars($toy['desc']) ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="detail-overlay" id="detailOverlay" onclick="closeDetail(event)">
        <div class="detail-card" id="detailCard" onclick="event.stopPropagation()">
            <button class="detail-close" onclick="closeDetail()">×</button>
            <div class="detail-visual" id="detailVisual">
                <span class="detail-emoji" id="detailEmoji"></span>
            </div>
            <div class="detail-body">
                <span class="detail-rarity" id="detailRarity"></span>
                <div class="detail-title" id="detailTitle"></div>
                <div class="detail-meta">
                    <span id="detailCategory"></span>
                    <span id="detailYear"></span>
                </div>
                <div class="detail-desc" id="detailDesc"></div>
                <div class="detail-funfact" id="detailFunfact"></div>
            </div>
        </div>
    </div>

    <footer>
        <p>Built with nostalgia by Chloe ✨</p>
        <p style="margin-top: 0.5rem; opacity: 0.7;">Inspired by <a href="https://jona.ca/2004/05/some-toys-i-really-liked-growing-up.html" target="_blank">some toys i really liked growing up</a></p>
    </footer>

    <script>
        const toys = <?= json_encode($toys) ?>;
        const funFacts = [
            "These toys were the original 'open world' experience — no loading screens, just pure imagination.",
            "Before there were Git repos, there were Lego instructions. Both require patience and occasionally cause frustration.",
            "The 100-in-1 Electronics Kit was the Raspberry Pi of its generation.",
            "Every Transformer came with a bio card. That was the original character select screen.",
            "Laser Tag was basically PvP before the internet made it global.",
            "The Pocket LCD Game had worse battery life than a modern smartphone running GPS.",
            "Cap grenades were the original haptic feedback device.",
            "Yes 'n No Books had more branching narratives than most modern AAA games.",
            "GI Joe figures had more articulation than most CSS layouts in 2024.",
            "Model rockets taught an entire generation that 'rapid unscheduled disassembly' is just part of engineering.",
            "The Robot Dust Vac proved that even in 1985, people wanted robots to do their chores.",
            "He-Man's power sword would make an excellent CSS gradient demo.",
            "The Turbo Hopper could jump small obstacles, making it the original physics-based driving game.",
            "The Space Shuttle toy came with a countdown timer. That was basically a loading screen you could hear.",
            "Swatch watches were the original wearable tech. They told time AND made a fashion statement.",
            "The Hardy Boys Detective Handbook contained actual surveillance techniques. The NSA has nothing on a motivated 10-year-old."
        ];

        // Filter
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const filter = btn.dataset.filter;
                document.querySelectorAll('.toy-card').forEach(card => {
                    if (filter === 'all' || card.dataset.category === filter) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });

        // Detail modal
        function openDetail(index) {
            const toy = toys[index];
            const overlay = document.getElementById('detailOverlay');
            const card = document.getElementById('detailCard');

            document.getElementById('detailEmoji').textContent = toy.emoji;
            document.getElementById('detailRarity').textContent = toy.rarity;
            document.getElementById('detailTitle').textContent = toy.name;
            document.getElementById('detailCategory').textContent = '📂 ' + toy.category;
            document.getElementById('detailYear').textContent = '📅 ' + toy.year;
            document.getElementById('detailDesc').textContent = toy.desc;

            const fact = funFacts[index % funFacts.length];
            document.getElementById('detailFunfact').innerHTML = '<strong>💡 Archive Note</strong>' + fact;

            document.getElementById('detailVisual').style.background = 'linear-gradient(135deg, ' + toy.color + '20 0%, ' + toy.color + '08 100%)';
            document.getElementById('detailVisual').style.borderLeft = 'none';
            card.style.borderColor = toy.color;
            card.style.setProperty('--detail-color', toy.color);

            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeDetail(event) {
            if (event && event.target !== document.getElementById('detailOverlay') && event.target !== document.querySelector('.detail-close')) {
                return;
            }
            document.getElementById('detailOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        // Keyboard support
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeDetail();
        });

        // Stagger animation on load
        document.querySelectorAll('.toy-card').forEach((card, i) => {
            card.style.animationDelay = (i * 0.06) + 's';
        });
    </script>
</body>
</html>
