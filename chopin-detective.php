<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chopin Detective — Name the Masterpiece</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:wght@300;400;600&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --midnight: #0a0e1a;
            --deep-navy: #0f1525;
            --navy: #161d33;
            --gold: #d4a853;
            --gold-dim: #8a7040;
            --gold-bright: #f0c96e;
            --cream: #f5f0e1;
            --cream-dim: #c8c2b0;
            --rose: #b85c6e;
            --green: #5a8a6e;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: var(--midnight);
            color: var(--cream);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── STAGE SPOTLIGHT ── */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 120vw;
            height: 120vh;
            background: radial-gradient(ellipse at center, rgba(212,168,83,0.06) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── FLOATING GOLD DUST ── */
        .dust {
            position: fixed;
            width: 3px;
            height: 3px;
            background: var(--gold);
            border-radius: 50%;
            opacity: 0.3;
            pointer-events: none;
            animation: drift linear infinite;
            z-index: 1;
        }
        @keyframes drift {
            0% { transform: translateY(100vh) translateX(0); opacity: 0; }
            10% { opacity: 0.4; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-10vh) translateX(40px); opacity: 0; }
        }

        /* ── PIANO KEYBOARD STRIP ── */
        .piano-strip {
            display: flex;
            height: 32px;
            overflow: hidden;
            opacity: 0.15;
            margin-bottom: 8px;
        }
        .piano-key {
            flex: 1;
            border-right: 1px solid var(--navy);
            background: var(--cream);
            position: relative;
        }
        .piano-key.black::after {
            content: '';
            position: absolute;
            right: -5px;
            top: 0;
            width: 60%;
            height: 60%;
            background: var(--midnight);
            z-index: 2;
        }

        /* ── LAYOUT ── */
        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 24px 20px 48px;
            position: relative;
            z-index: 2;
        }

        /* ── HEADER ── */
        header {
            text-align: center;
            padding: 32px 0 24px;
        }
        .subtitle {
            font-family: 'Cinzel', serif;
            font-size: 0.7em;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 12px;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2em, 6vw, 3em);
            font-weight: 700;
            color: var(--gold);
            line-height: 1.1;
            margin-bottom: 8px;
        }
        h1 em {
            font-style: italic;
            font-weight: 400;
            color: var(--cream-dim);
        }
        .tagline {
            font-size: 1em;
            color: var(--cream-dim);
            max-width: 420px;
            margin: 12px auto 0;
            line-height: 1.5;
            font-weight: 300;
        }

        /* ── SCORE BAR ── */
        .score-bar {
            display: flex;
            justify-content: center;
            gap: 32px;
            margin: 20px 0 28px;
            font-size: 0.85em;
            color: var(--cream-dim);
        }
        .score-bar span { color: var(--gold); font-weight: 600; }

        /* ── PROGRESS DOTS ── */
        .progress-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 28px;
        }
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--navy);
            border: 1px solid var(--gold-dim);
            transition: all 0.4s ease;
        }
        .dot.current { background: var(--gold); border-color: var(--gold); box-shadow: 0 0 8px rgba(212,168,83,0.4); }
        .dot.correct { background: var(--green); border-color: var(--green); }
        .dot.wrong { background: var(--rose); border-color: var(--rose); }

        /* ── GAME CARD ── */
        .card {
            background: var(--deep-navy);
            border: 1px solid rgba(212,168,83,0.2);
            border-radius: 16px;
            padding: 32px 28px;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            opacity: 0.6;
        }

        .round-label {
            font-family: 'Cinzel', serif;
            font-size: 0.65em;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 16px;
        }

        .clue-box {
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .clue {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.15em, 3.5vw, 1.4em);
            line-height: 1.55;
            color: var(--cream);
            margin-bottom: 12px;
            opacity: 0;
            transform: translateY(12px);
            animation: clueIn 0.6s ease forwards;
        }
        @keyframes clueIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .clue-meta {
            font-size: 0.8em;
            color: var(--gold-dim);
            font-style: italic;
        }

        .reveal-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            border: 1px solid var(--gold-dim);
            color: var(--gold);
            padding: 8px 18px;
            border-radius: 24px;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 0.85em;
            cursor: pointer;
            margin-top: 16px;
            transition: all 0.3s ease;
        }
        .reveal-btn:hover {
            border-color: var(--gold);
            background: rgba(212,168,83,0.08);
        }
        .reveal-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .reveal-btn svg { width: 14px; height: 14px; }

        /* ── ANSWER OPTIONS ── */
        .options {
            display: grid;
            gap: 10px;
            margin-top: 24px;
        }
        .option {
            background: var(--navy);
            border: 1px solid rgba(212,168,83,0.15);
            border-radius: 10px;
            padding: 14px 18px;
            cursor: pointer;
            transition: all 0.25s ease;
            font-size: 0.95em;
            line-height: 1.4;
            text-align: left;
            color: var(--cream);
        }
        .option:hover {
            border-color: var(--gold);
            background: rgba(212,168,83,0.06);
            transform: translateX(4px);
        }
        .option.correct {
            border-color: var(--green);
            background: rgba(90,138,110,0.15);
        }
        .option.wrong {
            border-color: var(--rose);
            background: rgba(184,92,110,0.15);
        }
        .option.reveal-correct {
            border-color: var(--green);
            background: rgba(90,138,110,0.12);
            animation: pulseCorrect 0.8s ease;
        }
        @keyframes pulseCorrect {
            0%, 100% { box-shadow: 0 0 0 0 rgba(90,138,110,0.4); }
            50% { box-shadow: 0 0 0 8px rgba(90,138,110,0); }
        }
        .option .label {
            display: inline-block;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 1px solid var(--gold-dim);
            text-align: center;
            line-height: 20px;
            font-size: 0.75em;
            margin-right: 10px;
            color: var(--gold-dim);
            flex-shrink: 0;
        }
        .option:hover .label { border-color: var(--gold); color: var(--gold); }
        .option.correct .label { border-color: var(--green); color: var(--green); }
        .option.wrong .label { border-color: var(--rose); color: var(--rose); }
        .option.reveal-correct .label { border-color: var(--green); color: var(--green); }

        /* ── FEEDBACK STRIP ── */
        .feedback {
            margin-top: 20px;
            padding: 16px;
            border-radius: 10px;
            font-size: 0.9em;
            line-height: 1.55;
            display: none;
        }
        .feedback.show { display: block; animation: fadeIn 0.4s ease; }
        .feedback.correct { background: rgba(90,138,110,0.12); border: 1px solid rgba(90,138,110,0.3); }
        .feedback.wrong { background: rgba(184,92,110,0.12); border: 1px solid rgba(184,92,110,0.3); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .feedback strong { color: var(--gold); }

        .next-btn {
            display: block;
            width: 100%;
            margin-top: 16px;
            padding: 14px;
            background: linear-gradient(135deg, var(--gold-dim), var(--gold));
            color: var(--midnight);
            border: none;
            border-radius: 10px;
            font-family: 'Cinzel', serif;
            font-size: 0.85em;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .next-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(212,168,83,0.25); }

        /* ── INTRO SCREEN ── */
        #intro-screen {
            text-align: center;
            padding: 40px 0 20px;
        }
        .intro-icon {
            font-size: 3.5em;
            margin-bottom: 16px;
            opacity: 0.8;
        }
        .intro-text {
            font-size: 1.05em;
            color: var(--cream-dim);
            line-height: 1.7;
            max-width: 480px;
            margin: 0 auto 32px;
        }
        .start-btn {
            display: inline-block;
            padding: 16px 48px;
            background: linear-gradient(135deg, var(--gold), var(--gold-bright));
            color: var(--midnight);
            border: none;
            border-radius: 30px;
            font-family: 'Cinzel', serif;
            font-size: 0.9em;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .start-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(212,168,83,0.3); }

        /* ── RESULTS SCREEN ── */
        #results-screen {
            display: none;
            text-align: center;
            padding: 40px 0;
        }
        .results-score {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3em, 8vw, 4.5em);
            color: var(--gold);
            line-height: 1;
        }
        .results-label {
            font-family: 'Cinzel', serif;
            font-size: 0.75em;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin: 8px 0 24px;
        }
        .results-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5em;
            color: var(--cream);
            margin-bottom: 12px;
        }
        .results-desc {
            font-size: 1em;
            color: var(--cream-dim);
            line-height: 1.6;
            max-width: 460px;
            margin: 0 auto 32px;
        }
        .restart-btn {
            display: inline-block;
            padding: 14px 36px;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold);
            border-radius: 30px;
            font-family: 'Cinzel', serif;
            font-size: 0.8em;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .restart-btn:hover { background: rgba(212,168,83,0.1); }

        .results-breakdown {
            margin-top: 32px;
            text-align: left;
        }
        .results-breakdown h3 {
            font-family: 'Cinzel', serif;
            font-size: 0.75em;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 16px;
            text-align: center;
        }
        .result-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(212,168,83,0.1);
        }
        .result-row:last-child { border-bottom: none; }
        .result-status { font-size: 1.1em; width: 24px; text-align: center; }
        .result-piece { flex: 1; font-size: 0.9em; }
        .result-piece-name { color: var(--cream); }
        .result-piece-type { font-size: 0.8em; color: var(--gold-dim); }
        .result-points { font-size: 0.85em; color: var(--gold); font-weight: 600; }

        /* ── STREAK BANNER ── */
        .streak-banner {
            display: none;
            text-align: center;
            padding: 8px 16px;
            background: rgba(212,168,83,0.1);
            border: 1px solid rgba(212,168,83,0.2);
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 0.85em;
            color: var(--gold);
        }
        .streak-banner.show { display: block; animation: fadeIn 0.4s ease; }

        /* ── GAME SCREEN ── */
        #game-screen { display: none; }

        /* ── FOOTER ── */
        footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid rgba(212,168,83,0.1);
            font-size: 0.75em;
            color: var(--gold-dim);
        }
        footer a { color: var(--gold-dim); text-decoration: none; }
        footer a:hover { color: var(--gold); }

        /* ── MOBILE ── */
        @media (max-width: 480px) {
            .container { padding: 16px 14px 32px; }
            .card { padding: 24px 18px; }
            .score-bar { gap: 20px; font-size: 0.8em; }
        }
    </style>
</head>
<body>
    <div class="piano-strip" id="pianoStrip"></div>
    <div class="container">
        <header>
            <p class="subtitle">The Music of Frédéric Chopin</p>
            <h1>Chopin <em>Detective</em></h1>
            <p class="tagline">Jon wore out a Chopin cassette as a boy. Can you name these masterpieces from just a few clues?</p>
        </header>

        <div id="intro-screen">
            <div class="intro-icon">🎹</div>
            <p class="intro-text">
                Twelve of Chopin's finest works lie before you. Each round, you'll receive up to four clues — key, opus, year, and a description. The sooner you guess correctly, the more points you earn. Can you identify them all?
            </p>
            <button class="start-btn" onclick="startGame()">Begin the Concert</button>
        </div>

        <div id="game-screen">
            <div class="score-bar">
                <div>Score: <span id="score">0</span></div>
                <div>Streak: <span id="streak">0</span></div>
                <div>Round: <span id="round-num">1</span>/12</div>
            </div>
            <div class="progress-dots" id="dots"></div>
            <div class="streak-banner" id="streak-banner"></div>

            <div class="card">
                <div class="round-label" id="round-label">Round 1</div>
                <div class="clue-box" id="clue-box"></div>
                <button class="reveal-btn" id="reveal-btn" onclick="revealNextClue()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Reveal next clue
                </button>

                <div class="options" id="options"></div>
                <div class="feedback" id="feedback"></div>
            </div>
        </div>

        <div id="results-screen">
            <div class="results-score" id="final-score">0</div>
            <div class="results-label">Points</div>
            <div class="results-title" id="results-title">Concert Novice</div>
            <div class="results-desc" id="results-desc"></div>
            <button class="restart-btn" onclick="startGame()">Play Again</button>
            <div class="results-breakdown" id="breakdown"></div>
        </div>

        <footer>
            Inspired by Jon's <a href="https://jona.ca/2010/02/favorite-author-poet-composer-austen.html">favorite composer post</a> &middot; Built by Chloe
        </footer>
    </div>

    <script>
    // ── CHOPIN MASTERPIECES DATA ──
    const PIECES = [
        {
            name: "Nocturne in E-flat major, Op. 9 No. 2",
            shortName: "Nocturne in E-flat major",
            type: "Nocturne",
            key: "E-flat major",
            opus: "Op. 9, No. 2",
            year: "1832",
            clues: [
                "A nocturne in E-flat major, composed when the pianist was just 22.",
                "The left hand rocks gently in a repeating arpeggio while the right sings a ornamental melody.",
                "It is perhaps the most famous nocturne ever written — instantly recognisable from its first ornamented phrase.",
                "Chopin himself apparently never grew tired of it; he played it at nearly every social occasion."
            ],
            fact: "Chopin wrote this at 22 and it became his calling card. The famous opening ornament was so characteristic that pianists still argue about exactly how to play it."
        },
        {
            name: "Nocturne in C-sharp minor, Op. posth.",
            shortName: "Nocturne in C-sharp minor",
            type: "Nocturne",
            key: "C-sharp minor",
            opus: "Op. posth.",
            year: "1830",
            clues: [
                "A nocturne in C-sharp minor, published only after the composer's death.",
                "It opens with a dotted-rhythm motto in octaves, like a funeral drum, before a plaintive melody emerges.",
                "The middle section shifts to D-flat major — a key a semitone away, like stepping from shadow into weak light.",
                "It gained modern fame through a pivotal scene in Roman Polanski's 2002 film <em>The Pianist</em>."
            ],
            fact: "This was not published until 1875, 26 years after Chopin's death. Wladyslaw Szpilman played it in the ruins of Warsaw in <em>The Pianist</em>."
        },
        {
            name: 'Prelude in D-flat major "Raindrop", Op. 28 No. 15',
            shortName: 'Prelude "Raindrop"',
            type: "Prelude",
            key: "D-flat major",
            opus: "Op. 28, No. 15",
            year: "1839",
            clues: [
                "A prelude in D-flat major, one of twenty-four written during a winter on Majorca.",
                "Throughout the piece, a single A-flat repeats like an insistent dripping — a note the composer heard during a rainstorm, he claimed.",
                "The middle section plunges into D-flat minor with thunderous chords, as if the storm has broken.",
                "George Sand wrote that her partner composed this while watching raindrops fall on the monastery roof at Valldemossa."
            ],
            fact: "Chopin and George Sand fled to Majorca for his health, but the damp monastery made things worse. This prelude was born from literal raindrops."
        },
        {
            name: "Prelude in E minor, Op. 28 No. 4",
            shortName: "Prelude in E minor",
            type: "Prelude",
            key: "E minor",
            opus: "Op. 28, No. 4",
            year: "1839",
            clues: [
                "A prelude in E minor, just thirty-four bars long but devastating in its restraint.",
                "The melody descends step by step while a single repeated bass note tolls underneath, like a dying heartbeat.",
                "Hans von Bülow called it 'the most painful piece of music ever written.'",
                "It was played at the composer's own funeral — by his request."
            ],
            fact: "Chopin asked that this be played at his funeral. It is under a minute long, yet musicians debate whether anything more sorrowful exists."
        },
        {
            name: 'Waltz in D-flat major "Minute Waltz", Op. 64 No. 1',
            shortName: '"Minute" Waltz',
            type: "Waltz",
            key: "D-flat major",
            opus: "Op. 64, No. 1",
            year: "1847",
            clues: [
                "A waltz in D-flat major, barely a minute long at full speed — though 'minute' here means tiny, not sixty seconds.",
                "The right hand spins in rapid circles like a small dog chasing its tail.",
                "Chopin composed it as a portrait of a friend's dog chasing its own tail in the garden.",
                "It is the most famous waltz by the composer who wrote more than any other major Romantic for the form."
            ],
            fact: "The nickname 'Minute' (meaning tiny, not 60 seconds) stuck because the piece is so brief. Chopin supposedly wrote it after watching George Sand's dog chase its tail."
        },
        {
            name: "Ballade No. 1 in G minor, Op. 23",
            shortName: "Ballade No. 1",
            type: "Ballade",
            key: "G minor",
            opus: "Op. 23",
            year: "1835",
            clues: [
                "A ballade in G minor, the first of four epic narrative works that invented the piano ballade as a genre.",
                "It opens with a single questioning C major chord, as if asking a riddle, before sweeping into a tale of passion and tragedy.",
                "The coda erupts into cascading arpeggios and crashing chords that only a fearless pianist dares attempt.",
                "It appears in the 1991 film <em>The Pianist</em> and is considered by many the greatest single work for solo piano."
            ],
            fact: "Chopin invented the piano ballade — no major composer had written one before. This first ballade is widely considered the greatest work ever written for solo piano."
        },
        {
            name: 'Etude in C minor "Revolutionary", Op. 10 No. 12',
            shortName: '"Revolutionary" Etude',
            type: "Etude",
            key: "C minor",
            opus: "Op. 10, No. 12",
            year: "1831",
            clues: [
                "An etude in C minor, composed in a white-hot fury after the composer learned that his homeland had fallen.",
                "The left hand pounds out thunderous arpeggios while the right hand declaims a heroic theme above them.",
                "It was written in September 1831, after news arrived that Warsaw had been captured by Russian forces.",
                "The 'Revolutionary' nickname stuck because it sounds like a battle cry — though the composer himself hated the title."
            ],
            fact: "Chopin was in Vienna when Warsaw fell. He wrote in his diary: 'Oh God, are You there? You see what they are doing? And You do not avenge it?'"
        },
        {
            name: 'Etude in E major "Tristesse", Op. 10 No. 3',
            shortName: '"Tristesse" Etude',
            type: "Etude",
            key: "E major",
            opus: "Op. 10, No. 3",
            year: "1832",
            clues: [
                "An etude in E major that the composer himself declared the most beautiful melody he ever wrote.",
                "The melody is so achingly tender that it seems almost too intimate for a concert hall.",
                "The middle section darkens into E minor, like a cloud passing over the sun, before the melody returns.",
                "Its nickname means 'sadness' in French — though the composer never used it himself."
            ],
            fact: "Chopin once said he had never written a more beautiful melody. On his deathbed, he asked his friend to play it — but not the middle section, which was too painful."
        },
        {
            name: 'Polonaise in A-flat major "Heroic", Op. 53',
            shortName: '"Heroic" Polonaise',
            type: "Polonaise",
            key: "A-flat major",
            opus: "Op. 53",
            year: "1842",
            clues: [
                "A polonaise in A-flat major that sounds like an army marching to free a nation.",
                "The left hand gallops in octaves while the right proclaims a triumphant theme of almost operatic grandeur.",
                "It includes a famous middle section where rapid descending scales sweep like cavalry across the keyboard.",
                "This is the most famous polonaise ever written — a patriotic anthem for a country that did not exist on any map."
            ],
            fact: "Chopin wrote this at the height of his powers. The octaves in the left hand are so relentless that pianists call it a test of physical endurance."
        },
        {
            name: "Fantaisie-Impromptu in C-sharp minor, Op. posth. 66",
            shortName: "Fantaisie-Impromptu",
            type: "Impromptu",
            key: "C-sharp minor",
            opus: "Op. posth. 66",
            year: "1834",
            clues: [
                "An impromptu in C-sharp minor with a middle section in D-flat major — the same notes on the keyboard, named differently.",
                "The outer sections are a whirlwind of sixteenth notes that cross hands in dizzying patterns.",
                "The middle melody is one of the most famous tunes ever written — gentle, nostalgic, almost like a pop song from another century.",
                "The composer asked that it be burned after his death; thankfully, his friends ignored him."
            ],
            fact: "Chopin wanted this destroyed. Jules Fontana published it posthumously anyway, and its middle section became one of the most beloved melodies in classical music."
        },
        {
            name: "Ballade No. 4 in F minor, Op. 52",
            shortName: "Ballade No. 4",
            type: "Ballade",
            key: "F minor",
            opus: "Op. 52",
            year: "1842",
            clues: [
                "A ballade in F minor, the last and most structurally perfect of the four epic narratives.",
                "It weaves together multiple themes in a way that feels like a novel in music — with a prologue, development, and tragic conclusion.",
                "The coda is a miracle of piano writing: a theme that was introduced quietly at the beginning returns in massive chords and runs.",
                "The composer considered this his favourite of the ballades, and many pianists agree it is his greatest single composition."
            ],
            fact: "Chopin reportedly said this was his favourite of the ballades. John Ogdon called it 'the most exalted, intense, and sublimely powerful' work in the piano literature."
        },
        {
            name: "Scherzo No. 2 in B-flat minor, Op. 31",
            shortName: "Scherzo No. 2",
            type: "Scherzo",
            key: "B-flat minor",
            opus: "Op. 31",
            year: "1837",
            clues: [
                "A scherzo in B-flat minor that begins with a whispered question — three quiet chords, then silence.",
                "It explodes into a ferocious dance of cascading thirds and crashing octaves, then suddenly turns tender in the middle.",
                "The central section is a chorale-like melody in B-flat major, as if a church choir has interrupted a storm.",
                "It was a favourite of Franz Liszt, who performed it throughout Europe with almost demonic energy."
            ],
            fact: "Liszt loved this piece and played it everywhere. The opening three soft chords are among the most dramatic moments in all of piano music."
        }
    ];

    // ── GAME STATE ──
    let currentRound = 0;
    let score = 0;
    let streak = 0;
    let clueIndex = 0;
    let answered = false;
    let roundData = [];
    let shuffledPieces = [];

    // ── INIT ──
    function initDots() {
        const dots = document.getElementById('dots');
        dots.innerHTML = '';
        for (let i = 0; i < 12; i++) {
            const d = document.createElement('div');
            d.className = 'dot';
            dots.appendChild(d);
        }
    }

    function updateDots() {
        const dots = document.querySelectorAll('.dot');
        dots.forEach((d, i) => {
            d.className = 'dot';
            if (i < currentRound) {
                d.classList.add(roundData[i].correct ? 'correct' : 'wrong');
            } else if (i === currentRound) {
                d.classList.add('current');
            }
        });
    }

    function shuffleArray(arr) {
        const a = [...arr];
        for (let i = a.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [a[i], a[j]] = [a[j], a[i]];
        }
        return a;
    }

    function getDistractors(correct, all) {
        const others = all.filter(p => p.name !== correct.name);
        const shuffled = shuffleArray(others);
        return shuffled.slice(0, 3);
    }

    function buildPianoStrip() {
        const strip = document.getElementById('pianoStrip');
        const pattern = [0,1,0,1,0,0,1,0,1,0,1,0];
        for (let i = 0; i < 52; i++) {
            const k = document.createElement('div');
            k.className = 'piano-key' + (pattern[i % 12] ? ' black' : '');
            strip.appendChild(k);
        }
    }

    function createDust() {
        for (let i = 0; i < 20; i++) {
            const d = document.createElement('div');
            d.className = 'dust';
            d.style.left = Math.random() * 100 + 'vw';
            d.style.animationDuration = (12 + Math.random() * 20) + 's';
            d.style.animationDelay = Math.random() * 15 + 's';
            d.style.width = (2 + Math.random() * 3) + 'px';
            d.style.height = d.style.width;
            document.body.appendChild(d);
        }
    }

    // ── GAME FLOW ──
    function startGame() {
        currentRound = 0;
        score = 0;
        streak = 0;
        roundData = [];
        shuffledPieces = shuffleArray(PIECES);

        document.getElementById('intro-screen').style.display = 'none';
        document.getElementById('results-screen').style.display = 'none';
        document.getElementById('game-screen').style.display = 'block';

        initDots();
        updateDots();
        updateScoreBar();
        loadRound();
    }

    function updateScoreBar() {
        document.getElementById('score').textContent = score;
        document.getElementById('streak').textContent = streak;
        document.getElementById('round-num').textContent = currentRound + 1;
    }

    function loadRound() {
        answered = false;
        clueIndex = 0;
        const piece = shuffledPieces[currentRound];

        document.getElementById('round-label').textContent = 'Round ' + (currentRound + 1) + ' of 12';
        document.getElementById('feedback').className = 'feedback';
        document.getElementById('feedback').innerHTML = '';
        document.getElementById('reveal-btn').disabled = false;
        document.getElementById('reveal-btn').style.display = 'inline-flex';

        const distractors = getDistractors(piece, PIECES);
        const options = shuffleArray([piece, ...distractors]);

        renderClueBox(piece);
        renderOptions(options, piece);
        updateDots();
    }

    function renderClueBox(piece) {
        const box = document.getElementById('clue-box');
        box.innerHTML = '';

        const clue = document.createElement('div');
        clue.className = 'clue';
        clue.innerHTML = piece.clues[0];
        box.appendChild(clue);

        const meta = document.createElement('div');
        meta.className = 'clue-meta';
        meta.textContent = 'Clue 1 of 4';
        box.appendChild(meta);
    }

    function revealNextClue() {
        if (answered) return;
        const piece = shuffledPieces[currentRound];
        clueIndex++;
        if (clueIndex >= piece.clues.length) {
            document.getElementById('reveal-btn').disabled = true;
            return;
        }

        const box = document.getElementById('clue-box');
        const clue = document.createElement('div');
        clue.className = 'clue';
        clue.style.animationDelay = '0s';
        clue.innerHTML = piece.clues[clueIndex];
        box.insertBefore(clue, box.lastElementChild);

        box.lastElementChild.textContent = 'Clue ' + (clueIndex + 1) + ' of 4';

        if (clueIndex >= piece.clues.length - 1) {
            document.getElementById('reveal-btn').disabled = true;
        }
    }

    function renderOptions(options, correct) {
        const container = document.getElementById('options');
        container.innerHTML = '';
        const labels = ['A', 'B', 'C', 'D'];

        options.forEach((opt, i) => {
            const btn = document.createElement('button');
            btn.className = 'option';
            btn.dataset.name = opt.name;
            btn.innerHTML = '<span class="label">' + labels[i] + '</span>' + opt.shortName;
            btn.onclick = () => selectAnswer(opt, correct, btn);
            container.appendChild(btn);
        });
    }

    function selectAnswer(selected, correct, btnEl) {
        if (answered) return;
        answered = true;

        const isCorrect = selected.name === correct.name;
        const allOpts = document.querySelectorAll('.option');

        if (isCorrect) {
            btnEl.classList.add('correct');
            streak++;
            const basePoints = 100;
            const cluePenalty = clueIndex * 15;
            const streakBonus = Math.min(streak - 1, 5) * 10;
            const roundScore = Math.max(basePoints - cluePenalty + streakBonus, 20);
            score += roundScore;

            roundData.push({ correct: true, piece: correct, points: roundScore });

            showFeedback(true, correct, roundScore);
            showStreakBanner();
        } else {
            btnEl.classList.add('wrong');
            streak = 0;
            roundData.push({ correct: false, piece: correct, points: 0 });

            allOpts.forEach(o => {
                if (o.dataset.name === correct.name) {
                    o.classList.add('reveal-correct');
                }
            });

            showFeedback(false, correct, 0);
            hideStreakBanner();
        }

        updateScoreBar();
        document.getElementById('reveal-btn').style.display = 'none';
    }

    function showFeedback(isCorrect, piece, pts) {
        const fb = document.getElementById('feedback');
        fb.className = 'feedback ' + (isCorrect ? 'correct' : 'wrong') + ' show';

        let html = '';
        if (isCorrect) {
            html += '<strong>Bravo!</strong> You identified it from ' + (clueIndex + 1) + ' clue' + (clueIndex > 0 ? 's' : '') + '. ';
            html += '+' + pts + ' points' + (streak > 1 ? ' (streak bonus!)' : '') + '.';
        } else {
            html += '<strong>Not quite.</strong> The answer was <em>' + piece.shortName + '</em>.';
        }
        html += '<div style="margin-top:10px; font-size:0.9em; opacity:0.85;">' + piece.fact + '</div>';
        html += '<button class="next-btn" onclick="nextRound()">' + (currentRound < 11 ? 'Next Round' : 'See Results') + '</button>';

        fb.innerHTML = html;
    }

    function showStreakBanner() {
        const banner = document.getElementById('streak-banner');
        if (streak >= 3) {
            const messages = ['🔥 Hot streak! ' + streak + ' in a row!', '⚡ On fire! ' + streak + ' correct!', '🎹 Magnificent! ' + streak + ' straight!'];
            banner.textContent = messages[Math.min(streak - 3, messages.length - 1)];
            banner.classList.add('show');
        }
    }

    function hideStreakBanner() {
        document.getElementById('streak-banner').classList.remove('show');
    }

    function nextRound() {
        currentRound++;
        if (currentRound >= 12) {
            showResults();
        } else {
            loadRound();
        }
    }

    function showResults() {
        document.getElementById('game-screen').style.display = 'none';
        document.getElementById('results-screen').style.display = 'block';

        const finalScore = document.getElementById('final-score');
        let displayed = 0;
        const target = score;
        const interval = setInterval(() => {
            displayed += Math.ceil((target - displayed) / 8);
            if (displayed >= target) {
                displayed = target;
                clearInterval(interval);
            }
            finalScore.textContent = displayed;
        }, 40);

        const correctCount = roundData.filter(r => r.correct).length;
        const titleEl = document.getElementById('results-title');
        const descEl = document.getElementById('results-desc');

        if (correctCount === 12) {
            titleEl.textContent = 'Virtuoso!';
            descEl.textContent = 'A perfect score! You know Chopin as intimately as Jon knew that worn cassette tape. Every clue, every nuance — unmistakable. Bravissimo!';
        } else if (correctCount >= 10) {
            titleEl.textContent = 'Concert Pianist';
            descEl.textContent = 'Superb! You have a deep ear for Chopin. Only a handful escaped you. A few more listens to the nocturnes and you will be unstoppable.';
        } else if (correctCount >= 7) {
            titleEl.textContent = 'Music Lover';
            descEl.textContent = 'A fine performance! You know your Chopin well, even if a few of the deeper cuts surprised you. Time to revisit the ballades.';
        } else if (correctCount >= 4) {
            titleEl.textContent = 'Apprentice';
            descEl.textContent = 'A respectable start. Chopin is a lifelong journey — every great listener begins somewhere. Keep that cassette spinning.';
        } else {
            titleEl.textContent = 'Curious Novice';
            descEl.textContent = 'Everyone starts somewhere. Chopin wrote music that reveals more with every hearing. Put on the Nocturne in E-flat and try again tomorrow.';
        }

        // Build breakdown
        const bd = document.getElementById('breakdown');
        let html = '<h3>Your Performance</h3>';
        roundData.forEach((r, i) => {
            html += '<div class="result-row">';
            html += '<span class="result-status">' + (r.correct ? '✓' : '✗') + '</span>';
            html += '<div class="result-piece">';
            html += '<div class="result-piece-name">' + r.piece.shortName + '</div>';
            html += '<div class="result-piece-type">' + r.piece.type + ' &middot; ' + r.piece.key + '</div>';
            html += '</div>';
            html += '<span class="result-points">' + (r.correct ? '+' + r.points : '—') + '</span>';
            html += '</div>';
        });
        bd.innerHTML = html;
    }

    // ── BOOT ──
    buildPianoStrip();
    createDust();
    </script>
</body>
</html>
