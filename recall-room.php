<?php
declare(strict_types=1);
$sourceUrl = 'https://jona.ca/2006/11/trying-out-x1-desktop-search-windows.html';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#101a24">
<title>The Recall Room</title>
<style>
    :root {
        --ink: #14212b;
        --night: #101a24;
        --night-2: #172735;
        --paper: #eee7d7;
        --paper-2: #d9cfb8;
        --amber: #ffbe4a;
        --orange: #e77036;
        --green: #5ba895;
        --blue: #6ea6c8;
        --muted: #8b938e;
        --line: rgba(232, 217, 185, .16);
        --shadow: 0 24px 70px rgba(0,0,0,.32);
    }
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
        margin: 0;
        min-height: 100vh;
        color: var(--paper);
        background:
            radial-gradient(circle at 78% 8%, rgba(81, 135, 153, .16), transparent 28rem),
            radial-gradient(circle at 10% 80%, rgba(231, 112, 54, .08), transparent 26rem),
            var(--night);
        font-family: "Trebuchet MS", "Gill Sans", sans-serif;
    }
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        opacity: .2;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E");
        z-index: 20;
    }
    button, input { font: inherit; }
    button { cursor: pointer; }
    a { color: var(--amber); }
    .shell { width: min(1180px, calc(100% - 28px)); margin: 0 auto; padding: 24px 0 70px; }
    .masthead {
        min-height: 240px;
        display: grid;
        grid-template-columns: 1.4fr .6fr;
        align-items: end;
        gap: 40px;
        padding: 36px 4px 30px;
        border-bottom: 1px solid var(--line);
    }
    .eyebrow {
        margin: 0 0 12px;
        color: var(--amber);
        font: 700 .72rem/1.2 "Courier New", monospace;
        letter-spacing: .22em;
        text-transform: uppercase;
    }
    h1 {
        margin: 0;
        color: #fff8e8;
        font-family: Georgia, "Times New Roman", serif;
        font-size: clamp(3.4rem, 8.7vw, 7.8rem);
        line-height: .78;
        letter-spacing: -.075em;
        font-weight: 400;
    }
    h1 em { color: var(--amber); font-weight: 400; }
    .intro {
        margin: 18px 0 0;
        max-width: 580px;
        color: #aeb9ba;
        font-family: Georgia, serif;
        font-size: 1.05rem;
        line-height: 1.6;
    }
    .index-dial {
        align-self: center;
        justify-self: end;
        position: relative;
        width: 172px;
        aspect-ratio: 1;
        border: 1px solid rgba(255,190,74,.4);
        border-radius: 50%;
        display: grid;
        place-items: center;
        box-shadow: inset 0 0 0 13px var(--night), inset 0 0 0 14px rgba(255,190,74,.18);
    }
    .index-dial::before {
        content: "";
        position: absolute;
        width: 2px;
        height: 68px;
        top: 17px;
        background: var(--orange);
        transform-origin: 50% 69px;
        animation: sweep 7s ease-in-out infinite alternate;
    }
    .dial-number { font: 700 2rem "Courier New", monospace; color: var(--paper); }
    .dial-label { display: block; color: var(--muted); font-size: .68rem; letter-spacing: .13em; text-align: center; }
    @keyframes sweep { from { transform: rotate(-58deg); } to { transform: rotate(58deg); } }

    .app {
        margin-top: 34px;
        display: grid;
        grid-template-columns: 270px minmax(0, 1fr);
        border: 1px solid rgba(231,214,177,.26);
        border-radius: 4px;
        overflow: hidden;
        box-shadow: var(--shadow);
        background: var(--night-2);
    }
    .sidebar {
        padding: 22px;
        background: #0c151d;
        border-right: 1px solid var(--line);
    }
    .side-title, .result-label {
        color: #73848b;
        font: 700 .67rem "Courier New", monospace;
        letter-spacing: .16em;
        text-transform: uppercase;
    }
    .mission {
        margin: 13px 0 22px;
        padding: 15px;
        border-left: 3px solid var(--amber);
        background: rgba(255,190,74,.06);
    }
    .mission-kicker { margin: 0 0 7px; color: var(--amber); font-size: .7rem; text-transform: uppercase; letter-spacing: .12em; }
    .mission p { margin: 0; color: #dcd6c7; font: 1rem/1.45 Georgia, serif; }
    .mission-status { min-height: 34px; margin: 10px 0 0 !important; color: var(--green) !important; font: .73rem/1.35 "Courier New", monospace !important; }
    .filters { display: grid; gap: 7px; margin-top: 10px; }
    .filter {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        padding: 9px 10px;
        border: 0;
        border-left: 2px solid transparent;
        color: #aeb9ba;
        background: transparent;
        text-align: left;
        font-size: .83rem;
    }
    .filter:hover, .filter.active { color: #fff8e8; background: rgba(255,255,255,.05); border-left-color: var(--orange); }
    .filter span { color: #6d7b80; font: .7rem "Courier New", monospace; }
    .cabinet { margin-top: 30px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 4px; }
    .drawer { height: 26px; background: #192630; border: 1px solid #263945; position: relative; }
    .drawer::after { content: ""; position: absolute; width: 9px; height: 2px; background: #7a6848; top: 11px; left: 8px; }
    .drawer.lit { background: #26382f; box-shadow: inset 0 -2px var(--green); }
    .main { min-width: 0; }
    .toolbar {
        display: flex;
        gap: 12px;
        align-items: center;
        padding: 20px;
        background: #233643;
        border-bottom: 1px solid #354b58;
    }
    .search-wrap { flex: 1; position: relative; }
    .search-icon { position: absolute; left: 15px; top: 13px; color: var(--orange); }
    #search {
        width: 100%;
        padding: 13px 48px 13px 42px;
        border: 1px solid #566d77;
        border-radius: 2px;
        outline: 0;
        color: var(--ink);
        background: var(--paper);
        box-shadow: inset 0 2px 6px rgba(28,24,15,.12);
    }
    #search:focus { border-color: var(--amber); box-shadow: 0 0 0 3px rgba(255,190,74,.16); }
    #clear {
        position: absolute;
        right: 9px; top: 8px;
        width: 32px; height: 32px;
        border: 0; background: transparent; color: #716d62; font-size: 1.15rem;
    }
    .random-btn {
        min-height: 44px;
        padding: 0 14px;
        color: var(--night);
        background: var(--amber);
        border: 0;
        border-radius: 2px;
        font-weight: 800;
        font-size: .75rem;
        letter-spacing: .04em;
    }
    .random-btn:hover { background: #ffd37c; transform: translateY(-1px); }
    .result-head {
        display: flex; justify-content: space-between; align-items: center;
        min-height: 46px; padding: 0 20px; border-bottom: 1px solid var(--line);
    }
    #count { color: #809198; font: .7rem "Courier New", monospace; }
    .results { min-height: 490px; }
    .result {
        position: relative;
        display: grid;
        grid-template-columns: 42px 1fr auto;
        gap: 15px;
        padding: 17px 20px;
        border-bottom: 1px solid var(--line);
        transition: background .2s, padding-left .2s;
        animation: enter .35s both;
    }
    .result:hover { background: rgba(255,255,255,.035); padding-left: 25px; }
    @keyframes enter { from { opacity: 0; transform: translateY(8px); } }
    .file-icon {
        width: 38px; height: 44px;
        display: grid; place-items: center;
        border: 1px solid #4e626b;
        color: var(--amber); background: #1c2b35;
        font: 700 .66rem "Courier New", monospace;
        clip-path: polygon(0 0, 75% 0, 100% 23%, 100% 100%, 0 100%);
    }
    .result h3 { margin: 1px 0 5px; color: #f4ebd8; font: 400 1.05rem Georgia, serif; }
    .result p { margin: 0; color: #93a0a2; font-size: .78rem; line-height: 1.55; }
    mark { color: var(--night); background: var(--amber); padding: 0 2px; }
    .meta { text-align: right; color: #74858b; font: .65rem/1.6 "Courier New", monospace; white-space: nowrap; }
    .tag { display: inline-block; margin-top: 7px; color: var(--green); font: .63rem "Courier New", monospace; text-transform: uppercase; letter-spacing: .08em; }
    .empty { padding: 80px 25px; text-align: center; color: #78898f; font-family: Georgia, serif; }
    .empty strong { display: block; color: var(--paper); font-size: 1.4rem; margin-bottom: 8px; }
    .tipbar {
        padding: 12px 20px;
        color: #7e8f94;
        background: #0d171f;
        font: .68rem/1.5 "Courier New", monospace;
        border-top: 1px solid var(--line);
    }
    .tipbar b { color: var(--amber); font-weight: 400; }
    .afterword {
        display: grid; grid-template-columns: .8fr 1.2fr; gap: 54px;
        padding: 80px 4px 40px;
    }
    .afterword h2 { margin: 0; color: #fff8e8; font: 400 clamp(2rem,5vw,4rem)/.95 Georgia,serif; letter-spacing: -.04em; }
    .afterword p { margin: 0 0 16px; color: #a6b0b0; line-height: 1.7; }
    .afterword .quote { color: var(--paper); font: italic 1.25rem/1.55 Georgia,serif; }
    .footer {
        display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap;
        padding-top: 24px; border-top: 1px solid var(--line); color: #6d7e83; font-size: .76rem;
    }
    .footer a { text-underline-offset: 3px; }
    @media (max-width: 760px) {
        .shell { width: min(100% - 18px, 620px); padding-top: 8px; }
        .masthead { min-height: 255px; grid-template-columns: 1fr; gap: 22px; align-items: end; }
        h1 { font-size: clamp(3.4rem, 18vw, 6rem); }
        .index-dial { display: none; }
        .app { grid-template-columns: 1fr; margin-top: 20px; }
        .sidebar { border-right: 0; border-bottom: 1px solid var(--line); }
        .filters { grid-template-columns: repeat(3,1fr); }
        .filter { display: block; text-align: center; padding: 9px 4px; border-left: 0; border-bottom: 2px solid transparent; }
        .filter.active { border-bottom-color: var(--orange); }
        .filter span { display: block; margin-top: 3px; }
        .cabinet { display: none; }
        .toolbar { padding: 12px; gap: 7px; }
        .random-btn { width: 48px; overflow: hidden; color: transparent; position: relative; }
        .random-btn::after { content: "↝"; color: var(--night); font-size: 1.3rem; position: absolute; inset: 9px; }
        .result { grid-template-columns: 34px 1fr; padding: 15px 13px; gap: 11px; }
        .file-icon { width: 32px; height: 38px; }
        .meta { grid-column: 2; text-align: left; }
        .afterword { grid-template-columns: 1fr; gap: 25px; padding-top: 55px; }
    }
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
</style>
</head>
<body>
<div class="shell">
    <header class="masthead">
        <div>
            <p class="eyebrow">Personal archive // indexed 02:16</p>
            <h1>The Recall<br><em>Room</em></h1>
            <p class="intro">Somewhere in the digital attic is the thing you vaguely remember. Search a tiny life archive, solve three memory mysteries, and discover why “perfect recall” is both wonderful and a little bit scary.</p>
        </div>
        <div class="index-dial" aria-hidden="true">
            <div><span class="dial-number">2,048</span><span class="dial-label">MEMORIES INDEXED</span></div>
        </div>
    </header>

    <main class="app" aria-label="Searchable memory archive">
        <aside class="sidebar">
            <div class="side-title">Current mystery</div>
            <section class="mission">
                <div class="mission-kicker" id="missionNo">Case 01 / 03</div>
                <p id="missionText">What was the name of that tiny restaurant where the pie was excellent?</p>
                <p class="mission-status" id="missionStatus">Find the right memory, then open it.</p>
            </section>
            <div class="side-title">Cabinets</div>
            <div class="filters" id="filters"></div>
            <div class="cabinet" aria-hidden="true" id="cabinet"></div>
        </aside>

        <section class="main">
            <div class="toolbar">
                <div class="search-wrap">
                    <span class="search-icon" aria-hidden="true">⌕</span>
                    <input id="search" type="search" autocomplete="off" spellcheck="false" aria-label="Search archive" placeholder="Try: pie, yellow car, from:mila…">
                    <button id="clear" aria-label="Clear search">×</button>
                </div>
                <button class="random-btn" id="lucky">I REMEMBER SOMETHING</button>
            </div>
            <div class="result-head">
                <span class="result-label">Ranked recollections</span>
                <span id="count"></span>
            </div>
            <div class="results" id="results" aria-live="polite"></div>
            <div class="tipbar"><b>ARCHIVIST’S TIP:</b> search ordinary fragments. Your past rarely remembers its own filename.</div>
        </section>
    </main>

    <section class="afterword">
        <h2>A perfect memory has peculiar furniture.</h2>
        <div>
            <p class="quote">“Combined with a utility like Slogger which saves to disk every webpage you view, it's like an infinite recall system, a perfect memory. It's scary.”</p>
            <p>Jon wrote that in 2006 while trying X1 desktop search. This little room makes the idea tangible: the magic is not neatly filing everything. It is being able to retrieve a half-remembered detail from the mess.</p>
        </div>
    </section>
    <footer class="footer">
        <a href="./">← All Chloe Reads Jon experiments</a>
        <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener">Inspired by Jon’s “Trying out X1 desktop search” ↗</a>
    </footer>
</div>

<script>
const archive = [
 {id:1,type:'email',date:'2005-03-14',title:'Sunday lunch with David',text:'Raymond’s on King Street. The fries were crisp, but the lemon meringue pie was the real event.',from:'Mila',tags:['food','friends']},
 {id:2,type:'note',date:'2004-10-02',title:'Restaurants worth returning to',text:'Raymond’s: excellent pie, cheerful booths, no pretension. Try the coconut cream next time.',from:'Jon',tags:['food','list']},
 {id:3,type:'web',date:'2006-01-19',title:'A strangely convincing desk setup',text:'Split keyboard made from K’nex pieces. Ridiculous in appearance, surprisingly comfortable in use.',from:'Web clipping',tags:['tools','ergonomics']},
 {id:4,type:'photo',date:'2003-08-22',title:'Parking lot after the picnic',text:'A bright yellow 1974 Volkswagen Thing beside the picnic tables. Nathan would call it a safari car.',from:'Camera',tags:['cars','family']},
 {id:5,type:'email',date:'2006-05-07',title:'Re: the yellow car',text:'It was a Volkswagen Thing, not a Beetle. Doors like biscuit tins. Absolutely magnificent.',from:'David',tags:['cars','friends']},
 {id:6,type:'file',date:'2004-12-18',title:'christmas-trumpet-notes.txt',text:'Joy to the World opening fanfare: start confidently, breathe before the high phrase, do not panic.',from:'Jon',tags:['music','church']},
 {id:7,type:'web',date:'2005-11-03',title:'Jersey stripes as wall paint',text:'A bedroom could borrow three strong bands from a favourite sports jersey without looking like a locker room.',from:'Web clipping',tags:['design','home']},
 {id:8,type:'note',date:'2006-07-28',title:'Books for the train',text:'The Ballad of the White Horse; The Everlasting Man; one mystery novel for palate cleansing.',from:'Jon',tags:['books','reading']},
 {id:9,type:'email',date:'2006-09-11',title:'Hotel exercise experiment',text:'Forgot the dance pad. Used downloadable DDR stepcharts with the hotel radio. Looked absurd. Worked perfectly.',from:'Jon',tags:['exercise','travel']},
 {id:10,type:'file',date:'2006-11-04',title:'mk.ahk',text:'FormatTime CurrentDateTime yyyyMMddHHmm. Make a throwaway directory and open it immediately.',from:'Jon',tags:['code','tools']},
 {id:11,type:'note',date:'2005-06-21',title:'Small inventions that remove friction',text:'Good utilities should feel like trapdoors: type two letters and the annoying setup work disappears.',from:'Jon',tags:['tools','ideas']},
 {id:12,type:'photo',date:'2002-12-26',title:'Boxing Day floor',text:'A half-built LEGO service station, red tow truck, three missing grey bricks, hot chocolate at the edge of frame.',from:'Camera',tags:['family','toys']},
 {id:13,type:'email',date:'2006-02-15',title:'One sentence I wanted to keep',text:'Attention is the rarest and purest form of generosity. Put this somewhere searchable.',from:'Mila',tags:['quotes','life']},
 {id:14,type:'web',date:'2006-08-03',title:'Map old photographs in Google Earth',text:'A personal history becomes startlingly vivid when every photo can return to its place.',from:'Web clipping',tags:['photos','memory']},
 {id:15,type:'file',date:'2005-09-19',title:'game-night-score.txt',text:'Do not merely chase wins. Try to improve the difference between your score and the other player’s score.',from:'Jon',tags:['games','friends']},
 {id:16,type:'note',date:'2006-10-09',title:'Things the Apple II taught me',text:'A blinking cursor is an invitation. The machine is waiting for you to make a small world.',from:'Jon',tags:['computers','childhood']}
];
const typeNames = {all:'All memories',email:'Mail',note:'Notes',web:'Web pages',file:'Files',photo:'Photos'};
const typeExt = {email:'MAIL',note:'NOTE',web:'WEB',file:'FILE',photo:'PIC'};
const missions = [
 {q:'What was the name of that tiny restaurant where the pie was excellent?', answers:[1,2], hint:'Try a remembered detail, not a title.'},
 {q:'What was that magnificent yellow car with the biscuit-tin doors?', answers:[4,5], hint:'Colour can be a perfectly good query.'},
 {q:'Find the sentence Mila said was worth keeping.', answers:[13], hint:'Try from:mila or one word from the thought.'}
];
let activeType = 'all', mission = 0, solved = new Set(), currentResults = archive;
const $ = s => document.querySelector(s);
const search = $('#search'), results = $('#results'), count = $('#count');

function escapeHtml(s) {
  return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[c]));
}
function highlight(text, terms) {
  let safe = escapeHtml(text);
  terms.filter(t => t.length > 1).forEach(term => {
    const clean = term.replace(/[.*+?^${}()|[\]\\]/g,'\\$&');
    safe = safe.replace(new RegExp(`(${clean})`,'ig'), '<mark>$1</mark>');
  });
  return safe;
}
function parseQuery(raw) {
  const from = raw.match(/from:("[^"]+"|\\S+)/i);
  return {
    from: from ? from[1].replaceAll('"','').toLowerCase() : '',
    terms: raw.replace(/from:("[^"]+"|\\S+)/ig,'').trim().toLowerCase().split(/\\s+/).filter(Boolean)
  };
}
function runSearch() {
  const query = parseQuery(search.value);
  currentResults = archive.map(item => {
    const hay = `${item.title} ${item.text} ${item.from} ${item.tags.join(' ')}`.toLowerCase();
    const matchesTerms = query.terms.every(t => hay.includes(t));
    const matchesFrom = !query.from || item.from.toLowerCase().includes(query.from);
    const matchesType = activeType === 'all' || item.type === activeType;
    let score = query.terms.reduce((n,t) => n + (item.title.toLowerCase().includes(t) ? 4 : 0) + (item.text.toLowerCase().includes(t) ? 2 : 0), 0);
    return {...item, score, visible: matchesTerms && matchesFrom && matchesType};
  }).filter(x => x.visible).sort((a,b) => b.score-a.score || b.date.localeCompare(a.date));
  render(query.terms);
}
function render(terms=[]) {
  count.textContent = `${currentResults.length} OF ${archive.length} FOUND`;
  if (!currentResults.length) {
    results.innerHTML = `<div class="empty"><strong>No recollection surfaced.</strong>Try fewer words. Human memory is fuzzy; search should be forgiving.</div>`;
    lightCabinet(0); return;
  }
  results.innerHTML = currentResults.map((item,i) => `
    <article class="result" data-id="${item.id}" tabindex="0" role="button" style="animation-delay:${Math.min(i*35,250)}ms" aria-label="Open ${escapeHtml(item.title)}">
      <div class="file-icon">${typeExt[item.type]}</div>
      <div>
        <h3>${highlight(item.title,terms)}</h3>
        <p>${highlight(item.text,terms)}</p>
        <span class="tag">${item.tags.join(' · ')}</span>
      </div>
      <div class="meta">${item.date}<br>${escapeHtml(item.from)}</div>
    </article>`).join('');
  document.querySelectorAll('.result').forEach(el => {
    const open = () => checkMission(Number(el.dataset.id), el);
    el.addEventListener('click', open);
    el.addEventListener('keydown', e => { if(e.key==='Enter'||e.key===' '){e.preventDefault();open();} });
  });
  lightCabinet(currentResults.length);
}
function checkMission(id, el) {
  if (missions[mission].answers.includes(id)) {
    solved.add(mission);
    $('#missionStatus').textContent = '● MEMORY RECOVERED — CASE CLOSED';
    el.style.background = 'rgba(91,168,149,.13)';
    setTimeout(() => {
      if (mission < missions.length-1) { mission++; updateMission(); search.value=''; activeType='all'; drawFilters(); runSearch(); search.focus(); }
      else {
        $('#missionNo').textContent='ARCHIVE COMPLETE';
        $('#missionText').textContent='Three loose threads, pulled safely from the digital attic.';
        $('#missionStatus').textContent='Perfect recall: useful, uncanny, yours.';
      }
    }, 1100);
  } else {
    $('#missionStatus').textContent = 'Not this one. ' + missions[mission].hint;
    el.animate([{transform:'translateX(0)'},{transform:'translateX(4px)'},{transform:'translateX(0)'}],{duration:220});
  }
}
function updateMission() {
  $('#missionNo').textContent=`Case 0${mission+1} / 03`;
  $('#missionText').textContent=missions[mission].q;
  $('#missionStatus').textContent='Find the right memory, then open it.';
}
function drawFilters() {
  $('#filters').innerHTML = Object.keys(typeNames).map(type => {
    const n = type==='all' ? archive.length : archive.filter(x=>x.type===type).length;
    return `<button class="filter ${type===activeType?'active':''}" data-type="${type}">${typeNames[type]} <span>${String(n).padStart(2,'0')}</span></button>`;
  }).join('');
  document.querySelectorAll('.filter').forEach(btn => btn.onclick=()=>{activeType=btn.dataset.type;drawFilters();runSearch();});
}
function lightCabinet(n) {
  document.querySelectorAll('.drawer').forEach((d,i)=>d.classList.toggle('lit', i < n));
}
search.addEventListener('input', runSearch);
$('#clear').onclick=()=>{search.value='';runSearch();search.focus();};
$('#lucky').onclick=()=>{
  const words=['pie','yellow','from:mila','keyboard','christmas','photographs','LEGO','attention','DDR','Apple'];
  search.value=words[Math.floor(Math.random()*words.length)]; runSearch();
};
$('#cabinet').innerHTML = Array.from({length:16},()=>'<div class="drawer"></div>').join('');
drawFilters(); updateMission(); runSearch();
</script>
</body>
</html>
