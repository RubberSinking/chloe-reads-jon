<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Report Flight Deck</title>
    <style>
        :root {
            --ink: #14213d;
            --sky: #1f6feb;
            --sun: #ffb703;
            --paper: #f8f7f2;
            --mint: #90e0ef;
            --rose: #ef476f;
            --ok: #2a9d8f;
            --warn: #e76f51;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Avenir Next", "Segoe UI", "Trebuchet MS", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 15% 15%, #ffffff 0%, #e9f2ff 35%, transparent 60%),
                radial-gradient(circle at 88% 25%, #fff4cc 0%, #ffe9a8 28%, transparent 58%),
                linear-gradient(130deg, #dce9ff 0%, #eef8ff 52%, #fffaf0 100%);
            min-height: 100vh;
        }

        .wrap {
            width: min(1000px, 92vw);
            margin: 28px auto 40px;
        }

        .hero {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(20, 33, 61, 0.12);
            border-radius: 20px;
            padding: 22px 20px;
            box-shadow: 0 14px 32px rgba(20, 33, 61, 0.15);
        }

        h1 {
            margin: 0;
            font-size: clamp(1.7rem, 3.6vw, 2.9rem);
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .subtitle {
            margin: 10px 0 0;
            max-width: 72ch;
            line-height: 1.5;
            font-size: 1rem;
        }

        .grid {
            margin-top: 18px;
            display: grid;
            gap: 14px;
            grid-template-columns: 1.1fr 0.9fr;
        }

        .panel {
            background: var(--paper);
            border: 1px solid rgba(20, 33, 61, 0.15);
            border-radius: 16px;
            padding: 14px;
        }

        label {
            display: block;
            font-size: 0.85rem;
            margin: 0 0 6px;
            letter-spacing: 0.02em;
            font-weight: 600;
        }

        input, textarea, select {
            width: 100%;
            border: 1px solid rgba(20, 33, 61, 0.22);
            border-radius: 10px;
            padding: 10px 11px;
            font: inherit;
            background: #fff;
        }

        textarea { min-height: 72px; resize: vertical; }

        .row { display: grid; gap: 10px; grid-template-columns: 1fr 1fr; }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            border: 1px solid rgba(20, 33, 61, 0.2);
            background: #fff;
            border-radius: 999px;
            padding: 7px 10px;
            font-size: 0.82rem;
            cursor: pointer;
            user-select: none;
        }

        .chip.active {
            border-color: var(--sky);
            background: #e5f0ff;
            color: #0c3f91;
            box-shadow: 0 0 0 2px rgba(31, 111, 235, 0.13);
        }

        .btnbar { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px; }

        button {
            border: none;
            border-radius: 10px;
            padding: 10px 14px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 120ms ease, filter 120ms ease;
        }

        button:hover { transform: translateY(-1px); filter: brightness(1.04); }

        .primary { background: var(--sky); color: #fff; }
        .ghost { background: #ecf4ff; color: #15418f; }

        .score {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .card {
            border: 1px solid rgba(20, 33, 61, 0.16);
            border-radius: 12px;
            background: #fff;
            padding: 11px;
        }

        .meter {
            height: 12px;
            background: #edf0f5;
            border-radius: 999px;
            overflow: hidden;
            margin-top: 7px;
        }

        .meter > span {
            display: block;
            height: 100%;
            width: 0;
            transition: width 280ms ease;
            background: linear-gradient(90deg, var(--warn), var(--sun), var(--ok));
        }

        .status {
            margin-top: 10px;
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
            background: #effaf7;
            border: 1px solid rgba(42, 157, 143, 0.3);
            color: #155b53;
        }

        .output {
            margin-top: 10px;
            background: #0f172a;
            color: #cfe6ff;
            border-radius: 12px;
            padding: 12px;
            font-family: "Courier New", Courier, monospace;
            font-size: 0.84rem;
            white-space: pre-wrap;
            min-height: 130px;
            border: 1px solid rgba(144, 224, 239, 0.2);
        }

        .mini {
            margin-top: 10px;
            border-top: 1px dashed rgba(20, 33, 61, 0.2);
            padding-top: 10px;
        }

        .choice {
            display: block;
            width: 100%;
            text-align: left;
            margin-bottom: 8px;
            background: #ffffff;
            border: 1px solid rgba(20, 33, 61, 0.2);
            color: var(--ink);
        }

        .choice.good { border-color: rgba(42, 157, 143, 0.55); background: #ecf9f6; }
        .choice.bad { border-color: rgba(239, 71, 111, 0.45); background: #fff1f4; }

        .mono { font-family: "Courier New", Courier, monospace; }

        @media (max-width: 820px) {
            .grid { grid-template-columns: 1fr; }
            .score { grid-template-columns: 1fr; }
            .row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="wrap">
    <section class="hero">
        <h1>Bug Report Flight Deck</h1>
        <p class="subtitle">A playful debugging cockpit based on one ruthless rule: if you give a solid URL and the exact symptom, investigation starts immediately. Build a high-signal bug report and train on quick triage choices.</p>
    </section>

    <section class="grid">
        <form class="panel" id="reportForm" autocomplete="off">
            <div class="row">
                <div>
                    <label for="url">Affected URL</label>
                    <input id="url" placeholder="/checkout/cart.php?step=confirm" />
                </div>
                <div>
                    <label for="symptom">Error Message / Symptom</label>
                    <input id="symptom" placeholder=""Add payment method" button does nothing" />
                </div>
            </div>

            <div class="row" style="margin-top:10px;">
                <div>
                    <label for="steps">Repro Steps</label>
                    <textarea id="steps" placeholder="1) Open cart ...\n2) Click ...\n3) Observe ..."></textarea>
                </div>
                <div>
                    <label for="expected">Expected vs Actual</label>
                    <textarea id="expected" placeholder="Expected: ...\nActual: ..."></textarea>
                </div>
            </div>

            <div class="row" style="margin-top:10px;">
                <div>
                    <label for="severity">Impact</label>
                    <select id="severity">
                        <option value="low">Low (annoying)</option>
                        <option value="medium" selected>Medium (workflow disruption)</option>
                        <option value="high">High (core flow broken)</option>
                        <option value="critical">Critical (data loss/revenue risk)</option>
                    </select>
                </div>
                <div>
                    <label for="environment">Environment</label>
                    <input id="environment" placeholder="Chrome 138 / macOS 15 / prod" />
                </div>
            </div>

            <div style="margin-top:10px;">
                <label>Signals Included</label>
                <div class="chips" id="signals">
                    <button type="button" class="chip" data-signal="screenshot">Screenshot</button>
                    <button type="button" class="chip" data-signal="console">Console Log</button>
                    <button type="button" class="chip" data-signal="network">Network Trace</button>
                    <button type="button" class="chip" data-signal="rollback">Regression Window</button>
                    <button type="button" class="chip" data-signal="user-impact">User Count Estimate</button>
                </div>
            </div>

            <div class="btnbar">
                <button class="primary" type="submit">Generate Investigation Brief</button>
                <button class="ghost" type="button" id="sampleBtn">Load Sample Bug</button>
                <button class="ghost" type="button" id="resetBtn">Reset</button>
            </div>
        </form>

        <aside class="panel">
            <div class="score">
                <div class="card">
                    <strong>Clarity Score</strong>
                    <div class="meter"><span id="clarityMeter"></span></div>
                    <div id="clarityText" class="mono" style="margin-top:7px;">0 / 100</div>
                </div>
                <div class="card">
                    <strong>Debug Velocity</strong>
                    <div class="meter"><span id="velocityMeter"></span></div>
                    <div id="velocityText" class="mono" style="margin-top:7px;">Waiting for signal...</div>
                </div>
            </div>

            <div class="status" id="statusLine">Ready for takeoff. Feed me a real bug report.</div>
            <div class="output" id="outputBox">// Investigation brief will appear here</div>

            <div class="mini">
                <strong>Triage Drill</strong>
                <p style="margin:6px 0 8px; font-size:0.9rem;">Choose the most useful first response to the incoming report.</p>
                <div id="drillPrompt" class="mono" style="font-size:0.82rem; margin-bottom:8px;"></div>
                <button class="choice" data-kind="a"></button>
                <button class="choice" data-kind="b"></button>
                <button class="choice" data-kind="c"></button>
                <div id="drillFeedback" style="font-size:0.86rem; min-height:1.2em; margin-top:6px;"></div>
            </div>
        </aside>
    </section>
</div>

<script>
(() => {
    const form = document.getElementById('reportForm');
    const outputBox = document.getElementById('outputBox');
    const statusLine = document.getElementById('statusLine');
    const clarityMeter = document.getElementById('clarityMeter');
    const velocityMeter = document.getElementById('velocityMeter');
    const clarityText = document.getElementById('clarityText');
    const velocityText = document.getElementById('velocityText');
    const sampleBtn = document.getElementById('sampleBtn');
    const resetBtn = document.getElementById('resetBtn');

    const fields = {
        url: document.getElementById('url'),
        symptom: document.getElementById('symptom'),
        steps: document.getElementById('steps'),
        expected: document.getElementById('expected'),
        severity: document.getElementById('severity'),
        environment: document.getElementById('environment')
    };

    const chips = [...document.querySelectorAll('.chip')];
    const signalSet = new Set();

    chips.forEach(chip => chip.addEventListener('click', () => {
        const key = chip.dataset.signal;
        if (signalSet.has(key)) {
            signalSet.delete(key);
            chip.classList.remove('active');
        } else {
            signalSet.add(key);
            chip.classList.add('active');
        }
    }));

    function scoreReport(data) {
        let score = 0;
        if (data.url.trim().length > 5) score += 25;
        if (data.symptom.trim().length > 10) score += 25;
        if (data.steps.trim().split('\n').length >= 2) score += 12;
        if (/expected/i.test(data.expected) && /actual/i.test(data.expected)) score += 12;
        if (data.environment.trim().length > 6) score += 10;
        score += Math.min(16, signalSet.size * 4);

        if (data.severity === 'high') score += 2;
        if (data.severity === 'critical') score += 4;

        return Math.min(100, score);
    }

    function velocityLabel(score) {
        if (score >= 85) return 'High: can start reproducing now';
        if (score >= 65) return 'Medium: 1-2 clarifying questions needed';
        if (score >= 40) return 'Low: significant ambiguity remains';
        return 'Stalled: not enough actionable detail';
    }

    function buildBrief(data, score) {
        const topSignals = [...signalSet];
        const blockers = [];
        if (!data.url.trim()) blockers.push('Missing URL');
        if (!data.symptom.trim()) blockers.push('Missing error/symptom statement');
        if (!data.steps.trim()) blockers.push('Missing reproduction steps');

        return [
            '=== BUG REPORT INVESTIGATION BRIEF ===',
            `Impact: ${data.severity.toUpperCase()}`,
            `Clarity Score: ${score}/100`,
            '',
            '[Primary Inputs]',
            `URL: ${data.url || '(not provided)'}`,
            `Symptom: ${data.symptom || '(not provided)'}`,
            `Environment: ${data.environment || '(not provided)'}`,
            '',
            '[Repro Plan]',
            data.steps || '(none yet)',
            '',
            '[Expected vs Actual]',
            data.expected || '(none yet)',
            '',
            `[Signal Pack: ${topSignals.length ? topSignals.join(', ') : 'none'}]`,
            '',
            blockers.length
                ? `[Blocking Gaps] ${blockers.join(' | ')}`
                : '[Blocking Gaps] none',
            blockers.length
                ? 'Next move: ask focused clarifying questions.'
                : 'Next move: reproduce issue and isolate failing step.'
        ].join('\n');
    }

    function render(score, data) {
        clarityMeter.style.width = `${score}%`;
        const velocity = Math.min(100, Math.round(score * 0.92 + signalSet.size * 3));
        velocityMeter.style.width = `${velocity}%`;

        clarityText.textContent = `${score} / 100`;
        velocityText.textContent = velocityLabel(score);

        const brief = buildBrief(data, score);
        outputBox.textContent = brief;

        if (score >= 85) {
            statusLine.textContent = 'Excellent report. This is the kind of bug ticket engineers love.';
            statusLine.style.background = '#ecf9f6';
            statusLine.style.borderColor = 'rgba(42,157,143,0.35)';
            statusLine.style.color = '#155b53';
        } else if (score >= 60) {
            statusLine.textContent = 'Good signal. Tighten one or two details and this becomes high-velocity.';
            statusLine.style.background = '#fff8e8';
            statusLine.style.borderColor = 'rgba(255,183,3,0.4)';
            statusLine.style.color = '#7a5300';
        } else {
            statusLine.textContent = 'Needs sharpening. Start with URL + exact symptom, then add repro steps.';
            statusLine.style.background = '#fff0f3';
            statusLine.style.borderColor = 'rgba(239,71,111,0.35)';
            statusLine.style.color = '#8d1e3b';
        }
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const data = {
            url: fields.url.value,
            symptom: fields.symptom.value,
            steps: fields.steps.value,
            expected: fields.expected.value,
            severity: fields.severity.value,
            environment: fields.environment.value
        };

        const score = scoreReport(data);
        render(score, data);
    });

    sampleBtn.addEventListener('click', () => {
        fields.url.value = '/checkout/cart.php?step=confirm';
        fields.symptom.value = 'Clicking "Place Order" spins for 2s then silently returns to cart';
        fields.steps.value = '1) Add any item\n2) Proceed to checkout\n3) Select saved Visa\n4) Click Place Order\n5) Observe cart reload';
        fields.expected.value = 'Expected: Order confirmation page appears with order ID.\nActual: Cart page reloads, no order placed, no toast error.';
        fields.severity.value = 'critical';
        fields.environment.value = 'Chrome 138 / macOS 15.1 / production';

        signalSet.clear();
        chips.forEach(chip => chip.classList.remove('active'));
        ['console', 'network', 'user-impact'].forEach(k => {
            const chip = chips.find(c => c.dataset.signal === k);
            if (chip) {
                signalSet.add(k);
                chip.classList.add('active');
            }
        });

        const data = {
            url: fields.url.value,
            symptom: fields.symptom.value,
            steps: fields.steps.value,
            expected: fields.expected.value,
            severity: fields.severity.value,
            environment: fields.environment.value
        };
        render(scoreReport(data), data);
    });

    resetBtn.addEventListener('click', () => {
        form.reset();
        signalSet.clear();
        chips.forEach(chip => chip.classList.remove('active'));
        clarityMeter.style.width = '0%';
        velocityMeter.style.width = '0%';
        clarityText.textContent = '0 / 100';
        velocityText.textContent = 'Waiting for signal...';
        outputBox.textContent = '// Investigation brief will appear here';
        statusLine.textContent = 'Ready for takeoff. Feed me a real bug report.';
        statusLine.style.background = '#effaf7';
        statusLine.style.borderColor = 'rgba(42, 157, 143, 0.3)';
        statusLine.style.color = '#155b53';
    });

    const drills = [
        {
            prompt: '"The login is broken on the website."',
            choices: {
                a: 'Ask for URL and exact error/symptom first',
                b: 'Guess it is a backend auth outage',
                c: 'Ask them to reboot their laptop'
            },
            correct: 'a',
            why: 'Start with the concrete location and symptom before guessing causes.'
        },
        {
            prompt: '"The export button fails for me."',
            choices: {
                a: 'Deploy a rollback immediately',
                b: 'Ask for repro steps and environment details',
                c: 'Close as cannot reproduce'
            },
            correct: 'b',
            why: 'Repro steps + environment are fastest path to isolation.'
        },
        {
            prompt: '"Checkout hangs sometimes."',
            choices: {
                a: 'Request one screenshot and move on',
                b: 'Ask for URL, exact symptom, and network trace',
                c: 'Tell support to reassure the customer only'
            },
            correct: 'b',
            why: 'Intermittent critical flows need high-signal telemetry immediately.'
        }
    ];

    const drillPrompt = document.getElementById('drillPrompt');
    const drillFeedback = document.getElementById('drillFeedback');
    const drillButtons = [...document.querySelectorAll('.choice')];
    let current = 0;

    function paintDrill() {
        const d = drills[current];
        drillPrompt.textContent = d.prompt;
        drillFeedback.textContent = '';
        drillButtons.forEach(btn => {
            btn.classList.remove('good', 'bad');
            btn.textContent = d.choices[btn.dataset.kind];
        });
    }

    drillButtons.forEach(btn => btn.addEventListener('click', () => {
        const d = drills[current];
        drillButtons.forEach(b => b.classList.remove('good', 'bad'));
        if (btn.dataset.kind === d.correct) {
            btn.classList.add('good');
            drillFeedback.textContent = `Correct. ${d.why}`;
        } else {
            btn.classList.add('bad');
            const winner = drillButtons.find(b => b.dataset.kind === d.correct);
            if (winner) winner.classList.add('good');
            drillFeedback.textContent = `Best answer: ${d.choices[d.correct]}. ${d.why}`;
        }
        current = (current + 1) % drills.length;
        setTimeout(paintDrill, 1300);
    }));

    paintDrill();
})();
</script>
</body>
</html>
