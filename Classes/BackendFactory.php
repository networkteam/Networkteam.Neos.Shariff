<?php
namespace Networkteam\Neos\Shariff;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Heise\Shariff\Backend;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Request;
use TYPO3\Flow\Http\Uri;

class BackendFactory
{
    /**
     * @Flow\InjectConfiguration(path="options")
     * @var array
     */
    protected $options;

    /**
     * @Flow\InjectConfiguration(path="http.baseUri", package="TYPO3.Flow")
     * @var string
     */
    protected $baseUri;

    /**
     * @var array
     */
    protected $supportedServices = [
        'Facebook',
        'Flattr',
        'GooglePlus',
        'LinkedIn',
        'Pinterest',
        'Reddit',
        'Twitter',
        'Xing'
    ];

    /**
     * Auto-detect the domain (if not set) and restrict services to available backends
     */
    public function initializeObject()
    {
        if (!isset($this->options['domain'])) {
            $request = Request::createFromEnvironment();
            if ((string)$this->baseUri !== '') {
                $request->setBaseUri(new Uri($this->baseUri));
            }
            $this->options['domain'] = $request->getBaseUri()->getHost();
        }
        $this->options['services'] = array_intersect($this->options['services'], $this->supportedServices);
    }

    /**
     * @return Backend
     */
    public function create()
    {
        return new Backend($this->options);
    }
}
