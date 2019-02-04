@extends('layouts.app')

@section('common')
    <div>
        @if($errors->any())
            <h4>{{$errors->first()}}</h4>
        @endif
        <form id="meetup" method="get" action="{{ asset($url) }}">
            <table>
                <tr>
                    <th>Alumni Id</th>
                    <th>Student Id</th>
                    <th>Date</th>
                    <th>Approval</th>
                    @if($accesslevel == 3)
                        <th>select</th>
                    @endif

                </tr>
                @foreach($values as $val)
                    <tr>
                        <td>{{ $userData[$val->a_id - 1]->name }}</td>
                        <td>{{ $userData[$val->s_id - 1]->name }}</td>
                        <td>{{ $val->date }}</td>
                        <td>
                            @switch($val->is_approved)
                                @case(-1)
                                Denied
                                @break
                                @case(0)
                                Pending
                                @break
                                @case(1)
                                Approved
                                @break
                            @endswitch
                        </td>
                        <td>@if(($val->is_approved == 0) &&($accesslevel == 3))

                                <input type="checkbox" name="selectedRow[]" value="{{ $val->id }}">
                            @endif
                        </td>
                    </tr>
                @endforeach
                <input type="hidden" id="action" name="action" value="0">

            </table>


        </form>

        @if($accesslevel == 1)
            <a href="{{ asset('/method') }}"><input type="button" value="Send Request"></a>
        @endif
        @if($accesslevel == 3)
            <input type="button" value="Approve" onclick="changeVal(1)">
            <input type="button" value="Reject" onclick="changeVal(-1)">
        @endif
    </div>

    <script>
        function changeVal(val) {
            document.getElementById("action").value = val;
            document.getElementById('meetup').submit();
        }
    </script>
@endsection
