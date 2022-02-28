@extends('master')

@section('content')

	<div class="row m-0 p-0 justify-content-center">
		<div class="col-12 col-md-10 mt-4">
			<div class="card">
				<div class="card-header">
					<h4 class="h4">Company Creation Form</h4>
				</div>
				<div class="card-body">
					<form method="POST" action=" {{ route('company.store') }} " enctype="multipart/form-data">
						@csrf
						@method('POST')

						<div class="form-group row">
							<div class="col-12 col-md-12">
								<label for="name">
									Name
								</label>
								<input id="name" type="text" name="name" class="form-control">
							</div>
							<div class="col-12 col-md-6">
								<label for="email">
									Email
								</label>
								<input id="email" type="email" name="email" class="form-control">
							</div>
							<div class="col-12 col-md-6">
								<label for="website">
									Website
								</label>
								<input id="website" type="text" name="website" class="form-control">
							</div>
							<div class="col-12 col-md-12">
								<label for="logo">
									Logo
								</label>
								<input id="logo" type="file" name="logo" class="form-control">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12 col-md-12 text-center">
								<input type="submit" name="submit" value="Create Company" class="btn btn-solid btn-primary">
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

@stop