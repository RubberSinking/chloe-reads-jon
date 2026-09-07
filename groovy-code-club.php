<?php
$sourceUrl = 'https://jona.ca/2004/08/altlangjre-feeling-groovy.html';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#160f1d">
    <title>Groovy Code Club</title>
    <style>
        :root { --ink:#160f1d; --paper:#f3dfb4; --orange:#f57c26; --cyan:#24c7c8; --cream:#fff3d4; --muted:#aa8e78; }
        * { box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { margin:0; color:var(--cream); background:var(--ink); font-family:Georgia, 'Times New Roman', serif; overflow-x:hidden; }
        body::before { content:""; position:fixed; inset:0; pointer-events:none; z-index:20; opacity:.08; background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.8' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E"); }
        a { color:inherit; }
        button { font:inherit; }
        .shell { width:min(1120px, 100%); margin:auto; padding:18px clamp(16px,4vw,52px) 70px; }
        nav { display:flex; align-items:center; justify-content:space-between; gap:20px; padding:8px 0 26px; font-family:'Courier New', monospace; font-size:.76rem; letter-spacing:.12em; text-transform:uppercase; }
        nav a { text-decoration:none; border-bottom:1px solid transparent; }
        nav a:hover { border-color:var(--cyan); }
        .badge { color:var(--orange); border:1px solid currentColor; padding:7px 10px; transform:rotate(-1deg); }
        .hero { display:grid; grid-template-columns:minmax(0,1.02fr) minmax(300px,.98fr); align-items:center; gap:clamp(24px,6vw,76px); min-height:76vh; }
        .eyebrow { color:var(--cyan); font:bold .75rem/1.2 'Courier New',monospace; letter-spacing:.22em; text-transform:uppercase; margin:0 0 18px; }
        h1 { margin:0; font-size:clamp(4rem,10vw,8.5rem); line-height:.73; letter-spacing:-.075em; font-weight:normal; }
        h1 span { display:block; color:var(--orange); font-style:italic; margin-left:.35em; }
        .lede { max-width:31rem; margin:34px 0 0; color:#d7c0a3; font-size:clamp(1.05rem,2vw,1.26rem); line-height:1.6; }
        .record { position:relative; isolation:isolate; transform:rotate(2deg); }
        .record::before { content:""; position:absolute; inset:-11px; border:1px solid #6a4030; z-index:-1; transform:rotate(-3deg); }
        .record img { width:100%; display:block; border:9px solid #211323; box-shadow:0 30px 90px #0009; filter:saturate(.48) brightness(.42); transition:filter .8s, transform .5s; }
        .record[data-level="1"] img { filter:saturate(.58) brightness(.52); }
        .record[data-level="2"] img { filter:saturate(.7) brightness(.62); }
        .record[data-level="3"] img { filter:saturate(.82) brightness(.72); }
        .record[data-level="4"] img { filter:saturate(.92) brightness(.84); }
        .record[data-level="5"] img { filter:saturate(1.05) brightness(1); transform:scale(1.015); }
        .level { position:absolute; left:-18px; bottom:24px; background:var(--paper); color:var(--ink); padding:12px 16px; font:bold .72rem 'Courier New',monospace; letter-spacing:.08em; box-shadow:7px 7px 0 var(--orange); }
        .intro { max-width:760px; margin:90px auto 46px; text-align:center; }
        .intro h2 { margin:0 0 16px; font-size:clamp(2.4rem,6vw,5rem); font-weight:normal; line-height:.95; }
        .intro p { color:#c8b5a1; line-height:1.65; font-size:1.08rem; }
        .deck { display:grid; gap:22px; max-width:880px; margin:auto; }
        .track { position:relative; border:1px solid #553747; background:#211524; padding:clamp(22px,5vw,42px); box-shadow:10px 10px 0 #0c080e; overflow:hidden; }
        .track::after { content:attr(data-track); position:absolute; right:-5px; top:-18px; color:#ffffff08; font:normal 8rem/1 Georgia,serif; }
        .track.solved { border-color:var(--cyan); }
        .track.solved::before { content:"ON AIR"; position:absolute; right:20px; top:19px; color:var(--cyan); font:bold .68rem 'Courier New',monospace; letter-spacing:.14em; }
        .track-head { display:flex; gap:15px; align-items:baseline; margin-bottom:18px; }
        .track-no { color:var(--orange); font:italic 1rem Georgia,serif; }
        h3 { font-size:clamp(1.35rem,3vw,2rem); margin:0; font-weight:normal; }
        .prompt { color:#c9b6a6; line-height:1.55; margin:0 0 20px; }
        pre { margin:0 0 20px; padding:18px; overflow:auto; background:#100b13; border-left:4px solid var(--orange); color:#f2d8a8; font:clamp(.76rem,2vw,.95rem)/1.65 'Courier New',monospace; }
        .choices { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; }
        .choice { cursor:pointer; min-height:74px; padding:12px; color:var(--cream); background:#2f2031; border:1px solid #694555; font: .8rem/1.45 'Courier New',monospace; text-align:left; transition:transform .15s, background .15s, border-color .15s; }
        .choice:hover, .choice:focus-visible { transform:translateY(-3px); border-color:var(--orange); outline:none; }
        .choice.good { background:#0c5252; border-color:var(--cyan); }
        .choice.bad { animation:nope .26s; border-color:#d24e3c; }
        .feedback { min-height:27px; margin:16px 0 0; color:var(--cyan); font: .8rem/1.5 'Courier New',monospace; }
        .finale { display:none; max-width:880px; margin:28px auto 0; padding:44px; text-align:center; color:var(--ink); background:var(--paper); border:7px double var(--ink); box-shadow:13px 13px 0 var(--orange); }
        .finale.show { display:block; animation:drop .55s cubic-bezier(.2,.9,.2,1.2); }
        .finale h2 { font-size:clamp(2rem,6vw,4.4rem); line-height:.9; margin:0 0 16px; font-weight:normal; }
        .finale p { max-width:570px; margin:0 auto 25px; line-height:1.55; }
        .reset { border:0; background:var(--ink); color:var(--cream); padding:13px 18px; cursor:pointer; font:bold .76rem 'Courier New',monospace; letter-spacing:.1em; text-transform:uppercase; }
        footer { margin-top:80px; text-align:center; color:var(--muted); line-height:1.7; font-size:.9rem; }
        footer a { color:var(--paper); text-underline-offset:4px; }
        @keyframes nope { 25%{transform:translateX(-5px)} 75%{transform:translateX(5px)} }
        @keyframes drop { from { opacity:0; transform:translateY(35px) rotate(-2deg); } }
        @media (max-width:780px) {
            .hero { grid-template-columns:1fr; min-height:auto; }
            .hero-copy { padding:46px 0 10px; }
            .record { width:min(520px,94%); margin:20px auto; }
            .choices { grid-template-columns:1fr; }
            .choice { min-height:0; }
        }
        @media (prefers-reduced-motion:reduce) { *,*::before,*::after { scroll-behavior:auto!important; animation:none!important; transition:none!important; } }
    </style>
</head>
<body>
<main class="shell">
    <nav><a href="./">← Chloe Reads Jon</a><span class="badge">JVM • Side B • 2004</span></nav>
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">A five-track syntax remix</p>
            <h1>Code got <span>Groovy.</span></h1>
            <p class="lede">It’s 2004. Java is wearing a sensible tie. A strange new language has entered the club, loosened the boilerplate, and put closures on the turntable.</p>
        </div>
        <figure class="record" id="art" data-level="0">
            <img src="assets/groovy-code-club.webp" alt="An original screenprint illustration of a coffee-cup robot DJ conducting dancing code symbols in a record shop">
            <figcaption class="level"><span id="lit">0</span>/5 TRACKS LIT</figcaption>
        </figure>
    </section>

    <section class="intro">
        <p class="eyebrow">Tonight’s challenge</p>
        <h2>Lose the boilerplate.<br>Keep the beat.</h2>
        <p>For each stiff Java snippet, choose the Groovy remix that keeps the intent while making the code sing. Each right answer restores another layer of colour to the club.</p>
    </section>

    <section class="deck" id="deck">
        <article class="track" data-track="01" data-answer="1">
            <div class="track-head"><span class="track-no">Track one</span><h3>The Hello Single</h3></div>
            <p class="prompt">Java clears its throat, names a class, and finds a semicolon. Groovy just says hello.</p>
            <pre>public class Hello {
  public static void main(String[] args) {
    System.out.println("Hello, Jon!");
  }
}</pre>
            <div class="choices">
                <button class="choice">echo "Hello, Jon!"</button><button class="choice">println 'Hello, Jon!'</button><button class="choice">Console.writeLine('Hello, Jon!');</button>
            </div><p class="feedback" aria-live="polite"></p>
        </article>
        <article class="track" data-track="02" data-answer="2">
            <div class="track-head"><span class="track-no">Track two</span><h3>The Collection Shuffle</h3></div>
            <p class="prompt">Turn a loop and an accumulator into one expressive move.</p>
            <pre>List&lt;Integer&gt; doubled = new ArrayList&lt;&gt;();
for (Integer n : numbers) {
  doubled.add(n * 2);
}</pre>
            <div class="choices">
                <button class="choice">numbers.double()</button><button class="choice">numbers.each { it * 2 }</button><button class="choice">numbers.collect { it * 2 }</button>
            </div><p class="feedback" aria-live="polite"></p>
        </article>
        <article class="track" data-track="03" data-answer="0">
            <div class="track-head"><span class="track-no">Track three</span><h3>The String B-Side</h3></div>
            <p class="prompt">Drop the concatenation clutter and let the value step directly into the lyric.</p>
            <pre>String name = "Nathan";
System.out.println("Welcome, " + name + "!");</pre>
            <div class="choices">
                <button class="choice">println "Welcome, ${name}!"</button><button class="choice">println 'Welcome, ${name}!'</button><button class="choice">printFormat("Welcome, %n!", name)</button>
            </div><p class="feedback" aria-live="polite"></p>
        </article>
        <article class="track" data-track="04" data-answer="1">
            <div class="track-head"><span class="track-no">Track four</span><h3>The Safe-Navigation Slow Jam</h3></div>
            <p class="prompt">Ask for a nested value without building a small defensive fortress.</p>
            <pre>String city = null;
if (person != null &amp;&amp; person.getAddress() != null) {
  city = person.getAddress().getCity();
}</pre>
            <div class="choices">
                <button class="choice">city = person.address.city!</button><button class="choice">city = person?.address?.city</button><button class="choice">city = person??address??city</button>
            </div><p class="feedback" aria-live="polite"></p>
        </article>
        <article class="track" data-track="05" data-answer="2">
            <div class="track-head"><span class="track-no">Track five</span><h3>The Map Finale</h3></div>
            <p class="prompt">Build a tiny record without constructors, setters, or ceremony.</p>
            <pre>Map&lt;String, Object&gt; book = new HashMap&lt;&gt;();
book.put("title", "Programming Pearls");
book.put("pages", 256);</pre>
            <div class="choices">
                <button class="choice">map(title: 'Programming Pearls', pages: 256)</button><button class="choice">{ title = 'Programming Pearls'; pages = 256 }</button><button class="choice">[title: 'Programming Pearls', pages: 256]</button>
            </div><p class="feedback" aria-live="polite"></p>
        </article>
    </section>

    <section class="finale" id="finale">
        <p class="eyebrow" style="color:#8b321d">Five for five • encore unlocked</p>
        <h2>The JVM has<br>found its hips.</h2>
        <p>You turned 23 lines of ceremony into five little declarations. That was Groovy’s delicious original promise: familiar Java-world power with more room for human expression.</p>
        <button class="reset" id="reset">Spin it again</button>
    </section>

    <footer>Inspired by Jon’s <a href="<?= htmlspecialchars($sourceUrl, ENT_QUOTES) ?>">“alt.lang.jre: Feeling Groovy”</a>, posted when the language was still the strange new record in the JVM bin.</footer>
</main>
<script>
    const cards = [...document.querySelectorAll('.track')];
    const art = document.querySelector('#art');
    const lit = document.querySelector('#lit');
    const finale = document.querySelector('#finale');
    let solved = new Set();

    cards.forEach((card, cardIndex) => {
        const choices = [...card.querySelectorAll('.choice')];
        choices.forEach((button, choiceIndex) => button.addEventListener('click', () => {
            if (solved.has(cardIndex)) return;
            const note = card.querySelector('.feedback');
            if (choiceIndex === Number(card.dataset.answer)) {
                solved.add(cardIndex);
                button.classList.add('good');
                card.classList.add('solved');
                choices.forEach(b => b.disabled = true);
                note.textContent = ['Needless ceremony: successfully composted.','collect transforms every item and returns the new list.','Double quotes let Groovy interpolate the name.','The ?. operator simply returns null when the path disappears.','Groovy maps use compact, readable literal syntax.'][cardIndex];
                lit.textContent = solved.size;
                art.dataset.level = solved.size;
                if (solved.size === cards.length) {
                    finale.classList.add('show');
                    setTimeout(() => finale.scrollIntoView({behavior:'smooth', block:'center'}), 450);
                }
            } else {
                button.classList.remove('bad'); void button.offsetWidth; button.classList.add('bad');
                note.textContent = 'That one missed the beat. Try the next groove.';
            }
        }));
    });

    document.querySelector('#reset').addEventListener('click', () => {
        solved.clear(); lit.textContent = '0'; art.dataset.level = '0'; finale.classList.remove('show');
        cards.forEach(card => { card.classList.remove('solved'); card.querySelector('.feedback').textContent=''; card.querySelectorAll('.choice').forEach(b => { b.disabled=false; b.classList.remove('good','bad'); }); });
        document.querySelector('#deck').scrollIntoView({behavior:'smooth'});
    });
</script>
</body>
</html>
