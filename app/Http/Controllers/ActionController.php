<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::orderByDesc('created_at')->get();
        return view('actions.index', compact('actions'));
    }

    public function create()
    {
        return view('actions.create');
    }

    public function store(Request $req)
    {
        $validations = $req->validate(
            [
                'image' => "required|image",
                "text" => "required|max:500",
                "position" => "required",
            ],
            ['required' => 'Поле :attribute обязательное', 'image' => "Файл должен быть изображением"]
        );

        $fileName = $req->file('image')->store('actions', 'public');

        $validations['image'] = $fileName;

        Action::create($validations);

        return redirect()->route('actions');
    }

    public function on(Action $action)
    {
        $action->update(['is_avaliable' => 1]);
        return redirect()->route('actions');
    }

    public function off(Action $action)
    {
        $action->update(['is_avaliable' => 0]);
        return redirect()->route('actions');
    }
}
