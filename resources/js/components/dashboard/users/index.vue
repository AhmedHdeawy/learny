<template>
    <div class="container">

       <div class="row">
          <div class="col-md-12 mt-5">

            <div class="text-center" v-if="spinner">
              <bounce-loader :loading="true" color="#9EDCC0" size="150px"></bounce-loader>
            </div>

            <div class="card" v-else>
              <div class="card-header">
                <h3 class="card-title">Users List</h3>

                <div class="card-tools">

                    <button class="btn btn-success" @click="openNewModal()">
                        Add New User
                    </button>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Clients</th>
                    <th class="text-center">Avatar</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>

                  <tr v-for="(user, index) in users.data" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td class="text-center">
                        <router-link :to="'/dashboard/client/'+user.id" class="btn btn-sm btn-primary">
                          Clients
                        </router-link>
                    </td>
                    <td class="text-center">
                      <img class="imgPreview img-fluid" alt="Upload" :src="'/img/users/'+user.avatar" />
                    </td>
                    <td class="text-center">
                      <b :class="user.status == '0' ? 'red' : 'green' ">
                        {{ showStatus(user.status) }}
                      </b>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" @click="openUpdateModal(user, index)">
                        <i class="fa fa-edit"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-danger" @click="deleteUser(user)">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>

                  </tr>


                </tbody></table>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
      </div>

        <!-- Create Modal -->
        <div class="modal fade bd-example-modal-lg" id="userModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel" v-show="!editUser">Add New User</h5>
                    <h5 class="modal-title" id="addNewLabel" v-show="editUser">Update User Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center my-4" v-if="Modalspinner">
                  <moon-loader :loading="true" color="#9EDCC0" size="150px"></moon-loader>
                </div>

                <div v-else>
                  <form @submit.prevent=" editUser ? updateUser() : createNewUser()" @keydown="form.onKeydown($event)">
                    <div class="modal-body">

                      <p class="text-danger p-2 text-bold h3" v-if="errorMessage">
                        {{ errorMessage }}
                      </p>

                      <!-- Name Field -->
                      <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                      </div>

                      <!-- Email Field -->
                      <div class="form-group">
                        <input v-model="form.email" type="text" name="email" placeholder="Email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                      </div>

                      <!-- Password Field -->
                      <div class="form-group">
                        <input v-model="form.password" type="password" name="password" placeholder="Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                      </div>


                      <!-- Status Field -->
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" v-model="form.status" id="status" class="form-control"
                        :class="{ 'is-invalid': form.errors.has('status') }">
                          <option value="0">Stopped</option>
                          <option value="1">Active</option>
                        </select>
                        <has-error :form="form" field="status"></has-error>
                      </div>


                <!-- Logo Field -->
                <div class="form-group">

                  <div class="custom-file">
                    <label>Upload Logo</label>
                    <image-upload name="avatar" @imageChange="imageChange" @imageRemoved="imageRemoved" />
                  </div>
                  <has-error :form="form" field="avatar"></has-error>
                </div>


              </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" v-show="!editUser">Create</button>
                      <button type="submit" class="btn btn-success" v-show="editUser">Update</button>
                    </div>
                  </form>
                </div>

                </div>
            </div>
        </div>


    </div>
</template>

<script>

export default {
        created() {
            Fire.$on('searching', () => {
                this.spinner = true;
                let query = this.$parent.$parent.search;
                dashboardAPI.users
                  .find(query)
                  .then( data => {
                    console.log(data);
                      this.spinner = false;
                      this.users = data
                    });
            });

            this.loadUsers();
        },

        data() {
            return {
                spinner: false,
                Modalspinner: false,
                users: {},
                user: {},
                editUser: false,
                updateIndex: '',
                errorMessage: null,
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    avatar: '',
                    location: 'location',
                    status: '1',
                })
          }
        },

        methods: {

            //  Open Modal for add new user
            openNewModal(){

                // Change submit action to Add new user
                this.editUser = false;

                // reset inputs
                this.form.reset();

                // Show Modal
                $('#userModal').modal('show');
            },

            //  Open Modal for Update user
            openUpdateModal(user, index){
                // Change submit action to Update this user
                this.editUser = true;

                this.form.fill(user);

                // Pass User Index [ this.user ]
                this.updateIndex = index;

                $('#userModal').modal('show');


            },


            // Search in this Page
            getResults(page = 1){

                dashboardAPI.users
                  .fetch(page)
                  .then( data => {
                      this.users = data
                    });
            },

            // Fetch Data from API
            loadUsers(){
              this.spinner = true;
              dashboardAPI.users
                .fetch(1)
                .then( data => {
                    this.users = data
                    this.spinner = false
                  });
            },

            // Create New User
            createNewUser() {
                this.Modalspinner = true
                // Reset error Message
                this.errorMessage = null;
                // Submit the form via a POST request
                this.form.post('dashboard/users/create')
                    .then( res => {

                        // If User Added Successfully
                        // Load new Data
                        this.loadUsers();
                        this.Modalspinner = false

                        // Hide Modal
                        $('#userModal').modal('hide');
                        // Show sweet alert
                        toast({
                            type: 'success',
                            title: 'User added successfully'
                        })
                    })
                    .catch(err => {
                        // Catch
                        this.errorMessage = err.response.data.message;
                        this.Modalspinner = false
                    });
            },

            // Update The User
            updateUser() {
              this.Modalspinner = true
                // Submit the form via a POST request
                this.form.post('dashboard/users/update')
                    .then( res => {

                        // Update Object
                        this.$set(this.users.data, this.updateIndex, res.data[0])

                        this.Modalspinner = false
                        // Hide Modal
                        $('#userModal').modal('hide');

                        toast({
                            type: 'success',
                            title: 'User updated successfully'
                        })

                    })
                    .catch(() => {
                        // Catch
                    });
            },

            // Delete the user with given ID
            deleteUser(user) {

              this.spinner = true
                // Firstly, Show Warning message
                Swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                   // If User accept
                    if (result.value) {

                        // Send Request to server to Delete The given User
                        dashboardAPI.users
                          .delete(user.id)
                          .then( data => {

                            this.users.data.splice(this.users.data.indexOf(user), 1);
                            this.spinner = false

                              // Show sweet alert
                              toast({
                                  type: 'success',
                                  title: 'User Deleted successfully'
                              })
                          })
                          .catch( () => {
                            Swal('Failed', 'There was something wrong.', 'warning')
                            this.spinner = false
                          });

                    }
                })
                .catch(() => {

                });

            },


            // Get image andd pass it to data
            imageChange(name, readerResult) {
              this.form.avatar = readerResult;
            },

            // remove image from data when user remove it
            imageRemoved(name) {
              this.form.avatar = '';
            },


            // Show status based on given number
            showStatus(status) {
              if (status == "0") {
                return "Stopped"
              } else {
                return "Active"
              }
            }


        } // End / Methods

    }
</script>

<style media="screen">
  textarea.form-control {
    height: 100px
  }
</style>
