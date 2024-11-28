<?php
include '../index.php';

$main_tables = ['persoane','tari','orase','continente'];

$sql_orase = "SELECT ID_Oras, Nume_Oras FROM orase";
$result_orase = $conn->query($sql_orase);
$orase = [];
if ($result_orase->num_rows > 0) {
    while ($row = $result_orase->fetch_assoc()) {
        $orase[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_table'])) {
    $table_name = $conn->real_escape_string($_POST['table_name']);

    $sql_select = "SELECT * FROM $table_name";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        echo "<h2>Stergeti o intrare din tabelul $table_name</h2>";
        echo "<form action='delete.php' method='post'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<label for='row_number'>ID-ul inregistrarii:</label>";
        echo "<input type='number' name='row_number' id='row_number' required min='1'><br>";
        echo "<button type='submit' name='delete_entry'>Sterge</button>";
        echo "</form>";
    } else {
        echo "Nu exista inregistrari in tabelul $table_name.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_entry'])) {
    $table_name = $conn->real_escape_string($_POST['table_name']);
    $row_number = (int) $_POST['row_number'];

    switch ($table_name) {
        case 'persoane':
            $primary_key = 'ID_Persoana';
            break;
        case 'tari':
            $primary_key = 'ID_Tara';
            break;
        case 'orase':
            $primary_key = 'ID_Oras';
            break;
        case 'continente':
            $primary_key = 'ID_Continent';
            break;
        default:
            $primary_key = ''; 
    }

    if (empty($primary_key)) {
        echo "Tabel nevalid selectat pentru stergere.";
        exit;
    }

    if ($table_name == 'persoane') {

        $sql_delete_elev = "DELETE FROM elev_student WHERE ID_Persoana = $row_number";
        $success_elev = $conn->query($sql_delete_elev);

        $sql_delete_angajat = "DELETE FROM angajat_neangajat WHERE ID_Persoana = $row_number";
        $success_angajat = $conn->query($sql_delete_angajat);

        if ($success_elev && $success_angajat) {
            $sql_delete = "DELETE FROM $table_name WHERE $primary_key = $row_number";
            $success = $conn->query($sql_delete);

            if ($success) {
                echo "Datele au fost sterse.";
            } else {
                echo "Eroare la stergerea intrarii din tabelul $table_name: " . $conn->error;
            }
        } else {
            echo "Eroare la stergerea datelor din tabelele de legatura: " . $conn->error;
        }
    } else {

        $sql_delete = "DELETE FROM $table_name WHERE $primary_key = $row_number";
        $success = $conn->query($sql_delete);

        if ($success) {
            echo "Datele au fost sterse.";
        } else {
            echo "Eroare la stergerea intrarii din tabelul $table_name: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Rye&display=swap" rel="stylesheet" class="Gstyle">
<link rel="stylesheet" href="style2.css">
    <title>Stergeti o intrare</title>
</head>
<body>
    <h2>Selectati tabelul din care doriti sa stergeti o intrare</h2>
    <form action="delete.php" method="post">
        <label for="table_name">Numele tabelului:</label>
        <select name="table_name" id="table_name" required>
            <option value="">Selectati un tabel</option>
            <?php
            foreach ($main_tables as $table) {
                echo "<option value='$table'>$table</option>";
            }
            ?>
        </select>
        <button type="submit" name="select_table">Selecteaza</button>
    </form>
</body>
</html>