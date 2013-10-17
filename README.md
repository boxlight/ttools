ttools dev (twitter service provider for Silex)
======

TTools (Twitter Tools) Library is currently under development. It aims to make life easier for twitter app developers, providing a simple workflow for authentication, while maintaining a high-level of flexibility for various types of applications.

If you are a php developer and want to help, you are welcome. 

requirements and install
=====

TTools relies (for now) on a forked version of themattharris/tmhOAuth.
Add this to your composer.json:

<pre>
{
    "repositories": [
    	{ "type": "vcs", "url": "https://github.com/erikaheidi/tmhOAuth.git" },
    	{ "type": "vcs", "url": "git@github.com:boxlight/ttools.git" }
    ],
    "require": {
            "boxlight/twitter-service-provider/ttools": "dev-master",
        "tmhoauth/tmhoauth": "dev-ttools"
    }
}

</pre>

Then Add 

<pre>
$app->register(new TTools\Provider\Silex\TToolsServiceProvider(), array(
    'ttools.consumer_key'       => 'CONSUMER_KEY',
    'ttools.consumer_secret'    => 'CONSUMER_SECRET',
    'ttools.auth_method'        =>'/oauth/authorize'
));
</pre>