<?php
$title = 'Time Machine Library';
$date = '2026-04-03';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        :root {
            --bg: #08111f;
            --panel: rgba(11, 22, 42, 0.82);
            --panel-strong: rgba(17, 31, 58, 0.92);
            --line: rgba(255,255,255,0.10);
            --text: #eef4ff;
            --muted: #aab9d6;
            --gold: #ffd36b;
            --cyan: #76e3ff;
            --rose: #ff9ec7;
            --mint: #7ff4c7;
            --violet: #b5a6ff;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top, rgba(118, 227, 255, 0.16), transparent 32%),
                radial-gradient(circle at 85% 15%, rgba(181, 166, 255, 0.20), transparent 26%),
                radial-gradient(circle at 12% 80%, rgba(255, 211, 107, 0.12), transparent 30%),
                linear-gradient(180deg, #091224 0%, #060c17 100%);
            color: var(--text);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255,255,255,0.16) 0 1px, transparent 1px),
                radial-gradient(circle at 70% 18%, rgba(255,255,255,0.14) 0 1px, transparent 1px),
                radial-gradient(circle at 40% 75%, rgba(255,255,255,0.13) 0 1px, transparent 1px),
                radial-gradient(circle at 90% 55%, rgba(255,255,255,0.12) 0 1px, transparent 1px);
            background-size: 280px 280px, 360px 360px, 420px 420px, 520px 520px;
            opacity: 0.7;
        }

        a { color: inherit; }

        .wrap {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 22px 0 34px;
        }

        .hero, .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .hero {
            padding: 26px;
            overflow: hidden;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -10% -45% auto;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 211, 107, 0.28), transparent 66%);
            filter: blur(8px);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: var(--gold);
            font-size: 0.88rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2.2rem, 6vw, 4.35rem);
            line-height: 0.95;
            letter-spacing: -0.05em;
            max-width: 10ch;
        }

        .hero p {
            margin: 0;
            max-width: 64ch;
            font-size: 1.06rem;
            line-height: 1.7;
            color: var(--muted);
            position: relative;
            z-index: 1;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
            position: relative;
            z-index: 1;
        }

        .chip {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            font-size: 0.95rem;
            color: #dce7ff;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.18fr 0.82fr;
            gap: 18px;
            margin-top: 18px;
        }

        .panel {
            padding: 22px;
        }

        .panel h2, .panel h3 {
            margin: 0 0 10px;
            letter-spacing: -0.02em;
        }

        .subtle {
            color: var(--muted);
            line-height: 1.6;
        }

        .controls {
            display: grid;
            gap: 16px;
        }

        .year-row {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 12px;
        }

        .year-badge {
            font-size: clamp(1.8rem, 4vw, 3.1rem);
            font-weight: 800;
            letter-spacing: -0.05em;
            color: var(--gold);
            min-width: 128px;
        }

        .era-label {
            justify-self: end;
            color: var(--cyan);
            font-weight: 600;
            text-align: right;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .button-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button {
            border: 0;
            cursor: pointer;
            border-radius: 16px;
            padding: 12px 16px;
            font: inherit;
            font-weight: 700;
            transition: transform 0.15s ease, opacity 0.15s ease, background 0.15s ease;
        }

        button:hover { transform: translateY(-1px); }
        button:active { transform: translateY(1px); }

        .primary {
            background: linear-gradient(135deg, var(--gold), #ffaf51);
            color: #261500;
        }

        .secondary {
            background: rgba(255,255,255,0.08);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .track-grid {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .track {
            position: relative;
            border-radius: 22px;
            padding: 18px;
            background: var(--panel-strong);
            border: 1px solid rgba(255,255,255,0.10);
            overflow: hidden;
        }

        .track::before {
            content: "";
            position: absolute;
            left: 18px;
            right: 18px;
            top: 50%;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transform: translateY(-50%);
        }

        .track-head {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .track-name {
            font-weight: 800;
            font-size: 1.05rem;
        }

        .track-small {
            color: var(--muted);
            font-size: 0.92rem;
        }

        .marker-rail {
            position: relative;
            height: 88px;
        }

        .marker {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.16);
            background: rgba(255,255,255,0.10);
            transition: transform 0.18s ease, box-shadow 0.18s ease, opacity 0.18s ease;
            opacity: 0.45;
        }

        .marker.is-near {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.25);
            box-shadow: 0 0 0 8px rgba(255,255,255,0.06);
        }

        .marker.is-current {
            transform: translate(-50%, -50%) scale(1.55);
            opacity: 1;
            box-shadow: 0 0 0 10px rgba(255,255,255,0.09), 0 0 28px currentColor;
        }

        .marker-label {
            position: absolute;
            top: 12px;
            transform: translateX(-50%);
            font-size: 0.72rem;
            white-space: nowrap;
            color: rgba(255,255,255,0.72);
            opacity: 0;
            transition: opacity 0.18s ease;
        }

        .marker.is-near + .marker-label,
        .marker.is-current + .marker-label {
            opacity: 1;
        }

        .history { color: var(--gold); }
        .music { color: var(--mint); }
        .poetry { color: var(--rose); }
        .art { color: var(--cyan); }

        .current-card {
            border-radius: 22px;
            padding: 18px;
            margin-top: 18px;
            background: linear-gradient(180deg, rgba(255,255,255,0.07), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.10);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.07);
            font-size: 0.84rem;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .current-title {
            font-size: clamp(1.45rem, 3vw, 2rem);
            margin: 0 0 6px;
            letter-spacing: -0.04em;
        }

        .meta {
            color: var(--muted);
            font-size: 0.96rem;
            margin-bottom: 12px;
        }

        blockquote {
            margin: 14px 0 0;
            padding: 0 0 0 16px;
            border-left: 3px solid rgba(255,255,255,0.16);
            color: #dfe9ff;
            line-height: 1.75;
        }

        .challenge {
            display: grid;
            gap: 12px;
        }

        .challenge-card {
            padding: 18px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(118, 227, 255, 0.08), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.10);
        }

        .answers {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .answer {
            text-align: left;
            background: rgba(255,255,255,0.06);
            color: var(--text);
            border: 1px solid rgba(255,255,255,0.10);
        }

        .answer.correct {
            background: rgba(127, 244, 199, 0.22);
            color: #f2fff9;
        }

        .answer.wrong {
            background: rgba(255, 120, 142, 0.18);
            color: #fff0f4;
        }

        .scorebox {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .stat {
            padding: 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.09);
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .footer-note {
            margin-top: 14px;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.7;
        }

        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .wrap {
                width: min(100% - 18px, 1120px);
                padding-top: 14px;
            }

            .hero, .panel { border-radius: 24px; }
            .hero, .panel, .track, .challenge-card, .current-card { padding: 18px; }
            .year-row { grid-template-columns: 1fr; }
            .era-label { justify-self: start; text-align: left; }
            .answers { grid-template-columns: 1fr; }
            .scorebox { grid-template-columns: 1fr; }
            .track::before { left: 12px; right: 12px; }
            .marker-label { display: none; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="eyebrow">📚 Inspired by a Jon Aquino blog post</div>
            <h1>Time Machine Library</h1>
            <p>
                Jon once described certain books as time machines: histories that let you travel across centuries in a few pages.
                So here’s a little library-console version of that idea. Slide through time, watch four cultural streams move together,
                and test whether you can place a moment in the right era.
            </p>
            <div class="chips">
                <div class="chip">History</div>
                <div class="chip">Music</div>
                <div class="chip">Poetry</div>
                <div class="chip">Art</div>
                <div class="chip">Mobile-friendly</div>
                <div class="chip">Tiny time-travel quiz included</div>
            </div>
        </section>

        <div class="grid">
            <section class="panel">
                <h2>Travel through the centuries</h2>
                <p class="subtle">Drag the year slider or hit autoplay. Each lane shows a different kind of human creativity, and the glowing markers wake up when your year gets close.</p>

                <div class="controls">
                    <div class="year-row">
                        <div class="year-badge" id="yearBadge">1300</div>
                        <input id="yearSlider" type="range" min="1300" max="1994" value="1300" step="1" aria-label="Year slider">
                        <div class="era-label" id="eraLabel">Late medieval world</div>
                    </div>

                    <div class="button-row">
                        <button class="primary" id="playButton" type="button">▶ Autoplay</button>
                        <button class="secondary" id="jumpBack" type="button">⏮ Earliest</button>
                        <button class="secondary" id="jumpForward" type="button">⏭ Latest</button>
                        <button class="secondary" id="randomMoment" type="button">🎲 Random year</button>
                    </div>
                </div>

                <div class="track-grid" id="trackGrid"></div>

                <div class="current-card" id="currentCard" aria-live="polite"></div>
            </section>

            <aside class="panel challenge">
                <div>
                    <h3>Century challenge</h3>
                    <p class="subtle">Nathan-friendly, Jon-friendly, mildly dangerous to your ego. You get a clue from one of the four streams. Pick the right century.</p>
                </div>

                <div class="scorebox">
                    <div class="stat">
                        <div class="stat-label">Score</div>
                        <div class="stat-value" id="scoreValue">0</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Streak</div>
                        <div class="stat-value" id="streakValue">0</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Rounds</div>
                        <div class="stat-value" id="roundValue">0</div>
                    </div>
                </div>

                <div class="challenge-card">
                    <div class="pill" id="challengeType">History clue</div>
                    <h3 class="current-title" id="challengeTitle">Loading a clue…</h3>
                    <div class="meta" id="challengePrompt">Pick the century that best matches this item.</div>
                    <blockquote id="challengeQuote"></blockquote>
                </div>

                <div class="answers" id="answerGrid"></div>
                <div class="button-row">
                    <button class="secondary" id="nextQuestion" type="button">Next clue</button>
                </div>

                <p class="footer-note">
                    Inspired by Jon's post about four books that act like time machines: one each for history, music, poetry, and art.
                    Different shelves, same human story.
                </p>
            </aside>
        </div>
    </div>

    <script>
        const tracks = [
            {
                key: 'history',
                name: 'History',
                colorClass: 'history',
                description: 'Civilizations, empires, upheavals, inventions.',
                items: [
                    { year: 1300, title: 'Late medieval Europe', creator: 'Historical world', blurb: 'Castles, monasteries, guilds, manuscripts, and a world that still feels close to legend.', quote: 'A world of stone churches, candlelight, and hand-copied memory.' },
                    { year: 1453, title: 'Fall of Constantinople', creator: 'Turning point', blurb: 'A hinge of history: the Byzantine capital falls, and Europe changes course.', quote: 'One city falls, and whole maps begin to tremble.' },
                    { year: 1776, title: 'Age of revolutions', creator: 'Atlantic world', blurb: 'Liberty, constitutions, upheaval, and new political languages are born.', quote: 'The old order does not vanish quietly.' },
                    { year: 1914, title: 'World at war', creator: '20th century crisis', blurb: 'Industrial modernity collides with catastrophe on a staggering scale.', quote: 'Progress and horror arrive on the same train.' },
                    { year: 1989, title: 'Fall of the Berlin Wall', creator: 'Modern history', blurb: 'A concrete division gives way, and millions feel history lurch forward in one weekend.', quote: 'Sometimes the wall stands for decades until suddenly it does not.' }
                ]
            },
            {
                key: 'music',
                name: 'Music',
                colorClass: 'music',
                description: 'Sacred chant, courtly dances, symphonies, modern unease.',
                items: [
                    { year: 750, title: 'Gregorian chant', creator: 'Liturgical tradition', blurb: 'Single-line sacred song, floating without a drumbeat, meant more for prayer than performance.', quote: 'A melody that seems less sung than breathed upward.' },
                    { year: 1600, title: 'Birth of opera', creator: 'Early Baroque', blurb: 'Voice, drama, and theatre fuse into something unexpectedly durable.', quote: 'Music leaves the chapel and strides onto the stage.' },
                    { year: 1721, title: 'Brandenburg Concerto', creator: 'J. S. Bach', blurb: 'Baroque energy, patterned delight, and lines that seem built by an engineer with a soul.', quote: 'Everything moves at once, and somehow everything fits.' },
                    { year: 1808, title: 'Beethoven’s Fifth', creator: 'Ludwig van Beethoven', blurb: 'Fate knocks. The orchestra answers with one of the most recognisable openings in history.', quote: 'Four notes, and the whole room changes shape.' },
                    { year: 1970, title: 'Danse Macabre', creator: 'George Crumb', blurb: 'Modern music turns uncanny and theatrical, like bones remembering rhythm.', quote: 'Beauty grows a few shadows and becomes more interesting.' }
                ]
            },
            {
                key: 'poetry',
                name: 'Poetry',
                colorClass: 'poetry',
                description: 'Language passing from lyric song to modern voice.',
                items: [
                    { year: 1300, title: 'Rawlinson Lyrics', creator: 'Medieval English verse', blurb: 'Early English lyric, musical and strange, with old words that still somehow smile.', quote: 'Come and daunce with me / In Irlande.' },
                    { year: 1816, title: 'Kubla Khan', creator: 'Samuel Taylor Coleridge', blurb: 'A dream-fragment becomes one of English poetry’s most haunted palaces.', quote: 'For he on honey-dew hath fed, / And drunk the milk of Paradise.' },
                    { year: 1855, title: 'Leaves of Grass', creator: 'Walt Whitman', blurb: 'Poetry gets larger lungs and starts speaking in the first person with astonishing confidence.', quote: 'I celebrate myself, and sing myself.' },
                    { year: 1922, title: 'The Waste Land', creator: 'T. S. Eliot', blurb: 'Modernity breaks into voices, fragments, allusions, and dry thunder.', quote: 'These fragments I have shored against my ruins.' },
                    { year: 1994, title: 'Stones and Bones', creator: 'Christopher Reid', blurb: 'A late-20th-century voice looking backward through myth and matter.', quote: 'We are not of their blood, springing instead from the bones of the Great Mother.' }
                ]
            },
            {
                key: 'art',
                name: 'Art',
                colorClass: 'art',
                description: 'From caves and icons to experiments with seeing itself.',
                items: [
                    { year: -17000, title: 'Cave paintings of bison', creator: 'Prehistoric artists', blurb: 'Before galleries, before criticism, before frames: pigment, animals, stone, torchlight.', quote: 'The wall becomes alive because someone wanted life to stay.' },
                    { year: 1504, title: 'The High Renaissance', creator: 'Michelangelo and company', blurb: 'Human form, balance, and confidence reach a kind of impossible calm.', quote: 'Bodies become architecture and prayer at once.' },
                    { year: 1872, title: 'Impressionism', creator: 'Monet era', blurb: 'Less polish, more light. The instant starts to matter more than the monument.', quote: 'Paint stops posing and starts shimmering.' },
                    { year: 1937, title: 'Guernica', creator: 'Pablo Picasso', blurb: 'A mural-sized cry against violence, fractured into angles and grief.', quote: 'The image refuses to let war become tidy.' },
                    { year: 1982, title: 'Photo-cubist experiment', creator: 'David Hockney', blurb: 'Vision breaks into many glances, then reassembles into a richer truth.', quote: 'You never really see from only one place.' }
                ]
            }
        ];

        // Art starts earlier than the visible slider range, but we still want the prehistoric marker pinned to the left edge.
        const visualMinYear = 1300;
        const visualMaxYear = 1994;

        const slider = document.getElementById('yearSlider');
        const yearBadge = document.getElementById('yearBadge');
        const eraLabel = document.getElementById('eraLabel');
        const trackGrid = document.getElementById('trackGrid');
        const currentCard = document.getElementById('currentCard');
        const playButton = document.getElementById('playButton');
        const randomMomentButton = document.getElementById('randomMoment');
        const jumpBack = document.getElementById('jumpBack');
        const jumpForward = document.getElementById('jumpForward');

        const challengeType = document.getElementById('challengeType');
        const challengeTitle = document.getElementById('challengeTitle');
        const challengePrompt = document.getElementById('challengePrompt');
        const challengeQuote = document.getElementById('challengeQuote');
        const answerGrid = document.getElementById('answerGrid');
        const nextQuestionButton = document.getElementById('nextQuestion');
        const scoreValue = document.getElementById('scoreValue');
        const streakValue = document.getElementById('streakValue');
        const roundValue = document.getElementById('roundValue');

        let autoTimer = null;
        let challengeState = { score: 0, streak: 0, rounds: 0, answered: false, current: null };

        function clampYear(year) {
            return Math.max(visualMinYear, Math.min(visualMaxYear, year));
        }

        function yearToPercent(year) {
            const clamped = clampYear(year);
            return ((clamped - visualMinYear) / (visualMaxYear - visualMinYear)) * 100;
        }

        function formatYear(year) {
            return year < 0 ? `${Math.abs(year)} BC` : `${year}`;
        }

        function describeEra(year) {
            if (year < 1450) return 'Late medieval world';
            if (year < 1600) return 'Renaissance and rediscovery';
            if (year < 1750) return 'Early modern and baroque';
            if (year < 1850) return 'Revolutions and romanticism';
            if (year < 1910) return 'Industrial age and expansion';
            if (year < 1950) return 'World wars and modern fracture';
            return 'Late modern memory';
        }

        function nearestItem(items, year) {
            return items.reduce((best, item) => {
                const itemDistance = Math.abs(clampYear(item.year) - year);
                const bestDistance = Math.abs(clampYear(best.year) - year);
                return itemDistance < bestDistance ? item : best;
            });
        }

        function overallNearest(year) {
            const matches = tracks.map(track => ({ track, item: nearestItem(track.items, year) }));
            matches.sort((a, b) => Math.abs(clampYear(a.item.year) - year) - Math.abs(clampYear(b.item.year) - year));
            return matches[0];
        }

        function renderTracks(year) {
            trackGrid.innerHTML = tracks.map(track => {
                const nearest = nearestItem(track.items, year);
                const markers = track.items.map(item => {
                    const distance = Math.abs(clampYear(item.year) - year);
                    const stateClass = distance <= 12 ? 'is-current' : distance <= 60 ? 'is-near' : '';
                    return `
                        <div class="marker ${track.colorClass} ${stateClass}" style="left:${yearToPercent(item.year)}%" title="${item.title} (${formatYear(item.year)})"></div>
                        <div class="marker-label" style="left:${yearToPercent(item.year)}%">${item.title}</div>
                    `;
                }).join('');

                return `
                    <div class="track">
                        <div class="track-head">
                            <div>
                                <div class="track-name ${track.colorClass}">${track.name}</div>
                                <div class="track-small">${track.description}</div>
                            </div>
                            <div class="track-small">Nearest stop: ${nearest.title}</div>
                        </div>
                        <div class="marker-rail">${markers}</div>
                    </div>
                `;
            }).join('');
        }

        function renderCurrentCard(year) {
            const closest = overallNearest(year);
            const { track, item } = closest;
            currentCard.innerHTML = `
                <div class="pill">Closest beacon: <strong class="${track.colorClass}" style="margin-left:6px;">${track.name}</strong></div>
                <h3 class="current-title">${item.title}</h3>
                <div class="meta">${track.name} • ${item.creator} • ${formatYear(item.year)}</div>
                <div class="subtle">${item.blurb}</div>
                <blockquote>${item.quote}</blockquote>
            `;
        }

        function updateYear(year) {
            yearBadge.textContent = formatYear(year);
            eraLabel.textContent = describeEra(year);
            renderTracks(year);
            renderCurrentCard(year);
        }

        function playTone(freq, duration = 0.08) {
            const AudioContextClass = window.AudioContext || window.webkitAudioContext;
            if (!AudioContextClass) return;
            if (!playTone.ctx) playTone.ctx = new AudioContextClass();
            const ctx = playTone.ctx;
            if (ctx.state === 'suspended') ctx.resume();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.value = freq;
            gain.gain.value = 0.0001;
            osc.connect(gain);
            gain.connect(ctx.destination);
            const now = ctx.currentTime;
            gain.gain.exponentialRampToValueAtTime(0.035, now + 0.01);
            gain.gain.exponentialRampToValueAtTime(0.0001, now + duration);
            osc.start(now);
            osc.stop(now + duration + 0.02);
        }

        function randomYear() {
            return Math.floor(Math.random() * (visualMaxYear - visualMinYear + 1)) + visualMinYear;
        }

        playButton.addEventListener('click', () => {
            if (autoTimer) {
                clearInterval(autoTimer);
                autoTimer = null;
                playButton.textContent = '▶ Autoplay';
                return;
            }
            playButton.textContent = '⏸ Pause';
            autoTimer = setInterval(() => {
                let next = Number(slider.value) + 6;
                if (next > visualMaxYear) next = visualMinYear;
                slider.value = String(next);
                updateYear(next);
                const nearest = overallNearest(next).item;
                const base = 180 + ((clampYear(nearest.year) - visualMinYear) / (visualMaxYear - visualMinYear)) * 500;
                playTone(base, 0.06);
            }, 140);
        });

        randomMomentButton.addEventListener('click', () => {
            const year = randomYear();
            slider.value = String(year);
            updateYear(year);
            playTone(420, 0.07);
        });

        jumpBack.addEventListener('click', () => {
            slider.value = String(visualMinYear);
            updateYear(visualMinYear);
        });

        jumpForward.addEventListener('click', () => {
            slider.value = String(visualMaxYear);
            updateYear(visualMaxYear);
        });

        slider.addEventListener('input', (event) => {
            updateYear(Number(event.target.value));
        });

        function centuryOf(year) {
            if (year < 0) {
                return `${Math.ceil(Math.abs(year) / 100)}th century BC`;
            }
            return `${Math.floor((year - 1) / 100) + 1}th century`;
        }

        function buildCenturyChoices(correctYear) {
            const correctCentury = centuryOf(correctYear);
            const base = correctYear < 0 ? -1 : Math.floor((correctYear - 1) / 100) + 1;
            const set = new Set([correctCentury]);
            while (set.size < 4) {
                const delta = [-4, -3, -2, -1, 1, 2, 3, 4][Math.floor(Math.random() * 8)];
                const candidateCentury = Math.max(1, base + delta);
                set.add(`${candidateCentury}th century`);
            }
            return [...set].sort(() => Math.random() - 0.5);
        }

        function nextChallenge() {
            const track = tracks[Math.floor(Math.random() * tracks.length)];
            const challengePool = track.items.filter(item => item.year >= 1);
            const item = challengePool[Math.floor(Math.random() * challengePool.length)];
            const choices = buildCenturyChoices(item.year);
            challengeState.answered = false;
            challengeState.current = { track, item, choices };

            challengeType.textContent = `${track.name} clue`;
            challengeTitle.textContent = item.title;
            challengePrompt.textContent = `Which century best matches ${item.title.toLowerCase()}?`;
            challengeQuote.textContent = item.quote;
            answerGrid.innerHTML = choices.map(choice => `<button class="answer" type="button" data-choice="${choice}">${choice}</button>`).join('');

            answerGrid.querySelectorAll('.answer').forEach(button => {
                button.addEventListener('click', () => handleAnswer(button));
            });
        }

        function handleAnswer(button) {
            if (challengeState.answered) return;
            challengeState.answered = true;
            challengeState.rounds += 1;

            const correct = centuryOf(challengeState.current.item.year);
            const chosen = button.dataset.choice;
            const buttons = [...answerGrid.querySelectorAll('.answer')];

            buttons.forEach(btn => {
                if (btn.dataset.choice === correct) btn.classList.add('correct');
                if (btn === button && chosen !== correct) btn.classList.add('wrong');
                btn.disabled = true;
            });

            if (chosen === correct) {
                challengeState.score += 1;
                challengeState.streak += 1;
                challengePrompt.textContent = `Correct. ${challengeState.current.item.title} belongs to the ${correct}.`;
                playTone(660, 0.1);
            } else {
                challengeState.streak = 0;
                challengePrompt.textContent = `Not quite. ${challengeState.current.item.title} belongs to the ${correct}.`;
                playTone(240, 0.12);
            }

            scoreValue.textContent = String(challengeState.score);
            streakValue.textContent = String(challengeState.streak);
            roundValue.textContent = String(challengeState.rounds);
        }

        nextQuestionButton.addEventListener('click', nextChallenge);

        updateYear(Number(slider.value));
        nextChallenge();
    </script>
</body>
</html>
