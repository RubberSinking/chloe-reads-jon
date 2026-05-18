<?php
$presets = [
    [
        'title' => 'Pride and Prejudice',
        'hook' => 'manners, misunderstandings, and a hero who needs to learn how not to be insufferable',
        'tone' => 'witty',
        'palette' => 'rose',
        'audience' => 'family',
        'beats' => ['assembly ball', 'letter reveal', 'proposal disaster', 'long walk', 'double wedding'],
    ],
    [
        'title' => 'Treasure Island',
        'hook' => 'maps, mutiny, storm lanterns, and cheerful pirate treachery',
        'tone' => 'swashbuckling',
        'palette' => 'ember',
        'audience' => 'kids',
        'beats' => ['black spot', 'hidden map', 'ship ambush', 'island march', 'treasure cave'],
    ],
    [
        'title' => 'The Hobbit',
        'hook' => 'cozy courage, dwarven grumbling, riddles, and dragon glitter',
        'tone' => 'mythic',
        'palette' => 'forest',
        'audience' => 'family',
        'beats' => ['unexpected party', 'riddle game', 'barrels escape', 'desolation', 'there and back'],
    ],
    [
        'title' => 'The Wind in the Willows',
        'hook' => 'riverbank friendship, comic trouble, and homecoming warmth',
        'tone' => 'gentle',
        'palette' => 'dawn',
        'audience' => 'kids',
        'beats' => ['riverside picnic', 'wild wood', 'Toad escape', 'motorcar madness', 'hall reclaiming'],
    ],
];

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic Batch Director</title>
    <style>
        :root {
            --ink: #1f1a17;
            --gold: #d39b33;
            --scarlet: #a53b2c;
            --cream: #fff7e8;
            --shadow: rgba(36, 21, 6, 0.18);
            --accent: var(--scarlet);
            --panel: rgba(255, 247, 232, 0.78);
            --max: 1220px;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            color: var(--ink);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 244, 210, 0.9), transparent 32%),
                radial-gradient(circle at 80% 0%, rgba(211, 155, 51, 0.28), transparent 30%),
                linear-gradient(135deg, #d9bb79 0%, #c38d4a 34%, #91502d 100%);
            min-height: 100vh;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                radial-gradient(rgba(48, 25, 7, 0.09) 0.7px, transparent 0.7px),
                linear-gradient(rgba(255, 248, 230, 0.12), rgba(255, 248, 230, 0.02));
            background-size: 7px 7px, 100% 100%;
            mix-blend-mode: multiply;
            opacity: 0.58;
        }
        a { color: inherit; }
        .shell {
            width: min(calc(100% - 28px), var(--max));
            margin: 0 auto;
            padding: 22px 0 34px;
        }
        .masthead {
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(57, 28, 9, 0.6);
            border-radius: 28px;
            background:
                linear-gradient(130deg, rgba(255, 246, 220, 0.92), rgba(244, 213, 137, 0.88)),
                var(--cream);
            box-shadow: 0 26px 50px var(--shadow);
            padding: 28px;
        }
        .masthead::after {
            content: "";
            position: absolute;
            inset: 14px;
            border: 1px dashed rgba(85, 47, 17, 0.35);
            border-radius: 20px;
            pointer-events: none;
        }
        .kicker {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: "Courier New", Courier, monospace;
            font-size: 0.78rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            background: rgba(31, 26, 23, 0.08);
            padding: 8px 12px;
            border-radius: 999px;
        }
        .title-row {
            display: grid;
            grid-template-columns: 1.3fr 0.9fr;
            gap: 24px;
            margin-top: 18px;
            align-items: end;
        }
        h1 {
            margin: 0;
            font-size: clamp(2.6rem, 6vw, 5.5rem);
            line-height: 0.9;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            text-wrap: balance;
        }
        .lede {
            margin: 14px 0 0;
            max-width: 44rem;
            font-size: 1.08rem;
            line-height: 1.6;
        }
        .hero-card {
            align-self: stretch;
            display: grid;
            gap: 12px;
            padding: 18px;
            border-radius: 24px;
            background: rgba(255, 251, 242, 0.82);
            border: 1px solid rgba(74, 42, 13, 0.18);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.55);
        }
        .hero-card strong {
            font-size: 0.84rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }
        .chip-row, .stat-row, .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .chip, .stat {
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(165, 59, 44, 0.11);
            border: 1px solid rgba(165, 59, 44, 0.18);
            font-size: 0.92rem;
        }
        .layout {
            margin-top: 24px;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(320px, 0.95fr);
            gap: 20px;
        }
        .panel {
            background: var(--panel);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(69, 38, 12, 0.16);
            border-radius: 26px;
            box-shadow: 0 18px 34px var(--shadow);
            padding: 22px;
        }
        .panel-title {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: baseline;
            margin-bottom: 18px;
        }
        .panel-title h2 {
            margin: 0;
            font-size: 1.45rem;
            text-transform: uppercase;
            letter-spacing: 0.02em;
        }
        .panel-title span, .page-card small {
            font-family: "Courier New", Courier, monospace;
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(31, 26, 23, 0.72);
        }
        .controls {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        label {
            display: grid;
            gap: 7px;
            font-size: 0.9rem;
        }
        label span {
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.78rem;
        }
        input, select, textarea, button { font: inherit; }
        input, select, textarea {
            width: 100%;
            border-radius: 16px;
            border: 1px solid rgba(81, 49, 19, 0.18);
            background: rgba(255, 252, 245, 0.96);
            padding: 14px;
            color: var(--ink);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.8);
        }
        textarea {
            min-height: 104px;
            resize: vertical;
        }
        .full { grid-column: 1 / -1; }
        .actions { margin-top: 16px; }
        button {
            border: 0;
            border-radius: 999px;
            padding: 12px 18px;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }
        button:hover { transform: translateY(-1px); }
        .primary {
            background: var(--accent);
            color: #fff7ef;
            box-shadow: 0 12px 20px rgba(101, 26, 17, 0.18);
        }
        .secondary {
            background: rgba(31, 26, 23, 0.08);
            color: var(--ink);
        }
        .ghost {
            background: rgba(255, 255, 255, 0.62);
            border: 1px solid rgba(74, 42, 13, 0.15);
        }
        .summary-card {
            display: grid;
            gap: 14px;
            padding: 18px;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(255,255,255,0.66), rgba(255,237,196,0.74));
            border: 1px solid rgba(90, 50, 14, 0.16);
        }
        .summary-head {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
        }
        .story-title {
            margin: 0;
            font-size: 1.75rem;
            line-height: 1.04;
        }
        .summary-hook {
            margin: 0;
            line-height: 1.55;
        }
        .meter {
            height: 12px;
            border-radius: 999px;
            background: rgba(31, 26, 23, 0.08);
            overflow: hidden;
        }
        .meter-fill {
            width: 61%;
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--accent), var(--gold));
        }
        .beats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
        }
        .beat-pill, .prompt-card, .spark {
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(90, 50, 14, 0.12);
        }
        .beat-pill {
            padding: 10px 12px;
            border-radius: 16px;
            text-align: center;
            font-size: 0.88rem;
            min-height: 72px;
            display: grid;
            place-items: center;
        }
        .prompt-stack {
            display: grid;
            gap: 12px;
        }
        .prompt-card {
            border-radius: 18px;
            padding: 16px;
        }
        .prompt-card h3 {
            margin: 0 0 8px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .prompt-card p {
            margin: 0;
            line-height: 1.5;
            white-space: pre-wrap;
        }
        .copy-row {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end;
        }
        .thumb-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }
        .page-card {
            position: relative;
            display: grid;
            align-content: space-between;
            gap: 10px;
            aspect-ratio: 0.75;
            border-radius: 20px;
            padding: 12px;
            background: linear-gradient(160deg, rgba(255,255,255,0.76), rgba(255,232,182,0.78)), var(--cream);
            border: 1px solid rgba(85, 48, 15, 0.14);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
            overflow: hidden;
        }
        .page-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 25% 28%, rgba(255,255,255,0.8), transparent 33%),
                linear-gradient(145deg, transparent 0 68%, rgba(0,0,0,0.06) 68% 72%, transparent 72%);
            opacity: 0.8;
            pointer-events: none;
        }
        .page-card strong, .page-card span, .page-card small {
            position: relative;
            z-index: 1;
        }
        .page-card strong {
            font-size: 0.86rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .page-card span {
            font-size: 1.05rem;
            line-height: 1.18;
            font-weight: 700;
        }
        .spark-board {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 14px;
        }
        .spark {
            min-height: 82px;
            border-radius: 18px;
            padding: 12px;
            display: grid;
            align-content: space-between;
        }
        .spark em {
            font-style: normal;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(31, 26, 23, 0.64);
        }
        .spark strong {
            font-size: 0.95rem;
            line-height: 1.25;
        }
        .footer-note {
            margin-top: 10px;
            font-size: 0.88rem;
            line-height: 1.55;
            color: rgba(31, 26, 23, 0.8);
        }
        .flash {
            position: fixed;
            right: 16px;
            bottom: 16px;
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(31, 26, 23, 0.92);
            color: #fff7ef;
            font-family: "Courier New", Courier, monospace;
            opacity: 0;
            transform: translateY(8px);
            pointer-events: none;
            transition: opacity 180ms ease, transform 180ms ease;
        }
        .flash.show {
            opacity: 1;
            transform: translateY(0);
        }
        .palette-rose { --accent: #a53b2c; }
        .palette-forest { --accent: #44613a; }
        .palette-ember { --accent: #8d471b; }
        .palette-dawn { --accent: #8f4d7f; }
        .palette-ocean { --accent: #28566f; }
        @media (max-width: 980px) {
            .title-row, .layout { grid-template-columns: 1fr; }
            .thumb-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .beats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 720px) {
            .shell { width: min(calc(100% - 18px), var(--max)); }
            .masthead, .panel { padding: 18px; border-radius: 22px; }
            .controls { grid-template-columns: 1fr; }
            .thumb-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .spark-board { grid-template-columns: 1fr; }
            .summary-head { align-items: start; flex-direction: column; }
            h1 { font-size: clamp(2.1rem, 14vw, 3.8rem); }
        }
    </style>
</head>
<body class="palette-rose">
    <div class="shell">
        <section class="masthead">
            <div class="kicker">Chloe Reads Jon • Comic workflow toy</div>
            <div class="title-row">
                <div>
                    <h1>Comic Batch Director</h1>
                    <p class="lede">A pulp-paper planning desk for turning any beloved book into a 30-page comic. Pick a title, tilt the tone, throw in a few signature scenes, and this thing lays out the beats and the six prompt steps so the workflow does not wander off wearing fake moustaches.</p>
                </div>
                <aside class="hero-card">
                    <strong>Built for playful momentum</strong>
                    <div class="chip-row">
                        <div class="chip">30-page story map</div>
                        <div class="chip">cover + 3 image batches</div>
                        <div class="chip">Nathan-friendly spark mode</div>
                    </div>
                    <div class="stat-row">
                        <div class="stat">Single file</div>
                        <div class="stat">No APIs</div>
                        <div class="stat">Works offline</div>
                    </div>
                </aside>
            </div>
        </section>
        <div class="layout">
            <section class="panel">
                <div class="panel-title">
                    <h2>Director Console</h2>
                    <span>Set the adaptation brief</span>
                </div>
                <div class="controls">
                    <label>
                        <span>Preset</span>
                        <select id="presetSelect">
                            <?php foreach ($presets as $index => $preset): ?>
                                <option value="<?= $index ?>"><?= htmlspecialchars($preset['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span>Story Title</span>
                        <input id="storyTitle" type="text" value="<?= htmlspecialchars($presets[0]['title']) ?>">
                    </label>
                    <label>
                        <span>Tone</span>
                        <select id="tone">
                            <option value="witty">Witty</option>
                            <option value="mythic">Mythic</option>
                            <option value="swashbuckling">Swashbuckling</option>
                            <option value="gentle">Gentle</option>
                            <option value="moody">Moody</option>
                            <option value="heroic">Heroic</option>
                        </select>
                    </label>
                    <label>
                        <span>Palette</span>
                        <select id="palette">
                            <option value="rose">Rose ink</option>
                            <option value="forest">Forest lamp</option>
                            <option value="ember">Ember brass</option>
                            <option value="dawn">Violet dawn</option>
                            <option value="ocean">Harbor teal</option>
                        </select>
                    </label>
                    <label>
                        <span>Audience</span>
                        <select id="audience">
                            <option value="family">Family</option>
                            <option value="kids">Kids</option>
                            <option value="teens">Teens</option>
                            <option value="adults">Adults</option>
                        </select>
                    </label>
                    <label>
                        <span>Page Energy</span>
                        <select id="energy">
                            <option value="balanced">Balanced</option>
                            <option value="action-heavy">Action-heavy</option>
                            <option value="quiet-and-beautiful">Quiet and beautiful</option>
                            <option value="dialogue-rich">Dialogue-rich</option>
                        </select>
                    </label>
                    <label class="full">
                        <span>Hook</span>
                        <textarea id="hook"><?= htmlspecialchars($presets[0]['hook']) ?></textarea>
                    </label>
                    <label class="full">
                        <span>Five signature beats</span>
                        <input id="beatsInput" type="text" value="<?= htmlspecialchars(implode(', ', $presets[0]['beats'])) ?>">
                    </label>
                </div>
                <div class="actions">
                    <button class="primary" id="buildBtn">Build story board</button>
                    <button class="secondary" id="shuffleBtn">Shuffle sparks</button>
                    <button class="ghost" id="nathanBtn">Nathan Mode</button>
                </div>
                <div class="spark-board" id="sparkBoard"></div>
                <p class="footer-note">Tip: Nathan Mode switches to a more adventurous brief and punchier page beats. It is essentially a large red button labelled "less brooding, more treasure."</p>
            </section>
            <section class="panel">
                <div class="panel-title">
                    <h2>Flight Brief</h2>
                    <span>Instant adaptation summary</span>
                </div>
                <div class="summary-card">
                    <div class="summary-head">
                        <div>
                            <p class="story-title" id="summaryTitle">Pride and Prejudice</p>
                            <p class="summary-hook" id="summaryHook">manners, misunderstandings, and a hero who needs to learn how not to be insufferable</p>
                        </div>
                        <div class="chip" id="summaryTone">Witty family</div>
                    </div>
                    <div class="meter"><div class="meter-fill" id="meterFill"></div></div>
                    <div class="beats" id="beatPills"></div>
                </div>
                <div class="prompt-stack" id="promptStack"></div>
            </section>
        </div>
        <section class="panel" style="margin-top: 20px;">
            <div class="panel-title">
                <h2>30-Page Strip Board</h2>
                <span>Cover + pages 1-30</span>
            </div>
            <div class="thumb-grid" id="thumbGrid"></div>
        </section>
    </div>
    <div class="flash" id="flash">Copied</div>
    <script>
        const presets = <?php echo json_encode($presets, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
        const sparkPools = {
            props: ["storm lantern", "secret map", "tea tray", "enchanted key", "clockwork bird", "glass compass", "talkative horse", "ink-stained letter"],
            moods: ["comic disaster", "quiet wonder", "heroic surge", "ominous calm", "awkward tenderness", "midnight chase", "cozy suspense", "gleeful mayhem"],
            twists: ["a rival becomes useful", "the wrong person hears everything", "the clue is hidden in plain sight", "a boast turns into trouble", "home is at stake", "the side character steals the scene", "the villain is embarrassingly prepared", "the ending needs one last brave choice"]
        };
        const actTemplates = {
            balanced: ["opening image", "world setup", "inciting trouble", "first commitment", "fun and friction", "midpoint reversal", "darkest squeeze", "final surge", "landing"],
            "action-heavy": ["cold open", "quick setup", "chase trigger", "escape attempt", "counterattack", "mid-battle reveal", "regroup", "all-in finale", "victory image"],
            "quiet-and-beautiful": ["stillness", "small longing", "gentle disturbance", "wandering", "glimpse of mystery", "heart-turn", "soft loss", "tender courage", "peace"],
            "dialogue-rich": ["introductions", "social spark", "complication", "misread motives", "truth leaks", "argument", "admission", "reconciliation", "afterglow"]
        };
        const toneHints = {
            witty: ["sharp banter", "expressive eyebrows", "social embarrassments"],
            mythic: ["storybook scale", "moonlit awe", "ancient symbols"],
            swashbuckling: ["tilted horizons", "dramatic lunges", "wind and ropes"],
            gentle: ["warm interiors", "kind eyes", "riverbank calm"],
            moody: ["shadows", "long pauses", "rain on stone"],
            heroic: ["bold silhouettes", "big choices", "earned triumph"]
        };
        const energyLevels = {
            balanced: 61,
            "action-heavy": 82,
            "quiet-and-beautiful": 44,
            "dialogue-rich": 58
        };
        const el = {
            body: document.body,
            presetSelect: document.getElementById("presetSelect"),
            storyTitle: document.getElementById("storyTitle"),
            tone: document.getElementById("tone"),
            palette: document.getElementById("palette"),
            audience: document.getElementById("audience"),
            energy: document.getElementById("energy"),
            hook: document.getElementById("hook"),
            beatsInput: document.getElementById("beatsInput"),
            buildBtn: document.getElementById("buildBtn"),
            shuffleBtn: document.getElementById("shuffleBtn"),
            nathanBtn: document.getElementById("nathanBtn"),
            sparkBoard: document.getElementById("sparkBoard"),
            summaryTitle: document.getElementById("summaryTitle"),
            summaryHook: document.getElementById("summaryHook"),
            summaryTone: document.getElementById("summaryTone"),
            beatPills: document.getElementById("beatPills"),
            promptStack: document.getElementById("promptStack"),
            thumbGrid: document.getElementById("thumbGrid"),
            meterFill: document.getElementById("meterFill"),
            flash: document.getElementById("flash")
        };
        function titleCase(value) {
            return value.replace(/\b\w/g, function (m) { return m.toUpperCase(); });
        }
        function parseBeats() {
            return el.beatsInput.value.split(",").map(function (item) {
                return item.trim();
            }).filter(Boolean).slice(0, 5);
        }
        function rand(list) {
            return list[Math.floor(Math.random() * list.length)];
        }
        function renderSparks() {
            const cards = [
                { label: "Prop", value: rand(sparkPools.props) },
                { label: "Mood", value: rand(sparkPools.moods) },
                { label: "Twist", value: rand(sparkPools.twists) }
            ];
            el.sparkBoard.innerHTML = cards.map(function (card) {
                return '<div class="spark"><em>' + card.label + '</em><strong>' + card.value + '</strong></div>';
            }).join("");
        }
        function buildPages(state) {
            const beats = state.beats;
            const actNames = actTemplates[state.energy] || actTemplates.balanced;
            const pages = [];
            const toneNotes = toneHints[state.tone] || toneHints.witty;
            for (let i = 0; i <= 30; i += 1) {
                if (i === 0) {
                    pages.push({
                        label: "Cover",
                        scene: state.title,
                        note: titleCase(state.tone) + " poster image"
                    });
                    continue;
                }
                const actIndex = Math.min(actNames.length - 1, Math.floor((i - 1) / 4));
                const beat = beats[(i - 1) % beats.length];
                const note = toneNotes[(i - 1) % toneNotes.length];
                let scene = "";
                if (i <= 4) scene = actNames[actIndex] + " around " + beat;
                else if (i <= 9) scene = beat + " grows teeth";
                else if (i <= 14) scene = actNames[actIndex] + " with " + note;
                else if (i <= 19) scene = beat + " flips direction";
                else if (i <= 24) scene = actNames[actIndex] + " under pressure";
                else if (i <= 29) scene = beat + " drives the finale";
                else scene = "quiet aftermath and earned smile";
                pages.push({
                    label: "Page " + i,
                    scene: scene,
                    note: note
                });
            }
            return pages;
        }
        function buildPromptCards(state) {
            const title = state.title;
            const hook = state.hook;
            const beatLine = state.beats.join(", ");
            const prompts = [
                {
                    label: "Step 1",
                    text: "Plan a 30 page comic book adaptation of " + title + ". I want text, not an image. Keep the tone " + state.tone + ", target a " + state.audience + " audience, and lean into " + hook + ". Make sure these beats appear somewhere: " + beatLine + "."
                },
                {
                    label: "Step 2",
                    text: "Can you generate a batch of 10 separate images: the cover plus pages 1-9 of " + title + "? I want 10 images, not 1 image containing 10 pages. Visual direction: " + state.palette + " palette, " + state.energy + " pacing, and " + state.tone + " staging."
                },
                {
                    label: "Step 3",
                    text: "Do the next batch of 10 images for " + title + ", pages 10-19. Keep character designs consistent. Continue the " + state.tone + " tone and emphasize " + (state.beats[2] || state.beats[0]) + "."
                },
                {
                    label: "Step 4",
                    text: "Do the next batch of 10 images for " + title + ", pages 20-29. Raise the stakes, keep the " + state.palette + " palette, and let " + (state.beats[3] || state.beats[0]) + " and " + (state.beats[4] || state.beats[1] || state.beats[0]) + " dominate the climax."
                },
                {
                    label: "Step 5",
                    text: "Can you generate the final image for " + title + ", page 30? Make it feel like a satisfying closing page with one memorable emotional note."
                },
                {
                    label: "Step 6",
                    text: "Can you put the 31 pages of " + title + " into a PDF, keeping the pages in order and preserving each image as its own full page?"
                }
            ];
            el.promptStack.innerHTML = prompts.map(function (prompt, index) {
                return '<article class="prompt-card"><h3>' + prompt.label + '</h3><p id="prompt-' + index + '">' + prompt.text + '</p><div class="copy-row"><button class="ghost copy-btn" data-copy="prompt-' + index + '">Copy prompt</button></div></article>';
            }).join("");
        }
        function renderBeatPills(beats) {
            el.beatPills.innerHTML = beats.map(function (beat) {
                return '<div class="beat-pill">' + beat + '</div>';
            }).join("");
        }
        function renderThumbs(pages) {
            el.thumbGrid.innerHTML = pages.map(function (page) {
                return '<article class="page-card"><strong>' + page.label + '</strong><span>' + page.scene + '</span><small>' + page.note + '</small></article>';
            }).join("");
        }
        function collectState() {
            const beats = parseBeats();
            return {
                title: el.storyTitle.value.trim() || "Untitled Adventure",
                tone: el.tone.value,
                palette: el.palette.value,
                audience: el.audience.value,
                energy: el.energy.value,
                hook: el.hook.value.trim() || "bold feelings and useful trouble",
                beats: beats.length ? beats : ["opening trouble", "midpoint surprise", "hard choice", "showdown", "homecoming"]
            };
        }
        function render() {
            const state = collectState();
            el.body.className = "palette-" + state.palette;
            el.summaryTitle.textContent = state.title;
            el.summaryHook.textContent = state.hook;
            el.summaryTone.textContent = titleCase(state.tone) + " • " + titleCase(state.audience) + " • " + titleCase(state.energy.replaceAll("-", " "));
            el.meterFill.style.width = (energyLevels[state.energy] || 61) + "%";
            renderBeatPills(state.beats);
            buildPromptCards(state);
            renderThumbs(buildPages(state));
            renderSparks();
            localStorage.setItem("comic-batch-director-state", JSON.stringify(state));
        }
        function copyPrompt(id) {
            const text = document.getElementById(id) ? document.getElementById(id).textContent : "";
            navigator.clipboard.writeText(text).then(function () {
                el.flash.textContent = "Prompt copied";
                el.flash.classList.add("show");
                window.setTimeout(function () { el.flash.classList.remove("show"); }, 1100);
            });
        }
        function applyPreset(index) {
            const preset = presets[index];
            if (!preset) return;
            el.storyTitle.value = preset.title;
            el.hook.value = preset.hook;
            el.tone.value = preset.tone;
            el.palette.value = preset.palette;
            el.audience.value = preset.audience;
            el.energy.value = preset.audience === "kids" ? "action-heavy" : "balanced";
            el.beatsInput.value = preset.beats.join(", ");
            render();
        }
        function loadSavedState() {
            const raw = localStorage.getItem("comic-batch-director-state");
            if (!raw) {
                render();
                return;
            }
            try {
                const state = JSON.parse(raw);
                el.storyTitle.value = state.title || el.storyTitle.value;
                el.hook.value = state.hook || el.hook.value;
                el.tone.value = state.tone || el.tone.value;
                el.palette.value = state.palette || el.palette.value;
                el.audience.value = state.audience || el.audience.value;
                el.energy.value = state.energy || el.energy.value;
                el.beatsInput.value = Array.isArray(state.beats) ? state.beats.join(", ") : el.beatsInput.value;
            } catch (error) {
            }
            render();
        }
        el.buildBtn.addEventListener("click", render);
        el.shuffleBtn.addEventListener("click", renderSparks);
        el.nathanBtn.addEventListener("click", function () {
            el.storyTitle.value = "Treasure Island";
            el.tone.value = "swashbuckling";
            el.palette.value = "ember";
            el.audience.value = "kids";
            el.energy.value = "action-heavy";
            el.hook.value = "treasure maps, mutiny, storms, and the kind of danger that makes a kid immediately build a cardboard telescope";
            el.beatsInput.value = "hidden map, mutiny at sea, island chase, cave reveal, triumphant sail home";
            render();
        });
        el.presetSelect.addEventListener("change", function (event) {
            applyPreset(Number(event.target.value));
        });
        document.addEventListener("click", function (event) {
            const button = event.target.closest(".copy-btn");
            if (!button) return;
            copyPrompt(button.dataset.copy);
        });
        loadSavedState();
    </script>
</body>
</html>
