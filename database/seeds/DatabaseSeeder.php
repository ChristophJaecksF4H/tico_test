<?php

use App\Project;
use App\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Project::truncate();
		Ticket::truncate();
		
		$this->call(ProjectTableSeeder::class);
		$this->call(TicketTableSeeder::class);

		Model::reguard();
	}
}
