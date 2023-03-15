<?php include('../template/header.php'); ?>
<?php 
session_start();
//form data
$id=isset($_POST['id'])?$_POST['id']:"";
$name=isset($_POST['name'])?$_POST['name']:"";
$image=isset($_FILES['image']['name'])?$_FILES['image']['name']:"";
$action=isset($_POST['action'])?$_POST['action']:"";

include('../config/db.php');

switch($action){
    case "save":
        $sql="INSERT INTO books (name, image) VALUES (:name, :image);";
        $query=$conn->prepare($sql);
        $query->bindParam(':name',$name);

        //upload image
        $date=new DateTime();
        $image_name=($image!="")?$date->getTimestamp()."_".$_FILES["image"]["name"]:"image.jpg";
        $image_tmp=$_FILES["image"]["tmp_name"];
        if($image_tmp != ""){
            move_uploaded_file($image_tmp,"../../img/".$image_name);
        }

        $query->bindParam(':image',$image_name);
        $query->execute();

        $_SESSION['message'] = 'Book successfully saved';
  	    $_SESSION['message_type'] = 'success';

        header('location:books.php');
        break;

    case "edit":
        $sql="UPDATE books SET name=:name WHERE id = :id;";
        $query=$conn->prepare($sql);
        $query->bindParam(':id',$id);
        $query->bindParam(':name',$name);
        $query->execute();

        if($image != ""){
            //upload new image
            $date=new DateTime();
            $image_name=($image!="")?$date->getTimestamp()."_".$_FILES["image"]["name"]:"image.jpg";
            $image_tmp=$_FILES["image"]["tmp_name"];
            move_uploaded_file($image_tmp,"../../img/".$image_name);

            //delete previous image
            $sql="SELECT image FROM books WHERE id=:id;";
            $query=$conn->prepare($sql);
            $query->bindParam(':id',$id);
            $query->execute();
            $book=$query->fetch(PDO::FETCH_LAZY);

            if(isset($book['image']) && ($book['image'])!="image.jpg"){
                if(file_exists("../../img/".$book['image'])){
                    unlink("../../img/".$book['image']);
                }
            }
            
            //update row on mysql
            $sql="UPDATE books SET image=:image WHERE id = :id;";
            $query=$conn->prepare($sql);
            $query->bindParam(':id',$id);
            $query->bindParam(':image',$image_name);
            $query->execute(); 
        }

        $_SESSION['message'] = 'Book successfully edited';
  	    $_SESSION['message_type'] = 'warning';

        header('location:books.php');
        break;

    case "cancel":
        header('location:books.php');
        break;

    case "delete":
        //delete image
        $sql="SELECT image FROM books WHERE id=:id;";
        $query=$conn->prepare($sql);
        $query->bindParam(':id',$id);
        $query->execute();
        $book=$query->fetch(PDO::FETCH_LAZY);

        if(isset($book['image']) && ($book['image'])!="image.jpg"){
            if(file_exists("../../img/".$book['image'])){
                unlink("../../img/".$book['image']);
            }
        }

        //delete info
        $sql="DELETE FROM books WHERE id=:id;";
        $query=$conn->prepare($sql);
        $query->bindParam(':id',$id);
        $query->execute();

        $_SESSION['message'] = 'Book successfully deleted';
  	    $_SESSION['message_type'] = 'danger';

        header('location:books.php');
        break;

    case "select":
        $sql="SELECT * FROM books WHERE id=:id;";
        $query=$conn->prepare($sql);
        $query->bindParam(':id',$id);
        $query->execute();
        $book=$query->fetch(PDO::FETCH_LAZY);

        $name=$book['name'];
        $image=$book['image'];
        break;

}

//select all books
$sql="SELECT * FROM books";
$query=$conn->prepare($sql);
$query->execute();
$book_list=$query->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="col-md-5">
<div class="card">
        <div class="card-header">
            <h4 class="card-title">Register book</h4>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" >
                <div class = "form-group">
                    <label for="id">ID</label>
                    <input type="text" required readonly class="form-control" id="id" name="id" placeholder="Enter ID Book" value="<?php echo $id;?>">
                </div>
                <br/>
                <div class="form-group">
                    <label for="name">Name book</label>
                    <input type="text" required class="form-control" id="name" autofocus name="name" placeholder="Enter Name book" value="<?php echo $name;?>">
                </div>
                <br/>
                <div class="form-group">
                    <label for="image">Image</label>
                    <br/>
                    <?php if($image!=""){ ?>
                        <img  class="img-thumbnail" src="../../img/<?php echo $image ?>" width="120" alt="<?php echo $image ?>"> 
                    <?php } ?>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Select image">
                </div>
                <br/>
                <!-- <button type="submit" class="btn btn-success">Register</button> -->
                <div class="btn-group" role="group" >
                    <button type="submit" name="action" <?php echo ($action=='select')?'disabled':"" ?> value="save" class="btn btn-success">Save</button>
                    <button type="submit" name="action" <?php echo ($action!='select')?'disabled':"" ?> value="edit" class="btn btn-warning">Edit</button>
                    <button type="submit" name="action" <?php echo ($action!='select')?'disabled':"" ?> value="cancel" class="btn btn-info">Cancel</button>
                </div>
            </form>       
        </div>
</div>
<br/>
<?php if (isset($_SESSION['message'])) { ?>
				<div class="alert alert-<?php echo $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
					<?php echo $_SESSION['message']; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
<?php unset($_SESSION['message']);
	  unset($_SESSION['message_type']); } ?>
</div>

<div class="col-md-7">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($book_list as $book){ ?>
                <tr class="">
                    <td scope="row"> <?php echo $book['id'] ?> </td>
                    <td><?php echo $book['name'] ?></td>
                    <td>
                        <img  class="img-thumbnail" src="../../img/<?php echo $book['image'] ?>" width="120" alt="<?php echo $book['image'] ?>">     
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" id="id" value="<?php echo $book['id']?>">
                            <button type="submit" name="action" value="select" class="btn btn-secondary px-3"><i class="bi bi-pencil-square"></i></button>
                            <button type="submit" name="action" value="delete" class="btn btn-danger px-3"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> 
</div>

<?php include('../template/footer.php'); ?>