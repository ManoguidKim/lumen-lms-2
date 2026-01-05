<?php

namespace Modules\Institution\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Institution\Http\Requests\CreateCenterRequest;
use Modules\Institution\Http\Requests\UpdateCenterRequest;
use Modules\Institution\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('institution.center.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('institution.center.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCenterRequest $request)
    {
        try {
            // Kapag may nag-error, lahat ng changes ay i-rollback
            DB::beginTransaction();

            // Default: walang logo
            $logoPath = null;

            // I-check kung may in-upload na logo
            if ($request->hasFile('logo')) {
                // I-save ang logo sa public storage (storage/app/public/centers/logos)
                // Ang path ay ise-save sa database
                $logoPath = $request->file('logo')->store('centers/logos', 'public');
            }

            // Gumawa ng bagong Center record sa database
            $center = Center::create([
                'name' => $request->name,
                'short_name' => $request->short_name,
                'code' => $request->code,
                'type' => $request->type,
                'address' => $request->address,
                'contact_mobile' => $request->contact_mobile,
                'contact_landline' => $request->contact_landline,
                'email' => $request->email,
                'status' => $request->status ?? 'active',
                'logo_path' => $logoPath,
            ]);

            // Kapag walang error, i-save na sa database
            DB::commit();

            return redirect()
                ->route('centers.index')
                ->with('success', 'Center registered successfully!');
        } catch (\Exception $e) {

            // Kapag may error ay i-rollback
            DB::rollBack();

            // Kapag may na-upload na logo, burahin
            if (isset($logoPath) && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }

            dd($e->getMessage());

            return redirect()->back()->withInput()->with('error', 'Failed to register center. Please try again.');
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($uuid)
    {
        $center = Center::where('uuid', $uuid)->first();
        return view('institution.center.view', compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        return view('institution::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCenterRequest $request, $uuid)
    {
        $center = Center::where('uuid', $uuid)->firstOrFail();
        $validated = $request->validated();

        if ($request->hasFile('logo_path')) {
            if ($center->logo_path) {
                Storage::disk('public')->delete($center->logo_path);
            }

            $validated['logo_path'] = $request->file('logo_path')->store('logos', 'public');
        }

        $center->update($validated);

        return redirect()->route('centers.show', $center->uuid)
            ->with('success', 'Center updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $center = Center::where('uuid', $uuid)->firstOrFail();
        if ($center->logo_path) {
            Storage::delete($center->logo_path);
        }

        $center->delete();
        return redirect()->route('centers.index')
            ->with('success', 'Center deleted successfully!');
    }
}
