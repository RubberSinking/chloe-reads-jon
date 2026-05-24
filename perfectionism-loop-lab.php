<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfectionism Loop Lab</title>
    <style>
        :root {
            --paper: #f5efe2;
            --ink: #1f2a3d;
            --muted: #5f6a7f;
            --accent: #d97706;
            --accent-soft: #f6b34b;
            --panel: #fffbf3;
            --line: #dbcdae;
            --good: #1f9d6b;
            --alert: #d64545;
            --shadow: rgba(42, 34, 18, 0.18);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Trebuchet MS", "Verdana", sans-serif;
            background:
                radial-gradient(circle at 20% 20%, #fff8ea 0 16%, transparent 30%),
                radial-gradient(circle at 80% 70%, #f2e7cf 0 14%, transparent 34%),
                linear-gradient(160deg, #ede3ce 0%, #f7f2e7 48%, #e8dcc3 100%);
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .studio {
            width: min(100%, 980px);
            background: var(--panel);
            border: 3px solid var(--line);
            border-radius: 22px;
            box-shadow: 0 24px 60px var(--shadow);
            overflow: hidden;
        }

        .banner {
            padding: 20px 22px;
            border-bottom: 2px dashed var(--line);
            background: linear-gradient(92deg, #fff4d8, #f9eacc 45%, #ffe9ba);
        }

        h1 {
            margin: 0 0 8px;
            font-size: clamp(1.4rem, 4.6vw, 2.2rem);
            letter-spacing: 0.02em;
            font-family: "Georgia", "Times New Roman", serif;
        }

        .subtitle {
            margin: 0;
            color: #594f3a;
            font-size: 0.98rem;
            line-height: 1.5;
        }

        .grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 16px;
            padding: 16px;
        }

        .card {
            background: #fffdf8;
            border: 2px solid var(--line);
            border-radius: 16px;
            padding: 14px;
        }

        .task {
            margin-bottom: 12px;
        }

        label {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: #6b5f44;
            display: block;
            margin-bottom: 8px;
        }

        textarea {
            width: 100%;
            min-height: 90px;
            border-radius: 10px;
            border: 2px solid #d8ccb0;
            padding: 10px;
            font: inherit;
            resize: vertical;
            background: #fff;
        }

        .controls {
            display: grid;
            gap: 10px;
        }

        .slider-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            align-items: center;
            font-size: 0.95rem;
        }

        input[type="range"] { width: 100%; accent-color: var(--accent); }

        .pill {
            min-width: 56px;
            text-align: center;
            border: 1px solid #c7b68f;
            background: #fff5dd;
            border-radius: 999px;
            padding: 3px 9px;
            font-weight: 700;
            color: #7c5e1c;
        }

        .buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        button {
            border: none;
            border-radius: 10px;
            padding: 10px 12px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 130ms ease, box-shadow 130ms ease;
        }

        button:hover { transform: translateY(-1px); }
        button:active { transform: translateY(1px); }

        .primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 8px 16px rgba(217, 119, 6, 0.24);
        }

        .secondary {
            background: #385374;
            color: #fff;
            box-shadow: 0 8px 16px rgba(56, 83, 116, 0.22);
        }

        .ghost {
            background: #eee4ce;
            color: #624f1f;
        }

        .meter {
            display: grid;
            gap: 10px;
        }

        .bar-wrap {
            background: #efe2c4;
            border-radius: 999px;
            border: 1px solid #cfbe98;
            height: 14px;
            overflow: hidden;
        }

        .bar {
            height: 100%;
            width: 0%;
            transition: width 220ms ease;
        }

        #strainBar { background: linear-gradient(90deg, #ef6464, #d64545); }
        #peaceBar { background: linear-gradient(90deg, #47c08b, #1f9d6b); }

        .status {
            margin-top: 6px;
            padding: 10px;
            border-radius: 10px;
            font-weight: 700;
            background: #f8edd1;
            border: 1px solid #ddcba2;
            color: #58431c;
        }

        .log {
            margin-top: 12px;
            font-size: 0.92rem;
            line-height: 1.5;
            color: var(--muted);
            min-height: 72px;
        }

        .note {
            margin-top: 10px;
            color: #4b5b72;
            font-size: 0.88rem;
            line-height: 1.5;
            border-left: 3px solid #b9c6da;
            padding-left: 10px;
        }

        .glow {
            animation: bloom 650ms ease;
        }

        @keyframes bloom {
            0% { box-shadow: 0 0 0 rgba(25, 155, 107, 0); }
            35% { box-shadow: 0 0 28px rgba(25, 155, 107, 0.32); }
            100% { box-shadow: 0 0 0 rgba(25, 155, 107, 0); }
        }

        @media (max-width: 860px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<main class="studio">
    <section class="banner">
        <h1>Perfectionism Loop Lab</h1>
        <p class="subtitle">Tune a project, watch how constant tweaking raises strain, and discover the quiet moment when "good and shared" beats "perfect and delayed."</p>
    </section>

    <section class="grid">
        <article class="card">
            <div class="task">
                <label for="project">Current Project</label>
                <textarea id="project" placeholder="Example: write a blog post, redesign my notes dashboard, tune a script..."></textarea>
            </div>

            <div class="controls">
                <div class="slider-row">
                    <span>Polish Intensity</span>
                    <span id="polishVal" class="pill">55</span>
                </div>
                <input id="polish" type="range" min="0" max="100" value="55">

                <div class="slider-row">
                    <span>Sharing Courage</span>
                    <span id="shareVal" class="pill">45</span>
                </div>
                <input id="share" type="range" min="0" max="100" value="45">
            </div>

            <div class="buttons">
                <button class="primary" id="tweakBtn">One More Tweak</button>
                <button class="secondary" id="shipBtn">Ship It Gently</button>
                <button class="ghost" id="resetBtn">Reset Session</button>
            </div>

            <div class="log" id="log">Session ready. Name a project, then choose your next move.</div>
        </article>

        <article class="card meter" id="meterCard">
            <label>Loop Dashboard</label>

            <div>
                <div class="slider-row"><span>Strain</span><strong id="strainText">38%</strong></div>
                <div class="bar-wrap"><div class="bar" id="strainBar"></div></div>
            </div>

            <div>
                <div class="slider-row"><span>Peace</span><strong id="peaceText">42%</strong></div>
                <div class="bar-wrap"><div class="bar" id="peaceBar"></div></div>
            </div>

            <div class="status" id="status">Balanced effort. Keep it honest.</div>

            <p class="note">Inspired by Jon's reflection that perfectionism can become an endless hunger for finite polish. This lab visualizes the tradeoff and nudges toward meaningful completion.</p>
        </article>
    </section>
</main>

<script>
(() => {
    const polish = document.getElementById('polish');
    const share = document.getElementById('share');
    const polishVal = document.getElementById('polishVal');
    const shareVal = document.getElementById('shareVal');
    const tweakBtn = document.getElementById('tweakBtn');
    const shipBtn = document.getElementById('shipBtn');
    const resetBtn = document.getElementById('resetBtn');
    const log = document.getElementById('log');
    const strainBar = document.getElementById('strainBar');
    const peaceBar = document.getElementById('peaceBar');
    const strainText = document.getElementById('strainText');
    const peaceText = document.getElementById('peaceText');
    const status = document.getElementById('status');
    const meterCard = document.getElementById('meterCard');

    let loopCount = 0;
    let strain = 38;
    let peace = 42;

    const clamp = (n) => Math.max(0, Math.min(100, n));

    function syncPills() {
        polishVal.textContent = polish.value;
        shareVal.textContent = share.value;
    }

    function render() {
        strain = clamp(strain);
        peace = clamp(peace);
        strainBar.style.width = strain + '%';
        peaceBar.style.width = peace + '%';
        strainText.textContent = strain + '%';
        peaceText.textContent = peace + '%';

        if (strain > 78 && peace < 35) {
            status.textContent = 'Perfection loop detected: output stalling, pressure rising.';
            status.style.background = '#fde2e2';
            status.style.borderColor = '#e0a4a4';
            status.style.color = '#7a2525';
        } else if (peace > 74 && strain < 42) {
            status.textContent = 'Healthy finish: meaningful, shared, and calm.';
            status.style.background = '#e3f7ee';
            status.style.borderColor = '#9fd8c0';
            status.style.color = '#1e6548';
        } else {
            status.textContent = 'Balanced effort. Keep it honest.';
            status.style.background = '#f8edd1';
            status.style.borderColor = '#ddcba2';
            status.style.color = '#58431c';
        }
    }

    function projectName() {
        const txt = document.getElementById('project').value.trim();
        return txt || 'this project';
    }

    function tweak() {
        loopCount += 1;
        const polishBias = Number(polish.value) / 20;
        const shareDrag = Number(share.value) / 28;

        strain += 4 + polishBias - shareDrag;
        peace -= 2 + polishBias / 2;
        render();

        const lines = [
            'You polished ' + projectName() + ' again.',
            'Tiny gain, bigger tension.',
            'Another edge-case fixed, but launch moved farther away.'
        ];
        log.textContent = lines[loopCount % lines.length];
    }

    function ship() {
        const courage = Number(share.value);
        const polishNeed = Number(polish.value);

        peace += 8 + courage / 8;
        strain -= 10 + courage / 10 - polishNeed / 20;
        render();

        log.textContent = 'You shared ' + projectName() + '. Real feedback replaced imaginary standards.';
        meterCard.classList.remove('glow');
        void meterCard.offsetWidth;
        meterCard.classList.add('glow');
    }

    function reset() {
        loopCount = 0;
        strain = 38;
        peace = 42;
        polish.value = 55;
        share.value = 45;
        syncPills();
        render();
        log.textContent = 'Session reset. Start again with mercy and momentum.';
    }

    polish.addEventListener('input', () => {
        syncPills();
        strain += 0.4;
        peace -= 0.2;
        render();
    });

    share.addEventListener('input', () => {
        syncPills();
        peace += 0.4;
        strain -= 0.2;
        render();
    });

    tweakBtn.addEventListener('click', tweak);
    shipBtn.addEventListener('click', ship);
    resetBtn.addEventListener('click', reset);

    syncPills();
    render();
})();
</script>
</body>
</html>
