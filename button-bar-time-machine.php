<?php
$source = 'https://jona.ca/2004/03/interesting-google-browser-buttons.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Button Bar Time Machine</title>
<style>
:root{--ink:#17231e;--cream:#f5f0df;--lime:#d9f45b;--orange:#ff7043;--blue:#9bd8ef;--chrome:#d8dedc;--dark:#29342f}
*{box-sizing:border-box}html{min-height:100%;background:#18231e}body{margin:0;color:var(--ink);font-family:'Courier New',monospace;background:radial-gradient(circle at 12% 8%,#4a695b 0,transparent 30%),radial-gradient(circle at 90% 32%,#614b30 0,transparent 30%),#18231e;min-height:100vh;padding:18px}
.shell{max-width:1080px;margin:auto;background:var(--cream);border:3px solid #0c1511;border-radius:28px;overflow:hidden;box-shadow:0 22px 0 #0c1511,0 35px 70px #07100baa}
header{padding:clamp(28px,6vw,72px);position:relative;overflow:hidden;background:var(--lime);border-bottom:3px solid #0c1511}
header:after{content:'2004';position:absolute;right:-18px;bottom:-55px;font:900 clamp(110px,21vw,250px)/1 Georgia,serif;color:#17231e12;transform:rotate(-5deg)}
.kicker{display:inline-block;background:var(--ink);color:var(--cream);padding:7px 11px;transform:rotate(-2deg);font-size:12px;letter-spacing:.14em;text-transform:uppercase}
h1{font:900 clamp(48px,9vw,104px)/.82 Georgia,serif;letter-spacing:-.065em;max-width:820px;margin:22px 0 20px;position:relative;z-index:1}.intro{max-width:610px;font-size:14px;line-height:1.7;margin:0}
main{padding:clamp(20px,5vw,56px)}
.browser{border:3px solid var(--ink);border-radius:17px;overflow:hidden;background:white;box-shadow:9px 9px 0 var(--blue)}
.titlebar{height:38px;background:linear-gradient(#edf1ef,#bec8c3);border-bottom:2px solid var(--ink);display:flex;align-items:center;padding:0 12px;gap:7px}.lamp{width:13px;height:13px;border:2px solid var(--ink);border-radius:50%}.lamp:nth-child(1){background:#ff6f61}.lamp:nth-child(2){background:#ffd44e}.lamp:nth-child(3){background:#84dc72}.window-title{margin:auto;font-size:11px;font-weight:500}
.toolbar{min-height:88px;padding:11px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;background:#e7ece9;border-bottom:2px solid var(--ink)}
.tool{border:2px solid var(--ink);border-radius:8px;background:#fff;padding:8px 11px;min-width:72px;cursor:pointer;font:500 11px 'DM Mono';box-shadow:0 3px 0 var(--ink);transition:.12s}.tool:hover{transform:translateY(-2px);box-shadow:0 5px 0 var(--ink)}.tool:active{transform:translateY(3px);box-shadow:none}.tool .ico{display:block;font-size:22px;margin-bottom:3px}.tool.active{background:var(--lime)}
.address{flex:1;min-width:210px;border:2px inset #89938e;background:white;border-radius:4px;padding:10px;font:12px 'DM Mono';color:#52615a}
.page{min-height:290px;padding:clamp(22px,5vw,48px);background:linear-gradient(90deg,#f5f0df 1px,transparent 1px),linear-gradient(#f5f0df 1px,transparent 1px),#fff;background-size:24px 24px;display:grid;place-items:center;text-align:center}.page-card{max-width:600px}.page h2{font:900 clamp(32px,6vw,61px)/.96 'Fraunces';margin:0 0 14px}.page p{line-height:1.6;margin:0}.result{color:var(--orange);min-height:1.6em;margin-top:16px!important;font-weight:500}
.workbench{display:grid;grid-template-columns:1fr 1fr;gap:34px;margin-top:48px}.panel{border-top:3px solid var(--ink);padding-top:18px}.panel h2{font:900 30px/1 'Fraunces';margin:0 0 8px}.panel>p{font-size:12px;line-height:1.6;color:#53605a}.parts{display:flex;flex-wrap:wrap;gap:8px;margin:20px 0}.part{border:2px solid var(--ink);background:white;border-radius:99px;padding:9px 13px;font:500 11px 'DM Mono';cursor:pointer}.part[aria-pressed=true]{background:var(--orange);color:white}.part:disabled{opacity:.35;cursor:not-allowed}
.mission{background:var(--dark);color:white;padding:22px;border-radius:3px 20px 20px 20px;min-height:180px;position:relative}.mission:before{content:'MISSION';position:absolute;right:15px;top:12px;color:#ffffff38;font-weight:bold;letter-spacing:.2em}.mission strong{color:var(--lime);display:block;font:700 22px 'Fraunces';margin-bottom:9px}.mission p{font-size:12px;line-height:1.6}.mission button{background:var(--lime);border:2px solid #090f0c;box-shadow:4px 4px 0 #090f0c;padding:10px 14px;font:500 11px 'DM Mono';cursor:pointer}
.meter{height:16px;border:2px solid var(--ink);margin-top:18px;background:white}.meter span{display:block;width:0;height:100%;background:var(--orange);transition:.4s}.scoreline{display:flex;justify-content:space-between;font-size:11px;margin-top:6px}
footer{display:flex;justify-content:space-between;gap:20px;align-items:end;padding:28px clamp(20px,5vw,56px) 40px;font-size:11px;line-height:1.6}footer a{color:inherit;font-weight:bold}footer .stamp{font:900 25px 'Fraunces';transform:rotate(-3deg);border:2px solid;padding:7px 10px}
@media(max-width:720px){body{padding:8px}.shell{border-radius:18px}.workbench{grid-template-columns:1fr}.tool{min-width:60px;padding:7px}.toolbar{align-items:stretch}.address{order:2;flex-basis:100%}footer{align-items:start;flex-direction:column}.stamp{align-self:flex-end}header{padding-bottom:45px}}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important}}
</style>
</head>
<body>
<div class="shell">
<header>
  <span class="kicker">Personal web archaeology lab</span>
  <h1>Button Bar<br>Time Machine</h1>
  <p class="intro">Before browsers hid everything behind three dots, the web had buttons. Big, optimistic buttons. Build a 2004 toolbar, then see if it can survive a tiny search expedition.</p>
</header>
<main>
 <section class="browser" aria-label="Simulated 2004 browser">
  <div class="titlebar"><i class="lamp"></i><i class="lamp"></i><i class="lamp"></i><span class="window-title">Chloe Navigator 6.0 — definitely secure-ish</span></div>
  <div class="toolbar" id="toolbar">
   <button class="tool active" data-action="back"><span class="ico">↶</span>BACK</button>
   <button class="tool active" data-action="home"><span class="ico">⌂</span>HOME</button>
   <input class="address" value="the web / still weird / home" aria-label="Address">
  </div>
  <div class="page"><div class="page-card"><h2 id="pageTitle">The web awaits.</h2><p id="pageText">Install a few buttons below, accept a mission, and press the right tool. Your glorious toolbar will keep score.</p><p class="result" id="result" aria-live="polite"></p></div></div>
 </section>
 <div class="workbench">
  <section class="panel"><h2>1. Stock the bar</h2><p>Choose wisely. Every button takes precious chrome, a resource browsers once spent like a sailor on shore leave.</p><div class="parts" id="parts"></div><div class="meter"><span id="clutter"></span></div><div class="scoreline"><span>clean</span><span id="clutterLabel">2 buttons</span><span>button jungle</span></div></section>
  <section class="panel"><h2>2. Take a mission</h2><p>The machine will ask for a particular bit of early-web magic. Use your installed toolbar button to perform it.</p><div class="mission"><strong id="missionTitle">Ready to browse?</strong><p id="missionText">Press the lever for your first assignment.</p><button id="newMission">PULL MISSION LEVER</button><div class="scoreline"><span>MISSIONS CLEARED</span><span id="score">0 / 0</span></div></div></section>
 </div>
</main>
<footer><div>Inspired by Jon’s <a href="<?= htmlspecialchars($source) ?>" target="_blank" rel="noopener">note about Google Browser Buttons</a>.<br>A small salute to visible tools and gloriously crowded chrome.</div><div class="stamp">WEB, CIRCA 2004</div></footer>
</div>
<script>
const tools=[['images','▧','IMAGES'],['news','▤','NEWS'],['maps','⌖','MAPS'],['highlight','✦','HIGHLIGHT'],['up','⇧','UP ONE'],['weird','☄','SURPRISE']];
const missions=[
 {action:'images',title:'Find visual evidence',text:'Nathan needs pictures of a 1982 Pontiac Trans Am. Use the image-search button.',ok:'A black Trans Am appears. It may or may not be talking.'},
 {action:'maps',title:'Plot an expedition',text:'Locate a route to a castle, a diner, or the nearest suspiciously scenic bridge.',ok:'Route plotted. Paper map remains in glove box for ceremonial purposes.'},
 {action:'highlight',title:'Find the tiny clue',text:'The page is enormous. Highlight the phrase “secret passage” before your tea gets cold.',ok:'Found it! Eleven screenfuls of scrolling have been heroically avoided.'},
 {action:'news',title:'Check the wires',text:'Find today’s news without being distracted by a dancing hamster.',ok:'Headlines acquired. Dancing hamster tab opened separately, as tradition demands.'},
 {action:'up',title:'Escape the subfolder',text:'You are seven directories deep in a fan site. Go up one level.',ok:'You ascend from /cars/kitt/scanners/red/ to a calmer portion of the web.'},
 {action:'weird',title:'Browse with courage',text:'The web feels too predictable. Press the button nobody sensible would install.',ok:'You discover a hand-coded site about municipal manhole covers. Perfect.'}
];
const parts=document.querySelector('#parts'),bar=document.querySelector('#toolbar'),address=bar.querySelector('.address');let installed=new Set(),current=null,wins=0,rounds=0;
tools.forEach(([id,icon,label])=>{let b=document.createElement('button');b.className='part';b.textContent=icon+' '+label;b.setAttribute('aria-pressed','false');b.onclick=()=>toggle(id,icon,label,b);parts.append(b)});
function toggle(id,icon,label,pill){if(installed.has(id)){installed.delete(id);bar.querySelector(`[data-action="${id}"]`).remove();pill.setAttribute('aria-pressed','false')}else{installed.add(id);let b=document.createElement('button');b.className='tool active';b.dataset.action=id;b.innerHTML=`<span class="ico">${icon}</span>${label}`;b.onclick=()=>act(id);bar.insertBefore(b,address);pill.setAttribute('aria-pressed','true')}updateClutter()}
function updateClutter(){let n=installed.size+2;document.querySelector('#clutter').style.width=(n/8*100)+'%';document.querySelector('#clutterLabel').textContent=n+' buttons'}
function act(id){let result=document.querySelector('#result');if(!current){result.textContent='An excellent click, but first pull the mission lever.';return}rounds++;if(id===current.action){wins++;result.textContent='✓ '+current.ok;document.querySelector('#pageTitle').textContent='MISSION CLEARED';document.querySelector('#pageText').textContent='The toolbar earns one tiny shareware star.'}else{result.textContent='Not quite. The '+id.toUpperCase()+' button has enthusiastically solved a different problem.'}document.querySelector('#score').textContent=wins+' / '+rounds;current=null}
document.querySelectorAll('.tool[data-action]').forEach(b=>b.onclick=()=>{document.querySelector('#result').textContent=b.dataset.action==='home'?'Home: where your modem knows your name.':'Back you go, through the squealing modem mist.'});
document.querySelector('#newMission').onclick=()=>{current=missions[Math.floor(Math.random()*missions.length)];document.querySelector('#missionTitle').textContent=current.title;document.querySelector('#missionText').textContent=current.text;document.querySelector('#result').textContent=installed.has(current.action)?'Your toolbar is equipped. Choose carefully.':'That tool is not installed yet. Visit the workbench.';document.querySelector('#pageTitle').textContent='INCOMING REQUEST';document.querySelector('#pageText').textContent=current.text};
</script>
</body>
</html>
