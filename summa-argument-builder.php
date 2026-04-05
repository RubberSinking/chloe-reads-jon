<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summa Argument Builder</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        :root {
            --parchment: #f5f0e6;
            --ink: #2c1810;
            --red: #8b2500;
            --gold: #c5a55a;
            --blue: #1a3a5c;
            --border: #d4c9b0;
            --highlight: #fdf8ef;
        }
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: var(--parchment);
            color: var(--ink);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .container {
            max-width: 720px;
            margin: 0 auto;
            padding: 24px 20px 64px;
        }
        h1 {
            font-size: 1.8em;
            text-align: center;
            color: var(--red);
            margin: 0 0 4px;
            letter-spacing: 1px;
        }
        .subtitle {
            text-align: center;
            color: var(--gold);
            font-style: italic;
            font-size: 1em;
            margin: 0 0 24px;
        }
        .intro {
            background: var(--highlight);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 28px;
            line-height: 1.7;
            font-size: 0.95em;
        }
        .intro strong { color: var(--red); }

        /* Tabs */
        .tabs {
            display: flex;
            gap: 0;
            margin-bottom: 0;
            border-bottom: 2px solid var(--gold);
        }
        .tab {
            flex: 1;
            padding: 12px 8px;
            text-align: center;
            cursor: pointer;
            background: transparent;
            border: 1px solid var(--border);
            border-bottom: none;
            border-radius: 8px 8px 0 0;
            font-family: inherit;
            font-size: 0.9em;
            color: var(--ink);
            transition: background 0.2s;
        }
        .tab:hover { background: var(--highlight); }
        .tab.active {
            background: var(--highlight);
            border-bottom: 2px solid var(--highlight);
            margin-bottom: -2px;
            font-weight: bold;
            color: var(--red);
        }
        .tab-content {
            display: none;
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 8px 8px;
            padding: 24px 20px;
            background: var(--highlight);
        }
        .tab-content.active { display: block; }

        /* Learn Tab */
        .structure-part {
            margin-bottom: 24px;
            padding: 16px;
            border-left: 4px solid var(--gold);
            background: rgba(197, 165, 90, 0.06);
            border-radius: 0 6px 6px 0;
        }
        .structure-part h3 {
            margin: 0 0 8px;
            color: var(--red);
            font-size: 1.1em;
        }
        .structure-part .latin {
            font-style: italic;
            color: var(--gold);
            font-size: 0.9em;
        }
        .structure-part p {
            margin: 8px 0 0;
            line-height: 1.6;
            font-size: 0.93em;
        }
        .example-box {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 16px;
            margin-top: 20px;
            font-size: 0.9em;
            line-height: 1.7;
        }
        .example-box h4 {
            margin: 0 0 12px;
            color: var(--blue);
        }
        .example-box .label {
            font-weight: bold;
            color: var(--red);
        }

        /* Quiz Tab */
        .quiz-question {
            margin-bottom: 20px;
        }
        .quiz-question h3 {
            color: var(--blue);
            font-size: 1em;
            margin: 0 0 8px;
        }
        .quiz-excerpt {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 14px;
            font-style: italic;
            line-height: 1.6;
            font-size: 0.93em;
            margin-bottom: 12px;
        }
        .quiz-options {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .quiz-option {
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: 6px;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.93em;
            background: #fff;
            text-align: left;
            transition: all 0.2s;
        }
        .quiz-option:hover { background: #f0ead8; border-color: var(--gold); }
        .quiz-option.correct { background: #d4edda; border-color: #28a745; }
        .quiz-option.wrong { background: #f8d7da; border-color: #dc3545; }
        .quiz-option.disabled { pointer-events: none; opacity: 0.7; }
        .quiz-feedback {
            margin-top: 10px;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 0.9em;
            line-height: 1.5;
            display: none;
        }
        .quiz-feedback.show { display: block; }
        .quiz-feedback.correct-fb { background: #d4edda; border: 1px solid #c3e6cb; }
        .quiz-feedback.wrong-fb { background: #f8d7da; border: 1px solid #f5c6cb; }
        .quiz-score {
            text-align: center;
            padding: 20px;
            font-size: 1.2em;
            color: var(--red);
            font-weight: bold;
        }
        .quiz-controls {
            text-align: center;
            margin-top: 16px;
        }

        /* Builder Tab */
        .builder-topic {
            text-align: center;
            margin-bottom: 20px;
        }
        .builder-topic h3 {
            color: var(--blue);
            margin: 0 0 8px;
        }
        .topic-display {
            font-size: 1.15em;
            font-style: italic;
            color: var(--red);
            margin-bottom: 12px;
        }
        .builder-section {
            margin-bottom: 20px;
        }
        .builder-section label {
            display: block;
            font-weight: bold;
            color: var(--red);
            margin-bottom: 6px;
            font-size: 0.95em;
        }
        .builder-section .hint {
            font-size: 0.82em;
            color: #888;
            font-style: italic;
            margin-bottom: 8px;
        }
        .builder-section textarea {
            width: 100%;
            min-height: 70px;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.93em;
            line-height: 1.5;
            background: #fff;
            resize: vertical;
        }
        .builder-section textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(197,165,90,0.2);
        }
        .preview-article {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 24px;
            line-height: 1.7;
            font-size: 0.93em;
        }
        .preview-article h3 {
            text-align: center;
            color: var(--red);
            margin: 0 0 20px;
            font-size: 1.15em;
        }
        .preview-article .part-label {
            font-weight: bold;
            color: var(--red);
            margin-top: 16px;
        }
        .preview-article .part-text {
            margin: 4px 0 12px;
            padding-left: 16px;
            border-left: 2px solid var(--gold);
        }
        .preview-article .empty-text {
            color: #bbb;
            font-style: italic;
        }

        /* Buttons */
        .btn {
            padding: 10px 24px;
            border: 1px solid var(--gold);
            border-radius: 6px;
            background: var(--gold);
            color: #fff;
            font-family: inherit;
            font-size: 0.95em;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn:hover { background: #b89948; }
        .btn-outline {
            background: transparent;
            color: var(--gold);
        }
        .btn-outline:hover { background: rgba(197,165,90,0.1); }
        .btn-red { background: var(--red); border-color: var(--red); }
        .btn-red:hover { background: #6d1d00; }

        /* Fun Topics */
        .topic-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-bottom: 16px;
        }
        .topic-chip {
            padding: 6px 14px;
            border: 1px solid var(--border);
            border-radius: 20px;
            font-family: inherit;
            font-size: 0.82em;
            cursor: pointer;
            background: #fff;
            transition: all 0.2s;
        }
        .topic-chip:hover { background: var(--gold); color: #fff; border-color: var(--gold); }
        .topic-chip.active { background: var(--red); color: #fff; border-color: var(--red); }

        .custom-topic-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 0.95em;
            background: #fff;
            margin-bottom: 12px;
        }
        .custom-topic-input:focus {
            outline: none;
            border-color: var(--gold);
        }

        .ornament {
            text-align: center;
            color: var(--gold);
            font-size: 1.4em;
            margin: 20px 0;
            letter-spacing: 8px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 16px;
            color: var(--blue);
            text-decoration: none;
            font-size: 0.9em;
        }
        .back-link:hover { text-decoration: underline; }

        @media (max-width: 600px) {
            .container { padding: 16px 14px 48px; }
            h1 { font-size: 1.4em; }
            .tab { font-size: 0.8em; padding: 10px 4px; }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="index.php" class="back-link">← Back to index</a>
    <h1>Summa Argument Builder</h1>
    <p class="subtitle">Master the art of the medieval disputatio</p>

    <div class="intro">
        St. Thomas Aquinas structured every article of his <strong>Summa Theologiae</strong> like a formal debate: first the objections <em>against</em> his position, then a counter-argument (<em>sed contra</em>), then his own answer (<em>respondeo</em>), and finally replies to each objection. It's one of the most rigorous — and beautiful — ways to argue ever devised. Here you can <strong>learn</strong> the structure, <strong>test</strong> yourself, and <strong>build</strong> your own Summa-style arguments on fun modern topics.
    </div>

    <div class="tabs">
        <button class="tab active" onclick="switchTab('learn')">📖 Learn</button>
        <button class="tab" onclick="switchTab('quiz')">🎯 Quiz</button>
        <button class="tab" onclick="switchTab('build')">🏗️ Build</button>
    </div>

    <!-- LEARN TAB -->
    <div id="tab-learn" class="tab-content active">
        <div class="structure-part">
            <h3>1. The Question</h3>
            <p class="latin">Quaestio — "Whether..."</p>
            <p>Every article begins with a question, always phrased as "Whether..." (Utrum). Aquinas frames it so that his own position is the <em>affirmative</em> answer. For example: "Whether God exists?" — Aquinas will argue <em>yes</em>.</p>
        </div>
        <div class="structure-part">
            <h3>2. Objections</h3>
            <p class="latin">Objectiones — "It seems that..."</p>
            <p>Next come the objections — arguments <em>against</em> the position Aquinas will defend. He states these fairly and forcefully. Each begins with "It seems that..." (Videtur quod). These are the strongest arguments of his opponents, presented honestly. Usually 2–5 objections.</p>
        </div>
        <div class="structure-part">
            <h3>3. On the Contrary</h3>
            <p class="latin">Sed contra — "On the contrary..."</p>
            <p>A brief counter-argument, usually citing Scripture, a Church Father, or Aristotle. This signals which side Aquinas will take. It's like a thesis statement backed by authority.</p>
        </div>
        <div class="structure-part">
            <h3>4. I Answer That</h3>
            <p class="latin">Respondeo — "I answer that..."</p>
            <p>The heart of the article. Here Aquinas gives his own reasoned argument. This is where the philosophical and theological heavy lifting happens. It's his positive case.</p>
        </div>
        <div class="structure-part">
            <h3>5. Replies to Objections</h3>
            <p class="latin">Ad primum, Ad secundum... — "To the first, I reply..."</p>
            <p>Finally, Aquinas goes back and answers each objection one by one. He never ignores an objection — he either shows why it's wrong, or explains how it's compatible with his position after all. This is intellectual charity at its finest.</p>
        </div>

        <div class="ornament">❧ ✦ ❧</div>

        <div class="example-box">
            <h4>Example: Summa Theologiae I, Q.2, Art.3 — Whether God exists?</h4>
            <p><span class="label">Objection 1:</span> It seems that God does not exist; because if one of two contraries be infinite, the other would be altogether destroyed. But the word "God" means that He is infinite goodness. If, therefore, God existed, there would be no evil discoverable; but there is evil in the world. Therefore God does not exist.</p>
            <p><span class="label">Sed contra:</span> It is said in the person of God: "I am Who am." (Exodus 3:14)</p>
            <p><span class="label">Respondeo:</span> The existence of God can be proved in five ways. The first and more manifest way is the argument from motion...</p>
            <p><span class="label">Reply to Objection 1:</span> As Augustine says: "Since God is the highest good, He would not allow any evil to exist in His works, unless His omnipotence and goodness were such as to bring good even out of evil."</p>
        </div>
    </div>

    <!-- QUIZ TAB -->
    <div id="tab-quiz" class="tab-content">
        <div id="quiz-area"></div>
    </div>

    <!-- BUILD TAB -->
    <div id="tab-build" class="tab-content">
        <div class="builder-topic">
            <h3>Pick a topic — or write your own!</h3>
            <div class="topic-chips" id="topic-chips"></div>
            <input type="text" class="custom-topic-input" id="custom-topic" placeholder="Or type your own question: Whether...">
        </div>

        <div id="builder-form" style="display:none;">
            <p class="topic-display" id="builder-question"></p>

            <div class="builder-section">
                <label>Objection 1 <span class="latin">(Videtur quod)</span></label>
                <div class="hint">Argue <em>against</em> your position. Start with "It seems that..." — be fair and forceful.</div>
                <textarea id="build-obj1" placeholder="It seems that..."></textarea>
            </div>
            <div class="builder-section">
                <label>Objection 2 <span class="latin">(Videtur quod)</span></label>
                <div class="hint">Another argument against. A different angle.</div>
                <textarea id="build-obj2" placeholder="Further, it seems that..."></textarea>
            </div>
            <div class="builder-section">
                <label>On the Contrary <span class="latin">(Sed contra)</span></label>
                <div class="hint">A brief counter-argument citing an authority, common wisdom, or experience.</div>
                <textarea id="build-sedcontra" placeholder="On the contrary..."></textarea>
            </div>
            <div class="builder-section">
                <label>I Answer That <span class="latin">(Respondeo)</span></label>
                <div class="hint">Your main argument. Make your positive case clearly and logically.</div>
                <textarea id="build-respondeo" placeholder="I answer that..." style="min-height:100px;"></textarea>
            </div>
            <div class="builder-section">
                <label>Reply to Objection 1 <span class="latin">(Ad primum)</span></label>
                <div class="hint">Show why Objection 1 is wrong, or how it's compatible with your answer.</div>
                <textarea id="build-reply1" placeholder="To the first, I reply that..."></textarea>
            </div>
            <div class="builder-section">
                <label>Reply to Objection 2 <span class="latin">(Ad secundum)</span></label>
                <div class="hint">Same for Objection 2.</div>
                <textarea id="build-reply2" placeholder="To the second, I reply that..."></textarea>
            </div>

            <div style="text-align:center; margin: 20px 0;">
                <button class="btn btn-red" onclick="showPreview()">📜 Preview as Summa Article</button>
            </div>

            <div id="preview-area" style="display:none;">
                <div class="ornament">❧ ✦ ❧</div>
                <div class="preview-article" id="preview-content"></div>
                <div style="text-align:center; margin-top:16px;">
                    <button class="btn btn-outline" onclick="copyArticle()">📋 Copy to Clipboard</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tab switching
function switchTab(tab) {
    document.querySelectorAll('.tab').forEach((t,i) => {
        t.classList.toggle('active', ['learn','quiz','build'][i] === tab);
    });
    document.querySelectorAll('.tab-content').forEach(tc => tc.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    if (tab === 'quiz' && !quizStarted) startQuiz();
}

// ===== QUIZ =====
const quizData = [
    {
        excerpt: "It seems that God does not exist; because if one of two contraries be infinite, the other would be altogether destroyed. But the word 'God' means that He is infinite goodness. If, therefore, God existed, there would be no evil discoverable; but there is evil in the world.",
        answer: "Objection",
        explain: "This is an objection (videtur quod) — it argues AGAINST Aquinas's position. The phrase 'It seems that God does not exist' is the giveaway. Aquinas always states the opposing view first."
    },
    {
        excerpt: "It is said in the person of God: 'I am Who am.' (Exodus 3:14)",
        answer: "Sed Contra",
        explain: "This is the Sed Contra — a brief authority citation (here, Scripture) that signals Aquinas's own position. It's always short and authoritative."
    },
    {
        excerpt: "The existence of God can be proved in five ways. The first and more manifest way is the argument from motion. It is certain, and evident to our senses, that in the world some things are in motion.",
        answer: "Respondeo",
        explain: "This is the Respondeo (I answer that...) — Aquinas's own positive argument. It's the longest section and contains his original reasoning."
    },
    {
        excerpt: "Since God is the highest good, He would not allow any evil to exist in His works, unless His omnipotence and goodness were such as to bring good even out of evil. This is part of the infinite goodness of God, that He should allow evil to exist, and out of it produce good.",
        answer: "Reply to Objection",
        explain: "This is a Reply to an Objection (Ad primum) — Aquinas goes back and answers the specific argument about evil. He doesn't ignore it; he resolves it."
    },
    {
        excerpt: "It seems that the natural law is not the same in all men. For it is stated in the Decretals that 'the natural law dates from the cradle of the human race, and does not vary according to time.' But different nations observe different customs.",
        answer: "Objection",
        explain: "This is an Objection — 'It seems that the natural law is not the same in all men.' Note the 'It seems that...' formula and the argument against Aquinas's position."
    },
    {
        excerpt: "The Philosopher says: 'The natural is that which everywhere is equally valid.' Therefore the natural law is the same in all.",
        answer: "Sed Contra",
        explain: "This is the Sed Contra — citing Aristotle ('The Philosopher') as an authority. Brief, authoritative, and signaling Aquinas's direction."
    },
    {
        excerpt: "To the natural law belongs those things to which a man is inclined naturally: and among these it is proper to man to be inclined to act according to reason. Now the process of reason is from the common to the proper.",
        answer: "Respondeo",
        explain: "This is the Respondeo — Aquinas's own careful philosophical argument about natural law and reason. Note the systematic, reasoned approach."
    },
    {
        excerpt: "Further, it seems that not all acts of virtue are prescribed by the natural law. For it has been said above that things which are done virtuously are actions of virtue. But not every such action has a special reference to natural law.",
        answer: "Objection",
        explain: "Another objection — 'Further, it seems that...' is a classic formula for additional objections. The word 'further' indicates this isn't the first objection."
    },
    {
        excerpt: "To the first objection, I reply that a thing is said to belong to the natural law in two ways. First, because nature inclines thereto: e.g. that one should not do harm to another. Secondly, because nature did not bring in the contrary.",
        answer: "Reply to Objection",
        explain: "This is a Reply to Objection — 'To the first objection, I reply that...' Aquinas addresses the specific concern raised, making a crucial distinction."
    },
    {
        excerpt: "Now whatever is the cause of the cause, is the cause of the effect. If therefore the will be moved to will by the same movement of the will, the process must either go on to infinity, or we must come to a will that is moved by something else. And this we call God.",
        answer: "Respondeo",
        explain: "This is from the Respondeo — Aquinas building his argument step by step with the classical logic of cause and effect, concluding 'And this we call God.'"
    }
];

let quizStarted = false;
let currentQ = 0;
let score = 0;
let shuffledQuiz = [];

function startQuiz() {
    quizStarted = true;
    currentQ = 0;
    score = 0;
    shuffledQuiz = [...quizData].sort(() => Math.random() - 0.5);
    renderQuestion();
}

function renderQuestion() {
    const area = document.getElementById('quiz-area');
    if (currentQ >= shuffledQuiz.length) {
        area.innerHTML = `
            <div class="quiz-score">
                You scored ${score} / ${shuffledQuiz.length}!<br>
                <span style="font-size:0.7em;color:#555;font-weight:normal;">
                    ${score >= 8 ? 'Excellent! You could navigate the Summa with ease.' :
                      score >= 6 ? 'Well done — you have a solid grasp of the structure.' :
                      score >= 4 ? 'Not bad! Review the Learn tab and try again.' :
                      'Keep studying — the Summa rewards persistence!'}
                </span>
            </div>
            <div class="quiz-controls">
                <button class="btn btn-red" onclick="startQuiz()">🔄 Try Again</button>
            </div>
        `;
        return;
    }
    const q = shuffledQuiz[currentQ];
    const options = ['Objection', 'Sed Contra', 'Respondeo', 'Reply to Objection'];
    area.innerHTML = `
        <div class="quiz-question">
            <h3>Question ${currentQ + 1} of ${shuffledQuiz.length}</h3>
            <p style="font-size:0.9em;color:#666;margin:0 0 12px;">Which part of the Summa article is this excerpt from?</p>
            <div class="quiz-excerpt">"${q.excerpt}"</div>
            <div class="quiz-options">
                ${options.map(o => `<button class="quiz-option" onclick="answerQuiz(this,'${o}')">${o}</button>`).join('')}
            </div>
            <div class="quiz-feedback" id="quiz-fb"></div>
        </div>
        <div style="text-align:right;color:#999;font-size:0.85em;">Score: ${score}/${currentQ}</div>
    `;
}

function answerQuiz(btn, chosen) {
    const q = shuffledQuiz[currentQ];
    const correct = chosen === q.answer;
    if (correct) score++;

    document.querySelectorAll('.quiz-option').forEach(b => {
        b.classList.add('disabled');
        if (b.textContent === q.answer) b.classList.add('correct');
        if (b === btn && !correct) b.classList.add('wrong');
    });

    const fb = document.getElementById('quiz-fb');
    fb.className = 'quiz-feedback show ' + (correct ? 'correct-fb' : 'wrong-fb');
    fb.innerHTML = (correct ? '✓ Correct! ' : '✗ Not quite. ') + q.explain;

    setTimeout(() => { currentQ++; renderQuestion(); }, correct ? 2000 : 4000);
}

// ===== BUILDER =====
const funTopics = [
    "Whether pineapple belongs on pizza",
    "Whether a hot dog is a sandwich",
    "Whether cats are superior to dogs",
    "Whether remote work is better than office work",
    "Whether the Oxford comma should always be used",
    "Whether coffee is better than tea",
    "Whether it is lawful to recline one's airplane seat",
    "Whether tabs are superior to spaces",
    "Whether cereal is a soup",
    "Whether GIF is pronounced with a hard G",
    "Whether one should read physical books or e-books",
    "Whether dad jokes are a legitimate form of humor"
];

function initTopics() {
    const container = document.getElementById('topic-chips');
    funTopics.forEach(t => {
        const chip = document.createElement('button');
        chip.className = 'topic-chip';
        chip.textContent = t.replace('Whether ','').slice(0,30) + (t.length > 38 ? '…' : '');
        chip.title = t;
        chip.onclick = () => selectTopic(t, chip);
        container.appendChild(chip);
    });

    document.getElementById('custom-topic').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            let val = e.target.value.trim();
            if (val && !val.toLowerCase().startsWith('whether')) val = 'Whether ' + val;
            if (val.length > 8) selectTopic(val, null);
        }
    });
}

function selectTopic(topic, chip) {
    document.querySelectorAll('.topic-chip').forEach(c => c.classList.remove('active'));
    if (chip) chip.classList.add('active');

    document.getElementById('builder-question').textContent = topic + '?';
    document.getElementById('builder-form').style.display = 'block';
    document.getElementById('preview-area').style.display = 'none';

    // Clear fields
    ['build-obj1','build-obj2','build-sedcontra','build-respondeo','build-reply1','build-reply2'].forEach(id => {
        document.getElementById(id).value = '';
    });
}

function showPreview() {
    const question = document.getElementById('builder-question').textContent;
    const fields = {
        obj1: document.getElementById('build-obj1').value.trim(),
        obj2: document.getElementById('build-obj2').value.trim(),
        sedcontra: document.getElementById('build-sedcontra').value.trim(),
        respondeo: document.getElementById('build-respondeo').value.trim(),
        reply1: document.getElementById('build-reply1').value.trim(),
        reply2: document.getElementById('build-reply2').value.trim()
    };

    const empty = '<span class="empty-text">(not yet written)</span>';

    const html = `
        <h3>ARTICLE — ${question}</h3>
        <p class="part-label">Objection 1.</p>
        <p class="part-text">${fields.obj1 || empty}</p>
        <p class="part-label">Objection 2.</p>
        <p class="part-text">${fields.obj2 || empty}</p>
        <p class="part-label">On the contrary,</p>
        <p class="part-text">${fields.sedcontra || empty}</p>
        <p class="part-label">I answer that</p>
        <p class="part-text">${fields.respondeo || empty}</p>
        <p class="part-label">Reply to Objection 1.</p>
        <p class="part-text">${fields.reply1 || empty}</p>
        <p class="part-label">Reply to Objection 2.</p>
        <p class="part-text">${fields.reply2 || empty}</p>
    `;

    document.getElementById('preview-content').innerHTML = html;
    document.getElementById('preview-area').style.display = 'block';
    document.getElementById('preview-area').scrollIntoView({ behavior: 'smooth' });
}

function copyArticle() {
    const question = document.getElementById('builder-question').textContent;
    const g = id => document.getElementById(id).value.trim() || '(...)';
    const text = `ARTICLE — ${question}\n\nObjection 1. ${g('build-obj1')}\n\nObjection 2. ${g('build-obj2')}\n\nOn the contrary, ${g('build-sedcontra')}\n\nI answer that ${g('build-respondeo')}\n\nReply to Objection 1. ${g('build-reply1')}\n\nReply to Objection 2. ${g('build-reply2')}`;

    navigator.clipboard.writeText(text).then(() => {
        const btn = document.querySelector('.btn-outline');
        btn.textContent = '✓ Copied!';
        setTimeout(() => btn.textContent = '📋 Copy to Clipboard', 2000);
    });
}

initTopics();
</script>
</body>
</html>
