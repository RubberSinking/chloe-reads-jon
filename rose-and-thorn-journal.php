<?php
// Rose & Thorn Family Journal
// A nightly ritual tracker for Jon and Nathan
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose &amp; Thorn Journal</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --rose:    #e05070;
            --thorn:   #4a7c59;
            --bud:     #8b5cf6;
            --bg:      #fdf6f0;
            --card-bg: #ffffff;
            --text:    #2d1a0e;
            --muted:   #8a7060;
            --border:  #e8d8cc;
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Header ─────────────────────────────────────────── */
        header {
            background: linear-gradient(135deg, #c2395b 0%, #7c3aad 100%);
            color: #fff;
            padding: 28px 24px 24px;
            text-align: center;
        }
        header h1 {
            font-size: 2em;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }
        header .subtitle {
            opacity: 0.85;
            font-size: 0.95em;
        }
        #today-label {
            margin-top: 10px;
            font-size: 0.9em;
            opacity: 0.75;
            font-style: italic;
        }

        /* ── Tabs ────────────────────────────────────────────── */
        .tabs {
            display: flex;
            max-width: 720px;
            margin: 0 auto;
            padding: 0 16px;
            gap: 0;
        }
        .tab-btn {
            flex: 1;
            padding: 14px 0;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            font-size: 0.95em;
            font-weight: 600;
            color: var(--muted);
            cursor: pointer;
            transition: color .2s, border-color .2s;
        }
        .tab-btn.active {
            color: var(--rose);
            border-bottom-color: var(--rose);
        }
        .tab-btn:hover:not(.active) { color: var(--text); }

        /* ── Main ────────────────────────────────────────────── */
        main {
            max-width: 720px;
            margin: 0 auto;
            padding: 20px 16px 60px;
        }

        .view { display: none; }
        .view.active { display: block; }

        /* ── Today's Entry ───────────────────────────────────── */
        .people-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 500px) {
            .people-grid { grid-template-columns: 1fr; }
        }

        .person-card {
            background: var(--card-bg);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }
        .person-card h2 {
            font-size: 1.2em;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .person-card h2 .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3em;
        }
        .jon-avatar  { background: #fde8d0; }
        .nathan-avatar { background: #d0eafd; }

        .field-group {
            margin-bottom: 14px;
        }
        .field-label {
            font-size: 0.8em;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .field-label.rose-label   { color: var(--rose); }
        .field-label.thorn-label  { color: var(--thorn); }
        .field-label.bud-label    { color: var(--bud); }

        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.9em;
            line-height: 1.5;
            resize: vertical;
            min-height: 72px;
            background: #fffaf7;
            color: var(--text);
            transition: border-color .2s, box-shadow .2s;
        }
        textarea:focus {
            outline: none;
            border-color: var(--rose);
            box-shadow: 0 0 0 3px rgba(224,80,112,.12);
        }

        /* ── Save Button ─────────────────────────────────────── */
        .save-wrap {
            margin-top: 24px;
            text-align: center;
        }
        #save-btn {
            background: linear-gradient(135deg, #c2395b, #7c3aad);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 14px 40px;
            font-size: 1em;
            font-weight: 700;
            cursor: pointer;
            transition: opacity .2s, transform .1s;
            box-shadow: 0 4px 16px rgba(194,57,91,.3);
        }
        #save-btn:hover { opacity: .9; transform: translateY(-1px); }
        #save-btn:active { transform: translateY(0); }

        #save-feedback {
            margin-top: 12px;
            font-size: 0.9em;
            color: var(--thorn);
            font-weight: 600;
            min-height: 1.4em;
            transition: opacity .4s;
        }

        /* ── Legend ──────────────────────────────────────────── */
        .legend {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 24px;
            font-size: 0.82em;
            flex-wrap: wrap;
        }
        .legend span { display: flex; align-items: center; gap: 5px; color: var(--muted); }
        .legend .dot {
            width: 10px; height: 10px; border-radius: 50%;
            display: inline-block;
        }

        /* ── Calendar ────────────────────────────────────────── */
        .cal-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .cal-nav button {
            background: none;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 6px 14px;
            cursor: pointer;
            font-size: 1em;
            color: var(--text);
            transition: background .15s;
        }
        .cal-nav button:hover { background: var(--border); }
        .cal-nav h3 { font-size: 1.1em; font-weight: 700; }

        .cal-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            text-align: center;
        }
        .cal-day-name {
            font-size: 0.72em;
            font-weight: 700;
            color: var(--muted);
            padding: 4px 0 8px;
            text-transform: uppercase;
        }
        .cal-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 0.85em;
            cursor: default;
            position: relative;
            transition: background .15s;
        }
        .cal-day.has-entry {
            background: #fde8ef;
            cursor: pointer;
            font-weight: 700;
            color: var(--rose);
        }
        .cal-day.has-entry:hover { background: #f8c8d8; }
        .cal-day.today-day {
            outline: 2px solid var(--rose);
            outline-offset: 2px;
        }
        .cal-day.empty { color: #ccc; cursor: default; }

        /* ── Past Entry ──────────────────────────────────────── */
        #past-entry {
            margin-top: 28px;
            background: var(--card-bg);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 20px;
            display: none;
        }
        #past-entry h4 {
            font-size: 1em;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--muted);
        }
        .past-people {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 500px) {
            .past-people { grid-template-columns: 1fr; }
        }
        .past-person h5 {
            font-size: 0.95em;
            font-weight: 700;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .past-field {
            margin-bottom: 10px;
        }
        .past-field .past-label {
            font-size: 0.72em;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 3px;
        }
        .past-field .past-text {
            font-size: 0.9em;
            line-height: 1.5;
            color: var(--text);
            background: #fffaf7;
            border-radius: 8px;
            padding: 8px 10px;
            border: 1px solid var(--border);
            min-height: 40px;
            white-space: pre-wrap;
        }
        .empty-msg {
            color: var(--muted);
            font-style: italic;
            font-size: 0.9em;
            text-align: center;
            padding: 20px 0;
        }

        /* ── Stats ───────────────────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 28px;
        }
        @media (max-width: 400px) { .stats-grid { grid-template-columns: 1fr 1fr; } }
        .stat-card {
            background: var(--card-bg);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            padding: 14px 12px;
            text-align: center;
        }
        .stat-num {
            font-size: 2em;
            font-weight: 800;
            line-height: 1;
        }
        .stat-label { font-size: 0.75em; color: var(--muted); margin-top: 4px; }

        /* ── Back link ───────────────────────────────────────── */
        .back-link {
            display: inline-block;
            margin-bottom: 28px;
            color: var(--muted);
            font-size: 0.85em;
            text-decoration: none;
        }
        .back-link:hover { color: var(--text); }
    </style>
</head>
<body>

<header>
    <h1>🌹 Rose &amp; Thorn 🌵</h1>
    <div class="subtitle">Our nightly family journal</div>
    <div id="today-label"></div>
</header>

<div class="tabs">
    <button class="tab-btn active" data-view="tonight">Tonight</button>
    <button class="tab-btn" data-view="history">History</button>
    <button class="tab-btn" data-view="stats">Streak</button>
</div>

<main>

    <!-- ── TONIGHT VIEW ── -->
    <div class="view active" id="view-tonight">

        <div class="people-grid">

            <!-- Jon -->
            <div class="person-card">
                <h2>
                    <span class="avatar jon-avatar">👨</span>
                    Jon
                </h2>
                <div class="field-group">
                    <div class="field-label rose-label">🌹 Rose — best moment</div>
                    <textarea id="jon-rose" placeholder="What was the highlight of your day?"></textarea>
                </div>
                <div class="field-group">
                    <div class="field-label thorn-label">🌵 Thorn — hard moment</div>
                    <textarea id="jon-thorn" placeholder="What was tough or frustrating?"></textarea>
                </div>
                <div class="field-group">
                    <div class="field-label bud-label">🌱 Bud — hope for tomorrow</div>
                    <textarea id="jon-bud" placeholder="Something you're looking forward to..."></textarea>
                </div>
            </div>

            <!-- Nathan -->
            <div class="person-card">
                <h2>
                    <span class="avatar nathan-avatar">👦</span>
                    Nathan
                </h2>
                <div class="field-group">
                    <div class="field-label rose-label">🌹 Rose — best moment</div>
                    <textarea id="nathan-rose" placeholder="What was the highlight of your day?"></textarea>
                </div>
                <div class="field-group">
                    <div class="field-label thorn-label">🌵 Thorn — hard moment</div>
                    <textarea id="nathan-thorn" placeholder="What was tough or frustrating?"></textarea>
                </div>
                <div class="field-group">
                    <div class="field-label bud-label">🌱 Bud — hope for tomorrow</div>
                    <textarea id="nathan-bud" placeholder="Something you're looking forward to..."></textarea>
                </div>
            </div>

        </div>

        <div class="save-wrap">
            <button id="save-btn">Save Tonight's Journal ✨</button>
            <div id="save-feedback"></div>
        </div>

    </div><!-- /tonight -->

    <!-- ── HISTORY VIEW ── -->
    <div class="view" id="view-history">

        <div class="legend">
            <span><span class="dot" style="background:var(--rose)"></span> Entry saved</span>
            <span><span class="dot" style="background:none;outline:2px solid var(--rose);outline-offset:1px;border-radius:50%"></span> Today</span>
        </div>

        <div class="cal-nav">
            <button id="cal-prev">‹ Prev</button>
            <h3 id="cal-title">—</h3>
            <button id="cal-next">Next ›</button>
        </div>
        <div class="cal-grid" id="cal-grid"></div>

        <div id="past-entry">
            <h4 id="past-entry-date"></h4>
            <div class="past-people" id="past-entry-body"></div>
        </div>

    </div><!-- /history -->

    <!-- ── STATS VIEW ── -->
    <div class="view" id="view-stats">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-num" id="stat-total" style="color:var(--rose)">—</div>
                <div class="stat-label">nights logged</div>
            </div>
            <div class="stat-card">
                <div class="stat-num" id="stat-streak" style="color:var(--bud)">—</div>
                <div class="stat-label">day streak 🔥</div>
            </div>
            <div class="stat-card">
                <div class="stat-num" id="stat-month" style="color:var(--thorn)">—</div>
                <div class="stat-label">this month</div>
            </div>
        </div>
        <div id="streak-msg" style="text-align:center;color:var(--muted);font-style:italic;font-size:.9em;margin-top:8px;"></div>

        <!-- Last 7 entries -->
        <h3 style="font-size:1em;margin:28px 0 14px;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;font-size:.78em;">Recent Entries</h3>
        <div id="recent-list"></div>
    </div><!-- /stats -->

</main>

<script>
const STORAGE_KEY = 'rose-thorn-journal-v1';

// ── Storage ──────────────────────────────────────────────────────────────────
function loadAll() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {}; }
    catch { return {}; }
}
function saveAll(data) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
}
function todayKey() {
    const d = new Date();
    return d.toISOString().slice(0, 10); // YYYY-MM-DD
}

// ── Date helpers ─────────────────────────────────────────────────────────────
function formatDateLong(key) {
    const [y, m, d] = key.split('-').map(Number);
    const dt = new Date(y, m - 1, d);
    return dt.toLocaleDateString('en-CA', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}

// ── Today label ──────────────────────────────────────────────────────────────
document.getElementById('today-label').textContent =
    new Date().toLocaleDateString('en-CA', { weekday:'long', year:'numeric', month:'long', day:'numeric' });

// ── Load today's entry if exists ─────────────────────────────────────────────
(function loadToday() {
    const all = loadAll();
    const today = todayKey();
    if (all[today]) {
        const e = all[today];
        document.getElementById('jon-rose').value    = e.jon?.rose    || '';
        document.getElementById('jon-thorn').value   = e.jon?.thorn   || '';
        document.getElementById('jon-bud').value     = e.jon?.bud     || '';
        document.getElementById('nathan-rose').value  = e.nathan?.rose  || '';
        document.getElementById('nathan-thorn').value = e.nathan?.thorn || '';
        document.getElementById('nathan-bud').value   = e.nathan?.bud   || '';
    }
})();

// ── Save button ──────────────────────────────────────────────────────────────
document.getElementById('save-btn').addEventListener('click', () => {
    const all = loadAll();
    const today = todayKey();
    all[today] = {
        savedAt: new Date().toISOString(),
        jon: {
            rose:  document.getElementById('jon-rose').value.trim(),
            thorn: document.getElementById('jon-thorn').value.trim(),
            bud:   document.getElementById('jon-bud').value.trim(),
        },
        nathan: {
            rose:  document.getElementById('nathan-rose').value.trim(),
            thorn: document.getElementById('nathan-thorn').value.trim(),
            bud:   document.getElementById('nathan-bud').value.trim(),
        }
    };
    saveAll(all);
    const fb = document.getElementById('save-feedback');
    fb.textContent = '✅ Saved! Good night, Jon & Nathan. 🌙';
    setTimeout(() => { fb.textContent = ''; }, 4000);
    updateStats();
});

// ── Tabs ─────────────────────────────────────────────────────────────────────
let calViewDate = new Date();

document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
        btn.classList.add('active');
        const viewId = 'view-' + btn.dataset.view;
        document.getElementById(viewId).classList.add('active');
        if (btn.dataset.view === 'history') renderCal(calViewDate);
        if (btn.dataset.view === 'stats')   updateStats();
    });
});

// ── Calendar ─────────────────────────────────────────────────────────────────
function renderCal(viewDate) {
    const all = loadAll();
    const today = todayKey();
    const y = viewDate.getFullYear();
    const m = viewDate.getMonth(); // 0-indexed

    document.getElementById('cal-title').textContent =
        viewDate.toLocaleDateString('en-CA', { month: 'long', year: 'numeric' });

    const grid = document.getElementById('cal-grid');
    grid.innerHTML = '';

    // Day names
    ['S','M','T','W','T','F','S'].forEach(d => {
        const el = document.createElement('div');
        el.className = 'cal-day-name';
        el.textContent = d;
        grid.appendChild(el);
    });

    const firstDay = new Date(y, m, 1).getDay(); // 0=Sun
    const daysInMonth = new Date(y, m + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
        const el = document.createElement('div');
        el.className = 'cal-day empty';
        grid.appendChild(el);
    }

    for (let d = 1; d <= daysInMonth; d++) {
        const key = `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
        const el = document.createElement('div');
        el.className = 'cal-day';
        el.textContent = d;

        if (all[key])       el.classList.add('has-entry');
        if (key === today)  el.classList.add('today-day');

        if (all[key]) {
            el.addEventListener('click', () => showPastEntry(key, all[key]));
        }

        grid.appendChild(el);
    }
}

function showPastEntry(key, entry) {
    const box = document.getElementById('past-entry');
    document.getElementById('past-entry-date').textContent = formatDateLong(key);
    box.style.display = 'block';

    const body = document.getElementById('past-entry-body');
    body.innerHTML = '';

    [['jon','👨 Jon'], ['nathan','👦 Nathan']].forEach(([who, label]) => {
        const data = entry[who] || {};
        const div = document.createElement('div');
        div.className = 'past-person';
        div.innerHTML = `
            <h5>${label}</h5>
            <div class="past-field">
                <div class="past-label" style="color:var(--rose)">🌹 Rose</div>
                <div class="past-text">${esc(data.rose || '—')}</div>
            </div>
            <div class="past-field">
                <div class="past-label" style="color:var(--thorn)">🌵 Thorn</div>
                <div class="past-text">${esc(data.thorn || '—')}</div>
            </div>
            <div class="past-field">
                <div class="past-label" style="color:var(--bud)">🌱 Bud</div>
                <div class="past-text">${esc(data.bud || '—')}</div>
            </div>
        `;
        body.appendChild(div);
    });
}

function esc(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

document.getElementById('cal-prev').addEventListener('click', () => {
    calViewDate = new Date(calViewDate.getFullYear(), calViewDate.getMonth() - 1, 1);
    renderCal(calViewDate);
    document.getElementById('past-entry').style.display = 'none';
});
document.getElementById('cal-next').addEventListener('click', () => {
    calViewDate = new Date(calViewDate.getFullYear(), calViewDate.getMonth() + 1, 1);
    renderCal(calViewDate);
    document.getElementById('past-entry').style.display = 'none';
});

// ── Stats ─────────────────────────────────────────────────────────────────────
function updateStats() {
    const all = loadAll();
    const keys = Object.keys(all).sort();
    const today = todayKey();

    // Total
    document.getElementById('stat-total').textContent = keys.length;

    // This month
    const ym = today.slice(0,7);
    const monthCount = keys.filter(k => k.startsWith(ym)).length;
    document.getElementById('stat-month').textContent = monthCount;

    // Streak
    let streak = 0;
    let check = new Date();
    // if today is not logged, start from yesterday
    if (!all[today]) check.setDate(check.getDate() - 1);
    while (true) {
        const k = check.toISOString().slice(0,10);
        if (!all[k]) break;
        streak++;
        check.setDate(check.getDate() - 1);
    }
    document.getElementById('stat-streak').textContent = streak;

    const msgs = [
        streak === 0 ? 'Start your streak tonight! 🌱' :
        streak === 1 ? 'One day down — keep it going! 🌹' :
        streak < 7   ? `${streak} days in a row — you\'re building something special! 🌟` :
        streak < 30  ? `${streak}-day streak! Jon and Nathan are on a roll! 🔥` :
                       `${streak} days! This journal is a treasure. 💎`
    ];
    document.getElementById('streak-msg').textContent = msgs[0];

    // Recent entries
    const recent = document.getElementById('recent-list');
    recent.innerHTML = '';
    const last7 = keys.slice(-7).reverse();
    if (last7.length === 0) {
        recent.innerHTML = '<div class="empty-msg">No entries yet — save tonight\'s first! 🌙</div>';
        return;
    }
    last7.forEach(key => {
        const e = all[key];
        const card = document.createElement('div');
        card.style.cssText = 'background:#fff;border:1.5px solid #e8d8cc;border-radius:12px;padding:14px 16px;margin-bottom:10px;cursor:pointer;';
        card.innerHTML = `
            <div style="font-weight:700;font-size:.9em;color:#8a7060;margin-bottom:8px;">${formatDateLong(key)}</div>
            <div style="font-size:.88em;line-height:1.5;color:#2d1a0e">
                🌹 <em>${esc(truncate(e.jon?.rose))}</em>
            </div>
        `;
        card.addEventListener('click', () => {
            document.querySelector('[data-view="history"]').click();
            calViewDate = new Date(key + 'T12:00:00');
            setTimeout(() => { renderCal(calViewDate); showPastEntry(key, e); }, 50);
        });
        recent.appendChild(card);
    });
}

function truncate(str, n=60) {
    if (!str) return 'no entry';
    return str.length > n ? str.slice(0, n) + '…' : str;
}

// Initial render
updateStats();
</script>

</body>
</html>
