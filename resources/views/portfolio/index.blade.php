
@extends('portfolio.extendapp')
@section('title', 'Portfolio')

    <header id="header" class="header dark-background d-flex flex-column">
        <i class="header-toggle d-xl-none bi bi-list"></i>

              
    <div class="profile-img">
    @if (Auth::user()->role === 'admin')
    <img src="/icon/img.png" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 50%;object-fit: cover;">
    @else
    <img src="{{ auth()->user()->logo }}" alt="" class="img-fluid" style="width: 100px; height: 100px; border-radius: 50%;object-fit: cover;">
    @endif
</div>




        <a href="/" class="logo d-flex align-items-center justify-content-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="/icon/icon.png" alt=""> -->
            <h1 class="sitename">{{auth()->user()->name}}
            </h1>
        </a>

        <!-- <div class="social-links text-center">
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        </div> -->

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active"><i class="bi bi-house navicon"></i>Home</a></li>
                @if (Auth::user()->role === 'admin')
                <li><a href="#dashboard"><i class="bi bi-grid navicon"></i> Dashboard</a></li>
                @else
                <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-box-arrow-left navicon"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </ul>
        </nav>

    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

        <div class="d-flex justify-content-center text-center">
        @if (Auth::user()->role === 'admin')
        <img src="/icon/image.png" alt="Portfolio Logo" data-aos="fade-in" class="img-fluid" style="object-fit: cover;">
        @else
        <img src="{{ auth()->user()->logo }}" alt="Portfolio Logo" data-aos="fade-in" class="img-fluid" style="object-fit: cover;">
        @endif
       
    </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <h2>{{auth()->user()->name}}
                </h2>
                @if (Auth::user()->role === 'admin')
                <p><span class="typed" data-typed-items="{{ auth()->user()->skill }},{{ auth()->user()->skill2 }},I'm {{ auth()->user()->skill3 }},I'm {{  auth()->user()->skill4 }}">{{ auth()->user()->skill }}
                    </span><span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span><span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span></p>
                @else
                <p>I'm <span class="typed" data-typed-items="{{ auth()->user()->skill }},{{ auth()->user()->skill2 }},{{ auth()->user()->skill3 }},{{  auth()->user()->skill4 }}">{{ auth()->user()->skill }}
                </span><span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span><span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span></p>
                @endif
            </div>

        </section><!-- /Hero Section -->
        @if (Auth::user()->role === 'admin')

       <!-- Dashboard Section -->
<section id="dashboard" class="about section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Dashboard</h2>

    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

       @include('portfolio.tableuser')

    </div>

</section><!-- /Dashboard Section -->


        @else
        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>About</h2>
                <p>This platform showcases my work, skills, and achievements.  
    Here, you can explore my projects, experiences, and creative journey.  
    Whether you're looking for inspiration, collaboration, or just getting to know my work, feel free to browse around.  
    If you'd like to connect, don't hesitate to reach out!</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

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

            </div>

        </section><!-- /About Section -->
@endif

    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span></span> <strong class="px-1 sitename">Kim_Pasignasigna</strong> <span>All Rights Reserved</span></p>
            </div>
     
        </div>

    </footer>

  