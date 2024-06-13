<x-app-layout>
    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                
              </div>
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                @foreach ($categories as $category)   
                  
                    <li data-filter=".filter-{{$category->category_name}}">{{$category->category_name}}</li>
                
                @endforeach
              </ul>
            </div>
          </div>
  
          <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">
            @foreach ($subcategories as $subcategory)
                                <div class="col-lg-4 col-md-6 portfolio-item filter-{{$subcategory->category->category_name}}">
                                <div class="portfolio-wrap">
                                
                                    <img src="{{ asset('storage/' . str_replace('public/', '', $subcategory->image)) }}" alt="Facility Image" class="img-fluid" style="width: 100%; height: 300px; object-fit: cover;"/>                                            
                                    <div class="portfolio-info">
                                    <h4>{{$subcategory->facility_name}}</h4>
                                    {{-- <p>Description</p> --}}
                                    <div class="portfolio-links">
                                        <a href="{{ route('subcategory.detail', ['subcategory' => $subcategory]) }}" title="More Details">View Detail</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                             @endforeach
            
          </div>
  
        </div>
      
</x-app-layout>
