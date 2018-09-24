<?php
namespace Networkteam\Neos\Shariff;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Heise\Shariff\Backend;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Http\Request;
use Neos\Flow\Http\Uri;
use Neos\Flow\Utility\Environment;
use Neos\Utility\Files;

class BackendFactory
{
    /**
     * @var string[]
     */
    protected static $supportedServices = [
        'AddThis',
        'Facebook',
        'Flattr',
        'LinkedIn',
        'Pinterest',
        'Reddit',
        'StumbleUpon',
        'Xing',
        'Vk',
    ];

    /**
     * @Flow\InjectConfiguration(path="http.baseUri", package="Neos.Flow")
     * @var string
     */
    protected $baseUri;

    /**
     * @Flow\Inject
     * @var Environment
     */
    protected $environment;

    /**
     * @Flow\InjectConfiguration(path="options")
     * @var mixed[]
     */
    protected $options;

    /**
     * Auto-detect the domain (if not set) and restrict services to available backends
     *
     * @return void
     */
    public function initializeObject()
    {
        if (!isset($this->options['domains'])) {
            $this->options['domains'] = [
                (
                    (string)$this->baseUri !== '' ? new Uri($this->baseUri) : Request::createFromEnvironment()->getUri()
                )->getHost(),
            ];
        }
        $this->options['services'] = array_intersect($this->options['services'], static::$supportedServices);

        $cacheDir = $this->environment->getPathToTemporaryDirectory() . '/Networkteam_Neos_Shariff';
        Files::createDirectoryRecursively($cacheDir);
        $this->options['cache']['cacheDir'] = $cacheDir;
    }

    /**
     * @return Backend
     */
    public function create() : Backend
    {
        return new Backend($this->options);
    }
}
