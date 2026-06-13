<?php
$publishedDate = '2026-06-13';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seven Shuffle Saloon</title>
    <style>
        :root {
            --bg: #140f0b;
            --felt: #1d4b3c;
            --felt-dark: #12352a;
            --card: #fbf5e8;
            --ink: #261d16;
            --gold: #d6af54;
            --gold-soft: rgba(214, 175, 84, 0.28);
            --scarlet: #9d2f2f;
            --cream: #f5ead1;
            --muted: #c6b792;
            --line: rgba(255, 244, 210, 0.15);
            --shadow: 0 22px 60px rgba(0, 0, 0, 0.45);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Avenir Next", "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top, rgba(214, 175, 84, 0.18), transparent 28%),
                linear-gradient(180deg, #241710 0%, #120e0b 100%);
            color: var(--cream);
            overflow-x: hidden;
        }

        body::before,
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        body::before {
            background:
                linear-gradient(135deg, rgba(255,255,255,0.03), transparent 24%),
                repeating-linear-gradient(90deg, rgba(255,255,255,0.015) 0 1px, transparent 1px 42px);
            mix-blend-mode: screen;
            opacity: 0.5;
        }

        body::after {
            background: radial-gradient(circle at center, transparent 58%, rgba(0, 0, 0, 0.42) 100%);
        }

        .page {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 40px;
            position: relative;
            z-index: 1;
        }

        .hero {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 28px;
            background:
                radial-gradient(circle at 20% 15%, rgba(255,255,255,0.08), transparent 20%),
                linear-gradient(135deg, rgba(214, 175, 84, 0.14), rgba(255,255,255,0.02)),
                linear-gradient(150deg, #215747, #15392e 58%, #102c23 100%);
            box-shadow: var(--shadow);
            padding: 28px;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 18px;
            border-radius: 20px;
            border: 1px solid rgba(255, 244, 210, 0.12);
            pointer-events: none;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
            align-items: center;
        }

        .eyebrow,
        .mini-label {
            text-transform: uppercase;
            letter-spacing: 0.22em;
            font-size: 0.72rem;
            color: var(--muted);
        }

        h1, h2, h3 {
            font-family: "Bookman Old Style", "Palatino Linotype", serif;
            margin: 0;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        h1 {
            font-size: clamp(2.6rem, 6vw, 5rem);
            line-height: 0.95;
            margin-top: 14px;
            text-shadow: 0 4px 18px rgba(0,0,0,0.28);
        }

        .lede {
            max-width: 62ch;
            font-size: 1.05rem;
            line-height: 1.7;
            color: #f8f0dc;
            margin: 16px 0 22px;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        a.button,
        button,
        select {
            font: inherit;
        }

        .button,
        button {
            border: none;
            cursor: pointer;
            color: var(--ink);
            background: linear-gradient(180deg, #f5d98d, #c99735);
            border-radius: 999px;
            padding: 12px 18px;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.22);
            transition: transform 140ms ease, box-shadow 140ms ease, filter 140ms ease;
        }

        .button:hover,
        button:hover {
            transform: translateY(-1px);
            filter: brightness(1.04);
        }

        .button.secondary,
        button.secondary {
            background: transparent;
            color: var(--cream);
            border: 1px solid rgba(255, 244, 210, 0.18);
            box-shadow: none;
        }

        .hero-cards {
            position: relative;
            min-height: 330px;
        }

        .fan-card {
            position: absolute;
            width: 148px;
            aspect-ratio: 7 / 10;
            border-radius: 18px;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.28), transparent 30%),
                var(--card);
            color: var(--ink);
            box-shadow: 0 18px 30px rgba(0, 0, 0, 0.28);
            padding: 14px;
            border: 1px solid rgba(38, 29, 22, 0.12);
        }

        .fan-card::before {
            content: "";
            position: absolute;
            inset: 8px;
            border: 1px solid rgba(38, 29, 22, 0.09);
            border-radius: 12px;
        }

        .fan-card.rank-a { top: 12px; right: 144px; transform: rotate(-14deg); }
        .fan-card.rank-b { top: 36px; right: 72px; transform: rotate(6deg); }
        .fan-card.rank-c { top: 112px; right: 164px; transform: rotate(14deg); }

        .fan-value {
            font-family: "Bookman Old Style", "Palatino Linotype", serif;
            font-size: 2.6rem;
            line-height: 1;
        }

        .fan-suit {
            font-size: 3rem;
            position: absolute;
            right: 20px;
            bottom: 18px;
            opacity: 0.82;
        }

        .fan-note {
            position: absolute;
            right: 6px;
            bottom: -2px;
            width: 240px;
            padding: 16px 18px;
            border-radius: 18px;
            background: rgba(20, 15, 11, 0.74);
            border: 1px solid rgba(255, 244, 210, 0.12);
            backdrop-filter: blur(10px);
        }

        .layout {
            display: grid;
            grid-template-columns: 340px minmax(0, 1fr);
            gap: 22px;
            margin-top: 24px;
        }

        .panel {
            background: rgba(19, 14, 10, 0.72);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 22px;
            backdrop-filter: blur(10px);
        }

        .controls {
            display: grid;
            gap: 16px;
        }

        .control-block {
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 244, 210, 0.08);
            padding: 16px;
        }

        .control-block p {
            margin: 10px 0 0;
            line-height: 1.55;
            color: var(--muted);
            font-size: 0.95rem;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: var(--muted);
        }

        select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: 1px solid rgba(255, 244, 210, 0.12);
            background: rgba(251, 245, 232, 0.08);
            color: var(--cream);
        }

        .button-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 12px;
        }

        .button-row .full {
            grid-column: 1 / -1;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .stat {
            background: linear-gradient(180deg, rgba(255,255,255,0.05), rgba(255,255,255,0.02));
            border-radius: 18px;
            padding: 16px;
            border: 1px solid rgba(255, 244, 210, 0.09);
        }

        .stat-value {
            font-size: clamp(1.3rem, 4vw, 2.2rem);
            font-weight: 800;
            margin-top: 8px;
        }

        .meter {
            margin-top: 14px;
            height: 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
            overflow: hidden;
            position: relative;
        }

        .meter-fill {
            height: 100%;
            width: 0%;
            border-radius: inherit;
            background: linear-gradient(90deg, #9d2f2f 0%, #d18f34 45%, #e7d377 100%);
            transition: width 260ms ease;
        }

        .verdict {
            margin-top: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(214, 175, 84, 0.12);
            border: 1px solid rgba(214, 175, 84, 0.22);
            color: #f4e6bd;
            line-height: 1.55;
        }

        .tableau {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
            margin-top: 22px;
        }

        .top-cards {
            min-height: 318px;
        }

        .card-row {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 10px;
            margin-top: 14px;
        }

        .play-card {
            position: relative;
            aspect-ratio: 7 / 10;
            border-radius: 18px;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.25), transparent 30%),
                var(--card);
            color: var(--ink);
            border: 1px solid rgba(38, 29, 22, 0.12);
            box-shadow: 0 14px 24px rgba(0,0,0,0.22);
            overflow: hidden;
        }

        .play-card.highlight {
            outline: 3px solid rgba(214, 175, 84, 0.88);
            transform: translateY(-4px);
        }

        .play-card::before {
            content: "";
            position: absolute;
            inset: 7px;
            border-radius: 12px;
            border: 1px solid rgba(38, 29, 22, 0.08);
        }

        .play-corner {
            position: absolute;
            left: 10px;
            top: 8px;
            text-align: center;
            font-weight: 700;
            font-size: 1rem;
            line-height: 1.05;
        }

        .play-suit {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            font-size: clamp(1.9rem, 4vw, 2.8rem);
            opacity: 0.85;
        }

        .play-deck {
            position: absolute;
            right: 10px;
            bottom: 10px;
            font-size: 0.74rem;
            color: rgba(38, 29, 22, 0.62);
            font-weight: 700;
            letter-spacing: 0.08em;
        }

        .sidebar-stack {
            display: grid;
            gap: 14px;
        }

        .tracker {
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 244, 210, 0.08);
            padding: 16px;
        }

        .tracker p {
            margin: 0;
            color: var(--muted);
            line-height: 1.5;
        }

        .tracker strong {
            color: var(--cream);
        }

        .ace-list {
            margin: 12px 0 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .ace-list li {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 244, 210, 0.08);
            color: var(--cream);
        }

        .ace-list li:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .history {
            margin-top: 20px;
        }

        .history-list {
            display: grid;
            gap: 10px;
            margin-top: 12px;
        }

        .history-item {
            display: grid;
            grid-template-columns: 76px 1fr 92px;
            gap: 10px;
            align-items: center;
            padding: 12px 14px;
            border-radius: 16px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255, 244, 210, 0.08);
        }

        .history-item .tag {
            color: var(--gold);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.72rem;
        }

        .history-item .card-name,
        .history-item .distance {
            color: var(--muted);
            font-size: 0.92rem;
        }

        .lessons {
            margin-top: 24px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .lesson {
            border-radius: 18px;
            padding: 16px;
            background: linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
            border: 1px solid rgba(255, 244, 210, 0.08);
        }

        .lesson p {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.55;
        }

        .footer-note {
            margin-top: 26px;
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .footer-note a {
            color: #f3d691;
        }

        .red {
            color: var(--scarlet);
        }

        @media (max-width: 980px) {
            .hero-grid,
            .layout,
            .tableau,
            .lessons {
                grid-template-columns: 1fr;
            }

            .hero-cards {
                min-height: 280px;
            }

            .fan-card {
                width: 128px;
            }
        }

        @media (max-width: 720px) {
            .page {
                width: min(100% - 18px, 100%);
                padding-top: 18px;
            }

            .hero,
            .panel {
                border-radius: 22px;
                padding: 18px;
            }

            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .card-row {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .history-item {
                grid-template-columns: 1fr;
            }

            .button-row {
                grid-template-columns: 1fr;
            }

            .fan-card.rank-a { top: 0; right: 108px; }
            .fan-card.rank-b { top: 28px; right: 36px; }
            .fan-card.rank-c { top: 86px; right: 124px; }
            .fan-note {
                position: relative;
                right: auto;
                bottom: auto;
                width: auto;
                margin-top: 192px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="hero-grid">
                <div>
                    <div class="eyebrow">Chloe Reads Jon • <?= htmlspecialchars($publishedDate, ENT_QUOTES) ?></div>
                    <h1>Seven Shuffle Saloon</h1>
                    <p class="lede">Jon once linked to the delightful fact that a 52-card deck needs about <strong>7 riffle shuffles</strong> before it feels properly mixed. This page turns that little fact into a playable card-table laboratory, complete with deck sizes, a card tracker, and a “has this become chaos yet?” meter.</p>
                    <div class="hero-actions">
                        <a class="button" href="index.php">Back to Chloe Reads Jon</a>
                        <a class="button secondary" href="#play">Deal Me In</a>
                    </div>
                </div>
                <div class="hero-cards" aria-hidden="true">
                    <div class="fan-card rank-a">
                        <div class="fan-value red">A</div>
                        <div class="fan-suit red">♥</div>
                    </div>
                    <div class="fan-card rank-b">
                        <div class="fan-value">7</div>
                        <div class="fan-suit">♠</div>
                    </div>
                    <div class="fan-card rank-c">
                        <div class="fan-value red">K</div>
                        <div class="fan-suit red">♦</div>
                    </div>
                    <div class="fan-note">
                        <div class="mini-label">House Rule</div>
                        <div style="margin-top:8px; line-height:1.6;">One deck wants 7 shuffles. Two decks want 9. A six-deck shoe wants 12. Mathematics, with a faint smell of casino carpet.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="layout" id="play">
            <aside class="panel controls">
                <div class="control-block">
                    <div class="mini-label">Step 1</div>
                    <h2 style="margin-top:8px;">Choose Your Deck</h2>
                    <label for="deckSize">Deck size</label>
                    <select id="deckSize">
                        <option value="52">52 cards • single deck</option>
                        <option value="104">104 cards • double deck</option>
                        <option value="312">312 cards • six-deck shoe</option>
                    </select>
                    <p id="recommendationText">Recommended shuffles: 7</p>
                </div>

                <div class="control-block">
                    <div class="mini-label">Step 2</div>
                    <h2 style="margin-top:8px;">Riffle It</h2>
                    <div class="button-row">
                        <button id="shuffleOnce">Shuffle Once</button>
                        <button class="secondary" id="resetDeck">Reset Deck</button>
                        <button class="full" id="shuffleRecommended">Shuffle To Recommendation</button>
                    </div>
                    <p>Every click performs a plausible riffle-style interleave with uneven packet drops, which is much closer to real life than a sterile perfect shuffle.</p>
                </div>

                <div class="control-block">
                    <div class="mini-label">Step 3</div>
                    <h2 style="margin-top:8px;">Track A Card</h2>
                    <label for="trackedCard">Spotlight card</label>
                    <select id="trackedCard"></select>
                    <p id="trackedSummary">The chosen card begins at position 1.</p>
                </div>
            </aside>

            <main class="panel">
                <div class="mini-label">Table Readout</div>
                <h2 style="margin-top:8px;">How scrambled is the deck?</h2>

                <div class="stat-grid">
                    <div class="stat">
                        <div class="mini-label">Shuffle Count</div>
                        <div class="stat-value" id="shuffleCount">0</div>
                    </div>
                    <div class="stat">
                        <div class="mini-label">Recommended</div>
                        <div class="stat-value" id="recommendedValue">7</div>
                    </div>
                    <div class="stat">
                        <div class="mini-label">Disorder</div>
                        <div class="stat-value" id="disorderValue">0%</div>
                    </div>
                    <div class="stat">
                        <div class="mini-label">Tracked Position</div>
                        <div class="stat-value" id="trackedPosition">1</div>
                    </div>
                </div>

                <div class="meter" aria-hidden="true">
                    <div class="meter-fill" id="meterFill"></div>
                </div>

                <div class="verdict" id="verdictBox">
                    Fresh out of the box. Every card still knows exactly where it was born.
                </div>

                <div class="tableau">
                    <section class="top-cards">
                        <div class="mini-label">Top Twelve Cards</div>
                        <div class="card-row" id="cardRow"></div>
                    </section>

                    <section class="sidebar-stack">
                        <div class="tracker">
                            <div class="mini-label">Ace Radar</div>
                            <ul class="ace-list" id="aceList"></ul>
                        </div>
                        <div class="tracker">
                            <div class="mini-label">Why It Matters</div>
                            <p>The first few shuffles mostly preserve clumps. By the time you approach the recommendation, cards start wandering far enough that human intuition gives up and randomness finally struts in.</p>
                        </div>
                    </section>
                </div>

                <section class="history">
                    <div class="mini-label">Shuffle Trail</div>
                    <div class="history-list" id="historyList"></div>
                </section>

                <section class="lessons">
                    <article class="lesson">
                        <div class="mini-label">1</div>
                        <h3 style="margin-top:8px;">One deck</h3>
                        <p>Seven riffles is the famous benchmark. Below that, the deck still has suspiciously intact neighborhoods.</p>
                    </article>
                    <article class="lesson">
                        <div class="mini-label">2</div>
                        <h3 style="margin-top:8px;">Two decks</h3>
                        <p>Nine shuffles is a better target because extra cards create more room for recognizable chunks to survive.</p>
                    </article>
                    <article class="lesson">
                        <div class="mini-label">3</div>
                        <h3 style="margin-top:8px;">Six decks</h3>
                        <p>A casino shoe is a little beast. Twelve riffles is the house suggestion before the chaos starts to look respectable.</p>
                    </article>
                </section>

                <p class="footer-note">Inspired by Jon’s post <a href="https://jona.ca/2010/09/to-ensure-that-deck-of-cards-is.html">“To ensure that a deck of cards is sufficiently shuffled...”</a>, which boiled the idea down to a lovely little rule of thumb. Sometimes a blog post wants an essay. Sometimes it wants a felt table and a gold button.</p>
            </main>
        </section>
    </div>

    <script>
        const recommendations = {
            52: 7,
            104: 9,
            312: 12
        };

        const suits = [
            { symbol: "♠", color: "black" },
            { symbol: "♥", color: "red" },
            { symbol: "♦", color: "red" },
            { symbol: "♣", color: "black" }
        ];

        const ranks = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

        const deckSizeEl = document.getElementById("deckSize");
        const recommendationTextEl = document.getElementById("recommendationText");
        const recommendedValueEl = document.getElementById("recommendedValue");
        const shuffleCountEl = document.getElementById("shuffleCount");
        const disorderValueEl = document.getElementById("disorderValue");
        const trackedPositionEl = document.getElementById("trackedPosition");
        const trackedSummaryEl = document.getElementById("trackedSummary");
        const verdictBoxEl = document.getElementById("verdictBox");
        const meterFillEl = document.getElementById("meterFill");
        const cardRowEl = document.getElementById("cardRow");
        const trackedCardEl = document.getElementById("trackedCard");
        const aceListEl = document.getElementById("aceList");
        const historyListEl = document.getElementById("historyList");

        const state = {
            size: 52,
            deck: [],
            originalDeck: [],
            shuffleCount: 0,
            trackedId: "0-0-0",
            history: []
        };

        function makeDeck(size) {
            const decks = size / 52;
            const cards = [];
            for (let deckNumber = 0; deckNumber < decks; deckNumber += 1) {
                for (let suitIndex = 0; suitIndex < suits.length; suitIndex += 1) {
                    for (let rankIndex = 0; rankIndex < ranks.length; rankIndex += 1) {
                        cards.push({
                            id: `${deckNumber}-${suitIndex}-${rankIndex}`,
                            deckNumber: deckNumber + 1,
                            suitIndex,
                            rankIndex,
                            rank: ranks[rankIndex],
                            suit: suits[suitIndex].symbol,
                            color: suits[suitIndex].color
                        });
                    }
                }
            }
            return cards;
        }

        function chunkTake(source) {
            if (!source.length) {
                return null;
            }
            const maxChunk = Math.min(4, source.length);
            const size = 1 + Math.floor(Math.random() * maxChunk);
            return source.splice(0, size);
        }

        function riffleShuffle(deck) {
            const splitBase = deck.length / 2;
            const offset = Math.floor((Math.random() - 0.5) * Math.min(18, deck.length * 0.18));
            const split = Math.max(0, Math.min(deck.length, Math.floor(splitBase + offset)));
            const left = deck.slice(0, split);
            const right = deck.slice(split);
            const output = [];

            while (left.length || right.length) {
                const total = left.length + right.length;
                const takeLeft = right.length === 0 || (left.length > 0 && Math.random() < left.length / total);
                const chunk = takeLeft ? chunkTake(left) : chunkTake(right);
                output.push(...chunk);
            }

            return output;
        }

        function displacementScore(deck) {
            const total = deck.reduce((sum, card, index) => {
                const originalIndex = state.originalDeck.findIndex(original => original.id === card.id);
                return sum + Math.abs(originalIndex - index);
            }, 0);
            const maxPerCard = deck.length - 1;
            return Math.min(100, Math.round((total / (deck.length * maxPerCard)) * 180));
        }

        function cardLabel(card) {
            return `${card.rank}${card.suit}${state.size > 52 ? "·" + card.deckNumber : ""}`;
        }

        function trackedCardPosition() {
            return state.deck.findIndex(card => card.id === state.trackedId) + 1;
        }

        function acePositions() {
            const aces = state.deck.filter(card => card.rank === "A");
            return aces.map(card => ({
                label: cardLabel(card),
                position: state.deck.findIndex(item => item.id === card.id) + 1
            }));
        }

        function verdictText() {
            const recommendation = recommendations[state.size];
            const disorder = displacementScore(state.deck);
            if (state.shuffleCount === 0) {
                return "Fresh out of the box. Every card still knows exactly where it was born.";
            }
            if (state.shuffleCount < recommendation / 2) {
                return "Still suspiciously neat. A magician might smile at this deck, which is not the same thing as randomness.";
            }
            if (state.shuffleCount < recommendation) {
                return "Respectable confusion, but some clusters are still clinging to each other like nervous cousins at a wedding.";
            }
            if (disorder < 70) {
                return "You reached the rule-of-thumb count, but this particular run kept a few pockets of order alive. One more shuffle would not be dramatic.";
            }
            return "Now we’re talking. The deck feels gloriously ordinary, which is exactly what good randomness looks like.";
        }

        function renderTrackedOptions() {
            trackedCardEl.innerHTML = "";
            state.originalDeck.forEach(card => {
                const option = document.createElement("option");
                option.value = card.id;
                option.textContent = cardLabel(card);
                trackedCardEl.appendChild(option);
            });
            trackedCardEl.value = state.trackedId;
        }

        function renderCards() {
            cardRowEl.innerHTML = "";
            state.deck.slice(0, 12).forEach(card => {
                const el = document.createElement("div");
                el.className = "play-card" + (card.id === state.trackedId ? " highlight" : "");

                const corner = document.createElement("div");
                corner.className = "play-corner" + (card.color === "red" ? " red" : "");
                corner.innerHTML = `${card.rank}<br>${card.suit}`;

                const suit = document.createElement("div");
                suit.className = "play-suit" + (card.color === "red" ? " red" : "");
                suit.textContent = card.suit;

                const deck = document.createElement("div");
                deck.className = "play-deck";
                deck.textContent = state.size > 52 ? `DECK ${card.deckNumber}` : "STANDARD";

                el.append(corner, suit, deck);
                cardRowEl.appendChild(el);
            });
        }

        function renderAces() {
            aceListEl.innerHTML = "";
            acePositions().forEach(entry => {
                const item = document.createElement("li");
                item.innerHTML = `<span>${entry.label}</span><strong>#${entry.position}</strong>`;
                aceListEl.appendChild(item);
            });
        }

        function renderHistory() {
            historyListEl.innerHTML = "";
            state.history.slice(-6).reverse().forEach(entry => {
                const tracked = entry.deckIds.indexOf(state.trackedId) + 1;
                const row = document.createElement("div");
                row.className = "history-item";
                row.innerHTML = `
                    <div class="tag">${entry.shuffle === 0 ? "Fresh" : "Shuffle " + entry.shuffle}</div>
                    <div class="card-name">Tracked card landed at position <strong>#${tracked}</strong></div>
                    <div class="distance">${entry.disorder}% disorder</div>
                `;
                historyListEl.appendChild(row);
            });
        }

        function renderStats() {
            const recommendation = recommendations[state.size];
            const disorder = displacementScore(state.deck);
            shuffleCountEl.textContent = String(state.shuffleCount);
            recommendedValueEl.textContent = String(recommendation);
            disorderValueEl.textContent = `${disorder}%`;
            trackedPositionEl.textContent = String(trackedCardPosition());
            trackedSummaryEl.textContent = `${cardNameById(state.trackedId)} is currently sitting at position ${trackedCardPosition()}.`;
            recommendationTextEl.textContent = `Recommended shuffles: ${recommendation}`;
            verdictBoxEl.textContent = verdictText();
            meterFillEl.style.width = `${Math.min(100, (state.shuffleCount / recommendation) * 100)}%`;
        }

        function cardNameById(id) {
            const card = state.originalDeck.find(entry => entry.id === id);
            return card ? cardLabel(card) : "That card";
        }

        function render() {
            renderStats();
            renderCards();
            renderAces();
            renderHistory();
        }

        function resetState(size = state.size) {
            state.size = Number(size);
            state.originalDeck = makeDeck(state.size);
            state.deck = [...state.originalDeck];
            state.shuffleCount = 0;
            state.trackedId = state.originalDeck[0].id;
            state.history = [{
                shuffle: 0,
                disorder: 0,
                deckIds: state.deck.map(card => card.id)
            }];
            renderTrackedOptions();
            render();
        }

        function shuffleOnce() {
            state.deck = riffleShuffle(state.deck);
            state.shuffleCount += 1;
            state.history.push({
                shuffle: state.shuffleCount,
                disorder: displacementScore(state.deck),
                deckIds: state.deck.map(card => card.id)
            });
            render();
        }

        document.getElementById("shuffleOnce").addEventListener("click", shuffleOnce);

        document.getElementById("resetDeck").addEventListener("click", () => {
            resetState(deckSizeEl.value);
        });

        document.getElementById("shuffleRecommended").addEventListener("click", () => {
            const target = recommendations[state.size];
            while (state.shuffleCount < target) {
                shuffleOnce();
            }
        });

        deckSizeEl.addEventListener("change", event => {
            resetState(event.target.value);
        });

        trackedCardEl.addEventListener("change", event => {
            state.trackedId = event.target.value;
            render();
        });

        resetState(52);
    </script>
</body>
</html>
