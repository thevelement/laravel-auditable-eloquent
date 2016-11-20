<?php 

namespace Thevelement\LaravelAuditableEloquent;

use Closure;
use Illuminate\Database\Schema\MySqlBuilder;

class LaravelAuditableMySqlSchemaBuilder extends MySqlBuilder
{
	/**
     * Create a new command set with a Closure.
     *
     * @param  string  $table
     * @param  \Closure|null  $callback
     * @return \Illuminate\Database\Schema\Blueprint
     */
    protected function createBlueprint($table, Closure $callback = null)
    {
        if (isset($this->resolver)) {
            return call_user_func($this->resolver, $table, $callback);
        }
        return new LaravelAuditableBlueprint($table, $callback);
    }
}