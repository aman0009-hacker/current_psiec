{{--
<!DOCTYPE html>
<html>

<head>
    <title>PSIEC Admin Panel</title>
</head>

<body>
    <h1>{{ $details['email'] }}</h1>
    <p>{{ $details['body'] }}</p>
    @if ($details['body'] =="Congratulations!!! Your account has successfully verified.")
    <a href="{{ env('APP_URL') }}PaymentDetails/{{$details['encryptedID']}}">click here</a>
    @endif
    <p>Thank you</p>
</body>

</html> --}}






<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>PSIEC Admin Panel</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <a href="" title="PSIEC" target="_blank">
                                <img width="130" src="{{asset('images/home-page/logo-psiec.png')}}"
                                    title="logo" alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1
                                            style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                                            </h1>
                                            <h1>{{ $details['email'] }}</h1>
                                            <p>{{ $details['body'] }}</p>
                                            @if (  isset($details['body']) && $details['body'] =="Congratulations!!! Your account has successfully verified.")
                                            <a href="{{ env('APP_URL') }}PaymentDetails/{{$details['encryptedID']}}">click here</a>
                                            @endif
                                            @if ( isset($details['status']) && $details['status']=="OrderApprove")
                                            <a href="{{ env('APP_URL') }}PaymentDetailsOrder/{{$details['encryptedID']}}/{{$details['status']}}">click here</a>  
                                            @endif
                                            @if ( isset($details['status']) && $details['status']=="OrderPayment")
                                            <a href="{{ env('APP_URL') }}PaymentDetailsOrder/{{$details['encryptedID']}}/{{$details['status']}}">click here</a>  
                                        
                                            @endif
                                            <p>Thank you</p>
                                        {{-- <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span> --}}
                                        {{-- <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            A unique link to reset your password has been generated for you. To reset
                                            your password, click the follow ing link and follow the instructions.
                                        </p> --}}
                                        {{-- <a href="{{$url}}"
                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; <strong>PSIEC</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>