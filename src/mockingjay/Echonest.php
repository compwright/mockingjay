<?php

namespace mockingjay;

use Guzzle\Common\Collection;
use Guzzle\Common\Event;
use Guzzle\Plugin\Oauth\OauthPlugin;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

class Echonest extends Client
{
    public static function factory($config = array())
    {
        // Provide a hash of default client configuration options
        $default = array(
        	'base_url' => 'http://developer.echonest.com/api/v4/',
        	'format' => 'json',
        );

        // The following values are required when creating the client
        $required = array(
            'api_key',
            'format',
        );

        // Merge in default settings and validate the config
        $config = Collection::fromConfig($config, $default, $required);

        // Create a new Echonest client
        $client = new self($config->get('base_url'), $config);

        // Set the service description
        $client->setDescription(ServiceDescription::factory(__DIR__ . '/resources/services/echonest.json'));

        // Auto-add parameters to all requests
        $client->getEventDispatcher()->addListener(
        	'request.before_send',
        	function(Event $event) use ($config, $required)
        	{
				$query = $event['request']->getQuery();
				foreach ($required as $key)
				{
					$query->set($key, $config->get($key));
				}
			}
		);

        return $client;
    }
}
