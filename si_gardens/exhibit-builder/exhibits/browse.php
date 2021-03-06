<?php 
$tag = (isset($_GET['tag']) ? $_GET['tag'] : null);
$tags = (isset($_GET['tags']) ? $_GET['tags'] : null);
$term = (isset($_GET['term']) ? $_GET['term'] : null);
$query = (isset($_GET['search']) ? $_GET['search'] : null);
$advanced = (isset($_GET['advanced']) ? true : false);
$bodyclass='browse';
$maptype='focusarea';

if ( (isset($tag) || isset($tags)) && !isset($query) ) {
	$title = __('Exhibits tagged "%s"',($tag ? $tag : $tags));
	$bodyclass .=' queryresults';
	$maptype='queryresults';
}
elseif ( isset($term) && !isset($query) ) {
	$title = __('Results for subject term "%s"',$term);
	$bodyclass .=' queryresults';
	$maptype='queryresults';
}
elseif (isset($query)) {
	$title = (!($advanced) ? __('Search Results for "%s"',$query) :__('Advanced Search Results'));
	$bodyclass .=' queryresults';
	$maptype='queryresults';
}	
else{
	$title = __('All Exhibits');
	$bodyclass .=' items stories';
}
echo head(array('maptype'=>'none','title'=>$title,'bodyid'=>'exhibits','bodyclass'=>$bodyclass));
?>


<div id="content">

<section class="browse stories items">	
	<h2><?php 
	$title .= ( ($total_results) ? ': <span class="item-number">'.$total_results.'</span>' : '');
	echo $title; 
	?></h2>
		
		
	<div id="page-col-left">
		<aside>
		<!-- add left sidebar content here -->
		</aside>
	</div>


	<div id="primary" class="browse">
	<section id="results">
			

	<?php if (count($exhibits) > 0): ?>
	
    <div id="exhibits">	
		<?php $exhibitCount = 0; ?>
		<?php foreach (loop('exhibit') as $exhibit): ?>
		    <?php $exhibitCount++; ?>
		    <div class="exhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
				
				<?php if ($exhibitImage = record_image($exhibit, 'fullsize')): ?>
					<?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
            	<?php endif; ?>
				
				<h2><?php echo link_to_exhibit(); ?></h2>
		        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
					<div class="description"><?php echo $exhibitDescription; ?> <p class="read-more"><a href="<?php echo exhibit_builder_exhibit_uri(); ?>">Read More &#8594;</a></p></div>
		        <?php endif; ?>
		        <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
		        	<p class="tags">TAGS: <?php echo $exhibitTags; ?></p>
		        <?php endif; ?>
		    </div>
		<?php endforeach; ?>
    </div>
    
    <div class="pagination"><?php echo pagination_links(); ?></div>

    <?php else: ?>
	<p><?php echo __('There are no exhibits available yet.'); ?></p>
	<?php endif; ?>




				
	</section>	
	</div><!-- end primary -->

	<div id="page-col-right">
	</div>	

</section>
</div> <!-- end content -->

<div id="share-this" class="browse">
<?php echo mh_share_this();?>
</div>

<?php echo foot(); ?>