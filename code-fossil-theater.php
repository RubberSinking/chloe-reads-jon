<?php
$sourceTitle = 'SVN Time-Lapse View';
$sourceUrl = 'https://jona.ca/2007/10/svn-time-lapse-view.html';

$revisions = [
    [
        'id' => 'r101',
        'label' => 'R101',
        'date' => '2007-10-10',
        'author' => 'Jon',
        'note' => 'First rough cut. It loads a file and paints every line with the same sleepy brush.',
        'changed' => [1, 2, 3, 4, 5, 6, 7, 8],
        'risk' => 'Low',
        'insight' => 'The origin layer: simple, earnest, and one checkbox away from ambition.',
        'lines' => [
            ['no' => 1, 'text' => 'function renderTimeline(file) {', 'age' => 'R101'],
            ['no' => 2, 'text' => '  const revisions = loadRevisions(file);', 'age' => 'R101'],
            ['no' => 3, 'text' => '  const selected = revisions[0];', 'age' => 'R101'],
            ['no' => 4, 'text' => '  const html = selected.lines.join("\\n");', 'age' => 'R101'],
            ['no' => 5, 'text' => '  viewer.innerHTML = html;', 'age' => 'R101'],
            ['no' => 6, 'text' => '  footer.textContent = "Revision " + selected.id;', 'age' => 'R101'],
            ['no' => 7, 'text' => '  return revisions.length;', 'age' => 'R101'],
            ['no' => 8, 'text' => '}', 'age' => 'R101'],
        ],
    ],
    [
        'id' => 'r118',
        'label' => 'R118',
        'date' => '2007-10-12',
        'author' => 'Mila',
        'note' => 'Adds line numbers and a calmer footer because chaos was being a bit theatrical.',
        'changed' => [4, 5, 6, 7],
        'risk' => 'Low',
        'insight' => 'Structure arrives. The fossil starts wearing spectacles.',
        'lines' => [
            ['no' => 1, 'text' => 'function renderTimeline(file) {', 'age' => 'R101'],
            ['no' => 2, 'text' => '  const revisions = loadRevisions(file);', 'age' => 'R101'],
            ['no' => 3, 'text' => '  const selected = revisions[0];', 'age' => 'R101'],
            ['no' => 4, 'text' => '  const numbered = selected.lines.map((line, index) => pad(index + 1) + "  " + line);', 'age' => 'R118'],
            ['no' => 5, 'text' => '  viewer.innerHTML = numbered.join("\\n");', 'age' => 'R118'],
            ['no' => 6, 'text' => '  footer.textContent = `${selected.id} · ${selected.author} · ${selected.summary}`;', 'age' => 'R118'],
            ['no' => 7, 'text' => '  return numbered.length;', 'age' => 'R118'],
            ['no' => 8, 'text' => '}', 'age' => 'R101'],
        ],
    ],
    [
        'id' => 'r129',
        'label' => 'R129',
        'date' => '2007-10-13',
        'author' => 'Nathan',
        'note' => 'Introduces highlight spans so changed lines stop hiding like tiny guilty raccoons.',
        'changed' => [4, 5, 6],
        'risk' => 'Medium',
        'insight' => 'Visibility improves. So does the temptation to overdo the glow.',
        'lines' => [
            ['no' => 1, 'text' => 'function renderTimeline(file) {', 'age' => 'R101'],
            ['no' => 2, 'text' => '  const revisions = loadRevisions(file);', 'age' => 'R101'],
            ['no' => 3, 'text' => '  const selected = revisions[0];', 'age' => 'R101'],
            ['no' => 4, 'text' => '  const numbered = selected.lines.map((line, index) => wrapChange(index + 1, line, selected.changed));', 'age' => 'R129'],
            ['no' => 5, 'text' => '  viewer.innerHTML = numbered.join("\\n");', 'age' => 'R118'],
            ['no' => 6, 'text' => '  footer.textContent = `${selected.id} · ${selected.author} · ${selected.summary} · ${selected.changed.length} hot lines`;', 'age' => 'R129'],
            ['no' => 7, 'text' => '  return numbered.length;', 'age' => 'R118'],
            ['no' => 8, 'text' => '}', 'age' => 'R101'],
        ],
    ],
    [
        'id' => 'r141',
        'label' => 'R141',
        'date' => '2007-10-15',
        'author' => 'Jon',
        'note' => 'Adds a filter for changed lines only. Very useful. Also quietly plants a bug. Naturally.',
        'changed' => [3, 4, 5, 6],
        'risk' => 'Spicy',
        'insight' => 'This is the pivot point. Cleverness arrives holding a banana peel.',
        'lines' => [
            ['no' => 1, 'text' => 'function renderTimeline(file) {', 'age' => 'R101'],
            ['no' => 2, 'text' => '  const revisions = loadRevisions(file);', 'age' => 'R101'],
            ['no' => 3, 'text' => '  const selected = revisions[revisionSlider.value];', 'age' => 'R141'],
            ['no' => 4, 'text' => '  const numbered = selected.lines.filter(showDiffOnly).map((line, index) => wrapChange(index + 1, line, selected.changed));', 'age' => 'R141'],
            ['no' => 5, 'text' => '  viewer.innerHTML = numbered.join("\\n");', 'age' => 'R118'],
            ['no' => 6, 'text' => '  footer.textContent = `${selected.id} · diff mode ${showDiffOnly.name}`;', 'age' => 'R141'],
            ['no' => 7, 'text' => '  return numbered.length;', 'age' => 'R118'],
            ['no' => 8, 'text' => '}', 'age' => 'R101'],
        ],
    ],
    [
        'id' => 'r146',
        'label' => 'R146',
        'date' => '2007-10-16',
        'author' => 'Jon',
        'note' => 'Repairs the slider indexing bug and adds a human-readable mode label.',
        'changed' => [3, 4, 6],
        'risk' => 'Low',
        'insight' => 'The machine exhales. Someone finally noticed arrays start at zero.',
        'lines' => [
            ['no' => 1, 'text' => 'function renderTimeline(file) {', 'age' => 'R101'],
            ['no' => 2, 'text' => '  const revisions = loadRevisions(file);', 'age' => 'R101'],
            ['no' => 3, 'text' => '  const selected = revisions[Number(revisionSlider.value) - 1];', 'age' => 'R146'],
            ['no' => 4, 'text' => '  const activeLines = showDiffOnly.checked ? selected.changedLines : selected.lines;', 'age' => 'R146'],
            ['no' => 5, 'text' => '  viewer.innerHTML = activeLines.map((line, index) => wrapChange(index + 1, line, selected.changed)).join("\\n");', 'age' => 'R146'],
            ['no' => 6, 'text' => '  footer.textContent = `${selected.id} · ${showDiffOnly.checked ? "differences only" : "full file"}`;', 'age' => 'R146'],
            ['no' => 7, 'text' => '  return activeLines.length;', 'age' => 'R146'],
            ['no' => 8, 'text' => '}', 'age' => 'R101'],
        ],
    ],
    [
        'id' => 'r153',
        'label' => 'R153',
        'date' => '2007-10-18',
        'author' => 'Chloe',
        'note' => 'Adds a blame strip and a tiny detective prompt because every codebase deserves one overdramatic archivist.',
        'changed' => [5, 6, 7],
        'risk' => 'Low',
        'insight' => 'Utility becomes theater, which is honestly how the best tools tend to grow.',
        'lines' => [
            ['no' => 1, 'text' => 'function renderTimeline(file) {', 'age' => 'R101'],
            ['no' => 2, 'text' => '  const revisions = loadRevisions(file);', 'age' => 'R101'],
            ['no' => 3, 'text' => '  const selected = revisions[Number(revisionSlider.value) - 1];', 'age' => 'R146'],
            ['no' => 4, 'text' => '  const activeLines = showDiffOnly.checked ? selected.changedLines : selected.lines;', 'age' => 'R146'],
            ['no' => 5, 'text' => '  viewer.innerHTML = activeLines.map((line, index) => wrapChange(index + 1, line, selected.changed, selected.lineAges[index])).join("\\n");', 'age' => 'R153'],
            ['no' => 6, 'text' => '  updateBlameMap(selected.lineAges);', 'age' => 'R153'],
            ['no' => 7, 'text' => '  footer.textContent = `${selected.id} · ${showDiffOnly.checked ? "differences only" : "full file"} · archive stable`;', 'age' => 'R153'],
            ['no' => 8, 'text' => '}', 'age' => 'R101'],
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Fossil Theater</title>
    <style>
        :root {
            --bg: #120f0b;
            --bg-alt: #1b1510;
            --panel: rgba(37, 28, 19, 0.88);
            --panel-strong: rgba(52, 40, 28, 0.94);
            --line: rgba(255, 224, 173, 0.18);
            --gold: #f6c777;
            --amber: #ffab4d;
            --cream: #f7eddc;
            --muted: #c8b28c;
            --rose: #f58976;
            --teal: #82d8d8;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Palatino Linotype", "Book Antiqua", Georgia, serif;
            color: var(--cream);
            background:
                radial-gradient(circle at top left, rgba(255, 194, 102, 0.12), transparent 34%),
                radial-gradient(circle at top right, rgba(129, 214, 214, 0.08), transparent 28%),
                linear-gradient(145deg, #0f0c09 0%, #17120d 52%, #0d0907 100%);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 24px 24px;
            mask-image: radial-gradient(circle at center, black 44%, transparent 100%);
            opacity: 0.35;
        }

        a {
            color: var(--gold);
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        .shell {
            width: min(1180px, calc(100% - 28px));
            margin: 0 auto;
            padding: 28px 0 42px;
        }

        .hero {
            position: relative;
            padding: 26px;
            border: 1px solid var(--line);
            border-radius: 28px;
            background:
                linear-gradient(135deg, rgba(255, 216, 157, 0.08), rgba(255, 171, 77, 0.01)),
                var(--panel);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero::after {
            content: "";
            position: absolute;
            right: -80px;
            top: -80px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 199, 119, 0.2), transparent 70%);
            filter: blur(4px);
        }

        .eyebrow {
            display: inline-flex;
            gap: 10px;
            align-items: center;
            padding: 8px 14px;
            border: 1px solid rgba(255, 226, 179, 0.18);
            border-radius: 999px;
            font-size: 0.82rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            background: rgba(255, 255, 255, 0.03);
        }

        h1 {
            margin: 18px 0 10px;
            font-size: clamp(2.8rem, 7vw, 5.7rem);
            line-height: 0.92;
            letter-spacing: -0.05em;
            max-width: 8ch;
        }

        .lede {
            max-width: 62ch;
            margin: 0 0 18px;
            font-size: 1.08rem;
            line-height: 1.7;
            color: #ead9bd;
        }

        .hero-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-links a,
        .hero-links button {
            appearance: none;
            border: 1px solid rgba(255, 213, 150, 0.24);
            background: rgba(255, 255, 255, 0.045);
            color: var(--cream);
            border-radius: 999px;
            padding: 12px 16px;
            font: inherit;
            cursor: pointer;
            transition: transform 160ms ease, background 160ms ease, border-color 160ms ease;
            text-decoration: none;
        }

        .hero-links a:hover,
        .hero-links button:hover {
            transform: translateY(-2px);
            background: rgba(255, 199, 119, 0.12);
            border-color: rgba(255, 213, 150, 0.4);
        }

        .grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 20px;
            margin-top: 20px;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: 24px;
            background: var(--panel);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(255,255,255,0.06), transparent);
        }

        .panel-header h2,
        .panel-header h3 {
            margin: 0;
            font-size: 1.1rem;
            letter-spacing: 0.02em;
        }

        .panel-header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .timeline-body {
            padding: 20px;
        }

        .revision-meter {
            display: grid;
            gap: 14px;
            margin-bottom: 18px;
        }

        .slider-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 14px;
            align-items: center;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .revision-pill {
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 212, 147, 0.2);
            font-size: 0.95rem;
            min-width: 106px;
            text-align: center;
        }

        .toggle-row {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: center;
            flex-wrap: wrap;
        }

        .toggle {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--cream);
        }

        .toggle input {
            width: 20px;
            height: 20px;
            accent-color: var(--amber);
        }

        .mini-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 18px;
        }

        .stat {
            border-radius: 18px;
            padding: 14px;
            border: 1px solid rgba(255, 230, 190, 0.1);
            background: rgba(255, 255, 255, 0.035);
        }

        .stat-label {
            display: block;
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.13em;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 1.05rem;
        }

        .code-wrap {
            padding: 0 18px 18px;
        }

        .code-window {
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(7, 5, 4, 0.9), rgba(21, 16, 12, 0.96));
            border: 1px solid rgba(255, 226, 179, 0.12);
            overflow: hidden;
        }

        .window-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            background: rgba(255, 255, 255, 0.035);
        }

        .window-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--rose);
            box-shadow: 18px 0 0 var(--gold), 36px 0 0 var(--teal);
            margin-right: 38px;
        }

        .window-title {
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
        }

        pre {
            margin: 0;
            padding: 16px 0;
            overflow: auto;
            font-family: Menlo, Consolas, "Liberation Mono", monospace;
            font-size: 0.97rem;
            line-height: 1.62;
            color: #f7f1e7;
        }

        .code-line {
            display: grid;
            grid-template-columns: 62px 1fr auto;
            gap: 12px;
            padding: 0 18px;
            align-items: baseline;
            white-space: pre-wrap;
        }

        .code-line.changed {
            background: linear-gradient(90deg, rgba(255, 171, 77, 0.17), transparent 70%);
        }

        .code-line.highlight {
            outline: 1px solid rgba(245, 137, 118, 0.55);
            outline-offset: -1px;
            background: linear-gradient(90deg, rgba(245, 137, 118, 0.24), rgba(255, 171, 77, 0.05));
        }

        .ln {
            color: rgba(255, 221, 170, 0.55);
            text-align: right;
            user-select: none;
        }

        .age-tag {
            font-size: 0.7rem;
            color: var(--muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .aside-stack {
            display: grid;
            gap: 20px;
        }

        .story {
            padding: 18px 20px 20px;
        }

        .story-note {
            margin: 0 0 18px;
            font-size: 1rem;
            line-height: 1.65;
            color: #f0dfc2;
        }

        .risk-chip {
            display: inline-flex;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 0.8rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(255, 171, 77, 0.12);
            border: 1px solid rgba(255, 171, 77, 0.18);
        }

        .blame-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            padding: 18px 20px 20px;
        }

        .blame-cell {
            border-radius: 16px;
            padding: 12px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 214, 154, 0.08);
            min-height: 76px;
        }

        .blame-cell strong {
            display: block;
            font-size: 0.8rem;
            color: var(--muted);
            margin-bottom: 8px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .blame-cell span {
            font-size: 1rem;
        }

        .quiz-body {
            padding: 18px 20px 20px;
        }

        .suspects {
            display: grid;
            gap: 10px;
            margin: 16px 0;
        }

        .suspect {
            width: 100%;
            text-align: left;
            appearance: none;
            border: 1px solid rgba(255, 223, 177, 0.16);
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            color: var(--cream);
            padding: 14px 16px;
            font: inherit;
            cursor: pointer;
            transition: transform 140ms ease, border-color 140ms ease, background 140ms ease;
        }

        .suspect:hover,
        .suspect:focus-visible {
            transform: translateX(4px);
            border-color: rgba(255, 199, 119, 0.38);
            background: rgba(255, 199, 119, 0.08);
            outline: none;
        }

        .suspect.correct {
            border-color: rgba(130, 216, 216, 0.5);
            background: rgba(130, 216, 216, 0.12);
        }

        .suspect.wrong {
            border-color: rgba(245, 137, 118, 0.5);
            background: rgba(245, 137, 118, 0.1);
        }

        .verdict {
            min-height: 52px;
            border-radius: 16px;
            padding: 12px 14px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            color: #eedcbf;
            line-height: 1.55;
        }

        .footer-note {
            margin-top: 18px;
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
        }

        @media (max-width: 940px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .mini-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .shell {
                width: min(100% - 18px, 1000px);
                padding-top: 16px;
            }

            .hero,
            .panel {
                border-radius: 22px;
            }

            h1 {
                font-size: clamp(2.4rem, 14vw, 4rem);
            }

            .panel-header,
            .timeline-body,
            .story,
            .quiz-body,
            .blame-grid {
                padding-left: 16px;
                padding-right: 16px;
            }

            .code-line {
                grid-template-columns: 44px 1fr;
            }

            .age-tag {
                display: none;
            }

            .blame-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="eyebrow">Code Archeology Wing <span>·</span> Revision drama, respectfully curated</div>
            <h1>Code Fossil Theater</h1>
            <p class="lede">A little museum for source history. Slide through revisions, flip on “differences only,” and try to catch the exact moment a clever change turned into a banana-peel bug. Inspired by Jon’s delight in a time-lapse view for code history, which frankly remains an excellent sort of nerd joy.</p>
            <div class="hero-links">
                <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener noreferrer">Inspired by Jon's “<?= htmlspecialchars($sourceTitle) ?>”</a>
                <a href="./">Back to Chloe Reads Jon</a>
                <button type="button" id="jumpBug">Jump to the suspicious revision</button>
            </div>
        </section>

        <div class="grid">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2>Revision Scrubber</h2>
                        <p>Slide through the fossil layers and see how one humble function gets smarter, louder, and briefly more broken.</p>
                    </div>
                    <div class="revision-pill" id="revisionBadge">R101</div>
                </div>
                <div class="timeline-body">
                    <div class="revision-meter">
                        <div class="slider-row">
                            <input id="revisionSlider" type="range" min="1" max="<?= count($revisions) ?>" value="1">
                            <span id="revisionDate">2007-10-10</span>
                        </div>
                        <div class="toggle-row">
                            <label class="toggle"><input id="diffOnly" type="checkbox"> Show differences only</label>
                            <span id="changeSummary">8 lines visible</span>
                        </div>
                    </div>
                    <div class="mini-stats">
                        <div class="stat">
                            <span class="stat-label">Archivist</span>
                            <span class="stat-value" id="metaAuthor">Jon</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Risk Level</span>
                            <span class="stat-value" id="metaRisk">Low</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Changed Lines</span>
                            <span class="stat-value" id="metaChanged">8</span>
                        </div>
                        <div class="stat">
                            <span class="stat-label">Mode</span>
                            <span class="stat-value" id="metaMode">Full file</span>
                        </div>
                    </div>
                </div>
                <div class="code-wrap">
                    <div class="code-window">
                        <div class="window-bar">
                            <span class="window-dot"></span>
                            <span class="window-title">timeline-viewer.js</span>
                        </div>
                        <pre id="codeView" aria-live="polite"></pre>
                    </div>
                </div>
            </section>

            <aside class="aside-stack">
                <section class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Curator's Note</h3>
                            <p>Every revision says something about the mood of the coder who touched it.</p>
                        </div>
                    </div>
                    <div class="story">
                        <p class="story-note" id="revisionNote"></p>
                        <div class="risk-chip" id="insightChip"></div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Blame Mosaic</h3>
                            <p>Which revision still owns each visible line? Tiny geology, but for code.</p>
                        </div>
                    </div>
                    <div class="blame-grid" id="blameGrid"></div>
                </section>

                <section class="panel">
                    <div class="panel-header">
                        <div>
                            <h3>Bug Detective</h3>
                            <p>One revision introduces the indexing bug. Pick the culprit and see if your dramatic instincts are sound.</p>
                        </div>
                    </div>
                    <div class="quiz-body">
                        <div class="suspects">
                            <button class="suspect" data-revision="R118">R118 · the tasteful line-number pass</button>
                            <button class="suspect" data-revision="R129">R129 · the glow-up with hot lines</button>
                            <button class="suspect" data-revision="R141">R141 · the diff-only checkbox lands</button>
                            <button class="suspect" data-revision="R146">R146 · the calm corrective patch</button>
                        </div>
                        <div class="verdict" id="verdict">The archive awaits your accusation.</div>
                    </div>
                </section>
            </aside>
        </div>

        <p class="footer-note">Inspired by Jon's <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($sourceTitle) ?></a>. A neat tool idea, and still weirdly cinematic.</p>
    </div>

    <script>
        const revisions = <?= json_encode($revisions, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        const slider = document.getElementById('revisionSlider');
        const diffOnly = document.getElementById('diffOnly');
        const codeView = document.getElementById('codeView');
        const revisionBadge = document.getElementById('revisionBadge');
        const revisionDate = document.getElementById('revisionDate');
        const revisionNote = document.getElementById('revisionNote');
        const insightChip = document.getElementById('insightChip');
        const metaAuthor = document.getElementById('metaAuthor');
        const metaRisk = document.getElementById('metaRisk');
        const metaChanged = document.getElementById('metaChanged');
        const metaMode = document.getElementById('metaMode');
        const changeSummary = document.getElementById('changeSummary');
        const blameGrid = document.getElementById('blameGrid');
        const jumpBug = document.getElementById('jumpBug');
        const verdict = document.getElementById('verdict');
        const suspectButtons = [...document.querySelectorAll('.suspect')];

        function escapeHtml(text) {
            return text
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;');
        }

        function renderBlame(lines) {
            blameGrid.innerHTML = '';
            lines.forEach((line) => {
                const cell = document.createElement('div');
                cell.className = 'blame-cell';
                cell.innerHTML = `<strong>Line ${line.no}</strong><span>${line.age}</span>`;
                blameGrid.appendChild(cell);
            });
        }

        function renderRevision() {
            const revision = revisions[Number(slider.value) - 1];
            const visibleLines = diffOnly.checked
                ? revision.lines.filter((line) => revision.changed.includes(line.no))
                : revision.lines;

            codeView.innerHTML = visibleLines.map((line) => {
                const changed = revision.changed.includes(line.no) ? ' changed' : '';
                const highlight = revision.id === 'r141' && [3, 4].includes(line.no) ? ' highlight' : '';
                return `<div class="code-line${changed}${highlight}">
                    <span class="ln">${line.no}</span>
                    <span>${escapeHtml(line.text)}</span>
                    <span class="age-tag">${line.age}</span>
                </div>`;
            }).join('');

            revisionBadge.textContent = revision.label;
            revisionDate.textContent = revision.date;
            revisionNote.textContent = revision.note;
            insightChip.textContent = revision.insight;
            metaAuthor.textContent = revision.author;
            metaRisk.textContent = revision.risk;
            metaChanged.textContent = revision.changed.length;
            metaMode.textContent = diffOnly.checked ? 'Diff only' : 'Full file';
            changeSummary.textContent = `${visibleLines.length} line${visibleLines.length === 1 ? '' : 's'} visible`;
            renderBlame(visibleLines);
        }

        slider.addEventListener('input', renderRevision);
        diffOnly.addEventListener('change', renderRevision);
        jumpBug.addEventListener('click', () => {
            slider.value = '4';
            diffOnly.checked = false;
            renderRevision();
            verdict.textContent = 'Transported to R141, where the clever diff-only trick also slips in the off-by-one bug. Lovely. Menacing. Classic.';
        });

        suspectButtons.forEach((button) => {
            button.addEventListener('click', () => {
                suspectButtons.forEach((item) => item.classList.remove('correct', 'wrong'));
                const chosen = button.dataset.revision;
                if (chosen === 'R141') {
                    button.classList.add('correct');
                    verdict.textContent = 'Correct. R141 grabs `revisions[revisionSlider.value]`, which skips past the first entry because sliders count from 1 while arrays begin at 0. A tiny indexing wobble, an old classic.';
                    slider.value = '4';
                    diffOnly.checked = false;
                    renderRevision();
                } else {
                    button.classList.add('wrong');
                    verdict.textContent = `${chosen} is innocent-ish. The real mischief arrives in R141, where the new diff-only feature forgets that arrays do not share its optimism.`;
                }
            });
        });

        renderRevision();
    </script>
</body>
</html>
