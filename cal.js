window.onload = function() {
        
    var pullEvents = new XMLHttpRequest();
    const months = ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'];
    const today = new Date();
    const monthDays = document.getElementsByTagName('td');
    const next = document.getElementById('future');
    const previous = document.getElementById('past');
    const todayButton = document.getElementById('todaybutton');
    const calendar = document.getElementById('calendar');
    const organizer = document.getElementById('organizer');
    const monthButton = document.getElementById('monthbutton');
    const yearButton = document.getElementById('yearbutton');
    const loader = document.getElementById('loader');
    const headline = document.getElementById('headline');

    var view = 'month';
    var d = today.getDate();
    var m = today.getMonth();
    var y = today.getFullYear();

    const todayCode = makeDayCode(today.getFullYear(), today.getMonth()+1, today.getDate());

    next.addEventListener('click', createNext);
    previous.addEventListener('click', createPrevious);
    todayButton.addEventListener('click', getToday);
    monthButton.addEventListener('click', monthView);
    yearButton.addEventListener('click', yearView);

    
    createMonth();
    getEvents();
    changeTitle();
    
    
    function changeTitle() {
        if (view == 'year') {            
            document.getElementById('monthtitle').innerHTML = y;
            next.setAttribute('uk-tooltip', 'title:Übersicht '+(y+1)+'; delay: 1000');
            previous.setAttribute('uk-tooltip', 'title:Übersicht '+(y-1)+'; delay: 1000');
        } else {
            var fm = m+1;
            if (fm == 12) {
                fm = 0;
            } 
            var pm = m-1
            if (pm == -1) {
                pm = 11;
            }
            document.getElementById('monthtitle').innerHTML = leadingZeros((m+1))+' / '+y;
            next.setAttribute('uk-tooltip', 'title:Übersicht '+(months[fm])+'; delay: 1000');
            previous.setAttribute('uk-tooltip', 'title:Übersicht '+(months[pm])+'; delay: 1000');
        }
        yearButton.innerHTML = y;
        monthButton.innerHTML = months[m];
    }
    
    function resultsTitle() {
        if (view == 'today' || view == 'day') {
            headline.innerHTML = 'Termine am '+d+'. '+months[m]+' '+y;
        } else if (view == 'year') {
            headline.innerHTML = 'Termine '+y;
        } else {
            headline.innerHTML = 'Termine im '+months[m]+' '+y;
        }
    }
    
    function createMonth() {

        var prevMonth = new Date(y, m, 1); // 1.mm.yyyy
        var lmd = prevMonth.getDay(); // 0-6
        if (lmd==0) {lmd=7;}
        lmd--;

        var nextMonth = new Date(y, m+1, 0); // 28-31.mm.yyyy
        var nmd = nextMonth.getDay(); // 0-6
        if (nmd==0) {nmd=7;}
        var nmd = 7-nmd;
        
        var t = nextMonth.getDate(); // 28-31

        var i = 0;
        var j = 1;
        var n = 1;
        var cssclass = '';

        for (i=0;i<=monthDays.length;i++) {

            if (i<lmd) {
                monthDays[i].innerHTML = '&nbsp;';
            } else if (i>=lmd && j<=t) {
                dayCode = makeDayCode(y, m+1, j);
                // new Date(y,m,j);
                //dayCode = dayCode.getFullYear()+leadingZeros(dayCode.getMonth())+leadingZeros(dayCode.getDate());
                if (dayCode == todayCode) {
                    cssclass = cssclass+'today';       
                } else if (dayCode < todayCode) {
                    cssclass = cssclass+' past';
                } else {
                    cssclass = '';
                }
                monthDays[i].innerHTML = '<a id="'+leadingZeros(j)+'" class="centered occasion '+cssclass+'" href=#">'+j+'</a>';
                j++; cssclass = '';
            } else if (i>=lmd && j>=t && n<=nmd) {
                monthDays[i].innerHTML = '&nbsp;';
                n++;
            } else {
                if (monthDays[i]) {
                    monthDays[i].innerHTML = '&nbsp;';
                }
            }

        }

        assignClicks();

    }
    
    function assignClicks() {
        for (i = 0; i < monthDays.length; i++) {
            monthDays[i].firstChild.addEventListener('click', someDay);
        };
        monthButton.innerHTML = months[m];
        todayNumber = document.getElementById(leadingZeros(d));
    }
    
    function addActive(element) {
        element.classList.add('active');
    }

    function removeActive() {
        var actives = document.querySelectorAll('.active');
        if (actives.length > 0) {
            for (var u = 0; u < actives.length; u++) {
                actives[u].classList.remove('active');
            }        
        }
    }

    function leadingZeros(x) { 
        return (x < 10 ? '0' : '') + x;
    }

    function createPrevious() {
        removeActive();
        if (view == 'year') {
            y--;
            addActive(yearButton);
        } else {
            m--;
            if (m == -1) {m=11; y--;}
            createMonth();
            addActive(monthButton);
            view = 'month';
        }
        getEvents();
    }

    function createNext() {
        removeActive();
        if (view == 'year') {
            y++;
            addActive(yearButton);
        } else {
            m++;
            if (m == 12) {m=0; y++}
            createMonth();
            addActive(monthButton);
            view = 'month';
        }
        getEvents();
    }

    function getToday() {
        if (view == 'year') {
            organizer.style.display = 'none';            
        }
        view = 'today';
        d = today.getDate();
        m = today.getMonth();
        y = today.getFullYear();
        removeActive();
        createMonth();
        addActive(todayNumber);
        addActive(todayButton);
        getEvents();
        calendar.style.display = 'unset';
    }
        
    function someDay() {
        view = 'day';
        removeActive();
        dayCode = makeDayCode(y,m+1,this.id);
        if (dayCode == todayCode) {
            
            view = 'today';
            addActive(todayButton);
        }
        d = this.id;
        addActive(this);
        getEvents();
    }    
    
    function monthView() {
        createMonth();
        removeActive()
        view = 'month';
        yearButton.classList.remove('active');
        this.classList.add('active');
        getEvents();
        calendar.style.display = 'unset';
    }

    function yearView() {
        removeActive()
        view = 'year';
        monthButton.classList.remove('active');
        this.classList.add('active');
        getEvents();
        calendar.style.display = 'none';
    }

    function makeDayCode(a, b, c) {
        return a+leadingZeros(b)+leadingZeros(c);
    }
    
    function getEvents() {
        changeTitle();
        headline.innerHTML = 'Termine werden geladen…';
        if (pullEvents) {
            pullEvents.onreadystatechange = listEvents;
            pullEvents.open("GET", "./?m="+m+"&y="+y+"&d="+d+"&view="+view, true);
            pullEvents.send(null);
            if (view == 'year') {
                calendar.style.display = 'none';
            } 
            organizer.style.display = 'none';
        };
    }    
    
    function listEvents() {
        pullEvents.readyState;
        if (pullEvents.readyState == 4 && pullEvents.status == 200) {
            resultsTitle();
            var str = pullEvents.responseText;            
            document.getElementById("organizer").innerHTML = (str);
            if (view == 'year') {
                calendar.style.display = 'none';
            } 
            organizer.style.display = 'unset';
        };
    };        
    
}
