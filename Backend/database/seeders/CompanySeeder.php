<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin maestro (ojo: cambiar pass en prod)
        $user = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin Tester',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Empresas mock para probar el dashboard
        Company::create([
            'name' => 'Tech Solutions El Salvador S.A. de C.V.',
            'industry' => 'Tecnología',
            'country' => 'El Salvador',
            'region' => 'San Salvador',
            'keywords' => ['software', 'cloud', 'ai', 'desarrollo web'],
            'user_id' => $user->id,
        ]);

        Company::create([
            'name' => 'Cafetalera La Esperanza',
            'industry' => 'Alimentos',
            'country' => 'El Salvador',
            'region' => 'Santa Ana',
            'keywords' => ['café de altura', 'exportación', 'orgánico'],
            'user_id' => $user->id,
        ]);
    }
}
