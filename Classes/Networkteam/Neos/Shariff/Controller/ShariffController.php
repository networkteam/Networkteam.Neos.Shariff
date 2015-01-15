<?php
namespace Networkteam\Neos\Shariff\Controller;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use TYPO3\Flow\Annotations as Flow;

class ShariffController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @var \Heise\Shariff\Backend
	 * @Flow\Inject
	 */
	protected $shariff;

	/**
	 * @param string $url
	 */
	public function countsAction($url = NULL) {
		$this->response->getHeaders()->set('Content-Type', 'application/json');
		return json_encode($this->shariff->get($url));
	}
}