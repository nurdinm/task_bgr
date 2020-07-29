
$(function() {
    "use strict";
    

    var chart = [chart];
    
    // ============================================================== 
    // Our Visitor
    // ============================================================== 

    var chart = c3.generate({
        bindto: '#visitor',
        data: {
            columns: [
                ['Teknik Komputer', '<?php echo $countTKom; ?>'],
                ['Clicked', 15],
                ['Un-opened', 27],
                ['Bounced', 18],
            ],

            type: 'donut',
            tooltip: {
            show: true
        }
        },
        donut: {
            label: {
                show: false
            },
            title: "Ratio",
            width: 35,
            
        },
        
        legend: {
            hide: true
            //or hide: 'data1'
            //or hide: ['data1', 'data2']
            
        },
        color: {
            pattern: ['#40c4ff', '#2961ff', '#ff821c', '#7e74fb']
        }
    });
    
});