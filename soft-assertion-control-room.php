<?php
// Soft Assertion Control Room — a client-side decision simulation.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#17140f">
    <title>Soft Assertion Control Room</title>
    <style>
        :root {
            --ink: #17140f;
            --panel: #252017;
            --panel-2: #332b1e;
            --amber: #f2a72b;
            --amber-bright: #ffd06b;
            --cream: #e9dfc5;
            --muted: #aa9b7d;
            --red: #c43c27;
            --green: #7f9f69;
            --line: rgba(242, 167, 43, .28);
            --shadow: #080706;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--cream);
            background:
                radial-gradient(circle at 50% -12%, rgba(242,167,43,.13), transparent 34rem),
                repeating-linear-gradient(90deg, transparent 0 63px, rgba(255,255,255,.018) 64px),
                #12100c;
            font-family: "Courier New", Courier, monospace;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 20;
            opacity: .15;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.32'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
        }
        button, input { font: inherit; }
        button { touch-action: manipulation; }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1180px;
            margin: auto;
            padding: 18px clamp(18px, 4vw, 44px);
            color: var(--muted);
            font-size: .72rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .topbar a { color: var(--amber-bright); text-decoration: none; }
        .status-dot { display: inline-block; width: 8px; height: 8px; margin-right: 8px; border-radius: 50%; background: var(--green); box-shadow: 0 0 12px var(--green); }

        header {
            position: relative;
            min-height: min(720px, 84vh);
            display: grid;
            place-items: end center;
            overflow: hidden;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
            background: #090806 url('soft-assertion-control-room.webp') center 42% / cover no-repeat;
        }
        header::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(5,5,4,.08) 20%, rgba(10,9,7,.3) 58%, #12100c 100%);
        }
        .hero-copy {
            position: relative;
            z-index: 2;
            width: min(1040px, calc(100% - 36px));
            margin-bottom: clamp(28px, 6vw, 70px);
            text-align: center;
            animation: emerge .9s ease-out both;
        }
        .eyebrow { color: var(--amber); text-transform: uppercase; letter-spacing: .22em; font-size: .72rem; }
        h1, h2, h3 { font-family: Impact, Haettenschweiler, "Franklin Gothic Bold", sans-serif; letter-spacing: .025em; }
        h1 {
            max-width: 900px;
            margin: 10px auto 12px;
            font-size: clamp(2.45rem, 8vw, 6rem);
            line-height: .88;
            text-transform: uppercase;
            text-shadow: 0 4px 0 #171008, 0 0 38px rgba(242,167,43,.28);
        }
        .hero-copy p { max-width: 680px; margin: 0 auto 22px; color: #d6c9ac; line-height: 1.65; font-size: clamp(.9rem, 2vw, 1.05rem); }
        .start-btn, .control-btn, .probe, .restart {
            border: 1px solid #b77819;
            border-radius: 3px;
            color: var(--ink);
            background: linear-gradient(#ffc75d, #d78a16);
            box-shadow: inset 0 1px #ffe6aa, 0 5px 0 #70450d, 0 8px 22px #000;
            padding: 13px 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            cursor: pointer;
            transition: transform .15s, filter .15s;
        }
        button:hover { filter: brightness(1.1); }
        button:active { transform: translateY(3px); box-shadow: inset 0 1px #ffe6aa, 0 2px 0 #70450d; }
        button:focus-visible, a:focus-visible { outline: 3px solid #fff; outline-offset: 3px; }

        main { width: min(1180px, calc(100% - 32px)); margin: 0 auto; }
        .briefing {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            gap: clamp(24px, 6vw, 80px);
            padding: 78px 0;
            align-items: start;
        }
        .briefing h2, .console h2 { margin: 0 0 18px; font-size: clamp(1.9rem, 5vw, 3.4rem); line-height: 1; text-transform: uppercase; }
        .briefing p { line-height: 1.75; color: #c8bda4; }
        .definition { border-left: 4px solid var(--amber); padding-left: 22px; }
        .definition code { color: var(--amber-bright); }
        .rules { display: grid; gap: 12px; counter-reset: rules; }
        .rule { position: relative; padding: 18px 18px 18px 58px; border: 1px solid var(--line); background: rgba(45,38,27,.52); }
        .rule::before { counter-increment: rules; content: "0" counter(rules); position: absolute; left: 18px; color: var(--amber); font-weight: 700; }
        .rule b { display: block; margin-bottom: 4px; color: var(--cream); }
        .rule span { color: var(--muted); font-size: .82rem; line-height: 1.5; }

        .console {
            margin-bottom: 90px;
            border: 1px solid #5e4b2d;
            background: linear-gradient(135deg, rgba(53,44,30,.96), rgba(24,21,16,.98));
            box-shadow: 0 28px 60px #060504, inset 0 0 0 6px #1b1812, inset 0 0 0 7px #5d4b30;
            padding: clamp(20px, 4vw, 42px);
            border-radius: 8px;
        }
        .console-head { display: flex; justify-content: space-between; gap: 20px; align-items: end; border-bottom: 1px solid var(--line); padding-bottom: 20px; }
        .console-head h2 { font-size: clamp(1.6rem, 4vw, 2.5rem); margin: 0; }
        .case-counter { color: var(--amber); font-size: .78rem; letter-spacing: .12em; }
        .progress { height: 5px; background: #0d0c09; margin: 22px 0 28px; overflow: hidden; }
        .progress > i { display: block; height: 100%; width: 20%; background: var(--amber); box-shadow: 0 0 15px var(--amber); transition: width .5s ease; }
        .case-grid { display: grid; grid-template-columns: 1.08fr .92fr; gap: 28px; }
        .crt {
            position: relative;
            min-height: 430px;
            border: 14px solid #12100d;
            border-radius: 28px / 18px;
            padding: clamp(20px, 4vw, 34px);
            overflow: hidden;
            background: radial-gradient(ellipse at center, #34250c 0, #151108 74%);
            box-shadow: inset 0 0 45px #000, 0 0 0 1px #725421;
        }
        .crt::before { content: ""; position: absolute; inset: 0; pointer-events: none; background: repeating-linear-gradient(0deg, transparent 0 3px, rgba(0,0,0,.25) 4px); }
        .severity { display: inline-block; padding: 5px 8px; margin-bottom: 18px; border: 1px solid var(--red); color: #ff765d; font-size: .7rem; letter-spacing: .14em; text-transform: uppercase; animation: blink 1.4s infinite; }
        .crt h3 { position: relative; margin: 0 0 12px; color: var(--amber-bright); font-family: "Courier New", Courier, monospace; font-size: clamp(1.2rem, 3vw, 1.75rem); line-height: 1.25; }
        .assertion { position: relative; display: block; margin: 20px 0; padding: 14px; border: 1px dashed var(--amber); color: var(--amber); background: rgba(242,167,43,.06); overflow-wrap: anywhere; font-size: .86rem; }
        .situation { position: relative; color: #c9b991; line-height: 1.65; font-size: .88rem; }
        .meters { position: relative; display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 24px; }
        .meter { font-size: .63rem; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
        .meter-track { height: 8px; margin-top: 6px; border: 1px solid #6e542b; background: #0c0a07; }
        .meter-track i { display: block; height: 100%; background: var(--amber); transition: width .5s; }

        .diagnostics { display: flex; flex-direction: column; }
        .diagnostics h3 { margin: 0 0 12px; text-transform: uppercase; letter-spacing: .08em; }
        .probe-grid { display: grid; gap: 10px; }
        .probe { position: relative; text-align: left; padding: 14px 14px 14px 42px; color: #d4c7ab; border-color: #5d4a2c; background: #242017; box-shadow: inset 0 1px #473c2a, 0 3px 0 #0b0a07; font-size: .75rem; }
        .probe::before { content: ""; position: absolute; left: 15px; top: 16px; width: 10px; height: 10px; border-radius: 50%; border: 1px solid #77613a; background: #15120d; }
        .probe.open::before { background: var(--green); box-shadow: 0 0 9px var(--green); }
        .probe-detail { display: block; max-height: 0; overflow: hidden; color: var(--amber-bright); line-height: 1.45; opacity: 0; transition: .35s; }
        .probe.open .probe-label { display: none; }
        .probe.open .probe-detail { max-height: 80px; opacity: 1; }
        .decision-label { margin: 26px 0 10px; color: var(--muted); font-size: .68rem; letter-spacing: .14em; text-transform: uppercase; }
        .decisions { display: grid; grid-template-columns: repeat(3, 1fr); gap: 9px; }
        .control-btn { min-height: 70px; padding: 10px 8px; font-size: .68rem; }
        .control-btn small { display: block; margin-top: 3px; font-size: .58rem; font-weight: 500; opacity: .75; }
        .control-btn.abort { color: #ded4bd; border-color: #656052; background: linear-gradient(#4c483f, #2a2823); box-shadow: inset 0 1px #79736a, 0 5px 0 #11100e; }
        .control-btn.contain { background: linear-gradient(#f0bd55, #a86c15); }
        .control-btn.continue { color: #f6dcd7; border-color: #9c2e1e; background: linear-gradient(#c44a34, #7f2519); box-shadow: inset 0 1px #ef8976, 0 5px 0 #40120d; }
        .feedback { display: none; margin-top: 18px; padding: 16px; border-left: 4px solid var(--amber); background: #17140f; color: #cfc2a7; line-height: 1.55; font-size: .8rem; }
        .feedback.show { display: block; animation: emerge .35s both; }
        .next { display: none; align-self: end; margin-top: 14px; }
        .next.show { display: block; }

        .result { display: none; text-align: center; padding: 32px 4px 6px; }
        .result.show { display: block; animation: emerge .6s both; }
        .result-score { font-family: Impact, Haettenschweiler, "Franklin Gothic Bold", sans-serif; color: var(--amber-bright); font-size: clamp(4rem, 13vw, 8rem); line-height: .9; text-shadow: 0 0 30px rgba(242,167,43,.25); }
        .result h2 { margin-top: 12px; }
        .result p { max-width: 680px; margin: 0 auto 24px; color: #c8bda4; line-height: 1.7; }
        .result-stats { display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; margin-bottom: 28px; }
        .result-stats span { border: 1px solid var(--line); padding: 9px 12px; color: var(--amber); font-size: .72rem; }

        .principle { margin: 0 auto 80px; max-width: 850px; text-align: center; }
        .principle blockquote { margin: 0; color: #e2d7bd; font: 700 clamp(1.35rem, 4vw, 2.2rem)/1.45 Georgia, serif; }
        .principle p { color: var(--muted); line-height: 1.7; }
        .principle a { color: var(--amber-bright); }
        footer { border-top: 1px solid var(--line); padding: 28px 20px 44px; text-align: center; color: #786e5b; font-size: .7rem; }
        footer a { color: var(--muted); }

        @keyframes blink { 50% { opacity: .5; } }
        @keyframes emerge { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        @media (max-width: 800px) {
            header { min-height: 670px; background-position: 50% 38%; }
            .briefing, .case-grid { grid-template-columns: 1fr; }
            .briefing { padding: 58px 0; }
            .console { margin-inline: -8px; padding: 20px 14px 28px; }
            .crt { min-height: 390px; border-width: 9px; border-radius: 18px; }
            .console-head { align-items: start; }
        }
        @media (max-width: 480px) {
            .topbar { font-size: .61rem; }
            .topbar span:last-child { display: none; }
            h1 { font-size: 2.75rem; }
            .hero-copy { margin-bottom: 38px; }
            .meters { gap: 6px; }
            .decisions { grid-template-columns: 1fr; }
            .control-btn { min-height: 56px; }
        }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { animation-duration: .01ms !important; transition-duration: .01ms !important; scroll-behavior: auto !important; } }
    </style>
</head>
<body>
    <nav class="topbar" aria-label="Site navigation">
        <a href="./">← Chloe Reads Jon</a>
        <span><i class="status-dot"></i>System nominal · mostly</span>
    </nav>

    <header>
        <div class="hero-copy">
            <div class="eyebrow">Operator training module 04-1222</div>
            <h1>Soft Assertion<br>Control Room</h1>
            <p>The program has reached a state its author swore was impossible. You may stop safely, contain the damage, or pull the red lever and proceed anyway.</p>
            <button class="start-btn" id="start">Assume command</button>
        </div>
    </header>

    <main>
        <section class="briefing" id="briefing">
            <div class="definition">
                <div class="eyebrow">Field doctrine</div>
                <h2>A crash with<br>an escape hatch</h2>
                <p>In 2004, Jon proposed a <strong>soft assertion</strong>: when an internal assumption fails, a power user could choose to risk continuing instead of having the program simply unravel the stack and quit.</p>
                <p>The clever part is not a cheerful “ignore” button. It is giving the operator enough evidence, containment, and reversibility to make an informed choice.</p>
            </div>
            <div class="rules">
                <div class="rule"><b>Probe first</b><span>Each diagnostic reveals information that may change the sane decision.</span></div>
                <div class="rule"><b>Protect data</b><span>A recoverable inconvenience beats silent corruption in a jaunty hat.</span></div>
                <div class="rule"><b>Preserve agency</b><span>Sometimes continuing is exactly right, especially when the operation is reversible.</span></div>
            </div>
        </section>

        <section class="console" id="console" aria-live="polite">
            <div id="game">
                <div class="console-head">
                    <h2>Live incident</h2>
                    <div class="case-counter" id="counter">Case 01 / 05</div>
                </div>
                <div class="progress" aria-hidden="true"><i id="progress"></i></div>
                <div class="case-grid">
                    <div class="crt">
                        <span class="severity" id="severity">Assertion breached</span>
                        <h3 id="title"></h3>
                        <code class="assertion" id="assertion"></code>
                        <p class="situation" id="situation"></p>
                        <div class="meters">
                            <div class="meter">Data risk<div class="meter-track"><i id="dataMeter"></i></div></div>
                            <div class="meter">Recovery<div class="meter-track"><i id="recoveryMeter"></i></div></div>
                            <div class="meter">Urgency<div class="meter-track"><i id="urgencyMeter"></i></div></div>
                        </div>
                    </div>
                    <div class="diagnostics">
                        <h3>Diagnostic bank</h3>
                        <div class="probe-grid" id="probes"></div>
                        <div class="decision-label">Operator decision</div>
                        <div class="decisions">
                            <button class="control-btn abort" data-choice="abort">Abort<small>stop safely</small></button>
                            <button class="control-btn contain" data-choice="contain">Contain<small>snapshot &amp; isolate</small></button>
                            <button class="control-btn continue" data-choice="continue">Continue<small>accept the risk</small></button>
                        </div>
                        <div class="feedback" id="feedback"></div>
                        <button class="start-btn next" id="next">Next incident →</button>
                    </div>
                </div>
            </div>
            <div class="result" id="result">
                <div class="eyebrow">Shift evaluation</div>
                <div class="result-score" id="score">0</div>
                <h2 id="rank">Trainee Operator</h2>
                <p id="summary"></p>
                <div class="result-stats" id="stats"></div>
                <button class="restart" id="restart">Run the console again</button>
            </div>
        </section>

        <section class="principle">
            <blockquote>“The SoftAssertion lets power users at least continue on in the face of programming errors.”</blockquote>
            <p>That tiny 2004 idea anticipates a humane design principle: failures should be legible, choices should be reversible, and software should respect competent users without pretending danger has vanished.</p>
            <p>Inspired by Jon’s <a href="https://jona.ca/2004/12/soft-assertions.html">Soft Assertions</a>.</p>
        </section>
    </main>

    <footer>Original control-room artwork generated for this experiment · <a href="./">Return to the archive</a></footer>

    <script>
        const cases = [
            {
                title: 'Gummibear Containment Breach',
                assertion: 'assert(gummibears.length < 2)',
                situation: 'The snack scheduler has discovered three gummy bears in a two-bear staging tray. A school-lunch packing run is waiting.',
                meters: [12, 95, 68], best: 'continue',
                probes: [
                    ['Inspect side effects', 'No writes have occurred. The tray array exists only in memory.'],
                    ['Check downstream tolerance', 'The lunch container accepts up to twelve gummy bears with suspicious enthusiasm.'],
                    ['Locate rollback point', 'One-click undo is available until the lid closes.']
                ],
                feedback: {
                    abort: 'Safe, but needlessly stern. No persistent data or unsafe downstream state was involved.',
                    contain: 'Perfectly defensible, if slightly overqualified for confectionery. A snapshot buys little here.',
                    continue: 'Correct. The invariant was too strict, the action is reversible, and the downstream system is delighted.'
                }
            },
            {
                title: 'The Unsaved Manuscript',
                assertion: 'assert(document.revision === server.revision)',
                situation: 'A save operation finds that the server copy changed in another tab. Forty-seven minutes of local writing have not been backed up.',
                meters: [88, 44, 82], best: 'contain',
                probes: [
                    ['Compare revisions', 'Both copies changed in different paragraphs. A blind overwrite would erase real work.'],
                    ['Check local recovery', 'A complete local draft can be exported without touching the server.'],
                    ['Inspect merge support', 'The editor can open a conflict view after making a recovery snapshot.']
                ],
                feedback: {
                    abort: 'Stopping avoids an overwrite, but strands the local draft in volatile memory. Safety is not the same as preservation.',
                    contain: 'Correct. Snapshot the local work, isolate both versions, then enter a deliberate merge.',
                    continue: 'The red lever does what red levers do. The server copy is overwritten and someone’s paragraph becomes folklore.'
                }
            },
            {
                title: 'Duplicate Payment Signal',
                assertion: 'assert(idempotencyKey.isUnique)',
                situation: 'A checkout retry arrived after a network timeout. The customer sees no receipt, but the payment gateway state is uncertain.',
                meters: [97, 28, 71], best: 'abort',
                probes: [
                    ['Query gateway ledger', 'The ledger is temporarily unreachable. Charge status cannot be established.'],
                    ['Inspect operation type', 'The command is externally visible and cannot be rolled back locally.'],
                    ['Check retry queue', 'The request can safely pause for reconciliation without losing the cart.']
                ],
                feedback: {
                    abort: 'Correct. When an irreversible external side effect is unknown, stop and reconcile before retrying.',
                    contain: 'Reasonable instinct, but a local snapshot cannot contain a possible second charge at an external gateway.',
                    continue: 'A brave choice in the least flattering sense. The customer may now own the same toaster twice.'
                }
            },
            {
                title: 'Map Tile Beyond the Rim',
                assertion: 'assert(tile.zoom <= renderer.maxZoom)',
                situation: 'A family road-trip map requests one zoom level beyond the renderer’s tested range while the route remains visible underneath.',
                meters: [8, 92, 55], best: 'continue',
                probes: [
                    ['Inspect fallback path', 'Unknown tiles render as a labelled grey square; route geometry is independent.'],
                    ['Check user escape', 'Zooming out immediately returns to the supported range.'],
                    ['Test resource ceiling', 'Memory remains bounded and no network request is repeated.']
                ],
                feedback: {
                    abort: 'Safe, but it discards a useful route because one cosmetic tile may look odd.',
                    contain: 'Not harmful, though isolation adds ceremony without reducing an already tiny, reversible risk.',
                    continue: 'Correct. The fallback is bounded, visible, reversible, and leaves the user in control.'
                }
            },
            {
                title: 'Archive Index Mismatch',
                assertion: 'assert(entries.length === checksums.length)',
                situation: 'A photo archive import has 2,104 files but only 2,103 checksums. The destination already contains years of family history.',
                meters: [83, 73, 48], best: 'contain',
                probes: [
                    ['Find missing checksum', 'One new image lacks a checksum; all existing destination files validate.'],
                    ['Inspect write strategy', 'Import can target a new timestamped directory without mutating the archive.'],
                    ['Check verification pass', 'A full comparison can run before the new directory is promoted.']
                ],
                feedback: {
                    abort: 'Safe, but it gives up despite a clean isolation boundary and a verification path.',
                    contain: 'Correct. Import into quarantine, calculate the missing checksum, verify everything, then promote atomically.',
                    continue: 'Too casual around irreplaceable data. A warning with family photos deserves more than crossed fingers.'
                }
            }
        ];

        let current = 0, score = 0, probesOpened = 0, choices = { abort: 0, contain: 0, continue: 0 }, locked = false;
        const $ = id => document.getElementById(id);

        function renderCase() {
            const c = cases[current];
            locked = false;
            $('counter').textContent = `Case ${String(current + 1).padStart(2, '0')} / 05`;
            $('progress').style.width = `${(current + 1) * 20}%`;
            $('title').textContent = c.title;
            $('assertion').textContent = c.assertion;
            $('situation').textContent = c.situation;
            ['dataMeter', 'recoveryMeter', 'urgencyMeter'].forEach((id, i) => $(id).style.width = c.meters[i] + '%');
            $('feedback').className = 'feedback';
            $('next').className = 'start-btn next';
            document.querySelectorAll('.control-btn').forEach(b => { b.disabled = false; b.style.opacity = '1'; });
            $('probes').innerHTML = c.probes.map((p, i) => `<button class="probe" data-probe="${i}"><span class="probe-label">○ ${p[0]}</span><span class="probe-detail">${p[1]}</span></button>`).join('');
            document.querySelectorAll('.probe').forEach(btn => btn.addEventListener('click', () => {
                if (!btn.classList.contains('open')) probesOpened++;
                btn.classList.toggle('open');
            }));
        }

        document.querySelectorAll('.control-btn').forEach(btn => btn.addEventListener('click', () => {
            if (locked) return;
            locked = true;
            const choice = btn.dataset.choice;
            choices[choice]++;
            const correct = choice === cases[current].best;
            score += correct ? 20 : (choice === 'contain' ? 9 : 3);
            $('feedback').innerHTML = `<strong>${correct ? 'GOOD CALL' : 'CONSEQUENCE'}</strong><br>${cases[current].feedback[choice]}`;
            $('feedback').classList.add('show');
            document.querySelectorAll('.control-btn').forEach(b => { b.disabled = true; b.style.opacity = b === btn ? '1' : '.38'; });
            $('next').textContent = current === cases.length - 1 ? 'File shift report →' : 'Next incident →';
            $('next').classList.add('show');
        }));

        $('next').addEventListener('click', () => {
            current++;
            if (current < cases.length) renderCase(); else showResult();
        });

        function showResult() {
            $('game').style.display = 'none';
            $('result').classList.add('show');
            const probeBonus = Math.min(10, Math.floor(probesOpened / 3) * 2);
            const total = Math.min(100, score + probeBonus);
            $('score').textContent = total;
            let rank, summary;
            if (total >= 90) { rank = 'Senior Escape-Hatch Engineer'; summary = 'You balanced user agency with reversibility, evidence, and an appropriately suspicious attitude toward irreversible side effects. The console trusts you, which is more than it says about most people.'; }
            else if (total >= 70) { rank = 'Calm Incident Operator'; summary = 'You kept the machinery useful without treating every broken assumption as harmless. A few more probes before the lever and you will be terrifyingly competent.'; }
            else { rank = 'Enthusiastic Lever Puller'; summary = 'You made decisions, certainly. The next shift recommends more diagnostics, more snapshots, and perhaps placing a tasteful velvet rope around the red lever.'; }
            $('rank').textContent = rank;
            $('summary').textContent = summary;
            $('stats').innerHTML = `<span>${probesOpened}/15 probes opened</span><span>${choices.abort} aborts</span><span>${choices.contain} contains</span><span>${choices.continue} continues</span>`;
        }

        function reset() {
            current = 0; score = 0; probesOpened = 0; choices = { abort: 0, contain: 0, continue: 0 }; locked = false;
            $('game').style.display = 'block';
            $('result').className = 'result';
            renderCase();
            $('console').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        $('restart').addEventListener('click', reset);
        $('start').addEventListener('click', () => $('console').scrollIntoView({ behavior: 'smooth', block: 'start' }));
        renderCase();
    </script>
</body>
</html>
