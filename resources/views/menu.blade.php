<!DOCTYPE html>
<html lang="en" data-theme="light"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Menu</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container">
        <!-- HEADER -->
        <header class="header">
            <div class="nav-buttons">
                <button class="nav-btn">Login</button>
                <button class="nav-btn">Menu</button>
                <button class="nav-btn">Reward</button>
            </div>
            <input class="search-bar" type="text" placeholder="Search Menu...">
        </header>

        <!-- FILTER BUTTONS -->
        <section class="filter-section">
            <button class="filter-button">Tea Type</button>
            <button class="filter-button">Size</button>
            <button class="filter-button">Strength</button>
            <button class="filter-button">Caffeine</button>
            <button class="filter-button">Source</button>
        </section>

        <!-- PRODUCT GRID -->
        <section class="products">
            @foreach(['Green Tea' => 15, 'White Tea' => 11, 'Super Matcha' => 12, 'Rooibos Fruit Tea' => 12] as $name => $price)
                <div class="product">
                    <div class="image"></div>
                    <h5>{{ $name }}</h5>
                    <p>${{ $price }}</p>
                </div>
            @endforeach
        </section>

        <!-- BESTSELLERS -->
        <section class="bestsellers">
            <h3>Try our bestsellers</h3>
            <p>At our shop, we believe in the power of herbs to heal and nourish the body...</p>
            <div class="bestseller-list">
                <div class="bestseller-item">
                    <h5>Earl Gray</h5>
                    <small>Bold and Fruit Taste</small>
                </div>
                <div class="bestseller-item">
                    <h5>Jasmine Tea</h5>
                    <small>Light and Refreshing Taste</small>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer>
            <h4>LE TEAM</h4>
            <ul>
                <li>1. Nico Jaco Josef 160420219</li>
                <li>2. Darren Gideon Sutanto 160420232</li>
                <li>3. Matthew Gideon 160420265</li>
                <li>4. Stanley Alexander Gondowidjojo 160420239</li>
                <li>5. James Edward Simonta 160420248</li>
            </ul>
        </footer>
    </div>
</body>
</html>
