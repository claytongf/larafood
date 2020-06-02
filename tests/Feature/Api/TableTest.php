<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error Get Tables By Tenant.
     *
     * @return void
     */
    public function testErrorGetTablesByTenant()
    {
        $response = $this->getJson('/api/v1/tables');
        // $response->dump();
        $response->assertStatus(422);
    }

    /**
     * Get All Tables By Tenant.
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");
        // $response->dump();

        $response->assertStatus(200);
    }

    /**
     * Error Get Table by Tenant.
     *
     * @return void
     */
    public function testErrorGetTableByTenant()
    {
        $table = 'fake_value';

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");
        // $response->dump();

        $response->assertStatus(404);
    }

    /**
     * Get Table by Tenant.
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $table = factory(Table::class)->create();

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");
        // $response->dump();

        $response->assertStatus(200);
    }
}
