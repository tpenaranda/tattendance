@extends('layouts.master')

@section('content')
        <div class="tableContainer">
            <table class="responsive-table">
                <caption>Attendance Control</caption>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Going?</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Ride?</th>
                        <th scope="col">Seen?</th>
                    </tr>
                </thead>
                <tfoot>
                     <tr>
                        <td colspan="5">
                            Going: {{ $goingCount }}
                            Need Ride: {{ $nrCount }}
                        </td>
                     </tr>
                </tfoot>
                <tbody>
    @foreach ($guests as $guest)
        @if ($guest->going)
                    <tr style="background-color: rgba(173, 255, 47, 0.6);">
        @elseif ($guest->notified)
                    <tr style="background-color: rgba(255, 113, 47, 0.6);">
        @else
                    <tr>
        @endif
                        <th data-title="Name">{{ $guest->name }}</th>
                        <td data-title="Going?">
        @if ($guest->going)
                            <p class="green-tick">&#x2714;</p>
        @elseif ($guest->notified)
                            <p class="red-cross">&#x2718;</p>
        @else
                            <p><span>&nbsp;</span></p>
        @endif
                        </td>
                        <td data-title="Comment">
                            <p>{{ $guest->comment or '&nbsp;' }}</p>
                        </td>
                        <td data-title="Ride?">
        @if ($guest->going and $guest->need_a_ride)
                            <p class="green-tick">&#x2714;</p>
        @elseif ($guest->going)
                            <p class="red-cross">&#x2718;</p>
        @else
                            <p><span>&nbsp;</span></p>
        @endif
                        </td>
                        <td data-title="Seen?">
        @if ($guest->notified)
                        <p class="green-tick">&#x2714;</p>
        @else
                        <p class="red-cross">&#x2718;</p>
        @endif
                        </td>
                    </tr>
    @endforeach
                </tbody>
            </table>
        </div>
@endsection
