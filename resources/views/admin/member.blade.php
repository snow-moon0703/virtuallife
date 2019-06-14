@extends('layouts.app') 
@section('content')

<div class="my-3 p-3 bg-white rounded box-shadow">
    <h4 class="border-gray pb-2 mb-0 text-center">會員管理</h6>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-2 text-right">
                <form action="{{ url()->current() }}" method="get" style="width: 100%">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            </div>
            <div class="col-md-2 text-right">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </div>
            </form>
        </div>

        <div class="mb-3">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th colspan="4" scope="col">姓名</th>
                        <th colspan="2" scope="col" class="text-center">信箱</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <th scope="col"><a class="text-dark" href="members_list.php?id=m_id" onclick="return confirm('請確認是否刪除?')">刪除</a></th>
                        <td colspan="4">
                            <a class="text-dark" href="data.php?m_id=row'm_id">
                                {{$member->name}}
                            </a>
                        </td>
                        <td colspan="2" class="text-center">
                            {{$member->email}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>

@endsection