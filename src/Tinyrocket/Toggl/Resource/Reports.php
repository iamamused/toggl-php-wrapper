<?php 
/**
 * This file is part of the Toggl package
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.  It is also available at
 * the following URL: http://www.opensource.org/licenses/BSD-3-Clause
 *
 * @subpackage    Tinyrocket\Toggl\Resource\Reports
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

/**
 *	Tinyrocket\Toggl\Resource\Reports
 *
 *	Collection of Workspace related actions
 *	@see https://github.com/toggl/toggl_api_docs/tree/master/reports
 */
class Reports extends AbstractResource {

	/**
	 *	@var int $workspace 		Workspace used for reports
	 */
	protected $workspace;

	/**
	 *	Constructor
	 *
	 *	Used to reset the endpoint for the BuzzAdapter
	 *
	 *	@param mixed  $adapter 		Adpater chosen during initialization
	 *	@param int    $workspace 	Workspace used for reports
	 *	@param string $user_agent 	Require User Agento
	 */
	public function __construct($adapter, $workspace)
	{
		$this->workspace = $workspace;

		parent::__construct($adapter, 'https://toggl.com/reports/api/v2');
	}
	
	/**
	 *	Get Weekly Report
	 *
	 *	Notes
	 *
	 *	@param array $params 		Params passed to search
	 */
	public function getWeeklyReport($params = array()) 
	{
		$constructed = $this->getConstructedUrl(sprintf('%s/weekly', $this->endpoint), $params);

		return $this->adapter->get($constructed);
	}
	
	/**
	 *	Get Weekly Report
	 *
	 *	Notes
	 *
	 *	@param array $params 		Params passed to search
	 */	
	public function getDetailedReport($params = array()) 
	{
		$constructed = $this->getConstructedUrl(sprintf('%s/details', $this->endpoint), $params);
		
		return $this->adapter->get($constructed);
	}
	
	/**
	 *	Get Weekly Report
	 *
	 *	Notes
	 *
	 *	@param array $params 		Params passed to search
	 */	
	public function getSummaryReport($params = array()) 
	{
		$constructed = $this->getConstructedUrl(sprintf('%s/summary', $this->endpoint), $params);
		
		return $this->adapter->get($constructed);
	}

	/**
	 *	URL Helper
	 *
	 *	Builds and returns a query url
	 *
	 *	@param string $url  	Endpoint
	 *	@param array  $params 	Params for Query String
	 */
	protected function getConstructedUrl($url, $params)
	{
		if ( !array_key_exists('workspace_id', $params) ) {
			$params['workspace_id']	= $this->workspace;
		}

		$query = http_build_query($params);

		return rtrim($url, '/') . '?' . $query;
	}

}