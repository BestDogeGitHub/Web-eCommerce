
$(document).ready(function(){

    $('#spinner').fadeIn();



    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

    var week_data = [];
    var reviews_week_data = [];

    $.ajax({
        url: "/auth/home/informations",
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            console.log(data);











            /**
             * ORDERS CHART
             */

            $.each(data.orders, function(key, value){
                week_data.push(value);
            });

            var orders_chart = $('#orders-chart');

            var now = new Date();
            var order_labels = ['Today', 'Yesterday'];



            for(var i = 2; i < 7; i++) {
                order_labels.push( $.datepicker.formatDate('dd M', new Date(now.getFullYear(),now.getMonth(),now.getDay()-i) ) );
            }

            var salesChartData = {
                labels  : order_labels,
                datasets: [
                {
                    label               : 'Orders',
                    backgroundColor     : 'rgba(60,141,188,0.2)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : 4,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : week_data.reverse()
                },
                ]
            };
            
            var salesChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                display: false
                },
                scales: {
                xAxes: [{
                    gridLines : {
                    display : false,
                    }
                }],
                yAxes: [{
                    gridLines : {
                    display : true,
                    }
                }]
                }
            };
            
            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(orders_chart, { 
                type: 'line', 
                data: salesChartData, 
                options: salesChartOptions
                }
            );















            /**
             * REVIEW CHART
             */
            var reviews_chart = $('#review-chart');

            $.each(data.reviews, function(key, value){
                reviews_week_data.push(value);
            });


            var salesGraphChartData = {
                labels  : order_labels.reverse(),
                datasets: [
                  {
                    label               : 'Reviews',
                    fill                : false,
                    borderWidth         : 2,
                    lineTension         : 0,
                    spanGaps : true,
                    borderColor         : '#efefef',
                    pointRadius         : 3,
                    pointHoverRadius    : 7,
                    pointColor          : '#efefef',
                    pointBackgroundColor: '#efefef',
                    data                : reviews_week_data
                  }
                ]
              };
            
              var salesGraphChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                  display: false,
                },
                scales: {
                  xAxes: [{
                    ticks : {
                      fontColor: '#efefef',
                    },
                    gridLines : {
                      display : false,
                      color: '#efefef',
                      drawBorder: false,
                    }
                  }],
                  yAxes: [{
                    ticks : {
                      stepSize: 20,
                      fontColor: '#efefef',
                    },
                    gridLines : {
                      display : true,
                      color: '#efefef',
                      drawBorder: false,
                    }
                  }]
                }
              };
            
              // This will get the first returned node in the jQuery collection.
              var salesGraphChart = new Chart(reviews_chart, { 
                  type: 'line', 
                  data: salesGraphChartData, 
                  options: salesGraphChartOptions
                }
              );






                $('#users_reg').html(data.users + '<sup class="sup">+</sup>').hide().fadeIn(2000);
                $('#new_orders').html(data.num_orders + '<sup class="sup">+</sup>').hide().fadeIn(2000);
                $('#num_products').html(data.num_products + '<sup class="sup">+</sup>').hide().fadeIn(2000);
                $('#in_transit').html(data.in_transit).hide().fadeIn(2000);






        },
        error:function (xhr, ajaxOptions, thrownError){
            if(xhr.status == 404) {
              Toast.fire({
                type: 'error',
                title: 'Category not found'
              });
            }else if(xhr.status == 409) {
                Toast.fire({
                  type: 'warning',
                  title: 'Conflict alert (409).'
                });
            }else if(xhr.status == 500) {
              Toast.fire({
                type: 'error',
                title: 'Oops... something went wrong (500). Server error: contact your wesite administrator'
              });
            }else{
              Toast.fire({
                type: 'error',
                title: 'Generic error. (' + xhr.status + ')'
              });
            }
        },
        complete:function(){
            $('#spinner').fadeOut();
        }

    });



    
    


});

