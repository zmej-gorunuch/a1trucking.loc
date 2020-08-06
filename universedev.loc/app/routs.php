<?php
/**
 * Формат:
 *   $routes = [
 *      ['GET|POST|PATCH|PUT|DELETE', 'url шлях', 'контролер@метод', 'назва']
 *   ];
 */
return [
	'routes' => [
		[ 'GET', '/', 'MainController@index', 'index' ],
		[ 'GET', '/form', 'MainController@form', 'form' ],
		[ 'GET', '/privacy-policy', 'MainController@privacy', 'privacy-policy' ],
		[ 'GET', '/cookie-policy', 'MainController@cookie', 'cookie-policy' ],
		[ 'GET', '/terms-conditions', 'MainController@termsConditions', 'terms-conditions' ],
		[ 'POST', '/send-mail', 'MainController@sendMail', 'send-mail' ],
	],
];
