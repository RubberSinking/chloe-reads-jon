<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Which Temperament Are You? — The Catholic Four Temperaments Quiz</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --choleric:   #c0392b;
            --sanguine:   #e67e22;
            --melancholy: #2980b9;
            --phlegmatic: #27ae60;
            --choleric-light:   #fadbd8;
            --sanguine-light:   #fdebd0;
            --melancholy-light: #d6eaf8;
            --phlegmatic-light: #d5f5e3;
        }

        body {
            font-family: 'Georgia', serif;
            background: #faf8f3;
            color: #2c2416;
            min-height: 100vh;
        }

        /* ── INTRO SCREEN ── */
        #intro {
            max-width: 640px;
            margin: 0 auto;
            padding: 48px 24px 64px;
            text-align: center;
        }

        .badge {
            display: inline-block;
            background: #2c2416;
            color: #faf8f3;
            font-size: 0.7em;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 24px;
            font-family: system-ui, sans-serif;
        }

        #intro h1 {
            font-size: clamp(1.8em, 5vw, 2.8em);
            font-weight: normal;
            line-height: 1.2;
            margin-bottom: 20px;
            color: #1a1208;
        }

        #intro .subtitle {
            font-size: 1.05em;
            color: #5a4a2c;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .temperament-preview {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 32px 0;
        }

        .tp-card {
            border-radius: 12px;
            padding: 16px 14px;
            text-align: left;
        }
        .tp-card.ch { background: var(--choleric-light);   border-left: 4px solid var(--choleric); }
        .tp-card.sa { background: var(--sanguine-light);   border-left: 4px solid var(--sanguine); }
        .tp-card.me { background: var(--melancholy-light); border-left: 4px solid var(--melancholy); }
        .tp-card.ph { background: var(--phlegmatic-light); border-left: 4px solid var(--phlegmatic); }

        .tp-card .tp-name {
            font-family: system-ui, sans-serif;
            font-weight: 700;
            font-size: 0.85em;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .tp-card.ch .tp-name { color: var(--choleric); }
        .tp-card.sa .tp-name { color: #a0530a; }
        .tp-card.me .tp-name { color: var(--melancholy); }
        .tp-card.ph .tp-name { color: #1a7a46; }

        .tp-card .tp-desc {
            font-size: 0.8em;
            color: #4a3a1c;
            font-family: system-ui, sans-serif;
            line-height: 1.4;
        }

        .start-btn {
            display: inline-block;
            background: #2c2416;
            color: #faf8f3;
            border: none;
            padding: 16px 40px;
            font-size: 1.05em;
            font-family: Georgia, serif;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 8px;
        }
        .start-btn:hover { background: #1a1208; transform: translateY(-1px); }
        .start-btn:active { transform: translateY(0); }

        /* ── QUIZ SCREEN ── */
        #quiz {
            display: none;
            max-width: 680px;
            margin: 0 auto;
            padding: 32px 24px 64px;
        }

        .progress-bar-wrap {
            background: #e8e2d4;
            border-radius: 100px;
            height: 6px;
            margin-bottom: 32px;
            overflow: hidden;
        }
        .progress-bar-fill {
            height: 100%;
            background: #2c2416;
            border-radius: 100px;
            transition: width 0.4s ease;
        }

        .q-counter {
            font-family: system-ui, sans-serif;
            font-size: 0.8em;
            color: #888;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .q-text {
            font-size: clamp(1.1em, 3vw, 1.35em);
            line-height: 1.5;
            margin-bottom: 28px;
            color: #1a1208;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .opt-btn {
            background: white;
            border: 2px solid #e8e2d4;
            border-radius: 10px;
            padding: 14px 18px;
            text-align: left;
            cursor: pointer;
            font-family: Georgia, serif;
            font-size: 0.95em;
            line-height: 1.45;
            color: #2c2416;
            transition: border-color 0.15s, background 0.15s, transform 0.1s;
            position: relative;
        }

        .opt-btn:hover {
            border-color: #a09070;
            background: #fdf9f0;
            transform: translateX(2px);
        }

        .opt-btn.selected {
            border-color: #2c2416;
            background: #2c2416;
            color: #faf8f3;
            transform: translateX(3px);
        }

        .opt-btn .letter {
            display: inline-block;
            font-family: system-ui, sans-serif;
            font-weight: 700;
            font-size: 0.75em;
            margin-right: 8px;
            opacity: 0.5;
            letter-spacing: 0.5px;
        }
        .opt-btn.selected .letter { opacity: 0.7; }

        .nav-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 28px;
            gap: 12px;
        }

        .nav-btn {
            background: none;
            border: 2px solid #c8c0b0;
            color: #5a4a2c;
            padding: 10px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-family: Georgia, serif;
            font-size: 0.9em;
            transition: all 0.15s;
        }
        .nav-btn:hover { border-color: #5a4a2c; background: #f5f0e8; }
        .nav-btn:disabled { opacity: 0.3; cursor: default; }

        .next-btn {
            background: #2c2416;
            border: 2px solid #2c2416;
            color: #faf8f3;
            padding: 10px 28px;
            border-radius: 8px;
            cursor: pointer;
            font-family: Georgia, serif;
            font-size: 0.95em;
            transition: all 0.15s;
            margin-left: auto;
        }
        .next-btn:hover { background: #1a1208; border-color: #1a1208; }
        .next-btn:disabled { opacity: 0.35; cursor: default; }

        /* ── RESULT SCREEN ── */
        #result {
            display: none;
            max-width: 680px;
            margin: 0 auto;
            padding: 32px 24px 72px;
        }

        .result-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .temperament-crest {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.8em;
            margin: 0 auto 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .result-label {
            font-family: system-ui, sans-serif;
            font-size: 0.75em;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.6;
            margin-bottom: 6px;
        }

        .result-title {
            font-size: clamp(1.8em, 5vw, 2.6em);
            font-weight: normal;
            line-height: 1.2;
            margin-bottom: 10px;
        }

        .result-subtitle {
            font-family: system-ui, sans-serif;
            font-size: 0.9em;
            color: #6a5a3c;
            line-height: 1.5;
        }

        /* Score bars */
        .score-section {
            background: white;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }

        .score-section h3 {
            font-family: system-ui, sans-serif;
            font-size: 0.75em;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 16px;
        }

        .score-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }
        .score-row:last-child { margin-bottom: 0; }

        .score-label {
            font-family: system-ui, sans-serif;
            font-size: 0.8em;
            font-weight: 600;
            width: 90px;
            flex-shrink: 0;
        }

        .score-track {
            flex: 1;
            background: #f0ece4;
            border-radius: 100px;
            height: 8px;
            overflow: hidden;
        }

        .score-fill {
            height: 100%;
            border-radius: 100px;
            transition: width 1s ease;
            width: 0;
        }

        .score-pct {
            font-family: system-ui, sans-serif;
            font-size: 0.8em;
            font-weight: 600;
            color: #888;
            width: 36px;
            text-align: right;
        }

        /* Profile cards */
        .profile-card {
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .profile-card h2 {
            font-size: 1.3em;
            margin-bottom: 12px;
        }

        .profile-card p {
            line-height: 1.7;
            font-size: 0.95em;
        }

        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin: 14px 0;
        }

        .tag {
            font-family: system-ui, sans-serif;
            font-size: 0.72em;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        .tag.strength  { background: rgba(0,0,0,0.07); color: #2c2416; }
        .tag.challenge { background: rgba(0,0,0,0.04); color: #2c2416; border: 1px solid rgba(0,0,0,0.1); }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 20px;
        }

        .mini-card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .mini-card h4 {
            font-family: system-ui, sans-serif;
            font-size: 0.7em;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 10px;
        }

        .mini-card ul {
            list-style: none;
            padding: 0;
        }

        .mini-card ul li {
            font-size: 0.88em;
            padding: 4px 0;
            border-bottom: 1px solid #f0ece4;
            line-height: 1.4;
            color: #3a2c14;
        }
        .mini-card ul li:last-child { border-bottom: none; }
        .mini-card ul li::before { content: "• "; opacity: 0.4; }

        /* Holy person section */
        .holy-card {
            background: #fdf9f0;
            border: 1px solid #e8e2d4;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
            font-style: italic;
        }

        .holy-card .holy-name {
            font-style: normal;
            font-weight: bold;
            font-size: 1.05em;
            margin-bottom: 8px;
        }

        .holy-card p { line-height: 1.7; font-size: 0.95em; color: #4a3a1c; }

        .retry-btn {
            display: block;
            width: 100%;
            text-align: center;
            background: none;
            border: 2px solid #c8c0b0;
            color: #5a4a2c;
            padding: 13px;
            border-radius: 10px;
            cursor: pointer;
            font-family: Georgia, serif;
            font-size: 0.95em;
            margin-top: 12px;
            transition: all 0.15s;
        }
        .retry-btn:hover { border-color: #5a4a2c; background: #f5f0e8; }

        .source-link {
            text-align: center;
            margin-top: 24px;
            font-family: system-ui, sans-serif;
            font-size: 0.8em;
            color: #aaa;
        }
        .source-link a { color: #888; }

        /* Screen transitions */
        .fade-in {
            animation: fadeIn 0.4s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .temperament-preview { grid-template-columns: 1fr; }
            .two-col { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ══════════════════ INTRO ══════════════════ -->
<div id="intro" class="fade-in">
    <div class="badge">Catholic Tradition</div>
    <h1>Which Temperament<br>Are You?</h1>
    <p class="subtitle">
        Choleric, Sanguine, Melancholic, or Phlegmatic?<br>
        20 questions to discover your primary and secondary temperament — and what it means for your spiritual life.
    </p>

    <div class="temperament-preview">
        <div class="tp-card ch">
            <div class="tp-name">🔥 Choleric</div>
            <div class="tp-desc">Decisive, driven, born to lead. Fire in the veins.</div>
        </div>
        <div class="tp-card sa">
            <div class="tp-name">☀️ Sanguine</div>
            <div class="tp-desc">Joyful, warm, the life of any room.</div>
        </div>
        <div class="tp-card me">
            <div class="tp-name">🌙 Melancholic</div>
            <div class="tp-desc">Thoughtful, idealistic, a deep and feeling soul.</div>
        </div>
        <div class="tp-card ph">
            <div class="tp-name">🌿 Phlegmatic</div>
            <div class="tp-desc">Calm, steady, the anchor in any storm.</div>
        </div>
    </div>

    <button class="start-btn" onclick="startQuiz()">Begin the Quiz →</button>
</div>

<!-- ══════════════════ QUIZ ══════════════════ -->
<div id="quiz">
    <div class="progress-bar-wrap">
        <div class="progress-bar-fill" id="progressFill"></div>
    </div>
    <div class="q-counter" id="qCounter"></div>
    <div class="q-text" id="qText"></div>
    <div class="options" id="options"></div>
    <div class="nav-row">
        <button class="nav-btn" id="prevBtn" onclick="prev()">← Back</button>
        <button class="next-btn" id="nextBtn" onclick="next()" disabled>Next →</button>
    </div>
</div>

<!-- ══════════════════ RESULT ══════════════════ -->
<div id="result"></div>

<script>
// ── Questions ──────────────────────────────────────────────────────────────
// Each option: [text, temperament] where ch=Choleric, sa=Sanguine, me=Melancholic, ph=Phlegmatic
const questions = [
    {
        q: "When a group needs a decision, you tend to…",
        opts: [
            ["Step in and decide — someone has to.", "ch"],
            ["Suggest something enthusiastically and rally the room.", "sa"],
            ["Think through every angle before speaking.", "me"],
            ["Support whatever the group leans toward.", "ph"]
        ]
    },
    {
        q: "Your friends would most likely describe you as…",
        opts: [
            ["Determined and direct.", "ch"],
            ["Fun-loving and talkative.", "sa"],
            ["Thoughtful and a bit intense.", "me"],
            ["Easy-going and dependable.", "ph"]
        ]
    },
    {
        q: "When something goes wrong, your first instinct is to…",
        opts: [
            ["Fix it immediately — get into action.", "ch"],
            ["Talk it through with someone.", "sa"],
            ["Dwell on what could have been done differently.", "me"],
            ["Stay calm and wait to see how it unfolds.", "ph"]
        ]
    },
    {
        q: "At a social gathering you don't know many people, you…",
        opts: [
            ["Network with purpose — you leave knowing the key players.", "ch"],
            ["Work the room; you've made five new friends by the end.", "sa"],
            ["Find one or two people for a deep conversation.", "me"],
            ["Hang back, happy to observe and chat when approached.", "ph"]
        ]
    },
    {
        q: "Your workspace or bedroom is most likely…",
        opts: [
            ["Functional and stripped down — clutter wastes energy.", "ch"],
            ["Colourful and lively, with reminders of people you love.", "sa"],
            ["Orderly and carefully arranged; things have meaning.", "me"],
            ["Comfortable and relaxed — cosy over tidy.", "ph"]
        ]
    },
    {
        q: "When someone wrongs you, you…",
        opts: [
            ["Get annoyed quickly but often forget about it fast.", "ch"],
            ["Feel hurt but move on once you've talked it out.", "sa"],
            ["Can't stop thinking about it for days.", "me"],
            ["Brush it off — life is too short to hold grudges.", "ph"]
        ]
    },
    {
        q: "What most motivates you?",
        opts: [
            ["Achieving goals and seeing results.", "ch"],
            ["Connecting with people and having fun.", "sa"],
            ["Doing things with excellence and meaning.", "me"],
            ["Peace, stability, and keeping everyone happy.", "ph"]
        ]
    },
    {
        q: "In prayer, you are most drawn to…",
        opts: [
            ["Active, purposeful intercession — storming heaven.", "ch"],
            ["Praise, song, and praying aloud with others.", "sa"],
            ["Contemplative silence and lectio divina.", "me"],
            ["Familiar, steady prayers like the Rosary.", "ph"]
        ]
    },
    {
        q: "Your biggest temptation is probably…",
        opts: [
            ["Pride or impatience with slower people.", "ch"],
            ["Distractibility or saying yes to everything.", "sa"],
            ["Perfectionism or sinking into sadness.", "me"],
            ["Laziness or avoiding necessary confrontation.", "ph"]
        ]
    },
    {
        q: "In a debate, you…",
        opts: [
            ["Come in with a clear position and defend it vigorously.", "ch"],
            ["Try to find common ground and keep things light.", "sa"],
            ["Research thoroughly and argue with precision.", "me"],
            ["Listen carefully and stay neutral unless pushed.", "ph"]
        ]
    },
    {
        q: "When you start a new project, you…",
        opts: [
            ["Jump in quickly — you'll figure it out as you go.", "ch"],
            ["Get excited and share the idea with everyone.", "sa"],
            ["Make a detailed plan and research it thoroughly.", "me"],
            ["Take it steadily, at a measured pace.", "ph"]
        ]
    },
    {
        q: "Which sentence best fits you?",
        opts: [
            ["I'd rather lead a hard road than follow an easy one.", "ch"],
            ["I live for moments of joy and connection.", "sa"],
            ["I feel everything very deeply.", "me"],
            ["I just want everyone to get along.", "ph"]
        ]
    },
    {
        q: "When a close friend is suffering, you instinctively…",
        opts: [
            ["Figure out what practical help they need.", "ch"],
            ["Sit with them, listen, and cheer them up.", "sa"],
            ["Feel their pain deeply and share in their grief.", "me"],
            ["Offer quiet, steady presence without pressure.", "ph"]
        ]
    },
    {
        q: "Your relationship with routines is…",
        opts: [
            ["I create systems and expect them to be followed.", "ch"],
            ["I get bored easily — variety is better.", "sa"],
            ["I love a well-crafted routine and stick to it faithfully.", "me"],
            ["I'm comfortable with routine but don't need it.", "ph"]
        ]
    },
    {
        q: "Under real stress, others might see you as…",
        opts: [
            ["Domineering or short-tempered.", "ch"],
            ["Flighty or seeking escape.", "sa"],
            ["Withdrawn, worried, or overly self-critical.", "me"],
            ["Passive or checked-out.", "ph"]
        ]
    },
    {
        q: "Which saint most appeals to you?",
        opts: [
            ["St. Paul — bold, relentless, never stopped moving.", "ch"],
            ["St. Francis of Assisi — joyful, warm, beloved by all.", "sa"],
            ["St. Thomas Aquinas — precise, brilliant, probing depths.", "me"],
            ["St. Thomas More — steady, diplomatic, gentle in conviction.", "ph"]
        ]
    },
    {
        q: "When you have a free afternoon, you prefer…",
        opts: [
            ["Tackling a project you've been putting off.", "ch"],
            ["Seeing friends or doing something spontaneous.", "sa"],
            ["Reading, journaling, or a long reflective walk.", "me"],
            ["A quiet afternoon at home, nothing scheduled.", "ph"]
        ]
    },
    {
        q: "Which virtue do you most need to cultivate?",
        opts: [
            ["Humility — I find it hard to be wrong.", "ch"],
            ["Focus — I scatter my attention too easily.", "sa"],
            ["Hope — I can lose myself in melancholy.", "me"],
            ["Courage — I avoid conflict more than I should.", "ph"]
        ]
    },
    {
        q: "People sometimes complain that you are too…",
        opts: [
            ["Bossy or blunt.", "ch"],
            ["Loud or shallow.", "sa"],
            ["Moody or critical.", "me"],
            ["Slow or indifferent.", "ph"]
        ]
    },
    {
        q: "The phrase that best matches your inner life is…",
        opts: [
            ["\"There's always a way — find it.\"", "ch"],
            ["\"Life is beautiful — enjoy it fully.\"", "sa"],
            ["\"There's always more depth to find.\"", "me"],
            ["\"Peace is its own kind of wisdom.\"", "ph"]
        ]
    }
];

// ── Temperament data ───────────────────────────────────────────────────────
const temps = {
    ch: {
        name: "Choleric",
        emoji: "🔥",
        color: "#c0392b",
        light: "#fadbd8",
        tagline: "The decisive leader, the builder of worlds.",
        desc: `The Choleric is fire: driven, goal-oriented, decisive, and born to lead. You are the person who steps forward when others hesitate, who sees problems as challenges to overcome, and who never settles for "good enough." Your energy is contagious and your determination impressive.`,
        desc2: `Most people are a blend of two temperaments — your secondary score will reveal the other dimension of your personality, shaping how your primary temperament expresses itself.`,
        strengths: ["Natural leader","Decisive","Goal-oriented","Loyal","Courageous","Gets things done"],
        challenges: ["Impatience","Pride","Stubbornness","Quick temper","Can be domineering"],
        spiritual: `The Choleric's spiritual path is the taming of a great fire — not to extinguish it, but to direct it. Your decisive nature can make you a powerful servant of God's will, but pride and impatience are real obstacles. Pray especially for humility and the grace to follow as well as lead.`,
        saints: ["St. Paul the Apostle","St. Peter","St. Ignatius of Loyola"],
        holyDesc: `St. Paul is the great Choleric saint — relentless, bold, never resting, "pressing on toward the goal." His conversion was not a softening of his temperament but a redirection of it toward Christ.`,
        avoid: ["Steamrolling others' feelings","Confusing control with leadership","Treating prayer as another task to complete"],
        embrace: ["Lead by serving","Use your decisiveness for God's agenda, not your own","Channel anger into righteous zeal"],
    },
    sa: {
        name: "Sanguine",
        emoji: "☀️",
        color: "#e67e22",
        light: "#fdebd0",
        tagline: "The joyful heart, the bringer of light.",
        desc: `The Sanguine is sunshine: warm, expressive, enthusiastic, and genuinely delighted by people. You move through life making friends easily, lifting moods without trying, and finding joy in the everyday moments others walk past. You are the person who makes a room feel alive.`,
        desc2: `Most people are a blend of two temperaments — your secondary score reveals the other facet of your personality, shaping how this warmth expresses itself in daily life.`,
        strengths: ["Warm and approachable","Enthusiastic","Optimistic","Naturally funny","Lives in the moment","Generous with affection"],
        challenges: ["Distractibility","Forgetfulness","Can be superficial","Craves approval","Overcommits"],
        spiritual: `The Sanguine's spiritual life flourishes in community — Mass, shared prayer, worship with others. The temptation is to treat faith as a feeling rather than a commitment. Develop the discipline to pray even when it isn't exciting, and learn to sit quietly with God.`,
        saints: ["St. Francis of Assisi","St. Philip Neri","St. Teresa of Ávila"],
        holyDesc: `St. Philip Neri, the "Apostle of Rome," was the sanguine saint — famous for laughter, practical jokes, and sheer joy. He drew people to holiness not through severity but through irresistible warmth.`,
        avoid: ["Letting excitement substitute for substance","Skipping prayer when the feeling isn't there","Promising more than you can deliver"],
        embrace: ["Bring your gift of joy to those who are suffering","Use your love of people for evangelisation","Let the Eucharist be your deepest joy"],
    },
    me: {
        name: "Melancholic",
        emoji: "🌙",
        color: "#2980b9",
        light: "#d6eaf8",
        tagline: "The thinker, the artist, the deep and feeling soul.",
        desc: `The Melancholic is depth: thoughtful, analytical, idealistic, and acutely sensitive to beauty, meaning, and imperfection. You notice what others miss. You think where others react. You feel where others merely observe. The world is richer and more complex to you than it appears to most.`,
        desc2: `Most people are a blend of two temperaments — your secondary score will show how this depth balances with or intensifies your secondary nature.`,
        strengths: ["Analytical","Idealistic","Artistic","Faithful","Detail-oriented","Deep empathy"],
        challenges: ["Perfectionism","Tendency toward sadness","Self-criticism","Can be withdrawn","Holds grudges"],
        spiritual: `The Melancholic is often drawn to contemplative prayer and is well-suited for spiritual reading and lectio divina. The temptation is scrupulosity — an exaggerated fear of sin — or acedia, spiritual sadness. The Church's great theologians and mystics are largely Melancholic; embrace that legacy and bring your depth to God.`,
        saints: ["St. Thomas Aquinas","St. Augustine","St. John of the Cross"],
        holyDesc: `St. John of the Cross, mystic and poet of the "Dark Night of the Soul," is the Melancholic saint par excellence — plumbing the depths of the spiritual life with intellectual precision and aching beauty.`,
        avoid: ["Getting lost in self-criticism","Letting the perfect be the enemy of the good","Isolating when you're struggling"],
        embrace: ["Channel your gift for analysis into theology and prayer","Let beauty — music, art, nature — lead you to God","Share your depth with others; it is a gift"],
    },
    ph: {
        name: "Phlegmatic",
        emoji: "🌿",
        color: "#27ae60",
        light: "#d5f5e3",
        tagline: "The steady anchor, the gift of peace.",
        desc: `The Phlegmatic is stillness: calm, reliable, diplomatic, and deeply at peace with the world. You are the anchor in a storm, the person everyone trusts because you never overreact and never abandon ship. Your presence is a steady comfort to everyone around you.`,
        desc2: `Most people are a blend of two temperaments — your secondary score will show how this steadiness combines with other qualities to form your full temperament profile.`,
        strengths: ["Patient","Even-tempered","Diplomatic","Reliable","Trustworthy","Good listener"],
        challenges: ["Passivity","Avoids necessary conflict","Can be slow to act","May suppress feelings","Prone to laziness"],
        spiritual: `The Phlegmatic has a natural capacity for the interior life — your peace can become genuine contemplative prayer. The spiritual temptation is to let faith become routine without heart, or to avoid the conversions God is asking of you. Let your peace be an active gift, not a refuge from growth.`,
        saints: ["St. Thomas More","St. John the Apostle","Blessed Pier Giorgio Frassati"],
        holyDesc: `St. Thomas More is the Phlegmatic saint — steady, diplomatic, gentle in manner, but rock-solid in conviction. He did not rush to martyrdom; he sought every lawful escape. But when the line came, he didn't move.`,
        avoid: ["Letting peace become passivity","Refusing necessary confrontation","Letting faith drift into comfortable habit without depth"],
        embrace: ["Be the calm presence others desperately need","Intercede deeply — you have the patience to persevere in prayer","Let your faithfulness inspire others' constancy"],
    }
};

// ── State ──────────────────────────────────────────────────────────────────
let current = 0;
let answers = new Array(questions.length).fill(null);
const scores = { ch: 0, sa: 0, me: 0, ph: 0 };
const letters = ['A','B','C','D'];

function startQuiz() {
    document.getElementById('intro').style.display = 'none';
    const quiz = document.getElementById('quiz');
    quiz.style.display = 'block';
    quiz.classList.add('fade-in');
    renderQuestion();
}

function renderQuestion() {
    const q = questions[current];
    document.getElementById('qCounter').textContent = `Question ${current + 1} of ${questions.length}`;
    document.getElementById('qText').textContent = q.q;

    document.getElementById('progressFill').style.width = `${(current / questions.length) * 100}%`;

    // Shuffle options but remember their temperament
    const opts = q.opts.slice();

    const container = document.getElementById('options');
    container.innerHTML = '';
    opts.forEach((opt, i) => {
        const btn = document.createElement('button');
        btn.className = 'opt-btn' + (answers[current] === i ? ' selected' : '');
        btn.innerHTML = `<span class="letter">${letters[i]}</span>${opt[0]}`;
        btn.onclick = () => selectOpt(i);
        container.appendChild(btn);
    });

    document.getElementById('prevBtn').disabled = current === 0;
    document.getElementById('nextBtn').disabled = answers[current] === null;
    document.getElementById('nextBtn').textContent =
        current === questions.length - 1 ? 'See Results →' : 'Next →';
}

function selectOpt(idx) {
    answers[current] = idx;
    document.querySelectorAll('.opt-btn').forEach((b, i) => {
        b.classList.toggle('selected', i === idx);
    });
    document.getElementById('nextBtn').disabled = false;
}

function prev() {
    if (current > 0) { current--; renderQuestion(); }
}

function next() {
    if (answers[current] === null) return;
    if (current < questions.length - 1) {
        current++;
        renderQuestion();
    } else {
        showResult();
    }
}

function showResult() {
    // Tally scores
    const totals = { ch: 0, sa: 0, me: 0, ph: 0 };
    questions.forEach((q, i) => {
        if (answers[i] !== null) {
            totals[q.opts[answers[i]][1]]++;
        }
    });

    // Sort
    const sorted = Object.entries(totals).sort((a,b) => b[1]-a[1]);
    const primary   = sorted[0][0];
    const secondary = sorted[1][0];
    const total     = questions.length;

    document.getElementById('quiz').style.display = 'none';

    const p  = temps[primary];
    const s  = temps[secondary];

    const resultEl = document.getElementById('result');
    resultEl.style.display = 'block';
    resultEl.classList.add('fade-in');

    const comboName = `${p.name}–${s.name}`;

    resultEl.innerHTML = `
        <div class="result-header">
            <div class="temperament-crest" style="background:${p.light};">${p.emoji}</div>
            <div class="result-label">Your Temperament</div>
            <div class="result-title" style="color:${p.color};">${comboName}</div>
            <div class="result-subtitle">${p.tagline}</div>
        </div>

        <!-- Score bars -->
        <div class="score-section">
            <h3>Your Profile</h3>
            ${sorted.map(([k, v]) => `
            <div class="score-row">
                <div class="score-label" style="color:${temps[k].color}">${temps[k].emoji} ${temps[k].name}</div>
                <div class="score-track">
                    <div class="score-fill" data-pct="${Math.round(v/total*100)}" style="background:${temps[k].color}; width:0"></div>
                </div>
                <div class="score-pct">${Math.round(v/total*100)}%</div>
            </div>`).join('')}
        </div>

        <!-- Primary description -->
        <div class="profile-card" style="background:${p.light}; border-left:4px solid ${p.color};">
            <h2 style="color:${p.color};">${p.emoji} ${p.name}</h2>
            <p>${p.desc}</p>
            <div class="tag-row">
                ${p.strengths.map(s=>`<span class="tag strength" style="background:${p.color}22;color:${p.color}">${s}</span>`).join('')}
            </div>
            <div class="tag-row">
                ${p.challenges.map(c=>`<span class="tag challenge">${c}</span>`).join('')}
            </div>
        </div>

        <!-- Secondary note -->
        <div class="score-section" style="border-left:4px solid ${s.color};">
            <h3 style="color:${s.color}">${s.emoji} Secondary: ${s.name}</h3>
            <p style="font-size:0.93em;line-height:1.65;color:#3a2c14">${s.tagline} — ${s.desc.split('.')[0]}. Your ${p.name} nature shapes the headline; your ${s.name} side adds texture, shadow, and depth.</p>
        </div>

        <!-- Two columns: virtues to embrace / habits to avoid -->
        <div class="two-col">
            <div class="mini-card">
                <h4>Embrace</h4>
                <ul>${p.embrace.map(e=>`<li>${e}</li>`).join('')}</ul>
            </div>
            <div class="mini-card">
                <h4>Watch out for</h4>
                <ul>${p.avoid.map(a=>`<li>${a}</li>`).join('')}</ul>
            </div>
        </div>

        <!-- Spiritual -->
        <div class="score-section">
            <h3>Spiritual Life</h3>
            <p style="font-size:0.95em;line-height:1.7;color:#3a2c14">${p.spiritual}</p>
        </div>

        <!-- Patron saint -->
        <div class="holy-card">
            <div class="holy-name">${p.saints[0]}</div>
            <p>${p.holyDesc}</p>
        </div>

        <button class="retry-btn" onclick="resetQuiz()">← Retake the Quiz</button>

        <div class="source-link">
            Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2011/10/which-temperament-are-you.html" target="_blank">Which Temperament Are You?</a> post
            and <em>The Temperament God Gave You</em> by Art &amp; Laraine Bennett. ·
            <a href="index.php">← Back to Chloe Reads Jon</a>
        </div>
    `;

    // Animate bars after paint
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            document.querySelectorAll('.score-fill').forEach(el => {
                el.style.width = el.dataset.pct + '%';
            });
        });
    });
}

function resetQuiz() {
    current = 0;
    answers.fill(null);
    document.getElementById('result').style.display = 'none';
    document.getElementById('result').innerHTML = '';
    document.getElementById('intro').style.display = 'block';
    document.getElementById('intro').classList.add('fade-in');
    window.scrollTo(0,0);
}
</script>
</body>
</html>
