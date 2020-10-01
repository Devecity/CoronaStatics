<?php
// world shortcode [world]
function coronastatics_worldapi($atts)
{
  $data = json_decode(coronastatics_globalapi());


$output = '

<div class="dev-main">
<div class="dev-heading">
সারা বিশ্ব
</div>
<?php  $data = json_decode(coronastatics_globalapi());?>
<div class="dev-grid">
		<div class="grid-box">মোট আক্রান্ত</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->cases)).' জন
		</div>
		<div class="grid-box">মৃত্যু হয়েছে</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->deaths)).' জনের
		</div>
		<div class="grid-box">সুস্থ হয়েছেন</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->recovered)).' জন
		</div>
</div>

</div>
';
    
    return $output;
}
add_shortcode('world', 'coronastatics_worldapi');