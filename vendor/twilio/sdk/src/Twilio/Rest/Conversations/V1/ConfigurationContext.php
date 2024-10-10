<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Conversations
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Conversations\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;


class ConfigurationContext extends InstanceContext
    {
    /**
     * Initialize the ConfigurationContext
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

        $this->uri = '/Configuration';
    }

    /**
     * Fetch the ConfigurationInstance
     *
     * @return ConfigurationInstance Fetched ConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ConfigurationInstance
    {

        $payload = $this->version->fetch('GET', $this->uri, [], []);

        return new ConfigurationInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Update the ConfigurationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ConfigurationInstance Updated ConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): ConfigurationInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'DefaultChatServiceSid' =>
                $options['defaultChatServiceSid'],
            'DefaultMessagingServiceSid' =>
                $options['defaultMessagingServiceSid'],
            'DefaultInactiveTimer' =>
                $options['defaultInactiveTimer'],
            'DefaultClosedTimer' =>
                $options['defaultClosedTimer'],
        ]);

        $payload = $this->version->update('POST', $this->uri, [], $data);

        return new ConfigurationInstance(
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
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Conversations.V1.ConfigurationContext ' . \implode(' ', $context) . ']';
    }
}
