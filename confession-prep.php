<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examination of Conscience</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0e0d14;
            --surface:   #16151f;
            --card:      #1e1c2a;
            --card-open: #221f30;
            --border:    #302d42;
            --gold:      #c8a94d;
            --gold-dim:  #7a6530;
            --text:      #e8e4d8;
            --text-dim:  #9490a0;
            --text-mute: #5a5670;
            --checked:   #4a8c6a;
            --flame1:    #ff9c40;
            --flame2:    #e05020;
            --radius:    12px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* ── Ambient background ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 40% at 50% 0%, rgba(200,169,77,0.07) 0%, transparent 70%),
                radial-gradient(ellipse 40% 60% at 20% 100%, rgba(74,140,106,0.04) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .wrap {
            position: relative;
            z-index: 1;
            max-width: 680px;
            margin: 0 auto;
            padding: 48px 20px 80px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .candle-wrap {
            display: inline-block;
            margin-bottom: 20px;
        }

        .candle {
            position: relative;
            width: 14px;
            height: 56px;
            background: linear-gradient(to bottom, #f0e8c8 0%, #d4c08a 100%);
            border-radius: 3px 3px 2px 2px;
            margin: 0 auto;
        }

        .candle::after {
            content: '';
            position: absolute;
            top: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 6px;
            background: #333;
            border-radius: 1px;
        }

        .flame {
            position: absolute;
            bottom: calc(100% + 2px);
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 16px;
        }

        .flame svg {
            width: 100%;
            height: 100%;
            animation: flicker 2.5s ease-in-out infinite alternate;
        }

        @keyframes flicker {
            0%   { transform: scaleX(1)   scaleY(1)    rotate(-1deg); opacity: 1; }
            25%  { transform: scaleX(0.9) scaleY(1.05) rotate(1deg);  opacity: 0.95; }
            50%  { transform: scaleX(1.1) scaleY(0.95) rotate(-2deg); opacity: 1; }
            75%  { transform: scaleX(0.95) scaleY(1.02) rotate(0.5deg); opacity: 0.98; }
            100% { transform: scaleX(1.05) scaleY(1)    rotate(1.5deg); opacity: 1; }
        }

        .glow {
            position: absolute;
            bottom: calc(100% - 4px);
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,160,60,0.35) 0%, transparent 70%);
            animation: glow-pulse 2.5s ease-in-out infinite alternate;
        }

        @keyframes glow-pulse {
            0%   { opacity: 0.8; transform: translateX(-50%) scale(1); }
            50%  { opacity: 1;   transform: translateX(-50%) scale(1.2); }
            100% { opacity: 0.7; transform: translateX(-50%) scale(0.95); }
        }

        h1 {
            font-size: 2em;
            font-weight: normal;
            letter-spacing: 0.04em;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .subtitle {
            color: var(--text-dim);
            font-size: 0.95em;
            font-style: italic;
            margin-bottom: 24px;
        }

        /* ── Opening prayer ── */
        .prayer-block {
            background: var(--surface);
            border: 1px solid var(--border);
            border-left: 3px solid var(--gold-dim);
            border-radius: var(--radius);
            padding: 20px 24px;
            margin-bottom: 36px;
            font-style: italic;
            color: var(--text-dim);
            font-size: 0.95em;
            line-height: 1.8;
        }

        .prayer-block strong {
            display: block;
            font-style: normal;
            font-size: 0.8em;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 10px;
        }

        /* ── Progress ── */
        .progress-wrap {
            margin-bottom: 28px;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.82em;
            color: var(--text-mute);
            margin-bottom: 6px;
        }

        .progress-bar {
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--gold-dim), var(--gold));
            border-radius: 2px;
            transition: width 0.4s ease;
        }

        /* ── Commandment accordion ── */
        .commandments { display: flex; flex-direction: column; gap: 10px; }

        .cmd-item {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .cmd-item.open {
            background: var(--card-open);
            border-color: var(--gold-dim);
        }

        .cmd-item.complete {
            border-color: var(--checked);
        }

        .cmd-header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            cursor: pointer;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        .cmd-num {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            color: var(--text-mute);
            font-family: system-ui, sans-serif;
            font-weight: 600;
            transition: background 0.2s, color 0.2s;
        }

        .cmd-item.complete .cmd-num {
            background: var(--checked);
            color: #fff;
        }

        .cmd-title {
            flex: 1;
            font-size: 0.95em;
            line-height: 1.4;
        }

        .cmd-title .roman {
            font-size: 0.75em;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--gold-dim);
            display: block;
            margin-bottom: 1px;
            font-family: system-ui, sans-serif;
        }

        .cmd-chevron {
            flex-shrink: 0;
            color: var(--text-mute);
            transition: transform 0.3s;
            font-size: 0.8em;
        }

        .cmd-item.open .cmd-chevron { transform: rotate(180deg); }

        .cmd-body {
            display: none;
            padding: 0 18px 18px;
            border-top: 1px solid var(--border);
            padding-top: 16px;
        }

        .cmd-item.open .cmd-body { display: block; }

        .questions { display: flex; flex-direction: column; gap: 10px; }

        .question-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
            padding: 10px 12px;
            border-radius: 8px;
            transition: background 0.15s;
            -webkit-tap-highlight-color: transparent;
        }

        .question-item:hover { background: rgba(255,255,255,0.03); }
        .question-item.checked { background: rgba(74,140,106,0.08); }

        .q-check {
            flex-shrink: 0;
            width: 22px;
            height: 22px;
            border: 2px solid var(--border);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1px;
            transition: border-color 0.2s, background 0.2s;
        }

        .question-item.checked .q-check {
            background: var(--checked);
            border-color: var(--checked);
        }

        .q-check svg { display: none; }
        .question-item.checked .q-check svg { display: block; }

        .q-text {
            font-size: 0.9em;
            color: var(--text-dim);
            line-height: 1.55;
        }

        .question-item.checked .q-text {
            color: var(--text);
        }

        /* ── Summary / Next Steps ── */
        .summary {
            margin-top: 36px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .summary-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .summary-header h2 {
            font-size: 1em;
            font-weight: normal;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-family: system-ui, sans-serif;
            color: var(--gold);
            font-size: 0.82em;
        }

        .clear-btn {
            background: none;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 5px 12px;
            font-size: 0.78em;
            color: var(--text-mute);
            cursor: pointer;
            font-family: system-ui, sans-serif;
            transition: border-color 0.2s, color 0.2s;
        }

        .clear-btn:hover { border-color: #c0392b; color: #c0392b; }

        .summary-body { padding: 18px 20px; }

        .summary-empty {
            color: var(--text-mute);
            font-style: italic;
            font-size: 0.9em;
        }

        .summary-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .summary-section h3 {
            font-size: 0.75em;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-family: system-ui, sans-serif;
            color: var(--gold-dim);
            margin-bottom: 6px;
        }

        .summary-section ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .summary-section li {
            font-size: 0.875em;
            color: var(--text-dim);
            padding-left: 14px;
            position: relative;
        }

        .summary-section li::before {
            content: '·';
            position: absolute;
            left: 2px;
            color: var(--checked);
        }

        /* ── Closing prayer ── */
        .closing {
            margin-top: 28px;
            padding: 18px 20px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-left: 3px solid var(--gold-dim);
            border-radius: var(--radius);
            font-style: italic;
            color: var(--text-mute);
            font-size: 0.88em;
            line-height: 1.8;
        }

        .closing strong {
            display: block;
            font-style: normal;
            font-size: 0.78em;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold-dim);
            margin-bottom: 10px;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 56px;
            text-align: center;
            font-size: 0.78em;
            font-family: system-ui, sans-serif;
            color: var(--text-mute);
        }

        .footer a { color: var(--text-mute); }

        @media (max-width: 420px) {
            h1 { font-size: 1.6em; }
            .cmd-header { padding: 14px 14px; }
            .cmd-body { padding: 0 14px 14px; padding-top: 14px; }
        }
    </style>
</head>
<body>
<div class="wrap">

    <!-- Header -->
    <div class="header">
        <div class="candle-wrap">
            <div class="candle">
                <div class="glow"></div>
                <div class="flame">
                    <svg viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 17 C1.5 17 0 13.5 0 10.5 C0 6.5 3 4 4 1 C4.5 3.5 6 5 7.5 7 C9 9 10 11 10 13 C10 15.5 8 17 5 17Z" fill="url(#flameGrad)"/>
                        <path d="M5 14.5 C3.5 14.5 3 12.5 3.5 11 C4 9.5 5 8.5 5 7.5 C5.3 8.8 6.2 9.8 6.5 11 C6.8 12.2 6.5 14.5 5 14.5Z" fill="rgba(255,240,200,0.7)"/>
                        <defs>
                            <linearGradient id="flameGrad" x1="5" y1="0" x2="5" y2="18" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#ffe04a"/>
                                <stop offset="40%" stop-color="#ff9c40"/>
                                <stop offset="100%" stop-color="#e03010"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
        <h1>Examination of Conscience</h1>
        <p class="subtitle">A quiet guide to preparing for Confession</p>
    </div>

    <!-- Opening Prayer -->
    <div class="prayer-block">
        <strong>Before You Begin</strong>
        Come, Holy Spirit, enlighten my heart to see myself as God sees me.
        Give me the grace of true sorrow for my sins,
        a firm purpose of amendment,
        and the courage to make a good Confession.<br><br>
        Take a few slow breaths. You are in God's presence.
    </div>

    <!-- Progress -->
    <div class="progress-wrap">
        <div class="progress-label">
            <span id="progressText">0 of 10 commandments reviewed</span>
            <span id="checkedCount">0 items marked</span>
        </div>
        <div class="progress-bar"><div class="progress-fill" id="progressFill" style="width:0%"></div></div>
    </div>

    <!-- Commandments Accordion -->
    <div class="commandments" id="commandments">
    <?php
    $commandments = [
        [
            "roman" => "I",
            "title" => "You shall have no other gods before Me",
            "questions" => [
                "Have I put anything—work, comfort, reputation, money, a relationship—above God in my daily life?",
                "Have I neglected prayer, going days or weeks without speaking to God?",
                "Have I doubted or denied my faith out of fear of others' opinions?",
                "Have I dabbled in superstition, horoscopes, tarot, or the occult?",
                "Have I trusted more in my own abilities than in God's providence?",
                "Have I been indifferent to God—neither hot nor cold, just going through the motions?",
            ]
        ],
        [
            "roman" => "II",
            "title" => "You shall not take the name of the Lord in vain",
            "questions" => [
                "Have I used God's name, Jesus' name, or the names of saints as a curse word or in anger?",
                "Have I made promises or oaths in God's name and then broken them?",
                "Have I spoken about sacred things carelessly or mockingly?",
                "Have I blasphemed—spoken disrespectfully of God, the Church, or holy things?",
            ]
        ],
        [
            "roman" => "III",
            "title" => "Remember to keep holy the Lord's Day",
            "questions" => [
                "Have I intentionally missed Mass on Sunday or a Holy Day of Obligation without good reason?",
                "Have I attended Mass distracted, late, or without any real effort to participate?",
                "Have I done unnecessary servile work on Sunday, or required others to?",
                "Have I treated Sunday like any other day—no prayer, no rest, no family time?",
            ]
        ],
        [
            "roman" => "IV",
            "title" => "Honor your father and your mother",
            "questions" => [
                "Have I been disrespectful, dismissive, or unkind to my parents or elders?",
                "Have I neglected family duties—as a spouse, parent, or child?",
                "Have I been impatient or harsh with my children?",
                "Have I failed to pass on the faith to those in my care?",
                "Have I disobeyed legitimate authority at work, in the Church, or in civil life without just cause?",
                "Have I failed to care for aging parents or relatives when I was able to?",
            ]
        ],
        [
            "roman" => "V",
            "title" => "You shall not kill",
            "questions" => [
                "Have I harbored anger, hatred, or resentment toward someone, refusing to forgive?",
                "Have I spoken cruel words intended to wound someone?",
                "Have I endangered my own health through recklessness, addiction, or neglect?",
                "Have I failed to help someone in serious need when I was able to?",
                "Have I destroyed someone's reputation or relationships through gossip or cruelty?",
                "Have I struggled with thoughts of hopelessness or harming myself, and not sought help?",
            ]
        ],
        [
            "roman" => "VI & IX",
            "title" => "You shall not commit adultery · You shall not covet your neighbor's wife",
            "questions" => [
                "Have I been unfaithful in thought, word, or action to my spouse or my vow of chastity?",
                "Have I deliberately sought out impure images, videos, or literature?",
                "Have I entertained impure thoughts, dwelling on them instead of turning away?",
                "Have I acted immodestly in dress, speech, or behavior—leading others into temptation?",
                "Have I engaged in sexual activity outside of marriage?",
                "Have I been a fair witness to my own situation—honest with myself about these things?",
            ]
        ],
        [
            "roman" => "VII & X",
            "title" => "You shall not steal · You shall not covet your neighbor's goods",
            "questions" => [
                "Have I taken something that wasn't mine, or used another's property without permission?",
                "Have I been dishonest in business, at work, or in financial dealings?",
                "Have I failed to pay a fair wage, or accepted a wage that was unfair?",
                "Have I been enslaved by envy—resentful of what others have?",
                "Have I wasted time or resources that were not mine to waste?",
                "Have I cheated on taxes, expenses, or other obligations?",
                "Have I been stingy in giving, when I had the means to be generous?",
            ]
        ],
        [
            "roman" => "VIII",
            "title" => "You shall not bear false witness against your neighbor",
            "questions" => [
                "Have I lied—even small lies told to protect myself or avoid discomfort?",
                "Have I gossiped, shared private information about others, or enjoyed others' failures?",
                "Have I ruined someone's reputation through slander or detraction?",
                "Have I been two-faced—saying one thing to someone's face and another behind their back?",
                "Have I failed to speak up for the truth when I had a duty to do so?",
                "Have I deceived through silence, half-truths, or misleading framing?",
            ]
        ],
        [
            "roman" => "+",
            "title" => "Duties to the Church",
            "questions" => [
                "Have I made a good Confession at least once in the past year?",
                "Have I received Communion while in a state of mortal sin?",
                "Have I contributed to the needs of the Church according to my means?",
                "Have I fasted on required days (Ash Wednesday, Good Friday)?",
                "Have I abstained from meat on Fridays of Lent?",
                "Have I supported the Church's mission through prayer, time, or treasure?",
            ]
        ],
        [
            "roman" => "✦",
            "title" => "General Examination",
            "questions" => [
                "Have I been proud—thinking more highly of myself than I ought, unwilling to be corrected?",
                "Have I been slothful—neglecting my spiritual life, my duties, or the good I could have done?",
                "Have I been gluttonous—overindulging in food, drink, entertainment, or comfort?",
                "Is there a pattern of sin I keep returning to, that I've not truly resolved to change?",
                "Have I accepted God's forgiveness before, yet refused to forgive myself or others?",
                "Is there anything else on my heart that I know I need to bring to God?",
            ]
        ],
    ];

    foreach ($commandments as $i => $cmd):
        $idx = $i + 1;
    ?>
        <div class="cmd-item" id="cmd-<?= $idx ?>" data-index="<?= $idx ?>">
            <div class="cmd-header" onclick="toggleCmd(<?= $idx ?>)">
                <div class="cmd-num"><?= $idx ?></div>
                <div class="cmd-title">
                    <span class="roman"><?= htmlspecialchars($cmd['roman']) ?></span>
                    <?= htmlspecialchars($cmd['title']) ?>
                </div>
                <div class="cmd-chevron">▼</div>
            </div>
            <div class="cmd-body">
                <div class="questions">
                    <?php foreach ($cmd['questions'] as $qi => $q): ?>
                    <div class="question-item" id="q-<?= $idx ?>-<?= $qi ?>" onclick="toggleQ(<?= $idx ?>, <?= $qi ?>)">
                        <div class="q-check">
                            <svg width="12" height="10" viewBox="0 0 12 10" fill="none">
                                <path d="M1 5L4.5 8.5L11 1.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="q-text"><?= htmlspecialchars($q) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <!-- Summary -->
    <div class="summary" id="summary">
        <div class="summary-header">
            <h2>For Your Confession</h2>
            <button class="clear-btn" onclick="clearAll()">Clear all</button>
        </div>
        <div class="summary-body">
            <div class="summary-empty" id="summaryEmpty">
                Check items above as you reflect. They'll appear here as a summary you can bring to the confessional.
            </div>
            <div class="summary-list" id="summaryList"></div>
        </div>
    </div>

    <!-- Closing Prayer -->
    <div class="closing">
        <strong>Act of Contrition</strong>
        O my God, I am heartily sorry for having offended Thee,
        and I detest all my sins because of Thy just punishments,
        but most of all because they offend Thee, my God,
        Who art all-good and deserving of all my love.
        I firmly resolve, with the help of Thy grace,
        to sin no more and to avoid the near occasions of sin.
        Amen.
    </div>

    <div class="footer">
        <a href="index.php">← Chloe Reads Jon</a>
    </div>

</div>

<script>
// ── Data from PHP ──
const CMD_DATA = <?php
    $out = [];
    foreach ($commandments as $i => $cmd) {
        $out[] = [
            'roman' => $cmd['roman'],
            'title' => $cmd['title'],
            'qCount' => count($cmd['questions']),
        ];
    }
    echo json_encode($out);
?>;

const TOTAL_CMDS = CMD_DATA.length;

// ── State ──
// state[cmdIndex][qIndex] = true/false
let state = {};
let openCmd = null;

function loadState() {
    try {
        const saved = localStorage.getItem('confessionState');
        if (saved) state = JSON.parse(saved);
    } catch(e) {}
    // ensure all keys exist
    CMD_DATA.forEach((_, i) => {
        const idx = i + 1;
        if (!state[idx]) state[idx] = {};
    });
}

function saveState() {
    try {
        localStorage.setItem('confessionState', JSON.stringify(state));
    } catch(e) {}
}

function toggleCmd(idx) {
    const el = document.getElementById('cmd-' + idx);
    if (openCmd === idx) {
        el.classList.remove('open');
        openCmd = null;
    } else {
        if (openCmd !== null) {
            document.getElementById('cmd-' + openCmd)?.classList.remove('open');
        }
        el.classList.add('open');
        openCmd = idx;
    }
}

function toggleQ(cmdIdx, qIdx) {
    const key = qIdx;
    state[cmdIdx][key] = !state[cmdIdx][key];
    saveState();
    renderQ(cmdIdx, qIdx);
    updateCmdComplete(cmdIdx);
    updateProgress();
    renderSummary();
}

function renderQ(cmdIdx, qIdx) {
    const el = document.getElementById('q-' + cmdIdx + '-' + qIdx);
    if (!el) return;
    if (state[cmdIdx][qIdx]) {
        el.classList.add('checked');
    } else {
        el.classList.remove('checked');
    }
}

function updateCmdComplete(idx) {
    const el = document.getElementById('cmd-' + idx);
    if (!el) return;
    const hasAny = Object.values(state[idx] || {}).some(v => v);
    if (hasAny) {
        el.classList.add('complete');
    } else {
        el.classList.remove('complete');
    }
}

function updateProgress() {
    // "reviewed" = commandment has been opened at some point (we'll track separately)
    // For simplicity, "reviewed" = any item checked in that section
    const checkedSections = CMD_DATA.reduce((acc, _, i) => {
        const idx = i + 1;
        return acc + (Object.values(state[idx] || {}).some(v => v) ? 1 : 0);
    }, 0);

    const totalChecked = CMD_DATA.reduce((acc, _, i) => {
        const idx = i + 1;
        return acc + Object.values(state[idx] || {}).filter(v => v).length;
    }, 0);

    const pct = Math.round((checkedSections / TOTAL_CMDS) * 100);
    document.getElementById('progressFill').style.width = pct + '%';
    document.getElementById('progressText').textContent =
        checkedSections + ' of ' + TOTAL_CMDS + ' commandments reflected on';
    document.getElementById('checkedCount').textContent =
        totalChecked + ' item' + (totalChecked !== 1 ? 's' : '') + ' marked';
}

function renderSummary() {
    const list = document.getElementById('summaryList');
    const empty = document.getElementById('summaryEmpty');
    list.innerHTML = '';

    let hasAny = false;

    CMD_DATA.forEach((cmd, i) => {
        const idx = i + 1;
        const checkedQs = Object.entries(state[idx] || {})
            .filter(([k, v]) => v)
            .map(([k]) => parseInt(k));

        if (checkedQs.length === 0) return;
        hasAny = true;

        const section = document.createElement('div');
        section.className = 'summary-section';
        section.innerHTML = '<h3>' + escHtml(cmd.roman) + ' · ' + escHtml(cmd.title) + '</h3>';
        const ul = document.createElement('ul');

        // We need to get the question texts - they're in the DOM
        checkedQs.forEach(qIdx => {
            const qEl = document.getElementById('q-' + idx + '-' + qIdx);
            if (!qEl) return;
            const qText = qEl.querySelector('.q-text').textContent;
            const li = document.createElement('li');
            li.textContent = qText;
            ul.appendChild(li);
        });

        section.appendChild(ul);
        list.appendChild(section);
    });

    empty.style.display = hasAny ? 'none' : 'block';
    list.style.display = hasAny ? 'flex' : 'none';
}

function clearAll() {
    if (!confirm('Clear all checked items?')) return;
    CMD_DATA.forEach((_, i) => {
        const idx = i + 1;
        state[idx] = {};
        updateCmdComplete(idx);
        // re-render all q's
        for (let qi = 0; qi < 10; qi++) {
            renderQ(idx, qi);
        }
    });
    saveState();
    updateProgress();
    renderSummary();
}

function escHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function init() {
    loadState();
    // render all q states
    CMD_DATA.forEach((_, i) => {
        const idx = i + 1;
        for (let qi = 0; qi < 10; qi++) {
            renderQ(idx, qi);
        }
        updateCmdComplete(idx);
    });
    updateProgress();
    renderSummary();
}

init();
</script>
</body>
</html>
