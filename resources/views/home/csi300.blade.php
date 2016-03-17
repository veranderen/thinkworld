@extends('layouts.default')
@section('title', 'IndexWorld')
@section('content')
        <div class="container">
            <div class="content">
                <div data-example-id="bordered-table" class="bs-example">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>序号</th>
                                <th>日期</th>
                                <th>开盘</th>
                                <th>收盘</th>
                                <th>涨幅</th>
                                <th>市盈率</th>
                                <th>市盈率</th>
                                <th>股息率</th>
                                <th>股息率</th>
                                <th>成交额</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                @foreach($value as $v)
                                <td>{{$v}}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@stop