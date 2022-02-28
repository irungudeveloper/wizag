@extends('master')

@section('content')

	<div class="row p-0 m-0 justify-content-center">
		<div class="col-12 col-md-10">
			 <div class="card">
			 	<div class="card-header">
			 		<h4>Employee Creation Form</h4>
			 	</div>
			 	<div class="card-body">
			 		<form method="POST" action=" {{ route('employee.store') }} ">
			 			@csrf
			 			@method('POST')

			 			<div class="form-group row">
			 				<div class="col-12 col-md-6">
			 					<label for="first_name">First Name</label>
			 					<input type="text" name="first_name" id="first_name" class="form-control">
			 				</div>
			 				<div class="col-12 col-md-6">
			 					<label for="last_name">Last Name</label>
			 					<input type="text" name="last_name" id="last_name" class="form-control">
			 				</div>
			 			</div>
			 			<div class="form-group row">
			 				<div class="col-12 col-md-6">
			 					<label for="email">Email</label>
			 					<input type="email" name="email" id="email" class="form-control">
			 				</div>
			 				<div class="col-12 col-md-6">
			 					<label for="phone">Phone</label>
			 					<input type="phone" name="phone" id="phone" class="form-control">
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<div class="col-12 col-md-6">
			 					<label for="password">Password</label>
			 					<input type="password" name="password" id="password" class="form-control">
			 				</div>
			 				<div class="col-12 col-md-6">
			 					<label for="retype">Retype Password</label>
			 					<input type="password" name="retype" id="password" class="form-control">
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<div class="col-12">
			 					<label for="company">Company</label>
			 					<select id="company" name="company" class="form-control">
			 						<option>SELECT COMPANY</option>
			 						@forelse($company as $data)
			 							<option value=" {{ $data->id }} " > {{ $data->name }} </option>
			 						@empty
			 							<option>No Companies Available, Create New Company</option>
			 						@endforelse
			 					</select>
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<div class="col-12 text-center">
			 					<input type="submit" name="submit" value="Create Record" class="btn btn-solid btn-primary">
			 				</div>
			 			</div>

			 		</form>
			 	</div>
			 </div>
		</div>
	</div>

@endsection