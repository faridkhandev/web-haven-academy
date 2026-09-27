<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about:app', function () {
    $this->comment(config('app.name').' Laravel application');
})->purpose('Display application information');
