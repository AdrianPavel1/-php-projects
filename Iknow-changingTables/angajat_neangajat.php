<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>   
</body>
</html>

<?php
include 'index.php';

if (!$conn) {
    die("Eroare de conexiune: " . mysqli_connect_error());
}

$sql = "SELECT * FROM angajat_neangajat";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    echo "<h2>Tabelul Angajat Neangajat</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Persoana</th><th>Statut</th><th>Companie</th><th>Pozitie</th><th>Salariu</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["ID_Persoana"] . "</td>
                <td>" . $row["Statut"] . "</td>
                <td>" . $row["Companie"] . "</td>
                <td>" . $row["Pozitie"] . "</td>
                <td>" . $row["Salariu"] . "</td>
              </tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
} else {
    echo "Nu s-au gasit inregistrari in tabelul Angajat Neangajat.";
}

mysqli_close($conn);
?>