@extends('index')

@section('content')
       <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div id="user_form">
                        <h2>Add User</h2>
                        <form id="uploadForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                      
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" id="email" name="email" class="form-control">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                        
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Role:</label>
                                        <select id="role_id" name="role_id" class="form-control">
                                            <option value="">Please Select</option>
                                            
                                                @foreach($get_user_roles as $key=>$role)
                                                    <option value="{{ $role->id }}">{{ strtoupper($role->role_name) }}</option>
                                                @endforeach
                                            
                                        </select>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Profile Image:</label>
                                        <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
                                        <img src="" id="imgInp" height="100px" width="100px">
                                       
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Description:</label>
                                        <textarea id="description" name="description" class="form-control"></textarea>
                                        
                                    </div>                        
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
                <div class="col-md-12">

                    <div id="user_table">
                        <h2 class="mt-5">Users Table</h2>
                        <table class="table table-bordered" id="userTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Role</th>
                                    <th>Profile Image</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection        