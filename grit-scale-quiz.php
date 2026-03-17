<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grit Scale Quiz</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #1a1108;
            --surface: #231a0c;
            --surface2: #2d2210;
            --gold: #e8a820;
            --gold-light: #f5c84a;
            --gold-dark: #b07a10;
            --orange: #d4621a;
            --text: #f0e4cc;
            --text-muted: #a08060;
            --accent: #c84a10;
            --bar-empty: #3a2a10;
            --bar-fill: linear-gradient(90deg, #c84a10, #e8a820);
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            padding: 24px 16px 60px;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
        }

        /* Header */
        header {
            text-align: center;
            padding: 48px 0 40px;
        }
        .flame {
            font-size: 3em;
            display: block;
            margin-bottom: 12px;
            animation: flicker 3s ease-in-out infinite;
        }
        @keyframes flicker {
            0%, 100% { transform: scale(1) rotate(-2deg); }
            25% { transform: scale(1.05) rotate(1deg); }
            50% { transform: scale(0.97) rotate(-1deg); }
            75% { transform: scale(1.03) rotate(2deg); }
        }
        h1 {
            font-size: 2.4em;
            font-weight: 900;
            letter-spacing: -1px;
            color: var(--gold);
            text-shadow: 0 0 40px rgba(232, 168, 32, 0.4);
            margin-bottom: 10px;
        }
        .subtitle {
            color: var(--text-muted);
            font-size: 1em;
            line-height: 1.6;
        }
        .subtitle a {
            color: var(--gold);
            text-decoration: none;
            opacity: 0.8;
        }
        .subtitle a:hover { opacity: 1; text-decoration: underline; }

        /* Progress bar */
        .progress-wrap {
            background: var(--surface2);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .progress-label {
            font-size: 0.85em;
            color: var(--text-muted);
            white-space: nowrap;
            min-width: 80px;
        }
        .progress-bar-outer {
            flex: 1;
            height: 8px;
            background: var(--bar-empty);
            border-radius: 8px;
            overflow: hidden;
        }
        .progress-bar-inner {
            height: 100%;
            background: var(--bar-fill);
            border-radius: 8px;
            transition: width 0.4s ease;
        }

        /* Question card */
        .question-card {
            background: var(--surface);
            border: 1px solid #3a2808;
            border-radius: 16px;
            padding: 28px 24px;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .question-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .question-num {
            font-size: 0.75em;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .question-text {
            font-size: 1.1em;
            line-height: 1.55;
            color: var(--text);
            margin-bottom: 24px;
        }

        /* Answer options */
        .options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .option {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--surface2);
            border: 1.5px solid #3a2808;
            border-radius: 10px;
            padding: 12px 16px;
            cursor: pointer;
            transition: all 0.18s ease;
            text-align: left;
            color: var(--text);
            font-size: 0.92em;
            width: 100%;
        }
        .option:hover {
            border-color: var(--gold-dark);
            background: #2d2010;
        }
        .option.selected {
            border-color: var(--gold);
            background: rgba(232, 168, 32, 0.12);
            color: var(--gold-light);
        }
        .option-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid var(--text-muted);
            flex-shrink: 0;
            transition: all 0.18s;
        }
        .option.selected .option-dot {
            background: var(--gold);
            border-color: var(--gold);
        }

        /* Nav buttons */
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            gap: 12px;
        }
        .btn {
            padding: 12px 28px;
            border-radius: 10px;
            font-size: 0.95em;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.18s;
        }
        .btn-ghost {
            background: transparent;
            color: var(--text-muted);
            border: 1.5px solid #3a2808;
        }
        .btn-ghost:hover {
            border-color: var(--gold-dark);
            color: var(--text);
        }
        .btn-primary {
            background: var(--gold);
            color: #1a1108;
            flex: 1;
        }
        .btn-primary:hover {
            background: var(--gold-light);
        }
        .btn-primary:disabled {
            opacity: 0.35;
            cursor: not-allowed;
        }

        /* Quote bar */
        .quote-bar {
            background: var(--surface2);
            border-left: 3px solid var(--gold-dark);
            border-radius: 0 10px 10px 0;
            padding: 14px 18px;
            margin-bottom: 28px;
            font-style: italic;
            font-size: 0.9em;
            color: var(--text-muted);
            line-height: 1.5;
            transition: opacity 0.4s;
        }
        .quote-bar span {
            display: block;
            font-style: normal;
            color: #6a4820;
            font-size: 0.85em;
            margin-top: 6px;
        }

        /* === Results page === */
        #results { display: none; }
        .results-header { text-align: center; padding: 32px 0 24px; }
        .score-badge {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            background: var(--surface);
            border: 2px solid var(--gold-dark);
            border-radius: 50%;
            width: 160px;
            height: 160px;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 0 60px rgba(232, 168, 32, 0.25);
        }
        .score-num {
            font-size: 3em;
            font-weight: 900;
            color: var(--gold);
            line-height: 1;
        }
        .score-max {
            font-size: 0.85em;
            color: var(--text-muted);
        }
        .score-label {
            font-size: 1.4em;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }
        .score-desc {
            color: var(--text-muted);
            font-size: 0.95em;
            line-height: 1.6;
            max-width: 480px;
            margin: 0 auto;
        }

        /* Bar chart */
        .chart-section {
            background: var(--surface);
            border: 1px solid #3a2808;
            border-radius: 16px;
            padding: 24px;
            margin: 28px 0;
        }
        .chart-title {
            font-size: 0.8em;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }
        .chart-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }
        .chart-label {
            font-size: 0.82em;
            color: var(--text-muted);
            width: 150px;
            flex-shrink: 0;
            line-height: 1.3;
        }
        .chart-bar-outer {
            flex: 1;
            height: 8px;
            background: var(--bar-empty);
            border-radius: 8px;
            overflow: hidden;
        }
        .chart-bar-inner {
            height: 100%;
            background: var(--bar-fill);
            border-radius: 8px;
            width: 0;
            transition: width 1s ease 0.3s;
        }
        .chart-val {
            font-size: 0.85em;
            color: var(--text-muted);
            width: 28px;
            text-align: right;
            flex-shrink: 0;
        }

        /* Grit levels */
        .levels-section {
            background: var(--surface);
            border: 1px solid #3a2808;
            border-radius: 16px;
            padding: 24px;
            margin: 0 0 28px;
        }
        .level-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 0;
            border-bottom: 1px solid #2d2010;
        }
        .level-row:last-child { border-bottom: none; }
        .level-range {
            font-size: 0.82em;
            color: var(--text-muted);
            width: 70px;
            flex-shrink: 0;
            font-variant-numeric: tabular-nums;
        }
        .level-name {
            font-size: 0.92em;
            flex: 1;
        }
        .level-name.current {
            color: var(--gold);
            font-weight: 700;
        }
        .level-icon {
            font-size: 1.2em;
        }

        /* Retake button */
        .btn-retake {
            display: block;
            width: 100%;
            max-width: 320px;
            margin: 0 auto;
            padding: 14px 32px;
            background: transparent;
            border: 1.5px solid var(--gold-dark);
            border-radius: 12px;
            color: var(--gold);
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            transition: all 0.18s;
        }
        .btn-retake:hover {
            background: rgba(232, 168, 32, 0.1);
        }

        /* Grit quote at bottom */
        .closing-quote {
            text-align: center;
            margin-top: 40px;
            padding: 32px 24px;
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid #3a2808;
        }
        .closing-quote blockquote {
            font-size: 1.1em;
            font-style: italic;
            color: var(--text);
            line-height: 1.7;
            margin-bottom: 12px;
        }
        .closing-quote cite {
            font-size: 0.85em;
            color: var(--text-muted);
        }

        @media (max-width: 480px) {
            h1 { font-size: 1.9em; }
            .score-badge { width: 130px; height: 130px; }
            .score-num { font-size: 2.4em; }
            .options { gap: 6px; }
            .option { padding: 10px 12px; }
            .chart-label { width: 120px; font-size: 0.78em; }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- === QUIZ === -->
    <div id="quiz">
        <header>
            <span class="flame">🔥</span>
            <h1>The Grit Scale</h1>
            <p class="subtitle">
                Angela Duckworth's Short Grit Scale &mdash; 8 questions,<br>
                about 2 minutes. How gritty are you?
            </p>
        </header>

        <div class="progress-wrap">
            <span class="progress-label" id="progress-label">Question 1 / 8</span>
            <div class="progress-bar-outer">
                <div class="progress-bar-inner" id="progress-bar" style="width:0%"></div>
            </div>
        </div>

        <div class="quote-bar" id="quote-bar">
            <em id="quote-text"></em>
            <span id="quote-attr"></span>
        </div>

        <div class="question-card" id="question-card">
            <div class="question-num" id="question-num"></div>
            <div class="question-text" id="question-text"></div>
            <div class="options" id="options"></div>
        </div>

        <div class="nav">
            <button class="btn btn-ghost" id="btn-back" onclick="goBack()" style="display:none">← Back</button>
            <button class="btn btn-primary" id="btn-next" onclick="goNext()" disabled>
                Next →
            </button>
        </div>
    </div>

    <!-- === RESULTS === -->
    <div id="results">
        <div class="results-header">
            <span class="flame">🔥</span>
            <h1>Your Grit Score</h1>
        </div>

        <div style="text-align:center; margin-bottom:32px;">
            <div class="score-badge" id="score-badge">
                <div class="score-num" id="result-score">—</div>
                <div class="score-max">out of 5</div>
            </div>
            <div class="score-label" id="result-label"></div>
            <p class="score-desc" id="result-desc"></p>
        </div>

        <div class="chart-section">
            <div class="chart-title">Your answers breakdown</div>
            <div id="chart-rows"></div>
        </div>

        <div class="levels-section">
            <div class="chart-title" style="margin-bottom:8px">Grit levels</div>
            <div class="level-row">
                <div class="level-range">4.5 – 5.0</div>
                <div class="level-name" id="lvl-5">Extremely gritty 💥</div>
            </div>
            <div class="level-row">
                <div class="level-range">3.5 – 4.4</div>
                <div class="level-name" id="lvl-4">Very gritty 💪</div>
            </div>
            <div class="level-row">
                <div class="level-range">2.5 – 3.4</div>
                <div class="level-name" id="lvl-3">Moderately gritty 🌱</div>
            </div>
            <div class="level-row">
                <div class="level-range">1.0 – 2.4</div>
                <div class="level-name" id="lvl-2">Building grit 🌱</div>
            </div>
        </div>

        <div class="closing-quote">
            <blockquote id="closing-quote-text"></blockquote>
            <cite id="closing-quote-cite"></cite>
        </div>

        <br>
        <button class="btn-retake" onclick="retake()">↺ Retake Quiz</button>
        <br><br>
        <p style="text-align:center; font-size:0.78em; color: var(--text-muted)">
            Based on the <em>Short Grit Scale</em> (Grit-S) by Angela Duckworth &amp; colleagues, 2009.
        </p>
    </div>

</div>

<script>
const QUESTIONS = [
    {
        text: "New ideas and projects sometimes distract me from previous ones.",
        reverse: true,
    },
    {
        text: "Setbacks don't discourage me. I don't give up easily.",
        reverse: false,
    },
    {
        text: "I have been obsessed with a certain idea or project for a short time but later lost interest.",
        reverse: true,
    },
    {
        text: "I am a hard worker.",
        reverse: false,
    },
    {
        text: "I often set a goal but later choose to pursue a different one.",
        reverse: true,
    },
    {
        text: "I have difficulty maintaining my focus on projects that take more than a few months to complete.",
        reverse: true,
    },
    {
        text: "I finish whatever I begin.",
        reverse: false,
    },
    {
        text: "I am diligent. I never give up.",
        reverse: false,
    },
];

const OPTIONS = [
    { value: 5, label: "Very much like me" },
    { value: 4, label: "Mostly like me" },
    { value: 3, label: "Somewhat like me" },
    { value: 2, label: "Not much like me" },
    { value: 1, label: "Not like me at all" },
];

const QUOTES = [
    { text: "It's not that I'm so smart, it's just that I stay with problems longer.", attr: "— Albert Einstein" },
    { text: "Grit is living life like it's a marathon, not a sprint.", attr: "— Angela Duckworth, Grit" },
    { text: "Fall seven times and stand up eight.", attr: "— Japanese proverb" },
    { text: "The most certain way to succeed is always to try just one more time.", attr: "— Thomas Edison" },
    { text: "Perseverance is not a long race; it is many short races one after the other.", attr: "— Walter Elliot" },
    { text: "Talent is cheaper than table salt. What separates the talented individual from the successful one is a lot of hard work.", attr: "— Stephen King" },
    { text: "Character consists of what you do on the third and fourth tries.", attr: "— James A. Michener" },
    { text: "The secret of our success is that we never, never give up.", attr: "— Wilma Mankiller" },
];

const CLOSING_QUOTES = [
    { text: "\"Grit is passion and perseverance for very long-term goals. Grit is having stamina. Grit is sticking with your future, day in, day out, not just for the week, not just for the month, but for years, and working really hard to make that future a reality.\"", cite: "— Angela Duckworth, TED Talk, 2013" },
    { text: "\"Nobody is great without work. It's a myth, it's fantasy, it's an excuse not to try.\"", cite: "— Angela Duckworth, Grit (2016)" },
    { text: "\"Enthusiasm is common. Endurance is rare.\"", cite: "— Angela Duckworth, Grit (2016)" },
];

const LEVELS = [
    { min: 4.5, max: 5.0, id: "lvl-5", label: "Extremely gritty 💥",
      desc: "You're in rare company. Your passion and perseverance are exceptional — you pursue long-term goals with remarkable consistency and bounce back from setbacks with iron resolve." },
    { min: 3.5, max: 4.49, id: "lvl-4", label: "Very gritty 💪",
      desc: "You have strong grit. You stay the course on things that matter to you, work hard, and don't give up easily. When challenges come, you dig in." },
    { min: 2.5, max: 3.49, id: "lvl-3", label: "Moderately gritty 🌱",
      desc: "You have a good foundation of grit. In some areas you show real perseverance; in others, new interests can pull you away. You're building something solid." },
    { min: 1.0, max: 2.49, id: "lvl-2", label: "Building grit 🌱",
      desc: "Your grit muscles are in training. Remember: grit can be grown. Each time you push through resistance, you're laying the foundation for something lasting." },
];

let current = 0;
let answers = new Array(QUESTIONS.length).fill(null);

function init() {
    current = 0;
    answers = new Array(QUESTIONS.length).fill(null);
    showQuestion(0);
    updateProgress();
    rotateQuote();
    document.getElementById('quiz').style.display = '';
    document.getElementById('results').style.display = 'none';
    window.scrollTo(0, 0);
}

function rotateQuote() {
    const q = QUOTES[Math.floor(Math.random() * QUOTES.length)];
    document.getElementById('quote-text').textContent = q.text;
    document.getElementById('quote-attr').textContent = q.attr;
}

function showQuestion(index) {
    const q = QUESTIONS[index];
    document.getElementById('question-num').textContent = `Question ${index + 1} of ${QUESTIONS.length}`;
    document.getElementById('question-text').textContent = q.text;

    const optionsEl = document.getElementById('options');
    optionsEl.innerHTML = '';
    OPTIONS.forEach(opt => {
        const btn = document.createElement('button');
        btn.className = 'option' + (answers[index] === opt.value ? ' selected' : '');
        btn.innerHTML = `<span class="option-dot"></span> ${opt.label}`;
        btn.onclick = () => selectAnswer(index, opt.value, btn);
        optionsEl.appendChild(btn);
    });

    // Animate in
    const card = document.getElementById('question-card');
    card.classList.remove('visible');
    setTimeout(() => card.classList.add('visible'), 20);

    // Update buttons
    document.getElementById('btn-back').style.display = index > 0 ? '' : 'none';
    updateNextBtn();
}

function selectAnswer(index, value, clickedBtn) {
    answers[index] = value;
    document.querySelectorAll('.option').forEach(b => b.classList.remove('selected'));
    clickedBtn.classList.add('selected');
    updateNextBtn();
}

function updateNextBtn() {
    const btn = document.getElementById('btn-next');
    const isLast = current === QUESTIONS.length - 1;
    btn.disabled = answers[current] === null;
    btn.textContent = isLast ? '🔥 See My Score' : 'Next →';
}

function updateProgress() {
    const answered = answers.filter(a => a !== null).length;
    const pct = (answered / QUESTIONS.length) * 100;
    document.getElementById('progress-bar').style.width = pct + '%';
    document.getElementById('progress-label').textContent = `Question ${current + 1} / ${QUESTIONS.length}`;
}

function goNext() {
    if (answers[current] === null) return;
    if (current < QUESTIONS.length - 1) {
        current++;
        showQuestion(current);
        updateProgress();
        rotateQuote();
    } else {
        showResults();
    }
}

function goBack() {
    if (current > 0) {
        current--;
        showQuestion(current);
        updateProgress();
        rotateQuote();
    }
}

function computeScore() {
    let total = 0;
    QUESTIONS.forEach((q, i) => {
        let val = answers[i];
        if (q.reverse) val = 6 - val;
        total += val;
    });
    return total / QUESTIONS.length;
}

function showResults() {
    const score = computeScore();
    const scoreFixed = score.toFixed(2);

    document.getElementById('quiz').style.display = 'none';
    document.getElementById('results').style.display = '';

    document.getElementById('result-score').textContent = scoreFixed;

    // Find level
    let level = LEVELS[LEVELS.length - 1];
    for (const l of LEVELS) {
        if (score >= l.min && score <= l.max) { level = l; break; }
    }
    document.getElementById('result-label').textContent = level.label;
    document.getElementById('result-desc').textContent = level.desc;

    // Highlight current level
    LEVELS.forEach(l => {
        const el = document.getElementById(l.id);
        el.classList.toggle('current', l.id === level.id);
    });

    // Build chart
    const chartEl = document.getElementById('chart-rows');
    chartEl.innerHTML = '';
    const shortLabels = [
        "Distracted by new ideas",
        "Don't give up easily",
        "Lose interest in projects",
        "Hard worker",
        "Change goals often",
        "Lose focus long-term",
        "Finish what I begin",
        "Diligent, never give up",
    ];
    QUESTIONS.forEach((q, i) => {
        let rawVal = answers[i];
        let scored = q.reverse ? (6 - rawVal) : rawVal;
        const pct = ((scored - 1) / 4) * 100;
        const row = document.createElement('div');
        row.className = 'chart-row';
        row.innerHTML = `
            <div class="chart-label">${shortLabels[i]}</div>
            <div class="chart-bar-outer">
                <div class="chart-bar-inner" data-pct="${pct}" style="width:0%"></div>
            </div>
            <div class="chart-val">${scored}</div>
        `;
        chartEl.appendChild(row);
    });

    // Animate bars
    setTimeout(() => {
        document.querySelectorAll('.chart-bar-inner').forEach(bar => {
            bar.style.width = bar.dataset.pct + '%';
        });
    }, 100);

    // Closing quote
    const cq = CLOSING_QUOTES[Math.floor(Math.random() * CLOSING_QUOTES.length)];
    document.getElementById('closing-quote-text').textContent = cq.text;
    document.getElementById('closing-quote-cite').textContent = cq.cite;

    window.scrollTo(0, 0);
}

function retake() {
    init();
}

// Start
init();
</script>
</body>
</html>
