<?php
// A fun, interactive "Potent" word generator tool
// Inspired by Jon's mental garden blog post "Turning Adjectives into Nouns"
// https://jona.ca/2011/07/turning-adjectives-into-nouns.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potent Generator ❧</title>
    <style>
        body { font-family: 'Georgia', serif; max-width: 600px; margin: 40px auto; padding: 20px; background: #fdfdf5; color: #333; line-height: 1.6; }
        .card { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e0e0d0; }
        h1 { margin-top: 0; color: #2c3e50; font-size: 1.8em; }
        input { width: 100%; padding: 12px; margin: 15px 0; border: 1px solid #ccc; border-radius: 6px; font-size: 1em; box-sizing: border-box; }
        button { padding: 12px 24px; background: #5d6d7e; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 1em; }
        button:hover { background: #34495e; }
        #result { margin-top: 25px; padding: 20px; background: #f0f4f8; border-left: 4px solid #5d6d7e; display: none; }
        .potent-word { font-weight: bold; font-size: 1.3em; color: #2c3e50; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Potent Generator ❧</h1>
        <p>Jon believes that adjectives like "transitive" or "relational" make perfectly good nouns. Enter an adjective, and let's forge a <em>potent</em>.</p>
        <input type="text" id="adjInput" placeholder="e.g. spasmodic, recursive, relational..." onkeypress="if(event.key==='Enter') generate()">
        <button onclick="generate()">Forge Potent</button>
        <div id="result">
            <p>The potent is:</p>
            <div class="potent-word" id="wordOut"></div>
            <p id="defOut" style="font-style: italic;"></p>
        </div>
    </div>

    <script>
        function generate() {
            const adj = document.getElementById('adjInput').value.trim();
            if (!adj) return;
            
            // Basic potentification logic
            let potent = adj;
            if (adj.endsWith('ive')) potent = adj.slice(0, -3) + 'ion';
            else if (adj.endsWith('al')) potent = adj + 'ity';
            else if (adj.endsWith('ic')) potent = adj + 'y';
            else potent = adj + 'ness';

            document.getElementById('wordOut').innerText = potent.charAt(0).toUpperCase() + potent.slice(1);
            document.getElementById('defOut').innerText = `A ${adj} quality as a noun. "His ${potent} was quite remarkable today."`;
            document.getElementById('result').style.display = 'block';
        }
    </script>
</body>
</html>
