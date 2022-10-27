<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueTicket extends Model
{
    use HasFactory;

    public function issue_type(){
        return $this->belongsTo(IssueType::class);
    }

    public function issue_assign_developer(){
        return $this->hasMany(IssueAssignDeveloper::class)->with("developer");
    }

}
