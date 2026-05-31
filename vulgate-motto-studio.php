<?php
$verses = [
    [
        'latin' => 'Ex toto corde tuo',
        'english' => 'With all your heart',
        'ref' => 'Matthew 22:37',
        'theme' => 'devotion'
    ],
    [
        'latin' => 'Noli timere',
        'english' => 'Do not be afraid',
        'ref' => 'Luke 1:30',
        'theme' => 'courage'
    ],
    [
        'latin' => 'Lux in tenebris lucet',
        'english' => 'The light shines in darkness',
        'ref' => 'John 1:5',
        'theme' => 'hope'
    ],
    [
        'latin' => 'In pace in idipsum dormiam',
        'english' => 'In peace I will sleep',
        'ref' => 'Psalm 4:9',
        'theme' => 'rest'
    ],
    [
        'latin' => 'Fiat voluntas tua',
        'english' => 'Thy will be done',
        'ref' => 'Matthew 6:10',
        'theme' => 'surrender'
    ],
    [
        'latin' => 'Gaudete in Domino semper',
        'english' => 'Rejoice in the Lord always',
        'ref' => 'Philippians 4:4',
        'theme' => 'joy'
    ],
    [
        'latin' => 'Veritas liberabit vos',
        'english' => 'The truth will set you free',
        'ref' => 'John 8:32',
        'theme' => 'truth'
    ],
    [
        'latin' => 'Dominus fortitudo mea',
        'english' => 'The Lord is my strength',
        'ref' => 'Psalm 27:1',
        'theme' => 'strength'
    ],
    [
        'latin' => 'Misericordia eius in aeternum',
        'english' => 'His mercy endures forever',
        'ref' => 'Psalm 136',
        'theme' => 'mercy'
    ],
    [
        'latin' => 'Servite Domino in laetitia',
        'english' => 'Serve the Lord with gladness',
        'ref' => 'Psalm 99:2',
        'theme' => 'service'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulgate Motto Studio</title>
    <style>
        :root {
            --ink: #2a2018;
            --parchment: #f6efd8;
            --deep-gold: #ae7d22;
            --rose: #7a2f35;
            --forest: #294a3d;
            --cobalt: #2b4c8f;
            --shadow: rgba(18, 11, 7, 0.22);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            background:
                radial-gradient(circle at 15% 12%, rgba(255, 247, 223, 0.95), rgba(246, 239, 216, 0) 40%),
                radial-gradient(circle at 85% 78%, rgba(180, 126, 37, 0.2), rgba(180, 126, 37, 0) 48%),
                repeating-linear-gradient(35deg, rgba(130, 95, 49, 0.04) 0 2px, rgba(255, 255, 255, 0) 2px 6px),
                var(--parchment);
            padding: 24px 16px 40px;
        }

        .shell {
            max-width: 980px;
            margin: 0 auto;
            background: linear-gradient(180deg, rgba(255, 250, 234, 0.95), rgba(243, 234, 209, 0.96));
            border: 1px solid rgba(104, 70, 28, 0.28);
            border-radius: 22px;
            box-shadow: 0 24px 50px var(--shadow);
            overflow: hidden;
        }

        .hero {
            padding: 24px;
            background: linear-gradient(110deg, rgba(49, 35, 19, 0.95), rgba(105, 69, 24, 0.86));
            color: #f7efd8;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(-45deg, rgba(255, 255, 255, 0.04) 0 2px, rgba(255, 255, 255, 0) 2px 8px);
            pointer-events: none;
        }

        h1 {
            margin: 0;
            font-family: Garamond, "Times New Roman", serif;
            font-size: clamp(1.8rem, 4.8vw, 2.8rem);
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .subtitle {
            margin: 10px 0 0;
            font-size: 1rem;
            line-height: 1.5;
            max-width: 68ch;
            opacity: 0.95;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 18px;
            padding: 18px;
        }

        .card {
            background: rgba(255, 250, 236, 0.9);
            border: 1px solid rgba(118, 82, 37, 0.22);
            border-radius: 18px;
            padding: 18px;
            box-shadow: 0 8px 22px rgba(56, 36, 12, 0.1);
        }

        .label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-weight: 700;
            color: #694720;
        }

        select, button {
            font: inherit;
            border-radius: 12px;
            border: 1px solid rgba(97, 65, 28, 0.34);
            background: #fffef8;
            color: var(--ink);
            padding: 11px 13px;
        }

        select { width: 100%; }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .btn {
            cursor: pointer;
            font-weight: 700;
            transition: transform 0.14s ease, box-shadow 0.14s ease;
        }

        .btn:hover { transform: translateY(-1px); }

        .btn.primary {
            background: linear-gradient(140deg, var(--deep-gold), #d19a2b);
            color: #fff6df;
            border-color: #936615;
            box-shadow: 0 8px 20px rgba(124, 82, 15, 0.3);
        }

        .btn.secondary {
            background: linear-gradient(145deg, #4b3420, #6f4a2c);
            color: #f9efde;
        }

        .crest {
            margin-top: 16px;
            min-height: 190px;
            border-radius: 16px;
            border: 1px dashed rgba(97, 65, 28, 0.45);
            padding: 16px;
            display: grid;
            place-items: center;
            background: rgba(255, 245, 221, 0.65);
        }

        .shield {
            width: min(100%, 430px);
            background: linear-gradient(160deg, var(--toneA), var(--toneB));
            color: #fefcf3;
            padding: 16px;
            text-align: center;
            clip-path: polygon(10% 0%, 90% 0%, 100% 22%, 88% 88%, 50% 100%, 12% 88%, 0% 22%);
            box-shadow: inset 0 0 0 3px rgba(255, 245, 212, 0.4), 0 12px 24px rgba(15, 6, 0, 0.26);
            transform: translateY(0);
            animation: settle 380ms ease;
        }

        @keyframes settle {
            from { transform: translateY(12px) scale(0.98); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .latin {
            font-family: Garamond, "Times New Roman", serif;
            font-size: clamp(1.25rem, 4vw, 1.8rem);
            letter-spacing: 0.045em;
            line-height: 1.35;
            margin: 8px 0;
            text-transform: uppercase;
            text-wrap: balance;
        }

        .english { font-size: 0.98rem; margin: 0; }
        .ref { font-size: 0.86rem; opacity: 0.8; margin-top: 8px; }

        .quiz-status {
            margin: 12px 0 0;
            font-size: 0.95rem;
            color: #4f3518;
        }

        .choices {
            display: grid;
            gap: 10px;
            margin-top: 14px;
        }

        .choice {
            text-align: left;
            cursor: pointer;
            padding: 12px 14px;
            border-radius: 11px;
            border: 1px solid rgba(98, 67, 28, 0.28);
            background: #fffaf0;
            transition: background-color 0.14s ease, border-color 0.14s ease;
        }

        .choice:hover { background: #fff2cf; }
        .choice.correct { border-color: #0a7b4f; background: #d8f5e8; }
        .choice.wrong { border-color: #9c2a3a; background: #ffe0e3; }

        .small {
            margin-top: 16px;
            font-size: 0.86rem;
            color: #6d4a22;
            line-height: 1.5;
        }

        @media (min-width: 860px) {
            .grid { grid-template-columns: 1.1fr 0.9fr; padding: 24px; gap: 24px; }
            .hero { padding: 32px; }
            .card { padding: 20px; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="hero">
            <h1>Vulgate Motto Studio</h1>
            <p class="subtitle">Pick a Scripture-inspired Latin motto, forge a heraldic shield, then test your ear with a quick translation challenge. Built for contemplative nerds and curious kids alike.</p>
        </section>

        <section class="grid">
            <article class="card">
                <label class="label" for="theme">Theme</label>
                <select id="theme">
                    <option value="all">Any theme</option>
                    <option value="devotion">Devotion</option>
                    <option value="courage">Courage</option>
                    <option value="hope">Hope</option>
                    <option value="rest">Rest</option>
                    <option value="surrender">Surrender</option>
                    <option value="joy">Joy</option>
                    <option value="truth">Truth</option>
                    <option value="strength">Strength</option>
                    <option value="mercy">Mercy</option>
                    <option value="service">Service</option>
                </select>

                <div class="actions">
                    <button class="btn primary" id="forge">Forge Random Motto</button>
                    <button class="btn secondary" id="copy">Copy Motto Card</button>
                </div>

                <div class="crest" id="crest" aria-live="polite"></div>
                <p class="small">Tip: pick a theme, forge a few options, and keep one as a weekly family motto.</p>
            </article>

            <article class="card">
                <h2 style="margin:0 0 8px; font-family:Garamond, 'Times New Roman', serif; letter-spacing:0.03em;">Mini Challenge</h2>
                <p style="margin:0; line-height:1.55;">Identify the correct English meaning. Three rounds, fast and fun.</p>
                <div id="quiz"></div>
                <p class="quiz-status" id="quizStatus">Score: 0 / 0</p>
                <div class="actions">
                    <button class="btn secondary" id="next">Next Round</button>
                    <button class="btn" id="reset">Reset Quiz</button>
                </div>
            </article>
        </section>
    </main>

    <script>
        const verses = <?php echo json_encode($verses, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;
        const palettes = [
            ['#7a2f35', '#43191f'],
            ['#2b4c8f', '#172849'],
            ['#2f6a49', '#173825'],
            ['#8f6220', '#4d330f']
        ];

        const themeSelect = document.getElementById('theme');
        const crest = document.getElementById('crest');
        const forgeBtn = document.getElementById('forge');
        const copyBtn = document.getElementById('copy');
        const quizWrap = document.getElementById('quiz');
        const quizStatus = document.getElementById('quizStatus');
        const nextBtn = document.getElementById('next');
        const resetBtn = document.getElementById('reset');

        let current = null;
        let score = 0;
        let rounds = 0;
        let quizCurrent = null;

        function randomFrom(arr) {
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function pickVerse(theme) {
            const filtered = theme === 'all' ? verses : verses.filter(v => v.theme === theme);
            return randomFrom(filtered.length ? filtered : verses);
        }

        function renderCrest(verse) {
            const [toneA, toneB] = randomFrom(palettes);
            crest.innerHTML = `
                <div class="shield" style="--toneA:${toneA}; --toneB:${toneB};">
                    <p class="latin">${verse.latin}</p>
                    <p class="english">${verse.english}</p>
                    <p class="ref">${verse.ref}</p>
                </div>
            `;
        }

        function forge() {
            current = pickVerse(themeSelect.value);
            renderCrest(current);
        }

        function copyCard() {
            if (!current) forge();
            const text = `${current.latin}\n${current.english}\n${current.ref}`;
            navigator.clipboard.writeText(text).then(() => {
                copyBtn.textContent = 'Copied';
                setTimeout(() => copyBtn.textContent = 'Copy Motto Card', 1200);
            });
        }

        function newQuestion() {
            quizCurrent = randomFrom(verses);
            const distractors = verses
                .filter(v => v.english !== quizCurrent.english)
                .sort(() => Math.random() - 0.5)
                .slice(0, 3)
                .map(v => v.english);
            const choices = [quizCurrent.english, ...distractors].sort(() => Math.random() - 0.5);

            quizWrap.innerHTML = `
                <p style="margin:14px 0 6px; font-weight:700;">${quizCurrent.latin}</p>
                <div class="choices">
                    ${choices.map((c, idx) => `<button class="choice" data-i="${idx}">${c}</button>`).join('')}
                </div>
            `;

            [...quizWrap.querySelectorAll('.choice')].forEach((btn) => {
                btn.addEventListener('click', () => grade(btn));
            });
        }

        function grade(button) {
            const answer = button.textContent;
            const all = [...quizWrap.querySelectorAll('.choice')];
            all.forEach(b => b.disabled = true);
            const isRight = answer === quizCurrent.english;
            rounds += 1;
            if (isRight) {
                score += 1;
                button.classList.add('correct');
            } else {
                button.classList.add('wrong');
                const correctBtn = all.find(b => b.textContent === quizCurrent.english);
                if (correctBtn) correctBtn.classList.add('correct');
            }
            quizStatus.textContent = `Score: ${score} / ${rounds}`;
        }

        function resetQuiz() {
            score = 0;
            rounds = 0;
            quizStatus.textContent = 'Score: 0 / 0';
            newQuestion();
        }

        forgeBtn.addEventListener('click', forge);
        copyBtn.addEventListener('click', copyCard);
        nextBtn.addEventListener('click', newQuestion);
        resetBtn.addEventListener('click', resetQuiz);

        forge();
        newQuestion();
    </script>
</body>
</html>
