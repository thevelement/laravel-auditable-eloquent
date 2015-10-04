<?php 

namespace Thevelement\LaravelAuditableEloquent;

use Debugbar;
use Illuminate\Database\Schema\Blueprint;

class LaravelAuditableBlueprint extends Blueprint {
	/**
     * Add creation and update timestamps to the table.
	 * Option to include a "created_by" and "updated_by" fields for auditing purposes.
     *
	 * @param array $auditField
	 * @param string $auditIdType
     * @return void
     */
	public function timestamps($auditField = [], $auditIdType = 'unsignedInteger')
	{
		Debugbar::debug('Custom timestamps() called');
		
		$this->timestamp('created_at');
		
		if (in_array('created_at', $auditField)) $this->audit(['created_by'], $auditIdType);
		
		$this->timestamp('updated_at');
		
		if (in_array('updated_at', $auditField)) $this->audit(['updated_by'], $auditIdType);
	}
	
	/**
     * Add a "deleted at" timestamp for the table.
	 * Option to include a "deleted_by" field for auditing purposes.
     *
	 * @param bool|string $auditIdType
     * @return \Illuminate\Support\Fluent
     */
	public function softDeletes($auditIdType = null)
	{
		$this->timestamp('deleted_at')->nullable();
		
		if ( ! is_null($auditIdType)) $this->audit(['deleted_by'], $auditIdType);
	}
	
	public function audit($track = ['created_by', 'updated_by', 'deleted_by'], $auditIdType = 'unsignedInteger')
	{
		foreach ($track as $column)
		{
			Debugbar::debug('audit() called for ' . $column);
			if ($column = 'deleted_by' ? $this->$auditIdType($column, false)->nullable() : $this->$auditIdType($column, false));
		}
	}	
}