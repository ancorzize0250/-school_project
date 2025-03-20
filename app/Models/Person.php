<?php

namespace App\Models;

use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * @use HasFactory<PersonFactory>
     */
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $table = 'persons';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'id',
        'identification',
        'names',
        'surnames',
        'email',
        'phone',
        'active',
        'created_at',
        'updated_at'
    ]; 
}