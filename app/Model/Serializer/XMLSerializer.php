<?php

namespace App\Model\Serializer;

class XMLSerializer
{
	/**
	 * @var XMLWriter
	 */
	private $buffer;

	/**
	 *
	 */
	function __construct()
	{
		$this->buffer = new \XMLWriter();
		$this->buffer->openMemory();
	}

	public function serialize($ticket)
	{
		$this->buffer->writeRaw('<?xml version="1.0" encoding="utf-8"?>');
		$this->buffer->startElement('ticket');
		$this->generateTicket($ticket);
		$this->buffer->endElement();
		
		return $this->buffer->outputMemory();
	}

	private function generateTicket($ticket)
	{
		$this->buffer->writeElement('key', $ticket['key']);
		$this->buffer->writeElement('reporter', $ticket['reporter']);
		$this->buffer->writeElement('type', $ticket['issueType']);
		$this->buffer->writeElement('sprint', $ticket['sprint']);
		$this->buffer->writeElement('summary', $ticket['summary']);
		$this->buffer->writeElement('devTeam', $ticket['devTeam']);
		$this->buffer->writeElement('storyPoints', $ticket['storyPoints']);
		$this->buffer->writeElement('hasSubTasks', $ticket ['hasSubTasks']);

		if (isset($ticket['epicData'])) {
			$this->buffer->startElement('epic');
			$this->buffer->writeElement('key', $ticket['epicData']['key']);
			$this->buffer->writeElement('summary', $ticket['epicData']['summary']);
			$this->buffer->endElement();
		}

		if (isset($ticket['parentData'])) {
			$this->buffer->startElement('parent');
			$this->buffer->writeElement('key', $ticket['epicData']['key']);
			$this->buffer->writeElement('summary', $ticket['epicData']['summary']);
			$this->buffer->endElement();
		}
	}
}