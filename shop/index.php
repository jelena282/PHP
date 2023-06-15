<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <style>
        .product {
            display: inline-block;
            margin: 10px;
            text-align: center;
        }

        .product img {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <h1>Lista proizvoda</h1>
    <form method="GET">
        <input type="text" name="search" placeholder="Potrazi po imenu ">
        <button type="submit">Search</button>
    </form>
    <div class="products">
        <?php
            $products = json_decode(file_get_contents('products.json'), true);

            if (isset($_GET['search'])) {
                $searchTerm = strtolower($_GET['search']);
                $products = array_filter($products, function ($product) use ($searchTerm) {
                    $productName = strtolower($product['name']);
                    return strpos($productName, $searchTerm) !== false;
                });
            }

            if (empty($products)) {
                echo '<p>No products found.</p>';
            } else {
                foreach ($products as $product) {
                    echo '<div class="product">';
                    echo "<img src='images/{$product['image']}' alt='{$product['name']}'>";
                    echo "<h2>{$product['name']}</h2>";
                    echo "<p>Cena: {$product['price']} DIN</p>";
                    echo '</div>';
                }
            }
        ?>
    </div>
</body>
</html>
