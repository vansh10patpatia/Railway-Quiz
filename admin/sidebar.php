<?php 

$sql = "SELECT * from ques_cat";
if($result = $conn->query($sql))
{
  while($row = $result->fetch_assoc())
  {
      $categories[]=$row; 
  }       
}
else
{
  echo "error : ".$conn->error;
}
?>


<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="quiz.php" class="brand-link">
      <img src="dist/img/1.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Cyber Flow</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin Panel</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="./quiz" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quiz
              </p>
            </a>
          </li> -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Quiz Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./ques_cat.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <?php
                if(isset($categories))
                {
                  foreach($categories as $caty)
                  {
                    ?>
                    
                        <li class="nav-item">
                          <a href="./quiz.php?token=<?=$caty['category']?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p><?=ucfirst($caty['category'])?></p>
                          </a>
                        </li> 
                    <?php
                  }
                }
              ?>
              <li class="nav-item">
                <a href="./quiz.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Questions</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Library Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./add_category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./lib_books.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Books</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item">
            <a href="./logout" class="nav-link">
              <i class="fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>