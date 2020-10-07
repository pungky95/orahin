<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_number', 'customer_uid', 'status', 'date',
        'latitude', 'longitude', 'address', 'third_party_payment_transaction_id',
        'third_party_payment_url', 'third_party_payment_json_callback',
        'third_party_payment_status', 'total'];

    public static function laratablesCustomAction($order)
    {
        $status = $order->status;
        switch ($status) {
            case 'Awaiting Payment':
                $icon = 'primary';
                break;
            case 'Pending':
                $icon = 'warning';
                break;
            case 'Expired':
                $icon = 'danger';
                break;
            case 'Rejected':
                $icon = '';
                break;
            case 'Approved':
                $icon = 'success';
                break;
            default:
                $icon = 'dark';
        }
        return view('dashboard.order.action', compact('order', 'icon', 'status'))->render();
    }

    public static function laratablesCustomStatusBadge($order)
    {
        $status = $order->status;
        switch ($status) {
            case 'Awaiting Payment':
                $color = 'primary';
                break;
            case 'Pending':
                $color = 'warning';
                break;
            case 'Expired' || 'Rejected':
                $color = 'danger';
                break;
            case 'Approved' || 'Finished':
                $color = 'success';
                break;
            default:
                $color = 'dark';
        }
        return view('dashboard.order.status_badge', compact('status', 'color'))->render();
    }

    public static function laratablesSearchCustomerInfo($query, $searchValue)
    {
        return $query->orWhere('customer.name', 'like', '%' . $searchValue . '%')
            ->orWhere('customer.email', 'like', '%' . $searchValue . '%');
    }

    public static function laratablesSearchStatusBadge($query, $searchValue)
    {
        return $query->orWhere('orders.status', 'like', '%' . $searchValue . '%');
    }

    public static function laratablesOrderStatusBadge()
    {
        return 'status';
    }

    public static function laratablesOrderRawCustomerInfo($direction)
    {
        return 'customer.name ' . $direction . ', customer.email ' . $direction;
    }

    public static function laratablesCustomCustomerInfo($order)
    {
        $arrColor = ['primary', 'danger', 'success', 'warning'];
        $color = $arrColor[rand(0, 3)];
        return view('dashboard.order.customer_info', compact('order', 'color'))->render();
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['customer_uid', 'status'];
    }

    public static function laratablesDate($order)
    {
        return dateFormat($order->date, true);
    }

    public static function laratablesTotal($order)
    {
        return formatCurrency($order->total);
    }

    public function orderDetails()
    {
        return $this->belongsToMany('App\Models\Service', 'order_details', 'order_id', 'service_id')
            ->withPivot('quantity', 'price', 'note');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_uid', 'uid')->withTrashed()->withDefault(null);
    }

    public function getOrderStatusAttribute()
    {
        $status = $this->status;
        switch ($status) {
            case 'Awaiting Payment':
                $color = 'primary';
                break;
            case 'Pending':
                $color = 'warning';
                break;
            case 'Expired' || 'Rejected':
                $color = 'danger';
                break;
            case 'Approved' || 'Finished':
                $color = 'success';
                break;
            default:
                $color = 'dark';
        }
        return view('dashboard.order.status_badge', compact('status', 'color'))->render();
    }
}
