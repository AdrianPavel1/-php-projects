<?php
include '../index.php';

$main_tables = ['persoane', 'tari', 'orase', 'continente'];

$sql_orase = "SELECT ID_Oras, Nume_Oras FROM orase";
$result_orase = $conn->query($sql_orase);
$orase = [];
if ($result_orase->num_rows > 0) {
    while ($row = $result_orase->fetch_assoc()) {
        $orase[] = $row;
    }
}

$sql_tari = "SELECT ID_Tara, Nume_Tara FROM tari";
$result_tari = $conn->query($sql_tari);
$tari = [];
if ($result_tari->num_rows > 0) {
    while ($row = $result_tari->fetch_assoc()) {
        $tari[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_table'])) {
    $table_name = $conn->real_escape_string($_POST['table_name']);

    $sql_columns = "SHOW COLUMNS FROM $table_name";
    $result_columns = $conn->query($sql_columns);

    if ($result_columns === false) {
        echo "Nu s-au putut obtine coloanele tabelului: " . $conn->error;
    } else {
        echo "<h2>Adauga date in tabelul $table_name</h2>";
        echo "<form action='add.php' method='post'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";

        while ($row = $result_columns->fetch_assoc()) {
            if ($row['Field'] != 'ID_Persoana' && $row['Field'] != 'ID_Continent' && $row['Field'] != 'ID_Oras' && $row['Field'] != 'ID_Tara') {
                echo "<label for='" . $row['Field'] . "'>" . $row['Field'] . ":</label>";

                if ($row['Field'] == 'OrasActual') {

                    echo "<select name='" . $row['Field'] . "' id='" . $row['Field'] . "'>";
                    foreach ($orase as $oras) {
                        echo "<option value='" . $oras['ID_Oras'] . "'>" . $oras['Nume_Oras'] . "</option>";
                    }
                    echo "</select><br>";
                } else {
                    echo "<input type='text' name='" . $row['Field'] . "' id='" . $row['Field'] . "'><br>";
                }
            } elseif ($table_name == 'orase' && $row['Field'] == 'ID_Tara') {

                echo "<label for='ID_Tara'>Tara:</label>";
                echo "<select name='ID_Tara' id='ID_Tara'>";
                foreach ($tari as $tara) {
                    echo "<option value='" . $tara['ID_Tara'] . "'>" . $tara['Nume_Tara'] . "</option>";
                }
                echo "</select><br>";
            }
        }

 if ($table_name == 'persoane') {
     echo "<h3>Informatii Elev/Student</h3>";
     echo "<label for='Universitate'>Universitate:</label>";
     echo "<input type='text' name='Universitate' id='Universitate'><br>";
     echo "<label for='Program_Studii'>Program de Studii:</label>";
     echo "<input type='text' name='Program_Studii' id='Program_Studii'><br>";

    echo "<h3>Informatii Angajat/Neangajat</h3>";
     echo "<label for='Statut'>Statut:</label>";
    echo "<select name='Statut' id='Statut'>
            <option value=''>Selectati</option>
            <option value='Angajat'>Angajat</option>
            <option value='Neangajat'>Neangajat</option>
            </select><br>";
    echo "<label for='Companie'>Companie:</label>";
    echo "<input type='text' name='Companie' id='Companie'><br>";
    echo "<label for='Pozitie'>Pozitie:</label>";
    echo "<input type='text' name='Pozitie' id='Pozitie'><br>";
    echo "<label for='Salariu'>Salariu:</label>";
    echo "<input type='text' name='Salariu' id='Salariu'><br>";
        }

        echo "<button type='submit' name='add_data'>Adauga</button>";
        echo "</form>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_data'])) {
    $table_name = $conn->real_escape_string($_POST['table_name']);

    $columns = array();
    $values = array();
    foreach ($_POST as $key => $value) {
        if ($key != 'table_name' && $key != 'add_data' && $key != 'Universitate' && $key != 'Program_Studii' && $key != 'Statut' && $key != 'Companie' && $key != 'Pozitie' && $key != 'Salariu') {
            $columns[] = $key;
            $values[] = "'" . $conn->real_escape_string($value) . "'";
        }
    }

    $sql_insert = "INSERT INTO $table_name (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";

    if ($conn->query($sql_insert) === true) {
        echo "Datele au fost adaugate in tabelul $table_name.";

        if ($table_name == 'persoane') {
            $last_id = $conn->insert_id;

            if (!empty($_POST['Universitate']) || !empty($_POST['Program_Studii'])) {
                $sql_insert_elev = "INSERT INTO elev_student (ID_Persoana, Universitate, Program_Studii) VALUES ($last_id, '" . $conn->real_escape_string($_POST['Universitate']) . "', '" . $conn->real_escape_string($_POST['Program_Studii']) . "')";
                if ($conn->query($sql_insert_elev) === true) {
                    echo "Datele au fost adaugate in tabelul elev_student.";
                } else {
                    echo "Eroare la adaugarea datelor in tabelul elev_student: " . $conn->error;
                }
            }

            if (!empty($_POST['Statut']) && isset($_POST['Companie']) && isset($_POST['Pozitie']) && isset($_POST['Salariu'])) {
                $sql_insert_angajat = "INSERT INTO angajat_neangajat (ID_Persoana, Statut, Companie, Pozitie, Salariu) VALUES ($last_id, '" . $conn->real_escape_string($_POST['Statut']) . "', '" . $conn->real_escape_string($_POST['Companie']) . "', '" . $conn->real_escape_string($_POST['Pozitie']) . "', '" . $conn->real_escape_string($_POST['Salariu']) . "')";
                if ($conn->query($sql_insert_angajat) === true) {
                    echo "Datele au fost adaugate in tabelul angajat_neangajat.";
                } else {
                    echo "Eroare la adaugarea datelor in tabelul angajat_neangajat: " . $conn->error;
                }
            }
        }
    } else {
        echo "Eroare la adaugarea datelor: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adauga date</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Rye&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h2>Selectati tabelul in care doriti sa adaugati date</h2>
    <form action="add.php" method="post">
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