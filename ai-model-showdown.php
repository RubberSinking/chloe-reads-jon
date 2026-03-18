<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jon's AI Model Showdown</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #0d0d12;
            color: #e8e8f0;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            width: 100%;
            max-width: 680px;
            padding: 32px 20px 0;
            text-align: center;
        }

        .logo {
            font-size: 0.75em;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 1.9em;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0 0 8px;
            background: linear-gradient(135deg, #a78bfa, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .subtitle {
            color: #7070a0;
            font-size: 0.95em;
            margin: 0 0 24px;
            line-height: 1.5;
        }

        /* === SCREENS === */
        .screen {
            display: none;
            width: 100%;
            max-width: 680px;
            padding: 0 20px 60px;
            flex-direction: column;
            align-items: center;
        }
        .screen.active { display: flex; }

        /* === WELCOME === */
        .welcome-card {
            background: #16161e;
            border: 1px solid #2a2a3a;
            border-radius: 16px;
            padding: 32px;
            width: 100%;
            text-align: center;
        }

        .model-lineup {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            margin: 24px 0;
        }

        .model-badge {
            padding: 8px 16px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.85em;
            letter-spacing: 0.04em;
        }
        .badge-chatgpt { background: #0d3322; color: #34d399; border: 1px solid #34d39940; }
        .badge-gemini  { background: #0d1f3c; color: #60a5fa; border: 1px solid #60a5fa40; }
        .badge-claude  { background: #2d1a0e; color: #fb923c; border: 1px solid #fb923c40; }
        .badge-q       { background: #2d1e08; color: #fbbf24; border: 1px solid #fbbf2440; }

        .welcome-desc {
            color: #8888aa;
            font-size: 0.9em;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .btn-start {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            color: #fff;
            border: none;
            padding: 14px 40px;
            border-radius: 999px;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.03em;
            transition: opacity 0.2s, transform 0.1s;
        }
        .btn-start:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-start:active { transform: translateY(0); }

        /* === PROGRESS === */
        .progress-bar-wrap {
            width: 100%;
            height: 4px;
            background: #1e1e2e;
            border-radius: 99px;
            margin: 24px 0 12px;
        }
        .progress-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, #7c3aed, #2563eb, #0ea5e9);
            transition: width 0.4s ease;
        }

        .q-meta {
            display: flex;
            justify-content: space-between;
            width: 100%;
            font-size: 0.8em;
            color: #555;
            margin-bottom: 20px;
        }

        .score-badge {
            font-weight: 700;
            color: #60a5fa;
        }

        /* === QUESTION CARD === */
        .q-card {
            background: #16161e;
            border: 1px solid #2a2a3a;
            border-radius: 16px;
            padding: 28px;
            width: 100%;
            margin-bottom: 20px;
        }

        .scenario-label {
            font-size: 0.7em;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 10px;
        }

        .scenario-text {
            font-size: 1.15em;
            font-weight: 600;
            line-height: 1.45;
            color: #e8e8f8;
        }

        /* === OPTIONS === */
        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            width: 100%;
            margin-bottom: 20px;
        }

        .option-btn {
            background: #16161e;
            border: 2px solid #2a2a3a;
            border-radius: 14px;
            padding: 18px 14px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: border-color 0.2s, transform 0.1s, background 0.2s;
            text-align: center;
        }
        .option-btn:hover:not(:disabled) {
            border-color: #4444aa;
            transform: translateY(-2px);
        }
        .option-btn:active:not(:disabled) { transform: translateY(0); }

        .option-icon {
            font-size: 1.8em;
            line-height: 1;
        }
        .option-name {
            font-weight: 700;
            font-size: 0.95em;
        }
        .option-tagline {
            font-size: 0.72em;
            color: #666;
            line-height: 1.3;
        }

        /* Option colors */
        .option-chatgpt { border-color: #34d39930; }
        .option-chatgpt .option-name { color: #34d399; }
        .option-chatgpt.selected, .option-chatgpt:hover:not(:disabled) { border-color: #34d399; background: #0d332288; }

        .option-gemini { border-color: #60a5fa30; }
        .option-gemini .option-name { color: #60a5fa; }
        .option-gemini.selected, .option-gemini:hover:not(:disabled) { border-color: #60a5fa; background: #0d1f3c88; }

        .option-claude { border-color: #fb923c30; }
        .option-claude .option-name { color: #fb923c; }
        .option-claude.selected, .option-claude:hover:not(:disabled) { border-color: #fb923c; background: #2d1a0e88; }

        .option-q { border-color: #fbbf2430; }
        .option-q .option-name { color: #fbbf24; }
        .option-q.selected, .option-q:hover:not(:disabled) { border-color: #fbbf24; background: #2d1e0888; }

        /* Correct/Wrong states */
        .option-btn.correct {
            background: #0d331a !important;
            border-color: #22c55e !important;
        }
        .option-btn.wrong {
            background: #2d0d0d !important;
            border-color: #ef4444 !important;
            opacity: 0.7;
        }
        .option-btn.correct .option-name,
        .option-btn.correct .option-tagline { color: #4ade80; }
        .option-btn.wrong .option-name,
        .option-btn.wrong .option-tagline { color: #f87171; }

        /* checkmark / x */
        .option-btn.correct::after {
            content: "✓";
            font-size: 1.2em;
            color: #4ade80;
            display: block;
        }
        .option-btn.wrong::after {
            content: "✗";
            font-size: 1.2em;
            color: #f87171;
            display: block;
        }

        /* === REVEAL CARD === */
        .reveal-card {
            background: #16161e;
            border: 1px solid #2a2a3a;
            border-radius: 16px;
            padding: 22px;
            width: 100%;
            margin-bottom: 20px;
            animation: slideIn 0.35s ease;
            display: none;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .reveal-result {
            font-size: 1.05em;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .reveal-result.correct-result { color: #4ade80; }
        .reveal-result.wrong-result   { color: #f87171; }

        .jon-says {
            font-size: 0.88em;
            line-height: 1.6;
            color: #9090b8;
            border-left: 3px solid #3333aa;
            padding-left: 14px;
            margin: 12px 0;
            font-style: italic;
        }

        .blog-link a {
            color: #60a5fa;
            text-decoration: none;
            font-size: 0.8em;
        }
        .blog-link a:hover { text-decoration: underline; }

        .btn-next {
            background: #1e1e2e;
            border: 1px solid #3333aa;
            color: #a0a0e8;
            padding: 12px 28px;
            border-radius: 999px;
            font-size: 0.95em;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-next:hover { background: #252538; }

        /* === END SCREEN === */
        .end-card {
            background: #16161e;
            border: 1px solid #2a2a3a;
            border-radius: 16px;
            padding: 36px;
            width: 100%;
            text-align: center;
        }

        .final-score {
            font-size: 4em;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, #a78bfa, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 16px 0 8px;
        }

        .final-label {
            color: #8888aa;
            font-size: 0.9em;
            margin-bottom: 20px;
        }

        .grade {
            font-size: 1.4em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .grade-msg {
            color: #8888aa;
            font-size: 0.9em;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .review-list {
            text-align: left;
            background: #0d0d14;
            border-radius: 12px;
            padding: 16px;
            margin: 16px 0 24px;
            font-size: 0.82em;
            line-height: 1.8;
        }

        .review-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 4px 0;
            border-bottom: 1px solid #1e1e2e;
        }
        .review-item:last-child { border-bottom: none; }

        .review-icon { flex-shrink: 0; width: 18px; }
        .review-icon.ok  { color: #4ade80; }
        .review-icon.bad { color: #f87171; }

        .review-text { color: #9090b0; }
        .review-answer { color: #e8e8f8; font-weight: 600; }

        .btn-replay {
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            color: #fff;
            border: none;
            padding: 14px 36px;
            border-radius: 999px;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            margin-right: 10px;
        }
        .btn-replay:hover { opacity: 0.9; transform: translateY(-1px); }

        .btn-back {
            background: #1e1e2e;
            color: #8888aa;
            border: 1px solid #2a2a3a;
            padding: 14px 24px;
            border-radius: 999px;
            font-size: 0.9em;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }
        .btn-back:hover { background: #252538; }

        /* Disabled state */
        .option-btn:disabled { cursor: default; }

        @media (max-width: 480px) {
            h1 { font-size: 1.5em; }
            .options-grid { grid-template-columns: 1fr; }
            .q-card { padding: 20px; }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">Chloe Reads Jon</div>
    <h1>Jon's AI Model Showdown</h1>
    <p class="subtitle">Jon has strong opinions about ChatGPT, Gemini, Claude, and Amazon Q.<br>Can you match his picks?</p>
</div>

<!-- WELCOME SCREEN -->
<div class="screen active" id="screen-welcome">
    <div class="welcome-card">
        <div class="model-lineup">
            <span class="model-badge badge-chatgpt">ChatGPT</span>
            <span class="model-badge badge-gemini">Gemini</span>
            <span class="model-badge badge-claude">Claude</span>
            <span class="model-badge badge-q">Amazon&nbsp;Q</span>
        </div>
        <p class="welcome-desc">
            Jon blogs obsessively about AI tools — switching between them, comparing them, finding their quirks. 
            In this quiz, you'll see a real-world task and pick which model <em>Jon personally recommends</em> for it, 
            based on his own blog posts.
            <br><br>10 questions. No time limit. Let's see how well you know Jon's AI opinions.
        </p>
        <button class="btn-start" onclick="startGame()">Start Quiz →</button>
    </div>
</div>

<!-- QUESTION SCREEN -->
<div class="screen" id="screen-question">
    <div class="progress-bar-wrap">
        <div class="progress-bar-fill" id="progress-fill" style="width:0%"></div>
    </div>
    <div class="q-meta">
        <span id="q-counter">Question 1 of 10</span>
        <span class="score-badge" id="score-display">Score: 0</span>
    </div>

    <div class="q-card">
        <div class="scenario-label">The Task</div>
        <div class="scenario-text" id="scenario-text"></div>
    </div>

    <div class="options-grid" id="options-grid">
        <!-- populated by JS -->
    </div>

    <div class="reveal-card" id="reveal-card">
        <div class="reveal-result" id="reveal-result"></div>
        <div class="jon-says" id="jon-says"></div>
        <div class="blog-link" id="blog-link"></div>
    </div>

    <button class="btn-next" id="btn-next" style="display:none" onclick="nextQuestion()">Next question →</button>
</div>

<!-- END SCREEN -->
<div class="screen" id="screen-end">
    <div class="end-card">
        <div style="font-size:2.5em; margin-bottom:8px;" id="end-trophy">🏆</div>
        <div class="final-score" id="final-score">0/10</div>
        <div class="final-label">Jon Compatibility Score</div>
        <div class="grade" id="end-grade"></div>
        <div class="grade-msg" id="end-msg"></div>

        <div class="review-list" id="review-list"></div>

        <button class="btn-replay" onclick="startGame()">Play Again</button>
        <a href="index.php" class="btn-back">← Back</a>
    </div>
</div>

<script>
const ALL_QUESTIONS = [
    {
        scenario: "I need to generate a short video clip — something with smooth motion and synced background audio.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 1,
        jonSays: "\"Better video generation (with audio)\" — Gemini has a clear edge here over ChatGPT for video generation with audio.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/06/chatgpt-vs-gemini.html",
        blogTitle: "ChatGPT vs Gemini"
    },
    {
        scenario: "I want to generate a high-quality image with clearly readable text in it — like a poster or lock screen.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 0,
        jonSays: "\"Better image generation than Gemini\" — and after the big March 2025 update, ChatGPT's image generation improved dramatically. Text in images is now legible where it used to be garbled.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/03/example-of-how-much-chatgpt-image.html",
        blogTitle: "ChatGPT image generation improved"
    },
    {
        scenario: "I pasted in a 500-row spreadsheet of product data and need a complete, dense comparison table — nothing missing.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 1,
        jonSays: "\"Handles large amounts of spreadsheet-type data pasted in — ChatGPT misses a lot.\" Jon actually switched from ChatGPT to Gemini precisely because of this failure.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/05/chatgpt-plus-vs-gemini-pro-claude-code.html",
        blogTitle: "ChatGPT Plus vs Gemini Pro"
    },
    {
        scenario: "I want an AI voice chat that feels genuinely warm and conversational — not stiff or businesslike.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 2,
        jonSays: "\"Audio chat is more personable than Gemini, less stiff/businesslike/terse\" — Claude (and ChatGPT) beat Gemini here. Claude also lets you customize voice chat with instructions in a Claude Project.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/06/chatgpt-vs-gemini.html",
        blogTitle: "ChatGPT vs Gemini"
    },
    {
        scenario: "I want to snap a photo of a concert poster and have it automatically added to my Google Calendar.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 1,
        jonSays: "\"Can add an event to Google Calendar via screenshot or picture\" — Gemini's deep integration with Google services makes this a natural fit.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/06/chatgpt-vs-gemini.html",
        blogTitle: "ChatGPT vs Gemini"
    },
    {
        scenario: "I want rich, meaty spiritual direction advice drawing on the wisdom of the saints and Catholic tradition.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 1,
        jonSays: "\"The Gems feature is really good, especially one in which I asked it to be 'a Catholic spiritual director.' The advice was a lot meatier than when I tried the same in Claude.\"",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/06/chatgpt-vs-gemini.html",
        blogTitle: "ChatGPT vs Gemini"
    },
    {
        scenario: "I code every day and want an AI coding assistant, but I'm worried about runaway costs.",
        options: ["ChatGPT", "Gemini", "Claude Code", "Amazon Q"],
        correct: 3,
        jonSays: "\"Amazon Q is capped at $20/month, while Claude Code will keep spending your money without limit — I was spending $5–$10/day.\" Amazon Q became Jon's daily driver for exactly this reason.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/05/chatgpt-plus-vs-gemini-pro-claude-code.html",
        blogTitle: "ChatGPT Plus vs Gemini Pro, Claude Code vs Amazon Q"
    },
    {
        scenario: "I want one command that creates a branch, commits, pushes, opens a PR with a good description, and pastes a Slack link.",
        options: ["ChatGPT", "Gemini", "Claude Code", "Amazon Q"],
        correct: 2,
        jonSays: "\"I like how Claude Code lets me do 'create a branch, commit, push, make a PR' and it takes care of everything, including coming up with good commit and PR descriptions.\" This was a big reason Jon loved Claude Code.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/03/liking-claude-code-better-than-cursor.html",
        blogTitle: "Liking Claude Code better than Cursor"
    },
    {
        scenario: "I'm at work and need to search our Confluence wiki for runbooks while on call.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 2,
        jonSays: "\"Integrations feature lets me query Atlassian Confluence\" — Claude's Integrations feature is what Jon specifically calls out for connecting to Confluence.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/06/chatgpt-vs-gemini.html",
        blogTitle: "ChatGPT vs Gemini"
    },
    {
        scenario: "I want to know if I need to water my lawn this week based on actual rainfall sensor data.",
        options: ["ChatGPT", "Gemini", "Claude", "Amazon Q"],
        correct: 3,
        jonSays: "Jon used Amazon Q with this exact prompt: curl the FlowWorks site to figure out how much it rained in Surrey in the past week. Amazon Q handles the shell command and interprets the result seamlessly.",
        blogUrl: "https://jon-aquino-mental-garden.blogspot.com/2025/08/things-i-love-using-my-command-line-ai.html",
        blogTitle: "Things I love using my command-line AI tool for"
    }
];

const MODEL_META = {
    "ChatGPT":   { icon: "🟢", tagline: "OpenAI's flagship",   cls: "option-chatgpt" },
    "Gemini":    { icon: "🔵", tagline: "Google's AI",         cls: "option-gemini"  },
    "Claude":    { icon: "🟠", tagline: "Anthropic's model",   cls: "option-claude"  },
    "Claude Code":{ icon: "🟠", tagline: "Anthropic CLI",     cls: "option-claude"  },
    "Amazon Q":  { icon: "🟡", tagline: "AWS developer AI",   cls: "option-q"       },
};

let questions = [];
let current = 0;
let score = 0;
let answered = false;
let history = [];

function shuffle(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
}

function startGame() {
    questions = shuffle([...ALL_QUESTIONS]).slice(0, 10);
    current = 0;
    score = 0;
    answered = false;
    history = [];

    showScreen('screen-question');
    renderQuestion();
}

function showScreen(id) {
    document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}

function renderQuestion() {
    const q = questions[current];
    answered = false;

    // Progress
    const pct = (current / questions.length) * 100;
    document.getElementById('progress-fill').style.width = pct + '%';
    document.getElementById('q-counter').textContent = `Question ${current + 1} of ${questions.length}`;
    document.getElementById('score-display').textContent = `Score: ${score}`;

    // Scenario
    document.getElementById('scenario-text').textContent = q.scenario;

    // Options
    const grid = document.getElementById('options-grid');
    grid.innerHTML = '';
    q.options.forEach((opt, i) => {
        const meta = MODEL_META[opt] || { icon: "🤖", tagline: "AI model", cls: "option-claude" };
        const btn = document.createElement('button');
        btn.className = `option-btn ${meta.cls}`;
        btn.innerHTML = `
            <span class="option-icon">${meta.icon}</span>
            <span class="option-name">${opt}</span>
            <span class="option-tagline">${meta.tagline}</span>
        `;
        btn.onclick = () => selectAnswer(i);
        grid.appendChild(btn);
    });

    // Reveal card
    const rc = document.getElementById('reveal-card');
    rc.style.display = 'none';

    // Next button
    document.getElementById('btn-next').style.display = 'none';
}

function selectAnswer(idx) {
    if (answered) return;
    answered = true;

    const q = questions[current];
    const correct = (idx === q.correct);
    if (correct) score++;

    const buttons = document.querySelectorAll('.option-btn');
    buttons.forEach((btn, i) => {
        btn.disabled = true;
        if (i === q.correct) btn.classList.add('correct');
        else if (i === idx && !correct) btn.classList.add('wrong');
    });

    // Record
    history.push({
        scenario: q.scenario,
        correctAnswer: q.options[q.correct],
        chosen: q.options[idx],
        correct: correct
    });

    // Reveal
    const rc = document.getElementById('reveal-card');
    rc.style.display = 'block';

    const rr = document.getElementById('reveal-result');
    if (correct) {
        rr.className = 'reveal-result correct-result';
        rr.textContent = '✓ Correct! Jon agrees.';
    } else {
        rr.className = 'reveal-result wrong-result';
        rr.textContent = `✗ Nope — Jon picks ${q.options[q.correct]}.`;
    }

    document.getElementById('jon-says').textContent = q.jonSays;
    document.getElementById('blog-link').innerHTML = `📝 From Jon's blog: <a href="${q.blogUrl}" target="_blank">${q.blogTitle}</a>`;

    const nextBtn = document.getElementById('btn-next');
    nextBtn.style.display = 'block';
    if (current + 1 >= questions.length) {
        nextBtn.textContent = 'See results →';
    } else {
        nextBtn.textContent = 'Next question →';
    }
}

function nextQuestion() {
    current++;
    if (current >= questions.length) {
        showEndScreen();
    } else {
        renderQuestion();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

function showEndScreen() {
    showScreen('screen-end');

    document.getElementById('final-score').textContent = `${score}/${questions.length}`;

    let trophy = '🤖', grade = '', msg = '';
    const pct = score / questions.length;

    if (pct === 1.0) {
        trophy = '🏆'; grade = 'Jon\'s AI Twin';
        msg = 'Perfect score — you know Jon\'s AI opinions better than he does. You\'ve clearly read every blog post twice.';
    } else if (pct >= 0.8) {
        trophy = '🥇'; grade = 'Power User';
        msg = 'Excellent! You clearly follow Jon\'s AI experiments closely. A few edge cases tripped you up, but overall you\'ve got his preferences nailed.';
    } else if (pct >= 0.6) {
        trophy = '🥈'; grade = 'Casual Reader';
        msg = 'Not bad! You know the broad strokes of Jon\'s AI opinions but missed a few of his more surprising picks.';
    } else if (pct >= 0.4) {
        trophy = '🥉'; grade = 'Lurker';
        msg = 'Hmm. You\'ve skimmed Jon\'s blog but the details escaped you. Time to read a few more posts!';
    } else {
        trophy = '💻'; grade = 'First Timer';
        msg = 'This is your first time reading Jon\'s AI comparison posts, isn\'t it? No worries — now you know where he stands on each tool.';
    }

    document.getElementById('end-trophy').textContent = trophy;
    document.getElementById('end-grade').textContent = grade;
    document.getElementById('end-msg').textContent = msg;

    const list = document.getElementById('review-list');
    list.innerHTML = '<div style="font-size:0.75em;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin-bottom:10px;">Question Review</div>';
    history.forEach((h, i) => {
        const item = document.createElement('div');
        item.className = 'review-item';
        item.innerHTML = `
            <span class="review-icon ${h.correct ? 'ok' : 'bad'}">${h.correct ? '✓' : '✗'}</span>
            <span class="review-text">
                <em>${truncate(h.scenario, 55)}</em><br>
                ${h.correct ? '' : `<span style="color:#888">Your pick: ${h.chosen} → </span>`}
                <span class="review-answer">${h.correctAnswer}</span>
            </span>
        `;
        list.appendChild(item);
    });
}

function truncate(str, n) {
    return str.length > n ? str.slice(0, n) + '…' : str;
}
</script>

</body>
</html>
