<?php
// Connect to MySQL via Kubernetes Service
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');
// Check if all required environment variables are set
if (!$db_host || !$db_user || !$db_pass || !$db_name) {
    die('<h2 style="color: red;">ERROR: Missing required environment variables (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)</h2>');
}
    
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die('<h2 style="color: red;">Error connecting to MySQL</h2>' . 
        '<p>Error: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . '</p>');
}

echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>LAMP App on Kubernetes</title>';
echo '</head>';
echo '<body>';

echo '<h1>LAMP Application on Kubernetes</h1>';
echo '<h2 style="color: green;">Successfully connected to MySQL!</h2>';

// Check if table exists
$result = $mysqli->query("SHOW TABLES LIKE 'Movie'");
if ($result->num_rows == 0) {
    echo '<p style="color: orange;">Warning: Table "Movie" does not exist yet.</p>';
    echo '<p>Please wait for MySQL initialization to complete.</p>';
} else {
    // Get the count of records
    $result = $mysqli->query("SELECT COUNT(*) AS count FROM Movie");
    if ($result) {
        $row = $result->fetch_assoc();
        echo '<p>Table <strong>Movie</strong> contains: <strong>' . $row['count'] . '</strong> rows</p>';
        
        // Show all records
        $result = $mysqli->query("SELECT mID, title, year, director FROM Movie LIMIT 10");
        if ($result->num_rows > 0) {
            echo '<h3>Movies:</h3>';
            echo '<table border="1" cellpadding="5" cellspacing="0">';
            echo '<tr><th>ID</th><th>Title</th><th>Year</th><th>Director</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['mID']) . '</td>';
                echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                echo '<td>' . htmlspecialchars($row['year']) . '</td>';
                echo '<td>' . htmlspecialchars($row['director']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }
}

// Information about the pod
echo '<hr>';
echo '<p><small>Pod hostname: ' . gethostname() . '</small></p>';
echo '<p><small>PHP version: ' . phpversion() . '</small></p>';

echo '</body>';
echo '</html>';

$mysqli->close();
?>