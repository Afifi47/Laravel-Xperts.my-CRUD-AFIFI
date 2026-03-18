<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssessmentFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_management_routes_require_authentication(): void
    {
        $response = $this->get(route('companies.index'));

        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_company_api_returns_employee_count_and_employees_without_a_data_wrapper(): void
    {
        $company = Company::create([
            'name' => 'Acme Corporation',
            'email' => 'contact@acme.test',
            'website' => 'https://acme.test',
        ]);

        Employee::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'company_id' => $company->id,
            'email' => 'jane@acme.test',
            'phone' => '0123456789',
        ]);

        Employee::create([
            'first_name' => 'John',
            'last_name' => 'Smith',
            'company_id' => $company->id,
            'email' => 'john@acme.test',
            'phone' => '0198765432',
        ]);

        $response = $this->getJson(route('api.companies.show', $company));

        $response->assertOk()
            ->assertJsonPath('id', $company->id)
            ->assertJsonPath('name', 'Acme Corporation')
            ->assertJsonPath('employee_count', 2)
            ->assertJsonCount(2, 'employees')
            ->assertJsonPath('employees.0.company_id', $company->id);

        $this->assertArrayNotHasKey('data', $response->json());
    }

    public function test_authenticated_users_can_view_company_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('companies.index'));

        $response->assertOk();
    }

    public function test_authenticated_users_can_delete_a_company(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Delete Me Company',
            'email' => 'delete-company@test.com',
            'website' => 'https://delete-company.test',
        ]);

        $response = $this->actingAs($user)->delete(route('companies.destroy', $company));

        $response->assertRedirect(route('companies.index', absolute: false));
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }

    public function test_authenticated_users_can_delete_an_employee(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Employee Delete Company',
            'email' => 'employee-company@test.com',
            'website' => 'https://employee-company.test',
        ]);

        $employee = Employee::create([
            'first_name' => 'Delete',
            'last_name' => 'Employee',
            'company_id' => $company->id,
            'email' => 'delete-employee@test.com',
            'phone' => '0123456789',
        ]);

        $response = $this->actingAs($user)->delete(route('employees.destroy', $employee));

        $response->assertRedirect(route('employees.index', absolute: false));
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
