<?php
/**
 * Read
**/
function read_file($filename)
{
    $fp = fopen($filename, "r") or die("couldn't open $filename");
    $read = fread($fp, filesize($filename));
    fclose($fp);
    return $read;
}
/**
 * Write
**/
function write_file($filename, $buffer)
{
    $fp = fopen($filename, "w") or die("couldn't open $filename");
    flock( $fp, LOCK_EX );
    $write = fputs($fp, $buffer);
    flock( $fp, LOCK_UN );
    fclose($fp);
    return true;
}
/**
 * Modify
**/
function append_to_file($filename, $buffer)
{
    $fp = fopen($filename, "a") or die("couldn't open $filename");
    flock( $fp, LOCK_EX );
    fputs($fp, $buffer);
    flock( $fp, LOCK_UN );
    fclose($fp);
    return true;
}

?>