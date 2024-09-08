<?php
include_once 'includes/dbconfig.php';

include_once 'includes/member.php';
$member = new MEMBER($DB_con);

include_once 'includes/ad.php';
$ad = new AD($DB_con);

include_once 'includes/category.php';
$category = new CATEGORY($DB_con);

if(!$member->is_loggedin())
{
 //$member->redirect('index.php');
}


?>
<?php include('includes/header.php'); ?>
<body>

  <?php include('includes/menu.php'); ?>
<br>

<div class="container-fluid">
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
        <div class="carousel-inner row w-100 mx-auto" role="listbox">
            <?php
            
            $ads = $ad->find_ad('Paid');
            $i=0;
            foreach($ads as $row)
            {
            	$i++;
            	$image = $ad->find_ad_image($row['id']);
            	
            	if($i==1)
            	print '<div class="carousel-item col-md-3 active">
                <a href="adDetails.php?ad_id='.$row['id'].'"><img  src="'.$image['image'].'" height="250" width="250" alt="slide 1"><br><span>'.$row['description'].'</span></a>
            </div>';
            else
            	print '<div class="carousel-item col-md-3">
                <a href="adDetails.php?ad_id='.$row['id'].'"><img  src="'.$image['image'].'" height="250" width="250" alt="slide 1"><br><span>'.$row['description'].'</span></a>
            </div>';
            
            
            }
            ?>

            
            
            <div class="carousel-item col-md-3">
                <img class="img-fluid mx-auto d-block" src="//placehold.it/600x400?text=8" alt="slide 7">
                dsaf
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <i class="fa fa-chevron-left fa-lg text-muted"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
            <i class="fa fa-chevron-right fa-lg text-muted"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<br>
<form action="index.php" method="post">
<div class="row">
	<div class="col-md-1"></div>
<div class="col-md-10" style="border: 1px solid black; padding: 15px; -moz-box-shadow: rgba(0, 0, 0, 0.6) 10px 10px 15px;
-webkit-box-shadow: rgba(0, 0, 0, 0.6) 10px 10px 15px;
box-shadow: rgba(0, 0, 0, 0.6) 10px 10px 15px, rgba(0, 0, 0, 0.6) -10px 10px 15px;">
	<div class="row">
		<div class="col-md-2"><label>Description</label></div>
		<div class="col-md-3"><input type="text" class="form-control" name="description"></div>
		<div class="col-md-2"><input type="submit" name="btnSubmit" value="Filter" class="btn btn-primary" ></div>
	</div>
</div>
</div><br>			
</form>


<div class="col-md-12">
	<?php 
		$cagegories = $category->get_all_categories();
		print "<div class='row'>";
		foreach($cagegories as $row){
			
			if(isset($_POST['description']))
				$ads = $ad->search_ad_by_category($row['id'],'Free', $_POST['description']);
			else
				$ads = $ad->find_ad_by_category($row['id'],'Free');
			if(count($ads)>0){
				print "<div class='col-md-2'>";
				print '<h3>'.$row['category_name'].'</h3>';
				foreach($ads as $row2)
				{
					$ad_id	=	$row2['id'];
					print "<a href='adDetails.php?ad_id=$ad_id'>".$row2['description']."</a><br>";
				}
				print "</div>";
			}
			
			
		}
		print '</div>';
	?>
</div>
<script type="text/javascript">
	$('#carouselExample').on('slide.bs.carousel', function (e) {

    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
    
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});

</script>
</body>
</html>
