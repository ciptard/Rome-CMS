<h1 id="logo"><?= $name ?></h1>

<div id="content">
	
	<div id="bio"><?= $bio ?></div>
	
	<!--
	<div id="linkLists">
		<ul class="links">
			<li class="twitterLink"><a href="">Twitter</a></li>
			<li class="linkedinLink"><a href="<?= $linkedin_url ?>">LinkedIn</a></li>
			<li class="emailLink"><a href="">Email</a></li>
		</ul>
	</div>
	-->

	<?php if ($tweets && Rome::getContent('enable_twitter')) { $numberOfTweets = Rome::getContent('number_of_tweets_to_display'); ?>
	<div id="tweets">
		<h3 class="tweetsHeader"><span>Recent</span> Tweets</h3>
		<ul class="tweetsList">
			<?php foreach (array_splice($tweets, 0, ($numberOfTweets)? intval($numberOfTweets) : 3) as $tweet) { ?>
			<li rel="<?= $tweet['link'] ?>"><?= $tweet['tweet'] ?></li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>

</div>

<div id="footer">
	<p class="copyright"><?= $copyright ?></p>
</div>
