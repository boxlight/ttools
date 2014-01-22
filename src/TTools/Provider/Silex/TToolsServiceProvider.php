<?php

namespace Boxlight\TTools\Provider\Silex;

use Boxlight\TTools\TTools;
use Silex\Application;
use Silex\ServiceProviderInterface;

class TToolsServiceProvider implements ServiceProviderInterface{

    public function register(Application $app)
    {
        $app['ttools'] = $app->share(function ($app) {

           $config = array(
               'consumer_key'     => $app['ttools.consumer_key'],
               'consumer_secret'  => $app['ttools.consumer_secret'],
               'auth_method'      => isset($app['ttools.auth_method']) ? $app['ttools.auth_method'] : null,
           );

           return new TTools($config);
        });

    }

    public function boot(Application $app)
    {
    }
 }
