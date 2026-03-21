<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Which Pride &amp; Prejudice Character Are You?</title>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --parchment: #f5efe0;
  --ink: #2c1810;
  --ink-light: #5a3e2b;
  --ink-faint: #8c6a4e;
  --accent: #8b1a1a;
  --accent-light: #c0392b;
  --gold: #c9a84c;
  --gold-light: #e8d5a3;
  --border: #c8a86e;
  --shadow: rgba(44, 24, 16, 0.15);
}

body {
  font-family: Georgia, 'Times New Roman', serif;
  background: #2c1810;
  background-image: 
    repeating-linear-gradient(
      45deg,
      transparent,
      transparent 2px,
      rgba(255,255,255,0.015) 2px,
      rgba(255,255,255,0.015) 4px
    );
  min-height: 100vh;
  padding: 24px 16px 48px;
  color: var(--ink);
}

.page-wrapper {
  max-width: 680px;
  margin: 0 auto;
}

/* Header */
.header {
  text-align: center;
  background: var(--parchment);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  border: 2px solid var(--border);
  border-radius: 4px;
  padding: 36px 32px 28px;
  margin-bottom: 20px;
  position: relative;
  box-shadow: 0 4px 24px var(--shadow), inset 0 1px 0 rgba(255,255,255,0.5);
}

.header::before, .header::after {
  content: '❧';
  position: absolute;
  top: 12px;
  color: var(--gold);
  font-size: 1.2em;
}
.header::before { left: 16px; }
.header::after { right: 16px; }

.header-ornament {
  font-size: 1.6em;
  color: var(--gold);
  letter-spacing: 0.3em;
  margin-bottom: 12px;
  line-height: 1;
}

h1 {
  font-size: clamp(1.5em, 5vw, 2.2em);
  font-style: italic;
  color: var(--ink);
  line-height: 1.2;
  margin-bottom: 10px;
  font-weight: normal;
}

h1 em {
  font-style: normal;
  color: var(--accent);
}

.subtitle {
  font-size: 0.9em;
  color: var(--ink-light);
  font-style: italic;
  letter-spacing: 0.05em;
}

.divider {
  text-align: center;
  color: var(--gold);
  font-size: 1.2em;
  letter-spacing: 0.5em;
  margin: 14px 0 0;
}

/* Quiz container */
.quiz-card {
  background: var(--parchment);
  border: 2px solid var(--border);
  border-radius: 4px;
  padding: 28px 28px 24px;
  box-shadow: 0 4px 24px var(--shadow);
}

/* Progress */
.progress-area {
  margin-bottom: 24px;
}

.progress-label {
  display: flex;
  justify-content: space-between;
  font-size: 0.78em;
  color: var(--ink-faint);
  letter-spacing: 0.08em;
  text-transform: uppercase;
  margin-bottom: 6px;
}

.progress-track {
  height: 6px;
  background: rgba(0,0,0,0.1);
  border-radius: 3px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--gold), var(--accent));
  border-radius: 3px;
  transition: width 0.4s ease;
}

/* Question */
.question-num {
  font-size: 0.75em;
  color: var(--gold);
  letter-spacing: 0.1em;
  text-transform: uppercase;
  margin-bottom: 8px;
  font-family: 'Palatino Linotype', Palatino, serif;
}

.question-text {
  font-size: 1.15em;
  color: var(--ink);
  line-height: 1.6;
  margin-bottom: 22px;
  font-style: italic;
}

/* Options */
.options {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.option-btn {
  background: transparent;
  border: 1px solid var(--border);
  border-radius: 3px;
  padding: 12px 16px;
  text-align: left;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 0.92em;
  color: var(--ink-light);
  line-height: 1.45;
  transition: all 0.2s ease;
  position: relative;
  padding-left: 40px;
}

.option-btn::before {
  content: attr(data-letter);
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  width: 20px;
  height: 20px;
  border: 1px solid var(--border);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.78em;
  color: var(--gold);
  font-family: Georgia, serif;
}

.option-btn:hover {
  background: rgba(201, 168, 76, 0.12);
  border-color: var(--gold);
  color: var(--ink);
  transform: translateX(3px);
}

.option-btn:hover::before {
  background: var(--gold);
  color: var(--parchment);
  border-color: var(--gold);
}

.option-btn.selected {
  background: rgba(139, 26, 26, 0.08);
  border-color: var(--accent);
  color: var(--ink);
}

.option-btn.selected::before {
  background: var(--accent);
  color: var(--parchment);
  border-color: var(--accent);
}

/* Navigation */
.nav-area {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 24px;
  padding-top: 20px;
  border-top: 1px solid var(--gold-light);
}

.nav-btn {
  background: transparent;
  border: 1px solid var(--border);
  border-radius: 3px;
  padding: 8px 20px;
  font-family: Georgia, serif;
  font-size: 0.85em;
  color: var(--ink-light);
  cursor: pointer;
  letter-spacing: 0.05em;
  transition: all 0.2s ease;
}

.nav-btn:hover:not(:disabled) {
  background: var(--ink);
  color: var(--parchment);
  border-color: var(--ink);
}

.nav-btn:disabled {
  opacity: 0.3;
  cursor: default;
}

.nav-btn.primary {
  background: var(--accent);
  border-color: var(--accent);
  color: var(--parchment);
  font-weight: bold;
  padding: 8px 28px;
}

.nav-btn.primary:hover:not(:disabled) {
  background: #6b1414;
  border-color: #6b1414;
}

/* Result screen */
.result-card {
  display: none;
  background: var(--parchment);
  border: 2px solid var(--border);
  border-radius: 4px;
  padding: 32px;
  box-shadow: 0 4px 24px var(--shadow);
  text-align: center;
}

.result-card.visible {
  display: block;
}

.result-portrait {
  width: 120px;
  height: 120px;
  margin: 0 auto 20px;
  border-radius: 50%;
  border: 3px solid var(--gold);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3em;
  background: linear-gradient(135deg, var(--gold-light), var(--parchment));
  box-shadow: 0 4px 16px var(--shadow);
}

.result-you-are {
  font-size: 0.8em;
  color: var(--gold);
  letter-spacing: 0.2em;
  text-transform: uppercase;
  margin-bottom: 6px;
}

.result-name {
  font-size: 2em;
  font-style: italic;
  color: var(--ink);
  margin-bottom: 4px;
  line-height: 1.2;
}

.result-tagline {
  font-size: 0.9em;
  color: var(--accent);
  font-style: italic;
  margin-bottom: 20px;
}

.result-divider {
  text-align: center;
  color: var(--gold);
  letter-spacing: 0.5em;
  margin: 16px 0;
}

.result-desc {
  font-size: 0.95em;
  color: var(--ink-light);
  line-height: 1.75;
  margin-bottom: 20px;
  text-align: left;
}

.result-quote {
  border-left: 3px solid var(--gold);
  padding: 10px 16px;
  margin: 16px 0;
  font-style: italic;
  color: var(--ink-faint);
  font-size: 0.9em;
  line-height: 1.6;
  text-align: left;
}

.traits-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  margin: 16px 0;
}

.trait-pill {
  background: rgba(201, 168, 76, 0.12);
  border: 1px solid var(--gold-light);
  border-radius: 20px;
  padding: 5px 12px;
  font-size: 0.8em;
  color: var(--ink-light);
  letter-spacing: 0.04em;
}

.runner-up {
  background: rgba(0,0,0,0.04);
  border: 1px solid var(--gold-light);
  border-radius: 3px;
  padding: 12px 16px;
  margin-top: 16px;
  font-size: 0.85em;
  color: var(--ink-faint);
  text-align: left;
}

.runner-up strong {
  color: var(--ink-light);
}

.retry-btn {
  background: transparent;
  border: 1px solid var(--border);
  border-radius: 3px;
  padding: 10px 28px;
  font-family: Georgia, serif;
  font-size: 0.9em;
  color: var(--ink-light);
  cursor: pointer;
  letter-spacing: 0.05em;
  margin-top: 20px;
  transition: all 0.2s ease;
}

.retry-btn:hover {
  background: var(--ink);
  color: var(--parchment);
  border-color: var(--ink);
}

/* Footer */
.footer-note {
  text-align: center;
  margin-top: 20px;
  font-size: 0.75em;
  color: #8c6a4e;
  font-style: italic;
}

.footer-note a { color: #c9a84c; }

/* Responsive */
@media (max-width: 480px) {
  .quiz-card, .result-card { padding: 20px 16px; }
  .header { padding: 28px 20px 20px; }
  .traits-grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

<div class="page-wrapper">

  <div class="header">
    <div class="header-ornament">— ❦ —</div>
    <h1>Which <em>Pride &amp; Prejudice</em><br>Character Are You?</h1>
    <p class="subtitle">A Quiz in the Manner of Miss Jane Austen</p>
    <div class="divider">· · · ❧ · · ·</div>
  </div>

  <!-- Quiz Card -->
  <div class="quiz-card" id="quizCard">
    <div class="progress-area">
      <div class="progress-label">
        <span id="progressLabel">Question 1 of 10</span>
        <span id="progressPct">0%</span>
      </div>
      <div class="progress-track">
        <div class="progress-fill" id="progressFill" style="width:0%"></div>
      </div>
    </div>

    <div class="question-num" id="questionNum">Question I</div>
    <div class="question-text" id="questionText"></div>
    <div class="options" id="optionsContainer"></div>

    <div class="nav-area">
      <button class="nav-btn" id="prevBtn" onclick="navigate(-1)" disabled>← Back</button>
      <button class="nav-btn primary" id="nextBtn" onclick="navigate(1)" disabled>Next →</button>
    </div>
  </div>

  <!-- Result Card -->
  <div class="result-card" id="resultCard">
    <div class="result-portrait" id="resultEmoji"></div>
    <div class="result-you-are">You are most like…</div>
    <div class="result-name" id="resultName"></div>
    <div class="result-tagline" id="resultTagline"></div>
    <div class="result-divider">· · · ❧ · · ·</div>
    <div class="result-desc" id="resultDesc"></div>
    <blockquote class="result-quote" id="resultQuote"></blockquote>
    <div class="traits-grid" id="traitsGrid"></div>
    <div class="runner-up" id="runnerUp"></div>
    <button class="retry-btn" onclick="resetQuiz()">✦ Begin Again</button>
  </div>

  <p class="footer-note">
    Inspired by Jon's daily morning reading — his 
    <a href="https://www.jona.ca/2026/02/chloe-reads-jon.html" target="_blank">OpenClaw cron job</a> 
    reads him the next chapter of <em>Pride and Prejudice</em> at 9am each day. ☕
  </p>

</div>

<script>
const ROMAN = ['I','II','III','IV','V','VI','VII','VIII','IX','X'];
const LETTERS = ['A','B','C','D','E'];

// Characters: id, name, emoji, tagline, desc, quote, traits
const CHARACTERS = {
  elizabeth: {
    name: "Elizabeth Bennet",
    emoji: "💃",
    tagline: "Witty, independent, and not easily impressed.",
    desc: "You're sharp, self-possessed, and thoroughly unwilling to be talked into anything you don't believe in. You assess people quickly — sometimes too quickly — but your judgments are usually more right than wrong. You value your own mind above all things, and you find nothing more attractive in another person than genuine intelligence paired with genuine humility. You can laugh at yourself, which is half the battle.",
    quote: '"I could easily forgive his pride, if he had not mortified mine." — Elizabeth Bennet',
    traits: ["Quick-witted", "Independent", "Principled", "Self-aware", "A little stubborn", "Deeply loyal"]
  },
  darcy: {
    name: "Mr. Darcy",
    emoji: "🎩",
    tagline: "Reserved, exacting, and secretly very decent.",
    desc: "You appear cold to those who don't know you — and you're fine with that. You have high standards and you're not about to lower them to make acquaintances feel comfortable. But the people who've earned your trust know that underneath the formality there's someone who shows up when it matters, keeps their word without making a show of it, and would walk through a fire for the people they love. You just wish they'd let you be quiet about it.",
    quote: '"In vain I have struggled. It will not do. My feelings will not be repressed." — Mr. Darcy',
    traits: ["Principled", "Private", "Loyal", "Exacting", "Slow to warm", "Deeply honourable"]
  },
  jane: {
    name: "Jane Bennet",
    emoji: "🌸",
    tagline: "Gentle, kind, and determined to see the best.",
    desc: "You are genuinely, unaffectedly good — and you have an almost supernatural ability to find the charitable reading of any situation. Some might call this naïve; you'd call it a choice. You know the world contains unpleasant people, but you see no point in stewing in that knowledge when you could simply enjoy the pleasant ones. People love you easily and you love them back with a warmth that never turns possessive.",
    quote: '"To be fond of dancing was a certain step towards falling in love." — Narrator, of Jane',
    traits: ["Kind", "Charitable", "Graceful", "Gentle", "Avoids conflict", "Beloved by all"]
  },
  bingley: {
    name: "Mr. Bingley",
    emoji: "☀️",
    tagline: "Cheerful, open, and genuinely delightful.",
    desc: "You walk into a room and the temperature goes up a few degrees. You're not putting it on — you actually find people interesting and you're willing to say so. You're sometimes too easily steered by people whose opinions you trust, but that's mostly because you assume good faith and you hate to be the source of conflict. Your friends adore you. Your enemies don't know what to make of you.",
    quote: '"To be fond of a person is not the same as to be in love — but it\'s a very good beginning." — Bingley, approximately',
    traits: ["Enthusiastic", "Sociable", "Good-natured", "A bit trusting", "Warm", "Easy to like"]
  },
  charlotte: {
    name: "Charlotte Lucas",
    emoji: "📋",
    tagline: "Practical, clear-eyed, and quietly formidable.",
    desc: "You are not a cynic — you're simply someone who looks at the world clearly and decides what to do from there. You don't wait around for perfect; you look at what's available, weigh it honestly, and make a decision you can live with. People sometimes mistake your pragmatism for coldness. They're wrong. You feel things deeply; you just know the difference between feeling and deciding. That's rarer than people think.",
    quote: '"Happiness in marriage is entirely a matter of chance." — Charlotte Lucas',
    traits: ["Pragmatic", "Clear-headed", "Decisive", "Quietly warm", "Unsentimental", "Reliable"]
  },
  lydia: {
    name: "Lydia Bennet",
    emoji: "🎭",
    tagline: "Fearless, impulsive, and full of life.",
    desc: "You don't do things by halves. When you're excited, everyone in a two-mile radius knows it; when you're bored, you'll create entertainment where none exists. You live in the present tense — what's fun now? What's happening tonight? You have a talent for joy, even if your relationship with consequences is... complicated. You're exhausting in the best way, and the people who can keep up with you wouldn't trade it for anything.",
    quote: '"Lord, how I should like to be married before any of you!" — Lydia Bennet',
    traits: ["Spontaneous", "Fun-loving", "Bold", "Present-focused", "Impulsive", "Irrepressible"]
  },
  collins: {
    name: "Mr. Collins",
    emoji: "📜",
    tagline: "Earnest, rule-following, and acutely rank-conscious.",
    desc: "You believe in doing things correctly. There are proper ways to behave and improper ways, and you've taken the time to learn the distinction — a distinction you feel others might do well to attend to. You're not unkind; you're thorough. You may occasionally be described as 'a bit much,' but you know your own worth and you're not going to hide it under a bushel. If anything, you've found that projecting confidence tends to open doors.",
    quote: '"I have often observed how little young ladies are interested by books of a serious stamp, though written solely for their benefit." — Mr. Collins',
    traits: ["Punctilious", "Status-conscious", "Earnest", "Self-important", "Rule-following", "Unstoppable"]
  },
  mary: {
    name: "Mary Bennet",
    emoji: "📚",
    tagline: "Studious, sincere, and a tad earnest.",
    desc: "While the rest of the room is gossiping and dancing, you've got opinions about what you've been reading lately. You take ideas seriously. You work hard at things that interest you and you'd rather have a substantive conversation than a charming one. You sometimes misjudge your audience — not everyone wants to discuss moral philosophy at eleven o'clock at night — but your depth of conviction is genuinely admirable, and the right people know it.",
    quote: '"Vanity and pride are different things, though the words are often used synonymously." — Mary Bennet',
    traits: ["Intellectual", "Earnest", "Diligent", "Slightly awkward", "Deep thinker", "Underrated"]
  },
  wickham: {
    name: "Mr. Wickham",
    emoji: "🪄",
    tagline: "Charming, compelling, and complicated.",
    desc: "You are extraordinarily easy to like, and you know it. You have a gift for making people feel seen and interesting — which they notice, appreciate, and remember. Your story is always compelling, your manner always warm. Where you sometimes go astray is in the gap between the story you tell and the one you've actually lived. Deep down you want people to admire you, which is understandable — just be careful about the shortcuts you're tempted to take to get there.",
    quote: '"He had all the best part of beauty — a fine countenance, a good figure, and a very pleasing address." — Narrator, of Wickham',
    traits: ["Charming", "Persuasive", "Sociable", "Compelling", "Complicated", "Hard to resist"]
  },
  ladycatherine: {
    name: "Lady Catherine de Bourgh",
    emoji: "👑",
    tagline: "Direct, opinionated, and not the least bit interested in your objections.",
    desc: "You have opinions and you share them. Why wouldn't you? You're right. You've spent considerable time thinking about how things ought to be done, and you see no reason to soften the results for the benefit of people who haven't thought nearly as hard. Some call you overbearing. You'd say thorough. Some call you imperious. You'd say principled. Either way, the conversation moves faster when you're in it, which — you'd argue — is a service to everyone.",
    quote: '"I am not to be trifled with. But I shall not be in a hurry to believe any thing of the sort." — Lady Catherine',
    traits: ["Direct", "Certain", "Formidable", "Traditional", "Imperious", "Utterly decisive"]
  }
};

// Questions
const QUESTIONS = [
  {
    text: "You arrive at a lively party where you know almost no one. What do you do?",
    options: [
      { text: "Find a quiet corner and observe — you'll form opinions before you introduce yourself.", scores: { darcy: 3, elizabeth: 2, mary: 2 } },
      { text: "Dive in and talk to everyone. New people are interesting, almost without exception.", scores: { bingley: 3, lydia: 2, jane: 1 } },
      { text: "Identify the most important people in the room and work your way toward them.", scores: { collins: 3, ladycatherine: 2, wickham: 1 } },
      { text: "Charm whoever you land next to — a clever conversation is its own reward.", scores: { wickham: 3, elizabeth: 1, lydia: 1 } },
      { text: "Smile, be warm, assume everyone is perfectly agreeable until proven otherwise.", scores: { jane: 3, bingley: 1, charlotte: 1 } }
    ]
  },
  {
    text: "Someone wrongs you — quite deliberately. How do you respond?",
    options: [
      { text: "You're hurt, but you try to find the most charitable explanation possible.", scores: { jane: 3, bingley: 2 } },
      { text: "You note it, say nothing for now, and revisit it if it becomes a pattern.", scores: { darcy: 3, charlotte: 2, elizabeth: 1 } },
      { text: "You fire back — quickly and precisely. Then you let it go.", scores: { elizabeth: 3, ladycatherine: 1 } },
      { text: "You don't confront them. You're more subtle about it.", scores: { wickham: 3, mary: 1 } },
      { text: "You tell them exactly what you think, loudly and immediately, and move on.", scores: { lydia: 3, ladycatherine: 2 } }
    ]
  },
  {
    text: "A friend asks for your honest opinion about a decision they've already made. It's not a great decision.",
    options: [
      { text: "You tell them the truth — gently, but clearly. They asked.", scores: { elizabeth: 3, charlotte: 2, darcy: 1 } },
      { text: "You listen, validate their feelings, and hope things work out.", scores: { jane: 3, bingley: 2 } },
      { text: "You give the practical assessment. They need information, not comfort.", scores: { charlotte: 3, darcy: 2 } },
      { text: "You share your view at some length — really quite a lot of length.", scores: { collins: 3, ladycatherine: 2, mary: 1 } },
      { text: "You tell them what they want to hear. Why make it worse?", scores: { wickham: 2, bingley: 1, lydia: 1 } }
    ]
  },
  {
    text: "What is your most honest flaw?",
    options: [
      { text: "I form strong first impressions and occasionally have to walk them back.", scores: { elizabeth: 3, darcy: 2 } },
      { text: "I trust people too easily and am disappointed more than I should be.", scores: { jane: 3, bingley: 2 } },
      { text: "I say what I think, and not everyone is ready for it.", scores: { ladycatherine: 3, mary: 2, darcy: 1 } },
      { text: "I act before I think and sometimes have to deal with the aftermath.", scores: { lydia: 3, wickham: 1 } },
      { text: "I let situations drift when I should make a decision.", scores: { bingley: 2, jane: 1 } }
    ]
  },
  {
    text: "What quality do you most want in a close friend?",
    options: [
      { text: "Honesty — someone who will tell me when I'm wrong.", scores: { elizabeth: 3, darcy: 2, charlotte: 1 } },
      { text: "Warmth — someone who genuinely cares and shows it.", scores: { jane: 3, bingley: 2 } },
      { text: "Wit — someone who can match me in conversation.", scores: { elizabeth: 2, wickham: 2, lydia: 1 } },
      { text: "Reliability — someone who does what they say they'll do.", scores: { charlotte: 3, darcy: 1 } },
      { text: "Good standing — someone whose company reflects well on both of us.", scores: { collins: 3, ladycatherine: 2 } }
    ]
  },
  {
    text: "Your ideal Sunday afternoon looks like:",
    options: [
      { text: "A long walk and some time to think. Movement and quiet, in that order.", scores: { darcy: 3, elizabeth: 2, mary: 1 } },
      { text: "A lively gathering — people, conversation, maybe a dance later.", scores: { bingley: 3, lydia: 2 } },
      { text: "Reading something substantial. You've had that book for two weeks and keep not finishing it.", scores: { mary: 3, elizabeth: 1 } },
      { text: "Visiting people — there are always visits to be made and news to be exchanged.", scores: { collins: 2, charlotte: 2, jane: 1 } },
      { text: "Something spontaneous. You'll decide when you get there.", scores: { lydia: 3, wickham: 1 } }
    ]
  },
  {
    text: "How do you feel about tradition and doing things 'the proper way'?",
    options: [
      { text: "Tradition exists for good reasons. It holds things together.", scores: { ladycatherine: 3, collins: 2, darcy: 1 } },
      { text: "Some traditions are worth keeping; others are just habits no one's examined.", scores: { elizabeth: 3, charlotte: 1 } },
      { text: "I follow the conventions that matter and don't worry about the ones that don't.", scores: { charlotte: 3, wickham: 1 } },
      { text: "Honestly, a bit overrated. If something is fun, why not?", scores: { lydia: 3, bingley: 1 } },
      { text: "I appreciate elegance and order, but I lead with kindness first.", scores: { jane: 2, bingley: 1, darcy: 1 } }
    ]
  },
  {
    text: "People who know you well would most likely describe you as:",
    options: [
      { text: "Sharp. Has opinions and isn't shy about them, but earns it.", scores: { elizabeth: 3, ladycatherine: 1 } },
      { text: "The most genuinely nice person they know. Possibly an angel.", scores: { jane: 3, bingley: 1 } },
      { text: "Reliable. Always there. Figures things out without drama.", scores: { charlotte: 3, darcy: 1 } },
      { text: "A lot of fun. Maybe a little exhausting, but worth it.", scores: { lydia: 3, wickham: 1 } },
      { text: "A bit much sometimes, but astonishingly well-read.", scores: { mary: 3, collins: 1 } }
    ]
  },
  {
    text: "Someone new arrives in your social circle who is very charming. You:",
    options: [
      { text: "Enjoy their company but reserve judgment until you know them better.", scores: { elizabeth: 3, darcy: 2 } },
      { text: "Warm to them immediately. Charm is lovely and you choose to enjoy it.", scores: { jane: 3, bingley: 2 } },
      { text: "Assess their position and prospects before deciding how much time to give them.", scores: { collins: 3, ladycatherine: 2 } },
      { text: "Are drawn in and a bit distracted by them for a while.", scores: { lydia: 3, elizabeth: 1 } },
      { text: "Note what they want and decide whether you're able to provide it.", scores: { charlotte: 3, wickham: 1 } }
    ]
  },
  {
    text: "Finish this sentence: The most important thing to know about love is...",
    options: [
      { text: "...that esteem and mutual respect are the only reliable foundations.", scores: { elizabeth: 3, darcy: 2, mary: 1 } },
      { text: "...that kindness between people is more than enough.", scores: { jane: 3, bingley: 2 } },
      { text: "...that you can't afford to wait for perfect when good is in front of you.", scores: { charlotte: 3, wickham: 1 } },
      { text: "...that it's the best feeling there is and you pursue it without apology.", scores: { lydia: 3 } },
      { text: "...that it is a serious matter deserving serious deliberation and considerable letters.", scores: { collins: 3, darcy: 1, mary: 1 } }
    ]
  }
];

let current = 0;
let answers = {}; // question index → selected option index

function buildQuestion() {
  const q = QUESTIONS[current];
  document.getElementById('questionNum').textContent = `Question ${ROMAN[current]}`;
  document.getElementById('questionText').textContent = q.text;
  
  const container = document.getElementById('optionsContainer');
  container.innerHTML = '';
  
  q.options.forEach((opt, i) => {
    const btn = document.createElement('button');
    btn.className = 'option-btn';
    btn.setAttribute('data-letter', LETTERS[i]);
    btn.textContent = opt.text;
    if (answers[current] === i) btn.classList.add('selected');
    btn.onclick = () => selectOption(i);
    container.appendChild(btn);
  });
  
  updateProgress();
  updateNav();
}

function selectOption(idx) {
  answers[current] = idx;
  document.querySelectorAll('.option-btn').forEach((b, i) => {
    b.classList.toggle('selected', i === idx);
  });
  updateNav();
}

function updateProgress() {
  const pct = Math.round((Object.keys(answers).length / QUESTIONS.length) * 100);
  const filled = Math.round(((current) / QUESTIONS.length) * 100);
  document.getElementById('progressLabel').textContent = `Question ${current + 1} of ${QUESTIONS.length}`;
  document.getElementById('progressPct').textContent = pct + '% answered';
  document.getElementById('progressFill').style.width = filled + '%';
}

function updateNav() {
  document.getElementById('prevBtn').disabled = current === 0;
  const nextBtn = document.getElementById('nextBtn');
  
  if (current === QUESTIONS.length - 1) {
    nextBtn.textContent = 'Reveal My Character →';
    nextBtn.disabled = answers[current] === undefined;
  } else {
    nextBtn.textContent = 'Next →';
    nextBtn.disabled = answers[current] === undefined;
  }
}

function navigate(dir) {
  if (dir === 1 && current === QUESTIONS.length - 1) {
    showResult();
    return;
  }
  current = Math.max(0, Math.min(QUESTIONS.length - 1, current + dir));
  buildQuestion();
}

function computeScores() {
  const totals = {};
  Object.keys(CHARACTERS).forEach(k => totals[k] = 0);
  
  Object.entries(answers).forEach(([qIdx, optIdx]) => {
    const scores = QUESTIONS[qIdx].options[optIdx].scores;
    Object.entries(scores).forEach(([char, pts]) => {
      totals[char] = (totals[char] || 0) + pts;
    });
  });
  
  return totals;
}

function showResult() {
  const scores = computeScores();
  const sorted = Object.entries(scores).sort((a, b) => b[1] - a[1]);
  const winner = sorted[0][0];
  const runnerUp = sorted[1][0];
  
  const ch = CHARACTERS[winner];
  const ru = CHARACTERS[runnerUp];
  
  document.getElementById('resultEmoji').textContent = ch.emoji;
  document.getElementById('resultName').textContent = ch.name;
  document.getElementById('resultTagline').textContent = ch.tagline;
  document.getElementById('resultDesc').textContent = ch.desc;
  document.getElementById('resultQuote').textContent = ch.quote;
  
  const grid = document.getElementById('traitsGrid');
  grid.innerHTML = ch.traits.map(t => `<div class="trait-pill">✦ ${t}</div>`).join('');
  
  document.getElementById('runnerUp').innerHTML = 
    `<strong>Close second:</strong> You also share notable qualities with ${ru.name} — ${ru.tagline}`;
  
  document.getElementById('quizCard').style.display = 'none';
  const resultCard = document.getElementById('resultCard');
  resultCard.classList.add('visible');
  resultCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function resetQuiz() {
  current = 0;
  answers = {};
  document.getElementById('resultCard').classList.remove('visible');
  document.getElementById('quizCard').style.display = 'block';
  buildQuestion();
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Init
buildQuestion();
</script>
</body>
</html>
