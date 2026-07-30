<?php
declare(strict_types=1);
$sourceUrl = 'https://cooltoolsforcatholics.blogspot.com/2005/02/catholiccast-first-catholic-podcast.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#163a32">
    <title>CatholicCast Signal Studio</title>
    <style>
        :root {
            --ink: #192421;
            --cream: #f3e6c8;
            --paper: #fff8e7;
            --green: #163a32;
            --green-2: #245d4e;
            --orange: #ef6a32;
            --gold: #e4b94d;
            --red: #bd3b2f;
            --shadow: #0c201b;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            background:
                radial-gradient(circle at 16% 10%, rgba(239,106,50,.16), transparent 24rem),
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px),
                var(--green);
            background-size: auto, 24px 24px, 24px 24px, auto;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .14;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.32'/%3E%3C/svg%3E");
            mix-blend-mode: overlay;
            z-index: 10;
        }
        a { color: inherit; }
        button, input { font: inherit; }
        button { touch-action: manipulation; }
        .wrap { width: min(1160px, calc(100% - 28px)); margin: 0 auto; }
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 0 10px;
            color: var(--cream);
            font: 700 .74rem/1 "Courier New", monospace;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .back { text-decoration: none; border-bottom: 1px solid rgba(243,230,200,.5); padding-bottom: 4px; }
        .live-dot { display: inline-flex; align-items: center; gap: 8px; }
        .live-dot::before {
            content: ""; width: 8px; height: 8px; border-radius: 50%; background: var(--orange);
            box-shadow: 0 0 0 4px rgba(239,106,50,.15);
        }
        header {
            color: var(--cream);
            padding: 48px 0 34px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 22px;
            align-items: end;
        }
        .eyebrow { margin: 0 0 12px; color: var(--gold); font: 700 .82rem/1 "Courier New", monospace; letter-spacing: .16em; text-transform: uppercase; }
        h1 {
            margin: 0;
            max-width: 850px;
            font-family: Georgia, "Times New Roman", serif;
            font-weight: 900;
            font-size: clamp(3.15rem, 9vw, 7.6rem);
            line-height: .77;
            letter-spacing: -.075em;
        }
        h1 span { display: block; color: var(--orange); font-style: italic; margin-left: .65em; }
        .intro { max-width: 600px; margin: 26px 0 0; font: 1.05rem/1.6 Georgia, serif; color: rgba(255,248,231,.83); }
        .year {
            width: 116px; height: 116px; border: 2px dashed var(--gold); border-radius: 50%;
            display: grid; place-items: center; text-align: center; transform: rotate(7deg);
            font: 900 1.7rem/1 "Courier New", monospace; color: var(--gold);
        }
        .year small { display:block; font-size:.55rem; letter-spacing:.12em; margin-top:6px; }
        .console {
            position: relative;
            background: var(--cream);
            border: 4px solid var(--ink);
            border-radius: 22px 22px 8px 8px;
            box-shadow: 0 18px 0 var(--shadow), 0 35px 60px rgba(0,0,0,.3);
            overflow: hidden;
            margin-bottom: 70px;
        }
        .console::before {
            content: ""; position:absolute; inset:0; pointer-events:none;
            background: repeating-linear-gradient(92deg, transparent 0 18px, rgba(80,50,10,.025) 19px 20px);
        }
        .meter-strip {
            position: relative;
            display: grid;
            grid-template-columns: 1fr minmax(190px, 290px);
            gap: 18px;
            align-items: center;
            padding: 18px 22px;
            color: var(--paper);
            background: var(--ink);
            border-bottom: 4px solid #0d1614;
        }
        .wavebox { height: 58px; overflow: hidden; position:relative; border:1px solid #4d695f; background:#0b1714; }
        #wave { width:100%; height:100%; display:block; }
        .wave-label { position:absolute; top:5px; left:8px; z-index:2; color:var(--gold); font:700 .58rem "Courier New",monospace; letter-spacing:.12em; }
        .signal {
            display:grid; grid-template-columns: 1fr auto; gap:10px; align-items:center;
            font:700 .7rem "Courier New",monospace; letter-spacing:.1em;
        }
        .signal-track { height:12px; background:#07100e; border:1px solid #4d695f; padding:2px; }
        .signal-fill { height:100%; width:18%; background:linear-gradient(90deg,var(--gold),var(--orange)); transition:width .4s; }
        .desk {
            position: relative;
            display:grid;
            grid-template-columns: minmax(0,1.25fr) minmax(280px,.75fr);
            min-height: 540px;
        }
        .library { padding: 30px; border-right: 3px solid rgba(25,36,33,.25); }
        .section-head { display:flex; justify-content:space-between; gap:15px; align-items:end; margin-bottom:22px; }
        h2 { margin:0; font:900 clamp(1.6rem,3vw,2.5rem)/1 Georgia,serif; letter-spacing:-.035em; }
        .section-head p { max-width:270px; margin:0; font-size:.78rem; line-height:1.35; opacity:.65; }
        .cartridges { display:grid; grid-template-columns:repeat(2,minmax(0,1fr)); gap:13px; }
        .cartridge {
            --tape: #d8d0b8;
            position:relative;
            min-height:112px;
            padding:15px 16px 15px 78px;
            border:2px solid var(--ink);
            border-radius:7px 14px 14px 7px;
            background:var(--tape);
            color:var(--ink);
            text-align:left;
            cursor:pointer;
            box-shadow:inset 0 -7px rgba(0,0,0,.08), 3px 4px 0 rgba(25,36,33,.2);
            transition:transform .16s, box-shadow .16s, opacity .16s;
        }
        .cartridge:hover { transform:translateY(-3px) rotate(-.5deg); box-shadow:inset 0 -7px rgba(0,0,0,.08), 6px 8px 0 rgba(25,36,33,.18); }
        .cartridge:focus-visible { outline:4px solid var(--orange); outline-offset:3px; }
        .cartridge.used { opacity:.37; transform:scale(.97); cursor:not-allowed; }
        .reel {
            position:absolute; left:18px; top:26px; width:43px; height:43px; border:8px dotted var(--ink);
            border-radius:50%; background:var(--paper); box-shadow:inset 0 0 0 4px rgba(25,36,33,.25);
        }
        .cartridge strong { display:block; font:900 1rem Georgia,serif; }
        .cartridge small { display:block; margin-top:7px; font:700 .63rem/1.35 "Courier New",monospace; text-transform:uppercase; letter-spacing:.06em; }
        .cartridge[data-id="wonder"] { --tape:#f0b84e; }
        .cartridge[data-id="saint"] { --tape:#8dc5ae; }
        .cartridge[data-id="question"] { --tape:#e88c67; }
        .cartridge[data-id="prayer"] { --tape:#9eabc9; }
        .cartridge[data-id="field"] { --tape:#d5a8c1; }
        .cartridge[data-id="signoff"] { --tape:#b9b079; }
        .rack { padding:30px 26px; background:rgba(255,248,231,.55); }
        .rack-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; }
        .time { font:900 1.15rem "Courier New",monospace; color:var(--red); }
        .slots { display:grid; gap:9px; min-height:258px; }
        .slot {
            min-height:55px; border:2px dashed rgba(25,36,33,.35); border-radius:7px;
            display:flex; align-items:center; gap:10px; padding:8px 11px; transition:.2s;
        }
        .slot.filled { border-style:solid; background:var(--paper); box-shadow:2px 3px 0 rgba(25,36,33,.13); }
        .slot-num { width:25px; height:25px; display:grid; place-items:center; flex:0 0 auto; border-radius:50%; background:var(--ink); color:var(--paper); font:700 .7rem "Courier New",monospace; }
        .slot-copy { flex:1; }
        .slot-copy strong { display:block; font:800 .82rem Georgia,serif; }
        .slot-copy small { font:.58rem "Courier New",monospace; opacity:.62; }
        .remove { border:0; background:transparent; color:var(--red); font-size:1.1rem; cursor:pointer; padding:8px; }
        .empty-copy { font:italic .78rem Georgia,serif; opacity:.5; }
        .controls { margin-top:24px; border-top:2px solid rgba(25,36,33,.2); padding-top:20px; }
        .dials { display:grid; grid-template-columns:1fr 1fr; gap:15px; }
        label { display:block; font:700 .62rem "Courier New",monospace; text-transform:uppercase; letter-spacing:.08em; }
        input[type="range"] { width:100%; accent-color:var(--orange); margin-top:9px; }
        .broadcast {
            width:100%; margin-top:19px; padding:15px; border:2px solid var(--ink); border-radius:6px;
            background:var(--orange); color:#fff9e9; cursor:pointer;
            box-shadow:0 5px 0 #873325; font:900 .88rem "Courier New",monospace; letter-spacing:.1em; text-transform:uppercase;
        }
        .broadcast:hover { filter:brightness(1.08); }
        .broadcast:active { transform:translateY(4px); box-shadow:0 1px 0 #873325; }
        .broadcast:disabled { filter:grayscale(1); opacity:.5; cursor:not-allowed; }
        .transmission {
            position:relative; display:none; padding:30px; background:var(--orange); color:var(--paper); border-top:4px solid var(--ink);
            overflow:hidden;
        }
        .transmission.active { display:grid; grid-template-columns:1fr 1fr; gap:34px; animation:reveal .5s ease-out; }
        @keyframes reveal { from{opacity:0;transform:translateY(15px)} }
        .transmission h2 { font-size:clamp(2rem,5vw,4rem); }
        .transmission p { line-height:1.55; }
        .packet-lane {
            position:relative; min-height:170px; border:2px dashed rgba(255,255,255,.6); border-radius:90px;
            display:flex; align-items:center; justify-content:space-between; padding:25px;
        }
        .device { font-size:2.4rem; filter:drop-shadow(2px 3px 0 rgba(0,0,0,.2)); }
        .packet {
            position:absolute; left:55px; width:48px; height:58px; border-radius:6px; background:var(--paper); color:var(--orange);
            display:grid; place-items:center; font:900 .7rem "Courier New",monospace; box-shadow:3px 4px 0 rgba(0,0,0,.2);
        }
        .transmission.active .packet { animation:send 2.2s cubic-bezier(.55,.05,.28,1) infinite; }
        @keyframes send { 0%{left:55px;transform:rotate(-8deg)} 70%,100%{left:calc(100% - 100px);transform:rotate(8deg)} }
        .now-playing { margin-top:14px; font:700 .72rem/1.5 "Courier New",monospace; min-height:2.2em; }
        .source {
            color:var(--cream); padding:0 0 55px; text-align:center; font:italic 1rem/1.5 Georgia,serif;
        }
        .source a { color:var(--gold); text-underline-offset:4px; }
        @media (max-width:780px) {
            header { grid-template-columns:1fr; padding-top:34px; }
            .year { display:none; }
            .desk { grid-template-columns:1fr; }
            .library { border-right:0; border-bottom:3px solid rgba(25,36,33,.25); padding:24px 18px; }
            .rack { padding:24px 18px; }
            .transmission.active { grid-template-columns:1fr; }
        }
        @media (max-width:510px) {
            .wrap { width:min(100% - 18px,1160px); }
            .topbar { font-size:.64rem; }
            header { padding-bottom:24px; }
            h1 { font-size:clamp(3.1rem,20vw,5rem); }
            .intro { font-size:.94rem; }
            .meter-strip { grid-template-columns:1fr; padding:14px; }
            .cartridges { grid-template-columns:1fr; }
            .cartridge { min-height:92px; }
            .section-head { align-items:start; flex-direction:column; }
            .dials { grid-template-columns:1fr; }
        }
        @media (prefers-reduced-motion:reduce) {
            *,*::before,*::after { animation-duration:.01ms!important; animation-iteration-count:1!important; scroll-behavior:auto!important; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <nav class="topbar" aria-label="Page navigation">
            <a class="back" href="./">← Chloe Reads Jon</a>
            <span class="live-dot">Internet radio workshop</span>
        </nav>
        <header>
            <div>
                <p class="eyebrow">A pocket-sized broadcasting experiment</p>
                <h1>CatholicCast <span>Signal Studio</span></h1>
                <p class="intro">It’s 2005. Podcasts are wonderfully new, an MP3 player feels faintly miraculous, and a Catholic voice has just entered the feed. Build a tiny episode and send it skipping across the internet.</p>
            </div>
            <div class="year" aria-hidden="true">2005<small>WEB 2.0 ERA</small></div>
        </header>

        <main class="console">
            <div class="meter-strip">
                <div class="wavebox">
                    <span class="wave-label">PROGRAM AUDIO</span>
                    <canvas id="wave" aria-label="Animated audio waveform"></canvas>
                </div>
                <div class="signal">
                    <span>FEED SIGNAL</span><span id="signalText">18%</span>
                    <div class="signal-track"><div class="signal-fill" id="signalFill"></div></div>
                    <span>READY</span>
                </div>
            </div>

            <div class="desk">
                <section class="library">
                    <div class="section-head">
                        <h2>Segment cartridges</h2>
                        <p>Tap up to four. A good little show has curiosity, substance, and a reason to come back.</p>
                    </div>
                    <div class="cartridges" id="cartridges"></div>
                </section>

                <aside class="rack">
                    <div class="rack-top">
                        <h2>Your episode</h2>
                        <span class="time" id="time">00:00</span>
                    </div>
                    <div class="slots" id="slots" aria-live="polite"></div>
                    <div class="controls">
                        <div class="dials">
                            <label>Analogue warmth <span id="warmValue">62</span>
                                <input id="warmth" type="range" min="0" max="100" value="62">
                            </label>
                            <label>Host energy <span id="energyValue">55</span>
                                <input id="energy" type="range" min="0" max="100" value="55">
                            </label>
                        </div>
                        <button class="broadcast" id="broadcast" disabled>Load a cartridge first</button>
                    </div>
                </aside>
            </div>

            <section class="transmission" id="transmission" aria-live="polite">
                <div>
                    <p class="eyebrow" style="color:#fff8e7">Now syndicating</p>
                    <h2 id="episodeTitle">A Small Signal of Hope</h2>
                    <p>Your home-made episode has become an enclosure in an RSS feed: a modest bit of XML telling faraway podcatchers where the audio lives. No algorithmic courtship required.</p>
                    <div class="now-playing" id="nowPlaying"></div>
                    <button class="broadcast" id="stop" style="background:#163a32;box-shadow:0 5px 0 #0c201b">Stop transmission</button>
                </div>
                <div class="packet-lane" aria-label="RSS packet travelling from studio to MP3 player">
                    <span class="device" aria-hidden="true">🎙️</span>
                    <span class="packet">RSS<br>MP3</span>
                    <span class="device" aria-hidden="true">🎧</span>
                </div>
            </section>
        </main>

        <footer class="source">
            Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>" target="_blank" rel="noopener">“CatholicCast: The First Catholic Podcast”</a>, posted when podcasting still needed a parenthetical explanation.
        </footer>
    </div>

    <script>
    (() => {
        const segments = [
            {id:'wonder', title:'Small Wonder', duration:55, note:'Find grace in one ordinary thing', line:'Today’s small wonder: a kindness noticed before it disappeared.'},
            {id:'saint', title:'Saint in Sixty', duration:60, note:'A vivid life, no marble pedestal required', line:'Meet a saint who chose courage in the middle of ordinary trouble.'},
            {id:'question', title:'Nathan’s Big Question', duration:75, note:'One excellent question, honestly explored', line:'The big question: why can doing the right thing still feel difficult?'},
            {id:'prayer', title:'One-Minute Examen', duration:60, note:'Notice, thank, ask, begin again', line:'Pause. What brought light today, and where might tomorrow need more love?'},
            {id:'field', title:'Field Recording', duration:45, note:'Rain, church bells, kettle, neighbourhood', line:'Listen closely: the world has been making an episode without us.'},
            {id:'signoff', title:'Pocket Benediction', duration:25, note:'A warm ending for the road ahead', line:'May your next small task be done with attention, humour, and love.'}
        ];
        let queue = [];
        let playing = false;
        let audioCtx = null;
        let timer = null;
        let audioNodes = [];

        const cartridges = document.querySelector('#cartridges');
        const slots = document.querySelector('#slots');
        const time = document.querySelector('#time');
        const broadcast = document.querySelector('#broadcast');
        const transmission = document.querySelector('#transmission');
        const nowPlaying = document.querySelector('#nowPlaying');
        const signalFill = document.querySelector('#signalFill');
        const signalText = document.querySelector('#signalText');

        function renderCartridges() {
            cartridges.innerHTML = segments.map(s => `
                <button class="cartridge ${queue.some(q=>q.id===s.id)?'used':''}" data-id="${s.id}" ${queue.some(q=>q.id===s.id)?'disabled':''}>
                    <span class="reel" aria-hidden="true"></span>
                    <strong>${s.title}</strong><small>${s.note} · ${s.duration} sec</small>
                </button>`).join('');
            cartridges.querySelectorAll('.cartridge:not(.used)').forEach(btn => btn.addEventListener('click', () => add(btn.dataset.id)));
        }

        function renderSlots() {
            slots.innerHTML = Array.from({length:4}, (_,i) => {
                const s = queue[i];
                return s ? `<div class="slot filled"><span class="slot-num">${i+1}</span><span class="slot-copy"><strong>${s.title}</strong><small>${s.duration} seconds · queued</small></span><button class="remove" data-i="${i}" aria-label="Remove ${s.title}">×</button></div>`
                    : `<div class="slot"><span class="slot-num">${i+1}</span><span class="empty-copy">${i===0?'Slide in your opening segment':'Empty tape bay'}</span></div>`;
            }).join('');
            slots.querySelectorAll('.remove').forEach(btn => btn.addEventListener('click', () => remove(Number(btn.dataset.i))));
            const total = queue.reduce((n,s)=>n+s.duration,0);
            time.textContent = `${String(Math.floor(total/60)).padStart(2,'0')}:${String(total%60).padStart(2,'0')}`;
            const strength = Math.min(96, 18 + queue.length * 19);
            signalFill.style.width = strength + '%';
            signalText.textContent = strength + '%';
            broadcast.disabled = !queue.length;
            broadcast.textContent = queue.length ? `Transmit ${queue.length} segment${queue.length>1?'s':''}` : 'Load a cartridge first';
        }

        function add(id) {
            if(queue.length >= 4) {
                slots.animate([{transform:'translateX(-5px)'},{transform:'translateX(5px)'},{transform:'translateX(0)'}],{duration:220});
                return;
            }
            queue.push(segments.find(s=>s.id===id));
            clickSound(280 + queue.length*70);
            render();
        }
        function remove(i) { queue.splice(i,1); clickSound(190); render(); }
        function render(){ renderCartridges(); renderSlots(); }

        function ensureAudio() {
            audioCtx ||= new (window.AudioContext || window.webkitAudioContext)();
            if(audioCtx.state === 'suspended') audioCtx.resume();
            return audioCtx;
        }
        function clickSound(freq) {
            const ctx=ensureAudio(), osc=ctx.createOscillator(), gain=ctx.createGain();
            osc.type='triangle'; osc.frequency.setValueAtTime(freq,ctx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(freq*.72,ctx.currentTime+.08);
            gain.gain.setValueAtTime(.045,ctx.currentTime); gain.gain.exponentialRampToValueAtTime(.001,ctx.currentTime+.09);
            osc.connect(gain).connect(ctx.destination); osc.start(); osc.stop(ctx.currentTime+.1);
        }
        function ident() {
            const ctx=ensureAudio();
            [392,523.25,659.25,783.99].forEach((freq,i)=>{
                const osc=ctx.createOscillator(), gain=ctx.createGain();
                osc.type='sine'; osc.frequency.value=freq;
                gain.gain.setValueAtTime(0,ctx.currentTime+i*.13);
                gain.gain.linearRampToValueAtTime(.07,ctx.currentTime+i*.13+.025);
                gain.gain.exponentialRampToValueAtTime(.001,ctx.currentTime+i*.13+.65);
                osc.connect(gain).connect(ctx.destination); osc.start(ctx.currentTime+i*.13); osc.stop(ctx.currentTime+i*.13+.7);
                audioNodes.push(osc);
            });
        }
        function speak(index=0) {
            if(!playing || index>=queue.length) {
                if(playing) nowPlaying.textContent='Transmission complete · feed successfully updated';
                return;
            }
            const s=queue[index];
            nowPlaying.textContent=`ON AIR ${String(index+1).padStart(2,'0')} / ${String(queue.length).padStart(2,'0')}  ·  ${s.title}`;
            if('speechSynthesis' in window) {
                const utter=new SpeechSynthesisUtterance(s.line);
                utter.rate=.82 + Number(document.querySelector('#energy').value)/210;
                utter.pitch=.82 + Number(document.querySelector('#warmth').value)/500;
                utter.onend=()=>{ if(playing) timer=setTimeout(()=>speak(index+1),500); };
                speechSynthesis.speak(utter);
            } else timer=setTimeout(()=>speak(index+1),2800);
        }
        function start() {
            if(!queue.length) return;
            playing=true;
            transmission.classList.add('active');
            document.querySelector('#episodeTitle').textContent = episodeName();
            ident();
            setTimeout(()=>speak(0),650);
            transmission.scrollIntoView({behavior:'smooth',block:'nearest'});
        }
        function stop() {
            playing=false; clearTimeout(timer);
            if('speechSynthesis' in window) speechSynthesis.cancel();
            audioNodes.forEach(n=>{try{n.stop()}catch(e){}}); audioNodes=[];
            transmission.classList.remove('active');
            nowPlaying.textContent='';
        }
        function episodeName() {
            const hasPrayer=queue.some(s=>s.id==='prayer'||s.id==='signoff');
            const names = hasPrayer ? ['A Frequency of Grace','The Ordinary Light','Good News for the Road'] : ['The Wonder Receiver','Questions in the Air','A Small Signal'];
            return names[(queue.length + Number(document.querySelector('#warmth').value>60)) % names.length];
        }

        ['warmth','energy'].forEach(id=>{
            const input=document.querySelector('#'+id), out=document.querySelector('#'+id+'Value');
            input.addEventListener('input',()=>out.textContent=input.value);
        });
        broadcast.addEventListener('click',start);
        document.querySelector('#stop').addEventListener('click',stop);

        const canvas=document.querySelector('#wave'), ctx=canvas.getContext('2d');
        let phase=0;
        function drawWave() {
            const dpr=window.devicePixelRatio||1, rect=canvas.getBoundingClientRect();
            if(canvas.width!==Math.floor(rect.width*dpr)){canvas.width=Math.floor(rect.width*dpr);canvas.height=Math.floor(rect.height*dpr);}
            ctx.clearRect(0,0,canvas.width,canvas.height);
            ctx.strokeStyle=playing?'#ef6a32':'#e4b94d'; ctx.lineWidth=2*dpr; ctx.beginPath();
            const amp=(playing?18:4)*dpr, mid=canvas.height/2;
            for(let x=0;x<canvas.width;x+=3*dpr){
                const y=mid + Math.sin(x/(15*dpr)+phase)*amp*(.45+.55*Math.sin(x/(43*dpr)+phase*.7)**2);
                x===0?ctx.moveTo(x,y):ctx.lineTo(x,y);
            }
            ctx.stroke(); phase+=playing?.16:.035; requestAnimationFrame(drawWave);
        }
        render(); drawWave();
    })();
    </script>
</body>
</html>
