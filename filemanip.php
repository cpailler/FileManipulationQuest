<?php include('inc/head.php'); ?>


<?php
if(isset($_POST['contenu'])){
    var_dump($_GET['file']);
    $file = fopen($_GET['file'],"w");
    fwrite($file,$_POST['contenu']);
    fclose($file);
}


if(isset($_GET['file'])){
    if (is_dir($_GET['file'])){
        $dir=opendir($_GET['file']);
        $dirName = pathinfo($_GET['file'], PATHINFO_BASENAME);
        echo $dirName.' contains : <br>';
        echo '<ul>';
        while ($file = readdir($dir)){
            if (!in_array($file,['.','..'])){
                echo '<li>'.$file.'</li>';
            }
        };
        echo'</ul>';
    }
    else {
        $file = $_GET['file'];
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        echo pathinfo($file, PATHINFO_BASENAME);
        switch ($extension) {
            case 'jpg' :
                echo '<img src="' . $file . '"><br>';
                break;
            case 'txt' || 'html' :
                echo '<form method="POST" action="">
                        <textarea name="contenu" style="width: 100%;height: 400px;">' . file_get_contents($file) . '</textarea>
                        <input type="submit" class="btn btn-success" value="Save">
                    </form><br>';
                break;
            default :
                echo 'file format not supported';
        }
    }
    echo '<a  href="/index.php" class="btn btn-primary">close</a>';
    echo '<a  href="/deletion.php?file='.$_GET['file'].'" class="btn btn-danger pull-right">delete</a>';
}
else{
    header('Location : /index.php');
}
?>
<?php include('inc/foot.php'); ?>