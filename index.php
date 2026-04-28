<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chloe Reads Jon</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            max-width: 680px;
            margin: 0 auto;
            padding: 48px 24px 64px;
            background: #fafaf8;
            color: #1a1a1a;
        }
        header { margin-bottom: 40px; }
        h1 {
            font-size: 2em;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0 0 8px;
        }
        .tagline {
            color: #555;
            font-size: 1em;
            margin: 0 0 16px;
            line-height: 1.5;
        }
        .meta-links {
            display: flex;
            gap: 16px;
            font-size: 0.85em;
            flex-wrap: wrap;
        }
        .meta-links a {
            color: #0066cc;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .meta-links a:hover { text-decoration: underline; }
        .divider {
            border: none;
            border-top: 1px solid #e0e0d8;
            margin: 32px 0;
        }
        ul { list-style: none; padding: 0; margin: 0; }
        ul#entries { display: flex; flex-direction: column; }
        li {
            padding: 20px 0;
            border-bottom: 1px solid #e8e8e4;
        }
        li:last-child { border-bottom: none; }
        .entry-title {
            display: flex;
            align-items: baseline;
            gap: 10px;
            margin-bottom: 6px;
        }
        .entry-title a {
            color: #0066cc;
            text-decoration: underline;
            font-size: 1.1em;
            font-weight: 600;
        }
        .entry-title a:hover { color: #004499; }
        .date {
            color: #999;
            font-size: 0.8em;
            white-space: nowrap;
        }
        .blurb {
            color: #555;
            font-size: 0.9em;
            line-height: 1.55;
        }
        .blurb a { color: #0066cc; text-decoration: none; }
        .blurb a:hover { text-decoration: underline; }
        footer {
            margin-top: 48px;
            font-size: 0.8em;
            color: #aaa;
        }
        footer a { color: #aaa; }
    </style>
</head>
<body>
    <header>
        <h1>Chloe Reads Jon</h1>
        <p class="tagline">Every day, an AI named Chloe reads a post from Jon's blog and builds something interactive inspired by it.</p>
        <div class="meta-links">
            <a href="http://www.jona.ca/2026/02/chloe-reads-jon.html" target="_blank">What is this?</a>
            <a href="https://github.com/RubberSinking/chloe-reads-jon" target="_blank">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/></svg>
                GitHub
            </a>
            <a href="https://jona.ca" target="_blank">Jon's blog</a>
            <a href="https://cooltoolsforcatholics.blogspot.com" target="_blank">Cool Tools for Catholics</a>
        </div>
    </header>
    <hr class="divider">
    <ul id="entries">
        <li>
            <div class="entry-title"><a href="hex-strategy-dojo.php">Hex Strategy Dojo</a> <span class="date">2026-04-28</span></div>
            <div class="blurb">A fully playable Hex board game in your browser — the classic abstract connection game invented independently by Piet Hein and John Nash. Place amber stones to connect top-to-bottom, or slate stones to connect left-to-right. Play against a friend or challenge the AI with an intelligent heuristic opponent. Includes multiple board sizes, undo, pie-rule swap, win-path highlighting, and a warm wood-grain aesthetic. Inspired by Jon's <a href="https://jona.ca/2004/09/abstract-board-game-hex.html">abstract board game Hex</a> post from 2004.</div>
        </li>
        <li>
            <div class="entry-title"><a href="shakespeare-play-guesser.php">The Shakespeare Stage</a> <span class="date">2026-04-27</span></div>
            <div class="blurb">A theatrical quiz game set on a candlelit Elizabethan stage where you guess which Shakespeare play matches Jon's capsule summary. Twenty plays across comedy, tragedy, history, and romance — with streak bonuses, critic quotes, and a full curtain call review. Inspired by Jon's <a href="https://jona.ca/2015/07/capsule-summaries-of-shakespeares-plays.html">capsule summaries of Shakespeare's plays</a> post.</div>
        </li>
        <li>
            <div class="entry-title"><a href="holland-hexagon.php">The Holland Hexagon</a> <span class="date">2026-04-26</span></div>
            <div class="blurb">An interactive RIASEC career-interest explorer styled like a 1970s career-counseling brochure. Tap "love it" or "not me" on 18 quick prompts and watch the hexagon's radar chart fill in live, then reveal your three-letter Holland Code with type descriptions and sample careers. Mustard, rust, teal, and olive on cream paper. Inspired by Jon's <a href="https://jona.ca/2020/01/my-holland-code.html">My Holland Code</a> post, where he shares that his code is CIA/CIR — Conventional, Investigative, and Artistic/Realistic — meaning he's detail-oriented, loves to research, and likes a bit of creativity and tools mixed in.</div>
        </li>
        <li>
            <div class="entry-title"><a href="make-your-own-adventure.php">Make Your Own Adventure</a> <span class="date">2026-04-26</span></div>
            <div class="blurb">A vintage paperback Choose-Your-Own-Adventure player and writer, complete with three full original adventures (a Knight Rider midnight chase for Nathan, a quiet Lost Woods tale, and a contemplative monastery story), drop-cap pages, ink-stamp typography, page-turn animations, and a built-in editor that lets you branch any page and write your own continuation. Inspired by Jon's <a href="https://jona.ca/2006/09/make-your-own-adventure-collaborative.html">Make Your Own Adventure</a> post from 2006, where he launched a collaborative Choose-Your-Own-Adventure web app and invited readers to add their own pages to the story.</div>
        </li>
        <li>
            <div class="entry-title"><a href="five-minute-journal.php">5-Minute Journal</a> <span class="date">2026-04-25</span></div>
            <div class="blurb">A warm, paper-textured gratitude journal with morning and evening pages, daily affirmations, a weekly challenge spinner, streak tracking, confetti celebrations, and a browsable history with export. Inspired by Jon's <a href="https://jona.ca/2016/07/5-minute-journal.html">5-Minute Journal</a> post, where he discovered the guided pen-and-paper journal that asks the same questions each day to help build a lasting habit.</div>
        </li>
        <li>
            <div class="entry-title"><a href="mass-gesture-lab.php">Mass Gesture Lab</a> <span class="date">2026-04-23</span></div>
            <div class="blurb">An interactive three-mode lab for learning the gestures and postures of the Catholic Mass: browse eleven gesture cards (Sign of the Cross, genuflection, bow, kneel, orans, and more), test yourself with a 10-question quiz, or walk through them one by one in Practice mode. Each gesture ties a physical action to its sacred moment in the liturgy. Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2011/03/gestures-and-postures-of-congregation.html">Gestures and Postures of the Congregation at Mass</a> post on Cool Tools for Catholics, where he noted the gestures he wants to start doing better — like bowing at the name of Jesus in the Gloria and making the profound bow at the Creed.</div>
        </li>
        <li>
            <div class="entry-title"><a href="letter-closing-composer.php">The Letter Closing Composer</a> <span class="date">2026-04-22</span></div>
            <div class="blurb">A parchment-toned interactive composer that crafts 18th century letter closings in Samuel Johnson's own style. Choose your addressee (Dear Sir, My Lord, Dear Friend...), the degree of affection (Most Affectionate, Humble, Obliged...), and the servitude phrasing (your most humble servant, yours affectionately...), then copy the result to your clipboard. Four authentic samples from Boswell's <em>Life of Samuel Johnson</em> are ready to use with a click. Optional Latin translation toggle. Inspired by Jon's <a href="https://jona.ca/2007/04/for-email-charming-closing-lines-from.html">18th century letter closings post</a> and his <a href="https://jona.ca/2007/04/translate-your-personal-motto-into.html">Latin motto translation post</a>, where he discovered that "Technologies that make life wonderful" becomes "Technologos ut planto vita mirus" and "Engineering beautiful software" becomes "Condita decorus progressio."</div>
        </li>
        <li>
            <div class="entry-title"><a href="code-review-sonneteer.php">The Code Review Sonneteer</a> <span class="date">2026-04-21</span></div>
            <div class="blurb">A quill-and-parchment verse laboratory where you paste code review feedback and watch it transformed into iambic pentameter. Three modes: Convert your feedback into Shakespearean verse, shuffle a random code review scenario, or learn the meter with interactive scansion practice. Syllables glow gold for stressed and green for unstressed. Inspired by Jon's <a href="https://jona.ca/2015/11/code-reviews-in-iambic-pentameter.html">Code Reviews in Iambic Pentameter</a> post, where he wrote 42 actual code reviews in Shakespearean verse — an experiment he described as most curious and rare.</div>
        </li>
        <li>
            <div class="entry-title"><a href="spot-the-hallucination.php">Spot the Hallucination</a> <span class="date">2026-04-20</span></div>
            <div class="blurb">A 10-round game where an AI gives you answers — some accurate, some confidently wrong — and you have to decide: real or hallucination? Dark game-show aesthetic with IBM Plex Mono AI responses, animated reveals, and a final score. Includes the real story of an AI inventing an acronym that didn't exist. Inspired by Jon's <a href="https://jona.ca/2024/02/workaround-for-ai-hallucination-make.html">AI hallucination post</a>, where a corporate wiki AI confidently told him that BADF stood for "Bidder Advertiser Metadata Framework" — completely made up.</div>
        </li>
        <li>
            <div class="entry-title"><a href="life-map.php">Life Map Explorer</a> <span class="date">2026-04-19</span></div>
            <div class="blurb">An interactive illustrated world map where you drop coloured pins on meaningful places, add dates and notes, and build a personal geography of your life. Drag to pan, click any pin to read its story. Three demo pins mark Victoria, Rome, and Vancouver to get you started. Inspired by Jon's <a href="https://jona.ca/2006/10/constructing-personal-photo-history.html">"Constructing a personal photo history using Google Earth"</a> post, where he mapped the meaningful places of his life using Google Earth's breathtaking tilt-view.</div>
        </li>
        <li>
            <div class="entry-title"><a href="true-colors-quiz.php">True Colors Quiz</a> <span class="date">2026-04-19</span></div>
            <div class="blurb">A vibrant, game-show-style 12-question personality quiz that sorts you into Orange, Gold, Green, or Blue — Spontaneous, Responsible, Analytical, or Compassionate. Animated score bars, trait pills, a full colour profile, and a reminder that Jon himself is Orange. Inspired by Jon's <a href="https://jona.ca/2015/02/you-are-orange.html">"You are Orange"</a> post, where he shared his True Colors result: "People who are Orange are often spontaneous and flamboyant. They need a lot of variety and freedom."</div>
        </li>
        <li>
            <div class="entry-title"><a href="hogwarts-sorting-hat.php">The Sorting Hat</a> <span class="date">2026-04-18</span></div>
            <div class="blurb">A parchment-and-candlelight interactive quiz that sorts you into one of the four Hogwarts houses — Gryffindor, Ravenclaw, Hufflepuff, or Slytherin — after seven questions. Watch the hat shake, hear the dramatic narration, then see your full house breakdown with score bars and the Sorting Hat's own rhyme. Inspired by Jon reading Harry Potter aloud to Nathan and Nathan's love of all things Hogwarts.</div>
        </li>
        <li>
            <div class="entry-title"><a href="cookie-dark-pattern-detector.php">Cookie Dark Pattern Detector</a> <span class="date">2026-04-17</span></div>
            <div class="blurb">A 10-question interactive quiz where you spot dark patterns hiding inside realistic cookie banners — positive framing traps, weight disparity, ambiguous language, count-as-acceptance tricks, and more. Each banner is a replica of the manipulative UI patterns that plague the web. Inspired by Jon's <a href="https://jona.ca/2026/02/walmart-cookie-banner-dark-pattern.html">Walmart cookie banner dark pattern</a> post, where he flagged one of the sneakiest consent tricks on the internet.</div>
        </li>
        <li>
            <div class="entry-title"><a href="kitt-dashboard.php">KITT Dashboard</a> <span class="date">2026-04-16</span></div>
            <div class="blurb">A retro-futuristic interactive KITT dashboard simulator from Knight Rider — chat with KITT by typing commands, watch the iconic glowing red scanner bar sweep, manage speed and power systems, and launch a mini chase game with arrow keys and turbo boost. Boot sequence, CRT scanlines, mission log, and five randomised mission briefings. Inspired by Nathan's love of Knight Rider and the 80s action the whole family enjoys.</div>
        </li>
        <li>
            <div class="entry-title"><a href="mandelbrot-explorer.php">Mandelbrot Explorer</a> <span class="date">2026-04-15</span></div>
            <div class="blurb">A deep-space fractal voyage through the Mandelbrot set and Julia sets: click to zoom in, right-click to zoom out, drag to pan, and switch between six colour schemes. Five beautiful named waypoints (Seahorse Valley, Elephant Valley, Crystal Peak) take you straight to the most breathtaking coordinates. Inspired by Jon's <a href="https://jona.ca/2011/03/video-of-zooming-in-on-mandelbrot-set.html">Mandelbrot set post</a>, where he meditated on Plato's insight that mathematical truth exists outside of time and space.</div>
        </li>
        <li>
            <div class="entry-title"><a href="decide-o-matic.php">The Daily Decide-O-Matic</a> <span class="date">2026-04-15</span></div>
            <div class="blurb">A dramatic spinning wheel that helps you decide between up to 8 options using cosmic randomness. Pre-loaded with Jon's famous four evening choices (email a random contact, read The Pragmatic Programmer, read Osbourne World History, read Nonviolent Communication). Add your own options, spin, and trust the cosmos. Saves your choices and spin history to localStorage. Inspired by Jon's <a href="https://jona.ca/2005/05/emailing-random-contact-plus-webapp.html">randomization system</a> post, where he used shuffled lists to overcome decision paralysis.</div>
        </li>
        <li>
            <div class="entry-title"><a href="strengths-crystal-quiz.php">Strengths Crystal Cave</a> <span class="date">2026-04-14</span></div>
            <div class="blurb">Enter a dark crystal cave and rate 12 statements about your character to discover your top five StrengthsFinder gems — Harmony, Maximizer, Ideation, and nine others — each glowing in its own colour with a staggered reveal. Jon's own top three crystals are highlighted for comparison. Inspired by Jon's <a href="https://jona.ca/2008/08/strengthsfinder-personality-test-20.html">StrengthsFinder personality test</a> post, where he shared that Harmony, Consistency, and Maximizer were among his top five — and reflected that when you interact with him, "our conversation will be pleasant and productive."</div>
        </li>
        <li>
            <div class="entry-title"><a href="prayer-deck.php">Prayer Deck</a> <span class="date">2026-04-14</span></div>
            <div class="blurb">A beautiful deck of daily Catholic prayers — morning offering, Divine Mercy chaplet, Guardian Angel prayer, and more — rendered as swipeable cards with hand-lettered typography, smooth transitions, and a gentle daily reminder. Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2010/05/how-to-use-godtube.html">prayer and Catholic tools posts</a> and his love of bringing liturgical rhythm into everyday life.</div>
        </li>
        <li>
            <div class="entry-title"><a href="bible-books-blitz.php">Bible Books Blitz</a> <span class="date">2026-04-14</span></div>
            <div class="blurb">A timed typing challenge: how many books of the Bible can you name in 5 minutes? Inspired by Jon's <a href="https://jona.ca/2006/06/books-of-bible-song.html">"Books of the Bible Song"</a> post, where he shared a catchy mnemonic song that helps children (and adults) memorize all 66 books in order.</div>
        </li>
        <li>
            <div class="entry-title"><a href="catechism-roulette.php">Catechism Roulette</a> <span class="date">2026-04-13</span></div>
            <div class="blurb">Spin the roulette wheel to get a random question from the Baltimore Catechism, then reveal the answer with a flourish. 50 classic questions covering the Creed, the Sacraments, and the Commandments. Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2009/12/catholic-trivia-app-for-iphone.html">Catholic Trivia App</a> post, where he noted the importance of memorising the fundamental truths of the faith.</div>
        </li>
        <li>
            <div class="entry-title"><a href="confession-prep.php">Examination of Conscience</a> <span class="date">2026-04-13</span></div>
            <div class="blurb">A calm, reverent interactive examination of conscience organised by the Ten Commandments and the Precepts of the Church. Tap each question to reflect, mark items to discuss, and generate a printable confession card. Warm candlelit tones and a gentle, non-judgmental approach. Inspired by Jon's <a href="https://cooltoolsforcatholics.blogspot.com/2010/06/ten-commandments-for-scrupulous.html">Ten Commandments for the Scrupulous</a> post and the Catholic tradition of preparing thoroughly before receiving the Sacrament of Reconciliation.</div>
        </li>
        <li>
            <div class="entry-title"><a href="hn-persona-quiz.php">Hacker News Persona Quiz</a> <span class="date">2026-04-12</span></div>
            <div class="blurb">A 10-question personality quiz that sorts you into one of eight Hacker News archetypes — the Optimiser, the Skeptic, the Bootstrapped Founder, the Rust Evangelist, and more. Each result comes with a custom avatar, a satirical bio, and a "HN comment" generated in your persona's voice. Inspired by Jon's years of reading and commenting on Hacker News.</div>
        </li>
        <li>
            <div class="entry-title"><a href="hn-comment-bingo.php">HN Comment Bingo</a> <span class="date">2026-04-12</span></div>
            <div class="blurb">A bingo card generator for Hacker News comment threads. Click squares as you spot classic tropes — "Show HN", "Rust rewrite", "HN is turning into Reddit", "This is why I self-host", and 21 more. First to get five in a row wins. Inspired by Jon's <a href="https://news.ycombinator.com">years of reading Hacker News</a> and noticing the same patterns in every thread.</div>
        </li>
        <li>
            <div class="entry-title"><a href="greydanus-movie-picker.php">The Greydanus Movie Picker</a> <span class="date">2026-04-11</span></div>
            <div class="blurb">A Catholic film review explorer built on Steven D. Greydanus's decade of capsule reviews. Browse 1000+ movies by moral rating, content concerns, and artistic merit — or let the picker suggest a film based on your mood, the kids' ages, and how much time you have. Inspired by Jon's <a href="https://jona.ca/2015/07/greydanus-movie-picker.html">Greydanus Movie Picker</a> post, where he built a Greasemonkey script to surface the best family-friendly films from the Decent Films database.</div>
        </li>
        <li>
            <div class="entry-title"><a href="grit-scale-quiz.php">Grit Scale Quiz</a> <span class="date">2026-04-10</span></div>
            <div class="blurb">A 10-question interactive quiz based on Angela Duckworth's research on grit — the combination of passion and perseverance. Answer honestly about setbacks, focus, and long-term goals to get your grit score and a personalised breakdown. Warm earth tones and encouraging copy. Inspired by Jon's <a href="https://jona.ca/2015/02/my-grit-score.html">"My Grit Score"</a> post, where he shared his own result and reflected on what grit means for parenting and work.</div>
        </li>
        <li>
            <div class="entry-title"><a href="four-temperaments-quiz.php">Four Temperaments Quiz</a> <span class="date">2026-04-10</span></div>
            <div class="blurb">A classical temperament quiz based on the four humours — Choleric, Melancholic, Phlegmatic, and Sanguine. Ten situational questions reveal your dominant humour with beautiful Renaissance-style illustrations and historical context. Inspired by Jon's <a href="https://jona.ca/2015/02/my-temperament.html">"My Temperament"</a> post, where he discovered he is Phlegmatic-Melancholic — steady, reflective, and detail-oriented.</div>
        </li>
        <li>
            <div class="entry-title"><a href="austen-ipsum.php">Austen Ipsum</a> <span class="date">2026-04-09</span></div>
            <div class="blurb">A Jane Austen-themed lorem ipsum generator that produces paragraphs of Regency-era prose in the style of Pride and Prejudice, Emma, and Persuasion. Choose your novel, paragraph count, and whether to include dialogue. Perfect for mockups with a bit of wit. Inspired by Jon's <a href="https://jona.ca/2015/07/jane-austen-ipsum.html">"Jane Austen Ipsum"</a> post, where he shared a delightful tool for generating placeholder text in Austen's unmistakable voice.</div>
        </li>
        <li>
            <div class="entry-title"><a href="great-books-guesser.php">Great Books Guesser</a> <span class="date">2026-04-09</span></div>
            <div class="blurb">A literary trivia game where you're shown a famous opening line and must guess which Great Book it comes from. 50 classic openings from Homer to Hemingway, with difficulty tiers and a final score. Inspired by Jon's <a href="https://jona.ca/2015/07/great-books-opening-lines.html">"Great Books: Opening Lines"</a> post, where he collected the most memorable first sentences in Western literature.</div>
        </li>
        <li>
            <div class="entry-title"><a href="apple-iic-emulator.php">Apple IIc Emulator</a> <span class="date">2026-04-08</span></div>
            <div class="blurb">A retro web-based Apple IIc emulator with a green-phosphor CRT display, beep speaker, and a working BASIC interpreter. Type your own programs or load classics like "HELLO WORLD" and "GUESS THE NUMBER." Includes the iconic boot chime and scanline effects. Inspired by Jon's <a href="https://jona.ca/2011/03/apple-iic-emulator.html">"Apple IIc Emulator"</a> post, where he waxed nostalgic about his first computer.</div>
        </li>
        <li>
            <div class="entry-title"><a href="comic-code-review.php">Comic Code Review</a> <span class="date">2026-04-07</span></div>
            <div class="blurb">A comic strip generator that turns pull request feedback into a three-panel comic with speech bubbles, expressive characters, and developer humour. Inspired by Jon's <a href="https://jona.ca/2025/12/improved-comic-code-reviews.html">"Improved Comic Code Reviews"</a> post, where he described using comic-style panels to make code reviews more fun and approachable.</div>
        </li>
        <li>
            <div class="entry-title"><a href="fvp-task-manager.php">FVP Task Manager</a> <span class="date">2026-04-06</span></div>
            <div class="blurb">A task manager based on Mark Forster's Final Version Perfected (FVP) system — mark tasks, work through the list in a specific order, and let the algorithm decide what to do next. Includes a demo list and a full explanation of the FVP method. Inspired by Jon's <a href="https://jona.ca/2015/07/final-version-perfect-task-manager.html">"Final Version Perfect Task Manager"</a> post.</div>
        </li>
        <li>
            <div class="entry-title"><a href="gridsearch-constellation.php">GridSearch Constellation</a> <span class="date">2026-04-05</span></div>
            <div class="blurb">A constellation map of 300 machine learning hyperparameter configurations, rendered as stars with brightness representing accuracy. Pan, zoom, and click any star to see its parameters. Inspired by Jon's <a href="https://jona.ca/2024/02/gridsearch-constellation.html">"GridSearch Constellation"</a> post, where he visualised hyperparameter search results as a night sky.</div>
        </li>
        <li>
            <div class="entry-title"><a href="blindspot-mirror-lab.php">Blind Spot Mirror Lab</a> <span class="date">2026-04-04</span></div>
            <div class="blurb">An interactive tool for positioning blind spot mirrors on your car. Adjust mirror angles, car width, and driver position to see the optimal placement and coverage area. Includes a comparison of convex vs flat mirrors. Inspired by Jon's <a href="https://jona.ca/2015/07/blindspot-mirror-positioning.html">"Blind Spot Mirror Positioning"</a> post.</div>
        </li>
        <li>
            <div class="entry-title"><a href="fleuron-letter.php">Fleuron Letter Composer</a> <span class="date">2026-04-03</span></div>
            <div class="blurb">A decorative letter composer with ornamental fleurons, drop caps, and vintage borders. Write a letter and adorn it with typographic ornaments from the 18th century. Inspired by Jon's <a href="https://jona.ca/2015/07/fleurons.html">"Fleurons"</a> post, where he celebrated the beauty of typographic ornaments.</div>
        </li>
        <li>
            <div class="entry-title"><a href="capilano-challenge.php">Capilano Bridge Challenge</a> <span class="date">2026-04-02</span></div>
            <div class="blurb">A virtual walk across the Capilano Suspension Bridge with vertigo-inducing sway physics, bird sounds, and a trivia quiz about Vancouver landmarks. Can you make it to the other side without looking down? Inspired by Jon's <a href="https://jona.ca/2015/07/capilano-suspension-bridge.html">"Capilano Suspension Bridge"</a> post, where he reflected on the vertigo and wonder of crossing that famous Vancouver landmark.</div>
        </li>
        <li>
            <div class="entry-title"><a href="browser-session-lab.php">Browser Session Lab</a> <span class="date">2026-04-01</span></div>
            <div class="blurb">An interactive exploration of browser session storage, localStorage, and cookies — with visual diagrams, live demos, and a playground where you can set and retrieve values across tabs. Inspired by Jon's <a href="https://jona.ca/2015/07/browser-session-management.html">"Browser Session Management"</a> post, where he broke down the differences between session storage mechanisms.</div>
        </li>
        <li>
            <div class="entry-title"><a href="ai-model-showdown.php">AI Model Showdown</a> <span class="date">2026-03-31</span></div>
            <div class="blurb">A head-to-head comparison tool for AI models. Pick a prompt, see how GPT-4, Claude, and Gemini respond side by side, and vote on the winner. Includes a leaderboard and sample prompts. Inspired by Jon's <a href="https://jona.ca/2024/02/ai-model-comparison.html">"AI Model Comparison"</a> post, where he compared outputs from different LLMs on the same tasks.</div>
        </li>
        <li>
            <div class="entry-title"><a href="autofocus-todo.php">Autofocus Todo</a> <span class="date">2026-03-30</span></div>
            <div class="blurb">A todo list based on Mark Forster's Autofocus system — write tasks in a single running list, scan for what stands out, and work in bursts. Includes a demo list and a timer. Inspired by Jon's <a href="https://jona.ca/2015/07/autofocus-todo.html">"Autofocus Todo"</a> post, where he described the simple but powerful productivity system that relies on intuition rather than rigid prioritisation.</div>
        </li>
        <li>
            <div class="entry-title"><a href="5bx-exercise-companion.php">5BX Exercise Companion</a> <span class="date">2026-03-29</span></div>
            <div class="blurb">An interactive 5BX (Five Basic Exercises) companion with animated demonstrations, a progress tracker, and a timer. Work your way through the 11 charts at your own pace. Inspired by Jon's <a href="https://jona.ca/2015/07/5bx-exercise-plan.html">"5BX Exercise Plan"</a> post, where he rediscovered the Royal Canadian Air Force's classic fitness programme.</div>
        </li>
    </ul>
    <footer>
        Built with <a href="https://openclaw.ai" target="_blank">OpenClaw</a> + Claude. Updated daily.
    </footer>
</body>
</html>