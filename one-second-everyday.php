<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1 Second Everyday — Text Edition</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0f0f12;
            --surface: #1a1a22;
            --border: #2a2a38;
            --text: #e8e8f0;
            --muted: #666680;
            --accent: #7c6af7;
        }
        body { background: var(--bg); color: var(--text); font-family: system-ui, -apple-system, sans-serif; min-height: 100vh; }
        header { padding: 28px 20px 20px; text-align: center; border-bottom: 1px solid var(--border); }
        header h1 { font-size: 1.5em; font-weight: 700; }
        header p { color: var(--muted); font-size: 0.85em; margin-top: 6px; }
        .year-nav { display: flex; align-items: center; justify-content: center; gap: 16px; padding: 16px 20px; }
        .year-nav button { background: var(--surface); border: 1px solid var(--border); color: var(--text); border-radius: 8px; width: 36px; height: 36px; font-size: 1.1em; cursor: pointer; }
        .year-nav button:hover { background: var(--border); }
        #year-label { font-size: 1.3em; font-weight: 700; min-width: 60px; text-align: center; }
        .stats-bar { display: flex; justify-content: center; gap: 24px; padding: 0 20px 16px; font-size: 0.8em; color: var(--muted); }
        .stat strong { color: var(--text); font-size: 1.1em; }
        .grid-wrapper { padding: 0 12px 24px; overflow-x: auto; }
        #calendar-grid { display: grid; grid-template-columns: 32px repeat(31, 1fr); gap: 2px; min-width: 340px; max-width: 700px; margin: 0 auto; }
        .grid-header { font-size: 0.62em; color: var(--muted); text-align: center; padding: 4px 0; font-weight: 600; }
        .grid-month-label { font-size: 0.65em; color: var(--muted); text-align: right; padding: 2px 4px 2px 0; display: flex; align-items: center; justify-content: flex-end; }
        .day-cell { aspect-ratio: 1; border-radius: 3px; cursor: pointer; position: relative; transition: transform 0.1s, box-shadow 0.1s; min-width: 0; }
        .day-cell.empty { background: transparent; cursor: default; pointer-events: none; }
        .day-cell.unfilled { background: var(--surface); border: 1px solid var(--border); }
        .day-cell.unfilled:hover { border-color: var(--accent); transform: scale(1.15); z-index: 2; }
        .day-cell.filled { border: none; }
        .day-cell.filled:hover { transform: scale(1.2); z-index: 2; box-shadow: 0 4px 14px rgba(0,0,0,0.5); }
        .day-cell.today-cell { box-shadow: 0 0 0 2px white; }
        .modal-backdrop { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.75); z-index: 100; align-items: flex-end; justify-content: center; }
        .modal-backdrop.open { display: flex; }
        .modal { background: var(--surface); border: 1px solid var(--border); border-bottom: none; border-radius: 20px 20px 0 0; width: 100%; max-width: 480px; padding: 24px 24px 36px; animation: slide-up 0.2s ease; }
        @keyframes slide-up { from { transform: translateY(40px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-date { font-size: 0.85em; color: var(--muted); margin-bottom: 4px; }
        .modal-title { font-size: 1.1em; font-weight: 700; margin-bottom: 16px; }
        .mood-picker { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 16px; }
        .mood-btn { display: flex; flex-direction: column; align-items: center; gap: 4px; background: var(--bg); border: 2px solid var(--border); border-radius: 10px; padding: 8px 10px; cursor: pointer; flex: 1; min-width: 52px; transition: border-color 0.15s, background 0.15s; }
        .mood-btn span:first-child { font-size: 1.4em; }
        .mood-btn span:last-child { font-size: 0.6em; color: var(--muted); }
        .mood-btn.selected { border-color: var(--accent); background: rgba(124,106,247,0.15); }
        textarea { width: 100%; background: var(--bg); border: 1px solid var(--border); border-radius: 10px; color: var(--text); font-size: 0.95em; line-height: 1.5; padding: 12px; resize: none; min-height: 100px; font-family: inherit; margin-bottom: 8px; }
        textarea:focus { outline: none; border-color: var(--accent); }
        textarea::placeholder { color: var(--muted); }
        .char-count { font-size: 0.72em; color: var(--muted); text-align: right; margin-bottom: 12px; min-height: 1em; }
        .modal-actions { display: flex; gap: 10px; }
        .btn-save { flex: 1; background: var(--accent); color: white; border: none; border-radius: 10px; padding: 13px; font-size: 0.95em; font-weight: 600; cursor: pointer; }
        .btn-save:hover { background: #6b59e8; }
        .btn-cancel { background: var(--bg); color: var(--muted); border: 1px solid var(--border); border-radius: 10px; padding: 13px 18px; font-size: 0.95em; cursor: pointer; }
        .btn-delete { background: transparent; color: #ff6b6b; border: 1px solid rgba(255,107,107,0.3); border-radius: 10px; padding: 13px 18px; font-size: 0.95em; cursor: pointer; }
        .tooltip { position: fixed; background: #2a2a38; border: 1px solid var(--border); border-radius: 8px; padding: 8px 12px; font-size: 0.8em; max-width: 220px; pointer-events: none; z-index: 50; display: none; line-height: 1.4; }
        .tooltip .tt-date { color: var(--muted); font-size: 0.85em; margin-bottom: 3px; }
        .tooltip .tt-mood { font-size: 1.2em; margin-bottom: 3px; }
        .recent-strip { padding: 0 20px 32px; }
        .recent-strip h2 { font-size: 0.8em; color: var(--muted); letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 12px; }
        .entries-list { display: flex; flex-direction: column; gap: 10px; }
        .entry-card { background: var(--surface); border: 1px solid var(--border); border-left: 3px solid; border-radius: 10px; padding: 12px 14px; cursor: pointer; }
        .entry-card:hover { opacity: 0.85; }
        .ec-header { display: flex; align-items: center; gap: 8px; margin-bottom: 5px; }
        .ec-mood { font-size: 1.1em; }
        .ec-date { font-size: 0.75em; color: var(--muted); }
        .ec-text { font-size: 0.88em; line-height: 1.4; }
        .empty-state { text-align: center; padding: 32px 20px; color: var(--muted); font-size: 0.9em; line-height: 1.6; }
        .empty-state .big { font-size: 2em; margin-bottom: 10px; }
    </style>
</head>
<body>
<header>
    <h1>1 Second Everyday</h1>
    <p>One moment. One day. Every day.</p>
</header>
<div class="year-nav">
    <button id="prev-year">&#8249;</button>
    <div id="year-label">2026</div>
    <button id="next-year">&#8250;</button>
</div>
<div class="stats-bar">
    <div class="stat"><strong id="stat-filled">0</strong> captured</div>
    <div class="stat"><strong id="stat-streak">0</strong> day streak</div>
    <div class="stat"><strong id="stat-pct">0%</strong> of year</div>
</div>
<div class="grid-wrapper">
    <div id="calendar-grid"></div>
</div>
<div class="recent-strip">
    <h2>Recent Moments</h2>
    <div class="entries-list" id="entries-list"></div>
</div>
<div class="modal-backdrop" id="modal-backdrop">
    <div class="modal">
        <div class="modal-date" id="modal-date-label"></div>
        <div class="modal-title" id="modal-title-label">What was your moment?</div>
        <div class="mood-picker" id="mood-picker"></div>
        <textarea id="moment-text" placeholder="Write one moment from today&#8230; a sentence is enough." maxlength="280"></textarea>
        <div class="char-count" id="char-count"></div>
        <div class="modal-actions" id="modal-actions"></div>
    </div>
</div>
<div class="tooltip" id="tooltip"></div>
<script>
const MOODS = [
    { emoji: '\u2600\ufe0f', label: 'Great',  color: '#f5a623' },
    { emoji: '\ud83d\ude0a', label: 'Good',   color: '#4cd964' },
    { emoji: '\ud83d\ude10', label: 'Okay',   color: '#5ac8fa' },
    { emoji: '\ud83d\ude14', label: 'Hard',   color: '#9b9baf' },
    { emoji: '\ud83d\ude4f', label: 'Holy',   color: '#bf8bff' },
    { emoji: '\ud83c\udf89', label: 'Epic!',  color: '#ff6b81' },
];
const MONTHS = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
const FULL_MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];
let currentYear = new Date().getFullYear();
let activeDateKey = null;
let selectedMood = 0;
function storageKey(y) { return '1se_journal_' + y; }
function loadData(y) { try { return JSON.parse(localStorage.getItem(storageKey(y)) || '{}'); } catch(e) { return {}; } }
function saveData(y, d) { localStorage.setItem(storageKey(y), JSON.stringify(d)); }
function dateKey(y,m,d) { return y+'-'+String(m+1).padStart(2,'0')+'-'+String(d).padStart(2,'0'); }
function isLeap(y) { return (y%4===0&&y%100!==0)||(y%400===0); }
function daysInMonth(y,m) { return [31,isLeap(y)?29:28,31,30,31,30,31,31,30,31,30,31][m]; }
const today = new Date();
const todayKey = dateKey(today.getFullYear(), today.getMonth(), today.getDate());
function buildGrid(year) {
    const data = loadData(year);
    const grid = document.getElementById('calendar-grid');
    grid.innerHTML = '';
    const corner = document.createElement('div');
    grid.appendChild(corner);
    for (let d = 1; d <= 31; d++) {
        const h = document.createElement('div');
        h.className = 'grid-header';
        h.textContent = d;
        grid.appendChild(h);
    }
    for (let m = 0; m < 12; m++) {
        const ml = document.createElement('div');
        ml.className = 'grid-month-label';
        ml.textContent = MONTHS[m];
        grid.appendChild(ml);
        const days = daysInMonth(year, m);
        for (let d = 1; d <= 31; d++) {
            const cell = document.createElement('div');
            cell.className = 'day-cell';
            if (d > days) {
                cell.classList.add('empty');
            } else {
                const key = dateKey(year, m, d);
                if (key === todayKey) cell.classList.add('today-cell');
                const entry = data[key];
                if (entry) {
                    cell.classList.add('filled');
                    cell.style.background = MOODS[entry.mood || 0].color;
                    cell.addEventListener('mouseenter', function(e) { showTip(e, key, entry); });
                    cell.addEventListener('mouseleave', hideTip);
                } else {
                    cell.classList.add('unfilled');
                }
                cell.addEventListener('click', function() { openModal(key, year); });
            }
            grid.appendChild(cell);
        }
    }
    updateStats(year, data);
    renderRecent(year, data);
}
function showTip(e, key, entry) {
    const tt = document.getElementById('tooltip');
    const mood = MOODS[entry.mood || 0];
    tt.innerHTML = '<div class="tt-date">'+fmtDate(key)+'</div><div class="tt-mood">'+mood.emoji+'</div><div>'+esc(entry.text||'')+'</div>';
    tt.style.display = 'block';
    const x = Math.min(e.clientX+12, window.innerWidth-240);
    const y = Math.max(e.clientY-70, 8);
    tt.style.left = x+'px'; tt.style.top = y+'px';
}
function hideTip() { document.getElementById('tooltip').style.display='none'; }
function fmtDate(key) { const p=key.split('-').map(Number); return FULL_MONTHS[p[1]-1]+' '+p[2]+', '+p[0]; }
function updateStats(year, data) {
    const keys = Object.keys(data);
    document.getElementById('stat-filled').textContent = keys.length;
    if (year !== today.getFullYear()) {
        document.getElementById('stat-streak').textContent = '-';
    } else {
        let streak = 0, check = new Date(today);
        while (streak < 400) {
            const k = dateKey(check.getFullYear(), check.getMonth(), check.getDate());
            if (data[k]) { streak++; check.setDate(check.getDate()-1); } else break;
        }
        document.getElementById('stat-streak').textContent = streak;
    }
    const total = isLeap(year) ? 366 : 365;
    document.getElementById('stat-pct').textContent = keys.length ? Math.round(keys.length/total*100)+'%' : '0%';
}
function renderRecent(year, data) {
    const list = document.getElementById('entries-list');
    const keys = Object.keys(data).sort().reverse().slice(0,7);
    if (!keys.length) {
        list.innerHTML = '<div class="empty-state"><div class="big">\u2728</div>Tap any square above to capture your first moment.<br>One sentence is enough.</div>';
        return;
    }
    list.innerHTML = keys.map(function(key) {
        const e = data[key], mood = MOODS[e.mood||0];
        return '<div class="entry-card" style="border-left-color:'+mood.color+'" onclick="openModal(\''+key+'\','+year+')">'
            +'<div class="ec-header"><span class="ec-mood">'+mood.emoji+'</span><span class="ec-date">'+fmtDate(key)+'</span></div>'
            +'<div class="ec-text">'+esc(e.text||'')+'</div></div>';
    }).join('');
}
function esc(s) { return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }
function openModal(key, year) {
    activeDateKey = key;
    const data = loadData(year);
    const entry = data[key] || null;
    document.getElementById('modal-date-label').textContent = fmtDate(key);
    document.getElementById('modal-title-label').textContent = entry ? 'Edit this moment' : 'What was your moment?';
    selectedMood = entry ? (entry.mood||0) : 0;
    const picker = document.getElementById('mood-picker');
    picker.innerHTML = MOODS.map(function(m,i) {
        return '<button class="mood-btn'+(i===selectedMood?' selected':'')+'" onclick="selectMood('+i+')">'
            +'<span>'+m.emoji+'</span><span>'+m.label+'</span></button>';
    }).join('');
    const ta = document.getElementById('moment-text');
    ta.value = entry ? (entry.text||'') : '';
    updateCC();
    const acts = document.getElementById('modal-actions');
    acts.innerHTML = '';
    if (entry) {
        const del = document.createElement('button');
        del.className = 'btn-delete'; del.textContent = 'Delete';
        del.onclick = function() { deleteEntry(year); };
        acts.appendChild(del);
    }
    const cancel = document.createElement('button');
    cancel.className = 'btn-cancel'; cancel.textContent = 'Cancel';
    cancel.onclick = closeModal;
    acts.appendChild(cancel);
    const save = document.createElement('button');
    save.className = 'btn-save'; save.textContent = entry ? 'Update' : 'Save Moment';
    save.onclick = function() { saveEntry(year); };
    acts.appendChild(save);
    document.getElementById('modal-backdrop').classList.add('open');
    setTimeout(function() { ta.focus(); }, 100);
}
function selectMood(i) {
    selectedMood = i;
    document.querySelectorAll('.mood-btn').forEach(function(btn,idx) { btn.classList.toggle('selected', idx===i); });
}
function updateCC() {
    const len = document.getElementById('moment-text').value.length;
    document.getElementById('char-count').textContent = len ? len+'/280' : '';
}
document.getElementById('moment-text').addEventListener('input', updateCC);
function saveEntry(year) {
    const text = document.getElementById('moment-text').value.trim();
    if (!text) { document.getElementById('moment-text').focus(); return; }
    const data = loadData(year);
    data[activeDateKey] = { mood: selectedMood, text: text };
    saveData(year, data);
    closeModal();
    buildGrid(year);
}
function deleteEntry(year) {
    if (!confirm('Delete this moment?')) return;
    const data = loadData(year);
    delete data[activeDateKey];
    saveData(year, data);
    closeModal();
    buildGrid(year);
}
function closeModal() { document.getElementById('modal-backdrop').classList.remove('open'); activeDateKey = null; }
document.getElementById('modal-backdrop').addEventListener('click', function(e) {
    if (e.target === document.getElementById('modal-backdrop')) closeModal();
});
document.getElementById('prev-year').onclick = function() { currentYear--; document.getElementById('year-label').textContent=currentYear; buildGrid(currentYear); };
document.getElementById('next-year').onclick = function() { currentYear++; document.getElementById('year-label').textContent=currentYear; buildGrid(currentYear); };
buildGrid(currentYear);
</script>
</body>
</html>
