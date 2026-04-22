<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18th Century Letter Closing Composer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=Cormorant+SC:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #f5f0e8;
            --parchment: #ede3d0;
            --ink: #2a1f14;
            --brown: #8b6914;
            --gold: #c9a227;
            --sepia: #a07850;
            --light-ink: #5a4530;
            --border: #d4c4a8;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cormorant Garamont', Georgia, serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse at 20% 20%, rgba(201,162,39,0.06) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(139,105,20,0.06) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
        }

        /* Parchment card */
        .parchment {
            max-width: 700px;
            margin: 40px auto 60px;
            background: var(--parchment);
            border: 1px solid var(--border);
            box-shadow:
                0 2px 4px rgba(42,31,20,0.08),
                0 8px 24px rgba(42,31,20,0.12),
                inset 0 0 60px rgba(139,105,20,0.06);
            padding: 48px 52px 52px;
            position: relative;
        }

        .parchment::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100' height='100' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* Ornamental border top */
        .ornament {
            text-align: center;
            font-size: 28px;
            letter-spacing: 16px;
            color: var(--gold);
            margin-bottom: 8px;
            opacity: 0.9;
        }

        /* Title */
        h1 {
            font-family: 'Cormorant SC', Georgia, serif;
            font-weight: 600;
            font-size: 2em;
            letter-spacing: 0.08em;
            text-align: center;
            color: var(--ink);
            margin-bottom: 6px;
        }

        .subtitle {
            text-align: center;
            font-style: italic;
            font-size: 1.05em;
            color: var(--sepia);
            margin-bottom: 32px;
            font-weight: 300;
        }

        .attribution {
            text-align: center;
            font-size: 0.82em;
            color: var(--light-ink);
            font-style: italic;
            margin-bottom: 36px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        /* Form sections */
        .section {
            margin-bottom: 28px;
        }

        label {
            font-family: 'Cormorant SC', Georgia, serif;
            font-size: 0.8em;
            letter-spacing: 0.12em;
            color: var(--sepia);
            display: block;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* Selector grid */
        .selector-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 8px;
        }

        .option-btn {
            font-family: 'Cormorant Garamont', Georgia, serif;
            font-size: 0.95em;
            padding: 9px 12px;
            border: 1px solid var(--border);
            background: rgba(255,255,255,0.5);
            color: var(--ink);
            cursor: pointer;
            transition: all 0.15s ease;
            text-align: left;
            line-height: 1.4;
        }

        .option-btn:hover {
            border-color: var(--gold);
            background: rgba(201,162,39,0.08);
        }

        .option-btn.selected {
            border-color: var(--brown);
            background: rgba(139,105,20,0.12);
            box-shadow: inset 0 0 0 1px rgba(139,105,20,0.3);
        }

        .option-btn span {
            display: block;
            font-size: 0.7em;
            color: var(--sepia);
            font-style: italic;
            margin-top: 2px;
        }

        /* Checkbox row */
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 16px;
            cursor: pointer;
        }

        .checkbox-row input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--brown);
            cursor: pointer;
        }

        .checkbox-row span {
            font-style: italic;
            color: var(--light-ink);
            font-size: 0.95em;
        }

        /* Preview box */
        .preview-box {
            background: rgba(42,31,20,0.03);
            border: 1px solid var(--border);
            padding: 24px 28px;
            margin-top: 28px;
            position: relative;
        }

        .preview-box::before {
            content: 'Your Closing';
            font-family: 'Cormorant SC', Georgia, serif;
            font-size: 0.7em;
            letter-spacing: 0.15em;
            color: var(--sepia);
            position: absolute;
            top: -9px;
            left: 20px;
            background: var(--parchment);
            padding: 0 8px;
            text-transform: uppercase;
        }

        .closing-output {
            font-size: 1.2em;
            line-height: 1.8;
            color: var(--ink);
            min-height: 48px;
            font-style: italic;
        }

        .closing-output.empty {
            color: var(--sepia);
            font-style: italic;
            font-size: 0.95em;
        }

        .latin-output {
            font-size: 1em;
            color: var(--sepia);
            margin-top: 10px;
            font-style: italic;
            border-top: 1px dashed var(--border);
            padding-top: 10px;
            display: none;
        }

        .latin-output.visible { display: block; }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn {
            font-family: 'Cormorant SC', Georgia, serif;
            font-size: 0.78em;
            letter-spacing: 0.1em;
            padding: 10px 20px;
            border: 1px solid var(--brown);
            background: transparent;
            color: var(--brown);
            cursor: pointer;
            transition: all 0.15s ease;
            text-transform: uppercase;
        }

        .btn:hover {
            background: var(--brown);
            color: var(--cream);
        }

        .btn-primary {
            background: var(--brown);
            color: var(--cream);
        }

        .btn-primary:hover {
            background: var(--ink);
            border-color: var(--ink);
        }

        /* Divider */
        .divider {
            text-align: center;
            font-size: 16px;
            color: var(--gold);
            opacity: 0.7;
            margin: 36px 0 28px;
            letter-spacing: 12px;
        }

        /* Sam Johnson's originals */
        .samples-title {
            font-family: 'Cormorant SC', Georgia, serif;
            font-size: 0.75em;
            letter-spacing: 0.15em;
            color: var(--sepia);
            text-transform: uppercase;
            margin-bottom: 16px;
            text-align: center;
        }

        .sample-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .sample-card {
            background: rgba(255,255,255,0.4);
            border: 1px solid var(--border);
            padding: 14px 16px;
            font-style: italic;
            font-size: 0.92em;
            color: var(--ink);
            line-height: 1.55;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .sample-card:hover {
            border-color: var(--gold);
            background: rgba(201,162,39,0.08);
        }

        .sample-card::after {
            content: '↗';
            float: right;
            font-style: normal;
            font-size: 0.75em;
            color: var(--sepia);
            opacity: 0;
            transition: opacity 0.15s ease;
        }

        .sample-card:hover::after { opacity: 1; }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: var(--ink);
            color: var(--cream);
            font-family: 'Cormorant SC', Georgia, serif;
            font-size: 0.8em;
            letter-spacing: 0.1em;
            padding: 10px 24px;
            opacity: 0;
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 100;
            text-transform: uppercase;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* Footer */
        footer {
            text-align: center;
            font-size: 0.75em;
            color: var(--sepia);
            font-style: italic;
            margin-top: 40px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        footer a { color: var(--sepia); }

        @media (max-width: 540px) {
            .parchment { padding: 28px 22px 32px; margin: 20px 12px 40px; }
            h1 { font-size: 1.5em; }
            .selector-grid { grid-template-columns: 1fr 1fr; }
            .sample-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="parchment">
    <div class="ornament">✦ &nbsp; ✦ &nbsp; ✦</div>
    <h1>Letter Closing Composer</h1>
    <p class="subtitle">Craft an elegant 18th century closing, in the style of Samuel Johnson</p>
    <p class="attribution">Drawn from the letter-closings of James Boswell's <em>Life of Samuel Johnson</em> (1791)</p>

    <!-- Addressee -->
    <div class="section">
        <label>To whom are you writing?</label>
        <div class="selector-grid" id="addressee-grid">
            <button class="option-btn" data-val="Sir">Dear Sir <span>formal, epistolary</span></button>
            <button class="option-btn" data-val="Madam">Dear Madam <span>formal, epistolary</span></button>
            <button class="option-btn" data-val="Lord">My Lord <span>highest formal rank</span></button>
            <button class="option-btn" data-val="Friend">Dear Friend <span>warm, personal</span></button>
            <button class="option-btn" data-val="Brother">My dear Brother <span>fraternal affection</span></button>
            <button class="option-btn" data-val="Sir+">Sir <span>without "dear"</span></button>
        </div>
    </div>

    <!-- Affection -->
    <div class="section">
        <label>Degree of affection</label>
        <div class="selector-grid" id="affection-grid">
            <button class="option-btn" data-val="most affectionate">Most Affectionate <span>deep warmth</span></button>
            <button class="option-btn" data-val="affectionate">Affectionate <span>genuine warmth</span></button>
            <button class="option-btn" data-val="humble">Humble <span>deferential, servant-heart</span></button>
            <button class="option-btn" data-val="most humble">Most Humble <span>very deferential</span></button>
            <button class="option-btn" data-val="obliged">Obliged <span>grateful, indebted</span></button>
            <button class="option-btn" data-val="most obliged">Most Obliged <span>strongly grateful</span></button>
        </div>
    </div>

    <!-- Servitude -->
    <div class="section">
        <label>Servitude phrasing</label>
        <div class="selector-grid" id="servitude-grid">
            <button class="option-btn" data-val="your most humble servant">your most humble servant</button>
            <button class="option-btn" data-val="your most obedient servant">your most obedient servant</button>
            <button class="option-btn" data-val="your obliged and humble servant">your obliged and humble servant</button>
            <button class="option-btn" data-val="your affectionate servant">your affectionate servant</button>
            <button class="option-btn" data-val="your humble servant">your humble servant</button>
            <button class="option-btn" data-val="yours affectionately">yours affectionately</button>
        </div>
    </div>

    <!-- Toggle Latin -->
    <div class="checkbox-row" onclick="toggleLatin()">
        <input type="checkbox" id="latin-toggle">
        <span>Also translate the closing into Latin</span>
    </div>

    <!-- Preview -->
    <div class="preview-box">
        <div class="closing-output empty" id="closing-output">Select your options above to compose a closing...</div>
        <div class="latin-output" id="latin-output"></div>
        <div class="actions">
            <button class="btn btn-primary" onclick="copyClosing()">Copy Closing</button>
            <button class="btn" onclick="resetForm()">Reset</button>
            <button class="btn" onclick="randomClosing()">Surprise Me</button>
        </div>
    </div>

    <div class="divider">&#10022;</div>

    <div class="samples-title">Sample Closings from Boswell's Johnson</div>
    <div class="sample-grid">
        <div class="sample-card" onclick="useSample(this)">for all comfort and all satisfaction is sincerely wished you by, dear Sir, your most obliged, most obedient, and most humble servant</div>
        <div class="sample-card" onclick="useSample(this)">I am, dear Sir, &c. 'SAM. JOHNSON.'</div>
        <div class="sample-card" onclick="useSample(this)">I am, my Lord, your Lordship's most humble, most obedient servant, 'S. JOHNSON.'</div>
        <div class="sample-card" onclick="useSample(this)">I am, dear Sir, your affectionate, humble servant, 'SAM. JOHNSON.'</div>
    </div>

    <footer>
        Inspired by Jon's <a href="https://jona.ca/2007/04/for-email-charming-closing-lines-from.html">18th century letter closings post</a> &amp; <a href="https://jona.ca/2007/04/translate-your-personal-motto-into.html">Latin motto post</a>
    </footer>
</div>

<div class="toast" id="toast">Copied to clipboard</div>

<script>
    // State
    let state = { addressee: null, affection: null, servitude: null, latin: false };

    // Attach option button handlers
    document.querySelectorAll('.option-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const grid = this.parentElement;
            grid.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
            const key = grid.id.replace('-grid', '');
            state[key] = this.dataset.val;
            updatePreview();
        });
    });

    function toggleLatin() {
        state.latin = document.getElementById('latin-toggle').checked;
        updatePreview();
    }

    function updatePreview() {
        const out = document.getElementById('closing-output');
        const latinOut = document.getElementById('latin-output');

        if (!state.addressee || !state.affection || !state.servitude) {
            out.className = 'closing-output empty';
            out.textContent = 'Select your options above to compose a closing...';
            latinOut.className = 'latin-output';
            return;
        }

        out.className = 'closing-output';

        // Build the closing phrase
        let phrase = buildClosing(state.addressee, state.affection, state.servitude);
        out.textContent = phrase;

        // Latin if checked
        if (state.latin) {
            latinOut.className = 'latin-output visible';
            latinOut.textContent = 'Latin: ' + phraseToLatin(phrase);
        } else {
            latinOut.className = 'latin-output';
        }
    }

    function buildClosing(addressee, affection, servitude) {
        const addrMap = {
            'Sir': 'dear Sir',
            'Madam': 'dear Madam',
            'Lord': 'my Lord',
            'Friend': 'dear Friend',
            'Brother': 'my dear Brother',
            'Sir+': 'Sir'
        };
        const addr = addrMap[addressee] || addressee;

        // Phrase patterns based on affection + servitude combo
        const phrases = [];
        phrases.push('I am, ' + addr + ', ' + affection + ', and ' + servitude);

        if (affection === 'most affectionate' && Math.random() > 0.5) {
            phrases.push('I am, ' + addr + ', ' + affection + ', yours, ' + servitude);
        }
        if (servitude === 'yours affectionately') {
            return 'I am, ' + addr + ', ' + servitude + ', \'SAM. JOHNSON.\'';
        }

        // Some endings get a flourish
        const flours = [
            ', \'SAM. JOHNSON.\'',
            ', \'S. JOHNSON.\'',
            '.'
        ];

        return phrases[0] + flours[Math.floor(Math.random() * flours.length)];
    }

    // Simple Latin approximation using phrase substitution
    function phraseToLatin(phrase) {
        const latinMap = {
            'I am': 'Ego sum',
            'dear Sir': 'mi校e Domine',
            'dear Madam': 'mi校e Domina',
            'my Lord': 'Domine mi',
            'dear Friend': 'mi校e Amice',
            'my dear Brother': 'mi校e Frater',
            'most affectionate': 'affectuosissimus',
            'affectionate': 'affectuosus',
            'humble': 'humilis',
            'most humble': 'humillimus',
            'obliged': 'obligatus',
            'most obliged': 'obligatissimus',
            'your most humble servant': 'tuus servus humillimus',
            'your most obedient servant': 'tuus servus obedientissimus',
            'your obliged and humble servant': 'servus tuus obligatus et humilis',
            'your affectionate servant': 'servus tuus affectuosus',
            'your humble servant': 'servus tuus humilis',
            'yours affectionately': 'tuis omnibus animi affectibus'
        };

        let result = phrase
            .replace(/, 'SAM\. JOHNSON\.'/g, '')
            .replace(/, 'S\. JOHNSON\.'/g, '')
            .replace(/\./g, '');

        for (const [eng, lat] of Object.entries(latinMap)) {
            result = result.replace(new RegExp(eng, 'gi'), lat);
        }
        return result + ' —';

        // A little Latin dictionary for this page
const LATIN_DICT = {
    'I am': 'Ego sum',
    'dear Sir': 'mi校e Domine',
    'dear Madam': 'mi校e Domina',
    'my Lord': 'Domine mi',
    'dear Friend': 'mi校e Amice',
    'my dear Brother': 'mi校e Frater',
    'most affectionate': 'affectuosissimus',
    'affectionate': 'affectuosus',
    'humble': 'humilis',
    'most humble': 'humillimus',
    'obliged': 'obligatus',
    'most obliged': 'obligatissimus',
    'your most humble servant': 'tuus servus humillimus',
    'your most obedient servant': 'tuus servus obedientissimus',
    'your obliged and humble servant': 'servus tuus obligatus et humilis',
    'your affectionate servant': 'servus tuus affectuosus',
    'your humble servant': 'servus tuus humilis',
    'yours affectionately': 'tuis omnibus animi affectibus'
};

function phraseToLatin(phrase) {
    let result = phrase
        .replace(/, 'SAM\. JOHNSON\.'/g, '')
        .replace(/, 'S\. JOHNSON\.'/g, '')
        .replace(/\.$/g, '')
        .trim();

    // Sort by key length descending to avoid partial replacements
    const entries = Object.entries(LATIN_DICT).sort((a, b) => b[0].length - a[0].length);
    for (const [eng, lat] of entries) {
        result = result.replace(new RegExp(eng, 'gi'), lat);
    }
    return result + ' —';
}
    }

    function copyClosing() {
        const text = document.getElementById('closing-output').textContent;
        if (!text || text.includes('Select your options')) return;
        navigator.clipboard.writeText(text).then(() => {
            const toast = document.getElementById('toast');
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2000);
        });
    }

    function resetForm() {
        document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));
        document.getElementById('latin-toggle').checked = false;
        state = { addressee: null, affection: null, servitude: null, latin: false };
        updatePreview();
    }

    function randomClosing() {
        const opts = (sel) => Array.from(document.querySelectorAll(`#${sel} .option-btn`));
        const pick = (sel) => opts(sel)[Math.floor(Math.random() * opts(sel).length)];
        const clickAndSelect = (sel) => {
            const btn = pick(sel);
            document.querySelectorAll(`#${sel} .option-btn`).forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            return btn.dataset.val;
        };
        state.addressee = clickAndSelect('addressee-grid');
        state.affection = clickAndSelect('affection-grid');
        state.servitude = clickAndSelect('servitude-grid');
        state.latin = Math.random() > 0.6;
        document.getElementById('latin-toggle').checked = state.latin;
        updatePreview();
    }

    function useSample(el) {
        const text = el.textContent.trim();
        const out = document.getElementById('closing-output');
        out.className = 'closing-output';
        out.textContent = text;
        document.getElementById('latin-output').className = 'latin-output';
    }

    // Initialize
    updatePreview();
</script>

</body>
</html>