<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KITT Dashboard</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Orbitron:wght@400;700;900&display=swap');

    * { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --kitt-red: #ff2200;
      --kitt-red-glow: #ff4422;
      --kitt-dark: #0a0a0a;
      --kitt-panel: #111118;
      --kitt-border: #222233;
      --kitt-amber: #ffaa00;
      --kitt-green: #00ff88;
      --kitt-blue: #00ccff;
      --scan-line: rgba(255,34,0,0.08);
    }

    body {
      background: var(--kitt-dark);
      color: #ddd;
      font-family: 'Share Tech Mono', monospace;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Scanlines overlay */
    body::before {
      content: '';
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        var(--scan-line) 2px,
        var(--scan-line) 4px
      );
      pointer-events: none;
      z-index: 1000;
    }

    /* CRT vignette */
    body::after {
      content: '';
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: radial-gradient(ellipse at center, transparent 60%, rgba(0,0,0,0.6) 100%);
      pointer-events: none;
      z-index: 999;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 16px;
    }

    /* Header */
    header {
      text-align: center;
      padding: 20px 0 10px;
      position: relative;
    }

    .kitt-logo {
      font-family: 'Orbitron', sans-serif;
      font-weight: 900;
      font-size: clamp(1.8rem, 6vw, 3rem);
      color: var(--kitt-red);
      text-shadow:
        0 0 10px var(--kitt-red),
        0 0 30px rgba(255,34,0,0.5),
        0 0 60px rgba(255,34,0,0.3);
      letter-spacing: 8px;
      animation: kitt-glow 3s ease-in-out infinite alternate;
    }

    .kitt-logo span {
      color: var(--kitt-amber);
      text-shadow: 0 0 10px var(--kitt-amber), 0 0 30px rgba(255,170,0,0.5);
    }

    @keyframes kitt-glow {
      from { text-shadow: 0 0 10px var(--kitt-red), 0 0 30px rgba(255,34,0,0.5); }
      to { text-shadow: 0 0 20px var(--kitt-red), 0 0 50px rgba(255,34,0,0.8), 0 0 80px rgba(255,34,0,0.4); }
    }

    .subtitle {
      color: #666;
      font-size: 0.75rem;
      letter-spacing: 4px;
      margin-top: 6px;
      text-transform: uppercase;
    }

    /* Scanner bar */
    .scanner-wrap {
      margin: 20px auto;
      max-width: 500px;
      position: relative;
    }

    .scanner-track {
      height: 40px;
      background: #0d0d15;
      border: 2px solid var(--kitt-border);
      border-radius: 8px;
      overflow: hidden;
      position: relative;
      box-shadow: inset 0 0 20px rgba(0,0,0,0.8), 0 0 10px rgba(255,34,0,0.2);
    }

    .scanner-lights {
      display: flex;
      height: 100%;
      gap: 0;
    }

    .scanner-light {
      flex: 1;
      background: #1a0000;
      transition: background 0.08s;
      position: relative;
    }

    .scanner-light.active {
      background: var(--kitt-red);
      box-shadow: 0 0 12px var(--kitt-red), 0 0 24px var(--kitt-red-glow);
    }

    .scanner-beam {
      position: absolute;
      top: 0; bottom: 0;
      width: 16.6%;
      background: linear-gradient(90deg, transparent, var(--kitt-red-glow), var(--kitt-red), var(--kitt-red-glow), transparent);
      box-shadow: 0 0 15px var(--kitt-red), 0 0 30px var(--kitt-red);
      opacity: 0;
      transition: opacity 0.2s;
      border-radius: 4px;
    }

    .scanner-wrap.scanning .scanner-beam {
      opacity: 1;
      animation: scan-across 1.4s linear infinite;
    }

    @keyframes scan-across {
      0% { left: 0%; }
      100% { left: 83.4%; }
    }

    .scanner-label {
      text-align: center;
      color: #444;
      font-size: 0.65rem;
      letter-spacing: 3px;
      margin-top: 6px;
      text-transform: uppercase;
    }

    /* Dashboard panels */
    .dashboard {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin-top: 16px;
    }

    @media (max-width: 600px) {
      .dashboard { grid-template-columns: 1fr; }
    }

    .panel {
      background: var(--kitt-panel);
      border: 1px solid var(--kitt-border);
      border-radius: 8px;
      padding: 14px;
      position: relative;
      overflow: hidden;
    }

    .panel::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 1px;
      background: linear-gradient(90deg, transparent, rgba(255,34,0,0.4), transparent);
    }

    .panel-title {
      font-size: 0.6rem;
      letter-spacing: 3px;
      color: #444;
      text-transform: uppercase;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .panel-title::before {
      content: '';
      width: 6px; height: 6px;
      background: var(--kitt-red);
      border-radius: 50%;
      box-shadow: 0 0 6px var(--kitt-red);
      animation: blink-dot 2s ease-in-out infinite;
    }

    @keyframes blink-dot {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.3; }
    }

    /* Mission panel */
    .mission-panel {
      grid-column: 1 / -1;
    }

    .mission-title {
      font-family: 'Orbitron', sans-serif;
      font-size: 0.9rem;
      color: var(--kitt-amber);
      text-shadow: 0 0 8px rgba(255,170,0,0.5);
      margin-bottom: 8px;
    }

    .mission-text {
      font-size: 0.75rem;
      color: #888;
      line-height: 1.5;
      min-height: 36px;
    }

    /* KITT response */
    .kitt-response {
      background: #080810;
      border: 1px solid #1a1a2a;
      border-radius: 6px;
      padding: 12px;
      font-size: 0.8rem;
      line-height: 1.6;
      color: #ccc;
      min-height: 60px;
      font-style: italic;
      margin-top: 8px;
    }

    .kitt-response .kitt-voice {
      color: var(--kitt-amber);
      font-style: normal;
      font-weight: bold;
    }

    /* Status displays */
    .status-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px;
    }

    .status-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .status-label {
      font-size: 0.55rem;
      letter-spacing: 2px;
      color: #444;
      text-transform: uppercase;
    }

    .status-bar-wrap {
      height: 8px;
      background: #0a0a12;
      border-radius: 4px;
      overflow: hidden;
      border: 1px solid #1a1a2a;
    }

    .status-bar {
      height: 100%;
      border-radius: 3px;
      transition: width 0.8s ease;
      position: relative;
    }

    .status-bar.speed { background: linear-gradient(90deg, #00ff88, #00ffcc); box-shadow: 0 0 6px #00ff88; }
    .status-bar.power { background: linear-gradient(90deg, #ffaa00, #ffcc00); box-shadow: 0 0 6px var(--kitt-amber); }
    .status-bar.armor { background: linear-gradient(90deg, #00ccff, #0088ff); box-shadow: 0 0 6px var(--kitt-blue); }
    .status-bar.scanner { background: linear-gradient(90deg, var(--kitt-red), #ff4400); box-shadow: 0 0 6px var(--kitt-red); }

    .status-value {
      font-size: 0.65rem;
      color: #666;
      margin-top: 2px;
      font-family: 'Orbitron', sans-serif;
    }

    /* Voice command input */
    .voice-input {
      width: 100%;
      background: #080810;
      border: 1px solid #2a2a3a;
      border-radius: 6px;
      padding: 12px 14px;
      color: var(--kitt-green);
      font-family: 'Share Tech Mono', monospace;
      font-size: 0.9rem;
      outline: none;
      resize: none;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .voice-input:focus {
      border-color: var(--kitt-red);
      box-shadow: 0 0 12px rgba(255,34,0,0.2), inset 0 0 20px rgba(0,0,0,0.5);
    }

    .voice-input::placeholder { color: #333; }

    .input-row {
      display: flex;
      gap: 10px;
      margin-top: 8px;
      align-items: center;
    }

    .btn {
      font-family: 'Share Tech Mono', monospace;
      font-size: 0.75rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 10px 18px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .btn-primary {
      background: var(--kitt-red);
      color: #fff;
      box-shadow: 0 0 12px rgba(255,34,0,0.4);
    }

    .btn-primary:hover {
      background: #ff3300;
      box-shadow: 0 0 20px rgba(255,34,0,0.7);
      transform: translateY(-1px);
    }

    .btn-primary:active { transform: translateY(0); }

    .btn-secondary {
      background: #1a1a2a;
      color: #666;
      border: 1px solid #2a2a3a;
    }

    .btn-secondary:hover { border-color: #444; color: #999; }

    /* Speed animation */
    .speed-lines {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      pointer-events: none;
      z-index: 5;
      overflow: hidden;
    }

    .speed-lines.active { display: block; }

    .speed-line {
      position: absolute;
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(255,170,0,0.6), transparent);
      animation: speed-streak 0.4s linear infinite;
      border-radius: 2px;
    }

    @keyframes speed-streak {
      from { transform: translateX(100vw); }
      to { transform: translateX(-100px); }
    }

    /* Quick commands */
    .quick-commands {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 8px;
    }

    .quick-cmd {
      background: #0d0d18;
      border: 1px solid #2a2a3a;
      color: #555;
      font-family: 'Share Tech Mono', monospace;
      font-size: 0.65rem;
      padding: 5px 10px;
      border-radius: 4px;
      cursor: pointer;
      letter-spacing: 1px;
      transition: all 0.2s;
    }

    .quick-cmd:hover {
      border-color: var(--kitt-red);
      color: var(--kitt-red);
      box-shadow: 0 0 8px rgba(255,34,0,0.2);
    }

    /* Mission log */
    .mission-log {
      max-height: 120px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-top: 8px;
      scrollbar-width: thin;
      scrollbar-color: #222 #080810;
    }

    .mission-log::-webkit-scrollbar { width: 4px; }
    .mission-log::-webkit-scrollbar-track { background: #080810; }
    .mission-log::-webkit-scrollbar-thumb { background: #333; border-radius: 2px; }

    .log-entry {
      font-size: 0.65rem;
      padding: 4px 8px;
      border-radius: 3px;
      background: #0a0a12;
      border-left: 2px solid #222;
      color: #555;
      line-height: 1.4;
      animation: log-in 0.3s ease;
    }

    @keyframes log-in {
      from { opacity: 0; transform: translateX(-8px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .log-entry.kitt { border-left-color: var(--kitt-amber); color: #999; }
    .log-entry.action { border-left-color: var(--kitt-green); }
    .log-entry.alert { border-left-color: var(--kitt-red); color: #cc5533; }

    /* Turboboost button */
    .turboboost-btn {
      position: relative;
      overflow: hidden;
    }

    .turboboost-btn::after {
      content: '';
      position: absolute;
      top: -50%; left: -50%;
      width: 200%; height: 200%;
      background: radial-gradient(circle, rgba(255,170,0,0.3) 0%, transparent 60%);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .turboboost-btn:hover::after { opacity: 1; }

    /* Alert overlay */
    .alert-overlay {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(255,0,0,0.08);
      pointer-events: none;
      z-index: 998;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .alert-overlay.flash {
      animation: alert-flash 0.3s ease 2;
    }

    @keyframes alert-flash {
      0%, 100% { opacity: 0; }
      50% { opacity: 1; }
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 24px 0 40px;
      font-size: 0.6rem;
      color: #333;
      letter-spacing: 2px;
    }

    footer a { color: #444; text-decoration: none; }
    footer a:hover { color: var(--kitt-red); }

    /* Intro animation */
    .boot-screen {
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: var(--kitt-dark);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 2000;
      transition: opacity 1s ease;
    }

    .boot-screen.fade-out {
      opacity: 0;
      pointer-events: none;
    }

    .boot-logo {
      font-family: 'Orbitron', sans-serif;
      font-size: 2rem;
      color: var(--kitt-red);
      text-shadow: 0 0 20px var(--kitt-red);
      letter-spacing: 12px;
      animation: boot-pulse 1s ease-in-out infinite alternate;
    }

    @keyframes boot-pulse {
      from { opacity: 0.5; }
      to { opacity: 1; }
    }

    .boot-text {
      margin-top: 20px;
      font-size: 0.7rem;
      color: #444;
      letter-spacing: 3px;
    }

    .boot-progress {
      margin-top: 12px;
      width: 200px;
      height: 3px;
      background: #1a1a2a;
      border-radius: 2px;
      overflow: hidden;
    }

    .boot-progress-bar {
      height: 100%;
      background: var(--kitt-red);
      box-shadow: 0 0 8px var(--kitt-red);
      animation: boot-load 2s ease-in-out forwards;
    }

    @keyframes boot-load {
      0% { width: 0%; }
      60% { width: 80%; }
      100% { width: 100%; }
    }

    /* Mini chase game */
    .chase-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.85);
      z-index: 500;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .chase-overlay.active { display: flex; }

    .chase-canvas {
      border: 2px solid #222;
      border-radius: 8px;
      background: #050510;
      max-width: 100%;
    }

    .chase-hud {
      margin-top: 12px;
      display: flex;
      gap: 24px;
      font-size: 0.75rem;
      color: var(--kitt-amber);
    }

    .chase-instructions {
      margin-top: 10px;
      font-size: 0.65rem;
      color: #444;
      letter-spacing: 2px;
    }
  </style>
</head>
<body>

<!-- Boot screen -->
<div class="boot-screen" id="bootScreen">
  <div class="boot-logo">KITT</div>
  <div class="boot-text">INITIALIZING SYSTEMS...</div>
  <div class="boot-progress"><div class="boot-progress-bar"></div></div>
</div>

<!-- Speed lines for chase mode -->
<div class="speed-lines" id="speedLines"></div>

<!-- Alert overlay -->
<div class="alert-overlay" id="alertOverlay"></div>

<!-- Chase game overlay -->
<div class="chase-overlay" id="chaseOverlay">
  <canvas class="chase-canvas" id="chaseCanvas" width="700" height="300"></canvas>
  <div class="chase-hud">
    <span>SCORE: <span id="chaseScore">0</span></span>
    <span>HP: <span id="chaseHP">3</span></span>
    <span>SPEED: <span id="chaseSpeed">0</span> MPH</span>
  </div>
  <div class="chase-instructions">← → to dodge | SPACE to turbo boost</div>
</div>

<div class="container">
  <header>
    <div class="kitt-logo">K<span>I</span>TT</div>
    <div class="subtitle">Knight Industries Two Thousand // Interactive Dashboard</div>
  </header>

  <!-- Scanner bar -->
  <div class="scanner-wrap" id="scannerWrap">
    <div class="scanner-track">
      <div class="scanner-lights" id="scannerLights"></div>
      <div class="scanner-beam" id="scannerBeam"></div>
    </div>
    <div class="scanner-label">Front Scanner Array</div>
  </div>

  <!-- Dashboard -->
  <div class="dashboard">

    <!-- Mission Panel -->
    <div class="panel mission-panel">
      <div class="panel-title">Mission Briefing</div>
      <div class="mission-title" id="missionTitle">Waiting for mission...</div>
      <div class="mission-text" id="missionText">KITT is online and ready. Select a mission or ask KITT anything.</div>
      <div class="kitt-response" id="kittResponse">
        <span class="kitt-voice">KITT:</span> Hello, Michael. I am KITT. My sensors are fully operational. How may I assist you today?
      </div>
    </div>

    <!-- Status Panel -->
    <div class="panel">
      <div class="panel-title">Systems Status</div>
      <div class="status-grid">
        <div class="status-item">
          <div class="status-label">Speed</div>
          <div class="status-bar-wrap"><div class="status-bar speed" id="speedBar" style="width:0%"></div></div>
          <div class="status-value" id="speedVal">0 MPH</div>
        </div>
        <div class="status-item">
          <div class="status-label">Power</div>
          <div class="status-bar-wrap"><div class="status-bar power" id="powerBar" style="width:92%"></div></div>
          <div class="status-value" id="powerVal">92%</div>
        </div>
        <div class="status-item">
          <div class="status-label">Armor</div>
          <div class="status-bar-wrap"><div class="status-bar armor" id="armorBar" style="width:100%"></div></div>
          <div class="status-value" id="armorVal">100%</div>
        </div>
        <div class="status-item">
          <div class="status-label">Scanner</div>
          <div class="status-bar-wrap"><div class="status-bar scanner" id="scannerBar" style="width:100%"></div></div>
          <div class="status-value" id="scannerVal">Active</div>
        </div>
      </div>
    </div>

    <!-- Quick Commands -->
    <div class="panel">
      <div class="panel-title">Quick Commands</div>
      <div class="quick-commands">
        <button class="quick-cmd" onclick="sendCommand('KITT, status report')">Status</button>
        <button class="quick-cmd" onclick="sendCommand('Analyze the area')">Analyze</button>
        <button class="quick-cmd" onclick="sendCommand('Turbo boost!')">Turbo Boost</button>
        <button class="quick-cmd" onclick="sendCommand('Activate pursuit mode')">Pursuit Mode</button>
        <button class="quick-cmd" onclick="sendCommand('Open missile bay doors')">Weapons</button>
        <button class="quick-cmd" onclick="sendCommand('Tell me about your processors')">About KITT</button>
        <button class="quick-cmd" onclick="sendCommand('Find the nearest road')">Find Road</button>
        <button class="quick-cmd" onclick="startChase()">Start Chase</button>
      </div>
    </div>

    <!-- Voice Command -->
    <div class="panel" style="grid-column:1/-1">
      <div class="panel-title">Voice Command Interface</div>
      <textarea class="voice-input" id="voiceInput" rows="2" placeholder="Type a command for KITT... e.g. 'KITT, what is our current mission?'"></textarea>
      <div class="input-row">
        <button class="btn btn-primary" onclick="handleSend()">Transmit</button>
        <button class="btn btn-secondary" onclick="clearLog()">Clear Log</button>
        <button class="btn btn-secondary turboboost-btn" onclick="sendCommand('Engage turboboost sequence')">Turboboost</button>
      </div>
    </div>

    <!-- Mission Log -->
    <div class="panel" style="grid-column:1/-1">
      <div class="panel-title">Mission Log</div>
      <div class="mission-log" id="missionLog">
        <div class="log-entry">System initialized. All modules online.</div>
      </div>
    </div>

  </div>

  <footer>
    <a href="index.php">Chloe Reads Jon</a> // KITT Dashboard Simulator // Inspired by Jon and Nathan's love of 80s action
  </footer>
</div>

<script>
  // Build scanner lights
  const scannerLights = document.getElementById('scannerLights');
  for (let i = 0; i < 6; i++) {
    scannerLights.innerHTML += '<div class="scanner-light" id="light' + i + '"></div>';
  }

  // Scanner animation
  let scanPos = 0;
  let scanDir = 1;
  const SCAN_STATES = [1,0,0,0,0,0];
  function animateScanner() {
    document.getElementById('light0').classList.toggle('active', scanPos === 0);
    document.getElementById('light1').classList.toggle('active', scanPos === 1);
    document.getElementById('light2').classList.toggle('active', scanPos === 2);
    document.getElementById('light3').classList.toggle('active', scanPos === 3);
    document.getElementById('light4').classList.toggle('active', scanPos === 4);
    document.getElementById('light5').classList.toggle('active', scanPos === 5);
    scanPos += scanDir;
    if (scanPos === 5) scanDir = -1;
    if (scanPos === 0) scanDir = 1;
  }
  setInterval(animateScanner, 200);

  // Status bars animation
  let currentSpeed = 0;
  let currentPower = 92;
  let targetSpeed = 0;

  function animateStatus() {
    if (currentSpeed < targetSpeed) {
      currentSpeed = Math.min(currentSpeed + 3, targetSpeed);
    } else if (currentSpeed > targetSpeed) {
      currentSpeed = Math.max(currentSpeed - 5, targetSpeed);
    }
    document.getElementById('speedBar').style.width = Math.min(currentSpeed / 3, 100) + '%';
    document.getElementById('speedVal').textContent = Math.round(currentSpeed) + ' MPH';
    document.getElementById('powerBar').style.width = currentPower + '%';
    document.getElementById('powerVal').textContent = Math.round(currentPower) + '%';
    document.getElementById('scannerBar').style.width = '100%';
  }
  setInterval(animateStatus, 100);

  // KITT responses
  const responses = {
    'status': [
      "All primary systems are functioning within normal parameters. My microprocessors are running at optimal efficiency. Shall I run a full diagnostic?",
      "Power levels are stable at 92%. Speed capability is unlimited. I have 47 terabytes of memory available. We are ready for action, Michael.",
      "Systems nominal. The turbojet engine is purring like a kitten... a very fast, very dangerous kitten."
    ],
    'analyze': [
      "Scanning the environment... I detect multiple vehicles, several structures, and atmospheric conditions optimal for pursuit. No threats within immediate range.",
      "Analyzing... terrain is mostly flat with moderate traffic density. Optimal escape routes are available. I have plotted 14 possible paths.",
      "I am reading several heat signatures nearby. The road ahead is clear for approximately 2.3 miles. I recommend we proceed with caution."
    ],
    'turboboost': [
      "Turbo boost sequence initiated! Brace yourself, Michael! Fuel injection at maximum! I am now capable of 0 to 200 miles per hour in 2.8 seconds!",
      "WARNING: Turbo boost engaged! Hold on tight! This will be exhilarating! Maximum thrust achieved!",
      "Turbo boost parameters exceeded! I have just registered 212 miles per hour! The world is a blur, Michael!"
    ],
    'pursuit': [
      "Pursuit mode activated. All defensive systems are armed. I am now in maximum alert status. Scanning for hostiles...",
      "Switching to pursuit configuration. Suspensor bars locked. Front armor deployed. I am ready for any eventuality.",
      "Pursuit mode engaged. My scanner array is working overtime. I will detect any threat long before it detects us."
    ],
    'weapons': [
      "Michael, I must advise against unnecessary aggression. However, my oil slicks, smoke screens, and tire shredders are ready if required.",
      "All weapon systems are armed and ready. But I hope it doesn't come to that. Violence is never the first answer.",
      "The missile bay doors are sealed tight. I have enough firepower here to level a small building, but let's hope it doesn't come to that."
    ],
    'about': [
      "I am the Knight Industries Two Thousand. I was built by Knight Industries with an advanced microprocessor that gives me human-like reasoning. I cost $12 million in 1982 dollars. I am indestructible... well, almost.",
      "My brain is a microprocessor with 47 terabytes of memory. I can process information at incredible speeds. I am the world's first artificial intelligence with true human-like consciousness.",
      "I have titanium alloy armor, a turbojet engine, and enough sensors to map an entire city in seconds. I am, quite possibly, the most sophisticated computer ever created."
    ],
    'findroad': [
      "Mapping your current position... I have found the optimal route. Highway 5 is clear for the next 47 miles. I am plotting our course now.",
      "I am scanning for the nearest road. According to my GPS, there is a clear highway 3.2 miles to the north. Shall I navigate us there?",
      "Road located. I estimate we can reach speeds of 180 miles per hour within 8 seconds of reaching open highway. The road ahead is yours, Michael."
    ],
    'default': [
      "I understand, Michael. Processing your request now.",
      "An interesting thought. Let me analyze that and get back to you.",
      "I am always here to help. What else can I do for you?",
      "I appreciate your inquiry. My sensors indicate that your request is being handled with priority.",
      "Michael, your wish is my command. Executing now.",
    ]
  };

  const missions = [
    {
      title: "Operation Night Rider",
      text: "Devious criminals have stolen a prototype microchip from a government facility. They are heading north on Route 17. KITT, we need to intercept them before they reach the border."
    },
    {
      title: "The Haunted Highway",
      text: "Reports have come in of strange vehicles appearing and disappearing on the old highway at midnight. Someone is using it for illegal street races. We need to find out who's behind it."
    },
    {
      title: "Rescue at Devil's Pass",
      text: "A distress signal was received from Devil's Pass. A fellow driver may be in trouble. KITT, plot the fastest route and let's see what we're dealing with."
    },
    {
      title: "The Counterfeit Ring",
      text: "An organized crime ring is flooding the city with counterfeit auto parts. We have a lead that their warehouse is on the waterfront. Time to go undercover."
    },
    {
      title: "Highway Vigilante",
      text: "Someone is taking the law into their own hands on the interstate, forcing other drivers off the road. We need to identify this vigilante before someone gets hurt."
    }
  ];

  const log = document.getElementById('missionLog');
  const responseEl = document.getElementById('kittResponse');
  const missionTitleEl = document.getElementById('missionTitle');
  const missionTextEl = document.getElementById('missionText');
  const scannerWrap = document.getElementById('scannerWrap');
  const alertOverlay = document.getElementById('alertOverlay');

  function getResponse(cmd) {
    const lower = cmd.toLowerCase();
    if (lower.includes('status') || lower.includes('systems') || lower.includes('how are')) {
      return responses.status[Math.floor(Math.random() * responses.status.length)];
    }
    if (lower.includes('analyze') || lower.includes('scan') || lower.includes('detect')) {
      return responses.analyze[Math.floor(Math.random() * responses.analyze.length)];
    }
    if (lower.includes('turbo') || lower.includes('boost') || lower.includes('speed') || lower.includes('fast')) {
      targetSpeed = 180 + Math.random() * 40;
      setTimeout(() => { targetSpeed = 80; }, 4000);
      scannerWrap.classList.add('scanning');
      setTimeout(() => scannerWrap.classList.remove('scanning'), 3000);
      return responses.turboboost[Math.floor(Math.random() * responses.turboboost.length)];
    }
    if (lower.includes('pursuit') || lower.includes('chase') || lower.includes('attack')) {
      targetSpeed = 120;
      alertOverlay.classList.add('flash');
      setTimeout(() => alertOverlay.classList.remove('flash'), 600);
      return responses.pursuit[Math.floor(Math.random() * responses.pursuit.length)];
    }
    if (lower.includes('missile') || lower.includes('weapon') || lower.includes('arm')) {
      return responses.weapons[Math.floor(Math.random() * responses.weapons.length)];
    }
    if (lower.includes('processor') || lower.includes('brain') || lower.includes('about you') || lower.includes('who are you')) {
      return responses.about[Math.floor(Math.random() * responses.about.length)];
    }
    if (lower.includes('road') || lower.includes('route') || lower.includes('navigate') || lower.includes('map')) {
      return responses.findroad[Math.floor(Math.random() * responses.findroad.length)];
    }
    return responses.default[Math.floor(Math.random() * responses.default.length)];
  }

  function addLog(text, type = 'action') {
    const entry = document.createElement('div');
    entry.className = 'log-entry ' + type;
    entry.textContent = '> ' + text;
    log.insertBefore(entry, log.firstChild);
    if (log.children.length > 30) log.removeChild(log.lastChild);
  }

  function sendCommand(cmd) {
    const input = document.getElementById('voiceInput');
    const display = cmd || input.value.trim();
    if (!display) return;

    addLog('YOU: ' + display, 'action');
    input.value = '';

    const response = getResponse(display);
    responseEl.innerHTML = '<span class="kitt-voice">KITT:</span> ' + response;
    addLog('KITT: ' + response, 'kitt');

    if (display.toLowerCase().includes('turbo')) {
      addLog('Turbo boost activated! Engine at maximum!', 'alert');
    }
    if (display.toLowerCase().includes('pursuit')) {
      addLog('Pursuit mode engaged. Defensive systems armed.', 'alert');
    }
  }

  function clearLog() {
    log.innerHTML = '<div class="log-entry">Log cleared.</div>';
    responseEl.innerHTML = '<span class="kitt-voice">KITT:</span> Log has been cleared, Michael. We are ready to begin fresh.';
    addLog('Mission log cleared by user.', 'action');
  }

  function startChase() {
    addLog('Initiating chase sequence...', 'alert');
    targetSpeed = 140;
    startChaseGame();
  }

  function selectMission() {
    const m = missions[Math.floor(Math.random() * missions.length)];
    missionTitleEl.textContent = m.title;
    missionTextEl.textContent = m.text;
    responseEl.innerHTML = '<span class="kitt-voice">KITT:</span> I have uploaded the mission parameters, Michael. ' + m.text.substring(0, 80) + '...';
    addLog('New mission received: ' + m.title, 'alert');
  }

  // Keyboard shortcut
  document.getElementById('voiceInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      handleSend();
    }
  });

  function handleSend() {
    const input = document.getElementById('voiceInput');
    sendCommand(input.value.trim());
    input.value = '';
  }

  // Boot sequence
  setTimeout(() => {
    document.getElementById('bootScreen').classList.add('fade-out');
    setTimeout(() => {
      document.getElementById('bootScreen').style.display = 'none';
      addLog('KITT systems fully online. Welcome back, Michael.', 'kitt');
      selectMission();
    }, 1000);
  }, 2500);

  // Build speed lines
  const speedLines = document.getElementById('speedLines');
  for (let i = 0; i < 20; i++) {
    const line = document.createElement('div');
    line.className = 'speed-line';
    line.style.top = Math.random() * 100 + '%';
    line.style.width = (50 + Math.random() * 150) + 'px';
    line.style.animationDuration = (0.2 + Math.random() * 0.3) + 's';
    line.style.animationDelay = (Math.random() * 0.4) + 's';
    speedLines.appendChild(line);
  }

  // Chase game
  let chaseRunning = false;
  let carX = 350, carY = 220;
  let enemyCars = [];
  let obstacles = [];
  let chaseScore = 0;
  let chaseHP = 3;
  let chaseKeys = {};
  let chaseSpeed = 0;
  let turboFuel = 100;
  let lastChaseFrame = 0;
  let animFrameId = null;

  function startChaseGame() {
    const overlay = document.getElementById('chaseOverlay');
    overlay.classList.add('active');
    chaseRunning = true;
    carX = 350; carY = 220;
    enemyCars = [];
    obstacles = [];
    chaseScore = 0;
    chaseHP = 3;
    turboFuel = 100;
    chaseKeys = {};
    document.getElementById('chaseScore').textContent = '0';
    document.getElementById('chaseHP').textContent = '3';
    lastChaseFrame = performance.now();
    chaseLoop();
  }

  function endChase() {
    chaseRunning = false;
    document.getElementById('chaseOverlay').classList.remove('active');
    if (animFrameId) cancelAnimationFrame(animFrameId);
    targetSpeed = 0;
    addLog('Chase complete! Score: ' + chaseScore + ' points.', 'action');
    alertOverlay.classList.add('flash');
    setTimeout(() => alertOverlay.classList.remove('flash'), 600);
  }

  function chaseLoop() {
    if (!chaseRunning) return;
    const now = performance.now();
    const dt = Math.min((now - lastChaseFrame) / 16.67, 3);
    lastChaseFrame = now;

    const canvas = document.getElementById('chaseCanvas');
    const ctx = canvas.getContext('2d');
    const W = canvas.width, H = canvas.height;

    // Draw road
    ctx.fillStyle = '#0a0a14';
    ctx.fillRect(0, 0, W, H);

    // Road markings
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 2;
    ctx.setLineDash([30, 20]);
    for (let i = 0; i < 5; i++) {
      ctx.beginPath();
      ctx.moveTo(W/2 + (i-2)*20, 0);
      ctx.lineTo(W/2 + (i-2)*20, H);
      ctx.stroke();
    }
    ctx.setLineDash([]);

    // Speed lines
    if (chaseSpeed > 80) {
      ctx.strokeStyle = `rgba(255,170,0,${Math.min((chaseSpeed-80)/200, 0.4)})`;
      ctx.lineWidth = 1;
      for (let i = 0; i < 8; i++) {
        const x = Math.random() * W;
        const y = Math.random() * H;
        ctx.beginPath();
        ctx.moveTo(x, y);
        ctx.lineTo(x - 30 - Math.random()*50, y);
        ctx.stroke();
      }
    }

    // Move car with keys
    if (chaseKeys['ArrowLeft'] || chaseKeys['a']) carX -= 4 * dt;
    if (chaseKeys['ArrowRight'] || chaseKeys['d']) carX += 4 * dt;
    if (chaseKeys['ArrowUp'] || chaseKeys['w']) carY -= 3 * dt;
    if (chaseKeys['ArrowDown'] || chaseKeys['s']) carY += 3 * dt;
    carX = Math.max(10, Math.min(W - 60, carX));
    carY = Math.max(100, Math.min(H - 50, carY));

    // Turboboost
    if (chaseKeys[' '] && turboFuel > 0) {
      turboFuel -= 1.5 * dt;
      chaseSpeed = Math.min(chaseSpeed + 2, 280);
    } else {
      turboFuel = Math.min(100, turboFuel + 0.2 * dt);
      chaseSpeed = Math.max(120, chaseSpeed - 0.5 * dt);
    }
    document.getElementById('chaseSpeed').textContent = Math.round(chaseSpeed);
    chaseScore += Math.round(chaseSpeed / 100 * dt);
    document.getElementById('chaseScore').textContent = chaseScore;

    // Spawn enemies
    if (Math.random() < 0.03 * dt) {
      enemyCars.push({
        x: 20 + Math.random() * (W - 80),
        y: -60,
        speed: 2 + Math.random() * 3,
        w: 40, h: 60
      });
    }

    // Draw enemies
    enemyCars.forEach(e => {
      e.y += e.speed * dt;
      ctx.fillStyle = '#1a1a2a';
      ctx.fillRect(e.x, e.y, e.w, e.h);
      ctx.fillStyle = '#333';
      ctx.fillRect(e.x+5, e.y+5, e.w-10, e.h-10);
      // Headlights
      ctx.fillStyle = '#ff4400';
      ctx.fillRect(e.x+5, e.y+e.h-8, 8, 5);
      ctx.fillRect(e.x+e.w-13, e.y+e.h-8, 8, 5);

      // Collision
      if (e.y + e.h > carY && e.y < carY + 50 &&
          e.x + e.w > carX && e.x < carX + 50) {
        e.y = H + 200;
        chaseHP--;
        document.getElementById('chaseHP').textContent = chaseHP;
        alertOverlay.classList.add('flash');
        setTimeout(() => alertOverlay.classList.remove('flash'), 300);
        if (chaseHP <= 0) {
          ctx.fillStyle = '#ff2200';
          ctx.font = 'bold 40px Orbitron, sans-serif';
          ctx.textAlign = 'center';
          ctx.fillText('WRECKED!', W/2, H/2);
          setTimeout(endChase, 1500);
          return;
        }
      }
    });

    // Draw player car (KITT)
    const turbocolor = chaseKeys[' '] && turboFuel > 0 ? '#ffaa00' : '#cc0000';
    ctx.fillStyle = turbocolor;
    ctx.beginPath();
    ctx.moveTo(carX+25, carY);
    ctx.lineTo(carX+50, carY+20);
    ctx.lineTo(carX+50, carY+50);
    ctx.lineTo(carX, carY+50);
    ctx.lineTo(carX, carY+20);
    ctx.closePath();
    ctx.fill();
    ctx.fillStyle = '#0a0a14';
    ctx.fillRect(carX+5, carY+5, 40, 20);
    ctx.fillStyle = '#00ff88';
    ctx.fillRect(carX+5, carY+5, 40, 20);
    // Scanner glow
    ctx.fillStyle = '#ff2200';
    ctx.shadowColor = '#ff2200';
    ctx.shadowBlur = 10;
    ctx.fillRect(carX+8, carY+45, 34, 3);
    ctx.shadowBlur = 0;

    // Remove off-screen
    enemyCars = enemyCars.filter(e => e.y < H + 100);

    animFrameId = requestAnimationFrame(chaseLoop);
  }

  document.addEventListener('keydown', e => {
    chaseKeys[e.key] = true;
    if (e.key === 'Escape' && chaseRunning) endChase();
  });
  document.addEventListener('keyup', e => { chaseKeys[e.key] = false; });
</script>
</body>
</html>
