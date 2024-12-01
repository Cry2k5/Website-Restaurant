<?php

namespace App\Http\Controllers;

use App\Mail\ReservationConfirmationMail;
use App\Models\Bill;
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
        // Validate input data
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

        // Create Bill (Hóa đơn) for the reservation
        $bill = Bill::create([
            'user_id' => null, // or any other user ID if you want to link it with a user
            'reservation_id' => $reservation->reservation_id,
            'table_id' => $reservation->table_id,
            'bill_time' => now(),
        ]);
        $bill->save();
        // Update the table state to 'reserved'
        $table = RestaurantTable::find($reservation->table_id);
        $table->state = 'reserved';
        $table->save();

        // Check if email is provided
        if ($request->customer_email) {
            // Send Email with PDF attached
            Mail::send([], [], function ($message) use ($request, $pdf, $reservation) {
                $message->to($request->customer_email)
                    ->subject('Reservation Confirmation')
                    ->html('<p>Thank you for making a reservation! Please see the reservation information in the attached file.</p>')
                    ->attachData($pdf->output(), "reservation_{$reservation->id}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
            });
        }

        return redirect()->route('home.reservation')->with('success', 'Reservation made successfully!');
    }

}
