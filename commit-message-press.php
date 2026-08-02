<?php
// Self-contained by design: the press runs entirely in the browser.
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#162421">
    <title>The Commit Message Press</title>
    <style>
        :root {
            --ink: #14231f;
            --paper: #f1e7cf;
            --paper-deep: #dfcfaa;
            --red: #d6472f;
            --red-dark: #8f2e20;
            --mint: #a9cbb7;
            --brass: #dbad55;
            --cream: #fff8e8;
            --shadow: #09110f;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 8%, rgba(169,203,183,.18), transparent 27rem),
                linear-gradient(rgba(255,255,255,.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px),
                #162421;
            background-size: auto, 24px 24px, 24px 24px, auto;
            font-family: Georgia, "Times New Roman", serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .28;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 180 180' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.12'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            z-index: 20;
        }

        a { color: inherit; }
        button, input, textarea { font: inherit; }

        .masthead {
            max-width: 1180px;
            margin: 0 auto;
            padding: 24px clamp(18px, 4vw, 48px) 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            color: var(--paper);
            font-family: "Courier New", monospace;
            font-size: .72rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .back { text-decoration: none; border-bottom: 1px solid rgba(241,231,207,.45); }
        .edition { color: var(--mint); text-align: right; }

        main { max-width: 1180px; margin: 0 auto; padding: 14px clamp(18px, 4vw, 48px) 70px; }

        .hero {
            color: var(--paper);
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(230px, .55fr);
            align-items: end;
            gap: clamp(30px, 6vw, 80px);
            padding: 42px 0 58px;
        }

        .kicker {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0 0 20px;
            color: var(--brass);
            font-family: "Courier New", monospace;
            font-size: .76rem;
            font-weight: bold;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .kicker::before { content: ""; width: 42px; height: 3px; background: var(--red); }

        h1 {
            max-width: 760px;
            margin: 0;
            font-size: clamp(3.3rem, 9vw, 7.8rem);
            font-weight: 900;
            line-height: .77;
            letter-spacing: -.075em;
        }

        h1 span { display: block; color: var(--red); font-style: italic; padding-left: .55em; }

        .hero-copy {
            margin: 0 0 5px;
            padding: 22px 0 0 24px;
            border-left: 3px solid var(--mint);
            color: #cbd7cf;
            font-size: clamp(1rem, 1.7vw, 1.23rem);
            line-height: 1.55;
        }

        .press {
            position: relative;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(300px, .95fr);
            min-height: 650px;
            border: 1px solid #080e0d;
            border-radius: 7px;
            overflow: hidden;
            box-shadow: 0 34px 80px rgba(0,0,0,.42), 0 3px 0 #070d0b;
        }

        .controls {
            padding: clamp(24px, 4vw, 48px);
            background:
                linear-gradient(90deg, transparent 49.8%, rgba(20,35,31,.05) 50%, transparent 50.2%),
                var(--paper);
            background-size: 40px 100%, auto;
        }

        .section-head { display: flex; justify-content: space-between; align-items: start; gap: 18px; margin-bottom: 28px; }
        h2 { margin: 0; font-size: clamp(1.65rem, 3vw, 2.55rem); line-height: .95; letter-spacing: -.045em; }

        .specimen {
            flex: 0 0 auto;
            color: var(--red-dark);
            font-family: "Courier New", monospace;
            font-size: .66rem;
            font-weight: bold;
            letter-spacing: .12em;
            text-align: right;
            text-transform: uppercase;
            transform: rotate(2deg);
        }

        .row { display: grid; grid-template-columns: 135px 1fr; gap: 20px; margin-bottom: 18px; }

        label {
            padding-top: 12px;
            font-family: "Courier New", monospace;
            font-size: .72rem;
            font-weight: bold;
            letter-spacing: .09em;
            line-height: 1.2;
            text-transform: uppercase;
        }

        label span { display: block; margin-top: 6px; color: #776e5b; font-size: .63rem; font-weight: normal; letter-spacing: 0; text-transform: none; }

        input, textarea {
            width: 100%;
            border: 0;
            border-bottom: 2px solid var(--ink);
            border-radius: 0;
            padding: 10px 3px 9px;
            outline: none;
            color: var(--ink);
            background: rgba(255,255,255,.22);
            font-family: "Courier New", monospace;
            font-size: .92rem;
            line-height: 1.45;
            transition: background .2s, box-shadow .2s;
            resize: vertical;
        }

        input:focus, textarea:focus { background: var(--cream); box-shadow: 0 4px 0 rgba(214,71,47,.22); border-color: var(--red); }
        textarea { min-height: 72px; }
        #summary { font-weight: bold; }

        .action-row { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 30px; padding-top: 24px; border-top: 1px dashed #8e8269; }

        .btn {
            cursor: pointer;
            border: 2px solid var(--ink);
            border-radius: 2px;
            padding: 12px 16px;
            color: var(--ink);
            background: transparent;
            box-shadow: 3px 3px 0 var(--ink);
            font-family: "Courier New", monospace;
            font-size: .73rem;
            font-weight: bold;
            letter-spacing: .07em;
            text-transform: uppercase;
            transition: transform .13s, box-shadow .13s, background .13s;
        }

        .btn:hover { background: var(--cream); transform: translate(-1px,-1px); box-shadow: 5px 5px 0 var(--ink); }
        .btn:active { transform: translate(3px,3px); box-shadow: 0 0 0 var(--ink); }
        .btn.primary { color: var(--cream); background: var(--red); border-color: var(--red-dark); box-shadow: 3px 3px 0 var(--red-dark); }
        .btn.primary:hover { background: #ed543a; }

        .output {
            position: relative;
            padding: clamp(24px, 4vw, 46px);
            color: #e7efea;
            background:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                #0d1714;
            background-size: 100% 28px, auto;
            overflow: hidden;
        }

        .output::after {
            content: "";
            position: absolute;
            top: 0; bottom: 0; left: 10px;
            width: 5px;
            background: repeating-linear-gradient(to bottom, var(--brass) 0 5px, transparent 5px 12px);
            opacity: .55;
        }

        .meter-wrap { display: grid; grid-template-columns: 1fr 86px; align-items: center; gap: 18px; margin: 26px 0 32px; }
        .meter { height: 10px; overflow: hidden; border: 1px solid #75847c; background: #07100d; }
        .meter-fill { width: 20%; height: 100%; background: linear-gradient(90deg, var(--red), var(--brass), var(--mint)); transition: width .55s cubic-bezier(.2,.8,.2,1); }
        .score { color: var(--brass); font-family: "Courier New", monospace; font-size: .72rem; text-align: right; text-transform: uppercase; }
        .score strong { display: block; color: var(--cream); font-size: 1.45rem; }

        .ticket {
            position: relative;
            min-height: 350px;
            padding: 26px 24px 30px;
            color: #1c241f;
            background: var(--cream);
            box-shadow: 10px 13px 0 #25312d, 0 20px 50px rgba(0,0,0,.25);
            transform: rotate(-.45deg);
            transition: transform .35s;
        }

        .ticket.printing { animation: print .62s cubic-bezier(.2,.9,.2,1); }
        @keyframes print { 0% { transform: translateY(-70px) rotate(-.45deg); opacity: .2; } 65% { transform: translateY(5px) rotate(.5deg); } 100% { transform: translateY(0) rotate(-.45deg); opacity: 1; } }

        .holes { position: absolute; inset: 0 auto 0 -6px; width: 12px; background: radial-gradient(circle, #0d1714 0 4px, transparent 4.5px) center top / 12px 22px repeat-y; }
        .ticket-id { display: flex; justify-content: space-between; gap: 10px; padding-bottom: 13px; border-bottom: 3px double #8f8a78; color: var(--red-dark); font: bold .66rem/1.2 "Courier New", monospace; letter-spacing: .08em; text-transform: uppercase; }
        pre { margin: 22px 0 0; white-space: pre-wrap; overflow-wrap: anywhere; font: .82rem/1.58 "Courier New", monospace; }
        .ghost { color: #858070; font-style: italic; }

        .diagnosis { margin: 25px 0 0; padding: 0; list-style: none; font: .71rem/1.45 "Courier New", monospace; }
        .diagnosis li { margin-top: 7px; padding-left: 18px; position: relative; }
        .diagnosis li::before { content: "+"; position: absolute; left: 0; color: var(--mint); font-weight: bold; }
        .diagnosis li.warn::before { content: "!"; color: var(--brass); }

        .inspiration {
            max-width: 760px;
            margin: 48px auto 0;
            color: #bac9c0;
            text-align: center;
            font-size: .9rem;
            line-height: 1.6;
        }
        .inspiration a { color: var(--paper); text-underline-offset: 4px; }

        .toast {
            position: fixed;
            left: 50%; bottom: 24px;
            z-index: 30;
            padding: 11px 17px;
            color: var(--ink);
            background: var(--mint);
            border: 2px solid var(--ink);
            box-shadow: 4px 4px 0 var(--ink);
            font: bold .74rem "Courier New", monospace;
            letter-spacing: .06em;
            text-transform: uppercase;
            transform: translate(-50%, 130px);
            transition: transform .3s cubic-bezier(.2,.8,.2,1);
        }
        .toast.show { transform: translate(-50%, 0); }

        @media (max-width: 820px) {
            .hero { grid-template-columns: 1fr; padding-top: 32px; }
            .hero-copy { max-width: 540px; }
            .press { grid-template-columns: 1fr; }
            .output { min-height: 570px; }
        }

        @media (max-width: 560px) {
            .masthead { align-items: flex-start; }
            h1 { font-size: clamp(3.4rem, 19vw, 5.2rem); }
            .hero { padding-bottom: 38px; }
            .row { grid-template-columns: 1fr; gap: 3px; margin-bottom: 20px; }
            label { padding-top: 0; }
            label span { display: inline; margin-left: 5px; }
            .controls, .output { padding: 28px 22px; }
            .section-head { margin-bottom: 25px; }
            .specimen { display: none; }
            .ticket { padding: 22px 18px 26px; }
            pre { font-size: .76rem; }
            .btn { flex: 1 1 auto; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <nav class="masthead" aria-label="Page navigation">
        <a class="back" href="./">← Chloe Reads Jon</a>
        <span class="edition">Issue Context Works<br>No. 2014–02</span>
    </nav>

    <main>
        <header class="hero">
            <div>
                <p class="kicker">A small factory for useful history</p>
                <h1>Commit <span>Message</span> Press</h1>
            </div>
            <p class="hero-copy">Future you has opened <code>git log</code> at 4:47 p.m. Give that poor soul the <em>why</em>, not merely the wreckage.</p>
        </header>

        <section class="press" aria-label="Commit message composer">
            <div class="controls">
                <div class="section-head">
                    <h2>Set the type.</h2>
                    <div class="specimen">Form CM–4<br>Revision 1.0</div>
                </div>

                <div class="row">
                    <label for="ticket">Ticket <span>optional</span></label>
                    <input id="ticket" maxlength="24" placeholder="e.g. WEB-184" autocomplete="off">
                </div>
                <div class="row">
                    <label for="summary">Summary <span>imperative voice</span></label>
                    <input id="summary" maxlength="72" placeholder="Redirect old email settings link" autocomplete="off">
                </div>
                <div class="row">
                    <label for="problem">Problem <span>what hurt?</span></label>
                    <textarea id="problem" placeholder="The digest still points to a route removed during the migration."></textarea>
                </div>
                <div class="row">
                    <label for="solution">Solution <span>what changed?</span></label>
                    <textarea id="solution" placeholder="Redirect the old route to the new email settings page."></textarea>
                </div>
                <div class="row">
                    <label for="effects">Side effects <span>what else moves?</span></label>
                    <textarea id="effects" placeholder="The old route now returns 302 instead of 404."></textarea>
                </div>

                <div class="action-row">
                    <button class="btn primary" id="print" type="button">Pull the press</button>
                    <button class="btn" id="example" type="button">Load odd example</button>
                    <button class="btn" id="clear" type="button">Clear type</button>
                </div>
            </div>

            <aside class="output" aria-live="polite">
                <div class="section-head">
                    <h2>Proof sheet.</h2>
                    <div class="specimen" style="color:var(--mint)">Archive<br>Quality</div>
                </div>

                <div class="meter-wrap">
                    <div class="meter" aria-hidden="true"><div class="meter-fill" id="meter"></div></div>
                    <div class="score"><strong id="score">20</strong> context</div>
                </div>

                <div class="ticket" id="proof">
                    <span class="holes" aria-hidden="true"></span>
                    <div class="ticket-id"><span>Commit proof</span><span id="serial">0001</span></div>
                    <pre id="preview"><span class="ghost">Your durable little explanation will emerge here.</span></pre>
                </div>

                <ul class="diagnosis" id="diagnosis">
                    <li class="warn">Add a summary to start the press.</li>
                    <li class="warn">Name the problem so the solution has a reason.</li>
                </ul>
                <div class="action-row">
                    <button class="btn" id="copy" type="button">Copy proof</button>
                </div>
            </aside>
        </section>

        <p class="inspiration">Inspired by Jon’s <a href="https://jona.ca/2014/02/how-i-am-writing-commit-messages-now.html" target="_blank" rel="noopener">“How I am writing commit messages now”</a>, a 2014 experiment in saving the why and the how for whoever investigates later.</p>
    </main>

    <div class="toast" id="toast" role="status">Proof copied to clipboard</div>

    <script>
        (() => {
            const ids = ['ticket', 'summary', 'problem', 'solution', 'effects'];
            const fields = Object.fromEntries(ids.map(id => [id, document.getElementById(id)]));
            const preview = document.getElementById('preview');
            const meter = document.getElementById('meter');
            const score = document.getElementById('score');
            const diagnosis = document.getElementById('diagnosis');
            const proof = document.getElementById('proof');
            const serial = document.getElementById('serial');
            const toast = document.getElementById('toast');
            let proofText = '';

            const examples = [
                {
                    ticket: 'VAN-1982', summary: 'Keep KITT\'s scanner alive while parked',
                    problem: 'The scanner goes dark with the ignition, making an otherwise excellent talking car look suspiciously ordinary.',
                    solution: 'Run the scanner controller from the accessory circuit and preserve the startup sweep.',
                    effects: 'One more glowing red object may attract neighbourhood children and international criminals.'
                },
                {
                    ticket: 'HYR-007', summary: 'Stop pots from breaking on gentle landings',
                    problem: 'Ceramic inventory is lost whenever Link sets a pot down with perfectly reasonable enthusiasm.',
                    solution: 'Apply impact damage only above the new velocity threshold.',
                    effects: 'Quiet pottery placement is now possible, though still emotionally unlikely.'
                },
                {
                    ticket: 'LAB-042', summary: 'Teach the deploy button basic manners',
                    problem: 'A second tap during deployment begins another release and alarms everyone in three time zones.',
                    solution: 'Disable the control until the active deployment finishes or fails.',
                    effects: 'Impatient tapping now produces no infrastructure, only self-knowledge.'
                }
            ];
            let exampleIndex = 0;

            function clean(value) { return value.trim().replace(/\s+/g, ' '); }

            function compose() {
                const v = Object.fromEntries(ids.map(id => [id, clean(fields[id].value)]));
                const head = `${v.ticket ? `[${v.ticket.toUpperCase()}] ` : ''}${v.summary}`.trim();
                const parts = [];
                if (head) parts.push(head);
                if (v.problem) parts.push(`Problem: ${v.problem}`);
                if (v.solution) parts.push(`Solution: ${v.solution}`);
                if (v.effects) parts.push(`Side effects: ${v.effects}`);
                proofText = parts.join('\n\n');

                if (proofText) preview.textContent = proofText;
                else preview.innerHTML = '<span class="ghost">Your durable little explanation will emerge here.</span>';

                let points = 0;
                if (v.summary) points += 25;
                if (v.problem) points += 25;
                if (v.solution) points += 25;
                if (v.effects) points += 15;
                if (v.ticket) points += 5;
                if (v.summary && v.summary.length <= 60) points += 5;
                score.textContent = points;
                meter.style.width = `${Math.max(4, points)}%`;

                const notes = [];
                if (!v.summary) notes.push(['warn', 'Add a summary to give the change a name.']);
                else if (v.summary.length > 60) notes.push(['warn', 'The summary is over 60 characters; sharpen the headline.']);
                else notes.push(['', 'Summary fits comfortably in a log view.']);
                if (!v.problem) notes.push(['warn', 'Name the problem so the solution has a reason.']);
                else notes.push(['', 'The future investigator gets the missing why.']);
                if (!v.solution) notes.push(['warn', 'Record the mechanism, not just the intention.']);
                if (!v.effects) notes.push(['warn', 'No side effects listed. “None known” is useful too.']);
                if (points >= 90) notes.push(['', 'Archive grade: this one can survive team folklore.']);
                diagnosis.innerHTML = notes.map(([kind, text]) => `<li class="${kind}">${text}</li>`).join('');
                localStorage.setItem('commitPressDraft', JSON.stringify(v));
            }

            function animateProof() {
                compose();
                proof.classList.remove('printing');
                void proof.offsetWidth;
                proof.classList.add('printing');
                serial.textContent = String(Math.floor(Date.now() / 1000)).slice(-4);
                if (window.innerWidth < 821) proof.scrollIntoView({behavior: 'smooth', block: 'center'});
            }

            function showToast(message) {
                toast.textContent = message;
                toast.classList.add('show');
                window.clearTimeout(showToast.timer);
                showToast.timer = window.setTimeout(() => toast.classList.remove('show'), 2100);
            }

            ids.forEach(id => fields[id].addEventListener('input', compose));
            document.getElementById('print').addEventListener('click', animateProof);
            document.getElementById('example').addEventListener('click', () => {
                const data = examples[exampleIndex++ % examples.length];
                ids.forEach(id => fields[id].value = data[id]);
                animateProof();
            });
            document.getElementById('clear').addEventListener('click', () => {
                ids.forEach(id => fields[id].value = '');
                localStorage.removeItem('commitPressDraft');
                compose();
                fields.summary.focus();
            });
            document.getElementById('copy').addEventListener('click', async () => {
                if (!proofText) { showToast('Nothing set in type yet'); return; }
                try { await navigator.clipboard.writeText(proofText); showToast('Proof copied to clipboard'); }
                catch (_) {
                    const area = document.createElement('textarea');
                    area.value = proofText; document.body.appendChild(area); area.select();
                    document.execCommand('copy'); area.remove(); showToast('Proof copied to clipboard');
                }
            });

            try {
                const saved = JSON.parse(localStorage.getItem('commitPressDraft') || 'null');
                if (saved) ids.forEach(id => fields[id].value = saved[id] || '');
            } catch (_) {}
            compose();
        })();
    </script>
</body>
</html>
