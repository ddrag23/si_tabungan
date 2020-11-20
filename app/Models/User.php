<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function incomeTransactions()
  {
    return $this->hasMany(IncomeTransaction::class);
  }

  public function tabungan()
  {
    return $this->hasOne(Tabungan::class);
  }
  public function outgoingTransactions()
  {
    return $this->hasMany(OutgoingTransaction::class);
  }

  public function pinjaman()
  {
    return $this->hasOne(Pinjaman::class);
  }
}
