<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\ItineraryItem;
use App\Models\TourGuide;
use App\Models\TourPackage;
use App\Models\TourSchedule;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TourOperatorSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tourops.test'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('Admin@12345'),
                'role' => UserRole::Admin,
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@tourops.test'],
            [
                'name' => 'Tour Staff',
                'password' => Hash::make('Staff@12345'),
                'role' => UserRole::Staff,
            ]
        );

        $guides = collect([
            ['name' => 'Sopheak Chan', 'skills' => 'History, English, First Aid', 'photo' => 'img/Kimkuy1.jpg'],
            ['name' => 'Dara Meas', 'skills' => 'Hiking, Wildlife, Khmer', 'photo' => 'img/Kimkuy2.jpg'],
            ['name' => 'Vanna Sok', 'skills' => 'Photography, French, Diving', 'photo' => 'img/Kimkuy3.jpg'],
            ['name' => 'Bopha Ly', 'skills' => 'Cooking, Culture, English', 'photo' => 'img/Kimkuy4.jpg'],
            ['name' => 'Rithy Pov', 'skills' => 'Temples, Archaeology, Japanese', 'photo' => 'img/Kimkuy5.jpg'],
            ['name' => 'Sreyneang Kim', 'skills' => 'Beaches, Island Hopping, English', 'photo' => 'img/Kimkuy6.jpg'],
            ['name' => 'Chanthy Ros', 'skills' => 'Mountain Trekking, Wildlife, Khmer', 'photo' => 'img/Kimkuy7.jpg'],
            ['name' => 'Pisach Nou', 'skills' => 'City Tours, Nightlife, English', 'photo' => 'img/Kimkuy8.jpg'],
            ['name' => 'Kanha Sam', 'skills' => 'Cycling, Village Life, French', 'photo' => 'img/Kimkuy9.jpg'],
            ['name' => 'Thida Heng', 'skills' => 'Cooking Classes, Markets, English', 'photo' => 'img/Kimkuy10.jpg'],
            ['name' => 'Vibol Ouk', 'skills' => 'River Cruise, Fishing, Khmer', 'photo' => 'img/Kimkuy11.jpg'],
            ['name' => 'Malis Chea', 'skills' => 'Photography Tours, Sunrise Treks, English', 'photo' => 'img/Kimkuy12.jpg'],
        ])->map(fn($g) => TourGuide::updateOrCreate(
                ['email' => Str::slug($g['name']) . '@tourist.test'],
                [
                    'name' => $g['name'],
                    'phone' => '012 ' . rand(100, 999) . ' ' . rand(100, 999),
                    'bio' => "{$g['name']} has been guiding travelers around Cambodia for over 5 years, sharing local stories and hidden gems along the way.",
                    'skills' => $g['skills'],
                    'photo' => $g['photo'],
                    'status' => 'active',
                ]
            ));

        $vehicles = collect([
            ['type' => 'van', 'capacity' => 12],
            ['type' => 'car', 'capacity' => 4],
            ['type' => 'bus', 'capacity' => 30],
            ['type' => 'tuktuk', 'capacity' => 3],
        ])->map(fn($v, $i) => Vehicle::updateOrCreate(
                ['plate_number' => 'PP-' . (1000 + $i)],
                [
                    'type' => $v['type'],
                    'capacity' => $v['capacity'],
                    'driver_name' => 'Driver ' . chr(65 + $i),
                    'driver_phone' => '017 ' . rand(100, 999) . ' ' . rand(100, 999),
                    'status' => 'available',
                ]
            ));

        $placeDestinations = [
            ['name' => 'Siem Reap', 'discount' => '30% OFF', 'image_path' => 'img/Angkor-Wat.avif'],
            ['name' => 'Phnom Penh', 'discount' => '25% OFF', 'image_path' => 'img/Phnom-Penh-1.jpg'],
            ['name' => 'Sihanoukville', 'discount' => '35% OFF', 'image_path' => 'img/Sihanoukville.jpg'],
            ['name' => 'Kampot', 'discount' => '20% OFF', 'image_path' => 'img/Kampot-City.webp'],
        ];

        foreach ($placeDestinations as $place) {
            Destination::updateOrCreate(['name' => $place['name']], $place);
        }

        $destinations = [
            ['title' => 'Angkor Wat Sunrise Adventure', 'destination' => 'Siem Reap', 'days' => 3, 'nights' => 2, 'price' => 189, 'image' => 'img/Angkor-Wat_SunRise.jpg'],
            ['title' => 'Phnom Penh City & History Tour', 'destination' => 'Phnom Penh', 'days' => 2, 'nights' => 1, 'price' => 99, 'image' => 'img/Phnom-Penh-History.jpg'],
            ['title' => 'Koh Rong Island Escape', 'destination' => 'Sihanoukville', 'days' => 4, 'nights' => 3, 'price' => 259, 'image' => 'img/Koh-Rong.avif'],
            ['title' => 'Kampot Pepper Farm & River Cruise', 'destination' => 'Kampot', 'days' => 2, 'nights' => 1, 'price' => 89, 'image' => 'img/kampot-pepper-river.jpg'],
            ['title' => 'Battambang Bamboo Train Experience', 'destination' => 'Battambang', 'days' => 2, 'nights' => 1, 'price' => 79, 'image' => 'img/Battambang-Bamboo.jpg'],
            ['title' => 'Mondulkiri Waterfalls & Elephants', 'destination' => 'Mondulkiri', 'days' => 3, 'nights' => 2, 'price' => 219, 'image' => 'img/Mondulkiri.jpg'],
            ['title' => 'Ratanakiri Volcanic Lake Trek', 'destination' => 'Ratanakiri', 'days' => 3, 'nights' => 2, 'price' => 199, 'image' => 'img/Ratanakiri.webp'],
            ['title' => 'Tonle Sap Floating Villages', 'destination' => 'Siem Reap', 'days' => 1, 'nights' => 0, 'price' => 49, 'image' => 'img/Tonle-sap.jpg'],
            ['title' => 'Kep Crab Market & Coastal Ride', 'destination' => 'Kep', 'days' => 1, 'nights' => 0, 'price' => 55, 'image' => 'img/Kep.jpg'],
            ['title' => 'Preah Vihear Temple Expedition', 'destination' => 'Preah Vihear', 'days' => 2, 'nights' => 1, 'price' => 149, 'image' => 'img/Preah_Vihear.jpg'],
            ['title' => 'Cardamom Mountains Jungle Trek', 'destination' => 'Koh Kong', 'days' => 4, 'nights' => 3, 'price' => 279, 'image' => 'img/Cardamom-Mountains.webp'],
            ['title' => 'Sen Monorom Countryside Cycling', 'destination' => 'Mondulkiri', 'days' => 2, 'nights' => 1, 'price' => 119, 'image' => 'img/sen-monorom.jpg'],
            ['title' => 'Oudong Mountain Pilgrimage', 'destination' => 'Kampong Speu', 'days' => 1, 'nights' => 0, 'price' => 45, 'image' => 'img/Oudong-Mountain.jpg'],
            ['title' => 'Kirirom National Park Getaway', 'destination' => 'Kampong Speu', 'days' => 2, 'nights' => 1, 'price' => 109, 'image' => 'img/Kirirom.jpg'],
        ];

        foreach ($destinations as $i => $d) {
            $slug = Str::slug($d['title']);

            $package = TourPackage::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $d['title'],
                    'destination' => $d['destination'],
                    'description' => "Discover {$d['destination']} on this {$d['days']}-day journey. Enjoy guided sightseeing, local cuisine, and unforgettable experiences with our expert local guides.",
                    'price' => $d['price'],
                    'duration_days' => $d['days'],
                    'duration_nights' => $d['nights'],
                    'cover_image' => $d['image'],
                    'status' => 'active',
                ]
            );

            // Only seed itinerary/schedules the first time this package is created,
            // so re-running the seeder doesn't keep piling up duplicates.
            if (!$package->wasRecentlyCreated) {
                continue;
            }

            for ($day = 1; $day <= max($d['days'], 1); $day++) {
                ItineraryItem::create([
                    'tour_package_id' => $package->id,
                    'day_number' => $day,
                    'title' => $day === 1 ? 'Arrival & Orientation' : "Explore {$d['destination']} - Day {$day}",
                    'description' => 'Guided activities, local meals, and free time to explore at your own pace.',
                    'location' => $d['destination'],
                ]);
            }

            foreach ([now()->addDays(10 + $i), now()->addDays(30 + $i)] as $date) {
                TourSchedule::create([
                    'tour_package_id' => $package->id,
                    'tour_guide_id' => $guides->random()->id,
                    'vehicle_id' => $vehicles->random()->id,
                    'departure_date' => $date->toDateString(),
                    'pickup_point' => 'Central Meeting Point, ' . $d['destination'],
                    'pickup_time' => '07:00',
                    'max_seats' => 12,
                    'seats_booked' => 0,
                    'status' => 'scheduled',
                ]);
            }
        }

        // Sample booking for the default test user, if present and they don't already have one
        if (($user = User::where('email', 'test@example.com')->first()) && !Booking::where('user_id', $user->id)->exists()) {
            $schedule = TourSchedule::first();

            Booking::create([
                'booking_code' => 'BK-' . strtoupper(Str::random(8)),
                'user_id' => $user->id,
                'tour_schedule_id' => $schedule->id,
                'number_of_people' => 2,
                'total_price' => $schedule->tourPackage->price * 2,
                'status' => 'confirmed',
            ]);

            $schedule->increment('seats_booked', 2);
        }
    }
}