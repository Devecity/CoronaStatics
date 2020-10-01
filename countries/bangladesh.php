<?php

class coronastatics_bangladeshwidget extends WP_Widget{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'coronastatics_bangladeshwidget',
            'description' => 'Display Bangladesh Live CoronaVirus (Covid-19) Real-Time Data'
        );
        parent::__construct('coronastatics_bangladeshwidget', 'CoronaStatics Bangladesh', $widget_ops);
    }
    
    // output the widget content on the front-end
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
            $data = json_decode(coronastatics_bangladeshapi());
?>


<div class="dev-main">
<div class="dev-heading">
আজকের রিপোর্ট
</div>

<div class="dev-grid">
		<div class="grid-box">সনাক্ত হয়েছে</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->todayCases));?> জন
		</div>
		<div class="grid-box">মৃত্যু হয়েছে</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->todayDeaths));?> জনের
		</div>
		<div class="grid-box">কোটিতে টেস্ট</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->testsPerOneMillion));?> জন
		</div>
		<div class="grid-box">কোটিতে মৃত্যু</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->deathsPerOneMillion));?> জন
		</div>
</div>

<div class="dev-heading">
সর্বমোট রিপোর্ট
</div>

<div class="dev-grid">
		<div class="grid-box">আক্রান্ত</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->cases));?> জন
		</div>
		<div class="grid-box">মৃত্যু হয়েছে</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->deaths));?> জনের
		</div>
		<div class="grid-box">সুস্থ হয়েছেন</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->recovered));?> জন
		</div>
		<div class="grid-box">টেস্ট হয়েছে</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->totalTests));?> জনের
		</div>
		<div class="grid-box">করনায় ভুগছেন</div>
		<div class="grid-box">
		<?php echo coronastatics_translator(number_format($data->active));?> জন
		</div>
</div>

</div>                   


<?php
  echo $args['after_widget'];
    }
    
    // output the option form field in admin widgets screen
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('বাংলাদেশ
', 'DeveCity');
         $rtf = !empty($instance['rtf']) ? $instance['rtf'] : esc_html__('10', 'DeveCity');
         $rhf = !empty($instance['rhf']) ? $instance['rhf'] : esc_html__('20', 'DeveCity');
        $fcolor = !empty($instance['fcolor']) ? $instance['fcolor'] : esc_html__('#fff', 'DeveCity');
        $bgcolor = !empty($instance['bgcolor']) ? $instance['bgcolor'] : esc_html__('#c4161c', 'DeveCity');
?>
   
    <label for="<?php
        echo esc_attr($this->get_field_id('title'));
?>">
    <?php
        esc_attr_e('Title:', 'DeveCity');
?>
   </label> 
    
    <input 
        class="widefat" 
        id="<?php
        echo esc_attr($this->get_field_id('title'));
?>" 
        name="<?php
        echo esc_attr($this->get_field_name('title'));
?>" 
        type="text" 
        value="<?php
        echo esc_attr($title);
?>">
       
    
    <?php
    }
    
    // saving the options
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['rtf'] = (!empty($new_instance['rtf'])) ? strip_tags($new_instance['rtf']) : '';
        $instance['rhf'] = (!empty($new_instance['rhf'])) ? strip_tags($new_instance['rhf']) : '';
        $instance['fcolor'] = (!empty($new_instance['rhf'])) ? strip_tags($new_instance['fcolor']) : '';
        $instance['bgcolor'] = (!empty($new_instance['rhf'])) ? strip_tags($new_instance['bgcolor']) : '';
        return $instance;
    }
}