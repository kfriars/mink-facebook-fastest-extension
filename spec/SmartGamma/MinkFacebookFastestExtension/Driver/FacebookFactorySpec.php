<?php

namespace spec\SmartGamma\MinkFacebookFastestExtension\Driver;

use SmartGamma\MinkFacebookFastestExtension\Driver\FacebookFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FacebookFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FacebookFactory::class);
    }
    
    function it_builds_driver()
    {
        $config = [
            'FacebookFactory',
            'wd_hosts' => ['host'],
            'capabilities' => ['extra_capabilities' => []],
            'browser' => 'chrome',
        ];

        $this->buildDriver($config);
    }
}
