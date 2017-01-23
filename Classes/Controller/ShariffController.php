<?php
namespace Networkteam\Neos\Shariff\Controller;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use Heise\Shariff\Backend;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;

class ShariffController extends ActionController
{
    /**
     * @var Backend
     * @Flow\Inject
     */
    protected $shariff;

    /**
     * @param string $url
     *
     * @return string
     */
    public function countsAction($url = null)
    {
        $this->response->getHeaders()->set('Content-Type', 'application/json');

        return json_encode($this->shariff->get($url));
    }
}
