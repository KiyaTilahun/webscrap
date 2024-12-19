<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Center the entire body content */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh; /* Full height of the viewport */
            margin: 0; /* Remove default body margin */
        }

        /* Center table and text within it */
        table {
            border-collapse: collapse; /* Optional: Remove space between borders */
            margin: auto; /* Center the table */
        }

        th, td {
            text-align: center; /* Center text in table cells */
            padding: 8px; /* Padding for cells */
        }

        th {
            background-color: #f2f2f2; /* Optional: Add background color to header */
        }
    </style>
</head>
<body>
  
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            {{-- <tr>
                <th>Random String</th> --}}
                <th>Barcode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $value)
                @php
                    // Generate barcode for each random string
                    $barcode = DNS1D::getBarcodeSVG($value, 'C93', 1, 50);
                    $barcodeWithoutXml = preg_replace('/<\?xml.*?\?>/', '', $barcode);
                @endphp
                <tr>
                   
                    <td>
                        <div>
                            {!! $barcodeWithoutXml !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
