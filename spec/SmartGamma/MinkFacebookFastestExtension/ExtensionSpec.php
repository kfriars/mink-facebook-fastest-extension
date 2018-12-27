<?php

namespace spec\SmartGamma\MinkFacebookFastestExtension;

use SmartGamma\MinkFacebookFastestExtension\Extension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class ExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Extension::class);
    }

    function it_should_load_extenstion(ContainerBuilder $container, Definition $definition)
    {
        $container->setDefinition(Argument::any(), Argument::any())->willReturn();
        $container->setParameter(Argument::any(), Argument::any())->willReturn();
        $container->getDefinition(Argument::any())->willReturn($definition);
        $config = [
            'default_session'    => 'facebook_web_driver',
            'javascript_session' => 'facebook_web_driver',
            'sessions' =>
                [
                    'facebook_web_driver' => [
                        'facebook_web_driver' => [
                            'FacebookFactory',
                            'wd_hosts' => 'host',
                            'capabilities' => ['extra_capabilities' => []],
                            'browser' => 'chrome',
                        ]
                    ]
                ],
            'show_auto' => true,
            'base_url' => 'url',
            'browser_name' => 'chrome',
        ];

        $this->load($container, $config);
    }
}
