<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orase</title>
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

$sql = "SELECT * FROM orase";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    echo "<h2>Tabelul Orase</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Oras</th><th>Nume Oras</th><th>ID Tara</th><th>Populatie</th><th>Suprafata</th><th>Atractii Turistice</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
     <td>" . $row["ID_Oras"] . "</td>
     <td>" . $row["Nume_Oras"] . "</td>
     <td>" . $row["ID_Tara"] . "</td>
    <td>" . $row["Populatie"] . "</td>
     <td>" . $row["Suprafata"] . "</td>
    <td>" . $row["Atractii_Turistice"] . "</td>
     </tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
} else {
    echo "Nu s-au gasit inregistrari in tabelul Orase.";
}

mysqli_close($conn);
?>