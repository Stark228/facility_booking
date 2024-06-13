<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking; // Assuming your Booking model namespace

class DeleteExpiredBookings extends Command
{
    protected $signature = 'bookings:delete-expired';
    protected $description = 'Delete expired bookings';

    public function handle()
{
    // Set the timezone to Bhutan
    $currentDateTime = now()->setTimezone('Asia/Thimphu');
    $currentDate = $currentDateTime->toDateString();
    $currentTime = $currentDateTime->format('H:i:s'); // Time format with seconds

    $bookingsToDelete = Booking::whereDate('start_date', '<=', $currentDate)
        ->where(function ($query) use ($currentDate, $currentTime) {
            $query->whereDate('start_date', '<', $currentDate)
                ->orWhere(function ($query) use ($currentDate, $currentTime) {
                    $query->whereDate('start_date', '=', $currentDate)
                        ->whereTime('end_time', '<=', $currentTime);
                });
        })
        ->get();

    foreach ($bookingsToDelete as $booking) {
        $booking->delete();
        $this->info("Booking {$booking->id} deleted.");
    }

    $this->info('Expired bookings deleted successfully.');
}
}