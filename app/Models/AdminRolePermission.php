<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRolePermission extends Model
{
    use HasFactory;
    protected $table = "admin_role_permission";
    public function permission()
    {
        return $this->belongsTo(AdminPermission::class, 'permission_id');
    }
    protected $fillable = [
        'role_id',
        'permission_id',
        'perm_view',
        'perm_add',
        'perm_edit',
        'perm_delete',
    ];
}
