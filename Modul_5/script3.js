$(document).ready(function() {
    // 1. Menampilkan gambar dengan efek fade-in saat halaman dimuat
    $('.gallery img').hide().fadeIn(1000);

    // 2. Membuka gambar dalam modal saat diklik
    $('.gallery img').click(function() {
        const src = $(this).attr('src'); // Mengambil URL gambar
        $('#modalImage').attr('src', src); // Menampilkan gambar di modal
        $('#myModal').fadeIn(500); // Menampilkan modal dengan efek fade-in
    });

    // 3. Menutup modal dengan tombol "Close" atau mengklik area luar gambar
    $('.close, .modal').click(function(event) {
        if ($(event.target).is('.close') || $(event.target).is('.modal')) {
            $('#myModal').fadeOut(500); // Menutup modal dengan efek fade-out
        }
    });

    // 4. Menambahkan fitur highlight otomatis untuk daftar alumni
    $('#alumniList li').hover(function() {
        $(this).toggleClass('highligth');
    });
});
