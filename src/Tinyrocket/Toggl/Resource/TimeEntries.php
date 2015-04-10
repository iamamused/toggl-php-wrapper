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
 * @subpackage    Tinyrocket\Toggl\Resource\TimeEntries
 * @version       1.0.0
 * @author        TinyRocket <michael@tinyrocket.co>
 * @license       BSD License (3-clause)
 * @copyright     Copyright 2014 TinyRocket
 * @link          http://tinyrocket.co/Toggl
 */
namespace Tinyrocket\Toggl\Resource;

/**
 *	Tinyrocket\Toggl\Resource\TimeEntries
 *
 *	Collection of Time Entry related actions
 *	@see https://github.com/toggl/toggl_api_docs/blob/master/chapters/time_entries.md
 */
class TimeEntries extends AbstractResource {

	/**
	 *	Get Time Entries
	 *
	 *	Returns a list of all active time entries
	 *	for a user. Depends on API Token
	 *
	 *	@return object
	 */
	public function getTimeEntries()
	{
		return $this->adapter->get(sprintf('%s/time_entries', $this->endpoint));
	}

	/**
	 *	Create Time Entry
	 *
	 *	Creates a new time entry based on supplied data array
	 *
	 *	@param array $data 		New Time ENtry Data
	 */
	public function createTimeEntry(array $data = array() )
	{
		$data = json_encode(array('time_entry' => $data));
		return $this->adapter->post(sprintf('%s/time_entries', $this->endpoint), array(), $data);
	}

	/**
	 *	Get Current Time Entry
	 *
	 *	Returns current (running) time entry
	 *
	 *	@return object
	 */
	public function getCurrentTimeEntry()
	{
		return $this->adapter->get(sprintf('%s/time_entries/current', $this->endpoint));
	}

	/**
	 *	Get Time Entry Details
	 *
	 *	Returns detailed information for an individual entry
	 *
	 *	@param int $entryId 	Time Entry Identifier
	 *	@return object
	 */
	public function getTimeEntryDetails($entryId)
	{
		return $this->adapter->get(sprintf('%s/time_entries/%s', $this->endpoint, $entryId));
	}

	/**
	 *	Start Time Entry
	 *
	 *	Starts a new time entry 
	 *
	 *	@param string $description 			Time Entry Description
	 *	@param int    $pid 					Time Entry Project ID
	 *	@param bool   $billable				Whether entry is billable or not
	 *	@param array  $tags 				Array of tags for time entry
	 *	@param array  $additional 			Addtional parameters to pass to entry
	 *
	 *	@return object
	 */
	public function startTimeEntry($description = '', $pid = null, $billable = false,  $tags = array(), $addtional = array())
	{
		$entry = array('time_entry' => array(
			'description'           =>	$description,
			'tags'			=>	$tags,
			'pid'			=>	$pid,
			'billable'		=>	$billable,
			'created_with'          =>	'Tinyrocket/toggl-php-wrapper',
		));

		$entry = json_encode($entry);

		return $this->adapter->post(sprintf('%s/time_entries/start', $this->endpoint), array(), $entry);
	}

	/**
	 *	Stop Time Entry
	 *
	 *	Stops a time entry by current or identifier
	 *
	 *	@param int $entryId  	Time Entry Identifier
	 *	@return object
	 */
	public function stopTimeEntry($entryId = null)
	{
		if ( is_null($entryId) ) {
			$entryId = $this->getCurrentTimeEntry()->data->id;
		}
		return $this->adapter->put(sprintf('%s/time_entries/%s/stop', $this->endpoint, $entryId));
	}

	/**
	 *	Delete Time Entry
	 *
	 *	Removes/Deletes a time entry
	 *
	 *	@param int $entryId 	Time Entry Identifier
	 *	@return $object
	 */
	public function deleteTimeEntry($entryId)
	{
		return $this->adapter->delete(sprintf('%s/time_entries/%s', $this->endpoint, $entryId));
	}

	/**
	 *	Update Time Entry
	 *
	 *	Updates a time entry
	 *
	 *	@param int 		$entryId 				Time Entry Identifier
	 *	@param array 	$data 					Updated fields
	 *	@return $object
	 */
	public function updateTimeEntry($entryId, array $data = array())
	{
		$entry = array('time_entry' => $data);

		$entry = json_encode($entry);

		return $this->adapter->put(sprintf('%s/time_entries/%s', $this->endpoint, $entryId), array(), $entry);
	}

	/**
	 *	Get Time Entries By Range
	 *
	 *	Returns a list of time entries for a given range
	 *	Defaults to today if no end date is provided
	 *
	 *	@param string $startDate 	Beginning date for range
	 *  @param string $endDate 		Ending date for range
	 *	@return object
	 */
	public function getTimeEntriesByRange($startDate, $endDate = null)
	{
		if ( is_null($endDate) ) {
			$endDate = date('Y-m-d');
		}

		$data = array(
			'start_date' => date('c', strtotime($startDate)),
			'end_date'   => date('c', strtotime($endDate)),
		);

		$query = http_build_query($data);

		return $this->adapter->get(sprintf('%s/time_entries?%s', $this->endpoint, $query));

	}

	/**
	 *	Mass Update Time Entry Tags
	 *
	 *	Bulk updates time entries based on an array of entries
	 *	provided. Entries can either have tags added or removed based
	 *	on the action provided
	 *
	 *	@param array  $entries 		Array of entry identifiers
	 *	@param array  $tags 		Array of tags
	 * 	@param string $action 		What to do with tags
	 */
	public function massUpdateTimeEntryTags(array $entries, array $tags, $action = 'add')
	{
		$entries = implode(',', $entries);
		$entry = array('time_entry' => array(
			'tags'			=>	$tags,
			'tag_action'	=>	$action,
		));

		$entry = json_encode($entry);
		
		return $this->adapter->put(sprintf('%s/time_entries/%s', $this->endpoint, $entries), array(), $entry);
	}
}
