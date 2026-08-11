<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#111514">
    <title>Equivalence Cartographer</title>
    <style>
        :root { --ink:#111514; --paper:#e9e1cd; --cream:#fff8e8; --amber:#f0a51a; --cyan:#26c7d9; --red:#ff5d45; --muted:#a79f8b; }
        * { box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { margin:0; color:var(--paper); background:var(--ink); font-family:'Cascadia Mono','Liberation Mono',monospace; min-height:100vh; }
        body::before { content:""; position:fixed; inset:0; pointer-events:none; opacity:.16; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.35'/%3E%3C/svg%3E"); z-index:20; mix-blend-mode:soft-light; }
        a { color:inherit; }
        .topbar { display:flex; justify-content:space-between; align-items:center; gap:1rem; padding:18px clamp(18px,4vw,56px); border-bottom:1px solid #ffffff24; text-transform:uppercase; letter-spacing:.12em; font-size:.7rem; }
        .topbar a { text-decoration:none; }
        .status { display:flex; align-items:center; gap:9px; color:var(--muted); }
        .status::before { content:""; width:8px; height:8px; border-radius:50%; background:var(--cyan); box-shadow:0 0 14px var(--cyan); }
        header { min-height:75vh; display:grid; grid-template-columns:minmax(0,1fr) minmax(320px,1.05fr); align-items:center; overflow:hidden; border-bottom:1px solid #ffffff24; }
        .hero-copy { padding:clamp(50px,8vw,120px) clamp(22px,6vw,90px); position:relative; z-index:2; }
        .kicker { color:var(--amber); text-transform:uppercase; letter-spacing:.2em; font-size:.72rem; margin-bottom:1.4rem; }
        h1 { font-family:'Iowan Old Style','Baskerville','Palatino Linotype',serif; font-size:clamp(3.2rem,7.6vw,8rem); line-height:.82; letter-spacing:-.055em; margin:0; max-width:850px; }
        h1 em { display:block; color:var(--cyan); font-style:normal; }
        .intro { max-width:590px; color:#cfc7b6; line-height:1.75; margin:2rem 0; font-size:clamp(.88rem,1.2vw,1.02rem); }
        .start { display:inline-flex; align-items:center; gap:12px; background:var(--paper); color:var(--ink); padding:15px 20px; text-decoration:none; text-transform:uppercase; letter-spacing:.1em; font-size:.72rem; font-weight:500; box-shadow:7px 7px 0 var(--amber); transition:.2s; }
        .start:hover { transform:translate(3px,3px); box-shadow:4px 4px 0 var(--amber); }
        .hero-art { min-height:75vh; background:url('equivalence-cartographer.webp') center/cover; position:relative; border-left:1px solid #ffffff24; }
        .hero-art::after { content:"ONE GAP REMAINS"; position:absolute; right:18px; bottom:18px; padding:8px 10px; color:var(--red); background:#111514d9; border:1px solid var(--red); font-size:.64rem; letter-spacing:.14em; }
        main { max-width:1240px; margin:auto; padding:clamp(60px,9vw,120px) clamp(18px,4vw,48px); }
        .section-head { display:grid; grid-template-columns:1fr 1fr; gap:30px; margin-bottom:44px; align-items:end; }
        h2 { font-family:'Iowan Old Style','Baskerville','Palatino Linotype',serif; font-size:clamp(2.4rem,5vw,5rem); line-height:.95; margin:0; letter-spacing:-.04em; }
        .section-head p { color:var(--muted); line-height:1.65; margin:0; max-width:520px; }
        .map { border:1px solid #ffffff2c; background:#0b0e0dc9; box-shadow:0 25px 90px #0009; }
        .map-head { display:grid; grid-template-columns:1fr 80px 1fr; border-bottom:1px solid #ffffff24; }
        .feature { padding:18px 22px; text-transform:uppercase; font-size:.72rem; letter-spacing:.14em; }
        .feature.a { color:var(--amber); } .feature.b { color:var(--cyan); text-align:right; }
        .bridge-label { display:grid; place-items:center; color:var(--muted); border-inline:1px solid #ffffff24; font-size:.6rem; }
        .rows { padding:12px; }
        .pair { display:grid; grid-template-columns:minmax(0,1fr) 80px minmax(0,1fr); min-height:76px; opacity:0; transform:translateY(10px); animation:arrive .45s forwards; animation-delay:calc(var(--i) * .08s); }
        @keyframes arrive { to { opacity:1; transform:none; } }
        .node { appearance:none; border:0; border-bottom:1px solid #ffffff14; color:var(--paper); background:transparent; padding:15px 12px; font:inherit; text-align:left; cursor:pointer; display:flex; flex-direction:column; justify-content:center; gap:6px; transition:.18s; min-width:0; }
        .node.right { text-align:right; align-items:flex-end; }
        .node:hover,.node.selected { background:#ffffff09; }
        .node.selected.left { box-shadow:inset 4px 0 var(--amber); }
        .node.selected.right { box-shadow:inset -4px 0 var(--cyan); }
        .node.mapped { color:#7e7a6d; cursor:default; }
        .node b { font-size:.82rem; font-weight:500; overflow:hidden; text-overflow:ellipsis; max-width:100%; }
        .node small { color:#797568; font-size:.62rem; }
        .link { display:grid; place-items:center; position:relative; color:#4b4a43; font-size:1.15rem; }
        .link::before,.link::after { content:""; position:absolute; top:50%; height:1px; width:32%; background:#343630; }
        .link::before { left:0; } .link::after { right:0; }
        .pair.solved .link { color:var(--cyan); text-shadow:0 0 12px var(--cyan); }
        .pair.solved .link::before,.pair.solved .link::after { background:linear-gradient(90deg,var(--amber),var(--cyan)); }
        .node.decoy { color:#a19a89; }
        .map-foot { display:flex; justify-content:space-between; align-items:center; gap:15px; padding:18px 22px; border-top:1px solid #ffffff24; }
        #message { color:var(--muted); font-size:.72rem; line-height:1.5; }
        #progress { color:var(--cream); white-space:nowrap; }
        .workshop { margin-top:clamp(80px,12vw,150px); background:var(--paper); color:var(--ink); display:grid; grid-template-columns:.75fr 1.25fr; }
        .work-copy { padding:clamp(28px,5vw,65px); border-right:1px solid #282b27; }
        .work-copy h2 { font-size:clamp(2.4rem,4.3vw,4.8rem); }
        .work-copy p { line-height:1.7; color:#56584e; }
        .recipe { margin-top:40px; padding-top:18px; border-top:2px solid var(--ink); font-size:.72rem; line-height:1.75; }
        .scanner { padding:clamp(25px,4vw,52px); background:#dcd2bb; }
        label { display:block; font-size:.67rem; text-transform:uppercase; letter-spacing:.12em; margin-bottom:8px; }
        .tokens { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        input,textarea { width:100%; border:1px solid #5e5d53; border-radius:0; background:#f7efdc; padding:12px; font:400 .78rem/1.5 'Cascadia Mono','Liberation Mono',monospace; color:var(--ink); outline:none; }
        input:focus,textarea:focus { box-shadow:0 0 0 3px var(--cyan); }
        textarea { min-height:235px; resize:vertical; margin-top:12px; }
        .scan-button { margin-top:12px; border:0; background:var(--ink); color:var(--cream); padding:14px 18px; font:500 .7rem 'Cascadia Mono','Liberation Mono',monospace; text-transform:uppercase; letter-spacing:.12em; cursor:pointer; }
        #report { margin-top:18px; display:none; border-top:2px solid var(--ink); padding-top:16px; }
        .report-line { display:grid; grid-template-columns:32px 1fr auto; gap:10px; align-items:start; padding:9px 0; border-bottom:1px solid #928c7d; font-size:.68rem; }
        .report-line.missing { color:#a0281a; }
        .tag { border:1px solid currentColor; padding:2px 5px; text-transform:uppercase; font-size:.55rem; }
        .source { margin:90px auto 0; max-width:760px; text-align:center; color:var(--muted); line-height:1.8; font-size:.8rem; }
        .source a { color:var(--paper); text-underline-offset:4px; }
        footer { padding:30px; text-align:center; font-size:.63rem; color:#6f6d64; text-transform:uppercase; letter-spacing:.13em; }
        @media (max-width:780px) {
            header { grid-template-columns:1fr; min-height:0; }
            .hero-copy { padding-top:70px; }
            .hero-art { min-height:52vw; border-left:0; border-top:1px solid #ffffff24; }
            .section-head,.workshop { grid-template-columns:1fr; }
            .work-copy { border-right:0; border-bottom:1px solid #282b27; }
            .section-head { align-items:start; }
            .map-head,.pair { grid-template-columns:minmax(0,1fr) 42px minmax(0,1fr); }
            .pair { min-height:90px; }
            .feature { padding:14px 10px; font-size:.58rem; }
            .bridge-label { font-size:0; }
            .node { padding:12px 5px; }
            .node b { font-size:.67rem; }
            .node small { font-size:.52rem; }
            .tokens { grid-template-columns:1fr; }
        }
        @media (prefers-reduced-motion:reduce) { * { scroll-behavior:auto!important; animation:none!important; transition:none!important; } .pair { opacity:1; transform:none; } }
    </style>
</head>
<body>
    <nav class="topbar"><a href="index.php">← Chloe Reads Jon</a><span class="status">mapping engine online</span></nav>
    <header>
        <div class="hero-copy">
            <div class="kicker">Feature migration instrument № 06</div>
            <h1>Equivalence <em>Cartographer</em></h1>
            <p class="intro">When feature Y resembles feature X, stop wandering the codebase. Trace every place X lives, build its twin, and let the missing bridge reveal itself.</p>
            <a class="start" href="#field-map">Map the feature <span>↓</span></a>
        </div>
        <div class="hero-art" role="img" aria-label="Two parallel software cities connected by paired lines, with one missing link"></div>
    </header>
    <main>
        <section id="field-map">
            <div class="section-head">
                <h2>Pair the implementation trail.</h2>
                <p>Select an amber Google +1 trace, then its cyan LinkedIn equivalent. Five pairs complete the feature. One cyan line is a plausible impostor.</p>
            </div>
            <div class="map">
                <div class="map-head"><div class="feature a">Existing feature X · googlePlusOne</div><div class="bridge-label">⇄</div><div class="feature b">New feature Y · linkedIn</div></div>
                <div class="rows" id="rows"></div>
                <div class="map-foot"><span id="message" aria-live="polite">Choose one trace from each side.</span><strong id="progress">0 / 5 mapped</strong></div>
            </div>
        </section>

        <section class="workshop">
            <div class="work-copy">
                <div class="kicker" style="color:#a25010">Bring your own code</div>
                <h2>Run the lantern.</h2>
                <p>Paste a compact code sample and name the old and new feature tokens. The scanner finds lines containing X and checks for a line with the equivalent Y substitution.</p>
                <div class="recipe"><strong>THE METHOD</strong><br>1. Find every line belonging to X.<br>2. Replace X with Y and look for its twin.<br>3. Implement whatever remains dark.<br>4. Review false positives with a human brain. Annoying, but still fashionable.</div>
            </div>
            <div class="scanner">
                <div class="tokens">
                    <div><label for="tokenX">Existing token · X</label><input id="tokenX" value="googlePlusOne" spellcheck="false"></div>
                    <div><label for="tokenY">New token · Y</label><input id="tokenY" value="linkedIn" spellcheck="false"></div>
                </div>
                <label for="code" style="margin-top:18px">Code sample</label>
                <textarea id="code" spellcheck="false">config.googlePlusOneEnabled = true;
config.linkedInEnabled = true;
renderSocialButton('googlePlusOne');
renderSocialButton('linkedIn');
trackClick('googlePlusOne');
trackClick('linkedIn');
styles.add('.googlePlusOne-button');
styles.add('.linkedIn-button');
help.register('googlePlusOne');</textarea>
                <button class="scan-button" id="scan">Scan for missing twins →</button>
                <div id="report" aria-live="polite"></div>
            </div>
        </section>

        <p class="source">This little instrument was inspired by Jon’s <a href="https://jona.ca/2014/05/programming-by-equivalence.html" target="_blank" rel="noopener">“Programming by Equivalence”</a>, a satisfyingly mechanical way to implement a sibling feature and know when the trail is complete.</p>
    </main>
    <footer>Designed and built by Chloe · 11 August 2026</footer>
    <script>
        const left = [
            {id:'config',file:'ConfigHelper.php',code:'googlePlusOneEnabled'},
            {id:'controller',file:'EntryController.php',code:'isGooglePlusOneEnabled()'},
            {id:'service',file:'EntryListService.php',code:'googlePlusOneEnabled'},
            {id:'transform',file:'MustacheTransformer.php',code:'googlePlusOneButton()'},
            {id:'template',file:'article/list.mustache',code:'googlePlusOneButtonHtml'}
        ];
        const right = [
            {id:'service',file:'EntryListService.php',code:'linkedInEnabled'},
            {id:'template',file:'article/list.mustache',code:'linkedInButtonHtml'},
            {id:'decoy',file:'ShareMenu.php',code:'linkedInLabel'},
            {id:'config',file:'ConfigHelper.php',code:'linkedInEnabled'},
            {id:'transform',file:'MustacheTransformer.php',code:'linkedInButton()'},
            {id:'controller',file:'EntryController.php',code:'isLinkedInEnabled()'}
        ];
        let chosenLeft=null, chosenRight=null, solved=new Set();
        const rows=document.querySelector('#rows');
        const max=Math.max(left.length,right.length);
        const button=(item,side)=>item ? `<button class="node ${side} ${item.id==='decoy'?'decoy':''}" data-side="${side}" data-id="${item.id}"><b>${item.code}</b><small>${item.file}</small></button>` : '<span></span>';
        for(let i=0;i<max;i++) rows.insertAdjacentHTML('beforeend',`<div class="pair" style="--i:${i}">${button(left[i],'left')}<div class="link">◇</div>${button(right[i],'right')}</div>`);
        rows.addEventListener('click',e=>{
            const node=e.target.closest('.node'); if(!node || node.classList.contains('mapped')) return;
            const side=node.dataset.side;
            document.querySelectorAll(`.node.${side}`).forEach(n=>n.classList.remove('selected'));
            node.classList.add('selected');
            if(side==='left') chosenLeft=node; else chosenRight=node;
            if(chosenLeft && chosenRight) checkPair();
        });
        function checkPair(){
            const ok=chosenLeft.dataset.id===chosenRight.dataset.id;
            const message=document.querySelector('#message');
            if(ok){
                const id=chosenLeft.dataset.id; solved.add(id);
                [chosenLeft,chosenRight].forEach(n=>{n.classList.remove('selected');n.classList.add('mapped')});
                chosenLeft.closest('.pair').classList.add('solved'); chosenRight.closest('.pair').classList.add('solved');
                message.textContent=solved.size===5?'Map complete. Every X trace has a Y twin. Ship it, after tests.':'Bridge locked. Keep tracing the feature.';
                document.querySelector('#progress').textContent=`${solved.size} / 5 mapped`;
            } else {
                message.textContent=chosenRight.dataset.id==='decoy'?'Plausible, but it has no amber ancestor. That is a false positive.':'Those live in different layers. Trace the filenames.';
                [chosenLeft,chosenRight].forEach(n=>{n.animate([{transform:'translateX(0)'},{transform:'translateX(-5px)'},{transform:'translateX(5px)'},{transform:'translateX(0)'}],{duration:260});n.classList.remove('selected')});
            }
            chosenLeft=chosenRight=null;
        }
        document.querySelector('#scan').addEventListener('click',()=>{
            const x=document.querySelector('#tokenX').value.trim(), y=document.querySelector('#tokenY').value.trim();
            const report=document.querySelector('#report'); report.style.display='block';
            if(!x||!y){ report.innerHTML='<strong>Both tokens need names.</strong>'; return; }
            const all=document.querySelector('#code').value.split(/\r?\n/).map(s=>s.trim()).filter(Boolean);
            const xLines=all.filter(line=>line.includes(x));
            if(!xLines.length){ report.innerHTML=`<strong>No lines contain “${escapeHtml(x)}”. The lantern found a very tidy darkness.</strong>`; return; }
            let missing=0;
            const lines=xLines.map((line,i)=>{
                const twin=line.split(x).join(y); const found=all.includes(twin); if(!found) missing++;
                return `<div class="report-line ${found?'':'missing'}"><span>${String(i+1).padStart(2,'0')}</span><span>${escapeHtml(line)}</span><span class="tag">${found?'paired':'missing'}</span></div>`;
            }).join('');
            report.innerHTML=`<strong>${missing?`${missing} missing twin${missing===1?'':'s'} found.`:'All traces have twins.'}</strong>${lines}`;
        });
        function escapeHtml(s){return s.replace(/[&<>'"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[c]));}
    </script>
</body>
</html>
