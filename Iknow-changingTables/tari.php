<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tari</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>   
</body>
</html>
<?php
include 'index.php';

if (!$conn) {
    die("Eroare de conexiune:". mysqli_connect_error());
}

$sql = "SELECT * FROM tari";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    echo "<h2>Tabelul Tari</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Tara</th><th>Nume Tara</th><th>ID Continent</th><th>Dimensiune</th><th>Climat</th><th>Temperatura Medie</th><th>Populatie Totala</th><th>Ape</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["ID_Tara"] . "</td>
                <td>" . $row["Nume_Tara"] . "</td>
                <td>" . $row["ID_Continent"] . "</td>
                <td>" . $row["Dimensiune"] . "</td>
                <td>" . $row["Climat"] . "</td>
                <td>" . $row["Temperatura_Medie"] . "</td>
                <td>" . $row["Populatie_Totala"] . "</td>
                <td>" . $row["ape"] . "</td>
              </tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
} else {
    echo "Nu s-au gasit inregistrari in tabelul Tari.";
}

mysqli_close($conn);
?>