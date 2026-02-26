<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YubNub Command Playground</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    :root {
      --green: #39ff14;
      --green-dim: #1a8c0a;
      --green-dark: #0d5c07;
      --bg: #0a0e0a;
      --bg-card: #0f1a0f;
      --bg-input: #071307;
      --border: #1c3a1c;
      --text-muted: #5a9c5a;
      --amber: #ffb700;
      --amber-dim: #7a5800;
    }
    body {
      font-family: 'Courier New', Courier, monospace;
      background: var(--bg);
      color: var(--green);
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }
    /* Scanline effect */
    body::before {
      content: '';
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        rgba(0,0,0,0.03) 2px,
        rgba(0,0,0,0.03) 4px
      );
      pointer-events: none;
      z-index: 999;
    }

    .container {
      max-width: 720px;
      margin: 0 auto;
      padding: 24px 16px 80px;
    }

    /* ── Header ── */
    .header {
      text-align: center;
      margin-bottom: 32px;
      padding: 24px 0 20px;
      border-bottom: 1px solid var(--border);
    }
    .logo {
      font-size: 2.4em;
      font-weight: bold;
      letter-spacing: 0.15em;
      text-shadow: 0 0 20px var(--green), 0 0 40px var(--green-dim);
      margin: 0 0 4px;
      animation: flicker 8s infinite;
    }
    @keyframes flicker {
      0%,95%,97%,100% { opacity: 1; }
      96% { opacity: 0.85; }
    }
    .logo span { color: var(--amber); text-shadow: 0 0 20px var(--amber), 0 0 40px var(--amber-dim); }
    .tagline {
      color: var(--text-muted);
      font-size: 0.85em;
      margin: 0 0 12px;
    }
    .badge {
      display: inline-block;
      background: var(--green-dark);
      border: 1px solid var(--green-dim);
      color: var(--green);
      font-size: 0.7em;
      padding: 2px 8px;
      letter-spacing: 0.1em;
    }

    /* ── Terminal Input ── */
    .terminal {
      background: var(--bg-input);
      border: 1px solid var(--green-dim);
      border-radius: 4px;
      padding: 16px 20px 20px;
      margin-bottom: 24px;
      box-shadow: 0 0 20px rgba(57,255,20,0.08), inset 0 0 40px rgba(0,0,0,0.5);
    }
    .terminal-bar {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 16px;
      border-bottom: 1px solid var(--border);
      padding-bottom: 12px;
    }
    .dot {
      width: 10px; height: 10px;
      border-radius: 50%;
      background: var(--green-dark);
      border: 1px solid var(--green-dim);
    }
    .dot.red { background: #5c1a1a; border-color: #8c2a2a; }
    .dot.yellow { background: #5c4a00; border-color: #8c7000; }
    .terminal-title {
      color: var(--text-muted);
      font-size: 0.75em;
      margin-left: auto;
    }
    .prompt-row {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .prompt-symbol {
      color: var(--green);
      font-size: 1.1em;
      flex-shrink: 0;
      text-shadow: 0 0 8px var(--green);
    }
    #cmd-input {
      flex: 1;
      background: transparent;
      border: none;
      outline: none;
      color: var(--green);
      font-family: inherit;
      font-size: 1.1em;
      caret-color: var(--green);
    }
    #cmd-input::placeholder { color: var(--green-dark); }
    .run-btn {
      background: var(--green-dark);
      border: 1px solid var(--green-dim);
      color: var(--green);
      font-family: inherit;
      font-size: 0.85em;
      padding: 6px 14px;
      cursor: pointer;
      letter-spacing: 0.1em;
      transition: all 0.1s;
      flex-shrink: 0;
    }
    .run-btn:hover {
      background: var(--green-dim);
      color: var(--bg);
      box-shadow: 0 0 12px var(--green-dim);
    }
    .run-btn:active { transform: scale(0.97); }

    /* ── Output ── */
    #output {
      margin-top: 16px;
      min-height: 50px;
    }
    .output-line {
      font-size: 0.9em;
      line-height: 1.7;
      padding: 2px 0;
    }
    .output-line.comment { color: var(--text-muted); }
    .output-line.result { color: var(--amber); }
    .output-line.url { color: #5ad3ff; word-break: break-all; }
    .output-line.error { color: #ff5a5a; }
    .go-link {
      display: inline-block;
      margin-top: 10px;
      background: var(--green-dark);
      border: 1px solid var(--green);
      color: var(--green);
      font-family: inherit;
      font-size: 0.85em;
      padding: 6px 16px;
      text-decoration: none;
      letter-spacing: 0.1em;
      transition: all 0.15s;
    }
    .go-link:hover {
      background: var(--green);
      color: var(--bg);
      box-shadow: 0 0 16px var(--green);
    }

    /* ── Help text ── */
    .help-text {
      color: var(--text-muted);
      font-size: 0.75em;
      margin-top: 12px;
      padding-top: 10px;
      border-top: 1px solid var(--border);
      line-height: 1.6;
    }

    /* ── Section titles ── */
    .section-title {
      font-size: 0.7em;
      letter-spacing: 0.2em;
      color: var(--text-muted);
      margin: 32px 0 12px;
      padding-bottom: 6px;
      border-bottom: 1px solid var(--border);
    }

    /* ── Command gallery ── */
    .cmd-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 8px;
      margin-bottom: 8px;
    }
    .cmd-chip {
      background: var(--bg-card);
      border: 1px solid var(--border);
      padding: 10px 12px;
      cursor: pointer;
      transition: all 0.15s;
      text-align: left;
    }
    .cmd-chip:hover {
      border-color: var(--green-dim);
      background: var(--green-dark);
      box-shadow: 0 0 8px rgba(57,255,20,0.15);
    }
    .cmd-chip:active { transform: scale(0.98); }
    .cmd-name {
      color: var(--amber);
      font-size: 1em;
      font-weight: bold;
      display: block;
      margin-bottom: 3px;
    }
    .cmd-desc {
      color: var(--text-muted);
      font-size: 0.72em;
      line-height: 1.4;
    }

    /* ── About ── */
    .about-box {
      background: var(--bg-card);
      border: 1px solid var(--border);
      padding: 20px;
      font-size: 0.82em;
      line-height: 1.7;
      color: var(--text-muted);
    }
    .about-box p { margin: 0 0 12px; }
    .about-box p:last-child { margin-bottom: 0; }
    .about-box a { color: var(--green); }
    .about-box strong { color: var(--green); }
    .about-box em { color: var(--amber); font-style: normal; }

    /* ── Build Your Own ── */
    .syntax-box {
      background: var(--bg-input);
      border: 1px solid var(--border);
      padding: 16px;
      font-size: 0.82em;
      color: var(--text-muted);
    }
    .syntax-example {
      display: block;
      color: var(--amber);
      margin: 6px 0;
      padding: 6px 10px;
      background: rgba(255,183,0,0.05);
      border-left: 2px solid var(--amber-dim);
    }

    /* ── History timeline ── */
    .timeline { list-style: none; padding: 0; margin: 0; }
    .timeline li {
      display: flex;
      gap: 16px;
      padding: 10px 0;
      border-bottom: 1px solid var(--border);
      font-size: 0.8em;
    }
    .timeline li:last-child { border-bottom: none; }
    .tl-year {
      color: var(--amber);
      white-space: nowrap;
      min-width: 44px;
      font-weight: bold;
    }
    .tl-event { color: var(--text-muted); line-height: 1.5; }

    /* ── Cursor blink ── */
    .cursor {
      display: inline-block;
      width: 8px; height: 1em;
      background: var(--green);
      animation: blink 1s step-end infinite;
      vertical-align: text-bottom;
      margin-left: 2px;
    }
    @keyframes blink { 50% { opacity: 0; } }

    /* Mobile tweaks */
    @media (max-width: 500px) {
      .logo { font-size: 1.8em; }
      .cmd-grid { grid-template-columns: 1fr 1fr; }
    }
  </style>
</head>
<body>
<div class="container">

  <!-- Header -->
  <div class="header">
    <h1 class="logo">Yub<span>Nub</span></h1>
    <p class="tagline">The Social Command-Line for the Web</p>
    <span class="badge">CREATED BY JON AQUINO · 2005 · NOW RUNNING PHP 8.3</span>
  </div>

  <!-- Terminal -->
  <div class="terminal">
    <div class="terminal-bar">
      <div class="dot red"></div>
      <div class="dot yellow"></div>
      <div class="dot"></div>
      <span class="terminal-title">yubnub.org — command shell</span>
    </div>
    <div class="prompt-row">
      <span class="prompt-symbol">$&gt;</span>
      <input id="cmd-input" type="text" placeholder="g nasa  OR  yt starman  OR  w entropy …" autocomplete="off" autocorrect="off" spellcheck="false">
      <button class="run-btn" onclick="runCommand()">RUN ↵</button>
    </div>
    <div id="output"></div>
    <div class="help-text">
      Type a command and press <strong style="color:var(--green)">RUN</strong> or hit <strong style="color:var(--green)">Enter</strong>.
      Click any example below to load it. For commands not listed here, the real
      <a href="https://yubnub.org" target="_blank" rel="noopener" style="color:var(--green)">yubnub.org</a>
      knows thousands more.
    </div>
  </div>

  <!-- Command Gallery -->
  <div class="section-title">▸ POPULAR COMMANDS — click to try</div>
  <div class="cmd-grid" id="cmd-gallery"></div>

  <!-- Syntax -->
  <div class="section-title">▸ COMMAND SYNTAX</div>
  <div class="syntax-box">
    <p>Every YubNub command looks like <span style="color:var(--amber)">COMMAND [ARGS]</span>. The command name is a short alias; the rest is your query.</p>
    <code class="syntax-example">g nasa                  → Google search for "nasa"</code>
    <code class="syntax-example">yt cat videos           → YouTube search for "cat videos"</code>
    <code class="syntax-example">w black hole            → Wikipedia article on "black hole"</code>
    <code class="syntax-example">imdb inception          → IMDB search for "inception"</code>
    <code class="syntax-example">wa integrate x^2 dx     → Wolfram|Alpha computation</code>
    <code class="syntax-example">giphy dancing           → Giphy search for "dancing"</code>
    <p style="margin-top:14px">Commands are defined by the community — anyone can add one on <a href="https://yubnub.org/add_command" target="_blank" style="color:var(--green)">yubnub.org/add_command</a>.</p>
  </div>

  <!-- Timeline -->
  <div class="section-title">▸ YUBNUB HISTORY</div>
  <ul class="timeline">
    <li><span class="tl-year">2005</span><span class="tl-event">Jon Aquino builds YubNub in 20 minutes as a Rails demo during Paul Graham's Startup School. It wins the "best hack" prize.</span></li>
    <li><span class="tl-year">2006</span><span class="tl-event">Featured on Lifehacker, del.icio.us popular, and tech blogs worldwide. Community grows to thousands of commands.</span></li>
    <li><span class="tl-year">2008</span><span class="tl-event">Firefox and later Chrome adopt "keyword search" — a feature directly inspired by YubNub's paradigm.</span></li>
    <li><span class="tl-year">2012</span><span class="tl-event">Server still running on Ubuntu 12.04. Jon keeps the site alive for the community even as usage shifts to browser built-ins.</span></li>
    <li><span class="tl-year">2025</span><span class="tl-event">Jon uses Claude Code to migrate YubNub from Ubuntu 12.04 → Ubuntu 24.04, upgrading to PHP 8.3, MySQL 8.0, and HTTPS. Zero downtime during the DNS cutover.</span></li>
    <li><span class="tl-year">Now</span><span class="tl-event" style="color:var(--green)">yubnub.org is live, HTTPS, and ready for another 20 years. <span class="cursor"></span></span></li>
  </ul>

  <!-- About -->
  <div class="section-title">▸ ABOUT YUBNUB</div>
  <div class="about-box">
    <p>
      <strong>YubNub</strong> is a social command-line for the web, created by
      <strong>Jonathan Aquino</strong> (that's Jon!) in 2005. The idea is simple:
      instead of navigating to a site and typing in a search box, you type a short
      command and your arguments in a single line. <em>g nasa</em> googles "nasa."
      <em>yt lofi</em> searches YouTube. <em>wa pi digits</em> asks Wolfram|Alpha.
    </p>
    <p>
      The twist is that commands are <strong>community-defined</strong>. Anybody can
      create a new shortcut pointing to any URL pattern. Over the years, users have
      contributed thousands of commands — from mainstream search engines to obscure
      academic databases and niche wikis.
    </p>
    <p>
      In December 2025, Jon upgraded YubNub's aging server infrastructure using
      <strong>Claude Code</strong> as a sysadmin guide, moving from a 2012-era
      Ubuntu install all the way to modern PHP 8.3 and MySQL 8.0. Read about it on
      <a href="https://jonaquino.blogspot.com/2025/12/yubnub-upgraded-to-ubuntu-2404.html"
         target="_blank" rel="noopener">his blog</a>.
    </p>
    <p>
      <a href="https://yubnub.org" target="_blank" rel="noopener">→ Try the real YubNub</a>
      &nbsp;·&nbsp;
      <a href="https://github.com/JonathanAquino/yubnub" target="_blank" rel="noopener">→ Source on GitHub</a>
    </p>
  </div>

</div>

<script>
// ── Command database ──────────────────────────────────────────────
const COMMANDS = [
  { name: 'g',      desc: 'Google Search',             url: 'https://www.google.com/search?q=%s',              example: 'g black holes' },
  { name: 'yt',     desc: 'YouTube Search',             url: 'https://www.youtube.com/results?search_query=%s', example: 'yt knight rider theme' },
  { name: 'w',      desc: 'Wikipedia',                  url: 'https://en.wikipedia.org/wiki/%s',                example: 'w General Lee car' },
  { name: 'imdb',   desc: 'IMDB Search',                url: 'https://www.imdb.com/find?q=%s',                  example: 'imdb knight rider' },
  { name: 'wa',     desc: 'Wolfram|Alpha',              url: 'https://www.wolframalpha.com/input/?i=%s',        example: 'wa speed of light' },
  { name: 'gh',     desc: 'GitHub Search',              url: 'https://github.com/search?q=%s',                  example: 'gh yubnub' },
  { name: 'npm',    desc: 'npm Package Search',         url: 'https://www.npmjs.com/search?q=%s',               example: 'npm express' },
  { name: 'ddg',    desc: 'DuckDuckGo',                 url: 'https://duckduckgo.com/?q=%s',                    example: 'ddg privacy tools' },
  { name: 'hn',     desc: 'Hacker News Search',         url: 'https://hn.algolia.com/?query=%s',                example: 'hn yubnub' },
  { name: 'maps',   desc: 'Google Maps',                url: 'https://www.google.com/maps/search/%s',           example: 'maps Surrey BC' },
  { name: 'tw',     desc: 'Twitter / X Search',         url: 'https://twitter.com/search?q=%s',                 example: 'tw yubnub' },
  { name: 'rd',     desc: 'Reddit Search',              url: 'https://www.reddit.com/search/?q=%s',             example: 'rd retro computing' },
  { name: 'az',     desc: 'Amazon Search',              url: 'https://www.amazon.com/s?k=%s',                   example: 'az lego technic' },
  { name: 'giphy',  desc: 'Giphy GIF Search',           url: 'https://giphy.com/search/%s',                     example: 'giphy knight rider' },
  { name: 'dict',   desc: 'Dictionary.com',             url: 'https://www.dictionary.com/browse/%s',            example: 'dict serendipity' },
  { name: 'thes',   desc: 'Thesaurus.com',              url: 'https://www.thesaurus.com/browse/%s',             example: 'thes happy' },
  { name: 'so',     desc: 'Stack Overflow',             url: 'https://stackoverflow.com/search?q=%s',           example: 'so php array sort' },
  { name: 'mdn',    desc: 'MDN Web Docs',               url: 'https://developer.mozilla.org/en-US/search?q=%s', example: 'mdn flexbox' },
  { name: 'pypi',   desc: 'Python Package Index',       url: 'https://pypi.org/search/?q=%s',                   example: 'pypi requests' },
  { name: 'archive',desc: 'Wayback Machine',            url: 'https://web.archive.org/web/*/%s',                example: 'archive yubnub.org' },
];

// Build the gallery
const gallery = document.getElementById('cmd-gallery');
COMMANDS.forEach(cmd => {
  const chip = document.createElement('div');
  chip.className = 'cmd-chip';
  chip.innerHTML = `<span class="cmd-name">${cmd.name} ${cmd.example.slice(cmd.name.length + 1)}</span><span class="cmd-desc">${cmd.desc}</span>`;
  chip.addEventListener('click', () => {
    document.getElementById('cmd-input').value = cmd.example;
    runCommand();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
  gallery.appendChild(chip);
});

// ── Command parser ─────────────────────────────────────────────────
function parseCommand(raw) {
  const trimmed = raw.trim();
  if (!trimmed) return null;
  const spaceIdx = trimmed.indexOf(' ');
  if (spaceIdx === -1) {
    return { cmd: trimmed, args: '' };
  }
  return {
    cmd: trimmed.slice(0, spaceIdx).toLowerCase(),
    args: trimmed.slice(spaceIdx + 1).trim()
  };
}

function buildUrl(template, args) {
  return template.replace('%s', encodeURIComponent(args));
}

function runCommand() {
  const raw = document.getElementById('cmd-input').value;
  const out  = document.getElementById('output');

  if (!raw.trim()) {
    out.innerHTML = '<div class="output-line error">✗ Enter a command first.</div>';
    return;
  }

  const parsed = parseCommand(raw);
  const known  = COMMANDS.find(c => c.name === parsed.cmd);

  out.innerHTML = '';

  // Echo
  addLine(out, `$ ${raw}`, 'comment');

  if (known) {
    if (!parsed.args) {
      addLine(out, `Usage: ${known.name} [search query]`, 'comment');
      addLine(out, `Description: ${known.desc}`, 'comment');
    } else {
      const url = buildUrl(known.url, parsed.args);
      addLine(out, `Command : ${known.name}  →  ${known.desc}`, 'comment');
      addLine(out, `Query   : "${parsed.args}"`, 'comment');
      addLine(out, url, 'url');

      const link = document.createElement('a');
      link.href = url;
      link.target = '_blank';
      link.rel = 'noopener noreferrer';
      link.className = 'go-link';
      link.textContent = '→ GO';
      out.appendChild(link);
    }
  } else {
    addLine(out, `Unknown local command: "${parsed.cmd}"`, 'comment');
    addLine(out, `Forwarding to yubnub.org …`, 'comment');
    const yubnubUrl = `https://yubnub.org/parser/parse?command=${encodeURIComponent(raw)}`;
    addLine(out, yubnubUrl, 'url');
    const link = document.createElement('a');
    link.href = yubnubUrl;
    link.target = '_blank';
    link.rel = 'noopener noreferrer';
    link.className = 'go-link';
    link.textContent = '→ TRY ON YUBNUB.ORG';
    out.appendChild(link);
  }
}

function addLine(container, text, cls) {
  const div = document.createElement('div');
  div.className = `output-line ${cls}`;
  div.textContent = text;
  container.appendChild(div);
}

// Enter key
document.getElementById('cmd-input').addEventListener('keydown', e => {
  if (e.key === 'Enter') runCommand();
});

// Focus input on load
window.addEventListener('DOMContentLoaded', () => {
  document.getElementById('cmd-input').focus();
});
</script>
</body>
</html>
