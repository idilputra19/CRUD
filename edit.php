<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$database = "mahasiswa";

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Inisialisasi variabel
$id = $_GET['id'];
$nama = $nim = $jurusan = "";

// Membaca data mahasiswa yang akan diubah
if (isset($id)) {
    $result = mysqli_query($connection, "SELECT * FROM siswa WHERE id=$id");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $nim = $row['nim'];
        $jurusan = $row['jurusan'];
    }
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    $sql = "UPDATE siswa SET nama='$nama', nim='$nim', jurusan='$jurusan' WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
</head>
<body>

        <center>
            <h2>Edit Siswa</h2>
            <form method="post" action="edit.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label>Nama:</label>
                <input type="text" name="nama" value="<?php echo $nama; ?>" required><br>
                <label>NIM:</label>
                <input type="text" name="nim" value="<?php echo $nim; ?>" required><br>
                <label>Jurusan:</label>
                <input type="text" name="jurusan" value="<?php echo $jurusan; ?>" required><br>
                <button type="submit" name="update">Update</button>
            </form>
        </center>

</body>
</html>
