<?php
//make keywords stay visable while searching
if( $_GET['did_send']){
	$keywords = $_GET['keywords'];
}
?>
<aside id="sidebar">
	<nav>
		<ul>
			<li><a href="admin/">Admin Panel</a></li>
			<li><a href="register.php">Sign up</a></li>
		</ul>
	</nav>
	<section>
		<form class="searchform" action="search.php" method="get">
			<label for="the_keywords">Search:</label>
			<input type="search" name="keywords" id="the_keywords" value="<?php echo $keywords; ?>">
			<input type="submit" value="Go" class="search-button">
		</form>
	</section>
	<section>
		<nav>
			<h2>Navigation</h2>
			<ul>
				<li><a href="blog.php">Blog</a></li>
				<li><a href="links.php">Links</a></li>
				<li><a href="authors.php">Authors</a></li>
			</ul>
		</nav>
	</section>
	<section>
		<h2>Recent Posts</h2>
		<?php
		//get the 5 latest published post titles
		//TODO: make this show the posts that have 0 comments
		$query = "SELECT posts.title, posts.post_id
					FROM posts
					WHERE posts.is_published = 1
					ORDER BY posts.date DESC
					LIMIT 5";
		//run it
		$result = $db->query($query);
		//check it
		if( $result->num_rows >= 1 ){
		?>
		<ul>
			<?php
			//loop it
			while( $row = $result->fetch_assoc() ){ ?>
			<li><a href="single.php?post_id=<?php echo $row['post_id'] ?>">
				<?php echo $row['title']; ?>
				</a>
				- <?php count_comments( $row['post_id'] ); ?>
			</li>
			<?php } //end while ?>
		</ul>
		<?php
		} //end if there are posts
		else{
			echo 'No posts to show.';
		}
		?>
	</section>

	<section>
		<h2>Categories</h2>
		<?php //get all category names in alphabetical order
		$query = "SELECT cats.name, cats.category_id, COUNT(*) AS total
					FROM categories AS cats, posts
					WHERE cats.category_id = posts.category_id
					AND posts.is_published = 1
					GROUP BY posts.category_id
					ORDER BY cats.name ASC
					LIMIT 5";
		// echo $query;
		$result = $db->query($query);
		if($result->num_rows >= 1){
		?>
		<ul>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li><a href="category.php?category_id=<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></a> (<?php echo $row['total']; ?>)</li>
			<?php } //end while
			//free it after a select
			$result->free();
			?>
		</ul>
		<?php } ?>
	</section>

	<section>
		<h2>Links</h2>
		<?php //get all links alphabetical by title
		$query = "SELECT title, url
					FROM links
					ORDER BY title ASC";
		$result = $db->query($query);
		if( $result->num_rows >= 1 ){
		?>
		<ul>
			<?php while( $row = $result->fetch_assoc() ){ ?>
			<li>
				<a href="<?php echo $row['url'] ?>" target="_blank">
					<?php echo $row['title'] ?>
				</a>
			</li>
			<?php }
			//free it after a select
			$result->free();
			?>
		</ul>
		<?php }
		else{
			echo 'No links to show';
		} ?>
	</section>
</aside>
