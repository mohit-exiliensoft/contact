<?php

namespace Exiliensoft\Contact;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

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
        
        // Config file ko publish karna
        $this->publishes([
            __DIR__.'/config/contact.php' => config_path('contact.php'),
        ], 'config');
        
        // Migration file ko publish karne ka logic
        $this->publishes([
            __DIR__.'/database/migrations/0001_01_01_000003_create_contact_table.php' => database_path('migrations/0001_01_01_000003_create_contact_table.php'),
        ], 'migrations');
    }

    /**
     * Package ke removal ke time par migration file ko delete karna
     */
    public function register()
    {
        // Uninstall hone par migration file ko delete karne ka logic
        if ($this->app->runningInConsole()) {
            $this->app->terminating(function () {
                $migrationFile = database_path('migrations/0001_01_01_000003_create_contact_table.php');

                // Migration file ko delete karna
                if (File::exists($migrationFile)) {
                    File::delete($migrationFile);
                    echo "Migration file deleted successfully.\n";
                } else {
                    echo "Migration file does not exist.\n";
                }
            });
        }
    }
}
