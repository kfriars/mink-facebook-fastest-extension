<?php

namespace SmartGamma\MinkFacebookFastestExtension\Driver;

use Facebook\WebDriver\Exception\StaleElementReferenceException;
use SilverStripe\MinkFacebookWebDriver\FacebookWebDriver as BaseFacebookDriver;

/**
 * Class FacebookDriver with "spin" features
 *
 * @package SmartGamma\MinkFacebookExtension\Driver
 */
class FacebookDriver extends BaseFacebookDriver
{
    /**
     * {@inheritdoc}
     */
    public function click($xpath, &$attempts = 10)
    {
        try {
            parent::click($xpath);
        } catch (StaleElementReferenceException $e) {
            if ($attempts > 0) {
                usleep(500);
                $attempts--;
                $this->click($xpath, $attempts);
            } else {
                throw $e;
            }
        }
    }
}
