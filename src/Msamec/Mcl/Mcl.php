<?php namespace Msamec\Mcl;

class Mcl{
	public function model($namespace, $function, $role = 'Main'){
		if(class_exists($namespace.'\\'.$role))
			$class_name = $namespace.'\\'.$role;
		elseif(class_exists($namespace.'\\Main'))
			$class_name = $namespace.'\\Main';
		else
			throw new \Exception("Namespace {$namespace} does not exist.");
			

		$class = new $class_name;
		$arguments = array_slice(func_get_args(), 3);

		$method = new \ReflectionMethod($class, $function);
		if($arguments)
			$method->invokeArgs($class, $arguments);
		else
			$method->invoke($class);
	}
}