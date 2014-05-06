<html>
    <head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <link href="siteStyle.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript" src="/GraphMap/tinymce/js/tinymce/tinymce.min.js"></script>
    </head>
    <body>
        <div id='cssmenu'>
            <ul>
                <li class='active'><a href='index.html'><span>Home</span></a></li>
                <li><a href='#'><span>Products</span></a></li>
                <li><a href='#'><span>About</span></a></li>
                <li class='last'><a href='#'><span>Contact</span></a></li>
            </ul>
        </div>
        <div id="edit">
            <?PHP
            $selected_radio = '';

            if (isset($_POST['editfile'])) {

                $selected_radio = $_POST['editfile'];
            } else {
                echo'Choose a file to edit first';
            }
            ?>
            <script>
                var filename = "<?php echo $selected_radio; ?>";

//                document.write("<p>" + filename + "</p>");

                if (filename.indexOf(".json") !== -1) {
//                    document.write("<p>Edit map</p>");

                    $.getJSON(filename, function(data) {
                        var items = [];
                        items.push("<form name='editMapForm' class='basic-grey' method='POST' action='editMap.php'>");
                        items.push("<input type='text' name=fileName style='display: none' value=" + filename + ">");
                        $.each(data.nodes, function(key, val) {
                            items.push("<fieldset> <legend> Node Information</legend>");
                            items.push("<label> <span> Name: </span>");
                            items.push("<input type='text' name=name" + key + " value=" + val.name + "></label>");
                            items.push("<label> <span> Size: </span>");
                            items.push("<input type='number' name=size" + key + " value=" + val.size + "></label>");
                            items.push("<label> <span> Color: </span>");
                            items.push("<input type='text' name=color" + key + " value=" + val.color + "></label>");
                            items.push("<label> <span> Distance: </span>");
                            items.push("<input type='number' name=distance" + key + " value=" + val.distance + "></label>");
                            items.push("</fieldset> <br />");
                        });

                        $.each(data.links, function(key, val) {
                            items.push("<fieldset> <legend> Link Information</legend>");
                            items.push("<label> <span> Source: </span>");
                            items.push("<input type='number' name=source" + key + " value=" + val.source + "></label>");
                            items.push("<label> <span> Target: </span>");
                            items.push("<input type='number' name=target" + key + " value=" + val.target + "></label>");
                            items.push("</fieldset> <br />");
                        });

                        items.push("<label><span>&nbsp;</span> <input type='submit' class='button'value='Edit'/></label>\n\
                        <br /></form>");

                        $('#edit').append(items.join(""));
                    });
                }
                else if (filename.indexOf(".html") !== -1) {
//                    document.write("<p>Edit content</p>");
                    document.write("<form name='editHTMLForm' class='basic-grey' method='post' action='editHTML.php'>");
                    document.write("<input type='text' name='fileName' style='display: none' value=" + filename + ">");
                    document.write("<textarea id ='editor' name='editor'> </textarea>");
                    document.write("<label><span>&nbsp;</span> <input type='submit' class='button' value='Edit'/></label>\n\
                        <br /></form>");
                    document.write("</form>");

                    loadEditor(filename);
                }
                
                function loadEditor(fileName) {
                    tinyMCE.init({
                        theme: "modern",
                        mode: "textareas",
                        plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "searchreplace visualblocks code fullscreen",
                            "insertdatetime media table contextmenu paste fullpage"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullpage"
                    });

                    $.get(fileName, function(content) {
                        // if you have one tinyMCE box on the page:
                        tinyMCE.activeEditor.setContent(content);
                    });
                }
            </script>
        </div>
    </body>
</html>




