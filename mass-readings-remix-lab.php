<?php
$today = new DateTime('now');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mass Readings Remix Lab</title>
<style>
:root{--ink:#1c1a17;--paper:#f4ecdc;--gold:#c78a2c;--wine:#6d1f2f;--moss:#3b5c48;--sky:#8fb8c9;--card:#fff9ee}
*{box-sizing:border-box}
body{margin:0;color:var(--ink);font-family:"Trebuchet MS","Gill Sans",sans-serif;background:radial-gradient(1200px 600px at 10% -10%,#ffe8bb 0%,transparent 60%),radial-gradient(900px 500px at 100% 0%,#d7e8f0 0%,transparent 65%),repeating-linear-gradient(45deg,rgba(0,0,0,.02) 0 2px,transparent 2px 8px),var(--paper);min-height:100vh}
.wrap{width:min(960px,92vw);margin:0 auto;padding:28px 0 50px}
.hero{border:2px solid #0000001a;background:linear-gradient(160deg,var(--card),#fff3d9);border-radius:22px;padding:24px;box-shadow:0 18px 40px #0000001c;position:relative;overflow:hidden}
.hero:after{content:"";position:absolute;inset:auto -80px -80px auto;width:220px;height:220px;border-radius:50%;background:radial-gradient(circle,#c78a2c44,transparent 70%)}
h1{margin:0;font-size:clamp(1.9rem,4.8vw,3.2rem);font-family:"Palatino Linotype","Book Antiqua",serif;letter-spacing:.02em}
.subtitle{margin:10px 0 0;max-width:68ch;line-height:1.45}
.badges{display:flex;gap:10px;margin-top:16px;flex-wrap:wrap}
.badge{border:1px solid #00000020;background:#ffffffcf;border-radius:999px;padding:7px 11px;font-size:.9rem}
.grid{margin-top:22px;display:grid;gap:14px;grid-template-columns:repeat(12,minmax(0,1fr))}
.panel{border:1px solid #0000001f;border-radius:16px;padding:16px;background:#fffdf8e6}
.panel h2{margin:0 0 10px;font-size:1.15rem;font-family:"Palatino Linotype","Book Antiqua",serif}
.controls{grid-column:span 12}.mix{grid-column:span 7}.output{grid-column:span 5}
label{display:block;font-weight:700;font-size:.9rem;margin:12px 0 6px}
select,input[type="range"]{width:100%}
select{border:1px solid #00000030;border-radius:10px;padding:10px;background:white}
input[type="range"]{accent-color:var(--wine)}
.row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
button{margin-top:14px;border:none;border-radius:12px;background:linear-gradient(90deg,var(--wine),#8e2e45);color:white;font-weight:700;padding:12px 14px;cursor:pointer;box-shadow:0 8px 20px #6d1f2f42}
button:hover{filter:brightness(1.06)}
.track{height:14px;border-radius:999px;background:#00000012;overflow:hidden;margin-top:8px}
.track>div{height:100%;width:0%;background:linear-gradient(90deg,var(--moss),var(--sky),var(--gold));transition:width .45s ease}
.plan{margin-top:10px;padding:10px;border-radius:12px;background:#fff;border:1px dashed #0000002e;line-height:1.45}
.chips{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
.chip{padding:6px 10px;border-radius:999px;font-size:.82rem;background:#f3e8cf}
.small{font-size:.88rem;color:#4f4a42}
@media (max-width:860px){.mix,.output{grid-column:span 12}}
</style>
</head>
<body>
<div class="wrap">
<section class="hero">
<h1>Mass Readings Remix Lab</h1>
<p class="subtitle">Build a custom listening ritual for daily Mass readings. Mix pace, ambience, and reflection style, then generate a tiny "audio liturgy plan" you can actually follow this week.</p>
<div class="badges">
<div class="badge">Today: <?php echo htmlspecialchars($today->format('l, F j, Y')); ?></div>
<div class="badge">Mode: Micro-Retreat</div>
<div class="badge">Focus: Attention over speed</div>
</div>
</section>
<section class="grid">
<div class="panel controls">
<h2>Remix Console</h2>
<div class="row">
<div>
<label for="window">Listening Window</label>
<select id="window">
<option value="morning">Morning reset (6-9 AM)</option>
<option value="lunch">Lunch reset (12-1 PM)</option>
<option value="evening">Evening wind-down (8-10 PM)</option>
</select>
</div>
<div>
<label for="energy">Energy Today</label>
<select id="energy">
<option value="low">Low: keep it gentle</option>
<option value="steady" selected>Steady: moderate pace</option>
<option value="high">High: deeper challenge</option>
</select>
</div>
</div>
<label for="reflection">Reflection Intensity</label>
<input id="reflection" type="range" min="1" max="5" value="3">
<label for="music">Psalm Singing Flavor</label>
<select id="music">
<option value="plainchant">Plainchant calm</option>
<option value="cathedral">Cathedral bright</option>
<option value="folk">Simple folk warmth</option>
</select>
<button id="generate">Generate Today's Plan</button>
<p class="small">Tip: regenerate if your day changes. The plan adapts.</p>
</div>
<div class="panel mix">
<h2>Attention Meter</h2>
<div class="small">Predicted fit for your current state</div>
<div class="track"><div id="meter"></div></div>
<div id="scoreText" class="plan">Generate a plan to see your score.</div>
<div class="chips" id="chips"></div>
</div>
<div class="panel output">
<h2>Audio Liturgy Card</h2>
<div id="card" class="plan">No plan yet.</div>
</div>
</section>
</div>
<script>
const rhythm={morning:"Start with the Gospel first, then circle back to the first reading.",lunch:"Listen in one pass, then take a 90-second pause before the psalm.",evening:"Dim screens, slow breathing, and let the psalm lead the pace."};
const energyMap={low:{mins:8,pulse:58,mantra:"Keep it tiny and faithful."},steady:{mins:14,pulse:66,mantra:"Solid middle pace."},high:{mins:20,pulse:74,mantra:"Go deeper with journaling."}};
const musicColor={plainchant:"#3b5c48",cathedral:"#8fb8c9",folk:"#c78a2c"};
function generatePlan(){
const windowV=document.getElementById("window").value;
const energy=document.getElementById("energy").value;
const reflection=Number(document.getElementById("reflection").value);
const music=document.getElementById("music").value;
const base=energyMap[energy];
const minutes=base.mins+(reflection-3)*2;
const score=Math.max(48,Math.min(98,Math.round(base.pulse+reflection*5+(windowV==="morning"?7:0))));
document.getElementById("meter").style.width=score+"%";
document.getElementById("meter").style.background="linear-gradient(90deg,#3b5c48,"+musicColor[music]+",#6d1f2f)";
const question=reflection>=4?"Where did this reading confront me, not just comfort me?":"What one phrase should I carry into the next hour?";
document.getElementById("scoreText").innerHTML="<strong>"+score+"% match</strong><br>"+base.mantra+" "+rhythm[windowV];
document.getElementById("card").innerHTML="<strong>"+minutes+"-minute plan</strong><br>1) 60 seconds of silence<br>2) Daily readings audio ("+Math.max(5,minutes-4)+" min)<br>3) Repeat psalm once in "+music.replace("-"," ")+" mood<br>4) Reflection prompt: &quot;"+question+"&quot;<br>5) Close with one gratitude sentence";
const chips=[windowV==="morning"?"Sunrise cadence":(windowV==="lunch"?"Midday reset":"Night quiet"),energy==="low"?"Low-friction":(energy==="steady"?"Steady focus":"Deep-dive"),"Reflection x"+reflection];
document.getElementById("chips").innerHTML=chips.map(function(c){return '<span class="chip">'+c+'</span>';}).join("");
}
document.getElementById("generate").addEventListener("click",generatePlan);
generatePlan();
</script>
</body>
</html>
