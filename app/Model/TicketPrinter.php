<?php

namespace App\Model;


use App\Model\Converter\XsltToFoTicketConverter;

class TicketPrinter
{
	/**
	 * @var array
	 */
	private $ticketsToPrint;

	/**
	 * @var
	 */
	private $xslTemplatePath;

	/**
	 * @var
	 */
	private $foTemplateName;

	/**
	 * @param $ticketArray
	 */
	function __construct($ticketArray = array())
	{
		$this->ticketsToPrint  = $ticketArray;
		$this->xslTemplatePath = config('printer.template');
	}

	/**
	 * @param array $ticketArray
	 */
	public function printTickets($ticketArray = array())
	{
		if (empty($this->ticketsToPrint)) {
			$this->ticketsToPrint = $ticketArray;
		}

		foreach ($this->ticketsToPrint as $ticket) {
			$this->parseTicketToFo($ticket);
		}
	}

	/**
	 * @param $ticketData
	 */
	private function parseTicketToFo($ticketData)
	{
		$xlstToFoConverter = new XsltToFoTicketConverter();
		$xlstToFoConverter->convertTicket($ticketData);
		
		
	}
} 