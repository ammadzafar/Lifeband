
<div class="at-sdviolaionshead">
    <div class="at-sectiontitle">
        <h2>social distancing violaions</h2>
    </div>
    <div class="at-datearea">
        <div class="form-group">
            <input readonly type="text" id="daterange" name="violation"/>
            <label for="daterange"><i class="icon-filter2 at-btndatepicker"></i></label>
        </div>
    </div>
</div>

<div class="at-violaionstableholder">
    <table class="at-tabletheme at-violaionstable">
        <thead>
        <tr>
            <th>#contacts</th>
            <th>user name</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody class="violation-distance">
        @foreach($users as $key => $user)
            <tr class="dist-violate">
                <td>{{$key +1}}</td>
                <td>
                    <div>
                        <figure>
                            <img src="{{asset('uploads/api/images/'.$user->image)}}" >
                        </figure>
                        <em>{{$user->name}}</em>
                    </div>
                </td>
                <td class="status-btn">
                    @if($user->status == mb_strtolower('infected'))
                        <span class="at-bordercolorred infected" data-id="{{$user->id}}">Infected</span>
                    @elseif($user->status == mb_strtolower('not-infected'))
                        <span class="at-colorgreen not-infected" data-id="{{$user->id}}">Not Infected</span>
                    @elseif($user->status == null)
                        <span class="at-colorgreen not-infected" data-id="{{$user->id}}">Not Infected</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

