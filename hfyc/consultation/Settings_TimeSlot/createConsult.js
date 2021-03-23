document.getElementById('btnOpen').addEventListener('click',
    function () {
        document.querySelector('.time-slot').style.display = 'flex';
    });

document.querySelector('.btnClose').addEventListener('click',
    function () {
        document.querySelector('.time-slot').style.display = 'none';
    });


$(document).ready(function () {
    $(function () {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10) {
            month = '0' + month.toString();
        }
        if (day < 10) {
            day = '0' + day.toString();
        }
        var maxDate = year + '-' + month + '-' + day;

        $('#dateValidate').attr('min', maxDate);
    });
});

