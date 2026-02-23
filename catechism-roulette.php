<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catechism Roulette</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #1a2744;
            --gold: #c9a84c;
            --gold-light: #e8c96e;
            --cream: #fdf8f0;
            --text: #2a2010;
            --muted: #7a6a50;
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: var(--navy);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 16px 40px;
            color: var(--text);
        }

        header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header-cross {
            font-size: 2rem;
            color: var(--gold);
            display: block;
            margin-bottom: 4px;
            text-shadow: 0 0 20px rgba(201,168,76,0.4);
        }

        h1 {
            color: var(--gold-light);
            font-size: 1.9em;
            font-weight: normal;
            letter-spacing: 0.04em;
            line-height: 1.2;
        }

        .subtitle {
            color: #8899bb;
            font-size: 0.85em;
            margin-top: 6px;
            font-style: italic;
        }

        /* Card area */
        .card-scene {
            width: 100%;
            max-width: 520px;
            perspective: 1200px;
            margin-bottom: 28px;
        }

        .card {
            position: relative;
            width: 100%;
            min-height: 320px;
            transform-style: preserve-3d;
            transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .card.flipped {
            transform: rotateY(180deg);
        }

        .card-face {
            position: absolute;
            width: 100%;
            min-height: 320px;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            border-radius: 16px;
            padding: 32px 28px;
            display: flex;
            flex-direction: column;
        }

        .card-front {
            background: linear-gradient(145deg, #1e2d5a 0%, #162040 100%);
            border: 1px solid rgba(201,168,76,0.3);
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .card-front .ccc-label {
            color: var(--gold);
            font-size: 0.8em;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .card-front .para-num {
            color: var(--gold-light);
            font-size: 4em;
            font-weight: bold;
            line-height: 1;
            font-family: 'Georgia', serif;
            text-shadow: 0 2px 12px rgba(201,168,76,0.3);
        }

        .card-front .section-tag {
            color: #8899bb;
            font-size: 0.8em;
            margin-top: 16px;
            font-style: italic;
            line-height: 1.4;
            max-width: 280px;
        }

        .card-front .flip-hint {
            position: absolute;
            bottom: 20px;
            right: 24px;
            color: rgba(201,168,76,0.5);
            font-size: 0.75em;
            letter-spacing: 0.05em;
        }

        .card-front .ornament {
            margin: 20px 0;
            color: rgba(201,168,76,0.3);
            font-size: 1.4em;
            letter-spacing: 0.3em;
        }

        .card-back {
            background: var(--cream);
            border: 1px solid #d4c5a0;
            transform: rotateY(180deg);
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .card-back .back-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #d4c5a0;
        }

        .card-back .back-para-num {
            color: var(--gold);
            font-size: 1.1em;
            font-weight: bold;
        }

        .card-back .back-section {
            color: var(--muted);
            font-size: 0.75em;
            text-align: right;
            line-height: 1.4;
            max-width: 60%;
            font-style: italic;
        }

        .card-back .passage-text {
            flex: 1;
            color: var(--text);
            font-size: 1.0em;
            line-height: 1.75;
            font-style: italic;
            overflow-y: auto;
        }

        .card-back .back-footer {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #d4c5a0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-back .flip-back-hint {
            color: var(--muted);
            font-size: 0.75em;
            font-style: italic;
        }

        .fav-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.3em;
            line-height: 1;
            padding: 4px;
            transition: transform 0.15s;
        }
        .fav-btn:hover { transform: scale(1.2); }

        /* Controls */
        .controls {
            display: flex;
            gap: 12px;
            width: 100%;
            max-width: 520px;
            margin-bottom: 24px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-family: 'Georgia', serif;
            font-size: 0.95em;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: bold;
            letter-spacing: 0.02em;
        }

        .btn-primary {
            background: var(--gold);
            color: var(--navy);
        }
        .btn-primary:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(201,168,76,0.3);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.08);
            color: #aabbcc;
            border: 1px solid rgba(255,255,255,0.12);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.12);
            color: #ccd;
        }

        /* Progress / streak */
        .stats-row {
            display: flex;
            gap: 16px;
            width: 100%;
            max-width: 520px;
            margin-bottom: 24px;
        }

        .stat-box {
            flex: 1;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 12px 16px;
            text-align: center;
        }

        .stat-num {
            color: var(--gold-light);
            font-size: 1.4em;
            font-weight: bold;
            display: block;
        }

        .stat-label {
            color: #7a8a99;
            font-size: 0.72em;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-top: 2px;
        }

        /* Favorites panel */
        .favs-panel {
            width: 100%;
            max-width: 520px;
            display: none;
        }

        .favs-panel.open {
            display: block;
        }

        .favs-header {
            color: var(--gold);
            font-size: 0.85em;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .favs-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 300px;
            overflow-y: auto;
        }

        .fav-item {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 10px;
            padding: 12px 16px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .fav-item:hover { background: rgba(255,255,255,0.09); }

        .fav-item .fi-num {
            color: var(--gold);
            font-size: 0.85em;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .fav-item .fi-text {
            color: #aab;
            font-size: 0.8em;
            font-style: italic;
            line-height: 1.4;
            /* Truncate */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .empty-favs {
            color: #556;
            font-style: italic;
            font-size: 0.85em;
            text-align: center;
            padding: 20px;
        }

        /* Daily pick badge */
        .daily-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(201,168,76,0.1);
            border: 1px solid rgba(201,168,76,0.3);
            color: var(--gold);
            font-size: 0.75em;
            padding: 5px 12px;
            border-radius: 20px;
            margin-bottom: 20px;
            letter-spacing: 0.04em;
        }

        @media (max-width: 400px) {
            h1 { font-size: 1.5em; }
            .card-face { padding: 24px 20px; }
            .card-front .para-num { font-size: 3em; }
            .card-back .passage-text { font-size: 0.92em; }
        }
    </style>
</head>
<body>

<header>
    <span class="header-cross">✝</span>
    <h1>Catechism Roulette</h1>
    <p class="subtitle">Spin through the wisdom of the ages</p>
</header>

<div class="daily-badge" id="dailyBadge">
    📅 Today's paragraph: <span id="dailyNum">—</span>
</div>

<div class="card-scene">
    <div class="card" id="card" onclick="flipCard()">
        <div class="card-face card-front" id="cardFront">
            <div class="ccc-label">Catechism of the Catholic Church</div>
            <div class="para-num" id="frontNum">—</div>
            <div class="ornament">· · ·</div>
            <div class="section-tag" id="frontSection">Loading…</div>
            <div class="flip-hint">tap to reveal ▸</div>
        </div>
        <div class="card-face card-back" id="cardBack">
            <div class="back-header">
                <div class="back-para-num" id="backNum">CCC —</div>
                <div class="back-section" id="backSection"></div>
            </div>
            <div class="passage-text" id="backText"></div>
            <div class="back-footer">
                <div class="flip-back-hint">tap card to flip</div>
                <button class="fav-btn" id="favBtn" onclick="event.stopPropagation(); toggleFav()" title="Save to favourites">☆</button>
            </div>
        </div>
    </div>
</div>

<div class="controls">
    <button class="btn btn-primary" onclick="nextCard()">✦ New Paragraph</button>
    <button class="btn btn-secondary" id="favsToggle" onclick="toggleFavsPanel()">☆ Saved (<span id="favCount">0</span>)</button>
</div>

<div class="stats-row">
    <div class="stat-box">
        <span class="stat-num" id="seenCount">0</span>
        <div class="stat-label">Seen Today</div>
    </div>
    <div class="stat-box">
        <span class="stat-num" id="streakCount">0</span>
        <div class="stat-label">Day Streak</div>
    </div>
    <div class="stat-box">
        <span class="stat-num" id="totalSaved">0</span>
        <div class="stat-label">All-Time Saved</div>
    </div>
</div>

<div class="favs-panel" id="favsPanel">
    <div class="favs-header">✦ Saved Paragraphs</div>
    <div class="favs-list" id="favsList"></div>
</div>

<script>
// ── Catechism paragraphs ──────────────────────────────────────────────────
// A curated selection of notable passages from the CCC
const CCC = [
    {
        num: 1,
        section: "Part One · The Profession of Faith",
        text: "God, infinitely perfect and blessed in himself, in a plan of sheer goodness freely created man to make him share in his own blessed life. For this reason, at every time and in every place, God draws close to man. He calls man to seek him, to know him, to love him with all his strength."
    },
    {
        num: 27,
        section: "Part One · The Profession of Faith",
        text: "The desire for God is written in the human heart, because man is created by God and for God; and God never ceases to draw man to himself. Only in God will he find the truth and happiness he never stops searching for."
    },
    {
        num: 31,
        section: "Part One · Section I · Man's Capacity for God",
        text: "Created in God's image and called to know and love him, the person who seeks God discovers certain ways of coming to know him. These are also called proofs for the existence of God, not in the sense of proofs in the natural sciences, but rather in the sense of 'converging and convincing arguments'."
    },
    {
        num: 74,
        section: "Part One · Chapter Two · God Comes to Meet Man",
        text: "God 'desires all men to be saved and to come to the knowledge of the truth': that is, of Christ Jesus. Christ must be proclaimed to all nations and individuals, so that this revelation may reach to the ends of the earth."
    },
    {
        num: 100,
        section: "Part One · Sacred Scripture",
        text: "The task of interpreting the Word of God authentically has been entrusted solely to the Magisterium of the Church, that is, to the Pope and to the bishops in communion with him."
    },
    {
        num: 104,
        section: "Part One · Sacred Scripture",
        text: "In Sacred Scripture, the Church constantly finds her nourishment and her strength, for she welcomes it not as a human word, 'but as what it really is, the word of God'. In the sacred books, the Father who is in heaven comes lovingly to meet his children, and talks with them."
    },
    {
        num: 199,
        section: "Part One · Chapter One · I Believe in God the Father",
        text: "I believe in God: this first affirmation of the Apostles' Creed is also the most fundamental. The whole Creed speaks of God, and when it also speaks of man and of the world it does so in relation to God. The other articles of the Creed all depend on the first, just as the remaining Beatitudes all flow from the first."
    },
    {
        num: 234,
        section: "Part One · The Holy Trinity",
        text: "The mystery of the Most Holy Trinity is the central mystery of Christian faith and life. It is the mystery of God in himself. It is therefore the source of all the other mysteries of faith, the light that enlightens them."
    },
    {
        num: 260,
        section: "Part One · The Holy Trinity",
        text: "The ultimate end of the whole divine economy is the entry of God's creatures into the perfect unity of the Blessed Trinity. But even now we are called to be a dwelling for the Most Holy Trinity."
    },
    {
        num: 279,
        section: "Part One · The Creator",
        text: "\"In the beginning God created the heavens and the earth.\" Holy Scripture begins with these solemn words. The profession of faith takes them up when it confesses that God the Father almighty is \"Creator of heaven and earth.\""
    },
    {
        num: 299,
        section: "Part One · The Creator",
        text: "Because God creates through wisdom, his creation is ordered: 'You have arranged all things by measure and number and weight.' The universe, created in and by the eternal Word, the 'image of the invisible God', is destined for and addressed to man, himself created in the 'image of God' and called to a personal relationship with God."
    },
    {
        num: 356,
        section: "Part One · The Dignity of the Human Person",
        text: "Of all visible creatures only man is 'able to know and love his creator'. He is 'the only creature on earth that God has willed for its own sake', and he alone is called to share, by knowledge and love, in God's own life. It was for this end that he was created, and this is the fundamental reason for his dignity."
    },
    {
        num: 362,
        section: "Part One · The Dignity of the Human Person",
        text: "The human person, created in the image of God, is a being at once corporeal and spiritual. The biblical account expresses this reality in symbolic language when it affirms that 'then the LORD God formed man of dust from the ground, and breathed into his nostrils the breath of life; and man became a living being.'"
    },
    {
        num: 396,
        section: "Part One · The Fall",
        text: "God created man in his image and established him in his friendship. A spiritual creature, man can live this friendship only in free submission to God. The prohibition against eating 'of the tree of the knowledge of good and evil' spells this out: 'for in the day that you eat of it, you shall die.' The 'tree of the knowledge of good and evil' symbolically evokes the insurmountable limits that man, being a creature, must freely recognize and respect with trust."
    },
    {
        num: 422,
        section: "Part One · Jesus Christ",
        text: "'But when the time had fully come, God sent forth his Son, born of a woman, born under the law, to redeem those who were under the law, so that we might receive adoption as sons.' This is 'the gospel of Jesus Christ, the Son of God': God has visited his people. He has fulfilled the promise he made to Abraham and his descendants. He acted far beyond all expectation — he has sent his own 'beloved Son.'"
    },
    {
        num: 457,
        section: "Part One · Why the Word Became Flesh",
        text: "The Word became flesh for us in order to save us by reconciling us with God, who 'loved us and sent his Son to be the expiation for our sins': 'the Father has sent his Son as the Saviour of the world', and 'he was revealed to take away sins'."
    },
    {
        num: 484,
        section: "Part One · The Incarnation",
        text: "The Annunciation to Mary inaugurates 'the fullness of time', the time of the fulfilment of God's promises and preparations. Mary was invited to conceive him in whom the 'whole fullness of deity' would dwell 'bodily'. The divine response to her question, 'How can this be, since I know not man?', was given by the power of the Spirit."
    },
    {
        num: 519,
        section: "Part One · The Mysteries of Christ's Life",
        text: "All Christ's riches 'are for every individual and are everybody's property.' Christ did not live his life for himself but for us, from his Incarnation 'for us men and for our salvation' to his death 'for our sins' and Resurrection 'for our justification'. He is still 'our advocate with the Father.'"
    },
    {
        num: 571,
        section: "Part One · The Paschal Mystery",
        text: "The Paschal mystery of Christ's cross and Resurrection stands at the centre of the Good News that the apostles, and the Church following them, are to proclaim to the world. God's saving plan was accomplished 'once for all' by the redemptive death of his Son Jesus Christ."
    },
    {
        num: 638,
        section: "Part One · The Resurrection",
        text: "\"We bring you the good news that what God promised to the fathers, this day he has fulfilled to us their children by raising Jesus.\" The Resurrection of Jesus is the crowning truth of our faith in Christ, a faith believed and lived as the central truth by the first Christian community; handed on as fundamental by Tradition."
    },
    {
        num: 668,
        section: "Part One · Christ Sits at the Right Hand of the Father",
        text: "'Christ died and lived again, that he might be Lord both of the dead and of the living.' Christ's Ascension into heaven signifies his participation, in his humanity, in God's power and authority. Jesus Christ is Lord: he possesses all power in heaven and on earth."
    },
    {
        num: 683,
        section: "Part One · The Holy Spirit",
        text: "No one can say 'Jesus is Lord' except by the Holy Spirit. Every time we begin to pray to Jesus it is the Holy Spirit who draws us on the way of prayer by his prevenient grace. Since he teaches us to pray by recalling Christ, how could we not pray to the Spirit too?"
    },
    {
        num: 748,
        section: "Part One · The Church",
        text: "'Christ is the light of nations.' These words open Vatican II's constitution on the Church. This calls to mind that Christ is the source of all light. The Church reflects Christ's light over the whole earth as the moon reflects the sun's light."
    },
    {
        num: 773,
        section: "Part One · The Church as Sacrament",
        text: "In the Church, this communion among human beings implies their communion with God. The Church is the place where humanity must rediscover its unity and salvation. The Church is 'the world reconciled.'"
    },
    {
        num: 823,
        section: "Part One · The Church is Holy",
        text: "\"The Church... is held, as a matter of faith, to be unfailingly holy. This is because Christ, the Son of God, who with the Father and the Spirit is hailed as 'alone holy', loved the Church as his Bride, giving himself up for her so as to sanctify her.\" The Church is then 'the holy People of God.'"
    },
    {
        num: 882,
        section: "Part One · The Hierarchical Constitution of the Church",
        text: "The Pope, Bishop of Rome and Peter's successor, 'is the perpetual and visible source and foundation of the unity both of the bishops and of the whole company of the faithful.' 'For the Roman Pontiff, by reason of his office as Vicar of Christ, and as pastor of the entire Church has full, supreme, and universal power over the whole Church, a power which he can always exercise unhindered.'"
    },
    {
        num: 959,
        section: "Part One · The Communion of Saints",
        text: "In the one family of God. If one member suffers, all suffer together; if one member is honoured, all rejoice together. And we cannot be separated from those who have gone before us with the sign of faith, our brothers and sisters in Christ."
    },
    {
        num: 1023,
        section: "Part One · Heaven",
        text: "Those who die in God's grace and friendship and are perfectly purified live for ever with Christ. They are like God for ever, for they 'see him as he is', face to face. By virtue of our apostolic authority, we define that: the souls of all the saints...and other faithful who died after receiving Christ's holy Baptism (provided they were not in need of purification)...already before they take up their bodies again...have been, are and will be in heaven."
    },
    {
        num: 1030,
        section: "Part One · Purgatory",
        text: "All who die in God's grace and friendship, but still imperfectly purified, are indeed assured of their eternal salvation; but after death they undergo purification, so as to achieve the holiness necessary to enter the joy of heaven."
    },
    {
        num: 1033,
        section: "Part One · Hell",
        text: "We cannot be united with God unless we freely choose to love him. But we cannot love God if we sin gravely against him, against our neighbor or against ourselves: 'He who does not love remains in death. Anyone who hates his brother is a murderer, and you know that no murderer has eternal life abiding in him.' Our Lord warns us that we shall be separated from him if we fail to meet the serious needs of the poor and the little ones who are his brethren."
    },
    {
        num: 1113,
        section: "Part Two · The Sacramental Economy",
        text: "The whole liturgical life of the Church revolves around the Eucharistic sacrifice and the sacraments. There are seven sacraments in the Church: Baptism, Confirmation (or Chrismation), the Eucharist, Penance, the Anointing of the Sick, Holy Orders, and Matrimony."
    },
    {
        num: 1129,
        section: "Part Two · The Sacramental Economy",
        text: "The Church affirms that for believers the sacraments of the New Covenant are necessary for salvation. 'Sacramental grace' is the grace of the Holy Spirit, given by Christ and proper to each sacrament."
    },
    {
        num: 1210,
        section: "Part Two · The Sacraments of Christian Initiation",
        text: "Christ instituted the sacraments of the new law. There are seven: Baptism, Confirmation, the Eucharist, Penance, the Anointing of the Sick, Holy Orders, and Matrimony. The seven sacraments touch all the stages and all the important moments of Christian life: they give birth and increase, healing and mission to the Christian's life of faith."
    },
    {
        num: 1322,
        section: "Part Two · The Eucharist",
        text: "The holy Eucharist completes Christian initiation. Those who have been raised to the dignity of the royal priesthood by Baptism and configured more deeply to Christ by Confirmation participate with the whole community in the Lord's own sacrifice by means of the Eucharist."
    },
    {
        num: 1333,
        section: "Part Two · The Eucharist",
        text: "At the Last Supper, on the night he was betrayed, our Savior instituted the Eucharistic sacrifice of his Body and Blood. This he did in order to perpetuate the sacrifice of the cross throughout the ages until he should come again, and so to entrust to his beloved Spouse, the Church, a memorial of his death and resurrection."
    },
    {
        num: 1391,
        section: "Part Two · The Fruits of Holy Communion",
        text: "Holy Communion augments our union with Christ. The principal fruit of receiving the Eucharist in Holy Communion is an intimate union with Christ Jesus. Indeed, the Lord said: 'He who eats my flesh and drinks my blood abides in me, and I in him.' Life in Christ has its foundation in the Eucharistic banquet."
    },
    {
        num: 1420,
        section: "Part Two · The Sacrament of Penance",
        text: "Through the sacraments of Christian initiation, man receives the new life of Christ. Now we carry this life 'in earthen vessels', and it remains 'hidden with Christ in God'. We are still in our 'earthly tent', subject to suffering, illness, and death. This new life as a child of God can be weakened and even lost by sin."
    },
    {
        num: 1601,
        section: "Part Two · The Sacrament of Matrimony",
        text: "\"The matrimonial covenant, by which a man and a woman establish between themselves a partnership of the whole of life, is by its nature ordered toward the good of the spouses and the procreation and education of offspring; this covenant between baptized persons has been raised by Christ the Lord to the dignity of a sacrament.\""
    },
    {
        num: 1700,
        section: "Part Three · The Dignity of the Human Person",
        text: "The dignity of the human person is rooted in his creation in the image and likeness of God; it is fulfilled in his vocation to divine beatitude. It is essential to a human being freely to direct himself to this fulfillment. By his deliberate actions, the human person does, or does not, conform to the good promised by God and attested by moral conscience."
    },
    {
        num: 1716,
        section: "Part Three · The Beatitudes",
        text: "The Beatitudes are at the heart of Jesus' preaching. They take up the promises made to the chosen people since Abraham. The Beatitudes fulfill the promises by ordering them no longer merely to the possession of a territory, but to the Kingdom of heaven."
    },
    {
        num: 1730,
        section: "Part Three · Human Freedom",
        text: "God created man a rational being, conferring on him the dignity of a person who can initiate and control his own actions. 'God willed that man should be left in the hand of his own counsel, so that he might of his own accord seek his Creator and freely attain his full and blessed perfection by cleaving to him.'"
    },
    {
        num: 1776,
        section: "Part Three · Moral Conscience",
        text: "\"Deep within his conscience man discovers a law which he has not laid upon himself but which he must obey. Its voice, ever calling him to love and to do what is good and to avoid evil, sounds in his heart at the right moment.... For man has in his heart a law inscribed by God.... His conscience is man's most secret core and his sanctuary. There he is alone with God whose voice echoes in his depths.\""
    },
    {
        num: 1814,
        section: "Part Three · The Virtues · Faith",
        text: "Faith is the theological virtue by which we believe in God and believe all that he has said and revealed to us, and that Holy Church proposes for our belief, because he is truth itself. By faith 'man freely commits his entire self to God'. For this reason the believer seeks to know and do God's will."
    },
    {
        num: 1822,
        section: "Part Three · The Virtues · Charity",
        text: "Charity is the theological virtue by which we love God above all things for his own sake, and our neighbor as ourselves for the love of God. Jesus makes charity the new commandment. By loving his own 'to the end', he makes manifest the Father's love which he receives. By loving one another, the disciples imitate the love of Jesus which they themselves receive."
    },
    {
        num: 1996,
        section: "Part Three · Grace and Justification",
        text: "Our justification comes from the grace of God. Grace is favor, the free and undeserved help that God gives us to respond to his call to become children of God, adoptive sons, partakers of the divine nature and of eternal life."
    },
    {
        num: 2052,
        section: "Part Three · The Ten Commandments",
        text: "\"Teacher, what good deed must I do, to have eternal life?\" To the young man who asked this question, Jesus answers first by invoking the necessity of recognizing God as the 'One there is who is good,' as the supreme Good and the source of all good. Then Jesus tells him: 'If you would enter life, keep the commandments.' And he cites for his questioner the precepts that concern love of neighbor."
    },
    {
        num: 2093,
        section: "Part Three · The First Commandment",
        text: "Faith, hope, and love entail specific demands. Man is obliged to believe, to hope, and to love. Faith requires not only that we believe in God but also that we avoid the sins contrary to it. Hope requires fleeing discouragement and refusing all presumption. Charity demands that we avoid everything that offends God's love."
    },
    {
        num: 2197,
        section: "Part Three · The Fourth Commandment",
        text: "God has willed that, after him, we should honor our parents to whom we owe life and who have handed on to us the knowledge of God. We are obliged to honor and respect all those whom God, for our good, has vested with his authority."
    },
    {
        num: 2258,
        section: "Part Three · The Fifth Commandment",
        text: "\"Human life is sacred because from its beginning it involves the creative action of God and it remains for ever in a special relationship with the Creator, who is its sole end. God alone is the Lord of life from its beginning until its end: no one can under any circumstance claim for himself the right directly to destroy an innocent human being.\""
    },
    {
        num: 2401,
        section: "Part Three · The Seventh Commandment",
        text: "The seventh commandment forbids unjustly taking or keeping the goods of one's neighbor and wronging him in any way with respect to his goods. It commands justice and charity in the care of earthly goods and the fruits of men's labor. For the sake of the common good, it requires respect for the universal destination of goods and respect for the right to private property."
    },
    {
        num: 2558,
        section: "Part Four · Christian Prayer",
        text: "\"Great is the mystery of the faith!\" The Church professes this mystery in the Apostles' Creed (Part One) and celebrates it in the sacramental liturgy (Part Two), so that the life of the faithful may be conformed to Christ in the Holy Spirit to the glory of God the Father (Part Three). This mystery, then, requires that the faithful believe in it, that they celebrate it, and that they live from it in a vital and personal relationship with the living and true God. This relationship is prayer."
    },
    {
        num: 2560,
        section: "Part Four · The Nature of Prayer",
        text: "\"Whether we realize it or not, prayer is the encounter of God's thirst with ours. God thirsts that we may thirst for him.\" — St. Augustine"
    },
    {
        num: 2590,
        section: "Part Four · The Sources of Prayer",
        text: "\"Prayer is the raising of one's mind and heart to God or the requesting of good things from God.\" — St. John Damascene. From this perspective it is always possible to pray. The time of prayer and the object of prayer need not be separated from ordinary life: 'pray constantly'; 'in everything give thanks'."
    },
    {
        num: 2607,
        section: "Part Four · Jesus Teaches Us How to Pray",
        text: "When Jesus prays he is already teaching us how to pray. His prayer to his Father is the theological path of our prayer to God. But the Gospel also gives us Jesus' explicit teaching on prayer. Like a wise teacher he takes hold of us where we are and leads us progressively toward the Father."
    },
    {
        num: 2663,
        section: "Part Four · The Lord's Prayer",
        text: "The tradition of Christian prayer is one of the ways in which the tradition of faith takes shape and grows, especially through the contemplation and study of believers who treasure in their hearts the events and words of the economy of salvation, and through their profound grasp of the spiritual realities they experience."
    },
    {
        num: 2759,
        section: "Part Four · The Lord's Prayer",
        text: "Jesus 'was praying at a certain place, and when he ceased, one of his disciples said to him, \"Lord, teach us to pray.\"' In response to this request the Lord entrusts to his disciples and to his Church the fundamental Christian prayer. St. Luke presents a brief text of five petitions, while St. Matthew gives a more developed version of seven petitions. The liturgical tradition of the Church has retained St. Matthew's text."
    },
    {
        num: 2777,
        section: "Part Four · The Lord's Prayer",
        text: "This word, full of meaning, is given to us by Jesus to grant us the freedom to use it. The simple and direct word 'Father' expresses an entirely new relationship with God. Never before had this address been used by Israel... But Jesus does not restrict its use to himself... When Jesus himself prays to his Father, he does not use this address in an exclusive way, but teaches us the 'Our Father.'"
    },
    {
        num: 2865,
        section: "Part Four · The Lord's Prayer (Final paragraph)",
        text: "Then the final doxology, 'For the kingdom, the power and the glory are yours, now and for ever,' takes up again, by inclusion, the first three petitions to our Father: the glorification of his name, the coming of his reign, and the power of his saving will. But these prayers are now proclaimed as adoration and thanksgiving, as in the liturgy of heaven. The ruler of this world has been 'cast out' of this world. He is no longer the 'prince of this world', and so the last word belongs to God: 'For thine is the kingdom and the power and the glory, for ever. Amen.' This is so."
    }
];

// ── State ──────────────────────────────────────────────────────────────────
const today = new Date().toISOString().slice(0, 10);
let currentIdx = 0;
let isFlipped = false;

function loadState() {
    const raw = localStorage.getItem('catechismRoulette');
    return raw ? JSON.parse(raw) : {
        favs: [],
        seenToday: 0,
        lastDate: null,
        streak: 0,
        totalSaved: 0,
        seenSet: []
    };
}

function saveState(s) {
    localStorage.setItem('catechismRoulette', JSON.stringify(s));
}

let state = loadState();

// Reset daily counter
if (state.lastDate !== today) {
    // Update streak
    const yesterday = new Date(Date.now() - 86400000).toISOString().slice(0, 10);
    if (state.lastDate === yesterday) {
        state.streak = (state.streak || 0) + 1;
    } else if (state.lastDate !== today) {
        state.streak = 1;
    }
    state.seenToday = 0;
    state.lastDate = today;
    state.seenSet = [];
    saveState(state);
}

// ── Daily pick (deterministic by date) ────────────────────────────────────
function getDailyIndex() {
    // Simple hash of today's date
    const s = today.replace(/-/g, '');
    let h = 0;
    for (let i = 0; i < s.length; i++) h = (h * 31 + s.charCodeAt(i)) | 0;
    return Math.abs(h) % CCC.length;
}

// ── Card logic ─────────────────────────────────────────────────────────────
function showCard(idx) {
    currentIdx = idx;
    const p = CCC[idx];

    // Front
    document.getElementById('frontNum').textContent = p.num;
    document.getElementById('frontSection').textContent = p.section;

    // Back
    document.getElementById('backNum').textContent = 'CCC ' + p.num;
    document.getElementById('backSection').textContent = p.section;
    document.getElementById('backText').textContent = p.text;

    // Fav button state
    updateFavBtn();

    // Un-flip
    if (isFlipped) {
        const card = document.getElementById('card');
        card.classList.remove('flipped');
        isFlipped = false;
    }

    // Track seen
    if (!state.seenSet.includes(idx)) {
        state.seenSet.push(idx);
        state.seenToday = state.seenSet.length;
        saveState(state);
        document.getElementById('seenCount').textContent = state.seenToday;
    }
}

function flipCard() {
    const card = document.getElementById('card');
    isFlipped = !isFlipped;
    card.classList.toggle('flipped', isFlipped);
}

function nextCard() {
    // Pick a random card, avoiding recent repeats if possible
    let next;
    const recent = state.seenSet.slice(-5);
    let attempts = 0;
    do {
        next = Math.floor(Math.random() * CCC.length);
        attempts++;
    } while (recent.includes(next) && attempts < 20);
    showCard(next);
}

// ── Favourites ─────────────────────────────────────────────────────────────
function toggleFav() {
    const p = CCC[currentIdx];
    const i = state.favs.indexOf(p.num);
    if (i === -1) {
        state.favs.push(p.num);
        state.totalSaved = (state.totalSaved || 0) + 1;
    } else {
        state.favs.splice(i, 1);
    }
    saveState(state);
    updateFavBtn();
    updateFavsPanel();
    document.getElementById('favCount').textContent = state.favs.length;
    document.getElementById('totalSaved').textContent = state.totalSaved;
}

function updateFavBtn() {
    const p = CCC[currentIdx];
    const btn = document.getElementById('favBtn');
    btn.textContent = state.favs.includes(p.num) ? '★' : '☆';
    btn.title = state.favs.includes(p.num) ? 'Remove from favourites' : 'Save to favourites';
}

function toggleFavsPanel() {
    const panel = document.getElementById('favsPanel');
    panel.classList.toggle('open');
    updateFavsPanel();
}

function updateFavsPanel() {
    const list = document.getElementById('favsList');
    if (!state.favs.length) {
        list.innerHTML = '<div class="empty-favs">No saved paragraphs yet. Tap ☆ on a card to save it.</div>';
        return;
    }
    list.innerHTML = state.favs.map(num => {
        const p = CCC.find(c => c.num === num);
        if (!p) return '';
        return `<div class="fav-item" onclick="goToFav(${p.num})">
            <div class="fi-num">CCC ${p.num}</div>
            <div class="fi-text">${p.text}</div>
        </div>`;
    }).join('');
}

function goToFav(num) {
    const idx = CCC.findIndex(p => p.num === num);
    if (idx !== -1) {
        showCard(idx);
        document.getElementById('favsPanel').classList.remove('open');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

// ── Init ───────────────────────────────────────────────────────────────────
window.onload = function() {
    const dailyIdx = getDailyIndex();
    const dailyNum = CCC[dailyIdx].num;
    document.getElementById('dailyNum').textContent = dailyNum;

    // Show daily card on load
    showCard(dailyIdx);

    // Update stats
    document.getElementById('seenCount').textContent = state.seenToday;
    document.getElementById('streakCount').textContent = state.streak;
    document.getElementById('favCount').textContent = state.favs.length;
    document.getElementById('totalSaved').textContent = state.totalSaved || 0;
};
</script>

</body>
</html>
