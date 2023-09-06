<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict();

        Vite::macro('image', function (string $asset) {
            /** @var \Illuminate\Support\Facades\Vite $this */
            return $this->asset("resources/images/{$asset}");
        });

        Password::default(fn () => 
            Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
        );


        if (! $this->app->environment('production')) {
            $faker = fake();

            $faker->addProvider(new \App\Utils\Faker\MarkdownProvider($faker));
        }
    }
}
