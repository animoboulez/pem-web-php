<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload & Download Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Upload & Download Page</h2>
        
        <!-- Form untuk mengunggah file -->
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="file">Select a file to upload:</label>
                <input type="file" name="file" id="file">
            </div>
            <button type="submit" name="upload">Upload</button>
        </form>

        <!-- Daftar file yang dapat diunduh -->
        <div class="downloads">
            <h3>Downloads</h3>
            <ul>
                <?php
                // Direktori tempat file-file diunggah
                $dir = 'uploads/';
                // Mengambil daftar file dalam direktori
                $files = scandir($dir);
                // Menampilkan daftar file yang dapat diunduh
                foreach($files as $file) {
                    if($file != '.' && $file != '..') {
                        echo "<li><a href='uploads/$file' download>$file</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
        
        <!-- Tombol logout -->
        <a href="interface.html">Logout</a>
    </div>
</body>
</html>

<?php
// Proses pengunggahan file
if(isset($_POST['upload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Periksa apakah file sudah ada
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Batasi jenis file yang diizinkan
    if($imageFileType != "txt" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") {
        echo "Sorry, only TXT, PDF, DOC, DOCX files are allowed.";
        $uploadOk = 0;
    }
    // Periksa apakah upload berhasil
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename( $_FILES["file"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
