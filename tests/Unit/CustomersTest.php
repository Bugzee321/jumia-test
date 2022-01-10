<?php

namespace Tests\Unit;

use App\Http\Controllers\CustomersController;
use App\Models\Country;
use Illuminate\Http\Request;
use Tests\TestCase;

class CustomersTest extends TestCase
{
    /**
     * Test passing invalid country.
     *
     * @return void
     */
    public function testCustomerPage(){
        //check if the page load with status 200 on normal behavior
        $countries = Country::select('code', 'name')->get();
        $response = $this->get(route('customers.index'));
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertViewHas('countries', $countries);

        // test filter with country
        $country  = Country::first();
        $response = $this->get(route('customers.index') . '?country=' . $country->code);
        $response->assertStatus(200);
        $response->assertSee($country->name);

        // test filter with valid state
        $response = $this->get(route('customers.index') . '?state=1');
        $response->assertStatus(200);
        $response->assertSee('Valid');

        // test filter with invalid state
        $response = $this->get(route('customers.index') . '?state=0');
        $response->assertStatus(200);
        $response->assertSee('Invalid');
    }
}
