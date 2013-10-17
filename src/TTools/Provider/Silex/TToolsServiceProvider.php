<?php

namespace TTools\Provider\Silex;

use TTools\App;
use Silex\Application;
use Silex\ServiceProviderInterface;

class TToolsServiceProvider implements ServiceProviderInterface{

    public function register(Application $app)
    {
        $app['ttools'] = $app->share(function ($app) {

           $config = array(
               'consumer_key'        => $app['ttools.consumer_key'],
               'consumer_secret'     => $app['ttools.consumer_secret'],
               'access_token'        => isset($app['ttools.access_token']) ? $app['ttools.access_token'] : null,
               'access_token_secret' => isset($app['ttools.access_token_secret']) ? $app['ttools.access_token_secret'] : null,
               'auth_method'         => isset($app['ttools.auth_method']) ? $app['ttools.auth_method'] : null,
           ); 

           return new App($config);
        });

    }

    public function boot(Application $app)
    {
    }
 }