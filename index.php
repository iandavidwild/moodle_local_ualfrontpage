<?php

require_once(dirname(__FILE__) . '/../../config.php');

require_login(0, false);

global $CFG;

$PAGE->set_url('/local/ualfrontpage/');
$context = get_context_instance(CONTEXT_SYSTEM);
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_ualfrontpage'));

$PAGE->navbar->add(get_string('pluginname', 'local_ualfrontpage'));

$content='';

$content .= $OUTPUT->header();
$content .= $OUTPUT->heading(get_string('pluginname', 'local_ualfrontpage'));

$hassiteconfig = has_capability('moodle/site:config', $context);

if($hassiteconfig) {
    /*$content .= html_writer::start_tag('div');
    
    // example lang string
    // $string['delete'] = 'Delete';
    get_string('delete', 'local_ualfrontopage');
    
    ...*/
    
    $content .= html_writer::start_tag('fieldset');
    $content .= html_writer::start_tag('legend');
    $content .= get_string('newsandannouncements','local_ualfrontpage');
    $content .= html_writer::start_tag('label', array('for'=>'maxitems'));
    $content .= get_string('maxnewsitems','local_ualfrontpage');
    $content .= html_writer::end_tag('label');
    $content .= html_writer::start_tag('input', array('id'=>'maxitems','name'=>'maxitems','type'=>'text'));
    $content .= html_writer::end_tag('legend');
    $content .= html_writer::end_tag('fieldset');
}


$content .= $OUTPUT->footer();

echo $content;

