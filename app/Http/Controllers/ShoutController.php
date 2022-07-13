<?php

namespace App\Http\Controllers;
use App\Models\Shout;

use Illuminate\Http\Request;

class ShoutController extends Controller
{
    public function recent() {
        $shouts = Shout::orderBy('created_at','desc')->limit(50)->get();
        return response()->json($shouts);
    }
}
