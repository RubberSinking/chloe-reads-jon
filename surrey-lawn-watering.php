<?php
/**
 * Surrey Lawn Watering Assistant
 * Fetches real-time rainfall data from FlowWorks (Surrey Municipal Hall gauge)
 * and tells you whether you need to water the lawn this week.
 */

// ──────────────────────────────────────────────
// Data fetching & parsing
// ──────────────────────────────────────────────

function fetchDailyRain(int $month, int $year): array {
    $url = "https://www.flowworks.com/network/rainfallstats/statsopen.aspx"
         . "?externalRequest=surreyrain&siteid=32"
         . "&sitefullname=Surrey%20Municipal%20Hall"
         . "&measid=1226&month={$month}&year={$year}";

    $ctx = stream_context_create(['http' => [
        'timeout'       => 10,
        'user_agent'    => 'Mozilla/5.0 (compatible; SurreyRainChecker/1.0)',
        'ignore_errors' => true,
    ]]);

    $html = @file_get_contents($url, false, $ctx);
    if (!$html) return [];

    // Each day row has two <td class="rainheader"> cells:
    //   [0] = day number (1-31), [1] = daily total in mm
    preg_match_all('/<td class="rainheader">([^<]+)<\/td>/', $html, $m);
    $headers = $m[1];

    $rain = [];
    for ($i = 0; $i + 1 < count($headers); $i += 2) {
        $day   = (int) trim($headers[$i]);
        $total = trim($headers[$i + 1]);
        // "0.0", "10.1", etc — skip non-numeric (shouldn't happen but just in case)
        if ($day >= 1 && $day <= 31 && is_numeric($total)) {
            $rain[$day] = (float) $total;
        }
    }
    return $rain;
}

// Today in Pacific Time
$now       = new DateTimeImmutable('now', new DateTimeZone('America/Vancouver'));
$todayDay  = (int) $now->format('j');
$thisMonth = (int) $now->format('n');
$thisYear  = (int) $now->format('Y');

// Fetch current month (and last month if today is early in the month)
$rainByDate = []; // keyed 'YYYY-MM-DD'
$fetchErrors = [];

// Always fetch current month
$currentMonthRain = fetchDailyRain($thisMonth, $thisYear);
if (empty($currentMonthRain)) {
    $fetchErrors[] = "Could not fetch current month data.";
} else {
    foreach ($currentMonthRain as $d => $mm) {
        $key = sprintf('%04d-%02d-%02d', $thisYear, $thisMonth, $d);
        $rainByDate[$key] = $mm;
    }
}

// Fetch previous month if we need more than current month has
$need = 7; // days to look back
if ($todayDay <= $need) {
    $prevDT = (new DateTime("{$thisYear}-{$thisMonth}-01"))->modify('-1 month');
    $prevMonth = (int) $prevDT->format('n');
    $prevYear  = (int) $prevDT->format('Y');
    $prevMonthRain = fetchDailyRain($prevMonth, $prevYear);
    foreach ($prevMonthRain as $d => $mm) {
        $key = sprintf('%04d-%02d-%02d', $prevYear, $prevMonth, $d);
        $rainByDate[$key] = $mm;
    }
}

// Build last-7-days data (excluding today since it's not complete)
$days = [];
for ($i = $need; $i >= 1; $i--) {
    $dt  = $now->modify("-{$i} days");
    $key = $dt->format('Y-m-j');   // internal
    $dateKey = $dt->format('Y-m-d');
    $label = $dt->format('D j');
    $mm = $rainByDate[$dateKey] ?? null;
    $days[] = [
        'label'   => $label,
        'date'    => $dateKey,
        'mm'      => $mm,
        'weekday' => (int) $dt->format('N'),
    ];
}

// Total rainfall for the 7-day window (only counted days)
$totalMm   = 0;
$countKnown = 0;
foreach ($days as $d) {
    if ($d['mm'] !== null) {
        $totalMm += $d['mm'];
        $countKnown++;
    }
}
$totalIn = $totalMm / 25.4;

// ──────────────────────────────────────────────
// Watering recommendation
// Month-based threshold: summer needs ~25mm/week; spring/fall ~15mm; winter skip
// ──────────────────────────────────────────────
$monthThresholds = [
    1 => null, 2 => null, 3 => 12,
    4 => 15,   5 => 20,   6 => 25,
    7 => 28,   8 => 28,   9 => 22,
    10 => 15, 11 => null, 12 => null,
];
$threshold = $monthThresholds[$thisMonth];

if ($threshold === null) {
    $verdict = 'dormant';
    $verdictText = "Lawn is dormant";
    $verdictSub  = "No watering needed — it's " . $now->format('F') . " in Surrey!";
    $verdictEmoji = '❄️';
    $verdictColor = '#64748b';
    $bgGradient = 'linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%)';
} elseif ($totalMm >= $threshold) {
    $verdict = 'skip';
    $verdictText = "Skip watering";
    $verdictSub  = number_format($totalMm, 1) . " mm of rain in the past 7 days — the lawn's happy!";
    $verdictEmoji = '☔';
    $verdictColor = '#0369a1';
    $bgGradient = 'linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%)';
} elseif ($totalMm >= $threshold * 0.6) {
    $verdict = 'maybe';
    $verdictText = "Maybe water a little";
    $verdictSub  = number_format($totalMm, 1) . " mm in 7 days — borderline. Quick pass if you like.";
    $verdictEmoji = '🌤️';
    $verdictColor = '#b45309';
    $bgGradient = 'linear-gradient(135deg, #fef3c7 0%, #fde68a 100%)';
} else {
    $verdict = 'water';
    $verdictText = "Water the lawn";
    $verdictSub  = "Only " . number_format($totalMm, 1) . " mm in 7 days — the grass needs a drink!";
    $verdictEmoji = '🌿';
    $verdictColor = '#15803d';
    $bgGradient = 'linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%)';
}

// Find max mm for bar chart scaling
$maxMm = 0;
foreach ($days as $d) {
    if ($d['mm'] !== null && $d['mm'] > $maxMm) $maxMm = $d['mm'];
}
$maxMm = max($maxMm, 5); // minimum scale

// Month name for display
$monthName = $now->format('F Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Surrey Lawn Watering Assistant</title>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    font-family: system-ui, -apple-system, sans-serif;
    background: #f0fdf4;
    min-height: 100vh;
    padding: 24px 16px 48px;
    color: #1a1a1a;
}

.container {
    max-width: 560px;
    margin: 0 auto;
}

header {
    text-align: center;
    margin-bottom: 28px;
}
header h1 {
    font-size: 1.7em;
    font-weight: 800;
    letter-spacing: -0.5px;
    color: #14532d;
    margin-bottom: 4px;
}
header .subtitle {
    color: #6b7280;
    font-size: 0.88em;
}

/* ── Verdict card ── */
.verdict-card {
    border-radius: 20px;
    padding: 28px 24px;
    text-align: center;
    margin-bottom: 24px;
    background: <?= $bgGradient ?>;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
.verdict-emoji { font-size: 3.5em; line-height: 1; margin-bottom: 12px; }
.verdict-title {
    font-size: 2em;
    font-weight: 900;
    letter-spacing: -1px;
    color: <?= $verdictColor ?>;
    margin-bottom: 8px;
}
.verdict-sub {
    font-size: 1em;
    color: #374151;
    line-height: 1.5;
}
.verdict-units {
    margin-top: 14px;
    font-size: 0.85em;
    color: #6b7280;
}
.verdict-units strong {
    color: <?= $verdictColor ?>;
    font-weight: 700;
}

/* ── Bar chart ── */
.chart-card {
    background: white;
    border-radius: 16px;
    padding: 20px 20px 16px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
}
.chart-title {
    font-size: 0.82em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6b7280;
    margin-bottom: 16px;
}
.bars {
    display: flex;
    align-items: flex-end;
    gap: 6px;
    height: 120px;
    padding-bottom: 28px;
    position: relative;
}
.bar-wrap {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    height: 100%;
    position: relative;
}
.bar {
    width: 100%;
    border-radius: 6px 6px 0 0;
    min-height: 3px;
    transition: opacity 0.2s;
    position: relative;
}
.bar:hover { opacity: 0.8; }
.bar-val {
    position: absolute;
    top: -18px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.68em;
    font-weight: 700;
    color: #374151;
    white-space: nowrap;
}
.bar-label {
    position: absolute;
    bottom: -22px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.68em;
    color: #9ca3af;
    white-space: nowrap;
    text-align: center;
}
.bar-unknown {
    width: 100%;
    height: 3px;
    background: #e5e7eb;
    border-radius: 3px;
}

/* Threshold line */
.threshold-line {
    position: absolute;
    left: 0;
    right: 0;
    border-top: 2px dashed #f59e0b;
    pointer-events: none;
}
.threshold-label {
    position: absolute;
    right: 4px;
    font-size: 0.62em;
    color: #f59e0b;
    font-weight: 700;
    background: white;
    padding: 0 2px;
    top: -8px;
}

/* ── Info strip ── */
.info-strip {
    background: white;
    border-radius: 14px;
    padding: 16px 18px;
    margin-bottom: 20px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 8px;
    text-align: center;
}
.stat-label {
    font-size: 0.72em;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 3px;
}
.stat-value {
    font-size: 1.25em;
    font-weight: 800;
    color: #1f2937;
}
.stat-unit {
    font-size: 0.7em;
    color: #9ca3af;
    margin-top: 1px;
}

/* ── Lawn animation ── */
.lawn-scene {
    background: #f0fdf4;
    border-radius: 14px;
    padding: 20px 16px 8px;
    overflow: hidden;
    margin-bottom: 20px;
    position: relative;
    min-height: 110px;
}
.lawn-grass {
    display: flex;
    align-items: flex-end;
    gap: 2px;
    height: 60px;
    justify-content: center;
}
.blade {
    width: 6px;
    border-radius: 3px 3px 0 0;
    transform-origin: bottom center;
    animation: sway var(--dur, 2s) ease-in-out infinite alternate var(--del, 0s);
}
@keyframes sway {
    from { transform: rotate(-5deg) scaleY(1); }
    to   { transform: rotate(5deg) scaleY(<?= $verdict === 'water' ? '0.82' : '1' ?>); }
}
.sun {
    position: absolute;
    top: 10px; right: 20px;
    width: 36px; height: 36px;
    background: #fbbf24;
    border-radius: 50%;
    box-shadow: 0 0 0 6px #fef3c7;
    animation: spin 20s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

.raindrop-container {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 80px;
    overflow: hidden;
    pointer-events: none;
}
.raindrop {
    position: absolute;
    width: 2px;
    border-radius: 2px;
    background: linear-gradient(to bottom, transparent, #60a5fa);
    animation: fall var(--dur2, 0.8s) linear infinite var(--del2, 0s);
}
@keyframes fall {
    from { transform: translateY(-20px); opacity: 1; }
    to   { transform: translateY(90px); opacity: 0; }
}

.lawn-status {
    text-align: center;
    font-size: 0.8em;
    color: #6b7280;
    margin-top: 6px;
    padding-bottom: 4px;
}

/* ── Error notice ── */
.error-notice {
    background: #fff7ed;
    border: 1px solid #fed7aa;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 0.82em;
    color: #92400e;
    margin-bottom: 16px;
}

/* ── Footer ── */
footer {
    text-align: center;
    font-size: 0.75em;
    color: #9ca3af;
    margin-top: 8px;
}
footer a { color: #9ca3af; }

/* ── Refresh button ── */
.refresh-btn {
    display: block;
    width: 100%;
    padding: 12px;
    background: #14532d;
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 0.95em;
    font-weight: 600;
    cursor: pointer;
    margin-bottom: 20px;
    text-decoration: none;
    text-align: center;
    transition: background 0.15s;
}
.refresh-btn:hover { background: #166534; }
</style>
</head>
<body>
<div class="container">

    <header>
        <h1>🌱 Surrey Lawn Watering</h1>
        <div class="subtitle">Live rainfall data · Surrey Municipal Hall gauge</div>
    </header>

    <?php if (!empty($fetchErrors)): ?>
    <div class="error-notice">
        ⚠️ <?= implode(' ', array_map('htmlspecialchars', $fetchErrors)) ?>
        Showing any cached or partial data.
    </div>
    <?php endif; ?>

    <!-- Verdict card -->
    <div class="verdict-card">
        <div class="verdict-emoji"><?= $verdictEmoji ?></div>
        <div class="verdict-title"><?= htmlspecialchars($verdictText) ?></div>
        <div class="verdict-sub"><?= htmlspecialchars($verdictSub) ?></div>
        <?php if ($threshold !== null): ?>
        <div class="verdict-units">
            Weekly threshold: <strong><?= $threshold ?> mm</strong>
            &nbsp;·&nbsp;
            Today: <strong><?= $now->format('F j') ?></strong>
        </div>
        <?php endif; ?>
    </div>

    <!-- Stat strip -->
    <div class="info-strip">
        <div>
            <div class="stat-label">7-day rain</div>
            <div class="stat-value"><?= number_format($totalMm, 1) ?></div>
            <div class="stat-unit">mm</div>
        </div>
        <div>
            <div class="stat-label">In inches</div>
            <div class="stat-value"><?= number_format($totalIn, 2) ?></div>
            <div class="stat-unit">inches</div>
        </div>
        <div>
            <div class="stat-label">Need/week</div>
            <div class="stat-value"><?= $threshold ?? '—' ?></div>
            <div class="stat-unit">mm (<?= $now->format('M') ?>)</div>
        </div>
    </div>

    <!-- Bar chart -->
    <div class="chart-card">
        <div class="chart-title">Rainfall — past 7 days (mm)</div>
        <div class="bars" id="bars">
            <?php
            // If threshold is set, compute where to draw the dashed line.
            // Line height as % of the chart area (120px bar area).
            // We draw it proportionally to maxMm.
            $chartAreaPx = 92; // px available for bars (120 - 28 label)
            if ($threshold !== null && $maxMm > 0) {
                $threshPerDay = $threshold / 7; // daily average
                $linePct = min(100, $threshPerDay / $maxMm * 100);
                $lineBottom = $linePct * $chartAreaPx / 100; // px from bottom
                echo "<div class=\"threshold-line\" style=\"bottom: " . round($lineBottom + 28) . "px\">"
                   . "<span class=\"threshold-label\">" . number_format($threshPerDay, 1) . "mm avg</span></div>";
            }

            foreach ($days as $d):
                $mm = $d['mm'];
                if ($mm === null) {
                    ?>
                    <div class="bar-wrap">
                        <span class="bar-val" style="top:-14px;color:#d1d5db">?</span>
                        <div class="bar-unknown"></div>
                        <span class="bar-label"><?= htmlspecialchars($d['label']) ?></span>
                    </div>
                    <?php
                } else {
                    $heightPx = $maxMm > 0 ? max(3, round($mm / $maxMm * $chartAreaPx)) : 3;
                    // Color: blue shades based on intensity
                    $ratio = $maxMm > 0 ? $mm / $maxMm : 0;
                    if ($mm == 0) {
                        $color = '#e5e7eb';
                    } elseif ($ratio < 0.3) {
                        $color = '#bae6fd';
                    } elseif ($ratio < 0.6) {
                        $color = '#38bdf8';
                    } else {
                        $color = '#0284c7';
                    }
                    $valStr = $mm == 0 ? '' : number_format($mm, 1);
                    ?>
                    <div class="bar-wrap">
                        <?php if ($valStr): ?><span class="bar-val"><?= $valStr ?></span><?php endif; ?>
                        <div class="bar"
                             style="height:<?= $heightPx ?>px; background:<?= $color ?>;"
                             title="<?= htmlspecialchars($d['date']) ?>: <?= $mm ?>mm"></div>
                        <span class="bar-label"><?= htmlspecialchars($d['label']) ?></span>
                    </div>
                    <?php
                }
            endforeach; ?>
        </div>
    </div>

    <!-- Animated lawn scene -->
    <div class="lawn-scene">
        <?php if (in_array($verdict, ['skip', 'maybe'])): ?>
        <!-- Rain drops when wet -->
        <div class="raindrop-container" id="drops"></div>
        <?php else: ?>
        <div class="sun"></div>
        <?php endif; ?>

        <div class="lawn-grass" id="grass">
            <?php
            $bladeColors = $verdict === 'water'
                ? ['#86efac','#4ade80','#22c55e']
                : ['#4ade80','#22c55e','#16a34a','#15803d'];
            $numBlades = 36;
            for ($i = 0; $i < $numBlades; $i++):
                $h = rand(28, 52);
                $dur = number_format(rand(18, 32) / 10, 1);
                $del = number_format(rand(0, 20) / 10, 1);
                $col = $bladeColors[array_rand($bladeColors)];
            ?>
            <div class="blade" style="height:<?= $h ?>px; background:<?= $col ?>; --dur:<?= $dur ?>s; --del:<?= $del ?>s;"></div>
            <?php endfor; ?>
        </div>
        <div class="lawn-status">
            <?php if ($verdict === 'water'): ?>
                😓 Lawn is thirsty — time to water!
            <?php elseif ($verdict === 'maybe'): ?>
                😐 Lawn could use a little drink
            <?php elseif ($verdict === 'skip'): ?>
                😊 Lawn is well-watered — relax!
            <?php else: ?>
                🥶 Lawn is dormant — no action needed
            <?php endif; ?>
        </div>
    </div>

    <a href="?" class="refresh-btn">↻ Refresh data</a>

    <footer>
        Rainfall data: <a href="https://www.flowworks.com/network/rainfallstats/statsopen.aspx?externalRequest=surreyrain&siteid=32&sitefullname=Surrey%20Municipal%20Hall&measid=1226&month=<?= $thisMonth ?>&year=<?= $thisYear ?>" target="_blank">FlowWorks Surrey Municipal Hall</a>
        · Updated: <?= $now->format('M j, Y g:i a') ?> PT
    </footer>
</div>

<?php if (in_array($verdict, ['skip', 'maybe'])): ?>
<script>
// Spawn animated raindrops
const container = document.getElementById('drops');
if (container) {
    const n = <?= $verdict === 'skip' ? 20 : 8 ?>;
    for (let i = 0; i < n; i++) {
        const drop = document.createElement('div');
        drop.className = 'raindrop';
        const left  = Math.random() * 100;
        const dur   = (0.5 + Math.random() * 0.8).toFixed(2);
        const delay = (Math.random() * 2).toFixed(2);
        const height = 8 + Math.floor(Math.random() * 12);
        drop.style.cssText =
            `left:${left}%; height:${height}px; --dur2:${dur}s; --del2:${delay}s;`;
        container.appendChild(drop);
    }
}
</script>
<?php endif; ?>
</body>
</html>
