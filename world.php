<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country']) && !empty($_GET['country'])) {
    $country = $_GET['country'];
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->bindValue(':country', "%$country%", PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>" . htmlspecialchars($row['name']) . " is ruled by " . htmlspecialchars($row['head_of_state']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No results found for the country: " . htmlspecialchars($country);
    }
} else {
    $stmt = $conn->prepare("SELECT * FROM countries");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>" . htmlspecialchars($row['name']) . " is ruled by " . htmlspecialchars($row['head_of_state']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No countries found.";
    }
}
?>
