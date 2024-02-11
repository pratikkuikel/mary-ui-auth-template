<div>
    <x-header :title="$title" separator progress-indicator>
    </x-header>
    <x-form wire:submit="authenticate">
        <x-input label="Email" icon="o-envelope" wire:model="email" hint="Enter your email" />
        <x-input label="Password" wire:model="password" icon="o-key" type="password" hint="Enter your password" />

        <x-slot:actions>
            <x-button link="{{ route('password.request') }}" label="Forgot Password" />
            <x-button label="Login" class="btn-success" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
