<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="static/assets/js/navbar.js"></script>
<script>
    function validate30Minutes(input){
        if(input != ''){
            time = document.getElementById(input).value;
            var minutes = moment.duration(time).asMinutes();
            

            if(minutes%30 != 0){
                alert('Please choose 30 min intervals');
                document.getElementById(input).value = '';
            }
            else{
                console.log('30 Mins!');
            }
            console.log(minutes);
        }
    };

    function validateTime(type){
        time_start = document.getElementById(type+'_time_start');
        time_end = document.getElementById(type+'_time_end');
        if(time_start.value != '' && time_end.value != ''){
            if(time_start.value>time_end.value){
                alert('Time-End cannot be before Time-Start!');
                time_end.value = '';
                return false;
            }
            else{
                return true;
            }
        }
    };
</script>