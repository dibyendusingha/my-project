@extends('admin.layout.header')
@section('content')

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    <!-- End plugin css for this page -->
<?php 

//echo $edit_user;
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit User Form </h3>

        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{ url('update-user',$edit_user->id) }}" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" value="{{$edit_user->name}}" placeholder="Name" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="email" name="email" value="{{$edit_user->email}}" placeholder="Email" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="mobile" name="mobile" value="{{$edit_user->mobile}}" placeholder="Mobile number" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9 d-flex ">
                                    <div class="form-check pe-2">
                                        <label class="form-check-label"><input type="radio" name="gender" value="male" @if($edit_user->gender == 'male') checked @endif> Male </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label"><input type="radio" name="gender" value="female"  class="form-check-input" @if($edit_user->gender == 'female') checked @endif> Female </label>
                                    </div>
                                    <div class="form-check pe-2">
                                        <label class="form-check-label"><input type="radio" name="gender" value="other" class="form-check-input" @if($edit_user->gender == 'other') checked @endif> other </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputPassword2" class="col-sm-3 col-form-label" >Address</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="address" id="address" rows="4" >{{$edit_user->address}}</textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="qualification" class="col-sm-3 col-form-label">Qualification</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single" style="width:100%;height:48px" id="qualification" name="qualification" >
                                        <option >Select an option</option>
                                        <option value="M.A." {{($edit_user->qualification == 'M.A.') ? 'selected="selected"' : ""}}>M.A.</option>
                                        <option value="Bachelor" {{($edit_user->qualification == "Bachelor") ? 'selected="selected"' : ""}}>Bachelor</option>
                                        <option value="B.tech" {{($edit_user->qualification == "B.tech") ? 'selected="selected"' : ""}}>B.tech</option>
                                        <option value="Others" {{($edit_user->qualification == "Others") ? 'selected="selected"' : ""}}>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Hobbies</label>
                                <div class="col-sm-9 d-flex ">
                                    <div class="form-check pe-2">
                                        <label class="form-check-label"><input type="checkbox" name="hobbies[]" value="Playing" class="form-check-input" 
                                        @php if(in_array('Playing', json_decode($edit_user->hobbies,true))) { echo "checked";} @endphp> Playing </label>
                                    </div>
                                    <div class="form-check pe-2">
                                        <label class="form-check-label"><input type="checkbox" name="hobbies[]" value="Singing" class="form-check-input"
                                        @php if(in_array('Singing', json_decode($edit_user->hobbies,true))) { echo "checked";} @endphp> Singing </label>
                                    </div>
                                    <div class="form-check pe-2">
                                        <label class="form-check-label"><input type="checkbox" name="hobbies[]" value="Cooking" class="form-check-input"
                                        @php if(in_array('Cooking', json_decode($edit_user->hobbies,true))) { echo "checked";} @endphp> Cooking </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label" >Status</label>
                                <div class="col-sm-9">
                                    <select class="js-example-basic-single" style="width:100%" name="status" id="status" >
                                        <option value="" >select status </option>
                                        <option value="1" {{($edit_user->status == '1') ? 'selected="selected"' : ""}}>Active</option>
                                        <option value="2" {{($edit_user->status == '2') ? 'selected="selected"' : ""}}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Iamge Upload</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="image" name="edit_image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Iamge Upload</label>
                                <div class="col-sm-9" id="previewContainer" >
                                    <img id="previewImage" src="{{asset($edit_user->image)}}" alt="" style="width: 140px; height: 130px; border-radius: 15px; border:3px solid black">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <button class="btn btn-dark">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->


    @endsection