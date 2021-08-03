<h2>你有新报名需要及时处理</h2>
@if($data)
    <p>报名信息</p>
    <ul>
        <li>报名姓名：{{ $data->name }}</li>
        <li>报名电话：{{ $data->tel }}</li>
        <li>报名时间：{{ $data->created_at }}</li>
        <li>报名备注：{{ $data->wants_country }}</li>
    </ul>
    @if($data->externSalesman)
        <p>合作者信息：</p>
        <ul>
            <li>来源：<b>外部业务员</b></li>
            <li>姓名： {{ $data->externSalesman->name }}</li>
            <li>电话： {{ $data->externSalesman->tel }}</li>
        </ul>
    @endif
    @if($data->organization)
        <p>合作者信息：</p>
        <ul>
            <li>来源：<b>机构</b></li>
            <li>机构名称： {{ $data->organization->name }}</li>
            <li>机构电话： {{ $data->organization->tel }}</li>
        </ul>
    @endif
@endif
