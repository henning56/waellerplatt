<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Provide default meta values to all views. Controllers/views may pass a $meta array
        // to override any of these values.
        View::composer('*', function ($view) {
            $defaults = [
                'title' => config('app.name'),
                'description' => config('app.description', ''),
                'canonical' => url()->current(),
                'image' => asset('images/default.png'),
                'og_type' => 'website',
                'jsonld' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => config('app.name'),
                    'url' => config('app.url'),
                ],
            ];

            $data = $view->getData();
            $provided = isset($data['meta']) && is_array($data['meta']) ? $data['meta'] : [];

            $meta = array_merge($defaults, $provided);

            $view->with('meta', $meta);
        });
    }
}
