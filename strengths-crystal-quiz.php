<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strengths Crystal Cave</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;900&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #080b16;
            --surface: #0e1425;
            --border: rgba(255,255,255,0.08);
            --text: #dde3f0;
            --muted: #7888a8;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Lora', Georgia, serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Cave background ─────────────────────────────── */
        #cave-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 50% at 50% 100%, #0d1a3a 0%, transparent 70%),
                radial-gradient(ellipse 60% 40% at 20% 0%, #12083a 0%, transparent 60%),
                radial-gradient(ellipse 40% 30% at 80% 10%, #0a1f30 0%, transparent 50%),
                var(--bg);
            pointer-events: none;
        }

        /* Floating crystal particles */
        .particle {
            position: fixed;
            border-radius: 2px;
            opacity: 0;
            animation: drift linear infinite;
            pointer-events: none;
            z-index: 0;
        }
        @keyframes drift {
            0%   { transform: translateY(110vh) rotate(0deg);   opacity: 0; }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.3; }
            100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
        }

        /* ── Layout ──────────────────────────────────────── */
        #app {
            position: relative;
            z-index: 1;
            max-width: 680px;
            margin: 0 auto;
            padding: 40px 20px 80px;
        }

        /* ── Header ─────────────────────────────────────── */
        header {
            text-align: center;
            margin-bottom: 48px;
        }
        .gem-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 12px;
            filter: drop-shadow(0 0 16px rgba(100,180,255,0.6));
            animation: pulse-glow 3s ease-in-out infinite;
        }
        @keyframes pulse-glow {
            0%, 100% { filter: drop-shadow(0 0 12px rgba(100,180,255,0.5)); }
            50%       { filter: drop-shadow(0 0 28px rgba(160,220,255,0.9)); }
        }
        h1 {
            font-family: 'Cinzel', serif;
            font-size: clamp(1.6rem, 5vw, 2.4rem);
            font-weight: 900;
            letter-spacing: 0.05em;
            background: linear-gradient(135deg, #a8d4ff, #e0b8ff, #98f5e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }
        .tagline {
            color: var(--muted);
            font-size: 0.95rem;
            font-style: italic;
            line-height: 1.6;
        }

        /* ── Progress bar ────────────────────────────────── */
        #progress-wrap {
            margin-bottom: 36px;
        }
        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.78rem;
            color: var(--muted);
            margin-bottom: 8px;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.08em;
        }
        .progress-bar {
            height: 4px;
            background: rgba(255,255,255,0.07);
            border-radius: 2px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            border-radius: 2px;
            background: linear-gradient(90deg, #4fc3f7, #ce93d8, #80cbc4);
            transition: width 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* ── Question card ───────────────────────────────── */
        #question-section {
            transition: opacity 0.35s ease, transform 0.35s ease;
        }
        #question-section.fade-out {
            opacity: 0;
            transform: translateY(-16px);
        }
        .q-number {
            font-family: 'Cinzel', serif;
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .q-text {
            font-size: clamp(1.1rem, 3vw, 1.35rem);
            line-height: 1.65;
            color: var(--text);
            margin-bottom: 36px;
            font-style: italic;
            min-height: 80px;
        }
        .q-text em {
            color: #c8e6ff;
            font-style: normal;
            font-weight: 600;
        }

        /* Rating crystals */
        .rating-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.72rem;
            color: var(--muted);
            margin-bottom: 12px;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.05em;
        }
        .crystal-row {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .crystal-btn {
            flex: 1;
            min-width: 56px;
            max-width: 110px;
            padding: 16px 8px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            background: rgba(255,255,255,0.03);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            font-size: 0.72rem;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.05em;
        }
        .crystal-btn .gem-shape {
            font-size: 1.4rem;
            transition: transform 0.2s ease, filter 0.2s ease;
        }
        .crystal-btn:hover {
            background: rgba(255,255,255,0.07);
            border-color: rgba(255,255,255,0.25);
            color: var(--text);
            transform: translateY(-2px);
        }
        .crystal-btn:hover .gem-shape {
            transform: scale(1.2);
            filter: drop-shadow(0 0 8px currentColor);
        }
        .crystal-btn.selected {
            border-color: var(--sel-color, #80cbc4);
            background: rgba(128, 203, 196, 0.12);
            color: var(--text);
            box-shadow: 0 0 20px rgba(128,203,196,0.2);
        }
        .crystal-btn.selected .gem-shape {
            filter: drop-shadow(0 0 10px var(--sel-color, #80cbc4));
            transform: scale(1.15);
        }

        /* ── Results ─────────────────────────────────────── */
        #results-section {
            display: none;
        }
        .results-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .results-header h2 {
            font-family: 'Cinzel', serif;
            font-size: clamp(1.3rem, 4vw, 1.8rem);
            font-weight: 900;
            background: linear-gradient(135deg, #a8d4ff, #e0b8ff, #98f5e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }
        .results-sub {
            color: var(--muted);
            font-style: italic;
            font-size: 0.9rem;
        }

        .strength-card {
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 16px;
            background: rgba(255,255,255,0.03);
            display: flex;
            gap: 20px;
            align-items: flex-start;
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }
        .strength-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .strength-card:hover::before { opacity: 1; }
        .strength-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .strength-card.rank-1 { border-color: rgba(255, 215, 0, 0.3); }
        .strength-card.rank-1::before {
            background: radial-gradient(ellipse at top left, rgba(255,215,0,0.05) 0%, transparent 60%);
        }

        .gem-badge {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .card-body { flex: 1; min-width: 0; }
        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }
        .card-rank {
            font-family: 'Cinzel', serif;
            font-size: 0.68rem;
            letter-spacing: 0.12em;
            color: var(--muted);
        }
        .card-title {
            font-family: 'Cinzel', serif;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .jon-badge {
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 20px;
            background: rgba(255,215,0,0.15);
            border: 1px solid rgba(255,215,0,0.3);
            color: #ffd700;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.05em;
            white-space: nowrap;
        }
        .card-desc {
            color: #b0bcd8;
            font-size: 0.88rem;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .card-bar {
            height: 3px;
            background: rgba(255,255,255,0.06);
            border-radius: 2px;
            overflow: hidden;
        }
        .card-bar-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Jon's full top-3 callout */
        .jon-note {
            margin-top: 36px;
            padding: 20px 24px;
            border-radius: 14px;
            background: rgba(255,215,0,0.05);
            border: 1px solid rgba(255,215,0,0.2);
            font-size: 0.88rem;
            line-height: 1.65;
            color: #c8d8f0;
        }
        .jon-note strong {
            color: #ffd700;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.05em;
        }
        .jon-note a {
            color: #80c8ff;
            text-decoration: none;
        }
        .jon-note a:hover { text-decoration: underline; }

        /* Retry button */
        .retry-btn {
            display: block;
            margin: 32px auto 0;
            padding: 14px 36px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            background: transparent;
            color: var(--muted);
            font-family: 'Cinzel', serif;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .retry-btn:hover {
            border-color: rgba(255,255,255,0.3);
            color: var(--text);
            background: rgba(255,255,255,0.05);
        }

        /* Intro screen */
        #intro-section {
            text-align: center;
        }
        .intro-gems {
            font-size: 2.5rem;
            margin: 28px 0 20px;
            letter-spacing: 6px;
            animation: shimmer 4s ease-in-out infinite;
        }
        @keyframes shimmer {
            0%, 100% { opacity: 0.8; }
            50%       { opacity: 1; }
        }
        .intro-text {
            color: #b0bcd8;
            font-size: 0.95rem;
            line-height: 1.75;
            margin-bottom: 32px;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }
        .start-btn {
            display: inline-block;
            padding: 16px 48px;
            border-radius: 10px;
            background: linear-gradient(135deg, rgba(100,180,255,0.15), rgba(180,100,255,0.15));
            border: 1px solid rgba(150,200,255,0.3);
            color: #c8e6ff;
            font-family: 'Cinzel', serif;
            font-size: 0.9rem;
            letter-spacing: 0.12em;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 30px rgba(100,180,255,0.1);
        }
        .start-btn:hover {
            background: linear-gradient(135deg, rgba(100,180,255,0.25), rgba(180,100,255,0.25));
            border-color: rgba(150,200,255,0.5);
            box-shadow: 0 0 40px rgba(100,180,255,0.2);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 420px) {
            .crystal-btn { min-width: 44px; padding: 12px 4px; font-size: 0.65rem; }
            .crystal-btn .gem-shape { font-size: 1.2rem; }
        }
    </style>
</head>
<body>

<div id="cave-bg"></div>

<div id="app">
    <header>
        <span class="gem-icon">💎</span>
        <h1>Strengths Crystal Cave</h1>
        <p class="tagline">Discover the gems buried in your character</p>
    </header>

    <!-- INTRO -->
    <div id="intro-section">
        <div class="intro-gems">🔮 💜 💙 💚 🧡</div>
        <p class="intro-text">
            Deep inside every person are five brilliant gems — your signature strengths.
            Answer 12 questions about what feels most true of you, and the cave will
            reveal which crystals glow brightest in your soul.
            <br><br>
            Based on the <strong style="color:#c8e6ff">StrengthsFinder</strong> framework by Gallup —
            the same test Jon took and wrote about back in 2008, discovering that
            <em style="color:#ffd700">Harmony</em>, <em style="color:#ffd700">Consistency</em>,
            and <em style="color:#ffd700">Maximizer</em> were three of his top five gems.
        </p>
        <button class="start-btn" onclick="startQuiz()">ENTER THE CAVE</button>
    </div>

    <!-- QUIZ -->
    <div id="quiz-section" style="display:none">
        <div id="progress-wrap">
            <div class="progress-label">
                <span id="prog-text">QUESTION 1 OF 12</span>
                <span id="prog-pct">0%</span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="prog-fill" style="width:0%"></div>
            </div>
        </div>

        <div id="question-section">
            <div class="q-number" id="q-number">QUESTION 1</div>
            <div class="q-text" id="q-text"></div>
            <div class="rating-label">
                <span>Not me at all</span>
                <span>Absolutely me</span>
            </div>
            <div class="crystal-row" id="crystal-row"></div>
        </div>
    </div>

    <!-- RESULTS -->
    <div id="results-section">
        <div class="results-header">
            <span class="gem-icon">✨</span>
            <h2>Your Strength Crystals</h2>
            <p class="results-sub">Your five brightest gems, in order of radiance</p>
        </div>
        <div id="cards-container"></div>
        <div class="jon-note">
            <strong>⚜ Jon's Crystal Cave</strong><br>
            In 2008, Jon took the real StrengthsFinder test and shared three of his top five:
            <em style="color:#ffd700">Harmony</em> (he'd rather build bridges than win arguments),
            <em style="color:#ffd700">Consistency</em> (everyone deserves fair treatment — no exceptions),
            and <em style="color:#ffd700">Maximizer</em> (he can't resist taking something good and making it exceptional).
            He reflected: "When you interact with me, you can expect our conversation to be pleasant and productive."
            <br><br>
            Read <a href="https://jona.ca/2008/08/strengthsfinder-personality-test-20.html" target="_blank">his original post</a> →
        </div>
        <button class="retry-btn" onclick="resetQuiz()">↺ EXPLORE AGAIN</button>
    </div>
</div>

<script>
// ── Data ──────────────────────────────────────────────────────────────────

const THEMES = [
    {
        key: 'harmony',
        name: 'Harmony',
        gem: '🩵',
        color: '#4fc3f7',
        bg: 'rgba(79,195,247,0.12)',
        jonTop: true,
        desc: 'You seek consensus, dislike conflict, and create calm wherever you go. You\'re gifted at finding common ground that everyone can stand on.',
        statement: 'I\'d far rather <em>find common ground</em> than win an argument — conflict drains me, and I\'m happiest when everyone leaves the table feeling heard.'
    },
    {
        key: 'consistency',
        name: 'Consistency',
        gem: '💛',
        color: '#ffd54f',
        bg: 'rgba(255,213,79,0.10)',
        jonTop: true,
        desc: 'You believe in treating everyone with equal dignity, no exceptions. Rules and routines give you (and the world) a trustworthy foundation.',
        statement: 'I believe deeply in <em>fair, equal treatment</em> for everyone — I notice and am bothered by favouritism, double standards, and special exceptions.'
    },
    {
        key: 'maximizer',
        name: 'Maximizer',
        gem: '💚',
        color: '#66bb6a',
        bg: 'rgba(102,187,106,0.10)',
        jonTop: true,
        desc: 'Good is never enough — you see potential and can\'t resist turning it into something great. You\'re drawn to strengths, not weaknesses.',
        statement: 'I\'m restless around mediocrity — when I see something <em>good, I immediately want to make it great</em>, and shoddy work genuinely bothers me.'
    },
    {
        key: 'achiever',
        name: 'Achiever',
        gem: '❤️',
        color: '#ef5350',
        bg: 'rgba(239,83,80,0.10)',
        jonTop: false,
        desc: 'You have a relentless drive to get things done. Rest feels uneasy unless you\'ve accomplished something today — your engine never fully stops.',
        statement: 'I have a <em>relentless inner drive</em> to accomplish things — I feel vaguely guilty resting unless I\'ve gotten something meaningful done today.'
    },
    {
        key: 'analytical',
        name: 'Analytical',
        gem: '💙',
        color: '#42a5f5',
        bg: 'rgba(66,165,245,0.10)',
        jonTop: false,
        desc: 'You need evidence. You ask "why?" and dig until you find the real answer. Data, logic, and patterns are your natural language.',
        statement: 'Before I trust a claim, I need <em>evidence and logic</em> — I instinctively break complex problems into their parts and question assumptions.'
    },
    {
        key: 'empathy',
        name: 'Empathy',
        gem: '🩷',
        color: '#f48fb1',
        bg: 'rgba(244,143,177,0.10)',
        jonTop: false,
        desc: 'You sense what others feel before they say a word. Their joy lifts you and their pain weighs on you — emotional resonance is your superpower.',
        statement: 'I can <em>sense how someone is feeling</em> before they say anything — their emotions touch me directly, like a tuning fork resonating with theirs.'
    },
    {
        key: 'learner',
        name: 'Learner',
        gem: '💜',
        color: '#ab47bc',
        bg: 'rgba(171,71,188,0.10)',
        jonTop: false,
        desc: 'The process of learning thrills you as much as the knowledge itself. You\'re energised by picking up new skills, even ones you\'ll rarely use.',
        statement: 'I love <em>learning for its own sake</em> — the process of getting better at something, even something I might never "need", genuinely excites me.'
    },
    {
        key: 'strategic',
        name: 'Strategic',
        gem: '🔵',
        color: '#29b6f6',
        bg: 'rgba(41,182,246,0.10)',
        jonTop: false,
        desc: 'You quickly see paths, patterns, and possibilities where others see complexity. You sort through the noise and find the best route forward.',
        statement: 'When faced with a challenge I quickly see <em>multiple paths forward</em> and instinctively find the one that skips the dead ends.'
    },
    {
        key: 'connectedness',
        name: 'Connectedness',
        gem: '⚪',
        color: '#b0bec5',
        bg: 'rgba(176,190,197,0.10)',
        jonTop: false,
        desc: 'You believe things happen for a reason. You find meaning in how all things are linked — people, events, faith, and the fabric of life itself.',
        statement: 'I\'m drawn to the <em>deeper meaning behind events</em> — I believe things are connected, that what happens has purpose, even when it\'s hard to see.'
    },
    {
        key: 'ideation',
        name: 'Ideation',
        gem: '🟣',
        color: '#ce93d8',
        bg: 'rgba(206,147,216,0.10)',
        jonTop: false,
        desc: 'Ideas energise you. You love finding surprising connections between distant concepts and brainstorming could genuinely be a hobby for you.',
        statement: 'New ideas genuinely <em>energise me</em> — I love connecting concepts from different worlds and could happily brainstorm without a practical goal in sight.'
    },
    {
        key: 'input',
        name: 'Input',
        gem: '🟠',
        color: '#ffa726',
        bg: 'rgba(255,167,38,0.10)',
        jonTop: false,
        desc: 'You collect — information, tools, facts, resources. You archive interesting things because you never know when they\'ll be exactly what someone needs.',
        statement: 'I love <em>collecting and archiving</em> things — articles, tools, facts, links — because you never know when the right piece of information will be just what someone needs.'
    },
    {
        key: 'relator',
        name: 'Relator',
        gem: '🔴',
        color: '#ef9a9a',
        bg: 'rgba(239,154,154,0.10)',
        jonTop: false,
        desc: 'A few deep friendships beat a hundred acquaintances. You\'re energised by authentic, mutual understanding — knowing and being known.',
        statement: 'I prefer <em>a few deep, authentic friendships</em> over many surface acquaintances — being truly known by someone matters far more to me than being broadly liked.'
    }
];

const RATINGS = [
    { label: 'Not me', icon: '🔸' },
    { label: 'A little', icon: '🔷' },
    { label: 'Somewhat', icon: '💎' },
    { label: 'Very me', icon: '✨' },
    { label: 'Absolutely', icon: '⭐' }
];

// ── State ─────────────────────────────────────────────────────────────────
let scores = {};
let currentQ = 0;
const shuffledThemes = [...THEMES].sort(() => Math.random() - 0.5);

// ── Particles ─────────────────────────────────────────────────────────────
function spawnParticles() {
    const colors = ['#4fc3f7','#ce93d8','#80cbc4','#ffd54f','#ef9a9a','#a5d6a7'];
    for (let i = 0; i < 22; i++) {
        const p = document.createElement('div');
        p.className = 'particle';
        const size = Math.random() * 6 + 2;
        p.style.cssText = `
            width:${size}px; height:${size}px;
            left:${Math.random()*100}vw;
            background:${colors[Math.floor(Math.random()*colors.length)]};
            animation-duration:${8+Math.random()*18}s;
            animation-delay:${Math.random()*20}s;
            opacity:0;
            transform:rotate(${Math.random()*360}deg);
        `;
        document.body.appendChild(p);
    }
}
spawnParticles();

// ── Quiz logic ─────────────────────────────────────────────────────────────
function startQuiz() {
    document.getElementById('intro-section').style.display = 'none';
    document.getElementById('quiz-section').style.display = 'block';
    scores = {};
    currentQ = 0;
    shuffledThemes.sort(() => Math.random() - 0.5);
    renderQuestion();
}

function renderQuestion() {
    const theme = shuffledThemes[currentQ];
    const total = shuffledThemes.length;

    // Progress
    const pct = Math.round((currentQ / total) * 100);
    document.getElementById('prog-text').textContent = `QUESTION ${currentQ+1} OF ${total}`;
    document.getElementById('prog-pct').textContent = `${pct}%`;
    document.getElementById('prog-fill').style.width = pct + '%';

    document.getElementById('q-number').textContent = `QUESTION ${currentQ+1}`;
    document.getElementById('q-text').innerHTML = theme.statement;

    const row = document.getElementById('crystal-row');
    row.innerHTML = '';
    RATINGS.forEach((r, idx) => {
        const btn = document.createElement('button');
        btn.className = 'crystal-btn';
        btn.style.setProperty('--sel-color', theme.color);
        btn.innerHTML = `<span class="gem-shape">${r.icon}</span><span>${r.label}</span>`;
        btn.addEventListener('click', () => selectRating(idx + 1, theme.key));
        row.appendChild(btn);
    });

    // Restore selection if navigating back
    if (scores[theme.key] !== undefined) {
        markSelected(scores[theme.key] - 1);
    }
}

function selectRating(val, key) {
    scores[key] = val;
    markSelected(val - 1);

    // Advance after brief pause
    setTimeout(() => {
        if (currentQ < shuffledThemes.length - 1) {
            const section = document.getElementById('question-section');
            section.classList.add('fade-out');
            setTimeout(() => {
                currentQ++;
                section.classList.remove('fade-out');
                renderQuestion();
            }, 320);
        } else {
            showResults();
        }
    }, 400);
}

function markSelected(idx) {
    const btns = document.querySelectorAll('.crystal-btn');
    btns.forEach((b, i) => {
        b.classList.toggle('selected', i === idx);
    });
}

// ── Results ────────────────────────────────────────────────────────────────
function showResults() {
    document.getElementById('quiz-section').style.display = 'none';
    const resultsEl = document.getElementById('results-section');
    resultsEl.style.display = 'block';

    // Sort themes by score descending
    const ranked = THEMES.map(t => ({
        ...t,
        score: scores[t.key] || 0
    })).sort((a, b) => b.score - a.score);

    const top5 = ranked.slice(0, 5);
    const maxScore = top5[0].score;

    const container = document.getElementById('cards-container');
    container.innerHTML = '';

    top5.forEach((theme, i) => {
        const card = document.createElement('div');
        card.className = `strength-card ${i === 0 ? 'rank-1' : ''}`;
        card.innerHTML = `
            <div class="gem-badge" style="background:${theme.bg}; color:${theme.color}">
                ${theme.gem}
            </div>
            <div class="card-body">
                <div class="card-header">
                    <span class="card-rank">#${i+1}</span>
                    <span class="card-title" style="color:${theme.color}">${theme.name}</span>
                    ${theme.jonTop ? '<span class="jon-badge">⚜ Jon\'s gem</span>' : ''}
                </div>
                <p class="card-desc">${theme.desc}</p>
                <div class="card-bar">
                    <div class="card-bar-fill" style="background:${theme.color}; width:0%" data-width="${Math.round((theme.score/5)*100)}%"></div>
                </div>
            </div>
        `;
        container.appendChild(card);

        // Staggered reveal
        setTimeout(() => {
            card.classList.add('visible');
            setTimeout(() => {
                const fill = card.querySelector('.card-bar-fill');
                fill.style.width = fill.dataset.width;
            }, 200);
        }, i * 150 + 100);
    });
}

function resetQuiz() {
    document.getElementById('results-section').style.display = 'none';
    document.getElementById('intro-section').style.display = 'block';
    scores = {};
    currentQ = 0;
}
</script>
</body>
</html>
