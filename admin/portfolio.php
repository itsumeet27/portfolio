<?php 
  include ('includes/header.php');
  include ('../includes/init.php');
?>
<?php
        $dbpath = '';
        if(isset($_GET['add']) || isset($_GET['edit'])){
            $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
            $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
            $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):'');
            $saved_image = '';
            if(isset($_GET['edit'])){
                $edit_id = (int)$_GET['edit'];
                $portfolioResult = $db->query("SELECT * FROM portfolio WHERE id = '$edit_id'");
                $portfolio = mysqli_fetch_assoc($portfolioResult);

                $a = $portfolio['technologies'];
                $technologies = explode(",",$a);

                $dbpath = $saved_image;
                $name = ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):$portfolio['name']);
                $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$portfolio['description']);
                $category = ((isset($_POST['category']) && $_POST['category'] != '')?sanitize($_POST['category']):$portfolio['category']);
            }

            if($_POST){
                // Uploading Portfolio Image
                $imagefilename = $_FILES['image']['name'];
                $imagepath = BASEURL.'img/portfolio';
                $imagedestination = $imagepath . '/' . $imagefilename;
                $imageextension = pathinfo($imagefilename, PATHINFO_EXTENSION);
                $imagefile = $_FILES['image']['tmp_name'];
                $imagesize = $_FILES['image']['size'];

                if (!in_array($imageextension, ['jpg','jpeg','png','gif'])) {
                    echo "You file extension must be jpg, jpeg, png, gif for image files";
                } elseif ($_FILES['image']['size'] > 10000000) { // file shouldn't be larger than 100Megabyte
                    echo "Files are too large!";
                } else {
                    move_uploaded_file($imagefile, $imagedestination);
                }

                if(isset($_GET['add'])){                    

                    $a = $_POST['technologies'];
                    $technologies = implode(',',$a);
                    
                    $insertSql = "INSERT INTO portfolio (name,description,category,image,technologies) VALUES ('$name','$description','$category','$imagefilename','$technologies')";
                }

                if(isset($_GET['edit'])){

                    $b = $_POST['technologies'];
                    $technologies_u = implode(",",$b);

                    $insertSql = "UPDATE portfolio SET name = '$name', description = '$description', category = '$category', image = '$imagefilename', technologies = '$technologies_u' WHERE id = '$edit_id'";
                }

                if($db->query($insertSql)){
                    echo "<script>alert('Data Saved Successfully')</script>";
                }
            }
        }
    ?>

    <style type="text/css">
      .btn-floating{      
        cursor: pointer;
        border-radius: 50%;
        overflow: hidden;
        vertical-align: middle;
        box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
        transition: all .2s ease-in-out;

      }

      .btn-floating{
        width: 60px;
        height: 60px;
        border:none!important;
      }

      .options{
        width: 45px;
          height: 45px;
          border:none!important;
      }

      .remove_file{
        width: 35px;
          height: 35px;
          border:none!important;
      }
    </style>
	<div class="container-fluid" style="margin: 2em 0;">
    <button type="button" class="btn-primary btn-floating options my-2" data-toggle="modal" data-target="#centralModal"><i class="fas fa-plus-circle"></i></button><span class="text-justify ml-3"><?=((isset($_GET['edit']))?'Edit':'Add New');?> Portfolio</span>

    <div class="table-responsive">
      <table class="table table-sm table-striped table-bordered">
        <thead class="elegant-color white-text">
          <th></th>
          <th>Name</th>
          <th>Description</th>
          <th>Category</th>
          <th>Image</th>
          <th>Technologies</th>
        </thead>
        <tbody>
          <?php
            $fetchPortfolio = "SELECT * FROM portfolio ORDER BY name ASC";
            $readPortfolio = $db->query($fetchPortfolio);

            if(mysqli_num_rows($readPortfolio) > 0){
              while($portfolio = mysqli_fetch_assoc($readPortfolio)):
          ?>
          <tr>
            <td>
              <a href="portfolio.php?edit=<?=$portfolio['id'];?>"><i class="fas fa-edit" title="Edit"></i></a>
              <a href="portfolio.php?delete=<?=$portfolio['id'];?>"><i class="fas fa-trash" title="Delete"></i></a>
            </td>
            <td><?=$portfolio['name'];?></td>
            <td><?=$portfolio['description'];?></td>
            <td><?=$portfolio['category'];?></td>
            <td width="125"><img src="../img/portfolio/<?=$portfolio['image'];?>" class="img-fluid img-responsive" style="width: 100%"></td>
            <td><?=$portfolio['technologies'];?></td>
          </tr>
          <?php endwhile; } ?>
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="centralModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form class="" name="portfolio" id="portfolio" action="portfolio.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" enctype="multipart/form-data" style="color: #757575;" action="#!">
            <div class="modal-header">
              <h4 class="modal-title w-100" id="myModalLabel">ADD A PORTFOLIO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <!-- Portfolio Name -->
                  <div class="">
                    <label for="name">Portfolio Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?=((isset($_GET['edit']))?$name:'');?>">
                  </div>

                  <!-- Portfolio Description -->
                  <div class="mt-4">
                    <label for="description">Portfolio Description</label>
                    <textarea id="description" name="description" class="form-control"><?=((isset($_GET['edit']))?$description:'');?></textarea>
                  </div>

                  <!-- Portfolio Category -->
                  <div class="mt-4">
                    <label for="category">Portfolio Category</label>
                    <input type="text" id="category" name="category" class="form-control" value="<?=((isset($_GET['edit']))?$category:'');?>">
                  </div>

                  <!-- Portfolio Image -->
                  <div class="md-form">
                    <input type="file" id="image" name="image" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- Default unchecked -->
                  <label for="technologies">Technologies Used</label>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="html5" name="technologies[]" value="HTML5" 
                        <?php if((isset($_GET['edit'])) && in_array("HTML5",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="html5">HTML5</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="css3" name="technologies[]" value="CSS3" 
                        <?php if((isset($_GET['edit'])) && in_array("CSS3",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="css3">CSS3</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="javascript" name="technologies[]" value="JavaScript" 
                        <?php if((isset($_GET['edit'])) && in_array("JavaScript",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="javascript">JavaScript</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="jQuery" name="technologies[]" value="jQuery" 
                        <?php if((isset($_GET['edit'])) && in_array("jQuery",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="jQuery">jQuery</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="php" name="technologies[]" value="PHP" 
                        <?php if((isset($_GET['edit'])) && in_array("PHP",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="php">PHP</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="mysql" name="technologies[]" value="MySQL" 
                        <?php if((isset($_GET['edit'])) && in_array("MySQL",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="mysql">MySQL</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="bootstrap" name="technologies[]" value="Bootstrap" 
                        <?php if((isset($_GET['edit'])) && in_array("Bootstrap",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="bootstrap">Bootstrap</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="wordpress" name="technologies[]" value="WordPress" 
                        <?php if((isset($_GET['edit'])) && in_array("WordPress",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="wordpress">WordPress</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="photoshop" name="technologies[]" value="Adobe Photoshop" 
                        <?php if((isset($_GET['edit'])) && in_array("Adobe Photoshop",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="photoshop">Adobe Photoshop</label>
                  </div>
                  <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="adobexd" name="technologies[]" value="Adobe XD" 
                        <?php if((isset($_GET['edit'])) && in_array("Adobe XD",$technologies)){
                                echo "checked";
                            }
                        ?>
                    >
                    <label class="custom-control-label" for="adobexd">Adobe XD</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-elegant btn-md" type="submit">Submit</button>
              <button type="button" class="btn btn-danger btn-md" data-dismiss="modal" style="width: 125px!important">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
	</div>

<?php include ('includes/footer.php');?>