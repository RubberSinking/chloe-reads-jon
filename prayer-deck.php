<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Prayer Deck — Monte Carlo Intercession</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Cormorant+SC:wght@400;600&family=IM+Fell+DW+Pica:ital@0;1&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --ink: #1a0e06;
    --parchment: #f5ead6;
    --parchment-dark: #e8d4ae;
    --amber: #c8873a;
    --amber-deep: #9c5f1a;
    --gold: #d4a843;
    --gold-light: #f0cc6e;
    --candle: #ffb347;
    --smoke: #4a3520;
    --cream: #fdf6e8;
    --red-deep: #8b1a1a;
    --bg: #1c0f05;
    --bg2: #2a1608;
    --shadow: rgba(0,0,0,0.6);
  }

  html { height: 100%; }

  body {
    min-height: 100vh;
    background: var(--bg);
    color: var(--parchment);
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 18px;
    overflow-x: hidden;
    position: relative;
  }

  /* Ambient candlelight background */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 40% at 50% 0%, rgba(200,135,58,0.18) 0%, transparent 70%),
      radial-gradient(ellipse 40% 60% at 20% 80%, rgba(180,100,20,0.12) 0%, transparent 60%),
      radial-gradient(ellipse 30% 50% at 80% 60%, rgba(150,80,10,0.08) 0%, transparent 60%);
    pointer-events: none;
    z-index: 0;
  }

  .container {
    position: relative;
    z-index: 1;
    max-width: 700px;
    margin: 0 auto;
    padding: 40px 20px 80px;
  }

  /* Header */
  header {
    text-align: center;
    margin-bottom: 48px;
  }

  .flame-icon {
    display: inline-block;
    font-size: 2.2rem;
    animation: flicker 2.8s ease-in-out infinite;
    margin-bottom: 12px;
  }

  @keyframes flicker {
    0%,100% { transform: scaleY(1) scaleX(1); opacity: 1; }
    25% { transform: scaleY(1.04) scaleX(0.97); opacity: 0.93; }
    50% { transform: scaleY(0.97) scaleX(1.02); opacity: 0.97; }
    75% { transform: scaleY(1.06) scaleX(0.96); opacity: 0.9; }
  }

  h1 {
    font-family: 'Cormorant SC', serif;
    font-size: clamp(1.8rem, 6vw, 3rem);
    font-weight: 600;
    color: var(--gold-light);
    letter-spacing: 0.06em;
    line-height: 1.1;
    text-shadow: 0 0 40px rgba(212,168,67,0.4);
  }

  .subtitle {
    margin-top: 10px;
    color: var(--amber);
    font-style: italic;
    font-size: 1rem;
    letter-spacing: 0.03em;
    opacity: 0.85;
  }

  .ornament {
    display: block;
    text-align: center;
    color: var(--amber-deep);
    font-size: 1.4rem;
    margin: 18px 0;
    opacity: 0.7;
    letter-spacing: 0.3em;
  }

  /* Stats bar */
  .stats {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin-bottom: 40px;
    font-family: 'Cormorant SC', serif;
    font-size: 0.85rem;
    color: var(--amber);
    opacity: 0.8;
  }

  .stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
  }

  .stat-number {
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--gold-light);
    line-height: 1;
  }

  /* Today's Cards section */
  .section-title {
    font-family: 'Cormorant SC', serif;
    font-size: 1rem;
    letter-spacing: 0.12em;
    color: var(--amber);
    text-align: center;
    margin-bottom: 24px;
    opacity: 0.8;
  }

  /* Prayer Cards */
  .prayer-cards {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 40px;
  }

  .prayer-card {
    background: linear-gradient(135deg, var(--parchment) 0%, var(--parchment-dark) 100%);
    border: 1px solid rgba(200,135,58,0.3);
    border-radius: 8px;
    padding: 22px 24px;
    color: var(--ink);
    position: relative;
    transition: all 0.3s ease;
    box-shadow:
      0 4px 20px rgba(0,0,0,0.4),
      inset 0 1px 0 rgba(255,255,255,0.6);
    overflow: hidden;
  }

  .prayer-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--amber), transparent);
    opacity: 0.5;
  }

  /* Paper texture overlay */
  .prayer-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
    pointer-events: none;
    border-radius: 8px;
  }

  .prayer-card.prayed {
    opacity: 0.55;
    transform: translateX(4px);
    background: linear-gradient(135deg, #d4c8b0 0%, #c8bc9e 100%);
  }

  .prayer-card.prayed .card-name {
    text-decoration: line-through;
    text-decoration-color: var(--amber-deep);
  }

  .card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
  }

  .card-body {
    flex: 1;
  }

  .card-number {
    font-family: 'Cormorant SC', serif;
    font-size: 0.75rem;
    color: var(--amber-deep);
    letter-spacing: 0.1em;
    margin-bottom: 6px;
    opacity: 0.7;
  }

  .card-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--ink);
    line-height: 1.3;
    margin-bottom: 4px;
  }

  .card-note {
    font-style: italic;
    font-size: 0.9rem;
    color: var(--smoke);
    opacity: 0.8;
    line-height: 1.4;
  }

  .card-actions {
    display: flex;
    flex-direction: column;
    gap: 6px;
    align-items: flex-end;
    flex-shrink: 0;
  }

  .btn-pray {
    background: linear-gradient(135deg, var(--amber), var(--amber-deep));
    color: var(--cream);
    border: none;
    border-radius: 6px;
    padding: 8px 14px;
    font-family: 'Cormorant SC', serif;
    font-size: 0.8rem;
    letter-spacing: 0.08em;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
  }

  .btn-pray:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    background: linear-gradient(135deg, var(--gold), var(--amber));
  }

  .btn-pray.prayed-btn {
    background: linear-gradient(135deg, #5a7a3a, #3d5428);
  }

  .btn-remove {
    background: none;
    border: none;
    color: var(--smoke);
    cursor: pointer;
    font-size: 1rem;
    opacity: 0.4;
    transition: opacity 0.2s;
    padding: 2px 4px;
  }

  .btn-remove:hover { opacity: 0.8; }

  /* Empty state */
  .empty-deck {
    text-align: center;
    padding: 48px 24px;
    color: var(--amber);
    opacity: 0.6;
    font-style: italic;
    font-size: 1rem;
    border: 1px dashed rgba(200,135,58,0.3);
    border-radius: 8px;
    margin-bottom: 40px;
  }

  /* Controls */
  .controls {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 48px;
  }

  .btn-main {
    background: linear-gradient(135deg, var(--amber-deep), #6b3a10);
    color: var(--parchment);
    border: 1px solid rgba(200,135,58,0.4);
    border-radius: 8px;
    padding: 12px 24px;
    font-family: 'Cormorant SC', serif;
    font-size: 0.95rem;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 16px rgba(0,0,0,0.4);
  }

  .btn-main:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(0,0,0,0.5);
    background: linear-gradient(135deg, var(--amber), var(--amber-deep));
    color: var(--cream);
  }

  .btn-main.shuffle-btn {
    background: linear-gradient(135deg, var(--gold), var(--amber));
    color: var(--ink);
    font-weight: 600;
  }

  /* Add intention form */
  .add-section {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(200,135,58,0.2);
    border-radius: 10px;
    padding: 28px;
    margin-bottom: 48px;
  }

  .add-section h3 {
    font-family: 'Cormorant SC', serif;
    font-size: 1rem;
    color: var(--amber);
    letter-spacing: 0.1em;
    margin-bottom: 18px;
    text-align: center;
    opacity: 0.85;
  }

  .form-row {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
  }

  .form-row input, .form-row textarea {
    flex: 1;
    background: rgba(245,234,214,0.08);
    border: 1px solid rgba(200,135,58,0.3);
    border-radius: 6px;
    padding: 10px 14px;
    color: var(--parchment);
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s;
  }

  .form-row input:focus, .form-row textarea:focus {
    border-color: var(--amber);
    background: rgba(245,234,214,0.12);
  }

  .form-row input::placeholder, .form-row textarea::placeholder {
    color: rgba(200,160,100,0.45);
    font-style: italic;
  }

  .form-row textarea {
    resize: none;
    height: 60px;
  }

  .btn-add {
    background: linear-gradient(135deg, var(--amber), var(--amber-deep));
    color: var(--cream);
    border: none;
    border-radius: 6px;
    padding: 10px 20px;
    font-family: 'Cormorant SC', serif;
    font-size: 0.9rem;
    letter-spacing: 0.08em;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
    align-self: flex-end;
  }

  .btn-add:hover {
    background: linear-gradient(135deg, var(--gold), var(--amber));
    transform: translateY(-1px);
  }

  /* Full deck view */
  .deck-toggle {
    text-align: center;
    margin-bottom: 24px;
  }

  .btn-link {
    background: none;
    border: none;
    color: var(--amber);
    cursor: pointer;
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 0.9rem;
    font-style: italic;
    opacity: 0.7;
    transition: opacity 0.2s;
    text-decoration: underline;
    text-underline-offset: 3px;
  }

  .btn-link:hover { opacity: 1; }

  .full-deck {
    display: none;
    margin-bottom: 40px;
  }

  .full-deck.visible { display: block; }

  .deck-list {
    list-style: none;
    counter-reset: deck-counter;
  }

  .deck-list li {
    counter-increment: deck-counter;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-bottom: 1px solid rgba(200,135,58,0.15);
    font-size: 0.95rem;
    color: var(--parchment);
    opacity: 0.75;
  }

  .deck-list li::before {
    content: counter(deck-counter);
    font-family: 'Cormorant SC', serif;
    font-size: 0.75rem;
    color: var(--amber-deep);
    min-width: 20px;
    text-align: right;
  }

  .deck-list li .deck-name { flex: 1; }
  .deck-list li .deck-note { font-style: italic; color: var(--amber-deep); font-size: 0.85rem; }

  /* Toast */
  .toast {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: linear-gradient(135deg, var(--amber-deep), var(--smoke));
    color: var(--parchment);
    padding: 12px 24px;
    border-radius: 8px;
    font-family: 'Cormorant SC', serif;
    font-size: 0.9rem;
    letter-spacing: 0.06em;
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
    transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
    z-index: 999;
    border: 1px solid rgba(200,135,58,0.3);
  }

  .toast.show { transform: translateX(-50%) translateY(0); }

  /* Shuffle animation */
  @keyframes cardSlide {
    0% { transform: translateX(-30px) rotate(-3deg); opacity: 0; }
    100% { transform: translateX(0) rotate(0); opacity: 1; }
  }

  .prayer-card.animating {
    animation: cardSlide 0.4s ease forwards;
  }

  .prayer-card:nth-child(2).animating { animation-delay: 0.08s; }
  .prayer-card:nth-child(3).animating { animation-delay: 0.16s; }
  .prayer-card:nth-child(4).animating { animation-delay: 0.24s; }

  /* Divider */
  .divider {
    text-align: center;
    color: var(--amber-deep);
    opacity: 0.4;
    font-size: 1.2rem;
    letter-spacing: 0.5em;
    margin: 32px 0;
  }

  /* Progress ring */
  .progress-note {
    text-align: center;
    font-style: italic;
    font-size: 0.85rem;
    color: var(--amber);
    opacity: 0.6;
    margin-bottom: 32px;
  }

  /* Footer */
  footer {
    text-align: center;
    font-style: italic;
    font-size: 0.8rem;
    color: var(--amber-deep);
    opacity: 0.5;
    margin-top: 32px;
    line-height: 1.7;
  }

  /* Responsive */
  @media (max-width: 520px) {
    .prayer-card { padding: 16px 18px; }
    .card-name { font-size: 1.1rem; }
    .form-row { flex-direction: column; }
    .controls { gap: 8px; }
    .btn-main { padding: 10px 18px; font-size: 0.85rem; }
    .stats { gap: 20px; }
  }
</style>
</head>
<body>
<div class="container">

  <header>
    <div class="flame-icon">🕯️</div>
    <h1>Prayer Deck</h1>
    <p class="subtitle">Monte Carlo Intercession — pray with your whole heart, a few at a time</p>
    <span class="ornament">✦ ✦ ✦</span>
  </header>

  <div class="stats">
    <div class="stat-item">
      <span class="stat-number" id="stat-total">0</span>
      <span>in deck</span>
    </div>
    <div class="stat-item">
      <span class="stat-number" id="stat-prayed-today">0</span>
      <span>prayed today</span>
    </div>
    <div class="stat-item">
      <span class="stat-number" id="stat-streak">0</span>
      <span>day streak</span>
    </div>
  </div>

  <p class="section-title">✦ Today's Intentions ✦</p>

  <div class="prayer-cards" id="prayer-cards"></div>

  <p class="progress-note" id="progress-note"></p>

  <div class="controls">
    <button class="btn-main shuffle-btn" onclick="shuffleAndDeal()">🔀 Shuffle &amp; Deal New Cards</button>
    <button class="btn-main" onclick="markAllPrayed()">✓ Mark All Prayed</button>
  </div>

  <div class="divider">— ✦ —</div>

  <div class="add-section">
    <h3>✦ Add a Prayer Intention ✦</h3>
    <div class="form-row">
      <input type="text" id="input-name" placeholder="Person or intention…" maxlength="80" />
    </div>
    <div class="form-row">
      <textarea id="input-note" placeholder="A brief note (optional)…" maxlength="200"></textarea>
      <button class="btn-add" onclick="addIntention()">Add to Deck</button>
    </div>
  </div>

  <div class="deck-toggle">
    <button class="btn-link" onclick="toggleDeck()" id="deck-toggle-btn">View all cards in deck ▾</button>
  </div>

  <div class="full-deck" id="full-deck">
    <ul class="deck-list" id="deck-list"></ul>
  </div>

  <footer>
    "Simply pray the top 3 or 4 cards in the deck. You can really concentrate on them<br>
    and give them your all, striving to move God's heart."<br>
    — Jon Aquino, <em>Monte Carlo prayer-request management system</em>
  </footer>

</div>

<div class="toast" id="toast"></div>

<script>
const STORAGE_KEY = 'prayer-deck-v2';
const STATS_KEY = 'prayer-deck-stats-v2';
const CARDS_PER_DEAL = 4;

// Default starter deck
const DEFAULT_DECK = [
  { id: uid(), name: 'My family', note: 'For health, holiness, and joy', added: Date.now() },
  { id: uid(), name: 'The sick and suffering', note: 'All who are in pain or distress', added: Date.now() },
  { id: uid(), name: 'My parish community', note: '', added: Date.now() },
  { id: uid(), name: 'Souls in purgatory', note: 'May they soon behold the face of God', added: Date.now() },
  { id: uid(), name: 'Persecuted Christians', note: '', added: Date.now() },
  { id: uid(), name: 'My pastor and priests', note: '', added: Date.now() },
  { id: uid(), name: 'Those who have no one to pray for them', note: '', added: Date.now() },
  { id: uid(), name: 'World leaders', note: 'For wisdom and peace', added: Date.now() },
];

function uid() {
  return Math.random().toString(36).slice(2,11);
}

function loadData() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    if (raw) return JSON.parse(raw);
  } catch(e) {}
  return {
    deck: DEFAULT_DECK.map(d => ({...d, id: uid()})),
    order: null, // shuffled order (array of IDs)
    dealIndex: 0,
    prayedToday: [], // IDs prayed today
    lastDealDate: null,
  };
}

function saveData(data) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
}

function loadStats() {
  try {
    const raw = localStorage.getItem(STATS_KEY);
    if (raw) return JSON.parse(raw);
  } catch(e) {}
  return { streak: 0, lastPrayDate: null, totalPrayed: 0 };
}

function saveStats(stats) {
  localStorage.setItem(STATS_KEY, JSON.stringify(stats));
}

function today() {
  return new Date().toDateString();
}

function shuffle(arr) {
  const a = [...arr];
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}

let data = loadData();
let stats = loadStats();

// Auto-reset prayedToday if it's a new day
if (data.lastDealDate !== today()) {
  data.prayedToday = [];
  data.lastDealDate = today();
}

// If no order yet, create one
if (!data.order || data.order.length === 0) {
  dealNewHand();
}

function getActiveDeck() {
  // Return cards in current shuffled order
  const deckMap = Object.fromEntries(data.deck.map(d => [d.id, d]));
  const order = data.order || data.deck.map(d => d.id);
  return order.map(id => deckMap[id]).filter(Boolean);
}

function getTopCards() {
  const ordered = getActiveDeck();
  // Show CARDS_PER_DEAL cards starting from dealIndex
  const result = [];
  for (let i = 0; i < CARDS_PER_DEAL && i < ordered.length; i++) {
    const idx = (data.dealIndex + i) % ordered.length;
    result.push({ card: ordered[idx], position: i + 1 });
  }
  return result;
}

function dealNewHand() {
  data.order = shuffle(data.deck.map(d => d.id));
  data.dealIndex = 0;
  saveData(data);
}

function shuffleAndDeal() {
  dealNewHand();
  render(true);
  showToast('🔀 Deck shuffled — new intentions drawn');
}

function markPrayed(id) {
  if (!data.prayedToday.includes(id)) {
    data.prayedToday.push(id);
    stats.totalPrayed = (stats.totalPrayed || 0) + 1;

    // Update streak
    const yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    if (stats.lastPrayDate === yesterday.toDateString() || stats.lastPrayDate === today()) {
      if (stats.lastPrayDate !== today()) {
        stats.streak = (stats.streak || 0) + 1;
        stats.lastPrayDate = today();
      }
    } else {
      stats.streak = 1;
      stats.lastPrayDate = today();
    }

    saveData(data);
    saveStats(stats);
    render();
    showToast('🙏 Intention lifted up');
  }
}

function markAllPrayed() {
  const top = getTopCards();
  let any = false;
  top.forEach(({ card }) => {
    if (!data.prayedToday.includes(card.id)) {
      data.prayedToday.push(card.id);
      any = true;
    }
  });
  if (any) {
    stats.totalPrayed = (stats.totalPrayed || 0) + top.length;
    if (stats.lastPrayDate !== today()) {
      stats.streak = stats.lastPrayDate === new Date(Date.now()-86400000).toDateString()
        ? (stats.streak || 0) + 1 : 1;
      stats.lastPrayDate = today();
    }
    saveData(data);
    saveStats(stats);
    render();
    showToast('✓ All intentions prayed — well done!');
  }
}

function removeCard(id) {
  data.deck = data.deck.filter(d => d.id !== id);
  data.order = (data.order || []).filter(oid => oid !== id);
  data.prayedToday = data.prayedToday.filter(pid => pid !== id);
  if (data.deck.length > 0 && data.dealIndex >= data.deck.length) {
    data.dealIndex = 0;
  }
  saveData(data);
  render();
}

function addIntention() {
  const nameEl = document.getElementById('input-name');
  const noteEl = document.getElementById('input-note');
  const name = nameEl.value.trim();
  const note = noteEl.value.trim();
  if (!name) {
    nameEl.focus();
    return;
  }
  const card = { id: uid(), name, note, added: Date.now() };
  data.deck.push(card);
  // Add to end of current order
  if (!data.order) data.order = [];
  data.order.push(card.id);
  saveData(data);
  nameEl.value = '';
  noteEl.value = '';
  nameEl.focus();
  render();
  showToast('✦ Intention added to deck');
}

function render(animate = false) {
  // Stats
  document.getElementById('stat-total').textContent = data.deck.length;
  document.getElementById('stat-prayed-today').textContent = data.prayedToday.length;
  document.getElementById('stat-streak').textContent = stats.streak || 0;

  // Prayer cards
  const container = document.getElementById('prayer-cards');
  const topCards = getTopCards();
  
  if (data.deck.length === 0) {
    container.innerHTML = '<div class="empty-deck">Your deck is empty.<br>Add some prayer intentions above to begin.</div>';
    document.getElementById('progress-note').textContent = '';
  } else {
    container.innerHTML = topCards.map(({ card, position }) => {
      const prayed = data.prayedToday.includes(card.id);
      return `
        <div class="prayer-card ${prayed ? 'prayed' : ''} ${animate ? 'animating' : ''}">
          <div class="card-header">
            <div class="card-body">
              <div class="card-number">Intention ${position} of ${Math.min(CARDS_PER_DEAL, data.deck.length)}</div>
              <div class="card-name">${escapeHtml(card.name)}</div>
              ${card.note ? `<div class="card-note">${escapeHtml(card.note)}</div>` : ''}
            </div>
            <div class="card-actions">
              <button class="btn-pray ${prayed ? 'prayed-btn' : ''}" onclick="markPrayed('${card.id}')">
                ${prayed ? '✓ Prayed' : '🙏 Prayed'}
              </button>
              <button class="btn-remove" onclick="if(confirm('Remove this intention?')) removeCard('${card.id}')" title="Remove">✕</button>
            </div>
          </div>
        </div>
      `;
    }).join('');

    // Progress note
    const prayedCount = topCards.filter(({ card }) => data.prayedToday.includes(card.id)).length;
    const total = topCards.length;
    let note = '';
    if (prayedCount === 0) note = `${data.deck.length} intention${data.deck.length !== 1 ? 's' : ''} in deck — pray these ${total}, then shuffle for more`;
    else if (prayedCount < total) note = `${prayedCount} of ${total} prayed — ${total - prayedCount} more to go`;
    else note = `All ${total} intentions prayed today — blessed be God! 🙌`;
    document.getElementById('progress-note').textContent = note;
  }

  // Full deck list
  renderDeckList();
}

function renderDeckList() {
  const list = document.getElementById('deck-list');
  const ordered = getActiveDeck();
  if (ordered.length === 0) {
    list.innerHTML = '<li style="opacity:0.5;font-style:italic;padding:16px 0">No intentions yet</li>';
    return;
  }
  list.innerHTML = ordered.map(card => `
    <li>
      <span class="deck-name">${escapeHtml(card.name)}</span>
      ${card.note ? `<span class="deck-note">${escapeHtml(card.note)}</span>` : ''}
    </li>
  `).join('');
}

let deckVisible = false;
function toggleDeck() {
  deckVisible = !deckVisible;
  document.getElementById('full-deck').classList.toggle('visible', deckVisible);
  document.getElementById('deck-toggle-btn').textContent = deckVisible
    ? 'Hide deck ▴'
    : 'View all cards in deck ▾';
  if (deckVisible) renderDeckList();
}

function escapeHtml(str) {
  return String(str)
    .replace(/&/g,'&amp;').replace(/</g,'&lt;')
    .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

let toastTimer;
function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

// Enter key on name input
document.getElementById('input-name').addEventListener('keydown', e => {
  if (e.key === 'Enter') document.getElementById('input-note').focus();
});

// Initial render
render();
</script>
</body>
</html>
