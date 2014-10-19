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
 * @subpackage    Tinyrocket\Toggl\Resource\Workspaces
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

/**
 *	Tinyrocket\Toggl\Resource\Workspaces
 *
 *	Collection of Workspace related actions
 *	@see https://github.com/toggl/toggl_api_docs/blob/master/chapters/workspaces.md
 */
class Workspaces extends AbstractResource {


	/**
	 *	Get Workspaces
	 *
	 *	Returns a list of available workspaces for 
	 *	the authorized API user
	 *
	 *	@return object
	 */
	public function getWorkspaces()
	{
		return $this->adapter->get(sprintf('%s/workspaces', $this->endpoint));
	}

	/**
	 *	Get Workspace
	 *
	 *	Returns a single workspace
	 *
	 *	@param int $workspaceId 	Workspace Identifier
	 *	@return $object
	 */
	public function getWorkspace($workspaceId)
	{
		return $this->adapter->get(sprintf('%s/workspaces/%s', $this->endpoint, $workspaceId));
	}

	/**
	 *	Update Workspace
	 *
	 *	Updates a single workspace
	 *
	 *	@param int 		$workspaceId		Workspace Identifier
	 *	@param string 	$name 				Workspace Name
	 *	@param array 	$addtional 			Additional Parameters
	 *
	 *	@return object
	 */
	public function updateWorkspace($workspaceId, $name, $addtional = array())
	{
		$workspace = array('workspace' => array('name'	=>	$name));

		if ( count($addtional) ) {
			$workspace['workspace'] = array_merge($workspace['workspace'], $addtional);
		}

		$workspace = json_encode($workspace);

		return $this->adapter->put(sprintf('%s/workspaces/%s', $this->endpoint, $workspaceId), array(), $workspace);
	}

	/**
	 *	Get Workspace Users
	 *
	 *	Returns a list of available users for a given workspace
	 *
	 *	@param int $workspaceId 		Workspace Identifier
	 *	@return object
	 */
	public function getWorkspaceUsers($workspaceId)
	{
		return $this->adapter->get(sprintf('%s/workspaces/%s/users', $this->endpoint, $workspaceId));
	}

	/**
	 *	Get Workspace Clients
	 *
	 *	Returns a list of available clients for a given workspace
	 *
	 *	@param int $workspaceId 		Workspace Identifier
	 *	@return object
	 */
	public function getWorkspaceClients($workspaceId)
	{
		return $this->adapter->get(sprintf('%s/workspaces/%s/clients', $this->endpoint, $workspaceId));
	}

	/**
	 *	Get Workspace Projects
	 *
	 *	Returns a list of available projects for a given workspace
	 *
	 *	@param int $workspaceId 		Workspace Identifier
	 *	@return object
	 */
	public function getWorkspaceProjects($workspaceId)
	{
		return $this->adapter->get(sprintf('%s/workspaces/%s/projects', $this->endpoint, $workspaceId));
	}

	/**
	 *	Get Workspace Tasks
	 *
	 *	Returns a list of available tasks for a given workspace
	 *
	 *	@param int    $workspaceId 		Workspace Identifier
	 *	@param string $status 			Task Status 
	 *	@return object
	 */
	public function getWorkspaceTasks($workspaceId, $status = 'both')
	{
		return $this->adapter->get(sprintf('%s/workspaces/%s/tasks?active=%s', $this->endpoint, $workspaceId, $status));
	}

	/**
	 *	Get Workspace Tags
	 *
	 *	Returns a list of available tags for a given workspace
	 *
	 *	@param int    $workspaceId 		Workspace Identifier
	 *	@param string $status 			Task Status 
	 *	@return object
	 */
	public function getWorkspaceTags($workspaceId)
	{
		return $this->adapter->get(sprintf('%s/workspaces/%s/tags', $this->endpoint, $workspaceId));
	}

	/**
	 *	Invite Workspace Users
	 *
	 *	Invites a user or users to a given workspace
	 *
	 *	@param int    $workspaceId 		Workspace Identifierc
	 *	@param array  $emails 			Array of emails
	 *	@return object
	 */
	public function invite($workspaceId, array $emails)
	{
		$emails = json_encode(array('emails' => $emails));

		return $this->adapter->post(sprintf('%s/workspaces/%s/invite', $this->endpoint, $workspaceId), array(), $emails);
	}

	/**
	 *	Get Workspace By Name
	 *
	 *	Loads a workspace by name
	 *
	 *	@param string $name 	Search Name
	 */
	public function getWorkspaceByName($name)
	{
		foreach ( $this->getWorkspaces() as $workspace ) {
			if ( strpos($workspace->name, $name) !== false ) {
				return $workspace;
			}
		}

		throw new \Exception('Workspace not found');
	}

	/**
	 *	Get Workspace By Name
	 *
	 *	Loads a workspace user by their email
	 *
	 *	@param int    $workspaceId 		Workspace Identifierc
	 *	@param string $email 	Search Email
	 */
	public function getUserByEmail($workspaceId, $email)
	{
		foreach ( $this->getWorkspaceUsers($workspaceId) as $user ) {
			if ( strpos($user->email, $email) !== false ) {
				return $user;
			}
		}

		throw new \Exception('User not found for this workspace');
	}

	/**
	 *	Get Dashboard
	 *
	 *	Loads dashboard data
	 *
	 *	@param int    $workspaceId 		Workspace Identifierc
	 */
	public function getDashboard($workspaceId)
	{
		return $this->adapter->get(sprintf('%s/dashboard/%s', $this->endpoint, $workspaceId));
	}


}