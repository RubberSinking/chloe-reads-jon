<?php
// A self-contained browser toy; PHP keeps it at home with the rest of Chloe Reads Jon.
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#e7ddc8">
<title>Threshold Test Lab</title>
<style>
:root{--ink:#172128;--paper:#f3ecd9;--cream:#fffaf0;--red:#d84b37;--blue:#1e7283;--yellow:#f2b544;--line:#172128;--muted:#6c6b62;--shadow:5px 6px 0 var(--line)}
*{box-sizing:border-box}
html{scroll-behavior:smooth}
body{margin:0;color:var(--ink);background:var(--paper);font-family:"Nimbus Mono PS","Courier New",monospace;background-image:radial-gradient(#1e72831b 1px,transparent 1px);background-size:13px 13px}
button,input{font:inherit}
button{color:inherit}
.wrap{width:min(1160px,calc(100% - 28px));margin:auto;padding:24px 0 54px}
.mast{display:grid;grid-template-columns:1.25fr .75fr;border:3px solid var(--line);background:var(--cream);box-shadow:var(--shadow);overflow:hidden;position:relative}
.mast:before{content:"FIELD NOTE 017";position:absolute;right:-42px;top:36px;transform:rotate(90deg);font-size:10px;letter-spacing:2px;color:var(--red);font-weight:bold}
.intro{padding:clamp(28px,6vw,72px)}
.kicker{display:inline-block;background:var(--yellow);border:2px solid var(--line);padding:6px 9px;font-size:11px;font-weight:bold;letter-spacing:1.6px;transform:rotate(-1deg)}
h1,h2,h3{font-family:"Iowan Old Style",Baskerville,"Palatino Linotype",serif;line-height:.94;margin:0}
h1{font-size:clamp(58px,9vw,124px);letter-spacing:-5px;margin:21px 0 24px;max-width:750px}
.intro p{font:clamp(16px,2vw,20px)/1.6 "Iowan Old Style",Baskerville,"Palatino Linotype",serif;max-width:630px;margin:0}
.stamp{border-left:3px solid var(--line);background:var(--blue);color:var(--cream);display:grid;place-items:center;padding:30px;min-height:260px}
.seal{width:190px;aspect-ratio:1;border:3px solid currentColor;border-radius:50%;display:grid;place-items:center;text-align:center;transform:rotate(8deg);box-shadow:inset 0 0 0 8px var(--blue),inset 0 0 0 10px currentColor;font-family:"Iowan Old Style",Baskerville,"Palatino Linotype",serif;font-size:25px;line-height:1.05}
.seal small{display:block;font:9px "Nimbus Mono PS","Courier New",monospace;letter-spacing:2px;margin-top:10px}
.tape{margin:38px 0 14px;background:var(--ink);color:var(--cream);padding:10px;overflow:hidden;white-space:nowrap;font-size:11px;letter-spacing:2px}
.tape span{display:inline-block;animation:ticker 18s linear infinite}
@keyframes ticker{to{transform:translateX(-50%)}}
.lab{display:grid;grid-template-columns:minmax(270px,350px) 1fr;border:3px solid var(--line);background:var(--cream);box-shadow:var(--shadow)}
.panel{padding:26px;border-right:3px solid var(--line);background:#e7ddc8}
.eyebrow{color:var(--red);font-size:10px;letter-spacing:2px;font-weight:bold;margin-bottom:9px}
h2{font-size:40px;letter-spacing:-1.5px;margin-bottom:24px}
.control{border-top:2px solid var(--line);padding:19px 0}
.control label,.control-title{font-size:11px;font-weight:bold;display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:13px;text-transform:uppercase;letter-spacing:.5px}
.readout{background:var(--ink);color:var(--cream);padding:3px 7px;min-width:62px;text-align:center}
input[type=range]{width:100%;accent-color:var(--red)}
.options{display:grid;gap:8px}
.choice{border:2px solid var(--line);background:var(--cream);padding:10px 12px;text-align:left;cursor:pointer;transition:.15s;box-shadow:2px 2px 0 transparent}
.choice:hover{transform:translate(-1px,-1px);box-shadow:3px 3px 0 var(--line)}
.choice.active{background:var(--yellow);box-shadow:3px 3px 0 var(--line);transform:translate(-1px,-1px)}
.toggle-row{display:flex;align-items:center;justify-content:space-between;gap:12px;font-size:12px}
.switch{width:52px;height:28px;border:2px solid var(--line);background:var(--cream);padding:2px;cursor:pointer}
.switch:after{content:"";display:block;width:20px;height:20px;background:var(--ink);transition:.2s}
.switch.on{background:var(--yellow)}.switch.on:after{transform:translateX(24px);background:var(--red)}
.stage{min-width:0;padding:clamp(22px,5vw,55px);position:relative;overflow:hidden;background:linear-gradient(180deg,#fffaf0 0 70%,#d5c5a9 70%)}
.stage:after{content:"";position:absolute;left:0;right:0;top:70%;height:3px;background:var(--line)}
.test-label{position:absolute;top:18px;right:18px;border:2px solid var(--line);padding:6px 9px;background:var(--cream);font-size:10px;z-index:3}
.doorway{height:390px;max-width:580px;margin:26px auto 0;position:relative;border-left:34px solid var(--blue);border-right:34px solid var(--blue);border-top:22px solid var(--blue);filter:drop-shadow(8px 8px 0 #17212826)}
.gate{position:absolute;left:0;right:0;bottom:0;height:250px;transform-origin:left center;transition:transform .65s cubic-bezier(.2,.9,.25,1.2);z-index:2}
.gate.open{transform:perspective(700px) rotateY(-68deg)}
.rail{height:18px;background:var(--red);border:3px solid var(--line);position:absolute;left:-7px;right:-7px}.rail.top{top:0}.rail.bottom{bottom:18px}
.bars{position:absolute;inset:18px 7px 36px;display:flex;justify-content:space-evenly}
.bar{width:12px;background:#f8d277;border:3px solid var(--line);border-top:0;border-bottom:0}
.hinge{position:absolute;left:-13px;width:25px;height:36px;border:3px solid var(--line);background:var(--ink);z-index:3}.hinge.a{top:34px}.hinge.b{bottom:62px}
.latch{position:absolute;right:-20px;top:29px;width:74px;height:52px;background:var(--yellow);border:3px solid var(--line);display:grid;place-items:center;font-size:9px;font-weight:bold;cursor:pointer;box-shadow:3px 3px 0 var(--line)}
.threshold{position:absolute;left:-9px;right:-9px;bottom:0;height:22px;background:var(--ink);z-index:3}
.threshold.flat{height:6px;background:var(--blue)}
.person{position:absolute;left:10%;bottom:18px;font-size:50px;z-index:4;transition:left .8s ease,transform .3s;filter:grayscale(1)}
.person.cross{left:80%}.person.bump{transform:rotate(-18deg) translateY(-6px)}
.measure{position:absolute;left:6px;right:6px;bottom:-44px;border-top:2px solid var(--ink);text-align:center;font-size:10px;padding-top:6px;z-index:4}
.measure:before,.measure:after{content:"";position:absolute;top:-6px;height:10px;border-left:2px solid var(--ink)}.measure:before{left:0}.measure:after{right:0}
.runbar{position:relative;z-index:5;margin-top:78px;display:flex;flex-wrap:wrap;gap:10px;justify-content:center}
.run{border:3px solid var(--line);background:var(--red);color:white;padding:14px 20px;font-weight:bold;cursor:pointer;box-shadow:4px 4px 0 var(--line);transition:.15s}
.run:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 var(--line)}
.run:active{transform:translate(2px,2px);box-shadow:1px 1px 0 var(--line)}
.open-btn{background:var(--cream);color:var(--ink)}
.report{margin-top:38px;display:grid;grid-template-columns:1fr 1fr;gap:24px}
.card{border:3px solid var(--line);background:var(--cream);box-shadow:var(--shadow);padding:clamp(22px,4vw,40px)}
.scoreboard{display:grid;grid-template-columns:160px 1fr;gap:28px;align-items:center}
.dial{aspect-ratio:1;border:18px solid #e6dcc8;border-radius:50%;display:grid;place-items:center;position:relative;background:conic-gradient(var(--blue) 0deg,var(--blue) var(--score),#e6dcc8 var(--score));box-shadow:inset 0 0 0 3px var(--line);transition:.6s}
.dial:after{content:"";position:absolute;inset:12px;background:var(--cream);border:3px solid var(--line);border-radius:50%}
.dial strong{position:relative;z-index:2;font:48px "Iowan Old Style",Baskerville,"Palatino Linotype",serif}.dial small{font:9px "Nimbus Mono PS","Courier New",monospace;display:block;text-align:center}
.barscore{display:grid;gap:14px}.metric{display:grid;grid-template-columns:90px 1fr 34px;gap:8px;align-items:center;font-size:10px}.meter{height:13px;border:2px solid var(--line);background:#e7ddc8}.fill{height:100%;background:var(--red);width:40%;transition:.6s}
.verdict{border-left:12px solid var(--yellow)}
.verdict h3{font-size:32px;margin:4px 0 13px}.verdict p{font:17px/1.5 "Iowan Old Style",Baskerville,"Palatino Linotype",serif;margin:0}.log{margin-top:18px;border-top:2px dashed var(--line);padding-top:14px;font-size:11px;line-height:1.7;color:var(--muted);min-height:55px}
.source{margin:34px auto 0;text-align:center;font-size:11px}.source a{color:var(--blue);font-weight:bold}.source a:hover{color:var(--red)}
.legend{display:flex;gap:15px;justify-content:center;margin-top:12px;font-size:9px;text-transform:uppercase;letter-spacing:1px}.dot{display:inline-block;width:10px;height:10px;border:2px solid var(--line);margin-right:5px;vertical-align:-1px}
.shake{animation:shake .09s 7}@keyframes shake{50%{transform:translateX(5px)}}
.flash{animation:flash .5s 2}@keyframes flash{50%{background:#f2b544}}
@media(max-width:780px){.mast{grid-template-columns:1fr}.stamp{border-left:0;border-top:3px solid var(--line);min-height:220px}.lab{grid-template-columns:1fr}.panel{border-right:0;border-bottom:3px solid var(--line)}.doorway{height:330px}.gate{height:210px}.report{grid-template-columns:1fr}.scoreboard{grid-template-columns:120px 1fr}.dial{border-width:13px}.dial strong{font-size:36px}h1{letter-spacing:-3px}.stage{padding-bottom:38px}}
@media(max-width:440px){.wrap{width:min(100% - 18px,1160px);padding-top:9px}.intro{padding:25px 20px}h1{font-size:56px}.scoreboard{grid-template-columns:1fr}.dial{width:135px;margin:auto}.metric{grid-template-columns:78px 1fr 28px}.doorway{border-left-width:24px;border-right-width:24px}.person{font-size:38px}.runbar{margin-top:66px}.report{gap:15px}.card{box-shadow:3px 4px 0 var(--line)}}
@media(prefers-reduced-motion:reduce){*,*:before,*:after{animation-duration:.01ms!important;transition-duration:.01ms!important}}
</style>
</head>
<body>
<main class="wrap">
  <header class="mast">
    <div class="intro">
      <span class="kicker">DOMESTIC ENGINEERING BUREAU</span>
      <h1>Threshold<br>Test Lab</h1>
      <p>Engineer the tiny barrier everyone must use twenty times a day. Safe enough for a determined explorer. Civilized enough for a grown-up carrying tea.</p>
    </div>
    <div class="stamp"><div class="seal">TESTED<br>UNDER<br>REAL LIFE<small>EST. 2017 / REOPENED 2026</small></div></div>
  </header>

  <div class="tape"><span>WIDTH • LATCH • AUTO-CLOSE • THRESHOLD • ONE-HAND TEST • TODDLER TEST • MIDNIGHT TEST • &nbsp;&nbsp; WIDTH • LATCH • AUTO-CLOSE • THRESHOLD • ONE-HAND TEST • TODDLER TEST • MIDNIGHT TEST • &nbsp;&nbsp;</span></div>

  <section class="lab">
    <aside class="panel">
      <div class="eyebrow">CONFIGURATION DESK</div>
      <h2>Build the barrier.</h2>
      <div class="control">
        <label for="width">Door opening <span class="readout" id="widthOut">36 in</span></label>
        <input id="width" type="range" min="28" max="48" value="36">
      </div>
      <div class="control">
        <div class="control-title">Latch mechanism</div>
        <div class="options" id="latches">
          <button class="choice" data-latch="lift">Lift + thumb</button>
          <button class="choice active" data-latch="squeeze">One-hand squeeze</button>
          <button class="choice" data-latch="slide">Slide + lift puzzle</button>
        </div>
      </div>
      <div class="control">
        <div class="toggle-row"><span>Auto-close hinge</span><button class="switch on" id="auto" aria-label="Toggle auto-close" aria-pressed="true"></button></div>
      </div>
      <div class="control">
        <div class="toggle-row"><span>Low-profile sill</span><button class="switch" id="sill" aria-label="Toggle low-profile sill" aria-pressed="false"></button></div>
      </div>
      <div class="control">
        <label for="traffic">Daily crossings <span class="readout" id="trafficOut">20</span></label>
        <input id="traffic" type="range" min="4" max="40" step="2" value="20">
      </div>
    </aside>

    <div class="stage" id="stage">
      <div class="test-label">RIG A / KITCHEN DOORWAY</div>
      <div class="doorway" id="doorway">
        <div class="gate" id="gate">
          <div class="rail top"></div><div class="rail bottom"></div>
          <div class="bars" id="gateBars"></div>
          <i class="hinge a"></i><i class="hinge b"></i>
          <button class="latch" id="latch">PRESS<br>TO OPEN</button>
          <div class="threshold" id="threshold"></div>
        </div>
        <div class="person" id="person">♟</div>
        <div class="measure" id="measure">36 IN / PRESSURE FIT</div>
      </div>
      <div class="runbar">
        <button class="run open-btn" id="tryGate">Try the gate</button>
        <button class="run" id="runTests">Run 5 stress tests</button>
      </div>
    </div>
  </section>

  <section class="report" aria-live="polite">
    <article class="card scoreboard">
      <div class="dial" id="dial" style="--score:259deg"><strong id="score">72<small>/ 100</small></strong></div>
      <div class="barscore">
        <div class="metric"><span>SECURITY</span><div class="meter"><div class="fill" id="security"></div></div><b id="securityN">78</b></div>
        <div class="metric"><span>ONE-HAND</span><div class="meter"><div class="fill" id="onehand"></div></div><b id="onehandN">84</b></div>
        <div class="metric"><span>FLOW</span><div class="meter"><div class="fill" id="flow"></div></div><b id="flowN">63</b></div>
      </div>
    </article>
    <article class="card verdict">
      <div class="eyebrow">BUREAU FINDING</div>
      <h3 id="verdictTitle">Promising prototype.</h3>
      <p id="verdictText">Run the household tests. A good gate is not merely hard to cross; it is easy for the right person to cross.</p>
      <div class="log" id="log">Awaiting clipboard data…</div>
    </article>
  </section>

  <div class="legend"><span><i class="dot" style="background:var(--red)"></i>barrier</span><span><i class="dot" style="background:var(--yellow)"></i>human factors</span><span><i class="dot" style="background:var(--blue)"></i>architecture</span></div>
  <p class="source">Inspired by Jon's <a href="https://jona.ca/2017/01/pressure-mounted-baby-gate-comparison.html" target="_blank" rel="noopener">Pressure-mounted baby gate comparison</a>, a heroic piece of research into the engineering of ordinary life.</p>
</main>
<script>
const $=s=>document.querySelector(s);
const state={width:36,latch:'squeeze',auto:true,sill:false,traffic:20};
const els={gate:$('#gate'),person:$('#person'),stage:$('#stage'),threshold:$('#threshold'),measure:$('#measure'),log:$('#log')};
function bars(){const count=Math.max(5,Math.round(state.width/4.7));$('#gateBars').innerHTML='<i class="bar"></i>'.repeat(count);els.measure.textContent=`${state.width} IN / PRESSURE FIT`;}
function setToggle(el,key){el.addEventListener('click',()=>{state[key]=!state[key];el.classList.toggle('on',state[key]);el.setAttribute('aria-pressed',state[key]);if(key==='sill')els.threshold.classList.toggle('flat',state.sill);calculate(false);});}
$('#width').addEventListener('input',e=>{state.width=+e.target.value;$('#widthOut').textContent=state.width+' in';bars();calculate(false)});
$('#traffic').addEventListener('input',e=>{state.traffic=+e.target.value;$('#trafficOut').textContent=state.traffic;calculate(false)});
$('#latches').addEventListener('click',e=>{const b=e.target.closest('[data-latch]');if(!b)return;document.querySelectorAll('[data-latch]').forEach(x=>x.classList.remove('active'));b.classList.add('active');state.latch=b.dataset.latch;calculate(false)});
setToggle($('#auto'),'auto');setToggle($('#sill'),'sill');
function operate(){els.gate.classList.add('open');els.person.classList.remove('bump');setTimeout(()=>els.person.classList.add('cross'),170);if(state.auto)setTimeout(()=>{els.gate.classList.remove('open');setTimeout(()=>els.person.classList.remove('cross'),600)},1300)}
$('#tryGate').addEventListener('click',()=>{if(state.latch==='slide'){els.gate.classList.add('shake');els.log.textContent='Latch requests a small two-step ritual: slide, then lift. Secure, but tea-hand compatibility is disputed.';setTimeout(()=>{els.gate.classList.remove('shake');operate()},650)}else operate()});
$('#latch').addEventListener('click',operate);
function calculate(showLog=true){
  let security=66+(state.latch==='slide'?18:state.latch==='lift'?10:4)+(state.auto?7:0)-(state.width>42?(state.width-42)*2:0)-(state.sill?3:0);
  let onehand=state.latch==='squeeze'?94:state.latch==='lift'?70:42;
  let flow=88-(state.traffic-4)*.75+(state.auto?8:-4)+(state.sill?13:-6)-(state.width>44?5:0);
  security=Math.round(Math.max(25,Math.min(99,security)));onehand=Math.round(onehand);flow=Math.round(Math.max(25,Math.min(99,flow)));
  const score=Math.round(security*.45+onehand*.25+flow*.3);
  $('#score').innerHTML=score+'<small>/ 100</small>';$('#dial').style.setProperty('--score',score*3.6+'deg');
  [['security',security],['onehand',onehand],['flow',flow]].forEach(([id,n])=>{$('#'+id).style.width=n+'%';$('#'+id+'N').textContent=n});
  let title='Promising prototype.',text='A sensible balance, with one or two domestic negotiations still hiding in the hardware.';
  if(score>=86){title='Threshold diplomacy achieved.';text='Secure for the small explorer, merciful to the grown-up. The Bureau would happily cross this twenty times before lunch.'}
  else if(score<62){title='Return to the workshop.';text='The barrier works, but daily friction has become part of the furniture. Adjust the latch, sill, or hinge before deployment.'}
  $('#verdictTitle').textContent=title;$('#verdictText').textContent=text;
  if(showLog)els.log.innerHTML=`✓ Shake: ${security>75?'held firm':'noticeable flex'} &nbsp;•&nbsp; ✓ Mug carry: ${onehand>75?'clean pass':'awkward'}<br>✓ Midnight crossing: ${state.sill?'toes preserved':'sill detected'} &nbsp;•&nbsp; ✓ Swing: ${state.auto?'self-latched':'left ajar'} &nbsp;•&nbsp; ✓ Rush hour: ${flow>65?'civilized':'queue formed'}`;
  return score;
}
$('#runTests').addEventListener('click',()=>{
  const btn=$('#runTests');btn.disabled=true;btn.textContent='TESTING…';els.stage.classList.add('flash');els.gate.classList.add('shake');els.person.classList.add('bump');els.log.textContent='SHAKE / MUG / MIDNIGHT / SWING / RUSH HOUR…';
  setTimeout(()=>{els.stage.classList.remove('flash');els.gate.classList.remove('shake');els.person.classList.remove('bump');operate();calculate(true);btn.disabled=false;btn.textContent='Run 5 stress tests'},1250);
});
bars();calculate(false);
</script>
</body>
</html>
