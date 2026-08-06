<?php // All analysis happens locally in the browser; no text is submitted. ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#efe7d3">
<title>The Word Weather Bureau</title>
<style>
:root{--paper:#efe7d3;--light:#faf5e8;--ink:#27241f;--muted:#706a5e;--rule:#aaa088;--red:#b53a2d;--blue:#165c73;--gold:#c58a25}
*{box-sizing:border-box}html{min-height:100%;background:#cfc4aa}
body{margin:0;min-height:100vh;color:var(--ink);font-family:"Palatino Linotype",Palatino,"Book Antiqua",Georgia,serif;background:radial-gradient(circle at 16% 12%,rgba(255,255,255,.55),transparent 25rem),repeating-linear-gradient(89deg,rgba(71,56,29,.025) 0 1px,transparent 1px 5px),var(--paper)}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.25;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");mix-blend-mode:multiply;z-index:20}
button,textarea,select,input{font:inherit}a{color:var(--blue);text-underline-offset:3px}
.masthead{max-width:1500px;margin:auto;padding:22px clamp(16px,4vw,60px) 10px;animation:arrive .7s ease-out both}
.eyebrow{display:flex;align-items:center;gap:12px;font:700 11px/1.2 "Courier New",monospace;text-transform:uppercase;letter-spacing:.16em}.eyebrow:before,.eyebrow:after{content:"";height:1px;flex:1;background:var(--ink)}
h1{margin:9px 0 2px;font-size:clamp(2.4rem,7vw,6.6rem);line-height:.84;letter-spacing:-.065em;text-align:center;text-transform:uppercase;font-weight:900}
.subhead{display:flex;justify-content:space-between;gap:20px;border-block:4px double var(--ink);margin-top:14px;padding:7px 2px;font:700 clamp(.68rem,1.6vw,.9rem)/1.2 "Courier New",monospace;text-transform:uppercase;letter-spacing:.09em}
main{max-width:1500px;margin:auto;padding:18px clamp(16px,4vw,60px) 46px;display:grid;grid-template-columns:minmax(250px,330px) minmax(0,1fr);gap:clamp(18px,3vw,38px)}
.desk,.report{background:rgba(250,245,232,.74);border:1px solid var(--rule);box-shadow:5px 7px 0 rgba(88,72,42,.12)}
.desk{padding:18px;align-self:start;transform:rotate(-.18deg)}
.section-label{display:flex;align-items:center;justify-content:space-between;margin:0 0 9px;font:700 11px/1 "Courier New",monospace;letter-spacing:.13em;text-transform:uppercase}.stamp{color:var(--red);border:2px solid;padding:4px 6px 2px;transform:rotate(2deg)}
textarea{width:100%;min-height:210px;resize:vertical;border:1px solid #8d836d;border-radius:0;padding:13px;color:var(--ink);background:rgba(255,253,246,.74);font-size:15px;line-height:1.55}
textarea:focus,select:focus,button:focus-visible,input:focus-visible{outline:3px solid rgba(22,92,115,.3);outline-offset:2px}.count{margin:5px 0 17px;color:var(--muted);text-align:right;font:11px/1.4 "Courier New",monospace}
.control{padding:12px 0;border-top:1px dotted var(--rule)}.control label{display:flex;justify-content:space-between;gap:12px;font-size:14px;font-weight:700}.value{color:var(--red);font-family:"Courier New",monospace}
input[type=range]{width:100%;margin:11px 0 2px;accent-color:var(--red)}.select-row{display:grid;grid-template-columns:1fr 1fr;gap:9px}select{width:100%;padding:9px 6px;border:1px solid #8d836d;border-radius:0;background:var(--light);font-size:13px}
.buttons{display:grid;grid-template-columns:1fr auto;gap:8px;margin-top:15px}button{border:1px solid var(--ink);border-radius:0;padding:11px 13px;background:var(--light);color:var(--ink);font:700 12px/1 "Courier New",monospace;text-transform:uppercase;letter-spacing:.06em;box-shadow:2px 2px 0 var(--ink);cursor:pointer;transition:.12s}button:active{transform:translate(2px,2px);box-shadow:none}.primary{color:#fff9e9;background:var(--red)}
.privacy{margin:15px 0 0;font-size:12px;color:var(--muted);font-style:italic}.report{min-width:0;overflow:hidden;animation:arrive .7s .12s ease-out both}.report-head{display:flex;justify-content:space-between;align-items:center;gap:12px;padding:11px 14px;border-bottom:1px solid var(--rule);font:11px/1.2 "Courier New",monospace;text-transform:uppercase}.lamp{display:inline-block;width:8px;height:8px;border-radius:50%;background:#658d56;box-shadow:0 0 0 3px rgba(101,141,86,.2);margin-right:7px}
.canvas-wrap{position:relative;min-height:clamp(390px,63vw,720px);background:#f8f1df;cursor:crosshair}.canvas-wrap:after{content:"Click a word to inspect its forecast";position:absolute;right:10px;bottom:8px;color:var(--muted);font:10px "Courier New",monospace;pointer-events:none}canvas{display:block;width:100%;height:100%;position:absolute;inset:0}
.empty{position:absolute;inset:0;display:grid;place-content:center;text-align:center;padding:30px;pointer-events:none}.empty b{display:block;font-size:clamp(1.8rem,4vw,3.5rem);line-height:.9;text-transform:uppercase}.empty span{display:block;max-width:420px;margin:12px auto;color:var(--muted);font-style:italic}.empty.gone{display:none}
.inspector{display:grid;grid-template-columns:minmax(140px,.55fr) 1.45fr;border-top:4px double var(--ink);min-height:112px}.word-card{padding:16px;border-right:1px solid var(--rule);display:grid;align-content:center}.word-card small,.context small{font:10px "Courier New",monospace;text-transform:uppercase;letter-spacing:.12em;color:var(--muted)}.selected{font-size:clamp(1.4rem,3vw,2.5rem);font-weight:900;line-height:1}.context{padding:15px 18px}.quote{margin:7px 0 0;font-style:italic;line-height:1.45}
footer{max-width:1500px;margin:0 auto;padding:0 clamp(16px,4vw,60px) 40px;font-size:14px;line-height:1.5}.back{display:inline-block;margin-right:18px}
@keyframes arrive{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}@media(max-width:780px){main{grid-template-columns:1fr}.desk{transform:none}.canvas-wrap{min-height:480px}.inspector{grid-template-columns:1fr}.word-card{border-right:0;border-bottom:1px solid var(--rule)}h1{letter-spacing:-.045em}.subhead span:last-child{display:none}}@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
</style>
</head>
<body>
<header class="masthead">
 <div class="eyebrow">Daily linguistic conditions since 2008</div>
 <h1>Word Weather Bureau</h1>
 <div class="subhead"><span>Vol. XVIII · No. 08</span><span>Your text, seen from above</span><span>Fair skies · strong nouns</span></div>
</header>
<main>
 <aside class="desk">
  <div class="section-label"><span>Incoming dispatch</span><span class="stamp">Local only</span></div>
  <textarea id="text" aria-label="Text to analyse">There was once a wild robot named Roz who opened her eyes on an island. The island was full of wind and waves, curious animals, small tracks, and enormous questions. Roz listened. She learned the language of rain and wings. Most of all, she discovered that kindness is a kind of intelligence, and that a home can grow wherever someone chooses to care.</textarea>
  <div class="count" id="count">0 words received</div>
  <div class="control"><label for="words">Words on the map <span class="value" id="wordsOut">42</span></label><input id="words" type="range" min="15" max="80" value="42"></div>
  <div class="select-row">
   <div><div class="section-label">Formation</div><select id="shape"><option value="cloud">Cumulus</option><option value="storm">Thunderhead</option><option value="front">Weather front</option></select></div>
   <div><div class="section-label">Ink set</div><select id="palette"><option value="press">Morning press</option><option value="lake">Coastal rain</option><option value="sunset">Red sky</option></select></div>
  </div>
  <div class="buttons"><button class="primary" id="forecast">Issue forecast</button><button id="shuffle" title="Shuffle layout" aria-label="Shuffle layout">↻</button></div>
  <p class="privacy">The bureau keeps no copies. Your words never leave this page.</p>
 </aside>
 <section class="report" aria-label="Word cloud report">
  <div class="report-head"><span><i class="lamp"></i><span id="status">Bureau ready</span></span><button id="save">Save print</button></div>
  <div class="canvas-wrap" id="wrap"><canvas id="cloud"></canvas><div class="empty" id="empty"><b>Awaiting<br>conditions</b><span>Paste a story, journal entry, speech, or splendidly overlong school report.</span></div></div>
  <div class="inspector">
   <div class="word-card"><small>Selected reading</small><div class="selected" id="selected">—</div><small id="frequency">Tap a word above</small></div>
   <div class="context"><small>Found in the field report</small><p class="quote" id="quote">The surrounding sentence will appear here, like a clue clipped from a newspaper.</p></div>
  </div>
 </section>
</main>
<footer><a class="back" href="./">← All experiments</a> Inspired by Jon's <a href="https://jona.ca/2008/06/wordle-turn-your-words-into-colorful.html">“Wordle: Turn your words into a colorful cloud”</a>.</footer>
<script>
const $=s=>document.querySelector(s), canvas=$("#cloud"),ctx=canvas.getContext("2d");
const stop=new Set(("a an and are as at be been but by can could did do does for from had has have he her hers him his how i if in into is it its just may me might more most my no not of on one or our out over she so some than that the their them then there these they this those through to too under up us very was we were what when where which who why will with would you your").split(" "));
const palettes={press:["#27241f","#b53a2d","#165c73","#6b603f"],lake:["#173b4c","#236b78","#58949b","#b87042"],sunset:["#642e28","#b74432","#d88931","#263c50"]};
let hits=[],seed=1,source="",freqs={};
function mulberry(a){return function(){a|=0;a=a+0x6D2B79F5|0;let t=Math.imul(a^a>>>15,1|a);t=t+Math.imul(t^t>>>7,61|t)^t;return((t^t>>>14)>>>0)/4294967296}}
function words(){
 source=$("#text").value.trim();
 const tokens=(source.toLowerCase().match(/[a-z\u00c0-\u024f']+/g)||[]).map(w=>w.replace(/^'|'$/g,"")).filter(w=>w.length>2&&!stop.has(w));
 freqs={};tokens.forEach(w=>freqs[w]=(freqs[w]||0)+1);
 return Object.entries(freqs).sort((a,b)=>b[1]-a[1]||b[0].length-a[0].length).slice(0,+$("#words").value);
}
function resize(){
 const r=$("#wrap").getBoundingClientRect(),d=Math.min(devicePixelRatio||1,2);
 canvas.width=Math.round(r.width*d);canvas.height=Math.round(r.height*d);ctx.setTransform(d,0,0,d,0,0);
}
function allowed(x,y,w,h,W,H,shape){
 const cx=x+w/2,cy=y+h/2,dx=(cx-W/2)/(W*.46),dy=(cy-H/2)/(H*.43);
 if(shape==="front")return x>12&&y>28&&x+w<W-12&&y+h<H-28&&Math.abs(dy+dx*.24)<.78;
 if(shape==="storm")return x>12&&y>42&&x+w<W-12&&y+h<H-20&&(dx*dx+dy*dy<1||cy>H*.55&&Math.abs(dx)<.58);
 return x>12&&y>25&&x+w<W-12&&y+h<H-25&&dx*dx+dy*dy<1;
}
function overlaps(box){return hits.some(b=>!(box.x+box.w+3<b.x||box.x>b.x+b.w+3||box.y+box.h+2<b.y||box.y>b.y+b.h+2))}
function draw(){
 resize();hits=[];const list=words(),W=canvas.clientWidth,H=canvas.clientHeight;
 if(!list.length){$("#empty").classList.remove("gone");return}
 $("#empty").classList.add("gone");ctx.clearRect(0,0,W,H);
 const max=list[0][1],min=list[list.length-1][1],random=mulberry(seed),colors=palettes[$("#palette").value],shape=$("#shape").value;
 list.forEach((entry,i)=>{
  const word=entry[0],n=entry[1],ratio=max===min?1-i/Math.max(1,list.length)*.65:(n-min)/(max-min);
  let size=Math.max(13,Math.min(W/5,17+ratio*Math.min(64,W/10))),placed=null;
  while(size>=11&&!placed){
   ctx.font=(i<4?"900 ":"700 ")+size+"px Palatino Linotype, Georgia, serif";
   const tw=ctx.measureText(word).width,th=size*1.02,vertical=random()<.1&&word.length<8;
   const bw=vertical?th:tw,bh=vertical?tw:th;
   for(let j=0;j<620;j++){
    const angle=j*.48+random()*.18,radius=2.5*Math.sqrt(j),cx=W/2+Math.cos(angle)*radius*(shape==="front"?1.45:1),cy=H/2+Math.sin(angle)*radius*(shape==="front"?.65:1);
    const box={x:cx-bw/2,y:cy-bh/2,w:bw,h:bh,word,n,size,color:colors[i%colors.length],vertical};
    if(allowed(box.x,box.y,bw,bh,W,H,shape)&&!overlaps(box)){placed=box;break}
   }
   if(!placed)size-=2;
  }
  if(placed)hits.push(placed);
 });
 hits.forEach(b=>{
  ctx.save();ctx.translate(b.x+b.w/2,b.y+b.h/2);if(b.vertical)ctx.rotate(-Math.PI/2);
  ctx.font=(b.size>36?"900 ":"700 ")+b.size+"px Palatino Linotype, Georgia, serif";ctx.textAlign="center";ctx.textBaseline="middle";ctx.fillStyle=b.color;ctx.fillText(b.word,0,0);ctx.restore();
 });
 $("#status").textContent=hits.length+" terms charted · "+Object.keys(freqs).length+" unique";
}
function sentenceFor(word){
 const parts=source.match(/[^.!?]+[.!?]?/g)||[source],found=parts.find(s=>new RegExp("\\b"+word+"\\b","i").test(s));
 return found?found.trim():"No surrounding sentence found.";
}
function inspect(b){$("#selected").textContent=b.word;$("#selected").style.color=b.color;$("#frequency").textContent=b.n+(b.n===1?" appearance":" appearances");$("#quote").textContent="“"+sentenceFor(b.word)+"”"}
canvas.addEventListener("click",e=>{const r=canvas.getBoundingClientRect(),x=e.clientX-r.left,y=e.clientY-r.top,b=hits.find(v=>x>=v.x&&x<=v.x+v.w&&y>=v.y&&y<=v.y+v.h);if(b)inspect(b)});
$("#text").addEventListener("input",()=>{$("#count").textContent=(($("#text").value.match(/\b[\w']+\b/g)||[]).length)+" words received"});
$("#words").addEventListener("input",e=>$("#wordsOut").textContent=e.target.value);
$("#forecast").addEventListener("click",()=>{seed=Math.floor(Math.random()*1e9);draw()});
$("#shuffle").addEventListener("click",()=>{seed=Math.floor(Math.random()*1e9);draw()});
$("#shape").addEventListener("change",draw);$("#palette").addEventListener("change",draw);
$("#save").addEventListener("click",()=>{const a=document.createElement("a");a.download="word-weather.png";a.href=canvas.toDataURL("image/png");a.click()});
let timer;addEventListener("resize",()=>{clearTimeout(timer);timer=setTimeout(draw,150)});
$("#text").dispatchEvent(new Event("input"));seed=20080613;draw();
</script>
</body>
</html>
