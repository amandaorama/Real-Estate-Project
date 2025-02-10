<?php
// Enable error reporting
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price_min = $_POST['price_min'] ?? 0;
    $price_max = $_POST['price_max'] ?? PHP_INT_MAX;
    $size_min = $_POST['size_min'] ?? 0;
    $size_max = $_POST['size_max'] ?? PHP_INT_MAX;

    // SQL query to search business properties
    $sql = "SELECT Listings.mlsNumber, Listings.address AS listing_address, Property.ownerName, Property.price, BusinessProperty.type, BusinessProperty.size 
            FROM Listings
            INNER JOIN Property ON Listings.address = Property.address
            INNER JOIN BusinessProperty ON Listings.address = BusinessProperty.address
            WHERE Property.price BETWEEN ? AND ?
            AND BusinessProperty.size BETWEEN ? AND ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $price_min, $price_max, $size_min, $size_max);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Business Properties</title>
</head>
<body>
    <h1>Search for Business Properties</h1>
    <form method="post" action="search_business.php">
        <label for="price_min">Min Price:</label>
        <input type="number" name="price_min" id="price_min"><br>

        <label for="price_max">Max Price:</label>
        <input type="number" name="price_max" id="price_max"><br>

        <label for="size_min">Min Size (sq ft):</label>
        <input type="number" name="size_min" id="size_min"><br>

        <label for="size_max">Max Size (sq ft):</label>
        <input type="number" name="size_max" id="size_max"><br>

        <input type="submit" value="Search">
    </form>

    <?php if (isset($result) && $result->num_rows > 0): ?>
        <h2>Search Results:</h2>
        <table border="1">
            <tr>
                <th>MLS Number</th>
                <th>Address</th>
                <th>Owner Name</th>
                <th>Price</th>
                <th>Type</th>
                <th>Size (sq ft)</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row["mlsNumber"]) ?></td>
                    <td><?= htmlspecialchars($row["listing_address"]) ?></td>
                    <td><?= htmlspecialchars($row["ownerName"]) ?></td>
                    <td><?= htmlspecialchars($row["price"]) ?></td>
                    <td><?= htmlspecialchars($row["type"]) ?></td>
                    <td><?= htmlspecialchars($row["size"]) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No results found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>