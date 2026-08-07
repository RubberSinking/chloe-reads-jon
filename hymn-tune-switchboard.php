<?php
declare(strict_types=1);
$sourceUrl = 'https://cooltoolsforcatholics.blogspot.com/2005/07/730-traditional-hymns-on-single.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#17362f">
<title>The Pocket Hymn Switchboard</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital@0;1&family=Oswald:wght@500;600&display=swap');
:root{--ink:#17362f;--cream:#f4edda;--paper:#fffaf0;--red:#b94734;--gold:#d5a73b;--line:#b8ad91;--shadow:#10231f}
*{box-sizing:border-box}html{background:var(--ink)}body{margin:0;color:var(--ink);font-family:'Libre Caslon Text',Georgia,serif;background:radial-gradient(circle at 18% 9%,#fff9e8 0 8%,transparent 26%),linear-gradient(120deg,#eee1c5,#fffaf0 45%,#e4d5b8);min-height:100vh}
body:before{content:"";position:fixed;inset:0;pointer-events:none;opacity:.14;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='90' height='90'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.7' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.35'/%3E%3C/svg%3E")}
a{color:inherit}.shell{width:min(1120px,100%);margin:auto;padding:22px clamp(15px,3vw,38px) 50px}.topbar{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-bottom:28px;font:600 12px Oswald,sans-serif;letter-spacing:.16em;text-transform:uppercase}.back{text-decoration:none;border-bottom:2px solid var(--red)}.issue{opacity:.72}
header{display:grid;grid-template-columns:1fr auto;gap:28px;align-items:end;border-block:3px double var(--ink);padding:30px 0 25px;margin-bottom:28px}.kicker{color:var(--red);font:600 13px Oswald,sans-serif;letter-spacing:.24em;text-transform:uppercase;margin:0 0 8px}h1{font-size:clamp(42px,8vw,92px);line-height:.86;letter-spacing:-.055em;margin:0;max-width:800px;font-weight:400}.deck{max-width:620px;font-style:italic;font-size:clamp(15px,2vw,19px);line-height:1.55;margin:20px 0 0}.seal{width:142px;aspect-ratio:1;border:2px solid var(--red);border-radius:50%;display:grid;place-content:center;text-align:center;transform:rotate(7deg);color:var(--red);font:600 13px/1.3 Oswald,sans-serif;letter-spacing:.09em;text-transform:uppercase;box-shadow:inset 0 0 0 5px var(--cream),inset 0 0 0 7px var(--red)}
.switchboard{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(300px,.85fr);border:2px solid var(--ink);background:rgba(255,250,240,.72);box-shadow:9px 10px 0 var(--shadow);position:relative}.switchboard:before{content:'THE METRICAL EXCHANGE';position:absolute;top:-11px;left:24px;background:var(--red);color:white;padding:5px 12px;font:500 11px Oswald,sans-serif;letter-spacing:.18em}.panel{padding:clamp(22px,4vw,40px)}.panel+.panel{border-left:1px solid var(--line);background:rgba(229,215,183,.34)}
.label{display:block;margin:0 0 10px;font:600 11px Oswald,sans-serif;letter-spacing:.18em;text-transform:uppercase}.choice-row{display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:26px}.choice{border:1px solid var(--ink);background:transparent;color:var(--ink);padding:11px 6px;font:500 12px Oswald,sans-serif;letter-spacing:.06em;cursor:pointer;transition:.18s}.choice:hover,.choice.active{background:var(--ink);color:var(--paper);transform:translateY(-2px)}
.hymn-card{min-height:300px;border-top:1px solid var(--line);border-bottom:1px solid var(--line);padding:26px 6px 20px;position:relative}.number{position:absolute;right:4px;top:8px;color:var(--red);font:500 12px Oswald,sans-serif}.hymn-title{font-size:clamp(24px,4vw,38px);font-weight:400;margin:0 0 7px}.meter{color:var(--red);font:600 12px Oswald,sans-serif;letter-spacing:.12em}.verse{font-size:clamp(17px,2.5vw,22px);line-height:1.72;margin:22px 0 0}.verse span{display:block}.verse .singing{background:linear-gradient(transparent 62%,rgba(213,167,59,.55) 62%)}
.tune-dial{display:flex;align-items:center;gap:16px;margin-bottom:24px}.dial{width:104px;aspect-ratio:1;border-radius:50%;border:2px solid var(--ink);background:repeating-conic-gradient(var(--gold) 0 8deg,var(--cream) 8deg 16deg);position:relative;box-shadow:inset 0 0 0 12px var(--cream),inset 0 0 0 14px var(--ink)}.dial:after{content:'';position:absolute;width:5px;height:38%;background:var(--red);left:calc(50% - 2px);top:11%;transform-origin:50% 100%;transform:rotate(var(--turn,0deg));transition:.5s cubic-bezier(.2,.9,.2,1)}.tune-name{font-size:24px;margin:0}.tune-note{font-style:italic;font-size:13px;line-height:1.5;margin-top:5px}
.tunes{display:grid;gap:8px}.tune{display:grid;grid-template-columns:30px 1fr auto;align-items:center;gap:10px;text-align:left;background:transparent;border:1px solid var(--line);padding:11px;color:var(--ink);cursor:pointer}.tune:hover,.tune.active{border-color:var(--red);background:var(--paper)}.tune-index{font:500 11px Oswald,sans-serif;color:var(--red)}.tune strong{font:500 14px Oswald,sans-serif;letter-spacing:.04em}.fit{font:500 10px Oswald,sans-serif;text-transform:uppercase;color:#527068}.fit.no{color:var(--red)}
.play{width:100%;margin-top:18px;border:0;background:var(--red);color:white;padding:15px;font:600 13px Oswald,sans-serif;letter-spacing:.16em;text-transform:uppercase;cursor:pointer;box-shadow:4px 4px 0 var(--ink)}.play:active{transform:translate(2px,2px);box-shadow:2px 2px 0 var(--ink)}
.workshop{display:grid;grid-template-columns:.72fr 1.28fr;gap:28px;margin-top:46px;padding-top:30px;border-top:3px double var(--ink)}.workshop h2{font-size:clamp(28px,4vw,46px);font-weight:400;line-height:1;margin:0 0 12px}.workshop p{line-height:1.6;margin:0}.writing{background:var(--paper);border:1px solid var(--line);padding:18px;box-shadow:5px 5px 0 rgba(23,54,47,.16)}textarea{width:100%;min-height:135px;border:0;border-bottom:1px solid var(--line);resize:vertical;background:transparent;color:var(--ink);font:17px/1.7 'Libre Caslon Text',serif;outline:none}.analyse{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:14px}.analyse button{border:1px solid var(--ink);background:var(--ink);color:var(--paper);padding:10px 14px;font:500 11px Oswald,sans-serif;letter-spacing:.12em;text-transform:uppercase;cursor:pointer}.result{font:500 12px Oswald,sans-serif;letter-spacing:.08em;text-align:right}.result b{color:var(--red);font-size:18px}
.foot{display:flex;justify-content:space-between;gap:25px;margin-top:42px;padding-top:18px;border-top:1px solid var(--line);font-size:12px;line-height:1.55}.source{max-width:560px}.source a{color:var(--red)}
@media(max-width:760px){header{grid-template-columns:1fr}.seal{display:none}.switchboard{grid-template-columns:1fr;box-shadow:5px 6px 0 var(--shadow)}.panel+.panel{border-left:0;border-top:1px solid var(--ink)}.workshop{grid-template-columns:1fr}.choice-row{grid-template-columns:1fr}.choice{padding:10px}.foot{flex-direction:column}.hymn-card{min-height:0}.issue{display:none}}
@media(prefers-reduced-motion:reduce){*{scroll-behavior:auto!important;transition:none!important}}
</style>
</head>
<body>
<main class="shell">
  <nav class="topbar"><a class="back" href="index.php">← Chloe Reads Jon</a><span class="issue">Pocket Edition · No. 730-ish</span></nav>
  <header>
    <div><p class="kicker">A small machine for large-hearted singing</p><h1>The Pocket Hymn Switchboard</h1><p class="deck">Hymn texts and tunes are old friends who sometimes swap dance partners. Choose a verse, turn the dial, and discover which melodies share its metre.</p></div>
    <div class="seal">Words<br>meet<br>music</div>
  </header>
  <section class="switchboard" aria-label="Hymn tune switchboard">
    <div class="panel">
      <span class="label">1 · Select a text</span>
      <div class="choice-row" id="texts"></div>
      <article class="hymn-card" aria-live="polite"><span class="number" id="number"></span><h2 class="hymn-title" id="hymnTitle"></h2><div class="meter" id="meter"></div><div class="verse" id="verse"></div></article>
    </div>
    <div class="panel">
      <span class="label">2 · Connect a tune</span>
      <div class="tune-dial"><div class="dial" id="dial"></div><div><h3 class="tune-name" id="tuneName"></h3><div class="tune-note" id="tuneNote"></div></div></div>
      <div class="tunes" id="tunes"></div>
      <button class="play" id="play">▶ Ring the tune</button>
    </div>
  </section>
  <section class="workshop">
    <div><span class="label">The compositor's bench</span><h2>What metre is your verse?</h2><p>Write four lines. The machine makes an approximate syllable count, then points you toward the nearest hymn-tune family. English, naturally, will occasionally behave like a cat near a closed door.</p></div>
    <div class="writing"><textarea id="custom" aria-label="Your four-line verse" placeholder="Write a line of your own…&#10;Then add another three…&#10;The meter need not yet be neat…&#10;We’ll count it presently."></textarea><div class="analyse"><button id="count">Count the syllables</button><div class="result" id="result">Awaiting type.</div></div></div>
  </section>
  <footer class="foot"><div class="source">Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener">“730 traditional hymns on a single webpage”</a>, a wonderfully 2005 idea: put an entire hymnal in your pocket and take it anywhere.</div><div>Built for curious ears.<br>Sound requires one tap.</div></footer>
</main>
<script>
const hymns=[
 {title:'O God, Our Help in Ages Past',meter:'C.M. · 8.6.8.6',verse:['O God, our help in ages past,','Our hope for years to come,','Our shelter from the stormy blast,','And our eternal home.']},
 {title:'All People That on Earth Do Dwell',meter:'L.M. · 8.8.8.8',verse:['All people that on earth do dwell,','Sing to the Lord with cheerful voice;','Him serve with mirth, his praise forth tell,','Come ye before him and rejoice.']},
 {title:'Praise to the Lord, the Almighty',meter:'14.14.4.7.8',verse:['Praise to the Lord, the Almighty, the King of creation!','O my soul, praise him, for he is thy health and salvation!','All ye who hear,','Now to his temple draw near;','Join me in glad adoration!']}
];
const tunes=[
 {name:'ST. ANNE',meter:'C.M. · 8.6.8.6',note:'Stately, square-shouldered, and wonderfully inevitable.',melody:[[67,1],[67,1],[69,1],[64,1],[67,1],[69,1],[71,2],[71,1],[69,1],[67,1],[69,1],[67,1],[64,2]]},
 {name:'WINCHESTER OLD',meter:'C.M. · 8.6.8.6',note:'A gentler Common Metre road with an old English gait.',melody:[[64,1],[67,1],[69,1],[71,1],[72,1],[71,1],[69,2],[71,1],[69,1],[67,1],[66,1],[64,2]]},
 {name:'OLD 100TH',meter:'L.M. · 8.8.8.8',note:'The grand old doxology tune: broad steps and open doors.',melody:[[67,1],[69,1],[71,1],[67,1],[72,1],[71,1],[69,2],[71,1],[72,1],[74,1],[72,1],[71,1],[69,1],[67,2]]},
 {name:'LOBE DEN HERREN',meter:'14.14.4.7.8',note:'A bright, rolling procession built for exuberant praise.',melody:[[67,.75],[67,.25],[74,1],[71,.5],[72,.5],[74,1],[79,1],[77,.5],[76,.5],[74,2],[71,.75],[72,.25],[74,1],[69,2]]}
];
let hymn=0,tune=0,playing=false,audio;
const $=s=>document.querySelector(s);
function render(){
 $('#texts').innerHTML=hymns.map((h,i)=>`<button class="choice ${i===hymn?'active':''}" data-h="${i}">${h.title.split(',')[0]}</button>`).join('');
 const h=hymns[hymn]; $('#hymnTitle').textContent=h.title; $('#meter').textContent=h.meter; $('#number').textContent=`TEXT 0${hymn+1}`; $('#verse').innerHTML=h.verse.map((x,i)=>`<span data-line="${i}">${x}</span>`).join('');
 $('#tunes').innerHTML=tunes.map((t,i)=>{const fit=t.meter===h.meter;return `<button class="tune ${i===tune?'active':''}" data-t="${i}"><span class="tune-index">0${i+1}</span><strong>${t.name}</strong><span class="fit ${fit?'':'no'}">${fit?'perfect fit':'wrong metre'}</span></button>`}).join('');
 $('#tuneName').textContent=tunes[tune].name; $('#tuneNote').textContent=tunes[tune].note; $('#dial').style.setProperty('--turn',`${tune*65-50}deg`);
 document.querySelectorAll('[data-h]').forEach(b=>b.onclick=()=>{hymn=+b.dataset.h;const match=tunes.findIndex(t=>t.meter===hymns[hymn].meter);if(match>=0)tune=match;render()});
 document.querySelectorAll('[data-t]').forEach(b=>b.onclick=()=>{tune=+b.dataset.t;render()});
}
function ring(){if(playing)return; playing=true;audio=audio||new (window.AudioContext||window.webkitAudioContext)();const now=audio.currentTime+.05,beat=.34;let cursor=0;$('#play').textContent='♫ Switching…';tunes[tune].melody.forEach(([m,d],i)=>{const o=audio.createOscillator(),g=audio.createGain();o.type='triangle';o.frequency.value=440*Math.pow(2,(m-69)/12);g.gain.setValueAtTime(0,now+cursor);g.gain.linearRampToValueAtTime(.12,now+cursor+.025);g.gain.exponentialRampToValueAtTime(.001,now+cursor+d*beat);o.connect(g).connect(audio.destination);o.start(now+cursor);o.stop(now+cursor+d*beat+.03);cursor+=d*beat});setTimeout(()=>{playing=false;$('#play').textContent='▶ Ring the tune'},cursor*1000+150)}
function syllables(line){line=line.toLowerCase().replace(/[^a-z' ]/g,' ').trim();if(!line)return 0;return line.split(/\s+/).reduce((n,w)=>{w=w.replace(/(?:[^laeiouy]es|ed|[^laeiouy]e)$/,'').replace(/^y/,'');const m=w.match(/[aeiouy]{1,2}/g);return n+(m?m.length:1)},0)}
$('#play').onclick=ring;$('#count').onclick=()=>{const counts=$('#custom').value.split(/\n/).filter(x=>x.trim()).map(syllables);if(!counts.length){$('#result').textContent='Give me a verse first.';return}const shapes=[[8,6,8,6],[8,8,8,8],[14,14,4,7,8]],names=['Common Metre (8.6.8.6)','Long Metre (8.8.8.8)','Praise metre (14.14.4.7.8)'];let best=0,score=1e9;shapes.forEach((s,i)=>{const v=counts.reduce((n,c,j)=>n+Math.abs(c-(s[j]||s[s.length-1])),0)+Math.abs(counts.length-s.length)*3;if(v<score){score=v;best=i}});$('#result').innerHTML=`Count: <b>${counts.join(' · ')}</b><br>Nearest: ${names[best]}`};
render();
</script>
</body>
</html>
