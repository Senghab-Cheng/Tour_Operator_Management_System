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
            ['name' => 'Sopheak Chan', 'skills' => 'History, English, First Aid'],
            ['name' => 'Dara Meas', 'skills' => 'Hiking, Wildlife, Khmer'],
            ['name' => 'Vanna Sok', 'skills' => 'Photography, French, Diving'],
            ['name' => 'Bopha Ly', 'skills' => 'Cooking, Culture, English'],
        ])->map(fn ($g) => TourGuide::create([
            'name' => $g['name'],
            'phone' => '012 '.rand(100, 999).' '.rand(100, 999),
            'email' => Str::slug($g['name']).'@tourist.test',
            'bio' => "{$g['name']} has been guiding travelers around Cambodia for over 5 years, sharing local stories and hidden gems along the way.",
            'skills' => $g['skills'],
            'status' => 'active',
        ]));

        $vehicles = collect([
            ['type' => 'van', 'capacity' => 12],
            ['type' => 'car', 'capacity' => 4],
            ['type' => 'bus', 'capacity' => 30],
            ['type' => 'tuktuk', 'capacity' => 3],
        ])->map(fn ($v, $i) => Vehicle::create([
            'type' => $v['type'],
            'plate_number' => 'PP-'.(1000 + $i),
            'capacity' => $v['capacity'],
            'driver_name' => 'Driver '.chr(65 + $i),
            'driver_phone' => '017 '.rand(100, 999).' '.rand(100, 999),
            'status' => 'available',
        ]));

        $placeDestinations = [
            ['name' => 'Siem Reap', 'discount' => '30% OFF', 'image_path' => 'img/destination-1.'],
            ['name' => 'Phnom Penh', 'discount' => '25% OFF', 'image_path' => 'img/destination-2.jpg'],
            ['name' => 'Sihanoukville', 'discount' => '35% OFF', 'image_path' => 'img/destination-3.jpg'],
            ['name' => 'Kampot', 'discount' => '20% OFF', 'image_path' => 'img/destination-4.jpg'],
        ];

        foreach ($placeDestinations as $place) {
            Destination::updateOrCreate(['name' => $place['name']], $place);
        }

        $destinations = [
            ['title' => 'Angkor Wat Sunrise Adventure', 'destination' => 'Siem Reap', 'days' => 3, 'nights' => 2, 'price' => 189],
            ['title' => 'Phnom Penh City & History Tour', 'destination' => 'Phnom Penh', 'days' => 2, 'nights' => 1, 'price' => 99],
            ['title' => 'Koh Rong Island Escape', 'destination' => 'Sihanoukville', 'days' => 4, 'nights' => 3, 'price' => 259],
            ['title' => 'Kampot Pepper Farm & River Cruise', 'destination' => 'Kampot', 'days' => 2, 'nights' => 1, 'price' => 89],
            ['title' => 'Battambang Bamboo Train Experience', 'destination' => 'Battambang', 'days' => 2, 'nights' => 1, 'price' => 79],
            ['title' => 'Mondulkiri Waterfalls & Elephants', 'destination' => 'Mondulkiri', 'days' => 3, 'nights' => 2, 'price' => 219],
            ['title' => 'Ratanakiri Volcanic Lake Trek', 'destination' => 'Ratanakiri', 'days' => 3, 'nights' => 2, 'price' => 199],
            ['title' => 'Tonle Sap Floating Villages', 'destination' => 'Siem Reap', 'days' => 1, 'nights' => 0, 'price' => 49],
            ['title' => 'Kep Crab Market & Coastal Ride', 'destination' => 'Kep', 'days' => 1, 'nights' => 0, 'price' => 55],
            ['title' => 'Preah Vihear Temple Expedition', 'destination' => 'Preah Vihear', 'days' => 2, 'nights' => 1, 'price' => 149],
            ['title' => 'Cardamom Mountains Jungle Trek', 'destination' => 'Koh Kong', 'days' => 4, 'nights' => 3, 'price' => 279],
            ['title' => 'Sen Monorom Countryside Cycling', 'destination' => 'Mondulkiri', 'days' => 2, 'nights' => 1, 'price' => 119],
            ['title' => 'Oudong Mountain Pilgrimage', 'destination' => 'Kampong Speu', 'days' => 1, 'nights' => 0, 'price' => 45],
            ['title' => 'Kirirom National Park Getaway', 'destination' => 'Kampong Speu', 'days' => 2, 'nights' => 1, 'price' => 109],
        ];

        $images = ['destination-1.jpg', 'destination-2.jpg', 'destination-3.jpg', 'destination-4.jpg'];

        foreach ($destinations as $i => $d) {
            $package = TourPackage::create([
                'title' => $d['title'],
                'slug' => Str::slug($d['title']),
                'destination' => $d['destination'],
                'description' => "Discover {$d['destination']} on this {$d['days']}-day journey. Enjoy guided sightseeing, local cuisine, and unforgettable experiences with our expert local guides.",
                'price' => $d['price'],
                'duration_days' => $d['days'],
                'duration_nights' => $d['nights'],
                'cover_image' => 'img/'.$images[$i % count($images)],
                'status' => 'active',
            ]);

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
                    'pickup_point' => 'Central Meeting Point, '.$d['destination'],
                    'pickup_time' => '07:00',
                    'max_seats' => 12,
                    'seats_booked' => 0,
                    'status' => 'scheduled',
                ]);
            }
        }

        // Sample booking for the default test user, if present
        if ($user = User::where('email', 'test@example.com')->first()) {
            $schedule = TourSchedule::first();

            Booking::create([
                'booking_code' => 'BK-'.strtoupper(Str::random(8)),
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