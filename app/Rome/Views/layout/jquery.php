<?php if ($environment === 'production') { ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<?php } else { ?>
<script type="text/javascript" src="/app/Roam/Frontend/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/rome.js"></script>
<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/jquery-cookie.js"></script>
<script type="text/javascript" charset="utf-8" src="/app/Roam/Frontend/js/jquery-querystring.js"></script>
<?php } ?>