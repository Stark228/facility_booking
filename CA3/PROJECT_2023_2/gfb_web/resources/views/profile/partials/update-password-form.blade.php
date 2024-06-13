<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" >
        @csrf
        @method('put')

        <div class="form-group mb-20" style="padding: 3px">
            <label class="form-label">Current Password</label>
            <input class="form-control" id="current_password" name="current_password" type="password" autocomplete="current-password" style="width: 90%">
            {{-- <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group mb-20" style="padding: 3px">
            <label class="form-label">New Password</label>
            <input class="form-control" id="password" name="password" type="password" autocomplete="new-password" style="width: 90%">
            {{-- <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-group mb-20" style="padding: 3px">
            <label class="form-label">Confirm Password</label>
            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" style="width: 90%">
            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" /> --}}
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="form-group mb-20 ">
            <button class="btn btn-primary" style="background-color: #3498db; margin-top:20px">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
