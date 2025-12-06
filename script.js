// script.js
$(document).ready(function() {
    // 1. Aktifkan Select2 (Search di Dropdown)
    $('.select2-search').select2({
        theme: "classic", 
        width: '100%' 
    });

    // 2. Aktifkan DataTables (Search & Pagination di Tabel)
    $('#tabelPeminjaman').DataTable({
        "language": {
            "search": "Cari Data:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Lanjut",
                "previous": "Kembali"
            },
            "emptyTable": "Tidak ada data peminjaman saat ini",
            "zeroRecords": "Data tidak ditemukan"
        }
    });
});