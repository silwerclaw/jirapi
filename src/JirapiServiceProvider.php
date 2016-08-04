<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 04.08.16
 * Time: 17:30
 */

namespace Silwerclaw\Jirapi;


use Illuminate\Support\ServiceProvider;

class JirapiServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $configFile = __DIR__ . '/../config/jirapi.php';
        $this->publishes([$configFile => config_path('jirapi.php')], 'config');
        
        $this->app->instance(Jirapi::class, new Jirapi(new Authenticator(
            config('jirapi.basic.host'),
            config('jirapi.basic.login'),
            config('jirapi.basic.password')
        )));
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