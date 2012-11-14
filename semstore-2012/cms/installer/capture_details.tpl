<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
        <title>CMS Configurator</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <style>
        * {
                margin: 0px;
                padding: 0px;
        }
        
        body {
                background-color: #eeeeee;
                font: 8pt black "Verdana";
        }
        
        div.maincontainer {
                width: 700px;
                margin-top: 50px;
                margin-bottom: 50px;
                margin-left: auto;
                margin-right: auto;
        }
        
        
        div.maincontainer p.errormessage {
                color: red;
        }
        
        
        div.maincontainer fieldset {
                margin-top: 20px;
                margin-bottom: 20px;
                padding: 10px 10px 10px 10px;
                border: 1px solid black;
        }
        
        
        div.maincontainer fieldset legend {
                padding-left: 5px;
                padding-right: 5px;
                font-weight: bold;
        }
        
        
        div.maincontainer div.row {
                margin-top: 10px;
                margin-bottom: 10px;
        }
        
        
        div.row label {
                float: left;
                width: 120px;
                margin-left: 5px;
                margin-right: 5px;
                text-align: right;
        }
        
        
        select.dbprotocol {
                ;
        }
        
        
        input.dbhost, input.dbport, input.dbuser, input.dbpass, input.dbname {
                width: 200px;
        }
        
        
        textarea.libpath {
                width: 400px;
                height: 75px;
        }
        
        
        input.siterootpath, input.siterootwebpath, input.siterootftppath,
        input.cmsrootpath, input.cmsrootwebpath,
        input.systmp {
                width: 200px;
        }
        
        
        </style>
</head>

<body>

<div class="maincontainer">

<p class="errormessage">{$errmsg}</p>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<fieldset>
<legend>FTP Configuration</legend>
<div class="row">
        <label>Host</label>
        <input class="ftphost" name="ftphost" value="{$ftphost}" type="text" />
</div>
<div class="row">
        <label>Port</label>
        <input class="ftpport" name="ftpport" value="{$ftpport}" type="text" />
</div>
<div class="row">
        <label>Username</label>
        <input class="ftpuser" name="ftpuser" value="{$ftpuser}" type="text" />
</div>
<div class="row">
        <label>Password</label>
        <input class="ftppass" name="ftppass" value="{$ftppass}" type="password" />
</div>
</fieldset>

<fieldset>
<legend>DB Configuration</legend>
<div class="row">
        <label>Protocol</label>
        <select class="dbprotocol" name="dbprotocol" />
        <option value="mysql">MySQL</option>
        <option value="postgres">PostgreSQL</option>
        </select>
</div>
<div class="row">
        <label>Host</label>
        <input class="dbhost" name="dbhost" value="{$dbhost}" type="text" />
</div>
<div class="row">
        <label>Port</label>
        <input class="dbport" name="dbport" value="{$dbport}" type="text" />
</div>
<div class="row">
        <label>Username</label>
        <input class="dbuser" name="dbuser" value="{$dbuser}" type="text" />
</div>
<div class="row">
        <label>Password</label>
        <input class="dbpass" name="dbpass" value="{$dbpass}" type="password" />
</div>
<div class="row">
        <label>Database</label>
        <input class="dbname" name="dbname" value="{$dbname}" type="text" />
</div>
<div class="row">
        <label>Empty Database</label>
        <input class="emptydb" name="emptydb" value="yes" type="checkbox" {$emptydb} />
</div>
<div class="row">
        <label>Drop tables if present</label>
        <input class="droptables" name="droptables" value="yes" type="checkbox" {$droptables} />
</div>
</fieldset>


<fieldset>
<legend>Code Library Paths</legend>
<div class="row">
        <label>Host</label>
        <textarea class="libpath" name="libpath">{$libpath}</textarea>
</div>
</fieldset>


<fieldset>
<legend>CMS Configuration</legend>
<div class="row">
        <label>Site Root Path</label>
        <input class="siterootpath" name="siterootpath" value="{$siterootpath}" type="text" />
</div>
<div class="row">
        <label>Site Root Webpath</label>
        <input class="siterootwebpath" name="siterootwebpath" value="{$siterootwebpath}" type="text" />
</div>
<div class="row">
        <label>Site Root FTP Path</label>
        <input class="siterootftppath" name="siterootftppath" value="{$siterootftppath}" type="text" />
</div>
<div class="row">
        <label>CMS Root Path</label>
        <input class="cmsrootpath" name="cmsrootpath" value="{$cmsrootpath}" type="text" />
</div>
<div class="row">
        <label>CMS Root Webpath</label>
        <input class="cmsrootwebpath" name="cmsrootwebpath" value="{$cmsrootwebpath}" type="text" />
</div>
<div class="row">
        <label>System Temp Dir</label>
        <input class="systmp" name="systmp" value="{$systmp}" type="text" />
</div>
</fieldset>

<fieldset>
<legend>CMS Administrator</legend>
<div class="row">
        <label>Administrator Email</label>
        <input class="adminemail" name="adminemail" value="{$adminemail}" type="text" />
</div>
<div class="row">
        <label>Administrator Password</label>
        <input class="adminpass" name="adminpass" value="{$adminpass}" type="password" />
</div>
<div class="row">
        <label>Confirm Password</label>
        <input class="confirmadminpass" name="confirmadminpass" value="{$confirmadminpass}" type="password" />
</div>
</fieldset>

<input name="button" value="Install" type="submit" />

</form>

</div>

</body>

</html>
