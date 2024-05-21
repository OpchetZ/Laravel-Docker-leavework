<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class leaverequest extends Model
{ 
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leaverequests';

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
    protected $fillable = ['employ_id', 'leave_type_id', 'start_date', 'end_date', 'total_leave','reason'];

    protected $dates = ['start_date','end_date'];

    public function employ()
    {
        return $this->belongsTo(employ::class, 'employ_id');
    }
    public function leaveType()
    {
        return $this->belongsTo(leavetype::class, 'leave_type_id');
    }


}
