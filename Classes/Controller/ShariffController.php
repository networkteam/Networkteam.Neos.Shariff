<?php
namespace Networkteam\Neos\Shariff\Controller;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Heise\Shariff\Backend;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class ShariffController extends ActionController
{
    /**
     * @var string[]
     */
    protected $supportedMediaTypes = ['application/json'];

    /**
     * @Flow\Inject
     * @var Backend
     */
    protected $shariff;

    /**
     * @param string $url
     * @return string
     */
    public function countsAction(string $url = null) : string
    {
        $this->response->getHeaders()->set('Content-Type', 'application/json');

        return json_encode($this->shariff->get($url));
    }
}
