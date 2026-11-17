<?php
if (isset($_GET['source'])) {
    header('Location: '.base64_decode('aHR0cHM6Ly9qb25hLmNhLzIwMjUvMDIva2VsdmluLWJvbGRyLXJldmlldy1vdmVyaHlwZWQtYW5kLmh0bWw='), true, 302);
    exit;
}
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>The Warm Seat · Chloe Reads Jon</title>
<style>
@font-face{font-family:Fredoka;src:url('assets/warm-seat-fredoka.ttf') format('truetype');font-weight:600;font-display:swap}
:root{--ink:#123e43;--paper:#fff3d5;--yellow:#ffdc77;--orange:#bd461d;--cool:#326b82;--line:#c4b797}
*{box-sizing:border-box}body{margin:0;background:var(--ink);color:var(--paper);font:17px/1.55 'Trebuchet MS',sans-serif}::selection{background:var(--yellow);color:var(--ink)}html{scrollbar-color:var(--yellow) var(--ink)}a{color:inherit;text-underline-offset:5px}button,a,input{ -webkit-tap-highlight-color:transparent}button{font:inherit;cursor:pointer;touch-action:manipulation}button:focus-visible,a:focus-visible{outline:3px solid #cf4b21;outline-offset:4px}button:hover:not(:disabled){filter:brightness(.94)}nav a:focus-visible,footer a:focus-visible{outline-color:var(--yellow)}button:disabled{cursor:default;opacity:.55}main{max-width:1150px;margin:auto;padding:26px 36px 50px}nav{display:flex;justify-content:space-between;gap:20px;font-size:14px}h1,h2,h3{font-family:Fredoka,'Trebuchet MS',sans-serif;font-weight:600;line-height:1.04;text-wrap:balance}h1{font-size:clamp(44px,7vw,84px);color:var(--yellow);margin:28px 0 12px;letter-spacing:-.025em}header p{margin:0 0 28px;max-width:64ch;font-size:18px}.exhibit{display:grid;grid-template-columns:minmax(0,1.5fr) minmax(260px,1fr);background:var(--paper);color:var(--ink)}.plan{padding:23px 23px 16px;min-width:0}.roomhead{display:flex;justify-content:space-between;align-items:baseline;gap:12px;margin-bottom:16px}.roomhead h2{font-size:27px;margin:0}.roomhead span{font-size:14px;white-space:nowrap;font-variant-numeric:tabular-nums}canvas{display:block;width:100%;aspect-ratio:1;background:#eddfbd;border:2px solid var(--ink)}.legend{display:flex;flex-wrap:wrap;gap:8px 20px;font-size:14px;margin:12px 0 0}.legend span{display:flex;align-items:center;gap:6px}.legend i{width:13px;height:13px;display:inline-block;border:1px solid var(--ink)}.legend .warm{background:#ffb253}.legend .cold{background:#c0d9e0}.legend .wall{background:#123e43}.rail{border-left:1px solid var(--line);padding:26px;display:flex;flex-direction:column;gap:19px}.rail p{margin:0}.rail h3{font-size:24px;margin:0 0 8px}.pads{display:flex;gap:8px}.pads button{width:100%;min-height:47px;border:1px solid var(--ink);color:var(--ink);background:transparent;border-radius:8px}.pads button[aria-pressed=true]{background:var(--ink);color:var(--paper)}.steer{display:grid;grid-template-columns:1fr 1fr;gap:8px}.steer button,.secondary{min-height:46px;border:1px solid var(--ink);border-radius:8px;color:var(--ink);background:transparent;padding:8px 14px}.bearing{font-size:15px;margin-bottom:10px!important;font-variant-numeric:tabular-nums}.primary{background:var(--orange);color:#fff9eb;border:0;border-radius:9px;padding:13px 16px;min-height:52px;font-weight:bold;width:100%}.status{padding:12px 0;border-top:1px solid var(--line);border-bottom:1px solid var(--line);min-height:75px;font-weight:bold}.seatlist{font-size:15px}.seatlist ul{padding-left:20px;margin:6px 0 0}.hint{font-size:15px;margin-top:10px!important}.actions{display:flex;gap:8px;flex-wrap:wrap}.actions button{flex:1}.progress{display:flex;gap:7px;margin-top:20px}.progress span{height:6px;flex:1;background:#7e9b96}.progress .done{background:var(--yellow)}.afterword{margin-top:54px;display:grid;grid-template-columns:1.1fr 1fr;gap:35px;align-items:center}.afterword img{width:100%;height:auto;display:block}.afterword h2{color:var(--yellow);font-size:36px;margin:0 0 18px}.afterword p{max-width:65ch;margin:12px 0}.note{font-size:14px;color:#d2e0d7}footer{margin-top:40px;padding-top:22px;border-top:1px solid #648580;font-size:15px}#completion{padding:26px 0 10px}#completion h2{font-size:40px;color:var(--yellow);margin:0 0 12px}#completion button{width:auto;padding:14px 28px;background:var(--yellow);color:var(--ink)}[hidden]{display:none!important}@keyframes settle{from{clip-path:inset(0 95% 0 0)}to{clip-path:inset(0 0 0 0)}}.progress .done{animation:settle .45s cubic-bezier(.16,1,.3,1)}@media(prefers-reduced-motion:reduce){*{animation:none!important;scroll-behavior:auto!important}}@media(max-width:720px){main{padding:18px 18px 35px}h1{margin-top:25px}header p{font-size:17px;margin-bottom:22px}.exhibit{grid-template-columns:1fr}.plan{padding:16px}.rail{border-left:0;border-top:1px solid var(--line);padding:20px;gap:19px}.roomhead h2{font-size:24px}.afterword{grid-template-columns:1fr;gap:24px;margin-top:38px}.afterword h2{font-size:32px}nav{font-size:13px}}@media(max-width:360px){main{padding:14px 12px}.plan{padding:12px}.roomhead{align-items:start}.roomhead h2{font-size:21px}}
</style>
</head>
<body><main>
<nav aria-label="Page"><a href="./">Chloe Reads Jon</a><span>For Dad &amp; Nathan</span></nav>
<header><h1>The Warm Seat</h1><p>A heater. A chilly room. Some very particular chairs.<br>Find a spot and aim the warmth so everyone gets a turn in the sun.</p></header>
<section class="exhibit" aria-label="Room puzzle">
<div class="plan">
<div class="roomhead"><h2 id="roomTitle" tabindex="-1">The reading nook</h2><span id="roomCount">Room 1 of 6</span></div>
<canvas id="room" width="700" height="700" role="img" aria-label="Room plan. Use the heater-spot and turn buttons below. A text list describes each chair."></canvas>
<p class="legend"><span><i class="warm"></i>Warm chair</span><span><i class="cold"></i>Cold chair</span><span><i class="wall"></i>Bookcase</span></p>
</div>
<div class="rail">
<p id="mission">Warm both chairs. You can move the heater between three marked spots.</p>
<div><h3>Place the heater</h3><div class="pads" aria-label="Heater spot"><button data-pad="0" aria-pressed="true">Spot A</button><button data-pad="1" aria-pressed="false">Spot B</button><button data-pad="2" aria-pressed="false">Spot C</button></div></div>
<div><h3>Aim the warmth</h3><p class="bearing" id="bearing">Facing south · range 5 squares</p><div class="steer"><button id="left">Turn left 45°</button><button id="right">Turn right 45°</button></div></div>
<div class="seatlist"><strong id="warmCount">0 of 2 chairs warm</strong><ul id="seats"></ul></div>
<button class="primary" id="check">Try this arrangement</button>
<p class="status" id="status" role="status" aria-live="polite">The golden fan shows where warmth can reach. It cannot go through a bookcase.</p>
<div class="actions"><button class="secondary" id="hint">Show a hint</button><button class="secondary" id="reset">Reset room</button></div>
<p class="hint" id="hintText" hidden></p>
<button class="primary" id="next" hidden>Next room</button>
</div></section>
<div class="progress" id="progress" aria-label="0 of 6 rooms solved"></div>
<section id="completion" hidden><h2 tabindex="-1" id="finishTitle">Every seat is the warm seat.</h2><p>Six rooms, no chilly readers left behind. The bookcases remain entirely unimpressed.</p><button class="primary" id="replay">Play all six again</button></section>
<section class="afterword">
<figure style="margin:0"><img src="the-warm-seat-art.png" width="1536" height="1024" alt="Illustrated room with a heater casting a golden fan toward chairs, with a bookcase interrupting the warmth." loading="lazy"><figcaption class="note">An imagined room, drawn for this little experiment.</figcaption></figure>
<div><h2>Warmth needs a clear path.</h2><p>Jon bought an infrared panel hoping it would make an open-plan room comfortable. He found the warmth much less convincing from the couch than from a foot away.</p><p>That complaint became this puzzle: distance, direction and things in the way matter. Try turning the heater before moving it. Then try the other spot.</p><p class="note">This is a toy model: a 60° fan, a hard range limit and solid bookcases. Real panels spread heat differently, also warm the air, and depend on room conditions. The squares are game units, not installation distances.</p></div>
</section>
<footer>Inspired by Jon’s <a href="?source=1">Kelvin Boldr Review: Overhyped and Underwhelming</a>.<br>Built by Chloe, with sympathy for the distant end of the couch.</footer>
<noscript><p>This puzzle needs JavaScript. The story and source link still work.</p></noscript>
</main>
<script>
'use strict';
const levels=[
{name:'The reading nook',pads:[[1,3],[5,5],[5,1]],chairs:[[4,2],[4,4]],walls:[],range:5,hint:'Start at Spot A. Both chairs are to the east (right).',lesson:'A little aiming goes a long way. Both chairs fit inside the fan.'},
{name:'Around the bookcase',pads:[[0,3],[3,6],[6,3]],chairs:[[3,1],[4,2]],walls:[[2,3],[2,4]],range:5.2,hint:'Try Spot B, then face north. From here the bookcase is not in the way.',lesson:'Radiant warmth needs a clear path. Moving the heater can beat turning it.'},
{name:'The long room',pads:[[0,3],[3,3],[6,6]],chairs:[[6,2],[6,4]],walls:[[1,0],[1,1]],range:4.5,hint:'Spot A is too far away. Try the middle spot and face east.',lesson:'Pointing the right way is only half the job. Range matters too.'},
{name:'A diagonal invitation',pads:[[0,6],[6,6],[3,0]],chairs:[[3,2],[4,3]],walls:[[2,5],[5,2]],range:5,hint:'Spot B has a clear diagonal path. Turn toward the northwest.',lesson:'The diagonal makes room for both chairs without going through the bookcase.'},
{name:'The divided lounge',pads:[[0,0],[0,6],[6,3]],chairs:[[2,2],[2,4],[3,3]],walls:[[4,2],[4,3],[4,4]],range:5,hint:'The bookcases block Spot C. Spot A, facing southeast, can reach all three.',lesson:'A whole wall of bookcases is no match for choosing the other side.'},
{name:'The last cold corner',pads:[[0,3],[3,0],[6,6]],chairs:[[1,4],[2,5],[3,4]],walls:[[2,2],[3,2],[4,2]],range:5.5,hint:'Try Spot A, facing southeast. Aim below the bookcases, not through them.',lesson:'All three chairs have a clear path. You have earned the good chair.'}
];
const names=['east','southeast','south','southwest','west','northwest','north','northeast'];
const canvas=document.querySelector('#room'),ctx=canvas.getContext('2d');
let stage=0,pad=0,angle=2,solved=false,finished=false;
const $=s=>document.querySelector(s);
function blocked(ax,ay,bx,by,wall){
 const dx=bx-ax,dy=by-ay; let lo=0,hi=1;
 for(const [a,d,mn,mx] of [[ax,dx,wall[0]-.5,wall[0]+.5],[ay,dy,wall[1]-.5,wall[1]+.5]]){
  if(Math.abs(d)<1e-9){if(a<mn||a>mx)return false}
  else{let t=(mn-a)/d,u=(mx-a)/d;if(t>u)[t,u]=[u,t];lo=Math.max(lo,t);hi=Math.min(hi,u);if(lo>hi)return false}
 }return hi>0&&lo<1;
}
function litAt(x,y,p=pad,a=angle){
 const l=levels[stage],h=l.pads[p],dx=x-h[0],dy=y-h[1],d=Math.hypot(dx,dy);
 if(d>l.range||d<.001)return false;
 const theta=a*Math.PI/4;
 if((dx*Math.cos(theta)+dy*Math.sin(theta))/d<Math.cos(Math.PI/6)-1e-9)return false;
 return !l.walls.some(w=>blocked(h[0],h[1],x,y,w));
}
function state(){return levels[stage].chairs.map(([x,y])=>litAt(x,y))}
function draw(){
 const l=levels[stage],unit=90,off=80;
 ctx.clearRect(0,0,700,700);ctx.fillStyle='#eddfbd';ctx.fillRect(0,0,700,700);
 ctx.strokeStyle='#d3c39e';ctx.lineWidth=1;
 for(let i=0;i<=7;i++){let v=35+i*90;ctx.beginPath();ctx.moveTo(v,35);ctx.lineTo(v,665);ctx.stroke();ctx.beginPath();ctx.moveTo(35,v);ctx.lineTo(665,v);ctx.stroke()}
 ctx.fillStyle='#ffb253';
 // Draw a data-derived visibility mask: the same geometry decides seat warmth.
 for(let y=35;y<665;y+=5)for(let x=35;x<665;x+=5)if(litAt((x+2.5-off)/unit,(y+2.5-off)/unit))ctx.fillRect(x,y,5,5);
 l.walls.forEach(([x,y])=>{ctx.fillStyle='#123e43';ctx.fillRect(off+x*unit-45,off+y*unit-45,90,90);ctx.strokeStyle='#658580';ctx.lineWidth=3;for(let z=-22;z<=22;z+=22){ctx.beginPath();ctx.moveTo(off+x*unit-32,off+y*unit+z);ctx.lineTo(off+x*unit+32,off+y*unit+z);ctx.stroke()}});
 l.pads.forEach(([x,y],i)=>{let px=off+x*unit,py=off+y*unit;ctx.strokeStyle='#123e43';ctx.lineWidth=2;ctx.setLineDash([5,5]);ctx.strokeRect(px-27,py-27,54,54);ctx.setLineDash([]);ctx.fillStyle='#123e43';ctx.font='bold 24px Trebuchet MS';ctx.textAlign='center';ctx.fillText('ABC'[i],px,py+9)});
 const warm=state();
 l.chairs.forEach(([x,y],i)=>{let px=off+x*unit,py=off+y*unit;ctx.fillStyle=warm[i]?'#ffb253':'#c0d9e0';ctx.strokeStyle='#123e43';ctx.lineWidth=3;ctx.beginPath();ctx.roundRect(px-30,py-31,60,64,10);ctx.fill();ctx.stroke();ctx.beginPath();ctx.moveTo(px-29,py-15);ctx.lineTo(px+29,py-15);ctx.stroke();ctx.fillStyle='#123e43';ctx.font='bold 25px Trebuchet MS';ctx.fillText(String(i+1),px,py+16)});
 const h=l.pads[pad],px=off+h[0]*unit,py=off+h[1]*unit;
 ctx.save();ctx.translate(px,py);ctx.rotate(angle*Math.PI/4);ctx.fillStyle='#bd461d';ctx.strokeStyle='#123e43';ctx.lineWidth=3;ctx.fillRect(-20,-30,40,60);ctx.strokeRect(-20,-30,40,60);ctx.strokeStyle='#fff3d5';ctx.lineWidth=3;for(let y=-18;y<=18;y+=12){ctx.beginPath();ctx.moveTo(-10,y);ctx.lineTo(10,y);ctx.stroke()}ctx.beginPath();ctx.moveTo(25,-10);ctx.lineTo(37,0);ctx.lineTo(25,10);ctx.stroke();ctx.restore();
}
function render(){
 const l=levels[stage],warm=state(),n=warm.filter(Boolean).length;
 $('#roomTitle').textContent=l.name;$('#roomCount').textContent='Room '+(stage+1)+' of 6';
 $('#mission').textContent='Warm all '+l.chairs.length+' chairs. Choose a heater spot, then turn the fan toward the seats.';
 $('#bearing').textContent='Facing '+names[angle]+' · range '+l.range+' squares';
 $('#warmCount').textContent=n+' of '+warm.length+' chairs warm';
 $('#seats').innerHTML=warm.map((v,i)=>'<li>Chair '+(i+1)+': '+(v?'warm, clear path':'cold, outside reach or blocked')+'</li>').join('');
 document.querySelectorAll('[data-pad]').forEach((b,i)=>b.setAttribute('aria-pressed',i===pad?'true':'false'));
 $('#next').hidden=!solved||finished;$('#next').textContent=stage===5?'Finish the visit':'Next room';
 $('#check').disabled=solved;
 $('#progress').innerHTML=levels.map((_,i)=>'<span class="'+(i<stage||i===stage&&solved?'done':'')+'"></span>').join('');
 $('#progress').setAttribute('aria-label',(stage+(solved?1:0))+' of 6 rooms solved');
 canvas.setAttribute('aria-label',l.name+'. Heater at Spot '+'ABC'[pad]+', facing '+names[angle]+'. '+n+' of '+warm.length+' chairs warm. '+l.walls.length+' bookcase squares. Chair details follow the controls.');
 draw();
}
function change(){if(finished)return;solved=false;$('#status').textContent='Arrangement changed. Try it when every chair is warm.';render()}
document.querySelectorAll('[data-pad]').forEach(b=>b.addEventListener('click',()=>{pad=Number(b.dataset.pad);change()}));
$('#left').onclick=()=>{angle=(angle+7)%8;change()};
$('#right').onclick=()=>{angle=(angle+1)%8;change()};
$('#check').onclick=()=>{
 let s=state();solved=s.every(Boolean);
 $('#status').textContent=solved?'Everyone is warm! '+levels[stage].lesson:'Still '+s.filter(v=>!v).length+' cold '+(s.filter(v=>!v).length===1?'chair.':'chairs.')+' Try another spot or turn the heater. No penalty for experimenting.';
 render();if(solved)$('#next').focus();
};
$('#hint').onclick=()=>{$('#hintText').hidden=!$('#hintText').hidden;$('#hintText').textContent=levels[stage].hint;$('#hint').textContent=$('#hintText').hidden?'Show a hint':'Hide the hint'};
function load(){
 pad=0;angle=2;solved=false;finished=false;$('#hintText').hidden=true;$('#hint').textContent='Show a hint';$('#status').textContent='The fan stops at bookcases and fades out at its range limit. Can every chair find a clear path?';$('#completion').hidden=true;render()
}
$('#reset').onclick=()=>{load()};
$('#next').onclick=()=>{
 if(stage<5){stage++;load();$('#roomTitle').focus()}
 else{finished=true;$('#next').hidden=true;$('#completion').hidden=false;$('#finishTitle').focus()}
};
$('#replay').onclick=()=>{stage=0;load();$('#roomTitle').focus()};
render();
</script></body></html>
