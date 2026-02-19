<?php
/**
 * Saints Match Game - Match the saint to their story!
 * Inspired by Jon & Nathan's love of The Saints Podcast
 */
$saints = [
    [
        'name' => 'St. Damien of Molokai',
        'fact' => 'Left everything to care for lepers on a remote Hawaiian island, eventually contracting the disease himself.',
        'hint' => 'Hawaii 🌺',
        'year' => '1840–1889',
    ],
    [
        'name' => 'St. Louis IX',
        'fact' => 'A King of France known for his justice, who personally heard the complaints of his poorest subjects under an oak tree.',
        'hint' => 'French king ⚜️',
        'year' => '1214–1270',
    ],
    [
        'name' => 'St. Joan of Arc',
        'fact' => 'A teenage peasant girl who heard heavenly voices, led an army, and turned the tide of the Hundred Years\' War.',
        'hint' => 'French warrior 🗡️',
        'year' => '1412–1431',
    ],
    [
        'name' => 'St. Francis of Assisi',
        'fact' => 'Son of a wealthy merchant who stripped off his fine clothes in the town square to embrace a life of radical poverty.',
        'hint' => 'Animals & poverty 🐦',
        'year' => '1181–1226',
    ],
    [
        'name' => 'St. Patrick',
        'fact' => 'Kidnapped as a teenager and enslaved in Ireland, he escaped but returned years later to convert the whole island.',
        'hint' => 'Ireland ☘️',
        'year' => '385–461',
    ],
    [
        'name' => 'St. Teresa of Ávila',
        'fact' => 'A mystic and reformer who founded convents across Spain despite chronic illness, and was named a Doctor of the Church.',
        'hint' => 'Spanish mystic 🏰',
        'year' => '1515–1582',
    ],
    [
        'name' => 'St. Maximilian Kolbe',
        'fact' => 'A priest who volunteered to die in place of a stranger at Auschwitz concentration camp.',
        'hint' => 'WWII martyr ✝️',
        'year' => '1894–1941',
    ],
    [
        'name' => 'St. Thomas More',
        'fact' => 'The Lord Chancellor of England who chose execution rather than approve the king\'s break with Rome.',
        'hint' => 'English lawyer 📜',
        'year' => '1478–1535',
    ],
    [
        'name' => 'St. Kateri Tekakwitha',
        'fact' => 'A Mohawk-Algonquin woman, orphaned by smallpox, who was the first Indigenous person from North America to be canonized.',
        'hint' => 'North America 🪶',
        'year' => '1656–1680',
    ],
    [
        'name' => 'St. Augustine of Hippo',
        'fact' => 'Lived a wild youth and famously prayed "Lord, make me chaste — but not yet" before his dramatic conversion.',
        'hint' => 'North Africa 📚',
        'year' => '354–430',
    ],
    [
        'name' => 'St. Thérèse of Lisieux',
        'fact' => 'Entered a Carmelite convent at age 15 and taught the "Little Way" — finding holiness in small, everyday acts.',
        'hint' => 'Little Flower 🌹',
        'year' => '1873–1897',
    ],
    [
        'name' => 'St. Nicholas',
        'fact' => 'A generous bishop who secretly tossed bags of gold through a poor family\'s window to save three daughters from being sold.',
        'hint' => 'Gift-giver 🎁',
        'year' => '270–343',
    ],
];

// Pick 6 random saints for each game
shuffle($saints);
$game_saints = array_slice($saints, 0, 6);
$saints_json = json_encode($game_saints);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Saints Match Game</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Georgia', serif;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    min-height: 100vh; color: #e0d6c8; padding: 16px;
  }
  h1 { text-align: center; font-size: 1.6rem; margin: 12px 0 4px; color: #f0c040; }
  .subtitle { text-align: center; font-size: 0.9rem; opacity: 0.7; margin-bottom: 16px; }
  .score-bar {
    display: flex; justify-content: center; gap: 24px;
    font-size: 1rem; margin-bottom: 16px;
  }
  .score-bar span { background: rgba(255,255,255,0.1); padding: 6px 14px; border-radius: 20px; }
  #board { max-width: 600px; margin: 0 auto; }
  .card {
    background: rgba(255,255,255,0.07); border: 2px solid rgba(240,192,64,0.2);
    border-radius: 12px; padding: 14px 16px; margin-bottom: 10px;
    cursor: pointer; transition: all 0.25s; user-select: none;
    -webkit-tap-highlight-color: transparent;
  }
  .card:hover { border-color: rgba(240,192,64,0.5); background: rgba(255,255,255,0.1); }
  .card.selected { border-color: #f0c040; background: rgba(240,192,64,0.15); box-shadow: 0 0 12px rgba(240,192,64,0.3); }
  .card.matched { border-color: #4ade80; background: rgba(74,222,128,0.12); opacity: 0.7; pointer-events: none; }
  .card.wrong { animation: shake 0.4s; border-color: #f87171; }
  .card .label { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; opacity: 0.5; margin-bottom: 4px; }
  .card .name { font-size: 1.1rem; font-weight: bold; color: #f0c040; }
  .card .fact { font-size: 0.95rem; line-height: 1.4; font-style: italic; }
  .card .hint { font-size: 0.8rem; margin-top: 4px; opacity: 0.6; }
  .card .year { font-size: 0.8rem; opacity: 0.5; }
  .section-label {
    font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px;
    text-align: center; margin: 18px 0 10px; opacity: 0.5;
  }
  #message {
    text-align: center; font-size: 1.1rem; margin: 16px 0; min-height: 1.4em;
    color: #f0c040;
  }
  .btn {
    display: block; margin: 20px auto; padding: 12px 28px;
    background: #f0c040; color: #1a1a2e; border: none; border-radius: 25px;
    font-size: 1rem; font-weight: bold; cursor: pointer; font-family: inherit;
  }
  .btn:hover { background: #f5d060; }
  @keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-6px); }
    75% { transform: translateX(6px); }
  }
  .confetti { position: fixed; pointer-events: none; z-index: 999; }
</style>
</head>
<body>

<h1>⛪ Saints Match Game</h1>
<p class="subtitle">Match each saint to their story!</p>

<div class="score-bar">
  <span>✅ Matched: <strong id="matched">0</strong>/6</span>
  <span>❌ Misses: <strong id="misses">0</strong></span>
</div>

<div id="message">Tap a saint, then tap their story</div>

<div id="board">
  <div class="section-label">Saints</div>
  <div id="names"></div>
  <div class="section-label">Stories</div>
  <div id="facts"></div>
</div>

<button class="btn" id="newGame" style="display:none">🔄 New Game</button>

<script>
const allSaints = <?= $saints_json ?>;
let selected = null;
let matchCount = 0;
let missCount = 0;

function shuffle(a) { for (let i = a.length - 1; i > 0; i--) { const j = Math.floor(Math.random() * (i + 1)); [a[i], a[j]] = [a[j], a[i]]; } return a; }

function init() {
  matchCount = 0; missCount = 0; selected = null;
  document.getElementById('matched').textContent = '0';
  document.getElementById('misses').textContent = '0';
  document.getElementById('message').textContent = 'Tap a saint, then tap their story';
  document.getElementById('newGame').style.display = 'none';

  const nameOrder = shuffle([...Array(6).keys()]);
  const factOrder = shuffle([...Array(6).keys()]);

  const namesDiv = document.getElementById('names');
  const factsDiv = document.getElementById('facts');
  namesDiv.innerHTML = '';
  factsDiv.innerHTML = '';

  nameOrder.forEach(i => {
    const s = allSaints[i];
    const card = document.createElement('div');
    card.className = 'card';
    card.dataset.type = 'name';
    card.dataset.idx = i;
    card.innerHTML = `<div class="label">Saint</div><div class="name">${s.name}</div><div class="year">${s.year}</div>`;
    card.addEventListener('click', () => pick(card));
    namesDiv.appendChild(card);
  });

  factOrder.forEach(i => {
    const s = allSaints[i];
    const card = document.createElement('div');
    card.className = 'card';
    card.dataset.type = 'fact';
    card.dataset.idx = i;
    card.innerHTML = `<div class="label">Story</div><div class="fact">"${s.fact}"</div><div class="hint">${s.hint}</div>`;
    card.addEventListener('click', () => pick(card));
    factsDiv.appendChild(card);
  });
}

function pick(card) {
  if (card.classList.contains('matched')) return;

  if (!selected) {
    selected = card;
    card.classList.add('selected');
    return;
  }

  if (selected === card) { card.classList.remove('selected'); selected = null; return; }
  if (selected.dataset.type === card.dataset.type) {
    selected.classList.remove('selected');
    selected = card;
    card.classList.add('selected');
    return;
  }

  const idx1 = parseInt(selected.dataset.idx);
  const idx2 = parseInt(card.dataset.idx);

  if (idx1 === idx2) {
    selected.classList.remove('selected');
    selected.classList.add('matched');
    card.classList.add('matched');
    matchCount++;
    document.getElementById('matched').textContent = matchCount;
    const saint = allSaints[idx1].name;
    document.getElementById('message').textContent = `✅ ${saint} — correct!`;
    if (matchCount === 6) win();
  } else {
    missCount++;
    document.getElementById('misses').textContent = missCount;
    selected.classList.add('wrong');
    card.classList.add('wrong');
    const s1 = selected, s2 = card;
    setTimeout(() => { s1.classList.remove('wrong', 'selected'); s2.classList.remove('wrong'); }, 400);
    document.getElementById('message').textContent = '❌ Not a match — try again!';
  }
  selected = null;
}

function win() {
  document.getElementById('message').textContent = missCount === 0
    ? '🏆 Perfect score! You really know your saints!'
    : `🎉 All matched! ${missCount} miss${missCount > 1 ? 'es' : ''}. Great job!`;
  document.getElementById('newGame').style.display = 'block';
  // simple confetti
  for (let i = 0; i < 30; i++) {
    const c = document.createElement('div');
    c.className = 'confetti';
    c.style.cssText = `left:${Math.random()*100}vw;top:-10px;font-size:${16+Math.random()*16}px;position:fixed;`;
    c.textContent = ['⭐','✝️','🕊️','💛','⛪'][Math.floor(Math.random()*5)];
    document.body.appendChild(c);
    c.animate([
      {transform:'translateY(0) rotate(0deg)',opacity:1},
      {transform:`translateY(${80+Math.random()*20}vh) rotate(${Math.random()*360}deg)`,opacity:0}
    ], {duration:2000+Math.random()*2000, easing:'ease-out'}).onfinish = () => c.remove();
  }
}

document.getElementById('newGame').addEventListener('click', () => location.reload());
init();
</script>
</body>
</html>
