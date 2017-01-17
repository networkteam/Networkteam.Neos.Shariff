<?php
namespace Networkteam\Neos\Shariff;

/***************************************************************
 *  (c) 2015 networkteam GmbH - all rights reserved
 ***************************************************************/

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Uri;

class BackendFactory {

	/**
	 * @Flow\Inject(setting="options")
	 * @var array
	 */
	protected $options;

	/**
	 * @Flow\Inject(setting="http.baseUri", package="TYPO3.Flow")
	 * @var string
	 */
	protected $baseUri;

	/**
	 * @var array
	 */
	protected $supportedServices = array('Facebook', 'Flattr', 'GooglePlus', 'LinkedIn', 'Pinterest', 'Reddit', 'Twitter', 'Xing');

	/**
	 * Auto-detect the domain (if not set) and restrict services to available backends
	 */
	public function initializeObject() {
		if (!isset($this->options['domain']) || $this->options['domain'] === NULL) {
			$request = \TYPO3\Flow\Http\Request::createFromEnvironment();
			if ((string)$this->baseUri !== '') {
				$request->setBaseUri(new Uri($this->baseUri));
			}
			$this->options['domain'] = $request->getBaseUri()->getHost();
		}
		$this->options['services'] = array_intersect($this->options['services'], $this->supportedServices);
	}

	/**
	 * @return \Heise\Shariff\Backend
	 */
	public function create() {
		return new \Heise\Shariff\Backend(
			$this->options
		);
	}

}
