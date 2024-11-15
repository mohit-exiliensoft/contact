<?php

namespace Exiliensoft\Contact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Package ke installation ke time par migration file create karein
     */
    public function boot()
    {
        // Routes, views, migrations, aur config ko load karna
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'contact');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(
            __DIR__.'/config/contact.php', 'contact'
        );
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Package ke removal ke time par migration file ko delete karna
     */
    public function register()
    {
        $this->commands([
            \Exiliensoft\Contact\Commands\InstallCommand::class,
        ]);
    }
}
