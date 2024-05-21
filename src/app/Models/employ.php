<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class employ extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employs';

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
    protected $fillable = ['name', 'phone', 'Acc_vaca_day', 'status_id', 'post_id', 'vaca_max','bus_max','sick_max','agent_id'];

    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class,'post_id');
    }
    public function LeaveRequests()
    {
        return $this->hasMany(leaverequest::class, 'employ_id');
    }
    public function agency()
    {
        return $this->belongsTo(agency::class,'agent_id');
    }

}
