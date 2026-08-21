<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#102f32">
<title>The Council of Influences</title>
<style>
:root{--night:#0d292c;--night2:#173d3d;--paper:#f3e6ca;--paper2:#dccba8;--ink:#29241c;--brass:#d69843;--coral:#d86d50;--sage:#8aa58b;--line:rgba(243,230,202,.2)}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--night);color:var(--paper);font-family:"Iowan Old Style","Palatino Linotype",Palatino,Georgia,serif;min-height:100vh;background-image:radial-gradient(circle at 12% 10%,rgba(216,109,80,.13),transparent 25%),linear-gradient(135deg,rgba(255,255,255,.025) 25%,transparent 25%) ;background-size:auto,7px 7px}button,textarea{font:inherit}a{color:inherit}.wrap{width:min(1180px,calc(100% - 28px));margin:auto}.topbar{display:flex;justify-content:space-between;align-items:center;padding:20px 0;font-family:"Courier New",monospace;font-size:.74rem;font-weight:bold;letter-spacing:.08em;text-transform:uppercase}.back{text-decoration:none;opacity:.78}.back:hover{opacity:1}.issue{display:flex;align-items:center;gap:8px}.issue:before{content:"";width:7px;height:7px;border-radius:50%;background:var(--coral);box-shadow:0 0 12px var(--coral)}
header{position:relative;padding:54px 0 30px;z-index:2}.kicker{font-family:"DM Mono",monospace;color:#e4ad5c;text-transform:uppercase;font-size:.72rem;letter-spacing:.2em;margin:0 0 13px}.hero-title{font-size:clamp(3.25rem,9vw,7.7rem);line-height:.79;letter-spacing:-.055em;margin:0;max-width:930px;font-weight:650}.hero-title em{color:var(--coral);font-weight:500}.lede{font-size:clamp(1.05rem,2vw,1.3rem);line-height:1.55;max-width:610px;color:#d8ccb5;margin:28px 0 0}.scene{position:relative;border:1px solid rgba(214,152,67,.45);border-radius:2px;overflow:hidden;box-shadow:0 32px 80px rgba(0,0,0,.45);margin-top:25px;aspect-ratio:16/9;background:#172f30}.scene img{width:100%;height:100%;display:block;object-fit:cover;filter:saturate(.86) contrast(1.05)}.scene:after{content:"";position:absolute;inset:0;box-shadow:inset 0 0 100px rgba(0,0,0,.38);pointer-events:none}.question-card{position:absolute;z-index:2;left:50%;top:53%;transform:translate(-50%,-50%) rotate(-1deg);width:min(38%,380px);background:rgba(247,231,194,.94);color:var(--ink);padding:16px 20px;box-shadow:0 8px 25px rgba(0,0,0,.35);text-align:center;font-size:clamp(.72rem,1.5vw,1.03rem);line-height:1.35;transition:.35s}.question-card small{display:block;font-family:"DM Mono",monospace;font-size:.58em;letter-spacing:.12em;text-transform:uppercase;color:#78633e;margin-bottom:5px}.scene-caption{position:absolute;z-index:3;bottom:12px;right:14px;font:500 .62rem "DM Mono",monospace;letter-spacing:.07em;text-transform:uppercase;background:rgba(10,27,28,.78);padding:7px 9px}
.workshop{display:grid;grid-template-columns:minmax(0,1.35fr) minmax(330px,.65fr);gap:30px;margin:52px auto 0;align-items:start}.panel{border-top:1px solid var(--line);padding-top:22px}.step{font:500 .7rem "DM Mono",monospace;letter-spacing:.16em;text-transform:uppercase;color:#d5a65d;margin-bottom:9px}.panel h2{font-size:clamp(1.8rem,4vw,2.6rem);line-height:1;margin:0 0 20px}.people{display:grid;grid-template-columns:repeat(2,1fr);gap:10px}.person{position:relative;text-align:left;color:var(--paper);background:rgba(246,231,199,.055);border:1px solid var(--line);padding:15px 14px 14px 54px;min-height:76px;cursor:pointer;transition:.18s;border-radius:1px}.person:hover{transform:translateY(-2px);border-color:rgba(214,152,67,.65)}.person[aria-pressed="true"]{background:var(--paper);color:var(--ink);border-color:var(--paper);box-shadow:5px 5px 0 var(--coral)}.sigil{position:absolute;left:14px;top:15px;width:29px;height:29px;border:1px solid currentColor;border-radius:50%;display:grid;place-items:center;font:500 .7rem "DM Mono",monospace}.person strong{display:block;font-size:1rem;line-height:1.05}.person span:last-child{font:400 .64rem "DM Mono",monospace;opacity:.67;display:block;margin-top:6px;text-transform:uppercase;letter-spacing:.04em}.seats{position:sticky;top:12px;background:var(--paper);color:var(--ink);padding:24px;box-shadow:11px 11px 0 rgba(216,109,80,.7)}.seat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:22px}.seat{border:1px dashed #9f8862;min-height:72px;padding:9px;display:flex;align-items:end;font:500 .66rem "DM Mono",monospace;text-transform:uppercase}.seat.filled{border-style:solid;background:#e0cfaa}.counter{font:500 .63rem "DM Mono",monospace;text-transform:uppercase;letter-spacing:.1em;color:#806944;margin:0 0 8px}textarea{width:100%;min-height:128px;border:1px solid #9f8862;background:#fffaf0;color:var(--ink);padding:14px;resize:vertical;border-radius:0;font-size:1rem;line-height:1.35;outline:none}textarea:focus{border-color:var(--coral);box-shadow:0 0 0 3px rgba(216,109,80,.17)}.prompts{display:flex;gap:6px;flex-wrap:wrap;margin:10px 0 16px}.prompt{font:500 .6rem "DM Mono",monospace;text-transform:uppercase;border:1px solid #9f8862;background:transparent;color:#5c4c35;padding:7px 9px;cursor:pointer}.prompt:hover{background:#e7d5b0}.convene{width:100%;border:0;background:var(--coral);color:#fff8e9;padding:15px;cursor:pointer;font:500 .72rem "DM Mono",monospace;text-transform:uppercase;letter-spacing:.13em;box-shadow:4px 4px 0 #6c3427;transition:.16s}.convene:hover{transform:translate(-2px,-2px);box-shadow:6px 6px 0 #6c3427}.convene:disabled{opacity:.45;cursor:not-allowed;transform:none}
.minutes{display:none;margin:60px auto 0;padding:45px 0 70px;border-top:1px solid var(--line)}.minutes.open{display:block;animation:reveal .55s ease both}@keyframes reveal{from{opacity:0;transform:translateY(18px)}}.minutes-head{display:flex;justify-content:space-between;gap:20px;align-items:end;margin-bottom:23px}.minutes h2{font-size:clamp(2.4rem,6vw,5rem);line-height:.9;margin:0}.folio{font:400 .66rem "DM Mono",monospace;opacity:.7}.counsel-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}.counsel{position:relative;background:var(--paper);color:var(--ink);padding:25px 22px 22px;min-height:255px}.counsel:nth-child(2){transform:translateY(14px);background:#e2d1ad}.counsel:nth-child(3){background:#c8d0b7}.counsel-num{font:500 .62rem "DM Mono",monospace;color:#927044;text-transform:uppercase;letter-spacing:.12em}.counsel h3{font-size:1.55rem;margin:10px 0 4px}.lens{font:500 .62rem "DM Mono",monospace;text-transform:uppercase;opacity:.6}.counsel p{font-size:1.02rem;line-height:1.52;margin:24px 0 0}.synthesis{margin-top:34px;border:1px solid rgba(214,152,67,.55);padding:26px 28px;background:rgba(245,226,188,.05);display:grid;grid-template-columns:140px 1fr;gap:25px}.synthesis h3{font:500 .7rem "DM Mono",monospace;text-transform:uppercase;letter-spacing:.13em;color:#e2ad5d;margin:3px 0}.synthesis p{font-size:clamp(1.25rem,2.8vw,1.8rem);line-height:1.35;margin:0}.actions{display:flex;gap:9px;flex-wrap:wrap;margin-top:20px}.action{border:1px solid var(--line);background:transparent;color:var(--paper);font:500 .63rem "DM Mono",monospace;text-transform:uppercase;padding:10px 12px;cursor:pointer}.action:hover{border-color:var(--brass)}
footer{border-top:1px solid var(--line);padding:27px 0 45px;font-size:.9rem;color:#bdb199;display:flex;justify-content:space-between;gap:18px}.source{color:#efbd71;text-decoration-thickness:1px;text-underline-offset:3px}.toast{position:fixed;bottom:18px;left:50%;transform:translate(-50%,20px);background:#f4e8ce;color:#2d291f;padding:10px 15px;font:500 .65rem "DM Mono",monospace;text-transform:uppercase;opacity:0;pointer-events:none;transition:.25s;z-index:9}.toast.show{opacity:1;transform:translate(-50%,0)}
@media(max-width:780px){.topbar{padding-top:15px}.hero-title{font-size:clamp(3.6rem,18vw,6.3rem)}header{padding-top:35px}.scene{aspect-ratio:4/3}.scene img{object-position:center}.question-card{width:48%;padding:10px;font-size:.7rem}.workshop{grid-template-columns:1fr}.seats{position:static;order:-1}.people{grid-template-columns:1fr 1fr}.counsel-grid{grid-template-columns:1fr}.counsel:nth-child(2){transform:none}.synthesis{grid-template-columns:1fr;gap:8px}.minutes-head{align-items:start;flex-direction:column}footer{flex-direction:column}.scene-caption{display:none}}@media(max-width:450px){.people{grid-template-columns:1fr}.person{min-height:66px}.hero-title{font-size:3.6rem}.scene{width:calc(100% + 28px);margin-left:-14px;border-left:0;border-right:0}.question-card{width:60%;top:55%}.seats{margin:0 -4px}.counsel{min-height:0}}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;animation:none!important;transition:none!important}}
</style>
</head>
<body>
<div class="wrap">
  <nav class="topbar"><a class="back" href="index.php">← Chloe Reads Jon</a><span class="issue">Field note 21 · VIII · 26</span></nav>
  <header>
    <p class="kicker">A cabinet for borrowed wisdom</p>
    <h1 class="hero-title">The Council<br>of <em>Influences</em></h1>
    <p class="lede">Jon named thirteen people who helped shape his life. Seat any three around one question and compare the lenses they bring to the table.</p>
  </header>
  <figure class="scene" aria-label="An illustrated round table surrounded by chairs in a library">
    <img src="council-of-influences-table.png" alt="An empty walnut council table in a lamplit library, with symbolic objects waiting on the chairs">
    <div class="question-card" id="tableQuestion"><small>Question before the council</small>What deserves your attention?</div>
    <figcaption class="scene-caption">Original illustration · Council chamber, dusk</figcaption>
  </figure>

  <main class="workshop">
    <section class="panel" aria-labelledby="chooseTitle">
      <div class="step">Step 01 · Choose three voices</div>
      <h2 id="chooseTitle">Who gets a chair?</h2>
      <div class="people" id="people"></div>
    </section>
    <aside class="seats" aria-labelledby="questionTitle">
      <p class="counter" id="counter">0 of 3 chairs filled</p>
      <div class="seat-row" id="seats" aria-live="polite"></div>
      <div class="step">Step 02 · Bring a question</div>
      <h2 id="questionTitle">Set it on the table.</h2>
      <textarea id="question" maxlength="220" placeholder="How can I make more room for play without neglecting what needs doing?"></textarea>
      <div class="prompts" aria-label="Example questions">
        <button class="prompt" data-prompt="How can I make more room for play without neglecting what needs doing?">Family &amp; time</button>
        <button class="prompt" data-prompt="Should I keep polishing this project, or share it now?">Ship or polish</button>
        <button class="prompt" data-prompt="How should I approach a difficult conversation with someone I love?">Hard talk</button>
      </div>
      <button class="convene" id="convene" disabled>Convene the council</button>
    </aside>
  </main>

  <section class="minutes" id="minutes" aria-live="polite">
    <div class="minutes-head"><div><div class="step">Minutes from the chamber</div><h2>Three lenses.<br>One next move.</h2></div><span class="folio" id="folio"></span></div>
    <div class="counsel-grid" id="counselGrid"></div>
    <div class="synthesis"><h3>The common thread</h3><p id="synthesis"></p></div>
    <div class="actions"><button class="action" id="copy">Copy the minutes</button><button class="action" id="newQuestion">Ask another question</button></div>
  </section>

  <footer><span>This is a playful distillation of ideas, not quotation or impersonation.</span><span>Inspired by Jon’s <a class="source" href="https://jona.ca/2020/03/favourite-authors-and-influences.html">Favourite authors and influences</a>.</span></footer>
</div>
<div class="toast" id="toast">Minutes copied</div>
<script>
const voices=[
 {n:'Kent Beck',s:'KB',l:'small experiments',a:'Make the next move small enough to teach you something. Replace speculation with a safe experiment, then let the result revise the plan.'},
 {n:'Dave Thomas',s:'DT',l:'pragmatic craft',a:'Choose a concrete, reversible step that improves the situation today. Good tools and steady practice beat an elaborate perfect system.'},
 {n:'Marshall Rosenberg',s:'MR',l:'needs & connection',a:'Separate what happened from the story about it. Name the feelings and needs on both sides, then make one clear request rather than a disguised demand.'},
 {n:'Stephen Covey',s:'SC',l:'principles & priorities',a:'Begin with the relationship and outcome you want to preserve. Put the important thing on the calendar before urgent noise occupies every available inch.'},
 {n:'Richard Bolles',s:'RB',l:'possibility & vocation',a:'Look for the meeting point between your gifts, the people you want to help, and a need you can actually test. Talk to a person before constructing a theory.'},
 {n:'Edward Feser',s:'EF',l:'first principles',a:'Define the thing by its purpose, not merely by its symptoms. Once the proper end is clear, the useful means and false shortcuts become easier to distinguish.'},
 {n:'St. Joseph',s:'SJ',l:'quiet fidelity',a:'Protect what has been entrusted to you. Do the next loving duty without needing applause, and allow hidden, ordinary work to be enough for today.'},
 {n:'Fr. Jacques Philippe',s:'JP',l:'peace & freedom',a:'Do not wait for perfect inner weather. Guard peace, consent to what is actually possible now, and take the good step that does not require force or panic.'},
 {n:'John Gottman',s:'JG',l:'repair & friendship',a:'Turn toward the small bid for connection. Soften the opening, stay curious, and make repair early; a warm five minutes can matter more than winning the case.'},
 {n:'Gordon Neufeld',s:'GN',l:'attachment & growth',a:'Secure the relationship before correcting the behaviour. Invite closeness, make room for mixed feelings, and let maturity grow from safety rather than pressure.'},
 {n:'Jane Austen',s:'JA',l:'character & proportion',a:'Examine the first impression with affectionate suspicion. Vanity and certainty make poor counsellors; notice the comic disproportion, then act with sense and generosity.'},
 {n:'St. Francis de Sales',s:'FS',l:'gentleness',a:'Be patient with the unfinished person, especially when that person is you. Begin again calmly; anxious self-scolding consumes energy that could become quiet faithfulness.'},
 {n:'Josef Pieper',s:'JP',l:'leisure & wonder',a:'Not every good must prove its usefulness. Leave a clearing for worship, celebration, contemplation, and delight—the things that reveal what all the work was for.'}
];
let selected=[];
const people=document.querySelector('#people'),seats=document.querySelector('#seats'),counter=document.querySelector('#counter'),question=document.querySelector('#question'),convene=document.querySelector('#convene');
voices.forEach((v,i)=>{const b=document.createElement('button');b.className='person';b.type='button';b.dataset.i=i;b.setAttribute('aria-pressed','false');b.innerHTML=`<span class="sigil">${v.s}</span><strong>${v.n}</strong><span>${v.l}</span>`;b.onclick=()=>toggle(i,b);people.appendChild(b)});
function toggle(i,b){const pos=selected.indexOf(i);if(pos>-1){selected.splice(pos,1);b.setAttribute('aria-pressed','false')}else if(selected.length<3){selected.push(i);b.setAttribute('aria-pressed','true')}else{flash('Only three chairs at this table')};renderSeats()}
function renderSeats(){seats.innerHTML='';for(let i=0;i<3;i++){const d=document.createElement('div');d.className='seat'+(selected[i]!==undefined?' filled':'');d.textContent=selected[i]!==undefined?voices[selected[i]].n:`Chair ${i+1}`;seats.appendChild(d)}counter.textContent=`${selected.length} of 3 chairs filled`;convene.disabled=selected.length!==3||!question.value.trim()}
question.addEventListener('input',()=>{convene.disabled=selected.length!==3||!question.value.trim();document.querySelector('#tableQuestion').innerHTML=`<small>Question before the council</small>${escapeHtml(question.value.trim()||'What deserves your attention?')}`});
document.querySelectorAll('.prompt').forEach(b=>b.onclick=()=>{question.value=b.dataset.prompt;question.dispatchEvent(new Event('input'));question.focus()});
function theme(q){q=q.toLowerCase();if(/child|family|son|parent|play/.test(q))return 'Protect the bond first, then choose one small, repeatable act of presence. A plan that strengthens connection is already doing serious work.';if(/talk|conversation|conflict|argu|love/.test(q))return 'Lower the temperature, get curious about the human need beneath the position, and make one gentle request that leaves the relationship stronger.';if(/project|polish|ship|build|work|code/.test(q))return 'Name the purpose, make the smallest honest version, and put it before reality. Craft grows through contact, not permanent rehearsal.';return 'Clarify the good you are serving, protect peace and relationship, then take one modest action that lets reality answer back.'}
convene.onclick=()=>{const q=question.value.trim();document.querySelector('#counselGrid').innerHTML=selected.map((i,k)=>{const v=voices[i];return `<article class="counsel"><span class="counsel-num">Chair 0${k+1}</span><h3>${v.n}</h3><div class="lens">Lens: ${v.l}</div><p>${v.a}</p></article>`}).join('');document.querySelector('#synthesis').textContent=theme(q);document.querySelector('#folio').textContent=new Date().toLocaleDateString(undefined,{month:'long',day:'numeric',year:'numeric'});const m=document.querySelector('#minutes');m.classList.add('open');setTimeout(()=>m.scrollIntoView({behavior:'smooth',block:'start'}),60);localStorage.setItem('councilQuestion',q)};
document.querySelector('#newQuestion').onclick=()=>{document.querySelector('#minutes').classList.remove('open');question.focus();document.querySelector('.workshop').scrollIntoView({behavior:'smooth'})};
document.querySelector('#copy').onclick=async()=>{const names=selected.map(i=>voices[i].n);const body=`THE COUNCIL OF INFLUENCES\n\nQuestion: ${question.value.trim()}\n\n${selected.map((i,k)=>`${names[k]} — ${voices[i].a}`).join('\n\n')}\n\nCommon thread: ${document.querySelector('#synthesis').textContent}`;try{await navigator.clipboard.writeText(body);flash('Minutes copied')}catch(e){flash('Select and copy from the cards')}};
function flash(t){const e=document.querySelector('#toast');e.textContent=t;e.classList.add('show');setTimeout(()=>e.classList.remove('show'),1800)}function escapeHtml(s){return s.replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]))}
renderSeats();
</script>
</body>
</html>
