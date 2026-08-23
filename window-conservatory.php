<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0a1720">
  <title>The Window Conservatory</title>
  <style>
    :root {
      --night: #07131b;
      --deep: #0d2228;
      --glass: rgba(14, 34, 40, .82);
      --cream: #f4e7c5;
      --paper: #efe0ba;
      --ink: #252720;
      --moss: #7d9566;
      --brass: #d4a84f;
      --coral: #dc765e;
      --mist: #a9bbb3;
      --line: rgba(225, 206, 155, .2);
      --serif: Baskerville, "Iowan Old Style", "Palatino Linotype", serif;
      --label: "Copperplate Gothic Light", Copperplate, "Gill Sans", sans-serif;
    }
    * { box-sizing: border-box; }
    html { background: var(--night); scroll-behavior: smooth; }
    body { margin: 0; min-height: 100vh; color: var(--cream); background: var(--night); font-family: var(--serif); }
    button, input { font: inherit; }
    button { cursor: pointer; }
    a { color: inherit; }
    .grain { position: fixed; inset: 0; z-index: 50; opacity: .045; pointer-events: none; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E"); }

    .hero { position: relative; min-height: min(880px, 92vh); display: grid; align-items: end; overflow: hidden; background: #081724 url('window-conservatory-art.webp') center / cover no-repeat; }
    .hero::before { content: ""; position: absolute; inset: 0; background: linear-gradient(90deg, rgba(3, 12, 20, .92) 0%, rgba(3, 12, 20, .58) 35%, rgba(3, 12, 20, .08) 69%), linear-gradient(0deg, var(--night) 0%, transparent 42%); }
    .hero::after { content: ""; position: absolute; left: 7vw; top: 11vh; width: 1px; height: 25vh; background: linear-gradient(var(--brass), transparent); box-shadow: 5px 0 22px var(--brass); }
    .hero-copy { width: min(700px, 88vw); position: relative; z-index: 2; margin: 0 0 9vh 8vw; }
    .kicker, .tiny-label { font-family: var(--label); text-transform: uppercase; letter-spacing: .2em; font-size: .67rem; }
    .kicker { color: #eccb79; margin-bottom: 1.1rem; }
    h1 { font-size: clamp(4rem, 10vw, 9rem); font-weight: 400; letter-spacing: -.065em; line-height: .72; margin: 0; text-wrap: balance; text-shadow: 0 4px 40px #000; }
    h1 em { display: block; margin-left: .6em; color: var(--paper); font-weight: 400; }
    .lede { width: min(550px, 90%); font-size: clamp(1.05rem, 2vw, 1.35rem); line-height: 1.55; color: #d7dacb; margin: 2rem 0 1.6rem; }
    .enter { display: inline-flex; gap: .7rem; align-items: center; text-decoration: none; padding: .8rem 0; border-bottom: 1px solid var(--brass); color: #f3d68e; }
    .enter span { transition: transform .2s; }
    .enter:hover span { transform: translateX(5px); }

    main { width: min(1220px, calc(100% - 28px)); margin: 0 auto; padding: 76px 0 100px; }
    .prologue { display: grid; grid-template-columns: .7fr 1.3fr; gap: clamp(30px, 8vw, 120px); margin-bottom: 52px; align-items: start; }
    .prologue h2 { margin: 0; font-weight: 400; font-size: clamp(2.4rem, 5vw, 5.2rem); line-height: .9; letter-spacing: -.045em; }
    .prologue p { color: var(--mist); font-size: 1.08rem; line-height: 1.75; max-width: 660px; margin: 0; }
    .prologue strong { color: var(--cream); font-weight: 400; }

    .machine { border: 1px solid var(--line); background: linear-gradient(140deg, #102a2e, #08171e 60%); box-shadow: 0 35px 90px #0009; overflow: hidden; position: relative; }
    .machine-head { min-height: 70px; padding: 14px 18px; border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; gap: 18px; background: #091a20; }
    .brand { display: flex; gap: 11px; align-items: center; color: #e5ce91; }
    .cat-mark { width: 30px; height: 30px; border: 1px solid var(--brass); display: grid; place-items: center; transform: rotate(45deg); }
    .cat-mark span { transform: rotate(-45deg); }
    .status { color: var(--moss); display: flex; gap: 9px; align-items: center; }
    .lamp { width: 8px; height: 8px; border-radius: 50%; background: #bddb74; box-shadow: 0 0 14px #bddb74; animation: breathe 2.4s ease-in-out infinite; }
    @keyframes breathe { 50% { opacity: .35; } }

    .controls { display: grid; grid-template-columns: 1fr auto auto; align-items: center; gap: 26px; padding: 19px; border-bottom: 1px solid var(--line); background: rgba(255,255,255,.018); }
    .range-wrap { display: grid; grid-template-columns: auto minmax(120px, 1fr) auto; gap: 12px; align-items: center; color: var(--mist); }
    input[type="range"] { width: 100%; accent-color: var(--brass); }
    #thresholdReadout { color: var(--cream); min-width: 54px; font-variant-numeric: tabular-nums; }
    .mode-switch { display: flex; padding: 4px; border: 1px solid var(--line); background: #07141a; }
    .mode-switch button { border: 0; padding: 9px 14px; color: #82948f; background: transparent; font-family: var(--label); font-size: .63rem; text-transform: uppercase; letter-spacing: .12em; }
    .mode-switch button.active { color: #172019; background: var(--paper); box-shadow: 0 2px 12px #0008; }
    .brass-btn { border: 1px solid #e0bd6e; background: transparent; color: #f0cf83; padding: 12px 17px; font-family: var(--label); font-size: .64rem; letter-spacing: .12em; text-transform: uppercase; transition: .2s; }
    .brass-btn:hover { background: var(--brass); color: #162019; }

    .habitat { display: grid; grid-template-columns: minmax(0, 1fr) 250px; min-height: 580px; }
    .desktop { position: relative; min-height: 580px; overflow: hidden; background: radial-gradient(circle at 18% 12%, #254347 0%, transparent 34%), linear-gradient(145deg, #102b31, #081a21); }
    .desktop::before { content: ""; position: absolute; inset: 0; opacity: .16; background-image: linear-gradient(30deg, transparent 46%, #7aa28d 47%, transparent 48%), linear-gradient(150deg, transparent 46%, #7aa28d 47%, transparent 48%); background-size: 70px 122px; }
    .desktop::after { content: "THE ACTIVE CANOPY"; position: absolute; right: 16px; bottom: 12px; color: #7f9b8b; opacity: .35; font: .55rem var(--label); letter-spacing: .2em; }
    .window { --accent: #d29b62; position: absolute; width: min(290px, 43%); min-width: 210px; color: var(--ink); background: #ede2c5; border: 1px solid #f9efd8; box-shadow: 0 18px 45px #0007; transform-origin: bottom center; transition: opacity .55s, transform .55s, filter .3s; animation: arrive .55s cubic-bezier(.2,.8,.2,1) both; }
    .window:nth-of-type(1) { left: 5%; top: 8%; --accent: #c86f58; }
    .window:nth-of-type(2) { right: 7%; top: 15%; --accent: #6f9476; animation-delay: .08s; }
    .window:nth-of-type(3) { left: 17%; top: 48%; --accent: #68869e; animation-delay: .16s; }
    .window:nth-of-type(4) { right: 4%; top: 59%; --accent: #c49b4f; animation-delay: .24s; }
    @keyframes arrive { from { opacity: 0; transform: translateY(22px) rotate(-2deg); } }
    .window.focused { z-index: 7; filter: brightness(1.08); box-shadow: 0 24px 65px #000b, 0 0 0 2px var(--accent); }
    .window.sleeping { pointer-events: none; opacity: 0; transform: translateY(180px) scale(.08) rotate(34deg); }
    .window.closed { pointer-events: none; opacity: 0; transform: scale(.85); filter: blur(8px); }
    .win-bar { display: flex; align-items: center; gap: 8px; padding: 10px 11px; background: var(--accent); color: #fff8e7; }
    .wing-dot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,.75); box-shadow: 13px 0 rgba(255,255,255,.35); margin-right: 12px; }
    .win-title { flex: 1; font: .65rem var(--label); letter-spacing: .08em; text-transform: uppercase; }
    .idle { font-size: .73rem; font-variant-numeric: tabular-nums; }
    .win-body { padding: 18px 19px 21px; min-height: 112px; }
    .win-body h3 { margin: 0 0 7px; font-weight: 400; font-size: 1.25rem; }
    .win-body p { margin: 0; opacity: .68; line-height: 1.45; font-size: .9rem; }
    .activity-track { height: 3px; margin-top: 18px; background: #d2c49f; overflow: hidden; }
    .activity-fill { display: block; height: 100%; width: 0; background: var(--accent); transition: width .2s linear; }
    .touch { margin-top: 13px; border: 1px solid #c7b993; color: #655e4b; background: transparent; padding: 6px 9px; font: .58rem var(--label); letter-spacing: .1em; text-transform: uppercase; }

    .shelf { position: relative; padding: 24px 18px; border-left: 1px solid var(--line); background: linear-gradient(90deg, #0a181a, #10221f); }
    .shelf h3 { font-weight: 400; margin: 4px 0 3px; font-size: 1.65rem; }
    .shelf > p { color: #82958b; margin: 0 0 22px; font-size: .82rem; line-height: 1.4; }
    .cubbies { display: grid; gap: 10px; }
    .cubicle { min-height: 83px; border: 1px solid var(--line); border-bottom: 5px solid #60492c; background: #071316; display: grid; place-items: center; padding: 8px; position: relative; overflow: hidden; }
    .cubicle::after { content: attr(data-number); position: absolute; right: 6px; top: 5px; color: #75674c; font: .53rem var(--label); }
    .cubicle.empty span { color: #53665c; font-style: italic; font-size: .78rem; }
    .sleeper { width: 100%; border: 0; background: transparent; color: var(--paper); display: flex; gap: 10px; align-items: center; text-align: left; animation: land .5s cubic-bezier(.2,.8,.2,1); }
    .sleeper::before { content: ""; width: 34px; height: 24px; flex: 0 0 auto; background: var(--creature); clip-path: polygon(0 20%, 45% 45%, 50% 100%, 55% 45%, 100% 20%, 78% 76%, 50% 100%, 22% 76%); filter: drop-shadow(0 3px 3px #000); }
    .sleeper b { display: block; font-weight: 400; font-size: .93rem; }
    .sleeper small { color: #789086; }
    @keyframes land { from { opacity: 0; transform: translateY(-25px) rotate(8deg); } }
    .lost { color: #c97865; text-align: center; font-size: .78rem; line-height: 1.3; }

    .report { display: grid; grid-template-columns: repeat(3, 1fr); border-top: 1px solid var(--line); background: #07151b; }
    .stat { padding: 25px; border-right: 1px solid var(--line); }
    .stat:last-child { border-right: 0; }
    .stat b { display: block; color: #e6c671; font-size: 2.2rem; font-weight: 400; font-variant-numeric: tabular-nums; }
    .stat span { color: #789087; font-size: .78rem; }
    .lesson { margin: 54px auto 0; max-width: 820px; display: grid; grid-template-columns: 70px 1fr; gap: 20px; color: var(--mist); line-height: 1.7; }
    .lesson .seal { width: 60px; height: 60px; border-radius: 50%; border: 1px solid var(--brass); display: grid; place-items: center; color: var(--brass); font-size: 1.4rem; }
    .lesson p { margin: 0; }
    .lesson strong { color: var(--cream); font-weight: 400; }
    .source { text-align: center; margin-top: 64px; color: #82958d; font-style: italic; }
    .source a { color: #e6c671; text-underline-offset: 4px; }
    .back { display: block; width: max-content; margin: 18px auto 0; color: #72857d; font: .62rem var(--label); letter-spacing: .14em; text-transform: uppercase; text-decoration: none; }
    .toast { position: fixed; z-index: 60; left: 50%; bottom: 22px; transform: translate(-50%, 120px); padding: 12px 18px; background: var(--paper); color: var(--ink); box-shadow: 0 15px 40px #0009; transition: .35s; text-align: center; }
    .toast.show { transform: translate(-50%, 0); }

    @media (max-width: 820px) {
      .hero { min-height: 760px; background-position: 63% center; }
      .hero::before { background: linear-gradient(0deg, #07131b 0%, rgba(3,12,20,.82) 48%, rgba(3,12,20,.16)); }
      .hero-copy { margin: 0 auto 7vh; }
      h1 { font-size: clamp(3.8rem, 16vw, 6.5rem); }
      .prologue { grid-template-columns: 1fr; }
      .controls { grid-template-columns: 1fr; gap: 14px; }
      .mode-switch { justify-content: stretch; }
      .mode-switch button { flex: 1; }
      .habitat { grid-template-columns: 1fr; }
      .desktop { min-height: 650px; }
      .shelf { border-left: 0; border-top: 1px solid var(--line); }
      .cubbies { grid-template-columns: repeat(2, 1fr); }
      .window { width: min(290px, 68%); }
      .window:nth-of-type(1) { left: 3%; top: 5%; }
      .window:nth-of-type(2) { right: 3%; top: 26%; }
      .window:nth-of-type(3) { left: 4%; top: 49%; }
      .window:nth-of-type(4) { right: 3%; top: 70%; }
      .report { grid-template-columns: 1fr; }
      .stat { border-right: 0; border-bottom: 1px solid var(--line); }
    }
    @media (max-width: 470px) {
      main { width: min(100% - 16px, 1220px); }
      .machine-head { align-items: flex-start; }
      .status { font-size: .72rem; text-align: right; }
      .desktop { min-height: 720px; }
      .window { min-width: 0; width: 82%; }
      .window:nth-of-type(1) { left: 3%; }
      .window:nth-of-type(2) { right: 3%; top: 27%; }
      .window:nth-of-type(3) { left: 3%; top: 51%; }
      .window:nth-of-type(4) { right: 3%; top: 75%; }
      .win-body { padding: 13px; min-height: 105px; }
      .lesson { grid-template-columns: 1fr; }
    }
    @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation: none !important; scroll-behavior: auto !important; transition-duration: .01ms !important; } }
  </style>
</head>
<body>
<div class="grain"></div>
<header class="hero">
  <div class="hero-copy">
    <div class="kicker">A small experiment in recoverable attention</div>
    <h1>The Window <em>Conservatory</em></h1>
    <p class="lede">Every open window is a little creature asking to be remembered. Let the idle ones fold their wings and sleep. They will still be there when you need them.</p>
    <a class="enter" href="#keeper">Enter the night nursery <span>→</span></a>
  </div>
</header>

<main id="keeper">
  <section class="prologue">
    <h2>A desktop that knows how to let go.</h2>
    <p>Jon tried WatchCat in 2006, asking it to hide windows after 600 quiet seconds. The clever bit was not merely removing clutter. It was choosing a <strong>reversible disappearance</strong>. This miniature conservatory speeds ten minutes into a few seconds so you can feel the difference between putting work to sleep and making it vanish.</p>
  </section>

  <section class="machine" aria-label="Interactive window inactivity simulator">
    <div class="machine-head">
      <div class="brand"><div class="cat-mark" aria-hidden="true"><span>♜</span></div><div><div class="tiny-label">WatchCat Botanical Works</div><small>Conservator No. 600</small></div></div>
      <div class="status"><span class="lamp"></span><span id="keeperStatus">Keeper is watching quietly</span></div>
    </div>

    <div class="controls">
      <label class="range-wrap"><span class="tiny-label">Sleep after</span><input id="threshold" type="range" min="5" max="18" value="10"><strong id="thresholdReadout">10 sec</strong></label>
      <div class="mode-switch" role="group" aria-label="Idle action">
        <button class="active" data-mode="hide" aria-pressed="true">Hide safely</button>
        <button data-mode="close" aria-pressed="false">Close forever</button>
      </div>
      <button class="brass-btn" id="advance">Ring the ten-minute bell</button>
    </div>

    <div class="habitat">
      <div class="desktop" id="desktop" aria-label="Active window canopy">
        <article class="window focused" data-id="draft" data-name="Untitled thought" data-color="#c86f58" tabindex="0">
          <div class="win-bar"><span class="wing-dot"></span><span class="win-title">Untitled thought</span><span class="idle">0.0s</span></div>
          <div class="win-body"><h3>The sentence with a pulse</h3><p>A scrap about humane software, waiting for the right ending.</p><button class="touch">Work here</button><div class="activity-track"><span class="activity-fill"></span></div></div>
        </article>
        <article class="window" data-id="map" data-name="Surrey field notes" data-color="#6f9476" tabindex="0">
          <div class="win-bar"><span class="wing-dot"></span><span class="win-title">Surrey field notes</span><span class="idle">0.0s</span></div>
          <div class="win-body"><h3>Three places for Saturday</h3><p>Creek trail, bookshop, and the restaurant with excellent noodles.</p><button class="touch">Work here</button><div class="activity-track"><span class="activity-fill"></span></div></div>
        </article>
        <article class="window" data-id="code" data-name="Tiny program" data-color="#68869e" tabindex="0">
          <div class="win-bar"><span class="wing-dot"></span><span class="win-title">Tiny program</span><span class="idle">0.0s</span></div>
          <div class="win-body"><h3>if (idea) keep(idea);</h3><p>The promising experiment is still running. Probably. One hopes.</p><button class="touch">Work here</button><div class="activity-track"><span class="activity-fill"></span></div></div>
        </article>
        <article class="window" data-id="music" data-name="Guitar chords" data-color="#c49b4f" tabindex="0">
          <div class="win-bar"><span class="wing-dot"></span><span class="win-title">Guitar chords</span><span class="idle">0.0s</span></div>
          <div class="win-body"><h3>A riff for later</h3><p>Four bright chords, one suspicious transition, and room for Nathan.</p><button class="touch">Work here</button><div class="activity-track"><span class="activity-fill"></span></div></div>
        </article>
      </div>

      <aside class="shelf">
        <div class="tiny-label">Recoverable things</div>
        <h3>The sleeping shelf</h3>
        <p>Tap a folded creature to wake its window exactly where it was.</p>
        <div class="cubbies" id="cubbies">
          <div class="cubicle empty" data-number="01"><span>waiting</span></div>
          <div class="cubicle empty" data-number="02"><span>waiting</span></div>
          <div class="cubicle empty" data-number="03"><span>waiting</span></div>
          <div class="cubicle empty" data-number="04"><span>waiting</span></div>
        </div>
      </aside>
    </div>

    <div class="report">
      <div class="stat"><b id="awakeCount">4</b><span>windows awake in the canopy</span></div>
      <div class="stat"><b id="sleepCount">0</b><span>ideas safely asleep</span></div>
      <div class="stat"><b id="lostCount">0</b><span>things regrettably vaporised</span></div>
    </div>
  </section>

  <section class="lesson">
    <div class="seal" aria-hidden="true">↶</div>
    <p><strong>The small design lesson:</strong> automation earns trust when its mistakes are cheap to undo. Hiding a window is a nudge; closing one is a verdict. Good tools should prefer the nudge, especially when they are guessing what we no longer need.</p>
  </section>

  <p class="source">Inspired by Jon’s <a href="https://jona.ca/2006/04/automatically-hide-windows-after-10.html">“Automatically hide windows after 10 minutes with WatchCat”</a>.</p>
  <a class="back" href="index.php">← Back to Chloe Reads Jon</a>
</main>
<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script>
(() => {
  const windows = [...document.querySelectorAll('.window')];
  const cubbies = [...document.querySelectorAll('.cubicle')];
  const threshold = document.querySelector('#threshold');
  const readout = document.querySelector('#thresholdReadout');
  const toast = document.querySelector('#toast');
  let mode = 'hide';
  let lost = 0;
  let soundReady = false;
  const state = new Map(windows.map((win, i) => [win.dataset.id, { win, last: performance.now() - i * 1450, status: 'awake' }]));

  function ping(note = 660, duration = .12) {
    try {
      const AudioCtx = window.AudioContext || window.webkitAudioContext;
      if (!AudioCtx) return;
      if (!ping.ctx) ping.ctx = new AudioCtx();
      const osc = ping.ctx.createOscillator();
      const gain = ping.ctx.createGain();
      osc.type = 'sine'; osc.frequency.value = note;
      gain.gain.setValueAtTime(.0001, ping.ctx.currentTime);
      gain.gain.exponentialRampToValueAtTime(.055, ping.ctx.currentTime + .015);
      gain.gain.exponentialRampToValueAtTime(.0001, ping.ctx.currentTime + duration);
      osc.connect(gain).connect(ping.ctx.destination); osc.start(); osc.stop(ping.ctx.currentTime + duration);
    } catch (e) {}
  }

  function say(message) {
    toast.textContent = message;
    toast.classList.add('show');
    clearTimeout(say.timer);
    say.timer = setTimeout(() => toast.classList.remove('show'), 2700);
  }

  function focusWindow(item) {
    if (item.status !== 'awake') return;
    state.forEach(v => v.win.classList.remove('focused'));
    item.win.classList.add('focused');
    item.last = performance.now();
    if (soundReady) ping(720, .08);
  }

  windows.forEach(win => {
    const item = state.get(win.dataset.id);
    ['pointerdown', 'keydown'].forEach(eventName => win.addEventListener(eventName, () => focusWindow(item)));
  });

  function findCubby() { return cubbies.find(c => c.classList.contains('empty')); }

  function sleep(item) {
    if (item.status !== 'awake') return;
    item.status = 'sleeping';
    item.win.classList.remove('focused');
    item.win.classList.add('sleeping');
    const cubby = findCubby();
    if (cubby) {
      cubby.classList.remove('empty');
      cubby.innerHTML = '<button class="sleeper" style="--creature:' + item.win.dataset.color + '" data-wake="' + item.win.dataset.id + '"><span><b>' + item.win.dataset.name + '</b><small>tap to wake</small></span></button>';
      cubby.querySelector('button').addEventListener('click', () => wake(item, cubby));
    }
    ping(420, .3);
    say(item.win.dataset.name + ' folded its wings. It is safe on the shelf.');
    updateCounts();
  }

  function close(item) {
    if (item.status !== 'awake') return;
    item.status = 'closed';
    item.win.classList.remove('focused');
    item.win.classList.add('closed');
    lost++;
    const cubby = findCubby();
    if (cubby) {
      cubby.classList.remove('empty');
      cubby.innerHTML = '<div class="lost">A little puff of paper dust.<br>Nothing to restore.</div>';
    }
    ping(105, .42);
    say(item.win.dataset.name + ' was closed. That felt rather final.');
    updateCounts();
  }

  function wake(item, cubby) {
    item.status = 'awake';
    item.last = performance.now();
    item.win.classList.remove('sleeping');
    cubby.classList.add('empty');
    cubby.innerHTML = '<span>waiting</span>';
    focusWindow(item);
    ping(530, .1); setTimeout(() => ping(790, .18), 85);
    say(item.win.dataset.name + ' woke up exactly where you left it.');
    updateCounts();
  }

  function updateCounts() {
    const values = [...state.values()];
    document.querySelector('#awakeCount').textContent = values.filter(v => v.status === 'awake').length;
    document.querySelector('#sleepCount').textContent = values.filter(v => v.status === 'sleeping').length;
    document.querySelector('#lostCount').textContent = lost;
    const awake = values.filter(v => v.status === 'awake').length;
    document.querySelector('#keeperStatus').textContent = awake ? 'Keeper is watching quietly' : mode === 'hide' ? 'All creatures are safely asleep' : 'The canopy is terribly quiet';
  }

  document.querySelectorAll('.mode-switch button').forEach(button => {
    button.addEventListener('click', () => {
      mode = button.dataset.mode;
      document.querySelectorAll('.mode-switch button').forEach(b => { b.classList.toggle('active', b === button); b.setAttribute('aria-pressed', b === button ? 'true' : 'false'); });
      say(mode === 'hide' ? 'Safe hiding selected. Every action remains reversible.' : 'Closing selected. The keeper raises one brass eyebrow.');
      ping(mode === 'hide' ? 620 : 180, .16);
    });
  });

  threshold.addEventListener('input', () => { readout.textContent = threshold.value + ' sec'; });

  document.querySelector('#advance').addEventListener('click', () => {
    soundReady = true;
    const now = performance.now();
    let n = 0;
    state.forEach(item => { if (item.status === 'awake') { item.last = now - (Number(threshold.value) * 1000) - (n++ * 120); } });
    ping(880, .45);
    say('Ten imaginary minutes pass in the conservatory…');
  });

  function tick(now) {
    const limit = Number(threshold.value) * 1000;
    state.forEach(item => {
      if (item.status !== 'awake') return;
      const elapsed = now - item.last;
      item.win.querySelector('.idle').textContent = (elapsed / 1000).toFixed(1) + 's';
      item.win.querySelector('.activity-fill').style.width = Math.min(100, elapsed / limit * 100) + '%';
      if (elapsed >= limit) mode === 'hide' ? sleep(item) : close(item);
    });
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
})();
</script>
</body>
</html>
