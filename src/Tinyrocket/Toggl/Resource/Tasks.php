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
 * @subpackage    Tinyrocket\Toggl\Resource\Tasks
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

/**
 *	Tinyrocket\Toggl\Resource\Tasks
 *
 *	Collection of Workspace related actions
 *	@see https://github.com/toggl/toggl_api_docs/blob/master/chapters/tasks.md
 */
class Tasks extends AbstractResource {

	/**
	 *	Create a Task
	 *
	 *	@param string $name 		Task Name
	 *	@param int 	  $projectId 	Project ID
	 *	@param array  $additional 	Additional parameters
	 */
	public function createTask($projectId, $name, $additional = array() )
	{
		$task = array('task' => array('name' => $name, 'pid' => $projectId));
		
		if ( count($additional) ) {
			$project['task'] = array_merge($task['task'], $additional);
		}

		$task = json_encode($task);
		$this->adapter->post(sprintf('%s/tasks', $this->endpoint), array(), $task);
	}

	/**
	 *	Get Task
	 *
	 *	Returns a single task based on supplied identifier
	 *
	 *	@param int $taskId 		Task Identifier
	 */
	public function getTask($taskId)
	{
		return $this->adapter->get(sprintf('%s/tasks/%s', $this->endpoint, $taskId));
	}

	/**
	 *	Update Tasks
	 *
	 *	Updates task data
	 *
	 *	@param int $taskId 		Task Identifier
	 *	@param array $data  	Updated Task Data
	 *	@param array $fields  	Updated Task Fields
	 */
	public function updateTask($taskId, $data = array(), $fields = array())
	{
		$data['fields'] = $fields;
		$task = json_encode(array('task' => $data));

		$this->adapter->put(sprintf('%s/tasks/%s', $this->endpoint, $taskId), array(), $task);
	}

	/**
	 *	Delete Task
	 *
	 *	Removes a single task based on supplied identifier
	 *
	 *	@param int $taskId 		Task Identifier
	 */
	public function deleteTask($taskId)
	{
		return $this->adapter->delete(sprintf('%s/tasks/%s', $this->endpoint, $taskId));
	}

	/**
	 *	Mass Update Tasks
	 *
	 *	Updates mutiple tasks
	 *
	 *	@param array $tasks 	Array of Task Identifiers
	 *	@param array $data  	Updated Task Data
	 *	@param array $fields  	Updated Task Fields
	 */
	public function massUpdateTasks(array $tasks, $data = array(), $fields = array())
	{
		$tasks = implode(',', $tasks);
		$data['fields'] = $fields;
		$task = json_encode(array('task' => $data));

		$this->adapter->put(sprintf('%s/tasks/%s', $this->endpoint, $tasks), array(), $task);
	}

	/**
	 *	Mass Delete Tasks
	 *
	 *	Removes multiple tasks based on supplied identifiers
	 *
	 *	@param array $tasks 		Task Identifiers
	 */
	public function massDeleteTasks(array $tasks)
	{
		$tasks = implode(',', $tasks);
		return $this->adapter->delete(sprintf('%s/tasks/%s', $this->endpoint, $tasks));
	}
	
}