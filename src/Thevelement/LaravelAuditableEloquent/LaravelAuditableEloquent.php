<?php 

namespace Thevelement\LaravelAuditableEloquent;

use Illuminate\Database\Eloquent\Model as BaseEloquent;

class LaravelAuditableEloquent extends BaseEloquent
{
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

		if ( ! $this->isDirty(static::UPDATED_AT)) {
			$this->setUpdatedAt($time);
		}
		
		if ( $this->auditing && ! $this->isDirty(static::UPDATED_BY) && auth()->check()) {
			$this->setUpdatedBy(auth()->user()->id);
		}

		if ( ! $this->exists && ! $this->isDirty(static::CREATED_AT)) {
			$this->setCreatedAt($time);
		}
		
		if ( $this->auditing && ! $this->isDirty(static::CREATED_BY) && auth()->check()) {
			$this->setCreatedBy(auth()->user()->id);
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
		return static::UPDATED_BY;
	}
}