<?php

namespace App\Http\Controllers;

use App\Model\Adapter\JiraAdapter;
use App\Model\Project;
use App\Model\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Session;

class IndexController extends Controller
{

	/**
	 *
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		/** @var Project $projects */
		$projects = Project::lists('name', 'id');

		return view('pages.index')->with('projects', $projects);
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function confirmation(Request $request)
	{
		$ticketIds = array_filter(array_unique(explode(',', $request['ticket'])), 'is_numeric');
		$projectId = $request['project'];

		$ticketIds = array_map(function ($value) {
			return ltrim($value, '0 ');
		}, $ticketIds);

		/** @var \Illuminate\Database\Eloquent\Collection $doubledTickets */
		$doubledTickets = Ticket::whereIn('id', $ticketIds)
			->where('project_id', $projectId)
			->get();

		if ($doubledTickets->isEmpty()) {
			/** @var Request $request */
			$request = Request::create('/printAction', 'POST', ['ticketIds' => implode(',', $this->buildTicketName($ticketIds, $projectId))]);

			return $this->printAction($request);
		} else {
			$freshTicketIds = array_diff($ticketIds, $doubledTickets->lists('id')->toArray());
			$freshTicketIds = $this->buildTicketName($freshTicketIds, $projectId);

			return view('pages.confirmation')
				->with('doubledTickets', $doubledTickets)
				->with('freshTicketIds', implode(',', $freshTicketIds))
				->with('project', $projectId);
		}
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function printAction(Request $request)
	{
		$freshTickets = explode(',', $request['ticketIds']);

		foreach ($request->all() as $key => $value) {
			if (preg_match('/^doubledTicket_[\d]*/', $key)) {
				$freshTickets[] = $value;
			}
		}

		$jiraAdapter = new JiraAdapter();
		$result      = $jiraAdapter->getIssuesByKeys(config('jira.testTickets'));

		Session::put('errors', $result['errors']);
		Session::flash('flash_message', 'your Tickets will be printed now');

		return redirect('/');
	}


	/**
	 * @param array $ticketIds
	 * @param $projectId
	 * @return array
	 */
	private function buildTicketName($ticketIds, $projectId)
	{
		$project     = Project::find($projectId);
		$projectName = $project->name;
		$result      = array();

		foreach ($ticketIds as $ticketId) {
			$result[] = $projectName . '-' . $ticketId;
		}

		return $result;
	}

	/**
	 * @param $array
	 * @return mixed
	 */
	private function extract_numbers($array)
	{
		return array_map(function ($string) {
			preg_match_all('/([\d]+)/', $string, $match);

			return $match[0][0];
		}, $array);
	}
} 