<style>
    .widget-user-header {
        height: 250px !important;
        background-position: center center;
        position: relative
    }
    .widget-user-header-op {
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%
    }
    .widget-user-header .widget-user-username {
        position: inherit
    }
    .widget-user-header .widget-user-desc {
       position: inherit     
    }

    .card .border-right {
        border-right: 1px solid #b7b9bb !important
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">

                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('./img/user-cover.png') center center;">
                        <div class="widget-user-header-op"></div>
                        <h3 class="widget-user-username">{{ this.form.name }}</h3>
                        <h5 class="widget-user-desc">{{ this.form.type }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" :src="showProfilePhoto()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">3,200</h5>
                            <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header">13,000</h5>
                            <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">35</h5>
                            <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>

            </div>

            <div class="col-md-12 mt-2">

                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link show" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane show" id="activity">
                                    <h2 class="center"> Display User Activity </h2>
                            </div>

                            <div class="tab-pane active" id="settings">
                               

                                
                                <form @submit.prevent="updateProfile()" @keydown="form.onKeydown($event)">
                                    <div class="card-body">
                                        
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" v-model="form.name" 
                                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" 
                                                name="name" placeholder="Enter name">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="email" v-model="form.email" class="form-control" id="email" :class="{ 'is-invalid': form.errors.has('email') }"
                                                placeholder="Enter email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>

                                        <div class="form-group">
                                            <label>Bio</label>
                                            <textarea class="form-control" v-model="form.bio" :class="{ 'is-invalid': form.errors.has('bio') }"
                                                rows="3" placeholder="Enter bio"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>

                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" @change="uploadProfilePhoto" class="custom-file-input" name="photo">
                                                <label class="custom-file-label" for="photo">Choose image</label>
                                                <has-error :form="form" field="name"></has-error>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" name="password" placeholder="Password">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.card-body @click.prevent="updateProfile" -->

                            </form>


                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    </div>
            
                </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                profilePhotoChanged: false,
                profilePhoto: '',
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: '',
                })
            }
        },
        created(){
            axios.get('api/profile')
                .then( ({ data }) => { 
                    this.form.fill(data);
                    // store original photo to save it
                    this.profilePhoto = data.photo;
                })
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {

            updateProfile(){
                
                this.form.put('api/profile')
                    .then( res => {
                        // console.log(res.data);
                        this.form.photo = res.data.profilePhoto;
                        // Success message
                        Swal('updated', 'User info has been updated.', 'success');
                        // change variable to false again to view new image
                        this.profilePhotoChanged = false;
                    })
                    .catch( error => {
                        /* if we using axios, we can get an errors like that
                         this.form.errors.errors =  error.response.data.errors;
                        */
                    });
            },

            // convert image to base64
            uploadProfilePhoto(e) {
                const file = e.target.files[0];
                const reader = new FileReader();
                
                if(file['size'] < 2111775) {
                    
                    reader.onloadend = (file) => {
                        this.form.photo = reader.result;
                    } 
                    reader.readAsDataURL(file);
                } else {
                    Swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'This image is larger than 2MB'
                    })             
                }

                // true, to don't change original photo instantly 
                this.profilePhotoChanged = true;
            },

            showProfilePhoto(){
                // if true, then don't change original photo instantly
                // if false, change photo with new photo
                return this.profilePhotoChanged == true ? "img/profile/"+this.profilePhoto : "img/profile/"+this.form.photo;
            }
        }
    }
</script>
