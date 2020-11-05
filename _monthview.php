<?php namespace ProcessWire; 

include 'index.php';

$months = array('January','February','March','April','May','June','July','August','September','October','November','December');
$events = $pages->get("template=event");
$dates = array();    
$out = '';
$w = 1; 
$d = 1;

$m = (int)date("m");
$y = (int)date("Y");
if ($input->get('m')) $m = (int)$input->get('m');
if ($input->get('y')) $y = (int)$input->get('y');

$t = date("t", mktime(0,0,0,$m,1,$y));
$first = date("w", mktime(0,0,0,$m,1,$y));
$last = date("w", mktime(0,0,0,$m,$t,$y));    
$lmd = $first-1; 
if ($first == 0) {$lmd = 6;}
$nmd = 7-$last; ?>

<h2 id="currentmonth" class="" title="<?=$m?>-<?=$y?>"><?=$months[$m-1]?> / <?=$y?></h2><div class="monthdays"><table id="monthdays">
<tr class="header centered"><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th><tr>
    
<?php 
    
// DAYS OF LAST MONTH 
// loop last days of previous month (incomplete week)
    
for ($d=1; $d<=$lmd; $d++) : 
?>
    <td colspan></td>
<?php
endfor;

    
// ACTUAL DAYS OF SELECTED MONTH
// loop actual days of current month
    
for ($d=1;$d<=$t;$d++) : 
    $day = date(mktime(0,0,0,$m,$d,$y));
    $yyyymmdd = date("Ymd", $day); 
    $class = '';

    if ($yyyymmdd == date("Ymd")) :
        $class = 'present';
    elseif ($yyyymmdd < date("Ymd")) :
        $class .= ' past';
    else :
        $class = '';
    endif; ?>
        
    <td><a class="centered occasion <?=$class?>" id="<?=date("d", $day)?>"><?=date("j", $day)?></a></td>
        
    <?php
    if ($w + $lmd == 7) : ?>
        </tr><tr>
        <?php
        $w = 0; 
        $lmd = 0; 
    endif;
    $w++; 

endfor;

    
// DAYS OF NEXT MONTH    
    
for ($d=1; $d<=$nmd && $nmd < 7; $d++) : ?>
    <td class="centered" colspan></td>
<?php endfor; ?>

</tr>
</table>
</div>
