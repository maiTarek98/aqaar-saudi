<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model {
    use HasFactory;
	protected $table = 'subscriptions';
    protected $fillable = [
        'sell_car_id',	'monthly_fee' ,'next_payment_date','status'
    ];

    public function sell_car()
    {
        return $this->belongsTo(\App\Models\SellCar::class,'sell_car_id');
    }

    public function checkIfExpired()
    {
        if ($this->next_payment_date <= now()) {
            $this->status = 'inactive';
            $this->save();
        }
    }

}
?>