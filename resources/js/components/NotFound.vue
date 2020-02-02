<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="error-page">
                    <h2 class="headline text-danger"> 404</h2>

                    <div class="error-content">
                    <h3><i class="fa fa-warning text-warning"></i> Oops! Page not found.</h3>

                    <p>
                        We could not find the page you were looking for.
                        Meanwhile, you may <a href="../../index.html">return to dashboard</a> or try using the search form.
                    </p>

                    <form class="search-form">
                        <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-danger"><i class="fa fa-search"></i>
                            </button>
                        </div>
                        </div>
                        <!-- /.input-group -->
                    </form>
                    </div>
                    <!-- /.error-content -->
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
