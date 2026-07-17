<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Assuming you have these models
use App\Models\Guide;
use App\Models\Inquiry; 

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Data for Staff
        if ($user->isStaff()) {
            $totalBookingsToday = Booking::whereDate('created_at', today())->count();
            $activeGuides = Guide::where('status', 'active')->count();
            $pendingInquiries = Inquiry::where('status', 'pending')->count();

            return view('dashboard', compact('totalBookingsToday', 'activeGuides', 'pendingInquiries'));
        }

        // Data for Customers
        $customerBookingsCount = Booking::where('user_id', $user->id)->count();
        $nextTrip = Booking::where('user_id', $user->id)
            ->where('travel_date', '>=', now())
            ->orderBy('travel_date', 'asc')
            ->first();

        return view('dashboard', compact('customerBookingsCount', 'nextTrip'));
    }
}
