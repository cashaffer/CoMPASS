<?php

$nodesArray = array();
$linksArray = array();
$index = 0;

// check if a form was submitted
if (!empty($_POST)) {

    $file = $_POST['fileName'];
    unset($_POST['fileName']);

    for ($i = 0; $i < count($_POST); $i = $i + 6) {
        $nodeInfo = array("name" => $_POST['name' . $index], "size" => (int) $_POST['size' . $index],
            "color" => $_POST['color' . $index], "distance" => (int) $_POST['distance' . $index]);
        array_push($nodesArray, $nodeInfo);

        if (isset($_POST['source' . $index])) {
            $linkInfo = array("source" => (int) $_POST['source' . $index], "target" => (int) $_POST['target' . $index]);
            array_push($linksArray, $linkInfo);
        }
        $index++;
    }


    //you might need to process any other post fields you have..
    $postArray = array("nodes" => $nodesArray, "links" => $linksArray);
    $json = json_encode($postArray);

// make sure there were no problems
//if( json_last_error() != JSON_ERROR_NONE ){
    //exit;  // do your error handling here instead of exiting
// }
// write to file
//   note: _server_ path, NOT "web address (url)"!
    file_put_contents($file, $json);
}
?>
