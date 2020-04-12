<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        Dosya seçin: <input type="file" name="image[]" multiple="multiple" />
        <hr />
        <input type="submit" name="submit" value="Yükle" />
    </form>

    <?php
    include "function.php";

    if (isset($_POST['submit'])) {

        verotnet($_FILES['image']/*file_name*/, 'Pics_'/*pics_pre*/, 'resim'/*pics_name*/, 'upload'/*path*/, 'image/*'/*type*/, ''/*pics_h*/, ''/*pics_w*/, ''/*picsCuolity*/, true/*resize*/, true/*crop*/, ''/*wtr_mrk*/, ''/*wtr_pos*/);
    }

    ?>

</body>

</html>