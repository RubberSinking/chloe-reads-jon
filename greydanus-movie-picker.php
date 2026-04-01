<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catholic Movie Night Picker</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg: #0d0d1a;
    --surface: #16162a;
    --card: #1e1e35;
    --gold: #f5c842;
    --gold2: #e8a020;
    --red: #c0392b;
    --cream: #f0e6c8;
    --muted: #8888aa;
    --accent: #7b68ee;
    --green: #2ecc71;
  }

  body {
    font-family: 'Georgia', serif;
    background: var(--bg);
    color: var(--cream);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 24px 16px 60px;
  }

  /* Cinema marquee header */
  .marquee-header {
    text-align: center;
    margin-bottom: 32px;
    position: relative;
  }

  .marquee-frame {
    display: inline-block;
    border: 4px solid var(--gold);
    border-radius: 8px;
    padding: 20px 32px;
    position: relative;
    background: var(--surface);
    box-shadow: 0 0 30px rgba(245,200,66,0.2), 0 0 60px rgba(245,200,66,0.05);
  }

  .marquee-frame::before {
    content: '';
    position: absolute;
    inset: 6px;
    border: 2px solid rgba(245,200,66,0.3);
    border-radius: 4px;
    pointer-events: none;
  }

  .bulb-row {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-bottom: 12px;
  }

  .bulb {
    width: 12px; height: 12px;
    border-radius: 50%;
    background: var(--gold);
    box-shadow: 0 0 8px var(--gold);
    animation: blink 1.6s infinite;
  }
  .bulb:nth-child(2n) { animation-delay: 0.4s; }
  .bulb:nth-child(3n) { animation-delay: 0.8s; }
  .bulb:nth-child(4n) { animation-delay: 1.2s; }

  @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
  }

  .marquee-frame h1 {
    font-size: clamp(1.4em, 5vw, 2.2em);
    color: var(--gold);
    letter-spacing: 2px;
    text-transform: uppercase;
    font-style: italic;
    line-height: 1.2;
    margin-bottom: 6px;
  }

  .subtitle {
    font-size: 0.85em;
    color: var(--muted);
    font-style: italic;
  }

  /* Stepper */
  .stepper {
    display: flex;
    gap: 8px;
    margin-bottom: 28px;
    justify-content: center;
    flex-wrap: wrap;
  }

  .step-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    background: var(--card);
    border: 2px solid var(--muted);
    transition: all 0.3s;
  }
  .step-dot.active { background: var(--gold); border-color: var(--gold); box-shadow: 0 0 8px var(--gold); }
  .step-dot.done { background: var(--green); border-color: var(--green); }

  /* Question card */
  .question-card {
    background: var(--card);
    border: 1px solid rgba(245,200,66,0.2);
    border-radius: 12px;
    padding: 28px 24px;
    max-width: 560px;
    width: 100%;
    animation: slideIn 0.35s ease;
  }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .q-label {
    font-size: 0.75em;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--gold2);
    margin-bottom: 10px;
  }

  .q-text {
    font-size: 1.2em;
    line-height: 1.5;
    color: var(--cream);
    margin-bottom: 24px;
  }

  .options {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .opt-btn {
    background: var(--surface);
    border: 2px solid rgba(255,255,255,0.08);
    border-radius: 8px;
    padding: 14px 18px;
    color: var(--cream);
    font-family: Georgia, serif;
    font-size: 0.95em;
    cursor: pointer;
    text-align: left;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 12px;
  }

  .opt-btn:hover {
    border-color: var(--gold);
    background: rgba(245,200,66,0.05);
    color: var(--gold);
    transform: translateX(4px);
  }

  .opt-icon { font-size: 1.3em; flex-shrink: 0; }

  /* Result screen */
  .result-screen {
    max-width: 600px;
    width: 100%;
    animation: slideIn 0.4s ease;
  }

  .result-title {
    text-align: center;
    font-size: 1.1em;
    color: var(--gold);
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 24px;
  }

  .film-card {
    background: var(--card);
    border: 2px solid var(--gold);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
    box-shadow: 0 0 30px rgba(245,200,66,0.15);
  }

  .film-poster {
    width: 100%;
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }

  .film-poster canvas {
    position: absolute;
    inset: 0;
  }

  .film-poster-text {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 16px;
  }

  .film-year-badge {
    display: inline-block;
    background: var(--gold);
    color: #000;
    font-size: 0.7em;
    font-weight: bold;
    padding: 2px 8px;
    border-radius: 3px;
    margin-bottom: 10px;
    letter-spacing: 1px;
  }

  .film-title-big {
    font-size: clamp(1.4em, 5vw, 2.2em);
    color: var(--cream);
    text-shadow: 0 2px 12px rgba(0,0,0,0.8);
    line-height: 1.2;
  }

  .film-body {
    padding: 20px 22px;
  }

  .film-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 14px;
    align-items: center;
  }

  .badge {
    font-size: 0.75em;
    padding: 4px 10px;
    border-radius: 20px;
    font-family: sans-serif;
    font-weight: 600;
  }

  .badge-rating { background: #2d6a3f; color: #7fffa7; }
  .badge-genre  { background: #2d2d6a; color: #9999ff; }
  .badge-family { background: #6a2d2d; color: #ffa0a0; }
  .badge-age    { background: #4a3d00; color: var(--gold); }

  .film-quote {
    font-style: italic;
    font-size: 0.9em;
    color: var(--gold2);
    border-left: 3px solid var(--gold2);
    padding-left: 12px;
    margin-bottom: 14px;
    line-height: 1.5;
  }

  .film-desc {
    font-size: 0.9em;
    color: var(--cream);
    line-height: 1.7;
    margin-bottom: 14px;
  }

  .why-box {
    background: rgba(245,200,66,0.06);
    border: 1px solid rgba(245,200,66,0.2);
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 0.85em;
    color: var(--muted);
    line-height: 1.6;
  }

  .why-box strong { color: var(--gold2); }

  /* Runner-ups */
  .runners-section {
    margin-top: 8px;
    margin-bottom: 24px;
  }

  .runners-title {
    font-size: 0.8em;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 12px;
    text-align: center;
  }

  .runners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
  }

  .runner-card {
    background: var(--card);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px;
    padding: 12px 14px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .runner-card:hover {
    border-color: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  }

  .runner-title { font-size: 0.9em; color: var(--cream); margin-bottom: 4px; }
  .runner-year  { font-size: 0.75em; color: var(--muted); }

  /* Buttons */
  .action-btns {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 8px;
  }

  .btn {
    padding: 12px 24px;
    border-radius: 8px;
    border: none;
    font-family: Georgia, serif;
    font-size: 0.95em;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 0.5px;
  }

  .btn-primary {
    background: var(--gold);
    color: #000;
    font-weight: bold;
  }
  .btn-primary:hover { background: var(--gold2); transform: scale(1.03); }

  .btn-secondary {
    background: transparent;
    border: 2px solid var(--muted);
    color: var(--muted);
  }
  .btn-secondary:hover { border-color: var(--cream); color: var(--cream); }

  /* Film detail modal */
  .modal-backdrop {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.85);
    z-index: 100;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }
  .modal-backdrop.open { display: flex; }

  .modal {
    background: var(--card);
    border: 2px solid var(--gold);
    border-radius: 12px;
    max-width: 520px;
    width: 100%;
    padding: 24px;
    max-height: 90vh;
    overflow-y: auto;
    animation: slideIn 0.3s ease;
  }

  .modal-close {
    float: right;
    background: none;
    border: none;
    color: var(--muted);
    font-size: 1.4em;
    cursor: pointer;
    line-height: 1;
  }
  .modal-close:hover { color: var(--cream); }

  .credit-line {
    text-align: center;
    font-size: 0.75em;
    color: var(--muted);
    margin-top: 32px;
    font-style: italic;
  }
  .credit-line a { color: var(--muted); }

  @media (max-width: 480px) {
    .film-poster { height: 160px; }
    .film-title-big { font-size: 1.4em; }
    .runners-grid { grid-template-columns: 1fr 1fr; }
  }
</style>
</head>
<body>

<div class="marquee-header">
  <div class="marquee-frame">
    <div class="bulb-row">
      <?php for($i=0;$i<10;$i++) echo '<div class="bulb"></div>'; ?>
    </div>
    <h1>Catholic Movie Night</h1>
    <p class="subtitle">Greydanus-approved picks for every mood</p>
    <div class="bulb-row">
      <?php for($i=0;$i<10;$i++) echo '<div class="bulb"></div>'; ?>
    </div>
  </div>
</div>

<?php
$films = [
  [
    'title' => "It's a Wonderful Life",
    'year' => 1946,
    'director' => 'Frank Capra',
    'rating' => 'A',
    'runtime' => '130 min',
    'genre' => ['Drama', 'Fantasy'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['hopeful', 'family', 'classic'],
    'prayerful' => true,
    'palette' => ['#1a1a2e','#4a3b2c','#8b6a40'],
    'emoji' => '🎄',
    'quote' => "Every time a bell rings, an angel gets his wings.",
    'desc' => "George Bailey is about to throw his life away — until his guardian angel shows him what the world would have been like without him. One of the most beloved films ever made, and a film Greydanus considers essential. Perfect for the whole family.",
    'why' => "Timeless story of grace, sacrifice, and finding meaning in ordinary life. Jon and Nathan will love it.",
    'tagline' => 'No man is a failure who has friends.',
  ],
  [
    'title' => 'Babette\'s Feast',
    'year' => 1987,
    'director' => 'Gabriel Axel',
    'rating' => 'A+',
    'runtime' => '102 min',
    'genre' => ['Drama'],
    'family' => false,
    'age' => 'Adults',
    'mood' => ['thoughtful', 'quiet', 'spiritual'],
    'prayerful' => true,
    'palette' => ['#1a120d','#3d2b1a','#7a5c3e'],
    'emoji' => '🍽️',
    'quote' => "Throughout the world sounds one long cry from the heart of the artist: Give me leave to do my utmost!",
    'desc' => "A French chef exiled in a remote Norwegian village prepares one magnificent meal for a Puritan community. Greydanus calls it one of the greatest films ever made — a luminous meditation on grace, generosity, and art as sacrament.",
    'why' => "Greydanus' absolute favourite — the only film he has rated A+. A perfect film for a quiet adult evening.",
    'tagline' => "A film about grace, beauty, and the sacrament of cooking.",
  ],
  [
    'title' => 'The Mission',
    'year' => 1986,
    'director' => 'Roland Joffé',
    'rating' => 'A-',
    'runtime' => '125 min',
    'genre' => ['Drama', 'Historical'],
    'family' => false,
    'age' => '13+',
    'mood' => ['dramatic', 'spiritual', 'historical'],
    'prayerful' => true,
    'palette' => ['#0a1a0a','#1a3a1a','#2a6a2a'],
    'emoji' => '✝️',
    'quote' => "The words you have to say, Father, are in my music.",
    'desc' => "A mercenary turned Jesuit priest fights to protect a South American indigenous community against Spanish and Portuguese forces. Ennio Morricone's score alone is worth the watch. Greydanus praises its moral complexity and spiritual depth.",
    'why' => "A stirring film about faith, justice, and sacrifice in colonial South America.",
    'tagline' => "What are these words worth if they don't represent the truth?",
  ],
  [
    'title' => 'Spirited Away',
    'year' => 2001,
    'director' => 'Hayao Miyazaki',
    'rating' => 'A',
    'runtime' => '125 min',
    'genre' => ['Animation', 'Fantasy'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['adventurous', 'family', 'wonder'],
    'prayerful' => false,
    'palette' => ['#0d1a2e','#1a3a5c','#2a6a8c'],
    'emoji' => '🌊',
    'quote' => "I finally get a bouquet and it's a goodbye present. That's depressing.",
    'desc' => "A 10-year-old girl stumbles into a spirit world and must find the courage and goodness to rescue her parents. Greydanus rates it among the greatest animated films ever — a masterpiece of wonder, moral clarity, and quiet heroism.",
    'why' => "Nathan would absolutely love this — and so would Jon. Pure magic from Miyazaki.",
    'tagline' => "She must rely on her wits and courage to rescue her parents.",
  ],
  [
    'title' => 'Groundhog Day',
    'year' => 1993,
    'director' => 'Harold Ramis',
    'rating' => 'A-',
    'runtime' => '101 min',
    'genre' => ['Comedy', 'Fantasy'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['funny', 'hopeful', 'thoughtful'],
    'prayerful' => true,
    'palette' => ['#1a1a2e','#2e2e50','#4a4a80'],
    'emoji' => '🔁',
    'quote' => "What if there is no tomorrow? There wasn't one today!",
    'desc' => "A cynical weatherman is trapped in a single day that keeps repeating — until he learns to become a better person. Greydanus considers it one of the most theologically rich comedies ever made: a story of purgation, conversion, and love.",
    'why' => "One of the funniest and most spiritually profound comedies. Works for any mood.",
    'tagline' => "He's having the worst day of his life — over and over and over.",
  ],
  [
    'title' => 'Chariots of Fire',
    'year' => 1981,
    'director' => 'Hugh Hudson',
    'rating' => 'A-',
    'runtime' => '124 min',
    'genre' => ['Drama', 'Sports'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['hopeful', 'inspiring', 'spiritual'],
    'prayerful' => true,
    'palette' => ['#0d1a2e','#1a3050','#2a5080'],
    'emoji' => '🏃',
    'quote' => "I believe God made me for a purpose, but he also made me fast!",
    'desc' => "The true story of two British athletes — one a devout Christian, one a proud Jew — who run for gold at the 1924 Paris Olympics. Greydanus calls it a rare film about faith done with complete integrity. That theme: glorifying God through your gifts.",
    'why' => "A stirring, beautiful film about faith and purpose. Perfect for Jon.",
    'tagline' => "When I run, I feel His pleasure.",
  ],
  [
    'title' => "My Neighbor Totoro",
    'year' => 1988,
    'director' => 'Hayao Miyazaki',
    'rating' => 'A',
    'runtime' => '86 min',
    'genre' => ['Animation', 'Family'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['gentle', 'family', 'wonder'],
    'prayerful' => false,
    'palette' => ['#0d2a0d','#1a4a1a','#2a6a2a'],
    'emoji' => '🌿',
    'quote' => "Every day is a good day when you're Totoro.",
    'desc' => "Two sisters discover gentle forest spirits while their mother is in hospital. Greydanus considers it a perfect family film — gentle, full of wonder, and suffused with a child's-eye view of grace and mystery in the natural world.",
    'why' => "Pure Miyazaki magic — short, gentle, and perfect for a dad-and-son evening.",
    'tagline' => "Two sisters discover a world of wonder in the forest.",
  ],
  [
    'title' => 'The Iron Giant',
    'year' => 1999,
    'director' => 'Brad Bird',
    'rating' => 'A',
    'runtime' => '86 min',
    'genre' => ['Animation', 'Sci-Fi'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['adventurous', 'family', 'hopeful'],
    'prayerful' => false,
    'palette' => ['#0d0d2e','#1a1a50','#2a2a80'],
    'emoji' => '🤖',
    'quote' => "You are what you choose to be.",
    'desc' => "A boy befriends a giant alien robot during the Cold War — a robot that must choose whether to be a weapon or something more. Greydanus praises it as a great film about the soul, self-determination, and sacrifice disguised as a kids movie.",
    'why' => "Nathan will love the robot; Jon will cry at the ending. Perfect combo.",
    'tagline' => "A boy. A robot. A choice that changes everything.",
  ],
  [
    'title' => 'A Man for All Seasons',
    'year' => 1966,
    'director' => 'Fred Zinnemann',
    'rating' => 'A',
    'runtime' => '120 min',
    'genre' => ['Historical', 'Drama'],
    'family' => false,
    'age' => '13+',
    'mood' => ['dramatic', 'spiritual', 'historical'],
    'prayerful' => true,
    'palette' => ['#1a1209','#3a2a18','#6a4a28'],
    'emoji' => '⚖️',
    'quote' => "I die His Majesty's good servant, but God's first.",
    'desc' => "St. Thomas More refuses to endorse Henry VIII's divorce and remarriage — and pays with his life. Robert Bolt's screenplay is one of the finest ever written. Greydanus considers it essential viewing for any Catholic. Paul Scofield won the Oscar.",
    'why' => "The definitive film about conscience, integrity, and dying for what you believe.",
    'tagline' => "A man who could not be bought. A man who could not be bent.",
  ],
  [
    'title' => 'E.T. the Extra-Terrestrial',
    'year' => 1982,
    'director' => 'Steven Spielberg',
    'rating' => 'A',
    'runtime' => '115 min',
    'genre' => ['Family', 'Sci-Fi'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['adventurous', 'family', 'hopeful'],
    'prayerful' => false,
    'palette' => ['#1a0d2e','#3a1a50','#6a2a80'],
    'emoji' => '🛸',
    'quote' => "I'll be right here.",
    'desc' => "A lonely boy befriends a gentle alien stranded on Earth. One of Spielberg's masterpieces — Greydanus praises its warmth, its portrayal of childhood wonder, and its undeniable Christ-figure symbolism. One of cinema's great tearjerkers.",
    'why' => "Nathan's era matches this perfectly — it's a timeless boy-and-creature adventure.",
    'tagline' => "He is afraid. He is totally alone. He is 3 million light years from home.",
  ],
  [
    'title' => 'Of Gods and Men',
    'year' => 2010,
    'director' => 'Xavier Beauvois',
    'rating' => 'A',
    'runtime' => '122 min',
    'genre' => ['Drama', 'Historical'],
    'family' => false,
    'age' => 'Adults',
    'mood' => ['quiet', 'spiritual', 'thoughtful'],
    'prayerful' => true,
    'palette' => ['#1a1209','#2e2316','#4a3828'],
    'emoji' => '🕊️',
    'quote' => "We are like birds on a branch. We don't know when we'll take flight.",
    'desc' => "A community of French Cistercian monks in Algeria refuses to flee despite mounting terrorist threats. Based on the true story of the Tibhirine martyrs. Greydanus calls it one of the greatest religious films of the decade — contemplative, devastating, and holy.",
    'why' => "A deeply spiritual film about radical faith and the willingness to die where God has placed you.",
    'tagline' => "They could have fled. They chose to stay.",
  ],
  [
    'title' => 'Toy Story',
    'year' => 1995,
    'director' => 'John Lasseter',
    'rating' => 'A',
    'runtime' => '81 min',
    'genre' => ['Animation', 'Comedy'],
    'family' => true,
    'age' => 'All ages',
    'mood' => ['funny', 'family', 'adventurous'],
    'prayerful' => false,
    'palette' => ['#1a1a2e','#2e2e4a','#4a4a80'],
    'emoji' => '🤠',
    'quote' => "To infinity and beyond!",
    'desc' => "Woody the cowboy is threatened when shiny new spaceman Buzz Lightyear arrives. The film that invented modern animation. Greydanus praises its depth, its themes of jealousy and friendship, and the way it works for every age in the room.",
    'why' => "Nathan will love every second. Jon will appreciate how it still holds up after 30 years.",
    'tagline' => "The toys are alive. The adventure is real.",
  ],
];

// Pick a random film on load (PHP side, so it's stable per pageload)
srand(crc32(date('Y-m-d')));
$daily_pick_idx = array_rand($films);
$daily_pick = $films[$daily_pick_idx];

echo "<script>const ALL_FILMS = " . json_encode($films) . ";</script>";
echo "<script>const DAILY_IDX = $daily_pick_idx;</script>";
?>

<div id="app">
  <!-- Step indicator -->
  <div class="stepper" id="stepper">
    <div class="step-dot active" id="dot-0"></div>
    <div class="step-dot" id="dot-1"></div>
    <div class="step-dot" id="dot-2"></div>
    <div class="step-dot" id="dot-3"></div>
    <div class="step-dot" id="dot-4"></div>
  </div>

  <!-- Questions container -->
  <div id="questions-container"></div>
</div>

<!-- Film detail modal -->
<div class="modal-backdrop" id="modal">
  <div class="modal" id="modal-content">
    <button class="modal-close" onclick="closeModal()">✕</button>
    <div id="modal-body"></div>
  </div>
</div>

<p class="credit-line">
  Ratings by <a href="https://cooltoolsforcatholics.blogspot.com/2021/01/steven-greydanus-top-movie-picks.html" target="_blank">Steven D. Greydanus</a>, the leading Catholic film critic &amp; co-founder of the National Catholic Register's film desk.<br>
  Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2021/01/steven-greydanus-top-movie-picks.html" target="_blank">Cool Tools for Catholics</a> post.
</p>

<script>
const questions = [
  {
    id: 'who',
    label: 'Step 1 of 4',
    text: 'Who\'s watching tonight?',
    options: [
      { icon: '👨‍👦', label: 'Jon & Nathan (father + son)', value: 'family' },
      { icon: '👨', label: 'Just Jon (solo evening)', value: 'solo' },
      { icon: '👨‍👦‍👦', label: 'The whole family + maybe a friend', value: 'everyone' },
    ]
  },
  {
    id: 'mood',
    label: 'Step 2 of 4',
    text: 'What\'s the vibe?',
    options: [
      { icon: '😂', label: 'Fun & light — we want to laugh', value: 'funny' },
      { icon: '🌟', label: 'Adventure & wonder — something exciting', value: 'adventurous' },
      { icon: '🙏', label: 'Quiet & spiritual — something that feeds the soul', value: 'spiritual' },
      { icon: '💪', label: 'Inspiring — something uplifting and moving', value: 'hopeful' },
    ]
  },
  {
    id: 'genre',
    label: 'Step 3 of 4',
    text: 'Any genre preference?',
    options: [
      { icon: '🎨', label: 'Animation / Fantasy', value: 'animation' },
      { icon: '📜', label: 'Drama / Historical', value: 'historical' },
      { icon: '🎭', label: 'Comedy / Light', value: 'comedy' },
      { icon: '🤷', label: 'No preference — surprise me!', value: 'any' },
    ]
  },
  {
    id: 'length',
    label: 'Step 4 of 4',
    text: 'How much time do you have?',
    options: [
      { icon: '⚡', label: 'About 90 minutes or less', value: 'short' },
      { icon: '🎬', label: 'Up to 2 hours — normal movie length', value: 'normal' },
      { icon: '🌙', label: 'Happy to stay up late — whatever it takes', value: 'long' },
    ]
  }
];

let answers = {};
let currentQ = 0;

function renderQuestion(idx) {
  const q = questions[idx];
  const container = document.getElementById('questions-container');
  container.innerHTML = `
    <div class="question-card">
      <div class="q-label">${q.label}</div>
      <div class="q-text">${q.text}</div>
      <div class="options">
        ${q.options.map(o => `
          <button class="opt-btn" onclick="pickAnswer('${q.id}','${o.value}')">
            <span class="opt-icon">${o.icon}</span>
            <span>${o.label}</span>
          </button>
        `).join('')}
      </div>
    </div>
  `;
  updateDots(idx);
}

function updateDots(active) {
  for (let i = 0; i < 5; i++) {
    const d = document.getElementById('dot-' + i);
    d.className = 'step-dot' + (i < active ? ' done' : '') + (i === active ? ' active' : '');
  }
}

function pickAnswer(id, value) {
  answers[id] = value;
  currentQ++;
  if (currentQ >= questions.length) {
    showResult();
  } else {
    renderQuestion(currentQ);
  }
}

function showResult() {
  updateDots(5);
  const film = pickFilm();
  const others = ALL_FILMS.filter(f => f.title !== film.title).sort(() => Math.random() - 0.5).slice(0, 3);
  const container = document.getElementById('questions-container');
  container.innerHTML = buildResultHTML(film, others);
  drawPoster(film);
}

function pickFilm() {
  let scores = ALL_FILMS.map((f, i) => ({ f, i, score: 0 }));

  // Who's watching
  if (answers.who === 'family' || answers.who === 'everyone') {
    scores.forEach(s => { if (s.f.family) s.score += 3; });
  } else {
    scores.forEach(s => { if (!s.f.family) s.score += 2; });
  }

  // Mood
  const moodMap = {
    funny: ['funny','hopeful'],
    adventurous: ['adventurous','wonder'],
    spiritual: ['spiritual','quiet','prayerful'],
    hopeful: ['hopeful','inspiring'],
  };
  const wantedMoods = moodMap[answers.mood] || [];
  scores.forEach(s => {
    const overlap = s.f.mood.filter(m => wantedMoods.includes(m)).length;
    s.score += overlap * 2;
    if (answers.mood === 'spiritual' && s.f.prayerful) s.score += 2;
  });

  // Genre
  if (answers.genre !== 'any') {
    const genreMap = {
      animation: ['Animation','Fantasy','Family'],
      historical: ['Historical','Drama'],
      comedy: ['Comedy','Family'],
    };
    const wantedGenres = genreMap[answers.genre] || [];
    scores.forEach(s => {
      if (s.f.genre.some(g => wantedGenres.includes(g))) s.score += 2;
    });
  }

  // Length
  scores.forEach(s => {
    const mins = s.f.runtime ? parseInt(s.f.runtime) : 100;
    if (answers.length === 'short' && mins <= 90) s.score += 2;
    if (answers.length === 'normal' && mins <= 120) s.score += 1;
    if (answers.length === 'long') s.score += 0.5;
  });

  // Find max score, pick randomly among ties
  const maxScore = Math.max(...scores.map(s => s.score));
  const tied = scores.filter(s => s.score === maxScore);
  return tied[Math.floor(Math.random() * tied.length)].f;
}

function buildResultHTML(film, others) {
  const ratingColor = film.rating === 'A+' ? '#ffd700' : film.rating === 'A' ? '#90ee90' : '#add8e6';
  return `
    <div class="result-screen">
      <div class="result-title">🎬 Tonight's Pick</div>

      <div class="film-card">
        <div class="film-poster" id="film-poster">
          <canvas id="poster-canvas"></canvas>
          <div class="film-poster-text">
            <div class="film-year-badge">${film.year}</div>
            <div class="film-title-big">${film.title}</div>
          </div>
        </div>
        <div class="film-body">
          <div class="film-meta">
            <span class="badge badge-rating">Greydanus: ${film.rating}</span>
            ${film.genre.map(g => `<span class="badge badge-genre">${g}</span>`).join('')}
            <span class="badge badge-age">${film.age}</span>
            <span class="badge badge-family">${film.runtime}</span>
          </div>
          <div class="film-quote">"${film.quote}"</div>
          <div class="film-desc">${film.desc}</div>
          <div class="why-box">
            <strong>Why this pick?</strong> ${film.why}
          </div>
        </div>
      </div>

      <div class="runners-section">
        <div class="runners-title">🍿 You might also enjoy</div>
        <div class="runners-grid">
          ${others.map(f => `
            <div class="runner-card" onclick="showModal(${JSON.stringify(f).replace(/"/g,'&quot;')})">
              <div class="runner-title">${f.title}</div>
              <div class="runner-year">${f.year} · ${f.rating}</div>
            </div>
          `).join('')}
          <div class="runner-card" onclick="showDailyPick()">
            <div class="runner-title">📅 Daily Pick</div>
            <div class="runner-year">Today's recommendation</div>
          </div>
        </div>
      </div>

      <div class="action-btns">
        <button class="btn btn-primary" onclick="restart()">🎲 Try Again</button>
        <button class="btn btn-secondary" onclick="showAllFilms()">📋 See All Films</button>
      </div>
    </div>
  `;
}

function drawPoster(film) {
  requestAnimationFrame(() => {
    const canvas = document.getElementById('poster-canvas');
    if (!canvas) return;
    const parent = canvas.parentElement;
    canvas.width = parent.offsetWidth;
    canvas.height = parent.offsetHeight;
    const ctx = canvas.getContext('2d');
    const [c1, c2, c3] = film.palette || ['#1a1a2e','#2e2e50','#4a4a80'];

    // Gradient background
    const grad = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
    grad.addColorStop(0, c1);
    grad.addColorStop(0.5, c2);
    grad.addColorStop(1, c3);
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Decorative stars
    ctx.fillStyle = 'rgba(255,255,255,0.15)';
    for (let i = 0; i < 60; i++) {
      const x = Math.random() * canvas.width;
      const y = Math.random() * canvas.height;
      const r = Math.random() * 1.5;
      ctx.beginPath();
      ctx.arc(x, y, r, 0, Math.PI * 2);
      ctx.fill();
    }

    // Filmstrip holes
    ctx.fillStyle = 'rgba(0,0,0,0.35)';
    ctx.fillRect(0, 0, 20, canvas.height);
    ctx.fillRect(canvas.width - 20, 0, 20, canvas.height);
    ctx.fillStyle = 'rgba(255,255,255,0.1)';
    for (let y = 10; y < canvas.height; y += 28) {
      ctx.beginPath(); ctx.roundRect(4, y, 12, 16, 2); ctx.fill();
      ctx.beginPath(); ctx.roundRect(canvas.width - 16, y, 12, 16, 2); ctx.fill();
    }

    // Vignette
    const vig = ctx.createRadialGradient(canvas.width/2, canvas.height/2, canvas.height*0.1, canvas.width/2, canvas.height/2, canvas.height);
    vig.addColorStop(0, 'transparent');
    vig.addColorStop(1, 'rgba(0,0,0,0.6)');
    ctx.fillStyle = vig;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
  });
}

function showModal(film) {
  const body = document.getElementById('modal-body');
  body.innerHTML = `
    <h2 style="color:var(--gold);margin-bottom:8px;font-size:1.4em;">${film.title}</h2>
    <p style="color:var(--muted);font-size:0.85em;margin-bottom:16px;">${film.year} · Dir. ${film.director} · ${film.runtime}</p>
    <div class="film-quote" style="margin-bottom:14px;">"${film.quote}"</div>
    <p style="font-size:0.9em;line-height:1.7;margin-bottom:14px;">${film.desc}</p>
    <div class="film-meta" style="margin-bottom:12px;">
      <span class="badge badge-rating">Greydanus: ${film.rating}</span>
      ${film.genre.map(g => `<span class="badge badge-genre">${g}</span>`).join('')}
      <span class="badge badge-age">${film.age}</span>
    </div>
    <div class="why-box">${film.why}</div>
  `;
  document.getElementById('modal').classList.add('open');
}

function showDailyPick() {
  showModal(ALL_FILMS[DAILY_IDX]);
}

function showAllFilms() {
  const container = document.getElementById('questions-container');
  container.innerHTML = `
    <div class="result-screen">
      <div class="result-title">📋 All Greydanus-Approved Films</div>
      <div class="runners-grid" style="grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px;margin-bottom:24px;">
        ${ALL_FILMS.map(f => `
          <div class="runner-card" onclick="showModal(${JSON.stringify(f).replace(/"/g,'&quot;')})">
            <div style="font-size:1.3em;margin-bottom:6px;">${f.emoji || '🎬'}</div>
            <div class="runner-title">${f.title}</div>
            <div class="runner-year">${f.year} · ${f.rating} · ${f.age}</div>
          </div>
        `).join('')}
      </div>
      <div class="action-btns">
        <button class="btn btn-primary" onclick="restart()">🎲 Take the Quiz</button>
      </div>
    </div>
  `;
}

function closeModal() {
  document.getElementById('modal').classList.remove('open');
}

function restart() {
  answers = {};
  currentQ = 0;
  renderQuestion(0);
}

document.getElementById('modal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});

// Start
renderQuestion(0);
</script>
</body>
</html>
