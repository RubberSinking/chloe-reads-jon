<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#092f32">
<title>Clipboard Archaeology</title>
<style>
@import url('data:text/css,');
:root{--ink:#082f32;--deep:#061f22;--paper:#f2e6c8;--paper2:#d8c69d;--amber:#ffb627;--rust:#c8522f;--mint:#90cbb8;--black:#041416;--shadow:#031719aa}
*{box-sizing:border-box}
html{scroll-behavior:smooth}
body{margin:0;background:var(--deep);color:var(--paper);font-family:"Trebuchet MS",Candara,sans-serif;min-height:100vh;overflow-x:hidden}
body:before{content:"";position:fixed;inset:0;pointer-events:none;z-index:30;opacity:.16;background-image:repeating-linear-gradient(0deg,transparent 0 3px,#fff 4px),radial-gradient(circle at 20% 10%,#fff 0 1px,transparent 1px);background-size:auto,11px 13px;mix-blend-mode:overlay}
a{color:inherit}
.topbar{height:44px;display:flex;align-items:center;justify-content:space-between;padding:0 clamp(16px,4vw,54px);border-bottom:1px solid #4d858077;background:#052729;font:700 12px/1 Consolas,"Courier New",monospace;letter-spacing:.12em;text-transform:uppercase;position:relative;z-index:5}
.topbar a{text-decoration:none}.status{display:flex;align-items:center;gap:8px;color:var(--mint)}.lamp{width:8px;height:8px;border-radius:50%;background:#70e2a5;box-shadow:0 0 13px #70e2a5}
.hero{min-height:560px;display:grid;align-items:end;position:relative;isolation:isolate;background:#051c1f url('clipboard-archaeology.png') center/cover no-repeat;border-bottom:8px solid #bb7a27}
.hero:after{content:"";position:absolute;inset:0;z-index:-1;background:linear-gradient(90deg,#04191deb 0%,#04191d8e 47%,#04191d21 75%),linear-gradient(0deg,#061f22 0%,transparent 46%)}
.hero-copy{width:min(720px,92vw);padding:80px clamp(20px,6vw,88px) 68px;animation:arrive .8s cubic-bezier(.2,.8,.2,1) both}
.eyebrow{display:inline-flex;gap:9px;align-items:center;color:var(--amber);font:700 12px/1 Consolas,"Courier New",monospace;letter-spacing:.2em;text-transform:uppercase;margin-bottom:19px}.eyebrow:before{content:"";width:34px;border-top:2px solid}
h1{font-family:Georgia,"Times New Roman",serif;font-size:clamp(55px,9vw,116px);font-weight:400;line-height:.78;letter-spacing:-.06em;margin:0;text-shadow:0 7px 30px #000}.hero h1 em{display:block;color:var(--amber);font-style:italic;margin-left:clamp(22px,7vw,100px)}
.dek{font:16px/1.55 Consolas,"Courier New",monospace;max-width:570px;margin:30px 0 0;color:#f8edcf}.key{display:inline-block;border:1px solid #ecdba9;border-bottom-width:3px;border-radius:4px;padding:2px 6px;background:#11383a;color:#fff;font-size:.85em}
main{width:min(1180px,94vw);margin:0 auto;padding:70px 0 90px}
.brief{display:grid;grid-template-columns:1.1fr .9fr;gap:24px;margin-bottom:34px}.casefile,.progress-panel{border:1px solid #8a7046;background:linear-gradient(135deg,#f3e8cb,#d5c095);color:var(--ink);box-shadow:11px 13px 0 #04191d;padding:26px;position:relative}.casefile:before{content:"CASE 0216";position:absolute;right:18px;top:15px;transform:rotate(3deg);border:2px solid var(--rust);color:var(--rust);padding:6px;font:700 11px Consolas,monospace;letter-spacing:.15em}.kicker{font:700 11px Consolas,monospace;letter-spacing:.18em;text-transform:uppercase;color:#925621}.casefile h2,.progress-panel h2{font:400 clamp(27px,4vw,44px)/1 Georgia,serif;margin:8px 0 12px}.casefile p{line-height:1.55;max-width:610px;margin:0}.progress-panel{background:#0a393a;color:var(--paper);border-color:#49736b}.slots{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-top:15px}.slot{min-height:70px;border:1px dashed #90b0a8;display:grid;place-items:center;text-align:center;padding:6px;font:700 10px/1.25 Consolas,monospace;letter-spacing:.08em;color:#82a49c;transition:.35s}.slot.found{color:#092f32;background:var(--amber);border-style:solid;transform:translateY(-3px);box-shadow:0 5px 0 #6a3b18}.case-count{font:12px Consolas,monospace;color:var(--mint)}
.workbench{display:grid;grid-template-columns:minmax(0,1fr) 290px;gap:18px;align-items:start}.machine{background:#092f32;border:2px solid #567e72;box-shadow:0 0 0 6px #041b1e,0 18px 50px #0008;min-width:0}.machine-head{padding:13px 16px;border-bottom:1px solid #567e72;display:flex;justify-content:space-between;align-items:center;font:11px Consolas,monospace;letter-spacing:.1em}.buttons{display:flex;gap:6px}.buttons i{display:block;width:10px;height:10px;border-radius:50%;background:#c54f2f}.buttons i:nth-child(2){background:#e6a722}.buttons i:nth-child(3){background:#69aa83}
.search-wrap{position:relative;padding:19px;background:#052426}.search-wrap label{position:absolute;left:32px;top:50%;transform:translateY(-50%);font:32px Georgia,serif;color:#ba7427;pointer-events:none}.search{width:100%;border:1px solid #a0783a;background:#f2e6c8;color:#082f32;padding:17px 55px;font:700 18px Consolas,monospace;outline:none;box-shadow:inset 0 3px 7px #604c3044}.search:focus{border-color:var(--amber);box-shadow:0 0 0 3px #ffb62744,inset 0 3px 7px #604c3044}.clear{position:absolute;right:31px;top:50%;transform:translateY(-50%);border:0;background:none;font-size:22px;color:#7b5c34;cursor:pointer}
.archive{height:540px;overflow:auto;padding:10px;background-color:#0a3133;background-image:linear-gradient(#0d3b3d 1px,transparent 1px),linear-gradient(90deg,#0d3b3d 1px,transparent 1px);background-size:20px 20px;scrollbar-color:#c17d27 #061f22}.clip{display:grid;grid-template-columns:54px 1fr auto;gap:11px;align-items:center;width:100%;text-align:left;border:1px solid #8c7a57;background:#e9ddbd;color:#092f32;margin:8px 0;padding:12px;cursor:pointer;box-shadow:3px 4px 0 #03191a;transition:transform .15s,filter .15s;animation:slip .35s both}.clip:hover,.clip:focus{transform:translateX(6px);filter:brightness(1.08);outline:2px solid var(--amber)}.clip.matched{border-left:7px solid var(--amber)}.clip.collected{opacity:.45;filter:grayscale(.6);pointer-events:none}.clip-icon{font:700 10px Consolas,monospace;border:1px solid #8d774e;background:#d0bd91;height:44px;display:grid;place-items:center}.clip b{display:block;font:700 13px/1.3 Consolas,monospace;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.clip small{display:block;color:#6b5b3f;margin-top:5px}.clip time{font:10px Consolas,monospace;color:#876d47}.empty{display:none;text-align:center;padding:90px 20px;color:#88aaa2;font:15px Consolas,monospace}.empty.show{display:block}
.drawer{background:#0c3435;border:2px solid #567e72;padding:18px;box-shadow:8px 10px 0 #03191a;position:sticky;top:14px}.drawer h3{font:400 31px/1 Georgia,serif;margin:5px 0 17px;color:var(--amber)}.mission{border-top:1px solid #52716c;padding:14px 0;opacity:.47;transition:.3s}.mission.active{opacity:1}.mission.done{opacity:.55}.mission strong{display:block;font:700 11px Consolas,monospace;text-transform:uppercase;letter-spacing:.1em;color:var(--mint)}.mission p{font-size:13px;line-height:1.45;margin:7px 0 0}.hint{border:0;background:var(--rust);color:white;font:700 11px Consolas,monospace;padding:10px 12px;cursor:pointer;margin-top:16px;box-shadow:0 4px 0 #672516}.hint:active{transform:translateY(3px);box-shadow:0 1px 0 #672516}
.toast{position:fixed;left:50%;bottom:25px;z-index:40;transform:translate(-50%,130px);background:var(--amber);color:#092f32;padding:14px 20px;border:2px solid #fff0c5;box-shadow:8px 8px 0 #021719;font:700 13px Consolas,monospace;transition:.35s;max-width:90vw}.toast.show{transform:translate(-50%,0)}
.finale{display:none;margin-top:28px;border:1px solid #bd923d;background:var(--paper);color:var(--ink);padding:clamp(24px,5vw,54px);box-shadow:12px 14px 0 #020f11;position:relative;overflow:hidden}.finale.show{display:block;animation:arrive .7s both}.finale:after{content:"RECOVERED";position:absolute;right:-28px;top:31px;transform:rotate(12deg);border:5px double var(--rust);color:var(--rust);padding:10px;font:700 clamp(16px,3vw,28px) Consolas,monospace;opacity:.75}.finale h2{font:400 clamp(36px,6vw,70px)/.95 Georgia,serif;margin:0 0 18px;max-width:660px}.finale p{max-width:680px;line-height:1.6}.finale button{border:0;background:var(--ink);color:var(--paper);padding:13px 18px;font:700 12px Consolas,monospace;cursor:pointer}
.source{margin-top:65px;padding-top:26px;border-top:1px solid #52716c;text-align:center;font:14px/1.6 Georgia,serif;color:#9bc1b6}.source a{color:var(--amber)}
@keyframes arrive{from{opacity:0;transform:translateY(25px)}to{opacity:1;transform:none}}@keyframes slip{from{opacity:0;transform:translateX(-15px)}}
@media(max-width:800px){.brief,.workbench{grid-template-columns:1fr}.drawer{position:relative;top:0;display:grid;grid-template-columns:repeat(2,1fr);gap:0 15px}.drawer h3,.drawer>.kicker,.drawer>.hint{grid-column:1/-1}.archive{height:500px}.hero{min-height:550px}.hero-copy{padding-bottom:50px}.hero h1{font-size:clamp(56px,18vw,90px)}.topbar span:last-child{display:none}}
@media(max-width:480px){.slots{grid-template-columns:repeat(2,1fr)}.drawer{display:block}.clip{grid-template-columns:42px 1fr}.clip time{display:none}.hero h1 em{margin-left:16px}.brief{margin-bottom:25px}.casefile:before{display:none}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;scroll-behavior:auto!important;transition:none!important}}
</style>
</head>
<body>
<nav class="topbar"><a href="index.php">← Chloe Reads Jon</a><span class="status"><i class="lamp"></i>Archive online</span><span>Ditto Retrieval Bureau / 2006</span></nav>
<header class="hero">
  <div class="hero-copy">
    <div class="eyebrow">Clipboard Retrieval Bureau</div>
    <h1>Clipboard <em>Archaeology</em></h1>
    <p class="dek">Somewhere in 1,000 old copies is the project Jon was trying to finish. Search as he did: type a fragment, watch the archive narrow <em>instantly</em>, and recover the evidence. No dusty scrolling required. Try <span class="key">Ctrl</span> + <span class="key">K</span>.</p>
  </div>
</header>
<main>
  <section class="brief">
    <article class="casefile">
      <div class="kicker">Incoming assignment</div>
      <h2>The vanished launch kit</h2>
      <p>A useful little web tool was nearly ready, then its four essential pieces disappeared into an unruly clipboard history. Follow the clues, search the fragments, and click the right copy to reconstruct it.</p>
    </article>
    <aside class="progress-panel">
      <div class="kicker">Evidence board</div><h2>Recovered <span id="count">0</span>/4</h2>
      <div class="slots" id="slots">
        <div class="slot">01<br>NAME</div><div class="slot">02<br>COLOUR</div><div class="slot">03<br>LINK</div><div class="slot">04<br>MOTTO</div>
      </div>
    </aside>
  </section>
  <section class="workbench">
    <div class="machine">
      <div class="machine-head"><span>DITTO // INCREMENTAL INDEX</span><span class="buttons"><i></i><i></i><i></i></span></div>
      <div class="search-wrap"><label for="search">⌕</label><input class="search" id="search" autocomplete="off" spellcheck="false" placeholder="type to sift 18 copies…"><button class="clear" id="clear" aria-label="Clear search">×</button></div>
      <div class="archive" id="archive" aria-live="polite"></div>
      <div class="empty" id="empty">Nothing in this layer. Try fewer letters.</div>
    </div>
    <aside class="drawer">
      <div class="kicker">Recovery sequence</div><h3>Four fragments</h3>
      <div id="missions"></div>
      <button class="hint" id="hint">Nudge the search lamp</button>
    </aside>
  </section>
  <section class="finale" id="finale">
    <h2>The launch kit lives again.</h2>
    <p><strong>THREADLIGHT</strong> is a tiny tool for finding the thought you meant to return to. Petrol blue, launched at <strong>/threadlight</strong>, and governed by the unimprovable motto: <em>Find the thread. Keep moving.</em></p>
    <p>You just experienced why incremental search made Ditto beautiful: retrieval becomes recognition. You do not remember where an item is. You remember one distinctive scrap, and the pile disappears around it.</p>
    <button id="again">Re-file the evidence</button>
  </section>
  <footer class="source">Built from a wonderfully specific enthusiasm: <a href="https://jona.ca/2006/02/ditto-windows-clipboard-extender-with.html" target="_blank" rel="noopener">Jon’s “Ditto — Windows clipboard extender with incremental search”</a>.</footer>
</main>
<div class="toast" id="toast" role="status"></div>
<script>
const clips=[
 {t:'TEXT',v:'Can we move lunch to 12:30?',when:'10:04'},
 {t:'HEX',v:'#082f32',when:'10:11',key:1},
 {t:'URL',v:'https://example.test/research',when:'10:18'},
 {t:'CODE',v:'const archive = entries.filter(match);',when:'10:23'},
 {t:'TEXT',v:'Find the thread. Keep moving.',when:'10:31',key:3},
 {t:'MAIL',v:'Thanks, this looks ready to ship.',when:'10:36'},
 {t:'PATH',v:'/threadlight',when:'10:42',key:2},
 {t:'TEXT',v:'milk, apples, batteries, tape',when:'10:47'},
 {t:'CODE',v:'box-shadow: 0 8px 0 #061f22;',when:'10:53'},
 {t:'URL',v:'https://jona.ca',when:'11:02'},
 {t:'NAME',v:'THREADLIGHT',when:'11:06',key:0},
 {t:'TEXT',v:'The meeting room is on floor 4.',when:'11:08'},
 {t:'CODE',v:'git commit -m "quietly useful"',when:'11:14'},
 {t:'HEX',v:'#ffb627',when:'11:19'},
 {t:'TEXT',v:'Remember to charge the scooter',when:'11:25'},
 {t:'URL',v:'https://example.test/weather',when:'11:28'},
 {t:'CODE',v:'localStorage.setItem("idea", note)',when:'11:31'},
 {t:'TEXT',v:'A good tool gets out of the way.',when:'11:33'}
];
const clues=[
 {title:'01 / The project name',text:'A beam of light that helps you follow an idea. Search for “thread”.',term:'thread'},
 {title:'02 / The house colour',text:'Deep blue-green, expressed as a six-character web colour. Search “#08”.',term:'#08'},
 {title:'03 / The launch path',text:'A relative destination sharing the project’s name. Search “/thread”.',term:'/thread'},
 {title:'04 / The motto',text:'Five words. It begins like the name and ends in motion. Search “moving”.',term:'moving'}
];
let found=[false,false,false,false], active=0, hintStep=0;
const archive=document.querySelector('#archive'), search=document.querySelector('#search'), empty=document.querySelector('#empty'), toast=document.querySelector('#toast');
function esc(s){return s.replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]))}
function render(){
 const q=search.value.toLowerCase(); let visible=0; archive.innerHTML='';
 clips.forEach((c,i)=>{if(!c.v.toLowerCase().includes(q)&&!c.t.toLowerCase().includes(q))return;visible++;
  const b=document.createElement('button');b.className='clip'+(q?' matched':'')+(c.key!==undefined&&found[c.key]?' collected':'');b.style.animationDelay=Math.min(visible*.025,.25)+'s';b.innerHTML=`<span class="clip-icon">${c.t}</span><span><b>${highlight(esc(c.v),esc(q))}</b><small>clipboard item ${String(i+1).padStart(4,'0')}</small></span><time>${c.when}</time>`;b.onclick=()=>inspect(c);archive.appendChild(b)
 });
 empty.classList.toggle('show',!visible);archive.style.display=visible?'block':'none';
}
function highlight(s,q){if(!q)return s;const i=s.toLowerCase().indexOf(q.toLowerCase());return i<0?s:s.slice(0,i)+'<mark>'+s.slice(i,i+q.length)+'</mark>'+s.slice(i+q.length)}
function inspect(c){
 if(c.key===active&&!found[c.key]){found[c.key]=true;active++;ping(880);say('Fragment recovered: '+c.v);update();search.value='';render();}
 else if(c.key!==undefined&&found[c.key]) say('Already pinned to the evidence board.');
 else {ping(180);say(c.key!==undefined?'Right evidence, wrong layer. Follow the current clue.':'A convincing scrap of digital sediment. Not today’s evidence.');}
}
function update(){
 document.querySelector('#count').textContent=found.filter(Boolean).length;
 [...document.querySelectorAll('.slot')].forEach((s,i)=>{s.classList.toggle('found',found[i]);if(found[i])s.innerHTML=['THREAD<br>LIGHT','#082F32','/THREAD<br>LIGHT','KEEP<br>MOVING'][i]});
 document.querySelector('#missions').innerHTML=clues.map((c,i)=>`<div class="mission ${i===active?'active':''} ${found[i]?'done':''}"><strong>${found[i]?'✓ ':i===active?'→ ':'○ '}${c.title}</strong><p>${found[i]?'Recovered and filed.':c.text}</p></div>`).join('');
 if(active===4){document.querySelector('#finale').classList.add('show');setTimeout(()=>document.querySelector('#finale').scrollIntoView({behavior:'smooth',block:'center'}),350);confetti()}
}
function say(s){toast.textContent=s;toast.classList.add('show');clearTimeout(say.t);say.t=setTimeout(()=>toast.classList.remove('show'),2700)}
function ping(freq){try{const a=new(window.AudioContext||window.webkitAudioContext)(),o=a.createOscillator(),g=a.createGain();o.type='square';o.frequency.value=freq;g.gain.setValueAtTime(.025,a.currentTime);g.gain.exponentialRampToValueAtTime(.001,a.currentTime+.09);o.connect(g).connect(a.destination);o.start();o.stop(a.currentTime+.1)}catch(e){}}
function confetti(){for(let i=0;i<24;i++){let x=document.createElement('i');Object.assign(x.style,{position:'fixed',zIndex:50,left:(45+Math.random()*10)+'%',top:'45%',width:'7px',height:'13px',background:i%2?'#ffb627':'#90cbb8',pointerEvents:'none',transition:'1.2s cubic-bezier(.1,.8,.3,1)'});document.body.appendChild(x);requestAnimationFrame(()=>{x.style.transform=`translate(${(Math.random()-.5)*700}px,${Math.random()*500-300}px) rotate(${Math.random()*800}deg)`;x.style.opacity='0'});setTimeout(()=>x.remove(),1300)}}
search.addEventListener('input',render);document.querySelector('#clear').onclick=()=>{search.value='';search.focus();render()};
document.addEventListener('keydown',e=>{if((e.ctrlKey||e.metaKey)&&e.key.toLowerCase()==='k'){e.preventDefault();search.focus();search.select()}});
document.querySelector('#hint').onclick=()=>{search.value=clues[Math.min(active,3)].term.slice(0,++hintStep);if(hintStep>=clues[Math.min(active,3)].term.length)hintStep=0;search.dispatchEvent(new Event('input'));search.focus()};
document.querySelector('#again').onclick=()=>{found=[false,false,false,false];active=0;document.querySelector('#finale').classList.remove('show');update();search.value='';render();window.scrollTo({top:document.querySelector('.brief').offsetTop-25,behavior:'smooth'})};
update();render();
</script>
</body>
</html>
