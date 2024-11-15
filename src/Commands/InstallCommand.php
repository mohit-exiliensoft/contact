<?php

namespace Exiliensoft\Contact\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class InstallCommand extends Command
{
    protected $signature = 'contact:install {action=install}';
    protected $description = 'Install or remove the Contact package, manage migrations and database cleanup.';

    protected bool $askToRunMigrations = false;


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action = $this->argument('action');

        if ($action === 'install') {
            $this->installPackage();
        } elseif ($action === 'remove') {
            $this->removePackage();
        } else {
            $this->error("Invalid action: $action. Use 'install' or 'remove'.");
        }
    }

    /**
     * Install the package, publish migrations and run them.
     */
    public function installPackage()
    {
        $this->info('Installing the Contact package...');

        // Step 1: Publish Migrations
        $this->publishMigrations();

        // Step 2: Ask to run migrations
        if ($this->askToRunMigrations) {
            if ($this->confirm('Would you like to run the migrations now?')) {
                $this->comment('Running migrations...');
                $this->call('migrate'); 
            }
        }

        $this->info('Contact package installed successfully.');
    }

    /**
     * Remove the package, rollback migrations and delete associated tables.
     */
    public function removePackage()
    {
        $this->info('Removing the Contact package...');

        // Step 1: Rollback Migrations
        $this->rollbackMigrations();

        // Step 2: Delete associated tables
        $this->deleteTables();

        $this->info('Contact package removed successfully.');
    }

    /**
     * Publish Migrations
     */
    public function publishMigrations(): self
    {
        $migrationsPath = __DIR__ . '/../database/migrations'; // Adjusted relative path

        if (File::exists($migrationsPath)) {
            $this->publishes([
                $migrationsPath => database_path('migrations'),
            ], 'migrations');

            $this->info('Migrations have been published.');
        } else {
            $this->error('No migrations found to publish.');
        }

        return $this;
    }

    /**
     * Rollback the migrations for the package
     */
    public function rollbackMigrations()
    {
        $this->info('Rolling back migrations...');

        // Optional: Adjust path if needed, or let it rollback all migrations
        $this->call('migrate:rollback', ['--force' => true]);

        $this->info('Migrations rolled back successfully.');
    }

    /**
     * Delete associated tables from the database
     */
    public function deleteTables()
    {
        $this->info('Deleting database tables associated with the Contact package...');

        // Corrected table name
        if (Schema::hasTable('contacts')) {
            Schema::drop('contacts');
            $this->info('Table "contacts" deleted.');
        }

        $this->info('Tables deleted successfully.');
    }

    /**
     * Ask to run migrations after publishing them
     */
    public function askToRunMigrations(): self
    {
        $this->askToRunMigrations = true;

        return $this;
    }
}
