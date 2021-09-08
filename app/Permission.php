<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];

    /*
 * Mutators
 */
    // SET Name
    public function setNameAttribute($value){
        $this->attributes['name'] = mb_strtoupper($value, 'UTF-8');
    }

    // SET Description
    public function setDescriptionAttribute($value){
        if($value != null){
            $this->attributes['description'] = mb_strtoupper($value, 'UTF-8');
        }else{
            $this->attributes['description'] = null;
        }
    }

    /*
     * RELATIONS
     */
    public function roles(){
        return $this->belongsToMany(Role::class,'permission_role','permission_id');
    }
}
