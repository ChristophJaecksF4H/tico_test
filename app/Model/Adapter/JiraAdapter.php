<?php

namespace App\Model\Adapter;

use App\Model\Parser\JiraParser;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

/**
 * adapter for fetching issue data from an jira endpoint
 *
 * Class JiraAdapter
 * @package Debra\Model\Adapter
 */
class JiraAdapter
{
	/**
	 * @var \Guzzle\Http\Client
	 */
	private $client;

	/**
	 * @var JiraParser
	 */
	private $parser;

	/**
	 * @var string
	 */
	private $jiraApiUrl;

	/**
	 * @var string
	 */
	private $username;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * @var int
	 */
	const API_VERSION = 2;

	/**
	 *
	 */
	public function __construct()
	{
		// init the client
		$this->client = new Client();
		$this->client->setDefaultOption('auth', [env('JIRA_USERNAME'), env('JIRA_PASSWORD')]);
		$this->client->setDefaultOption('verify', false);

//		dd(config('jira.baseUrl'));

		$this->parser     = new JiraParser(config('jira.BaseUrl'));
		$this->jiraApiUrl = config('jira.baseUrl');
		$this->username   = env('JIRA_USERNAME');
		$this->password   = env('JIRA_PASSWORD');
	}

	/**
	 * builds an api endpoint url
	 *
	 * @param string $ticketIdentifier
	 * @return string
	 */
	private function buildTicketUrl($ticketIdentifier)
	{
		return $this->jiraApiUrl . $ticketIdentifier;
	}

	/**
	 * returns a collection of issue by key
	 *
	 * @param array $ticketList
	 * @return array[]
	 */
	public function getIssuesByKeys($ticketList = array())
	{
		if (empty($ticketList)) {
			return $ticketList;
		}

		$tickets = array();
		$errors  = array();
		$results = array();

		foreach ($ticketList as $ticketIdentifier) {
			$req = $this->client->get($this->buildTicketUrl($ticketIdentifier), array());
			$req->setHeader('Content-Type', 'application/json');
			try {
				$res     = $req->send($req);
				$resJson = $res->json();
			} catch (ClientErrorResponseException $e) {
				$errors[] = $ticketIdentifier;
			}

			if (!empty($resJson)) {
				$tickets[] = $this->parser->parseJiraIssue($resJson);
			}
		}

		$results['tickets'] = $tickets;
		$results['errors']  = $errors;

		return $results;
	}
}