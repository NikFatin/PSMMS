<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
// use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'matric_id' => ['required', 'string', 'max:7'],
            'phoneNumber' => ['required', 'string', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role_id' => ['required' , 'numeric'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'matric_id' => $input['matric_id'],
            'phoneNumber' => $input['phoneNumber'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role_id' => $input['role_id'],
        ]);

        if ($input['role_id'] == 2) {
            // Save attributes related to students in the 'students' table
            $user->student()->create([
                'course' => $input['student_course'] ?? null,
                'year' => $input['student_year'] ?? null,
            ]);
        } elseif ($input['role_id'] == 3) {
            // Save attributes related to supervisors in the 'supervisors' table
            $user->supervisor()->create([
                'group' => $input['supervisor_group'] ?? null,
                'quota' => $input['supervisor_quota'] ?? null,
            ]);
        }

        return $user;
   
    }
}
