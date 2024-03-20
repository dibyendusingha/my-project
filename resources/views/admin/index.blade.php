@extends('admin.layout.header')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header mb-1">
            <h3 class="page-title"> Basic Tables </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-lg-flex justify-content-between my-2">
                            <h4 class=""> Table</h4>
                            <div> <a href="/form" class="btn btn-success me-2">Add User +</a> </div>
                        </div>
                        <div class="w-100 d-flex justify-content-between mb-2">
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-info me-2">Excel</button>
                            </div>
                            <input  type="search" id="searchInput" style="width:18%" placeholder="Search..." oninput="performSearch()">
                            <!-- <input class="form-control " id="searchInput" type="search" placeholder="Search" style="width:18%" oninput="performSearch()"> -->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Profile Image</th>
                                        <th> Name </th>
                                        <th> Email Id </th>
                                        <th> Mobile No </th>
                                        <th> Gender </th>
                                        <th>Address</th>
                                        <th>Hobbies</th>
                                        <th>Qualification</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($user_details)){ ?>
                                @foreach($user_details as $key=> $user)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td scope="row"><img class="rounded-circle me-lg-2" src="{{ asset($user->image) }}" alt="" style="width: 60px; height: 60px;"></td>
                                        <td>{{$user->name}}</td>
                                        <td> {{$user->email}}</td>
                                        <td> {{$user->mobile}} </td>
                                        <td>{{$user->gender}}</td>
                                        <td> {{$user->address}}</td>
                                        
                                        <td> 
                                        @php
                                            $hobbies = json_decode($user->hobbies, true);
                                            foreach ($hobbies as $hob) {
                                                echo "$hob ,";
                                            }
                                        @endphp
                                        </td>
                                        <td> {{$user->qualification}} </td>
                                        <td>
                                           <?php 
                                            if($user->status == 1){ ?>
                                            <button type="button" class="btn btn-success me-2">Active</button> 
                                            <?php }else{?>
                                            <button type="button" class="btn btn-danger me-2">Inctive</button> 
                                            <?php }?> 
                                        </td>
                                        <td>
                                            <a href="/edit-user/{{$user->id }}" type="button" class="btn btn-primary btn-sm"> <i class="mdi mdi-pencil btn-icon-append"></i></a>
                                            <a href="/delete-user/{{$user->id }}" onclick="return confirm('Are you sure you want to delete?');"  type="button" class="btn btn-danger btn-sm"> <i class="mdi mdi-delete btn-icon-prepend"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <?php }else if(empty($user_details)){ ?>
                                        <tr>
                                            <td colspan="16">No data found</td>
                                        </tr>
                                    <?php }?>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    @endsection