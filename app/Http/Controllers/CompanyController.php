<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Company;


class CompanyController extends Controller
{
    //

    public function index()
    {
        // Fetch all company records

        $company = Company::all();

        return view('company.index')->with('company',$company);

    }

    public function create()
    {
        // Display Create Company Form

        return view('company.create');
    }

    public function store(Request $request)
    {
        // code...
        $validate = $request->validate([
                                            'name'=>'required',
                                            'email'=>'required',
                                            'website'=>'required',
                                            // 'logo'=>'required | dimensions:min_width=100,min_height=100'
                                        ]);
       
        try 
        {
            $company = new Company;

            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->website = $request->input('website');

             if(!Storage::exists('/public/images')) 
                {

                    Storage::makeDirectory('/public/images', 0777, true); //creates directory

                    $path = '/public/images/';
                    $image_path = $request->logo->storeAs($path,time().'.'.$request->logo->extension());

                    $url = Storage::url(time().'.'.$request->logo->extension());

                }
                else
                {
                    $path = '/public/images/';

                    $image_path = $request->logo->storeAs($path,time().'.'.$request->logo->extension());
                    $url = Storage::url($request->logo->getClientOriginalName());
                }

            // Generate company logo name for storage in DB
            $logo_name = time().'.'.$request->logo->extension();

            $company->logo = $logo_name;

            $company->save();

            // //Move Logo in Storage 
            // $request->logo->storeAs('uploads',$logo_name);

            return redirect()->route('company.index');

        } 
        catch (Exception $e) 
        {
            return back()->with('error','error creating record');
        } 
    }

    public function show($id)
    {
        // Diplay single company record for reading purpose
        $company = Company::where('id',$id)->get();

        return view('company.show')->with('company',$company);
    }

    public function edit($id)
    {
        // Diplay single company record for updating purpose
        $company = Company::where('id',$id)->get();

        return view('company.edit')->with('company',$company);
    }

    public function update(Request $request,$id)
    {
        // Update company record

         $validate = $request->validate([
                                            'name'=>'required',
                                            'email'=>'required',
                                            'website'=>'required',
                                            // 'logo'=>'required | dimensions:min_width=100,min_height=100'
                                        ]);
        
        try 
        {
            $company = Company::findOrFail($id);

            Company::where('id',$id)
                    ->update(
                        [
                            'name'=>$request->input('name'),
                            'email'=>$request->input('email'),
                            'website'=>$request->input('website'),
                        ]);

            //Generate company logo name for storage in DB
            if($request->hasFile('logo'))
            {

                 if(!Storage::exists('/public/images')) 
                {

                    Storage::makeDirectory('/public/images', 0777, true); //creates directory

                    $path = '/public/images/';
                    $image_path = $request->logo->storeAs($path,time().'.'.$request->logo->extension());

                    $url = Storage::url(time().'.'.$request->logo->extension());

                }
                else
                {
                    $path = '/public/images/';

                    $image_path = $request->logo->storeAs($path,time().'.'.$request->logo->extension());
                    $url = Storage::url($request->logo->getClientOriginalName());
                }

                Company::where('id',$id)
                    ->update(
                        [
                            'logo'=>time().'.'.$request->logo->extension(),
                        ]);

            }

            return redirect()->route('company.index');

        } 
        catch (Exception $e) 
        {
            return back()->with('error','error updating record');
        }

    }

    public function destroy($id)
    {
        // Delete Company Records

        $company = Company::findOrFail($id);

        try 
        {
           $company->delete();

           return redirect()->route('company.index')->with('success','Record Deleted'); 
        } 
        catch (Exception $e) 
        {
            return redirect()->route('company.index')->with('error','Record Not Deleted');
        }

    }

}
