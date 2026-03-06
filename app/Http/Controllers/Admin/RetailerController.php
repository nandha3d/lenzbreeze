<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRetailerRequest;
use App\Models\Retailer;
use Illuminate\Http\Request;

class RetailerController extends Controller
{
    public function index()
    {
        $retailers = Retailer::withCount('warranties')->orderBy('name')->paginate(20);
        return view('admin.retailers.index', compact('retailers'));
    }

    public function create()
    {
        return view('admin.retailers.form');
    }

    public function store(StoreRetailerRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active', true);

        Retailer::create($validated);

        return redirect()->route('admin.retailers')->with('success', 'Retailer added successfully.');
    }

    public function edit(Retailer $retailer)
    {
        return view('admin.retailers.form', compact('retailer'));
    }

    public function update(StoreRetailerRequest $request, Retailer $retailer)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active', true);

        $retailer->update($validated);

        return redirect()->route('admin.retailers')->with('success', 'Retailer updated successfully.');
    }

    public function toggleActive(Retailer $retailer)
    {
        $retailer->update(['is_active' => !$retailer->is_active]);
        $status = $retailer->is_active ? 'activated' : 'deactivated';

        return redirect()->route('admin.retailers')->with('success', "Retailer {$status} successfully.");
    }
}
