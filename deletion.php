<?php
function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object))
                    rrmdir($dir."/".$object);
                else
                    unlink($dir."/".$object);
            }
        }
        rmdir($dir);
    }
}

if (isset($_GET['file'])){
    if (is_dir($_GET['file'])){
        rrmdir($_GET['file']);
    }
    else{
        unlink($_GET['file']);
    }
}
header('Location: /index.php');
