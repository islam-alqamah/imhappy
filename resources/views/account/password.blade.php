<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Update password') }} 
            </h1>
        </div>
    </x-slot>
    
      @livewire('profile.update-password-form')

</x-account-layout>