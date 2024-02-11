<div>
    <x-header title="Reset Your Password" separator progress-indicator>
    </x-header>

    @if (Session::has('message'))
        <span style="color: green;">{{ Session::get('message') }}</span>
    @endif
    @if (Session::has('email'))
        <span style="color: red;">{{ Session::get('email') }}</span>
    @endif

    <x-form wire:submit="updatePassword">
        <x-input wire:model="token" type="hidden" />
        <x-input label="Email" icon="o-envelope" wire:model="email" hint="Enter your email" />
        <x-input label="New Password" wire:model="password" icon="o-key" type="password" hint="Enter your password" />
        <x-input label="Confrim New Password" wire:model="password_confirmation" icon="o-key" type="password" />
        <x-slot:actions>
            <x-button class="btn-primary" label="Reset Password" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>

</div>
