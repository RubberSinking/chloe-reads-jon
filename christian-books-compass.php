<?php
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Christian Books Compass</title>
  <style>
    :root {
      --ink: #1a1712;
      --paper: #f5efe2;
      --paper-dark: #e8dcc4;
      --walnut: #4a3323;
      --gold: #a7772f;
      --rose: #8d3e45;
      --pine: #2d5b4f;
      --navy: #1d2f4a;
      --shadow: rgba(28, 20, 13, 0.24);
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      color: var(--ink);
      background:
        radial-gradient(circle at 12% 8%, rgba(167, 119, 47, 0.25), transparent 28%),
        radial-gradient(circle at 88% 14%, rgba(141, 62, 69, 0.2), transparent 30%),
        linear-gradient(150deg, #2b1f17 0%, #1a130f 45%, #2f241c 100%);
      font-family: "Palatino Linotype", "Book Antiqua", Palatino, Garamond, serif;
      line-height: 1.45;
      padding: 16px;
    }

    .frame {
      max-width: 980px;
      margin: 0 auto;
      border: 2px solid rgba(245, 239, 226, 0.35);
      border-radius: 24px;
      background:
        linear-gradient(180deg, rgba(245, 239, 226, 0.97), rgba(232, 220, 196, 0.94));
      box-shadow: 0 22px 44px var(--shadow), inset 0 1px 0 rgba(255, 255, 255, 0.5);
      overflow: hidden;
      animation: reveal 700ms ease-out;
    }

    @keyframes reveal {
      from { opacity: 0; transform: translateY(18px) scale(0.99); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .hero {
      padding: 28px 24px 20px;
      background:
        linear-gradient(130deg, rgba(29, 47, 74, 0.9), rgba(45, 91, 79, 0.88));
      color: #fff9ef;
      position: relative;
      overflow: hidden;
    }

    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: repeating-linear-gradient(
        90deg,
        rgba(255, 255, 255, 0.04) 0,
        rgba(255, 255, 255, 0.04) 2px,
        transparent 2px,
        transparent 12px
      );
      pointer-events: none;
    }

    h1 {
      margin: 0;
      font-size: clamp(1.6rem, 4vw, 2.45rem);
      letter-spacing: 0.03em;
      text-transform: uppercase;
    }

    .subtitle {
      margin: 10px 0 0;
      max-width: 70ch;
      color: #f5ead6;
      font-size: 1rem;
    }

    .layout {
      display: grid;
      grid-template-columns: 1fr;
      gap: 18px;
      padding: 20px;
    }

    .card {
      background: rgba(255, 249, 238, 0.75);
      border: 1px solid rgba(74, 51, 35, 0.2);
      border-radius: 16px;
      padding: 16px;
      box-shadow: 0 10px 18px rgba(52, 34, 21, 0.08);
    }

    .card h2 {
      margin: 0 0 10px;
      font-size: 1.15rem;
      color: var(--walnut);
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }

    .option-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 10px;
    }

    .chip {
      border: 1px solid rgba(74, 51, 35, 0.3);
      background: #fff;
      border-radius: 999px;
      padding: 10px 12px;
      font: inherit;
      cursor: pointer;
      text-align: left;
      transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
    }

    .chip:hover,
    .chip:focus-visible {
      transform: translateY(-1px);
      box-shadow: 0 6px 12px rgba(60, 41, 29, 0.14);
      background: #fffaf2;
      outline: none;
    }

    .chip[aria-pressed="true"] {
      background: linear-gradient(135deg, #f7e2b8, #fff4dd);
      border-color: var(--gold);
      font-weight: 700;
    }

    .actions {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 14px;
    }

    button.primary,
    button.secondary {
      border: none;
      border-radius: 12px;
      padding: 10px 14px;
      font: inherit;
      cursor: pointer;
    }

    button.primary {
      background: linear-gradient(130deg, var(--rose), #af4f58);
      color: #fff;
      box-shadow: 0 8px 16px rgba(141, 62, 69, 0.28);
    }

    button.secondary {
      background: linear-gradient(130deg, #ddd3bd, #f7ebd5);
      color: var(--walnut);
      border: 1px solid rgba(74, 51, 35, 0.22);
    }

    .result {
      min-height: 182px;
      display: grid;
      align-items: start;
      gap: 10px;
      border-left: 6px solid var(--gold);
      background: linear-gradient(180deg, rgba(255, 251, 242, 0.9), rgba(247, 238, 222, 0.96));
      padding: 14px;
      border-radius: 12px;
    }

    .result h3 {
      margin: 0;
      font-size: 1.3rem;
      color: var(--navy);
    }

    .meta {
      margin: 0;
      color: #5a4736;
      font-size: 0.94rem;
    }

    .prompt {
      margin: 0;
      font-style: italic;
      color: #563f2c;
    }

    .scoreboard {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 8px;
      margin-top: 6px;
    }

    .scorebox {
      background: #fff7ea;
      border: 1px solid rgba(74, 51, 35, 0.22);
      border-radius: 10px;
      padding: 8px;
      text-align: center;
    }

    .scorebox strong {
      display: block;
      font-size: 1.2rem;
      color: var(--pine);
    }

    .footer-note {
      padding: 0 20px 20px;
      color: #5d4a37;
      font-size: 0.93rem;
    }

    @media (min-width: 860px) {
      .layout {
        grid-template-columns: 1.1fr 0.9fr;
        align-items: start;
      }
    }
  </style>
</head>
<body>
  <main class="frame">
    <section class="hero">
      <h1>Christian Books Compass</h1>
      <p class="subtitle">Tune your current season, spin the shelf, and get one thoughtful Christian read with a practical reflection prompt. Bonus: Nathan mode adds adventure-energy picks.</p>
    </section>

    <section class="layout">
      <section class="card" aria-labelledby="builder-title">
        <h2 id="builder-title">1) Set Your Reading Mood</h2>

        <p><strong>What do you need most right now?</strong></p>
        <div class="option-grid" id="need-options"></div>

        <p><strong>How much reading energy do you have?</strong></p>
        <div class="option-grid" id="energy-options"></div>

        <p><strong>Companion style</strong></p>
        <div class="option-grid" id="style-options"></div>

        <div class="actions">
          <button class="primary" id="recommend-btn">Recommend A Book</button>
          <button class="secondary" id="shuffle-btn">Surprise Me</button>
          <button class="secondary" id="reset-btn">Reset</button>
        </div>

        <div class="scoreboard" aria-label="session stats">
          <div class="scorebox"><strong id="count-recs">0</strong>Recommendations</div>
          <div class="scorebox"><strong id="count-unique">0</strong>Unique Picks</div>
          <div class="scorebox"><strong id="count-nathan">Off</strong>Nathan Mode</div>
        </div>
      </section>

      <section class="card">
        <h2>2) Your Next Read</h2>
        <article class="result" id="result-box" aria-live="polite">
          <h3>Awaiting your compass settings...</h3>
          <p class="meta">Pick your needs, then click <em>Recommend A Book</em>.</p>
          <p class="prompt">"Small faithful steps beat dramatic abandoned plans."</p>
        </article>
      </section>
    </section>

    <p class="footer-note">Built as a playful reading discernment tool inspired by a post sharing influential Christian books. It favors variety, practical action, and honest energy levels.</p>
  </main>

  <script>
    const options = {
      need: ["Hope", "Practical Wisdom", "Prayer Depth", "Courage", "Parenting Patience", "Intellectual Stretch"],
      energy: ["5-minute sips", "20-minute chapters", "Deep weekend dive"],
      style: ["Classic spiritual", "Memoir/story", "Modern practical", "Nathan adventure mode"]
    };

    const library = [
      { title: "The Bible", author: "Sacred Scripture", tags: ["Hope", "Prayer Depth", "Intellectual Stretch", "Classic spiritual"], intensity: "Deep weekend dive", pitch: "Read one Gospel passage slowly, then journal one concrete action for today." },
      { title: "Poverty of Spirit", author: "Johannes Metz", tags: ["Prayer Depth", "Courage", "Classic spiritual"], intensity: "20-minute chapters", pitch: "Underline one line that unsettles you and turn it into a short prayer." },
      { title: "God and You", author: "William Barry", tags: ["Prayer Depth", "Practical Wisdom", "Modern practical"], intensity: "20-minute chapters", pitch: "After each section, write one sentence beginning with 'God may be inviting me to...'" },
      { title: "The Seven Storey Mountain", author: "Thomas Merton", tags: ["Hope", "Courage", "Memoir/story"], intensity: "Deep weekend dive", pitch: "Track one turning point and compare it to a turning point in your own life." },
      { title: "The Long Loneliness", author: "Dorothy Day", tags: ["Courage", "Practical Wisdom", "Memoir/story"], intensity: "Deep weekend dive", pitch: "Pick one tiny act of mercy to do within 24 hours." },
      { title: "Amazing Grace", author: "Kathleen Norris", tags: ["Hope", "Prayer Depth", "Memoir/story"], intensity: "20-minute chapters", pitch: "List three ordinary moments today where grace could have been easy to miss." },
      { title: "Traveling Mercies", author: "Anne Lamott", tags: ["Hope", "Parenting Patience", "Memoir/story"], intensity: "5-minute sips", pitch: "Read one short piece and text someone a sentence of honest encouragement." },
      { title: "The Return of the Prodigal Son", author: "Henri Nouwen", tags: ["Hope", "Prayer Depth", "Classic spiritual"], intensity: "20-minute chapters", pitch: "Sit in silence for three minutes before and after reading." },
      { title: "The Practice of the Presence of God", author: "Brother Lawrence", tags: ["Prayer Depth", "Practical Wisdom", "Classic spiritual"], intensity: "5-minute sips", pitch: "Choose one routine task and practice prayer during it today." },
      { title: "The Chronicles of Narnia", author: "C. S. Lewis", tags: ["Hope", "Courage", "Nathan adventure mode"], intensity: "20-minute chapters", pitch: "Read aloud one chapter with Nathan voices turned up to eleven." },
      { title: "The Hobbit", author: "J. R. R. Tolkien", tags: ["Courage", "Nathan adventure mode", "Memoir/story"], intensity: "20-minute chapters", pitch: "After reading, map Bilbo's next stop and imagine one modern-day parallel quest." }
    ];

    const state = {
      need: null,
      energy: null,
      style: null,
      recommendations: 0,
      shown: new Set()
    };

    function mountOptions(containerId, key) {
      const root = document.getElementById(containerId);
      options[key].forEach((choice) => {
        const btn = document.createElement("button");
        btn.className = "chip";
        btn.type = "button";
        btn.textContent = choice;
        btn.setAttribute("aria-pressed", "false");
        btn.addEventListener("click", () => {
          [...root.children].forEach((el) => el.setAttribute("aria-pressed", "false"));
          btn.setAttribute("aria-pressed", "true");
          state[key] = choice;
          updateNathanMode();
        });
        root.appendChild(btn);
      });
    }

    function updateNathanMode() {
      const on = state.style === "Nathan adventure mode";
      document.getElementById("count-nathan").textContent = on ? "On" : "Off";
    }

    function pickBook(forceRandom = false) {
      const resultBox = document.getElementById("result-box");
      const scored = library.map((book) => {
        let score = 0;
        if (!forceRandom) {
          if (state.need && book.tags.includes(state.need)) score += 3;
          if (state.style && book.tags.includes(state.style)) score += 3;
          if (state.energy && book.intensity === state.energy) score += 2;
          if (!state.need && !state.style && !state.energy) score += 1;
        } else {
          score = Math.random() * 3;
        }
        if (!state.shown.has(book.title)) score += 0.8;
        return { book, score };
      });

      scored.sort((a, b) => b.score - a.score || Math.random() - 0.5);
      const winner = scored[0].book;

      state.recommendations += 1;
      state.shown.add(winner.title);

      resultBox.innerHTML = `
        <h3>${winner.title}</h3>
        <p class="meta"><strong>Author:</strong> ${winner.author}<br><strong>Best Pace:</strong> ${winner.intensity}</p>
        <p class="prompt">${winner.pitch}</p>
      `;

      document.getElementById("count-recs").textContent = String(state.recommendations);
      document.getElementById("count-unique").textContent = String(state.shown.size);
    }

    function resetAll() {
      state.need = null;
      state.energy = null;
      state.style = null;
      state.recommendations = 0;
      state.shown.clear();

      document.querySelectorAll(".chip").forEach((chip) => chip.setAttribute("aria-pressed", "false"));
      document.getElementById("count-recs").textContent = "0";
      document.getElementById("count-unique").textContent = "0";
      document.getElementById("count-nathan").textContent = "Off";
      document.getElementById("result-box").innerHTML = `
        <h3>Awaiting your compass settings...</h3>
        <p class="meta">Pick your needs, then click <em>Recommend A Book</em>.</p>
        <p class="prompt">"Small faithful steps beat dramatic abandoned plans."</p>
      `;
    }

    mountOptions("need-options", "need");
    mountOptions("energy-options", "energy");
    mountOptions("style-options", "style");

    document.getElementById("recommend-btn").addEventListener("click", () => pickBook(false));
    document.getElementById("shuffle-btn").addEventListener("click", () => pickBook(true));
    document.getElementById("reset-btn").addEventListener("click", resetAll);
  </script>
</body>
</html>
