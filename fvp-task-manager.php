<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>FVP Task Manager</title>
<style>
  :root {
    --bg: #1a1a2e;
    --surface: #16213e;
    --surface2: #0f3460;
    --accent: #e94560;
    --accent2: #f5a623;
    --text: #eaeaea;
    --text-muted: #7a8099;
    --dot-color: #e94560;
    --done-color: #3a3a5c;
    --green: #4ecdc4;
    --radius: 12px;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    padding: 20px 16px 80px;
  }
  .header {
    text-align: center;
    margin-bottom: 24px;
  }
  .header h1 {
    font-size: 1.8em;
    font-weight: 700;
    letter-spacing: -0.5px;
  }
  .header h1 span { color: var(--accent); }
  .header p {
    color: var(--text-muted);
    font-size: 0.88em;
    margin-top: 4px;
  }
  .credit {
    font-size: 0.75em;
    color: var(--text-muted);
    margin-top: 2px;
  }
  .credit a { color: var(--text-muted); }

  /* Status Bar */
  #status-bar {
    background: var(--surface2);
    border-radius: var(--radius);
    padding: 14px 16px;
    margin-bottom: 16px;
    font-size: 0.9em;
    min-height: 52px;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s;
  }
  #status-bar .icon { font-size: 1.4em; flex-shrink: 0; }
  #status-bar .msg { flex: 1; line-height: 1.4; }
  #status-bar .msg strong { color: var(--accent2); }

  /* Task List */
  #task-list {
    list-style: none;
    margin-bottom: 16px;
  }
  .task-item {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--surface);
    border-radius: var(--radius);
    padding: 14px 16px;
    margin-bottom: 8px;
    border: 2px solid transparent;
    transition: all 0.2s;
    position: relative;
    cursor: default;
    user-select: none;
  }
  .task-item.state-seed {
    border-color: var(--accent);
    background: #1f1535;
    box-shadow: 0 0 0 3px rgba(233, 69, 96, 0.15);
  }
  .task-item.state-dotted {
    border-color: var(--accent2);
    background: #1e1a10;
    box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.12);
  }
  .task-item.state-scanning {
    border-color: var(--green);
    background: #0d2020;
    animation: pulse-border 1.2s infinite;
  }
  .task-item.state-done {
    background: var(--done-color);
    opacity: 0.5;
  }
  .task-item.state-done .task-text { text-decoration: line-through; color: var(--text-muted); }

  @keyframes pulse-border {
    0%, 100% { box-shadow: 0 0 0 3px rgba(78, 205, 196, 0.2); }
    50% { box-shadow: 0 0 0 5px rgba(78, 205, 196, 0.35); }
  }

  .task-dot {
    width: 24px;
    height: 24px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1em;
  }
  .task-num {
    font-size: 0.72em;
    color: var(--text-muted);
    width: 18px;
    text-align: right;
    flex-shrink: 0;
  }
  .task-text {
    flex: 1;
    font-size: 0.97em;
    line-height: 1.35;
  }
  .task-delete {
    background: none;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    font-size: 1.1em;
    padding: 4px;
    border-radius: 6px;
    opacity: 0.5;
    transition: opacity 0.2s;
  }
  .task-delete:hover { opacity: 1; color: var(--accent); }
  .task-item.state-done .task-delete { display: none; }

  /* Comparison Panel */
  #comparison-panel {
    display: none;
    background: var(--surface);
    border-radius: var(--radius);
    padding: 16px;
    margin-bottom: 16px;
    border: 2px solid var(--green);
  }
  #comparison-panel h3 {
    font-size: 0.82em;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--green);
    margin-bottom: 12px;
  }
  .compare-tasks {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 10px;
    align-items: center;
    margin-bottom: 14px;
  }
  .compare-task {
    background: var(--bg);
    border-radius: 8px;
    padding: 12px;
    font-size: 0.9em;
    line-height: 1.35;
    text-align: center;
    min-height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .compare-task.seed { border: 1px solid var(--accent); }
  .compare-task.challenger { border: 1px solid var(--green); }
  .compare-vs { color: var(--text-muted); font-weight: 700; font-size: 0.85em; }
  .compare-btns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }
  .btn-yes, .btn-no {
    border: none;
    border-radius: 10px;
    padding: 14px;
    font-size: 1em;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.1s, opacity 0.2s;
    letter-spacing: 0.03em;
  }
  .btn-yes:active, .btn-no:active { transform: scale(0.96); }
  .btn-yes { background: var(--green); color: #0d2020; }
  .btn-no { background: #2a2a4a; color: var(--text); }
  .btn-yes:hover { opacity: 0.9; }
  .btn-no:hover { opacity: 0.9; }

  /* Add Task */
  #add-form {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
  }
  #add-input {
    flex: 1;
    background: var(--surface);
    border: 2px solid #2a2a4a;
    border-radius: 10px;
    padding: 12px 14px;
    color: var(--text);
    font-size: 0.97em;
    outline: none;
    transition: border-color 0.2s;
  }
  #add-input:focus { border-color: var(--accent2); }
  #add-input::placeholder { color: var(--text-muted); }
  #btn-add {
    background: var(--accent);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 12px 18px;
    font-size: 1.1em;
    cursor: pointer;
    font-weight: 700;
    transition: opacity 0.2s;
    flex-shrink: 0;
  }
  #btn-add:hover { opacity: 0.85; }

  /* Action Buttons */
  .action-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 16px;
  }
  .btn-action {
    background: var(--surface2);
    color: var(--text);
    border: none;
    border-radius: 10px;
    padding: 13px;
    font-size: 0.9em;
    cursor: pointer;
    transition: background 0.2s;
    font-weight: 500;
  }
  .btn-action:hover { background: #1a3a6a; }
  .btn-action.primary { background: var(--accent); color: white; font-weight: 600; }
  .btn-action.primary:hover { background: #c73050; }
  .btn-action:disabled { opacity: 0.4; cursor: not-allowed; }

  /* How it works */
  details {
    background: var(--surface);
    border-radius: var(--radius);
    padding: 14px 16px;
    margin-bottom: 16px;
    font-size: 0.88em;
    color: var(--text-muted);
    line-height: 1.6;
  }
  summary {
    cursor: pointer;
    color: var(--text);
    font-weight: 600;
    font-size: 0.92em;
    list-style: none;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  summary::before { content: '▶'; font-size: 0.7em; transition: transform 0.2s; }
  details[open] summary::before { transform: rotate(90deg); }
  details p { margin-top: 10px; }
  details ol { margin: 8px 0 0 18px; }
  details ol li { margin-bottom: 4px; }

  /* Legend */
  .legend {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    font-size: 0.78em;
    color: var(--text-muted);
    margin-bottom: 16px;
  }
  .legend-item { display: flex; align-items: center; gap: 5px; }
  .legend-dot { width: 12px; height: 12px; border-radius: 50%; display: inline-block; }

  /* Stats bar */
  #stats {
    display: flex;
    gap: 14px;
    font-size: 0.8em;
    color: var(--text-muted);
    margin-bottom: 12px;
  }
  #stats span { display: flex; align-items: center; gap: 4px; }

  /* Empty state */
  #empty-state {
    text-align: center;
    padding: 40px 20px;
    color: var(--text-muted);
    display: none;
  }
  #empty-state .big { font-size: 2.5em; margin-bottom: 10px; }
  #empty-state p { font-size: 0.88em; }

  /* Toast */
  #toast {
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: #1f3a1a;
    border: 1px solid var(--green);
    color: var(--green);
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 0.88em;
    transition: transform 0.3s;
    pointer-events: none;
    white-space: nowrap;
  }
  #toast.show { transform: translateX(-50%) translateY(0); }
</style>
</head>
<body>

<div class="header">
  <h1>⚡ <span>FVP</span> Task Manager</h1>
  <p>Mark Forster's Final Version Perfected algorithm</p>
  <p class="credit">From <a href="http://markforster.squarespace.com/fvp-instructions/" target="_blank">markforster.net</a></p>
</div>

<div id="status-bar">
  <span class="icon">💡</span>
  <span class="msg" id="status-msg">Add some tasks below, then press <strong>Run FVP</strong> to start the algorithm.</span>
</div>

<details>
  <summary>📖 How FVP works</summary>
  <p>FVP is Mark Forster's most refined productivity algorithm. Unlike a simple priority list, it uses <em>pairwise comparisons</em> so your brain doesn't have to hold the whole list in mind.</p>
  <ol>
    <li>The first incomplete task becomes the <strong>seed</strong> (marked 🔴).</li>
    <li>Each subsequent task is compared: <em>"Do I want to do this MORE than the seed?"</em></li>
    <li>If <strong>Yes</strong>: this task becomes the new seed (old seed marked 🟡).</li>
    <li>If <strong>No</strong>: skip and continue down the list.</li>
    <li>After scanning the whole list: <strong>do the last seed task</strong>.</li>
    <li>Cross it off. The previous seed is now the comparison point — scan from there.</li>
    <li>Repeat until done!</li>
  </ol>
  <p>The magic: you only ever answer one simple yes/no question at a time. No mental juggling.</p>
</details>

<div id="add-form">
  <input type="text" id="add-input" placeholder="Add a task… (Enter to add)" maxlength="120" />
  <button id="btn-add" onclick="addTask()">+</button>
</div>

<div id="stats">
  <span>📋 <span id="stat-total">0</span> tasks</span>
  <span>✅ <span id="stat-done">0</span> done</span>
  <span>⏳ <span id="stat-remaining">0</span> remaining</span>
</div>

<div class="legend">
  <span class="legend-item"><span class="legend-dot" style="background:var(--accent)"></span> Seed (to-beat)</span>
  <span class="legend-item"><span class="legend-dot" style="background:var(--accent2)"></span> Marked</span>
  <span class="legend-item"><span class="legend-dot" style="background:var(--green)"></span> Scanning</span>
  <span class="legend-item"><span class="legend-dot" style="background:#555"></span> Done</span>
</div>

<ul id="task-list"></ul>

<div id="empty-state">
  <div class="big">📝</div>
  <p>No tasks yet. Add your first one above!</p>
</div>

<div id="comparison-panel">
  <h3>⚖️ Compare — which do you want to do more?</h3>
  <div class="compare-tasks">
    <div class="compare-task seed" id="cmp-seed"></div>
    <div class="compare-vs">VS</div>
    <div class="compare-task challenger" id="cmp-challenger"></div>
  </div>
  <div class="compare-btns">
    <button class="btn-no" onclick="compareNo()">No — keep seed</button>
    <button class="btn-yes" onclick="compareYes()">Yes — switch! ✓</button>
  </div>
</div>

<div class="action-row">
  <button class="btn-action primary" id="btn-run" onclick="startFVP()">▶ Run FVP</button>
  <button class="btn-action" id="btn-do-task" onclick="doCurrentTask()" disabled>✓ Task Done</button>
</div>
<div class="action-row">
  <button class="btn-action" onclick="clearDone()">🗑 Clear Done</button>
  <button class="btn-action" onclick="resetAll()">↺ Reset All</button>
</div>

<div id="toast"></div>

<script>
// ─────────────────────────────────────────
//  State
// ─────────────────────────────────────────
let tasks = [];
let fvpRunning = false;
let seedIdx = -1;       // The current "comparison seed" index
let scanIdx = -1;       // Where we're currently scanning
let taskToDoIdx = -1;   // The last dotted task (to be done next)

const STATES = { IDLE: 'idle', SEED: 'seed', DOTTED: 'dotted', SCANNING: 'scanning', DONE: 'done' };

function save() {
  try {
    localStorage.setItem('fvp-tasks', JSON.stringify(tasks));
    localStorage.setItem('fvp-state', JSON.stringify({ fvpRunning, seedIdx, scanIdx, taskToDoIdx }));
  } catch(e) {}
}

function load() {
  try {
    const t = localStorage.getItem('fvp-tasks');
    const s = localStorage.getItem('fvp-state');
    if (t) tasks = JSON.parse(t);
    if (s) {
      const st = JSON.parse(s);
      fvpRunning = st.fvpRunning;
      seedIdx = st.seedIdx;
      scanIdx = st.scanIdx;
      taskToDoIdx = st.taskToDoIdx;
    }
  } catch(e) {}
}

// ─────────────────────────────────────────
//  Task Management
// ─────────────────────────────────────────
function addTask() {
  const input = document.getElementById('add-input');
  const text = input.value.trim();
  if (!text) return;
  tasks.push({ text, state: STATES.IDLE, id: Date.now() });
  input.value = '';
  input.focus();
  save();
  render();
  if (fvpRunning) {
    setStatus('💡', 'Task added at the end of the list. It will be included in the current scan.');
    // If scanning is complete (scanIdx was -1), resume from new task
    if (scanIdx === -1 || scanIdx >= tasks.length - 1) {
      scanIdx = tasks.length - 1;
      tasks[scanIdx].state = STATES.SCANNING;
      save();
      render();
      showComparison();
    }
  }
}

function deleteTask(id) {
  const idx = tasks.findIndex(t => t.id === id);
  if (idx === -1) return;
  if (fvpRunning && (idx === seedIdx || idx === taskToDoIdx)) {
    showToast('Cannot delete seed/active task — mark it done first');
    return;
  }
  tasks.splice(idx, 1);
  // Adjust indices
  if (fvpRunning) {
    if (idx <= seedIdx) seedIdx = Math.max(0, seedIdx - 1);
    if (idx <= scanIdx) scanIdx = Math.max(seedIdx + 1, scanIdx - 1);
    if (idx === taskToDoIdx) taskToDoIdx = -1;
    else if (idx < taskToDoIdx) taskToDoIdx--;
  }
  save();
  render();
}

function clearDone() {
  tasks = tasks.filter(t => t.state !== STATES.DONE);
  // Recalculate indices after filter
  save();
  render();
  showToast('Cleared completed tasks');
}

function resetAll() {
  if (!confirm('Reset everything?')) return;
  tasks = [];
  fvpRunning = false;
  seedIdx = -1; scanIdx = -1; taskToDoIdx = -1;
  save();
  render();
}

// ─────────────────────────────────────────
//  FVP Algorithm
// ─────────────────────────────────────────
function startFVP() {
  const active = tasks.filter(t => t.state !== STATES.DONE);
  if (active.length === 0) {
    showToast('Add some tasks first!');
    return;
  }

  // Reset all non-done tasks to idle
  tasks.forEach(t => { if (t.state !== STATES.DONE) t.state = STATES.IDLE; });

  // Find first non-done task
  seedIdx = tasks.findIndex(t => t.state !== STATES.DONE);
  if (seedIdx === -1) {
    setStatus('🎉', 'All tasks are done! Add more or clear done tasks.');
    return;
  }

  tasks[seedIdx].state = STATES.SEED;
  fvpRunning = true;
  taskToDoIdx = seedIdx;

  // Find the next non-done task to scan
  scanIdx = nextNonDone(seedIdx);

  save();
  render();

  if (scanIdx === -1) {
    // Only one task — do it
    endScan();
  } else {
    tasks[scanIdx].state = STATES.SCANNING;
    save();
    render();
    showComparison();
  }
}

function nextNonDone(from) {
  for (let i = from + 1; i < tasks.length; i++) {
    if (tasks[i].state !== STATES.DONE) return i;
  }
  return -1;
}

function compareYes() {
  // Challenger wins — current seed becomes dotted, challenger becomes new seed
  if (tasks[seedIdx]) tasks[seedIdx].state = STATES.DOTTED;
  seedIdx = scanIdx;
  tasks[seedIdx].state = STATES.SEED;
  taskToDoIdx = seedIdx;

  advanceScan();
}

function compareNo() {
  // Seed wins — challenger is skipped (stays idle)
  advanceScan();
}

function advanceScan() {
  // Move to next non-done task
  scanIdx = nextNonDone(scanIdx);

  if (scanIdx === -1) {
    // End of list — do the current seed task
    endScan();
  } else {
    tasks[scanIdx].state = STATES.SCANNING;
    save();
    render();
    showComparison();
  }
}

function endScan() {
  // The task to do is taskToDoIdx (the last seed)
  document.getElementById('comparison-panel').style.display = 'none';
  fvpRunning = true;
  scanIdx = -1;

  const task = tasks[taskToDoIdx];
  setStatus('🎯', `Your next task: <strong>"${escHtml(task.text)}"</strong> — press ✓ Task Done when finished!`);
  document.getElementById('btn-do-task').disabled = false;
  document.getElementById('btn-run').disabled = true;
  save();
  render();
}

function doCurrentTask() {
  if (taskToDoIdx === -1) return;
  const done = tasks[taskToDoIdx];
  done.state = STATES.DONE;

  showToast(`✅ "${done.text.substring(0, 40)}" done!`);

  const prevTaskToDoIdx = taskToDoIdx;
  taskToDoIdx = -1;
  document.getElementById('btn-do-task').disabled = true;
  document.getElementById('btn-run').disabled = false;

  // Find the previous seed to continue from
  // Look for the last DOTTED task before prevTaskToDoIdx
  let newSeed = -1;
  for (let i = prevTaskToDoIdx - 1; i >= 0; i--) {
    if (tasks[i].state === STATES.DOTTED || tasks[i].state === STATES.SEED) {
      newSeed = i;
      break;
    }
  }

  if (newSeed === -1) {
    // No more dotted tasks — find first non-done and start fresh scan
    const firstActive = tasks.findIndex(t => t.state !== STATES.DONE);
    if (firstActive === -1) {
      fvpRunning = false;
      setStatus('🎉', 'All done! Amazing work. Add more tasks or clear the list.');
      save();
      render();
      return;
    }
    // Resume from top
    seedIdx = firstActive;
    tasks[seedIdx].state = STATES.SEED;
    taskToDoIdx = seedIdx;
    scanIdx = nextNonDone(seedIdx);
  } else {
    // Continue from the previous dotted task
    seedIdx = newSeed;
    tasks[seedIdx].state = STATES.SEED;
    taskToDoIdx = seedIdx;
    // Scan from after the task we just completed
    scanIdx = nextNonDone(prevTaskToDoIdx);
    if (scanIdx === -1) {
      // Nothing after — scan from after seed
      scanIdx = nextNonDone(seedIdx);
    }
  }

  if (scanIdx === -1) {
    endScan();
  } else {
    tasks[scanIdx].state = STATES.SCANNING;
    save();
    render();
    showComparison();
  }
}

// ─────────────────────────────────────────
//  Render
// ─────────────────────────────────────────
function render() {
  const list = document.getElementById('task-list');
  const empty = document.getElementById('empty-state');
  list.innerHTML = '';

  if (tasks.length === 0) {
    empty.style.display = 'block';
  } else {
    empty.style.display = 'none';
  }

  const total = tasks.length;
  const done = tasks.filter(t => t.state === STATES.DONE).length;
  const remaining = total - done;
  document.getElementById('stat-total').textContent = total;
  document.getElementById('stat-done').textContent = done;
  document.getElementById('stat-remaining').textContent = remaining;

  tasks.forEach((task, i) => {
    const li = document.createElement('li');
    li.className = `task-item state-${task.state}`;

    let dot = '';
    if (task.state === STATES.SEED) dot = '🔴';
    else if (task.state === STATES.DOTTED) dot = '🟡';
    else if (task.state === STATES.SCANNING) dot = '🟢';
    else if (task.state === STATES.DONE) dot = '✅';
    else dot = '○';

    li.innerHTML = `
      <span class="task-num">${i + 1}</span>
      <span class="task-dot">${dot}</span>
      <span class="task-text">${escHtml(task.text)}</span>
      <button class="task-delete" onclick="deleteTask(${task.id})" title="Delete">✕</button>
    `;
    list.appendChild(li);
  });

  // Scroll the scanning task into view
  if (scanIdx !== -1 && scanIdx < list.children.length) {
    list.children[scanIdx].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
}

function showComparison() {
  const panel = document.getElementById('comparison-panel');
  panel.style.display = 'block';

  const seedTask = tasks[seedIdx];
  const challenger = tasks[scanIdx];

  document.getElementById('cmp-seed').textContent = seedTask ? seedTask.text : '';
  document.getElementById('cmp-challenger').textContent = challenger ? challenger.text : '';

  setStatus('⚖️', `Compare: <strong>"${escHtml(tasks[scanIdx]?.text || '')}"</strong> — do you want this more than the current seed?`);

  panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function setStatus(icon, msg) {
  document.getElementById('status-bar').querySelector('.icon').textContent = icon;
  document.getElementById('status-msg').innerHTML = msg;
}

// ─────────────────────────────────────────
//  Utilities
// ─────────────────────────────────────────
function escHtml(s) {
  return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

let toastTimer;
function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
}

// ─────────────────────────────────────────
//  Init
// ─────────────────────────────────────────
document.getElementById('add-input').addEventListener('keydown', e => {
  if (e.key === 'Enter') addTask();
});

// Sample tasks for first-timers
function loadSampleTasks() {
  if (tasks.length === 0) {
    const samples = [
      'Check and respond to emails',
      'Review the new pull request from Alice',
      'Write up notes from yesterday\'s meeting',
      'Update the project README',
      'Call the dentist to book appointment',
      'Pay this month\'s bills',
      'Read one chapter of current book',
    ];
    samples.forEach(text => tasks.push({ text, state: STATES.IDLE, id: Date.now() + Math.random() }));
    save();
  }
}

load();
if (tasks.length === 0) loadSampleTasks();
render();

// Restore comparison panel if mid-scan
if (fvpRunning && scanIdx !== -1 && tasks[scanIdx]) {
  tasks[scanIdx].state = STATES.SCANNING;
  showComparison();
  render();
} else if (fvpRunning && taskToDoIdx !== -1 && tasks[taskToDoIdx] && tasks[taskToDoIdx].state !== STATES.DONE) {
  endScan();
}
</script>
</body>
</html>
