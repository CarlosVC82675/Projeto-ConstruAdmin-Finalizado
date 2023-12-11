<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TelefoneUsuario;
use App\Models\Usuario;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cpf = $this->faker->unique()->numerify('###########');

        return [
            'Estoque_idEstoque' => 1,
            'name' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'genero' => $this->faker->randomElement(['FEMININO', 'MASCULINO']),
            'cep' => $this->faker->postcode,
            'cpf' =>  $cpf,
            'pais' => $this->faker->country,
            'cidade' => $this->faker->city,
            'estado' => $this->faker->state,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt($cpf),
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Usuario  $usuario) {
            $usuario->telefones()->saveMany(
                TelefoneUsuario::factory()->count(2)->make()
            );
            $roles = Role::all();
            $role = $roles->random();
            $usuario->assignRole($role);
        });
    }
}

