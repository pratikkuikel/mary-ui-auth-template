<div>
    <x-header title="Verify your email" separator progress-indicator>
    </x-header>

    @if (Session::has('message'))
        <span style="color: green;">{{ Session::get('message') }}</span>
    @endif

    <x-form wire:submit="resendVerification">
        <x-alert title="Check your email for the verification link !" icon="o-exclamation-triangle" />
        <div>
            <x-button class="btn-primary btn-sm" label="Resend Verification Link" type="submit" spinner="save" />
        </div>
    </x-form>
</div>
