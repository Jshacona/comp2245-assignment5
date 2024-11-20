<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country']) && !empty($_GET['country'])) {
    $country = $_GET['country'];
    $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
    $stmt->bindValue(':country', "%$country%", PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Country Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
            echo "<td>" . (isset($row['independence_year']) ? htmlspecialchars($row['independence_year']) : 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No results found for the country: " . htmlspecialchars($country);
    }
} else {
    $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Country Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
        echo "</tr>";
        echo "</thead>";

        echo "<tbody>";
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
            echo "<td>" . (isset($row['independence_year']) ? htmlspecialchars($row['independence_year']) : 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['head_of_state']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No countries found.";
    }
}
?>

