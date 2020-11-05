<?php namespace ProcessWire; ?>

<div id="content">
    
    <section>
        <h1 class="centered uk-margin-medium uk-margin-bottom-large"><?=$page->title;?></h1>

        <div class="noselect centered uk-margin-medium">
        
        <button 
            class="uk-width-1-2@s uk-width-auto@m uk-button-default uk-button switches" 
            id="todaybutton">Today</button>
            
            <button 
            class="uk-width-1-6@s uk-width-auto@m uk-button-default uk-button switches" 
            id="past" 
            uk-tooltip="title: previous month; delay: 500" 
            uk-icon="icon: triangle-left"></button>
            
            <button 
            class="uk-width-1-6@s uk-width-1-6@m uk-button-default uk-button switches" 
            id="monthbutton" 
            uk-tooltip="title: Month overview; delay: 500">Month</button>
            
            <button 
            class="uk-width-1-6@s uk-width-auto@m uk-button-default uk-button switches" 
            id="future" 
            uk-tooltip="title: next month; delay: 500" 
            uk-icon="icon: triangle-right"></button>

            <!-- 
            this needs work, a switch for a month overview (which works already) and a year view. 
            clicking year-view will ditch the month calendar on the left, expand the organizer layout and list all events in that year in a table layout.
            Also, it would change the button#monthbutton (above) to button#yearbutton and clicking it would show a year overview of all events of the current year. 
            Clicking the left/right arrows would then switch the year.

            <button 
            class="uk-button switches current" 
            id="monthviewbutton" 
            uk-tooltip="title: Month view; delay: 500">Month</button>
            
            <button 
            class="uk-button-default uk-button switches" 
            id="yearviewbutton" 
            uk-tooltip="title: Year view; delay: 500">Year</button>
            -->

            
        </div>

        <div uk-grid class="uk-margin-large">

            <div id="calendar" class="noselect centered uk-width-1-1@s uk-width-1-3@m"></div>

            <div id="organizer" class="uk-width-1-1@s uk-width-expand@m"><h2>Events</h2></div>

        </div>

    </section>
    
</div>

<script type="text/javascript" src="<?=urls()->templates?>scripts/cal.js"></script>
