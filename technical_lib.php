<?php

require_once "header.php";
require_once "nav_front.php";
require_once "rightnavbar.php";
require_once "instruction_sidebar.php";

$sql = "SELECT * from lib_categories order by sort_order";
if ($result = $conn->query($sql)) {
    if ($result->num_rows) {
        while ($row = $result->fetch_assoc()) {
            $cat_id = $row['id'];
            $tech_lib_data[$cat_id] = $row;
            $sql = "Select * from tech_lib where cat_id =$cat_id";
            if ($res = $conn->query($sql)) {
                if ($res->num_rows) {
                    while ($innerRow = $res->fetch_assoc()) {
                        $tech_lib_data[$cat_id]["books"][] = $innerRow;
                    }
                }
            }
        }

        //   print_r($tech_lib_data);
        $books_json = json_encode($tech_lib_data);
        
    }
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Alert -->
            <div class="row mb-2">
                <div class="col-sm-12">

                </div>
            </div>
        </div>

    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Question  -->
                    <div class="card">
                        <div class="card-header" STYLE="background: linear-gradient(to left, #808080 0%, #ffccff 100%);">
                            <div class="d-flex justify-content-between">
                                <span class="text text-lg" id="quesNo"><i class="bi bi-book"></i>&nbsp;Technical Library</span>

                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($tech_lib_data)) {
                                foreach ($tech_lib_data as $tech_lib) {
                            ?>
                                    <div class="card collapsed-card" id="add_ques">
                                        <div class="card-header" height="10">
                                            <h5 class="card-title" style="display:flex;flex:1;flex-direction:row;width:97%">
                                                <p style="display:flex;flex:0.6;flex-direction:row;">
                                                    <?= ucfirst($tech_lib['category']) ?>
                                                </p>
                                                <div class="input-group input-group-sm" style="display:flex;flex:0.3;flex-direction:row;margin-right:20px">
                                                    <input class="form-control form-control-navbar catSearch" type="search" placeholder="Search" aria-label="Search"/> 
                                                    <input type="hidden" value="<?=$tech_lib['id']?>"/>
                                                </div>
                                            </h5>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button> -->
                                            </div>
                                        </div>


                                        <div class="card-body" id="cat_body<?=$tech_lib['id']?>">

                                            <?php
                                                $i=1;
                                            foreach ($tech_lib['books'] as $books)
                                            {
                                            ?>
                                                <ul class="todo-list" data-widget="todo-list">
                                                    <li><a href="./admin/uploads/<?= $books['book_addr'] ?>" target="_blank"> <?=$i?>. <?= ucfirst($books['book_name']) ?></a></li>
                                                </ul>
                                            <?php
                                                $i++;
                                            }
                                            ?>

                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> 
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<?php
require_once "footer.php";

?>


</body>
<?php
require_once 'js-links.php';

?>

<script>

var lib_books_data = JSON.parse('<?=$books_json?>'); 
var cat_bodys = [];
var searched_cat_id = null;

$(function(){
    $(".catSearch").on("input",function(e)
    {
        var cat_id = $(this).next().val();
        var toSearch = $(this).val();

        if(searched_cat_id != cat_id && !cat_bodys[cat_id])
        { 
            cat_bodys[cat_id] = $("#cat_body"+cat_id).html();
            searched_cat_id = cat_id; 
        }
        var search_result = lib_books_data[cat_id].books.filter(function(item)
        {
            return item.book_name.toLowerCase().includes(toSearch.toLowerCase())
        })  
        var inhtml =`<ul class="todo-list" data-widget="todo-list">`;
        var i =1;
        $.each(search_result,function(key,value)
        {
            inhtml += `<li><a href="./admin/uploads/${value.book_addr}" target="_blank"> ${i} . ${value.book_name}</a></li>`;
            i++;
        });
        inhtml += `</ul>`;
        $("#cat_body"+cat_id).html(inhtml)
        
        if(toSearch=='' && cat_bodys[cat_id])
        { 
            $("#cat_body"+cat_id).html(cat_bodys[cat_id])
        } 
    });
});
</script>