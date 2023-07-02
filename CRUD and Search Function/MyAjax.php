<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CRUD using Ajax</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  </head>
  <body style="background-color:ghostwhite;">
  <div class="modal fade" id="modal_frm" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-circle-info"></i> Enter Your Details...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id='frm'>
      <input type='hidden' name='action' id='action' value='Insert'>
      <input type='hidden' name='id' id='uid' value='0'>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name"><i class="fa-solid fa-user-secret"></i> Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="ex: Ari" required>
    </div>
    <div class="form-group col-md-6">
      <label for="gender"><i class="fa-solid fa-venus-mars"></i> Gender</label>
      <select name='gender' id='gender' required class='form-control'>
          <option value="">Select</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Others">Others</option>
        </select>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="contact"><i class="fa-solid fa-phone"></i> Contact</label>
    <input type='text' name='contact' id='contact' required class='form-control' placeholder="8870057338">
  </div>
  <div class="form-group col-md-6">
      <label for="email"><i class="fa-solid fa-envelope"></i> E-mail</label>
      <input type="email" id="email" name="email" required class='form-control' placeholder="ex: ari19052004@gmail.com">
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="city"><i class="fa-sharp fa-solid fa-location"></i> City</label>
      <input type="text" class="form-control" id="city" name="city" required placeholder="ex: T.Nagar">
    </div>
    <div class="form-group col-md-6">
      <label for="pincode"><i class="fa-sharp fa-solid fa-location-dot"></i> Pin-code</label>
      <input type="text" class="form-control" id="pincode" name="pincode" required placeholder="ex: 600017">
    </div>
  </div>
      <input type='submit' value='Submit' class='btn btn-success'>
    </form>
      </div>
    </div>
  </div>
</div>

  <div class='container mt-5'>
  <nav class="navbar" style="background-color:lightgray;">
  <a href='#' class='btn btn-success' id='add_record'> <i class="fa-solid fa-user-plus"></i></a>
  <form class="form-inline" id="searchForm">
    <div class="input-box">
    <i class="fa-solid fa-user-magnifying-glass"></i>
    <input class="form-control mr-sm-1" type="search" placeholder="Search" aria-label="Search" name="search" id="search">
    </div>
    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="btnSearch" id="btnSearch"><i class="fa-solid fa-search"></i></button>
  </form>
  </nav>



    <!--<div class='form-row text-left'>
    <div class="form-group col-md-6">
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-dark my-2 my-sm-0" type="submit" id="search">Search</button>
    </form>
    </div>
      <p class='text-right'><a href='#' class='btn btn-success' id='add_record'>Add Record</a></p>
    </div>-->
    <table class='table table-bordered'>
    <thead>
      <th>Name</th>
      <th>Gender</th>
      <th>Contact</th>
      <th>E-mail</th>
      <th>City</th>
      <th>Pin-code</th>
      <th>Action</th>
    </thead>
    <tbody id='tbody'>
      <?php 
        $con=mysqli_connect('localhost', 'root', '', 'ajax_crud');
        $sql="select * from myusers";
        $res=$con->query($sql);
        while($row=$res->fetch_assoc()){
          echo "
            <tr uid='{$row["id"]}'>
              <td>{$row["name"]}</td>
              <td>{$row["gender"]}</td>
              <td>{$row["contact"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["city"]}</td>
              <td>{$row["pincode"]}</td>
              <td><a href='#' class='btn btn-primary edit btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>
              <a href='#' class='btn btn-danger delete btn-sm'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
          ";
        }
      ?>
    </tbody>
    </table>
  </div>
    <script>
      $(document).ready(function(){
        var current_row=null;
        $("#add_record").click(function(){
          $("#modal_frm").modal();
        });
        
        $("#frm").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:"MyAjax_action.php",
            type:"post",
            data:$("#frm").serialize(),
            beforeSend:function(){
              $("#frm").find("input[type='submit']").val('Loading...');
            },
            success:function(res){
              if(res){
                if($("#uid").val()=="0"){
                  $("#tbody").append(res);
                }else{
                  $(current_row).html(res);
                }
              }else{
                alert("Failed Try Again");
              }
              $("#frm").find("input[type='submit']").val('Submit');
              clear_input();
              $("#modal_frm").modal('hide');
            }
          });
        });

        $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
          event.preventDefault();
          var search = $('#search').val();
          $.ajax({
            url: 'MyAjax_action.php',
            type: 'POST',
            data: {
              action: 'Search',
              search: search
            },
            success: function(response) {
              $('#tbody').html(response);
            }
          });
        });
      });
        
        $("body").on("click",".edit",function(event){
          event.preventDefault();
          current_row=$(this).closest("tr");
          $("#modal_frm").modal();
          var id=$(this).closest("tr").attr("uid");
          var name=$(this).closest("tr").find("td:eq(0)").text();
          var gender=$(this).closest("tr").find("td:eq(1)").text();
          var contact=$(this).closest("tr").find("td:eq(2)").text();
          var email=$(this).closest("tr").find("td:eq(3)").text();
          var city=$(this).closest("tr").find("td:eq(4)").text();
          var pincode=$(this).closest("tr").find("td:eq(5)").text();
          
          $("#action").val("Update");
          $("#uid").val(id);
          $("#name").val(name);
          $("#gender").val(gender);
          $("#contact").val(contact);
          $("#email").val(email);
          $("#city").val(city);
          $("#pincode").val(pincode);
        });

        /*$("body").on("click", "#Insert", function(event){
          event.preventDefault();
          var newID =updateRowIDs() + 1;
        })*/
        
        $("body").on("click",".delete",function(event){
          event.preventDefault();
          var id=$(this).closest("tr").attr("uid");
          var cls=$(this);
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
            $.ajax({
              url:"MyAjax_action.php",
              type:"post",
              data:{uid:id,action:'Delete'},
              beforeSend:function(){
                $(cls).text("Deleting...");
              },
              success:function(res){
                if(res){
                  $(cls).closest("tr").remove();
                  swal("Poof! Your data has been deleted!", {
                    icon: "success",
              });
            } else {
              swal("Failed. Please Try Again!");
              $(cls).text("Try Again");
            }
          }
        });
          
              
      }else{
        swal("Your data is safe!");    
           }
        });
          
      });
        
        function clear_input(){
          $("#frm").find(".form-control").val("");
          $("#action").val("Insert");
          $("#uid").val("0");
        }
      });
    </script>
  </body>
</html>