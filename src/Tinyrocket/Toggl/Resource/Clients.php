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
 * @subpackage    Tinyrocket\Toggl\Resource\Clients
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

/**
 *	Tinyrocket\Toggl\Resource\Clients
 *
 *	Collection of Workspace related actions
 *	@see https://github.com/toggl/toggl_api_docs/blob/master/chapters/workspaces.md
 */
class Clients extends AbstractResource {

	/**
	 *	Get Clients
	 *
	 *	Returns a list of clients visible to the current user
	 */
	public function getClients()
	{
		return $this->adapter->get(sprintf('%s/clients', $this->endpoint));
	}

	/**
	 *	Get Client
	 *
	 *	Returns a single client based on identifier
	 *
	 *	@param int $clientId 			Client Identifier
	 */
	public function getClient($clientId)
	{
		return $this->adapter->get(sprintf('%s/clients/%s', $this->endpoint, $clientId));
	}

	/**
	 *	Update Client
	 *
	 *	Updates a given client
	 *
	 *	@param int    $clientId 		Client Identifier
	 *	@param string $name 			New name for client
	 *	@param string $notes 			New client notes
	 */
	public function updateClient($clientId, $name = '', $notes = '')
	{
		$client = array('client' => array(
			'name'	=>	$name,
			'notes' =>	$notes,
		));

		$client = json_encode($client);

		return $this->adapter->put(sprintf('%s/clients/%s', $this->endpoint, $clientId), array(), $client);
	}

	/**
	 *	Delete Client
	 *
	 *	Removes a given client completely
	 *
	 *	@param int    $clientId 		Client Identifier
	 */
	public function deleteClient($clientId)
	{
		return $this->adapter->delete(sprintf('%s/clients/%s', $this->endpoint, $clientId));
	}

	/**
	 *	Get Client Projects
	 *
	 *	Returns a list of projects assigned to a given client
	 *
	 *	@param int    $clientId 		Client Identifier
	 *	@param string $status 			Project Status
	 */
	public function getClientProjects($clientId, $status = 'both')
	{
		return $this->adapter->get(sprintf('%s/clients/%s/projects?active=%s', $this->endpoint, $clientId, $status));
	}
}