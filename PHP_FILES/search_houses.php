<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "real_estate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search variables
$price_min = $price_max = $bedrooms = $bathrooms = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input and sanitize it
    $price_min = isset($_POST['price_min']) ? (int)$_POST['price_min'] : 0;
    $price_max = isset($_POST['price_max']) ? (int)$_POST['price_max'] : PHP_INT_MAX;
    $bedrooms = isset($_POST['bedrooms']) ? (int)$_POST['bedrooms'] : 0;
    $bathrooms = isset($_POST['bathrooms']) ? (int)$_POST['bathrooms'] : 0;

    // SQL query with exact match for bedrooms and bathrooms
    $stmt = $conn->prepare(
        "SELECT Listings.mlsNumber, Listings.address AS listing_address, Property.ownerName, Property.price, House.bedrooms, House.bathrooms, House.size
        FROM Listings
        INNER JOIN Property ON Listings.address = Property.address
        INNER JOIN House ON Listings.address = House.address
        WHERE Property.price BETWEEN ? AND ?
        AND House.bedrooms = ?
        AND House.bathrooms = ?"
    );

    $stmt->bind_param("iiii", $price_min, $price_max, $bedrooms, $bathrooms);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Houses</title>
</head>
<body>
    <h1>Search for Houses</h1>
    <form method="POST" action="">
        Min Price: <input type="number" name="price_min" required> <br><br>
        Max Price: <input type="number" name="price_max" required> <br><br>
        Bedrooms: <input type="number" name="bedrooms" required> <br><br>
        Bathrooms: <input type="number" name="bathrooms" required> <br><br>
        <input type="submit" value="Search">
    </form>

    <?php if (isset($result)): ?>
        <h2>Search Results:</h2>
        <table border="1">
            <tr>
                <th>MLS Number</th>
                <th>Address</th>
                <th>Owner Name</th>
                <th>Price</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Size</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["mlsNumber"]) ?></td>
                        <td><?= htmlspecialchars($row["listing_address"]) ?></td>
                        <td><?= htmlspecialchars($row["ownerName"]) ?></td>
                        <td><?= htmlspecialchars($row["price"]) ?></td>
                        <td><?= htmlspecialchars($row["bedrooms"]) ?></td>
                        <td><?= htmlspecialchars($row["bathrooms"]) ?></td>
                        <td><?= htmlspecialchars($row["size"]) ?> sq ft</td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7">No matching houses found.</td></tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
