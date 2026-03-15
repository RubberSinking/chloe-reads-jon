<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bible Books Blitz</title>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --gold: #c9a84c;
  --deep: #1a1035;
  --parchment: #fdf6e3;
  --ink: #2c1a0e;
  --red: #8b1a1a;
  --green: #2d6a2d;
  --blue: #1a3a6b;
  --shadow: rgba(0,0,0,0.35);
}

body {
  font-family: 'Georgia', serif;
  background: var(--deep);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  background-image:
    radial-gradient(ellipse at 20% 20%, rgba(70,40,120,0.4) 0%, transparent 60%),
    radial-gradient(ellipse at 80% 80%, rgba(30,60,90,0.4) 0%, transparent 60%);
}

.container {
  max-width: 620px;
  width: 100%;
}

/* ── Decorative scroll header ── */
.scroll-header {
  text-align: center;
  margin-bottom: 24px;
}
.scroll-header .cross {
  font-size: 2em;
  color: var(--gold);
  text-shadow: 0 0 20px rgba(201,168,76,0.6);
  display: block;
  margin-bottom: 8px;
}
.scroll-header h1 {
  color: var(--gold);
  font-size: 2.1em;
  font-weight: 700;
  letter-spacing: 2px;
  text-shadow: 0 2px 8px var(--shadow);
}
.scroll-header .subtitle {
  color: rgba(201,168,76,0.7);
  font-size: 0.9em;
  font-style: italic;
  margin-top: 4px;
}

/* ── Card panel ── */
.card {
  background: var(--parchment);
  background-image:
    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  border-radius: 4px;
  box-shadow: 0 8px 32px var(--shadow), 0 0 0 3px var(--gold), inset 0 0 40px rgba(180,140,50,0.08);
  overflow: hidden;
  position: relative;
}

.card::before, .card::after {
  content: '✦';
  position: absolute;
  color: var(--gold);
  opacity: 0.3;
  font-size: 1.4em;
}
.card::before { top: 10px; left: 14px; }
.card::after  { bottom: 10px; right: 14px; }

.card-inner {
  padding: 28px 28px 24px;
}

/* ── Progress ── */
.progress-row {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 20px;
}
.progress-bar-wrap {
  flex: 1;
  height: 7px;
  background: rgba(44,26,14,0.15);
  border-radius: 4px;
  overflow: hidden;
}
.progress-bar {
  height: 100%;
  background: linear-gradient(90deg, var(--gold), #e8c96a);
  border-radius: 4px;
  transition: width 0.4s ease;
}
.progress-label {
  color: var(--ink);
  font-size: 0.8em;
  opacity: 0.6;
  white-space: nowrap;
}
.score-badge {
  background: var(--blue);
  color: #fff;
  border-radius: 20px;
  padding: 2px 12px;
  font-size: 0.8em;
  font-weight: bold;
  white-space: nowrap;
}

/* ── Testament tag ── */
.testament-tag {
  display: inline-block;
  font-size: 0.72em;
  font-weight: bold;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 2px 10px;
  border-radius: 2px;
  margin-bottom: 16px;
}
.testament-tag.ot { background: rgba(139,26,26,0.12); color: var(--red); border: 1px solid rgba(139,26,26,0.25); }
.testament-tag.nt { background: rgba(26,58,107,0.12); color: var(--blue); border: 1px solid rgba(26,58,107,0.25); }

/* ── Clues ── */
.page-count {
  font-size: 0.8em;
  color: var(--ink);
  opacity: 0.55;
  margin-bottom: 8px;
  font-style: italic;
}

.description {
  font-size: 1.08em;
  line-height: 1.7;
  color: var(--ink);
  margin-bottom: 24px;
  font-style: italic;
  border-left: 3px solid var(--gold);
  padding-left: 14px;
}

/* ── Options grid ── */
.options {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  margin-bottom: 18px;
}

@media (max-width: 420px) {
  .options { grid-template-columns: 1fr; }
}

.option-btn {
  background: #fff;
  border: 2px solid rgba(44,26,14,0.18);
  border-radius: 4px;
  padding: 11px 14px;
  color: var(--ink);
  font-family: 'Georgia', serif;
  font-size: 0.92em;
  cursor: pointer;
  text-align: left;
  transition: all 0.15s;
  position: relative;
  overflow: hidden;
}
.option-btn:hover:not(:disabled) {
  border-color: var(--gold);
  background: rgba(201,168,76,0.08);
  transform: translateY(-1px);
}
.option-btn:disabled { cursor: default; }
.option-btn.correct {
  border-color: var(--green);
  background: rgba(45,106,45,0.1);
  color: var(--green);
  font-weight: bold;
}
.option-btn.wrong {
  border-color: var(--red);
  background: rgba(139,26,26,0.08);
  color: var(--red);
  text-decoration: line-through;
}
.option-btn .letter {
  display: inline-block;
  width: 22px;
  height: 22px;
  line-height: 22px;
  text-align: center;
  border-radius: 50%;
  background: rgba(44,26,14,0.08);
  font-size: 0.8em;
  font-weight: bold;
  margin-right: 8px;
  vertical-align: middle;
  font-style: normal;
}
.option-btn.correct .letter { background: var(--green); color: #fff; }
.option-btn.wrong   .letter { background: var(--red);   color: #fff; }

/* ── Feedback ── */
.feedback {
  display: none;
  padding: 14px 16px;
  border-radius: 4px;
  font-size: 0.92em;
  line-height: 1.5;
  margin-bottom: 16px;
}
.feedback.show { display: block; }
.feedback.correct-fb {
  background: rgba(45,106,45,0.1);
  border: 1px solid rgba(45,106,45,0.3);
  color: var(--green);
}
.feedback.wrong-fb {
  background: rgba(139,26,26,0.08);
  border: 1px solid rgba(139,26,26,0.25);
  color: var(--red);
}
.feedback .fun-fact {
  margin-top: 6px;
  color: var(--ink);
  font-style: italic;
  font-size: 0.95em;
}

/* ── Next button ── */
.next-btn {
  display: none;
  width: 100%;
  background: linear-gradient(135deg, #2c4a8c, #1a3a6b);
  color: var(--gold);
  border: 2px solid var(--gold);
  border-radius: 4px;
  padding: 12px;
  font-family: 'Georgia', serif;
  font-size: 1em;
  cursor: pointer;
  letter-spacing: 1px;
  transition: all 0.2s;
}
.next-btn:hover {
  background: linear-gradient(135deg, #3a5aaa, #2a4a8c);
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
.next-btn.show { display: block; }

/* ── Start / End screens ── */
.screen {
  display: none;
  text-align: center;
  padding: 32px 28px;
}
.screen.active { display: block; }

.screen h2 {
  color: var(--ink);
  font-size: 1.6em;
  margin-bottom: 12px;
}
.screen .big-icon {
  font-size: 3em;
  margin-bottom: 16px;
  display: block;
}
.screen p {
  color: var(--ink);
  opacity: 0.75;
  font-size: 0.95em;
  line-height: 1.6;
  margin-bottom: 20px;
}
.start-btn, .restart-btn {
  background: linear-gradient(135deg, #2c4a8c, #1a3a6b);
  color: var(--gold);
  border: 2px solid var(--gold);
  border-radius: 4px;
  padding: 13px 36px;
  font-family: 'Georgia', serif;
  font-size: 1em;
  cursor: pointer;
  letter-spacing: 1px;
  transition: all 0.2s;
  display: inline-block;
  margin-top: 4px;
}
.start-btn:hover, .restart-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

.final-score {
  font-size: 3em;
  font-weight: bold;
  color: var(--gold);
  display: block;
  margin: 16px 0 8px;
  text-shadow: 0 2px 8px var(--shadow);
}
.final-label {
  color: var(--ink);
  opacity: 0.6;
  font-size: 0.9em;
  margin-bottom: 24px;
}
.verdict {
  font-size: 1.05em;
  color: var(--ink);
  font-style: italic;
  margin-bottom: 24px;
  line-height: 1.5;
}
.review-list {
  text-align: left;
  background: rgba(44,26,14,0.05);
  border-radius: 4px;
  padding: 14px;
  margin-bottom: 20px;
}
.review-list h3 {
  font-size: 0.85em;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: var(--ink);
  opacity: 0.5;
  margin-bottom: 10px;
}
.review-item {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  margin-bottom: 7px;
  font-size: 0.85em;
  color: var(--ink);
}
.review-item .ri { font-size: 0.9em; }
.review-item .ri.ok  { color: var(--green); }
.review-item .ri.no  { color: var(--red);   }
.review-item .book-name { font-weight: bold; }

.back-link {
  display: block;
  margin-top: 20px;
  color: rgba(201,168,76,0.7);
  text-decoration: none;
  font-size: 0.8em;
  letter-spacing: 1px;
  text-transform: uppercase;
}
.back-link:hover { color: var(--gold); }
</style>
</head>
<body>
<div class="container">
  <div class="scroll-header">
    <span class="cross">✝</span>
    <h1>Bible Books Blitz</h1>
    <div class="subtitle">Read the clue &mdash; name the book</div>
  </div>

  <div class="card">
    <!-- START SCREEN -->
    <div class="screen active" id="screen-start">
      <span class="big-icon">📖</span>
      <h2>73 Books. One Quiz.</h2>
      <p>You'll get a short description of a book of the Catholic Bible. Choose the right book from four options. 10 rounds, Old and New Testament both included.</p>
      <p style="font-size:0.85em; opacity:0.55;">Descriptions adapted from Jon's <em>Capsule Summaries of the Books of the Bible</em> post.</p>
      <button class="start-btn" onclick="startGame()">Open the Book ✦</button>
    </div>

    <!-- GAME SCREEN -->
    <div class="screen" id="screen-game">
      <div class="card-inner" style="padding-top:20px;">
        <div class="progress-row">
          <div class="progress-bar-wrap">
            <div class="progress-bar" id="progress-bar" style="width:0%"></div>
          </div>
          <div class="progress-label" id="progress-label">1 / 10</div>
          <div class="score-badge" id="score-badge">0 pts</div>
        </div>

        <div class="testament-tag" id="testament-tag">Old Testament</div>
        <div class="page-count" id="page-count"></div>
        <div class="description" id="description-text"></div>

        <div class="options" id="options-grid"></div>

        <div class="feedback" id="feedback-box">
          <strong id="feedback-title"></strong>
          <div class="fun-fact" id="feedback-fact"></div>
        </div>

        <button class="next-btn" id="next-btn" onclick="nextQuestion()">Next Book →</button>
      </div>
    </div>

    <!-- END SCREEN -->
    <div class="screen" id="screen-end">
      <span class="big-icon">🏆</span>
      <h2>Scroll Complete!</h2>
      <span class="final-score" id="final-score-text"></span>
      <div class="final-label">out of 10 questions</div>
      <div class="verdict" id="verdict-text"></div>
      <div class="review-list" id="review-list">
        <h3>Your answers</h3>
      </div>
      <button class="restart-btn" onclick="startGame()">Read Again ✦</button>
      <a href="index.php" class="back-link">← Back to Chloe Reads Jon</a>
    </div>
  </div>
</div>

<script>
const ALL_BOOKS = [
  // OLD TESTAMENT
  { name:"Genesis", testament:"OT", pages:39, desc:"It contains stories from the creation of the world to the descent of the children of Israel into Egypt, including Adam and Eve, Cain and Abel, Noah's Ark, the Tower of Babel, and the patriarchs Abraham, Isaac, and Jacob.", fact:"Genesis is the longest book in the Pentateuch (the first five books)." },
  { name:"Exodus", testament:"OT", pages:33, desc:"Moses leads the Hebrews out of Egypt and through the wilderness to Mount Sinai, where God gives the law. It includes the Ten Plagues, the crossing of the Red Sea, and the giving of the Ten Commandments.", fact:"The word 'Exodus' comes from the Greek for 'going out' or 'departure.'" },
  { name:"Leviticus", testament:"OT", pages:23, desc:"A book of laws and priestly rituals for the people of Israel — sacrifices, purity codes, feast days, and the holiness code. Often considered the driest read in the Bible, but central to understanding Jewish worship.", fact:"Leviticus contains the famous command: 'Love your neighbour as yourself' (19:18)." },
  { name:"Numbers", testament:"OT", pages:33, desc:"The counting of the people of Israel at Sinai and their forty-year journey through the wilderness toward the Promised Land, including the sending of spies into Canaan.", fact:"Two censuses are recorded — hence the name 'Numbers.'" },
  { name:"Deuteronomy", testament:"OT", pages:30, desc:"Three sermons by Moses reviewing the forty years of wilderness wandering, restating the law, and urging Israel to remain faithful to God before they enter the Promised Land without him.", fact:"Deuteronomy means 'second law' in Greek — it repeats and expands the law of Moses." },
  { name:"Joshua", testament:"OT", pages:19, desc:"The conquest and settlement of the Promised Land under the military leader Joshua, including the famous battle of Jericho, where the walls came tumbling down.", fact:"Joshua is considered the first of the 'Historical Books' in the Catholic Old Testament." },
  { name:"Judges", testament:"OT", pages:20, desc:"The history of Israel's judges — warrior-leaders like Gideon, Deborah, and Samson — who rescued Israel from enemies during a cycle of sin, suffering, and salvation, ending in chaos.", fact:"Samson's famous weapon? The jawbone of a donkey." },
  { name:"Ruth", testament:"OT", pages:3, desc:"A beautiful short story of loyalty and love. Ruth, a Moabite widow, refuses to leave her mother-in-law Naomi, declaring: 'Where you go, I will go.' She becomes an ancestor of King David.", fact:"Ruth is one of only two books in the Bible named after a woman (the other is Esther)." },
  { name:"1 Samuel", testament:"OT", pages:25, desc:"The story of Samuel the prophet, King Saul (Israel's first king), and the rise of young David — shepherd, giant-slayer, and the man after God's own heart.", fact:"The famous battle where David defeats Goliath is in 1 Samuel 17." },
  { name:"2 Samuel", testament:"OT", pages:22, desc:"The reign of King David — his victories, his sin with Bathsheba, his son Absalom's rebellion, and his great psalms of praise and repentance.", fact:"David is described as 'a man after God's own heart' (Acts 13:22)." },
  { name:"1 Kings", testament:"OT", pages:25, desc:"Solomon builds the Temple, then falls into idolatry. The kingdom splits in two. Elijah the prophet battles the prophets of Baal on Mount Carmel.", fact:"Solomon's Temple took seven years to build and was considered one of the ancient world's wonders." },
  { name:"Tobit", testament:"OT", pages:9, desc:"Tobit is a righteous Israelite exiled in Nineveh, blinded by bird droppings, who sends his son Tobias on a journey guided by the Archangel Raphael — resulting in healing, marriage, and faith rewarded.", fact:"This book is in the Catholic and Orthodox Bible but not the Protestant Bible." },
  { name:"Judith", testament:"OT", pages:12, desc:"A beautiful, courageous widow named Judith gains the trust of the Assyrian general Holofernes, then decapitates him in his tent, saving Israel from invasion.", fact:"Judith's story inspired many famous paintings, including works by Caravaggio and Artemisia Gentileschi." },
  { name:"Esther", testament:"OT", pages:9, desc:"A Jewish queen of Persia uses her courage and cleverness to thwart a plot to exterminate all the Jews in the empire, risking her own life by approaching the king uninvited.", fact:"The Jewish festival of Purim celebrates Esther's victory." },
  { name:"Job", testament:"OT", pages:26, desc:"A righteous man named Job loses everything — his wealth, health, and children — as a test of faith. He argues passionately with God about suffering, and God ultimately restores him. One of the Bible's great wisdom books.", fact:"The book of Job is considered a masterpiece of world literature, exploring why good people suffer." },
  { name:"Psalms", testament:"OT", pages:68, desc:"150 sacred songs and poems — hymns of praise, laments, thanksgiving, and wisdom — used in Jewish and Christian worship for thousands of years. Many are attributed to King David.", fact:"Psalm 119, with 176 verses, is the longest chapter in the entire Bible." },
  { name:"Proverbs", testament:"OT", pages:22, desc:"A collection of wise sayings and teachings on how to live well, attributed to King Solomon: fear of God, hard work, honest speech, and the importance of wisdom as more precious than gold.", fact:"Proverbs opens with the famous line: 'The fear of the Lord is the beginning of wisdom.'" },
  { name:"Ecclesiastes", testament:"OT", pages:6, desc:"A philosopher reflects on the meaning of life and finds much of it 'vanity of vanities' — passing and empty. Yet he concludes: fear God, keep his commandments, enjoy the life you have.", fact:"The famous verse 'To everything there is a season' (Eccl 3:1) inspired the song 'Turn! Turn! Turn!' by The Byrds." },
  { name:"Song of Solomon", testament:"OT", pages:5, desc:"A collection of lyric love poems between a man and a woman — some of the most passionate poetry in the Bible. Interpreted as an allegory of God's love for Israel, or Christ's love for the Church.", fact:"'Song of Solomon' is also called 'Song of Songs' — a Hebrew superlative meaning 'the greatest song.'" },
  { name:"Isaiah", testament:"OT", pages:52, desc:"Chapters 1–39 prophesy doom on sinful Judah; chapters 40–66 speak of comfort, restoration, and a mysterious Suffering Servant — passages Christians see fulfilled in Jesus.", fact:"Isaiah is the most-quoted Old Testament prophet in the New Testament." },
  { name:"Jeremiah", testament:"OT", pages:50, desc:"The 'weeping prophet' lived through the destruction of Jerusalem and Solomon's Temple by Babylon. He warned Israel for decades, was ignored, imprisoned, and thrown in a cistern, but kept prophesying.", fact:"Jeremiah dictated his prophecies to his scribe Baruch — making it one of the Bible's earliest documented author-scribe partnerships." },
  { name:"Daniel", testament:"OT", pages:18, desc:"Court stories of Daniel and his friends — thrown into lions' dens and fiery furnaces for their faith — alongside dramatic visions of four world empires and the coming of 'one like a Son of Man.'", fact:"'The handwriting on the wall' comes from Daniel 5, when mysterious fingers write Mene, Mene, Tekel, Parsin on a palace wall." },
  { name:"Jonah", testament:"OT", pages:2, desc:"A reluctant prophet swallowed by a great fish after fleeing his mission. Spat out on shore, he finally preaches to Nineveh — and all 120,000 of them repent. Arguably the most effective prophet in the Bible.", fact:"Jonah is only 4 chapters long — the shortest of the prophetic books." },
  { name:"1 Maccabees", testament:"OT", pages:25, desc:"The Greek ruler Antiochus IV tries to wipe out Jewish religion, leading to a heroic revolt by Judas Maccabeus and his brothers — and the miracle of Hanukkah, though it is not named here.", fact:"1 Maccabees is in the Catholic Bible but not in the Protestant Bible." },
  // NEW TESTAMENT
  { name:"Matthew", testament:"NT", pages:29, desc:"The most Jewish of the four Gospels, presenting Jesus as the new Moses and fulfillment of Old Testament prophecy. Contains the Sermon on the Mount and the Great Commission.", fact:"Matthew is traditionally the first book of the New Testament and was the most-used Gospel in the early Church." },
  { name:"Mark", testament:"NT", pages:18, desc:"The shortest, most action-packed Gospel, with no birth narrative. Jesus is always on the move, healing, casting out demons, and heading urgently toward Jerusalem and the cross.", fact:"Mark uses the word 'immediately' over 40 times — everything happens right away." },
  { name:"Luke", testament:"NT", pages:30, desc:"The most literary Gospel, written by the physician Luke. Only here do we find the parables of the Prodigal Son and the Good Samaritan, and the full Christmas story with shepherds and angels.", fact:"Luke wrote a sequel: the Acts of the Apostles, making it the longest work in the New Testament by a single author." },
  { name:"John", testament:"NT", pages:22, desc:"The most theological Gospel, beginning not with Jesus's birth but with 'In the beginning was the Word.' Seven 'I am' statements, seven signs, and the beloved Last Supper discourses.", fact:"'Jesus wept' (John 11:35) is famously the shortest verse in the Bible." },
  { name:"Acts of the Apostles", testament:"NT", pages:26, desc:"The story of the early Church after the Resurrection: Pentecost, Peter's preaching, Stephen's martyrdom, and Paul's three missionary journeys across the Mediterranean world.", fact:"Acts ends abruptly — Paul is under house arrest in Rome, and we never learn his fate from Luke's account." },
  { name:"Romans", testament:"NT", pages:12, desc:"Paul's theological masterpiece: humanity is lost in sin, saved by faith in Christ alone, and called to live as one body. The most influential letter ever written.", fact:"Martin Luther's reading of Romans 1:17 — 'the just shall live by faith' — sparked the Protestant Reformation." },
  { name:"1 Corinthians", testament:"NT", pages:22, desc:"Paul corrects a fractious Greek church on divisions, morality, and worship — and gives us the great 'Love chapter' (ch. 13): 'Love is patient, love is kind...' as well as teaching on the Resurrection.", fact:"Chapter 13 ('And now these three remain: faith, hope and love') is one of the most-read passages at weddings worldwide." },
  { name:"Galatians", testament:"NT", pages:4, desc:"Paul's most passionate letter: a fierce defense of salvation by faith, not by following the Jewish law. He writes: 'There is neither Jew nor Gentile, slave nor free, male nor female — all are one in Christ Jesus.'", fact:"Galatians was likely the first letter Paul ever wrote — and the most urgent." },
  { name:"Ephesians", testament:"NT", pages:4, desc:"A soaring letter about the mystery of Christ: the Church as the Body of Christ, marriage as a reflection of Christ's love for the Church, and the famous 'full armor of God.'", fact:"The 'armor of God' passage (Eph 6:10-18) lists six pieces of spiritual equipment, from the belt of truth to the sword of the Spirit." },
  { name:"Philippians", testament:"NT", pages:3, desc:"Paul's most joyful letter, written from prison: 'Rejoice in the Lord always!' He thanks the Philippians for their faithful support and urges them to 'have the mind of Christ' and seek what is true and noble.", fact:"Philippians 4:13 — 'I can do all things through Christ who strengthens me' — is one of the most quoted Bible verses worldwide." },
  { name:"Revelation", testament:"NT", pages:13, desc:"The only fully apocalyptic book in the New Testament: visions of seven seals, seven trumpets, a great red dragon, the woman clothed with the sun, the beast 666, and the New Jerusalem descending from heaven.", fact:"The number 666 appears in Revelation 13:18 — many scholars think it refers to the Roman emperor Nero." },
  { name:"James", testament:"NT", pages:3, desc:"A practical, earthy letter: 'Faith without works is dead.' Control your tongue, care for the poor, be slow to anger. The letter that James describes as 'pure religion' is caring for widows and orphans.", fact:"Martin Luther famously called James 'an epistle of straw' because it seemed to challenge his 'faith alone' theology." },
  { name:"Hebrews", testament:"NT", pages:9, desc:"A sophisticated theological argument: Jesus is the great High Priest, and his sacrifice on the cross replaces all the sacrifices of the Old Testament. A letter written to Jewish Christians tempted to return to Judaism.", fact:"No one knows who wrote Hebrews — it's one of the Bible's great mysteries. Candidates include Paul, Apollos, Priscilla, and Barnabas." },
];

const TOTAL_QUESTIONS = 10;
let questions = [];
let current = 0;
let score = 0;
let answered = false;
let history = [];

function shuffle(arr) {
  const a = [...arr];
  for (let i = a.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [a[i], a[j]] = [a[j], a[i]];
  }
  return a;
}

function buildQuestions() {
  const shuffled = shuffle(ALL_BOOKS);
  const selected = shuffled.slice(0, TOTAL_QUESTIONS);
  return selected.map(correct => {
    const others = shuffle(ALL_BOOKS.filter(b => b.name !== correct.name)).slice(0, 3);
    const choices = shuffle([correct, ...others]);
    return { correct, choices };
  });
}

function startGame() {
  questions = buildQuestions();
  current = 0;
  score = 0;
  answered = false;
  history = [];
  showScreen('screen-game');
  renderQuestion();
}

function showScreen(id) {
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

function renderQuestion() {
  answered = false;
  const q = questions[current];
  const pct = (current / TOTAL_QUESTIONS) * 100;

  document.getElementById('progress-bar').style.width = pct + '%';
  document.getElementById('progress-label').textContent = (current + 1) + ' / ' + TOTAL_QUESTIONS;
  document.getElementById('score-badge').textContent = score + ' pts';

  const tag = document.getElementById('testament-tag');
  tag.textContent = q.correct.testament === 'OT' ? 'Old Testament' : 'New Testament';
  tag.className = 'testament-tag ' + (q.correct.testament === 'OT' ? 'ot' : 'nt');

  document.getElementById('page-count').textContent =
    'About ' + q.correct.pages + ' pages in a standard Bible';
  document.getElementById('description-text').textContent = q.correct.desc;

  const letters = ['A', 'B', 'C', 'D'];
  const grid = document.getElementById('options-grid');
  grid.innerHTML = '';
  q.choices.forEach((choice, i) => {
    const btn = document.createElement('button');
    btn.className = 'option-btn';
    btn.innerHTML = `<span class="letter">${letters[i]}</span>${choice.name}`;
    btn.onclick = () => checkAnswer(btn, choice.name === q.correct.name, i);
    grid.appendChild(btn);
  });

  const fb = document.getElementById('feedback-box');
  fb.className = 'feedback';
  document.getElementById('next-btn').className = 'next-btn';
}

function checkAnswer(btn, isCorrect, idx) {
  if (answered) return;
  answered = true;

  const q = questions[current];
  const allBtns = document.querySelectorAll('.option-btn');

  allBtns.forEach((b, i) => {
    b.disabled = true;
    if (q.choices[i].name === q.correct.name) b.classList.add('correct');
  });

  if (!isCorrect) {
    btn.classList.add('wrong');
  } else {
    score++;
  }

  document.getElementById('score-badge').textContent = score + ' pts';

  const fb = document.getElementById('feedback-box');
  const title = document.getElementById('feedback-title');
  const fact = document.getElementById('feedback-fact');

  if (isCorrect) {
    fb.className = 'feedback show correct-fb';
    title.textContent = '✓ Correct! — ' + q.correct.name;
  } else {
    fb.className = 'feedback show wrong-fb';
    title.textContent = '✗ The answer was ' + q.correct.name;
  }
  fact.textContent = q.correct.fact;

  history.push({ book: q.correct.name, correct: isCorrect });

  const nextBtn = document.getElementById('next-btn');
  nextBtn.className = 'next-btn show';
  nextBtn.textContent = current < TOTAL_QUESTIONS - 1 ? 'Next Book →' : 'See Results ✦';
}

function nextQuestion() {
  current++;
  if (current >= TOTAL_QUESTIONS) {
    showResults();
  } else {
    renderQuestion();
  }
}

function showResults() {
  showScreen('screen-end');
  document.getElementById('final-score-text').textContent = score + ' / ' + TOTAL_QUESTIONS;

  const verdicts = [
    [0,3,  "Keep reading! Even St. Jerome didn't know it all on the first day. The Word awaits. 📜"],
    [4,5,  "A good start, pilgrim. The desert fathers studied for decades — you're on the right path. ✝"],
    [6,7,  "Solid knowledge! You know your scriptures. A fine companion for any Bible study group. 📖"],
    [8,9,  "Impressive! You carry the lamp of scripture with care. Blessed are those who read and hear. 🕯"],
    [10,10,"Perfect score! A walking concordance. St. Jerome himself would be impressed. 🏆"],
  ];
  const v = verdicts.find(([lo, hi]) => score >= lo && score <= hi);
  document.getElementById('verdict-text').textContent = v ? v[2] : '';

  const list = document.getElementById('review-list');
  list.innerHTML = '<h3>Your answers</h3>';
  history.forEach(h => {
    const item = document.createElement('div');
    item.className = 'review-item';
    item.innerHTML = `<span class="ri ${h.correct ? 'ok' : 'no'}">${h.correct ? '✓' : '✗'}</span>
      <span class="book-name">${h.book}</span>`;
    list.appendChild(item);
  });
}

// Keyboard shortcuts
document.addEventListener('keydown', e => {
  if (!document.getElementById('screen-game').classList.contains('active')) return;
  if (!answered) {
    const map = { 'a': 0, 'b': 1, 'c': 2, 'd': 3, '1': 0, '2': 1, '3': 2, '4': 3 };
    const k = e.key.toLowerCase();
    if (k in map) {
      const btns = document.querySelectorAll('.option-btn');
      if (btns[map[k]]) btns[map[k]].click();
    }
  } else if (e.key === 'Enter' || e.key === ' ') {
    const nb = document.getElementById('next-btn');
    if (nb.classList.contains('show')) nb.click();
  }
});
</script>
</body>
</html>
