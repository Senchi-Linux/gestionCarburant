<?php
if(! function_exists('pageTitle')){

function pageTitle(String $title = null ) : String {
     
    return $title
           ? $title.' | '.config('app.name')
           : config('app.name');
}

}