<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class User extends Model
{
    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory;
    use HasApiTokens;
    /**
     * @inheritdoc
     */
    protected $table = 'user';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'id',
        'user',
        'email',
        'email_verified_at',
        'password',
        'active',
        'remember_token',
        'created_at',
        'updated_at'
    ]; 
}