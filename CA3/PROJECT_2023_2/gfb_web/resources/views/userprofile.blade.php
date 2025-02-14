<x-app-layout>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- ======= Portfolio Section ======= -->
                    <section id="portfolio" class="portfolio">
                        <div class="container">
                            <section id="service" class="service">
                                <div class="container">
                            
                    
                            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
                    
                                
                                    hhhhhhhhhhhhhhhhhhh
                                    <p>{{ $user->name }}</p>
                                    <p>{{ $user->email }}</p>
                              
                                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                        @csrf
                                        @method('put')
                                
                                        <div>
                                            <x-input-label for="current_password" :value="__('Current Password')" />
                                            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                        </div>
                                
                                        <div>
                                            <x-input-label for="password" :value="__('New Password')" />
                                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                        </div>
                                
                                        <div>
                                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                        </div>
                                
                                        <div class="flex items-center gap-4">
                                            <x-primary-button style="background-color: #3498db; color:white;border-radius:5px">{{ __('Save') }}</x-primary-button>
                                
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
                            </div></div></section>
                    
                            </div>
                           
                        </div>
                    </section><!-- End Portfolio Section -->
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>