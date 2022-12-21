<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable;

	//Code: 1 Account ,2 Create , 3 Read , 4 Update ,5 Delete, 6 Reports, 7 Users, 8 Activity, 9 Enable/Disble

	const canCreate = 2;
	const canEdit = 4;
	const canUpdate = 4;
	const canDelete = 5;
	const canAccessActivity = 8;
	const canAccessAccount = 1;
	const canAccessReports = 6;
	const canAccessUsers = 7;
	const canEnableSite = 9;
	const canAccessPermissions = 10;




	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'last_name',
		'email',
		'password',
		'phone_number',
		'type'
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];


	public function addresses()
	{
		return $this->hasMany(Address::class)->orderBy('id', 'desc');
	}

	public function active_address()
	{
		return $this->hasOne(Address::class)->where('is_active', 1);
	}


	public static function getShowData(Order $order)
	{
		return [];
	}


	public function getListingData($collection)
	{
		return  $collection->map(function ($user) {
			return [
				"Id" =>  $user->id,
				"Full Name" =>  $user->fullname(),
				"Email" => $user->email,
				"Phone Number" => $user->phone_number,
				"Date Added" =>  $user->created_at->format('d-m-y'),
			];
		});
	}


	public function orders()
	{
		return $this->hasMany(Order::class);
	}


	public function carts()
	{
		return $this->hasMany(Cart::class);
	}

	public function favorites()
	{

		return $this->hasMany(Favorite::class);
	}


	public function social()
	{
		return $this->hasMany(UserSocial::class);
	}


	public function ordered_products()
	{
		return $this->hasManyThrough(
			OrderedProduct::class,
			Order::class,
		);
	}

	public function ActiveAddress()
	{
		return optional($this->addresses)->where('is_active', true)->first();
	}


	public function activities()
	{
		return $this->hasMany(Activity::class);
	}

	public function hasSocialLinked($service)
	{
		return (bool) $this->social->where('service', $service)->count();
	}


	public function fullname()
	{
		return ucfirst($this->name) . ' ' . ucfirst($this->last_name);
	}


	public function users_permission()
	{
		return $this->hasOne(UserPermission::class);
	}


	public function subscribe()
	{
		return $this->hasOne(Subscribe::class);
	}


	public function hasActiveSubscription()
	{
		return null !== $this->subscribe && $this->subscribe->ends_at->isFuture() ? true : false;
	}


	public function scopeCustomers(Builder $builder)
	{
		return $builder->where('type', 'subscriber')->orWhere('type', '=', null);
	}

	public function scopeAdmin(Builder $builder)
	{
		return $builder->where('type', 'Admin');
	}


	public function wallets()
	{
		return $this->hasMany(Wallet::class);
	}


	public function wallet_balance()
	{
		return $this->hasOne(WalletBalance::class);
	}


	public static function userHasPermission($num)
	{
		$user = \Auth::user();
		return Str::contains(optional(optional($user->users_permission)->permission)->code, $num) ? true : false;
	}


	public static function canTakeAction($num)
	{
		if (!User::userHasPermission($num)) {
			dd('You dont have permission to perform that operation.');
		}
	}


	public function isAdmin()
	{
		return $this->users_permission  !== null ? true : false;
	}

	public static function IsSuperUser()
	{
		$model = \Auth::user();
		return $model->users_permission->permission->name == 'Owner' ? true : false;
	}

	public function activity()
	{
		return $this->hasMany(Activity::class);
	}
}
