<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_name',
        'request_type',
        'attachment',
        'description',
        'date_request_received',
        'status',
        'members_assigned',
        'is_active',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

   

    public function users()
    {
        return $this->belongsToMany(User::class, 'assignment_user', 'assignment_id', 'user_id');
    }

    
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    

    

}

