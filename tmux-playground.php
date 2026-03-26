<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>tmux Playground</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  background: #1a1b1e;
  color: #cdd6f4;
  font-family: 'Cascadia Code', 'Fira Code', 'SF Mono', Menlo, 'Courier New', monospace;
  height: 100vh;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

/* ── Top bar ── */
#topbar {
  background: #181825;
  border-bottom: 1px solid #313244;
  padding: 8px 16px;
  display: flex;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
}
#topbar h1 {
  font-size: .85rem;
  letter-spacing: .06em;
  color: #cba6f7;
  font-weight: normal;
}
#topbar .tagline {
  font-size: .72rem;
  color: #6c7086;
  flex: 1;
}
#topbar .pill {
  font-size: .68rem;
  background: #313244;
  color: #a6adc8;
  padding: 2px 8px;
  border-radius: 10px;
}

/* ── Help ribbon ── */
#help-bar {
  background: #11111b;
  border-bottom: 1px solid #313244;
  padding: 5px 16px;
  font-size: .68rem;
  color: #585b70;
  white-space: nowrap;
  overflow-x: auto;
  flex-shrink: 0;
  display: flex;
  gap: 20px;
  align-items: center;
}
#help-bar span { color: #89b4fa; }
#help-bar .sep { color: #313244; }

/* ── Main area: sidebar + workspace ── */
#main {
  display: flex;
  flex: 1;
  overflow: hidden;
}

/* ── Sidebar (command reference) ── */
#sidebar {
  width: 220px;
  background: #181825;
  border-right: 1px solid #313244;
  overflow-y: auto;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
}
#sidebar h2 {
  font-size: .7rem;
  letter-spacing: .1em;
  color: #6c7086;
  padding: 10px 12px 6px;
  text-transform: uppercase;
  border-bottom: 1px solid #313244;
}
.cmd-group { border-bottom: 1px solid #1e1e2e; }
.cmd-group-title {
  font-size: .66rem;
  color: #89b4fa;
  padding: 7px 12px 4px;
  text-transform: uppercase;
  letter-spacing: .08em;
}
.cmd-item {
  display: flex;
  align-items: baseline;
  gap: 6px;
  padding: 3px 12px;
  cursor: pointer;
  transition: background .1s;
  border-radius: 0;
}
.cmd-item:hover { background: #313244; }
.cmd-item .key {
  font-size: .7rem;
  color: #f38ba8;
  min-width: 90px;
  flex-shrink: 0;
}
.cmd-item .desc {
  font-size: .65rem;
  color: #6c7086;
  line-height: 1.3;
}
.cmd-item:hover .desc { color: #a6adc8; }

/* ── Workspace ── */
#workspace {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  background: #1e1e2e;
  position: relative;
}

/* tmux status bar (bottom) */
#status-bar {
  background: #89b4fa;
  color: #1e1e2e;
  font-size: .75rem;
  padding: 2px 8px;
  display: flex;
  align-items: center;
  gap: 0;
  flex-shrink: 0;
  z-index: 10;
}
#status-left {
  background: #cba6f7;
  color: #1e1e2e;
  padding: 0 8px;
  font-weight: bold;
  margin-right: 4px;
  font-size: .75rem;
}
#status-windows {
  display: flex;
  gap: 2px;
  flex: 1;
}
.win-tab {
  padding: 0 8px;
  cursor: pointer;
  font-size: .72rem;
  background: #74c7ec;
  color: #1e1e2e;
  white-space: nowrap;
}
.win-tab.active { background: #1e1e2e; color: #89b4fa; font-weight: bold; }
#status-right {
  font-size: .68rem;
  color: #1e1e2e;
  padding: 0 8px;
}

/* pane container */
#pane-container {
  flex: 1;
  display: flex;
  position: relative;
  overflow: hidden;
}

/* individual pane */
.pane {
  display: flex;
  flex-direction: column;
  overflow: hidden;
  position: relative;
  min-width: 80px;
  min-height: 40px;
}
.pane.active { outline: 2px solid #89b4fa; outline-offset: -2px; }
.pane-output {
  flex: 1;
  overflow-y: auto;
  padding: 6px 8px;
  font-size: .78rem;
  line-height: 1.5;
  scroll-behavior: smooth;
}
.pane-input-row {
  display: flex;
  align-items: center;
  padding: 3px 8px;
  background: rgba(0,0,0,.25);
  border-top: 1px solid #313244;
  gap: 4px;
  flex-shrink: 0;
}
.pane-prompt {
  color: #a6e3a1;
  font-size: .78rem;
  white-space: nowrap;
  user-select: none;
}
.pane-input {
  background: transparent;
  border: none;
  outline: none;
  color: #cdd6f4;
  font-family: inherit;
  font-size: .78rem;
  flex: 1;
  caret-color: #f5c2e7;
}
.pane-divider-h {
  width: 3px;
  background: #313244;
  cursor: col-resize;
  flex-shrink: 0;
  position: relative;
  z-index: 5;
}
.pane-divider-h:hover, .pane-divider-h.dragging { background: #89b4fa; }
.pane-divider-v {
  height: 3px;
  background: #313244;
  cursor: row-resize;
  flex-shrink: 0;
  z-index: 5;
}
.pane-divider-v:hover, .pane-divider-v.dragging { background: #89b4fa; }

/* column layout helper */
.col-group {
  display: flex;
  flex-direction: column;
  flex: 1;
  overflow: hidden;
}

/* output line types */
.line-cmd   { color: #cdd6f4; }
.line-out   { color: #a6adc8; }
.line-err   { color: #f38ba8; }
.line-ok    { color: #a6e3a1; }
.line-info  { color: #89dceb; }
.line-warn  { color: #f9e2af; }
.line-dim   { color: #6c7086; }
.line-bold  { color: #cba6f7; font-weight: bold; }

/* toast */
#toast {
  position: fixed;
  bottom: 40px;
  left: 50%;
  transform: translateX(-50%) translateY(20px);
  background: #313244;
  color: #cdd6f4;
  font-size: .78rem;
  padding: 6px 16px;
  border-radius: 6px;
  opacity: 0;
  transition: opacity .2s, transform .2s;
  pointer-events: none;
  z-index: 100;
  white-space: nowrap;
}
#toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }

/* overlay panel for big commands */
#overlay {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(17,17,27,.9);
  z-index: 200;
  align-items: center;
  justify-content: center;
  padding: 20px;
}
#overlay.open { display: flex; }
#overlay-box {
  background: #181825;
  border: 1px solid #89b4fa;
  border-radius: 8px;
  padding: 20px 24px;
  max-width: 480px;
  width: 100%;
  max-height: 80vh;
  overflow-y: auto;
}
#overlay-box h3 { color: #cba6f7; font-size: 1rem; margin-bottom: 12px; }
#overlay-box p { color: #a6adc8; font-size: .83rem; line-height: 1.7; margin-bottom: 10px; }
#overlay-box code { color: #f38ba8; background: #11111b; padding: 1px 4px; border-radius: 3px; }
#overlay-close {
  margin-top: 14px;
  background: #313244;
  border: none;
  color: #cdd6f4;
  padding: 6px 18px;
  border-radius: 6px;
  cursor: pointer;
  font-family: inherit;
  font-size: .82rem;
}
#overlay-close:hover { background: #45475a; }

/* mobile: collapse sidebar */
@media (max-width: 600px) {
  #sidebar { width: 0; display: none; }
  .pane-output { font-size: .72rem; }
}
</style>
</head>
<body>

<div id="topbar">
  <h1>tmux Playground</h1>
  <div class="tagline">Interactive tmux simulator — split panes, windows, and more</div>
  <div class="pill">Ctrl+B = prefix</div>
</div>

<div id="help-bar">
  <span>Ctrl+B</span> %&nbsp;vsplit &nbsp;
  <span class="sep">·</span>
  <span>Ctrl+B</span> "&nbsp;hsplit &nbsp;
  <span class="sep">·</span>
  <span>Ctrl+B</span> c&nbsp;new&nbsp;window &nbsp;
  <span class="sep">·</span>
  <span>Ctrl+B</span> o&nbsp;next&nbsp;pane &nbsp;
  <span class="sep">·</span>
  <span>Ctrl+B</span> x&nbsp;kill&nbsp;pane &nbsp;
  <span class="sep">·</span>
  <span>Ctrl+B</span> z&nbsp;zoom &nbsp;
  <span class="sep">·</span>
  type&nbsp;<span>help</span>&nbsp;in any pane
</div>

<div id="main">
  <div id="sidebar">
    <h2>Commands</h2>
    <div class="cmd-group">
      <div class="cmd-group-title">Panes</div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B %')"><span class="key">Ctrl+B %</span><span class="desc">split vertical</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B \"')"><span class="key">Ctrl+B "</span><span class="desc">split horizontal</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B o')"><span class="key">Ctrl+B o</span><span class="desc">next pane</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B x')"><span class="key">Ctrl+B x</span><span class="desc">kill pane</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B z')"><span class="key">Ctrl+B z</span><span class="desc">zoom/unzoom pane</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B {')"><span class="key">Ctrl+B {</span><span class="desc">swap pane left</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B }')"><span class="key">Ctrl+B }</span><span class="desc">swap pane right</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B q')"><span class="key">Ctrl+B q</span><span class="desc">show pane numbers</span></div>
    </div>
    <div class="cmd-group">
      <div class="cmd-group-title">Windows</div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B c')"><span class="key">Ctrl+B c</span><span class="desc">new window</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B n')"><span class="key">Ctrl+B n</span><span class="desc">next window</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B p')"><span class="key">Ctrl+B p</span><span class="desc">prev window</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B ,')"><span class="key">Ctrl+B ,</span><span class="desc">rename window</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B w')"><span class="key">Ctrl+B w</span><span class="desc">list windows</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B &amp;')"><span class="key">Ctrl+B &amp;</span><span class="desc">kill window</span></div>
    </div>
    <div class="cmd-group">
      <div class="cmd-group-title">Session</div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B d')"><span class="key">Ctrl+B d</span><span class="desc">detach session</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B $')"><span class="key">Ctrl+B $</span><span class="desc">rename session</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B s')"><span class="key">Ctrl+B s</span><span class="desc">list sessions</span></div>
    </div>
    <div class="cmd-group">
      <div class="cmd-group-title">Copy mode</div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B [')"><span class="key">Ctrl+B [</span><span class="desc">enter copy mode</span></div>
      <div class="cmd-item" onclick="insertCmd('Ctrl+B ]')"><span class="key">Ctrl+B ]</span><span class="desc">paste buffer</span></div>
    </div>
    <div class="cmd-group">
      <div class="cmd-group-title">Try typing</div>
      <div class="cmd-item" onclick="insertCmd('ls')"><span class="key" style="color:#a6e3a1">ls</span><span class="desc">list files</span></div>
      <div class="cmd-item" onclick="insertCmd('pwd')"><span class="key" style="color:#a6e3a1">pwd</span><span class="desc">print directory</span></div>
      <div class="cmd-item" onclick="insertCmd('date')"><span class="key" style="color:#a6e3a1">date</span><span class="desc">show date/time</span></div>
      <div class="cmd-item" onclick="insertCmd('echo hello')"><span class="key" style="color:#a6e3a1">echo hello</span><span class="desc">print text</span></div>
      <div class="cmd-item" onclick="insertCmd('cat ~/.tmux.conf')"><span class="key" style="color:#a6e3a1">cat ~/.tmux.conf</span><span class="desc">view config</span></div>
      <div class="cmd-item" onclick="insertCmd('help')"><span class="key" style="color:#f9e2af">help</span><span class="desc">tmux reference</span></div>
      <div class="cmd-item" onclick="insertCmd('cheatsheet')"><span class="key" style="color:#f9e2af">cheatsheet</span><span class="desc">full cheatsheet</span></div>
      <div class="cmd-item" onclick="insertCmd('demo')"><span class="key" style="color:#cba6f7">demo</span><span class="desc">run a demo</span></div>
    </div>
  </div>

  <div id="workspace">
    <div id="pane-container">
      <!-- panes are dynamically created here -->
    </div>
    <div id="status-bar">
      <div id="status-left">[main]</div>
      <div id="status-windows"></div>
      <div id="status-right" id="clock"></div>
    </div>
  </div>
</div>

<div id="toast"></div>

<div id="overlay">
  <div id="overlay-box">
    <h3 id="overlay-title"></h3>
    <div id="overlay-content"></div>
    <button id="overlay-close" onclick="closeOverlay()">Close [q]</button>
  </div>
</div>

<script>
// ── State ──────────────────────────────────────────────────────────────────
const state = {
  sessionName: 'main',
  windows: [{ id: 0, name: 'bash', panes: null }],
  activeWindowIdx: 0,
  activePaneId: 0,
  paneIdCounter: 1,
  zoomed: false,
  prefixActive: false,
  prefixTimeout: null,
};

// pane tree: { id, direction ('h'|'v'|null), children: [...] | null, el: HTMLElement }
// direction=null means leaf pane

function newPaneLeaf(id) {
  return { id, direction: null, children: null, el: null, size: 1 };
}

// ── DOM helpers ────────────────────────────────────────────────────────────
function $(sel) { return document.querySelector(sel); }

function toast(msg, dur=2000) {
  const t = $('#toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), dur);
}

function showOverlay(title, htmlContent) {
  $('#overlay-title').textContent = title;
  $('#overlay-content').innerHTML = htmlContent;
  $('#overlay').classList.add('open');
}
function closeOverlay() {
  $('#overlay').classList.remove('open');
  focusActive();
}

// ── Clock ──────────────────────────────────────────────────────────────────
function updateClock() {
  const now = new Date();
  const h = String(now.getHours()).padStart(2,'0');
  const m = String(now.getMinutes()).padStart(2,'0');
  $('#status-right').textContent = `${h}:${m}`;
}
updateClock();
setInterval(updateClock, 30000);

// ── Fake filesystem ────────────────────────────────────────────────────────
const fakeFiles = ['README.md','package.json','src/','tests/','node_modules/','Makefile','.tmux.conf','.zshrc'];
const fakeTmuxConf = `# ~/.tmux.conf
set -g prefix C-b
bind-key % split-window -h
bind-key '"' split-window -v
bind-key c new-window
bind-key n next-window
bind-key p previous-window
bind-key o select-pane -t :.+
bind-key z resize-pane -Z
set -g mouse on
set -g history-limit 10000
set -g base-index 1
setw -g mode-keys vi

# Catppuccin colours
set -g status-bg colour97
set -g status-fg colour255`;

const fakeZshrc = `# ~/.zshrc
export PATH="$HOME/.local/bin:$PATH"
alias ll='ls -lah'
alias g='git'
alias gst='git status'
alias gco='git checkout'
alias tm='tmux new-session -A -s main'
export EDITOR=micro`;

const commands = {
  ls() { return fakeFiles.map(f => ({ t: 'out', v: f })); },
  'ls -la'() {
    return [
      { t: 'dim', v: 'total 64' },
      ...fakeFiles.map(f => ({
        t: 'out',
        v: `drwxr-xr-x  ${Math.floor(Math.random()*9)+2} jon staff ${Math.floor(Math.random()*9000)+100} ${f}`
      }))
    ];
  },
  pwd() { return [{ t: 'ok', v: '/home/jon/projects/myapp' }]; },
  date() { return [{ t: 'ok', v: new Date().toString() }]; },
  whoami() { return [{ t: 'ok', v: 'jon' }]; },
  uname() { return [{ t: 'ok', v: 'Linux alacritty 6.8.0 #1 SMP x86_64 GNU/Linux' }]; },
  uptime() {
    const h = Math.floor(Math.random()*48)+1;
    return [{ t: 'ok', v: ` ${String(new Date().getHours()).padStart(2,'0')}:${String(new Date().getMinutes()).padStart(2,'0')}:00 up ${h}:${Math.floor(Math.random()*60).toString().padStart(2,'0')},  1 user,  load average: 0.12, 0.08, 0.05` }];
  },
  'cat ~/.tmux.conf'() { return fakeTmuxConf.split('\n').map(l => ({ t: l.startsWith('#') ? 'dim' : 'out', v: l })); },
  'cat ~/.zshrc'() { return fakeZshrc.split('\n').map(l => ({ t: l.startsWith('#') ? 'dim' : 'out', v: l })); },
  'git status'() {
    return [
      { t: 'bold', v: 'On branch main' },
      { t: 'ok',   v: "Your branch is up to date with 'origin/main'." },
      { t: 'warn', v: 'Changes not staged for commit:' },
      { t: 'err',  v: '  modified: src/app.js' },
      { t: 'err',  v: '  modified: tests/app.test.js' },
      { t: 'dim',  v: 'no changes added to commit (use "git add" and/or "git commit -a")' },
    ];
  },
  'git log --oneline'() {
    return [
      { t: 'info', v: 'a3f8b2c feat: add tmux playground to web lab' },
      { t: 'info', v: '7d1e5f9 fix: correct pane splitting logic' },
      { t: 'info', v: '2b9c4a1 chore: update dependencies' },
      { t: 'info', v: '5e6d3f8 docs: add README section on tmux' },
      { t: 'info', v: '1a2b3c4 initial commit' },
    ];
  },
  top() {
    return [
      { t: 'bold', v: `top - ${new Date().toTimeString().slice(0,8)} up 12:34,  1 user,  load average: 0.09, 0.11, 0.10` },
      { t: 'dim',  v: 'Tasks:  87 total,   1 running,  86 sleeping,   0 stopped,   0 zombie' },
      { t: 'dim',  v: '%Cpu(s):  2.1 us,  0.8 sy,  0.0 ni, 97.0 id' },
      { t: 'dim',  v: 'MiB Mem :   7823.1 total,   3214.5 free,   2108.6 used' },
      { t: 'out',  v: '  PID USER    %CPU %MEM COMMAND' },
      { t: 'out',  v: ' 1234 jon      1.2  2.1 node' },
      { t: 'out',  v: ' 5678 jon      0.5  1.4 alacritty' },
      { t: 'out',  v: ' 9012 jon      0.1  0.8 tmux' },
      { t: 'dim',  v: '(press q to quit — but this is fake so nothing happens)' },
    ];
  },
  clear() { return [{ t: 'CLEAR' }]; },
  help() { return [{ t: 'HELP' }]; },
  cheatsheet() { return [{ t: 'CHEATSHEET' }]; },
  demo() { return [{ t: 'DEMO' }]; },
};

function cmdAliases(cmd) {
  const map = {
    'la': 'ls -la', 'll': 'ls -la',
    'gs': 'git status', 'gl': 'git log --oneline',
    'cat .tmux.conf': 'cat ~/.tmux.conf',
    'cat .zshrc': 'cat ~/.zshrc',
  };
  return map[cmd] || cmd;
}

// ── Output helpers ─────────────────────────────────────────────────────────
function appendLine(paneId, type, text) {
  const pane = document.getElementById('pane-' + paneId);
  if (!pane) return;
  const out = pane.querySelector('.pane-output');
  const div = document.createElement('div');
  div.className = 'line-' + type;
  div.textContent = text;
  out.appendChild(div);
  out.scrollTop = out.scrollHeight;
}

function appendLines(paneId, lines) {
  const pane = document.getElementById('pane-' + paneId);
  if (!pane) return;
  const out = pane.querySelector('.pane-output');
  lines.forEach(l => {
    if (l.t === 'CLEAR') { out.innerHTML = ''; return; }
    if (l.t === 'HELP') { showHelpOverlay(); return; }
    if (l.t === 'CHEATSHEET') { showCheatsheet(); return; }
    if (l.t === 'DEMO') { runDemo(paneId); return; }
    const div = document.createElement('div');
    div.className = 'line-' + l.t;
    div.textContent = l.v;
    out.appendChild(div);
  });
  out.scrollTop = out.scrollHeight;
}

function clearPane(paneId) {
  const pane = document.getElementById('pane-' + paneId);
  if (!pane) return;
  pane.querySelector('.pane-output').innerHTML = '';
}

// ── Pane management ────────────────────────────────────────────────────────
function getWindow() { return state.windows[state.activeWindowIdx]; }

function activePaneEl() { return document.getElementById('pane-' + state.activePaneId); }

function makePane(id, greeting=true) {
  const wrap = document.createElement('div');
  wrap.className = 'pane';
  wrap.id = 'pane-' + id;
  wrap.dataset.paneId = id;

  const out = document.createElement('div');
  out.className = 'pane-output';

  const inputRow = document.createElement('div');
  inputRow.className = 'pane-input-row';

  const prompt = document.createElement('span');
  prompt.className = 'pane-prompt';
  prompt.textContent = 'jon@alacritty ~/projects/myapp $ ';

  const input = document.createElement('input');
  input.className = 'pane-input';
  input.type = 'text';
  input.autocomplete = 'off';
  input.autocorrect = 'off';
  input.autocapitalize = 'off';
  input.spellcheck = false;
  input.setAttribute('aria-label', 'tmux input');

  input.addEventListener('keydown', e => handleInput(e, id));
  input.addEventListener('focus', () => setActivePane(id));

  inputRow.appendChild(prompt);
  inputRow.appendChild(input);
  wrap.appendChild(out);
  wrap.appendChild(inputRow);
  wrap.addEventListener('click', () => { setActivePane(id); input.focus(); });

  if (greeting) {
    const now = new Date();
    appendLine(id, 'bold', `Welcome to tmux Playground! pane #${id}`);
    appendLine(id, 'dim',  `Session: ${state.sessionName}  |  ${now.toDateString()}`);
    appendLine(id, 'info', 'Type  help  or  cheatsheet  for tmux reference.');
    appendLine(id, 'dim',  'Try: ls, git status, demo, or any Ctrl+B command from the sidebar.');
    appendLine(id, 'dim',  '─'.repeat(50));
  }

  return wrap;
}

function setActivePane(id) {
  state.activePaneId = id;
  document.querySelectorAll('.pane').forEach(p => p.classList.remove('active'));
  const el = document.getElementById('pane-' + id);
  if (el) el.classList.add('active');
}

function focusActive() {
  const el = activePaneEl();
  if (el) el.querySelector('.pane-input').focus();
}

// ── Tree rendering ─────────────────────────────────────────────────────────
function renderTree(node, container) {
  if (!node) return;
  if (node.direction === null) {
    // leaf
    const paneEl = makePane(node.id, node.fresh !== false);
    node.el = paneEl;
    paneEl.style.flex = String(node.size || 1);
    container.appendChild(paneEl);
  } else {
    const wrapper = document.createElement('div');
    wrapper.style.display = 'flex';
    wrapper.style.flexDirection = node.direction === 'h' ? 'row' : 'column';
    wrapper.style.flex = String(node.size || 1);
    wrapper.style.overflow = 'hidden';

    node.children.forEach((child, i) => {
      renderTree(child, wrapper);
      if (i < node.children.length - 1) {
        const div = document.createElement('div');
        div.className = node.direction === 'h' ? 'pane-divider-h' : 'pane-divider-v';
        addDragResize(div, node, i, node.direction);
        wrapper.insertBefore(div, wrapper.children[wrapper.children.length - 0]);
        // Actually we need to add divider between children properly
      }
    });
    // Re-do: insert dividers properly
    wrapper.innerHTML = '';
    node.children.forEach((child, i) => {
      const childWrap = document.createElement('div');
      childWrap.style.flex = String(child.size || 1);
      childWrap.style.display = 'flex';
      childWrap.style.flexDirection = node.direction === 'h' ? 'column' : 'row';
      childWrap.style.overflow = 'hidden';
      renderTree(child, childWrap);
      // fix: the pane el inside childWrap should get style flex from child
      const paneInner = childWrap.firstChild;
      if (paneInner) { paneInner.style.flex = '1'; }
      wrapper.appendChild(childWrap);

      if (i < node.children.length - 1) {
        const div = document.createElement('div');
        div.className = node.direction === 'h' ? 'pane-divider-h' : 'pane-divider-v';
        addDragResize(div, node, i, node.direction);
        wrapper.appendChild(div);
      }
    });

    container.appendChild(wrapper);
  }
}

function addDragResize(divider, node, idx, dir) {
  let startPos, startSizeA, startSizeB;
  function onMove(e) {
    const pos = dir === 'h' ? (e.clientX || e.touches[0].clientX) : (e.clientY || e.touches[0].clientY);
    const delta = pos - startPos;
    const total = startSizeA + startSizeB;
    let newA = Math.max(0.1, startSizeA + delta * total / 400);
    let newB = Math.max(0.1, startSizeB - delta * total / 400);
    node.children[idx].size = newA;
    node.children[idx+1].size = newB;
    rebuildPanes();
  }
  function onUp() {
    divider.classList.remove('dragging');
    document.removeEventListener('mousemove', onMove);
    document.removeEventListener('mouseup', onUp);
    document.removeEventListener('touchmove', onMove);
    document.removeEventListener('touchend', onUp);
  }
  divider.addEventListener('mousedown', e => {
    startPos = dir === 'h' ? e.clientX : e.clientY;
    startSizeA = node.children[idx].size || 1;
    startSizeB = node.children[idx+1].size || 1;
    divider.classList.add('dragging');
    document.addEventListener('mousemove', onMove);
    document.addEventListener('mouseup', onUp);
    e.preventDefault();
  });
  divider.addEventListener('touchstart', e => {
    startPos = dir === 'h' ? e.touches[0].clientX : e.touches[0].clientY;
    startSizeA = node.children[idx].size || 1;
    startSizeB = node.children[idx+1].size || 1;
    document.addEventListener('touchmove', onMove, { passive: false });
    document.addEventListener('touchend', onUp);
    e.preventDefault();
  }, { passive: false });
}

function rebuildPanes() {
  const container = $('#pane-container');
  container.innerHTML = '';
  const win = getWindow();
  if (win.panes) {
    renderTree(win.panes, container);
  }
  setActivePane(state.activePaneId);
  // Re-focus
  const activeEl = document.getElementById('pane-' + state.activePaneId);
  if (activeEl) {
    activeEl.classList.add('active');
  }
  updateStatusBar();
}

// ── Collect all pane IDs in order ─────────────────────────────────────────
function collectPaneIds(node, arr=[]) {
  if (!node) return arr;
  if (node.direction === null) { arr.push(node.id); }
  else { node.children.forEach(c => collectPaneIds(c, arr)); }
  return arr;
}

// Find a node and its parent by pane id
function findNodeById(tree, id, parent=null) {
  if (!tree) return null;
  if (tree.direction === null) {
    if (tree.id === id) return { node: tree, parent };
    return null;
  }
  for (const child of tree.children) {
    const result = findNodeById(child, id, tree);
    if (result) return result;
  }
  return null;
}

// ── Prefix / keybinding handler ────────────────────────────────────────────
function activatePrefix() {
  state.prefixActive = true;
  toast('Prefix active (Ctrl+B) — press a key', 3000);
  if (state.prefixTimeout) clearTimeout(state.prefixTimeout);
  state.prefixTimeout = setTimeout(() => {
    state.prefixActive = false;
    toast('Prefix timed out');
  }, 5000);
}

function handlePrefix(key) {
  state.prefixActive = false;
  if (state.prefixTimeout) clearTimeout(state.prefixTimeout);

  switch (key) {
    case '%': splitPane('h'); break;
    case '"': splitPane('v'); break;
    case 'c': newWindow(); break;
    case 'n': cycleWindow(1); break;
    case 'p': cycleWindow(-1); break;
    case 'o': nextPane(); break;
    case 'x': killPane(); break;
    case 'z': toggleZoom(); break;
    case 'd': detach(); break;
    case 's': showSessions(); break;
    case 'w': showWindowList(); break;
    case ',': renameWindowPrompt(); break;
    case '$': renameSessionPrompt(); break;
    case 'q': showPaneNums(); break;
    case '{': swapPane(-1); break;
    case '}': swapPane(1); break;
    case '[': toast('Copy mode — use arrow keys to scroll (simulated)'); break;
    case ']': toast('Pasted from buffer (simulated)'); break;
    default:  toast(`Unknown prefix key: Ctrl+B ${key}`);
  }
}

function handleInput(e, paneId) {
  // Ctrl+B detection
  if (e.ctrlKey && e.key === 'b') {
    e.preventDefault();
    activatePrefix();
    return;
  }
  if (state.prefixActive && !e.ctrlKey && !e.altKey && e.key.length === 1) {
    e.preventDefault();
    handlePrefix(e.key);
    return;
  }
  if (state.prefixActive && e.key === 'Enter') {
    state.prefixActive = false;
    return;
  }

  if (e.key === 'Enter') {
    e.preventDefault();
    const input = e.target;
    const raw = input.value.trim();
    if (!raw) return;
    const cmd = cmdAliases(raw);
    appendLine(paneId, 'cmd', `$ ${raw}`);
    input.value = '';

    // Echo command to demonstrate
    if (commands[cmd]) {
      const result = commands[cmd]();
      appendLines(paneId, result);
    } else if (cmd.startsWith('echo ')) {
      appendLine(paneId, 'ok', cmd.slice(5).replace(/^["']|["']$/g,''));
    } else if (cmd === 'man tmux') {
      showHelpOverlay();
    } else if (cmd.startsWith('sleep ')) {
      const secs = parseInt(cmd.split(' ')[1]) || 1;
      appendLine(paneId, 'dim', `Sleeping ${secs}s… (simulated)`);
      setTimeout(() => appendLine(paneId, 'ok', `[done]`), Math.min(secs * 200, 2000));
    } else if (cmd.startsWith('tmux ')) {
      handleTmuxCmd(paneId, cmd.slice(5));
    } else {
      appendLine(paneId, 'err', `${raw}: command not found`);
      appendLine(paneId, 'dim', `(This is a simulation — try: ls, git status, help, demo)`);
    }
  }
}

function handleTmuxCmd(paneId, sub) {
  const parts = sub.split(' ');
  const action = parts[0];
  const map = {
    'split-window': () => splitPane(parts.includes('-h') ? 'h' : 'v'),
    'new-window': () => newWindow(parts[parts.indexOf('-n')+1]),
    'next-window': () => cycleWindow(1),
    'previous-window': () => cycleWindow(-1),
    'select-pane': () => nextPane(),
    'kill-pane': () => killPane(),
    'resize-pane': () => { if (parts.includes('-Z')) toggleZoom(); else toast('Resize not fully simulated'); },
    'list-sessions': () => showSessions(),
    'list-windows': () => showWindowList(),
    'rename-window': () => renameWindowPrompt(parts.slice(2).join(' ')),
    'rename-session': () => renameSessionPrompt(parts.slice(2).join(' ')),
    'new-session': () => toast('Session already exists — attaching (simulated)'),
    'attach-session': () => toast('Attaching to session… (simulated)'),
    'detach-client': () => detach(),
  };
  if (map[action]) { map[action](); }
  else { appendLine(paneId, 'warn', `tmux: unknown command: ${sub}`); }
}

// ── tmux actions ───────────────────────────────────────────────────────────
function splitPane(dir) {
  const win = getWindow();
  const newId = state.paneIdCounter++;
  const found = findNodeById(win.panes, state.activePaneId);
  if (!found) return;
  const { node, parent } = found;

  if (node.direction !== null) {
    toast('Cannot split a non-leaf'); return;
  }

  // Replace leaf with a group
  const existing = { ...node, size: 1 };
  const newLeaf = newPaneLeaf(newId);

  // Reuse node slot
  node.direction = dir;
  node.children = [existing, newLeaf];
  node.id = undefined;
  node.size = node.size || 1;

  state.activePaneId = newId;
  rebuildPanes();
  appendLine(newId, 'bold', `New pane #${newId} — split ${dir === 'h' ? 'vertically' : 'horizontally'}`);
  appendLine(newId, 'dim',  `Active: pane #${newId}. Type  help  for commands.`);
  toast(`Split ${dir === 'h' ? 'vertical' : 'horizontal'} — new pane #${newId}`);
  focusActive();
}

function nextPane() {
  const win = getWindow();
  const ids = collectPaneIds(win.panes);
  if (ids.length < 2) { toast('Only one pane'); return; }
  const ci = ids.indexOf(state.activePaneId);
  const ni = (ci + 1) % ids.length;
  state.activePaneId = ids[ni];
  rebuildPanes();
  toast(`Switched to pane #${state.activePaneId}`);
  focusActive();
}

function killPane() {
  const win = getWindow();
  const ids = collectPaneIds(win.panes);
  if (ids.length === 1) {
    if (state.windows.length === 1) { toast('Cannot close last pane in last window'); return; }
    killWindow();
    return;
  }
  const found = findNodeById(win.panes, state.activePaneId);
  if (!found || !found.parent) { toast('Cannot kill root pane'); return; }

  const { node, parent } = found;
  const idx = parent.children.indexOf(node);
  parent.children.splice(idx, 1);

  // If only one child left, collapse
  if (parent.children.length === 1) {
    const only = parent.children[0];
    Object.assign(parent, only);
    parent.children = only.children;
  }

  // Pick new active pane
  const remaining = collectPaneIds(win.panes);
  state.activePaneId = remaining[Math.min(idx, remaining.length-1)];
  rebuildPanes();
  toast(`Killed pane, now at pane #${state.activePaneId}`);
  focusActive();
}

function toggleZoom() {
  state.zoomed = !state.zoomed;
  const ids = collectPaneIds(getWindow().panes);
  const container = $('#pane-container');
  if (state.zoomed) {
    // Show only active pane overlay
    document.querySelectorAll('.pane').forEach(p => {
      if (p.id !== 'pane-' + state.activePaneId) p.style.display = 'none';
    });
    toast(`Zoomed pane #${state.activePaneId} (Ctrl+B z to unzoom)`);
  } else {
    document.querySelectorAll('.pane').forEach(p => p.style.display = '');
    toast('Unzoomed');
  }
}

function newWindow(name) {
  const id = state.paneIdCounter++;
  const winName = name || 'bash';
  state.windows.push({
    id: state.windows.length,
    name: winName,
    panes: newPaneLeaf(id)
  });
  state.activeWindowIdx = state.windows.length - 1;
  state.activePaneId = id;
  rebuildPanes();
  toast(`New window ${state.windows.length-1}: ${winName}`);
  focusActive();
}

function cycleWindow(dir) {
  state.activeWindowIdx = (state.activeWindowIdx + dir + state.windows.length) % state.windows.length;
  const win = getWindow();
  const ids = collectPaneIds(win.panes);
  state.activePaneId = ids[0];
  rebuildPanes();
  toast(`Window ${state.activeWindowIdx}: ${win.name}`);
  focusActive();
}

function killWindow() {
  if (state.windows.length === 1) { toast('Cannot kill last window'); return; }
  state.windows.splice(state.activeWindowIdx, 1);
  state.activeWindowIdx = Math.min(state.activeWindowIdx, state.windows.length-1);
  const ids = collectPaneIds(getWindow().panes);
  state.activePaneId = ids[0];
  rebuildPanes();
  toast('Window killed');
  focusActive();
}

function detach() {
  showOverlay('Session Detached', `
    <p>You have detached from session <code>${state.sessionName}</code>.</p>
    <p>In real tmux, your session would keep running in the background. You could reattach with:</p>
    <p><code>tmux attach -t ${state.sessionName}</code></p>
    <p>This is what makes tmux so powerful — your work persists even if your terminal closes or your SSH connection drops.</p>
  `);
}

function showSessions() {
  showOverlay('tmux Sessions', `
    <p><strong>${state.sessionName}</strong> — ${state.windows.length} window(s) — created just now</p>
    <p style="margin-top:12px;color:#6c7086">In a real system you might see multiple sessions here. Reattach with <code>tmux attach -t &lt;name&gt;</code>.</p>
  `);
}

function showWindowList() {
  const list = state.windows.map((w,i) => `<p><code>${i}: ${w.name}</code>${i === state.activeWindowIdx ? ' <span style="color:#a6e3a1">(active)</span>' : ''}</p>`).join('');
  showOverlay('Windows', list + `
    <p style="margin-top:12px;color:#6c7086">Use <code>Ctrl+B n/p</code> or <code>Ctrl+B &lt;number&gt;</code> to switch.</p>
  `);
}

function renameWindowPrompt(name) {
  const n = name || prompt('New window name:', getWindow().name);
  if (n) { getWindow().name = n; rebuildPanes(); toast(`Window renamed to: ${n}`); }
}

function renameSessionPrompt(name) {
  const n = name || prompt('New session name:', state.sessionName);
  if (n) { state.sessionName = n; $('#status-left').textContent = `[${n}]`; toast(`Session renamed to: ${n}`); }
}

function showPaneNums() {
  const ids = collectPaneIds(getWindow().panes);
  ids.forEach((id, i) => {
    const el = document.getElementById('pane-' + id);
    if (!el) return;
    const num = document.createElement('div');
    num.style.cssText = 'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:3rem;color:#f38ba8;font-weight:bold;pointer-events:none;z-index:50;opacity:.9';
    num.textContent = i;
    el.style.position = 'relative';
    el.appendChild(num);
    setTimeout(() => num.remove(), 1500);
  });
  toast('Pane numbers shown briefly');
}

function swapPane(dir) {
  toast(`Swap pane ${dir > 0 ? 'forward' : 'back'} (simulated)`);
}

// ── Status bar ─────────────────────────────────────────────────────────────
function updateStatusBar() {
  const sw = $('#status-windows');
  sw.innerHTML = '';
  state.windows.forEach((w, i) => {
    const tab = document.createElement('div');
    tab.className = 'win-tab' + (i === state.activeWindowIdx ? ' active' : '');
    tab.textContent = `${i}:${w.name}`;
    tab.onclick = () => { state.activeWindowIdx = i; const ids = collectPaneIds(getWindow().panes); state.activePaneId = ids[0]; rebuildPanes(); focusActive(); };
    sw.appendChild(tab);
  });
}

// ── Help overlays ──────────────────────────────────────────────────────────
function showHelpOverlay() {
  showOverlay('tmux Quick Reference', `
    <p><strong>Prefix key:</strong> <code>Ctrl+B</code> — press this before every tmux shortcut.</p>

    <p style="margin-top:12px"><strong>Pane splitting</strong></p>
    <p><code>Ctrl+B %</code> — split vertically (side by side)</p>
    <p><code>Ctrl+B "</code> — split horizontally (top and bottom)</p>
    <p><code>Ctrl+B o</code> — cycle to next pane</p>
    <p><code>Ctrl+B x</code> — kill current pane</p>
    <p><code>Ctrl+B z</code> — zoom/unzoom current pane</p>
    <p><code>Ctrl+B q</code> — show pane numbers briefly</p>

    <p style="margin-top:12px"><strong>Windows</strong></p>
    <p><code>Ctrl+B c</code> — new window</p>
    <p><code>Ctrl+B n / p</code> — next / previous window</p>
    <p><code>Ctrl+B ,</code> — rename window</p>
    <p><code>Ctrl+B w</code> — list windows</p>

    <p style="margin-top:12px"><strong>Sessions</strong></p>
    <p><code>Ctrl+B d</code> — detach (session keeps running!)</p>
    <p><code>Ctrl+B $</code> — rename session</p>
    <p><code>Ctrl+B s</code> — list sessions</p>

    <p style="margin-top:12px;color:#6c7086">Type <code>cheatsheet</code> for a printable reference, or <code>demo</code> to see tmux in action.</p>
  `);
}

function showCheatsheet() {
  showOverlay('tmux Cheatsheet', `
    <p style="color:#6c7086;font-size:.75rem;margin-bottom:12px">All commands require the prefix <code>Ctrl+B</code> first unless noted.</p>

    <p><strong style="color:#89b4fa">── Panes ──</strong></p>
    <p><code>%</code>  Split vertical &nbsp;|&nbsp; <code>"</code>  Split horizontal</p>
    <p><code>o</code>  Next pane &nbsp;|&nbsp; <code>;</code>  Last pane</p>
    <p><code>x</code>  Kill pane &nbsp;|&nbsp; <code>z</code>  Zoom pane</p>
    <p><code>q</code>  Show numbers &nbsp;|&nbsp; <code>{ }</code>  Swap panes</p>
    <p><code>↑↓←→</code>  Resize pane (hold after prefix)</p>

    <p style="margin-top:10px"><strong style="color:#89b4fa">── Windows ──</strong></p>
    <p><code>c</code>  New &nbsp;|&nbsp; <code>n</code>  Next &nbsp;|&nbsp; <code>p</code>  Prev</p>
    <p><code>,</code>  Rename &nbsp;|&nbsp; <code>&amp;</code>  Kill &nbsp;|&nbsp; <code>w</code>  List</p>
    <p><code>0–9</code>  Jump to window by number</p>

    <p style="margin-top:10px"><strong style="color:#89b4fa">── Sessions ──</strong></p>
    <p><code>d</code>  Detach &nbsp;|&nbsp; <code>$</code>  Rename &nbsp;|&nbsp; <code>s</code>  List</p>
    <p>In shell: <code>tmux new -s name</code> &nbsp;|&nbsp; <code>tmux attach -t name</code></p>

    <p style="margin-top:10px"><strong style="color:#89b4fa">── Copy mode ──</strong></p>
    <p><code>[</code>  Enter copy mode &nbsp;|&nbsp; <code>]</code>  Paste</p>
    <p>In copy mode: arrows to move, <code>Space</code> select, <code>Enter</code> copy</p>

    <p style="margin-top:10px"><strong style="color:#89b4fa">── Config (~/.tmux.conf) ──</strong></p>
    <p><code>set -g mouse on</code>  — enable mouse</p>
    <p><code>set -g base-index 1</code>  — windows start at 1</p>
    <p><code>set -g history-limit 10000</code>  — scrollback</p>
    <p>Type <code>cat ~/.tmux.conf</code> to see an example config.</p>
  `);
}

// ── Demo ────────────────────────────────────────────────────────────────────
function runDemo(paneId) {
  const steps = [
    () => { appendLine(paneId, 'bold', '── Demo: setting up a dev workspace ──'); },
    () => { appendLine(paneId, 'dim', '$ git status'); appendLines(paneId, commands['git status']()); },
    () => { appendLine(paneId, 'dim', 'Splitting vertically for logs…'); splitPane('h'); },
    () => {
      const ids = collectPaneIds(getWindow().panes);
      const other = ids.find(id => id !== paneId) || ids[0];
      appendLine(other, 'dim', '$ git log --oneline');
      appendLines(other, commands['git log --oneline']());
    },
    () => { appendLine(paneId, 'dim', 'Splitting horizontally for tests…'); splitPane('v'); },
    () => {
      const ids = collectPaneIds(getWindow().panes);
      const last = ids[ids.length-1];
      appendLine(last, 'dim', '$ npm test (simulated)');
      appendLine(last, 'ok',  '  PASS src/app.test.js');
      appendLine(last, 'ok',  '  PASS src/utils.test.js');
      appendLine(last, 'ok',  'Test Suites: 2 passed, 2 total');
      appendLine(last, 'ok',  'Tests:       8 passed, 8 total');
    },
    () => { appendLine(paneId, 'info', '── Demo complete! Try Ctrl+B o to cycle panes ──'); },
  ];
  let i = 0;
  function step() {
    if (i < steps.length) { steps[i](); i++; setTimeout(step, 800); }
  }
  step();
}

// ── Sidebar click helper ───────────────────────────────────────────────────
function insertCmd(cmd) {
  const el = activePaneEl();
  if (!el) return;
  const input = el.querySelector('.pane-input');
  if (!input) return;

  if (cmd.startsWith('Ctrl+B ')) {
    const key = cmd.slice(7);
    activatePrefix();
    setTimeout(() => { handlePrefix(key); }, 400);
  } else {
    input.value = cmd;
    input.focus();
  }
}

// ── Init ───────────────────────────────────────────────────────────────────
function init() {
  const win = getWindow();
  win.panes = newPaneLeaf(0);
  state.activePaneId = 0;
  rebuildPanes();
  focusActive();

  // Global keyboard shortcut for prefix
  document.addEventListener('keydown', e => {
    if (['INPUT', 'TEXTAREA'].includes(e.target.tagName)) return; // handled by input handler
    if (e.ctrlKey && e.key === 'b') { e.preventDefault(); activatePrefix(); }
    if (e.key === 'q' && $('#overlay').classList.contains('open')) { closeOverlay(); }
  });
}

init();
</script>
</body>
</html>
