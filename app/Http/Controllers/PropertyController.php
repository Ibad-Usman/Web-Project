<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of all properties
     */
    public function index()
    {
        $properties = Property::paginate(12);
        
        return view('properties.index', compact('properties'));
    }

    /**
     * Display the specified property
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);
        
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for creating a new property
     */
    public function create()
    {
        abort(403, 'Unauthorized. Only property owners can create properties.');
    }

    /**
     * Store a newly created property
     */
    public function store(Request $request)
    {
        abort(403, 'Unauthorized. Only property owners can create properties.');
    }

    /**
     * Show the form for editing the specified property
     */
    public function edit($id)
    {
        abort(403, 'Unauthorized. Only property owners can edit properties.');
    }

    /**
     * Update the specified property
     */
    public function update(Request $request, $id)
    {
        abort(403, 'Unauthorized. Only property owners can update properties.');
    }

    /**
     * Remove the specified property
     */
    public function destroy($id)
    {
        abort(403, 'Unauthorized. Only property owners can delete properties.');
    }
}