@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    @include('layouts.breadcrumb')
    <div class="flex justify-start mb-6">
        <button
            class=" bg-[#001f3f] text-white rounded-lg px-6 py-3 font-semibold hover:text-blue-600 ansition duration-300"
            onclick="window.location.href='{{ route('admin-result') }}'">
            &larr;
        </button>
    </div>
    <h2 class="text-4xl font-extrabold text-center text-white mb-12 bg-[#001f3f] p-4 rounded-lg">
        Election Results - {{ $election->title }}
    </h2>
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-5">
        <div class="lg:grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($candidates->groupBy('position_id') as $positionId => $candidate)
                <div class="bg-white p-6 rounded-xl shadow-xl mb-8">
                    <div class="card-header bg-[#001f3f] text-white p-4 rounded-t-xl">
                        <h4 class="text-2xl font-semibold">{{ $candidate->first()->position->title }}</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="chart-{{ $positionId }}"></canvas>
                    </div>
                    <div class="card-footer bg-transparent text-center p-4">
                        <small class="text-gray-600">Election results as of {{ now()->format('F j, Y') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = {
        @foreach($candidates->groupBy('position_id') as $positionId => $cands)
        "{{ $positionId }}": {
            labels: [
                @foreach($cands as $candidate)
                    "{{ $candidate->student->name }}",
                @endforeach
            ],
            data: [
                @foreach($cands as $candidate)
                    {{ $candidate->votes->count() }},
                @endforeach
            ]
        },
        @endforeach
    };

    Object.keys(chartData).forEach(positionId => {
        const ctx = document.getElementById(`chart-${positionId}`).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData[positionId].labels,
                datasets: [{
                    label: 'Votes',
                    data: chartData[positionId].data,
                    backgroundColor: '#007BFF',
                    borderRadius: 6
                }]
            },
            options: {
                indexAxis: 'y', // This makes the bars horizontal
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>

<style>
    canvas {
        height: 300px !important;
    }
</style>

<style>
    canvas {
        height: 300px !important;
    }
</style>
@endsection
