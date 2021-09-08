<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id');
    }

    public function users(){
        return $this->belongsToMany(User::class,'role_user','role_id');
    }

}
