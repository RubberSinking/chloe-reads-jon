<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker News Comment Bingo</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, sans-serif; background: #f6f6ef; color: #1a1a1a; margin: 0; padding: 24px 16px 64px; min-height: 100vh; }
        .container { max-width: 600px; margin: 0 auto; }
        header { text-align: center; margin-bottom: 28px; }
        .logo { display: inline-block; background: #ff6600; color: white; font-weight: 900; font-size: 1.1em; padding: 4px 10px; border-radius: 3px; letter-spacing: -0.5px; margin-bottom: 10px; }
        h1 { font-size: 1.7em; font-weight: 800; margin: 0 0 6px; letter-spacing: -0.5px; }
        .subtitle { color: #666; font-size: 0.9em; margin: 0 0 16px; }
        .topic-bar { display: flex; gap: 10px; margin-bottom: 20px; align-items: center; flex-wrap: wrap; }
        .topic-bar label { font-size: 0.85em; font-weight: 600; color: #555; white-space: nowrap; }
        #topicInput { flex: 1; min-width: 140px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 0.9em; font-family: inherit; background: white; }
        #topicInput:focus { outline: none; border-color: #ff6600; box-shadow: 0 0 0 2px rgba(255,102,0,0.15); }
        .btn { padding: 8px 18px; background: #ff6600; color: white; border: none; border-radius: 6px; font-size: 0.9em; font-weight: 700; cursor: pointer; white-space: nowrap; font-family: inherit; transition: background 0.15s; }
        .btn:hover { background: #e05500; }
        .btn-secondary { background: white; color: #ff6600; border: 1.5px solid #ff6600; }
        .btn-secondary:hover { background: #fff4ec; }
        .bingo-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 6px; margin-bottom: 16px; }
        .cell { aspect-ratio: 1; background: white; border: 2px solid #e0e0d8; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-align: center; font-size: clamp(0.55em, 2vw, 0.75em); line-height: 1.25; padding: 6px 4px; cursor: pointer; transition: all 0.15s; user-select: none; color: #333; position: relative; font-weight: 500; }
        .cell:hover:not(.free) { border-color: #ff6600; background: #fff9f5; }
        .cell.marked { background: #ff6600; border-color: #e05500; color: white; font-weight: 700; }
        .cell.bingo-line { background: #cc3300; border-color: #aa2200; color: white; transform: scale(1.03); }
        .cell.free { background: #ff6600; color: white; font-weight: 800; font-size: clamp(0.7em, 2.5vw, 0.9em); cursor: default; border-color: #e05500; }
        .score-bar { display: flex; align-items: center; justify-content: space-between; font-size: 0.85em; color: #666; margin-bottom: 12px; flex-wrap: wrap; gap: 8px; }
        .score-val { font-weight: 700; color: #ff6600; font-size: 1.1em; }
        .bingo-banner { display: none; text-align: center; background: linear-gradient(135deg, #ff6600, #ff9933); color: white; border-radius: 12px; padding: 24px 20px; margin-bottom: 16px; animation: pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .bingo-banner.show { display: block; }
        .bingo-banner h2 { font-size: 2.2em; margin: 0 0 6px; letter-spacing: 4px; }
        .bingo-banner p { margin: 0; font-size: 0.95em; opacity: 0.9; }
        @keyframes pop { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .col-headers { display: grid; grid-template-columns: repeat(5, 1fr); gap: 6px; margin-bottom: 4px; }
        .col-header { text-align: center; font-weight: 900; font-size: 1.1em; color: #ff6600; letter-spacing: 2px; }
        footer { margin-top: 32px; text-align: center; font-size: 0.78em; color: #999; }
        footer a { color: #bbb; }
        .current-topic { font-size: 0.8em; color: #888; text-align: center; margin-bottom: 14px; min-height: 1.2em; }
        .current-topic strong { color: #ff6600; }
        @media (max-width: 400px) { .bingo-grid { gap: 4px; } .cell { border-radius: 5px; padding: 4px 3px; } }
    </style>
</head>
<body>
<div class="container">
    <header>
        <div class="logo">Y</div>
        <h1>Hacker News Comment Bingo</h1>
        <p class="subtitle">Open any HN thread. Start clicking.</p>
    </header>

    <div class="topic-bar">
        <label for="topicInput">Topic:</label>
        <input type="text" id="topicInput" placeholder="e.g. PHP, AI startup, Rust, Linux..." maxlength="60">
        <button class="btn btn-secondary" onclick="newCard()">New Card</button>
    </div>

    <div class="current-topic" id="currentTopic"></div>

    <div id="bingoBanner" class="bingo-banner">
        <h2>B I N G O !</h2>
        <p id="bingoMsg">You have won the internet. For today.</p>
    </div>

    <div class="col-headers">
        <div class="col-header">B</div>
        <div class="col-header">I</div>
        <div class="col-header">N</div>
        <div class="col-header">G</div>
        <div class="col-header">O</div>
    </div>

    <div class="bingo-grid" id="bingoGrid"></div>

    <div class="score-bar">
        <span>Marked: <span class="score-val" id="markedCount">0</span> / 24</span>
        <button class="btn" onclick="newCard()" style="font-size:0.82em; padding: 6px 14px;">Shuffle Card</button>
    </div>

    <footer>
        <a href="./">Back to Chloe Reads Jon</a> &nbsp;&middot;&nbsp;
        Inspired by Jon's post about the <a href="https://www.jona.ca/2026/02/in-praise-of-hacker-news-highlights.html">HN Highlights Podcast</a>
    </footer>
</div>

<script>
const ALL_SQUARES = [
    "This was done better in [year]",
    "Actually this is just X but worse",
    "This is a solved problem",
    "The HN effect will kill their servers",
    "Flagged as dupe",
    "Rewrite it in Rust",
    "Have you tried Postgres?",
    "Why not just use SQLite?",
    "Nix would solve this",
    "Have you considered Haskell?",
    "What's the business model?",
    "This doesn't scale",
    "Where's the source code?",
    "This is just marketing",
    "GDPR?",
    "Security nightmare",
    "What about supply chain attacks?",
    "I hope this isn't on prod",
    "SQL injection waiting to happen",
    "Rate limiting?",
    "The title is misleading",
    "Did you benchmark this?",
    "Author clearly hasn't read [paper]",
    "You're conflating two things",
    "Technically it's ML not AI",
    "I built something similar in 2009",
    "Bell Labs did this in the 70s",
    "UNIX philosophy",
    "We used shell scripts for this",
    "Worse is Better",
    "Why not a static site?",
    "This should be a bash script",
    "1000 lines of JS for a button?",
    "Have you considered plain HTML?",
    "No dependencies needed for this",
    "The comments beat the article",
    "Ask HN: Does anyone use this?",
    "Been using this for years",
    "This needs a Show HN",
    "Submitted 3 years ago, still relevant",
    "What data do you collect?",
    "Does it phone home?",
    "Self-host or don't bother",
    "Just use Signal",
    "FOSS alternative exists",
    "Works on my machine",
    "Good luck with enterprise sales",
    "This will be acquired by Google",
    "Give it 6 months",
    "Y Combinator application incoming",
    "Use vim",
    "Have you read the man page?",
    "My startup does this better",
    "This is why we can't have nice things",
    "You're not the target audience",
    "Just use emacs",
    "Link to the research?",
    "Dead on arrival",
    "Why PHP?",
    "Unpopular opinion: this is fine",
];

const BINGO_MSGS = [
    "You have won the internet. For today.",
    "A new PR has been opened: 'Remove HN comment section'",
    "5,000 karma earned. Congratulations, I think.",
    "Your submission is on the front page. Servers are down.",
    "Someone already posted a Show HN about your bingo card.",
    "This comment section has been archived for posterity.",
];

let currentCard = [];
let marked = new Set();

function shuffle(arr) {
    const a = [...arr];
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function newCard() {
    const topic = document.getElementById('topicInput').value.trim();
    const topicEl = document.getElementById('currentTopic');
    topicEl.innerHTML = topic ? 'Card for: <strong>' + escHtml(topic) + '</strong>' : '';
    marked.clear();
    document.getElementById('bingoBanner').classList.remove('show');
    document.getElementById('markedCount').textContent = '0';
    const picked = shuffle(ALL_SQUARES).slice(0, 24);
    picked.splice(12, 0, 'FREE');
    currentCard = picked;
    marked.add(12);
    renderGrid();
}

function renderGrid() {
    const grid = document.getElementById('bingoGrid');
    grid.innerHTML = '';
    currentCard.forEach((text, i) => {
        const cell = document.createElement('div');
        const isFree = (text === 'FREE');
        const isMarked = marked.has(i);
        cell.className = 'cell' + (isFree ? ' free' : '') + (isMarked ? ' marked' : '');
        cell.textContent = text;
        cell.dataset.index = i;
        if (!isFree) cell.addEventListener('click', () => toggleCell(i));
        grid.appendChild(cell);
    });
}

function toggleCell(i) {
    if (marked.has(i)) { marked.delete(i); } else { marked.add(i); }
    marked.add(12); // FREE always marked
    document.getElementById('markedCount').textContent = marked.size - 1;
    renderGrid();
    checkBingo();
}

function checkBingo() {
    const lines = [
        [0,1,2,3,4],[5,6,7,8,9],[10,11,12,13,14],[15,16,17,18,19],[20,21,22,23,24],
        [0,5,10,15,20],[1,6,11,16,21],[2,7,12,17,22],[3,8,13,18,23],[4,9,14,19,24],
        [0,6,12,18,24],[4,8,12,16,20]
    ];
    let bingoLines = [];
    for (const line of lines) {
        if (line.every(i => marked.has(i))) bingoLines.push(line);
    }
    document.querySelectorAll('.cell').forEach(c => c.classList.remove('bingo-line'));
    if (bingoLines.length > 0) {
        bingoLines.flat().forEach(i => {
            const c = document.querySelector('.cell[data-index="' + i + '"]');
            if (c) c.classList.add('bingo-line');
        });
        const msg = BINGO_MSGS[Math.floor(Math.random() * BINGO_MSGS.length)];
        document.getElementById('bingoMsg').textContent = msg;
        const banner = document.getElementById('bingoBanner');
        banner.classList.add('show');
        banner.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
        document.getElementById('bingoBanner').classList.remove('show');
    }
}

function escHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

newCard();
</script>
</body>
</html>
