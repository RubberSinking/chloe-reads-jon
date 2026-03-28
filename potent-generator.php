<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Potent Generator — Jon Aquino's Linguistic Lab</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        :root {
            --ink: #1a1208;
            --paper: #fdf8ef;
            --parchment: #f5ecd4;
            --tan: #e8d9b0;
            --brown: #8b6914;
            --accent: #c0392b;
            --accent2: #2c6e49;
            --shadow: rgba(139,105,20,0.2);
        }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: var(--paper);
            color: var(--ink);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .masthead {
            background: var(--ink);
            color: var(--parchment);
            text-align: center;
            padding: 32px 24px 24px;
            border-bottom: 4px solid var(--brown);
        }
        .masthead h1 {
            font-size: clamp(1.6em, 5vw, 2.8em);
            margin: 0 0 8px;
            letter-spacing: -0.5px;
            font-style: italic;
        }
        .masthead .subtitle {
            font-size: 0.9em;
            color: #bbb;
            margin: 0;
            font-style: normal;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .byline {
            font-size: 0.8em;
            color: #888;
            margin-top: 8px;
        }
        .byline a {
            color: var(--tan);
            text-decoration: none;
        }
        .byline a:hover { text-decoration: underline; }

        .container {
            max-width: 720px;
            margin: 0 auto;
            padding: 32px 20px 64px;
        }

        /* Quote block */
        .origin-quote {
            background: var(--parchment);
            border-left: 4px solid var(--brown);
            padding: 20px 24px;
            margin: 0 0 32px;
            border-radius: 0 8px 8px 0;
            font-style: italic;
            font-size: 0.95em;
            line-height: 1.6;
            color: #4a3a1a;
        }
        .origin-quote cite {
            display: block;
            margin-top: 10px;
            font-style: normal;
            font-size: 0.85em;
            color: var(--brown);
        }

        /* Definition card */
        .potd-card {
            background: var(--parchment);
            border: 2px solid var(--tan);
            border-radius: 12px;
            padding: 24px;
            margin: 0 0 32px;
            position: relative;
        }
        .potd-label {
            position: absolute;
            top: -12px;
            left: 20px;
            background: var(--accent);
            color: white;
            font-size: 0.72em;
            font-weight: bold;
            padding: 3px 12px;
            border-radius: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: system-ui, sans-serif;
        }
        .potd-word {
            font-size: 2em;
            font-weight: bold;
            color: var(--accent);
            margin: 4px 0 2px;
        }
        .potd-origin {
            font-size: 0.85em;
            color: var(--brown);
            font-style: italic;
            margin-bottom: 12px;
        }
        .potd-def {
            font-size: 0.95em;
            line-height: 1.6;
            margin-bottom: 12px;
        }
        .potd-examples {
            font-size: 0.88em;
            color: #555;
            font-style: italic;
            line-height: 1.7;
        }
        .potd-examples span {
            display: block;
            margin-bottom: 4px;
        }
        .potd-examples strong {
            font-style: normal;
            color: var(--accent2);
        }

        /* Generator section */
        .gen-section {
            background: white;
            border: 1px solid var(--tan);
            border-radius: 12px;
            padding: 24px;
            margin: 0 0 32px;
            box-shadow: 0 2px 8px var(--shadow);
        }
        .gen-section h2 {
            font-size: 1.1em;
            margin: 0 0 16px;
            color: var(--brown);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: system-ui, sans-serif;
            font-weight: 700;
        }
        .gen-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }
        .gen-row input[type="text"] {
            flex: 1;
            min-width: 160px;
            padding: 11px 16px;
            border: 2px solid var(--tan);
            border-radius: 8px;
            font-size: 1.05em;
            font-family: Georgia, serif;
            color: var(--ink);
            background: var(--paper);
            outline: none;
            transition: border-color 0.2s;
        }
        .gen-row input[type="text"]:focus {
            border-color: var(--brown);
        }
        .gen-row button {
            padding: 11px 22px;
            background: var(--ink);
            color: var(--parchment);
            border: none;
            border-radius: 8px;
            font-size: 0.95em;
            cursor: pointer;
            font-family: Georgia, serif;
            letter-spacing: 0.3px;
            transition: background 0.15s;
        }
        .gen-row button:hover { background: #2a1f0c; }
        .gen-row button.random {
            background: var(--brown);
        }
        .gen-row button.random:hover { background: #6a4f10; }

        .gen-result {
            margin-top: 20px;
            display: none;
        }
        .gen-result.show { display: block; }
        .gen-result .new-word {
            font-size: 1.7em;
            font-weight: bold;
            color: var(--accent2);
            margin-bottom: 4px;
        }
        .gen-result .from {
            font-size: 0.82em;
            color: var(--brown);
            font-style: italic;
            margin-bottom: 10px;
        }
        .gen-result .def {
            font-size: 0.95em;
            line-height: 1.6;
            color: #333;
            margin-bottom: 10px;
        }
        .gen-result .ex {
            font-size: 0.88em;
            font-style: italic;
            color: #666;
            line-height: 1.7;
        }
        .gen-result .ex strong {
            font-style: normal;
            color: var(--accent2);
        }
        .copy-btn {
            display: inline-block;
            margin-top: 12px;
            padding: 6px 14px;
            background: var(--parchment);
            border: 1px solid var(--tan);
            border-radius: 6px;
            font-size: 0.8em;
            cursor: pointer;
            color: var(--brown);
            font-family: system-ui, sans-serif;
            transition: background 0.15s;
        }
        .copy-btn:hover { background: var(--tan); }

        /* Lexicon table */
        .lexicon-section h2 {
            font-size: 1.1em;
            margin: 0 0 16px;
            color: var(--brown);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: system-ui, sans-serif;
            font-weight: 700;
        }
        .lexicon-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 32px;
        }
        .lex-card {
            background: var(--parchment);
            border: 1px solid var(--tan);
            border-radius: 10px;
            padding: 14px 16px;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .lex-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow);
        }
        .lex-card .adj {
            font-size: 0.78em;
            color: var(--brown);
            font-family: system-ui, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .lex-card .noun {
            font-size: 1.1em;
            font-weight: bold;
            color: var(--accent);
        }
        .lex-card .snippet {
            font-size: 0.78em;
            color: #777;
            font-style: italic;
            margin-top: 4px;
            line-height: 1.4;
        }

        /* Quiz section */
        .quiz-section {
            background: var(--ink);
            color: var(--parchment);
            border-radius: 12px;
            padding: 24px;
            margin: 0 0 32px;
        }
        .quiz-section h2 {
            font-size: 1.1em;
            margin: 0 0 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: system-ui, sans-serif;
            font-weight: 700;
            color: var(--tan);
        }
        .quiz-section .qdesc {
            font-size: 0.85em;
            color: #aaa;
            margin: 0 0 18px;
        }
        .quiz-question {
            font-size: 1.05em;
            line-height: 1.5;
            margin-bottom: 16px;
            color: white;
        }
        .quiz-question .potent-word {
            font-size: 1.4em;
            font-weight: bold;
            color: #ffd700;
            display: block;
            margin-bottom: 6px;
        }
        .quiz-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 16px;
        }
        .quiz-options button {
            padding: 10px 14px;
            background: #2a2010;
            color: var(--parchment);
            border: 1px solid #5a4a20;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9em;
            font-family: Georgia, serif;
            text-align: left;
            transition: background 0.15s;
        }
        .quiz-options button:hover:not(:disabled) { background: #3a3010; }
        .quiz-options button.correct { background: #1a4a2a !important; border-color: #2c6e49 !important; color: #90ee90 !important; }
        .quiz-options button.wrong { background: #4a1a1a !important; border-color: #c0392b !important; color: #ff9090 !important; }
        .quiz-options button:disabled { cursor: default; }
        .quiz-feedback {
            font-size: 0.88em;
            color: #aaa;
            line-height: 1.5;
            min-height: 24px;
        }
        .quiz-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .quiz-score {
            font-size: 0.88em;
            color: var(--tan);
            font-family: system-ui, sans-serif;
        }
        .quiz-next {
            padding: 9px 20px;
            background: var(--accent2);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9em;
            display: none;
        }
        .quiz-next.show { display: block; }
        .quiz-done {
            text-align: center;
            padding: 16px 0 8px;
        }
        .quiz-done .big-score {
            font-size: 2em;
            font-weight: bold;
            color: #ffd700;
        }
        .quiz-done p { color: #ccc; font-size: 0.9em; }
        .quiz-restart {
            padding: 9px 22px;
            background: var(--brown);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9em;
            margin-top: 8px;
        }

        /* Suffix guide */
        .suffix-guide {
            background: var(--parchment);
            border: 1px solid var(--tan);
            border-radius: 12px;
            padding: 22px 24px;
            margin-bottom: 32px;
        }
        .suffix-guide h2 {
            font-size: 1.1em;
            margin: 0 0 14px;
            color: var(--brown);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: system-ui, sans-serif;
            font-weight: 700;
        }
        .suffix-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .suffix-chip {
            background: white;
            border: 1.5px solid var(--brown);
            border-radius: 20px;
            padding: 5px 14px;
            font-size: 0.88em;
            color: var(--brown);
            font-style: italic;
        }
        .suffix-chip strong { font-style: normal; color: var(--accent); }

        footer {
            text-align: center;
            padding: 24px;
            font-size: 0.8em;
            color: #999;
            font-family: system-ui, sans-serif;
        }
        footer a { color: #bbb; text-decoration: none; }

        @media (max-width: 480px) {
            .quiz-options { grid-template-columns: 1fr; }
            .lexicon-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>

<div class="masthead">
    <h1>The Potent Generator</h1>
    <p class="subtitle">A Linguistic Invention by Jon Aquino</p>
    <p class="byline">Inspired by <a href="https://jona.ca/2011/07/turning-adjectives-into-nouns.html" target="_blank">"Turning Adjectives into Nouns"</a> · jona.ca · July 2011</p>
</div>

<div class="container">

    <blockquote class="origin-quote">
        "I would like to propose that if you need a new word for something, an option available to you is to take an adjective and turn it into a noun. Chances are that no-one will have done it before, so you will have your new noun. And it will have the advantage of sounding esoteric."
        <cite>— Jon Aquino, 2011</cite>
    </blockquote>

    <!-- POTENT OF THE DAY -->
    <div class="potd-card" id="potd">
        <div class="potd-label">Potent of the Day</div>
        <div class="potd-word" id="potd-word"></div>
        <div class="potd-origin" id="potd-origin"></div>
        <div class="potd-def" id="potd-def"></div>
        <div class="potd-examples" id="potd-examples"></div>
    </div>

    <!-- GENERATOR -->
    <div class="gen-section">
        <h2>Potentify Your Own Adjective</h2>
        <p style="font-size:0.88em;color:#666;margin:0 0 14px;font-family:system-ui,sans-serif;">
            Enter any adjective and forge your own potent — a noun the dictionary has never seen.
        </p>
        <div class="gen-row">
            <input type="text" id="adj-input" placeholder="e.g. ephemeral, liminal, recursive…" maxlength="40">
            <button onclick="potentify()">Potentify →</button>
            <button class="random" onclick="randomAdj()">Random</button>
        </div>
        <div class="gen-result" id="gen-result">
            <div class="new-word" id="result-word"></div>
            <div class="from" id="result-from"></div>
            <div class="def" id="result-def"></div>
            <div class="ex" id="result-ex"></div>
            <button class="copy-btn" onclick="copyResult()">Copy to clipboard</button>
        </div>
    </div>

    <!-- LEXICON GRID -->
    <div class="lexicon-section">
        <h2>The Emerging Lexicon of Potents</h2>
        <div class="lexicon-grid" id="lexicon-grid"></div>
    </div>

    <!-- SUFFIX GUIDE -->
    <div class="suffix-guide">
        <h2>Jon's Top Potent Suffixes</h2>
        <p style="font-size:0.88em;color:#666;margin:0 0 14px;font-family:system-ui,sans-serif;">
            According to Jon's research, these endings make the strongest potents — that "technical, hard-to-understand vibe":
        </p>
        <div class="suffix-grid">
            <span class="suffix-chip">-<strong>ic</strong> → referent<strong>ic</strong></span>
            <span class="suffix-chip">-<strong>al</strong> → relation<strong>al</strong></span>
            <span class="suffix-chip">-<strong>ent</strong> → differ<strong>ent</strong></span>
            <span class="suffix-chip">-<strong>ive</strong> → transit<strong>ive</strong></span>
            <span class="suffix-chip">-<strong>ory</strong> → preparat<strong>ory</strong></span>
            <span class="suffix-chip">-<strong>ous</strong> → vicar<strong>ious</strong></span>
            <span class="suffix-chip">-<strong>ary</strong> → element<strong>ary</strong></span>
        </div>
    </div>

    <!-- QUIZ -->
    <div class="quiz-section">
        <h2>Quiz: Guess the Original Adjective</h2>
        <p class="qdesc">A potent is shown — can you identify which adjective it was forged from?</p>
        <div id="quiz-container"></div>
    </div>

</div>

<footer>
    Part of <a href="index.php">Chloe Reads Jon</a> · Built by OpenClaw + Claude
</footer>

<script>
// ─────────────────────────────────────────────
// DATA
// ─────────────────────────────────────────────
const POTENTS = [
    {
        adj: "ephemeral",
        noun: "ephemeral",
        potent: "Ephemeral",
        def: "A person, idea, or object that exists only briefly before vanishing from collective consciousness — the fundamental unit of study in the sociology of forgotten things.",
        examples: [
            "The poet's first chapbook, published in a run of twelve copies, is an archetypal <strong>ephemeral</strong>.",
            "Researchers catalogued over two hundred <strong>ephemerals</strong> from the early web, none of which survive.",
            "The study of <strong>ephemerals</strong> reveals as much about a culture as its enduring monuments."
        ],
        domain: "Sociology / Information Science"
    },
    {
        adj: "liminal",
        noun: "liminal",
        potent: "Liminal",
        def: "A threshold state, person, or place suspended between two defined conditions — the central subject of transitional anthropology.",
        examples: [
            "The waiting room is the canonical <strong>liminal</strong> of modern life.",
            "Van Gennep catalogued the <strong>liminalities</strong> found in every rite of passage across cultures.",
            "She occupied that uncomfortable <strong>liminal</strong> between student and professional for nearly two years."
        ],
        domain: "Anthropology / Philosophy"
    },
    {
        adj: "recursive",
        noun: "recursive",
        potent: "Recursive",
        def: "Any structure, process, or argument that contains within itself a reference to its own kind — the formal object of self-referential logic.",
        examples: [
            "Gödel's incompleteness theorems are constructed entirely from <strong>recursives</strong>.",
            "The mirror facing the mirror is the household <strong>recursive</strong> par excellence.",
            "Programming languages that permit function calls within function calls are built on <strong>recursives</strong>."
        ],
        domain: "Computer Science / Logic"
    },
    {
        adj: "transient",
        noun: "transient",
        potent: "Transient",
        def: "An element in a system that produces a temporary, non-steady response before settling — a core concept in the study of dynamic instability.",
        examples: [
            "Every revolution is a political <strong>transient</strong> before the new equilibrium asserts itself.",
            "Engineers must design for <strong>transients</strong>, not just for steady-state conditions.",
            "The summer romance is the emotional <strong>transient</strong> most widely misidentified as a permanent state."
        ],
        domain: "Engineering / Political Theory"
    },
    {
        adj: "contingent",
        noun: "contingent",
        potent: "Contingent",
        def: "A fact, outcome, or entity whose existence depends entirely on circumstances that might have been otherwise — the irreducible unit of modal philosophy.",
        examples: [
            "History is the science of <strong>contingents</strong>: events that happened, though they need not have.",
            "Leibniz argued that all <strong>contingents</strong> derive their being from a necessary ground.",
            "The job offer was a pure <strong>contingent</strong> — had she not missed her train, she would never have been there."
        ],
        domain: "Philosophy / History"
    },
    {
        adj: "residual",
        noun: "residual",
        potent: "Residual",
        def: "What persists in a system after a primary effect has passed — the essential datum of empirical analysis.",
        examples: [
            "The statistician studies the <strong>residuals</strong> when the model fails to explain the data.",
            "Grief, in clinical terms, is an emotional <strong>residual</strong> that outlasts its occasion.",
            "Every demolished building leaves a cultural <strong>residual</strong> in the memories of its former inhabitants."
        ],
        domain: "Statistics / Cultural Studies"
    },
    {
        adj: "iterative",
        noun: "iterative",
        potent: "Iterative",
        def: "A process or approach that advances through repeated cycles of refinement — the productive unit of incremental progress.",
        examples: [
            "The software sprint is the canonical <strong>iterative</strong> of modern development practice.",
            "All learning proceeds through <strong>iteratives</strong>, each pass depositing more than the last.",
            "Edison's notebooks document over a thousand <strong>iteratives</strong> before the working filament was found."
        ],
        domain: "Software / Epistemology"
    },
    {
        adj: "normative",
        noun: "normative",
        potent: "Normative",
        def: "A standard, value, or expectation that prescribes how things ought to be rather than describing how they are — the governing unit of ethical and legal discourse.",
        examples: [
            "The law is a <strong>normative</strong> — it does not describe behaviour, it commands it.",
            "Every culture exports its <strong>normatives</strong> through the media it produces.",
            "Philosophers distinguish <strong>normatives</strong> (how things should be) from descriptives (how things are)."
        ],
        domain: "Ethics / Jurisprudence"
    },
    {
        adj: "relational",
        noun: "relational",
        potent: "Relational",
        def: "Any entity whose nature is defined not by intrinsic properties but by its connections to other entities — the primitive of network theory.",
        examples: [
            "Friendship is a pure <strong>relational</strong>: it cannot exist in isolation.",
            "The database treats every datum as a <strong>relational</strong>, meaningful only in conjunction with others.",
            "Power, Foucault argues, is always a <strong>relational</strong> — never a possession, always a dynamic."
        ],
        domain: "Sociology / Database Theory"
    },
    {
        adj: "speculative",
        noun: "speculative",
        potent: "Speculative",
        def: "A claim, investment, or theory that ventures beyond available evidence into the plausible — the unit of productive intellectual risk.",
        examples: [
            "The most transformative ideas in science began as <strong>speculatives</strong>.",
            "The venture capital portfolio is a collection of managed <strong>speculatives</strong>.",
            "Every theological argument about the afterlife is necessarily a <strong>speculative</strong>."
        ],
        domain: "Finance / Philosophy of Science"
    },
    {
        adj: "peripheral",
        noun: "peripheral",
        potent: "Peripheral",
        def: "An element situated at the margin of a system or discourse — the unit whose exclusion defines the center.",
        examples: [
            "Urban planners too often treat the poor as <strong>peripherals</strong> rather than constituents.",
            "In cognitive science, <strong>peripherals</strong> of attention often carry more information than focal points.",
            "The footnote is the academic text's <strong>peripheral</strong> — ignored until it proves decisive."
        ],
        domain: "Urban Studies / Cognitive Science"
    },
    {
        adj: "analogical",
        noun: "analogical",
        potent: "Analogical",
        def: "A comparison or mapping that transfers understanding from a familiar domain to an unfamiliar one — the workhorse of metaphorical cognition.",
        examples: [
            "Aquinas's theology is built on <strong>analogicals</strong>: we speak of God as 'good' by analogy to human goodness.",
            "The best science explainers use <strong>analogicals</strong> — atoms as billiard balls, genes as blueprints.",
            "Children acquire language through a cascade of <strong>analogicals</strong>, mapping new words onto known concepts."
        ],
        domain: "Theology / Cognitive Linguistics"
    }
];

const RANDOM_ADJECTIVES = [
    "ephemeral","liminal","recursive","transient","contingent",
    "residual","iterative","normative","relational","speculative",
    "peripheral","analogical","dialectical","immanent","phenomenal",
    "empirical","categorical","heuristic","dialectical","axiomatic",
    "reductive","teleological","systemic","holistic","paradigmatic",
    "canonical","elemental","primordial","transcendental","minimal",
    "radical","substantial","sequential","positional","fractional",
    "modal","nominal","cardinal","differential","functional",
    "temporal","spatial","causal","formal","material",
    "virtual","actual","potential","structural","essential"
];

// Templates for generating potent definitions
function generatePotentDef(adj) {
    const adjClean = adj.trim().toLowerCase();
    const potent = adjClean.endsWith('al') ? adjClean.charAt(0).toUpperCase() + adjClean.slice(1) :
                   adjClean.endsWith('ic') ? adjClean.charAt(0).toUpperCase() + adjClean.slice(1) :
                   adjClean.endsWith('ent') ? adjClean.charAt(0).toUpperCase() + adjClean.slice(1) :
                   adjClean.endsWith('ive') ? adjClean.charAt(0).toUpperCase() + adjClean.slice(1) :
                   adjClean.endsWith('ory') ? adjClean.charAt(0).toUpperCase() + adjClean.slice(1) :
                   adjClean.charAt(0).toUpperCase() + adjClean.slice(1);

    const domains = [
        "Philosophy", "Sociology", "Computer Science", "Cognitive Science",
        "Cultural Studies", "Linguistics", "Political Theory", "Ethics",
        "Epistemology", "Systems Theory", "Literary Criticism", "Anthropology"
    ];
    const domain = domains[Math.abs(hashStr(adjClean)) % domains.length];
    const domain2 = domains[(Math.abs(hashStr(adjClean)) + 3) % domains.length];

    const defTemplates = [
        `Any entity, process, or phenomenon that embodies the quality of being ${adjClean} — the primitive unit of study in ${domain}.`,
        `A state, structure, or relation defined entirely by its ${adjClean} character — the foundational object of ${domain}.`,
        `That which is irreducibly ${adjClean} in its essence — the basic datum without which ${domain} cannot begin.`,
        `An instance, specimen, or case exhibiting pure ${adjClean} properties — the central subject of ${domain} and ${domain2}.`
    ];
    const def = defTemplates[Math.abs(hashStr(adjClean + "def")) % defTemplates.length];

    const plural = potent + (potent.endsWith('s') ? 'es' : 's');
    const exTemplates = [
        `The philosopher's task is to classify <strong>${plural}</strong> and trace their relations to one another.`,
        `Every theory of ${domain.toLowerCase()} must account for the existence of <strong>${plural}</strong>.`,
        `She identified three distinct types of <strong>${plural}</strong> in her survey of the literature.`,
        `The field has lacked a rigorous account of <strong>${plural}</strong> until now.`,
        `To speak of a pure <strong>${potent.toLowerCase()}</strong> is to invoke the most contested concept in contemporary ${domain.toLowerCase()}.`,
        `<strong>${potent}</strong> is not a singular phenomenon — the literature distinguishes at least five varieties.`
    ];

    const ex1 = exTemplates[Math.abs(hashStr(adjClean + "e1")) % exTemplates.length];
    const ex2 = exTemplates[(Math.abs(hashStr(adjClean + "e2")) + 2) % exTemplates.length];
    const ex3 = exTemplates[(Math.abs(hashStr(adjClean + "e3")) + 4) % exTemplates.length];

    return { potent, def, examples: [ex1, ex2, ex3], domain };
}

function hashStr(s) {
    let h = 0;
    for (let i = 0; i < s.length; i++) h = Math.imul(31, h) + s.charCodeAt(i) | 0;
    return h;
}

// ─────────────────────────────────────────────
// POTENT OF THE DAY
// ─────────────────────────────────────────────
function initPotD() {
    const idx = Math.floor(Date.now() / 86400000) % POTENTS.length;
    const p = POTENTS[idx];
    document.getElementById('potd-word').textContent = p.potent;
    document.getElementById('potd-origin').textContent =
        `noun, coined from adjective "${p.adj}" · ${p.domain}`;
    document.getElementById('potd-def').textContent = p.def;
    const exEl = document.getElementById('potd-examples');
    exEl.innerHTML = p.examples.map(e => `<span>"${e}"</span>`).join('');
}

// ─────────────────────────────────────────────
// GENERATOR
// ─────────────────────────────────────────────
function potentify() {
    const raw = document.getElementById('adj-input').value.trim();
    if (!raw) return;

    // Check if it's in our hand-crafted list
    const found = POTENTS.find(p => p.adj.toLowerCase() === raw.toLowerCase());
    const result = document.getElementById('gen-result');

    if (found) {
        document.getElementById('result-word').textContent = found.potent;
        document.getElementById('result-from').textContent =
            `noun, derived from adjective "${found.adj}" · ${found.domain}`;
        document.getElementById('result-def').textContent = found.def;
        document.getElementById('result-ex').innerHTML =
            found.examples.map(e => `"${e}"`).join('<br>');
    } else {
        const gen = generatePotentDef(raw);
        document.getElementById('result-word').textContent = gen.potent;
        document.getElementById('result-from').textContent =
            `noun, coined from adjective "${raw.toLowerCase()}" · ${gen.domain}`;
        document.getElementById('result-def').textContent = gen.def;
        document.getElementById('result-ex').innerHTML =
            gen.examples.map(e => `"${e}"`).join('<br>');
    }

    result.classList.add('show');
}

function randomAdj() {
    const a = RANDOM_ADJECTIVES[Math.floor(Math.random() * RANDOM_ADJECTIVES.length)];
    document.getElementById('adj-input').value = a;
    potentify();
}

document.getElementById('adj-input').addEventListener('keydown', e => {
    if (e.key === 'Enter') potentify();
});

function copyResult() {
    const word = document.getElementById('result-word').textContent;
    const from = document.getElementById('result-from').textContent;
    const def = document.getElementById('result-def').textContent;
    const ex = document.getElementById('result-ex').innerText;
    const text = `${word}\n${from}\n\n${def}\n\n${ex}`;
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.querySelector('.copy-btn');
        const orig = btn.textContent;
        btn.textContent = 'Copied!';
        setTimeout(() => btn.textContent = orig, 1500);
    });
}

// ─────────────────────────────────────────────
// LEXICON GRID
// ─────────────────────────────────────────────
function initLexicon() {
    const grid = document.getElementById('lexicon-grid');
    POTENTS.slice(0, 9).forEach(p => {
        const card = document.createElement('div');
        card.className = 'lex-card';
        card.innerHTML = `
            <div class="adj">from: ${p.adj}</div>
            <div class="noun">${p.potent}</div>
            <div class="snippet">${p.def.slice(0, 60)}…</div>
        `;
        card.onclick = () => {
            document.getElementById('adj-input').value = p.adj;
            potentify();
            document.querySelector('.gen-section').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        };
        grid.appendChild(card);
    });
}

// ─────────────────────────────────────────────
// QUIZ
// ─────────────────────────────────────────────
let quizState = {
    questions: [],
    current: 0,
    score: 0,
    answered: false
};

function buildQuiz() {
    // Shuffle and take 8 potents
    const shuffled = [...POTENTS].sort(() => Math.random() - 0.5).slice(0, 8);
    quizState.questions = shuffled;
    quizState.current = 0;
    quizState.score = 0;
    quizState.answered = false;
    renderQuizQuestion();
}

function renderQuizQuestion() {
    const container = document.getElementById('quiz-container');
    const q = quizState.questions[quizState.current];
    const total = quizState.questions.length;

    if (!q) {
        renderQuizDone();
        return;
    }

    // Build 4 choices
    const wrong = POTENTS
        .filter(p => p.adj !== q.adj)
        .sort(() => Math.random() - 0.5)
        .slice(0, 3)
        .map(p => p.adj);
    const choices = [q.adj, ...wrong].sort(() => Math.random() - 0.5);

    container.innerHTML = `
        <div class="quiz-question">
            <span class="potent-word">${q.potent}</span>
            "${q.def.slice(0, 90)}…"
        </div>
        <div class="quiz-options" id="quiz-opts">
            ${choices.map(c => `<button onclick="answerQuiz('${c}','${q.adj}')">${c}</button>`).join('')}
        </div>
        <div class="quiz-feedback" id="quiz-fb"></div>
        <div class="quiz-footer">
            <span class="quiz-score">${quizState.current + 1} / ${total} · Score: ${quizState.score}</span>
            <button class="quiz-next" id="quiz-next-btn" onclick="nextQuizQ()">Next →</button>
        </div>
    `;
}

function answerQuiz(chosen, correct) {
    if (quizState.answered) return;
    quizState.answered = true;

    const btns = document.querySelectorAll('#quiz-opts button');
    btns.forEach(b => {
        b.disabled = true;
        if (b.textContent === correct) b.classList.add('correct');
        else if (b.textContent === chosen && chosen !== correct) b.classList.add('wrong');
    });

    const fb = document.getElementById('quiz-fb');
    const q = quizState.questions[quizState.current];
    if (chosen === correct) {
        quizState.score++;
        fb.textContent = `✓ Correct! "${q.potent}" is forged from "${correct}".`;
        fb.style.color = '#90ee90';
    } else {
        fb.textContent = `✗ "${q.potent}" comes from "${correct}", not "${chosen}".`;
        fb.style.color = '#ff9090';
    }

    document.getElementById('quiz-next-btn').classList.add('show');
}

function nextQuizQ() {
    quizState.current++;
    quizState.answered = false;
    renderQuizQuestion();
}

function renderQuizDone() {
    const total = quizState.questions.length;
    const pct = Math.round((quizState.score / total) * 100);
    let verdict;
    if (pct >= 90) verdict = "You are clearly a potent scholar.";
    else if (pct >= 70) verdict = "Solid. The lexicon grows in you.";
    else if (pct >= 50) verdict = "You're building your potent vocabulary.";
    else verdict = "A promising area for further potentization.";

    document.getElementById('quiz-container').innerHTML = `
        <div class="quiz-done">
            <div class="big-score">${quizState.score} / ${total}</div>
            <p>${verdict}</p>
            <button class="quiz-restart" onclick="buildQuiz()">Try Again</button>
        </div>
    `;
}

// ─────────────────────────────────────────────
// INIT
// ─────────────────────────────────────────────
initPotD();
initLexicon();
buildQuiz();
</script>

</body>
</html>
