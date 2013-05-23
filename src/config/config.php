<?php

return array(
	/*
	|--------------------------------------------------------------------------
	| Registered Documents
	|--------------------------------------------------------------------------
	| 
	| FlatDocs uses this map to create your navigation and accept routes
	| all in one go! Nested routes are also supported.
	| The format for routes is 'slug:Pretty Name'
	| If a Pretty Name is not given, then the slug is used for both
	| The slug name and path also maps to your document path
	| 
	 */
	'registeredDocs' => array(
		'start:Getting Started',
		'api' => array(
			'1:endpoint1',
			'2:endpoint2',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Documents Title
	|--------------------------------------------------------------------------
	| 
	| This is used in various places as your documents title
	| 
	 */
	'title' => 'FlatDocs',

	/*
	|--------------------------------------------------------------------------
	| Documents Route Prefix
	|--------------------------------------------------------------------------
	| 
	| FlatDocs uses a route group to handle a prefix before catching all
	| requests. Changing this value will let you change your docs route
	| from 'hostname/docs' to 'hostname/routePrefix'.
	| 
	 */
	'routePrefix' => 'docs',

	/*
	|--------------------------------------------------------------------------
	| Default
	|--------------------------------------------------------------------------
	| 
	| FlatDocs automatically redirects to a default document
	| 
	 */
	'defaultRedirect' => 'start',

	/*
	|--------------------------------------------------------------------------
	| Documents Storage Path
	|--------------------------------------------------------------------------
	| 
	| FlatDocs loads your Markdown from disk. Here you can change where
	| your markdown files are stored.
	| 
	 */
	'path' => app_path().'/docs',

	/*
	|--------------------------------------------------------------------------
	| Documents Route Properties
	|--------------------------------------------------------------------------
	| 
	| If you want more complicated rules for the route group, uncomment and use
	| this array.
	| 
	 */
	// 'routeProperties' => array(
	// 	'domain' => '',
	// 	'prefix' => ''
	// ),

);
