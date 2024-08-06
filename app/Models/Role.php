<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['role_name','role_description'];

    /**
     * Get the users that belong to the role.
     */
    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'acc_role', 'role_id', 'account_id');
    }

}
