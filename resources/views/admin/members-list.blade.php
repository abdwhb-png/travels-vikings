<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Members List</h4>
                <div class="table-responsive">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <th> ID </th>
                                <th> Actions </th>
                                <th> Username </th>
                                <th> Parent ID </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Invitation Code </th>
                                <th> Balance </th>
                                <th> Completed Daily Task </th>
                                <th> Total Commission </th>
                                <th> Created At </th>
                                <th> Updated At </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $member)
                                
                            @endforeach
                            <tr class="{{ ($member['status']) ? '' : 'bg-danger text-white' }}" id="{{ 'member-'.$member['id'] }}">
                                <td>{{ $member['id'] }}</td>
                                <td>
                                    {{-- <crud-buttons-component :urls="mystore.membersCrudUrls($member['id'])" :action="false"
                                        :change-pwd="true" :show-more="true" :member="$member"></crud-buttons-component> --}}
                                </td>
                                <td>
                                    <span class="ps-2">{{ $member['username'] }}</span>
                                </td>
                                <td> <a :href="'#$member-'+$member['parent_id']">{{ $member['parent_id'] ? $member['parent_id'] :
                                        'NONE'}}</a> </td>
                                <td> {{ $member['email'] }} </td>
                                <td> {{ $member['phone'] }} </td>
                                <td> {{ $member['invitation_code'] }} </td>
                                <td> {{ $member['balance'] }} $</td>
                                <td> {{ $member['completed_daily_task'] }} </td>
                                <td> {{ $member['total_commission'] }} $</td>
                                <td> {{ $member['created_at'] }} </td>
                                <td> {{ $member['updated_at'] }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>