@extends('master')

@section('content')

	<div class="row m-0 p-0 justify-content-center">
		<div class="col-12 col-md-10">
			<table class="table table-responsive">
				<thead>
					<th scope="col">Company Name</th>
					<th scope="col">Company Logo</th>
					<th scope="col">Company Email</th>
					<th scope="col">Company Website</th>
					<th scope="col">Actions</th>
				</thead>
				<tbody>
					@forelse($company as $data)
					<tr>
						
						<td>{{ $data->name}}</td>
						 <td><img src="{{asset('storage/images/'.$data->logo)}}" height="50px" width="50px"></td>
						<td> {{ $data->email }} </td>
						<td> {{ $data->website }} </td>
						<td> 
							<a href=" {{ route('company.edit',$data->id) }}"> EDIT</a> 
							<form method="POST" action=" {{ route('company.destroy',$data->id) }} ">
								@csrf
								@method('DELETE')
								<input type="submit" name="submit" value="DELETE">
							</form>
						</td>
						@empty
						<td> No Data Found, Create New Entry </td>
						
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>


@endsection