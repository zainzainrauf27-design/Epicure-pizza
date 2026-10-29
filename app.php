<?php
return ['name'=>env('APP_NAME','EPICURE PIZZA & FAST FOOD'),'env'=>env('APP_ENV','production'),'debug'=>(bool)env('APP_DEBUG',false),'url'=>env('APP_URL','http://localhost'),'timezone'=>env('APP_TIMEZONE','Asia/Karachi'),'locale'=>env('APP_LOCALE','en'),'fallback_locale'=>env('APP_FALLBACK_LOCALE','en'),'key'=>env('APP_KEY'),'cipher'=>'AES-256-CBC','maintenance'=>['driver'=>'file']];
