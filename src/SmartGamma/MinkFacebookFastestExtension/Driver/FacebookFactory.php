<?php

namespace SmartGamma\MinkFacebookFastestExtension\Driver;

use SilverStripe\MinkFacebookWebDriver\FacebookFactory as BaseFacebookFactory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Facebook driver factory with fastest multi-threading support
 */
class FacebookFactory extends BaseFacebookFactory
{
    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder
            ->children()
            ->scalarNode('browser')->defaultValue('%mink.browser_name%')->end()
            ->append($this->getCapabilitiesNode())
            ->arrayNode('wd_hosts')->prototype('scalar')->end()
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function buildDriver(array $config)
    {
        $config['wd_host'] = $this->getCurrentWdHost($config);

        // Merge capabilities
        $extraCapabilities = $config['capabilities']['extra_capabilities'];
        unset($config['capabilities']['extra_capabilities']);
        $capabilities = array_replace($this->guessCapabilities(), $extraCapabilities, $config['capabilities']);

        // Build driver definition
        return new Definition(FacebookDriver::class, [
            $config['browser'],
            $capabilities,
            $config['wd_host'],
        ]);
    }

    /**
     * @param array $config
     *
     * @return mixed
     */
    private function getCurrentWdHost(array $config)
    {
        if (getenv('ENV_TEST_CHANNEL')) {
            $slot = getenv('ENV_TEST_CHANNEL') - 1;
        } else {
            $slot = 0;
        }

        if (!isset($config['wd_hosts'][$slot])) {
            throw new \InvalidArgumentException('Slot: ' . $slot . ' has not configured wd host, pls add additional item to "wd_hosts" section at behat.yml config');
        }

        return $config['wd_hosts'][$slot];
    }
}
