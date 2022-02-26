<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6">
        <h3>Datatables Server Side</h3>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item">Data Tables</li>
          <li class="breadcrumb-item active">Server Side</li>
        </ol>
      </div>
      <div class="col-lg-6">
        <!-- Bookmark Start-->
        <div class="bookmark pull-right">
          <ul>
            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Chat"><i data-feather="message-square"></i></a></li>
            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Icons"><i data-feather="command"></i></a></li>
            <li><a href="#" data-container="body" data-toggle="popover" data-placement="top" title="" data-original-title="Learning"><i data-feather="layers"></i></a></li>
            <li><a href="#"><i class="bookmark-search" data-feather="star"></i></a>
            <form class="form-inline search-form">
              <div class="form-group form-control-search">
                <input type="text" placeholder="Search..">
              </div>
            </form>
          </li>
        </ul>
      </div>
      <!-- Bookmark Ends-->
    </div>
  </div>
</div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
<div class="row">
  <!-- Server Side Processing start-->
  <!-- <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Server Side Processing</h5><span>In some tables you might wish to have some content generated automatically.</span>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="display datatables" id="server-side-datatable">
            <thead>
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </thead>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div> -->

  <!-- http Server Side start-->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Custom HTTP variables</h5><span>The example below shows server-side processing being used with an extra parameter being sent to the server by using the ajax.data option as a function</span>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="display datatables" id="datatable-http">
            <thead>
              <tr>
                <?for($field=1;$field<=listLen($record_show,"~");$field++){
                  $row_detail = listGetAt($record_show,$field,"~");
                  // $row_field = listGetAt($row_detail,1,"|");
                  $row_aliasName = listGetAt($row_detail,2,"|");
                  ?>
                    <th><?=$row_aliasName?></th>
                <?}?>
               
              </tr>
            </thead>
            <!-- <tbody> -->
              
            <!-- </tbody> -->
           <!--  <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
            </tfoot> -->
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- http Server Side end-->
</div>
</div>