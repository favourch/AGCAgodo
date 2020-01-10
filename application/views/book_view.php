<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Church Management System</title>
  <link href="<?php echo base_url('assests/css/styles.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


  <div class="container">
    <center>
      <h1>Church Management System</h1>
    </center>
    <h3>Members Database</h3>
    <br />
    <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Add Member</button>
    <br />
    <br />
    <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Surname</th>
          <th>Other Names</th>
          <th>Gender</th>
          <th>Dept</th>
          <th>Membership Status</th>
          <!--<th>Marital Status</th>
          <th>Occupation</th>
          <th>Phone Number</th>
          <th>E-Mail</th>
          <th>State</th>
          <th>LGA</th>
          <th>Home Town</th>-->

          <th style="width:125px;">Action
            </p>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($books as $book){?>
        <tr>
          <td><?php echo $book->book_id;?></td>
          <td><?php echo $book->surname;?></td>
          <td><?php echo $book->other_names;?></td>
          <td><?php echo $book->gender;?></td>
          <td><?php echo $book->department;?></td>
          <td><?php echo $book->member_status;?></td>
          <!--<td><?php echo $book->marital_status;?></td>
                <td><?php echo $book->occupation;?></td>
                <td><?php echo $book->book_isbn;?></td>
                <td><?php echo $book->email;?></td>
                <td><?php echo $book->state;?></td>
                <td><?php echo $book->lga;?></td>
                <td><?php echo $book->home_town;?></td>
								<td><?php echo $book->book_category;?></td>-->
          <td>
            <button class="btn btn-warning" onclick="edit_book(<?php echo $book->book_id;?>)"><i
                class="glyphicon glyphicon-pencil"></i></button>
            <button class="btn btn-danger" onclick="delete_book(<?php echo $book->book_id;?>)"><i
                class="glyphicon glyphicon-remove"></i></button>
            <button class="btn btn-success" onclick="view_member(<?php echo $book->book_id;?>)">View</i></button>


          </td>
        </tr>
        <?php }?>



      </tbody>

      <tfoot>
        <tr>
          <th>ID</th>
          <th>Surname</th>
          <th>Other Names</th>
          <th>Gender</th>
          <th>Dept</th>
          <th>Membership Status</th>
          <!--<th>Marital Status</th>
          <th>Occupation</th>
          <th>Phone Number</th>
          <th>E-Mail</th>
          <th>State</th>
          <th>LGA</th>
          <th>Home Town</th>-->
          <th>Action</th>
        </tr>
      </tfoot>
    </table>

  </div>

  <script src="<?php echo base_url('assests/jquery/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js')?>"></script>


  <script type="text/javascript">
    $(document).ready(function () {
      $('#table_id').DataTable();
    });
    var save_method; //for save method string
    var table;


    function add_book() {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_book(id) {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url: "<?php echo site_url('index.php/book/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {

          $('[name="book_id"]').val(data.book_id);
          $('[name="phone"]').val(data.phone);
          $('[name="surname"]').val(data.surname);
          $('[name="other_names"]').val(data.other_names);
          $('[name="gender"]').val(data.gender);
          $('[name="department"]').val(data.department);
          $('[name="member_status"]').val(data.member_status);
          $('[name="email"]').val(data.email);
          $('[name="home_town"]').val(data.home_town);
          $('[name="lga"]').val(data.lga);
          $('[name="marital_status"]').val(data.marital_status);
          $('[name="occupation"]').val(data.occupation);
          $('[name="state"]').val(data.state);
          $('[name="year_joined"]').val(data.year_joined);
          $('[name="nok"]').val(data.nok);
          $('[name="nok_phone"]').val(data.nok_phone);
          $('[name="nok_addr"]').val(data.nok_addr);
          $('[name="status"]').val(data.status);
          $('[name="bday"]').val(data.bday);
          $('[name="bmonth"]').val(data.bmonth);


          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('Edit Member'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('Error get data from ajax');
        }
      });
    }



    function view_member(id) {
      save_method = 'update';
      $('#form2')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url: "<?php echo site_url('index.php/book/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {

          $('[name="book_id"]').val(data.book_id);
          $('[name="phone"]').val(data.phone);
          $('[name="surname"]').val(data.surname);
          $('[name="other_names"]').val(data.other_names);
          $('[name="gender"]').val(data.gender);
          $('[name="department"]').val(data.department);
          $('[name="member_status"]').val(data.member_status);
          $('[name="email"]').val(data.email);
          $('[name="home_town"]').val(data.home_town);
          $('[name="lga"]').val(data.lga);
          $('[name="address"]').val(data.address);
          $('[name="marital_status"]').val(data.marital_status);
          $('[name="occupation"]').val(data.occupation);
          $('[name="state"]').val(data.state);
          $('[name="year_joined"]').val(data.year_joined);
          $('[name="nok"]').val(data.nok);
          $('[name="nok_phone"]').val(data.nok_phone);
          $('[name="nok_addr"]').val(data.nok_addr);
          $('[name="status"]').val(data.status);
          $('[name="bday"]').val(data.bday);
          $('[name="bmonth"]').val(data.bmonth);


          $('#modal_form_view').modal('show'); // show bootstrap modal when complete loaded
          $('.modal-title').text('ASSEMBLIES OF GOD CHURCH AGODO'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('Error get data from ajax');
        }
      });
    }



    function save() {
      var url;
      if (save_method == 'add') {
        url = "<?php echo site_url('index.php/book/book_add')?>";
      } else {
        url = "<?php echo site_url('index.php/book/book_update')?>";
      }

      // ajax adding data to database
      $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function (data) {
          //if success close modal and reload ajax table
          $('#modal_form').modal('hide');
          location.reload(); // for reload a page
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('Error adding / update data');
        }
      });
    }

    function delete_book(id) {
      if (confirm('Are you sure delete this data?')) {
        // ajax delete data from database
        $.ajax({
          url: "<?php echo site_url('index.php/book/book_delete')?>/" + id,
          type: "POST",
          dataType: "JSON",
          success: function (data) {

            location.reload();
          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert('Error deleting data');
          }
        });

      }
    }
  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Add Member</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="book_id" />
            <div class="form-body">

              <div class="form-group">
                <label class="control-label col-md-3">Surname</label>
                <div class="col-md-3">
                  <input name="surname" placeholder="Surname" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">Other Names</label>
                <div class="col-md-3">
                  <input name="other_names" placeholder="Other Names" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Gender</label>
                <div class="col-md-3">
                  <input name="gender" placeholder="Gender" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">Department</label>
                <div class="col-md-3">
                  <input name="department" placeholder="Department" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Membership Status</label>
                <div class="col-md-3">
                  <input name="member_status" placeholder="Membership Status" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">Marital Status</label>
                <div class="col-md-3">
                  <input name="marital_status" placeholder="Marital Status" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Address</label>
                <div class="col-md-9">
                  <input name="address" placeholder="Address" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Occupation</label>
                <div class="col-md-9">
                  <input name="occupation" placeholder="Occupation" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Phone Number</label>
                <div class="col-md-3">
                  <input name="phone" placeholder="Phone Number" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">E-Mail</label>
                <div class="col-md-3">
                  <input name="email" placeholder="E-Mail" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">State</label>
                <div class="col-md-3">
                  <input name="state" placeholder="State" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">LGA</label>
                <div class="col-md-3">
                  <input name="lga" placeholder="LGA" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Home Town</label>
                <div class="col-md-9">
                  <input name="home_town" placeholder="Home Town" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Birth Date</label>
                <div class="col-md-3">
                  <input name="bday" placeholder="BirthDay" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">Birth Month</label>
                <div class="col-md-3">
                  <input name="bmonth" placeholder="BirthMonth" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Year Joined</label>
                <div class="col-md-3">
                  <input name="year_joined" placeholder="Year Joined" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">Next Of Kin</label>
                <div class="col-md-3">
                  <input name="nok" placeholder="NextOfKin" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Next Of Kin Phone No.</label>
                <div class="col-md-3">
                  <input name="nok_phone" placeholder="NextOfKinPhone" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">Next of Kin Addr</label>
                <div class="col-md-3">
                  <input name="nok_addr" placeholder="NextOfKinAddr" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Remark</label>
                <div class="col-md-3">
                  <input name="status" placeholder="Remark" class="form-control" type="text">
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

  <!-- Bootstrap modal 2 -->
  <div class="modal fade" id="modal_form_view" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <div class="view-logo">
            <img class="img-thumbnail" width="70px" src="<?php echo base_url('uploads/agc-logo.png')?>" alt="">
          </div>
          <center>
            <h4 class="modal-title">ASSEMBLIES OF GOD CHURCH AGODO</h4>
            <h5>NO 1 BABATUNDE OLUMIDE STREET, AGODO, LAGOS</h5>
            <h5>agcagodo@yahoo.com | +234 903 652 2093</h5>
          </center>
        </div>
        <div class="modal-body form">
          <form action="#" id="form2" class="form-horizontal">
            <input type="hidden" value="" name="book_id" />
            <div class="form-body">

              <div class="form-group">
                <label class="control-label col-md-3">Surname</label>
                <div class="col-md-3">
                  <input name="surname" disabled placeholder="Surname" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">Other Names</label>
                <div class="col-md-3">
                  <input name="other_names" disabled placeholder="Other Names" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Gender</label>
                <div class="col-md-3">
                  <input name="gender" disabled placeholder="Gender" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">Department</label>
                <div class="col-md-3">
                  <input name="department" disabled placeholder="Department" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Membership Status</label>
                <div class="col-md-3">
                  <input name="member_status" disabled placeholder="Membership Status" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">Marital Status</label>
                <div class="col-md-3">
                  <input name="marital_status" disabled placeholder="Marital Status" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Address</label>
                <div class="col-md-9">
                  <input name="address" disabled placeholder="Address" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Occupation</label>
                <div class="col-md-9">
                  <input name="occupation" disabled placeholder="Occupation" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Phone Number</label>
                <div class="col-md-3">
                  <input name="phone" disabled placeholder="Phone Number" class="form-control" type="text">
                </div>

                <label class="control-label col-md-3">E-Mail</label>
                <div class="col-md-3">
                  <input name="email" disabled placeholder="E-Mail" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">State</label>
                <div class="col-md-3">
                  <input name="state" disabled placeholder="State" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">LGA</label>
                <div class="col-md-3">
                  <input name="lga" disabled placeholder="LGA" class="form-control" type="text">

                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-3">Home Town</label>
                <div class="col-md-9">
                  <input name="home_town" disabled placeholder="Home Town" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Birth Date</label>
                <div class="col-md-3">
                  <input name="bday" disabled placeholder="BirthDay" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">Birth Month</label>
                <div class="col-md-3">
                  <input name="bmonth" disabled placeholder="BirthMonth" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Year Joined</label>
                <div class="col-md-3">
                  <input name="year_joined" disabled placeholder="Year Joined" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">Next Of Kin</label>
                <div class="col-md-3">
                  <input name="nok" disabled placeholder="NextOfKin" class="form-control" type="text">

                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Next Of Kin Phone No.</label>
                <div class="col-md-3">
                  <input name="nok_phone" disabled placeholder="NextOfKinPhone" class="form-control" type="text">

                </div>

                <label class="control-label col-md-3">Next of Kin Addr</label>
                <div class="col-md-3">
                  <input name="nok_addr" disabled placeholder="NextOfKinAddr" class="form-control" type="text">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Remark</label>
                <div class="col-md-3">
                  <input name="status" disabled placeholder="Remark" class="form-control" type="text">
                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Print</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal 2 -->
  <center>
    <blockquote class="blockquote">
      <p class="mb-0">Made With Love</p>
      <footer class="blockquote-footer"> <a href="http://twitter.com/favourch">Favour Chukwuedo</a></footer>
    </blockquote>
  </center>

</body>

</html>
