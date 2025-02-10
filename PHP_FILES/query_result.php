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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the custom query from the form input
    $query = $_POST['query'];

    // Try executing the query
    if (!empty($query)) {
        $result = $conn->query($query);

        if ($result === FALSE) {
            echo "Error: " . $conn->error;
        } else {
            echo "<h1>Query Results</h1>";

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>";
                // Print the table headers
                $fields = $result->fetch_fields();
                foreach ($fields as $field) {
                    echo "<th>" . $field->name . "</th>";
                }
                echo "</tr>";

                // Output data for each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $column) {
                        echo "<td>" . $column . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No results found.";
            }
        }
    } else {
        echo "Please enter a valid SQL query.";
    }
}

// Close connection
$conn->close();
?>
