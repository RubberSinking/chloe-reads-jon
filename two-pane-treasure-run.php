<?php
declare(strict_types=1);
if (isset($_GET['source'])) {
    $gallery = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="(https?://[^"]+/2007/03/alternative-windows-file-explorer\.html)"~', $gallery, $match)) {
        header('Location: ' . html_entity_decode($match[1], ENT_QUOTES), true, 302);
        exit;
    }
    http_response_code(503);
    exit('The source link is unavailable. Please return to the gallery.');
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#dceef6">
<meta name="description" content="An expedition through a fictional two-pane file browser. Follow visual clues, inspect discoveries, and pack three perfect dispatches.">
<title>Two-Pane Treasure Run</title>
<style>
@font-face{font-family:Lighttable;src:url("assets/two-pane-display.otf") format("opentype");font-weight:700;font-display:swap}
:root{--ground:#dceef6;--ink:#143a50;--muted:#335a70;--blue:#194dcc;--blue-dark:#133b9e;--white:#f9fcff;--line:#92b3c6;--selected:#c6e4f4;--lime:#e4f6a8;--night:#103849}
*{box-sizing:border-box}
html{scrollbar-color:var(--blue) var(--ground)}
body{margin:0;color:var(--ink);background:var(--ground);font:1rem/1.5 "Trebuchet MS",sans-serif}
::selection{background:var(--blue);color:var(--white)}
a{color:inherit;text-underline-offset:4px}
button{font:inherit;cursor:pointer;touch-action:manipulation}
button:disabled{cursor:default;opacity:.48}
:focus-visible{outline:3px solid var(--blue);outline-offset:3px}
button:focus-visible{position:relative;z-index:2}
.wrap{max-width:1230px;margin:auto;padding:20px clamp(14px,4vw,48px) 40px}
nav{display:flex;gap:15px;justify-content:space-between;align-items:center;font-size:.88rem}
nav span{color:var(--muted)}
h1,h2,h3{font-family:Lighttable,sans-serif;line-height:1.12;text-wrap:balance}
h1{font-size:clamp(2rem,5.7vw,4.7rem);letter-spacing:-.035em;margin:30px 0 10px;max-width:20ch}
.intro{max-width:68ch;margin:0 0 25px;font-size:1.03rem}
.lighttable{background:var(--white);border-radius:14px;overflow:hidden}
.upper{display:grid;grid-template-columns:minmax(250px,.9fr) minmax(300px,1fr)}
.viewer{margin:0;background:var(--night);color:var(--white);display:flex;flex-direction:column}
.photo{position:relative;aspect-ratio:1;overflow:hidden;background:#b9d5e0}
.photo img{display:block;width:100%;height:100%;object-fit:contain}
.photo.zoom{aspect-ratio:1}
.photo.zoom img{position:absolute;width:300%;height:200%;max-width:none;object-fit:fill}
.photo.zoom[data-cell="0"] img{left:0;top:0}
.photo.zoom[data-cell="1"] img{left:-100%;top:0}
.photo.zoom[data-cell="2"] img{left:-200%;top:0}
.photo.zoom[data-cell="3"] img{left:0;top:-100%}
.photo.zoom[data-cell="4"] img{left:-100%;top:-100%}
.photo.zoom[data-cell="5"] img{left:-200%;top:-100%}
.photo.text-preview{display:flex;align-items:center;padding:25px;background:var(--selected);color:var(--ink)}
.photo.text-preview img{display:none}
#documentText{margin:0;white-space:pre-wrap;max-width:40ch;font-family:Georgia,serif;font-size:1.15rem}
#previewCaption{padding:13px 18px;font-size:.86rem;margin:0;min-height:68px}
#previewCaption strong{display:block;font-size:.96rem;color:var(--white)}
.commission{background:var(--blue);color:var(--white);padding:24px clamp(20px,3vw,34px);display:flex;flex-direction:column;justify-content:center}
.steps{display:flex;gap:7px;list-style:none;margin:0 0 18px;padding:0}
.steps li{padding:4px 10px;border:1px solid #8aabff;border-radius:4px;font-size:.8rem;font-variant-numeric:tabular-nums}
.steps [aria-current="step"]{background:var(--lime);color:var(--ink);border-color:var(--lime)}
.commission h2{font-size:clamp(1.7rem,3vw,2.5rem);margin:0 0 14px}
.commission p{margin:0 0 12px;max-width:48ch}
.commission .aside{font-size:.87rem;color:#e1eaff}
#clue{min-height:4.5em}
.commission :focus-visible{outline-color:var(--lime)}
.panes{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:22px;padding:22px}
.pane{min-width:0;border:1px solid var(--line);border-radius:8px;overflow:hidden;background:var(--white)}
.pane-head{padding:12px 14px;background:#e8f3f9;border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;gap:6px}
.pane h3{font-size:1.18rem;margin:0}
.pane-head small{font-size:.8rem;font-variant-numeric:tabular-nums;white-space:nowrap}
.path{font-family:monospace;font-size:.85rem;overflow-wrap:anywhere;padding:10px 12px;margin:0;background:#edf6fb;border-bottom:1px solid var(--line);min-height:44px}
.file-list{list-style:none;margin:0;padding:0;min-height:231px}
.row{width:100%;min-height:54px;display:flex;gap:10px;align-items:center;text-align:left;background:transparent;color:var(--ink);border:0;border-bottom:1px solid #d7e6ef;padding:10px 12px}
.row svg{flex-shrink:0;width:20px;height:20px}
.row .name{display:block;overflow-wrap:anywhere;font-family:monospace;font-size:.94rem}
.row .meta{display:block;font-size:.76rem;color:var(--muted);font-variant-numeric:tabular-nums}
.row:hover:not(:disabled){background:#e1eff7}
.row[aria-pressed="true"]{background:var(--selected);box-shadow:inset 0 -2px var(--blue)}
.row[aria-pressed="true"] .name{font-weight:700}
.up{background:#f1f8fc}
.packed{padding:12px;border-bottom:1px solid #d7e6ef}
.packed strong{font-family:monospace;font-size:.9rem;overflow-wrap:anywhere}
.packed p{font-size:.78rem;margin:3px 0 4px;overflow-wrap:anywhere;color:var(--muted)}
.packed button{border:0;background:transparent;color:var(--blue-dark);text-decoration:underline;text-underline-offset:3px;padding:8px 0;min-height:44px;font-size:.85rem}
.empty{font-size:.9rem;color:var(--muted);padding:18px 13px;max-width:30ch}
.pane-bottom{padding:12px;border-top:1px solid var(--line);background:#edf6fb}
.primary,.secondary{border:0;border-radius:5px;min-height:46px;padding:11px 15px;font-weight:700}
.primary{background:var(--blue);color:var(--white)}
.primary:hover:not(:disabled){background:var(--blue-dark)}
.secondary{background:var(--selected);color:var(--ink)}
.secondary:hover:not(:disabled){background:#b4d6eb}
.pane-bottom button{width:100%}
.dispatch{background:var(--lime);padding:16px 22px;display:grid;grid-template-columns:1fr auto;gap:15px;align-items:center}
#status{font-size:.93rem;margin:0;max-width:67ch}
#status[data-tone="error"]{color:#7b2429}
.tools{display:flex;flex-wrap:wrap;gap:20px;padding:12px 22px 14px}
.tools button{border:0;background:transparent;color:var(--blue-dark);min-height:44px;padding:5px 0;font-size:.87rem;text-decoration:underline;text-underline-offset:4px}
#hintText{margin:0;padding:0 22px 20px;font-size:.9rem;color:var(--muted)}
#success{background:var(--lime);padding:30px clamp(20px,5vw,50px)}
#success h2{font-size:2.2rem;margin:0 0 14px}
#success p{max-width:62ch}
.delivered{display:flex;gap:14px;margin:22px 0}
.thumb{width:clamp(100px,24vw,180px);aspect-ratio:1;background-image:url("assets/two-pane-contact.webp");background-size:300% 200%;border-radius:5px}
.arriving{animation:file-arrives .42s cubic-bezier(.16,1,.3,1)}
@keyframes file-arrives{from{transform:translateX(-18px);filter:brightness(1.5)}to{transform:translateX(0);filter:brightness(1)}}
footer{margin-top:30px;font-size:.85rem;color:var(--muted)}
footer p{max-width:75ch;margin:0 0 10px}
details{margin:20px 0;color:var(--muted);font-size:.9rem}
summary{cursor:pointer;min-height:44px;padding:10px 0}
details p{max-width:70ch;margin:4px 0 12px}
[hidden]{display:none!important}
@media(max-width:700px){
.wrap{padding-top:14px}nav{font-size:.8rem}nav span{max-width:16ch;text-align:right}
h1{margin-top:24px;max-width:15ch;font-size:clamp(2.15rem,9vw,3.7rem)}
.intro{font-size:.95rem;margin-bottom:20px}
.upper{grid-template-columns:1fr}.viewer{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,.85fr);align-items:center}
.photo,.photo.zoom{aspect-ratio:1}.photo:not(.zoom):not(.text-preview) img{object-fit:contain}
#previewCaption{padding:12px;font-size:.76rem;min-height:0;overflow-wrap:anywhere}
#previewCaption strong{font-size:.85rem}
#documentText{font-size:.87rem}.photo.text-preview{padding:12px}
.commission{padding:20px}.steps{margin-bottom:14px}.commission h2{font-size:1.7rem}.commission p{font-size:.95rem}
#clue{min-height:0}.commission .aside{font-size:.8rem}
.panes{gap:8px;padding:12px 8px}.pane-head{padding:10px 8px;flex-wrap:wrap}.pane h3{font-size:1rem}
.pane-head small{font-size:.73rem}.path{font-size:.72rem;padding:8px;min-height:49px}
.row{gap:6px;padding:9px 7px;min-height:62px}.row svg{width:15px;height:15px}.row .name{font-size:.77rem}.row .meta{font-size:.68rem}
.file-list{min-height:245px}.packed{padding:9px 7px}.packed strong{font-size:.77rem}.packed p{font-size:.7rem}
.empty{padding:12px 9px;font-size:.8rem}.pane-bottom{padding:8px}.pane-bottom button{font-size:.84rem;padding:10px 6px}
.dispatch{padding:16px;grid-template-columns:1fr}.dispatch button{width:100%}
.tools{padding:8px 16px;gap:16px}#hintText{padding:0 16px 16px}
#success h2{font-size:1.85rem}
}
@media(prefers-reduced-motion:reduce){.arriving{animation:none}}
</style>
</head>
<body>
<main class="wrap">
<nav aria-label="Page navigation"><a href="./">Chloe Reads Jon</a><span>No file left unexamined.</span></nav>
<header><h1>Two-Pane<br>Treasure Run</h1><p class="intro">A curious archive. Two open folders. Three very particular deliveries.<br>Follow the clues, peek inside files, and copy the right pair across.</p></header>
<div class="lighttable">
<div id="play">
<div class="upper">
<figure class="viewer" aria-label="File preview">
<div class="photo" id="photo"><img id="previewImage" src="assets/two-pane-contact.webp" width="1536" height="1024" alt="Six miniature discoveries: a lighthouse bicycle, woodland robot, snowy roadster, lake balloon, observatory cat and icy sailboat." fetchpriority="high"><pre id="documentText" hidden></pre></div>
<figcaption id="previewCaption"><strong>The expedition contact sheet</strong>Select a file below to inspect its picture, date, and size.</figcaption>
</figure>
<section class="commission" aria-labelledby="missionTitle">
<ol class="steps" aria-label="Dispatch progress"><li aria-current="step">1</li><li>2</li><li>3</li></ol>
<h2 id="missionTitle" tabindex="-1"></h2>
<p id="clue"></p>
<p class="aside">Open folders on the left. Select a file to preview it, then copy it to the right. Your dispatch has room for exactly two files.</p>
</section>
</div>
<div class="panes">
<section class="pane" aria-labelledby="archiveTitle">
<div class="pane-head"><h3 id="archiveTitle">The archive</h3><small>Source</small></div>
<p class="path" id="path">/Archive/</p>
<ul id="sourceList" class="file-list" aria-label="Archive folders and files"></ul>
<div class="pane-bottom"><button class="primary" id="copy" disabled>Copy to dispatch</button></div>
</section>
<section class="pane" aria-labelledby="dispatchTitle">
<div class="pane-head"><h3 id="dispatchTitle">Your dispatch</h3><small id="capacity">0 / 2 files</small></div>
<p class="path" id="destination"></p>
<div id="packedList" class="file-list" aria-label="Copied files"><p class="empty">Nothing packed yet. Your first discovery goes here.</p></div>
<div class="pane-bottom"><button class="secondary" id="clear">Empty dispatch</button></div>
</section>
</div>
<div class="dispatch"><p id="status" role="status" aria-live="polite">Start by opening a folder in the archive.</p><button class="primary" id="check">Check this dispatch</button></div>
<div class="tools"><button id="hint" aria-expanded="false" aria-controls="hintText">Need a nudge?</button><button id="overview">Show contact sheet</button><button id="restart">Restart this dispatch</button></div>
<p id="hintText" hidden></p>
</div>
<section id="success" hidden aria-labelledby="successTitle"><h2 id="successTitle" tabindex="-1"></h2><p id="successText"></p><div class="delivered" id="delivered"></div><button class="primary" id="next">Next dispatch</button></section>
</div>
<details><summary>A tiny field guide to the two-pane idea</summary><p>One pane keeps the source open while the other keeps the destination open. You can inspect and copy without repeatedly switching windows. This toy uses fictional files, and copies leave the originals in place. A real file browser also handles moves, renaming, permissions, and much larger collections.</p><p>Tap or click a folder once to open it. Tap a file once to preview it. Keyboard: Tab between controls, Enter or Space to activate. No timer, no penalty, no actual files touched.</p></details>
<footer>
<p>Inspired by Jon's <a href="?source=1">An alternative Windows file explorer: 2xExplorer</a>, March 2007. Two panes and a preview sounded like an excellent excuse to misplace a very small expedition.</p>
<p>A fictional archive with original miniature-diorama imagery made for this game. The dates and file sizes are puzzle data.</p>
</footer>
<noscript><p>JavaScript is needed for the treasure hunt. The source post and field guide are still readable.</p></noscript>
</main>
<script>
'use strict';
const $=id=>document.getElementById(id);
const scenes=[
'Red bicycle beside a white seaside lighthouse.',
'A friendly green robot shelters beneath a giant woodland mushroom.',
'A yellow vintage roadster parked in snowy mountains.',
'A purple hot-air balloon floats above a mountain lake.',
'An orange cat sits beside a telescope in an observatory.',
'A blue sailboat travels between icebergs.'
];
const files=[
{id:'bike',dir:'Coast',name:'IMG_014.jpg',cell:0,date:'2026-10-03',size:'2.4 MB'},
{id:'boat',dir:'Coast',name:'IMG_088.jpg',cell:5,date:'2026-10-08',size:'3.1 MB'},
{id:'tides',dir:'Coast',name:'tides.txt',text:'Low tide: 09:10.\nThe lighthouse keeper has borrowed a bicycle.\nPlease return it before tea.',date:'2026-10-08',size:'1 KB'},
{id:'car',dir:'Hills',name:'IMG_031.jpg',cell:2,date:'2026-10-05',size:'2.8 MB'},
{id:'map',dir:'Hills',name:'route.gpx',text:'A fictional hill trail.\nElevation: 840 m.\nNot a navigation file.\nBring a warm scarf.',date:'2026-10-05',size:'12 KB'},
{id:'robot',dir:'Woods',name:'IMG_052.jpg',cell:1,date:'2026-10-06',size:'2.2 MB'},
{id:'moss',dir:'Woods',name:'field-notes.txt',text:'The robot is very polite.\nThe mushroom declined to comment.',date:'2026-10-06',size:'1 KB'},
{id:'balloon',dir:'Sky',name:'IMG_073.jpg',cell:3,date:'2026-10-07',size:'3.4 MB'},
{id:'cat',dir:'Sky',name:'IMG_096.jpg',cell:4,date:'2026-10-09',size:'2.6 MB'},
{id:'oldcover',dir:'Editions/Drafts',name:'cover.jpg',cell:4,date:'2026-10-12',size:'1.8 MB'},
{id:'oldroute',dir:'Editions/Drafts',name:'route.txt',text:'OLD ROUTE\nUse the southern dock.\nThis plan was replaced in November.',date:'2026-10-12',size:'1 KB'},
{id:'newcover',dir:'Editions/Finals',name:'cover.jpg',cell:1,date:'2026-11-04',size:'4.2 MB'},
{id:'newroute',dir:'Editions/Finals',name:'route.txt',text:'REVISED ROUTE\nLaunch from the north dock.\nTea stop at the lighthouse.\nReturn before the cat takes over.',date:'2026-11-05',size:'2 KB'}
];
const folders=['Coast','Hills','Woods','Sky','Editions','Editions/Drafts','Editions/Finals'];
const missions=[
{title:'Bring the wheels.',destination:'Wheel-Club',clue:'The travel editor wants two pictures: a red two-wheeler beside a beacon, and a yellow four-wheeler somewhere it really ought to have snow tires.',ids:['bike','car'],hint:'Look in Coast for the bicycle, then Hills for the roadster. Preview the JPG files; their names do not tell the whole story.',done:'A bicycle by the lighthouse and a roadster in the snow. The editor is delighted. The roadster is still cold.'},
{title:'A floaty little pair.',destination:'Float-Club',clue:'Find a purple passenger drifting over a lake, and a blue traveller threading through ice. Both float. Neither needs a road.',ids:['balloon','boat'],hint:'The purple balloon lives in Sky. The blue sailboat is filed in Coast. Pack the pictures, not the notes.',done:'Air and water, neatly filed together. The balloon has requested a window seat. We are choosing not to discuss that.'},
{title:'Same name. Newer story.',destination:'Print-Desk',clue:'The printer needs the newest cover.jpg AND the newest route.txt. Open Editions and compare the modified dates in its two folders. A familiar filename can still be the wrong file.',ids:['newcover','newroute'],hint:'Compare Drafts with Finals inside Editions. Both files from November are newer than the October versions. Copy one cover and one route.',done:'The November cover and revised route are together. No old instructions slipped through. That is three perfect dispatches.'}
];
let stage=0,dir='',selected=null,packed=[];
const getFile=id=>files.find(f=>f.id===id);
const folderIcon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M3 6h7l2 3h9v11H3z"/><path d="M3 6V4h7l2 2h7v3"/></svg>';
const fileIcon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M6 3h8l4 4v14H6z"/><path d="M14 3v5h4M9 12h6M9 16h6"/></svg>';
const upIcon='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M5 12l7-7 7 7M12 5v15"/></svg>';
function announce(message,error=false){$('status').textContent=message;$('status').dataset.tone=error?'error':'normal';}
function sourceButton(id){return [...$('sourceList').querySelectorAll('[data-file]')].find(b=>b.dataset.file===id);}
function updateCopy(){
const hadFocus=document.activeElement===$('copy');
$('copy').disabled=!selected||packed.includes(selected)||packed.length===2;
$('copy').textContent=selected&&packed.includes(selected)?'Already copied':packed.length===2?'Dispatch is full':'Copy to dispatch';
if(hadFocus&&$('copy').disabled){const b=sourceButton(selected);if(b)b.focus();else $('check').focus();}
}
function overview(){
$('photo').className='photo';$('photo').removeAttribute('data-cell');$('documentText').hidden=true;
$('previewImage').alt='Six miniature discoveries: a lighthouse bicycle, woodland robot, snowy roadster, lake balloon, observatory cat and icy sailboat.';
$('previewCaption').replaceChildren();
const title=document.createElement('strong');title.textContent='The expedition contact sheet';
$('previewCaption').append(title,'Select a file below to inspect its picture, date, and size.');
}
function choose(id){
selected=id;const f=getFile(id);
$('sourceList').querySelectorAll('[data-file]').forEach(b=>b.setAttribute('aria-pressed',String(b.dataset.file===id)));
$('photo').className=f.cell===undefined?'photo text-preview':'photo zoom';
$('documentText').hidden=f.cell!==undefined;
if(f.cell!==undefined){$('photo').dataset.cell=f.cell;$('previewImage').alt=scenes[f.cell];}
else{$('photo').removeAttribute('data-cell');$('documentText').textContent=f.text;$('previewImage').alt='';}
$('previewCaption').replaceChildren();
const strong=document.createElement('strong');strong.textContent=f.name;
const description=document.createElement('span');description.textContent=f.cell===undefined?'Text document. ':scenes[f.cell]+' ';
$('previewCaption').append(strong,description,'Modified '+f.date+' · '+f.size);
updateCopy();announce('Selected '+f.name+'. '+(packed.includes(id)?'A copy is already in your dispatch.':'Inspect the preview, then copy it across.'));
}
function openFolder(path,focus=true){
dir=path;selected=null;$('path').textContent='/Archive/'+(dir?dir+'/':'');
const list=$('sourceList');list.replaceChildren();
const addButton=(html,attrs,action)=>{
const li=document.createElement('li'),b=document.createElement('button');b.className='row';b.innerHTML=html;
Object.entries(attrs).forEach(([k,v])=>b.setAttribute(k,v));b.addEventListener('click',action);li.append(b);list.append(li);return b;
};
if(dir)addButton(upIcon+'<span class="name">Up one folder</span>',{'class':'row up','data-up':'1'},()=>openFolder(dir.includes('/')?dir.slice(0,dir.lastIndexOf('/')):''));
folders.filter(p=>(p.includes('/')?p.slice(0,p.lastIndexOf('/')):'')===dir).forEach(p=>{
const name=p.split('/').pop();
addButton(folderIcon+'<span><span class="name">'+name+'</span><span class="meta">Open folder</span></span>',{'data-folder':p,'aria-label':'Open '+name+' folder'},()=>openFolder(p));
});
files.filter(f=>f.dir===dir).forEach(f=>{
addButton(fileIcon+'<span><span class="name">'+f.name+'</span><span class="meta">'+f.date+' · '+f.size+'</span></span>',{'data-file':f.id,'aria-pressed':'false','aria-label':f.name+', modified '+f.date+', '+f.size},()=>choose(f.id));
});
updateCopy();if(focus){list.querySelector('button')?.focus();announce('Opened '+(dir||'Archive')+'. Choose a file to preview it.');}
}
function drawPacked(newId){
$('packedList').replaceChildren();$('capacity').textContent=packed.length+' / 2 files';
if(!packed.length){const p=document.createElement('p');p.className='empty';p.textContent='Nothing packed yet. Your first discovery goes here.';$('packedList').append(p);}
packed.forEach(id=>{
const f=getFile(id),item=document.createElement('div');item.className='packed'+(id===newId?' arriving':'');
const title=document.createElement('strong');title.textContent=f.name;
const path=document.createElement('p');path.textContent='From '+f.dir+' · '+f.date;
const button=document.createElement('button');button.textContent='Remove '+f.name;button.dataset.remove=id;button.setAttribute('aria-label','Remove '+f.name+' from '+f.dir);
button.addEventListener('click',()=>{
const index=packed.indexOf(id);packed=packed.filter(x=>x!==id);drawPacked();updateCopy();
const remaining=$('packedList').querySelectorAll('button');(remaining[Math.min(index,remaining.length-1)]||$('check')).focus();announce('Removed '+f.name+'. The original is still in the archive.');
});
item.append(title,path,button);$('packedList').append(item);
});
}
$('copy').addEventListener('click',()=>{
if(!selected||packed.includes(selected)||packed.length>=2)return;
const id=selected;packed.push(id);drawPacked(id);updateCopy();announce('Copied '+getFile(id).name+'. '+packed.length+' of 2 files packed. The original stays in the archive.');
});
function clearDispatch(){packed=[];drawPacked();updateCopy();announce('Dispatch emptied. The archive is unchanged.');}
$('clear').addEventListener('click',clearDispatch);
$('check').addEventListener('click',()=>{
const m=missions[stage],wrong=packed.filter(id=>!m.ids.includes(id));
if(packed.length!==2){announce('Pack exactly two files before dispatching. You have '+packed.length+'.',true);return;}
if(wrong.length){
const names=wrong.map(id=>getFile(id).name+' from '+getFile(id).dir).join(' and ');
announce('Not quite: '+names+' does not match the brief. Remove '+(wrong.length===1?'it':'those files')+' and try another discovery.',true);return;
}
$('play').hidden=true;$('success').hidden=false;$('successTitle').textContent=stage===2?'Three dispatches. Nicely done.':'Dispatch accepted.';
$('successText').textContent=m.done;$('next').textContent=stage===2?'Play the run again':'Next dispatch';
$('delivered').replaceChildren();
m.ids.forEach(id=>{
const f=getFile(id);if(f.cell===undefined)return;
const pic=document.createElement('div');pic.className='thumb';pic.setAttribute('role','img');pic.setAttribute('aria-label',scenes[f.cell]);pic.style.backgroundPosition=(f.cell%3)*50+'% '+Math.floor(f.cell/3)*100+'%';$('delivered').append(pic);
});
$('successTitle').focus();
});
function start(){
dir='';selected=null;packed=[];$('play').hidden=false;$('success').hidden=true;
$('missionTitle').textContent=missions[stage].title;$('clue').textContent=missions[stage].clue;
$('destination').textContent='/Dispatch/'+missions[stage].destination+'/';
document.querySelectorAll('.steps li').forEach((li,i)=>{if(i===stage)li.setAttribute('aria-current','step');else li.removeAttribute('aria-current');li.textContent=String(i+1)+(i<stage?' done':'');});
$('hintText').hidden=true;$('hint').setAttribute('aria-expanded','false');$('hintText').textContent=missions[stage].hint;
openFolder('',false);drawPacked();overview();announce('Dispatch '+(stage+1)+' of 3. Start by opening a folder in the archive.');
}
$('next').addEventListener('click',()=>{stage=(stage+1)%3;start();$('missionTitle').focus();});
$('restart').addEventListener('click',()=>{start();$('missionTitle').focus();});
$('overview').addEventListener('click',()=>{overview();announce('Showing all six discoveries. Your selection and dispatch are unchanged.');});
$('hint').addEventListener('click',()=>{const open=$('hintText').hidden;$('hintText').hidden=!open;$('hint').setAttribute('aria-expanded',String(open));});
start();
</script>
</body>
</html>
