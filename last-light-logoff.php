<?php
declare(strict_types=1);
if (isset($_GET['source'])) {
    $registry = file_get_contents(__DIR__ . '/index.php');
    if (preg_match('~href="(https?://[^"]+/2006/10/speeding-up-windows-xp-shutdown\\.html)"~', $registry, $m)) {
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
<meta name="theme-color" content="#b9b7db">
<meta name="description" content="A gentle computer shutdown puzzle. Save the work, untangle the programs, and send a tiny felt office home.">
<title>Last Light Logoff</title>
<style>
@font-face{font-family:Logoff;src:url("assets/last-light-logoff-display.otf") format("opentype");font-weight:700;font-display:swap}
:root{--stage:#b9b7db;--ink:#302840;--muted:#554768;--paper:#f3edfa;--peach:#f6cbb1;--mint:#d1efda;--line:#89809d;--action:#493b66;--white:#fffaff}
*{box-sizing:border-box}
html{scrollbar-color:var(--action) var(--stage)}
body{margin:0;background:var(--stage);color:var(--ink);font:1rem/1.5 "Trebuchet MS",sans-serif}
::selection{background:var(--action);color:var(--white)}
a{color:inherit;text-underline-offset:4px}
button{font:inherit;cursor:pointer;touch-action:manipulation}
button:disabled{cursor:default;opacity:.5}
:focus-visible{outline:3px solid var(--action);outline-offset:4px}
.wrap{max-width:1260px;margin:auto;padding:18px clamp(16px,4vw,48px) 40px}
nav{display:flex;justify-content:space-between;gap:16px;align-items:center;font-size:.9rem}
nav span{color:var(--ink)}
h1,h2,h3{font-family:Logoff,Georgia,serif;text-wrap:balance;line-height:1.12}
h1{font-size:clamp(2.4rem,6.4vw,5rem);letter-spacing:-.035em;margin:26px 0 9px}
.intro{margin:0 0 25px;font-size:1.08rem;max-width:65ch}
.theatre{display:grid;grid-template-columns:minmax(0,1.2fr) minmax(330px,1fr);gap:0;align-items:start}
.scene{position:relative;overflow:hidden;border-radius:14px 0 0 14px;background:#aaa9cf}
.scene img{display:block;width:100%;height:auto;aspect-ratio:3/2;object-fit:contain;transition:filter 1.1s cubic-bezier(.16,1,.3,1)}
.scene.off img{filter:brightness(.22) saturate(.5)}
.scene-note{margin:0;padding:12px 18px;color:var(--ink);font-size:.9rem;background:var(--mint);min-height:52px;position:relative}
.scene.off .scene-note{background:var(--ink);color:var(--mint)}
.shift-caption{padding:20px 4px 22px;font-size:.94rem;color:var(--ink);max-width:60ch}
.shift-caption p{margin:0 0 9px}
.shift-dots{display:flex;gap:8px;margin:0 0 12px;padding:0;list-style:none;font-variant-numeric:tabular-nums}
.shift-dots li{padding:5px 12px;border:1px solid var(--muted);border-radius:5px;font-size:.85rem}
.shift-dots [aria-current="step"]{background:var(--ink);color:var(--white);border-color:var(--ink)}
.desk{background:var(--paper);border-radius:0 14px 14px 14px;padding:22px}
.desk h2{font-size:1.6rem;margin:0 0 8px}
#brief{font-size:.95rem;margin:0 0 16px}
.roster{list-style:none;margin:0 0 18px;padding:0;border-top:1px solid var(--line)}
.program{width:100%;display:flex;justify-content:space-between;gap:10px;align-items:center;text-align:left;background:transparent;color:var(--ink);border:0;border-bottom:1px solid var(--line);padding:11px 9px;min-height:54px}
.program strong{font-size:1rem;font-weight:700}
.program span{font-size:.81rem;text-align:right;max-width:17ch}
.program[aria-pressed="true"]{background:var(--action);color:var(--white)}
.program:hover:not([aria-pressed="true"]){background:#ded6ed}
.program.clear strong{text-decoration:line-through;text-decoration-thickness:1px}
.inspector h3{font-size:1.3rem;margin:0 0 7px}
#detail{margin:0 0 15px;min-height:4.5em;font-size:.94rem}
.actions{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.actions button,.small,.primary{border:1px solid var(--action);border-radius:6px;min-height:46px;padding:10px 12px;color:var(--ink);background:var(--white)}
.actions button:hover:not(:disabled),.small:hover{background:#e3daef}
.actions button:disabled{opacity:.46}
.actions #close{background:var(--action);color:var(--white)}
#feedback{font-size:.93rem;margin:17px 0 0;min-height:3em;color:var(--muted)}
.power{margin-top:23px;background:var(--peach);border-radius:12px;padding:20px 22px;display:grid;grid-template-columns:1fr auto;gap:20px;align-items:center}
.power h2{font-size:1.45rem;margin:0 0 5px}
.power p{font-size:.95rem;margin:0;max-width:65ch}
.primary{background:var(--ink);color:var(--white);font-weight:700;min-width:180px}
.primary:hover:not(:disabled){background:#5a4a76}
#completion{background:var(--mint);padding:24px;border-radius:12px;margin-top:23px}
#completion h2{font-size:1.8rem;margin:0 0 12px}
#completion p{max-width:65ch}
.tools{display:flex;gap:18px;flex-wrap:wrap;margin-top:15px}
.tools button{font-size:.9rem;background:transparent;border:0;color:var(--ink);text-decoration:underline;text-underline-offset:4px;min-height:44px;padding:4px}
footer{margin-top:35px;padding-top:18px;border-top:1px solid var(--muted);font-size:.85rem}
footer p{max-width:75ch;margin:0 0 10px}
[hidden]{display:none!important}
@media(max-width:800px){
.theatre{grid-template-columns:1fr}.scene{border-radius:12px}.desk{border-radius:12px;padding:18px}
h1{margin-top:24px;font-size:clamp(2.2rem,10vw,3.8rem)}.intro{font-size:1rem;margin-bottom:18px}
.scene img{max-height:300px;object-fit:contain}.scene-note{min-height:0;padding:10px 14px}
.shift-caption{padding:15px 0 9px}.shift-caption p{font-size:.9rem}
.power{grid-template-columns:1fr;gap:15px;padding:18px}.primary{width:100%}
#detail{min-height:0}#feedback{min-height:0}.wrap{padding-top:14px}
nav{font-size:.83rem}nav span{max-width:13ch;text-align:right}
}
@media(prefers-reduced-motion:reduce){.scene img{transition:none}}
</style>
</head>
<body>
<main class="wrap">
<nav aria-label="Page navigation"><a href="./">Chloe Reads Jon</a><span>Everyone deserves to log off.</span></nav>
<header><h1>Last Light Logoff</h1><p class="intro">The computer wants to go home. Its programs have other plans.<br>Save the work, untangle the hold-ups, then turn out the lights.</p></header>
<div class="theatre">
<div>
<div class="scene" id="scene"><img src="assets/last-light-logoff.webp" alt="A handmade felt computer office, with a mint CRT, printer, modem and three tiny workers waiting to go home." width="1536" height="1024" fetchpriority="high"><p id="sceneNote" class="scene-note">Still here. The printer has put the kettle on again.</p></div>
<div class="shift-caption">
<ol class="shift-dots" aria-label="Shifts"><li aria-current="step">Shift 1</li><li>Shift 2</li><li>Shift 3</li></ol>
<p id="lesson">A program with unsaved work needs a save before it can leave. Choose a name to see what is keeping it here.</p>
</div>
</div>
<section class="desk" aria-labelledby="shiftTitle">
<h2 id="shiftTitle" tabindex="-1">The ordinary evening</h2><p id="brief"></p>
<ul id="roster" class="roster" aria-label="Programs"></ul>
<div class="inspector"><h3 id="programTitle"></h3><p id="detail"></p>
<div class="actions">
<button id="save">Save work</button><button id="finish">Finish job</button>
<button id="release">Release handle</button><button id="close">Close program</button>
</div></div>
<p id="feedback" role="status" aria-live="polite">Choose a program. Nobody is in a hurry.</p>
</section>
</div>
<section class="power" id="powerPanel" aria-labelledby="powerTitle">
<div><h2 id="powerTitle">Before the last light</h2><p id="counts"></p></div><button id="power" class="primary">Try shutting down</button>
</section>
<section id="completion" hidden aria-labelledby="completeTitle"><h2 id="completeTitle" tabindex="-1"></h2><p id="completeText"></p><button class="primary" id="next">Next shift</button></section>
<div class="tools"><button id="hint">A small nudge</button><button id="restart">Restart this shift</button></div>
<footer>
<p>Inspired by Jon's <a href="?source=1">Speeding up Windows XP shutdown: Microsoft User Profile Hive Cleanup Service</a>, October 2006. His shutdown went from five minutes to five seconds. An excellent reason to write a blog post.</p>
<p>A fictional, simplified puzzle, not a Windows repair tool. In the real service, abandoned user-profile registry handles were cleaned up so a profile could unload. This toy makes that invisible work visible. Nothing here touches your computer's programs or files.</p>
<p>Original felt-office artwork made for this page.</p>
</footer>
<noscript><p>JavaScript is needed to play. You can still read the source post using the link above.</p></noscript>
</main>
<script>
'use strict';
const $=id=>document.getElementById(id);
const shifts=[
{title:'The ordinary evening',brief:'Three programs. One unsaved drawing. Start with Paint.',lesson:'A program with unsaved work needs a save before it can leave. Choose a name to see what is keeping it here.',done:'The drawing is saved, the printout is finished, and everyone made it home.',apps:[
{id:'paint',name:'Paint',dirty:true,note:'A drawing of a very fast car. It has not been saved.'},
{id:'printer',name:'Print queue',busy:true,note:'One page is still coming out. Let it finish before you close the queue.'},
{id:'preview',name:'Print preview',deps:['printer'],note:'Waiting for the Print queue to close. It refuses to leave before its friend.'}]},
{title:'The stubborn souvenir',brief:'The apps can close, but one leaves something behind.',lesson:'A handle is a program’s grip on a shared resource. In this shift, Music player forgets its grip on the user profile even after it closes.',done:'The music stopped. The leftover handle was released. At last, the user profile can go home too.',apps:[
{id:'music',name:'Music player',sticky:true,note:'Finished playing, but this old app has a habit of leaving a profile handle behind.'},
{id:'notes',name:'Notepad',dirty:true,note:'A list of cars to spot tomorrow. Save it before closing.'},
{id:'backup',name:'Backup',busy:true,note:'Copying today’s work. Finish the copy before closing.'},
{id:'browser',name:'Browser',deps:['backup'],note:'Waiting for Backup to close so it can finish its own evening.'}]},
{title:'Nobody leaves the light on',brief:'Two loose handles and a chain of friends waiting for friends.',lesson:'Follow the waiting chain to its end. Close the leaf first, then work back. Clear abandoned handles before asking the whole computer to sleep.',done:'All three shifts are safely shut down. Every file saved, every job finished, every grip released. The computer would like a small duvet.',apps:[
{id:'editor',name:'Photo editor',dirty:true,deps:['export'],note:'A family photo needs saving. Its export helper must also close before the editor can leave.'},
{id:'export',name:'Export helper',busy:true,deps:['printer'],note:'Finish the export job, then close Print queue before sending this helper home.'},
{id:'printer',name:'Print queue',busy:true,sticky:true,note:'Finish the final print, close the queue, then release its forgotten profile handle.'},
{id:'scanner',name:'Scanner',sticky:true,note:'No scan in progress. This app can close now, but it leaves a profile handle behind.'},
{id:'desktop',name:'Desktop',deps:['editor','scanner'],note:'The last one to leave. Waiting for Photo editor and Scanner to close.'}]}
];
let shift=0,apps=[],selected='',off=false;
function current(){return apps.find(a=>a.id===selected);}
function waiting(a){return (a.deps||[]).map(id=>apps.find(b=>b.id===id)).filter(b=>!b.closed);}
function loose(a){return a.closed&&a.sticky&&!a.released;}
function remaining(){return apps.filter(a=>!a.closed).length;}
function handles(){return apps.filter(loose).length;}
function speak(text){$('feedback').textContent=text;}
function start(index){
shift=index;apps=structuredClone(shifts[shift].apps);selected=apps[0].id;off=false;
$('scene').classList.remove('off');$('sceneNote').textContent='Still here. The printer has put the kettle on again.';
$('shiftTitle').textContent=shifts[shift].title;$('brief').textContent=shifts[shift].brief;$('lesson').textContent=shifts[shift].lesson;
$('completion').hidden=true;$('powerPanel').hidden=false;$('power').disabled=false;
$('hint').disabled=false;$('restart').textContent='Restart this shift';
document.querySelectorAll('.shift-dots li').forEach((el,i)=>{if(i===shift)el.setAttribute('aria-current','step');else el.removeAttribute('aria-current');el.textContent='Shift '+(i+1)+(i<shift?' · home':'');});
$('roster').replaceChildren(...apps.map(a=>{
const li=document.createElement('li'),button=document.createElement('button'),name=document.createElement('strong'),state=document.createElement('span');
button.className='program';button.id='app-'+a.id;button.type='button';name.textContent=a.name;button.append(name,state);
button.addEventListener('click',()=>{selected=a.id;render();speak(a.name+' selected. '+$('detail').textContent);});li.append(button);return li;
}));
speak('Choose a program. Nobody is in a hurry.');render();
}
function stateText(a){
if(loose(a))return 'Closed · handle left';
if(a.closed)return 'Safely home';
if(a.dirty)return 'Unsaved work';
if(a.busy)return 'Job unfinished';
if(waiting(a).length)return 'Waiting for '+waiting(a).map(b=>b.name).join(', ');
return 'Ready to close';
}
function render(){
apps.forEach(a=>{const b=$('app-'+a.id);b.setAttribute('aria-pressed',String(a.id===selected));b.querySelector('span').textContent=stateText(a);b.classList.toggle('clear',a.closed&&!loose(a));b.setAttribute('aria-label',a.name+': '+stateText(a));});
const a=current();$('programTitle').textContent=a.name;
let detail=a.note;
if(a.closed)detail=loose(a)?'The program has left, but its grip on the user profile remains. Release the abandoned handle.':'Safely home. Nothing left to do here.';
else{if(!a.dirty&&!a.busy&&waiting(a).length===0)detail='All work is safe and no other program is holding this one up. Ready to close.';
else if(waiting(a).length)detail+=' Still waiting for: '+waiting(a).map(b=>b.name).join(', ')+'.';}
$('detail').textContent=detail;
$('save').disabled=off||a.closed||!a.dirty;$('finish').disabled=off||a.closed||!a.busy;
$('release').disabled=off||!loose(a);$('close').disabled=off||a.closed;
$('counts').textContent=remaining()+' program'+(remaining()===1?'':'s')+' still here. '+handles()+' abandoned handle'+(handles()===1?'':'s')+'.'+(remaining()===0&&handles()===0?' All clear. Time for lights out.':'');
}
function action(kind){
const a=current();if(off)return;let message='';
if(kind==='save'&&!a.closed&&a.dirty){a.dirty=false;message=a.name+': work saved. No files left behind.';}
if(kind==='finish'&&!a.closed&&a.busy){a.busy=false;message=a.name+': job finished. The little whirring noise has stopped.';}
if(kind==='release'&&loose(a)){a.released=true;message=a.name+': abandoned handle released. One less thing gripping the user profile.';}
if(kind==='close'&&!a.closed){
if(a.dirty)message=a.name+' still has unsaved work. Choose Save work first.';
else if(a.busy)message=a.name+' has an unfinished job. Choose Finish job first.';
else if(waiting(a).length)message=a.name+' is waiting for '+waiting(a).map(b=>b.name).join(' and ')+'. Close '+waiting(a)[0].name+' first.';
else{a.closed=true;message=a.name+' has gone home.'+(loose(a)?' But it left a profile handle behind. Choose Release handle.':'');}
}
const focused=document.activeElement;
render();speak(message);
if(focused instanceof HTMLButtonElement&&focused.disabled)$('app-'+a.id).focus();
}
['save','finish','release','close'].forEach(kind=>$(kind).addEventListener('click',()=>action(kind)));
$('power').addEventListener('click',()=>{
if(remaining()||handles()){speak(remaining()?'Not yet. '+remaining()+' program'+(remaining()===1?' is':'s are')+' still here. Choose a name to see what needs doing.':'The programs are closed, but '+handles()+' abandoned handle'+(handles()===1?' is':'s are')+' gripping the user profile. Select a row marked “handle left” and release it.');return;}
off=true;render();$('scene').classList.add('off');$('sceneNote').textContent='All quiet. Even the modem is asleep.';
$('powerPanel').hidden=true;$('completion').hidden=false;$('completeTitle').textContent=shift===2?'Goodnight, little computer.':'Lights out. Nicely done.';
$('completeText').textContent=shifts[shift].done;$('next').textContent=shift===2?'Play all three again':'Next shift';
$('hint').disabled=true;$('restart').textContent='Replay this shift';$('completeTitle').focus();speak('Shutdown complete. '+shifts[shift].done);
});
$('next').addEventListener('click',()=>{start((shift+1)%shifts.length);$('shiftTitle').focus();});
$('restart').addEventListener('click',()=>{start(shift);$('shiftTitle').focus();});
$('hint').addEventListener('click',()=>{
const a=apps.find(loose)||apps.find(a=>!a.closed&&(a.dirty||a.busy))||apps.find(a=>!a.closed&&waiting(a).length===0);
if(!a){speak('Everything is clear. Choose Try shutting down.');$('power').focus();return;}
selected=a.id;render();speak(a.name+': '+(loose(a)?'choose Release handle.':a.dirty?'choose Save work.':a.busy?'choose Finish job.':'choose Close program.'));$('app-'+a.id).focus();
});
start(0);
</script>
</body>
</html>
