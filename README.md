Toggl API PHP Wrapper
=====================

[![Build Status](https://travis-ci.org/TinyRocket/toggl-php-wrapper.svg)](https://travis-ci.org/TinyRocket/toggl-php-wrapper) [![Latest Stable Version](https://poser.pugx.org/tinyrocket/toggl/v/stable.svg)](https://packagist.org/packages/tinyrocket/toggl) [![Latest Unstable Version](https://poser.pugx.org/tinyrocket/toggl/v/unstable.svg)](https://packagist.org/packages/tinyrocket/toggl) [![License](https://poser.pugx.org/tinyrocket/toggl/license.svg)](https://packagist.org/packages/tinyrocket/toggl)

A simple PHP 5.3+ wrapper for the the Toggle (v8) and Toggl Reports (v2) API.
> **Note:** This package is still in the beta phase of development. Right now, it does not provide backwards compatability for older versions of the Toggl API, though it is planned. 

## Installation

The easiest way to install the Toggl Wrapper is via [Composer](https://getcomposer.org/download/)

	curl -sS https://getcomposer.org/installer | php
	
Then require the wrapper

	composer require tinyrocket/toggl
	
Or using your **composer.json** file
	
	"require": {
		...
		"tinyrocket/toggl": "dev-master"
		...
	}
	
Finally, make sure to require the composer auto
	
	require 'vendor/autoload.php';
	
## Getting Started

The wrapper requires an active API token. This can obtained by visiting your Toggl Profile Settings page. This should be passed through the constructor of the Toggl class.

	$toggl = new \Tinyrocket\Toggl\Toggl('api_token')
	
### Clients
Clients provides the ability to get, update and delete clients for a give a given project. [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/clients.md)

	$toggl->clients()
	
**Get clients list**

	$toggl->clients()->getClients()
	
**Get a single client**

	$toggl->clients()->getClient($clientId)

**Update a client**

	$toggl->clients()->updateClient($clientId, $name, $notes)

**Delete Client**

	$toggl->clients()->deleteClient($clientId)

**Get Client Projects**

	$toggl->clients()->getClientProjects($clientId, $status)

### Dashboard
The Dashboard provides an overview of user and project activity for a given workspace. [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/dashboard.md)

	$toggl->workspaces()->getDashboard($workspaceId)

### Projects
Projects provides the ability to get, create update and delete client projects [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/projects.md)

**Get all projects visible to a user**

	$toggl->projects()->getProjects()

**Get a single project by ID**

	$toggl->projects()->getProject($projectId)

**Get a project by name**

	$toggl->projects()->getProjectByName($name)
	
**Update a project**

	$toggl->projects()->updateProject($projectId, $name, $additionalParams)
	
**Delete a project**

	$toggl->projects()->deleteProject($projectId)
	
**Get project users**

	$toggl->projects()->getProjectUsers($projectId)
	
**Get a project's tasks**

	$toggl->projects()->getProjectTasks($projectId)

**Delete multiple projects**

	$toggl->projects()->massDeleteProjects(array $projects)
	

### Tags
Tags provides the ability to get, create and delete time entry tags [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/tags.md)

**Get a list of available tags**

	$toggl->tags()->getTags()

**Create a tag for a given workspace**

	$toggl->tags()->createTag($workspaceId, $name)

**Delete a tag**

	$toggl->tags()->deleteTag($tagId)

**Get tags by workspace**

	$toggl->tags()->getWorkspaceTags($workspaceId)

### Tasks
Tasks provides the ability to get, add, update and remove tasks for a given project [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/tasks.md)

**Create a task**

	$toggl->tasks()->createTask($projectId, $name, $additional)

**Get a task by ID**

	$toggl->tasks()->getTask($taskId)

**Update a task**

	$toggl->tasks()->updateTask($taskId, $data, $fields)

**Delete a task**

	$toggl->tasks()->deleteTask($taskId)

**Update multiple tasks**

	$toggl->tasks()->massUpdateTasks($tasks, $data, $fields)

**Delete multiple tasks**

	$toggl->tasks()->massDeleteTasks($tasks)
	
### Time Entries
Time Entries provides the ability to add, edit and delete time entries. It also allows you to start a new time entry, as well as stop an active entries. [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/time_entries.md)

**Get time entries**

	$toggl->entries()->getTimeEntries()

**Get active time entry**

	$toggl->entries()->getCurrentTimeEntry()

**Get time entry details**

	$toggl->entries()->getTimeEntryDetails($entryId)

**Start a new time entry**

	$toggl->entries()->startTimeEntry($description, $projectId, $billable,  $tags, $addtionalParams)

**Stop a time entry**

	$toggl->entries()->stopTimeEntry($entryId)

**Delete a time entry**

	$toggl->entries()->deleteTimeEntry($entryId)

**Update a time entry**

	$toggl->entries()->updateTimeEntry($entryId, $description, $projectId, $billable,  $tags)

**Get time entries by date range**

	$toggl->entries()->getTimeEntriesByRange($startDate, $endDate)

**Mass update time entry tags**

	$toggl->entries()->massUpdateTimeEntryTags($entries, $tags, $action)
	
### Workspaces
Workspaces provides the ability to add, edit and delete workspaces available to a user. [See Docs](https://github.com/toggl/toggl_api_docs/blob/master/chapters/workspaces.md)

**Get visisible workspaces**

	$toggl->workspaces()->getWorkspaces()

**Get a single workspace by ID**

	$toggl->workspaces()->getWorkspace($workspaceId)

**Update a workspace**

	$toggl->workspaces()->updateWorkspace($workspaceId, $name, $addtional)

**Get workspace Users**

	$toggl->workspaces()->getWorkspaceUsers($workspaceId)

**Get workspace clients**

	$toggl->workspaces()->getWorkspaceClients($workspaceId)

**Get workspace projects**

	$toggl->workspaces()->getWorkspaceProjects($workspaceId)

**Get workspace tasks**

	$toggl->workspaces()->getWorkspaceTasks($workspaceId, $status)

**Get workspace tags**

	$toggl->workspaces()->getWorkspaceTags($workspaceId)

**Invite users to a workspace**

	$toggl->workspaces()->invite($workspaceId, $emails)

**Get a workspace by name**

	$toggl->workspaces()->getWorkspaceByName($name)

**Get user by email**

	$toggl->workspaces()->getUserByEmail($workspaceId, $email)

**Get dashboard stats**

	$toggl->workspaces()->getDashboard($workspaceId)