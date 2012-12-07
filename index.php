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
}


$content .= $OUTPUT->footer();

echo $content;

