<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>True Colors Quiz</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --orange: #FF6B2C;
      --gold: #F5A623;
      --green: #2ECC71;
      --blue: #3A7BD5;
      --orange-light: #FFF0EB;
      --gold-light: #FFF8EC;
      --green-light: #E8FBF2;
      --blue-light: #EBF3FD;
      --orange-glow: rgba(255, 107, 44, 0.35);
      --gold-glow: rgba(245, 166, 35, 0.35);
      --green-glow: rgba(46, 204, 113, 0.35);
      --blue-glow: rgba(58, 123, 213, 0.35);
      --bg: #0d0d0f;
      --surface: #16161a;
      --surface2: #1e1e24;
      --text: #f0f0f2;
      --muted: #8a8a9a;
      --border: #2a2a36;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', system-ui, sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Animated background */
    .bg-orbs {
      position: fixed;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
      z-index: 0;
    }
    .bg-orbs span {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
      opacity: 0.18;
      animation: float 12s ease-in-out infinite;
    }
    .bg-orbs .orb-orange { width: 400px; height: 400px; background: var(--orange); top: -100px; left: -100px; animation-delay: 0s; }
    .bg-orbs .orb-blue { width: 350px; height: 350px; background: var(--blue); bottom: -80px; right: -80px; animation-delay: -4s; }
    .bg-orbs .orb-green { width: 300px; height: 300px; background: var(--green); top: 40%; left: 55%; animation-delay: -8s; }
    .bg-orbs .orb-gold { width: 250px; height: 250px; background: var(--gold); bottom: 20%; left: 10%; animation-delay: -2s; }
    @keyframes float {
      0%, 100% { transform: translate(0, 0) scale(1); }
      33% { transform: translate(30px, -40px) scale(1.05); }
      66% { transform: translate(-20px, 20px) scale(0.95); }
    }

    .container {
      position: relative;
      z-index: 1;
      max-width: 680px;
      margin: 0 auto;
      padding: 48px 24px 80px;
    }

    /* Header */
    header {
      text-align: center;
      margin-bottom: 56px;
    }
    .logo-palette {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 28px;
    }
    .logo-palette span {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: block;
      animation: bounce 2s ease-in-out infinite;
    }
    .logo-palette span:nth-child(1) { background: var(--orange); animation-delay: 0s; }
    .logo-palette span:nth-child(2) { background: var(--gold); animation-delay: 0.2s; }
    .logo-palette span:nth-child(3) { background: var(--green); animation-delay: 0.4s; }
    .logo-palette span:nth-child(4) { background: var(--blue); animation-delay: 0.6s; }
    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }
    h1 {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: clamp(2.2em, 8vw, 3.2em);
      letter-spacing: -0.02em;
      background: linear-gradient(135deg, var(--orange), var(--gold), var(--green), var(--blue));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 14px;
    }
    .tagline {
      color: var(--muted);
      font-size: 1.05em;
      line-height: 1.6;
    }
    .tagline a { color: var(--gold); text-decoration: none; }
    .tagline a:hover { text-decoration: underline; }

    /* Color legend */
    .color-legend {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
      margin-bottom: 40px;
    }
    .legend-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border-radius: 12px;
      border: 1px solid var(--border);
      background: var(--surface);
    }
    .legend-dot {
      width: 14px; height: 14px;
      border-radius: 50%;
      flex-shrink: 0;
    }
    .legend-item span { font-size: 0.82em; font-weight: 500; }
    .legend-item.orange { border-color: rgba(255,107,44,0.3); background: rgba(255,107,44,0.06); }
    .legend-item.orange .legend-dot { background: var(--orange); }
    .legend-item.orange span { color: var(--orange); }
    .legend-item.gold { border-color: rgba(245,166,35,0.3); background: rgba(245,166,35,0.06); }
    .legend-item.gold .legend-dot { background: var(--gold); }
    .legend-item.gold span { color: var(--gold); }
    .legend-item.green { border-color: rgba(46,204,113,0.3); background: rgba(46,204,113,0.06); }
    .legend-item.green .legend-dot { background: var(--green); }
    .legend-item.green span { color: var(--green); }
    .legend-item.blue { border-color: rgba(58,123,213,0.3); background: rgba(58,123,213,0.06); }
    .legend-item.blue .legend-dot { background: var(--blue); }
    .legend-item.blue span { color: var(--blue); }

    /* Progress */
    .progress-wrap {
      margin-bottom: 36px;
    }
    .progress-label {
      display: flex;
      justify-content: space-between;
      font-size: 0.8em;
      color: var(--muted);
      margin-bottom: 8px;
    }
    .progress-bar {
      height: 6px;
      background: var(--surface2);
      border-radius: 3px;
      overflow: hidden;
    }
    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, var(--orange), var(--gold), var(--green), var(--blue));
      border-radius: 3px;
      transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Question card */
    .question-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 32px 28px;
      margin-bottom: 24px;
      animation: slideUp 0.4s ease-out;
    }
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .question-number {
      font-size: 0.75em;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--muted);
      margin-bottom: 14px;
    }
    .question-text {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: 1.25em;
      line-height: 1.5;
      color: var(--text);
      margin-bottom: 28px;
    }
    .options {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .option-btn {
      background: var(--surface2);
      border: 1.5px solid var(--border);
      border-radius: 12px;
      padding: 14px 18px;
      text-align: left;
      cursor: pointer;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.95em;
      color: var(--text);
      transition: all 0.2s ease;
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }
    .option-btn:hover {
      border-color: var(--gold);
      background: rgba(245,166,35,0.08);
      transform: translateX(4px);
    }
    .option-letter {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      background: var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75em;
      font-weight: 700;
      flex-shrink: 0;
      color: var(--muted);
      transition: all 0.2s ease;
    }
    .option-btn:hover .option-letter {
      background: var(--gold);
      color: #000;
    }
    .option-btn.orange:hover { border-color: var(--orange); background: rgba(255,107,44,0.08); }
    .option-btn.orange:hover .option-letter { background: var(--orange); color: #fff; }
    .option-btn.gold:hover { border-color: var(--gold); background: rgba(245,166,35,0.08); }
    .option-btn.gold:hover .option-letter { background: var(--gold); color: #000; }
    .option-btn.green:hover { border-color: var(--green); background: rgba(46,204,113,0.08); }
    .option-btn.green:hover .option-letter { background: var(--green); color: #fff; }
    .option-btn.blue:hover { border-color: var(--blue); background: rgba(58,123,213,0.08); }
    .option-btn.blue:hover .option-letter { background: var(--blue); color: #fff; }

    /* Results */
    .results {
      display: none;
      animation: slideUp 0.5s ease-out;
    }
    .results.show { display: block; }

    .result-hero {
      text-align: center;
      padding: 48px 24px;
      border-radius: 24px;
      margin-bottom: 32px;
      position: relative;
      overflow: hidden;
    }
    .result-hero.orange { background: linear-gradient(135deg, rgba(255,107,44,0.2), rgba(255,107,44,0.05)); border: 1px solid rgba(255,107,44,0.3); }
    .result-hero.gold { background: linear-gradient(135deg, rgba(245,166,35,0.2), rgba(245,166,35,0.05)); border: 1px solid rgba(245,166,35,0.3); }
    .result-hero.green { background: linear-gradient(135deg, rgba(46,204,113,0.2), rgba(46,204,113,0.05)); border: 1px solid rgba(46,204,113,0.3); }
    .result-hero.blue { background: linear-gradient(135deg, rgba(58,123,213,0.2), rgba(58,123,213,0.05)); border: 1px solid rgba(58,123,213,0.3); }

    .result-hero::before {
      content: '';
      position: absolute;
      width: 200px; height: 200px;
      border-radius: 50%;
      top: -60px; left: 50%;
      transform: translateX(-50%);
      filter: blur(60px);
      opacity: 0.3;
    }
    .result-hero.orange::before { background: var(--orange); }
    .result-hero.gold::before { background: var(--gold); }
    .result-hero.green::before { background: var(--green); }
    .result-hero.blue::before { background: var(--blue); }

    .result-label {
      font-size: 0.75em;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      color: var(--muted);
      margin-bottom: 12px;
    }
    .result-emoji {
      font-size: 4em;
      margin-bottom: 16px;
      display: block;
      filter: drop-shadow(0 4px 20px rgba(0,0,0,0.3));
    }
    .result-title {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: 2.4em;
      margin-bottom: 8px;
    }
    .result-hero.orange .result-title { color: var(--orange); }
    .result-hero.gold .result-title { color: var(--gold); }
    .result-hero.green .result-title { color: var(--green); }
    .result-hero.blue .result-title { color: var(--blue); }

    .result-quote {
      font-style: italic;
      color: var(--muted);
      font-size: 0.95em;
      line-height: 1.6;
      max-width: 420px;
      margin: 0 auto 20px;
    }

    /* Score bars */
    .score-section {
      margin-bottom: 32px;
    }
    .score-section h3 {
      font-size: 0.75em;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--muted);
      margin-bottom: 18px;
    }
    .score-bars { display: flex; flex-direction: column; gap: 14px; }
    .score-row {
      display: grid;
      grid-template-columns: 60px 1fr 36px;
      align-items: center;
      gap: 12px;
    }
    .score-name {
      font-size: 0.82em;
      font-weight: 600;
    }
    .score-name.orange { color: var(--orange); }
    .score-name.gold { color: var(--gold); }
    .score-name.green { color: var(--green); }
    .score-name.blue { color: var(--blue); }
    .score-track {
      height: 10px;
      background: var(--surface2);
      border-radius: 5px;
      overflow: hidden;
    }
    .score-fill {
      height: 100%;
      border-radius: 5px;
      transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .score-fill.orange { background: var(--orange); box-shadow: 0 0 10px var(--orange-glow); }
    .score-fill.gold { background: var(--gold); box-shadow: 0 0 10px var(--gold-glow); }
    .score-fill.green { background: var(--green); box-shadow: 0 0 10px var(--green-glow); }
    .score-fill.blue { background: var(--blue); box-shadow: 0 0 10px var(--blue-glow); }
    .score-pct { font-size: 0.82em; font-weight: 700; text-align: right; }
    .score-pct.orange { color: var(--orange); }
    .score-pct.gold { color: var(--gold); }
    .score-pct.green { color: var(--green); }
    .score-pct.blue { color: var(--blue); }

    /* Trait pills */
    .traits {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin: 20px 0 28px;
    }
    .trait-pill {
      padding: 5px 14px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: 600;
    }
    .trait-pill.orange { background: rgba(255,107,44,0.15); color: var(--orange); border: 1px solid rgba(255,107,44,0.3); }
    .trait-pill.gold { background: rgba(245,166,35,0.15); color: var(--gold); border: 1px solid rgba(245,166,35,0.3); }
    .trait-pill.green { background: rgba(46,204,113,0.15); color: var(--green); border: 1px solid rgba(46,204,113,0.3); }
    .trait-pill.blue { background: rgba(58,123,213,0.15); color: var(--blue); border: 1px solid rgba(58,123,213,0.3); }

    /* Description card */
    .desc-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 28px;
      margin-bottom: 24px;
    }
    .desc-card h3 {
      font-family: 'DM Serif Display', Georgia, serif;
      font-size: 1.15em;
      margin-bottom: 14px;
      color: var(--text);
    }
    .desc-card p {
      color: var(--muted);
      font-size: 0.95em;
      line-height: 1.7;
      margin-bottom: 12px;
    }

    /* Retake button */
    .btn-retake {
      display: block;
      width: 100%;
      padding: 16px;
      border-radius: 14px;
      border: 1.5px solid var(--border);
      background: var(--surface);
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 1em;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      margin-bottom: 16px;
    }
    .btn-retake:hover {
      border-color: var(--gold);
      background: rgba(245,166,35,0.08);
      transform: translateY(-2px);
    }

    /* Hidden quiz */
    .quiz-wrap { display: block; }
    .quiz-wrap.hidden { display: none; }

    /* Jon comparison */
    .jon-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px 4px 6px;
      border-radius: 20px;
      font-size: 0.78em;
      background: var(--surface2);
      border: 1px solid var(--border);
      color: var(--muted);
      margin-bottom: 16px;
    }
    .jon-badge img {
      width: 20px; height: 20px;
      border-radius: 50%;
    }

    /* Jon's result */
    .jons-result {
      background: var(--surface);
      border: 1px solid rgba(245,166,35,0.25);
      border-radius: 14px;
      padding: 18px 20px;
      margin-bottom: 28px;
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .jons-result .avatar {
      width: 44px; height: 44px;
      border-radius: 50%;
      border: 2px solid var(--gold);
      flex-shrink: 0;
    }
    .jons-result .text { font-size: 0.88em; color: var(--muted); line-height: 1.5; }
    .jons-result strong { color: var(--gold); }

    @media (max-width: 480px) {
      .container { padding: 32px 16px 60px; }
      .question-card { padding: 24px 20px; }
      .color-legend { grid-template-columns: 1fr 1fr; }
      .result-hero { padding: 36px 20px; }
    }
  </style>
</head>
<body>

<div class="bg-orbs">
  <span class="orb-orange"></span>
  <span class="orb-blue"></span>
  <span class="orb-green"></span>
  <span class="orb-gold"></span>
</div>

<div class="container">

  <header>
    <div class="logo-palette">
      <span></span><span></span><span></span><span></span>
    </div>
    <h1>True Colors</h1>
    <p class="tagline">Discover your personality color &mdash; Orange, Gold, Green, or Blue. Inspired by Jon's <a href="https://jona.ca/2015/02/you-are-orange.html" target="_blank">"You are Orange"</a> post.</p>
  </header>

  <div class="color-legend">
    <div class="legend-item orange"><div class="legend-dot"></div><span>Orange &mdash; Spontaneous</span></div>
    <div class="legend-item gold"><div class="legend-dot"></div><span>Gold &mdash; Responsible</span></div>
    <div class="legend-item green"><div class="legend-dot"></div><span>Green &mdash; Analytical</span></div>
    <div class="legend-item blue"><div class="legend-dot"></div><span>Blue &mdash; Compassionate</span></div>
  </div>

  <!-- Jon's result -->
  <div class="jons-result">
    <img class="avatar" src="avatar.jpg" alt="Jon" onerror="this.style.display='none'">
    <div class="text"><strong>Jon is Orange.</strong> "People who are Orange are often spontaneous and flamboyant. They need a lot of variety and freedom. They take pride in being highly skilled and in being able to do several things at a time."</div>
  </div>

  <!-- Quiz -->
  <div class="quiz-wrap" id="quizWrap">
    <div class="progress-wrap">
      <div class="progress-label">
        <span id="progressText">Question 1 of 12</span>
        <span id="progressPct">0%</span>
      </div>
      <div class="progress-bar">
        <div class="progress-fill" id="progressFill" style="width:0%"></div>
      </div>
    </div>

    <div class="question-card" id="questionCard">
      <div class="question-number" id="questionNumber">Question 1</div>
      <div class="question-text" id="questionText"></div>
      <div class="options" id="options"></div>
    </div>
  </div>

  <!-- Results -->
  <div class="results" id="results"></div>

</div>

<script>
const questions = [
  {
    text: "It's Saturday morning. What's your ideal plan?",
    options: [
      { label: "Spontaneous road trip with friends — no plan, just go!", color: "orange" },
      { label: "Organize a family brunch and make sure everyone knows the schedule.", color: "gold" },
      { label: "Quiet morning with a book, coffee, and a long walk.", color: "green" },
      { label: "Call a friend you've been meaning to catch up with, or volunteer somewhere.", color: "blue" }
    ]
  },
  {
    text: "Your friend comes to you feeling down. What do you do?",
    options: [
      { label: "Organize something fun to cheer them up — a surprise outing!", color: "orange" },
      { label: "Make sure they have what they need practically — meals, rides.", color: "gold" },
      { label: "Give them space but do some research on helpful resources.", color: "green" },
      { label: "Sit with them and listen deeply — really hear how they're feeling.", color: "blue" }
    ]
  },
  {
    text: "You're given a complex problem at work. What's your approach?",
    options: [
      { label: "Jump in headfirst and figure it out as you go.", color: "orange" },
      { label: "Follow the proven process — consistency and hard work win.", color: "gold" },
      { label: "Gather data, analyze it from every angle, then act.", color: "green" },
      { label: "Talk to everyone involved to understand the human impact first.", color: "blue" }
    ]
  },
  {
    text: "What draws you to a new hobby or interest?",
    options: [
      { label: "It looks exciting and fun — something to do right now!", color: "orange" },
      { label: "It seems useful and practical — something I can apply.", color: "gold" },
      { label: "It challenges me intellectually — I want to understand it deeply.", color: "green" },
      { label: "It connects me with people or helps me grow as a person.", color: "blue" }
    ]
  },
  {
    text: "At a party, you're most likely to be found...",
    options: [
      { label: "In the middle of an impromptu game or making everyone laugh.", color: "orange" },
      { label: "Helping the host with something, or checking that everyone's comfortable.", color: "gold" },
      { label: "Having a meaningful one-on-one conversation in a quieter corner.", color: "green" },
      { label: "Dancing, or deep in conversation about values and ideas.", color: "blue" }
    ]
  },
  {
    text: "What's your biggest strength in a team?",
    options: [
      { label: "Bringing energy, optimism, and getting people excited to act.", color: "orange" },
      { label: "Following through, keeping things on track, and being reliable.", color: "gold" },
      { label: "Thinking critically, solving the hard problems no one else can.", color: "green" },
      { label: "Making sure everyone's voice is heard and people feel valued.", color: "blue" }
    ]
  },
  {
    text: "You disagree with a decision your group is making. What happens?",
    options: [
      { label: "Speak up with energy — let's not waste time going the wrong way!", color: "orange" },
      { label: "Respectfully point out the established rules or past precedent.", color: "gold" },
      { label: "Lay out the logical flaws calmly with evidence and data.", color: "green" },
      { label: "Share how the decision will affect the people involved.", color: "blue" }
    ]
  },
  {
    text: "What does your ideal workspace look like?",
    options: [
      { label: "Whatever works in the moment — couch, cafe, standing desk, all good!", color: "orange" },
      { label: "Clean, organized, everything in its place, all set up for efficiency.", color: "gold" },
      { label: "A quiet corner with books, tools, and space to think deeply.", color: "green" },
      { label: "Somewhere with natural light, personal photos, and a warm feel.", color: "blue" }
    ]
  },
  {
    text: "Your friend asks for advice on a big life decision. You...",
    options: [
      { label: "Help them weigh the risks vs rewards and just go for it!", color: "orange" },
      { label: "Help them think through a practical, step-by-step plan.", color: "gold" },
      { label: "Ask a lot of questions and help them analyze their options.", color: "green" },
      { label: "Help them explore how they really feel about it, and what's true to them.", color: "blue" }
    ]
  },
  {
    text: "What would your friends say is your defining quality?",
    options: [
      { label: "Fun — always the life of the party and up for anything.", color: "orange" },
      { label: "Dependable — they'll always show up when it counts.", color: "gold" },
      { label: "Brilliant — always seeing angles nobody else considered.", color: "green" },
      { label: "Kind — always there when you need a listening ear.", color: "blue" }
    ]
  },
  {
    text: "What's the most important thing to you in a relationship?",
    options: [
      { label: "Adventure and fun together — let's enjoy life!", color: "orange" },
      { label: "Loyalty and commitment — I can always count on you.", color: "gold" },
      { label: "Intellectual connection — we get each other's thinking.", color: "green" },
      { label: "Emotional intimacy — we really understand each other.", color: "blue" }
    ]
  },
  {
    text: "How do you handle a crisis?",
    options: [
      { label: "Stay calm, stay flexible — improvise and solve it on the fly.", color: "orange" },
      { label: "Stay calm, stay focused — follow the emergency plan.", color: "gold" },
      { label: "Stay calm, stay analytical — figure out what caused it.", color: "green" },
      { label: "Stay calm, stay human — make sure everyone's okay first.", color: "blue" }
    ]
  }
];

const colorData = {
  orange: {
    name: "Orange",
    emoji: "🔥",
    title: "The Spontaneous Orange",
    quote: "\"People who are Orange are often spontaneous and flamboyant. They need a lot of variety and freedom. They take pride in being highly skilled and in being able to do several things at a time.\"",
    traits: ["Spontaneous", "Fearless", "Adventurous", "Multi-skilled", "Optimistic", "Fun-loving"],
    description: "You're the life of the party and the first to volunteer for something new. Oranges are hands-on, quick-thinking, and thrive in fast-paced environments. You bring energy and enthusiasm wherever you go, and you're never afraid to try something bold. You value freedom, variety, and the thrill of the moment.",
    strengths: "Creative problem-solver, natural performer, fearless in a crisis, brings people together through fun and energy.",
    growth: "Learning patience and follow-through helps you turn your brilliant ideas into lasting achievements.",
    colorClass: "orange"
  },
  gold: {
    name: "Gold",
    emoji: "🏅",
    title: "The Responsible Gold",
    quote: "\"People who are Gold are the backbone of every family, team, and community. They are reliable, organized, and take their commitments seriously.\"",
    traits: ["Reliable", "Organized", "Loyal", "Practical", "Responsible", " Dutiful"],
    description: "You're the person everyone counts on. Golds are the steady, dependable force that keeps life running smoothly — from family rituals to work deadlines. You take your responsibilities seriously and find deep satisfaction in being there for others. Your word is your bond.",
    strengths: "Rock-solid reliability, exceptional follow-through, natural at organizing and planning, deeply loyal.",
    growth: "Learning to relax and let go of control allows your warmth to shine as brightly as your competence.",
    colorClass: "gold"
  },
  green: {
    name: "Green",
    emoji: "🧠",
    title: "The Analytical Green",
    quote: "\"People who are Green are driven by a need to know and understand. They are curious, intellectual, and seek truth through knowledge and reason.\"",
    traits: ["Analytical", "Intellectual", "Thoughtful", "Innovative", "Independent", "Curious"],
    description: "You're the deep thinker who sees connections others miss. Greens are driven by curiosity and a love of knowledge for its own sake. You seek truth through reason and are never satisfied with surface-level explanations. Your quiet intelligence and creativity make you a invaluable problem-solver.",
    strengths: "Breakthrough thinking, deep expertise, creative problem-solving, innovation, calm under pressure.",
    growth: "Sharing your ideas more confidently and valuing emotional connection as much as intellectual mastery.",
    colorClass: "green"
  },
  blue: {
    name: "Blue",
    emoji: "💙",
    title: "The Compassionate Blue",
    quote: "\"People who are Blue are motivated by a deep need for meaningful connection. They are caring, empathetic, and seek harmony in their relationships.\"",
    traits: ["Compassionate", "Empathetic", "Harmonious", "Communicative", "Idealistic", "Intuitive"],
    description: "You're the heart of every group you're part of. Blues are driven by love, connection, and the desire to make a real difference in people's lives. You feel deeply, communicate beautifully, and create spaces where others feel truly seen and understood. You find meaning through relationships.",
    strengths: "Deep empathy, natural communicator, creates psychological safety, inspires loyalty and trust.",
    growth: "Learning to set boundaries and care for yourself as fiercely as you care for others.",
    colorClass: "blue"
  }
};

let currentQ = 0;
let scores = { orange: 0, gold: 0, green: 0, blue: 0 };

function renderQuestion() {
  const q = questions[currentQ];
  const pct = Math.round((currentQ / questions.length) * 100);
  document.getElementById('progressText').textContent = `Question ${currentQ + 1} of ${questions.length}`;
  document.getElementById('progressPct').textContent = `${pct}%`;
  document.getElementById('progressFill').style.width = `${pct}%`;
  document.getElementById('questionNumber').textContent = `Question ${currentQ + 1}`;
  document.getElementById('questionText').textContent = q.text;

  const opts = document.getElementById('options');
  const letters = ['A', 'B', 'C', 'D'];
  opts.innerHTML = '';
  q.options.forEach((opt, i) => {
    const btn = document.createElement('button');
    btn.className = `option-btn ${opt.color}`;
    btn.innerHTML = `<span class="option-letter">${letters[i]}</span><span>${opt.label}</span>`;
    btn.addEventListener('click', () => selectAnswer(opt.color));
    opts.appendChild(btn);
  });

  // Re-trigger animation
  const card = document.getElementById('questionCard');
  card.style.animation = 'none';
  card.offsetHeight; // reflow
  card.style.animation = 'slideUp 0.4s ease-out';
}

function selectAnswer(color) {
  scores[color]++;
  currentQ++;
  if (currentQ < questions.length) {
    renderQuestion();
  } else {
    showResults();
  }
}

function showResults() {
  document.getElementById('quizWrap').classList.add('hidden');
  document.getElementById('progressFill').style.width = '100%';
  document.getElementById('progressPct').textContent = '100%';

  const total = scores.orange + scores.gold + scores.green + scores.blue;
  const percentages = {
    orange: Math.round((scores.orange / total) * 100),
    gold: Math.round((scores.gold / total) * 100),
    green: Math.round((scores.green / total) * 100),
    blue: Math.round((scores.blue / total) * 100)
  };

  const primary = Object.entries(scores).sort((a, b) => b[1] - a[1])[0][0];
  const primaryData = colorData[primary];

  const resultsEl = document.getElementById('results');
  resultsEl.classList.add('show');

  resultsEl.innerHTML = `
    <div class="result-hero ${primaryData.colorClass}">
      <div class="result-label">Your True Color</div>
      <span class="result-emoji">${primaryData.emoji}</span>
      <div class="result-title">${primaryData.title}</div>
      <div class="result-quote">${primaryData.quote}</div>
    </div>

    <div class="score-section">
      <h3>Your Full Color Profile</h3>
      <div class="score-bars">
        <div class="score-row">
          <div class="score-name orange">Orange</div>
          <div class="score-track"><div class="score-fill orange" style="width:0%"></div></div>
          <div class="score-pct orange">${percentages.orange}%</div>
        </div>
        <div class="score-row">
          <div class="score-name gold">Gold</div>
          <div class="score-track"><div class="score-fill gold" style="width:0%"></div></div>
          <div class="score-pct gold">${percentages.gold}%</div>
        </div>
        <div class="score-row">
          <div class="score-name green">Green</div>
          <div class="score-track"><div class="score-fill green" style="width:0%"></div></div>
          <div class="score-pct green">${percentages.green}%</div>
        </div>
        <div class="score-row">
          <div class="score-name blue">Blue</div>
          <div class="score-track"><div class="score-fill blue" style="width:0%"></div></div>
          <div class="score-pct blue">${percentages.blue}%</div>
        </div>
      </div>
    </div>

    <div class="traits">
      ${primaryData.traits.map(t => `<span class="trait-pill ${primaryData.colorClass}">${t}</span>`).join('')}
    </div>

    <div class="desc-card">
      <h3>Your Strengths</h3>
      <p>${primaryData.description}</p>
      <p><strong>What you bring to the table:</strong> ${primaryData.strengths}</p>
      <p><strong>Room to grow:</strong> ${primaryData.growth}</p>
    </div>

    <button class="btn-retake" onclick="retake()">Take the Quiz Again</button>
  `;

  // Animate score bars
  setTimeout(() => {
    document.querySelectorAll('.score-fill').forEach(bar => {
      const target = bar.parentElement.nextElementSibling.textContent;
      bar.style.width = target;
    });
  }, 100);
}

function retake() {
  currentQ = 0;
  scores = { orange: 0, gold: 0, green: 0, blue: 0 };
  document.getElementById('quizWrap').classList.remove('hidden');
  document.getElementById('results').classList.remove('show');
  document.getElementById('results').innerHTML = '';
  renderQuestion();
}

renderQuestion();
</script>

</body>
</html>
