<?php namespace ProcessWire; 

include 'index.php';

// ORGANIZER
if ($input->get('y')) $y = (int)$input->get('y'); else $y = date('Y');
if ($input->get('m')) $m = (int)$input->get('m'); else $m = date('m');
if ($input->get('d')) $d = (int)$input->get('d'); else $d = date('d');

// all events
$all_events = $pages->find("template=event");
    
// some day
$some_day = $y.'-'.$m.'-'.$d;
$some_day = $pages->find("template=event, date_start<=$some_day, date_end>=$some_day, sort=date_start");    

// month
$month_start = $y.'-'.$m.'-01';
$month_end = $y.'-'.$m.'-'.date("t", mktime(0,0,0,$m,1,$y));
//$sortout_past = false;
    
$month_overview = $pages->find("template=event, (date_start<=$month_start, date_end>=$month_start), (date_start>=$month_start, date_end<=$month_end), (date_start<=$month_end, date_end>=$month_end), sort=date_start");

// month
$year_start = $y.'-01-01';
$year_end = $y.'-12-31';
//$sortout_past = false;

$year_overview = $pages->find("template=event, (date_start<=$year_start, date_end>=$year_start), (date_start>=$year_start, date_end<=$year_end), (date_start<=$year_end, date_end>=$year_end), sort=date_start");


if ($y != '0' && $m != '0' && $d != '0') $events = $some_day;
if ($y != '0' && $m != '0' && $d == '0') $events = $month_overview;
if ($y != '0' && $m == '0' && $d == '0') $events = $year_overview;

?>

<h2 id="orgtitle">Events</h2>

<?php

echo events($events, $m); 


function events($items, $m) { ?>
    
    <div class="uk-margin-medium">
        
    <?php if (count($items) != 0) :

        foreach ($items as $item) :
                            
            // past events greyed out
            if (date("Y-m-d", $item->date_end) < date("Y-m-d")) :
                $class = "past";
            else : $class = '';
            endif; ?>

            <div class="event" uk-grid>
                <div class="uk-width-auto">

                <div class="datebox noselect <?=$class?>" uk-tooltip="start">
                    <div class="daybox"><?=date("d", $item->date_start)?></div>
                    <div class="monthbox"><?=date("M", $item->date_start)?></div>
                </div>
                <div class="datebox noselect <?=$class?>" uk-tooltip="end">
                    <div class="daybox"><?=date("d", $item->date_end)?></div>
                    <div class="monthbox"><?=date("M", $item->date_end)?></div>
                </div>

                </div>
                <div class="uk-width-expand@m uk-width-1-1@s uk-margin-small-top">
                    <p>

                    <?php
                    if (isset($item->title)) : ?>
                        <span class="title"><?=$item->title?></span><br>
                    <?php endif;

                    if ($item->date_start == $item->date_end) :
                        if (isset($item->date_start)) : ?>
                            <span><label>on: </label><?=date("l, F j, Y", $item->date_start)?></span><br>
                        <?php endif;
                    else :
                        if (isset($item->date_start)) : ?>
                            <span><label>from: </label><?=date("l, F j, Y", $item->date_start)?></span><br>
                        <?php endif;

                        if (isset($item->date_end)) : ?>
                            <span><label>to: </label><?=date("l, F j, Y", $item->date_end)?></span><br>
                        <?php endif;
                    endif; ?>

                    </p>

                </div>
            </div>
            
        <?php endforeach; 

    else : ?>

        <h4>no events found</h4>

    <?php endif; ?>

    </div>

<?php }


?>
