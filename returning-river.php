<?php
$sourceTitle = 'A conversation with Danny';
$sourceUrl = 'https://jona.ca/2004/07/conversation-with-danny.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#102f37">
    <title>The Returning River</title>
    <style>
        :root {
            --ink:#102f37; --deep:#09232b; --paper:#f5edda; --cream:#fff9ea;
            --rust:#a84427; --teal:#0e6a70; --gold:#e9b65a; --moss:#61704b;
            --display:'Iowan Old Style','Palatino Linotype',Palatino,Georgia,serif;
            --mono:'Courier Prime','Courier New',monospace;
        }
        * { box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body {
            margin:0; color:var(--ink); background:
                radial-gradient(circle at 12% 0%, rgba(233,182,90,.2), transparent 28rem),
                #e8dfca;
            font-family:Georgia, 'Times New Roman', serif;
        }
        body::before { content:""; position:fixed; inset:0; pointer-events:none; opacity:.24; mix-blend-mode:multiply; z-index:20;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.16'/%3E%3C/svg%3E"); }
        a { color:inherit; }
        .topbar { width:min(1180px, calc(100% - 32px)); margin:18px auto; display:flex; justify-content:space-between; align-items:center; font-family:var(--mono); font-size:.72rem; letter-spacing:.08em; text-transform:uppercase; }
        .topbar a { text-decoration:none; border-bottom:1px solid currentColor; padding-bottom:3px; }
        .season-mark { display:flex; align-items:center; gap:9px; }
        .season-mark::before { content:""; width:26px; height:1px; background:var(--rust); }
        main { width:min(1180px, calc(100% - 24px)); margin:auto; }
        .hero { min-height:calc(100vh - 76px); display:grid; grid-template-columns:minmax(280px,.82fr) 1.65fr; gap:clamp(22px,4vw,64px); align-items:center; padding:36px 0 72px; }
        .eyebrow { font-family:var(--mono); color:var(--rust); text-transform:uppercase; letter-spacing:.13em; font-size:.73rem; font-weight:500; margin:0 0 18px; }
        h1 { font-family:var(--display); font-size:clamp(3.4rem,7vw,7.5rem); line-height:.82; letter-spacing:-.055em; margin:0; font-weight:800; }
        h1 em { color:var(--teal); font-weight:600; }
        .intro { max-width:35rem; line-height:1.68; font-size:clamp(1rem,1.5vw,1.2rem); margin:28px 0; }
        .begin { display:inline-flex; align-items:center; gap:12px; background:var(--ink); color:var(--cream); padding:15px 19px; text-decoration:none; font-family:var(--mono); font-size:.76rem; text-transform:uppercase; letter-spacing:.08em; box-shadow:5px 5px 0 var(--gold); transition:.2s; }
        .begin:hover { transform:translate(3px,3px); box-shadow:2px 2px 0 var(--gold); }
        .art-wrap { position:relative; transform:rotate(1.2deg); }
        .art-wrap::before { content:""; position:absolute; inset:12px -12px -12px 12px; border:1px solid rgba(16,47,55,.55); z-index:-1; }
        .art { display:block; width:100%; aspect-ratio:3/2; object-fit:cover; box-shadow:0 28px 70px rgba(15,36,39,.25); filter:saturate(.9) contrast(.98); }
        .caption { position:absolute; right:-7px; bottom:18px; background:var(--cream); padding:9px 13px; font:500 .67rem var(--mono); text-transform:uppercase; letter-spacing:.09em; }
        .journey { background:var(--deep); color:var(--paper); margin-left:calc(50% - 50vw); margin-right:calc(50% - 50vw); padding:90px max(20px, calc((100vw - 1120px)/2)) 110px; position:relative; overflow:hidden; }
        .journey::before { content:""; position:absolute; inset:0; opacity:.13; background:url('returning-river.webp') center/cover; filter:blur(18px); transform:scale(1.1); }
        .journey > * { position:relative; }
        .journey-head { display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; border-bottom:1px solid rgba(245,237,218,.22); padding-bottom:34px; }
        h2 { font:600 clamp(2.3rem,5vw,5rem)/.95 var(--display); letter-spacing:-.04em; margin:0; }
        .journey-head p { margin:0; line-height:1.65; color:#c9c2ae; max-width:37rem; }
        .river-stage { margin-top:44px; display:grid; grid-template-columns:minmax(260px,.85fr) minmax(360px,1.45fr); gap:clamp(28px,5vw,72px); }
        .map { position:sticky; top:22px; align-self:start; border:1px solid rgba(245,237,218,.25); padding:10px; background:#0c2930; box-shadow:18px 18px 0 rgba(0,0,0,.13); }
        .map-scene { position:relative; overflow:hidden; aspect-ratio:3/2; }
        .map img { width:100%; height:100%; object-fit:cover; display:block; opacity:.74; transition:filter .7s, transform .7s; }
        .map.active img { filter:saturate(1.15) brightness(1.02); transform:scale(1.015); }
        .boat { position:absolute; width:28px; height:19px; filter:drop-shadow(0 3px 2px rgba(0,0,0,.5)); transition:left 1s cubic-bezier(.2,.8,.2,1), top 1s cubic-bezier(.2,.8,.2,1), transform .5s; }
        .boat::before { content:""; position:absolute; inset:0; clip-path:polygon(0 40%,48% 63%,100% 35%,80% 100%,20% 100%); background:currentColor; }
        .boat.a { color:#e0643f; left:14%; top:65%; }
        .boat.b { color:#43b4b7; left:76%; top:72%; transform:scaleX(-1); }
        .map-legend { display:flex; justify-content:space-between; gap:14px; padding:12px 4px 3px; font:400 .64rem var(--mono); color:#b8b29f; text-transform:uppercase; letter-spacing:.08em; }
        .distance { color:var(--gold); }
        .chapter { display:none; animation:rise .55s both; }
        .chapter.active { display:block; }
        @keyframes rise { from { opacity:0; transform:translateY(15px); } }
        .chapter-no { font:500 .7rem var(--mono); color:var(--gold); text-transform:uppercase; letter-spacing:.12em; }
        .chapter h3 { font:600 clamp(2rem,3.5vw,3.7rem)/1 var(--display); margin:15px 0; letter-spacing:-.035em; }
        .chapter-copy { color:#c9c2ae; line-height:1.7; max-width:38rem; font-size:1.05rem; }
        .prompt { font-style:italic; color:var(--cream); margin:28px 0 14px; }
        .memory-input { width:100%; max-width:520px; border:0; border-bottom:1px solid rgba(245,237,218,.45); background:transparent; color:var(--cream); padding:12px 0; font:600 1.3rem var(--display); outline:0; }
        .memory-input:focus { border-color:var(--gold); }
        .choices { display:grid; grid-template-columns:1fr 1fr; gap:13px; margin-top:25px; max-width:680px; }
        .choice { text-align:left; color:var(--paper); background:rgba(245,237,218,.055); border:1px solid rgba(245,237,218,.25); padding:20px; min-height:122px; cursor:pointer; transition:.22s; font:inherit; }
        .choice:hover, .choice:focus-visible { transform:translateY(-3px); background:rgba(245,237,218,.12); border-color:var(--gold); outline:none; }
        .choice strong { display:block; font:600 1.17rem var(--display); margin-bottom:8px; color:var(--cream); }
        .choice span { display:block; color:#aaa895; line-height:1.45; font-size:.88rem; }
        .note-card { background:var(--paper); color:var(--ink); padding:clamp(24px,4vw,46px); max-width:680px; transform:rotate(-.5deg); box-shadow:14px 17px 0 rgba(0,0,0,.2); margin-top:26px; position:relative; }
        .note-card::after { content:""; position:absolute; width:54px; height:80px; right:30px; top:-18px; background:rgba(233,182,90,.47); transform:rotate(5deg); mix-blend-mode:multiply; }
        .note-card .small { font:500 .65rem var(--mono); text-transform:uppercase; letter-spacing:.12em; color:var(--rust); }
        .note-card blockquote { font:600 clamp(1.25rem,2.4vw,2rem)/1.4 var(--display); margin:18px 0 24px; }
        .copy-note, .again { border:0; cursor:pointer; background:var(--rust); color:white; padding:12px 15px; font:500 .68rem var(--mono); text-transform:uppercase; letter-spacing:.08em; margin:3px; }
        .again { background:var(--ink); }
        .progress { display:flex; gap:7px; margin-top:35px; }
        .progress i { display:block; width:28px; height:3px; background:rgba(245,237,218,.22); transition:.4s; }
        .progress i.done { background:var(--gold); }
        footer { text-align:center; padding:52px 20px 70px; line-height:1.7; font-size:.93rem; }
        footer a { text-underline-offset:4px; }
        @media (max-width:800px) {
            .hero { grid-template-columns:1fr; min-height:0; padding-top:42px; }
            .art-wrap { width:93%; margin:8px auto 0; }
            .journey-head, .river-stage { grid-template-columns:1fr; }
            .map { position:relative; top:auto; }
            .choices { grid-template-columns:1fr; }
            .journey { padding-top:64px; }
        }
        @media (prefers-reduced-motion:reduce) { * { scroll-behavior:auto!important; animation:none!important; transition:none!important; } }
    </style>
</head>
<body>
    <nav class="topbar"><a href="./">← Chloe Reads Jon</a><span class="season-mark">Field note 142</span></nav>
    <main>
        <section class="hero">
            <div>
                <p class="eyebrow">A small experiment in returning</p>
                <h1>The<br><em>Returning</em><br>River</h1>
                <p class="intro">Some friendships are roads. Others are rivers: they turn, disappear behind trees, freeze over, and somehow meet the same sea. Take two paper boats through four seasons of distance.</p>
                <a class="begin" href="#journey">Put the boats in the water <span>↓</span></a>
            </div>
            <figure class="art-wrap">
                <img class="art" src="returning-river.webp" alt="Two paper boats travelling along a painted river through four seasons toward a lantern-lit pool">
                <figcaption class="caption">Original river study · 2026</figcaption>
            </figure>
        </section>
        <section class="journey" id="journey">
            <div class="journey-head">
                <h2>No score.<br>Only current.</h2>
                <p>Choose the truest response, not the most virtuous-looking one. The boats will move either way. Rivers are mercifully uninterested in perfect performances.</p>
            </div>
            <div class="river-stage">
                <aside class="map" aria-label="The boats' journey map">
                    <div class="map-scene">
                        <img src="returning-river.webp" alt="">
                        <span class="boat a" aria-hidden="true"></span><span class="boat b" aria-hidden="true"></span>
                    </div>
                    <div class="map-legend"><span>Spring → winter</span><span class="distance">Many bends apart</span></div>
                </aside>
                <div class="chapters">
                    <article class="chapter active" data-step="0">
                        <span class="chapter-no">Before the first bend</span>
                        <h3>Name what still floats.</h3>
                        <p class="chapter-copy">A friendship can go quiet without becoming empty. Give the boat one thing worth carrying: a joke, a meal, a ridiculous adventure, or the moment someone stayed.</p>
                        <p class="prompt">What memory would you put aboard?</p>
                        <input class="memory-input" id="memory" maxlength="70" placeholder="That time we…" autocomplete="off">
                        <div class="choices"><button class="choice" data-pull="1"><strong>Launch it, unfinished</strong><span>A fragment is enough. The river supplies punctuation.</span></button></div>
                    </article>
                    <article class="chapter" data-step="1">
                        <span class="chapter-no">Spring · The wide bend</span><h3>The silence has grown teeth.</h3>
                        <p class="chapter-copy">You think of the friend unexpectedly. There is no occasion, no clever opening, and no guarantee the old ease is still there.</p>
                        <div class="choices">
                            <button class="choice" data-pull="2"><strong>Send the small hello</strong><span>“Thought of you today.” Nothing to defend, nothing to sell.</span></button>
                            <button class="choice" data-pull="0"><strong>Wait for perfect words</strong><span>Surely they will arrive on a white horse with excellent timing.</span></button>
                        </div>
                    </article>
                    <article class="chapter" data-step="2">
                        <span class="chapter-no">Summer · The stony crossing</span><h3>An old hurt surfaces.</h3>
                        <p class="chapter-copy">The current changes. You remember why the boats separated, and the remembered conversation begins making its closing argument.</p>
                        <div class="choices">
                            <button class="choice" data-pull="2"><strong>Name it without a verdict</strong><span>Tell the truth about the bruise without turning a person into the blow.</span></button>
                            <button class="choice" data-pull="-1"><strong>Build the courtroom again</strong><span>Bring exhibits. Polish the speech. Win magnificently and alone.</span></button>
                        </div>
                    </article>
                    <article class="chapter" data-step="3">
                        <span class="chapter-no">Autumn · The divided channel</span><h3>Their answer is different now.</h3>
                        <p class="chapter-copy">Time has edited both of you. The familiar voice carries unfamiliar convictions, losses, loyalties, and weather.</p>
                        <div class="choices">
                            <button class="choice" data-pull="2"><strong>Meet the person who arrived</strong><span>Curiosity makes a larger table than nostalgia does.</span></button>
                            <button class="choice" data-pull="0"><strong>Ask for the old version back</strong><span>Keep knocking on a house they no longer live in.</span></button>
                        </div>
                    </article>
                    <article class="chapter" data-step="4">
                        <span class="chapter-no">Winter · The lantern pool</span><h3>Come to the water.</h3>
                        <p class="chapter-copy">Not every return restores what was. Some enemies become friends; some friends remain distant. But thirst is honest, and the water does not demand a résumé.</p>
                        <div class="choices">
                            <button class="choice" data-pull="2"><strong>Offer water, not terms</strong><span>Leave a simple door open, with room on both sides.</span></button>
                            <button class="choice" data-pull="1"><strong>Bless the farther bank</strong><span>Release the friendship without making its goodness retroactively false.</span></button>
                        </div>
                    </article>
                    <article class="chapter" data-step="5">
                        <span class="chapter-no">A message in a bottle</span><h3>The river writes back.</h3>
                        <div class="note-card">
                            <span class="small">For an old friend</span>
                            <blockquote id="noteText"></blockquote>
                            <button class="copy-note" id="copy">Copy the note</button><button class="again" id="again">Sail again</button>
                        </div>
                    </article>
                    <div class="progress" aria-label="Journey progress"><i class="done"></i><i></i><i></i><i></i><i></i><i></i></div>
                </div>
            </div>
        </section>
    </main>
    <footer>Made from a few lines about friendship, distance, and thirst.<br>Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($sourceTitle) ?></a>.</footer>
    <script>
        const chapters=[...document.querySelectorAll('.chapter')], dots=[...document.querySelectorAll('.progress i')];
        const boatA=document.querySelector('.boat.a'), boatB=document.querySelector('.boat.b'), distance=document.querySelector('.distance'), map=document.querySelector('.map');
        let step=0, current=0, memory='';
        const routesA=[[14,65],[25,54],[37,58],[49,47],[61,58],[68,71]];
        const routesB=[[76,72],[72,67],[68,61],[65,62],[70,68],[69,72]];
        const labels=['Many bends apart','A signal on the water','The current is listening','One river, two histories','Lanterns ahead','At the same water'];
        function show(n){
            step=n; chapters.forEach((c,i)=>c.classList.toggle('active',i===n)); dots.forEach((d,i)=>d.classList.toggle('done',i<=n));
            const a=routesA[n], b=routesB[n]; boatA.style.left=a[0]+'%'; boatA.style.top=a[1]+'%'; boatB.style.left=b[0]+'%'; boatB.style.top=b[1]+'%';
            distance.textContent=labels[n]; map.classList.add('active'); setTimeout(()=>map.classList.remove('active'),800);
            if(n===5) finish();
        }
        document.querySelectorAll('.choice').forEach(btn=>btn.addEventListener('click',()=>{
            if(step===0){ memory=document.getElementById('memory').value.trim() || 'that ordinary, golden thing we still remember'; }
            current += Number(btn.dataset.pull||0); show(Math.min(5,step+1));
        }));
        function finish(){
            const openings=current>=7?'I was remembering '+memory+'. I’m grateful that the river once put us on the same bend.':current>=4?'I thought of '+memory+'. No grand speech, just a small hello from my side of the river.':'I’ve been thinking about '+memory+'. I don’t know what shape friendship takes from here, but I’m glad that part was real.';
            document.getElementById('noteText').textContent=openings+' If you are ever thirsty, there is water here.';
        }
        document.getElementById('copy').addEventListener('click',async e=>{ await navigator.clipboard.writeText(document.getElementById('noteText').textContent); e.target.textContent='Copied to the bottle'; setTimeout(()=>e.target.textContent='Copy the note',1600); });
        document.getElementById('again').addEventListener('click',()=>{ current=0; memory=''; document.getElementById('memory').value=''; show(0); });
    </script>
</body>
</html>
