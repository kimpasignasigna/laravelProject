
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
                <li><a href="#project"><i class="bi bi-folder navicon"></i> Project</a></li>
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
                <p>You can add your personal background profile details here.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @include('portfolio.aboutcontent')

            </div>

        </section><!-- /About Section -->


           <!-- Project Section -->
           <section id="project" class="about section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
    <h2>Project</h2>
    <p>Here, you can showcase and add your projects. Upload files, share details, and highlight your work!</p>
</div><!-- End Section Title -->

<div class="container" data-aos="fade-up" data-aos-delay="100">

    @include('portfolio.projectcontent')

</div>

</section><!-- /Project Section -->
        
@endif

    </main>

    <footer id="footer" class="footer position-relative light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span></span> <strong class="px-1 sitename">Kim_Pasignasigna</strong> <span>All Rights Reserved</span></p>
            </div>
     
        </div>

    </footer>

  