<h1>Edit Ceremony</h1>
<?php
echo $this->Form->create($ceremony);
echo $this->Form->control('registration_year', ['disabled' => true]);
echo $this->Form->control('night');
echo $this->Form->control('ceremony_date', ['type' => 'date', 'value' => $ceremony->date]);
echo $this->Form->control('ceremony_time', ['type' => 'time', 'value' => $ceremony->date]);

echo $this->Form->button(__('Save Ceremony'), array('class' => 'btn btn-primary'));
echo '&nbsp;';
echo $this->Form->button('Cancel', array(
    'type' => 'button',
    'onclick' => 'location.href=\'/ceremonies\'',
    'class' => 'btn btn-secondary',
));

echo $this->Form->end();
?>
