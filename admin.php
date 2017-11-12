<?php
    if(isset($_GET['push'])){
        $_GET['push'] = str_replace("$", "#", $_GET['push']);
        file_put_contents('state.txt', $_GET['push']);
        exit;
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <body>
        <iframe></iframe>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            var src  = prompt('What do you want to share?');
            var frame = $('iframe');

            frame.attr('src', src);

            function syncWithClient(url){
                if(src == url){ return; }
                var encodedURL = url.replace('#', "$");
                $.ajax({
                    cache: false,
                    url: 'admin.php?push=' + encodedURL
                });
                src = url;
            }

            $('iframe').on('load', function(e){

                var src = e.target.src;
                var src = src.replace(window.location.protocol + "//" + window.location.host, "");

                syncWithClient(src);

                $(this).contents().find('a').on('click', function(e){
                    var href = e.target.href;
                    var href = href.replace(window.location.protocol + "//" + window.location.host, "");
                    syncWithClient(href);

                    frame.attr('src', href);
                });
            });
        </script>
    </body>
</html>

