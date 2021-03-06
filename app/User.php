<?php

namespace App;

use Cache;
use Carbon;
use Lodestone;
use Role;
use Permission;
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
    protected $appends = array('character_title', 'character_avatar', 'character_portrait', 'profile_slug', 'display_profile_header', 'forum_access', 'jobs', 'activeclass', 'activejob', 'activelevel', 'mounts', 'minions');

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

    public function getJobsAttribute() {
        $jobs = $this->getOrSetCache('classjobs', $this->character_id);

        if(isset($jobs)) {
            foreach($jobs as $i => $job) {
                $jobs[$i]['percent'] = 0;

                $exp_level = $job['exp_level'];
                $exp_current = $job['exp_current'];

                if($exp_level !== '0' && $job['level'] !== 0) {
                    $jobs[$i]['percent'] = round(($exp_current/$exp_level)*100);
                } else if ($job['level'] == 0){
                        $jobs[$i]['percent'] = 0;
                } else {
                        $jobs[$i]['percent'] = 100;
                }
            }
        }

        return collect($jobs);
    }

    public function getActiveclassAttribute() {
        return $this->getOrSetCache('activeClass', $this->character_id);
    }

    public function getActivejobAttribute() {
        return $this->getOrSetCache('activeJob', $this->character_id);
    }

    public function getActivelevelAttribute() {
        return $this->getOrSetCache('activeLevel', $this->character_id);
    }

    public function getMountsAttribute() {
        return $this->getOrSetCache('mounts', $this->character_id);
    }

    public function getMinionsAttribute() {
        return $this->getOrSetCache('minions', $this->character_id);
    }


    public function getProfileSlugAttribute() {
        if($this->character_name) {
            return str_replace(' ', '', $this->character_name);
        } else {
            return $this->name;
        }
    }

    public function getDisplayProfileHeaderAttribute() {
        if($this->profile_header) {
            return '/headers/'.$this->profile_header;
        } else {
            return null;
        }
    }

    public function getForumAccessAttribute() {
        // Get the users permissions
        $canAccess = $this->getPermissions();

        // Filter the canAccess array to get the list of forum IDs the user can access
        $accessCollection = collect();
        foreach($canAccess as $hasAccess) {
            if (strpos($hasAccess, 'access-forum-') !== false) {
                $access = explode('-', $hasAccess);
                if($access[2]) {
                    $accessCollection->push($access[2]);
                }
            }
        }

        return $accessCollection;
    }


    public function getPermissions() {
        $roles = $this->roles;

        $canAccess = array();

        foreach($roles as $role) {
            $permissions = $role->perms()->get();
            foreach($permissions as $permission) {
                $canAccess = array_add($canAccess, $permission->name, $permission->name);
            }
        }

        return $canAccess;
    }

}
