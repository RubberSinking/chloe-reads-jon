<?php
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Syllogism Forge</title>
  <style>
    :root{
      --bg:#f6f1e7;
      --ink:#1e1a16;
      --deep:#2f2419;
      --copper:#9f5f2d;
      --gold:#c99b47;
      --sage:#4f6a59;
      --card:#fffaf1;
      --line:#dbc8a8;
      --good:#2f7d52;
      --bad:#a1362a;
      --shadow: 0 18px 45px rgba(60,35,20,.22);
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      color:var(--ink);
      font-family: "Palatino Linotype","Book Antiqua",Palatino,serif;
      background:
        radial-gradient(circle at 12% 18%, rgba(201,155,71,.22), transparent 34%),
        radial-gradient(circle at 88% 72%, rgba(79,106,89,.2), transparent 36%),
        linear-gradient(180deg,#fbf7ef 0%,#efe4d0 100%);
      min-height:100vh;
    }
    .grain::before{
      content:"";
      position:fixed;inset:0;pointer-events:none;opacity:.2;
      background-image: radial-gradient(rgba(20,15,10,.35) .35px, transparent .35px);
      background-size: 3px 3px;
      mix-blend-mode:multiply;
    }
    main{max-width:1000px;margin:0 auto;padding:20px 14px 48px;position:relative;z-index:1}
    .hero{
      border:1px solid var(--line);
      border-radius:20px;
      background:linear-gradient(140deg,rgba(255,250,241,.96),rgba(247,237,219,.96));
      box-shadow:var(--shadow);
      overflow:hidden;
      position:relative;
    }
    .hero:after{
      content:"";
      position:absolute;right:-70px;top:-70px;width:210px;height:210px;border-radius:50%;
      background:radial-gradient(circle,rgba(201,155,71,.35),rgba(201,155,71,0));
    }
    .hero-inner{padding:26px 20px 22px;display:grid;gap:14px}
    h1{
      margin:0;
      font-family: "Baskerville","Times New Roman",serif;
      font-size:clamp(1.9rem,5.2vw,3rem);
      letter-spacing:.02em;
      color:var(--deep);
    }
    .lead{margin:0;font-size:1.04rem;line-height:1.58;max-width:68ch}
    .meta{display:flex;gap:10px;flex-wrap:wrap}
    .pill{
      border:1px solid var(--line);
      background:#fff7e8;
      padding:6px 10px;border-radius:999px;font-size:.82rem;
    }
    .layout{display:grid;grid-template-columns:1fr;gap:16px;margin-top:18px}
    .panel{
      background:var(--card);border:1px solid var(--line);border-radius:16px;padding:14px;
      box-shadow: 0 8px 25px rgba(80,53,30,.12);
    }
    .panel h2{
      margin:0 0 10px;
      font-family:"Baskerville","Times New Roman",serif;
      letter-spacing:.04em;font-size:1.15rem;color:var(--deep);
    }
    .prompt{
      border:1px dashed #c5a983;
      border-radius:12px;
      padding:12px;
      background:#fffbf4;
      margin-bottom:10px;
      line-height:1.45;
    }
    .pattern{
      display:inline-block;margin-top:8px;
      font-family:"Courier New",monospace;
      color:#593a24;background:#f7ecd8;border-radius:8px;padding:4px 8px;font-size:.9rem;
    }
    .choices{display:grid;grid-template-columns:1fr;gap:8px;margin-top:12px}
    button.choice{
      appearance:none;cursor:pointer;text-align:left;padding:11px 12px;
      border:1px solid #c7b08a;border-radius:11px;background:#fff;
      font-family:inherit;font-size:.96rem;
      transition:transform .12s ease, background .2s ease, border-color .2s ease;
    }
    button.choice:hover{transform:translateY(-1px);border-color:var(--copper);background:#fffaf0}
    button.choice.correct{background:#e9f8ef;border-color:#62b288;color:#134f31}
    button.choice.wrong{background:#fdecea;border-color:#d36f62;color:#7e2218}
    .hud{
      display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin:12px 0;
    }
    .hud .metric{
      border:1px solid var(--line);background:#fff7e8;border-radius:10px;padding:8px;
      text-align:center;
    }
    .metric .k{display:block;font-size:.74rem;color:#6b5543}
    .metric .v{font-size:1.16rem;font-weight:700;color:#2f2419}
    .feedback{
      min-height:24px;
      font-weight:700;
      margin:8px 0 0;
    }
    .feedback.good{color:var(--good)}
    .feedback.bad{color:var(--bad)}
    .actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:12px}
    .btn{
      cursor:pointer;border:1px solid #b3946b;background:linear-gradient(180deg,#f8e7c8,#ebcf9d);
      color:#2f2419;border-radius:10px;padding:10px 14px;font-weight:700;
    }
    .btn.secondary{background:#fff8ed}
    .ledger-item{
      border:1px solid #d8c3a0;border-radius:10px;padding:10px;margin-bottom:8px;background:#fffdf9;
      font-size:.92rem;
    }
    .legend{font-size:.88rem;color:#6e5b49;line-height:1.5}
    .footer-note{margin-top:16px;font-size:.85rem;color:#6d5a48}
    @media (min-width:850px){
      .layout{grid-template-columns:1.12fr .88fr}
      .hero-inner{padding:30px 26px}
    }
  </style>
</head>
<body class="grain">
<main>
  <section class="hero">
    <div class="hero-inner">
      <h1>Syllogism Forge</h1>
      <p class="lead">A tiny logic foundry inspired by Jon wrestling with Aristotle. Decode argument forms like <strong>X∉X∈X</strong>, test whether conclusions really follow, and build your own Venn-intuition streak.</p>
      <div class="meta">
        <span class="pill">Mode: Deduction Sprint</span>
        <span class="pill">Theme: Study Hall + Brass Instruments</span>
        <span class="pill">Mobile-Friendly</span>
      </div>
    </div>
  </section>

  <section class="layout">
    <article class="panel">
      <h2>Argument Round</h2>
      <div class="hud">
        <div class="metric"><span class="k">Round</span><span class="v" id="round">1</span></div>
        <div class="metric"><span class="k">Score</span><span class="v" id="score">0</span></div>
        <div class="metric"><span class="k">Streak</span><span class="v" id="streak">0</span></div>
      </div>
      <div class="prompt" id="prompt"></div>
      <div class="choices" id="choices"></div>
      <div class="feedback" id="feedback"></div>
      <div class="actions">
        <button class="btn" id="nextBtn" disabled>Next Round</button>
        <button class="btn secondary" id="restartBtn">Restart</button>
      </div>
      <p class="footer-note">Tip: some options are plausible but invalid. Trust structure, not vibes.</p>
    </article>

    <aside class="panel">
      <h2>Forge Ledger</h2>
      <p class="legend">Pattern key: <strong>∈</strong> means “belongs to all,” <strong>∉</strong> means “belongs to none,” and <strong>∌ some</strong> means “does not belong to some.”</p>
      <div id="ledger"></div>
    </aside>
  </section>
</main>

<script>
const rounds = [
  {
    major: "No C are B.",
    minor: "All B are A.",
    pattern: "C ∉ B, B ∈ A",
    valid: "Therefore, C ∌ some A.",
    decoys: ["Therefore, all C are A.", "Therefore, no A are C.", "Therefore, some A are B."]
  },
  {
    major: "No O are M.",
    minor: "Some M are N.",
    pattern: "O ∉ M, M ∋ N",
    valid: "Therefore, O ∌ some N.",
    decoys: ["Therefore, all N are O.", "Therefore, no N are O.", "Therefore, some O are N."]
  },
  {
    major: "Some R are not S.",
    minor: "All S are P.",
    pattern: "R ∌ S, S ∈ P",
    valid: "Therefore, some P are not R.",
    decoys: ["Therefore, all R are P.", "Therefore, no P are R.", "Therefore, some S are R."]
  },
  {
    major: "All thinkers are readers.",
    minor: "No readers are careless.",
    pattern: "Thinkers ∈ Readers, Readers ∉ Careless",
    valid: "Therefore, no thinkers are careless.",
    decoys: ["Therefore, all careful people are thinkers.", "Therefore, some readers are thinkers.", "Therefore, no careless are readers and all careless are thinkers."]
  },
  {
    major: "No wise people are hasty.",
    minor: "Some students are wise.",
    pattern: "Wise ∉ Hasty, Students ∋ Wise",
    valid: "Therefore, some students are not hasty.",
    decoys: ["Therefore, all students are wise.", "Therefore, no students are hasty.", "Therefore, some hasty people are students."]
  },
  {
    major: "All coders are curious.",
    minor: "Some curious people are musicians.",
    pattern: "Coders ∈ Curious, Curious ∋ Musicians",
    valid: "No strict conclusion follows.",
    decoys: ["Therefore, all musicians are coders.", "Therefore, some coders are musicians.", "Therefore, no musicians are coders."]
  }
];

let state = { score:0, streak:0, round:1, used:new Set(), answered:false };

const el = {
  round: document.getElementById("round"),
  score: document.getElementById("score"),
  streak: document.getElementById("streak"),
  prompt: document.getElementById("prompt"),
  choices: document.getElementById("choices"),
  feedback: document.getElementById("feedback"),
  nextBtn: document.getElementById("nextBtn"),
  restartBtn: document.getElementById("restartBtn"),
  ledger: document.getElementById("ledger")
};

function pickRound(){
  if (state.used.size === rounds.length) state.used.clear();
  const options = rounds.map((_,i)=>i).filter(i=>!state.used.has(i));
  const idx = options[Math.floor(Math.random()*options.length)];
  state.used.add(idx);
  return rounds[idx];
}

let current = null;

function renderRound(){
  state.answered = false;
  el.feedback.textContent = "";
  el.feedback.className = "feedback";
  el.nextBtn.disabled = true;

  current = pickRound();
  const options = [current.valid, ...current.decoys].sort(()=>Math.random()-0.5);

  el.prompt.innerHTML = `
    <div><strong>Premise 1:</strong> ${current.major}</div>
    <div><strong>Premise 2:</strong> ${current.minor}</div>
    <span class="pattern">Pattern: ${current.pattern}</span>
  `;

  el.choices.innerHTML = "";
  options.forEach(text=>{
    const b = document.createElement("button");
    b.className = "choice";
    b.textContent = text;
    b.addEventListener("click", ()=>answer(b,text));
    el.choices.appendChild(b);
  });

  refreshHud();
}

function answer(button, text){
  if (state.answered) return;
  state.answered = true;

  const all = [...el.choices.querySelectorAll("button")];
  const right = text === current.valid;
  if (right){
    button.classList.add("correct");
    state.score += 10 + (state.streak * 2);
    state.streak += 1;
    el.feedback.textContent = "Correct. Aristotle nods in approval.";
    el.feedback.classList.add("good");
  } else {
    button.classList.add("wrong");
    state.streak = 0;
    const trueBtn = all.find(b=>b.textContent === current.valid);
    if (trueBtn) trueBtn.classList.add("correct");
    el.feedback.textContent = "Not quite. The valid form is highlighted.";
    el.feedback.classList.add("bad");
  }

  all.forEach(b=>b.disabled=true);
  addLedger(right, text);
  refreshHud();
  el.nextBtn.disabled = false;
}

function addLedger(right, chosen){
  const card = document.createElement("div");
  card.className = "ledger-item";
  card.innerHTML = `
    <strong>${right ? "Valid hit" : "Missed form"}</strong><br>
    <span>Pattern: ${current.pattern}</span><br>
    <span>Your pick: ${chosen}</span>
  `;
  el.ledger.prepend(card);
}

function refreshHud(){
  el.round.textContent = String(state.round);
  el.score.textContent = String(state.score);
  el.streak.textContent = String(state.streak);
}

el.nextBtn.addEventListener("click", ()=>{
  state.round += 1;
  renderRound();
});

el.restartBtn.addEventListener("click", ()=>{
  state = { score:0, streak:0, round:1, used:new Set(), answered:false };
  el.ledger.innerHTML = "";
  renderRound();
});

renderRound();
</script>
</body>
</html>

