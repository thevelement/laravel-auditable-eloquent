<?php 

namespace Thevelement\LaravelAuditableEloquent;

use Illuminate\Database\Schema\Builder;

class LaravelAuditableSchemaBuilder extends Builder {
	public function timestamps($auditField = [], $auditIdType = 'unsignedInteger')
	{
		$this->timestamp('created_at');
		
		if (in_array('created_at', $auditField)) $this->audit(['created_by'], $auditIdType);
		
		$this->timestamp('updated_at');
		
		if (in_array('updated_at', $auditField)) $this->audit(['updated_by'], $auditIdType);
	}
	
	public function softDeletes($auditIdType = false)
	{
		$this->timestamp('deleted_at')->nullable();
		
		if ($auditType) $this->audit(['deleted_by'], $auditIdType);
	}
	
	public function audit($track = ['created_by', 'updated_by', 'deleted_by'], $auditIdType = 'unsignedInteger')
	{
		foreach ($track as $column)
		{
			if ($column = 'deleted_by' ? $this->$auditIdType($column, false)->nullable() : $this->$auditIdType($column, false));
		}
	}
}