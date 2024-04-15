<script>
        // Wrap JavaScript code in DOMContentLoaded event listener
        document.addEventListener("DOMContentLoaded", function() {
            // Data
            var data = {
                labels: @json(array_keys($results)),
                datasets: [{
                    data: @json(array_values($results)),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            // Options
            var options = {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'Age Distribution'
                }
            };

            // Get context with jQuery - using jQuery's .get() method.
            var ctx = document.getElementById('agePieChart').getContext('2d');

            // Create pie chart
            var agePieChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        });
    </script>
    <!-- #hiv status at enrollment -->
    <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $HIVStatus->pluck('hiv_status') !!},
            datasets: [{
                data: {!! $HIVStatus->pluck('count') !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'HIV status'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('hivStatusPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
    <!-- Sex -->
     <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $SexStatus->pluck('sex') !!},
            datasets: [{
                data: {!! $SexStatus->pluck('count') !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'HIV status'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('genderPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
   <!-- provided with condom -->
        <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $PCondom->pluck('provide_with_condom') !!},
            datasets: [{
                data: {!! $PCondom->pluck('count') !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Provided with condoms'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('CondomPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>
       <!-- completed sessions -->
        <script>
        // Data for the pie chart
      document.addEventListener("DOMContentLoaded", function(){
        var data = {
            labels: {!! $Csessions->pluck('complete_session') !!},
            datasets: [{
                data: {!! $Csessions->pluck('count') !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Options for the pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Provided with condoms'
            }
        };

        // Get the canvas element
        var ctx = document.getElementById('SessionsPieChart').getContext('2d');

        // Create the pie chart
        var hivStatusPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: options
        });
        });
    </script>