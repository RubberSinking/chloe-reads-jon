<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0a100d">
  <title>The Gentle Interrupter</title>
  <style>
    :root{--ink:#e9edcf;--dim:#9eaa88;--night:#080d0b;--panel:#101814;--green:#b9f57e;--deep:#183323;--amber:#f5b84b;--line:#304032;--danger:#ed805c}
    *{box-sizing:border-box}html{background:var(--night);scroll-behavior:smooth}body{margin:0;color:var(--ink);background:radial-gradient(circle at 78% 18%,#17271c 0,transparent 28rem),var(--night);font-family:"Palatino Linotype",Palatino,Book Antiqua,serif;min-height:100vh}
    button,select,textarea{font:inherit}button{cursor:pointer}.noise{position:fixed;inset:0;pointer-events:none;z-index:20;opacity:.045;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}
    .hero{min-height:82vh;position:relative;display:grid;align-items:end;overflow:hidden;border-bottom:1px solid var(--line);background:#080d0b url('flowkeeper-night.webp') center/cover no-repeat}.hero:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(5,9,7,.1),rgba(5,9,7,.32) 52%,rgba(5,9,7,.88) 100%),linear-gradient(0deg,#080d0b 0,transparent 46%)}
    .hero-copy{position:relative;z-index:2;width:min(760px,92%);margin:0 6vw 7vh auto;text-align:right}.eyebrow,.mono{font-family:"Courier New",monospace;text-transform:uppercase;letter-spacing:.16em}.eyebrow{font-size:.72rem;color:var(--amber);margin-bottom:1rem}.hero h1{font-family:Baskerville,"Times New Roman",serif;font-size:clamp(3.2rem,9vw,8.4rem);font-weight:400;line-height:.78;letter-spacing:-.06em;margin:0;text-wrap:balance}.hero h1 em{display:block;color:var(--green);font-weight:400}.hero p{color:#c9d0b7;font-size:clamp(1rem,2vw,1.25rem);line-height:1.55;max-width:600px;margin:1.8rem 0 0 auto}.down{display:inline-flex;margin-top:1.3rem;color:var(--ink);text-decoration:none;border-bottom:1px solid var(--amber);padding:.5rem 0}
    main{width:min(1180px,calc(100% - 28px));margin:0 auto;padding:72px 0 90px}.intro{display:grid;grid-template-columns:.8fr 1.2fr;gap:clamp(30px,7vw,100px);margin-bottom:48px}.intro h2{font-size:clamp(2rem,5vw,4.6rem);line-height:.95;font-weight:400;margin:0}.intro p{color:var(--dim);font-size:1.08rem;line-height:1.75;margin:0}.intro strong{color:var(--ink);font-weight:400}
    .console{border:1px solid var(--line);background:linear-gradient(145deg,rgba(20,31,25,.96),rgba(9,15,12,.98));box-shadow:0 30px 80px #0008;position:relative;overflow:hidden}.console:before{content:"FLOWKEEPER / MODEL 2007";display:block;padding:12px 18px;border-bottom:1px solid var(--line);color:#71806b;font:10px "Courier New",monospace;letter-spacing:.2em}.console-grid{display:grid;grid-template-columns:1.45fr .55fr}.workbench{padding:clamp(20px,5vw,54px);border-right:1px solid var(--line)}.status-row{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:22px}.state{display:flex;align-items:center;gap:10px;color:var(--green);font:700 .75rem "Courier New",monospace;letter-spacing:.12em}.lamp{width:10px;height:10px;border-radius:50%;background:var(--green);box-shadow:0 0 18px var(--green);animation:pulse 2s infinite}.state.waiting{color:var(--amber)}.state.waiting .lamp{background:var(--amber);box-shadow:0 0 18px var(--amber)}@keyframes pulse{50%{opacity:.4}}
    .clock{font:clamp(2.4rem,7vw,6.2rem)/1 "Courier New",monospace;letter-spacing:-.08em;color:var(--ink);margin:0 0 8px}.clock-label{color:var(--dim);font-style:italic}.writer{width:100%;min-height:235px;resize:vertical;margin:30px 0 18px;padding:23px;background:#07100a;border:1px solid #33523b;color:var(--green);caret-color:var(--amber);font:1rem/1.7 "Courier New",monospace;outline:none;box-shadow:inset 0 0 40px #020;transition:.25s}.writer:focus{border-color:#6b9f68;box-shadow:inset 0 0 40px #020,0 0 0 3px #b9f57e10}.writer::placeholder{color:#54705a}
    .timeline{height:52px;display:flex;gap:3px;align-items:end;padding:8px 0;border-top:1px solid var(--line);border-bottom:1px solid var(--line)}.tick{flex:1;min-width:2px;background:#26392b;height:12%;transition:.35s}.tick.hot{height:90%;background:var(--green)}.tick.warm{height:48%;background:#6e9b5d}.legend{display:flex;justify-content:space-between;color:#6f7e6b;font:10px "Courier New",monospace;margin-top:8px}
    .side{padding:28px 24px;display:flex;flex-direction:column;gap:26px}.metric{padding-bottom:24px;border-bottom:1px solid var(--line)}.metric:last-of-type{border:0}.metric b{display:block;font:400 2.1rem "Courier New",monospace;color:var(--amber)}.metric span{font-size:.78rem;color:var(--dim)}label{display:block;color:var(--dim);font-size:.82rem;margin-bottom:7px}select{width:100%;color:var(--ink);background:#0a110d;border:1px solid var(--line);padding:11px;border-radius:0}.buttons{display:grid;gap:9px;margin-top:auto}.primary,.secondary{border:1px solid var(--green);padding:13px 16px;background:var(--green);color:#0a100d;font:700 .72rem "Courier New",monospace;letter-spacing:.08em;text-transform:uppercase}.secondary{background:transparent;color:var(--green);border-color:#49624c}.primary:hover{filter:brightness(1.1)}.secondary:hover{border-color:var(--green)}
    .how{display:grid;grid-template-columns:repeat(3,1fr);gap:1px;background:var(--line);border:1px solid var(--line);margin-top:70px}.card{background:var(--night);padding:32px}.card i{display:block;color:var(--amber);font:normal 2rem "Courier New",monospace;margin-bottom:24px}.card h3{font-weight:400;font-size:1.35rem;margin:0 0 10px}.card p{color:var(--dim);line-height:1.6;margin:0;font-size:.94rem}
    .source{margin:58px auto 0;text-align:center;color:var(--dim);font-style:italic}.source a{color:var(--green);text-underline-offset:4px}.back{display:inline-block;margin-top:15px;color:#7c8975;font:11px "Courier New",monospace;text-transform:uppercase;letter-spacing:.1em}
    .break-screen{position:fixed;inset:0;z-index:50;background:rgba(5,10,7,.96);display:grid;place-items:center;padding:24px;opacity:0;visibility:hidden;transition:.4s}.break-screen.open{opacity:1;visibility:visible}.break-card{text-align:center;max-width:560px}.orb{width:clamp(170px,40vw,300px);aspect-ratio:1;border:1px solid #6d965f;border-radius:50%;margin:0 auto 30px;display:grid;place-items:center;box-shadow:0 0 80px #6fc34b18,inset 0 0 50px #6fc34b12;animation:breathe 8s ease-in-out infinite}.orb:before{content:"";width:62%;aspect-ratio:1;border-radius:50%;background:radial-gradient(circle,#b9f57e88,#52853d22 65%,transparent 68%);animation:breathe 8s ease-in-out infinite reverse}@keyframes breathe{50%{transform:scale(1.12)}}.break-card h2{font-size:clamp(2rem,7vw,4.4rem);font-weight:400;margin:0}.break-card p{color:var(--dim);line-height:1.6}.break-count{color:var(--amber);font:1.1rem "Courier New",monospace;margin:18px}.skip{background:none;border:0;color:#87937f;text-decoration:underline;padding:12px}
    .toast{position:fixed;right:18px;bottom:18px;z-index:30;background:var(--ink);color:#10150f;padding:13px 18px;font:12px "Courier New",monospace;transform:translateY(100px);transition:.35s}.toast.show{transform:translateY(0)}
    @media(max-width:760px){.hero{min-height:720px;background-position:34% center}.hero:after{background:linear-gradient(0deg,#080d0b 0,rgba(5,9,7,.75) 48%,rgba(5,9,7,.1) 100%)}.hero-copy{margin:0 auto 7vh;text-align:left}.hero p{margin-left:0}.intro{grid-template-columns:1fr}.console-grid{grid-template-columns:1fr}.workbench{border-right:0;border-bottom:1px solid var(--line)}.how{grid-template-columns:1fr}.clock{font-size:3.4rem}.side{display:grid;grid-template-columns:1fr 1fr}.side .buttons{grid-column:1/-1}.metric{border-bottom:0;padding:0}.settings{grid-column:1/-1}}
    @media(prefers-reduced-motion:reduce){*,*:before{animation:none!important;scroll-behavior:auto!important;transition:none!important}}
  </style>
</head>
<body>
<div class="noise"></div>
<header class="hero">
  <div class="hero-copy">
    <div class="eyebrow">An experiment in humane software</div>
    <h1>The Gentle <em>Interrupter</em></h1>
    <p>A break timer with manners. It notices when you are flowing, waits at the door, and only knocks when your hands finally go still.</p>
    <a class="down" href="#experiment">Try the 45-second experiment ↓</a>
  </div>
</header>
<main id="experiment">
  <section class="intro">
    <h2>What if your timer could read the room?</h2>
    <p>Ordinary break timers fire precisely when ordered, even if you are halfway through the sentence that finally explains everything. <strong>This tiny lab watches only activity inside this page</strong>, then demonstrates a kinder rule: when rest is due, preserve the flow and wait for a natural pause.</p>
  </section>
  <section class="console" aria-label="Flow-aware break timer experiment">
    <div class="console-grid">
      <div class="workbench">
        <div class="status-row"><div class="state" id="state"><span class="lamp"></span><span id="stateText">READY TO BEGIN</span></div><div class="mono" id="pauseReadout">quiet 0.0s</div></div>
        <div class="clock" id="clock">00:45</div>
        <div class="clock-label" id="clockLabel">until rest is due</div>
        <textarea class="writer" id="writer" spellcheck="false" placeholder="Press Start, then type here as if a thought is gathering…"></textarea>
        <div class="timeline" id="timeline" aria-label="Recent activity timeline"></div>
        <div class="legend"><span>50 seconds ago</span><span>activity now</span></div>
      </div>
      <aside class="side">
        <div class="metric"><b id="protected">0s</b><span>flow protected after break became due</span></div>
        <div class="metric"><b id="interruptions">0</b><span>badly timed interruptions avoided</span></div>
        <div class="settings">
          <label for="dueSelect">Break becomes due after</label><select id="dueSelect"><option value="20">20 sec · quick demo</option><option value="45" selected>45 sec · recommended</option><option value="90">90 sec · leisurely</option></select>
          <label for="quietSelect" style="margin-top:14px">Natural pause means</label><select id="quietSelect"><option value="2">2 quiet seconds</option><option value="4" selected>4 quiet seconds</option><option value="8">8 quiet seconds</option></select>
        </div>
        <div class="buttons"><button class="primary" id="start">Start experiment</button><button class="secondary" id="dueNow">Make break due now</button></div>
      </aside>
    </div>
  </section>
  <section class="how">
    <article class="card"><i>01</i><h3>Notice, locally</h3><p>Keystrokes and pointer movement make the activity trace jump. Nothing is sent or saved.</p></article>
    <article class="card"><i>02</i><h3>Wait intelligently</h3><p>When the clock reaches zero during activity, the timer waits instead of barging in.</p></article>
    <article class="card"><i>03</i><h3>Use the clearing</h3><p>After a few quiet seconds, the break arrives in the gap you naturally created.</p></article>
  </section>
  <p class="source">Inspired by Jon’s <a href="https://jona.ca/2007/01/software-im-trying-out-darkroom-and.html">“Software I'm trying out: DarkRoom and RSIGuard”</a>.</p>
  <p style="text-align:center"><a class="back" href="index.php">← Back to Chloe Reads Jon</a></p>
</main>
<div class="break-screen" id="breakScreen" role="dialog" aria-modal="true" aria-labelledby="breakTitle"><div class="break-card"><div class="orb" aria-hidden="true"></div><div class="eyebrow">You found a clearing</div><h2 id="breakTitle">Let your hands be still.</h2><p>Look beyond the screen. Drop your shoulders. Take one slow breath before deciding what comes next.</p><div class="break-count" id="breakCount">20 seconds</div><button class="skip" id="skip">Return when ready</button></div></div>
<div class="toast" id="toast" role="status"></div>
<script>
(()=>{
  const $=s=>document.querySelector(s), timeline=$('#timeline'), bars=[];
  for(let i=0;i<50;i++){const b=document.createElement('span');b.className='tick';timeline.append(b);bars.push(b)}
  let running=false,due=false,remaining=45,lastActivity=0,protectedMs=0,lastFrame=0,breakTimer=null,activity=0;
  const clock=$('#clock'),state=$('#state'),stateText=$('#stateText'),writer=$('#writer');
  function fmt(s){s=Math.max(0,Math.ceil(s));return String(Math.floor(s/60)).padStart(2,'0')+':'+String(s%60).padStart(2,'0')}
  function signal(){if(!running)return;lastActivity=performance.now();activity=Math.min(1,activity+.55);if(due){$('#interruptions').textContent='1';state.classList.add('waiting');stateText.textContent='BREAK DUE · PROTECTING FLOW'}}
  ['keydown','pointermove','pointerdown','touchstart'].forEach(e=>document.addEventListener(e,signal,{passive:true}));
  function start(){remaining=Number($('#dueSelect').value);running=true;due=false;protectedMs=0;lastActivity=performance.now();lastFrame=performance.now();activity=0;$('#protected').textContent='0s';$('#interruptions').textContent='0';state.classList.remove('waiting');stateText.textContent='LISTENING FOR ACTIVITY';$('#clockLabel').textContent='until rest is due';$('#start').textContent='Restart experiment';writer.focus();requestAnimationFrame(loop)}
  function loop(now){if(!running)return;const dt=Math.min(100,now-lastFrame);lastFrame=now;activity*=.94;if(!due){remaining-=dt/1000;if(remaining<=0){remaining=0;due=true;state.classList.add('waiting');stateText.textContent='BREAK DUE · WAITING FOR A PAUSE';$('#clockLabel').textContent='waiting politely';toast('Break due. Keep going — I will wait.')}}else{protectedMs+=dt;const quiet=(now-lastActivity)/1000;$('#pauseReadout').textContent='quiet '+quiet.toFixed(1)+'s';$('#protected').textContent=Math.floor(protectedMs/1000)+'s';if(quiet>=Number($('#quietSelect').value)){openBreak();return}}
    clock.textContent=fmt(remaining);requestAnimationFrame(loop)}
  setInterval(()=>{const b=bars.shift();b.className='tick '+(activity>.55?'hot':activity>.12?'warm':'');timeline.append(b);bars.push(b)},1000);
  function openBreak(){running=false;stateText.textContent='NATURAL PAUSE FOUND';$('#breakScreen').classList.add('open');let n=20;$('#breakCount').textContent=n+' seconds';breakTimer=setInterval(()=>{n--;$('#breakCount').textContent=n>0?n+' seconds':'break complete';if(n<=0){clearInterval(breakTimer);setTimeout(closeBreak,700)}},1000)}
  function closeBreak(){clearInterval(breakTimer);$('#breakScreen').classList.remove('open');state.classList.remove('waiting');stateText.textContent='RESTED · READY';clock.textContent='00:00';$('#clockLabel').textContent='experiment complete'}
  function toast(t){const el=$('#toast');el.textContent=t;el.classList.add('show');setTimeout(()=>el.classList.remove('show'),3200)}
  $('#start').addEventListener('click',start);$('#dueNow').addEventListener('click',()=>{if(!running)start();remaining=0.01;signal()});$('#skip').addEventListener('click',closeBreak);
})();
</script>
</body>
</html>
