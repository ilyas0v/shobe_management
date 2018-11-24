<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://multinity.com/">Multinity</a>
    </div>
    <div class="footer-right"></div>
</footer>
</div>
</div>


<script src="{{asset('dist/modules/popper.js')}}"></script>
<script src="{{asset('dist/modules/tooltip.js')}}"></script>
<script src="{{asset('dist/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dist/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js')}}"></script>
<script src="{{asset('dist/js/sa-functions.js')}}"></script>

<script src="{{asset('dist/modules/chart.min.js')}}"></script>
<script src="{{asset('dist/modules/summernote/summernote-lite.js')}}"></script>

<script>
    if(document.getElementById("myChart") !== null) {
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                datasets: [{
                    label: 'Statistics',
                    data: [460, 458, 330, 502, 430, 610, 488],
                    borderWidth: 2,
                    backgroundColor: 'rgb(87,75,144)',
                    borderColor: 'rgb(87,75,144)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    }
</script>
<script src="{{asset('dist/js/scripts.js')}}"></script>
<script src="{{asset('dist/js/custom.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
</body>
</html>
