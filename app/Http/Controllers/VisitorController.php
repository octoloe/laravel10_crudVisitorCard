<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{

    public function index()
    {
        // $visitors = Visitor::all()->simplePaginate(3);
        $visitors = Visitor::latest()->simplePaginate(3);

        return view('visitors.index', ['visitors' => $visitors]);
    }


    public function create()
    {
        return view('visitors.create');
    }


    public function store(Request $request)
    {
        $visitor = new Visitor();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel_nr' => 'required',
            'profession' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048'
        ]);

        $file_name = time() . '.'  . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
        // ->move('storage/images', $file_name);
        $visitor->first_name = $request->first_name;
        $visitor->last_name = $request->last_name;
        $visitor->profession = $request->profession;
        $visitor->tel_nr = $request->tel_nr;
        $visitor->email = $request->email;
        $visitor->image = $file_name;

        $visitor->save();

        return redirect()->route('visitors.index')->with('status', 'Eine neue Besucherkarte wurde erfolgreich angelegt!');
    }


    public function show(Visitor $visitor)
    {
        return view('visitors.show', ['visitor' => $visitor]);
    }


    public function edit(Visitor $visitor)
    {
        return view('visitors.edit', ['visitor' => $visitor]);
    }


    public function update(Request $request, Visitor $visitor)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel_nr' => 'required',
            'profession' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,giv,svg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $visitorImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $visitorImage);
            $input['image'] = "$visitorImage";
        } else {
            unset($input['image']);
        }

        $visitor->update($input);

        return redirect()->route('visitors.index')->with('status', 'Die Besucherkarte wurde erfolgreich aktualisiert!');
    }


    public function destroy(Visitor $visitor)
    {
        $visitor->delete();

        return redirect()->route('visitors.index')->with('status', 'Die Besucherkarte wurde erfolgreich gelöscht!');
    }
}