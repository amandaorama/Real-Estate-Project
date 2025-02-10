<?php
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

// Query for house listings
$sql_houses = "SELECT Listings.mlsNumber, Listings.address AS listing_address, Property.ownerName, Property.price, House.bedrooms, House.bathrooms, House.size 
               FROM Listings
               INNER JOIN Property ON Listings.address = Property.address
               INNER JOIN House ON Listings.address = House.address
               WHERE Property.address IN (SELECT address FROM House)";
$result_houses = $conn->query($sql_houses);

// Query for business property listings
$sql_business = "SELECT Listings.mlsNumber, Listings.address AS listing_address, Property.ownerName, Property.price, BusinessProperty.type, BusinessProperty.size 
                 FROM Listings
                 INNER JOIN Property ON Listings.address = Property.address
                 INNER JOIN BusinessProperty ON Listings.address = BusinessProperty.address
                 WHERE Property.address IN (SELECT address FROM BusinessProperty)";
$result_business = $conn->query($sql_business);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Listings</title>
</head>
<body>
    <h1>Real Estate Listings</h1>

    <!-- Display House Listings -->
    <h2>House Listings</h2>
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

        <?php
        if ($result_houses->num_rows > 0) {
            // Output data for each house listing
            while($row = $result_houses->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["mlsNumber"] . "</td>
                        <td>" . $row["listing_address"] . "</td>
                        <td>" . $row["ownerName"] . "</td>
                        <td>" . $row["price"] . "</td>
                        <td>" . $row["bedrooms"] . "</td>
                        <td>" . $row["bathrooms"] . "</td>
                        <td>" . $row["size"] . " sq ft</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No house listings available.</td></tr>";
        }
        ?>
    </table>

    <!-- Display Business Property Listings -->
    <h2>Business Property Listings</h2>
    <table border="1">
        <tr>
            <th>MLS Number</th>
            <th>Address</th>
            <th>Owner Name</th>
            <th>Price</th>
            <th>Type</th>
            <th>Size</th>
        </tr>

        <?php
        if ($result_business->num_rows > 0) {
            // Output data for each business property listing
            while($row = $result_business->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["mlsNumber"] . "</td>
                        <td>" . $row["listing_address"] . "</td>
                        <td>" . $row["ownerName"] . "</td>
                        <td>" . $row["price"] . "</td>
                        <td>" . $row["type"] . "</td>
                        <td>" . $row["size"] . " sq ft</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No business property listings available.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
