<template>
    <div class="container">

       <div class="row">
          <div class="col-md-12 mt-5">

            <div class="text-center" v-if="spinner">
              <bounce-loader :loading="true" color="#9EDCC0" size="150px"></bounce-loader>
            </div>

            <div class="card" v-else>
              <div class="card-header">
                <h3 class="card-title">Categories List</h3>

                <div class="card-tools">

                    <button class="btn btn-success" @click="openNewModal()">
                        Add New Category
                    </button>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Clients</th>
                    <th class="text-center">Action</th>
                  </tr>

                  <tr v-for="(category, index) in categories.data" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td class="text-center">
                      <b :class="category.status == '0' ? 'red' : 'green' ">
                        {{ showStatus(category.status) }}
                      </b>
                    </td>

                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-warning" @click="showClientsModal(category)">
                        Clients
                      </button>

                    </td>

                    <td class="text-center">

                      <button type="button" class="btn btn-sm btn-primary" @click="openUpdateModal(category, index)">
                        <i class="fa fa-edit"></i>
                      </button>

                      <button type="button" class="btn btn-sm btn-danger" @click="deleteCategory(category)">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>

                  </tr>


                </tbody></table>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <pagination :data="categories" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
      </div>

        <!-- Create Modal -->
        <div class="modal fade bd-example-modal-lg" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel" v-show="!editCategory">Add New Category</h5>
                    <h5 class="modal-title" id="addNewLabel" v-show="editCategory">Update Category Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="text-center my-4" v-if="Modalspinner">
                  <moon-loader :loading="true" color="#9EDCC0" size="150px"></moon-loader>
                </div>

                <div v-else>
                  <form @submit.prevent=" editCategory ? updateCategory() : createNewCategory()" @keydown="form.onKeydown($event)">
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


              </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" v-show="!editCategory">Create</button>
                      <button type="submit" class="btn btn-success" v-show="editCategory">Update</button>
                    </div>
                  </form>
                </div>

                </div>
            </div>
        </div>


        <!-- Show Clients -->
        <div class="modal fade bd-example-modal-lg" id="showClients" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="addNewLabel"> <span class="text-danger"> {{ category.name }}</span>'s Pictures</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>


                  <div class="modal-body">

                    <div class="row p-2">
                      <div class="col-12">
                        <ul class="list-group">
                          <li class="list-group-item">
                            <strong class="w-25 d-inline-block">Clients:</strong>
                              <span v-for="(client, index) in category.clients" :key="client.id">
                                <div>
                                    {{ client.name }}
                                </div>
                              </span>
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


    </div>
</template>

<script>

export default {
        created() {
            Fire.$on('searching', () => {
                this.spinner = true;
                let query = this.$parent.$parent.search;
                dashboardAPI.categories
                  .find(query)
                  .then( data => {
                    console.log(data);
                      this.spinner = false;
                      this.categories = data
                    });
            });

            this.loadCategories();
        },

        data() {
            return {
                spinner: false,
                Modalspinner: false,
                category: {},
                editCategory: false,
                updateIndex: '',
                errorMessage: null,
                categories: {},
                form: new Form({
                    id: '',
                    name: '',
                    status: '1',
                })
          }
        },

        methods: {

            //  Open Modal for add new category
            openNewModal(){

                // Change submit action to Add new category
                this.editCategory = false;

                // reset inputs
                this.form.reset();


                // Show Modal
                $('#categoryModal').modal('show');
            },

            //  Open Modal for Update category
            openUpdateModal(category, index){
                // Change submit action to Update this category
                this.editCategory = true;

                this.form.fill(category);

                this.updateIndex = index;
                $('#categoryModal').modal('show');


            },

            //  Open Modal to show more details
            showClientsModal(category) {
              this.category = category;
              $('#showClients').modal('show');
            },

            // Search in this Page
            getResults(page = 1){
                dashboardAPI.categories
                  .fetch(page)
                  .then( data => {
                      this.categories = data
                    });
            },


            // Fetch Data from API
            loadCategories(){
              this.spinner = true;
              dashboardAPI.categories
                .fetch(1)
                .then( data => {
                    this.categories = data
                    this.spinner = false
                  });
            },

            // Create New Category
            createNewCategory() {
                this.Modalspinner = true
                // Reset error Message
                this.errorMessage = null;
                // Submit the form via a POST request
                this.form.post('dashboard/categories/create')
                    .then( res => {

                        // If Category Added Successfully
                        // Load new Data
                        this.loadCategories();
                        this.Modalspinner = false

                        // Hide Modal
                        $('#categoryModal').modal('hide');
                        // Show sweet alert
                        toast({
                            type: 'success',
                            title: 'Category added successfully'
                        })
                    })
                    .catch(err => {
                        // Catch
                        this.errorMessage = err.response.data.message;
                        this.Modalspinner = false
                    });
            },

            // Update The Category
            updateCategory() {
              this.Modalspinner = true
                // Submit the form via a POST request
                this.form.post('dashboard/categories/update')
                    .then( res => {

                        // Update Object
                        this.$set(this.categories.data, this.updateIndex, res.data[0])

                        this.Modalspinner = false

                        // Hide Modal
                        $('#categoryModal').modal('hide');

                        toast({
                            type: 'success',
                            title: 'Category updated successfully'
                        })

                    })
                    .catch(() => {
                        // Catch
                    });
            },

            // Delete the category with given ID
            deleteCategory(category) {

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
                   // If Category accept
                    if (result.value) {

                        // Send Request to server to Delete The given Category
                        dashboardAPI.categories
                          .delete(category.id)
                          .then( data => {

                              this.categories.data.splice(this.categories.data.indexOf(category), 1);
                              this.spinner = false

                              // Show success Message
                              toast({
                                  type: 'success',
                                  title: 'Category Deleted successfully'
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
