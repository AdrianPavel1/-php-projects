<?php

include '../index.php';

$main_tables = ['persoane', 'tari', 'orase', 'continente', 'oceane_mari_ape', 'buletin', 'elev_student', 'angajat_neangajat'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_table'])) {
    $table_name = $_POST['table_name'];

    $sql_rows = "SELECT * FROM $table_name";
    $result_rows = $conn->query($sql_rows);

    if ($result_rows === false) {
        echo "Eroare la obtinerea randurilor din tabelul $table_name: " . $conn->error;
    } else {
        echo "<h2>Selectati randul pe care doriti sa-l modificati in tabelul $table_name</h2>";
        echo "<form action='modify.php' method='post'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<label for='row_id'>Selectati ID-ul randului:</label>";
        echo "<select name='row_id' id='row_id' required>";
        while ($row = $result_rows->fetch_assoc()) {

            echo "<option value='" . $row[array_keys($row)[0]] . "'>" . $row[array_keys($row)[0]] . "</option>";
        }
        echo "</select>";
        echo "<button type='submit' name='select_row'>Selecteaza</button>";
        echo "</form>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['select_row'])) {
    $table_name = $_POST['table_name'];
    $row_id = $_POST['row_id'];

    $primary_key_column = getPrimaryKeyColumn($table_name);
    $sql_row = "SELECT * FROM $table_name WHERE $primary_key_column = $row_id";
    $result_row = $conn->query($sql_row);

    if ($result_row === false || $result_row->num_rows == 0) {
        echo "Eroare la obtinerea randului selectat: " . $conn->error;
    } else {
        $row_data = $result_row->fetch_assoc();
        echo "<h2>Modificati datele din tabelul $table_name pentru ID-ul $row_id</h2>";
        echo "<form action='modify.php' method='post'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        echo "<input type='hidden' name='row_id' value='$row_id'>";

        foreach ($row_data as $column_name => $value) {

            if ($column_name == $primary_key_column) continue;

            echo "<label for='$column_name'>$column_name:</label>";
            echo "<input type='text' name='$column_name' id='$column_name' value='$value'><br>";
        }

        echo "<button type='submit' name='update_row'>Actualizeaza</button>";
        echo "</form>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_row'])) {
    $table_name = $_POST['table_name'];
    $row_id = $_POST['row_id'];

    $primary_key_column = getPrimaryKeyColumn($table_name);
    $updates = array();
    foreach ($_POST as $key => $value) {
        if ($key != 'table_name' && $key != 'row_id' && $key != 'update_row') {
            $updates[] = "$key = '" . $conn->real_escape_string($value) . "'";
        }
    }

    $sql_update = "UPDATE $table_name SET " . implode(", ", $updates) . " WHERE $primary_key_column = $row_id";

    if ($conn->query($sql_update) === true) {
        echo "Randul cu ID-ul $row_id a fost actualizat cu succes in tabelul $table_name.";
    } else {
        echo "Eroare la actualizarea randului: " . $conn->error;
    }
}

function getPrimaryKeyColumn($table_name) {
    global $conn;
    $sql = "SHOW KEYS FROM $table_name WHERE Key_name = 'PRIMARY'";
    $result = $conn->query($sql);
    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Column_name'];
    }
    return null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifica date</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Rye&display=swap" rel="stylesheet" class="Gstyle">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h2>Selectati tabelul pe care doriti sa-l modificati</h2>
    <form action="modify.php" method="post">
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