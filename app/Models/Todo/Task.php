<?php

namespace App\Models\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;
    //по умолчанию все это и так работает, но можно переопределить
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = 'true';
    protected $fillable = []; //поля которые можно изменять
    protected $guarded= []; //поля которые нельзя изменять
    //связь с таблицей Users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    //связь с таблицей TaskSecretInfo
    public function secret()
    {
        return $this->hasOne(TaskSecretInfo::class, 'task_id', 'id');
    }
    /**
     * The users that belong to the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
