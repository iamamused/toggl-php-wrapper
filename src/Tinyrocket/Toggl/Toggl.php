<?php namespace Tinyrocket\Toggl;

use Tinyrocket\Toggl\Adapter\BuzzAdapter;
use Tinyrocket\Toggl\Resource\TimeEntries;
use Tinyrocket\Toggl\Resource\Workspaces;
use Tinyrocket\Toggl\Resource\Projects;


class Toggl {

	/**
	 *	Chosen Adapter
	 *
	 *	@var mixed $adapter 	API Adapter
	 */
	public $adapter;

	public function __construct($token)
	{
		$this->adapter = new BuzzAdapter($token);
	}

	public function entries()
	{
		return new TimeEntries($this->adapter);
	}

	public function workspaces()
	{
		return new Workspaces($this->adapter);
	}

	public function clients()
	{
		return new Clients($this->adapter);
	}

	public function projects()
	{
		return new Projects($this->adapter);
	}

}