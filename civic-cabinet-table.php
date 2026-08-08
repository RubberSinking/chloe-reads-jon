<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#193d35">
<title>The Civic Cabinet Table</title>
<style>
:root{--ink:#17362f;--paper:#f1e8d5;--paper2:#e3d4b7;--red:#bd3d2d;--gold:#e3ad3b;--green:#244f43;--blue:#397b8d;--shadow:#10251f;--white:#fffaf0}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;color:var(--ink);background:#17362f;font-family:Georgia,'Times New Roman',serif;min-height:100vh;overflow-x:hidden}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.25;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='120' height='120' viewBox='0 0 120 120'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.25'/%3E%3C/svg%3E")}
.mast{position:relative;min-height:78vh;display:grid;place-items:center;padding:36px 18px 70px;background:radial-gradient(circle at 50% 42%,#315f50 0,#21483e 38%,#102b25 100%);isolation:isolate}
.mast:after{content:"";position:absolute;inset:auto -10% -90px;width:120%;height:190px;background:var(--paper);transform:rotate(-3deg);z-index:-1;border-top:10px solid var(--gold)}
.seal{width:min(150px,30vw);aspect-ratio:1;border-radius:50%;display:grid;place-items:center;border:3px double #f5cf77;color:#f5cf77;margin:auto;box-shadow:0 0 0 8px #193d35,0 0 0 10px #f5cf77;font:700 3.1rem/1 Georgia;transform:rotate(-6deg)}
.hero{text-align:center;color:var(--white);max-width:850px;animation:arrive .8s ease both}.kicker,.micro{font:700 .72rem/1.4 'Courier New',monospace;letter-spacing:.18em;text-transform:uppercase}.kicker{color:#f5cf77;margin:28px 0 12px}.hero h1{font-size:clamp(3rem,10vw,7.7rem);line-height:.78;letter-spacing:-.07em;margin:0;text-wrap:balance}.hero h1 em{display:block;font-weight:400;color:#f4c65a;font-size:.62em;letter-spacing:-.04em}.hero p{max-width:600px;margin:28px auto 0;font-size:clamp(1rem,2.2vw,1.25rem);line-height:1.65;color:#d8e5d9}.scroll{display:inline-block;margin-top:25px;color:#fff;text-underline-offset:5px}
main{background:var(--paper);padding:65px 18px 90px}.wrap{width:min(1050px,100%);margin:auto}.brief{display:grid;grid-template-columns:1.15fr .85fr;gap:30px;align-items:end;margin-bottom:32px}.brief h2{font-size:clamp(2.3rem,6vw,5rem);line-height:.9;letter-spacing:-.055em;margin:0}.brief p{font-size:1.05rem;line-height:1.65;margin:0;border-left:4px solid var(--red);padding-left:18px}.desk{background:#d6c39e;border:1px solid #ad9670;padding:clamp(14px,3vw,30px);box-shadow:0 22px 0 #aa8e63,0 32px 40px #705d4255;position:relative}.desk:before{content:"CABINET COPY · FOR DELIBERATION";position:absolute;right:17px;top:12px;color:#8e7453;font:700 .61rem 'Courier New',monospace;letter-spacing:.14em}
.topline{display:flex;gap:20px;align-items:center;justify-content:space-between;margin:20px 0}.reserve{background:var(--green);color:white;padding:15px 18px;min-width:155px;box-shadow:5px 5px 0 #102b25}.reserve strong{font-size:2.2rem;color:#ffd36a;display:block;line-height:1}.reserve span{font:700 .66rem 'Courier New',monospace;letter-spacing:.12em}.hint{max-width:530px;line-height:1.45;font-style:italic}.portfolios{display:grid;grid-template-columns:repeat(5,1fr);gap:10px}.portfolio{border:2px solid var(--ink);background:#f5eddc;min-height:260px;display:flex;flex-direction:column;position:relative;transition:.2s transform,.2s box-shadow}.portfolio:hover{transform:translateY(-3px);box-shadow:5px 6px 0 #17362f22}.portfolio:nth-child(2n){transform:rotate(.45deg)}.portfolio:nth-child(3n){transform:rotate(-.5deg)}.folder-tab{color:white;background:var(--ink);padding:12px 9px 9px;min-height:67px}.folder-tab b{display:block;font-size:1rem;line-height:1.05}.folder-tab small{font:400 .62rem/1.2 'Courier New',monospace;opacity:.75}.icon{font-size:1.75rem;float:right;margin-left:3px}.allocation{font-size:3.7rem;text-align:center;font-weight:700;line-height:1;margin:22px 0 5px}.allocation small{font:700 .58rem 'Courier New',monospace;display:block;letter-spacing:.1em}.tokens{height:52px;display:flex;align-content:center;justify-content:center;flex-wrap:wrap;gap:3px;padding:5px}.token{width:16px;height:16px;background:radial-gradient(circle at 35% 30%,#ffe79b,#d79a24 65%,#885b0e);border:1px solid #80581b;border-radius:50%;box-shadow:1px 1px 0 #6e501e}.controls{display:grid;grid-template-columns:1fr 1fr;margin-top:auto}.controls button{border:0;border-top:2px solid var(--ink);padding:13px;background:transparent;color:var(--ink);font:bold 1.35rem Georgia;cursor:pointer}.controls button+button{border-left:2px solid var(--ink)}.controls button:hover,.controls button:focus-visible{background:var(--gold)}
.launch{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-top:28px}.button{border:0;background:var(--red);color:white;padding:16px 22px;font:700 .78rem 'Courier New',monospace;letter-spacing:.09em;text-transform:uppercase;cursor:pointer;box-shadow:5px 5px 0 #72271d;transition:.15s}.button:hover{transform:translate(-2px,-2px);box-shadow:7px 7px 0 #72271d}.button:active{transform:translate(3px,3px);box-shadow:2px 2px 0 #72271d}.button:disabled{filter:grayscale(1);opacity:.45;cursor:not-allowed;transform:none}.balance{font:700 .75rem 'Courier New',monospace}.balance.ok{color:#17623d}.balance.bad{color:#a42f24}
.crisis{display:none;margin-top:75px;scroll-margin-top:20px}.crisis.active{display:block;animation:arrive .55s ease both}.section-label{font:700 .7rem 'Courier New',monospace;letter-spacing:.16em;text-transform:uppercase;color:var(--red)}.crisis-head{display:flex;justify-content:space-between;align-items:end;gap:15px;border-bottom:3px solid var(--ink);padding-bottom:14px;margin-bottom:23px}.crisis h2{font-size:clamp(2.2rem,6vw,4.4rem);letter-spacing:-.04em;line-height:.9;margin:5px 0}.round{font:bold 1rem 'Courier New',monospace}.scenario{background:var(--white);border:2px solid var(--ink);padding:clamp(20px,4vw,42px);position:relative;overflow:hidden}.scenario:after{content:"URGENT";position:absolute;right:-25px;top:22px;transform:rotate(35deg);border:3px solid var(--red);color:var(--red);padding:5px 31px;font:bold .7rem 'Courier New',monospace;letter-spacing:.15em}.scenario h3{font-size:clamp(1.7rem,4vw,3rem);line-height:1;margin:0 55px 10px 0}.scenario>p{font-size:1.08rem;line-height:1.6;max-width:750px}.choices{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:25px}.choice{text-align:left;color:var(--ink);border:2px solid var(--ink);background:var(--paper);padding:17px;min-height:145px;cursor:pointer;font-family:Georgia;transition:.15s}.choice:hover,.choice:focus-visible{background:#ffdb73;transform:rotate(-1deg)}.choice b{display:block;font-size:1.1rem;margin-bottom:7px}.choice span{font-size:.85rem;line-height:1.45}.choice small{display:block;margin-top:12px;font:700 .62rem 'Courier New',monospace;text-transform:uppercase;color:var(--red)}
.result{display:none;margin-top:75px;scroll-margin-top:20px}.result.active{display:block;animation:arrive .7s ease both}.result-card{background:var(--green);color:var(--white);padding:clamp(25px,6vw,65px);position:relative;box-shadow:13px 13px 0 var(--gold)}.result-card:before{content:"FINAL BRIEF";position:absolute;top:16px;right:18px;color:#ecc95c;font:bold .65rem 'Courier New',monospace;letter-spacing:.14em}.result h2{font-size:clamp(2.5rem,7vw,6rem);line-height:.87;letter-spacing:-.055em;color:#f3cf65;margin:11px 0 22px}.result-grid{display:grid;grid-template-columns:.8fr 1.2fr;gap:34px}.chart{aspect-ratio:1;position:relative;border-radius:50%;background:repeating-radial-gradient(circle,transparent 0 16%,#fff2 17% 18%);border:1px solid #ffffff55}.chart svg{width:100%;height:100%;overflow:visible}.chart polygon{fill:#f0bd3c88;stroke:#ffd35d;stroke-width:3;transition:.8s}.chart text{fill:white;font:700 7px 'Courier New',monospace;text-anchor:middle;text-transform:uppercase}.result-copy p{font-size:1.13rem;line-height:1.65}.score-list{display:grid;grid-template-columns:1fr 1fr;gap:8px 18px;margin-top:20px}.score-row{border-top:1px solid #fff5;padding-top:8px}.score-row b{color:#f3cf65}.again{margin-top:28px;background:#f2c658;color:var(--ink);box-shadow:5px 5px 0 #9f7420}.source{margin:70px auto 0;max-width:680px;text-align:center;font-style:italic;line-height:1.6}.source a{color:var(--red);font-weight:bold;text-underline-offset:4px}.note{font-size:.76rem;color:#6f624e;margin-top:14px}
@keyframes arrive{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:none}}@media(max-width:760px){.mast{min-height:680px}.brief{grid-template-columns:1fr}.portfolios{grid-template-columns:1fr 1fr}.portfolio:last-child{grid-column:1/-1}.portfolio{min-height:220px}.choices{grid-template-columns:1fr}.result-grid{grid-template-columns:1fr}.chart{max-width:340px;margin:auto}.launch{align-items:flex-start;flex-direction:column}.desk:before{display:none}}@media(max-width:420px){.portfolios{gap:6px}.folder-tab b{font-size:.88rem}.allocation{font-size:3rem}.desk{padding:9px}.topline{align-items:flex-start;flex-direction:column}.portfolio{min-height:210px}}@media(prefers-reduced-motion:reduce){*{animation:none!important;scroll-behavior:auto!important;transition:none!important}}
</style>
</head>
<body>
<header class="mast">
  <div class="hero">
    <div class="seal" aria-hidden="true">✦</div>
    <div class="kicker">A five-minute common-good experiment</div>
    <h1>The Civic <em>Cabinet Table</em></h1>
    <p>Campaign promises are easy. Governing is choosing what gets attention when everything matters. Place twelve cabinet tokens, face three surprises, and discover your governing instinct.</p>
    <a class="scroll" href="#table">Take your seat ↓</a>
  </div>
</header>
<main>
<div class="wrap">
  <section class="brief" id="table">
    <h2>Your desk.<br>Your tradeoffs.</h2>
    <p>This is not a party quiz. It is a small machine for noticing priorities. There is no perfect budget and no answer key hiding under the blotter.</p>
  </section>
  <section class="desk" aria-labelledby="budgetTitle">
    <div class="topline">
      <div><div class="micro">Opening budget</div><h3 id="budgetTitle">Allocate all 12 attention tokens</h3></div>
      <div class="reserve"><strong id="reserve">2</strong><span>UNASSIGNED</span></div>
    </div>
    <p class="hint">A token is not a dollar. It represents political time, administrative energy, and the willingness to disappoint someone loudly.</p>
    <div class="portfolios" id="portfolios"></div>
    <div class="launch">
      <div><div id="balance" class="balance bad" role="status">Place 2 remaining tokens</div><div class="note">Your choices stay in this browser only, and vanish when you reset.</div></div>
      <button class="button" id="begin" disabled>Seal the budget →</button>
    </div>
  </section>
  <section class="crisis" id="crisis" aria-live="polite">
    <div class="crisis-head"><div><div class="section-label">The situation room</div><h2>Reality phones in.</h2></div><div class="round" id="round">1 / 3</div></div>
    <article class="scenario"><h3 id="scenarioTitle"></h3><p id="scenarioText"></p><div class="choices" id="choices"></div></article>
  </section>
  <section class="result" id="result">
    <div class="result-card">
      <div class="section-label">Your governing instinct</div><h2 id="archetype"></h2>
      <div class="result-grid">
        <div class="chart"><svg viewBox="0 0 100 100" role="img" aria-label="Your priority profile"><polygon id="radar" points="50,50 50,50 50,50 50,50 50,50"></polygon><text x="50" y="7">Care</text><text x="92" y="38">Homes</text><text x="77" y="91">Learning</text><text x="23" y="91">Climate</text><text x="8" y="38">Mobility</text></svg></div>
        <div class="result-copy"><p id="resultText"></p><div class="score-list" id="scoreList"></div><button class="button again" id="again">Return to the cabinet table</button></div>
      </div>
    </div>
  </section>
  <p class="source">This little exercise was inspired by Jon’s <a href="https://jona.ca/2017/04/bc-provincial-election-resources.html">BC Provincial Election resources</a>, a short post pointing undecided voters toward tools for comparing beliefs and platforms.</p>
</div>
</main>
<script>
const portfolios=[
 {id:'care',icon:'✚',name:'Health & Care',note:'clinics · dignity',value:2},
 {id:'homes',icon:'⌂',name:'Homes',note:'shelter · growth',value:2},
 {id:'learning',icon:'✎',name:'Learning',note:'schools · skills',value:2},
 {id:'climate',icon:'❉',name:'Land & Climate',note:'resilience · future',value:2},
 {id:'mobility',icon:'↝',name:'Mobility',note:'roads · transit',value:2}
];
const events=[
 {title:'The river rises early',text:'Atmospheric rain has closed two roads and threatened a low-lying neighbourhood. The forecast says you have 36 hours.',choices:[
  {title:'Protect the neighbourhood',text:'Deploy barriers, shelters, and door-to-door help immediately.',tag:'people first',delta:{care:2,homes:2,climate:1}},
  {title:'Keep the region moving',text:'Secure the bridge, freight route, and emergency detours.',tag:'systems first',delta:{mobility:3,care:1}},
  {title:'Build for the next storm',text:'Accept short-term disruption and fund permanent floodplain work.',tag:'future first',delta:{climate:3,homes:1}}
 ]},
 {title:'The hospital is overflowing',text:'A severe respiratory season collides with staff shortages. Hallway care is becoming the evening news.',choices:[
  {title:'Open temporary capacity',text:'Act fast with short contracts and overflow clinics.',tag:'speed',delta:{care:3,mobility:1}},
  {title:'Keep the workforce',text:'Improve schedules, retention, and training even though relief is slower.',tag:'durability',delta:{care:2,learning:2}},
  {title:'Prevent the next surge',text:'Put resources into primary care, clean air, and community outreach.',tag:'prevention',delta:{care:2,climate:1,homes:1}}
 ]},
 {title:'The young families leave',text:'Teachers, tradespeople, and nurses say housing costs are pushing them away. Employers cannot fill essential jobs.',choices:[
  {title:'Build rapidly',text:'Speed approvals and accept denser neighbourhoods near services.',tag:'supply',delta:{homes:3,mobility:1}},
  {title:'Stabilize households',text:'Target rent support and non-market homes at people under pressure now.',tag:'security',delta:{homes:2,care:2}},
  {title:'Connect cheaper places',text:'Expand fast transit and training beyond the expensive core.',tag:'access',delta:{mobility:2,learning:2}}
 ]}
];
let scores={},eventIndex=0;
const $=s=>document.querySelector(s);
function render(){
 $('#portfolios').innerHTML=portfolios.map((p,i)=>`<article class="portfolio"><div class="folder-tab"><span class="icon" aria-hidden="true">${p.icon}</span><b>${p.name}</b><small>${p.note}</small></div><div class="allocation">${p.value}<small>TOKENS</small></div><div class="tokens">${'<i class="token"></i>'.repeat(p.value)}</div><div class="controls"><button aria-label="Remove one token from ${p.name}" data-i="${i}" data-d="-1">−</button><button aria-label="Add one token to ${p.name}" data-i="${i}" data-d="1">+</button></div></article>`).join('');
 const used=portfolios.reduce((n,p)=>n+p.value,0),left=12-used;$('#reserve').textContent=left;$('#begin').disabled=left!==0;$('#balance').textContent=left===0?'Budget balanced. The clerk looks relieved.':left>0?`Place ${left} remaining token${left===1?'':'s'}`:`Remove ${Math.abs(left)} token${left===-1?'':'s'}`;$('#balance').className='balance '+(left===0?'ok':'bad');
}
$('#portfolios').addEventListener('click',e=>{const b=e.target.closest('button');if(!b)return;const p=portfolios[+b.dataset.i],d=+b.dataset.d,total=portfolios.reduce((n,x)=>n+x.value,0);if(d<0&&p.value>0)p.value--;if(d>0&&total<12)p.value++;render()});
$('#begin').addEventListener('click',()=>{scores=Object.fromEntries(portfolios.map(p=>[p.id,p.value]));eventIndex=0;$('#crisis').classList.add('active');$('#result').classList.remove('active');showEvent();$('#crisis').scrollIntoView({behavior:'smooth'})});
function showEvent(){const ev=events[eventIndex];$('#round').textContent=`${eventIndex+1} / ${events.length}`;$('#scenarioTitle').textContent=ev.title;$('#scenarioText').textContent=ev.text;$('#choices').innerHTML=ev.choices.map((c,i)=>`<button class="choice" data-choice="${i}"><b>${c.title}</b><span>${c.text}</span><small>${c.tag} →</small></button>`).join('')}
$('#choices').addEventListener('click',e=>{const b=e.target.closest('.choice');if(!b)return;const c=events[eventIndex].choices[+b.dataset.choice];Object.entries(c.delta).forEach(([k,v])=>scores[k]+=v);eventIndex++;if(eventIndex<events.length)showEvent();else showResult()});
function showResult(){
 $('#crisis').classList.remove('active');const sorted=portfolios.map(p=>({...p,score:scores[p.id]})).sort((a,b)=>b.score-a.score),top=sorted[0];const profiles={care:['The Steward','You govern close to the human person. Services, dignity, and immediate protection pull hardest on your attention.'],homes:['The Neighbourhood Builder','You look for stability people can stand on: a home, a community, and enough room for ordinary life to take root.'],learning:['The Capacity Gardener','You prefer durable capability over theatrical rescue. Teach, train, and equip people, then let tomorrow become less fragile.'],climate:['The Long-View Custodian','You keep one eye on the emergency and the other on the conditions that created it. Future citizens have a seat at your table.'],mobility:['The Systems Conductor','You notice the connective tissue. When people, goods, and help can move reliably, the whole province breathes easier.']};
 $('#archetype').textContent=profiles[top.id][0];$('#resultText').textContent=profiles[top.id][1]+' Your profile is not a verdict or a party label. It is simply a snapshot of what you protected when tradeoffs became real.';$('#scoreList').innerHTML=sorted.map(p=>`<div class="score-row"><b>${p.score}</b> · ${p.name}</div>`).join('');
 const order=['care','homes','learning','climate','mobility'],angles=[-90,-18,54,126,198],max=Math.max(...Object.values(scores));const points=order.map((k,i)=>{const r=12+30*(scores[k]/max),a=angles[i]*Math.PI/180;return `${50+Math.cos(a)*r},${50+Math.sin(a)*r}`}).join(' ');$('#radar').setAttribute('points',points);$('#result').classList.add('active');$('#result').scrollIntoView({behavior:'smooth'});
}
$('#again').addEventListener('click',()=>{$('#result').classList.remove('active');$('#table').scrollIntoView({behavior:'smooth'})});render();
</script>
</body>
</html>
