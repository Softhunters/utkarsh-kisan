<?php

use App\Models\Websetting;


function webdata()
{
    $web_setting = Websetting::find(1);
    return $web_setting;
    
}