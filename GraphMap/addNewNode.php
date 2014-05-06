<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if ($_POST['editFile'] == 'noFile') {
    echo 'choose a file to add a node to';
} elseif (empty($_POST['name'])) {
    echo 'enter a name for the node';
} elseif (empty($_POST['size'])) {
    echo 'enter a size for the node';
} elseif (empty($_POST['color'])) {
    echo 'enter a color for the node';
} elseif (empty($_POST['distance'])) {
    echo 'enter a distance for the node';
} elseif ($_POST['source'] == "") {
    echo 'enter the number of the source node';
} elseif (empty($_POST['target'])) {
    echo 'enter the number of the target node';
} else {
    $jsonString = file_get_contents($_POST['editFile']);

    $tempArray = json_decode($jsonString, true);

    $nodeInfo = array("name" => $_POST['name'], "size" => (int) $_POST['size'],
        "color" => $_POST['color'], "distance" => (int) $_POST['distance']);

    array_push($tempArray['nodes'], $nodeInfo);

    $linkInfo = array("source" => (int) $_POST['source'], "target" => (int) $_POST['target']);
    array_push($tempArray['links'], $linkInfo);

    $json = json_encode($tempArray);
    file_put_contents($_POST['editFile'], $json);
}
?>
