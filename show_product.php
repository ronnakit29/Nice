<?php
	$query_product = "SELECT * FROM tbl_product  as p INNER JOIN tbl_type as t 
	ON p.type_id  = t.type_id 
	ORDER BY p.p_id ASC";
	$result_pro =mysqli_query($con, $query_product) or die ("Error in query: $query_product " . mysqli_error());
		 //echo($query_type);
		 //exit()
?>



<div class="row">
	

<?php foreach ($result_pro as $row_pro) { ?>
	<div class="card mt-3" style="width: 18rem;">
  <img class="card-img-top" src="backend/p_img/<?php echo $row_pro['p_img']; ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $row_pro['p_name']; ?></h5>
    <p class="card-text">ประเภท: <?php echo $row_pro['type_name']; ?></p>
    <a href="product_detail.php?id=<?php echo $row_pro['p_id'] ?>" class="btn btn-primary">รายละเอียด</a>
  </div>
</div>
&nbsp;&nbsp;
<?php } ?>

</div>