<?php include('master_layout/header.php');
  require "connect.php";
 ?>
<!-- sticky header end -->
<div class="container">
  <div class="page-header">
    <?php

    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT Ten FROM theloai WHERE id ='$id'";
      $result = mysqli_query($connect, $sql);
      $row = mysqli_fetch_assoc($result);

    ?>
      <h1><?php echo $row['Ten'] ?></h1>
      <ol class="breadcrumb">
        <li><a href="index.php">Trang chủ</a></li>


        <li class="active"><?php echo $row['Ten'] ?></li>
      </ol>

  </div>

  <div class="row">
    <div class="ind">
    <?php
    }
    $sql = "SELECT * FROM tintuc WHERE theloai_id='$id' ";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $tieude = $row['tieude'];
      $theloai_id = $row['theloai_id'];
      $themanh = $row['themanh'];


    ?>

      <div class="col">
        <li class=bantin>
          <?php echo "<a href='post-item-details.php?id=$id&theloai_id=$theloai_id'><img src='$themanh' width='200px' height='150px' /></a>";
          echo "<a href='post-item-details.php?id=$id&theloai_id=$theloai_id'><h4>$tieude </h4></a>"; ?>
        </li>
      </div>
    <?php } ?>
    </div>

  </div>
</div>

<?php include('master_layout/footer.php') ?>
<style>
  .ind {
    width: 100%;
    float: left;
  }

  .col {
    float: left;
    width: 25%;
    padding: 35px;
  }

  .bantin {
    list-style-type: none;
    float: left;
  }

  h4{
    margin-top: 17px;
  }
</style>