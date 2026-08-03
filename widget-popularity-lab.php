<?php
declare(strict_types=1);
$sourceUrl = 'https://jona.ca/2006/01/most-downloaded-konfabulator-widgets.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Widget Popularity Lab</title>
<style>
:root{--ink:#16203a;--glass:rgba(255,255,255,.76);--edge:rgba(255,255,255,.88);--blue:#168cff;--pink:#ff3e80;--lime:#b6f23a;--shadow:0 20px 60px rgba(24,38,92,.28)}
*{box-sizing:border-box}html{min-height:100%;background:#84bde5}body{margin:0;min-height:100vh;color:var(--ink);font-family:"Courier New",monospace;overflow-x:hidden;background:radial-gradient(circle at 20% 10%,#fff 0 3%,transparent 18%),linear-gradient(145deg,#70d0f0 0%,#717fd8 52%,#e581b2 100%)}
body.night{background:radial-gradient(circle at 75% 12%,#fff 0 1px,transparent 2px),linear-gradient(145deg,#101934,#273366 50%,#6f315d)}
.grain{position:fixed;inset:0;pointer-events:none;opacity:.08;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}
header{padding:24px clamp(18px,4vw,58px) 8px;display:flex;justify-content:space-between;align-items:flex-start;gap:20px;position:relative;z-index:3}.brand{transform:rotate(-1deg)}.kicker{font-size:11px;letter-spacing:.22em;text-transform:uppercase;background:var(--lime);display:inline-block;padding:5px 9px;border:2px solid var(--ink);box-shadow:3px 3px 0 var(--ink)}h1{font:900 clamp(34px,6vw,72px)/.88 Georgia,serif;font-style:italic;letter-spacing:-.055em;margin:13px 0 0;color:white;text-shadow:4px 5px 0 var(--ink);max-width:760px}.controls{display:flex;gap:8px;flex-wrap:wrap;justify-content:flex-end}.button,button{font:700 12px "Courier New",monospace;border:2px solid var(--ink);background:#fff;color:var(--ink);padding:9px 12px;box-shadow:3px 3px 0 var(--ink);cursor:pointer;text-decoration:none}.button:hover,button:hover{transform:translate(2px,2px);box-shadow:1px 1px 0 var(--ink)}
.desktop{position:relative;margin:14px clamp(12px,3vw,42px) 32px;min-height:650px;border:2px solid rgba(255,255,255,.8);border-radius:26px;background:linear-gradient(150deg,rgba(255,255,255,.2),rgba(255,255,255,.05));box-shadow:inset 0 0 80px rgba(255,255,255,.14),var(--shadow);overflow:hidden}.menubar{height:34px;background:rgba(255,255,255,.82);backdrop-filter:blur(15px);display:flex;align-items:center;padding:0 14px;font-size:11px;gap:18px;border-bottom:1px solid rgba(30,40,80,.2)}.menubar strong{font-family:Georgia}.menubar span:last-child{margin-left:auto}
.canvas{padding:22px 400px 90px 22px;display:grid;grid-template-columns:repeat(2,minmax(180px,1fr));gap:16px;align-content:start}.widget{min-height:180px;border:2px solid var(--edge);border-radius:20px;padding:18px;background:var(--glass);backdrop-filter:blur(18px);box-shadow:0 13px 30px rgba(28,42,87,.22),inset 0 1px #fff;position:relative;animation:land .55s both;transition:.2s transform}.widget:hover{transform:translateY(-3px)}@keyframes land{from{opacity:0;transform:scale(.9) translateY(20px)}}.widget h2{font:20px Georgia;margin:0 0 12px}.tag{position:absolute;right:12px;top:12px;background:var(--lime);border:1px solid var(--ink);font-size:9px;padding:3px 6px}.clock .time{font:clamp(43px,6vw,72px)/1 Georgia;letter-spacing:-.08em}.clock .date{font-size:11px;margin-top:7px}.weather{background:linear-gradient(135deg,rgba(255,214,70,.92),rgba(255,112,84,.82));color:#322114}.weather .temp{font:58px/1 Georgia}.weather .sky{font-size:12px}.note textarea{width:100%;height:106px;border:0;resize:none;background:transparent;font:14px/1.6 "Courier New";color:var(--ink);outline:0}.meter{height:14px;border:2px solid var(--ink);padding:2px;margin:8px 0 13px}.meter i{display:block;height:100%;background:var(--pink);width:var(--n)}.fortune{background:#19233f;color:#f8fbff}.fortune h2{color:var(--lime)}.fortune blockquote{margin:20px 0;font-size:15px;line-height:1.6}.fortune button{background:var(--lime)}
.catalog{position:absolute;right:18px;top:54px;width:360px;bottom:76px;background:#f5f1e7;border:2px solid var(--ink);box-shadow:7px 8px 0 var(--ink),0 20px 60px rgba(24,33,67,.35);overflow:hidden;display:flex;flex-direction:column}.cat-head{padding:15px;border-bottom:2px solid var(--ink);background:#ffec66}.cat-head h2{font:22px Georgia;margin:0 0 9px}.sorts{display:flex;gap:5px}.sorts button{padding:5px 7px;font-size:9px;box-shadow:2px 2px 0 var(--ink)}.sorts button.active{background:var(--pink);color:#fff}.list{overflow:auto;padding:6px}.item{display:grid;grid-template-columns:44px 1fr auto;gap:10px;align-items:center;padding:10px 7px;border-bottom:1px dashed #9a9384}.icon{width:42px;height:42px;border:2px solid var(--ink);border-radius:12px;display:grid;place-items:center;font-size:22px;background:var(--c);box-shadow:2px 2px 0 var(--ink)}.item h3{font-size:12px;margin:0 0 4px}.stats{font-size:9px;color:#686253}.add{padding:5px 7px;background:white;box-shadow:2px 2px 0 var(--ink)}
.dock{position:absolute;left:50%;bottom:12px;transform:translateX(-50%);display:flex;gap:8px;padding:8px 11px;border:1px solid rgba(255,255,255,.85);border-radius:18px;background:rgba(255,255,255,.44);backdrop-filter:blur(18px)}.dock span{width:42px;height:42px;border-radius:12px;display:grid;place-items:center;background:#fff;border:2px solid var(--ink);font-size:21px;box-shadow:2px 3px 0 var(--ink);transition:.18s}.dock span:hover{transform:translateY(-8px) scale(1.15)}
.about{max-width:760px;margin:0 auto 50px;padding:0 22px;text-align:center;color:white;line-height:1.7;font-size:12px}.about a{color:white;font-weight:bold;text-underline-offset:4px}.toast{position:fixed;left:50%;bottom:25px;transform:translate(-50%,120px);background:var(--ink);color:#fff;padding:11px 16px;border:2px solid white;z-index:9;transition:.3s}.toast.show{transform:translate(-50%,0)}
@media(max-width:820px){header{display:block}.controls{justify-content:flex-start;margin-top:18px}.desktop{min-height:1000px}.canvas{padding:18px;grid-template-columns:1fr}.catalog{position:relative;inset:auto;width:auto;margin:5px 18px 90px;height:430px}.dock{position:fixed;z-index:5}.widget{min-height:160px}.menubar span.hide{display:none}}
</style>
</head>
<body>
<div class="grain"></div>
<header>
  <div class="brand"><span class="kicker">TopKon Research Division · est. 2006</span><h1>Widget Popularity Lab</h1></div>
  <div class="controls"><button id="theme">☾ Night mode</button><a class="button" href="index.php">← All experiments</a></div>
</header>
<main class="desktop">
  <div class="menubar"><strong>◉ WIDGETLAB</strong><span class="hide">File</span><span class="hide">Arrange</span><span class="hide">Delight</span><span id="menuTime"></span></div>
  <section class="canvas" id="canvas">
    <article class="widget clock" data-id="clock"><span class="tag">#1 ESSENTIAL</span><h2>Big Clock</h2><div class="time" id="clock">12:34</div><div class="date" id="date"></div></article>
    <article class="widget weather" data-id="weather"><span class="tag">SURREY-ish</span><h2>Window Weather</h2><div class="temp">22°</div><div class="sky">A fine temperature. Cloud confidence: 78%</div></article>
    <article class="widget note" data-id="note"><h2>Yellow Note</h2><textarea id="note" aria-label="Sticky note" placeholder="Type something worth remembering…"></textarea></article>
    <article class="widget fortune" data-id="fortune"><h2>Tiny Oracle</h2><blockquote id="fortune">“The best widget is the one you actually glance at.”</blockquote><button id="another">Another truth</button></article>
  </section>
  <aside class="catalog">
    <div class="cat-head"><h2>Widget Directory</h2><div class="sorts"><button class="active" data-sort="downloads">MOST DOWNLOADED</button><button data-sort="rating">TOP RATED</button><button data-sort="name">A–Z</button></div></div>
    <div class="list" id="list"></div>
  </aside>
  <nav class="dock" aria-label="Desktop dock"><span>🧭</span><span>🎵</span><span>📷</span><span>⚙️</span><span>🗑️</span></nav>
</main>
<p class="about">In 2006, finding the best Konfabulator widgets was harder than it had any right to be, so Jon made his own popularity-sorted list of 500. Naturally, I made the laboratory edition. <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener">Inspired by Jon’s “The Most Downloaded Konfabulator Widgets”</a>.</p>
<div class="toast" id="toast"></div>
<script>
const widgets=[
 {name:'System Pulse',icon:'▥',downloads:98431,rating:4.6,c:'#70ebba',kind:'meter'},
 {name:'Moon Phase',icon:'◐',downloads:76322,rating:4.9,c:'#8ea4ff',kind:'moon'},
 {name:'Pixel Pet',icon:'🐕',downloads:69018,rating:4.4,c:'#ff9e63',kind:'pet'},
 {name:'Tea Timer',icon:'♨',downloads:55429,rating:4.8,c:'#f38dac',kind:'tea'},
 {name:'Disk Jockey',icon:'♫',downloads:43087,rating:4.2,c:'#e1cf64',kind:'music'},
 {name:'Dad Joke Wire',icon:'!',downloads:39110,rating:4.7,c:'#ad8df3',kind:'joke'},
 {name:'Binary Rain',icon:'01',downloads:22844,rating:3.9,c:'#9def65',kind:'binary'}
];
const list=document.querySelector('#list'),canvas=document.querySelector('#canvas'),toast=document.querySelector('#toast');
function render(key='downloads'){
 const sorted=[...widgets].sort((a,b)=>key==='name'?a.name.localeCompare(b.name):b[key]-a[key]);
 list.innerHTML=sorted.map(w=>`<div class="item"><div class="icon" style="--c:${w.c}">${w.icon}</div><div><h3>${w.name}</h3><div class="stats">${w.downloads.toLocaleString()} grabs · ★ ${w.rating}</div></div><button class="add" data-kind="${w.kind}">＋</button></div>`).join('');
}
document.querySelector('.sorts').onclick=e=>{if(!e.target.dataset.sort)return;document.querySelectorAll('.sorts button').forEach(b=>b.classList.remove('active'));e.target.classList.add('active');render(e.target.dataset.sort)};
const templates={
 meter:['System Pulse','CPU behaving itself<div class="meter"><i style="--n:34%"></i></div>Memory eating snacks<div class="meter"><i style="--n:67%"></i></div>'],
 moon:['Moon Phase','<div style="font-size:70px;text-align:center">◔</div><div style="text-align:center;font-size:11px">Waxing thoughtfully</div>'],
 pet:['Pixel Pet','<div style="font-size:68px;text-align:center">🐕</div><div style="text-align:center;font-size:11px">BEEP requires one (1) click</div>'],
 tea:['Tea Timer','<div style="font:48px Georgia;text-align:center" class="count">03:00</div><button onclick="tea(this)">Start steeping</button>'],
 music:['Disk Jockey','<div style="font-size:58px;text-align:center">💿</div><div style="font-size:11px;text-align:center">KISS · dashboard mix</div>'],
 joke:['Dad Joke Wire','<blockquote style="line-height:1.6">I only know 25 letters of the alphabet. I don’t know y.</blockquote>'],
 binary:['Binary Rain','<div style="font-size:11px;word-break:break-all;color:#198754">01001010 01101111 01101110 00100000 01110010 01101111 01100011 01101011 01110011</div>']
};
list.onclick=e=>{const b=e.target.closest('.add');if(!b)return;const [title,body]=templates[b.dataset.kind];const el=document.createElement('article');el.className='widget';el.innerHTML=`<span class="tag">JUST ADDED</span><h2>${title}</h2>${body}`;canvas.append(el);show(`${title} installed. Your desktop is 12% more 2006.`);el.scrollIntoView({behavior:'smooth',block:'center'})};
function show(s){toast.textContent=s;toast.classList.add('show');clearTimeout(show.t);show.t=setTimeout(()=>toast.classList.remove('show'),2400)}
function tick(){const d=new Date(),time=d.toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'});document.querySelector('#clock').textContent=time;document.querySelector('#menuTime').textContent=time;document.querySelector('#date').textContent=d.toLocaleDateString([],{weekday:'long',month:'long',day:'numeric'})}tick();setInterval(tick,1000);
const note=document.querySelector('#note');note.value=localStorage.widgetLabNote||'';note.oninput=()=>localStorage.widgetLabNote=note.value;
const truths=['“Popularity is a clue, not a verdict.”','“A dashboard should answer before it distracts.”','“If it needs a tutorial, it may be an application wearing a tiny hat.”','“One excellent clock beats seven novelty clocks.”','“Sortable lists: civilisation’s quiet triumph.”'];let ti=0;document.querySelector('#another').onclick=()=>{ti=(ti+1)%truths.length;document.querySelector('#fortune').textContent=truths[ti]};
document.querySelector('#theme').onclick=e=>{document.body.classList.toggle('night');e.target.textContent=document.body.classList.contains('night')?'☀ Day mode':'☾ Night mode'};
function tea(btn){let n=180;btn.disabled=true;const out=btn.previousElementSibling,t=setInterval(()=>{n--;out.textContent=`${String(Math.floor(n/60)).padStart(2,'0')}:${String(n%60).padStart(2,'0')}`;if(!n){clearInterval(t);btn.textContent='Tea achieved ✓';show('Your tea is ready. The widget has fulfilled its destiny.')}},1000)}
render();
</script>
</body>
</html>
