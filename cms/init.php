<?php

function dump($data, $flag = 0){
    echo '<pre>';
        if ($flag == 0) {
            print_r($data);
        }else{
            var_dump($data);
        }
    echo '</pre>';
}

function glob_tree_files($path, $_base_path = null)
{
    if (is_null($_base_path)) {
        $_base_path = '';
    } else {
        $_base_path .= basename($path) . '/';
    }

    $out = array();
    foreach(glob($path . '/*') as $file) {
        if ((strpos($file, "cms") === false) && (strpos($file, "README") === false) && (strpos($file, "config") === false)) {
            if (is_dir($file)) {
                $out = array_merge($out, glob_tree_files($file, $_base_path));
            } else {
                $out[] = $_base_path . basename($file);
            }
        }
    }
    return $out;
}

?>