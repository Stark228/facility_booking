<x-admin-component>
   
        <div class="main-content">
            <div class="row g-10">
                                <div class="py-12">
                                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                            <div class="max-w-xl">
                                                @include('profile.partials.update-profile-information-form')
                                            </div>
                                        </div>
                            
                                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                            <div class="max-w-xl">
                                                @include('profile.partials.update-password-form')
                                            </div>
                                        </div>

                                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                            <div class="max-w-xl">
                                                <button type="button" class="btn btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalFull" style="background-color: #3498db; color:white">
                                                    Edit
                                                </button>&nbsp;<span>Terms and conditions</span>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModalFull" tabindex="-1" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterLabel">Team and conditions</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.createteam') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf <!-- Add CSRF token for security -->
                                                          
                                                            <div class="form-group mb-20">
                                                                <label class="form-label">Category</label>
                                                                <select name="category_id" id="category" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="form-group mb-20">
                                                                <label class="form-label">Facility</label>
                                                                <select name="subcategory_id" id="subcategory" class="form-control" required>
                                                                    <option value="">--select--</option>
                                                                    <!-- Subcategories will be populated dynamically -->
                                                                </select>
                                                            </div>
                                                            
                                                            <div id="dynamicFields" style="display: none">
                                                            
                                                                <div class="form-group mb-20">
                                                                    <label class="form-label">PDF File</label>
                                                                    <input type="file" name="image" accept="application/pdf,application/vnd.ms-excel" />
                                                                </div>
                                                            
                                                            
                
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success" style="background-color: #3498db; color:white">Upload</button>
                                                            </div>
                                                            </div>
                                                          
                                                        </form>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                            
                                       
                                    </div>
                                </div>
                            
                 
                

            </div>      
        </div>
            
            
    {{-- form display=====================================================================================
    ================================================================================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var subcategoryField = document.getElementById('subcategory');
            var dynamicFields = document.getElementById('dynamicFields');
    
            // dynamicFields.style.display = 'none';
            // Listen for changes in the category select
            subcategoryField.addEventListener('change', function () {
                // Check if both category and subcategory are selected
                if (subcategoryField.value !== '') {
                    // Display the dynamic fields if both are selected
                    dynamicFields.style.display = 'block';
                } else {
                    // Hide the dynamic fields if one or both are not selected
                    dynamicFields.style.display = 'none';
                }
            });
        });
    </script>   
    {{-- book form=======================================================================
================================================================================ --}}
<script>
    // Fetch the subcategories corresponding to each category
    const subcategoriesByCategory = {
        @foreach($categories as $category)
            "{{ $category->id }}": [
                @foreach($category->subcategories as $subcategory)
                    { id: "{{ $subcategory->id }}", name: "{{ $subcategory->facility_name }}" },
                @endforeach
            ],
        @endforeach
    };

    // Function to populate subcategory dropdown based on selected category
    document.getElementById('category').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategoryDropdown = document.getElementById('subcategory');

        // Clear previous options
        subcategoryDropdown.innerHTML = '<option value="">--select--</option>';

        // Populate subcategories for the selected category
        if (categoryId && subcategoriesByCategory[categoryId]) {
            subcategoriesByCategory[categoryId].forEach(subcategory => {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.text = subcategory.name;
                subcategoryDropdown.appendChild(option);
            });
        }
    });
</script>    
 

    <script>
        function fireSweetAlertUpdatePassword() {
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Update Password has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
    <script>
        function fireSweetAlertEditTC() {
            Swal.fire({
                position: 'top',
                icon: 'success',
                title: 'Changes has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>

    {{-- 
pop-up==============================================================
=================================================================== --}}
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            position: 'top',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
    
</x-admin-component>