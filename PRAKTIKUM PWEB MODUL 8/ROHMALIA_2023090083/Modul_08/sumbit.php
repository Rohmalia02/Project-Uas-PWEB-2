<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_alumnitugas';

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Tangani request POST untuk menyimpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? null;
    $year = $_POST['year'] ?? null;
    $status = $_POST['status'] ?? null;

    // Validasi data
    if (!$name || !$year || !$status) {
        die('Data tidak lengkap.');
    }

    // Query untuk menyimpan data
    $sql = "INSERT INTO alumni (name, year, status) VALUES ('$name', '$year', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tangani request GET untuk mengambil data
if (isset($_GET['action']) && $_GET['action'] === 'fetch') {
    // Query untuk mengambil data
    $sql = "SELECT * FROM alumni";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['year']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Belum ada data alumni.</td></tr>";
    }
}

// Tutup koneksi
$conn->close();
?>
