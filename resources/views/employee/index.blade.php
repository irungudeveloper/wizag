@extends('master')

@section('content')

	<div class="row p-0 m-0 justify-content-center">
		<div class="col-12 col-md-10">
			<table class="table table-responsive">
				<thead>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone number</th>
					<th scope="col">Company</th>
					<th scope="col">Actions</th>
				</thead>
				<tbody>
					@forelse($employees as $data)
						<tr>
							<td> {{ $data->first_name }} </td>
							<td> {{ $data->last_name }} </td>
							<td> {{ $data->email }} </td>
							<td> {{ $data->phone }} </td>
							<td> {{ $data->company_data->name }} </td>
							<td> 
								<a href=" {{ route('employee.edit',$data->id) }} ">EDIT</a> 
								<form method="POST" action=" {{ route('employee.destroy',$data->id) }} ">
									@csrf
									@method('DELETE')
									<input type="submit" name="submit" value="DELETE">
								</form>
							</td>

						</tr>
					@empty
						<tr>
							<td>No Data Found, Try Creating New Data</td>
						</tr>
					@endforelse
				</tbody>
			</table>

		</div>
	</div>

@endsection