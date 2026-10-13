<?php
namespace Database\Seeders;

use App\Models\Article;
use App\Models\Event;
use App\Models\Member;
use App\Models\Performance;
use App\Models\InventoryItem;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::updateOrCreate(['email' => 'admin@teater.sch.id'], [
            'name'     => 'Admin Teater',
            'email'    => 'admin@teater.sch.id',
            'password' => Hash::make('Admin1234!'),
        ]);
        $this->command->info('Admin OK');

        // 2. Members (20)
        Member::factory(20)->create();
        $this->command->info('20 Members OK');

        // 3. Events (15)
        Event::factory(15)->create();
        $this->command->info('15 Events OK');

        // 4. Galleries (20)
        \App\Models\Gallery::factory(20)->create();
        $this->command->info('20 Galleries OK');

        // 5. Articles (15)
        Article::factory(15)->create();
        $this->command->info('15 Articles OK');

        // 6. Registrations (18)
        \App\Models\Registration::factory(18)->create();
        $this->command->info('18 Registrations OK');

        // 7. Attendances (avoid duplicate member+event)
        $members = Member::pluck('id')->toArray();
        $events  = Event::pluck('id')->toArray();
        $used = [];
        $count = 0;
        while ($count < 40) {
            $mid = $members[array_rand($members)];
            $eid = $events[array_rand($events)];
            $key = "$mid-$eid";
            if (!in_array($key, $used)) {
                $used[] = $key;
                Attendance::create([
                    'member_id'  => $mid,
                    'event_id'   => $eid,
                    'status'     => collect(['hadir','hadir','hadir','izin','alpha'])->random(),
                    'keterangan' => rand(0,1) ? 'Hadir tepat waktu.' : null,
                ]);
                $count++;
            }
        }
        $this->command->info('40 Attendances OK');

        // 8. Achievements (15)
        \App\Models\Achievement::factory(15)->create();
        $this->command->info('15 Achievements OK');

        // 9. Testimonials (16)
        \App\Models\Testimonial::factory(16)->create();
        $this->command->info('16 Testimonials OK');

        // 10. Comments (20)
        \App\Models\Comment::factory(20)->create();
        $this->command->info('20 Comments OK');

        // 11. Newsletters (25)
        \App\Models\Newsletter::factory(25)->create();
        $this->command->info('25 Newsletters OK');

        // 12. Performances (6)
        Performance::factory(6)->create();
        $this->command->info('6 Performances OK');

        // 13. Ticket Reservations (25)
        \App\Models\TicketReservation::factory(25)->create();
        $this->command->info('25 Ticket Reservations OK');

        // 14. Inventory Items (20)
        InventoryItem::factory(20)->create();
        $this->command->info('20 Inventory Items OK');

        // 15. Inventory Logs (20)
        \App\Models\InventoryLog::factory(20)->create();
        $this->command->info('20 Inventory Logs OK');

        // 16. Podcast Episodes (15)
        \App\Models\PodcastEpisode::factory(15)->create();
        $this->command->info('15 Podcast Episodes OK');

        $this->command->newLine();
        $this->command->info('Seeding selesai! Database teater_sekolah siap.');
    }
}