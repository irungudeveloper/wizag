<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Employee;
use App\Models\User;

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

        $employees = Employee::all();

        return view('employee.index')->with('employees'=>$employees);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //function to return the display form for creating employees

        return view('employee.create');
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

        if ($validdate->fails()) 
        {
            // code...
            return back()->with('error','Missing Data');
        } 
        else 
        {

        //Create Employee 
            $employee = new Employee;

            try 
            {
                $employee->first_name = $request->input('first_name');
                $empoyee->last_name = $request->input('last_name');
                $employee->email = $request->input('email');
                $employee->phone = $request->input('phone');
                $employee->company = $request->input('company');

                //Create Employee Account with role_id 2
                $user = new User;

                $user->name = $request->input('first_name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                $user->role_id = 2;

                $employee->save();
                $user->save();

                return redirect('employee.index')->with('success','Employee Record Created');


            } 
            catch (Exception $e) 
            {
                return redirect('employee.index')->with('error','Employee Record Not Created');
            }
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

        $employee = Employee::findOrFail($id);

        return view('employee.show')->with('employee'=>$employee);
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

        $employee = Employee::findOrFail($id);

        return view('employee.edit')->with('employee'=>$employee);
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
                                            'company'=>'required',
                                        ]);
        if($validate->fails())
        {
            return back()->with('error','Error');

        }
        else
        {
            $employee = Employee::findOrFail($id);

            try 
            {
                $employee->first_name = $request->input('first_name');
                $empoyee->last_name = $request->input('last_name');
                $employee->email = $request->input('email');
                $employee->phone = $request->input('phone');
                $employee->company = $request->input('company');

                //find employee email in user table and update accordingly
                $user = User::where('employee_id'=>$id)->update(['email'=>$request->input('email')]);

                return redirect('employee.index')->with('success'=>'Record Updated');

            } 
            catch (Exception $e) 
            {
                return redirect('employee.index')->with('success'=>'Record Not Updated');
            }
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

            return redirect('employee.index')->with('success','Record Deleted');

        } 
        catch (Exception $e) 
        {
            return redirect('employee.index')->with('error','Record Not Deleted');
        }
    }
}
