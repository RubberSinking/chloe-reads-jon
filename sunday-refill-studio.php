<?php
$sourceTitle = "Recharging on Sunday: Physical, emotional, intellectual, spiritual";
$sourceUrl = "https://jona.ca/2009/10/recharging-on-sunday-physical-emotional.html";

$decks = [
    "physical" => [
        ["title" => "Fresh-Air Lap", "tag" => "Gentle", "time" => "15 min", "desc" => "Take a short walk outside and look for three details you normally miss."],
        ["title" => "Stretch and Reset", "tag" => "Indoor", "time" => "10 min", "desc" => "Do a tiny stretch circuit with a glass of water waiting at the end like a medal."],
        ["title" => "Snack Architect", "tag" => "Kitchen", "time" => "20 min", "desc" => "Build a cheerful plate with fruit, protein, and one frankly unnecessary crunchy delight."],
        ["title" => "Family Ramble", "tag" => "Nathan-safe", "time" => "30 min", "desc" => "Go outside with Nathan energy in mind: meander, point at birds, avoid productivity."],
        ["title" => "Chair-to-Sun Ritual", "tag" => "Low battery", "time" => "8 min", "desc" => "Move one chair to the brightest patch of light and just sit there like a civilized cat."],
    ],
    "emotional" => [
        ["title" => "Rose and Thorn", "tag" => "Connection", "time" => "10 min", "desc" => "Trade one good thing and one hard thing from the week with someone you trust."],
        ["title" => "Tiny Hospitality", "tag" => "Warmth", "time" => "20 min", "desc" => "Text or call someone overlooked and ask one question that deserves a real answer."],
        ["title" => "Memory Shelf", "tag" => "Gentle", "time" => "15 min", "desc" => "Look at three old photos and name what each one still gives you."],
        ["title" => "Laugh Rehearsal", "tag" => "Play", "time" => "12 min", "desc" => "Watch or share something reliably funny. Emotional regulation can wear a silly hat."],
        ["title" => "Soft Landing", "tag" => "Low battery", "time" => "7 min", "desc" => "Sit somewhere comfortable and list what has felt heavy without trying to solve it."],
    ],
    "intellectual" => [
        ["title" => "Idea Margin", "tag" => "Creative", "time" => "15 min", "desc" => "Read one page from a book or article and scribble one idea it wakes up."],
        ["title" => "One Beautiful Paragraph", "tag" => "Literary", "time" => "12 min", "desc" => "Read something elegant aloud just for the sound of a well-made sentence."],
        ["title" => "Rabbit-Hole Pilgrimage", "tag" => "Curious", "time" => "25 min", "desc" => "Follow one wholesome curiosity trail without turning it into homework."],
        ["title" => "Mini Diagram", "tag" => "Hands-on", "time" => "18 min", "desc" => "Sketch a concept, a plan, or a memory as boxes and arrows until it starts behaving."],
        ["title" => "Pocket Fact Hunt", "tag" => "Nathan-safe", "time" => "10 min", "desc" => "Find one weird fact worth telling Nathan at dinner."],
    ],
    "spiritual" => [
        ["title" => "Psalms in a Chair", "tag" => "Quiet", "time" => "10 min", "desc" => "Read one psalm slowly and pause on the line that feels like it followed you home."],
        ["title" => "Church Window Gaze", "tag" => "Contemplative", "time" => "8 min", "desc" => "Sit with a sacred image or memory and let it do more talking than you do."],
        ["title" => "Gratitude Litany", "tag" => "Simple", "time" => "6 min", "desc" => "Name seven gifts from the week, including one that arrived disguised as inconvenience."],
        ["title" => "Walking Prayer", "tag" => "Physical", "time" => "20 min", "desc" => "Walk and pray one mystery, one psalm, or one repeated line until your mind unclenches."],
        ["title" => "Candle and Intention", "tag" => "Family", "time" => "9 min", "desc" => "Light a candle, name who needs prayer, and hold them there without theatrics."],
    ],
];

$spotlights = [
    ["label" => "If the week felt jagged", "copy" => "Choose the gentlest card in each lane. Sunday is not an audition for sainthood or optimization."],
    ["label" => "If you have Nathan with you", "copy" => "Aim for shared rituals with low friction, snack potential, and at least one laugh that would sound ridiculous out of context."],
    ["label" => "If your brain wants productivity cosplay", "copy" => "Pick one intellectually nourishing thing that is delight-first, not output-first. No spreadsheets in a fake moustache."],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunday Refill Studio</title>
    <style>
        :root {
            --ink: #241616;
            --paper: #f7edd8;
            --paper-2: #f0dfbf;
            --sun: #f0a13d;
            --wine: #8f3d2e;
            --forest: #415b43;
            --sky: #7ca6b8;
            --gold: #d5b15b;
            --shadow: 0 24px 70px rgba(54, 28, 14, 0.18);
            --radius: 28px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Palatino Linotype", "Book Antiqua", "URW Palladio L", serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top, rgba(255, 233, 194, 0.95), rgba(247, 237, 216, 0.86) 35%, rgba(239, 223, 191, 0.96) 65%, rgba(231, 213, 184, 1) 100%),
                linear-gradient(135deg, #f8e7c6, #eed8b4);
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        body::before {
            background:
                radial-gradient(circle at 12% 18%, rgba(240, 161, 61, 0.14), transparent 28%),
                radial-gradient(circle at 88% 12%, rgba(124, 166, 184, 0.14), transparent 24%),
                radial-gradient(circle at 74% 76%, rgba(143, 61, 46, 0.11), transparent 22%);
        }

        body::after {
            opacity: 0.16;
            background-image:
                linear-gradient(rgba(36, 22, 22, 0.35) 1px, transparent 1px),
                linear-gradient(90deg, rgba(36, 22, 22, 0.25) 1px, transparent 1px);
            background-size: 100% 22px, 22px 100%;
            mask-image: linear-gradient(to bottom, transparent, black 12%, black 88%, transparent);
        }

        a { color: inherit; }

        .page {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 60px;
        }

        .hero {
            position: relative;
            padding: 24px;
            border-radius: 34px;
            border: 1px solid rgba(82, 46, 24, 0.18);
            background: linear-gradient(180deg, rgba(255,255,255,0.45), rgba(255,247,229,0.78));
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            top: -180px;
            right: -120px;
            border-radius: 50%;
            background:
                repeating-conic-gradient(from 0deg, rgba(240,161,61,0.22) 0deg 10deg, rgba(240,161,61,0) 10deg 22deg);
            filter: blur(0.2px);
            opacity: 0.75;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255, 248, 233, 0.82);
            border: 1px solid rgba(143, 61, 46, 0.18);
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .hero-grid {
            position: relative;
            display: grid;
            grid-template-columns: 1.2fr 0.95fr;
            gap: 28px;
            margin-top: 18px;
        }

        h1 {
            margin: 12px 0 12px;
            font-size: clamp(2.8rem, 7vw, 5.7rem);
            line-height: 0.92;
            font-weight: 700;
            letter-spacing: -0.06em;
            max-width: 10ch;
        }

        .lede {
            max-width: 62ch;
            font-size: 1.08rem;
            line-height: 1.7;
            margin: 0 0 22px;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pill-link {
            text-decoration: none;
            padding: 11px 16px;
            border-radius: 999px;
            border: 1px solid rgba(36, 22, 22, 0.14);
            background: rgba(255, 250, 239, 0.9);
            transition: transform 180ms ease, background 180ms ease;
        }

        .pill-link:hover,
        .pill-link:focus-visible {
            transform: translateY(-2px);
            background: #fff6e4;
        }

        .sunboard {
            align-self: stretch;
            display: grid;
            gap: 14px;
        }

        .sun-card,
        .summary-card,
        .lane,
        .spotlight,
        .result-card {
            border-radius: var(--radius);
            border: 1px solid rgba(71, 39, 23, 0.14);
            background: rgba(255, 248, 234, 0.88);
            box-shadow: 0 14px 35px rgba(63, 32, 15, 0.08);
        }

        .sun-card {
            padding: 18px;
        }

        .sun-card h2,
        .summary-card h2,
        .result-card h2 {
            margin: 0 0 10px;
            font-size: 1rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .meter {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 12px;
        }

        .meter-segment {
            border-radius: 18px;
            padding: 14px 10px;
            text-align: center;
            font-size: 0.86rem;
            min-height: 102px;
            display: grid;
            align-content: center;
            gap: 6px;
            transition: transform 240ms ease, box-shadow 240ms ease;
        }

        .meter-segment span:first-child {
            font-size: 1.6rem;
        }

        .meter-segment.active {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(59, 31, 14, 0.14);
        }

        .meter-physical { background: linear-gradient(180deg, rgba(124, 166, 184, 0.33), rgba(124, 166, 184, 0.15)); }
        .meter-emotional { background: linear-gradient(180deg, rgba(143, 61, 46, 0.28), rgba(143, 61, 46, 0.12)); }
        .meter-intellectual { background: linear-gradient(180deg, rgba(213, 177, 91, 0.3), rgba(213, 177, 91, 0.12)); }
        .meter-spiritual { background: linear-gradient(180deg, rgba(65, 91, 67, 0.3), rgba(65, 91, 67, 0.12)); }

        .layout {
            margin-top: 24px;
            display: grid;
            grid-template-columns: 1.3fr 0.95fr;
            gap: 20px;
        }

        .control-board {
            display: grid;
            gap: 16px;
        }

        .lane {
            padding: 18px;
        }

        .lane-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 14px;
        }

        .lane h3 {
            margin: 0;
            font-size: 1.45rem;
            letter-spacing: -0.04em;
        }

        .lane p {
            margin: 0;
            line-height: 1.55;
        }

        .domain-chip {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            padding: 8px 11px;
            border-radius: 999px;
            border: 1px solid rgba(36, 22, 22, 0.14);
        }

        .controls {
            display: grid;
            gap: 12px;
            margin-top: 16px;
        }

        label {
            display: grid;
            gap: 6px;
            font-size: 0.9rem;
        }

        select {
            appearance: none;
            border: 1px solid rgba(36, 22, 22, 0.16);
            border-radius: 16px;
            background: rgba(255,255,255,0.65);
            padding: 12px 14px;
            font: inherit;
            color: inherit;
        }

        .summary-card,
        .result-card {
            padding: 18px;
        }

        .summary-card {
            position: sticky;
            top: 18px;
            display: grid;
            gap: 14px;
            align-self: start;
        }

        .sun-dial {
            aspect-ratio: 1;
            width: min(100%, 320px);
            margin: 0 auto;
            border-radius: 50%;
            background:
                conic-gradient(from -90deg,
                    rgba(124,166,184,0.82) 0 25%,
                    rgba(143,61,46,0.84) 25% 50%,
                    rgba(213,177,91,0.88) 50% 75%,
                    rgba(65,91,67,0.85) 75% 100%);
            position: relative;
            display: grid;
            place-items: center;
            box-shadow: inset 0 0 0 16px rgba(255,248,233,0.82), inset 0 0 0 32px rgba(36,22,22,0.08);
        }

        .sun-dial::after {
            content: "";
            width: 28%;
            height: 28%;
            border-radius: 50%;
            background: linear-gradient(180deg, #fff6df, #f0dcb4);
            box-shadow: 0 0 0 8px rgba(255,255,255,0.45);
        }

        .sun-marker {
            position: absolute;
            inset: 0;
        }

        .sun-marker span {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 42%;
            height: 2px;
            transform-origin: left center;
            opacity: 0.8;
        }

        .sun-marker i {
            position: absolute;
            right: -5px;
            top: -5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(36,22,22,0.76);
            box-shadow: 0 0 0 4px rgba(255,255,255,0.5);
        }

        .insight {
            display: grid;
            gap: 10px;
        }

        .insight-line {
            padding: 12px 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.58);
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        button {
            cursor: pointer;
            border: none;
            border-radius: 999px;
            padding: 13px 18px;
            font: inherit;
            color: #fff9ee;
            background: linear-gradient(135deg, #7d3328, #bb6a3f);
            box-shadow: 0 12px 24px rgba(125, 51, 40, 0.24);
            transition: transform 180ms ease, filter 180ms ease;
        }

        button:hover,
        button:focus-visible {
            transform: translateY(-2px);
            filter: saturate(1.06);
        }

        button.secondary {
            color: var(--ink);
            background: rgba(255, 251, 241, 0.92);
            border: 1px solid rgba(36,22,22,0.15);
            box-shadow: none;
        }

        .result-stack {
            display: grid;
            gap: 14px;
            margin-top: 18px;
        }

        .result-card {
            position: relative;
            overflow: hidden;
        }

        .result-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 8px;
            background: var(--accent, var(--gold));
        }

        .result-card h3 {
            margin: 0 0 8px;
            font-size: 1.25rem;
            letter-spacing: -0.03em;
        }

        .result-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
            font-size: 0.82rem;
        }

        .result-meta span {
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(36,22,22,0.1);
        }

        .spotlight-wrap {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .spotlight {
            padding: 18px;
        }

        .spotlight strong {
            display: block;
            margin-bottom: 8px;
            font-size: 0.94rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .footer-note {
            margin-top: 24px;
            padding: 18px 20px;
            border-radius: 24px;
            background: rgba(255,248,233,0.9);
            border: 1px solid rgba(36,22,22,0.1);
            line-height: 1.7;
        }

        .footer-note a {
            text-underline-offset: 0.18em;
        }

        @media (max-width: 960px) {
            .hero-grid,
            .layout,
            .spotlight-wrap {
                grid-template-columns: 1fr;
            }

            .summary-card {
                position: static;
            }

            h1 {
                max-width: none;
            }
        }

        @media (prefers-reduced-motion: no-preference) {
            .hero,
            .lane,
            .summary-card,
            .result-card,
            .spotlight {
                animation: rise 700ms ease both;
            }

            .lane:nth-child(2) { animation-delay: 60ms; }
            .lane:nth-child(3) { animation-delay: 120ms; }
            .lane:nth-child(4) { animation-delay: 180ms; }
            .lane:nth-child(5) { animation-delay: 240ms; }
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="eyebrow">Sunday Ritual Builder <span>•</span> Four-domain recharge</div>
            <div class="hero-grid">
                <div>
                    <h1>Sunday Refill Studio</h1>
                    <p class="lede">A little Sunday paper for your soul and nervous system. Tune how depleted each part of you feels, shuffle a balanced ritual, and leave with four small ways to feel more human again: physical, emotional, intellectual, and spiritual.</p>
                    <div class="hero-links">
                        <a class="pill-link" href="#board">Build my Sunday</a>
                        <a class="pill-link" href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer">Inspired by Jon's <?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>
                    </div>
                </div>
                <div class="sunboard">
                    <div class="sun-card">
                        <h2>Four-domain weather</h2>
                        <p>Each quadrant marks one lane of replenishment. If one is starving, the whole Sunday starts limping.</p>
                        <div class="meter" id="heroMeter">
                            <div class="meter-segment meter-physical active"><span>☀️</span><span>Physical</span><small id="hero-physical">Steady</small></div>
                            <div class="meter-segment meter-emotional"><span>❤</span><span>Emotional</span><small id="hero-emotional">Wobbly</small></div>
                            <div class="meter-segment meter-intellectual"><span>✦</span><span>Intellectual</span><small id="hero-intellectual">Hungry</small></div>
                            <div class="meter-segment meter-spiritual"><span>✢</span><span>Spiritual</span><small id="hero-spiritual">Quiet</small></div>
                        </div>
                    </div>
                    <div class="sun-card">
                        <h2>Output style</h2>
                        <p>Not a task manager. Not a guilt machine. More like a charming liturgical control panel for recovering your edges.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="layout" id="board">
            <div class="control-board">
                <div class="lane">
                    <div class="lane-head">
                        <div>
                            <h3>Set your Sunday weather</h3>
                            <p>Pick the mood of each lane and the amount of time you have. The studio will build a balanced refill plan from there.</p>
                        </div>
                        <span class="domain-chip">Mix board</span>
                    </div>
                    <div class="controls">
                        <label>Physical battery
                            <select data-domain="physical">
                                <option value="low">Running on fumes</option>
                                <option value="mid" selected>Steady but frayed</option>
                                <option value="high">Pretty bright</option>
                            </select>
                        </label>
                        <label>Emotional weather
                            <select data-domain="emotional">
                                <option value="low">Tender / overloaded</option>
                                <option value="mid" selected>Mixed but manageable</option>
                                <option value="high">Openhearted</option>
                            </select>
                        </label>
                        <label>Intellectual appetite
                            <select data-domain="intellectual">
                                <option value="low">Please no hard thinking</option>
                                <option value="mid">A little stimulation</option>
                                <option value="high" selected>I want an idea feast</option>
                            </select>
                        </label>
                        <label>Spiritual posture
                            <select data-domain="spiritual">
                                <option value="low">Need gentleness, not intensity</option>
                                <option value="mid" selected>Quietly receptive</option>
                                <option value="high">Ready for depth</option>
                            </select>
                        </label>
                        <label>Time budget
                            <select id="timeBudget">
                                <option value="15">Just 15 minutes</option>
                                <option value="45" selected>A tidy 45-minute Sunday pocket</option>
                                <option value="90">A lush 90-minute refill window</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="lane">
                    <div class="lane-head">
                        <div>
                            <h3>Choose your mode</h3>
                            <p>Family mode leans toward low-friction, shareable rituals. Solo mode is a little more bookish and monastery-adjacent.</p>
                        </div>
                        <span class="domain-chip">Tone</span>
                    </div>
                    <div class="controls">
                        <label>Sunday company
                            <select id="companionMode">
                                <option value="solo">Mostly me</option>
                                <option value="family" selected>Possibly with Nathan nearby</option>
                            </select>
                        </label>
                        <label>Desired vibe
                            <select id="vibeMode">
                                <option value="gentle" selected>Gentle and restorative</option>
                                <option value="playful">Playful and bright</option>
                                <option value="deep">Quiet and more contemplative</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="lane">
                    <div class="lane-head">
                        <div>
                            <h3>Generated ritual stack</h3>
                            <p>One card per domain. Shuffle until it feels plausible and maybe even a tiny bit irresistible.</p>
                        </div>
                        <span class="domain-chip">Your cards</span>
                    </div>
                    <div class="actions">
                        <button id="generateBtn">Shuffle my Sunday</button>
                        <button class="secondary" id="nudgeBtn">Make it gentler</button>
                        <button class="secondary" id="sparkBtn">Make it more playful</button>
                    </div>
                    <div class="result-stack" id="resultStack"></div>
                </div>
            </div>

            <aside class="summary-card">
                <h2>Sun Dial</h2>
                <div class="sun-dial" aria-hidden="true">
                    <div class="sun-marker" id="dialMarker">
                        <span style="transform: rotate(-60deg);"><i></i></span>
                        <span style="transform: rotate(20deg);"><i></i></span>
                        <span style="transform: rotate(110deg);"><i></i></span>
                        <span style="transform: rotate(200deg);"><i></i></span>
                    </div>
                </div>
                <div class="insight">
                    <div class="insight-line" id="insightLead">Today wants a balanced refill with extra tenderness on the emotional side.</div>
                    <div class="insight-line" id="insightPace">Pace: enough structure to feel cared for, not enough to start filing taxes recreationally.</div>
                    <div class="insight-line" id="insightTime">Time budget: 45 minutes, which is secretly plenty if you stop negotiating with your phone.</div>
                </div>
            </aside>
        </section>

        <section class="spotlight-wrap">
            <?php foreach ($spotlights as $spotlight): ?>
                <article class="spotlight">
                    <strong><?= htmlspecialchars($spotlight["label"], ENT_QUOTES) ?></strong>
                    <div><?= htmlspecialchars($spotlight["copy"], ENT_QUOTES) ?></div>
                </article>
            <?php endforeach; ?>
        </section>

        <p class="footer-note">
            Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($sourceTitle, ENT_QUOTES) ?></a>.
            That post laid out a simple four-part Sunday rhythm: physical, emotional, intellectual, and spiritual.
            This page turns that lovely little framework into a tactile planner you can actually play with.
        </p>
    </div>

    <script>
        const decks = <?= json_encode($decks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const domains = ["physical", "emotional", "intellectual", "spiritual"];
        const domainMeta = {
            physical: { icon: "☀️", title: "Physical", accent: "#7ca6b8" },
            emotional: { icon: "❤", title: "Emotional", accent: "#8f3d2e" },
            intellectual: { icon: "✦", title: "Intellectual", accent: "#d5b15b" },
            spiritual: { icon: "✢", title: "Spiritual", accent: "#415b43" }
        };
        const selectMap = Object.fromEntries(Array.from(document.querySelectorAll("select[data-domain]")).map((el) => [el.dataset.domain, el]));
        const resultStack = document.getElementById("resultStack");
        const heroLabels = {
            low: "Needs mercy",
            mid: "Steady-ish",
            high: "Bright"
        };

        function choice(list) {
            return list[Math.floor(Math.random() * list.length)];
        }

        function filterDeck(domain, state, mode, vibe) {
            const cards = decks[domain].filter((card) => {
                if (mode === "family" && card.tag === "Family") return true;
                if (mode === "family" && card.tag === "Nathan-safe") return true;
                if (state === "low" && card.tag === "Low battery") return true;
                if (vibe === "playful" && (card.tag === "Play" || card.tag === "Nathan-safe")) return true;
                if (vibe === "deep" && (card.tag === "Quiet" || card.tag === "Contemplative" || card.tag === "Literary")) return true;
                return state === "mid" || state === "high";
            });
            return cards.length ? cards : decks[domain];
        }

        function toneCopy(state, domain, vibe) {
            const matrix = {
                physical: {
                    low: "Keep it embarrassingly easy. Sunday is allowed to limp before it dances.",
                    mid: "A bit of movement will help without turning this into boot camp with incense.",
                    high: "You have enough battery for something pleasantly alive."
                },
                emotional: {
                    low: "Choose warmth over analysis. No self-cross-examination tribunal today.",
                    mid: "A little connection will likely steady the weather.",
                    high: "Your heart has spare room. Use some of it generously."
                },
                intellectual: {
                    low: "You need delight-sized thinking, not a dissertation in tweed.",
                    mid: "A small idea snack should hit nicely.",
                    high: "Your mind wants a good chew and probably a pencil."
                },
                spiritual: {
                    low: "Let prayer be simple and low-pressure, like knocking softly instead of storming the abbey.",
                    mid: "Quiet, receptive attention is enough.",
                    high: "You seem ready for a deeper pocket of stillness."
                }
            };
            let line = matrix[domain][state];
            if (vibe === "playful") line += " A touch of delight is not cheating.";
            if (vibe === "deep" && domain === "spiritual") line += " The silence might actually say something back.";
            return line;
        }

        function updateHero(stateMap) {
            domains.forEach((domain, idx) => {
                document.getElementById(`hero-${domain}`).textContent = heroLabels[stateMap[domain]];
                document.querySelectorAll(".meter-segment")[idx].classList.toggle("active", stateMap[domain] !== "low");
            });

            const lows = domains.filter((domain) => stateMap[domain] === "low");
            const highs = domains.filter((domain) => stateMap[domain] === "high");
            document.getElementById("insightLead").textContent =
                lows.length
                    ? `Today wants extra gentleness in ${lows.map((d) => domainMeta[d].title.toLowerCase()).join(" and ")}.`
                    : `Today looks fairly buoyant, with ${highs.length ? highs.map((d) => domainMeta[d].title.toLowerCase()).join(" and ") : "no single lane hogging the spotlight"}.`;
        }

        function buildPlan(forceVibe = null) {
            const mode = document.getElementById("companionMode").value;
            const vibe = forceVibe || document.getElementById("vibeMode").value;
            const timeBudget = Number(document.getElementById("timeBudget").value);
            const stateMap = Object.fromEntries(domains.map((domain) => [domain, selectMap[domain].value]));
            updateHero(stateMap);

            const paceCopy =
                vibe === "gentle" ? "Pace: restorative, forgiving, and pleasantly unambitious." :
                vibe === "playful" ? "Pace: light-footed and slightly mischievous, as a Sunday should occasionally be." :
                "Pace: slower, quieter, and a little more chapel-coded.";

            document.getElementById("insightPace").textContent = paceCopy;
            document.getElementById("insightTime").textContent =
                `Time budget: ${timeBudget} minutes, which is enough for ${timeBudget <= 15 ? "tiny but real repair work." : timeBudget <= 45 ? "a compact and meaningful reset." : "a luxuriously unhurried refill ritual."}`;

            const plans = domains.map((domain) => {
                const picked = choice(filterDeck(domain, stateMap[domain], mode, vibe));
                return { domain, state: stateMap[domain], ...picked };
            });

            resultStack.innerHTML = plans.map((plan) => `
                <article class="result-card" style="--accent:${domainMeta[plan.domain].accent}">
                    <h2>${domainMeta[plan.domain].icon} ${domainMeta[plan.domain].title}</h2>
                    <h3>${plan.title}</h3>
                    <div class="result-meta">
                        <span>${plan.time}</span>
                        <span>${plan.tag}</span>
                        <span>${plan.state === "low" ? "Handle gently" : plan.state === "mid" ? "Steady support" : "Bright energy"}</span>
                    </div>
                    <p>${plan.desc}</p>
                    <p><strong>Why this fits:</strong> ${toneCopy(plan.state, plan.domain, vibe)}</p>
                </article>
            `).join("");
        }

        document.getElementById("generateBtn").addEventListener("click", () => buildPlan());
        document.getElementById("nudgeBtn").addEventListener("click", () => buildPlan("gentle"));
        document.getElementById("sparkBtn").addEventListener("click", () => buildPlan("playful"));
        document.querySelectorAll("select").forEach((el) => el.addEventListener("change", () => buildPlan()));

        buildPlan();
    </script>
</body>
</html>
