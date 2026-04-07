<?php
// A simple "Saint of the Day" visual generator.
// Randomly selects a saint from a curated list and displays them with a quote or fact.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saint of the Day Generator</title>
    <style>
        body { font-family: 'Georgia', serif; background: #f4eee0; color: #4a3728; padding: 20px; display: flex; flex-direction: column; align-items: center; }
        .card { background: #fff; border: 2px solid #dcd0c0; padding: 30px; border-radius: 8px; max-width: 500px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { font-size: 1.5em; margin-bottom: 20px; color: #785a40; }
        .name { font-size: 2em; font-weight: bold; margin-bottom: 10px; }
        .quote { font-style: italic; margin-top: 20px; font-size: 1.2em; line-height: 1.6; }
        button { background: #785a40; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; margin-top: 20px; font-size: 1em; }
        button:hover { background: #5d4633; }
    </style>
</head>
<body>
    <div class="card" id="saint-card">
        <h1>Saint of the Day</h1>
        <div id="saint-content">
            <div class="name" id="name">Loading...</div>
            <div class="quote" id="quote"></div>
        </div>
        <button onclick="generate()">Reveal Another</button>
    </div>

    <script>
        const saints = [
            { name: "St. Damien of Molokai", quote: "I make myself a leper for the lepers, to gain all to Jesus Christ." },
            { name: "St. Louis IX", quote: "Fair dealing and the simple heart will carry you further than any scheme." },
            { name: "St. Francis of Assisi", quote: "Start by doing what's necessary; then do what's possible; and suddenly you are doing the impossible." },
            { name: "St. Teresa of Avila", quote: "Let nothing disturb you, nothing frighten you. All things are passing. God never changes." },
            { name: "St. Augustine", quote: "Our hearts are restless until they rest in Thee." },
            { name: "St. Therese of Lisieux", quote: "To love is to give everything, and to give oneself." }
        ];

        function generate() {
            const saint = saints[Math.floor(Math.random() * saints.length)];
            document.getElementById('name').innerText = saint.name;
            document.getElementById('quote').innerText = '"' + saint.quote + '"';
        }

        window.onload = generate;
    </script>
</body>
</html>
