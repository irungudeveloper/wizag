@extends('master')

@section('content')

	@extends('master')

@section('content')

	<div class="row p-0 m-0 justify-content-center">
		<div class="col-12 col-md-10">
			 <div class="card">
			 	<div class="card-header">
			 		<h4>Employee Creation Form</h4>
			 	</div>
			 	<div class="card-body">
			 		@foreach($employee as $data)
			 		<form method="POST" action=" {{ route('employee.update',$data->id) }} ">
			 			@csrf
			 			@method('PUT')

			 			<div class="form-group row">
			 				<div class="col-12 col-md-6">
			 					<label for="first_name">First Name</label>
			 					<input type="text" name="first_name" id="first_name" class="form-control" value=" {{ $data->first_name }} ">
			 				</div>
			 				<div class="col-12 col-md-6">
			 					<label for="last_name">Last Name</label>
			 					<input type="text" name="last_name" id="last_name" class="form-control" value=" {{ $data->last_name }} " >
			 				</div>
			 			</div>
			 			<div class="form-group row">
			 				<div class="col-12 col-md-6">
			 					<label for="email">Email</label>
			 					<input type="email" name="email" id="email" class="form-control" value=" {{ $data->email }} ">
			 				</div>
			 				<div class="col-12 col-md-6">
			 					<label for="phone">Phone</label>
			 					<input type="phone" name="phone" id="phone" class="form-control" value=" {{ $data->phone }} ">
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<div class="col-12">
			 					<label for="company">Company</label>
			 					<select id="company" name="company" class="form-control">
			 						<option value=" {{ $data->company }} " > {{ $data->company_data->name }} </option>
			 						@forelse($company as $cdata)
			 							<option value=" {{ $cdata->id }} " > {{ $cdata->name }} </option>
			 						@empty
			 							<option>No Companies Available, Create New Company</option>
			 						@endforelse
			 					</select>
			 				</div>
			 			</div>

			 			<div class="form-group row">
			 				<div class="col-12 text-center">
			 					<input type="submit" name="submit" value="Update Record" class="btn btn-solid btn-primary">
			 				</div>
			 			</div>

			 		</form>
			 		@endforeach
			 	</div>
			 </div>
		</div>
	</div>

@endsection

@endsection