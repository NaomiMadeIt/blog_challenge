<?php
//connect to database
require('db-config.php');
//use _once on function definitions to prevent duplicates
include_once('functions.php');
//get the doctype and header area
include('header.php');
?>

<main id="content">
	<section>
		<h2>Authors</h2>
		<?php
		//Get the most recent 2 published posts
		$query = "SELECT username, bio
							FROM users
							WHERE is_admin = 1";

		//run the query. catch the returned info in a result object
		$result = $db->query($query);

		//check to see if the result has rows (posts)
		if( $result->num_rows >= 1 ){
			//loop through each row found, displaying the article each time
			while( $row = $result->fetch_assoc() ){
		?>
			<article>
				<h3><?php echo $row['username']; ?></h3>
				<p><span class="thicc">Bio:</span> <?php echo $row['bio']; ?></p>
			</article>


		<?php
			} //end while there are posts
		} //end if there are posts
		else{
			echo 'Sorry, either there has been an error, or suddenly we don\'t have any authors! Gaah!';
		}
		?>
	</section>
</main>


<?php
//get the aside
include('sidebar.php');

//get the footer and close the open body and html tags
include('footer.php');
?>
