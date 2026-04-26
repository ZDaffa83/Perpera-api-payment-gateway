<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
=======
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = '_admin';

    public function getAuthIdentifierName()
    {
        return 'username'; 
    }
>>>>>>> 4bdba2aa028175464dbe15ff8bbc5af596f225a4

    protected $fillable = [
        'nama_admin',
        'email_admin',
        'username',
        'password',
    ];
<<<<<<< HEAD
}
=======

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
>>>>>>> 4bdba2aa028175464dbe15ff8bbc5af596f225a4
