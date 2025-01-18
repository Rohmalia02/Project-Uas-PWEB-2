<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_alumni";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$search_results = [];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $keyword = trim($conn->real_escape_string($_GET['search']));
    if (empty($keyword)) {
        echo "Tidak ada kata kunci yang dimasukkan.";
    } else {
        $sql = "SELECT * FROM alumni WHERE LOWER(nama) LIKE LOWER('%$keyword%') OR LOWER(jurusan) LIKE LOWER('%$keyword%') OR tahun_lulus LIKE '%$keyword%'";
        echo "Query yang dijalankan: $sql";  // Debugging query
        $search_results = $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penelusuran Alumni</title>
</head>
<body>
    <h1>Penelusuran Alumni</h1>
    <form method="GET">
        <label>Cari Alumni:</label>
        <input type="text" name="search" placeholder="Nama, jurusan, atau tahun lulus">
        <button type="submit">Cari</button>
    </form>

    <h2>Hasil Pencarian</h2>
    <?php if (!empty($search_results) && $search_results->num_rows > 0): ?>
        <?php while ($row = $search_results->fetch_assoc()): ?>
            <p><strong><?php echo $row['nama']; ?></strong> (<?php echo $row['jurusan']; ?> - <?php echo $row['tahun_lulus']; ?>)</p>
            <?php if (!empty($row['foto'])): ?>
                <p>Foto: <img src="<?php echo $row['foto']; ?>" alt="Foto Alumni" width="100"></p>
            <?php else: ?>
                <p>Foto tidak tersedia</p>
            <?php endif; ?>
            <p>Aksi: <?php echo $row['aksi']; ?></p>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Tidak ada hasil ditemukan.</p>
    <?php endif; ?>
</body>
</html>