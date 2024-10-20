<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriks</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FFF0F5;
            color: #333;
            text-align: center;
            padding: 20px;
        }

        h1, h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .matrix-form, .button-container {
            background-color: #FFC0CB;
            padding: 20px;
            border-radius: 10px;
            width: 70%;
            margin: 20px auto;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .matrix-form table, .result-table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 80%;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .matrix-form th, .matrix-form td, .result-table th, .result-table td {
            border: 1px solid #FF69B4;
            padding: 15px;
            text-align: center;
            font-size: 16px;
        }

        .matrix-form th, .result-table th {
            background-color: #FF69B4;
            color: #fff;
        }

        .matrix-form input[type="number"] {
            width: 60px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            text-align: center;
        }

        .matrix-form input[type="submit"], button {
            background-color: #FF69B4;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px;
            transition: background-color 0.3s;
        }

        .matrix-form input[type="submit"]:hover, button:hover {
            background-color: #2980b9;
        }

        .button-container {
            margin-top: 20px;
        }

        .result-container {
            margin-top: 40px;
        }
    </style>
</head>
<body>

<h1>PERKALIAN MATRIKS 4 x 3 DAN 3 x 2</h1><br>

<form method="post" class="matrix-form">
    <h3>Matriks 4 x 3</h3>
    <table>
        <tr>
            <th>Kolom 1</th>
            <th>Kolom 2</th>
            <th>Kolom 3</th>
        </tr>
        <?php
        // Input untuk Matriks 4x3
        for ($i = 0; $i < 4; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 3; $j++) {
                $value = isset($_POST["matrix1_$i$j"]) ? $_POST["matrix1_$i$j"] : 0;
                echo "<td><input type='number' name='matrix1_$i$j' value='$value'></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h3>Matriks 3x2</h3>
    <table>
        <tr>
            <th>Kolom 1</th>
            <th>Kolom 2</th>
        </tr>
        <?php
        // Input untuk Matriks 3x2
        for ($i = 0; $i < 3; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 2; $j++) {
                $value = isset($_POST["matrix2_$i$j"]) ? $_POST["matrix2_$i$j"] : 0;
                echo "<td><input type='number' name='matrix2_$i$j' value='$value'></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <div class="button-container">
        <input type="submit" name="show_result" value="Tampilkan Hasil Perkalian">
        <button type="submit" name="hide_result">Hapus</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['show_result'])) {
    // Ambil input dari Matriks 1
    $matrix1 = [];
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 3; $j++) {
            $matrix1[$i][$j] = isset($_POST["matrix1_$i$j"]) ? (int)$_POST["matrix1_$i$j"] : 0;
        }
    }

    // Ambil input dari Matriks 2
    $matrix2 = [];
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 2; $j++) {
            $matrix2[$i][$j] = isset($_POST["matrix2_$i$j"]) ? (int)$_POST["matrix2_$i$j"] : 0;
        }
    }

    // Inisialisasi matriks hasil (4x2)
    $hasil = [];

    // Perkalian matriks
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 2; $j++) {
            $hasil[$i][$j] = 0;
            for ($k = 0; $k < 3; $k++) {
                $hasil[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
            }
        }
    }

    // Tampilkan Matriks Hasil
    echo "<div class='result-container'><h3>Hasil Perkalian Matriks (4x2):</h3>";
    echo "<table class='result-table'>";
    echo "<tr><th>Kolom 1</th><th>Kolom 2</th></tr>";
    foreach ($hasil as $row) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }
    echo "</table></div>";
}

// Jika tombol 'Hapus' diklik
if (isset($_POST['hide_result'])) {
    echo "<h3>Hasil perkalian dihapus</h3>";
}
?>

</body>
</html>