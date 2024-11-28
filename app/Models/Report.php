<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // Table name
    public $table = 'reports';

    // Fillable columns
    public $fillable = [
        'employee_id',  // Foreign key to the employees table
        'monday',       // Report for Monday
        'tuesday',      // Report for Tuesday
        'wednesday',    // Report for Wednesday
        'thursday',     // Report for Thursday
        'friday',       // Report for Friday
        'summary',      // Weekly summary
        'report_date', // Date of the report
    ];

    // Validation rules
    public static array $rules = [
        'employee_id' => 'required|exists:employees,id', // Ensuring that the employee exists
        'monday' => 'nullable|string',
        'tuesday' => 'nullable|string',
        'wednesday' => 'nullable|string',
        'thursday' => 'nullable|string',
        'friday' => 'nullable|string',
        'summary' => 'nullable|string',
    ];

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Accessors (if any special formatting is required, define them here)
    public function getMondayAttribute($value)
    {
        return $value ?? 'No Report'; // Return a default value if no report exists
    }

    public function getTuesdayAttribute($value)
    {
        return $value ?? 'No Report';
    }

    public function getWednesdayAttribute($value)
    {
        return $value ?? 'No Report';
    }

    public function getThursdayAttribute($value)
    {
        return $value ?? 'No Report';
    }

    public function getFridayAttribute($value)
    {
        return $value ?? 'No Report';
    }

    public function getSummaryAttribute($value)
    {
        return $value ?? 'No Summary';
    }

    // In the Report model

public function dailyReports()
{
    return $this->hasMany(DailyReport::class);
}

}
