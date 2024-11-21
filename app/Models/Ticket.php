<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'category_id',
        'submitter_id',
        'assigned_tech_id',
    ];

    /**
     * Define the relationship with the submitter (user who created the ticket).
     */
    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitter_id');
    }

    /**
     * Define the relationship with the assigned technician (user responsible for the ticket).
     */
    public function assignedTech()
    {
        return $this->belongsTo(User::class, 'assigned_tech_id');
    }

    /**
     * Define the relationship with the category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
