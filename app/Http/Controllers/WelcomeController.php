<?php namespace App\Http\Controllers;


class WelcomeController extends Controller
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
		return view('pages.welcome');
	}

	/**
	 * @return string
	 */
	public function contact()
	{
		return view('pages.contact');
	}
	
	public function tico()
	{
		return view('pages.tico');
	}
} 