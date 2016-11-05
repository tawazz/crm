<template lang="html">
  <div id="addCustomer">
    <div class="row">
      <div class="col-lg-12">
        <div class="jumbotron text-center">
          <h1>Add New Customer</h1>
          <p><li class="fa fa-2x fa-user-plus "></li></p>
          <p><router-link :to="{name:'customers'}" class="btn btn-primary btn-lg"  role="button">Back To Customers</router-link></p>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <form >
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">First Name</label>
                    <input type="text" class="form-control" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Last Name</label>
                    <input type="text" class="form-control"  />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Company</label>
                    <input type="text" class="form-control"  />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Email</label>
                    <input type="email" class="form-control"  />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Phone</label>
                    <input type="email" class="form-control"  />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group ">
                    <label class="control-label" for="inputSuccess2">Address</label>
                    <textarea type="text" class="form-control"  />
                  </div>
                </div>
              </div>
              <input type="hidden" >
              <div class="row">
                <div class="col-md-12">
                  <a href="#" class="btn btn-success btn-raised" id="saveBtn"> Save</a>
                  <a href="/admin/users" class="btn btn-danger btn-raised"> Cancel</a>
                </div>
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
  name:'addCustomer'
}
</script>

<style lang="css">
</style>
