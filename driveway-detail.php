<?php
declare(strict_types=1);
if (isset($_GET['source'])) {
    $registry = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="(https?://[^"]+/2004/08/daves-proud-of-his-civic\\.html)"~', $registry, $m)) {
        header('Location: ' . html_entity_decode($m[1], ENT_QUOTES), true, 302); exit;
    }
    http_response_code(503); exit('Source unavailable. Please return to the gallery.');
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#f6f0e4">
<meta name="description" content="A small, satisfying car-washing game. A muddy hatchback, a sponge, and absolutely no hurry.">
<title>Driveway Detail</title>
<style>
@font-face{font-family:Detail;src:url("assets/driveway-detail-display.otf") format("opentype");font-weight:700;font-display:swap}
:root{--paper:#f6f0e4;--navy:#193c48;--red:#ad392d;--blue:#d2e7e8;--line:#a9bab7;--white:#fffcf5}
*{box-sizing:border-box}html{scrollbar-color:var(--navy) var(--paper)}
body{margin:0;background:var(--paper);color:var(--navy);font:1rem/1.55 system-ui,sans-serif}
::selection{background:var(--red);color:var(--white)}
a{color:inherit;text-underline-offset:4px}button,input,select{font:inherit;accent-color:var(--red)}
button{cursor:pointer;touch-action:manipulation}button:disabled{opacity:.45;cursor:default}
:focus-visible{outline:3px solid var(--red);outline-offset:4px}
.wrap{max-width:1180px;margin:auto;padding:20px clamp(18px,4vw,50px) 40px}
nav{display:flex;justify-content:space-between;gap:15px;border-bottom:1px solid var(--navy);padding-bottom:13px;font-size:.9rem}
header{display:flex;justify-content:space-between;align-items:end;gap:24px;margin:28px 0 22px}
h1,h2{font-family:Detail,Georgia,serif;font-weight:700;text-wrap:balance}
h1{font-size:clamp(2.6rem,7vw,5.4rem);line-height:1.04;letter-spacing:-.035em;margin:0;color:var(--red)}
header p{max-width:32ch;margin:0;font-size:1.05rem}
.bay{display:grid;grid-template-columns:minmax(0,1fr) 290px;border-top:2px solid var(--navy);border-bottom:2px solid var(--navy)}
.art{position:relative;min-width:0;background:#f7f1e5;align-self:start}
canvas{display:block;width:100%;height:auto;touch-action:none;cursor:crosshair}
.ticket{padding:22px 0 24px 25px;border-left:1px solid var(--line);display:flex;flex-direction:column;gap:13px}
.ticket h2{font-size:1.8rem;margin:0;line-height:1.2}
#instruction{margin:0;min-height:4.6em}
ol{list-style:none;padding:0;margin:0;display:flex;gap:0;border-bottom:1px solid var(--line)}
ol li{flex:1;padding:10px 2px;border-bottom:3px solid transparent;text-align:center;font-size:.85rem}
ol li[aria-current="step"]{border-bottom-color:var(--red);font-weight:750;color:var(--red)}
ol li.done{font-weight:700}
.progress-label{display:flex;justify-content:space-between;font-size:.9rem;font-variant-numeric:tabular-nums}
progress{width:100%;height:9px;border:0;background:var(--blue);accent-color:var(--red)}
progress::-webkit-progress-bar{background:var(--blue)}progress::-webkit-progress-value{background:var(--red)}
progress::-moz-progress-bar{background:var(--red)}
.primary,.secondary{min-height:46px;border:1px solid var(--navy);border-radius:5px;padding:10px 16px;font-weight:650}
.primary{background:var(--navy);color:var(--white)}.primary:hover:not(:disabled){background:#285868}
.secondary{background:transparent;color:var(--navy)}.secondary:hover:not(:disabled){background:var(--blue)}
#next{background:var(--red);border-color:var(--red);color:var(--white)}
#status{min-height:3.2em;font-size:.92rem;margin:0}
label{display:block;font-weight:650}select{width:100%;min-height:46px;color:var(--navy);background:var(--white);border:1px solid var(--navy);border-radius:4px;padding:8px}
.finish-options{display:flex;gap:6px;flex-wrap:wrap}.finish-options button{flex:1;padding:8px 10px}
.finish-options button[aria-pressed="true"]{background:var(--navy);color:var(--white)}
.under{display:flex;justify-content:space-between;gap:24px;margin-top:20px;align-items:start}
.under p{margin:0;max-width:65ch;font-size:.9rem}
.under label{font-size:.9rem}.under select{margin-top:7px;min-width:200px}
#comparison{padding:16px 0 4px}#comparison input{width:100%;min-height:44px}
#comparison p{font-size:.9rem;margin:0}
#result{padding-top:20px}#result h2{font-size:2rem;margin:0 0 8px}
#result p{max-width:65ch}.actions{display:flex;gap:12px;flex-wrap:wrap}
footer{border-top:1px solid var(--line);margin-top:35px;padding-top:18px;font-size:.85rem}
footer p{margin:5px 0}
[hidden]{display:none!important}
@media(max-width:760px){
.wrap{padding-top:14px}nav{font-size:.8rem}header{display:block;margin:24px 0 18px}
header p{max-width:40ch;margin-top:10px;font-size:1rem}
.bay{grid-template-columns:1fr}.ticket{padding:18px 0;border-left:0;border-top:1px solid var(--line);gap:11px}
.ticket h2{font-size:1.6rem}#instruction{min-height:0}.under{display:block}.under>div{margin-top:20px}
#status{min-height:0}ol li{font-size:.8rem}.ticket .primary,.ticket .secondary{width:100%}
}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important}}
</style>
</head>
<body><main class="wrap">
<nav aria-label="Page navigation"><a href="./">Chloe Reads Jon</a><span>No timer. Just a very muddy car.</span></nav>
<header><h1>Driveway<br>Detail.</h1><p>A little hatchback. A lot of mud.<br>Bring back that proud-of-your-car feeling.</p></header>
<ol aria-label="Detailing steps" id="steps"><li aria-current="step">1. Wash</li><li>2. Rinse</li><li>3. Dry</li><li>4. Tires</li></ol>
<div class="bay">
<div class="art"><canvas id="car" width="1200" height="800" role="img" aria-label="Illustrated red hatchback covered in mud. Drag to wash it, or use the Work next section button."></canvas></div>
<section class="ticket" aria-labelledby="stageTitle">
<h2 id="stageTitle" tabindex="-1">The muddy bit</h2>
<p id="instruction">Drag your sponge over the muddy marks. Or work section by section with the button below.</p>
<div id="workProgress"><div class="progress-label"><label for="progress">This pass</label><span id="percent">0%</span></div><progress id="progress" value="0" max="100">0%</progress></div>
<button class="primary" id="work">Work next section</button>
<button class="secondary" id="next" disabled>Rinse the soap</button>
<div id="tireControls" hidden><p>Choose your tire finish. Sidewalls only, not the tread.</p><div class="finish-options" aria-label="Tire finish"><button class="secondary" data-finish="Matte" aria-pressed="false">Matte</button><button class="secondary" data-finish="Satin" aria-pressed="true">Satin</button><button class="secondary" data-finish="Gloss" aria-pressed="false">Gloss</button></div><p id="finishNote">Satin: a quiet, just-cleaned sheen.</p></div>
<p id="status" role="status" aria-live="polite">The sponge is ready. Start anywhere on the car.</p>
</section></div>
<div id="comparison" hidden><label for="reveal">Before &amp; after</label><input type="range" id="reveal" min="0" max="100" value="100" aria-valuetext="100 percent clean"><p>Slide left to remember what we started with.</p></div>
<section id="result" hidden aria-labelledby="resultTitle"><h2 id="resultTitle" tabindex="-1">That deserves a little driveway stare.</h2><p id="receipt"></p><div class="actions"><button class="primary" id="download">Save a keepsake</button><button class="secondary" id="replay">Make it muddy again</button></div></section>
<div class="under"><p>Made for the pleasing bit: watching the dirt disappear. This is a playful wash, not a real-world detailing guide. The original car illustration is imagined, not Dave’s actual Civic.</p><div><label for="mood">Next trip’s mess</label><select id="mood"><option value="24">School run</option><option value="40">Puddle enthusiast</option><option value="60">Rally audition</option></select></div></div>
<footer><p>Inspired by Jon’s <a href="?source=1">post about Dave being proud of his Civic</a>, August 2004.</p><p>A small car-care daydream for Jon and Nathan.</p></footer>
<noscript><p>This game needs JavaScript. The source post and gallery links still work.</p></noscript>
</main>
<script>
'use strict';
const $=id=>document.getElementById(id),canvas=$('car'),ctx=canvas.getContext('2d'),image=new Image();
const stages=[
{title:'The muddy bit',instruction:'Drag your sponge over the muddy marks. Or work section by section with the button below.',next:'Rinse the soap',ready:'Mud lifted. A foamy little victory. Time to rinse.'},
{title:'Rinse & reveal',instruction:'Sweep away the suds to reveal the red underneath. A hose with excellent manners.',next:'Dry the droplets',ready:'No suds left. Just a few water drops to catch.'},
{title:'The finishing towel',instruction:'Wipe up the droplets. There is no clock, so take your time.',next:'Dress the tires',ready:'Bodywork done. Now for the bit that made Dave proud.'},
{title:'A little tire pride',instruction:'Matte, satin, or a proper showroom shine? Pick the look you like.',next:'Park & admire'}
];
let stage=0,marks=[],original=[],finish='Satin',loaded=false,drawing=false,complete=false,seed=824,washCount=24,washLabel='School run';
function rand(){seed=(seed*1664525+1013904223)>>>0;return seed/4294967296}
function makeMarks(count){marks=Array.from({length:count},(_,i)=>({x:190+rand()*800,y:400+rand()*140,r:12+rand()*18,off:false}));}
function mud(list,clip=1200){ctx.save();ctx.beginPath();ctx.rect(0,0,clip,800);ctx.clip();list.forEach(m=>{ctx.fillStyle='#76583d';ctx.beginPath();ctx.ellipse(m.x,m.y,m.r*1.4,m.r,.2,0,Math.PI*2);ctx.fill();ctx.fillStyle='#a18259';ctx.beginPath();ctx.arc(m.x-4,m.y-3,m.r*.45,0,Math.PI*2);ctx.fill()});ctx.restore()}
function render(){
ctx.clearRect(0,0,1200,800);ctx.fillStyle='#f7f1e5';ctx.fillRect(0,0,1200,800);
if(loaded)ctx.drawImage(image,0,0,1200,800);
if(stage===0)mud(marks.filter(m=>!m.off));
if(stage===1)marks.filter(m=>!m.off).forEach(m=>{ctx.fillStyle='#e8f5f5';ctx.strokeStyle='#78a5ae';ctx.lineWidth=2;ctx.beginPath();ctx.arc(m.x,m.y,m.r*1.2,0,Math.PI*2);ctx.fill();ctx.stroke()});
if(stage===2)marks.filter(m=>!m.off).forEach(m=>{ctx.fillStyle='#77adbd';ctx.beginPath();ctx.ellipse(m.x,m.y,5,12,.25,0,Math.PI*2);ctx.fill();ctx.fillStyle='#f7fcfc';ctx.fillRect(m.x-2,m.y-5,2,5)});
if(stage>=3){const alpha={Matte:0,Satin:.28,Gloss:.7}[finish];ctx.strokeStyle='rgba(245,250,255,'+alpha+')';ctx.lineWidth=7;[260,930].forEach(x=>{ctx.beginPath();ctx.ellipse(x,570,74,74,0,Math.PI*1.1,Math.PI*1.8);ctx.stroke()})}
if(complete){const x=1200*Number($('reveal').value)/100;mud(original,x===1200?0:1200-x);if(x<1200){ctx.strokeStyle='#ad392d';ctx.lineWidth=3;ctx.beginPath();ctx.moveTo(1200-x,300);ctx.lineTo(1200-x,660);ctx.stroke()}}
}
function update(){
const pct=stage===3?100:Math.round(marks.filter(m=>m.off).length/marks.length*100);
const workHadFocus=document.activeElement===$('work');
$('progress').value=pct;$('percent').textContent=pct+'%';$('work').disabled=pct===100;
$('next').disabled=pct!==100;
if(pct===100&&workHadFocus)$('next').focus({preventScroll:true});
if(pct===100&&stage<3)$('status').textContent=stages[stage].ready;
canvas.setAttribute('aria-label',stage===3?'Clean red hatchback with '+finish.toLowerCase()+' tire finish.':'Red hatchback. '+stages[stage].title+': '+pct+' percent complete.');
render();
}
function sweep(x,y){if(stage>=3||complete||!loaded)return;marks.forEach(m=>{if(Math.hypot(m.x-x,m.y-y)<70)m.off=true});update()}
canvas.addEventListener('pointerdown',e=>{if(stage>=3)return;drawing=true;canvas.setPointerCapture(e.pointerId);point(e)});
canvas.addEventListener('pointermove',e=>{if(drawing)point(e)});
canvas.addEventListener('pointerup',()=>drawing=false);canvas.addEventListener('pointercancel',()=>drawing=false);
function point(e){const r=canvas.getBoundingClientRect();sweep((e.clientX-r.left)*1200/r.width,(e.clientY-r.top)*800/r.height)}
$('work').onclick=()=>{let n=0;for(const m of marks){if(!m.off){m.off=true;if(++n===6)break}}update()};
function setStage(n){
stage=n;drawing=false;const s=stages[n];$('stageTitle').textContent=s.title;$('instruction').textContent=s.instruction;
$('next').textContent=s.next;$('workProgress').hidden=n===3;$('work').hidden=n===3;$('tireControls').hidden=n!==3;
[...$('steps').children].forEach((li,i)=>{li.classList.toggle('done',i<n);if(i===n)li.setAttribute('aria-current','step');else li.removeAttribute('aria-current')});
if(n<3)makeMarks(washCount);$('status').textContent=n===3?'The body is clean. Choose a finish, then park.':'A fresh pass. Work any patch you like.';
update();$('stageTitle').focus({preventScroll:true});
}
$('next').onclick=()=>{if(stage<3){setStage(stage+1);return}complete=true;$('result').hidden=false;$('comparison').hidden=false;$('next').hidden=true;$('status').textContent='Parked. Beautifully unnecessary admiring is now encouraged.';$('receipt').textContent='One '+washLabel.toLowerCase()+' washed, rinsed, towel-dried, and finished with '+finish.toLowerCase()+' tires. No water bill. No hurry.';$('resultTitle').focus({preventScroll:true});render()};
document.querySelectorAll('[data-finish]').forEach(b=>b.onclick=()=>{finish=b.dataset.finish;document.querySelectorAll('[data-finish]').forEach(x=>x.setAttribute('aria-pressed',String(x===b)));$('finishNote').textContent={Matte:'Matte: clean rubber, without the shine.',Satin:'Satin: a quiet, just-cleaned sheen.',Gloss:'Gloss: Dave would probably approve.'}[finish];if(complete)$('receipt').textContent='Washed, rinsed, towel-dried. Finished with '+finish.toLowerCase()+' tires. No water bill. No hurry.';update()});
$('reveal').oninput=()=>{$('reveal').setAttribute('aria-valuetext',$('reveal').value+' percent clean');render()};
function reset(){complete=false;seed=824;washCount=Number($('mood').value);washLabel=$('mood').selectedOptions[0].text;$('result').hidden=true;$('comparison').hidden=true;$('next').hidden=false;$('reveal').value=100;setStage(0);original=marks.map(m=>({...m,off:false}));render()}
$('replay').onclick=reset;
$('mood').onchange=()=>{$('status').textContent='Next wash: '+$('mood').selectedOptions[0].text+'. Finish this car, or start fresh below.';if(!complete&&stage===0)reset()};
$('download').onclick=()=>{const saved=$('reveal').value;$('reveal').value=100;render();const out=document.createElement('canvas');out.width=1200;out.height=930;const c=out.getContext('2d');c.fillStyle='#f6f0e4';c.fillRect(0,0,1200,930);c.drawImage(canvas,0,0);c.fillStyle='#193c48';c.font='bold 38px Georgia';c.fillText('Driveway Detail',65,835);c.font='24px sans-serif';c.fillText('Washed with care. '+finish+' tires. Zero water bill.',65,880);const a=document.createElement('a');a.download='driveway-detail.png';a.href=out.toDataURL('image/png');a.click();$('reveal').value=saved;render();$('status').textContent='Your keepsake is ready. Check your downloads.'};
image.onload=()=>{loaded=true;reset()};
image.onerror=()=>{$('status').textContent='The illustration did not load. Reload the page to try again.';$('work').disabled=true;$('next').disabled=true};
$('work').disabled=true;image.src='assets/driveway-detail.webp';
</script></body></html>
