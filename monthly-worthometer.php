<?php
$sourceUrl = 'https://jona.ca/2015/05/jons-1-month-rule.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#e8dfcb">
<title>The Monthly Worthometer</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@300;400;500&family=Fraunces:opsz,wght@9..144,600;9..144,800&display=swap');
:root{--paper:#e8dfcb;--ink:#1d2824;--orange:#e45b30;--green:#1e6653;--cream:#f7f0de;--line:#776f5f;--shadow:#19211d}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--paper);color:var(--ink);font-family:'DM Mono',monospace;min-height:100vh;background-image:radial-gradient(#847b681c 1px,transparent 1px);background-size:5px 5px}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.13;background:repeating-linear-gradient(0deg,transparent 0 3px,#fff 4px)}
.wrap{width:min(1080px,100%);margin:auto;padding:24px 18px 64px}.top{display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid var(--ink);padding:5px 0 13px;font-size:11px;letter-spacing:.12em;text-transform:uppercase}.back{color:inherit;text-decoration:none}.status{display:flex;align-items:center;gap:8px}.lamp{width:9px;height:9px;border-radius:50%;background:#65a378;box-shadow:0 0 0 3px #65a37833}
header{padding:clamp(46px,8vw,92px) 0 38px;display:grid;grid-template-columns:1.25fr .75fr;gap:40px;align-items:end}h1{font-family:Fraunces,serif;font-size:clamp(50px,9vw,108px);font-weight:800;line-height:.8;letter-spacing:-.055em;margin:0;max-width:850px}h1 em{display:block;color:var(--orange);font-style:normal}.intro{font-family:Fraunces,serif;font-size:19px;line-height:1.45;margin:0;border-left:3px solid var(--orange);padding-left:18px}.intro strong{font-family:'DM Mono';font-size:12px;text-transform:uppercase;letter-spacing:.08em;display:block;margin-bottom:8px}
.machine{background:var(--cream);border:2px solid var(--ink);box-shadow:9px 9px 0 var(--shadow);display:grid;grid-template-columns:1.1fr .9fr;position:relative}.machine:before{content:"J.A. / CONSUMER LAB / 01";position:absolute;right:10px;top:-23px;font-size:9px;letter-spacing:.12em}.controls{padding:clamp(22px,4vw,44px);border-right:2px solid var(--ink)}label{font-size:11px;font-weight:500;letter-spacing:.07em;text-transform:uppercase;display:block;margin-bottom:8px}.field{margin-bottom:25px}input[type=text],input[type=number]{width:100%;border:0;border-bottom:2px solid var(--ink);background:transparent;padding:8px 2px;font:600 22px Fraunces;color:var(--ink);border-radius:0;outline:none}input:focus{border-color:var(--orange)}.pair{display:grid;grid-template-columns:1fr 1fr;gap:20px}.slider-row{display:grid;grid-template-columns:1fr 55px;align-items:center;gap:15px}.readout{background:var(--ink);color:#d1f08d;text-align:center;padding:7px 4px;font-size:13px;box-shadow:inset 0 0 8px #000}.ticks{display:flex;justify-content:space-between;font-size:8px;margin-top:5px;color:#6a6559}input[type=range]{width:100%;accent-color:var(--orange)}button{width:100%;border:2px solid var(--ink);background:var(--orange);color:#fff8e7;padding:16px;font:500 13px 'DM Mono';letter-spacing:.08em;text-transform:uppercase;cursor:pointer;box-shadow:4px 4px 0 var(--ink);transition:.15s}button:hover{transform:translate(-1px,-1px);box-shadow:6px 6px 0 var(--ink)}button:active{transform:translate(3px,3px);box-shadow:1px 1px 0 var(--ink)}
.result{padding:clamp(22px,4vw,44px);display:flex;flex-direction:column;justify-content:space-between;background:#d7cfbb}.dial{width:min(280px,100%);aspect-ratio:2/1;overflow:hidden;margin:0 auto 25px;position:relative}.arc{position:absolute;width:100%;aspect-ratio:1;border-radius:50%;border:38px solid var(--green);border-left-color:#b9ad91;border-bottom-color:#b9ad91;transform:rotate(-45deg);top:0}.needle{position:absolute;width:44%;height:3px;background:var(--orange);left:50%;bottom:2px;transform-origin:left center;transform:rotate(-168deg);transition:transform .9s cubic-bezier(.2,.8,.2,1)}.needle:after{content:"";position:absolute;width:15px;height:15px;border-radius:50%;background:var(--ink);left:-7px;top:-6px}.dial-labels{display:flex;justify-content:space-between;position:absolute;bottom:0;width:100%;font-size:9px}.verdict{border-top:2px solid var(--ink);padding-top:18px}.verdict-kicker{font-size:10px;letter-spacing:.13em;text-transform:uppercase}.verdict h2{font:800 clamp(30px,5vw,49px)/.95 Fraunces;margin:10px 0 14px}.verdict p{font-size:12px;line-height:1.65}.numbers{display:grid;grid-template-columns:repeat(3,1fr);border:1px solid var(--line);margin-top:24px}.number{padding:11px;border-right:1px solid var(--line)}.number:last-child{border:0}.number b{font:600 20px Fraunces;display:block}.number span{font-size:8px;text-transform:uppercase}
.rule{margin:55px auto 0;max-width:760px;text-align:center}.rule p{font:600 clamp(24px,4vw,42px)/1.25 Fraunces;margin:0}.rule a{display:inline-block;margin-top:18px;color:var(--green);font-size:11px;text-underline-offset:4px}.fine{margin-top:36px;font-size:9px;line-height:1.7;text-align:center;color:#5c574d}
@media(max-width:760px){header{grid-template-columns:1fr;gap:25px}.machine{grid-template-columns:1fr}.controls{border-right:0;border-bottom:2px solid var(--ink)}.pair{grid-template-columns:1fr}.numbers{grid-template-columns:1fr}.number{border-right:0;border-bottom:1px solid var(--line)}.number:last-child{border-bottom:0}.top .serial{display:none}}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto}.needle,button{transition:none}}
</style>
</head>
<body>
<main class="wrap">
  <nav class="top"><a class="back" href="./">← Chloe Reads Jon</a><span class="serial">Worthometer Corporation · Surrey, BC</span><span class="status"><i class="lamp"></i> calibrated</span></nav>
  <header><h1>THE MONTHLY <em>WORTHOMETER</em></h1><p class="intro"><strong>One useful question</strong>Will you use it at least once a month? If yes, the better version may be worth it. If no, stop turning a small purchase into a graduate thesis.</p></header>
  <section class="machine" aria-label="Purchase decision calculator">
    <form class="controls" id="form">
      <div class="field"><label for="item">Object under consideration</label><input id="item" type="text" value="A really good kitchen knife" maxlength="52"></div>
      <div class="pair">
        <div class="field"><label for="basic">Basic price ($)</label><input id="basic" type="number" min="0" max="99999" step="1" value="45"></div>
        <div class="field"><label for="premium">Premium price ($)</label><input id="premium" type="number" min="0" max="99999" step="1" value="140"></div>
      </div>
      <div class="field"><label for="uses">Honest uses per month</label><div class="slider-row"><input id="uses" type="range" min="0" max="20" step="1" value="8"><output class="readout" id="usesOut">8×</output></div><div class="ticks"><span>NEVER</span><span>MONTHLY</span><span>DAILY-ISH</span></div></div>
      <div class="field"><label for="better">How much better is the premium one?</label><div class="slider-row"><input id="better" type="range" min="0" max="100" step="5" value="70"><output class="readout" id="betterOut">70%</output></div><div class="ticks"><span>LABEL ONLY</span><span>NOTICEABLE</span><span>DELIGHTFUL</span></div></div>
      <div class="field"><label for="years">Expected years of use</label><div class="slider-row"><input id="years" type="range" min="1" max="15" step="1" value="6"><output class="readout" id="yearsOut">6 yr</output></div></div>
      <button type="submit">Run the one-month test</button>
    </form>
    <div class="result" aria-live="polite">
      <div><div class="dial"><div class="arc"></div><div class="needle" id="needle"></div><div class="dial-labels"><span>KEEP IT CHEAP</span><span>BUY IT WELL</span></div></div>
      <div class="verdict"><span class="verdict-kicker">Laboratory finding № <b id="finding">0806</b></span><h2 id="verdict">Buy the good knife.</h2><p id="reason">You will reach for it often enough that small improvements compound. The premium costs about 16¢ extra each time over its useful life.</p></div></div>
      <div class="numbers"><div class="number"><b id="cpu">$0.24</b><span>premium / use</span></div><div class="number"><b id="extra">$0.16</b><span>extra / use</span></div><div class="number"><b id="research">45 min</b><span>research ceiling</span></div></div>
    </div>
  </section>
  <section class="rule"><p>“Am I going to use this at least once a month?”</p><a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener">Inspired by Jon’s “Jon’s 1-Month Rule” ↗</a></section>
  <p class="fine">A cheerful heuristic, not financial advice. Frequency cannot make an unaffordable purchase affordable, and “premium” is not always synonymous with “better.” Your cupboard already knows this.</p>
</main>
<script>
const $=s=>document.querySelector(s), fields=['uses','better','years'];
function sync(){ $('#usesOut').value=$('#uses').value+'×'; $('#betterOut').value=$('#better').value+'%'; $('#yearsOut').value=$('#years').value+' yr'; }
fields.forEach(id=>$('#'+id).addEventListener('input',sync));
function run(e){if(e)e.preventDefault();sync();const name=$('#item').value.trim()||'item',basic=+$('#basic').value||0,premium=+$('#premium').value||0,uses=+$('#uses').value,better=+$('#better').value,years=+$('#years').value,total=Math.max(1,uses*12*years),cpu=premium/total,extra=(premium-basic)/total;
 const monthly=uses>=1, sensible=premium>=basic && better>=35, score=Math.min(100,(monthly?45:0)+better*.45+(years>3?10:0)-(premium>basic*6?15:0));
 $('#needle').style.transform=`rotate(${-178+score*1.76}deg)`; $('#cpu').textContent='$'+cpu.toFixed(2); $('#extra').textContent=(extra<0?'−':'')+'$'+Math.abs(extra).toFixed(2); $('#finding').textContent=String(Math.floor(1000+Math.random()*8999));
 let title,reason,research;
 if(!monthly){title='Keep this one simple.';reason=`At ${uses} uses a month, the ${name} does not pass the rule. Buy basic, borrow, or wait until the need becomes real.`;research='10 min';}
 else if(!sensible){title='Premium needs a better case.';reason=`You would use the ${name} often, but the upgrade is only rated ${better}% better. Frequent use deserves quality, not expensive lettering.`;research='25 min';}
 else{title='Buy the good '+name.replace(/^(a|an|the)\s+/i,'')+'.';reason=`You will use it often enough for small improvements to compound. The premium costs about ${Math.max(0,extra).toLocaleString('en-CA',{style:'currency',currency:'CAD'})} extra each time across its useful life.`;research=Math.min(90,20+Math.round((premium-basic)/10)*5)+' min';}
 $('#verdict').textContent=title;$('#reason').textContent=reason;$('#research').textContent=research;
}
$('#form').addEventListener('submit',run);['basic','premium','item'].forEach(id=>$('#'+id).addEventListener('change',run));run();
</script>
</body></html>
