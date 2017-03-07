<?php
//connect to database
require('db-config.php');
//use _once on function definitions to prevent duplicates
include_once('functions.php');
//get the doctype and header area
include('header.php');
?>

<main id="content">
	<h2>Links!</h2>
	<div class="losbox">
		<img src="images/los_links.jpg" />
		<p class="loscaptions">"LOS LIIIINKSSSS!!!"</p>
	</div>
	<?php
	//Get the most recent 2 published posts
	$query = "SELECT title, url, description
				FROM links
				ORDER BY title ASC";
	//run the query. catch the returned info in a result object
	$result = $db->query($query);

	//check to see if the result has rows (posts)
	if( $result->num_rows >= 1 ){
	?>
		<article>
			<ul class="loslinks">
				<?php //loop through each row found, displaying the article each time
				while( $row = $result->fetch_assoc() ){ ?>
				<li><h4><a href="<?php echo $row['url']; ?>"><?php echo $row['title']; ?></a></h4> - <?php echo $row['description']; ?></li>
				<?php } //end while there are links ?>
			</ul>
		</article>


	<?php
	} //end if there are links
	else{
		echo 'Perdon, no tenemos los links.';
	}
	?>

</main>


<?php
//get the aside
include('sidebar.php');

//get the footer and close the open body and html tags
include('footer.php');
?>
