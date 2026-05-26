<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dewey Shelf Sprint</title>
    <style>
        :root {
            --paper: #f7f1e3;
            --ink: #1e1c1a;
            --wood: #7a4a2f;
            --wood-dark: #4b2d1d;
            --accent: #0f766e;
            --gold: #c18f2d;
            --ok: #2e7d32;
            --bad: #b42318;
            --card: #fffaf0;
            --shadow: 0 12px 28px rgba(30, 28, 26, 0.2);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 10% 20%, #fff8dc 0%, transparent 35%),
                radial-gradient(circle at 85% 12%, #f0e4c3 0%, transparent 32%),
                linear-gradient(160deg, #f8f3e7 0%, #efe4cc 100%);
            padding: 1rem;
        }

        .app {
            max-width: 980px;
            margin: 0 auto;
            border: 3px solid var(--wood-dark);
            border-radius: 20px;
            background: linear-gradient(180deg, #fffef9, #f7efdc 70%);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .banner {
            padding: 1.1rem 1.2rem;
            background:
                repeating-linear-gradient(
                    45deg,
                    #7a4a2f,
                    #7a4a2f 10px,
                    #6a3f27 10px,
                    #6a3f27 20px
                );
            color: #fffaf2;
            border-bottom: 4px solid #3f2416;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.5rem, 5vw, 2.5rem);
            letter-spacing: 0.03em;
            text-transform: uppercase;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
        }

        .sub {
            margin-top: 0.35rem;
            opacity: 0.95;
            line-height: 1.35;
        }

        .panel {
            padding: 1rem;
            display: grid;
            gap: 1rem;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.6rem;
        }

        .stat {
            background: var(--card);
            border: 2px solid #d7c5a3;
            border-radius: 12px;
            padding: 0.55rem;
            text-align: center;
            box-shadow: 0 3px 0 #d1b588;
        }

        .k {
            display: block;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #635445;
        }

        .v {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c1d14;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
        }

        .book-card {
            background: linear-gradient(160deg, #fffcf3 0%, #fff4d8 100%);
            border: 2px solid #deccac;
            border-radius: 14px;
            padding: 1rem;
            box-shadow: 0 6px 0 #d3bb92;
            position: relative;
            transform-origin: center;
            animation: popIn 280ms ease;
        }

        .book-card::before {
            content: "";
            position: absolute;
            inset: 8px;
            border: 1px dashed #ccb690;
            border-radius: 10px;
            pointer-events: none;
        }

        .prompt {
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6a5a45;
            margin-bottom: 0.4rem;
        }

        .book-title {
            font-size: clamp(1.15rem, 4vw, 1.55rem);
            margin: 0;
            line-height: 1.25;
            padding-right: 5.4rem;
        }

        .dewey {
            position: absolute;
            right: 1rem;
            top: 1rem;
            background: #39271d;
            color: #f6ebd8;
            border-radius: 9px;
            padding: 0.4rem 0.6rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            font-family: "Courier New", Courier, monospace;
        }

        .shelves {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.8rem;
        }

        .shelf {
            background: linear-gradient(180deg, #8f5a3b, #6c412a);
            color: #fff8ea;
            border: 2px solid #4a2d1d;
            border-radius: 13px;
            min-height: 90px;
            padding: 0.75rem;
            text-align: left;
            box-shadow: 0 6px 0 #4a2d1d;
            cursor: pointer;
            transition: transform 140ms ease, filter 140ms ease;
        }

        .shelf strong {
            display: block;
            font-size: 1.1rem;
            letter-spacing: 0.02em;
            margin-bottom: 0.3rem;
        }

        .shelf span { opacity: 0.94; }

        .shelf:hover,
        .shelf:focus-visible {
            transform: translateY(-3px);
            filter: brightness(1.05);
            outline: none;
        }

        .controls {
            display: flex;
            flex-wrap: wrap;
            gap: 0.55rem;
        }

        button {
            border: 0;
            border-radius: 999px;
            padding: 0.62rem 1rem;
            cursor: pointer;
            font: inherit;
            font-family: "Trebuchet MS", "Gill Sans", sans-serif;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .new-round { background: #2f9e44; color: #fff; }
        .hint { background: #14532d; color: #d9ffe3; }
        .skip { background: #f59e0b; color: #2f1a00; }

        .message {
            min-height: 2.1em;
            padding: 0.5rem 0.7rem;
            border-radius: 10px;
            background: #fffdf8;
            border: 1px solid #e2d2b4;
            font-weight: 700;
        }

        .message.ok { color: var(--ok); }
        .message.bad { color: var(--bad); }

        .legend {
            background: #fff9ec;
            border-top: 2px solid #e8d5b5;
            padding: 0.85rem 1rem 1rem;
            font-size: 0.97rem;
        }

        .legend-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.35rem 0.8rem;
            margin-top: 0.4rem;
        }

        .burst {
            position: fixed;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            pointer-events: none;
            animation: burst 800ms ease-out forwards;
        }

        @keyframes burst {
            from { opacity: 1; transform: translateY(0) scale(1); }
            to { opacity: 0; transform: translateY(-62px) scale(0.25); }
        }

        @keyframes popIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @media (max-width: 700px) {
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .shelves { grid-template-columns: 1fr; }
            .book-title { padding-right: 0; margin-top: 2.2rem; }
            .dewey { top: 0.8rem; }
            .legend-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="app">
    <div class="banner">
        <h1>Dewey Shelf Sprint</h1>
        <div class="sub">Shelve each mystery title into the right Dewey aisle before your streak slips. Tiny librarian reflexes encouraged.</div>
    </div>

    <div class="panel">
        <div class="stats" aria-live="polite">
            <div class="stat"><span class="k">Score</span><span class="v" id="score">0</span></div>
            <div class="stat"><span class="k">Best Streak</span><span class="v" id="best">0</span></div>
            <div class="stat"><span class="k">Current Streak</span><span class="v" id="streak">0</span></div>
            <div class="stat"><span class="k">Round</span><span class="v" id="round">1</span></div>
        </div>

        <article class="book-card" id="bookCard" aria-live="polite">
            <div class="prompt">Where does this book belong?</div>
            <div class="dewey" id="dewey">---</div>
            <h2 class="book-title" id="bookTitle">Loading title...</h2>
        </article>

        <section class="shelves" id="shelves" aria-label="Dewey shelves"></section>

        <div class="controls">
            <button class="new-round" id="newRound" type="button">New Deck</button>
            <button class="hint" id="hintBtn" type="button">Hint</button>
            <button class="skip" id="skipBtn" type="button">Skip Title</button>
        </div>

        <div class="message" id="message">Tap a shelf to classify the current title.</div>
    </div>

    <section class="legend">
        <strong>Dewey Quick Map</strong>
        <div class="legend-grid">
            <div><b>000</b> General Works, computers</div>
            <div><b>100</b> Philosophy and psychology</div>
            <div><b>200</b> Religion</div>
            <div><b>300</b> Social sciences</div>
            <div><b>400</b> Languages</div>
            <div><b>500</b> Science and math</div>
            <div><b>600</b> Technology and practical life</div>
            <div><b>700</b> Arts and recreation</div>
            <div><b>800</b> Literature</div>
            <div><b>900</b> History and geography</div>
        </div>
    </section>
</div>

<script>
(() => {
    const shelves = [
        { id: "000", name: "General Works", desc: "Computers, encyclopedias, media", min: 0, max: 99 },
        { id: "100", name: "Philosophy & Psychology", desc: "Mind, logic, ethics", min: 100, max: 199 },
        { id: "200", name: "Religion", desc: "Theology, Bible, spirituality", min: 200, max: 299 },
        { id: "300", name: "Social Sciences", desc: "Education, law, economics", min: 300, max: 399 },
        { id: "400", name: "Language", desc: "Linguistics, dictionaries", min: 400, max: 499 },
        { id: "500", name: "Science", desc: "Math, astronomy, nature", min: 500, max: 599 },
        { id: "600", name: "Technology", desc: "Medicine, engineering, productivity", min: 600, max: 699 },
        { id: "700", name: "Arts & Recreation", desc: "Drawing, music, games", min: 700, max: 799 },
        { id: "800", name: "Literature", desc: "Poetry, novels, plays", min: 800, max: 899 },
        { id: "900", name: "History & Geography", desc: "Biographies, travel, timelines", min: 900, max: 999 }
    ];

    const titles = [
        { t: "An Illustrated Atlas of Ancient Rome", n: 937 },
        { t: "Machine Learning for Curious Minds", n: 006 },
        { t: "Daily Micro-Habits for Better Focus", n: 158 },
        { t: "Beginner's Guide to Catholic Symbols", n: 246 },
        { t: "How Neighborhoods Grow", n: 307 },
        { t: "Everyday Latin Phrases", n: 478 },
        { t: "Fractals and Prime Mysteries", n: 512 },
        { t: "Practical Wheelchair Maintenance", n: 629 },
        { t: "Sketchbook of Retro Car Designs", n: 743 },
        { t: "The Long Road to Narnia", n: 823 },
        { t: "Canada Through Old Maps", n: 971 },
        { t: "Family Budgeting in Tight Times", n: 650 },
        { t: "Why We Dream", n: 154 },
        { t: "Mario's Music Theory Notebook", n: 781 },
        { t: "Saints and Desert Wisdom", n: 271 },
        { t: "A Pocket Guide to French Grammar", n: 445 },
        { t: "Volcanoes and Deep Earth", n: 551 },
        { t: "The Duke and the Detective", n: 813 },
        { t: "Public Speaking for Introverts", n: 302 },
        { t: "Timeline of Medieval Castles", n: 940 }
    ];

    const ui = {
        shelvesWrap: document.getElementById("shelves"),
        bookTitle: document.getElementById("bookTitle"),
        dewey: document.getElementById("dewey"),
        score: document.getElementById("score"),
        best: document.getElementById("best"),
        streak: document.getElementById("streak"),
        round: document.getElementById("round"),
        message: document.getElementById("message"),
        newRound: document.getElementById("newRound"),
        hintBtn: document.getElementById("hintBtn"),
        skipBtn: document.getElementById("skipBtn")
    };

    let deck = [];
    let current = null;
    let state = { score: 0, streak: 0, best: 0, round: 1 };

    function shuffle(arr) {
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[i], arr[j]] = [arr[j], arr[i]];
        }
        return arr;
    }

    function buildShelves() {
        ui.shelvesWrap.innerHTML = "";
        shelves.forEach((shelf) => {
            const btn = document.createElement("button");
            btn.className = "shelf";
            btn.type = "button";
            btn.innerHTML = `<strong>${shelf.id} - ${shelf.name}</strong><span>${shelf.desc}</span>`;
            btn.addEventListener("click", () => judge(shelf));
            ui.shelvesWrap.appendChild(btn);
        });
    }

    function setMessage(text, type = "") {
        ui.message.textContent = text;
        ui.message.className = "message" + (type ? ` ${type}` : "");
    }

    function refill() {
        deck = shuffle([...titles]);
        state.round += 1;
        ui.round.textContent = state.round;
        drawCard();
    }

    function drawCard() {
        if (deck.length === 0) {
            refill();
            return;
        }
        current = deck.pop();
        ui.bookTitle.textContent = current.t;
        ui.dewey.textContent = String(current.n).padStart(3, "0");
    }

    function targetShelf(n) {
        return shelves.find((s) => n >= s.min && n <= s.max);
    }

    function celebrate() {
        const colors = ["#f59e0b", "#16a34a", "#0284c7", "#d946ef", "#ef4444"];
        for (let i = 0; i < 12; i++) {
            const dot = document.createElement("span");
            dot.className = "burst";
            dot.style.left = `${20 + Math.random() * 60}vw`;
            dot.style.top = `${65 + Math.random() * 15}vh`;
            dot.style.background = colors[Math.floor(Math.random() * colors.length)];
            document.body.appendChild(dot);
            setTimeout(() => dot.remove(), 900);
        }
    }

    function judge(chosen) {
        if (!current) return;
        const right = targetShelf(current.n);
        const isCorrect = chosen.id === right.id;

        if (isCorrect) {
            state.score += 10 + Math.min(state.streak, 6);
            state.streak += 1;
            if (state.streak > state.best) state.best = state.streak;
            setMessage(`Nice shelving. ${String(current.n).padStart(3, "0")} belongs in ${right.id}.`, "ok");
            if (state.streak % 4 === 0) celebrate();
        } else {
            state.score = Math.max(0, state.score - 4);
            state.streak = 0;
            setMessage(`Close, but ${String(current.n).padStart(3, "0")} goes in ${right.id} (${right.name}).`, "bad");
        }

        ui.score.textContent = state.score;
        ui.best.textContent = state.best;
        ui.streak.textContent = state.streak;

        drawCard();
    }

    ui.hintBtn.addEventListener("click", () => {
        if (!current) return;
        const right = targetShelf(current.n);
        setMessage(`Hint: This title belongs in ${right.id}xx territory.`, "");
        state.score = Math.max(0, state.score - 1);
        ui.score.textContent = state.score;
    });

    ui.skipBtn.addEventListener("click", () => {
        if (!current) return;
        state.streak = 0;
        ui.streak.textContent = state.streak;
        setMessage(`Skipped. New card loaded.`, "");
        drawCard();
    });

    ui.newRound.addEventListener("click", () => {
        state.score = 0;
        state.streak = 0;
        state.round = 0;
        ui.score.textContent = 0;
        ui.streak.textContent = 0;
        ui.best.textContent = state.best;
        setMessage("Fresh deck. Shelf like a legend.", "");
        refill();
    });

    buildShelves();
    refill();
})();
</script>
</body>
</html>
