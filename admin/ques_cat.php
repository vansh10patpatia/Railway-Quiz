<?php

  require_once "header.php";
  require_once "navbar.php";
  require_once "rightnavbar.php";
  require_once "sidebar.php";
  
 
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['add']))
        {
            $category=$conn->real_escape_string($_POST['cat']);
            if($book_addr!="err")
            {
                $sql="insert into ques_cat(category) values('$category')";
                if($conn->query($sql))
                {
                        $resSubject = "true";
                }
                else
                {
                    $errorSubject=$conn->error;
                }
            }  
            else
            {
                $errorSubject="Error While Uploading Category";
            }
        }
        
        if(isset($_POST['edit']))
        {
            
            $category=$conn->real_escape_string($_POST['ecatId']);
            $book_name=$conn->real_escape_string($_POST['ebookName']); 
            $book_addr=upload_image($_FILES);
            $id=$conn->real_escape_string($_POST['eId']);
            if($book_addr!="err")
            {
                $sql="update tech_lib set cat_id='$category',book_name='$book_name',book_addr='$book_addr' where id=$id";
            }else
            {
                $sql="update tech_lib set cat_id='$category',book_name='$book_name' where id=$id";
            }
           
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
        
    $sql="select tl.*,lc.category from tech_lib tl , lib_categories lc where tl.cat_id=lc.id";
    $result =  $conn->query($sql);
    if($result->num_rows)
    {
        while($row = $result->fetch_assoc())
        {
            $lib_books[] = $row;
        }
    } 

    $sql="select * from ques_cat";
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
        <div class="alert alert-success"><strong>Success! </strong> Your request successfully updated. </div>
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
            Questions Category
        </h1>
        
    </section>
    <div class="container-fluid">
        <form method="POST">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Add Category:</p>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" class="form-control newField"  name="cat" placeholder="Category Name" required >
                                </div>
                                <div class="col-lg-1">
                                    <button class="btn btn-outline-primary" name="add" id="add">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" style="background-color: #fff">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Category Name</th>
                                    <!-- <th>No. Of Questions</th> -->
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
                                    <form method="POST">
                                        <td><?= $i;?></td>
                                        <td >
                                            
                                            <input type="text" class="form-control edit" name="category" id="category<?=$detail['id']?>"  value="<?=$detail['category'];?>" disabled>
                                        </td>
                                        <!-- <td style="text-align:center;"></td> -->
                                        <td> 
                                                
                                                <Button type="button" class="btn btn-success"  name="edit" id="edit<?=$detail['id']?>" onclick="makeEditable(<?=$detail['id']?>)"><i class="bi bi-pencil-square"></i></Button>
                                                <button type="button" style="display:none" class="btn btn-outline-warning" name="" onclick="ajax(<?=$detail['id']?>)" id="update<?=$detail['id']?>" value="<?=$detail['id']?>" >Update</button>
                                                &nbsp; 
                                                <Button type="submit" class="btn btn-outline-danger" name="delete" value="<?= $detail['id']?>"><i class="bi bi-trash"></i>Delete</Button>

                                        </td>
                                    </form>
                                </tr>

                                <?php
                                        $i++;        
                                        }
                                    }
                                ?>

                            </tbody>
                        </table>

            </div>
            
                </div>    
            </div>
        </form>
    </div>
    <!-- Main content -->
    <br>
  
    <!-- /.content -->
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

    function makeEditable(db_id)
    {   
        $(".edit").attr("disabled",true);
        $(".btn-success").show();  
        $(".btn-outline-warning").hide();
        $("#category"+db_id).attr("disabled",false)
        //$("#"+editBtn+counter).hide();
        //$("#"+updateBtn+counter).show().attr('name',updateBtnName).html('Update');  
        $("#edit"+db_id).hide();
        $("#update"+db_id).show().attr('name',"change")        
    }

    function ajax(id)
    {
        
        var category = $("#category"+id).val();
        $.ajax(
        {
          url:'cat_ajax.php',
          type:"POST",
          data:{change:id,
                category:category
                     
              },
              success : function(data)
                {
                  if(data.trim()=="updated")
                  {
                    $(".btn-outline-warning").hide();
                    $(".btn-success").show();  
                    $("#category"+id).attr("disabled",true);
                  }

                },
                error:
                function(err){} 

      });

    }

</script>
</body>

</html>
