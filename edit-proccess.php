<?php
include 'koneksi.php';
if (isset($_POST['edit'])) {
    $title = $_POST['title'];
    $id = $_POST['id'];
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
            $query = mysqli_query($koneksi, "UPDATE articles SET
title='$title', content='$content', category='$category',
thumbnail='$name' WHERE id='$id'");
            if ($query) {
                $message = "Data berhasil diubah";
                $message = urlencode($message);
                header("Location:index.php?message={$message}");
            } else {
                $message = "Data gagal diubah";
                $message = urlencode($message);
                header("Location:add.php?message={$message}");
            }
        } else {
            $message = "Ukuran File Terlalu Besar";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");
        }
    } else {
        $query = mysqli_query($koneksi, "UPDATE articles SET
title='$title', content='$content', category='$category' WHERE
id='$id'");
        if ($query) {
            $message = "Data berhasil diubah";
            $message = urlencode($message);
            header("Location:index.php?message={$message}");
        } else {
            $message = "Data gagal diubah";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");
        }
    }
}