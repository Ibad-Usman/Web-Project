<?php

namespace App\Http\Controllers;

use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();

        return view('property.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);

        return view('property.show', compact('property'));
    }
}