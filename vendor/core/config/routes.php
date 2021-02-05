<?php
return [
    '/cabinet/' => 'USer@cabinet',
    '/favourite/' => 'Stock@favourite',
    '/login/'=>'User@index',
    '/logout/' => 'User@logout',
    '/stock/' => 'Stock@index',
    '/stock/{i}/' => 'Stock@page',
    '/register/' => 'User@register',
    '/upload/' => 'Stock@upload',
    '/stock/ajaxSearchByTitle/' => 'Stock@ajaxSearchByTitle',
    '/stock/ajaxGetAll/' => 'Stock@ajaxGetAll',
    '/image/{s}' => 'Stock@image',
];