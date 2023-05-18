<?php

namespace Database\Seeders;

use App\Models\Special;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SpecialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@superuser.com',
            'password' => Hash::make('123'),
        ]);

        $specials = [
            'Primary Care & General Medicine',
            'OB-GYNs & Womens Health',
            'Pediatrics',
            'Diabetes & Endocrinology',
            'Eye & Vision Doctor',
            'Lung, Chest, & Pulmonology',
            'Heart & Cardiology',
            'Skin & Dermatology',
            'Stomach, Digestion, & Gastroenterology',
            'Ears, Nose, & Throat',
            'Kidney & Urine',
            'Brain & Nerves'
        ];

        foreach ($specials as $special) {
            Special::create([
                'name' => $special,
                'icon' => 'fas fa-user-md'
            ]);
        }
    }
}
