<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prompt Conservatory</title>
    <style>
        :root {
            --bg: #071015;
            --bg-deep: #04080b;
            --panel: rgba(11, 28, 34, 0.82);
            --panel-strong: rgba(14, 36, 44, 0.95);
            --line: rgba(148, 188, 181, 0.18);
            --text: #e6f3ee;
            --muted: #9eb8b0;
            --gold: #f0c56c;
            --lime: #8fe388;
            --mint: #5dd9b5;
            --rose: #ff7d81;
            --cyan: #78dce8;
            --shadow: 0 24px 70px rgba(0, 0, 0, 0.38);
            --radius: 28px;
            --display: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            --body: "Avenir Next", "Segoe UI", sans-serif;
            --mono: "SFMono-Regular", "Cascadia Code", "Menlo", "Consolas", monospace;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--body);
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(112, 197, 173, 0.14), transparent 28%),
                radial-gradient(circle at 82% 14%, rgba(240, 197, 108, 0.12), transparent 18%),
                linear-gradient(180deg, #0b171d 0%, #060c10 46%, #04070a 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background:
                repeating-linear-gradient(0deg, rgba(255,255,255,0.03) 0 1px, transparent 1px 4px),
                radial-gradient(circle at center, transparent 0 45%, rgba(0, 0, 0, 0.26) 100%);
            pointer-events: none;
            mix-blend-mode: soft-light;
            opacity: 0.4;
        }

        .glass-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(10px);
            opacity: 0.22;
            pointer-events: none;
            animation: drift 18s ease-in-out infinite alternate;
        }
        .orb-a { width: 280px; height: 280px; left: -60px; top: 120px; background: #5dd9b5; }
        .orb-b { width: 220px; height: 220px; right: -30px; top: 320px; background: #f0c56c; animation-duration: 23s; }
        .orb-c { width: 180px; height: 180px; right: 16%; bottom: 40px; background: #78dce8; animation-duration: 15s; }

        @keyframes drift {
            from { transform: translate3d(0, 0, 0) scale(1); }
            to { transform: translate3d(24px, -22px, 0) scale(1.08); }
        }

        .page {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 72px;
            position: relative;
            z-index: 1;
        }

        .hero {
            position: relative;
            padding: 28px;
            border: 1px solid var(--line);
            border-radius: calc(var(--radius) + 6px);
            background:
                linear-gradient(145deg, rgba(10, 27, 33, 0.92), rgba(7, 16, 21, 0.9)),
                linear-gradient(120deg, rgba(240,197,108,0.06), transparent 40%);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 12px;
            border-radius: calc(var(--radius) - 4px);
            border: 1px solid rgba(240, 197, 108, 0.12);
            pointer-events: none;
        }

        .hero-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 18px;
            flex-wrap: wrap;
        }

        .eyebrow {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid rgba(240, 197, 108, 0.25);
            background: rgba(240, 197, 108, 0.08);
            color: var(--gold);
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 18px 0 14px;
            font-family: var(--display);
            font-size: clamp(2.8rem, 7vw, 5.3rem);
            line-height: 0.96;
            letter-spacing: -0.04em;
            max-width: 9ch;
        }

        .hero p {
            margin: 0;
            max-width: 64ch;
            line-height: 1.7;
            color: var(--muted);
            font-size: 1.04rem;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .hero-links a, .button {
            appearance: none;
            border: 1px solid rgba(148, 188, 181, 0.18);
            color: var(--text);
            background: rgba(255, 255, 255, 0.03);
            padding: 12px 16px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 650;
            cursor: pointer;
            transition: transform 0.18s ease, border-color 0.18s ease, background 0.18s ease;
        }

        .hero-links a:hover, .button:hover, .button:focus-visible {
            transform: translateY(-2px);
            border-color: rgba(240, 197, 108, 0.4);
            background: rgba(240, 197, 108, 0.08);
            outline: none;
        }

        .hero-quote {
            max-width: 360px;
            padding: 18px;
            border-radius: 20px;
            background: rgba(0, 0, 0, 0.18);
            border: 1px solid rgba(120, 220, 232, 0.14);
            color: #d8ebe5;
            line-height: 1.7;
        }

        .hero-quote strong {
            display: block;
            margin-bottom: 8px;
            color: var(--cyan);
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .grid {
            display: grid;
            gap: 18px;
            margin-top: 22px;
        }

        .main-grid {
            grid-template-columns: 1.04fr 0.96fr;
            align-items: start;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(16px);
        }

        .card h2, .card h3 {
            margin: 0 0 10px;
            font-family: var(--display);
            letter-spacing: -0.03em;
        }

        .card h2 { font-size: clamp(1.7rem, 4vw, 2.35rem); }
        .card h3 { font-size: 1.3rem; }
        .lede { color: var(--muted); line-height: 1.65; margin-bottom: 18px; }

        .controls {
            display: grid;
            gap: 14px;
        }

        .control-group {
            background: rgba(255,255,255,0.025);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            padding: 16px;
        }

        .control-group legend, .label {
            font-size: 0.84rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--gold);
            margin-bottom: 10px;
            display: block;
        }

        .input-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        input[type="text"], select, textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(158, 184, 176, 0.14);
            background: rgba(4, 8, 11, 0.72);
            color: var(--text);
            font: inherit;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
            font-family: var(--mono);
            line-height: 1.55;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .chip {
            position: relative;
        }

        .chip input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .chip span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.03);
            cursor: pointer;
            transition: transform 0.18s ease, background 0.18s ease, border-color 0.18s ease;
        }

        .chip input:checked + span {
            background: rgba(93, 217, 181, 0.14);
            border-color: rgba(93, 217, 181, 0.45);
            box-shadow: inset 0 0 0 1px rgba(93, 217, 181, 0.18);
        }

        .chip span:hover { transform: translateY(-1px); }

        .theme-swatches { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 10px; }
        .theme-btn {
            padding: 14px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.04);
            cursor: pointer;
            text-align: left;
            color: var(--text);
        }
        .theme-btn strong { display: block; margin-bottom: 8px; }
        .theme-bar { display: flex; gap: 6px; }
        .theme-bar span { display: block; width: 100%; height: 10px; border-radius: 999px; }
        .theme-btn.active { outline: 2px solid rgba(240, 197, 108, 0.45); }

        .terminal {
            position: relative;
            border-radius: 26px;
            overflow: hidden;
            border: 1px solid rgba(120, 220, 232, 0.18);
            background: linear-gradient(180deg, rgba(2,6,8,0.95), rgba(5,14,18,0.95));
            min-height: 300px;
        }

        .terminal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            background: rgba(255,255,255,0.03);
        }

        .lights { display: flex; gap: 8px; }
        .lights i { width: 11px; height: 11px; border-radius: 50%; display: block; }
        .lights i:nth-child(1) { background: #ff6b6b; }
        .lights i:nth-child(2) { background: #ffd166; }
        .lights i:nth-child(3) { background: #84fab0; }
        .terminal-body {
            padding: 18px;
            font-family: var(--mono);
            line-height: 1.85;
            color: #d8efe6;
        }

        .terminal-line {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3ch;
            align-items: center;
            margin-bottom: 8px;
            word-break: break-word;
        }

        .segment {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 0.12rem 0.65rem;
            font-size: 0.95rem;
            border: 1px solid transparent;
        }
        .prompt-sign { color: var(--gold); font-weight: 700; }
        .cursor {
            display: inline-block;
            width: 0.68rem;
            height: 1.15rem;
            margin-left: 0.18rem;
            background: currentColor;
            vertical-align: middle;
            animation: blink 1s steps(1) infinite;
        }

        @keyframes blink {
            0%, 48% { opacity: 1; }
            50%, 100% { opacity: 0; }
        }

        .status-strip {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .status-pill {
            padding: 12px 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .status-pill small { display: block; color: var(--muted); margin-bottom: 6px; }
        .status-pill strong { font-size: 1.04rem; }

        .playground-grid, .insights-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .history-output {
            margin-top: 14px;
            display: grid;
            gap: 8px;
            max-height: 220px;
            overflow: auto;
            padding-right: 4px;
        }
        .history-item {
            font-family: var(--mono);
            font-size: 0.95rem;
            padding: 12px 14px;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.025);
        }
        mark {
            background: rgba(240, 197, 108, 0.2);
            color: var(--gold);
            padding: 0 2px;
            border-radius: 4px;
        }

        .trick-list {
            display: grid;
            gap: 10px;
        }
        .trick {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .trick button {
            all: unset;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            gap: 16px;
            font-weight: 700;
        }
        .trick .answer {
            color: var(--muted);
            line-height: 1.6;
            margin-top: 10px;
            display: none;
        }
        .trick.open .answer { display: block; }

        .codebox {
            border-radius: 18px;
            border: 1px solid rgba(120, 220, 232, 0.18);
            background: rgba(2, 6, 8, 0.9);
            padding: 16px;
            font-family: var(--mono);
            white-space: pre-wrap;
            line-height: 1.65;
            color: #e9fbf3;
        }

        .footer-note {
            margin-top: 18px;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.7;
        }

        @media (max-width: 980px) {
            .main-grid, .playground-grid, .insights-grid, .theme-swatches, .status-strip, .input-row {
                grid-template-columns: 1fr;
            }
            .hero { padding: 22px; }
        }
    </style>
</head>
<body>
    <div class="glass-orb orb-a"></div>
    <div class="glass-orb orb-b"></div>
    <div class="glass-orb orb-c"></div>

    <main class="page">
        <section class="hero">
            <div class="hero-top">
                <div>
                    <span class="eyebrow">Prompt Conservatory</span>
                    <h1>Grow a zsh prompt that deserves to be stared at.</h1>
                    <p>This is a glasshouse for terminal aesthetics: part prompt builder, part tiny zsh museum, part loving excuse to obsess over git branches, dirty-state dots, and the simple dignity of a shell that knows what time it is.</p>
                    <div class="hero-links">
                        <a href="./">← Back to Chloe Reads Jon</a>
                        <a href="#playground">Jump to the workshop</a>
                    </div>
                </div>
                <aside class="hero-quote">
                    <strong>Inspired by Jon's post</strong>
                    “What I like about zsh” celebrated custom prompts, shared history, smart suggestions, and that slightly smug feeling when your shell is more civilized than everyone else's.
                </aside>
            </div>
        </section>

        <section class="grid main-grid" id="playground">
            <article class="card">
                <h2>Prompt Workshop</h2>
                <p class="lede">Tune the pieces of your prompt, switch themes, and watch the terminal preview update live. You get the pretty part and the nerdy part. Naturally.</p>

                <div class="controls">
                    <div class="control-group">
                        <span class="label">Identity</span>
                        <div class="input-row">
                            <label>
                                <span class="label" style="margin-bottom:8px; color:var(--muted); letter-spacing:0.04em;">User</span>
                                <input id="userName" type="text" value="jon">
                            </label>
                            <label>
                                <span class="label" style="margin-bottom:8px; color:var(--muted); letter-spacing:0.04em;">Host</span>
                                <input id="hostName" type="text" value="openclaw">
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <span class="label">Path + branch</span>
                        <div class="input-row">
                            <label>
                                <span class="label" style="margin-bottom:8px; color:var(--muted); letter-spacing:0.04em;">Current directory</span>
                                <input id="cwd" type="text" value="~/projects/web-lab">
                            </label>
                            <label>
                                <span class="label" style="margin-bottom:8px; color:var(--muted); letter-spacing:0.04em;">Git branch</span>
                                <input id="branch" type="text" value="main">
                            </label>
                        </div>
                    </div>

                    <fieldset class="control-group">
                        <legend>Modules</legend>
                        <div class="chips">
                            <label class="chip"><input type="checkbox" value="userhost" checked><span>user@host</span></label>
                            <label class="chip"><input type="checkbox" value="cwd" checked><span>cwd</span></label>
                            <label class="chip"><input type="checkbox" value="git" checked><span>git branch</span></label>
                            <label class="chip"><input type="checkbox" value="dirty" checked><span>dirty marker</span></label>
                            <label class="chip"><input type="checkbox" value="time" checked><span>time</span></label>
                            <label class="chip"><input type="checkbox" value="mode"><span>vi mode</span></label>
                            <label class="chip"><input type="checkbox" value="exit"><span>exit code</span></label>
                        </div>
                    </fieldset>

                    <div class="control-group">
                        <span class="label">Mood</span>
                        <div class="theme-swatches">
                            <button class="theme-btn active" data-theme="solarized" type="button">
                                <strong>Solarized Study</strong>
                                <div class="theme-bar"><span style="background:#073642"></span><span style="background:#2aa198"></span><span style="background:#b58900"></span></div>
                            </button>
                            <button class="theme-btn" data-theme="emerald" type="button">
                                <strong>Emerald Night</strong>
                                <div class="theme-bar"><span style="background:#091e18"></span><span style="background:#5dd9b5"></span><span style="background:#a4f3b2"></span></div>
                            </button>
                            <button class="theme-btn" data-theme="amber" type="button">
                                <strong>Amber Console</strong>
                                <div class="theme-bar"><span style="background:#180d08"></span><span style="background:#f0c56c"></span><span style="background:#ff8f5c"></span></div>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <article class="card">
                <h2>Live Terminal</h2>
                <p class="lede">The preview intentionally feels a little theatrical. zsh users are allowed one tasteful amount of vanity.</p>
                <div class="terminal" id="terminalPreview">
                    <div class="terminal-header">
                        <div class="lights"><i></i><i></i><i></i></div>
                        <span id="terminalTitle">~/projects/web-lab · zsh</span>
                    </div>
                    <div class="terminal-body">
                        <div class="terminal-line" id="promptLine"></div>
                        <div class="terminal-line" id="sampleCommand"></div>
                        <div class="terminal-line" id="outputLine"></div>
                    </div>
                </div>
                <div class="status-strip">
                    <div class="status-pill"><small>Prompt length</small><strong id="lengthStat">0 chars</strong></div>
                    <div class="status-pill"><small>Visual complexity</small><strong id="densityStat">Balanced</strong></div>
                    <div class="status-pill"><small>Vibe</small><strong id="vibeStat">Solarized dignity</strong></div>
                </div>
            </article>
        </section>

        <section class="grid playground-grid">
            <article class="card">
                <h3>History Substring Playground</h3>
                <p class="lede">One of the nicest zsh tricks from Jon's post: type any substring and press ↑ to resurrect matching commands. Try it below.</p>
                <label>
                    <span class="label" style="color:var(--muted); letter-spacing:0.04em;">Type a substring</span>
                    <input id="historySearch" type="text" value="git">
                </label>
                <div class="history-output" id="historyOutput"></div>
            </article>

            <article class="card">
                <h3>Small zsh delights</h3>
                <p class="lede">Tap a card for the sort of feature that makes a shell quietly superior over time.</p>
                <div class="trick-list" id="trickList">
                    <div class="trick">
                        <button type="button"><span>Prompt shows branch + dirty state</span><span>+</span></button>
                        <div class="answer">The shell keeps a tiny pulse on your repo, so you can tell at a glance whether today's experiments are still uncommitted chaos.</div>
                    </div>
                    <div class="trick">
                        <button type="button"><span>Shared history across terminals</span><span>+</span></button>
                        <div class="answer">Open a new window and your commands are already there, like your shell has the decency to remember what you were doing five minutes ago.</div>
                    </div>
                    <div class="trick">
                        <button type="button"><span>Suggestions after a typo</span><span>+</span></button>
                        <div class="answer">Mistype a command and zsh nudges you toward the right one instead of standing there smugly while you spell <code>kubectl</code> wrong again.</div>
                    </div>
                    <div class="trick">
                        <button type="button"><span><code>^foo^bar^:G</code> substitution</span><span>+</span></button>
                        <div class="answer">A neat little incantation for fixing the previous command by replacing one substring with another. Ridiculously satisfying. Mildly wizardly.</div>
                    </div>
                </div>
            </article>
        </section>

        <section class="grid insights-grid">
            <article class="card">
                <h3>Config snippet</h3>
                <p class="lede">This is not a full plugin manager setup, just a clean pseudo-config based on your choices so you can daydream responsibly.</p>
                <div class="codebox" id="configOutput"></div>
            </article>

            <article class="card">
                <h3>Design notes from the greenhouse</h3>
                <p class="lede">A good prompt should earn its screen space. Not too chatty. Not too cryptic. Just enough ceremony to make command line life feel cared for.</p>
                <div class="footer-note">
                    Jon mentioned Solarized and iTerm2 in the original post, so this page leans into that late-night polished-terminal energy: glowing glass panels, brass accents, and a soft CRT grain instead of the usual purple-gradient AI wallpaper nonsense. Some of us have standards.
                </div>
            </article>
        </section>
    </main>

    <script>
        const themeData = {
            solarized: {
                line: '#2aa198',
                accent: '#b58900',
                danger: '#dc322f',
                text: '#d6ece3',
                back: 'linear-gradient(180deg, rgba(0,43,54,0.98), rgba(4,23,28,0.98))',
                vibe: 'Solarized dignity'
            },
            emerald: {
                line: '#5dd9b5',
                accent: '#a4f3b2',
                danger: '#ff7d81',
                text: '#effff8',
                back: 'linear-gradient(180deg, rgba(6,22,17,0.98), rgba(7,14,12,0.98))',
                vibe: 'Garden hacker glow'
            },
            amber: {
                line: '#f0c56c',
                accent: '#ff8f5c',
                danger: '#ff6b6b',
                text: '#fff0d9',
                back: 'linear-gradient(180deg, rgba(26,14,10,0.98), rgba(15,8,6,0.98))',
                vibe: 'Warm phosphor swagger'
            }
        };

        const historyCommands = [
            'git status',
            'git add -A && git commit -m "Polish prompt layout"',
            'git subtree push --prefix=chloe-reads-jon public main',
            'less **/XG_MediaUploaderHelper.php',
            'vim ~/.zshrc',
            'cd ~/projects/web-lab',
            'openclaw gateway status',
            'python3 ~/projects/scripts/random_pick.py --int 1 10',
            'grep -Rin "Solarized" ~/.config',
            'tmux attach -t chloe',
            'npm test',
            'php -l prompt-conservatory.php',
            'git checkout main',
            'history | tail -40'
        ];

        const els = {
            userName: document.getElementById('userName'),
            hostName: document.getElementById('hostName'),
            cwd: document.getElementById('cwd'),
            branch: document.getElementById('branch'),
            promptLine: document.getElementById('promptLine'),
            sampleCommand: document.getElementById('sampleCommand'),
            outputLine: document.getElementById('outputLine'),
            terminalPreview: document.getElementById('terminalPreview'),
            terminalTitle: document.getElementById('terminalTitle'),
            lengthStat: document.getElementById('lengthStat'),
            densityStat: document.getElementById('densityStat'),
            vibeStat: document.getElementById('vibeStat'),
            historySearch: document.getElementById('historySearch'),
            historyOutput: document.getElementById('historyOutput'),
            configOutput: document.getElementById('configOutput')
        };

        let currentTheme = 'solarized';

        document.querySelectorAll('.theme-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentTheme = btn.dataset.theme;
                render();
            });
        });

        document.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('input', render);
            el.addEventListener('change', render);
        });

        document.querySelectorAll('.trick').forEach(trick => {
            trick.querySelector('button').addEventListener('click', () => {
                trick.classList.toggle('open');
                trick.querySelector('button span:last-child').textContent = trick.classList.contains('open') ? '−' : '+';
            });
        });

        function activeModules() {
            return [...document.querySelectorAll('.chip input:checked')].map(input => input.value);
        }

        function makeSegment(text, background, color, border) {
            const span = document.createElement('span');
            span.className = 'segment';
            span.textContent = text;
            span.style.background = background;
            span.style.color = color;
            span.style.borderColor = border || 'transparent';
            return span;
        }

        function renderPrompt() {
            const theme = themeData[currentTheme];
            const modules = activeModules();
            const user = els.userName.value.trim() || 'jon';
            const host = els.hostName.value.trim() || 'openclaw';
            const cwd = els.cwd.value.trim() || '~/projects/web-lab';
            const branch = els.branch.value.trim() || 'main';

            els.promptLine.innerHTML = '';
            const parts = [];

            if (modules.includes('exit')) {
                parts.push(makeSegment('✖ 1', 'rgba(220,50,47,0.14)', theme.danger, 'rgba(220,50,47,0.35)'));
            }
            if (modules.includes('mode')) {
                parts.push(makeSegment('NORMAL', 'rgba(240,197,108,0.12)', theme.accent, 'rgba(240,197,108,0.35)'));
            }
            if (modules.includes('userhost')) {
                parts.push(makeSegment(`${user}@${host}`, 'rgba(93,217,181,0.12)', theme.line, 'rgba(93,217,181,0.35)'));
            }
            if (modules.includes('cwd')) {
                parts.push(makeSegment(cwd, 'rgba(120,220,232,0.12)', theme.text, 'rgba(120,220,232,0.22)'));
            }
            if (modules.includes('git')) {
                parts.push(makeSegment(` ${branch}`, 'rgba(240,197,108,0.12)', theme.accent, 'rgba(240,197,108,0.35)'));
            }
            if (modules.includes('dirty')) {
                parts.push(makeSegment('● dirty', 'rgba(255,125,129,0.14)', theme.danger, 'rgba(255,125,129,0.3)'));
            }
            if (modules.includes('time')) {
                parts.push(makeSegment('11:30', 'rgba(255,255,255,0.06)', theme.text, 'rgba(255,255,255,0.12)'));
            }

            parts.forEach(part => els.promptLine.appendChild(part));
            const sign = document.createElement('span');
            sign.className = 'prompt-sign';
            sign.textContent = '❯';
            sign.style.color = theme.accent;
            els.promptLine.appendChild(sign);

            const cmdText = document.createElement('span');
            cmdText.textContent = ' git status';
            els.promptLine.appendChild(cmdText);

            const cursor = document.createElement('span');
            cursor.className = 'cursor';
            cursor.style.color = theme.line;
            els.promptLine.appendChild(cursor);

            els.sampleCommand.textContent = 'On branch ' + branch + ' · Your branch is up to date with origin/' + branch + '.';
            els.sampleCommand.style.color = theme.line;
            els.outputLine.textContent = modules.includes('dirty')
                ? 'Changes not staged for commit: prompt-conservatory.php'
                : 'nothing to commit, working tree clean';
            els.outputLine.style.color = modules.includes('dirty') ? theme.danger : '#8fe388';

            els.terminalPreview.style.background = theme.back;
            els.terminalTitle.textContent = `${cwd} · zsh`;
            const charCount = parts.map(part => part.textContent).join(' ').length + 2;
            els.lengthStat.textContent = `${charCount} chars`;
            els.densityStat.textContent = modules.length <= 3 ? 'Quiet monk' : modules.length <= 5 ? 'Balanced' : 'Glorious peacock';
            els.vibeStat.textContent = theme.vibe;
        }

        function renderHistory() {
            const query = els.historySearch.value.trim().toLowerCase();
            const matches = historyCommands.filter(cmd => !query || cmd.toLowerCase().includes(query));
            els.historyOutput.innerHTML = '';

            if (!matches.length) {
                const empty = document.createElement('div');
                empty.className = 'history-item';
                empty.textContent = 'No matches. Your shell stares back in wounded silence.';
                els.historyOutput.appendChild(empty);
                return;
            }

            matches.forEach(cmd => {
                const item = document.createElement('div');
                item.className = 'history-item';
                if (!query) {
                    item.textContent = cmd;
                } else {
                    const idx = cmd.toLowerCase().indexOf(query);
                    item.innerHTML = `${escapeHtml(cmd.slice(0, idx))}<mark>${escapeHtml(cmd.slice(idx, idx + query.length))}</mark>${escapeHtml(cmd.slice(idx + query.length))}`;
                }
                els.historyOutput.appendChild(item);
            });
        }

        function renderConfig() {
            const modules = activeModules();
            const user = els.userName.value.trim() || 'jon';
            const host = els.hostName.value.trim() || 'openclaw';
            const cwd = els.cwd.value.trim() || '~/projects/web-lab';
            const branch = els.branch.value.trim() || 'main';

            const lines = [
                '# Prompt Conservatory sketch',
                'setopt PROMPT_SUBST HIST_IGNORE_DUPS SHARE_HISTORY',
                'autoload -Uz vcs_info',
                'precmd() { vcs_info }',
                ''
            ];

            if (modules.includes('userhost')) lines.push(`# identity: ${user}@${host}`);
            if (modules.includes('cwd')) lines.push(`# cwd preview: ${cwd}`);
            if (modules.includes('git')) lines.push(`# branch preview: ${branch}`);

            lines.push('PROMPT=""');
            if (modules.includes('exit')) lines.push('PROMPT+="%(?..%F{red}✖ %?%f )"');
            if (modules.includes('mode')) lines.push('PROMPT+="%F{yellow}${KEYMAP:-INSERT}%f "');
            if (modules.includes('userhost')) lines.push('PROMPT+="%F{cyan}%n@%m%f "');
            if (modules.includes('cwd')) lines.push('PROMPT+="%F{white}%~%f "');
            if (modules.includes('git')) lines.push('PROMPT+="%F{yellow}${vcs_info_msg_0_}%f "');
            if (modules.includes('dirty')) lines.push('PROMPT+="%F{red}●%f "');
            if (modules.includes('time')) lines.push('RPROMPT="%F{green}%*%f"');
            lines.push('PROMPT+="%F{magenta}❯%f "');
            lines.push('zstyle ":vcs_info:git:*" formats " %b"');
            lines.push('bindkey "^[[A" history-substring-search-up');
            lines.push('bindkey "^[[B" history-substring-search-down');

            els.configOutput.textContent = lines.join('\n');
        }

        function escapeHtml(str) {
            return str
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;');
        }

        function render() {
            renderPrompt();
            renderHistory();
            renderConfig();
        }

        els.historySearch.addEventListener('input', renderHistory);
        render();
    </script>
</body>
</html>
