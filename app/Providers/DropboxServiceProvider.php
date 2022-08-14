<?php
 
namespace App\Providers;
 
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\Cloud;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
 
class DropboxServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
 
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {
            $adapter = new DropboxAdapter(new Client(
                $config['authorization_token']
            ));
 
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}