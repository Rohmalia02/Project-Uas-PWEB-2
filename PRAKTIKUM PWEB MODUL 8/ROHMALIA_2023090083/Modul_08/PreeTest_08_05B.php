<?php
// Mengecek apakah data dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    // Menampilkan hasil
    echo "Nama: " . htmlspecialchars($nama) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
} else {
    echo "Form belum dikirim!";
}
?>
