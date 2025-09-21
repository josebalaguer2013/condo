<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component
{
    /* ---------- CAMPOS DEL FORMULARIO ---------- */
    public string $name = '';               // Nombre del propietario
    public string $apellido = '';           // Apellido (nuevo)
    public string $dni = '';                // DNI único (nuevo)
    public string $telefono = '';           // Teléfono (nuevo)
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * REGLAS DE VALIDACIÓN
     * Se aplican cuando el usuario presiona “Create account”
     */
    protected function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'apellido'  => ['required', 'string', 'max:255'],
            'dni'       => ['required', 'string', 'max:8', 'unique:users,dni'], // único en tabla users
            'telefono'  => ['nullable', 'string', 'max:20'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * MÉTODO PRINCIPAL: se ejecuta al enviar el formulario
     */
    public function register(): void
    {
        // 1) Validar con las reglas de arriba
        $validated = $this->validate();

        // 2) Encriptar contraseña
        $validated['password'] = Hash::make($validated['password']);

        // 3) Crear usuario en la BD
        $user = User::create($validated);

        // 4) Disparar evento de registro (opcional pero recomendado)
        event(new Registered($user));

        // 5) Iniciar sesión automáticamente
        Auth::login($user);

        // 6) Redirigir al dashboard
        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-4">

        <!-- Nombre -->
        <flux:input wire:model="name" label="Nombre" type="text" required autofocus />

        <!-- Apellido -->
        <flux:input wire:model="apellido" label="Apellido" type="text" required />

        <!-- DNI -->
        <flux:input wire:model="dni" label="DNI" type="text" required maxlength="8" />

        <!-- Teléfono -->
        <flux:input wire:model="telefono" label="Teléfono (opcional)" type="text" />

        <!-- Email -->
        <flux:input wire:model="email" label="Correo electrónico" type="email" required />

        <!-- Contraseña -->
        <flux:input wire:model="password" label="Contraseña" type="password" required viewable />

        <!-- Confirmar contraseña -->
        <flux:input wire:model="password_confirmation" label="Confirmar contraseña" type="password" required viewable />

        <!-- Botón -->
        <flux:button type="submit" variant="primary" class="w-full">
            Crear cuenta
        </flux:button>
    </form>

    <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
        ¿Ya tienes cuenta?
        <flux:link :href="route('login')" wire:navigate>Iniciar sesión</flux:link>
    </div>
