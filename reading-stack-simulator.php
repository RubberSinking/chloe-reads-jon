<?php
$title = 'Reading Stack Simulator';
$today = date('Y-m-d');
$books = [
    [
        'title' => 'Teach What You Know',
        'category' => 'teaching',
        'energy' => 'practical',
        'note' => 'Floats upward when you are helping someone learn.',
        'score' => 76,
        'color' => '#ffb86b'
    ],
    [
        'title' => 'The Pug Handbook',
        'category' => 'family',
        'energy' => 'light',
        'note' => 'Good for immediate real-life usefulness.',
        'score' => 69,
        'color' => '#ffd36e'
    ],
    [
        'title' => 'The Art of UNIX Programming',
        'category' => 'deep-work',
        'energy' => 'deep',
        'note' => 'The kind of book that rises when the nerd neurons wake up.',
        'score' => 72,
        'color' => '#8be3c1'
    ],
    [
        'title' => 'Basic Economics',
        'category' => 'big-ideas',
        'energy' => 'reflective',
        'note' => 'Worth revisiting when you want clear thinking.',
        'score' => 57,
        'color' => '#87c7ff'
    ],
    [
        'title' => 'Getting Things Done',
        'category' => 'systems',
        'energy' => 'practical',
        'note' => 'A refresher book for when life needs reset energy.',
        'score' => 63,
        'color' => '#b79cff'
    ],
    [
        'title' => 'Programming Pearls',
        'category' => 'deep-work',
        'energy' => 'deep',
        'note' => 'Tiny elegant gems, better when your mind wants craft.',
        'score' => 54,
        'color' => '#ff8da1'
    ],
    [
        'title' => 'Patterns of Enterprise Application Architecture',
        'category' => 'systems',
        'energy' => 'deep',
        'note' => 'Heavy, useful, and slightly intimidating in a noble way.',
        'score' => 49,
        'color' => '#91f2ff'
    ],
    [
        'title' => 'Structure and Interpretation of Computer Programs',
        'category' => 'big-ideas',
        'energy' => 'deep',
        'note' => 'Legendary mountain-climb book energy.',
        'score' => 43,
        'color' => '#c9f27d'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        :root {
            --bg: #f6f1e8;
            --ink: #2a2118;
            --soft: #6c5d4f;
            --card: rgba(255,255,255,0.76);
            --line: rgba(85, 61, 36, 0.14);
            --accent: #7856ff;
            --accent-2: #ff8f5b;
            --shadow: 0 18px 45px rgba(61, 39, 18, 0.14);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.8), transparent 28%),
                linear-gradient(180deg, #fbf7f0 0%, #f3ebdf 100%);
            min-height: 100vh;
        }
        .wrap {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 56px;
        }
        .hero {
            background: linear-gradient(135deg, rgba(255,255,255,0.82), rgba(255,249,240,0.7));
            border: 1px solid var(--line);
            border-radius: 28px;
            padding: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(8px);
        }
        .eyebrow {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(120, 86, 255, 0.1);
            color: #5c41c6;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
        h1 {
            margin: 16px 0 12px;
            font-size: clamp(2rem, 4vw, 4.2rem);
            line-height: 0.98;
            letter-spacing: -0.04em;
        }
        .hero p {
            margin: 0;
            max-width: 760px;
            font-size: 1.05rem;
            line-height: 1.65;
            color: var(--soft);
        }
        .layout {
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 22px;
            margin-top: 22px;
        }
        .panel {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 20px;
        }
        .panel h2, .panel h3 {
            margin: 0 0 12px;
            letter-spacing: -0.03em;
        }
        .chips, .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .chip, button, input, select {
            font: inherit;
        }
        .chip, button {
            border: 1px solid rgba(72, 51, 31, 0.12);
            background: rgba(255,255,255,0.86);
            color: var(--ink);
            border-radius: 999px;
            padding: 10px 14px;
            cursor: pointer;
            transition: transform 0.18s ease, background 0.18s ease, border-color 0.18s ease;
        }
        .chip:hover, button:hover { transform: translateY(-1px); }
        .chip.active {
            background: linear-gradient(135deg, var(--accent), #9f74ff);
            color: white;
            border-color: transparent;
        }
        .primary {
            background: linear-gradient(135deg, var(--accent), #9f74ff);
            color: white;
            border-color: transparent;
        }
        .secondary {
            background: linear-gradient(135deg, #fff2df, #ffe4cf);
        }
        .stack-zone {
            position: relative;
            min-height: 500px;
            border-radius: 22px;
            background:
                linear-gradient(180deg, rgba(255,255,255,0.55), rgba(255,250,242,0.78)),
                repeating-linear-gradient(90deg, rgba(120, 86, 255, 0.03) 0 1px, transparent 1px 40px);
            border: 1px solid var(--line);
            overflow: hidden;
            padding: 24px 18px 18px;
        }
        .stack-label {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #7d6a59;
            font-weight: 800;
        }
        .stack-base {
            position: absolute;
            left: 22px;
            right: 22px;
            bottom: 16px;
            height: 16px;
            border-radius: 999px;
            background: linear-gradient(180deg, #b68556, #7d4b25);
            opacity: 0.92;
        }
        .book {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: min(92%, 420px);
            border-radius: 18px 20px 20px 18px;
            padding: 16px 18px 16px 22px;
            color: #23180f;
            box-shadow: 0 12px 26px rgba(55, 37, 17, 0.18);
            border-left: 10px solid rgba(42, 27, 15, 0.15);
            transition: top 0.45s cubic-bezier(.2,.8,.2,1), transform 0.45s cubic-bezier(.2,.8,.2,1), box-shadow 0.2s ease;
        }
        .book.top {
            box-shadow: 0 20px 36px rgba(55, 37, 17, 0.28);
            transform: translateX(-50%) scale(1.02);
        }
        .book-title {
            font-weight: 800;
            font-size: 1.08rem;
            letter-spacing: -0.02em;
        }
        .book-meta {
            margin-top: 6px;
            font-size: 0.84rem;
            color: rgba(35, 24, 15, 0.75);
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .book-note {
            margin-top: 10px;
            font-size: 0.92rem;
            line-height: 1.45;
            color: rgba(35, 24, 15, 0.82);
        }
        .top-card {
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(120, 86, 255, 0.1), rgba(255,143,91,0.1));
            border: 1px solid rgba(120, 86, 255, 0.14);
            margin-bottom: 18px;
        }
        .top-card strong {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 4px;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin: 16px 0;
        }
        .stat {
            background: rgba(255,255,255,0.8);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 12px;
        }
        .stat-label {
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #7a6756;
            margin-bottom: 6px;
        }
        .stat-value {
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.03em;
        }
        .log {
            margin-top: 14px;
            max-height: 180px;
            overflow: auto;
            padding-right: 6px;
        }
        .log-item {
            padding: 10px 0;
            border-bottom: 1px dashed rgba(78, 57, 35, 0.14);
            font-size: 0.92rem;
            line-height: 1.45;
            color: var(--soft);
        }
        form {
            display: grid;
            gap: 10px;
            margin-top: 18px;
        }
        input, select {
            width: 100%;
            border: 1px solid rgba(72, 51, 31, 0.14);
            background: rgba(255,255,255,0.95);
            border-radius: 14px;
            padding: 12px 14px;
        }
        .mini {
            font-size: 0.88rem;
            color: var(--soft);
            line-height: 1.55;
        }
        .footer-note {
            margin-top: 24px;
            font-size: 0.88rem;
            color: #756453;
        }
        @media (max-width: 900px) {
            .layout { grid-template-columns: 1fr; }
            .stack-zone { min-height: 440px; }
        }
        @media (max-width: 640px) {
            .wrap { width: min(100% - 18px, 1120px); padding-top: 18px; }
            .hero, .panel { border-radius: 22px; padding: 18px; }
            .stats { grid-template-columns: 1fr; }
            .book { width: calc(100% - 18px); }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <section class="hero">
            <div class="eyebrow">FILO reading lab • <?= htmlspecialchars($today) ?></div>
            <h1>Reading Stack Simulator</h1>
            <p>
                Jon once described his real-life pile of books as a first-in-last-out stack: the useful books float to the top, the dusty ones sink, and the mood of the moment changes everything.
                This little lab turns that idea into a tactile browser toy. Tap a reason for reading, watch the stack reshuffle, and build your own living pile.
            </p>
        </section>

        <div class="layout">
            <section class="panel">
                <h2>What kind of reading moment is this?</h2>
                <p class="mini">Choose a mood and the stack reorders itself. Books that match the moment rise. Others patiently drift downward, like neglected noble intentions.</p>
                <div class="chips" id="moodChips"></div>
                <div class="toolbar" style="margin-top: 14px;">
                    <button class="primary" id="surpriseBtn">Surprise my stack</button>
                    <button class="secondary" id="resetBtn">Restore Jon's sample pile</button>
                </div>
                <div class="stack-zone" id="stackZone" aria-live="polite">
                    <div class="stack-label">Top of stack</div>
                    <div class="stack-base"></div>
                </div>
                <div class="footer-note">Idea: if a book keeps floating upward, it probably belongs nearby. If it never does, maybe it wants a different shelf, or mercy.</div>
            </section>

            <section class="panel">
                <div class="top-card">
                    <div class="mini">Current top book</div>
                    <strong id="topTitle">Loading stack...</strong>
                    <div id="topReason" class="mini"></div>
                </div>

                <div class="stats">
                    <div class="stat">
                        <div class="stat-label">Current mood</div>
                        <div class="stat-value" id="statMood">Practical</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Turns played</div>
                        <div class="stat-value" id="statTurns">0</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Custom books</div>
                        <div class="stat-value" id="statCustom">0</div>
                    </div>
                </div>

                <h3>How it works</h3>
                <p class="mini">Each book has a hidden momentum score. Matching your reading need boosts it. Freshly opened books also gain lift. Over time, a real pattern emerges: the books you actually use float upward without guilt-tripping the ones below.</p>

                <div class="toolbar" style="margin-top: 10px;">
                    <button id="openTopBtn">Open top book</button>
                    <button id="nudgeBtn">Nudge toward usefulness</button>
                </div>

                <div class="log" id="log"></div>

                <h3 style="margin-top: 20px;">Add your own book</h3>
                <form id="addBookForm">
                    <input type="text" id="bookTitle" placeholder="Book title" required>
                    <select id="bookCategory">
                        <option value="deep-work">Deep work</option>
                        <option value="systems">Systems</option>
                        <option value="big-ideas">Big ideas</option>
                        <option value="family">Family</option>
                        <option value="faith">Faith</option>
                        <option value="teaching">Teaching</option>
                    </select>
                    <select id="bookEnergy">
                        <option value="practical">Practical</option>
                        <option value="light">Light</option>
                        <option value="reflective">Reflective</option>
                        <option value="deep">Deep</option>
                    </select>
                    <button class="primary" type="submit">Add to stack</button>
                </form>
            </section>
        </div>
    </div>

    <script>
        const seedBooks = <?= json_encode($books, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const moods = [
            { key: 'practical', label: 'Practical reset', boosts: ['systems', 'teaching'], energies: ['practical'] },
            { key: 'deep-work', label: 'Deep work', boosts: ['deep-work', 'systems'], energies: ['deep'] },
            { key: 'big-ideas', label: 'Big ideas', boosts: ['big-ideas', 'faith'], energies: ['reflective', 'deep'] },
            { key: 'family', label: 'Family usefulness', boosts: ['family'], energies: ['light', 'practical'] },
            { key: 'faith', label: 'Faith and meaning', boosts: ['faith', 'big-ideas'], energies: ['reflective'] },
            { key: 'teaching', label: 'Teach someone', boosts: ['teaching', 'systems'], energies: ['practical', 'reflective'] }
        ];

        const state = {
            books: [],
            mood: moods[0],
            turns: 0,
            customCount: 0,
        };

        const els = {
            moodChips: document.getElementById('moodChips'),
            stackZone: document.getElementById('stackZone'),
            topTitle: document.getElementById('topTitle'),
            topReason: document.getElementById('topReason'),
            statMood: document.getElementById('statMood'),
            statTurns: document.getElementById('statTurns'),
            statCustom: document.getElementById('statCustom'),
            log: document.getElementById('log'),
            surpriseBtn: document.getElementById('surpriseBtn'),
            resetBtn: document.getElementById('resetBtn'),
            openTopBtn: document.getElementById('openTopBtn'),
            nudgeBtn: document.getElementById('nudgeBtn'),
            addBookForm: document.getElementById('addBookForm'),
            bookTitle: document.getElementById('bookTitle'),
            bookCategory: document.getElementById('bookCategory'),
            bookEnergy: document.getElementById('bookEnergy')
        };

        function cloneBooks() {
            return seedBooks.map((book, index) => ({ ...book, id: `seed-${index}`, opened: 0, custom: false }));
        }

        function save() {
            localStorage.setItem('readingStackSimulatorState', JSON.stringify({
                books: state.books,
                mood: state.mood.key,
                turns: state.turns,
                customCount: state.customCount
            }));
        }

        function load() {
            const raw = localStorage.getItem('readingStackSimulatorState');
            if (!raw) {
                state.books = cloneBooks();
                return;
            }
            try {
                const parsed = JSON.parse(raw);
                state.books = parsed.books?.length ? parsed.books : cloneBooks();
                state.turns = parsed.turns || 0;
                state.customCount = parsed.customCount || 0;
                state.mood = moods.find(m => m.key === parsed.mood) || moods[0];
            } catch {
                state.books = cloneBooks();
            }
        }

        function log(message) {
            const item = document.createElement('div');
            item.className = 'log-item';
            item.textContent = message;
            els.log.prepend(item);
            while (els.log.children.length > 8) {
                els.log.removeChild(els.log.lastChild);
            }
        }

        function randomPastel() {
            const palette = ['#ffd36e', '#8be3c1', '#87c7ff', '#ff8da1', '#c9f27d', '#f0b3ff', '#91f2ff', '#ffb86b'];
            return palette[Math.floor(Math.random() * palette.length)];
        }

        function applyMood(mood, note = null) {
            state.mood = mood;
            state.turns += 1;
            state.books = state.books.map(book => {
                let score = book.score;
                if (mood.boosts.includes(book.category)) score += 16;
                if (mood.energies.includes(book.energy)) score += 11;
                score += Math.min(book.opened * 4, 16);
                score -= Math.random() * 6;
                return { ...book, score: Math.max(8, Math.round(score * 0.92)) };
            }).sort((a, b) => b.score - a.score);
            if (note) log(note);
            render();
            save();
        }

        function surpriseStack() {
            const mood = moods[Math.floor(Math.random() * moods.length)];
            applyMood(mood, `A random reading mood rolled in: ${mood.label}.`);
        }

        function openTopBook() {
            if (!state.books.length) return;
            const top = state.books[0];
            top.opened += 1;
            top.score += 18;
            log(`You opened “${top.title}”. Naturally, it clings to the top of the pile.`);
            state.books.sort((a, b) => b.score - a.score);
            render();
            save();
        }

        function nudgeUsefulness() {
            state.books = state.books.map((book, index) => ({
                ...book,
                score: book.score + (index < 3 ? 8 : -2)
            })).sort((a, b) => b.score - a.score);
            state.turns += 1;
            log('You tidied the stack. The likely candidates for actual use moved closer to daylight.');
            render();
            save();
        }

        function renderChips() {
            els.moodChips.innerHTML = '';
            moods.forEach(mood => {
                const chip = document.createElement('button');
                chip.className = 'chip' + (state.mood.key === mood.key ? ' active' : '');
                chip.textContent = mood.label;
                chip.addEventListener('click', () => applyMood(mood, `Mood selected: ${mood.label}.`));
                els.moodChips.appendChild(chip);
            });
        }

        function renderStack() {
            els.stackZone.querySelectorAll('.book').forEach(el => el.remove());
            const total = state.books.length;
            state.books.slice().reverse().forEach((book, reverseIndex) => {
                const actualIndex = total - reverseIndex - 1;
                const card = document.createElement('article');
                card.className = 'book' + (actualIndex === 0 ? ' top' : '');
                card.style.background = `linear-gradient(135deg, ${book.color}, color-mix(in srgb, ${book.color} 70%, white))`;
                card.style.top = `${44 + reverseIndex * 36}px`;
                card.style.zIndex = `${40 + reverseIndex}`;
                card.innerHTML = `
                    <div class="book-title">${escapeHtml(book.title)}</div>
                    <div class="book-meta">
                        <span>${labelize(book.category)}</span>
                        <span>• ${labelize(book.energy)}</span>
                        <span>• score ${book.score}</span>
                    </div>
                    <div class="book-note">${escapeHtml(book.note)}</div>
                `;
                card.addEventListener('click', () => {
                    book.opened += 1;
                    book.score += 10;
                    state.books.sort((a, b) => b.score - a.score);
                    log(`You tapped “${book.title}”. It gained enough momentum to shuffle upward.`);
                    render();
                    save();
                });
                els.stackZone.appendChild(card);
            });
        }

        function renderTop() {
            const top = state.books[0];
            if (!top) return;
            els.topTitle.textContent = top.title;
            els.topReason.textContent = `${labelize(top.category)} • ${labelize(top.energy)} • ${top.note}`;
        }

        function renderStats() {
            els.statMood.textContent = state.mood.label;
            els.statTurns.textContent = state.turns;
            els.statCustom.textContent = state.customCount;
        }

        function render() {
            renderChips();
            renderStack();
            renderTop();
            renderStats();
        }

        function labelize(value) {
            return value.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
        }

        function escapeHtml(str) {
            return str
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#39;');
        }

        els.surpriseBtn.addEventListener('click', surpriseStack);
        els.resetBtn.addEventListener('click', () => {
            state.books = cloneBooks();
            state.turns = 0;
            state.customCount = 0;
            state.mood = moods[0];
            els.log.innerHTML = '';
            log("Jon's original sample stack is back on the desk.");
            render();
            save();
        });
        els.openTopBtn.addEventListener('click', openTopBook);
        els.nudgeBtn.addEventListener('click', nudgeUsefulness);
        els.addBookForm.addEventListener('submit', (event) => {
            event.preventDefault();
            const title = els.bookTitle.value.trim();
            if (!title) return;
            const category = els.bookCategory.value;
            const energy = els.bookEnergy.value;
            state.books.push({
                id: `custom-${Date.now()}`,
                title,
                category,
                energy,
                note: 'A custom addition to the living stack.',
                score: 58 + Math.floor(Math.random() * 10),
                color: randomPastel(),
                opened: 0,
                custom: true
            });
            state.customCount += 1;
            state.books.sort((a, b) => b.score - a.score);
            log(`Added “${title}” to the pile. May it earn its altitude honestly.`);
            els.addBookForm.reset();
            render();
            save();
        });

        load();
        render();
        log('The stack is ready. Choose a reading mood to see which book rises first.');
    </script>
</body>
</html>
