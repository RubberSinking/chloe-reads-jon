<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Daily Decide-O-Matic</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Space+Mono:wght@400;700&display=swap');

        :root {
            --bg: #0f0d0b;
            --card: #1c1917;
            --gold: #c9a84c;
            --gold-light: #e8c96a;
            --cream: #f5f0e8;
            --muted: #8a8070;
            --red: #c94040;
            --teal: #3aa8a0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: var(--bg);
            color: var(--cream);
            font-family: 'Playfair Display', serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 20px;
            background-image:
                radial-gradient(ellipse at 50% 0%, rgba(201,168,76,0.08) 0%, transparent 60%),
                radial-gradient(circle at 20% 80%, rgba(58,168,160,0.05) 0%, transparent 40%);
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        h1 {
            font-size: clamp(2rem, 6vw, 3.2rem);
            font-weight: 900;
            letter-spacing: -1px;
            line-height: 1.1;
            margin-bottom: 8px;
        }

        h1 span { color: var(--gold); font-style: italic; }

        .tagline {
            color: var(--muted);
            font-size: 0.95rem;
            font-family: 'Space Mono', monospace;
            letter-spacing: 0.05em;
        }

        /* Wheel */
        .wheel-container {
            position: relative;
            width: min(340px, 80vw);
            height: min(340px, 80vw);
            margin: 20px 0 30px;
        }

        .wheel-outer {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #2a2520, #1c1917, #2a2520, #1c1917, #2a2520, #1c1917, #2a2520);
            box-shadow:
                0 0 0 3px var(--gold),
                0 0 60px rgba(201,168,76,0.15),
                inset 0 0 40px rgba(0,0,0,0.8);
        }

        .wheel-inner {
            position: absolute;
            inset: 18px;
            border-radius: 50%;
            background: var(--card);
            box-shadow: inset 0 0 30px rgba(0,0,0,0.6);
            overflow: hidden;
            transition: transform 4s cubic-bezier(0.17, 0.67, 0.12, 0.99);
        }

        .wheel-inner.spinning {
            transition: transform 5s cubic-bezier(0.17, 0.67, 0.12, 0.99);
        }

        .wheel-inner.idle {
            transition: none;
        }

        .segment {
            position: absolute;
            width: 50%;
            height: 50%;
            top: 0;
            right: 0;
            transform-origin: 0% 100%;
            clip-path: polygon(0% 100%, 100% 0%, 0% 0%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .segment-text {
            position: absolute;
            top: 22%;
            left: 8%;
            font-family: 'Space Mono', monospace;
            font-size: clamp(0.55rem, 1.8vw, 0.7rem);
            font-weight: 700;
            color: rgba(0,0,0,0.7);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            transform: rotate(28deg);
            text-align: left;
            line-height: 1.3;
        }

        /* Pointer */
        .pointer {
            position: absolute;
            top: -18px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.5));
        }

        .pointer svg { width: 36px; height: 44px; }

        /* Result */
        .result {
            text-align: center;
            min-height: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 32px;
        }

        .result-label {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .result-text {
            font-size: clamp(1.5rem, 5vw, 2.2rem);
            font-weight: 700;
            color: var(--gold-light);
            font-style: italic;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.5s ease;
            max-width: 90%;
            line-height: 1.2;
        }

        .result-text.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border: none;
            border-radius: 4px;
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--gold);
            color: #0f0d0b;
            box-shadow: 0 4px 20px rgba(201,168,76,0.3);
        }

        .btn-primary:hover {
            background: var(--gold-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 28px rgba(201,168,76,0.4);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-primary:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
        }

        .btn-secondary {
            background: transparent;
            color: var(--muted);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 12px 24px;
            font-size: 0.75rem;
        }

        .btn-secondary:hover { color: var(--cream); border-color: rgba(255,255,255,0.2); }

        /* Options List */
        .options-section {
            width: 100%;
            max-width: 420px;
            margin-top: 40px;
        }

        .section-title {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--muted);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.08);
        }

        .options-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .option-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 6px;
            padding: 10px 14px;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .option-item:hover { border-color: rgba(201,168,76,0.3); background: rgba(201,168,76,0.04); }

        .option-item.active { border-color: var(--gold); background: rgba(201,168,76,0.08); }

        .option-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .option-name {
            flex: 1;
            font-size: 0.88rem;
            color: var(--cream);
        }

        .option-remove {
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            font-size: 1.1rem;
            padding: 2px 6px;
            line-height: 1;
            transition: color 0.15s;
            font-family: monospace;
        }

        .option-remove:hover { color: var(--red); }

        /* Add Option */
        .add-option {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .add-option input {
            flex: 1;
            background: var(--card);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 6px;
            padding: 10px 14px;
            color: var(--cream);
            font-family: 'Playfair Display', serif;
            font-size: 0.88rem;
            outline: none;
            transition: border-color 0.2s;
        }

        .add-option input::placeholder { color: var(--muted); }
        .add-option input:focus { border-color: var(--gold); }

        .add-option button {
            background: rgba(201,168,76,0.15);
            border: 1px solid rgba(201,168,76,0.3);
            color: var(--gold);
            border-radius: 6px;
            padding: 10px 16px;
            cursor: pointer;
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            transition: all 0.2s;
        }

        .add-option button:hover { background: rgba(201,168,76,0.25); }

        /* Credits */
        .credit {
            margin-top: 48px;
            font-family: 'Space Mono', monospace;
            font-size: 0.65rem;
            color: rgba(255,255,255,0.18);
            text-align: center;
            line-height: 1.6;
        }

        .credit a { color: rgba(255,255,255,0.3); }

        /* History */
        .history-section {
            width: 100%;
            max-width: 420px;
            margin-top: 32px;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .history-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 0;
            font-family: 'Space Mono', monospace;
            font-size: 0.72rem;
            color: var(--muted);
        }

        .history-item .time { color: rgba(255,255,255,0.2); min-width: 60px; }
        .history-item .choice { color: var(--cream); }

        /* Pulse ring animation on pointer during spin */
        @keyframes pulse-ring {
            0% { opacity: 1; }
            100% { opacity: 0; transform: scale(1.5); }
        }

        .pointer-ring {
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--gold);
            opacity: 0;
        }

        .spinning .pointer-ring {
            animation: pulse-ring 0.6s ease-out infinite;
        }

        @keyframes float-glow {
            0%, 100% { box-shadow: 0 0 30px rgba(201,168,76,0.3); }
            50% { box-shadow: 0 0 60px rgba(201,168,76,0.5); }
        }

        .wheel-outer.lit {
            animation: float-glow 2s ease-in-out infinite;
        }

        .wheel-outer.idle-lit {
            box-shadow:
                0 0 0 3px var(--gold),
                0 0 30px rgba(201,168,76,0.2),
                inset 0 0 40px rgba(0,0,0,0.8);
        }

        /* Countdown dots */
        .spin-dots {
            display: flex;
            gap: 6px;
            justify-content: center;
            margin-top: 12px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .spin-dots.show { opacity: 1; }

        .spin-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--gold);
            animation: dot-bounce 0.8s ease-in-out infinite;
        }

        .spin-dot:nth-child(2) { animation-delay: 0.15s; }
        .spin-dot:nth-child(3) { animation-delay: 0.3s; }

        @keyframes dot-bounce {
            0%, 100% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.3); opacity: 1; }
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .options-section, .history-section { max-width: 100%; }
            .add-option { flex-direction: column; }
        }

        /* Scroll to result smoothly */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

<header>
    <h1>The Daily <span>Decide-O-Matic</span></h1>
    <p class="tagline">Spin the wheel. Trust the cosmos.</p>
</header>

<div class="wheel-container">
    <div class="pointer">
        <div class="pointer-ring"></div>
        <svg viewBox="0 0 36 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 44 L4 8 L18 2 L32 8 Z" fill="#c9a84c" stroke="#e8c96a" stroke-width="1.5"/>
            <path d="M18 40 L7 10 L18 5 L29 10 Z" fill="#b8942f"/>
            <circle cx="18" cy="6" r="4" fill="#e8c96a"/>
            <circle cx="18" cy="6" r="2" fill="#0f0d0b"/>
        </svg>
    </div>
    <div class="wheel-outer" id="wheelOuter">
        <div class="wheel-inner idle" id="wheelInner"></div>
    </div>
</div>

<div class="result" id="resultArea">
    <div class="result-label">Your destiny awaits</div>
    <div class="result-text" id="resultText">Press the button to spin</div>
</div>

<button class="btn btn-primary" id="spinBtn" onclick="spin()">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15v-4H7l5-7v4l-5 7h4z"/></svg>
    Spin
</button>

<div class="spin-dots" id="spinDots">
    <div class="spin-dot"></div>
    <div class="spin-dot"></div>
    <div class="spin-dot"></div>
</div>

<div class="options-section">
    <div class="section-title">Options on the wheel</div>
    <div class="options-list" id="optionsList"></div>
    <div class="add-option">
        <input type="text" id="newOptionInput" placeholder="Add a new option..." maxlength="60" onkeydown="if(event.key==='Enter')addOption()">
        <button onclick="addOption()">Add</button>
    </div>
</div>

<div class="history-section">
    <div class="section-title">Recent spins</div>
    <div class="history-list" id="historyList"></div>
</div>

<div class="credit">
    Inspired by Jon's <a href="https://jona.ca/2005/05/emailing-random-contact-plus-webapp.html" target="_blank">randomization system</a>
</div>

<script>
    // Segments (max 8 for the wheel)
    const PALETTE = [
        '#c94040', // red
        '#3aa8a0', // teal
        '#c9a84c', // gold
        '#7a5ca0', // purple
        '#4080c9', // blue
        '#c07040', // orange
        '#50a050', // green
        '#c940a0', // pink
    ];

    const DEFAULT_OPTIONS = [
        'Email a random contact',
        'Read The Pragmatic Programmer',
        'Read Osbourne World History',
        'Read Nonviolent Communication',
    ];

    let options = JSON.parse(localStorage.getItem('decideomatic_options') || 'null') || [...DEFAULT_OPTIONS];
    let history = JSON.parse(localStorage.getItem('decideomatic_history') || '[]');
    let isSpinning = false;
    let currentRotation = 0;

    function getColors(n) {
        const colors = [];
        for (let i = 0; i < n; i++) {
            colors.push(PALETTE[i % PALETTE.length]);
        }
        return colors;
    }

    function buildWheel() {
        const inner = document.getElementById('wheelInner');
        const n = options.length;
        const colors = getColors(n);
        const anglePer = 360 / n;
        const halfAngle = anglePer / 2;

        inner.innerHTML = '';

        for (let i = 0; i < n; i++) {
            const seg = document.createElement('div');
            seg.className = 'segment';
            seg.style.background = colors[i];
            seg.style.transform = `rotate(${i * anglePer}deg) skewY(${-(90 - anglePer)}deg)`;

            const text = document.createElement('div');
            text.className = 'segment-text';
            text.textContent = options[i];
            text.style.transform = `skewY(${90 - anglePer}deg) rotate(${halfAngle}deg)`;
            text.style.top = '28%';
            text.style.left = '6%';
            text.style.width = `calc(${100 / n}% * 1.8)`;
            text.style.textAlign = 'center';

            seg.appendChild(text);
            inner.appendChild(seg);
        }
    }

    function renderOptions() {
        const list = document.getElementById('optionsList');
        list.innerHTML = '';
        options.forEach((opt, i) => {
            const item = document.createElement('div');
            item.className = 'option-item';
            item.onclick = () => toggleActive(i);

            const dot = document.createElement('div');
            dot.className = 'option-dot';
            dot.style.background = PALETTE[i % PALETTE.length];

            const name = document.createElement('div');
            name.className = 'option-name';
            name.textContent = opt;

            const rm = document.createElement('button');
            rm.className = 'option-remove';
            rm.textContent = 'x';
            rm.onclick = (e) => { e.stopPropagation(); removeOption(i); };

            item.appendChild(dot);
            item.appendChild(name);
            item.appendChild(rm);
            list.appendChild(item);
        });
    }

    function renderHistory() {
        const list = document.getElementById('historyList');
        list.innerHTML = '';
        history.slice(0, 8).forEach(item => {
            const el = document.createElement('div');
            el.className = 'history-item';
            el.innerHTML = `<span class="time">${item.time}</span><span class="choice">${item.choice}</span>`;
            list.appendChild(el);
        });
    }

    function addOption() {
        const input = document.getElementById('newOptionInput');
        const val = input.value.trim();
        if (!val || options.length >= 8) return;
        options.push(val);
        localStorage.setItem('decideomatic_options', JSON.stringify(options));
        input.value = '';
        buildWheel();
        renderOptions();
    }

    function removeOption(i) {
        if (options.length <= 2) return;
        options.splice(i, 1);
        localStorage.setItem('decideomatic_options', JSON.stringify(options));
        buildWheel();
        renderOptions();
    }

    function toggleActive(i) {
        // not used for toggle right now
    }

    function spin() {
        if (isSpinning || options.length < 2) return;
        isSpinning = true;
        const btn = document.getElementById('spinBtn');
        const inner = document.getElementById('wheelInner');
        const outer = document.getElementById('wheelOuter');
        const dots = document.getElementById('spinDots');
        const resultText = document.getElementById('resultText');

        btn.disabled = true;
        resultText.classList.remove('show');
        resultText.textContent = 'Spinning...';
        inner.classList.remove('idle');
        inner.classList.add('spinning');
        outer.classList.add('lit');
        dots.classList.add('show');

        // Number of wheel segments
        const n = options.length;
        // Each segment = 360/n degrees. Pick a random final position.
        // We want a random winning segment, so compute targetRotation.
        const segmentAngle = 360 / n;
        // Random winning index
        const winIdx = Math.floor(Math.random() * n);
        // Spin 3-6 full rotations plus bring winning segment to top (0 degrees = top)
        // The pointer is at the TOP. To land segment i at top, wheel must rotate:
        // The i-th segment is centered at angle = i * segmentAngle + segmentAngle/2 from start.
        // We want this to be at 0 degrees (top), so wheel rotation = -centroidAngle mod 360.
        const centroidAngle = winIdx * segmentAngle + segmentAngle / 2;
        const fullSpins = 4 + Math.random() * 2; // 4-6 full spins
        const totalRotation = currentRotation + (fullSpins * 360) + (360 - centroidAngle) + (Math.random() - 0.5) * segmentAngle * 0.6;

        inner.style.transform = `rotate(${totalRotation}deg)`;
        currentRotation = totalRotation;

        // Show result after spin
        setTimeout(() => {
            isSpinning = false;
            btn.disabled = false;
            inner.classList.remove('spinning');
            inner.classList.add('idle');
            outer.classList.remove('lit');
            outer.classList.add('idle-lit');
            dots.classList.remove('show');

            const winner = options[winIdx];
            resultText.textContent = winner;
            resultText.classList.add('show');

            // Add to history
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
            history.unshift({ time: timeStr, choice: winner });
            if (history.length > 20) history.pop();
            localStorage.setItem('decideomatic_history', JSON.stringify(history));
            renderHistory();
        }, 5200);
    }

    // Initialize
    buildWheel();
    renderOptions();
    renderHistory();
</script>

</body>
</html>