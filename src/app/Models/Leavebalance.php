<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Leavebalance extends Model
{ 
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leavebalances';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['employ_id', 'year', 'vacation_leave', 'vacation_carried', 'max_carry', 'is_eligible'];

    public function employ()
    {
        return $this->belongsTo(employ::class, 'employ_id');
    }
    
}
