<html>
<head>
  <title>Report | Download | PDF</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  th, td{
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
    background: rgba(192,192,192, 0.7);
  }
  </style>
</head>
<body>
  <h2 align="center">
    <img src="{{ public_path('images/custom2.png') }}" style="height: 80px; width: auto;"><br/>
    কাস্টমস এন্ড ভ্যাট কো-অপারেটিভ সোসাইটি
  </h2>
  <p align="center" style="padding-top: -20px;">
    <span style="font-size: 20px;">পদবি সমূহ</span><br/>
  </p>

  <div class="" style="padding-top: 10px; padding-bottom: 10px">
    <table class="">
      <tr class="graybackground">
        <th width="5%">#</th>
        <th width="30%">পদবির নাম</th>
        <th width="13%">সদস্য সংখ্যা</th>
      </tr>
      @php
        $counter = 1;
      @endphp
      <tr>
        <td align="center">{{ bangla($counter++) }}</td>
        <td align="center">{{ $memberpos->name }}</td>
        <td align="center"><span><b>{{ bangla($memberpos->memberCount) }}</b></span></td>
      </tr>

      @foreach($positions as $position)
        <tr>
          <td align="center">{{ bangla($counter++) }}</td>
          <td align="center">{{ $position->name }}</td>
          <td align="center"><span><b>{{ bangla($position->memberCount) }}</b></span></td>

        </tr>
      @endforeach
    </table>
  </div>

  <htmlpagefooter name="page-footer">
    <small>ডাউনলোডের সময়কালঃ <span style="font-family: Calibri;">{{ date('F d, Y, h:i A') }}</span></small><br/>
    <small style="font-family: Calibri; color: #6D6E6A;">Generated by: https://cvcsbd.com</small>
  </htmlpagefooter>
</body>
</html>
