<?php
$now = new DateTime('now', new DateTimeZone('America/Vancouver'));
$defaultDay = (int) $now->format('z') + 1;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bible Year Pilgrimage</title>
    <style>
        :root {
            --night: #0d1324;
            --ink: #11172d;
            --paper: #f6ecd2;
            --paper-2: #eadcb5;
            --gold: #d9a441;
            --gold-soft: rgba(217, 164, 65, 0.24);
            --wine: #6d2f4e;
            --moss: #60724e;
            --sky: #8aa6d9;
            --text: #f6f0e3;
            --muted: rgba(246, 240, 227, 0.72);
            --shadow: 0 22px 60px rgba(2, 6, 18, 0.4);
        }

        * { box-sizing: border-box; }

        html {
            scroll-behavior: smooth;
            background:
                radial-gradient(circle at top, rgba(138, 166, 217, 0.22), transparent 28%),
                linear-gradient(180deg, #111a31 0%, #0b1021 58%, #090d17 100%);
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            background:
                radial-gradient(circle at 20% 10%, rgba(255,255,255,0.08), transparent 18%),
                radial-gradient(circle at 85% 12%, rgba(217, 164, 65, 0.12), transparent 20%),
                linear-gradient(180deg, rgba(7, 10, 20, 0.15), rgba(7, 10, 20, 0.42));
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(circle, rgba(255,255,255,0.65) 0.7px, transparent 0.8px),
                radial-gradient(circle, rgba(255,255,255,0.28) 0.5px, transparent 0.7px);
            background-size: 140px 140px, 90px 90px;
            background-position: 0 0, 32px 44px;
            opacity: 0.34;
            mix-blend-mode: screen;
        }

        .shell {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 64px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(245, 227, 180, 0.18);
            border-radius: 28px;
            padding: 28px;
            background:
                linear-gradient(145deg, rgba(18, 26, 50, 0.9), rgba(12, 18, 35, 0.92)),
                linear-gradient(180deg, rgba(255,255,255,0.03), transparent 45%);
            box-shadow: var(--shadow);
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(217, 164, 65, 0.18);
            border-radius: 22px;
            pointer-events: none;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 24px;
            align-items: start;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(234, 220, 181, 0.08);
            border: 1px solid rgba(234, 220, 181, 0.12);
            color: var(--paper);
            letter-spacing: 0.09em;
            text-transform: uppercase;
            font-size: 0.7rem;
        }

        h1, h2, h3, .display {
            font-family: "Baskerville", "Iowan Old Style", "Times New Roman", serif;
            letter-spacing: -0.03em;
        }

        h1 {
            margin: 16px 0 14px;
            font-size: clamp(2.4rem, 7vw, 4.9rem);
            line-height: 0.94;
            max-width: 9ch;
        }

        .lede {
            margin: 0;
            max-width: 58ch;
            color: var(--muted);
            font-size: 1.04rem;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .button {
            appearance: none;
            border: none;
            cursor: pointer;
            border-radius: 999px;
            padding: 12px 18px;
            font: inherit;
            font-size: 0.95rem;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        .button:hover { transform: translateY(-1px); }

        .button.primary {
            color: #1b1420;
            background: linear-gradient(135deg, #f4d58a, #d9a441);
            box-shadow: 0 12px 30px rgba(217, 164, 65, 0.24);
        }

        .button.secondary {
            color: var(--paper);
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
        }

        .oracle-card, .panel, .station-card {
            border: 1px solid rgba(234, 220, 181, 0.12);
            background: rgba(255,255,255,0.035);
            backdrop-filter: blur(8px);
            box-shadow: var(--shadow);
        }

        .oracle-card {
            position: relative;
            border-radius: 24px;
            padding: 22px;
            min-height: 100%;
            overflow: hidden;
        }

        .oracle-card::before {
            content: "";
            position: absolute;
            inset: auto -10% -34% auto;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(217, 164, 65, 0.2), transparent 60%);
            filter: blur(8px);
        }

        .mini-label {
            color: rgba(246, 240, 227, 0.68);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.72rem;
        }

        .day-badge {
            display: inline-flex;
            align-items: baseline;
            gap: 10px;
            margin-top: 10px;
            margin-bottom: 16px;
        }

        .day-badge .day-number {
            font-size: clamp(2.6rem, 7vw, 4.2rem);
            line-height: 0.9;
            color: var(--paper);
        }

        .day-badge .day-copy {
            color: var(--muted);
            max-width: 16ch;
        }

        .hero-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .metric {
            padding: 14px;
            border-radius: 18px;
            background: rgba(9, 14, 28, 0.5);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .metric strong {
            display: block;
            font-size: 1.15rem;
            margin-top: 4px;
            color: var(--paper);
        }

        .layout {
            display: grid;
            grid-template-columns: 1.12fr 0.88fr;
            gap: 22px;
            margin-top: 22px;
        }

        .panel {
            border-radius: 28px;
            padding: 22px;
            position: relative;
            overflow: hidden;
        }

        .panel h2 {
            margin: 0 0 8px;
            font-size: clamp(1.55rem, 4vw, 2.25rem);
        }

        .panel p.section-copy {
            margin: 0 0 18px;
            color: var(--muted);
            line-height: 1.7;
        }

        .tracker {
            padding-bottom: 26px;
        }

        .range-wrap {
            margin: 18px 0 24px;
        }

        input[type="range"] {
            width: 100%;
            appearance: none;
            height: 7px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold) var(--fill, 0%), rgba(255,255,255,0.12) var(--fill, 0%), rgba(255,255,255,0.12) 100%);
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #fff6da;
            background: radial-gradient(circle at 30% 30%, #fff5c7, #d9a441 70%);
            box-shadow: 0 8px 18px rgba(0,0,0,0.35);
        }

        input[type="range"]::-moz-range-thumb {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid #fff6da;
            background: radial-gradient(circle at 30% 30%, #fff5c7, #d9a441 70%);
            box-shadow: 0 8px 18px rgba(0,0,0,0.35);
        }

        .tracker-topline {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
            align-items: end;
        }

        .tracker-day {
            font-size: clamp(2rem, 5vw, 3.2rem);
            line-height: 0.9;
        }

        .tracker-meta {
            color: var(--muted);
            text-align: right;
        }

        .chapter-strip {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 14px 0 18px;
        }

        .pill {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.08);
            font-size: 0.94rem;
        }

        .progress-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .progress-tile {
            border-radius: 18px;
            padding: 14px;
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.09);
        }

        .progress-label {
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.09em;
            color: rgba(246,240,227,0.62);
        }

        .progress-value {
            margin-top: 7px;
            font-size: 1.15rem;
        }

        .path {
            display: grid;
            gap: 14px;
            margin-top: 10px;
        }

        .station-card {
            position: relative;
            border-radius: 22px;
            padding: 18px 18px 18px 56px;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
            cursor: pointer;
        }

        .station-card:hover { transform: translateY(-2px); }

        .station-card.active {
            border-color: rgba(217, 164, 65, 0.45);
            background: linear-gradient(135deg, rgba(217, 164, 65, 0.14), rgba(255,255,255,0.05));
        }

        .station-card::before {
            content: attr(data-index);
            position: absolute;
            left: 17px;
            top: 18px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #1b1420;
            font-weight: 700;
            background: linear-gradient(135deg, #f5ddb2, #d9a441);
        }

        .station-card h3 {
            margin: 0 0 7px;
            font-size: 1.18rem;
        }

        .station-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.95rem;
        }

        .focus-card {
            margin-top: 20px;
            border-radius: 24px;
            padding: 22px;
            background:
                linear-gradient(135deg, rgba(109, 47, 78, 0.2), rgba(96, 114, 78, 0.18)),
                rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .focus-card h3 {
            margin: 0 0 8px;
            font-size: 1.5rem;
        }

        .focus-card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .prompts {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .prompt {
            border-left: 3px solid rgba(217, 164, 65, 0.75);
            padding: 12px 14px;
            border-radius: 0 16px 16px 0;
            background: rgba(0,0,0,0.18);
            color: var(--paper);
        }

        .compass {
            margin-top: 22px;
            display: grid;
            gap: 14px;
        }

        .mode-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .mode {
            border-radius: 20px;
            padding: 14px;
            min-height: 126px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(10,16,30,0.5);
        }

        .mode strong {
            display: block;
            margin-bottom: 6px;
            font-size: 1rem;
        }

        .mode p {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
            font-size: 0.92rem;
        }

        .footer-note {
            margin-top: 18px;
            color: rgba(246,240,227,0.6);
            font-size: 0.86rem;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .hero-grid, .layout { grid-template-columns: 1fr; }
            .hero { padding: 20px; }
        }

        @media (max-width: 640px) {
            .shell { width: min(100% - 18px, 1120px); padding-top: 18px; }
            .hero-actions, .chapter-strip, .tracker-topline { gap: 10px; }
            .hero-metrics, .progress-row, .mode-grid { grid-template-columns: 1fr; }
            .station-card { padding-left: 52px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Illuminated listening guide</div>
                    <h1>Bible Year Pilgrimage</h1>
                    <p class="lede">A little manuscript-meets-star-chart companion for walking through Scripture over a year. Glide through the days, visit the big story stations, and steal a few lovely prompts when you want the podcast to feel less like a checklist and more like a journey.</p>
                    <div class="hero-actions">
                        <button class="button primary" id="jumpToday">Take me to today</button>
                        <button class="button secondary" id="surpriseStop">Find a memorable stop</button>
                    </div>
                </div>
                <aside class="oracle-card">
                    <div class="mini-label">Today&apos;s lantern</div>
                    <div class="day-badge">
                        <div class="day-number" id="heroDay"><?php echo $defaultDay; ?></div>
                        <div class="day-copy" id="heroCopy">Tracing the long road from promise to fulfillment.</div>
                    </div>
                    <div class="mini-label">Pilgrim&apos;s measure</div>
                    <div class="hero-metrics">
                        <div class="metric">
                            <span class="mini-label">Season</span>
                            <strong id="heroSeason">The Long Beginning</strong>
                        </div>
                        <div class="metric">
                            <span class="mini-label">Milestone</span>
                            <strong id="heroMilestone">Genesis opens</strong>
                        </div>
                        <div class="metric">
                            <span class="mini-label">Pace</span>
                            <strong>20 min</strong>
                        </div>
                    </div>
                </aside>
            </div>
        </section>

        <div class="layout">
            <section class="panel tracker">
                <h2>The Road by Day</h2>
                <p class="section-copy">Move the slider and watch the year reframe itself. This is not a literal episode transcript, darling, just a handsome orientation wheel so the whole year stops feeling like 365 identical beige rectangles.</p>

                <div class="tracker-topline">
                    <div>
                        <div class="mini-label">Reading day</div>
                        <div class="tracker-day" id="trackerDay">Day <?php echo $defaultDay; ?></div>
                    </div>
                    <div class="tracker-meta">
                        <div class="mini-label">Approximate completion</div>
                        <div id="trackerPercent">0% of the pilgrimage</div>
                    </div>
                </div>

                <div class="range-wrap">
                    <input type="range" min="1" max="365" value="<?php echo $defaultDay; ?>" id="daySlider" aria-label="Choose a day of the year">
                </div>

                <div class="chapter-strip" id="chapterStrip"></div>

                <div class="focus-card">
                    <div class="mini-label">Current vista</div>
                    <h3 id="focusTitle">Genesis opens the door</h3>
                    <p id="focusBody">Creation, fall, covenant, and the first aching hints that the whole story is headed somewhere astonishing.</p>
                </div>

                <div class="progress-row">
                    <div class="progress-tile">
                        <div class="progress-label">Story lane</div>
                        <div class="progress-value" id="storyLane">Patriarchs and promise</div>
                    </div>
                    <div class="progress-tile">
                        <div class="progress-label">Prayer lane</div>
                        <div class="progress-value" id="prayerLane">A psalm of trust</div>
                    </div>
                    <div class="progress-tile">
                        <div class="progress-label">Look for</div>
                        <div class="progress-value" id="lookFor">What God repeats</div>
                    </div>
                </div>

                <div class="prompts" id="promptList"></div>
            </section>

            <section class="panel">
                <h2>Major Story Stations</h2>
                <p class="section-copy">Tap any station to jump there. I gave the page a pilgrimage-map vibe because Jon likes things that feel considered, and because Scripture frankly deserves better than app-store mush.</p>
                <div class="path" id="path"></div>

                <div class="compass">
                    <div class="mini-label">Three ways to use it</div>
                    <div class="mode-grid">
                        <div class="mode">
                            <strong>Morning lantern</strong>
                            <p>Pick your day, read the prompts, and carry one repeated phrase into the rest of the day.</p>
                        </div>
                        <div class="mode">
                            <strong>Car-ride catchup</strong>
                            <p>Jump to a missed station, get the gist, then listen without that faint feeling of narrative whiplash.</p>
                        </div>
                        <div class="mode">
                            <strong>Nathan mode</strong>
                            <p>Use the stations as bedtime waypoints: flood, kings, exile, Jesus, early Church. Big arcs first, details later.</p>
                        </div>
                    </div>
                </div>

                <p class="footer-note">Inspired by the simple brilliance of listening through the whole Bible in a year: one long thread, one patient day at a time.</p>
            </section>
        </div>
    </div>

    <script>
        const stations = [
            {
                start: 1,
                end: 18,
                title: "Origins and the first promises",
                subtitle: "Genesis opens the door",
                season: "The Long Beginning",
                milestone: "Creation to covenant",
                chapters: ["Genesis", "Job", "Psalm threads"],
                storyLane: "Patriarchs and promise",
                prayerLane: "A psalm of trust",
                lookFor: "What God repeats",
                heroCopy: "Tracing the long road from promise to fulfillment.",
                body: "Creation, fall, covenant, and the first aching hints that the whole story is headed somewhere astonishing.",
                prompts: [
                    "Which promise in today&apos;s reading feels bigger than the people hearing it?",
                    "What starts broken immediately, and what mercy appears just as quickly?",
                    "If Nathan were listening beside you, which scene would make the best bedtime retelling?"
                ]
            },
            {
                start: 19,
                end: 46,
                title: "Descent into Egypt",
                subtitle: "Families, famine, and strange providence",
                season: "The Long Beginning",
                milestone: "Joseph descends",
                chapters: ["Genesis", "Exodus", "Wisdom detours"],
                storyLane: "Providence in disguise",
                prayerLane: "A cry from underground",
                lookFor: "Hidden rescue",
                heroCopy: "God keeps sneaking grace through family chaos.",
                body: "Genesis tightens into family drama, betrayal, reconciliation, and the odd comfort that even the messy chapters are still under providence.",
                prompts: [
                    "Where does God work quietly instead of spectacularly?",
                    "Who changes more than you expected this stretch?",
                    "What part of the family story refuses to become simple?"
                ]
            },
            {
                start: 47,
                end: 75,
                title: "Sea road and mountain fire",
                subtitle: "Exodus and covenant",
                season: "Deliverance",
                milestone: "Red Sea crossing",
                chapters: ["Exodus", "Leviticus", "Psalms"],
                storyLane: "Liberation and law",
                prayerLane: "Victory song",
                lookFor: "Freedom with direction",
                heroCopy: "The story stops wandering and starts marching.",
                body: "Deliverance is glorious, but then comes formation: worship, obedience, and the realization that rescued people still need reshaping.",
                prompts: [
                    "What does freedom require after the dramatic rescue scene ends?",
                    "Which command feels less arbitrary when placed beside the covenant story?",
                    "Where do you hear gratitude turn into grumbling?"
                ]
            },
            {
                start: 76,
                end: 104,
                title: "Desert school",
                subtitle: "Numbers and the long interior test",
                season: "Wilderness",
                milestone: "Forty-year loop",
                chapters: ["Numbers", "Deuteronomy", "Psalm replies"],
                storyLane: "Trust under pressure",
                prayerLane: "Lament with memory",
                lookFor: "Patterns of forgetting",
                heroCopy: "This stretch loves exposing the heart. Rude, but useful.",
                body: "The wilderness becomes a laboratory for memory, complaint, obedience, and second chances. Nobody looks sleek out there, which is half the point.",
                prompts: [
                    "What does the people&apos;s complaining reveal about their imagination of God?",
                    "Which warning is really an invitation to remember?",
                    "Where does leadership look lonely in this section?"
                ]
            },
            {
                start: 105,
                end: 133,
                title: "Crossing over",
                subtitle: "Joshua and the land",
                season: "Threshold",
                milestone: "Jordan crossed",
                chapters: ["Joshua", "Judges", "Prayer echoes"],
                storyLane: "Inheritance and hazard",
                prayerLane: "Courage psalm",
                lookFor: "What must be remembered after victory",
                heroCopy: "The promised land arrives with both wonder and warnings attached.",
                body: "Fulfillment is never the end of the story. The land is gift, vocation, danger, and test all at once.",
                prompts: [
                    "What memorial or ritual helps the people remember what God has done?",
                    "Where does success already contain the seeds of drift?",
                    "Which figure here would make the strongest action-movie cold open?"
                ]
            },
            {
                start: 134,
                end: 162,
                title: "Judges, kings, and wild reversals",
                subtitle: "The crown enters the room",
                season: "Turbulent Kingdom",
                milestone: "David rises",
                chapters: ["Judges", "Ruth", "1 Samuel", "2 Samuel"],
                storyLane: "From chaos to kingship",
                prayerLane: "Psalm of longing",
                lookFor: "The difference between stature and heart",
                heroCopy: "Magnificent heroes, ghastly failures, very human kingdom stuff.",
                body: "This stretch turns cinematic fast: unlikely deliverers, private faithfulness, public collapse, and the aching emergence of Davidic hope.",
                prompts: [
                    "Who seems impressive at first and disappointing later?",
                    "What small act of fidelity ends up mattering enormously?",
                    "How does the story teach you to judge leaders more carefully?"
                ]
            },
            {
                start: 163,
                end: 191,
                title: "Temple light and divided loyalties",
                subtitle: "Solomon to schism",
                season: "Turbulent Kingdom",
                milestone: "Temple dedicated",
                chapters: ["1 Kings", "2 Kings", "Proverbs"],
                storyLane: "Glory and fracture",
                prayerLane: "Wisdom song",
                lookFor: "What success can corrupt",
                heroCopy: "Splendour first, splintering next. Scripture does not do sentimental monarchy.",
                body: "The temple blazes with beauty, but divided hearts and divided kingdoms creep in almost immediately. It's elegant and tragic in equal measure.",
                prompts: [
                    "Where does abundance become a temptation instead of a blessing?",
                    "What warning signs appear before the open collapse?",
                    "Which proverb would be worth carrying into the workday?"
                ]
            },
            {
                start: 192,
                end: 220,
                title: "Prophets on the ramparts",
                subtitle: "Fire, thunder, and pleas to return",
                season: "Prophetic Alarm",
                milestone: "Elijah confronts the age",
                chapters: ["Kings", "Isaiah", "Hosea", "Amos"],
                storyLane: "Judgment and mercy",
                prayerLane: "A wake-up psalm",
                lookFor: "Where the warning is actually love",
                heroCopy: "The prophets are less 'calm suggestion' and more holy air raid siren.",
                body: "Here the Bible gets bracing. Idolatry, injustice, and spiritual sleep are named with unnerving clarity, yet always with a path home still visible.",
                prompts: [
                    "Which prophetic image is impossible to shake off?",
                    "Where does God sound wounded rather than merely angry?",
                    "What modern habit would this section probably roast?"
                ]
            },
            {
                start: 221,
                end: 249,
                title: "Exile and tears",
                subtitle: "Losing the place, keeping the promise",
                season: "Exile",
                milestone: "Jerusalem falls",
                chapters: ["Jeremiah", "Lamentations", "Ezekiel", "Daniel"],
                storyLane: "Judgment that purifies",
                prayerLane: "Lament and stubborn hope",
                lookFor: "What cannot be taken away",
                heroCopy: "Everything collapses except the covenant thread. Stubborn little thing.",
                body: "Exile strips away illusion. What remains is grief, repentance, vision, and the startling discovery that God has not abandoned the story after all.",
                prompts: [
                    "Which loss feels central in this stretch: land, temple, innocence, control?",
                    "Where does hope arrive in a shape you did not expect?",
                    "What image here would look incredible in stained glass?"
                ]
            },
            {
                start: 250,
                end: 278,
                title: "Return and rebuilding",
                subtitle: "Stone by stone, prayer by prayer",
                season: "Restoration",
                milestone: "Walls begin again",
                chapters: ["Ezra", "Nehemiah", "Haggai", "Zechariah"],
                storyLane: "Restoration with resistance",
                prayerLane: "Pilgrim psalm",
                lookFor: "Small faithfulness",
                heroCopy: "Not every holy moment is dramatic. Some of them are just bricks and persistence.",
                body: "The return is less triumphant finale and more patient reconstruction. Perfect, honestly. The spiritual life often is.",
                prompts: [
                    "What small act here counts as real rebuilding?",
                    "Where do discouragement and courage meet?",
                    "What unfinished wall in your life deserves one more stone today?"
                ]
            },
            {
                start: 279,
                end: 303,
                title: "Wisdom under the lamp",
                subtitle: "Poetry, questions, and daily craft",
                season: "Wisdom House",
                milestone: "The reflective middle",
                chapters: ["Psalms", "Proverbs", "Ecclesiastes", "Sirach"],
                storyLane: "Living well",
                prayerLane: "Poetry for every mood",
                lookFor: "One line to keep",
                heroCopy: "This is the candlelit desk section. Naturally I approve.",
                body: "The pilgrimage pauses to teach the art of living: praise, grief, restraint, delight, humility, and holy common sense with excellent phrasing.",
                prompts: [
                    "Which line would make a beautiful desktop note or lock-screen reminder?",
                    "Where does wisdom sound surprisingly practical?",
                    "Which psalm matches your actual mood instead of your ideal mood?"
                ]
            },
            {
                start: 304,
                end: 320,
                title: "Waiting with sharpened hope",
                subtitle: "Maccabees and the quiet ache before Christ",
                season: "Holy Tension",
                milestone: "Faithfulness under pressure",
                chapters: ["Maccabees", "Wisdom", "Malachi"],
                storyLane: "Courage and expectation",
                prayerLane: "Steadfast praise",
                lookFor: "How hope survives pressure",
                heroCopy: "The stage is being set and everyone can feel it, even if they cannot yet name it.",
                body: "These readings gather courage, martyrdom, fidelity, and expectation into a taut prelude. History feels charged. The silence before fulfillment is not empty.",
                prompts: [
                    "What kind of courage gets honoured here?",
                    "Where does hope become more refined because of suffering?",
                    "What promise now feels close enough to taste?"
                ]
            },
            {
                start: 321,
                end: 344,
                title: "The Gospel dawn",
                subtitle: "Jesus enters the story openly",
                season: "Gospel Light",
                milestone: "Public ministry begins",
                chapters: ["Matthew", "Mark", "Luke", "John"],
                storyLane: "Fulfillment arrives",
                prayerLane: "Praise with astonishment",
                lookFor: "Echoes fulfilled",
                heroCopy: "And there He is. Quietly not quiet at all.",
                body: "All the old threads start blazing at once. Teachings, healings, parables, confrontations, and the unmistakable sense that the whole story has tilted toward its center.",
                prompts: [
                    "Which scene best reveals Jesus&apos; manner, not just His power?",
                    "What Old Testament echo suddenly becomes vivid here?",
                    "If you had to tell Nathan one Gospel moment tonight, which would you choose?"
                ]
            },
            {
                start: 345,
                end: 356,
                title: "Passion, cross, resurrection",
                subtitle: "The center holds",
                season: "Paschal Fire",
                milestone: "Empty tomb morning",
                chapters: ["Gospels", "Psalms", "Hebrews"],
                storyLane: "Sacrifice and victory",
                prayerLane: "Watchful prayer",
                lookFor: "Love carried through suffering",
                heroCopy: "The hinge of everything. No pressure.",
                body: "This is the heart of the pilgrimage: betrayal, surrender, death, and the impossible joy that breaks the grave open from inside.",
                prompts: [
                    "Where does love appear strongest precisely when it looks defeated?",
                    "What detail in the Passion narrative always undoes you a little?",
                    "How does resurrection change the meaning of everything before it?"
                ]
            },
            {
                start: 357,
                end: 365,
                title: "Church on the move",
                subtitle: "Acts, letters, and the new creation",
                season: "Sent Forth",
                milestone: "Pentecost wind",
                chapters: ["Acts", "Letters", "Revelation"],
                storyLane: "Mission and endurance",
                prayerLane: "Final blessing",
                lookFor: "What continues now",
                heroCopy: "The story ends by being handed to the Church. Slightly your problem now.",
                body: "The Spirit sends the story outward: preaching, suffering, letters, worship, endurance, and at last the radiant vision of all things made new.",
                prompts: [
                    "What part of the early Church feels bracingly alive rather than merely historical?",
                    "Which letter passage sounds like it was written straight into modern exhaustion?",
                    "What final image from Revelation feels more beautiful than frightening?"
                ]
            }
        ];

        const slider = document.getElementById('daySlider');
        const trackerDay = document.getElementById('trackerDay');
        const trackerPercent = document.getElementById('trackerPercent');
        const chapterStrip = document.getElementById('chapterStrip');
        const focusTitle = document.getElementById('focusTitle');
        const focusBody = document.getElementById('focusBody');
        const storyLane = document.getElementById('storyLane');
        const prayerLane = document.getElementById('prayerLane');
        const lookFor = document.getElementById('lookFor');
        const promptList = document.getElementById('promptList');
        const heroDay = document.getElementById('heroDay');
        const heroCopy = document.getElementById('heroCopy');
        const heroSeason = document.getElementById('heroSeason');
        const heroMilestone = document.getElementById('heroMilestone');
        const path = document.getElementById('path');
        const jumpToday = document.getElementById('jumpToday');
        const surpriseStop = document.getElementById('surpriseStop');

        stations.forEach((station, index) => {
            const card = document.createElement('button');
            card.className = 'station-card';
            card.type = 'button';
            card.dataset.index = String(index + 1).padStart(2, '0');
            card.dataset.start = station.start;
            card.innerHTML = `<h3>${station.title}</h3><p>Days ${station.start}-${station.end} · ${station.subtitle}</p>`;
            card.addEventListener('click', () => {
                slider.value = station.start;
                render();
                document.querySelector('.tracker').scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
            path.appendChild(card);
        });

        function getStation(day) {
            return stations.find(station => day >= station.start && day <= station.end) || stations[0];
        }

        function render() {
            const day = Number(slider.value);
            const station = getStation(day);
            const fill = `${((day - 1) / 364) * 100}%`;
            slider.style.setProperty('--fill', fill);

            trackerDay.textContent = `Day ${day}`;
            trackerPercent.textContent = `${Math.round((day / 365) * 100)}% of the pilgrimage`;
            focusTitle.textContent = station.subtitle;
            focusBody.textContent = station.body;
            storyLane.textContent = station.storyLane;
            prayerLane.textContent = station.prayerLane;
            lookFor.textContent = station.lookFor;
            heroDay.textContent = day;
            heroCopy.textContent = station.heroCopy;
            heroSeason.textContent = station.season;
            heroMilestone.textContent = station.milestone;

            chapterStrip.innerHTML = station.chapters.map(chapter => `<span class="pill">${chapter}</span>`).join('');
            promptList.innerHTML = station.prompts.map(prompt => `<div class="prompt">${prompt}</div>`).join('');

            [...path.children].forEach((card, index) => {
                const isActive = stations[index] === station;
                card.classList.toggle('active', isActive);
            });
        }

        slider.addEventListener('input', render);

        jumpToday.addEventListener('click', () => {
            slider.value = <?php echo $defaultDay; ?>;
            render();
            document.querySelector('.tracker').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        surpriseStop.addEventListener('click', () => {
            const stop = stations[Math.floor(Math.random() * stations.length)];
            slider.value = stop.start;
            render();
            document.querySelector('.tracker').scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        render();
    </script>
</body>
</html>
