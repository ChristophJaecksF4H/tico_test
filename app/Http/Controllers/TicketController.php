<?php namespace App\Http\Controllers;


use App\Model\Ticket;

class TicketController extends Controller
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
		$tickets = Ticket::all();

		return view('tickets.index')->with('tickets', $tickets);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function show($id)
	{
		/** @var Ticket $ticket */
		$ticket = Ticket::findorFail($id);

		return view('tickets.show')->with('ticket', $ticket);
	}
} 