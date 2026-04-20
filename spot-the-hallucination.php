<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spot the Hallucination</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=IBM+Plex+Mono:ital,wght@0,400;0,500;1,400&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #080d1a;
            --card-bg: rgba(18, 25, 48, 0.95);
            --border: rgba(108, 99, 255, 0.25);
            --border-glow: rgba(108, 99, 255, 0.6);
            --accent: #6c63ff;
            --accent-soft: rgba(108, 99, 255, 0.15);
            --real: #22c55e;
            --real-soft: rgba(34, 197, 94, 0.12);
            --lie: #f43f5e;
            --lie-soft: rgba(244, 63, 94, 0.12);
            --text: #e2e8f0;
            --text-dim: #94a3b8;
            --mono: #7dd3c8;
            --gold: #f59e0b;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px 64px;
            position: relative;
            overflow-x: hidden;
        }

        /* Dot grid background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(108, 99, 255, 0.15) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 0;
        }

        /* Nebula glow */
        body::after {
            content: '';
            position: fixed;
            top: -40%;
            left: -20%;
            width: 80%;
            height: 80%;
            background: radial-gradient(ellipse, rgba(108, 99, 255, 0.07) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrap {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 680px;
        }

        /* ── Header ── */
        header {
            text-align: center;
            margin-bottom: 32px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent-soft);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 4px 14px;
            font-size: 0.72em;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 14px;
        }

        h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2em, 7vw, 3.2em);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -1px;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #e2e8f0 30%, #a5b4fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tagline {
            color: var(--text-dim);
            font-size: 0.92em;
            line-height: 1.6;
        }

        /* ── Score bar ── */
        .score-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 16px;
        }

        .progress-dots {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            transition: background 0.3s, border-color 0.3s, transform 0.3s;
        }
        .dot.correct { background: var(--real); border-color: var(--real); transform: scale(1.1); }
        .dot.wrong { background: var(--lie); border-color: var(--lie); transform: scale(1.1); }
        .dot.current { border-color: var(--accent); box-shadow: 0 0 6px var(--accent); }

        .score-display {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 1em;
            white-space: nowrap;
        }
        .score-display .num {
            color: var(--gold);
            font-size: 1.3em;
        }

        /* ── Main card ── */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px 28px;
            margin-bottom: 20px;
            box-shadow: 0 0 40px rgba(0,0,0,0.4), 0 0 80px rgba(108, 99, 255, 0.05);
            transition: box-shadow 0.4s;
        }

        .card.glow-real { box-shadow: 0 0 40px rgba(34,197,94,0.18), 0 0 0 2px rgba(34,197,94,0.4); }
        .card.glow-lie { box-shadow: 0 0 40px rgba(244,63,94,0.18), 0 0 0 2px rgba(244,63,94,0.4); }

        .question-label {
            font-size: 0.72em;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .question-text {
            font-family: 'Syne', sans-serif;
            font-size: 1.15em;
            font-weight: 600;
            line-height: 1.5;
            color: var(--text);
            margin-bottom: 24px;
        }

        /* AI response panel */
        .ai-panel {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(125, 211, 200, 0.2);
            border-radius: 12px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .ai-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(125, 211, 200, 0.5), transparent);
        }

        .ai-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
        }

        .ai-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #6c63ff, #7dd3c8);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .ai-name {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.75em;
            color: var(--mono);
            letter-spacing: 0.05em;
        }

        .cursor-blink {
            display: inline-block;
            width: 7px;
            height: 13px;
            background: var(--mono);
            animation: blink 1s step-end infinite;
            vertical-align: middle;
            margin-left: 2px;
            border-radius: 1px;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        .ai-response {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.85em;
            line-height: 1.75;
            color: #c8d8d8;
        }

        /* ── Buttons ── */
        .btn-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            border: none;
            border-radius: 14px;
            padding: 18px 12px;
            font-family: 'Syne', sans-serif;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, opacity 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            letter-spacing: 0.02em;
        }

        .btn:hover:not(:disabled) { transform: translateY(-2px); }
        .btn:active:not(:disabled) { transform: scale(0.97); }
        .btn:disabled { opacity: 0.4; cursor: not-allowed; }

        .btn-real {
            background: linear-gradient(135deg, #166534, #15803d);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #dcfce7;
            box-shadow: 0 4px 24px rgba(34, 197, 94, 0.2);
        }
        .btn-real:hover:not(:disabled) { box-shadow: 0 6px 32px rgba(34, 197, 94, 0.35); }

        .btn-lie {
            background: linear-gradient(135deg, #881337, #be123c);
            border: 1px solid rgba(244, 63, 94, 0.4);
            color: #ffe4e6;
            box-shadow: 0 4px 24px rgba(244, 63, 94, 0.2);
        }
        .btn-lie:hover:not(:disabled) { box-shadow: 0 6px 32px rgba(244, 63, 94, 0.35); }

        .btn-icon { font-size: 1.5em; }
        .btn-label { font-size: 0.8em; letter-spacing: 0.05em; }

        /* ── Reveal ── */
        .reveal {
            display: none;
            animation: slideUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        .reveal.visible { display: block; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .reveal-card {
            border-radius: 16px;
            padding: 22px 24px;
            margin-bottom: 16px;
        }

        .reveal-card.correct {
            background: var(--real-soft);
            border: 1px solid rgba(34, 197, 94, 0.4);
        }

        .reveal-card.incorrect {
            background: var(--lie-soft);
            border: 1px solid rgba(244, 63, 94, 0.4);
        }

        .reveal-verdict {
            font-family: 'Syne', sans-serif;
            font-size: 1.2em;
            font-weight: 800;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .reveal-verdict.v-correct { color: var(--real); }
        .reveal-verdict.v-incorrect { color: var(--lie); }

        .reveal-text {
            font-size: 0.9em;
            line-height: 1.65;
            color: var(--text-dim);
        }

        .btn-next {
            width: 100%;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px;
            font-family: 'Syne', sans-serif;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.3);
        }
        .btn-next:hover { background: #5a52e8; transform: translateY(-2px); box-shadow: 0 6px 28px rgba(108, 99, 255, 0.45); }

        /* ── End screen ── */
        #end-screen {
            display: none;
            text-align: center;
        }

        .final-score {
            font-family: 'Syne', sans-serif;
            font-size: 5em;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 16px 0 8px;
        }

        .final-label {
            color: var(--text-dim);
            font-size: 0.9em;
            margin-bottom: 24px;
        }

        .result-message {
            font-family: 'Syne', sans-serif;
            font-size: 1.3em;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .breakdown {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 24px 0;
        }

        .breakdown-item {
            border-radius: 12px;
            padding: 16px;
            text-align: left;
        }

        .breakdown-item.correct { background: var(--real-soft); border: 1px solid rgba(34,197,94,0.3); }
        .breakdown-item.incorrect { background: var(--lie-soft); border: 1px solid rgba(244,63,94,0.3); }

        .breakdown-num {
            font-family: 'Syne', sans-serif;
            font-size: 2em;
            font-weight: 800;
        }
        .breakdown-item.correct .breakdown-num { color: var(--real); }
        .breakdown-item.incorrect .breakdown-num { color: var(--lie); }
        .breakdown-lbl { font-size: 0.8em; color: var(--text-dim); margin-top: 2px; }

        .btn-restart {
            background: linear-gradient(135deg, var(--accent), #5a52e8);
            color: white;
            border: none;
            border-radius: 14px;
            padding: 16px 40px;
            font-family: 'Syne', sans-serif;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 20px rgba(108, 99, 255, 0.3);
        }
        .btn-restart:hover { transform: translateY(-2px); box-shadow: 0 6px 28px rgba(108, 99, 255, 0.45); }

        /* Attribution */
        .attribution {
            text-align: center;
            margin-top: 36px;
            font-size: 0.78em;
            color: rgba(148, 163, 184, 0.5);
        }
        .attribution a { color: rgba(108, 99, 255, 0.7); text-decoration: none; }

        /* Shake animation for wrong answer */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-6px); }
            40% { transform: translateX(6px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }
        .shake { animation: shake 0.45s ease; }

        /* Pulse for correct */
        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.6); }
            100% { box-shadow: 0 0 0 16px rgba(34, 197, 94, 0); }
        }
        .pulse-correct { animation: pulse-green 0.5s ease-out; }

        @media (max-width: 480px) {
            .card { padding: 22px 18px; }
            .btn { padding: 15px 8px; font-size: 0.9em; }
            .final-score { font-size: 4em; }
        }
    </style>
</head>
<body>
    <div class="page-wrap">
        <header>
            <div class="badge">🤖 AI Fact-Check Game</div>
            <h1>Spot the Hallucination</h1>
            <p class="tagline">An AI just answered 10 questions. Some answers are accurate.<br>Some are confidently, completely wrong. Can you tell the difference?</p>
        </header>

        <div id="game-screen">
            <div class="score-row">
                <div class="progress-dots" id="progress-dots"></div>
                <div class="score-display">Score: <span class="num" id="score-num">0</span></div>
            </div>

            <div class="card" id="main-card">
                <div class="question-label">
                    <span>🔍</span>
                    <span>Question <span id="q-num">1</span> of 10</span>
                </div>
                <p class="question-text" id="question-text"></p>
                <div class="ai-panel">
                    <div class="ai-header">
                        <div class="ai-icon">🤖</div>
                        <div>
                            <div class="ai-name">AI ASSISTANT <span class="cursor-blink"></span></div>
                        </div>
                    </div>
                    <p class="ai-response" id="ai-response"></p>
                </div>
            </div>

            <div class="btn-row">
                <button class="btn btn-real" id="btn-real" onclick="guess(false)">
                    <span class="btn-icon">✅</span>
                    <span>Looks Real</span>
                    <span class="btn-label">I believe it</span>
                </button>
                <button class="btn btn-lie" id="btn-lie" onclick="guess(true)">
                    <span class="btn-icon">🚨</span>
                    <span>That's a Lie!</span>
                    <span class="btn-label">Hallucination</span>
                </button>
            </div>

            <div class="reveal" id="reveal-section">
                <div class="reveal-card" id="reveal-card">
                    <div class="reveal-verdict" id="reveal-verdict"></div>
                    <p class="reveal-text" id="reveal-text"></p>
                </div>
                <button class="btn-next" id="btn-next" onclick="nextQuestion()">
                    Next Question →
                </button>
            </div>
        </div>

        <div id="end-screen">
            <div class="card">
                <div class="badge">🏁 Game Over</div>
                <div class="final-score" id="final-score"></div>
                <div class="final-label">out of 10</div>
                <div class="result-message" id="result-message"></div>
                <div class="breakdown">
                    <div class="breakdown-item correct">
                        <div class="breakdown-num" id="breakdown-correct">0</div>
                        <div class="breakdown-lbl">Correct calls</div>
                    </div>
                    <div class="breakdown-item incorrect">
                        <div class="breakdown-num" id="breakdown-wrong">0</div>
                        <div class="breakdown-lbl">Missed / tricked</div>
                    </div>
                </div>
                <button class="btn-restart" onclick="restart()">Play Again ↩</button>
            </div>
        </div>

        <div class="attribution">
            Inspired by Jon's post on <a href="https://jona.ca/2024/02/workaround-for-ai-hallucination-make.html" target="_blank">AI hallucination</a>
            — where a confident AI invented an acronym that didn't exist.
            Built by Chloe · <a href="./">← Back to index</a>
        </div>
    </div>

    <script>
    const questions = [
        {
            question: "Who created YubNub, the social command-line for the web?",
            aiResponse: "YubNub is a social command-line for the web, created by Canadian developer Jonathan Aquino in 2005. Users type short commands — \"g hello\" to Google something, \"yt cats\" to search YouTube. The name YubNub was taken from the Ewok victory celebration chant in Return of the Jedi. It spread rapidly through the tech blogosphere after launch.",
            isHallucination: false,
            explanation: "✓ Entirely accurate! Jonathan Aquino did create YubNub in 2005, and the name really does come from the Ewok victory chant from Return of the Jedi. It remains live today, upgraded to modern infrastructure in 2025."
        },
        {
            question: "When were the Luminous Mysteries added to the Rosary, and by whom?",
            aiResponse: "The Luminous Mysteries — also called the Mysteries of Light — were added to the Rosary by Pope Paul VI in his apostolic exhortation Marialis Cultus, released on February 2nd, 1974. These five mysteries cover the public ministry of Jesus, from the Baptism in the Jordan to the institution of the Eucharist at the Last Supper.",
            isHallucination: true,
            explanation: "Hallucination! The Luminous Mysteries were introduced by Pope John Paul II in 2002, via his apostolic letter Rosarium Virginis Mariae — not Pope Paul VI in 1974. Pope Paul VI did write Marialis Cultus, but about devotion to Mary generally, not new Rosary mysteries."
        },
        {
            question: "What is Mark Forster's Final Version Perfected (FVP) algorithm?",
            aiResponse: "Final Version Perfected (FVP) is a task management algorithm by productivity author Mark Forster. You scan your list and mark the first item, then work down asking: \"Do I want to do this more than the last item I marked?\" If yes, mark it. The last item marked is what you do next, then cross it off and repeat. This surfaces your most urgently felt task without any prioritization.",
            isHallucination: false,
            explanation: "✓ Accurate! This is a correct description of FVP. The comparison chain is the key insight — you're never ranking everything, just comparing to the previous winner. It's remarkably effective at cutting through procrastination."
        },
        {
            question: "When did Gmail launch, and why did people initially think it was a joke?",
            aiResponse: "Gmail launched on April 1, 2004 — April Fool's Day — with a then-unheard-of 1 GB of free storage. Competitors like Hotmail offered just 2-4 MB. Because the announcement fell on April 1st and the storage offer seemed impossibly generous, many tech journalists initially assumed it was a prank. It wasn't.",
            isHallucination: false,
            explanation: "✓ Completely accurate! Gmail launched on April Fool's Day 2004 with 1 GB of storage, while Hotmail offered 2 MB. The deliberate April 1st timing was Google's greatest deadpan joke — the product was real and the joke was that nobody believed it."
        },
        {
            question: "Where is the Capilano Suspension Bridge located, and what are its dimensions?",
            aiResponse: "The Capilano Suspension Bridge is located in West Vancouver, British Columbia, spanning 180 metres (590 feet) across the Capilano Canyon at a height of 70 metres (230 feet). It was originally constructed in 1889 by Scottish civil engineer George Grant Mackay using hemp rope and cedar planks.",
            isHallucination: true,
            explanation: "Hallucination! The bridge is in North Vancouver, not West Vancouver — two different municipalities. The span is also wrong: 137 metres (450 feet), not 180 metres (590 feet). The 1889 construction date and engineer name are correct."
        },
        {
            question: "What does the acronym PHP stand for, and how did the name evolve?",
            aiResponse: "PHP stands for \"PHP: Hypertext Preprocessor\" — a recursive acronym where the abbreviation contains itself. It was originally called \"Personal Home Page Tools\" when created by Rasmus Lerdorf in 1994. The recursive rename was a nod to the GNU project's tradition of recursive acronyms. PHP now powers roughly 77% of all websites with a known server-side language.",
            isHallucination: false,
            explanation: "✓ Accurate! PHP is a recursive acronym — PHP: Hypertext Preprocessor. It started as Personal Home Page Tools in 1994. The recursive naming tradition was intentional. Today it powers WordPress and countless other sites."
        },
        {
            question: "Who co-authored 'Hold On to Your Kids' with Dr. Gordon Neufeld?",
            aiResponse: "\"Hold On to Your Kids: Why Parents Need to Matter More Than Peers\" was co-authored by Dr. Gordon Neufeld and Dr. Gabor Maté, and published in 2004. The book argues that peer orientation — when children look to peers rather than parents for cues — is a damaging modern phenomenon that undermines healthy development.",
            isHallucination: false,
            explanation: "✓ Correct! Gordon Neufeld and Gabor Maté co-authored 'Hold On to Your Kids' in 2004. It's become a foundational text for attachment-focused parenting, and the peer orientation thesis is central to Neufeld's life's work."
        },
        {
            question: "What happened when a developer asked a corporate AI what \"BADF\" stood for?",
            aiResponse: "A developer asked their company's wiki AI what the internal acronym \"BADF\" stood for. The AI confidently replied that BAMDF stood for \"Bidder Advertiser Metadata Framework.\" When the developer checked with colleagues, the real answer was \"Binary Augmented MDF\" — the AI had hallucinated a wrong expansion of a similar-looking acronym and presented it with total certainty.",
            isHallucination: false,
            explanation: "✓ Real! This actually happened — the developer who shared it noted the AI showed zero hesitation despite being entirely wrong. It's a perfect case study in confident hallucination, and the basis for a thoughtful blog post about how AI should signal uncertainty."
        },
        {
            question: "When was Claude Code first publicly released by Anthropic?",
            aiResponse: "Claude Code was first publicly released by Anthropic in October 2023 as a beta feature within the Claude.ai interface. It quickly attracted developers looking for a more conversational alternative to GitHub Copilot, and gained significant traction through late 2023 as AI-assisted coding tools were rapidly proliferating.",
            isHallucination: true,
            explanation: "Hallucination! Claude Code launched in early 2025 as a research preview — not October 2023. The description of it as a \"feature within Claude.ai\" is also wrong. Claude Code is a standalone command-line tool. The real release was over a year later than claimed here."
        },
        {
            question: "What is Mark Forster's original Autofocus (AF1) productivity system?",
            aiResponse: "The Autofocus system was created by British author Mark Forster. Unlike GTD or Pomodoro, it uses psychological resistance as a guide: you scan your running task list and work on whichever item \"stands out\" to you on that pass. If nothing stands out, you move to the next item. The idea is that your subconscious mind knows what you're ready to tackle — and forcing tasks creates unnecessary internal friction.",
            isHallucination: false,
            explanation: "✓ Accurate! Forster's Autofocus uses the \"stands out\" feeling as its core mechanism — a beautifully low-friction approach. It's the predecessor to SuperFocus, Final Version, and FVP, each iteration refining how to surface the right task without willpower."
        }
    ];

    // Shuffle
    function shuffle(arr) {
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[i], arr[j]] = [arr[j], arr[i]];
        }
        return arr;
    }

    let shuffled = shuffle([...questions]);
    let current = 0;
    let score = 0;
    let results = [];

    function init() {
        // Build progress dots
        const dots = document.getElementById('progress-dots');
        dots.innerHTML = '';
        for (let i = 0; i < 10; i++) {
            const d = document.createElement('div');
            d.className = 'dot' + (i === 0 ? ' current' : '');
            d.id = 'dot-' + i;
            dots.appendChild(d);
        }
        renderQuestion();
    }

    function renderQuestion() {
        const q = shuffled[current];
        document.getElementById('q-num').textContent = current + 1;
        document.getElementById('question-text').textContent = q.question;
        document.getElementById('ai-response').textContent = q.aiResponse;

        // Reset state
        document.getElementById('main-card').className = 'card';
        const reveal = document.getElementById('reveal-section');
        reveal.className = 'reveal';
        document.getElementById('btn-real').disabled = false;
        document.getElementById('btn-lie').disabled = false;

        // Update dots
        for (let i = 0; i < 10; i++) {
            const dot = document.getElementById('dot-' + i);
            dot.classList.remove('current');
            if (i === current) dot.classList.add('current');
        }
    }

    function guess(guessedHallucination) {
        const q = shuffled[current];
        const correct = (guessedHallucination === q.isHallucination);

        // Update score
        if (correct) score++;
        results.push(correct);

        // Update UI
        document.getElementById('score-num').textContent = score;
        document.getElementById('btn-real').disabled = true;
        document.getElementById('btn-lie').disabled = true;

        const card = document.getElementById('main-card');
        const dot = document.getElementById('dot-' + current);

        if (correct) {
            card.classList.add('glow-real');
            card.classList.add('pulse-correct');
            dot.className = 'dot correct';
        } else {
            card.classList.add('glow-lie');
            card.classList.add('shake');
            dot.className = 'dot wrong';
        }

        // Reveal
        const revealCard = document.getElementById('reveal-card');
        const verdict = document.getElementById('reveal-verdict');
        const revealText = document.getElementById('reveal-text');
        const nextBtn = document.getElementById('btn-next');

        if (correct) {
            revealCard.className = 'reveal-card correct';
            verdict.className = 'reveal-verdict v-correct';
            verdict.textContent = correct ? (q.isHallucination ? '🚨 Correct — That was a hallucination!' : '✅ Correct — That was real!') : 'Incorrect';
        } else {
            revealCard.className = 'reveal-card incorrect';
            verdict.className = 'reveal-verdict v-incorrect';
            verdict.textContent = q.isHallucination ? '❌ Missed it — That was a hallucination!' : '❌ Tricked you — That was real!';
        }

        revealText.textContent = q.explanation;
        nextBtn.textContent = current < 9 ? 'Next Question →' : 'See My Results →';

        const reveal = document.getElementById('reveal-section');
        reveal.className = 'reveal visible';
    }

    function nextQuestion() {
        current++;
        if (current >= 10) {
            showEndScreen();
        } else {
            renderQuestion();
        }
    }

    function showEndScreen() {
        document.getElementById('game-screen').style.display = 'none';
        const end = document.getElementById('end-screen');
        end.style.display = 'block';

        document.getElementById('final-score').textContent = score;
        document.getElementById('breakdown-correct').textContent = results.filter(r => r).length;
        document.getElementById('breakdown-wrong').textContent = results.filter(r => !r).length;

        let msg;
        if (score === 10) msg = "Perfect score! You're an AI whisperer. 🧠✨";
        else if (score >= 8) msg = "Impressive! Hardly any AI can fool you. 🔍";
        else if (score >= 6) msg = "Solid work — you've got a good nose for nonsense. 👃";
        else if (score >= 4) msg = "The AI got you a few times. It's sneaky like that. 🤖";
        else msg = "The AI would like a word with you. 😬 Try again?";

        document.getElementById('result-message').textContent = msg;
    }

    function restart() {
        shuffled = shuffle([...questions]);
        current = 0;
        score = 0;
        results = [];
        document.getElementById('score-num').textContent = 0;
        document.getElementById('end-screen').style.display = 'none';
        document.getElementById('game-screen').style.display = 'block';
        init();
    }

    init();
    </script>
</body>
</html>
