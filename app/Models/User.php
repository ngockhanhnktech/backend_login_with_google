<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'google_id', 'roles_id',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Tạo Passport Token có chứa email
     */
    public function createTokenWithEmail()
    {
        $tokenResult = $this->createToken('GoogleLoginToken');

        // Truy cập vào token object
        $token = $tokenResult->token;
        $token->save();

        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $token->expires_at,
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->roles_id, // 👈 Thêm role vào payload
            ],
        ];
    }
}
