<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    use HasFactory;
    protected $table = 'tabungan';
    protected $fillable = [
      'user_id',
      'saldo',
      'created_by',
      'modified_by'
    ];

    public function user()
    {
      return $this->belongsTo(User::class); 
    }
}
