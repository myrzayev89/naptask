<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\String\b;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'date'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getDate()
    {
        return Carbon::create($this->date)->format('d.m.Y');
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 0 :
                return 'Gözləmədə';
                break;
            case 1 :
                return 'Təsdiqlənib';
                break;
        }
        return null;
    }
}
