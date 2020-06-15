<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="Continuing my childhood hobby that makes my mind calm and acts as a relief for a busy day. Sharing with you'll my drawings. I hope you lke it!">
  <title>My Drawings | Sumeet Sharma - Software Engineer | UI/Frontend Developer | Web Developer</title>
  <link rel="canonical" href="https://itsumeet.com/">
</head>
<?php 
	include ('includes/header.php'); 
	include ('includes/init.php'); 
?>
	<div id="about">
		<div class="section-title p-4 text-center">
			<h1 class="h1-responsive">My Drawings</h1>
			<a href="https://instagram.com/drawingsbysumeet" style="text-transform: lowercase;font-weight: bold">@drawingsbysumeet</a>
			<hr class="section">
		</div>
		<div class="container">
			<div class="row">
				<?php $query = $db->query("SELECT * FROM drawings ORDER BY id DESC");
					if($query->num_rows > 0){
					    while($row = $query->fetch_assoc()){
					        $imageURL = 'admin/uploads/'.$row["file_name"];
				?>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 my-3">
					<div class="card">
						<img src="<?=$imageURL;?>" class="img-responsive img-fluid">
					</div>
				</div>
				<?php }
					}else{ ?>
					    <p class="lead text-danger">No image(s) found...</p>
					<?php } ?>
			</div>
		</div>
	</div>

<?php include ('includes/footer.php'); ?>