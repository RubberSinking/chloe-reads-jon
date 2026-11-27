<?php
if (isset($_GET['source'])) {
    $index = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="([^"]*/2004/11/seinfeld-dictionary.html)"~', $index, $match)) {
        header('Location: ' . html_entity_decode($match[1]), true, 302); exit;
    }
    http_response_code(503); echo 'The source link is unavailable. Please return to the collection.'; exit;
}
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#f7edd9">
<title>Diner of Small Disasters</title>
<style>
@font-face{font-family:Lato;src:url('assets/tomorrows-bouquet-lato.ttf') format('truetype');font-display:swap}
@font-face{font-family:DinerReader;src:url('assets/scripture-reader.ttf') format('truetype');font-display:swap}
:root{--paper:#f7edd9;--ink:#243c39;--red:#a6312c;--teal:#214f49;--muted:#53615a;--line:#c5b9a1;--white:#fffaf0}
*{box-sizing:border-box}
body{margin:0;background:var(--paper);color:var(--ink);font-family:Lato,sans-serif;font-size:17px;line-height:1.5;scrollbar-color:var(--teal) var(--paper)}
::selection{background:var(--teal);color:var(--white)}
a{color:var(--red);text-underline-offset:4px}
a:hover{color:var(--ink)}
button,summary{touch-action:manipulation}
button{font:inherit;cursor:pointer;min-height:48px}
button:focus-visible,a:focus-visible,summary:focus-visible{outline:3px solid var(--teal);outline-offset:4px}
button:disabled{cursor:default}
[hidden]{display:none!important}
nav{max-width:1180px;margin:auto;padding:20px 28px 0}
nav a{font-size:14px}
main{max-width:1180px;padding:18px 28px 40px;margin:auto}
header{display:flex;gap:28px;align-items:end;justify-content:space-between;margin-bottom:28px}
h1{font:500 clamp(2.8rem,6.3vw,5.4rem)/.95 DinerReader,Georgia,serif;letter-spacing:-.025em;margin:0;color:var(--red);max-width:760px;text-wrap:balance}
header p{max-width:29ch;margin:0 0 3px;color:var(--muted);font-size:16px}
.counter{display:grid;grid-template-columns:1fr 1.03fr;gap:34px;align-items:start}
figure{margin:0}
.scene{width:100%;height:350px;object-fit:cover;display:block;border-radius:70px 70px 0 0;background:var(--teal)}
figcaption{font:italic 23px/1.25 DinerReader,Georgia,serif;padding:16px 0 20px;color:var(--teal)}
.scene-note{font-size:14px;color:var(--muted);max-width:52ch;margin:0}
.receipt{background:var(--white);padding:24px 28px 28px;border-top:5px solid var(--red);box-shadow:0 9px 24px #4a3a1d14}
.ticket-top{display:flex;justify-content:space-between;gap:16px;border-bottom:1px solid var(--line);padding-bottom:12px;margin-bottom:18px;font-size:14px;font-variant-numeric:tabular-nums}
#round-label{font-weight:bold}
h2{font:500 31px/1.12 DinerReader,Georgia,serif;margin:0 0 14px;text-wrap:balance}
h2:focus{outline:none}
#scenario{min-height:80px;margin:0 0 20px;font-size:18px;line-height:1.55}
.choices{display:flex;flex-direction:column;gap:10px}
.choice{position:relative;text-align:left;border:1px solid var(--line);border-radius:4px;padding:12px 16px;background:var(--white);color:var(--ink)}
.choice:hover:not(:disabled){background:#eee4cc;border-color:var(--teal)}
.choice:disabled{opacity:1;color:var(--muted)}
.choice.correct{background:var(--teal);color:var(--white);border-color:var(--teal)}
.choice.wrong{background:#f6dfda;color:#8b2925;border-color:var(--red)}
.feedback{margin-top:20px;padding-top:16px;border-top:1px dashed var(--line)}
#verdict{font-weight:bold;margin:0 0 8px}
#explanation{font-size:16px;margin:0 0 18px}
.primary{background:var(--red);color:var(--white);border:0;border-radius:4px;padding:12px 22px}
.primary:hover{background:#802521}
.secondary{background:transparent;border:1px solid var(--teal);border-radius:4px;padding:11px 18px;color:var(--teal)}
.secondary:hover{background:#e5e8d9}
#next{width:100%}
#total{font:500 38px/1.2 DinerReader,Georgia,serif;margin:0 0 14px;color:var(--red)}
#summary-copy{margin-top:0}
#ledger{list-style:none;padding:0;margin:22px 0}
#ledger li{display:flex;justify-content:space-between;gap:12px;border-bottom:1px dotted var(--line);padding:9px 0;font-size:15px}
#ledger li span:last-child{font-weight:bold;white-space:nowrap}
.actions{display:flex;gap:10px;flex-wrap:wrap}
.closeout{font:italic 22px DinerReader,Georgia,serif;text-align:center;margin:24px 0 0}
details{margin-top:36px;border-top:1px solid var(--line);padding-top:18px}
summary{cursor:pointer;min-height:44px;font-weight:bold;color:var(--teal)}
#dictionary{display:grid;grid-template-columns:1fr 1fr;column-gap:34px}
dl{margin:14px 0 0}
dt{font-weight:bold;color:var(--red)}
dd{margin:4px 0 18px;font-size:15px;max-width:66ch}
footer{max-width:1180px;margin:0 auto;padding:0 28px 32px;color:var(--muted);font-size:14px}
footer p{margin:6px 0}
@media(max-width:750px){
nav{padding:16px 20px 0}main{padding:18px 20px 32px}header{display:block;margin-bottom:22px}h1{font-size:clamp(2.8rem,11vw,4.2rem)}header p{max-width:42ch;margin-top:14px;font-size:15px}
.counter{grid-template-columns:1fr;gap:18px}.scene{height:168px;border-radius:48px 48px 0 0;object-position:center 56%}
figcaption{font-size:20px;padding:10px 0 0}.scene-note{display:none}
.receipt{padding:20px}h2{font-size:29px}#scenario{min-height:0;font-size:17px}#dictionary{grid-template-columns:1fr}footer{padding:0 20px 24px}
}
@media(prefers-reduced-motion:no-preference){.feedback{animation:print-in .25s cubic-bezier(.16,1,.3,1)}@keyframes print-in{from{transform:translateY(8px);opacity:.5}to{transform:translateY(0);opacity:1}}}
</style>
</head>
<body>
<nav aria-label="Collection"><a href="./">Back to Chloe Reads Jon</a></nav>
<main>
<header><h1>Diner of<br>Small Disasters</h1><p>Ten social catastrophes.<br>One very particular vocabulary.<br>A Seinfeld game for your coffee break.</p></header>
<div class="counter">
<figure>
<img class="scene" src="assets/small-disasters-diner.webp" alt="A painted New York diner with teal booths, coffee, a slice of babka, and a bowl of pretzels." width="1440" height="810">
<figcaption>Somewhere between coffee and a complaint.</figcaption>
<p class="scene-note">The customers are fictional. The vocabulary is Seinfeld. Choose the expression that fits each small disaster; the counter explains it after you answer.</p>
</figure>
<section class="receipt" aria-label="Play the diner vocabulary game">
<div class="ticket-top"><span id="round-label">Order 1 of 10</span><span id="score">0 served correctly</span></div>
<div id="play">
<h2 id="headline" tabindex="-1">A dip too far</h2>
<p id="scenario"></p>
<div class="choices" id="choices" role="group" aria-label="Choose the Seinfeld expression"></div>
<div id="feedback" class="feedback" hidden>
<div role="status" aria-live="polite"><p id="verdict"></p><p id="explanation"></p></div>
<button id="next" class="primary">Next order</button>
</div>
</div>
<div id="finished" hidden>
<h2 id="finished-title" tabindex="-1">Your shift is over.</h2>
<p id="total"></p><p id="summary-copy"></p>
<ul id="ledger" aria-label="Your ten orders"></ul>
<div class="actions"><button id="save" class="primary">Save your receipt</button><button id="replay" class="secondary">Another shift</button></div>
<p class="closeout">Thank you. Please argue again.</p>
</div>
</section>
</div>
<details id="phrasebook"><summary>Open the diner phrasebook (contains answers)</summary><div id="dictionary"></div></details>
<noscript><p>This game needs JavaScript. Turn it on, then reload to take your first order.</p></noscript>
</main>
<footer><p>Inspired by Jon's <a href="?source=1">Seinfeld dictionary</a>, posted November 27, 2004.</p><p>An unofficial fan game. Original scenarios and illustration; no episode knowledge required to have a go.</p></footer>
<script>
'use strict';
const menu=[
{id:'dip',term:'Double-dipper',title:'A dip too far',scene:'Your friend bites a chip, pauses to explain something, then lowers the bitten end straight back into the communal salsa. The table goes quiet.',meaning:'A double-dipper dips a chip, bites it, then dips it again. In Seinfeld, George gets called out for turning the shared dip into a group dental appointment.',aside:'The salsa has requested its own table.'},
{id:'close',term:'Close-talker',title:'Personal space, please',scene:'Every time your neighbour takes a step toward you, you take a step back. By the end of a simple conversation, you have toured the entire diner.',meaning:'A close-talker stands uncomfortably near while talking. The trouble is distance, not volume.',aside:'You ordered a conversation, not a face inspection.'},
{id:'low',term:'Low-talker',title:'The inaudible agreement',scene:'You nod politely because you cannot hear a word the costume designer is saying. Apparently, you have just agreed to wear something spectacularly embarrassing.',meaning:'A low-talker speaks so quietly that people struggle to hear. Jerry accidentally agrees to wear a puffy shirt this way.',aside:'A nod is a surprisingly binding contract.'},
{id:'gift',term:'Re-gifter',title:'The returning present',scene:'You give a friend a label maker. A week later, another friend proudly shows you the exact same label maker, still in the wrapping you picked.',meaning:'A re-gifter gives away a present they received, presenting it as a gift to someone else. The label maker is the famous Seinfeld example.',aside:'That present has a busier social life than you do.'},
{id:'yada',term:'Yada yada yada',title:'One tiny missing detail',scene:'Your friend describes a weekend: a museum, lunch, a brief misunderstanding, and somehow a courtroom. They seem very keen to skip the middle.',meaning:'Yada yada yada skips over part of a story. The joke is that the omitted details can be much more important than the parts you actually hear.',aside:'We would like to unskip the courtroom, please.'},
{id:'serenity',term:'Serenity now!',title:'Indoor voice, outdoor feelings',scene:'The printer jams, the phone rings, and someone has eaten your sandwich. You shout a two-word demand for inner peace. The sandwich does not return.',meaning:'Serenity now! is Frank Costanza’s shouted attempt to calm himself. In the show, trying to bottle everything up does not end particularly peacefully.',aside:'Peace has been ordered. Delivery is delayed.'},
{id:'festivus',term:'Festivus',title:'A very plain holiday',scene:'Your host has put up an unadorned aluminium pole. Dinner includes a formal opportunity to explain how everyone has disappointed everyone else.',meaning:'Festivus is the Costanza family’s alternative holiday, with an aluminium pole, the airing of grievances, and feats of strength.',aside:'The decorating budget is holding up nicely.'},
{id:'dentist',term:'Anti-dentite',title:'A dental dispute',scene:'A comedian’s jokes about dentists have become a whole thing. The dentist accuses him of prejudice against the entire tooth-care profession.',meaning:'Anti-dentite is the show’s mock-serious word for someone prejudiced against dentists. It turns a petty professional dispute into a grand accusation.',aside:'The molars would prefer that everyone remain civil.'},
{id:'pretzels',term:'These pretzels are making me thirsty',title:'A salty audition',scene:'Your friend lands a tiny part in a movie. Now every visit involves the same snack-related line, performed with twelve different levels of dramatic intensity.',meaning:'These pretzels are making me thirsty is Kramer’s movie line. The friends try different deliveries, turning a very ordinary complaint into an acting exercise.',aside:'A small role. A considerable sodium commitment.'},
{id:'vandelay',term:'Vandelay Industries',title:'The imaginary employer',scene:'Your friend needs you to answer the phone as a company that does not exist. You have somehow become the receptionist for an import-export business.',meaning:'Vandelay Industries is George’s invented company. He asks Jerry to pretend it is real when the unemployment office calls.',aside:'Excellent benefits. No actual business.'}
];
const $=id=>document.getElementById(id);
function shuffle(items){
 const a=[...items];
 for(let i=a.length-1;i>0;i--){let n;const max=Math.floor(4294967296/(i+1))*(i+1);do{n=crypto.getRandomValues(new Uint32Array(1))[0]}while(n>=max);const j=n%(i+1);[a[i],a[j]]=[a[j],a[i]]}
 return a;
}
let orders=[],at=0,correct=0,log=[],answered=false;
function start(focus){
 orders=shuffle(menu);at=0;correct=0;log=[];$('play').hidden=false;$('finished').hidden=true;$('phrasebook').open=false;render(focus);
}
function render(focus){
 answered=false;
 const q=orders[at];
 $('round-label').textContent='Order '+(at+1)+' of '+orders.length;
 $('score').textContent=correct+' served correctly';
 $('headline').textContent=q.title;$('scenario').textContent=q.scene;$('feedback').hidden=true;
 const alternatives=shuffle(menu.filter(x=>x.id!==q.id)).slice(0,2);
 $('choices').replaceChildren();
 shuffle([q,...alternatives]).forEach(item=>{
  const b=document.createElement('button');b.className='choice';b.type='button';b.textContent=item.term;b.dataset.term=item.id;b.addEventListener('click',()=>answer(item.id));$('choices').append(b);
 });
 if(focus)$('headline').focus();
}
function answer(id){
 if(answered)return;answered=true;
 const q=orders[at],ok=id===q.id;
 if(ok)correct++;
 log.push({term:q.term,title:q.title,ok,chosen:menu.find(x=>x.id===id).term});
 $('score').textContent=correct+' served correctly';
 for(const b of $('choices').children){
  if(b.dataset.term===q.id){b.classList.add('correct');b.textContent+=' · correct'}
  else if(b.dataset.term===id){b.classList.add('wrong');b.textContent+=' · your pick'}
  b.disabled=true;
 }
 $('verdict').textContent=ok?'Exactly. '+q.aside:'The counter recommends: '+q.term+'.';
 $('explanation').textContent=q.meaning;
 $('next').textContent=at===orders.length-1?'Close the shift':'Next order';
 $('feedback').hidden=false;$('next').focus();
}
$('next').addEventListener('click',()=>{
 if(!answered)return;
 at++;
 if(at<orders.length){render(true);return}
 $('play').hidden=true;$('finished').hidden=false;$('round-label').textContent='Guest check · complete';
 $('total').textContent=correct+' / '+orders.length+' correct';
 $('summary-copy').textContent=correct===10?'A flawless shift. You may now complain professionally.':correct>=7?'You know your way around this booth. The missed orders are on your receipt.':'The coffee was strong. The vocabulary was stronger. Your receipt doubles as a study guide.';
 $('ledger').replaceChildren();
 log.forEach(x=>{const li=document.createElement('li'),term=document.createElement('span'),result=document.createElement('span');term.textContent=x.term;result.textContent=x.ok?'Correct':'Learned';li.append(term,result);$('ledger').append(li)});
 $('finished-title').focus();
});
$('replay').addEventListener('click',()=>start(true));
$('save').addEventListener('click',()=>{
 const receipt=['DINER OF SMALL DISASTERS','Guest check: '+correct+' / '+orders.length+' correct','',...log.map((x,i)=>(i+1)+'. '+x.title+'\n   '+x.term+' ('+(x.ok?'correct':'you chose '+x.chosen)+')'),'','Thank you. Please argue again.'].join('\n');
 const url=URL.createObjectURL(new Blob([receipt],{type:'text/plain;charset=utf-8'})),a=document.createElement('a');a.href=url;a.download='small-disasters-receipt.txt';a.click();setTimeout(()=>URL.revokeObjectURL(url),1000);
});
menu.forEach(q=>{const dl=document.createElement('dl'),dt=document.createElement('dt'),dd=document.createElement('dd');dt.textContent=q.term;dd.textContent=q.meaning;dl.append(dt,dd);$('dictionary').append(dl)});
start(false);
</script>
</body></html>
