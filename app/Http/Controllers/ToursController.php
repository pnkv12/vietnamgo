<?php

namespace App\Http\Controllers;

use App\Models\CustomerTable;
use App\Models\TicketTable;
use App\Models\ToursTable;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\DB;

class ToursController extends Controller
{
    protected $__tour;
    protected $__ticket;
    protected $__customer;

    public function __construct(ToursTable $tour, CustomerTable $customer, TicketTable $ticket)
    {
        $this->__tour = $tour;
        $this->__customer = $customer;
        $this->__ticket = $ticket;
    }

    //List of Tour on VNGo
    public function tourListAction(Request $request)
    {
        $id   = $request->id;
        $data = $this->__tour->viewList($id);

        return view('travel.list', ['data' => $data]);
    }

    //View Tour's details
    public function viewTourAction(Request $request)
    {
        $id   = $request->id;
        $data = $this->__tour->showTour($id);

        $tourTable = app(ToursTable::class);
        $slotLimit  = $tourTable->getLimit();

        return view('travel.details', ['data' => $data, 'slotLimit' => $slotLimit]);
    }

    //Open the booking form for tour by ID
    public function formViewAction(Request $request)
    {
        $id        = $request->id;
        $data      = $this->__tour->showTour($id);

        return view('mails.bookform', ['data' => $data]);
    }

    //Add Customer data + Tour Data => Booking Ticket
    public function confirmFormAction(Request $request)
    {
        $customer = $request->except('_token');

        //get customer's email from $request for mailing
        $customerMail = $customer['email'] ?? '';

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email'    => 'required',
            'phone'    => 'required|digits:10',
            'address'  => 'required',
            'members'  => 'required|min:0',
        ]);

        try {
            $customerID = $this->__customer->storeCus($customer);

            //get slots from tour table and compare it with customer's input, if exceeds throw error on swal
            $checkSlots = DB::table('tours')->select('slots')->where('id', $customer['id'])->value('slots');
            if ($checkSlots >= $customer['members']) {
                DB::table('tours')->where('id', $customer['id'])->decrement('slots', $customer['members']);
            } else {
                return response()->json([
                    'error'   => true,
                    'message' => 'Number of members exceeds available slots',
                ]);
            }

            $bookingData['cus_id'] = $customerID;
            $bookingData['phone'] = $customer['phone'];

            $bookingData['tour_id'] = $customer['id'];
            $bookingData['created_at'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:00');
            $bookingData['state'] = 0;

            //Get price from tour table and multiple by num of members
            (float) $getTourPrice = DB::table('tours')->select('price')->where('id', $customer['id'])->value('price');
            $totalPrice = $getTourPrice * (int)$customer['members'];

            $bookingData['total_price'] = $totalPrice;

            $this->__ticket->storeTicket($bookingData);

            //Send auto mail to customer's email
            Mail::to($customerMail)->send(new SendMail(['customerMail' => $customerMail]));
        } catch (Exception $ex) {
            return response()->json([
                'error'   => true,
                'message' => $ex->getMessage()
            ]);
        }
        return response()->json([
            'error'   => false,
            'message' => "Please check your email for confirmation."

        ]);
    }
}
