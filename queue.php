<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Queue</title>
</head>
<style>
    .calling {
        background-color: crimson !important;
        color: white !important;
        font-size: 4rem !important;
    }

    .consultation {
        background-color: green !important;
        color: white !important;
        font-size: 1.5rem !important;
    }
</style>

<body>
    <div class="container">
        <h1 class="text-center">Display Queue</h1>
        <div id="show"></div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#show').load('./backend/loader.php');
            setInterval(function() {
                $.ajax({
                    url: './backend/queue.php',
                    success: function(response) {
                        let curr = $('.curr_val').text();
                        // if (response != curr) {
                            $('#show').load('./backend/loader.php');
                        // }
                    }
                })
            }, 2000)

        })
        setInterval(() => {
            const flash = document.getElementById('flash');
            if (flash) {
                flash.classList.toggle('calling');
                // callName(flash);
            }
        }, 1000)
        setInterval(()=>{
            const flash = document.getElementById('flash');
            if (flash) {
                // flash.classList.toggle('calling');
                callName(flash);
            }
        }, 5000)

        function callName(text) {
            const td = text.querySelectorAll('td');
            const name = td[0].textContent;
            const synth = window.speechSynthesis;
            const utterance = new SpeechSynthesisUtterance(name);
            console.log(name);
            // utterance.voice = synth.getVoices()[5];
            utterance.voice = null;
            utterance.rate = 1.2;
            utterance.pitch = 1.1;
            // utterance.lang = 'en-US'
            synth.speak(utterance);
            console.log(utterance);
            let count = 10;
            // inter = setInterval(function() {
            //     // btn.innerHTML = count
            //     count--;
            //     if (count < 0) {
            //         // btn.innerHTML = 'Calling Again';
            //         timer = setTimeout(()=>{
            //             callName();
            //         }, 5000)
            //         clearInterval(inter);
            //     }
            // }, 5000)
        }
    </script>
</body>

</html>