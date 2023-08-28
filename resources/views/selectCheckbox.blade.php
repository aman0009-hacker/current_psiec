<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
        <th><input type="checkbox" id="masterCheckbox"/></th>
        <th>Name</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Number</th>
    </tr>
    @foreach ($main as $single)
    <tr>
    <td><input type="checkbox" class="rowCheckbox"/></td>
    <td>{{$single->name}}</td>
    <td>{{$single->last_name}}</td>
    <td>{{$single->email}}</td>
    <td>{{$single->contact_number}}</td>
   </tr>
    @endforeach
    
</table>
{{ $main->links()}}

<button id="deleteButton">Delete Selected</button>
</body>

<script>
    document.getElementById('masterCheckbox').addEventListener('change', function() {
        const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
        for (const checkbox of rowCheckboxes) {
            checkbox.checked = this.checked;
        }
    });



    

    document.getElementById('deleteButton').addEventListener('click', function() {
        const checkedRowCheckboxes = document.querySelectorAll('.rowCheckbox:checked');
        const ids = Array.from(checkedRowCheckboxes).map(checkbox => {
            // Assuming you have a data attribute or other way to associate the ID with the checkbox
            console.log(checkbox.getAttribute('data-id'));
        });

     
    });
</script>

</html>