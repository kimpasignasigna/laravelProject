<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <link rel="icon" href="{{ asset('/icon/icon.png') }}" type="image/png">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header dark-background d-flex flex-column">
        <i class="header-toggle d-xl-none bi bi-list"></i>

        <div class="profile-img text-center">
    <label for="upload-logo">
        <!-- Display uploaded profile image if available, otherwise show a placeholder -->
        <img id="profile-preview" 
            src="{{ isset($portfolio) && $portfolio->logo ? asset($portfolio->logo) : asset('icon/logoicon.png') }}" 
            alt="Click Here to Upload Your Image" 
            class="img-fluid rounded-circle" 
            style="cursor: pointer; width: 150px; height: 150px; object-fit: cover;">
    </label>

    <!-- Hidden file input -->
    <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        
        <input type="file" name="logo" id="upload-logo" class="d-none" onchange="previewImage(event)">
        <button type="submit" class="btn btn-primary mt-2">Upload</button>
    </form>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('profile-preview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>



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
                <li><a href="#about"><i class="bi bi-person navicon"></i> About</a></li>
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
    @if (!empty($portfolio->logo))
        <img src="{{ asset($portfolio->logo) }}" alt="Portfolio Logo" data-aos="fade-in" class="img-fluid">
        @else
        <img src="{{ asset('icon/logoicon.png') }}" alt="Portfolio Logo" data-aos="fade-in" class="img-fluid">
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
                    @if (!empty($portfolio->logo))
                    <img src="{{ asset($portfolio->logo) }}" class="img-fluid" alt="">
                    @endif
                    </div>
                    <div class="col-lg-8 content">
                        <h2>Background Profile.</h2>
                        <p class="fst-italic py-3">
                        <a href="#" class="btn btn-primary" id="addBackgroundProfile">
    <i class="bi bi-plus"></i> Add Background Profile
</a>
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

    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">Portfolio</strong> <span>All Rights Reserved</span></p>
            </div>
     
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/typed.js/typed.umd.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>