<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Window Chaos! — 2006 Desktop Manager Game</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: Tahoma, Geneva, sans-serif;
    background: #3a6ea5;
    background-image: radial-gradient(ellipse at 30% 20%, #4a7eb5 0%, transparent 60%), radial-gradient(ellipse at 70% 80%, #2a5e95 0%, transparent 60%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
    user-select: none;
    -webkit-user-select: none;
  }
  #hud {
    width: 100%;
    max-width: 720px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 14px;
    background: rgba(0,0,0,0.35);
    color: #fff;
    font-size: 13px;
    flex-wrap: wrap;
    position: relative;
    z-index: 200;
  }
  .label { opacity: .7; }
  #score-val { font-weight: bold; font-size: 17px; color: #ffe87c; }
  #combo-val { font-weight: bold; color: #7cffc8; }
  #level-val { font-weight: bold; color: #ffb97c; }
  #chaos-bar-wrap { flex: 1; min-width: 100px; height: 13px; background: rgba(255,255,255,0.15); border-radius: 7px; overflow: hidden; }
  #chaos-bar { height: 100%; width: 0%; border-radius: 7px; background: linear-gradient(90deg, #6be06b, #ffe87c, #ff5555); transition: width .3s; }
  #desktop {
    position: relative;
    width: 100%;
    max-width: 720px;
    height: 460px;
    overflow: hidden;
    background: #008080;
    background-image: radial-gradient(ellipse at 50% 50%, #009090 0%, #006666 100%);
    cursor: default;
    flex-shrink: 0;
  }
  #desktop::before {
    content: "🖥  My Computer\A 📁 My Documents\A 🌐 Internet\A 🗑 Recycle Bin";
    white-space: pre;
    position: absolute;
    top: 12px; left: 10px;
    font-size: 11px;
    color: rgba(255,255,255,0.45);
    line-height: 2.1;
    pointer-events: none;
  }
  .win {
    position: absolute;
    width: 210px;
    background: #d4d0c8;
    border: 2px solid #848484;
    border-top-color: #fff;
    border-left-color: #fff;
    box-shadow: 3px 3px 8px rgba(0,0,0,0.5);
    border-radius: 2px;
    cursor: pointer;
    z-index: 10;
    animation: popIn .18s ease-out;
  }
  @keyframes popIn { from { transform: scale(0.7); opacity: 0; } to { transform: scale(1); opacity: 1; } }
  .win:active { transform: scale(0.95); }
  .win.urgent { border-color: #ff4444 !important; }
  .win-titlebar {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 3px 5px;
    background: linear-gradient(90deg, #000e7e, #1084d0);
    color: #fff;
    font-size: 11px;
    font-weight: bold;
  }
  .win-icon { font-size: 13px; }
  .win-title { flex: 1; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  .win-x {
    background: #c7412e;
    color: #fff;
    border: 1px solid #ff8070;
    border-radius: 2px;
    width: 16px; height: 14px;
    font-size: 10px;
    display: flex; align-items: center; justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
  }
  .win-body {
    padding: 5px 8px;
    font-size: 11px;
    color: #333;
    line-height: 1.4;
    background: #fff;
    min-height: 26px;
    border-top: 1px solid #848484;
  }
  .win-statusbar {
    font-size: 10px;
    color: #555;
    padding: 2px 6px;
    border-top: 1px solid #aaa;
    background: #d4d0c8;
    display: flex;
    justify-content: space-between;
  }
  .win-priority { display: inline-block; padding: 1px 5px; border-radius: 8px; font-size: 9px; font-weight: bold; color: #fff; }
  .p-low { background: #5aa05a; }
  .p-medium { background: #d4a017; }
  .p-high { background: #cc3300; }
  .score-popup {
    position: absolute;
    font-size: 19px;
    font-weight: bold;
    color: #ffe87c;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.9);
    pointer-events: none;
    z-index: 999;
    animation: floatUp .85s ease-out forwards;
  }
  @keyframes floatUp { 0% { opacity:1; transform:translateY(0) scale(1); } 100% { opacity:0; transform:translateY(-55px) scale(1.3); } }
  #taskbar {
    width: 100%;
    max-width: 720px;
    height: 30px;
    background: linear-gradient(180deg, #1f3f7f 0%, #1a3060 50%, #1f3f7f 100%);
    display: flex;
    align-items: center;
    padding: 0 6px;
    gap: 3px;
    flex-shrink: 0;
    position: relative;
    z-index: 200;
    overflow: hidden;
  }
  #start-btn {
    background: linear-gradient(180deg, #5fa85f, #3d7a3d);
    color: #fff;
    font-weight: bold;
    font-size: 11px;
    padding: 2px 9px;
    border-radius: 10px;
    border: 1px solid #2a5a2a;
    cursor: pointer;
    white-space: nowrap;
    flex-shrink: 0;
  }
  #taskbar-clock { margin-left: auto; color: #fff; font-size: 11px; background: rgba(0,0,0,0.2); padding: 2px 7px; border-radius: 3px; flex-shrink: 0; }
  .tb-win { background: rgba(255,255,255,0.12); color: #ddd; font-size: 10px; padding: 2px 5px; border-radius: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 80px; border: 1px solid rgba(255,255,255,0.15); }
  .screen {
    display: none;
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.72);
    z-index: 500;
    align-items: center;
    justify-content: center;
  }
  .screen.active { display: flex; }
  .screen-box {
    background: #d4d0c8;
    border: 2px solid #fff;
    border-right-color: #848484;
    border-bottom-color: #848484;
    padding: 22px 28px;
    max-width: 300px;
    width: 92%;
    text-align: center;
  }
  .screen-box h2 {
    background: linear-gradient(90deg,#000e7e,#1084d0);
    color:#fff;
    margin: -22px -28px 14px;
    padding: 8px 14px;
    font-size: 13px;
  }
  .screen-box p { font-size: 12px; color: #333; margin-bottom: 8px; line-height: 1.5; }
  .big { font-size: 36px; font-weight: bold; color: #000e7e; margin: 8px 0; }
  .xp-btn {
    background: linear-gradient(180deg, #f1f1f1, #d4d0c8);
    border: 2px solid #848484;
    border-top-color: #fff;
    border-left-color: #fff;
    padding: 5px 18px;
    font-family: Tahoma,sans-serif;
    font-size: 12px;
    cursor: pointer;
    border-radius: 3px;
    margin: 4px;
  }
  .xp-btn:hover { background: linear-gradient(180deg, #ffe87c, #d4b800); }
  .xp-btn:active { border-top-color: #848484; border-left-color: #848484; border-right-color: #fff; border-bottom-color: #fff; }
  #iswitchw {
    display: none;
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    z-index: 400;
    background: #1a1a2e;
    border: 2px solid #4a4aaa;
    box-shadow: 0 0 20px rgba(80,80,255,0.4);
    padding: 10px;
    width: 250px;
  }
  #iswitchw.active { display: block; }
  #sw-input {
    width: 100%;
    background: #0a0a1e;
    color: #a0f0a0;
    border: 1px solid #4a4aaa;
    padding: 5px 8px;
    font-size: 13px;
    font-family: monospace;
    outline: none;
  }
  #iswitchw-list { margin-top: 5px; max-height: 130px; overflow-y: auto; }
  .sw-item { padding: 3px 6px; font-size: 11px; color: #ccc; cursor: pointer; border-bottom: 1px solid #333; font-family: Tahoma,sans-serif; }
  .sw-item:hover, .sw-item.hi { background: #4a4aaa; color: #fff; }
  .sw-hint { font-size: 10px; color: #888; margin-top: 4px; text-align: center; font-family: Tahoma,sans-serif; }
  #combo-text {
    position: absolute;
    top: 40%; left: 50%;
    transform: translate(-50%,-50%);
    font-size: 44px;
    font-weight: bold;
    color: #fff;
    text-shadow: 2px 2px 10px rgba(0,200,100,0.9);
    pointer-events: none;
    z-index: 600;
    display: none;
    white-space: nowrap;
  }
  #tap-hint { position: absolute; bottom: 6px; right: 8px; font-size: 10px; color: rgba(255,255,255,0.45); pointer-events: none; }
</style>
</head>
<body>
<?php $time = date('H:i'); ?>
<div id="hud">
  <span class="label">Score:</span><span id="score-val">0</span>
  &nbsp;<span class="label">Combo:</span><span id="combo-val">x1</span>
  &nbsp;<span class="label">Lvl:</span><span id="level-val">1</span>
  &nbsp;<span class="label">Chaos:</span>
  <div id="chaos-bar-wrap"><div id="chaos-bar"></div></div>
</div>
<div id="desktop">
  <div id="combo-text"></div>
  <div id="tap-hint">Tap windows to close them • Desktop keyboard: CapsLock = iswitchw</div>
  <div id="iswitchw">
    <input id="sw-input" placeholder="Type to filter windows..." autocomplete="off" spellcheck="false">
    <div id="iswitchw-list"></div>
    <div class="sw-hint">↑↓ navigate &nbsp;•&nbsp; Enter close &nbsp;•&nbsp; Esc cancel</div>
  </div>
  <div id="screen-start" class="screen active">
    <div class="screen-box">
      <h2>🖥 Window Chaos!</h2>
      <p>It's 2006 and your Windows XP desktop is <strong>out of control.</strong></p>
      <p>Close windows before the chaos meter fills up! Build combos for bonus points.</p>
      <p style="font-size:11px;color:#777"><em>💡 On desktop: CapsLock opens iswitchw — incremental window search!</em></p>
      <button class="xp-btn" onclick="startGame()">▶ Play</button>
    </div>
  </div>
  <div id="screen-over" class="screen">
    <div class="screen-box">
      <h2>💀 System Overload!</h2>
      <p>Too many windows open. Desktop crashed.</p>
      <div class="big" id="final-score">0</div>
      <p id="final-msg"></p>
      <button class="xp-btn" onclick="restartGame()">🔄 Try Again</button>
    </div>
  </div>
</div>
<div id="taskbar">
  <button id="start-btn">⊞ Start</button>
  <div id="tb-windows" style="display:flex;gap:3px;overflow:hidden;flex:1"></div>
  <div id="taskbar-clock"><?= $time ?></div>
</div>
<script>
const WIN_TYPES = [
  {icon:'🌐',title:'Firefox',bodies:['jonaquino.blogspot.com','AutoHotKey Forum','jEdit Plugins','Google — dual monitor tips','Flickr Upload'],priority:'low'},
  {icon:'📧',title:'Outlook',bodies:['RE: Project meeting','FWD: New plugin release','Unread: 47 messages','Calendar: 3pm reminder'],priority:'medium'},
  {icon:'📝',title:'jEdit',bodies:['fw.ahk *','config.xml','index.html *','Plugin.java unsaved'],priority:'low'},
  {icon:'✂️',title:'ClipX',bodies:['1000 clips stored','Ctrl+Alt+V to search','New clip captured!'],priority:'low'},
  {icon:'⌨️',title:'AutoHotKey',bodies:['Script running: fw.ahk','iswitchw.ahk active','Hotkey: CapsLock mapped','Win+Scroll: resize'],priority:'medium'},
  {icon:'📸',title:'SnagIt',bodies:['Screenshot captured','Uploading to Flickr...','Profile: Web capture'],priority:'low'},
  {icon:'💾',title:'UltraEdit',bodies:['Find & Replace...','SFTP connection lost','Backup saved to C:\\bak'],priority:'medium'},
  {icon:'🪟',title:'Nifty Windows',bodies:['Right-drag: move window','Alt+Scroll: resize','Win+Scroll: transparency'],priority:'low'},
  {icon:'🏃',title:'SlickRun',bodies:['Type a command...','ff → Firefox','ue → UltraEdit','yw → Yubnub'],priority:'low'},
  {icon:'💻',title:'TopDesk',bodies:['Exposé for Windows!','All windows visible','Click to activate...'],priority:'low'},
  {icon:'⚠️',title:'Windows Update',bodies:['Critical update available!','Restart required','Security patch #KB8837'],priority:'high'},
  {icon:'🖨️',title:'Print Spooler',bodies:['Error: Printer offline','Job stuck in queue','Retry?'],priority:'medium'},
  {icon:'❓',title:'Windows Error',bodies:['explorer.exe has crashed','Send error report?','Illegal operation detected'],priority:'high'},
  {icon:'🛡️',title:'Norton Antivirus',bodies:['Scan: 34%','Definitions outdated','Full scan: 6h remaining'],priority:'medium'},
  {icon:'🗂️',title:'Windows Explorer',bodies:['C:\\Jon\\Desktop\\Stuff','Sorting 847 files...','Copy: 1.2GB (4h)'],priority:'low'},
  {icon:'🎵',title:'Winamp',bodies:['Now playing: Track 4','Shuffle: ON','Visualizer: Milkdrop'],priority:'low'},
  {icon:'🌐',title:'Internet Explorer',bodies:['This page cannot be displayed','Pop-up blocked (3)','Installing ActiveX...'],priority:'high'},
  {icon:'⬛',title:'cmd.exe',bodies:['C:\\> ipconfig /all','C:\\> dir /s','C:\\> ping 8.8.8.8'],priority:'low'},
  {icon:'🔢',title:'Kinesis Macros',bodies:['Move to top monitor','Open link in new tab','Make window 640x480'],priority:'medium'},
  {icon:'📱',title:'ActiveSync',bodies:['Syncing Pocket PC...','12 contacts updated','Calendar synced'],priority:'low'},
];

let score=0, combo=1, comboTimer=null;
let chaosLevel=0, level=1;
let windows=[], nextId=0;
let spawnTimer=null, chaosTimer=null;
let gameRunning=false, iswitchwOpen=false;

const desktop=document.getElementById('desktop');
const scoreEl=document.getElementById('score-val');
const comboEl=document.getElementById('combo-val');
const levelEl=document.getElementById('level-val');
const chaosBar=document.getElementById('chaos-bar');
const tbWins=document.getElementById('tb-windows');
const comboText=document.getElementById('combo-text');

function spawnWindow() {
  if (!gameRunning || windows.length >= 16) return;
  const type = WIN_TYPES[Math.floor(Math.random()*WIN_TYPES.length)];
  const body = type.bodies[Math.floor(Math.random()*type.bodies.length)];
  const ps = ['low','medium','high'];
  let pIdx = ps.indexOf(type.priority);
  if (Math.random() < (chaosLevel/100)*0.4) pIdx = Math.min(2, pIdx+1);
  const priority = ps[pIdx];

  const maxX = desktop.clientWidth - 220;
  const maxY = desktop.clientHeight - 95;
  const x = 40 + Math.random()*Math.max(1, maxX-40);
  const y = 10 + Math.random()*Math.max(1, maxY-10);
  const id = nextId++;
  const el = document.createElement('div');
  el.className = 'win' + (priority==='high' ? ' urgent' : '');
  el.style.left = x+'px'; el.style.top = y+'px';
  el.style.zIndex = 10 + windows.length;

  const same = windows.filter(w=>w.title===type.title).length;
  const displayTitle = same > 0 ? type.title+' ('+(same+1)+')' : type.title;

  el.innerHTML = `<div class="win-titlebar"><span class="win-icon">${type.icon}</span><span class="win-title">${displayTitle}</span><span class="win-x">✕</span></div><div class="win-body">${body}</div><div class="win-statusbar"><span><span class="win-priority p-${priority}">${priority.toUpperCase()}</span></span><span id="age-${id}">new</span></div>`;
  el.addEventListener('click', ()=>closeWindow(id));
  desktop.appendChild(el);
  windows.push({id, el, priority, title: displayTitle, age:0});
  renderTaskbar();
}

function closeWindow(id) {
  if (!gameRunning) return;
  const idx = windows.findIndex(w=>w.id===id);
  if (idx===-1) return;
  const win = windows[idx];
  const pts = {low:10, medium:25, high:50}[win.priority]||10;
  const earned = pts * combo;
  score += earned; scoreEl.textContent = score;
  clearTimeout(comboTimer);
  combo = Math.min(8, combo+1);
  comboEl.textContent = 'x'+combo;
  comboTimer = setTimeout(()=>{combo=1; comboEl.textContent='x1';}, 2000);
  if (combo >= 3) showComboText(combo);
  chaosLevel = Math.max(0, chaosLevel - (win.priority==='high'?8:win.priority==='medium'?4:2));
  updateChaosBar();
  spawnScorePopup(win.el, '+'+earned);
  win.el.style.transition = 'transform .15s, opacity .15s';
  win.el.style.transform = 'scale(0.5)';
  win.el.style.opacity = '0';
  setTimeout(()=>win.el.remove(), 160);
  windows.splice(idx, 1);
  renderTaskbar();
}

function chaosTick() {
  if (!gameRunning) return;
  const growRate = 0.35 + (windows.length*0.14) + (level*0.08);
  chaosLevel = Math.min(100, chaosLevel+growRate);
  updateChaosBar();
  windows.forEach(w => {
    w.age++;
    const ag = document.getElementById('age-'+w.id);
    if (ag) ag.textContent = w.age < 5 ? 'new' : (w.age < 15 ? w.age+'s' : '⚠ '+w.age+'s');
    if (w.priority==='high' && w.age>8) chaosLevel = Math.min(100, chaosLevel+0.4);
  });
  const nl = 1 + Math.floor(score/400);
  if (nl !== level) { level=nl; levelEl.textContent=level; resetSpawnTimer(); }
  if (chaosLevel >= 100) { gameOver(); return; }
  chaosTimer = setTimeout(chaosTick, 1000);
}

function resetSpawnTimer() {
  clearTimeout(spawnTimer);
  const iv = Math.max(550, 2000-(level*170));
  function loop() {
    if (!gameRunning) return;
    spawnWindow();
    spawnTimer = setTimeout(loop, iv + Math.random()*500);
  }
  spawnTimer = setTimeout(loop, iv);
}

function updateChaosBar() { chaosBar.style.width = chaosLevel+'%'; }

function renderTaskbar() {
  tbWins.innerHTML = windows.slice(-7).map(w=>`<div class="tb-win">${w.el.querySelector('.win-icon').textContent} ${w.title}</div>`).join('');
}

function spawnScorePopup(el, text) {
  const r=el.getBoundingClientRect(), d=desktop.getBoundingClientRect();
  const p=document.createElement('div');
  p.className='score-popup'; p.textContent=text;
  p.style.left=(r.left-d.left+r.width/2-16)+'px';
  p.style.top=(r.top-d.top+8)+'px';
  desktop.appendChild(p);
  p.addEventListener('animationend',()=>p.remove());
}

function showComboText(c) {
  const msgs={3:'Nice! 👍',4:'Combo x'+c+'! 🎯',5:'On Fire! 🔥',6:'UNSTOPPABLE! 🚀',7:'GODLIKE! ⚡',8:'MAX COMBO!! 💥'};
  comboText.textContent = msgs[c]||'Combo x'+c+'!';
  comboText.style.display='block';
  clearTimeout(comboText._t);
  comboText._t=setTimeout(()=>{comboText.style.display='none';},600);
}

// iswitchw
document.addEventListener('keydown', e => {
  if (!gameRunning) return;
  if (e.key==='CapsLock') { e.preventDefault(); toggleIswitchw(); return; }
  if (iswitchwOpen) handleIswitchwKey(e);
});

function toggleIswitchw() {
  const sw=document.getElementById('iswitchw');
  if (iswitchwOpen) { sw.classList.remove('active'); iswitchwOpen=false; }
  else {
    sw.classList.add('active'); iswitchwOpen=true;
    const inp=document.getElementById('sw-input');
    inp.value=''; renderSwList(''); inp.focus();
  }
}

function renderSwList(filter) {
  const list=document.getElementById('iswitchw-list');
  const matches=windows.filter(w=>!filter||w.title.toLowerCase().includes(filter.toLowerCase()));
  list.innerHTML=matches.map((w,i)=>`<div class="sw-item ${i===0?'hi':''}" data-id="${w.id}">${w.el.querySelector('.win-icon').textContent} ${w.title}</div>`).join('')||'<div class="sw-item" style="color:#666">No matches</div>';
  list.querySelectorAll('.sw-item[data-id]').forEach(el=>{
    el.addEventListener('click',()=>{closeWindow(parseInt(el.dataset.id));toggleIswitchw();});
  });
}

document.getElementById('sw-input').addEventListener('input', e=>renderSwList(e.target.value));

function handleIswitchwKey(e) {
  if (e.key==='Escape'){toggleIswitchw();return;}
  if (e.key==='Enter'){
    const f=document.querySelector('#iswitchw-list .sw-item[data-id]');
    if(f){closeWindow(parseInt(f.dataset.id));toggleIswitchw();}
  }
}

// clock
(function tickClock(){
  const n=new Date();
  document.getElementById('taskbar-clock').textContent=String(n.getHours()).padStart(2,'0')+':'+String(n.getMinutes()).padStart(2,'0');
  setTimeout(tickClock,15000);
})();

function startGame() {
  document.getElementById('screen-start').classList.remove('active');
  score=0; combo=1; chaosLevel=0; level=1;
  windows.forEach(w=>w.el.remove()); windows=[];
  scoreEl.textContent=0; comboEl.textContent='x1'; levelEl.textContent=1;
  updateChaosBar(); renderTaskbar();
  gameRunning=true;
  spawnWindow(); resetSpawnTimer();
  chaosTimer=setTimeout(chaosTick,1000);
}

function restartGame() {
  document.getElementById('screen-over').classList.remove('active');
  startGame();
}

function gameOver() {
  gameRunning=false;
  clearTimeout(spawnTimer); clearTimeout(chaosTimer); clearTimeout(comboTimer);
  document.getElementById('final-score').textContent=score;
  const msgs=[[0,'Better stick to the command line. 😅'],[100,"Not bad — try iswitchw next time!"],[300,'Nice work! Jon would approve. 🖥'],[700,'Desktop master! AutoHotKey champion!'],[1200,'LEGENDARY! iswitchw king! 👑']];
  let msg=msgs[0][1];
  for(const [t,m] of msgs) if(score>=t) msg=m;
  document.getElementById('final-msg').textContent=msg;
  document.getElementById('screen-over').classList.add('active');
}
</script>
</body>
</html>
