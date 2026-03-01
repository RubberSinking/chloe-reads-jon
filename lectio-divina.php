<?php
// Lectio Divina Companion
// Inspired by Jon's "Douai-AI" post about reading scripture with fresh ears

$passages = [
    ["ref"=>"John 15:9–12","title"=>"Remain in My Love","text"=>"As the Father has loved me, so I have loved you. Remain in my love. If you keep my commandments, you will remain in my love, just as I have kept my Father's commandments and remain in his love.\n\nI have told you this so that my joy may be in you, and your joy may be complete.\n\nThis is my commandment: love one another as I have loved you.","theme"=>"Love"],
    ["ref"=>"Matthew 5:3–10","title"=>"The Beatitudes","text"=>"Blessed are the poor in spirit — the kingdom of heaven is theirs.\n\nBlessed are those who mourn — they will be comforted.\n\nBlessed are the meek — they will inherit the earth.\n\nBlessed are those who hunger and thirst for righteousness — they will be satisfied.\n\nBlessed are the merciful — they will receive mercy.\n\nBlessed are the pure in heart — they will see God.\n\nBlessed are the peacemakers — they will be called children of God.\n\nBlessed are those who are persecuted for righteousness — the kingdom of heaven is theirs.","theme"=>"Beatitude"],
    ["ref"=>"Luke 15:11–24","title"=>"The Prodigal Son","text"=>"A man had two sons. The younger one said to his father, \"Give me my share of the inheritance.\" So the father divided his property between them.\n\nNot long after, the younger son gathered everything and left for a distant country, where he squandered it all in reckless living. When he had spent everything, a severe famine struck that land, and he began to be in need.\n\nComing to his senses, he said, \"How many of my father's servants have plenty to eat, while I am dying of hunger? I will get up and go back to my father and say: Father, I have sinned against heaven and against you. I am no longer worthy to be called your son.\"\n\nWhile he was still a long way off, his father saw him and was filled with compassion. He ran to his son, embraced him and kissed him. The father said to his servants, \"Bring the finest robe and put it on him. Put a ring on his finger and sandals on his feet. Let us celebrate — for this son of mine was dead and has come back to life; he was lost and is found.\"","theme"=>"Mercy"],
    ["ref"=>"Matthew 6:25–34","title"=>"Do Not Worry","text"=>"Therefore I tell you: do not worry about your life — what you will eat or drink — or about your body, what you will wear. Is life not more than food, and the body more than clothing?\n\nLook at the birds of the sky. They do not sow or reap or gather into barns, yet your heavenly Father feeds them. Are you not worth more than they are?\n\nCan any of you add a single hour to your life by worrying?\n\nYour heavenly Father knows what you need. Seek first his kingdom and his righteousness, and all these things will be given to you as well.\n\nDo not worry about tomorrow — tomorrow will worry about itself. Each day has enough trouble of its own.","theme"=>"Trust"],
    ["ref"=>"John 10:11–15","title"=>"The Good Shepherd","text"=>"I am the good shepherd. The good shepherd lays down his life for the sheep.\n\nA hired hand, who is not the shepherd and does not own the sheep, sees the wolf coming and abandons the sheep and runs away. The wolf attacks and scatters them. He runs away because he is a hired hand and does not care for the sheep.\n\nI am the good shepherd. I know my own and my own know me — just as the Father knows me and I know the Father. And I lay down my life for the sheep.","theme"=>"Shepherd"],
    ["ref"=>"Luke 1:46–55","title"=>"The Magnificat","text"=>"My soul magnifies the Lord, and my spirit rejoices in God my Saviour.\n\nFor he has looked with favour on the lowliness of his servant. From now on all generations will call me blessed, for the Mighty One has done great things for me. Holy is his name.\n\nHis mercy is for those who fear him from generation to generation. He has shown strength with his arm and scattered the proud. He has brought down the powerful from their thrones and lifted up the lowly. He has filled the hungry with good things and sent the rich away empty.\n\nHe has helped his servant Israel, in remembrance of his mercy, according to the promise he made to our ancestors, to Abraham and to his descendants forever.","theme"=>"Praise"],
    ["ref"=>"Matthew 14:22–33","title"=>"Walking on Water","text"=>"When evening came, the boat was far from land, battered by the waves, for the wind was against them. Around three in the morning, Jesus came toward them, walking on the sea. When the disciples saw him walking on the sea, they were terrified and cried out in fear.\n\nBut Jesus spoke to them at once: \"Take heart! It is I. Do not be afraid.\"\n\nPeter answered him, \"Lord, if it is you, command me to come to you on the water.\"\n\nHe said, \"Come.\"\n\nSo Peter got out of the boat and started walking on the water toward Jesus. But when he saw the strong wind, he was afraid, and beginning to sink, he cried out, \"Lord, save me!\"\n\nJesus immediately reached out his hand and caught him. \"You of little faith,\" he said, \"why did you doubt?\"\n\nAnd when they got into the boat, the wind ceased. Those in the boat worshipped him, saying, \"Truly you are the Son of God.\"","theme"=>"Faith"],
    ["ref"=>"Luke 2:8–20","title"=>"The Shepherds at the Manger","text"=>"In the same region there were shepherds staying out in the fields, keeping watch over their flock by night. An angel of the Lord appeared to them, and the glory of the Lord shone around them, and they were terrified.\n\nBut the angel said to them, \"Do not be afraid. I bring you good news of great joy that will be for all the people. Today in the city of David a Saviour has been born to you — he is the Messiah, the Lord. And this will be a sign to you: you will find a baby wrapped in cloths and lying in a manger.\"\n\nSuddenly a great company of the heavenly host appeared with the angel, praising God and saying, \"Glory to God in the highest, and on earth peace to those on whom his favour rests.\"\n\nThe shepherds said to one another, \"Let us go to Bethlehem and see this thing that has happened.\" They hurried off and found Mary and Joseph, and the baby lying in the manger.\n\nThe shepherds returned, glorifying and praising God for all they had heard and seen.","theme"=>"Joy"],
    ["ref"=>"John 11:17–27","title"=>"I Am the Resurrection","text"=>"When Jesus arrived, he found that Lazarus had already been in the tomb four days.\n\nWhen Martha heard that Jesus was coming, she went and met him. \"Lord,\" she said, \"if you had been here, my brother would not have died. But even now I know that God will give you whatever you ask.\"\n\nJesus said to her, \"Your brother will rise again.\"\n\nMartha replied, \"I know he will rise again in the resurrection at the last day.\"\n\nJesus said to her, \"I am the resurrection and the life. Whoever believes in me, though they die, yet shall they live, and everyone who lives and believes in me shall never die. Do you believe this?\"\n\nShe said to him, \"Yes, Lord. I believe that you are the Christ, the Son of God, who is coming into the world.\"","theme"=>"Resurrection"],
    ["ref"=>"Luke 10:38–42","title"=>"Mary and Martha","text"=>"As Jesus and his disciples were on their way, he came to a village where a woman named Martha opened her home to him. She had a sister called Mary, who sat at the Lord's feet listening to what he said.\n\nBut Martha was distracted by all the preparations that had to be made. She came to him and asked, \"Lord, don't you care that my sister has left me to do the work by myself? Tell her to help me!\"\n\n\"Martha, Martha,\" the Lord answered, \"you are worried and upset about many things, but few things are needed — or indeed only one. Mary has chosen what is better, and it will not be taken away from her.\"","theme"=>"Stillness"],
    ["ref"=>"Mark 6:45–52","title"=>"Jesus Walks on the Sea","text"=>"Immediately Jesus made his disciples get into the boat and go ahead of him across the water to Bethsaida, while he dismissed the crowd. After sending them away, he went up the mountain to pray.\n\nWhen evening came, the boat was in the middle of the sea, and he was alone on the land. He saw them struggling at the oars, because the wind was against them. Around the fourth watch of the night, he came to them, walking on the sea.\n\nBut when they saw him walking on the sea, they thought it was a ghost, and they cried out in fear. They all saw him and were terrified. But immediately he spoke to them: \"Take heart! It is I. Do not be afraid.\"\n\nThen he got into the boat with them, and the wind stopped. They were completely astonished, for they had not understood about the loaves — their hearts were hardened.","theme"=>"Presence"],
    ["ref"=>"John 2:1–11","title"=>"Wedding at Cana","text"=>"On the third day there was a wedding at Cana in Galilee, and the mother of Jesus was there. Jesus and his disciples were also invited.\n\nWhen the wine ran out, the mother of Jesus said to him, \"They have no wine.\"\n\nJesus said to her, \"Woman, what does this have to do with me? My hour has not yet come.\"\n\nHis mother said to the servants, \"Do whatever he tells you.\"\n\nThere were six stone water jars set out for Jewish purification rites, each holding twenty to thirty gallons. Jesus said to the servants, \"Fill the jars with water.\" They filled them to the brim. Then he said, \"Now draw some out and take it to the master of the banquet.\"\n\nWhen the master of the banquet tasted the water that had been turned into wine, he did not know where it came from. He called the bridegroom and said, \"Everyone serves the good wine first, and then the cheaper wine after people have drunk freely. But you have kept the good wine until now.\"\n\nThis, the first of his signs, Jesus did at Cana in Galilee and revealed his glory.","theme"=>"Abundance"],
];

$dayOfYear = (int)date('z');
$passage = $passages[$dayOfYear % count($passages)];

$themeColors = [
    "Love"=>"#b03030","Beatitude"=>"#7b3f9e","Mercy"=>"#1a6fa0",
    "Trust"=>"#1e7a3e","Shepherd"=>"#126d5e","Praise"=>"#c05a14",
    "Faith"=>"#2c3e50","Joy"=>"#c0392b","Resurrection"=>"#5b2a72",
    "Stillness"=>"#1a6e3a","Presence"=>"#17406e","Abundance"=>"#d48a0a",
];
$accent = $themeColors[$passage['theme']] ?? '#444';
$paragraphs = explode("\n\n", trim($passage['text']));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lectio Divina &mdash; <?= htmlspecialchars($passage['ref']) ?></title>
<style>
*,*::before,*::after{box-sizing:border-box}
:root{--a:<?= $accent ?>;--bg:#faf9f6;--card:#fff;--border:#e5e2d8;--muted:#666;--r:14px}
body{margin:0;padding:0;background:var(--bg);font-family:Georgia,serif;color:#1a1a1a;min-height:100vh}
.hdr{background:var(--a);color:#fff;text-align:center;padding:32px 20px 26px}
.hdr .lbl{font:600 .65em/1 system-ui,sans-serif;letter-spacing:3px;text-transform:uppercase;opacity:.8;margin-bottom:8px}
.hdr h1{margin:0 0 6px;font-size:1.9em;font-weight:normal;font-style:italic}
.hdr .ref{font:0.85em system-ui,sans-serif;opacity:.88}
.badge{display:inline-block;background:rgba(255,255,255,.18);border-radius:20px;padding:3px 14px;font:600 .68em/2 system-ui,sans-serif;letter-spacing:1.5px;text-transform:uppercase;margin-top:10px}
.wrap{max-width:640px;margin:0 auto;padding:0 16px 64px}
.picker-row{display:flex;align-items:center;justify-content:space-between;font:0.8em system-ui,sans-serif;color:var(--muted);margin:22px 0 10px}
.picker{border:1px solid var(--border);border-radius:8px;padding:6px 10px;background:#fff;font:0.9em system-ui,sans-serif;max-width:200px}
.tabs{display:flex;gap:6px;margin-bottom:8px;overflow-x:auto;scrollbar-width:none}
.tabs::-webkit-scrollbar{display:none}
.tab{flex:1;min-width:70px;background:#f0ede6;border:2px solid transparent;border-radius:10px;padding:10px 4px;cursor:pointer;text-align:center;transition:all .2s;font-family:system-ui,sans-serif}
.tab .tn{display:block;font-size:.58em;color:var(--muted);letter-spacing:1.2px;text-transform:uppercase;margin-bottom:2px}
.tab .nm{display:block;font-size:.82em;font-weight:700;color:#333}
.tab.active{background:#fff;border-color:var(--a);box-shadow:0 2px 10px rgba(0,0,0,.1)}
.tab.active .nm{color:var(--a)}
.tab.done .tn::after{content:' ✓';color:var(--a)}
.dots{display:flex;justify-content:center;gap:8px;margin:4px 0 18px}
.dot{width:8px;height:8px;border-radius:50%;background:var(--border);transition:background .2s}
.dot.done{background:var(--a);opacity:.45}
.dot.on{background:var(--a)}
.panel{display:none}
.panel.active{display:block}
.note{background:#fffbef;border:1px solid #ece5b8;border-radius:10px;padding:15px 18px;font:0.9em/1.65 system-ui,sans-serif;color:#555;margin-bottom:16px}
.note strong{color:var(--a)}
.sc{background:#fff;border-radius:var(--r);padding:22px 20px;border-left:4px solid var(--a);box-shadow:0 2px 14px rgba(0,0,0,.06);margin-bottom:16px}
.sc p{margin:0 0 16px;font-size:1.07em;line-height:1.78;color:#222}
.sc p:last-child{margin:0}
.sc.hl p{line-height:2.1}
.w{cursor:pointer;border-radius:4px;padding:1px 2px;transition:background .15s;display:inline}
.w:hover{background:rgba(0,0,0,.07)}
.w.lit{background:rgba(0,0,0,.1)}
.w.chosen{background:var(--a);color:#fff;border-radius:4px;padding:1px 5px}
.hnote{font:0.82em system-ui,sans-serif;color:var(--muted);text-align:center;margin:8px 0 14px}
.tbox{text-align:center;background:#fff;border-radius:var(--r);padding:22px;box-shadow:0 2px 14px rgba(0,0,0,.06);margin-bottom:16px}
.tlbl{font:.75em/1.5 system-ui,sans-serif;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:4px}
.tdisp{font:200 3.4em/1.1 system-ui,sans-serif;color:var(--a);letter-spacing:-2px;margin:6px 0 14px}
.tbts{display:flex;gap:10px;justify-content:center;flex-wrap:wrap}
.tbtn{background:var(--a);color:#fff;border:none;border-radius:8px;padding:10px 22px;font:.9em system-ui,sans-serif;cursor:pointer;transition:opacity .15s}
.tbtn:hover{opacity:.82}
.tbtn.ol{background:transparent;color:var(--a);border:2px solid var(--a)}
.psets{display:flex;gap:8px;justify-content:center;margin-top:12px;flex-wrap:wrap}
.ps{background:#f0ede6;border:none;border-radius:20px;padding:5px 14px;font:.78em system-ui,sans-serif;cursor:pointer;color:#444}
.ps:hover{background:var(--border)}
.pa{background:#fff;border-radius:var(--r);padding:18px;box-shadow:0 2px 14px rgba(0,0,0,.06);margin-bottom:16px}
.pa textarea{width:100%;border:1px solid var(--border);border-radius:8px;padding:14px;font:1em/1.72 Georgia,serif;color:#1a1a1a;resize:vertical;min-height:140px;background:#faf9f6}
.pa textarea:focus{outline:none;border-color:var(--a)}
.pa textarea::placeholder{color:#bbb;font-style:italic}
.cont{background:var(--a);color:#fff;border-radius:var(--r);padding:28px 22px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,.14);margin-bottom:16px}
.cont .cx{font-size:2.6em;margin-bottom:12px}
.cont p{margin:0;font-style:italic;font-size:1.1em;line-height:1.7;opacity:.95}
.sumcard{background:#fff;border-radius:var(--r);padding:18px 20px;box-shadow:0 2px 14px rgba(0,0,0,.06);margin-bottom:14px}
.sumcard h3{font:.72em/1.5 system-ui,sans-serif;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin:0 0 8px}
#sw{font-style:italic;font-size:1.1em;font-weight:700;color:var(--a);min-height:1.5em}
#sp{font:1em/1.65 Georgia,serif;font-style:italic;color:#444;white-space:pre-wrap;min-height:1.5em}
.navrow{display:flex;gap:10px;margin-top:18px}
.nb{flex:1;background:var(--a);color:#fff;border:none;border-radius:10px;padding:14px;font:.95em/1 system-ui,sans-serif;font-weight:700;cursor:pointer;transition:opacity .15s}
.nb:hover{opacity:.85}
.nb.sec{background:#f0ede6;color:#333}
footer{text-align:center;font:.76em system-ui,sans-serif;color:#bbb;margin-top:28px;padding-bottom:20px}
footer a{color:#bbb}
@media(max-width:400px){.tdisp{font-size:2.8em}.tab .nm{font-size:.75em}}
</style>
</head>
<body>

<div class="hdr">
  <div class="lbl">Lectio Divina</div>
  <h1 id="mt"><?= htmlspecialchars($passage['title']) ?></h1>
  <div class="ref" id="mr"><?= htmlspecialchars($passage['ref']) ?></div>
  <div class="badge" id="mth"><?= htmlspecialchars($passage['theme']) ?></div>
</div>

<div class="wrap">
  <div class="picker-row">
    <span>Today's passage</span>
    <select class="picker" id="ppick" onchange="switchPassage(this.value)">
      <?php foreach($passages as $i=>$p): ?>
      <option value="<?=$i?>"<?=($i===$dayOfYear%count($passages))?' selected':''?>><?=htmlspecialchars($p['ref'])?> &mdash; <?=htmlspecialchars($p['title'])?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="tabs">
    <button class="tab active" id="tab0" onclick="goStep(0)"><span class="tn">I</span><span class="nm">Lectio</span></button>
    <button class="tab" id="tab1" onclick="goStep(1)"><span class="tn">II</span><span class="nm">Meditatio</span></button>
    <button class="tab" id="tab2" onclick="goStep(2)"><span class="tn">III</span><span class="nm">Oratio</span></button>
    <button class="tab" id="tab3" onclick="goStep(3)"><span class="tn">IV</span><span class="nm">Contemplatio</span></button>
  </div>
  <div class="dots">
    <div class="dot on" id="d0"></div>
    <div class="dot" id="d1"></div>
    <div class="dot" id="d2"></div>
    <div class="dot" id="d3"></div>
  </div>

  <!-- Step 0: Lectio -->
  <div class="panel active" id="p0">
    <div class="note"><strong>Lectio &mdash; Read.</strong> Read slowly, once or twice. Let the words land. Don't analyze yet &mdash; just receive.</div>
    <div class="sc" id="ls">
      <?php foreach($paragraphs as $para): ?><p><?=nl2br(htmlspecialchars($para))?></p><?php endforeach; ?>
    </div>
    <div class="tbox">
      <div class="tlbl">Reading time</div>
      <div class="tdisp" id="t0">3:00</div>
      <div class="tbts">
        <button class="tbtn" onclick="startT(0)">Start</button>
        <button class="tbtn ol" onclick="resetT(0)">Reset</button>
      </div>
      <div class="psets">
        <button class="ps" onclick="setT(0,120)">2 min</button>
        <button class="ps" onclick="setT(0,180)">3 min</button>
        <button class="ps" onclick="setT(0,300)">5 min</button>
      </div>
    </div>
    <div class="navrow"><button class="nb" onclick="goStep(1)">Next: Meditatio &rarr;</button></div>
  </div>

  <!-- Step 1: Meditatio -->
  <div class="panel" id="p1">
    <div class="note"><strong>Meditatio &mdash; Meditate.</strong> Read again slowly. <strong>Tap a word or phrase</strong> that catches your attention &mdash; one that shines, stirs, or troubles you. You don't need to know why.</div>
    <div class="sc hl" id="ms"></div>
    <div class="hnote" id="chlbl">No word chosen yet.</div>
    <div class="tbox">
      <div class="tlbl">Meditation time</div>
      <div class="tdisp" id="t1">5:00</div>
      <div class="tbts">
        <button class="tbtn" onclick="startT(1)">Start</button>
        <button class="tbtn ol" onclick="resetT(1)">Reset</button>
      </div>
      <div class="psets">
        <button class="ps" onclick="setT(1,180)">3 min</button>
        <button class="ps" onclick="setT(1,300)">5 min</button>
        <button class="ps" onclick="setT(1,600)">10 min</button>
      </div>
    </div>
    <div class="navrow">
      <button class="nb sec" onclick="goStep(0)">&larr; Back</button>
      <button class="nb" onclick="goStep(2)">Next: Oratio &rarr;</button>
    </div>
  </div>

  <!-- Step 2: Oratio -->
  <div class="panel" id="p2">
    <div class="note"><strong>Oratio &mdash; Pray.</strong> Speak to God about what stirred in you. What does this passage awaken? Write a prayer, or simply let it sit.</div>
    <div class="pa"><textarea id="pt" placeholder="Lord, as I sit with these words&#8230;"></textarea></div>
    <div class="tbox">
      <div class="tlbl">Prayer time</div>
      <div class="tdisp" id="t2">5:00</div>
      <div class="tbts">
        <button class="tbtn" onclick="startT(2)">Start</button>
        <button class="tbtn ol" onclick="resetT(2)">Reset</button>
      </div>
      <div class="psets">
        <button class="ps" onclick="setT(2,180)">3 min</button>
        <button class="ps" onclick="setT(2,300)">5 min</button>
        <button class="ps" onclick="setT(2,600)">10 min</button>
      </div>
    </div>
    <div class="navrow">
      <button class="nb sec" onclick="goStep(1)">&larr; Back</button>
      <button class="nb" onclick="goStep(3)">Next: Contemplatio &rarr;</button>
    </div>
  </div>

  <!-- Step 3: Contemplatio -->
  <div class="panel" id="p3">
    <div class="note"><strong>Contemplatio &mdash; Rest.</strong> Now: be still. No words needed, no thoughts to produce. Rest in God's presence with open hands.</div>
    <div class="cont">
      <div class="cx">&#10013;</div>
      <p>&ldquo;Be still and know that I am God.&rdquo;<br><small style="opacity:.72">&mdash; Psalm 46:10</small></p>
    </div>
    <div class="tbox">
      <div class="tlbl">Silence</div>
      <div class="tdisp" id="t3">5:00</div>
      <div class="tbts">
        <button class="tbtn" onclick="startT(3)">Begin silence</button>
        <button class="tbtn ol" onclick="resetT(3)">Reset</button>
      </div>
      <div class="psets">
        <button class="ps" onclick="setT(3,180)">3 min</button>
        <button class="ps" onclick="setT(3,300)">5 min</button>
        <button class="ps" onclick="setT(3,600)">10 min</button>
      </div>
    </div>
    <div class="sumcard"><h3>Your word</h3><div id="sw">&mdash;</div></div>
    <div class="sumcard"><h3>Your prayer</h3><div id="sp">&mdash;</div></div>
    <div class="navrow">
      <button class="nb sec" onclick="goStep(2)">&larr; Back</button>
      <button class="nb" onclick="location.reload()">Begin again &circlearrowleft;</button>
    </div>
  </div>
</div>

<footer>Built by <a href="./">Chloe Reads Jon</a> &middot; Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2026/01/a-fresh-catholic-bible-translation.html">Douai-AI post</a></footer>

<script>
const passages=<?php echo json_encode($passages,JSON_UNESCAPED_UNICODE|JSON_HEX_TAG); ?>;
let curPass=<?= $dayOfYear%count($passages) ?>;
let chosenWord='';
let curStep=0;

// Timers
const tState=[[180,null,false],[300,null,false],[300,null,false],[300,null,false]];
const tDef=[180,300,300,300];
function fmt(s){const m=Math.floor(s/60),sec=s%60;return m+':'+(sec<10?'0':'')+sec}
function updT(i){document.getElementById('t'+i).textContent=fmt(tState[i][0])}
function startT(i){
  if(tState[i][2])return;
  tState[i][2]=true;
  tState[i][1]=setInterval(()=>{
    if(tState[i][0]<=0){clearInterval(tState[i][1]);tState[i][2]=false;bell();return}
    tState[i][0]--;updT(i);
  },1000);
}
function resetT(i){clearInterval(tState[i][1]);tState[i][2]=false;tState[i][0]=tDef[i];updT(i)}
function setT(i,s){clearInterval(tState[i][1]);tState[i][2]=false;tState[i][0]=s;tDef[i]=s;updT(i)}
function bell(){
  try{
    const ctx=new(window.AudioContext||window.webkitAudioContext)();
    const o=ctx.createOscillator(),g=ctx.createGain();
    o.connect(g);g.connect(ctx.destination);
    o.frequency.value=528;o.type='sine';
    g.gain.setValueAtTime(.4,ctx.currentTime);
    g.gain.exponentialRampToValueAtTime(.001,ctx.currentTime+3);
    o.start();o.stop(ctx.currentTime+3);
  }catch(e){}
}

// Steps
const stepDone=[false,false,false,false];
function goStep(n){
  stepDone[curStep]=true;
  ['tab','p','d'].forEach(pfx=>{
    const el=document.getElementById(pfx+curStep);
    el.classList.remove('active');
    if(pfx==='d'){el.classList.add('done')}
    if(pfx==='tab'&&stepDone[curStep]){el.classList.add('done')}
  });
  curStep=n;
  ['tab','p','d'].forEach(pfx=>{
    const el=document.getElementById(pfx+n);
    el.classList.add('active');
    if(pfx==='d'){el.classList.remove('done')}
    if(pfx==='tab'){el.classList.remove('done')}
  });
  if(n===3){
    document.getElementById('sw').textContent=chosenWord||'\u2014';
    const pr=document.getElementById('pt').value.trim();
    document.getElementById('sp').textContent=pr||'\u2014';
  }
  window.scrollTo({top:0,behavior:'smooth'});
}

// Build meditatio
function buildMed(passage){
  const c=document.getElementById('ms');c.innerHTML='';
  passage.text.split('\n\n').forEach(para=>{
    const p=document.createElement('p');
    para.split(/(\s+)/).forEach(tok=>{
      if(/^\s+$/.test(tok)){p.appendChild(document.createTextNode(tok));return}
      const s=document.createElement('span');s.className='w';s.textContent=tok;
      s.addEventListener('click',()=>{
        document.querySelectorAll('.w.chosen').forEach(w=>w.classList.remove('chosen'));
        s.classList.add('chosen');
        chosenWord=tok.replace(/[^\w\u2019'''-]/g,'');
        document.getElementById('chlbl').textContent='\u2726 Your word: \u201c'+chosenWord+'\u201d';
      });
      s.addEventListener('mouseover',()=>s.classList.add('lit'));
      s.addEventListener('mouseout',()=>s.classList.remove('lit'));
      p.appendChild(s);
    });
    c.appendChild(p);
  });
}

function buildLect(passage){
  const c=document.getElementById('ls');c.innerHTML='';
  passage.text.split('\n\n').forEach(para=>{
    const p=document.createElement('p');p.textContent=para;c.appendChild(p);
  });
}

function switchPassage(idx){
  idx=parseInt(idx);curPass=idx;
  const pass=passages[idx];
  document.getElementById('mt').textContent=pass.title;
  document.getElementById('mr').textContent=pass.ref;
  document.getElementById('mth').textContent=pass.theme;
  buildLect(pass);buildMed(pass);
  chosenWord='';
  document.getElementById('chlbl').textContent='No word chosen yet.';
  goStep(0);
}

buildMed(passages[curPass]);
</script>
</body>
</html>
