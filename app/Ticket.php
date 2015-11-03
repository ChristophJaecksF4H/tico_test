<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	protected $fillable = [
		'id',
		'project_id'
	];

	/**
	 * An Ticket has a project
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function project()
	{
		return $this->belongsTo('App\Project');
	}

	public function getTicketName()
	{
		$projectName = $this->project->toArray()['name'];
		
		return $projectName . '-' . $this->id;
	}
}
