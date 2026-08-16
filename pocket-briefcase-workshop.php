<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#1c3536">
<title>Pocket Briefcase Workshop</title>
<style>
@font-face{font-family:Fraunces;src:local("Iowan Old Style"),local("Palatino Linotype"),local(Georgia)}
@font-face{font-family:"DM Mono";src:local("Courier New"),local(Courier)}
:root{--ink:#172f31;--paper:#f4e8c8;--red:#9d3528;--ochre:#d59727;--teal:#1d5555;--silver:#b6b4a9;--line:rgba(23,47,49,.25)}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;color:var(--ink);background:#153334;font-family:"Courier New",Courier,monospace;background-image:radial-gradient(circle at 20% 10%,#2e5b58 0,transparent 34%),linear-gradient(115deg,transparent 48%,rgba(255,255,255,.025) 49%,transparent 50%);min-height:100vh}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.2;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.28'/%3E%3C/svg%3E")}
a{color:inherit}.shell{width:min(1120px,calc(100% - 30px));margin:auto;padding:24px 0 70px}.topbar{display:flex;justify-content:space-between;align-items:center;color:#f6e8c3;font-size:12px;letter-spacing:.08em;text-transform:uppercase;margin-bottom:20px}.back{text-decoration:none;border-bottom:1px solid #d59727;padding-bottom:3px}.stamp{border:1px solid #d59727;color:#ffd879;padding:7px 10px;transform:rotate(1.5deg)}
.hero{display:grid;grid-template-columns:1.05fr .95fr;background:var(--paper);border:2px solid #10292a;box-shadow:13px 13px 0 #0a2021;overflow:hidden;animation:arrive .65s ease-out both}.hero-copy{padding:clamp(30px,6vw,76px);position:relative}.kicker{color:var(--red);font-weight:500;font-size:12px;text-transform:uppercase;letter-spacing:.16em}.hero h1{font-family:Fraunces,serif;font-size:clamp(49px,7vw,91px);line-height:.82;letter-spacing:-.055em;margin:18px 0 26px}.hero h1 i{display:block;color:var(--red);font-style:italic;margin-left:.45em}.lede{font-family:Fraunces,serif;font-size:20px;line-height:1.45;max-width:30em}.hero-art{min-height:510px;background:url('pocket-briefcase-kit.png') center/cover;position:relative}.hero-art:after{content:"FIG. 01 — FOUR THINGS, $89 SAVED";position:absolute;right:14px;bottom:14px;background:var(--paper);padding:8px 11px;font-size:11px;box-shadow:4px 4px 0 var(--red)}
.section{margin-top:54px}.section-head{color:#f7e9c6;display:grid;grid-template-columns:60px 1fr;gap:18px;align-items:start;margin-bottom:18px}.num{font-family:Fraunces,serif;font-size:50px;color:#e4a938;line-height:.8}.section h2{font-family:Fraunces,serif;font-size:clamp(30px,5vw,54px);margin:0;line-height:.95}.section-head p{margin:10px 0 0;color:#bfd0c9;line-height:1.6;max-width:700px;font-size:13px}
.bench{background:#efe2bd;padding:clamp(20px,4vw,42px);box-shadow:10px 10px 0 #0a2021;border-top:8px solid var(--ochre)}.fitter{display:grid;grid-template-columns:minmax(0,.85fr) minmax(300px,1.15fr);gap:40px}.controls{display:grid;gap:22px}.control label{display:flex;justify-content:space-between;font-size:12px;text-transform:uppercase;letter-spacing:.07em}.control output{color:var(--red);font-weight:bold}.control input{width:100%;margin-top:12px;accent-color:var(--red)}
.blueprint{background:#173f42;color:#f4e8c8;padding:24px;min-height:360px;position:relative;overflow:hidden;background-image:linear-gradient(rgba(255,255,255,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.06) 1px,transparent 1px);background-size:16px 16px}.pad{position:absolute;left:50%;top:50%;translate:-50% -50%;width:210px;height:276px;background:#f8edcf;color:#173f42;box-shadow:7px 7px 0 rgba(0,0,0,.25);transition:.3s;width:var(--pw,210px);height:var(--ph,276px)}.pad:before{content:"CUT " attr(data-w) " × " attr(data-h) " mm";position:absolute;left:13px;right:13px;top:13px;padding:8px 0;border-top:2px solid var(--red);border-bottom:1px solid var(--red);font-size:11px;text-align:center}.pad-lines{position:absolute;inset:58px 14px 15px;background:repeating-linear-gradient(transparent 0 23px,rgba(29,85,85,.25) 24px)}.tape{position:absolute;background:rgba(190,193,187,.82);border:1px dashed #fff;width:24px;height:82px;top:50%;translate:0 -50%}.tape.a{left:calc(50% - var(--half,120px))}.tape.b{right:calc(50% - var(--half,120px))}.fit-result{font-family:Fraunces,serif;font-size:21px;line-height:1.35;border-left:5px solid var(--red);padding-left:16px}.tiny{font-size:11px;line-height:1.6;color:#56665f}.button{appearance:none;border:0;background:var(--red);color:#fff3d2;padding:14px 18px;font:500 12px "DM Mono";letter-spacing:.07em;text-transform:uppercase;cursor:pointer;box-shadow:4px 4px 0 var(--ink);transition:.15s}.button:hover{translate:-2px -2px;box-shadow:6px 6px 0 var(--ink)}.button.alt{background:var(--ochre);color:var(--ink)}
.assembly{display:grid;grid-template-columns:repeat(4,1fr);gap:2px}.step{background:#e9dbb5;padding:22px;min-height:185px;cursor:pointer;position:relative;transition:.22s}.step:hover,.step.done{background:#f8edcf}.step.done:after{content:"✓";position:absolute;right:15px;top:10px;color:var(--red);font-family:Fraunces;font-size:34px;transform:rotate(-8deg)}.step b{display:block;color:var(--red);font-size:11px;letter-spacing:.12em;margin-bottom:28px}.step strong{font-family:Fraunces,serif;font-size:23px;display:block;margin-bottom:10px}.step span{font-size:11px;line-height:1.55}.progress{height:8px;background:#cdbf99;margin-top:22px}.progress i{display:block;height:100%;width:0;background:var(--red);transition:.3s}
.test-grid{display:grid;grid-template-columns:.8fr 1.2fr;gap:36px;align-items:center}.timer{text-align:center;border:2px solid var(--ink);padding:28px;background:#e8d8ae}.clock{font-family:Fraunces,serif;font-size:72px;line-height:1;color:var(--red)}.capture{display:grid;gap:14px}.prompt{font-family:Fraunces,serif;font-size:clamp(24px,4vw,40px);line-height:1.1}.capture textarea{width:100%;min-height:130px;background:#fff8e5;border:2px solid var(--ink);padding:15px;font:16px Fraunces,serif;resize:vertical}.verdict{min-height:50px;font-family:Fraunces,serif;font-size:20px;color:var(--teal)}
.source{margin-top:50px;color:#c6d5cf;font-size:12px;line-height:1.7;text-align:center}.source a{color:#ffd16d;text-underline-offset:3px}.footer-mark{font-family:Fraunces,serif;font-size:22px;color:#f3e5c2;margin-top:20px}
@keyframes arrive{from{opacity:0;transform:translateY(20px) rotate(-.3deg)}to{opacity:1;transform:none}}@media(max-width:760px){.hero,.fitter,.test-grid{grid-template-columns:1fr}.hero-art{min-height:340px;order:-1}.hero-copy{padding:35px 25px 42px}.assembly{grid-template-columns:1fr 1fr}.section-head{grid-template-columns:42px 1fr}.num{font-size:38px}.fitter{gap:25px}.blueprint{min-height:330px}}@media(max-width:450px){.assembly{grid-template-columns:1fr}.topbar .stamp{display:none}.shell{width:min(100% - 20px,1120px)}.bench{padding:18px}.clock{font-size:58px}}
@media print{body{background:#fff}.topbar,.hero,.section:not(#fit),.section-head,.controls,.source{display:none!important}.shell{width:100%;padding:0}.bench{box-shadow:none;border:0;padding:0}.fitter{display:block}.blueprint{height:90vh;background:#fff;color:#000;border:1px solid #000}.pad{box-shadow:none;border:2px solid #000}.tape{display:none}}
</style>
</head>
<body>
<main class="shell">
  <nav class="topbar"><a class="back" href="./">← Chloe Reads Jon</a><span class="stamp">Field issue · 2009 / 2026</span></nav>
  <header class="hero">
    <div class="hero-copy"><div class="kicker">Improvised stationery division</div><h1>Pocket <i>Briefcase</i></h1><p class="lede">Measure a wallet. Cut a tiny pad. Recruit a suspiciously short pen. Become the sort of person who can catch an idea before it escapes into traffic.</p></div>
    <div class="hero-art" role="img" aria-label="Illustrated wallet, paper pad, short pen, and duct tape arranged on a workbench"></div>
  </header>

  <section class="section" id="fit"><div class="section-head"><div class="num">01</div><div><h2>Fit the paper.</h2><p>Measure the clear flat area inside your wallet. The workshop subtracts a safe margin and draws a cut guide. No premium executive stationery required.</p></div></div>
    <div class="bench fitter">
      <div class="controls">
        <div class="control"><label>Wallet width <output id="wo">90 mm</output></label><input id="w" type="range" min="65" max="120" value="90"></div>
        <div class="control"><label>Wallet height <output id="ho">105 mm</output></label><input id="h" type="range" min="75" max="140" value="105"></div>
        <div class="control"><label>Breathing room <output id="mo">6 mm</output></label><input id="m" type="range" min="3" max="12" value="6"></div>
        <div class="fit-result" id="fitResult">Cut paper to 78 × 93 mm. Stack 12 sheets for a pocketable first edition.</div>
        <button class="button alt" onclick="window.print()">Print the cut guide</button>
        <div class="tiny">Tip: test one scrap sheet before cutting a stack. Wallets, like software estimates, may contain undocumented interior constraints.</div>
      </div>
      <div class="blueprint" aria-label="Printable paper cut blueprint"><div class="tape a"></div><div class="pad" id="pad" data-w="78" data-h="93"><div class="pad-lines"></div></div><div class="tape b"></div></div>
    </div>
  </section>

  <section class="section"><div class="section-head"><div class="num">02</div><div><h2>Conduct the assembly.</h2><p>Tap each station as you complete it. This is not complicated, but that has never stopped a respectable workshop from issuing procedures.</p></div></div>
    <div class="bench"><div class="assembly" id="steps">
      <div class="step"><b>STATION A</b><strong>Cut</strong><span>Trim 12–20 sheets to the workshop dimensions. Round the corners if you possess both patience and scissors.</span></div>
      <div class="step"><b>STATION B</b><strong>Bind</strong><span>Staple the top edge, or clamp it with a miniature binder clip. Keep bulk below trouser-annoyance levels.</span></div>
      <div class="step"><b>STATION C</b><strong>Affix</strong><span>Roll duct tape into two sticky-side-out loops. Press the pad into a clear interior panel.</span></div>
      <div class="step"><b>STATION D</b><strong>Stow</strong><span>Slide a mini pen into a card pocket. Practise Jon’s advanced pen-only extraction manoeuvre.</span></div>
    </div><div class="progress"><i id="progress"></i></div></div>
  </section>

  <section class="section"><div class="section-head"><div class="num">03</div><div><h2>Beat the vanishing idea.</h2><p>A pocket system succeeds only if it is faster than “I’ll remember that.” Run the ten-second field test.</p></div></div>
    <div class="bench test-grid"><div class="timer"><div class="clock" id="clock">10.0</div><div class="tiny">SECONDS TO CAPTURE</div><button class="button" id="start">Start field test</button></div>
      <div class="capture"><div class="kicker">Your incoming thought</div><div class="prompt" id="prompt">A game Nathan might invent from three household objects…</div><textarea id="note" placeholder="Catch the smallest useful version here…" disabled></textarea><div class="verdict" id="verdict">Wallet closed. Idea currently at large.</div></div></div>
  </section>
  <div class="source">Inspired by Jon’s <a href="https://jona.ca/2009/11/diy-international-pocket-briefcase-aka.html" target="_blank" rel="noopener">DIY International Pocket Briefcase aka David Allen NoteTaker Wallet</a>, a four-ingredient rebellion against an $89 accessory.<div class="footer-mark">Built cheaply. Used lavishly.</div></div>
</main>
<script>
const $=s=>document.querySelector(s), $$=s=>[...document.querySelectorAll(s)];
const fit=()=>{let w=+$(`#w`).value,h=+$(`#h`).value,m=+$(`#m`).value,pw=w-m*2,ph=h-m*2;$('#wo').value=w+' mm';$('#ho').value=h+' mm';$('#mo').value=m+' mm';$('#fitResult').textContent=`Cut paper to ${pw} × ${ph} mm. Stack ${Math.max(8,Math.round(18-m/2))} sheets for a pocketable first edition.`;let pad=$('#pad'),scale=Math.min(2.3,250/Math.max(pw,ph));pad.style.setProperty('--pw',pw*scale+'px');pad.style.setProperty('--ph',ph*scale+'px');pad.style.setProperty('--half',(pw*scale/2+18)+'px');pad.dataset.w=pw;pad.dataset.h=ph;localStorage.setItem('briefcase-fit',JSON.stringify({w,h,m}))};
['w','h','m'].forEach(id=>$(`#${id}`).addEventListener('input',fit));try{let s=JSON.parse(localStorage.getItem('briefcase-fit'));if(s)Object.entries(s).forEach(([k,v])=>$(`#${k}`).value=v)}catch(e){}fit();
$$('.step').forEach(step=>step.addEventListener('click',()=>{step.classList.toggle('done');$('#progress').style.width=($$('.step.done').length/4*100)+'%'}));
const prompts=['A game Nathan might invent from three household objects…','A tiny improvement to something you use every day…','A sentence that belongs in a future blog post…','A question worth asking at dinner…','A gloriously unnecessary web-lab experiment…'];let round=0,timer;
$('#start').addEventListener('click',()=>{clearInterval(timer);let left=100;$('#prompt').textContent=prompts[round++%prompts.length];$('#note').value='';$('#note').disabled=false;$('#note').focus();$('#verdict').textContent='The idea is making a run for it…';$('#start').textContent='Restart';timer=setInterval(()=>{left--;$('#clock').textContent=(left/10).toFixed(1);if(left<=0){clearInterval(timer);$('#note').disabled=true;let n=$('#note').value.trim();$('#verdict').textContent=n?`Captured in ${n.split(/\s+/).length} words. The pocket briefcase earns its keep.`:'Escaped! Fortunately, the workshop permits immediate rematches.'}},100)});
</script>
</body></html>
