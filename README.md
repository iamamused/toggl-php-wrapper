Toggl API PHP Wrapper
=====================

[![Build Status](https://travis-ci.org/TinyRocket/toggl-php-wrapper.svg)](https://travis-ci.org/TinyRocket/toggl-php-wrapper) [![Latest Stable Version](https://poser.pugx.org/tinyrocket/toggl/v/stable.svg)](https://packagist.org/packages/tinyrocket/toggl) [![Latest Unstable Version](https://poser.pugx.org/tinyrocket/toggl/v/unstable.svg)](https://packagist.org/packages/tinyrocket/toggl) [![License](https://poser.pugx.org/tinyrocket/toggl/license.svg)](https://packagist.org/packages/tinyrocket/toggl)

A simple PHP 5.3+ wrapper for the the Toggle (v8) and Toggl Reports (v2) API.

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
	
**Get project users **

	$toggl->projects()->getProjectUsers($projectId)
	
**Get a project's tasks**

	$toggl->projects()->getProjectTasks($projectId)

**Delete multiple projects**

	$toggl->projects()->massDeleteProjects(array $projects)
	

### Tags

### Tasks

### Time Entries

### Workspace Users

### Workspaces