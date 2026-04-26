<?php
// Make Your Own Adventure — a collaborative-style CYOA player + writer
// Inspired by Jon's 2006 post "Make Your Own Adventure--a collaborative novel I've started"
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Make Your Own Adventure</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IM+Fell+English:ital@0;1&family=Special+Elite&family=Cormorant+Garamond:ital,wght@0,500;0,700;1,500&display=swap" rel="stylesheet">
<style>
:root{
  --paper:#ecdcb6;
  --paper-2:#e2cf9e;
  --ink:#2a1d0e;
  --ink-soft:#5a4326;
  --stamp:#a4321b;
  --stamp-2:#7a2412;
  --rule:#7a5a2c;
  --gold:#9a7a2e;
}
*,*::before,*::after{box-sizing:border-box}
html,body{margin:0;padding:0}
body{
  font-family:'Cormorant Garamond', Georgia, serif;
  font-size:19px;
  line-height:1.6;
  color:var(--ink);
  background:
    radial-gradient(120% 80% at 20% 0%, #f3e3bb 0%, transparent 60%),
    radial-gradient(120% 80% at 90% 100%, #d8c08a 0%, transparent 55%),
    repeating-linear-gradient(0deg, rgba(80,50,10,.04) 0 1px, transparent 1px 4px),
    var(--paper);
  min-height:100vh;
  padding:28px 16px 80px;
  position:relative;
  overflow-x:hidden;
}
body::before{
  content:"";
  position:fixed; inset:0;
  pointer-events:none;
  background-image:
    radial-gradient(rgba(60,40,10,.18) 1px, transparent 1px),
    radial-gradient(rgba(60,40,10,.10) 1px, transparent 1px);
  background-size: 3px 3px, 7px 7px;
  background-position: 0 0, 1px 2px;
  mix-blend-mode:multiply;
  opacity:.45;
  z-index:0;
}
.wrap{
  max-width: 720px;
  margin: 0 auto;
  position:relative;
  z-index:1;
}

/* Cover-style header */
header.cover{
  border:2px double var(--ink);
  padding: 28px 22px 22px;
  text-align:center;
  background:
    repeating-linear-gradient(45deg, rgba(122,90,44,.05) 0 8px, transparent 8px 16px),
    linear-gradient(180deg, rgba(255,240,200,.4), rgba(216,192,138,.2));
  box-shadow: 0 1px 0 #fff7dc inset, 0 8px 28px rgba(60,40,10,.18);
  position:relative;
}
header.cover::after{
  content:"";
  position:absolute; inset:6px;
  border:1px solid var(--rule);
  pointer-events:none;
}
.eyebrow{
  font-family:'Special Elite', monospace;
  font-size:.72em;
  letter-spacing:.4em;
  text-transform:uppercase;
  color:var(--ink-soft);
}
h1{
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-weight:400;
  font-size: clamp(2.2rem, 7vw, 3.4rem);
  margin: 6px 0 4px;
  line-height:1.05;
  text-shadow: 1px 1px 0 rgba(255,240,200,.6);
}
h1 .amp{
  font-style:italic;
  color:var(--stamp);
}
.subtitle{
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-size:1.05em;
  color:var(--ink-soft);
  margin: 4px 0 14px;
}
.stamp{
  display:inline-block;
  font-family:'Special Elite', monospace;
  letter-spacing:.18em;
  text-transform:uppercase;
  border:2px solid var(--stamp);
  color:var(--stamp);
  padding:6px 12px;
  transform: rotate(-4deg);
  background: rgba(255,240,200,.3);
  font-size:.7em;
  box-shadow: 0 0 0 2px rgba(164,50,27,.06);
  margin-top:6px;
}

/* Library list */
.library{
  margin-top: 22px;
  padding: 14px 6px 4px;
}
.library h2{
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-size:1.4em;
  margin:0 0 10px;
  text-align:center;
  color:var(--ink-soft);
}
.shelf{
  display:grid;
  gap:14px;
}
.book{
  display:flex;
  align-items:flex-start;
  gap:14px;
  padding:14px 14px;
  border:1px solid var(--rule);
  background:
    linear-gradient(180deg, rgba(255,240,200,.35), rgba(216,192,138,.15));
  cursor:pointer;
  transition: transform .15s ease, box-shadow .15s ease;
  text-align:left;
  width:100%;
  font: inherit;
  color: inherit;
}
.book:hover{ transform: translateY(-1px); box-shadow: 0 6px 14px rgba(60,40,10,.18); }
.book:focus-visible{ outline: 2px dashed var(--stamp); outline-offset: 3px; }
.book .spine{
  width:38px; min-width:38px; height:56px;
  background:
    repeating-linear-gradient(0deg, rgba(0,0,0,.05) 0 2px, transparent 2px 6px),
    linear-gradient(180deg, var(--c1, #6d2a1a), var(--c2, #3a160c));
  border:1px solid #2a1208;
  border-radius:2px;
  position:relative;
  box-shadow: 1px 1px 0 #fff7dc inset;
}
.book .spine::after{
  content:"";
  position:absolute; left:6px; right:6px; top:8px; bottom:8px;
  border:1px solid rgba(255,235,180,.35);
}
.book .meta .t{
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-size:1.25em;
  line-height:1.15;
  color:var(--ink);
}
.book .meta .by{
  font-family:'Special Elite', monospace;
  font-size:.7em;
  letter-spacing:.18em;
  text-transform:uppercase;
  color:var(--ink-soft);
  margin-top:4px;
}
.book .meta .blurb{
  margin-top:6px;
  font-size:.95em;
  color:var(--ink);
}

/* Reader */
.reader{
  display:none;
  margin-top:18px;
  padding: 24px 22px 22px;
  border:1px solid var(--ink);
  position:relative;
  background:
    repeating-linear-gradient(0deg, rgba(80,50,10,.04) 0 1px, transparent 1px 28px),
    linear-gradient(180deg, rgba(255,245,210,.35), rgba(216,192,138,.05));
  box-shadow: 0 12px 28px rgba(60,40,10,.18);
}
.reader.active{ display:block; }
.reader::before{
  content:"";
  position:absolute; left:14px; right:14px; top:8px; bottom:8px;
  border:1px solid var(--rule);
  pointer-events:none;
}
.page-head{
  display:flex; align-items:baseline; justify-content:space-between;
  gap:10px; flex-wrap:wrap;
  border-bottom:1px solid var(--rule);
  padding-bottom:6px; margin-bottom:14px;
}
.page-head .num{
  font-family:'Special Elite', monospace;
  font-size:.78em;
  letter-spacing:.2em;
  text-transform:uppercase;
  color:var(--ink-soft);
}
.page-head .title{
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-size:1.45em;
}
.passage{
  font-size:1.05em;
  white-space:pre-wrap;
}
.passage .dropcap::first-letter{
  font-family:'IM Fell English', serif;
  font-size:3.2em;
  float:left;
  line-height:.85;
  padding: 4px 8px 0 0;
  color:var(--stamp);
}
.choices{
  margin-top:18px;
  display:grid;
  gap:10px;
}
.choice{
  display:block;
  width:100%;
  text-align:left;
  background: rgba(255,245,210,.45);
  border:1px solid var(--ink-soft);
  padding:12px 14px 12px 38px;
  font: inherit;
  color: var(--ink);
  font-size:1em;
  position:relative;
  cursor:pointer;
  transition: background .15s ease, transform .1s ease;
}
.choice::before{
  content:"➜";
  position:absolute; left:12px; top:50%; transform: translateY(-50%);
  color:var(--stamp);
  font-size:1.2em;
}
.choice:hover{ background: rgba(164,50,27,.08); }
.choice:active{ transform: translateY(1px); }
.choice .turn{
  display:block;
  font-family:'Special Elite', monospace;
  font-size:.7em;
  letter-spacing:.2em;
  text-transform:uppercase;
  color:var(--ink-soft);
  margin-top:4px;
}

/* Ending */
.ending{
  text-align:center;
  margin: 18px 0 6px;
  padding: 14px;
  border:2px double var(--stamp);
  color:var(--stamp);
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-size:1.3em;
  background: rgba(255,235,180,.4);
}

/* Toolbar */
.toolbar{
  margin-top:14px;
  display:flex; gap:8px; flex-wrap:wrap; justify-content:space-between;
}
.btn{
  font-family:'Special Elite', monospace;
  font-size:.78em;
  letter-spacing:.18em;
  text-transform:uppercase;
  background: transparent;
  border:1px solid var(--ink);
  color:var(--ink);
  padding:8px 12px;
  cursor:pointer;
  transition: background .15s ease, color .15s ease;
}
.btn:hover{ background:var(--ink); color:var(--paper); }
.btn.primary{
  background:var(--stamp);
  color:#fff5d8;
  border-color:var(--stamp-2);
}
.btn.primary:hover{ background:var(--stamp-2); }
.btn.ghost{ border-style:dashed; }

/* Breadcrumb / path */
.path{
  margin-top:12px;
  font-family:'Special Elite', monospace;
  font-size:.72em;
  letter-spacing:.16em;
  text-transform:uppercase;
  color:var(--ink-soft);
  word-break:break-word;
}
.path span{ opacity:.7 }
.path b{ color:var(--stamp); font-weight:normal }

/* Editor */
.editor{
  margin-top:22px;
  border:1px dashed var(--ink-soft);
  padding:18px;
  background: rgba(255,245,210,.3);
  display:none;
}
.editor.active{ display:block; }
.editor h3{
  font-family:'IM Fell English', serif;
  font-style:italic;
  font-weight:400;
  margin:0 0 10px;
  font-size:1.3em;
}
.editor label{
  display:block;
  font-family:'Special Elite', monospace;
  font-size:.72em;
  letter-spacing:.16em;
  text-transform:uppercase;
  color:var(--ink-soft);
  margin: 10px 0 4px;
}
.editor input, .editor textarea{
  width:100%;
  background: rgba(255,250,225,.7);
  border:1px solid var(--rule);
  font: inherit;
  color: var(--ink);
  padding:8px 10px;
  font-size:1em;
}
.editor textarea{ min-height: 110px; resize: vertical; }
.choice-row{
  display:grid;
  grid-template-columns: 1fr 130px 32px;
  gap:6px;
  margin-bottom:6px;
}
.choice-row input.target{ font-family:'Special Elite', monospace; font-size:.85em; }
.choice-row .x{
  border:1px solid var(--rule); background:transparent;
  font: inherit; cursor:pointer; color:var(--stamp);
}
.editor .row{ display:flex; gap:8px; flex-wrap:wrap; margin-top:12px; }

/* Footer note */
.footnote{
  margin-top: 36px;
  text-align:center;
  font-size:.85em;
  font-style:italic;
  color: var(--ink-soft);
}
.footnote a{ color: var(--stamp); }

/* Page-turn animation */
@keyframes flip {
  0%{ transform: rotateX(0); opacity:1 }
  50%{ transform: rotateX(-22deg); opacity:.4 }
  100%{ transform: rotateX(0); opacity:1 }
}
.flip{ animation: flip .55s ease; transform-origin: top center; }

@media (max-width: 480px){
  body{ font-size:18px; }
  .choice-row{ grid-template-columns: 1fr 100px 32px; }
}
</style>
</head>
<body>
<div class="wrap">
  <header class="cover">
    <div class="eyebrow">A Collaborative Novel · Vol. I</div>
    <h1>Make Your Own <span class="amp">Adventure</span></h1>
    <div class="subtitle">In which the Reader becomes the Author, and the Path is forged by Choice.</div>
    <div class="stamp">Pick a path · Or write one</div>
  </header>

  <section class="library" id="library">
    <h2>~ The Shelf ~</h2>
    <div class="shelf" id="shelf"></div>
  </section>

  <section class="reader" id="reader" aria-live="polite">
    <div class="page-head">
      <div class="num" id="pageNum">Page —</div>
      <div class="title" id="pageTitle">…</div>
    </div>
    <div class="passage dropcap" id="passage"></div>
    <div class="choices" id="choices"></div>
    <div class="path" id="path"></div>
    <div class="toolbar">
      <button class="btn ghost" id="backBtn">◂ Back</button>
      <button class="btn ghost" id="restartBtn">↺ Restart</button>
      <button class="btn" id="addPageBtn">＋ Write a page</button>
      <button class="btn primary" id="closeBtn">Close book</button>
    </div>
  </section>

  <section class="editor" id="editor">
    <h3>Add a page to this adventure</h3>
    <p style="margin:0 0 6px;font-size:.95em;color:var(--ink-soft)">
      You're branching from page <b id="branchFrom" style="color:var(--stamp)">—</b>.
      Give it an ID (short, lowercase, like <code>cave_drip</code>), a title, and the prose.
      Add a few choices that lead to other page IDs (existing or new).
    </p>
    <label for="pid">Page ID</label>
    <input id="pid" placeholder="cave_drip">
    <label for="ptitle">Title</label>
    <input id="ptitle" placeholder="A Strange Drip in the Cave">
    <label for="ptext">Passage</label>
    <textarea id="ptext" placeholder="Write what happens here..."></textarea>
    <label>Choices (label → page id)</label>
    <div id="choiceRows"></div>
    <button class="btn ghost" id="addChoiceRow" type="button">+ Add choice</button>
    <div class="row">
      <button class="btn primary" id="savePage">Save page</button>
      <button class="btn" id="cancelPage">Cancel</button>
      <button class="btn ghost" id="exportBook" title="Copy this book's JSON to clipboard">Export book</button>
    </div>
  </section>

  <p class="footnote">
    Inspired by Jon's 2006 post,
    <a href="https://jona.ca/2006/09/make-your-own-adventure-collaborative.html">Make Your Own Adventure — a collaborative novel I've started</a>.
    Your additions are saved on this device only. ✒︎
  </p>
</div>

<script>
// ---------- Built-in adventures ----------
const BOOKS = {
  knight_road: {
    title: "The Knight on the Long Road",
    by: "For Nathan & K.I.T.T.",
    blurb: "A black Trans Am, a midnight highway, and a voice in the dash.",
    spine: ["#1a1a1c","#0a0a0c"],
    start: "start",
    pages: {
      start: {
        title: "Highway 1, 11:47 PM",
        text: "The desert wind hisses past your window. K.I.T.T.'s scanner sweeps red across the dash like a slow heartbeat.\n\n\"Michael,\" the car says, calm as ever, \"I'm picking up a distress signal — two miles ahead. And, less politely, a convoy approaching from behind at considerable speed.\"\n\nYour fingers tighten on the wheel.",
        choices: [
          {label: "Floor it toward the distress signal.", to: "distress"},
          {label: "Pull off into the canyon and watch the convoy pass.", to: "canyon"},
          {label: "Ask K.I.T.T. to scan the convoy.", to: "scan"}
        ]
      },
      distress: {
        title: "Turbo Boost",
        text: "\"Engaging Turbo Boost,\" K.I.T.T. announces. The road tilts. The stars smear. You land in a cloud of dust beside an overturned camper. A woman waves frantically — and behind her, a briefcase glints in the moonlight.",
        choices: [
          {label: "Help the woman first.", to: "help_woman"},
          {label: "Grab the briefcase.", to: "briefcase"}
        ]
      },
      canyon: {
        title: "Among the Cottonwoods",
        text: "You kill the lights. K.I.T.T. dims. Three black SUVs roar past, then a fourth — slower, scanning. The fourth one stops. A door opens.",
        choices: [
          {label: "Hold your breath and stay still.", to: "still"},
          {label: "Engage Silent Mode and slip away.", to: "silent"}
        ]
      },
      scan: {
        text: "\"Four vehicles,\" K.I.T.T. reports. \"Armored. The lead driver's pulse is elevated — fear, not aggression. They're running from something.\"\n\nA pause.\n\n\"Michael, the distress signal is theirs.\"",
        title: "Pulse, Not Pursuit",
        choices: [
          {label: "Turn around and intercept the convoy as a friend.", to: "intercept"},
          {label: "Continue toward the original signal anyway.", to: "distress"}
        ]
      },
      help_woman: {
        title: "The Right Choice",
        text: "You pull her free just as the camper coughs flame. She presses something into your hand — a small key, warm from her palm. \"They'll come for this,\" she says. \"Don't let them.\"\n\nK.I.T.T. purrs the door open. \"Time to leave, Michael.\"",
        choices: [
          {label: "Drive her to the safe house.", to: "ending_hero"}
        ]
      },
      briefcase: {
        title: "Heavy in the Hand",
        text: "The briefcase is locked. The woman is gone. Headlights crest the ridge.",
        choices: [
          {label: "Run for the car.", to: "ending_close"}
        ]
      },
      still: {
        title: "Still as Stone",
        text: "Boots crunch. A flashlight beam glides past your bumper and away. The SUV rolls on. You exhale a year.",
        choices: [
          {label: "Now follow them — quietly.", to: "intercept"}
        ]
      },
      silent: {
        title: "Silent Mode",
        text: "K.I.T.T.'s engine softens to a whisper. You ghost out the back of the canyon and onto a service road only the coyotes know.",
        choices: [
          {label: "Loop back to the distress signal.", to: "distress"}
        ]
      },
      intercept: {
        title: "Headlights, Friend",
        text: "You pull alongside. The lead driver — a kid, maybe sixteen — sees the scanner sweep and bursts into tears of relief. \"They said no one was coming.\"\n\n\"Someone always does,\" you say.",
        choices: [
          {label: "Lead them to safety.", to: "ending_hero"}
        ]
      },
      ending_hero: {
        title: "— THE END —",
        text: "Dawn finds you at the safe house, K.I.T.T. ticking softly as he cools. The woman sleeps. The kid eats cereal. The key is in a drawer no one but you knows about.\n\n\"A good night's work, Michael.\"\n\nYou smile. \"A good night.\"",
        choices: [],
        ending: "Ending: The Long Road Home"
      },
      ending_close: {
        title: "— THE END —",
        text: "K.I.T.T. takes the wheel. Turbo Boost. The briefcase rattles in the passenger seat. You don't know what's in it yet.\n\nBut tomorrow, you will.",
        choices: [],
        ending: "Ending: To Be Continued…"
      }
    }
  },

  hyrule_dusk: {
    title: "Dusk in the Lost Woods",
    by: "A Hylian Tale",
    blurb: "Trees that whisper, a flute on the wind, and a fork in the path.",
    spine: ["#2e5d3a","#13301c"],
    start: "start",
    pages: {
      start: {
        title: "At the edge of the Lost Woods",
        text: "The ocarina in your pocket hums of its own accord. Somewhere deeper in the trees, a flute answers it — three notes, slow.\n\nA fox sits on the path. It does not move.",
        choices: [
          {label: "Play the ocarina back.", to: "play"},
          {label: "Follow the fox off the path.", to: "fox"},
          {label: "Push deeper toward the flute.", to: "flute"}
        ]
      },
      play: {
        title: "Three notes, then four",
        text: "You answer with four notes. The fox tilts its head. The trees lean inward, listening. A path you didn't see opens beside the oldest stump.",
        choices: [
          {label: "Take the new path.", to: "stump_path"},
          {label: "Stay and play one more song.", to: "song_more"}
        ]
      },
      fox: {
        title: "Off the path",
        text: "Moss eats your footprints. The fox flicks its tail and is gone. A stone lantern blinks on, then another, then a row of them — leading down.",
        choices: [
          {label: "Follow the lanterns.", to: "lanterns"},
          {label: "Turn back while you still can.", to: "start"}
        ]
      },
      flute: {
        title: "The flute-player",
        text: "You find a Skull Kid sitting on a root, flute in lap. He doesn't look up. \"You came,\" he says. \"That makes one of us.\"",
        choices: [
          {label: "Sit beside him.", to: "sit"},
          {label: "Ask what he's running from.", to: "ask"}
        ]
      },
      stump_path: {
        title: "The stump's secret",
        text: "Beneath the stump: a small chest, lichen-bound. Inside, a Piece of Heart and a folded note in a child's hand. \"For whoever listens.\"",
        choices: [{label:"Carry them home.", to: "ending_heart"}]
      },
      song_more: {
        title: "One more song",
        text: "The forest hums along. When you stop, every leaf is glowing faintly, and you are no longer tired.",
        choices: [{label:"Walk on, lighter.", to: "ending_heart"}]
      },
      lanterns: {
        title: "Lantern road",
        text: "The lanterns end at a still pond. In the reflection, you are wearing a green tunic you do not own. The reflection waves first.",
        choices: [{label:"Wave back.", to: "ending_mirror"}]
      },
      sit: {
        title: "Two on a root",
        text: "You sit. He plays. You play. The woods quiet themselves to listen, and somewhere far away, a friend you forgot remembers your name.",
        choices: [{label:"Stay until dusk.", to: "ending_friend"}]
      },
      ask: {
        title: "Running",
        text: "\"From the part of me that grew up,\" he says, and laughs like a bell that's been left in the rain.",
        choices: [{label:"Tell him it isn't so bad.", to: "ending_friend"}]
      },
      ending_heart: { title:"— FIN —", text:"You return to Kakariko at dawn, pockets heavier and heart lighter.", choices:[], ending:"Ending: A Piece of Heart" },
      ending_mirror: { title:"— FIN —", text:"Sometimes the hero you're looking for waves first.", choices:[], ending:"Ending: The Mirror Pond" },
      ending_friend: { title:"— FIN —", text:"You walk out of the woods together. Neither of you is lost anymore.", choices:[], ending:"Ending: Two Friends, One Flute" }
    }
  },

  monastery_door: {
    title: "The Door at the End of the Cloister",
    by: "A Quiet Adventure",
    blurb: "Bells, a candle, and a question the saints leave for you.",
    spine: ["#3a2a55","#1a1230"],
    start: "start",
    pages: {
      start: {
        title: "Compline has ended",
        text: "The last bell fades. The cloister is empty except for one candle burning in a niche it shouldn't be in.\n\nAt the end of the corridor, a door you have never noticed stands slightly open.",
        choices: [
          {label: "Take the candle.", to: "candle"},
          {label: "Leave the candle and approach the door.", to: "door"},
          {label: "Kneel for a moment first.", to: "kneel"}
        ]
      },
      candle: {
        title: "A small light",
        text: "The candle is heavier than it should be. As you turn toward the door, the flame leans — not from a draft. From the door itself.",
        choices: [{label:"Walk on.", to:"door"}]
      },
      kneel: {
        title: "A moment",
        text: "You kneel. The stone is cold. After a while you notice the silence is not empty; it is full of something — patient, attentive, fond.",
        choices: [
          {label:"Stand and approach the door.", to:"door"},
          {label:"Stay a little longer.", to:"ending_stay"}
        ]
      },
      door: {
        title: "The door",
        text: "It opens onto a small garden you have never seen, though you have walked this cloister for years.\n\nA figure waits on a bench, back to you. They do not turn.\n\n\"Who do you say that I am?\" they ask.",
        choices: [
          {label:"\"You are the Christ.\"", to:"answer_peter"},
          {label:"\"I'm not sure yet.\"", to:"answer_unsure"},
          {label:"Sit beside them and say nothing.", to:"answer_silent"}
        ]
      },
      answer_peter: { title:"— AMEN —", text:"They turn. They are smiling. \"Then come,\" they say. The garden, you realize, is much larger than the monastery.", choices:[], ending:"Ending: The Confession" },
      answer_unsure:{ title:"— AMEN —", text:"\"That is honest,\" they say. \"Sit. We have time.\" And, somehow, you do.", choices:[], ending:"Ending: An Honest Beginning" },
      answer_silent:{ title:"— AMEN —", text:"You sit. After a long while their hand rests on your shoulder, light as a moth, heavy as a vow.", choices:[], ending:"Ending: The Quiet Yes" },
      ending_stay:  { title:"— AMEN —", text:"The candle burns down. The door, you think, will still be there tomorrow.", choices:[], ending:"Ending: Vigil" }
    }
  }
};

// ---------- State ----------
const STORAGE_KEY = "myoa_state_v1";
function loadState(){
  try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {custom:{}, history:{}}; }
  catch(e){ return {custom:{}, history:{}}; }
}
function saveState(s){ localStorage.setItem(STORAGE_KEY, JSON.stringify(s)); }
let state = loadState();

// merged book = built-in pages + custom pages user added
function getBook(id){
  const base = BOOKS[id];
  if(!base) return null;
  const customPages = (state.custom[id] && state.custom[id].pages) || {};
  return {
    ...base,
    pages: { ...base.pages, ...customPages }
  };
}

let current = { bookId: null, pageId: null, history: [] };

// ---------- Library render ----------
const shelf = document.getElementById('shelf');
function renderShelf(){
  shelf.innerHTML = "";
  Object.entries(BOOKS).forEach(([id, b]) => {
    const btn = document.createElement('button');
    btn.className = "book";
    btn.style.setProperty('--c1', b.spine[0]);
    btn.style.setProperty('--c2', b.spine[1]);
    btn.innerHTML = `
      <div class="spine"></div>
      <div class="meta">
        <div class="t">${escapeHtml(b.title)}</div>
        <div class="by">${escapeHtml(b.by)}</div>
        <div class="blurb">${escapeHtml(b.blurb)}</div>
      </div>`;
    btn.addEventListener('click', () => openBook(id));
    shelf.appendChild(btn);
  });
}

// ---------- Reader ----------
const reader = document.getElementById('reader');
const passageEl = document.getElementById('passage');
const choicesEl = document.getElementById('choices');
const pageNumEl = document.getElementById('pageNum');
const pageTitleEl = document.getElementById('pageTitle');
const pathEl = document.getElementById('path');

function openBook(id){
  current = { bookId:id, pageId: getBook(id).start, history: [] };
  reader.classList.add('active');
  document.getElementById('library').style.display = 'none';
  renderPage();
  reader.scrollIntoView({behavior:'smooth', block:'start'});
}

function go(toId){
  current.history.push(current.pageId);
  current.pageId = toId;
  renderPage(true);
}

function back(){
  if(current.history.length === 0) return;
  current.pageId = current.history.pop();
  renderPage(true);
}

function renderPage(animate){
  const book = getBook(current.bookId);
  const page = book.pages[current.pageId];
  if(!page){
    passageEl.textContent = `(This path leads to a page that hasn't been written yet: "${current.pageId}". Why not write it?)`;
    choicesEl.innerHTML = "";
    pageTitleEl.textContent = "Untrodden Path";
    pageNumEl.textContent = "Page " + current.pageId;
    return;
  }
  pageTitleEl.textContent = page.title || "";
  pageNumEl.textContent = "Page · " + current.pageId;
  passageEl.textContent = page.text || "";
  choicesEl.innerHTML = "";
  if(page.ending){
    const e = document.createElement('div');
    e.className = "ending";
    e.textContent = page.ending;
    choicesEl.appendChild(e);
  }
  (page.choices || []).forEach((c, i) => {
    const b = document.createElement('button');
    b.className = "choice";
    b.innerHTML = `${escapeHtml(c.label)}<span class="turn">Turn to “${escapeHtml(c.to)}”</span>`;
    b.addEventListener('click', () => go(c.to));
    choicesEl.appendChild(b);
  });
  // Path breadcrumb
  pathEl.innerHTML = "<span>Trail:</span> " + (current.history.length
    ? current.history.map(h => escapeHtml(h)).join(" → ") + " → <b>" + escapeHtml(current.pageId) + "</b>"
    : "<b>" + escapeHtml(current.pageId) + "</b>");
  if(animate){
    reader.classList.remove('flip'); void reader.offsetWidth; reader.classList.add('flip');
  }
}

document.getElementById('backBtn').addEventListener('click', back);
document.getElementById('restartBtn').addEventListener('click', () => {
  current.pageId = getBook(current.bookId).start;
  current.history = [];
  renderPage(true);
});
document.getElementById('closeBtn').addEventListener('click', () => {
  reader.classList.remove('active');
  document.getElementById('editor').classList.remove('active');
  document.getElementById('library').style.display = '';
  window.scrollTo({top:0, behavior:'smooth'});
});

// ---------- Editor ----------
const editor = document.getElementById('editor');
const branchFromEl = document.getElementById('branchFrom');
const choiceRowsEl = document.getElementById('choiceRows');
function makeChoiceRow(label="", to=""){
  const row = document.createElement('div');
  row.className = "choice-row";
  row.innerHTML = `
    <input class="label" placeholder="Choice label" value="${escapeAttr(label)}">
    <input class="target" placeholder="page_id" value="${escapeAttr(to)}">
    <button class="x" title="Remove">✕</button>`;
  row.querySelector('.x').addEventListener('click', () => row.remove());
  return row;
}
function openEditor(){
  editor.classList.add('active');
  branchFromEl.textContent = current.pageId;
  document.getElementById('pid').value = "";
  document.getElementById('ptitle').value = "";
  document.getElementById('ptext').value = "";
  choiceRowsEl.innerHTML = "";
  choiceRowsEl.appendChild(makeChoiceRow("", ""));
  editor.scrollIntoView({behavior:'smooth', block:'start'});
}
document.getElementById('addPageBtn').addEventListener('click', openEditor);
document.getElementById('addChoiceRow').addEventListener('click', () => {
  choiceRowsEl.appendChild(makeChoiceRow());
});
document.getElementById('cancelPage').addEventListener('click', () => editor.classList.remove('active'));
document.getElementById('savePage').addEventListener('click', () => {
  const pid = document.getElementById('pid').value.trim().replace(/\s+/g, '_').toLowerCase();
  const title = document.getElementById('ptitle').value.trim();
  const text = document.getElementById('ptext').value.trim();
  if(!pid){ alert("Give the page an ID, like cave_drip."); return; }
  if(!text){ alert("The page needs some prose."); return; }
  const choices = [...choiceRowsEl.querySelectorAll('.choice-row')].map(r => ({
    label: r.querySelector('.label').value.trim(),
    to: r.querySelector('.target').value.trim().replace(/\s+/g, '_').toLowerCase()
  })).filter(c => c.label && c.to);

  // Save
  state.custom[current.bookId] = state.custom[current.bookId] || {pages:{}};
  state.custom[current.bookId].pages[pid] = { title, text, choices };

  // Wire it into the current page automatically (if the user wants), as a new choice
  const cur = getBook(current.bookId).pages[current.pageId];
  if(cur && !cur.choices.some(c => c.to === pid) && !(cur.ending)){
    // Add a soft choice to the current page (in custom layer) so it actually appears
    const customCur = (state.custom[current.bookId].pages[current.pageId]) || JSON.parse(JSON.stringify(cur));
    customCur.choices = [...(customCur.choices||[]), {label: title || pid, to: pid}];
    state.custom[current.bookId].pages[current.pageId] = customCur;
  }
  saveState(state);
  editor.classList.remove('active');
  renderPage(true);
});

document.getElementById('exportBook').addEventListener('click', async () => {
  const merged = getBook(current.bookId);
  const txt = JSON.stringify(merged, null, 2);
  try {
    await navigator.clipboard.writeText(txt);
    alert("Book JSON copied to clipboard.");
  } catch(e){
    prompt("Copy this:", txt);
  }
});

// ---------- Helpers ----------
function escapeHtml(s){ return String(s||"").replace(/[&<>"']/g, c => ({"&":"&amp;","<":"&lt;",">":"&gt;","\"":"&quot;","'":"&#39;"}[c])); }
function escapeAttr(s){ return escapeHtml(s); }

renderShelf();
</script>
</body>
</html>
