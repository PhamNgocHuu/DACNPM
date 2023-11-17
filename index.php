<?php
include ("master_layout/header.php");
include "connect.php" ?>
<div class="container blogging-style">
  <div class="page-header">

    <h1>Trang chủ</h1>
    
  </div>

  

  <div class="row">
    <div class="ind">
      <?php
      $sql = "SELECT * FROM tintuc ORDER BY id ASC";
      $result = mysqli_query($connect, $sql);

      while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $tieude = $row['tieude'];
        $theloai_id = $row['theloai_id'];
        $themanh = $row['themanh'];
       


      ?>
        <div class="col">
          <li class=bantin>
            <?php echo "<a href='post-item-details.php?id=$id&theloai_id=$theloai_id'><img src='$themanh' width='350px' height='230px' /></a>";
            echo "<a href='post-item-details.php?id=$id&theloai_id=$theloai_id'><h4>$tieude</h4></a>";
            ?>
          </li>
        </div>
      <?php } ?>

    </div>
  </div>

  <!-- calendar start -->
  <div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="50">
    <div class="single pull-left"></div>
  </div>
  <!-- calendar end -->

</div>



<?php include("master_layout/footer.php") ?>

<style>
  .ind {
    width: 120%;
  }

  .col {
    float: left;
    width: 30%;
    padding: 20px;
  }

  .bantin {
    list-style-type: none;
  }

  .advertisements {
    float: right;
    width: 25%;
  }

  h4{
    margin-top: 17px;
  }
  
</style>