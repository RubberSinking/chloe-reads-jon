<?php
$built = '2026-09-10';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#e9692c">
<title>The Orange Sign Society</title>
<style>
:root{
  --ink:#241b16;--paper:#f6edd8;--orange:#e9692c;--teal:#1d6966;
  --mustard:#e0ad42;--cream:#fff8e8;--coffee:#4a2c20;--shadow:#1d1714;
}
*{box-sizing:border-box}
html{scroll-behavior:smooth}
body{
  margin:0;color:var(--ink);background:var(--paper);
  font-family:Georgia,"Times New Roman",serif;overflow-x:hidden;
  background-image:radial-gradient(#9a734b22 1px,transparent 1px);
  background-size:7px 7px;
}
button,input,select{font:inherit}
button,a,input,select{touch-action:manipulation}
a{color:inherit}
.skip{position:absolute;left:-999px}.skip:focus{left:1rem;top:1rem;background:white;padding:.7rem;z-index:50}
.hero{
  min-height:76svh;position:relative;isolation:isolate;color:var(--cream);
  display:flex;align-items:flex-end;padding:clamp(1.2rem,5vw,5rem);
  background-image:linear-gradient(90deg,#1c1714f2 0%,#1c1714bc 38%,#1c17141a 72%),url("orange-sign-society-hero.webp");
  background-size:cover;background-position:center;
  border-bottom:12px solid var(--orange);
}
.hero:after{content:"";position:absolute;inset:0;z-index:-1;opacity:.32;pointer-events:none;
  background:repeating-linear-gradient(0deg,transparent 0 3px,#fff 4px)}
.mast{max-width:680px;animation:arrive .8s cubic-bezier(.2,.75,.2,1) both}
.kicker,.label,.counter,.eyebrow{font-family:"Courier New",monospace;text-transform:uppercase;letter-spacing:.14em;font-weight:bold}
.kicker{display:inline-block;background:var(--orange);padding:.45rem .7rem;transform:rotate(-1.5deg);box-shadow:5px 5px 0 #111}
h1{font-size:clamp(3.3rem,11vw,8.6rem);line-height:.76;letter-spacing:-.075em;margin:.45em 0 .18em;text-wrap:balance;text-shadow:6px 6px 0 #1d1714}
.hero p{font-size:clamp(1rem,2.3vw,1.35rem);line-height:1.55;max-width:560px}
.hero-links{display:flex;gap:.8rem;flex-wrap:wrap;margin-top:1.5rem}
.hero-links a{font-family:"Courier New",monospace;font-weight:bold;text-decoration:none;border:2px solid var(--cream);padding:.7rem 1rem;box-shadow:4px 4px 0 var(--cream)}
.hero-links a:hover,.hero-links a:focus{background:var(--cream);color:var(--ink);transform:translate(2px,2px);box-shadow:2px 2px 0 var(--cream)}
main{max-width:1220px;margin:auto;padding:clamp(2rem,6vw,6rem) clamp(1rem,4vw,3rem)}
.intro{display:grid;grid-template-columns:.7fr 1.3fr;gap:clamp(2rem,8vw,8rem);align-items:start;margin-bottom:5rem}
.intro h2,.section-head h2{font-size:clamp(2.5rem,6vw,5rem);line-height:.9;letter-spacing:-.055em;margin:0}
.intro p{font-size:1.18rem;line-height:1.7;margin:0}
.dropcap:first-letter{float:left;font-size:4.5rem;line-height:.78;margin:.13em .12em 0 0;color:var(--orange);font-weight:bold}
.workshop{display:grid;grid-template-columns:minmax(270px,.72fr) minmax(0,1.28fr);gap:1.4rem;align-items:stretch}
.panel{background:#fffaf0;border:2px solid var(--ink);box-shadow:8px 8px 0 var(--ink);padding:clamp(1.1rem,3vw,2rem)}
.panel h2{font-size:1.9rem;margin:.15rem 0 1.4rem}
.field{display:block;margin:0 0 1.15rem}
.field span{display:block;font-family:"Courier New",monospace;text-transform:uppercase;letter-spacing:.09em;font-size:.75rem;font-weight:bold;margin-bottom:.42rem}
input[type=text],select{width:100%;border:2px solid var(--ink);background:white;padding:.8rem;border-radius:0;outline:none}
input:focus,select:focus{box-shadow:0 0 0 4px var(--mustard)}
.swatches{display:flex;gap:.6rem;flex-wrap:wrap}
.swatch{width:42px;height:42px;border:2px solid var(--ink);cursor:pointer;box-shadow:3px 3px 0 var(--ink);position:relative}
.swatch[aria-pressed=true]:after{content:"✓";position:absolute;inset:0;display:grid;place-items:center;font:bold 1.4rem Georgia;color:white;text-shadow:1px 1px 0 #000}
.button-row{display:flex;gap:.7rem;flex-wrap:wrap;margin-top:1.5rem}
.btn{border:2px solid var(--ink);padding:.76rem 1rem;background:var(--mustard);font-family:"Courier New",monospace;font-weight:bold;text-transform:uppercase;letter-spacing:.04em;cursor:pointer;box-shadow:4px 4px 0 var(--ink)}
.btn:hover,.btn:focus{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--ink)}
.btn.dark{background:var(--ink);color:white}.btn.ghost{background:white}
.preview-wrap{min-height:560px;background:var(--teal);position:relative;overflow:hidden;padding:clamp(1.2rem,4vw,3rem);display:grid;place-items:center;border:2px solid var(--ink);box-shadow:8px 8px 0 var(--ink)}
.preview-wrap:before{content:"";position:absolute;inset:0;opacity:.22;background:repeating-linear-gradient(20deg,transparent 0 18px,#fff 19px 20px)}
.sign{width:min(100%,680px);aspect-ratio:1.42;background:var(--sign,#e9692c);color:var(--signInk,#fff8e8);padding:clamp(1.2rem,5vw,3rem);display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;position:relative;transform:rotate(-1.2deg);box-shadow:14px 16px 0 #211712;border:5px solid currentColor;outline:3px dashed #211712;outline-offset:7px}
.sign:before,.sign:after{content:"";position:absolute;width:46px;height:20px;background:#f4db9dc7;top:-13px;transform:rotate(-7deg)}
.sign:before{left:10%}.sign:after{right:10%;transform:rotate(8deg)}
.sign-icon{font-size:clamp(2rem,6vw,4.3rem);line-height:1}
.sign-main{font-family:Impact,Haettenschweiler,"Franklin Gothic Condensed",sans-serif;font-size:clamp(2.8rem,9vw,7.2rem);line-height:.85;letter-spacing:-.04em;text-transform:uppercase;overflow-wrap:anywhere;text-shadow:3px 3px 0 #211712;margin:.08em 0}
.sign-sub{font-family:"Courier New",monospace;font-weight:bold;font-size:clamp(.75rem,2vw,1.2rem);text-transform:uppercase;letter-spacing:.12em;background:var(--signInk,#fff8e8);color:var(--sign,#e9692c);padding:.45em .7em;max-width:90%}
.sign-city{position:absolute;bottom:.7rem;right:1rem;font-family:"Courier New",monospace;font-size:.7rem;text-transform:uppercase;letter-spacing:.1em}
.society{margin-top:7rem}
.section-head{display:flex;justify-content:space-between;gap:2rem;align-items:end;border-bottom:3px solid var(--ink);padding-bottom:1.4rem;margin-bottom:2rem}
.counter{background:var(--teal);color:white;padding:.5rem .75rem;white-space:nowrap}
.club-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:1.5rem}
.card-deck{min-height:380px;position:relative;display:grid;place-items:center;padding:2rem;background:var(--coffee);border:2px solid var(--ink);overflow:hidden}
.card-deck:before{content:"";position:absolute;inset:0;background:radial-gradient(circle at 30% 30%,#ffffff17,transparent 35%)}
.prompt-card{width:min(100%,560px);min-height:260px;background:var(--cream);border:2px solid var(--ink);box-shadow:9px 10px 0 var(--orange);padding:clamp(1.4rem,5vw,3rem);position:relative;display:flex;flex-direction:column;justify-content:space-between;transform:rotate(-1deg)}
.prompt-card.deal{animation:deal .42s cubic-bezier(.1,.75,.2,1)}
.card-no{font-family:"Courier New",monospace;font-size:.75rem;letter-spacing:.15em;text-transform:uppercase}
.prompt{font-size:clamp(1.65rem,4.4vw,3rem);line-height:1.08;letter-spacing:-.035em;margin:1rem 0}
.card-foot{display:flex;justify-content:space-between;gap:1rem;align-items:end;font-family:"Courier New",monospace;font-size:.72rem;text-transform:uppercase}
.tally{background:var(--mustard);border:2px solid var(--ink);box-shadow:8px 8px 0 var(--ink);padding:2rem;display:flex;flex-direction:column;justify-content:space-between}
.tally h3{font-size:2rem;margin:0}.cups{display:flex;align-items:flex-end;flex-wrap:wrap;min-height:150px;margin:1rem 0;gap:.4rem}
.cup{width:38px;height:30px;border:3px solid var(--coffee);border-top:0;border-radius:0 0 8px 8px;position:relative;animation:pop .25s both}
.cup:after{content:"";position:absolute;width:12px;height:14px;border:3px solid var(--coffee);border-left:0;right:-15px;top:4px;border-radius:0 8px 8px 0}
.tally .big{font-size:4rem;line-height:1;margin:.2rem 0;font-weight:bold}
.note{font-family:"Courier New",monospace;font-size:.78rem;line-height:1.5}
.source{margin:6rem auto 1rem;max-width:800px;padding:2.2rem;border-left:9px solid var(--orange);background:#fffaf0;font-size:1.12rem;line-height:1.65;box-shadow:8px 8px 0 #dbcdb0}
.source a{font-weight:bold;text-decoration-thickness:2px;text-underline-offset:4px}
footer{text-align:center;padding:2rem;font-family:"Courier New",monospace;font-size:.75rem;text-transform:uppercase;letter-spacing:.08em}
.toast{position:fixed;left:50%;bottom:1rem;z-index:20;transform:translate(-50%,140%);transition:.25s;background:var(--ink);color:white;padding:.9rem 1.2rem;font-family:"Courier New",monospace;box-shadow:4px 4px 0 var(--orange)}
.toast.show{transform:translate(-50%,0)}
@keyframes arrive{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:none}}
@keyframes deal{from{opacity:0;transform:translateX(60%) rotate(10deg)}to{opacity:1;transform:rotate(-1deg)}}
@keyframes pop{from{opacity:0;transform:scale(.2)}to{opacity:1;transform:none}}
@media(max-width:820px){
  .intro,.workshop,.club-grid{grid-template-columns:1fr}
  .hero{min-height:68svh;background-position:64% center}
  .preview-wrap{min-height:420px}.section-head{align-items:start;flex-direction:column}
}
@media(max-width:520px){
  .hero{padding-bottom:2rem}.hero p{max-width:88%}.panel{box-shadow:5px 5px 0 var(--ink)}
  .preview-wrap{min-height:350px;padding:1rem}.sign{aspect-ratio:1.2}
  .sign-main{font-size:clamp(2.4rem,15vw,4.4rem)}.source{margin-top:4rem;padding:1.4rem}
}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important;scroll-behavior:auto!important}}
@media print{
  body *{visibility:hidden}.preview-wrap,.preview-wrap *{visibility:visible}
  .preview-wrap{position:absolute;inset:0;width:100%;height:100%;border:0;box-shadow:none;background:white}
  .sign{width:85%;box-shadow:none}
}
</style>
</head>
<body>
<a class="skip" href="#workshop">Skip to sign workshop</a>
<header class="hero">
  <div class="mast">
    <span class="kicker">Victoria · webloggers · 2005-ish</span>
    <h1>The Orange<br>Sign Society</h1>
    <p>Make the gloriously oversized table sign. Draw one actually-good conversation starter. Then go be the friendly, unintimidating person somebody hoped would show up.</p>
    <div class="hero-links">
      <a href="#workshop">Make a sign ↓</a>
      <a href="index.php">← All experiments</a>
    </div>
  </div>
</header>

<main>
  <section class="intro" aria-labelledby="why">
    <h2 id="why">A tiny machine for showing up.</h2>
    <p class="dropcap">In 2005, Jon organized a Victoria weblogger meetup and worried he might end up alone beneath a big orange Blogger sign, reading T. S. Eliot over a caramel macchiato. That is both very funny and unexpectedly brave. This workshop celebrates the useful magic of making yourself findable.</p>
  </section>

  <section class="workshop" id="workshop" aria-label="Sign workshop">
    <form class="panel" onsubmit="return false">
      <span class="eyebrow">Workshop 01</span>
      <h2>Paint the beacon</h2>
      <label class="field"><span>Big words</span><input id="mainText" type="text" maxlength="18" value="WEBLOGGERS" autocomplete="off"></label>
      <label class="field"><span>Small invitation</span><input id="subText" type="text" maxlength="42" value="Friendly humans & peculiar ideas welcome" autocomplete="off"></label>
      <label class="field"><span>Meeting place</span><input id="cityText" type="text" maxlength="28" value="Victoria · table by the window" autocomplete="off"></label>
      <label class="field"><span>Tabletop mascot</span>
        <select id="icon">
          <option value="✦">Four-point spark</option><option value="☕">Coffee cup</option>
          <option value="⌁">Tiny wave</option><option value="✎">Pencil</option><option value="◉">Old web orb</option>
        </select>
      </label>
      <div class="field"><span>Poster ink</span><div class="swatches" id="swatches">
        <button class="swatch" type="button" style="background:#e9692c" data-bg="#e9692c" data-ink="#fff8e8" aria-label="Orange" aria-pressed="true"></button>
        <button class="swatch" type="button" style="background:#1d6966" data-bg="#1d6966" data-ink="#fff8e8" aria-label="Teal" aria-pressed="false"></button>
        <button class="swatch" type="button" style="background:#e0ad42" data-bg="#e0ad42" data-ink="#241b16" aria-label="Mustard" aria-pressed="false"></button>
        <button class="swatch" type="button" style="background:#4a2c20" data-bg="#4a2c20" data-ink="#fff8e8" aria-label="Coffee" aria-pressed="false"></button>
      </div></div>
      <div class="button-row">
        <button class="btn dark" id="shuffle" type="button">Surprise me</button>
        <button class="btn" id="download" type="button">Save PNG</button>
        <button class="btn ghost" onclick="window.print()" type="button">Print</button>
      </div>
    </form>
    <div class="preview-wrap" aria-label="Live sign preview">
      <article class="sign" id="sign">
        <div class="sign-icon" id="signIcon">✦</div>
        <div class="sign-main" id="signMain">WEBLOGGERS</div>
        <div class="sign-sub" id="signSub">Friendly humans &amp; peculiar ideas welcome</div>
        <div class="sign-city" id="signCity">Victoria · table by the window</div>
      </article>
    </div>
  </section>

  <section class="society" aria-labelledby="deckTitle">
    <div class="section-head">
      <div><span class="eyebrow">Workshop 02</span><h2 id="deckTitle">Deal past small talk.</h2></div>
      <div class="counter" id="cardCounter">Card 01 / 24</div>
    </div>
    <div class="club-grid">
      <div class="card-deck">
        <article class="prompt-card" id="promptCard" aria-live="polite">
          <span class="card-no" id="category">A question for the table</span>
          <p class="prompt" id="prompt">What tiny tool has quietly made your life better?</p>
          <div class="card-foot"><span>The Orange Sign Society</span><span>Ask · listen · follow the odd detail</span></div>
        </article>
        <button class="btn" id="deal" type="button" style="position:absolute;right:1rem;bottom:1rem">Deal another →</button>
      </div>
      <aside class="tally">
        <div><span class="eyebrow">Attendance ledger</span><h3>Humans encountered</h3><div class="big" id="count">0</div></div>
        <div class="cups" id="cups" aria-hidden="true"></div>
        <div><button class="btn dark" id="met" type="button">+ Met someone</button><p class="note">Saved only in this browser. No social network, growth funnel, or mysterious pivot to enterprise.</p></div>
      </aside>
    </div>
  </section>

  <aside class="source">
    This experiment was inspired by Jon’s delightfully vulnerable post
    <a href="https://jona.ca/2005/02/ok-i-have-posted-photo-for-victoria.html">“OK I have posted a photo for the Victoria Webloggers”</a>,
    especially the planned giant orange sign and the hope that the people beneath it would look friendly and unintimidating.
  </aside>
</main>
<footer>Built for the pleasant risk of saying hello · <?php echo htmlspecialchars($built); ?></footer>
<div class="toast" id="toast" role="status"></div>
<script>
const $=s=>document.querySelector(s);
const sign=$("#sign"), main=$("#mainText"), sub=$("#subText"), city=$("#cityText"), icon=$("#icon");
function update(){
  $("#signMain").textContent=main.value||"HELLO";
  $("#signSub").textContent=sub.value||"Pull up a chair";
  $("#signCity").textContent=city.value||"Table by the window";
  $("#signIcon").textContent=icon.value;
  save();
}
[main,sub,city,icon].forEach(el=>el.addEventListener("input",update));
$("#swatches").addEventListener("click",e=>{
  const b=e.target.closest(".swatch");if(!b)return;
  document.querySelectorAll(".swatch").forEach(x=>x.setAttribute("aria-pressed",x===b));
  sign.style.setProperty("--sign",b.dataset.bg);sign.style.setProperty("--signInk",b.dataset.ink);save();
});
const surprises=[
 ["IDEA PEOPLE","Bring one marvellous thing you found","Victoria · big orange sign","✦"],
 ["BLOG CLUB","No follower count required","Coffee shop · suspiciously large table","☕"],
 ["ODD MINDS","Tell us what you cannot stop making","Rainy window · warm drinks","✎"],
 ["HELLO, WEB","Lurkers, tinkerers & kind critics welcome","Find the impossible-to-miss sign","◉"]
];
$("#shuffle").addEventListener("click",()=>{
 const x=surprises[Math.floor(Math.random()*surprises.length)];
 [main.value,sub.value,city.value,icon.value]=x;update();say("Fresh paint, figuratively.");
});
function save(){
 const active=document.querySelector(".swatch[aria-pressed=true]");
 localStorage.setItem("orangeSign",JSON.stringify({main:main.value,sub:sub.value,city:city.value,icon:icon.value,bg:active?.dataset.bg,ink:active?.dataset.ink}));
}
function load(){
 try{const d=JSON.parse(localStorage.getItem("orangeSign"));if(!d)return;
 main.value=d.main;sub.value=d.sub;city.value=d.city;icon.value=d.icon;update();
 const b=[...document.querySelectorAll(".swatch")].find(x=>x.dataset.bg===d.bg);if(b)b.click();
 }catch(e){}
}
function say(msg){const t=$("#toast");t.textContent=msg;t.classList.add("show");clearTimeout(say.t);say.t=setTimeout(()=>t.classList.remove("show"),2200)}
$("#download").addEventListener("click",()=>{
 const canvas=document.createElement("canvas"),ctx=canvas.getContext("2d");canvas.width=1400;canvas.height=980;
 const cs=getComputedStyle(sign),bg=cs.getPropertyValue("--sign").trim()||"#e9692c",ink=cs.getPropertyValue("--signInk").trim()||"#fff8e8";
 ctx.fillStyle="#f6edd8";ctx.fillRect(0,0,1400,980);ctx.fillStyle=bg;ctx.fillRect(70,70,1260,840);
 ctx.strokeStyle=ink;ctx.lineWidth=12;ctx.strokeRect(92,92,1216,796);ctx.textAlign="center";ctx.fillStyle=ink;
 ctx.font="900 58px Georgia";ctx.fillText(icon.value,700,245);
 let size=156;ctx.font="900 "+size+"px Impact, sans-serif";while(ctx.measureText((main.value||"HELLO").toUpperCase()).width>1120&&size>64){size-=6;ctx.font="900 "+size+"px Impact, sans-serif"}
 ctx.fillText((main.value||"HELLO").toUpperCase(),700,490);
 ctx.fillStyle=ink;ctx.fillRect(250,565,900,86);ctx.fillStyle=bg;ctx.font="bold 30px Courier New";ctx.fillText((sub.value||"Pull up a chair").toUpperCase().slice(0,42),700,620);
 ctx.fillStyle=ink;ctx.textAlign="right";ctx.font="bold 23px Courier New";ctx.fillText((city.value||"Table by the window").toUpperCase(),1260,840);
 const a=document.createElement("a");a.download="orange-sign-society.png";a.href=canvas.toDataURL("image/png");a.click();say("Poster saved. Find a table.");
});
const prompts=[
 ["Tool lore","What tiny tool has quietly made your life better?"],
 ["Internet archaeology","Which vanished website do you still miss?"],
 ["Make something","What would you build this weekend if the awkward first hour were already done?"],
 ["Delight","What is a strangely specific thing you know far too much about?"],
 ["Old web","What did your first personal homepage look like? Be honest."],
 ["Curiosity","What have you changed your mind about recently?"],
 ["Small rebellion","Which supposedly essential app could you happily delete?"],
 ["Recommendation","What is the best thing you discovered through another person’s enthusiasm?"],
 ["Craft","Which detail do you obsess over that most people never notice?"],
 ["Family lore","What ordinary family ritual deserves its own documentary?"],
 ["Software","Which feature makes a piece of software feel generous?"],
 ["Wonder","What fact reliably makes the universe feel larger?"],
 ["Books","Which book do you wish you could hand to your younger self?"],
 ["Repair","What broken thing have you fixed in an unreasonable but satisfying way?"],
 ["Place","Where can you sit for an hour and leave more human?"],
 ["Design","What everyday object is much better designed than it needs to be?"],
 ["Courage","What gathering were you glad you almost did not attend?"],
 ["Nostalgia","Which obsolete gadget would you resurrect with one modern upgrade?"],
 ["Play","What game reveals the most about the people playing it?"],
 ["Attention","What deserves more careful looking than we usually give it?"],
 ["Odd project","What is the most delightfully unnecessary thing you have made?"],
 ["Hospitality","What makes a stranger feel welcome at a table?"],
 ["Learning","What subject finally clicked because one person explained it differently?"],
 ["Next chapter","What is one small invitation you would actually say yes to?"]
];
let current=0;
$("#deal").addEventListener("click",()=>{
 let next;do{next=Math.floor(Math.random()*prompts.length)}while(next===current);current=next;
 const card=$("#promptCard");card.classList.remove("deal");void card.offsetWidth;card.classList.add("deal");
 $("#category").textContent=prompts[current][0];$("#prompt").textContent=prompts[current][1];
 $("#cardCounter").textContent="Card "+String(current+1).padStart(2,"0")+" / "+prompts.length;
});
let people=Number(localStorage.getItem("orangePeople")||0);
function renderPeople(){
 $("#count").textContent=people;$("#cups").innerHTML="";
 for(let i=0;i<Math.min(people,24);i++){const c=document.createElement("span");c.className="cup";c.style.animationDelay=(i*.025)+"s";$("#cups").append(c)}
}
$("#met").addEventListener("click",()=>{people++;localStorage.setItem("orangePeople",people);renderPeople();say(people===1?"Excellent. Society founded.":"The table gets friendlier.")});
load();renderPeople();
</script>
</body>
</html>