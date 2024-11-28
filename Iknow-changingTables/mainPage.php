<?php
include 'index.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>iKnow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400..900;1,6..96,400..900&family=Rye&display=swap" rel="stylesheet" class="Gstyle">

    <link rel="stylesheet"  href="style.css">
</head>
<body>
    <header class="header">
    <div class="logo-container"> <img src="photos/Logo.png" alt="Logo" width ="180"  height="110">      
    </div>
    <h1 class="title">iKnow</h1>
    <button id="toggle-tables">Tables</button>
</header>
<hr>
    
    <!-- container afisare laterala-->
    <div class="button-container-container">
        <div class="button-container">
            <form action="buletin.php" method="get">
                <button type="submit">Tabela Buletin</button>
            </form>
            <form action="angajat_neangajat.php" method="get">
                <button type="submit">Tabela Angajat_Neangajat</button>
            </form>
            <form action="continente.php" method="get">
                <button type="submit">Tabela Continente</button>
            </form>
            <form action="elev_student.php" method="get">
                <button type="submit">Tabela Elev_Student</button>
            </form>
            <form action="oceane_mari_ape.php" method="get">
                <button type="submit">Tabela Oceane_Mari_Ape</button>
            </form>
            <form action="orase.php" method="get">
                <button type="submit">Tabela Orase</button>
            </form>
            <form action="persoane.php" method="get">
                <button type="submit">Tabela Persoane</button>
            </form>
            <form action="tari.php" method="get">
                <button type="submit">Tabela Tari</button>
            </form>
        </div>
    </div>
<h2>Did you know?</h2>

<div class="button-container didYou_know">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="reuniune">Unde lucreaza?</button>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="diferenta">Cine nu are job?</button>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="selectie">Tari Climat Temperat</button>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="proiectie">Dimensiunea si climatul</button>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="jonctiune1">Tari si Ape</button>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
        <button type="submit" name="jonctiune2">Persoane si Orase</button>
    </form>
</div>

<div class="modify-container">
    <h3>Modify Them</h3>
    <form action="modify/add.php" method="get">
        <button type="submit">Add</button>
    </form>
    <form action="modify/delete.php" method="get">
        <button type="submit">Delete</button>
    </form>
    <form action="modify/search.php" method="get">
        <button type="submit">Search</button>
    </form>
    <form action="modify/modify.php" method="get">
        <button type="submit">Modify</button>
    </form>
</div>
<?php


if (isset($_GET['reuniune'])) {
    echo "<h3>Reuniune</h3>";
    echo "<table border='1'><tr><th>Nume</th><th>Data Nasterii</th><th>Statut</th><th>Organizatie</th><th>Detalii</th></tr>";
    
    //Operatie de reuniune (UNION)
    $sql_reuniune = "
        SELECT p.Nume, p.Data_Nastere, 'Angajat' AS Statut, a.Companie AS Organizatie, a.Pozitie AS Detalii
        FROM persoane p
        INNER JOIN angajat_neangajat a ON p.ID_Persoana = a.ID_Persoana
        
        UNION
        
        SELECT p.Nume, p.Data_Nastere, 'Student' AS Statut, e.Universitate AS Organizatie, e.Program_Studii AS Detalii
        FROM persoane p
        INNER JOIN elev_student e ON p.ID_Persoana = e.ID_Persoana
    ";
    
    $result_reuniune = $conn->query($sql_reuniune);
    
    if ($result_reuniune === false) {
        echo "Eroare la efectuarea interogarii: " . $conn->error;
    } else {
        if ($result_reuniune->num_rows > 0) {
            while ($row = $result_reuniune->fetch_assoc()) {
                echo "<tr><td>" . $row["Nume"] . "</td><td>" . $row["Data_Nastere"] . "</td><td>" . $row["Statut"] . "</td><td>" . $row["Organizatie"] . "</td><td>" . $row["Detalii"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nu exista rezultate pentru reuniune</td></tr>";
        }
    }
    echo "</table>";

} elseif (isset($_GET['diferenta'])) {
    echo "<h3>Diferenta</h3>";
    echo "<table border='1'><tr><th>ID Persoana</th><th>Nume</th><th>Data Nasterii</th></tr>";
 

    //Operatie de diferenta
    $sql_diferenta = "SELECT * FROM persoane WHERE ID_Persoana NOT IN (SELECT ID_Persoana FROM angajat_neangajat)";
    $result_diferenta = $conn->query($sql_diferenta);

    if ($result_diferenta === false) {
        echo "Eroare la efectuarea interogarii: " . $conn->error;
    } else {
        if ($result_diferenta->num_rows > 0) {
            while ($row = $result_diferenta->fetch_assoc()) {
                echo "<tr><td>" . $row["ID_Persoana"] . "</td><td>" . $row["Nume"] . "</td><td>" . $row["Data_Nastere"] . "</td></tr>";
            }
        } 
    }
    echo"</table>";
} elseif (isset($_GET['selectie'])) {
    echo"<h3>Selectie</h3>";
    echo "<table><tr><th>ID Tara</th><th>Nume Tara</th><th>Dimensiune</th><th>Climat</th></tr>";

    //operatie de selectie
    $sql_selectie = "SELECT * FROM tari WHERE Climat = 'Temperat'";
    $result_selectie = $conn->query($sql_selectie);

    if ($result_selectie === false) {
        echo "Eroare la efectuarea interogarii: " . $conn->error;
    } else {
        if ($result_selectie->num_rows > 0) {
            while ($row = $result_selectie->fetch_assoc()) {
                echo "<tr><td>" . $row["ID_Tara"] . "</td><td>" . $row["Nume_Tara"] . "</td><td>" . $row["Dimensiune"] . "</td><td>" . $row["Climat"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nu exista rezultate pentru selectie</td></tr>";
        }
    }
    echo "</table>";
} elseif (isset($_GET['proiectie'])) {
    echo "<h3>Proiectie</h3>";
    echo "<table><tr><th>Nume Tara</th><th>Dimensiune</th><th>Climat</th></tr>";

    // Operatie de proiectie(afisare doar anumite coloane)
    $sql_proiectie = "SELECT Nume_Tara, Dimensiune, Climat FROM tari";
    $result_proiectie = $conn->query($sql_proiectie);

    if ($result_proiectie === false) {
        echo "Eroare la efectuarea interogarii: " . $conn->error;
    } else {
        if ($result_proiectie->num_rows > 0) {
            while ($row = $result_proiectie->fetch_assoc()) {
                echo "<tr><td>" . $row["Nume_Tara"] . "</td><td>" . $row["Dimensiune"] . "</td><td>" . $row["Climat"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nu exista rezultate pentru proiectie</td></tr>";
        }
    }
    echo "</table>";
} elseif (isset($_GET['jonctiune1'])) {
    echo "<h3>Jonctiune 1</h3>";
    echo "<table><tr><th>Nume Tara</th><th>Nume Ocean</th></tr>";

    //Operatia de jonctiune 1(Left JOin unde on este conditia de jonctiune)
    $sql_jonctiune1 = "SELECT t.Nume_Tara, o.Nume 
                   FROM tari t 
                   LEFT JOIN oceane_mari_ape o 
                   ON t.ID_Tara = o.Id_Tara";
$result_jonctiune1 = $conn->query($sql_jonctiune1);

if ($result_jonctiune1 === false) {
    echo "Eroare la efectuarea interogarii: " . $conn->error;
} else {
    if ($result_jonctiune1->num_rows > 0) {
        while ($row = $result_jonctiune1->fetch_assoc()) {
            echo "<tr><td>" . $row["Nume_Tara"] . "</td><td>" . ($row["Nume"] ? $row["Nume"] : "Fara acces la ape") . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>Nu exista rezultate pentru jonctiune 1</td></tr>";
    }
}
echo "</table>";
} elseif (isset($_GET['jonctiune2'])) {
    echo "<h3>Jonctiune 2</h3>";
    echo "<table><tr><th>Nume Persoana</th><th>Nume Oras</th></tr>";

    // Operatie de jonctiune 2(Inner Join)
    //INNER JOIN returneaza numai randurile care au o corespondenta in ambele tabele
    $sql_jonctiune2 = "SELECT p.Nume, o.Nume_Oras FROM persoane p INNER JOIN orase o ON p.OrasActual = o.ID_Oras";
    $result_jonctiune2 = $conn->query($sql_jonctiune2);
//ON p.OrasActual = o.ID_Oras:Aceasta conditie specifica conditia de jonctiune, care indica cum se fac legaturile intre tabelul principal si tabelul secundar.
    if ($result_jonctiune2 === false) {
        echo "Eroare la efectuarea interogarii: " . $conn->error;
    } else {
        if ($result_jonctiune2->num_rows > 0) {
            while ($row = $result_jonctiune2->fetch_assoc()) {
                echo "<tr><td>" . $row["Nume"] . "</td><td>" . $row["Nume_Oras"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Nu exista rezultate pentru jonctiune 2</td></tr>";
        }
    }
    echo "</table>";
}
?>
<script src="script.js"></script>
</body>
</html>