<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Http\Request;

class ClientContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->view('welcome', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('add-client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'userImg' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        // Handle image upload if a file is provided
        if ($request->hasFile('userImg') && $request->file('userImg')->isValid()) {
            $imageName = time() . '.' . $request->userImg->extension();

            // Save the image to the public/images directory
            $request->userImg->move(public_path('images'), $imageName);
        } else {
            $imageName = null;  // Set image to null if no file is uploaded or the file is invalid
        }

        // Create a new client record in the database
        Client::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'userImg' => $imageName,
        ]);

        // Redirect back to the home route with a success message
        return redirect()->route('home')->with('success', 'Client added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return response()->view('edit-client', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $id,
            'userImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the client by ID
        $client = Client::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('userImg')) {
            // Delete the old image if it exists
            if ($client->userImg && file_exists(public_path('images/' . $client->userImg))) {
                unlink(public_path('images/' . $client->userImg));  // Delete the old image
            }

            // Save the new image
            $imageName = time() . '.' . $request->userImg->extension();
            $request->userImg->move(public_path('images'), $imageName);
        } else {
            // Keep the old image if no new one is uploaded
            $imageName = $client->userImg;
        }

        // Update the client's data
        $client->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'userImg' => $imageName,
        ]);

        // Redirect with a success message
        return redirect()->route('home')->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->userImg) {
            unlink(public_path('images') . '/' . $client->userImg);
        }
        $client->delete();

        return redirect()->route('home')->with('success', 'Client deleted successfully.');
    }
}
