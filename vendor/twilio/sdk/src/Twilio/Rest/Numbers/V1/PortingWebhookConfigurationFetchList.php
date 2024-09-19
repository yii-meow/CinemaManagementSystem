<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Numbers
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Numbers\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;


class PortingWebhookConfigurationFetchList extends ListResource
    {
    /**
     * Construct the PortingWebhookConfigurationFetchList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(
        Version $version
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        ];

        $this->uri = '/Porting/Configuration/Webhook';
    }

    /**
     * Fetch the PortingWebhookConfigurationFetchInstance
     *
     * @return PortingWebhookConfigurationFetchInstance Fetched PortingWebhookConfigurationFetchInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): PortingWebhookConfigurationFetchInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->fetch('GET', $this->uri, [], [], $headers);

        return new PortingWebhookConfigurationFetchInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Numbers.V1.PortingWebhookConfigurationFetchList]';
    }
}
