<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 04.08.16
 * Time: 17:30
 */

namespace Silwerclaw\Jirapi;


use Illuminate\Support\ServiceProvider;
use Silwerclaw\Jirapi\Auth\Basic;
use Silwerclaw\Jirapi\Interfaces\AuthInterface;

class JirapiServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $configFile = __DIR__ . '/../config/jirapi.php';
        $this->publishes([$configFile => config_path('jirapi.php')], 'config');

        $this->app->instance(AuthInterface::class, new Basic(config('jirapi.basic')));
        
        $this->app->singleton(Jirapi::class, Jirapi::class);
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/jirapi.php';
        $this->mergeConfigFrom($configPath, 'jirapi');
    }
}