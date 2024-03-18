<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Dashboard_Widget;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardWidgetController extends Controller
{
    
    public function index(): View
    {
        //this is to pull all the saved widgets from the database and display the all on one page
        $widgets = Dashboard_Widget::where('user_id', Auth::id())->get();

        return view('admin/dashboard', ['widgets'=> $widgets]);
    }

    
    public function store(Request $request)
    {
        Dashboard_Widget::create([
            'user_id' => Auth::id(),
        ]);

    }

    public function update(Request $request, string $id)
    {
        // Here is where I can make updated to the database

        echo $id;
        echo "left:", $request->left_position;
        echo "top:", $request->top_position;
        echo "height:", $request->widget_height;
        echo "width:", $request->widget_width;

        if(isset( $request->left_position) && isset( $request->top_position)){

            Dashboard_Widget::where('id', $id)
            ->update([
            'left' => $request->left_position,
            'top' => $request->top_position
        ]);

        }

        if(isset( $request->widget_height) && isset( $request->widget_width)){

            Dashboard_Widget::where('id', $id)
            ->update([
            'height' => $request->widget_height,
            'width' => $request->widget_width
        ]);
        }

    
    }
}
