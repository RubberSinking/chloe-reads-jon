<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sources of Beauty</title>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --bg: #f8f4ef;
    --card-bg: #ffffff;
    --text: #2a2118;
    --muted: #7a6e63;
    --accent: #c4946a;
    --accent2: #8b6b4a;
    --shadow: rgba(0,0,0,0.08);
    --radius: 20px;
}

body {
    font-family: 'Georgia', serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 24px 16px 48px;
}

header {
    text-align: center;
    margin-bottom: 28px;
    max-width: 520px;
}

header h1 {
    font-size: 1.9em;
    font-weight: normal;
    letter-spacing: 0.5px;
    color: var(--text);
    margin-bottom: 6px;
}

header p {
    font-size: 0.92em;
    color: var(--muted);
    font-style: italic;
    line-height: 1.5;
}

.day-label {
    font-size: 0.78em;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--accent);
    margin-bottom: 4px;
    font-family: system-ui, sans-serif;
}

/* -------- CARD -------- */
.card-wrapper {
    width: 100%;
    max-width: 520px;
    perspective: 1000px;
    margin-bottom: 24px;
}

.card {
    background: var(--card-bg);
    border-radius: var(--radius);
    box-shadow: 0 4px 28px var(--shadow);
    overflow: hidden;
    transition: transform 0.35s ease, opacity 0.35s ease;
}

.card.fade-out { opacity: 0; transform: translateY(10px); }
.card.fade-in  { opacity: 0; transform: translateY(-10px); animation: fadeIn 0.4s ease forwards; }

@keyframes fadeIn {
    to { opacity: 1; transform: translateY(0); }
}

/* art area */
.art-area {
    width: 100%;
    height: 220px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* -------- SVG / CSS ART -------- */

/* 1. Landscape */
.art-landscape { background: linear-gradient(to bottom, #c2dff5 0%, #87bcd9 40%, #6da88a 65%, #4c8a5c 100%); }
.sun { position: absolute; top: 28px; right: 60px; width: 54px; height: 54px; background: radial-gradient(circle, #fff9c4 40%, #ffe07a 70%, transparent 100%); border-radius: 50%; box-shadow: 0 0 40px 20px rgba(255,224,100,0.35); animation: sunPulse 4s ease-in-out infinite; }
@keyframes sunPulse { 0%,100%{box-shadow:0 0 40px 20px rgba(255,224,100,0.35)} 50%{box-shadow:0 0 60px 30px rgba(255,224,100,0.55)} }
.mountain { position: absolute; bottom: 0; }
.m1 { left: -20px; width: 0; height: 0; border-left: 90px solid transparent; border-right: 90px solid transparent; border-bottom: 110px solid #6b9d7a; }
.m2 { left: 80px; width: 0; height: 0; border-left: 110px solid transparent; border-right: 110px solid transparent; border-bottom: 140px solid #5c8c69; }
.m3 { right: -10px; width: 0; height: 0; border-left: 80px solid transparent; border-right: 80px solid transparent; border-bottom: 100px solid #709e7e; }
.cloud { position: absolute; background: rgba(255,255,255,0.82); border-radius: 40px; }
.c1 { width: 80px; height: 24px; top: 55px; left: 40px; animation: cloudDrift 18s linear infinite; }
.c2 { width: 56px; height: 18px; top: 45px; left: 220px; animation: cloudDrift 24s linear infinite 5s; }
.c1::before, .c2::before { content:''; position:absolute; background:rgba(255,255,255,0.82); border-radius:50%; }
.c1::before { width:40px; height:40px; top:-20px; left:20px; }
.c2::before { width:28px; height:28px; top:-14px; left:14px; }
@keyframes cloudDrift { 0%{transform:translateX(0)} 100%{transform:translateX(400px)} }
.bird { position: absolute; top: 68px; left: 160px; font-size: 1.1em; animation: birdFly 12s ease-in-out infinite; }
@keyframes birdFly { 0%,100%{transform:translateY(0) translateX(0)} 50%{transform:translateY(-12px) translateX(30px)} }

/* 2. Classical Art / Painting */
.art-painting { background: #2a1e0f; display:flex; align-items:center; justify-content:center; }
.canvas-frame { border: 12px solid #8b6914; box-shadow: 0 0 0 3px #c49a2a, inset 0 0 20px rgba(0,0,0,0.4); width: 180px; height: 160px; background: #e8dcc4; position: relative; overflow: hidden; border-radius: 2px; }
.painting-sky { position:absolute; top:0; left:0; right:0; height:55%; background:linear-gradient(to bottom,#7bb3d4,#b8d4e8); }
.painting-ground { position:absolute; bottom:0; left:0; right:0; height:45%; background:linear-gradient(to bottom,#7a9e5c,#5c7a42); }
.painting-tree { position:absolute; bottom:30%; left:50%; transform:translateX(-50%); }
.tree-trunk { width:8px; height:40px; background:#5c3a1a; margin:0 auto; }
.tree-top { width:0; height:0; border-left:28px solid transparent; border-right:28px solid transparent; border-bottom:46px solid #3a6b2a; margin-top:-6px; }
.painting-figure { position:absolute; bottom:30%; right:22%; width:10px; }
.fig-head { width:10px; height:10px; background:#e8c09a; border-radius:50%; margin:0 auto; }
.fig-body { width:8px; height:18px; background:#4a3a8a; margin:1px auto 0; border-radius:2px; }
.painting-vignette { position:absolute; inset:0; background:radial-gradient(ellipse at center, transparent 60%, rgba(0,0,0,0.3) 100%); }

/* 3. Architecture / Cathedral */
.art-architecture { background: linear-gradient(to bottom, #1a1a2e 0%, #2d1b4e 100%); }
.cathedral { position:absolute; bottom:0; left:50%; transform:translateX(-50%); }
.cath-body { width:120px; height:100px; background:#3a2a5a; margin:0 auto; border-radius:4px 4px 0 0; }
.cath-tower-l, .cath-tower-r { width:36px; height:130px; background:#2e2248; position:absolute; bottom:0; border-radius:3px 3px 0 0; }
.cath-tower-l { left:-18px; }
.cath-tower-r { right:-18px; }
.cath-spire-l, .cath-spire-r { width:0; height:0; border-left:18px solid transparent; border-right:18px solid transparent; position:absolute; top:-36px; left:0; }
.cath-spire-l { border-bottom:36px solid #c4a434; }
.cath-spire-r { border-bottom:36px solid #c4a434; }
.cath-rose { position:absolute; top:18px; left:50%; transform:translateX(-50%); width:32px; height:32px; background:rgba(255,200,80,0.15); border:2px solid rgba(255,200,80,0.5); border-radius:50%; display:flex; align-items:center; justify-content:center; }
.cath-rose::after { content:'✛'; color:rgba(255,200,80,0.7); font-size:0.7em; }
.cath-arch { position:absolute; bottom:0; left:50%; transform:translateX(-50%); width:28px; height:40px; background:#1a0d30; border-radius:14px 14px 0 0; }
.cath-windows { position:absolute; top:10px; width:100%; display:flex; justify-content:space-evenly; }
.cath-win { width:10px; height:20px; background:rgba(255,200,80,0.25); border-radius:5px 5px 0 0; animation:winGlow 3s ease-in-out infinite alternate; }
@keyframes winGlow { from{background:rgba(255,200,80,0.15)} to{background:rgba(255,200,80,0.4)} }
.stars { position:absolute; top:0; left:0; right:0; height:140px; }
.star { position:absolute; background:white; border-radius:50%; animation:twinkle 2s ease-in-out infinite; }
@keyframes twinkle { 0%,100%{opacity:0.9} 50%{opacity:0.3} }

/* 4. Nature photography */
.art-nature { background:linear-gradient(160deg, #0d2b0d 0%, #1a4a1a 40%, #0a1a0a 100%); position:relative; overflow:hidden; }
.firefly { position:absolute; width:5px; height:5px; border-radius:50%; background:#d4ff80; box-shadow:0 0 8px 4px rgba(180,255,80,0.6); animation:flyAround 6s ease-in-out infinite; }
@keyframes flyAround { 0%{transform:translate(0,0);opacity:0} 20%{opacity:1} 80%{opacity:1} 100%{transform:translate(var(--dx),var(--dy));opacity:0} }
.fern { position:absolute; bottom:0; }
.fern svg path { fill:#1a5a1a; }
.moonlight { position:absolute; top:10px; left:50%; transform:translateX(-50%); width:44px; height:44px; background:radial-gradient(circle,#fffde0 20%,#e8f4e0 50%,transparent 80%); border-radius:50%; box-shadow:0 0 30px 15px rgba(200,255,180,0.2); }
.forest-floor { position:absolute; bottom:0; left:0; right:0; height:60px; background:linear-gradient(to top,#0a1a0a,transparent); }

/* 5. Music */
.art-music { background:linear-gradient(135deg,#1a0533 0%,#2d0b4e 50%,#0d1a33 100%); }
.music-staff { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); width:300px; }
.staff-line { height:2px; background:rgba(255,255,255,0.2); margin:12px 0; }
.note { position:absolute; animation:noteFloat 3s ease-in-out infinite; }
@keyframes noteFloat { 0%,100%{transform:translateY(0) rotate(-10deg);opacity:0.8} 50%{transform:translateY(-15px) rotate(10deg);opacity:1} }
.treble { position:absolute; left:10px; top:30px; font-size:3em; color:rgba(200,150,255,0.7); }
.note-head { width:16px; height:12px; background:#d4a0ff; border-radius:50%; transform:rotate(-15deg); display:inline-block; box-shadow:0 0 8px rgba(200,150,255,0.6); }
.note-stem { width:2px; height:28px; background:#d4a0ff; display:inline-block; vertical-align:bottom; box-shadow:0 0 4px rgba(200,150,255,0.4); }
.bar-line { position:absolute; top:25px; width:2px; height:70px; background:rgba(255,255,255,0.15); }

/* 6. Poetry */
.art-poetry { background:linear-gradient(to bottom,#2a1a0a,#4a2e18); display:flex; align-items:center; justify-content:center; }
.poem-scroll { width:220px; background:#f5e8d0; border-radius:6px; padding:18px 20px; box-shadow:0 4px 20px rgba(0,0,0,0.4), inset 0 0 20px rgba(150,100,50,0.1); position:relative; }
.poem-scroll::before, .poem-scroll::after { content:''; position:absolute; left:0; right:0; height:22px; background:#d4b896; border-radius:6px; }
.poem-scroll::before { top:-8px; }
.poem-scroll::after { bottom:-8px; }
.poem-text { font-family:'Georgia',serif; font-size:0.78em; line-height:1.8; color:#3a2a12; text-align:center; font-style:italic; }
.poem-author { font-family:system-ui,sans-serif; font-size:0.68em; color:#7a5a2a; text-align:right; margin-top:8px; }

/* 7. Daily Saint */
.art-saint { background:radial-gradient(ellipse at 50% 30%,#3a2a5a 0%,#1a0e2e 70%); display:flex; align-items:center; justify-content:center; }
.halo { width:90px; height:90px; border-radius:50%; border:4px solid #d4af37; box-shadow:0 0 20px 8px rgba(212,175,55,0.4); display:flex; align-items:center; justify-content:center; animation:haloGlow 3s ease-in-out infinite; }
@keyframes haloGlow { 0%,100%{box-shadow:0 0 20px 8px rgba(212,175,55,0.4)} 50%{box-shadow:0 0 35px 15px rgba(212,175,55,0.65)} }
.saint-icon { font-size:2.8em; }
.saint-rays { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); }
.ray { position:absolute; width:1px; height:80px; background:linear-gradient(to top,transparent,rgba(212,175,55,0.25)); transform-origin:bottom center; }

/* 8. Everyday moment */
.art-everyday { background:linear-gradient(to bottom,#ffd4a0,#ffb870); display:flex; align-items:center; justify-content:center; }
.kitchen-scene { position:relative; width:200px; height:180px; }
.window { position:absolute; top:10px; left:50%; transform:translateX(-50%); width:80px; height:90px; background:linear-gradient(to bottom,#87bcd9,#c2dff5); border:4px solid #8b6b4a; border-radius:4px; }
.window-cross-v { position:absolute; top:0; left:50%; transform:translateX(-50%); width:4px; height:100%; background:#8b6b4a; }
.window-cross-h { position:absolute; top:50%; left:0; transform:translateY(-50%); width:100%; height:4px; background:#8b6b4a; }
.table { position:absolute; bottom:0; left:0; right:0; height:60px; background:#c49a6a; border-radius:4px 4px 0 0; }
.coffee-cup { position:absolute; bottom:52px; left:50%; transform:translateX(-60%); }
.cup-body { width:28px; height:24px; background:white; border:2px solid #c49a6a; border-radius:2px 2px 6px 6px; }
.cup-handle { position:absolute; right:-8px; top:6px; width:10px; height:12px; border:2px solid #c49a6a; border-left:none; border-radius:0 8px 8px 0; }
.steam { position:absolute; bottom:24px; }
.steam-line { display:inline-block; width:3px; height:12px; background:rgba(200,200,200,0.6); border-radius:2px; margin:0 2px; animation:steamRise 1.5s ease-in-out infinite; }
.steam-line:nth-child(2) { animation-delay:0.5s; }
.steam-line:nth-child(3) { animation-delay:1s; }
@keyframes steamRise { 0%{transform:translateY(0);opacity:0.6} 100%{transform:translateY(-14px);opacity:0} }
.breakfast-plate { position:absolute; bottom:50px; right:20%; width:44px; height:44px; background:#f5e8d0; border-radius:50%; border:3px solid #d4b896; }

/* -------- Card body -------- */
.card-body {
    padding: 24px 28px 28px;
}

.source-title {
    font-size: 1.35em;
    font-weight: normal;
    color: var(--text);
    margin-bottom: 4px;
    letter-spacing: 0.2px;
}

.source-subtitle {
    font-size: 0.82em;
    font-family: system-ui, sans-serif;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 16px;
}

.content-block {
    font-size: 0.97em;
    line-height: 1.75;
    color: #3a3028;
    margin-bottom: 18px;
}

.content-block em {
    color: var(--accent2);
    font-style: italic;
}

.reflection {
    background: #faf6f0;
    border-left: 3px solid var(--accent);
    padding: 12px 16px;
    border-radius: 0 8px 8px 0;
    font-size: 0.88em;
    color: var(--muted);
    line-height: 1.6;
    font-style: italic;
}

.reflection strong {
    font-style: normal;
    color: var(--accent2);
    font-size: 0.78em;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: block;
    margin-bottom: 4px;
    font-family: system-ui, sans-serif;
}

/* -------- NAVIGATION -------- */
.nav-row {
    display: flex;
    align-items: center;
    gap: 12px;
    max-width: 520px;
    width: 100%;
    margin-bottom: 20px;
}

.nav-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1.5px solid #d9cfc4;
    background: white;
    color: var(--text);
    font-size: 1.2em;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s, transform 0.15s;
    flex-shrink: 0;
}
.nav-btn:hover { background: #f0e8de; border-color: var(--accent); transform: scale(1.05); }
.nav-btn:active { transform: scale(0.96); }

.dots-row {
    display: flex;
    gap: 8px;
    flex: 1;
    justify-content: center;
    flex-wrap: wrap;
}

.dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    border: 1.5px solid #ccc4ba;
    background: transparent;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s, transform 0.15s;
}
.dot.active { background: var(--accent); border-color: var(--accent); }
.dot:hover { border-color: var(--accent); transform: scale(1.2); }

/* -------- TODAY button -------- */
.today-row {
    display: flex;
    justify-content: center;
    gap: 10px;
    max-width: 520px;
    width: 100%;
    margin-bottom: 12px;
    flex-wrap: wrap;
}

.pill-btn {
    padding: 9px 20px;
    border-radius: 100px;
    border: 1.5px solid var(--accent);
    background: white;
    color: var(--accent2);
    font-size: 0.85em;
    font-family: system-ui, sans-serif;
    cursor: pointer;
    letter-spacing: 0.3px;
    transition: background 0.2s, color 0.2s, transform 0.15s;
}
.pill-btn:hover { background: var(--accent); color: white; transform: scale(1.03); }
.pill-btn:active { transform: scale(0.97); }
.pill-btn.primary { background: var(--accent); color: white; }
.pill-btn.primary:hover { background: var(--accent2); }

/* -------- Attribution -------- */
.attribution {
    max-width: 520px;
    width: 100%;
    font-size: 0.78em;
    color: #bbb0a5;
    text-align: center;
    line-height: 1.6;
    font-family: system-ui, sans-serif;
    padding-top: 12px;
    border-top: 1px solid #e8e0d8;
}
.attribution a { color: #b0a090; text-decoration: underline; }
</style>
</head>
<body>

<header>
    <div class="day-label" id="todayLabel">Today</div>
    <h1>Sources of Beauty</h1>
    <p>A daily contemplation — one source of beauty, mindfully visited.</p>
</header>

<div class="card-wrapper">
    <div class="card" id="mainCard">
        <div class="art-area" id="artArea"></div>
        <div class="card-body">
            <div class="source-title" id="cardTitle"></div>
            <div class="source-subtitle" id="cardSubtitle"></div>
            <div class="content-block" id="cardContent"></div>
            <div class="reflection">
                <strong>Reflect</strong>
                <span id="cardReflection"></span>
            </div>
        </div>
    </div>
</div>

<div class="nav-row">
    <button class="nav-btn" id="prevBtn" title="Previous (←)">&#8592;</button>
    <div class="dots-row" id="dotsRow"></div>
    <button class="nav-btn" id="nextBtn" title="Next (→)">&#8594;</button>
</div>

<div class="today-row">
    <button class="pill-btn primary" id="todayBtn">&#9670; Today's Source</button>
    <button class="pill-btn" id="randomBtn">&#10022; Surprise Me</button>
</div>

<div class="attribution">
    Inspired by Jon's <a href="https://jona.ca/2026/03/sources-of-beauty.html" target="_blank">Sources of Beauty</a> post
    — Claude's suggestions for daily beauty, made interactive.
</div>

<script>
const SOURCES = [
    {
        id: 'landscape',
        title: 'A Beautiful Landscape',
        subtitle: 'The natural world at its grandest',
        art: `
            <div class="art-landscape" style="width:100%;height:100%;position:relative;">
                <div class="sun"></div>
                <div class="cloud c1"></div>
                <div class="cloud c2"></div>
                <div class="bird">🕊️</div>
                <div class="mountain m1" style="position:absolute;bottom:0;left:-20px;"></div>
                <div class="mountain m2" style="position:absolute;bottom:0;left:80px;"></div>
                <div class="mountain m3" style="position:absolute;bottom:0;right:-10px;"></div>
            </div>
        `,
        content: `There is a reason we stop at scenic overlooks and feel something we cannot quite name. The landscape does not ask anything of us — it simply <em>is</em>, on a scale that dwarfs our worries. Mountains shaped over millennia, light traveling 93 million miles to warm that ridge, clouds assembling themselves out of nothing. The grandeur is not indifferent; it feels, somehow, like a gift.`,
        reflection: `When did you last stop and really look at the sky — not through a window or a screen, but outside, unhurried? What did you notice?`
    },
    {
        id: 'painting',
        title: 'A Piece of Classical Art',
        subtitle: 'The human hand, reaching across centuries',
        art: `
            <div class="art-painting" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                <div class="canvas-frame">
                    <div class="painting-sky"></div>
                    <div class="painting-ground"></div>
                    <div class="painting-tree">
                        <div class="tree-trunk"></div>
                        <div class="tree-top"></div>
                    </div>
                    <div class="painting-figure">
                        <div class="fig-head"></div>
                        <div class="fig-body"></div>
                    </div>
                    <div class="painting-vignette"></div>
                </div>
            </div>
        `,
        content: `Someone stood before a blank canvas — in Florence, in Amsterdam, in 1492 or 1665 — and poured everything they knew about light and shadow and the human face into a few square feet of pigment. Centuries later, we stand in front of it and feel a jolt of recognition. That is the miracle of classical art: not the technique, but the <em>contact</em>. The painter is reaching forward in time. We are reaching back.`,
        reflection: `Is there a painting or piece of art that has ever stopped you cold — one where you stood longer than you intended? What was it, and what did you feel?`
    },
    {
        id: 'architecture',
        title: 'Architecture',
        subtitle: 'The places that lift the soul',
        art: `
            <div class="art-architecture" style="width:100%;height:100%;position:relative;overflow:hidden;">
                <div class="stars" id="starsContainer"></div>
                <div class="cathedral" style="position:absolute;bottom:0;left:50%;transform:translateX(-50%);">
                    <div style="position:relative;">
                        <div class="cath-tower-l" style="position:absolute;bottom:0;left:-18px;">
                            <div class="cath-spire-l" style="position:absolute;top:-36px;left:0;width:0;height:0;border-left:18px solid transparent;border-right:18px solid transparent;border-bottom:36px solid #c4a434;"></div>
                        </div>
                        <div class="cath-tower-r" style="position:absolute;bottom:0;right:-18px;">
                            <div class="cath-spire-r" style="position:absolute;top:-36px;left:0;width:0;height:0;border-left:18px solid transparent;border-right:18px solid transparent;border-bottom:36px solid #c4a434;"></div>
                        </div>
                        <div class="cath-body">
                            <div class="cath-rose"></div>
                            <div class="cath-windows">
                                <div class="cath-win"></div>
                                <div class="cath-win" style="animation-delay:0.8s"></div>
                                <div class="cath-win" style="animation-delay:1.6s"></div>
                            </div>
                            <div class="cath-arch"></div>
                        </div>
                    </div>
                </div>
            </div>
        `,
        content: `A cathedral is an argument in stone: that beauty matters, that heaven is worth building toward, that a community can pour a hundred years of labor into something they will never see finished. When you step inside and your eyes are pulled upward, that is not an accident — it is engineering in service of transcendence. The vault says: <em>there is more than this</em>. The light through stained glass says: <em>the ordinary can be made sacred</em>.`,
        reflection: `What building have you entered that made you feel differently — smaller, more peaceful, more alive? What was it about that space?`
    },
    {
        id: 'nature',
        title: 'Nature Photography',
        subtitle: 'The quiet world, made visible',
        art: `
            <div class="art-nature" style="width:100%;height:100%;position:relative;">
                <div class="moonlight"></div>
                <div id="firefliesContainer"></div>
                <div style="position:absolute;bottom:0;left:0;right:0;height:80px;background:linear-gradient(to top,#0a1a0a 40%,transparent);"></div>
                <div style="position:absolute;bottom:10px;left:10px;font-size:2.2em;">🌿</div>
                <div style="position:absolute;bottom:10px;right:15px;font-size:1.8em;">🌿</div>
                <div style="position:absolute;bottom:5px;left:35%;font-size:1.4em;">🌱</div>
                <div style="position:absolute;top:60px;left:20px;font-size:1em;color:rgba(180,220,140,0.5);">✦</div>
                <div style="position:absolute;top:40px;right:40px;font-size:0.8em;color:rgba(180,220,140,0.5);">✦</div>
                <div style="position:absolute;top:90px;left:45%;font-size:0.7em;color:rgba(180,220,140,0.4);">✦</div>
            </div>
        `,
        content: `Nature photography does something telescopes and nature documentaries cannot quite do: it slows the world down to one frame. A dew drop on a spider's thread. A fox, caught mid-step, turning to look at the camera. A storm front over the prairie, the light going green. The photograph says: <em>I was here. This moment was real. It was beautiful.</em> Looking at it, we share the photographer's astonishment — the world is stranger and more exquisite than we usually notice.`,
        reflection: `What small piece of nature have you encountered recently — a bird, a cloud, an insect — that surprised or delighted you, even briefly?`
    },
    {
        id: 'music',
        title: 'Music',
        subtitle: 'The art that lives in time',
        art: `
            <div class="art-music" style="width:100%;height:100%;position:relative;overflow:hidden;">
                <div class="treble">𝄞</div>
                <div class="music-staff" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:85%;padding:0 40px;">
                    <div class="staff-line"></div>
                    <div class="staff-line"></div>
                    <div class="staff-line"></div>
                    <div class="staff-line"></div>
                    <div class="staff-line"></div>
                </div>
                <div id="notesContainer"></div>
                <div class="bar-line" style="left:33%;"></div>
                <div class="bar-line" style="left:66%;"></div>
            </div>
        `,
        content: `Music does not exist anywhere in the physical world. It is vibrations in air, electrical signals in neurons, patterns in time. And yet somehow, four bars of a Bach cello suite can stop the breath. A song you haven't heard in twenty years can collapse the distance to a moment you thought you'd lost. <em>Music is the art that affects us before we understand why.</em> It bypasses argument and moves directly into the body, into memory, into whatever part of us knows things we cannot explain.`,
        reflection: `What piece of music — a song, a symphony, anything — do you return to when you need to feel something real? Why does it reach you?`
    },
    {
        id: 'poetry',
        title: 'A Short Poem',
        subtitle: 'Language pressed into its finest shape',
        art: `
            <div class="art-poetry" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                <div class="poem-scroll">
                    <div class="poem-text">
                        "This is my letter to the world,<br>
                        That never wrote to me —<br>
                        The simple news that Nature told,<br>
                        With tender majesty."
                    </div>
                    <div class="poem-author">— Emily Dickinson</div>
                </div>
            </div>
        `,
        content: `A good poem does something prose cannot: it <em>densifies</em> language until it holds more than its words. Every syllable matters. The line break is a gesture. The poem earns its white space. And somehow, in fourteen lines or four, it holds something true about being alive — grief, wonder, the strangeness of consciousness — that would take pages to fumble at in ordinary speech. Poetry is language doing its finest work, and reading it is a kind of practice in attention.`,
        reflection: `Is there a line of poetry — just a line or two — that has stayed with you? What is it, and why do you think it stayed?`
    },
    {
        id: 'saint',
        title: "Today's Saint",
        subtitle: 'A life made luminous',
        art: `
            <div class="art-saint" style="width:100%;height:100%;position:relative;display:flex;align-items:center;justify-content:center;">
                <div id="saintRays" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);"></div>
                <div class="halo">
                    <div class="saint-icon" id="saintIcon">✝️</div>
                </div>
            </div>
        `,
        content: `The saints are not monuments to impossible virtue. They were people — stubborn, sometimes difficult, sometimes afraid — who decided to take God seriously and kept deciding that, even when it cost them. Their lives are beautiful not because they were perfect, but because they were <em>aimed</em> at something. Reading a saint's story is a reminder that holiness is possible, that it looks different in every person, and that even the hardest life can end in light.`,
        reflection: `Which saint, if any, has ever felt like a companion to you — someone whose life or words arrived at the right moment? What did you learn from them?`
    },
    {
        id: 'everyday',
        title: 'Everyday Moments',
        subtitle: 'The sacred in the ordinary',
        art: `
            <div class="art-everyday" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                <div class="kitchen-scene">
                    <div class="window">
                        <div class="window-cross-v"></div>
                        <div class="window-cross-h"></div>
                    </div>
                    <div class="table"></div>
                    <div class="coffee-cup">
                        <div class="steam" style="display:flex;align-items:flex-end;">
                            <div class="steam-line"></div>
                            <div class="steam-line"></div>
                            <div class="steam-line"></div>
                        </div>
                        <div class="cup-body">
                            <div class="cup-handle"></div>
                        </div>
                    </div>
                    <div class="breakfast-plate"></div>
                </div>
            </div>
        `,
        content: `Your son's face at breakfast. The coffee going warm in your hands. The particular quality of light on a Tuesday morning when there is nothing exceptional scheduled. <em>These moments are not decoration around the real life — they are the real life.</em> The contemplative traditions have always known this: that holiness is not hidden in cathedrals and mountain peaks but in the ordinary, fully attended to. What makes a morning beautiful is not the sunrise. It is being present enough to see it.`,
        reflection: `When did you last notice something in your daily routine — really notice it — and feel something like gratitude or wonder? What was it?`
    }
];

// Today's index based on date
function getTodayIndex() {
    const now = new Date();
    const dayOfYear = Math.floor((now - new Date(now.getFullYear(), 0, 0)) / 86400000);
    return dayOfYear % SOURCES.length;
}

let currentIndex = getTodayIndex();

function buildStars() {
    const c = document.getElementById('starsContainer');
    if (!c) return;
    for (let i = 0; i < 30; i++) {
        const s = document.createElement('div');
        s.className = 'star';
        s.style.cssText = `width:${1+Math.random()*2}px;height:${1+Math.random()*2}px;top:${Math.random()*100}%;left:${Math.random()*100}%;animation-delay:${Math.random()*3}s;animation-duration:${1.5+Math.random()*2}s`;
        c.appendChild(s);
    }
}

function buildFireflies() {
    const c = document.getElementById('firefliesContainer');
    if (!c) return;
    const colors = ['#d4ff80','#80ffaa','#aaff80','#d4ffa0'];
    for (let i = 0; i < 14; i++) {
        const f = document.createElement('div');
        f.className = 'firefly';
        const dx = (Math.random() - 0.5) * 200;
        const dy = (Math.random() - 0.5) * 150;
        f.style.cssText = `left:${10+Math.random()*80}%;top:${10+Math.random()*80}%;background:${colors[Math.floor(Math.random()*colors.length)]};animation-delay:${Math.random()*6}s;animation-duration:${4+Math.random()*5}s;--dx:${dx}px;--dy:${dy}px`;
        c.appendChild(f);
    }
}

function buildNotes() {
    const c = document.getElementById('notesContainer');
    if (!c) return;
    const positions = [
        { left: '18%', top: '35%' },
        { left: '32%', top: '55%' },
        { left: '48%', top: '30%' },
        { left: '62%', top: '50%' },
        { left: '76%', top: '38%' },
    ];
    const noteSymbols = ['♩','♪','♫','♬'];
    positions.forEach((pos, i) => {
        const n = document.createElement('div');
        n.style.cssText = `position:absolute;left:${pos.left};top:${pos.top};color:#d4a0ff;font-size:${1.4+Math.random()*0.8}em;animation:noteFloat ${2+Math.random()*2}s ease-in-out infinite;animation-delay:${i*0.4}s;text-shadow:0 0 8px rgba(200,150,255,0.6)`;
        n.textContent = noteSymbols[i % noteSymbols.length];
        c.appendChild(n);
    });
}

function buildSaintRays() {
    const c = document.getElementById('saintRays');
    if (!c) return;
    for (let i = 0; i < 12; i++) {
        const r = document.createElement('div');
        r.className = 'ray';
        r.style.cssText = `transform:rotate(${i*30}deg) translateY(-80px);animation-delay:${i*0.25}s`;
        c.appendChild(r);
    }
}

// Get saint for today
const SAINTS = [
    { icon: '🌹', name: 'St. Thérèse of Lisieux — The Little Flower, who found holiness in small acts done with great love.' },
    { icon: '⚓', name: 'St. Nicholas — Bishop of Myra, whose secret generosity gave rise to centuries of gift-giving.' },
    { icon: '📖', name: 'St. Augustine — Who prayed "make me holy, but not yet" — and then was.' },
    { icon: '🏹', name: 'St. Sebastian — Soldier, martyr, and patron of athletes, who survived one execution only to seek another.' },
    { icon: '🕊️', name: 'St. Francis of Assisi — Who preached to birds and kissed lepers and rebuilt the Church, one stone at a time.' },
    { icon: '⚡', name: 'St. Thomas Aquinas — The Dumb Ox who filled libraries and then called it all "straw."' },
    { icon: '🔥', name: 'St. Joan of Arc — Teenager. Soldier. Mystic. Martyr. Patron of France, and of people told their calling is impossible.' },
    { icon: '⚓', name: 'St. Damien of Molokai — Who went to care for the lepers of Molokaʻi and never left.' },
];

function getSaintForToday() {
    const now = new Date();
    const day = Math.floor((now - new Date(now.getFullYear(), 0, 0)) / 86400000);
    return SAINTS[day % SAINTS.length];
}

function renderCard(idx, animate) {
    const src = SOURCES[idx];
    const card = document.getElementById('mainCard');

    function doRender() {
        document.getElementById('artArea').innerHTML = src.art;
        document.getElementById('cardTitle').textContent = src.title;
        document.getElementById('cardSubtitle').textContent = src.subtitle;
        document.getElementById('cardContent').innerHTML = src.content;
        document.getElementById('cardReflection').textContent = src.reflection;

        // post-render DOM work
        requestAnimationFrame(() => {
            if (src.id === 'architecture') buildStars();
            if (src.id === 'nature') buildFireflies();
            if (src.id === 'music') buildNotes();
            if (src.id === 'saint') {
                buildSaintRays();
                const saint = getSaintForToday();
                const icon = document.getElementById('saintIcon');
                if (icon) icon.textContent = saint.icon;
                const content = document.getElementById('cardContent');
                if (content) {
                    content.innerHTML = content.innerHTML.replace(
                        'Their lives are beautiful not because they were perfect',
                        `<strong style="color:#c49a2a;">${saint.name}</strong><br><br>The saints are not monuments to impossible virtue. They were people — stubborn, sometimes difficult, sometimes afraid — who decided to take God seriously and kept deciding that, even when it cost them. Their lives are beautiful not because they were perfect`
                    );
                }
            }
        });
    }

    if (animate) {
        card.classList.add('fade-out');
        setTimeout(() => {
            card.classList.remove('fade-out', 'fade-in');
            doRender();
            card.classList.add('fade-in');
        }, 280);
    } else {
        doRender();
    }

    // Update dots
    document.querySelectorAll('.dot').forEach((d, i) => {
        d.classList.toggle('active', i === idx);
    });

    // Update today label
    const todayIdx = getTodayIndex();
    const isToday = idx === todayIdx;
    const label = document.getElementById('todayLabel');
    const dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    const now = new Date();
    label.textContent = isToday ? `Today · ${dayNames[now.getDay()]}` : src.subtitle.split(' ').slice(0,3).join(' ') + '…';
}

function buildDots() {
    const row = document.getElementById('dotsRow');
    row.innerHTML = '';
    SOURCES.forEach((_, i) => {
        const d = document.createElement('button');
        d.className = 'dot' + (i === currentIndex ? ' active' : '');
        d.title = SOURCES[i].title;
        d.setAttribute('aria-label', SOURCES[i].title);
        d.addEventListener('click', () => {
            if (i !== currentIndex) {
                currentIndex = i;
                renderCard(currentIndex, true);
            }
        });
        row.appendChild(d);
    });
}

document.getElementById('prevBtn').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + SOURCES.length) % SOURCES.length;
    renderCard(currentIndex, true);
});

document.getElementById('nextBtn').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % SOURCES.length;
    renderCard(currentIndex, true);
});

document.getElementById('todayBtn').addEventListener('click', () => {
    currentIndex = getTodayIndex();
    renderCard(currentIndex, true);
});

document.getElementById('randomBtn').addEventListener('click', () => {
    let r;
    do { r = Math.floor(Math.random() * SOURCES.length); } while (r === currentIndex && SOURCES.length > 1);
    currentIndex = r;
    renderCard(currentIndex, true);
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        currentIndex = (currentIndex - 1 + SOURCES.length) % SOURCES.length;
        renderCard(currentIndex, true);
    } else if (e.key === 'ArrowRight') {
        currentIndex = (currentIndex + 1) % SOURCES.length;
        renderCard(currentIndex, true);
    }
});

// Init
buildDots();
renderCard(currentIndex, false);
</script>
</body>
</html>
