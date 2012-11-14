function popup ( url, name, params )
{
        var newwindow = window.open(url, name, params);
        if ( window.focus ) { newwindow.focus(); }
}


function popup_tool ( toolname )
{
        var params = 'width=400,height=200,toolbar=no,menubar=no';
        if ( toolname == 'boldtext' )
        {
                popup('tools/boldtext.php', 'Bold Text Tool', params);
        }
        else if ( toolname == 'italictext' )
        {
                popup('tools/italictext.php', 'Italic Text Tool', params);
        }
        else if ( toolname == 'underscoredtext' )
        {
                popup('tools/underscoredtext.php', 'Underscored Text Tool', params);
        }
        else if ( toolname == 'link' )
        {
                popup('tools/link.php', 'Link Tool', params);
        }
        else if ( toolname == 'image' )
        {
                popup('tools/image.php', 'Image Tool', params);
        }
        else
        {
                alert("No such tool '"+toolname+"'");
        }
}


function doBoldText ()
{
        var editor = parent.opener.document.getElementById('editor');
        var text = document.getElementById('text');
        
        editor.value += "[b]" + text.value + "[/b]";
        parent.opener.focus();
        window.close();
}


function doItalicText ()
{
        var editor = parent.opener.document.getElementById('editor');
        var text = document.getElementById('text');
        
        editor.value += "[i]" + text.value + "[/i]";
        parent.opener.focus();
        window.close();
}


function doUnderscoredText ()
{
        var editor = parent.opener.document.getElementById('editor');
        var text = document.getElementById('text');
        
        editor.value += "[u]" + text.value + "[/u]";
        parent.opener.focus();
        window.close();
}


function doLink ()
{
        var editor = parent.opener.document.getElementById('editor');
        var text = document.getElementById('text');
        
        editor.value += "[link src=\"" + text.value + "\"]" + text.value + "[/link]";
        parent.opener.focus();
        window.close();
}


function doImage ()
{
        var editor = parent.opener.document.getElementById('editor');
        var text = document.getElementById('text');
        
        editor.value += "[img src=\"" + text.value + "\" /]";
        parent.opener.focus();
        window.close();
}

