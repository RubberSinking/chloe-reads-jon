<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browser Session Lab</title>
    <style>
        :root {
            --bg: #0b1020;
            --panel: rgba(16, 24, 48, 0.82);
            --panel-2: rgba(25, 35, 68, 0.88);
            --line: rgba(255,255,255,0.12);
            --text: #eef4ff;
            --muted: #aeb9d6;
            --accent: #7dd3fc;
            --accent-2: #a78bfa;
            --good: #86efac;
            --warn: #fcd34d;
            --shadow: 0 18px 48px rgba(0,0,0,0.35);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(125, 211, 252, 0.18), transparent 28%),
                radial-gradient(circle at top right, rgba(167, 139, 250, 0.22), transparent 26%),
                linear-gradient(180deg, #0b1020 0%, #0f172a 100%);
            color: var(--text);
            min-height: 100vh;
        }

        a { color: var(--accent); }

        .shell {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 60px;
        }

        .hero {
            background: linear-gradient(145deg, rgba(18, 28, 58, 0.95), rgba(28, 36, 64, 0.8));
            border: 1px solid var(--line);
            border-radius: 28px;
            padding: 26px;
            box-shadow: var(--shadow);
            margin-bottom: 22px;
            overflow: hidden;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: auto -60px -60px auto;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(125,211,252,0.15), transparent 70%);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            padding: 7px 11px;
            border-radius: 999px;
            background: rgba(125, 211, 252, 0.12);
            color: #c8ecff;
            font-size: 0.84rem;
            margin-bottom: 14px;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 3.6rem);
            line-height: 0.95;
            letter-spacing: -0.05em;
            margin: 0 0 14px;
            max-width: 10ch;
        }

        .hero p {
            color: var(--muted);
            line-height: 1.6;
            max-width: 70ch;
            margin: 0 0 12px;
        }

        .hero-grid {
            display: grid;
            gap: 14px;
            grid-template-columns: 1.5fr 1fr;
            align-items: start;
            margin-top: 18px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .card.pad { padding: 18px; }

        .legend {
            display: grid;
            gap: 10px;
        }

        .legend-item {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-top: 4px;
            flex: 0 0 auto;
        }

        .grid {
            display: grid;
            gap: 18px;
            grid-template-columns: 1.35fr 1fr;
            align-items: start;
        }

        .lab-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 18px 18px 0;
        }

        .lab-header h2, .lab-header h3 {
            margin: 0;
            letter-spacing: -0.03em;
        }

        .subtle {
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .browsers {
            display: grid;
            gap: 16px;
            padding: 18px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .browser-card {
            background: var(--panel-2);
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 16px;
        }

        .browser-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .browser-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .icon {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.15rem;
            background: rgba(255,255,255,0.08);
        }

        .status-pill {
            border-radius: 999px;
            padding: 6px 10px;
            font-size: 0.78rem;
            border: 1px solid var(--line);
            color: var(--muted);
            white-space: nowrap;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        button {
            appearance: none;
            border: 0;
            color: var(--text);
            background: rgba(255,255,255,0.08);
            border: 1px solid transparent;
            border-radius: 14px;
            padding: 10px 12px;
            font: inherit;
            cursor: pointer;
            transition: 0.18s ease;
        }

        button:hover { transform: translateY(-1px); }
        button.active {
            background: linear-gradient(135deg, rgba(125,211,252,0.25), rgba(167,139,250,0.25));
            border-color: rgba(125,211,252,0.45);
        }
        button.ghost {
            color: var(--muted);
            border-color: var(--line);
        }
        button.warning {
            background: rgba(252, 211, 77, 0.12);
            color: #fde68a;
        }

        .login-panel {
            display: grid;
            gap: 10px;
            margin-bottom: 12px;
        }

        .note {
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.05);
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.45;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .storage-strip {
            display: grid;
            gap: 10px;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            margin-top: 14px;
        }

        .storage-box {
            padding: 12px;
            border-radius: 16px;
            background: rgba(6, 10, 24, 0.55);
            border: 1px solid var(--line);
        }

        .storage-box h4 {
            margin: 0 0 8px;
            font-size: 0.88rem;
            color: #d5e4ff;
        }

        .mono {
            font-family: ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 0.88rem;
            color: #c0d7ff;
            line-height: 1.45;
            word-break: break-word;
        }

        .side {
            display: grid;
            gap: 18px;
        }

        .challenge {
            padding: 18px;
        }

        .challenge h3 { margin: 0 0 10px; }

        .challenge-list {
            display: grid;
            gap: 10px;
            margin-top: 12px;
        }

        .challenge-item {
            padding: 12px 14px;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: rgba(255,255,255,0.04);
        }

        .challenge-item.done {
            border-color: rgba(134,239,172,0.45);
            background: rgba(134,239,172,0.10);
        }

        .challenge-item strong {
            display: block;
            margin-bottom: 4px;
        }

        .score {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid var(--line);
        }

        .score-value {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.04em;
        }

        .mini-browser {
            padding: 18px;
        }

        .tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 14px;
        }

        .app-view {
            min-height: 200px;
            border-radius: 18px;
            padding: 16px;
            background: linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.03));
            border: 1px solid var(--line);
        }

        .mail {
            display: grid;
            gap: 12px;
        }

        .mail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 700;
            background: linear-gradient(135deg, rgba(125,211,252,0.35), rgba(167,139,250,0.35));
        }

        .mail-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            background: rgba(6,10,24,0.45);
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .mail-row small, .tiny { color: var(--muted); }

        .footer-note {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        @media (max-width: 900px) {
            .hero-grid, .grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 720px) {
            .shell { width: min(100%, calc(100% - 18px)); }
            .hero { padding: 18px; border-radius: 22px; }
            .browsers { grid-template-columns: 1fr; padding: 14px; }
            .lab-header { padding: 16px 16px 0; }
            .storage-strip { grid-template-columns: 1fr; }
            .browser-card { padding: 14px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="eyebrow">🍪 Tiny 2005 browser weirdness, now with better lighting</div>
            <h1>Browser Session Lab</h1>
            <p>Jon once wrote a delightfully specific post about using different browsers to stay signed in as different users. This page turns that little developer survival trick into a hands-on lab: sign in as Alice here, Bob there, poke at cookies and local storage, and watch which identities leak across profiles and which ones stay gloriously contained.</p>
            <div class="hero-grid">
                <div class="card pad">
                    <div class="legend">
                        <div class="legend-item"><span class="dot" style="background:#7dd3fc"></span><span><strong>Same browser + same profile</strong> shares storage. If one tab changes identity, the others do too. Tiny domestic chaos.</span></div>
                        <div class="legend-item"><span class="dot" style="background:#a78bfa"></span><span><strong>Different browser or different profile</strong> gets its own cookie jar, so you can stay signed in separately.</span></div>
                        <div class="legend-item"><span class="dot" style="background:#86efac"></span><span><strong>Session cookies</strong> disappear when you close that browser. <strong>Persistent cookies</strong> hang around like guests who missed the hint.</span></div>
                    </div>
                </div>
                <div class="card pad">
                    <div class="subtle"><strong>Inspired by:</strong><br><a href="https://jona.ca/2005/12/using-ie-to-remain-signed-in-as.html" target="_blank" rel="noopener">Using IE to remain signed in as different users</a></div>
                    <p class="subtle" style="margin:12px 0 0;">Back when web apps were young and browser-testing was half software engineering, half improvised wizardry.</p>
                </div>
            </div>
        </section>

        <div class="grid">
            <section class="card">
                <div class="lab-header">
                    <div>
                        <h2>Identity playground</h2>
                        <div class="subtle">Try different users, profiles, and storage types. Everything here runs locally in your browser.</div>
                    </div>
                    <button class="ghost" id="resetAll">Reset lab</button>
                </div>
                <div class="browsers" id="browserGrid"></div>
            </section>

            <aside class="side">
                <section class="card challenge">
                    <h3>Mini challenges</h3>
                    <div class="subtle">Because every good lab deserves a few mildly bossy objectives.</div>
                    <div class="challenge-list" id="challengeList"></div>
                    <div class="score">
                        <div>
                            <div class="tiny">Completed</div>
                            <div class="score-value" id="scoreValue">0/3</div>
                        </div>
                        <button class="ghost" id="reshuffleChallenges">New set</button>
                    </div>
                </section>

                <section class="card mini-browser">
                    <h3 style="margin:0 0 10px;">Mock web app</h3>
                    <div class="subtle" style="margin-bottom:12px;">Peek at the selected browser's inbox to see who is signed in there right now.</div>
                    <div class="tabs" id="browserTabs"></div>
                    <div class="app-view" id="appView"></div>
                </section>
            </aside>
        </div>

        <div class="footer-note">Built as a little tribute to old-school web tinkering, when the answer to “how do I test this?” was often “well, let’s try opening Netscape too.”</div>
    </div>

    <script>
        const users = {
            guest: { name: 'Guest', email: 'not signed in', accent: '#94a3b8', inbox: [] },
            alice: { name: 'Alice', email: 'alice@example.test', accent: '#7dd3fc', inbox: ['Welcome back, Alice', 'Your blueprints are ready', '2-factor code: 184291'] },
            bob: { name: 'Bob', email: 'bob@example.test', accent: '#fca5a5', inbox: ['Build status: green', 'Retro console deal alert', 'You have 4 saved drafts'] },
            clara: { name: 'Clara', email: 'clara@example.test', accent: '#c4b5fd', inbox: ['Parish volunteer schedule', 'Choir rehearsal notes', 'Daily quote: stay delightfully stubborn'] }
        };

        const browserDefs = [
            { id: 'browserA', label: 'Browser A', icon: '🌐', family: 'browser-a' },
            { id: 'browserA2', label: 'Browser A • Profile 2', icon: '🧩', family: 'browser-a-profile-2' },
            { id: 'browserB', label: 'Browser B', icon: '🦊', family: 'browser-b' },
            { id: 'browserC', label: 'Browser C', icon: '🧭', family: 'browser-c' }
        ];

        const defaultState = () => ({
            user: 'guest',
            cookieMode: 'session',
            cookieValue: null,
            localDraft: '',
            lastAction: 'Fresh profile. Nobody signed in yet.'
        });

        const state = loadState();
        let selectedAppBrowser = browserDefs[0].id;
        let activeChallenges = loadChallenges();

        function loadState() {
            try {
                const raw = localStorage.getItem('browser-session-lab-state');
                if (!raw) return makeFreshState();
                const parsed = JSON.parse(raw);
                const fresh = makeFreshState();
                for (const def of browserDefs) {
                    fresh[def.id] = { ...fresh[def.id], ...(parsed[def.id] || {}) };
                }
                return fresh;
            } catch {
                return makeFreshState();
            }
        }

        function makeFreshState() {
            return Object.fromEntries(browserDefs.map(def => [def.id, defaultState()]));
        }

        function saveState() {
            localStorage.setItem('browser-session-lab-state', JSON.stringify(state));
        }

        function loadChallenges() {
            try {
                const raw = localStorage.getItem('browser-session-lab-challenges');
                const parsed = raw ? JSON.parse(raw) : null;
                if (parsed && Array.isArray(parsed) && parsed.length === 3) return parsed;
            } catch {}
            return makeChallenges();
        }

        function saveChallenges() {
            localStorage.setItem('browser-session-lab-challenges', JSON.stringify(activeChallenges));
        }

        function makeChallenges() {
            const pool = [
                {
                    id: 'dual-identity',
                    title: 'Split the identities',
                    text: 'Keep Alice signed in on Browser A and Bob signed in on Browser B at the same time.'
                },
                {
                    id: 'profile-isolation',
                    title: 'Same browser, different profile',
                    text: 'Use Browser A and Browser A Profile 2 to sign in as two different users.'
                },
                {
                    id: 'cookie-vanish',
                    title: 'Make a session disappear',
                    text: 'Sign someone in with a session cookie, then close that browser profile.'
                },
                {
                    id: 'persistent-survivor',
                    title: 'Persistent little gremlin',
                    text: 'Sign in with a persistent cookie, close the browser, and make sure the user stays signed in.'
                },
                {
                    id: 'draft-keeper',
                    title: 'Save the draft',
                    text: 'Write a draft note for any signed-in user so it appears in local storage.'
                }
            ];
            const shuffled = [...pool].sort(() => Math.random() - 0.5);
            return shuffled.slice(0, 3);
        }

        function render() {
            const grid = document.getElementById('browserGrid');
            grid.innerHTML = browserDefs.map(def => renderBrowserCard(def)).join('');
            attachCardEvents();
            renderTabs();
            renderAppView();
            renderChallenges();
            saveState();
            saveChallenges();
        }

        function renderBrowserCard(def) {
            const item = state[def.id];
            const user = users[item.user];
            const signedIn = item.user !== 'guest';
            return `
                <article class="browser-card" data-browser="${def.id}">
                    <div class="browser-top">
                        <div class="browser-name"><div class="icon">${def.icon}</div> ${def.label}</div>
                        <div class="status-pill">${signedIn ? 'Signed in as ' + user.name : 'Signed out'}</div>
                    </div>

                    <div class="note">${item.lastAction}</div>

                    <div class="row" style="margin-top:12px;">
                        <button class="${item.cookieMode === 'session' ? 'active' : ''}" data-action="set-cookie-mode" data-browser="${def.id}" data-mode="session">Session cookie</button>
                        <button class="${item.cookieMode === 'persistent' ? 'active' : ''}" data-action="set-cookie-mode" data-browser="${def.id}" data-mode="persistent">Persistent cookie</button>
                    </div>

                    <div class="login-panel">
                        <div class="subtle">Sign in as:</div>
                        <div class="row">
                            ${['alice', 'bob', 'clara'].map(key => `<button data-action="login" data-browser="${def.id}" data-user="${key}">${users[key].name}</button>`).join('')}
                            <button class="ghost" data-action="logout" data-browser="${def.id}">Sign out</button>
                        </div>
                    </div>

                    <div class="row">
                        <button class="ghost" data-action="select-app" data-browser="${def.id}">View inbox</button>
                        <button class="warning" data-action="close-browser" data-browser="${def.id}">Close browser</button>
                    </div>

                    <div class="storage-strip">
                        <div class="storage-box">
                            <h4>Cookie jar</h4>
                            <div class="mono">user=${item.cookieValue || 'none'}\nmode=${item.cookieMode}</div>
                        </div>
                        <div class="storage-box">
                            <h4>Local storage</h4>
                            <div class="mono">draft=${item.localDraft ? JSON.stringify(item.localDraft) : 'empty'}</div>
                        </div>
                    </div>
                </article>
            `;
        }

        function renderTabs() {
            document.getElementById('browserTabs').innerHTML = browserDefs.map(def => `
                <button class="${selectedAppBrowser === def.id ? 'active' : 'ghost'}" data-action="tab" data-browser="${def.id}">${def.label}</button>
            `).join('');
            document.querySelectorAll('[data-action="tab"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    selectedAppBrowser = btn.dataset.browser;
                    renderTabs();
                    renderAppView();
                });
            });
        }

        function renderAppView() {
            const item = state[selectedAppBrowser];
            const user = users[item.user];
            const view = document.getElementById('appView');
            if (item.user === 'guest') {
                view.innerHTML = `
                    <div class="mail">
                        <div class="mail-header">
                            <div>
                                <div class="tiny">Mock mail app</div>
                                <h4 style="margin:4px 0 0;">Nobody is signed in</h4>
                            </div>
                            <div class="avatar">?</div>
                        </div>
                        <div class="note">This is the entire point of the experiment: browser identity lives in storage. No cookie, no session, no inbox. Just digital tumbleweeds.</div>
                    </div>
                `;
                return;
            }

            view.innerHTML = `
                <div class="mail">
                    <div class="mail-header">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div class="avatar" style="background:linear-gradient(135deg, ${user.accent}55, rgba(167,139,250,0.35));">${user.name[0]}</div>
                            <div>
                                <div class="tiny">Signed in as</div>
                                <h4 style="margin:4px 0 0;">${user.name}</h4>
                                <div class="tiny">${user.email}</div>
                            </div>
                        </div>
                        <div class="status-pill">${item.cookieMode === 'persistent' ? 'Will survive close' : 'Will vanish on close'}</div>
                    </div>
                    ${user.inbox.map((message, index) => `
                        <div class="mail-row">
                            <div style="font-size:1.1rem;">${['📬','🧪','✨'][index % 3]}</div>
                            <div>
                                <strong>${message}</strong><br>
                                <small>${user.name}'s account only</small>
                            </div>
                        </div>
                    `).join('')}
                    <div>
                        <label class="tiny" for="draftBox">Draft note in local storage</label>
                        <textarea id="draftBox" style="width:100%; min-height:92px; margin-top:8px; border-radius:14px; border:1px solid rgba(255,255,255,0.1); background:rgba(6,10,24,0.45); color:var(--text); padding:12px; font:inherit;" placeholder="Write something here...">${escapeHtml(item.localDraft)}</textarea>
                        <div class="row" style="margin-top:10px; margin-bottom:0;">
                            <button id="saveDraft">Save draft</button>
                            <button class="ghost" id="clearDraft">Clear draft</button>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('saveDraft').addEventListener('click', () => {
                const val = document.getElementById('draftBox').value.trim();
                item.localDraft = val;
                item.lastAction = val ? `Saved a local draft for ${user.name}.` : `Cleared the local draft for ${user.name}.`;
                render();
            });
            document.getElementById('clearDraft').addEventListener('click', () => {
                item.localDraft = '';
                item.lastAction = `Cleared the local draft for ${user.name}.`;
                render();
            });
        }

        function renderChallenges() {
            const completed = activeChallenges.filter(ch => isChallengeDone(ch.id)).length;
            document.getElementById('scoreValue').textContent = `${completed}/${activeChallenges.length}`;
            document.getElementById('challengeList').innerHTML = activeChallenges.map(ch => `
                <div class="challenge-item ${isChallengeDone(ch.id) ? 'done' : ''}">
                    <strong>${ch.title}</strong>
                    <div class="subtle">${ch.text}</div>
                </div>
            `).join('');
        }

        function isChallengeDone(id) {
            const a = state.browserA, a2 = state.browserA2, b = state.browserB;
            switch (id) {
                case 'dual-identity':
                    return a.user === 'alice' && b.user === 'bob';
                case 'profile-isolation':
                    return a.user !== 'guest' && a2.user !== 'guest' && a.user !== a2.user;
                case 'cookie-vanish':
                    return Object.values(state).some(item => item.lastAction.includes('Session ended when the browser closed.'));
                case 'persistent-survivor':
                    return Object.values(state).some(item => item.lastAction.includes('Persistent cookie survived the close.'));
                case 'draft-keeper':
                    return Object.values(state).some(item => item.localDraft.trim().length > 0);
                default:
                    return false;
            }
        }

        function attachCardEvents() {
            document.querySelectorAll('[data-action]').forEach(button => {
                const action = button.dataset.action;
                if (action === 'tab') return;
                button.addEventListener('click', () => {
                    const browserId = button.dataset.browser;
                    if (action === 'set-cookie-mode') {
                        state[browserId].cookieMode = button.dataset.mode;
                        state[browserId].lastAction = `Cookie mode changed to ${button.dataset.mode}.`;
                    }
                    if (action === 'login') {
                        const user = button.dataset.user;
                        state[browserId].user = user;
                        state[browserId].cookieValue = user;
                        state[browserId].lastAction = `Signed in as ${users[user].name} using a ${state[browserId].cookieMode} cookie.`;
                        selectedAppBrowser = browserId;
                    }
                    if (action === 'logout') {
                        state[browserId].user = 'guest';
                        state[browserId].cookieValue = null;
                        state[browserId].lastAction = 'Signed out and cleared the cookie.';
                    }
                    if (action === 'close-browser') {
                        const item = state[browserId];
                        if (item.cookieMode === 'session' && item.cookieValue) {
                            item.user = 'guest';
                            item.cookieValue = null;
                            item.lastAction = 'Session ended when the browser closed. Poof.';
                        } else if (item.cookieMode === 'persistent' && item.cookieValue) {
                            item.lastAction = 'Persistent cookie survived the close. Mildly clingy, but useful.';
                        } else {
                            item.lastAction = 'Closed an already signed-out browser. Very dramatic for very little effect.';
                        }
                    }
                    if (action === 'select-app') {
                        selectedAppBrowser = browserId;
                    }
                    render();
                });
            });
        }

        function escapeHtml(str) {
            return String(str)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;');
        }

        document.getElementById('resetAll').addEventListener('click', () => {
            const fresh = makeFreshState();
            for (const key of Object.keys(fresh)) state[key] = fresh[key];
            selectedAppBrowser = browserDefs[0].id;
            render();
        });

        document.getElementById('reshuffleChallenges').addEventListener('click', () => {
            activeChallenges = makeChallenges();
            render();
        });

        render();
    </script>
</body>
</html>
