<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'author', 'source_code_url', 'production_site_url', 'image', 'description', 'type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany('App/Models/Technology');
    }
}
