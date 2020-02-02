<template>
    <div class="container">

       <div class="row">
          <div class="col-md-12 mt-5">

            <div class="text-center" v-if="spinner">
              <bounce-loader :loading="true" color="#9EDCC0" size="150px"></bounce-loader>
            </div>

            <div class="card" v-else>
              <div class="card-header">
                <h3 class="card-title">Services List for <span v-if="services.data[0]"> {{ services.data[0].client.name }} </span> </h3>

                <div class="card-tools">

                    <button class="btn btn-success" @click="openNewModal()">
                        Add New Service
                    </button>

                </div>

              </div>
              <!-- /.card-header -->
              <div v-if="services.data.length > 0" class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Currency</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Pictures</th>
                    <th class="text-center">Action</th>
                  </tr>

                  <tr v-for="(service, index) in services.data" :key="service.id">
                    <td>{{ service.id }}</td>
                    <td>{{ service.name }}</td>
                    <td>{{ service.price }}</td>
                    <td>{{ showCurrency(service.currency) }}</td>
                    <td class="text-center">
                      <b :class="service.status == '0' ? 'red' : 'green' ">
                        {{ showStatus(service.status) }}
                      </b>
                    </td>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-warning" @click="showPicturesModal(service)">
                        Pictures
                      </button>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-success" @click="showServiceModal(service, index)">
                        <i class="fa fa-eye"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-primary" @click="openUpdateModal(service, index)">
                        <i class="fa fa-edit"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-danger" @click="deleteService(service)">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>

                  </tr>


                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div v-else>
                  <h3 class="text-danger text-center my-4">
                    There's no Data Available
                  </h3>
              </div>
              <div class="card-footer">
                <pagination :data="services" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
      </div>

        <!-- Create Modal -->
        <div class="modal fade bd-example-modal-lg" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel" v-show="!editService">Add New Service</h5>
                    <h5 class="modal-title" id="addNewLabel" v-show="editService">Update Service Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center my-4" v-if="Modalspinner">
                  <moon-loader :loading="true" color="#9EDCC0" size="150px"></moon-loader>
                </div>

                <div v-else>
                  <form @submit.prevent=" editService ? updateService() : createNewService()" @keydown="form.onKeydown($event)">
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


                      <!-- Description Field -->
                      <div class="form-group">
                        <textarea v-model="form.description" name="description" placeholder="description"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                        </textarea>
                        <has-error :form="form" field="description"></has-error>
                      </div>

                      <!-- Details Field -->
                      <div class="form-group">
                        <textarea v-model="form.details" name="details" placeholder="details"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('details') }">
                      </textarea>
                      <has-error :form="form" field="details"></has-error>
                    </div>

                  <!-- Price Field -->
                  <div class="form-group">
                    <input v-model="form.price" type="text" name="price" placeholder="Price"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                    <has-error :form="form" field="price"></has-error>
                  </div>

                  <!-- Currency Field -->
                  <div class="form-group">
                    <label for="status">Currency</label>
                    <select name="status" v-model="form.currency" id="currency" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('currency') }">
                      <option value="egp">EGP</option>
                      <option value="kwd">KWD</option>
                      <option value="aed">AED</option>
                    </select>
                    <has-error :form="form" field="currency"></has-error>
                  </div>


                  <!-- Status Field -->
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" v-model="form.status" id="status" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('status') }">
                      <option value="0">Not Active</option>
                      <option value="1">Active</option>
                    </select>
                    <has-error :form="form" field="status"></has-error>
                  </div>



              </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" v-show="!editService">Create</button>
                      <button type="submit" class="btn btn-success" v-show="editService">Update</button>
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
                      <h5 class="modal-title" id="addNewLabel"> <span class="text-danger"> {{ service.name }}</span>'s Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                    <div class="row p-2">
                      <div class="col-12">
                        <ul class="list-group">

                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Name:</strong>
                            {{ service.name }}
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-2">
                                  <strong class="w-25 d-inline-block">Description:</strong>
                                </div>
                                <div class="col-10">
                                  {{ service.description }}
                                </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-2">
                                  <strong class="w-25 d-inline-block">Details:</strong>
                                </div>
                                <div class="col-10">
                                  {{ service.details }}
                                </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Price:</strong>
                            {{ service.price }} {{ showCurrency(service.currency) }}
                          </li>
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Status:</strong>
                            {{ showStatus(service.status) }}
                          </li>
                          <li class="list-group-item" v-show="service.working_all == 0">
                            <strong class="w-25 d-inline-block">Pictures:</strong>
                            <img v-for="picture in service.pictures" :key="picture.id"
                              class="imgPreview img-fluid mx-2"
                              :src="'/img/services/'+picture.name"
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
                      <h5 class="modal-title" id="addNewLabel"> <span class="text-danger"> {{ service.name }}</span>'s Pictures</h5>
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
                        <div class="col-sm-2" v-for="picture in service.pictures" :key="picture.id">
                          <div class="card p-2">
                            <img class="card-img-top img-fluid" :src="'/img/services/'+picture.name">
                            <div class="card-body text-center">
                              <button class="btn btn-danger" @click="deletePicture(service.id, picture.id)"> <i class="fa fa-trash"></i></button>
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
                                ref="serviceDropzone"
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

export default {
        components: {
          vueDropzone: vue2Dropzone
        },
        created() {
          if (isNaN(this.$route.params.id)) {
            // Not a number, then push to 404 page
            this.$router.push('/not-found');
          } else {
            // is Number then send a request to the server with this ID
            this.clientID = this.$route.params.id;
            this.loadServices(this.$route.params.id);
          }
        },

        data() {
            return {
                spinner: false,
                Modalspinner: false,
                clientID: '',
                services: {},
                service: {},
                editService: false,
                updateIndex: '',
                hideWorkTime: false,
                errorMessage: null,
                servicePictures: {
                  id: null,
                  pictures: {}
                },
                form: new Form({
                    id: '',
                    name: '',
                    description: '',
                    details: '',
                    price: '',
                    currency: 'egp',
                    status: '1',
                    client_id: '',
                }),
                dropzoneOptions: {
                    url: dashboardAPI.services.saveImage,
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

            //  Open Modal for add new service
            openNewModal(){

                // Change submit action to Add new service
                this.editService = false;
                // reset inputs
                this.form.reset();

                // Reset Dropzone images
                this.$refs.serviceDropzone.removeAllFiles();

                // Show Modal
                $('#serviceModal').modal('show');
            },

            //  Open Modal for Update service
            openUpdateModal(service, index){
                // Change submit action to Update this service
                this.editService = true;
                this.form.fill(service);
                // Pass Service Index [ this.service ]
                this.updateIndex = index;

                $('#serviceModal').modal('show');


            },

            //  Open Modal to show more details
            showServiceModal(service) {
              this.service = service;
              $('#showModal').modal('show');
            },

            //  Open Modal to show more details
            showPicturesModal(service) {
              this.service = service;
              this.servicePictures.id = service.id;
              $('#showPictures').modal('show');
            },

            // Search in this Page
            getResults(page = 1){
                this.spinner = true;
                dashboardAPI.services
                  .fetch(this.clientID, page)
                  .then( data => {
                      this.services = data
                      this.spinner = false
                    });
            },


            // Fetch Data from API
            loadServices(id){
              this.spinner = true;
              dashboardAPI.services
                .fetch(id, 1)
                .then( data => {
                    this.services = data
                    this.spinner = false
                  })
                  .catch( err => {
                    console.log("Err");
                      this.spinner = false
                  });
            },

            // Create New Service
            createNewService() {
                this.Modalspinner = true
                // Reset error Message
                this.errorMessage = null;

                this.form.client_id = this.clientID;
                // Submit the form via a POST request
                this.form.post('dashboard/services/create')
                    .then( res => {

                        // If Service Added Successfully
                        // Load new Data
                        // this.loadServices();
                        console.log(res.data[0]);
                        this.services.data.unshift(res.data[0]);
                        this.Modalspinner = false

                        // Hide Modal
                        $('#serviceModal').modal('hide');
                        // Show sweet alert
                        toast({
                            type: 'success',
                            title: 'Service added successfully'
                        })
                    })
                    .catch(err => {
                        // Catch
                        this.errorMessage = err.response.data.message;
                        this.Modalspinner = false
                    });
            },

            // Update The Service
            updateService() {
                this.Modalspinner = true
                // Reset error Message
                this.errorMessage = null;
                // Submit the form via a POST request
                this.form.post('dashboard/services/update')
                    .then( res => {
                        // Update Current Object only without load all services
                        this.$set(this.services.data, this.updateIndex, res.data[0])

                        this.Modalspinner = false
                        // Hide Modal
                        $('#serviceModal').modal('hide');

                        toast({
                            type: 'success',
                            title: 'Service updated successfully'
                        })

                    })
                    .catch( err => {
                        // Catch
                        this.errorMessage = err.response.data.message;
                        this.Modalspinner = false
                    });
            },

            // Delete the service with given ID
            deleteService(service) {
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
                   // If Service accept
                    if (result.value) {

                        // Send Request to server to Delete The given Service
                        dashboardAPI.services
                          .delete(service.id)
                          .then( data => {
                            // Remove Current Object from Services without load all services
                            this.services.data.splice(this.services.data.indexOf(service), 1);
                            this.spinner = false

                              // Show sweet alert
                              toast({
                                  type: 'success',
                                  title: 'Service Deleted successfully'
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

            // Save Service Pictures
            savePictures() {
              this.Modalspinner = true
              dashboardAPI.services
                .savePictures(this.servicePictures)
                .then( data => {

                    let oldPictures = this.service.pictures;
                    let newPictures = oldPictures.concat(data);
                    this.service.pictures = newPictures;
                    this.$refs.serviceDropzone.removeAllFiles();
                    this.Modalspinner = false
                  })
                  .catch(() => {
                    this.Modalspinner = false
                  });
            },

            //  Delete Service Picture
            deletePicture(id, picture) {
              this.Modalspinner = true
              const data = {
                id, picture
              }
              dashboardAPI.services
                .deletePicture(data)
                .then( data => {
                    this.service.pictures = data;
                    this.Modalspinner = false
                  })
                  .catch(() => {
                    this.Modalspinner = false
                  });
            },

            // Add this picture to the list
            vfileAdded(file, dataURL) {
              this.servicePictures.pictures[file.name] = dataURL;
            },

            // called when the service click on remove file button
            vfileRemoved(file, error){
              // Delete this picture from list
              delete this.servicePictures.pictures[file.name];
            },

            // Show status based on given number
            showStatus(status) {
              if (status == "0") {
                return "Not Active"
              } else {
                return "Active"
              }

            },

            showCurrency(currency) {
              return currency ?  currency.toUpperCase() : null;
            }

        } // End / Methods

    }
</script>

<style media="screen">
  textarea.form-control {
    height: 100px
  }
</style>
