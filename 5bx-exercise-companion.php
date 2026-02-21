<?php
// 5BX Exercise Companion - Interactive guide for the RCAF 5BX fitness program
// Inspired by Jon's 2007 post about the 5BX daily exercise program
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5BX Exercise Companion - Royal Canadian Air Force Fitness Program</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }
        
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            text-align: center;
            padding: 30px 0 20px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: white;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
        }
        
        h1 {
            font-size: 1.8em;
            margin: 0 0 8px;
            letter-spacing: -0.5px;
        }
        
        .subtitle {
            color: var(--text-muted);
            font-size: 0.95em;
            margin: 0;
        }
        
        .card {
            background: var(--card);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
        }
        
        .level-selector {
            display: flex;
            gap: 8px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        
        .level-btn {
            flex: 1;
            min-width: 50px;
            padding: 12px 16px;
            border: 2px solid var(--border);
            background: white;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .level-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .level-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        
        .exercise-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .exercise-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: var(--bg);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid transparent;
        }
        
        .exercise-item:hover {
            background: #f1f5f9;
        }
        
        .exercise-item.completed {
            opacity: 0.6;
        }
        
        .exercise-item.completed .exercise-icon {
            background: var(--success);
        }
        
        .exercise-icon {
            width: 56px;
            height: 56px;
            background: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        
        .exercise-info {
            flex: 1;
        }
        
        .exercise-name {
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .exercise-meta {
            font-size: 0.85em;
            color: var(--text-muted);
        }
        
        .exercise-reps {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1em;
        }
        
        .start-btn {
            width: 100%;
            padding: 18px 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }
        
        .start-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }
        
        .start-btn:active {
            transform: translateY(0);
        }
        
        /* Workout Screen */
        .workout-screen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--bg);
            z-index: 100;
            overflow-y: auto;
        }
        
        .workout-screen.active {
            display: block;
        }
        
        .workout-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 24px;
            text-align: center;
        }
        
        .workout-progress {
            display: flex;
            gap: 6px;
            justify-content: center;
            margin-bottom: 16px;
        }
        
        .progress-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
        }
        
        .progress-dot.active {
            background: white;
            transform: scale(1.3);
        }
        
        .progress-dot.completed {
            background: var(--success);
        }
        
        .current-exercise-title {
            font-size: 1.4em;
            margin: 0 0 4px;
        }
        
        .current-exercise-subtitle {
            opacity: 0.9;
            font-size: 0.9em;
        }
        
        .workout-body {
            padding: 24px;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .visual-demo {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        
        .demo-animation {
            font-size: 120px;
            line-height: 1;
            margin-bottom: 20px;
            animation: exercise-pulse 1.5s ease-in-out infinite;
        }
        
        @keyframes exercise-pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .demo-description {
            color: var(--text-muted);
            font-size: 0.95em;
        }
        
        .timer-container {
            text-align: center;
            margin-bottom: 24px;
        }
        
        .timer-display {
            font-size: 5em;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
            color: var(--text);
            line-height: 1;
            margin-bottom: 8px;
        }
        
        .timer-label {
            color: var(--text-muted);
            font-size: 0.9em;
        }
        
        .timer-ring {
            width: 280px;
            height: 280px;
            margin: 0 auto 30px;
            position: relative;
        }
        
        .timer-ring svg {
            transform: rotate(-90deg);
        }
        
        .timer-ring-bg {
            fill: none;
            stroke: var(--border);
            stroke-width: 8;
        }
        
        .timer-ring-progress {
            fill: none;
            stroke: var(--primary);
            stroke-width: 8;
            stroke-linecap: round;
            transition: stroke-dashoffset 0.1s linear;
        }
        
        .timer-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4em;
            font-weight: 800;
            font-variant-numeric: tabular-nums;
        }
        
        .reps-counter {
            font-size: 3em;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 8px;
        }
        
        .reps-label {
            color: var(--text-muted);
            font-size: 1em;
        }
        
        .control-buttons {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }
        
        .control-btn {
            flex: 1;
            padding: 16px 24px;
            border: none;
            border-radius: 12px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .control-btn.primary {
            background: var(--primary);
            color: white;
        }
        
        .control-btn.secondary {
            background: white;
            color: var(--text);
            border: 2px solid var(--border);
        }
        
        .control-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .tip-box {
            background: #fef3c7;
            border-left: 4px solid var(--warning);
            padding: 16px;
            border-radius: 0 12px 12px 0;
            font-size: 0.9em;
            color: #92400e;
        }
        
        .tip-box strong {
            display: block;
            margin-bottom: 4px;
        }
        
        /* Completion Screen */
        .completion-screen {
            display: none;
            text-align: center;
            padding: 60px 24px;
        }
        
        .completion-screen.active {
            display: block;
        }
        
        .completion-icon {
            font-size: 100px;
            margin-bottom: 24px;
            animation: celebrate 0.6s ease-out;
        }
        
        @keyframes celebrate {
            0% { transform: scale(0) rotate(-180deg); }
            50% { transform: scale(1.2) rotate(10deg); }
            100% { transform: scale(1) rotate(0deg); }
        }
        
        .completion-title {
            font-size: 2em;
            margin-bottom: 12px;
        }
        
        .completion-stats {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        
        .stat-value {
            font-size: 1.8em;
            font-weight: 800;
            color: var(--primary);
        }
        
        .stat-label {
            font-size: 0.8em;
            color: var(--text-muted);
        }
        
        .info-section {
            margin-top: 24px;
        }
        
        .info-section h3 {
            font-size: 1em;
            margin-bottom: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-grid {
            display: grid;
            gap: 12px;
        }
        
        .info-item {
            display: flex;
            gap: 12px;
            padding: 12px;
            background: var(--bg);
            border-radius: 10px;
            font-size: 0.9em;
        }
        
        .info-icon {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9em;
            margin-bottom: 16px;
        }
        
        .back-link:hover {
            color: var(--primary);
        }

        @media (max-width: 480px) {
            .timer-ring {
                width: 240px;
                height: 240px;
            }
            .timer-text {
                font-size: 3.2em;
            }
            .demo-animation {
                font-size: 80px;
            }
            .completion-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">&larr; Back to Chloe Reads Jon</a>
        
        <header>
            <div class="logo">&#9994;</div>
            <h1>5BX Exercise Companion</h1>
            <p class="subtitle">The Royal Canadian Air Force 15-minute fitness program</p>
        </header>
        
        <div class="card">
            <h3 style="margin-top:0;margin-bottom:16px;font-size:1.1em;">Select Your Level</h3>
            <div class="level-selector">
                <button class="level-btn" data-level="1">A</button>
                <button class="level-btn" data-level="2">B</button>
                <button class="level-btn active" data-level="3">C</button>
                <button class="level-btn" data-level="4">D</button>
                <button class="level-btn" data-level="5">E</button>
                <button class="level-btn" data-level="6">F</button>
            </div>
            
            <div class="exercise-list" id="exerciseList">
                <!-- Populated by JS -->
            </div>
            
            <button class="start-btn" onclick="startWorkout()">Start Workout</button>
        </div>
        
        <div class="card info-section">
            <h3>About 5BX</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">&#9200;</div>
                    <div>
                        <strong>15 Minutes</strong>
                        Complete workout in just 15 minutes
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">&#127969;</div>
                    <div>
                        <strong>No Equipment</strong>
                        Just you and a small space
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">&#128200;</div>
                    <div>
                        <strong>6 Levels</strong>
                        Progress from beginner to advanced
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Workout Screen -->
    <div class="workout-screen" id="workoutScreen">
        <div class="workout-header">
            <div class="workout-progress" id="workoutProgress"></div>
            <h2 class="current-exercise-title" id="currentExerciseTitle">Exercise 1</h2>
            <p class="current-exercise-subtitle" id="currentExerciseSubtitle">Get ready!</p>
        </div>
        
        <div class="workout-body">
            <div class="visual-demo">
                <div class="demo-animation" id="demoAnimation">&#129496;</div>
                <p class="demo-description" id="demoDescription">Stand with feet apart, bend forward to touch toes</p>
            </div>
            
            <div class="timer-container" id="timerContainer">
                <div class="timer-ring">
                    <svg width="100%" height="100%" viewBox="0 0 280 280">
                        <circle class="timer-ring-bg" cx="140" cy="140" r="130"/>
                        <circle class="timer-ring-progress" id="timerRing" cx="140" cy="140" r="130"
                            stroke-dasharray="816.8" stroke-dashoffset="0"/>
                    </svg>
                    <div class="timer-text" id="timerDisplay">00:00</div>
                </div>
            </div>
            
            <div class="reps-counter" id="repsCounter" style="display:none;">
                <div class="reps-count" id="repsCount">20</div>
                <div class="reps-label">repetitions</div>
            </div>
            
            <div class="control-buttons">
                <button class="control-btn secondary" onclick="skipExercise()">Skip</button>
                <button class="control-btn primary" id="actionBtn" onclick="toggleTimer()">Start</button>
            </div>
            
            <div class="tip-box" id="tipBox">
                <strong>Tip:</strong>
                <span id="tipText">Keep your legs straight but don't lock your knees</span>
            </div>
        </div>
    </div>
    
    <!-- Completion Screen -->
    <div class="workout-screen completion-screen" id="completionScreen">
        <div class="completion-icon">&#127942;</div>
        <h2 class="completion-title">Workout Complete!</h2>
        <p>You've completed the 5BX fitness program for today. Great job!</p>
        
        <div class="completion-stats">
            <div>
                <div class="stat-value" id="statExercises">5</div>
                <div class="stat-label">Exercises</div>
            </div>
            <div>
                <div class="stat-value" id="statTime">15</div>
                <div class="stat-label">Minutes</div>
            </div>
            <div>
                <div class="stat-value" id="statLevel">C</div>
                <div class="stat-label">Level</div>
            </div>
        </div>
        
        <button class="start-btn" onclick="finishWorkout()">Back to Home</button>
    </div>

    <script>
        // 5BX Exercise Data
        const exercises = [
            {
                name: "Forward Bends",
                icon: "&#129496;",
                description: "Stand with feet apart, bend forward to touch toes",
                tips: ["Keep legs straight but don't lock knees", "Reach for toes, not floor", "Exhale as you bend down"],
                type: "timed",
                duration: 120, // 2 minutes
                getReps: (level) => [20, 25, 30, 35, 40, 45][level - 1]
            },
            {
                name: "Sit-Ups",
                icon: "&#128170;",
                description: "Lie on back, knees bent, hands behind head, curl up",
                tips: ["Don't pull on your neck", "Engage your core", "Exhale on the way up"],
                type: "reps",
                getReps: (level) => [15, 20, 25, 30, 35, 40][level - 1]
            },
            {
                name: "Back Extensions",
                icon: "&#128675;",
                description: "Lie face down, hands under thighs, lift head and shoulders",
                tips: ["Lift from your back muscles", "Keep feet on floor", "Hold briefly at top"],
                type: "reps",
                getReps: (level) => [12, 15, 18, 21, 24, 27][level - 1]
            },
            {
                name: "Push-Ups",
                icon: "&#9994;",
                description: "Standard push-up position, chest to floor",
                tips: ["Keep body in straight line", "Go down until chest nearly touches", "Modify on knees if needed"],
                type: "reps",
                getReps: (level) => [10, 12, 15, 18, 21, 24][level - 1]
            },
            {
                name: "Stationary Run",
                icon: "&#127939;",
                description: "Run in place, lifting feet 6 inches, count steps",
                tips: ["Lift knees to waist height", "Stay light on your feet", "Breathe rhythmically"],
                type: "timed",
                duration: 300, // 5 minutes
                getReps: (level) => [200, 250, 300, 350, 400, 450][level - 1]
            }
        ];
        
        const levels = ['A', 'B', 'C', 'D', 'E', 'F'];
        let currentLevel = 3;
        let currentExercise = 0;
        let timerInterval = null;
        let timeRemaining = 0;
        let isRunning = false;
        let workoutStartTime = null;
        
        // Level selector
        document.querySelectorAll('.level-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.level-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentLevel = parseInt(btn.dataset.level);
                renderExerciseList();
            });
        });
        
        function renderExerciseList() {
            const list = document.getElementById('exerciseList');
            list.innerHTML = exercises.map((ex, i) => {
                const reps = ex.type === 'reps' ? ex.getReps(currentLevel) : '2 min';
                const repText = ex.type === 'reps' ? `${reps} reps` : '2 minutes';
                return `
                    <div class="exercise-item" data-index="${i}">
                        <div class="exercise-icon">${ex.icon}</div>
                        <div class="exercise-info">
                            <div class="exercise-name">${i + 1}. ${ex.name}</div>
                            <div class="exercise-meta">${repText} &middot; ${ex.type === 'timed' ? 'Timed' : 'Count reps'}</div>
                        </div>
                        <div class="exercise-reps">${reps}</div>
                    </div>
                `;
            }).join('');
            
            document.getElementById('statLevel').textContent = levels[currentLevel - 1];
        }
        
        function startWorkout() {
            currentExercise = 0;
            workoutStartTime = Date.now();
            document.getElementById('workoutScreen').classList.add('active');
            document.getElementById('completionScreen').classList.remove('active');
            renderWorkoutProgress();
            loadExercise(0);
        }
        
        function renderWorkoutProgress() {
            const progress = document.getElementById('workoutProgress');
            progress.innerHTML = exercises.map((_, i) => 
                `<div class="progress-dot ${i === currentExercise ? 'active' : ''} ${i < currentExercise ? 'completed' : ''}"></div>`
            ).join('');
        }
        
        function loadExercise(index) {
            currentExercise = index;
            const ex = exercises[index];
            
            document.getElementById('currentExerciseTitle').textContent = `Exercise ${index + 1}: ${ex.name}`;
            document.getElementById('currentExerciseSubtitle').textContent = `Level ${levels[currentLevel - 1]} - ${ex.type === 'timed' ? 'Timed' : 'Count your reps'}`;
            document.getElementById('demoAnimation').innerHTML = ex.icon;
            document.getElementById('demoDescription').textContent = ex.description;
            
            // Random tip
            const tip = ex.tips[Math.floor(Math.random() * ex.tips.length)];
            document.getElementById('tipText').textContent = tip;
            
            // Setup timer or reps display
            const timerContainer = document.getElementById('timerContainer');
            const repsCounter = document.getElementById('repsCounter');
            
            if (ex.type === 'timed') {
                timerContainer.style.display = 'block';
                repsCounter.style.display = 'none';
                timeRemaining = ex.duration;
                updateTimerDisplay();
                resetTimerRing();
            } else {
                timerContainer.style.display = 'none';
                repsCounter.style.display = 'block';
                document.getElementById('repsCount').textContent = ex.getReps(currentLevel);
            }
            
            isRunning = false;
            document.getElementById('actionBtn').textContent = ex.type === 'timed' ? 'Start Timer' : 'Done';
            
            renderWorkoutProgress();
        }
        
        function updateTimerDisplay() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            document.getElementById('timerDisplay').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            document.querySelector('.timer-text').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        function resetTimerRing() {
            const ring = document.getElementById('timerRing');
            const circumference = 2 * Math.PI * 130;
            ring.style.strokeDasharray = circumference;
            ring.style.strokeDashoffset = 0;
        }
        
        function updateTimerRing() {
            const ex = exercises[currentExercise];
            const ring = document.getElementById('timerRing');
            const circumference = 2 * Math.PI * 130;
            const progress = timeRemaining / ex.duration;
            ring.style.strokeDashoffset = circumference * (1 - progress);
        }
        
        function toggleTimer() {
            const ex = exercises[currentExercise];
            
            if (ex.type === 'reps') {
                // Mark as done and go next
                completeExercise();
                return;
            }
            
            if (isRunning) {
                // Pause
                clearInterval(timerInterval);
                isRunning = false;
                document.getElementById('actionBtn').textContent = 'Resume';
            } else {
                // Start
                isRunning = true;
                document.getElementById('actionBtn').textContent = 'Pause';
                timerInterval = setInterval(() => {
                    timeRemaining--;
                    updateTimerDisplay();
                    updateTimerRing();
                    
                    if (timeRemaining <= 0) {
                        clearInterval(timerInterval);
                        completeExercise();
                    }
                }, 1000);
            }
        }
        
        function skipExercise() {
            if (timerInterval) clearInterval(timerInterval);
            isRunning = false;
            
            if (currentExercise < exercises.length - 1) {
                loadExercise(currentExercise + 1);
            } else {
                showCompletion();
            }
        }
        
        function completeExercise() {
            if (timerInterval) clearInterval(timerInterval);
            isRunning = false;
            
            // Mark as complete
            document.querySelectorAll('.progress-dot')[currentExercise].classList.add('completed');
            
            if (currentExercise < exercises.length - 1) {
                setTimeout(() => {
                    loadExercise(currentExercise + 1);
                }, 500);
            } else {
                setTimeout(showCompletion, 500);
            }
        }
        
        function showCompletion() {
            document.getElementById('workoutScreen').classList.remove('active');
            document.getElementById('completionScreen').classList.add('active');
            
            const elapsed = Math.round((Date.now() - workoutStartTime) / 60000);
            document.getElementById('statTime').textContent = elapsed;
            document.getElementById('statLevel').textContent = levels[currentLevel - 1];
        }
        
        function finishWorkout() {
            document.getElementById('completionScreen').classList.remove('active');
            renderExerciseList();
        }
        
        // Initialize
        renderExerciseList();
    </script>
</body>
</html>