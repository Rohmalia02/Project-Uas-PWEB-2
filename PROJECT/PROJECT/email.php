<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_portopolio"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir
$nama = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Validasi input
if (empty($nama) || empty($email) || empty($message)) {
    echo "Semua bidang harus diisi.";
} else {
    // Menggunakan prepared statements untuk menghindari SQL injection
    $stmt = $conn->prepare("INSERT INTO kontak (nama, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama  , $email, $message); // "sss" berarti semua parameter adalah string

    if ($stmt->execute()) {
        echo "Pesan berhasil dikirim!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>