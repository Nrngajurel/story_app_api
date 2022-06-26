<?php

use App\Admin\Controllers\HomeController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', [HomeController::class, 'index'])->name('home');
    $router->resource('stories', StoryController::class);
    $router->resource('sliders', SliderController::class);
    $router->resource('categories', CategoryController::class);

});
