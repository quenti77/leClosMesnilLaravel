<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        //View::composer('layouts.app', AppComposer::class);

        View::composer('layouts.app', function ($view) {
        $categories = Category::all();
        $category = Category::where('slug', '=', request()->get("slug"))->first();
        $view->with(compact('categories', 'category'));
        });
    }
}
