<<<<<<< HEAD
<?php 

namespace Thevelement\LaravelAuditableEloquent;
=======
<?php namespace Thevelement\LaravelAuditableEloquent;
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade

use Illuminate\Database\Eloquent\Model as BaseEloquent;
use \Auth;

class LaravelAuditableEloquent extends BaseEloquent {
	/**
	 * Indicates if we're auditing creation/updates/deletions
	 *
	 * @var bool
	 */
	public $auditing = false;
	
	/**
	 * The name of the "created by" column.
	 *
	 * @var string
	 */
	const CREATED_BY = 'created_by';
	/**
	 * The name of the "updated at" column.
	 *
	 * @var string
	 */
	const UPDATED_BY = 'updated_by';
	
	/**
	 * Update the creation and update timestamps.
	 *
	 * @return void
	 */
	protected function updateTimestamps()
	{
		$time = $this->freshTimestamp();

		if ( ! $this->isDirty(static::UPDATED_AT))
		{
			$this->setUpdatedAt($time);
		}
		
		if ( $this->auditing && ! $this->isDirty(static::UPDATED_BY))
		{
			$this->setUpdatedBy(Auth::user()->id);
		}

		if ( ! $this->exists && ! $this->isDirty(static::CREATED_AT))
		{
			$this->setCreatedAt($time);
		}
		
		if ( $this->auditing && ! $this->isDirty(static::CREATED_BY))
		{
			$this->setCreatedBy(Auth::user()->id);
		}
	}
	
	/**
	 * Set the value of the "created by" attribute.
	 *
	 * @param  int  $value
	 * @return void
	 */
	public function setCreatedBy($id)
	{
		$this->{static::CREATED_BY} = $id;
	}

	/**
	 * Set the value of the "updated by" attribute.
	 *
	 * @param  int  $value
	 * @return void
	 */
	public function setUpdatedBy($id)
	{
		$this->{static::UPDATED_BY} = $id;
	}
	
	/**
	 * Get the name of the "created by" column.
	 *
	 * @return string
	 */
	public function getCreatedByColumn()
	{
		return static::CREATED_BY;
	}

	/**
	 * Get the name of the "updated by" column.
	 *
	 * @return string
	 */
	public function getUpdatedByColumn()
	{
<<<<<<< HEAD
		return static::UPDATED_BY;
=======
		return static::UPDATED_By;
>>>>>>> e38d80c49ed2914c43cfe285536594345062eade
	}
}