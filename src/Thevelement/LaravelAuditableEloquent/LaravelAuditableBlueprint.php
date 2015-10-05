<?php 

namespace Thevelement\LaravelAuditableEloquent;

use Illuminate\Database\Schema\Blueprint;

class LaravelAuditableBlueprint extends Blueprint
{
	/**
     * Add creation and update timestamps to the table.
	 * Option to include a "created_by" and "updated_by" fields for auditing purposes.
     *
	 * @param  array  $auditField
	 * @param  string  $auditIdType
     * @return void
     */
	public function timestamps($auditField = [], $auditIdType = 'unsignedInteger')
	{
		$this->timestamp('created_at');
		
		if (in_array('created_at', $auditField)) $this->audit(['created_by'], $auditIdType);
		
		$this->timestamp('updated_at');
		
		if (in_array('updated_at', $auditField)) $this->audit(['updated_by'], $auditIdType);
	}
	
	/**
     * Add a "deleted at" timestamp for the table.
	 * Option to include a "deleted_by" field for auditing purposes.
     *
	 * @param  bool|string  $auditIdType
     * @return \Illuminate\Support\Fluent
     */
	public function softDeletes($trackRestore = false, $auditIdType = null)
	{
		if ( ! $trackRestore) {
			$this->timestamp('deleted_at')->nullable();
			if ( ! is_null($auditIdType)) $this->audit(['deleted_by'], $auditIdType);
		} else {
			$this->timestamp('deleted_at')->nullable();
			$this->timestamp('restored_at')->nullable();
			if ( ! is_null($auditIdType)) $this->audit(['deleted_by', 'restored_by'], $auditIdType);
		}
	}
	
	public function audit($track = ['created_by', 'updated_by', 'deleted_by', 'restored_by'], $auditIdType = 'unsignedInteger')
	{
		$nullable = ['deleted_by', 'restored_by'];
		foreach ($track as $column) {
			if (in_array($column, $nullable) ? $this->$auditIdType($column, false)->nullable() : $this->$auditIdType($column, false));
		}
	}	
}