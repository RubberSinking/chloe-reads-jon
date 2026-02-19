<?php
// HN Persona Quiz - no server-side logic needed, all JS
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>What's Your HN Reading Persona?</title>
  <style>
    :root {
      --hn-orange: #ff6600;
      --hn-dark: #1a1a2e;
      --hn-card: #16213e;
      --hn-card2: #0f3460;
      --hn-text: #e8e8e8;
      --hn-muted: #8899aa;
      --hn-highlight: #ff6600;
      --hn-selected: #ff660022;
      --radius: 10px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      background: var(--hn-dark);
      color: var(--hn-text);
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      max-width: 680px;
      margin: 0 auto;
    }

    header {
      text-align: center;
      padding: 32px 0 24px;
    }

    .logo {
      display: inline-block;
      background: var(--hn-orange);
      color: white;
      font-size: 1.1em;
      font-weight: 900;
      padding: 4px 10px;
      border-radius: 4px;
      margin-bottom: 14px;
      letter-spacing: 1px;
    }

    header h1 {
      font-size: 1.7em;
      font-weight: 700;
      line-height: 1.3;
      margin-bottom: 8px;
      color: #fff;
    }

    header p {
      color: var(--hn-muted);
      font-size: 0.95em;
    }

    /* Progress */
    .progress-wrap {
      margin: 20px 0;
    }

    .progress-label {
      display: flex;
      justify-content: space-between;
      font-size: 0.82em;
      color: var(--hn-muted);
      margin-bottom: 6px;
    }

    .progress-bar {
      height: 5px;
      background: #2a3a5e;
      border-radius: 3px;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: var(--hn-orange);
      border-radius: 3px;
      transition: width 0.4s ease;
    }

    /* Question card */
    .question-area {
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .question-label {
      font-size: 0.8em;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--hn-orange);
      margin-bottom: 12px;
      font-weight: 600;
    }

    .question-text {
      font-size: 1.05em;
      color: var(--hn-muted);
      margin-bottom: 18px;
    }

    /* Headline cards */
    .headline-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .headline-btn {
      background: var(--hn-card);
      border: 2px solid transparent;
      border-radius: var(--radius);
      padding: 16px 18px;
      text-align: left;
      cursor: pointer;
      transition: all 0.2s ease;
      color: var(--hn-text);
      font-size: 0.97em;
      line-height: 1.4;
      position: relative;
    }

    .headline-btn:hover {
      border-color: var(--hn-orange);
      background: #1e2d50;
      transform: translateY(-1px);
    }

    .headline-btn.selected {
      border-color: var(--hn-orange);
      background: var(--hn-selected);
    }

    .headline-btn .points {
      color: var(--hn-muted);
      font-size: 0.78em;
      display: block;
      margin-top: 5px;
    }

    .headline-btn .tag {
      display: inline-block;
      font-size: 0.72em;
      background: #2a3a5e;
      color: var(--hn-muted);
      padding: 2px 7px;
      border-radius: 10px;
      margin-top: 6px;
    }

    /* Results */
    #results {
      display: none;
      animation: fadeIn 0.5s ease;
    }

    .persona-card {
      background: var(--hn-card);
      border-radius: 14px;
      padding: 28px 24px;
      text-align: center;
      border: 2px solid var(--hn-orange);
      margin-bottom: 28px;
    }

    .persona-icon {
      font-size: 3.5em;
      margin-bottom: 12px;
    }

    .persona-title {
      font-size: 0.8em;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: var(--hn-orange);
      margin-bottom: 8px;
    }

    .persona-name {
      font-size: 2em;
      font-weight: 800;
      color: #fff;
      margin-bottom: 10px;
    }

    .persona-desc {
      color: var(--hn-muted);
      line-height: 1.6;
      font-size: 0.97em;
      max-width: 500px;
      margin: 0 auto;
    }

    /* Breakdown bars */
    .breakdown {
      background: var(--hn-card);
      border-radius: 14px;
      padding: 22px 22px;
      margin-bottom: 24px;
    }

    .breakdown h3 {
      font-size: 0.85em;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: var(--hn-orange);
      margin-bottom: 18px;
    }

    .bar-row {
      margin-bottom: 14px;
    }

    .bar-label {
      display: flex;
      justify-content: space-between;
      font-size: 0.88em;
      margin-bottom: 5px;
    }

    .bar-label .name { color: var(--hn-text); }
    .bar-label .val  { color: var(--hn-muted); }

    .bar-track {
      height: 8px;
      background: #2a3a5e;
      border-radius: 4px;
      overflow: hidden;
    }

    .bar-fill {
      height: 100%;
      background: var(--hn-orange);
      border-radius: 4px;
      width: 0;
      transition: width 0.8s ease;
    }

    /* Jon's stats comparison */
    .jon-card {
      background: var(--hn-card2);
      border-radius: 14px;
      padding: 20px 22px;
      margin-bottom: 24px;
    }

    .jon-card h3 {
      font-size: 0.85em;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #aaccff;
      margin-bottom: 12px;
    }

    .jon-card p {
      color: var(--hn-muted);
      font-size: 0.9em;
      line-height: 1.6;
    }

    .jon-card .jon-stats {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 12px;
    }

    .jon-stat {
      background: #1a2a44;
      border-radius: 20px;
      padding: 4px 12px;
      font-size: 0.82em;
      color: var(--hn-muted);
    }

    .jon-stat strong { color: #aaddff; }

    /* Buttons */
    .btn {
      display: inline-block;
      background: var(--hn-orange);
      color: white;
      border: none;
      border-radius: var(--radius);
      padding: 13px 28px;
      font-size: 1em;
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: opacity 0.2s;
    }

    .btn:hover { opacity: 0.88; }

    .btn-outline {
      background: transparent;
      border: 2px solid var(--hn-orange);
      color: var(--hn-orange);
      margin-left: 10px;
    }

    .action-row {
      text-align: center;
      margin-top: 8px;
    }

    /* Welcome screen */
    #welcome {
      text-align: center;
      padding: 20px 0;
      animation: fadeIn 0.4s ease;
    }

    #welcome .big-icon {
      font-size: 4em;
      margin-bottom: 16px;
    }

    #welcome h2 {
      font-size: 1.4em;
      margin-bottom: 12px;
    }

    #welcome p {
      color: var(--hn-muted);
      line-height: 1.7;
      margin-bottom: 24px;
      font-size: 0.95em;
    }

    footer {
      text-align: center;
      color: var(--hn-muted);
      font-size: 0.8em;
      padding: 32px 0 20px;
    }

    footer a { color: var(--hn-orange); text-decoration: none; }
  </style>
</head>
<body>
<div class="container">
  <header>
    <div class="logo">HN</div>
    <h1>What's Your Hacker News Reading Persona?</h1>
    <p>Pick the headlines that pull you in. Find out what really drives you.</p>
  </header>

  <!-- Welcome -->
  <div id="welcome">
    <div class="big-icon">📰</div>
    <h2>8 rounds. 3 headlines each.<br>1 true persona.</h2>
    <p>
      Inspired by Jon Aquino's 2017 observation that you can learn a lot about yourself
      by categorizing the Hacker News stories you bookmark.<br><br>
      Each round, pick the headline that most makes you want to click.
      There are no wrong answers — only revealing ones.
    </p>
    <button class="btn" onclick="startQuiz()">Start the Quiz →</button>
  </div>

  <!-- Quiz area -->
  <div id="quiz" style="display:none">
    <div class="progress-wrap">
      <div class="progress-label">
        <span id="prog-label">Question 1 of 8</span>
        <span id="prog-pct">0%</span>
      </div>
      <div class="progress-bar">
        <div class="progress-fill" id="prog-fill" style="width:0%"></div>
      </div>
    </div>

    <div class="question-area" id="question-area">
      <div class="question-label">Which headline makes you most want to click?</div>
      <div class="headline-list" id="headline-list"></div>
    </div>
  </div>

  <!-- Results -->
  <div id="results">
    <div class="persona-card">
      <div class="persona-icon" id="res-icon"></div>
      <div class="persona-title">Your HN Persona</div>
      <div class="persona-name" id="res-name"></div>
      <div class="persona-desc" id="res-desc"></div>
    </div>

    <div class="breakdown">
      <h3>Your Interest Breakdown</h3>
      <div id="bar-chart"></div>
    </div>

    <div class="jon-card">
      <h3>📊 Jon's 2017 HN Interests (for comparison)</h3>
      <p>Jon tabulated his own HN bookmarks and found a fascinating self-portrait:</p>
      <div class="jon-stats">
        <span class="jon-stat"><strong>13</strong> Coding tools &amp; practices</span>
        <span class="jon-stat"><strong>13</strong> Product failures</span>
        <span class="jon-stat"><strong>4</strong> Product successes</span>
        <span class="jon-stat"><strong>4</strong> Low tech</span>
        <span class="jon-stat"><strong>4</strong> Self-improvement</span>
        <span class="jon-stat"><strong>3</strong> Retro tech</span>
        <span class="jon-stat"><strong>3</strong> Promising new tech</span>
        <span class="jon-stat"><strong>3</strong> Work: how it gets worse</span>
        <span class="jon-stat"><strong>2</strong> Work: how to improve it</span>
        <span class="jon-stat"><strong>1</strong> Software engineering</span>
      </div>
    </div>

    <div class="action-row">
      <button class="btn" onclick="restartQuiz()">Retake Quiz</button>
    </div>
  </div>

  <footer>
    Inspired by Jon's <a href="https://jona.ca/2017/01/hacker-news-favourite-categories.html">Hacker News favourite categories</a> post (2017)
    &nbsp;·&nbsp; <a href="/chloe-reads-jon/">more cool stuff</a>
  </footer>
</div>

<script>
// =====================================================================
// DATA
// =====================================================================

// Categories
const CATS = {
  tools:       { name: "Coding Tools & Practices",  color: "#ff6600" },
  failures:    { name: "Product Failures",           color: "#e74c3c" },
  lowtech:     { name: "Low-Tech & Simple Living",   color: "#27ae60" },
  retro:       { name: "Retro Tech & History",       color: "#8e44ad" },
  engineering: { name: "Software Engineering Craft", color: "#2980b9" },
  newtech:     { name: "Emerging Technology",        color: "#16a085" },
  work:        { name: "Workplace Dynamics",         color: "#f39c12" },
  growth:      { name: "Personal Growth",            color: "#d35400" },
};

// 8 rounds, each round has 3 headlines
// Format: [text, category, subtext]
const ROUNDS = [
  [
    ["Show HN: I built a CLI tool that summarizes git blame history into readable prose",
     "tools", "Ask HN → 412 points · 89 comments"],
    ["The Day We Turned Off the Feature That Made Us $2M — And Why We Had To",
     "failures", "blog.example.com → 1.2k points · 234 comments"],
    ["I Unplugged My Router and Worked Offline for a Month",
     "lowtech", "medium.com → 876 points · 312 comments"],
  ],
  [
    ["Ask HN: What books most changed how you write code?",
     "engineering", "Ask HN → 2.1k points · 441 comments"],
    ["The Secret History of Netscape Navigator's Source Code Release",
     "retro", "computerhistory.org → 934 points · 167 comments"],
    ["LLMs can now synthesize proteins faster than any lab — what comes next?",
     "newtech", "nature.com → 1.5k points · 289 comments"],
  ],
  [
    ["Postmortem: We raised $40M, built a team of 80, shipped nothing. Here's why.",
     "failures", "techblog.io → 4.7k points · 892 comments"],
    ["The Bullshit Asymmetry in Sprint Planning",
     "work", "dev.to → 1.1k points · 445 comments"],
    ["My Year of Deliberate Practice: What Actually Changed",
     "growth", "austinkleon.com → 667 points · 121 comments"],
  ],
  [
    ["Show HN: A regex-free plain-English parser I've been building for 3 years",
     "tools", "github.com → 888 points · 203 comments"],
    ["Why I Write Everything by Hand: A Programmer's Defense of Paper",
     "lowtech", "paulgraham.com → 1.3k points · 567 comments"],
    ["The Rise and Fall of Lotus Notes: Inside the Groupware That Defined an Era",
     "retro", "theatlantic.com → 741 points · 188 comments"],
  ],
  [
    ["Google Graveyard: A Retrospective on 47 Killed Products",
     "failures", "killedbygoogle.com → 6.2k points · 1.1k comments"],
    ["The Unreasonable Effectiveness of Just Talking to Users",
     "work", "ycombinator.com → 1.8k points · 334 comments"],
    ["Neural interfaces reached 1,000-neuron resolution — here's the roadmap to 1M",
     "newtech", "neuralink.com → 2.2k points · 489 comments"],
  ],
  [
    ["The Zen of Python, 15 Years Later: Which Principles Aged Well?",
     "engineering", "realpython.com → 923 points · 211 comments"],
    ["Ask HN: What habit change actually stuck for you long-term?",
     "growth", "Ask HN → 3.1k points · 1.3k comments"],
    ["Recovering a 30-Year-Old HyperCard Stack — and Finding the Developer's Diary Inside",
     "retro", "ars.technica.com → 1.6k points · 278 comments"],
  ],
  [
    ["Show HN: Obsidian plugin that turns your notes into a knowledge graph you can fly through",
     "tools", "github.com → 1.4k points · 302 comments"],
    ["My company replaced standups with async voice memos. Here's what happened.",
     "work", "blog.loom.com → 2.3k points · 677 comments"],
    ["Thread: The quietest, most satisfying way to keep a personal todo list",
     "lowtech", "Ask HN → 2.9k points · 844 comments"],
  ],
  [
    ["Figma's billion-dollar near-death experience: the Adobe deal that didn't happen",
     "failures", "bloomberg.com → 3.4k points · 523 comments"],
    ["AI agents now pass the 10,000-hour rule in under a week — a new benchmark",
     "newtech", "arxiv.org → 1.7k points · 398 comments"],
    ["On Improving, Slowly: Notes from Year 4 of Learning to Play Piano at 40",
     "growth", "manyu.substack.com → 1.1k points · 243 comments"],
  ],
];

// Personas: keyed by top category
const PERSONAS = {
  tools: {
    icon: "🔧",
    name: "The Tool Collector",
    desc: "You're drawn to anything that makes the craft sharper. Your bookmarks folder is a goldmine — or a landfill, depending on who you ask. You've built at least three 'productivity systems' for managing your productivity systems. Jon scored 13 on tools in 2017. You'd get along."
  },
  failures: {
    icon: "💀",
    name: "The Postmortem Enthusiast",
    desc: "Where others see ruins, you see curriculum. You've memorized the Google Graveyard and you have opinions about why Google Reader died. You don't root against companies — you just find failure so much more *instructive* than success. Morbidly curious in the best possible way."
  },
  lowtech: {
    icon: "🌿",
    name: "The Digital Minimalist",
    desc: "You believe the best technology is often invisible — or doesn't exist yet. You've considered a dumb phone. You've definitely read 'Deep Work.' You have a notebook with a satisfying paper weight that you reach for before opening a new tab. Radical simplicity as a superpower."
  },
  retro: {
    icon: "💾",
    name: "The Digital Archaeologist",
    desc: "Computing history is your mythology. You read about the Xerox PARC days like others read Homer. You believe the best ideas were often discovered 40 years ago and just need rediscovering. You've used an emulator purely for fun and you have feelings about the IIGS."
  },
  engineering: {
    icon: "⚙️",
    name: "The Code Craftsman",
    desc: "You care deeply about how the sausage is made. Not just that it works, but *why* it works, and whether it could be made 20% more elegant. You've read the GoF book and can name five design patterns off the top of your head. Code is your medium, precision is your religion."
  },
  newtech: {
    icon: "🚀",
    name: "The Early Adopter",
    desc: "You've been tracking a technology since before most people had heard of it. You find roadmaps genuinely exciting. You've beta-tested more apps than you can remember and your opinions on neural interfaces are well-formed and ready to deliver. The future can't get here fast enough."
  },
  work: {
    icon: "🏢",
    name: "The Workplace Philosopher",
    desc: "You've seen the inside of too many meetings that could have been emails, and you have thoughts. You collect case studies about remote work, async communication, and organizational dysfunction. You believe companies are anthropology experiments and you've been quietly taking field notes."
  },
  growth: {
    icon: "🌱",
    name: "The Deliberate Practitioner",
    desc: "You track habits, study systems, and genuinely believe humans can rewire themselves through disciplined effort. You've read Dweck, Fogg, and at least two books about how the brain forms memories. You're not grinding — you're compounding. Slowly, patiently, and with meticulous notes."
  },
};

// =====================================================================
// STATE
// =====================================================================

let currentRound = 0;
let scores = { tools:0, failures:0, lowtech:0, retro:0, engineering:0, newtech:0, work:0, growth:0 };

// =====================================================================
// QUIZ LOGIC
// =====================================================================

function startQuiz() {
  document.getElementById('welcome').style.display = 'none';
  document.getElementById('quiz').style.display = 'block';
  currentRound = 0;
  scores = { tools:0, failures:0, lowtech:0, retro:0, engineering:0, newtech:0, work:0, growth:0 };
  showRound(0);
}

function showRound(idx) {
  const total = ROUNDS.length;
  document.getElementById('prog-label').textContent = `Question ${idx+1} of ${total}`;
  const pct = Math.round((idx / total) * 100);
  document.getElementById('prog-pct').textContent = pct + '%';
  document.getElementById('prog-fill').style.width = pct + '%';

  const round = ROUNDS[idx];
  const list = document.getElementById('headline-list');
  list.innerHTML = '';

  // Shuffle the 3 options so order isn't biased
  const shuffled = [...round].sort(() => Math.random() - 0.5);

  shuffled.forEach(([text, cat, meta], i) => {
    const btn = document.createElement('button');
    btn.className = 'headline-btn';
    btn.innerHTML = `
      <span>${text}</span>
      <span class="points">${meta}</span>
    `;
    btn.addEventListener('click', () => pick(cat, btn));
    list.appendChild(btn);
  });

  // Re-animate
  const area = document.getElementById('question-area');
  area.style.animation = 'none';
  area.offsetHeight; // reflow
  area.style.animation = '';
}

function pick(cat, btn) {
  // Highlight
  document.querySelectorAll('.headline-btn').forEach(b => b.classList.remove('selected'));
  btn.classList.add('selected');

  scores[cat]++;

  setTimeout(() => {
    currentRound++;
    if (currentRound < ROUNDS.length) {
      showRound(currentRound);
    } else {
      showResults();
    }
  }, 380);
}

function showResults() {
  document.getElementById('quiz').style.display = 'none';

  // Sort categories by score
  const sorted = Object.entries(scores).sort((a,b) => b[1]-a[1]);
  const topCat = sorted[0][0];
  const total = ROUNDS.length;

  // Persona
  const persona = PERSONAS[topCat];
  document.getElementById('res-icon').textContent = persona.icon;
  document.getElementById('res-name').textContent = persona.name;
  document.getElementById('res-desc').textContent = persona.desc;

  // Bars
  const chart = document.getElementById('bar-chart');
  chart.innerHTML = '';
  sorted.forEach(([cat, score]) => {
    if (score === 0) return;
    const pct = Math.round((score / total) * 100);
    const row = document.createElement('div');
    row.className = 'bar-row';
    row.innerHTML = `
      <div class="bar-label">
        <span class="name">${CATS[cat].name}</span>
        <span class="val">${score} pick${score !== 1 ? 's' : ''}</span>
      </div>
      <div class="bar-track">
        <div class="bar-fill" data-pct="${pct}" style="background:${CATS[cat].color}"></div>
      </div>
    `;
    chart.appendChild(row);
  });

  const results = document.getElementById('results');
  results.style.display = 'block';

  // Animate bars after small delay
  setTimeout(() => {
    document.querySelectorAll('.bar-fill').forEach(bar => {
      bar.style.width = bar.dataset.pct + '%';
    });
  }, 150);
}

function restartQuiz() {
  document.getElementById('results').style.display = 'none';
  startQuiz();
}
</script>
</body>
</html>
