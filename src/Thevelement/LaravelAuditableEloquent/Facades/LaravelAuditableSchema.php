<<<<<<< HEAD
<?php 

namespace Thevelement\LaravelAuditableEloquent\Facades;
=======
<?php namespace Thevelement\LaravelAuditableEloquent\Facades;
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade

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
		
<<<<<<< HEAD
		if ($connection->getConfig('driver') == 'mysql')
		{
			return new LaravelAuditableMySqlSchemaBuilder($connection);
		}
		else
		{
			return new LaravelAuditableSchemaBuilder($connection);
		}
=======
		return new LaravelAuditableSchemaBuilder($connection);
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade
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
		
<<<<<<< HEAD
		if ($connection->getConfig('driver') == 'mysql')
		{
			return new LaravelAuditableMySqlSchemaBuilder($connection);
		}
		else
		{
			return new LaravelAuditableSchemaBuilder($connection);
		}
=======
		return new LaravelAuditableSchemaBuilder($connection);
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade
	}

}
