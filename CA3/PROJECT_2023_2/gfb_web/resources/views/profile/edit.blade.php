<x-app-layout>
   
    <section id="service" class="service" data-aos="fade-up">
        <div class="container">

    
       
          <div style="height:15rem">
            @include('profile.partials.update-profile-information-form')
          </div>
                       
                    
                <div>
                    @include('profile.partials.update-password-form')
                    </div>          
                   
                       
                    
                    </div>
                </section>
                {{-- <div class="mt-4 mt-md-5 p-4 p-md-5 bg-white shadow rounded">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div> --}}
    
     
</x-app-layout>
