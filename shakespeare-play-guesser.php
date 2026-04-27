<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Shakespeare Stage — Can You Name the Play?</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-deep: #1a1209;
            --bg-card: #2a1f12;
            --bg-warm: #3a2e1e;
            --gold: #c9a84c;
            --gold-bright: #e8d18a;
            --gold-dim: #8b7340;
            --burgundy: #6b1a2b;
            --burgundy-light: #8f2d42;
            --cream: #f5f0e0;
            --cream-muted: #c4b896;
            --green: #4a7c59;
            --green-bright: #6aad7a;
            --red: #9e2b2b;
            --shadow: rgba(0,0,0,0.5);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'EB Garamond', Georgia, serif;
            background: var(--bg-deep);
            color: var(--cream);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Stage spotlight effect */
        .stage-lights {
            position: fixed;
            top: 0; left: 0; right: 0; height: 60vh;
            pointer-events: none;
            z-index: 0;
            background:
                radial-gradient(ellipse 80% 100% at 30% -10%, rgba(201,168,76,0.12) 0%, transparent 70%),
                radial-gradient(ellipse 80% 100% at 70% -10%, rgba(201,168,76,0.08) 0%, transparent 70%);
        }

        .stage-curtain {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 12px;
            background: linear-gradient(180deg,
                var(--burgundy) 0%,
                var(--burgundy-light) 40%,
                var(--burgundy) 100%);
            z-index: 10;
            box-shadow: 0 2px 8px rgba(0,0,0,0.4);
        }

        .stage-curtain::after {
            content: '';
            position: absolute;
            bottom: -14px;
            left: 0; right: 0;
            height: 14px;
            background: repeating-linear-gradient(
                90deg,
                var(--burgundy) 0px,
                var(--burgundy-light) 8px,
                var(--burgundy) 16px
            );
            opacity: 0.9;
        }

        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 48px 20px 40px;
            position: relative;
            z-index: 1;
        }

        header {
            text-align: center;
            margin-bottom: 32px;
        }

        .title {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 2.4em;
            font-weight: 700;
            color: var(--gold-bright);
            text-shadow: 0 2px 12px rgba(201,168,76,0.3);
            letter-spacing: 1px;
            line-height: 1.1;
        }

        .subtitle {
            font-size: 1.15em;
            color: var(--cream-muted);
            margin-top: 8px;
            font-style: italic;
        }

        .score-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            border: 1px solid var(--gold-dim);
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 24px;
            font-size: 0.95em;
        }

        .score-bar span {
            color: var(--gold);
            font-weight: 600;
        }

        .score-bar .streak {
            color: var(--gold-bright);
        }

        /* Scene card */
        .scene-card {
            background: linear-gradient(145deg, var(--bg-card) 0%, var(--bg-warm) 100%);
            border: 1px solid var(--gold-dim);
            border-radius: 16px;
            padding: 32px 24px;
            text-align: center;
            margin-bottom: 24px;
            position: relative;
            box-shadow: 0 8px 32px var(--shadow);
        }

        .scene-number {
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.85em;
            color: var(--gold-dim);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 16px;
        }

        .scene-quote {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.5em;
            font-weight: 600;
            color: var(--cream);
            line-height: 1.5;
            margin-bottom: 20px;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 8px;
        }

        .scene-hint {
            font-size: 0.95em;
            color: var(--cream-muted);
            font-style: italic;
            margin-bottom: 8px;
        }

        .genre-tag {
            display: inline-block;
            background: rgba(201,168,76,0.15);
            color: var(--gold);
            font-size: 0.8em;
            padding: 4px 14px;
            border-radius: 20px;
            border: 1px solid var(--gold-dim);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Answer buttons */
        .choices {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .choice-btn {
            background: var(--bg-card);
            border: 1px solid var(--gold-dim);
            border-radius: 12px;
            padding: 16px 20px;
            color: var(--cream);
            font-family: 'EB Garamond', Georgia, serif;
            font-size: 1.05em;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: left;
            position: relative;
            overflow: hidden;
        }

        .choice-btn:hover:not(:disabled) {
            border-color: var(--gold);
            background: var(--bg-warm);
            transform: translateX(4px);
        }

        .choice-btn:disabled {
            cursor: default;
            opacity: 0.9;
        }

        .choice-btn.correct {
            border-color: var(--green-bright);
            background: rgba(74,124,89,0.2);
            color: var(--green-bright);
        }

        .choice-btn.wrong {
            border-color: var(--red);
            background: rgba(158,43,43,0.15);
            color: #c76b6b;
        }

        .choice-btn .letter {
            display: inline-block;
            width: 28px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            border-radius: 50%;
            border: 1px solid var(--gold-dim);
            color: var(--gold);
            font-size: 0.85em;
            font-weight: 600;
            margin-right: 12px;
            font-family: 'Cormorant Garamond', serif;
        }

        .choice-btn.correct .letter {
            border-color: var(--green-bright);
            color: var(--green-bright);
            background: rgba(74,124,89,0.3);
        }

        /* Result panel */
        .result-panel {
            background: var(--bg-card);
            border: 1px solid var(--gold-dim);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }

        .result-panel.show { display: block; animation: fadeUp 0.4s ease; }

        .result-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6em;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .result-title.hit { color: var(--green-bright); }
        .result-title.miss { color: #c76b6b; }

        .result-fact {
            color: var(--cream-muted);
            font-size: 0.95em;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .next-btn {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dim) 100%);
            color: var(--bg-deep);
            border: none;
            border-radius: 10px;
            padding: 14px 36px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 1px;
            transition: all 0.2s ease;
        }

        .next-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(201,168,76,0.3);
        }

        /* Final scene */
        .final-scene {
            text-align: center;
            display: none;
        }

        .final-scene.show { display: block; animation: fadeUp 0.6s ease; }

        .final-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2em;
            font-weight: 700;
            color: var(--gold-bright);
            margin-bottom: 8px;
        }

        .final-subtitle {
            font-size: 1.1em;
            color: var(--cream-muted);
            margin-bottom: 24px;
        }

        .final-score-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 3px solid var(--gold);
            margin: 0 auto 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(201,168,76,0.08);
        }

        .final-score-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.8em;
            font-weight: 700;
            color: var(--gold-bright);
            line-height: 1;
        }

        .final-score-label {
            font-size: 0.85em;
            color: var(--gold-dim);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .review-card {
            background: var(--bg-card);
            border: 1px solid var(--gold-dim);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 10px;
            text-align: left;
        }

        .review-card .rv-q {
            font-weight: 600;
            color: var(--cream);
            margin-bottom: 6px;
        }

        .review-card .rv-a {
            color: var(--cream-muted);
            font-size: 0.95em;
        }

        .review-card .rv-you {
            font-size: 0.85em;
            margin-top: 6px;
        }

        .review-card .rv-you.correct { color: var(--green-bright); }
        .review-card .rv-you.wrong { color: #c76b6b; }

        .restart-btn {
            background: linear-gradient(135deg, var(--burgundy-light) 0%, var(--burgundy) 100%);
            color: var(--cream);
            border: 1px solid var(--burgundy-light);
            border-radius: 12px;
            padding: 16px 40px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15em;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 1px;
            margin-top: 20px;
            transition: all 0.2s ease;
        }

        .restart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(107,26,43,0.4);
        }

        .critic-quote {
            font-style: italic;
            color: var(--gold);
            font-size: 1.1em;
            margin: 20px 0 8px;
            padding: 0 20px;
            line-height: 1.5;
        }

        .critic-name {
            color: var(--cream-muted);
            font-size: 0.9em;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .pulse { animation: pulse 0.4s ease; }

        .progress-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 20px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold-dim);
            transition: all 0.3s ease;
        }

        .dot.current { background: var(--gold-bright); box-shadow: 0 0 8px var(--gold); }
        .dot.correct { background: var(--green-bright); }
        .dot.wrong { background: var(--red); }

        .star-rating {
            font-size: 1.6em;
            margin-bottom: 12px;
            letter-spacing: 4px;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.8em;
            color: var(--gold-dim);
        }

        footer a { color: var(--gold-dim); }

        @media (max-width: 480px) {
            .title { font-size: 1.9em; }
            .scene-quote { font-size: 1.25em; }
            .container { padding: 40px 16px 32px; }
        }
    </style>
</head>
<body>
    <div class="stage-curtain"></div>
    <div class="stage-lights"></div>

    <div class="container">
        <header id="game-header">
            <h1 class="title">The Shakespeare Stage</h1>
            <p class="subtitle">Can you name the play from Jon's capsule summary?</p>
        </header>

        <div id="game-area">
            <div class="score-bar" id="score-bar" style="display:none;">
                <div>Round <span id="round-num">1</span> / <span id="total-rounds">10</span></div>
                <div>Score: <span id="score">0</span></div>
                <div class="streak">Streak: <span id="streak">0</span></div>
            </div>

            <div class="progress-dots" id="progress-dots"></div>

            <div class="scene-card" id="scene-card" style="display:none;">
                <div class="scene-number" id="scene-number">Act I, Scene 1</div>
                <div class="scene-quote" id="scene-quote">Loading...</div>
                <div class="scene-hint" id="scene-hint"></div>
                <div class="genre-tag" id="genre-tag">Comedy</div>
            </div>

            <div class="choices" id="choices"></div>

            <div class="result-panel" id="result-panel">
                <div class="result-title" id="result-title"></div>
                <div class="result-fact" id="result-fact"></div>
                <button class="next-btn" id="next-btn" onclick="nextRound()">Next Scene</button>
            </div>
        </div>

        <div class="final-scene" id="final-scene">
            <div class="final-title" id="final-title">Curtain Call</div>
            <div class="final-subtitle" id="final-subtitle">The reviews are in...</div>
            <div class="final-score-circle">
                <div class="final-score-num" id="final-score">0</div>
                <div class="final-score-label">out of 100</div>
            </div>
            <div class="star-rating" id="star-rating"></div>
            <div class="critic-quote" id="critic-quote"></div>
            <div class="critic-name" id="critic-name"></div>

            <div style="margin-top: 28px; text-align: left;">
                <div style="color: var(--gold); font-weight: 600; margin-bottom: 12px; font-family: 'Cormorant Garamond', serif; font-size: 1.2em;">Your Performance:</div>
                <div id="review-list"></div>
            </div>

            <button class="restart-btn" onclick="startGame()">Take the Stage Again</button>
        </div>

        <footer>
            Built by <a href="https://openclaw.ai" target="_blank">OpenClaw</a> + Claude<br>
            Inspired by <a href="https://jona.ca/2015/07/capsule-summaries-of-shakespeares-plays.html" target="_blank">Jon Aquino's capsule summaries</a>
        </footer>
    </div>

    <script>
        const allPlays = [
            {
                title: "The Comedy of Errors",
                summary: "Twins, separated at birth, take the same name. Chaos ensues as each is mistaken for the other in the same city.",
                genre: "Comedy",
                hint: "Two sets of twins, one town, absolute confusion.",
                funFact: "Shakespeare's shortest play, and one of his earliest — a bare-bones farce that clocks in under 1,800 lines."
            },
            {
                title: "Love's Labour's Lost",
                summary: "Three gentlemen vow to abstain from food, women, and sleep for three years, devoting the time to study. Spoiler: they don't make it.",
                genre: "Comedy",
                hint: "A vow of scholarly celibacy meets real life.",
                funFact: "One of Shakespeare's most wordplay-dense comedies — full of elaborate puns and intellectual games."
            },
            {
                title: "The Taming of the Shrew",
                summary: "Petruchio must somehow tame the shrewish Katharina. A battle of wills that ends in... mutual exhaustion?",
                genre: "Comedy",
                hint: "A man bets he can tame a headstrong woman.",
                funFact: "The play-within-a-play frame (the Christopher Sly scenes) is often cut in modern productions."
            },
            {
                title: "A Midsummer Night's Dream",
                summary: "Demetrius and Lysander are in love with Hermia; Helena is in love with Demetrius. A fairy king's love potion turns everything upside down in an enchanted forest.",
                genre: "Comedy",
                hint: "Fairies, love potions, and a man with a donkey's head.",
                funFact: "Bottom's transformation into an ass is one of Shakespeare's most enduring images — and it happens right in the middle of the play's title."
            },
            {
                title: "The Merchant of Venice",
                summary: "Antonio owes Shylock a pound of his flesh for not repaying the debt he incurred for his friend Bassanio. Justice and mercy collide in the courtroom.",
                genre: "Comedy",
                hint: "A pound of flesh as collateral for a loan.",
                funFact: "The 'quality of mercy' speech (Portia, Act 4) is one of the most quoted passages in all of Shakespeare."
            },
            {
                title: "Much Ado About Nothing",
                summary: "Hero is falsely accused of cheating on her fiance the night before their wedding. Meanwhile, two sharp-tongued singletons play a battle of wits.",
                genre: "Comedy",
                hint: "Two love stories: one sweet, one sparring.",
                funFact: "Benedick and Beatrice's acid-tongued romance is widely considered Shakespeare's wittiest couple."
            },
            {
                title: "As You Like It",
                summary: "Orlando and Rosalind are banished from Duke Frederick's kingdom to the Forest of Arden. Disguised as a boy, Rosalind teaches Orlando how to woo... herself.",
                genre: "Comedy",
                hint: "A woman disguised as a boy teaches a man how to love her.",
                funFact: "Contains the famous 'All the world's a stage' monologue — Jacques's seven ages of man."
            },
            {
                title: "Twelfth Night",
                summary: "Viola, shipwrecked and believing her twin brother dead, disguises herself as a boy and serves the Duke Orsino — who sends her to woo the Countess Olivia on his behalf.",
                genre: "Comedy",
                hint: "A girl dressed as a boy falls for the man who sent her to woo another woman.",
                funFact: "The name 'Malvolio' literally means 'ill will' in Italian — Shakespeare named his puritanical steward with a wink."
            },
            {
                title: "The Tempest",
                summary: "Prospero, a magician and deposed Duke of Milan, lives on a remote island with his daughter Miranda. He conjures a storm to shipwreck his usurping brother.",
                genre: "Romance",
                hint: "A sorcerer on an island conjures a storm to settle old scores.",
                funFact: "Widely believed to be Shakespeare's final solo play — Prospero's farewell to his art mirrors the playwright's own."
            },
            {
                title: "Romeo and Juliet",
                summary: "Two teenagers from feuding families fall in love at first sight and marry in secret. It goes about as well as you'd expect.",
                genre: "Tragedy",
                hint: "Star-crossed lovers from warring houses.",
                funFact: "The balcony scene never actually mentions a balcony — that's a staging invention from a 1679 production."
            },
            {
                title: "Macbeth",
                summary: "A Scottish general receives a prophecy from three witches that he will be king. Egged on by his ambitious wife, he murders his way to the throne.",
                genre: "Tragedy",
                hint: "Three witches, one ambitious couple, a lot of blood.",
                funFact: "Actors traditionally call it 'The Scottish Play' — saying the real title inside a theatre is considered bad luck."
            },
            {
                title: "Hamlet",
                summary: "A Danish prince discovers his uncle murdered his father and married his mother. He spends four acts brooding, then things get messy.",
                genre: "Tragedy",
                hint: "To be, or not to be — a prince seeks revenge.",
                funFact: "At over 4,000 lines, Hamlet is Shakespeare's longest play — and one of the most performed works in theatre history."
            },
            {
                title: "Julius Caesar",
                summary: "A group of Roman senators, convinced that Caesar's ambition threatens the republic, stab him to death on the Ides of March. But the aftermath spirals.",
                genre: "Tragedy",
                hint: "Beware the Ides of March — a dictator falls, a republic unravels.",
                funFact: "Caesar speaks fewer than 150 lines and dies halfway through — the play is really about Brutus."
            },
            {
                title: "Othello",
                summary: "A Moorish general in Venice is manipulated by his ensign Iago into believing his wife Desdemona is unfaithful. Jealousy proves fatal.",
                genre: "Tragedy",
                hint: "A general's trusted advisor plants a seed of deadly jealousy.",
                funFact: "Iago is one of Shakespeare's most enigmatic villains — he never gives a clear motive for his hatred of Othello."
            },
            {
                title: "King Lear",
                summary: "An aging king divides his kingdom among his three daughters based on how well they flatter him. The two who lie get everything; the honest one gets banished.",
                genre: "Tragedy",
                hint: "A father tests his daughters' love. It backfires spectacularly.",
                funFact: "For over 150 years, the play was performed with a rewritten happy ending — audiences couldn't handle Shakespeare's bleak original."
            },
            {
                title: "Richard III",
                summary: "A deformed and scheming Duke of Gloucester murders his way to the English throne, betraying everyone who trusts him until his luck runs out at Bosworth.",
                genre: "History",
                hint: "A hunchbacked villain plots his way to the crown.",
                funFact: "Richard's opening line — 'Now is the winter of our discontent' — is one of Shakespeare's most famous soliloquies."
            },
            {
                title: "Henry V",
                summary: "A young king unites a fractured England and leads his outnumbered army against France, winning the Battle of Agincourt through sheer will and rhetoric.",
                genre: "History",
                hint: "A king rallies his outnumbered army against France at Agincourt.",
                funFact: "The St. Crispin's Day speech ('We few, we happy few, we band of brothers') is arguably the most rousing battle speech in English literature."
            },
            {
                title: "The Winter's Tale",
                summary: "King Leontes becomes irrationally convinced his pregnant wife is having an affair with his best friend. His jealous rage destroys his family — but time and forgiveness offer hope.",
                genre: "Romance",
                hint: "A king's jealous rage tears his family apart. Time heals — mostly.",
                funFact: "Famous stage direction: 'Exit, pursued by a bear.' No one knows how Shakespeare intended to stage it."
            },
            {
                title: "Antony and Cleopatra",
                summary: "Mark Antony, one of Rome's three rulers, falls passionately in love with the Egyptian queen Cleopatra. Their affair threatens the empire and their lives.",
                genre: "Tragedy",
                hint: "A Roman general's love for an Egyptian queen shakes an empire.",
                funFact: "Cleopatra's final speech about the 'poor venomous fool' (the asp) is one of the most sensual death scenes in drama."
            },
            {
                title: "The Two Gentlemen of Verona",
                summary: "Proteus tries to steal his friend Valentine's beloved Sylvia while his own girlfriend Julia follows him in disguise. Friendship is tested — and somewhat restored.",
                genre: "Comedy",
                hint: "A friend tries to steal his best friend's girl. It mostly works out.",
                funFact: "Considered one of Shakespeare's earliest and weakest plays — but it contains the first example of a woman disguised as a boy in his work."
            }
        ];

        let currentPlays = [];
        let currentRound = 0;
        let score = 0;
        let streak = 0;
        let maxStreak = 0;
        let roundData = [];
        const TOTAL_ROUNDS = 10;

        function shuffle(array) {
            const a = [...array];
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }

        function getDistractors(correct, all) {
            const pool = all.filter(p => p.title !== correct.title);
            const sameGenre = pool.filter(p => p.genre === correct.genre);
            const otherGenre = pool.filter(p => p.genre !== correct.genre);
            const picks = [];
            // Try to include one from same genre
            if (sameGenre.length > 0) {
                picks.push(sameGenre[Math.floor(Math.random() * sameGenre.length)]);
            }
            // Fill rest from others
            while (picks.length < 3) {
                const candidate = otherGenre[Math.floor(Math.random() * otherGenre.length)];
                if (!picks.find(p => p.title === candidate.title)) {
                    picks.push(candidate);
                }
            }
            return shuffle(picks);
        }

        function startGame() {
            currentPlays = shuffle(allPlays).slice(0, TOTAL_ROUNDS);
            currentRound = 0;
            score = 0;
            streak = 0;
            maxStreak = 0;
            roundData = [];

            document.getElementById('final-scene').classList.remove('show');
            document.getElementById('game-header').style.display = 'block';
            document.getElementById('score-bar').style.display = 'flex';
            document.getElementById('scene-card').style.display = 'block';
            document.getElementById('result-panel').classList.remove('show');
            document.getElementById('result-panel').style.display = 'none';

            buildProgressDots();
            loadRound();
        }

        function buildProgressDots() {
            const dots = document.getElementById('progress-dots');
            dots.innerHTML = '';
            for (let i = 0; i < TOTAL_ROUNDS; i++) {
                const dot = document.createElement('div');
                dot.className = 'dot' + (i === 0 ? ' current' : '');
                dot.id = 'dot-' + i;
                dots.appendChild(dot);
            }
        }

        function loadRound() {
            const play = currentPlays[currentRound];
            const distractors = getDistractors(play, allPlays);
            const choices = shuffle([play, ...distractors]);

            document.getElementById('round-num').textContent = currentRound + 1;
            document.getElementById('total-rounds').textContent = TOTAL_ROUNDS;
            document.getElementById('score').textContent = score;
            document.getElementById('streak').textContent = streak;

            document.getElementById('scene-number').textContent = 'Act ' + (currentRound + 1) + ', Scene 1';
            document.getElementById('scene-quote').textContent = play.summary;
            document.getElementById('scene-hint').textContent = play.hint;
            document.getElementById('genre-tag').textContent = play.genre;

            const choicesEl = document.getElementById('choices');
            choicesEl.innerHTML = '';
            choices.forEach((c, i) => {
                const btn = document.createElement('button');
                btn.className = 'choice-btn';
                btn.innerHTML = '<span class="letter">' + String.fromCharCode(65 + i) + '</span>' + c.title;
                btn.onclick = () => pickAnswer(c, play, btn);
                choicesEl.appendChild(btn);
            });

            document.getElementById('result-panel').classList.remove('show');
            document.getElementById('result-panel').style.display = 'none';

            // Update dots
            for (let i = 0; i < TOTAL_ROUNDS; i++) {
                const dot = document.getElementById('dot-' + i);
                dot.className = 'dot';
                if (i === currentRound) dot.classList.add('current');
                if (i < currentRound) {
                    const rd = roundData[i];
                    dot.classList.add(rd.correct ? 'correct' : 'wrong');
                }
            }
        }

        function pickAnswer(chosen, correct, btnEl) {
            const isCorrect = chosen.title === correct.title;
            const buttons = document.querySelectorAll('.choice-btn');
            buttons.forEach(b => {
                b.disabled = true;
                const title = b.textContent.substring(1).trim();
                if (title === correct.title) {
                    b.classList.add('correct');
                } else if (b === btnEl && !isCorrect) {
                    b.classList.add('wrong');
                }
            });

            if (isCorrect) {
                streak++;
                if (streak > maxStreak) maxStreak = streak;
                const basePoints = 10;
                const streakBonus = Math.min(streak - 1, 5);
                const points = basePoints + streakBonus;
                score += points;
            } else {
                streak = 0;
            }

            roundData.push({
                question: correct.summary,
                answer: correct.title,
                chosen: chosen.title,
                correct: isCorrect,
                funFact: correct.funFact,
                genre: correct.genre
            });

            document.getElementById('score').textContent = score;
            document.getElementById('streak').textContent = streak;

            const panel = document.getElementById('result-panel');
            const title = document.getElementById('result-title');
            const fact = document.getElementById('result-fact');

            if (isCorrect) {
                title.textContent = '\u2726 Bravo! \u2726';
                title.className = 'result-title hit';
            } else {
                title.textContent = 'Not quite...';
                title.className = 'result-title miss';
            }

            fact.innerHTML = 'The answer was <strong style="color: var(--gold);">' + correct.title + '</strong>.<br>' + correct.funFact;

            panel.style.display = 'block';
            panel.classList.add('show');

            if (currentRound === TOTAL_ROUNDS - 1) {
                document.getElementById('next-btn').textContent = 'See Final Review';
            } else {
                document.getElementById('next-btn').textContent = 'Next Scene';
            }
        }

        function nextRound() {
            currentRound++;
            if (currentRound >= TOTAL_ROUNDS) {
                showFinal();
            } else {
                loadRound();
            }
        }

        function showFinal() {
            document.getElementById('game-area').style.display = 'none';
            document.getElementById('game-header').style.display = 'none';
            document.getElementById('final-scene').classList.add('show');

            const correctCount = roundData.filter(r => r.correct).length;
            const finalScore = Math.round((score / (TOTAL_ROUNDS * 15)) * 100);
            const clampedScore = Math.min(finalScore, 100);

            document.getElementById('final-score').textContent = clampedScore;

            // Star rating
            const stars = Math.ceil((correctCount / TOTAL_ROUNDS) * 5);
            const starStr = '\u2605'.repeat(stars) + '\u2606'.repeat(5 - stars);
            document.getElementById('star-rating').textContent = starStr;

            // Critic quote
            const critics = [
                { threshold: 90, quote: '"A performance for the ages! The Globe would be proud."', name: '— The London Stage Review' },
                { threshold: 70, quote: '"A solid showing. The Bard himself would nod in approval."', name: '— The Stratford Herald' },
                { threshold: 50, quote: '"Some hits, some misses — but the spirit is willing."', name: '— The Avon Gazette' },
                { threshold: 30, quote: '"A rocky start, but every actor has their off night."', name: '— The Blackfriars Bugle' },
                { threshold: 0, quote: '"Consider brushing up on your First Folio. No judgment."', name: '— The Groundlings\' Gazette' }
            ];
            const critic = critics.find(c => clampedScore >= c.threshold);
            document.getElementById('critic-quote').textContent = critic.quote;
            document.getElementById('critic-name').textContent = critic.name;

            // Review list
            const list = document.getElementById('review-list');
            list.innerHTML = '';
            roundData.forEach((r, i) => {
                const div = document.createElement('div');
                div.className = 'review-card';
                div.innerHTML =
                    '<div class="rv-q">' + (i + 1) + '. ' + r.question + '</div>' +
                    '<div class="rv-a">Answer: ' + r.answer + ' <span style="color: var(--gold-dim);">(' + r.genre + ')</span></div>' +
                    '<div class="rv-you ' + (r.correct ? 'correct' : 'wrong') + '">' +
                    (r.correct ? '\u2713 Correct' : '\u2717 You chose: ' + r.chosen) +
                    '</div>';
                list.appendChild(div);
            });
        }

        // Start on load
        startGame();
    </script>
</body>
</html>
