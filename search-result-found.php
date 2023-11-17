<?php include('master_layout/header.php') ?>
<?php
      require "connect.php";
?> 

<?php
  if(isset($_REQUEST['p']) && (int)$_REQUEST['p'] >= 1) {
    $page = (int) $_REQUEST['p'];
  }
  if(isset($_GET['txtsearch'])){
    $search = $_GET['txtsearch'];
  } else {
    header('Location: index.php');
  }

  $sql = "SELECT * FROM tintuc WHERE tieude LIKE '%$search%' OR  noidung LIKE '%$search%'";
  $query = mysqli_query($connect ,$sql);
?>
  <div class="container"> 
    
    <!-- bage header start -->
    <div class="page-header">
      <h1>Kết quả tìm kiếm </h1>
      <ol class="breadcrumb">
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Tìm kiếm</a></li>
        <li class="active">Kết quả tìm kiếm</li>
      </ol>
    </div>
    <div class="news">
      <ul>
    <?php while($row=mysqli_fetch_array($query)): ?>
        <li>
            <div class="news_item">
              <a class="news_item_avatar" tieude="<?php echo $row['tieude']; ?>" href=<?php echo "post-item-details.php?id=". $row['id'] . "&theloai_id=" .$row['theloai_id']; ?>>

                <div class="news_item_img">
                  <img alt="<?php echo $row['tieude']; ?>" src="<?php echo $row['themanh'] ?>" class="rounded" width="250">
                </div>
              </a>
              <div class="news_item_noidung">
                <h3 class="news_item_tieude">
                  <a>
                    <?php echo $row['tieude']; ?>
                  </a>
                </h3>

                <p class="news_item_sapo" tieude="<?php echo $row['tieude']; ?>" href="">
                (TIN TỨC) - <?php echo $row['noidung']; ?>
                </p>
              </div>
          </div>
        </li>
  <?php endwhile;?>  
      </ul>
  
    
    </div>
    <!-- bage header end --> 
  </div>
  

  <!-- data start -->
  
 
  <?php  include('master_layout/footer.php') ?>
<style>
  
.btn {
    outline: none;
    display: inline-block;
    margin-bottom: 0;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 8px 12px;
    font-size: 13px;
    line-height: 1.3846154;
    border-radius: 4px;
    background-color: #e2e8f2;
    border-color: #e2e8f2;
    padding: 12px 20px;
    font-size: 17px;
    line-height: 23px;
  }


ul li{
  list-style-type: none;
}

a{
  text-decoration: none;
}

p{
  overflow: hidden;
  text-overflow: ellipsis;
  -webkit-line-clamp: 2;
  display: -webkit-box;
  max-height: 3.2rem;
  -webkit-box-orient: vertical;
  max-height: 3.2rem;
  white-space: normal;
  line-height: 1.6rem;
}

.news_item{
  display: flex;
  padding-top: 25px;
}

.news_item_content{
  margin: 0px 20px;
}

</style>