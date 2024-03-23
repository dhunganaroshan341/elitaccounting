<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Organization;


class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::factory()->count(20)->create();
    }
}
