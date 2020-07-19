<html>
<head>
    <title>Report | Download | PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'kalpurush', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, td, th {
            border: 1px solid black;
        }

        th, td {
            padding: 4px;
            font-family: 'kalpurush', sans-serif;
            font-size: 13px;
        }

        @page {
            header: page-header;
            footer: page-footer;
            background-image: url({{ public_path('images/cvcs_background.png') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }

        .graybackground {
            background: rgba(192, 192, 192, 0.7);
        }
    </style>
</head>
<body>
<h2 align="center">
    <img src="{{ public_path('images/custom2.png') }}" style="height: 80px; width: auto;"><br/>
    কাস্টমস এন্ড ভ্যাট কো-অপারেটিভ সোসাইটি
</h2>
<p align="center" style="padding-top: -20px;">
    <span style="font-size: 20px;">কর্মস্থলের লগ: {{ $member->name }} (<small>$member->member_id</small>)</span><br/>
</p>

<div class="" style="padding-top: 0px;">
    <table class="">
        <tr class="graybackground">
            <th width="5%">#</th>
            <th width="30%">দপ্তর</th>
            <th>পদবি</th>
            <th>যোগদানের তারিখ</th>
        </tr>

        @php
            $counter = 1;
        @endphp
        @foreach($careerlogs as $careerlog)
            <tr>
                <td align="center">{{ bangla($counter++) }}</td>
                <td>{{ $careerlog->prev_branch_name }} @if($careerlog->branch->name != $careerlog->prev_branch_name)
                        -> {{ $careerlog->branch->name }} @endif</td>
                <td>{{ $careerlog->prev_position_name }} @if($careerlog->position->name != $careerlog->prev_position_name)
                        -> {{ $careerlog->position->name }} @endif</td>
                <td align="center">{{ $careerlog->start_time->format('F d, Y') }}</td>
            </tr>
        @endforeach
        @if($counter == 1)
            <tr>
                <td align="center">{{ bangla($counter++) }}</td>
                <td>{{ $member->branch->name }}</td>
                <td>{{ $careerlog->position->name }}</td>
                <td align="center">{{ ($member->joining_date != null)? date('F d, Y', strtotime($member->joining_date)): "N/A"}}</td>
            </tr>
        @endif
    </table>
</div>

<htmlpagefooter name="page-footer">
    <small>ডাউনলোডের সময়কালঃ <span style="font-family: Calibri;">{{ date('F d, Y, h:i A') }}</span></small><br/>
    <small style="font-family: Calibri; color: #6D6E6A;">Generated by: https://cvcsbd.com</small>
</htmlpagefooter>
</body>
</html>
