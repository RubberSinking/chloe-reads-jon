<?php
declare(strict_types=1);
if (isset($_GET['source'])) {
    $index = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="(https?://[^"]+/2004/10/marvels-by-busiek-ross-just-finished\\.html)"~', $index, $m)) {
        header('Location: ' . html_entity_decode($m[1], ENT_QUOTES), true, 302); exit;
    }
    http_response_code(503); exit('The source link is unavailable. Please return to the gallery.');
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#f0e8d8">
<meta name="description" content="An illustrated witness mystery. Piece together an extraordinary afternoon, then decide who deserves the headline.">
<title>Street-Level Stories</title>
<style>
@font-face{font-family:Street;src:url("assets/tomorrows-bouquet-bookman.otf") format("opentype");font-weight:700;font-display:swap}
:root{--paper:#f0e8d8;--ink:#192c35;--muted:#45525a;--red:#963c2b;--line:#a59f90;--wash:#e0d6c3;--light:#fffaf0;--teal:#1b585b}
*{box-sizing:border-box}
html{scrollbar-color:var(--red) var(--paper)}
body{margin:0;background:var(--paper);color:var(--ink);font:1.05rem/1.55 Georgia,serif}
::selection{background:var(--red);color:var(--light)}
a{color:inherit;text-underline-offset:4px}
button{font:600 .9rem/1.3 "Trebuchet MS",sans-serif;color:var(--ink);background:transparent;border:1px solid var(--ink);border-radius:0;min-height:46px;padding:10px 14px;cursor:pointer;touch-action:manipulation}
button:hover:not(:disabled){background:var(--ink);color:var(--light)}
button:disabled{opacity:.35;cursor:default}
:focus-visible{outline:3px solid var(--red);outline-offset:4px}
button:focus-visible{position:relative;z-index:1}
[hidden]{display:none!important}
.paper{max-width:1300px;margin:auto;padding:20px clamp(16px,4vw,52px) 38px}
nav{display:flex;justify-content:space-between;gap:12px;align-items:center;font: .85rem/1.5 "Trebuchet MS",sans-serif}
nav span{color:var(--muted);text-align:right}
header{border-bottom:5px double var(--ink);margin:25px 0 24px;padding-bottom:15px}
h1,h2,h3{font-family:Street,Georgia,serif;line-height:1.12;text-wrap:balance}
h1{font-size:clamp(2.6rem,7vw,5.8rem);margin:0;letter-spacing:-.035em}
.deck{display:flex;gap:20px;justify-content:space-between;margin-top:14px;padding-top:10px;border-top:1px solid var(--ink);font:.9rem/1.4 "Trebuchet MS",sans-serif}
.deck span:last-child{font-style:italic;text-align:right}
.lead{display:grid;grid-template-columns:minmax(0,1.8fr) minmax(280px,1fr);gap:28px}
figure{margin:0}
.scene{display:block;width:100%;height:auto;aspect-ratio:3/2;object-fit:cover;background:var(--wash)}
figcaption{font:.82rem/1.5 "Trebuchet MS",sans-serif;color:var(--muted);margin-top:8px}
h2{font-size:clamp(1.65rem,3vw,2.3rem);margin:0 0 14px;letter-spacing:-.02em}
.intro{margin:0 0 18px;max-width:65ch}
.witnesses{display:flex;gap:6px;flex-wrap:wrap;margin:0 0 18px}
.witnesses button{flex:1;padding:9px 8px}
button[aria-pressed=true]{background:var(--ink);color:var(--light)}
.byline{margin:0 0 12px;font:700 .94rem/1.4 "Trebuchet MS",sans-serif;color:var(--red)}
blockquote{font-size:1.16rem;line-height:1.6;margin:0;min-height:200px}
.note{font:.86rem/1.5 "Trebuchet MS",sans-serif;color:var(--muted);margin:18px 0 0}
.play{border-top:2px solid var(--ink);margin-top:30px;padding-top:22px;display:grid;grid-template-columns:1fr 1.65fr;gap:35px}
.instructions p{max-width:35ch;margin:0 0 16px}
ol{list-style:none;padding:0;margin:0;counter-reset:events}
.event{display:grid;grid-template-columns:30px minmax(0,1fr) auto;gap:12px;align-items:center;padding:12px 0;border-bottom:1px solid var(--line);counter-increment:events}
.event:before{content:counter(events,decimal-leading-zero);font: .9rem/1.4 "Trebuchet MS",sans-serif;color:var(--red);font-variant-numeric:tabular-nums}
.event strong{font-size:1rem;font-weight:400}
.moves{display:flex;gap:6px}
.moves button{width:46px;padding:10px;display:grid;place-items:center}
svg{width:18px;height:18px;stroke:currentColor;stroke-width:2;fill:none;stroke-linecap:round;stroke-linejoin:round}
.actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:22px}
.primary{background:var(--red);color:var(--light);border-color:var(--red)}
#status{margin:16px 0 0;min-height:3.2em;font: .96rem/1.5 "Trebuchet MS",sans-serif}
#edition{border-top:5px double var(--ink);margin-top:32px;padding-top:25px}
#headline{font-size:clamp(2rem,4.3vw,3.8rem);max-width:22ch;margin:0 0 16px}
#edition p{max-width:68ch}
.angles{display:flex;gap:10px;flex-wrap:wrap}
.final-copy{font-size:1.15rem}
#edition.ready{animation:ink .7s cubic-bezier(.16,1,.3,1)}
@keyframes ink{from{filter:contrast(.7);transform:translateY(8px)}to{filter:contrast(1);transform:translateY(0)}}
footer{border-top:1px solid var(--ink);margin-top:38px;padding-top:16px;font:.85rem/1.6 "Trebuchet MS",sans-serif;color:var(--muted)}
footer p{margin:6px 0;max-width:75ch}
@media(max-width:850px){.lead{grid-template-columns:1fr}.scene{max-height:470px}blockquote{min-height:0}.play{grid-template-columns:1fr;gap:8px}.instructions p{max-width:65ch}.deck{font-size:.8rem}.paper{padding-top:14px}header{margin-top:22px}h1{font-size:clamp(2.5rem,10vw,5rem)}}
@media(max-width:420px){.deck{gap:12px}.deck span:last-child{max-width:15ch}.event{gap:8px;grid-template-columns:22px minmax(0,1fr) auto}.moves{gap:4px}.moves button{width:44px;padding:8px}.event strong{font-size:.94rem}nav{font-size:.78rem}.lead{gap:24px}.paper{padding-inline:16px}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;scroll-behavior:auto!important}}
@media print{body{background:white}.paper{max-width:none;padding:0}nav,.witnesses,.play,.angles,.actions,footer,#edition .note{display:none!important}.lead{display:block}aside{display:none}.scene{max-height:350px;object-fit:contain}header{margin-top:0}#edition{break-inside:avoid}h1{font-size:36pt}#headline{font-size:26pt}.deck{font-size:10pt}}
</style>
</head>
<body>
<main class="paper">
<nav><a href="./">Chloe Reads Jon</a><span>A small mystery for a curious afternoon</span></nav>
<header>
<h1>Street-Level Stories</h1>
<div class="deck"><span>One city block. Three witnesses. Five mixed-up moments.</span><span>The extraordinary, seen from the pavement.</span></div>
</header>
<section class="lead" aria-label="The scene and the witnesses">
<figure><img class="scene" src="assets/street-level-scene.webp" width="1536" height="1024" alt="Painted city street: a teal-cloaked hero lifts a branch beside a blue bus while a child shares an umbrella with a passenger. A bakery and yellow bicycle stand nearby."><figcaption>An artist's reconstruction, with several moments combined. The witnesses, not the painting, tell you what happened first.</figcaption></figure>
<aside>
<h2>Everyone saw a different story.</h2>
<p class="intro">A bus stopped. A branch fell. Someone in a cape arrived. You're the neighbourhood editor: listen to everyone, then put the afternoon in order.</p>
<div class="witnesses" role="group" aria-label="Choose a witness">
<button data-witness="0" aria-pressed="true">The baker</button>
<button data-witness="1" aria-pressed="false">The driver</button>
<button data-witness="2" aria-pressed="false">The passenger</button>
</div>
<div aria-live="polite" aria-atomic="true"><p class="byline" id="byline"></p><blockquote id="account"></blockquote></div>
<p class="note">All characters and events are fictional. Nothing here requires knowing any superhero lore.</p>
</aside>
</section>
<section class="play" id="play" aria-labelledby="order-title">
<div class="instructions">
<h2 id="order-title" tabindex="-1">Make the story add up.</h2>
<p>Move each event earlier or later until all three accounts agree. The top line happens first.</p>
<p>There's no clock. Reporters are allowed to reread their notes.</p>
<div class="actions"><button class="primary" id="check">Check the sequence</button><button id="hint">A little nudge</button></div>
<p id="status" role="status" aria-live="polite">Listen to the witnesses, then arrange the five moments.</p>
</div>
<ol id="timeline" aria-label="Afternoon events in your chosen order"></ol>
</section>
<section id="edition" aria-labelledby="headline" hidden>
<h2 id="headline" tabindex="-1"></h2>
<p class="final-copy" id="final-copy"></p>
<p>The published sequence: <span id="final-sequence"></span></p>
<p class="note">Same afternoon, different angle. Who gets your headline?</p>
<div class="angles" role="group" aria-label="Choose your front-page angle">
<button data-angle="0" aria-pressed="true">The neighbourhood</button>
<button data-angle="1" aria-pressed="false">The cape</button>
<button data-angle="2" aria-pressed="false">The umbrella</button>
</div>
<div class="actions"><button class="primary" id="print">Print your edition</button><button id="restart">Reopen the case</button></div>
</section>
<noscript><p>This mystery needs JavaScript for its move controls. The illustration is still yours to enjoy.</p></noscript>
<footer>
<p>Inspired by Jon's <a href="?source=1">note about finishing <cite>Marvels</cite> by Kurt Busiek and Alex Ross</a>. This is an original little story, not a scene from the book.</p>
<p>A cape can clear a road. Sometimes an umbrella is the thing a person remembers.</p>
</footer>
</main>
<script>
'use strict';
const witnesses=[
{name:'Mara, at the bakery window',text:'"The streetlights blinked out just before the bus stopped. I remember because my till beeped. The bus was already standing at the kerb when that big branch fell into the road. Nobody was underneath it, thank goodness."'},
{name:'Dev, behind the wheel',text:'"The branch came down first. After that, the boy in the yellow coat opened his umbrella for my passenger. Only once he was sheltered did the person in the teal cape lift the branch clear of the road."'},
{name:'Robin, waiting for the next bus',text:'"I was perfectly dry before the cape got to work. That boy had already put his umbrella over me. Everyone is asking about the hero. I would quite like someone to ask the boy his name."'}
];
const events=[
{id:'lights',text:'The streetlights blink out.'},
{id:'bus',text:'The bus stops at the kerb.'},
{id:'branch',text:'A branch falls into the road.'},
{id:'umbrella',text:'The boy shelters the passenger.'},
{id:'hero',text:'The hero clears the branch.'}
];
const initial=['hero','lights','umbrella','branch','bus'];
let order=[...initial];
let solved=false;
const $=id=>document.getElementById(id);
const arrows={earlier:'<svg aria-hidden="true" viewBox="0 0 24 24"><path d="m6 14 6-6 6 6"/></svg>',later:'<svg aria-hidden="true" viewBox="0 0 24 24"><path d="m6 10 6 6 6-6"/></svg>'};
function witness(n){
document.querySelectorAll('[data-witness]').forEach(b=>b.setAttribute('aria-pressed',String(Number(b.dataset.witness)===n)));
$('byline').textContent=witnesses[n].name;
$('account').textContent=witnesses[n].text;
}
function makeRows(){
events.forEach(e=>{
const row=document.createElement('li');row.className='event';row.dataset.event=e.id;
const title=document.createElement('strong');title.textContent=e.text;
const moves=document.createElement('div');moves.className='moves';
['earlier','later'].forEach(direction=>{
const b=document.createElement('button');b.innerHTML=arrows[direction];b.dataset.move=direction;
b.setAttribute('aria-label','Move '+e.text.replace(/\.$/,'').toLowerCase()+' '+direction);
b.addEventListener('click',()=>move(e.id,direction));moves.append(b);
});
row.append(title,moves);$('timeline').append(row);
});
}
function draw(focus){
order.forEach((id,i)=>{
const row=document.querySelector('[data-event="'+id+'"]');$('timeline').append(row);
row.querySelector('[data-move="earlier"]').disabled=i===0;
row.querySelector('[data-move="later"]').disabled=i===order.length-1;
});
if(focus){
const row=document.querySelector('[data-event="'+focus.id+'"]');
let b=row.querySelector('[data-move="'+focus.direction+'"]');
if(b.disabled)b=row.querySelector('button:not(:disabled)');
b.focus();
}
}
function move(id,direction){
const from=order.indexOf(id),to=from+(direction==='earlier'?-1:1);
if(to<0||to>=order.length||solved)return;
[order[from],order[to]]=[order[to],order[from]];
draw({id,direction});
$('status').textContent=events.find(e=>e.id===id).text+' Now in position '+(to+1)+' of 5.';
}
const clues=[
'The baker saw the streetlights blink before the bus stopped.',
'The baker says the bus was already stopped when the branch fell.',
'The driver says the branch fell before the boy opened his umbrella.',
'The driver says the passenger was sheltered before the hero lifted the branch.'
];
function check(){
const bad=events.slice(0,-1).findIndex((e,i)=>order.indexOf(e.id)>order.indexOf(events[i+1].id));
if(bad!==-1){$('status').textContent='Not quite. '+clues[bad]+' Move the events and try again.';return;}
solved=true;$('play').hidden=true;$('edition').hidden=false;$('edition').classList.add('ready');
$('final-sequence').textContent=events.map(e=>e.text.replace(/\.$/,'')).join(' → ')+'.';
angle(0);$('headline').focus();
}
const editions=[
{title:'A block full of small heroes.',text:'The lights went out, the bus stopped, and a fallen branch blocked the road. One neighbour brought an umbrella; another brought impossible strength. The afternoon needed both.'},
{title:'Teal cape clears the way.',text:'After the lights failed and the bus stopped, a branch fell across the road. A visitor in a teal cape lifted it away. Before that spectacular rescue, a boy had already made sure a passenger was dry.'},
{title:'The boy beneath the big story.',text:'Robin remembers the umbrella. It appeared after the branch fell, before the hero cleared the road. While the rest of the block watched someone extraordinary, a boy noticed someone getting wet.'}
];
function angle(n){
$('headline').textContent=editions[n].title;$('final-copy').textContent=editions[n].text;
document.querySelectorAll('[data-angle]').forEach(b=>b.setAttribute('aria-pressed',String(Number(b.dataset.angle)===n)));
}
document.querySelectorAll('[data-witness]').forEach(b=>b.addEventListener('click',()=>witness(Number(b.dataset.witness))));
document.querySelectorAll('[data-angle]').forEach(b=>b.addEventListener('click',()=>angle(Number(b.dataset.angle))));
$('check').addEventListener('click',check);
$('hint').addEventListener('click',()=>{
const i=order.findIndex((id,n)=>id!==events[n].id);
$('status').textContent=i===-1?'That looks ready for the press. Check the sequence to publish your edition.':'Nudge: position '+(i+1)+' should be "'+events[i].text+'" Move it there with its arrow buttons.';
});
$('print').addEventListener('click',()=>window.print());
$('restart').addEventListener('click',()=>{
solved=false;order=[...initial];$('edition').hidden=true;$('edition').classList.remove('ready');$('play').hidden=false;draw();witness(0);
$('status').textContent='Case reopened. Listen again and put the afternoon in order.';$('order-title').focus();
});
makeRows();draw();witness(0);
</script>
</body>
</html>
