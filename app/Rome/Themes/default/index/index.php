<h1><?= $name ?></h1>
<div><b><?= $tagline ?></b></div>
<div><?= $bio ?></div>
<div>
	<?php if ($tweets) { ?>
	<p><strong>Recent Tweets</strong></p>
	<ul>
		<?php foreach(array_slice($tweets, 0, $number_of_tweets) as $tweet) { arg?>
		<li><?= $tweet['tweet'] ?></li>
		<?php } ?>
	</ul>
	<?php } ?>
</div>
<div><p><?= $copyright ?></p></div>