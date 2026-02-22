<?php
// History Date Guesser — inspired by Jon's "World History on an Index Card" post
// Events drawn from Richard Overy's "50 Key Dates of World History" and
// Diane Moczar's "Ten Dates Every Catholic Should Know"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>History Date Guesser</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #0f0e17;
            --surface: #1a1929;
            --card: #23213a;
            --accent: #e8c547;
            --accent2: #7c6af7;
            --good: #5edc8c;
            --ok: #f0a830;
            --bad: #e85c5c;
            --text: #f0eefc;
            --muted: #8a879f;
            --border: #33304d;
        }

        html { height: 100%; }
        body {
            font-family: system-ui, -apple-system, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px;
        }

        #app {
            width: 100%;
            max-width: 680px;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        /* ── Header ─────────────────────────────────────── */
        header {
            text-align: center;
            padding: 24px 0 20px;
        }
        header h1 {
            font-size: 1.9em;
            font-weight: 900;
            letter-spacing: -1px;
            background: linear-gradient(135deg, var(--accent), #f08040);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        header p {
            color: var(--muted);
            font-size: 0.88em;
            margin-top: 6px;
            line-height: 1.4;
        }

        /* ── Score bar ───────────────────────────────────── */
        #scorebar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 16px;
        }
        #scorebar .stat { text-align: center; }
        #scorebar .stat .label { font-size: 0.72em; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; }
        #scorebar .stat .val { font-size: 1.5em; font-weight: 800; color: var(--accent); }

        /* ── Card ────────────────────────────────────────── */
        #event-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px 24px 24px;
            margin-bottom: 16px;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        #progress-bar-outer {
            width: 100%;
            height: 4px;
            background: var(--border);
            border-radius: 4px;
        }
        #progress-bar-inner {
            height: 100%;
            background: var(--accent2);
            border-radius: 4px;
            transition: width 0.4s ease;
        }
        #event-category {
            font-size: 0.75em;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--accent2);
        }
        #event-name {
            font-size: 1.35em;
            font-weight: 800;
            line-height: 1.3;
            color: var(--text);
        }
        #event-hint {
            font-size: 0.88em;
            color: var(--muted);
            line-height: 1.5;
            font-style: italic;
        }
        #question-num {
            font-size: 0.78em;
            color: var(--muted);
            text-align: right;
        }

        /* ── Timeline ────────────────────────────────────── */
        #timeline-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 20px 24px;
            margin-bottom: 16px;
        }
        #timeline-instruction {
            font-size: 0.82em;
            color: var(--muted);
            text-align: center;
            margin-bottom: 16px;
        }
        #timeline-wrap {
            position: relative;
            padding: 40px 8px 32px;
            cursor: crosshair;
            user-select: none;
            touch-action: none;
        }
        #timeline-line {
            height: 6px;
            background: linear-gradient(90deg, #2a2845, var(--accent2), var(--accent), #c04040);
            border-radius: 3px;
            position: relative;
        }

        /* era labels */
        .era-label {
            position: absolute;
            bottom: -24px;
            font-size: 0.68em;
            color: var(--muted);
            transform: translateX(-50%);
            white-space: nowrap;
        }
        /* tick marks */
        .tick {
            position: absolute;
            top: -4px;
            width: 1px;
            height: 14px;
            background: var(--border);
            transform: translateX(-50%);
        }

        /* hover preview needle */
        #preview-needle {
            position: absolute;
            top: -30px;
            width: 2px;
            background: rgba(255,255,255,0.3);
            height: 66px;
            transform: translateX(-50%);
            pointer-events: none;
            display: none;
        }
        #preview-year {
            position: absolute;
            top: -26px;
            transform: translateX(-50%);
            font-size: 0.75em;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            white-space: nowrap;
            pointer-events: none;
        }

        /* guess needle */
        #guess-needle {
            position: absolute;
            top: -34px;
            width: 3px;
            background: var(--accent);
            height: 74px;
            transform: translateX(-50%);
            pointer-events: none;
            display: none;
            border-radius: 2px;
        }
        #guess-label {
            position: absolute;
            top: -52px;
            transform: translateX(-50%);
            font-size: 0.78em;
            font-weight: 800;
            color: var(--accent);
            white-space: nowrap;
            background: var(--card);
            border: 1px solid var(--accent);
            border-radius: 6px;
            padding: 2px 6px;
        }

        /* answer needle */
        #answer-needle {
            position: absolute;
            top: -34px;
            width: 3px;
            background: var(--good);
            height: 74px;
            transform: translateX(-50%);
            pointer-events: none;
            display: none;
            border-radius: 2px;
        }
        #answer-label {
            position: absolute;
            bottom: -52px;
            transform: translateX(-50%);
            font-size: 0.78em;
            font-weight: 800;
            color: var(--good);
            white-space: nowrap;
            background: var(--card);
            border: 1px solid var(--good);
            border-radius: 6px;
            padding: 2px 6px;
        }

        /* distance arc between needles */
        #distance-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            display: none;
        }

        /* ── Result panel ────────────────────────────────── */
        #result-panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 16px;
            display: none;
            text-align: center;
        }
        #result-emoji { font-size: 2.4em; margin-bottom: 6px; }
        #result-verdict {
            font-size: 1.1em;
            font-weight: 800;
            margin-bottom: 6px;
        }
        #result-detail {
            font-size: 0.88em;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 12px;
        }
        #result-points {
            font-size: 1.4em;
            font-weight: 900;
        }
        #result-fact {
            margin-top: 12px;
            font-size: 0.82em;
            color: var(--muted);
            font-style: italic;
            border-top: 1px solid var(--border);
            padding-top: 10px;
            line-height: 1.5;
        }

        /* ── Buttons ─────────────────────────────────────── */
        button {
            font-family: inherit;
            font-weight: 700;
            cursor: pointer;
            border: none;
            border-radius: 10px;
            transition: opacity 0.15s, transform 0.1s;
        }
        button:active { transform: scale(0.97); }

        #btn-guess {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: #111;
            font-size: 1em;
            display: none;
        }
        #btn-next {
            width: 100%;
            padding: 14px;
            background: var(--accent2);
            color: #fff;
            font-size: 1em;
            display: none;
        }
        button:disabled { opacity: 0.4; cursor: default; }

        /* ── End screen ──────────────────────────────────── */
        #end-screen {
            display: none;
            text-align: center;
            padding: 32px 16px;
        }
        #end-screen h2 {
            font-size: 2em;
            font-weight: 900;
            margin-bottom: 8px;
        }
        #end-score {
            font-size: 3.5em;
            font-weight: 900;
            color: var(--accent);
            line-height: 1;
            margin: 12px 0;
        }
        #end-grade {
            font-size: 1.1em;
            color: var(--muted);
            margin-bottom: 20px;
        }
        #end-history {
            text-align: left;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            font-size: 0.84em;
        }
        #end-history h3 {
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--muted);
            margin-bottom: 12px;
        }
        .history-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid var(--border);
            gap: 8px;
        }
        .history-row:last-child { border-bottom: none; }
        .history-event { flex: 1; color: var(--text); }
        .history-guess { color: var(--muted); min-width: 60px; text-align: right; }
        .history-actual { color: var(--good); min-width: 60px; text-align: right; font-weight: 700; }
        .history-pts { min-width: 50px; text-align: right; font-weight: 800; }
        #btn-restart {
            width: 100%;
            padding: 14px;
            background: var(--accent);
            color: #111;
            font-size: 1em;
        }

        /* ── Attribution ─────────────────────────────────── */
        .attribution {
            text-align: center;
            font-size: 0.72em;
            color: var(--muted);
            padding: 12px 0 24px;
            line-height: 1.6;
        }
        .attribution a { color: var(--accent2); text-decoration: none; }

        /* ── Shake animation ─────────────────────────────── */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-6px); }
            40% { transform: translateX(6px); }
            60% { transform: translateX(-4px); }
            80% { transform: translateX(4px); }
        }
        .shake { animation: shake 0.4s ease; }

        @keyframes pop-in {
            0% { transform: scale(0.85); opacity: 0; }
            60% { transform: scale(1.04); }
            100% { transform: scale(1); opacity: 1; }
        }
        .pop-in { animation: pop-in 0.3s ease forwards; }
    </style>
</head>
<body>
<div id="app">
    <header>
        <h1>🗓️ History Date Guesser</h1>
        <p>Drag the timeline to guess when each event happened.<br>Closer = more points!</p>
    </header>

    <div id="scorebar">
        <div class="stat"><div class="label">Score</div><div class="val" id="total-score">0</div></div>
        <div class="stat"><div class="label">Question</div><div class="val" id="q-count">1/10</div></div>
        <div class="stat"><div class="label">Best</div><div class="val" id="best-pts">—</div></div>
    </div>

    <div id="event-card">
        <div id="progress-bar-outer"><div id="progress-bar-inner" style="width:0%"></div></div>
        <div id="event-category">loading…</div>
        <div id="event-name"></div>
        <div id="event-hint"></div>
        <div id="question-num"></div>
    </div>

    <div id="timeline-section">
        <div id="timeline-instruction">👆 Tap the timeline to place your guess</div>
        <div id="timeline-wrap">
            <div id="distance-svg-container" style="position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;overflow:visible">
                <svg id="distance-svg" xmlns="http://www.w3.org/2000/svg" style="position:absolute;top:0;left:0;width:100%;height:100%;overflow:visible;display:none;">
                    <path id="arc-path" fill="none" stroke-width="2" stroke-dasharray="4,3"/>
                </svg>
            </div>
            <div id="timeline-line">
                <!-- ticks and labels injected by JS -->
                <div id="preview-needle"><div id="preview-year"></div></div>
                <div id="guess-needle"><div id="guess-label"></div></div>
                <div id="answer-needle"><div id="answer-label"></div></div>
            </div>
        </div>
    </div>

    <button id="btn-guess" onclick="submitGuess()">Lock In My Guess ➤</button>
    <button id="btn-next" onclick="nextQuestion()">Next Event ➤</button>

    <div id="result-panel">
        <div id="result-emoji"></div>
        <div id="result-verdict"></div>
        <div id="result-detail"></div>
        <div id="result-points"></div>
        <div id="result-fact"></div>
    </div>

    <div id="end-screen">
        <h2>Round Complete!</h2>
        <div id="end-score">0</div>
        <div id="end-grade"></div>
        <div id="end-history"><h3>Your Timeline</h3><div id="history-rows"></div></div>
        <button id="btn-restart" onclick="startGame()">Play Again 🔄</button>
    </div>

    <div class="attribution">
        Inspired by Jon's post <a href="https://cooltoolsforcatholics.blogspot.com/2011/06/world-history-on-index-card.html" target="_blank">"World History on an Index Card"</a>,
        drawing from Richard Overy's <em>50 Key Dates of World History</em> and Diane Moczar's
        <em>Ten Dates Every Catholic Should Know</em>.<br>
        <a href="index.php">← Back to Chloe Reads Jon</a>
    </div>
</div>

<script>
// ── All historical events ──────────────────────────────────────────────────
const ALL_EVENTS = [
    { year: -3000, name: "First Egyptian Dynasty", category: "Ancient Civilisations",
      hint: "Narmer unites Upper and Lower Egypt, beginning the pharaonic age.", fact: "Egypt's Old Kingdom would go on to build the Great Pyramid — still standing 4,500 years later." },
    { year: -2560, name: "Great Pyramid of Giza Built", category: "Ancient Wonders",
      hint: "The largest of the three Giza pyramids, a tomb for Pharaoh Khufu.", fact: "The Great Pyramid was the tallest man-made structure on Earth for over 3,800 years." },
    { year: -776, name: "First Olympic Games", category: "Ancient Greece",
      hint: "Athletes gathered at Olympia to compete in honour of Zeus.", fact: "The ancient games were held every four years for over 1,000 years until abolished by a Roman emperor." },
    { year: -753, name: "Founding of Rome", category: "Ancient Rome",
      hint: "Legendary foundation by Romulus after he and his twin brother Remus were raised by a she-wolf.", fact: "This date was calculated by the Roman scholar Varro and became the basis for 'ab urbe condita' dating." },
    { year: -490, name: "Battle of Marathon", category: "Ancient Greece",
      hint: "A small Athenian army repels the Persian invasion, giving rise to a legendary run.", fact: "The word 'marathon' for a 26.2-mile race comes from the story of Pheidippides running to Athens." },
    { year: -399, name: "Death of Socrates", category: "Philosophy",
      hint: "Athens condemned its greatest philosopher for impiety and corrupting the youth.", fact: "Socrates wrote nothing himself — we know him entirely through his student Plato's dialogues." },
    { year: -323, name: "Death of Alexander the Great", category: "Ancient Empires",
      hint: "The conqueror of Persia, Egypt, and India died in Babylon, aged just 32.", fact: "His empire was the largest in ancient history, stretching from Greece to modern Pakistan." },
    { year: -44, name: "Assassination of Julius Caesar", category: "Ancient Rome",
      hint: "Senators stabbed him 23 times on the Ides of March in the Theatre of Pompey.", fact: "Only one of the 23 wounds was actually fatal, according to the autopsy recorded by Suetonius." },
    { year: 33, name: "Crucifixion & Resurrection of Christ", category: "Ten Catholic Dates",
      hint: "The central event of Christian faith: the death and rising of Jesus of Nazareth.", fact: "The dating to A.D. 33 is one of several scholarly estimates; A.D. 30 is also commonly proposed." },
    { year: 70, name: "Destruction of Jerusalem Temple", category: "Ten Catholic Dates",
      hint: "Roman general Titus destroyed the Second Temple, fulfilling Christ's prophecy.", fact: "The Western Wall — all that remains — is still Judaism's holiest site and pilgrimage destination." },
    { year: 313, name: "Edict of Milan", category: "Ten Catholic Dates",
      hint: "Constantine and Licinius grant religious tolerance throughout the Roman Empire.", fact: "This ended centuries of persecution of Christians, though the Edict did not make Christianity the state religion." },
    { year: 380, name: "Edict of Thessalonica", category: "Ten Catholic Dates",
      hint: "Emperor Theodosius declares Nicene Christianity the official religion of Rome.", fact: "This is why historian Hilaire Belloc could write 'the Faith is Europe and Europe is the Faith.'" },
    { year: 410, name: "Sack of Rome by the Visigoths", category: "Fall of Rome",
      hint: "For the first time in 800 years, a foreign enemy breached the walls of the Eternal City.", fact: "The shock of Rome's fall prompted St. Augustine to write 'The City of God' as a theological response." },
    { year: 476, name: "Fall of the Western Roman Empire", category: "Ten Catholic Dates",
      hint: "The last Roman emperor, Romulus Augustulus, is deposed by Odoacer.", fact: "Historians debate whether this 'fall' was a sudden collapse or a gradual transformation into medieval Europe." },
    { year: 732, name: "Battle of Tours (Poitiers)", category: "Ten Catholic Dates",
      hint: "Charles Martel halts the Muslim advance into Western Europe near Poitiers, France.", fact: "Edward Gibbon wrote that had the battle gone the other way, the Koran might be taught at Oxford." },
    { year: 800, name: "Charlemagne Crowned Holy Roman Emperor", category: "Ten Catholic Dates",
      hint: "Pope Leo III crowns the Frankish king on Christmas Day in St. Peter's Basilica.", fact: "Charlemagne is often called the 'Father of Europe' for unifying much of Western Christendom." },
    { year: 1054, name: "Great Schism", category: "Church History",
      hint: "The Pope and the Patriarch of Constantinople mutually excommunicate each other, splitting East and West.", fact: "The formal excommunications weren't lifted until 1964, when Pope Paul VI and Patriarch Athenagoras met in Jerusalem." },
    { year: 1066, name: "Norman Conquest of England", category: "Medieval History",
      hint: "William the Conqueror defeats King Harold at the Battle of Hastings.", fact: "The Domesday Book, commissioned by William in 1086, is one of history's earliest demographic surveys." },
    { year: 1095, name: "Pope Urban II Calls the First Crusade", category: "Church History",
      hint: "At the Council of Clermont, the Pope calls for an armed pilgrimage to reclaim Jerusalem.", fact: "The crowd's response — 'Deus vult!' (God wills it!) — became the crusaders' battle cry." },
    { year: 1215, name: "Magna Carta Signed", category: "Medieval History",
      hint: "English barons force King John to accept limits on royal power at Runnymede.", fact: "Most of Magna Carta's 63 clauses dealt with feudal rights, but its principles shaped constitutional law." },
    { year: 1347, name: "Black Death Reaches Europe", category: "Medieval History",
      hint: "Bubonic plague arrives in Sicily and spreads with terrifying speed across the continent.", fact: "The Black Death killed an estimated 30–60% of Europe's population in just a few years." },
    { year: 1453, name: "Fall of Constantinople", category: "Ten Catholic Dates",
      hint: "Ottoman Sultan Mehmed II captures the great Christian city, ending the Byzantine Empire.", fact: "The last Byzantine emperor, Constantine XI, died fighting on the walls — his body was never identified." },
    { year: 1492, name: "Columbus Reaches the Americas", category: "Age of Exploration",
      hint: "Sailing under the Spanish crown, he landed in the Bahamas on 12 October.", fact: "Columbus died in 1506 still convinced he had reached Asia, never knowing he'd found a 'New World'." },
    { year: 1517, name: "Luther Posts the 95 Theses", category: "Reformation",
      hint: "A German friar nails a list of protests against indulgences to the Wittenberg church door.", fact: "The invention of the printing press 60 years earlier meant Luther's ideas spread across Europe within weeks." },
    { year: 1543, name: "Copernicus Publishes Heliocentric Model", category: "Science",
      hint: "De revolutionibus orbium coelestium argues the Earth orbits the Sun, not vice versa.", fact: "Legend says Copernicus received the first printed copy on the very day he died." },
    { year: 1588, name: "Defeat of the Spanish Armada", category: "Early Modern History",
      hint: "England repels Spain's great naval invasion fleet, partly due to storms.", fact: "Philip II of Spain reportedly received the news calmly, saying 'I sent my ships to fight men, not God's winds.'" },
    { year: 1687, name: "Newton Publishes Principia Mathematica", category: "Science",
      hint: "Isaac Newton lays down the laws of motion and universal gravitation.", fact: "Edmund Halley paid for the printing out of his own pocket after the Royal Society ran out of funds." },
    { year: 1776, name: "American Declaration of Independence", category: "Modern History",
      hint: "The thirteen colonies declare independence from Britain on 4 July.", fact: "John Adams and Thomas Jefferson — both signers — died on the same day: 4 July 1826, the 50th anniversary." },
    { year: 1789, name: "French Revolution Begins", category: "Modern History",
      hint: "The storming of the Bastille marks the violent overthrow of the Ancien Régime.", fact: "The Bastille held only seven prisoners when it was stormed — but its symbolic power was enormous." },
    { year: 1815, name: "Battle of Waterloo", category: "Modern History",
      hint: "Napoleon's final defeat, at the hands of Wellington and Blücher in present-day Belgium.", fact: "'It was the nearest run thing you ever saw in your life,' Wellington famously said afterward." },
    { year: 1859, name: "Darwin Publishes On the Origin of Species", category: "Science",
      hint: "Natural selection is proposed as the mechanism driving biological evolution.", fact: "The first edition of 1,250 copies sold out on the day of publication." },
    { year: 1865, name: "American Civil War Ends", category: "Modern History",
      hint: "Lee surrenders to Grant at Appomattox Court House on 9 April; Lincoln is shot 5 days later.", fact: "The war killed an estimated 620,000–750,000 soldiers — more Americans than any other conflict." },
    { year: 1914, name: "World War I Begins", category: "Modern History",
      hint: "Archduke Franz Ferdinand is assassinated in Sarajevo, setting off a chain reaction.", fact: "The war was expected to be over by Christmas 1914 — it lasted four devastating years." },
    { year: 1917, name: "Russian Revolution", category: "Modern History",
      hint: "The Bolsheviks seize power in Petrograd, overthrowing the Provisional Government.", fact: "The same year, Our Lady of Fatima warned of Russia spreading errors throughout the world." },
    { year: 1945, name: "World War II Ends", category: "Modern History",
      hint: "V-E Day (8 May) and V-J Day (15 August) mark Allied victory in Europe and the Pacific.", fact: "The war caused an estimated 70–85 million deaths, making it the deadliest conflict in human history." },
    { year: 1969, name: "Moon Landing", category: "Modern History",
      hint: "Apollo 11 touches down on the Sea of Tranquility; Neil Armstrong takes 'one giant leap'.", fact: "About 650 million people — one fifth of the world's population — watched it live on television." },
];

// ── Configuration ──────────────────────────────────────────────────────────
const TIMELINE_MIN = -3200;
const TIMELINE_MAX = 2026;
const NUM_QUESTIONS = 10;

// ── State ──────────────────────────────────────────────────────────────────
let questions = [];
let currentQ = 0;
let totalScore = 0;
let bestPts = null;
let guessYear = null;
let hasGuessed = false;
let roundHistory = [];

// ── Utility ────────────────────────────────────────────────────────────────
function shuffle(arr) {
    const a = [...arr];
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function yearLabel(y) {
    if (y < 0) return `${Math.abs(y)} BC`;
    if (y === 0) return '1 AD';
    return `${y} AD`;
}

function pct(year) {
    return ((year - TIMELINE_MIN) / (TIMELINE_MAX - TIMELINE_MIN)) * 100;
}

function yearFromPct(p) {
    return Math.round(TIMELINE_MIN + p * (TIMELINE_MAX - TIMELINE_MIN));
}

function scoreForError(errorYears) {
    if (errorYears <= 5)   return 1000;
    if (errorYears <= 25)  return 900;
    if (errorYears <= 75)  return 750;
    if (errorYears <= 150) return 550;
    if (errorYears <= 300) return 350;
    if (errorYears <= 600) return 200;
    if (errorYears <= 1000) return 100;
    return 0;
}

function verdict(pts) {
    if (pts === 1000) return { emoji: '🎯', text: 'Perfect!', color: '#5edc8c' };
    if (pts >= 900)  return { emoji: '🔥', text: 'Scorching!', color: '#5edc8c' };
    if (pts >= 750)  return { emoji: '⚡', text: 'Close!', color: '#7c6af7' };
    if (pts >= 550)  return { emoji: '👍', text: 'Good Guess', color: '#e8c547' };
    if (pts >= 350)  return { emoji: '🤔', text: 'Not Bad…', color: '#f0a830' };
    if (pts >= 100)  return { emoji: '😬', text: 'Way Off', color: '#e85c5c' };
    return             { emoji: '💀', text: 'Yikes!', color: '#e85c5c' };
}

function finalGrade(score, max) {
    const pct = score / max;
    if (pct >= 0.92) return "Historian extraordinaire 🏆";
    if (pct >= 0.80) return "Solid scholar 📚";
    if (pct >= 0.65) return "History buff in training 🎓";
    if (pct >= 0.45) return "Barely passed world history class 😅";
    return "Did you skip that class entirely? 😂";
}

// ── DOM refs ───────────────────────────────────────────────────────────────
const el = id => document.getElementById(id);
const timelineWrap = el('timeline-wrap');
const timelineLine = el('timeline-line');
const previewNeedle = el('preview-needle');
const previewYear = el('preview-year');
const guessNeedle = el('guess-needle');
const guessLabel = el('guess-label');
const answerNeedle = el('answer-needle');
const answerLabel = el('answer-label');
const distSvg = el('distance-svg');
const arcPath = el('arc-path');
const btnGuess = el('btn-guess');
const btnNext = el('btn-next');

// ── Timeline setup ─────────────────────────────────────────────────────────
function buildTimeline() {
    // Remove old ticks/labels
    timelineLine.querySelectorAll('.tick,.era-label').forEach(e => e.remove());

    const eras = [
        { year: -3000, label: '3000 BC' },
        { year: -2000, label: '2000 BC' },
        { year: -1000, label: '1000 BC' },
        { year: 0,     label: '0 AD' },
        { year: 500,   label: '500' },
        { year: 1000,  label: '1000' },
        { year: 1500,  label: '1500' },
        { year: 2000,  label: '2000' },
    ];

    eras.forEach(({ year, label }) => {
        const p = pct(year);
        const tick = document.createElement('div');
        tick.className = 'tick';
        tick.style.left = p + '%';
        timelineLine.appendChild(tick);

        const lbl = document.createElement('div');
        lbl.className = 'era-label';
        lbl.style.left = p + '%';
        lbl.textContent = label;
        timelineLine.appendChild(lbl);
    });
}

// ── Coordinate helpers ─────────────────────────────────────────────────────
function lineRect() { return timelineLine.getBoundingClientRect(); }
function wrapRect() { return timelineWrap.getBoundingClientRect(); }

function clientXtoPct(clientX) {
    const r = lineRect();
    const raw = (clientX - r.left) / r.width;
    return Math.max(0, Math.min(1, raw));
}

function pctToWrapLeft(p) {
    // Convert timeline-line pct to timeline-wrap left px
    const wr = wrapRect();
    const lr = lineRect();
    const lineLeftInWrap = lr.left - wr.left;
    return lineLeftInWrap + p * lr.width;
}

// ── Needle placement ───────────────────────────────────────────────────────
function placeNeedle(needle, labelEl, p, text, show = true) {
    const leftPx = pctToWrapLeft(p);
    needle.style.left = leftPx + 'px';
    needle.style.display = show ? 'block' : 'none';
    if (labelEl) labelEl.textContent = text;
}

// ── Interaction ────────────────────────────────────────────────────────────
function handleMove(clientX) {
    if (hasGuessed) return;
    const p = clientXtoPct(clientX);
    const yr = yearFromPct(p);
    placeNeedle(previewNeedle, previewYear, p, yearLabel(yr), true);
    previewNeedle.style.display = 'block';
    guessYear = yr;
    el('btn-guess').style.display = 'block';
    el('btn-guess').disabled = false;
}

function handleTap(clientX) {
    if (hasGuessed) return;
    handleMove(clientX);
    // Snap guess needle
    const p = clientXtoPct(clientX);
    const yr = yearFromPct(p);
    placeNeedle(guessNeedle, guessLabel, p, '📍 ' + yearLabel(yr), true);
}

// Mouse
timelineWrap.addEventListener('mousemove', e => handleMove(e.clientX));
timelineWrap.addEventListener('click', e => handleTap(e.clientX));
timelineWrap.addEventListener('mouseleave', () => {
    if (!hasGuessed) previewNeedle.style.display = 'none';
});

// Touch
timelineWrap.addEventListener('touchmove', e => {
    e.preventDefault();
    handleMove(e.touches[0].clientX);
}, { passive: false });
timelineWrap.addEventListener('touchend', e => {
    e.preventDefault();
    handleTap(e.changedTouches[0].clientX);
}, { passive: false });

// ── Game logic ─────────────────────────────────────────────────────────────
function startGame() {
    questions = shuffle(ALL_EVENTS).slice(0, NUM_QUESTIONS);
    currentQ = 0;
    totalScore = 0;
    bestPts = null;
    roundHistory = [];
    guessYear = null;
    hasGuessed = false;

    el('total-score').textContent = '0';
    el('best-pts').textContent = '—';
    el('end-screen').style.display = 'none';

    // Show game UI
    el('event-card').style.display = 'flex';
    el('timeline-section').style.display = 'block';

    showQuestion();
}

function showQuestion() {
    const q = questions[currentQ];
    hasGuessed = false;
    guessYear = null;

    el('event-category').textContent = q.category;
    el('event-name').textContent = q.name;
    el('event-hint').textContent = q.hint;
    el('q-count').textContent = `${currentQ + 1}/${NUM_QUESTIONS}`;
    el('question-num').textContent = '';
    el('progress-bar-inner').style.width = ((currentQ / NUM_QUESTIONS) * 100) + '%';

    // Reset needles
    guessNeedle.style.display = 'none';
    answerNeedle.style.display = 'none';
    previewNeedle.style.display = 'none';
    distSvg.style.display = 'none';

    // Reset buttons & result
    btnGuess.style.display = 'none';
    btnGuess.disabled = true;
    btnNext.style.display = 'none';
    el('result-panel').style.display = 'none';

    el('timeline-instruction').textContent = '👆 Tap the timeline to place your guess';
}

function submitGuess() {
    if (guessYear === null || hasGuessed) return;
    hasGuessed = true;

    const q = questions[currentQ];
    const error = Math.abs(guessYear - q.year);
    const pts = scoreForError(error);

    totalScore += pts;
    if (bestPts === null || pts > bestPts) bestPts = pts;

    roundHistory.push({ name: q.name, guess: guessYear, actual: q.year, pts });

    el('total-score').textContent = totalScore.toLocaleString();
    el('best-pts').textContent = bestPts.toLocaleString();

    // Show answer needle
    const ap = pct(q.year);
    const gp = pct(guessYear);
    placeNeedle(answerNeedle, answerLabel, ap, '✅ ' + yearLabel(q.year), true);
    answerNeedle.querySelector('#answer-label').style.color = 'var(--good)';

    // Draw arc between guess and answer
    drawArc(gp, ap, pts);

    // Result panel
    const v = verdict(pts);
    el('result-emoji').textContent = v.emoji;
    el('result-verdict').textContent = v.text;
    el('result-verdict').style.color = v.color;
    el('result-detail').textContent =
        `You guessed ${yearLabel(guessYear)}. Correct answer: ${yearLabel(q.year)}. Off by ${error.toLocaleString()} year${error === 1 ? '' : 's'}.`;
    el('result-points').textContent = `+${pts.toLocaleString()} pts`;
    el('result-points').style.color = v.color;
    el('result-fact').textContent = '💡 ' + q.fact;

    const rp = el('result-panel');
    rp.style.display = 'block';
    rp.classList.remove('pop-in');
    void rp.offsetWidth;
    rp.classList.add('pop-in');

    btnGuess.style.display = 'none';
    btnNext.style.display = 'block';
    btnNext.textContent = currentQ < NUM_QUESTIONS - 1 ? 'Next Event ➤' : 'See Results 🏆';

    el('timeline-instruction').textContent = '🟡 Your guess  🟢 Correct answer';
}

function drawArc(gp, ap, pts) {
    const wr = wrapRect();
    const lr = lineRect();
    const lineTopInWrap = lr.top - wr.top;
    const lineH = 6; // height of timeline bar
    const midY = lineTopInWrap + lineH / 2;

    const x1 = (lr.left - wr.left) + gp * lr.width;
    const x2 = (lr.left - wr.left) + ap * lr.width;

    if (Math.abs(x2 - x1) < 4) {
        distSvg.style.display = 'none';
        return;
    }

    const cx = (x1 + x2) / 2;
    const rise = Math.min(50, Math.abs(x2 - x1) * 0.35);
    const cy = midY - rise;

    arcPath.setAttribute('d', `M ${x1} ${midY} Q ${cx} ${cy} ${x2} ${midY}`);

    let color;
    if (pts >= 750) color = '#5edc8c';
    else if (pts >= 350) color = '#e8c547';
    else color = '#e85c5c';

    arcPath.setAttribute('stroke', color);
    distSvg.style.display = 'block';
}

function nextQuestion() {
    currentQ++;
    if (currentQ >= NUM_QUESTIONS) {
        showEndScreen();
    } else {
        showQuestion();
    }
}

function showEndScreen() {
    el('event-card').style.display = 'none';
    el('timeline-section').style.display = 'none';
    el('result-panel').style.display = 'none';
    btnGuess.style.display = 'none';
    btnNext.style.display = 'none';

    const maxPossible = NUM_QUESTIONS * 1000;
    el('end-score').textContent = totalScore.toLocaleString();
    el('end-grade').textContent = finalGrade(totalScore, maxPossible);
    el('progress-bar-inner').style.width = '100%';

    const rows = el('history-rows');
    rows.innerHTML = '';
    roundHistory.forEach(r => {
        const v = verdict(r.pts);
        const row = document.createElement('div');
        row.className = 'history-row';
        row.innerHTML = `
            <span class="history-event">${r.name}</span>
            <span class="history-guess">${yearLabel(r.guess)}</span>
            <span class="history-actual">${yearLabel(r.actual)}</span>
            <span class="history-pts" style="color:${v.color}">+${r.pts}</span>
        `;
        rows.appendChild(row);
    });

    el('end-screen').style.display = 'block';
}

// ── Init ───────────────────────────────────────────────────────────────────
buildTimeline();
startGame();
</script>
</body>
</html>
