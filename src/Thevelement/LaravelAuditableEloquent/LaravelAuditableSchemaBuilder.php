<<<<<<< HEAD
<?php 

namespace Thevelement\LaravelAuditableEloquent;
=======
<?php namespace Thevelement\LaravelAuditableEloquent;
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade

use Illuminate\Database\Schema\Builder;

class LaravelAuditableSchemaBuilder extends Builder {
<<<<<<< HEAD
	public function timestamps($auditField = [], $auditIdType = 'unsignedInteger')
	{
		$this->timestamp('created_at');
		
		if (in_array('created_at', $auditField)) $this->audit(['created_by'], $auditIdType);
		
		$this->timestamp('updated_at');
		
		if (in_array('updated_at', $auditField)) $this->audit(['updated_by'], $auditIdType);
=======
	public function timestamps($auditField = array(), $auditIdType = 'unsignedInteger')
	{
		$this->timestamp('created_at');
		
		if (in_array('created_at', $auditField)) $this->audit(array('created_by'), $auditIdType);
		
		$this->timestamp('updated_at');
		
		if (in_array('updated_at', $auditField)) $this->audit(array('updated_by'), $auditIdType);
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade
	}
	
	public function softDeletes($auditIdType = false)
	{
		$this->timestamp('deleted_at')->nullable();
		
<<<<<<< HEAD
		if ($auditType) $this->audit(['deleted_by'], $auditIdType);
	}
	
	public function audit($track = ['created_by', 'updated_by', 'deleted_by'], $auditIdType = 'unsignedInteger')
=======
		if ($auditType) $this->audit(array('deleted_by'), $auditIdType);
	}
	
	public function audit($track = array('created_by', 'updated_by', 'deleted_by'), $auditIdType = 'unsignedInteger')
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade
	{
		foreach ($track as $column)
		{
			if ($column = 'deleted_by' ? $this->$auditIdType($column, false)->nullable() : $this->$auditIdType($column, false));
		}
	}
}