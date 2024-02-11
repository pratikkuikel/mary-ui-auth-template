<div>
    <x-header title="Forgot Password" separator progress-indicator>
    </x-header>

    @if (Session::has('message'))
        <span style="color: green;">{{ Session::get('message') }}</span>
    @endif
    @if (Session::has('email'))
        <span style="color: red;">{{ Session::get('email') }}</span>
    @endif

    <x-form wire:submit="sendVerificationMail">
        <x-input label="Email" icon="o-envelope" wire:model="email" hint="Enter your email" />
        <x-slot:actions>
            <x-button class="btn-primary" label="Send" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>

</div>
