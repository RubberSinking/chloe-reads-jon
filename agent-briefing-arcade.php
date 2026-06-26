<?php
$sourceTitle = 'My current AI coding philosophy';
$sourceUrl = 'https://jona.ca/2026/06/my-current-ai-coding-philosophy.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Briefing Arcade</title>
    <style>
        :root {
            --paper: #f4ead6;
            --ink: #18110d;
            --coal: #2b1d17;
            --card: rgba(255, 248, 238, 0.8);
            --line: rgba(64, 34, 21, 0.18);
            --gold: #c4872f;
            --rust: #b14f2d;
            --teal: #1f7d79;
            --teal-soft: #bde5e2;
            --rose: #e8b6a0;
            --shadow: 0 18px 50px rgba(58, 28, 17, 0.18);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Trebuchet MS", "Lucida Sans Unicode", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255, 239, 211, 0.95), transparent 34%),
                radial-gradient(circle at bottom right, rgba(189, 229, 226, 0.85), transparent 26%),
                linear-gradient(145deg, #efe2ca 0%, #f9f1e0 48%, #edd7c4 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.1;
            background-image:
                linear-gradient(rgba(34, 17, 11, 0.2) 1px, transparent 1px),
                linear-gradient(90deg, rgba(34, 17, 11, 0.2) 1px, transparent 1px);
            background-size: 22px 22px;
            mix-blend-mode: multiply;
        }

        a {
            color: var(--teal);
            text-decoration-thickness: 2px;
            text-underline-offset: 0.16em;
        }

        .page {
            width: min(1180px, calc(100vw - 24px));
            margin: 0 auto;
            padding: 24px 0 56px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
            padding: 28px;
            border: 1px solid rgba(74, 43, 26, 0.2);
            border-radius: 28px;
            background:
                linear-gradient(135deg, rgba(255, 249, 242, 0.88), rgba(250, 235, 220, 0.68)),
                linear-gradient(120deg, rgba(31, 125, 121, 0.18), rgba(196, 135, 47, 0.18));
            box-shadow: var(--shadow);
        }

        .hero::after {
            content: "";
            position: absolute;
            top: -90px;
            right: -60px;
            width: 220px;
            height: 220px;
            border-radius: 40px;
            transform: rotate(18deg);
            background:
                linear-gradient(180deg, rgba(196, 135, 47, 0.2), rgba(177, 79, 45, 0.1)),
                repeating-linear-gradient(90deg, rgba(24, 17, 13, 0.08) 0 2px, transparent 2px 12px);
        }

        .eyebrow {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.65);
            border: 1px solid rgba(74, 43, 26, 0.14);
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-size: 0.72rem;
            font-weight: 700;
        }

        h1, h2, h3 {
            font-family: Georgia, "Times New Roman", serif;
            letter-spacing: -0.03em;
            margin: 0;
        }

        h1 {
            font-size: clamp(2.5rem, 5vw, 4.8rem);
            line-height: 0.96;
            margin-top: 14px;
            max-width: 10ch;
        }

        .hero-copy {
            max-width: 62ch;
            margin-top: 14px;
            font-size: 1.03rem;
            line-height: 1.7;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
        }

        .hero-link,
        .hero-button {
            appearance: none;
            border: 1px solid rgba(74, 43, 26, 0.18);
            background: rgba(255, 255, 255, 0.72);
            color: var(--coal);
            border-radius: 999px;
            padding: 12px 16px;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .hero-link:hover,
        .hero-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(58, 28, 17, 0.12);
            background: rgba(255, 255, 255, 0.92);
        }

        .board {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 18px;
        }

        .panel {
            border-radius: 28px;
            border: 1px solid rgba(74, 43, 26, 0.18);
            background: var(--card);
            box-shadow: var(--shadow);
            backdrop-filter: blur(6px);
        }

        .left-panel {
            padding: 20px;
        }

        .right-panel {
            display: grid;
            gap: 18px;
            padding: 18px;
            align-content: start;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: end;
            margin-bottom: 14px;
        }

        .section-head p,
        .subtle {
            margin: 0;
            color: rgba(24, 17, 13, 0.7);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .mission-card,
        .context-card {
            position: relative;
            border: 1px solid transparent;
            border-radius: 22px;
            padding: 15px 16px;
            background: rgba(255, 255, 255, 0.66);
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .mission-card:hover,
        .context-card:hover {
            transform: translateY(-2px);
            border-color: rgba(31, 125, 121, 0.25);
            box-shadow: 0 10px 18px rgba(58, 28, 17, 0.08);
        }

        .mission-card.active,
        .context-card.active {
            border-color: rgba(31, 125, 121, 0.5);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.92), rgba(189, 229, 226, 0.55));
        }

        .mission-card h3,
        .context-card h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .mission-card p,
        .context-card p {
            margin: 0;
            line-height: 1.5;
            color: rgba(24, 17, 13, 0.75);
        }

        .mission-ribbon {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--rust);
        }

        .dial-wrap {
            display: grid;
            gap: 10px;
            padding: 18px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.64);
            border: 1px solid var(--line);
        }

        .dial-labels {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.86rem;
            color: rgba(24, 17, 13, 0.66);
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--teal);
        }

        .dial-readout {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .dial-badge {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--teal);
            font-family: Georgia, "Times New Roman", serif;
        }

        .context-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .context-card .tag {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 999px;
            margin-bottom: 10px;
            background: rgba(196, 135, 47, 0.14);
            color: var(--rust);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .meter-stack {
            display: grid;
            gap: 12px;
        }

        .meter-card {
            padding: 16px;
            border-radius: 22px;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.78);
        }

        .meter-card header {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            align-items: baseline;
        }

        .meter-card strong {
            font-size: 1.02rem;
        }

        .meter-value {
            font-weight: 800;
            color: var(--teal);
        }

        .bar {
            height: 12px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(24, 17, 13, 0.08);
        }

        .bar > span {
            display: block;
            height: 100%;
            width: 0;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--rust), var(--gold), var(--teal));
            transition: width 220ms ease;
        }

        .result-card {
            padding: 20px;
            border-radius: 24px;
            background:
                linear-gradient(135deg, rgba(25, 19, 15, 0.98), rgba(59, 34, 24, 0.96)),
                linear-gradient(180deg, rgba(196, 135, 47, 0.14), transparent);
            color: #f8f1e5;
        }

        .result-rank {
            display: inline-flex;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            font-size: 0.76rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .result-title {
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .result-summary,
        .result-note {
            margin: 0;
            line-height: 1.6;
        }

        .result-note {
            margin-top: 14px;
            color: rgba(248, 241, 229, 0.8);
        }

        .ticker {
            display: grid;
            gap: 8px;
            margin-top: 18px;
        }

        .ticker-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 10px 12px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
        }

        .ticker-item span {
            font-size: 0.8rem;
            color: rgba(248, 241, 229, 0.68);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            min-width: 44px;
        }

        .ticker-item strong {
            font-size: 0.96rem;
            line-height: 1.5;
        }

        .recipe-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .recipe-btn {
            appearance: none;
            border: 1px solid rgba(31, 125, 121, 0.24);
            background: rgba(189, 229, 226, 0.3);
            color: var(--coal);
            border-radius: 999px;
            padding: 10px 14px;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
        }

        .legend {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .legend-card {
            padding: 15px 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.62);
            border: 1px solid var(--line);
        }

        .legend-card strong {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .legend-card p {
            margin: 0;
            line-height: 1.5;
            color: rgba(24, 17, 13, 0.74);
        }

        @media (max-width: 980px) {
            .board {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100vw - 14px, 100%);
                padding-top: 12px;
            }

            .hero,
            .left-panel,
            .right-panel {
                padding: 18px;
            }

            .mission-grid,
            .context-grid,
            .legend {
                grid-template-columns: 1fr;
            }

            h1 {
                max-width: none;
            }

            .dial-readout {
                align-items: start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero panel">
            <div class="eyebrow">Chloe Reads Jon <span>Daily build</span></div>
            <h1>Agent Briefing Arcade</h1>
            <p class="hero-copy">
                Jon's philosophy is simple: give the AI rich context, then let it cook. This little arcade lets you assemble the briefing, tune how controlling you want to be, and see whether your agent ships something elegant or trips over rule fog.
            </p>
            <div class="hero-links">
                <button class="hero-button" id="autofill">Load Jon's Philosophy</button>
                <button class="hero-button" id="launch">Launch Agent</button>
                <a class="hero-link" href="<?php echo htmlspecialchars($sourceUrl, ENT_QUOTES); ?>">Inspired by Jon's "<?php echo htmlspecialchars($sourceTitle, ENT_QUOTES); ?>"</a>
            </div>
        </section>

        <section class="board">
            <div class="panel left-panel">
                <div class="section-head">
                    <div>
                        <h2>1. Pick a Mission</h2>
                        <p>Different missions crave different context. Bug hunts want evidence. Refactors want architecture. Reviews want product intent, because style-only nitpicks are a tragic hobby.</p>
                    </div>
                </div>

                <div class="mission-grid" id="missions"></div>

                <div class="dial-wrap">
                    <div class="section-head">
                        <div>
                            <h2>2. Set the Control Dial</h2>
                            <p>Slide left for command-every-line energy. Slide right for "here's the map, go build something clever."</p>
                        </div>
                    </div>
                    <div class="dial-readout">
                        <div>
                            <div class="dial-badge" id="dialValue">68%</div>
                            <div class="subtle" id="dialMood">Context-rich autonomy</div>
                        </div>
                        <div class="subtle" id="dialNote">Enough freedom to invent clean abstractions, without leaving the poor thing wandering in the fog.</div>
                    </div>
                    <input id="autonomy" type="range" min="0" max="100" value="68" />
                    <div class="dial-labels">
                        <span>Micromanage every bracket</span>
                        <span>Give context, then trust</span>
                    </div>
                </div>

                <div class="section-head" style="margin-top: 22px;">
                    <div>
                        <h2>3. Assemble the Briefing</h2>
                        <p>Click the cards you would hand to the agent. Strong context feeds signal. Doctrine overload feeds theatre.</p>
                    </div>
                </div>
                <div class="context-grid" id="contexts"></div>

                <div class="recipe-row">
                    <button class="recipe-btn" data-recipe="feature">Feature sprint</button>
                    <button class="recipe-btn" data-recipe="debug">Ghost bug kit</button>
                    <button class="recipe-btn" data-recipe="review">Review with mercy</button>
                </div>
            </div>

            <div class="right-panel panel">
                <div class="meter-stack">
                    <div class="meter-card">
                        <header><strong>Context Coverage</strong><span class="meter-value" id="contextMeterLabel">0%</span></header>
                        <div class="bar"><span id="contextMeter"></span></div>
                        <p class="subtle">How much of the mission's real terrain the agent can actually see.</p>
                    </div>
                    <div class="meter-card">
                        <header><strong>Rule Fog</strong><span class="meter-value" id="fogMeterLabel">0%</span></header>
                        <div class="bar"><span id="fogMeter"></span></div>
                        <p class="subtle">Too many hard bans, commandments, and sacred cows. Very managerial. Not always useful.</p>
                    </div>
                    <div class="meter-card">
                        <header><strong>Abstraction Spark</strong><span class="meter-value" id="sparkMeterLabel">0%</span></header>
                        <div class="bar"><span id="sparkMeter"></span></div>
                        <p class="subtle">Will the agent probably find a clean simplification, or just nervously shuffle lint around?</p>
                    </div>
                    <div class="meter-card">
                        <header><strong>Bug Radar</strong><span class="meter-value" id="bugMeterLabel">0%</span></header>
                        <div class="bar"><span id="bugMeter"></span></div>
                        <p class="subtle">How likely the agent is to notice the important thing, even when it is annoyingly far from the edited lines.</p>
                    </div>
                </div>

                <div class="result-card">
                    <div class="result-rank" id="resultRank">Run a simulation</div>
                    <h2 class="result-title" id="resultTitle">Waiting for briefing</h2>
                    <p class="result-summary" id="resultSummary">Pick a mission, choose the context, and press launch. The output here will tell you whether you briefed like a wise collaborator or a jittery committee.</p>
                    <p class="result-note" id="resultNote">The sweet spot is rarely maximal control. Funny how that keeps happening.</p>
                    <div class="ticker" id="ticker"></div>
                </div>

                <div class="legend">
                    <div class="legend-card">
                        <strong>What wins</strong>
                        <p>Business rules, product intent, real data clues, concrete examples, and enough freedom for the model to simplify on its own.</p>
                    </div>
                    <div class="legend-card">
                        <strong>What backfires</strong>
                        <p>Thirty-seven rigid bans, vague mission goals, and a belief that "be perfect" counts as useful engineering input.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const missions = [
            {
                id: "feature",
                title: "Ship a Feature",
                blurb: "A user-facing slice with product nuance, edge cases, and enough moving parts to tempt premature abstraction.",
                ribbon: "Needs intent + constraints",
                needs: ["product", "rules", "examples", "data", "conventions", "constraints"],
                special: "Feature work sings when the model understands why the thing exists, not just what button to draw."
            },
            {
                id: "debug",
                title: "Fix a Ghost Bug",
                blurb: "A bug that only reproduces after three clicks, one API wobble, and the user's oldest browser tab.",
                ribbon: "Needs evidence + reproduction",
                needs: ["repro", "logs", "data", "rules", "transcript"],
                special: "Debugging is detective work. Give it clues, not sermons."
            },
            {
                id: "review",
                title: "Review a PR",
                blurb: "You want the agent to catch real risks, not spend the afternoon weeping over comma placement.",
                ribbon: "Needs risk + purpose",
                needs: ["product", "rules", "conventions", "examples", "constraints"],
                special: "Good reviews understand impact. Pet peeves are not impact."
            },
            {
                id: "refactor",
                title: "Refactor a Relic",
                blurb: "The code works, mostly, but its emotional support abstractions now outnumber its tests.",
                ribbon: "Needs structure + history",
                needs: ["architecture", "conventions", "data", "examples", "constraints"],
                special: "Refactors need permission to simplify, plus enough map data to avoid detonating the basement."
            }
        ];

        const contexts = [
            { id: "product", tag: "Signal", title: "Product brief", blurb: "Who this is for, what problem it solves, what success looks like.", boost: 18, fog: 0, types: ["feature", "review"] },
            { id: "rules", tag: "Signal", title: "Business rules", blurb: "Edge cases, policy logic, and places where cleverness would be expensive.", boost: 16, fog: 0, types: ["feature", "debug", "review"] },
            { id: "data", tag: "Signal", title: "Data map", blurb: "Schema hints, storage locations, and examples of the weird real-world records.", boost: 15, fog: 0, types: ["feature", "debug", "refactor"] },
            { id: "transcript", tag: "Signal", title: "Meeting transcript", blurb: "The messy human context where hidden assumptions and caveats usually live.", boost: 12, fog: 0, types: ["feature", "debug"] },
            { id: "examples", tag: "Signal", title: "Good examples", blurb: "Reference outputs or known-good patterns from the codebase.", boost: 14, fog: 0, types: ["feature", "review", "refactor"] },
            { id: "repro", tag: "Signal", title: "Repro steps", blurb: "Concrete click-paths and symptoms from reality, blessedly free of mysticism.", boost: 20, fog: 0, types: ["debug"] },
            { id: "logs", tag: "Signal", title: "Logs and traces", blurb: "Error lines, stack traces, timings, and suspicious little smoke trails.", boost: 18, fog: 0, types: ["debug"] },
            { id: "architecture", tag: "Signal", title: "Architecture sketch", blurb: "Boundaries, dependencies, and which dragons are load-bearing.", boost: 17, fog: 0, types: ["refactor"] },
            { id: "conventions", tag: "Signal", title: "House conventions", blurb: "Patterns the team actually likes, not merely patterns someone once dreamt about.", boost: 12, fog: 2, types: ["feature", "review", "refactor"] },
            { id: "constraints", tag: "Signal", title: "Delivery constraints", blurb: "Performance limits, rollout risk, deadlines, or compatibility nonsense.", boost: 11, fog: 1, types: ["feature", "review", "refactor"] },
            { id: "style", tag: "Fog", title: "Style commandments", blurb: "Twenty-seven inflexible style decrees, several of them contradicted by the codebase itself.", boost: -3, fog: 16, types: [] },
            { id: "taboos", tag: "Fog", title: "Architecture taboos", blurb: "Warnings so broad they mostly terrify the agent into avoiding useful simplifications.", boost: -2, fog: 14, types: [] }
        ];

        const recipes = {
            feature: { mission: "feature", autonomy: 70, picks: ["product", "rules", "data", "examples", "constraints"] },
            debug: { mission: "debug", autonomy: 62, picks: ["repro", "logs", "data", "rules", "transcript"] },
            review: { mission: "review", autonomy: 67, picks: ["product", "rules", "conventions", "constraints", "examples"] }
        };

        const missionRoot = document.getElementById("missions");
        const contextRoot = document.getElementById("contexts");
        const autonomy = document.getElementById("autonomy");
        const dialValue = document.getElementById("dialValue");
        const dialMood = document.getElementById("dialMood");
        const dialNote = document.getElementById("dialNote");
        const ticker = document.getElementById("ticker");

        let missionId = "feature";
        let selected = new Set(["product", "rules", "data", "examples", "constraints"]);

        function renderMissions() {
            missionRoot.innerHTML = "";
            missions.forEach((mission) => {
                const button = document.createElement("button");
                button.className = "mission-card" + (mission.id === missionId ? " active" : "");
                button.innerHTML = `
                    <h3>${mission.title}</h3>
                    <p>${mission.blurb}</p>
                    <div class="mission-ribbon">${mission.ribbon}</div>
                `;
                button.addEventListener("click", () => {
                    missionId = mission.id;
                    renderMissions();
                    update();
                });
                missionRoot.appendChild(button);
            });
        }

        function renderContexts() {
            contextRoot.innerHTML = "";
            contexts.forEach((context) => {
                const button = document.createElement("button");
                button.className = "context-card" + (selected.has(context.id) ? " active" : "");
                button.innerHTML = `
                    <div class="tag">${context.tag}</div>
                    <h3>${context.title}</h3>
                    <p>${context.blurb}</p>
                `;
                button.addEventListener("click", () => {
                    if (selected.has(context.id)) {
                        selected.delete(context.id);
                    } else {
                        selected.add(context.id);
                    }
                    renderContexts();
                    update();
                });
                contextRoot.appendChild(button);
            });
        }

        function dialCopy(value) {
            if (value < 25) {
                return ["13%", "Clampdown mode", "Very strict, very nervous, and likely to produce code with excellent posture and middling imagination."];
            }
            if (value < 45) {
                return ["38%", "Tight leash", "The agent can move, but only while filing a permission slip in triplicate."];
            }
            if (value < 60) {
                return ["55%", "Managed trust", "Decent balance, though a little extra breathing room could still unlock cleaner moves."];
            }
            if (value < 80) {
                return ["68%", "Context-rich autonomy", "Enough freedom to invent clean abstractions, without leaving the poor thing wandering in the fog."];
            }
            return ["89%", "Let it rip, wisely", "High trust can be brilliant when the briefing is strong. If the context is weak, though, enjoy your surprise architecture."];
        }

        function clamp(value) {
            return Math.max(0, Math.min(100, Math.round(value)));
        }

        function updateDial() {
            const value = Number(autonomy.value);
            dialValue.textContent = value + "%";
            const mood = dialCopy(value);
            dialMood.textContent = mood[1];
            dialNote.textContent = mood[2];
        }

        function analyze() {
            const mission = missions.find((item) => item.id === missionId);
            const autonomyValue = Number(autonomy.value);
            let contextPoints = 0;
            let maxContextPoints = 0;
            let fog = 0;
            let relevantHits = 0;

            contexts.forEach((context) => {
                const isRelevant = mission.needs.includes(context.id);
                if (isRelevant) {
                    maxContextPoints += Math.max(context.boost, 0);
                }
                if (selected.has(context.id)) {
                    fog += context.fog;
                    if (isRelevant) {
                        contextPoints += Math.max(context.boost, 0);
                        relevantHits += 1;
                    } else {
                        contextPoints += Math.max(context.boost, 0) * 0.2;
                    }
                }
            });

            const coverage = clamp((contextPoints / Math.max(1, maxContextPoints)) * 100);
            const autonomyFit = clamp(100 - Math.abs(autonomyValue - 68) * 1.8);
            const spark = clamp(coverage * 0.55 + autonomyFit * 0.45 - fog * 1.2);
            const bugRadar = clamp((mission.id === "debug" ? 16 : 0) + coverage * 0.62 + autonomyFit * 0.24 - fog * 0.8);
            const score = clamp(coverage * 0.42 + spark * 0.34 + bugRadar * 0.24 - fog * 0.55);

            return { mission, coverage, fog: clamp(fog * 4.8), spark, bugRadar, score, autonomyValue, relevantHits };
        }

        function applyMeters(result) {
            const pairs = [
                ["context", result.coverage],
                ["fog", result.fog],
                ["spark", result.spark],
                ["bug", result.bugRadar]
            ];
            pairs.forEach(([name, value]) => {
                document.getElementById(name + "Meter").style.width = value + "%";
                document.getElementById(name + "MeterLabel").textContent = value + "%";
            });
        }

        function launchNarrative(result) {
            const title = document.getElementById("resultTitle");
            const rank = document.getElementById("resultRank");
            const summary = document.getElementById("resultSummary");
            const note = document.getElementById("resultNote");
            const rows = [];

            if (result.score >= 82) {
                rank.textContent = "Clean hit";
                title.textContent = "The agent cooks";
                summary.textContent = "You gave it the map, the constraints, and room to think. The likely outcome is elegant code, sensible abstractions, and a bug catch or two well outside the obvious blast radius.";
            } else if (result.score >= 62) {
                rank.textContent = "Mostly there";
                title.textContent = "Solid, with some throat-clearing";
                summary.textContent = "This briefing probably works, but the agent may spend extra cycles negotiating your rules or guessing one important missing detail.";
            } else if (result.score >= 42) {
                rank.textContent = "Shaky run";
                title.textContent = "Useful effort, wobbly landing";
                summary.textContent = "The agent can make progress, but there is enough fog or missing context here to invite brittle code, unnecessary questions, or both.";
            } else {
                rank.textContent = "Committee disaster";
                title.textContent = "The briefing ate the mission";
                summary.textContent = "This is how you get anxious code and cheerful hallucinations. Fewer commandments, more reality.";
            }

            if (result.coverage < 55) {
                rows.push(["Missing", "Important context never made it into the room, so the agent is improvising with one eye closed."]);
            } else {
                rows.push(["Coverage", "The mission has real terrain data, which dramatically lowers the odds of fantasy engineering."]);
            }

            if (result.fog > 48) {
                rows.push(["Fog", "Rule fog is high. Somewhere, a useful abstraction just got rejected for looking too alive."]);
            } else {
                rows.push(["Freedom", "The control dial leaves enough oxygen for the model to discover cleaner patterns on its own."]);
            }

            if (result.mission.id === "debug") {
                rows.push(["Radar", result.bugRadar > 70
                    ? "Nice. This setup is good at sniffing out the line far away from the diff where the real crime happened."
                    : "For ghost bugs, give it harder evidence: logs, repro, and one or two weird records from production."]);
            } else {
                rows.push(["Mission", result.mission.special]);
            }

            note.textContent = result.autonomyValue > 78 && result.coverage < 48
                ? "High trust with weak context is basically releasing a very enthusiastic intern into a fog bank."
                : result.autonomyValue < 36 && result.fog > 35
                    ? "This run feels less like collaboration and more like supervising a hostage situation."
                    : "Jon's thesis holds up rather well here: context beats micromanagement more often than not.";

            ticker.innerHTML = rows.map(([label, text]) => `
                <div class="ticker-item">
                    <span>${label}</span>
                    <strong>${text}</strong>
                </div>
            `).join("");
        }

        function update() {
            updateDial();
            const result = analyze();
            applyMeters(result);
            launchNarrative(result);
        }

        autonomy.addEventListener("input", update);

        document.querySelectorAll(".recipe-btn").forEach((button) => {
            button.addEventListener("click", () => {
                const recipe = recipes[button.dataset.recipe];
                missionId = recipe.mission;
                selected = new Set(recipe.picks);
                autonomy.value = recipe.autonomy;
                renderMissions();
                renderContexts();
                update();
            });
        });

        document.getElementById("autofill").addEventListener("click", () => {
            missionId = "feature";
            autonomy.value = 72;
            selected = new Set(["product", "rules", "data", "transcript", "examples", "constraints"]);
            renderMissions();
            renderContexts();
            update();
        });

        document.getElementById("launch").addEventListener("click", update);

        renderMissions();
        renderContexts();
        update();
    </script>
</body>
</html>
