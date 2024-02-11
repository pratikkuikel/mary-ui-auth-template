<div>
    <x-header :title="$title" separator progress-indicator>
    </x-header>
    <x-form wire:submit="register">
        <x-input label="Name" icon="o-user" wire:model="name" hint="Enter your Name" />

        <x-input label="Email" icon="o-envelope" wire:model="email" hint="Enter your email" />

        <x-input label="Password" wire:model="password" icon="o-key" type="password" hint="Enter your password" />

        <x-slot:actions>
            <x-button class="btn-success" label="Register" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
