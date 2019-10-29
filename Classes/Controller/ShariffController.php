<?php
declare(strict_types=1);

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
     * @var Backend
     * @Flow\Inject
     */
    protected $shariff;

    /**
     * @param string $url
     *
     * @return string|false
     */
    public function countsAction(?string $url = null)
    {
        $this->response->setContentType('application/json');

        return json_encode($this->shariff->get($url));
    }
}
