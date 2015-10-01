<?php namespace Thevelement\LaravelAuditableEloquent\Facades;

use Thevelement\LaravelAuditableEloquent\LaravelAuditableSchemaBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Thevelement\LaravelAuditableEloquent\LaravelAuditableSchemaBuilder
 */
class LaravelAuditableSchema extends Facade {

	/**
	 * Get a schema builder instance for a connection.
	 *
	 * @param  string  $name
	 * @return \Illuminate\Database\Schema\Builder
	 */
	public static function connection($name)
	{
		$connection = static::$app['db']->connection($name);
		if (is_null($connection->getSchemaGrammar())) $connection->useDefaultSchemaGrammar();
		
		return new LaravelAuditableSchemaBuilder($connection);
	}

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		$connection = static::$app['db']->connection();
		if (is_null($connection->getSchemaGrammar())) $connection->useDefaultSchemaGrammar();
		
		return new LaravelAuditableSchemaBuilder($connection);
	}

}
