<?php

$file = $_POST['fileName'];

file_put_contents($file, $_POST['editor']);
?>