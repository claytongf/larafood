<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error Get Categories By Tenant.
     *
     * @return void
     */
    public function testErrorGetCategoriesByTenant()
    {
        $response = $this->getJson('/api/v1/categories');
        // $response->dump();
        $response->assertStatus(422);
    }

    /**
     * Get All Categories By Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");
        // $response->dump();

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant.
     *
     * @return void
     */
    public function testErrorGetCategoryByTenant()
    {
        $category = 'fake_value';

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");
        // $response->dump();

        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant.
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $category = factory(Category::class)->create();

        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");
        // $response->dump();

        $response->assertStatus(200);
    }
}
