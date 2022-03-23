<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTable extends Model
{
    use HasFactory;
    protected $table = 'booking-ticket'; //Tên table
    protected $primaryKey = 'ticket_id'; //Tên khóa chính
    protected $fillables = [
        'ticket_id',
        'cus_id',
        'tour_id',
        'price',
        'state',
        'created_at',
        'updated_at'
    ];

    public function storeTicket($ticketData)
    {
        return $this->insert($ticketData);
    }
}
