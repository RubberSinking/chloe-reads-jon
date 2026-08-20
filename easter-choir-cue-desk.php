<?php
$sourceUrl = 'https://jona.ca/2004/03/easter-choir-notes-raf-different-psalm.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#071627">
<title>Easter Choir Cue Desk</title>
<style>
:root{--ink:#071627;--night:#0b2236;--paper:#f4eddb;--gold:#f2bd62;--coral:#ec735f;--blue:#5598bd;--sage:#91a77d;--white:#fffaf0}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;background:var(--ink);color:var(--paper);font-family:"DM Mono",monospace;overflow-x:hidden}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.13;z-index:20;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.45'/%3E%3C/svg%3E")}
a{color:inherit}.hero{min-height:88svh;display:grid;align-items:end;position:relative;background:linear-gradient(90deg,rgba(4,16,29,.98) 0%,rgba(4,16,29,.78) 34%,rgba(4,16,29,.12) 70%),url('easter-choir-cue-desk.png') 62% center/cover no-repeat;border-bottom:1px solid rgba(242,189,98,.35)}
.hero-inner{width:min(1180px,100%);margin:auto;padding:clamp(28px,6vw,84px);position:relative}.eyebrow{display:flex;align-items:center;gap:12px;color:var(--gold);font-size:.72rem;letter-spacing:.17em;text-transform:uppercase}.eyebrow:before{content:"";width:38px;height:1px;background:currentColor}
h1{font-family:Fraunces,serif;font-size:clamp(3.4rem,9vw,7.5rem);line-height:.82;letter-spacing:-.055em;max-width:760px;margin:.22em 0}.hero p{font-family:Fraunces,serif;font-size:clamp(1.06rem,2vw,1.4rem);line-height:1.48;max-width:540px;color:#d7d4c9}
.start{display:inline-flex;gap:12px;align-items:center;margin-top:18px;padding:15px 20px;border:1px solid var(--gold);background:var(--gold);color:var(--ink);text-decoration:none;font-weight:500;box-shadow:7px 7px 0 var(--coral);transition:.2s}.start:hover{transform:translate(3px,3px);box-shadow:4px 4px 0 var(--coral)}
main{width:min(1120px,100%);margin:auto;padding:clamp(48px,8vw,100px) clamp(18px,4vw,54px)}.intro{display:grid;grid-template-columns:1fr 1.25fr;gap:clamp(30px,7vw,90px);align-items:start;margin-bottom:70px}.kicker{color:var(--coral);font-size:.7rem;letter-spacing:.18em;text-transform:uppercase}.intro h2,.result h2{font-family:Fraunces,serif;font-size:clamp(2.4rem,5vw,4.8rem);line-height:.98;margin:12px 0}.intro-copy{font-family:Fraunces,serif;font-size:1.17rem;line-height:1.65;color:#cfcbc1}.note{border-left:3px solid var(--gold);padding:10px 0 10px 20px;color:#9eadae;font-size:.78rem;line-height:1.7}
.desk{background:var(--paper);color:var(--ink);border-radius:3px;box-shadow:0 28px 80px #02080f;overflow:hidden;position:relative}.desk-head{padding:22px clamp(16px,3vw,30px);display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid #cabfa6;background:#e7ddc7}.desk-head strong{font-family:Fraunces,serif;font-size:1.4rem}.lamps{display:flex;gap:8px}.lamp{width:12px;height:12px;border-radius:50%;background:#aa9e86;box-shadow:inset 0 1px 2px #645c4c}.lamp.live{background:var(--coral);box-shadow:0 0 15px var(--coral)}
.stage{display:grid;grid-template-columns:1.25fr .75fr;min-height:540px}.console{padding:clamp(18px,4vw,42px);border-right:1px solid #cabfa6}.timeline{display:grid;grid-template-columns:repeat(8,1fr);gap:5px;margin:0 0 30px}.tick{height:8px;background:#d3c9b4;transition:.25s}.tick.done{background:var(--sage)}.tick.now{background:var(--coral);transform:scaleY(1.8)}
.cue-card{min-height:220px;background:var(--night);color:var(--white);padding:clamp(22px,5vw,42px);position:relative;overflow:hidden;display:flex;flex-direction:column;justify-content:center}.cue-card:after{content:"";position:absolute;width:180px;height:180px;border:35px solid rgba(242,189,98,.08);border-radius:50%;right:-50px;top:-55px}.counter{position:absolute;top:17px;right:20px;color:#87a2ad;font-size:.72rem}.cue-card small{color:var(--gold);letter-spacing:.16em;text-transform:uppercase}.cue-card h3{font-family:Fraunces,serif;font-size:clamp(2rem,4vw,3.5rem);line-height:1;margin:14px 0 8px}.cue-card p{margin:0;color:#b8c5c5;line-height:1.5;font-size:.82rem}.pulse{animation:pulse .7s ease}@keyframes pulse{50%{background:#173c52}}
.roles{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:16px}.role{border:0;text-align:left;padding:17px;background:#d9cfb9;color:var(--ink);cursor:pointer;font:500 .76rem "DM Mono",monospace;transition:.16s;position:relative}.role span{display:block;font-family:Fraunces,serif;font-size:1.22rem;margin-top:5px}.role:hover,.role:focus-visible{background:var(--gold);transform:translateY(-2px)}.role.correct{background:var(--sage)}.role.wrong{background:var(--coral);animation:shake .3s}@keyframes shake{25%{transform:translateX(-5px)}75%{transform:translateX(5px)}}
.score-panel{background:#d9cfb9;padding:clamp(18px,3vw,30px);display:flex;flex-direction:column}.score-label{font-size:.66rem;text-transform:uppercase;letter-spacing:.15em;color:#746b5c}.score{font:800 clamp(3rem,6vw,5rem)/1 Fraunces,serif;margin:6px 0 22px}.log{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:9px;overflow:auto}.log li{font-size:.69rem;padding-bottom:9px;border-bottom:1px solid #b9ad96;color:#5d584e}.log b{color:var(--ink)}.tip{margin-top:auto;border-top:1px solid #b9ad96;padding-top:16px;font-size:.7rem;line-height:1.55;color:#6f6758}
.result{display:none;padding:clamp(30px,6vw,70px);background:var(--night);color:var(--white);text-align:center}.result.show{display:block}.seal{width:115px;height:115px;margin:auto;border:1px solid var(--gold);border-radius:50%;display:grid;place-items:center;font:800 2.8rem Fraunces;color:var(--gold);box-shadow:0 0 0 8px rgba(242,189,98,.08)}.result p{max-width:600px;margin:15px auto 25px;color:#b7c6c7;line-height:1.65}.again{padding:13px 18px;border:1px solid var(--gold);background:transparent;color:var(--gold);font:500 .75rem "DM Mono";cursor:pointer}
.source{margin:60px auto 0;max-width:740px;text-align:center;color:#85979b;font:1.05rem/1.7 Fraunces,serif}.source a{color:var(--gold);text-decoration-thickness:1px;text-underline-offset:4px}.back{display:inline-block;margin-top:22px;font:500 .7rem "DM Mono";text-transform:uppercase;letter-spacing:.12em}
@media(max-width:720px){.hero{min-height:760px;background:linear-gradient(0deg,rgba(4,16,29,1) 0%,rgba(4,16,29,.75) 50%,rgba(4,16,29,.08) 100%),url('easter-choir-cue-desk.png') 69% top/auto 64% no-repeat}.hero-inner{padding-top:340px}.intro{grid-template-columns:1fr}.stage{grid-template-columns:1fr}.console{border-right:0}.score-panel{min-height:250px}.roles{grid-template-columns:1fr 1fr}.role{padding:14px 11px}.role span{font-size:1rem}.score{font-size:3.5rem}}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;animation:none!important;transition:none!important}}
</style>
</head>
<body>
<header class="hero">
  <div class="hero-inner">
    <div class="eyebrow">Rehearsal room  ·  Easter</div>
    <h1>Choir<br>Cue Desk</h1>
    <p>Four voices. Eight entrances. One attentive conductor. Can you bring the Easter music in at exactly the right moment?</p>
    <a class="start" href="#desk">Take the baton <span aria-hidden="true">↓</span></a>
  </div>
</header>
<main>
  <section class="intro">
    <div><div class="kicker">The assignment</div><h2>Listen with your eyes.</h2></div>
    <div><div class="intro-copy">A choir is a tiny system of trust. Read each liturgical cue, then signal the right musical role: psalmist, cantor, choir, or assembly.</div><p class="note">Tap the correct voice before moving on. The cue desk keeps score, but its chief purpose is to practise noticing who carries the music next.</p></div>
  </section>
  <section class="desk" id="desk" aria-label="Choir cue game">
    <div class="desk-head"><strong>Easter order of service</strong><div class="lamps" aria-hidden="true"><i class="lamp live"></i><i class="lamp"></i><i class="lamp"></i></div></div>
    <div class="stage" id="game">
      <div class="console">
        <div class="timeline" id="timeline" aria-hidden="true"></div>
        <div class="cue-card" id="cueCard"><span class="counter" id="counter"></span><small id="moment"></small><h3 id="cue"></h3><p id="hint"></p></div>
        <div class="roles" id="roles">
          <button class="role" data-role="psalmist">Solo voice<span>Psalmist</span></button>
          <button class="role" data-role="cantor">Leads response<span>Cantor</span></button>
          <button class="role" data-role="choir">Many voices<span>Choir</span></button>
          <button class="role" data-role="assembly">Whole church<span>Assembly</span></button>
        </div>
      </div>
      <aside class="score-panel"><span class="score-label">Attentive entrances</span><div class="score"><span id="score">0</span>/8</div><span class="score-label">Conductor's log</span><ol class="log" id="log"><li>Stand by. The church is quiet.</li></ol><p class="tip">Sound on? Each voice has its own pitch. Correct cues resolve into a tiny major chord.</p></aside>
    </div>
    <div class="result" id="result"><div class="seal" id="seal">8</div><h2 id="resultTitle">Alleluia!</h2><p id="resultCopy"></p><button class="again" id="again">Rehearse once more</button></div>
  </section>
  <div class="source">Inspired by Jon's wonderfully economical <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener">Easter choir notes</a>: “Raf: different psalm. Rocio: memorial acclamation. Cantors: verses.” A whole rehearsal plan in nine words.<br><a class="back" href="index.php">← More things Chloe built</a></div>
</main>
<script>
const cues=[
 {moment:'The readings conclude',cue:'Sing the psalm verses',hint:'One voice proclaims the verses; everyone answers.',role:'psalmist'},
 {moment:'After each psalm verse',cue:'Lead the response',hint:'Give the assembly a clear melodic invitation.',role:'cantor'},
 {moment:'Before the Gospel',cue:'Raise the Alleluia',hint:'The gathered people acclaim Christ together.',role:'assembly'},
 {moment:'At the Gospel procession',cue:'Crown the verse',hint:'A confident solo voice carries the appointed text.',role:'cantor'},
 {moment:'After the words of institution',cue:'Memorial acclamation',hint:'The whole church answers the mystery just proclaimed.',role:'assembly'},
 {moment:'The gifts are prepared',cue:'Begin the Easter anthem',hint:'Several rehearsed parts bloom into harmony.',role:'choir'},
 {moment:'Communion begins',cue:'Carry the refrain',hint:'The ensemble establishes the music while people move.',role:'choir'},
 {moment:'The final blessing is given',cue:'Send everyone out singing',hint:'Every available voice gets the last word.',role:'assembly'}
];
let current=0,points=0,locked=false,audio;
const $=s=>document.querySelector(s), timeline=$('#timeline');
cues.forEach(()=>timeline.insertAdjacentHTML('beforeend','<i class="tick"></i>'));
const tones={psalmist:293.66,cantor:369.99,choir:440,assembly:523.25};
function sound(role,good){try{audio ||= new (window.AudioContext||window.webkitAudioContext)();const now=audio.currentTime;[tones[role],good?tones[role]*1.25:tones[role]*.93].forEach((f,i)=>{const o=audio.createOscillator(),g=audio.createGain();o.type='sine';o.frequency.value=f;g.gain.setValueAtTime(.0001,now+i*.09);g.gain.exponentialRampToValueAtTime(.08,now+i*.09+.02);g.gain.exponentialRampToValueAtTime(.0001,now+i*.09+.25);o.connect(g).connect(audio.destination);o.start(now+i*.09);o.stop(now+i*.09+.28)})}catch(e){}}
function render(){const c=cues[current];$('#counter').textContent=`CUE ${current+1} / ${cues.length}`;$('#moment').textContent=c.moment;$('#cue').textContent=c.cue;$('#hint').textContent=c.hint;document.querySelectorAll('.tick').forEach((x,i)=>x.className='tick '+(i<current?'done':i===current?'now':''));document.querySelectorAll('.role').forEach(b=>b.classList.remove('correct','wrong'));$('#cueCard').classList.remove('pulse');void $('#cueCard').offsetWidth;$('#cueCard').classList.add('pulse')}
function choose(button){if(locked)return;locked=true;const answer=button.dataset.role,c=cues[current],good=answer===c.role;if(good){points++;button.classList.add('correct')}else{button.classList.add('wrong');document.querySelector(`[data-role="${c.role}"]`).classList.add('correct')}sound(c.role,good);$('#score').textContent=points;const li=document.createElement('li');li.innerHTML=`<b>${good?'Clean entrance':'Recovered'}:</b> ${c.role} · ${c.cue}`;$('#log').prepend(li);setTimeout(()=>{current++;locked=false;current<cues.length?render():finish()},760)}
function finish(){document.querySelectorAll('.tick').forEach(x=>x.className='tick done');$('#game').style.display='none';$('#seal').textContent=points;$('#resultTitle').textContent=points===8?'Alleluia!':points>=6?'A confident rehearsal.':'One more pass, maestro.';$('#resultCopy').textContent=points===8?'Every entrance landed. You gave each voice room, then brought the whole church together.':`You placed ${points} of 8 entrances cleanly. The missed cues are already in the conductor’s log, which is precisely what rehearsal is for.`;$('#result').classList.add('show')}
document.querySelectorAll('.role').forEach(b=>b.addEventListener('click',()=>choose(b)));
$('#again').addEventListener('click',()=>{current=0;points=0;locked=false;$('#score').textContent='0';$('#log').innerHTML='<li>Stand by. The church is quiet.</li>';$('#game').style.display='grid';$('#result').classList.remove('show');render()});
render();
</script>
</body>
</html>
