<?php
if (isset($_GET['source'])) {
    $index = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="([^"]*/2004/06/hey-bro.html)"~', $index, $m)) {
        header('Location: ' . html_entity_decode($m[1]), true, 302); exit;
    }
    http_response_code(503); echo 'Source unavailable. Return to the collection and try again.'; exit;
}
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#f5ecd9">
<title>Matchstick Matinee</title>
<style>
@font-face{font-family:Playbill;src:url('assets/scripture-reader.ttf') format('truetype');font-display:swap}
@font-face{font-family:Fredoka;src:url('assets/warm-seat-fredoka.ttf') format('truetype');font-display:swap}
:root{--paper:#f5ecd9;--ink:#233f3d;--red:#9d332b;--gold:#f1c67f;--stage:#132e30;--line:#c3b8a2}
*{box-sizing:border-box}
body{margin:0;background:var(--paper);color:var(--ink);font:17px/1.5 Fredoka,sans-serif;scrollbar-color:var(--red) var(--paper)}
::selection{background:var(--red);color:var(--paper)}
a{color:var(--red);text-underline-offset:4px}
a:hover{color:var(--ink)}
button{font:inherit;cursor:pointer;touch-action:manipulation;min-height:46px}
button:focus-visible,a:focus-visible,summary:focus-visible{outline:3px solid var(--red);outline-offset:5px}
button:disabled{cursor:default;opacity:.5}
header,main,footer{max-width:1080px;margin:auto}
header{padding:22px 24px 0;display:flex;justify-content:space-between;gap:12px;align-items:center;font-size:15px}
header span{font-variant-numeric:tabular-nums}
h1{font-family:Playbill,serif;font-weight:600;letter-spacing:-.035em;font-size:clamp(48px,7.5vw,94px);line-height:1.05;margin:24px 0 10px;text-wrap:balance}
.intro{text-align:center;padding:0 20px}
.intro p{margin:0 auto 22px;max-width:58ch}
.theatre{position:relative;background:var(--stage);aspect-ratio:1.85;isolation:isolate;overflow:hidden}
.theatre>img{position:absolute;width:100%;height:100%;object-fit:cover;z-index:-1}
.equation{position:absolute;inset:25% 11% 23%;display:flex;justify-content:center;align-items:center;gap:clamp(6px,2vw,28px)}
.digit{position:relative;width:18%;max-width:114px;height:100%;max-height:190px;background:#132e30;border:1px solid #a58d64;border-radius:4px;padding:8px;flex-shrink:0}
.digit:hover{border-color:var(--gold);background:#214549}
.digit[aria-pressed=true]{outline:3px solid var(--gold);outline-offset:4px}
.digit:focus-visible{outline-color:var(--paper)}
.glyph{position:relative;width:100%;height:100%;display:block}
.match{position:absolute;background:var(--gold);border-radius:3px}
.match::after{content:"";position:absolute;background:#bc5340;border-radius:3px;width:22%;height:100%;right:0}
.match.v::after{width:100%;height:22%;top:0}
.match.off{background:#385657}
.match.off::after{display:none}
.match.h{height:7%;width:64%;left:18%}
.match.v{width:11%;height:36%}
.match.a{top:1%}.match.g{top:46.5%}.match.d{bottom:1%}
.match.f{left:2%;top:8%}.match.b{right:2%;top:8%}
.match.e{left:2%;bottom:8%}.match.c{right:2%;bottom:8%}
.operator{font:clamp(24px,5vw,64px)/1 Playbill,serif;color:var(--gold);flex-shrink:0}
.caption{position:absolute;bottom:4%;left:10%;right:10%;text-align:center;color:#fff0ce;font-size:14px}
.bench{display:grid;grid-template-columns:1fr 1fr;gap:40px;padding:30px 36px 34px;border-bottom:1px solid var(--line)}
h2{font:600 30px/1.2 Playbill,serif;margin:0 0 10px;text-wrap:balance}
#status{min-height:52px;margin:0 0 18px;max-width:48ch}
.controls{display:flex;flex-wrap:wrap;gap:10px;margin:16px 0}
.cue{border:1px solid var(--ink);background:transparent;color:var(--ink);padding:9px 18px;border-radius:4px}
.cue:hover:not(:disabled){background:#e7dbc2}
.primary{background:var(--red);border-color:var(--red);color:#fff7e7}
.primary:hover:not(:disabled){background:#79261f}
#hintText{font-size:15px;max-width:48ch;min-height:48px}
.editor-wrap{display:flex;align-items:center;justify-content:center;gap:20px}
#editor{position:relative;width:176px;height:244px;flex-shrink:0}
.segment{position:absolute;background:transparent;border:0;padding:0;min-height:44px}
.segment.h{width:74px;height:44px;left:51px}
.segment.v{width:44px;height:76px}
.segment.a{top:0}.segment.g{top:100px}.segment.d{top:200px}
.segment.f{left:0;top:31px}.segment.b{right:0;top:31px}
.segment.e{left:0;top:137px}.segment.c{right:0;top:137px}
.segment::before{content:"";position:absolute;background:#b79455;border-radius:4px;inset:16px 3px}
.segment.v::before{inset:3px 15px}
.segment::after{content:"";position:absolute;background:var(--red);width:14px;height:12px;top:16px;right:3px;border-radius:4px}
.segment.v::after{top:3px;left:15px;width:14px}
.segment[data-on=false]::before{background:transparent;border:2px dashed #8b8068}
.segment[data-on=false]::after{display:none}
.segment:hover:not(:disabled){background:#ded2b9;border-radius:4px}
.segment:disabled{opacity:1}
.editor-note{font-size:14px;max-width:12ch}
.small{font-size:14px}
details{padding:26px 36px}
summary{cursor:pointer;min-height:44px;font-weight:700}
details p{max-width:68ch;margin:12px 0}
footer{border-top:1px solid var(--line);padding:24px 36px 40px;font-size:15px}
footer p{max-width:65ch}
[hidden]{display:none!important}
.theatre.bow{animation:bow .8s ease-out}
@keyframes bow{0%{filter:brightness(1)}45%{filter:brightness(1.35)}100%{filter:brightness(1)}}
@media(max-width:600px){
 header{padding:16px 16px 0;font-size:13px}
 h1{margin-top:24px}
 .intro p{font-size:16px}
 .theatre{aspect-ratio:1.35}
 .equation{inset:25% 7% 26%;gap:12px}
 .digit{width:19%;padding:6px}
 .caption{font-size:12px;bottom:5%}
 .bench{grid-template-columns:1fr;gap:12px;padding:24px 20px}
 .editor-wrap{grid-row:2;justify-content:center;margin:10px 0}
 #status{min-height:0}
 #hintText{min-height:0}
 details,footer{padding:22px 20px}
}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;transition:none!important}}
</style>
</head>
<body>
<header><a href="./">Chloe Reads Jon</a><span id="progress">Act 1 of 6</span></header>
<main>
<section class="intro"><h1>Matchstick Matinee</h1><p>One match is in the wrong place. Move it to make the equation true. No timer. The audience can wait.</p></section>
<section class="theatre" aria-label="Arithmetic stage">
<img src="assets/matchstick-matinee.webp" alt="An original painted paper theatre with red curtains, a puzzle book and unlit matches on a wooden table." width="1536" height="1024" fetchpriority="high">
<div class="equation" id="equation" role="group" aria-label="Choose a digit to edit">
<button class="digit" id="digit0" aria-pressed="true"><span class="glyph" aria-hidden="true"></span></button>
<span class="operator" id="op" aria-hidden="true">+</span>
<button class="digit" id="digit1" aria-pressed="false"><span class="glyph" aria-hidden="true"></span></button>
<span class="operator" aria-hidden="true">=</span>
<button class="digit" id="digit2" aria-pressed="false"><span class="glyph" aria-hidden="true"></span></button>
</div><div class="caption">Only the digits move. The signs stay put.</div>
</section>
<section class="bench" aria-label="Match editing bench">
<div>
<h2 id="actTitle" tabindex="-1">The opening trick</h2>
<p id="status" role="status" aria-live="polite"></p>
<div class="controls"><button class="cue" id="undo">Undo move</button><button class="cue" id="hint">Give me a hint</button><button class="cue primary" id="next" hidden>Next act</button></div>
<p id="hintText" aria-live="polite"></p>
<p class="small" id="selection">Editing the left digit. Choose another on the stage.</p>
</div>
<div class="editor-wrap" id="editing"><div id="editor" role="group" aria-label="Large digit editor"></div><p class="editor-note">Solid wood: a match.<br><br>Dashed slot: an empty space.</p></div>
<div id="finale" hidden><h2>Six acts. One fine brain.</h2><p>You gave every equation its happy ending. Fancy an encore with Nathan?</p><button class="cue primary" id="replay">Play again</button></div>
</section>
<details><summary>The house rules</summary><p>Choose a digit on the stage. In the large editor, tap a wooden match to lift it, then tap a dashed slot to place it. You can rotate the match or move it to another digit. The equation must use ordinary seven-segment digits from 0 to 9.</p><p>Exactly one match moves per act. Plus, minus and equals signs are fixed. Undo lets you try again as often as you like. Every puzzle has one solution under these rules.</p><p>Keyboard: Tab to a digit, press Enter, then Tab through the large editor's available matches or slots. All actions have text labels. These are original puzzles inspired by Jon's love of brainteasers, not puzzles reproduced from the book.</p></details>
</main>
<footer><p>In 2004, Jon wrote that he was finally putting <em>1000 Playthinks</em> to work to keep his mind sharp. Twenty-two years later, a few wooden matches have volunteered.</p><p>Inspired by Jon's <a href="?source=1">“Hey Bro”</a>. Original theatre artwork generated with GPT Image.</p><a href="./">Back to the collection</a></footer>
<noscript><p>This little theatre needs JavaScript for the match-moving game.</p></noscript>
<script>
'use strict';
const masks=['abcdef','bc','abdeg','abcdg','bcfg','acdfg','acdefg','abc','abcdefg','abcdfg'];
const names={a:'top',b:'upper right',c:'lower right',d:'bottom',e:'lower left',f:'upper left',g:'middle'};
const positions=['left','middle','right'];
const acts=[
{n:[1,1,3],op:'+',title:'The opening trick',s:[2,'c',2,'e']},
{n:[2,9,8],op:'+',title:'A change of character',s:[1,'b',1,'e']},
{n:[3,9,6],op:'+',title:'Across the stage',s:[1,'b',2,'b']},
{n:[6,4,4],op:'+',title:'Much ado about zero',s:[0,'g',0,'b']},
{n:[6,5,9],op:'−',title:'The borrowed match',s:[2,'f',0,'b']},
{n:[3,8,9],op:'−',title:'The grand rearrangement',s:[1,'g',0,'f']}
];
const $=id=>document.getElementById(id);
let act=0,selected=0,board=[],lifted=null,placed=false,solved=false,hintLevel=0,done=false;
const digitOf=set=>masks.findIndex(m=>m.length===set.size && [...set].every(x=>m.includes(x)));
function equationText(){return board.map((s,i)=>(i===1?' '+acts[act].op+' ':i===2?' = ':'')+(digitOf(s)<0?'an unfinished digit':digitOf(s))).join('');}
function render(focus){
 const previous=document.activeElement?.id;
 for(let i=0;i<3;i++){
  const b=$('digit'+i);
  b.setAttribute('aria-label',positions[i]+' digit: '+(digitOf(board[i])<0?'unfinished':digitOf(board[i]))+'. Select to edit.');
  b.setAttribute('aria-pressed',String(selected===i));b.disabled=solved||placed;
  b.querySelector('.glyph').innerHTML=[...'abcdefg'].map(s=>'<span class="match '+s+' '+('agd'.includes(s)?'h':'v')+(board[i].has(s)?'':' off')+'"></span>').join('');
 }
 $('op').textContent=acts[act].op;
 $('equation').setAttribute('aria-label',equationText()+'. Choose a digit to edit.');
 for(const s of 'abcdefg'){
  const b=$('seg'+s),on=board[selected].has(s);
  b.dataset.on=String(on);
  b.setAttribute('aria-label',(lifted?'Place match in ':'Lift match from ')+names[s]+' slot of '+positions[selected]+' digit');
  b.disabled=solved||placed||(lifted?on:!on);
 }
 $('selection').textContent='Editing the '+positions[selected]+' digit. Choose another on the stage.';
 $('undo').disabled=!lifted||done;
 $('hint').disabled=solved||hintLevel>=2||done;
 $('next').hidden=!solved||done;
 $('editing').hidden=done;$('finale').hidden=!done;$('selection').hidden=done;
 if(!done){
  if(solved)$('status').textContent=equationText()+'. Correct! Take a bow.';
  else if(placed)$('status').textContent=equationText()+'. Not quite true. Undo the move and try another slot.';
  else if(lifted)$('status').textContent='One match in hand. Choose an empty dashed slot here, or select another digit.';
  else $('status').textContent='Choose a digit on the stage, then lift one of its matches in the large editor.';
 }
 if(focus && $(focus) && !$(focus).disabled && !$(focus).hidden)$(focus).focus();
 else if(previous && $(previous)?.disabled && !done){
  const target=solved?$('next'):placed?$('undo'):$('editor').querySelector('button:not(:disabled)');
  target?.focus();
 }
}
function reset(){
 board=acts[act].n.map(n=>new Set(masks[n]));selected=0;lifted=null;placed=false;solved=false;hintLevel=0;done=false;
 $('actTitle').textContent=acts[act].title;$('progress').textContent='Act '+(act+1)+' of 6';$('hintText').textContent='';render();
}
for(const s of 'abcdefg'){
 const b=document.createElement('button');b.className='segment '+s+' '+('agd'.includes(s)?'h':'v');b.id='seg'+s;
 b.onclick=()=>{
  if(solved||placed)return;
  if(!lifted){board[selected].delete(s);lifted=[selected,s];}
  else{
   if(selected===lifted[0]&&s===lifted[1]){board[selected].add(s);lifted=null;render('seg'+s);return;}
   board[selected].add(s);placed=true;
   const n=board.map(digitOf);
   solved=n.every(x=>x>=0)&&(acts[act].op==='+'?n[0]+n[1]:n[0]-n[1])===n[2];
   if(solved){const t=document.querySelector('.theatre');t.classList.remove('bow');void t.offsetWidth;t.classList.add('bow');}
  }
  render();
 };$('editor').append(b);
}
for(let i=0;i<3;i++)$('digit'+i).onclick=()=>{selected=i;render();};
$('undo').onclick=()=>{board=acts[act].n.map(n=>new Set(masks[n]));lifted=null;placed=false;solved=false;render('digit'+selected);};
$('hint').onclick=()=>{
 hintLevel++;
 const [i,s,j,t]=acts[act].s;
 $('hintText').textContent=hintLevel===1?'Look at the '+positions[i]+' digit. Which match can it spare?':'Lift the '+names[s]+' match from the '+positions[i]+' digit; place it in the '+names[t]+' slot of the '+positions[j]+' digit.';
 render();
};
$('next').onclick=()=>{
 if(act<acts.length-1){act++;reset();$('actTitle').focus();}
 else{done=true;$('progress').textContent='All six acts complete';$('actTitle').textContent='Curtain call';$('status').textContent='Every one-match mystery solved.';render();$('replay').focus();}
};
$('replay').onclick=()=>{act=0;reset();$('actTitle').focus();};
reset();
</script></body></html>
