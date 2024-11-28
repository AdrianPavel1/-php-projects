<?php

include '../index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search_type = $_POST['search_type'];
    $search_key = $conn->real_escape_string($_POST['search_key']);
    $search_key = strtolower($search_key); 

    $sql_query = "";
    $title = "";

    switch ($search_type) {
        case 'info tari':
            $title = "Informatii despre tari pentru: " . htmlspecialchars($search_key);

            $sql_query = "SELECT Nume_Tara, Dimensiune, Climat, Temperatura_Medie, Populatie_Totala, ape 
                          FROM tari 
                          WHERE LOWER(Nume_Tara) LIKE '%$search_key%'
                          LIMIT 1";
            break;
        case 'info orase':
            $title = "Informatii despre orase pentru: " . htmlspecialchars($search_key);

            $sql_query = "SELECT Nume_Oras, Populatie, Suprafata, Atractii_Turistice 
                          FROM orase 
                          WHERE LOWER(Nume_Oras) LIKE '%$search_key%'
                          LIMIT 1";
            break;
        case 'info persoane':
            $title = "Informatii despre persoane pentru: " . htmlspecialchars($search_key);

            $sql_query = "SELECT Nume, Data_Nastere, OrasActual 
                          FROM persoane 
                          WHERE LOWER(Nume) LIKE '%$search_key%'
                          LIMIT 1";
            break;
        case 'info ape':
            $title = "Informatii despre ape pentru: " . htmlspecialchars($search_key);

            $sql_query = "SELECT Nume, Adancime_Maxima, Suprafata, Clima 
                          FROM oceane_mari_ape 
                          WHERE LOWER(Nume) LIKE '%$search_key%'
                          LIMIT 1";
            break;
        default:
            echo "Tip de cautare necunoscut.";
            exit;
    }

    $result = $conn->query($sql_query);

    if ($result === false) {
        echo "Eroare la executarea cautarii: " . $conn->error;
    } else {
        echo "<h2>$title</h2>";

        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr>";

            while ($column = $result->fetch_field()) {
                echo "<th>" . htmlspecialchars($column->name) . "</th>";
            }
            echo "</tr>";

            if ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nu au fost gasite rezultate pentru cautarea dvs.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cauta informatii</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Rye&display=swap" rel="stylesheet" class="Gstyle">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h2>Cautati informatii</h2>
    <form action="search.php" method="post">
        <label for="search_type">Selectati tipul de informatie:</label>
        <select name="search_type" id="search_type" required>
            <option value="">Selectati...</option>
            <option value="info tari">Informatii despre tari</option>
            <option value="info orase">Informatii despre orase</option>
            <option value="info persoane">Informatii despre persoane</option>
            <option value="info ape">Informatii despre ape</option>
        </select><br><br>

        <label for="search_key">Introduceti cheia de cautare:</label>
        <input type="text" name="search_key" id="search_key" required><br><br>

        <button type="submit" name="search">Cauta</button>
    </form>
</body>
</html>