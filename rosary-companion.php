<?php
$day = date('N'); // 1=Mon ... 7=Sun
$defaultSet = match($day) {
    1, 6 => 'joyful',
    2, 5 => 'sorrowful',
    3, 7 => 'glorious',
    4    => 'luminous',
    default => 'joyful',
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<title>Rosary Companion</title>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --gold: #c9a84c;
  --gold-light: #e8c97a;
  --dark: #0f0c1a;
  --panel: #1a1530;
  --panel2: #221c3a;
  --text: #f0ead8;
  --muted: #9990cc;
  --radius: 16px;
}

body {
  font-family: Georgia, 'Times New Roman', serif;
  background: var(--dark);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
}

/* ─── Stars background ─── */
body::before {
  content: '';
  position: fixed; inset: 0;
  background-image:
    radial-gradient(1px 1px at 15% 20%, rgba(255,255,255,0.6) 0%, transparent 100%),
    radial-gradient(1px 1px at 42% 7%, rgba(255,255,255,0.4) 0%, transparent 100%),
    radial-gradient(1px 1px at 68% 35%, rgba(255,255,255,0.5) 0%, transparent 100%),
    radial-gradient(1px 1px at 90% 12%, rgba(255,255,255,0.3) 0%, transparent 100%),
    radial-gradient(1px 1px at 30% 80%, rgba(255,255,255,0.4) 0%, transparent 100%),
    radial-gradient(1px 1px at 78% 70%, rgba(255,255,255,0.5) 0%, transparent 100%),
    radial-gradient(1px 1px at 55% 55%, rgba(255,255,255,0.3) 0%, transparent 100%),
    radial-gradient(1px 1px at 5% 55%, rgba(255,255,255,0.6) 0%, transparent 100%),
    radial-gradient(1px 1px at 95% 45%, rgba(255,255,255,0.4) 0%, transparent 100%);
  pointer-events: none; z-index: 0;
}

/* ─── HOME SCREEN ─── */
#home {
  max-width: 560px;
  margin: 0 auto;
  padding: 40px 20px 60px;
  position: relative; z-index: 1;
}

.site-title {
  text-align: center;
  margin-bottom: 32px;
}

.site-title .cross {
  font-size: 2.5em;
  color: var(--gold);
  display: block;
  margin-bottom: 8px;
}

.site-title h1 {
  font-size: 2em;
  font-weight: normal;
  letter-spacing: 1px;
  color: var(--gold-light);
}

.site-title p {
  color: var(--muted);
  font-size: 0.9em;
  font-style: italic;
  margin-top: 8px;
}

.today-badge {
  background: var(--panel);
  border: 1px solid rgba(201,168,76,0.3);
  border-radius: 10px;
  padding: 14px 20px;
  text-align: center;
  margin-bottom: 28px;
  font-size: 0.9em;
  color: var(--muted);
}

.today-badge strong { color: var(--gold); }

.mystery-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-bottom: 28px;
}

.mystery-btn {
  background: var(--panel);
  border: 1px solid rgba(201,168,76,0.2);
  border-radius: var(--radius);
  padding: 18px 14px;
  cursor: pointer;
  text-align: center;
  transition: all 0.2s;
  color: var(--text);
  font-family: Georgia, serif;
}

.mystery-btn:hover, .mystery-btn.active {
  border-color: var(--gold);
  background: var(--panel2);
}

.mystery-btn.active {
  box-shadow: 0 0 0 2px var(--gold);
}

.mystery-btn .set-icon { font-size: 2em; display: block; margin-bottom: 6px; }
.mystery-btn .set-name { font-size: 0.85em; color: var(--gold); display: block; margin-bottom: 2px; letter-spacing: 0.5px; }
.mystery-btn .set-days { font-size: 0.72em; color: var(--muted); display: block; }

.start-btn {
  display: block;
  width: 100%;
  background: linear-gradient(135deg, #8a6a1c, var(--gold));
  border: none;
  border-radius: 12px;
  padding: 16px;
  font-size: 1.1em;
  font-family: Georgia, serif;
  color: #fff;
  cursor: pointer;
  letter-spacing: 1px;
  transition: opacity 0.2s;
}

.start-btn:hover { opacity: 0.9; }

.art-credit {
  text-align: center;
  margin-top: 24px;
  font-size: 0.75em;
  color: var(--muted);
  font-style: italic;
  line-height: 1.5;
}

.art-credit a { color: var(--muted); }

/* ─── PRAYER SCREEN ─── */
#prayer { display: none; min-height: 100vh; flex-direction: column; position: relative; z-index: 1; }

.prayer-header {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px 20px;
  background: rgba(15,12,26,0.8);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid rgba(201,168,76,0.2);
  position: sticky; top: 0; z-index: 10;
}

.back-btn {
  background: none;
  border: 1px solid rgba(201,168,76,0.4);
  border-radius: 8px;
  color: var(--gold);
  padding: 6px 12px;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 0.85em;
}

.header-mystery {
  flex: 1;
  text-align: center;
}

.header-set { font-size: 0.75em; color: var(--gold); letter-spacing: 1px; text-transform: uppercase; }
.header-mystery-name { font-size: 1em; color: var(--text); }

.header-progress { font-size: 0.8em; color: var(--muted); white-space: nowrap; }

/* ─── Art panel ─── */
.art-panel {
  width: 100%;
  height: 200px;
  position: relative;
  overflow: hidden;
  flex-shrink: 0;
}

/* Colors per set */
.art-joyful    { background: linear-gradient(160deg, #1a3a5c 0%, #0d2540 60%, #0a1a30 100%); }
.art-luminous  { background: linear-gradient(160deg, #1a3d2e 0%, #0d2a1f 60%, #081a12 100%); }
.art-sorrowful { background: linear-gradient(160deg, #2a1a1a 0%, #1a0d0d 60%, #0f0808 100%); }
.art-glorious  { background: linear-gradient(160deg, #2a2010 0%, #1a1408 60%, #12100a 100%); }

.art-scene {
  position: absolute; inset: 0;
  display: flex; align-items: center; justify-content: center;
}

.art-title {
  position: absolute; bottom: 0; left: 0; right: 0;
  background: linear-gradient(transparent, rgba(0,0,0,0.7));
  padding: 20px 20px 12px;
  font-size: 0.72em;
  color: rgba(240,234,216,0.7);
  font-style: italic;
  text-align: center;
}

/* ─── SVG art pieces per mystery ─── */
.art-scene svg { max-height: 180px; width: auto; }

/* ─── Prayer content ─── */
.prayer-content {
  flex: 1;
  padding: 20px;
  max-width: 600px;
  margin: 0 auto;
  width: 100%;
}

.mystery-heading {
  text-align: center;
  margin-bottom: 16px;
}

.mystery-number { font-size: 0.75em; color: var(--gold); letter-spacing: 2px; text-transform: uppercase; }
.mystery-title  { font-size: 1.5em; font-weight: normal; color: var(--gold-light); margin-top: 4px; }
.mystery-meditation {
  font-size: 0.88em;
  color: var(--muted);
  line-height: 1.6;
  font-style: italic;
  margin-top: 8px;
}

.bead-row {
  display: flex;
  align-items: center;
  gap: 6px;
  margin: 20px 0 16px;
  flex-wrap: wrap;
}

.bead {
  width: 28px; height: 28px;
  border-radius: 50%;
  border: 2px solid rgba(201,168,76,0.3);
  background: var(--panel);
  flex-shrink: 0;
  transition: all 0.3s;
  cursor: default;
}

.bead.large {
  width: 34px; height: 34px;
  border-color: rgba(201,168,76,0.6);
  background: rgba(201,168,76,0.15);
}

.bead.done {
  background: var(--gold);
  border-color: var(--gold);
  box-shadow: 0 0 8px rgba(201,168,76,0.4);
}

.bead.current {
  border-color: #fff;
  box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
  animation: pulse 1.2s infinite;
}

@keyframes pulse {
  0%, 100% { box-shadow: 0 0 0 3px rgba(255,255,255,0.3); }
  50% { box-shadow: 0 0 0 5px rgba(255,255,255,0.1); }
}

.decade-label {
  font-size: 0.72em;
  color: var(--muted);
  text-align: center;
  margin-bottom: 4px;
  letter-spacing: 1px;
}

/* ─── Current prayer card ─── */
.prayer-card {
  background: var(--panel);
  border: 1px solid rgba(201,168,76,0.2);
  border-radius: var(--radius);
  padding: 20px;
  margin-bottom: 20px;
}

.prayer-type {
  font-size: 0.72em;
  color: var(--gold);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 10px;
}

.prayer-text {
  font-size: 1.05em;
  line-height: 1.7;
  color: var(--text);
}

.prayer-text em {
  color: var(--gold-light);
  font-style: normal;
}

/* ─── Navigation ─── */
.nav-row {
  display: flex;
  gap: 12px;
  margin-bottom: 32px;
}

.nav-btn {
  flex: 1;
  padding: 14px;
  border-radius: 12px;
  border: 1px solid rgba(201,168,76,0.3);
  background: var(--panel);
  color: var(--text);
  font-family: Georgia, serif;
  font-size: 0.95em;
  cursor: pointer;
  transition: all 0.2s;
}

.nav-btn.primary {
  background: linear-gradient(135deg, #8a6a1c, var(--gold));
  border-color: transparent;
  color: #fff;
}

.nav-btn:disabled { opacity: 0.3; cursor: default; }
.nav-btn:not(:disabled):hover { opacity: 0.85; }

/* ─── Completion screen ─── */
#complete {
  display: none;
  position: fixed; inset: 0;
  z-index: 100;
  background: radial-gradient(ellipse at 50% 30%, rgba(201,168,76,0.15) 0%, var(--dark) 70%);
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 40px 24px;
}

.complete-cross { font-size: 4em; color: var(--gold); margin-bottom: 16px; }
.complete-title { font-size: 2em; color: var(--gold-light); margin-bottom: 12px; font-weight: normal; }
.complete-msg { color: var(--muted); line-height: 1.6; font-style: italic; max-width: 380px; margin: 0 auto 32px; }
.complete-btn { padding: 14px 40px; border-radius: 12px; border: 1px solid var(--gold); background: transparent; color: var(--gold); font-family: Georgia, serif; font-size: 1em; cursor: pointer; }

/* ─── Responsive ─── */
@media (max-width: 480px) {
  .mystery-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
  .mystery-btn { padding: 14px 10px; }
  .mystery-btn .set-icon { font-size: 1.6em; }
  .art-panel { height: 160px; }
  .mystery-title { font-size: 1.3em; }
}

/* ─── Opening beads animation ─── */
#intro-beads {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin: 20px 0;
}
.intro-bead {
  width: 14px; height: 14px;
  border-radius: 50%;
  background: var(--gold);
  opacity: 0.3;
  animation: beadglow 2s ease-in-out infinite;
}
.intro-bead:nth-child(2) { animation-delay: 0.2s; }
.intro-bead:nth-child(3) { animation-delay: 0.4s; }
.intro-bead:nth-child(4) { animation-delay: 0.6s; }
.intro-bead:nth-child(5) { animation-delay: 0.8s; }
@keyframes beadglow {
  0%,100% { opacity: 0.3; transform: scale(1); }
  50% { opacity: 1; transform: scale(1.3); }
}
</style>
</head>
<body>

<!-- ══════════════ HOME ══════════════ -->
<div id="home">
  <div class="site-title">
    <span class="cross">✝</span>
    <h1>Rosary Companion</h1>
    <p>Pray with the masters — bead by bead</p>
  </div>

  <div id="intro-beads">
    <div class="intro-bead"></div>
    <div class="intro-bead"></div>
    <div class="intro-bead"></div>
    <div class="intro-bead"></div>
    <div class="intro-bead"></div>
  </div>

  <div class="today-badge" id="today-badge"></div>

  <div class="mystery-grid">
    <button class="mystery-btn" data-set="joyful" onclick="selectSet('joyful')">
      <span class="set-icon">🕊️</span>
      <span class="set-name">Joyful</span>
      <span class="set-days">Mon · Sat</span>
    </button>
    <button class="mystery-btn" data-set="luminous" onclick="selectSet('luminous')">
      <span class="set-icon">✨</span>
      <span class="set-name">Luminous</span>
      <span class="set-days">Thursday</span>
    </button>
    <button class="mystery-btn" data-set="sorrowful" onclick="selectSet('sorrowful')">
      <span class="set-icon">🌹</span>
      <span class="set-name">Sorrowful</span>
      <span class="set-days">Tue · Fri</span>
    </button>
    <button class="mystery-btn" data-set="glorious" onclick="selectSet('glorious')">
      <span class="set-icon">👑</span>
      <span class="set-name">Glorious</span>
      <span class="set-days">Wed · Sun</span>
    </button>
  </div>

  <button class="start-btn" onclick="startRosary()">Begin the Rosary ✝</button>

  <p class="art-credit">
    Mysteries accompanied by works of art chosen by Jon Aquino, inspired by his<br>
    <a href="https://cooltoolsforcatholics.blogspot.com/2009/03/praying-rosary-with-great-works-of-art.html" target="_blank">
      "Praying the Rosary with Great Works of Art"
    </a> — Tiepolo, Giotto, Dürer, El Greco,<br>Fra Angelico, Rembrandt, Botticelli, and more.
  </p>
</div>

<!-- ══════════════ PRAYER ══════════════ -->
<div id="prayer">
  <div class="prayer-header">
    <button class="back-btn" onclick="goHome()">← Back</button>
    <div class="header-mystery">
      <div class="header-set" id="hdr-set"></div>
      <div id="hdr-mystery"></div>
    </div>
    <div class="header-progress" id="hdr-progress"></div>
  </div>

  <div class="art-panel" id="art-panel">
    <div class="art-scene" id="art-scene"></div>
    <div class="art-title" id="art-title"></div>
  </div>

  <div class="prayer-content">
    <div class="mystery-heading">
      <div class="mystery-number" id="mystery-num"></div>
      <div class="mystery-title" id="mystery-title"></div>
      <div class="mystery-meditation" id="mystery-med"></div>
    </div>

    <div class="decade-label" id="decade-label"></div>
    <div class="bead-row" id="bead-row"></div>

    <div class="prayer-card">
      <div class="prayer-type" id="prayer-type"></div>
      <div class="prayer-text" id="prayer-text"></div>
    </div>

    <div class="nav-row">
      <button class="nav-btn" id="prev-btn" onclick="prevBead()">← Previous</button>
      <button class="nav-btn primary" id="next-btn" onclick="nextBead()">Next →</button>
    </div>
  </div>
</div>

<!-- ══════════════ COMPLETE ══════════════ -->
<div id="complete">
  <div class="complete-cross">✝</div>
  <div class="complete-title">Rosary Complete</div>
  <div class="complete-msg">
    "The Rosary is the weapon for these times."<br>
    — Padre Pio<br><br>
    May Our Lady intercede for you and those you carry in your heart today.
  </div>
  <button class="complete-btn" onclick="goHome()">Return Home</button>
</div>

<script>
// ══════════════════════════════════════════
//  DATA
// ══════════════════════════════════════════

const MYSTERIES = {
  joyful: {
    label: 'Joyful Mysteries',
    color: 'art-joyful',
    mysteries: [
      {
        title: 'The Annunciation',
        meditation: 'The Angel Gabriel appears to Mary and announces she will conceive the Son of God. She answers, "Behold the handmaid of the Lord."',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <!-- Room -->
          <rect x="0" y="0" width="200" height="180" fill="#1a2a4a"/>
          <!-- Window light -->
          <ellipse cx="150" cy="40" rx="45" ry="55" fill="rgba(255,240,180,0.12)"/>
          <!-- Angel (left) -->
          <ellipse cx="55" cy="85" rx="18" ry="22" fill="#d4c4a0"/>
          <line x1="55" y1="63" x2="55" y2="48" stroke="#d4c4a0" stroke-width="1.5"/>
          <!-- Angel wings -->
          <path d="M37 75 Q20 55 25 40 Q40 60 55 65" fill="rgba(200,180,120,0.5)" stroke="#c8b478" stroke-width="0.8"/>
          <path d="M73 75 Q90 55 85 40 Q70 60 55 65" fill="rgba(200,180,120,0.5)" stroke="#c8b478" stroke-width="0.8"/>
          <!-- Angel robe -->
          <path d="M37 90 Q40 130 55 140 Q70 130 73 90" fill="#8090c8" opacity="0.9"/>
          <!-- Lily -->
          <line x1="55" y1="100" x2="55" y2="145" stroke="#6a9a60" stroke-width="2"/>
          <ellipse cx="55" cy="100" rx="6" ry="10" fill="#ffffff" opacity="0.9"/>
          <!-- Mary (right) -->
          <ellipse cx="150" cy="82" rx="16" ry="20" fill="#d4b896"/>
          <line x1="150" y1="62" x2="150" y2="50" stroke="#d4b896" stroke-width="1.5"/>
          <!-- Mary veil -->
          <path d="M134 78 Q142 55 150 50 Q158 55 166 78" fill="#1c3a5c" opacity="0.85"/>
          <!-- Mary robe -->
          <path d="M134 88 Q136 135 150 145 Q164 135 166 88" fill="#7090c0" opacity="0.9"/>
          <!-- Dove of the Holy Spirit -->
          <path d="M95 50 Q105 42 115 50 Q105 55 95 50" fill="#ffffff" opacity="0.85"/>
          <!-- Gold light rays -->
          <line x1="115" y1="50" x2="148" y2="82" stroke="rgba(255,220,100,0.3)" stroke-width="1" stroke-dasharray="3,3"/>
          <!-- Floor -->
          <rect x="0" y="145" width="200" height="35" fill="#12203a"/>
          <!-- Arch -->
          <path d="M0 145 Q100 100 200 145" fill="none" stroke="rgba(201,168,76,0.3)" stroke-width="1"/>
        </svg>`,
        artCredit: 'After Tiepolo, "The Annunciation" (1726) — Pen and brown ink'
      },
      {
        title: 'The Visitation',
        meditation: 'Mary visits her cousin Elizabeth, who cries out, "Blessed are you among women, and blessed is the fruit of your womb!"',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#1a2a3c"/>
          <!-- Hills -->
          <ellipse cx="50" cy="150" rx="80" ry="50" fill="#152035"/>
          <ellipse cx="160" cy="160" rx="70" ry="45" fill="#111a2c"/>
          <!-- Mary (left) -->
          <ellipse cx="75" cy="72" rx="15" ry="19" fill="#d4b896"/>
          <path d="M60 78 Q62 130 75 140 Q88 130 90 78" fill="#1c4a8c"/>
          <path d="M60 75 Q67 55 75 50 Q83 55 90 75" fill="#8B4513" opacity="0.7"/>
          <!-- Elizabeth (right) -->
          <ellipse cx="130" cy="76" rx="15" ry="18" fill="#c8a882"/>
          <path d="M115 82 Q117 128 130 138 Q143 128 145 82" fill="#4a3060"/>
          <path d="M115 79 Q122 60 130 55 Q138 60 145 79" fill="#6b4510" opacity="0.7"/>
          <!-- Embrace -->
          <path d="M90 95 Q110 88 115 95" fill="none" stroke="rgba(201,168,76,0.4)" stroke-width="2"/>
          <!-- Halo Mary -->
          <circle cx="75" cy="65" r="22" fill="none" stroke="rgba(255,215,0,0.4)" stroke-width="1.5" stroke-dasharray="4,3"/>
          <!-- Ground -->
          <rect x="0" y="140" width="200" height="40" fill="#0e1825"/>
          <!-- Path -->
          <path d="M20 180 Q100 145 180 180" fill="rgba(201,168,76,0.1)" stroke="rgba(201,168,76,0.2)" stroke-width="1"/>
        </svg>`,
        artCredit: 'After Giotto, "The Visitation" (c.1305) — Fresco, Scrovegni Chapel'
      },
      {
        title: 'The Nativity',
        meditation: 'Jesus is born in Bethlehem. Mary wraps Him in swaddling clothes and lays Him in a manger. Angels fill the night sky with song.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0a1520"/>
          <!-- Night sky -->
          <circle cx="100" cy="15" r="8" fill="rgba(255,240,160,0.9)"/>
          <line x1="100" y1="23" x2="100" y2="50" stroke="rgba(255,240,160,0.25)" stroke-width="1.5"/>
          <!-- Stable roof -->
          <path d="M10 90 L100 50 L190 90" fill="#1a2a10" stroke="#2a3a18" stroke-width="2"/>
          <!-- Stable back wall -->
          <rect x="25" y="90" width="150" height="70" fill="#0d1a0a" rx="4"/>
          <!-- Manger glow -->
          <ellipse cx="100" cy="130" rx="35" ry="20" fill="rgba(255,220,100,0.12)"/>
          <!-- Manger -->
          <path d="M75 130 L80 155 L120 155 L125 130 Z" fill="#3a2510"/>
          <path d="M70 128 L130 128" stroke="#5a3820" stroke-width="3"/>
          <!-- Baby Jesus -->
          <ellipse cx="100" cy="130" rx="15" ry="8" fill="#f0e0c0"/>
          <ellipse cx="100" cy="127" rx="6" ry="5.5" fill="#e8d0b0"/>
          <!-- Light rays from manger -->
          <line x1="85" y1="128" x2="60" y2="115" stroke="rgba(255,220,100,0.2)" stroke-width="1"/>
          <line x1="115" y1="128" x2="140" y2="115" stroke="rgba(255,220,100,0.2)" stroke-width="1"/>
          <!-- Mary (left) -->
          <ellipse cx="62" cy="108" rx="13" ry="16" fill="#d4b896"/>
          <path d="M49 113 Q51 145 62 150 Q73 145 75 113" fill="#1a3060"/>
          <path d="M49 110 Q55 95 62 90 Q69 95 75 110" fill="#8B4513" opacity="0.6"/>
          <!-- Joseph (right) -->
          <ellipse cx="140" cy="110" rx="13" ry="15" fill="#c8a882"/>
          <path d="M127 115 Q129 143 140 148 Q151 143 153 115" fill="#4a3820"/>
          <path d="M127 112 Q133 97 140 93 Q147 97 153 112" fill="#7a5a30" opacity="0.7"/>
          <!-- Ox silhouette -->
          <path d="M155 145 Q170 130 185 140 L185 165 L155 165 Z" fill="#1a1208"/>
          <!-- Angel -->
          <ellipse cx="100" cy="65" rx="10" ry="8" fill="rgba(255,255,255,0.6)"/>
          <path d="M88 65 Q80 50 88 45 Q95 58 100 62" fill="rgba(255,255,200,0.4)"/>
          <path d="M112 65 Q120 50 112 45 Q105 58 100 62" fill="rgba(255,255,200,0.4)"/>
          <!-- Ground -->
          <rect x="0" y="160" width="200" height="20" fill="#060e08"/>
        </svg>`,
        artCredit: 'After Giotto, "The Nativity" (1304–06) — Fresco, Scrovegni Chapel'
      },
      {
        title: 'The Presentation',
        meditation: 'Mary and Joseph present the infant Jesus at the Temple. Simeon holds Him and prophesies, "My eyes have seen your salvation."',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#1a1a30"/>
          <!-- Temple columns -->
          <rect x="20" y="40" width="12" height="120" fill="#2a2a50"/>
          <rect x="168" y="40" width="12" height="120" fill="#2a2a50"/>
          <!-- Temple arch -->
          <path d="M20 40 Q100 0 180 40" fill="none" stroke="rgba(201,168,76,0.5)" stroke-width="2"/>
          <!-- Altar glow -->
          <rect x="80" y="80" width="40" height="30" rx="4" fill="#2a2830"/>
          <ellipse cx="100" cy="78" rx="20" ry="8" fill="rgba(255,220,100,0.15)"/>
          <!-- Flames -->
          <ellipse cx="90" cy="72" rx="4" ry="8" fill="rgba(255,160,40,0.7)"/>
          <ellipse cx="110" cy="72" rx="4" ry="8" fill="rgba(255,160,40,0.7)"/>
          <!-- Simeon (center) -->
          <ellipse cx="100" cy="90" rx="13" ry="15" fill="#d4b896"/>
          <path d="M87 95 Q89 140 100 148 Q111 140 113 95" fill="#3a3060"/>
          <!-- Baby Jesus in arms -->
          <ellipse cx="100" cy="108" rx="12" ry="7" fill="#f0e0c0"/>
          <!-- Light on Baby -->
          <ellipse cx="100" cy="108" rx="16" ry="10" fill="rgba(255,220,100,0.12)"/>
          <!-- Mary left -->
          <ellipse cx="60" cy="95" rx="12" ry="15" fill="#d4b896"/>
          <path d="M48 100 Q50 140 60 148 Q70 140 72 100" fill="#1a3060"/>
          <path d="M48 97 Q54 82 60 77 Q66 82 72 97" fill="#5a2010" opacity="0.6"/>
          <!-- Joseph right -->
          <ellipse cx="142" cy="95" rx="12" ry="14" fill="#c4a882"/>
          <path d="M130 100 Q132 140 142 148 Q152 140 154 100" fill="#3a2820"/>
          <!-- Doves -->
          <path d="M55 65 Q60 58 68 63 Q60 68 55 65" fill="#e0e0e0" opacity="0.7"/>
          <path d="M135 65 Q140 58 148 63 Q140 68 135 65" fill="#e0e0e0" opacity="0.7"/>
          <!-- Floor -->
          <rect x="0" y="150" width="200" height="30" fill="#10103a"/>
          <line x1="30" y1="150" x2="170" y2="150" stroke="rgba(201,168,76,0.2)" stroke-width="1"/>
        </svg>`,
        artCredit: 'After Rublev, "Presentation in the Temple" (1405) — Tempera on wood'
      },
      {
        title: 'Finding Jesus in the Temple',
        meditation: 'After three days of searching, Mary and Joseph find the twelve-year-old Jesus in the Temple, sitting among the teachers, listening and asking questions.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#18182e"/>
          <!-- Temple pillars -->
          <rect x="18" y="30" width="10" height="130" fill="#252540" rx="3"/>
          <rect x="172" y="30" width="10" height="130" fill="#252540" rx="3"/>
          <rect x="58" y="50" width="8" height="110" fill="#252540" rx="3"/>
          <rect x="134" y="50" width="8" height="110" fill="#252540" rx="3"/>
          <!-- Temple ceiling -->
          <path d="M18 30 L100 10 L182 30" fill="#20203c" stroke="rgba(201,168,76,0.3)" stroke-width="1.5"/>
          <!-- Young Jesus center -->
          <ellipse cx="100" cy="88" rx="11" ry="13" fill="#d4b896"/>
          <path d="M89 93 Q91 135 100 142 Q109 135 111 93" fill="#6080b0"/>
          <path d="M89 90 Q94 76 100 72 Q106 76 111 90" fill="#c8a050" opacity="0.5"/>
          <!-- Glow around Jesus -->
          <circle cx="100" cy="88" r="25" fill="none" stroke="rgba(255,220,100,0.2)" stroke-width="2"/>
          <!-- Doctor left -->
          <ellipse cx="62" cy="92" rx="11" ry="13" fill="#c8a882"/>
          <path d="M51 97 Q53 138 62 145 Q71 138 73 97" fill="#3a2040"/>
          <path d="M51 94 Q56 80 62 76 Q68 80 73 94" fill="#6a4030" opacity="0.6"/>
          <!-- Doctor right -->
          <ellipse cx="140" cy="92" rx="11" ry="13" fill="#c8a882"/>
          <path d="M129 97 Q131 138 140 145 Q149 138 151 97" fill="#2a3a20"/>
          <path d="M129 94 Q134 80 140 76 Q146 80 151 94" fill="#8a6040" opacity="0.6"/>
          <!-- Scroll/book -->
          <rect x="92" y="105" width="16" height="11" rx="2" fill="#e8d0a0" opacity="0.8"/>
          <!-- Mary & Joseph at door (back right) -->
          <ellipse cx="168" cy="100" rx="9" ry="11" fill="#c4a080"/>
          <path d="M159 105 Q161 135 168 140 Q175 135 177 105" fill="#1a3060" opacity="0.8"/>
          <ellipse cx="156" cy="102" rx="9" ry="11" fill="#b89060"/>
          <path d="M147 107 Q149 135 156 140 Q163 135 165 107" fill="#402810" opacity="0.8"/>
          <!-- Floor tiles -->
          <rect x="0" y="148" width="200" height="32" fill="#101028"/>
          <line x1="0" y1="148" x2="200" y2="148" stroke="rgba(201,168,76,0.2)" stroke-width="1"/>
          <line x1="66" y1="148" x2="66" y2="180" stroke="rgba(201,168,76,0.1)" stroke-width="1"/>
          <line x1="133" y1="148" x2="133" y2="180" stroke="rgba(201,168,76,0.1)" stroke-width="1"/>
        </svg>`,
        artCredit: 'After Dürer, "Christ Among the Doctors" (1506) — Oil on panel'
      }
    ]
  },
  luminous: {
    label: 'Luminous Mysteries',
    color: 'art-luminous',
    mysteries: [
      {
        title: 'The Baptism of Jesus',
        meditation: 'Jesus is baptised by John in the River Jordan. The Holy Spirit descends as a dove, and the Father's voice is heard: "This is my beloved Son."',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0a1a20"/>
          <!-- Sky -->
          <path d="M0 0 L200 0 L200 90 L0 90 Z" fill="#1a2a3a"/>
          <!-- Heavenly light -->
          <ellipse cx="100" cy="20" rx="40" ry="30" fill="rgba(255,240,180,0.15)"/>
          <!-- Dove -->
          <path d="M90 30 Q100 22 110 30 Q100 36 90 30" fill="white" opacity="0.9"/>
          <!-- Light rays -->
          <line x1="100" y1="36" x2="100" y2="85" stroke="rgba(255,240,180,0.3)" stroke-width="2" stroke-dasharray="4,4"/>
          <line x1="100" y1="36" x2="80" y2="75" stroke="rgba(255,240,180,0.15)" stroke-width="1" stroke-dasharray="3,5"/>
          <line x1="100" y1="36" x2="120" y2="75" stroke="rgba(255,240,180,0.15)" stroke-width="1" stroke-dasharray="3,5"/>
          <!-- River Jordan -->
          <path d="M0 90 Q50 80 100 90 Q150 100 200 90 L200 180 L0 180 Z" fill="#1a3a4a"/>
          <!-- Water ripple -->
          <ellipse cx="100" cy="115" rx="40" ry="10" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.15)" stroke-width="1"/>
          <!-- Jesus in water (center) -->
          <ellipse cx="100" cy="88" rx="12" ry="15" fill="#d4b896"/>
          <path d="M88 93 Q90 125 100 132 Q110 125 112 93" fill="#e0d0a0" opacity="0.7"/>
          <!-- Light halo -->
          <circle cx="100" cy="82" r="20" fill="none" stroke="rgba(255,220,100,0.35)" stroke-width="2" stroke-dasharray="5,3"/>
          <!-- John the Baptist left -->
          <ellipse cx="55" cy="88" rx="11" ry="14" fill="#c4a070"/>
          <path d="M44 93 Q46 128 55 134 Q64 128 66 93" fill="#5a3a1a"/>
          <path d="M44 90 Q49 76 55 72 Q61 76 66 90" fill="#7a5a30" opacity="0.6"/>
          <!-- John pouring water -->
          <path d="M66 90 Q85 82 100 93" fill="none" stroke="rgba(200,230,255,0.5)" stroke-width="2"/>
          <!-- Shell/cup -->
          <path d="M62 88 Q70 84 74 90 Q68 93 62 88" fill="#d4c090" opacity="0.8"/>
          <!-- Angel right bank -->
          <ellipse cx="158" cy="88" rx="10" ry="13" fill="#e0d8c0"/>
          <path d="M148 92 Q150 124 158 130 Q166 124 168 92" fill="#b0c8e0"/>
          <path d="M140 80 Q150 65 158 70 Q152 80 148 92" fill="rgba(255,255,200,0.5)"/>
          <path d="M176 80 Q166 65 158 70 Q164 80 168 92" fill="rgba(255,255,200,0.5)"/>
        </svg>`,
        artCredit: 'After El Greco, "The Baptism of Jesus" (1608) — Oil on canvas'
      },
      {
        title: 'The Wedding at Cana',
        meditation: 'At Mary's prompting, Jesus performs His first miracle at a wedding feast, turning water into wine — and His disciples believe in Him.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#1a1520"/>
          <!-- Table cloth -->
          <path d="M20 100 L180 100 L175 155 L25 155 Z" fill="#e8e0cc" opacity="0.12"/>
          <line x1="20" y1="100" x2="180" y2="100" stroke="rgba(201,168,76,0.3)" stroke-width="1.5"/>
          <!-- Water jars (left) -->
          <ellipse cx="32" cy="130" rx="10" ry="5" fill="#a08060" opacity="0.8"/>
          <path d="M22 100 Q22 128 32 133 Q42 128 42 100 Z" fill="#a08060" opacity="0.8"/>
          <!-- Jar turning to wine glow -->
          <ellipse cx="32" cy="100" rx="10" ry="4" fill="rgba(180,40,40,0.4)"/>
          <!-- Stone jars right group -->
          <ellipse cx="68" cy="132" rx="9" ry="4" fill="#907050" opacity="0.7"/>
          <path d="M59 103 Q59 130 68 135 Q77 130 77 103 Z" fill="#907050" opacity="0.7"/>
          <ellipse cx="52" cy="133" rx="8" ry="4" fill="#907050" opacity="0.5"/>
          <path d="M44 106 Q44 131 52 136 Q60 131 60 106 Z" fill="#907050" opacity="0.5"/>
          <!-- Wine jug -->
          <path d="M88 85 Q88 110 95 115 Q100 118 105 115 Q112 110 112 85 Z" fill="#8a2020" opacity="0.8"/>
          <ellipse cx="100" cy="84" rx="12" ry="5" fill="rgba(180,40,40,0.5)"/>
          <!-- Servant pouring -->
          <ellipse cx="145" cy="78" rx="11" ry="13" fill="#d4b080"/>
          <path d="M134 83 Q136 118 145 124 Q154 118 156 83" fill="#5a4030"/>
          <path d="M134 80 Q139 67 145 63 Q151 67 156 80" fill="#8a6040" opacity="0.6"/>
          <!-- Jesus (center back) -->
          <ellipse cx="100" cy="72" rx="10" ry="12" fill="#d4b896"/>
          <path d="M90 77 Q92 110 100 116 Q108 110 110 77" fill="#6080b0"/>
          <circle cx="100" cy="66" r="16" fill="none" stroke="rgba(255,220,100,0.3)" stroke-width="1.5" stroke-dasharray="4,3"/>
          <!-- Mary left of Jesus -->
          <ellipse cx="76" cy="74" rx="10" ry="12" fill="#d4b896"/>
          <path d="M66 79 Q68 112 76 118 Q84 112 86 79" fill="#1a3060"/>
          <path d="M66 76 Q71 63 76 59 Q81 63 86 76" fill="#6a2010" opacity="0.6"/>
          <!-- Guests -->
          <ellipse cx="165" cy="76" rx="9" ry="11" fill="#c4a080"/>
          <path d="M156 81 Q158 112 165 118 Q172 112 174 81" fill="#3a2840"/>
          <!-- Wine colour glow -->
          <ellipse cx="100" cy="115" rx="30" ry="8" fill="rgba(120,20,20,0.15)"/>
        </svg>`,
        artCredit: 'After Master of the Catholic Kings, "The Marriage at Cana" (1495)'
      },
      {
        title: 'Proclamation of the Kingdom',
        meditation: 'Jesus goes throughout Galilee preaching the Good News of the Kingdom of God, calling all people to repentance and faith.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#141820"/>
          <!-- Landscape -->
          <path d="M0 100 Q50 85 100 95 Q150 105 200 90 L200 180 L0 180 Z" fill="#101418"/>
          <!-- Crowd (small figures) -->
          <ellipse cx="38" cy="100" rx="7" ry="9" fill="#c0906a"/>
          <ellipse cx="55" cy="98" rx="7" ry="9" fill="#a07850"/>
          <ellipse cx="152" cy="100" rx="7" ry="9" fill="#b08060"/>
          <ellipse cx="168" cy="98" rx="7" ry="9" fill="#a07040"/>
          <ellipse cx="30" cy="115" rx="6" ry="8" fill="#8a6040"/>
          <ellipse cx="170" cy="115" rx="6" ry="8" fill="#8a6040"/>
          <!-- Jesus preaching (centre, elevated) -->
          <rect x="80" y="88" width="40" height="8" rx="3" fill="#2a2020"/>
          <ellipse cx="100" cy="75" rx="13" ry="16" fill="#d4b896"/>
          <path d="M87 80 Q89 122 100 130 Q111 122 113 80" fill="#6080b0"/>
          <path d="M87 77 Q93 62 100 57 Q107 62 113 77" fill="#c8a050" opacity="0.5"/>
          <!-- Right hand raised -->
          <line x1="113" y1="82" x2="128" y2="70" stroke="#d4b896" stroke-width="3" stroke-linecap="round"/>
          <!-- Light halo -->
          <circle cx="100" cy="70" r="22" fill="none" stroke="rgba(255,220,100,0.3)" stroke-width="1.5" stroke-dasharray="5,4"/>
          <!-- Golden light beams -->
          <line x1="100" y1="55" x2="70" y2="30" stroke="rgba(255,220,100,0.1)" stroke-width="2"/>
          <line x1="100" y1="55" x2="130" y2="30" stroke="rgba(255,220,100,0.1)" stroke-width="2"/>
          <line x1="100" y1="55" x2="100" y2="25" stroke="rgba(255,220,100,0.15)" stroke-width="2"/>
          <!-- Boat on sea (distant) -->
          <path d="M140 88 Q155 82 170 88 Q155 92 140 88 Z" fill="#1a2040" opacity="0.8"/>
          <line x1="155" y1="82" x2="155" y2="70" stroke="#2a3050" stroke-width="1.5"/>
        </svg>`,
        artCredit: 'After Rembrandt, "Jesus Preaching (La Tombe)" (1652) — Etching'
      },
      {
        title: 'The Transfiguration',
        meditation: 'On Mount Tabor, Jesus is transfigured before Peter, James, and John. His face shines like the sun, and Moses and Elijah appear beside him.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0a0a1a"/>
          <!-- Mountain -->
          <path d="M0 180 Q100 60 200 180 Z" fill="#101018"/>
          <!-- Intense light explosion -->
          <radialGradient id="tGrad" cx="50%" cy="38%" r="45%">
            <stop offset="0%" stop-color="rgba(255,255,255,0.9)"/>
            <stop offset="30%" stop-color="rgba(255,240,180,0.5)"/>
            <stop offset="100%" stop-color="rgba(0,0,0,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="55" rx="70" ry="55" fill="url(#tGrad)"/>
          <!-- Jesus (white, transfigured) -->
          <ellipse cx="100" cy="72" rx="13" ry="17" fill="rgba(255,255,255,0.95)"/>
          <path d="M87 77 Q89 120 100 128 Q111 120 113 77" fill="rgba(255,255,255,0.95)"/>
          <!-- White halo -->
          <circle cx="100" cy="66" r="20" fill="none" stroke="rgba(255,255,255,0.6)" stroke-width="3"/>
          <!-- Moses (left, older) -->
          <ellipse cx="65" cy="72" rx="10" ry="12" fill="rgba(220,200,160,0.85)"/>
          <path d="M55 77 Q57 112 65 118 Q73 112 75 77" fill="rgba(120,160,100,0.8)"/>
          <!-- Elijah (right) -->
          <ellipse cx="135" cy="72" rx="10" ry="12" fill="rgba(220,200,160,0.85)"/>
          <path d="M125 77 Q127 112 135 118 Q143 112 145 77" fill="rgba(160,100,60,0.8)"/>
          <!-- Disciples below (falling/shielding) -->
          <ellipse cx="45" cy="138" rx="9" ry="8" fill="#c0a070"/>
          <path d="M36 142 Q40 158 45 162 Q50 158 54 142" fill="#404040" opacity="0.8"/>
          <ellipse cx="100" cy="148" rx="9" ry="7" fill="#c0a070"/>
          <path d="M91 152 Q95 165 100 168 Q105 165 109 152" fill="#404040" opacity="0.8"/>
          <ellipse cx="158" cy="138" rx="9" ry="8" fill="#c0a070"/>
          <path d="M149 142 Q153 158 158 162 Q163 158 167 142" fill="#404040" opacity="0.8"/>
          <!-- Light beams -->
          <line x1="100" y1="55" x2="30" y2="10" stroke="rgba(255,255,200,0.15)" stroke-width="2"/>
          <line x1="100" y1="55" x2="170" y2="10" stroke="rgba(255,255,200,0.15)" stroke-width="2"/>
          <line x1="100" y1="55" x2="100" y2="5" stroke="rgba(255,255,220,0.25)" stroke-width="2"/>
        </svg>`,
        artCredit: 'After Fra Angelico, "The Transfiguration" (1439–43) — Fresco, San Marco'
      },
      {
        title: 'Institution of the Eucharist',
        meditation: 'At the Last Supper, Jesus takes bread and wine, gives thanks, and says, "This is my body… This is my blood." He commands, "Do this in memory of me."',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0f0c18"/>
          <!-- Room -->
          <rect x="15" y="30" width="170" height="130" fill="#150f22" rx="4"/>
          <!-- Window arch -->
          <path d="M75 30 Q100 10 125 30" fill="#0a0818" stroke="rgba(201,168,76,0.2)" stroke-width="1"/>
          <!-- Long table -->
          <path d="M15 105 L185 105 L180 135 L20 135 Z" fill="#1a1018"/>
          <line x1="15" y1="105" x2="185" y2="105" stroke="rgba(201,168,76,0.35)" stroke-width="1.5"/>
          <!-- Chalice (center, glowing) -->
          <path d="M93 88 Q90 103 88 106 L112 106 Q110 103 107 88 Z" fill="#c8a040" opacity="0.9"/>
          <ellipse cx="100" cy="88" rx="7" ry="4" fill="rgba(200,40,40,0.7)"/>
          <path d="M88 107 L112 107 L108 112 L92 112 Z" fill="#c8a040" opacity="0.7"/>
          <line x1="100" y1="112" x2="100" y2="120" stroke="#c8a040" stroke-width="3" opacity="0.7"/>
          <ellipse cx="100" cy="121" rx="9" ry="4" fill="#c8a040" opacity="0.6"/>
          <!-- Golden glow around chalice -->
          <ellipse cx="100" cy="100" rx="25" ry="18" fill="rgba(201,168,76,0.1)"/>
          <!-- Bread loaves -->
          <ellipse cx="65" cy="104" rx="12" ry="7" fill="#d4b070" opacity="0.8"/>
          <ellipse cx="140" cy="104" rx="12" ry="7" fill="#d4b070" opacity="0.8"/>
          <!-- Jesus (center) -->
          <ellipse cx="100" cy="72" rx="12" ry="14" fill="#d4b896"/>
          <path d="M88 77 Q90 108 100 114 Q110 108 112 77" fill="#4a60a0"/>
          <path d="M88 74 Q93 61 100 57 Q107 61 112 74" fill="#c8a050" opacity="0.4"/>
          <circle cx="100" cy="67" r="18" fill="none" stroke="rgba(255,220,100,0.35)" stroke-width="1.5" stroke-dasharray="4,3"/>
          <!-- Apostles (simplified, both sides) -->
          <ellipse cx="60" cy="78" rx="10" ry="12" fill="#c4a080"/>
          <ellipse cx="140" cy="78" rx="10" ry="12" fill="#c4a080"/>
          <ellipse cx="30" cy="82" rx="9" ry="11" fill="#b09070"/>
          <ellipse cx="170" cy="82" rx="9" ry="11" fill="#b09070"/>
          <!-- Warm candlelight -->
          <circle cx="50" cy="65" r="3" fill="rgba(255,180,40,0.6)"/>
          <circle cx="150" cy="65" r="3" fill="rgba(255,180,40,0.6)"/>
        </svg>`,
        artCredit: 'After Fra Angelico, "Institution of the Eucharist" (1450) — Fresco'
      }
    ]
  },
  sorrowful: {
    label: 'Sorrowful Mysteries',
    color: 'art-sorrowful',
    mysteries: [
      {
        title: 'Agony in the Garden',
        meditation: 'Jesus prays in the Garden of Gethsemane: "Father, if it be possible, let this cup pass from me — yet not my will, but Thine be done."',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#080510"/>
          <!-- Night garden -->
          <path d="M0 120 Q50 100 100 115 Q150 130 200 110 L200 180 L0 180 Z" fill="#0a0810"/>
          <!-- Dark olive trees -->
          <circle cx="30" cy="80" r="25" fill="#0d1a06"/>
          <circle cx="175" cy="90" r="20" fill="#0d1a06"/>
          <circle cx="155" cy="75" r="18" fill="#0f1a08"/>
          <line x1="30" y1="105" x2="30" y2="130" stroke="#0a1005" stroke-width="4"/>
          <line x1="175" y1="110" x2="175" y2="130" stroke="#0a1005" stroke-width="4"/>
          <!-- Moon -->
          <circle cx="160" cy="22" r="15" fill="rgba(220,210,180,0.2)"/>
          <!-- Angel with chalice (top left) -->
          <ellipse cx="42" cy="48" rx="9" ry="11" fill="rgba(220,220,200,0.7)"/>
          <path d="M33 52 Q35 78 42 83 Q49 78 51 52" fill="rgba(180,180,220,0.6)"/>
          <path d="M26 44 Q34 30 42 36 Q36 47 33 52" fill="rgba(200,200,180,0.4)"/>
          <path d="M58 44 Q50 30 42 36 Q48 47 51 52" fill="rgba(200,200,180,0.4)"/>
          <!-- Chalice -->
          <path d="M38 68 Q36 78 35 80 L49 80 Q48 78 46 68 Z" fill="rgba(201,168,76,0.7)"/>
          <ellipse cx="42" cy="67" rx="4" ry="2.5" fill="rgba(180,20,20,0.6)"/>
          <!-- Jesus prostrate (center) -->
          <ellipse cx="105" cy="115" rx="14" ry="10" fill="#d4b896" opacity="0.9"/>
          <!-- Body horizontal -->
          <path d="M91 115 Q105 118 140 114 L140 122 Q105 126 91 123 Z" fill="#4a60a0" opacity="0.8"/>
          <!-- Light on Jesus from angel -->
          <path d="M42 80 Q65 95 91 113" fill="none" stroke="rgba(220,220,180,0.15)" stroke-width="2" stroke-dasharray="4,4"/>
          <!-- Disciples sleeping (background right) -->
          <ellipse cx="160" cy="118" rx="11" ry="8" fill="#b09070" opacity="0.6"/>
          <ellipse cx="148" cy="122" rx="10" ry="7" fill="#a08060" opacity="0.5"/>
          <ellipse cx="170" cy="122" rx="9" ry="7" fill="#906050" opacity="0.5"/>
          <!-- Blood/sweat drops -->
          <circle cx="100" cy="108" r="2" fill="rgba(180,20,20,0.5)"/>
          <circle cx="108" cy="105" r="1.5" fill="rgba(180,20,20,0.4)"/>
          <circle cx="95" cy="106" r="1.5" fill="rgba(180,20,20,0.4)"/>
        </svg>`,
        artCredit: 'After Botticelli, "Agony in the Garden" (c.1500) — Tempera on panel'
      },
      {
        title: 'The Scourging at the Pillar',
        meditation: 'Jesus is bound to a pillar and brutally scourged. He bears our infirmities and is wounded for our transgressions.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#100808"/>
          <!-- Stone floor -->
          <rect x="0" y="140" width="200" height="40" fill="#0c0808"/>
          <line x1="0" y1="140" x2="200" y2="140" stroke="rgba(100,60,60,0.3)" stroke-width="1"/>
          <!-- Pillar -->
          <rect x="93" y="20" width="14" height="135" fill="#1a1010" rx="7"/>
          <rect x="93" y="20" width="14" height="135" fill="none" rx="7" stroke="rgba(100,60,60,0.3)" stroke-width="1"/>
          <!-- Jesus bound to pillar -->
          <ellipse cx="100" cy="78" rx="11" ry="14" fill="#d4b896"/>
          <path d="M89 83 Q91 125 100 132 Q109 125 111 83" fill="#e0d0b0" opacity="0.9"/>
          <!-- Rope binding -->
          <path d="M89 90 Q100 87 111 90" fill="none" stroke="#8a6030" stroke-width="2"/>
          <path d="M89 100 Q100 97 111 100" fill="none" stroke="#8a6030" stroke-width="2"/>
          <!-- Crown of darkness / shadow -->
          <ellipse cx="100" cy="72" rx="18" ry="12" fill="rgba(0,0,0,0.4)"/>
          <!-- Wounds (subtle red) -->
          <path d="M89 88 L85 93" stroke="rgba(180,20,20,0.5)" stroke-width="2"/>
          <path d="M111 85 L115 90" stroke="rgba(180,20,20,0.5)" stroke-width="2"/>
          <!-- Tormentors (silhouettes) -->
          <ellipse cx="48" cy="88" rx="10" ry="12" fill="#1a0f0f"/>
          <path d="M38 93 Q40 125 48 130 Q56 125 58 93" fill="#1a0f0f"/>
          <ellipse cx="155" cy="88" rx="10" ry="12" fill="#1a0f0f"/>
          <path d="M145 93 Q147 125 155 130 Q163 125 165 93" fill="#1a0f0f"/>
          <!-- Whip lines -->
          <path d="M58 95 Q72 88 89 90" fill="none" stroke="rgba(120,40,40,0.4)" stroke-width="1.5"/>
          <path d="M145 95 Q131 88 111 90" fill="none" stroke="rgba(120,40,40,0.4)" stroke-width="1.5"/>
          <!-- Dim torchlight -->
          <radialGradient id="torchGrad" cx="50%" cy="50%" r="50%">
            <stop offset="0%" stop-color="rgba(200,100,30,0.15)"/>
            <stop offset="100%" stop-color="rgba(0,0,0,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="100" rx="60" ry="60" fill="url(#torchGrad)"/>
        </svg>`,
        artCredit: 'After Duccio, "Flagellation" (1308–11) — Tempera on wood'
      },
      {
        title: 'Crowning with Thorns',
        meditation: 'Soldiers mock Jesus as "King of the Jews," weaving a crown of thorns and pressing it onto His head. They strike and spit upon Him.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0c0808"/>
          <!-- Background figures (mockers, dark) -->
          <ellipse cx="38" cy="78" rx="10" ry="13" fill="#180a0a"/>
          <path d="M28 83 Q30 118 38 124 Q46 118 48 83" fill="#180a0a"/>
          <ellipse cx="162" cy="78" rx="10" ry="13" fill="#180a0a"/>
          <path d="M152 83 Q154 118 162 124 Q170 118 172 83" fill="#180a0a"/>
          <!-- Stick pressing crown down (left) -->
          <line x1="48" y1="85" x2="88" y2="80" stroke="#180a0a" stroke-width="4"/>
          <!-- Stick right -->
          <line x1="152" y1="85" x2="112" y2="80" stroke="#180a0a" stroke-width="4"/>
          <!-- Jesus central, illuminated -->
          <ellipse cx="100" cy="85" rx="13" ry="16" fill="#d4b896"/>
          <path d="M87 90 Q89 130 100 138 Q111 130 113 90" fill="#c8b090" opacity="0.9"/>
          <!-- Crown of thorns -->
          <ellipse cx="100" cy="73" rx="16" ry="7" fill="none" stroke="#4a2a10" stroke-width="3"/>
          <!-- Thorns -->
          <line x1="90" y1="70" x2="87" y2="62" stroke="#4a2a10" stroke-width="1.5"/>
          <line x1="96" y1="68" x2="95" y2="60" stroke="#4a2a10" stroke-width="1.5"/>
          <line x1="104" y1="68" x2="105" y2="60" stroke="#4a2a10" stroke-width="1.5"/>
          <line x1="110" y1="70" x2="113" y2="62" stroke="#4a2a10" stroke-width="1.5"/>
          <!-- Blood drops -->
          <circle cx="92" cy="78" r="1.5" fill="rgba(180,20,20,0.7)"/>
          <circle cx="108" cy="77" r="1.5" fill="rgba(180,20,20,0.7)"/>
          <circle cx="100" cy="80" r="1.5" fill="rgba(180,20,20,0.6)"/>
          <!-- Eyes downcast -->
          <line x1="95" y1="86" x2="98" y2="87" stroke="#6a4030" stroke-width="1"/>
          <line x1="102" y1="86" x2="105" y2="87" stroke="#6a4030" stroke-width="1"/>
          <!-- Reed scepter in hand -->
          <line x1="113" y1="100" x2="135" y2="120" stroke="#3a2010" stroke-width="2.5"/>
          <!-- Light source on Jesus only -->
          <radialGradient id="spotGrad" cx="50%" cy="48%" r="30%">
            <stop offset="0%" stop-color="rgba(220,180,100,0.2)"/>
            <stop offset="100%" stop-color="rgba(0,0,0,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="90" rx="60" ry="60" fill="url(#spotGrad)"/>
          <!-- Floor -->
          <rect x="0" y="145" width="200" height="35" fill="#080505"/>
        </svg>`,
        artCredit: 'After Bosch, "Christ Mocked" (c.1495–1500) — Oil on wood'
      },
      {
        title: 'Carrying of the Cross',
        meditation: 'Jesus carries the heavy Cross through the streets of Jerusalem toward Calvary, falling three times yet rising again in love for us.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0e0a0a"/>
          <!-- Dusty road -->
          <path d="M0 130 Q100 120 200 130 L200 180 L0 180 Z" fill="#100c0c"/>
          <!-- Jerusalem walls (far) -->
          <rect x="0" y="50" width="200" height="70" fill="#0c0a0a"/>
          <rect x="0" y="40" width="30" height="10" fill="#120c0c"/>
          <rect x="170" y="40" width="30" height="10" fill="#120c0c"/>
          <!-- Cross (large, heavy) -->
          <rect x="78" y="45" width="12" height="120" fill="#3a2010" rx="2"/>
          <rect x="50" y="75" width="68" height="10" fill="#3a2010" rx="2"/>
          <!-- Jesus (bent under cross) -->
          <ellipse cx="95" cy="100" rx="11" ry="13" fill="#d4b896"/>
          <!-- Body bent forward -->
          <path d="M84 105 Q88 128 95 135 Q102 128 106 105" fill="#c8b090"/>
          <!-- Crown of thorns -->
          <ellipse cx="95" cy="92" rx="13" ry="6" fill="none" stroke="#4a2a10" stroke-width="2"/>
          <!-- Simon helping (right) -->
          <ellipse cx="140" cy="95" rx="12" ry="14" fill="#c0a070"/>
          <path d="M128 100 Q130 132 140 138 Q150 132 152 100" fill="#5a4030"/>
          <path d="M128 97 Q134 84 140 80 Q146 84 152 97" fill="#8a6040" opacity="0.6"/>
          <!-- Simon's hands on cross -->
          <path d="M128 100 Q118 90 106 88" fill="none" stroke="#c0a070" stroke-width="2.5" stroke-linecap="round"/>
          <!-- Crowd silhouettes (dark) -->
          <ellipse cx="25" cy="102" rx="9" ry="11" fill="#0e0808"/>
          <ellipse cx="178" cy="100" rx="9" ry="11" fill="#0e0808"/>
          <ellipse cx="160" cy="105" rx="8" ry="10" fill="#0e0808"/>
          <!-- Veronica (left with cloth?) -->
          <ellipse cx="52" cy="100" rx="10" ry="12" fill="#1a1010"/>
          <path d="M42 105 Q44 132 52 138 Q60 132 62 105" fill="#3a1a1a"/>
          <!-- Ochre dust path -->
          <path d="M90 130 Q100 127 120 130" fill="none" stroke="rgba(150,100,50,0.2)" stroke-width="3"/>
        </svg>`,
        artCredit: 'Inspired by El Greco, "Christ Carrying the Cross" — Oil on canvas'
      },
      {
        title: 'The Crucifixion',
        meditation: '"Father, forgive them, for they know not what they do." Jesus gives His life for the sins of the world. Mary stands at the foot of the Cross.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#080508"/>
          <!-- Golgotha hill -->
          <path d="M0 180 Q100 100 200 180 Z" fill="#0a0808"/>
          <!-- Darkened sky -->
          <radialGradient id="darkSky" cx="50%" cy="40%" r="60%">
            <stop offset="0%" stop-color="rgba(40,10,10,0.8)"/>
            <stop offset="100%" stop-color="rgba(8,5,8,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="40" rx="100" ry="80" fill="url(#darkSky)"/>
          <!-- Three crosses (two thieves, smaller/darker) -->
          <rect x="30" y="55" width="6" height="90" fill="#1a1010" rx="2"/>
          <rect x="15" y="80" width="36" height="6" fill="#1a1010" rx="2"/>
          <rect x="164" y="55" width="6" height="90" fill="#1a1010" rx="2"/>
          <rect x="149" y="80" width="36" height="6" fill="#1a1010" rx="2"/>
          <!-- Main cross -->
          <rect x="95" y="15" width="10" height="120" fill="#2a1808" rx="2"/>
          <rect x="70" y="50" width="60" height="9" fill="#2a1808" rx="2"/>
          <!-- INRI plaque -->
          <rect x="90" y="15" width="20" height="8" rx="2" fill="#c8b078" opacity="0.6"/>
          <!-- Jesus on cross -->
          <ellipse cx="100" cy="55" rx="10" ry="12" fill="#d4b896"/>
          <path d="M90 60 Q92 95 100 100 Q108 95 110 60" fill="#d4c0a0"/>
          <!-- Arms along crossbar -->
          <path d="M70 54 L90 58" stroke="#d4b896" stroke-width="4" stroke-linecap="round"/>
          <path d="M130 54 L110 58" stroke="#d4b896" stroke-width="4" stroke-linecap="round"/>
          <!-- Crown of thorns -->
          <ellipse cx="100" cy="48" rx="12" ry="5" fill="none" stroke="#4a2a10" stroke-width="2"/>
          <!-- Head bowed -->
          <ellipse cx="100" cy="52" rx="8" ry="9" fill="#d4b896" opacity="0.9"/>
          <!-- Wound glow (side) -->
          <circle cx="107" cy="72" r="3" fill="rgba(180,20,20,0.5)"/>
          <!-- Mary (left, blue) -->
          <ellipse cx="62" cy="118" rx="10" ry="12" fill="#d4b896"/>
          <path d="M52 123 Q54 148 62 153 Q70 148 72 123" fill="#1a3060"/>
          <path d="M52 120 Q57 108 62 104 Q67 108 72 120" fill="#1a3060"/>
          <!-- John (right) -->
          <ellipse cx="140" cy="118" rx="10" ry="12" fill="#c4a080"/>
          <path d="M130 123 Q132 148 140 153 Q148 148 150 123" fill="#4a3060"/>
          <path d="M130 120 Q135 108 140 104 Q145 108 150 120" fill="#c8a050" opacity="0.5"/>
          <!-- Red/gold light behind cross -->
          <radialGradient id="crossGlow" cx="50%" cy="38%" r="30%">
            <stop offset="0%" stop-color="rgba(120,40,20,0.2)"/>
            <stop offset="100%" stop-color="rgba(0,0,0,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="60" rx="70" ry="70" fill="url(#crossGlow)"/>
        </svg>`,
        artCredit: 'Inspired by El Greco, "The Crucifixion" (1597–1600) — Oil on canvas'
      }
    ]
  },
  glorious: {
    label: 'Glorious Mysteries',
    color: 'art-glorious',
    mysteries: [
      {
        title: 'The Resurrection',
        meditation: 'On the third day, Christ rises from the dead, victorious over sin and death. The tomb is empty. "He is not here — He has risen!"',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0a0808"/>
          <!-- Pre-dawn sky -->
          <radialGradient id="dawnGrad" cx="50%" cy="20%" r="60%">
            <stop offset="0%" stop-color="rgba(200,140,40,0.4)"/>
            <stop offset="50%" stop-color="rgba(60,20,80,0.3)"/>
            <stop offset="100%" stop-color="rgba(8,5,12,0)"/>
          </radialGradient>
          <rect x="0" y="0" width="200" height="180" fill="url(#dawnGrad)"/>
          <!-- Garden -->
          <path d="M0 150 Q100 130 200 150 L200 180 L0 180 Z" fill="#0c100a"/>
          <!-- Tomb (rolled stone left) -->
          <circle cx="30" cy="115" r="22" fill="#1a1818" stroke="#2a2020" stroke-width="1"/>
          <circle cx="30" cy="115" r="18" fill="#141212"/>
          <line x1="30" y1="100" x2="30" y2="130" stroke="rgba(100,80,60,0.15)" stroke-width="1"/>
          <!-- Tomb entrance (open) -->
          <path d="M50 100 Q70 90 90 100 L90 140 L50 140 Z" fill="#0a0808"/>
          <path d="M50 100 Q70 90 90 100" fill="none" stroke="rgba(201,168,76,0.2)" stroke-width="1"/>
          <!-- Risen Christ — brilliant white/gold -->
          <ellipse cx="130" cy="72" rx="14" ry="17" fill="rgba(240,230,210,0.95)"/>
          <path d="M116 77 Q118 120 130 128 Q142 120 144 77" fill="rgba(255,255,240,0.9)"/>
          <!-- Wound in hands/side glow -->
          <circle cx="116" cy="90" r="3" fill="rgba(200,100,50,0.5)"/>
          <circle cx="144" cy="90" r="3" fill="rgba(200,100,50,0.5)"/>
          <!-- Banner/standard -->
          <line x1="130" y1="65" x2="130" y2="30" stroke="rgba(201,168,76,0.7)" stroke-width="1.5"/>
          <path d="M130 30 L155 40 L130 50 Z" fill="rgba(201,168,76,0.5)"/>
          <!-- Brilliant halo/mandorla -->
          <ellipse cx="130" cy="90" rx="35" ry="45" fill="none" stroke="rgba(255,220,100,0.25)" stroke-width="3"/>
          <ellipse cx="130" cy="90" rx="28" ry="36" fill="none" stroke="rgba(255,220,100,0.15)" stroke-width="2"/>
          <!-- Light beams -->
          <line x1="130" y1="65" x2="100" y2="20" stroke="rgba(255,220,100,0.1)" stroke-width="3"/>
          <line x1="130" y1="65" x2="160" y2="20" stroke="rgba(255,220,100,0.1)" stroke-width="3"/>
          <line x1="130" y1="65" x2="130" y2="10" stroke="rgba(255,220,100,0.15)" stroke-width="3"/>
          <!-- Sleeping guards -->
          <ellipse cx="55" cy="142" rx="13" ry="8" fill="#1a2040" opacity="0.8"/>
          <ellipse cx="85" cy="145" rx="11" ry="7" fill="#1a2040" opacity="0.7"/>
          <!-- Angel (at tomb) -->
          <ellipse cx="75" cy="108" rx="8" ry="10" fill="rgba(220,220,200,0.7)"/>
          <path d="M67 112 Q69 132 75 136 Q81 132 83 112" fill="rgba(200,200,240,0.6)"/>
          <path d="M60 104 Q67 90 75 96 Q70 106 67 112" fill="rgba(220,220,200,0.4)"/>
          <path d="M90 104 Q83 90 75 96 Q80 106 83 112" fill="rgba(220,220,200,0.4)"/>
        </svg>`,
        artCredit: 'Inspired by Piero della Francesca, "The Resurrection" (c.1460)'
      },
      {
        title: 'The Ascension',
        meditation: 'Forty days after Easter, Jesus ascends to heaven before the eyes of His disciples. "And I will be with you always, to the end of the age."',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0a1020"/>
          <!-- Heaven above -->
          <radialGradient id="heavenGrad" cx="50%" cy="10%" r="60%">
            <stop offset="0%" stop-color="rgba(200,180,120,0.4)"/>
            <stop offset="50%" stop-color="rgba(60,80,140,0.2)"/>
            <stop offset="100%" stop-color="rgba(10,16,32,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="20" rx="100" ry="80" fill="url(#heavenGrad)"/>
          <!-- Cloud band -->
          <ellipse cx="100" cy="75" rx="90" ry="22" fill="rgba(180,170,150,0.12)"/>
          <ellipse cx="60" cy="78" rx="35" ry="14" fill="rgba(180,170,150,0.08)"/>
          <ellipse cx="145" cy="76" rx="30" ry="12" fill="rgba(180,170,150,0.08)"/>
          <!-- Christ ascending (upper, feet visible below clouds) -->
          <path d="M90 68 Q95 78 105 78 Q115 78 110 68 Z" fill="#d4c090" opacity="0.85"/>
          <path d="M92 70 Q100 65 108 70" fill="none" stroke="#a09060" stroke-width="1"/>
          <!-- Body in clouds -->
          <ellipse cx="100" cy="55" rx="13" ry="9" fill="rgba(240,230,210,0.6)" opacity="0.7"/>
          <!-- Light burst above cloud -->
          <circle cx="100" cy="35" r="18" fill="rgba(255,220,100,0.15)"/>
          <line x1="100" y1="35" x2="80" y2="10" stroke="rgba(255,220,100,0.1)" stroke-width="2"/>
          <line x1="100" y1="35" x2="120" y2="10" stroke="rgba(255,220,100,0.1)" stroke-width="2"/>
          <line x1="100" y1="35" x2="100" y2="5" stroke="rgba(255,220,100,0.15)" stroke-width="2"/>
          <!-- Disciples circle below -->
          <ellipse cx="50" cy="130" rx="10" ry="12" fill="#c0a070"/>
          <path d="M40 135 Q42 155 50 160 Q58 155 60 135" fill="#3a3060"/>
          <ellipse cx="80" cy="122" rx="10" ry="13" fill="#d4b896"/>
          <path d="M70 127 Q72 150 80 155 Q88 150 90 127" fill="#1a3060"/>
          <ellipse cx="100" cy="120" rx="10" ry="13" fill="#d4b896"/>
          <path d="M90 125 Q92 150 100 155 Q108 150 110 125" fill="#4a3080"/>
          <ellipse cx="120" cy="122" rx="10" ry="13" fill="#c4a080"/>
          <path d="M110 127 Q112 150 120 155 Q128 150 130 127" fill="#2a3040"/>
          <ellipse cx="150" cy="130" rx="10" ry="12" fill="#c0a070"/>
          <path d="M140 135 Q142 155 150 160 Q158 155 160 135" fill="#5a4030"/>
          <!-- Mary (centre, in blue) -->
          <ellipse cx="100" cy="130" rx="10" ry="12" fill="#d4b896"/>
          <path d="M90 135 Q92 158 100 163 Q108 158 110 135" fill="#1a3a80"/>
          <path d="M90 132 Q95 120 100 116 Q105 120 110 132" fill="#1a3a80" opacity="0.8"/>
          <!-- All gazing up -->
          <line x1="50" y1="122" x2="90" y2="80" stroke="rgba(201,168,76,0.1)" stroke-width="1"/>
          <line x1="150" y1="122" x2="110" y2="80" stroke="rgba(201,168,76,0.1)" stroke-width="1"/>
          <!-- Two angels below cloud -->
          <ellipse cx="28" cy="88" rx="8" ry="10" fill="rgba(220,220,200,0.6)"/>
          <ellipse cx="172" cy="88" rx="8" ry="10" fill="rgba(220,220,200,0.6)"/>
        </svg>`,
        artCredit: 'Inspired by Andrea Mantegna, "The Ascension" (c.1460) — Tempera'
      },
      {
        title: 'Descent of the Holy Spirit',
        meditation: 'On Pentecost, the Holy Spirit descends on the Apostles and Mary as tongues of fire, filling them with courage to proclaim the Gospel to all nations.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#100a18"/>
          <!-- Upper room -->
          <rect x="15" y="40" width="170" height="130" fill="#140f20" rx="4"/>
          <path d="M60 40 Q100 20 140 40" fill="none" stroke="rgba(201,168,76,0.2)" stroke-width="1"/>
          <!-- Fire tongues (central, radiating) -->
          <radialGradient id="pentGrad" cx="50%" cy="40%" r="50%">
            <stop offset="0%" stop-color="rgba(255,180,40,0.4)"/>
            <stop offset="60%" stop-color="rgba(200,80,20,0.15)"/>
            <stop offset="100%" stop-color="rgba(0,0,0,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="55" rx="80" ry="50" fill="url(#pentGrad)"/>
          <!-- Dove at center top -->
          <path d="M92 30 Q100 22 108 30 Q100 36 92 30" fill="white" opacity="0.9"/>
          <!-- Individual flame/tongues on heads -->
          <path d="M50 78 Q53 65 56 78" fill="rgba(255,160,30,0.7)" stroke="rgba(255,200,60,0.4)" stroke-width="0.5"/>
          <path d="M80 72 Q83 59 86 72" fill="rgba(255,160,30,0.7)" stroke="rgba(255,200,60,0.4)" stroke-width="0.5"/>
          <path d="M100 70 Q103 57 106 70" fill="rgba(255,180,40,0.9)" stroke="rgba(255,220,80,0.5)" stroke-width="0.5"/>
          <path d="M120 72 Q123 59 126 72" fill="rgba(255,160,30,0.7)" stroke="rgba(255,200,60,0.4)" stroke-width="0.5"/>
          <path d="M150 78 Q153 65 156 78" fill="rgba(255,160,30,0.7)" stroke="rgba(255,200,60,0.4)" stroke-width="0.5"/>
          <path d="M68 84 Q71 71 74 84" fill="rgba(255,150,20,0.6)" stroke="rgba(255,190,50,0.3)" stroke-width="0.5"/>
          <path d="M134 84 Q137 71 140 84" fill="rgba(255,150,20,0.6)" stroke="rgba(255,190,50,0.3)" stroke-width="0.5"/>
          <!-- Apostles (row, lit faces) -->
          <ellipse cx="50" cy="90" rx="10" ry="12" fill="#d4b896"/>
          <path d="M40 95 Q42 128 50 133 Q58 128 60 95" fill="#1a3060"/>
          <ellipse cx="80" cy="86" rx="10" ry="12" fill="#c4a882"/>
          <path d="M70 91 Q72 124 80 129 Q88 124 90 91" fill="#3a2840"/>
          <ellipse cx="100" cy="84" rx="10" ry="13" fill="#d4b896"/>
          <path d="M90 89 Q92 124 100 129 Q108 124 110 89" fill="#2a4060"/>
          <ellipse cx="120" cy="86" rx="10" ry="12" fill="#c4a882"/>
          <path d="M110 91 Q112 124 120 129 Q128 124 130 91" fill="#403020"/>
          <ellipse cx="150" cy="90" rx="10" ry="12" fill="#d4b896"/>
          <path d="M140 95 Q142 128 150 133 Q158 128 160 95" fill="#1a4030"/>
          <!-- Mary (centre, bright) -->
          <ellipse cx="100" cy="110" rx="11" ry="14" fill="#d4b896"/>
          <path d="M89 115 Q91 148 100 154 Q109 148 111 115" fill="#1a3a80"/>
          <path d="M89 112 Q94 99 100 95 Q106 99 111 112" fill="#1a3a80"/>
          <!-- Floor -->
          <rect x="15" y="160" width="170" height="10" fill="#0e0a18"/>
        </svg>`,
        artCredit: 'Inspired by El Greco, "Pentecost" (c.1600) — Oil on canvas'
      },
      {
        title: 'The Assumption of Mary',
        meditation: 'At the end of her earthly life, the Virgin Mary is taken up body and soul into heavenly glory — as befits the Mother of the Lord.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0a0c18"/>
          <!-- Heavenly light above -->
          <radialGradient id="assumeGrad" cx="50%" cy="25%" r="55%">
            <stop offset="0%" stop-color="rgba(200,180,130,0.35)"/>
            <stop offset="40%" stop-color="rgba(80,60,120,0.2)"/>
            <stop offset="100%" stop-color="rgba(10,12,24,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="30" rx="100" ry="80" fill="url(#assumeGrad)"/>
          <!-- Clouds -->
          <ellipse cx="100" cy="70" rx="80" ry="20" fill="rgba(180,170,150,0.1)"/>
          <ellipse cx="55" cy="72" rx="35" ry="12" fill="rgba(180,170,150,0.07)"/>
          <ellipse cx="148" cy="71" rx="30" ry="10" fill="rgba(180,170,150,0.07)"/>
          <!-- Mary ascending (luminous) -->
          <ellipse cx="100" cy="55" rx="14" ry="17" fill="#d4b896"/>
          <path d="M86 60 Q88 100 100 108 Q112 100 114 60" fill="#1a3a80"/>
          <path d="M86 57 Q92 42 100 37 Q108 42 114 57" fill="#1a3a80" opacity="0.8"/>
          <!-- Blue mantle flowing -->
          <path d="M86 60 Q70 80 72 108 L86 108 Q88 80 86 60" fill="#1a3a80" opacity="0.6"/>
          <path d="M114 60 Q130 80 128 108 L114 108 Q112 80 114 60" fill="#1a3a80" opacity="0.6"/>
          <!-- Golden light halo -->
          <circle cx="100" cy="45" r="24" fill="none" stroke="rgba(255,220,100,0.4)" stroke-width="2"/>
          <circle cx="100" cy="45" r="18" fill="none" stroke="rgba(255,220,100,0.2)" stroke-width="1.5"/>
          <!-- Stars -->
          <circle cx="78" cy="35" r="2" fill="rgba(255,220,100,0.6)"/>
          <circle cx="122" cy="33" r="2" fill="rgba(255,220,100,0.6)"/>
          <circle cx="100" cy="28" r="2" fill="rgba(255,220,100,0.7)"/>
          <circle cx="88" cy="28" r="1.5" fill="rgba(255,220,100,0.5)"/>
          <circle cx="112" cy="30" r="1.5" fill="rgba(255,220,100,0.5)"/>
          <!-- Little angels with her -->
          <ellipse cx="68" cy="72" rx="9" ry="10" fill="rgba(220,210,190,0.7)"/>
          <path d="M59 75 Q61 92 68 96 Q75 92 77 75" fill="rgba(200,200,240,0.6)"/>
          <path d="M52 68 Q60 55 68 61 Q62 72 59 75" fill="rgba(220,220,200,0.4)"/>
          <path d="M84 68 Q76 55 68 61 Q74 72 77 75" fill="rgba(220,220,200,0.4)"/>
          <ellipse cx="132" cy="72" rx="9" ry="10" fill="rgba(220,210,190,0.7)"/>
          <path d="M123 75 Q125 92 132 96 Q139 92 141 75" fill="rgba(200,200,240,0.6)"/>
          <path d="M116 68 Q124 55 132 61 Q126 72 123 75" fill="rgba(220,220,200,0.4)"/>
          <path d="M148 68 Q140 55 132 61 Q138 72 141 75" fill="rgba(220,220,200,0.4)"/>
          <!-- Apostles below, looking up, empty tomb open -->
          <ellipse cx="40" cy="142" rx="11" ry="13" fill="#c0a070"/>
          <path d="M29 147 Q31 165 40 170 Q49 165 51 147" fill="#3a3060"/>
          <ellipse cx="70" cy="138" rx="11" ry="13" fill="#d4b896"/>
          <path d="M59 143 Q61 164 70 169 Q79 164 81 143" fill="#2a4060"/>
          <ellipse cx="130" cy="138" rx="11" ry="13" fill="#c4a080"/>
          <path d="M119 143 Q121 164 130 169 Q139 164 141 143" fill="#4a3020"/>
          <ellipse cx="160" cy="142" rx="11" ry="13" fill="#c0a070"/>
          <path d="M149 147 Q151 165 160 170 Q169 165 171 147" fill="#2a4030"/>
          <!-- Empty tomb with flowers -->
          <path d="M85 155 Q100 148 115 155 L112 175 L88 175 Z" fill="#0c1008" opacity="0.8"/>
          <circle cx="92" cy="158" r="3" fill="rgba(255,220,100,0.3)"/>
          <circle cx="108" cy="157" r="3" fill="rgba(255,220,100,0.3)"/>
        </svg>`,
        artCredit: 'Inspired by Titian, "The Assumption of the Virgin" (1516–18)'
      },
      {
        title: 'Coronation of Mary',
        meditation: 'The Virgin Mary, taken into heaven, is crowned Queen of Heaven and Earth by the Blessed Trinity — interceding for us, her children.',
        art: `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="200" height="180" fill="#0c0a14"/>
          <!-- Celestial light -->
          <radialGradient id="coronGrad" cx="50%" cy="30%" r="60%">
            <stop offset="0%" stop-color="rgba(220,200,120,0.4)"/>
            <stop offset="50%" stop-color="rgba(100,60,160,0.2)"/>
            <stop offset="100%" stop-color="rgba(12,10,20,0)"/>
          </radialGradient>
          <ellipse cx="100" cy="50" rx="100" ry="90" fill="url(#coronGrad)"/>
          <!-- Throne clouds -->
          <ellipse cx="100" cy="85" rx="70" ry="22" fill="rgba(220,210,190,0.08)"/>
          <ellipse cx="60" cy="82" rx="40" ry="15" fill="rgba(220,210,190,0.05)"/>
          <ellipse cx="145" cy="80" rx="35" ry="13" fill="rgba(220,210,190,0.05)"/>
          <!-- God the Father (left, aged, white-robed) -->
          <ellipse cx="55" cy="62" rx="13" ry="15" fill="#d4c8b0"/>
          <path d="M42 67 Q44 100 55 107 Q66 100 68 67" fill="rgba(240,235,220,0.9)"/>
          <path d="M42 64 Q48 50 55 46 Q62 50 68 64" fill="rgba(220,215,200,0.8)" opacity="0.9"/>
          <!-- Christ (right, younger, crown/scepter) -->
          <ellipse cx="145" cy="62" rx="13" ry="15" fill="#d4b896"/>
          <path d="M132 67 Q134 100 145 107 Q156 100 158 67" fill="#4060a0"/>
          <path d="M132 64 Q138 50 145 46 Q152 50 158 64" fill="#c8a050" opacity="0.5"/>
          <!-- Holy Spirit dove (above center) -->
          <path d="M92 25 Q100 18 108 25 Q100 31 92 25" fill="white" opacity="0.95"/>
          <circle cx="100" cy="25" r="10" fill="rgba(255,255,255,0.1)"/>
          <!-- Mary (center, kneeling) -->
          <ellipse cx="100" cy="80" rx="13" ry="15" fill="#d4b896"/>
          <path d="M87 85 Q89 118 100 124 Q111 118 113 85" fill="#1a3a80"/>
          <path d="M87 82 Q93 68 100 64 Q107 68 113 82" fill="#1a3a80" opacity="0.8"/>
          <!-- Golden crown above Mary's head -->
          <path d="M87 67 L92 55 L97 65 L100 52 L103 65 L108 55 L113 67 Z" fill="#c8a040" opacity="0.9"/>
          <!-- Crown being placed (hands from left and right) -->
          <path d="M68 67 Q82 60 87 67" fill="none" stroke="#d4c8b0" stroke-width="2" stroke-linecap="round"/>
          <path d="M132 67 Q118 60 113 67" fill="none" stroke="#d4b896" stroke-width="2" stroke-linecap="round"/>
          <!-- Mary's halo stars -->
          <circle cx="100" cy="68" r="22" fill="none" stroke="rgba(255,220,100,0.35)" stroke-width="1.5" stroke-dasharray="3,4"/>
          <!-- 12 stars (crown of stars) -->
          <circle cx="100" cy="47" r="2" fill="rgba(255,220,100,0.8)"/>
          <circle cx="111" cy="49" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="119" cy="56" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="121" cy="65" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="118" cy="74" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="112" cy="80" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="89" cy="49" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="81" cy="56" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="79" cy="65" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="82" cy="74" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <circle cx="88" cy="80" r="1.5" fill="rgba(255,220,100,0.7)"/>
          <!-- Cherubim below clouds -->
          <ellipse cx="28" cy="110" rx="9" ry="8" fill="rgba(220,200,180,0.6)"/>
          <path d="M18 108 Q22 95 28 101 Q24 108 22 112" fill="rgba(220,220,200,0.4)"/>
          <path d="M38 108 Q34 95 28 101 Q32 108 34 112" fill="rgba(220,220,200,0.4)"/>
          <ellipse cx="172" cy="110" rx="9" ry="8" fill="rgba(220,200,180,0.6)"/>
          <path d="M162 108 Q166 95 172 101 Q168 108 166 112" fill="rgba(220,220,200,0.4)"/>
          <path d="M182 108 Q178 95 172 101 Q176 108 178 112" fill="rgba(220,220,200,0.4)"/>
          <!-- Angels singing below -->
          <ellipse cx="65" cy="138" rx="10" ry="12" fill="rgba(220,200,170,0.7)"/>
          <path d="M55 142 Q57 162 65 167 Q73 162 75 142" fill="rgba(180,180,220,0.6)"/>
          <ellipse cx="135" cy="138" rx="10" ry="12" fill="rgba(220,200,170,0.7)"/>
          <path d="M125 142 Q127 162 135 167 Q143 162 145 142" fill="rgba(180,180,220,0.6)"/>
        </svg>`,
        artCredit: 'Inspired by Fra Angelico, "Coronation of the Virgin" (1430–32)'
      }
    ]
  }
};

// ── Prayers ──
const PRAYERS = {
  apostlesCreed: {
    type: "Apostles' Creed",
    text: `I believe in God, the Father Almighty, Creator of Heaven and earth; and in Jesus Christ, His only Son, Our Lord, Who was conceived by the Holy Spirit, born of the Virgin Mary, suffered under Pontius Pilate, was crucified, died, and was buried. He descended into Hell; the third day He rose again from the dead; He ascended into Heaven, and sits at the right hand of God the Father Almighty; from thence He shall come to judge the living and the dead.

I believe in the Holy Spirit, the Holy Catholic Church, the communion of Saints, the forgiveness of sins, the resurrection of the body and life everlasting. <em>Amen.</em>`
  },
  ourFather: {
    type: "Our Father",
    text: `Our Father, Who art in Heaven, hallowed be Thy name; Thy Kingdom come, Thy will be done on earth as it is in Heaven. Give us this day our daily bread; and forgive us our trespasses, as we forgive those who trespass against us; and lead us not into temptation, but deliver us from evil. <em>Amen.</em>`
  },
  hailMary: (intention) => ({
    type: "Hail Mary" + (intention ? ` — ${intention}` : ''),
    text: `Hail Mary, full of grace, the Lord is with thee; blessed art thou amongst women, and blessed is the fruit of thy womb, Jesus. Holy Mary, Mother of God, pray for us sinners, now and at the hour of our death. <em>Amen.</em>`
  }),
  gloryBe: {
    type: "Glory Be",
    text: `Glory be to the Father, and to the Son, and to the Holy Spirit. As it was in the beginning, is now, and ever shall be, world without end. <em>Amen.</em>`
  },
  fatima: {
    type: "Fatima Prayer",
    text: `O My Jesus, forgive us our sins, save us from the fires of hell, lead all souls to Heaven, especially those in most need of Thy mercy. <em>Amen.</em>`
  },
  hailHolyQueen: {
    type: "Hail, Holy Queen",
    text: `Hail, Holy Queen, Mother of Mercy! Our life, our sweetness, and our hope! To thee do we cry, poor banished children of Eve; to thee do we send up our sighs, mourning and weeping in this valley of tears.

Turn then, most gracious Advocate, thine eyes of mercy toward us; and after this our exile, show unto us the blessed fruit of thy womb, Jesus.

O clement, O loving, O sweet Virgin Mary.

V. Pray for us, O Holy Mother of God.
R. That we may be made worthy of the promises of Christ. <em>Amen.</em>`
  },
  closingPrayer: {
    type: "Closing Prayer",
    text: `O God, whose only-begotten Son, by His life, death, and resurrection, has purchased for us the rewards of eternal life; grant, we beseech Thee, that meditating upon these mysteries of the Most Holy Rosary of the Blessed Virgin Mary, we may imitate what they contain, and obtain what they promise. Through the same Christ Our Lord. <em>Amen.</em>`
  }
};

// Build the sequence of beads for the whole Rosary
function buildSequence(mysteries) {
  const seq = [];
  // Intro
  seq.push({ phase: 'intro', mysteryIdx: -1, type: 'apostlesCreed', prayer: PRAYERS.apostlesCreed });
  seq.push({ phase: 'intro', mysteryIdx: -1, type: 'ourFather', prayer: PRAYERS.ourFather });
  seq.push({ phase: 'intro', mysteryIdx: -1, type: 'hailMary', beadInDecade: 1, prayer: PRAYERS.hailMary('for faith'), label: 'For faith' });
  seq.push({ phase: 'intro', mysteryIdx: -1, type: 'hailMary', beadInDecade: 2, prayer: PRAYERS.hailMary('for hope'), label: 'For hope' });
  seq.push({ phase: 'intro', mysteryIdx: -1, type: 'hailMary', beadInDecade: 3, prayer: PRAYERS.hailMary('for charity'), label: 'For charity' });
  seq.push({ phase: 'intro', mysteryIdx: -1, type: 'gloryBe', prayer: PRAYERS.gloryBe });

  // Five decades
  for (let i = 0; i < 5; i++) {
    seq.push({ phase: 'decade', mysteryIdx: i, type: 'announce', prayer: { type: `${i+1}st Mystery`, text: mysteries[i].meditation } });
    seq.push({ phase: 'decade', mysteryIdx: i, type: 'ourFather', prayer: PRAYERS.ourFather });
    for (let b = 1; b <= 10; b++) {
      seq.push({ phase: 'decade', mysteryIdx: i, type: 'hailMary', beadInDecade: b, prayer: PRAYERS.hailMary() });
    }
    seq.push({ phase: 'decade', mysteryIdx: i, type: 'gloryBe', prayer: PRAYERS.gloryBe });
    seq.push({ phase: 'decade', mysteryIdx: i, type: 'fatima', prayer: PRAYERS.fatima });
  }

  // Closing
  seq.push({ phase: 'closing', mysteryIdx: -1, type: 'hailHolyQueen', prayer: PRAYERS.hailHolyQueen });
  seq.push({ phase: 'closing', mysteryIdx: -1, type: 'closing', prayer: PRAYERS.closingPrayer });
  return seq;
}

// ══════════════════════════════════════════
//  STATE
// ══════════════════════════════════════════
let currentSet = '<?= $defaultSet ?>';
let sequence = [];
let pos = 0;

// ══════════════════════════════════════════
//  INIT
// ══════════════════════════════════════════
(function init() {
  const days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  const dayName = days[new Date().getDay()];
  const setLabels = {
    joyful: 'Joyful', luminous: 'Luminous',
    sorrowful: 'Sorrowful', glorious: 'Glorious'
  };
  document.getElementById('today-badge').innerHTML =
    `Today is <strong>${dayName}</strong> — traditionally the <strong>${setLabels['<?= $defaultSet ?>']}</strong> Mysteries`;

  selectSet('<?= $defaultSet ?>');
})();

function selectSet(set) {
  currentSet = set;
  document.querySelectorAll('.mystery-btn').forEach(b => b.classList.remove('active'));
  document.querySelector(`[data-set="${set}"]`).classList.add('active');
}

function startRosary() {
  const data = MYSTERIES[currentSet];
  sequence = buildSequence(data.mysteries);
  pos = 0;
  document.getElementById('home').style.display = 'none';
  document.getElementById('prayer').style.display = 'flex';
  render();
}

function goHome() {
  document.getElementById('prayer').style.display = 'none';
  document.getElementById('complete').style.display = 'none';
  document.getElementById('home').style.display = 'block';
}

function nextBead() {
  if (pos < sequence.length - 1) {
    pos++;
    render();
  } else {
    showComplete();
  }
}

function prevBead() {
  if (pos > 0) { pos--; render(); }
}

function render() {
  const item = sequence[pos];
  const data = MYSTERIES[currentSet];
  const mystery = item.mysteryIdx >= 0 ? data.mysteries[item.mysteryIdx] : null;

  // Header
  document.getElementById('hdr-set').textContent = data.label;
  document.getElementById('hdr-mystery').textContent = mystery ? mystery.title : '—';
  document.getElementById('hdr-progress').textContent = `${pos+1} / ${sequence.length}`;

  // Art panel
  const panel = document.getElementById('art-panel');
  panel.className = `art-panel ${data.color}`;
  document.getElementById('art-scene').innerHTML = mystery ? mystery.art : getIntroArt(data.color);
  document.getElementById('art-title').textContent = mystery ? mystery.artCredit : '';

  // Mystery heading
  if (mystery) {
    const ordinals = ['First','Second','Third','Fourth','Fifth'];
    document.getElementById('mystery-num').textContent = ordinals[item.mysteryIdx] + ' Mystery';
    document.getElementById('mystery-title').textContent = mystery.title;
    document.getElementById('mystery-med').textContent = mystery.meditation;
  } else if (item.phase === 'intro') {
    document.getElementById('mystery-num').textContent = 'Opening Prayers';
    document.getElementById('mystery-title').textContent = 'The Rosary Begins';
    document.getElementById('mystery-med').textContent = 'Begin in faith, holding Our Lady's hand as she leads you to her Son.';
  } else {
    document.getElementById('mystery-num').textContent = 'Closing Prayers';
    document.getElementById('mystery-title').textContent = 'The Rosary Concludes';
    document.getElementById('mystery-med').textContent = '"The Rosary is the compendium of the entire Gospel." — Paul VI';
  }

  // Bead row for current decade
  renderBeads(item);

  // Prayer card
  const p = item.prayer;
  document.getElementById('prayer-type').textContent = p.type;
  document.getElementById('prayer-text').innerHTML = p.text;

  // Nav
  document.getElementById('prev-btn').disabled = (pos === 0);
  document.getElementById('next-btn').textContent = (pos === sequence.length - 1) ? 'Complete ✝' : 'Next →';

  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function getIntroArt() {
  return `<svg viewBox="0 0 200 180" xmlns="http://www.w3.org/2000/svg">
    <rect x="0" y="0" width="200" height="180" fill="#0a0810"/>
    <!-- Beads arc -->
    <path d="M40 160 Q100 30 160 160" fill="none" stroke="rgba(201,168,76,0.4)" stroke-width="1.5" stroke-dasharray="6,4"/>
    <circle cx="40" cy="160" r="6" fill="rgba(201,168,76,0.7)"/>
    <circle cx="55" cy="125" r="5" fill="rgba(201,168,76,0.6)"/>
    <circle cx="72" cy="96" r="5" fill="rgba(201,168,76,0.6)"/>
    <circle cx="100" cy="75" r="7" fill="rgba(201,168,76,0.9)"/>
    <circle cx="128" cy="96" r="5" fill="rgba(201,168,76,0.6)"/>
    <circle cx="145" cy="125" r="5" fill="rgba(201,168,76,0.6)"/>
    <circle cx="160" cy="160" r="6" fill="rgba(201,168,76,0.7)"/>
    <!-- Cross at bottom -->
    <rect x="96" y="162" width="8" height="16" fill="rgba(201,168,76,0.8)" rx="1"/>
    <rect x="90" y="166" width="20" height="6" fill="rgba(201,168,76,0.8)" rx="1"/>
    <!-- Rose -->
    <circle cx="100" cy="50" r="12" fill="rgba(180,30,60,0.2)" stroke="rgba(180,30,60,0.3)" stroke-width="1"/>
    <circle cx="100" cy="50" r="6" fill="rgba(180,30,60,0.3)"/>
    <!-- petals -->
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(0,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(45,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(90,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(135,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(180,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(225,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(270,100,50)"/>
    <ellipse cx="100" cy="40" rx="4" ry="6" fill="rgba(220,100,120,0.4)" transform="rotate(315,100,50)"/>
  </svg>`;
}

function renderBeads(item) {
  const row = document.getElementById('bead-row');
  const label = document.getElementById('decade-label');
  row.innerHTML = '';

  if (item.phase === 'intro' || item.phase === 'closing') {
    label.textContent = item.phase === 'intro' ? 'Opening' : 'Closing';
    // Show 6 small progress dots
    const phases = ['apostlesCreed','ourFather','hailMary','hailMary','hailMary','gloryBe'];
    if (item.phase === 'closing') {
      for (let i = 0; i < 2; i++) {
        const b = document.createElement('div');
        b.className = 'bead large' + (i === 0 && item.type === 'hailHolyQueen' ? ' current' : '') +
                      (item.type === 'closing' && i === 1 ? ' current' : '') +
                      (item.type === 'closing' && i === 0 ? ' done' : '');
        row.appendChild(b);
      }
      return;
    }
    const typeOrder = ['apostlesCreed','ourFather','hailMary','hailMary','hailMary','gloryBe'];
    typeOrder.forEach((t, i) => {
      const b = document.createElement('div');
      const isHailMary = t === 'hailMary';
      let isCurrent = false;
      let isDone = false;
      // Determine current and done
      const introItems = sequence.filter(s => s.phase === 'intro');
      const myIntroPos = introItems.indexOf(item);
      isDone = i < myIntroPos;
      isCurrent = i === myIntroPos;
      b.className = 'bead' + (!isHailMary ? ' large' : '') + (isDone ? ' done' : '') + (isCurrent ? ' current' : '');
      row.appendChild(b);
    });
    return;
  }

  // Decade beads
  const mysteryStart = sequence.findIndex(s => s.mysteryIdx === item.mysteryIdx && s.phase === 'decade');
  const myPosInDecade = pos - mysteryStart;

  const decadeItems = sequence.filter(s => s.mysteryIdx === item.mysteryIdx && s.phase === 'decade');
  const ordinals = ['1st','2nd','3rd','4th','5th'];
  label.textContent = `${ordinals[item.mysteryIdx]} Mystery — Decade ${item.mysteryIdx + 1}`;

  decadeItems.forEach((di, i) => {
    const b = document.createElement('div');
    const globalIdx = sequence.indexOf(di);
    const isDone = globalIdx < pos;
    const isCurrent = globalIdx === pos;
    const isLarge = di.type === 'announce' || di.type === 'ourFather' || di.type === 'gloryBe' || di.type === 'fatima';
    b.className = 'bead' + (isLarge ? ' large' : '') + (isDone ? ' done' : '') + (isCurrent ? ' current' : '');
    row.appendChild(b);
  });
}

function showComplete() {
  document.getElementById('prayer').style.display = 'none';
  const el = document.getElementById('complete');
  el.style.display = 'flex';
}
</script>

</body>
</html>