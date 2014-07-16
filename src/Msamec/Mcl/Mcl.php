<?php namespace Msamec\Mcl;

class Mcl{
	public function model($namespace, $function, $role = null){
		$defaultRoleName = \Config::get('mcl::default');
		if(class_exists($namespace.'\\'.$role))
			$className = $namespace.'\\'.$role;
		elseif(class_exists($namespace.'\\'.$defaultRoleName))
			$className = $namespace.'\\'.$defaultRoleName;
		else
			throw new \Exception("Namespace {$namespace} does not exist.");
			

		$class = new $className;
		$arguments = array_slice(func_get_args(), 3);

		$method = new \ReflectionMethod($class, $function);
		if($arguments)
			$method->invokeArgs($class, $arguments);
		else
			$method->invoke($class);
	}

	public function make($view, $role = null, $data = array(), $mergeData = array())
	{
		$role = strtolower($role);
		try{
			return \View::make($view.'.'.$role, $data, $mergeData);
		}catch(\InvalidArgumentException $ex){
			$role = \Config::get('mcl::view');
			return \View::make($view.'.'.$role, $data, $mergeData);
		}
	}
}