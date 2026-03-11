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

html {
  overflow-x: hidden;
  max-width: 100%;
}

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
  position: relative;
  width: 100%;
  max-width: 100%;
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
  width: 100%;
  margin: 0 auto;
  padding: 40px 20px 60px;
  position: relative; z-index: 1;
  overflow: hidden;
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
  overflow-wrap: break-word;
  word-break: break-word;
  width: 100%;
}

.art-credit a { color: var(--muted); display: inline; word-break: break-word; }

/* ─── PRAYER SCREEN ─── */
#prayer { display: none; min-height: 100vh; flex-direction: column; position: relative; z-index: 1; width: 100%; overflow-x: hidden; }

.prayer-header {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  background: rgba(15,12,26,0.8);
  backdrop-filter: blur(8px);
  border-bottom: 1px solid rgba(201,168,76,0.2);
  position: sticky; top: 0; z-index: 10;
}

.nav-hdr-btn {
  background: none;
  border: 1px solid rgba(201,168,76,0.4);
  border-radius: 8px;
  color: var(--gold);
  padding: 8px 14px;
  cursor: pointer;
  font-family: Georgia, serif;
  font-size: 0.9em;
  white-space: nowrap;
  flex-shrink: 0;
}

.nav-hdr-btn.primary {
  background: linear-gradient(135deg, #8a6a1c, var(--gold));
  border-color: transparent;
  color: #fff;
}

.nav-hdr-btn:disabled { opacity: 0.3; cursor: default; }

.header-mystery {
  flex: 1;
  text-align: center;
  min-width: 0;
}

.header-set { font-size: 0.7em; color: var(--gold); letter-spacing: 1px; text-transform: uppercase; }
.header-mystery-name { font-size: 0.85em; color: var(--text); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

/* ─── Art panel ─── */
.art-panel {
  width: 100%;
  height: 200px;
  position: relative;
  overflow: hidden;
  flex-shrink: 0;
  cursor: pointer;
}

.art-panel img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center top;
  display: block;
}

/* ─── Lightbox ─── */
#lightbox {
  display: none;
  position: fixed; inset: 0;
  z-index: 200;
  background: rgba(0,0,0,0.95);
  align-items: center;
  justify-content: center;
  cursor: zoom-out;
}

#lightbox img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

#lightbox-caption {
  position: absolute;
  bottom: 20px;
  left: 0; right: 0;
  text-align: center;
  font-size: 0.75em;
  color: rgba(240,234,216,0.7);
  font-style: italic;
  padding: 0 20px;
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
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

/* ─── SVG art pieces per mystery ─── */
.art-scene svg { max-height: 180px; width: auto; max-width: 100%; }

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
  max-width: 100%;
}

.bead {
  width: 28px; height: 28px;
  border-radius: 50%;
  border: 2px solid rgba(201,168,76,0.3);
  background: var(--panel);
  flex-shrink: 0;
  transition: all 0.3s;
  cursor: pointer;
}

.bead:hover {
  border-color: rgba(201,168,76,0.7);
  transform: scale(1.15);
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
  overflow-wrap: break-word;
  word-break: break-word;
}

.prayer-text em {
  color: var(--gold-light);
  font-style: normal;
}



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
    Mysteries accompanied by works of art chosen by Jon Aquino, inspired by his <a href="https://cooltoolsforcatholics.blogspot.com/2009/03/praying-rosary-with-great-works-of-art.html" target="_blank">"Praying the Rosary with Great Works of Art"</a> — Tiepolo, Giotto, Dürer, El Greco, Fra Angelico, Rembrandt, Botticelli, and more.
  </p>
</div>

<!-- ══════════════ PRAYER ══════════════ -->
<div id="prayer">
  <div class="prayer-header">
    <button class="nav-hdr-btn" id="hdr-prev-btn" onclick="prevSection()">← Back</button>
    <div class="header-mystery">
      <div class="header-set" id="hdr-set"></div>
      <div id="hdr-mystery"></div>
    </div>
    <button class="nav-hdr-btn primary" id="hdr-next-btn" onclick="nextSection()">Next →</button>
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


  </div>
</div>

<!-- ══════════════ LIGHTBOX ══════════════ -->
<div id="lightbox" onclick="closeLightbox()">
  <img id="lightbox-img" src="" alt="">
  <div id="lightbox-caption"></div>
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
        art: 'rosary-art/joyful-1-annunciation.jpg',
        artCredit: 'After Tiepolo, "The Annunciation" (1726) — Pen and brown ink'
      },
      {
        title: 'The Visitation',
        meditation: 'Mary visits her cousin Elizabeth, who cries out, "Blessed are you among women, and blessed is the fruit of your womb!"',
        art: 'rosary-art/joyful-2-visitation.jpg',
        artCredit: 'After Giotto, "The Visitation" (c.1305) — Fresco, Scrovegni Chapel'
      },
      {
        title: 'The Nativity',
        meditation: 'Jesus is born in Bethlehem. Mary wraps Him in swaddling clothes and lays Him in a manger. Angels fill the night sky with song.',
        art: 'rosary-art/joyful-3-nativity.jpg',
        artCredit: 'After Giotto, "The Nativity" (1304–06) — Fresco, Scrovegni Chapel'
      },
      {
        title: 'The Presentation',
        meditation: 'Mary and Joseph present the infant Jesus at the Temple. Simeon holds Him and prophesies, "My eyes have seen your salvation."',
        art: 'rosary-art/joyful-4-presentation.jpg',
        artCredit: 'After Rublev, "Presentation in the Temple" (1405) — Tempera on wood'
      },
      {
        title: 'Finding Jesus in the Temple',
        meditation: 'After three days of searching, Mary and Joseph find the twelve-year-old Jesus in the Temple, sitting among the teachers, listening and asking questions.',
        art: 'rosary-art/joyful-5-doctors.jpg',
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
        meditation: 'Jesus is baptised by John in the River Jordan. The Holy Spirit descends as a dove, and the Father\'s voice is heard: "This is my beloved Son."',
        art: 'rosary-art/luminous-1-baptism.jpg',
        artCredit: 'After El Greco, "The Baptism of Jesus" (1608) — Oil on canvas'
      },
      {
        title: 'The Wedding at Cana',
        meditation: 'At Mary\'s prompting, Jesus performs His first miracle at a wedding feast, turning water into wine — and His disciples believe in Him.',
        art: 'rosary-art/luminous-2-cana.jpg',
        artCredit: 'After Master of the Catholic Kings, "The Marriage at Cana" (1495)'
      },
      {
        title: 'Proclamation of the Kingdom',
        meditation: 'Jesus goes throughout Galilee preaching the Good News of the Kingdom of God, calling all people to repentance and faith.',
        art: 'rosary-art/luminous-3-preaching.jpg',
        artCredit: 'After Rembrandt, "Jesus Preaching (La Tombe)" (1652) — Etching'
      },
      {
        title: 'The Transfiguration',
        meditation: 'On Mount Tabor, Jesus is transfigured before Peter, James, and John. His face shines like the sun, and Moses and Elijah appear beside him.',
        art: 'rosary-art/luminous-4-transfig.jpg',
        artCredit: 'After Fra Angelico, "The Transfiguration" (1439–43) — Fresco, San Marco'
      },
      {
        title: 'Institution of the Eucharist',
        meditation: 'At the Last Supper, Jesus takes bread and wine, gives thanks, and says, "This is my body… This is my blood." He commands, "Do this in memory of me."',
        art: 'rosary-art/luminous-5-eucharist.jpg',
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
        art: 'rosary-art/sorrowful-1-agony.jpg',
        artCredit: 'After Botticelli, "Agony in the Garden" (c.1500) — Tempera on panel'
      },
      {
        title: 'The Scourging at the Pillar',
        meditation: 'Jesus is bound to a pillar and brutally scourged. He bears our infirmities and is wounded for our transgressions.',
        art: 'rosary-art/sorrowful-2-flagellation.jpg',
        artCredit: 'After Duccio, "Flagellation" (1308–11) — Tempera on wood'
      },
      {
        title: 'Crowning with Thorns',
        meditation: 'Soldiers mock Jesus as "King of the Jews," weaving a crown of thorns and pressing it onto His head. They strike and spit upon Him.',
        art: 'rosary-art/sorrowful-3-crowning.jpg',
        artCredit: 'After Bosch, "Christ Mocked" (c.1495–1500) — Oil on wood'
      },
      {
        title: 'Carrying of the Cross',
        meditation: 'Jesus carries the heavy Cross through the streets of Jerusalem toward Calvary, falling three times yet rising again in love for us.',
        art: 'rosary-art/sorrowful-4-carrying.jpg',
        artCredit: 'Inspired by El Greco, "Christ Carrying the Cross" — Oil on canvas'
      },
      {
        title: 'The Crucifixion',
        meditation: '"Father, forgive them, for they know not what they do." Jesus gives His life for the sins of the world. Mary stands at the foot of the Cross.',
        art: 'rosary-art/sorrowful-5-crucifixion.jpg',
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
        art: 'rosary-art/glorious-1-resurrection.jpg',
        artCredit: 'Inspired by Piero della Francesca, "The Resurrection" (c.1460)'
      },
      {
        title: 'The Ascension',
        meditation: 'Forty days after Easter, Jesus ascends to heaven before the eyes of His disciples. "And I will be with you always, to the end of the age."',
        art: 'rosary-art/glorious-2-ascension.jpg',
        artCredit: 'Inspired by Andrea Mantegna, "The Ascension" (c.1460) — Tempera'
      },
      {
        title: 'Descent of the Holy Spirit',
        meditation: 'On Pentecost, the Holy Spirit descends on the Apostles and Mary as tongues of fire, filling them with courage to proclaim the Gospel to all nations.',
        art: 'rosary-art/glorious-3-pentecost.jpg',
        artCredit: 'Inspired by El Greco, "Pentecost" (c.1600) — Oil on canvas'
      },
      {
        title: 'The Assumption of Mary',
        meditation: 'At the end of her earthly life, the Virgin Mary is taken up body and soul into heavenly glory — as befits the Mother of the Lord.',
        art: 'rosary-art/glorious-4-assumption.jpg',
        artCredit: 'Inspired by Titian, "The Assumption of the Virgin" (1516–18)'
      },
      {
        title: 'Coronation of Mary',
        meditation: 'The Virgin Mary, taken into heaven, is crowned Queen of Heaven and Earth by the Blessed Trinity — interceding for us, her children.',
        art: 'rosary-art/glorious-5-coronation.jpg',
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
let currentArtSrc = null;
let currentArtCaption = '';
let lastRenderedMysteryIdx = -99;

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

function getSectionAnchors() {
  const anchors = [0];
  for (let i = 0; i < 5; i++) {
    const idx = sequence.findIndex(s => s.mysteryIdx === i && s.phase === 'decade');
    if (idx >= 0) anchors.push(idx);
  }
  const closingIdx = sequence.findIndex(s => s.phase === 'closing');
  if (closingIdx >= 0) anchors.push(closingIdx);
  return anchors;
}

function nextSection() {
  const anchors = getSectionAnchors();
  const next = anchors.find(a => a > pos);
  if (next !== undefined) {
    pos = next;
    render();
  } else {
    showComplete();
  }
}

function prevSection() {
  const anchors = getSectionAnchors();
  const prev = [...anchors].reverse().find(a => a < pos);
  if (prev !== undefined) {
    pos = prev;
    render();
  } else {
    goHome();
  }
}

function render() {
  const item = sequence[pos];
  const data = MYSTERIES[currentSet];
  const mystery = item.mysteryIdx >= 0 ? data.mysteries[item.mysteryIdx] : null;

  // Header
  document.getElementById('hdr-set').textContent = data.label;
  document.getElementById('hdr-mystery').textContent = mystery ? mystery.title : '—';

  // Art panel — only re-render when mystery changes
  const panel = document.getElementById('art-panel');
  const mysteryIdx = item.mysteryIdx;
  if (mysteryIdx !== lastRenderedMysteryIdx) {
    lastRenderedMysteryIdx = mysteryIdx;
    panel.className = `art-panel ${data.color}`;
    if (mystery && mystery.art) {
      currentArtSrc = mystery.art;
      currentArtCaption = mystery.artCredit;
      document.getElementById('art-scene').innerHTML = `<img src="${mystery.art}" alt="${mystery.title}" loading="lazy">`;
      document.getElementById('art-title').textContent = mystery.artCredit;
      panel.style.cursor = 'zoom-in';
      panel.onclick = () => openLightbox(currentArtSrc, currentArtCaption);
    } else {
      currentArtSrc = null;
      document.getElementById('art-scene').innerHTML = getIntroArt(data.color);
      document.getElementById('art-title').textContent = '';
      panel.style.cursor = 'default';
      panel.onclick = null;
    }
  }

  // Mystery heading
  if (mystery) {
    const ordinals = ['First','Second','Third','Fourth','Fifth'];
    document.getElementById('mystery-num').textContent = ordinals[item.mysteryIdx] + ' Mystery';
    document.getElementById('mystery-title').textContent = mystery.title;
    document.getElementById('mystery-med').textContent = mystery.meditation;
  } else if (item.phase === 'intro') {
    document.getElementById('mystery-num').textContent = 'Opening Prayers';
    document.getElementById('mystery-title').textContent = 'The Rosary Begins';
    document.getElementById('mystery-med').textContent = 'Begin in faith, holding Our Lady\'s hand as she leads you to her Son.';
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
  const anchors = getSectionAnchors();
  const hasNext = anchors.some(a => a > pos);
  document.getElementById('hdr-prev-btn').disabled = false;
  document.getElementById('hdr-prev-btn').textContent = '← Back';
  document.getElementById('hdr-next-btn').textContent = hasNext ? 'Next →' : 'Done ✝';

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
        b.onclick = nextBead;
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
      b.onclick = nextBead;
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
    b.onclick = nextBead;
    row.appendChild(b);
  });
}

function openLightbox(src, caption) {
  document.getElementById('lightbox-img').src = src;
  document.getElementById('lightbox-caption').textContent = caption;
  const lb = document.getElementById('lightbox');
  lb.style.display = 'flex';
}

function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
}

function showComplete() {
  document.getElementById('prayer').style.display = 'none';
  const el = document.getElementById('complete');
  el.style.display = 'flex';
}
</script>

</body>
</html>