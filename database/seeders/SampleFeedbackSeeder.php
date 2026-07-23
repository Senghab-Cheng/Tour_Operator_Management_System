<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Review;
use App\Models\TourGuide;
use App\Models\TourPackage;
use App\Models\TourSchedule;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Adds sample customer feedback (ratings + comments) to existing tour
 * packages and tour guides, so both pages have something to show.
 *
 * Tops each package up to REVIEWS_PER_PACKAGE reviews. Safe to re-run:
 * only adds however many more are needed to reach that target, it won't
 * duplicate reviews you already have.
 *
 * Run with: php artisan db:seed --class=SampleFeedbackSeeder
 */
class SampleFeedbackSeeder extends Seeder
{
    private const REVIEWS_PER_PACKAGE = 4;

    public function run(): void
    {
        $guides = TourGuide::all();
        $vehicle = Vehicle::first();

        if ($guides->isEmpty() || ! $vehicle) {
            $this->command?->warn('No tour guides / vehicles found yet — seed tours first, then run this again.');

            return;
        }

        $reviewers = collect([
            ['name' => 'Sreymom Chea', 'email' => 'sreymom@example.test'],
            ['name' => 'Virak Long', 'email' => 'virak@example.test'],
            ['name' => 'Chenda Pich', 'email' => 'chenda@example.test'],
            ['name' => 'Ponleu Heng', 'email' => 'ponleu@example.test'],
            ['name' => 'Sokha Prum', 'email' => 'sokha@example.test'],
            ['name' => 'Ratana Kim', 'email' => 'ratana@example.test'],
            ['name' => 'Bora Nhem', 'email' => 'bora@example.test'],
            ['name' => 'Kunthea Yin', 'email' => 'kunthea@example.test'],
        ])->map(fn ($r) => User::updateOrCreate(
            ['email' => $r['email']],
            ['name' => $r['name'], 'password' => Hash::make('Customer@12345'), 'role' => UserRole::Customer]
        ));

        $sampleFeedback = [
            ['rating' => 5, 'comment' => 'Amazing trip! Our guide knew all the best spots and made sure everyone was comfortable the whole way.'],
            ['rating' => 4, 'comment' => 'Great experience overall, just wish we had a bit more free time to explore on our own.'],
            ['rating' => 5, 'comment' => 'Well organized from pickup to drop-off. Would book again!'],
            ['rating' => 4, 'comment' => 'Lovely scenery and a friendly, knowledgeable guide. Food stops could be better though.'],
            ['rating' => 5, 'comment' => 'Everything ran on time and the guide was very patient answering our questions.'],
            ['rating' => 3, 'comment' => 'Good tour, but it felt a little rushed near the end.'],
            ['rating' => 5, 'comment' => 'Best trip we have done in Cambodia so far, highly recommend to anyone visiting.'],
            ['rating' => 4, 'comment' => 'Beautiful views and a very safe, well-planned itinerary. Small delay at pickup but no big deal.'],
        ];

        $packages = TourPackage::all();

        if ($packages->isEmpty()) {
            $this->command?->warn('No tour packages found yet — seed tours first, then run this again.');

            return;
        }

        $created = 0;
        $seq = 0;

        foreach ($packages as $package) {
            $existing = Review::where('tour_package_id', $package->id)->count();
            $needed = self::REVIEWS_PER_PACKAGE - $existing;

            if ($needed <= 0) {
                continue;
            }

            // Reviewers who have already reviewed this package (via any booking),
            // so a top-up run doesn't reuse someone who's already left feedback here.
            $alreadyReviewedBy = Review::where('tour_package_id', $package->id)->pluck('user_id')->all();
            $availableReviewers = $reviewers->reject(fn ($r) => in_array($r->id, $alreadyReviewedBy))->values();

            for ($j = 0; $j < $needed && $j < $availableReviewers->count(); $j++) {
                $reviewer = $availableReviewers[$j];
                $guide = $guides[$seq % $guides->count()];
                $feedback = $sampleFeedback[$seq % count($sampleFeedback)];

                $pastSchedule = TourSchedule::create([
                    'tour_package_id' => $package->id,
                    'tour_guide_id' => $guide->id,
                    'vehicle_id' => $vehicle->id,
                    'departure_date' => now()->subDays(10 + $seq)->toDateString(),
                    'pickup_point' => 'Central Meeting Point, '.$package->destination,
                    'pickup_time' => '07:00',
                    'max_seats' => 12,
                    'seats_booked' => 2,
                    'status' => 'completed',
                ]);

                $booking = Booking::create([
                    'booking_code' => 'BK-'.strtoupper(Str::random(8)),
                    'user_id' => $reviewer->id,
                    'tour_schedule_id' => $pastSchedule->id,
                    'number_of_people' => 2,
                    'total_price' => $package->price * 2,
                    'status' => 'completed',
                ]);

                Review::create([
                    'booking_id' => $booking->id,
                    'user_id' => $reviewer->id,
                    'tour_package_id' => $package->id,
                    'rating' => $feedback['rating'],
                    'comment' => $feedback['comment'],
                ]);

                $created++;
                $seq++;
            }
        }

        $this->command?->info("Created {$created} sample review(s).");
    }
}