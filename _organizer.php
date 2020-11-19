<?php namespace ProcessWire; 

setlocale(LC_TIME, "de_DE");

// ORGANIZER
if ($input->get('y')) : $y = $input->get('y'); else : $y = date('Y'); endif;
if ($input->get('m')) : $m = $input->get('m')+1; else : $m = date('m'); endif;
if ($input->get('d')) : $d = $input->get('d'); else : $d = date('d'); endif;
$view = $input->get('view');

// all events
$all_events = $pages->find("template=event");

// some day
$some_day = $y.'-'.$m.'-'.$d;
$some_day = $pages->find("template=event, date_start<=$some_day, date_end>=$some_day, sort=date_start");    

// month
$month_start = $y.'-'.$m.'-01';
$month_end = $y.'-'.$m.'-'.date("t", mktime(0,0,0,$m,1,$y));    
$month_overview = $pages->find("template=event, (date_start<=$month_start, date_end>=$month_start), (date_start>=$month_start, date_end<=$month_end), (date_start<=$month_end, date_end>=$month_end), sort=date_start");

// year
$year_start = $y.'-01-01';
$year_end = $y.'-12-31';

$year_overview = $pages->find("template=event, (date_start<=$year_start, date_end>=$year_start), (date_start>=$year_start, date_end<=$year_end), (date_start<=$year_end, date_end>=$year_end), sort=date_start");

if ($view == 'year') : $events = $year_overview;;
elseif ($view == 'day' || $view == 'today') : $events = $some_day;
else : $events = $month_overview; endif;


function events($items) { 

    $months = array('Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');

    if (count($items) != 0) :

        foreach ($items as $item) :  

            // past events greyed out
            if ($item->date_end < date(strtotime('today'))) :
                $class = "past";
            else : $class = '';
            endif; ?>

            <div class="event" uk-grid>
                <div class="uk-width-auto">
                    <div class="datebox noselect <?=$class?>" uk-tooltip="Beginn">
                        <div class="daybox"><?=strftime("%d", $item->date_start)?></div>
                        <div class="monthbox"><?=strftime("%b", $item->date_start)?></div>
                    </div>
                    <div class="datebox noselect <?=$class?>" uk-tooltip="Ende">
                        <div class="daybox"><?=strftime("%d", $item->date_end)?></div>
                        <div class="monthbox"><?=strftime("%b", $item->date_end)?></div>
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
                            <span><label>am: </label><?=strftime('%A, %e. %B %Y', $item->date_start)?></span><br>
                        <?php endif;
                    else :
                        if (isset($item->date_start)) : ?>
                            <span><label>von: </label><?=strftime('%A, %e. %B %Y', $item->date_start)?></span><br>
                        <?php endif;

                        if (isset($item->date_end)) : ?>
                            <span><label>bis: </label><?=strftime('%A, %e. %B %Y', $item->date_end)?></span><br>
                        <?php endif;
                    endif;

                    if ($item->location != '') : ?>
                        <span><label>Ort: </label><?=$item->location?></span><br>
                    <?php endif;

                    if (isset($item->contact1)) :
                        echo magicLink($item->contact1);
                    endif; ?>

                    </p>

                </div>
            </div>

        <?php endforeach; 

    else : ?>

        <h4>keine Termine zu finden</h4>

    <?php endif; 

}

function events_table($items) { 

    if (count($items) != 0) : ?>

        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-small uk-table-divider">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Beginn</th>
                        <th>Ende</th>
                        <th>Ort</th>
                        <th>Kontakt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($items as $item) : ?>
                    <tr>
                        <td><?=$item->title?></td>
                        <td><?=strftime('%d.%m.%Y', $item->date_start)?></td>
                        <td><?=strftime('%d.%m.%Y', $item->date_end)?></td>
                        <td><?=$item->location?></td>
                        <td><?=magicLink($item->contact1)?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php else : ?>

        <h4>keine Termine zu finden</h4>

<?php endif; 

}

?>
