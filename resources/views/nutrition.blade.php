<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Green Tea Info</title>
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>
    <div class="container">
        <header>
            <div>
                <button>Login</button>
                <button>Menu</button>
                <button>Reward</button>
            </div>
            <input type="text" placeholder="Search Menu..." />
        </header>

        <nav>Home > All products > Green Tea</nav>

        <!-- Struktur sama, hanya isi utama diubah -->
        <section class="products">
            <div class="product">
                <div class="image"></div>
                <div>
                    <h3>Green Tea</h3>
                    <p>200 kcal</p>
                    <ul>
                        <li>Carbohydrates: 10%</li>
                        <li>Protein: 10mg</li>
                    </ul>
                </div>
            </div>
        </section>


        <section>
            <h4>Shop similar</h4>
            <div class="products">
                <div class="product">
                    <div class="image"></div>
                    <p>$8</p><small>Jasmine Green Tea</small>
                </div>
                <div class="product">
                    <div class="image"></div>
                    <p>$10</p><small>Gunpowder Green Tea</small>
                </div>
                <div class="product">
                    <div class="image"></div>
                    <p>$22</p><small>Morning Bundle</small>
                </div>
                <div class="product">
                    <div class="image"></div>
                    <p>$6</p><small>Jasmine Green Tea</small>
                </div>
            </div>
        </section>

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