@extends('app')

@section('content')
<div class="tc">
	<div class="header">
		<img class="left" src="images/main_logo.png" width="100"/>

		<h2>F4H Jira-TicketConverter <span>0.5</span></h2>
	</div>
	<form id="form" name="form" class="form" action="ticketconverter.php" method="post">
		<div class="form-data sbs">
			<select id="project" class="left" name="project">
				<option value="DMF" selected="selected">DMF</option>
				<option value="ERP">ERP</option>
				<option value="KAT">KAT</option>
				<option value="OPS">OPS</option>
				<option value="RAS">RAS</option>
				<option value="NAV">NAV</option>
				<option value="PRO">PRO</option>
			</select>
			<textarea id="ids" class="left" name="list" rows="15" cols="20" onKeyDown="onKeyDown(event)"></textarea>
			<ul class="left">
				<li>
					Projekt via <strong>Dropdown</strong> auswählen
				</li>
				<li>
					Ticket-Ids ohne Projektkürzel <strong>untereinander</strong> oder <strong>nebeneinander </strong>(mit
					Leerzeichen getrennt) eingeben<br/>
					<span>z.B. 4114 4794 4775</span>
				</li>
				<li>
					Absenden via Button oder <strong>Strg+Enter</strong>
				</li>
				<li>
					Tickets werden nach dem Absenden <strong>automatisch gedruckt</strong>
				</li>
				<li>
					Wurde ein Ticket schon einmal gedruckt, erscheint eine Meldung und <strong>das erneute Drucken muss
						mit 'OK' bestätigt werden</strong>.<br/>
					<span>Bitte etwas Geduld nach der Bestätigung haben.</span>
				</li>
			</ul>
		</div>
		<input type="submit" value="Absenden"/>
	</form>
</div>
@stop