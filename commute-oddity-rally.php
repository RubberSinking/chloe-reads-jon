<?php
$postTitle = '(Untitled)';
$postUrl = 'https://jona.ca/2004/09/following-truckful-of-goats.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commute Oddity Rally</title>
    <style>
        :root {
            --ink: #201915;
            --paper: #f8efdd;
            --cream: #fff8ea;
            --road: #313033;
            --sky: #8dc9dc;
            --ridge: #697d66;
            --field: #b8b875;
            --red: #c63f32;
            --amber: #f1a33b;
            --blue: #21415e;
            --green: #45715f;
            --shadow: rgba(43, 31, 21, 0.22);
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
            background:
                radial-gradient(circle at 16% 18%, rgba(241, 163, 59, 0.34), transparent 28rem),
                linear-gradient(140deg, #d8eced 0%, #f8efdd 42%, #edcf91 100%);
        }

        body {
            min-height: 100%;
            margin: 0;
            color: var(--ink);
            font-family: "Avenir Next", "Trebuchet MS", sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.18;
            background-image:
                linear-gradient(90deg, rgba(32, 25, 21, 0.08) 1px, transparent 1px),
                linear-gradient(rgba(32, 25, 21, 0.08) 1px, transparent 1px);
            background-size: 26px 26px;
            mix-blend-mode: multiply;
        }

        a {
            color: inherit;
        }

        .shell {
            width: min(1160px, calc(100% - 28px));
            margin: 0 auto;
            padding: 22px 0 44px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 12px 0 22px;
        }

        .back-link {
            color: var(--blue);
            font-size: 0.92rem;
            font-weight: 800;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .stamp {
            border: 2px dashed rgba(32, 25, 21, 0.42);
            padding: 7px 10px;
            transform: rotate(2deg);
            color: var(--green);
            font-family: Georgia, "Times New Roman", serif;
            font-size: 0.82rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(340px, 0.95fr);
            gap: clamp(18px, 3vw, 34px);
            align-items: stretch;
        }

        .poster {
            position: relative;
            min-height: 560px;
            overflow: hidden;
            border: 3px solid var(--ink);
            border-radius: 8px;
            background:
                linear-gradient(#8dc9dc 0 38%, #d6c074 38% 55%, #343238 55% 100%);
            box-shadow: 12px 14px 0 rgba(32, 25, 21, 0.16);
            isolation: isolate;
        }

        .sun {
            position: absolute;
            top: 42px;
            left: 48px;
            width: 94px;
            aspect-ratio: 1;
            border: 3px solid var(--ink);
            border-radius: 50%;
            background: #ffcf55;
            box-shadow: 0 0 0 12px rgba(255, 207, 85, 0.32);
        }

        .mountains {
            position: absolute;
            top: 158px;
            left: -5%;
            width: 110%;
            height: 150px;
            background:
                linear-gradient(135deg, transparent 0 42%, var(--ridge) 42% 58%, transparent 58%),
                linear-gradient(45deg, transparent 0 45%, #50675c 45% 61%, transparent 61%),
                linear-gradient(135deg, transparent 0 40%, #7d926c 40% 62%, transparent 62%);
            background-size: 280px 160px, 330px 155px, 250px 140px;
            background-position: 0 10px, 120px 0, 240px 28px;
        }

        .road {
            position: absolute;
            inset: auto 0 0;
            height: 45%;
            clip-path: polygon(22% 0, 78% 0, 100% 100%, 0 100%);
            background:
                repeating-linear-gradient(90deg, transparent 0 82px, rgba(255, 255, 255, 0.9) 82px 130px, transparent 130px 218px),
                linear-gradient(90deg, #242429 0 48%, #f1d76f 48% 52%, #242429 52% 100%);
            background-size: 320px 8px, auto;
            background-position: var(--lane-shift, 0) 52%, 0 0;
            border-top: 3px solid var(--ink);
        }

        .road::before,
        .road::after {
            content: "";
            position: absolute;
            top: 0;
            width: 18%;
            height: 100%;
            background: rgba(255, 248, 234, 0.22);
        }

        .road::before { left: 0; }
        .road::after { right: 0; }

        .vehicle {
            position: absolute;
            left: clamp(36px, 14%, 96px);
            bottom: 98px;
            width: min(54vw, 360px);
            height: 132px;
            transform: translateX(var(--van-nudge, 0)) rotate(var(--van-tilt, -1deg));
            transition: transform 300ms ease;
            z-index: 4;
        }

        .truck-bed {
            position: absolute;
            left: 108px;
            bottom: 34px;
            width: 214px;
            height: 82px;
            border: 3px solid var(--ink);
            border-radius: 4px 7px 8px 4px;
            background:
                repeating-linear-gradient(90deg, rgba(32, 25, 21, 0.12) 0 7px, transparent 7px 20px),
                #9b6f42;
            box-shadow: inset 0 -14px 0 rgba(54, 32, 20, 0.16);
        }

        .cab {
            position: absolute;
            left: 12px;
            bottom: 34px;
            width: 116px;
            height: 92px;
            border: 3px solid var(--ink);
            border-radius: 18px 9px 5px 10px;
            background: var(--red);
        }

        .cab::before {
            content: "";
            position: absolute;
            top: 14px;
            right: 14px;
            width: 48px;
            height: 34px;
            border: 3px solid var(--ink);
            border-radius: 7px 4px 4px 4px;
            background: #c7e8ef;
        }

        .wheel {
            position: absolute;
            bottom: 8px;
            width: 50px;
            aspect-ratio: 1;
            border: 5px solid var(--ink);
            border-radius: 50%;
            background: #f3efe1;
            box-shadow: inset 0 0 0 10px #2b292c;
        }

        .wheel.one { left: 54px; }
        .wheel.two { left: 256px; }

        .goat {
            position: absolute;
            bottom: 72px;
            width: 54px;
            height: 42px;
            transform-origin: 50% 100%;
            animation: bob 1.1s infinite ease-in-out;
        }

        .goat:nth-child(1) { left: 138px; animation-delay: -0.1s; }
        .goat:nth-child(2) { left: 192px; animation-delay: -0.36s; transform: scale(0.9); }
        .goat:nth-child(3) { left: 246px; animation-delay: -0.62s; transform: scale(0.82); }

        .goat::before {
            content: "";
            position: absolute;
            left: 7px;
            bottom: 8px;
            width: 36px;
            height: 23px;
            border: 3px solid var(--ink);
            border-radius: 16px 13px 11px 12px;
            background: #fff8ea;
        }

        .goat::after {
            content: "";
            position: absolute;
            right: 2px;
            bottom: 20px;
            width: 18px;
            height: 16px;
            border: 3px solid var(--ink);
            border-radius: 8px 8px 6px 6px;
            background: #fff8ea;
            box-shadow:
                -25px 20px 0 -7px var(--ink),
                -13px 20px 0 -7px var(--ink),
                6px 18px 0 -7px var(--ink),
                -38px 18px 0 -7px var(--ink);
        }

        .horn {
            position: absolute;
            right: 0;
            bottom: 34px;
            width: 18px;
            height: 14px;
            border-top: 3px solid var(--ink);
            border-left: 3px solid var(--ink);
            transform: rotate(-28deg);
        }

        .caption-plate {
            position: absolute;
            left: 26px;
            right: 26px;
            bottom: 22px;
            display: flex;
            justify-content: space-between;
            gap: 14px;
            align-items: end;
            color: #fff8ea;
            z-index: 5;
        }

        .caption-plate h1 {
            max-width: 420px;
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(2.6rem, 7vw, 5.7rem);
            line-height: 0.86;
            letter-spacing: 0;
            text-shadow: 3px 3px 0 var(--ink);
        }

        .odometer {
            min-width: 126px;
            padding: 10px;
            border: 2px solid #fff8ea;
            border-radius: 7px;
            background: rgba(32, 25, 21, 0.62);
            text-align: right;
            font-family: "Courier New", monospace;
        }

        .odo-number {
            display: block;
            font-size: 1.7rem;
            font-weight: 900;
            color: #f7cf5a;
        }

        .panel {
            display: flex;
            flex-direction: column;
            min-height: 560px;
            border: 3px solid var(--ink);
            border-radius: 8px;
            background:
                linear-gradient(180deg, rgba(255, 248, 234, 0.96), rgba(248, 239, 221, 0.94)),
                var(--paper);
            box-shadow: 12px 14px 0 rgba(32, 25, 21, 0.12);
        }

        .panel-header {
            padding: 20px 20px 14px;
            border-bottom: 3px solid var(--ink);
            background: var(--cream);
        }

        .eyebrow {
            margin: 0 0 6px;
            color: var(--red);
            font-size: 0.78rem;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .panel h2 {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(1.9rem, 3vw, 2.8rem);
            line-height: 0.98;
            letter-spacing: 0;
        }

        .inspiration {
            margin: 12px 0 0;
            max-width: 52ch;
            color: #584339;
            font-size: 0.98rem;
            line-height: 1.48;
        }

        .inspiration a {
            color: var(--blue);
            font-weight: 800;
            text-decoration-thickness: 2px;
            text-underline-offset: 3px;
        }

        .controls {
            display: grid;
            gap: 15px;
            padding: 18px 20px 16px;
        }

        .control {
            display: grid;
            gap: 8px;
        }

        label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            color: #4a372e;
            font-size: 0.8rem;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        label span {
            color: var(--blue);
            font-family: "Courier New", monospace;
            font-size: 0.94rem;
            letter-spacing: 0;
        }

        input[type="range"] {
            width: 100%;
            accent-color: var(--red);
        }

        .button-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            padding: 0 20px 18px;
        }

        button {
            border: 2px solid var(--ink);
            border-radius: 7px;
            background: #fff8ea;
            color: var(--ink);
            min-height: 44px;
            padding: 10px 12px;
            font: 900 0.82rem/1 "Avenir Next", "Trebuchet MS", sans-serif;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            box-shadow: 4px 4px 0 rgba(32, 25, 21, 0.18);
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        button:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 rgba(32, 25, 21, 0.18);
        }

        button.primary {
            background: var(--amber);
        }

        .readout {
            display: grid;
            grid-template-columns: 0.86fr 1.14fr;
            gap: 14px;
            padding: 0 20px 20px;
        }

        .score {
            display: grid;
            align-content: center;
            justify-items: center;
            min-height: 164px;
            border: 2px solid var(--ink);
            border-radius: 8px;
            background:
                radial-gradient(circle at 50% 24%, rgba(241, 163, 59, 0.35), transparent 38%),
                #f4dfba;
            text-align: center;
        }

        .score strong {
            display: block;
            color: var(--red);
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(3.1rem, 8vw, 5rem);
            line-height: 0.9;
        }

        .score small {
            max-width: 12ch;
            font-size: 0.74rem;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .route-card {
            min-height: 164px;
            border: 2px solid var(--ink);
            border-radius: 8px;
            background: var(--cream);
            padding: 16px;
        }

        .route-card h3 {
            margin: 0 0 8px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.25rem;
        }

        .route-card p {
            margin: 0;
            color: #584339;
            line-height: 1.5;
        }

        .log {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            padding: 0 20px 20px;
        }

        .log-item {
            min-height: 104px;
            border: 2px solid rgba(32, 25, 21, 0.36);
            border-radius: 8px;
            padding: 12px;
            background: rgba(255, 248, 234, 0.76);
        }

        .log-item b {
            display: block;
            margin-bottom: 6px;
            color: var(--blue);
            font-family: "Courier New", monospace;
            font-size: 0.82rem;
        }

        .log-item span {
            color: #584339;
            font-size: 0.88rem;
            line-height: 1.35;
        }

        .postcard {
            margin-top: 24px;
            display: grid;
            grid-template-columns: 0.88fr 1.12fr;
            gap: 18px;
            align-items: stretch;
            border: 3px solid var(--ink);
            border-radius: 8px;
            background: #fff8ea;
            box-shadow: 10px 12px 0 rgba(32, 25, 21, 0.12);
            overflow: hidden;
        }

        .postcard-art {
            min-height: 230px;
            border-right: 3px solid var(--ink);
            background:
                radial-gradient(circle at 70% 18%, #f6cb54 0 44px, transparent 45px),
                linear-gradient(170deg, #7bb4c7 0 44%, #c4b66a 44% 59%, #2d2d31 59%);
            position: relative;
        }

        .postcard-art::before {
            content: "";
            position: absolute;
            left: 14%;
            right: 10%;
            bottom: 24%;
            height: 52px;
            border: 3px solid var(--ink);
            border-radius: 8px;
            background: #b66a3c;
            box-shadow:
                -44px 8px 0 -3px var(--red),
                58px 46px 0 -15px #181719,
                -50px 46px 0 -15px #181719;
        }

        .postcard-art::after {
            content: "three small faces at the rail";
            position: absolute;
            left: 20px;
            right: 20px;
            bottom: 18px;
            color: #fff8ea;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 1.4rem;
            font-style: italic;
            line-height: 1;
            text-shadow: 2px 2px 0 var(--ink);
        }

        .postcard-copy {
            padding: 20px;
        }

        .postcard-copy h2 {
            margin: 0 0 10px;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(1.7rem, 3vw, 2.7rem);
            line-height: 0.96;
        }

        .postcard-copy p {
            margin: 0 0 14px;
            color: #584339;
            line-height: 1.55;
        }

        .ticket {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ticket span {
            border: 2px solid rgba(32, 25, 21, 0.28);
            border-radius: 999px;
            padding: 7px 10px;
            color: var(--blue);
            background: rgba(141, 201, 220, 0.18);
            font-size: 0.8rem;
            font-weight: 900;
        }

        @keyframes bob {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50% { transform: translateY(-5px) rotate(2deg); }
        }

        @media (max-width: 860px) {
            .hero,
            .postcard {
                grid-template-columns: 1fr;
            }

            .poster,
            .panel {
                min-height: auto;
            }

            .poster {
                height: 62vh;
                min-height: 470px;
            }

            .postcard-art {
                border-right: 0;
                border-bottom: 3px solid var(--ink);
            }
        }

        @media (max-width: 560px) {
            .shell {
                width: min(100% - 20px, 1160px);
                padding-top: 12px;
            }

            .topbar {
                align-items: flex-start;
            }

            .stamp {
                max-width: 128px;
                text-align: center;
            }

            .poster {
                min-height: 420px;
                height: 56vh;
                box-shadow: 6px 8px 0 rgba(32, 25, 21, 0.16);
            }

            .sun {
                top: 28px;
                left: 28px;
                width: 70px;
            }

            .vehicle {
                left: 2px;
                bottom: 82px;
                width: 330px;
                transform: translateX(calc(var(--van-nudge, 0) * 0.5)) rotate(var(--van-tilt, -1deg)) scale(0.84);
                transform-origin: 0 100%;
            }

            .caption-plate {
                left: 16px;
                right: 16px;
                bottom: 16px;
                align-items: start;
                flex-direction: column;
            }

            .caption-plate h1 {
                font-size: clamp(2.45rem, 15vw, 4.1rem);
            }

            .panel {
                box-shadow: 6px 8px 0 rgba(32, 25, 21, 0.12);
            }

            .readout,
            .log,
            .button-row {
                grid-template-columns: 1fr;
            }

            .log-item {
                min-height: auto;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <nav class="topbar" aria-label="Project">
            <a class="back-link" href="index.php">Back to Chloe Reads Jon</a>
            <div class="stamp">Surrey roadside archive</div>
        </nav>

        <section class="hero">
            <div class="poster" aria-label="A stylized road scene with a red truck carrying three curious passengers">
                <div class="sun"></div>
                <div class="mountains"></div>
                <div class="road" id="road"></div>
                <div class="vehicle" id="vehicle">
                    <div class="cab"></div>
                    <div class="truck-bed"></div>
                    <div class="goat"><i class="horn"></i></div>
                    <div class="goat"><i class="horn"></i></div>
                    <div class="goat"><i class="horn"></i></div>
                    <div class="wheel one"></div>
                    <div class="wheel two"></div>
                </div>
                <div class="caption-plate">
                    <h1>Commute Oddity Rally</h1>
                    <div class="odometer">
                        <small>Wonder</small>
                        <span class="odo-number" id="wonder">073</span>
                    </div>
                </div>
            </div>

            <section class="panel" aria-label="Route controls">
                <div class="panel-header">
                    <p class="eyebrow">Tiny sightings, fully honoured</p>
                    <h2>Build a ridiculous little drive home.</h2>
                    <p class="inspiration">
                        Inspired by Jon's tiny untitled post, <a href="<?php echo htmlspecialchars($postUrl, ENT_QUOTES); ?>"><?php echo htmlspecialchars($postTitle, ENT_QUOTES); ?></a>, about following a truckful of goats.
                    </p>
                </div>

                <div class="controls">
                    <div class="control">
                        <label for="distance">Following distance <span id="distanceValue">5 car lengths</span></label>
                        <input id="distance" type="range" min="1" max="9" value="5">
                    </div>
                    <div class="control">
                        <label for="traffic">Traffic drama <span id="trafficValue">medium</span></label>
                        <input id="traffic" type="range" min="0" max="10" value="4">
                    </div>
                    <div class="control">
                        <label for="wonderDial">Wonder dial <span id="wonderValue">generous</span></label>
                        <input id="wonderDial" type="range" min="0" max="10" value="7">
                    </div>
                </div>

                <div class="button-row">
                    <button class="primary" id="newRoute" type="button">New route</button>
                    <button id="addSighting" type="button">Add sighting</button>
                </div>

                <div class="readout">
                    <div class="score">
                        <strong id="score">73</strong>
                        <small>oddity score</small>
                    </div>
                    <div class="route-card">
                        <h3 id="routeTitle">King George Boulevard, golden hour</h3>
                        <p id="routeText">A red farm truck keeps a noble pace while three alert passengers audit the intersection like tiny road commissioners.</p>
                    </div>
                </div>

                <div class="log" id="log" aria-label="Sighting log">
                    <div class="log-item"><b>km 0.4</b><span>One passenger stands like a lookout.</span></div>
                    <div class="log-item"><b>km 1.8</b><span>The truck drifts past a bakery window.</span></div>
                    <div class="log-item"><b>km 3.1</b><span>Everyone at the light pretends not to stare.</span></div>
                </div>
            </section>
        </section>

        <section class="postcard" aria-label="Generated commute postcard">
            <div class="postcard-art"></div>
            <div class="postcard-copy">
                <h2 id="postcardTitle">A Field Guide to Being Delighted in Traffic</h2>
                <p id="postcardText">Some posts are essays. Some are single sparks. This one is the latter: a moving frame, a strange cargo, and the cheerful fact that the day briefly refused to be ordinary.</p>
                <div class="ticket">
                    <span id="ticketPace">steady pace</span>
                    <span id="ticketMood">high wonder</span>
                    <span id="ticketMoral">notice the odd thing</span>
                </div>
            </div>
        </section>
    </main>

    <script>
        const routes = [
            {
                title: "King George Boulevard, golden hour",
                text: "A red farm truck keeps a noble pace while three alert passengers audit the intersection like tiny road commissioners.",
                postcard: "A moving frame, a strange cargo, and the cheerful fact that the day briefly refused to be ordinary."
            },
            {
                title: "Fraser Highway, light rain",
                text: "Brake lights glow on wet asphalt while the cargo bed becomes the most memorable theatre in the lane.",
                postcard: "The best commute stories do not ask permission. They pull up ahead of you and make the whole road look handwritten."
            },
            {
                title: "152 Street, after errands",
                text: "The truck bounces once, the passengers bob with solemn dignity, and every minivan nearby receives a small gift of absurdity.",
                postcard: "A day can be ordinary and still contain one perfect sighting, provided someone is awake enough to notice it."
            },
            {
                title: "Old Yale Road, late afternoon",
                text: "The mountains sit in the haze, the lanes crawl along, and the truck carries its woolly committee toward legend.",
                postcard: "There are moments too small for a thesis and too good to throw away. That is what the roadside archive is for."
            }
        ];

        const sightings = [
            "One passenger stands like a lookout.",
            "The truck drifts past a bakery window.",
            "Everyone at the light pretends not to stare.",
            "A compact car gives the scene a respectful extra length.",
            "The rear passenger chews as if reviewing the asphalt.",
            "The driver signals. The whole lane seems invested.",
            "A cyclist turns their head twice.",
            "The cargo bed becomes a tiny moving grandstand.",
            "The sky clears exactly when the truck changes lanes."
        ];

        const distance = document.getElementById("distance");
        const traffic = document.getElementById("traffic");
        const wonderDial = document.getElementById("wonderDial");
        const score = document.getElementById("score");
        const wonder = document.getElementById("wonder");
        const vehicle = document.getElementById("vehicle");
        const road = document.getElementById("road");
        const log = document.getElementById("log");
        const routeTitle = document.getElementById("routeTitle");
        const routeText = document.getElementById("routeText");
        const postcardText = document.getElementById("postcardText");
        const ticketPace = document.getElementById("ticketPace");
        const ticketMood = document.getElementById("ticketMood");
        const ticketMoral = document.getElementById("ticketMoral");
        const distanceValue = document.getElementById("distanceValue");
        const trafficValue = document.getElementById("trafficValue");
        const wonderValue = document.getElementById("wonderValue");

        let routeIndex = 0;
        let sightingOffset = 0;

        function labelTraffic(value) {
            if (value <= 2) return "clear";
            if (value <= 5) return "medium";
            if (value <= 8) return "thick";
            return "heroic";
        }

        function labelWonder(value) {
            if (value <= 2) return "sleepy";
            if (value <= 5) return "curious";
            if (value <= 8) return "generous";
            return "mythic";
        }

        function update() {
            const d = Number(distance.value);
            const t = Number(traffic.value);
            const w = Number(wonderDial.value);
            const oddity = Math.max(12, Math.min(99, Math.round(34 + w * 7 + t * 2 - Math.abs(d - 5) * 3)));

            distanceValue.textContent = `${d} car ${d === 1 ? "length" : "lengths"}`;
            trafficValue.textContent = labelTraffic(t);
            wonderValue.textContent = labelWonder(w);
            score.textContent = oddity;
            wonder.textContent = String(oddity).padStart(3, "0");

            vehicle.style.setProperty("--van-nudge", `${(5 - d) * 10}px`);
            vehicle.style.setProperty("--van-tilt", `${(t - 4) * 0.45}deg`);
            road.style.setProperty("--lane-shift", `${-t * 16}px`);

            ticketPace.textContent = d <= 3 ? "close watch" : d >= 7 ? "patient distance" : "steady pace";
            ticketMood.textContent = `${labelWonder(w)} wonder`;
            ticketMoral.textContent = oddity > 82 ? "make it folklore" : "notice the odd thing";
        }

        function renderRoute() {
            const route = routes[routeIndex];
            routeTitle.textContent = route.title;
            routeText.textContent = route.text;
            postcardText.textContent = route.postcard;
        }

        function renderLog() {
            const items = Array.from({ length: 3 }, (_, i) => {
                const km = (0.4 + (i * 1.35) + sightingOffset * 0.22).toFixed(1);
                const sighting = sightings[(sightingOffset + i) % sightings.length];
                return `<div class="log-item"><b>km ${km}</b><span>${sighting}</span></div>`;
            });
            log.innerHTML = items.join("");
        }

        document.getElementById("newRoute").addEventListener("click", () => {
            routeIndex = (routeIndex + 1) % routes.length;
            renderRoute();
            update();
        });

        document.getElementById("addSighting").addEventListener("click", () => {
            sightingOffset = (sightingOffset + 1) % sightings.length;
            renderLog();
            wonderDial.value = Math.min(10, Number(wonderDial.value) + 1);
            update();
        });

        [distance, traffic, wonderDial].forEach((input) => input.addEventListener("input", update));

        renderRoute();
        renderLog();
        update();
    </script>
</body>
</html>
