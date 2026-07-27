<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#101813">
<title>Waybar Habitat | Chloe Reads Jon</title>
<style>
:root{
    --night:#101813;
    --moss:#223529;
    --bar:#17221b;
    --glass:rgba(26,39,31,.86);
    --cream:#f4efdc;
    --muted:#aeb9a9;
    --acid:#c9ff55;
    --peach:#ff916f;
    --sky:#74d7e7;
    --violet:#c5a7ff;
    --density:9px;
}
*{box-sizing:border-box}
html{scroll-behavior:smooth}
body{
    margin:0;
    min-height:100vh;
    color:var(--cream);
    font-family:"Iowan Old Style","Palatino Linotype",Palatino,serif;
    background:
      radial-gradient(circle at 12% 14%,rgba(116,215,231,.11),transparent 25rem),
      radial-gradient(circle at 82% 18%,rgba(201,255,85,.08),transparent 30rem),
      linear-gradient(150deg,#0a0f0c 0%,#152019 53%,#0b100d 100%);
}
body::before{
    content:"";position:fixed;inset:0;pointer-events:none;opacity:.24;
    background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 160 160' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.09'/%3E%3C/svg%3E");
}
a{color:var(--acid)}
button,input,select{font:inherit}
button{touch-action:manipulation}
.shell{width:min(1180px,100%);margin:auto;padding:22px clamp(14px,3vw,34px) 56px}
.eyebrow{
    margin:0 0 12px;color:var(--acid);font:700 .72rem/1.2 ui-monospace,"Cascadia Mono",monospace;
    letter-spacing:.18em;text-transform:uppercase;
}
header{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(240px,.8fr);gap:30px;align-items:end;margin:28px 0 30px}
h1{font-size:clamp(3rem,8vw,7rem);font-weight:400;line-height:.79;letter-spacing:-.065em;margin:0;max-width:780px}
h1 em{display:block;color:var(--acid);font-weight:700}
.intro{border-left:1px solid #6b796d;padding-left:22px;color:#d4dacd;font-size:1.06rem;line-height:1.58;margin:0 0 4px}
.desktop{
    position:relative;min-height:440px;overflow:hidden;border:1px solid #536157;border-radius:5px 5px 28px 28px;
    background:
      linear-gradient(160deg,transparent 0 51%,rgba(9,18,13,.85) 51.2% 100%),
      radial-gradient(ellipse at 68% 42%,#e9d892 0 1.4%,rgba(233,216,146,.16) 1.8% 6%,transparent 6.2%),
      linear-gradient(150deg,#284e48,#121c17 68%);
    box-shadow:0 30px 80px rgba(0,0,0,.42),inset 0 0 100px rgba(0,0,0,.2);
}
.desktop::before,.desktop::after{
    content:"";position:absolute;bottom:-30px;width:56%;height:67%;border-radius:50% 50% 0 0;
    background:linear-gradient(145deg,#294831,#101a13);transform:rotate(-12deg);filter:drop-shadow(0 -12px 20px rgba(0,0,0,.24))
}
.desktop::before{left:-10%}.desktop::after{right:-15%;height:50%;transform:rotate(15deg);background:#1d3124}
.waybar{
    position:relative;z-index:5;display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:10px;
    min-height:43px;padding:5px 7px;background:var(--bar);border-bottom:1px solid color-mix(in srgb,var(--acid) 30%,transparent);
    font:700 .75rem/1 ui-monospace,"Cascadia Mono","Courier New",monospace;
    box-shadow:0 10px 35px rgba(0,0,0,.35);transition:background .3s;
}
.bar-zone{display:flex;align-items:center;gap:5px;min-width:0}
.bar-zone.center{justify-content:center}.bar-zone.right{justify-content:flex-end}
.module{
    display:inline-flex;align-items:center;gap:6px;white-space:nowrap;padding:var(--density) calc(var(--density) + 2px);
    border:1px solid rgba(244,239,220,.15);border-radius:4px;background:rgba(255,255,255,.045);
    animation:moduleIn .28s both;transition:padding .25s,background .25s,transform .2s;
}
.module:hover{background:rgba(201,255,85,.12);transform:translateY(1px)}
.module.workspaces{color:var(--acid)}.module.clock{color:var(--cream)}.module.weather{color:var(--sky)}
.module.audio{color:var(--peach)}.module.network{color:var(--violet)}.module.battery{color:var(--acid)}
@keyframes moduleIn{from{opacity:0;transform:translateY(-8px)}}
.window{
    position:absolute;z-index:2;left:8%;top:23%;width:min(570px,70%);min-height:225px;border:1px solid #4e6154;
    border-radius:9px;background:rgba(8,13,10,.8);box-shadow:0 24px 55px rgba(0,0,0,.42);backdrop-filter:blur(12px);
}
.window-head{padding:10px 14px;border-bottom:1px solid #36443a;color:#91a095;font:600 .7rem ui-monospace,monospace}
.dots{float:right;color:var(--peach);letter-spacing:5px}
.terminal{padding:25px;color:#cfd7cb;font:500 clamp(.72rem,2vw,.92rem)/1.8 ui-monospace,"Cascadia Mono",monospace}
.terminal .prompt{color:var(--acid)}.terminal .comment{color:#6f8475}.cursor{display:inline-block;width:8px;height:1.05em;background:var(--acid);vertical-align:-2px;animation:blink 1s steps(1) infinite}
@keyframes blink{50%{opacity:0}}
.sprout{position:absolute;z-index:3;right:8%;bottom:10%;font-size:clamp(4rem,12vw,8rem);filter:drop-shadow(0 12px 8px rgba(0,0,0,.4));transform:rotate(4deg)}
.caption{position:absolute;z-index:4;right:4%;top:23%;width:21%;font:italic 1rem/1.35 Georgia,serif;color:#cad4c9;text-align:right}
.grid{display:grid;grid-template-columns:minmax(0,1fr) minmax(310px,.75fr);gap:18px;margin-top:18px}
.panel{background:var(--glass);border:1px solid #415046;border-radius:18px;padding:clamp(17px,3vw,26px);box-shadow:0 15px 45px rgba(0,0,0,.19);backdrop-filter:blur(16px)}
.panel h2{margin:0 0 6px;font-size:clamp(1.35rem,3vw,2rem);font-weight:500;letter-spacing:-.02em}
.hint{margin:0 0 20px;color:var(--muted);line-height:1.45;font-size:.92rem}
.modules{display:grid;gap:8px}
.module-row{
    display:grid;grid-template-columns:36px minmax(0,1fr) auto;align-items:center;gap:10px;padding:10px;
    background:rgba(255,255,255,.035);border:1px solid #38473d;border-radius:10px;
}
.toggle{
    width:30px;height:30px;border:1px solid #637166;border-radius:7px;background:#151d18;color:#728077;cursor:pointer;
    font:800 1rem ui-monospace,monospace
}
.toggle.on{color:#15200f;background:var(--acid);border-color:var(--acid)}
.module-name{font:700 .85rem ui-monospace,monospace}.module-desc{display:block;color:#92a095;font:400 .72rem/1.4 ui-monospace,monospace;margin-top:3px}
.move-set{display:flex;gap:5px}
.move-set button,.small-btn{
    border:1px solid #617066;background:#162019;color:#e5eadf;border-radius:7px;min-width:30px;height:30px;cursor:pointer
}
.move-set button:hover,.small-btn:hover{border-color:var(--acid);color:var(--acid)}
.fields{display:grid;grid-template-columns:1fr 1fr;gap:13px}
label{display:grid;gap:7px;color:#cbd3c8;font-size:.83rem}
input,select{
    min-width:0;width:100%;border:1px solid #536258;border-radius:8px;padding:10px 11px;color:var(--cream);background:#101713;
    font:600 .82rem ui-monospace,monospace;outline:none
}
input:focus,select:focus{border-color:var(--acid);box-shadow:0 0 0 3px rgba(201,255,85,.1)}
input[type=color]{height:40px;padding:4px;cursor:pointer}
.wide{grid-column:1/-1}
.range-line{display:flex;align-items:center;gap:10px}.range-line output{font:700 .8rem ui-monospace,monospace;color:var(--acid);min-width:34px}
input[type=range]{accent-color:var(--acid);padding:0}
.actions{display:flex;gap:9px;flex-wrap:wrap;margin-top:18px}
.primary,.ghost,.danger{
    border:1px solid var(--acid);border-radius:8px;padding:11px 14px;cursor:pointer;font:800 .77rem ui-monospace,monospace;
}
.primary{background:var(--acid);color:#172010}.ghost{background:transparent;color:var(--acid)}.danger{background:transparent;border-color:var(--peach);color:var(--peach)}
.primary:hover,.ghost:hover,.danger:hover{transform:translateY(-1px);filter:brightness(1.1)}
.diagnostic{margin-top:15px;padding:13px;border:1px dashed #59685e;border-radius:9px;color:#b8c3b7;font:500 .77rem/1.55 ui-monospace,monospace}
.diagnostic.good{border-color:rgba(201,255,85,.55);color:var(--acid)}.diagnostic.bad{border-color:var(--peach);color:#ffb49e}
.code-panel{margin-top:18px}
.code-head{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:10px}
.code-head h2{margin:0}.code-head button{width:auto;padding:0 12px}
pre{margin:0;max-height:290px;overflow:auto;padding:18px;border-radius:11px;background:#080c09;border:1px solid #354138;color:#bcd4bf;font:500 .75rem/1.65 ui-monospace,"Cascadia Mono",monospace;white-space:pre-wrap}
.key{color:var(--sky)}.string{color:var(--acid)}
.source{margin:24px auto 0;text-align:center;color:#9ca99e;line-height:1.6;font-size:.9rem}.source a{text-underline-offset:3px}
.toast{position:fixed;z-index:20;left:50%;bottom:22px;transform:translate(-50%,20px);padding:11px 16px;border-radius:999px;background:var(--cream);color:#172019;font:800 .78rem ui-monospace,monospace;opacity:0;pointer-events:none;transition:.25s}
.toast.show{opacity:1;transform:translate(-50%,0)}
@media(max-width:760px){
    header,.grid{grid-template-columns:1fr}header{gap:18px}.intro{max-width:600px}
    .desktop{min-height:380px}.window{left:5%;width:84%;top:27%}.caption{display:none}.sprout{right:2%}
    .waybar{grid-template-columns:1fr auto}.bar-zone.center{display:none}.bar-zone.right{overflow:hidden}
}
@media(max-width:470px){
    .shell{padding-inline:10px}h1{font-size:3.5rem}.fields{grid-template-columns:1fr}.wide{grid-column:auto}
    .module-row{grid-template-columns:34px 1fr}.move-set{grid-column:2}.desktop{min-height:335px}
    .window{width:90%;left:5%;top:30%}.terminal{padding:18px}.module.weather,.module.network{display:none}
}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}}
</style>
</head>
<body>
<main class="shell">
    <header>
        <div>
            <p class="eyebrow">plain text, living desktop · lab 07/27</p>
            <h1>Waybar <em>Habitat</em></h1>
        </div>
        <p class="intro">Cultivate a tiny Linux status bar. Add useful creatures, move them into place, and see the config grow underneath. Then release a gremlin and practise diagnosing it.</p>
    </header>

    <section class="desktop" aria-label="Live Waybar preview">
        <div class="waybar">
            <div class="bar-zone left" id="barLeft"></div>
            <div class="bar-zone center" id="barCenter"></div>
            <div class="bar-zone right" id="barRight"></div>
        </div>
        <div class="window">
            <div class="window-head">~/dotfiles/waybar/config.jsonc <span class="dots">● ● ●</span></div>
            <div class="terminal">
                <span class="comment">// a desktop you can explain</span><br>
                <span class="prompt">chloe@omarchy</span> $ waybar --reload<br>
                habitat healthy · <span id="moduleCount">6</span> modules awake<br>
                <span class="prompt">chloe@omarchy</span> $ <span class="cursor"></span>
            </div>
        </div>
        <div class="caption">A status bar should answer a glance, not conduct an interrogation.</div>
        <div class="sprout" aria-hidden="true">🪴</div>
    </section>

    <div class="grid">
        <section class="panel">
            <p class="eyebrow">01 · population</p>
            <h2>Choose the inhabitants</h2>
            <p class="hint">Toggle modules and nudge them through the bar. The preview and config update instantly.</p>
            <div class="modules" id="moduleList"></div>
        </section>

        <section class="panel">
            <p class="eyebrow">02 · climate</p>
            <h2>Tune the habitat</h2>
            <p class="hint">A little personal context is the difference between “a Linux desktop” and <em>your</em> Linux desktop.</p>
            <div class="fields">
                <label class="wide">Workspace names
                    <input id="workspaceNames" value="CODE  WEB  CHAT" maxlength="32" aria-label="Workspace names">
                </label>
                <label>Clock format
                    <select id="clockFormat">
                        <option value="24">23:42 · MON 27</option>
                        <option value="12">11:42 PM · MON 27</option>
                        <option value="gentle">MONDAY · LATE</option>
                    </select>
                </label>
                <label>Accent
                    <input id="accent" type="color" value="#c9ff55">
                </label>
                <label class="wide">Breathing room
                    <span class="range-line"><input id="density" type="range" min="4" max="14" value="9"><output id="densityOut">9px</output></span>
                </label>
            </div>
            <div class="actions">
                <button class="primary" id="saveBtn">save specimen</button>
                <button class="ghost" id="resetBtn">restore wild type</button>
                <button class="danger" id="gremlinBtn">release gremlin</button>
            </div>
            <div class="diagnostic good" id="diagnostic" role="status">✓ Config parses cleanly. The habitat is calm.</div>
        </section>
    </div>

    <section class="panel code-panel">
        <div class="code-head">
            <div>
                <p class="eyebrow">03 · field notes</p>
                <h2>Your generated config</h2>
            </div>
            <button class="small-btn" id="copyBtn">copy</button>
        </div>
        <pre id="configCode" aria-live="polite"></pre>
    </section>

    <p class="source">This little desktop garden was inspired by Jon’s <a href="https://jona.ca/2025/12/trying-out-omarchy-linux-with-claude.html">Trying out Omarchy Linux with Claude Code</a>, where editable text files made AI feel like a sysadmin sitting beside him.</p>
</main>
<div class="toast" id="toast" role="status"></div>
<script>
const defaults = [
  {id:'workspaces', icon:'◈', label:'workspaces', desc:'named rooms for different kinds of attention', zone:'left', on:true},
  {id:'window', icon:'⌁', label:'active window', desc:'what has the keyboard right now', zone:'left', on:true},
  {id:'clock', icon:'◷', label:'clock', desc:'time without the tiny-calendar squint', zone:'center', on:true},
  {id:'weather', icon:'☁', label:'weather', desc:'Surrey sky, compressed into one glance', zone:'right', on:true},
  {id:'audio', icon:'♪', label:'audio', desc:'volume and current listening state', zone:'right', on:true},
  {id:'network', icon:'⌁', label:'network', desc:'whether the wires are behaving', zone:'right', on:true},
  {id:'battery', icon:'▰', label:'battery', desc:'portable-computer mortality gauge', zone:'right', on:false}
];
let modules = defaults.map(x => ({...x}));
let gremlin = false;
const $ = id => document.getElementById(id);

function escapeHtml(s){return s.replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]))}
function displayFor(m){
  const names = $('workspaceNames').value.trim() || '1  2  3';
  const clock = $('clockFormat').value;
  const values = {
    workspaces:names, window:'⌁ habitat.php', clock:clock==='12'?'11:42 PM · MON 27':clock==='gentle'?'MONDAY · LATE':'23:42 · MON 27',
    weather:'☁ 18°', audio:'♪ 42%', network:'⌁ home', battery:'▰ 86%'
  };
  return values[m.id];
}
function renderList(){
  $('moduleList').innerHTML = modules.map((m,i)=>`
    <div class="module-row">
      <button class="toggle ${m.on?'on':''}" data-toggle="${m.id}" aria-pressed="${m.on}" aria-label="Toggle ${escapeHtml(m.label)}">${m.on?'✓':'·'}</button>
      <div><span class="module-name">${m.icon} ${escapeHtml(m.label)}</span><span class="module-desc">${escapeHtml(m.desc)}</span></div>
      <div class="move-set">
        <button data-move="${m.id}" data-dir="-1" aria-label="Move ${escapeHtml(m.label)} left">←</button>
        <button data-move="${m.id}" data-dir="1" aria-label="Move ${escapeHtml(m.label)} right">→</button>
      </div>
    </div>`).join('');
}
function renderBar(){
  ['left','center','right'].forEach(zone=>{
    const target = $('bar'+zone[0].toUpperCase()+zone.slice(1));
    target.innerHTML = modules.filter(m=>m.on&&m.zone===zone).map(m=>`<span class="module ${m.id}">${escapeHtml(displayFor(m))}</span>`).join('');
  });
  $('moduleCount').textContent = modules.filter(m=>m.on).length;
}
function configText(){
  const zones = zone => modules.filter(m=>m.on&&m.zone===zone).map(m=>`"${m.id==='window'?'hyprland/window':m.id}"`).join(', ');
  const names = $('workspaceNames').value.trim().split(/\s{2,}|\s*[,|]\s*/).filter(Boolean);
  const formats = {24:'{:%H:%M · %a %d}',12:'{:%I:%M %p · %a %d}',gentle:'{:%A} · LATE'};
  const comma = gremlin ? '' : ',';
  return `{
  "layer": "top",
  "modules-left": [${zones('left')}],
  "modules-center": [${zones('center')}],
  "modules-right": [${zones('right')}]${comma}
  "hyprland/workspaces": {
    "format": "{name}",
    "persistent-workspaces": ${JSON.stringify(names)}
  },
  "clock": { "format": "${formats[$('clockFormat').value]}" },
  "custom/habitat": { "accent": "${$('accent').value}" }
}`;
}
function renderConfig(){
  $('configCode').innerHTML = escapeHtml(configText())
    .replace(/(&quot;[^&]+?&quot;)(?=\s*:)/g,'<span class="key">$1</span>')
    .replace(/:\s*(&quot;.*?&quot;)/g,': <span class="string">$1</span>');
}
function renderAll(){renderList();renderBar();renderConfig()}
function showToast(message){$('toast').textContent=message;$('toast').classList.add('show');setTimeout(()=>$('toast').classList.remove('show'),1700)}
function diagnose(){
  const box=$('diagnostic');
  if(gremlin){
    box.className='diagnostic bad';
    box.textContent='✕ Parse error near line 5: expected a comma after modules-right. Tiny punctuation, enormous opinions.';
  }else{
    box.className='diagnostic good';
    box.textContent='✓ Config parses cleanly. The habitat is calm.';
  }
}
$('moduleList').addEventListener('click',e=>{
  const toggle=e.target.closest('[data-toggle]');
  if(toggle){const m=modules.find(x=>x.id===toggle.dataset.toggle);m.on=!m.on;renderAll();return}
  const move=e.target.closest('[data-move]');
  if(move){
    const i=modules.findIndex(x=>x.id===move.dataset.move), next=i+Number(move.dataset.dir);
    if(next<0||next>=modules.length)return;
    [modules[i],modules[next]]=[modules[next],modules[i]];
    const zones=['left','center','right'], visible=modules.filter(m=>m.on);
    const current=modules[next]; if(move.dataset.dir==='1'&&visible.indexOf(current)===visible.length-1)current.zone=zones[Math.min(2,zones.indexOf(current.zone)+1)];
    if(move.dataset.dir==='-1'&&visible.indexOf(current)===0)current.zone=zones[Math.max(0,zones.indexOf(current.zone)-1)];
    renderAll();
  }
});
['workspaceNames','clockFormat'].forEach(id=>$(id).addEventListener('input',()=>{renderBar();renderConfig()}));
$('accent').addEventListener('input',e=>{document.documentElement.style.setProperty('--acid',e.target.value);renderConfig()});
$('density').addEventListener('input',e=>{document.documentElement.style.setProperty('--density',e.target.value+'px');$('densityOut').textContent=e.target.value+'px'});
$('gremlinBtn').addEventListener('click',()=>{gremlin=!gremlin;$('gremlinBtn').textContent=gremlin?'evict gremlin':'release gremlin';diagnose();renderConfig();showToast(gremlin?'gremlin deployed':'gremlin escorted out')});
$('saveBtn').addEventListener('click',()=>{
  const state={modules,names:$('workspaceNames').value,clock:$('clockFormat').value,accent:$('accent').value,density:$('density').value};
  localStorage.setItem('waybar-habitat',JSON.stringify(state));showToast('specimen saved locally');
});
$('resetBtn').addEventListener('click',()=>{
  modules=defaults.map(x=>({...x}));$('workspaceNames').value='CODE  WEB  CHAT';$('clockFormat').value='24';$('accent').value='#c9ff55';$('density').value='9';
  document.documentElement.style.setProperty('--acid','#c9ff55');document.documentElement.style.setProperty('--density','9px');$('densityOut').textContent='9px';
  gremlin=false;$('gremlinBtn').textContent='release gremlin';localStorage.removeItem('waybar-habitat');diagnose();renderAll();showToast('wild type restored');
});
$('copyBtn').addEventListener('click',async()=>{try{await navigator.clipboard.writeText(configText());showToast('config copied')}catch(e){showToast('copy blocked by browser')}});
try{
  const saved=JSON.parse(localStorage.getItem('waybar-habitat'));
  if(saved){
    modules=saved.modules||modules;$('workspaceNames').value=saved.names||'CODE  WEB  CHAT';$('clockFormat').value=saved.clock||'24';
    $('accent').value=saved.accent||'#c9ff55';$('density').value=saved.density||'9';$('densityOut').textContent=$('density').value+'px';
    document.documentElement.style.setProperty('--acid',$('accent').value);document.documentElement.style.setProperty('--density',$('density').value+'px');
  }
}catch(e){}
renderAll();
</script>
</body>
</html>
