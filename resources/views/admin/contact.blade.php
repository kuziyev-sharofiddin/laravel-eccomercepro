<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style type="text/css">
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color
        {
            color: black;
        }
        .center
        {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 40px;
            border: 3px solid white;
        }
        .font_size
        {
            text-align: center;
            font-size: 40px;
            padding-top: 20px;        }
        .th_color
        {
            background: skyblue;
        }
        .th_dag
        {
            padding: 30px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="font_size">All Contacts</h2>
                <table class="center">
                    <tr class="th_color">
                        <th class="th_dag">Id</th>
                        <th class="th_dag">Name</th>
                        <th class="th_dag">Email</th>
                        <th class="th_dag">Phone</th>
                        <th class="th_dag">Description</th>
                        <th class="th_dag">Created At</th>
                        <th class="th_dag">Action</th>
                    </tr>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name}}</td>
                        <td>{{ $contact->email}}</td>
                        <td>{{ $contact->phone}}</td>
                        <td>{{ $contact->description }}</td>
                        <td>{{ $contact->created_at }}</td>

                        <td>
                            <form action="{{ route('contact_destroy', ['contact'=>$contact->id]) }}" method="POST" onsubmit="return confirm('Are you sure to delete this?')">
                                @csrf
                                @method('DELETE')
                            <button  type="submit"><i class="fa fa-trash-o" style="padding-top:20px;font-size:48px; color:red"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
{{-- <!DOCTYPE html>
<html>
<head>
<title>Google Icons</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<h1>delete</h1>

<i class="material-icons">delete</i>
<i class="material-icons" style="font-size:36px">delete</i>
<i class="material-icons" style="font-size:48px;color:red">delete</i>

<p>Used on a button:</p>
<button style="font-size:24px">Button <i class="material-icons">delete</i></button>

<p>Unicode:</p>
<i class="material-icons">&#xe872;</i>
<i class="fa fa-trash"></i>

</body>
</html> --}}
