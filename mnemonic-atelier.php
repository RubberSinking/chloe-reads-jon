<?php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mnemonic Atelier</title>
    <style>
        :root {
            --paper: #f7f1e4;
            --paper-deep: #eadbbe;
            --ink: #201919;
            --ink-soft: #5c4b42;
            --scarlet: #a03a2d;
            --gold: #c9962d;
            --pine: #28473c;
            --sky: #a9d2d7;
            --shadow: 0 24px 60px rgba(33, 20, 12, 0.16);
            --radius: 26px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Avenir Next", "Gill Sans", "Trebuchet MS", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.9), transparent 28%),
                radial-gradient(circle at 85% 15%, rgba(169,210,215,0.35), transparent 22%),
                linear-gradient(180deg, #e7dbc3 0%, #f4ecdd 42%, #efe1ca 100%);
            line-height: 1.45;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.08), rgba(255,255,255,0.08)),
                repeating-linear-gradient(0deg, transparent 0 2px, rgba(77,52,32,0.025) 2px 4px);
            mix-blend-mode: multiply;
            opacity: 0.65;
        }

        .page {
            width: min(1120px, calc(100% - 28px));
            margin: 0 auto;
            padding: 22px 0 40px;
        }

        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(255,248,236,0.96), rgba(239,225,202,0.94));
            border: 1px solid rgba(87, 57, 33, 0.16);
            border-radius: 34px;
            box-shadow: var(--shadow);
            padding: 26px;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 12% 12%, rgba(201,150,45,0.22), transparent 18%),
                radial-gradient(circle at 90% 15%, rgba(160,58,45,0.18), transparent 16%),
                radial-gradient(circle at 80% 78%, rgba(40,71,60,0.18), transparent 20%);
            pointer-events: none;
        }

        .topline {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(87, 57, 33, 0.12);
            font-size: 0.82rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--ink-soft);
        }

        h1, h2, h3 {
            font-family: Baskerville, "Palatino Linotype", "Book Antiqua", serif;
            line-height: 0.96;
            margin: 0;
            font-weight: 700;
        }

        h1 {
            font-size: clamp(3rem, 8vw, 5.8rem);
            margin-top: 18px;
            letter-spacing: -0.05em;
            max-width: 8ch;
        }

        .hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 1.35fr 0.95fr;
            gap: 22px;
            align-items: end;
        }

        .hero-copy p {
            max-width: 58ch;
            margin: 18px 0 0;
            color: var(--ink-soft);
            font-size: 1.04rem;
        }

        .motto {
            display: inline-block;
            margin-top: 18px;
            padding: 12px 14px;
            background: rgba(255,255,255,0.62);
            border-left: 4px solid var(--scarlet);
            border-radius: 14px;
            color: var(--ink-soft);
            font-size: 0.96rem;
        }

        .hero-card {
            justify-self: end;
            width: min(100%, 360px);
            background: rgba(28, 24, 22, 0.92);
            color: #f6ecd5;
            border-radius: 26px;
            padding: 18px;
            box-shadow: 0 18px 40px rgba(33, 20, 12, 0.24);
            transform: rotate(-2.2deg);
        }

        .hero-card h2 {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .hero-card ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 10px;
        }

        .hero-card li {
            padding: 10px 12px;
            border-radius: 14px;
            background: rgba(255,255,255,0.06);
            display: flex;
            gap: 10px;
            align-items: baseline;
        }

        .hero-card span {
            color: #f3c866;
            font-weight: 700;
        }

        .studio {
            margin-top: 22px;
            display: grid;
            grid-template-columns: 1.08fr 0.92fr;
            gap: 22px;
        }

        .panel {
            background: rgba(255, 249, 240, 0.9);
            border-radius: var(--radius);
            border: 1px solid rgba(87, 57, 33, 0.14);
            box-shadow: var(--shadow);
            padding: 22px;
            backdrop-filter: blur(10px);
        }

        .panel h2 {
            font-size: clamp(1.9rem, 5vw, 2.5rem);
            margin-bottom: 8px;
        }

        .lede {
            color: var(--ink-soft);
            margin: 0 0 18px;
        }

        .row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .preset {
            border: 1px solid rgba(87,57,33,0.16);
            background: rgba(255,255,255,0.78);
            color: var(--ink);
            border-radius: 999px;
            padding: 9px 14px;
            cursor: pointer;
            font: inherit;
        }

        .preset:hover,
        .preset.active {
            background: var(--ink);
            color: #fff4dd;
            border-color: var(--ink);
        }

        textarea {
            width: 100%;
            min-height: 230px;
            border: 1px solid rgba(87, 57, 33, 0.16);
            border-radius: 20px;
            padding: 18px;
            resize: vertical;
            font: inherit;
            background: rgba(255,255,255,0.7);
            color: var(--ink);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
        }

        textarea:focus,
        button:focus,
        .sentence:focus,
        .example-chip:focus {
            outline: 3px solid rgba(169,210,215,0.86);
            outline-offset: 2px;
        }

        .controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        button.primary,
        button.secondary,
        .download-link {
            font: inherit;
            border: none;
            border-radius: 16px;
            padding: 12px 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button.primary {
            background: var(--scarlet);
            color: #fff4dd;
            box-shadow: 0 8px 22px rgba(160, 58, 45, 0.22);
        }

        button.secondary,
        .download-link {
            background: rgba(255,255,255,0.78);
            color: var(--ink);
            border: 1px solid rgba(87,57,33,0.14);
        }

        .status {
            margin-top: 14px;
            color: var(--ink-soft);
            font-size: 0.95rem;
        }

        .analysis {
            display: grid;
            gap: 16px;
        }

        .metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .metric {
            padding: 16px;
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(255,255,255,0.76), rgba(234,219,190,0.62));
            border: 1px solid rgba(87,57,33,0.12);
        }

        .metric strong {
            display: block;
            font-size: 1.7rem;
            font-family: Baskerville, "Palatino Linotype", serif;
        }

        .metric span {
            color: var(--ink-soft);
            font-size: 0.85rem;
        }

        .sentence-pool {
            display: grid;
            gap: 10px;
            max-height: 420px;
            overflow: auto;
            padding-right: 4px;
        }

        .sentence {
            width: 100%;
            text-align: left;
            background: rgba(255,255,255,0.72);
            border: 1px solid rgba(87,57,33,0.12);
            border-radius: 18px;
            padding: 14px;
            cursor: pointer;
            font: inherit;
            color: var(--ink);
            transition: transform 0.18s ease, background 0.18s ease, border-color 0.18s ease;
        }

        .sentence:hover { transform: translateY(-1px); }
        .sentence.selected {
            background: linear-gradient(135deg, rgba(160,58,45,0.14), rgba(201,150,45,0.14));
            border-color: rgba(160,58,45,0.4);
        }

        .sentence small {
            display: block;
            margin-top: 8px;
            color: var(--ink-soft);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.72rem;
        }

        .atelier-card {
            background: linear-gradient(180deg, rgba(33,25,25,0.96), rgba(47,37,34,0.96));
            color: #f8eed9;
            border-radius: 28px;
            padding: 20px;
            position: sticky;
            top: 16px;
            overflow: hidden;
        }

        .atelier-card::after {
            content: "";
            position: absolute;
            inset: auto -20% -25% auto;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(201,150,45,0.3), transparent 70%);
        }

        .atelier-card h2 {
            font-size: 2.1rem;
            margin-bottom: 12px;
        }

        .cheat-sheet {
            display: grid;
            gap: 12px;
        }

        .summary-line,
        .example-card,
        .discussion-card,
        .chant-line {
            position: relative;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 18px;
            padding: 14px;
        }

        .summary-line::before,
        .example-card::before,
        .discussion-card::before,
        .chant-line::before {
            content: attr(data-glyph);
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 1.2rem;
            opacity: 0.72;
        }

        .summary-line h3,
        .example-card h3,
        .discussion-card h3 {
            font-size: 1rem;
            margin-bottom: 8px;
            line-height: 1.1;
        }

        .muted {
            color: rgba(248,238,217,0.74);
        }

        .mini-label {
            display: inline-flex;
            margin: 18px 0 10px;
            font-size: 0.72rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: rgba(248,238,217,0.65);
        }

        .example-chips {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .example-chip {
            border: 1px solid rgba(87,57,33,0.14);
            background: rgba(255,255,255,0.78);
            padding: 10px 12px;
            border-radius: 999px;
            cursor: pointer;
            font: inherit;
        }

        .chant-line.active {
            border-color: rgba(201,150,45,0.64);
            background: rgba(201,150,45,0.14);
            transform: scale(1.01);
        }

        .chant-controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 12px;
        }

        .footer-note {
            margin-top: 22px;
            color: var(--ink-soft);
            font-size: 0.92rem;
        }

        @media (max-width: 920px) {
            .hero-grid,
            .studio {
                grid-template-columns: 1fr;
            }

            .hero-card {
                justify-self: start;
                transform: rotate(0deg);
            }

            .atelier-card {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .page { width: min(100% - 18px, 1120px); }
            .hero, .panel { padding: 18px; }
            .metrics { grid-template-columns: 1fr; }
            h1 { max-width: none; }
            .entry-title { display: block; }
        }
    </style>
</head>
<body>
    <div class="page">
        <section class="hero">
            <div class="hero-grid">
                <div class="hero-copy">
                    <div class="topline">Mnemonic Atelier · text that actually sticks</div>
                    <h1>Turn a wall of words into something your brain might finally keep.</h1>
                    <p>
                        Jon once wrote that reading straight through often lets information slide right past him, but drawing pictures, working through examples,
                        reading aloud, and making an abridgement can make a text stick. So here is a study desk with better manners than a textbook.
                    </p>
                    <div class="motto">Pick your best lines, conjure a few visual anchors, generate examples, then read the result aloud like a tiny one-person seminar.</div>
                </div>
                <aside class="hero-card" aria-label="Learning modes">
                    <h2>Five memory levers</h2>
                    <ul>
                        <li><span>✦</span> Visual anchors instead of vague fog</li>
                        <li><span>✦</span> Abridgement without rewriting the whole thing</li>
                        <li><span>✦</span> Concrete examples for abstract claims</li>
                        <li><span>✦</span> Read-aloud rhythm for stubborn passages</li>
                        <li><span>✦</span> Discussion prompts so the page argues back</li>
                    </ul>
                </aside>
            </div>
        </section>

        <section class="studio">
            <div class="panel analysis">
                <div>
                    <h2>Input text</h2>
                    <p class="lede">Paste something thorny, or load a sample passage built for the atelier.</p>
                    <div class="row" id="presetRow"></div>
                    <textarea id="sourceText" placeholder="Paste a chapter excerpt, lecture notes, a paragraph from a book, or a dense idea that deserves gentler handling."></textarea>
                    <div class="controls">
                        <button class="primary" id="analyzeBtn">Build my cheat sheet</button>
                        <button class="secondary" id="clearBtn">Clear</button>
                    </div>
                    <div class="status" id="statusText">Waiting for text. No dramatic studying yet.</div>
                </div>

                <div>
                    <h2>Sentence workshop</h2>
                    <p class="lede">Tap the most important sentences. The atelier will turn them into a one-page memory kit.</p>
                    <div class="metrics" id="metrics">
                        <div class="metric"><strong id="sentenceCount">0</strong><span>sentences spotted</span></div>
                        <div class="metric"><strong id="wordCount">0</strong><span>words loaded</span></div>
                        <div class="metric"><strong id="selectionCount">0</strong><span>lines selected</span></div>
                    </div>
                    <div class="sentence-pool" id="sentencePool" aria-live="polite"></div>
                </div>
            </div>

            <aside class="atelier-card">
                <h2>Your memory sheet</h2>
                <p class="muted">A compact blend of abridgement, imagery, examples, read-aloud rhythm, and talking points.</p>

                <div class="mini-label">Abridged core</div>
                <div class="cheat-sheet" id="summarySheet">
                    <div class="summary-line" data-glyph="✦">Choose a few key sentences and they will appear here with simple image-hooks.</div>
                </div>

                <div class="mini-label">Example forge</div>
                <div class="example-chips" id="exampleChips"></div>
                <div class="cheat-sheet" id="exampleCards">
                    <div class="example-card" data-glyph="◌">No examples yet. Feed the atelier a passage first.</div>
                </div>

                <div class="mini-label">Discussion prompts</div>
                <div class="cheat-sheet" id="discussionCards">
                    <div class="discussion-card" data-glyph="?">The best study sessions are mildly argumentative. Your prompts will show up here.</div>
                </div>

                <div class="mini-label">Read-aloud lane</div>
                <div class="chant-controls">
                    <button class="secondary" id="startReadBtn">Start guided read</button>
                    <button class="secondary" id="speakBtn">Speak aloud</button>
                    <button class="secondary" id="stopReadBtn">Stop</button>
                </div>
                <div class="cheat-sheet" id="chantSheet">
                    <div class="chant-line" data-glyph="♪">Your selected summary lines will also become a paced reading lane.</div>
                </div>

                <div class="controls">
                    <a class="download-link" id="downloadLink" href="#" download="mnemonic-atelier-sheet.txt">Download cheat sheet</a>
                </div>
            </aside>
        </section>

        <p class="footer-note">Tip: this thing works best on dense paragraphs, not on shopping lists. Even the prettiest study desk cannot transubstantiate random clutter into wisdom.</p>
    </div>

    <script>
        const presets = [
            {
                label: 'Logic',
                text: 'A habit becomes reliable when it is attached to a cue, reduced to a first easy action, and repeated before motivation has time to negotiate. The goal is not heroic intensity. The goal is a pattern your future self can enter without a debate. If a practice requires ideal conditions, it is not yet stable. Stability usually grows from small repeatable beginnings.'
            },
            {
                label: 'Parenting',
                text: 'Children borrow emotional steadiness from the adults who care for them. Correction works best when connection is still intact. A child who feels seen is more able to listen. A child who feels shamed will often defend before learning. Warm authority is not weakness. It is structure delivered without contempt.'
            },
            {
                label: 'Prayer',
                text: 'Prayer changes pace before it changes outcomes. The first grace is often attention. When the soul slows down enough to notice what is true, gratitude grows clearer, worries become more specific, and petitions become less theatrical. Silence can feel unproductive right up until it reveals what was actually going on in the heart.'
            }
        ];

        const iconMap = [
            { test: /(habit|repeat|daily|pattern|routine|practice)/i, icon: '⟳', tag: 'rhythm' },
            { test: /(child|children|parent|family|son|care)/i, icon: '☉', tag: 'bond' },
            { test: /(book|text|read|chapter|sentence|word)/i, icon: '📖', tag: 'text' },
            { test: /(prayer|soul|grace|silence|god|heart)/i, icon: '✧', tag: 'spirit' },
            { test: /(example|concrete|case|instance)/i, icon: '◈', tag: 'example' },
            { test: /(time|future|pace|slow|quick)/i, icon: '⌛', tag: 'tempo' },
            { test: /(idea|reason|logic|argument|truth)/i, icon: '⚖', tag: 'logic' },
            { test: /(light|image|picture|draw|visual)/i, icon: '✺', tag: 'image' }
        ];

        const sourceText = document.getElementById('sourceText');
        const presetRow = document.getElementById('presetRow');
        const analyzeBtn = document.getElementById('analyzeBtn');
        const clearBtn = document.getElementById('clearBtn');
        const sentencePool = document.getElementById('sentencePool');
        const summarySheet = document.getElementById('summarySheet');
        const exampleCards = document.getElementById('exampleCards');
        const exampleChips = document.getElementById('exampleChips');
        const discussionCards = document.getElementById('discussionCards');
        const chantSheet = document.getElementById('chantSheet');
        const sentenceCount = document.getElementById('sentenceCount');
        const wordCount = document.getElementById('wordCount');
        const selectionCount = document.getElementById('selectionCount');
        const statusText = document.getElementById('statusText');
        const downloadLink = document.getElementById('downloadLink');
        const startReadBtn = document.getElementById('startReadBtn');
        const stopReadBtn = document.getElementById('stopReadBtn');
        const speakBtn = document.getElementById('speakBtn');

        let sentences = [];
        let selectedIds = new Set();
        let readTimer = null;
        let readIndex = 0;

        function splitSentences(text) {
            return text
                .replace(/\s+/g, ' ')
                .trim()
                .match(/[^.!?]+[.!?]+|[^.!?]+$/g) || [];
        }

        function cleanWords(text) {
            return text.toLowerCase().match(/[a-z][a-z'-]+/g) || [];
        }

        function scoreSentence(sentence) {
            const words = cleanWords(sentence);
            const uniqueCount = new Set(words).size;
            const lengthBoost = Math.min(words.length, 22);
            return uniqueCount + lengthBoost * 0.35;
        }

        function detectIcon(sentence) {
            for (const rule of iconMap) {
                if (rule.test.test(sentence)) return rule;
            }
            return { icon: '✦', tag: 'idea' };
        }

        function summarizeSelection() {
            const chosen = sentences.filter(s => selectedIds.has(s.id));
            if (!chosen.length) {
                summarySheet.innerHTML = '<div class="summary-line" data-glyph="✦">Choose a few key sentences and they will appear here with simple image-hooks.</div>';
                chantSheet.innerHTML = '<div class="chant-line" data-glyph="♪">Your selected summary lines will also become a paced reading lane.</div>';
                discussionCards.innerHTML = '<div class="discussion-card" data-glyph="?">The best study sessions are mildly argumentative. Your prompts will show up here.</div>';
                exampleCards.innerHTML = '<div class="example-card" data-glyph="◌">No examples yet. Feed the atelier a passage first.</div>';
                exampleChips.innerHTML = '';
                selectionCount.textContent = '0';
                updateDownload();
                return;
            }

            summarySheet.innerHTML = chosen.map(item => {
                const icon = detectIcon(item.text);
                return `<div class="summary-line" data-glyph="${icon.icon}"><h3>${icon.tag}</h3><div>${escapeHtml(item.text)}</div></div>`;
            }).join('');

            chantSheet.innerHTML = chosen.map((item, index) => (
                `<div class="chant-line${index === 0 ? ' active' : ''}" data-glyph="♪">${escapeHtml(item.text)}</div>`
            )).join('');

            buildExamples(chosen);
            buildPrompts(chosen);
            selectionCount.textContent = String(chosen.length);
            updateDownload();
        }

        function buildExamples(chosen) {
            const keywords = extractKeywords(chosen.map(c => c.text).join(' ')).slice(0, 4);
            if (!keywords.length) {
                exampleChips.innerHTML = '';
                exampleCards.innerHTML = '<div class="example-card" data-glyph="◌">No useful keywords yet. Pick richer sentences.</div>';
                return;
            }

            exampleChips.innerHTML = keywords.map(word => `<button class="example-chip" data-keyword="${escapeAttr(word)}">${escapeHtml(word)}</button>`).join('');
            exampleCards.innerHTML = renderExamplesForKeyword(keywords[0], chosen);

            exampleChips.querySelectorAll('.example-chip').forEach(chip => {
                chip.addEventListener('click', () => {
                    exampleCards.innerHTML = renderExamplesForKeyword(chip.dataset.keyword, chosen);
                });
            });
        }

        function renderExamplesForKeyword(keyword, chosen) {
            const base = chosen[0]?.text || '';
            const frames = [
                `Imagine ${keyword} in a normal Tuesday moment. What would it look like in real life, not in theory?`,
                `What is a bad version of ${keyword}, where someone thinks they are doing it but they are actually missing the point?`,
                `If you had to explain ${keyword} to a bright 9-year-old using one scene or object, what would you choose?`
            ];
            return frames.map((line, index) => `<div class="example-card" data-glyph="◈"><h3>Example ${index + 1}</h3><div>${escapeHtml(line)}</div><p class="muted">Anchor line: ${escapeHtml(base)}</p></div>`).join('');
        }

        function buildPrompts(chosen) {
            const prompts = [];
            const first = chosen[0]?.text || '';
            const last = chosen[chosen.length - 1]?.text || '';
            prompts.push(`Which sentence here changes your behaviour if you actually believe it? Why that one?`);
            if (first) prompts.push(`What concrete example would make this claim less abstract: “${first}”?`);
            if (last && last !== first) prompts.push(`What would someone who disagrees with this line say: “${last}”?`);
            discussionCards.innerHTML = prompts.map(prompt => `<div class="discussion-card" data-glyph="?">${escapeHtml(prompt)}</div>`).join('');
        }

        function extractKeywords(text) {
            const stop = new Set(['the','and','that','with','from','this','into','your','have','will','they','their','them','what','when','then','than','does','just','more','some','like','very','able','often','make','made','make','over','because','through','about','while','where','which','would','could','there','being','still','before','after','under','using','read','text']);
            const counts = {};
            for (const word of cleanWords(text)) {
                if (word.length < 4 || stop.has(word)) continue;
                counts[word] = (counts[word] || 0) + 1;
            }
            return Object.entries(counts).sort((a, b) => b[1] - a[1]).map(([word]) => word);
        }

        function renderSentencePool() {
            sentencePool.innerHTML = '';
            if (!sentences.length) {
                sentencePool.innerHTML = '<div class="sentence">Paste text and click <strong>Build my cheat sheet</strong>. The sentences will line up here for triage.</div>';
                return;
            }

            sentences.forEach((sentence, index) => {
                const btn = document.createElement('button');
                btn.className = 'sentence' + (selectedIds.has(sentence.id) ? ' selected' : '');
                btn.type = 'button';
                btn.innerHTML = `${escapeHtml(sentence.text)}<small>Sentence ${index + 1} · score ${sentence.score.toFixed(1)}</small>`;
                btn.addEventListener('click', () => {
                    if (selectedIds.has(sentence.id)) selectedIds.delete(sentence.id);
                    else selectedIds.add(sentence.id);
                    renderSentencePool();
                    summarizeSelection();
                });
                sentencePool.appendChild(btn);
            });
        }

        function analyzeText() {
            const raw = sourceText.value.trim();
            stopReading();
            window.speechSynthesis?.cancel();

            if (!raw) {
                sentences = [];
                selectedIds.clear();
                sentenceCount.textContent = '0';
                wordCount.textContent = '0';
                selectionCount.textContent = '0';
                statusText.textContent = 'Nothing to analyze yet. Even a beautiful desk needs some text.';
                renderSentencePool();
                summarizeSelection();
                return;
            }

            const parts = splitSentences(raw).map(part => part.trim()).filter(Boolean);
            sentences = parts.map((text, id) => ({ id, text, score: scoreSentence(text) }))
                .sort((a, b) => b.score - a.score || a.id - b.id);

            const autoSelected = sentences.slice(0, Math.min(4, sentences.length)).sort((a, b) => a.id - b.id);
            selectedIds = new Set(autoSelected.map(s => s.id));
            sentenceCount.textContent = String(parts.length);
            wordCount.textContent = String(cleanWords(raw).length);
            statusText.textContent = `Loaded ${parts.length} sentence${parts.length === 1 ? '' : 's'}. I picked a few likely keepers, because indecision is an enemy of studying.`;
            renderSentencePool();
            summarizeSelection();
        }

        function updateDownload() {
            const chosen = sentences.filter(s => selectedIds.has(s.id));
            const lines = [
                'Mnemonic Atelier Cheat Sheet',
                '',
                'ABRIDGED CORE'
            ];
            chosen.forEach(item => lines.push('- ' + item.text));
            lines.push('', 'DISCUSSION PROMPTS');
            document.querySelectorAll('#discussionCards .discussion-card').forEach(card => lines.push('- ' + card.textContent.trim()));
            lines.push('', 'READ-ALOUD LANE');
            document.querySelectorAll('#chantSheet .chant-line').forEach(card => lines.push('- ' + card.textContent.trim()));
            const blob = new Blob([lines.join('\n')], { type: 'text/plain' });
            const url = URL.createObjectURL(blob);
            downloadLink.href = url;
        }

        function startReading() {
            const lines = [...document.querySelectorAll('#chantSheet .chant-line')];
            if (!lines.length || lines[0].textContent.includes('selected summary lines')) return;
            stopReading();
            readIndex = 0;
            lines.forEach(line => line.classList.remove('active'));
            lines[0]?.classList.add('active');
            readTimer = setInterval(() => {
                lines.forEach(line => line.classList.remove('active'));
                lines[readIndex]?.classList.add('active');
                readIndex += 1;
                if (readIndex >= lines.length) readIndex = 0;
            }, 1800);
        }

        function stopReading() {
            if (readTimer) {
                clearInterval(readTimer);
                readTimer = null;
            }
            document.querySelectorAll('#chantSheet .chant-line').forEach((line, index) => {
                line.classList.toggle('active', index === 0);
            });
        }

        function speakSelection() {
            const chosen = sentences.filter(s => selectedIds.has(s.id));
            if (!chosen.length || !window.speechSynthesis) return;
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(chosen.map(c => c.text).join(' '));
            utterance.rate = 0.95;
            utterance.pitch = 1;
            utterance.lang = 'en-US';
            window.speechSynthesis.speak(utterance);
        }

        function escapeHtml(text) {
            return text.replace(/[&<>"']/g, char => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[char]));
        }

        function escapeAttr(text) {
            return text.replace(/"/g, '&quot;');
        }

        presets.forEach((preset, index) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'preset' + (index === 0 ? ' active' : '');
            button.textContent = preset.label;
            button.addEventListener('click', () => {
                document.querySelectorAll('.preset').forEach(item => item.classList.remove('active'));
                button.classList.add('active');
                sourceText.value = preset.text;
                analyzeText();
            });
            presetRow.appendChild(button);
        });

        analyzeBtn.addEventListener('click', analyzeText);
        clearBtn.addEventListener('click', () => {
            sourceText.value = '';
            analyzeText();
        });
        startReadBtn.addEventListener('click', startReading);
        stopReadBtn.addEventListener('click', () => {
            stopReading();
            window.speechSynthesis?.cancel();
        });
        speakBtn.addEventListener('click', speakSelection);

        sourceText.value = presets[0].text;
        analyzeText();
    </script>
</body>
</html>
