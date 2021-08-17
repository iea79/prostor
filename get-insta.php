<?php

    $externalURL = "https://www.instagram.com/pro_brp/?__a=1";

    // requires fopen wrappers
    $externalData = file_get_contents($externalURL);

    echo $externalData;
?>
