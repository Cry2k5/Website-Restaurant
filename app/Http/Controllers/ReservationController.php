<?php

namespace App\Http\Controllers;

use App\Mail\ReservationConfirmationMail;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function reservation()
    {
        $tables = RestaurantTable::where('state', 'available')->get(); // Fetch available tables
        return view('home.reservation', compact('tables'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'table_id' => 'required|exists:restaurant_tables,table_id',
            'reservation_date' => 'required|date_format:Y-m-d',
            'reservation_time' => 'required',
            'description' => 'nullable|string',
        ]);

        // Create Reservation
        $reservation = Reservation::create($validated);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.reservation', compact('reservation'));

        // Check if email is provided
        if ($request->customer_email) {
            // Send Email with PDF attached
            Mail::send([], [], function ($message) use ($request, $pdf, $reservation) {
                $message->to($request->customer_email)
                    ->subject('Reservation Confirmation')
                    ->html('<p>Cảm ơn bạn đã đặt bàn! Vui lòng xem thông tin đặt bàn trong file đính kèm.</p>')
                    ->attachData($pdf->output(), "reservation_{$reservation->id}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
            });
        }

        return redirect()->route('home.reservation')->with('success', 'Reservation made successfully!');
    }

}
