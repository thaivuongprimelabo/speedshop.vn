<?php

namespace App;

use App\Constants\Common;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Constants\UserRole;
use App\Helpers\Utils;
use App\Constants\UploadPath;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = Common::USERS;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function isAdmin() {
        if($this->role_id == UserRole::SUPER_ADMIN || $this->role_id == UserRole::ADMIN || $this->role_id == UserRole::MOD) {
            return true;
        }
        
        return false;
    }
    
    public function getAvatar() {
        if(!Utils::blank($this->avatar) && !file_exists($this->avatar)) {
            return Utils::getImageLink($this->avatar);
        }
        return Utils::getImageLink(Common::NO_AVATAR);
    }
}
