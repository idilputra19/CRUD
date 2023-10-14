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

// Create
if (isset($_POST['create'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    $sql = "INSERT INTO siswa (nama, nim, jurusan) VALUES ('$nama', '$nim', '$jurusan')";
    if (mysqli_query($connection, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Read
$result = mysqli_query($connection, "SELECT * FROM siswa");

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

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM siswa WHERE id=$id";
    if (mysqli_query($connection, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
</head>
<body>

<center>
    <h2>Data Siswa</h2>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['nim']; ?></td>
                <td><?php echo $row['jurusan']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="index.php?delete=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <h2>Tambah Siswa</h2>
    <form method="post" action="index.php">
        <label>Nama:</label>
        <input type="text" name="nama" required><br>
        <label>NIM:</label>
        <input type="text" name="nim" required><br>
        <label>Jurusan:</label>
        <input type="text" name="jurusan" required><br>
        <button type="submit" name="create">Simpan</button>
    </form>

        </center>
</body>
</html>
