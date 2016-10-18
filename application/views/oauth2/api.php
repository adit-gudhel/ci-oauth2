<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CodeIgniter OAuth2 Tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="CodeIgniter OAuth2 Tutorial">
    <meta property="og:type" content="website">
    <meta property="og:title" content="CodeIgniter OAuth2 Tutorial">
    <meta property="og:url" content="http://homeway.me">
    <meta property="og:site_name" content="CodeIgniter OAuth2 Tutorial">
    <meta property="og:description" content="CodeIgniter OAuth2 Tutorial">
    <meta name="twitter:title" content="@adit_gudhel">
    <link rel="publisher" href="aditya nursyahbani">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <br><br>
        <form class="form-inline">
            <h1>1. Request Access Token (Grant Type)</h1><br><br>

            <div class="form-group">
                <label for="Credentials"><h3>Resource Owner Password Credentials:</h3><br>
                    <div>Param：<code>{ grant_type: "password", username: "adit", password: "pass", client_id: 'client', client_secret:'mysecret', scope:'country' }</code></div><br>
                    <div>Result:<code id="return-PasswordCredentials"></code></div><br>
                </label><br>
                <a id="btn-PasswordCredentials" class="btn btn-success">Get PasswordCredentials</a><br>
            </div>
            <br><br>

            <div class="form-group">
                <label for="ClientCredentials"><h3>Client Credentials: </h3><br>
                    <div>Param:<code>{client_id: 'client', client_secret:'mysecret', grant_type:'client_credentials', scope:'country'}</code></div><br>
                    <div>Result:<code id="return-ClientCredentials"></code></div><br>
                </label><br>
                <a id="btn-ClientCredentials" class="btn btn-success">Get ClientCredentials</a>
            </div>
            <br><br>

            <div class="form-group">
                <label for="authorize">
                    <h3>Access_token（Authorization Code）:</h3>
                    <div>Param：<code>{code: "Authorize code", client_id: 'client', client_secret:'mysecret', password:'pass', grant_type: 'authorization_code', scope:'country'}</code></div><br>
                    <div>Result：<code id="return-Authorize"></code></div><br>
                    <div>Link Auth <a target="_blank" href="/ci-oauth2/oauth2/authorize?response_type=code&client_id=client&redirect_uri=http://www.aditya-nursyahbani.net&state=xyz&scope=country">/ci-oauth2/oauth2/authorize?response_type=code&client_id=client&redirect_uri=<?=base_url('oauth2/test');?>&state=xxx&scope=country</a></div><br>
                </label><br>
                <input type="text" class="form-control" id="authorize-code" placeholder="Authorize code">
                <a id="btn-authorize" class="btn btn-success">Get Authorize Access Token</a>
            </div>

            <br><br>
            <div class="form-group">
                <label for="authorize">
                    <h3>Implicit Grant:</h3><br>
                    <div>Authorization Code Access Token</div><br>
                </label>
            </div>

            <br><br><br>
            <h1>2. Access Token </h1>
            <br><br><br>

            <div class="form-group">
                <label for="refresh-token">
                    <h3>Refresh Access Token</h3><br>
                    <div>Param：<code>{refresh_token: "Refresh Token", client_id: 'client', client_secret:'mysecret', grant_type:'refresh_token', scope:'country'}</code></div>
                    <div>Result: <code id="return-refresh-token"></code></div><br>
                </label><br>
                <input type="text" class="form-control refresh-token" id="old_token" placeholder="Refresh Token">
                <a id="btn-refresh" class="btn btn-success">From Refresh Token Get Access Token</a>
            </div>
            <br><br><br><br>

            <div class="form-group">
                <label for="resource">
                    <h3>From Access Token get Resource</h3><br>
                    <div>Param：<code>{ access_token: "Access Token"}</code></div><br>
                    <div>Result: <code id="return-resource"></code></div><br>
                </label><br>
                <input type="text" class="form-control token" id="resource" placeholder="Resource">
                <a id="btn-resource" class="btn btn-success">Get Resource</a>
                <a id="btn-resource-limit" class="btn btn-success">Get Resource With Scope Error</a>
            </div>
            <br><br>
        </form>
    </div>
</div>

<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#btn-refresh").click(function (e){
        var data = {refresh_token: $("#old_token").val(), client_id: 'client', client_secret:'mysecret', grant_type:'refresh_token', scope:'country'};
        
        $.post('/ci-oauth2/oauth2/RefreshToken', data, function (d){
            console.log("Get Token => ", d);
            $('#return-refresh-token').html(JSON.stringify(d));
        });
    }); 

    $('#btn-authorize').click(function (e){
        var data = {code: $("#authorize-code").val(), client_id: 'client', client_secret:'mysecret', redirect_uri:"http://www.aditya-nursyahbani.net", grant_type: 'authorization_code', scope:'country'};
        $.post('/ci-oauth2/oauth2/authorize/token', data, function (d){
            $(".refresh-token").val(d.refresh_token);
            console.log("Get Authorize Access Token => ", d);
            $('#return-Authorize').html(JSON.stringify(d));
        },"json");
    });

    $('#btn-resource').click(function (e){
        var data = { access_token: $("#resource").val()};
        
        $.post('/ci-oauth2/api/countries', data, function (d){
            console.log("Get Authorize => ", d);
            $('#return-resource').html(JSON.stringify(d));
        },"json");      
    });

    $('#btn-resource-limit').click(function (e){
        var data = { access_token: $("#resource").val()};
        
        $.post('/ci-oauth2/oauth2/resource/limit', data, function (d){
            console.log("Get Authorize => ", d);
            $('#return-resource').html(JSON.stringify(d));
        },"json");      
    });

    $('#btn-PasswordCredentials').click(function (e){
        var data = { grant_type: "password", username: "adit", password: "pass", client_id: 'client', client_secret:'mysecret', scope:'country' };
        $.post('/ci-oauth2/oauth2/PasswordCredentials', data, function (d){
            console.log("Get Access Token from client credentials => ", d);
            $(".refresh-token").val(d.refresh_token);
            $(".token").val(d.access_token);
            $('#return-PasswordCredentials').html(JSON.stringify(d));
        },"json");
    });

    $("#btn-ClientCredentials").click(function (e){
        var data = {client_id: 'client', client_secret:'mysecret', grant_type:'client_credentials', scope:'country'};
        $.post('/ci-oauth2/oauth2/ClientCredentials', data, function (d){
            //d = d.JSON.parse(d);
            console.log("Get Access Token from password credentials => ", d);
            $(".token").val(d.access_token);
            $('#return-ClientCredentials').html(JSON.stringify(d));
        }, "json");
    });
});
</script>

