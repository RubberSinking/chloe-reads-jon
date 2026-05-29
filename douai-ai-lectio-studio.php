<?php
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Douai-AI Lectio Studio</title>
  <style>
    :root {
      --bg: #f4efe4;
      --ink: #1f1a15;
      --panel: #fff9ee;
      --gold: #9d7a31;
      --wine: #5f2d3a;
      --sage: #4c6554;
      --line: #dccfb4;
      --glow: rgba(157, 122, 49, 0.26);
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      color: var(--ink);
      font-family: "Book Antiqua", "Palatino Linotype", Palatino, serif;
      background:
        radial-gradient(1000px 480px at 7% -10%, #efe1c4 0%, transparent 65%),
        radial-gradient(900px 500px at 100% 0%, #ead7b0 0%, transparent 70%),
        linear-gradient(180deg, #f8f3e7 0%, var(--bg) 60%, #ede3d2 100%);
      padding: 24px;
    }

    .shell {
      max-width: 1080px;
      margin: 0 auto;
      border: 1px solid var(--line);
      background: linear-gradient(140deg, rgba(255,255,255,0.76), rgba(255,249,238,0.92));
      box-shadow: 0 24px 70px rgba(56, 38, 14, 0.22);
      border-radius: 20px;
      overflow: hidden;
    }

    .hero {
      padding: 30px 24px 22px;
      border-bottom: 1px solid var(--line);
      background:
        linear-gradient(125deg, rgba(95,45,58,0.14), rgba(157,122,49,0.12)),
        repeating-linear-gradient(-45deg, rgba(157,122,49,0.07) 0 12px, rgba(255,255,255,0.06) 12px 24px);
    }

    h1 {
      margin: 0;
      font-size: clamp(1.7rem, 2.8vw, 2.6rem);
      letter-spacing: 0.01em;
      color: #2a1f14;
    }

    .sub {
      margin: 10px 0 0;
      font-size: 1rem;
      line-height: 1.6;
      max-width: 74ch;
      color: #4a3a2b;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 18px;
      padding: 20px;
    }

    .card {
      border: 1px solid var(--line);
      border-radius: 14px;
      background: var(--panel);
      box-shadow: 0 8px 22px rgba(73, 52, 21, 0.09);
      padding: 16px;
    }

    .card h2 {
      margin: 0 0 10px;
      font-size: 1.05rem;
      color: #3a2b1f;
    }

    textarea {
      width: 100%;
      min-height: 180px;
      border: 1px solid #d6c7a7;
      border-radius: 10px;
      font: 0.98rem/1.55 "Book Antiqua", "Palatino Linotype", serif;
      color: #2b2016;
      padding: 12px;
      background: #fffdfa;
      resize: vertical;
    }

    .controls {
      margin-top: 10px;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    button {
      border: 1px solid #8f6a27;
      background: linear-gradient(180deg, #ba9545, #9d7a31);
      color: #fff9ed;
      font-family: inherit;
      font-size: 0.95rem;
      padding: 8px 12px;
      border-radius: 999px;
      cursor: pointer;
      transition: transform .18s ease, box-shadow .18s ease;
    }

    button:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 14px var(--glow);
    }

    button.secondary {
      border-color: #8f8a74;
      background: linear-gradient(180deg, #f8f2e5, #e7decc);
      color: #4e4030;
    }

    .output {
      white-space: pre-wrap;
      line-height: 1.7;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #d7c8a8;
      background: #fffefb;
      min-height: 160px;
    }

    .changed {
      background: rgba(95, 45, 58, 0.12);
      border-bottom: 2px solid rgba(95, 45, 58, 0.42);
      padding: 0 2px;
      border-radius: 3px;
    }

    .meta {
      margin-top: 10px;
      font-size: 0.9rem;
      color: #5a4a37;
    }

    .prompt-list {
      margin: 6px 0 0;
      padding-left: 20px;
      line-height: 1.6;
    }

    .two {
      display: grid;
      grid-template-columns: 1fr;
      gap: 18px;
    }

    @media (min-width: 920px) {
      .grid {
        grid-template-columns: 1.2fr 1fr;
      }
      .span-2 { grid-column: 1 / -1; }
      .two { grid-template-columns: 1fr 1fr; }
    }
  </style>
</head>
<body>
  <main class="shell">
    <section class="hero">
      <h1>Douai-AI Lectio Studio</h1>
      <p class="sub">Paste a Scripture passage, modernize older phrasing, and gather fresh lectio prompts. This is a reflective writing studio, not a replacement for approved liturgical texts.</p>
    </section>

    <section class="grid">
      <article class="card">
        <h2>Source Passage</h2>
        <textarea id="source">And straightway he constrained his disciples to get into the ship, and to go before him over the water to Bethsaida, whilst he dismissed the people.
And when he had dismissed them, he went up to the mountain to pray.
And seeing them labouring in rowing, because the wind was against them, and about the fourth watch of the night, he cometh to them walking upon the sea, and he would have passed by them.
But when they saw him walking upon the sea, they thought it had been an apparition, and they cried out.</textarea>
        <div class="controls">
          <button id="modernize">Gentle Modernize</button>
          <button id="poetic">Poetic Lift</button>
          <button class="secondary" id="clear">Clear</button>
          <button class="secondary" id="sample">Random Sample</button>
        </div>
      </article>

      <article class="card">
        <h2>Rendered Passage</h2>
        <div class="output" id="output"></div>
        <div class="meta" id="stats">0 words changed</div>
      </article>

      <article class="card span-2 two">
        <section>
          <h2>Lectio Prompts</h2>
          <ul class="prompt-list" id="prompts"></ul>
        </section>
        <section>
          <h2>Focus Mode</h2>
          <p class="meta" id="focusLine">Press “Begin 90-Second Reflection” and reread slowly.</p>
          <div class="controls">
            <button id="focusBtn">Begin 90-Second Reflection</button>
            <button class="secondary" id="stopBtn">Stop</button>
          </div>
        </section>
      </article>
    </section>
  </main>

  <script>
    const source = document.getElementById('source');
    const output = document.getElementById('output');
    const stats = document.getElementById('stats');
    const prompts = document.getElementById('prompts');
    const focusLine = document.getElementById('focusLine');

    const replacements = [
      ['straightway', 'immediately'],
      ['constrained', 'urged'],
      ['ship', 'boat'],
      ['whilst', 'while'],
      ['dismissed the people', 'sent the crowd away'],
      ['labouring', 'straining'],
      ['because', 'since'],
      ['cometh', 'came'],
      ['upon', 'on'],
      ['apparition', 'ghost'],
      ['cried out', 'cried out in fear'],
      ['had been', 'was'],
      ['them', 'them']
    ];

    const poeticReplacements = [
      ['immediately', 'at once'],
      ['boat', 'little boat'],
      ['wind', 'headwind'],
      ['came', 'drew near'],
      ['fear', 'trembling awe']
    ];

    const samples = [
`And Jesus saith unto them: Why are you fearful, O ye of little faith?`,
`Blessed are the clean of heart: for they shall see God.`,
`Let not your heart be troubled: you believe in God, believe also in me.`
    ];

    function escapeHtml(s) {
      return s
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;');
    }

    function replaceWords(text, table) {
      let changed = 0;
      let rendered = text;

      table.forEach(([from, to]) => {
        const regex = new RegExp(`\\b${from.replace(/[.*+?^${}()|[\\]\\]/g, '\\\\$&')}\\b`, 'gi');
        rendered = rendered.replace(regex, (match) => {
          changed += 1;
          const capitalized = /^[A-Z]/.test(match);
          const target = capitalized ? to.charAt(0).toUpperCase() + to.slice(1) : to;
          return `[[${target}]]`;
        });
      });

      const safe = escapeHtml(rendered).replace(/\[\[(.*?)\]\]/g, '<span class="changed">$1</span>');
      return { safe, changed, plain: rendered.replace(/\[\[(.*?)\]\]/g, '$1') };
    }

    function makePrompts(text) {
      const lines = text.split(/\n+/).map(l => l.trim()).filter(Boolean);
      const keyLine = lines[Math.floor(Math.random() * Math.max(lines.length, 1))] || 'Take heart. It is I. Do not be afraid.';
      const variants = [
        `Which single phrase in this passage arrests your attention today, and why?`,
        `Where do you feel resistance in this text, and what might that reveal?`,
        `If Jesus addressed one sentence here directly to your current week, what would it be?`,
        `What fear is named or implied here, and what invitation counters it?`,
        `Sit with this line for one minute: "${keyLine.slice(0, 100)}"`
      ];
      prompts.innerHTML = variants.map(v => `<li>${escapeHtml(v)}</li>`).join('');
    }

    function render(mode = 'modern') {
      const base = replaceWords(source.value, replacements);
      let final = base;
      if (mode === 'poetic') {
        final = replaceWords(base.plain, poeticReplacements);
        final.changed += base.changed;
      }
      output.innerHTML = final.safe;
      stats.textContent = `${final.changed} words or phrases adjusted`;
      makePrompts(final.plain);
    }

    let timer = null;
    function beginFocus(seconds = 90) {
      clearInterval(timer);
      let remaining = seconds;
      focusLine.textContent = `Reflection time: ${remaining}s`;
      timer = setInterval(() => {
        remaining -= 1;
        if (remaining <= 0) {
          clearInterval(timer);
          focusLine.textContent = 'Finished. Note one concrete step for today.';
          return;
        }
        focusLine.textContent = `Reflection time: ${remaining}s`;
      }, 1000);
    }

    document.getElementById('modernize').addEventListener('click', () => render('modern'));
    document.getElementById('poetic').addEventListener('click', () => render('poetic'));
    document.getElementById('clear').addEventListener('click', () => {
      source.value = '';
      render('modern');
    });
    document.getElementById('sample').addEventListener('click', () => {
      source.value = samples[Math.floor(Math.random() * samples.length)];
      render('modern');
    });
    document.getElementById('focusBtn').addEventListener('click', () => beginFocus(90));
    document.getElementById('stopBtn').addEventListener('click', () => {
      clearInterval(timer);
      focusLine.textContent = 'Focus stopped.';
    });

    render('modern');
  </script>
</body>
</html>
