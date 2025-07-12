<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'percentage_discount',
        'fixed_discount',
        'usage_limit',
        'times_used',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'percentage_discount' => 'decimal:2',
        'fixed_discount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the actual discount value based on discount type
     */
    public function getDiscountValueAttribute()
    {
        return $this->discount_type === 'percentage'
            ? $this->percentage_discount
            : $this->fixed_discount;
    }

    /**
     * Calculate the discount amount for a given total
     */
    public function calculateDiscountAmount($total)
    {
        if ($this->discount_type === 'percentage') {
            return $total * ($this->percentage_discount / 100);
        } else {
            return min($this->fixed_discount, $total);
        }
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($coupon) {
            // Ensure only the appropriate discount field is filled
            if ($coupon->discount_type === 'percentage') {
                $coupon->fixed_discount = null;
            } else {
                $coupon->percentage_discount = null;
            }
        });
    }

    /**
     * Get the validation rules for the model
     */
    public static function getValidationRules($id = null)
    {
        return [
            'code' => ['required', 'string', 'max:50', Rule::unique('coupons')->ignore($id)],
            'description' => ['required', 'string', 'max:255'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'percentage_discount' => ['required_if:discount_type,percentage', 'nullable', 'numeric', 'min:0', 'max:100'],
            'fixed_discount' => ['required_if:discount_type,fixed', 'nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'times_used' => ['integer', 'min:0'],
            'valid_from' => ['required', 'date'],
            'valid_until' => ['required', 'date', 'after_or_equal:valid_from'],
            'is_active' => ['boolean'],
        ];
    }
}
