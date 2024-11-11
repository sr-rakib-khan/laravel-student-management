@extends('layouts.admin')
@section('page-content')
    @php
        $total_student = DB::table('students')->count();
        $active_student = DB::table('students')->where('status', 1)->count();
        $Pending_student = DB::table('students')->where('status', 0)->count();
    @endphp
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="groupedBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 bg-primary">
                        <div class="row">
                            <div class="col-md-3 border-end">
                                <img src="" alt="">
                            </div>
                            <div class="col-md-9">
                                hello world
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3 border-end">
                                <img src="" alt="">
                            </div>
                            <div class="col-md-9">
                                hello world
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3 border-end">
                                <img src="" alt="">
                            </div>
                            <div class="col-md-9">
                                <h4>November Cash Status</h4>
                                <table>
                                    <tr>
                                        <td>November Collection</td>
                                        <td class="right-aligned">1000</td>
                                    </tr>
                                    <tr>
                                        <td>November Expense</td>
                                        <td class="text-end">1000</td>
                                    </tr>
                                    <tr>
                                        <td>November Cash</td>
                                        <td class="text-end">100</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <script>
        window.onload = function() {
            const ctx = document.getElementById('groupedBarChart').getContext('2d');

            const groupedBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                        'September', 'October', 'November', 'December'
                    ],
                    datasets: [{
                            label: 'Fee',
                            data: [100000, 150, 180, 170, 140, 200, 180, 160, 190, 175, 185, 210],
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        },
                        {
                            label: 'Collection',
                            data: [90000, 140, 160, 150, 130, 180, 160, 140, 170, 160, 170, 190],
                            backgroundColor: 'rgba(255, 0, 0, 1)'
                        },
                        {
                            label: 'Discount',
                            data: [5000, 10, 20, 15, 10, 20, 15, 20, 15, 15, 20, 20],
                            backgroundColor: 'rgba(255, 99, 132, 0.7)'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: false
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
    </script>


    <script>
        const xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                    borderColor: "red",
                    fill: false
                }, {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                    borderColor: "green",
                    fill: false
                }, {
                    data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                    borderColor: "blue",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
