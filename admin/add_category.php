<?php

  require_once "header.php";
  require_once "navbar.php";
  require_once "rightnavbar.php";
  require_once "sidebar.php";
  
 
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['delete']))
        {
            $id=$conn->real_escape_string($_POST['delete']);
            
            $sql="delete from lib_categories where id=$id";
            if($conn->query($sql))
            {
                $resSubject=true;   
            }
            else
            {
                $errorSubject=$conn->error;
            }
        }
        
        if(isset($_POST['add']))
        {
            $category=$conn->real_escape_string($_POST['catName']);
            
            $sql="insert into lib_categories(category) values('$category')";
            if($conn->query($sql))
            {
                    $resSubject = "true";
            }
            else
            {
                $errorSubject=$conn->error;
            }
        }
        
        if(isset($_POST['edit']))
        {
            $category=$conn->real_escape_string($_POST['ecatName']);
            $id=$conn->real_escape_string($_POST['ecatid']);
            
            $sql="update lib_categories set category='$category' where id=$id";
            if($conn->query($sql))
            {
                    $resSubject = "true";
            }
            else
            {
                $errorSubject=$conn->error;
            }
        }
    }
        
    $sql="select * from lib_categories";
    $result =  $conn->query($sql);
    if($result->num_rows)
    {
        while($row = $result->fetch_assoc())
        {
            $lib_categories[] = $row;
        }
    } 


?>


 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
            if(isset($resSubject))
            {
        ?>
        <div class="alert alert-success"><strong>Success! </strong> your request successfully updated. </div>
        <?php
            }
            else if(isset($errorSubject))
            {
        ?>
        <div class="alert alert-danger"><strong>Error! </strong><?=$errorSubject?></div>
        <?php
                
            }
        ?>
    <section class="content-header">
        <h1>
            Library  Categories
        </h1>
        <ol class="breadcrumb" style="float:right;margin:20px">
            <li>
                <div class="pull-right" >
                    <button title="" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i
                            class="fa fa-plus"></i></button>
                    <a href="" data-toggle="tooltip" title="" class="btn btn-default" data-original-title="Rebuild"><i
                            class="fa fa-sync-alt"></i></a>
                </div>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <br>
    <section class="content">
        

        <div class="box">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th style="width:70%"> Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        
                            if (isset($lib_categories)) 
                            {
                                $i = 1;
                                foreach ($lib_categories as $detail) 
                                {    
                                
                     ?>

                        <tr>
                            <td><?= $i;?></td>
                            <td style="  text-align: center; " id="category<?=$i?>"><?=$detail['category'];?></td>
                            <td>

                                <form method="post">
                                    <button name="confirm" type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-edit" onclick="setEditValues(<?=$detail['id'] ?>,<?=$i?>)"
                                        value="<?=$detail['id'] ?>">
                                        <i class="fa fa-edit">Edit</i>
                                    </button>
                                    <button class="btn btn-danger" type="submit" name="delete"
                                        value="<?=$detail['id']?>">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>

                                </form>
                            </td>
                        </tr>

                        <?php
                                $i++;
                                    
                                            
                                }
                            }
                         ?>

                    </tbody>
                </table>

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
             
                <h4 class="modal-title">Add Category</h4>
                <!-- <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div> 
            <form method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category Name</label><br>
                                <input type="text" id="catName" name="catName" class="form-control">
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="add" class="btn btn-primary" value="">Add</button>
                </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Edit Category</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category Name</label><br>
                                <input type="text" id="ecatName" name="ecatName" class="form-control">
                                <input type="hidden" id="ecatid" name="ecatid" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-primary" value="">Edit</button>
                </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

 <?php
    require_once "footer.php";
    require_once "script_link.php"
 ?>

<script>
function setEditValues(id, count) {
    $("#ecatid").val(id);
    $("#ecatName").val($("#category" + count).html());

}
</script>
</body>

</html>
