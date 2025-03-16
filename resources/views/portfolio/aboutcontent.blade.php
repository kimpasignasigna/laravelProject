<div class="row gy-4 justify-content-center">
                    <div class="col-lg-4">
                    <img src="{{ auth()->user()->logo }}" class="img-fluid" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-lg-8 content">
                        <h2>Background Profile.</h2>
                        <p class="fst-italic py-3">
                      
                        @if(isset($portfolio))
    <!-- Show Edit & Delete Buttons if data exists -->
    <a href="#" class="btn btn-success" id="editBackgroundProfile">
        Edit Background Profile
    </a>

    <form id="deleteBackgroundProfileForm" 
      action="{{ route('portfolios.destroy', $portfolio->id) }}" 
      method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button" id="deleteBackgroundProfile" class="btn btn-danger">
        Delete Background Profile
    </button>
</form>
@else
    <!-- Show Add Button if no data exists -->
    <a href="#" class="btn btn-primary" id="addBackgroundProfile">
        Add Background Profile
    </a>
@endif
 


<script>
    document.getElementById("deleteBackgroundProfile").addEventListener("click", function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to undo this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteBackgroundProfileForm").submit();
            }
        });
    });
</script>
<script>
document.getElementById("addBackgroundProfile").addEventListener("click", function(event) {
    event.preventDefault();

    Swal.fire({
        title: "Add Background Profile",
        html: `
            <form id="backgroundProfileForm" action="{{ route('portfolios.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="phone" id="phone" class="swal2-input" placeholder="Phone Number" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="date" name="birthday" id="birthday" class="swal2-input" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="text" name="city" id="city" class="swal2-input" placeholder="City" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="text" name="degree" id="degree" class="swal2-input" placeholder="Degree" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="number" name="age" id="age" class="swal2-input" placeholder="Age" required style="width: 80%; font-size: 14px; padding: 6px;">
                <textarea id="messagetext" name="messagetext" class="swal2-textarea" placeholder="Message" style="width: 80%; font-size: 14px; padding: 6px;"></textarea>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: "Save",
        cancelButtonText: "Cancel",
        preConfirm: () => {
            const form = document.getElementById("backgroundProfileForm");
            if (!form.checkValidity()) {
                Swal.showValidationMessage("Please fill in all required fields.");
                return false;
            }
            return new FormData(form); // Get form data
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = result.value;

            const form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('portfolios.store') }}";

            // CSRF Token
            const csrfInput = document.createElement("input");
            csrfInput.type = "hidden";
            csrfInput.name = "_token";
            csrfInput.value = "{{ csrf_token() }}";
            form.appendChild(csrfInput);

            // Append all form data fields
            for (const [key, value] of formData.entries()) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = key;
                input.value = value;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit(); // Submit the form
        }
    });
});


</script>

@if(isset($portfolio))
<script>
document.getElementById("editBackgroundProfile").addEventListener("click", function(event) {
    event.preventDefault();

    // Fetch existing data (Replace these variables with actual values from backend)
    let phone = "{{ $portfolio->phone ?? '' }}";
    let birthday = "{{ $portfolio->birthday ?? '' }}";
    let city = "{{ $portfolio->City ?? '' }}";
    let degree = "{{ $portfolio->Degree ?? '' }}";
    let age = "{{ $portfolio->Age ?? '' }}";
    let messagetext = "{{ $portfolio->messageText ?? '' }}";

    Swal.fire({
        title: "Edit Background Profile",
        html: `
            <form id="backgroundProfileForm">
                <input type="text" name="phone" value="${phone}" class="swal2-input" placeholder="Phone Number" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="date" name="birthday" value="${birthday}" class="swal2-input" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="text" name="city" value="${city}" class="swal2-input" placeholder="City" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="text" name="degree" value="${degree}" class="swal2-input" placeholder="Degree" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="number" name="age" value="${age}" class="swal2-input" placeholder="Age" required style="width: 80%; font-size: 14px; padding: 6px;">
                <textarea name="messagetext" class="swal2-textarea" placeholder="Message" style="width: 80%; font-size: 14px; padding: 6px;">${messagetext}</textarea>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: "Update",
        cancelButtonText: "Cancel",
        preConfirm: () => {
            const form = document.getElementById("backgroundProfileForm");
            if (!form.checkValidity()) {
                Swal.showValidationMessage("Please fill in all required fields.");
                return false;
            }
            return new FormData(form);
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = result.value;
            const form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('portfolios.update', $portfolio->id) }}";

            // CSRF Token
            const csrfInput = document.createElement("input");
            csrfInput.type = "hidden";
            csrfInput.name = "_token";
            csrfInput.value = "{{ csrf_token() }}";
            form.appendChild(csrfInput);

            // Spoof the PUT method (since HTML forms don't support PUT)
            const methodInput = document.createElement("input");
            methodInput.type = "hidden";
            methodInput.name = "_method";
            methodInput.value = "PUT";
            form.appendChild(methodInput);

            // Append all form data fields
            for (const [key, value] of formData.entries()) {
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = key;
                input.value = value;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>
@endif
<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    @endif
});
</script>
                        </p>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    @if($portfolio)
                                    <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>{{$portfolio->birthday}}</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Phone:</strong> <span>{{$portfolio->phone}}</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>{{$portfolio->City}}</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span>{{$portfolio->Age}}</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong> <span>{{$portfolio->Degree}}</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <span>{{ Auth::user()->email }}</span></li>                                </ul>
                            </div>
                        </div>
                        <p class="py-3">
                      {{$portfolio->messageText}}
                        </p>
                        @endif
                    </div>
                </div>