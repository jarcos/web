<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function states($id)
    {
        return DB::table('states')->where('country_id', $id)->select('id', 'country_id', 'name')->get();
    }

    public function cities($id)
    {
        return DB::table('cities')->where('state_id', $id)->select('id', 'state_id', 'name')->get();
    }
}
