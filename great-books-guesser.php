<?php
// Great Books Guesser – inspired by Jon's 2009 capsule summaries post
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Great Books Guesser</title>
<style>
  :root {
    --parchment: #fdf6e3;
    --ink: #2b2007;
    --ink-light: #5a4a1e;
    --gold: #b8860b;
    --gold-bright: #d4a017;
    --red: #8b1a1a;
    --green: #1a5c1a;
    --border: #c8a96e;
    --shadow: rgba(43, 32, 7, 0.18);
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  html, body {
    min-height: 100%;
    background: #2b1a05;
    background-image: repeating-linear-gradient(
      45deg,
      transparent,
      transparent 60px,
      rgba(255,255,255,0.015) 60px,
      rgba(255,255,255,0.015) 120px
    );
    font-family: Georgia, 'Times New Roman', serif;
    color: var(--ink);
  }
  #app {
    max-width: 680px;
    margin: 0 auto;
    padding: 24px 16px 60px;
    min-height: 100vh;
  }
  .card {
    background: var(--parchment);
    border-radius: 4px;
    box-shadow: 0 4px 24px var(--shadow), 0 1px 4px rgba(0,0,0,0.3);
    border: 1px solid var(--border);
    overflow: hidden;
  }
  .card-header {
    background: linear-gradient(to bottom, #3d2805, #2b1a05);
    padding: 20px 24px;
    text-align: center;
    border-bottom: 3px solid var(--gold);
    position: relative;
  }
  .card-header h1 {
    color: var(--gold-bright);
    font-size: 1.7em;
    letter-spacing: 1px;
    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
    margin-bottom: 4px;
  }
  .card-header .subtitle {
    color: #c8a96e;
    font-style: italic;
    font-size: 0.88em;
  }
  .card-body { padding: 24px; }

  /* Progress */
  .progress-bar-wrap {
    height: 6px;
    background: #e0d4b0;
    border-radius: 3px;
    margin-bottom: 20px;
    overflow: hidden;
  }
  .progress-bar-fill {
    height: 100%;
    background: linear-gradient(to right, var(--gold), var(--gold-bright));
    border-radius: 3px;
    transition: width 0.4s ease;
  }
  .progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.8em;
    color: var(--ink-light);
    margin-bottom: 8px;
  }
  .score-badge {
    font-weight: bold;
    color: var(--gold);
  }

  /* Question */
  .question-label {
    font-size: 0.75em;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--gold);
    margin-bottom: 10px;
  }
  .era-badge {
    display: inline-block;
    background: var(--gold);
    color: #fff;
    font-size: 0.72em;
    font-style: normal;
    padding: 2px 9px;
    border-radius: 20px;
    margin-left: 8px;
    vertical-align: middle;
    letter-spacing: 0.5px;
  }
  .description-box {
    background: #f5edd5;
    border-left: 4px solid var(--gold);
    border-radius: 2px;
    padding: 16px 18px;
    font-size: 1.05em;
    line-height: 1.65;
    color: var(--ink);
    margin-bottom: 22px;
    font-style: italic;
    position: relative;
  }
  .description-box::before {
    content: '\201C';
    font-size: 3em;
    color: var(--gold);
    opacity: 0.35;
    position: absolute;
    top: -4px;
    left: 8px;
    line-height: 1;
  }
  .ask-label {
    font-size: 0.88em;
    color: var(--ink-light);
    margin-bottom: 14px;
    font-style: italic;
  }

  /* Options */
  .options { display: flex; flex-direction: column; gap: 10px; }
  .option-btn {
    background: #fff8e8;
    border: 2px solid var(--border);
    border-radius: 4px;
    padding: 13px 16px;
    text-align: left;
    cursor: pointer;
    font-size: 0.97em;
    color: var(--ink);
    font-family: Georgia, serif;
    transition: border-color 0.15s, background 0.15s, transform 0.1s;
    display: flex;
    align-items: center;
    gap: 12px;
    line-height: 1.4;
  }
  .option-btn:hover:not(:disabled) {
    border-color: var(--gold);
    background: #fef4d0;
    transform: translateX(3px);
  }
  .option-btn:active:not(:disabled) {
    transform: translateX(1px);
  }
  .option-letter {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--border);
    color: #fff;
    font-size: 0.85em;
    font-weight: bold;
    flex-shrink: 0;
    transition: background 0.15s;
  }
  .option-btn:hover:not(:disabled) .option-letter {
    background: var(--gold);
  }
  .option-btn.correct {
    border-color: var(--green);
    background: #e8f5e8;
  }
  .option-btn.correct .option-letter {
    background: var(--green);
  }
  .option-btn.wrong {
    border-color: var(--red);
    background: #fae8e8;
    opacity: 0.75;
  }
  .option-btn.wrong .option-letter {
    background: var(--red);
  }
  .option-btn:disabled { cursor: default; }

  /* Feedback */
  .feedback {
    margin-top: 18px;
    padding: 14px 16px;
    border-radius: 4px;
    font-size: 0.93em;
    line-height: 1.55;
    display: none;
  }
  .feedback.show { display: block; }
  .feedback.correct {
    background: #e8f5e8;
    border: 1px solid var(--green);
    color: var(--green);
  }
  .feedback.wrong {
    background: #fae8e8;
    border: 1px solid var(--red);
    color: var(--red);
  }
  .feedback .answer-title {
    font-weight: bold;
    font-size: 1.05em;
  }
  .feedback .fun-fact {
    margin-top: 6px;
    color: var(--ink-light);
    font-style: italic;
  }
  .next-btn {
    display: block;
    width: 100%;
    margin-top: 18px;
    padding: 14px;
    background: linear-gradient(to bottom, #3d2805, #2b1a05);
    color: var(--gold-bright);
    border: 2px solid var(--gold);
    border-radius: 4px;
    font-size: 1em;
    font-family: Georgia, serif;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: opacity 0.15s;
  }
  .next-btn:hover { opacity: 0.88; }

  /* Results */
  .results { text-align: center; }
  .results .score-display {
    font-size: 3.5em;
    font-weight: bold;
    color: var(--gold);
    margin: 10px 0 4px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }
  .results .score-denom {
    font-size: 1.1em;
    color: var(--ink-light);
    margin-bottom: 16px;
  }
  .results .verdict {
    font-size: 1.15em;
    color: var(--ink);
    margin-bottom: 20px;
    line-height: 1.5;
  }
  .results .review-list {
    text-align: left;
    list-style: none;
    margin: 0 0 20px;
    border: 1px solid var(--border);
    border-radius: 4px;
    overflow: hidden;
  }
  .results .review-list li {
    padding: 10px 14px;
    font-size: 0.88em;
    border-bottom: 1px solid #e8d8a8;
    display: flex;
    align-items: center;
    gap: 10px;
    line-height: 1.4;
  }
  .results .review-list li:last-child { border-bottom: none; }
  .results .review-list li .ri { flex-shrink: 0; font-size: 1.1em; }
  .results .review-list li .answer-name {
    font-weight: bold;
    color: var(--ink);
  }
  .results .review-list li .your-answer {
    color: var(--red);
    font-style: italic;
    font-size: 0.9em;
  }
  .restart-btn {
    display: inline-block;
    padding: 13px 32px;
    background: linear-gradient(to bottom, #3d2805, #2b1a05);
    color: var(--gold-bright);
    border: 2px solid var(--gold);
    border-radius: 4px;
    font-size: 1em;
    font-family: Georgia, serif;
    cursor: pointer;
    letter-spacing: 0.5px;
    transition: opacity 0.15s;
  }
  .restart-btn:hover { opacity: 0.88; }

  /* Start screen */
  .start-screen { text-align: center; }
  .start-screen .tome-icon { font-size: 3.5em; margin-bottom: 12px; }
  .start-screen h2 {
    font-size: 1.3em;
    color: var(--ink);
    margin-bottom: 12px;
    line-height: 1.4;
  }
  .start-screen p {
    color: var(--ink-light);
    font-size: 0.95em;
    line-height: 1.6;
    margin-bottom: 20px;
  }
  .start-btn {
    display: inline-block;
    padding: 14px 36px;
    background: linear-gradient(to bottom, #3d2805, #2b1a05);
    color: var(--gold-bright);
    border: 2px solid var(--gold);
    border-radius: 4px;
    font-size: 1.1em;
    font-family: Georgia, serif;
    cursor: pointer;
    letter-spacing: 1px;
    transition: opacity 0.15s;
  }
  .start-btn:hover { opacity: 0.88; }
  .divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 24px 0;
  }
  .footer {
    text-align: center;
    margin-top: 16px;
    font-size: 0.78em;
    color: #c8a96e;
    font-style: italic;
  }
  .footer a { color: #c8a96e; }
</style>
</head>
<body>
<div id="app">
  <div class="card">
    <div class="card-header">
      <h1>📜 Great Books Guesser</h1>
      <div class="subtitle">Read the description. Name the book.</div>
    </div>
    <div class="card-body" id="card-body">
      <!-- JS renders here -->
    </div>
  </div>
  <div class="footer">
    Inspired by Jon's <a href="https://www.jona.ca/2009/03/capsule-summaries-of-great-books-of.html" target="_blank">capsule summaries of the Great Books of the Western World</a> (2009)<br>
    Built by Chloe · <a href="index.php">← back to Chloe Reads Jon</a>
  </div>
</div>

<script>
const BOOKS = [
  {
    title: "The Iliad",
    author: "Homer",
    era: "Ancient Greece",
    desc: "This poem concerns events during the ninth year of a great siege, centering on a Greek warrior's furious anger toward his king — an anger that proves disastrous for the entire Greek army.",
    fact: "Homer's Iliad is one of the oldest works of Western literature, composed around the 8th century BC.",
    distractors: ["The Odyssey", "The Aeneid", "The Oresteia"]
  },
  {
    title: "The Odyssey",
    author: "Homer",
    era: "Ancient Greece",
    desc: "A hero's ten-year journey home after a decade-long war. In his absence, his wife Penelope fends off a crowd of presumptuous suitors who assume her husband is dead.",
    fact: "Odysseus's name gives us the word 'odyssey' — meaning any long, wandering journey.",
    distractors: ["The Aeneid", "The Iliad", "The Argonautica"]
  },
  {
    title: "Antigone",
    author: "Sophocles",
    era: "Ancient Greece",
    desc: "After two brothers die on opposing sides of a civil war, the new ruler forbids burial of one of them. Their sister defiantly buries him anyway — knowing the penalty is death.",
    fact: "Antigone has inspired countless political interpretations as a story of individual conscience vs. state authority.",
    distractors: ["Medea", "Electra", "The Suppliants"]
  },
  {
    title: "Medea",
    author: "Euripides",
    era: "Ancient Greece",
    desc: "A woman's struggle against the world turns to revenge when her husband betrays her for a princess. The plot largely centers on that revenge.",
    fact: "Medea was controversial in its day for its sympathetic portrayal of a woman who takes violent vengeance.",
    distractors: ["Antigone", "Electra", "Hecuba"]
  },
  {
    title: "Lysistrata",
    author: "Aristophanes",
    era: "Ancient Greece",
    desc: "One woman's extraordinary plan to end a war: convince the women of Greece to withhold intimacy from their husbands until the men negotiate peace.",
    fact: "'Lysistrata' means 'she who disbands armies' in Greek.",
    distractors: ["The Clouds", "The Birds", "Thesmophoriazusae"]
  },
  {
    title: "The Clouds",
    author: "Aristophanes",
    era: "Ancient Greece",
    desc: "A comedy that lampoons sophists and the intellectual trends of fifth-century Athens. Many find it a funny, irreverent satire of pretentious academia.",
    fact: "Aristophanes' caricature of Socrates in this play may have contributed to public hostility toward the philosopher.",
    distractors: ["The Wasps", "The Birds", "The Frogs"]
  },
  {
    title: "The Republic",
    author: "Plato",
    era: "Ancient Greece",
    desc: "Dialogues that examine the meaning of justice and whether the just man is happier than the unjust. Proposes a society ruled by philosopher-kings and discusses the immortality of the soul.",
    fact: "Whitehead famously said that all of Western philosophy is but 'footnotes to Plato.'",
    distractors: ["The Laws", "Nicomachean Ethics", "The Politics"]
  },
  {
    title: "The Symposium",
    author: "Plato",
    era: "Ancient Greece",
    desc: "A group of Athenian men recline at a wine-drinking gathering and take turns giving speeches — some satirical, some serious — all on the subject of Love.",
    fact: "The Symposium contains the myth of the 'other half' — humans were once double creatures split by Zeus, ever since seeking their missing half.",
    distractors: ["The Republic", "Phaedrus", "The Apology"]
  },
  {
    title: "The Apology",
    author: "Plato",
    era: "Ancient Greece",
    desc: "Plato's version of Socrates's speech in his own defence — against charges of corrupting the young, refusing to worship the gods, and creating new deities.",
    fact: "Socrates was found guilty and condemned to death by drinking hemlock in 399 BC.",
    distractors: ["The Republic", "Crito", "Protagoras"]
  },
  {
    title: "Critias",
    author: "Plato",
    era: "Ancient Greece",
    desc: "Contains the famous story of the mighty island kingdom of Atlantis and its attempt to conquer Athens — which ultimately failed due to the ordered society of the Athenians.",
    fact: "Plato is the only original source for the Atlantis legend; no earlier accounts exist.",
    distractors: ["Timaeus", "The Republic", "The Laws"]
  },
  {
    title: "Nicomachean Ethics",
    author: "Aristotle",
    era: "Ancient Greece",
    desc: "On virtue and moral character, based on notes from lectures at the Lyceum. Proposes that human flourishing (eudaimonia) is the highest good.",
    fact: "Named after Aristotle's son Nicomachus, who either edited or dedicated the work.",
    distractors: ["The Republic", "Eudemian Ethics", "The Politics"]
  },
  {
    title: "The Poetics",
    author: "Aristotle",
    era: "Ancient Greece",
    desc: "An account of what the author calls 'poetry' — including lyric, epic, and drama. Its analysis of tragedy remains the cornerstone of literary criticism 2,400 years later.",
    fact: "The Poetics introduces the concept of 'catharsis' — the emotional purging experienced through tragedy.",
    distractors: ["The Rhetoric", "On the Soul", "The Republic"]
  },
  {
    title: "The Sand-Reckoner",
    author: "Archimedes",
    era: "Ancient Greece",
    desc: "In this short work, a mathematician sets out to determine an upper bound for the number of grains of sand that could fit in the universe — and invents a new number system to do it.",
    fact: "Archimedes estimated the universe was about 2 light-years in diameter — astonishingly close given his era.",
    distractors: ["On the Sphere and Cylinder", "On Spirals", "Measurement of a Circle"]
  },
  {
    title: "The Meditations",
    author: "Marcus Aurelius",
    era: "Roman Empire",
    desc: "Personal writings by a Roman emperor — written in Greek, never meant for publication — setting forth his ideas on Stoic philosophy as a source of self-guidance.",
    fact: "Marcus Aurelius wrote the Meditations while on military campaigns, as a private diary of self-improvement.",
    distractors: ["The Discourses", "The Enchiridion", "The City of God"]
  },
  {
    title: "The Aeneid",
    author: "Virgil",
    era: "Roman Empire",
    desc: "A Latin epic following Aeneas, a Trojan prince, as he wanders after the fall of Troy and eventually settles in Italy — becoming the legendary ancestor of the Romans.",
    fact: "Virgil died before he could finish the Aeneid. He reportedly wanted it destroyed, but Augustus saved it.",
    distractors: ["The Iliad", "The Odyssey", "The Georgics"]
  },
  {
    title: "The Confessions",
    author: "Augustine of Hippo",
    era: "Late Antiquity",
    desc: "Often called the first Western autobiography. Outlines the author's sinful youth and his conversion to Christianity — written as an extended prayer addressed to God.",
    fact: "Augustine's famous line: 'Our heart is restless until it finds its rest in Thee.'",
    distractors: ["The City of God", "The Imitation of Christ", "The Rule of St. Benedict"]
  },
  {
    title: "The Divine Comedy",
    author: "Dante Alighieri",
    era: "Medieval",
    desc: "An allegorical journey through Hell, Purgatory, and Paradise — widely considered the central epic poem of Italian literature and one of the greatest works of world literature.",
    fact: "Dante's guide through Hell and Purgatory is the poet Virgil; his guide through Paradise is Beatrice, his idealized love.",
    distractors: ["Paradise Lost", "The Canterbury Tales", "Purgatorio"]
  },
  {
    title: "The Canterbury Tales",
    author: "Geoffrey Chaucer",
    era: "Medieval",
    desc: "A collection of stories told by pilgrims traveling from London to visit the shrine of Saint Thomas Becket — ranging from pious to bawdy, from romance to satire.",
    fact: "Chaucer's work helped establish the legitimacy of vernacular English as a literary language.",
    distractors: ["Troilus and Criseyde", "The Divine Comedy", "The Decameron"]
  },
  {
    title: "The Prince",
    author: "Niccolò Machiavelli",
    era: "Renaissance",
    desc: "A guide to acquiring, perpetuating, and using political power — offering ruthlessly practical advice on how a ruler might gain and keep a kingdom.",
    fact: "'Machiavellian' has come to mean cunning and unscrupulous — a testament to the book's controversial legacy.",
    distractors: ["Leviathan", "The Social Contract", "The Federalist Papers"]
  },
  {
    title: "Don Quixote",
    author: "Miguel de Cervantes",
    era: "Renaissance",
    desc: "A retired country gentleman becomes obsessed with books of chivalry and believes every word true. He loses his grip on reality, imagining himself a knight-errant.",
    fact: "Often called the first modern novel. The phrase 'tilting at windmills' comes from this book.",
    distractors: ["Gargantua and Pantagruel", "Tom Jones", "Tristram Shandy"]
  },
  {
    title: "Paradise Lost",
    author: "John Milton",
    era: "17th Century",
    desc: "An epic poem in blank verse retelling the Fall of Man — the temptation of Adam and Eve by Satan and their expulsion from Eden. Its stated purpose: to 'justify the ways of God to men.'",
    fact: "Milton wrote Paradise Lost after going completely blind, dictating it to his daughters.",
    distractors: ["The Divine Comedy", "Samson Agonistes", "The Faerie Queene"]
  },
  {
    title: "Leviathan",
    author: "Thomas Hobbes",
    era: "17th Century",
    desc: "A treatise on the structure of society and legitimate government — one of the earliest and most influential examples of social contract theory.",
    fact: "Hobbes argued that life without government is 'solitary, poor, nasty, brutish, and short.'",
    distractors: ["The Prince", "The Social Contract", "Discourse on the Method"]
  },
  {
    title: "Discourse on the Method",
    author: "René Descartes",
    era: "17th Century",
    desc: "A philosophical treatise best known as the source of the famous quotation: 'I think, therefore I am.' The author doubts everything to find what can be known for certain.",
    fact: "Descartes wrote the Discourse in French (not Latin) to make it accessible to ordinary readers.",
    distractors: ["Meditations on First Philosophy", "Novum Organum", "An Essay Concerning Human Understanding"]
  },
  {
    title: "Pensées",
    author: "Blaise Pascal",
    era: "17th Century",
    desc: "A posthumously published collection of fragments — a defense of the Christian religion. Contains 'Pascal's Wager': even without certainty, belief in God is the rational bet.",
    fact: "Pascal died at 39. The Pensées were found as thousands of loose scraps of paper after his death.",
    distractors: ["The Provincial Letters", "The Confessions", "Fear and Trembling"]
  },
  {
    title: "Mathematical Principles of Natural Philosophy",
    author: "Isaac Newton",
    era: "17th Century",
    desc: "Contains Newton's three laws of motion forming the foundation of classical mechanics, as well as his law of universal gravitation.",
    fact: "Einstein's general relativity replaced Newtonian gravity — but Newton's laws still guide spacecraft navigation.",
    distractors: ["Dialogues Concerning Two New Sciences", "Epitome of Copernican Astronomy", "Optics"]
  },
  {
    title: "The Wealth of Nations",
    author: "Adam Smith",
    era: "18th Century",
    desc: "A landmark work in economics, advocating a free market economy as more productive and beneficial to society — credited with characterizing economic mechanisms that survive to this day.",
    fact: "Adam Smith also wrote The Theory of Moral Sentiments, which he considered his superior work.",
    distractors: ["Das Kapital", "The General Theory", "The Spirit of the Laws"]
  },
  {
    title: "Candide",
    author: "Voltaire",
    era: "18th Century",
    desc: "A French satire following a naïve young man who is raised in an Edenic paradise and raised to believe 'all is for the best' — before encountering the catastrophic horrors of the real world.",
    fact: "Candide was written in three days and immediately banned in Geneva and Paris — which made it a bestseller.",
    distractors: ["Gulliver's Travels", "Tom Jones", "Don Quixote"]
  },
  {
    title: "The Social Contract",
    author: "Jean-Jacques Rousseau",
    era: "18th Century",
    desc: "Rousseau theorizes about the best way to set up a political community, arguing that a perfect society would be controlled by the 'general will' of its populace.",
    fact: "This book was burned in Geneva. Its opening line — 'Man is born free, and everywhere he is in chains' — became a rallying cry.",
    distractors: ["Leviathan", "The Spirit of the Laws", "The Federalist Papers"]
  },
  {
    title: "The Federalist Papers",
    author: "Hamilton, Madison & Jay",
    era: "18th Century",
    desc: "A series of 85 articles advocating for ratification of the United States Constitution — the primary source for interpreting the philosophy behind America's system of government.",
    fact: "The authors wrote under the pseudonym 'Publius.' All 85 essays were written in under eight months.",
    distractors: ["The Constitution", "Common Sense", "The Declaration of Independence"]
  },
  {
    title: "Critique of Pure Reason",
    author: "Immanuel Kant",
    era: "18th Century",
    desc: "Kant argues that the mind actively structures experience — and that we can never know the 'thing in itself,' only things as they appear to us through the framework of space, time, and causality.",
    fact: "Kant reportedly had such a regular daily walk in Königsberg that locals set their clocks by him.",
    distractors: ["The Problems of Philosophy", "An Enquiry Concerning Human Understanding", "Beyond Good and Evil"]
  },
  {
    title: "On Liberty",
    author: "John Stuart Mill",
    era: "19th Century",
    desc: "A philosophical defense of moral and economic freedom from state interference. Its central principle: the only legitimate reason to exercise power over another person is to prevent harm to others.",
    fact: "Mill argued that even false opinions should be heard — suppressing them robs us of the chance to test the truth.",
    distractors: ["Leviathan", "The Social Contract", "Utilitarianism"]
  },
  {
    title: "The Origin of Species",
    author: "Charles Darwin",
    era: "19th Century",
    desc: "Introduces the theory that populations evolve over the course of generations through natural selection — a landmark work in evolutionary biology.",
    fact: "Darwin delayed publishing for 20 years out of fear of controversy. He only rushed when Alfred Russel Wallace independently discovered the same theory.",
    distractors: ["The Descent of Man", "Genetics and the Origin of Species", "What Is Life?"]
  },
  {
    title: "Das Kapital",
    author: "Karl Marx",
    era: "19th Century",
    desc: "An extensive treatise on political economy offering a critical analysis of capitalism — exploring labor, surplus value, and the relationship between capital and workers.",
    fact: "Marx died before finishing volumes II and III. Engels assembled and published them from Marx's notes.",
    distractors: ["The Communist Manifesto", "The Wealth of Nations", "The General Theory"]
  },
  {
    title: "War and Peace",
    author: "Leo Tolstoy",
    era: "19th Century",
    desc: "Tells the story of Russian society during the Napoleonic era — a vast tapestry covering youth, marriage, age, and death alongside the grand sweeps of history.",
    fact: "Tolstoy regarded War and Peace not as a novel but as a 'book' — a new form he invented for it.",
    distractors: ["The Brothers Karamazov", "Crime and Punishment", "Anna Karenina"]
  },
  {
    title: "The Brothers Karamazov",
    author: "Fyodor Dostoevsky",
    era: "19th Century",
    desc: "Portrays a patricide in which each of the murdered man's sons share some complicity. On a deeper level, it is a spiritual drama of moral struggles concerning faith, doubt, reason, and free will.",
    fact: "Dostoevsky called this novel his greatest achievement. He died months after completing it.",
    distractors: ["Crime and Punishment", "The Idiot", "Demons"]
  },
  {
    title: "Moby-Dick",
    author: "Herman Melville",
    era: "19th Century",
    desc: "The wandering sailor Ishmael signs on to a whaling ship commanded by Captain Ahab, who is obsessed with hunting one specific whale — the creature that previously bit off his leg.",
    fact: "Moby-Dick was a commercial failure on publication. It was largely forgotten until the 1920s, when it was rediscovered as a masterpiece.",
    distractors: ["Billy Budd", "The Scarlet Letter", "Huckleberry Finn"]
  },
  {
    title: "Huckleberry Finn",
    author: "Mark Twain",
    era: "19th Century",
    desc: "A boy and his friend Jim, a runaway slave, drift down the Mississippi River on a raft — an enduring image of freedom and escape, and a scathing look at antebellum racism.",
    fact: "Ernest Hemingway wrote: 'All modern American literature comes from one book by Mark Twain called Huckleberry Finn.'",
    distractors: ["Tom Sawyer", "The Adventures of Tom Sawyer", "Billy Budd"]
  },
  {
    title: "The Decline and Fall of the Roman Empire",
    author: "Edward Gibbon",
    era: "18th Century",
    desc: "Covers the Roman Empire from AD 180 to 1453, examining the behavior and decisions that led to the decay and eventual fall of both the Western and Eastern Roman Empires.",
    fact: "Gibbon is sometimes called the first 'modern historian of ancient Rome' for his objective use of primary sources.",
    distractors: ["The Annals", "The Histories", "Plutarch's Lives"]
  },
  {
    title: "The Metamorphosis",
    author: "Franz Kafka",
    era: "20th Century",
    desc: "A traveling salesman wakes one morning to find he has been transformed into a monstrous insect. The story follows the tragic aftermath for him and his family.",
    fact: "Kafka reportedly read the opening sentence aloud to friends and they burst out laughing — it's absurdist comedy as much as horror.",
    distractors: ["The Trial", "In the Penal Colony", "The Castle"]
  },
  {
    title: "Waiting for Godot",
    author: "Samuel Beckett",
    era: "20th Century",
    desc: "Two tramps wait by a leafless tree for someone named Godot who never arrives. Godot's absence, and almost everything else in the play, has spawned a thousand interpretations.",
    fact: "Beckett said 'If I knew who Godot was, I would have said so in the play.'",
    distractors: ["Endgame", "The Chairs", "Six Characters in Search of an Author"]
  },
  {
    title: "Animal Farm",
    author: "George Orwell",
    era: "20th Century",
    desc: "Farm animals overthrow their human owner and set up a commune where all animals are equal — but class and status disparities soon emerge, and the pigs become tyrants.",
    fact: "Orwell wrote this as an allegory of Stalinism. It was rejected by several publishers during WWII for fear of offending an ally.",
    distractors: ["Brave New World", "1984", "Lord of the Flies"]
  },
  {
    title: "The Great Gatsby",
    author: "F. Scott Fitzgerald",
    era: "20th Century",
    desc: "Chronicles the Jazz Age — the bootleggers, millionaires, and glittering parties of 1920s America — through the eyes of a young narrator drawn to the enigmatic Jay Gatsby.",
    fact: "The green light at the end of Daisy's dock is one of literature's most analysed symbols.",
    distractors: ["The Sun Also Rises", "Tender Is the Night", "An American Tragedy"]
  },
  {
    title: "Hamlet",
    author: "William Shakespeare",
    era: "Renaissance",
    desc: "Set in Denmark, Prince Hamlet must exact revenge on his uncle who has murdered Hamlet's father, seized the throne, and married Hamlet's mother. The play vividly charts madness, treachery, and moral corruption.",
    fact: "Hamlet is Shakespeare's longest play, and the most quoted work in the English language after the Bible.",
    distractors: ["Macbeth", "Othello", "King Lear"]
  },
  {
    title: "Macbeth",
    author: "William Shakespeare",
    era: "Renaissance",
    desc: "About a regicide and its aftermath. A Scottish general is spurred by prophecy and his wife's ambition to murder the king and seize the throne — with catastrophic consequences.",
    fact: "Macbeth is Shakespeare's shortest tragedy. Theatrical superstition holds that actors must never say its title inside a theatre.",
    distractors: ["Hamlet", "King Lear", "Othello"]
  },
  {
    title: "The Tempest",
    author: "William Shakespeare",
    era: "Renaissance",
    desc: "The banished sorcerer Prospero, rightful Duke of Milan, uses his magical powers on an island he controls to punish and ultimately forgive his enemies.",
    fact: "The Tempest is thought to be the last play Shakespeare wrote alone — a fitting farewell to the stage.",
    distractors: ["A Midsummer Night's Dream", "The Winter's Tale", "Cymbeline"]
  },
  {
    title: "Romeo and Juliet",
    author: "William Shakespeare",
    era: "Renaissance",
    desc: "Two 'star-cross'd lovers' from feuding families fall into doomed love. Their untimely deaths ultimately unite their warring families — at catastrophic cost.",
    fact: "The story predates Shakespeare — it appeared in Italian novellas decades earlier. Shakespeare's version made it immortal.",
    distractors: ["Othello", "Much Ado About Nothing", "Twelfth Night"]
  },
  {
    title: "Fear and Trembling",
    author: "Søren Kierkegaard",
    era: "19th Century",
    desc: "A provocative interpretation of Abraham's near-sacrifice of Isaac — used as a launching pad to discuss the nature of faith, its relationship to ethics, and what it means to be authentically religious.",
    fact: "Kierkegaard published this under the pseudonym 'Johannes de Silentio' — John of Silence.",
    distractors: ["Beyond Good and Evil", "Pensées", "The Confessions"]
  },
  {
    title: "Beyond Good and Evil",
    author: "Friedrich Nietzsche",
    era: "19th Century",
    desc: "Nietzsche attacks past philosophers for their blind acceptance of Christian premises in morality, and moves into a realm 'beyond' traditional ethics — fearlessly confronting perspectival knowledge.",
    fact: "Nietzsche's concept of the 'will to power' and 'Übermensch' are sketched here and later wildly misappropriated.",
    distractors: ["Fear and Trembling", "The Problems of Philosophy", "Thus Spoke Zarathustra"]
  },
  {
    title: "A Mathematician's Apology",
    author: "G. H. Hardy",
    era: "20th Century",
    desc: "A defense of pure mathematics as an aesthetic pursuit — arguing that a mathematician's patterns, like a painter's or poet's, must be beautiful. Gives the layman an insight into a mathematical mind.",
    fact: "Hardy famously wrote that he had never done anything 'useful' — a point he seemed to make with pride.",
    distractors: ["What Is Life?", "Science and Hypothesis", "An Introduction to Mathematics"]
  }
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
  const pool = shuffle(BOOKS).slice(0, TOTAL_QUESTIONS);
  return pool.map(book => {
    // Build 4 options: correct + 3 distractors
    const allTitles = BOOKS.map(b => b.title);
    const distractorPool = shuffle(
      book.distractors && book.distractors.length >= 3
        ? book.distractors
        : allTitles.filter(t => t !== book.title)
    ).slice(0, 3);
    const options = shuffle([book.title, ...distractorPool]);
    return { book, options };
  });
}

function renderStart() {
  document.getElementById('card-body').innerHTML = `
    <div class="start-screen">
      <div class="tome-icon">📖</div>
      <h2>Can you identify the Great Books from their descriptions?</h2>
      <p>
        Jon once compiled capsule summaries of the Great Books of the Western World —
        from Homer to Beckett — so you could decide what to read next.
        Now those summaries become your clues.
      </p>
      <p>
        Ten questions. Read the description, pick the title.
        Each question is worth one point.
      </p>
      <button class="start-btn" onclick="startQuiz()">Begin Reading →</button>
    </div>
  `;
}

function renderQuestion() {
  const { book, options } = questions[current];
  const pct = Math.round((current / TOTAL_QUESTIONS) * 100);

  const optionLetters = ['A', 'B', 'C', 'D'];
  const optionsHTML = options.map((opt, i) => `
    <button class="option-btn" onclick="selectAnswer(${i})" id="opt-${i}">
      <span class="option-letter">${optionLetters[i]}</span>
      <span>${opt}</span>
    </button>
  `).join('');

  document.getElementById('card-body').innerHTML = `
    <div class="progress-label">
      <span>Question ${current + 1} of ${TOTAL_QUESTIONS}</span>
      <span class="score-badge">Score: ${score}</span>
    </div>
    <div class="progress-bar-wrap">
      <div class="progress-bar-fill" style="width:${pct}%"></div>
    </div>
    <div class="question-label">
      Identify the work <span class="era-badge">${book.era}</span>
    </div>
    <div class="description-box">${book.desc}</div>
    <div class="ask-label">Which Great Book is being described?</div>
    <div class="options">${optionsHTML}</div>
    <div class="feedback" id="feedback"></div>
    <button class="next-btn" id="next-btn" style="display:none" onclick="nextQuestion()">
      ${current + 1 < TOTAL_QUESTIONS ? 'Next Question →' : 'See Results →'}
    </button>
  `;
  answered = false;
}

function selectAnswer(idx) {
  if (answered) return;
  answered = true;
  const { book, options } = questions[current];
  const chosen = options[idx];
  const correct = chosen === book.title;
  if (correct) score++;

  history.push({ book, chosen, correct });

  // Style buttons
  for (let i = 0; i < options.length; i++) {
    const btn = document.getElementById(`opt-${i}`);
    btn.disabled = true;
    if (options[i] === book.title) btn.classList.add('correct');
    else if (i === idx && !correct) btn.classList.add('wrong');
  }

  // Show feedback
  const fb = document.getElementById('feedback');
  fb.className = 'feedback show ' + (correct ? 'correct' : 'wrong');
  fb.innerHTML = correct
    ? `<div class="answer-title">✓ Correct!</div>
       <div class="fun-fact">${book.fact}</div>`
    : `<div class="answer-title">✗ The answer is: <em>${book.title}</em> by ${book.author}</div>
       <div class="fun-fact">${book.fact}</div>`;

  document.getElementById('next-btn').style.display = 'block';
}

function nextQuestion() {
  current++;
  if (current >= TOTAL_QUESTIONS) {
    renderResults();
  } else {
    renderQuestion();
  }
}

function renderResults() {
  const pct = Math.round((score / TOTAL_QUESTIONS) * 100);
  let verdict, emoji;
  if (pct === 100) {
    emoji = '🏆'; verdict = 'Perfect score! You\'ve clearly read — or at least perused — the Great Books.';
  } else if (pct >= 80) {
    emoji = '📚'; verdict = 'Excellent! Mortimer Adler would be pleased. You know your Western canon.';
  } else if (pct >= 60) {
    emoji = '📖'; verdict = 'Good showing. Jon might recommend picking up a few of the ones you missed.';
  } else if (pct >= 40) {
    emoji = '🕯️'; verdict = 'Room to grow! The Great Books await. Adler says read 20 pages an hour — slowly.';
  } else {
    emoji = '🌱'; verdict = 'The canon is vast and the reading list is long. Every journey starts somewhere.';
  }

  const reviewItems = history.map(({ book, chosen, correct }) => {
    if (correct) {
      return `<li>
        <span class="ri">✅</span>
        <span><span class="answer-name">${book.title}</span> — ${book.author}</span>
      </li>`;
    } else {
      return `<li>
        <span class="ri">❌</span>
        <span>
          <span class="answer-name">${book.title}</span> — ${book.author}
          <br><span class="your-answer">You guessed: ${chosen}</span>
        </span>
      </li>`;
    }
  }).join('');

  document.getElementById('card-body').innerHTML = `
    <div class="results">
      <div style="font-size:2.5em;margin-bottom:8px">${emoji}</div>
      <div class="score-display">${score}/${TOTAL_QUESTIONS}</div>
      <div class="score-denom">${pct}%</div>
      <div class="verdict">${verdict}</div>
      <hr class="divider">
      <div style="text-align:left;margin-bottom:12px;font-size:0.9em;color:var(--ink-light)">Your answers:</div>
      <ul class="review-list">${reviewItems}</ul>
      <button class="restart-btn" onclick="startQuiz()">Play Again</button>
    </div>
  `;
}

function startQuiz() {
  questions = buildQuestions();
  current = 0;
  score = 0;
  history = [];
  renderQuestion();
}

// Boot
renderStart();
</script>
</body>
</html>
