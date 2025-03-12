<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>



        <div class="mt-4" style="display: none;">
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" class="block mt-1 w-full" type="text" name="skill" :value="'User'" required autocomplete="skill" />
            <x-input-error :messages="$errors->get('skill')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="skill2" :value="__('Your_Skill')" />
            <x-text-input id="skill2" class="block mt-1 w-full" type="text" name="skill2" :value="old('skill2')" required autocomplete="skill2" />
            <x-input-error :messages="$errors->get('skill2')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="skill3" :value="__('Your_Work')" />
            <x-text-input id="skill3" class="block mt-1 w-full" type="text" name="skill3" :value="old('skill3')" required autocomplete="skill3" />
            <x-input-error :messages="$errors->get('skill3')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="skill4" :value="__('Your_Personality')" />
            <x-text-input id="skill4" class="block mt-1 w-full" type="text" name="skill4" :value="old('skill4')" required autocomplete="skill4" />
            <x-input-error :messages="$errors->get('skill4')" class="mt-2" />
        </div>

            <!-- Profile Image Upload -->
            <div style="text-align: center; margin-bottom: 15px;">
    <label for="logo-upload" id="logo-container" style="
            display: inline-block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px dashed #ccc;
            overflow: hidden;
            cursor: pointer;
            position: relative;">
        
        <!-- Upload Text (Centered) -->
        <span id="upload-text" style="
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 12px;
                color: #888;">Upload Logo Here</span>
        
        <!-- Hidden Image (Becomes Visible on Upload) -->
        <img id="logo-preview" src="" alt="Upload Logo" style="
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: none;">
    </label>
    <input type="file" name="logo" id="logo-upload" accept="image/*" style="display: none;">
    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
</div>

<script>
    document.getElementById("logo-upload").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const logoPreview = document.getElementById("logo-preview");
                const uploadText = document.getElementById("upload-text");
                
                logoPreview.src = e.target.result;
                logoPreview.style.display = "block";
                uploadText.style.display = "none"; // Hide upload text
            };
            reader.readAsDataURL(file);
        }
    });
</script>



        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
