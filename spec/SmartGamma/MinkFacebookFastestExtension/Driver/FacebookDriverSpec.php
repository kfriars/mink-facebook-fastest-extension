<?php

namespace spec\SmartGamma\MinkFacebookFastestExtension\Driver;

use SmartGamma\MinkFacebookFastestExtension\Driver\FacebookDriver;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FacebookDriverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FacebookDriver::class);
    }
}
