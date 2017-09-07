<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Notifications\DefaultResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements TableInterface
{
    use Notifiable;

    const ROLE_ADMIN = 1;
    const ROLE_CLIENT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Generate a random 8 digit encrypted password or just encrypt a given password
     *
     * @param null $password    The password to be encrypted. If null will be created a 8 digit one
     *
     * @return string
     */
    public static function generatePassword($password = null)
    {
        return !empty($password) ? bcrypt(str_random(8)) : bcrypt($password);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DefaultResetPasswordNotification($token));
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     *
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        $cases = ['#' => $this->id, 'Nome' => $this->name, 'E-mail' => $this->email];

        if (in_array($header, array_keys($cases))) {
            return $cases[$header];
        }
    }
}
