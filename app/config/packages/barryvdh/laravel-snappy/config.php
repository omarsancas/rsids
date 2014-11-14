<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' =>  'C:\xampp\htdocs\laravel_test\laravel\vendor\bin\wkhtmltopdf\bin\wkhtmltopdf',
        'options' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' =>  base_path().'/vendor/bin/wkhtmltoimage-amd64',
        'options' => array(),
    ),


);
