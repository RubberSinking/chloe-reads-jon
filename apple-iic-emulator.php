<?php
// Simple Apple IIc aesthetic emulator/text viewer
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apple IIc Archive Lab</title>
    <style>
        body { background: #000; color: #00ff00; font-family: 'Courier New', Courier, monospace; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh; margin: 0; padding: 20px; }
        .monitor { border: 20px solid #333; padding: 40px; border-radius: 20px; width: 100%; max-width: 600px; box-shadow: 0 0 20px rgba(0,255,0,0.2); }
        .screen { height: 300px; overflow-y: auto; border: 1px solid #00ff00; padding: 20px; }
        h1 { font-size: 1.2em; text-transform: uppercase; margin-bottom: 20px; }
        button { background: transparent; color: #00ff00; border: 1px solid #00ff00; padding: 10px; cursor: pointer; margin-top: 20px; }
        button:hover { background: #00ff00; color: #000; }
    </style>
</head>
<body>
    <div class="monitor">
        <h1>// APPLE IIC ARCHIVE LAB</h1>
        <div class="screen" id="display">
            <p>> BOOTING ARCHIVE...</p>
            <p>> READING JON'S 2009 MENTAL GARDEN...</p>
            <p>> SELECT A MEMORY:</p>
            <ul id="list">
                <li style="cursor:pointer" onclick="show('moon')">1. Moon Patrol memories</li>
                <li style="cursor:pointer" onclick="show('apple')">2. Apple IIc hardware</li>
            </ul>
        </div>
        <button onclick="location.href='index.php'">EXIT</button>
    </div>
    <script>
        function show(id) {
            const display = document.getElementById('display');
            if (id === 'moon') {
                display.innerHTML = "<p>Moon Patrol was my jam.</p><p>Driving across the moon, dodging craters, blasting rocks.</p><p>It felt like the future.</p><p style='text-align:right'>[RETURN]</p>";
            } else {
                display.innerHTML = "<p>The Apple IIc.</p><p>Compact, beige, and undeniably beautiful.</p><p>It wasn't just a computer.</p><p>It was a portal to another world.</p><p style='text-align:right'>[RETURN]</p>";
            }
            display.onclick = () => location.reload();
        }
    </script>
</body>
</html>
