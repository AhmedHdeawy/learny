<template>
    <div class="container">

       <div class="row">
          <div class="col-md-12 mt-5">

            <!-- <HereMap
            appId="lTKYqDGmQqHJQhh8ywev"
            appCode="cORsPx29dAUUQFHmGseeiA"
            lat="37.7397"
            lng="-121.4252"
            width="80%"
            height="500px"
            location="Cairo" /> -->

            <div class="text-center" v-if="spinner">
              <bounce-loader :loading="true" color="#9EDCC0" size="150px"></bounce-loader>
            </div>

            <div class="card" v-else>
              <div class="card-header">
                <h3 class="card-title">Clients List</h3>

                <div class="card-tools">

                    <button class="btn btn-success" @click="openNewModal()">
                        Add New Client
                    </button>

                </div>

              </div>
              <!-- /.card-header -->
              <div v-if="clients.data.length > 0" class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>
                      <input type="checkbox" class="form-check-input"
                              v-model="isCheckAll" @change="selectedItems()">
                    </th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User</th>
                    <th>Phone</th>
                    <th class="text-center">Logo</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Pictures</th>
                    <th class="text-center">Services</th>
                    <th class="text-center">Action</th>
                  </tr>

                  <tr v-for="(client, index) in clients.data" :key="client.id">
                    <td class="text-center">
                      <input type='checkbox' class="form-check-input" v-bind:value="client.id" v-model='selected' @change="updatecheckAll()">
                    </td>
                    <td>{{ client.id }}</td>
                    <td>{{ client.name }}</td>
                    <td>{{ client.user.name }}</td>
                    <td>{{ client.phone }}</td>
                    <!-- <td>{{ client.logo }}</td> -->
                    <td class="text-center">
                      <img class="imgPreview img-fluid" alt="Upload" :src="'/img/clients/'+client.logo" />
                    </td>

                    <td class="small bold text-center">
                      <b :class="client.status == '0' ? 'red' : 'green' ">
                        {{ showStatus(client.status) }}
                      </b>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-warning" @click="showPicturesModal(client)">
                        Pictures
                      </button>
                    </td>

                    <td class="text-center">
                      <router-link :to="'/dashboard/service/'+client.id" class="btn btn-sm btn-primary">
                        Services
                      </router-link>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-success" @click="showClientModal(client, index)">
                        <i class="fa fa-eye"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-primary" @click="openUpdateModal(client, index)">
                        <i class="fa fa-edit"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-danger" @click="deleteClient(client)">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>

                  </tr>


                </tbody></table>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <div class="row">
                    <div class="col-6 pl-0">

                      <button type="button" class="btn btn-danger" @click="deleteSelected()">
                        Delete Selected
                      </button>

                    </div>
                    <div class="col-6">
                      <pagination :data="clients" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
      </div>

        <!-- Create Modal -->
        <div class="modal fade bd-example-modal-lg" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel" v-show="!editClient">Add New Client</h5>
                    <h5 class="modal-title" id="addNewLabel" v-show="editClient">Update Client Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center my-4" v-if="Modalspinner">
                  <moon-loader :loading="true" color="#9EDCC0" size="150px"></moon-loader>
                </div>

                <div v-else>
                  <form @submit.prevent=" editClient ? updateClient() : createNewClient()" @keydown="form.onKeydown($event)">
                    <div class="modal-body">

                      <p class="text-danger p-2 text-bold h3" v-if="errorMessage">
                        {{ errorMessage }}
                      </p>

                      <!-- Categories Field -->
                      <div class="form-group">
                        <label for="categories">Categories</label>
                        <!-- <select name="categories" v-model="form.categories" id="categories" class="form-control"
                        :class="{ 'is-invalid': form.errors.has('categories') }" multiple>
                          <option v-for="(category, index) in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                          </option>
                        </select> -->

                        <v-select v-model="form.categories"
                          placeholder="Choose"
                          label="name"
                          @input="changeSelectedCategory"
                          multiple
                          :options="categories">
                        </v-select>

                        <has-error :form="form" field="categories"></has-error>
                      </div>

                      <!-- Name Field -->
                      <div class="form-group">
                        <input v-model="form.name" type="text" name="name" placeholder="Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                      </div>

                      <!-- Slug Field -->
                      <div class="form-group">
                        <input v-model="form.slug" type="text" name="slug" placeholder="Slug"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('slug') }">
                        <has-error :form="form" field="slug"></has-error>
                      </div>

                      <!-- Description Field -->
                      <div class="form-group">
                        <textarea v-model="form.description" name="description" placeholder="description"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                      </textarea>
                      <has-error :form="form" field="description"></has-error>
                    </div>

                    <!-- Address Field -->
                    <div class="form-group">
                      <textarea v-model="form.address" name="address" placeholder="address"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                    </textarea>
                    <has-error :form="form" field="address"></has-error>
                  </div>

                  <!-- Phone Field -->
                  <div class="form-group">
                    <input v-model="form.phone" type="text" name="phone" placeholder="Phone"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                    <has-error :form="form" field="phone"></has-error>
                  </div>

                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="workingAll" id="workingAll"
                      v-model="form.working_all"
                      @change="workingAll"
                      >
                      <label class="form-check-label" for="workingAll">
                        Work 24 hours
                      </label>
                    </div>
                  </div>


                  <div v-if="!hideWorkTime">

                    <!-- Open At Field -->
                    <div class="form-group">
                      <label for="close_at">Open at</label>
                      <datetime input-class="form-control" input-id="open_at"
                      :minute-step="minuteStep" type="time"
                      v-model="form.open_at"
                      :use12-hour="use12_hour"
                      ></datetime>
                    </div>

                    <!-- Close At Field -->
                    <div class="form-group">
                      <label for="close_at">Close at</label>
                      <datetime input-class="form-control" input-id="close_at"
                      :minute-step="minuteStep" type="time"
                      v-model="form.close_at"
                      :use12-hour="use12_hour"
                      ></datetime>
                    </div>

                  </div>

                  <!-- Type Field -->
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" v-model="form.status" id="status" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('status') }">
                      <option value="0">Not Active</option>
                      <option value="1">Active</option>
                      <option value="2">Stopped</option>
                    </select>
                    <has-error :form="form" field="status"></has-error>
                  </div>


                <!-- Logo Field -->
                <div class="form-group">

                  <div class="custom-file">
                    <label>Upload Logo</label>
                    <image-upload name="logo" @imageChange="imageChange" @imageRemoved="imageRemoved" />
                  </div>
                  <has-error :form="form" field="phone"></has-error>
                </div>


              </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" v-show="!editClient">Create</button>
                      <button type="submit" class="btn btn-success" v-show="editClient">Update</button>
                    </div>
                  </form>
                </div>

                </div>
            </div>
        </div>

        <!-- Show Modal -->
        <div class="modal fade bd-example-modal-lg" id="showModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel"> <span class="text-danger"> {{ client.name }}</span>'s Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                    <div class="row p-2">
                      <div class="col-12">
                        <ul class="list-group" v-if="client">

                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Categories:</strong>
                              <span v-for="(category, index) in client.categories" :key="category.id">
                                <span v-if="index == 0">
                                  {{ category.name }} -
                                </span>
                                <span v-else>
                                    {{ category.name }}
                                </span>
                              </span>
                          </li>

                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Name:</strong>
                            {{ client.name }}
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Description:</strong>
                            {{ client.description }}
                          </li>
                          <li class="list-group-item" v-if="client.user">
                            <strong class="w-25 d-inline-block">User:</strong>
                            {{ client.user.name }}
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Phone:</strong>
                            {{ client.phone }}
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Address:</strong>
                            {{ client.address }}
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Logo:</strong>
                            <img class="imgPreview img-fluid" alt="Upload" :src="'/img/clients/'+client.logo" />
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Status:</strong>

                            {{ showStatus(client.status) }}
                          </li>
                          <li class="list-group-item" v-show="client.working_all == 1">
                            <strong class="w-25 d-inline-block">Working 24 hours:</strong>
                            {{ client.working_all ? 'Yes' : 'No' }}
                          </li>
                          <li class="list-group-item" v-show="client.working_all == 0">
                            <strong class="w-25 d-inline-block">Open at:</strong>
                            {{ client.open_at }}
                          </li>
                          <li class="list-group-item" v-show="client.working_all == 0">
                            <strong class="w-25 d-inline-block">Close at:</strong>
                            {{ client.close_at }}
                          </li>

                          <li class="list-group-item" v-show="client.working_all == 0">
                            <strong class="w-25 d-inline-block">Pictures:</strong>

                            <img v-for="picture in client.pictures" :key="picture.id"
                              class="imgPreview img-fluid mx-2"
                              :src="'/img/clients/'+picture.name"
                            />
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>

                </div>
            </div>
        </div>

        <!-- Show Pictures -->
        <div class="modal fade bd-example-modal-lg" id="showPictures" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel"> <span class="text-danger"> {{ client.name }}</span>'s Pictures</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="text-center my-4" v-if="Modalspinner">
                    <moon-loader :loading="true" color="#9EDCC0" size="150px"></moon-loader>
                  </div>

                  <div class="modal-body" v-else>
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-sm-2" v-for="picture in client.pictures" :key="picture.id">
                          <div class="card p-2">
                            <img class="card-img-top img-fluid" :src="'/img/clients/'+picture.name">
                            <div class="card-body text-center">
                              <button class="btn btn-danger" @click="deletePicture(client.id, picture.id)"> <i class="fa fa-trash"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">

                            <!-- Pictures Field -->
                            <div class="form-group w-100">

                              <label>Upload Pictures</label>
                              <vue-dropzone
                                id="pictures"
                                ref="clientDropzone"
                                :options="dropzoneOptions"
                                @vdropzone-removed-file="vfileRemoved"
                                @vdropzone-thumbnail="vfileAdded"
                                :destroyDropzone="true">
                              </vue-dropzone>

                            </div>

                            <button type="submit" @click="savePictures()" class="btn btn-primary">Save</button>

                      </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>

                </div>
            </div>
        </div>


    </div>
</template>

<script>

import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import HereMap from "./HereMap.vue"

export default {
        components: {
          vueDropzone: vue2Dropzone,
          HereMap
        },
        created() {
          if (isNaN(this.$route.params.id)) {
            // Not a number, then push to 404 page
            this.$router.push('/not-found');
          } else {
            // is Number then send a request to the server with this ID
            this.userID = this.$route.params.id;
            this.loadClients(this.$route.params.id);
          }

          this.loadCategroies();
        },

        data() {
            return {
                selected: [],
                isCheckAll: false,
                spinner: false,
                Modalspinner: false,
                minuteStep: 5,
                use12_hour: true,
                userID: '',
                clients: {},
                client: {},
                editClient: false,
                updateIndex: '',
                hideWorkTime: false,
                errorMessage: null,
                clientPictures: {
                  id: null,
                  pictures: {}
                },
                categories: [],
                form: new Form({
                    id: '',
                    name: '',
                    slug: '',
                    description: '',
                    address: '',
                    phone: '',
                    open_at: "08:00",
                    close_at: "08:00",
                    working_all: false,
                    status: '0',
                    logo: '',
                    categories: [],
                    user_id: ''
                    // pictures: {}
                }),
                dropzoneOptions: {
                    url: dashboardAPI.clients.saveImage,
                    autoProcessQueue: false,
                    thumbnailWidth: 150,
                    thumbnailHeight: 150,
                    maxFilesize: 3,
                    maxFiles: 15,
                    addRemoveLinks: true,
                    uploadMultiple: true,
                    acceptedFiles: 'image/*',
                },
          }
        },

        methods: {

            //  Open Modal for add new client
            openNewModal(){

                // Change submit action to Add new client
                this.editClient = false;

                // reset inputs
                this.form.reset();

                this.working_all = this.hideWorkTime = false;

                // Reset Dropzone images
                this.$refs.clientDropzone.removeAllFiles();

                // Show Modal
                $('#clientModal').modal('show');
            },

            //  Open Modal for Update client
            openUpdateModal(client, index){
                // Change submit action to Update this client
                this.editClient = true;

                this.form.fill(client);
                // Pass Client Index [ this.client ]
                this.updateIndex = index;

                if (client.working_all == "1") {
                  this.hideWorkTime = true;
                  this.working_all = false;
                }

                $('#clientModal').modal('show');


            },

            //  Open Modal to show more details
            showClientModal(client) {
              this.client = client;
              $('#showModal').modal('show');
            },

            //  Open Modal to show more details
            showPicturesModal(client) {
              this.client = client;
              this.clientPictures.id = client.id;
              $('#showPictures').modal('show');
            },

            // Search in this Page
            getResults(page = 1){
                dashboardAPI.clients
                  .fetch(page)
                  .then( data => {
                      this.clients = data
                    });
            },

            // Fetch Data from API
            loadCategroies(){
              dashboardAPI.clients
                .categories()
                .then( data => {
                    this.categories = data
                  });
            },


            // Fetch Data from API
            loadClients(id){
              this.spinner = true;
              dashboardAPI.clients
                .userClients(id, 1)
                .then( data => {
                    this.clients = data
                    this.spinner = false
                  })
                  .catch( err => {
                    console.log("Err");
                      this.spinner = false
                  });
            },

            // Create New Client
            createNewClient() {
                this.Modalspinner = true
                // Reset error Message
                this.errorMessage = null;

                this.form.user_id = this.userID;

                // Submit the form via a POST request
                this.form.post('dashboard/clients/create')
                    .then( res => {

                        // If Client Added Successfully
                        // Load new Data
                        this.loadClients();
                        this.Modalspinner = false

                        // Hide Modal
                        $('#clientModal').modal('hide');
                        // Show sweet alert
                        toast({
                            type: 'success',
                            title: 'Client added successfully'
                        })
                    })
                    .catch(err => {
                        // Catch
                        this.errorMessage = err.response.data.message;
                        this.Modalspinner = false
                    });
            },

            // Update The Client
            updateClient() {
              this.Modalspinner = true
                // Submit the form via a POST request
                this.form.post('dashboard/clients/update')
                    .then( res => {
                        // Update Object
                        this.$set(this.clients.data, this.updateIndex, res.data[0])

                        this.Modalspinner = false
                        // Hide Modal
                        $('#clientModal').modal('hide');

                        toast({
                            type: 'success',
                            title: 'Client updated successfully'
                        })

                    })
                    .catch(() => {
                        // Catch
                    });
            },

            // Delete the client with given ID
            deleteClient(client) {
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
                   // If Client accept
                    if (result.value) {

                        // Send Request to server to Delete The given Client
                        dashboardAPI.clients
                          .delete(client.id)
                          .then( data => {

                            this.clients.data.splice(this.clients.data.indexOf(client), 1);
                            this.spinner = false

                              // Show sweet alert
                              toast({
                                  type: 'success',
                                  title: 'Client Deleted successfully'
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

            // Bulck
            deleteSelected() {

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
                 // If Client accept
                  if (result.value) {

                  }
              })
              .catch(() => {

              });

            },

            // Save Client Pictures
            savePictures() {
              this.Modalspinner = true
              dashboardAPI.clients
                .savePictures(this.clientPictures)
                .then( data => {
                    let oldPictures = this.client.pictures;
                    let newPictures = oldPictures.concat(data);
                    this.client.pictures = newPictures;
                    this.$refs.clientDropzone.removeAllFiles();
                    this.Modalspinner = false
                  })
                  .catch(() => {
                    this.Modalspinner = false
                  });
            },

            //  Delete Client Picture
            deletePicture(id, picture) {
              this.Modalspinner = true
              const data = {
                id, picture
              }
              dashboardAPI.clients
                .deletePicture(data)
                .then( data => {
                    this.client.pictures = data;
                    this.Modalspinner = false
                  })
                  .catch(() => {
                    this.Modalspinner = false
                  });
            },

            // Handle Working time in Form
            workingAll(){
              // if the client working full day, then hide time duration
              if (this.form.working_all) {
                this.hideWorkTime = true;
              } else {
                // Else show time duration and hide Checkbox
                this.hideWorkTime = false;
              }
            },

            // Get image andd pass it to data
            imageChange(name, readerResult) {
              this.form.logo = readerResult;
            },

            // remove image from data when client remove it
            imageRemoved(name) {
              this.form.logo = '';
            },

            // Add this picture to the list
            vfileAdded(file, dataURL) {
              this.clientPictures.pictures[file.name] = dataURL;
            },

            // called when the client click on remove file button
            vfileRemoved(file, error){
              // Delete this picture from list
              delete this.clientPictures.pictures[file.name];
            },

            // Show status based on given number
            showStatus(status) {
              if (status == "0") {
                return "Not Active"
              } else if (status == "1") {
                return "Active"
              } else {
                return "Stopped"
              }

            },

            changeSelectedCategory(val) {
            },

            // when user check all rows, then add all IDs to array
            selectedItems() {

              if (this.isCheckAll == true) {
                const IDs = this.clients.data.map(client => client.id);
                this.selected = IDs;
              } else {
                this.selected = null;
              }

            },

            // When user check specified row
            updatecheckAll() {
                if(this.selected.length == this.clients.data.length){
                   this.isCheckAll = true;
                }else{
                   this.isCheckAll = false;
                }
            },


        } // End / Methods

    }
</script>

<style media="screen">
  textarea.form-control {
    height: 100px
  }
</style>
