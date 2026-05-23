<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eucharistic Prayer Atlas</title>
  <style>
    :root{
      --ink:#1f1a17;
      --paper:#f7f1e3;
      --leaf:#234234;
      --wine:#7b1e2b;
      --gold:#b88b38;
      --sky:#e8efe9;
      --card:#fffdf8;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      font-family:"Palatino Linotype","Book Antiqua",Palatino,serif;
      color:var(--ink);
      background:
        radial-gradient(circle at 20% -10%, #fff7d8 0%, transparent 35%),
        radial-gradient(circle at 90% 10%, #dce9df 0%, transparent 40%),
        linear-gradient(160deg,var(--paper),#efe6d4);
      min-height:100vh;
    }
    .wrap{max-width:980px;margin:0 auto;padding:24px 16px 56px}
    .hero{
      background:linear-gradient(145deg,rgba(255,255,255,.78),rgba(255,255,255,.56));
      border:1px solid rgba(123,30,43,.18);
      border-radius:24px;
      padding:22px;
      box-shadow:0 16px 36px rgba(48,32,16,.12);
      backdrop-filter: blur(4px);
      animation:rise .6s ease-out;
    }
    @keyframes rise{from{transform:translateY(8px);opacity:.2}to{transform:none;opacity:1}}
    h1{
      margin:0 0 10px;
      font-size:clamp(1.8rem,4.8vw,3rem);
      line-height:1.05;
      letter-spacing:.4px;
      color:var(--wine);
    }
    .subtitle{margin:0;color:#4d433a;line-height:1.45}
    .controls{
      display:grid;
      gap:10px;
      margin-top:16px;
      grid-template-columns:repeat(2,minmax(0,1fr));
    }
    .pill{
      border:1px solid rgba(35,66,52,.3);
      background:var(--card);
      border-radius:999px;
      padding:10px 14px;
      text-align:center;
      font-size:.95rem;
      cursor:pointer;
      transition:all .18s;
    }
    .pill.active,.pill:hover{background:var(--leaf);color:#fff;border-color:var(--leaf);transform:translateY(-1px)}
    .grid{
      margin-top:18px;
      display:grid;
      gap:14px;
      grid-template-columns:repeat(2,minmax(0,1fr));
    }
    .card{
      background:var(--card);
      border:1px solid rgba(31,26,23,.12);
      border-left:7px solid var(--gold);
      border-radius:16px;
      padding:14px 14px 12px;
      box-shadow:0 10px 22px rgba(30,26,20,.08);
    }
    .card h2{margin:0;font-size:1.2rem}
    .meta{margin:6px 0 10px;color:#5f5044;font-size:.9rem}
    .tag{
      display:inline-block;
      font-size:.75rem;
      border:1px solid #d6c49b;
      background:#fff7e7;
      border-radius:999px;
      padding:2px 8px;
      margin-right:6px;
    }
    ul{margin:8px 0 0;padding-left:18px}
    li{margin:5px 0}
    .quiz{
      margin-top:18px;
      background:linear-gradient(130deg,#fff,#f5f8f3);
      border:1px solid rgba(35,66,52,.2);
      border-radius:18px;
      padding:16px;
    }
    .quiz h3{margin:0 0 8px;color:var(--leaf)}
    .scenario{font-size:1rem;line-height:1.4;margin-bottom:10px}
    .answers{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:8px}
    button.answer{
      border:1px solid rgba(35,66,52,.25);
      border-radius:10px;
      padding:10px 12px;
      background:#fff;
      cursor:pointer;
      font:inherit;
    }
    button.answer:hover{background:#f2f8f4}
    .result{margin-top:10px;min-height:2.2em;font-size:.95rem}
    .result.good{color:#185a2f}.result.bad{color:#8b1f2b}
    .foot{margin-top:14px;color:#64574c;font-size:.88rem}
    a{color:#0e5b90}
    @media (max-width:760px){
      .controls,.grid,.answers{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <main class="wrap">
    <section class="hero">
      <h1>Eucharistic Prayer Atlas</h1>
      <p class="subtitle">A fast visual guide to Eucharistic Prayers I-IV: tone, length, and when each one shines. Tap filters, compare the profiles, then try a mini chooser challenge.</p>
      <div class="controls" id="filters"></div>
      <div class="grid" id="cards"></div>
      <section class="quiz">
        <h3>Celebration Scenario Challenge</h3>
        <p class="scenario" id="scenario"></p>
        <div class="answers" id="answers"></div>
        <div class="result" id="result"></div>
      </section>
      <p class="foot">Designed as a learning aid for parishioners and lectors, not a liturgical directive. Final usage is always at the celebrant's discretion.</p>
    </section>
  </main>
  <script>
    const prayers = [
      {id:"I",name:"Eucharistic Prayer I (Roman Canon)",length:"Longest",vibe:"Solemn, ancient, feast-heavy",best:["Major solemnities","High feast days","When a fuller saint intercession is fitting"],features:["Oldest continuous Roman usage","Two commemoration lists of saints","Richly traditional language"],tags:["solemn","ancient","saints"]},
      {id:"II",name:"Eucharistic Prayer II",length:"Shortest",vibe:"Simple, direct, weekday-friendly",best:["Weekday Masses","When brevity helps","Smaller congregations"],features:["Based on early anaphora tradition","Compact structure","Often chosen for ordinary weekdays"],tags:["short","weekday","direct"]},
      {id:"III",name:"Eucharistic Prayer III",length:"Medium",vibe:"Balanced and pastoral",best:["Sundays in Ordinary Time","Most parish settings","When wanting fuller tone than II"],features:["Strong epiclesis language","Clear mission emphasis","Common contemporary default"],tags:["balanced","parish","sunday"]},
      {id:"IV",name:"Eucharistic Prayer IV",length:"Long",vibe:"Salvation-history panorama",best:["Catechetical contexts","When preface is not replaced","Teaching the big story of redemption"],features:["Fixed preface (cannot swap)","Sweeping historical arc","Theological depth"],tags:["history","catechetical","theological"]}
    ];

    const filters = [
      {key:"all",label:"Show All"},
      {key:"short",label:"Quick / Weekday"},
      {key:"solemn",label:"Solemn / High Feast"},
      {key:"catechetical",label:"Teaching Tone"}
    ];

    const scenarios = [
      {prompt:"A typical weekday morning Mass with a small congregation and limited time.",good:"II",why:"EP II is concise and commonly used for weekday celebrations."},
      {prompt:"A major solemnity where the parish wants the fullest, most traditional tone.",good:"I",why:"EP I (Roman Canon) carries the most ancient and solemn profile."},
      {prompt:"A regular parish Sunday where you want balanced depth without extra length.",good:"III",why:"EP III is the reliable middle path used widely on Sundays."},
      {prompt:"A catechetical celebration focusing on salvation history from creation onward.",good:"IV",why:"EP IV is uniquely built as a salvation-history panorama with fixed preface."}
    ];

    const filtersEl = document.getElementById("filters");
    const cardsEl = document.getElementById("cards");
    const scenarioEl = document.getElementById("scenario");
    const answersEl = document.getElementById("answers");
    const resultEl = document.getElementById("result");
    let active = "all";
    let current = scenarios[Math.floor(Math.random()*scenarios.length)];

    function match(p){
      if(active==="all") return true;
      if(active==="short") return p.tags.includes("short") || p.tags.includes("weekday");
      if(active==="solemn") return p.tags.includes("solemn") || p.tags.includes("ancient");
      if(active==="catechetical") return p.tags.includes("catechetical") || p.tags.includes("history");
      return true;
    }

    function renderFilters(){
      filtersEl.innerHTML="";
      filters.forEach(f=>{
        const b=document.createElement("button");
        b.className="pill"+(active===f.key?" active":"");
        b.textContent=f.label;
        b.addEventListener("click",()=>{active=f.key;renderFilters();renderCards();});
        filtersEl.appendChild(b);
      });
    }

    function renderCards(){
      cardsEl.innerHTML="";
      prayers.filter(match).forEach(p=>{
        const c=document.createElement("article");
        c.className="card";
        c.innerHTML=`
          <h2>${p.name}</h2>
          <div class="meta"><span class="tag">${p.length}</span><span class="tag">${p.vibe}</span></div>
          <strong>Best fit:</strong>
          <ul>${p.best.map(i=>"<li>"+i+"</li>").join("")}</ul>
          <strong>Distinctives:</strong>
          <ul>${p.features.map(i=>"<li>"+i+"</li>").join("")}</ul>
        `;
        cardsEl.appendChild(c);
      });
    }

    function renderScenario(){
      scenarioEl.textContent=current.prompt;
      answersEl.innerHTML="";
      ["I","II","III","IV"].forEach(id=>{
        const b=document.createElement("button");
        b.className="answer";
        b.textContent="Pick Prayer "+id;
        b.addEventListener("click",()=>{
          if(id===current.good){
            resultEl.className="result good";
            resultEl.textContent="Nice choice. "+current.why;
          }else{
            resultEl.className="result bad";
            resultEl.textContent="Close, but Prayer "+current.good+" is a better fit here. "+current.why;
          }
          setTimeout(()=>{
            current=scenarios[Math.floor(Math.random()*scenarios.length)];
            resultEl.textContent="";
            resultEl.className="result";
            renderScenario();
          },1800);
        });
        answersEl.appendChild(b);
      });
    }

    renderFilters();
    renderCards();
    renderScenario();
  </script>
</body>
</html>
