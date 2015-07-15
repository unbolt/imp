<?php

namespace App;

use Cache;
use Carbon;
use Lodestone;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    // Add in our virtual fields
    protected $appends = array('character_title', 'character_avatar', 'character_portrait');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'character_name', 'primary_class'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    private function getOrSetCache($cacheValue, $character_id) {
        if($character_id) {
            if(Cache::has($cacheValue.'-'.$character_id)) {
                return Cache::get($cacheValue.'-'.$character_id);
            } else {
                $lodestone = New Lodestone;
                $character = $lodestone->Search->Character($character_id);

                $expiresAt = Carbon::now()->addDay();

                Cache::put($cacheValue.'-'.$character_id, $character->{$cacheValue}, $expiresAt);

                return $character->{$cacheValue};
            }
        } else {
            return null;
        }
    }

    public function getCharacterTitleAttribute() {
        // Check if the character has an ID
        return $this->getOrSetCache('title', $this->character_id);
    }

    public function getCharacterAvatarAttribute() {
        return $this->getOrSetCache('avatar', $this->character_id);
    }

    public function getCharacterPortraitAttribute() {
        return $this->getOrSetCache('portrait', $this->character_id);
    }

}
