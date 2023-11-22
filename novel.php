<?php

$servername = "db4free.net";
$username = "defenai";
$password = "Pg7J3ECL_uB9NjE";
$database = "db_novel_fenai";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Set header untuk memastikan respons sebagai JSON
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ambil semua data novel dari database
    $sql = "SELECT * FROM novel";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $novels = array();
        while ($row = $result->fetch_assoc()) {
            $novels[] = $row;
        }
        echo json_encode($novels);
    } else {
        echo json_encode(array('message' => 'Tidak ada data ditemukan'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang dikirim dari formulir tambah novel di halaman HTML
    $data = json_decode(file_get_contents('php://input'), true);

    // Masukkan data ke dalam tabel novel
    $judul = $data['judul'];
    $pengarang = $data['pengarang'];
    $sinopsis = $data['sinopsis'];

    $sql = "INSERT INTO novel (judul, pengarang, sinopsis) VALUES ('$judul', '$pengarang', '$sinopsis')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Novel berhasil ditambahkan'));
    } else {
        echo json_encode(array('message' => 'Gagal menambahkan novel'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ambil ID novel yang akan dihapus dari parameter URL
    $id = $_GET['id'];

    // Hapus novel berdasarkan ID dari tabel
    $sql = "DELETE FROM novel WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'Novel berhasil dihapus'));
    } else {
        echo json_encode(array('message' => 'Gagal menghapus novel'));
    }
}

// Tutup koneksi
$conn->close();
?>
      echo json_encode(array('message' => 'Gagal menghapus novel'));
    }
}

// Tutup koneksi
$conn->close();
?>
