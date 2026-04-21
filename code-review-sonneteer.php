<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Code Review Sonneteer</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,600;1,400&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0d0b14;
      --parchment: #f0e6d2;
      --gold: #c9a84c;
      --gold-dim: #8a6d2a;
      --ink: #1a1520;
      --quill: #7b5ea7;
      --quill-light: #a888d4;
      --muted: #6b6280;
      --meter-strong: #e8b84b;
      --meter-weak: #7a9e6a;
      --glow: rgba(201,168,76,0.18);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      background: var(--bg);
      color: var(--parchment);
      font-family: 'Crimson Pro', Georgia, serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 32px 16px 64px;
      overflow-x: hidden;
    }

    /* Ambient background glow */
    body::before {
      content: '';
      position: fixed;
      top: -30%;
      left: 50%;
      transform: translateX(-50%);
      width: 800px;
      height: 600px;
      background: radial-gradient(ellipse at center, rgba(123,94,167,0.12) 0%, transparent 70%);
      pointer-events: none;
      z-index: 0;
    }

    .container {
      max-width: 680px;
      width: 100%;
      position: relative;
      z-index: 1;
    }

    header {
      text-align: center;
      margin-bottom: 40px;
    }

    .quill-icon {
      font-size: 2.4em;
      margin-bottom: 8px;
      display: block;
      filter: drop-shadow(0 0 12px var(--quill-light));
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(-5deg); }
      50% { transform: translateY(-8px) rotate(3deg); }
    }

    h1 {
      font-size: 2.4em;
      font-weight: 600;
      letter-spacing: 0.02em;
      color: var(--gold);
      text-shadow: 0 0 40px rgba(201,168,76,0.4);
      margin-bottom: 8px;
    }

    .subtitle {
      color: var(--muted);
      font-style: italic;
      font-size: 1.1em;
      line-height: 1.5;
      max-width: 480px;
      margin: 0 auto;
    }

    /* Mode toggle */
    .mode-tabs {
      display: flex;
      gap: 4px;
      background: rgba(255,255,255,0.04);
      border-radius: 12px;
      padding: 4px;
      margin-bottom: 28px;
      border: 1px solid rgba(201,168,76,0.15);
    }

    .mode-tab {
      flex: 1;
      padding: 10px 8px;
      border: none;
      background: transparent;
      color: var(--muted);
      font-family: 'Crimson Pro', serif;
      font-size: 0.95em;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.25s ease;
    }

    .mode-tab:hover {
      color: var(--parchment);
      background: rgba(255,255,255,0.05);
    }

    .mode-tab.active {
      background: var(--quill);
      color: #fff;
      box-shadow: 0 2px 12px rgba(123,94,167,0.4);
    }

    /* Card */
    .card {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(201,168,76,0.12);
      border-radius: 16px;
      padding: 28px;
      margin-bottom: 20px;
    }

    .card-label {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.72em;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: var(--gold-dim);
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .card-label::before {
      content: '//';
      opacity: 0.5;
    }

    textarea {
      width: 100%;
      min-height: 120px;
      background: rgba(0,0,0,0.3);
      border: 1px solid rgba(201,168,76,0.2);
      border-radius: 10px;
      color: var(--parchment);
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.88em;
      padding: 14px;
      resize: vertical;
      outline: none;
      transition: border-color 0.2s;
      line-height: 1.6;
    }

    textarea:focus {
      border-color: var(--quill);
      box-shadow: 0 0 20px rgba(123,94,167,0.15);
    }

    textarea::placeholder {
      color: var(--muted);
      opacity: 0.6;
    }

    .btn-row {
      display: flex;
      gap: 10px;
      margin-top: 14px;
    }

    .btn {
      flex: 1;
      padding: 12px 20px;
      border: none;
      border-radius: 10px;
      font-family: 'Crimson Pro', serif;
      font-size: 1em;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--quill), #6040a0);
      color: #fff;
      box-shadow: 0 4px 20px rgba(123,94,167,0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 28px rgba(123,94,167,0.45);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    .btn-secondary {
      background: rgba(255,255,255,0.06);
      color: var(--parchment);
      border: 1px solid rgba(201,168,76,0.2);
    }

    .btn-secondary:hover {
      background: rgba(255,255,255,0.1);
      border-color: var(--gold-dim);
    }

    /* Output */
    .output-card {
      display: none;
    }

    .output-card.visible {
      display: block;
    }

    .verse-container {
      background: rgba(0,0,0,0.35);
      border: 1px solid rgba(201,168,76,0.18);
      border-radius: 12px;
      padding: 24px;
      position: relative;
      overflow: hidden;
    }

    .verse-container::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--gold), transparent);
      opacity: 0.6;
    }

    .verse-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 16px;
    }

    .verse-num {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.72em;
      color: var(--quill-light);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .meter-badge {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.68em;
      background: rgba(201,168,76,0.12);
      border: 1px solid rgba(201,168,76,0.25);
      color: var(--gold);
      padding: 3px 8px;
      border-radius: 20px;
    }

    .verse-lines {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .verse-line {
      font-size: 1.25em;
      line-height: 1.6;
      color: var(--parchment);
      padding: 4px 8px;
      border-radius: 6px;
      transition: background 0.2s;
    }

    .verse-line:hover {
      background: rgba(255,255,255,0.04);
    }

    .verse-line .syllable {
      transition: color 0.15s;
    }

    .verse-line .syllable.strong {
      color: var(--meter-strong);
      font-weight: 600;
    }

    .verse-line .syllable.weak {
      color: var(--meter-weak);
    }

    .verse-line .rhyme-tag {
      font-size: 0.7em;
      margin-left: 6px;
      opacity: 0.5;
      vertical-align: super;
      font-family: 'JetBrains Mono', monospace;
    }

    .verse-meta {
      display: flex;
      gap: 16px;
      margin-top: 16px;
      padding-top: 14px;
      border-top: 1px solid rgba(201,168,76,0.08);
    }

    .meta-item {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.72em;
      color: var(--muted);
    }

    .meta-item span {
      color: var(--gold-dim);
    }

    .copy-success {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.75em;
      color: var(--meter-weak);
      text-align: right;
      margin-top: 8px;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .copy-success.show {
      opacity: 1;
    }

    /* Shuffle scenario */
    .scenario-card {
      display: none;
      margin-bottom: 20px;
    }

    .scenario-card.visible {
      display: block;
    }

    .scenario-box {
      background: rgba(123,94,167,0.08);
      border: 1px solid rgba(123,94,167,0.25);
      border-radius: 12px;
      padding: 18px 20px;
      position: relative;
    }

    .scenario-box::before {
      content: '⚡';
      position: absolute;
      top: -10px;
      left: 18px;
      background: var(--bg);
      padding: 0 6px;
      font-size: 0.9em;
    }

    .scenario-label {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.7em;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: var(--quill-light);
      margin-bottom: 8px;
    }

    .scenario-text {
      font-size: 1.1em;
      color: var(--parchment);
      font-style: italic;
      line-height: 1.5;
    }

    /* Meter guide */
    .meter-guide {
      background: rgba(0,0,0,0.25);
      border: 1px solid rgba(201,168,76,0.08);
      border-radius: 10px;
      padding: 16px 20px;
      margin-top: 24px;
    }

    .meter-guide-title {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.72em;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--muted);
      margin-bottom: 10px;
    }

    .meter-visual {
      display: flex;
      gap: 4px;
      align-items: center;
      flex-wrap: wrap;
    }

    .meter-unit {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 3px;
    }

    .meter-syms {
      display: flex;
      gap: 2px;
    }

    .meter-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    .meter-dot.strong {
      background: var(--meter-strong);
      box-shadow: 0 0 6px var(--meter-strong);
    }

    .meter-dot.weak {
      background: var(--meter-weak);
    }

    .meter-label {
      font-family: 'JetBrains Mono', monospace;
      font-size: 0.6em;
      color: var(--muted);
    }

    .meter-arrow {
      color: var(--muted);
      font-size: 0.8em;
      margin: 0 4px;
      align-self: center;
    }

    /* Animations */
    @keyframes fadeSlideIn {
      from { opacity: 0; transform: translateY(12px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes lineReveal {
      from { opacity: 0; transform: translateX(-8px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .verse-line {
      animation: lineReveal 0.3s ease forwards;
      opacity: 0;
    }

    .output-card.visible .verse-line:nth-child(1) { animation-delay: 0.05s; }
    .output-card.visible .verse-line:nth-child(2) { animation-delay: 0.12s; }
    .output-card.visible .verse-line:nth-child(3) { animation-delay: 0.19s; }
    .output-card.visible .verse-line:nth-child(4) { animation-delay: 0.26s; }
    .output-card.visible .verse-line:nth-child(5) { animation-delay: 0.33s; }
    .output-card.visible .verse-line:nth-child(6) { animation-delay: 0.40s; }
    .output-card.visible .verse-line:nth-child(7) { animation-delay: 0.47s; }
    .output-card.visible .verse-line:nth-child(8) { animation-delay: 0.54s; }

    .verse-container {
      animation: fadeSlideIn 0.4s ease;
    }

    .btn-row { animation: fadeSlideIn 0.3s ease; }

    /* Footer note */
    .footer-note {
      margin-top: 32px;
      text-align: center;
      font-style: italic;
      color: var(--muted);
      font-size: 0.9em;
      line-height: 1.6;
    }

    .footer-note a {
      color: var(--quill-light);
      text-decoration: none;
    }

    .footer-note a:hover {
      text-decoration: underline;
    }

    /* Mobile */
    @media (max-width: 520px) {
      h1 { font-size: 1.8em; }
      .card { padding: 20px 16px; }
      .verse-line { font-size: 1.05em; }
    }
  </style>
</head>
<body>
<div class="container">
  <header>
    <span class="quill-icon">✒️</span>
    <h1>The Code Review Sonneteer</h1>
    <p class="subtitle">Transform thy code review feedback into iambic pentameter. 'Tis a craft most rare and precious.</p>
  </header>

  <div class="mode-tabs">
    <button class="mode-tab active" data-mode="convert">Convert</button>
    <button class="mode-tab" data-mode="shuffle">Random Scenario</button>
    <button class="mode-tab" data-mode="learn">Learn the Meter</button>
  </div>

  <!-- Convert Mode -->
  <div id="mode-convert">
    <div class="card">
      <div class="card-label">Paste thy code review feedback</div>
      <textarea id="feedback-input" placeholder="e.g. 'This function is way too long. Please split it up. Also the variable naming is confusing.'"></textarea>
      <div class="btn-row">
        <button class="btn btn-primary" id="convert-btn">
          <span>⚔</span> Poeticize
        </button>
        <button class="btn btn-secondary" id="shuffle-btn-top">
          <span>🎲</span> Random Scenario
        </button>
      </div>
    </div>

    <div class="card output-card" id="output-card">
      <div class="card-label">Thy verse, fair开发者</div>
      <div class="verse-container">
        <div class="verse-header">
          <span class="verse-num" id="verse-num">Verse #1</span>
          <span class="meter-badge" id="meter-badge">10 syllables × 4</span>
        </div>
        <div class="verse-lines" id="verse-lines"></div>
        <div class="verse-meta">
          <span class="meta-item">Meter: <span id="meta-meter">Iambic Pentameter</span></span>
          <span class="meta-item">Rhyme: <span id="meta-rhyme">ABAB</span></span>
          <span class="meta-item">Form: <span id="meta-form">Quatrain</span></span>
        </div>
      </div>
      <div class="copy-success" id="copy-success">Copied to clipboard!</div>
    </div>
  </div>

  <!-- Shuffle Mode -->
  <div id="mode-shuffle" style="display:none;">
    <div class="scenario-card visible" id="scenario-box">
      <div class="scenario-box">
        <div class="scenario-label">Thy Challenge</div>
        <div class="scenario-text" id="scenario-text">Click "Shuffle" to receive a code review scenario, then write thy feedback below.</div>
      </div>
    </div>

    <div class="card">
      <div class="card-label">Write thy code review feedback</div>
      <textarea id="scenario-input" placeholder="e.g. 'This endpoint needs authentication checks before returning data.'"></textarea>
      <div class="btn-row">
        <button class="btn btn-primary" id="shuffle-new-btn">
          <span>🎲</span> Shuffle Scenario
        </button>
        <button class="btn btn-secondary" id="convert-scenario-btn">
          <span>⚔</span> Poeticize
        </button>
      </div>
    </div>

    <div class="card output-card" id="scenario-output-card">
      <div class="card-label">Thy verse, fair开发者</div>
      <div class="verse-container">
        <div class="verse-header">
          <span class="verse-num" id="s-verse-num">Verse #1</span>
          <span class="meter-badge" id="s-meter-badge">10 syllables × 4</span>
        </div>
        <div class="verse-lines" id="s-verse-lines"></div>
        <div class="verse-meta">
          <span class="meta-item">Meter: <span>Iambic Pentameter</span></span>
          <span class="meta-item">Rhyme: <span id="s-meta-rhyme">ABAB</span></span>
          <span class="meta-item">Form: <span>Quatrain</span></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Learn Mode -->
  <div id="mode-learn" style="display:none;">
    <div class="card">
      <div class="card-label">The Art of Iambic Pentameter</div>
      <p style="color: var(--parchment); font-size:1.05em; line-height:1.7; margin-bottom:16px;">
        <strong style="color:var(--gold)">Iambic Pentameter</strong> is a poetic meter with five iambic feet per line. Each foot is an unstressed syllable followed by a stressed syllable: <em>da-DUM</em>.
      </p>
      <p style="color: var(--parchment); font-size:1.05em; line-height:1.7; margin-bottom:16px;">
        That gives us <strong style="color:var(--gold)">10 syllables</strong> per line, alternating weak-strong-weak-strong-weak-strong-weak-strong-weak-strong.
      </p>
      <p style="color: var(--parchment); font-size:1.05em; line-height:1.7;">
        <strong style="color:var(--gold)">Thy code review in verse:</strong> When thou writest code reviews in iambic pentameter, even harsh criticism sounds like a playful jest. Jon wrote 42 of them once, and the tradition was thus established.
      </p>
    </div>

    <div class="meter-guide">
      <div class="meter-guide-title">Iambic Foot Visualizer</div>
      <div class="meter-visual">
        <div class="meter-unit">
          <div class="meter-syms">
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
          </div>
          <span class="meter-label">da-DUM</span>
        </div>
        <span class="meter-arrow">+</span>
        <div class="meter-unit">
          <div class="meter-syms">
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
          </div>
          <span class="meter-label">da-DUM</span>
        </div>
        <span class="meter-arrow">+</span>
        <div class="meter-unit">
          <div class="meter-syms">
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
          </div>
          <span class="meter-label">da-DUM</span>
        </div>
        <span class="meter-arrow">+</span>
        <div class="meter-unit">
          <div class="meter-syms">
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
          </div>
          <span class="meter-label">da-DUM</span>
        </div>
        <span class="meter-arrow">+</span>
        <div class="meter-unit">
          <div class="meter-syms">
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
          </div>
          <span class="meter-label">da-DUM</span>
        </div>
        <span class="meter-arrow" style="margin-left:8px;">=</span>
        <div class="meter-unit">
          <div class="meter-syms">
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
            <div class="meter-dot weak"></div>
            <div class="meter-dot strong"></div>
          </div>
          <span class="meter-label" style="color:var(--gold)">10 syl</span>
        </div>
      </div>
    </div>

    <div class="card" style="margin-top:20px;">
      <div class="card-label">Example Transformations</div>
      <div id="examples-list" style="display:flex;flex-direction:column;gap:14px;margin-top:12px;"></div>
    </div>

    <div class="card" style="margin-top:20px;">
      <div class="card-label">Try Scansion</div>
      <p style="color:var(--muted);font-size:0.9em;margin-bottom:12px;">Mark the syllables: click a syllable to toggle STRESS (gold) or UNSTRESS (green).</p>
      <div id="scansion-line" style="font-family:'JetBrains Mono',monospace;font-size:1.1em;letter-spacing:0.05em;cursor:pointer;user-select:none;line-height:2;flex-wrap:wrap;display:flex;gap:4px;align-items:center;padding:16px;background:rgba(0,0,0,0.2);border-radius:8px;" onclick="toggleSyllable(event)"></div>
      <div id="scansion-result" style="margin-top:10px;font-family:'JetBrains Mono',monospace;font-size:0.8em;color:var(--muted);"></div>
      <div class="btn-row" style="margin-top:12px;">
        <button class="btn btn-secondary" onclick="resetScansion()" style="flex:1;">Reset</button>
        <button class="btn btn-primary" onclick="checkScansion()" style="flex:1;">Check Meter</button>
      </div>
    </div>
  </div>

  <p class="footer-note">
    Inspired by Jon's <a href="https://jona.ca/2015/11/code-reviews-in-iambic-pentameter.html" target="_blank">Code Reviews in Iambic Pentameter</a> — 42 actual code reviews written in Shakespearean verse.<br>
    'Twere an experiment most curious and rare.
  </p>
</div>

<script>
// Scenarios
const scenarios = [
  "Thy function doth exceed a hundred lines. 'Tis a labyrinth most foul.",
  "Ye variable names are mysterious as the void. Rename them post-haste.",
  "This commit message reads 'fixed stuff.' A sonnet it is not.",
  "No unit tests for this service. What sayest thou to the QA gods?",
  "Memory leak detected in the loop. The server weepeth.",
  "Hardcoded credentials in production. The security hound growls.",
  "This API response time exceeds three seconds. Users shall desert thee.",
  "The CSS specificity warth declared. Choose thy selectors wisely.",
  "Race condition in async handler. Two threads battle for the same data.",
  "Deprecated function called thrice. Time marches on and so should thy code.",
  "Magic numbers scattered about like autumn leaves. Define them in constants.",
  "Comment says 'magic happens here.' No fairy godmother present.",
  "SQL query built with string concat. The injection specter approaches.",
  "Global mutable state shared across modules. A most treacherous arrangement.",
  "No error handling in catch block. Thou dost swallow exceptions like a pelican.",
  "Duplicated logic across four services. DRY thy codebase, quoth the wizard.",
  "No pagination on the endpoint. The database table grows without end.",
  "Function named getData() but returns a boolean. A most bewildering contract.",
];

// Iambic pentameter word bank
const iambicLines = [
  "Thy function spans a hundred lines of code,",
  "A labyrinth most foul thou hast wrought here.",
  "No test coverage for this dark episode,",
  "The QA gods demand a sacrifice.",
  "Hardcoded secrets in the production dark,",
  "The security hound doth growl and bark.",
  "The API response crawls like a snail,",
  "Three seconds spent just waiting for the pale.",
  "Race conditions in the async dark,",
  "Two threads that fight oer the same data spark.",
  "Magic numbers scattered like the leaves,",
  "Of autumn wind through thy bare代码 trees.",
  "Comments say 'here magic happens' — but no,",
  "No fairy godmother dost guard this show.",
  "SQL built with string concat most foul,",
  "The injection specter comes to claim thy soul.",
  "Global state mutates across the files,",
  "A most treacherous architecture trials.",
  "No error handling in the catch of doom,",
  "Thou swallowest exceptions like a gloom.",
  "Duplicated logic clutters four modules,",
  "DRY, quoth the wizard, for thy code bundles.",
  "No pagination on this endpoint's shore,",
  "The database grows forevermore.",
  "getData() returns a boolean, not data,",
  "A most bewildering contract to obey.",
  "But soft! What code review comments appear,",
  "In iambic pentameter written clear!",
  "Thus endeth the sonnet, and so it goes,",
  "May thy next commit fix all of these woes.",
];

const rhymes = ['A','B','A','B','C','D','C','D','E','F','E','F'];
const rhymeWords = [
  ['code','abode','load','showed'],
  ['foul','howl','prowl','scowl'],
  ['sacrifice','price','twice','slice'],
  ['bark','dark','mark','shark'],
  ['slain','pain','vain','grain'],
  ['leaves','weaves','cleaves','thieves'],
  ['soul','whole','bowl','toll'],
  ['files','whiles','smiles','tiles'],
  ['doom','gloom','boom','loom'],
  ['bundles','troubles','rubble','double'],
  ['shore','more','core','sore'],
  ['obey','delay','display','convey'],
  ['appear','hear','fear','dear'],
  ['clear','here','near','year'],
  ['goes','knows','flows','shows'],
  ['woes','closed','posed','dozed'],
];

let verseCount = 1;
let currentLines = [];

// Mode switching
document.querySelectorAll('.mode-tab').forEach(tab => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.mode-tab').forEach(t => t.classList.remove('active'));
    tab.classList.add('active');
    const mode = tab.dataset.mode;
    document.getElementById('mode-convert').style.display = mode === 'convert' ? 'block' : 'none';
    document.getElementById('mode-shuffle').style.display = mode === 'shuffle' ? 'block' : 'none';
    document.getElementById('mode-learn').style.display = mode === 'learn' ? 'block' : 'none';
    if (mode === 'learn') loadExamples();
  });
});

// Syllable counting
function countSyllables(word) {
  word = word.toLowerCase().replace(/[^a-z]/g, '');
  if (word.length <= 3) return 1;
  const vowels = 'aeiouy';
  let count = 0;
  let prevVowel = false;
  for (let i = 0; i < word.length; i++) {
    const isVowel = vowels.includes(word[i]);
    if (isVowel && !prevVowel) count++;
    prevVowel = isVowel;
  }
  if (word.endsWith('e') && count > 1) count--;
  if (word.endsWith('le') && word.length > 2 && !vowels.includes(word[word.length-3])) count++;
  return Math.max(1, count);
}

function splitIntoSyllableTokens(text) {
  const words = text.match(/[a-zA-Z']+|[^\sa-zA-Z']+/g) || [];
  let tokens = [];
  words.forEach(w => {
    if (/^[a-zA-Z']+$/.test(w)) {
      const syls = countSyllables(w);
      if (syls === 1) {
        tokens.push({ text: w, strong: false });
      } else {
        const partLen = Math.ceil(w.length / syls);
        for (let i = 0; i < syls; i++) {
          const start = i * partLen;
          const len = i === syls - 1 ? w.length - start : partLen;
          tokens.push({ text: w.slice(start, start + len), strong: false });
        }
      }
    } else {
      tokens.push({ text: w, strong: false });
    }
  });
  return tokens;
}

function toVerseLine(input) {
  // Tokenize into syllables
  const tokens = splitIntoSyllableTokens(input);
  const totalSyls = tokens.length;

  // Try to construct 10 syllables
  let result = '';
  let sylCount = 0;
  let useWords = [];

  if (totalSyls <= 10) {
    // Pad with connector words
    const fillers = ['shall', 'doth', 'thy', 'the', 'a', 'to', 'of', 'in', 'on'];
    const needed = 10 - totalSyls;
    let idx = 0;
    for (let i = 0; i < tokens.length; i++) {
      if (sylCount === 5 && idx < fillers.length) {
        result += ' ' + fillers[idx++];
        sylCount++;
      }
      result += ' ' + tokens[i].text;
      sylCount++;
    }
    while (sylCount < 10 && idx < fillers.length) {
      result += ' ' + fillers[idx++];
      sylCount++;
    }
  } else {
    // Take first 10 syllables
    let count = 0;
    for (let i = 0; i < tokens.length && count < 10; i++) {
      result += ' ' + tokens[i].text;
      count++;
    }
    // Add 2 more to make it more natural
    for (let i = 10; i < tokens.length && count < 12; i++) {
      result += ' ' + tokens[i].text;
      count++;
    }
  }

  return result.trim();
}

function poeticize(input, targetSyls = 10) {
  if (!input.trim()) return null;
  const raw = input.toLowerCase().replace(/[^a-z0-9\s]/g, ' ').trim();

  // Extract key nouns and verbs
  const words = raw.split(/\s+/).filter(w => w.length > 2);
  const keyWords = words.slice(0, 8);

  // Build iambic template lines using Jon's real examples and extensions
  const templates = [
    "Thy code review comments, plain as day,",
    "But when in verse they come alive!",
    "Thus endeth the sonnet, and so it goes,",
    "May thy next commit fix all thy woes.",
  ];

  // For each key phrase, try to make iambic
  let lines = [];
  let rhymeIdx = 0;

  if (keyWords.length > 0) {
    const first = keyWords.slice(0, 5).join(' ');
    const firstLine = toVerseLine(first);
    if (firstLine) lines.push(firstLine);
  }

  // Fill remaining lines with thematically-relevant iambic lines
  const fillers = [
    "A labyrinth most foul thou hast wrought.",
    "The code review gods demand their due.",
    "No test coverage for this dark episode.",
    "But soft! What sonnet dost appear!",
    "Thus endeth the verse, and so it goes.",
    "May thy next commit fix all thy woes.",
    "In iambic pentameter composed.",
    "A craft most rare throughout the ages.",
  ];

  while (lines.length < 4) {
    lines.push(fillers[lines.length % fillers.length]);
  }

  return lines.slice(0, 4);
}

function renderVerse(lines, containerId, numId, badgeId, rhymeId) {
  const container = document.getElementById(containerId);
  container.innerHTML = '';

  lines.forEach((line, i) => {
    const div = document.createElement('div');
    div.className = 'verse-line';

    const tokens = splitIntoSyllableTokens(line);
    let html = '';
    let strongNext = true;
    tokens.forEach(tok => {
      if (/^[a-zA-Z']+$/.test(tok.text)) {
        const strong = strongNext;
        const cls = strong ? 'strong' : 'weak';
        html += `<span class="syllable ${cls}">${tok.text}</span> `;
        strongNext = !strongNext;
      } else {
        html += `<span class="syllable">${tok.text}</span> `;
      }
    });

    const rhymeTag = String.fromCharCode(65 + (i % 4));
    html += `<span class="rhyme-tag">[${rhymeTag}]</span>`;
    div.innerHTML = html;
    container.appendChild(div);
  });

  document.getElementById(numId).textContent = `Verse #${verseCount}`;
  document.getElementById(badgeId).textContent = `10 syllables × ${lines.length}`;
  document.getElementById(rhymeId).textContent = 'ABAB / CDCD';
}

document.getElementById('convert-btn').addEventListener('click', () => {
  const input = document.getElementById('feedback-input').value;
  const lines = poeticize(input);
  if (!lines) return;
  currentLines = lines;
  renderVerse(lines, 'verse-lines', 'verse-num', 'meter-badge', 'meta-rhyme');
  const card = document.getElementById('output-card');
  card.classList.add('visible');
  card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
});

document.getElementById('shuffle-btn-top').addEventListener('click', () => {
  document.querySelector('[data-mode="shuffle"]').click();
  shuffleScenario();
});

document.getElementById('shuffle-new-btn').addEventListener('click', shuffleScenario);

function shuffleScenario() {
  const s = scenarios[Math.floor(Math.random() * scenarios.length)];
  document.getElementById('scenario-text').textContent = s;
  document.getElementById('scenario-input').value = '';
  document.getElementById('scenario-output-card').classList.remove('visible');
}

document.getElementById('convert-scenario-btn').addEventListener('click', () => {
  const input = document.getElementById('scenario-input').value ||
    document.getElementById('scenario-text').textContent;
  const lines = poeticize(input);
  if (!lines) return;
  currentLines = lines;
  renderVerse(lines, 's-verse-lines', 's-verse-num', 's-meter-badge', 's-meta-rhyme');
  const card = document.getElementById('scenario-output-card');
  card.classList.add('visible');
  card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
});

// Copy to clipboard
document.addEventListener('keydown', (e) => {
  if ((e.ctrlKey || e.metaKey) && e.key === 'c' && document.getSelection().toString() === '') {
    // Fall through to normal copy
  }
});

// Copy verse
function copyVerse() {
  if (!currentLines.length) return;
  const text = currentLines.join('\n');
  navigator.clipboard.writeText(text).then(() => {
    const el = document.getElementById('copy-success');
    el.classList.add('show');
    setTimeout(() => el.classList.remove('show'), 2000);
  });
}

// Learn mode examples
const examples = [
  {
    feedback: "This function is too long.",
    verse: "Thy function spans a hundred lines of code,\nA labyrinth most foul thou hast wrought.",
    meter: "da-DUM da-DUM da-DUM da-DUM da-DUM",
  },
  {
    feedback: "No unit tests.",
    verse: "No test coverage for this dark episode,\nThe QA gods demand a sacrifice.",
    meter: "da-DUM da-DUM da-DUM da-DUM da-DUM",
  },
  {
    feedback: "Magic numbers everywhere.",
    verse: "Magic numbers scattered like the leaves,\nOf autumn wind through thy bare code trees.",
    meter: "da-DUM da-DUM da-DUM da-DUM da-DUM",
  },
];

function loadExamples() {
  const container = document.getElementById('examples-list');
  if (!container) return;
  container.innerHTML = '';
  examples.forEach((ex, i) => {
    const div = document.createElement('div');
    div.style.cssText = `
      padding: 14px 16px;
      background: rgba(123,94,167,0.06);
      border: 1px solid rgba(123,94,167,0.15);
      border-radius: 10px;
      animation: fadeSlideIn 0.4s ease ${i * 0.1}s both;
    `;
    div.innerHTML = `
      <div style="font-family:'JetBrains Mono',monospace;font-size:0.72em;color:var(--muted);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:6px;">Feedback</div>
      <div style="color:var(--parchment);font-size:0.95em;margin-bottom:10px;font-style:italic;">"${ex.feedback}"</div>
      <div style="font-family:'Crimson Pro',serif;font-size:1.1em;color:var(--gold);line-height:1.7;margin-bottom:6px;">${ex.verse.split('\n').map(l => l + '<br>').join('')}</div>
      <div style="font-family:'JetBrains Mono',monospace;font-size:0.7em;color:var(--meter-strong);letter-spacing:0.05em;">${ex.meter}</div>
    `;
    container.appendChild(div);
  });

  // Init scansion
  initScansion();
}

const scansionWord = "THY CODE REVIEW COMMENTS".split(/\s+/);
const scansionTokens = scansionWord.map(w => ({ text: w, strong: false }));
let scansionState = scansionTokens.map(() => false); // false = weak, true = strong

function initScansion() {
  const container = document.getElementById('scansion-line');
  if (!container) return;
  scansionState = scansionTokens.map(() => false);
  renderScansion();
}

function renderScansion() {
  const container = document.getElementById('scansion-line');
  if (!container) return;
  container.innerHTML = '';
  let tokenIdx = 0;
  scansionTokens.forEach((tok, i) => {
    const span = document.createElement('span');
    span.textContent = tok.text;
    span.style.cssText = `
      display: inline-block;
      padding: 3px 8px;
      border-radius: 6px;
      background: ${scansionState[i] ? 'rgba(201,168,76,0.25)' : 'rgba(122,158,106,0.2)'};
      color: ${scansionState[i] ? 'var(--meter-strong)' : 'var(--meter-weak)'};
      border: 1px solid ${scansionState[i] ? 'rgba(201,168,76,0.4)' : 'rgba(122,158,106,0.3)'};
      cursor: pointer;
      font-size: 1em;
      transition: all 0.15s;
      margin: 2px;
    `;
    span.onclick = () => {
      scansionState[i] = !scansionState[i];
      renderScansion();
    };
    container.appendChild(span);
    // Add space after each word except last
    if (i < scansionTokens.length - 1) {
      const sp = document.createElement('span');
      sp.textContent = ' ';
      container.appendChild(sp);
    }
  });
}

function toggleSyllable(e) {
  // handled by onclick on spans
}

function resetScansion() {
  scansionState = scansionTokens.map(() => false);
  document.getElementById('scansion-result').textContent = '';
  renderScansion();
}

function checkScansion() {
  // Expected: STRONG-weak STRONG-weak STRONG-weak STRONG-weak STRONG-weak
  // For "THY CODE REVIEW COMMENTS" = 5 words = 5 iambs
  // THy (weak-STRONG) CODE (weak-STRONG) REview (weak-STRONG) COMments (weak-STRONG)
  const expected = [false, true, false, true, false, true, false, true, false, true];
  // Wait, "THY CODE REVIEW COMMENTS" has different syllable counts
  // THY (1) CODE (1) RE-view (2) COM-ments (2) = 6 syllables = 3 iambs
  // Actually let's check: THY=1, CODE=1, RE-VIEW=2, COM-MENTS=2 = 6 syllables

  const el = document.getElementById('scansion-result');
  const syllCounts = scansionTokens.map(t => countSyllables(t.text));
  const totalSyls = syllCounts.reduce((a,b) => a+b, 0);
  const numIambs = Math.floor(totalSyls / 2);

  el.innerHTML = `
    <span style="color:var(--gold)">${totalSyls} syllables</span> /
    <span style="color:var(--quill-light)">${numIambs} iambic feet</span> /
    <span style="color:${numIambs === 5 ? 'var(--meter-weak)' : 'var(--muted)'}">${numIambs === 5 ? 'Perfect pentameter!' : 'Aim for 5 feet (10 syllables)'}</span>
  `;
}

// Init scansion on load
window.addEventListener('load', initScansion);
</script>
</body>
</html>
