<?php

require_once(dirname(__FILE__) . '/../../config.php');
//require_once($CFG->dirroot.'/local/ualfrontpage/sectionform.php');

require_login(0, false);

//global $CFG, $DB;

$PAGE->set_url('/local/ualfrontpage/');
$PAGE->set_pagelayout('standard');

$context = get_context_instance(CONTEXT_SYSTEM);
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_ualfrontpage'));

$PAGE->navbar->add(get_string('pluginname', 'local_ualfrontpage'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'local_ualfrontpage'));

$hassiteconfig = has_capability('moodle/site:config', $context);

class frontpage_section_form extends moodleform {
    
    //Add elements to form
    function definition() {
        global $CFG, $USER, $OUTPUT, $DB;
        $mform =& $this->_form; // Don't forget the underscore!
        
        $records = $DB->get_records('frontpage_section');// oder by display_order');
        $mform->addElement('header', 'general', get_string('sections', 'local_ualfrontpage'));
        
        foreach ($records as $record){ 
            $mform->addElement('editor', 'section1', get_string('section1', 'local_ualfrontpage'));
            $mform->setDefault('section1', array('text'=>$record->section1, 'format'=>FORMAT_HTML));
            $mform->addElement('html', '<hr>');
            $mform->addElement('editor', 'section2', get_string('section2', 'local_ualfrontpage'));
            $mform->setDefault('section2', array('text'=>$record->section2, 'format'=>FORMAT_HTML));
            $mform->addElement('html', '<hr>');
            $mform->addElement('editor', 'section3', get_string('section3', 'local_ualfrontpage'));
            $mform->setDefault('section3', array('text'=>$record->section3, 'format'=>FORMAT_HTML));
            $mform->addElement('html', '<hr>');
            $mform->addElement('editor', 'section4', get_string('section4', 'local_ualfrontpage'));
            $mform->setDefault('section4', array('text'=>$record->section4, 'format'=>FORMAT_HTML));
        }    
        $mform->addElement('submit', 'Save', get_string('save', 'local_ualfrontpage'));
        //$mform->createElement('submit', 'Save', get_string('save', 'local_ualfrontpage'));
        $mform->closeHeaderBefore('Save');
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}

if($hassiteconfig) {
    
    //all code removed
   
}

$section_form = new frontpage_section_form();
$section_form->display();
echo $OUTPUT->footer();

//echo $content;


if (isset($_POST['Save'])){
    $section_form_data = $section_form->get_data();
    $mydata = new stdClass();
    $mydata->section1 = $section_form_data->section1['text'];
    $mydata->section2 = $section_form_data->section2['text'];
    $mydata->section3 = $section_form_data->section3['text'];
    $mydata->section4 = $section_form_data->section4['text'];
    
    $ex_data = $DB->count_records('frontpage_section');
    if ($ex_data < 1){
        //save new data
        $DB->insert_record('frontpage_section', $mydata);
    }else{
        //save updated data
        $records = $DB->get_records('frontpage_section');
        foreach ($records as $record){
            $mydata->id = $record->id;
        }
        $DB->update_record('frontpage_section', $mydata);
    }
}

