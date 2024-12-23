(function ($) {
    "use strict";

        $('.example-sparkline-line').sparkline([10,30,25,20,45,50,40,80,90],{
            type:"line",
            height:"100",
            width:"200",
            lineColor: '#FF5194',
            lineWidth: 2,
            fillColor: false,
            highlightLineColor: '#FF5194',
            minSpotColor: false,
            maxSpotColor: '#FF5194',
            highlightSpotColor: '#FF5194',
            spotRadius: 3,
        });
        $('.example-sparkline-line-area').sparkline([10,30,25,20,45,50,40,80,90],{
            type:"line",
            height:"100",
            width:"200",
            lineColor: '#FF5194',
            lineWidth: 2,
            fillColor: 'rgba(66, 139, 250, 0.3)',
            highlightLineColor: '#FF5194',
            minSpotColor: false,
            maxSpotColor: '#FF5194',
            highlightSpotColor: '#FF5194',
            spotRadius: 3,
        });
        $('.example-sparkline-bar').sparkline([-10,30,25,-20,-45,50,40,80,90],{
            type:"bar",
            height:"100",
            barWidth:"15",
            barSpacing:"10",
            barColor: '#FF5194',
            negBarColor: '#fb7da4',
        });
        $('.example-sparkline-bar-line-composite').sparkline([-10,30,25,-20,-45,50,40,80,90],{
            type:"bar",
            height:"100",
            barWidth:"15",
            barSpacing:"10",
            barColor: '#FF5194',
            negBarColor: '#fb7da4',
        });
        $('.example-sparkline-bar-line-composite').sparkline([-10,30,25,-20,-45,50,40,80,90],{
            type:"line",
            height:"100",
            width:"200",
            lineColor: '#ff9666',
            lineWidth: 2,
            fillColor: false,
            highlightLineColor: '#ff9666',
            minSpotColor: false,
            maxSpotColor: '#ff9666',
            highlightSpotColor: '#ff9666',
            spotRadius: 3,
            composite: true
        });
        $('.example-sparkline-tristate').sparkline([1,1,0,1,-1,-1,1,-1,0,0,1,1],{
            type:"tristate",
            height:"100",
            barWidth:"15",
            barSpacing:"10",
            posBarColor: '#FF5194',
            zeroBarColor: '#999999',
            negBarColor: '#fb7da4',
        });
        $('.example-sparkline-discrete').sparkline([4,6,7,7,4,3,2,1,4,4,5,6,7,6,6,2,4,5],{
            type:"discrete",
            height:"100",
            width:"250",
            lineColor: '#FF5194',
        });
        $('.example-sparkline-bullet').sparkline([10,12,12,9,7],{
            type:"bullet",
            height:"100",
            width:"250",
            targetColor: '#ff9666',
            targetWidth: 10,
            performanceColor: '#FF5194',
            rangeColors: [
                'rgba(66, 139, 250, 0.2)',
                'rgba(66, 139, 250, 0.3)',
                'rgba(66, 139, 250, 0.5)',
            ],
        });
        $('.example-sparkline-pie').sparkline([20, 30, 45],{
            type:"pie",
            height:"100",
            sliceColors: ['#FF5194','#fb7da4','#ff9666']
        });
        $('.example-sparkline-box').sparkline([4, 27, 34, 52, 54, 59, 61, 68, 78, 82, 85, 87, 91, 93, 100], {
            type:"box",
            height:"100",
            width:"250",
            boxLineColor: "#FF5194",
            boxFillColor: "#f1f1f1",
            whiskerColor: "#FF5194",
            outlierLineColor: "#FF5194",
            medianColor: "#FF5194",
            targetColor: "#FF5194"
        });
    
})(jQuery);