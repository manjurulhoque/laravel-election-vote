function updateTimer() {
    let timer = document.getElementById("timer");
    if (timer) {
        let future = Date.parse(timer.getAttribute('data-election-end-time'));
        let now = new Date();
        let diff = future - now;

        let days = Math.floor(diff / (1000 * 60 * 60 * 24));
        let hours = Math.floor(diff / (1000 * 60 * 60));
        let mins = Math.floor(diff / (1000 * 60));
        let secs = Math.floor(diff / 1000);

        let d = days;
        let h = hours - days * 24;
        let m = mins - hours * 60;
        let s = secs - mins * 60;


        if (diff < 0) {
            clearInterval(updateTimer);
            timer.innerHTML =
                '<div>00<span>Days</span></div>' +
                '<div>00<span>Hours</span></div>' +
                '<div>00<span>Minutes</span></div>' +
                '<div>00<span>Seconds</span></div>';
        } else {
            timer.innerHTML =
                '<div>' + d + '<span>Days</span></div>' +
                '<div>' + h + '<span>Hours</span></div>' +
                '<div>' + m + '<span>Minutes</span></div>' +
                '<div>' + s + '<span>Seconds</span></div>';
        }
    }
}

setInterval('updateTimer()', 1000);
