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

// Query to retrieve agent data
$sql = "SELECT agentId, name, phone, firmId, dateStarted FROM Agent";
$result = $conn->query($sql);

// HTML to display results
echo "<h1>Agent Information</h1>";
echo "<table border='1'>
        <tr>
            <th>Agent ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Firm ID</th>
            <th>Date Started</th>
        </tr>";

if ($result->num_rows > 0) {
    // Output data for each agent
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["agentId"]. "</td>
                <td>" . $row["name"]. "</td>
                <td>" . $row["phone"]. "</td>
                <td>" . $row["firmId"]. "</td>
                <td>" . $row["dateStarted"]. "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No agent data available.</td></tr>";
}

echo "</table>";

// Close connection
$conn->close();
?>
