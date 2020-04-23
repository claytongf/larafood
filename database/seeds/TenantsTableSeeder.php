<?php

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'cnpj' => '12345678000117',
            'name' => 'Techwing',
            'url' => 'techwing',
            'email' => 'clayton@techwing.com.br'
        ]);
    }
}
