<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studii</title>
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

$sql = "SELECT * FROM elev_student";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {

    echo "<h2>Tabelul Elev Student</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Persoana</th><th>Universitate</th><th>Program Studii</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["ID_Persoana"] . "</td>
                <td>" . $row["Universitate"] . "</td>
                <td>" . $row["Program_Studii"] . "</td>
              </tr>";
    }
    echo "</table>";

    mysqli_free_result($result);
} else {
    echo "Nu s-au gasit inregistrari in tabelul Elev Student.";
}

mysqli_close($conn);
?>