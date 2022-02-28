@extends('master')

@section('content')

	<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          <div class="card-header">
                            @can('admin')
                              <h4 class="h4">Administrator Panel</h4>
                            @endcan
                            @can('employee')
                            <h4 class="h4">Kanye West Quote</h4>
                            @endcan
                          </div>
                          <div class="card-body">
                            @can('admin')
                              <p class="display-5">Welcome to the dashboard</p>
                            @endcan
                            @can('employee')
                              <p class="display-5">Kanye west quote</p>
                            @endcan
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop