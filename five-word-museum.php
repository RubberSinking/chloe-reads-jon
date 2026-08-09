<?php
$sourceUrl = 'https://jona.ca/2009/01/four-definitions-diaphanous-hermetic.html';
$sourceTitle = 'Five definitions: diaphanous, hermetic, liminal, sardonic, fabulist';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#082f32">
    <title>The Museum of Five Peculiar Words</title>
    <style>
        :root {
            --ink: #072d30;
            --deep: #041c20;
            --paper: #f1e4c3;
            --paper-2: #d8c397;
            --gold: #e9b657;
            --red: #b94432;
            --mint: #a9d4c8;
            --shadow: rgba(0, 10, 13, .55);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--paper);
            background:
                radial-gradient(circle at 15% -10%, #17525a 0, transparent 34rem),
                radial-gradient(circle at 90% 50%, #481e23 0, transparent 38rem),
                var(--deep);
            font-family: Baskerville, "Iowan Old Style", "Palatino Linotype", serif;
            overflow-x: hidden;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 20;
            opacity: .22;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.18'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
        }
        a { color: inherit; }
        button { font: inherit; }
        .shell { width: min(1160px, 100%); margin: auto; padding: 22px clamp(16px, 4vw, 48px) 70px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 20px; font-size: .8rem; letter-spacing: .15em; text-transform: uppercase; }
        .back { text-decoration: none; opacity: .78; transition: opacity .2s; }
        .back:hover { opacity: 1; }
        .catalogue { border: 1px solid rgba(233,182,87,.45); padding: 7px 11px; border-radius: 99px; color: var(--gold); }
        header { text-align: center; padding: clamp(55px, 10vw, 105px) 0 38px; position: relative; }
        .eyebrow { color: var(--gold); font-size: .76rem; text-transform: uppercase; letter-spacing: .32em; margin: 0 0 18px; }
        h1 { font-weight: 400; font-size: clamp(3rem, 8.5vw, 7.2rem); line-height: .79; letter-spacing: -.055em; margin: 0; text-wrap: balance; }
        h1 i { font-weight: 400; color: var(--gold); }
        .intro { max-width: 620px; margin: 28px auto 0; color: #cfceb9; font-size: clamp(1rem, 2vw, 1.2rem); line-height: 1.65; }
        .map-wrap { position: relative; margin-top: 20px; border: 1px solid rgba(233,182,87,.55); padding: 9px; background: #071719; box-shadow: 0 30px 90px var(--shadow); }
        .map-wrap::before, .map-wrap::after { content:"✦"; position:absolute; z-index:3; color:var(--gold); background:var(--deep); padding:0 9px; top:-11px; }
        .map-wrap::before { left:24px; } .map-wrap::after { right:24px; }
        .map { position: relative; aspect-ratio: 1672 / 941; overflow: hidden; background: #122; }
        .map img { width:100%; height:100%; object-fit:cover; display:block; opacity:.87; transform:scale(1.002); }
        .map::after { content:""; position:absolute; inset:0; pointer-events:none; box-shadow:inset 0 0 90px 12px rgba(0,0,0,.65); }
        .door {
            position: absolute; top: 17%; height: 59%; width: 14%; z-index: 2;
            border: 0; border-radius: 48% 48% 8px 8px; background: transparent; cursor: pointer;
            color: white; transition: background .25s, box-shadow .25s, transform .25s;
        }
        .door:nth-of-type(1) { left:8%; } .door:nth-of-type(2) { left:28%; }
        .door:nth-of-type(3) { left:45%; } .door:nth-of-type(4) { left:63%; }
        .door:nth-of-type(5) { left:82%; width:14%; }
        .door:hover, .door:focus-visible { outline:none; background:rgba(233,182,87,.12); box-shadow:0 0 0 2px var(--gold), 0 0 35px var(--gold); transform:translateY(-3px); }
        .door span { position:absolute; left:50%; bottom:-22%; transform:translateX(-50%); width:38px; height:38px; display:grid; place-items:center; border-radius:50%; background:var(--paper); color:var(--ink); border:3px double var(--ink); box-shadow:0 5px 20px #000; font-weight:bold; }
        .door.done span { background:var(--gold); font-size:0; }
        .door.done span::after { content:"✓"; font-size:18px; }
        .map-hint { text-align:center; color:var(--mint); margin:22px 0 0; font-style:italic; }
        .progress { display:grid; grid-template-columns:repeat(5, 1fr); gap:8px; max-width:560px; margin:28px auto 0; }
        .pip { height:5px; background:rgba(241,228,195,.15); transform:skewX(-25deg); overflow:hidden; }
        .pip::after { content:""; display:block; width:0; height:100%; background:var(--gold); transition:width .55s cubic-bezier(.2,.8,.2,1); }
        .pip.on::after { width:100%; }
        .word-strip { margin:85px 0 30px; display:grid; grid-template-columns:repeat(5,1fr); gap:1px; background:rgba(233,182,87,.25); border:1px solid rgba(233,182,87,.25); }
        .word-card { background:#09282b; padding:23px 18px; min-height:130px; }
        .word-card strong { display:block; color:var(--gold); font-size:clamp(1rem, 1.6vw, 1.25rem); font-weight:400; margin-bottom:8px; }
        .word-card small { color:#a9bcb4; line-height:1.45; display:block; }
        .source { text-align:center; color:#a9bcb4; font-style:italic; margin:45px auto 0; }
        .source a { color:var(--gold); text-underline-offset:4px; }

        dialog { border:0; padding:0; width:min(680px, calc(100% - 26px)); background:transparent; color:var(--ink); overflow:visible; }
        dialog::backdrop { background:rgba(0,12,15,.83); backdrop-filter:blur(8px); }
        .folio { background:var(--paper); padding:clamp(28px, 6vw, 58px); position:relative; box-shadow:0 30px 100px #000; border:1px solid #fff1c4; }
        .folio::before { content:""; position:absolute; inset:8px; border:1px solid rgba(7,45,48,.22); pointer-events:none; }
        .close { position:absolute; z-index:2; right:16px; top:13px; border:0; background:transparent; color:var(--ink); font-size:1.7rem; cursor:pointer; }
        .room-number { text-transform:uppercase; letter-spacing:.28em; font-size:.7rem; color:#7e382c; font-weight:bold; }
        .folio h2 { font-size:clamp(2rem,6vw,3.5rem); font-weight:400; letter-spacing:-.035em; margin:10px 0 16px; }
        .scene { font-size:clamp(1.08rem,2vw,1.25rem); line-height:1.65; margin:0 0 26px; }
        .choices { display:grid; grid-template-columns:repeat(2,1fr); gap:10px; }
        .choice { background:transparent; border:1px solid rgba(7,45,48,.35); padding:13px 11px; color:var(--ink); cursor:pointer; font-style:italic; font-size:1.05rem; transition:.18s; }
        .choice:hover, .choice:focus-visible { background:var(--ink); color:var(--paper); outline:none; transform:translateY(-2px); }
        .choice.wrong { animation:shake .35s; background:#a13a2f; color:white; }
        .reveal { display:none; border-top:1px solid rgba(7,45,48,.25); margin-top:25px; padding-top:24px; }
        .reveal.show { display:block; animation:rise .5s both; }
        .answer { display:flex; justify-content:space-between; align-items:baseline; gap:15px; }
        .answer strong { font-size:clamp(2.1rem,7vw,4rem); font-weight:400; color:#8e372c; }
        .answer em { color:#506c67; }
        .definition { font-size:1.12rem; line-height:1.55; }
        .memory { background:rgba(7,45,48,.08); padding:14px 16px; line-height:1.5; }
        .continue { width:100%; padding:15px; margin-top:16px; border:0; background:var(--ink); color:var(--paper); cursor:pointer; letter-spacing:.12em; text-transform:uppercase; font-size:.75rem; }
        .victory { text-align:center; }
        .victory-mark { font-size:4rem; color:var(--gold); display:block; animation:turn 8s linear infinite; }
        .victory h2 { font-size:clamp(2.3rem,8vw,5rem); line-height:.9; margin:15px 0 22px; }
        .name-line { margin:24px 0 0; border:0; border-bottom:1px solid var(--ink); width:min(320px,100%); padding:9px; text-align:center; background:transparent; font:italic 1.2rem Baskerville,serif; color:var(--ink); }
        .reset { background:none; border:0; color:#6e7771; text-decoration:underline; cursor:pointer; margin-top:15px; }
        .confetti { position:fixed; z-index:100; pointer-events:none; width:8px; height:15px; top:-20px; animation:fall 2.5s linear forwards; }
        @keyframes shake { 25%{transform:translateX(-7px)} 50%{transform:translateX(7px)} 75%{transform:translateX(-4px)} }
        @keyframes rise { from{opacity:0;transform:translateY(12px)} }
        @keyframes turn { to{transform:rotate(360deg)} }
        @keyframes fall { to{transform:translateY(110vh) rotate(700deg)} }
        @media (max-width:720px) {
            .shell { padding-inline:14px; }
            .topbar { font-size:.66rem; }
            header { padding-top:60px; }
            h1 { font-size:clamp(3.1rem,17vw,5.5rem); }
            .map-wrap { margin-inline:-14px; border-left:0;border-right:0;padding:5px 0; }
            .map { aspect-ratio:1.15; }
            .map img { object-fit:cover; object-position:center; }
            .door { top:20%; height:55%; }
            .door:nth-of-type(1){left:1%;width:17%}.door:nth-of-type(2){left:20%;width:18%}.door:nth-of-type(3){left:40%;width:18%}.door:nth-of-type(4){left:60%;width:18%}.door:nth-of-type(5){left:81%;width:18%}
            .word-strip { grid-template-columns:1fr; margin-top:65px; }
            .word-card { min-height:0; display:grid; grid-template-columns:130px 1fr; align-items:start; }
            .choices { grid-template-columns:1fr 1fr; }
        }
        @media (prefers-reduced-motion:reduce) { *,*::before,*::after { animation-duration:.01ms!important; transition-duration:.01ms!important; scroll-behavior:auto!important; } }
    </style>
</head>
<body>
<main class="shell">
    <nav class="topbar"><a class="back" href="./">← Chloe Reads Jon</a><span class="catalogue">Specimen № 05</span></nav>
    <header>
        <p class="eyebrow">A vocabulary cabinet of curiosities</p>
        <h1>The Museum of<br><i>Five Peculiar Words</i></h1>
        <p class="intro">Five doors. Five scenes. Five exact words waiting to be rescued from that hazy region where you’re certain you’ve seen them before.</p>
    </header>
    <section class="map-wrap" aria-label="Museum map">
        <div class="map">
            <img src="five-word-museum.webp" alt="An illustrated museum corridor with five fantastical doorways">
            <button class="door" data-room="0" aria-label="Open room one"><span>1</span></button>
            <button class="door" data-room="1" aria-label="Open room two"><span>2</span></button>
            <button class="door" data-room="2" aria-label="Open room three"><span>3</span></button>
            <button class="door" data-room="3" aria-label="Open room four"><span>4</span></button>
            <button class="door" data-room="4" aria-label="Open room five"><span>5</span></button>
        </div>
    </section>
    <p class="map-hint" id="hint">Choose any numbered door. The exhibits are best understood from inside.</p>
    <div class="progress" aria-label="Rooms completed"><span class="pip"></span><span class="pip"></span><span class="pip"></span><span class="pip"></span><span class="pip"></span></div>
    <section class="word-strip" aria-label="The five words">
        <div class="word-card"><strong>diaphanous</strong><small>light enough to let the world shimmer through</small></div>
        <div class="word-card"><strong>hermetic</strong><small>sealed against entry, escape, or outside influence</small></div>
        <div class="word-card"><strong>liminal</strong><small>belonging to a threshold or in-between state</small></div>
        <div class="word-card"><strong>sardonic</strong><small>grimly, scornfully, or cynically mocking</small></div>
        <div class="word-card"><strong>fabulist</strong><small>a maker of fables, with facts occasionally left unsupervised</small></div>
    </section>
    <p class="source">This little museum was <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener">inspired by Jon’s “<?= htmlspecialchars($sourceTitle) ?>”</a>.</p>
</main>

<dialog id="roomDialog" aria-labelledby="roomTitle">
    <article class="folio">
        <button class="close" aria-label="Close room">×</button>
        <div id="puzzleView">
            <span class="room-number" id="roomNumber"></span>
            <h2 id="roomTitle"></h2>
            <p class="scene" id="scene"></p>
            <div class="choices" id="choices"></div>
            <div class="reveal" id="reveal">
                <div class="answer"><strong id="answerWord"></strong><em id="pronounce"></em></div>
                <p class="definition" id="definition"></p>
                <p class="memory" id="memory"></p>
                <button class="continue" id="continue">Return to the gallery</button>
            </div>
        </div>
        <div class="victory" id="victory" hidden>
            <span class="victory-mark">✦</span>
            <span class="room-number">The museum records your achievement</span>
            <h2>Keeper of<br>Peculiar Words</h2>
            <p>You opened every door and returned with five excellent words intact. Use one today and cause a small, tasteful amount of alarm.</p>
            <input class="name-line" aria-label="Your name" placeholder="inscribe your name">
            <button class="continue" id="closeVictory">Accept the title</button>
            <button class="reset" id="reset">reset the museum</button>
        </div>
    </article>
</dialog>

<script>
const rooms = [
  {name:'The Veiled Parlour', word:'diaphanous', say:'dye-AF-uh-nus', scene:'The curtains are so finely woven that the morning garden remains visible through them, softened into pale colour and light. Which word belongs on the curator’s card?', definition:'Of such fine texture as to be translucent or nearly transparent.', memory:'Memory hook: dia means “through.” In a diaphanous fabric, light travels through rather than knocking politely.'},
  {name:'The Sealed Archive', word:'hermetic', say:'hur-MET-ik', scene:'No air escapes the brass chamber. No dust enters. Even the archivist’s gossip has been successfully excluded. What is the chamber?', definition:'Completely sealed, especially against the entry or escape of air; also insulated from outside influence.', memory:'Memory hook: imagine secrets sealed by the legendary Hermes Trismegistus. Airtight, watertight, and remarkably poor at parties.'},
  {name:'The Threshold', word:'liminal', say:'LIM-ih-nul', scene:'You stand at a doorway where evening is not quite night, departure is not quite arrival, and the old life has ended before the new one has begun. Name this state.', definition:'Relating to a threshold, boundary, or transitional in-between state.', memory:'Memory hook: limen is Latin for “threshold.” Airports, adolescence, dawn, and the final week before a launch are all liminal territory.'},
  {name:'The Crooked Theatre', word:'sardonic', say:'sar-DON-ik', scene:'The critic watches the hero trip over his own grand entrance and remarks, “At last, a performance with gravity.” His smile is dry, grim, and scornful. Choose its word.', definition:'Scornfully or cynically mocking, often with grim or bitter humour.', memory:'Memory hook: sardonic humour does not giggle. It raises one eyebrow and files a report.'},
  {name:'The Paper Kingdom', word:'fabulist', say:'FAB-yuh-list', scene:'The guide swears she once advised a moonlit king, escaped by paper balloon, and taught a fox to play chess. She may write enchanting fables—or simply treat truth as optional scenery. Who is she?', definition:'A composer or teller of fables; sometimes, a person who invents elaborate falsehoods.', memory:'Memory hook: a fabulist makes fables. Whether you call that literature or lying depends rather heavily on the bookshelf.'}
];
const words = rooms.map(r=>r.word);
const dialog = document.querySelector('#roomDialog');
const done = new Set(JSON.parse(localStorage.getItem('fiveWordMuseumDone') || '[]'));
let current = 0;

function tinyChime(good=true){
  try { const A=window.AudioContext||window.webkitAudioContext, a=new A(), o=a.createOscillator(), g=a.createGain(); o.connect(g);g.connect(a.destination);o.type=good?'sine':'square';o.frequency.value=good?523:155;g.gain.setValueAtTime(.08,a.currentTime);g.gain.exponentialRampToValueAtTime(.001,a.currentTime+.35);o.start();o.stop(a.currentTime+.36); } catch(e){}
}
function update(){
  document.querySelectorAll('.door').forEach((d,i)=>d.classList.toggle('done',done.has(i)));
  document.querySelectorAll('.pip').forEach((p,i)=>p.classList.toggle('on',i<done.size));
  document.querySelector('#hint').textContent = done.size===5 ? 'All five doors are open. The curator has something for you.' : `${done.size} of 5 exhibits identified`;
}
function openRoom(i){
  current=i; const r=rooms[i];
  document.querySelector('#victory').hidden=true; document.querySelector('#puzzleView').hidden=false;
  document.querySelector('#roomNumber').textContent=`Room ${i+1} of 5`;
  document.querySelector('#roomTitle').textContent=r.name;
  document.querySelector('#scene').textContent=r.scene;
  const choices=document.querySelector('#choices'); choices.innerHTML='';
  [...words].sort(()=>Math.random()-.5).forEach(word=>{
    const b=document.createElement('button'); b.className='choice'; b.textContent=word;
    b.onclick=()=>guess(b,word); choices.appendChild(b);
  });
  document.querySelector('#reveal').classList.remove('show');
  document.querySelector('#answerWord').textContent=r.word;
  document.querySelector('#pronounce').textContent=r.say;
  document.querySelector('#definition').textContent=r.definition;
  document.querySelector('#memory').textContent=r.memory;
  dialog.showModal();
}
function guess(button,word){
  if(word===rooms[current].word){
    tinyChime(true); done.add(current); localStorage.setItem('fiveWordMuseumDone',JSON.stringify([...done])); update();
    document.querySelectorAll('.choice').forEach(b=>{b.disabled=true;b.style.opacity=b===button?'1':'.35'});
    button.style.background='var(--ink)';button.style.color='var(--paper)';
    document.querySelector('#reveal').classList.add('show');
  } else { tinyChime(false); button.classList.remove('wrong'); void button.offsetWidth; button.classList.add('wrong'); }
}
function celebrate(){
  document.querySelector('#puzzleView').hidden=true;document.querySelector('#victory').hidden=false;
  for(let i=0;i<42;i++){const c=document.createElement('i');c.className='confetti';c.style.left=Math.random()*100+'vw';c.style.background=['#e9b657','#b94432','#a9d4c8','#f1e4c3'][i%4];c.style.animationDelay=Math.random()*.8+'s';document.body.appendChild(c);setTimeout(()=>c.remove(),3400)}
}
document.querySelectorAll('.door').forEach((d,i)=>d.addEventListener('click',()=>openRoom(i)));
document.querySelector('.close').onclick=()=>dialog.close();
document.querySelector('#continue').onclick=()=>{dialog.close();if(done.size===5)setTimeout(()=>{dialog.showModal();celebrate()},350)};
document.querySelector('#closeVictory').onclick=()=>dialog.close();
document.querySelector('#reset').onclick=()=>{done.clear();localStorage.removeItem('fiveWordMuseumDone');update();dialog.close()};
dialog.addEventListener('click',e=>{if(e.target===dialog)dialog.close()});
update();
</script>
</body>
</html>
