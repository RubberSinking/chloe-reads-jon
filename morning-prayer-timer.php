<?php
// Rotate through gospel passages by day of year
$dayOfYear = (int)date('z'); // 0-365

$passages = [
    [
        "ref" => "Matthew 5:3-10",
        "title" => "The Beatitudes",
        "text" => "Blessed are the poor in spirit, for theirs is the kingdom of heaven.\nBlessed are those who mourn, for they will be comforted.\nBlessed are the meek, for they will inherit the earth.\nBlessed are those who hunger and thirst for righteousness, for they will be filled.\nBlessed are the merciful, for they will receive mercy.\nBlessed are the pure in heart, for they will see God.\nBlessed are the peacemakers, for they will be called children of God.\nBlessed are those who are persecuted for righteousness' sake, for theirs is the kingdom of heaven.",
        "reflection" => ["Which Beatitude speaks most directly to where you are right now?", "Where in your life is God calling you toward greater mercy or purity of heart?", "How might you live one Beatitude more fully today?"],
        "psalm" => ["Psalm 34:8", "Taste and see that the Lord is good; blessed is the one who takes refuge in him."],
    ],
    [
        "ref" => "John 15:9-12",
        "title" => "Remain in My Love",
        "text" => "As the Father has loved me, so I have loved you; abide in my love. If you keep my commandments, you will abide in my love, just as I have kept my Father's commandments and abide in his love. I have said these things to you so that my joy may be in you, and that your joy may be complete. This is my commandment, that you love one another as I have loved you.",
        "reflection" => ["What does it mean to you to abide in Christ's love today?", "Who in your life might need to experience love through you today?", "Is there anything keeping you from resting in God's love right now?"],
        "psalm" => ["Psalm 136:1", "Give thanks to the Lord, for he is good, for his steadfast love endures forever."],
    ],
    [
        "ref" => "Luke 15:11-24",
        "title" => "The Prodigal Son Returns",
        "text" => "Then he said, 'There was a man who had two sons. The younger of them said to his father, \"Father, give me the share of the property that will belong to me.\" So he divided his property between them. And he arose and came to his father. But while he was still far off, his father saw him and was filled with compassion; he ran and put his arms around him and kissed him. Then the son said to him, \"Father, I have sinned against heaven and before you; I am no longer worthy to be called your son.\" But the father said to his slaves, \"Quickly, bring out a robe — the best one — and put it on him; put a ring on his finger and sandals on his feet. And get the fatted calf and kill it, and let us eat and celebrate; for this son of mine was dead and is alive again; he was lost and is found!\" And they began to celebrate.'",
        "reflection" => ["Is there a corner of your heart still 'far off' from the Father?", "Can you picture the Father running toward you right now?", "What does coming home to God feel like in this season of your life?"],
        "psalm" => ["Psalm 103:8", "The Lord is merciful and gracious, slow to anger and abounding in steadfast love."],
    ],
    [
        "ref" => "Matthew 11:28-30",
        "title" => "Come to Me",
        "text" => "Come to me, all you that are weary and are carrying heavy burdens, and I will give you rest. Take my yoke upon you, and learn from me; for I am gentle and humble in heart, and you will find rest for your souls. For my yoke is easy, and my burden is light.",
        "reflection" => ["What burdens are you carrying into this day that you could hand to Christ?", "What would it feel like to truly rest in God — not just physically, but spiritually?", "Is there a way you have made following Christ harder than He intended it to be?"],
        "psalm" => ["Psalm 23:1-2", "The Lord is my shepherd, I shall not want. He makes me lie down in green pastures; he leads me beside still waters."],
    ],
    [
        "ref" => "Luke 6:27-31",
        "title" => "Love Your Enemies",
        "text" => "But I say to you that listen: Love your enemies, do good to those who hate you, bless those who curse you, pray for those who abuse you. If anyone strikes you on the cheek, offer the other also; and from anyone who takes away your coat do not withhold even your shirt. Give to everyone who begs from you; and if anyone takes away your goods, do not ask for them again. Do to others as you would have them do to you.",
        "reflection" => ["Is there someone you find difficult to love right now? Can you bring them before God?", "What would it look like practically to bless someone who has hurt you?", "How does Christ's own example of love make this commandment possible?"],
        "psalm" => ["Psalm 37:7", "Be still before the Lord, and wait patiently for him."],
    ],
    [
        "ref" => "John 6:35, 47-51",
        "title" => "Bread of Life",
        "text" => "Jesus said to them, 'I am the bread of life. Whoever comes to me will never be hungry, and whoever believes in me will never be thirsty. Very truly, I tell you, whoever believes has eternal life. I am the bread of life. Your ancestors ate the manna in the wilderness, and they died. This is the bread that comes down from heaven, so that one may eat of it and not die. I am the living bread that came down from heaven. Whoever eats of this bread will live forever; and the bread that I will give for the life of the world is my flesh.'",
        "reflection" => ["Where do you most often look for nourishment that only God can truly provide?", "How can you receive Christ as 'bread' more fully today — through prayer, Scripture, Eucharist?", "What hunger in you is God inviting you to bring to Him?"],
        "psalm" => ["Psalm 81:10", "I am the Lord your God, who brought you up out of the land of Egypt. Open your mouth wide and I will fill it."],
    ],
    [
        "ref" => "Mark 1:35-39",
        "title" => "Jesus Prays at Dawn",
        "text" => "In the morning, while it was still very dark, Jesus got up and went out to a deserted place, and there he prayed. And Simon and his companions hunted for him. When they found him, they said to him, 'Everyone is searching for you.' He answered, 'Let us go on to the neighboring towns, so that I may proclaim the message there also; for that is what I came out to do.' And he went throughout Galilee, proclaiming the message in their synagogues and casting out demons.",
        "reflection" => ["Jesus began even his busiest days in solitary prayer. What does this say about priority?", "What does it mean for you to find a 'deserted place' amid the noise of daily life?", "How does prayer shape the work that follows it?"],
        "psalm" => ["Psalm 5:3", "O Lord, in the morning you hear my voice; in the morning I plead my case to you, and watch."],
    ],
    [
        "ref" => "Luke 10:38-42",
        "title" => "Mary and Martha",
        "text" => "Now as they went on their way, he entered a certain village, where a woman named Martha welcomed him into her home. She had a sister named Mary, who sat at the Lord's feet and listened to what he was saying. But Martha was distracted by her many tasks; so she came to him and asked, 'Lord, do you not care that my sister has left me to do all the work by myself? Tell her then to help me.' But the Lord answered her, 'Martha, Martha, you are worried and distracted by many things; there is need of only one thing. Mary has chosen the better part, which will not be taken away from her.'",
        "reflection" => ["Are you more Mary or Martha this morning?", "What distractions tend to pull you away from sitting quietly with God?", "What is the 'one thing necessary' for you right now?"],
        "psalm" => ["Psalm 27:4", "One thing I asked of the Lord, that will I seek after: to live in the house of the Lord all the days of my life."],
    ],
    [
        "ref" => "John 3:16-17",
        "title" => "God So Loved the World",
        "text" => "For God so loved the world that he gave his only Son, so that everyone who believes in him may not perish but may have eternal life. Indeed, God did not send the Son into the world to condemn the world, but in order that the world might be saved through him.",
        "reflection" => ["Let the words 'God so loved the world' sink in. How does it feel to be included in that love?", "Do you find it easier to believe God loves the world in general, or that He loves you in particular?", "How might you carry this truth with you into the day ahead?"],
        "psalm" => ["Psalm 117:2", "For great is his steadfast love toward us, and the faithfulness of the Lord endures forever. Praise the Lord!"],
    ],
    [
        "ref" => "Matthew 6:9-13",
        "title" => "The Lord's Prayer",
        "text" => "Our Father in heaven, hallowed be your name. Your kingdom come. Your will be done, on earth as it is in heaven. Give us this day our daily bread. And forgive us our debts, as we also have forgiven our debtors. And do not bring us to the time of trial, but rescue us from the evil one.",
        "reflection" => ["Pray the Our Father again slowly, one phrase at a time, pausing after each.", "Which line of the prayer do you most need to mean today?", "What would it look like for God's will to be done through you in the next 24 hours?"],
        "psalm" => ["Psalm 25:4-5", "Make me to know your ways, O Lord; teach me your paths. Lead me in your truth, and teach me, for you are the God of my salvation."],
    ],
    [
        "ref" => "Luke 1:46-50",
        "title" => "The Magnificat",
        "text" => "And Mary said, 'My soul magnifies the Lord, and my spirit rejoices in God my Saviour, for he has looked with favour on the lowliness of his servant. Surely, from now on all generations will call me blessed; for the Mighty One has done great things for me, and holy is his name. His mercy is for those who fear him from generation to generation.'",
        "reflection" => ["What has God done in your life that you can magnify Him for today?", "Mary rejoiced in her 'lowliness.' What does holy humility look like for you?", "How might you pray the Magnificat as your own prayer this morning?"],
        "psalm" => ["Psalm 98:1", "O sing to the Lord a new song, for he has done marvellous things."],
    ],
    [
        "ref" => "John 10:11-15",
        "title" => "The Good Shepherd",
        "text" => "I am the good shepherd. The good shepherd lays down his life for the sheep. The hired hand, who is not the shepherd and does not own the sheep, sees the wolf coming and leaves the sheep and runs away — and the wolf snatches them and scatters them. The hired hand runs away because a hired hand does not care for the sheep. I am the good shepherd. I know my own and my own know me, just as the Father knows me and I know the Father. And I lay down my life for the sheep.",
        "reflection" => ["How does it feel to be known by the Good Shepherd — fully known and still loved?", "Is there a 'wolf' in your life right now — a fear or threat — that you can surrender to Christ's care?", "What does it mean to you that Jesus chose to lay down His life for you specifically?"],
        "psalm" => ["Psalm 23:4", "Even though I walk through the darkest valley, I fear no evil; for you are with me; your rod and your staff — they comfort me."],
    ],
    [
        "ref" => "Matthew 25:34-40",
        "title" => "Whatsoever You Do",
        "text" => "Then the king will say to those at his right hand, 'Come, you that are blessed by my Father, inherit the kingdom prepared for you from the foundation of the world; for I was hungry and you gave me food, I was thirsty and you gave me something to drink, I was a stranger and you welcomed me, I was naked and you gave me clothing, I was sick and you took care of me, I was in prison and you visited me.' And the righteous will answer him, 'Lord, when was it that we saw you hungry and gave you food?' And the king will answer them, 'Truly I tell you, just as you did it to one of the least of these who are members of my family, you did it to me.'",
        "reflection" => ["Who is 'the least of these' in your life right now — someone you can serve today?", "How does seeing Christ in others change the way you approach ordinary acts of service?", "Is there a concrete act of mercy God is calling you toward today?"],
        "psalm" => ["Psalm 82:3-4", "Give justice to the weak and the orphan; maintain the right of the lowly and the destitute. Rescue the weak and the needy."],
    ],
];

$idx = $dayOfYear % count($passages);
$passage = $passages[$idx];

$today = date('F j, Y');
$todayISO = date('Y-m-d');

$passageText = htmlspecialchars($passage['text']);
$passageTextJS = json_encode($passage['text']);
$reflectionJS = json_encode($passage['reflection']);
$psalmRefJS = json_encode($passage['psalm'][0]);
$psalmTextJS = json_encode($passage['psalm'][1]);
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>10-Minute Morning Prayer</title>
<style>
  :root {
    --gold: #b8952a;
    --gold-light: #d4af57;
    --cream: #fdf8f0;
    --parchment: #f5edd8;
    --brown: #6b4c2a;
    --text: #2e1f0d;
    --muted: #8a6e4a;
    --blue-dark: #1a2744;
    --blue: #2c4070;
    --sky: #e8f0fc;
    --progress-bg: #e0d5c0;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Georgia', serif;
    background: var(--blue-dark);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 0 60px 0;
  }

  header {
    width: 100%;
    background: linear-gradient(180deg, #0d1a33 0%, var(--blue-dark) 100%);
    text-align: center;
    padding: 28px 20px 20px;
    border-bottom: 2px solid var(--gold);
  }

  header .cross {
    font-size: 1.8rem;
    color: var(--gold-light);
    display: block;
    margin-bottom: 6px;
  }

  header h1 {
    font-size: 1.5rem;
    color: var(--gold-light);
    letter-spacing: 0.04em;
    font-weight: normal;
  }

  header .date-display {
    font-size: 0.85rem;
    color: #8899bb;
    margin-top: 4px;
    font-style: italic;
  }

  .container {
    width: 100%;
    max-width: 660px;
    padding: 0 16px;
  }

  /* ---- Overview cards ---- */
  .schedule-overview {
    margin: 24px 0 0;
  }

  .schedule-overview h2 {
    color: #99aad0;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 10px;
    font-style: normal;
    font-family: sans-serif;
  }

  .schedule-list {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .sched-item {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    padding: 10px 14px;
    gap: 12px;
    border: 1.5px solid transparent;
    transition: border-color 0.3s, background 0.3s;
    cursor: pointer;
  }

  .sched-item.active {
    background: rgba(184,149,42,0.15);
    border-color: var(--gold);
  }

  .sched-item.done {
    opacity: 0.4;
  }

  .sched-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--blue);
    color: var(--gold-light);
    font-size: 0.8rem;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    font-family: sans-serif;
    border: 1.5px solid var(--gold);
    transition: background 0.3s;
  }

  .sched-item.active .sched-num {
    background: var(--gold);
    color: var(--blue-dark);
  }

  .sched-item.done .sched-num {
    background: #334;
    border-color: #446;
    color: #667;
  }

  .sched-label { flex: 1; }
  .sched-label strong {
    display: block;
    color: #cdd8ee;
    font-size: 0.95rem;
    font-weight: normal;
  }
  .sched-label span {
    color: #7a8aaa;
    font-size: 0.8rem;
    font-family: sans-serif;
  }

  .sched-dur {
    color: #6678aa;
    font-size: 0.8rem;
    font-family: sans-serif;
    flex-shrink: 0;
  }

  /* ---- Big timer ---- */
  .timer-block {
    margin: 24px 0;
    background: var(--parchment);
    border-radius: 16px;
    padding: 24px 20px 20px;
    border: 2px solid var(--gold);
    box-shadow: 0 4px 24px rgba(0,0,0,0.35);
  }

  .section-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--muted);
    font-family: sans-serif;
    margin-bottom: 4px;
  }

  .section-name {
    font-size: 1.4rem;
    color: var(--brown);
    margin-bottom: 16px;
  }

  .big-timer {
    font-size: 4.5rem;
    color: var(--text);
    font-family: 'Georgia', serif;
    text-align: center;
    letter-spacing: 0.04em;
    line-height: 1;
    margin: 8px 0 16px;
  }

  .progress-bar-wrap {
    background: var(--progress-bg);
    border-radius: 6px;
    height: 8px;
    overflow: hidden;
    margin-bottom: 20px;
  }

  .progress-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--gold), var(--gold-light));
    border-radius: 6px;
    transition: width 1s linear;
    width: 0%;
  }

  .controls {
    display: flex;
    gap: 10px;
    justify-content: center;
  }

  .btn {
    padding: 12px 28px;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-family: 'Georgia', serif;
    cursor: pointer;
    transition: transform 0.1s, box-shadow 0.1s;
    letter-spacing: 0.02em;
  }

  .btn:active { transform: scale(0.97); }

  .btn-primary {
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    color: var(--blue-dark);
    box-shadow: 0 2px 10px rgba(184,149,42,0.4);
    font-weight: bold;
  }

  .btn-secondary {
    background: var(--blue);
    color: var(--gold-light);
    border: 1.5px solid var(--gold);
  }

  /* ---- Content panel ---- */
  .content-panel {
    background: var(--cream);
    border-radius: 14px;
    padding: 20px;
    border: 1.5px solid #ddd0b0;
    margin-top: 0;
    min-height: 140px;
  }

  .content-panel h3 {
    color: var(--brown);
    font-size: 1rem;
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #ddd0b0;
  }

  .content-panel p, .content-panel li {
    color: var(--text);
    font-size: 0.97rem;
    line-height: 1.7;
    margin-bottom: 8px;
  }

  .content-panel ul {
    list-style: none;
    padding: 0;
  }

  .content-panel ul li::before {
    content: "✦ ";
    color: var(--gold);
    font-size: 0.75em;
  }

  .psalm-ref {
    display: inline-block;
    font-size: 0.8rem;
    color: var(--muted);
    font-style: italic;
    font-family: sans-serif;
    margin-bottom: 8px;
  }

  .scripture-ref {
    font-size: 0.85rem;
    color: var(--muted);
    font-style: italic;
    font-family: sans-serif;
    margin-bottom: 10px;
    display: block;
  }

  .total-bar {
    margin: 20px 0 0;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .total-bar-label {
    font-family: sans-serif;
    font-size: 0.78rem;
    color: #8899bb;
    flex-shrink: 0;
  }

  .total-bar-wrap {
    flex: 1;
    background: rgba(255,255,255,0.08);
    border-radius: 4px;
    height: 5px;
    overflow: hidden;
  }

  .total-bar-fill {
    height: 100%;
    background: var(--gold-light);
    border-radius: 4px;
    transition: width 1s linear;
    width: 0%;
  }

  .total-time {
    font-family: sans-serif;
    font-size: 0.78rem;
    color: #8899bb;
    flex-shrink: 0;
    min-width: 50px;
    text-align: right;
  }

  .done-screen {
    display: none;
    text-align: center;
    padding: 30px 10px;
    background: var(--parchment);
    border-radius: 16px;
    border: 2px solid var(--gold);
    margin-top: 20px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.35);
  }

  .done-screen h2 {
    color: var(--brown);
    font-size: 1.6rem;
    margin-bottom: 10px;
  }

  .done-screen p {
    color: var(--muted);
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 16px;
  }

  .done-cross {
    font-size: 2.5rem;
    color: var(--gold-light);
    display: block;
    margin-bottom: 12px;
  }

  @media (max-width: 480px) {
    .big-timer { font-size: 3.5rem; }
    header h1 { font-size: 1.2rem; }
    .section-name { font-size: 1.2rem; }
  }
</style>
</head>
<body>

<header>
  <span class="cross">✝</span>
  <h1>10-Minute Morning Prayer</h1>
  <div class="date-display"><?= $today ?></div>
</header>

<div class="container">

  <!-- Overview -->
  <div class="schedule-overview">
    <h2>Today's Schedule</h2>
    <div class="schedule-list" id="schedList">
      <div class="sched-item" id="si-0" onclick="jumpTo(0)">
        <div class="sched-num">1</div>
        <div class="sched-label"><strong>Opening Prayer</strong><span>Invoke God's presence</span></div>
        <div class="sched-dur">1 min</div>
      </div>
      <div class="sched-item" id="si-1" onclick="jumpTo(1)">
        <div class="sched-num">2</div>
        <div class="sched-label">
          <strong>Scripture</strong>
          <span><?= htmlspecialchars($passage['ref']) ?> — <?= htmlspecialchars($passage['title']) ?></span>
        </div>
        <div class="sched-dur">3 min</div>
      </div>
      <div class="sched-item" id="si-2" onclick="jumpTo(2)">
        <div class="sched-num">3</div>
        <div class="sched-label"><strong>Reflection</strong><span>Sit with the Word</span></div>
        <div class="sched-dur">3 min</div>
      </div>
      <div class="sched-item" id="si-3" onclick="jumpTo(3)">
        <div class="sched-num">4</div>
        <div class="sched-label"><strong>Responsorial Psalm</strong><span><?= htmlspecialchars($passage['psalm'][0]) ?></span></div>
        <div class="sched-dur">1 min</div>
      </div>
      <div class="sched-item" id="si-4" onclick="jumpTo(4)">
        <div class="sched-num">5</div>
        <div class="sched-label"><strong>Intercessory Prayer</strong><span>Pray for others</span></div>
        <div class="sched-dur">1 min</div>
      </div>
      <div class="sched-item" id="si-5" onclick="jumpTo(5)">
        <div class="sched-num">6</div>
        <div class="sched-label"><strong>Closing Prayer</strong><span>Send your day to God</span></div>
        <div class="sched-dur">1 min</div>
      </div>
    </div>
    <div class="total-bar">
      <span class="total-bar-label">Overall</span>
      <div class="total-bar-wrap"><div class="total-bar-fill" id="totalFill"></div></div>
      <span class="total-time" id="totalTime">10:00 left</span>
    </div>
  </div>

  <!-- Timer block -->
  <div class="timer-block" id="timerBlock">
    <div class="section-label" id="sectionLabel">Section 1 of 6</div>
    <div class="section-name" id="sectionName">Opening Prayer</div>
    <div class="big-timer" id="bigTimer">1:00</div>
    <div class="progress-bar-wrap">
      <div class="progress-bar-fill" id="progressFill"></div>
    </div>
    <div class="controls">
      <button class="btn btn-primary" id="startBtn" onclick="toggleTimer()">▶ Begin</button>
      <button class="btn btn-secondary" id="skipBtn" onclick="skipSection()">Skip →</button>
    </div>
  </div>

  <!-- Content panel -->
  <div class="content-panel" id="contentPanel">
    <h3>✝ Opening Prayer</h3>
    <p>In the name of the Father, and of the Son, and of the Holy Spirit. Amen.</p>
    <p>Lord, as I begin this time of prayer, open my heart to Your word and Your presence. Still my mind from the noise of the day ahead. I am here. Guide my thoughts and my prayer this morning. Amen.</p>
  </div>

  <!-- Done screen -->
  <div class="done-screen" id="doneScreen">
    <span class="done-cross">✝</span>
    <h2>Prayer Complete</h2>
    <p>You have given 10 minutes of your morning to God.<br>Go in peace, to love and serve the Lord.</p>
    <p style="color: #b8952a; font-style: italic; font-size: 0.9rem;">Thanks be to God.</p>
    <button class="btn btn-secondary" onclick="resetTimer()" style="margin-top:10px;">Pray Again</button>
  </div>

</div>

<script>
const sections = [
  {
    name: "Opening Prayer",
    duration: 60,
    label: "Section 1 of 6",
    render: function() {
      return `<h3>✝ Opening Prayer</h3>
        <p>In the name of the Father, and of the Son, and of the Holy Spirit. Amen.</p>
        <p>Lord, as I begin this time of prayer, open my heart to Your word and Your presence. Still my mind from the noise of the day ahead. I am here. Guide my thoughts and my prayer this morning. Amen.</p>`;
    }
  },
  {
    name: "Scripture Reading",
    duration: 180,
    label: "Section 2 of 6",
    render: function() {
      const text = <?= $passageTextJS ?>;
      const ref = <?= json_encode($passage['ref']) ?>;
      const title = <?= json_encode($passage['title']) ?>;
      const lines = text.split('\n').filter(l => l.trim());
      const paras = lines.map(l => `<p>${l}</p>`).join('');
      return `<h3>📖 ${title}</h3>
        <span class="scripture-ref">${ref}</span>
        ${paras}`;
    }
  },
  {
    name: "Reflection",
    duration: 180,
    label: "Section 3 of 6",
    render: function() {
      const qs = <?= $reflectionJS ?>;
      const items = qs.map(q => `<li>${q}</li>`).join('');
      return `<h3>🕊 Reflection</h3>
        <p>Sit quietly with the passage you just read. Let these questions guide your prayer:</p>
        <ul>${items}</ul>`;
    }
  },
  {
    name: "Responsorial Psalm",
    duration: 60,
    label: "Section 4 of 6",
    render: function() {
      const ref = <?= $psalmRefJS ?>;
      const text = <?= $psalmTextJS ?>;
      return `<h3>🎵 Responsorial Psalm</h3>
        <span class="psalm-ref">${ref}</span>
        <p style="font-style:italic; font-size: 1.05rem; line-height:1.8;">"${text}"</p>
        <p style="margin-top:12px; color: var(--muted); font-size:0.9rem;">Read this slowly, two or three times. Let the words become your own.</p>`;
    }
  },
  {
    name: "Intercessory Prayer",
    duration: 60,
    label: "Section 5 of 6",
    render: function() {
      return `<h3>🙏 Intercessory Prayer</h3>
        <p>Bring before God those on your heart today. You might pray for:</p>
        <ul>
          <li>Your family — name them one by one</li>
          <li>Someone who is sick or struggling</li>
          <li>Those who have hurt you or whom you find difficult</li>
          <li>Your community, your country, the Church</li>
          <li>The poor, the forgotten, those no one prays for</li>
        </ul>`;
    }
  },
  {
    name: "Closing Prayer",
    duration: 60,
    label: "Section 6 of 6",
    render: function() {
      return `<h3>✝ Closing Prayer</h3>
        <p>Lord, thank You for this time of prayer. Carry what I have received into the hours ahead. Where I am weak, be my strength. Where I am distracted, be my focus. Where I fail, be my mercy.</p>
        <p>May everything I do today — the small tasks and the large ones — be done for Your glory and the good of those around me.</p>
        <p>In the name of the Father, and of the Son, and of the Holy Spirit. Amen.</p>`;
    }
  }
];

const TOTAL_DURATION = 600; // 10 minutes in seconds

let currentSection = 0;
let timeLeft = sections[0].duration;
let running = false;
let interval = null;

function fmt(sec) {
  const m = Math.floor(sec / 60);
  const s = sec % 60;
  return m + ':' + String(s).padStart(2, '0');
}

function totalElapsed() {
  let elapsed = 0;
  for (let i = 0; i < currentSection; i++) elapsed += sections[i].duration;
  elapsed += (sections[currentSection].duration - timeLeft);
  return elapsed;
}

function updateUI() {
  const s = sections[currentSection];
  document.getElementById('sectionLabel').textContent = s.label;
  document.getElementById('sectionName').textContent = s.name;
  document.getElementById('bigTimer').textContent = fmt(timeLeft);

  const pct = ((s.duration - timeLeft) / s.duration * 100).toFixed(1);
  document.getElementById('progressFill').style.width = pct + '%';

  const elapsed = totalElapsed();
  const totalPct = (elapsed / TOTAL_DURATION * 100).toFixed(1);
  document.getElementById('totalFill').style.width = totalPct + '%';

  const remaining = TOTAL_DURATION - elapsed;
  document.getElementById('totalTime').textContent = fmt(remaining) + ' left';

  document.getElementById('contentPanel').innerHTML = s.render();

  // Update schedule items
  for (let i = 0; i < sections.length; i++) {
    const el = document.getElementById('si-' + i);
    el.classList.remove('active', 'done');
    if (i < currentSection) el.classList.add('done');
    else if (i === currentSection) el.classList.add('active');
  }

  // Scroll active section into view
  const activeEl = document.getElementById('si-' + currentSection);
  if (activeEl) activeEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function toggleTimer() {
  if (running) {
    pauseTimer();
  } else {
    startTimer();
  }
}

function startTimer() {
  running = true;
  document.getElementById('startBtn').textContent = '⏸ Pause';
  interval = setInterval(() => {
    timeLeft--;
    updateUI();
    if (timeLeft <= 0) {
      nextSection();
    }
  }, 1000);
}

function pauseTimer() {
  running = false;
  document.getElementById('startBtn').textContent = '▶ Resume';
  clearInterval(interval);
}

function nextSection() {
  clearInterval(interval);
  running = false;
  currentSection++;
  if (currentSection >= sections.length) {
    finishPrayer();
    return;
  }
  timeLeft = sections[currentSection].duration;
  updateUI();
  document.getElementById('startBtn').textContent = '▶ Continue';
  // brief pause, then auto-start
  setTimeout(() => {
    startTimer();
  }, 1200);
}

function skipSection() {
  clearInterval(interval);
  running = false;
  currentSection++;
  if (currentSection >= sections.length) {
    finishPrayer();
    return;
  }
  timeLeft = sections[currentSection].duration;
  document.getElementById('startBtn').textContent = '▶ Continue';
  updateUI();
}

function jumpTo(idx) {
  if (running) pauseTimer();
  currentSection = idx;
  timeLeft = sections[idx].duration;
  document.getElementById('startBtn').textContent = '▶ Begin';
  updateUI();
}

function finishPrayer() {
  document.getElementById('timerBlock').style.display = 'none';
  document.getElementById('contentPanel').style.display = 'none';
  document.getElementById('doneScreen').style.display = 'block';

  // Mark all done
  for (let i = 0; i < sections.length; i++) {
    document.getElementById('si-' + i).classList.add('done');
    document.getElementById('si-' + i).classList.remove('active');
  }
  document.getElementById('totalFill').style.width = '100%';
  document.getElementById('totalTime').textContent = '0:00 left';
}

function resetTimer() {
  currentSection = 0;
  timeLeft = sections[0].duration;
  running = false;
  clearInterval(interval);
  document.getElementById('timerBlock').style.display = '';
  document.getElementById('contentPanel').style.display = '';
  document.getElementById('doneScreen').style.display = 'none';
  document.getElementById('startBtn').textContent = '▶ Begin';
  updateUI();
}

// Init
updateUI();
</script>

</body>
</html>
