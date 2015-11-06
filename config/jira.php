<?php

return array(
	'baseUrl' => 'https://fashion4home.jira.com/rest/api/2/issue/',
	'testTickets' => ['DMF-15294',
					  'DMF-12080',
					  'DMF-12185',
					  'DMF-12657',
					  'DMF-12916',
					  'DMF-13903',
					  'DMF-15219',
					  'DMF-13931',
					  'DMF-14115',
					  'DMF-99999',
					  'DMF-1516861651'
	],
	'baseErrorMessage' => 'The following tickets could not be printed: ',
	'successMessage' => 'Your Tickets will be printed now',
	'template' => 'xslTemplates/ticket_to_fo_xsl.xsl'
);