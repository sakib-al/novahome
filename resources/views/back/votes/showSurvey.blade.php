@extends('back.layouts.master')
@section('title', 'Vote Result')
@section('head')

@endsection
@section('master')
<div class="card border-light mt-3 shadow">
    <div class="card-body">
        <div id="piechart"></div>
        <div class="card-header">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm" id="dataTable">
                    <thead>
                    <tr>
                        <th scope="col">SL.</th>
                        <th scope="col" class="text-center">User</th>
                        <th scope="col">Answer</th>
                        <th scope="col" class="text-center">IP</th>
                        <th scope="col" class="text-center">Location</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($vote->voteAnswer as $key => $vote)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td class="text-center">
                                @php
                                    $user = $vote->user;
                                @endphp
                                {{$user?$user->first_name.''.$user->last_name:''}}
                            </td>
                            <td>
                                <ul>
                                    @foreach ($questions as $question)
                                        <li>{{$question->question}} : {{$vote->answerers_arr[$question->id] ?? 'N/A'}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center">{{$vote->ip}}</td>
                            <td class="text-center">{{$vote->location}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
