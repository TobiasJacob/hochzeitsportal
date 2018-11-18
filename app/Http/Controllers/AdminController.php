<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
use Image;
use Geocoder;
use App\Vendor;
use App\Category;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendors = Vendor::orderBy('created_at', 'asc')->get();
        
        return view('adminIndex', ['vendors' => $vendors]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'link' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }
    
        $vendor = new Vendor;
        $vendor->name = $request->name;
        $vendor->link = $request->link;
        $vendor->category_id = Category::where('name', $request->category)->firstOrFail()->id;
        $vendor->save();
    
        return redirect('/admin/' . $vendor->id);
    }

    public function createView()
    {
        return view('adminNew', ['categories' => Category::all()]);
    }

    public function delete($id)
    {
        Vendor::findOrFail($id)->delete();

        return redirect('/admin');
    }

    public function editDetailPhotos($id, Request $request)
    {
        $vendor = Vendor::findOrFail($id);

        if ($request->hasFile('detailPhoto')) {
            Session::flash('alert-info', 'Bild wurde hinzugefügt');
			$file = $request->file('detailPhoto');

            $filename = time() . '-' . $vendor->link . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save(public_path('/uploads/img/' . $filename));

            $photoPaths = $vendor->getDetailPhotosPath();

            array_push($photoPaths, $filename);

            $vendor->detailPhotosPath = serialize($photoPaths);
            $vendor->save();

            return redirect()->back()
                ->withInput();
        }
        return redirect()->back()
            ->withInput()
            ->withErrors('Es konnte kein Bild hochgeladen werden.');
    }

    public function deleteDetailPhoto($id, $path)
    {
        $vendor = Vendor::findOrFail($id);
        $photoPaths = $vendor->getDetailPhotosPath();
        if (file_exists(public_path('/uploads/img/' . $path))) {
            unlink(public_path('/uploads/img/' . $path));
        }

        if (($key = array_search($path, $photoPaths)) !== false) {
            unset($photoPaths[$key]);
        }

        $vendor->detailPhotosPath = serialize($photoPaths);
        $vendor->save();

        return redirect()->back()
            ->withInput();
    }

    public function edit($id, Request $request)
    {
        $vendor = Vendor::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'link' => 'required|max:255|regex:/^[A-Za-z\s-_]+$/', // ^[a-z0-9-]*$
            'email' => 'nullable|email',
            'postalCode' => 'nullable|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator);
        }

        Session::flash('alert-info', 'Infos gespeichert');

        if ($request->hasFile('imageFile')) {
            if ($vendor->photoPath) {
                unlink(public_path('/uploads/img/' . $vendor->photoPath));
            }

			$file = $request->file('imageFile');

            $filename = time() . '-' . $vendor->link . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/img/' . $filename));
            Image::make($file)->save(public_path('/uploads/img/original-' . $filename));
    
            $vendor->photoPath = $filename;
            Session::flash('alert-info', 'Bild wurde aktualisiert. Infos gespeichert');
		}

        $vendor->name = $request->name;
        $vendor->description = $request->description;
        $vendor->link = $request->link;
        $vendor->category_id = Category::where('name', $request->category)->firstOrFail()->id;
        $vendor->searchScore = $request->searchScore;

        $vendor->street = $request->street;
        $vendor->postalCode = $request->postalCode;
        $vendor->city = $request->city;

        $vendor->telephone = $request->telephone;
        $vendor->email = $request->email;
        $vendor->website = $request->website;

        $vendor->facebook = $request->facebook;
        $vendor->instagram = $request->instagram;

        $coords = Geocoder::getCoordinatesForAddress($vendor->street . ', ' . $vendor->city);

        $vendor->latitude = $coords["lat"];
        $vendor->longitude = $coords["lng"];


        $vendor->save();
        return redirect('/admin');
    }

    public function editView($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('adminEdit', ['vendor' => $vendor, 'pageTitle' => $vendor->name, 'categories' => Category::all()]);
    }
}
