<?php

namespace App\Model\Parser;

/**
 * parses the response of the jira endpoint to a clean uniform data set
 *
 * Class JiraParser
 * @package Debra\Model\Parser
 */
class JiraParser
{
	/**
	 * parses the jira response and returns clean data set
	 *
	 * @param mixed[] $data
	 * @return mixed[]
	 */
	public function parseJiraIssue($data)
	{
		$cleanData = array();

		// extract key
		$cleanData['key'] = $data['key'];
		// extract summary
		$cleanData['summary'] = $data['fields']['summary'];
		// extract issue type by name
		$cleanData['issuetype'] = $data['fields']['issuetype']['name'];
		// extract issue type by name
		$cleanData['issuetypeId'] = $data['fields']['issuetype']['id'];
		// extract PorjectKey
		$cleanData['projectKey'] = $data['fields']['project']['key'];
		// extract devTeam
		$cleanData['devTeam'] = $data['fields'][config('jira.devTeam')]['name'];
		// extract Reporter
		$cleanData['reporter'] = $data['fields']['reporter']['displayName'];

		// extract sprint name
		if (preg_match("/,name=([^,]+),/mi", $data['fields']['customfield_10560'][0], $match)) {
			$cleanData['sprint'] = $match[1];
		} else {
			$cleanData['sprint'] = '';
		}

		return $cleanData;
	}
}