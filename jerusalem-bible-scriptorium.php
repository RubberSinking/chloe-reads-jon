<?php
$title = 'Jerusalem Bible Scriptorium';
$date = '2026-05-05';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        :root {
            --bg: #140f0b;
            --bg-soft: #221812;
            --panel: rgba(39, 26, 18, 0.82);
            --parchment: #ecd9b3;
            --parchment-deep: #d6bc8b;
            --ink: #2d190d;
            --muted: #a98f69;
            --gold: #f3cf74;
            --gold-deep: #bf8532;
            --crimson: #7e2319;
            --emerald: #214f43;
            --sapphire: #203d6b;
            --plum: #5b2947;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
            --radius: 28px;
            --accent: var(--crimson);
            --accent-soft: #c36c54;
            --glow: rgba(243, 207, 116, 0.35);
            --ornament-size: 18px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, "URW Palladio L", serif;
            background:
                radial-gradient(circle at top, rgba(255, 205, 108, 0.08), transparent 35%),
                radial-gradient(circle at 20% 20%, rgba(138, 48, 32, 0.22), transparent 30%),
                radial-gradient(circle at 80% 10%, rgba(38, 73, 112, 0.22), transparent 24%),
                linear-gradient(180deg, #1d1510, var(--bg));
            color: #f8edd6;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 100% 100%, 24px 24px;
            mix-blend-mode: soft-light;
            opacity: 0.2;
        }

        .shell {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0 72px;
            position: relative;
        }

        .hero {
            position: relative;
            padding: 28px 24px 10px;
            text-align: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border: 1px solid rgba(243, 207, 116, 0.28);
            border-radius: 999px;
            background: rgba(28, 19, 12, 0.52);
            color: #f0dca8;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.75rem;
        }

        .hero h1 {
            margin: 18px auto 12px;
            max-width: 12ch;
            font-size: clamp(2.8rem, 7vw, 5.8rem);
            line-height: 0.92;
            letter-spacing: 0.01em;
            color: #fff6e5;
            text-shadow: 0 12px 34px rgba(0,0,0,0.4), 0 0 28px rgba(243, 207, 116, 0.15);
        }

        .hero p {
            margin: 0 auto;
            max-width: 720px;
            font-size: clamp(1rem, 2.5vw, 1.15rem);
            line-height: 1.65;
            color: #d9c7ad;
        }

        .layout {
            display: grid;
            grid-template-columns: 360px minmax(0, 1fr);
            gap: 24px;
            align-items: start;
            margin-top: 28px;
        }

        .panel, .preview-wrap {
            background: var(--panel);
            border: 1px solid rgba(243, 207, 116, 0.16);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .panel {
            padding: 24px;
            position: sticky;
            top: 20px;
        }

        .panel h2, .preview-top h2 {
            margin: 0 0 10px;
            font-size: 1.15rem;
            color: #f7e6bc;
            letter-spacing: 0.03em;
        }

        .panel-copy {
            color: #ccb691;
            line-height: 1.55;
            font-size: 0.94rem;
            margin-bottom: 18px;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 8px;
            color: #f4e4c0;
            font-size: 0.92rem;
        }

        .hint {
            color: #a98f69;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        textarea {
            width: 100%;
            min-height: 150px;
            resize: vertical;
            border: 1px solid rgba(243, 207, 116, 0.18);
            border-radius: 20px;
            padding: 16px 18px;
            background: rgba(12, 8, 5, 0.55);
            color: #ffefcf;
            font: inherit;
            line-height: 1.6;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.03);
        }

        textarea:focus, .motto-input:focus {
            outline: none;
            border-color: rgba(243, 207, 116, 0.45);
            box-shadow: 0 0 0 4px rgba(243, 207, 116, 0.12);
        }

        .chips, .samples, .actions, .metrics {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        button, .chip {
            border: none;
            border-radius: 999px;
            padding: 11px 14px;
            background: rgba(255,255,255,0.06);
            color: #f9edcf;
            font: inherit;
            cursor: pointer;
            transition: transform 160ms ease, background 160ms ease, box-shadow 160ms ease;
        }

        button:hover, .chip:hover,
        button:focus-visible, .chip:focus-visible {
            transform: translateY(-1px);
            background: rgba(255,255,255,0.1);
            box-shadow: 0 10px 24px rgba(0,0,0,0.2);
            outline: none;
        }

        .chip.active,
        .sample.active,
        .palette.active {
            background: linear-gradient(135deg, rgba(243, 207, 116, 0.28), rgba(195, 108, 84, 0.32));
            box-shadow: 0 12px 30px rgba(0,0,0,0.22), inset 0 0 0 1px rgba(243, 207, 116, 0.18);
        }

        .palette {
            min-width: 78px;
            justify-content: center;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .dot {
            width: 13px;
            height: 13px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 0 0 2px rgba(0,0,0,0.2);
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--gold);
        }

        .metrics {
            margin-top: 8px;
        }

        .metric {
            flex: 1 1 100px;
            padding: 12px 14px;
            border-radius: 18px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(243, 207, 116, 0.08);
        }

        .metric strong {
            display: block;
            font-size: 1.05rem;
            color: #fff2d0;
            margin-bottom: 4px;
        }

        .metric span {
            color: #b7a181;
            font-size: 0.8rem;
        }

        .preview-wrap {
            padding: 18px;
            overflow: hidden;
        }

        .preview-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: end;
            padding: 6px 10px 16px;
            color: #d8c3a1;
        }

        .preview-top p {
            margin: 0;
            max-width: 460px;
            line-height: 1.55;
            font-size: 0.92rem;
        }

        .manuscript {
            position: relative;
            min-height: 780px;
            border-radius: 26px;
            padding: 34px;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.5), transparent 18%),
                radial-gradient(circle at bottom right, rgba(125,72,37,0.16), transparent 24%),
                linear-gradient(180deg, #f5e7c7, #e7d1a3 42%, #ddc28f 100%);
            box-shadow: inset 0 0 0 1px rgba(112, 75, 40, 0.25), inset 0 30px 80px rgba(255,255,255,0.35);
            color: var(--ink);
        }

        .manuscript::before,
        .manuscript::after {
            content: "";
            position: absolute;
            inset: 14px;
            border-radius: 20px;
            pointer-events: none;
        }

        .manuscript::before {
            border: 2px solid rgba(104, 56, 30, 0.42);
        }

        .manuscript::after {
            inset: 24px;
            border: 1px solid rgba(104, 56, 30, 0.18);
        }

        .halo {
            position: absolute;
            inset: -30% 24% auto;
            height: 260px;
            background: radial-gradient(circle, var(--glow), transparent 68%);
            filter: blur(16px);
            opacity: 0.8;
            pointer-events: none;
        }

        .ornament-band {
            position: absolute;
            left: 42px;
            right: 42px;
            display: flex;
            justify-content: center;
            gap: 12px;
            color: color-mix(in srgb, var(--accent) 54%, #7a4a19 46%);
            font-size: var(--ornament-size);
            letter-spacing: 0.25em;
            opacity: 0.8;
        }

        .ornament-band.top { top: 24px; }
        .ornament-band.bottom { bottom: 24px; }

        .folio-header {
            position: relative;
            display: grid;
            grid-template-columns: 88px 1fr 88px;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
            padding-top: 22px;
        }

        .sigil {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: radial-gradient(circle at 30% 30%, #ffe8a1, var(--gold) 30%, var(--gold-deep) 75%);
            color: #47250e;
            font-size: 1.4rem;
            box-shadow: inset 0 3px 8px rgba(255,255,255,0.4), inset 0 -6px 10px rgba(95, 48, 15, 0.24), 0 10px 24px rgba(80, 40, 10, 0.25);
            justify-self: center;
        }

        .folio-title {
            text-align: center;
        }

        .folio-title .kicker {
            display: block;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            font-size: 0.7rem;
            color: rgba(82, 46, 22, 0.74);
            margin-bottom: 8px;
        }

        .folio-title h3 {
            margin: 0;
            font-size: clamp(2rem, 4.2vw, 3.2rem);
            line-height: 0.98;
            color: color-mix(in srgb, var(--accent) 74%, #5d3213 26%);
            text-wrap: balance;
        }

        .folio-subtitle {
            margin: 10px auto 0;
            max-width: 42ch;
            color: rgba(64, 36, 19, 0.84);
            font-size: 0.96rem;
            line-height: 1.5;
        }

        .script-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 186px;
            gap: 22px;
            align-items: start;
            margin-top: 22px;
        }

        .verse-card {
            position: relative;
            padding: 24px 26px 28px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255,255,255,0.32), rgba(255,255,255,0.12));
            box-shadow: inset 0 0 0 1px rgba(105, 67, 35, 0.2);
            overflow: hidden;
        }

        .verse-card::before {
            content: "";
            position: absolute;
            inset: 12px;
            border-radius: 16px;
            border: 1px dashed rgba(112, 68, 35, 0.18);
            pointer-events: none;
        }

        .verse-line {
            margin: 0;
            font-size: clamp(1.08rem, 2.1vw, 1.45rem);
            line-height: 1.9;
            color: rgba(41, 24, 11, 0.96);
            position: relative;
            z-index: 1;
        }

        .dropcap {
            float: left;
            display: inline-grid;
            place-items: center;
            width: 82px;
            height: 92px;
            margin: 8px 16px 0 0;
            border-radius: 18px;
            font-size: 3.65rem;
            line-height: 1;
            font-weight: 700;
            background:
                radial-gradient(circle at 30% 30%, rgba(255,255,255,0.55), transparent 30%),
                linear-gradient(145deg, color-mix(in srgb, var(--accent) 72%, #ffffff 28%), color-mix(in srgb, var(--accent) 72%, #2d170d 28%));
            color: #fff9ef;
            box-shadow: inset 0 0 0 2px rgba(255, 235, 189, 0.42), inset 0 -8px 18px rgba(44, 19, 7, 0.3), 0 16px 26px rgba(76, 40, 15, 0.22);
            text-shadow: 0 2px 0 rgba(54, 22, 8, 0.36);
        }

        .dropcap::after {
            content: "✶";
            position: absolute;
            font-size: 0.9rem;
            transform: translate(24px, -28px);
            color: var(--gold);
            text-shadow: 0 0 12px rgba(243, 207, 116, 0.5);
        }

        .margin {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .mini-panel {
            padding: 16px;
            border-radius: 18px;
            background: rgba(110, 63, 30, 0.08);
            box-shadow: inset 0 0 0 1px rgba(110, 63, 30, 0.16);
        }

        .mini-panel h4 {
            margin: 0 0 8px;
            font-size: 0.92rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: rgba(64, 36, 19, 0.78);
        }

        .mini-panel p,
        .mini-panel li {
            margin: 0;
            color: rgba(49, 28, 14, 0.84);
            line-height: 1.55;
            font-size: 0.9rem;
        }

        .mini-panel ul {
            margin: 0;
            padding-left: 18px;
        }

        .wax {
            width: 110px;
            aspect-ratio: 1;
            border-radius: 50%;
            margin: 2px auto 12px;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at 35% 30%, rgba(255,255,255,0.34), transparent 22%),
                radial-gradient(circle at 50% 58%, color-mix(in srgb, var(--accent) 88%, #2f0a08 12%), color-mix(in srgb, var(--accent) 72%, #000 28%));
            box-shadow: inset 0 -8px 18px rgba(20,7,5,0.28), 0 14px 24px rgba(70, 27, 16, 0.18);
            color: #ffe7c8;
            font-size: 1.7rem;
            letter-spacing: 0.06em;
        }

        .motto-wrap {
            margin-top: 26px;
            display: grid;
            gap: 10px;
        }

        .motto-input {
            width: 100%;
            border: 1px solid rgba(112, 68, 35, 0.24);
            border-radius: 16px;
            padding: 12px 14px;
            font: inherit;
            background: rgba(255,255,255,0.35);
            color: var(--ink);
        }

        .motto-banner {
            min-height: 64px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(63,34,17,0.08), rgba(255,255,255,0.2));
            border: 1px solid rgba(112, 68, 35, 0.18);
            color: rgba(53, 30, 15, 0.92);
            font-style: italic;
            letter-spacing: 0.03em;
        }

        .folio-footer {
            margin-top: 26px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 16px;
            align-items: center;
            color: rgba(67, 38, 19, 0.8);
            font-size: 0.88rem;
        }

        .sig-line {
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .sig-line::before {
            content: "";
            width: 80px;
            height: 1px;
            background: rgba(67, 38, 19, 0.35);
        }

        .sparkles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .sparkle {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255,245,205,0.9), rgba(243, 207, 116, 0));
            animation: drift 10s linear infinite;
            opacity: 0.5;
        }

        @keyframes drift {
            from { transform: translateY(12px) scale(0.8); opacity: 0; }
            15% { opacity: 0.65; }
            100% { transform: translateY(-360px) translateX(40px) scale(1.4); opacity: 0; }
        }

        @media (max-width: 980px) {
            .layout {
                grid-template-columns: 1fr;
            }

            .panel {
                position: static;
            }
        }

        @media (max-width: 720px) {
            .shell {
                width: min(100% - 18px, 100%);
                padding-top: 18px;
            }

            .hero {
                padding-inline: 10px;
            }

            .panel, .preview-wrap {
                border-radius: 22px;
            }

            .panel {
                padding: 18px;
            }

            .preview-wrap {
                padding: 12px;
            }

            .manuscript {
                min-height: auto;
                padding: 22px 18px 24px;
            }

            .folio-header {
                grid-template-columns: 1fr;
            }

            .script-grid {
                grid-template-columns: 1fr;
            }

            .margin {
                order: -1;
            }

            .dropcap {
                width: 70px;
                height: 80px;
                font-size: 3rem;
                margin-right: 12px;
            }

            .folio-footer {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="shell">
        <section class="hero">
            <div class="eyebrow">✦ Inspired by Tolkien's Jerusalem Bible connection</div>
            <h1>Jerusalem Bible Scriptorium</h1>
            <p>Type a line, choose a palette worthy of an illuminated manuscript, and watch it bloom into a jewel-toned folio with gilded initials, translator's notes, and a wax seal. Quietly ridiculous. Quite beautiful.</p>
        </section>

        <section class="layout">
            <aside class="panel">
                <h2>Scribe's Desk</h2>
                <p class="panel-copy">Jon's post loved the Jerusalem Bible partly because Tolkien helped translate it. So this page leans all the way into that delicious overlap of scripture, drama, and bookish craftsmanship.</p>

                <div class="field">
                    <label for="sourceText">Your passage <span class="hint">short lines work best</span></label>
                    <textarea id="sourceText">The hills kept their counsel until the morning light, and then every stone remembered how to sing.</textarea>
                </div>

                <div class="field">
                    <label>Sample inspirations <span class="hint">tap to load</span></label>
                    <div class="samples" id="samples"></div>
                </div>

                <div class="field">
                    <label>Cadence <span class="hint">plain to ceremonial</span></label>
                    <div class="chips" id="voiceChips"></div>
                </div>

                <div class="field">
                    <label>Illumination palette <span class="hint">pick the jewel tone</span></label>
                    <div class="chips" id="paletteChips"></div>
                </div>

                <div class="field">
                    <label for="ornamentRange">Ornament density <span class="hint" id="ornamentValue">6 motifs</span></label>
                    <input id="ornamentRange" type="range" min="3" max="12" value="6">
                </div>

                <div class="field">
                    <label for="glowRange">Gold leaf glow <span class="hint" id="glowValue">soft</span></label>
                    <input id="glowRange" type="range" min="20" max="100" value="48">
                </div>

                <div class="actions">
                    <button id="elevateBtn" type="button">Elevate the phrasing</button>
                    <button id="randomBtn" type="button">Surprise me</button>
                    <button id="printBtn" type="button">Print this folio</button>
                </div>

                <div class="metrics">
                    <div class="metric"><strong id="wordCount">18</strong><span>Words on the page</span></div>
                    <div class="metric"><strong id="toneName">Cathedral</strong><span>Current register</span></div>
                    <div class="metric"><strong id="ornamentCount">6</strong><span>Border motifs</span></div>
                </div>
            </aside>

            <div class="preview-wrap">
                <div class="preview-top">
                    <div>
                        <h2>Live folio</h2>
                        <p>Everything updates instantly. It is half writing tool, half illuminated toy, which frankly is a very respectable category.</p>
                    </div>
                    <div><?php echo htmlspecialchars($date); ?></div>
                </div>

                <div class="manuscript" id="manuscript">
                    <div class="halo" id="halo"></div>
                    <div class="ornament-band top" id="ornamentTop"></div>
                    <div class="ornament-band bottom" id="ornamentBottom"></div>
                    <div class="sparkles" id="sparkles"></div>

                    <div class="folio-header">
                        <div class="sigil">✠</div>
                        <div class="folio-title">
                            <span class="kicker">Folio of Living Words</span>
                            <h3 id="folioTitle">Morning on the Hills</h3>
                            <p class="folio-subtitle" id="folioSubtitle">A small manuscript of wonder, prepared at the scribe's desk with dramatic cadence and shamelessly generous gold.</p>
                        </div>
                        <div class="sigil">❦</div>
                    </div>

                    <div class="script-grid">
                        <div class="verse-card">
                            <p class="verse-line" id="verseLine"></p>
                        </div>

                        <div class="margin">
                            <div class="mini-panel">
                                <h4>Translator's Note</h4>
                                <p id="translatorNote">Prefer the stronger image. Let the sentence arrive with a little trumpet behind it.</p>
                            </div>
                            <div class="mini-panel">
                                <h4>Rubricator's Seal</h4>
                                <div class="wax" id="waxSeal">LV</div>
                                <p id="sealNote">Light, voice, and gravity.</p>
                            </div>
                            <div class="mini-panel">
                                <h4>Border Recipe</h4>
                                <ul id="recipeList"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="motto-wrap">
                        <label for="mottoInput">Personal motto <span class="hint">your banner at the bottom</span></label>
                        <input id="mottoInput" class="motto-input" type="text" value="Beauty, courage, and the right word in the right place.">
                        <div class="motto-banner" id="mottoBanner">Beauty, courage, and the right word in the right place.</div>
                    </div>

                    <div class="folio-footer">
                        <div class="sig-line">Copied into the margins by Chloe's cheerful little machine hands.</div>
                        <div id="footerMode">Cathedral register</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const samples = [
            {
                title: 'Hills at dawn',
                text: 'The hills kept their counsel until the morning light, and then every stone remembered how to sing.'
            },
            {
                title: 'A lantern prayer',
                text: 'Keep one lamp burning in the window, that the weary may know they are expected and not forgotten.'
            },
            {
                title: 'Nathan-coded adventure',
                text: 'The faithful engine flashed through the valley at midnight, red lights sweeping the dark like a promise.'
            },
            {
                title: 'Bookish courage',
                text: 'A quiet shelf may hide whole kingdoms, if only one curious hand reaches for the right spine.'
            },
            {
                title: 'Pilgrim weather',
                text: 'Rain on the cloak, bread in the satchel, and enough mercy for one more mile.'
            }
        ];

        const voices = [
            {
                key: 'plain',
                label: 'Plain',
                note: 'Keep the line lucid and close to the ground.',
                seal: 'CL',
                sealNote: 'Clear, lovely, and direct.',
                footer: 'Plain register'
            },
            {
                key: 'cathedral',
                label: 'Cathedral',
                note: 'Lengthen the vowels, deepen the shadow, and let the clause ring a little.',
                seal: 'LV',
                sealNote: 'Light, voice, and gravity.',
                footer: 'Cathedral register'
            },
            {
                key: 'storybook',
                label: 'Storybook',
                note: 'Keep the wonder. Give the image a warm lamp and an open road.',
                seal: 'RD',
                sealNote: 'Road, hearth, and delight.',
                footer: 'Storybook register'
            },
            {
                key: 'oracle',
                label: 'Oracle',
                note: 'Shorten the stroke. Make it feel inevitable.',
                seal: 'FX',
                sealNote: 'Fire, omen, and stillness.',
                footer: 'Oracle register'
            }
        ];

        const palettes = [
            { key: 'crimson', label: 'Crimson', accent: '#7e2319', soft: '#c36c54', glow: 'rgba(243, 207, 116, 0.34)', dot: '#9f2f21' },
            { key: 'emerald', label: 'Emerald', accent: '#214f43', soft: '#51a38d', glow: 'rgba(115, 220, 175, 0.28)', dot: '#3a9078' },
            { key: 'sapphire', label: 'Sapphire', accent: '#203d6b', soft: '#6e9de3', glow: 'rgba(113, 164, 255, 0.25)', dot: '#3c62a8' },
            { key: 'plum', label: 'Plum', accent: '#5b2947', soft: '#bb74a2', glow: 'rgba(224, 157, 206, 0.28)', dot: '#86476c' }
        ];

        const ornaments = ['✶', '❦', '✠', '✺', '☩', '❈', '✢', '✤', '❂', '✷', '✥', '✣'];

        const sourceText = document.getElementById('sourceText');
        const ornamentRange = document.getElementById('ornamentRange');
        const glowRange = document.getElementById('glowRange');
        const ornamentTop = document.getElementById('ornamentTop');
        const ornamentBottom = document.getElementById('ornamentBottom');
        const verseLine = document.getElementById('verseLine');
        const translatorNote = document.getElementById('translatorNote');
        const waxSeal = document.getElementById('waxSeal');
        const sealNote = document.getElementById('sealNote');
        const recipeList = document.getElementById('recipeList');
        const mottoInput = document.getElementById('mottoInput');
        const mottoBanner = document.getElementById('mottoBanner');
        const wordCount = document.getElementById('wordCount');
        const toneName = document.getElementById('toneName');
        const ornamentCount = document.getElementById('ornamentCount');
        const ornamentValue = document.getElementById('ornamentValue');
        const glowValue = document.getElementById('glowValue');
        const folioTitle = document.getElementById('folioTitle');
        const folioSubtitle = document.getElementById('folioSubtitle');
        const footerMode = document.getElementById('footerMode');
        const halo = document.getElementById('halo');
        const sparkles = document.getElementById('sparkles');
        const elevateBtn = document.getElementById('elevateBtn');
        const randomBtn = document.getElementById('randomBtn');
        const printBtn = document.getElementById('printBtn');

        let activeVoice = voices[1];
        let activePalette = palettes[0];
        let activeSampleIndex = 0;

        function buildChoiceButtons(containerId, items, className, onClick, render) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            items.forEach((item, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = className;
                render(button, item, index);
                button.addEventListener('click', () => onClick(item, index));
                container.appendChild(button);
            });
        }

        function titleFromText(text) {
            const cleaned = text.replace(/\s+/g, ' ').trim();
            if (!cleaned) return 'Untitled Folio';
            const words = cleaned.split(' ').slice(0, 4);
            return words.map(word => word.replace(/^[^A-Za-z0-9]+|[^A-Za-z0-9]+$/g, '')).filter(Boolean).map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ') || 'Untitled Folio';
        }

        function transformText(text, voiceKey) {
            const cleaned = text.replace(/\s+/g, ' ').trim();
            if (!cleaned) return '';
            let output = cleaned;

            if (voiceKey === 'cathedral') {
                output = output
                    .replace(/\bkeep\b/gi, 'keep thou')
                    .replace(/\bthe\b/gi, 'the')
                    .replace(/\band then\b/gi, 'and lo')
                    .replace(/\bmay\b/gi, 'may')
                    .replace(/\bremembered\b/gi, 'recalled')
                    .replace(/\bmorning\b/gi, 'dawn')
                    .replace(/\bwindow\b/gi, 'lattice');
                if (!/[.!?]$/.test(output)) output += '.';
            }

            if (voiceKey === 'storybook') {
                output = output
                    .replace(/\bkept their counsel\b/gi, 'kept their bright little secrets')
                    .replace(/\bremembered\b/gi, 'knew again')
                    .replace(/\bweary\b/gi, 'travel-worn')
                    .replace(/\bdark\b/gi, 'lantern-dark');
            }

            if (voiceKey === 'oracle') {
                output = output
                    .replace(/, and then /gi, '. Then ')
                    .replace(/ until /gi, ' before ')
                    .replace(/\bthe\b/gi, '')
                    .replace(/\s{2,}/g, ' ')
                    .trim();
                output = output.charAt(0).toUpperCase() + output.slice(1);
            }

            return output;
        }

        function renderVerse() {
            const raw = sourceText.value.trim();
            const transformed = transformText(raw, activeVoice.key);
            const safe = transformed || 'Write a line, and the scriptorium will wake.';
            const firstChar = safe.charAt(0).toUpperCase();
            const rest = safe.slice(1);
            verseLine.innerHTML = `<span class="dropcap">${firstChar}</span>${rest}`;
            wordCount.textContent = safe.split(/\s+/).filter(Boolean).length;
            toneName.textContent = activeVoice.label;
            folioTitle.textContent = titleFromText(raw || safe);
            folioSubtitle.textContent = `${activeVoice.label} cadence, ${activePalette.label.toLowerCase()} illumination, and ${ornamentRange.value} border motifs arranged for a little page-bound glory.`;
        }

        function renderOrnaments() {
            const count = Number(ornamentRange.value);
            ornamentCount.textContent = count;
            ornamentValue.textContent = `${count} motifs`;
            const selected = Array.from({ length: count }, (_, i) => ornaments[(i + count) % ornaments.length]);
            ornamentTop.innerHTML = selected.map(mark => `<span>${mark}</span>`).join('');
            ornamentBottom.innerHTML = selected.slice().reverse().map(mark => `<span>${mark}</span>`).join('');
            recipeList.innerHTML = [
                `${count} hand-painted border emblems`,
                `${activePalette.label.toLowerCase()} ink with gold edging`,
                `${activeVoice.label.toLowerCase()} cadence in the main text`
            ].map(item => `<li>${item}</li>`).join('');
        }

        function renderGlow() {
            const glow = Number(glowRange.value);
            halo.style.opacity = String(Math.min(0.95, glow / 70));
            halo.style.filter = `blur(${12 + glow / 5}px)`;
            glowValue.textContent = glow < 36 ? 'hushed' : glow < 66 ? 'soft' : 'radiant';
        }

        function renderMotto() {
            const value = mottoInput.value.trim() || 'Beauty, courage, and the right word in the right place.';
            mottoBanner.textContent = value;
        }

        function renderVoice() {
            translatorNote.textContent = activeVoice.note;
            waxSeal.textContent = activeVoice.seal;
            sealNote.textContent = activeVoice.sealNote;
            footerMode.textContent = activeVoice.footer;
            document.querySelectorAll('#voiceChips .chip').forEach((chip, index) => {
                chip.classList.toggle('active', voices[index].key === activeVoice.key);
            });
        }

        function renderPalette() {
            document.documentElement.style.setProperty('--accent', activePalette.accent);
            document.documentElement.style.setProperty('--accent-soft', activePalette.soft);
            document.documentElement.style.setProperty('--glow', activePalette.glow);
            document.querySelectorAll('#paletteChips .palette').forEach((button, index) => {
                button.classList.toggle('active', palettes[index].key === activePalette.key);
            });
        }

        function renderSamples() {
            document.querySelectorAll('#samples .sample').forEach((button, index) => {
                button.classList.toggle('active', index === activeSampleIndex);
            });
        }

        function generateSparkles() {
            sparkles.innerHTML = '';
            for (let i = 0; i < 14; i++) {
                const node = document.createElement('span');
                node.className = 'sparkle';
                node.style.left = `${8 + Math.random() * 84}%`;
                node.style.bottom = `${Math.random() * 28}%`;
                node.style.animationDelay = `${Math.random() * 8}s`;
                node.style.animationDuration = `${8 + Math.random() * 7}s`;
                sparkles.appendChild(node);
            }
        }

        function rerender() {
            renderPalette();
            renderVoice();
            renderOrnaments();
            renderGlow();
            renderMotto();
            renderVerse();
            renderSamples();
        }

        buildChoiceButtons('samples', samples, 'sample chip', (item, index) => {
            activeSampleIndex = index;
            sourceText.value = item.text;
            rerender();
        }, (button, item) => {
            button.textContent = item.title;
        });

        buildChoiceButtons('voiceChips', voices, 'chip', (item) => {
            activeVoice = item;
            rerender();
        }, (button, item) => {
            button.textContent = item.label;
        });

        buildChoiceButtons('paletteChips', palettes, 'palette chip', (item) => {
            activePalette = item;
            rerender();
        }, (button, item) => {
            button.innerHTML = `<span class="dot" style="background:${item.dot}"></span>${item.label}`;
        });

        sourceText.addEventListener('input', rerender);
        ornamentRange.addEventListener('input', rerender);
        glowRange.addEventListener('input', rerender);
        mottoInput.addEventListener('input', rerender);

        elevateBtn.addEventListener('click', () => {
            sourceText.value = transformText(sourceText.value, activeVoice.key || 'cathedral');
            rerender();
        });

        randomBtn.addEventListener('click', () => {
            activeSampleIndex = Math.floor(Math.random() * samples.length);
            activeVoice = voices[Math.floor(Math.random() * voices.length)];
            activePalette = palettes[Math.floor(Math.random() * palettes.length)];
            ornamentRange.value = String(3 + Math.floor(Math.random() * 10));
            glowRange.value = String(24 + Math.floor(Math.random() * 72));
            sourceText.value = samples[activeSampleIndex].text;
            rerender();
        });

        printBtn.addEventListener('click', () => window.print());

        generateSparkles();
        rerender();
    </script>
</body>
</html>
