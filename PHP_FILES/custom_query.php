<?php
// Display the form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Query</title>
</head>
<body>
    <h1>Enter a Custom Query</h1>
    <form method="POST" action="query_result.php">
        <label for="query">SQL Query:</label><br>
        <textarea name="query" id="query" rows="4" cols="50" placeholder="Enter your SQL query here"></textarea><br><br>
        <input type="submit" value="Execute Query">
    </form>
</body>
</html>