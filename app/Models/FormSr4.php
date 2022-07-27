<?php

namespace App\Models;

use Encore\Admin\Auth\Database\HasPermissions;
use Encore\Admin\Facades\Admin;
use Carbon\Carbon;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class FormSr4 extends  Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable,
        HasPermissions,
        DefaultDatetimeFormat,
        HasFactory,
        Notifiable
        ;

    protected $fillable = [
        'administrator_id',
        'type',
        'name_of_applicant',
        'address',
        'company_initials',
        'premises_location',
        'expirience_in',
        'years_of_expirience',
        'dealers_in',
        'marketing_of',
        'have_adequate_land',
        'have_adequate_storage',
        'have_adequate_equipment',
        'have_contractual_agreement',
        'have_adequate_field_officers',
        'have_conversant_seed_matters',
        'souce_of_seed',
        'have_adequate_land_for_production',
        'have_internal_quality_program',
        'receipt',
        'accept_declaration'
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
        });
 
   
        self::created(function ($model) {
            $user = Auth::user();
            Mail::to($user)->send(new \App\Mail\SR4FormAdded($user));
        });

        self::updated(function ($model) {
            $user = Auth::user();
            Mail::to($user)->send(new \App\Mail\SR4FormUpdated($user));
        });


    }


    // the jwt auth to map this model to the jwt rest api token authentication
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
