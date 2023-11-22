<?php

$servername = "db4free.net";
$username = "ragnarfenai";
$password = "Wang@s9Ajhv7w9Z";
$database = "db_komik_fenai";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Set header untuk memastikan respons sebagai JSON
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ambil semua data komik dari database
    $sql = "SELECT * FROM komik";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $komiks = array();
        while ($row = $result->fetch_assoc()) {
            $komiks[] = $row;
        }
        echo json_encode($komiks);
    } else {
        echo json_encode(array('message' => 'Tidak ada data ditemukan'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim dari formulir tambah komik di halaman HTML
    $data = json_decode(file_get_contents('php://input'), true);

    // Masukkan data ke dalam tabel komik
    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $sinopsis = $data['sinopsis'];

    $sql = "INSERT INTO komik (judul, pengarang, sinopsis) VALUES ('$judul', '$pengarang', '$sinopsis')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Komik berhasil ditambahkan'));
    } else {
        echo json_encode(array('message' => 'Gagal menambahkan komik'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ambil ID komik yang akan dihapus dari parameter URL
    $id = $_GET['id'];

    // Hapus komik berdasarkan ID dari tabel
    $sql = "DELETE FROM komik WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Komik berhasil dihapus'));
    } else {
        echo json_encode(array('message' => 'Gagal menghapus komik'));
    }
}


$conn->close();
?>

    } else {
        echo json_encode(array('message' => 'Gagal menghapus komik'));
    }
}

// Tutup koneksi
$conn->close();
?>
