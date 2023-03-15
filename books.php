<?php include('template/header.php');?>
<?php 
include('admin/config/db.php'); 

//select all books
$sql="SELECT * FROM books";
$query=$conn->prepare($sql);
$query->execute();
$book_list=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($book_list as $book){ ?>
<div class="col-4">
  <div class="card">
    <img src="./img/<?php echo $book['image']; ?>" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title"><?php echo $book['name']; ?></h5>
      <a href="#" class="btn btn-primary">See more</a>
    </div>
  </div>
</div>


<?php } ?>

<?php include('template/footer.php');?>