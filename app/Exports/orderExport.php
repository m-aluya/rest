<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class orderExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('users')->get();
    }
    public function cl()
    {
        $table = 'users';
        return DB::select("SHOW COLUMNS FROM " . $table);
    }
    public function headings(): array
    {

        return [
            'id',
            'user_id', 'payurl', 'paymentRef',
            'orderRef',
            'pepperestfees',
            'maxdeliverydate',
            'mindeliverydate',
            'merchant_id',
            'buyer_id',
            'address_id',
            'totalprice',
            'shipping',
            'status',
            'total',
            'currency_id',
            'currency',
            'cart_id',
            'created_at', 'updated_at',
            'deleted_at',
            'payment_status',
            'delivery_confirmation_pin',
            'delivery_confirmation_pin_expires_at'
        ];
    }
}
