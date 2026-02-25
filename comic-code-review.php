<?php
// No server-side logic needed — everything runs in the browser.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic Code Review Generator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #f0ede0;
            min-height: 100vh;
            margin: 0;
            padding: 28px 16px 72px;
            color: #1a1a1a;
        }

        .container {
            max-width: 520px;
            margin: 0 auto;
        }

        /* ── Header ── */
        header {
            text-align: center;
            margin-bottom: 28px;
        }
        .site-label {
            font-size: 0.72em;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #999;
            margin: 0 0 6px;
        }
        header h1 {
            font-family: 'Special Elite', serif;
            font-size: clamp(1.7em, 7vw, 2.5em);
            line-height: 1.1;
            margin: 0 0 10px;
        }
        header p {
            font-size: 0.88em;
            color: #666;
            margin: 0;
            line-height: 1.55;
        }
        header a { color: #5555aa; }

        /* ── Newspaper strip ── */
        .newspaper-strip {
            background: #fff;
            border: 3px solid #111;
            border-radius: 1px;
            box-shadow: 5px 5px 0 #111;
            margin: 20px 0 24px;
            overflow: hidden;
            transition: opacity 0.18s ease;
        }
        .newspaper-strip.fading { opacity: 0; }

        /* strip banner */
        .strip-banner {
            border-bottom: 2px solid #111;
            padding: 6px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #111;
            color: #fff;
        }
        .strip-title {
            font-family: 'Special Elite', serif;
            font-size: 0.78em;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .strip-subtitle {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65em;
            color: #aaa;
        }

        /* tag row */
        .sin-tag-row {
            padding: 10px 16px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sin-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.7em;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .sin-tag {
            display: inline-block;
            background: #111;
            color: #fff;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.72em;
            font-weight: 600;
            padding: 2px 10px 3px;
            border-radius: 20px;
        }

        /* art area */
        .panel-art {
            padding: 20px 20px 18px;
            text-align: center;
            min-height: 230px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 14px;
            background: #fffef8;
        }
        .panel-emoji {
            font-size: clamp(3.2em, 14vw, 5.5em);
            line-height: 1;
            letter-spacing: 0.1em;
        }
        .panel-scene {
            font-style: italic;
            font-size: 0.86em;
            color: #555;
            line-height: 1.55;
            max-width: 370px;
        }

        /* caption */
        .panel-caption {
            background: #111;
            color: #fff;
            padding: 16px 22px;
            font-family: 'Special Elite', serif;
            font-size: clamp(1em, 4.5vw, 1.2em);
            text-align: center;
            line-height: 1.45;
            border-top: 2px solid #111;
        }

        /* ── Counter ── */
        .counter {
            font-size: 0.75em;
            color: #bbb;
            font-family: 'IBM Plex Mono', monospace;
            text-align: center;
            margin-bottom: 14px;
        }

        /* ── Controls ── */
        .controls {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }
        .btn {
            padding: 13px 16px;
            border: 2px solid #111;
            border-radius: 2px;
            background: #fff;
            font-family: 'Special Elite', serif;
            font-size: 0.95em;
            cursor: pointer;
            box-shadow: 3px 3px 0 #111;
            transition: box-shadow 0.07s, transform 0.07s;
            white-space: nowrap;
        }
        .btn:hover { background: #f0ede0; }
        .btn:active {
            box-shadow: 1px 1px 0 #111;
            transform: translate(2px, 2px);
        }
        .btn-primary {
            background: #111;
            color: #fff;
            grid-column: 1 / -1;
            font-size: 1.05em;
        }
        .btn-primary:hover { background: #2a2a2a; }

        select {
            grid-column: 1 / -1;
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #111;
            border-radius: 2px;
            font-family: system-ui, sans-serif;
            font-size: 0.9em;
            background: #fff;
            cursor: pointer;
            box-shadow: 3px 3px 0 #111;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='9' viewBox='0 0 14 9'%3E%3Cpath d='M1 1l6 6 6-6' stroke='%23111' stroke-width='2' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 38px;
        }

        /* ── Keyboard hint ── */
        .kbd-hint {
            text-align: center;
            font-size: 0.72em;
            color: #bbb;
            margin-top: 8px;
        }
        .kbd-hint kbd {
            background: #eee;
            border: 1px solid #ccc;
            border-bottom: 2px solid #bbb;
            border-radius: 3px;
            padding: 1px 5px;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 1em;
            color: #555;
        }

        /* ── Footer ── */
        footer {
            margin-top: 48px;
            text-align: center;
            font-size: 0.78em;
            color: #bbb;
        }
        footer a { color: #bbb; text-decoration: none; }
        footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">

    <header>
        <p class="site-label">Chloe Reads Jon</p>
        <h1>Comic Code Review<br>Generator</h1>
        <p>Far Side&#8209;style one&#8209;panel comics for every classic code sin.
        Inspired by Jon's <a href="https://www.jona.ca/2026/02/comic-code-reviews-part-2.html" target="_blank">Comic Code Reviews Part 2</a>.</p>
    </header>

    <div id="comicPanel" class="newspaper-strip">
        <div class="strip-banner">
            <span class="strip-title">The Far Side of Code</span>
            <span class="strip-subtitle" id="stripNum">#1</span>
        </div>
        <div class="sin-tag-row">
            <span class="sin-label">Code sin:</span>
            <span class="sin-tag" id="sinTag"></span>
        </div>
        <div class="panel-art">
            <div class="panel-emoji" id="panelEmoji"></div>
            <div class="panel-scene" id="panelScene"></div>
        </div>
        <div class="panel-caption" id="panelCaption"></div>
    </div>

    <div class="counter" id="counter"></div>

    <div class="controls">
        <button class="btn btn-primary" onclick="showRandom()">🎲&nbsp;&nbsp;Random Comic</button>
        <button class="btn" onclick="showPrev()">← Prev</button>
        <button class="btn" onclick="showNext()">Next →</button>
        <select id="comicSelect" onchange="showSelected()">
            <option value="">— Browse by code sin —</option>
        </select>
    </div>

    <p class="kbd-hint">Keyboard: <kbd>←</kbd> prev &nbsp;·&nbsp; <kbd>→</kbd> next &nbsp;·&nbsp; <kbd>Space</kbd> random</p>

    <footer>
        <a href="./">← Chloe Reads Jon</a>
    </footer>

</div>

<script>
const comics = [
    {
        sin: "TODO: Fix Later",
        emoji: "🦕 💎",
        scene: "A jubilant palaeontologist brushes dust from a perfectly preserved amber block. Inside, clearly visible: a sticky note reading \"TODO: Fix this properly, just a bit rushed right now.\" A camera crew films from behind a velvet rope.",
        caption: "Scientists were thrilled to discover the earliest known instance of \"We'll get to this eventually.\""
    },
    {
        sin: "Magic Number",
        emoji: "🧙 🔢",
        scene: "A wizard points confidently at the number 42 floating in midair. Three confused developers stare at a whiteboard covered in question marks. A small handwritten sign reads: \"It's fine. I know what it means.\"",
        caption: "The senior developer assured the team it was self-documenting."
    },
    {
        sin: "500-Line Function",
        emoji: "🏢 🗺️",
        scene: "A city sightseeing bus stops in front of a skyscraper that fills the entire frame. The building is labelled doEverything(). A tourist steps off the bus, looks up, and has to lean back ninety degrees to see the top.",
        caption: "The function had grown so large, the city declared it a protected historic landmark."
    },
    {
        sin: "commit: 'fixed stuff'",
        emoji: "🔍 📌",
        scene: "Two weary detectives stand in a dim office surrounded by a conspiracy board. Red string connects dozens of sticky notes. At the very centre, pinned with great ceremony, is a single note reading: \"fixed stuff — Dave — March 2019.\"",
        caption: "The investigation had reached a dead end."
    },
    {
        sin: "Commented-Out Code",
        emoji: "🏛️ 🚧",
        scene: "A hushed museum gallery, midnight lighting. Behind a velvet rope, inside a glass case, twenty lines of commented-out code are displayed on aged parchment. A placard reads: \"Origin Unknown — c. 2014. DO NOT DELETE.\"",
        caption: "No one dared remove it. No one dared ask why."
    },
    {
        sin: "Global Variable",
        emoji: "🌐 😰",
        scene: "Twelve developers are attached by taut strings to a single pulsating orb labelled globalState. All twelve are trying to walk in different directions. The orb is vibrating. A small sign reads: \"Trust the process.\"",
        caption: "Everything was fine, until someone changed it."
    },
    {
        sin: "CSS !important",
        emoji: "🔨 🏗️",
        scene: "A construction worker swings an enormous sledgehammer labelled !important. Three interior walls and a load-bearing column have already been knocked down. A structural engineer watches from across the street, holding a clipboard at arm's length.",
        caption: "The specificity problem had been solved, along with several load-bearing walls."
    },
    {
        sin: "Callback Hell",
        emoji: "🧗 🕳️",
        scene: "A spelunker rappels into a deep cave of nested function calls, headlamp cutting through the dark. Another level of nesting begins below. A sign on the cave wall reads: \"If you can read this, you are the callback.\" A second sign below reads: \"Rescue team: Level 4. Still descending.\"",
        caption: "They sent a rescue team. The rescue team also got lost."
    },
    {
        sin: "No Tests Written",
        emoji: "🪙 🚀",
        scene: "A developer in a business suit stands before a large red DEPLOY button, a coin in the air mid-flip. Three colleagues watch from behind blast shields. A banner overhead reads: \"Sprint Demo in 10 minutes.\"",
        caption: "The quality assurance process had been significantly streamlined."
    },
    {
        sin: "var in 2026",
        emoji: "☕ 🖼️",
        scene: "A hip café. On the wall between sepia photographs of typewriters and a chalkboard menu: a framed, gently-lit plaque reading \"var\" in elegant lettering. A small card beneath it reads: \"Single-origin. Free-range. Hoisted.\"",
        caption: "Some developers insisted it had more character than const."
    },
    {
        sin: "Friday Afternoon Deploy",
        emoji: "🚨 🏖️",
        scene: "A developer in beach shorts and sunglasses slams a giant red DEPLOY button. Through the office window behind them, the rest of the team can be seen loading luggage into their cars. Ominous storm clouds gather in the distance.",
        caption: "Gary had a good feeling about this one."
    },
    {
        sin: "Infinite Recursion",
        emoji: "🪞 😵",
        scene: "A developer stands in a hall of mirrors. Every reflection holds the same call stack printout. The reflection of the reflection also holds one. So does the next. In the farthest mirror, a tiny developer is sitting on the floor.",
        caption: "The stack trace was, as far as anyone could tell, still going."
    },
    {
        sin: "utils.js",
        emoji: "📜 🌾",
        scene: "Two small developers unroll what appears to be a very long scroll across an open field. They are approaching the horizon. In the middle distance a farmer watches from a fence. One of the developers shades their eyes. The scroll is still unrolling.",
        caption: "utils.js had finally been fully printed."
    },
    {
        sin: "console.log Debugging",
        emoji: "🏖️ 🔬",
        scene: "A researcher in a white lab coat kneels on a beach, methodically sifting sand through a tiny sieve. A bucket beside her is labelled \"console output.\" The ocean stretches behind her, calm and indifferent.",
        caption: "The bug was in there somewhere."
    },
    {
        sin: "Works on My Machine",
        emoji: "👑 🔥",
        scene: "A developer sits on a golden throne, sceptre in hand, beneath a banner reading \"My Machine.\" Through the palace window, the production environment is visibly on fire. A page bows presenting a printed bug report on a silver tray.",
        caption: "And verily, it ran fine."
    },
    {
        sin: "Copy-Paste Code",
        emoji: "🧬 👯",
        scene: "A scientist in a white coat stands before two identical blocks of code suspended in glass tanks. Both have the same bug circled in red marker. Both are vibrating at the same frequency. A third tank is being prepared.",
        caption: "Dr. Hoffmann had concerns about the cloning procedure."
    },
    {
        sin: "God Object",
        emoji: "🌌 😶",
        scene: "A tiny developer stands at the base of a vast, pulsating structure in space labelled UserManager. Tendrils extend from it in all directions, connecting to every other component. A small plaque reads: \"Responsible for everything.\" It has no tests.",
        caption: "It had become the only class that truly understood the system."
    },
    {
        sin: "Merge Conflict",
        emoji: "⚔️ 📄",
        scene: "Two developers in full medieval armour sit across from each other at a conference table. Between them, an illuminated manuscript document with <<<<<<< HEAD written in ornate lettering, and >>>>>>> BRANCH below in crimson. A mediator looks exhausted.",
        caption: "The conflict resolution meeting had entered its third hour."
    },
    {
        sin: "Missing Semicolon",
        emoji: "🌋 😳",
        scene: "An archaeologist surveys the ruins of a once-great civilisation with a clipboard. A small sign in the foreground, half-buried in rubble, reads: \"The JavaScript Empire — est. 2014. Lost to a missing semicolon.\" The archaeologist writes: 'Preventable.'",
        caption: "One character. Just one."
    },
    {
        sin: "Hardcoded URL",
        emoji: "⚓ 🏗️",
        scene: "Engineers bolt a massive concrete anchor to the foundation of a skyscraper under construction. The anchor is labelled http://localhost:3000. A foreman ticks it off his clipboard. In the background, a container ship tries to navigate around it.",
        caption: "The application was deployed to production exactly as designed."
    }
];

let currentIndex = -1;

function populate() {
    const sel = document.getElementById('comicSelect');
    comics.forEach((c, i) => {
        const opt = document.createElement('option');
        opt.value = i;
        opt.textContent = c.sin;
        sel.appendChild(opt);
    });
}

function showComic(index, instant) {
    const panel = document.getElementById('comicPanel');
    const doUpdate = () => {
        const c = comics[index];
        document.getElementById('sinTag').textContent = c.sin;
        document.getElementById('panelEmoji').textContent = c.emoji;
        document.getElementById('panelScene').textContent = c.scene;
        document.getElementById('panelCaption').textContent = c.caption;
        document.getElementById('stripNum').textContent = '#' + (index + 1);
        document.getElementById('counter').textContent =
            (index + 1) + ' of ' + comics.length;
        document.getElementById('comicSelect').value = index;
        currentIndex = index;
        panel.classList.remove('fading');
    };
    if (instant) {
        doUpdate();
    } else {
        panel.classList.add('fading');
        setTimeout(doUpdate, 180);
    }
}

function showRandom() {
    let next;
    do { next = Math.floor(Math.random() * comics.length); }
    while (next === currentIndex && comics.length > 1);
    showComic(next);
}

function showNext() {
    showComic((currentIndex + 1) % comics.length);
}

function showPrev() {
    showComic((currentIndex - 1 + comics.length) % comics.length);
}

function showSelected() {
    const val = document.getElementById('comicSelect').value;
    if (val !== '') showComic(parseInt(val));
}

// Keyboard navigation
document.addEventListener('keydown', e => {
    if (['INPUT', 'SELECT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;
    if (e.key === 'ArrowRight') showNext();
    else if (e.key === 'ArrowLeft') showPrev();
    else if (e.key === ' ') { e.preventDefault(); showRandom(); }
});

populate();
showRandom();
</script>
</body>
</html>
