<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReceipt;

class EmailApiController extends Controller
{
    public function sendReceiptEmail(Request $request)
    {
        // Validate incoming payload
        $validated = $request->validate([
            'to'       => 'required|email',
            'bcc'      => 'nullable|array',
            'bcc.*'    => 'email',
            'subject'  => 'required|string',
            'data'     => 'required|array', // contains variables for the Mailable
        ]);

        try {
            // Send email using your Mailable
            $mail = new ReservationReceipt(
                $validated['data']['user_reservation'],
                $validated['data']['settings']
            );

               $mailer = Mail::mailer('zeptomail')->to($validated['to']);
                if (!empty($validated['bcc'])) {
                    $mailer->bcc($validated['bcc']);
                }

            $mailer->send($mail);

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $th) {
            \Log::error("Email sending failed: " . $th->getMessage());
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
