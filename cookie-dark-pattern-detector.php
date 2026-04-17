<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cookie Dark Pattern Detector</title>
  <link rel="preconnect"abay" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=DM+Mono:ital,wght@0,400;0,500;1,400&family=Space+Grotesk:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg: #0d0d0f;
      --surface: #16161a;
      --surface2: #1e1e24;
      --border: #2a2a35;
      --text: #e8e8ec;
      --muted: #6b6b80;
      --accent: #ff4f5e;
      --accent-dim: rgba(255, 79, 94, 0.15);
      --green: #3ecf8e;
      --green-dim: rgba(62, 207, 142, 0.15);
      --amber: #f5a623;
      --amber-dim: rgba(245, 166, 35, 0.15);
    }

    body {
      font-family: 'Space Grotesk', system-ui, sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Noise texture overlay */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 0;
    }

    .container {
      max-width: 720px;
      margin: 0 auto;
      padding: 32px 20px 64px;
      position: relative;
      z-index: 1;
    }

    /* Header */
    header {
      text-align: center;
      margin-bottom: 48px;
    }

    .badge {
      display: inline-block;
      font-family: 'DM Mono', monospace;
      font-size: 0.7rem;
      letter-spacing: 0.15em;
      text-transform: uppercase;
      color: var(--accent);
      background: var(--accent-dim);
      border: 1px solid rgba(255,79,94,0.3);
      border-radius: 100px;
      padding: 4px 12px;
      margin-bottom: 20px;
    }

    h1 {
      font-size: clamp(2rem, 6vw, 3rem);
      font-weight: 700;
      letter-spacing: -0.03em;
      line-height: 1.1;
      margin-bottom: 14px;
    }

    h1 span {
      color: var(--accent);
    }

    .subtitle {
      color: var(--muted);
      font-size: 1rem;
      line-height: 1.6;
      max-width: 480px;
      margin: 0 auto;
    }

    /* Progress */
    .progress-bar-wrap {
      background: var(--border);
      border-radius: 8px;
      height: 6px;
      margin-bottom: 36px;
      overflow: hidden;
    }
    .progress-bar {
      height: 100%;
      background: linear-gradient(90deg, var(--accent), #ff7b85);
      border-radius: 8px;
      transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      width: 0%;
    }

    /* Card */
    .card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 24px;
      animation: slideUp 0.4s ease;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Cookie Banner Mock */
    .banner-mock {
      background: #f0f0f5;
      padding: 0;
      position: relative;
    }

    .banner-inner {
      padding: 18px 20px 16px;
    }

    .banner-text {
      font-family: system-ui, -apple-system, sans-serif;
      font-size: 0.82rem;
      color: #1a1a2e;
      line-height: 1.5;
      margin-bottom: 14px;
    }

    .banner-buttons {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .banner-btn {
      font-family: system-ui, -apple-system, sans-serif;
      font-size: 0.78rem;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 8px;
      border: none;
      cursor: default;
      transition: transform 0.1s;
      white-space: nowrap;
    }

    /* Quiz area */
    .quiz-area {
      padding: 24px 24px 20px;
    }

    .question-label {
      font-family: 'DM Mono', monospace;
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 10px;
    }

    .pattern-question {
      font-size: 1.05rem;
      font-weight: 600;
      line-height: 1.4;
      margin-bottom: 20px;
      color: var(--text);
    }

    /* Choices */
    .choices {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    @media (max-width: 480px) {
      .choices { grid-template-columns: 1fr; }
    }

    .choice {
      background: var(--surface2);
      border: 2px solid var(--border);
      border-radius: 12px;
      padding: 12px 14px;
      cursor: pointer;
      transition: all 0.2s;
      text-align: left;
      font-family: 'Space Grotesk', system-ui, sans-serif;
      font-size: 0.88rem;
      color: var(--text);
      line-height: 1.4;
    }

    .choice:hover:not(.locked) {
      border-color: var(--accent);
      background: var(--accent-dim);
      transform: translateY(-1px);
    }

    .choice.correct {
      border-color: var(--green);
      background: var(--green-dim);
    }

    .choice.wrong {
      border-color: var(--accent);
      background: var(--accent-dim);
    }

    .choice.locked {
      cursor: default;
      opacity: 0.7;
    }

    .choice.locked.correct,
    .choice.locked.wrong {
      opacity: 1;
    }

    /* Feedback */
    .feedback {
      margin-top: 16px;
      border-radius: 12px;
      padding: 14px 16px;
      display: none;
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .feedback.show { display: block; }

    .feedback.correct {
      background: var(--green-dim);
      border: 1px solid rgba(62,207,142,0.3);
    }

    .feedback.wrong {
      background: var(--accent-dim);
      border: 1px solid rgba(255,79,94,0.3);
    }

    .feedback-title {
      font-weight: 700;
      font-size: 0.9rem;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .feedback.correct .feedback-title { color: var(--green); }
    .feedback.wrong .feedback-title { color: var(--accent); }

    .feedback-text {
      font-size: 0.85rem;
      color: var(--muted);
      line-height: 1.6;
    }

    /* Next button */
    .next-btn {
      display: none;
      width: 100%;
      margin-top: 14px;
      padding: 14px;
      background: var(--accent);
      color: #fff;
      border: none;
      border-radius: 12px;
      font-family: 'Space Grotesk', system-ui, sans-serif;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
      letter-spacing: 0.02em;
    }

    .next-btn:hover {
      background: #ff6b77;
      transform: translateY(-1px);
    }

    .next-btn.show { display: block; }

    /* Score screen */
    .score-screen {
      display: none;
      text-align: center;
      padding: 40px 24px;
      animation: slideUp 0.5s ease;
    }

    .score-screen.show { display: block; }

    .score-number {
      font-size: 5rem;
      font-weight: 700;
      letter-spacing: -0.04em;
      line-height: 1;
      margin-bottom: 8px;
    }

    .score-number.good { color: var(--green); }
    .score-number.ok { color: var(--amber); }
    .score-number.bad { color: var(--accent); }

    .score-of {
      font-size: 1.1rem;
      color: var(--muted);
      margin-bottom: 20px;
    }

    .score-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 12px;
    }

    .score-desc {
      color: var(--muted);
      font-size: 0.92rem;
      line-height: 1.7;
      max-width: 400px;
      margin: 0 auto 28px;
    }

    .score-bar-wrap {
      background: var(--border);
      border-radius: 8px;
      height: 10px;
      max-width: 400px;
      margin: 0 auto 28px;
      overflow: hidden;
    }

    .score-bar {
      height: 100%;
      border-radius: 8px;
      transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .restart-btn {
      padding: 14px 32px;
      background: var(--surface2);
      border: 2px solid var(--border);
      border-radius: 12px;
      color: var(--text);
      font-family: 'Space Grotesk', system-ui, sans-serif;
      font-size: 0.95rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s;
    }

    .restart-btn:hover {
      border-color: var(--accent);
      background: var(--accent-dim);
    }

    /* Pattern tag on banner */
    .pattern-tag {
      position: absolute;
      top: 10px;
      right: 10px;
      font-family: 'DM Mono', monospace;
      font-size: 0.6rem;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 3px 8px;
      border-radius: 100px;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .pattern-tag.show { opacity: 1; }
    .pattern-tag.dark { background: var(--accent-dim); color: var(--accent); border: 1px solid rgba(255,79,94,0.3); }
    .pattern-tag.clean { background: var(--green-dim); color: var(--green); border: 1px solid rgba(62,207,142,0.3); }

    /* Hidden */
    .hidden { display: none !important; }

    /* Footer */
    footer {
      text-align: center;
      color: var(--muted);
      font-size: 0.75rem;
      margin-top: 48px;
      font-family: 'DM Mono', monospace;
    }
  </style>
</head>
<body>
<div class="container">

  <header>
    <div class="badge">Interactive Quiz</div>
    <h1>Cookie Dark Pattern<br><span>Detector</span></h1>
    <p class="subtitle">Cookie banners are everywhere. Some are honest. Some are trying to trick you. Can you spot the difference?</p>
  </header>

  <div class="progress-bar-wrap">
    <div class="progress-bar" id="progressBar"></div>
  </div>

  <!-- Quiz Card -->
  <div id="quizCard">
    <div class="card">
      <div class="banner-mock" id="bannerMock">
        <span class="pattern-tag" id="patternTag"></span>
        <div class="banner-inner" id="bannerInner"></div>
      </div>
      <div class="quiz-area">
        <div class="question-label" id="questionNum">Pattern 1 of 10</div>
        <div class="pattern-question" id="patternQuestion"></div>
        <div class="choices" id="choices"></div>
        <div class="feedback" id="feedback">
          <div class="feedback-title" id="feedbackTitle"></div>
          <div class="feedback-text" id="feedbackText"></div>
        </div>
        <button class="next-btn" id="nextBtn">Next Pattern</button>
      </div>
    </div>
  </div>

  <!-- Score Screen -->
  <div class="score-screen" id="scoreScreen">
    <div class="card">
      <div style="padding: 40px 24px">
        <div class="score-number" id="scoreNumber"></div>
        <div class="score-of" id="scoreOf">out of 10</div>
        <div class="score-bar-wrap">
          <div class="score-bar" id="scoreBar"></div>
        </div>
        <div class="score-title" id="scoreTitle"></div>
        <div class="score-desc" id="scoreDesc"></div>
        <button class="restart-btn" onclick="restart()">Try Again</button>
      </div>
    </div>
  </div>

  <footer>
    Inspired by Jon's post on sneaky cookie banners
  </footer>
</div>

<script>
const PATTERNS = [
  {
    text: "We value your privacy! Accept all cookies to help us personalize your experience and remember your preferences.",
    buttons: [
      { label: "Accept All Cookies", style: "background:#2563eb;color:#fff;" },
      { label: "Manage Preferences", style: "background:#e8e8f0;color:#333;" },
    ],
    isDark: false,
    darkLabel: "Honest Design",
    explanation: "This banner is honest. The 'Accept All' button is prominent but 'Manage Preferences' is clearly visible and accessible. No tricks.",
  },
  {
    text: "🍪 We use cookies to enhance your browsing experience. By continuing, you agree to our use of cookies.",
    buttons: [
      { label: "Sounds Good!", style: "background:#4f46e5;color:#fff;" },
      { label: "No Thanks", style: "background:#e5e5e5;color:#666;" },
    ],
    isDark: true,
    darkLabel: "Positive Framing Trap",
    explanation: "The 'Sounds Good!' language is aggressively casual and friendly — making 'No Thanks' feel like you're ruining a nice moment. Dark patterns use language to make the privacy-invasive option feel good.",
    question: "This banner uses a sneaky dark pattern called 'Positive Framing.' Which button is being nudged?",
    choices: [
      { label: "The 'No Thanks' button", answer: false },
      { label: "The 'Sounds Good!' button", answer: true },
      { label: "Neither — this is fine", answer: false },
    ],
    correctIdx: 1,
  },
  {
    text: "Your privacy choices:",
    buttons: [
      { label: "✅ Accept All", style: "background:#16a34a;color:#fff;font-size:0.85rem;padding:10px 18px;" },
      { label: "Reject All", style: "background:#f3f4f6;color:#9ca3af;font-size:0.7rem;padding:6px 10px;" },
    ],
    isDark: true,
    darkLabel: "Weight Disparity",
    explanation: "'Accept All' is large, green, and checkmarked. 'Reject All' is small, gray, and de-emphasized. Both technically exist but one is designed to win. That's a weight disparity dark pattern.",
    question: "This banner uses 'Weight Disparity' — one option is visually favoured. Which one is getting the nudge?",
    choices: [
      { label: "Accept All — larger and green", answer: true },
      { label: "Reject All — smaller and gray", answer: false },
      { label: "Neither — both are equal", answer: false },
    ],
    correctIdx: 0,
  },
  {
    text: "🔒 Your data is safe with us. We only share your information with trusted advertising partners.",
    buttons: [
      { label: "Continue", style: "background:#e5e7eb;color:#333;" },
    ],
    isDark: false,
    darkLabel: "Honest Minimal",
    explanation: "A minimal banner with no manipulative language. 'Continue' is neutral and doesn't pressure acceptance. It's sparse but not deceptive.",
  },
  {
    text: "We use cookies to remember your login, preferences, and site features. You can accept or decline non-essential cookies below.",
    buttons: [
      { label: "Accept All", style: "background:#dbeafe;color:#1d4ed8;" },
      { label: "Decline Non-Essential", style: "background:#fef9c3;color:#854d0e;" },
    ],
    isDark: true,
    darkLabel: "Ambiguous Language",
    explanation: "'Decline Non-Essential' is confusing. Users have to parse the difference between 'cookies' and 'non-essential cookies' to understand that declining is even an option. Clear language would say simply 'Reject All' or 'Decline.'",
    question: "This banner uses 'Ambiguous Language.' What's the problem?",
    choices: [
      { label: "'Decline Non-Essential' is confusing wording", answer: true },
      { label: "The blue button is too prominent", answer: false },
      { label: "Nothing — this is very clear", answer: false },
    ],
    correctIdx: 0,
  },
  {
    text: "🍪 Enable all cookies for the best experience! You'll get personalised recommendations, faster checkout, and exclusive member-only deals.",
    buttons: [
      { label: "Enable All 🍪", style: "background:#f59e0b;color:#fff;" },
      { label: "No, I don't like deals", style: "background:#e5e7eb;color:#666;" },
    ],
    isDark: true,
    darkLabel: "Disadvantageous Comparison",
    explanation: "'No, I don't like deals' is a sneer. It frames rejecting cookies as being personally against good things. The phrasing is designed to make you feel silly for opting out.",
    question: "The 'No, I don't like deals' button uses 'Disadvantageous Comparison.' What's it trying to do?",
    choices: [
      { label: "Make rejecting feel like a personal failing", answer: true },
      { label: "Give you accurate information about deals", answer: false },
      { label: "Make the banner look more colourful", answer: false },
    ],
    correctIdx: 0,
  },
  {
    text: "By clicking anywhere on this page or continuing to browse, you consent to cookie usage in accordance with our policy.",
    buttons: [
      { label: "I Understand", style: "background:#6b7280;color:#fff;" },
    ],
    isDark: true,
    darkLabel: "Count-as-Acceptance",
    explanation: "Scroll or click anywhere = consent. That's 'count as acceptance.' You didn't actively agree to anything — you were just using the website — and yet you're counted as having accepted.",
    question: "This is 'Count-as-Acceptance' — what counts as agreeing here?",
    choices: [
      { label: "Clicking 'I Understand'", answer: false },
      { label: "Clicking anywhere or scrolling", answer: true },
      { label: "Doing nothing at all", answer: false },
    ],
    correctIdx: 1,
  },
  {
    text: "Accept all cookies to support independent journalism and keep our content free.",
    buttons: [
      { label: "Accept For Free Content", style: "background:#dc2626;color:#fff;" },
      { label: "Pay £5/month to manage preferences", style: "background:#f3f4f6;color:#333;" },
    ],
    isDark: true,
    darkLabel: "Bundled Consent",
    explanation: "Paying money is framed as an alternative to accepting cookies. That's bundled consent — tying cookie consent to payment. Privacy should never have a paywall.",
    question: "This banner uses 'Bundled Consent' — what's the dark pattern here?",
    choices: [
      { label: "Paying is presented as the only alternative to tracking", answer: true },
      { label: "The red button is too eye-catching", answer: false },
      { label: "Nothing — this is just a subscription offer", answer: false },
    ],
    correctIdx: 0,
  },
  {
    text: "This website uses essential cookies for core functionality. You can manage non-essential cookie preferences below.",
    buttons: [
      { label: "Accept All", style: "background:#e5e7eb;color:#333;" },
      { label: "Reject All", style: "background:#e5e7eb;color:#333;" },
      { label: "Show preferences", style: "background:#e5e7eb;color:#333;" },
    ],
    isDark: false,
    darkLabel: "Genuinely Neutral",
    explanation: "Three equal options. 'Accept All' is not styled as the default or the 'good' choice. 'Reject All' is equally prominent. This is the gold standard of cookie banners.",
  },
  {
    text: "🍪 Customise your cookie experience — toggle each category on or off below. Essential cookies cannot be disabled.",
    buttons: [
      { label: "⚙️ Manage Preferences", style: "background:#1a1a2e;color:#fff;" },
      { label: "Accept All", style: "background:#e5e7eb;color:#666;" },
    ],
    isDark: true,
    darkLabel: "Hide the Reject",
    explanation: "The only path to actually manage your privacy is 'Manage Preferences' — and that's styled as the primary action. 'Accept All' is there but de-emphasised. The company doesn't want you to accept; they want you to customise (and get lost in a wall of checkboxes).",
    question: "This banner 'Hides the Reject' option. What's the trick?",
    choices: [
      { label: "'Manage Preferences' leads to a confusing submenu", answer: true },
      { label: "'Accept All' is too prominent", answer: false },
      { label: "The cookie icon is distracting", answer: false },
    ],
    correctIdx: 0,
  },
];

let current = 0;
let correct = 0;

function shuffle(arr) {
  const a = [...arr];
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}

function renderBanner(p) {
  const inner = document.getElementById('bannerInner');
  const tag = document.getElementById('patternTag');

  let html = `<div class="banner-text">${p.text}</div><div class="banner-buttons">`;
  for (const btn of p.buttons) {
    html += `<button class="banner-btn" style="${btn.style}">${btn.label}</button>`;
  }
  html += '</div>';
  inner.innerHTML = html;
  tag.className = 'pattern-tag';
  tag.textContent = '';
}

function renderQuiz(idx) {
  const p = PATTERNS[idx];
  renderBanner(p);

  const qNum = document.getElementById('questionNum');
  const q = document.getElementById('patternQuestion');
  const choicesEl = document.getElementById('choices');
  const feedback = document.getElementById('feedback');
  const nextBtn = document.getElementById('nextBtn');

  qNum.textContent = `Pattern ${idx + 1} of ${PATTERNS.length}`;

  feedback.className = 'feedback';
  feedback.style.display = 'none';
  nextBtn.classList.remove('show');

  if (!p.isDark) {
    // Honest banner — no question, just explanation
    q.textContent = "This banner is one of the honest ones. No dark pattern here — you can continue!";
    choicesEl.innerHTML = `<button class="choice" onclick="showHonest()">
      <span style="color:var(--green)">✓</span> This looks fine — continue
    </button>`;
    return;
  }

  q.textContent = p.question;

  const shuffled = p.choices.map((c, i) => ({ ...c, origIdx: i }));
  const shuffled2 = shuffle(shuffled);

  choicesEl.innerHTML = shuffled2.map((c, i) => `
    <button class="choice" data-idx="${c.origIdx}" onclick="pick(this, ${c.origIdx}, ${p.correctIdx})">
      ${c.label}
    </button>
  `).join('');
}

function showHonest() {
  const p = PATTERNS[current];
  const feedback = document.getElementById('feedback');
  feedback.className = 'feedback correct show';
  feedback.innerHTML = `
    <div class="feedback-title">✓ Clean Design</div>
    <div class="feedback-text">${p.explanation}</div>
  `;
  document.getElementById('nextBtn').classList.add('show');
}

function pick(btn, chosen, correct) {
  const btns = document.querySelectorAll('.choice');
  btns.forEach(b => {
    b.classList.add('locked');
    const idx = parseInt(b.dataset.idx);
    if (idx === correct) b.classList.add('correct');
    b.onclick = null;
  });

  if (chosen === correct) {
    btn.classList.add('correct');
    correct++;
  } else {
    btn.classList.add('wrong');
  }

  const p = PATTERNS[current];
  const feedback = document.getElementById('feedback');
  feedback.className = `feedback ${chosen === correct ? 'correct' : 'wrong'} show`;
  feedback.innerHTML = `
    <div class="feedback-title">${chosen === correct ? '✓ Correct!' : '✗ Not quite'}</div>
    <div class="feedback-text">${p.explanation}</div>
  `;

  document.getElementById('nextBtn').classList.add('show');

  if (current < PATTERNS.length - 1) {
    document.getElementById('nextBtn').textContent = 'Next Pattern';
  } else {
    document.getElementById('nextBtn').textContent = 'See Your Score';
  }
}

function nextQuestion() {
  current++;
  if (current >= PATTERNS.length) {
    showScore();
    return;
  }
  document.getElementById('progressBar').style.width = `${(current / PATTERNS.length) * 100}%`;
  renderQuiz(current);
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.getElementById('nextBtn').addEventListener('click', nextQuestion);

function showScore() {
  document.getElementById('progressBar').style.width = '100%';
  document.getElementById('quizCard').classList.add('hidden');
  const ss = document.getElementById('scoreScreen');
  ss.classList.add('show');

  const pct = correct / PATTERNS.length;
  const numEl = document.getElementById('scoreNumber');
  const scoreBar = document.getElementById('scoreBar');

  if (pct >= 0.8) {
    numEl.textContent = correct;
    numEl.className = 'score-number good';
    scoreBar.style.background = 'var(--green)';
    document.getElementById('scoreTitle').textContent = "Dark Pattern Expert!";
    document.getElementById('scoreDesc').textContent =
      "You spotted nearly all the tricks. Companies won't fool you with sneaky cookie banners — you read every word and push back against manipulative design.";
  } else if (pct >= 0.5) {
    numEl.textContent = correct;
    numEl.className = 'score-number ok';
    scoreBar.style.background = 'var(--amber)';
    document.getElementById('scoreTitle').textContent = "Getting Wary";
    document.getElementById('scoreDesc').textContent =
      "You caught the obvious ones, but some of the sneakier patterns slipped by. Watch out for positive framing and weight disparity especially.";
  } else {
    numEl.textContent = correct;
    numEl.className = 'score-number bad';
    scoreBar.style.background = 'var(--accent)';
    document.getElementById('scoreTitle').textContent = "Privacy Apprentice";
    document.getElementById('scoreDesc').textContent =
      "Cookie banners are designed to deceive, and you caught on to some of them. Next time you see one of these tricks you'll know what's going on.";
  }

  scoreBar.style.width = '0%';
  setTimeout(() => {
    scoreBar.style.width = `${pct * 100}%`;
  }, 100);
}

function restart() {
  current = 0;
  correct = 0;
  document.getElementById('quizCard').classList.remove('hidden');
  document.getElementById('scoreScreen').classList.remove('show');
  document.getElementById('progressBar').style.width = '0%';
  renderQuiz(0);
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Init
renderQuiz(0);
</script>
</body>
</html>
