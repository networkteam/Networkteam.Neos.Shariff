<?php
namespace Networkteam\Neos\Shariff;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Heise\Shariff\Backend;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Http\Request;
use Neos\Flow\Http\Uri;

class BackendFactory
{
    /**
     * @var array
     */
    protected static $supportedServices = [
        'AddThis',
        'Facebook',
        'Flattr',
        'GooglePlus',
        'LinkedIn',
        'Pinterest',
        'Reddit',
        'StumbleUpon',
        'Xing',
    ];

    /**
     * @Flow\InjectConfiguration(path="options")
     * @var array
     */
    protected $options;

    /**
     * @Flow\InjectConfiguration(path="http.baseUri", package="Neos.Flow")
     * @var string
     */
    protected $baseUri;

    /**
     * Auto-detect the domain (if not set) and restrict services to available backends
     */
    public function initializeObject()
    {
        if (!isset($this->options['domains'])) {
            $request = Request::createFromEnvironment();
            if ((string)$this->baseUri !== '') {
                $request->setBaseUri(new Uri($this->baseUri));
            }
            $this->options['domains'] = [$request->getBaseUri()->getHost()];
        }
        $this->options['services'] = array_intersect($this->options['services'], static::$supportedServices);
    }

    /**
     * @return Backend
     */
    public function create()
    {
        return new Backend($this->options);
    }
}
