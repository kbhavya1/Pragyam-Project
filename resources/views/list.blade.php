<html>
<body>

<form method="get" action="{{ asset('/data') }}">
    <span>
        Select Date:
        <input type="date" name="getDate" min="2019-02-01" max="2019-02-10"
               value="{{Carbon\Carbon::now()->toDateString()}}">

        <select id="timeSel" name="getSlot">
             @foreach($options as $key=>$val)
                <option value="{{$val}}">{{$key}}</option>
            @endforeach
        </select>
        <select name="userData" id="users">
            @foreach($a_id as $val)
                <option value="{{ $val->id }}">{{ $val->name }}</option>
            @endforeach
        </select>
    </span>
    <button type="submit">Request Time</button>
</form>
</body>
</html>

