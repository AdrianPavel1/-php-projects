<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ape</title>
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

$sql = "SELECT * FROM oceane_mari_ape";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    echo "<h2>Tabelul Oceane Mari Ape</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nume</th><th>Adancime Maxima</th><th>Suprafata</th><th>ID Tara</th><th>Clima</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>" . $row["ID"] . "</td>
        <td>" . $row["Nume"] . "</td>
        <td>" . $row["Adancime_Maxima"] . "</td>
        <td>" . $row["Suprafata"] . "</td>
        <td>" . $row["Id_Tara"] . "</td>
        <td>" . $row["Clima"] . "</td>
         </tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
} else {
    echo "Nu s-au gasit inregistrari in tabelul Oceane Mari Ape.";
}

mysqli_close($conn);
?>