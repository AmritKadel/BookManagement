<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New User Sign Up Notification</title>
</head>

<body>
    <table
        style="width: 100%; max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 14px; line-height: 1.6; border-collapse: collapse;">
        <tr>
            <td style="padding: 20px;">
                <h2 style="font-size: 20px; margin-bottom: 20px;">Dear Admin, New User has been registered.These are the details of the user</h2>
                <p><strong>Name:</strong> {{$username}}</p>
                <p><strong>Email:</strong> {{$email}}</p>
                <p><strong>Contact Number:</strong>{{$mobile_number}}</p>
                
            </td>
        </tr>
    </table>
</body>

</html>