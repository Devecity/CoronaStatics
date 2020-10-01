<?php
// bangladesh shortcode [bangladesh]
function coronastatics_bdapi($atts)
{
  $data = json_decode(coronastatics_bangladeshapi());


$output = '

<div class="dev-main">
    <div class="dev-heading">
        আজকের রিপোর্ট
</div>

<div class="dev-grid">
		<div class="grid-box">সনাক্ত হয়েছে</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->todayCases)).' জন
		</div>
		<div class="grid-box">মৃত্যু হয়েছে</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->todayDeaths)).' জনের
		</div>
			<div class="grid-box">কোটিতে টেস্ট</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->testsPerOneMillion)).' জন
		</div>
		<div class="grid-box">কোটিতে মৃত্যু</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->deathsPerOneMillion)).' জন
		</div>
</div>

<div class="dev-heading">
    সর্বমোট রিপোর্ট
</div>

<div class="dev-grid">
		<div class="grid-box">আক্রান্ত</div>
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
		<div class="grid-box">টেস্ট হয়েছে</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->totalTests)).' জনের
		</div>
		<div class="grid-box">করনায় ভুগছেন</div>
		<div class="grid-box">
		'.coronastatics_translator(number_format($data->active)).' জন
		</div>
</div>

</div>
';
    
    return $output;
}
add_shortcode('bangladesh', 'coronastatics_bdapi');