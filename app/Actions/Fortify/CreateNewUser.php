<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'NIM' => ['required', 'string', 'max:20', 'unique:users'],
            'prodi' => ['required', 'string', 'in:Teknologi Rekayasa Elektro-Medis (TREM),Teknologi Rekayasa Komputer (TRK),Teknologi Rekayasa Instrumentasi dan Kontrol (TRIK),Sistem Informasi Kota Cerdas (SIKC),Rekayasa Perangkat Lunak (RPL),Perancangan Manufaktur (PM),Teknik Pendingin dan Tata Udara,Teknik Informatika (TI),Teknik Mesin (TM),Keperawatan'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'NIM' => $input['NIM'],
            'prodi' => $input['prodi'],
            'password' => Hash::make($input['password']),
        ]);
    }
}