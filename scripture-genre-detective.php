<?php
// The source address lives in the gallery entry; every URL in this page stays relative.
if (isset($_GET['source'])) {
    $index = @file_get_contents(__DIR__ . '/index.php');
    if ($index && preg_match('~<li>\s*<div class="entry-title"><a href="scripture-genre-detective.php">.*?</li>~s', $index, $entry)
        && preg_match('~Inspired by Jon\x27s <a href="([^"]+)">~', $entry[0], $link)) {
        header('Location: ' . html_entity_decode($link[1], ENT_QUOTES, 'UTF-8'), true, 302);
        exit;
    }
    http_response_code(503);
    exit('The source link is temporarily unavailable. Please return to the gallery.');
}
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#173d32">
<title>Between the Lines | Scripture Genre Detective</title>
<style>
@font-face{font-family:Reader;src:url('assets/scripture-reader.ttf') format('truetype');font-display:swap}
:root{--paper:#f6f1e5;--ink:#173d32;--faint:#526458;--gold:#d5ab54;--line:#b8bead;--white:#fffdf6}
*{box-sizing:border-box}html{background:var(--paper);color:var(--ink);scrollbar-color:var(--ink) var(--paper)}body{margin:0;font:17px/1.6 'Trebuchet MS',sans-serif}::selection{background:var(--gold);color:var(--ink)}a{color:inherit;text-underline-offset:5px}button{font:inherit;cursor:pointer;touch-action:manipulation}button,a{ -webkit-tap-highlight-color:transparent}button:focus-visible,a:focus-visible,summary:focus-visible{outline:3px solid #a34a25;outline-offset:5px}button:disabled{cursor:default}header{background:var(--ink);color:var(--paper);padding:20px max(22px,calc((100vw - 1120px)/2));display:flex;justify-content:space-between;gap:16px;font-size:.85rem}header a{min-height:44px;display:flex;align-items:center}header span{align-self:center}main{max-width:1120px;margin:auto;padding:34px 24px 60px}h1,h2,blockquote{font-family:Reader,Georgia,serif}h1{font-size:clamp(2.9rem,7vw,5.6rem);font-weight:500;line-height:1.02;letter-spacing:-.035em;margin:0 0 16px;text-wrap:balance}.intro{max-width:650px;margin:0 0 30px;color:var(--faint)}.game{border-top:2px solid var(--ink);display:grid;grid-template-columns:1.15fr 1fr;gap:0}.reading{padding:24px 36px 30px 0;border-right:1px solid var(--line)}.status{display:flex;justify-content:space-between;font-size:.85rem;font-variant-numeric:tabular-nums;gap:10px}.marks{display:flex;gap:5px;margin:16px 0 28px}.marks span{height:6px;flex:1;background:#d6dbcc}.marks .done{background:var(--ink)}.marks .current{background:#a34a25}blockquote{font-size:clamp(1.5rem,3.1vw,2.25rem);line-height:1.4;margin:0 0 18px;min-height:185px}cite{font-style:normal;font-size:.88rem;color:var(--faint)}.choose{padding:24px 0 28px 36px}h2{font-size:1.6rem;line-height:1.25;font-weight:500;margin:0 0 20px}.choices{display:grid;grid-template-columns:1fr 1fr;gap:9px}.choices button{background:transparent;border:1px solid var(--ink);color:var(--ink);padding:13px 9px;text-align:left;min-height:52px}.choices button:hover:not(:disabled){background:#e5e8d9}.choices button.selected{background:var(--ink);color:var(--paper)}.choices button.correct{border:2px solid var(--ink);padding:12px 8px;background:#e1e8d5}.choices button.selected.correct{background:var(--ink);color:var(--paper)}.choices button:disabled:not(.selected):not(.correct){opacity:.55}.clue-row{display:flex;gap:18px;align-items:center;margin-top:18px}.text-button{border:0;border-bottom:1px solid currentColor;background:transparent;color:var(--ink);min-height:44px;padding:5px 0}.clue-note{color:var(--faint);font-size:.8rem}.art{margin:20px 0 0;overflow:hidden}.scene{aspect-ratio:1;background-image:url('assets/scripture-six-lenses.webp');background-size:300% 200%;background-color:#e3e6d5}.art figcaption{font-size:.8rem;margin-top:7px;color:var(--faint)}.feedback{border-top:1px solid var(--line);margin-top:22px;padding-top:20px}.feedback h3{font-family:Reader,Georgia,serif;font-size:1.65rem;font-weight:500;margin:0 0 8px}.feedback p{margin:0 0 14px}.lens{color:var(--faint)}.next{background:var(--ink);color:var(--paper);border:0;min-height:48px;padding:12px 23px}.next:hover{background:#285845}.end{padding:30px 0}.end h2{font-size:2.5rem}.end p{max-width:65ch}.review{padding:0;list-style:none;max-width:760px}.review li{padding:15px 0;border-bottom:1px solid var(--line)}.review strong{display:block}.reference{margin-top:36px;border-top:1px solid var(--line);padding-top:22px;max-width:760px}summary{cursor:pointer;min-height:44px;font-weight:bold}.reference dl{display:grid;grid-template-columns:130px 1fr;gap:12px 20px}.reference dt{font-weight:bold}.reference dd{margin:0;color:var(--faint)}footer{margin-top:44px;max-width:75ch;color:var(--faint);font-size:.85rem}footer p{margin:12px 0}[hidden]{display:none!important}@keyframes reveal{from{clip-path:inset(0 100% 0 0)}to{clip-path:inset(0)}}.art:not([hidden]){animation:reveal .6s cubic-bezier(.16,1,.3,1)}
@media(max-width:700px){header{padding:12px 20px}header span{max-width:120px;text-align:right}main{padding:28px 20px 44px}h1{font-size:3.5rem}.intro{font-size:.96rem;margin-bottom:24px}.game{display:block}.reading{border:0;padding:18px 0 24px}.marks{margin:12px 0 22px}blockquote{min-height:0;font-size:1.65rem}.choose{padding:20px 0;border-top:1px solid var(--line)}h2{font-size:1.4rem;margin-bottom:16px}.reference dl{grid-template-columns:1fr;gap:3px}.reference dd{margin-bottom:14px}.scene{max-height:260px}.clue-row{gap:14px}}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation:none!important;scroll-behavior:auto!important}}
</style>
</head>
<body>
<header><a href="./">Chloe Reads Jon</a><span>A reading game for curious minds</span></header>
<main>
<h1>Between the Lines</h1>
<p class="intro">A song, a letter, a vision. Scripture has many voices. Can you hear which one is speaking? Twelve passages, no timer, and a little help in the margins.</p>
<section id="game" class="game" aria-label="Scripture genre challenge">
<div class="reading">
<div class="status"><span id="round"></span><span id="score"></span></div>
<div id="marks" class="marks" aria-hidden="true"></div>
<blockquote id="passage"></blockquote>
<cite id="reference"></cite>
<figure id="art" class="art" hidden><div id="scene" class="scene" role="img"></div><figcaption id="caption"></figcaption></figure>
</div>
<div class="choose">
<h2 id="question">What kind of writing is this?</h2>
<div id="choices" class="choices" role="group" aria-labelledby="question"></div>
<div class="clue-row"><button id="clue" class="text-button">Show a picture clue</button><span class="clue-note">For when the words play hard to get.</span></div>
<div id="feedback" class="feedback" hidden aria-live="polite"><h3 id="verdict"></h3><p id="explanation"></p><p id="lens" class="lens"></p><button id="next" class="next">Next passage</button></div>
</div>
</section>
<section id="end" class="end" hidden aria-labelledby="end-title"><h2 id="end-title" tabindex="-1">A whole library of voices.</h2><p id="result"></p><p>Knowing the genre helps us ask better questions. A poem's image, a parable's surprise, and a letter's advice each deserve to be heard on their own terms.</p><ul id="review" class="review"></ul><button id="restart" class="next">Play again, shuffled</button></section>
<details class="reference"><summary>Keep a little genre guide nearby</summary><dl id="guide"></dl></details>
<footer><p>These short passages are retellings for the game, not Bible quotations. References use common modern numbering (Psalm 23 is Psalm 22 in the Douay-Rheims). Genres can overlap; each answer identifies the dominant form of the selected passage.</p><p>Inspired by Jon's <a href="?source=1">A couple of pages from A Catholic Commentary on Holy Scripture</a>. The reading notes here were written for this game; they are not excerpts from the 1953 commentary.</p></footer>
<noscript><p>Please enable JavaScript to play. The game includes picture clues and notes about six literary genres.</p></noscript>
</main>
<script>
'use strict';
const genres=[
{name:'Poetry',guide:'Listen for imagery, repetition, and parallel lines. A metaphor tells a truth without being a photograph.',image:0,alt:'An engraved shepherd and flock beneath a starry sky.'},
{name:'Parable',guide:'A teaching story. Look for the surprising turn and the response it asks of its hearers.',image:1,alt:'An engraved sower scattering seed along a country path.'},
{name:'Letter',guide:'Words sent to particular people. Ask who is writing, to whom, and what situation they are addressing.',image:2,alt:'An early Christian writer working with a quill and parchment.'},
{name:'Law',guide:'Commands that order the life of a covenant people. Ask who is addressed and how the command fits the covenant.',image:3,alt:'Two stone tablets in a rocky desert.'},
{name:'Narrative',guide:'Events told as a story. Follow the people, actions, setting, and consequences.',image:4,alt:'A traveler leaving an ancient city through its gate at dawn.'},
{name:'Apocalyptic vision',guide:'Revelation through vivid symbols. Attend to biblical echoes, hope, and faithfulness rather than treating it as a code for headlines.',image:5,alt:'A radiant symbolic city above a dark sea, with seven lamps.'}
];
const passages=[
{g:0,ref:'Psalm 23:1–3',text:'The Lord is my shepherd. I lack nothing. He brings me to green pastures and still waters, and restores my soul.',why:'The shepherd and the restful landscape express trust through images. This is a psalm, a prayer shaped as poetry.',lens:'Try this lens: what does being shepherded tell you about God’s care?'},
{g:1,ref:'Luke 10:30–37',text:'A traveler is robbed and left wounded. Two religious men pass by. A Samaritan stops, tends his wounds, and pays for his care. Who acted as a neighbor?',why:'Jesus tells a story whose unexpected helper challenges the listener. It answers a moral question by making us see a person differently.',lens:'Try this lens: notice how “Who is my neighbor?” becomes “Will I be a neighbor?”'},
{g:2,ref:'Philemon 1:10–17',text:'I appeal to you for Onesimus. Receive him no longer merely as a slave, but as a beloved brother. If you consider me a partner, welcome him as you would welcome me.',why:'Paul addresses Philemon about a particular person and makes a personal appeal. The relationship and the occasion matter.',lens:'Try this lens: how does calling someone a brother change the appeal?'},
{g:3,ref:'Deuteronomy 24:19',text:'When you harvest your field and forget a sheaf, do not go back for it. Leave it for the foreigner, the orphan, and the widow.',why:'This is an instruction to Israel about its shared life. Even harvesting is ordered toward care for vulnerable neighbors.',lens:'Try this lens: what value does the command protect, and who would otherwise be overlooked?'},
{g:4,ref:'Mark 4:35–41',text:'As evening comes, Jesus and his disciples cross the lake. A storm breaks over the boat. He is asleep. They wake him, and he commands the wind and the sea to be still.',why:'The passage narrates a sequence of events involving Jesus and his disciples. Vivid imagery alone does not make a passage poetry.',lens:'Try this lens: follow the disciples’ fear, then their question about who Jesus is.'},
{g:5,ref:'Revelation 21:1–4',text:'I saw a new heaven and a new earth, and the holy city coming down from God. A voice announced that God would dwell with his people and wipe away every tear.',why:'John describes a vision in symbolic, prophetic language. The city and the renewed creation announce God’s final victory and presence.',lens:'Try this lens: start with the promise of God’s presence, rather than a timetable.'},
{g:0,ref:'Psalm 114:3–6',text:'The sea saw and fled; the Jordan turned back. Mountains skipped like rams, and hills like lambs. What made you flee, O sea?',why:'The psalm poetically celebrates the Exodus. Personification and parallel lines give the event a voice of wonder.',lens:'Try this lens: a mountain need not literally hop for the poem to express creation’s awe.'},
{g:1,ref:'Matthew 13:3–9, 18–23',text:'A sower scatters seed. Some falls on a path, some on rocky ground, some among thorns, and some on good soil, where it bears a great harvest.',why:'The story uses an ordinary action to teach about receiving the word. Jesus later explains how the different soils illuminate different responses.',lens:'Try this lens: where is the story inviting self-examination rather than farming advice?'},
{g:2,ref:'Philippians 1:1–6',text:'Paul and Timothy greet the holy ones in Philippi with grace and peace. I thank God whenever I remember you, confident that he who began a good work in you will bring it to completion.',why:'Named senders, named recipients, a greeting, and thanksgiving are clues to an ancient letter.',lens:'Try this lens: hear this encouragement first as words to a real community.'},
{g:3,ref:'Exodus 20:8–10',text:'Remember the sabbath day and keep it holy. Six days you shall labor, but the seventh is a sabbath to the Lord. Your household, servants, animals, and the foreigner are to rest.',why:'This is a covenant command in the Decalogue, setting a pattern for worship and rest for the whole household.',lens:'Try this lens: notice who receives rest, including those who might not control their own work.'},
{g:4,ref:'Luke 19:1–10',text:'Zacchaeus climbs a sycamore tree to see Jesus. Jesus looks up and calls him down, saying he will stay at his house. Zacchaeus welcomes him joyfully and promises restitution.',why:'Luke tells an encounter with named people, a place, and unfolding actions. It is narrated as an event, not introduced as a teaching parable.',lens:'Try this lens: watch how being welcomed leads to a change in conduct.'},
{g:5,ref:'Revelation 1:12–20',text:'I turned and saw seven golden lampstands. Among them stood one like a son of man. In his right hand he held seven stars, and his face shone like the sun.',why:'This is a visionary scene. The passage itself explains the lampstands as the seven churches, showing why symbols should be read in context.',lens:'Try this lens: let the text’s own explanation guide you before inventing a meaning.'}
];
const $=id=>document.getElementById(id);
let order=[],at=0,points=0,answers=[],assisted=false,locked=false;
function shuffle(items){const a=[...items];for(let i=a.length-1;i>0;i--){const n=crypto.getRandomValues(new Uint32Array(1))[0]%(i+1);[a[i],a[n]]=[a[n],a[i]]}return a}
function picture(){const g=genres[order[at].g],n=g.image;$('art').hidden=false;$('scene').style.backgroundPosition=(n%3*50)+'% '+(Math.floor(n/3)*100)+'%';$('scene').setAttribute('aria-label',g.alt);$('caption').textContent=locked?'Illustrated reading lens: '+g.name:'Picture clue: which literary voice does this scene suggest?';$('clue').disabled=true}
function draw(){locked=false;assisted=false;const p=order[at];$('round').textContent='Passage '+(at+1)+' of '+order.length;$('score').textContent=points+' first-try finds';$('marks').replaceChildren(...order.map((_,i)=>{const s=document.createElement('span');s.className=i<at?'done':i===at?'current':'';return s}));$('passage').textContent=p.text;$('reference').textContent=p.ref.replaceAll('–',' to ');$('feedback').hidden=true;$('art').hidden=true;$('clue').disabled=false;$('choices').replaceChildren(...genres.map((g,i)=>{const b=document.createElement('button');b.textContent=g.name;b.onclick=()=>answer(i,b);return b}));$('next').textContent=at===order.length-1?'See your reading notes':'Next passage'}
function answer(i,b){if(locked)return;locked=true;const p=order[at],correct=i===p.g;if(correct)points++;answers.push({p,correct,assisted});[...$('choices').children].forEach((v,k)=>{v.disabled=true;if(k===p.g)v.classList.add('correct')});b.classList.add('selected');$('verdict').textContent=correct?'You heard it: '+genres[p.g].name+'.':'Listen again: '+genres[p.g].name+'.';$('explanation').textContent=p.why;$('lens').textContent=p.lens;$('feedback').hidden=false;$('score').textContent=points+' first-try finds';picture()}
$('clue').onclick=()=>{assisted=true;picture()};
$('next').onclick=()=>{at++;if(at<order.length){draw();$('choices').querySelector('button').focus();}else{finish()}};
function finish(){$('game').hidden=true;$('end').hidden=false;const clues=answers.filter(a=>a.assisted).length;$('result').textContent='You identified '+points+' of '+order.length+' voices on your first try'+(clues?', with '+clues+' picture '+(clues===1?'clue.':'clues.'):'.')+' Every passage adds another way to listen.';$('review').replaceChildren(...answers.map(a=>{const li=document.createElement('li'),strong=document.createElement('strong'),s=document.createElement('span');strong.textContent=genres[a.p.g].name+' · '+a.p.ref.replaceAll('–',' to ');s.textContent=(a.correct?'Identified. ':'One to revisit. ')+a.p.lens.replace('Try this lens: ','');li.append(strong,s);return li}));$('end-title').focus()}
function start(){order=shuffle(passages);at=0;points=0;answers=[];$('game').hidden=false;$('end').hidden=true;draw()}
$('restart').onclick=()=>{start();$('choices').querySelector('button').focus()};
$('guide').replaceChildren(...genres.flatMap(g=>{const dt=document.createElement('dt'),dd=document.createElement('dd');dt.textContent=g.name;dd.textContent=g.guide;return[dt,dd]}));
start();
</script></body></html>
