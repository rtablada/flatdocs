<?php
$prefix = \Config::get('flat-docs::routePrefix');
$defaultRedirect = \Config::get('flat-docs::defaultRedirect');

Route::group(array('prefix' => $prefix), function() use ($defaultRedirect)
{
	Route::get('/', function() use ($defaultRedirect) {
		return Redirect::route('FlatDocs', $defaultRedirect);
	});

	Route::any('{uri}', array('as' => 'FlatDocs', 'uses'=>'Rtablada\FlatDocs\FlatDocs@index'))->where('uri', '.*');
});