<?php
$title = 'Blindspot Mirror Lab';
$date = '2026-04-12';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        :root {
            --ink: #f7f2da;
            --muted: #d0c8b0;
            --gold: #f4b942;
            --amber: #ff8f3d;
            --rose: #ff6b6b;
            --emerald: #65d9ad;
            --sky: #75c7ff;
            --navy: #0a1220;
            --navy-2: #122037;
            --panel: rgba(9, 16, 31, 0.74);
            --line: rgba(255, 246, 212, 0.12);
            --glow: 0 18px 60px rgba(0, 0, 0, 0.45);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            background:
                radial-gradient(circle at top, rgba(116, 194, 255, 0.14), transparent 32%),
                radial-gradient(circle at 80% 20%, rgba(244, 185, 66, 0.12), transparent 26%),
                linear-gradient(180deg, #08101d, #10192a 45%, #060c15 100%);
            color: var(--ink);
            font-family: "Avenir Next Condensed", "Gill Sans Nova", "Trebuchet MS", sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(255,255,255,0.02), rgba(255,255,255,0)),
                repeating-linear-gradient(180deg, rgba(255,255,255,0.03) 0 1px, transparent 1px 3px);
            opacity: 0.25;
            mix-blend-mode: soft-light;
        }

        a { color: inherit; }

        .shell {
            width: min(1200px, calc(100% - 24px));
            margin: 0 auto;
            padding: 24px 0 40px;
        }

        .masthead {
            position: relative;
            overflow: hidden;
            padding: 28px;
            border: 1px solid var(--line);
            border-radius: 28px;
            background:
                radial-gradient(circle at 15% 15%, rgba(244, 185, 66, 0.2), transparent 22%),
                radial-gradient(circle at 84% 22%, rgba(117, 199, 255, 0.18), transparent 24%),
                linear-gradient(135deg, rgba(8, 14, 26, 0.96), rgba(17, 28, 47, 0.82));
            box-shadow: var(--glow);
        }

        .kicker {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            padding: 8px 12px;
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 999px;
            color: var(--gold);
            background: rgba(255,255,255,0.04);
            font-size: 0.82rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        h1 {
            margin: 18px 0 10px;
            font-size: clamp(2.6rem, 8vw, 5.4rem);
            line-height: 0.92;
            letter-spacing: -0.06em;
            text-transform: uppercase;
            font-family: "Impact", "Haettenschweiler", "Arial Narrow Bold", sans-serif;
        }

        .lede {
            max-width: 780px;
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
            font-size: 1.04rem;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.18fr 0.82fr;
            gap: 18px;
            margin-top: 22px;
        }

        .card {
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--panel);
            backdrop-filter: blur(16px);
            box-shadow: var(--glow);
        }

        .stage {
            padding: 14px;
        }

        canvas {
            display: block;
            width: 100%;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.1);
            background:
                radial-gradient(circle at top, rgba(101, 217, 173, 0.08), transparent 24%),
                linear-gradient(180deg, #0b1422, #09111d);
        }

        .hud {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-top: 14px;
        }

        .stat {
            padding: 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .stat-label {
            display: block;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--muted);
            margin-bottom: 6px;
        }

        .stat strong {
            font-size: 1.4rem;
            color: white;
        }

        .side-panel {
            padding: 18px;
            display: grid;
            gap: 14px;
            align-content: start;
        }

        .section-title {
            margin: 0 0 8px;
            font-family: "Palatino Linotype", "Book Antiqua", serif;
            font-size: 1.18rem;
            letter-spacing: 0.03em;
        }

        .control-block {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }

        .row:last-child { margin-bottom: 0; }

        .tiny {
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.45;
        }

        .value-chip {
            min-width: 56px;
            text-align: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.09);
            color: white;
            font-weight: 700;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .button-row, .preset-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button {
            appearance: none;
            border: 0;
            border-radius: 999px;
            padding: 11px 16px;
            color: #08101d;
            background: linear-gradient(135deg, #f6c95f, #ff9c55);
            font: inherit;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(244, 185, 66, 0.24);
            transition: transform 160ms ease, box-shadow 160ms ease, filter 160ms ease;
        }

        button:hover, button:focus-visible {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(244, 185, 66, 0.32);
            filter: brightness(1.03);
            outline: none;
        }

        button.secondary {
            color: var(--ink);
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: none;
        }

        button.active {
            background: linear-gradient(135deg, #7ed7ff, #7affcf);
            color: #041018;
        }

        .legend {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .swatch {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.18);
            flex: 0 0 auto;
        }

        .coach {
            position: relative;
            overflow: hidden;
        }

        .coach::after {
            content: "";
            position: absolute;
            inset: auto -10% -45% auto;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(101, 217, 173, 0.18), transparent 70%);
            pointer-events: none;
        }

        .coach-headline {
            font-size: 1.08rem;
            margin: 0 0 8px;
            color: white;
        }

        .coach-copy {
            margin: 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .status-list {
            display: grid;
            gap: 8px;
            margin-top: 12px;
        }

        .status-pill {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.045);
            border: 1px solid rgba(255,255,255,0.08);
            color: white;
        }

        .status-pill span:last-child {
            font-size: 0.82rem;
            color: var(--muted);
        }

        .footer-note {
            margin-top: 16px;
            text-align: center;
            color: rgba(255,255,255,0.54);
            font-size: 0.84rem;
        }

        @media (max-width: 980px) {
            .hero-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 640px) {
            .shell { width: min(100% - 14px, 1200px); }
            .masthead { padding: 20px; border-radius: 24px; }
            .hud { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .legend { grid-template-columns: 1fr; }
            .side-panel { padding: 14px; }
            button { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="masthead">
            <div class="kicker">Driver training lab • inspired by Jon</div>
            <h1>Blindspot<br>Mirror Lab</h1>
            <p class="lede">Jon wrote about the BGE mirror method, the clever setup that nearly erases blindspots but makes backing into parking lines less convenient. So here’s the dramatic little simulator version: adjust the mirrors, watch the coverage shift, and see exactly which cars disappear, reappear, or lurk like sneaky little lane-change goblins.</p>

            <div class="hero-grid">
                <div class="card stage">
                    <canvas id="roadCanvas" width="880" height="620" aria-label="Top-down driving simulator"></canvas>
                    <div class="hud">
                        <div class="stat">
                            <span class="stat-label">Mirror style</span>
                            <strong id="modeLabel">Conventional</strong>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Blindspot risk</span>
                            <strong id="riskLabel">Moderate</strong>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Parking line view</span>
                            <strong id="parkingLabel">Strong</strong>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Visible cars</span>
                            <strong id="visibleLabel">0 / 4</strong>
                        </div>
                    </div>
                </div>

                <aside class="card side-panel">
                    <div class="control-block">
                        <h2 class="section-title">Quick presets</h2>
                        <div class="preset-row">
                            <button id="presetConventional">Conventional</button>
                            <button id="presetBge" class="active">BGE</button>
                            <button id="spawnDrill" class="secondary">Shuffle traffic</button>
                        </div>
                        <p class="tiny" style="margin:12px 0 0;">Conventional keeps the mirrors pulled inward. BGE swings them outward so the side mirrors cover what the rear-view mirror misses.</p>
                    </div>

                    <div class="control-block">
                        <h2 class="section-title">Mirror angles</h2>
                        <div class="row"><label for="leftMirror">Left mirror</label><span class="value-chip" id="leftValue">55°</span></div>
                        <input id="leftMirror" type="range" min="15" max="80" value="55">
                        <div class="row" style="margin-top:14px;"><label for="rightMirror">Right mirror</label><span class="value-chip" id="rightValue">55°</span></div>
                        <input id="rightMirror" type="range" min="15" max="80" value="55">
                    </div>

                    <div class="control-block">
                        <h2 class="section-title">Scenario</h2>
                        <div class="button-row">
                            <button id="scenarioHighway" class="active">Lane change</button>
                            <button id="scenarioParking" class="secondary">Backing in</button>
                        </div>
                        <p class="tiny" id="scenarioNote" style="margin:12px 0 0;">Watch for cars floating through the overlap between rear-view and side mirrors. Less empty gap means less blindspot.</p>
                    </div>

                    <div class="control-block coach">
                        <h2 class="section-title">Coverage legend</h2>
                        <div class="legend">
                            <div class="legend-item"><span class="swatch" style="background: rgba(117,199,255,0.75);"></span>Rear-view mirror</div>
                            <div class="legend-item"><span class="swatch" style="background: rgba(244,185,66,0.8);"></span>Side mirror coverage</div>
                            <div class="legend-item"><span class="swatch" style="background: rgba(255,107,107,0.88);"></span>Blindspot gap</div>
                            <div class="legend-item"><span class="swatch" style="background: rgba(101,217,173,0.9);"></span>Currently visible car</div>
                        </div>
                    </div>

                    <div class="control-block">
                        <h2 class="section-title">Mirror report</h2>
                        <div class="status-list" id="statusList"></div>
                    </div>

                    <div class="control-block coach">
                        <h3 class="coach-headline" id="coachTitle">BGE mostly eliminates the lane-change void.</h3>
                        <p class="coach-copy" id="coachCopy">With the mirrors angled outward, a car should slide from the rear-view mirror into the side mirror instead of vanishing in between. The tradeoff is that the mirror points less toward the ground near your car while backing up.</p>
                    </div>
                </aside>
            </div>
        </section>

        <p class="footer-note">Single-file PHP, pure canvas and browser logic, no external libraries. Tiny dashboard theatre for a surprisingly practical idea.</p>
    </div>

    <script>
        const canvas = document.getElementById('roadCanvas');
        const ctx = canvas.getContext('2d');

        const leftSlider = document.getElementById('leftMirror');
        const rightSlider = document.getElementById('rightMirror');
        const leftValue = document.getElementById('leftValue');
        const rightValue = document.getElementById('rightValue');
        const modeLabel = document.getElementById('modeLabel');
        const riskLabel = document.getElementById('riskLabel');
        const parkingLabel = document.getElementById('parkingLabel');
        const visibleLabel = document.getElementById('visibleLabel');
        const coachTitle = document.getElementById('coachTitle');
        const coachCopy = document.getElementById('coachCopy');
        const statusList = document.getElementById('statusList');
        const scenarioNote = document.getElementById('scenarioNote');

        const buttons = {
            conventional: document.getElementById('presetConventional'),
            bge: document.getElementById('presetBge'),
            spawn: document.getElementById('spawnDrill'),
            highway: document.getElementById('scenarioHighway'),
            parking: document.getElementById('scenarioParking')
        };

        let scenario = 'highway';
        const vehicle = { x: canvas.width / 2, y: 360, width: 126, height: 228 };
        const rearView = { angleMin: -112, angleMax: -68, radius: 248 };
        const sideSpread = 26;
        let traffic = [];
        let anim = 0;

        function randomBetween(min, max) {
            return min + Math.random() * (max - min);
        }

        function setPreset(type) {
            if (type === 'conventional') {
                leftSlider.value = 28;
                rightSlider.value = 28;
            } else {
                leftSlider.value = 55;
                rightSlider.value = 55;
            }
            buttons.conventional.classList.toggle('active', type === 'conventional');
            buttons.conventional.classList.toggle('secondary', type !== 'conventional');
            buttons.bge.classList.toggle('active', type === 'bge');
            buttons.bge.classList.toggle('secondary', type !== 'bge');
            updateReadout();
        }

        function setScenario(next) {
            scenario = next;
            buttons.highway.classList.toggle('active', next === 'highway');
            buttons.highway.classList.toggle('secondary', next !== 'highway');
            buttons.parking.classList.toggle('active', next === 'parking');
            buttons.parking.classList.toggle('secondary', next !== 'parking');
            scenarioNote.textContent = next === 'highway'
                ? 'Watch for cars floating through the overlap between rear-view and side mirrors. Less empty gap means less blindspot.'
                : 'Now the question changes: can you still see the parking guide stripes beside the rear wheels while reversing?';
            render();
        }

        function shuffleTraffic() {
            traffic = [
                { label: 'Left lane', x: vehicle.x - 180, y: vehicle.y - randomBetween(20, 110), hue: '#72f7c8' },
                { label: 'Rear-left drift', x: vehicle.x - 125, y: vehicle.y + randomBetween(25, 120), hue: '#79cfff' },
                { label: 'Right lane', x: vehicle.x + 180, y: vehicle.y - randomBetween(10, 120), hue: '#ffd66e' },
                { label: 'Rear-right drift', x: vehicle.x + 126, y: vehicle.y + randomBetween(35, 126), hue: '#ff9680' }
            ];
            render();
        }

        function toRad(deg) {
            return deg * Math.PI / 180;
        }

        function normAngle(deg) {
            let a = deg;
            while (a < 0) a += 360;
            while (a >= 360) a -= 360;
            return a;
        }

        function angleInSector(angle, start, end) {
            const a = normAngle(angle);
            let s = normAngle(start);
            let e = normAngle(end);
            if (s <= e) return a >= s && a <= e;
            return a >= s || a <= e;
        }

        function pointVisible(point, leftDeg, rightDeg) {
            const dx = point.x - vehicle.x;
            const dy = point.y - vehicle.y;
            const distance = Math.hypot(dx, dy);
            const angle = normAngle(Math.atan2(dy, dx) * 180 / Math.PI);

            const inRear = distance <= rearView.radius && angleInSector(angle, rearView.angleMin, rearView.angleMax);

            const leftCenter = 180 + leftDeg;
            const rightCenter = 360 - rightDeg;
            const inLeft = distance <= 232 && angleInSector(angle, leftCenter - sideSpread, leftCenter + sideSpread);
            const inRight = distance <= 232 && angleInSector(angle, rightCenter - sideSpread, rightCenter + sideSpread);

            return { inRear, inLeft, inRight, visible: inRear || inLeft || inRight };
        }

        function coverageMetrics(leftDeg, rightDeg) {
            const leftGap = Math.max(0, leftDeg - 44);
            const rightGap = Math.max(0, rightDeg - 44);
            const avg = (leftDeg + rightDeg) / 2;
            const risk = avg >= 51 ? 'Low' : avg >= 38 ? 'Moderate' : 'High';
            const parking = avg <= 30 ? 'Strong' : avg <= 48 ? 'Okay' : 'Weak';
            const mode = avg >= 48 ? 'BGE-ish' : avg <= 32 ? 'Conventional' : 'Hybrid';
            return { leftGap, rightGap, risk, parking, mode };
        }

        function updateReadout() {
            leftValue.textContent = `${leftSlider.value}°`;
            rightValue.textContent = `${rightSlider.value}°`;
            render();
        }

        function drawRoad() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const gradient = ctx.createLinearGradient(0, 0, 0, canvas.height);
            gradient.addColorStop(0, '#101c2f');
            gradient.addColorStop(1, '#07101a');
            ctx.fillStyle = gradient;
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            for (let i = 0; i < 50; i++) {
                ctx.fillStyle = `rgba(255,255,255,${0.02 + (i % 5) * 0.006})`;
                ctx.fillRect((i * 71 + anim * 12) % (canvas.width + 30), (i * 37) % canvas.height, 2, 2);
            }

            const laneXs = [vehicle.x - 185, vehicle.x, vehicle.x + 185];
            ctx.strokeStyle = 'rgba(255,255,255,0.1)';
            ctx.lineWidth = 4;
            laneXs.forEach((x, idx) => {
                ctx.beginPath();
                ctx.setLineDash(idx === 1 ? [] : [18, 18]);
                ctx.moveTo(x, 0);
                ctx.lineTo(x, canvas.height);
                ctx.stroke();
            });
            ctx.setLineDash([]);

            if (scenario === 'parking') {
                ctx.strokeStyle = 'rgba(244,185,66,0.4)';
                ctx.lineWidth = 3;
                for (let i = 0; i < 4; i++) {
                    const y = 462 + i * 28;
                    ctx.beginPath();
                    ctx.moveTo(vehicle.x - 220, y);
                    ctx.lineTo(vehicle.x + 220, y);
                    ctx.stroke();
                }
            }
        }

        function drawSector(centerX, centerY, radius, startDeg, endDeg, fill, stroke) {
            ctx.beginPath();
            ctx.moveTo(centerX, centerY);
            ctx.arc(centerX, centerY, radius, toRad(startDeg), toRad(endDeg));
            ctx.closePath();
            ctx.fillStyle = fill;
            ctx.fill();
            ctx.strokeStyle = stroke;
            ctx.lineWidth = 1.6;
            ctx.stroke();
        }

        function drawCarBody() {
            const { x, y, width, height } = vehicle;
            ctx.save();
            ctx.translate(x, y);

            ctx.fillStyle = '#071623';
            ctx.beginPath();
            ctx.roundRect(-width / 2, -height / 2, width, height, 34);
            ctx.fill();

            const bodyGradient = ctx.createLinearGradient(-width / 2, -height / 2, width / 2, height / 2);
            bodyGradient.addColorStop(0, '#f8d885');
            bodyGradient.addColorStop(0.5, '#f6a34f');
            bodyGradient.addColorStop(1, '#b95b25');
            ctx.fillStyle = bodyGradient;
            ctx.beginPath();
            ctx.roundRect(-width / 2 + 12, -height / 2 + 12, width - 24, height - 24, 28);
            ctx.fill();

            ctx.fillStyle = 'rgba(7, 18, 32, 0.9)';
            ctx.beginPath();
            ctx.roundRect(-width / 2 + 23, -height / 2 + 38, width - 46, height - 84, 20);
            ctx.fill();

            ctx.fillStyle = 'rgba(117,199,255,0.18)';
            ctx.fillRect(-width / 2 + 32, -height / 2 + 54, width - 64, 46);
            ctx.fillRect(-width / 2 + 32, height / 2 - 102, width - 64, 46);

            ctx.fillStyle = '#09101a';
            [[-width / 2 + 8, -height / 2 + 26], [width / 2 - 20, -height / 2 + 26], [-width / 2 + 8, height / 2 - 58], [width / 2 - 20, height / 2 - 58]].forEach(([tx, ty]) => {
                ctx.beginPath();
                ctx.roundRect(tx, ty, 12, 32, 6);
                ctx.fill();
            });

            ctx.fillStyle = '#fff3b8';
            ctx.fillRect(-22, -height / 2 + 16, 44, 8);
            ctx.fillStyle = '#ff8573';
            ctx.fillRect(-22, height / 2 - 24, 44, 8);
            ctx.restore();
        }

        function drawMirrors(leftDeg, rightDeg) {
            drawSector(vehicle.x, vehicle.y, rearView.radius, rearView.angleMin, rearView.angleMax, 'rgba(117,199,255,0.12)', 'rgba(117,199,255,0.34)');
            drawSector(vehicle.x - 30, vehicle.y + 6, 232, 180 + leftDeg - sideSpread, 180 + leftDeg + sideSpread, 'rgba(244,185,66,0.16)', 'rgba(244,185,66,0.38)');
            drawSector(vehicle.x + 30, vehicle.y + 6, 232, -rightDeg - sideSpread, -rightDeg + sideSpread, 'rgba(244,185,66,0.16)', 'rgba(244,185,66,0.38)');

            const metrics = coverageMetrics(leftDeg, rightDeg);
            const leftBlindStart = rearView.angleMin;
            const leftBlindEnd = 180 + leftDeg - sideSpread;
            const rightBlindStart = 360 - rightDeg + sideSpread;
            const rightBlindEnd = rearView.angleMax + 360;

            if (leftBlindEnd - leftBlindStart > 5) {
                drawSector(vehicle.x, vehicle.y, 212, leftBlindStart, leftBlindEnd, 'rgba(255,107,107,0.12)', 'rgba(255,107,107,0.3)');
            }
            if (rightBlindEnd - rightBlindStart > 5) {
                drawSector(vehicle.x, vehicle.y, 212, rightBlindStart, rightBlindEnd, 'rgba(255,107,107,0.12)', 'rgba(255,107,107,0.3)');
            }

            if (scenario === 'parking') {
                const strength = Math.max(0, 1 - ((leftDeg + rightDeg) / 2 - 22) / 42);
                ctx.strokeStyle = `rgba(101,217,173,${0.18 + strength * 0.55})`;
                ctx.lineWidth = 5;
                ctx.beginPath();
                ctx.moveTo(vehicle.x - 88, vehicle.y + 68);
                ctx.lineTo(vehicle.x - 208, vehicle.y + 176);
                ctx.moveTo(vehicle.x + 88, vehicle.y + 68);
                ctx.lineTo(vehicle.x + 208, vehicle.y + 176);
                ctx.stroke();
            }
        }

        function drawTraffic(leftDeg, rightDeg) {
            let visibleCount = 0;
            statusList.innerHTML = '';
            traffic.forEach((car, index) => {
                const visibility = pointVisible(car, leftDeg, rightDeg);
                if (visibility.visible) visibleCount++;

                const pulse = 0.65 + Math.sin(anim * 2 + index) * 0.08;
                ctx.save();
                ctx.translate(car.x, car.y);
                ctx.fillStyle = visibility.visible ? `rgba(101,217,173,${pulse})` : 'rgba(255,107,107,0.36)';
                ctx.strokeStyle = visibility.visible ? 'rgba(255,255,255,0.7)' : 'rgba(255,255,255,0.2)';
                ctx.lineWidth = 2;
                ctx.beginPath();
                ctx.roundRect(-26, -46, 52, 92, 16);
                ctx.fill();
                ctx.stroke();
                ctx.fillStyle = 'rgba(7,18,32,0.86)';
                ctx.fillRect(-18, -20, 36, 40);
                ctx.restore();

                const pill = document.createElement('div');
                pill.className = 'status-pill';
                const zone = visibility.inRear ? 'rear-view' : visibility.inLeft ? 'left mirror' : visibility.inRight ? 'right mirror' : 'blindspot';
                pill.innerHTML = `<span>${car.label}</span><span>${visibility.visible ? 'Visible in ' + zone : 'Hidden in blindspot'}</span>`;
                statusList.appendChild(pill);
            });
            visibleLabel.textContent = `${visibleCount} / ${traffic.length}`;
        }

        function drawLabels() {
            ctx.fillStyle = 'rgba(255,255,255,0.62)';
            ctx.font = '700 15px "Avenir Next Condensed", "Trebuchet MS", sans-serif';
            ctx.fillText('LEFT MIRROR', 72, 56);
            ctx.fillText('REAR-VIEW', vehicle.x - 42, 74);
            ctx.fillText('RIGHT MIRROR', canvas.width - 182, 56);
        }

        function updateCoach(leftDeg, rightDeg) {
            const metrics = coverageMetrics(leftDeg, rightDeg);
            modeLabel.textContent = metrics.mode;
            riskLabel.textContent = metrics.risk;
            parkingLabel.textContent = metrics.parking;

            if (scenario === 'highway') {
                if (metrics.risk === 'Low') {
                    coachTitle.textContent = 'Nice. The lane-change void is tiny now.';
                    coachCopy.textContent = 'This is the BGE idea in action: cars move from the rear-view mirror into the side mirrors with much less disappearing act in between.';
                } else if (metrics.risk === 'Moderate') {
                    coachTitle.textContent = 'You are in the mushy middle.';
                    coachCopy.textContent = 'This hybrid setup is familiar, but it leaves some ghostly no-man’s-land between the center mirror and the side mirrors. A car can still slip out of sight for a moment.';
                } else {
                    coachTitle.textContent = 'Classic setup, classic blindspot.';
                    coachCopy.textContent = 'You get a comforting view of your own car flank, but a larger gap remains behind you. Shoulder checks are still doing heroic overtime.';
                }
            } else {
                if (metrics.parking === 'Strong') {
                    coachTitle.textContent = 'Backing in looks easy from here.';
                    coachCopy.textContent = 'The mirrors are turned inward enough that the parking guide stripes near your rear corners stay visible. Good for tidy parking, not ideal for blindspot elimination.';
                } else if (metrics.parking === 'Okay') {
                    coachTitle.textContent = 'You can probably still cheat a parking line.';
                    coachCopy.textContent = 'This compromise keeps some curb and stripe visibility, but not as much as the old-school inward angle.';
                } else {
                    coachTitle.textContent = 'There’s the BGE tradeoff Jon noticed.';
                    coachCopy.textContent = 'Excellent side coverage, but those near-the-car parking lines are fading out of view. Great for lane awareness, less handy when reverse-parking by visual line-sniffing alone.';
                }
            }
        }

        function render() {
            const leftDeg = Number(leftSlider.value);
            const rightDeg = Number(rightSlider.value);
            drawRoad();
            drawMirrors(leftDeg, rightDeg);
            drawCarBody();
            drawTraffic(leftDeg, rightDeg);
            drawLabels();
            updateCoach(leftDeg, rightDeg);
        }

        function tick() {
            anim += 0.01;
            render();
            requestAnimationFrame(tick);
        }

        leftSlider.addEventListener('input', updateReadout);
        rightSlider.addEventListener('input', updateReadout);
        buttons.conventional.addEventListener('click', () => setPreset('conventional'));
        buttons.bge.addEventListener('click', () => setPreset('bge'));
        buttons.spawn.addEventListener('click', shuffleTraffic);
        buttons.highway.addEventListener('click', () => setScenario('highway'));
        buttons.parking.addEventListener('click', () => setScenario('parking'));

        shuffleTraffic();
        setPreset('bge');
        setScenario('highway');
        tick();
    </script>
</body>
</html>
