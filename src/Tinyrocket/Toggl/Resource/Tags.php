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
 * @subpackage    Tinyrocket\Toggl\Resource\Tags
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

/**
 *	Tinyrocket\Toggl\Resource\Tags
 *
 *	Collection of Workspace related actions
 *	@see https://github.com/toggl/toggl_api_docs/blob/master/chapters/workspaces.md
 */
class Tags extends AbstractResource {

	/**
	 *	Get Tags
	 *
	 *	Returns a list of available tags for all workspaces
	 */
	public function getTags()
	{
		foreach ( $this->getWorkspaces() as $workspace ) {
			if ( count($this->getWorkspaceTags($workspace->id)) ) {
				foreach ( $this->getWorkspaceTags($workspace->id) as $tag ) {
					$tags[] = $tag;
				}
			}
		}

		return $tags;
	}

	/**
	 *	Create Workspace Tag
	 *
	 *	Creates a single tag for a given workspace
	 *
	 *	@param int 		$workspaceId 		Workspace Identifier
	 *	@param string 	$name 				Tag Name
	 */
	public function createTag($workspaceId, $name)
	{
		$tag = json_encode(array('tag' => array(
			'wid'	=>	$workspaceId,
			'name'	=>	$name,
		)));

		return $this->adapter->post(sprintf('%s/tags', $this->endpoint), array(), $tag);
	}

	/**
	 *	Delete Tag
	 *
	 *	Removes a single tag
	 *
	 *	@param int 	$tagId 		Tag Identifier
	 */
	public function deleteTag($tagId)
	{
		return $this->adapter->delete(sprintf('%s/tags/%s', $this->endpoint, $tagId));
	}

	/**
	 *	Get Workspace Projects
	 *
	 *	Returns a list of available projects for a given workspace
	 *
	 *	@param int $workspaceId 		Workspace Identifier
	 *	@return object
	 */
	public function getWorkspaceTags($workspaceId)
	{
		$workspace = new \Tinyrocket\Toggl\Resource\Workspaces($this->adapter);

		return $workspace->getWorkspaceTags($workspaceId);
	}

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
		$workspace = new \Tinyrocket\Toggl\Resource\Workspaces($this->adapter);
	
		return $workspace->getWorkspaces();
	}
}