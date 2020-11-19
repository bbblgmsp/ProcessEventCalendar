<?php namespace ProcessWire; ?>

<div id="content">


    <h1 class="uk-margin-medium uk-margin-bottom-large centered"><?=$page->title;?></h1>

    <div class="centered noselect">
        <button 
            class="uk-width-1-2@s uk-width-auto@m uk-button-default uk-button switches" 
            id="todaybutton">Heute</button>

        <button 
            class="uk-width-1-2@s uk-width-auto@m uk-button-default uk-button switches" 
            id="past" uk-tooltip="title:voriger Monat; delay: 1000"><span uk-icon="icon:arrow-left; ratio: 1.5"></span></button>

        <button 
            class="uk-width-1-2@s uk-width-1-6@m uk-button-default uk-button switches active" 
            id="monthbutton" uk-tooltip="title:Monatsübersicht; delay: 1000">Monat</button>

        <button 
            class="uk-width-1-2@s uk-width-auto@m uk-button-default uk-button switches" 
            id="yearbutton" uk-tooltip="title:Jahresübersicht; delay: 1000">Jahr</button>

        <button 
            class="uk-width-1-2@s uk-width-auto@m uk-button-default uk-button switches" 
            id="future" uk-tooltip="title:nächster Monat; delay: 1000"><span uk-icon="icon:arrow-right; ratio: 1.5"></span></button>
        
    </div>

    <section>
        
        <div class="uk-margin-large" uk-grid>
            <div id="calendar" class="uk-width-1-1@s uk-width-1-3@m centered noselect">
                <h2 id="monthtitle">mm / yyyy</h2>
                <table id="monthCalendar">
                    <tbody>
                        <tr class="header centered">
                            <th>Mo</th>
                            <th>Di</th>
                            <th>Mi</th>
                            <th>Do</th>
                            <th>Fr</th>
                            <th>Sa</th>
                            <th>So</th>
                        </tr>
                        <tr>
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                        </tr>
                        <tr>
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                        </tr>
                        <tr>
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                        </tr>
                        <tr>
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                        </tr>
                        <tr>
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                        </tr>
                        <tr>
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                            <td class="centered">&nbsp;</td>    
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="uk-width-1-1@s uk-width-expand@m">
                <h2 id="headline">Termine events</h2>
                <div id="organizer"></div>
            </div>
        </div>

    </section>
    
</div>

<script type="text/javascript" src="<?=urls()->templates?>scripts/cal.js"></script>
