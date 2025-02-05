<?php

namespace App\Models;

use Database\Factories\WebsiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    /** @use HasFactory<WebsiteFactory> */
    use HasFactory;
}
