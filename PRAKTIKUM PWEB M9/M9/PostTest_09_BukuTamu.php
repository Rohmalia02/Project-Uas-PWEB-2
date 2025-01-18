<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_alumni";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form saat data dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $pesan = $conn->real_escape_string($_POST['pesan']);

    $sql = "INSERT INTO tamu (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='alert'>Data berhasil ditambahkan ke buku tamu.</p>";
    } else {
        echo "<p class='alert alert-error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Mengambil semua data tamu
$data_tamu = $conn->query("SELECT * FROM tamu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            margin: 20px 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input, textarea, button {
            width: 100%;
            margin-top: 5px;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .tamu-item {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .alert {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buku Tamu</h1>

        <form method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="pesan">Pesan:</label>
            <textarea id="pesan" name="pesan" required></textarea>

            <button type="submit">Kirim</button>
        </form>

        <h2>Daftar Tamu</h2>
        <?php if ($data_tamu->num_rows > 0): ?>
            <?php while ($row = $data_tamu->fetch_assoc()): ?>
                <div class="tamu-item">
                    <strong><?php echo htmlspecialchars($row['nama']); ?></strong> 
                    (<em><?php echo htmlspecialchars($row['email']); ?></em>)
                    <p><?php echo nl2br(htmlspecialchars($row['pesan'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Belum ada tamu yang mengisi buku tamu.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>