<?php
require_once 'view/incode.php';
require_once 'view/template.php';
if(!empty($_GET['pass'])) {
    require_once 'controller/incode.php';
    require_once 'view/link.php';

} else{

        require_once 'controller/decode.php';
    require_once 'view/decode.php';
    }