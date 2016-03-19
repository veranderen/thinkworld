@extends('layouts.default')
@section('title', 'IndexWorld')
@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach($data as $index)
        <div data-example-id="bordered-table" class="col-md-6 col-xs-12">
            <p>{{$index['name']}}</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>日期</th>
                        <th>开盘</th>
                        <th>收盘</th>
                        <th>涨幅</th>
                        <th>市盈率</th>
                        <th>股息率</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($index['data'] as $value)
                    <tr>
                        @foreach($value as $k => $v)
                            @if ($k == 'open' or $k == 'close' )
                            <td>{{(int)$v}}</td>
                            @elseif ($k == 'change' && $v > 0)
                            <td class='s-up'>{{$v}}%</td>
                            @elseif ($k == 'change' && $v < 0)
                            <td class='s-down'>{{$v}}%</td>
                            @else
                            <td>{{$v}}</td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@stop