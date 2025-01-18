<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_alumni";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posisi = $conn->real_escape_string($_POST['posisi']);
    $perusahaan = $conn->real_escape_string($_POST['perusahaan']);
    $lokasi = $conn->real_escape_string($_POST['lokasi']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);

    $sql = "INSERT INTO bursa_kerja (posisi, perusahaan, lokasi, deskripsi) VALUES ('$posisi', '$perusahaan', '$lokasi', '$deskripsi')";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='alert alert-success'>Lowongan berhasil ditambahkan.</p>";
    } else {
        echo "<p class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$data_bursa_kerja = $conn->query("SELECT * FROM bursa_kerja ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bursa Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        h1 {
            margin: 20px 0;
        }
        form {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        form label {
            font-weight: bold;
        }
        form input, form textarea, form button {
            margin-bottom: 15px;
        }
        .lowongan-item {
            background: #ffffff;
            margin: 10px 0;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .lowongan-item h3 {
            color: #333;
        }
        .lowongan-item p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Bursa Kerja</h1>
    <form method="POST" class="mb-4">
        <label>Posisi:</label>
        <input type="text" name="posisi" class="form-control" required>
        <label>Perusahaan:</label>
        <input type="text" name="perusahaan" class="form-control" required>
        <label>Lokasi:</label>
        <input type="text" name="lokasi" class="form-control" required>
        <label>Deskripsi:</label>
        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        <button type="submit" class="btn btn-primary">Tambahkan Lowongan</button>
    </form>
    <h2>Lowongan Kerja</h2>
    <?php while ($row = $data_bursa_kerja->fetch_assoc()): ?>
        <div class="lowongan-item">
            <h3><?php echo $row['posisi']; ?></h3>
            <p><strong>Perusahaan:</strong> <?php echo $row['perusahaan']; ?></p>
            <p><strong>Lokasi:</strong> <?php echo $row['lokasi']; ?></p>
            <p><?php echo $row['deskripsi']; ?></p>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
