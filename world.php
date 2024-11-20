<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country']) && !empty($_GET['country'])) {
    $country = $_GET['country'];

    if (isset($_GET['lookup']) && $_GET['lookup'] == 'cities') {
        $stmt = $conn->prepare("SELECT c.name AS city_name, c.district, c.population
                                FROM cities c
                                JOIN countries co ON c.country_code = co.code
                                WHERE co.name LIKE :country");
        $stmt->bindValue(':country', "%$country%", PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            echo "<table>";
            echo "<tr><th>City Name</th><th>District</th><th>Population</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['city_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['district']) . "</td>";
                echo "<td>" . htmlspecialchars($row['population']) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No cities found for the country: " . htmlspecialchars($country);
        }
    } else {
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
    }
} else {
    echo "Please provide a country name.";
}
?>


