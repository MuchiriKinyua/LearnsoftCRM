<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\Interaction;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    // Define the table name
    public $table = 'leads';

    // Fillable fields
    public $fillable = [
        'full_name',
        'email',
        'phone_number',
        'source',
        'status',
        'employee_id',
        'description'
    ];

    // Cast attributes to specific types
    protected $casts = [
        'full_name' => 'string',
        'email' => 'string',
        'source' => 'string',
        'status' => 'string',
        'description' => 'string'
    ];

    // Validation rules
    public static array $rules = [
        'full_name' => 'nullable|string|max:100',
        'email' => 'required|string|max:30',
        'phone_number' => 'nullable',
        'source' => 'nullable|string|max:30',
        'status' => 'nullable|string|max:30',
        'employee_id' => 'nullable',
        'description' => 'nullable|string|max:65535',
        'created_at' => 'nullable'
    ];

    // Define the relationship with the Employee model
    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    // Define the relationship with the Client model (assuming each Lead belongs to one Client)
    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id'); // Adjust 'client_id' to your actual foreign key
    }

    // Define the relationship with the Interaction model
    public function interactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Interaction::class, 'lead_id');
    }

    // Define the relationship with the Product model
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Product::class, 'lead_id');
    }
    protected static function booted()
    {
        parent::boot();

        static::created(function ($lead) {
            // Automatically create an interaction after a lead is created
            Interaction::create([
                'lead_id' => $lead->id,
                'client_id' => null,  // As you mentioned, the client is blank
                'type' => 'Lead',  // As the type should be 'Lead'
                'description' => $lead->description,  // Description comes from the lead
                'interactions_date' => Carbon::now()->toDateString()  // Sync with the current laptop date
            ]);
        });
    }
    public function getProductNameAttribute()
{
    return $this->product ? $this->product->product_name : 'N/A';
}

}
