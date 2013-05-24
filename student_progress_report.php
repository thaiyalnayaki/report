<?php
$fp = fopen('prog.csv', 'r') or die("could not open file");
while (($values = fgetcsv($fp)) !== FALSE) {
    $mark_list[$values[0]] = array('1' => array('tamil' => $values[2], 'english' => $values[3], 'maths' => $values[4]),
                                  '2' => array('tamil' => $values[6], 'english' => $values[7], 'maths' => $values[8]), 
                                  '3' => array('tamil' => $values[10], 'english' => $values[11], 'maths' => $values[12]));
}
print 'Enter student roll_num to get total marks : ';
fscanf(STDIN, "%d", $rollnum);
print 'Enter semester number,1,2,3 : ';
fscanf(STDIN, "%s", $number);
if(array_key_exists($rollnum, $mark_list) && $number <= 3) {
    get_total_marks($rollnum,$number,$mark_list);
    print 'Total mark is : '.$total."\n";
    $average = $total/count($mark_list[$rollnum][$number]);
    print 'Average is : '.$average."\n";
}
else {
    print 'Please Enter correct roll number and semester'."\n";
    exit ();
} 

print 'Type tamil or english or maths to get pass students list : ';
fscanf(STDIN, "%s", $subject);
print 'Which semester 1 0r 2 or 3? : ';
fscanf(STDIN, "%d", $semester);
if($students_pass_list = pass_students_in_particular_subject($mark_list, $subject, $semester)) {
    print 'In '.$subject.' '.count($students_pass_list).' '.'have passed in'.' '.'semester = '.$semester."\n";
    print_r($students_pass_list);
}
 else {
    print 'All students pass in : '.$subject."\n";
}

print 'KNOW ABOUT PARTICULAR STUDENT DETAILS : '."\n";
print 'Enter student rollnum: ';
fscanf(STDIN, "%d", $rollnum);
print 'Which semester 1 or 2 or 3? : ';
fscanf(STDIN, "%d", $semester);
print 'Which subject. tamil or english or maths? : ';
fscanf(STDIN, "%s", $subject);
print $mark_list[$rollnum][$semester][$subject]."\n";

print 'KNOW ABOUT MAX AND MIN MARKS : '."\n";
print 'Which semester 1 or 2 or 3? : ';
fscanf(STDIN, "%d", $semester);
print 'Which subject. tamil or english or maths? : ';
fscanf(STDIN, "%s", $subject);
max_and_min_marks($mark_list, $semester, $subject);
print 'Maximum mark'.  max($max_and_min_marks)."\n";
print 'Minimum mark'.  min($max_and_min_marks)."\n";

function get_total_marks($rollnum,$number,$mark_list) {
    global $total;
    $total = $mark_list[$rollnum][$number]['tamil']+$mark_list[$rollnum][$number]['english']+$mark_list[$rollnum][$number]['maths'];
    return $total;
}

function pass_students_in_particular_subject($mark_list, $subject, $semester) {
    $pass_student = array();
    $value = array_keys($mark_list);
    for($i=0; $i<count($mark_list); $i++) {        
        if(35<=$mark_list[$value[$i]][$semester][$subject]) {
            $pass_student[] = $value[$i];
        }
    }
    if($pass_student == 0) {
        return FALSE;
    }
    else
    return $pass_student;
}

function max_and_min_marks($mark_list, $semester, $subject) {
    global $max_and_min_marks;
    $max_and_min_marks = array();
    $value = array_keys($mark_list);
    for($i=0; $i<count($mark_list); $i++) {        
        $max_and_min_marks[] = $mark_list[$value[$i]][$semester][$subject];           
    }
    return $max_and_min_marks;
}
 
?>



