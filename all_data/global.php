<?php
class coronastatics_globalwidget extends WP_Widget{
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'coronastatics_globalwidget',
            'description' => 'Display Worlds Live CoronaVirus (Covid-19) Real-Time Data '
        );
        parent::__construct('coronastatics_globalwidget', 'CoronaStatics For World', $widget_ops);
    }
    
    // output the widget content on the front-end
    public function widget($args, $instance)
    {
         echo $args['before_widget'];
  $data = json_decode(coronastatics_globalapi());
?>

<div class="dev-main">
<div class="dev-heading">
<?php if (!empty($instance['title'])) {?>
<?php echo $instance['title'];?>
<?php }?>
</div>
<?php  $data = json_decode(coronastatics_globalapi());?>
<div class="dev-grid">
		<div class="grid-box">মোট আক্রান্ত</div>
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
</div>

</div>


<?php
        echo $args['after_widget'];
    }
    
    // output the option form field in admin widgets screen
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('সারা বিশ্ব', 'DeveCity');
         
?>
   <p>
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
       

    </p>
<?php
    }
    
    // saving the options
    public function update($new_instance, $old_instance)
    {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        
        return $instance;
    }
}