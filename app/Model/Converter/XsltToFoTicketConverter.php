<?php

namespace App\Model\Converter;

use App\Model\Serializer\XMLSerializer;
use Log;

class XsltToFoTicketConverter
{
	/**
	 * @var \XSLTProcessor
	 */
	private $processor;

	function __construct()
	{
		$this->processor = new \XSLTProcessor();
	}

	/**
	 * @param array $ticket
	 */
	public function convertTicket($ticket)
	{
		$xmlSerializer    = new XMLSerializer();
		$serializedTicket = $xmlSerializer->serialize($ticket);

		$dom = new \DOMDocument();
		$dom->loadXML($serializedTicket);

		try {
			$stylesheet = new \DOMDocument();
			$stylesheet->load(config('printer.XSLTemplatePath'));

			$this->processor->importStylesheet($stylesheet);
			$doc = $this->processor->transformToDoc($dom);

			$doc->save(config('printer.foOutputPath'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}

		die();
	}
}