<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CancelPendingBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookingId;

    public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function handle()
    {
        $booking = Booking::find($this->bookingId);
        
        if ($booking && $booking->payment_status === 'pending') {
            // Chỉ hủy nếu vẫn đang pending sau 3 phút
            $booking->update(['payment_status' => 'cancelled']);
            
            Log::info("Booking {$this->bookingId} đã bị hủy do timeout 3 phút");
        }
    }
} 