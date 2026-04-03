<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What's Your Love Language? — Chloe Reads Jon</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Georgia', serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #fdf6e3 0%, #f5e6d3 50%, #ede0d4 100%);
            color: #2c1810;
            padding: 20px;
        }
        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 20px 0;
        }
        h1 {
            font-size: 1.8em;
            text-align: center;
            margin-bottom: 8px;
            color: #5c2d0e;
            letter-spacing: -0.5px;
        }
        .subtitle {
            text-align: center;
            color: #8b6914;
            font-style: italic;
            margin-bottom: 32px;
            font-size: 0.95em;
            line-height: 1.5;
        }
        .progress-bar {
            background: #e8d5c4;
            border-radius: 20px;
            height: 8px;
            margin-bottom: 28px;
            overflow: hidden;
        }
        .progress-fill {
            background: linear-gradient(90deg, #c9956b, #8b4513);
            height: 100%;
            border-radius: 20px;
            transition: width 0.4s ease;
        }
        .question-count {
            text-align: center;
            font-size: 0.85em;
            color: #999;
            margin-bottom: 16px;
        }
        .scenario {
            background: white;
            border-radius: 16px;
            padding: 28px 24px;
            box-shadow: 0 4px 24px rgba(92,45,14,0.08);
            margin-bottom: 20px;
            border: 1px solid rgba(139,105,20,0.1);
        }
        .scenario-prompt {
            font-size: 1.05em;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #3d2b1f;
        }
        .choice-btn {
            display: block;
            width: 100%;
            padding: 16px 20px;
            margin-bottom: 10px;
            background: #faf6f0;
            border: 2px solid #e8d5c4;
            border-radius: 12px;
            font-family: 'Georgia', serif;
            font-size: 0.95em;
            color: #3d2b1f;
            cursor: pointer;
            text-align: left;
            line-height: 1.5;
            transition: all 0.2s ease;
        }
        .choice-btn:hover {
            background: #f0e6d8;
            border-color: #c9956b;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(92,45,14,0.1);
        }
        .choice-btn:active {
            transform: translateY(0);
        }
        .choice-label {
            display: inline-block;
            background: #8b4513;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            text-align: center;
            line-height: 24px;
            font-size: 0.8em;
            margin-right: 12px;
            font-family: system-ui, sans-serif;
            vertical-align: middle;
        }

        /* Results */
        .results { display: none; }
        .results.visible { display: block; }
        .result-card {
            background: white;
            border-radius: 16px;
            padding: 32px 28px;
            box-shadow: 0 4px 24px rgba(92,45,14,0.1);
            border: 1px solid rgba(139,105,20,0.1);
            margin-bottom: 24px;
            text-align: center;
        }
        .result-emoji {
            font-size: 3em;
            margin-bottom: 12px;
        }
        .result-title {
            font-size: 1.5em;
            color: #5c2d0e;
            margin-bottom: 6px;
        }
        .result-lang {
            font-size: 1.1em;
            color: #8b4513;
            font-weight: bold;
            margin-bottom: 16px;
        }
        .result-desc {
            font-size: 0.95em;
            line-height: 1.7;
            color: #555;
            margin-bottom: 24px;
        }
        .bar-chart {
            margin: 24px 0;
            text-align: left;
        }
        .bar-row {
            display: flex;
            align-items: center;
            margin-bottom: 14px;
            gap: 12px;
        }
        .bar-label {
            min-width: 140px;
            font-size: 0.85em;
            color: #5c2d0e;
            text-align: right;
        }
        .bar-track {
            flex: 1;
            background: #f0e6d8;
            border-radius: 8px;
            height: 28px;
            overflow: hidden;
            position: relative;
        }
        .bar-fill {
            height: 100%;
            border-radius: 8px;
            transition: width 1s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 8px;
            font-size: 0.75em;
            font-weight: bold;
            color: white;
            min-width: 32px;
        }
        .bar-fill.words { background: linear-gradient(90deg, #e8956b, #c9573d); }
        .bar-fill.quality { background: linear-gradient(90deg, #6ba8e8, #3d73c9); }
        .bar-fill.touch { background: linear-gradient(90deg, #9be86b, #5cb83d); }
        .bar-fill.acts { background: linear-gradient(90deg, #e8c96b, #c9a03d); }
        .bar-fill.gifts { background: linear-gradient(90deg, #c96be8, #8b3dc9); }
        .bar-fill.primary { box-shadow: 0 0 12px rgba(0,0,0,0.15); }

        .jon-compare {
            background: #faf6f0;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border: 1px dashed #d4c5b0;
        }
        .jon-compare h3 {
            font-size: 0.95em;
            color: #8b4513;
            margin-bottom: 12px;
        }
        .jon-rank {
            font-size: 0.88em;
            color: #666;
            line-height: 1.8;
        }
        .jon-rank span {
            display: inline-block;
            background: #e8d5c4;
            padding: 2px 10px;
            border-radius: 12px;
            margin: 2px 4px 2px 0;
            font-size: 0.9em;
        }

        .restart-btn {
            display: inline-block;
            background: #8b4513;
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 12px;
            font-family: 'Georgia', serif;
            font-size: 1em;
            cursor: pointer;
            margin-top: 16px;
            transition: background 0.2s;
        }
        .restart-btn:hover { background: #6b3410; }

        .back-link {
            text-align: center;
            margin-top: 32px;
            font-size: 0.85em;
        }
        .back-link a { color: #8b4513; }

        .intro { text-align: center; }
        .intro p {
            font-size: 0.95em;
            line-height: 1.7;
            color: #555;
            margin-bottom: 20px;
        }
        .start-btn {
            display: inline-block;
            background: #8b4513;
            color: white;
            padding: 16px 40px;
            border: none;
            border-radius: 14px;
            font-family: 'Georgia', serif;
            font-size: 1.05em;
            cursor: pointer;
            transition: all 0.2s;
        }
        .start-btn:hover { background: #6b3410; transform: translateY(-1px); }

        .fade-in {
            animation: fadeIn 0.4s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>What's Your Love Language?</h1>
        <p class="subtitle">Based on Gary Chapman's <em>The 5 Love Languages</em></p>

        <!-- Intro -->
        <div id="intro" class="intro">
            <div class="scenario">
                <p style="font-size:0.95em; line-height:1.7; color:#555; margin-bottom:16px;">
                    Everyone expresses and receives love differently. Gary Chapman identified five distinct "love languages" — ways people feel most appreciated and connected.
                </p>
                <p style="font-size:0.95em; line-height:1.7; color:#555; margin-bottom:20px;">
                    In 15 quick scenarios, you'll choose what would make you feel most loved. There are no wrong answers — just honest ones.
                </p>
                <button class="start-btn" onclick="startQuiz()">Discover Your Love Language</button>
            </div>
        </div>

        <!-- Quiz -->
        <div id="quiz" style="display:none;">
            <div class="progress-bar"><div class="progress-fill" id="progressFill"></div></div>
            <div class="question-count" id="questionCount"></div>
            <div id="questionArea"></div>
        </div>

        <!-- Results -->
        <div id="results" class="results"></div>

        <div class="back-link"><a href="index.php">← Back to Chloe Reads Jon</a></div>
    </div>

<script>
const LANGUAGES = {
    words: { name: 'Words of Affirmation', emoji: '💬', color: '#c9573d',
        desc: 'You feel most loved when people express their care through spoken or written words — compliments, encouragement, "I love you," heartfelt notes, or just hearing that someone noticed what you did. A genuine "I'm proud of you" can make your entire week.' },
    quality: { name: 'Quality Time', emoji: '⏰', color: '#3d73c9',
        desc: 'You feel most loved when someone gives you their full, undivided attention. Not just being in the same room — truly being present. A long walk together, a deep conversation, or even comfortable silence side by side fills your cup like nothing else.' },
    touch: { name: 'Physical Touch', emoji: '🤗', color: '#5cb83d',
        desc: 'You feel most loved through physical closeness — a hug, a hand on your shoulder, sitting close together, a high-five after a win. Physical presence and touch communicate safety, belonging, and care in a way words sometimes can\'t.' },
    acts: { name: 'Acts of Service', emoji: '🛠️', color: '#c9a03d',
        desc: 'You feel most loved when someone eases your burden by doing something for you — cooking a meal, fixing that thing that\'s been broken, taking care of a chore without being asked. Actions speak louder than words for you.' },
    gifts: { name: 'Receiving Gifts', emoji: '🎁', color: '#8b3dc9',
        desc: 'You feel most loved when someone gives you a thoughtful gift — not because of the price tag, but because it shows they were thinking of you. A small "I saw this and thought of you" means the world.' }
};

const scenarios = [
    { prompt: "After a long, exhausting day, you come home. What would make you feel most cared for?",
      choices: [
        { lang: 'words', text: 'Your partner says, "I\'m so proud of how hard you work. You\'re amazing."' },
        { lang: 'acts', text: 'Dinner is already made, the kitchen is clean, and there\'s nothing left to do.' },
        { lang: 'touch', text: 'A long, warm hug the moment you walk through the door.' },
        { lang: 'quality', text: 'They put their phone away and sit with you, asking about your day.' }
      ]},
    { prompt: "It's your birthday. Which of these gifts would mean the most?",
      choices: [
        { lang: 'gifts', text: 'A carefully chosen book they knew you\'d love, with a note inside the cover.' },
        { lang: 'quality', text: 'A whole day planned together — just the two of you, no distractions.' },
        { lang: 'words', text: 'A handwritten letter telling you what you mean to them.' },
        { lang: 'acts', text: 'They handle every chore and errand so you can fully relax all day.' }
      ]},
    { prompt: "You're feeling insecure about a project at work. What helps most?",
      choices: [
        { lang: 'words', text: '"You\'re brilliant at this. I believe in you completely."' },
        { lang: 'touch', text: 'They squeeze your hand and pull you close.' },
        { lang: 'quality', text: 'They sit with you while you work, keeping you company through the stress.' },
        { lang: 'acts', text: 'They quietly take over the household tasks so you can focus.' }
      ]},
    { prompt: "You and your partner are watching a movie together. What matters most?",
      choices: [
        { lang: 'touch', text: 'Cuddling on the couch, arm around you, leaning into each other.' },
        { lang: 'quality', text: 'That they chose this movie just for you and are fully engaged — not on their phone.' },
        { lang: 'gifts', text: 'They brought your favourite snack without you asking.' },
        { lang: 'words', text: 'Partway through, they whisper, "I love spending time with you like this."' }
      ]},
    { prompt: "Which of these small gestures would brighten an ordinary Tuesday?",
      choices: [
        { lang: 'gifts', text: 'Finding a small surprise on your desk — a treat, a flower, a little something.' },
        { lang: 'words', text: 'A random text: "Just thinking about you. You make my life better."' },
        { lang: 'acts', text: 'Coming home to find they\'ve done that task you keep putting off.' },
        { lang: 'touch', text: 'A surprise hug from behind while you\'re making coffee.' }
      ]},
    { prompt: "You've accomplished something you're proud of. What response means the most?",
      choices: [
        { lang: 'words', text: 'They tell everyone about it — genuinely bragging about you to friends and family.' },
        { lang: 'gifts', text: 'They surprise you with a small celebration gift.' },
        { lang: 'quality', text: 'They want to hear every detail — sit down and walk them through the whole story.' },
        { lang: 'touch', text: 'A huge bear hug and a high-five.' }
      ]},
    { prompt: "When you're sick and stuck in bed, what makes you feel most loved?",
      choices: [
        { lang: 'acts', text: 'They bring soup, fluff your pillows, and handle everything without being asked.' },
        { lang: 'touch', text: 'They curl up next to you, gently rubbing your back.' },
        { lang: 'quality', text: 'They stay home from their plans to be with you all day.' },
        { lang: 'words', text: '"I hate that you feel bad. I\'m here for whatever you need."' }
      ]},
    { prompt: "You're having a disagreement. What would help you feel reconnected?",
      choices: [
        { lang: 'words', text: '"I\'m sorry. You were right, and I should have listened."' },
        { lang: 'touch', text: 'They reach for your hand or put their arm around you.' },
        { lang: 'quality', text: 'They sit down face-to-face and give you space to talk it through, no distractions.' },
        { lang: 'acts', text: 'Without saying much, they go do something kind for you — a peace offering through action.' }
      ]},
    { prompt: "What kind of holiday trip would feel most loving?",
      choices: [
        { lang: 'quality', text: 'A quiet cabin in the mountains — phones off, just the two of you for three days.' },
        { lang: 'gifts', text: 'They secretly planned everything and surprise you with tickets and an itinerary.' },
        { lang: 'acts', text: 'They packed your bags, arranged pet care, printed directions — you just had to show up.' },
        { lang: 'words', text: 'During the trip, they keep saying how happy they are to be there with you.' }
      ]},
    { prompt: "Your child made you a drawing at school. What about it touches you most?",
      choices: [
        { lang: 'gifts', text: 'The fact that they made something specifically for you — they were thinking of you.' },
        { lang: 'words', text: 'The words they wrote on it: "To the best parent in the world."' },
        { lang: 'touch', text: 'The running hug they give you as they hand it over.' },
        { lang: 'quality', text: 'That they want to sit with you and explain every detail of the drawing.' }
      ]},
    { prompt: "You're stressed about money. What helps most from your partner?",
      choices: [
        { lang: 'acts', text: 'They sit down and help you make a budget, or pick up extra work.' },
        { lang: 'words', text: '"We\'ll get through this together. I believe in us."' },
        { lang: 'touch', text: 'Holding you while you vent your worries.' },
        { lang: 'quality', text: 'They carve out an evening to sit together and talk through it calmly.' }
      ]},
    { prompt: "A friend hasn't been in touch for a while. What would make you feel the friendship is still strong?",
      choices: [
        { lang: 'words', text: 'A heartfelt message out of the blue: "I miss you. You matter to me."' },
        { lang: 'quality', text: 'They call and talk for an hour, catching up on everything.' },
        { lang: 'gifts', text: 'A care package arrives in the mail — something small and thoughtful.' },
        { lang: 'acts', text: 'They remember that errand you mentioned weeks ago and offer to help.' }
      ]},
    { prompt: "It's a normal weeknight. Which small moment would make you happiest?",
      choices: [
        { lang: 'touch', text: 'Your partner rests their head on your shoulder while you read.' },
        { lang: 'acts', text: 'They handle bedtime for the kids so you can have an hour to yourself.' },
        { lang: 'words', text: 'Over dinner, they say: "I really like our life together."' },
        { lang: 'gifts', text: 'They picked up your favourite tea on the way home — just because.' }
      ]},
    { prompt: "You made a mistake at work and feel terrible about it. What helps most?",
      choices: [
        { lang: 'words', text: '"Everyone makes mistakes. You\'re still the smartest person I know."' },
        { lang: 'quality', text: 'They take you for a walk, just to be near you and let you talk.' },
        { lang: 'touch', text: 'They hold you and say nothing — just let you feel their presence.' },
        { lang: 'acts', text: 'They take care of dinner and everything else so you can decompress.' }
      ]},
    { prompt: "Looking back on your best relationships, what stands out most?",
      choices: [
        { lang: 'quality', text: 'The long conversations — hours together that felt like minutes.' },
        { lang: 'words', text: 'The things they said — the compliments and encouragements you still remember.' },
        { lang: 'gifts', text: 'The little gifts and surprises that showed they really knew you.' },
        { lang: 'touch', text: 'The warmth — the hugs, the closeness, the physical comfort.' }
      ]}
];

let currentQ = 0;
let scores = { words: 0, quality: 0, touch: 0, acts: 0, gifts: 0 };

function startQuiz() {
    document.getElementById('intro').style.display = 'none';
    document.getElementById('quiz').style.display = 'block';
    showQuestion();
}

function showQuestion() {
    const q = scenarios[currentQ];
    const pct = (currentQ / scenarios.length) * 100;
    document.getElementById('progressFill').style.width = pct + '%';
    document.getElementById('questionCount').textContent = `Question ${currentQ + 1} of ${scenarios.length}`;

    // Shuffle choices
    const shuffled = [...q.choices].sort(() => Math.random() - 0.5);
    const labels = ['A', 'B', 'C', 'D'];

    let html = '<div class="scenario fade-in">';
    html += `<div class="scenario-prompt">${q.prompt}</div>`;
    shuffled.forEach((c, i) => {
        html += `<button class="choice-btn" onclick="answer('${c.lang}')">
            <span class="choice-label">${labels[i]}</span>${c.text}
        </button>`;
    });
    html += '</div>';
    document.getElementById('questionArea').innerHTML = html;
}

function answer(lang) {
    scores[lang]++;
    currentQ++;
    if (currentQ >= scenarios.length) {
        showResults();
    } else {
        showQuestion();
    }
}

function showResults() {
    document.getElementById('quiz').style.display = 'none';
    document.getElementById('progressFill').style.width = '100%';

    // Find primary
    const sorted = Object.entries(scores).sort((a, b) => b[1] - a[1]);
    const primary = sorted[0][0];
    const secondary = sorted[1][0];
    const maxScore = scenarios.length;

    const L = LANGUAGES;
    let html = '<div class="result-card fade-in">';
    html += `<div class="result-emoji">${L[primary].emoji}</div>`;
    html += `<div class="result-title">Your Primary Love Language</div>`;
    html += `<div class="result-lang">${L[primary].name}</div>`;
    html += `<div class="result-desc">${L[primary].desc}</div>`;

    if (scores[secondary] > 0) {
        html += `<p style="font-size:0.9em; color:#888; margin-bottom:8px;">Secondary: <strong style="color:${L[secondary].color}">${L[secondary].name}</strong> ${L[secondary].emoji}</p>`;
    }

    html += '<div class="bar-chart">';
    sorted.forEach(([lang, score]) => {
        const pct = Math.max((score / maxScore) * 100, 2);
        const isPrimary = lang === primary ? ' primary' : '';
        html += `<div class="bar-row">
            <div class="bar-label">${L[lang].emoji} ${L[lang].name}</div>
            <div class="bar-track">
                <div class="bar-fill ${lang}${isPrimary}" style="width:${pct}%">${score}</div>
            </div>
        </div>`;
    });
    html += '</div>';

    html += `<div class="jon-compare">
        <h3>📖 Jon's Love Languages (from his 2012 blog post)</h3>
        <div class="jon-rank">
            <span>1. 💬 Words of Affirmation</span>
            <span>2. ⏰ Quality Time</span>
            <span>3. 🤗 Physical Touch</span>
            <span>4. 🛠️ Acts of Service</span>
            <span>5. 🎁 Receiving Gifts</span>
        </div>
        <p style="font-size:0.85em; color:#888; margin-top:12px; font-style:italic;">
            "Feel free to praise and compliment me :-). Quality time is also good. And, what can I say, I like to give hugs to my family."
        </p>
    </div>`;

    html += '<button class="restart-btn" onclick="restart()">Take It Again</button>';
    html += '</div>';

    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = html;
    resultsDiv.classList.add('visible');
}

function restart() {
    currentQ = 0;
    scores = { words: 0, quality: 0, touch: 0, acts: 0, gifts: 0 };
    document.getElementById('results').classList.remove('visible');
    document.getElementById('results').innerHTML = '';
    document.getElementById('quiz').style.display = 'block';
    showQuestion();
}
</script>
</body>
</html>
