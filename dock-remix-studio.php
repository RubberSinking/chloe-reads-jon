<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Dock Remix Studio</title>
<style>
:root{
  --paper:#f4efe4;
  --ink:#222018;
  --accent:#d14836;
  --teal:#126b6f;
  --gold:#d7a73d;
  --line:#d9cfbe;
  --card:#fffaf1;
}
*{box-sizing:border-box}
body{
  margin:0;
  color:var(--ink);
  font-family:"Avenir Next","Trebuchet MS",sans-serif;
  background:
    radial-gradient(circle at 20% 0%, #fff9ea 0 20%, transparent 55%),
    radial-gradient(circle at 85% 100%, #fce6d1 0 22%, transparent 55%),
    linear-gradient(140deg,#f8f2e8,#efe6d8);
  min-height:100vh;
}
main{max-width:1040px;margin:0 auto;padding:24px 16px 40px}
.hero{
  background:linear-gradient(155deg,#fffdf8,#f7f0e4);
  border:1px solid var(--line);
  border-radius:24px;
  padding:26px 22px;
  box-shadow:0 12px 36px rgba(30,20,8,.10);
}
h1{
  margin:0;
  font-family:Georgia, "Times New Roman", serif;
  font-size:clamp(1.8rem,4vw,3rem);
  line-height:1.05;
  letter-spacing:.01em;
}
.sub{margin:14px 0 0;line-height:1.55;max-width:72ch}
.layout{
  display:grid;
  grid-template-columns:1.05fr .95fr;
  gap:18px;
  margin-top:18px;
}
.panel{
  background:var(--card);
  border:1px solid var(--line);
  border-radius:20px;
  padding:18px;
  box-shadow:0 10px 22px rgba(45,31,12,.08);
}
h2{
  margin:0 0 12px;
  font-size:1.1rem;
  letter-spacing:.04em;
  text-transform:uppercase;
  color:#544d42;
}
.grid{
  display:grid;
  grid-template-columns:repeat(2,minmax(0,1fr));
  gap:10px;
}
button.app{
  border:1px solid #cfbf9f;
  border-radius:14px;
  background:#fff;
  color:#332e25;
  padding:10px 10px;
  font:600 .95rem/1.2 "Avenir Next","Trebuchet MS",sans-serif;
  text-align:left;
  cursor:pointer;
  transition:transform .2s, box-shadow .2s, border-color .2s, background .2s;
}
button.app:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(40,28,12,.16)}
button.app.active{
  border-color:var(--teal);
  background:linear-gradient(120deg,#e7f5f5,#f4fffd);
  box-shadow:0 8px 18px rgba(18,107,111,.2);
}
.deck{
  margin-top:14px;
  background:#fdf8ef;
  border:1px dashed #ccbda2;
  border-radius:16px;
  padding:14px;
  min-height:96px;
}
.dock{
  display:flex;
  gap:8px;
  flex-wrap:wrap;
  margin-top:10px;
}
.chip{
  background:#fff;
  border:1px solid #d7cab2;
  border-radius:999px;
  padding:6px 10px;
  font-size:.86rem;
}
.metrics{
  display:grid;
  grid-template-columns:repeat(2,minmax(0,1fr));
  gap:10px;
  margin-top:12px;
}
.metric{
  background:#fff;
  border:1px solid #e2d7c4;
  border-radius:14px;
  padding:10px;
}
.metric b{display:block;font-size:1.25rem}
.bar{
  margin-top:8px;height:9px;background:#efe3d0;border-radius:999px;overflow:hidden;
}
.fill{height:100%;width:0%;background:linear-gradient(90deg,var(--teal),#2d9aa0);transition:width .35s}
.note{
  margin-top:14px;padding:12px;border-radius:14px;border-left:5px solid var(--accent);
  background:#fff5f2;line-height:1.45
}
.actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:12px}
.actions button{
  border:0;border-radius:999px;padding:10px 14px;font-weight:700;cursor:pointer
}
#shuffle{background:var(--gold);color:#2f250f}
#clear{background:#222;color:#fff}
#seed{background:#0f5f63;color:#fff}
.footer{margin-top:18px;font-size:.92rem;line-height:1.5;color:#534b40}
.footer a{color:#0f5f63}
@media (max-width:900px){.layout{grid-template-columns:1fr}}
@media (max-width:560px){.grid{grid-template-columns:1fr}}
@keyframes pop{from{transform:scale(.94);opacity:.2}to{transform:scale(1);opacity:1}}
.chip{animation:pop .2s ease}
</style>
</head>
<body>
<main>
  <section class="hero">
    <h1>Dock Remix Studio</h1>
    <p class="sub">Build your ideal app dock, then see what it says about your day. This is a playful remix of Jon's old “what's on your dock?” prompt: part self-reflection, part mini strategy game.</p>
  </section>

  <section class="layout">
    <div class="panel">
      <h2>App Shelf</h2>
      <div class="grid" id="appGrid"></div>
      <div class="actions">
        <button id="shuffle" type="button">Shuffle Suggestion</button>
        <button id="seed" type="button">Load Jon's 2013 Dock</button>
        <button id="clear" type="button">Clear Dock</button>
      </div>
    </div>

    <div class="panel">
      <h2>Your Dock</h2>
      <div class="deck">
        Pick up to 12 apps. Try to balance communication, focus, and fun.
        <div class="dock" id="dock"></div>
      </div>

      <div class="metrics">
        <div class="metric">
          <span>Focus Score</span>
          <b id="focusVal">0</b>
          <div class="bar"><div class="fill" id="focusFill"></div></div>
        </div>
        <div class="metric">
          <span>Variety Score</span>
          <b id="varietyVal">0</b>
          <div class="bar"><div class="fill" id="varietyFill"></div></div>
        </div>
      </div>

      <div class="note" id="verdict">No dock yet. Start tapping apps and I'll profile the vibe.</div>
    </div>
  </section>

  <p class="footer">
    Inspired by Jon's <a href="https://jona.ca/2013/05/whats-on-your-dock.html">What's on your dock?</a> post.
  </p>
</main>

<script>
const APPS = [
  {name:"Finder", type:"utility", focus:7, fun:2},
  {name:"Mail", type:"comms", focus:4, fun:1},
  {name:"Calendar", type:"planning", focus:8, fun:1},
  {name:"Notational Velocity", type:"writing", focus:10, fun:2},
  {name:"iTerm2", type:"dev", focus:9, fun:5},
  {name:"Safari", type:"web", focus:5, fun:6},
  {name:"Firefox", type:"web", focus:5, fun:6},
  {name:"1Password", type:"security", focus:6, fun:1},
  {name:"Excel", type:"analysis", focus:8, fun:3},
  {name:"Adium", type:"comms", focus:3, fun:4},
  {name:"jEdit", type:"dev", focus:8, fun:3},
  {name:"App Store", type:"utility", focus:2, fun:5},
  {name:"System Preferences", type:"utility", focus:4, fun:2},
  {name:"Clock Chimes", type:"atmosphere", focus:4, fun:6},
  {name:"iTunes", type:"media", focus:2, fun:8},
  {name:"Photos", type:"media", focus:3, fun:7},
  {name:"OmniFocus", type:"planning", focus:10, fun:2},
  {name:"Obsidian", type:"writing", focus:9, fun:3},
  {name:"Preview", type:"utility", focus:7, fun:1},
  {name:"Signal", type:"comms", focus:3, fun:4}
];
const JON2013 = ["Finder","PostBox","Calendar","Adium","Notational Velocity","jEdit","iTerm2","Safari","Firefox","1Password","Network Connect","Colors","Clock Chimes","iTunes","App Store","System Preferences","Microsoft Excel"];

const selected = new Set();
const appGrid = document.getElementById("appGrid");
const dockEl = document.getElementById("dock");
const verdictEl = document.getElementById("verdict");

function drawApps(){
  appGrid.innerHTML = "";
  APPS.forEach(app=>{
    const b = document.createElement("button");
    b.className = "app" + (selected.has(app.name) ? " active" : "");
    b.type = "button";
    b.textContent = app.name;
    b.onclick = ()=>toggle(app.name);
    appGrid.appendChild(b);
  });
}
function drawDock(){
  dockEl.innerHTML = "";
  [...selected].forEach(name=>{
    const chip = document.createElement("span");
    chip.className = "chip";
    chip.textContent = name;
    dockEl.appendChild(chip);
  });
}
function clamp(v){ return Math.max(0,Math.min(100,Math.round(v))); }

function updateScores(){
  const list = APPS.filter(a=>selected.has(a.name));
  const n = list.length;
  if(!n){
    setScore("focus",0); setScore("variety",0);
    verdictEl.textContent = "No dock yet. Start tapping apps and I'll profile the vibe.";
    return;
  }
  const focus = clamp((list.reduce((s,a)=>s+a.focus,0)/(n*10))*100);
  const typeCount = new Set(list.map(a=>a.type)).size;
  const variety = clamp((typeCount/8)*100 + Math.min(n*2,20));
  setScore("focus",focus);
  setScore("variety",variety);

  let verdict = "";
  if (focus > 74 && variety > 60) verdict = "Balanced Builder: deep work engine, but still human. This dock can ship features and keep wonder alive.";
  else if (focus > 74) verdict = "Monastic Operator: high concentration setup. Your dock whispers, 'Please no meetings.'";
  else if (variety > 70) verdict = "Renaissance Dock: broad curiosity, many modes, many windows, probably many tabs.";
  else verdict = "Chaotic Generalist: flexible and lively, but this setup may scatter your attention.";
  if (n >= 10) verdict += " Full-size dock unlocked.";
  verdictEl.textContent = verdict;
}
function setScore(key,val){
  document.getElementById(key+"Val").textContent = val;
  document.getElementById(key+"Fill").style.width = val + "%";
}
function toggle(name){
  if(selected.has(name)){ selected.delete(name); }
  else{
    if(selected.size >= 12){ verdictEl.textContent = "Dock full at 12 apps. Remove one to add another."; return; }
    selected.add(name);
  }
  drawApps(); drawDock(); updateScores();
}
document.getElementById("clear").onclick=()=>{selected.clear(); drawApps(); drawDock(); updateScores();};

document.getElementById("seed").onclick=()=>{
  selected.clear();
  JON2013.forEach(name=>{
    if(APPS.find(a=>a.name===name) && selected.size<12) selected.add(name);
  });
  drawApps(); drawDock(); updateScores();
};

document.getElementById("shuffle").onclick=()=>{
  selected.clear();
  const pool=[...APPS].sort(()=>Math.random()-0.5);
  const size = 7 + Math.floor(Math.random()*6);
  pool.slice(0,size).forEach(a=>selected.add(a.name));
  drawApps(); drawDock(); updateScores();
};

drawApps(); drawDock(); updateScores();
</script>
</body>
</html>
