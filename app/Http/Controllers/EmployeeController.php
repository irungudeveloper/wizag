<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Employee;
use App\Models\User;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all employee records

        $employees = Employee::with('company_data')->get();

        return view('employee.index')->with('employees',$employees);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //function to return the display form for creating employees

        $company = Company::all();

        return view('employee.create')->with('company',$company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store employee details in database

        $validate = $request->validate([
                    'first_name'=>'required',
                    'last_name'=>'required',
                    'email'=>'required',
                    'phone'=>'required',
                    'password'=>'required',
                    'company'=>'required',
                ]);

        // if ($request->input('password') != $request->input('retype')) 
        // {
        //    return back()->with('error','Password Mismatch Error');
        // }
       
        //Create Employee 
            $employee = new Employee;

        try 
        {
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->company = $request->input('company');

            $employee->save();

            //Create Employee User Account with role_id 2
            $user = new User;

            $user->name = $request->input('first_name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->role_id = 2;
            $user->employee_id = $employee->id;

            
            $user->save();

            return redirect()->route('employee.index')->with('success','Employee Record Created');


        } 
        catch (Exception $e) 
        {
            return redirect()->route('employee.index')->with('error','Employee Record Not Created');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch the record with only the requested ID for reading purposes

        $employee = Employee::where('id',$id)->get();

        return view('employee.show')->with('employee',$employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //fetch the record with only the requested ID for update purposes

        $employee = Employee::where('id',$id)->with('company_data')->get();
        $company = Company::all();

        return view('employee.edit')->with('employee',$employee)
                                    ->with('company',$company);
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
        //update the employee record 

        $validate = $request->validate([
                                            'first_name'=>'required',
                                            'last_name'=>'required',
                                            'email'=>'required',
                                            'phone'=>'required',
                                            'company'=>'required',]);
  
        $employee = Employee::findOrFail($id);

        try 
        {

            Employee::where('id',$id)->update([
                                                'first_name'=>$request->input('first_name'),
                                                'last_name'=>$request->input('last_name'),
                                                'email'=>$request->input('email'),
                                                'phone'=> $request->input('phone'),
                                                'company'=>$request->input('company'),
                                            ]);

            //find employee email, name and password in user table and update accordingly
            $user = User::where('employee_id',$id)
                        ->update([
                                  'email'=>$request->input('email'),
                                  'name'=> $request->input('first_name'),
                                ]);

            return redirect()->route('employee.index')->with('success','Record Updated');

        } 
        catch (Exception $e) 
        {
            return redirect()->route('employee.index')->with('error','Record Not Updated');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete employee record

        $employee = Employee::findOrFail($id);

        try 
        {
            $employee->delete();

            //delete employee account

            $user = User::where('employee_id',$id)->delete();

            return redirect()->route('employee.index')->with('success','Record Deleted');

        } 
        catch (Exception $e) 
        {
            return redirect()->route('employee.index')->with('error','Record Not Deleted');
        }
    }
}
