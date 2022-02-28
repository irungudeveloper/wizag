<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company

class CompanyController extends Controller
{
    //

    public function index()
    {
        // Fetch all company records

        $company = Company::all();

        return view('company.index')->with('company'=>$company);

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
                                            'logo'=>'required | dimensions:min_width=100,min_height=100'
                                        ]);
        if($validate->fails())
        {
            return back()->with('error','Invalid input');
        }
        else
        {
            try 
            {
                $company = new Company;

                $company->name = $request->input('name');
                $company->email = $request->input('email');
                $company->website = $request->input('website');

                //Generate company logo name for storage in DB
                $logo_name = time().'.'.$request->logo->extension();

                $company->logo = $logo_name;

                $company->save();

                //Move Logo in Storage 
                $request->logo->storeAs('uploads',$logo_name);



            } 
            catch (Exception $e) 
            {
                return back()->with('error','error creating record');
            }
        }
    }

    public function show($id)
    {
        // Diplay single company record for reading purpose
        $company = Company::findOrFail($id);

        return view('company.show')->with('company',$company);
    }

    public function edit($id)
    {
        // Diplay single company record for updating purpose
        $company = Company::findOrFail($id);

        return view('company.edit')->with('company',$company);
    }

    public function update(Request $request,$id)
    {
        // Update company record

         $validate = $request->validate([
                                            'name'=>'required',
                                            'email'=>'required',
                                            'website'=>'required',
                                            'logo'=>'required | dimensions:min_width=100,min_height=100'
                                        ]);
        if($validate->fails())
        {
            return back()->with('error','Invalid input');
        }
        else
        {
            try 
            {
                $company = Company::findOrFail($id);

                 $company->name = $request->input('name');
                $company->email = $request->input('email');
                $company->website = $request->input('website');

                //Generate company logo name for storage in DB
                $logo_name = time().'.'.$request->logo->extension();

                $company->logo = $logo_name;

                $company->save();

                //Move Logo in Storage 
                $request->logo->storeAs('uploads',$logo_name);

            } 
            catch (Exception $e) 
            {
                return back()->with('error','error updating record');
            }
        }

    }

    public function destroy($id)
    {
        // Delete Company Records

        $company = Company::findOrFail($id);

        try 
        {
           $company->delete();

           return redirect('company.index')->with('success','Record Deleted'); 
        } 
        catch (Exception $e) 
        {
            return redirect('company.index')->with('error','Record Not Deleted');
        }

    }

}
