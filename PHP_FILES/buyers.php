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

// Query to retrieve buyer data
$sql = "SELECT id, name, phone, propertyType, bedrooms, bathrooms, businessPropertyType, minimumPreferredPrice, maximumPreferredPrice FROM Buyer";
$result = $conn->query($sql);

// HTML to display results
echo "<h1>Buyer Information</h1>";
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Property Type</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Business Property Type</th>
            <th>Min Preferred Price</th>
            <th>Max Preferred Price</th>
        </tr>";

if ($result->num_rows > 0) {
    // Output data for each buyer
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["name"]. "</td>
                <td>" . $row["phone"]. "</td>
                <td>" . $row["propertyType"]. "</td>
                <td>" . $row["bedrooms"]. "</td>
                <td>" . $row["bathrooms"]. "</td>
                <td>" . $row["businessPropertyType"]. "</td>
                <td>" . $row["minimumPreferredPrice"]. "</td>
                <td>" . $row["maximumPreferredPrice"]. "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No buyer data available.</td></tr>";
}

echo "</table>";

// Close connection
$conn->close();
?>
