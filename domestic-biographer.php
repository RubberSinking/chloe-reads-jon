<?php
$sourceUrl = 'https://jona.ca/2008/06/way-we-live-now-domains-jonathan-aquino.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#f3ead8">
<title>The Domestic Biographer</title>
<style>
:root{--paper:#f3ead8;--ink:#172c35;--red:#d64f39;--mustard:#e4ac35;--sage:#779785;--cream:#fffaf0;--line:rgba(23,44,53,.22);--shadow:0 18px 45px rgba(39,31,22,.15)}
*{box-sizing:border-box}html{scroll-behavior:smooth}
body{margin:0;background:var(--paper);color:var(--ink);font-family:'Avenir Next','Gill Sans',sans-serif;background-image:radial-gradient(rgba(23,44,53,.06) .7px,transparent .8px);background-size:7px 7px}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.22;background:linear-gradient(90deg,transparent 49.8%,rgba(255,255,255,.5) 50%,transparent 50.2%);background-size:33px 100%;mix-blend-mode:soft-light}
a{color:inherit}button{font:inherit}
.mast{max-width:1180px;margin:auto;padding:22px 24px 0;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--ink);font-family:'Courier New',monospace;font-size:.72rem;letter-spacing:.08em;text-transform:uppercase}
.mast a{text-decoration:none;padding:12px 0}.issue{background:var(--ink);color:var(--cream);padding:7px 10px;transform:rotate(-1deg)}
main{max-width:1180px;margin:auto;padding:0 24px 80px}
.hero{display:grid;grid-template-columns:minmax(0,1.04fr) minmax(340px,.96fr);gap:clamp(28px,5vw,72px);align-items:center;padding:clamp(48px,9vw,110px) 0 68px}
.kicker{font-family:'Courier New',monospace;color:var(--red);font-weight:500;text-transform:uppercase;letter-spacing:.12em;font-size:.78rem}
h1{font-family:'Iowan Old Style','Palatino Linotype',Palatino,serif;font-weight:900;font-size:clamp(3.6rem,8.4vw,7.7rem);line-height:.8;letter-spacing:-.07em;margin:18px 0 26px;max-width:760px}
h1 span{display:block;color:var(--red);font-style:italic;transform:translateX(.48em)}
.dek{font-family:'Iowan Old Style','Palatino Linotype',Palatino,serif;font-size:clamp(1.15rem,2vw,1.55rem);line-height:1.45;max-width:620px;margin:0 0 26px}
.hero-actions{display:flex;flex-wrap:wrap;gap:11px;align-items:center}
.btn{border:1px solid var(--ink);background:var(--red);color:white;padding:13px 18px;font-weight:800;cursor:pointer;box-shadow:4px 4px 0 var(--ink);transition:.15s transform,.15s box-shadow;text-decoration:none;display:inline-flex;align-items:center;gap:8px}
.btn:hover{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--ink)}.btn.alt{background:var(--cream);color:var(--ink)}
.hero-art{position:relative;transform:rotate(1.4deg);filter:drop-shadow(0 22px 20px rgba(57,37,22,.18))}
.hero-art:before{content:"A life, hiding in plain sight";position:absolute;z-index:2;left:-18px;top:22px;background:var(--mustard);border:1px solid var(--ink);padding:9px 12px;font-family:'Courier New';font-size:.68rem;text-transform:uppercase;transform:rotate(-5deg)}
.hero-art img{width:100%;display:block;border:2px solid var(--ink);background:#d9cdb8;clip-path:polygon(1% 0,100% 1%,99% 99%,0 100%)}
.caption{font-family:'Courier New';font-size:.67rem;line-height:1.5;margin:10px 12px 0;text-transform:uppercase}.rule{border:0;border-top:1px solid var(--ink);margin:0}
.intro{display:grid;grid-template-columns:130px 1fr;gap:32px;padding:38px 0 26px;align-items:start}.step-no{font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-size:5rem;font-weight:900;color:var(--mustard);line-height:.8}
.intro h2,.result h2{font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-size:clamp(2rem,5vw,4.2rem);letter-spacing:-.045em;line-height:.98;margin:0 0 10px}.intro p{max-width:700px;line-height:1.7;margin:0}
.progress-wrap{position:sticky;top:0;z-index:9;background:rgba(243,234,216,.94);backdrop-filter:blur(12px);padding:13px 0;border-block:1px solid var(--ink);display:flex;align-items:center;gap:16px}
.progress{height:10px;background:rgba(23,44,53,.14);flex:1;overflow:hidden}.progress i{display:block;width:0;height:100%;background:var(--red);transition:width .35s cubic-bezier(.2,.8,.2,1)}
.progress-label{font-family:'Courier New';font-size:.72rem;white-space:nowrap;text-transform:uppercase}.chapters{padding:22px 0 48px}
.chapter{display:grid;grid-template-columns:220px 1fr;gap:30px;padding:34px 0;border-bottom:1px solid var(--line)}.chapter-label small{display:block;font-family:'Courier New';font-size:.67rem;text-transform:uppercase;color:var(--red);margin-bottom:8px}
.chapter-label h3{font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-size:2rem;margin:0;line-height:1}.choices{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
.choice{position:relative;min-height:138px;text-align:left;border:1px solid var(--ink);padding:17px;background:rgba(255,250,240,.58);cursor:pointer;transition:.2s transform,.2s background,.2s box-shadow;display:flex;flex-direction:column;justify-content:space-between}
.choice:hover{transform:translateY(-3px);box-shadow:0 8px 0 rgba(23,44,53,.1)}.choice[aria-pressed="true"]{background:var(--mustard);box-shadow:5px 5px 0 var(--ink);transform:translate(-2px,-2px)}
.choice:nth-child(2)[aria-pressed="true"]{background:#b6cec0}.choice:nth-child(3)[aria-pressed="true"]{background:#e9a08f}
.choice-icon{font-size:2rem;filter:grayscale(.15)}.choice strong{font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-size:1.08rem;line-height:1.12}.choice em{font-family:'Courier New';font-style:normal;font-size:.62rem;text-transform:uppercase;opacity:.7;margin-top:8px}
.result{display:none;grid-template-columns:minmax(0,1fr) minmax(300px,.75fr);gap:clamp(28px,6vw,76px);background:var(--ink);color:var(--cream);padding:clamp(28px,6vw,70px);margin-top:30px;position:relative;overflow:hidden;box-shadow:var(--shadow)}
.result.show{display:grid;animation:unfold .7s cubic-bezier(.18,.9,.22,1) both}@keyframes unfold{from{opacity:0;transform:translateY(25px) rotateX(-7deg)}to{opacity:1;transform:none}}
.result:after{content:"PROFILE";position:absolute;right:-34px;top:30px;border:1px solid rgba(255,255,255,.25);padding:7px 45px;transform:rotate(38deg);font:500 .62rem 'Courier New';letter-spacing:.22em}
.result .kicker{color:var(--mustard)}.profile-copy{font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-size:1.25rem;line-height:1.6;margin:22px 0}.pullquote{border-left:8px solid var(--red);padding:8px 0 8px 18px;font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-size:1.5rem;font-style:italic;color:var(--mustard)}
.evidence{align-self:center;background:var(--cream);color:var(--ink);padding:24px;transform:rotate(1deg);box-shadow:9px 9px 0 var(--red)}.evidence h3{font-family:'Courier New';font-size:.72rem;letter-spacing:.12em;text-transform:uppercase;border-bottom:1px solid;padding-bottom:10px;margin-top:0}
.evidence ul{list-style:none;padding:0;margin:0}.evidence li{display:flex;justify-content:space-between;gap:15px;padding:9px 0;border-bottom:1px dotted var(--line);font-size:.85rem}.evidence li span:first-child{font-family:'Courier New';font-size:.65rem;text-transform:uppercase;color:var(--red)}
.result-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:26px}.result .btn.alt{background:transparent;color:var(--cream);border-color:var(--cream);box-shadow:4px 4px 0 var(--cream)}
.source{display:grid;grid-template-columns:1fr auto;gap:26px;align-items:center;padding:48px 0 0}.source p{margin:0;line-height:1.7;max-width:760px}.source a{font-family:'Iowan Old Style','Palatino Linotype',Palatino;font-weight:800;color:var(--red)}
.seal{width:94px;height:94px;border:1px solid var(--ink);border-radius:50%;display:grid;place-items:center;text-align:center;font:500 .6rem/1.35 'Courier New';text-transform:uppercase;transform:rotate(8deg);background:var(--mustard);box-shadow:inset 0 0 0 5px var(--paper)}
.toast{position:fixed;right:18px;bottom:18px;background:var(--ink);color:white;padding:13px 17px;font:500 .73rem 'Courier New';transform:translateY(80px);opacity:0;transition:.25s;z-index:30}.toast.on{transform:none;opacity:1}
@media(max-width:850px){.hero{grid-template-columns:1fr}.hero-art{max-width:650px}.chapter{grid-template-columns:1fr}.chapter-label{display:flex;gap:12px;align-items:baseline}.result{grid-template-columns:1fr}.intro{grid-template-columns:80px 1fr}}
@media(max-width:600px){.mast{padding-inline:16px}.mast span:first-child{display:none}main{padding-inline:16px}.hero{padding-top:48px}.hero-art:before{left:-5px}.choices{grid-template-columns:1fr}.choice{min-height:96px;display:grid;grid-template-columns:48px 1fr;align-items:center;gap:8px}.choice em{grid-column:2}.intro{grid-template-columns:1fr}.step-no{font-size:3rem}.source{grid-template-columns:1fr}.seal{display:none}.result{margin-inline:-16px}.progress-label b{display:none}}
@media(prefers-reduced-motion:reduce){*,*:before,*:after{scroll-behavior:auto!important;animation:none!important;transition:none!important}}
</style>
</head>
<body>
<header class="mast"><span>Sunday Domestic Supplement</span><a href="./">← Chloe Reads Jon</a><span class="issue">Issue No. 20 · 2026</span></header>
<main>
<section class="hero">
<div><div class="kicker">An autobiography with no important questions</div><h1>The Domestic <span>Biographer</span></h1><p class="dek">A life is not only made of milestones. It is also made of breakfast, bedside clutter, beloved obsolete things, and the exact object you researched far too intensely.</p><div class="hero-actions"><a class="btn" href="#desk">Begin your profile ↓</a><button class="btn alt" id="jonMode">Load Jon, 2008</button></div></div>
<figure class="hero-art"><img src="domestic-biographer-room.webp" width="1536" height="1024" alt="Cut-paper illustration of a cozy room filled with books, a desk, guitar, toy car, rosary and a curious cat"><figcaption class="caption">Illustration assembled from ordinary clues. Each object has been entered into evidence.</figcaption></figure>
</section>
<hr class="rule">
<section class="intro" id="desk"><div class="step-no">01</div><div><h2>Choose the clues.</h2><p>Pick one answer in each chapter. There are no aspirational answers here: choose the thing most likely to be found in the wild, on a perfectly ordinary Tuesday.</p></div></section>
<div class="progress-wrap"><div class="progress"><i id="bar"></i></div><div class="progress-label"><b>Profile evidence: </b><span id="count">0</span>/6</div></div>
<div class="chapters" id="chapters"></div>
<section class="result" id="result" aria-live="polite"><div><div class="kicker">The profile desk reports</div><h2 id="profileTitle">The Keeper of Useful Things</h2><p class="profile-copy" id="profileCopy"></p><div class="pullquote" id="pullquote"></div><div class="result-actions"><button class="btn" id="copyBtn">Copy profile</button><button class="btn alt" id="againBtn">Re-open the file</button></div></div><aside class="evidence"><h3>Exhibit list / ordinary life</h3><ul id="evidenceList"></ul></aside></section>
<section class="source"><p>Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener">“The Way We Live Now: Domains: Jonathan Aquino”</a>, a 2008 self-interview in which eggs, SmartGloves, a flaky PDA, calligraphy, books, a neighbour's cat, and a suspiciously well-researched stapler reveal more than any grand biography could.</p><div class="seal">Filed by<br>The Domestic<br>Biographer</div></section>
</main>
<div class="toast" id="toast">Copied to clipboard.</div>
<script>
const chapters=[
{key:'morning',label:'Chapter I',title:'First evidence',q:'Morning',options:[
{icon:'☕',name:'The hot mug',note:'I begin in increments',trait:'ritual',line:'begins the day by negotiating quietly with a hot mug'},
{icon:'🍳',name:'The practical breakfast',note:'Efficient, warm, unfussy',trait:'practicality',line:'believes breakfast should be warm, efficient, and structurally sound'},
{icon:'🎵',name:'The opening track',note:'A soundtrack before speech',trait:'delight',line:'lets one excellent song open the curtains on the morning'}]},
{key:'desk',label:'Chapter II',title:'The work surface',q:'Desk',options:[
{icon:'⌨️',name:'The tuned machine',note:'Shortcuts have shortcuts',trait:'craft',line:'has quietly tuned the computer until it fits like a hand tool'},
{icon:'✒️',name:'The paper notebook',note:'Ink remembers differently',trait:'attention',line:'keeps a paper notebook nearby because ink remembers differently'},
{icon:'🧩',name:'The half-solved puzzle',note:'The mind needs side doors',trait:'curiosity',line:'leaves a puzzle in progress so the mind always has a side door'}]},
{key:'shelf',label:'Chapter III',title:'The shelf',q:'Shelf',options:[
{icon:'📚',name:'The skill stack',note:'Learning counts as need',trait:'growth',line:'considers a book that teaches a skill less a purchase than an inevitability'},
{icon:'🕹️',name:'The obsolete treasure',note:'Old magic still works',trait:'loyalty',line:'keeps one obsolete machine because old magic is still magic'},
{icon:'🚙',name:'The tiny vehicle',note:'A story at 1:64 scale',trait:'play',line:'can find an entire road-trip story in a vehicle small enough for a pocket'}]},
{key:'pocket',label:'Chapter IV',title:'Always within reach',q:'Pocket',options:[
{icon:'📝',name:'Something to write on',note:'Trust nothing to memory',trait:'readiness',line:'trusts nothing to memory and is usually correct about this'},
{icon:'🔧',name:'A useful implement',note:'Tiny repairs matter',trait:'care',line:'carries a small useful implement against the possibility of repair'},
{icon:'🪙',name:'A tiny keepsake',note:'History should have weight',trait:'memory',line:'likes a memory best when it has weight and worn edges'}]},
{key:'obsession',label:'Chapter V',title:'The rabbit hole',q:'Obsession',options:[
{icon:'📎',name:'The perfect tool',note:'Reviews: 37 tabs',trait:'discernment',line:'will compare thirty-seven tabs to find the one tool made properly'},
{icon:'🔤',name:'The perfect typeface',note:'The lowercase g matters',trait:'taste',line:'knows that the shape of a lowercase g can alter the moral atmosphere'},
{icon:'🗺️',name:'The perfect route',note:'Scenic beats obvious',trait:'adventure',line:'regards the obvious route as merely the opening offer'}]},
{key:'evening',label:'Chapter VI',title:'Last light',q:'Evening',options:[
{icon:'🎸',name:'Make something together',note:'One more song',trait:'kinship',line:'would rather finish the day making one small thing with someone'},
{icon:'📖',name:'Read past bedtime',note:'Just one more chapter',trait:'wonder',line:'has repeatedly discovered that “one more chapter” is not a unit of time'},
{icon:'📿',name:'Return to quiet',note:'The day ends in prayer',trait:'faith',line:'lets the noise settle and returns the whole day to quiet prayer'}]}
];
const picks={},wrap=document.getElementById('chapters');
chapters.forEach((c,ci)=>{const section=document.createElement('section');section.className='chapter';let choices='';c.options.forEach((o,oi)=>{choices+='<button class="choice" aria-pressed="false" data-chapter="'+ci+'" data-option="'+oi+'"><span class="choice-icon">'+o.icon+'</span><strong>'+o.name+'</strong><em>'+o.note+'</em></button>'});section.innerHTML='<div class="chapter-label"><small>'+c.label+'</small><h3>'+c.title+'</h3></div><div class="choices" role="group" aria-label="'+c.title+'">'+choices+'</div>';wrap.appendChild(section)});
wrap.addEventListener('click',e=>{const b=e.target.closest('.choice');if(b)choose(+b.dataset.chapter,+b.dataset.option)});
function choose(ci,oi){picks[ci]=oi;document.querySelectorAll('[data-chapter="'+ci+'"]').forEach(b=>b.setAttribute('aria-pressed',b.dataset.option==oi));update()}
function update(){const n=Object.keys(picks).length;document.getElementById('count').textContent=n;document.getElementById('bar').style.width=(n/6*100)+'%';if(n===6)reveal()}
function reveal(){const selected=chapters.map((c,i)=>c.options[picks[i]]),traits=selected.map(x=>x.trait),titles={faith:'Keeper of the Last Light',wonder:'Reader Beyond Bedtime',kinship:'Maker of Small Good Things'};document.getElementById('profileTitle').textContent='The '+(titles[traits[5]]||'Keeper of Useful Things');document.getElementById('profileCopy').textContent='Here lives someone who '+selected[0].line+', and who '+selected[1].line+'. The shelves suggest a person who '+selected[2].line+'; the pockets confirm someone who '+selected[3].line+'. Given half a chance, this resident '+selected[4].line+'. By evening, this is someone who '+selected[5].line+'. None of these clues is important. Together, they are unmistakable.';document.getElementById('pullquote').textContent='“A life with '+traits[1]+', '+traits[3]+', and just enough '+traits[4]+'.”';document.getElementById('evidenceList').innerHTML=selected.map((o,i)=>'<li><span>'+chapters[i].q+'</span><strong>'+o.icon+' '+o.name+'</strong></li>').join('');const r=document.getElementById('result');r.classList.add('show');setTimeout(()=>r.scrollIntoView({behavior:'smooth',block:'center'}),220)}
document.getElementById('jonMode').addEventListener('click',()=>{[1,0,0,0,0,2].forEach((o,i)=>choose(i,o));setTimeout(()=>document.getElementById('result').scrollIntoView({behavior:'smooth'}),250)});
document.getElementById('againBtn').addEventListener('click',()=>{document.getElementById('result').classList.remove('show');document.getElementById('desk').scrollIntoView({behavior:'smooth'})});
document.getElementById('copyBtn').addEventListener('click',async()=>{const text=document.getElementById('profileTitle').textContent+'\n\n'+document.getElementById('profileCopy').textContent+'\n\n'+document.getElementById('pullquote').textContent;try{await navigator.clipboard.writeText(text);showToast('Profile copied.')}catch{showToast('Select and copy the profile above.')}});
function showToast(t){const el=document.getElementById('toast');el.textContent=t;el.classList.add('on');setTimeout(()=>el.classList.remove('on'),2200)}
</script>
</body>
</html>
