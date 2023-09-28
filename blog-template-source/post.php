<?php include 'inc/header.php'; ?>

<?php 
	$db= new Database();
	$fm= new format();
?>
<?php 
        if (isset($_GET['id']) &&  is_numeric($_GET['id'])){
            $id=intval($_GET['id']);
        }
        else{
           
            header("location:404.php");
        }
    ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "select * from tbl_post where id = $id;";
					$post=$db->select($query);
					if($post){
						while($result = $post->fetch_assoc()){
				?>
	
				
				<h2><?php echo  $result['title']; ?></h2>
				<h4><?php echo $fm->formatdate($result['date']); ?><a href="#"><?php echo $result['author']; ?></a></h4>
				<img src="admin/image/<?php echo $result['image']; ?>" alt="post image"/>

				<?php echo  $result['body']; ?>

				<?php }

				?>
				

				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
					$catid= $result['cat'];
					$queryrelated = "select * from tbl_post where cat = $catid limit 6";
					$relatedpost=$db->select($queryrelated);
					if($relatedpost){
						while ($relatedresult = $relatedpost->fetch_assoc()){
				?>	
					<a href="post.php?id=<?php echo $relatedresult['id']; ?>">
					<img src="admin/images/post1.jpg" alt="post image"/></a>
				<?php } }else{
					echo"NO Related Post";
				} ?>	
				</div>
				<?php }  else { header("location:404.php"); } ?>

	</div>

		</div>
		<?php include 'inc/sidebar.php'; ?>
		<?php include 'inc/footer.php'; ?>
	