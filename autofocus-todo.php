<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Autofocus To-Do</title>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --bg: #f7f5f0;
    --surface: #fff;
    --accent: #5b7fa6;
    --accent-light: #e8eff7;
    --focus: #c0392b;
    --focus-light: #fdecea;
    --done: #27ae60;
    --text: #1a1a1a;
    --muted: #777;
    --border: #e0ddd6;
    --radius: 10px;
  }
  body {
    font-family: system-ui, -apple-system, sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    padding: 24px 16px 80px;
  }
  header { max-width: 600px; margin: 0 auto 28px; text-align: center; }
  header h1 { font-size: 2em; font-weight: 800; letter-spacing: -0.5px; color: var(--accent); }
  header p { color: var(--muted); font-size: 0.9em; margin-top: 6px; line-height: 1.5; }
  .main { max-width: 600px; margin: 0 auto; }
  .add-box { background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px; margin-bottom: 20px; display: flex; gap: 10px; }
  .add-box input { flex: 1; border: 1.5px solid var(--border); border-radius: 8px; padding: 10px 14px; font-size: 1em; background: var(--bg); color: var(--text); outline: none; }
  .add-box input:focus { border-color: var(--accent); }
  .add-box button { background: var(--accent); color: #fff; border: none; border-radius: 8px; padding: 10px 18px; font-size: 1em; font-weight: 600; cursor: pointer; white-space: nowrap; }
  .focus-card { background: var(--focus-light); border: 2px solid var(--focus); border-radius: var(--radius); padding: 20px; margin-bottom: 20px; display: none; }
  .focus-card.visible { display: block; }
  .focus-label { font-size: 0.75em; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--focus); margin-bottom: 8px; }
  .focus-task { font-size: 1.25em; font-weight: 700; line-height: 1.4; margin-bottom: 16px; }
  .focus-actions { display: flex; gap: 10px; flex-wrap: wrap; }
  .btn { padding: 10px 18px; border-radius: 8px; border: none; font-size: 0.9em; font-weight: 600; cursor: pointer; }
  .btn-done { background: var(--done); color: #fff; }
  .btn-later { background: var(--accent); color: #fff; }
  .btn-skip { background: #e0ddd6; color: #444; }
  .phase-info { font-size: 0.82em; color: var(--muted); margin-bottom: 16px; padding: 10px 14px; background: var(--surface); border-radius: 8px; border: 1px solid var(--border); line-height: 1.5; display: none; }
  .phase-info.visible { display: block; }
  .phase-info strong { color: var(--text); }
  .list-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 10px; }
  .list-header h2 { font-size: 1em; font-weight: 700; }
  .list-header span { font-size: 0.82em; color: var(--muted); }
  .task-list { list-style: none; }
  .task-item { background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 14px 16px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; }
  .task-item.is-focus { border-color: var(--focus); background: var(--focus-light); }
  .task-item.is-marked { border-color: var(--accent); background: var(--accent-light); }
  .task-num { font-size: 0.75em; color: var(--muted); min-width: 22px; text-align: right; flex-shrink: 0; }
  .task-text { flex: 1; line-height: 1.4; font-size: 0.97em; }
  .task-mark { width: 26px; height: 26px; border-radius: 50%; border: 2px solid var(--border); background: none; cursor: pointer; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 0.9em; }
  .task-item.is-marked .task-mark { border-color: var(--accent); background: var(--accent); color: #fff; }
  .task-item.is-focus .task-mark { border-color: var(--focus); background: var(--focus); color: #fff; }
  .task-del { background: none; border: none; cursor: pointer; color: #bbb; font-size: 1.1em; padding: 2px 4px; flex-shrink: 0; }
  .task-del:hover { color: #e74c3c; }
  .empty { text-align: center; color: var(--muted); font-size: 0.9em; padding: 32px 0; display: none; }
  .howto { margin-top: 32px; background: var(--surface); border: 1.5px solid var(--border); border-radius: var(--radius); padding: 16px 18px; }
  .howto summary { font-weight: 700; font-size: 0.9em; cursor: pointer; color: var(--accent); user-select: none; }
  .howto-body { margin-top: 12px; font-size: 0.85em; color: #444; line-height: 1.7; }
  .howto-body ol { padding-left: 20px; }
  .howto-body li { margin-bottom: 6px; }
  .howto-body a { color: var(--accent); }
  .footer-actions { margin-top: 20px; text-align: right; }
  .btn-clear { background: none; border: 1px solid var(--border); color: var(--muted); font-size: 0.8em; padding: 6px 12px; border-radius: 6px; cursor: pointer; }
  @media (max-width: 400px) {
    header h1 { font-size: 1.6em; }
    .focus-task { font-size: 1.1em; }
    .add-box { flex-direction: column; }
    .add-box button { width: 100%; }
  }
</style>
</head>
<body>
<header>
  <h1>✦ Autofocus</h1>
  <p>Mark Forster's Autofocus system &mdash; the self-organizing to-do list.</p>
</header>
<div class="main">
  <div class="add-box">
    <input type="text" id="newTask" placeholder="Add a task&hellip;" autocomplete="off" />
    <button onclick="addTask()">Add</button>
  </div>
  <div class="focus-card" id="focusCard">
    <div class="focus-label">&#127919; Do This Now</div>
    <div class="focus-task" id="focusText"></div>
    <div class="focus-actions">
      <button class="btn btn-done" onclick="completeTask()">&#10003; Done</button>
      <button class="btn btn-later" onclick="deferTask()">&#8617; Not Done Yet</button>
      <button class="btn btn-skip" onclick="skipTask()">&#8594; Skip for now</button>
    </div>
  </div>
  <div class="phase-info" id="phaseInfo"></div>
  <div class="list-header">
    <h2>Your List</h2>
    <span id="listCount"></span>
  </div>
  <ul class="task-list" id="taskList"></ul>
  <div class="empty" id="emptyState">No tasks yet &mdash; add something above.</div>
  <div class="footer-actions">
    <button class="btn-clear" onclick="clearDone()">Clear completed</button>
  </div>
  <details class="howto">
    <summary>How Autofocus works</summary>
    <div class="howto-body">
      <p>From <a href="https://markforster.squarespace.com/autofocus-system/" target="_blank">Mark Forster's Autofocus system</a>:</p>
      <ol>
        <li><strong>Add tasks freely</strong> as they come to mind &mdash; no priorities, no sorting.</li>
        <li><strong>Read through your list</strong> and mark any task that "stands out" to you. Trust your gut, not your inner critic.</li>
        <li><strong>Work from the last marked task</strong> backward through marked items.</li>
        <li>When finished, cross it off. If not done, re-add to end and continue.</li>
        <li>Once all marked tasks are done, do a fresh scan and mark again.</li>
      </ol>
      <p style="margin-top:10px">The insight: you already know what needs doing. The system just gets out of your way and lets you work on what feels right &mdash; which is usually exactly right.</p>
    </div>
  </details>
</div>
<script>
const STORE_KEY = 'autofocus_tasks';
const STATE_KEY = 'autofocus_state';
function load() { try { return JSON.parse(localStorage.getItem(STORE_KEY)) || []; } catch { return []; } }
function save(t) { localStorage.setItem(STORE_KEY, JSON.stringify(t)); }
function loadState() { try { return JSON.parse(localStorage.getItem(STATE_KEY)) || {}; } catch { return {}; } }
function saveState(s) { localStorage.setItem(STATE_KEY, JSON.stringify(s)); }
let tasks = load();
let appState = loadState();
if (!appState.phase) appState = { phase: 'scan', focusId: null };
function uid() { return Date.now().toString(36) + Math.random().toString(36).slice(2, 6); }
function addTask() {
  const inp = document.getElementById('newTask');
  const text = inp.value.trim();
  if (!text) return;
  tasks.push({ id: uid(), text, marked: false, done: false });
  inp.value = '';
  save(tasks);
  render();
  inp.focus();
}
document.getElementById('newTask').addEventListener('keydown', e => { if (e.key === 'Enter') addTask(); });
function activeTasks() { return tasks.filter(t => !t.done); }
function toggleMark(id) {
  const t = tasks.find(t => t.id === id);
  if (!t || t.done) return;
  t.marked = !t.marked;
  save(tasks);
  render();
}
function startWork() {
  const marked = activeTasks().filter(t => t.marked);
  if (!marked.length) return;
  appState.phase = 'work';
  appState.focusId = marked[marked.length - 1].id;
  saveState(appState);
  render();
}
function completeTask() {
  const t = tasks.find(t => t.id === appState.focusId);
  if (t) { t.done = true; t.marked = false; }
  save(tasks);
  advanceAfterFocus();
}
function deferTask() {
  const t = tasks.find(t => t.id === appState.focusId);
  if (t) { t.marked = false; tasks = tasks.filter(x => x.id !== t.id); tasks.push(t); }
  save(tasks);
  advanceAfterFocus();
}
function skipTask() {
  const t = tasks.find(t => t.id === appState.focusId);
  if (t) t.marked = false;
  save(tasks);
  advanceAfterFocus();
}
function advanceAfterFocus() {
  const marked = activeTasks().filter(t => t.marked);
  if (marked.length > 0) {
    appState.focusId = marked[marked.length - 1].id;
    appState.phase = 'work';
  } else {
    appState.phase = 'scan';
    appState.focusId = null;
  }
  saveState(appState);
  render();
}
function deleteTask(id) {
  tasks = tasks.filter(t => t.id !== id);
  if (appState.focusId === id) { appState.focusId = null; appState.phase = 'scan'; }
  save(tasks);
  saveState(appState);
  render();
}
function clearDone() { tasks = tasks.filter(t => !t.done); save(tasks); render(); }
function render() {
  const active = activeTasks();
  const done = tasks.filter(t => t.done);
  const marked = active.filter(t => t.marked);
  const focusTask = appState.focusId ? tasks.find(t => t.id === appState.focusId) : null;
  const card = document.getElementById('focusCard');
  const phaseInfo = document.getElementById('phaseInfo');
  if (appState.phase === 'work' && focusTask && !focusTask.done) {
    card.classList.add('visible');
    document.getElementById('focusText').textContent = focusTask.text;
    phaseInfo.classList.remove('visible');
  } else {
    card.classList.remove('visible');
    if (active.length === 0) {
      phaseInfo.classList.remove('visible');
    } else if (marked.length === 0) {
      phaseInfo.classList.add('visible');
      phaseInfo.innerHTML = '<strong>Scan mode:</strong> Read through your list. Tap the circle next to any task that stands out to you &mdash; trust your gut. Then tap Start Working.';
    } else {
      phaseInfo.classList.add('visible');
      phaseInfo.innerHTML = '<strong>' + marked.length + ' task' + (marked.length > 1 ? 's' : '') + ' marked.</strong> When ready, start working from the last marked task. <button class="btn btn-later" style="margin-top:10px;display:block;width:100%;text-align:center" onclick="startWork()">&#128640; Start Working</button>';
    }
  }
  const ul = document.getElementById('taskList');
  ul.innerHTML = '';
  let n = 0;
  tasks.forEach(t => {
    if (t.done) return;
    n++;
    const li = document.createElement('li');
    li.className = 'task-item' + (t.id === appState.focusId ? ' is-focus' : t.marked ? ' is-marked' : '');
    const num = document.createElement('span'); num.className = 'task-num'; num.textContent = n;
    const mark = document.createElement('button');
    mark.className = 'task-mark';
    mark.innerHTML = (t.marked || t.id === appState.focusId) ? '&#9679;' : '';
    mark.title = t.marked ? 'Unmark' : 'Mark this task';
    mark.onclick = () => toggleMark(t.id);
    const text = document.createElement('span'); text.className = 'task-text'; text.textContent = t.text;
    const del = document.createElement('button');
    del.className = 'task-del'; del.innerHTML = '&times;'; del.title = 'Remove';
    del.onclick = () => deleteTask(t.id);
    li.appendChild(num); li.appendChild(mark); li.appendChild(text); li.appendChild(del);
    ul.appendChild(li);
  });
  if (done.length > 0) {
    const sep = document.createElement('li');
    sep.style.cssText = 'list-style:none;padding:8px 0 4px;font-size:0.8em;color:#aaa;text-align:center';
    sep.textContent = '\u2014 ' + done.length + ' completed \u2014';
    ul.appendChild(sep);
    done.forEach(t => {
      const li = document.createElement('li');
      li.className = 'task-item';
      li.style.cssText = 'opacity:0.4;text-decoration:line-through;';
      const text = document.createElement('span'); text.className = 'task-text'; text.textContent = t.text;
      const del = document.createElement('button');
      del.className = 'task-del'; del.innerHTML = '&times;';
      del.onclick = () => deleteTask(t.id);
      li.appendChild(text); li.appendChild(del);
      ul.appendChild(li);
    });
  }
  document.getElementById('listCount').textContent = active.length > 0 ? active.length + ' active' : '';
  document.getElementById('emptyState').style.display = tasks.length === 0 ? 'block' : 'none';
}
render();
</script>
</body>
</html>
