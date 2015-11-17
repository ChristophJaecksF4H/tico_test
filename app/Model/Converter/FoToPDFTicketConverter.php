<?php

namespace App\Model\Converter;

use App\Model\Serializer\XMLSerializer;
use Log;

class FoToPDFTicketConverter
{
	/**
	 * Convert Ticket to pdf using apache FOP
	 */
	public function convertTicket()
	{
		try {
			shell_exec('sh ' . config('printer.apacheFopPath') . ' ' . config('printer.foOutputPath') . ' ' . config('printer.pdfOutputPath'));
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
}