?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@teater.sch.id'],
            [
                'name'     => 'Admin Teater',
                'email'    => 'admin@teater.sch.id',
                'password' => Hash::make('Admin1234!'),
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat:');
        $this->command->info('   Email    : admin@teater.sch.id');
        $this->command->info('   Password : Admin1234!');
    }
}
