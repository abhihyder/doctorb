@extends('layouts.app')

@section('content')
<div class="header">
  <div class="container-fluid">
    <div class="header-body card">
        <h4 class="boxbdr">All Data Are Here</h4>
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>John</td>
            <td>Doe</td>
            <td>john@example.com</td>
        </tr>
        <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
        </tr>
    </tbody>
</table>
</div>
</div>
</div>
@endsection
