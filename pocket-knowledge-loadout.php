<?php
$sourceTitle = 'Installing Wikipedia on your mobile device';
$sourceUrl = 'https://jona.ca/2009/12/installing-wikipedia-on-your-mobile.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocket Knowledge Loadout</title>
    <style>
        :root {
            --bg: #07131c;
            --bg-2: #0d2130;
            --panel: rgba(11, 28, 40, 0.82);
            --panel-strong: rgba(16, 41, 56, 0.92);
            --line: rgba(162, 227, 255, 0.18);
            --glow: #96f5ff;
            --glow-2: #59c6ff;
            --amber: #ffd266;
            --rose: #ff7b9d;
            --mint: #a4ffcf;
            --text: #e9f7ff;
            --muted: #94b8c9;
            --danger: #ff8c7d;
            --safe: #75f3bc;
            --shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
            --radius: 28px;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background:
                radial-gradient(circle at top left, rgba(89, 198, 255, 0.18), transparent 32%),
                radial-gradient(circle at bottom right, rgba(255, 210, 102, 0.12), transparent 28%),
                linear-gradient(160deg, var(--bg) 0%, #061018 42%, #02070b 100%);
            color: var(--text);
            font-family: "Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255,255,255,0.02), rgba(255,255,255,0.00) 42%),
                repeating-linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.03) 0 1px,
                    transparent 1px 4px
                );
            opacity: 0.45;
        }

        a { color: var(--glow); }

        .wrap {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 32px 0 56px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 34px;
            padding: 30px;
            background:
                linear-gradient(145deg, rgba(20, 43, 58, 0.95), rgba(6, 18, 26, 0.95)),
                linear-gradient(160deg, rgba(255,255,255,0.06), transparent 38%);
            box-shadow: var(--shadow);
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 14px;
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.05);
            pointer-events: none;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            gap: 24px;
            align-items: start;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            border: 1px solid rgba(150, 245, 255, 0.22);
            background: rgba(150, 245, 255, 0.08);
            color: var(--mint);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.72rem;
        }

        h1 {
            margin: 16px 0 10px;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: clamp(2.4rem, 5vw, 4.8rem);
            line-height: 0.92;
            letter-spacing: -0.06em;
            max-width: 10ch;
        }

        .lede {
            max-width: 62ch;
            font-size: 1.05rem;
            line-height: 1.75;
            color: #c8e6f4;
            margin: 0;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .hero-links a,
        .hero-links button {
            appearance: none;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: var(--text);
            border-radius: 999px;
            padding: 11px 16px;
            text-decoration: none;
            font-weight: 700;
            cursor: pointer;
            transition: transform 150ms ease, background 150ms ease, border-color 150ms ease;
        }

        .hero-links a:hover,
        .hero-links button:hover {
            transform: translateY(-1px);
            background: rgba(150, 245, 255, 0.12);
            border-color: rgba(150, 245, 255, 0.4);
        }

        .pda {
            margin-top: 28px;
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(320px, 0.9fr);
            gap: 24px;
        }

        .shell,
        .side-panel,
        .mission-card,
        .pack-card,
        .screen-card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            background: var(--panel);
            backdrop-filter: blur(8px);
        }

        .shell {
            padding: 24px;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.06);
        }

        .shell-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
            margin-bottom: 16px;
        }

        .hardware {
            display: flex;
            gap: 8px;
            color: var(--muted);
            font-size: 0.8rem;
            align-items: center;
        }

        .hardware span {
            border: 1px solid rgba(255,255,255,0.08);
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.04);
        }

        .screen {
            position: relative;
            border-radius: 26px;
            background:
                radial-gradient(circle at top right, rgba(164, 255, 207, 0.22), transparent 26%),
                linear-gradient(180deg, #062536 0%, #041925 100%);
            padding: 18px;
            border: 1px solid rgba(150, 245, 255, 0.2);
            box-shadow:
                inset 0 0 0 1px rgba(255,255,255,0.04),
                inset 0 0 50px rgba(150, 245, 255, 0.08);
        }

        .screen::before {
            content: "";
            position: absolute;
            inset: 10px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.04);
            pointer-events: none;
        }

        .storage-labels,
        .stat-row,
        .screen-header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: center;
        }

        .screen-header {
            margin-bottom: 14px;
            color: var(--mint);
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.72rem;
        }

        .storage-meter,
        .micro-bar {
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.05);
        }

        .storage-meter {
            height: 18px;
            margin: 10px 0 18px;
        }

        .storage-fill,
        .micro-fill {
            height: 100%;
            width: 0;
            transition: width 220ms ease, background 220ms ease;
            background: linear-gradient(90deg, var(--safe), var(--glow));
            box-shadow: 0 0 22px rgba(150, 245, 255, 0.26);
        }

        .micro-bar { height: 10px; }

        .storage-labels {
            font-size: 0.84rem;
            color: var(--muted);
        }

        .capsule-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin: 18px 0 22px;
        }

        .capsule {
            border-radius: 18px;
            padding: 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.05);
        }

        .capsule strong {
            display: block;
            font-size: 1.3rem;
            margin-top: 6px;
        }

        .capsule span {
            color: var(--muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .side-panel {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .panel-title {
            margin: 0;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--amber);
        }

        .missions {
            display: grid;
            gap: 12px;
        }

        .mission-card {
            padding: 16px;
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
            background: rgba(255,255,255,0.04);
        }

        .mission-card:hover {
            transform: translateY(-2px);
            border-color: rgba(255, 210, 102, 0.32);
        }

        .mission-card.active {
            background: linear-gradient(135deg, rgba(255,210,102,0.15), rgba(89,198,255,0.08));
            border-color: rgba(255, 210, 102, 0.5);
        }

        .mission-card h3 {
            margin: 0 0 6px;
            font-size: 1.02rem;
        }

        .mission-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.93rem;
        }

        .screen-card {
            padding: 16px;
            background: rgba(255,255,255,0.04);
        }

        .screen-card h3 {
            margin: 0 0 10px;
            font-size: 0.98rem;
        }

        .chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 11px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.05);
            font-size: 0.84rem;
            color: var(--text);
        }

        .chip strong {
            font-size: 0.74rem;
            color: var(--amber);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .main-grid {
            margin-top: 24px;
            display: grid;
            grid-template-columns: minmax(0, 1.18fr) minmax(300px, 0.82fr);
            gap: 24px;
        }

        .packs {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .pack-card {
            padding: 18px;
            position: relative;
            overflow: hidden;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
            cursor: pointer;
        }

        .pack-card:hover {
            transform: translateY(-3px);
            border-color: rgba(150, 245, 255, 0.34);
        }

        .pack-card.selected {
            background: linear-gradient(150deg, rgba(89, 198, 255, 0.17), rgba(164, 255, 207, 0.08));
            border-color: rgba(150, 245, 255, 0.45);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.06);
        }

        .pack-card.locked {
            opacity: 0.45;
        }

        .pack-card::after {
            content: "";
            position: absolute;
            inset: auto -30px -30px auto;
            width: 110px;
            height: 110px;
            background: radial-gradient(circle, rgba(255,255,255,0.12), transparent 68%);
            pointer-events: none;
        }

        .pack-top {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 12px;
        }

        .pack-card h3 {
            margin: 0 0 8px;
            font-size: 1.08rem;
        }

        .pack-card p {
            margin: 0 0 14px;
            color: var(--muted);
            line-height: 1.5;
            font-size: 0.92rem;
        }

        .pack-size {
            white-space: nowrap;
            color: var(--amber);
            font-weight: 700;
        }

        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .tag {
            padding: 6px 9px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.05);
            color: #d8efff;
            font-size: 0.76rem;
            letter-spacing: 0.04em;
        }

        .telemetry {
            display: grid;
            gap: 14px;
        }

        .status-box {
            padding: 18px;
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background: var(--panel-strong);
        }

        .status-box h2 {
            margin: 0 0 8px;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            font-size: 1.8rem;
            letter-spacing: -0.03em;
        }

        .status-box p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 700;
            margin-bottom: 14px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.05);
        }

        .lookup {
            display: grid;
            gap: 12px;
        }

        .lookup input {
            width: 100%;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.09);
            background: rgba(4, 16, 24, 0.88);
            color: var(--text);
            padding: 14px 16px;
            font-size: 1rem;
        }

        .lookup-results {
            min-height: 156px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.06);
            padding: 14px;
            background: rgba(4, 16, 24, 0.74);
        }

        .result-item + .result-item {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid rgba(255,255,255,0.06);
        }

        .result-item h4 {
            margin: 0 0 4px;
            color: var(--glow);
        }

        .result-item p,
        .lookup-empty {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.92rem;
        }

        .footer-note {
            margin-top: 22px;
            color: var(--muted);
            text-align: center;
            line-height: 1.7;
        }

        .footer-note a {
            font-weight: 700;
        }

        .tiny {
            font-size: 0.82rem;
            color: var(--muted);
        }

        @media (max-width: 960px) {
            .pda,
            .main-grid {
                grid-template-columns: 1fr;
            }

            h1 {
                max-width: none;
            }
        }

        @media (max-width: 700px) {
            .wrap {
                width: min(100% - 16px, 100%);
                padding-top: 16px;
            }

            .hero {
                padding: 18px;
                border-radius: 26px;
            }

            .hero-top,
            .shell-top {
                flex-direction: column;
                align-items: start;
            }

            .capsule-grid,
            .packs {
                grid-template-columns: 1fr;
            }

            .hardware {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="hero-top">
                <div>
                    <div class="eyebrow">Offline Mission Builder</div>
                    <h1>Pocket Knowledge Loadout</h1>
                    <p class="lede">It is 2009, your stylus is ready, and your handheld has just enough room for a dangerous amount of knowledge. Build the best offline kit for prayer, curiosity, family adventures, and pleasantly nerdy emergencies without blowing past one gigabyte.</p>
                    <div class="hero-links">
                        <a href="index.php">Back to Chloe Reads Jon</a>
                        <a href="<?php echo htmlspecialchars($sourceUrl, ENT_QUOTES); ?>">Inspired by Jon's <?php echo htmlspecialchars($sourceTitle, ENT_QUOTES); ?></a>
                        <button type="button" id="randomizeBtn">Random sensible loadout</button>
                    </div>
                </div>
            </div>

            <div class="pda">
                <div class="shell">
                    <div class="shell-top">
                        <div>
                            <div class="tiny">Device profile</div>
                            <strong>Dell Axim X51v-ish daydream edition</strong>
                        </div>
                        <div class="hardware">
                            <span>624 MHz</span>
                            <span>1 GB card</span>
                            <span>Stylus mode</span>
                        </div>
                    </div>

                    <div class="screen">
                        <div class="screen-header">
                            <span>Storage map</span>
                            <span id="fitLabel">Ready</span>
                        </div>
                        <div class="storage-labels">
                            <span id="usedLabel">0 MB used</span>
                            <span>1024 MB max</span>
                        </div>
                        <div class="storage-meter"><div class="storage-fill" id="storageFill"></div></div>

                        <div class="capsule-grid">
                            <div class="capsule">
                                <span>Study</span>
                                <strong id="studyScore">0</strong>
                            </div>
                            <div class="capsule">
                                <span>Wonder</span>
                                <strong id="wonderScore">0</strong>
                            </div>
                            <div class="capsule">
                                <span>Prayer</span>
                                <strong id="prayerScore">0</strong>
                            </div>
                        </div>

                        <div class="stat-row">
                            <span>Mission readiness</span>
                            <span id="readinessLabel">0%</span>
                        </div>
                        <div class="micro-bar"><div class="micro-fill" id="readinessFill"></div></div>
                    </div>
                </div>

                <aside class="side-panel">
                    <h2 class="panel-title">Choose a mission</h2>
                    <div class="missions" id="missionList"></div>
                    <div class="screen-card">
                        <h3>Selected pack mood</h3>
                        <div class="chip-row" id="moodChips"></div>
                    </div>
                    <div class="screen-card">
                        <h3>Carry note</h3>
                        <p class="tiny" id="carryNote">Pick a mission and start tapping packs.</p>
                    </div>
                </aside>
            </div>
        </section>

        <section class="main-grid">
            <div>
                <div class="screen-card" style="margin-bottom: 16px;">
                    <h3>Tap packs to install them</h3>
                    <p class="tiny">The big encyclopedia is glorious but greedy. Smaller packs make a craftier little machine. Very old-tech, very charming, slightly ridiculous.</p>
                </div>
                <div class="packs" id="packGrid"></div>
            </div>

            <div class="telemetry">
                <div class="status-box">
                    <div class="badge" id="archetypeBadge">Blank slate</div>
                    <h2 id="archetypeTitle">Your pocket brain is empty</h2>
                    <p id="archetypeText">Install a few packs and the device will tell you what kind of tiny scholar-adventurer you have become.</p>
                </div>

                <div class="status-box lookup">
                    <div>
                        <div class="tiny">Offline lookup simulator</div>
                        <h3 style="margin: 6px 0 0;">What can this thing answer?</h3>
                    </div>
                    <input id="lookupInput" type="text" placeholder="Try: latin, mario, saint, map, stars">
                    <div class="lookup-results" id="lookupResults"></div>
                </div>
            </div>
        </section>

        <p class="footer-note">This playful loadout lab riffs on the delight of stuffing a handheld with useful things before smartphones made the trick feel ordinary. Inspired by Jon's <a href="<?php echo htmlspecialchars($sourceUrl, ENT_QUOTES); ?>"><?php echo htmlspecialchars($sourceTitle, ENT_QUOTES); ?></a>.</p>
    </div>

    <script>
        const maxStorage = 1024;
        const missions = [
            {
                id: 'commute',
                title: 'Quiet Commute',
                description: 'Build a calm, high-value kit for waiting rooms, buses, and stolen reading minutes.',
                goals: { study: 14, prayer: 8, wonder: 5 },
                note: 'A good commute setup feels like carrying a tiny monastery with a side pocket for trivia.'
            },
            {
                id: 'family',
                title: 'Nathan Road Trip',
                description: 'Balance delight, facts, and just enough structure to keep the back seat from mutiny.',
                goals: { study: 8, prayer: 4, wonder: 14 },
                note: 'Road trips reward surprise. A machine that can do saints, stars, and Mario lore is pulling its weight.'
            },
            {
                id: 'pilgrim',
                title: 'Pilgrim Pocket',
                description: 'Optimize for prayer, liturgy, and a bit of scholarly backup when curiosity strikes.',
                goals: { study: 10, prayer: 15, wonder: 6 },
                note: 'This is the sort of setup that whispers, “Yes, I did bring a Latin dictionary for fun.”'
            }
        ];

        const packs = [
            {
                id: 'wiki-full',
                name: 'Wikipedia 2009 Full',
                size: 860,
                summary: 'The glorious encyclopedic monster. Nearly everything, all at once, in a very greedy package.',
                tags: ['history', 'science', 'people'],
                study: 12, wonder: 11, prayer: 1,
                lookups: ['roman empire', 'volcano', 'jigsaw puzzle history', 'alan turing', 'cathedral architecture']
            },
            {
                id: 'wiki-pocket',
                name: 'Pocket Wikipedia',
                size: 175,
                summary: 'A condensed quick-reference pack. Far smaller, far craftier, still unexpectedly capable.',
                tags: ['reference', 'travel', 'compact'],
                study: 7, wonder: 6, prayer: 0,
                lookups: ['solar system', 'ancient greece', 'beavers', 'suspension bridge', 'fractal']
            },
            {
                id: 'douay',
                name: 'Douay-Rheims + Psalms',
                size: 9,
                summary: 'A compact Scripture shelf for prayer, study, and the occasional noble turn of phrase.',
                tags: ['scripture', 'prayer', 'latin-ish'],
                study: 4, wonder: 1, prayer: 9,
                lookups: ['psalm 23', 'beatitudes', 'prodigal son', 'hope', 'mercy']
            },
            {
                id: 'saints',
                name: 'Pocket Saints Catalog',
                size: 18,
                summary: 'Feast days, patronages, and small biographies for holy company on the go.',
                tags: ['saints', 'calendar', 'patrons'],
                study: 3, wonder: 4, prayer: 7,
                lookups: ['saint christopher', 'saint joseph', 'saint of coders', 'martyr', 'feast day']
            },
            {
                id: 'latin',
                name: 'Modern Latin Lexicon',
                size: 12,
                summary: 'For translating noble nonsense like instrumentum computatorium while looking smug.',
                tags: ['latin', 'language', 'study'],
                study: 5, wonder: 3, prayer: 3,
                lookups: ['computer in latin', 'gloria', 'ad orientem', 'liturgy', 'motto']
            },
            {
                id: 'great-books',
                name: 'Great Books Sampler',
                size: 44,
                summary: 'A little library of openings, speeches, and passages that make the room smarter by association.',
                tags: ['literature', 'classics', 'reading'],
                study: 6, wonder: 4, prayer: 1,
                lookups: ['iliad', 'augustine', 'jane austen', 'plato', 'dante']
            },
            {
                id: 'retro-games',
                name: 'Retro Strategy Guide Vault',
                size: 56,
                summary: 'Old FAQs, maps, and puzzle hints for handheld moments when pure achievement is required.',
                tags: ['games', 'maps', 'fun'],
                study: 1, wonder: 8, prayer: 0,
                lookups: ['zelda dungeon', 'mario secret', 'apple iic game', 'beamng tip', 'puzzle boss']
            },
            {
                id: 'road-atlas',
                name: 'Offline Road Atlas',
                size: 72,
                summary: 'Not glamorous, but wonderfully competent when the signal disappears and dignity remains.',
                tags: ['maps', 'travel', 'practical'],
                study: 2, wonder: 3, prayer: 0,
                lookups: ['victoria route', 'surrey map', 'bridge crossing', 'rest stop', 'ferry']
            },
            {
                id: 'stars',
                name: 'Night Sky Field Guide',
                size: 28,
                summary: 'Constellations, planets, and enough sky wonder to rescue a boring parking lot.',
                tags: ['space', 'nature', 'wonder'],
                study: 3, wonder: 8, prayer: 1,
                lookups: ['orion', 'saturn', 'meteor shower', 'north star', 'moon phase']
            },
            {
                id: 'birds',
                name: 'Pocket Bird Watcher',
                size: 21,
                summary: 'Calls, silhouettes, and cheerful little field notes for noticing the world properly.',
                tags: ['nature', 'audio-ish', 'outside'],
                study: 2, wonder: 7, prayer: 1,
                lookups: ['crow', 'owl', 'heron', 'sparrow', 'migration']
            },
            {
                id: 'notebook',
                name: 'Tombo Notes Archive',
                size: 6,
                summary: 'Saved ideas, snippets, checklists, and tiny sparks before they evaporate.',
                tags: ['notes', 'ideas', 'capture'],
                study: 4, wonder: 2, prayer: 2,
                lookups: ['blog idea', 'shopping list', 'family note', 'quote', 'reminder']
            },
            {
                id: 'chant',
                name: 'Gregorian Chant Primer',
                size: 14,
                summary: 'Modes, little notation helpers, and enough chant texture to make silence feel expensive.',
                tags: ['music', 'liturgy', 'calm'],
                study: 2, wonder: 3, prayer: 6,
                lookups: ['mode viii', 'chant', 'kyrie', 'latin hymn', 'psalm tone']
            }
        ];

        const missionList = document.getElementById('missionList');
        const packGrid = document.getElementById('packGrid');
        const usedLabel = document.getElementById('usedLabel');
        const fitLabel = document.getElementById('fitLabel');
        const storageFill = document.getElementById('storageFill');
        const studyScore = document.getElementById('studyScore');
        const wonderScore = document.getElementById('wonderScore');
        const prayerScore = document.getElementById('prayerScore');
        const readinessFill = document.getElementById('readinessFill');
        const readinessLabel = document.getElementById('readinessLabel');
        const archetypeBadge = document.getElementById('archetypeBadge');
        const archetypeTitle = document.getElementById('archetypeTitle');
        const archetypeText = document.getElementById('archetypeText');
        const lookupInput = document.getElementById('lookupInput');
        const lookupResults = document.getElementById('lookupResults');
        const moodChips = document.getElementById('moodChips');
        const carryNote = document.getElementById('carryNote');
        const randomizeBtn = document.getElementById('randomizeBtn');

        let activeMission = missions[0].id;
        let selected = new Set(['wiki-pocket', 'douay', 'notebook']);

        function missionById(id) {
            return missions.find((mission) => mission.id === id);
        }

        function currentPacks() {
            return packs.filter((pack) => selected.has(pack.id));
        }

        function totals() {
            return currentPacks().reduce((acc, pack) => {
                acc.size += pack.size;
                acc.study += pack.study;
                acc.wonder += pack.wonder;
                acc.prayer += pack.prayer;
                return acc;
            }, { size: 0, study: 0, wonder: 0, prayer: 0 });
        }

        function missionReadiness(sum, mission) {
            const study = Math.min(sum.study / mission.goals.study, 1);
            const wonder = Math.min(sum.wonder / mission.goals.wonder, 1);
            const prayer = Math.min(sum.prayer / mission.goals.prayer, 1);
            const storagePenalty = sum.size > maxStorage ? 0.15 : 1;
            return Math.round(((study + wonder + prayer) / 3) * 100 * storagePenalty);
        }

        function archetype(sum) {
            if (sum.size === 0) {
                return {
                    badge: 'Blank slate',
                    title: 'Your pocket brain is empty',
                    text: 'Install a few packs and the device will tell you what kind of tiny scholar-adventurer you have become.'
                };
            }

            if (sum.size > maxStorage) {
                return {
                    badge: 'Storage sinner',
                    title: 'You have attempted a minor miracle with a major memory card problem',
                    text: 'Your ambitions are glorious, but the poor PDA is gasping. Trim one or two indulgences and it will forgive you.'
                };
            }

            if (sum.prayer >= sum.study && sum.prayer >= sum.wonder) {
                return {
                    badge: 'Pilgrim mode',
                    title: 'You built a chapel with a screen protector',
                    text: 'This loadout is reverent, sturdy, and one Latin word away from becoming insufferably excellent.'
                };
            }

            if (sum.wonder > sum.study && sum.wonder >= sum.prayer) {
                return {
                    badge: 'Adventure mode',
                    title: 'You packed curiosity first and left boredom in the car',
                    text: 'Excellent instincts. This is the kind of handheld that turns a queue into a side quest.'
                };
            }

            return {
                badge: 'Scholar mode',
                title: 'You made a respectable little brick of knowing things',
                text: 'Dense, useful, and a touch smug. A librarian would nod. A child would still find one weird delight inside.'
            };
        }

        function renderMissions() {
            missionList.innerHTML = '';
            missions.forEach((mission) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'mission-card' + (mission.id === activeMission ? ' active' : '');
                button.innerHTML = `
                    <h3>${mission.title}</h3>
                    <p>${mission.description}</p>
                `;
                button.addEventListener('click', () => {
                    activeMission = mission.id;
                    carryNote.textContent = mission.note;
                    render();
                });
                missionList.appendChild(button);
            });
        }

        function renderPacks() {
            const sum = totals();
            packGrid.innerHTML = '';
            packs.forEach((pack) => {
                const nextSize = sum.size + (selected.has(pack.id) ? 0 : pack.size);
                const locked = !selected.has(pack.id) && nextSize > maxStorage;
                const article = document.createElement('article');
                article.className = 'pack-card' +
                    (selected.has(pack.id) ? ' selected' : '') +
                    (locked ? ' locked' : '');
                article.innerHTML = `
                    <div class="pack-top">
                        <div>
                            <h3>${pack.name}</h3>
                            <p>${pack.summary}</p>
                        </div>
                        <div class="pack-size">${pack.size} MB</div>
                    </div>
                    <div class="tag-row">
                        ${pack.tags.map((tag) => `<span class="tag">${tag}</span>`).join('')}
                    </div>
                `;
                article.addEventListener('click', () => {
                    if (selected.has(pack.id)) {
                        selected.delete(pack.id);
                    } else if (totals().size + pack.size <= maxStorage) {
                        selected.add(pack.id);
                    }
                    render();
                });
                packGrid.appendChild(article);
            });
        }

        function renderMood(sum) {
            const moods = [];
            if (sum.prayer >= 8) moods.push(['Tone', 'Prayerful']);
            if (sum.study >= 10) moods.push(['Tone', 'Scholarly']);
            if (sum.wonder >= 10) moods.push(['Tone', 'Joyfully nosy']);
            if (sum.size <= 300) moods.push(['Build', 'Featherweight']);
            if (sum.size >= 800) moods.push(['Build', 'Heroically overpacked']);
            if (!moods.length) moods.push(['Tone', 'Balanced']);
            moodChips.innerHTML = moods.map(([label, value]) => `<span class="chip"><strong>${label}</strong>${value}</span>`).join('');
        }

        function renderLookup() {
            const query = lookupInput.value.trim().toLowerCase();
            const activePacks = currentPacks();

            if (!query) {
                lookupResults.innerHTML = `<p class="lookup-empty">Start typing and the simulated device will search only the packs you installed. Old hardware, surprisingly sharp manners.</p>`;
                return;
            }

            const matches = activePacks
                .map((pack) => {
                    const hits = pack.lookups.filter((item) => item.includes(query));
                    if (pack.name.toLowerCase().includes(query) || pack.summary.toLowerCase().includes(query)) {
                        hits.unshift(pack.name);
                    }
                    return { pack, hits: [...new Set(hits)] };
                })
                .filter((entry) => entry.hits.length);

            if (!matches.length) {
                lookupResults.innerHTML = `<p class="lookup-empty">No direct match in the installed packs. This is the tax you pay for not bringing the giant encyclopedia.</p>`;
                return;
            }

            lookupResults.innerHTML = matches.map(({ pack, hits }) => `
                <div class="result-item">
                    <h4>${pack.name}</h4>
                    <p>${pack.summary}</p>
                    <p class="tiny">Likely hits: ${hits.slice(0, 4).join(', ')}</p>
                </div>
            `).join('');
        }

        function render() {
            const mission = missionById(activeMission);
            const sum = totals();
            const percent = Math.min((sum.size / maxStorage) * 100, 100);
            const readiness = missionReadiness(sum, mission);
            const persona = archetype(sum);

            renderMissions();
            renderPacks();
            renderMood(sum);

            usedLabel.textContent = `${sum.size} MB used`;
            fitLabel.textContent = sum.size > maxStorage ? 'Overflow' : `${maxStorage - sum.size} MB free`;
            storageFill.style.width = `${percent}%`;
            storageFill.style.background = sum.size > maxStorage
                ? 'linear-gradient(90deg, var(--danger), var(--rose))'
                : 'linear-gradient(90deg, var(--safe), var(--glow))';

            studyScore.textContent = sum.study;
            wonderScore.textContent = sum.wonder;
            prayerScore.textContent = sum.prayer;

            readinessLabel.textContent = `${readiness}%`;
            readinessFill.style.width = `${readiness}%`;
            readinessFill.style.background = readiness > 79
                ? 'linear-gradient(90deg, var(--safe), var(--glow))'
                : readiness > 49
                    ? 'linear-gradient(90deg, var(--amber), #ffefad)'
                    : 'linear-gradient(90deg, var(--rose), var(--danger))';

            archetypeBadge.textContent = persona.badge;
            archetypeTitle.textContent = persona.title;
            archetypeText.textContent = persona.text;
            carryNote.textContent = mission.note;

            renderLookup();
        }

        function randomizeLoadout() {
            const mission = missionById(activeMission);
            const missionPrefs = {
                commute: ['wiki-pocket', 'douay', 'notebook', 'great-books', 'chant', 'saints'],
                family: ['wiki-pocket', 'retro-games', 'road-atlas', 'stars', 'birds', 'saints'],
                pilgrim: ['douay', 'saints', 'latin', 'chant', 'wiki-pocket', 'notebook']
            };

            const ordered = [
                ...missionPrefs[mission.id].map((id) => packs.find((pack) => pack.id === id)),
                ...packs.filter((pack) => !missionPrefs[mission.id].includes(pack.id))
            ].filter(Boolean);

            selected = new Set();
            let used = 0;
            ordered.forEach((pack) => {
                const shouldTake = Math.random() > 0.34 || selected.size < 3;
                if (shouldTake && used + pack.size <= maxStorage) {
                    selected.add(pack.id);
                    used += pack.size;
                }
            });
            render();
        }

        lookupInput.addEventListener('input', renderLookup);
        randomizeBtn.addEventListener('click', randomizeLoadout);

        render();
    </script>
</body>
</html>
