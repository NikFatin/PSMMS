<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" x-data="{role_id: 2}">
            @csrf

            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="matric_id" value="{{ __('Matric ID') }}" />
                <x-input id="matric_id" class="block mt-1 w-full" type="text" name="matric_id" :value="old('matric_id')" required autofocus autocomplete="matric_id" />
            </div>

            <div class="mt-4">
                <x-label for="phoneNumber" value="{{ __('Phone Number') }}" />
                <x-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" :value="old('phoneNumber')" required autofocus autocomplete="phoneNumber" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="role_id" value="{{ __('Register as') }}"/>
                <select name="role_id" x-model="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option selected>Choose role</option>
                    <option value="1">Coordinator</option>
                    <option value="2">Student</option>
                    <option value="3">Supervisor</option>
                </select>
            </div>

            <div class="mt-4" x-show="role_id == 2">
                <x-label for="student_course" value="{{ __('Course')}}"/>
                <select name="student_course" x-model="student_course" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" x-bind:required="role_id == 2">
                    <option selected>...</option>
                    <option value="BCS">Software Engineer</option>
                    <option value="BCN">Network</option>
                    <option value="BCG">Graphic and Multimedia</option>
                </select>
            </div>

            <div class="mt-4" x-show="role_id == 2">
                <x-label for="student_year" value="{{ __('Year')}}"/>
                <select name="student_year" x-model="student_year" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" x-bind:required="role_id == 2">
                    <option selected>...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>

            <div class="mt-4" x-show="role_id == 3">
                <x-label for="supervisor_group" value="{{ __('Group')}}"/>
                <select name="supervisor_group" x-model="supervisor_group" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" x-bind:required="role_id == 3">
                    <option selected>...</option>
                    <option value="CNRG">CNRG</option>
                    <option value="CSRG">CSRG</option>
                    <option value="Cy-SIG">Cy-SIG</option>
                    <option value="DBIS">DBIS</option>
                    <option value="DSSIM">DSSim</option>
                    <option value="EDUTECH">EDU-TECH</option>
                    <option value="ISP">ISP</option>
                    <option value="KECL">KECL</option>
                    <option value="MIRG">MIRG</option>
                    <option value="SCORE">SCORE</option>
                    <option value="SERG">SERG</option>
                    <option value="VISIC">VISIC</option>
                </select>    
            </div>

            <div class="mt-4" x-show="role_id == 3">
                <x-label for="supervisor_quota" value="{{ __('Quota')}}"/>
                <x-input id="supervisor_quota" class="block mt-1 w-full" type="text" name="supervisor_quota" :value="old('supervisor_quota')" x-bind:required="role_id == 3"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
