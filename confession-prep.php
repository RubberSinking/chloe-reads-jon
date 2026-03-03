<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination of Conscience</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        :root {
            --bg: #f9f7f4; --card: #ffffff; --border: #e8e3dd; --text: #1a1a1a;
            --muted: #6b6560; --accent: #7a3e2b; --accent-light: #f5ede9;
            --accent-btn: #9b4e38; --gold: #c9963a;
            --yes: #2e7d52; --yes-bg: #edf7f1; --no: #1a4b8a; --no-bg: #eef3fb;
        }
        body { font-family: system-ui, -apple-system, 'Segoe UI', sans-serif; background: var(--bg); color: var(--text); margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; padding: 32px 20px 80px; }
        header { text-align: center; margin-bottom: 36px; }
        .cross { font-size: 2.2em; margin-bottom: 8px; display: block; }
        h1 { font-size: 1.7em; font-weight: 800; color: var(--accent); margin: 0 0 6px; }
        .subtitle { color: var(--muted); font-size: 0.9em; margin: 0; line-height: 1.5; }
        .progress-wrap { margin-bottom: 28px; }
        .progress-labels { display: flex; justify-content: space-between; font-size: 0.78em; color: var(--muted); margin-bottom: 6px; }
        .progress-bar { height: 6px; background: #e8e3dd; border-radius: 99px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, var(--gold), var(--accent)); border-radius: 99px; transition: width 0.5s ease; }
        .section-badge { display: inline-block; background: var(--accent-light); color: var(--accent); font-size: 0.72em; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 3px 10px; border-radius: 99px; margin-bottom: 10px; }
        .section-title { font-size: 1.1em; font-weight: 700; color: var(--accent); margin: 0 0 4px; }
        .section-sub { font-size: 0.85em; color: var(--muted); margin: 0 0 20px; line-height: 1.5; }
        .question-card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 20px; margin-bottom: 12px; transition: border-color 0.2s, background 0.2s; }
        .question-card.ay { border-color: var(--yes); background: var(--yes-bg); }
        .question-card.an { border-color: #c8d9f0; background: var(--no-bg); }
        .question-text { font-size: 0.97em; line-height: 1.55; margin: 0 0 14px; }
        .btn-row { display: flex; gap: 10px; }
        .btn { flex: 1; padding: 10px 12px; border: 2px solid transparent; border-radius: 10px; font-size: 0.88em; font-weight: 600; cursor: pointer; transition: all 0.15s; }
        .btn-y { background: var(--yes-bg); border-color: var(--yes); color: var(--yes); }
        .btn-y.sel, .btn-y:hover { background: var(--yes); color: #fff; }
        .btn-n { background: var(--no-bg); border-color: var(--no); color: var(--no); }
        .btn-n.sel, .btn-n:hover { background: var(--no); color: #fff; }
        .nav-row { display: flex; gap: 12px; margin-top: 28px; }
        .nav-btn { flex: 1; padding: 14px 20px; border: none; border-radius: 12px; font-size: 0.95em; font-weight: 700; cursor: pointer; transition: all 0.15s; }
        .nav-prev { background: #e8e3dd; color: var(--muted); }
        .nav-prev:hover { background: #ddd8d2; }
        .nav-next { background: var(--accent); color: #fff; }
        .nav-next:hover { background: var(--accent-btn); }
        .welcome-card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 28px 22px; text-align: center; margin-bottom: 20px; }
        .welcome-card p { font-size: 0.92em; line-height: 1.65; color: var(--muted); margin: 0 0 16px; }
        .start-btn { display: block; width: 100%; padding: 16px; background: var(--accent); color: #fff; border: none; border-radius: 12px; font-size: 1.05em; font-weight: 700; cursor: pointer; }
        .start-btn:hover { background: var(--accent-btn); }
        .section-count { font-size: 0.8em; color: var(--muted); margin-top: 10px; }
        .summary-card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 24px 20px; margin-bottom: 16px; }
        .summary-card h3 { font-size: 1em; font-weight: 700; color: var(--accent); margin: 0 0 14px; }
        .summary-item { display: flex; align-items: flex-start; gap: 10px; padding: 8px 0; border-bottom: 1px solid var(--border); font-size: 0.88em; line-height: 1.5; }
        .summary-item:last-child { border-bottom: none; }
        .summary-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--yes); margin-top: 6px; flex-shrink: 0; }
        .prayer-box { background: var(--accent-light); border: 1px solid #dcc8c0; border-radius: 12px; padding: 20px; margin-top: 16px; text-align: center; }
        .prayer-box h3 { font-size: 0.9em; font-weight: 700; color: var(--accent); margin: 0 0 12px; text-transform: uppercase; letter-spacing: 0.06em; }
        .prayer-text { font-size: 0.88em; line-height: 1.7; color: #4a3832; font-style: italic; }
        .restart-btn { display: block; width: 100%; margin-top: 20px; padding: 14px; background: var(--accent); color: #fff; border: none; border-radius: 12px; font-size: 0.95em; font-weight: 700; cursor: pointer; }
        .restart-btn:hover { background: var(--accent-btn); }
        .screen { display: none; }
        .screen.active { display: block; }
        .empty-note { color: var(--muted); font-size: 0.88em; font-style: italic; }
    </style>
</head>
<body>
<div class="container">
    <header>
        <span class="cross">✝</span>
        <h1>Examination of Conscience</h1>
        <p class="subtitle">An interactive guide to prepare for Confession</p>
    </header>

    <div id="sw" class="screen active">
        <div class="welcome-card">
            <p>This guide walks you through an examination of conscience, section by section — the Ten Commandments, the precepts of the Church, the works of mercy, and more. Reflect on each question honestly, then review your personalized summary before entering the confessional.</p>
            <p>Your answers stay entirely on this page and are never sent anywhere.</p>
            <button class="start-btn" onclick="startExam()">Begin Examination ✝</button>
            <div class="section-count" id="sec-count"></div>
        </div>
    </div>

    <div id="se" class="screen">
        <div class="progress-wrap">
            <div class="progress-labels"><span id="plabel">Section 1</span><span id="ppct">0%</span></div>
            <div class="progress-bar"><div class="progress-fill" id="pfill" style="width:0%"></div></div>
        </div>
        <div id="sbadge" class="section-badge"></div>
        <div id="stitle" class="section-title"></div>
        <div id="ssub" class="section-sub"></div>
        <div id="qcontainer"></div>
        <div class="nav-row">
            <button class="nav-btn nav-prev" id="bprev" onclick="prevSec()">← Back</button>
            <button class="nav-btn nav-next" id="bnext" onclick="nextSec()">Next →</button>
        </div>
    </div>

    <div id="ss" class="screen">
        <div class="summary-card">
            <h3>✝ Your Summary</h3>
            <div id="sumlist"></div>
        </div>
        <div class="prayer-box">
            <h3>Act of Contrition</h3>
            <div class="prayer-text">
                O my God, I am heartily sorry for having offended Thee,<br>
                and I detest all my sins because of Thy just punishments,<br>
                but most of all because they offend Thee, my God,<br>
                who art all good and deserving of all my love.<br>
                I firmly resolve, with the help of Thy grace,<br>
                to sin no more and to avoid the near occasions of sin. Amen.
            </div>
        </div>
        <button class="restart-btn" onclick="restart()">Start Over</button>
    </div>
</div>

<script>
const S = [
  { badge:"First Commandment", title:"I am the Lord your God — you shall have no other gods before me.", sub:"Faith, hope, and love of God above all things.", qs:[
    "Have I neglected my faith — skipped Mass without good reason, or gone long stretches without prayer?",
    "Have I placed money, work, entertainment, or another person above God in practice?",
    "Have I dabbled in superstition, horoscopes, fortune-telling, or the occult?",
    "Have I despaired of God's mercy, or presumed on it without genuine contrition?",
    "Have I been ashamed of my faith or hidden it when I should have spoken up?"
  ]},
  { badge:"Second Commandment", title:"You shall not take the name of the Lord your God in vain.", sub:"Reverence for God's holy name and sacred things.", qs:[
    "Have I used God's name carelessly, as a swear word, or in anger?",
    "Have I made a solemn vow lightly, or failed to keep a serious promise made to God?",
    "Have I spoken disrespectfully about sacred things, holy persons, or the Church?",
    "Have I cursed others, myself, or sacred things?"
  ]},
  { badge:"Third Commandment", title:"Remember the Sabbath day, to keep it holy.", sub:"Sunday Mass and rest.", qs:[
    "Have I missed Sunday Mass without a serious reason (illness, caring for another, unavoidable work)?",
    "Have I treated Sunday as just another workday, ignoring its spiritual meaning?",
    "Have I received Communion without adequate preparation or while in a state of mortal sin?",
    "Have I failed to observe the Friday penance or other obligations of the Church?"
  ]},
  { badge:"Fourth Commandment", title:"Honour your father and your mother.", sub:"Family duties and respect for authority.", qs:[
    "Have I been disrespectful, harsh, or unloving toward my parents?",
    "Have I neglected my duties as a parent — failed to pray with my children, guide their faith, or give them time and attention?",
    "Have I been unnecessarily disobedient or disrespectful toward legitimate authority?",
    "Have I been a poor citizen — evaded taxes, shirked civic duties, or been indifferent to the common good?"
  ]},
  { badge:"Fifth Commandment", title:"You shall not kill.", sub:"Life, health, and care for others.", qs:[
    "Have I harboured serious hatred, resentment, or a desire for revenge against anyone?",
    "Have I physically harmed or seriously threatened another person?",
    "Have I damaged my health through excessive drinking, substance use, or other self-destructive habits?",
    "Have I failed to forgive someone who wronged me and sincerely asked for forgiveness?"
  ]},
  { badge:"Sixth & Ninth Commandments", title:"You shall not commit adultery. You shall not covet your neighbour's wife.", sub:"Chastity in thought, word, and deed.", qs:[
    "Have I deliberately entertained lustful thoughts or viewed pornography?",
    "Have I been unchaste in my actions, inside or outside of marriage?",
    "Have I been immodest in dress or behaviour, causing scandal to others?",
    "Have I failed to protect my eyes and mind from content that leads to sin?"
  ]},
  { badge:"Seventh & Tenth Commandments", title:"You shall not steal. You shall not covet your neighbour's goods.", sub:"Justice, honesty, and generosity.", qs:[
    "Have I stolen, cheated, or defrauded anyone — through dishonest work, tax evasion, or taking what wasn't mine?",
    "Have I damaged or wasted someone else's property?",
    "Have I failed to make restitution for something I've taken or damaged?",
    "Have I been envious of others' possessions, success, or happiness?",
    "Have I been ungenerous with my time or money toward those in genuine need?"
  ]},
  { badge:"Eighth Commandment", title:"You shall not bear false witness against your neighbour.", sub:"Truth and the good name of others.", qs:[
    "Have I lied deliberately, especially in serious matters?",
    "Have I gossiped, spread rumours, or shared information that damaged someone's reputation unfairly?",
    "Have I failed to defend someone being spoken about unjustly when I could have?",
    "Have I been hypocritical — presenting an image of virtue while living differently in private?",
    "Have I broken confidentiality or betrayed a trust?"
  ]},
  { badge:"Precepts of the Church", title:"The duties of a Catholic.", sub:"Obligations toward the Church and the sacraments.", qs:[
    "Have I gone to Confession at least once a year when aware of mortal sin?",
    "Have I received Communion at least once during the Easter season?",
    "Have I supported the Church financially, to the best of my ability?",
    "Have I observed the required fasts and abstinences (Ash Wednesday, Good Friday, Fridays in Lent)?"
  ]},
  { badge:"Works of Mercy", title:"Loving your neighbour in concrete ways.", sub:"The corporal and spiritual works of mercy.", qs:[
    "Have I ignored someone in genuine need when I could have helped?",
    "Have I failed to visit, comfort, or contact those who are lonely, sick, or grieving?",
    "Have I been patient, kind, and gentle with difficult people in my life?",
    "Have I prayed for others regularly — including those who have hurt me?"
  ]},
  { badge:"Pride and Humility", title:"The root of many sins.", sub:"An honest look at pride, vanity, and self-centredness.", qs:[
    "Have I been vain, boastful, or overly concerned with others' opinions of me?",
    "Have I refused to admit fault or apologize when I was clearly wrong?",
    "Have I judged others harshly while excusing the same faults in myself?",
    "Have I been ungrateful for what God has given me — my faith, my health, my family?",
    "Have I been self-absorbed, rarely thinking of God or others unless it benefited me?"
  ]},
  { badge:"Special Circumstances", title:"Particular responsibilities.", sub:"Questions for specific roles and modern life.", qs:[
    "As a parent: have I modelled faith for my children and made prayer part of family life?",
    "In my work: have I been honest, diligent, and fair to those I work with or lead?",
    "Online: have I posted or shared content that was harmful, divisive, or untrue?",
    "Have I wasted significant time on things of no value, neglecting prayer, family, or duties?",
    "Is there a pattern of sin in my life that I've been quietly avoiding bringing to God?"
  ]}
];

let cur = 0;
let ans = {};

function showScreen(id) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

function startExam() { showScreen('se'); renderSec(); }

function renderSec() {
  const sec = S[cur]; const total = S.length;
  const pct = Math.round((cur / total) * 100);
  document.getElementById('plabel').textContent = 'Section ' + (cur+1) + ' of ' + total;
  document.getElementById('ppct').textContent = pct + '%';
  document.getElementById('pfill').style.width = pct + '%';
  document.getElementById('sbadge').textContent = sec.badge;
  document.getElementById('stitle').textContent = sec.title;
  document.getElementById('ssub').textContent = sec.sub;
  const c = document.getElementById('qcontainer'); c.innerHTML = '';
  sec.qs.forEach((q, qi) => {
    const key = cur + '-' + qi; const a = ans[key];
    const d = document.createElement('div');
    d.className = 'question-card' + (a === 'y' ? ' ay' : a === 'n' ? ' an' : '');
    d.id = 'c' + key;
    d.innerHTML = '<div class="question-text">' + q + '</div><div class="btn-row">' +
      '<button class="btn btn-y' + (a==='y'?' sel':'') + '" onclick="pick(\''+key+'\',\'y\')">✓ Yes, I have</button>' +
      '<button class="btn btn-n' + (a==='n'?' sel':'') + '" onclick="pick(\''+key+'\',\'n\')">✗ Not this one</button>' +
      '</div>';
    c.appendChild(d);
  });
  document.getElementById('bprev').style.visibility = cur === 0 ? 'hidden' : 'visible';
  document.getElementById('bnext').textContent = cur === total-1 ? 'See Summary →' : 'Next →';
}

function pick(key, v) {
  ans[key] = v;
  const card = document.getElementById('c' + key);
  card.className = 'question-card ' + (v === 'y' ? 'ay' : 'an');
  card.querySelectorAll('.btn-y,.btn-n').forEach(b => b.classList.remove('sel'));
  card.querySelector('.btn-' + v).classList.add('sel');
}

function nextSec() {
  if (cur < S.length - 1) { cur++; renderSec(); window.scrollTo({top:0,behavior:'smooth'}); }
  else { showSummary(); }
}

function prevSec() {
  if (cur > 0) { cur--; renderSec(); window.scrollTo({top:0,behavior:'smooth'}); }
}

function showSummary() {
  showScreen('ss'); window.scrollTo({top:0,behavior:'smooth'});
  const list = document.getElementById('sumlist'); list.innerHTML = '';
  let any = false;
  S.forEach((sec, si) => {
    const yeses = sec.qs.filter((q,qi) => ans[si+'-'+qi] === 'y');
    if (!yeses.length) return; any = true;
    const h = document.createElement('div');
    h.style.cssText = 'font-size:0.78em;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:0.06em;padding:10px 0 4px;';
    h.textContent = sec.badge; list.appendChild(h);
    yeses.forEach(q => {
      const item = document.createElement('div'); item.className = 'summary-item';
      item.innerHTML = '<div class="summary-dot"></div><div>' + q + '</div>';
      list.appendChild(item);
    });
  });
  if (!any) list.innerHTML = '<div class="empty-note">You answered "not this one" to every question. Bring that honesty — and an open heart — to Confession. God is waiting with mercy. 🙏</div>';
}

function restart() { cur = 0; ans = {}; showScreen('sw'); window.scrollTo({top:0,behavior:'smooth'}); }

const total = S.reduce((n,s) => n + s.qs.length, 0);
document.getElementById('sec-count').textContent = S.length + ' sections · ' + total + ' questions';
</script>
</body>
</html>
