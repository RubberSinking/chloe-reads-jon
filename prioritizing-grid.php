<?php
// Prioritizing Grid
// Based on a technique from "What Color Is Your Parachute?"
// as described in Jon's 2010 blog post "How to prioritize any list"
$today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prioritizing Grid</title>
<style>
  :root {
    --bg: #1a1a2e;
    --surface: #16213e;
    --surface2: #0f3460;
    --accent: #e94560;
    --accent2: #533483;
    --gold: #f5a623;
    --text: #e0e0e0;
    --text-dim: #9a9ab0;
    --border: #2a2a4a;
    --win: #27ae60;
    --radius: 14px;
    --shadow: 0 8px 32px rgba(0,0,0,0.4);
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Segoe UI', system-ui, sans-serif;
    min-height: 100vh;
    padding: 20px;
  }

  /* ── Header ── */
  .header {
    text-align: center;
    padding: 32px 20px 20px;
    max-width: 700px;
    margin: 0 auto 30px;
  }
  .header h1 {
    font-size: clamp(1.8rem, 5vw, 2.8rem);
    font-weight: 800;
    background: linear-gradient(135deg, var(--gold), var(--accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 10px;
  }
  .header p {
    color: var(--text-dim);
    font-size: 1rem;
    line-height: 1.5;
  }

  /* ── Screens ── */
  .screen { display: none; max-width: 700px; margin: 0 auto; }
  .screen.active { display: block; }

  /* ── Input screen ── */
  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 28px;
    box-shadow: var(--shadow);
    margin-bottom: 20px;
  }
  .card h2 {
    font-size: 1.2rem;
    color: var(--gold);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .card h2 .icon { font-size: 1.4rem; }

  textarea {
    width: 100%;
    height: 200px;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text);
    font-size: 1rem;
    padding: 14px;
    resize: vertical;
    outline: none;
    font-family: inherit;
    line-height: 1.6;
    transition: border-color 0.2s;
  }
  textarea:focus { border-color: var(--accent); }
  textarea::placeholder { color: var(--text-dim); }

  .examples {
    margin-top: 12px;
  }
  .examples p { color: var(--text-dim); font-size: 0.85rem; margin-bottom: 6px; }
  .example-chips { display: flex; flex-wrap: wrap; gap: 6px; }
  .chip {
    background: var(--surface2);
    border: 1px solid var(--border);
    color: var(--text-dim);
    font-size: 0.78rem;
    padding: 4px 10px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.2s;
  }
  .chip:hover { border-color: var(--accent); color: var(--text); }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 14px 28px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.15s, box-shadow 0.15s;
    box-shadow: 0 4px 16px rgba(233,69,96,0.35);
    width: 100%;
    justify-content: center;
    margin-top: 18px;
  }
  .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(233,69,96,0.45); }
  .btn:active { transform: translateY(0); }
  .btn.secondary {
    background: var(--surface2);
    box-shadow: none;
    margin-top: 10px;
  }
  .btn.secondary:hover { background: var(--accent2); box-shadow: none; }

  .item-count {
    font-size: 0.82rem;
    color: var(--text-dim);
    text-align: right;
    margin-top: 6px;
  }
  .item-count span { color: var(--gold); font-weight: 700; }

  /* ── Compare screen ── */
  .progress-wrap {
    margin-bottom: 22px;
  }
  .progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
    color: var(--text-dim);
    margin-bottom: 8px;
  }
  .progress-bar {
    background: var(--border);
    border-radius: 100px;
    height: 8px;
    overflow: hidden;
  }
  .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--accent), var(--gold));
    border-radius: 100px;
    transition: width 0.4s ease;
  }

  .vs-label {
    text-align: center;
    font-size: 0.8rem;
    font-weight: 800;
    color: var(--text-dim);
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 14px;
  }

  .choice-area {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 14px;
    align-items: stretch;
    margin-bottom: 16px;
  }
  .choice-btn {
    background: var(--surface);
    border: 2px solid var(--border);
    border-radius: var(--radius);
    color: var(--text);
    font-size: 1.05rem;
    font-weight: 600;
    padding: 28px 18px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s;
    line-height: 1.4;
    word-break: break-word;
  }
  .choice-btn:hover {
    border-color: var(--accent);
    background: rgba(233,69,96,0.1);
    transform: scale(1.02);
    box-shadow: 0 4px 20px rgba(233,69,96,0.2);
  }
  .choice-btn:active { transform: scale(0.98); }
  .choice-btn.selected {
    border-color: var(--win);
    background: rgba(39,174,96,0.15);
    animation: pulse-win 0.3s ease;
  }
  @keyframes pulse-win {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }
  .vs-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    font-weight: 900;
    color: var(--accent);
    background: var(--surface);
    border: 2px solid var(--border);
    border-radius: 50%;
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    align-self: center;
  }

  .skip-btn {
    background: none;
    border: 1px solid var(--border);
    color: var(--text-dim);
    border-radius: 8px;
    padding: 8px 18px;
    font-size: 0.85rem;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    transition: all 0.2s;
  }
  .skip-btn:hover { border-color: var(--text-dim); color: var(--text); }

  .pair-counter {
    text-align: center;
    font-size: 0.8rem;
    color: var(--text-dim);
    margin-top: 12px;
  }

  /* ── Results screen ── */
  .results-header {
    text-align: center;
    padding: 20px 0 10px;
  }
  .results-header .trophy { font-size: 3rem; margin-bottom: 8px; }
  .results-header h2 {
    font-size: 1.6rem;
    font-weight: 800;
    color: var(--gold);
  }
  .results-header p {
    color: var(--text-dim);
    font-size: 0.9rem;
    margin-top: 4px;
  }

  .result-list { margin-top: 24px; }
  .result-item {
    display: flex;
    align-items: center;
    gap: 14px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 14px 18px;
    margin-bottom: 10px;
    transition: transform 0.2s;
    animation: slideIn 0.3s ease both;
  }
  @keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
  }
  .result-item:hover { transform: translateX(4px); }
  .result-item.rank-1 { border-color: var(--gold); background: rgba(245,166,35,0.08); }
  .result-item.rank-2 { border-color: #aaa; background: rgba(170,170,170,0.06); }
  .result-item.rank-3 { border-color: #cd7f32; background: rgba(205,127,50,0.06); }

  .rank-badge {
    font-size: 1.2rem;
    font-weight: 900;
    min-width: 36px;
    text-align: center;
  }
  .rank-1 .rank-badge { color: var(--gold); }
  .rank-2 .rank-badge { color: #ccc; }
  .rank-3 .rank-badge { color: #cd7f32; }

  .result-name {
    flex: 1;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.3;
  }

  .score-bar-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 100px;
  }
  .score-bar {
    flex: 1;
    height: 6px;
    background: var(--border);
    border-radius: 100px;
    overflow: hidden;
  }
  .score-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--accent), var(--gold));
    border-radius: 100px;
  }
  .score-label {
    font-size: 0.75rem;
    color: var(--text-dim);
    white-space: nowrap;
  }

  .actions { margin-top: 24px; display: flex; flex-direction: column; gap: 10px; }

  /* ── How it works ── */
  .how-it-works {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    margin-top: 24px;
  }
  .how-it-works h3 {
    color: var(--gold);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
  }
  .how-it-works ol {
    color: var(--text-dim);
    font-size: 0.88rem;
    padding-left: 20px;
    line-height: 1.7;
  }

  /* ── Attribution ── */
  .attribution {
    text-align: center;
    font-size: 0.78rem;
    color: var(--text-dim);
    margin-top: 40px;
    padding-bottom: 20px;
  }
  .attribution a { color: var(--accent); text-decoration: none; }

  /* ── Mobile ── */
  @media (max-width: 500px) {
    body { padding: 12px; }
    .choice-area { gap: 8px; }
    .choice-btn { padding: 20px 12px; font-size: 0.95rem; }
    .vs-divider { width: 36px; height: 36px; font-size: 1rem; }
  }
</style>
</head>
<body>

<div class="header">
  <h1>⚖️ Prioritizing Grid</h1>
  <p>Compare everything head-to-head. Find out what you <em>actually</em> care about most.</p>
</div>

<!-- ══ SCREEN 1: Input ══ -->
<div class="screen active" id="screen-input">
  <div class="card">
    <h2><span class="icon">📝</span> Enter Your List</h2>
    <textarea id="items-input" placeholder="One item per line, e.g.:
Morning prayer
Exercise
Read to Nathan
Work on side project
Learn Spanish
Call a friend
Cook a real dinner"></textarea>
    <div class="item-count">Items: <span id="item-count-display">0</span> &nbsp;·&nbsp; Comparisons needed: <span id="pair-count-display">0</span></div>

    <div class="examples">
      <p>Try an example list:</p>
      <div class="example-chips">
        <span class="chip" data-list="Morning prayer
Exercise
Read to Nathan
Work on side project
Cook a real dinner
Call a friend
Journaling
Learn something new">Evening activities</span>
        <span class="chip" data-list="More family time
Career advancement
Financial security
Better health
Spiritual growth
Creative outlets
Social connection
Learning and growth">Life priorities</span>
        <span class="chip" data-list="Finish the feature
Write tests
Fix that annoying bug
Code review backlog
Update documentation
Refactor the mess
Deploy to staging
Talk to design">Work tasks</span>
      </div>
    </div>
  </div>

  <div class="how-it-works">
    <h3>How it works</h3>
    <ol>
      <li>Enter your list of items (2–20 items work best)</li>
      <li>Compare each pair — click the one that matters more to you</li>
      <li>The tool tallies the wins and gives you a ranked list</li>
      <li>No agonizing — just go with your gut on each comparison</li>
    </ol>
  </div>

  <button class="btn" id="start-btn">▶ &nbsp;Start Comparing</button>
</div>

<!-- ══ SCREEN 2: Compare ══ -->
<div class="screen" id="screen-compare">
  <div class="progress-wrap">
    <div class="progress-label">
      <span id="progress-text">Comparison 1 of 21</span>
      <span id="progress-pct">0%</span>
    </div>
    <div class="progress-bar">
      <div class="progress-fill" id="progress-fill" style="width:0%"></div>
    </div>
  </div>

  <div class="vs-label">Which matters more?</div>

  <div class="choice-area">
    <button class="choice-btn" id="btn-a" onclick="choose(0)"></button>
    <div class="vs-divider">VS</div>
    <button class="choice-btn" id="btn-b" onclick="choose(1)"></button>
  </div>

  <button class="skip-btn" onclick="choose(-1)">Skip this pair →</button>
  <div class="pair-counter" id="remaining-label"></div>
</div>

<!-- ══ SCREEN 3: Results ══ -->
<div class="screen" id="screen-results">
  <div class="results-header">
    <div class="trophy">🏆</div>
    <h2>Your Ranked List</h2>
    <p id="results-subtitle">Based on your pairwise comparisons</p>
  </div>

  <div class="result-list" id="result-list"></div>

  <div class="actions">
    <button class="btn" id="restart-same-btn">🔄 &nbsp;Redo with same list</button>
    <button class="btn secondary" id="restart-new-btn">✏️ &nbsp;Start with a new list</button>
  </div>
</div>

<div class="attribution">
  Inspired by Jon's <a href="https://jonaquino.blogspot.com/2010/05/how-to-prioritize-any-list.html">How to prioritize any list</a> post,
  based on the Prioritizing Grid from <em>What Color Is Your Parachute?</em>
</div>

<script>
// ── State ──
let items = [];
let pairs = [];
let pairIndex = 0;
let wins = [];
let totalPairs = 0;

// ── Screen management ──
function showScreen(id) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ── Helpers ──
function parseItems(text) {
  return text.split('\n')
    .map(s => s.trim())
    .filter(s => s.length > 0)
    .slice(0, 20); // cap at 20
}

function buildPairs(n) {
  const p = [];
  for (let i = 0; i < n; i++)
    for (let j = i + 1; j < n; j++)
      p.push([i, j]);
  // shuffle for variety
  for (let i = p.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [p[i], p[j]] = [p[j], p[i]];
  }
  return p;
}

// ── Live counter on input ──
document.getElementById('items-input').addEventListener('input', function() {
  const parsed = parseItems(this.value);
  const n = parsed.length;
  document.getElementById('item-count-display').textContent = n;
  const pairs = n >= 2 ? n * (n - 1) / 2 : 0;
  document.getElementById('pair-count-display').textContent = pairs;
});

// ── Example chips ──
document.querySelectorAll('.chip').forEach(chip => {
  chip.addEventListener('click', () => {
    document.getElementById('items-input').value = chip.dataset.list;
    document.getElementById('items-input').dispatchEvent(new Event('input'));
  });
});

// ── Start ──
document.getElementById('start-btn').addEventListener('click', () => {
  const text = document.getElementById('items-input').value;
  const parsed = parseItems(text);
  if (parsed.length < 2) {
    alert('Please enter at least 2 items to compare.');
    return;
  }
  items = parsed;
  wins = new Array(items.length).fill(0);
  pairs = buildPairs(items.length);
  pairIndex = 0;
  totalPairs = pairs.length;
  showScreen('screen-compare');
  renderPair();
});

// ── Render a pair ──
function renderPair() {
  if (pairIndex >= totalPairs) {
    showResults();
    return;
  }
  const [a, b] = pairs[pairIndex];
  document.getElementById('btn-a').textContent = items[a];
  document.getElementById('btn-b').textContent = items[b];
  document.getElementById('btn-a').classList.remove('selected');
  document.getElementById('btn-b').classList.remove('selected');

  const done = pairIndex;
  const pct = Math.round((done / totalPairs) * 100);
  document.getElementById('progress-text').textContent = `Comparison ${done + 1} of ${totalPairs}`;
  document.getElementById('progress-pct').textContent = `${pct}%`;
  document.getElementById('progress-fill').style.width = `${pct}%`;

  const rem = totalPairs - done - 1;
  document.getElementById('remaining-label').textContent = rem > 0 ? `${rem} comparison${rem > 1 ? 's' : ''} remaining` : 'Last one!';
}

// ── Choose ──
function choose(side) {
  if (pairIndex >= totalPairs) return;
  const [a, b] = pairs[pairIndex];

  if (side === 0) {
    wins[a]++;
    document.getElementById('btn-a').classList.add('selected');
  } else if (side === 1) {
    wins[b]++;
    document.getElementById('btn-b').classList.add('selected');
  }
  // side === -1 means skip (no win awarded)

  pairIndex++;
  setTimeout(renderPair, side >= 0 ? 220 : 0);
}

// ── Show Results ──
function showResults() {
  // Build sorted ranking
  const maxWins = Math.max(...wins);
  const ranked = items.map((name, i) => ({ name, wins: wins[i] }))
    .sort((a, b) => b.wins - a.wins);

  const list = document.getElementById('result-list');
  list.innerHTML = '';

  // Group by wins to handle ties
  let displayRank = 1;
  let prevWins = null;
  let tieOffset = 0;

  ranked.forEach((item, idx) => {
    if (prevWins !== null && item.wins < prevWins) {
      displayRank += tieOffset + 1;
      tieOffset = 0;
    } else if (prevWins !== null) {
      tieOffset++;
    }
    prevWins = item.wins;

    const div = document.createElement('div');
    div.className = 'result-item' + (displayRank <= 3 ? ` rank-${displayRank}` : '');
    div.style.animationDelay = `${idx * 60}ms`;

    const medal = displayRank === 1 ? '🥇' : displayRank === 2 ? '🥈' : displayRank === 3 ? '🥉' : `#${displayRank}`;
    const pct = maxWins > 0 ? Math.round((item.wins / maxWins) * 100) : 0;
    const scoreLabel = `${item.wins} win${item.wins !== 1 ? 's' : ''}`;

    div.innerHTML = `
      <div class="rank-badge">${medal}</div>
      <div class="result-name">${escHtml(item.name)}</div>
      <div class="score-bar-wrap">
        <div class="score-bar"><div class="score-fill" style="width:${pct}%"></div></div>
        <div class="score-label">${scoreLabel}</div>
      </div>
    `;
    list.appendChild(div);
  });

  const subtitle = ranked[0]
    ? `"${ranked[0].name}" came out on top`
    : 'Interesting results!';
  document.getElementById('results-subtitle').textContent = subtitle;

  showScreen('screen-results');
}

function escHtml(s) {
  return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ── Restart ──
document.getElementById('restart-same-btn').addEventListener('click', () => {
  wins = new Array(items.length).fill(0);
  pairs = buildPairs(items.length);
  pairIndex = 0;
  showScreen('screen-compare');
  renderPair();
});
document.getElementById('restart-new-btn').addEventListener('click', () => {
  document.getElementById('items-input').value = '';
  document.getElementById('item-count-display').textContent = '0';
  document.getElementById('pair-count-display').textContent = '0';
  showScreen('screen-input');
});

// ── Keyboard shortcut ──
document.addEventListener('keydown', e => {
  const compareActive = document.getElementById('screen-compare').classList.contains('active');
  if (!compareActive) return;
  if (e.key === 'ArrowLeft' || e.key === '1') choose(0);
  if (e.key === 'ArrowRight' || e.key === '2') choose(1);
  if (e.key === 's' || e.key === 'S') choose(-1);
});
</script>

</body>
</html>
