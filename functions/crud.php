<?php
require_once 'config/koneksi.php';







// =======================================================================================================================
// MENGAMBIL SATU DATA BERDASARKAN ID 
// =======================================================================================================================
function ambilSatuData($id, $tabel)
{

    return conn->query("SELECT * FROM $tabel WHERE id=$id");
}

// =======================================================================================================================
// MENGAMBIL SEMUA DATA
// =======================================================================================================================
function ambilSemuaData($tabel)
{

    return conn->query("SELECT * FROM $tabel");
}


// =======================================================================================================================
// OPERASI MENAMBAH DATA 
// =======================================================================================================================

function tambahData($tabel, $data)
{

    // Periksa koneksi
    if (conn->connect_error) {
        die("Koneksi gagal: " . conn->connect_error);
    }

    // Mengonversi array asosiatif ke format string untuk INSERT SQL
    $columns = implode(', ', array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    // Query SQL untuk insert data ke dalam tabel
    $sql = "INSERT INTO $tabel ($columns) VALUES ($values)";

    // Eksekusi query
    if (conn->query($sql) === TRUE) {
        $inserted_id = conn->insert_id; // Mendapatkan ID dari data yang baru dimasukkan
        return "Data berhasil ditambahkan dengan ID: " . $inserted_id;
    } else {
        return "Error: " . conn->error;
    }

    // Tutup koneksi
    conn->close();
}



// =======================================================================================================================
// OPERASI EDIT DATA BERDASARKAN ID
// =======================================================================================================================
function editData($id, $tabel, $data)
{

    // Periksa koneksi
    if (conn->connect_error) {
        die("Koneksi gagal: " . conn->connect_error);
    }

    // Mengonversi array asosiatif ke format string untuk UPDATE SQL
    $setValues = '';
    foreach ($data as $key => $value) {
        $setValues .= "$key='$value', ";
    }
    $setValues = rtrim($setValues, ', '); // Menghapus koma terakhir

    // Query SQL untuk mengedit data berdasarkan ID
    $sql = "UPDATE $tabel SET $setValues WHERE id=$id";

    // Eksekusi query
    if (conn->query($sql) === TRUE) {
        return "Data dengan ID $id berhasil diubah";
    } else {
        return "Error: " . conn->error;
    }

    // Tutup koneksi
    conn->close();
}


// =======================================================================================================================
// OPERASI HAPUS DATA BERDASARKAN ID
// =======================================================================================================================
function hapusData($id, $tabel)
{

    // Periksa koneksi
    if (conn->connect_error) {
        die("Koneksi gagal: " . conn->connect_error);
    }

    // Query SQL untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM $tabel WHERE id=$id";

    // Eksekusi query
    if (conn->query($sql) === TRUE) {
        return "Data dengan ID $id berhasil dihapus";
    } else {
        return "Error: " . conn->error;
    }

    // Tutup koneksi
    conn->close();
}
