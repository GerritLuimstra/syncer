<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Website</title>
    </head>
    <body>

        <style>
            body {
                margin: 0;
                padding: 0;
            }
            iframe {
                width: 100%;
                height: 100vh;
                position: absolute;
                z-index: 1;
                border: 0;
            }
            #connerror {
                background: rgba(0, 0, 0, 0.8);
                width: 100%;
                height: 100vh;
                position: absolute;
                z-index: 2;
                display: none;
                line-height: 100vh;
                text-align: center;
                font-size: 30px;
                color: white;
            }
        </style>

        <div id="connerror">
            There is a problem with the connection. Please wait.
        </div>
        <iframe></iframe>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(sync);

            var cycleTime = 300;
            var errorOverlay = $('#connerror');
            var website = $('iframe');

            function sync(){

                function success(syncURL){
                    if(errorOverlay.is(':visible')) errorOverlay.fadeOut(500);

                    if(website.attr('src') != syncURL){
                        website.attr('src', syncURL);
                    }

                    cycleTime = 300;
                }

                function error(){
                    cycleTime = 1000;
                    $('#connerror').fadeIn(500);
                }

                $.ajax({
                    url: 'state.txt',
                    success: success,
                    error: error,
                    cache: false
                });

                setTimeout(function(){
                    sync();
                }, cycleTime);

            }
        </script>

    </body>
</html>