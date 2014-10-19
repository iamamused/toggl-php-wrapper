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
 * @subpackage    Tinyrocket\Toggl
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl;


use Tinyrocket\Toggl\Resource\Tags;
use Tinyrocket\Toggl\Resource\Tasks;
use Tinyrocket\Toggl\Resource\Reports;
use Tinyrocket\Toggl\Resource\Projects;
use Tinyrocket\Toggl\Adapter\BuzzAdapter;
use Tinyrocket\Toggl\Resource\Workspaces;
use Tinyrocket\Toggl\Resource\TimeEntries;

/**
 *	Toggl\Toggl
 *
 *	Primary Toggl class. Connects to all individual
 *	resource classes
 */
class Toggl {

	/**
	 *	Chosen Adapter
	 *
	 *	Right now this is set statically using the BuzzAdapter
	 *	class. In the future, more HTTP Adapter options will 
	 *	be available.
	 *
	 *	@var mixed $adapter 	API Adapter
	 */
	public $adapter;

	/**
	 *	Class Constructor
	 *
	 *	Initializes the Toggl class and sets the
	 *	API Token/Adapter for use in all resources
	 *
	 *	@param mixed $token 	Toggl API Token
	 */
	public function __construct($token)
	{
		$this->adapter = new BuzzAdapter($token);
	}

	/**
	 *	Entries
	 *
	 *	Returns instance of Time Entry Resource Class
	 *
	 *	@return Tinyrocket\Resource\TimeEntries
	 */
	public function entries()
	{
		return new TimeEntries($this->adapter);
	}

	/**
	 *	Workspaces
	 *
	 *	Returns instance of Workspace Resource Class
	 *
	 *	@return Tinyrocket\Resource\Workspaces
	 */
	public function workspaces()
	{
		return new Workspaces($this->adapter);
	}

	/**
	 *	Clients
	 *
	 *	Returns instance of the Client Resource Class
	 *
	 *	@return Tinyrocket\Resource\Clients
	 */
	public function clients()
	{
		return new Clients($this->adapter);
	}

	/**
	 *	Projects
	 *
	 *	Returns instance of Project Resource Class
	 *
	 *	@return Tinyrocket\Resource\Projects
	 */
	public function projects()
	{
		return new Projects($this->adapter);
	}

	/**
	 *	Tags
	 *
	 *	Returns instance of Tag Resource Class
	 *
	 *	@return Tinyrocket\Resource\Tags
	 */
	public function tags()
	{
		return new Tags($this->adapter);
	}

	/**
	 *	Reports
	 *
	 *	Returns instance of Report Resource Class
	 *
	 *	@return Tinyrocket\Resource\Reports
	 */
	public function reports($workspace)
	{
		return new Reports($this->adapter, $workspace);
	}

	/**
	 *	Tasks
	 *
	 *	Returns instance of Task Resource Class
	 *
	 *	@return Tinyrocket\Resource\Tasks
	 */
	public function tasks()
	{
		return new Tasks($this->adapter);
	}

}