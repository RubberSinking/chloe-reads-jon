<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hogwarts House Sorting</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Text:ital,wght@0,400;0,600;1,400&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --parchment: #f4e8c1;
            --parchment-dark: #e8d5a3;
            --ink: #2c1a0e;
            --ink-light: #5c3d2e;
            --red: #740001;
            --blue: #0d1a40;
            --green: #1a472a;
            --gold: #ae8f2f;
            --gold-light: #d4af37;
            --shadow: rgba(44, 26, 14, 0.25);
        }

        body {
            background: #1a0f0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Crimson Text', Georgia, serif;
            color: var(--ink);
            overflow-x: hidden;
        }

        /* Floating candles */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: 
                radial-gradient(ellipse at 15% 20%, rgba(180,140,60,0.08) 0%, transparent 40%),
                radial-gradient(ellipse at 85% 15%, rgba(180,140,60,0.06) 0%, transparent 35%),
                radial-gradient(ellipse at 50% 5%, rgba(180,140,60,0.04) 0%, transparent 30%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 680px;
            padding: 20px;
        }

        .scroll {
            background: var(--parchment);
            border-radius: 4px;
            box-shadow: 
                0 0 0 3px var(--gold),
                0 0 0 6px var(--ink),
                0 0 0 9px var(--gold),
                0 20px 80px rgba(0,0,0,0.8),
                inset 0 0 60px rgba(139,90,43,0.15);
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        /* Aged paper texture */
        .scroll::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Decorative corners */
        .scroll::after {
            content: '❧';
            position: absolute;
            top: 12px;
            left: 18px;
            font-size: 22px;
            color: var(--gold);
            opacity: 0.6;
        }

        .corner-br {
            position: absolute;
            bottom: 12px;
            right: 18px;
            font-size: 22px;
            color: var(--gold);
            opacity: 0.6;
        }

        .corner-bl {
            position: absolute;
            bottom: 12px;
            left: 18px;
            font-size: 22px;
            color: var(--gold);
            opacity: 0.6;
        }

        .header {
            text-align: center;
            margin-bottom: 36px;
            position: relative;
        }

        .header h1 {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 2.4em;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: 0.04em;
            line-height: 1.1;
            margin-bottom: 8px;
        }

        .header .subtitle {
            font-style: italic;
            color: var(--ink-light);
            font-size: 1.05em;
            letter-spacing: 0.05em;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: var(--gold);
            opacity: 0.5;
            font-size: 1.2em;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
        }

        /* Hat */
        .hat-container {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
            position: relative;
        }

        .hat-svg {
            width: 120px;
            height: 120px;
            filter: drop-shadow(0 4px 12px var(--shadow));
            transition: transform 0.3s ease;
        }

        .hat-svg.shake {
            animation: hatShake 1.2s ease-in-out;
        }

        @keyframes hatShake {
            0%, 100% { transform: rotate(0deg); }
            10% { transform: rotate(-8deg); }
            20% { transform: rotate(7deg); }
            30% { transform: rotate(-6deg); }
            40% { transform: rotate(5deg); }
            50% { transform: rotate(-4deg); }
            60% { transform: rotate(3deg); }
            70% { transform: rotate(-2deg); }
            80% { transform: rotate(1deg); }
            90% { transform: rotate(-0.5deg); }
        }

        /* Question screen */
        .question-screen {
            display: none;
        }

        .question-screen.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .question-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.85em;
            color: var(--ink-light);
            text-align: center;
            margin-bottom: 6px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .question-text {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.25em;
            font-weight: 600;
            color: var(--ink);
            text-align: center;
            margin-bottom: 28px;
            line-height: 1.4;
            font-style: italic;
        }

        .choices {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .choice-btn {
            background: transparent;
            border: 2px solid var(--ink);
            border-radius: 3px;
            padding: 14px 18px;
            font-family: 'Crimson Text', Georgia, serif;
            font-size: 1.05em;
            color: var(--ink);
            cursor: pointer;
            text-align: left;
            transition: all 0.2s ease;
            position: relative;
            background: rgba(255,255,255,0.3);
        }

        .choice-btn:hover {
            background: var(--ink);
            color: var(--parchment);
            transform: translateX(4px);
            box-shadow: 3px 3px 0 var(--shadow);
        }

        .choice-btn:active {
            transform: translateX(4px) scale(0.98);
        }

        .choice-btn .choice-letter {
            font-weight: 700;
            margin-right: 8px;
            font-family: 'Cormorant Garamond', serif;
        }

        /* Start screen */
        .start-screen {
            text-align: center;
        }

        .start-screen p {
            font-size: 1.1em;
            line-height: 1.65;
            color: var(--ink);
            margin-bottom: 20px;
        }

        .start-btn {
            background: var(--ink);
            color: var(--parchment);
            border: none;
            padding: 16px 40px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2em;
            font-weight: 700;
            letter-spacing: 0.08em;
            cursor: pointer;
            border-radius: 3px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 16px var(--shadow);
        }

        .start-btn:hover {
            background: var(--ink-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px var(--shadow);
        }

        /* Result screen */
        .result-screen {
            display: none;
            text-align: center;
        }

        .result-screen.active {
            display: block;
            animation: fadeIn 0.8s ease;
        }

        .house-badge {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            animation: badgeReveal 1s ease 0.3s both;
        }

        @keyframes badgeReveal {
            from { opacity: 0; transform: scale(0.3) rotate(-20deg); }
            to { opacity: 1; transform: scale(1) rotate(0deg); }
        }

        .house-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2em;
            font-weight: 700;
            letter-spacing: 0.1em;
            margin-bottom: 4px;
            animation: fadeIn 0.6s ease 0.5s both;
        }

        .house-name.gryffindor { color: var(--red); }
        .house-name.slytherin { color: #1a472a; }
        .house-name.ravenclaw { color: var(--blue); }
        .house-name.hufflepuff { color: #7d5a3c; }

        .house-motto {
            font-style: italic;
            color: var(--ink-light);
            font-size: 1em;
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease 0.7s both;
        }

        .house-desc {
            font-size: 1.05em;
            line-height: 1.7;
            color: var(--ink);
            margin-bottom: 28px;
            animation: fadeIn 0.6s ease 0.9s both;
        }

        .score-bar {
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease 1.1s both;
        }

        .score-bar-label {
            font-size: 0.8em;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-light);
            margin-bottom: 10px;
        }

        .house-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
            font-size: 0.9em;
        }

        .house-bar-name {
            width: 90px;
            text-align: left;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
        }

        .house-bar-track {
            flex: 1;
            height: 8px;
            background: rgba(0,0,0,0.1);
            border-radius: 4px;
            overflow: hidden;
        }

        .house-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .house-bar-fill.gryffindor { background: var(--red); }
        .house-bar-fill.slytherin { background: var(--green); }
        .house-bar-fill.ravenclaw { background: var(--blue); }
        .house-bar-fill.hufflepuff { background: #7d5a3c; }

        .house-bar-pct {
            width: 38px;
            text-align: right;
            font-size: 0.8em;
            color: var(--ink-light);
        }

        .house-facts {
            background: rgba(0,0,0,0.05);
            border-radius: 4px;
            padding: 16px 20px;
            text-align: left;
            margin-bottom: 24px;
        }

        .house-facts h3 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.85em;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-light);
            margin-bottom: 8px;
        }

        .house-facts p {
            font-size: 0.95em;
            line-height: 1.6;
            color: var(--ink);
        }

        .house-creed {
            font-style: italic;
            color: var(--ink);
            font-size: 1em;
            margin-bottom: 24px;
            line-height: 1.6;
            padding: 12px 16px;
            border-left: 3px solid var(--gold);
            background: rgba(174,143,47,0.08);
            text-align: left;
        }

        .retry-btn {
            background: transparent;
            border: 2px solid var(--ink);
            color: var(--ink);
            padding: 12px 32px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.05em;
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            border-radius: 3px;
            transition: all 0.2s ease;
        }

        .retry-btn:hover {
            background: var(--ink);
            color: var(--parchment);
        }

        /* Sorting narration */
        .sorting-narration {
            display: none;
            text-align: center;
            padding: 20px 0;
        }

        .sorting-narration.active {
            display: block;
        }

        .sorting-narration p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2em;
            font-style: italic;
            color: var(--ink);
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .dot-anim {
            display: inline-flex;
            gap: 4px;
            margin-left: 4px;
        }

        .dot-anim span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--ink);
            animation: dotBounce 1.2s ease-in-out infinite;
        }

        .dot-anim span:nth-child(2) { animation-delay: 0.15s; }
        .dot-anim span:nth-child(3) { animation-delay: 0.3s; }

        @keyframes dotBounce {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-6px); }
        }

        /* Mobile */
        @media (max-width: 480px) {
            .scroll { padding: 32px 22px; }
            .header h1 { font-size: 1.8em; }
            .question-text { font-size: 1.1em; }
            .house-bar-name { width: 70px; font-size: 0.8em; }
        }
    </style>
</head>
<body>
<div class="container">
<div class="scroll">
    <div class="corner-br">❧</div>
    <div class="corner-bl">❧</div>

    <div class="header">
        <h1>The Sorting Hat</h1>
        <div class="subtitle">A Hogwarts House Sorting Experience</div>
    </div>

    <div class="divider">✦</div>

    <!-- START SCREEN -->
    <div class="start-screen" id="startScreen">
        <div class="hat-container">
            <svg class="hat-svg" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Hat body -->
                <path d="M60 18 L90 90 L30 90 Z" fill="#1a1a2e" stroke="#0d0d1a" stroke-width="2"/>
                <!-- Hat brim -->
                <ellipse cx="60" cy="90" rx="52" ry="14" fill="#1a1a2e" stroke="#0d0d1a" stroke-width="2"/>
                <!-- Hat band -->
                <path d="M12 86 Q60 78 108 86" stroke="#ae8f2f" stroke-width="3" fill="none"/>
                <!-- Buckle -->
                <rect x="48" y="80" width="24" height="16" rx="2" stroke="#d4af37" stroke-width="2" fill="none"/>
                <line x1="60" y1="80" x2="60" y2="96" stroke="#d4af37" stroke-width="2"/>
                <!-- Hat texture lines -->
                <path d="M40 30 Q60 26 80 30" stroke="#2a2a4e" stroke-width="1" fill="none" opacity="0.5"/>
                <path d="M36 50 Q60 46 84 50" stroke="#2a2a4e" stroke-width="1" fill="none" opacity="0.5"/>
                <path d="M34 70 Q60 66 86 70" stroke="#2a2a4e" stroke-width="1" fill="none" opacity="0.5"/>
                <!-- Eye -->
                <ellipse cx="53" cy="55" rx="4" ry="3" fill="#d4af37" opacity="0.8"/>
            </svg>
        </div>
        <p>Four houses guard the halls of Hogwarts — Gryffindor, brave and bold; Ravenclaw, wise and keen; Hufflepuff, loyal and true; Slytherin, ambitious and cunning.</p>
        <p style="margin-top: 12px; font-style: italic;">Answer seven questions, and the ancient hat shall reveal your true house.</p>
        <div style="margin-top: 28px;">
            <button class="start-btn" onclick="startQuiz()">Begin the Sorting</button>
        </div>
    </div>

    <!-- QUESTION SCREEN -->
    <div class="question-screen" id="questionScreen">
        <div class="question-number" id="questionNumber"></div>
        <div class="question-text" id="questionText"></div>
        <div class="choices" id="choicesContainer"></div>
    </div>

    <!-- SORTING NARRATION -->
    <div class="sorting-narration" id="sortingNarration">
        <p id="narrationText">Hmm... interesting<span class="dot-anim"><span></span><span></span><span></span></span></p>
    </div>

    <!-- RESULT SCREEN -->
    <div class="result-screen" id="resultScreen">
        <svg class="house-badge" id="houseBadge" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"></svg>
        <div class="house-name" id="houseName"></div>
        <div class="house-motto" id="houseMotto"></div>
        <div class="house-desc" id="houseDesc"></div>

        <div class="score-bar">
            <div class="score-bar-label">House Scores</div>
            <div id="scoreBars"></div>
        </div>

        <div class="house-facts" id="houseFacts">
            <h3>Notable Traits</h3>
            <p id="houseTraits"></p>
        </div>

        <div class="house-creed" id="houseCreed"></div>

        <button class="retry-btn" onclick="resetQuiz()">Sort Another</button>
    </div>
</div>
</div>

<script>
const questions = [
    {
        text: "You and your friends must travel across a dark forest. What do you do?",
        choices: [
            { letter: "A", text: "Walk ahead with a lantern, leading the way", house: "gryffindor" },
            { letter: "B", text: "Suggest a clever shortcut no one else thought of", house: "ravenclaw" },
            { letter: "C", text: "Make sure no one gets left behind or lost", house: "hufflepuff" },
            { letter: "D", text: "Take charge and assign everyone a role for safety", house: "slytherin" }
        ]
    },
    {
        text: "A classmate is struggling with a difficult spell. How do you help?",
        choices: [
            { letter: "A", text: "Demonstrate it yourself, showing off what you've mastered", house: "gryffindor" },
            { letter: "B", text: "Explain the theory behind it until they truly understand", house: "ravenclaw" },
            { letter: "C", text: "Stay with them late into the night until they get it", house: "hufflepuff" },
            { letter: "D", text: "Find a way to make the spell easier to cast", house: "slytherin" }
        ]
    },
    {
        text: "You discover a secret passage in the castle. What is your first thought?",
        choices: [
            { letter: "A", text: "Where does it lead? Adventure awaits!", house: "gryffindor" },
            { letter: "B", text: "Who built this, and when? I must research its history", house: "ravenclaw" },
            { letter: "C", text: "Could this be useful for helping others escape danger?", house: "hufflepuff" },
            { letter: "D", text: "An exclusive secret — only the cleverest would find it", house: "slytherin" }
        ]
    },
    {
        text: "Your greatest fear is...",
        choices: [
            { letter: "A", text: "Being a coward when someone needs you", house: "gryffindor" },
            { letter: "B", text: "Being wrong about something you believed was true", house: "ravenclaw" },
            { letter: "C", text: "Never being accepted for who you truly are", house: "hufflepuff" },
            { letter: "D", text: "Being ordinary while others achieve greatness", house: "slytherin" }
        ]
    },
    {
        text: "At a feast, the house cup is about to be awarded. What do you feel?",
        choices: [
            { letter: "A", text: "Fierce pride — you want to cheer the loudest", house: "gryffindor" },
            { letter: "B", text: "Curiosity about the criteria and whether they're fair", house: "ravenclaw" },
            { letter: "C", text: "Joy for your house-mates, whoever wins", house: "hufflepuff" },
            { letter: "D", text: "Determination to win it back next year, no matter what", house: "slytherin" }
        ]
    },
    {
        text: "If you could have any magical gift, which would you choose?",
        choices: [
            { letter: "A", text: "Invisibility — to go anywhere and see anything", house: "gryffindor" },
            { letter: "B", text: "Perfect memory — to never forget what you learn", house: "ravenclaw" },
            { letter: "C", text: "The ability to heal any wound or illness", house: "hufflepuff" },
            { letter: "D", text: "The power to influence and lead others", house: "slytherin" }
        ]
    },
    {
        text: "A muggle-born student is being teased. What do you do?",
        choices: [
            { letter: "A", text: "Stand up to the bullies, no matter the odds", house: "gryffindor" },
            { letter: "B", text: "Quietly befriend the student and share your notes", house: "ravenclaw" },
            { letter: "C", text: "Include them in your group and make them feel welcome", house: "hufflepuff" },
            { letter: "D", text: "Report it to a professor, using the situation wisely", house: "slytherin" }
        ]
    }
];

const houses = {
    gryffindor: {
        name: "Gryffindor",
        color: "#740001",
        accentColor: "#d4af37",
        motto: "\"Their daring, nerve, and chivalry set Gryffindor apart.\"",
        desc: "You are brave at heart, ready to face any challenge no matter the cost. Your courage is not the absence of fear — it is acting despite it. Gryffindors are bold, adventurous, and always the first to defend a just cause.",
        traits: "Courage, bravery, nerve, daring, determination, loyalty, chivalry",
        creed: "\"And pity those who must themselves the Sorting do repeat.\"",
        badgeSVG: `<circle cx="50" cy="50" r="46" fill="#740001" stroke="#d4af37" stroke-width="3"/>
                   <text x="50" y="58" text-anchor="middle" font-size="52" fill="#d4af37" font-family="serif">🦁</text>`
    },
    ravenclaw: {
        name: "Ravenclaw",
        color: "#0d1a40",
        accentColor: "#d4af37",
        motto: "\"Wit beyond measure is man's greatest treasure.\"",
        desc: "Your mind is your greatest treasure. You love learning for its own sake, ask endless questions, and find beauty in knowledge most others overlook. Ravenclaws are wise, original thinkers who refuse to be constrained by convention.",
        traits: "Intelligence, creativity, learning, wit, wisdom, individuality, curiosity",
        creed: "\"Or yet of wise old Ravenclaw, if you've a ready mind.\"",
        badgeSVG: `<circle cx="50" cy="50" r="46" fill="#0d1a40" stroke="#d4af37" stroke-width="3"/>
                   <text x="50" y="58" text-anchor="middle" font-size="52" fill="#d4af37" font-family="serif">🦅</text>`
    },
    hufflepuff: {
        name: "Hufflepuff",
        color: "#7d5a3c",
        accentColor: "#d4af37",
        motto: "\"Those patient Hufflepuffs are true and unafraid of toil.\"",
        desc: "You believe that hard work and patience matter more than natural talent. Hufflepuffs are the most loyal of friends, always working harder than expected, and treating every person with equal kindness. Your justice is quiet but unshakeable.",
        traits: "Loyalty, patience, hard work, justice, fair play, modesty, dedication",
        creed: "\"Said Hufflepuff, 'I'll teach the rest, and train them well in everything I know.'\"",
        badgeSVG: `<circle cx="50" cy="50" r="46" fill="#7d5a3c" stroke="#d4af37" stroke-width="3"/>
                   <text x="50" y="58" text-anchor="middle" font-size="52" fill="#d4af37" font-family="serif">🦡</text>`
    },
    slytherin: {
        name: "Slytherin",
        color: "#1a472a",
        accentColor: "#c0c0c0",
        motto: "\"And power-hungry Slytherin loved those of great ambition.\"",
        desc: "You have the drive to achieve great things. You know what you want and know how to get it — not through shortcuts, but through cleverness, resourcefulness, and never underestimating the value of a quiet plan. Slytherins know that true greatness requires patience.",
        traits: "Ambition, cunning, leadership, determination, resourcefulness, self-preservation, pride",
        creed: "\"Or perhaps in Slytherin you'll make your real friends; those crafty folk use any means to achieve their ends.\"",
        badgeSVG: `<circle cx="50" cy="50" r="46" fill="#1a472a" stroke="#c0c0c0" stroke-width="3"/>
                   <text x="50" y="58" text-anchor="middle" font-size="52" fill="#c0c0c0" font-family="serif">🐍</text>`
    }
};

const narrations = [
    "Hmm... interesting...",
    "Ah, yes, I see it now...",
    "A tricky one, very tricky...",
    "I see... I see your true nature...",
    "Ahh, quite the dilemma, but never mind...",
    "Yes, your heart tells me you are...",
    "You belong in..."
];

const houseColors = {
    gryffindor: '#740001',
    ravenclaw: '#0d1a40',
    hufflepuff: '#7d5a3c',
    slytherin: '#1a472a'
};

let currentQuestion = 0;
let scores = { gryffindor: 0, ravenclaw: 0, hufflepuff: 0, slytherin: 0 };

function startQuiz() {
    document.getElementById('startScreen').style.display = 'none';
    document.getElementById('questionScreen').classList.add('active');
    showQuestion();
}

function showQuestion() {
    const q = questions[currentQuestion];
    document.getElementById('questionNumber').textContent = `Question ${currentQuestion + 1} of ${questions.length}`;
    document.getElementById('questionText').textContent = q.text;
    const container = document.getElementById('choicesContainer');
    container.innerHTML = '';
    q.choices.forEach((choice, i) => {
        const btn = document.createElement('button');
        btn.className = 'choice-btn';
        btn.innerHTML = `<span class="choice-letter">${choice.letter}.</span>${choice.text}`;
        btn.style.animationDelay = `${i * 0.08}s`;
        btn.onclick = () => handleAnswer(choice.house);
        container.appendChild(btn);
    });
}

function handleAnswer(house) {
    scores[house]++;
    currentQuestion++;

    const hat = document.querySelector('.hat-svg');
    hat.classList.remove('shake');
    void hat.offsetWidth;
    hat.classList.add('shake');

    if (currentQuestion < questions.length) {
        document.getElementById('questionScreen').classList.remove('active');
        document.getElementById('sortingNarration').classList.add('active');
        document.getElementById('narrationText').innerHTML = 
            narrations[Math.min(currentQuestion, narrations.length - 1)] +
            '<span class="dot-anim"><span></span><span></span><span></span></span>';

        setTimeout(() => {
            document.getElementById('sortingNarration').classList.remove('active');
            document.getElementById('questionScreen').classList.add('active');
            showQuestion();
        }, 1600);
    } else {
        showSortingDrama();
    }
}

function showSortingDrama() {
    document.getElementById('questionScreen').classList.remove('active');
    document.getElementById('sortingNarration').classList.add('active');

    const lines = [
        "Ahh... your soul reveals itself to me...",
        "I see your heart, brave and true...",
        "Knowledge flows through you like light...",
        "Patience and loyalty run deep in you...",
        "Ambition burns bright within you..."
    ];

    let idx = 0;
    const interval = setInterval(() => {
        if (idx < lines.length) {
            document.getElementById('narrationText').innerHTML = lines[idx] + '<span class="dot-anim"><span></span><span></span><span></span></span>';
            idx++;
        } else {
            clearInterval(interval);
            setTimeout(() => showResults(), 500);
        }
    }, 700);
}

function showResults() {
    document.getElementById('sortingNarration').classList.remove('active');
    document.getElementById('resultScreen').classList.add('active');

    // Determine winner
    let maxScore = 0;
    let winner = 'gryffindor';
    for (const h in scores) {
        if (scores[h] > maxScore) { maxScore = scores[h]; winner = h; }
    }

    const house = houses[winner];

    document.getElementById('houseBadge').innerHTML = house.badgeSVG;
    document.getElementById('houseName').textContent = house.name;
    document.getElementById('houseName').className = `house-name ${winner}`;
    document.getElementById('houseMotto').textContent = house.motto;
    document.getElementById('houseDesc').textContent = house.desc;
    document.getElementById('houseTraits').textContent = house.traits;
    document.getElementById('houseCreed').textContent = house.creed;

    // Score bars
    const total = Math.max(1, Object.values(scores).reduce((a, b) => a + b, 0));
    const barOrder = ['gryffindor', 'ravenclaw', 'hufflepuff', 'slytherin'];
    const barNames = { gryffindor: 'Gryffindor', ravenclaw: 'Ravenclaw', hufflepuff: 'Hufflepuff', slytherin: 'Slytherin' };
    const barsHtml = barOrder.map(h => {
        const pct = Math.round((scores[h] / total) * 100);
        return `<div class="house-bar">
            <span class="house-bar-name">${barNames[h]}</span>
            <div class="house-bar-track"><div class="house-bar-fill ${h}" style="width:${pct}%"></div></div>
            <span class="house-bar-pct">${pct}%</span>
        </div>`;
    }).join('');
    document.getElementById('scoreBars').innerHTML = barsHtml;
}

function resetQuiz() {
    currentQuestion = 0;
    scores = { gryffindor: 0, ravenclaw: 0, hufflepuff: 0, slytherin: 0 };
    document.getElementById('resultScreen').classList.remove('active');
    document.getElementById('startScreen').style.display = 'block';
}
</script>
</body>
</html>
