<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="Experienced in the Web Technologies and hands on in Designing, you can go through the portfolio of my websites and designs. The websites have been developed using WordPress and languages such as HTML, CSS3, Bootstrap, PHP and MySQL">
  <title>Portfolio | Sumeet Sharma - Software Engineer | UI/Frontend Developer | Web Developer</title>
  <link rel="canonical" href="https://itsumeet.com/">
</head>
<?php 
  include ('includes/header.php'); 
  include ('includes/init.php');
?>
<!--Section: Portfolio-->
<div class="container-fluid animated fadeIn slow">
	<!--Section: Main features & Quick Start-->
	<section class="portfolio" id="portfolio">
		<div class="section-title p-4 text-center">
			<h1 class="h1-responsive">Portfolio</h1>
			<hr class="section">
		</div>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="<?=$category;?>" role="tabpanel" aria-labelledby="<?=$category;?>-tab">
        <div class="">
          <div class="row pt-1">            
            <?php
              $sql = "SELECT * FROM portfolio";
              $result = $db->query($sql);
              if(mysqli_num_rows($result) > 0){
                      while($portfolio = mysqli_fetch_assoc($result)):
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-3 animated fadeIn">
              <!-- Card -->
              <div class="card card-image" style="height: 100%">
                <!-- Content -->
                <img src="img/portfolio/<?=$portfolio['image'];?>"
                style="width: 100%" />
                <div class="card-overlay p-4">
                  <h3 class="card-title pt-2"><strong><?=$portfolio['name'];?></strong></h3>
                  <p class="text-justify"><?=$portfolio['description'];?></p>
                  <?php if($portfolio['url'] != ''): ?>
                  <a class="btn btn-black" href="<?=$portfolio['url'];?>"><i class="fas fa-clone left"></i>View project</a>
                  <?php endif; ?>
                </div>
              </div>
              <!-- Card -->
            </div>

            <?php endwhile; } ?>
          </div>
        </div>
      </div>
    </div>
    </section>
  </div>
  <?php include ('includes/footer.php'); ?>