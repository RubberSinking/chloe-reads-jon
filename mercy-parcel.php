<?php
declare(strict_types=1);
// Keep the source URL in the gallery's existing source registry.
// The page itself uses relative URLs, including this source-link relay.
if (isset($_GET['source'])) {
    $registry = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="(https?://[^"]+/2015/02/dont-just-make-something-rather-make\.html)"~', $registry, $match)) {
        header('Location: ' . html_entity_decode($match[1], ENT_QUOTES), true, 302);
        exit;
    }
    http_response_code(503);
    exit('The source link is temporarily unavailable. Please return to the gallery.');
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#f8e8a6">
<meta name="description" content="A little donation-packing puzzle. Turn the pieces, fill the parcel, send some good.">
<title>Mercy Parcel</title>
<style>
@font-face{font-family:ParcelBook;src:url("mercy-parcel-bookman.otf") format("opentype");font-weight:700;font-display:swap}
:root{--butter:#f8e8a6;--blue:#193c8c;--red:#b52f23;--cream:#fff9e9;--ink:#172d58}
*{box-sizing:border-box}
body{margin:0;background:var(--butter);color:var(--ink);font:1rem/1.5 system-ui,sans-serif}
::selection{background:var(--blue);color:var(--cream)}
html{scrollbar-color:var(--blue) var(--butter)}
a{color:var(--blue);text-underline-offset:.2em}
button{font:inherit;cursor:pointer;touch-action:manipulation}
button:disabled{cursor:default;opacity:.5}
:focus-visible{outline:3px solid var(--red);outline-offset:4px}
.wrap{max-width:1160px;margin:auto;padding:22px clamp(16px,4vw,52px) 40px}
nav{display:flex;justify-content:space-between;align-items:center;gap:16px;border-bottom:2px solid var(--blue);padding-bottom:14px}
nav span{font-size:.85rem}
h1,h2,h3{font-family:ParcelBook,Georgia,serif;font-weight:700;text-wrap:balance}
h1{font-size:clamp(2.7rem,7vw,5.8rem);line-height:1.05;color:var(--blue);letter-spacing:-.035em;margin:25px 0 8px}
.intro{margin:0 0 26px;max-width:65ch;font-size:1.05rem}
.workspace{display:grid;grid-template-columns:minmax(0,1.1fr) minmax(0,1fr);gap:clamp(24px,5vw,62px);align-items:start}
.packing{min-width:0}
.board-heading{display:flex;justify-content:space-between;align-items:baseline;gap:8px;margin-bottom:10px}
.board-heading h2{font-size:1.3rem;margin:0}
#count{font-size:.95rem;font-variant-numeric:tabular-nums}
.board{display:grid;grid-template-columns:repeat(var(--cols,5),1fr);gap:4px;padding:8px;background:var(--blue);border:3px solid var(--blue);aspect-ratio:var(--ratio,1.25)}
.cell{border:0;border-radius:0;background:var(--cream);color:var(--blue);padding:0;min-width:0;font-size:clamp(.85rem,3vw,1.15rem);font-weight:800;position:relative}
.cell:hover{outline:3px solid var(--red);outline-offset:-3px}
.cell.occupied{background:var(--piece);color:var(--piece-ink)}
.cell.hint{outline:4px dashed var(--red);outline-offset:-5px}
.cell.preview{background:#d1ddf2}
.cell:focus-visible{outline:3px solid var(--red);outline-offset:-5px;z-index:1}
#status{min-height:3.4em;margin:12px 0 6px;font-weight:600;max-width:65ch}
.tools{display:flex;gap:8px;flex-wrap:wrap}
.tools button,.next{min-height:44px;padding:8px 14px;border:1px solid var(--blue);color:var(--blue);background:transparent;border-radius:6px;font-weight:650}
.tools button:hover:not(:disabled){background:var(--cream)}
.tools .rotate{background:var(--blue);color:var(--cream)}
.tools .rotate:hover:not(:disabled){background:#102c6f}
.instructions{margin:14px 0 0;font-size:.88rem;max-width:65ch}
.delivery{border-top:3px solid var(--blue);padding-top:10px}
.delivery h2{font-size:1.55rem;margin:0 0 6px}
#brief{margin:0 0 16px;max-width:65ch}
.pieces{margin-bottom:16px;display:grid;grid-template-columns:1fr 1fr;gap:8px}
.piece{display:flex;align-items:center;gap:10px;min-height:72px;text-align:left;border:1px solid var(--blue);background:var(--cream);color:var(--ink);padding:8px;border-radius:6px}
.piece[aria-pressed="true"]{outline:3px solid var(--blue);outline-offset:1px}
.piece:hover:not(:disabled){background:#fff}
.piece small{display:block;font-size:.76rem;margin-top:2px}
.mini{display:grid;grid-template-columns:repeat(4,9px);grid-template-rows:repeat(4,9px);gap:2px;flex-shrink:0}
.mini i{background:var(--piece);border:1px solid var(--piece-ink)}
.manifest{margin:22px 0 0}
.manifest img{display:block;width:100%;height:auto;aspect-ratio:3/2;object-fit:cover}
.manifest figcaption{font-size:.85rem;margin-top:7px}
.receipt{background:var(--blue);color:var(--cream);padding:20px;margin-top:16px}
.receipt h2{font-size:1.8rem;margin:0 0 6px;color:var(--butter)}
.receipt p{margin:0 0 14px}
.next{background:var(--butter);border:0;color:var(--blue)}
[hidden]{display:none!important}
footer{border-top:2px solid var(--blue);padding-top:20px;margin-top:36px;font-size:.9rem;max-width:75ch}
footer p{margin:0 0 12px}
@keyframes arrive{from{transform:translateY(12px);filter:brightness(1.3)}to{transform:translateY(0);filter:brightness(1)}}
.receipt:not([hidden]){animation:arrive .45s cubic-bezier(.16,1,.3,1)}
@media(max-width:700px){.wrap{padding-top:16px}.workspace{grid-template-columns:1fr;gap:26px}h1{margin-top:20px}.intro{margin-bottom:20px}.board{max-width:480px}.pieces{grid-template-columns:1fr 1fr}.delivery{padding-top:14px}nav span{font-size:.75rem}.manifest{max-width:480px}}
@media(max-width:360px){.wrap{padding-left:6px;padding-right:6px}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;scroll-behavior:auto!important}}
</style>
</head>
<body>
<div class="wrap">
<nav aria-label="Gallery"><a href="./">Chloe Reads Jon</a><span>A little good, well packed.</span></nav>
<header><h1>Mercy Parcel</h1><p class="intro">The gifts are ready. The box is small. Fit every donation inside, then send a little good into the world.</p></header>
<main class="workspace">
<section class="packing" aria-labelledby="packing-title">
<div class="board-heading"><h2 id="packing-title" tabindex="-1">Pack the parcel</h2><span id="count">0 of 5 packed</span></div>
<div id="board" class="board" role="group" aria-label="Parcel packing squares"></div>
<p id="status" role="status" aria-live="polite">Choose a donation, then tap a square to place it.</p>
<div id="pieces" class="pieces" role="group" aria-label="Donations to pack"></div>
<div class="tools">
<button class="rotate" id="rotate" type="button">Rotate piece</button>
<button id="undo" type="button" disabled>Undo</button>
<button id="hint" type="button">Show a hint</button>
<button id="reset" type="button">Start box over</button>
</div>
<p class="instructions">Pick a donation just below the box. Tap where the first filled square in its top row should go. Tap a packed piece to take it out. Keyboard: Tab to a square, Enter to place; R rotates.</p>
<section class="receipt" id="receipt" aria-labelledby="receipt-title" hidden>
<h2 id="receipt-title" tabindex="-1">Ready to do some good.</h2><p id="receipt-text"></p><button id="next" class="next" type="button">Pack the next delivery</button>
</section>
</section>
<aside class="delivery" aria-labelledby="destination">
<h2 id="destination"></h2><p id="brief"></p>
<figure class="manifest">
<img src="mercy-parcel-scene.webp" width="1536" height="1024" alt="A neighbourhood donation table with blankets, food and books being packed, with a delivery bicycle outside." id="scene">
<figcaption id="caption">A small box. A real reason to make room.</figcaption>
</figure>
</aside>
</main>
<footer><p>Inspired by Jon's <a href="?source=1">Don't just "make something". Rather, "make good".</a> He makes a case for the works of mercy over making things merely for the sake of it. This puzzle is a tiny nudge toward the useful, generous thing.</p><p>Three fictional deliveries. No clock, no score, no parcel left behind. If it sparks an idea, ask a local charity what they actually need before donating.</p></footer>
</div>
<script>
'use strict';
const palettes=[['#b52f23','#fff9e9'],['#245934','#fff9e9'],['#193c8c','#fff9e9'],['#e3ac38','#172d58'],['#634387','#fff9e9'],['#a93d54','#fff9e9']];
const levels=[
{title:'The welcome hamper',brief:'A family is settling into a new home. Pack something warm, something useful, and a story for the first evening.',w:5,h:4,names:['Blankets','Pantry tins','Storybooks','Warm socks','Kitchen kit'],note:'The welcome hamper is packed. A new beginning, with one less thing to worry about.',shapes:[[[0,0],[1,0],[0,1],[1,1]],[[0,0],[1,0],[2,0],[2,1]],[[0,0],[1,0],[0,1],[1,1]],[[0,0],[1,0],[0,1],[1,1]],[[2,0],[0,1],[1,1],[2,1]]]},
{title:'The community supper',brief:'The hall is opening its doors tonight. These unusually geometric supplies all need a place in the box.',w:6,h:4,names:['Rice bags','Soup tins','Tea towels','Fruit boxes','Oat packets','Napkins'],note:'The supper supplies are on their way. There is room at the table.',shapes:[[[0,0],[1,0],[2,0],[1,1]],[[0,0],[1,0],[2,0],[1,1]],[[0,0],[0,1],[0,2],[1,2]],[[0,0],[0,1],[0,2],[1,2]],[[0,0],[1,0],[2,0],[3,0]],[[0,0],[1,0],[0,1],[1,1]]]},
{title:'The winter drop-off',brief:'A cold-weather collection needs every item. This box has a different shape, so old packing habits may need a quarter turn.',w:4,h:5,names:['Winter coats','Mittens','Scarves','Blankets','Thick socks'],note:'The winter parcel is ready. Warmth is an excellent thing to pass along.',shapes:[[[0,0],[1,0],[0,1],[1,1]],[[0,0],[1,0],[2,0],[2,1]],[[0,0],[1,0],[0,1],[1,1]],[[0,0],[1,0],[0,1],[1,1]],[[2,0],[0,1],[1,1],[2,1]]]}
];
const $=id=>document.getElementById(id);
let levelIndex=0,selected=0,rotation=0,placed=[],history=[],hintCells=[],done=false,completed=new Set();
function norm(s){const x=Math.min(...s.map(p=>p[0])),y=Math.min(...s.map(p=>p[1]));return s.map(p=>[p[0]-x,p[1]-y]).sort((a,b)=>a[1]-b[1]||a[0]-b[0]);}
function turn(s){return norm(s.map(p=>[-p[1],p[0]]));}
function shape(i,r=0){let s=norm(levels[levelIndex].shapes[i]);for(let j=0;j<r;j++)s=turn(s);return s;}
function occupied(list=placed){const a=Array(levels[levelIndex].w*levels[levelIndex].h).fill(-1);for(const p of list)for(const [x,y]of p.cells)a[y*levels[levelIndex].w+x]=p.id;return a;}
function locate(s,x,y){return s.map(p=>[p[0]+x,p[1]+y]);}
function locateAtTap(s,x,y){return locate(s,x-s[0][0],y-s[0][1]);}
function fits(cells,list=placed){const l=levels[levelIndex],a=occupied(list);return cells.every(([x,y])=>x>=0&&y>=0&&x<l.w&&y<l.h&&a[y*l.w+x]===-1);}
function save(){history.push(JSON.parse(JSON.stringify(placed)));hintCells=[];}
function say(t){$('status').textContent=t;}
function shapeDescription(s){const rows=[];for(let y=0;y<=Math.max(...s.map(p=>p[1]));y++){const cols=s.filter(p=>p[1]===y).map(p=>p[0]+1);rows.push('row '+(y+1)+', columns '+cols.join(' and '));}return 'Shape: '+rows.join('; ')+'.';}
function render(){
const active=document.activeElement,focusCell=active?.dataset.cell,focusPiece=active?.dataset.piece;
const l=levels[levelIndex],a=occupied();
$('board').style.setProperty('--cols',l.w);$('board').style.setProperty('--ratio',l.w+'/'+l.h);
$('board').replaceChildren();
for(let y=0;y<l.h;y++)for(let x=0;x<l.w;x++){
 const i=a[y*l.w+x],b=document.createElement('button');b.type='button';b.className='cell';b.dataset.cell=x+','+y;
 b.setAttribute('aria-label','Row '+(y+1)+', column '+(x+1)+(i<0?', empty':', '+l.names[i]+', remove'));
 if(i>=0){b.classList.add('occupied');b.style.setProperty('--piece',palettes[i][0]);b.style.setProperty('--piece-ink',palettes[i][1]);b.textContent=String.fromCharCode(65+i);}
 if(hintCells.some(p=>p[0]===x&&p[1]===y))b.classList.add('hint');
 b.addEventListener('click',()=>place(x,y));
 b.addEventListener('pointerenter',()=>preview(x,y));b.addEventListener('pointerleave',clearPreview);
 $('board').append(b);
}
$('pieces').replaceChildren();
for(let i=0;i<l.names.length;i++){
 const packed=placed.some(p=>p.id===i),b=document.createElement('button');b.type='button';b.className='piece';b.dataset.piece=i;b.disabled=packed||done;b.setAttribute('aria-pressed',String(i===selected&&!packed));
 const mini=document.createElement('span');mini.className='mini';mini.setAttribute('aria-hidden','true');
 const s=shape(i,i===selected?rotation:0);b.setAttribute('aria-label',String.fromCharCode(65+i)+', '+l.names[i]+'. '+(packed?'Packed. ':i===selected?'Selected. ':'Choose donation. ')+shapeDescription(s));for(const [x,y]of s){const tile=document.createElement('i');tile.style.gridColumn=x+1;tile.style.gridRow=y+1;tile.style.setProperty('--piece',palettes[i][0]);tile.style.setProperty('--piece-ink',palettes[i][1]);mini.append(tile);}
 const txt=document.createElement('span');txt.textContent=String.fromCharCode(65+i)+' · '+l.names[i];const detail=document.createElement('small');detail.textContent=packed?'Packed':i===selected?'Selected · tap the box':'Tap to choose';txt.append(detail);b.append(mini,txt);
 b.onclick=()=>{selected=i;rotation=0;hintCells=[];render();say(l.names[i]+' selected. Tap where its first top-row square should go.');};$('pieces').append(b);
}
$('count').textContent=placed.length+' of '+l.names.length+' packed';
$('undo').disabled=!history.length;$('rotate').disabled=done||selected<0;$('hint').disabled=done;
$('receipt').hidden=!done;$('next').textContent=completed.size===3?'Pack them all again':'Pack the next delivery';
if(focusCell!==undefined)document.querySelector('[data-cell="'+focusCell+'"]')?.focus({preventScroll:true});
else if(focusPiece!==undefined){const target=document.querySelector('[data-piece="'+focusPiece+'"]');if(target&&!target.disabled)target.focus({preventScroll:true});else $('board').querySelector('button')?.focus({preventScroll:true});}
}
function clearPreview(){document.querySelectorAll('.cell.preview').forEach(b=>b.classList.remove('preview'));}
function preview(x,y){clearPreview();if(done||selected<0||occupied()[y*levels[levelIndex].w+x]>=0)return;const c=locateAtTap(shape(selected,rotation),x,y);if(fits(c))for(const [cx,cy]of c)$('board').children[cy*levels[levelIndex].w+cx].classList.add('preview');}
function place(x,y){
 const l=levels[levelIndex],old=occupied()[y*l.w+x];
 if(old>=0){save();placed=placed.filter(p=>p.id!==old);selected=old;rotation=0;done=false;render();say(l.names[old]+' is back on the table.');return;}
 if(done||selected<0)return;
 const c=locateAtTap(shape(selected,rotation),x,y);
 if(!fits(c)){say('That piece overlaps or reaches outside the box. Try another square or rotate it.');return;}
 save();placed.push({id:selected,cells:c});selected=l.names.findIndex((n,i)=>!placed.some(p=>p.id===i));rotation=0;
 done=placed.length===l.names.length;
 if(done){completed.add(levelIndex);$('receipt-text').textContent=l.note+(completed.size===3?' All three deliveries packed. Nicely done!':'');$('caption').textContent='Packed with care. Ready for the doorstep.';}
 render();say(done?'Every donation fits. Your parcel is ready!':l.names[selected]+' selected next. You can choose a different donation.');
 if(done)$('receipt-title').focus();
}
function solve(list=placed){
 const l=levels[levelIndex],a=occupied(list),empty=a.indexOf(-1);if(empty<0)return list;
 const x=empty%l.w,y=Math.floor(empty/l.w);
 for(let id=0;id<l.names.length;id++){if(list.some(p=>p.id===id))continue;const seen=new Set();
 for(let r=0;r<4;r++){const s=shape(id,r),key=JSON.stringify(s);if(seen.has(key))continue;seen.add(key);
 for(const [dx,dy]of s){const c=locate(s,x-dx,y-dy);if(fits(c,list)){const answer=solve([...list,{id,cells:c,r,x:x-dx+s[0][0],y:y-dy+s[0][1]}]);if(answer)return answer;}}
 }}return null;
}
$('rotate').onclick=()=>{if(selected<0||done)return;rotation=(rotation+1)%4;hintCells=[];render();say(levels[levelIndex].names[selected]+' rotated. '+shapeDescription(shape(selected,rotation))+' Tap a square to place it.');};
$('undo').onclick=()=>{if(!history.length)return;placed=history.pop();done=false;hintCells=[];selected=levels[levelIndex].names.findIndex((n,i)=>!placed.some(p=>p.id===i));rotation=0;render();say('Last change undone.');};
$('hint').onclick=()=>{const answer=solve();if(!answer){say('These pieces leave no complete fit. Undo a placement or start the box over, then ask again.');return;}const p=answer[placed.length];selected=p.id;rotation=p.r;hintCells=p.cells;render();say('Try '+levels[levelIndex].names[selected]+' in the dashed squares. Tap row '+(p.y+1)+', column '+(p.x+1)+'.');};
function start(){placed=[];history=[];hintCells=[];selected=0;rotation=0;done=false;const l=levels[levelIndex];$('destination').textContent=l.title;$('brief').textContent=l.brief;$('caption').textContent='A small box. A real reason to make room.';render();say('Choose a donation, then tap a square to place it.');}
$('reset').onclick=()=>{start();say('Fresh box. Every donation is back on the table.');};
$('next').onclick=()=>{if(completed.size===3){completed.clear();levelIndex=0;}else levelIndex=(levelIndex+1)%levels.length;start();$('packing-title').focus({preventScroll:true});$('packing-title').scrollIntoView({block:'start',behavior:matchMedia('(prefers-reduced-motion: reduce)').matches?'auto':'smooth'});};
document.addEventListener('keydown',e=>{if(e.key.toLowerCase()==='r'&&!e.ctrlKey&&!e.metaKey&&!e.altKey){e.preventDefault();$('rotate').click();}});
start();
</script>
</body>
</html>
