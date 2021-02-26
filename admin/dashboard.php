<?php
require_once "header.php";
require_once "navbar.php";
require_once "rightnavbar.php";
require_once "sidebar.php";
 

    $sql="SELECT count(id) as count from lib_categories";
    if($result=$conn->query($sql))
    {
        if($result->num_rows>0)
        {
            $row=$result->fetch_assoc();
                $categoryCount=$row['count'];
        }
 
    }
    $sql="SELECT count(id) as count from response";
    if($result=$conn->query($sql))
    {
        if($result->num_rows>0)
        {
            $row=$result->fetch_assoc();
                $userCount=$row['count'];
        }
 
    }
    
    
    $sql="SELECT count(id) as count from questions";
    if($result=$conn->query($sql))
    {
        if($result->num_rows>0)
        {
            $row=$result->fetch_assoc();
                $qCount=$row['count'];
        }
 
    }
    $sql="SELECT count(id) as count from tech_lib";
    if($result=$conn->query($sql))
    {
        if($result->num_rows>0)
        {
            $row=$result->fetch_assoc();
                $bookCount=$row['count'];
        }
 
    }
    $sql="SELECT b.*, c.category from tech_lib b, lib_categories c where b.cat_id = c.id order by b.time_stamp desc limit 5";
    if($result=$conn->query($sql))
    {
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {    
                $books[]=$row;
            }
        }
 
    }
    $sql="SELECT * from questions limit 10";
    if($result=$conn->query($sql))
    {
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {    
                $questions[]=$row;
            }
        }
    }
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=$bookCount?></h3>

                        <p>Books</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <a href="users" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?=$qCount;?></h3>

                        <p>Questions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <a href="instant_query?token=1" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?=$categoryCount?></h3>

                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-bars"></i>
                    </div>
                    <a href="pg_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?=$userCount?></h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="subjectList" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <!-- ./col -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-transparent" style="background-color: #343a40;">
                        <h3 class="card-title" style="color: white;">Latest Books</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0" style="border-spacing: 2px;  font-size: 16px;">
                                <thead style="font-weight: 800; background-color: #6c757d; color: white;">
                                    <tr>
                                        <th style="text-align: center;">S.no.</th>
                                        <th style="text-align: center;">Book</th>
                                        <th style="text-align: center;">Category</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <?php
                                        if(isset($books))
                                        {
                                            $i=1;
                                            foreach($books as $data)
                                            {
                                    ?>
                                                <tr>
                                                    <td style="padding: 12px; color: #17a2b8;"><?=$i?></td>
                                                    <td style="padding: 12px;"><?=$data['book_name']?></td>
                                                    <td style="padding: 12px;"><?=$data['category']?></td> 
                                                </tr>
                                    <?php
                                                $i++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="lib_books" class="btn btn-sm btn-info float-right">View All Books</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-transparent" style="background-color: #343a40;">
                        <h3 class="card-title" style="color: white;">Quiz Questions</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0" style="border-spacing: 2px;  font-size: 16px;">
                                <thead style="font-weight: 800; background-color: #6c757d; color: white;">
                                    <tr>
                                        <th style="text-align: center;">S.no.</th>
                                        <th style="text-align: center;">Question</th>
                                        <th style="text-align: center;">Correct Answer</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    <?php
                                        if(isset($questions))
                                        {
                                            $i=1;
                                            foreach($questions as $data)
                                            {
                                    ?>
                                                <tr>
                                                    <td style="padding: 12px; color: #17a2b8;"><?=$i?></td>
                                                    <td style="padding: 12px;"><?=$data['ques']?></td>
                                                    <?php
                                                    if($data['correct_opt']=='A')
                                                    {
                                                    ?>
                                                        <td style="padding: 12px;"><span class="badge badge-success"><?=$data['opt1']?></span></td> 
                                                    <?php
                                                    }
                                                    else if($data['correct_opt']=='B')
                                                    {
                                                    ?>
                                                        <td style="padding: 12px;"><span class="badge badge-success"><?=$data['opt2']?></span></td> 
                                                    <?php
                                                    }
                                                    else if($data['correct_opt']=='C')
                                                    {
                                                    ?>
                                                        <td style="padding: 12px;"><span class="badge badge-success"><?=$data['opt3']?></span></td> 
                                                    <?php
                                                    }
                                                    else if($data['correct_opt']=='D')
                                                    {
                                                    ?>
                                                        <td style="padding: 12px;"><span class="badge badge-success"><?=$data['opt4']?></span></td> 
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                    <?php
                                                $i++;
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="quiz" class="btn btn-sm btn-info float-right">View All Questions</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="control-sidebar-bg"></div>

<?php
    require_once "footer.php";
    require_once "script_link.php"
 ?>
<!-- ChartJS -->
<script src="plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot-old/jquery.flot.resize.min.js"></script>
