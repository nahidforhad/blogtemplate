
<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<?php 
	$db= new Database();
	$fm= new format();
?>

	<?php 
        if (isset($_GET['catagory']) &&  is_numeric($_GET['catagory'])){
            $id=intval($_GET['catagory']);
        }
        else{
           
            header("location:404.php");
        }
    ?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <?php
				$query ="select * from tbl_post where cat=$id"; 
				$post=$db->select($query);
				if($post){
					while($result = $post->fetch_assoc()){
			?>


        <div class="samepost clear">
				<h2><a href="post.php ?id= <?php echo $result['id']; ?>"><?php echo  $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatdate($result['date']); ?><a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="#"><img src="admin/image/<?php echo $result['image']; ?>" alt="post image"/></a>
				 <?php echo $fm->shorttext($result['body'], 300); ?>
				<div class="readmore clear">
						<a herf="post.php ?id= <?php echo $result['id']; ?>">Read More</a>
			</div>
            </div>
            <?php } } else { header ("location:404.php"); } ?>
        
	</div>
<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>