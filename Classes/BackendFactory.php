<?php
declare(strict_types=1);

namespace Networkteam\Neos\Shariff;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Uri;
use Heise\Shariff\Backend;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Utility\Environment;
use Neos\Utility\Files;

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
     * @Flow\Inject
     * @var Environment
     */
    protected $environment;

    /**
     * Auto-detect the domain (if not set) and restrict services to available backends
     */
    public function initializeObject() : void
    {
        if (!isset($this->options['domains'])) {
            $request = ServerRequest::fromGlobals();
            if ((string)$this->baseUri !== '') {
                $request = $request->withUri(new Uri($this->baseUri));
            }
            $this->options['domains'] = [$request->getUri()->getHost()];
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
