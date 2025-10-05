<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mevcut admin kullanıcısını güncelle veya oluştur
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@university.edu',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
                'approved_at' => now(),
            ]
        );

        $this->command->info('Super Admin kullanıcısı güncellendi:');
        $this->command->info('Email: superadmin@university.edu');
        $this->command->info('Password: password123');
    }
}
