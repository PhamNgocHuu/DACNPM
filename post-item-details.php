<?php  
    include('master_layout/header.php');
    include('connect.php');
?>
<?php
    if(isset($_POST['noidung']) && isset($_POST['submit'])) {
      $content=$_POST['noidung'];
      if(isset($_SESSION['taikhoan'])) {
       $id=$_GET['id'];
       $taikhoan_id=$_SESSION['taikhoan']['id'];
       $query = "INSERT binhluan(taikhoan, id, noidung) VALUES('$taikhoan', '$id', '$noidung')"; 

        $result = mysqli_query($connect, $query);
      }
    }
       
    
?>

<?php
if(isset($_GET['id']) && isset($_GET['theloai_id'])){
  $id=$_GET['id'];
  $theloai_id=$_GET['theloai_id'];
  $sql = "SELECT * FROM tintuc WHERE id='$id'"; 
  $query = mysqli_query($connect, $sql); 
  $rn = $query->fetch_array(MYSQLI_ASSOC); 
  if(mysqli_num_rows($query)  == 0) {
    header('Location: index.php');
  }

  $sql = "SELECT * FROM tintuc WHERE theloai_id='$theloai_id' AND id <> '$id'  ORDER BY id DESC LIMIT 5";
  $query_post = mysqli_query($connect, $sql);

  $sql_binhluan = "SELECT c.noidung, c.id, c.taikhoan FROM `binhluan` as C join `taikhoan` as A on c.id = a.id where c.id = '$id'";
  $query_binhluan = mysqli_query($connect, $sql_binhluan);
} else {
  header('Location: index.php');
}


?>

<?php  
    while($row = mysqli_fetch_array($query_post)){ 
      $id = $row['id'];
      $tieude = $row['tieude']; 
    }
?>

  <?php
;
  ?>
  <div class="container">
    <div class="page-header">
      <h1><?php echo $rn['tieude']?></h1>
    </div>
    
    
    <div id="news">
      <div id="news_image">
         <img alt="<?php echo $rn['tieude']; ?>" src="<?php echo $rn['themanh'] ?>" class="rounded" width="670">
      </div> 
      <div id="news_content">
        <p><?php echo $rn['noidung']; ?></p>
      </div>
      <div id="news_more">
        <h4><?php echo "<a>||</a>Tin tiếp theo"; ?></h4></br>
      <ul>
      <li><?php echo"<a href='post-item-details.php?theloai_id=$theloai_id&id=$id'>$tieude</a>"?></li>
      </ul>
    </div>  
    <div class="well">
      <h4>Viết bình luận...</h4></br>
      <form action="" method="POST" role="form">
            <div class="form-group">
                 <textarea class="form-control" name="noidung" rows="5"></textarea>
            </div>
            <?php if(isset($_SESSION['account'])):?>
            <button type="submit" name="submit" value="Submit" class="btn btn-primary">Gửi</button>
            <?php endif; ?>
      </form>
    </div>
    <div class="news_comments">
      <h4>Bình luận</h4><br>
      <table>
      <?php while($row=mysqli_fetch_array($query_binhluan)): ?>
                <tr>
                  <p><b><?php echo $row['id']; ?>: </b><?php echo $row['noidung']; ?></p>
                </tr>
    <?php endwhile;?>
      </table>
    </div>
  </div> 
  
  
  <!-- bage header End --> 

  <!-- Footer Start -->
  <?php
  
  include('master_layout/footer.php') 
?>
<style>
  #news{
    width: 670px;
    margin-left: 150px;
  }
  
  p{
    width: 670px;
    margin-top: 30px;
    color: #222;
    letter-spacing: 1px;
    font-size: 13px;
    font-family: Arial,sans-serif;
  }

  #news_more{
    margin-top: 110px;
    margin-bottom: 25px;
  }

  a{
    color: #06c;
  }

  .well{
    margin-top: 75px;
    margin-bottom: 50px;
  }
    
</style>
