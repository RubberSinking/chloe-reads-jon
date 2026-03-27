<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Text Transform Lab</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg: #0f1117;
    --surface: #1a1d27;
    --surface2: #232636;
    --border: #2e3245;
    --text: #e2e4f0;
    --muted: #7a7f9a;
    --accent: #7c6af7;
    --accent2: #5bc4bf;
    --danger: #f4718a;
    --success: #63d98b;
    --warn: #f0c060;
    --mono: 'JetBrains Mono', 'Fira Code', 'Cascadia Code', 'Consolas', monospace;
  }

  body {
    font-family: system-ui, -apple-system, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
    background: var(--surface);
  }

  .logo {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .logo-icon {
    width: 32px; height: 32px;
    background: var(--accent);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
  }

  .logo h1 {
    font-size: 1.1em;
    font-weight: 700;
    color: var(--text);
  }

  .logo p {
    font-size: 0.75em;
    color: var(--muted);
  }

  .header-actions {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .kbd {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 4px;
    padding: 2px 6px;
    font-family: var(--mono);
    font-size: 0.7em;
    color: var(--muted);
  }

  .main {
    display: flex;
    flex: 1;
    overflow: hidden;
    min-height: 0;
  }

  /* === SIDEBAR === */
  .sidebar {
    width: 220px;
    min-width: 180px;
    background: var(--surface);
    border-right: 1px solid var(--border);
    overflow-y: auto;
    flex-shrink: 0;
  }

  .sidebar-section {
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
  }

  .sidebar-section:last-child { border-bottom: none; }

  .sidebar-label {
    padding: 4px 14px;
    font-size: 0.65em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
  }

  .transform-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 14px;
    width: 100%;
    border: none;
    background: none;
    color: var(--text);
    cursor: pointer;
    font-size: 0.82em;
    text-align: left;
    transition: background 0.1s;
    border-radius: 0;
  }

  .transform-btn:hover { background: var(--surface2); }

  .transform-btn.active {
    background: color-mix(in srgb, var(--accent) 20%, transparent);
    color: #b8b0ff;
  }

  .transform-btn .icon {
    width: 18px;
    text-align: center;
    font-size: 0.95em;
    flex-shrink: 0;
  }

  /* === EDITOR AREA === */
  .editor-wrap {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }

  .panes {
    flex: 1;
    display: flex;
    overflow: hidden;
    gap: 0;
  }

  .pane {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }

  .pane-header {
    padding: 8px 14px;
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.78em;
    color: var(--muted);
    gap: 8px;
    flex-shrink: 0;
  }

  .pane-title {
    font-weight: 600;
    color: var(--text);
  }

  .pane-actions {
    display: flex;
    gap: 6px;
  }

  .btn {
    padding: 4px 10px;
    border: 1px solid var(--border);
    background: var(--surface2);
    color: var(--text);
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.85em;
    transition: all 0.1s;
    white-space: nowrap;
  }

  .btn:hover { border-color: var(--accent); color: #b8b0ff; }
  .btn.primary { background: var(--accent); border-color: var(--accent); color: #fff; }
  .btn.primary:hover { background: color-mix(in srgb, var(--accent) 80%, white); }

  textarea, .output-box {
    flex: 1;
    padding: 14px;
    font-family: var(--mono);
    font-size: 0.82em;
    line-height: 1.6;
    background: var(--bg);
    color: var(--text);
    border: none;
    resize: none;
    outline: none;
    overflow-y: auto;
    min-height: 0;
  }

  .output-box {
    white-space: pre-wrap;
    word-break: break-word;
  }

  .output-box.error { color: var(--danger); }
  .output-box.success { color: var(--success); }

  .divider {
    width: 1px;
    background: var(--border);
    flex-shrink: 0;
  }

  /* === BOTTOM BAR === */
  .bottom-bar {
    padding: 6px 14px;
    background: var(--surface);
    border-top: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 0.72em;
    color: var(--muted);
    flex-shrink: 0;
    flex-wrap: wrap;
  }

  .stat { display: flex; align-items: center; gap: 4px; }
  .stat-val { color: var(--text); font-weight: 600; }

  /* === RUN BAR === */
  .run-bar {
    padding: 8px 14px;
    background: var(--surface2);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
    flex-wrap: wrap;
  }

  .active-transform-name {
    font-size: 0.85em;
    font-weight: 600;
    color: var(--accent);
    flex: 1;
  }

  .active-transform-desc {
    font-size: 0.78em;
    color: var(--muted);
  }

  /* === PARAM ROW === */
  .param-row {
    padding: 6px 14px;
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
    flex-wrap: wrap;
  }

  .param-row label {
    font-size: 0.78em;
    color: var(--muted);
  }

  .param-row input, .param-row select {
    background: var(--surface2);
    border: 1px solid var(--border);
    color: var(--text);
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 0.8em;
    outline: none;
  }

  .param-row input:focus, .param-row select:focus {
    border-color: var(--accent);
  }

  /* === HISTORY === */
  .history-panel {
    position: fixed;
    top: 60px; right: 0;
    width: 280px;
    height: calc(100vh - 60px);
    background: var(--surface);
    border-left: 1px solid var(--border);
    z-index: 100;
    transform: translateX(100%);
    transition: transform 0.2s ease;
    overflow-y: auto;
    padding: 14px;
  }

  .history-panel.open { transform: translateX(0); }

  .history-panel h3 {
    font-size: 0.85em;
    color: var(--muted);
    margin-bottom: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }

  .history-item {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 6px;
    padding: 8px 10px;
    margin-bottom: 8px;
    cursor: pointer;
    transition: border-color 0.1s;
  }

  .history-item:hover { border-color: var(--accent); }

  .history-item .h-transform {
    font-size: 0.75em;
    color: var(--accent);
    font-weight: 600;
    margin-bottom: 3px;
  }

  .history-item .h-preview {
    font-family: var(--mono);
    font-size: 0.7em;
    color: var(--muted);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* === TOAST === */
  .toast {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 0.85em;
    color: var(--success);
    z-index: 200;
    transition: transform 0.2s ease;
    pointer-events: none;
  }
  .toast.show { transform: translateX(-50%) translateY(0); }

  /* === MOBILE === */
  @media (max-width: 640px) {
    .sidebar { width: 160px; min-width: 140px; }
    .transform-btn { font-size: 0.75em; padding: 6px 10px; }
    .panes { flex-direction: column; }
    .divider { width: 100%; height: 1px; }
  }

  @media (max-width: 480px) {
    .sidebar { display: none; }
  }

  /* Scrollbar */
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
</style>
</head>
<body>

<header>
  <div class="logo">
    <div class="logo-icon">⚗️</div>
    <div>
      <h1>Text Transform Lab</h1>
      <p>Select a transform → type text → see results instantly</p>
    </div>
  </div>
  <div class="header-actions">
    <span class="kbd">⌘Enter</span><span style="font-size:.78em;color:var(--muted)">run</span>
    <button class="btn" onclick="toggleHistory()">History</button>
  </div>
</header>

<div class="main">
  <!-- SIDEBAR -->
  <nav class="sidebar">

    <div class="sidebar-section">
      <div class="sidebar-label">JSON</div>
      <button class="transform-btn" onclick="setTransform('json-beautify')"><span class="icon">✨</span> Beautify JSON</button>
      <button class="transform-btn" onclick="setTransform('json-minify')"><span class="icon">🗜️</span> Minify JSON</button>
      <button class="transform-btn" onclick="setTransform('json-keys')"><span class="icon">🔑</span> List JSON Keys</button>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Lines</div>
      <button class="transform-btn" onclick="setTransform('sort-az')"><span class="icon">↑</span> Sort A → Z</button>
      <button class="transform-btn" onclick="setTransform('sort-za')"><span class="icon">↓</span> Sort Z → A</button>
      <button class="transform-btn" onclick="setTransform('sort-len')"><span class="icon">📏</span> Sort by Length</button>
      <button class="transform-btn" onclick="setTransform('reverse')"><span class="icon">↕️</span> Reverse Lines</button>
      <button class="transform-btn" onclick="setTransform('dedup')"><span class="icon">🧹</span> Remove Duplicates</button>
      <button class="transform-btn" onclick="setTransform('shuffle')"><span class="icon">🎲</span> Shuffle Lines</button>
      <button class="transform-btn" onclick="setTransform('number-lines')"><span class="icon">🔢</span> Add Line Numbers</button>
      <button class="transform-btn" onclick="setTransform('strip-numbers')"><span class="icon">✂️</span> Strip Line Numbers</button>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Case</div>
      <button class="transform-btn" onclick="setTransform('upper')"><span class="icon">A</span> UPPERCASE</button>
      <button class="transform-btn" onclick="setTransform('lower')"><span class="icon">a</span> lowercase</button>
      <button class="transform-btn" onclick="setTransform('title')"><span class="icon">Aa</span> Title Case</button>
      <button class="transform-btn" onclick="setTransform('camel')"><span class="icon">🐪</span> camelCase</button>
      <button class="transform-btn" onclick="setTransform('pascal')"><span class="icon">P</span> PascalCase</button>
      <button class="transform-btn" onclick="setTransform('snake')"><span class="icon">🐍</span> snake_case</button>
      <button class="transform-btn" onclick="setTransform('kebab')"><span class="icon">-</span> kebab-case</button>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Text</div>
      <button class="transform-btn" onclick="setTransform('trim')"><span class="icon">✂️</span> Trim Whitespace</button>
      <button class="transform-btn" onclick="setTransform('word-freq')"><span class="icon">📊</span> Word Frequency</button>
      <button class="transform-btn" onclick="setTransform('char-freq')"><span class="icon">🔤</span> Char Frequency</button>
      <button class="transform-btn" onclick="setTransform('count-lines')"><span class="icon">🔢</span> Count Lines</button>
      <button class="transform-btn" onclick="setTransform('extract-urls')"><span class="icon">🔗</span> Extract URLs</button>
      <button class="transform-btn" onclick="setTransform('extract-emails')"><span class="icon">📧</span> Extract Emails</button>
      <button class="transform-btn" onclick="setTransform('extract-numbers')"><span class="icon">🔢</span> Extract Numbers</button>
      <button class="transform-btn" onclick="setTransform('remove-empty')"><span class="icon">🗑️</span> Remove Empty Lines</button>
      <button class="transform-btn" onclick="setTransform('wrap')"><span class="icon">↩️</span> Word Wrap</button>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Encode / Decode</div>
      <button class="transform-btn" onclick="setTransform('b64-enc')"><span class="icon">🔒</span> Base64 Encode</button>
      <button class="transform-btn" onclick="setTransform('b64-dec')"><span class="icon">🔓</span> Base64 Decode</button>
      <button class="transform-btn" onclick="setTransform('url-enc')"><span class="icon">🌐</span> URL Encode</button>
      <button class="transform-btn" onclick="setTransform('url-dec')"><span class="icon">🌐</span> URL Decode</button>
      <button class="transform-btn" onclick="setTransform('html-esc')"><span class="icon">&lt;&gt;</span> HTML Escape</button>
      <button class="transform-btn" onclick="setTransform('html-unesc')"><span class="icon">&lt;&gt;</span> HTML Unescape</button>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Math</div>
      <button class="transform-btn" onclick="setTransform('eval-math')"><span class="icon">🧮</span> Evaluate Math</button>
      <button class="transform-btn" onclick="setTransform('sum-lines')"><span class="icon">Σ</span> Sum Numbers</button>
    </div>

    <div class="sidebar-section">
      <div class="sidebar-label">Prefix / Suffix</div>
      <button class="transform-btn" onclick="setTransform('add-prefix')"><span class="icon">⬅️</span> Add Prefix</button>
      <button class="transform-btn" onclick="setTransform('add-suffix')"><span class="icon">➡️</span> Add Suffix</button>
      <button class="transform-btn" onclick="setTransform('quote-lines')"><span class="icon">"</span> Quote Each Line</button>
      <button class="transform-btn" onclick="setTransform('csv-to-list')"><span class="icon">📋</span> CSV → Lines</button>
      <button class="transform-btn" onclick="setTransform('list-to-csv')"><span class="icon">📋</span> Lines → CSV</button>
    </div>

  </nav>

  <!-- MAIN EDITOR -->
  <div class="editor-wrap">
    <div class="run-bar">
      <div>
        <div class="active-transform-name" id="activeName">← Pick a transform</div>
        <div class="active-transform-desc" id="activeDesc">Choose any transform from the left panel</div>
      </div>
      <button class="btn primary" onclick="runTransform()">▶ Run</button>
    </div>
    <div class="param-row" id="paramRow" style="display:none"></div>

    <div class="panes">
      <div class="pane">
        <div class="pane-header">
          <span class="pane-title">Input</span>
          <div class="pane-actions">
            <button class="btn" onclick="pasteClip()">Paste</button>
            <button class="btn" onclick="clearInput()">Clear</button>
          </div>
        </div>
        <textarea id="inputBox" placeholder="Paste or type your text here…" oninput="liveRun()"></textarea>
      </div>

      <div class="divider"></div>

      <div class="pane">
        <div class="pane-header">
          <span class="pane-title">Output</span>
          <div class="pane-actions">
            <button class="btn" onclick="copyOutput()">Copy</button>
            <button class="btn" onclick="swapToInput()">→ Input</button>
          </div>
        </div>
        <div class="output-box" id="outputBox">Output will appear here after you pick a transform and type some text.</div>
      </div>
    </div>

    <div class="bottom-bar">
      <span class="stat">Lines: <span class="stat-val" id="statLines">0</span></span>
      <span class="stat">Words: <span class="stat-val" id="statWords">0</span></span>
      <span class="stat">Chars: <span class="stat-val" id="statChars">0</span></span>
      <span class="stat" id="statExtra"></span>
    </div>
  </div>
</div>

<!-- HISTORY -->
<div class="history-panel" id="historyPanel">
  <h3>Recent Runs</h3>
  <div id="historyList"><p style="font-size:.78em;color:var(--muted)">No history yet.</p></div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
// ============================================================
// TRANSFORMS
// ============================================================
const TRANSFORMS = {
  'json-beautify': {
    name: 'Beautify JSON',
    desc: 'Format JSON with 2-space indentation',
    fn: (t) => {
      try { return JSON.stringify(JSON.parse(t), null, 2); }
      catch(e) { return '❌ Invalid JSON: ' + e.message; }
    }
  },
  'json-minify': {
    name: 'Minify JSON',
    desc: 'Compact JSON — remove all whitespace',
    fn: (t) => {
      try { return JSON.stringify(JSON.parse(t)); }
      catch(e) { return '❌ Invalid JSON: ' + e.message; }
    }
  },
  'json-keys': {
    name: 'List JSON Keys',
    desc: 'Extract top-level keys from a JSON object',
    fn: (t) => {
      try {
        const obj = JSON.parse(t);
        if (Array.isArray(obj)) return obj.map((v,i) => `[${i}]`).join('\n');
        return Object.keys(obj).join('\n');
      } catch(e) { return '❌ Invalid JSON: ' + e.message; }
    }
  },
  'sort-az': {
    name: 'Sort A → Z',
    desc: 'Sort lines alphabetically ascending',
    fn: (t) => lines(t).slice().sort((a,b) => a.localeCompare(b)).join('\n')
  },
  'sort-za': {
    name: 'Sort Z → A',
    desc: 'Sort lines alphabetically descending',
    fn: (t) => lines(t).slice().sort((a,b) => b.localeCompare(a)).join('\n')
  },
  'sort-len': {
    name: 'Sort by Length',
    desc: 'Sort lines by character length (shortest first)',
    fn: (t) => lines(t).slice().sort((a,b) => a.length - b.length).join('\n')
  },
  'reverse': {
    name: 'Reverse Lines',
    desc: 'Flip line order upside down',
    fn: (t) => lines(t).slice().reverse().join('\n')
  },
  'dedup': {
    name: 'Remove Duplicates',
    desc: 'Keep only the first occurrence of each line',
    fn: (t) => [...new Set(lines(t))].join('\n')
  },
  'shuffle': {
    name: 'Shuffle Lines',
    desc: 'Randomly reorder lines (Fisher-Yates)',
    fn: (t) => {
      const arr = lines(t).slice();
      for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
      }
      return arr.join('\n');
    }
  },
  'number-lines': {
    name: 'Add Line Numbers',
    desc: 'Prefix each line with its line number',
    fn: (t) => lines(t).map((l,i) => `${String(i+1).padStart(3, ' ')}. ${l}`).join('\n')
  },
  'strip-numbers': {
    name: 'Strip Line Numbers',
    desc: 'Remove leading "N. " or "N: " prefixes',
    fn: (t) => lines(t).map(l => l.replace(/^\s*\d+[\.\:\)]\s*/, '')).join('\n')
  },
  'upper': { name: 'UPPERCASE', desc: 'Convert all text to uppercase', fn: (t) => t.toUpperCase() },
  'lower': { name: 'lowercase', desc: 'Convert all text to lowercase', fn: (t) => t.toLowerCase() },
  'title': {
    name: 'Title Case',
    desc: 'Capitalize the first letter of each word',
    fn: (t) => t.replace(/\w\S*/g, w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase())
  },
  'camel': {
    name: 'camelCase',
    desc: 'Convert to camelCase (first word lowercase)',
    fn: (t) => lines(t).map(l => {
      const words = l.trim().split(/[\s_\-]+/);
      return words.map((w, i) => i === 0 ? w.toLowerCase() : w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
    }).join('\n')
  },
  'pascal': {
    name: 'PascalCase',
    desc: 'Convert to PascalCase (each word capitalized)',
    fn: (t) => lines(t).map(l => {
      return l.trim().split(/[\s_\-]+/).map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase()).join('');
    }).join('\n')
  },
  'snake': {
    name: 'snake_case',
    desc: 'Convert to snake_case',
    fn: (t) => lines(t).map(l => l.trim().replace(/\s+/g, '_').replace(/([a-z])([A-Z])/g, '$1_$2').toLowerCase()).join('\n')
  },
  'kebab': {
    name: 'kebab-case',
    desc: 'Convert to kebab-case',
    fn: (t) => lines(t).map(l => l.trim().replace(/\s+/g, '-').replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase()).join('\n')
  },
  'trim': {
    name: 'Trim Whitespace',
    desc: 'Strip leading and trailing whitespace from each line',
    fn: (t) => lines(t).map(l => l.trim()).join('\n')
  },
  'word-freq': {
    name: 'Word Frequency',
    desc: 'Count how many times each word appears',
    fn: (t) => {
      const freq = {};
      t.toLowerCase().match(/\b\w+\b/g)?.forEach(w => freq[w] = (freq[w]||0)+1);
      return Object.entries(freq).sort((a,b) => b[1]-a[1]).map(([w,n]) => `${String(n).padStart(5, ' ')}  ${w}`).join('\n');
    }
  },
  'char-freq': {
    name: 'Char Frequency',
    desc: 'Count occurrences of each character',
    fn: (t) => {
      const freq = {};
      [...t].forEach(c => { if (c !== '\n') freq[c] = (freq[c]||0)+1; });
      return Object.entries(freq).sort((a,b) => b[1]-a[1]).slice(0,40).map(([c,n]) => `${String(n).padStart(5,' ')}  ${c === ' ' ? '(space)' : c}`).join('\n');
    }
  },
  'count-lines': {
    name: 'Count Lines',
    desc: 'Show total lines, non-empty lines, and empty lines',
    fn: (t) => {
      const ls = lines(t);
      const empty = ls.filter(l => l.trim() === '').length;
      return `Total lines:     ${ls.length}\nNon-empty lines: ${ls.length - empty}\nEmpty lines:     ${empty}`;
    }
  },
  'extract-urls': {
    name: 'Extract URLs',
    desc: 'Pull out all http/https URLs',
    fn: (t) => {
      const urls = t.match(/https?:\/\/[^\s"'<>)]+/g);
      return urls ? [...new Set(urls)].join('\n') : '(no URLs found)';
    }
  },
  'extract-emails': {
    name: 'Extract Emails',
    desc: 'Pull out all email addresses',
    fn: (t) => {
      const emails = t.match(/[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/g);
      return emails ? [...new Set(emails)].join('\n') : '(no emails found)';
    }
  },
  'extract-numbers': {
    name: 'Extract Numbers',
    desc: 'Pull out all numeric values (including decimals)',
    fn: (t) => {
      const nums = t.match(/-?\d+(\.\d+)?/g);
      return nums ? nums.join('\n') : '(no numbers found)';
    }
  },
  'remove-empty': {
    name: 'Remove Empty Lines',
    desc: 'Delete all blank or whitespace-only lines',
    fn: (t) => lines(t).filter(l => l.trim() !== '').join('\n')
  },
  'wrap': {
    name: 'Word Wrap',
    desc: 'Wrap text at N characters per line',
    param: { label: 'Width:', id: 'wrapWidth', type: 'number', value: '72', min: 20, max: 200 },
    fn: (t, p) => {
      const w = parseInt(p.wrapWidth) || 72;
      return lines(t).map(l => {
        const words = l.split(' ');
        let result = '', current = '';
        words.forEach(word => {
          if ((current + ' ' + word).trim().length <= w) {
            current = current ? current + ' ' + word : word;
          } else {
            if (current) result += (result ? '\n' : '') + current;
            current = word;
          }
        });
        return result + (result && current ? '\n' : '') + current;
      }).join('\n');
    }
  },
  'b64-enc': {
    name: 'Base64 Encode',
    desc: 'Encode text to Base64',
    fn: (t) => { try { return btoa(unescape(encodeURIComponent(t))); } catch(e) { return '❌ ' + e.message; } }
  },
  'b64-dec': {
    name: 'Base64 Decode',
    desc: 'Decode Base64 to text',
    fn: (t) => { try { return decodeURIComponent(escape(atob(t.trim()))); } catch(e) { return '❌ Invalid Base64: ' + e.message; } }
  },
  'url-enc': {
    name: 'URL Encode',
    desc: 'Percent-encode text for use in URLs',
    fn: (t) => encodeURIComponent(t)
  },
  'url-dec': {
    name: 'URL Decode',
    desc: 'Decode percent-encoded URL text',
    fn: (t) => { try { return decodeURIComponent(t); } catch(e) { return '❌ Invalid encoding: ' + e.message; } }
  },
  'html-esc': {
    name: 'HTML Escape',
    desc: 'Replace <, >, &, ", \' with HTML entities',
    fn: (t) => t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;')
  },
  'html-unesc': {
    name: 'HTML Unescape',
    desc: 'Convert HTML entities back to characters',
    fn: (t) => t.replace(/&amp;/g,'&').replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&quot;/g,'"').replace(/&#39;/g,"'").replace(/&nbsp;/g,' ')
  },
  'eval-math': {
    name: 'Evaluate Math',
    desc: 'Evaluate each line as a math expression — e.g. "2 + 2 * 5"',
    fn: (t) => {
      return lines(t).map(l => {
        const expr = l.trim();
        if (!expr) return '';
        try {
          // Safe-ish eval: only allow numbers, operators, parens, spaces
          if (!/^[\d\s\+\-\*\/\.\(\)\%\^e]+$/i.test(expr.replace(/sqrt|sin|cos|tan|log|abs|PI/gi,''))) {
            return `${expr}  →  ❌ unsafe expression`;
          }
          const result = Function('"use strict"; return (' + expr.replace(/\^/g, '**') + ')')();
          return `${expr}  →  ${result}`;
        } catch(e) {
          return `${expr}  →  ❌ error`;
        }
      }).join('\n');
    }
  },
  'sum-lines': {
    name: 'Sum Numbers',
    desc: 'Add up all numbers found in the text',
    fn: (t) => {
      const nums = (t.match(/-?\d+(\.\d+)?/g) || []).map(Number);
      if (!nums.length) return '(no numbers found)';
      const sum = nums.reduce((a,b) => a+b, 0);
      return `Numbers found: ${nums.length}\nValues: ${nums.join(', ')}\n\nSum: ${sum}\nMean: ${(sum/nums.length).toFixed(4)}\nMin: ${Math.min(...nums)}\nMax: ${Math.max(...nums)}`;
    }
  },
  'add-prefix': {
    name: 'Add Prefix',
    desc: 'Prepend text to every line',
    param: { label: 'Prefix:', id: 'prefixVal', type: 'text', value: '- ', placeholder: 'e.g.  - ' },
    fn: (t, p) => lines(t).map(l => (p.prefixVal || '') + l).join('\n')
  },
  'add-suffix': {
    name: 'Add Suffix',
    desc: 'Append text to every line',
    param: { label: 'Suffix:', id: 'suffixVal', type: 'text', value: ';', placeholder: 'e.g.  ;' },
    fn: (t, p) => lines(t).map(l => l + (p.suffixVal || '')).join('\n')
  },
  'quote-lines': {
    name: 'Quote Each Line',
    desc: 'Wrap every line in double quotes',
    fn: (t) => lines(t).map(l => `"${l.replace(/"/g, '\\"')}"`).join('\n')
  },
  'csv-to-list': {
    name: 'CSV → Lines',
    desc: 'Split comma-separated values into one item per line',
    fn: (t) => t.split(',').map(s => s.trim()).join('\n')
  },
  'list-to-csv': {
    name: 'Lines → CSV',
    desc: 'Join lines into a comma-separated string',
    fn: (t) => lines(t).filter(l => l.trim()).join(', ')
  },
};

// ============================================================
// STATE
// ============================================================
let currentTransform = null;
let history = [];

function lines(t) { return t.split('\n'); }

function setTransform(id) {
  currentTransform = id;
  const t = TRANSFORMS[id];

  // Update button styles
  document.querySelectorAll('.transform-btn').forEach(b => b.classList.remove('active'));
  event.currentTarget.classList.add('active');

  // Update run bar
  document.getElementById('activeName').textContent = t.name;
  document.getElementById('activeDesc').textContent = t.desc;

  // Param row
  const paramRow = document.getElementById('paramRow');
  if (t.param) {
    const p = t.param;
    paramRow.style.display = 'flex';
    paramRow.innerHTML = `
      <label for="${p.id}">${p.label}</label>
      <input type="${p.type}" id="${p.id}" value="${p.value || ''}" 
        ${p.min ? `min="${p.min}"` : ''} ${p.max ? `max="${p.max}"` : ''}
        ${p.placeholder ? `placeholder="${p.placeholder}"` : ''}
        oninput="liveRun()" style="width:${p.type==='number'?'70px':'160px'}">
    `;
  } else {
    paramRow.style.display = 'none';
    paramRow.innerHTML = '';
  }

  liveRun();
}

function getParams() {
  const params = {};
  document.querySelectorAll('#paramRow input, #paramRow select').forEach(el => {
    params[el.id] = el.value;
  });
  return params;
}

function runTransform() {
  if (!currentTransform) {
    showToast('Pick a transform first!', 'warn');
    return;
  }
  const input = document.getElementById('inputBox').value;
  const t = TRANSFORMS[currentTransform];
  const out = t.fn(input, getParams());
  const outBox = document.getElementById('outputBox');
  outBox.textContent = out;
  outBox.className = 'output-box' + (out.startsWith('❌') ? ' error' : '');

  // History
  history.unshift({ transform: t.name, input: input.slice(0, 80), output: out });
  if (history.length > 20) history.pop();
  renderHistory();
}

let liveTimer;
function liveRun() {
  clearTimeout(liveTimer);
  liveTimer = setTimeout(() => {
    runTransform();
    updateStats();
  }, 150);
}

function updateStats() {
  const t = document.getElementById('inputBox').value;
  document.getElementById('statChars').textContent = t.length;
  document.getElementById('statWords').textContent = (t.match(/\b\w+\b/g) || []).length;
  document.getElementById('statLines').textContent = t ? t.split('\n').length : 0;
}

function clearInput() {
  document.getElementById('inputBox').value = '';
  document.getElementById('outputBox').textContent = 'Output will appear here.';
  document.getElementById('outputBox').className = 'output-box';
  updateStats();
}

async function pasteClip() {
  try {
    const text = await navigator.clipboard.readText();
    document.getElementById('inputBox').value = text;
    updateStats();
    liveRun();
    showToast('Pasted from clipboard ✓');
  } catch(e) {
    showToast('Paste manually with Ctrl+V / ⌘V', 'warn');
  }
}

async function copyOutput() {
  const text = document.getElementById('outputBox').textContent;
  try {
    await navigator.clipboard.writeText(text);
    showToast('Copied to clipboard ✓');
  } catch(e) {
    showToast('Select and copy manually', 'warn');
  }
}

function swapToInput() {
  const out = document.getElementById('outputBox').textContent;
  document.getElementById('inputBox').value = out;
  updateStats();
  liveRun();
  showToast('Output → Input ✓');
}

function toggleHistory() {
  document.getElementById('historyPanel').classList.toggle('open');
}

function renderHistory() {
  const list = document.getElementById('historyList');
  if (!history.length) {
    list.innerHTML = '<p style="font-size:.78em;color:var(--muted)">No history yet.</p>';
    return;
  }
  list.innerHTML = history.map((h, i) => `
    <div class="history-item" onclick="restoreHistory(${i})">
      <div class="h-transform">${h.transform}</div>
      <div class="h-preview">${h.input.replace(/</g,'&lt;') || '(empty)'}</div>
    </div>
  `).join('');
}

function restoreHistory(i) {
  const h = history[i];
  document.getElementById('inputBox').value = h.input;
  updateStats();
  liveRun();
  toggleHistory();
}

let toastTimer;
function showToast(msg, type) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.style.color = type === 'warn' ? 'var(--warn)' : 'var(--success)';
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove('show'), 2000);
}

// Keyboard shortcut: Ctrl/Cmd + Enter = run
document.addEventListener('keydown', e => {
  if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
    e.preventDefault();
    runTransform();
  }
});

// Init stats
updateStats();
document.getElementById('inputBox').addEventListener('input', updateStats);
</script>
</body>
</html>
