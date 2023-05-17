<?php
include 'koneksi.php';
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $thumbnail = $_POST['thumbnail'];
    $extension_allowed = array('png', 'jpg');
    $name = $_FILES['thumbnail']['name'];
    $x = explode('.', $name);
    $extension = strtolower(end($x));
    $size = $_FILES['thumbnail']['size'];
    $file_tmp = $_FILES['thumbnail']['tmp_name'];
    if (in_array($extension, $extension_allowed) === true) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, 'images/' . $name);
            $query = mysqli_query($koneksi, "INSERT INTO articles
VALUES(NULL, '$title','$content','$category','$name')");
            if ($query) {
                $message = "Data berhasil ditambahkan";
                $message = urlencode($message);
                header("Location:index.php?message={$message}");
            } else {
                $message = "Data gagal ditambahkan";
                $message = urlencode($message);
                header("Location:add.php?message={$message}");
            }
        } else {
            $message = "Ukuran File Terlalu Besar";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");
        }
    } else {
        $message = "Extension tidak diperbolehkan";
        $message = urlencode($message);
        header("Location:add.php?message={$message}");
    }
}