<?php
// Austen Ipsum - A Regency Dialogue Generator
// Inspired by Jon's 2008 post: "Austen Ipsum: Random Jane Austen Dialogue Generator"
// https://jona.ca/2008/11/austen-ipsum-random-jane-austen.html

$quotes = [
    ['Elizabeth', 'I must not decide on my own performance.'],
    ['Elizabeth', 'I am not to be intimidated into anything so wholly unreasonable.'],
    ['Elizabeth', 'It is unaccountable! In every view it is unaccountable!'],
    ['Elizabeth', 'Till this moment I never knew myself.'],
    ['Elizabeth', 'You have delighted us long enough.'],
    ['Elizabeth', 'There are few people whom I really love, and still fewer of whom I think well.'],
    ['Elizabeth', 'I am only resolved to act in that manner, which will, in my own opinion, constitute my happiness.'],
    ['Elizabeth', 'I have been a selfish being all my life, in practice, though not in principle.'],
    ['Elizabeth', 'What are men to rocks and mountains?'],
    ['Elizabeth', 'I could easily forgive his pride, if he had not mortified mine.'],
    ['Mr. Darcy', 'My good opinion once lost, is lost forever.'],
    ['Mr. Darcy', 'You have bewitched me, body and soul.'],
    ['Mr. Darcy', 'In vain I have struggled. It will not do.'],
    ['Mr. Darcy', 'She is tolerable, but not handsome enough to tempt me.'],
    ['Mr. Darcy', 'I have faults enough, but they are not, I hope, of understanding.'],
    ['Mr. Darcy', 'I was given good principles, but left to follow them in pride and conceit.'],
    ['Mr. Darcy', 'You taught me a lesson, hard indeed at first, but most advantageous.'],
    ['Mr. Darcy', 'I have been most anxious for your having some amusement.'],
    ['Jane', 'We must not be so ready to fancy ourselves intentionally injured.'],
    ['Jane', 'There is no one so worthy of love as you. But no one deserves him less.'],
    ['Jane', 'I am not a great reader, and I have pleasure in many things.'],
    ['Jane', 'Laugh as much as you choose, but you will not laugh me out of my opinion.'],
    ['Jane', 'If she is not a fool, she will be his wife.'],
    ['Mr. Bennet', 'For what do we live, but to make sport for our neighbours, and laugh at them in our turn?'],
    ['Mr. Bennet', 'You mistake me, my dear. I have a high respect for your nerves. They are my old friends.'],
    ['Mr. Bennet', 'My dear, you flatter me. I certainly have had my share of beauty, but I do not pretend to be anything extraordinary now.'],
    ['Mr. Bennet', 'An unhappy alternative is before you, Elizabeth. Your mother will never see you again if you do not marry Mr. Collins, and I will never see you again if you do.'],
    ['Mr. Bennet', 'I have not the pleasure of understanding you.'],
    ['Mrs. Bennet', 'If I can but see one of my daughters happily settled at Netherfield, I shall have nothing to wish for.'],
    ['Mrs. Bennet', 'Have a little compassion on my nerves. You tear them to pieces.'],
    ['Mrs. Bennet', 'Three daughters married! Oh, Mr. Bennet, we shall have a son-in-law before we know where we are.'],
    ['Mrs. Bennet', 'It is very hard to think that Charlotte Lucas should be mistress of this house.'],
    ['Mrs. Bennet', 'I am sure I do not know who is to maintain you when your father is dead.'],
    ['Mr. Bingley', 'I declare after all there is no enjoyment like reading!'],
    ['Mr. Bingley', 'She is the most beautiful creature I ever beheld!'],
    ['Mr. Bingley', 'I have never met with so many pleasant girls in my life as I have this evening.'],
    ['Mr. Bingley', 'Upon my honour, I never met with so many pleasant girls in my life.'],
    ['Lady Catherine', 'Are the shades of Pemberley to be thus polluted?'],
    ['Lady Catherine', 'I am almost the nearest relation he has in the world, and am entitled to know all his dearest concerns.'],
    ['Lady Catherine', 'There are few people in England, I suppose, who have more true enjoyment of music than myself.'],
    ['Lady Catherine', 'I take no leave of you, Miss Bennet. I send no compliments to your mother.'],
    ['Charlotte', 'I am not romantic, you know; I never was. I ask only a comfortable home.'],
    ['Charlotte', 'Happiness in marriage is entirely a matter of chance.'],
    ['Charlotte', 'I wish you joy. If you love Mr. Darcy half as well as I do my dear Wickham, you must be very happy.'],
    ['Mr. Collins', 'You ought certainly to forgive them as a Christian, but never to admit them in your sight, or allow their names to be mentioned in your hearing.'],
    ['Mr. Collins', 'My dear Miss Elizabeth, I have the highest opinion in the world in your excellent judgment.'],
    ['Mr. Collins', 'It is your turn to say something, Miss Bennet. I talked about the dance, and you ought to make some kind of remark on the size of the room.'],
    ['Mr. Collins', 'The distance is nothing when one has motive.'],
    ['Mr. Collins', 'Almost as soon as I entered the house, I singled you out as the companion of my future life.'],
    ['Lydia', 'I am sure my sisters must all envy me. I only hope they may have half my good luck.'],
    ['Lydia', 'Ah! Jane, I take your place now, and you must go lower, because I am a married woman.'],
    ['Lydia', 'Lord, how I am tired!'],
    ['Wickham', 'We were born in the same parish, within the same park; the greatest part of our youth was passed together.'],
    ['Wickham', 'I have been most unjustly deprived of a living.'],
    ['Mary', 'Far be it from me to depreciate such pleasures. They would doubtless be congenial with the generality of female minds.'],
    ['Mary', 'Unhappy as the event must be for Lydia, we may draw from it this useful lesson: that loss of virtue in a female is irretrievable.'],
    ['Narrator', 'It is a truth universally acknowledged, that a single man in possession of a good fortune, must be in want of a wife.'],
    ['Narrator', 'Pride relates more to our opinion of ourselves, vanity to what we would have others think of us.'],
    ['Narrator', 'There is a stubbornness about me that never can bear to be frightened at the will of others.'],
    ['Narrator', 'I declare after all there is no enjoyment like reading! How much sooner one tires of any thing than of a book!'],
    ['Narrator', 'Angry people are not always wise.'],
    ['Narrator', 'We all know him to be a proud, unpleasant sort of man; but this would be nothing if you really liked him.'],
    ['Narrator', 'It is your turn to say something. I talked about the dance, and you ought to make some kind of remark on the size of the room.'],
];

$characters = array_unique(array_column($quotes, 0));
sort($characters);

$characterColors = [
    'Elizabeth' => '#2C4A6E',
    'Mr. Darcy' => '#1B3A5C',
    'Jane' => '#6B4C7A',
    'Mr. Bennet' => '#4A6B4A',
    'Mrs. Bennet' => '#7B4A4A',
    'Mr. Bingley' => '#4A7B6B',
    'Lady Catherine' => '#7A5B2D',
    'Charlotte' => '#5B6B7A',
    'Mr. Collins' => '#6B5B4A',
    'Lydia' => '#7B4A6B',
    'Wickham' => '#4A5B6B',
    'Mary' => '#5A4A6B',
    'Narrator' => '#4A4A4A',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Austen Ipsum - A Regency Dialogue Generator</title>
    <style>
        @font-face {
            font-family: 'Cinzel';
            src: url('data:font/woff2;base64,') format('woff2');
            font-weight: 400;
            font-style: normal;
        }

        :root {
            --ink: #1a1510;
            --ink-light: #3d3429;
            --parchment: #faf6f0;
            --parchment-dark: #f0e8d8;
            --wood: #8b6f4e;
            --wood-dark: #6b5238;
            --blue: #2c4a6e;
            --blue-light: #4a6b8e;
            --burgundy: #7b2d3b;
            --gold: #c9a84c;
            --gold-dim: #a08030;
            --shadow: rgba(26, 21, 16, 0.12);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Georgia, 'Times New Roman', Garamond, serif;
            background: linear-gradient(135deg, #e8ddd0 0%, #d4c8b8 50%, #c8bba8 100%);
            min-height: 100vh;
            color: var(--ink);
            line-height: 1.7;
            overflow-x: hidden;
        }

        /* Wood grain texture overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 2px,
                rgba(107, 82, 56, 0.03) 2px,
                rgba(107, 82, 56, 0.03) 4px
            );
            pointer-events: none;
            z-index: 0;
        }

        .desk {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 32px 20px 60px;
        }

        /* Header card */
        .header-card {
            background: var(--parchment);
            border-radius: 4px 4px 2px 2px;
            padding: 36px 32px 28px;
            margin-bottom: 20px;
            box-shadow:
                0 1px 3px var(--shadow),
                0 4px 12px rgba(0,0,0,0.08),
                inset 0 -2px 0 rgba(0,0,0,0.06);
            position: relative;
        }

        .header-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--burgundy) 0%, var(--gold) 50%, var(--burgundy) 100%);
        }

        .ornament-top {
            text-align: center;
            font-size: 1.4em;
            color: var(--gold-dim);
            letter-spacing: 8px;
            margin-bottom: 12px;
            opacity: 0.7;
        }

        h1 {
            font-family: Georgia, serif;
            font-size: 2.2em;
            font-weight: 400;
            text-align: center;
            color: var(--blue);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .subtitle {
            text-align: center;
            font-style: italic;
            color: var(--wood-dark);
            font-size: 1em;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .divider-ornament {
            text-align: center;
            color: var(--gold-dim);
            font-size: 0.9em;
            letter-spacing: 6px;
            margin: 16px 0;
            opacity: 0.6;
        }

        .blurb {
            text-align: center;
            font-size: 0.85em;
            color: var(--ink-light);
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .blurb a {
            color: var(--blue);
            text-decoration: none;
            border-bottom: 1px dotted var(--blue);
        }

        .blurb a:hover {
            border-bottom-style: solid;
        }

        /* Control panel */
        .control-panel {
            background: var(--parchment);
            border-radius: 2px;
            padding: 24px 28px;
            margin-bottom: 20px;
            box-shadow:
                0 1px 3px var(--shadow),
                0 4px 12px rgba(0,0,0,0.08),
                inset 0 -2px 0 rgba(0,0,0,0.06);
        }

        .control-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .control-row:last-child {
            margin-bottom: 0;
            align-items: center;
        }

        .control-group {
            flex: 1;
            min-width: 200px;
        }

        .control-group label {
            display: block;
            font-size: 0.75em;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--wood-dark);
            margin-bottom: 8px;
            font-weight: bold;
        }

        .mode-tabs {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }

        .mode-tab {
            padding: 8px 16px;
            border: 1px solid var(--parchment-dark);
            background: var(--parchment);
            color: var(--ink-light);
            font-family: Georgia, serif;
            font-size: 0.85em;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
            position: relative;
        }

        .mode-tab:hover {
            border-color: var(--gold);
            color: var(--ink);
        }

        .mode-tab.active {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
        }

        .sentences-slider {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sentences-slider input[type="range"] {
            flex: 1;
            -webkit-appearance: none;
            appearance: none;
            height: 3px;
            background: var(--parchment-dark);
            border-radius: 2px;
            outline: none;
        }

        .sentences-slider input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--burgundy);
            cursor: pointer;
            border: 2px solid var(--parchment);
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .sentences-slider input[type="range"]::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--burgundy);
            cursor: pointer;
            border: 2px solid var(--parchment);
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .sentences-value {
            font-size: 1.1em;
            font-weight: bold;
            color: var(--blue);
            min-width: 28px;
            text-align: center;
        }

        /* Character toggles */
        .character-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .char-toggle {
            padding: 5px 12px;
            border: 1px solid var(--parchment-dark);
            background: var(--parchment);
            color: var(--ink-light);
            font-family: Georgia, serif;
            font-size: 0.8em;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
            user-select: none;
        }

        .char-toggle:hover {
            border-color: var(--gold);
        }

        .char-toggle.active {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
        }

        .char-toggle.inactive {
            opacity: 0.4;
        }

        .char-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .char-action-btn {
            font-size: 0.7em;
            padding: 3px 10px;
            border: 1px solid var(--parchment-dark);
            background: transparent;
            color: var(--wood-dark);
            font-family: Georgia, serif;
            cursor: pointer;
            border-radius: 2px;
        }

        .char-action-btn:hover {
            border-color: var(--wood);
            color: var(--wood);
        }

        /* Generate button */
        .generate-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 32px;
            background: linear-gradient(135deg, var(--burgundy) 0%, #5a1e2a 100%);
            color: white;
            font-family: Georgia, serif;
            font-size: 1em;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(123, 45, 59, 0.3);
            transition: all 0.2s ease;
        }

        .generate-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(123, 45, 59, 0.4);
        }

        .generate-btn:active {
            transform: translateY(0);
        }

        .generate-btn svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        .copy-btn {
            padding: 10px 24px;
            background: transparent;
            border: 1.5px solid var(--blue);
            color: var(--blue);
            font-family: Georgia, serif;
            font-size: 0.85em;
            letter-spacing: 1px;
            cursor: pointer;
            border-radius: 2px;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background: var(--blue);
            color: white;
        }

        .copy-btn.copied {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
        }

        /* Output pages */
        .output-area {
            position: relative;
        }

        .page {
            background: var(--parchment);
            border-radius: 2px 2px 4px 4px;
            padding: 36px 40px 40px;
            margin-bottom: 16px;
            box-shadow:
                0 1px 3px var(--shadow),
                0 4px 12px rgba(0,0,0,0.08),
                inset 0 -2px 0 rgba(0,0,0,0.06);
            position: relative;
            min-height: 200px;
            animation: pageIn 0.5s ease-out;
        }

        @keyframes pageIn {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .page::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-dim), var(--gold), var(--gold-dim));
            opacity: 0.5;
        }

        .page-header {
            text-align: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--parchment-dark);
        }

        .page-header .page-ornament {
            font-size: 1.2em;
            color: var(--gold-dim);
            letter-spacing: 6px;
            margin-bottom: 8px;
        }

        .page-header .page-label {
            font-size: 0.7em;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--wood-dark);
        }

        .quote-block {
            margin-bottom: 20px;
            padding-left: 20px;
            border-left: 2px solid var(--parchment-dark);
            transition: border-color 0.3s ease;
        }

        .quote-block:hover {
            border-left-color: var(--gold);
        }

        .quote-speaker {
            font-size: 0.8em;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }

        .quote-text {
            font-size: 1.05em;
            line-height: 1.8;
            color: var(--ink);
        }

        .quote-text::first-letter {
            font-size: 1.8em;
            line-height: 0.8;
            float: left;
            margin-right: 4px;
            margin-top: 4px;
            font-weight: bold;
            color: var(--blue);
        }

        .page-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid var(--parchment-dark);
            font-size: 0.75em;
            color: var(--wood-dark);
            letter-spacing: 1px;
        }

        .page-number {
            font-variant: small-caps;
        }

        /* Scene mode dialogue */
        .scene-stage {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .dialogue-line {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            animation: lineIn 0.3s ease-out;
        }

        @keyframes lineIn {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .dialogue-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65em;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .dialogue-bubble {
            flex: 1;
            background: var(--parchment-dark);
            padding: 14px 18px;
            border-radius: 2px 8px 8px 8px;
            position: relative;
            font-size: 0.95em;
            line-height: 1.7;
        }

        .dialogue-bubble::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 12px;
            width: 12px;
            height: 12px;
            background: var(--parchment-dark);
            transform: rotate(45deg);
        }

        .dialogue-speaker-name {
            font-size: 0.7em;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--wood-dark);
            margin-bottom: 4px;
            font-weight: bold;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--wood-dark);
        }

        .empty-state .quill-icon {
            font-size: 3em;
            margin-bottom: 16px;
            opacity: 0.4;
        }

        .empty-state p {
            font-style: italic;
            font-size: 1em;
        }

        /* Footer */
        .site-footer {
            text-align: center;
            padding: 24px;
            color: var(--wood-dark);
            font-size: 0.8em;
        }

        .site-footer a {
            color: var(--wood);
            text-decoration: none;
            border-bottom: 1px dotted var(--wood);
        }

        /* Responsive */
        @media (max-width: 600px) {
            .desk { padding: 16px 12px 40px; }
            .header-card { padding: 24px 20px 20px; }
            h1 { font-size: 1.5em; letter-spacing: 2px; }
            .control-panel { padding: 20px; }
            .page { padding: 24px 20px 28px; }
            .control-row { flex-direction: column; gap: 16px; }
            .control-group { min-width: 100%; }
            .dialogue-avatar { width: 32px; height: 32px; font-size: 0.55em; }
        }

        /* Print styles for the page */
        @media print {
            body { background: white; }
            .control-panel, .site-footer { display: none; }
            .page { box-shadow: none; border: 1px solid #ddd; }
        }
    </style>
</head>
<body>
    <div class="desk">
        <div class="header-card">
            <div class="ornament-top">&#10022; &#10022; &#10022;</div>
            <h1>Austen Ipsum</h1>
            <p class="subtitle">A Regency Dialogue Generator</p>
            <div class="divider-ornament">&mdash; &#10047; &mdash;</div>
            <p class="blurb">
                Compose random passages in the manner of Jane Austen's <em>Pride and Prejudice</em>.
                Inspired by Jon's <a href="https://jona.ca/2008/11/austen-ipsum-random-jane-austen.html">Austen Ipsum</a> post from 2008,
                where he built a little web service that outputs random dialogue from his favourite novel.
            </p>
        </div>

        <div class="control-panel">
            <div class="control-row">
                <div class="control-group">
                    <label>Composition Mode</label>
                    <div class="mode-tabs">
                        <button class="mode-tab active" data-mode="random">Random Scatter</button>
                        <button class="mode-tab" data-mode="scene">Scene</button>
                        <button class="mode-tab" data-mode="character">Character Study</button>
                    </div>
                </div>
                <div class="control-group">
                    <label>Sentences</label>
                    <div class="sentences-slider">
                        <input type="range" id="sentenceCount" min="1" max="12" value="5">
                        <span class="sentences-value" id="sentenceValue">5</span>
                    </div>
                </div>
            </div>
            <div class="control-row">
                <div class="control-group">
                    <label>Characters</label>
                    <div class="character-grid" id="characterGrid">
                        <?php foreach ($characters as $char): ?>
                        <button class="char-toggle active" data-char="<?php echo htmlspecialchars($char); ?>"
                            style="--char-color: <?php echo $characterColors[$char] ?? '#4A4A4A'; ?>;">
                            <?php echo htmlspecialchars($char); ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                    <div class="char-actions">
                        <button class="char-action-btn" id="selectAllChars">Select All</button>
                        <button class="char-action-btn" id="deselectAllChars">Deselect All</button>
                        <button class="char-action-btn" id="resetChars">Reset</button>
                    </div>
                </div>
            </div>
            <div class="control-row">
                <button class="generate-btn" id="generateBtn">
                    <svg viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                    Compose Passage
                </button>
                <button class="copy-btn" id="copyBtn">Copy to Clipboard</button>
            </div>
        </div>

        <div class="output-area" id="outputArea">
            <div class="page">
                <div class="empty-state">
                    <div class="quill-icon">&#9998;</div>
                    <p>Adjust your settings and press "Compose Passage" to begin.</p>
                </div>
            </div>
        </div>

        <div class="site-footer">
            <p>Built with affection by Chloe &middot; <a href="./">Chloe Reads Jon</a></p>
        </div>
    </div>

    <script>
        // Quote data embedded from PHP
        const allQuotes = <?php echo json_encode($quotes); ?>;
        const characterColors = <?php echo json_encode($characterColors); ?>;

        let currentMode = 'random';
        let pageCount = 0;

        // DOM elements
        const sentenceSlider = document.getElementById('sentenceCount');
        const sentenceValue = document.getElementById('sentenceValue');
        const modeTabs = document.querySelectorAll('.mode-tab');
        const charToggles = document.querySelectorAll('.char-toggle');
        const generateBtn = document.getElementById('generateBtn');
        const copyBtn = document.getElementById('copyBtn');
        const outputArea = document.getElementById('outputArea');

        // Slider
        sentenceSlider.addEventListener('input', () => {
            sentenceValue.textContent = sentenceSlider.value;
        });

        // Mode tabs
        modeTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                modeTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                currentMode = tab.dataset.mode;
            });
        });

        // Character toggles
        charToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                toggle.classList.toggle('active');
                toggle.classList.toggle('inactive', !toggle.classList.contains('active'));
            });
        });

        document.getElementById('selectAllChars').addEventListener('click', () => {
            charToggles.forEach(t => { t.classList.add('active'); t.classList.remove('inactive'); });
        });
        document.getElementById('deselectAllChars').addEventListener('click', () => {
            charToggles.forEach(t => { t.classList.remove('active'); t.classList.add('inactive'); });
        });
        document.getElementById('resetChars').addEventListener('click', () => {
            charToggles.forEach(t => { t.classList.add('active'); t.classList.remove('inactive'); });
        });

        // Get active characters
        function getActiveCharacters() {
            return Array.from(document.querySelectorAll('.char-toggle.active')).map(t => t.dataset.char);
        }

        // Get filtered quotes
        function getFilteredQuotes() {
            const active = getActiveCharacters();
            return allQuotes.filter(q => active.includes(q[0]));
        }

        // Shuffle array
        function shuffle(arr) {
            const a = [...arr];
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        }

        // Generate random scatter
        function generateRandom(count) {
            const filtered = getFilteredQuotes();
            if (filtered.length === 0) return [];
            const shuffled = shuffle(filtered);
            return shuffled.slice(0, Math.min(count, shuffled.length));
        }

        // Generate scene (dialogue between 2-3 characters)
        function generateScene(count) {
            const filtered = getFilteredQuotes();
            if (filtered.length === 0) return [];

            // Pick 2-3 characters who have quotes
            const charsWithQuotes = [...new Set(filtered.map(q => q[0]))];
            const numChars = Math.min(charsWithQuotes.length, Math.random() > 0.5 ? 3 : 2);
            const sceneChars = shuffle(charsWithQuotes).slice(0, numChars);

            const result = [];
            for (let i = 0; i < count; i++) {
                const char = sceneChars[i % sceneChars.length];
                const charQuotes = filtered.filter(q => q[0] === char);
                if (charQuotes.length > 0) {
                    result.push(charQuotes[Math.floor(Math.random() * charQuotes.length)]);
                }
            }
            return result;
        }

        // Generate character study (focus on one character)
        function generateCharacterStudy(count) {
            const filtered = getFilteredQuotes();
            if (filtered.length === 0) return [];

            const charsWithQuotes = [...new Set(filtered.map(q => q[0]))];
            const focusChar = charsWithQuotes[Math.floor(Math.random() * charsWithQuotes.length)];
            const charQuotes = filtered.filter(q => q[0] === focusChar);
            const shuffled = shuffle(charQuotes);
            return shuffled.slice(0, Math.min(count, shuffled.length)).map(q => q);
        }

        // Render a page
        function renderPage(quotes) {
            pageCount++;
            const page = document.createElement('div');
            page.className = 'page';

            let content = '';

            if (currentMode === 'scene') {
                content = `
                    <div class="page-header">
                        <div class="page-ornament">&#10047;</div>
                        <div class="page-label">A Scene at Longbourn</div>
                    </div>
                    <div class="scene-stage">
                        ${quotes.map((q, i) => {
                            const color = characterColors[q[0]] || '#4A4A4A';
                            const initials = q[0].split(' ').map(w => w[0]).join('');
                            return `
                                <div class="dialogue-line" style="animation-delay: ${i * 0.1}s">
                                    <div class="dialogue-avatar" style="background: ${color}">${initials}</div>
                                    <div class="dialogue-bubble">
                                        <div class="dialogue-speaker-name">${q[0]}</div>
                                        ${q[1]}
                                    </div>
                                </div>
                            `;
                        }).join('')}
                    </div>
                `;
            } else if (currentMode === 'character') {
                const focusChar = quotes[0]?.[0] || 'Unknown';
                const color = characterColors[focusChar] || '#4A4A4A';
                content = `
                    <div class="page-header">
                        <div class="page-ornament">&#10047;</div>
                        <div class="page-label" style="color: ${color}">Character Study: ${focusChar}</div>
                    </div>
                    ${quotes.map((q, i) => `
                        <div class="quote-block" style="animation: lineIn 0.3s ease-out ${i * 0.08}s both;">
                            <div class="quote-speaker" style="color: ${color}">${q[0]}</div>
                            <div class="quote-text">${q[1]}</div>
                        </div>
                    `).join('')}
                `;
            } else {
                content = `
                    <div class="page-header">
                        <div class="page-ornament">&#10047;</div>
                        <div class="page-label">Random Passage</div>
                    </div>
                    ${quotes.map((q, i) => {
                        const color = characterColors[q[0]] || '#4A4A4A';
                        return `
                            <div class="quote-block" style="animation: lineIn 0.3s ease-out ${i * 0.08}s both;">
                                <div class="quote-speaker" style="color: ${color}">${q[0]}</div>
                                <div class="quote-text">${q[1]}</div>
                            </div>
                        `;
                    }).join('')}
                `;
            }

            page.innerHTML = content + `
                <div class="page-footer">
                    <span class="page-number">Page ${pageCount}</span> &middot;
                    ${quotes.length} sentence${quotes.length !== 1 ? 's' : ''} &middot;
                    ${[...new Set(quotes.map(q => q[0]))].length} character${[...new Set(quotes.map(q => q[0]))].length !== 1 ? 's' : ''}
                </div>
            `;

            return page;
        }

        // Generate
        generateBtn.addEventListener('click', () => {
            const count = parseInt(sentenceSlider.value);
            let quotes;

            switch (currentMode) {
                case 'scene':
                    quotes = generateScene(count);
                    break;
                case 'character':
                    quotes = generateCharacterStudy(count);
                    break;
                default:
                    quotes = generateRandom(count);
            }

            if (quotes.length === 0) {
                outputArea.innerHTML = `
                    <div class="page">
                        <div class="empty-state">
                            <div class="quill-icon">&#9998;</div>
                            <p>No characters selected. Please choose at least one character above.</p>
                        </div>
                    </div>
                `;
                return;
            }

            const page = renderPage(quotes);
            outputArea.innerHTML = '';
            outputArea.appendChild(page);

            // Scroll to output
            page.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });

        // Copy
        copyBtn.addEventListener('click', () => {
            const quoteBlocks = outputArea.querySelectorAll('.quote-block, .dialogue-line');
            if (quoteBlocks.length === 0) return;

            let text = '';
            quoteBlocks.forEach(block => {
                const speaker = block.querySelector('.quote-speaker, .dialogue-speaker-name');
                const quoteText = block.querySelector('.quote-text, .dialogue-bubble');
                if (speaker && quoteText) {
                    text += `${speaker.textContent}: ${quoteText.childNodes[quoteText.childNodes.length - 1].textContent.trim()}\n\n`;
                }
            });

            if (text) {
                navigator.clipboard.writeText(text.trim()).then(() => {
                    copyBtn.textContent = 'Copied!';
                    copyBtn.classList.add('copied');
                    setTimeout(() => {
                        copyBtn.textContent = 'Copy to Clipboard';
                        copyBtn.classList.remove('copied');
                    }, 2000);
                });
            }
        });

        // Initial generate
        generateBtn.click();
    </script>
</body>
</html>
