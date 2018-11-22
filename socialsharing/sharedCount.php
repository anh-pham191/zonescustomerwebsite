<?php
include 'fileFunction.php';

$file_path = "sharedCount.txt";

if (isset($_POST['action']) && $_POST['action'] == "addNew") {
    $str = read_file($file_path);
    write_file($file_path, $str+1);
    echo "Success";
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == "getInfo") {
    $str = read_file($file_path);
    echo $str;
    exit;
}

//append_to_file($file_path, "ABCD");
?>