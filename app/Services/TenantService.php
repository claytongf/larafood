<?php

namespace App\Services;

use App\Models\Plan;

class TenantService
{
    private $plan, $data = [];
    
    public function make(Plan $plan, array $data){
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);
        
        return $user;
    }

    private function storeTenant(){
        $data = $this->data;
        return $this->plan->tenants()->create([
            'cnpj' => $data['cnpj'],
            'name' => $data['empresa'],
            'email' => $data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7)
        ]);
    }

    private function storeUser($tenant){
        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password'])
        ]);
    }
}
