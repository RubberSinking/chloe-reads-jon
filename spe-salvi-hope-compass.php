<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Spe Salvi Hope Compass</title>
<style>
:root {
    --ink: #1e1a16;
    --parchment: #f7f2e8;
    --gold: #c4963f;
    --wine: #5b2438;
    --teal: #1f5d61;
    --night: #0e1a2b;
    --soft: #efe4cf;
}
* { box-sizing: border-box; }
body {
    margin: 0;
    color: var(--ink);
    background:
        radial-gradient(circle at 8% 12%, rgba(196,148,63,.23), transparent 22%),
        radial-gradient(circle at 88% 84%, rgba(31,93,97,.2), transparent 24%),
        linear-gradient(150deg, #fdf9f1, #f2e7d5 46%, #ead8bf 100%);
    min-height: 100vh;
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
}
.wrap {
    width: min(980px, 94vw);
    margin: 2rem auto 3rem;
}
.hero {
    background: linear-gradient(160deg, rgba(255,255,255,.78), rgba(249,236,212,.84));
    border: 1px solid rgba(91,36,56,.2);
    border-radius: 22px;
    padding: 1.2rem 1.2rem 1.5rem;
    box-shadow: 0 14px 50px rgba(38,25,5,.14);
}
h1 {
    margin: .2rem 0 .5rem;
    font-size: clamp(1.8rem, 5vw, 3rem);
    line-height: 1.03;
    letter-spacing: .01em;
    color: #341921;
}
.sub {
    margin: 0;
    font-size: clamp(.98rem, 2.8vw, 1.12rem);
    line-height: 1.45;
}
.grid {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 1rem;
}
.panel, .meter {
    background: rgba(255,255,255,.72);
    border: 1px solid rgba(30,26,22,.14);
    border-radius: 18px;
    padding: 1rem;
}
.field {
    margin: .8rem 0;
}
label {
    display: flex;
    justify-content: space-between;
    gap: .75rem;
    font-weight: 700;
    font-size: .97rem;
}
input[type="range"] {
    width: 100%;
    accent-color: var(--wine);
}
.counter {
    color: var(--teal);
    font-weight: 700;
}
.compass-wrap {
    display: grid;
    place-items: center;
    gap: .6rem;
}
#compass {
    width: min(310px, 72vw);
    aspect-ratio: 1;
    border-radius: 50%;
    background: radial-gradient(circle, #f9f0de 0%, #eed9b7 58%, #dfc196 100%);
    border: 2px solid rgba(91,36,56,.35);
    position: relative;
    overflow: hidden;
}
.ring {
    position: absolute;
    inset: 8%;
    border: 1px dashed rgba(30,26,22,.25);
    border-radius: 50%;
}
.needle {
    position: absolute;
    width: 3px;
    height: 44%;
    left: calc(50% - 1.5px);
    top: 10%;
    background: linear-gradient(var(--wine), #caa15d);
    transform-origin: 50% 90%;
    transition: transform .55s cubic-bezier(.2,.8,.2,1);
    box-shadow: 0 0 12px rgba(91,36,56,.42);
}
.dot {
    position: absolute;
    width: 14px;
    height: 14px;
    left: calc(50% - 7px);
    top: calc(50% - 7px);
    border-radius: 50%;
    background: var(--night);
    border: 2px solid #f1debb;
}
.sector {
    position: absolute;
    font-size: .82rem;
    font-weight: 700;
    color: #533a1f;
}
.s1 { top: 8%; left: 44%; }
.s2 { top: 46%; right: 7%; }
.s3 { bottom: 8%; left: 42%; }
.s4 { top: 46%; left: 7%; }
.score {
    font-size: clamp(1.3rem, 4vw, 2rem);
    font-weight: 800;
    color: var(--wine);
}
.badge {
    display: inline-block;
    padding: .3rem .65rem;
    border-radius: 999px;
    font-weight: 700;
    background: #f4e2c0;
    color: #553018;
    border: 1px solid rgba(85,48,24,.3);
}
.rule {
    margin-top: .75rem;
    background: var(--soft);
    border: 1px solid rgba(31,93,97,.2);
    border-left: 5px solid var(--teal);
    border-radius: 12px;
    padding: .85rem .8rem;
    line-height: 1.45;
}
.actions {
    margin-top: .9rem;
    display: flex;
    gap: .55rem;
    flex-wrap: wrap;
}
button {
    border: none;
    border-radius: 12px;
    padding: .62rem .9rem;
    font-weight: 700;
    cursor: pointer;
    background: #2d5f74;
    color: #fffdf9;
}
button.alt { background: #6a2a43; }
button:active { transform: translateY(1px); }
.log {
    margin-top: .9rem;
    max-height: 170px;
    overflow: auto;
    padding: .6rem;
    border-radius: 10px;
    background: rgba(255,255,255,.78);
    border: 1px solid rgba(30,26,22,.15);
    font-size: .92rem;
}
.log-item { margin: .45rem 0; padding-bottom: .45rem; border-bottom: 1px dotted rgba(30,26,22,.2); }
footer {
    margin-top: 1rem;
    font-size: .88rem;
    opacity: .82;
}
@media (max-width: 860px) {
    .grid { grid-template-columns: 1fr; }
}
</style>
</head>
<body>
<div class="wrap">
    <section class="hero">
        <h1>Spe Salvi Hope Compass</h1>
        <p class="sub">A small interactive retreat inspired by <em>Spe Salvi</em>. Tune your real day, watch your hope heading stabilize, and generate one practical "next faithful step" you can actually do today.</p>

        <div class="grid">
            <div class="panel">
                <div class="field">
                    <label>Stress Weather <span class="counter" id="stressOut">55</span></label>
                    <input id="stress" type="range" min="0" max="100" value="55">
                </div>
                <div class="field">
                    <label>Sleep Fuel <span class="counter" id="sleepOut">62</span></label>
                    <input id="sleep" type="range" min="0" max="100" value="62">
                </div>
                <div class="field">
                    <label>Prayer Minutes Today <span class="counter" id="prayerOut">18</span></label>
                    <input id="prayer" type="range" min="0" max="120" value="18">
                </div>
                <div class="field">
                    <label>Gratitude Sparks <span class="counter" id="gratOut">3</span></label>
                    <input id="gratitude" type="range" min="0" max="10" value="3">
                </div>
                <div class="actions">
                    <button id="pulseBtn">Generate Hope Pulse</button>
                    <button class="alt" id="resetBtn">Reset Day</button>
                </div>
                <div class="log" id="history"></div>
            </div>

            <div class="meter">
                <div class="compass-wrap">
                    <div id="compass">
                        <div class="ring"></div>
                        <div class="needle" id="needle"></div>
                        <div class="dot"></div>
                        <div class="sector s1">Trust</div>
                        <div class="sector s2">Courage</div>
                        <div class="sector s3">Peace</div>
                        <div class="sector s4">Patience</div>
                    </div>
                    <div class="score" id="score">0</div>
                    <div class="badge" id="state">Calibrating...</div>
                </div>
                <div class="rule" id="ruleText">Move the sliders, then generate a pulse.</div>
            </div>
        </div>

        <footer>Hint: lower stress plus one honest prayer minute often beats waiting for perfect conditions.</footer>
    </section>
</div>

<script>
const refs = {
    stress: document.getElementById('stress'),
    sleep: document.getElementById('sleep'),
    prayer: document.getElementById('prayer'),
    gratitude: document.getElementById('gratitude'),
    stressOut: document.getElementById('stressOut'),
    sleepOut: document.getElementById('sleepOut'),
    prayerOut: document.getElementById('prayerOut'),
    gratOut: document.getElementById('gratOut'),
    score: document.getElementById('score'),
    state: document.getElementById('state'),
    needle: document.getElementById('needle'),
    ruleText: document.getElementById('ruleText'),
    history: document.getElementById('history'),
    pulseBtn: document.getElementById('pulseBtn'),
    resetBtn: document.getElementById('resetBtn')
};

const plans = {
    low: [
        "Take 90 seconds in silence. Name one burden and hand it to God plainly.",
        "Drink water, stand up, then pray one slow Our Father without multitasking.",
        "Write one line beginning with: 'Today I still have hope because...'"
    ],
    medium: [
        "Choose one person to encourage by text or prayer before the hour ends.",
        "Pick one postponed task and give it a clean 12-minute effort.",
        "Do a short gratitude examen: 3 gifts, 1 sorrow, 1 next step."
    ],
    high: [
        "Use your momentum: start a 20-minute focused block on your most meaningful task.",
        "Turn your joy outward: teach Nathan one tiny thing you learned today.",
        "Offer one concrete act of service before dinner, no fanfare needed."
    ]
};

function syncCounters() {
    refs.stressOut.textContent = refs.stress.value;
    refs.sleepOut.textContent = refs.sleep.value;
    refs.prayerOut.textContent = refs.prayer.value;
    refs.gratOut.textContent = refs.gratitude.value;
}

function clamp(n, min, max) { return Math.max(min, Math.min(max, n)); }

function compute() {
    const stress = Number(refs.stress.value);
    const sleep = Number(refs.sleep.value);
    const prayer = Number(refs.prayer.value);
    const gratitude = Number(refs.gratitude.value);

    const prayerNorm = clamp(prayer / 120 * 100, 0, 100);
    const base = (sleep * 0.28) + (prayerNorm * 0.36) + (gratitude * 10 * 0.22) + ((100 - stress) * 0.14);
    const score = Math.round(clamp(base, 0, 100));

    let state = "Flickering";
    let tier = "low";
    if (score >= 70) { state = "Steady Flame"; tier = "high"; }
    else if (score >= 43) { state = "Rekindling"; tier = "medium"; }

    // Map score to compass angle: low points west-ish, high points north-ish
    const angle = -130 + (score / 100) * 260;
    refs.needle.style.transform = "rotate(" + angle + "deg)";
    refs.score.textContent = score;
    refs.state.textContent = state;

    const bank = plans[tier];
    const line = bank[Math.floor(Math.random() * bank.length)];
    refs.ruleText.textContent = line;

    const stamp = new Date().toLocaleTimeString([], {hour: "2-digit", minute: "2-digit"});
    const div = document.createElement("div");
    div.className = "log-item";
    div.textContent = stamp + " • Hope " + score + "/100 • " + state + " • " + line;
    refs.history.prepend(div);

    while (refs.history.children.length > 6) {
        refs.history.removeChild(refs.history.lastChild);
    }
}

function reset() {
    refs.stress.value = 55;
    refs.sleep.value = 62;
    refs.prayer.value = 18;
    refs.gratitude.value = 3;
    syncCounters();
    refs.score.textContent = "0";
    refs.state.textContent = "Calibrating...";
    refs.ruleText.textContent = "Move the sliders, then generate a pulse.";
    refs.needle.style.transform = "rotate(0deg)";
    refs.history.innerHTML = "";
}

for (const id of ["stress", "sleep", "prayer", "gratitude"]) {
    refs[id].addEventListener("input", syncCounters);
}
refs.pulseBtn.addEventListener("click", compute);
refs.resetBtn.addEventListener("click", reset);
syncCounters();
</script>
</body>
</html>
