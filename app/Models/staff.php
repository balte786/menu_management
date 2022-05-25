<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\SmsVerification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use Twilio\Rest\Client;
use App\Traits\HasConfig;
use Akaunting\Module\Facade as Module;
use Illuminate\Database\Eloquent\SoftDeletes;


class staff extends Model
{
    use HasFactory;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use Billable;
    use HasConfig;
    use SoftDeletes;

    protected $table = "users";

}
