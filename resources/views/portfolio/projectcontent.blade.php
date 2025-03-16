<div class="row gy-4 justify-content-center">
                    <div class="col-lg-4">
                    <img src="{{ auth()->user()->logo }}" class="img-fluid" alt="" style="width: 200px; height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-lg-8 content">
                        <h2>Save Projects.</h2>
                        <p class="fst-italic py-3">
                      
                     
 


    <!-- Show Add Button if no data exists -->
    <a href="#" class="btn btn-primary" id="addProject">
        Add Your Project
    </a>

    <script>
document.getElementById("addProject").addEventListener("click", function(event) {
    event.preventDefault();

    Swal.fire({
        title: "Add Project",
        html: `
            <form id="projectForm" enctype="multipart/form-data">
                <input type="text" name="name" id="name" class="swal2-input" placeholder="Project Name" required style="width: 80%; font-size: 14px; padding: 6px;">
                <input type="file" name="projectfile" id="projectfile" class="swal2-input" required style="width: 80%; font-size: 14px; padding: 6px;">
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: "Save",
        cancelButtonText: "Cancel",
        preConfirm: () => {
            const popup = Swal.getPopup();
            const name = popup.querySelector("#name").value;
            const fileInput = popup.querySelector("#projectfile").files[0];

            if (!name || !fileInput) {
                Swal.showValidationMessage("Please fill in all required fields.");
                return false;
            }

            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}"); // Add CSRF token
            formData.append("name", name);
            formData.append("projectfile", fileInput);

            return fetch("{{ route('projects.store') }}", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    return Swal.fire("Success", "Project added successfully!", "success")
                        .then(() => location.reload());
                } else {
                    throw new Error(data.message || "Something went wrong!");
                }
            })
            .catch(error => {
                Swal.fire("Error", error.message || "Failed to upload project. Please try again.", "error");
            });
        }
    });
});
</script>






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
                                    @foreach ($projects as $project)
                                    <li><i class="bi bi-chevron-right"></i> <strong>Name:</strong> <span>{{$project->name}}</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>File:</strong> <span> <a href="{{ asset($project->projectfile) }}" target="_blank">
        {{$project->projectfile}}
    </a></span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Date:</strong> <span>{{$project->created_at}}</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Edit:</strong> <span>
                                           <!-- Show Edit & Delete Buttons if data exists -->
    <a href="#" class="btn btn-success" id="editProject">
        Edit Your Project
    </a>

    <script>
document.getElementById("editProject").addEventListener("click", function(event) {
    event.preventDefault();

    // Fetch existing data
    let name = "{{ $project->name ?? '' }}";
    let projectfile = "{{ $project->projectfile ?? '' }}"; // This is just the filename/path

    Swal.fire({
        title: "Edit Project",
        html: `
            <form id="editProjectForm" enctype="multipart/form-data">
                <input type="text" name="name" id="name" value="${name}" class="swal2-input" placeholder="Project Name" required style="width: 80%; font-size: 14px; padding: 6px;">
                
                <!-- Show the file name separately -->
                <p>Current File: ${projectfile ? projectfile.split('/').pop() : "No file uploaded"}</p>
                
                <input type="file" name="projectfile" id="projectfile" class="swal2-input" style="width: 80%; font-size: 14px; padding: 6px;">
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: "Update",
        cancelButtonText: "Cancel",
        preConfirm: () => {
            const popup = Swal.getPopup();
            const name = popup.querySelector("#name").value;
            const fileInput = popup.querySelector("#projectfile").files[0];

            if (!name) {
                Swal.showValidationMessage("Project Name is required.");
                return false;
            }

            const formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("_method", "PUT");
            formData.append("name", name);

            if (fileInput) {
                formData.append("projectfile", fileInput);
            }

            return fetch("{{ route('projects.update', $project->id) }}", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    return Swal.fire("Success", "Project updated successfully!", "success")
                        .then(() => location.reload());
                } else {
                    throw new Error(data.message || "Something went wrong!");
                }
            })
            .catch(error => {
                Swal.fire("Error", error.message || "Failed to update project. Please try again.", "error");
            });
        }
    });
});
</script>



                                    </span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Delete:</strong> <span>
                                    <form id="deleteProjectForm" 
      action="{{ route('projects.destroy', $project->id) }}" 
      method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button" id="deleteProject" class="btn btn-danger">
        Delete Project
    </button>
</form>

<script>
    document.getElementById("deleteProject").addEventListener("click", function(event) {
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
                document.getElementById("deleteProjectForm").submit();
            }
        });
    });
</script>
                                    </span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <p class="py-3">
                    
                        </p>
                    </div>
                </div>

