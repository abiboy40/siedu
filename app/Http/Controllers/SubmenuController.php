<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    public function activated($id)
    {
        Submenu::where('id', $id)
            ->update(['is_active' => 1]);

        return back()->with('status', 'Submenu Activated!!');
    }

    public function deactivated($id)
    {
        Submenu::where('id', $id)
            ->update(['is_active' => 0]);

        return back()->with('status', 'subMenu Deactivated!!');
    }
}
