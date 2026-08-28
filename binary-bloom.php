<?php
$sourceUrl = 'https://jona.ca/2009/05/binary-tree-of-depth-17.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#11130f">
    <title>Binary Bloom</title>
    <style>
        :root {
            --ink: #11130f;
            --paper: #e9dfc6;
            --paper-dim: #bdb49e;
            --amber: #f4ad52;
            --mint: #bde9c1;
            --copper: #a8663b;
            --rule: rgba(233, 223, 198, .23);
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            color: var(--paper);
            background:
                radial-gradient(circle at 50% 8%, rgba(168, 102, 59, .18), transparent 32rem),
                linear-gradient(rgba(255,255,255,.014) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.014) 1px, transparent 1px),
                var(--ink);
            background-size: auto, 24px 24px, 24px 24px, auto;
            font-family: Baskerville, "Iowan Old Style", Georgia, serif;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            opacity: .16;
            pointer-events: none;
            background-image: url("assets/binary-bloom.webp");
            background-size: min(85vw, 760px) auto;
            background-position: center 7rem;
            background-repeat: no-repeat;
            filter: saturate(.75);
            mask-image: linear-gradient(to bottom, #000 0 75%, transparent 95%);
        }

        a { color: var(--mint); text-underline-offset: .2em; }
        button, input { font: inherit; }
        button { touch-action: manipulation; }

        .shell { width: min(1180px, calc(100% - 28px)); margin: 0 auto; position: relative; }
        .masthead {
            min-height: 92vh;
            padding: 26px 0 48px;
            display: grid;
            grid-template-rows: auto 1fr auto;
        }
        .topline { display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .back, .plate {
            font-family: "Courier New", monospace;
            font-size: .68rem;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .back { text-decoration: none; color: var(--paper-dim); }
        .back:hover { color: var(--paper); }
        .plate { color: var(--amber); border: 1px solid currentColor; padding: 6px 9px; }

        .hero-copy { align-self: center; padding: 12vh 0 4vh; max-width: 830px; position: relative; }
        .kicker {
            color: var(--mint);
            font-family: "Courier New", monospace;
            letter-spacing: .18em;
            text-transform: uppercase;
            font-size: .73rem;
        }
        h1 {
            margin: .14em 0 .1em;
            font-size: clamp(4.3rem, 14vw, 10.5rem);
            font-weight: 400;
            line-height: .78;
            letter-spacing: -.075em;
            text-shadow: 0 0 45px rgba(244, 173, 82, .19);
        }
        h1 em { color: var(--amber); font-weight: 400; }
        .hero-copy p {
            max-width: 39rem;
            margin: 2rem 0 0;
            color: var(--paper-dim);
            font-size: clamp(1.05rem, 2.2vw, 1.35rem);
            line-height: 1.55;
        }
        .hero-copy p strong { color: var(--paper); font-weight: 400; }
        .scroll-cue { display: flex; align-items: center; gap: 12px; color: var(--paper-dim); font-style: italic; }
        .scroll-cue::before { content: ""; width: 58px; height: 1px; background: var(--amber); }

        .lab { padding: 60px 0 120px; }
        .section-label {
            margin: 0 0 12px;
            color: var(--amber);
            font: .69rem/1 "Courier New", monospace;
            letter-spacing: .16em;
            text-transform: uppercase;
        }
        h2 { font-size: clamp(2.2rem, 6vw, 4.6rem); line-height: .95; font-weight: 400; margin: 0; letter-spacing: -.045em; }
        .intro { color: var(--paper-dim); line-height: 1.6; max-width: 45rem; font-size: 1.08rem; }

        .instrument {
            margin-top: 36px;
            border: 1px solid var(--rule);
            background: rgba(10, 12, 9, .78);
            box-shadow: 0 30px 90px rgba(0,0,0,.4);
            backdrop-filter: blur(10px);
        }
        .readout {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-bottom: 1px solid var(--rule);
        }
        .datum { padding: 18px 22px; border-right: 1px solid var(--rule); }
        .datum:last-child { border: 0; }
        .datum small { display: block; color: var(--paper-dim); font: .65rem/1.2 "Courier New", monospace; text-transform: uppercase; letter-spacing: .12em; }
        .datum output { display: block; margin-top: 7px; color: var(--mint); font: clamp(1.25rem, 4vw, 2.4rem)/1 "Courier New", monospace; }

        .stage { position: relative; aspect-ratio: 16 / 10; min-height: 430px; overflow: hidden; }
        .stage::after {
            content: ""; position: absolute; inset: 12px; pointer-events: none;
            border: 1px solid rgba(233,223,198,.08);
        }
        canvas { display: block; width: 100%; height: 100%; cursor: crosshair; }
        .canvas-note {
            position: absolute; left: 24px; top: 22px; max-width: 17rem;
            color: rgba(233,223,198,.6); font: .65rem/1.5 "Courier New", monospace;
            letter-spacing: .06em; text-transform: uppercase; pointer-events: none;
        }
        .controls {
            display: grid; grid-template-columns: 1fr 1fr auto; gap: 24px;
            padding: 20px 22px; border-top: 1px solid var(--rule); align-items: end;
        }
        .control label { display: flex; justify-content: space-between; color: var(--paper-dim); font: .68rem/1 "Courier New", monospace; letter-spacing: .1em; text-transform: uppercase; }
        input[type="range"] { width: 100%; margin-top: 14px; accent-color: var(--amber); }
        .bloom-button, .choice, .reset {
            border: 1px solid var(--amber); background: var(--amber); color: var(--ink);
            padding: 13px 18px; cursor: pointer; font: .72rem/1 "Courier New", monospace;
            letter-spacing: .09em; text-transform: uppercase; transition: .2s ease;
        }
        .bloom-button:hover, .choice:hover { background: var(--mint); border-color: var(--mint); transform: translateY(-2px); }

        .exponential { margin: 90px 0; display: grid; grid-template-columns: .72fr 1.28fr; gap: 64px; align-items: start; }
        .levels { border-top: 1px solid var(--rule); }
        .level {
            display: grid; grid-template-columns: 52px 1fr auto; gap: 14px; align-items: center;
            min-height: 42px; border-bottom: 1px solid var(--rule);
            font-family: "Courier New", monospace; font-size: .72rem;
        }
        .level span:first-child { color: var(--paper-dim); }
        .level .bar { height: 3px; background: linear-gradient(90deg, var(--copper), var(--mint)); transform-origin: left; }
        .level strong { color: var(--mint); font-weight: 400; }

        .pathfinder {
            border: 1px solid var(--rule); display: grid; grid-template-columns: 1fr 1fr;
            background: rgba(20, 22, 17, .86); overflow: hidden;
        }
        .path-copy { padding: clamp(28px, 5vw, 58px); }
        .path-copy p { color: var(--paper-dim); line-height: 1.6; }
        .choice-row { display: flex; gap: 12px; margin: 28px 0 20px; }
        .choice { flex: 1; }
        .choice:last-child { background: transparent; color: var(--amber); }
        .choice:last-child:hover { color: var(--ink); }
        .choice:disabled { opacity: .25; cursor: default; transform: none; }
        .route { min-height: 52px; color: var(--mint); font: .9rem/1.7 "Courier New", monospace; word-break: break-all; }
        .reset { padding: 0; border: 0; border-bottom: 1px solid currentColor; background: transparent; color: var(--paper-dim); }
        .seed-card {
            min-height: 390px; padding: 40px; border-left: 1px solid var(--rule);
            background-image: linear-gradient(rgba(17,19,15,.1), rgba(17,19,15,.62)), url("assets/binary-bloom.webp");
            background-size: cover; background-position: center; display: grid; align-content: end;
        }
        .leaf-number { color: var(--mint); font: clamp(2.5rem, 7vw, 5rem)/.9 "Courier New", monospace; letter-spacing: -.09em; }
        .leaf-caption { color: var(--paper-dim); font-style: italic; margin-top: 14px; }

        .source {
            margin-top: 90px; padding: 40px 0 0; border-top: 1px solid var(--rule);
            display: flex; justify-content: space-between; gap: 30px; align-items: end;
        }
        .source blockquote { margin: 0; max-width: 36rem; font-size: clamp(1.4rem, 3vw, 2.2rem); line-height: 1.2; }
        .source p { max-width: 24rem; margin: 0; color: var(--paper-dim); line-height: 1.55; }

        @media (max-width: 760px) {
            .masthead { min-height: 82vh; }
            .hero-copy { padding-top: 13vh; }
            .stage { aspect-ratio: 4 / 5; min-height: 520px; }
            .controls { grid-template-columns: 1fr 1fr; }
            .bloom-button { grid-column: 1 / -1; }
            .exponential, .pathfinder { grid-template-columns: 1fr; gap: 34px; }
            .seed-card { border-left: 0; border-top: 1px solid var(--rule); min-height: 470px; }
            .source { display: block; }
            .source p { margin-top: 24px; }
        }
        @media (max-width: 470px) {
            .plate { display: none; }
            .readout { grid-template-columns: 1fr 1fr; }
            .datum:last-child { grid-column: 1 / -1; border-top: 1px solid var(--rule); }
            .datum:nth-child(2) { border-right: 0; }
            .controls { grid-template-columns: 1fr; }
            .bloom-button { grid-column: auto; }
            .choice-row { flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } *, *::before, *::after { animation: none !important; transition: none !important; } }
    </style>
</head>
<body>
    <header class="masthead shell">
        <div class="topline">
            <a class="back" href="./">← Chloe Reads Jon</a>
            <span class="plate">Plate XVII · Growth by doubling</span>
        </div>
        <div class="hero-copy">
            <span class="kicker">An instrument for exponential wonder</span>
            <h1>Binary<br><em>Bloom</em></h1>
            <p>One branch makes two. Two make four. Keep going and a modest depth of <strong>17</strong> ends in <strong>131,072 leaves</strong>. Grow it yourself and take one improbable path through the canopy.</p>
        </div>
        <a class="scroll-cue" href="#laboratory">Enter the laboratory</a>
    </header>

    <main class="shell lab" id="laboratory">
        <p class="section-label">01 · The growth chamber</p>
        <h2>Turn one line into a forest.</h2>
        <p class="intro">Move the depth slowly. The first few levels feel harmless; then doubling quietly gets out of hand. At full depth, every mint spark is a leaf, whether or not your screen has enough pixels to give each one a private room.</p>

        <section class="instrument" aria-label="Interactive binary tree visualizer">
            <div class="readout" aria-live="polite">
                <div class="datum"><small>Depth</small><output id="depthOut">10</output></div>
                <div class="datum"><small>Total nodes</small><output id="nodesOut">2,047</output></div>
                <div class="datum"><small>Leaves</small><output id="leavesOut">1,024</output></div>
            </div>
            <div class="stage">
                <canvas id="treeCanvas" aria-label="A branching binary tree"></canvas>
                <div class="canvas-note">Each fork is one decision. Amber branches are structure; mint points are possibilities.</div>
            </div>
            <div class="controls">
                <div class="control">
                    <label for="depth">Depth <span id="depthValue">10</span></label>
                    <input id="depth" type="range" min="1" max="17" value="10">
                </div>
                <div class="control">
                    <label for="spread">Branch angle <span id="spreadValue">25°</span></label>
                    <input id="spread" type="range" min="12" max="38" value="25">
                </div>
                <button class="bloom-button" id="bloom" type="button">Grow again</button>
            </div>
        </section>

        <section class="exponential">
            <div>
                <p class="section-label">02 · The quiet explosion</p>
                <h2>Nothing happens.<br>Then everything does.</h2>
                <p class="intro">The final five levels contain almost 97% of the leaves. Exponential growth does its best work while looking rather innocent.</p>
            </div>
            <div class="levels" id="levels" aria-label="Leaf counts by tree depth"></div>
        </section>

        <section class="pathfinder">
            <div class="path-copy">
                <p class="section-label">03 · Choose a leaf</p>
                <h2>Seventeen tiny decisions.</h2>
                <p>There are 131,072 routes from root to leaf. Choose left or right seventeen times. Your route lights up in the growth chamber, and the tree gives your one leaf a number.</p>
                <div class="choice-row">
                    <button class="choice" id="left" type="button">← Left</button>
                    <button class="choice" id="right" type="button">Right →</button>
                </div>
                <div class="route" id="route" aria-live="polite">The root is waiting.</div>
                <button class="reset" id="reset" type="button">Start a new route</button>
            </div>
            <div class="seed-card">
                <div class="leaf-number" id="leafNumber">—</div>
                <div class="leaf-caption" id="leafCaption">Choose a direction to enter the canopy.</div>
            </div>
        </section>

        <section class="source">
            <blockquote>“This is pretty (and instructive).”</blockquote>
            <p>That was Jon’s entire verdict, and it is exactly right. Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>">Binary tree of depth 17</a>.</p>
        </section>
    </main>

    <script>
        (() => {
            const canvas = document.getElementById('treeCanvas');
            const ctx = canvas.getContext('2d');
            const depthInput = document.getElementById('depth');
            const spreadInput = document.getElementById('spread');
            const depthOut = document.getElementById('depthOut');
            const nodesOut = document.getElementById('nodesOut');
            const leavesOut = document.getElementById('leavesOut');
            const depthValue = document.getElementById('depthValue');
            const spreadValue = document.getElementById('spreadValue');
            const formatter = new Intl.NumberFormat('en-CA');
            let route = [];
            let segments = [];
            let leafDots = [];
            let animationFrame = 0;

            function fitCanvas() {
                const rect = canvas.getBoundingClientRect();
                const dpr = Math.min(window.devicePixelRatio || 1, 2);
                canvas.width = Math.round(rect.width * dpr);
                canvas.height = Math.round(rect.height * dpr);
                ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
                buildTree(false);
            }

            function buildTree(animate = true) {
                cancelAnimationFrame(animationFrame);
                const depth = Number(depthInput.value);
                const spread = Number(spreadInput.value) * Math.PI / 180;
                const rect = canvas.getBoundingClientRect();
                const startX = rect.width / 2;
                const startY = rect.height * .94;
                const initialLength = Math.min(rect.height * .22, rect.width * .19);
                const ratio = depth > 13 ? .72 : .735;
                const renderDepth = Math.min(depth, 14);
                const stack = [{ x: startX, y: startY, angle: -Math.PI / 2, length: initialLength, level: 0, bits: '' }];
                segments = [];
                leafDots = [];

                while (stack.length) {
                    const branch = stack.pop();
                    const x2 = branch.x + Math.cos(branch.angle) * branch.length;
                    const y2 = branch.y + Math.sin(branch.angle) * branch.length;
                    segments.push({ x1: branch.x, y1: branch.y, x2, y2, level: branch.level, bits: branch.bits });
                    if (branch.level < renderDepth) {
                        const wobble = Math.sin(branch.level * 1.73) * .012;
                        stack.push({ x: x2, y: y2, angle: branch.angle + spread + wobble, length: branch.length * ratio, level: branch.level + 1, bits: branch.bits + '1' });
                        stack.push({ x: x2, y: y2, angle: branch.angle - spread - wobble, length: branch.length * ratio, level: branch.level + 1, bits: branch.bits + '0' });
                    } else {
                        leafDots.push({ x: x2, y: y2 });
                    }
                }
                updateReadout(depth);
                if (animate && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) drawProgress(0);
                else drawProgress(segments.length);
            }

            function drawProgress(count) {
                const rect = canvas.getBoundingClientRect();
                ctx.clearRect(0, 0, rect.width, rect.height);
                ctx.lineCap = 'round';
                const limit = Math.min(count, segments.length);
                for (let i = 0; i < limit; i++) {
                    const s = segments[i];
                    const isRoute = route.length && s.bits === route.slice(0, s.bits.length).join('');
                    ctx.strokeStyle = isRoute ? '#bde9c1' : `rgba(244, 173, 82, ${Math.max(.14, 1 - s.level * .045)})`;
                    ctx.lineWidth = isRoute ? Math.max(2.2, 5 - s.level * .17) : Math.max(.42, 4.2 - s.level * .23);
                    ctx.beginPath(); ctx.moveTo(s.x1, s.y1); ctx.lineTo(s.x2, s.y2); ctx.stroke();
                }
                if (limit === segments.length) {
                    ctx.fillStyle = '#bde9c1';
                    for (const dot of leafDots) { ctx.beginPath(); ctx.arc(dot.x, dot.y, 1.15, 0, Math.PI * 2); ctx.fill(); }
                    return;
                }
                animationFrame = requestAnimationFrame(() => drawProgress(count + Math.max(18, Math.ceil(segments.length / 70))));
            }

            function updateReadout(depth) {
                depthValue.textContent = depth;
                depthOut.textContent = depth;
                const leaves = 2 ** depth;
                leavesOut.textContent = formatter.format(leaves);
                nodesOut.textContent = formatter.format((2 ** (depth + 1)) - 1);
            }

            function makeLevels() {
                const holder = document.getElementById('levels');
                for (let depth = 1; depth <= 17; depth++) {
                    const count = 2 ** depth;
                    const row = document.createElement('div');
                    row.className = 'level';
                    row.innerHTML = `<span>${String(depth).padStart(2, '0')}</span><i class="bar" style="width:${Math.max(1, (depth / 17) ** 4 * 100)}%"></i><strong>${formatter.format(count)}</strong>`;
                    holder.appendChild(row);
                }
            }

            function choose(bit) {
                if (route.length >= 17) return;
                route.push(bit);
                const binary = route.join('');
                document.getElementById('route').textContent = route.map(x => x === '0' ? 'L' : 'R').join(' · ');
                document.getElementById('leafNumber').textContent = `#${formatter.format(parseInt(binary.padEnd(17, '0'), 2) + 1)}`;
                document.getElementById('leafCaption').textContent = route.length === 17
                    ? `Found: leaf ${parseInt(binary, 2) + 1} of 131,072. No other route arrives here.`
                    : `${17 - route.length} decisions remain. Current address: ${binary}`;
                if (route.length === 17) {
                    document.getElementById('left').disabled = true;
                    document.getElementById('right').disabled = true;
                }
                depthInput.value = 17;
                buildTree(false);
            }

            function resetRoute() {
                route = [];
                document.getElementById('route').textContent = 'The root is waiting.';
                document.getElementById('leafNumber').textContent = '—';
                document.getElementById('leafCaption').textContent = 'Choose a direction to enter the canopy.';
                document.getElementById('left').disabled = false;
                document.getElementById('right').disabled = false;
                buildTree(false);
            }

            depthInput.addEventListener('input', () => buildTree(false));
            spreadInput.addEventListener('input', () => { spreadValue.textContent = `${spreadInput.value}°`; buildTree(false); });
            document.getElementById('bloom').addEventListener('click', () => buildTree(true));
            document.getElementById('left').addEventListener('click', () => choose('0'));
            document.getElementById('right').addEventListener('click', () => choose('1'));
            document.getElementById('reset').addEventListener('click', resetRoute);
            window.addEventListener('keydown', event => {
                if (event.key === 'ArrowLeft') choose('0');
                if (event.key === 'ArrowRight') choose('1');
            });
            window.addEventListener('resize', fitCanvas);

            makeLevels();
            requestAnimationFrame(fitCanvas);
        })();
    </script>
</body>
</html>
