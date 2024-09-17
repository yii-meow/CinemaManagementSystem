<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Marketplace
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Marketplace\V1\InstalledAddOn;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;


class InstalledAddOnUsageList extends ListResource
    {
    /**
     * Construct the InstalledAddOnUsageList
     *
     * @param Version $version Version that contains the resource
     * @param string $installedAddOnSid 
     */
    public function __construct(
        Version $version,
        string $installedAddOnSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'installedAddOnSid' =>
            $installedAddOnSid,
        
        ];

        $this->uri = '/InstalledAddOns/' . \rawurlencode($installedAddOnSid)
        .'/Usage';
    }

    /**
     * Create the InstalledAddOnUsageInstance
     *
     * @param MarketplaceV1InstalledAddOnInstalledAddOnUsage $marketplaceV1InstalledAddOnInstalledAddOnUsage
     * @return InstalledAddOnUsageInstance Created InstalledAddOnUsageInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(MarketplaceV1InstalledAddOnInstalledAddOnUsage $marketplaceV1InstalledAddOnInstalledAddOnUsage): InstalledAddOnUsageInstance
    {

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $data = $marketplaceV1InstalledAddOnInstalledAddOnUsage->toArray();
        $headers['Content-Type'] = 'application/json';
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new InstalledAddOnUsageInstance(
            $this->version,
            $payload,
            $this->solution['installedAddOnSid']
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Marketplace.V1.InstalledAddOnUsageList]';
    }
}
