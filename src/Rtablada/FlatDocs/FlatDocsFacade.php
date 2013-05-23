<?php namespace Rtablada\FlatDocs;

use Illuminate\Support\Facades\Facade;

/**
* Facade for signup
*/
class FlatDocsFacade extends Facade
{
	protected static function getFacadeAccessor() { return 'flatdocs'; }
}
