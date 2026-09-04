<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#071a2d">
<title>The Poem Current</title>
<style>
@keyframes surfaceIn { from { opacity:0; transform:translateY(18px) } to { opacity:1; transform:none } }
@keyframes swim { 0%,100%{transform:translateX(0) rotate(-1deg)} 50%{transform:translateX(9px) rotate(1deg)} }
@keyframes pulse { 0%,100%{opacity:.25;transform:scale(.85)} 50%{opacity:1;transform:scale(1.15)} }
@keyframes wake { from{transform:translateX(-110%)} to{transform:translateX(240%)} }
@keyframes arrive { 0%{opacity:0;transform:translateY(16px);filter:blur(7px)} 100%{opacity:1;transform:none;filter:none} }
*{box-sizing:border-box}
:root{
  --ink:#071a2d;--deep:#0b2842;--paper:#f3ead5;--paper2:#ded0af;
  --cyan:#55d5e7;--orange:#ef7544;--silver:#c7dce2;--muted:#94aeb8;
  --serif:"Iowan Old Style","Palatino Linotype",Palatino,"Book Antiqua",serif;
  --sans:"Avenir Next",Avenir,"Gill Sans",Candara,sans-serif;
}
html{background:var(--ink);scroll-behavior:smooth}
body{margin:0;color:var(--paper);font-family:var(--sans);min-height:100vh;background:
  radial-gradient(circle at 72% 44%,rgba(35,136,162,.18),transparent 33rem),
  linear-gradient(160deg,#061522 0%,#0b2842 55%,#061827 100%);overflow-x:hidden}
body:after{content:"";position:fixed;inset:0;pointer-events:none;opacity:.17;z-index:20;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.35'/%3E%3C/svg%3E");mix-blend-mode:soft-light}
a{color:inherit}.hero{min-height:76vh;display:grid;align-items:end;position:relative;isolation:isolate;background-image:linear-gradient(90deg,rgba(4,18,32,.93) 0%,rgba(4,18,32,.55) 39%,rgba(4,18,32,.06) 70%),linear-gradient(0deg,var(--ink) 0%,transparent 30%),url('poem-current.webp');background-size:cover;background-position:center}
.hero:after{content:"";position:absolute;inset:auto 0 10% 0;height:1px;background:linear-gradient(90deg,transparent,var(--cyan),transparent);box-shadow:0 0 20px var(--cyan);opacity:.45;z-index:-1}
.hero-copy{width:min(1180px,100%);margin:0 auto;padding:7rem clamp(1.25rem,6vw,5rem) 5.5rem;animation:surfaceIn .9s both}
.eyebrow{display:flex;align-items:center;gap:.75rem;text-transform:uppercase;letter-spacing:.22em;font-size:.72rem;font-weight:700;color:var(--cyan);margin-bottom:1rem}.eyebrow:before{content:"";width:2.8rem;height:1px;background:currentColor}
h1{font-family:var(--serif);font-size:clamp(3.5rem,10vw,8.8rem);font-weight:400;line-height:.78;letter-spacing:-.065em;margin:0;max-width:8ch;text-wrap:balance;text-shadow:0 5px 40px #04111d}
h1 em{display:block;color:var(--cyan);font-weight:400;padding-left:.72em}
.lede{font-family:var(--serif);font-style:italic;font-size:clamp(1.05rem,2vw,1.4rem);line-height:1.55;max-width:34rem;color:#d5e2df;margin:2rem 0 0}.scroll-cue{position:absolute;right:clamp(1.2rem,5vw,4.5rem);bottom:3rem;writing-mode:vertical-rl;text-transform:uppercase;letter-spacing:.2em;font-size:.63rem;color:var(--muted)}
main{width:min(1180px,100%);padding:3rem clamp(1rem,4vw,3rem) 6rem;margin:auto}.intro{display:grid;grid-template-columns:.7fr 1.3fr;gap:clamp(2rem,8vw,8rem);align-items:start;margin:3rem 0 5rem}.kicker{font-size:.7rem;letter-spacing:.18em;text-transform:uppercase;color:var(--orange);font-weight:800}.intro h2,.station h2{font-family:var(--serif);font-weight:400;font-size:clamp(2rem,4vw,4.2rem);line-height:1;margin:.6rem 0}.intro p{font-family:var(--serif);font-size:1.16rem;line-height:1.75;color:#c8d6d5;margin:.3rem 0}.postcard{border-left:1px solid rgba(85,213,231,.4);padding-left:1.5rem}.postcard q{display:block;font-family:var(--serif);font-size:1.45rem;line-height:1.35;color:var(--paper);margin-top:1rem}.postcard small{display:block;color:var(--muted);line-height:1.5;margin-top:.85rem}
.station{position:relative;border:1px solid rgba(159,194,203,.22);background:linear-gradient(140deg,rgba(15,46,70,.88),rgba(6,26,44,.96));box-shadow:0 35px 90px rgba(0,0,0,.34);overflow:hidden}.station:before{content:"TRANSLATION CHANNEL / 04";position:absolute;right:-4rem;top:7rem;transform:rotate(90deg);font:700 .62rem var(--sans);letter-spacing:.24em;color:rgba(85,213,231,.24)}
.station-head{padding:clamp(1.4rem,4vw,3.5rem);border-bottom:1px solid rgba(159,194,203,.18);display:flex;justify-content:space-between;gap:2rem;align-items:end}.station-head p{max-width:29rem;color:var(--muted);line-height:1.55;margin:0}.dial-display{font:italic 1.25rem var(--serif);color:var(--cyan);white-space:nowrap}
.console{display:grid;grid-template-columns:minmax(0,.82fr) minmax(0,1.18fr);min-height:35rem}.controls{padding:clamp(1.4rem,4vw,3.5rem);border-right:1px solid rgba(159,194,203,.18);display:flex;flex-direction:column;gap:1.6rem}.field{display:grid;gap:.55rem}.field label{font-size:.68rem;text-transform:uppercase;letter-spacing:.14em;color:var(--muted);font-weight:800}.field input,.field select{width:100%;border:0;border-bottom:1px solid #537080;background:transparent;color:var(--paper);border-radius:0;padding:.75rem .1rem;font:1.04rem var(--serif);outline:none}.field input:focus,.field select:focus{border-color:var(--cyan);box-shadow:0 5px 0 -4px var(--cyan)}select option{background:#0b2842}.intensity{display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem}.intensity button{border:1px solid #355369;background:rgba(4,20,33,.55);color:var(--muted);padding:.7rem .4rem;font:700 .7rem var(--sans);letter-spacing:.08em;text-transform:uppercase;cursor:pointer}.intensity button[aria-pressed="true"]{border-color:var(--orange);color:#fff;background:rgba(239,117,68,.16)}
.send{position:relative;isolation:isolate;border:0;background:var(--orange);color:#1d1510;padding:1rem 1.3rem;text-align:left;font:800 .82rem var(--sans);letter-spacing:.13em;text-transform:uppercase;cursor:pointer;overflow:hidden;box-shadow:6px 6px 0 #091522;transition:transform .2s,box-shadow .2s}.send:hover{transform:translate(2px,2px);box-shadow:4px 4px 0 #091522}.send:after{content:"→";float:right;font-size:1.1rem}.send .wake{position:absolute;inset:0;width:35%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.45),transparent);transform:translateX(-110%);z-index:-1}.send.running .wake{animation:wake .85s ease-in-out}.note{font-size:.72rem;line-height:1.45;color:#75939f;margin:0}
.relay{padding:clamp(1.4rem,4vw,3.5rem);position:relative;background:radial-gradient(circle at 85% 20%,rgba(61,173,198,.12),transparent 40%)}.cable{position:absolute;top:3rem;bottom:3rem;left:clamp(2.05rem,5.7vw,4.65rem);width:1px;background:linear-gradient(var(--cyan),rgba(85,213,231,.12));box-shadow:0 0 10px rgba(85,213,231,.6)}.stop{position:relative;padding:0 0 2rem 3.2rem;opacity:.42;transition:opacity .4s}.stop.live,.stop.done{opacity:1}.node{position:absolute;left:-.37rem;top:.18rem;width:.78rem;height:.78rem;border:2px solid var(--cyan);background:var(--deep);border-radius:50%}.stop.live .node{background:var(--cyan);box-shadow:0 0 0 6px rgba(85,213,231,.13),0 0 18px var(--cyan);animation:pulse 1s infinite}.stop.done .node{background:var(--orange);border-color:var(--orange)}.stop-label{font-size:.62rem;letter-spacing:.16em;text-transform:uppercase;color:var(--cyan);font-weight:800}.line{font-family:var(--serif);font-size:clamp(1.12rem,2.1vw,1.65rem);line-height:1.38;color:#e6e3d4;margin:.45rem 0 0;min-height:2.2rem}.stop.live .line{animation:arrive .6s both}.meter{height:2px;background:#263f50;margin-top:.8rem;max-width:10rem}.meter i{display:block;height:100%;background:var(--orange);width:var(--meaning,100%);transition:width .8s}.meter-caption{font-size:.58rem;color:#718d98;text-transform:uppercase;letter-spacing:.1em;margin-top:.35rem}
.bottle{display:none;margin-top:.8rem;padding:1.6rem;border:1px solid rgba(239,117,68,.48);background:rgba(239,117,68,.07);position:relative}.bottle.show{display:block;animation:arrive .8s both}.bottle:before{content:"ARRIVED";position:absolute;right:1rem;top:1rem;color:var(--orange);font-size:.57rem;letter-spacing:.2em;font-weight:900}.poem{font:italic clamp(1.2rem,2.3vw,1.75rem)/1.65 var(--serif);white-space:pre-line;margin:0;color:#f2ead7}.actions{display:flex;gap:.6rem;flex-wrap:wrap;margin-top:1.4rem}.ghost{border:1px solid #466476;background:transparent;color:#bad0d5;padding:.65rem .8rem;font:700 .65rem var(--sans);letter-spacing:.1em;text-transform:uppercase;cursor:pointer}.ghost:hover{border-color:var(--cyan);color:white}.transmission-id{font-size:.6rem;color:#68838d;margin-top:1rem;letter-spacing:.12em;text-transform:uppercase}
.afterword{display:grid;grid-template-columns:1fr 1fr;gap:3rem;margin:5rem 0 1rem;align-items:center}.afterword h3{font:400 clamp(2rem,4vw,3.8rem)/1 var(--serif);margin:.5rem 0 1rem}.afterword p{line-height:1.7;color:#adc0c3}.afterword a{text-decoration-color:var(--orange);text-underline-offset:.25rem}.fish-mark{font:italic clamp(1.6rem,3vw,3rem)/1.3 var(--serif);color:var(--paper2);padding:2rem;border:1px solid rgba(159,194,203,.2);transform:rotate(-2deg);background:rgba(3,17,29,.3)}.fish-mark span{display:block;color:var(--cyan);font-size:.62rem;font-family:var(--sans);font-style:normal;letter-spacing:.16em;text-transform:uppercase;margin-bottom:1rem}footer{padding-top:2rem;border-top:1px solid rgba(159,194,203,.16);display:flex;justify-content:space-between;gap:1rem;color:#6e8992;font-size:.7rem}footer a{text-decoration:none;color:#a8c2c6}
@media(max-width:760px){.hero{min-height:82vh;background-position:59% center}.hero-copy{padding-bottom:4.5rem}.scroll-cue{display:none}.intro,.afterword,.console{grid-template-columns:1fr}.intro{gap:2rem}.postcard{order:-1}.station-head{display:block}.dial-display{margin-top:1rem}.controls{border-right:0;border-bottom:1px solid rgba(159,194,203,.18)}.relay{min-height:31rem}.station:before{display:none}footer{display:block;line-height:1.8}}
@media(prefers-reduced-motion:reduce){*,*:before,*:after{animation:none!important;scroll-behavior:auto!important}}
</style>
</head>
<body>
<header class="hero">
  <div class="hero-copy">
    <div class="eyebrow">Lost web transmission · 2004</div>
    <h1>The Poem <em>Current</em></h1>
    <p class="lede">Write one plain thought. Keep hold of one precious word. Then let the old internet carry it somewhere stranger.</p>
  </div>
  <div class="scroll-cue">Descend to the cable ↓</div>
</header>

<main>
  <section class="intro">
    <div>
      <div class="kicker">Recovered fragment 62</div>
      <h2>A link, a friend, a peculiar title.</h2>
    </div>
    <div class="postcard">
      <p>In March 2004, Jon saved a poet recommended by Ji-Hwan. The poem sat behind an AltaVista Babel Fish link, and its machine-translated title came through as:</p>
      <q>“To you one which runs”</q>
      <small>The original destination has slipped beneath the web. The lovely near-miss remains.</small>
    </div>
  </section>

  <section class="station" aria-labelledby="station-title">
    <div class="station-head">
      <div><div class="kicker">Undersea relay desk</div><h2 id="station-title">Prepare a transmission</h2></div>
      <p>This is a poetry machine, not a translator. It imitates the way meaning can bend, echo, and become newly alive while travelling between people.</p>
      <div class="dial-display" id="dialDisplay">current: gentle</div>
    </div>
    <div class="console">
      <form class="controls" id="controls">
        <div class="field">
          <label for="seed">The thought you want to send</label>
          <input id="seed" maxlength="90" value="I am running home before the rain arrives" autocomplete="off">
        </div>
        <div class="field">
          <label for="anchor">One word that must survive</label>
          <input id="anchor" maxlength="18" value="home" autocomplete="off">
        </div>
        <div class="field">
          <label for="weather">Weather in the wire</label>
          <select id="weather">
            <option value="moon">Moonlit tide</option>
            <option value="rain" selected>September rain</option>
            <option value="snow">First snow</option>
            <option value="static">Blue static</option>
          </select>
        </div>
        <div class="field">
          <label>Translation current</label>
          <div class="intensity" id="intensity">
            <button type="button" data-level="1" aria-pressed="true">Gentle</button>
            <button type="button" data-level="2" aria-pressed="false">Tidal</button>
            <button type="button" data-level="3" aria-pressed="false">Babel</button>
          </div>
        </div>
        <button class="send" type="submit">Send through the current <span class="wake"></span></button>
        <p class="note">No network request is made. Your sentence stays in this browser, safely dry despite all appearances.</p>
      </form>

      <div class="relay" aria-live="polite">
        <div class="cable"></div>
        <div class="stop done" data-stop="0">
          <span class="node"></span><div class="stop-label">01 · Plain shore</div>
          <p class="line" id="line0">I am running home before the rain arrives</p>
          <div class="meter"><i style="--meaning:100%"></i></div><div class="meter-caption">meaning retained · 100%</div>
        </div>
        <div class="stop" data-stop="1">
          <span class="node"></span><div class="stop-label">02 · Literal ferry</div>
          <p class="line" id="line1">Awaiting signal…</p>
          <div class="meter"><i id="meter1"></i></div><div class="meter-caption">meaning retained · <span id="pct1">—</span></div>
        </div>
        <div class="stop" data-stop="2">
          <span class="node"></span><div class="stop-label">03 · Idiom reef</div>
          <p class="line" id="line2">Awaiting signal…</p>
          <div class="meter"><i id="meter2"></i></div><div class="meter-caption">meaning retained · <span id="pct2">—</span></div>
        </div>
        <div class="stop" data-stop="3">
          <span class="node"></span><div class="stop-label">04 · Human shore</div>
          <p class="line" id="line3">Awaiting signal…</p>
          <div class="meter"><i id="meter3"></i></div><div class="meter-caption">meaning retained · <span id="pct3">—</span></div>
        </div>
        <div class="bottle" id="bottle">
          <p class="poem" id="poem"></p>
          <div class="actions">
            <button class="ghost" id="copy" type="button">Copy arrived poem</button>
            <button class="ghost" id="again" type="button">Send another version</button>
          </div>
          <div class="transmission-id" id="transmissionId"></div>
        </div>
      </div>
    </div>
  </section>

  <section class="afterword">
    <div>
      <div class="kicker">Why this exists</div>
      <h3>The mistake can carry something true.</h3>
      <p>Old machine translation was clumsy, but sometimes its clumsiness opened a side door into poetry. This little relay protects your anchor word while everything around it is allowed to wander.</p>
      <p>Inspired by Jon’s <a href="https://jona.ca/2004/03/poet-recommended-to-me-by-ji-hwan-to.html">note about a poet recommended by Ji-Hwan</a>.</p>
    </div>
    <blockquote class="fish-mark"><span>Field note</span>Meaning does not cross the water unchanged. Neither do we.</blockquote>
  </section>
  <footer><a href="index.php">← Back to Chloe Reads Jon</a><span>Built from one surviving sentence and a sunken link.</span></footer>
</main>

<script>
(() => {
  const $ = s => document.querySelector(s);
  const $$ = s => [...document.querySelectorAll(s)];
  const form = $('#controls'), seed = $('#seed'), anchor = $('#anchor'), weather = $('#weather');
  let level = 1, variation = 0, timers = [];
  const weatherWords = {
    moon:['moon-pale','under a listening moon','silver with distance'],
    rain:['rain-open','before the weather remembers us','wet with September'],
    snow:['snow-quiet','under the first white silence','cold with wonder'],
    static:['blue-static','through the electric shallows','bright with interference']
  };
  const verbs = [
    ['running','travelling on two quick feet','becoming a road'],['run','hurry toward','teach the distance to close'],
    ['walking','measuring the earth','moving one promise at a time'],['walk','cross softly toward','give the road a heartbeat'],
    ['going','being carried','following the invisible thread'],['go','lean toward','enter the far side of now'],
    ['driving','guiding four wheels','making the highway remember'],['drive','roll toward','lend the night an engine'],
    ['waiting','keeping a small vigil','holding the door of time'],['wait','remain beside','be the still point of']
  ];
  const nouns = [
    ['home','the known light','the room that says your name'],['rain','the descending sky','a thousand small arrivals'],
    ['friend','the remembered voice','one lamp across the water'],['night','the dark hour','the great blue pocket'],
    ['road','the long ground','a sentence drawn on earth'],['morning','the opening light','tomorrow unfolding its sleeves']
  ];
  function hash(str){let h=2166136261;for(let i=0;i<str.length;i++){h^=str.charCodeAt(i);h=Math.imul(h,16777619)}return h>>>0}
  function pick(list,n){return list[Math.abs(n)%list.length]}
  function safeWord(s){return (s.trim().match(/[A-Za-zÀ-ž'-]+/)||['memory'])[0].slice(0,18)}
  function replaceKnown(text,depth,h){
    let out=text;
    [...verbs,...nouns].forEach((set,i)=>{const rx=new RegExp('\\b'+set[0]+'\\b','ig');if(rx.test(out))out=out.replace(rx,set[Math.min(depth,set.length-1)])});
    if(depth>1 && out===text){const words=out.split(/\s+/);if(words.length>3)words.splice((h% (words.length-2))+1,0,pick(['quietly','still','almost','eastward'],h>>3));out=words.join(' ')}
    return out;
  }
  function makeLines(){
    const plain=seed.value.trim()||'I am running home before the rain arrives';
    const keep=safeWord(anchor.value||'home'); anchor.value=keep;
    const h=hash(plain+keep+weather.value+level+variation);
    const w=weatherWords[weather.value];
    let literal=replaceKnown(plain,1,h).replace(/^I am\b/i,'This person is');
    if(level>1) literal=literal.replace(/\bbefore\b/i,'on the near side of').replace(/\bafter\b/i,'in the wake of');
    const core=replaceKnown(plain,Math.min(2,level+1),h);
    const reef=level===1 ? `${core}, ${pick(w,h)}` : level===2 ? `${pick(w,h+1)}, ${core.toLowerCase()}` : `${pick(w,h+1)}; ${replaceKnown(core,2,h+9).toLowerCase()}`;
    const last=[
      `To you, the one who ${pick(['runs','returns','keeps moving','follows the light'],h)}—\ncarry ${keep} through ${pick(['the rain','the distance','the blue current','the unfinished night'],h>>2)}.`,
      `${pick(['The road translates your footsteps.','The wire remembers the weather.','A silver fish carries the sentence.'],h)}\nEverything changes except ${keep}.`,
      `${pick(['Go until the dark becomes a doorway.','Run where the moon loosens the horizon.','Listen: the water is speaking in pixels.'],h)}\nOn the far shore, call it ${keep}.`
    ][level-1];
    return [plain,literal,reef,last];
  }
  function clearRun(){timers.forEach(clearTimeout);timers=[];$$('.stop').forEach((el,i)=>{el.className='stop'+(i===0?' done':'')});$('#bottle').classList.remove('show')}
  function transmit(){
    clearRun(); const lines=makeLines(); $('#line0').textContent=lines[0];
    $('.send').classList.remove('running'); void $('.send').offsetWidth; $('.send').classList.add('running');
    const pcts=[[88,73,61],[75,54,38],[63,35,22]][level-1];
    [1,2,3].forEach((n,i)=>timers.push(setTimeout(()=>{
      const stop=$(`[data-stop="${n}"]`); $$('.stop.live').forEach(x=>{x.classList.remove('live');x.classList.add('done')});
      stop.classList.add('live'); $(`#line${n}`).textContent=lines[n]; $(`#meter${n}`).style.setProperty('--meaning',pcts[i]+'%'); $(`#pct${n}`).textContent=pcts[i]+'%';
      if(n===3) timers.push(setTimeout(()=>{stop.classList.remove('live');stop.classList.add('done');$('#poem').textContent=lines[3];$('#bottle').classList.add('show');$('#transmissionId').textContent='Transmission '+hash(lines.join('|')).toString(16).toUpperCase().padStart(8,'0')+' · anchor received intact'},620));
    },420+n*670)));
  }
  form.addEventListener('submit',e=>{e.preventDefault();transmit()});
  $('#intensity').addEventListener('click',e=>{const b=e.target.closest('button');if(!b)return;level=+b.dataset.level;$$('#intensity button').forEach(x=>x.setAttribute('aria-pressed',x===b?'true':'false'));$('#dialDisplay').textContent='current: '+['gentle','tidal','babel'][level-1]});
  $('#again').addEventListener('click',()=>{variation++;transmit()});
  $('#copy').addEventListener('click',async()=>{try{await navigator.clipboard.writeText($('#poem').textContent);$('#copy').textContent='Copied to shore ✓';setTimeout(()=>$('#copy').textContent='Copy arrived poem',1600)}catch(e){$('#copy').textContent='Select the poem to copy'}});
  seed.addEventListener('input',()=>{$('#line0').textContent=seed.value||'Your sentence begins here…'});
})();
</script>
</body>
</html>
