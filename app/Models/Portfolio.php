<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['user_id', 'birthday','phone','city','age','degree','messagetext'];

    /**
     * Get the user that owns the portfolio.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
