window.onload = function() {
    
    var lookUp = new XMLHttpRequest();
    var calSwitch = new XMLHttpRequest();
    var headline = '';
    var temp = '';

    x = new Date();
    m = x.getMonth()+1;
    y = x.getFullYear();
    d = x.getDate();
    
    var months = new Array();
    months[1] = "January";
    months[2] = "February";
    months[3] = "March";
    months[4] = "April";
    months[5] = "May";
    months[6] = "June";
    months[7] = "July";
    months[8] = "August";
    months[9] = "September";
    months[10] = "October";
    months[11] = "November";
    months[12] = "December";
    
    var todaybutton = document.getElementById('todaybutton');
    var previousMonth = document.getElementById('past');
    var nextMonth = document.getElementById('future');
    var monthbutton = document.getElementById('monthbutton');
    var yearbutton = document.getElementById('yearbutton');
    
    todaybutton.addEventListener('click', today);
    previousMonth.addEventListener('click', thePrevious);
    nextMonth.addEventListener('click', theNext);
    monthbutton.addEventListener('click', getMonth);
    yearbutton.addEventListener('click', getYear);

    getMonth();
    
    var occasions = document.getElementsByClassName('occasion');
    for (i = 0; i < occasions.length; i++) {
        occasions[i].addEventListener('click', someDay);
    };

    assignClicks();
                                      
    function today() {     
        m = x.getMonth()+1;
        y = x.getFullYear();
        d = x.getDate();
        getEvents();
        if (calSwitch) {
            calSwitch.onreadystatechange = switchView;
            calSwitch.open("GET", "../_monthview.php?m="+m+"&y="+y, true);
            calSwitch.send(null);
        };
        headline = 'on '+d+'. '+months[m]+' '+y;
        monthbutton.classList.remove("current");
        if(temp) {temp.classList.remove("current");}
        todaybutton.classList.add("current");
        if (todaynumber) {
            console.log(d);
            todaynumber[0].classList.add("current");
        };
    }

    function assignClicks() {
        occasions = document.getElementsByClassName('occasion');
        for (i = 0; i < occasions.length; i++) {
            occasions[i].addEventListener('click', someDay);
        };
        document.getElementById("monthbutton").innerHTML = year[m];
        todaynumber = document.getElementsByClassName("present");
    }
    
    function thePrevious() {
        m = parseInt(m) - 1;        
        if (m < 1) {
            y = parseInt(y) - 1;   
            m = 12;
        }
        d = '0';
        getEvents();        
        if (calSwitch) {
            calSwitch.onreadystatechange = switchView;
            calSwitch.open("GET", "../_monthview.php?m="+m+"&y="+y, true);
            calSwitch.send(null);
        }
        headline = months[m]+' '+y;
        todaybutton.classList.remove("current");
        monthbutton.classList.add("current");
    }

    function theNext() {
        m = parseInt(m) + 1;
        if (m > 12) {
            y = parseInt(y) + 1;
            m = 1;
        }
        d = '0';
        getEvents();        
        if (calSwitch) {
            calSwitch.onreadystatechange = switchView;
            calSwitch.open("GET", "../_monthview.php?m="+m+"&y="+y, true);
            calSwitch.send(null);
        }
        headline = months[m]+' '+y;
        todaybutton.classList.remove("current");
        monthbutton.classList.add("current");
    }    
    
    
    function getEvents() {
        if (lookUp) {
            lookUp.onreadystatechange = listEvents;
            lookUp.open("GET", "../_organizer.php?m="+m+"&y="+y+"&d="+d, true);
            lookUp.send(null);
        };
    }    
    
    function someDay() {
        for (i = 0; i < occasions.length; i++) {
            occasions[i].classList.remove('current');
        };
        d = this.id;
        getEvents();
        headline = 'on '+d+'. '+months[m]+' '+y;
        temp = this;
        this.classList.add('current');
        monthbutton.classList.remove("current");
    }

    function getMonth() {     
        d = '0';
        getEvents();
        headline = months[m]+' '+y;
        todaybutton.classList.remove("current");
        monthbutton.classList.add("current");
        temp.classList.remove("current");
        for (i = 0; i < occasions.length; i++) {
            occasions[i].classList.remove('current');
        };
        if (calSwitch) {
            calSwitch.onreadystatechange = switchView;
            calSwitch.open("GET", "../_monthview.php?m="+m+"&y="+y, true);
            calSwitch.send(null);
        }
    }    
    
    function getYear() {
        d = '0';
        m = '0';
        getEvents();
        headline = y;
        todaybutton.classList.remove("current");
        yearbutton.classList.add("current");
        temp.classList.remove("current");
        if (calSwitch) {
            calSwitch.onreadystatechange = switchView;
            calSwitch.open("GET", "../_monthview.php?m="+m+"&y="+y, true);
            calSwitch.send(null);
        }
    }
    
    // what to do when server responded

    function listEvents() {
        lookUp.readyState;
        if (lookUp.readyState == 4 && lookUp.status == 200) {
            var str = lookUp.responseText;
            document.getElementById("organizer").innerHTML = (str);
        };
        document.getElementById('orgtitle').innerHTML = "Events "+headline;
    };    
        
    function switchView() {
        calSwitch.readyState;
        if (calSwitch.readyState == 4 && calSwitch.status == 200) {
            var str = calSwitch.responseText;
            document.getElementById("calendar").innerHTML = (str);
        }
        assignClicks();
    }    
    
};