<?php namespace Msamec\Mcl\Facades;

use Illuminate\Support\Facades\Facade;

class Mcl extends Facade{
	protected static function getFacadeAccessor()
	{
		return 'mcl';
	}
}