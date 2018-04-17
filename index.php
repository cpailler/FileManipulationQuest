<?php include('inc/head.php'); ?>

    C'est ici que tu vas devoir afficher le contenu de tes repertoires et fichiers.


<?php
function realFilesOnly($directories){
    array_shift($directories);
    array_shift($directories);
    return $directories;
}

$files = realFilesOnly(scandir('files'));
echo '<ul>';
foreach($files as $file){
    echo "<li>";

    //var_dump(is_dir('files/'.$file));
    if (is_dir('files/'.$file)){
        echo '<a href="filemanip.php?file=files/'.$file.'">'.$file.'</a>';
        echo "<ul>";
        $subFiles = realFilesOnly(scandir('files/'.$file));
        //var_dump($subFiles);
        foreach ($subFiles as $subFile){
            if (is_dir('files/'.$file.'/'.$subFile)){
                echo '<li><a href="filemanip.php?file=files/'.$file.'/'.$subFile.'">'.$subFile.'</a></li>';
                echo "<ul>";
                $subSubFiles = realFilesOnly(scandir('files/'.$file.'/'.$subFile));
                //var_dump($subFiles);
                foreach ($subSubFiles as $subSubFile){

                    echo '<li><a href="filemanip.php?file=files/'.$file.'/'.$subFile.'/'.$subSubFile.'">'.$subSubFile.'</a></li>';
                }
                echo "</ul>";
            }
            else{
                echo '<li><a href="filemanip.php?file=files/'.$file.'/'.$subFile.'">'.$subFile.'</a></li>';
            }
        }
        echo "</ul>";
    }
    else{
        echo '<a href="filemanip.php?file=files/'.$file.'">'.$file.'</a>';
    }
    echo "</li>";
}
echo '</ul>';
?>
<?php include('inc/foot.php'); ?>