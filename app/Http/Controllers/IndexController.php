<?php

namespace App\Http\Controllers;

use App\Project;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
	 */
	public function confirmation(Request $request)
	{
		$ticketIds = array_filter(array_unique(explode(',', $request['ticket'])), 'is_numeric');
		$projectId = $request['project'];

		/** @var \Illuminate\Database\Eloquent\Collection $tickets */
		$tickets = Ticket::
			whereIn('id', $ticketIds)
			->where('project_id', $projectId)
			->get();

		if ($tickets->isEmpty()) {
			/** @TODO: Placeholder */
			return redirect('/');
		} else {
			return view('pages.confirmation')->with('doubleTickets', $tickets)->with('ticketIds', $ticketIds);
		}
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function printAction(Request $request)
	{
		$ticketIds = array_filter(array_unique(explode(',', $request['ticket'])));

		dd($ticketIds, $request->all());


		return redirect('/');
	}
} 