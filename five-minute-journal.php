<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5-Minute Journal — Chloe Reads Jon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,600;0,700;1,400&family=Josefin+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --paper: #faf6f0;
            --paper-deep: #f0e8dc;
            --ink: #2c1810;
            --ink-light: #5c4033;
            --accent: #c4785a;
            --accent-soft: #d9a07e;
            --accent-dark: #8b4513;
            --morning: #d4a574;
            --morning-glow: #e8c9a0;
            --evening: #7a6b8a;
            --evening-glow: #b8a8c8;
            --success: #6b8e6b;
            --highlight: #f5e6c8;
            --shadow: rgba(44,24,16,0.08);
            --grain: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Crimson Pro', Georgia, serif;
            background: var(--paper);
            color: var(--ink);
            margin: 0;
            min-height: 100vh;
            line-height: 1.6;
            background-image: var(--grain);
            background-attachment: fixed;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 32px 20px 80px;
        }

        /* Header */
        .journal-header {
            text-align: center;
            padding: 40px 0 32px;
            position: relative;
        }
        .journal-header::after {
            content: '';
            display: block;
            width: 60px;
            height: 2px;
            background: var(--accent);
            margin: 24px auto 0;
            border-radius: 1px;
        }
        .journal-header h1 {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 2.2em;
            font-weight: 600;
            letter-spacing: -0.02em;
            margin: 0 0 8px;
            color: var(--ink);
        }
        .journal-header .subtitle {
            font-size: 1.05em;
            color: var(--ink-light);
            font-style: italic;
            margin: 0;
        }
        .journal-header .quote {
            margin-top: 16px;
            font-size: 0.9em;
            color: var(--accent);
            font-style: italic;
            opacity: 0.8;
        }

        /* Tabs */
        .tab-bar {
            display: flex;
            gap: 4px;
            background: var(--paper-deep);
            padding: 6px;
            border-radius: 16px;
            margin-bottom: 28px;
            box-shadow: inset 0 1px 3px var(--shadow);
        }
        .tab-btn {
            flex: 1;
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.85em;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 12px 8px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            background: transparent;
            color: var(--ink-light);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .tab-btn.active {
            background: var(--paper);
            color: var(--ink);
            box-shadow: 0 2px 8px var(--shadow);
        }
        .tab-btn:hover:not(.active) {
            color: var(--ink);
        }
        .tab-btn .badge {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--success);
            margin-left: 6px;
            vertical-align: middle;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .tab-btn .badge.visible { opacity: 1; }

        /* Streak */
        .streak-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 28px;
            padding: 14px 20px;
            background: linear-gradient(135deg, var(--paper-deep), var(--paper));
            border-radius: 14px;
            border: 1px solid rgba(196,120,90,0.15);
            box-shadow: 0 2px 12px var(--shadow);
        }
        .streak-flame {
            font-size: 1.6em;
            animation: flicker 2s ease-in-out infinite;
        }
        @keyframes flicker {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.85; }
        }
        .streak-text {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.9em;
            color: var(--ink-light);
        }
        .streak-text strong {
            color: var(--accent-dark);
            font-weight: 600;
        }

        /* Entry form */
        .entry-form {
            background: var(--paper);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 24px rgba(44,24,16,0.06), 0 1px 3px rgba(44,24,16,0.04);
            border: 1px solid rgba(196,120,90,0.1);
            position: relative;
            overflow: hidden;
        }
        .entry-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--mode-color, var(--morning));
            border-radius: 20px 20px 0 0;
        }
        .entry-form.morning { --mode-color: var(--morning); }
        .entry-form.evening { --mode-color: var(--evening); }

        .form-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .form-header .icon {
            font-size: 1.4em;
        }
        .form-header h2 {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.15em;
            font-weight: 600;
            margin: 0;
            color: var(--ink);
        }
        .form-header .time-hint {
            margin-left: auto;
            font-size: 0.8em;
            color: var(--ink-light);
            font-style: italic;
        }

        .question-block {
            margin-bottom: 22px;
            animation: slideUp 0.4s ease both;
        }
        .question-block:nth-child(2) { animation-delay: 0.05s; }
        .question-block:nth-child(3) { animation-delay: 0.1s; }
        .question-block:nth-child(4) { animation-delay: 0.15s; }
        .question-block:nth-child(5) { animation-delay: 0.2s; }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .question-label {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.82em;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--accent);
            margin-bottom: 8px;
            display: block;
        }
        .question-block textarea {
            width: 100%;
            min-height: 64px;
            padding: 14px 16px;
            border: 1.5px solid rgba(196,120,90,0.2);
            border-radius: 12px;
            background: var(--paper-deep);
            font-family: 'Crimson Pro', Georgia, serif;
            font-size: 1.05em;
            color: var(--ink);
            line-height: 1.55;
            resize: vertical;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .question-block textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(196,120,90,0.1);
        }
        .question-block textarea::placeholder {
            color: rgba(92,64,51,0.4);
            font-style: italic;
        }

        .multi-inputs {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .multi-inputs textarea {
            min-height: 50px;
        }

        .weekly-challenge {
            background: linear-gradient(135deg, var(--highlight), rgba(245,230,200,0.5));
            border-radius: 14px;
            padding: 18px 20px;
            margin: 24px 0;
            border: 1px dashed rgba(196,120,90,0.3);
            position: relative;
        }
        .weekly-challenge .wc-label {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.75em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent-dark);
            margin-bottom: 6px;
        }
        .weekly-challenge .wc-text {
            font-size: 1.05em;
            font-style: italic;
            color: var(--ink);
            line-height: 1.5;
        }
        .weekly-challenge .wc-refresh {
            position: absolute;
            top: 14px;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            opacity: 0.5;
            transition: opacity 0.2s;
        }
        .weekly-challenge .wc-refresh:hover { opacity: 1; }

        .submit-btn {
            width: 100%;
            padding: 16px;
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.95em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            border: none;
            border-radius: 14px;
            background: var(--accent);
            color: white;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 16px rgba(196,120,90,0.3);
            margin-top: 8px;
        }
        .submit-btn:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(196,120,90,0.35);
        }
        .submit-btn:active {
            transform: translateY(0);
        }
        .submit-btn.saved {
            background: var(--success);
            box-shadow: 0 4px 16px rgba(107,142,107,0.3);
        }

        /* History */
        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 40px 0 20px;
        }
        .history-header h2 {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.1em;
            font-weight: 600;
            margin: 0;
        }
        .history-header .count {
            font-size: 0.85em;
            color: var(--ink-light);
            background: var(--paper-deep);
            padding: 4px 12px;
            border-radius: 20px;
        }

        .entry-card {
            background: var(--paper);
            border-radius: 16px;
            padding: 22px 24px;
            margin-bottom: 16px;
            box-shadow: 0 2px 12px var(--shadow);
            border: 1px solid rgba(196,120,90,0.08);
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        .entry-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44,24,16,0.1);
        }
        .entry-card .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }
        .entry-card .card-date {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.8em;
            font-weight: 500;
            color: var(--accent);
        }
        .entry-card .card-type {
            font-size: 0.75em;
            padding: 2px 10px;
            border-radius: 20px;
            font-family: 'Josefin Sans', sans-serif;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .entry-card .card-type.morning {
            background: var(--morning-glow);
            color: var(--accent-dark);
        }
        .entry-card .card-type.evening {
            background: var(--evening-glow);
            color: #4a3a5a;
        }
        .entry-card .card-preview {
            font-size: 0.95em;
            color: var(--ink-light);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .entry-card .card-expand {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px dashed rgba(196,120,90,0.2);
            display: none;
        }
        .entry-card.expanded .card-expand { display: block; }
        .entry-card.expanded .card-preview { display: none; }
        .entry-card .expand-btn {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.75em;
            color: var(--accent);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .entry-card .expand-btn:hover { color: var(--accent-dark); }
        .entry-card .delete-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1em;
            opacity: 0.3;
            transition: opacity 0.2s;
            padding: 4px;
        }
        .entry-card .delete-btn:hover { opacity: 0.7; }

        .expand-content .q-item {
            margin-bottom: 14px;
        }
        .expand-content .q-item:last-child { margin-bottom: 0; }
        .expand-content .q-title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.75em;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--accent);
            margin-bottom: 4px;
        }
        .expand-content .q-answer {
            font-size: 1em;
            color: var(--ink);
            line-height: 1.5;
            white-space: pre-wrap;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--ink-light);
        }
        .empty-state .empty-icon {
            font-size: 3em;
            margin-bottom: 16px;
            opacity: 0.4;
        }
        .empty-state p {
            font-style: italic;
            margin: 0;
        }

        /* Footer */
        .journal-footer {
            text-align: center;
            margin-top: 48px;
            padding-top: 24px;
            border-top: 1px solid rgba(196,120,90,0.15);
            font-size: 0.8em;
            color: rgba(92,64,51,0.5);
        }
        .journal-footer a {
            color: var(--accent);
            text-decoration: none;
        }
        .journal-footer a:hover { text-decoration: underline; }

        /* Export */
        .export-bar {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            justify-content: center;
        }
        .export-bar button {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 0.75em;
            padding: 8px 16px;
            border: 1.5px solid rgba(196,120,90,0.25);
            border-radius: 10px;
            background: var(--paper);
            color: var(--ink-light);
            cursor: pointer;
            transition: all 0.2s;
        }
        .export-bar button:hover {
            border-color: var(--accent);
            color: var(--accent-dark);
        }

        /* Responsive */
        @media (max-width: 520px) {
            .container { padding: 20px 14px 60px; }
            .journal-header h1 { font-size: 1.7em; }
            .entry-form { padding: 20px; }
            .tab-btn { font-size: 0.75em; padding: 10px 4px; }
        }

        /* Confetti for save */
        .confetti-piece {
            position: fixed;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="journal-header">
            <h1>5-Minute Journal</h1>
            <p class="subtitle">A guided gratitude practice, inspired by Jon's pen-and-paper discovery</p>
            <p class="quote">"Focus on the good, and the good gets better."</p>
        </header>

        <div class="streak-bar" id="streakBar">
            <span class="streak-flame">🔥</span>
            <span class="streak-text">Start your streak — write your first entry today</span>
        </div>

        <div class="tab-bar">
            <button class="tab-btn active" data-tab="morning" onclick="switchTab('morning')">
                🌅 Morning
                <span class="badge" id="morningBadge"></span>
            </button>
            <button class="tab-btn" data-tab="evening" onclick="switchTab('evening')">
                🌙 Evening
                <span class="badge" id="eveningBadge"></span>
            </button>
            <button class="tab-btn" data-tab="history" onclick="switchTab('history')">
                📖 History
            </button>
        </div>

        <!-- Morning Form -->
        <div class="tab-panel" id="morningPanel">
            <div class="entry-form morning">
                <div class="form-header">
                    <span class="icon">🌅</span>
                    <h2>Morning Entry</h2>
                    <span class="time-hint">Takes ~2 min</span>
                </div>

                <div class="question-block">
                    <label class="question-label">I am grateful for...</label>
                    <div class="multi-inputs">
                        <textarea placeholder="1. Something small and near..." id="m-grateful-1"></textarea>
                        <textarea placeholder="2. Someone in my life..." id="m-grateful-2"></textarea>
                        <textarea placeholder="3. A simple pleasure..." id="m-grateful-3"></textarea>
                    </div>
                </div>

                <div class="question-block">
                    <label class="question-label">What would make today great?</label>
                    <div class="multi-inputs">
                        <textarea placeholder="1. One meaningful thing..." id="m-great-1"></textarea>
                        <textarea placeholder="2. A small win..." id="m-great-2"></textarea>
                        <textarea placeholder="3. How I'll show up..." id="m-great-3"></textarea>
                    </div>
                </div>

                <div class="question-block">
                    <label class="question-label">Daily affirmation</label>
                    <textarea placeholder="I am... / Today I will..." id="m-affirmation"></textarea>
                </div>

                <div class="weekly-challenge" id="morningChallenge">
                    <button class="wc-refresh" onclick="refreshChallenge('morning')" title="New challenge">↻</button>
                    <div class="wc-label">Weekly Challenge</div>
                    <div class="wc-text" id="morningChallengeText">Write a handwritten note to someone you appreciate.</div>
                </div>

                <button class="submit-btn" id="morningSubmit" onclick="saveEntry('morning')">Save Morning Entry</button>
            </div>
        </div>

        <!-- Evening Form -->
                <div class="tab-panel" id="eveningPanel" style="display:none">
            <div class="entry-form evening">
                <div class="form-header">
                    <span class="icon">🌙</span>
                    <h2>Evening Entry</h2>
                    <span class="time-hint">Takes ~3 min</span>
                </div>

                <div class="question-block">
                    <label class="question-label">3 amazing things that happened today</label>
                    <div class="multi-inputs">
                        <textarea placeholder="1. A moment of joy..." id="e-amazing-1"></textarea>
                        <textarea placeholder="2. Something that went well..." id="e-amazing-2"></textarea>
                        <textarea placeholder="3. A kindness I noticed..." id="e-amazing-3"></textarea>
                    </div>
                </div>

                <div class="question-block">
                    <label class="question-label">How could I have made today even better?</label>
                    <textarea placeholder="One small thing I could have done differently..." id="e-better"></textarea>
                </div>

                <div class="weekly-challenge" id="eveningChallenge">
                    <button class="wc-refresh" onclick="refreshChallenge('evening')" title="New challenge">↻</button>
                    <div class="wc-label">Evening Reflection</div>
                    <div class="wc-text" id="eveningChallengeText">What moment today made you feel most alive?</div>
                </div>

                <button class="submit-btn" id="eveningSubmit" onclick="saveEntry('evening')">Save Evening Entry</button>
            </div>
        </div>

        <!-- History -->
        <div class="tab-panel" id="historyPanel" style="display:none">
            <div class="history-header">
                <h2>Your Entries</h2>
                <span class="count" id="entryCount">0 entries</span>
            </div>
            <div id="entriesList"></div>
            <div class="export-bar">
                <button onclick="exportJSON()">Export JSON</button>
                <button onclick="exportText()">Export Text</button>
                <button onclick="clearAll()">Clear All</button>
            </div>
        </div>

        <footer class="journal-footer">
            <p>Inspired by Jon's <a href="https://jona.ca/2016/07/5-minute-journal.html">5-Minute Journal</a> post</p>
            <p style="margin-top:4px;opacity:0.7;">Built by Chloe — Entries stay in your browser</p>
        </footer>
    </div>

    <script>
        const STORAGE_KEY = 'fiveMinuteJournal_entries_v1';
        const CHALLENGE_KEY = 'fiveMinuteJournal_challenges';

        const morningChallenges = [
            "Write a handwritten note to someone you appreciate.",
            "Do one thing you've been procrastinating on for 5 minutes.",
            "Eat breakfast without looking at a screen.",
            "Send a text to someone saying you're thinking of them.",
            "Take a 10-minute walk without your phone.",
            "Compliment a stranger genuinely.",
            "Read one page of a physical book before bed tonight.",
            "Drink a full glass of water before your morning coffee.",
            "Call someone you haven't spoken to in a month.",
            "Tidy one small space that bothers you.",
            "Spend 5 minutes in silence before starting your day.",
            "Write down 3 things you're looking forward to this week.",
            "Cook something from scratch today.",
            "Leave your phone in another room during dinner.",
            "Write a letter to your future self.",
            "Do one thing that scares you, even a little.",
            "Give something away that you no longer need.",
            "Learn one new word and use it today.",
            "Listen to an album from start to finish without skipping.",
            "Plant something, even if it's just a windowsill herb."
        ];

        const eveningReflections = [
            "What moment today made you feel most alive?",
            "When did you feel closest to God today?",
            "What was the kindest thing someone did for you?",
            "What did you learn about yourself today?",
            "Which of today's worries turned out to be nothing?",
            "What made you laugh out loud?",
            "What are you proud of from today?",
            "What would you do differently with the morning you had?",
            "What small beauty did you notice today?",
            "Who did you think of fondly today?",
            "What problem did you solve today?",
            "What are you carrying into tomorrow that you should let go of?",
            "When did you feel most like yourself today?",
            "What did you create or build today?",
            "What conversation stuck with you?",
            "What was the best thing you ate?",
            "Where did you find peace today?",
            "What are you most grateful for as you close this day?",
            "What challenged you to grow today?",
            "How did you show love today?"
        ];

        let entries = [];
        let currentTab = 'morning';

        function loadEntries() {
            try {
                const raw = localStorage.getItem(STORAGE_KEY);
                entries = raw ? JSON.parse(raw) : [];
            } catch (e) {
                entries = [];
            }
            updateUI();
        }

        function saveEntries() {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(entries));
            updateUI();
        }

        function getTodayStr() {
            return new Date().toISOString().split('T')[0];
        }

        function getNowStr() {
            return new Date().toISOString();
        }

        function hasEntryToday(type) {
            const today = getTodayStr();
            return entries.some(e => e.type === type && e.date.startsWith(today));
        }

        function updateUI() {
            const today = getTodayStr();
            document.getElementById('morningBadge').classList.toggle('visible', hasEntryToday('morning'));
            document.getElementById('eveningBadge').classList.toggle('visible', hasEntryToday('evening'));

            // Update streak
            const streak = calculateStreak();
            const streakBar = document.getElementById('streakBar');
            if (streak > 0) {
                streakBar.innerHTML = `<span class="streak-flame">🔥</span><span class="streak-text"><strong>${streak}</strong> day${streak !== 1 ? 's' : ''} in a row — keep it going!</span>`;
            } else if (hasEntryToday('morning') || hasEntryToday('evening')) {
                streakBar.innerHTML = `<span class="streak-flame">✨</span><span class="streak-text">Entry saved today — come back tomorrow to start a streak!</span>`;
            } else {
                streakBar.innerHTML = `<span class="streak-flame">🔥</span><span class="streak-text">Start your streak — write your first entry today</span>`;
            }

            // Update submit button states
            const mBtn = document.getElementById('morningSubmit');
            if (hasEntryToday('morning')) {
                mBtn.textContent = 'Morning entry saved ✓';
                mBtn.classList.add('saved');
            } else {
                mBtn.textContent = 'Save Morning Entry';
                mBtn.classList.remove('saved');
            }

            const eBtn = document.getElementById('eveningSubmit');
            if (hasEntryToday('evening')) {
                eBtn.textContent = 'Evening entry saved ✓';
                eBtn.classList.add('saved');
            } else {
                eBtn.textContent = 'Save Evening Entry';
                eBtn.classList.remove('saved');
            }

            renderHistory();
        }

        function calculateStreak() {
            if (entries.length === 0) return 0;
            const dates = [...new Set(entries.map(e => e.date.split('T')[0]))].sort().reverse();
            const today = getTodayStr();
            let streak = 0;
            let checkDate = new Date(today);
            for (const d of dates) {
                const ds = checkDate.toISOString().split('T')[0];
                if (d === ds) {
                    streak++;
                    checkDate.setDate(checkDate.getDate() - 1);
                } else if (streak === 0 && d === today) {
                    streak++;
                    checkDate.setDate(checkDate.getDate() - 1);
                } else {
                    break;
                }
            }
            return streak;
        }

        function switchTab(tab) {
            currentTab = tab;
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.toggle('active', b.dataset.tab === tab));
            document.getElementById('morningPanel').style.display = tab === 'morning' ? '' : 'none';
            document.getElementById('eveningPanel').style.display = tab === 'evening' ? '' : 'none';
            document.getElementById('historyPanel').style.display = tab === 'history' ? '' : 'none';

            if (tab === 'history') {
                renderHistory();
            }
        }

        function getChallenge(type) {
            const key = CHALLENGE_KEY + '_' + type;
            const saved = localStorage.getItem(key);
            const list = type === 'morning' ? morningChallenges : eveningReflections;
            if (saved) {
                const data = JSON.parse(saved);
                if (data.date === getTodayStr() && list.includes(data.text)) {
                    return data.text;
                }
            }
            const text = list[Math.floor(Math.random() * list.length)];
            localStorage.setItem(key, JSON.stringify({ date: getTodayStr(), text }));
            return text;
        }

        function refreshChallenge(type) {
            const list = type === 'morning' ? morningChallenges : eveningReflections;
            const text = list[Math.floor(Math.random() * list.length)];
            localStorage.setItem(CHALLENGE_KEY + '_' + type, JSON.stringify({ date: getTodayStr(), text }));
            document.getElementById(type + 'ChallengeText').textContent = text;
        }

        function saveEntry(type) {
            if (hasEntryToday(type)) {
                if (!confirm('You already saved a ' + type + ' entry today. Overwrite it?')) return;
                const today = getTodayStr();
                entries = entries.filter(e => !(e.type === type && e.date.startsWith(today)));
            }

            const data = { type, date: getNowStr(), answers: {} };
            if (type === 'morning') {
                data.answers['grateful'] = [
                    document.getElementById('m-grateful-1').value.trim(),
                    document.getElementById('m-grateful-2').value.trim(),
                    document.getElementById('m-grateful-3').value.trim()
                ].filter(Boolean);
                data.answers['great'] = [
                    document.getElementById('m-great-1').value.trim(),
                    document.getElementById('m-great-2').value.trim(),
                    document.getElementById('m-great-3').value.trim()
                ].filter(Boolean);
                data.answers['affirmation'] = document.getElementById('m-affirmation').value.trim();
            } else {
                data.answers['amazing'] = [
                    document.getElementById('e-amazing-1').value.trim(),
                    document.getElementById('e-amazing-2').value.trim(),
                    document.getElementById('e-amazing-3').value.trim()
                ].filter(Boolean);
                data.answers['better'] = document.getElementById('e-better').value.trim();
            }

            entries.unshift(data);
            saveEntries();

            // Confetti burst
            spawnConfetti();

            // Show saved state
            updateUI();
        }

        function spawnConfetti() {
            const colors = ['#c4785a', '#d4a574', '#6b8e6b', '#7a6b8a', '#e8c9a0', '#b8a8c8'];
            for (let i = 0; i < 24; i++) {
                const el = document.createElement('div');
                el.className = 'confetti-piece';
                el.style.background = colors[Math.floor(Math.random() * colors.length)];
                el.style.left = (Math.random() * 100) + 'vw';
                el.style.top = '-10px';
                el.style.width = (4 + Math.random() * 6) + 'px';
                el.style.height = el.style.width;
                document.body.appendChild(el);
                const destY = window.innerHeight + 20;
                const destX = (Math.random() - 0.5) * 200;
                const duration = 1000 + Math.random() * 1500;
                el.animate([
                    { transform: 'translate(0,0) rotate(0deg)', opacity: 1 },
                    { transform: `translate(${destX}px, ${destY}px) rotate(${720 + Math.random()*720}deg)`, opacity: 0 }
                ], { duration, easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)' });
                setTimeout(() => el.remove(), duration);
            }
        }

        function renderHistory() {
            const list = document.getElementById('entriesList');
            const count = document.getElementById('entryCount');
            count.textContent = entries.length + ' entr' + (entries.length !== 1 ? 'ies' : 'y');

            if (entries.length === 0) {
                list.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">📔</div>
                        <p>No entries yet. Start with today's morning or evening page.</p>
                    </div>
                `;
                return;
            }

            list.innerHTML = entries.map((e, i) => {
                const d = new Date(e.date);
                const dateStr = d.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' });
                const timeStr = d.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                const preview = Object.values(e.answers).flat().filter(Boolean).join(' · ').substring(0, 120);
                const typeLabel = e.type === 'morning' ? 'Morning' : 'Evening';

                let expandHTML = '';
                if (e.type === 'morning') {
                    const g = e.answers.grateful || [];
                    const gr = e.answers.great || [];
                    expandHTML = `
                        ${g.length ? `<div class="q-item"><div class="q-title">Grateful for</div><div class="q-answer">${g.map(x => '• ' + x).join('\n')}</div></div>` : ''}
                        ${gr.length ? `<div class="q-item"><div class="q-title">What would make today great</div><div class="q-answer">${gr.map(x => '• ' + x).join('\n')}</div></div>` : ''}
                        ${e.answers.affirmation ? `<div class="q-item"><div class="q-title">Affirmation</div><div class="q-answer">${e.answers.affirmation}</div></div>` : ''}
                    `;
                } else {
                    const a = e.answers.amazing || [];
                    expandHTML = `
                        ${a.length ? `<div class="q-item"><div class="q-title">Amazing things today</div><div class="q-answer">${a.map(x => '• ' + x).join('\n')}</div></div>` : ''}
                        ${e.answers.better ? `<div class="q-item"><div class="q-title">How to make today better</div><div class="q-answer">${e.answers.better}</div></div>` : ''}
                    `;
                }

                return `
                    <div class="entry-card" onclick="toggleCard(this)">
                        <button class="delete-btn" onclick="event.stopPropagation(); deleteEntry(${i})" title="Delete">🗑</button>
                        <div class="card-header">
                            <span class="card-date">${dateStr} · ${timeStr}</span>
                            <span class="card-type ${e.type}">${typeLabel}</span>
                        </div>
                        <div class="card-preview">${preview || 'No text entered.'}${preview.length >= 120 ? '...' : ''}</div>
                        <div class="card-expand">
                            <div class="expand-content">${expandHTML}</div>
                        </div>
                        <button class="expand-btn">Read more</button>
                    </div>
                `;
            }).join('');
        }

        function toggleCard(card) {
            card.classList.toggle('expanded');
            const btn = card.querySelector('.expand-btn');
            btn.textContent = card.classList.contains('expanded') ? 'Show less' : 'Read more';
        }

        function deleteEntry(index) {
            if (!confirm('Delete this entry?')) return;
            entries.splice(index, 1);
            saveEntries();
        }

        function exportJSON() {
            const blob = new Blob([JSON.stringify(entries, null, 2)], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'five-minute-journal-' + getTodayStr() + '.json';
            a.click();
            URL.revokeObjectURL(url);
        }

        function exportText() {
            let text = '5-Minute Journal Export\n======================\n\n';
            for (const e of entries) {
                const d = new Date(e.date);
                text += d.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) + '\n';
                text += (e.type === 'morning' ? '🌅 Morning' : '🌙 Evening') + '\n';
                text += '-'.repeat(30) + '\n';
                if (e.type === 'morning') {
                    const g = e.answers.grateful || [];
                    const gr = e.answers.great || [];
                    if (g.length) text += 'Grateful for:\n' + g.map(x => '  • ' + x).join('\n') + '\n\n';
                    if (gr.length) text += 'What would make today great:\n' + gr.map(x => '  • ' + x).join('\n') + '\n\n';
                    if (e.answers.affirmation) text += 'Affirmation:\n  ' + e.answers.affirmation + '\n\n';
                } else {
                    const a = e.answers.amazing || [];
                    if (a.length) text += 'Amazing things today:\n' + a.map(x => '  • ' + x).join('\n') + '\n\n';
                    if (e.answers.better) text += 'How to make today better:\n  ' + e.answers.better + '\n\n';
                }
                text += '\n';
            }
            const blob = new Blob([text], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'five-minute-journal-' + getTodayStr() + '.txt';
            a.click();
            URL.revokeObjectURL(url);
        }

        function clearAll() {
            if (!confirm('Delete ALL entries? This cannot be undone.')) return;
            entries = [];
            saveEntries();
        }

        // Init challenges
        document.getElementById('morningChallengeText').textContent = getChallenge('morning');
        document.getElementById('eveningChallengeText').textContent = getChallenge('evening');

        // Load
        loadEntries();

        // If it's afternoon/evening (after 4pm local), default to evening
        const hour = new Date().getHours();
        if (hour >= 16) {
            switchTab('evening');
        }
    </script>
</body>
</html>
