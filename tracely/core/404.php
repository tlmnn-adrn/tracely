<?php

    //Quelle: https://stackoverflow.com/questions/1381123/how-can-i-create-an-error-404-in-php

    function throw_404(){
?>
        <h1>
            404
        </h1>
<?php
        http_response_code(404);
        die();
    }