<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mass Gesture Lab</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --parchment: #f5f0e8;
      --parchment-dark: #ede5d5;
      --burgundy: #7b2d3a;
      --burgundy-dark: #5a1f2a;
      --gold: #c49a3a;
      --gold-light: #e8c46a;
      --ink: #2a1f14;
      --ink-light: #5c4a36;
      --white: #fdfaf5;
      --shadow: rgba(42, 31, 20, 0.12);
      --shadow-deep: rgba(42, 31, 20, 0.25);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Noto Sans', sans-serif;
      background: var(--parchment);
      background-image:
        radial-gradient(ellipse at 20% 0%, rgba(196,154,58,0.08) 0%, transparent 50%),
        radial-gradient(ellipse at 80% 100%, rgba(123,45,58,0.06) 0%, transparent 50%),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
      min-height: 100vh;
      color: var(--ink);
      overflow-x: hidden;
    }

    /* Ornate header */
    header {
      text-align: center;
      padding: 40px 24px 32px;
      position: relative;
    }

    .header-ornament {
      width: 60px;
      height: 60px;
      margin: 0 auto 16px;
      opacity: 0.7;
    }

    h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.2em, 6vw, 3.2em);
      font-weight: 600;
      color: var(--burgundy);
      letter-spacing: -0.5px;
      line-height: 1.1;
    }

    .subtitle {
      font-size: 0.9em;
      color: var(--ink-light);
      margin-top: 8px;
      font-weight: 300;
      letter-spacing: 0.5px;
    }

    /* Mode tabs */
    .mode-tabs {
      display: flex;
      gap: 6px;
      justify-content: center;
      margin: 28px 0 24px;
      flex-wrap: wrap;
      padding: 0 16px;
    }

    .tab-btn {
      font-family: 'Noto Sans', sans-serif;
      font-size: 0.8em;
      font-weight: 500;
      padding: 8px 16px;
      border: 1.5px solid var(--burgundy);
      border-radius: 30px;
      background: transparent;
      color: var(--burgundy);
      cursor: pointer;
      transition: all 0.25s ease;
      letter-spacing: 0.3px;
    }

    .tab-btn:hover {
      background: var(--burgundy);
      color: var(--white);
    }

    .tab-btn.active {
      background: var(--burgundy);
      color: var(--white);
      box-shadow: 0 4px 16px var(--shadow-deep);
    }

    /* Cards */
    .cards-area {
      max-width: 700px;
      margin: 0 auto;
      padding: 0 20px 60px;
    }

    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    .intro-card {
      background: var(--white);
      border-radius: 20px;
      padding: 28px 32px;
      box-shadow: 0 4px 24px var(--shadow);
      border: 1px solid rgba(196,154,58,0.15);
      margin-bottom: 24px;
    }

    .intro-card p {
      font-size: 0.95em;
      line-height: 1.7;
      color: var(--ink-light);
    }

    .intro-card p + p { margin-top: 12px; }

    .section-label {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1em;
      font-weight: 600;
      color: var(--burgundy);
      margin-bottom: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: linear-gradient(to right, rgba(123,45,58,0.2), transparent);
    }

    /* Gesture cards */
    .gesture-card {
      background: var(--white);
      border-radius: 20px;
      padding: 22px 26px;
      margin-bottom: 14px;
      box-shadow: 0 3px 18px var(--shadow);
      border: 1px solid rgba(196,154,58,0.12);
      display: flex;
      gap: 18px;
      align-items: flex-start;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .gesture-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px var(--shadow-deep);
    }

    .gesture-icon {
      width: 52px;
      height: 52px;
      flex-shrink: 0;
      background: linear-gradient(145deg, var(--burgundy), var(--burgundy-dark));
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(123,45,58,0.3);
    }

    .gesture-icon svg {
      width: 28px;
      height: 28px;
      fill: none;
      stroke: var(--gold-light);
      stroke-width: 1.8;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .gesture-info { flex: 1; }

    .gesture-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.2em;
      font-weight: 600;
      color: var(--ink);
      margin-bottom: 4px;
    }

    .gesture-moment {
      font-size: 0.78em;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      color: var(--gold);
      margin-bottom: 8px;
    }

    .gesture-desc {
      font-size: 0.88em;
      line-height: 1.6;
      color: var(--ink-light);
    }

    /* Quiz mode */
    .quiz-card {
      background: var(--white);
      border-radius: 24px;
      padding: 32px 28px;
      box-shadow: 0 6px 30px var(--shadow);
      border: 1px solid rgba(196,154,58,0.15);
      text-align: center;
    }

    .quiz-progress {
      font-size: 0.75em;
      font-weight: 500;
      color: var(--gold);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 20px;
    }

    .quiz-question {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.5em;
      font-weight: 600;
      color: var(--burgundy);
      line-height: 1.3;
      margin-bottom: 8px;
    }

    .quiz-hint {
      font-size: 0.82em;
      color: var(--ink-light);
      font-style: italic;
      margin-bottom: 28px;
    }

    .quiz-options {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-bottom: 24px;
    }

    .quiz-option {
      font-family: 'Noto Sans', sans-serif;
      font-size: 0.9em;
      font-weight: 500;
      padding: 16px 14px;
      border: 2px solid var(--parchment-dark);
      border-radius: 14px;
      background: var(--parchment);
      color: var(--ink);
      cursor: pointer;
      transition: all 0.2s ease;
      line-height: 1.4;
    }

    .quiz-option:hover {
      border-color: var(--gold);
      background: var(--parchment-dark);
      transform: scale(1.02);
    }

    .quiz-option.correct {
      border-color: #2e7d4a;
      background: #e8f5ed;
      color: #1a5c30;
    }

    .quiz-option.wrong {
      border-color: #c0392b;
      background: #fdecea;
      color: #8b1a1a;
    }

    .quiz-option:disabled { cursor: default; }

    .quiz-result {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.15em;
      font-style: italic;
      color: var(--ink-light);
      padding: 16px;
      border-radius: 12px;
      background: var(--parchment);
      margin-bottom: 20px;
      line-height: 1.5;
      display: none;
    }

    .quiz-result.show { display: block; }

    .next-btn {
      font-family: 'Noto Sans', sans-serif;
      font-size: 0.85em;
      font-weight: 600;
      padding: 12px 28px;
      border: none;
      border-radius: 30px;
      background: var(--burgundy);
      color: var(--white);
      cursor: pointer;
      transition: all 0.2s ease;
      box-shadow: 0 4px 14px rgba(123,45,58,0.3);
      display: none;
    }

    .next-btn.show { display: inline-block; }

    .next-btn:hover {
      background: var(--burgundy-dark);
      transform: translateY(-1px);
    }

    .score-display {
      text-align: center;
      margin-top: 20px;
      font-size: 0.85em;
      color: var(--ink-light);
      display: none;
    }

    .score-display.show { display: block; }

    .score-display strong {
      color: var(--burgundy);
      font-weight: 600;
    }

    /* Practice mode */
    .practice-card {
      background: var(--white);
      border-radius: 24px;
      padding: 36px 32px;
      box-shadow: 0 6px 30px var(--shadow);
      border: 1px solid rgba(196,154,58,0.15);
      text-align: center;
    }

    .practice-step-counter {
      font-size: 0.75em;
      font-weight: 500;
      color: var(--gold);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 20px;
    }

    .practice-mass-part {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.1em;
      font-weight: 600;
      color: var(--burgundy);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 12px;
    }

    .practice-question {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(1.4em, 4vw, 1.9em);
      font-weight: 600;
      color: var(--ink);
      line-height: 1.3;
      margin-bottom: 28px;
    }

    .practice-visual {
      width: 80px;
      height: 80px;
      margin: 0 auto 24px;
      background: linear-gradient(145deg, var(--burgundy), var(--burgundy-dark));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 20px rgba(123,45,58,0.35);
    }

    .practice-visual svg {
      width: 40px;
      height: 40px;
      fill: none;
      stroke: var(--gold-light);
      stroke-width: 1.8;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .practice-btn {
      font-family: 'Noto Sans', sans-serif;
      font-size: 0.82em;
      font-weight: 600;
      padding: 10px 22px;
      border: 2px solid var(--burgundy);
      border-radius: 30px;
      background: transparent;
      color: var(--burgundy);
      cursor: pointer;
      transition: all 0.2s ease;
      margin: 6px;
    }

    .practice-btn:hover, .practice-btn.active {
      background: var(--burgundy);
      color: var(--white);
    }

    .practice-btn.reveal {
      background: var(--parchment-dark);
      border-color: var(--ink-light);
      color: var(--ink);
    }

    .practice-btn.reveal:hover {
      background: var(--ink);
      color: var(--white);
      border-color: var(--ink);
    }

    .practice-actions {
      margin-top: 24px;
    }

    .practice-feedback {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.05em;
      font-style: italic;
      color: var(--ink-light);
      margin-top: 18px;
      line-height: 1.5;
      min-height: 24px;
    }

    .practice-complete {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4em;
      color: var(--burgundy);
      line-height: 1.5;
    }

    .practice-complete small {
      display: block;
      font-size: 0.65em;
      font-family: 'Noto Sans', sans-serif;
      font-style: normal;
      color: var(--ink-light);
      margin-top: 12px;
      font-weight: 400;
      text-transform: none;
      letter-spacing: 0;
    }

    /* Stagger animations */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .gesture-card {
      animation: fadeUp 0.4s ease forwards;
      opacity: 0;
    }

    .gesture-card:nth-child(1) { animation-delay: 0.05s; }
    .gesture-card:nth-child(2) { animation-delay: 0.1s; }
    .gesture-card:nth-child(3) { animation-delay: 0.15s; }
    .gesture-card:nth-child(4) { animation-delay: 0.2s; }
    .gesture-card:nth-child(5) { animation-delay: 0.25s; }
    .gesture-card:nth-child(6) { animation-delay: 0.3s; }
    .gesture-card:nth-child(7) { animation-delay: 0.35s; }
    .gesture-card:nth-child(8) { animation-delay: 0.4s; }
    .gesture-card:nth-child(9) { animation-delay: 0.45s; }
    .gesture-card:nth-child(10) { animation-delay: 0.5s; }

    @keyframes pop {
      0% { transform: scale(1); }
      50% { transform: scale(1.08); }
      100% { transform: scale(1); }
    }

    .pop { animation: pop 0.3s ease; }

    /* Reference section */
    .ref-note {
      font-size: 0.8em;
      color: var(--ink-light);
      text-align: center;
      margin-top: 8px;
      font-style: italic;
    }

    .ref-note a {
      color: var(--burgundy);
      text-decoration: none;
      border-bottom: 1px solid rgba(123,45,58,0.3);
    }

    footer {
      text-align: center;
      padding: 32px 20px 40px;
      font-size: 0.75em;
      color: rgba(42,31,20,0.35);
    }

    footer a { color: rgba(123,45,58,0.5); text-decoration: none; }
  </style>
</head>
<body>

<header>
  <svg class="header-ornament" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
    <circle cx="30" cy="30" r="28" stroke="#7b2d3a" stroke-width="1.5" fill="none" opacity="0.5"/>
    <circle cx="30" cy="30" r="20" stroke="#c49a3a" stroke-width="1" fill="none" opacity="0.4"/>
    <path d="M30 8 L30 52 M8 30 L52 30" stroke="#7b2d3a" stroke-width="1" opacity="0.3"/>
    <path d="M30 14 L34 22 L30 20 L26 22 Z" fill="#c49a3a" opacity="0.7"/>
    <path d="M30 46 L34 38 L30 40 L26 38 Z" fill="#c49a3a" opacity="0.7"/>
    <path d="M14 30 L22 26 L20 30 L22 34 Z" fill="#c49a3a" opacity="0.7"/>
    <path d="M46 30 L38 26 L40 30 L38 34 Z" fill="#c49a3a" opacity="0.7"/>
  </svg>
  <h1>Mass Gesture Lab</h1>
  <p class="subtitle">Learn the gestures and postures of the Congregation at Mass</p>
</header>

<div class="mode-tabs">
  <button class="tab-btn active" data-tab="learn">Learn</button>
  <button class="tab-btn" data-tab="quiz">Quiz</button>
  <button class="tab-btn" data-tab="practice">Practice</button>
</div>

<div class="cards-area">

  <!-- LEARN PANEL -->
  <div id="panel-learn" class="tab-panel active">
    <div class="intro-card">
      <p>The gestures and postures at Mass are not mere tradition — they are a language of the body, spoken by the whole congregation together. Each movement expresses something of the faith we hold: reverence, humility, gratitude, supplication.</p>
      <p>These eleven gestures are practiced by Catholics the world over. Hover a card to lift it, and notice how each one ties a physical action to a sacred moment.</p>
    </div>

    <div class="section-label">The Congregation at Mass</div>

    <div class="gesture-card" data-name="sign-of-cross">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><path d="M12 2v20M4 9h16"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Sign of the Cross</div>
        <div class="gesture-moment">Beginning &amp; End of Mass</div>
        <div class="gesture-desc">Touch forehead, chest, left shoulder, right shoulder with an open hand, saying <em>In the name of the Father, and of the Son, and of the Holy Spirit. Amen.</em> Marks the beginning and close of our prayer.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="bow">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v6M8 20h8M12 13l-3 7M12 13l3 7"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Bow of the Head</div>
        <div class="gesture-moment">Names of Jesus, Mary, Saints</div>
        <div class="gesture-desc">Bow the head slightly when the name of Jesus, Mary, or a Saint is spoken in the Gloria, readings, or prayers. A small bow expresses deep reverence for the sacred names.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="genuflect">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><path d="M12 3v4M9 7h6M8 7l2 8 2-8"/><path d="M10 15h4v5h-4z"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Genuflection</div>
        <div class="gesture-moment">Passing the Tabernacle</div>
        <div class="gesture-desc">Lower the right knee to the floor, bending slightly forward, when passing before the Blessed Sacrament reserved in the tabernacle. The deepest sign of reverence for the Real Presence.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="stand">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="4" r="2"/><path d="M12 6v9M8 15h8M12 15v6"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Standing</div>
        <div class="gesture-moment">Gospel, Creed, Prayer of the Faithful</div>
        <div class="gesture-desc">Stand for the Gospel reading (the reading of Christ's words), the Nicene Creed, and the Prayer of the Faithful. Standing is the posture of dignity and attention.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="sit">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="6" r="2"/><path d="M8 8h8l-1 10H9z"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Sitting</div>
        <div class="gesture-moment">First &amp; Second Readings, Homily</div>
        <div class="gesture-desc">Sit for the Scripture readings before the Gospel and during the homily. A posture of listening, receptive and attentive to the Word of God proclaimed.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="fold-hands">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><path d="M9 10l3 3 3-3M8 8l4 4 4-4"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Folding Hands</div>
        <div class="gesture-moment">Opening Prayer, Preface, Canon</div>
        <div class="gesture-desc">Clasp hands quietly at chest level during the Opening Prayer (Collect), Preface, and Canon of the Mass. The folded hands express humility, dependence on God, and inward prayer.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="bow-de profundis">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4M6 20h12"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Profound Bow</div>
        <div class="gesture-moment">Creed, Lord&apos;s Prayer</div>
        <div class="gesture-desc">Bow deeply from the waist during the Creed at the words <em>and became incarnate of the Virgin Mary</em> and during the Lord's Prayer. A deeper bow signals a deeper mystery of faith.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="lords-prayer">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><path d="M4 4h4v4H4zM10 4h4v4h-4zM16 4h4v4h-4zM4 10h4v4H4zM10 10h4v4h-4zM16 10h4v4h-4zM4 16h4v4H4z"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Hands Raised</div>
        <div class="gesture-moment">Lord&apos;s Prayer</div>
        <div class="gesture-desc">Extend hands outward, palms up, during the Lord's Prayer. This orans posture — ancient in Christianity — expresses openness to God, total surrender, and childlike trust.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="give-peace">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><path d="M8 12h8M12 8v8"/><circle cx="12" cy="12" r="5"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Sign of Peace</div>
        <div class="gesture-moment">Before Communion</div>
        <div class="gesture-desc">Turn to those nearby and offer a handshake or bow with the words <em>Peace be with you.</em> An ancient gesture signifying reconciliation and the unity of the Body of Christ.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="hand-communion">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><path d="M8 8v8M12 6v12M16 8v8"/><path d="M6 20h12"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Hand Raised for Communion</div>
        <div class="gesture-moment">Receiving Holy Communion</div>
        <div class="gesture-desc">Extend one hand, palm up, fingers slightly open to receive the Sacred Host; or kneel and open the mouth for Holy Communion on the tongue. Never put fingers in the mouth after receiving.</div>
      </div>
    </div>

    <div class="gesture-card" data-name="knel-bow">
      <div class="gesture-icon">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="4" r="2"/><path d="M12 6v4M6 20h12"/></svg>
      </div>
      <div class="gesture-info">
        <div class="gesture-name">Kneeling</div>
        <div class="gesture-moment">Eucharistic Prayer, After Consecration</div>
        <div class="gesture-desc">Place both knees on the floor and bow slightly during the Eucharistic Prayer, especially after the words of Consecration when transubstantiation occurs. Kneeling is the posture of adoration.</div>
      </div>
    </div>

    <p class="ref-note">Source: <a href="https://www.adoremus.org/0210MassGesturesPostures.html" target="_blank">Adoremus Bulletin</a> — gestures adapted from the General Instruction of the Roman Missal</p>
  </div>

  <!-- QUIZ PANEL -->
  <div id="panel-quiz" class="tab-panel">
    <div class="quiz-card">
      <div class="quiz-progress" id="quiz-progress">Question 1 of 10</div>
      <div class="quiz-question" id="quiz-question"></div>
      <div class="quiz-hint" id="quiz-hint"></div>
      <div class="quiz-options" id="quiz-options"></div>
      <div class="quiz-result" id="quiz-result"></div>
      <button class="next-btn" id="next-btn">Next Question</button>
    </div>
    <div class="score-display" id="score-display"></div>
  </div>

  <!-- PRACTICE PANEL -->
  <div id="panel-practice" class="tab-panel">
    <div class="practice-card">
      <div class="practice-step-counter" id="practice-counter">Gesture 1 of 11</div>
      <div class="practice-mass-part" id="practice-mass-part"></div>
      <div class="practice-question" id="practice-question2"></div>
      <div class="practice-visual" id="practice-visual"></div>
      <div class="practice-actions">
        <button class="practice-btn" id="practice-reveal-btn">Show Gesture</button>
      </div>
      <div class="practice-feedback" id="practice-feedback"></div>
    </div>
  </div>

</div>

<footer>
  Inspired by <a href="https://cooltoolsforcatholics.blogspot.com/2011/03/gestures-and-postures-of-congregation.html" target="_blank">Jon&apos;s post on Cool Tools for Catholics</a>
</footer>

<script>
(() => {
  // --- Gesture Data ---
  const gestures = [
    {
      name: 'Sign of the Cross',
      moment: 'Beginning & End of Mass',
      instruction: 'Touch forehead, chest, left shoulder, right shoulder with open hand, saying the trinitarian formula.',
      svg: '<svg viewBox="0 0 24 24"><path d="M12 2v20M4 9h16"/></svg>',
    },
    {
      name: 'Bow of the Head',
      moment: 'Names of Jesus, Mary, Saints',
      instruction: 'Bow head slightly when sacred names are spoken.',
      svg: '<svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v6M8 20h8M12 13l-3 7M12 13l3 7"/></svg>',
    },
    {
      name: 'Genuflection',
      moment: 'Passing the Tabernacle',
      instruction: 'Lower right knee to floor, bending slightly forward. The deepest sign of reverence for the Real Presence.',
      svg: '<svg viewBox="0 0 24 24"><path d="M12 3v4M9 7h6M8 7l2 8 2-8"/><path d="M10 15h4v5h-4z"/></svg>',
    },
    {
      name: 'Standing',
      moment: 'Gospel, Creed, Prayer of the Faithful',
      instruction: 'Stand erect, hands at sides or gently folded. The posture of dignity and attention.',
      svg: '<svg viewBox="0 0 24 24"><circle cx="12" cy="4" r="2"/><path d="M12 6v9M8 15h8M12 15v6"/></svg>',
    },
    {
      name: 'Sitting',
      moment: 'First & Second Readings, Homily',
      instruction: 'Sit quietly, posture of receptive listening to the Word of God.',
      svg: '<svg viewBox="0 0 24 24"><circle cx="12" cy="6" r="2"/><path d="M8 8h8l-1 10H9z"/></svg>',
    },
    {
      name: 'Folding Hands',
      moment: 'Opening Prayer, Preface, Canon',
      instruction: 'Clasp hands quietly at chest level. Expresses humility and inward prayer.',
      svg: '<svg viewBox="0 0 24 24"><path d="M9 10l3 3 3-3M8 8l4 4 4-4"/></svg>',
    },
    {
      name: 'Profound Bow',
      moment: 'Creed & Lord\'s Prayer',
      instruction: 'Bow deeply from the waist at the Incarnation words in the Creed and during the Lord\'s Prayer.',
      svg: '<svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><path d="M12 7v4M6 20h12"/></svg>',
    },
    {
      name: 'Hands Raised (Orans)',
      moment: 'Lord\'s Prayer',
      instruction: 'Extend hands outward, palms up — the ancient orans posture of total surrender.',
      svg: '<svg viewBox="0 0 24 24"><path d="M4 4h4v4H4zM10 4h4v4h-4zM16 4h4v4h-4zM4 10h4v4H4zM10 10h4v4h-4zM16 10h4v4h-4zM4 16h4v4H4z"/></svg>',
    },
    {
      name: 'Sign of Peace',
      moment: 'Before Communion',
      instruction: 'Turn to those nearby, offer a handshake or bow, and say "Peace be with you."',
      svg: '<svg viewBox="0 0 24 24"><path d="M8 12h8M12 8v8"/><circle cx="12" cy="12" r="5"/></svg>',
    },
    {
      name: 'Hand Raised for Communion',
      moment: 'Receiving Holy Communion',
      instruction: 'Extend one hand, palm up, fingers slightly open — or kneel for Communion on the tongue.',
      svg: '<svg viewBox="0 0 24 24"><path d="M8 8v8M12 6v12M16 8v8"/><path d="M6 20h12"/></svg>',
    },
    {
      name: 'Kneeling',
      moment: 'Eucharistic Prayer',
      instruction: 'Place both knees on the floor and bow slightly during the Consecration and beyond. The posture of adoration.',
      svg: '<svg viewBox="0 0 24 24"><circle cx="12" cy="4" r="2"/><path d="M12 6v4M6 20h12"/></svg>',
    },
  ];

  // Quiz questions
  const quizItems = [
    {
      q: 'At which Mass moment do you make the Sign of the Cross?',
      opts: ['At the name of Jesus in the Creed', 'Beginning and end of Mass', 'During the Sign of Peace', 'After receiving Communion'],
      a: 1,
      ref: 'The Sign of the Cross marks the bookends of our prayer — the opening and close of the Mass.'
    },
    {
      q: 'You hear the words "and became incarnate of the Virgin Mary" in the Creed. What do you do?',
      opts: ['Sit down', 'Bow your head deeply', 'Clap your hands', 'Genuflect'],
      a: 1,
      ref: 'The profound bow at the Incarnation is one of the most distinctive gestures in the Roman Rite.'
    },
    {
      q: 'When should you genuflect?',
      opts: ['When you enter the pew', 'When passing before the tabernacle', 'At the words "Lord, have mercy"', 'When the priest raises the chalice'],
      a: 1,
      ref: 'Genuflecting before the reserved Blessed Sacrament is the deepest sign of reverence in Catholic worship.'
    },
    {
      q: 'The priest says "The Lord be with you." What is your posture?',
      opts: ['Sitting', 'Standing', 'Kneeling', 'Bow your head'],
      a: 1,
      ref: 'We stand for the dialogue that opens the liturgy proper — "The Lord be with you" / "And with your spirit."'
    },
    {
      q: 'The first reading is about to begin. You sit down because…',
      opts: ['Sitting is the default posture', 'Sitting is the posture of listening during the readings', 'Sitting means you are bored', 'Sitting is only for children'],
      a: 1,
      ref: 'Sitting during the readings expresses receptive attention — we are a people ready to receive the Word.'
    },
    {
      q: 'During which prayers should you fold your hands at chest level?',
      opts: ['During the Our Father', 'During the Opening Prayer, Preface, and Canon', 'During the readings', 'During the homily'],
      a: 1,
      ref: 'The Opening Prayer (Collect), Preface, and Canon are the high points of prayerful address to God — folded hands express inward devotion.'
    },
    {
      q: 'Before receiving Holy Communion, you extend one hand palm-up. Why?',
      opts: ['It looks reverent', 'To receive the Sacred Host on your palm', 'It is required by Church law only in Canada', 'It is a modern invention'],
      a: 1,
      ref: 'Extending the hand to receive Holy Communion — or kneeling with mouth open for Communion on the tongue — is an ancient discipline of the Roman Rite.'
    },
    {
      q: 'During the Sign of Peace, you turn to your neighbor and…',
      opts: ['Embrace them tightly', 'Offer a handshake or bow, saying "Peace be with you"', 'Say "Hello, neighbor"', 'Bow and say "Peace be with the Church"'],
      a: 1,
      ref: 'The Sign of Peace expresses reconciliation and the unity of the Body of Christ before we approach Holy Communion.'
    },
    {
      q: 'When does the congregation kneel?',
      opts: ['Only when the priest kneels', 'During the Eucharistic Prayer after the Consecration', 'Never at Low Mass', 'Only on Sundays'],
      a: 1,
      ref: 'We kneel from after the Sanctus ("Holy, Holy, Holy") through the end of the Canon — the moment of transubstantiation and adoration.'
    },
    {
      q: 'You hear the name "St. Francis de Sales" in the intercessions. What gesture?',
      opts: ['Genuflect', 'Stand', 'Bow your head', 'Fold your hands'],
      a: 2,
      ref: 'A slight bow of the head is made when the names of Mary and the saints are spoken in the Gloria, readings, or prayers.'
    },
  ];

  // --- Tabs ---
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById('panel-' + btn.dataset.tab).classList.add('active');

      if (btn.dataset.tab === 'quiz') initQuiz();
      if (btn.dataset.tab === 'practice') initPractice();
    });
  });

  // --- Quiz Logic ---
  let qi = 0, score = 0, done = false;
  let qOrder = [];
  let revealed = false;

  function shuffleQuiz() {
    qOrder = [...Array(quizItems.length).keys()].sort(() => Math.random() - 0.5);
  }

  function initQuiz() {
    if (qOrder.length === 0) shuffleQuiz();
    qi = 0; score = 0; done = false;
    revealed = false;
    document.getElementById('score-display').classList.remove('show');
    showQ();
  }

  function showQ() {
    revealed = false;
    const item = quizItems[qOrder[qi]];
    document.getElementById('quiz-progress').textContent = `Question ${qi + 1} of ${quizItems.length}`;
    document.getElementById('quiz-question').textContent = item.q;
    document.getElementById('quiz-hint').textContent = 'Which gesture or posture is correct?';
    document.getElementById('quiz-result').classList.remove('show');
    document.getElementById('next-btn').classList.remove('show');

    const opts = document.getElementById('quiz-options');
    opts.innerHTML = '';
    item.opts.forEach((opt, i) => {
      const btn = document.createElement('button');
      btn.className = 'quiz-option';
      btn.textContent = opt;
      btn.addEventListener('click', () => pickAns(i, btn));
      opts.appendChild(btn);
    });
  }

  function pickAns(idx, btn) {
    if (revealed) return;
    revealed = true;
    const item = quizItems[qOrder[qi]];
    const allBtns = document.querySelectorAll('.quiz-option');
    allBtns.forEach(b => b.disabled = true);

    if (idx === item.a) {
      btn.classList.add('correct');
      score++;
    } else {
      btn.classList.add('wrong');
      allBtns[item.a].classList.add('correct');
    }

    const res = document.getElementById('quiz-result');
    res.textContent = item.ref;
    res.classList.add('show');

    const nextBtn = document.getElementById('next-btn');
    nextBtn.classList.add('show');

    if (qi >= quizItems.length - 1) {
      nextBtn.textContent = 'See Results';
    }
  }

  document.getElementById('next-btn').addEventListener('click', () => {
    qi++;
    if (qi >= quizItems.length) {
      showScore();
    } else {
      showQ();
    }
  });

  function showScore() {
    done = true;
    const pct = Math.round((score / quizItems.length) * 100);
    let msg = '';
    if (pct === 100) msg = 'Perfect! You know the Mass gestures intimately.';
    else if (pct >= 70) msg = `Well done — ${score}/${quizItems.length}. You have a solid grasp of the gestures.`;
    else msg = `${score}/${quizItems.length} correct. Keep learning these beautiful gestures!`;

    document.getElementById('quiz-progress').textContent = 'Quiz Complete';
    document.getElementById('quiz-question').textContent = '';
    document.getElementById('quiz-hint').textContent = '';
    document.getElementById('quiz-options').innerHTML = '';
    document.getElementById('quiz-result').classList.remove('show');
    document.getElementById('next-btn').classList.remove('show');

    const sd = document.getElementById('score-display');
    sd.innerHTML = `<strong>${pct}%</strong> — ${msg}`;
    sd.classList.add('show');
  }

  // --- Practice Mode ---
  let pi = 0;
  let pRevealed = false;

  function initPractice() {
    pi = 0;
    showPractice();
  }

  function showPractice() {
    pRevealed = false;
    const g = gestures[pi];
    document.getElementById('practice-counter').textContent = `Gesture ${pi + 1} of ${gestures.length}`;
    document.getElementById('practice-mass-part').textContent = g.moment;
    document.getElementById('practice-question2').textContent = `What gesture belongs here?`;
    document.getElementById('practice-visual').innerHTML = g.svg;
    document.getElementById('practice-feedback').textContent = '';
    document.getElementById('practice-reveal-btn').style.display = 'inline-block';
    document.getElementById('practice-reveal-btn').textContent = 'Show Gesture';
    document.getElementById('practice-reveal-btn').classList.remove('reveal');
    document.getElementById('practice-reveal-btn').onclick = revealGesture;
  }

  function revealGesture() {
    if (pRevealed) {
      // Move to next
      pi++;
      if (pi >= gestures.length) {
        showComplete();
      } else {
        showPractice();
      }
      return;
    }
    pRevealed = true;
    const g = gestures[pi];
    document.getElementById('practice-feedback').textContent = `"${g.instruction}"`;
    document.getElementById('practice-reveal-btn').textContent = 'Next Gesture';
    document.getElementById('practice-reveal-btn').classList.add('reveal');
  }

  function showComplete() {
    document.getElementById('practice-counter').textContent = '';
    document.getElementById('practice-mass-part').textContent = '';
    document.getElementById('practice-question2').innerHTML = '<span class="practice-complete">Well done. You have worked through all eleven gestures.<small>Next time you are at Mass, try to notice each one as it happens — and join your body to the prayer of the whole Church.</small></span>';
    document.getElementById('practice-visual').innerHTML = '<svg viewBox="0 0 24 24" style="fill:none;stroke:#c49a3a;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round"><path d="M12 2l3 6 7 1-5 5 1 7-6-3-6 3 1-7-5-5 7-1z"/></svg>';
    document.getElementById('practice-reveal-btn').style.display = 'inline-block';
    document.getElementById('practice-reveal-btn').textContent = 'Start Over';
    document.getElementById('practice-reveal-btn').classList.remove('reveal');
    document.getElementById('practice-reveal-btn').onclick = () => { pi = 0; showPractice(); };
    document.getElementById('practice-feedback').textContent = '';
  }

  // --- Keyboard nav for quiz ---
  document.addEventListener('keydown', e => {
    if (!document.getElementById('panel-quiz').classList.contains('active')) return;
    const btns = document.querySelectorAll('.quiz-option:not(:disabled)');
    if (!btns.length) return;
    if (e.key >= '1' && e.key <= '4') {
      const idx = parseInt(e.key) - 1;
      if (btns[idx]) btns[idx].click();
    }
    if (e.key === 'Enter' || e.key === ' ') {
      const nb = document.getElementById('next-btn');
      if (nb.classList.contains('show')) nb.click();
    }
  });
})();
</script>
</body>
</html>
