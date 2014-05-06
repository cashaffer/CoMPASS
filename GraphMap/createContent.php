<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$file = $_POST['fileName'];

file_put_contents($file, $_POST['editor']);

?>
