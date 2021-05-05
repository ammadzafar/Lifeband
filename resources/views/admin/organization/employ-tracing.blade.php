

<div class="at-sdviolaionshead">
    <div class="at-sectiontitle">
        <h2>Employee Tracing</h2>
    </div>
    <div class="at-datearea">
        <div class="form-group">
            <input readonly type="text" id="daterange2" name="tracing"/>
            <label for="daterange2"><i class="icon-filter2 at-btndatepicker"></i></label>
        </div>
    </div>
</div>
<div class="at-violaionstableholder">
    <table class="at-tabletheme at-violaionstable">
        <thead>
        <tr>
            <th>user name</th>
            <th>Contact Person</th>
            <th>date</th>
            <th>time</th>
        </tr>
        </thead>
        <tbody class="filter-data">
        @foreach($contacted_users as $item)
            @foreach($item as $user)
                @if($user['contacted_person'] != null)
                    <tr>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['contacted_person']}}</td>
                        <td>{{$user['date']}}</td>
                        <td>{{$user['time']}}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>




