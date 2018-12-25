<?php

namespace SmartGamma\MinkFacebookFastestExtension;

use SmartGamma\MinkFacebookFastestExtension\Driver\FacebookFactory;
use Behat\MinkExtension\ServiceContainer\MinkExtension;
use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Extension extends MinkExtension implements ExtensionInterface
{
    /**
     * Extension constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->registerDriverFactory(new FacebookFactory());
    }

    /**
     * {@inheritDoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $envBaseUrl = getenv('BEHAT_BASE_URL');
        if ($envBaseUrl !== false) {
            $config['base_url'] = $envBaseUrl;
        }

        parent::load($container, $config);
    }
}
