<?php
// Original Self Toy Catalog
// Inspired by Jon's blog post: https://jona.ca/2004/10/your-original-self.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Original Self — A Childhood Catalog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #FFF8E7;
            --warm-white: #FFFCF5;
            --red: #E63946;
            --blue: #1D3557;
            --teal: #2A9D8F;
            --orange: #F4A261;
            --yellow: #E9C46A;
            --brown: #6B4226;
            --dark: #2B2D42;
            --shadow: 6px 6px 0px rgba(43, 45, 66, 0.15);
            --shadow-hover: 10px 10px 0px rgba(43, 45, 66, 0.2);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Work Sans', sans-serif;
            background: var(--cream);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Header */
        .catalog-header {
            background: var(--blue);
            color: var(--cream);
            padding: 2rem 1rem 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .catalog-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 20px,
                rgba(255,255,255,0.03) 20px,
                rgba(255,255,255,0.03) 40px
            );
            animation: slide 20s linear infinite;
        }

        @keyframes slide {
            0% { transform: translate(0, 0); }
            100% { transform: translate(40px, 40px); }
        }

        .catalog-header h1 {
            font-family: 'Shrikhand', cursive;
            font-size: clamp(2rem, 6vw, 3.5rem);
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
            text-shadow: 4px 4px 0px rgba(0,0,0,0.2);
        }

        .catalog-header .subtitle {
            font-size: 1rem;
            opacity: 0.85;
            margin-top: 0.5rem;
            position: relative;
            z-index: 1;
            font-weight: 500;
        }

        .catalog-header .year-badge {
            display: inline-block;
            background: var(--red);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            margin-top: 1rem;
            position: relative;
            z-index: 1;
            box-shadow: 3px 3px 0 rgba(0,0,0,0.2);
            transform: rotate(-2deg);
        }

        /* Collection bar */
        .collection-bar {
            background: var(--warm-white);
            border-bottom: 4px solid var(--dark);
            padding: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 0 rgba(43,45,66,0.1);
        }

        .collection-bar .counter {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--blue);
        }

        .collection-bar .progress-track {
            width: 200px;
            height: 16px;
            background: #e0e0e0;
            border-radius: 10px;
            border: 2px solid var(--dark);
            overflow: hidden;
            position: relative;
        }

        .collection-bar .progress-fill {
            height: 100%;
            background: var(--teal);
            width: 0%;
            transition: width 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-right: 2px solid var(--dark);
        }

        .collection-bar .reset-btn {
            background: var(--orange);
            border: 3px solid var(--dark);
            padding: 0.4rem 1rem;
            font-family: 'Work Sans', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 3px 3px 0 var(--dark);
            transition: all 0.15s;
        }

        .collection-bar .reset-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0 var(--dark);
        }

        /* Catalog grid */
        .catalog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem 4rem;
        }

        .catalog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        /* Product card */
        .product-card {
            background: var(--warm-white);
            border: 4px solid var(--dark);
            border-radius: 16px;
            padding: 1.5rem;
            position: relative;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--accent-color, var(--red));
        }

        .product-card:hover {
            transform: translateY(-4px) rotate(0.5deg);
            box-shadow: var(--shadow-hover);
        }

        .product-card.collected {
            background: #E8F5E9;
            border-color: var(--teal);
        }

        .product-card.collected::after {
            content: 'COLLECTED!';
            position: absolute;
            top: 10px;
            right: -30px;
            background: var(--teal);
            color: white;
            padding: 0.2rem 2rem;
            font-size: 0.7rem;
            font-weight: 700;
            transform: rotate(35deg);
            box-shadow: 2px 2px 0 rgba(0,0,0,0.2);
            letter-spacing: 1px;
        }

        .product-card .category-tag {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.75rem;
            border: 2px solid var(--dark);
        }

        .tag-tech { background: #BBDEFB; color: var(--blue); }
        .tag-toy { background: #FFCCBC; color: #BF360C; }
        .tag-game { background: #C8E6C9; color: #1B5E20; }
        .tag-media { background: #E1BEE7; color: #4A148C; }
        .tag-creative { background: #FFF9C4; color: #F57F17; }
        .tag-food { background: #DCEDC8; color: #33691E; }
        .tag-outdoor { background: #B2DFDB; color: #004D40; }

        .product-card .product-icon {
            font-size: 3.5rem;
            text-align: center;
            margin: 0.5rem 0 1rem;
            display: block;
            filter: drop-shadow(2px 2px 0 rgba(0,0,0,0.1));
        }

        .product-card .product-name {
            font-family: 'Shrikhand', cursive;
            font-size: 1.3rem;
            color: var(--dark);
            text-align: center;
            line-height: 1.2;
            margin-bottom: 0.5rem;
        }

        .product-card .product-price {
            text-align: center;
            font-weight: 700;
            color: var(--red);
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .product-card .collect-btn {
            display: block;
            width: 100%;
            padding: 0.7rem;
            background: var(--accent-color, var(--red));
            color: white;
            border: 3px solid var(--dark);
            border-radius: 10px;
            font-family: 'Work Sans', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 3px 3px 0 var(--dark);
            transition: all 0.15s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-card .collect-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0 var(--dark);
        }

        .product-card.collected .collect-btn {
            background: var(--teal);
        }

        .product-card .collect-btn .btn-text::before {
            content: 'Add to Collection';
        }
        .product-card.collected .collect-btn .btn-text::before {
            content: 'In Collection!';
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(43, 45, 66, 0.85);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 1rem;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-card {
            background: var(--warm-white);
            border: 4px solid var(--dark);
            border-radius: 20px;
            max-width: 560px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            padding: 2rem;
            position: relative;
            box-shadow: 12px 12px 0 rgba(0,0,0,0.3);
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-overlay.active .modal-card {
            transform: scale(1) translateY(0);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 36px;
            height: 36px;
            background: var(--red);
            color: white;
            border: 3px solid var(--dark);
            border-radius: 50%;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 0 var(--dark);
            transition: all 0.15s;
        }

        .modal-close:active {
            transform: translate(1px, 1px);
            box-shadow: 1px 1px 0 var(--dark);
        }

        .modal-icon {
            font-size: 4rem;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .modal-title {
            font-family: 'Shrikhand', cursive;
            font-size: 1.8rem;
            text-align: center;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .modal-category {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .modal-quote {
            background: var(--cream);
            border-left: 5px solid var(--accent-color, var(--red));
            padding: 1.25rem;
            border-radius: 0 12px 12px 0;
            font-style: italic;
            line-height: 1.6;
            color: var(--brown);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .modal-quote::before {
            content: '"';
            font-family: 'Shrikhand', cursive;
            font-size: 3rem;
            color: var(--accent-color, var(--red));
            opacity: 0.3;
            position: absolute;
            top: -0.5rem;
            left: 0.5rem;
            line-height: 1;
        }

        .modal-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding-top: 1rem;
            border-top: 2px dashed var(--dark);
        }

        .modal-rating {
            display: flex;
            gap: 0.2rem;
            font-size: 1.3rem;
        }

        .modal-collect-btn {
            padding: 0.7rem 1.5rem;
            background: var(--accent-color, var(--red));
            color: white;
            border: 3px solid var(--dark);
            border-radius: 10px;
            font-family: 'Work Sans', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 3px 3px 0 var(--dark);
            transition: all 0.15s;
        }

        .modal-collect-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0 var(--dark);
        }

        /* Footer */
        .catalog-footer {
            text-align: center;
            padding: 2rem 1rem 3rem;
            color: var(--brown);
            font-size: 0.85rem;
            border-top: 3px dashed var(--dark);
            margin-top: 2rem;
        }

        .catalog-footer a {
            color: var(--blue);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 2px solid var(--orange);
        }

        /* Confetti */
        .confetti-piece {
            position: fixed;
            width: 10px;
            height: 10px;
            pointer-events: none;
            z-index: 2000;
            animation: confetti-fall 1.5s ease-out forwards;
        }

        @keyframes confetti-fall {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(300px) rotate(720deg); opacity: 0; }
        }

        /* Completion celebration */
        .completion-banner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: var(--yellow);
            border: 5px solid var(--dark);
            border-radius: 20px;
            padding: 2rem 3rem;
            text-align: center;
            z-index: 3000;
            box-shadow: 12px 12px 0 rgba(0,0,0,0.3);
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .completion-banner.show {
            transform: translate(-50%, -50%) scale(1);
        }

        .completion-banner h2 {
            font-family: 'Shrikhand', cursive;
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .completion-banner p {
            font-weight: 600;
            color: var(--brown);
        }

        /* Mobile tweaks */
        @media (max-width: 480px) {
            .catalog-grid {
                grid-template-columns: 1fr;
            }
            .modal-card {
                padding: 1.5rem 1rem;
            }
            .collection-bar .progress-track {
                width: 140px;
            }
        }

        /* Print styles */
        @media print {
            .collection-bar, .modal-overlay, .collect-btn, .modal-collect-btn {
                display: none !important;
            }
            .product-card {
                break-inside: avoid;
                box-shadow: none;
                border: 2px solid #000;
            }
        }
    </style>
</head>
<body>

<div class="catalog-header">
    <h1>Your Original Self</h1>
    <div class="subtitle">A catalog of childhood joys, wonders, and secret worlds</div>
    <div class="year-badge">Fall 1990 Edition</div>
</div>

<div class="collection-bar">
    <span class="counter">Collection: <span id="collected-count">0</span> / <span id="total-count">16</span></span>
    <div class="progress-track">
        <div class="progress-fill" id="progress-fill"></div>
    </div>
    <button class="reset-btn" onclick="resetCollection()">Start Over</button>
</div>

<div class="catalog-container">
    <div class="catalog-grid" id="catalog-grid">
        <!-- Cards generated by JS -->
    </div>
</div>

<div class="catalog-footer">
    <p>Inspired by Jon's blog post <a href="https://jona.ca/2004/10/your-original-self.html">"Your Original Self"</a> from October 2004.</p>
    <p style="margin-top:0.5rem;">Built for the web lab. Click any item to read Jon's memory of it.</p>
</div>

<!-- Modal -->
<div class="modal-overlay" id="modal" onclick="closeModal(event)">
    <div class="modal-card" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <div class="modal-icon" id="modal-icon"></div>
        <div class="modal-title" id="modal-title"></div>
        <div class="modal-category" id="modal-category"></div>
        <div class="modal-quote" id="modal-quote"></div>
        <div class="modal-meta">
            <div class="modal-rating" id="modal-rating"></div>
            <button class="modal-collect-btn" id="modal-collect-btn" onclick="toggleFromModal()">Add to Collection</button>
        </div>
    </div>
</div>

<!-- Completion Banner -->
<div class="completion-banner" id="completion-banner">
    <h2>Collection Complete!</h2>
    <p>You've gathered all the pieces of Jon's original self.</p>
</div>

<script>
const products = [
    {
        id: 'electronics-kit',
        name: '100-in-1 Electronics Lab',
        icon: '🔌',
        category: 'Tech',
        tagClass: 'tag-tech',
        accent: '#1D3557',
        price: '$29.99',
        rating: 5,
        quote: 'I was fascinated by the Radio Shack 100-in-1 electronics kit my mom bought me. An oasis of circuits, wires, and possibilities in a plastic case.'
    },
    {
        id: 'nintendo',
        name: 'Nintendo Entertainment System',
        icon: '🎮',
        category: 'Game',
        tagClass: 'tag-game',
        accent: '#E63946',
        price: '$89.99',
        rating: 5,
        quote: 'I loved Nintendo, playing for hours, reading the video game instructions from cover to cover, dreaming up new video games and trying to make them.'
    },
    {
        id: 'hot-wheels',
        name: 'Hot Wheels Mountain Set',
        icon: '🏎️',
        category: 'Toy',
        tagClass: 'tag-toy',
        accent: '#F4A261',
        price: '$12.99',
        rating: 4,
        quote: 'Playing with Hot Wheels in the rugged mountainous blankets — creating rescue scenarios and racing through the peaks of my bedspread.'
    },
    {
        id: 'lego',
        name: 'LEGO Building Bricks',
        icon: '🧱',
        category: 'Toy',
        tagClass: 'tag-toy',
        accent: '#E9C46A',
        price: '$24.99',
        rating: 5,
        quote: 'Building Lego structures in the sunlit family room. The click of bricks, the endless architectures, the worlds within worlds.'
    },
    {
        id: 'synthesizer',
        name: 'Yamaha Synthesizer',
        icon: '🎹',
        category: 'Creative',
        tagClass: 'tag-creative',
        accent: '#2A9D8F',
        price: '$199.99',
        rating: 5,
        quote: 'Writing and producing music on expensive rented synthesizers. Creating sounds that no one had heard before, layering tracks in my imagination.'
    },
    {
        id: 'apple-iic',
        name: 'Apple IIc Computer',
        icon: '🖥️',
        category: 'Tech',
        tagClass: 'tag-tech',
        accent: '#1D3557',
        price: '$1,295.00',
        rating: 5,
        quote: 'Opening the box of the Apple IIc computer mom bought me one day. The beige beauty, the floppy drive whir, the green phosphor glow of possibility.'
    },
    {
        id: 'comic-books',
        name: 'The Punisher Comics',
        icon: '💀',
        category: 'Media',
        tagClass: 'tag-media',
        accent: '#6B4226',
        price: '$1.50',
        rating: 4,
        quote: 'Making my own comic book, buying The Punisher from comic-book stands at grocery stores. The glossy covers, the dramatic artwork, the moral complexity.'
    },
    {
        id: 'board-games',
        name: 'Strategic Board Games',
        icon: '🎲',
        category: 'Game',
        tagClass: 'tag-game',
        accent: '#E63946',
        price: '$19.99',
        rating: 5,
        quote: 'I loved board games. The strategy, the competition, the shared focus around a table with friends and family, the drama of the dice roll.'
    },
    {
        id: 'submarine',
        name: 'Fisher-Price Submarine',
        icon: '🚢',
        category: 'Toy',
        tagClass: 'tag-toy',
        accent: '#2A9D8F',
        price: '$8.99',
        rating: 4,
        quote: 'Playing with the Fisher-Price submarine in the bathtub. Diving missions, underwater rescues, the periscope breaking the surface of the bubbles.'
    },
    {
        id: 'fort-building',
        name: 'Sofa Cushion Fort Kit',
        icon: '🏰',
        category: 'Toy',
        tagClass: 'tag-toy',
        accent: '#E9C46A',
        price: '$0.00',
        rating: 5,
        quote: 'I liked to make forts out of the sofa cushions in the family room. Architecture from upholstery, castles from couch sections, hideouts from the ordinary.'
    },
    {
        id: 'detective',
        name: "Hardy Boys Detective Kit",
        icon: '🔍',
        category: 'Game',
        tagClass: 'tag-game',
        accent: '#6B4226',
        price: '$7.99',
        rating: 4,
        quote: 'Joining the neighbourhood Detective Agency formed by some other kids. I treasured my Hardy Boys\' Detective\'s Manual. Solving mysteries, looking for clues.'
    },
    {
        id: 'fantasy-map',
        name: 'Hand-Drawn Fantasy Map',
        icon: '🗺️',
        category: 'Creative',
        tagClass: 'tag-creative',
        accent: '#F4A261',
        price: '$0.00',
        rating: 5,
        quote: 'A fantasy land of elves, trolls, and warlocks. I created a map of the school grounds and what they really were — mountains over here, dungeons over there, the golden key hidden over here.'
    },
    {
        id: 'candy',
        name: 'Halloween Candy Haul',
        icon: '🍬',
        category: 'Food',
        tagClass: 'tag-food',
        accent: '#E63946',
        price: '$0.00',
        rating: 5,
        quote: 'I loved candy and chocolate — Halloween was an exciting time! The senses I lived most through were: sight, taste. The thrill of the candy sort.'
    },
    {
        id: 'space-shuttle',
        name: 'Fire Truck & Space Shuttle',
        icon: '🚀',
        category: 'Toy',
        tagClass: 'tag-toy',
        accent: '#1D3557',
        price: '$14.99',
        rating: 4,
        quote: 'Creating rescue scenarios with my fire truck and space shuttle. Emergency response in the living room, where every crisis had a toy solution.'
    },
    {
        id: 'red-vs-blue',
        name: 'Red vs. Blue Secret Game',
        icon: '🔵',
        category: 'Game',
        tagClass: 'tag-game',
        accent: '#2A9D8F',
        price: '$0.00',
        rating: 5,
        quote: 'One was Red vs. Blue. I and my friends were on the Blue Team. The Red Team was led by the dastardly Nathan. The Blues were heroes. The Reds were evil.'
    },
    {
        id: 'wizards-dragons',
        name: 'Wizards & Dragons Daydreams',
        icon: '🐉',
        category: 'Creative',
        tagClass: 'tag-creative',
        accent: '#6B4226',
        price: '$0.00',
        rating: 5,
        quote: 'I loved daydreaming about wizards and orcs and heroes and dragons. "What should I dream about?" I would often ask my brother beside me. "How about meatpies?"'
    }
];

let collected = new Set();
let currentModalId = null;

function loadCollection() {
    const saved = localStorage.getItem('originalSelfCollection');
    if (saved) {
        collected = new Set(JSON.parse(saved));
    }
    updateUI();
}

function saveCollection() {
    localStorage.setItem('originalSelfCollection', JSON.stringify([...collected]));
}

function updateUI() {
    document.getElementById('collected-count').textContent = collected.size;
    document.getElementById('total-count').textContent = products.length;
    const pct = (collected.size / products.length) * 100;
    document.getElementById('progress-fill').style.width = pct + '%';

    products.forEach(p => {
        const card = document.getElementById('card-' + p.id);
        if (card) {
            if (collected.has(p.id)) {
                card.classList.add('collected');
            } else {
                card.classList.remove('collected');
            }
        }
    });

    if (collected.size === products.length && products.length > 0) {
        showCompletion();
    }
}

function toggleCollect(id, event) {
    if (event) event.stopPropagation();
    if (collected.has(id)) {
        collected.delete(id);
    } else {
        collected.add(id);
        spawnConfetti(event);
    }
    saveCollection();
    updateUI();
    if (currentModalId === id) {
        updateModalButton();
    }
}

function toggleFromModal() {
    if (currentModalId) {
        toggleCollect(currentModalId);
    }
}

function updateModalButton() {
    const btn = document.getElementById('modal-collect-btn');
    if (collected.has(currentModalId)) {
        btn.textContent = 'In Collection!';
        btn.style.background = '#2A9D8F';
    } else {
        btn.textContent = 'Add to Collection';
        const product = products.find(p => p.id === currentModalId);
        btn.style.background = product ? product.accent : '#E63946';
    }
}

function openModal(id) {
    const p = products.find(x => x.id === id);
    if (!p) return;
    currentModalId = id;

    document.getElementById('modal-icon').textContent = p.icon;
    document.getElementById('modal-title').textContent = p.name;
    document.getElementById('modal-category').innerHTML = `<span class="category-tag ${p.tagClass}" style="border-color:var(--dark);">${p.category}</span>`;
    document.getElementById('modal-quote').textContent = p.quote;
    document.querySelector('.modal-quote').style.borderLeftColor = p.accent;
    document.querySelector('.modal-quote').style.setProperty('--accent-color', p.accent);

    let stars = '';
    for (let i = 0; i < 5; i++) {
        stars += i < p.rating ? '★' : '☆';
    }
    document.getElementById('modal-rating').textContent = stars;
    document.getElementById('modal-rating').style.color = p.accent;

    updateModalButton();
    document.getElementById('modal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal(event) {
    if (event && event.target !== document.getElementById('modal')) return;
    document.getElementById('modal').classList.remove('active');
    document.body.style.overflow = '';
    currentModalId = null;
}

function resetCollection() {
    if (!confirm('Clear your entire collection and start over?')) return;
    collected.clear();
    saveCollection();
    updateUI();
    document.getElementById('completion-banner').classList.remove('show');
}

function spawnConfetti(event) {
    const colors = ['#E63946', '#1D3557', '#2A9D8F', '#F4A261', '#E9C46A'];
    const x = event ? event.clientX : window.innerWidth / 2;
    const y = event ? event.clientY : window.innerHeight / 2;

    for (let i = 0; i < 12; i++) {
        const piece = document.createElement('div');
        piece.className = 'confetti-piece';
        piece.style.left = x + 'px';
        piece.style.top = y + 'px';
        piece.style.background = colors[Math.floor(Math.random() * colors.length)];
        piece.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
        piece.style.width = (6 + Math.random() * 8) + 'px';
        piece.style.height = (6 + Math.random() * 8) + 'px';
        piece.style.transform = `translate(${Math.random() * 60 - 30}px, ${Math.random() * 60 - 30}px)`;
        document.body.appendChild(piece);
        setTimeout(() => piece.remove(), 1500);
    }
}

function showCompletion() {
    const banner = document.getElementById('completion-banner');
    banner.classList.add('show');
    setTimeout(() => {
        banner.classList.remove('show');
    }, 4000);
}

function renderCatalog() {
    const grid = document.getElementById('catalog-grid');
    grid.innerHTML = products.map(p => `
        <div class="product-card" id="card-${p.id}" style="--accent-color: ${p.accent};" onclick="openModal('${p.id}')">
            <span class="category-tag ${p.tagClass}">${p.category}</span>
            <span class="product-icon">${p.icon}</span>
            <div class="product-name">${p.name}</div>
            <div class="product-price">${p.price}</div>
            <button class="collect-btn" onclick="toggleCollect('${p.id}', event)">
                <span class="btn-text"></span>
            </button>
        </div>
    `).join('');
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
});

renderCatalog();
loadCollection();
</script>

</body>
</html>
