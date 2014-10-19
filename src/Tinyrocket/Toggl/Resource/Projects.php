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
 * @subpackage    Tinyrocket\Toggl\Resource\Projects
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

use Tinyrocket\Toggl\Resource\Workspaces;

/**
 *	Tinyrocket\Toggl\Resource\Projects
 *
 *	Collection of Workspace related actions
 *	@see https://github.com/toggl/toggl_api_docs/blob/master/chapters/projects.md
 */
class Projects extends AbstractResource {

	/**
	 *	Get Projects
	 *
	 *	Returns a list of available projects for the current user
	 */
	public function getProjects()
	{
		foreach ( $this->getWorkspaces() as $workspace ) {
			if ( count($this->getWorkspaceProjects($workspace->id)) ) {
				foreach ( $this->getWorkspaceProjects($workspace->id) as $project ) {
					$projects[] = $project;
				}
			}
		}

		return $projects;
	}

	/**
	 *	Get Project
	 *
	 *	Returns a single project based on supplied identifier
	 *
	 *	@param int $projectId		Project Identifier
	 */
	public function getProject($projectId)
	{
		return $this->adapter->get(sprintf('%s/projects/%s', $this->endpoint, $projectId));
	}

	/**
	 *	Get Project By Name
	 *
	 *	Returns a single project 
	 *
	 *	@param string $name 		Project Name
	 */
	public function getProjectByName($name)
	{
		foreach ( $this->getProjects() as $project ) {
			if ( strpos($project->name, $name) !== false ) {
				return $project;
			}
		}
		
		throw new \Exception("Project [$name] not found");
	}

	/**
	 *	Update Project
	 *
	 *	Updates a single project
	 *
	 *	@param int    $projectId		Project Identifier
	 *	@param string $name 			Updated Project Name
	 *	@param array  $additional 		Additional Parameters
	 */
	public function updateProject($projectId, $name = '', array $additional = array())
	{
		$project = array('project' => array('name' => $name));
		
		if ( count($additional) ) {
			$project['project'] = array_merge($project['project'], $additional);
		}

		$project = json_encode($project);

		return $this->adapter->put(sprintf('%s/projects/%s', $this->endpoint, $projectId), array(), $project);
	}

	/**
	 *	Delete Project
	 *
	 *	Removes a single project from a given workspace
	 *
	 *	@param int    $projectId		Project Identifier
	 */
	public function deleteProject($projectId)
	{
		return $this->adapter->delete(sprintf('%s/projects/%s', $this->endpoint, $projectId));
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
		$workspace = new \Tinyrocket\Toggl\Resource\Workspaces($this->adapter);

		return $workspace->getWorkspaceProjects($workspaceId);
	}

	/**
	 *	Get Project Users
	 *
	 *	Returns a list of active users for a given project
	 *
	 *	@param int $projectId 		Project Identifier
	 */
	public function getProjectUsers($projectId)
	{
		return $this->adapter->get(sprintf('%s/projects/%s/project_users', $this->endpoint, $projectId));
	}

	/**
	 *	Mass Delete Projects
	 *
	 *	Removes multiple projects from a given workspace
	 *
	 *	@param array $projects 		Array of project ID's
	 */
	public function massDeleteProjects(array $projects)
	{
		$projects = implode(',', $projects);

		return $this->adapter->delete(sprintf('%s/projects/%s', $this->endpoint, $projects));
	}

	/**
	 *	Get Project Tasks
	 *
	 *	Returns a list of active tasks for a given project
	 *
	 *	@param int $projectId 		Project Identifier
	 */
	public function getProjectTasks($projectId)
	{
		return $this->adapter->get(sprintf('%s/projects/%s/tasks', $this->endpoint, $projectId));
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