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
            
            $sql="delete from tech_lib where id=$id";
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
            $category=$conn->real_escape_string($_POST['catId']);
            $book_name=$conn->real_escape_string($_POST['bookName']);
            $status="1";
            $book_addr=upload_image($_FILES);
            if($book_addr!="err")
            {
                $sql="insert into tech_lib(cat_id,book_name,book_addr,status) values('$category','$book_name','$book_addr','$status')";
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
                $errorSubject="Error While Uploading Book";
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
            Library
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
            <div class="box-body" style="background-color: #fff">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Book Name</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        
                            if (isset($lib_books)) 
                            {
                                $i = 1;
                                foreach ($lib_books as $detail) 
                                {    
                                
                     ?> 
                        <tr>
                            <td><?= $i;?></td>
                            <td id="book_name<?=$i?>"><?=$detail['book_name'];?></td>           
                            <td style="  text-align: center; " id="category<?=$i?>"><?=$detail['category'];?></td>
                            <td> 
                                <form method="post">
                                    <button name="confirm" type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-edit" onclick="setEditValues(<?=$detail['id'] ?>,<?=$i?>,<?=$detail['cat_id']?>)"
                                        value="<?=$detail['id'] ?>">
                                        <i class="fa fa-edit">Edit</i>
                                    </button>
                                    <a class="btn btn-primary" href="uploads/<?=$detail['book_addr']?>" target="_blank"><i class="fa fa-eye">View</i></a>
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
             
                <h4 class="modal-title">Add Book</h4>
                <!-- <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div> 
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Category</label><br>
                                <Select id="category" name="catId" class="form-control" required>
                                <?php
                                    if(isset($lib_categories))
                                    {
                                        foreach($lib_categories as $cats)
                                        {
                                ?>
                                    <option value="<?=$cats['id']?>"><?=$cats['category']?></option>
                                <?php
                                        }
                                    }
                                ?>
                                </Select> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Book Name</label><br>
                                <Input type="text" id="book_name" class="form-control" name="bookName" required/>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Book</label><br>
                                <Input id="book_file" type="file" class="form-control" name="images" required/>
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
                
                <h4 class="modal-title">Edit Book Details</h4>
            </div>
            <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Category</label><br>
                                <Select id="ecategory" name="ecatId" class="form-control" required>
                                <?php
                                    if(isset($lib_categories))
                                    {
                                        foreach($lib_categories as $cats)
                                        {
                                ?>
                                    <option value="<?=$cats['id']?>"><?=$cats['category']?></option>
                                <?php
                                        }
                                    }
                                ?>
                                </Select> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Book Name</label><br>
                                <Input type="text" id="ebook_name" class="form-control" name="ebookName" required/>
                                <Input type="hidden" id="eId" class="form-control" name="eId" required/>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Book</label><br>
                                <Input id="book_file" type="file" class="form-control" name="images" />
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
function setEditValues(id, count,cat_id) {
    $("#eId").val(id);
    $("#ecategory").val(cat_id);
     $("#ebook_name").val($("#book_name" + count).html());

}
</script>
</body>

</html>
