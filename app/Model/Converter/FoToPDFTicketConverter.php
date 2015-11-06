<?php

namespace App\Model\Converter;

use App\Model\Serializer\XMLSerializer;
use Log;

class FoToPDFTicketConverter
{
	/**
	 * @var \XSLTProcessor
	 */
	private $processor;

	function __construct()
	{
		$this->processor = '';
	}

	/**
	 * 
	 */
	public function convertTicket()
	{
		try {
			
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}

		die();
	}
}