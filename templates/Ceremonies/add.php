<h1>Add Ceremony</h1>
<?php
echo $this->Form->create($ceremony);
//$this->Form->templates(
//    ['dateWidget' => '{{day}}{{month}}{{year}}']
//);
// Hard code the user for now.
echo $this->Form->control('night');
echo $this->Form->control('ceremony_date', ['type' => 'date', 'value' => date('Y-m-d')]);
echo $this->Form->control('ceremony_time', ['type' => 'time']);
echo $this->Form->button(__('Save Ceremony'));
echo $this->Form->button('Cancel', array(
    'type' => 'button',
    'onclick' => 'location.href=\'/ceremonies\''
));
echo $this->Form->end();
?>